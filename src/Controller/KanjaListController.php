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

        //クエリ生成
        $query = $customersTable->find('all');
        
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