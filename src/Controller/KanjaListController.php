<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\ORM\Query;

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

        //medical_infoテーブルからdepartment,doctor_nameカラムをLeftJoin
        // $query = $customersTable->find()
        //     ->select(['Customers.customer_no', 'Customers.name', 'Customers.sex', 'Customers.birthdate', 'Customers.room_code', 'Customers.blood_type', 'Customers.severity', 'Customers.fall', 'MedicalInfos.department', 'MedicalInfos.doctor_name'])
        //     ->leftJoinWith('MedicalInfos', function ($q) {
        //         return $q->where(['MedicalInfos.customer_no = Customers.customer_no']);
        //     });
        $query = $customersTable->find()->contain(['MedicalInfos']);

        //クエリ生成
        //$query = $customersTable->find('all');
        
        if($searchKanja) {
            $query->where([
                'OR' => [
                    'Customers.customer_no LIKE' => '%'. $searchKanja . '%',
                    'Customers.name LIKE' => '%'. $searchKanja . '%',
                ]    
            ]);
        }

        $customers = $query->toArray();

        $this->set(compact('customers', 'searchKanja'));
    }
}