<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Exception\NotFoundException;
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
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
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

        // 病棟管理者表示
        foreach ($users as $user) {
            if (!empty($user->ward_manager)) {
                $user->ward_managers = [$user->ward_manager];
            } else {
                $user->ward_managers = [];
            }
        }

        // 部署表示
        $departmentsTable = TableRegistry::getTableLocator()->get('Masters');
        $departments = $departmentsTable->find('list', [
            'keyField' => 'item_code',
            'valueField' => 'item_name'
        ])->where(['master_key' => '007'])->toArray();

        $this->set(compact('users'));
        $this->set('userTypes', $this->userTypes);
        $this->set('departments', $departments);
    }

    public function updateWard($id)
    {
        if ($this->request->is(['post'])) {

            $wardCodes = $this->request->getData('ward_codes', []);

            try {
                $this->WardManager->deleteAll(['user_id' => $id, 'ward_code NOT IN' => $wardCodes]);

                foreach ($wardCodes as $wardCode) {
                    $ward = $this->WardManager->find()
                        ->where(['user_id' => $id, 'ward_code' => $wardCode])
                        ->first();

                    if (!$ward) {
                        $ward = $this->WardManager->newEntity(['user_id' => $id, 'ward_code' => $wardCode, 'creator_id' => $this->Auth->user('id')]);
                    }

                    $this->WardManager->save($ward);
                }

                return $this->response->withType('application/json')
                    ->withStringBody(json_encode(['success' => true]));
            } catch (\Exception $e) {
                return $this->response->withType('application/json')
                    ->withStringBody(json_encode(['success' => false, 'message' => '病棟の変更のエラーが発生しました。', 'error' => $e->getMessage()]))
                    ->withStatus(500);
            }
        } else {
            throw new BadRequestException('Invalid request method');
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
