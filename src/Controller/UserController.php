<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Exception\NotFoundException;
use Cake\Log\Log;

/**
 * User Controller
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserController extends AppController
{
    private $userTypes = [
        '000' => [
            'name' => '承認待機',
            'class' => 'bg-gray-300 text-gray-900 text-sm font-medium mr-2 px-2.5 py-1 rounded-full'
        ],
        '777' => [
            'name' => 'スーパー管理者',
            'class' => 'bg-pink-300 text-pink-900 text-sm font-medium mr-2 px-2.5 py-1 rounded-full'
        ],
        '007' => [
            'name' => '管理者',
            'class' => 'bg-sky-300 text-sky-900 text-sm font-medium mr-2 px-2.5 py-1 rounded-full'
        ],
        '005' => [
            'name' => '病棟管理者',
            'class' => 'bg-green-300 text-green-900 text-sm font-medium mr-2 px-2.5 py-1 rounded-full'
        ],
        '001' => [
            'name' => 'スタッフ',
            'class' => 'bg-indigo-300 text-indigo-900 text-sm font-medium mr-2 px-2.5 py-1 rounded-full'
        ],
        '009' => [
            'name' => '非承認',
            'class' => 'bg-orange-300 text-orange-900 text-sm font-medium mr-2 px-2.5 py-1 rounded-full'
        ],
    ];

    /**
     * 初期化メソッド
     * @return void
     */
    public function initialize(): void  {

        parent::initialize();
        $this->loadComponent('Paginator');

        /**
         *  Users, WardManagers テーブルロード
         * 
        */
        $this->Users = TableRegistry::getTableLocator()->get('Users');
        $this->WardManagers = TableRegistry::getTableLocator()->get('WardManagers');
    }

    /**
     * ユーザー承認
     * 
     * @return void
     */
    public function userApproval() {

        $users = $this->Users->find('all')
        ->where(['user_type' => '000'])
        ->contain(['WardManagers'])
        ->distinct(['Users.id'])
        ;

        $departmentsTable = TableRegistry::getTableLocator()->get('Masters');
        $departments = $departmentsTable->find('list', [
            'keyField' => 'item_code',
            'valueField' => 'item_name'
        ])->where(['master_key' => '007'])->toArray();

        $this->set('users', $this->Paginator->paginate($users));
        $this->set('userTypes', $this->userTypes);
        $this->set('departments', $departments);
    
    }

    /**
     * Modalで表示されたユーザーの承認処理
     * 
     * @param mixed $id
     * @return \Cake\Http\Response
     */
    public function userApprovalRegistration($id)
    {
        $this->request->allowMethod(['post']);

        $userId = $this->request->getData('user_id');
        $userType = $this->request->getData('user_type');

        if ($userId != $id) {
            return $this->response->withStatus(400)->withStringBody('ユーザータイプが存在しません。');
        }

        $user = $this->Users->get($id);

        if ($user && $user->user_type === '000') {
                if (is_null($userType)) {
                return $this->response->withStatus(400)->withStringBody('ユーザータイプが存在しません。');
            }

            $user->user_type = $userType;
            $user->approval_date = FrozenTime::now();
            //$user->approval_user = $this->request->getAttribute('identity')->getIdentifier();

            if ($this->Users->save($user)) {
                return $this->response->withStatus(200)->withStringBody('承認しました');
            } else {
                return $this->response->withStatus(500)->withStringBody('ユーザーの保存に失敗しました。');
            }
        }

        return $this->response->withStatus(404)->withStringBody('ユーザーが見つかりません。');
    }
    /**
     * ユーザー情報
     * 
     * @return void
     * @throws \Cake\Http\Exception\NotFoundException
     */
    public function userInfo() {
        $userTable = TableRegistry::getTableLocator()->get('Users');

        $departmentsTable = TableRegistry::getTableLocator()->get('Masters');
        $departments = $departmentsTable->find('list', [
            'keyField' => 'item_code',
            'valueField' => 'item_name'
        ])->where(['master_key' => '007'])->toArray();

        $users = $this->paginate($userTable->find()->where(['user_type !=' => '000']));
        $userTypes = $this->userTypes;
        $this->set(compact('users', 'userTypes'));
        $this->set('departments', $departments);
    }

    /**
     * 権限削除
     * 
     * @param mixed $id
     * @return \Cake\Http\Response|null
     */
    public function revokePermission($id) {

        $this->request->allowMethod(['post']);
        $user = $this->Users->get($id);
        if ($user) {
            $user->user_type = '000';
            if($this->Users->save($user)) {
                $this->Flash->success(__('ユーザーの権限を削除しました。'));
            } else {
                $this->Flash->error(__('ユーザーの権限削除に失敗しました。 再度お試しください。'));
            }
        } else {
            $this->Flash->error(__('ユーザーが見つかりません。'));
        }
        return $this->redirect(['action' => 'userInfo']);
    
    }

    /**
     * 病棟管理者一覧
     * 
     * @return void
     */
    public function wardManager()
    {
        $query = $this->Users->find()
        ->contain(['WardManagers'])
        ->where(['Users.user_type' => '005'])
        ->order(['Users.id' => 'desc']);

        $users = $this->paginate($query, [
            'limit' => 10
        ]);

        // 病棟情報をユーザー情報にマージ
        $mergedUsers = [];
        foreach ($users as $user) {
            if (!empty($user->ward_manager)) {
                if (!isset($mergedUsers[$user->id])) {
                    $mergedUsers[$user->id] = [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'department' => $user->department,
                        'ward_managers' => []
                    ];
                }
                $mergedUsers[$user->id]['ward_managers'][] = $user->ward_manager;
            }
        }
        // Sort
        foreach ($mergedUsers as &$user) {
            usort($user['ward_managers'], function($a, $b) {
                return $a->ward_code <=> $b->ward_code;
            });
        }

        // マージしたユーザー情報をオブジェクトに変換
        $mergedUsers = array_map(function($user) {
            return (object) $user;
        }, array_values($mergedUsers));

        // 部署表示
        $departmentsTable = TableRegistry::getTableLocator()->get('Masters');
        $departments = $departmentsTable->find('list', [
            'keyField' => 'item_code',
            'valueField' => 'item_name'
        ])->where(['master_key' => '007'])->toArray();

        $this->set(compact('mergedUsers', 'departments'));
        $this->set('userTypes', $this->userTypes);
    }

    /**
     * 病棟アップデート処理するメソッド
     * 
     * @param mixed $id
     * @return void
     * @throws \Cake\Http\Exception\NotFoundException
     */
    public function wardUpdate($id)
    {
        // メソッドがPOSTであるかどうかを確認
        if ($this->request->is('post')) {
            // ward_codeパラメターを取得
            $wardCodes = $this->request->getData('ward_code', []);
            // wardUpdateメソッドが呼び出されたことをログに記録
            Log::info('wardUpdate called: user_id=' . $id . ', ward_codes=' . json_encode($wardCodes));

            // ward_codeが空いてない場合、user_idに関連するすべての病棟データを削除
            if (!empty($wardCodes)) {
                $this->WardManagers->deleteAll(['user_id' => $id, 'ward_code NOT IN' => $wardCodes]);
                Log::write('info', 'Deleted wards for user_id=' . $id . ', not in ward_codes=' . json_encode($wardCodes));
            } else {
                // ward_codeがあいてる場合、user_idに関連するすべての病棟データを削除
                $this->WardManagers->deleteAll(['user_id' => $id]);
                Log::write('info', 'Deleted all wards for user_id=' . $id);
            }

            // ward_codeをループして、新しい病棟データを保存
            foreach ($wardCodes as $wardCode) {
                // user_idとward_codeに関連する病棟データを取得
                $ward = $this->WardManagers->find()->where(['user_id' => $id, 'ward_code' => $wardCode])->first();
                // wardがない場合、新しいwardを作成して保存
                if (!$ward) {
                    $existingWard = $this->WardManagers->find()->where(['user_id' => $id])->first();
                    $createdAt = $existingWard ? $existingWard->created_at : date('Y-m-d H:i:s');
                    $ward = $this->WardManagers->newEntity([
                        'user_id' => $id,
                        'ward_code' => $wardCode,
                        'creator_id' => $existingWard ? $existingWard->creator_id : rand(1, 1000),
                        'created_at' => $createdAt
                    ]);
                } else {
                    $ward->updated_at = date('Y-m-d H:i:s');
                    Log::write('info', 'Existing ward updated for user_id=' . $id . ', ward_code=' . $wardCode);
                }
                $this->WardManagers->save($ward);
                Log::write('info', 'New ward save for user_id=' . $id . ', ward_code=' . $wardCode);
            }
            // wardUpdateメソッドが正常に完了したことをログに記録
            Log::write('info', 'wardUpdate completed successfully for user_id=' . $id . ', ward_code=' . $wardCode);
            return $this->response->withType('application/json')->withStringBody(json_encode(['success' => true]));
        } else {
            // メソッドがPOSTでない場合、BadRequestExceptionをスロー
            throw new BadRequestException('invalid request method');
        }
    }

    public function getWardManager($id)
    {
        $wardCodes = $this->WardManagers->find()
            ->select(['ward_code'])
            ->where(['user_id' => $id])
            ->extract('ward_code')
            ->toList();

        return $this->response->withType('application/json')
            ->withStringBody(json_encode(['ward_codes' => $wardCodes]));
    }
}
