<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

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
        $user = $this->Users->get($id);
        if ($user && $user->user_type === '000') {
            $userType = $this->request->getData('user_type');
            if (is_null($userType)) {
                return $this->response->withType('application/json')
                    ->withStringBody(json_encode(['error' => 'ユーザータイプがある存在しません。']))
                    ->withStatus(400);
            }
            $user->user_type = $userType;
            $user->approval_date = FrozenTime::now();
            $user->approval_user = $this->Auth->user('id');
    
            if ($this->Users->save($user)) {
                return $this->response->withType('application/json')
                    ->withStringBody(json_encode(['success' => '承認しました']))
                    ->withStatus(200);
            } else {
                return $this->response->withType('application/json')
                    ->withStringBody(json_encode(['error' => '承認できませんでした']))
                    ->withStatus(500);
            }
        }
        return $this->response->withType('application/json')
            ->withStringBody(json_encode(['error' => '承認できませんでした']))
            ->withStatus(404);
    }
    public function userInfo() {

    }

    public function wardManager() {
    
    }
}
