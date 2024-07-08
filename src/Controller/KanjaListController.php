<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
class KanjaListController extends AppController {

    /**
     * 患者一覧画面（検索機能含め）
     * 
     * @return \Cake\Http\Response|null 患者一覧画面
     * @throws \Cake\Http\Exception\NotFoundException 患者が見つからない場合の例外
     * @throws \Cake\Http\Exception\MethodNotAllowedException メソッドが許可されていない場合の例外
     */
    public function kanjaList() {
        // 患者一覧画面を表示
        $customersTable = TableRegistry::getTableLocator()->get('Customers');
        $customers = $customersTable->find('all')->toArray();

        //検索クエリ
        $searchKanja = $this->request->getQuery('searchKanja');

        // MastersTableを取得
        $mastersTable = TableRegistry::getTableLocator()->get('Masters');

        // 重症度マスタと落傷マスタを取得してマッピング作成
        $severitiesList = $mastersTable->find('list', [
            'keyField' => 'item_code',
            'valueField' => 'item_nm_short'
        ])->where(['master_key' => '008'])->toArray();

        $fallsList = $mastersTable->find('list', [
            'keyField' => 'item_code',
            'valueField' => 'item_nm_short'
        ])->where(['master_key' => '009'])->toArray();

        $bloodTypeList = $mastersTable->find('list', [
            'keyField' => 'item_code',
            'valueField' => 'item_name'
        ])->where(['master_key' => '003'])->toArray(); 

         // 診療科マスタを取得
        $departmentsList = $mastersTable->find('list', [
            'keyField' => 'item_code',
            'valueField' => 'item_name'
        ])->where(['master_key' => '007'])->toArray();

        $query = $customersTable->find()
                ->contain(['MedicalInfos'])
                ->order(['Customers.id' => 'ASC']);

        if($searchKanja) {
            $query->where([
                'OR' => [
                    'Customers.customer_no LIKE' => '%'. $searchKanja . '%',
                    'Customers.name LIKE' => '%'. $searchKanja . '%',
                ]    
            ]);
        }

        $customers = $query->toArray();

        $this->set(compact('customers', 'searchKanja', 'severitiesList', 'fallsList', 'bloodTypeList', 'departmentsList'));

    }

    /**
     * 患者新規登録画面
     * 
     * @return \Cake\Http\Response|null 患者新規登録画面
     */
    public function kanjaCreate() {

        if ($this->request->is('post')) {

            $data = $this->request->getData();

            // 生年月日を結合
            $data['birthdate'] = $data['birth_year'] . sprintf('%02d', $data['birth_month']) . sprintf('%02d', $data['birth_day']);
            
            //customersテーブルを取得
            $customersTable = TableRegistry::getTableLocator()->get('Customers');
            $medicalInfosTable = TableRegistry::getTableLocator()->get('MedicalInfos');

            // customer_noの最後のレコードを取得
            $lastCustomer = $customersTable->find('all', [
                'order' => ['customer_no' => 'DESC']
            ])->first();

            if ($lastCustomer) {
                // 最後の患者番号を取得
                $lastCustomerNo = (int)substr($lastCustomer->customer_no, 1);
                // 新しい患者番号を設定
                $data['customer_no'] = 'C' . str_pad((string)($lastCustomerNo + 1), 3, '0', STR_PAD_LEFT);
            } else {
                // 初めての患者の場合
                $data['customer_no'] = 'C001';
            }

            $customer = $customersTable->newEntity($data);

            $medicalInfo = $medicalInfosTable->newEntity([
                'customer_no' => $data['customer_no'],
                'department' => $data['department'],
                'doctor_name' => $data['doctor_name']
            ]);

            $validator = new Validator();
            $validator
                    //氏名
                    ->requirePresence('name', 'create')
                    ->notEmptyString('name', '氏名は必須項目です。')
                    ->maxLength('name', 10, '氏名は10文字以内で入力してください。');
                    //生年月日
                    //性別
                    //入院日付
                    //血液型
                    //電話番号
                    //診療科
                    //担当医
                    //重症度
                    //落傷

            $errors = $validator->validate($data);

            if (empty($errors)) {
                // Validation検査を通過した場合
                $customersTable = TableRegistry::getTableLocator()->get('Customers');
                $medicalInfosTable = TableRegistry::getTableLocator()->get('MedicalInfos');
    
                $lastCustomer = $customersTable->find('all', ['order' => ['customer_no' => 'DESC']])->first();
                if ($lastCustomer) {
                    $lastCustomerNo = (int)substr($lastCustomer->customer_no, 1);
                    $data['customer_no'] = 'C' . str_pad((string)($lastCustomerNo + 1), 3, '0', STR_PAD_LEFT);
                } else {
                    $data['customer_no'] = 'C001';
                }
    
                $customer = $customersTable->newEntity($data);
                $medicalInfo = $medicalInfosTable->newEntity([
                    'customer_no' => $data['customer_no'],
                    'department' => $data['department'],
                    'doctor_name' => $data['doctor_name']
                ]);
    
                if ($customersTable->save($customer) && $medicalInfosTable->save($medicalInfo)) {
                    $this->Flash->success(__('新しい患者が登録されました。'));
                    return $this->redirect(['action' => 'kanjaList']);
                } else {
                    // 保存失敗時のエラーメッセージを取得してViewに設定
                    $errors = $customer->getErrors() + $medicalInfo->getErrors();
                    //$this->Flash->error(__('患者の登録に失敗しました。もう一度やり直してください。'));
                    $this->set('errors', $errors);
                }
            } else {
                // validationエラーがある場合、エラーメッセージを取得してViewに設定
                //$this->Flash->error(__('入力内容に誤りがあります。もう一度確認してください。'));
                $this->set('errors', $errors);
            }
        }

        /**
         * マスタデータを取得
         * @var mixed $bloodTypes 血液型マスタ
         * @var mixed $departments 診療科マスタ
         * @var mixed $severities 重症度マスタ
         * @var mixed $falls 落傷マスタ
         */
        $mastersTable = TableRegistry::getTableLocator()->get('Masters');
        // 血液型マスタを取得
        $bloodTypes = $mastersTable->find('all')
                                    ->where(['master_key' => '003', 'use_flag' => true, 'item_name !=' => '000'])
                                    ->order(['item_name' => 'ASC'])
                                    ->toArray();
        // 診療科マスタを取得
        $departments = $mastersTable->find('all')
                                    ->where(['master_key' => '007', 'use_flag' => true, 'item_name !=' => '000'])
                                    ->order(['item_name' => 'ASC'])
                                    ->toArray();
        //　重症度マスタを取得
        $severities = $mastersTable->find('all')
                                    ->where(['master_key' => '008', 'use_flag' => true, 'item_name !=' => '000'])
                                    ->order(['item_nm_short' => 'ASC'])
                                    ->toArray();
        // 落傷マスタを取得
        $falls = $mastersTable->find('all')
                            ->where(['master_key' => '009', 'use_flag' => true, 'item_name !=' => '000'])
                            ->order(['item_nm_short' => 'ASC'])
                            ->toArray();
        // Viewにデータを渡す
        $this->set(compact('bloodTypes', 'departments', 'severities', 'falls'));
    
    }
}