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

            //dd($data);
            //customersテーブルを取得
            $customersTable = TableRegistry::getTableLocator()->get('Customers');
            $medicalInfosTable = TableRegistry::getTableLocator()->get('MedicalInfos');
            // マスタデータを取得
            $mastersTable = TableRegistry::getTableLocator()->get('Masters');
            $bloodTypes = $mastersTable->find('all')
                ->where(['master_key' => '003', 'use_flag' => true, 'item_name !=' => '000'])
                ->order(['item_name' => 'ASC'])
                ->toArray();
            $departments = $mastersTable->find('all')
                ->where(['master_key' => '007', 'use_flag' => true, 'item_name !=' => '000'])
                ->order(['item_name' => 'ASC'])
                ->toArray();
            $severities = $mastersTable->find('all')
                ->where(['master_key' => '008', 'use_flag' => true, 'item_name !=' => '000'])
                ->order(['item_nm_short' => 'ASC'])
                ->toArray();
            $falls = $mastersTable->find('all')
                ->where(['master_key' => '009', 'use_flag' => true, 'item_name !=' => '000'])
                ->order(['item_nm_short' => 'ASC'])
                ->toArray();

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
                    ->maxLength('name', 10, '氏名は10文字以内で入力してください。')
                    //生年月日
                    ->requirePresence('birth_year', 'create')  
                    ->requirePresence('birth_month', 'create')  
                    ->requirePresence('birth_day', 'create')  
                    ->add('birthdate', 'validDate', [
                        'rule' => function ($value, $context) {
                            $year = (int)$context['data']['birth_year'];
                            $month = (int)$context['data']['birth_month'];
                            $day = (int)$context['data']['birth_day'];
                            return checkdate($month, $day, $year);
                        },
                        'message' => '有効な日付を入力してください。'
                    ])
                    //性別
                    ->requirePresence('sex', 'create', '性別は必須項目です。')
                    ->notEmptyString('sex', '性別は必須項目です。')
                    ->add('sex', 'validSex', [
                        'rule' => function ($value, $context) {
                            return in_array($value, ['M', 'F']);
                        },
                        'message' => '性別は男性か女性を選択してください。'
                    ])
                    //入院日付
                    ->requirePresence('hospitalized_date', 'create', '入院日は必須項目です。')
                    ->notEmptyDate('hospitalized_date', '入院日は必須項目です。')
                    ->add('hospitalized_date', 'validDate', [
                        'rule' => 'date',
                        'message' => '有効な日付を入力してください。'
                    ])
                    //血液型
                    ->requirePresence('blood_type', 'create', '血液型は必須項目です。')
                    ->notEmptyString('blood_type', '血液型は必須項目です。')
                    ->add('blood_type', 'validBloodType', [
                        'rule' => function ($value, $context) use ($bloodTypes) {
                            // 有効な血液型を取得
                            $validBloodTypes = array_map(function($bloodType) {
                                return $bloodType->item_code;
                            }, $bloodTypes);
                            return in_array($value, $validBloodTypes);
                        },
                        'message' => '有効な血液型を選択してください。'
                    ])
                    //電話番号
                    ->requirePresence('telephone', 'create', '電話番号は必須項目です。')
                    ->notEmptyString('telephone', '電話番号は必須項目です。')
                    ->add('telephone', [
                        'validFormat' => [
                            'rule' => function ($value, $context) {
                                return ctype_digit($value);
                            },
                            'message' => '電話番号は数字のみを入力してください。'
                        ]
                    ])
                    //診療科
                    ->requirePresence('department', 'create', '診療科は必須項目です。')
                    ->notEmptyString('department', '診療科は必須項目です。')
                    ->add('department', 'validDepartment', [
                        'rule' => function ($value, $context) use ($departments) {
                            $validDepartments = array_map(function($department) {
                                return $department->item_code;
                            }, $departments);
                            return in_array($value, $validDepartments);
                        },
                        'message' => '有効な診療科を選択してください。'
                    ])
                    //担当医
                    ->requirePresence('doctor_name', 'create', '担当医は必須項目です。')
                    ->notEmptyString('doctor_name', '担当医は必須項目です。')
                    ->maxLength('doctor_name', 10, '担当医は10文字以内で入力してください。')
                    //重症度
                    ->requirePresence('severity', 'create', '重症度は必須項目です。')
                    ->notEmptyString('severity', '重症度は必須項目です。')
                    ->add('severity', 'validSeverity', [
                        'rule' => function ($value, $context) use ($severities) {
                            $validSeverities = array_map(function($severity) {
                                return $severity->item_code;
                            }, $severities);
                            return in_array($value, $validSeverities);
                        },
                        'message' => '有効な重症度を選択してください。'
                    ])
                    //落傷
                    ->requirePresence('fall', 'create', '落傷は必須項目です。')
                    ->notEmptyString('fall', '落傷は必須項目です。')
                    ->add('fall', 'validFall', [
                        'rule' => function ($value, $context) use ($falls) {
                            $validFalls = array_map(function($fall) {
                                return $fall->item_code;
                            }, $falls);
                            return in_array($value, $validFalls);
                        },
                        'message' => '有効な落傷を選択してください。'
                    ])
                    ;
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
                    'doctor_name' => $data['doctor_name'],
                    'blood_warn' => !empty($data['blood_warn']),
                    'contact_warn' => !empty($data['contact_warn']),
                    'air_warn' => !empty($data['air_warn']),
                    'remarks' => $data['remarks']
                ]);
                if ($customersTable->save($customer) && $medicalInfosTable->save($medicalInfo)) {
                    $this->Flash->success(__('新しい患者が登録されました。'));
                    return $this->redirect(['action' => 'kanjaList']);
                } else {
                    // 保存失敗時のエラーメッセージを取得してViewに設定
                    $errors = $customer->getErrors() + $medicalInfo->getErrors();
                    $this->set('errors', $errors);
                }
            } else {
                $this->set('errors', $errors);
            }
            $this->set('data', $data);
        } else {
            // マスタデータを取得
            $mastersTable = TableRegistry::getTableLocator()->get('Masters');
            $bloodTypes = $mastersTable->find('all')
                ->where(['master_key' => '003', 'use_flag' => true, 'item_name !=' => '000'])
                ->order(['item_name' => 'ASC'])
                ->toArray();
    
            $this->set(compact('bloodTypes'));
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

    /**
     * 患者詳細画面
     * @param mixed $id
     * @return void
     */
    public function kanjaShow($customer_no) {

        $customersTable = TableRegistry::getTableLocator()->get('Customers');
        $customer = $customersTable->find()
        ->where(['Customers.customer_no' => $customer_no])
        ->contain(['MedicalInfos'])
        ->firstOrFail();
    
        /**
         * @var mixed $mastersTable マスタデータを取得
         * @var mixed $bloodTypes 血液型マスタ
         * @var mixed $departments 診療科マスタ
         * @var mixed $severities 重症度マスタ
         * @var mixed $falls 落傷マスタ
         * @var mixed $customer 患者情報
         */
        $mastersTable = TableRegistry::getTableLocator()->get('Masters');
        $bloodTypes = $mastersTable->find('list', [
            'keyField' => 'item_code',
            'valueField' => 'item_name'
        ])->where(['master_key' => '003'])->toArray();
    
        $departments = $mastersTable->find('list', [
            'keyField' => 'item_code',
            'valueField' => 'item_name'
        ])->where(['master_key' => '007'])->toArray();
    
        $severities = $mastersTable->find('list', [
            'keyField' => 'item_code',
            'valueField' => 'item_nm_short'
        ])->where(['master_key' => '008'])->toArray();
    
        $falls = $mastersTable->find('list', [
            'keyField' => 'item_code',
            'valueField' => 'item_nm_short'
        ])->where(['master_key' => '009'])->toArray();

        /**
         * 表示用のプロパティを追加
         * @var mixed $customer 患者情報
         */
        $customer->severity_display = $severities[$customer->severity] ?? $customer->severity;
        $customer->fall_display = $falls[$customer->fall] ?? $customer->fall;

          // コメントを取得
        $commentsTable = TableRegistry::getTableLocator()->get('MedicalComments');

        if ($this->request->is('post')) {
            $commentData = $this->request->getData();
            $commentData['customer_no'] = $customer_no;
            $commentData['create_date'] = date('Y-m-d H:i:s');
    
            $comment = $commentsTable->newEntity($commentData);
            if ($commentsTable->save($comment)) {
                $this->Flash->success('コメントが登録されました。');
            } else {
                $this->Flash->error('コメントの登録に失敗しました。');
            }
            return $this->redirect(['action' => 'kanjaShow', $customer_no]);
        }

        $comments = $commentsTable->find()
            ->where(['customer_no' => $customer_no])
            ->order(['create_date' => 'DESC'])
            ->all();
    
        $this->set(compact('customer', 'bloodTypes', 'departments', 'severities', 'falls', 'comments'));
    }
    /**
     * 患者情報更新画面
     * 
     * @param mixed $customer_no
     * @return void
     */
    public function kanjaEdit($customer_no) {

        $customersTable = TableRegistry::getTableLocator()->get('Customers');
        $medicalInfosTable = TableRegistry::getTableLocator()->get('MedicalInfos');
        $customer = $customersTable->find()
            ->where(['Customers.customer_no' => $customer_no])
            ->contain(['MedicalInfos'])
            ->firstOrFail();
        
        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();

            //validation check
            //생년월일
            //성별
            //입원날짜
            //혈액형
            //전화번호
            //진료과
            //담당의
            //중증도
            //낙상

            // 接続注意、血液、空気注意のチェックボックスの値を確認
            $data['medical_info']['contact_warn'] = isset($data['medical_info']['contact_warn']) ? true : false;
            $data['medical_info']['blood_warn'] = isset($data['medical_info']['blood_warn']) ? true : false;
            $data['medical_info']['air_warn'] = isset($data['medical_info']['air_warn']) ? true : false;

            $data['birthdate'] = $data['birth_year'] . sprintf('%02d', $data['birth_month']) . sprintf('%02d', $data['birth_day']);

            $customer = $customersTable->patchEntity($customer, $data);
            $medicalInfo = $medicalInfosTable->patchEntity($customer->medical_info, $data);
            
            if ($customersTable->save($customer) && $medicalInfosTable->save($medicalInfo)) {
                $this->Flash->success('患者情報が更新されました。');
                return $this->redirect(['action' => 'kanjaList', $customer_no]);
            } else {
                $this->Flash->error('情報の更新に失敗しました。もう一度お試しください。');
            }
        }
        // マスターデータ取得
        $mastersTable = TableRegistry::getTableLocator()->get('Masters');
        $bloodTypes = $mastersTable->find('list', [
            'keyField' => 'item_code',
            'valueField' => 'item_name'
        ])->where(['master_key' => '003', 'item_name !=' => '000'])->toArray();
    
        $departments = $mastersTable->find('list', [
            'keyField' => 'item_code',
            'valueField' => 'item_name'
        ])->where(['master_key' => '007', 'item_name !=' => '000'])->toArray();
    
        $severities = $mastersTable->find('list', [
            'keyField' => 'item_code',
            'valueField' => 'item_nm_short'
        ])->where(['master_key' => '008', 'item_name !=' => '000'])->toArray();
    
        $falls = $mastersTable->find('list', [
            'keyField' => 'item_code',
            'valueField' => 'item_nm_short'
        ])->where(['master_key' => '009', 'item_name !=' => '000'])->toArray();
    
        $this->set(compact('customer', 'bloodTypes', 'departments', 'severities', 'falls'));

    }
}