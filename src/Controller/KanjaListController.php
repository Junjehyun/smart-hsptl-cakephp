<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Validation\Validator;
use Cake\Validation\Validation;
use Cake\ORM\TableRegistry;
class KanjaListController extends AppController {

    /**
     * 患者一覧画面（検索機能含め）
     * 
     * @return \Cake\Http\Response|null 患者一覧画面
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

         // 추가: departments 리스트 조회
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
                    ->requirePresence('name', 'create')
                    ->notEmptyString('name', '氏名は必須項目です。')
                    ->maxLength('name', 10, '氏名は10文字以内で入力してください。');

            $errors = $validator->validate($data);

            // if (empty($errors)) {
            //     // 유효성 검사를 통과한 경우
            //     $this->Flash->success(__('新しい患者が登録されました。'));
            //     return $this->redirect(['action' => 'kanjaList']);
            // } else {
            //     // 유효성 검사 실패 시 오류 메시지 설정
            //     //$this->Flash->error(__('入力内容に誤りがあります。もう一度確認してください。'));
            //     $this->set('errors', $errors);
            // }

            // if ($customersTable->save($customer) && $medicalInfosTable->save($medicalInfo)) {

            //         $this->Flash->success(__('新しい患者が登録されました。'));
            //         return $this->redirect(['action' => 'kanjaList']);
            //     } else {
            //         // エラーメッセージを取得
            //         $errors = $customer->getErrors();
                    
            //         $this->Flash->error(__('患者の登録に失敗しました。もう一度やり直してください。'));
            //         //$this->set('errors', $customer->getErrors() + $medicalInfo->getErrors());
            //         $this->set(compact('customer', 'medicalInfo'));
            //     }
            if (empty($errors)) {
                // 유효성 검사를 통과한 경우
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
                    'doctor_name' => $data['doctor_name'],
                    'severity' => $data['severity'],
                    'fall' => $data['fall']
                ]);
    
                if ($customersTable->save($customer) && $medicalInfosTable->save($medicalInfo)) {
                    $this->Flash->success(__('新しい患者が登録されました。'));
                    return $this->redirect(['action' => 'kanjaList']);
                } else {
                    // 저장 실패 시 에러 메시지를 가져와서 뷰에 설정
                    $errors = $customer->getErrors() + $medicalInfo->getErrors();
                    $this->Flash->error(__('患者の登録に失敗しました。もう一度やり直してください。'));
                    $this->set('errors', $errors);
                }
            } else {
                // 유효성 검사 실패 시 오류 메시지 설정
                $this->Flash->error(__('入力内容に誤りがあります。もう一度確認してください。'));
                $this->set('errors', $errors);
            }
        }

        // MastersTableを取得
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