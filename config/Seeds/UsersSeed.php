<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\ORM\TableRegistry;

/**
 * UsersSeed seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $this->table('users')->truncate();

        // ユーザー名のリスト
        $firstNames = ['太郎', '次郎', '三郎', '四郎', '五郎', '花子', '梅子', '松子', '竹子', '桃子'];
        $lastNames = ['佐藤', '鈴木', '高橋', '田中', '渡辺', '伊藤', '山本', '中村', '小林', '加藤'];

        // 部署リストをMastersテーブルから取得
        $departmentsTable = TableRegistry::getTableLocator()->get('Masters');
        $departments = $departmentsTable->find('list', [
            'keyField' => 'item_code',
            'valueField' => 'item_name'
            ])->where(['master_key' => '007'])->toArray();

        // ユーザー生成
        $data = [];
        for($i = 1; $i <= 10; $i++) {
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $fullName = $lastName . ' ' . $firstName;

            $data[] = [
                'name' => $fullName,
                'email' => "kanri{$i}@example.com",
                'password' => password_hash("password{$i}", PASSWORD_DEFAULT),
                'department' => array_rand($departments),
                'roles' => '001', 
                'user_type' => '000', 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
