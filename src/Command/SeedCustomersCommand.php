<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\BaseCommand;
use Cake\Console\ConsoleIo;
use Cake\ORM\TableRegistry;

class SeedCustomersCommand extends BaseCommand {
    public function execute(Arguments $args, ConsoleIo $io) {
        // 患者テーブルを取得
        $customersTable = TableRegistry::getTableLocator()->get('Customers');

        // 患者データを追加
        $data = [
            ['customer_no' => 'C001', 'name' => '山田 太郎', 'sex' => 'M', 'birthdate' => '19800101', 'telephone' => '090-1234-5678', 'address' => '東京都新宿区1-1-1', 'status' => '01', 'room_code' => '101', 'blood_type' => 'A', 'severity' => '1', 'fall' => '0'],
            ['customer_no' => 'C002', 'name' => '鈴木 花子', 'sex' => 'F', 'birthdate' => '19900202', 'telephone' => '090-2345-6789', 'address' => '東京都渋谷区2-2-2', 'status' => '01', 'room_code' => '102', 'blood_type' => 'B', 'severity' => '2', 'fall' => '1'],
            ['customer_no' => 'C003', 'name' => '佐藤 次郎', 'sex' => 'M', 'birthdate' => '19850303', 'telephone' => '090-3456-7890', 'address' => '東京都港区3-3-3', 'status' => '01', 'room_code' => '103', 'blood_type' => 'O', 'severity' => '3', 'fall' => '0'],
            ['customer_no' => 'C004', 'name' => '高橋 美奈子', 'sex' => 'F', 'birthdate' => '19750404', 'telephone' => '090-4567-8901', 'address' => '東京都品川区4-4-4', 'status' => '01', 'room_code' => '104', 'blood_type' => 'AB', 'severity' => '1', 'fall' => '1'],
            ['customer_no' => 'C005', 'name' => '伊藤 太一', 'sex' => 'M', 'birthdate' => '19820505', 'telephone' => '090-5678-9012', 'address' => '東京都目黒区5-5-5', 'status' => '01', 'room_code' => '105', 'blood_type' => 'A', 'severity' => '2', 'fall' => '0'],
            ['customer_no' => 'C006', 'name' => '渡辺 さゆり', 'sex' => 'F', 'birthdate' => '19950606', 'telephone' => '090-6789-0123', 'address' => '東京都大田区6-6-6', 'status' => '01', 'room_code' => '106', 'blood_type' => 'B', 'severity' => '3', 'fall' => '1'],
            ['customer_no' => 'C007', 'name' => '中村 健', 'sex' => 'M', 'birthdate' => '19920707', 'telephone' => '090-7890-1234', 'address' => '東京都世田谷区7-7-7', 'status' => '01', 'room_code' => '107', 'blood_type' => 'O', 'severity' => '1', 'fall' => '0'],
            ['customer_no' => 'C008', 'name' => '小林 優子', 'sex' => 'F', 'birthdate' => '19880808', 'telephone' => '090-8901-2345', 'address' => '東京都杉並区8-8-8', 'status' => '01', 'room_code' => '108', 'blood_type' => 'AB', 'severity' => '2', 'fall' => '1'],
            ['customer_no' => 'C009', 'name' => '加藤 勇', 'sex' => 'M', 'birthdate' => '19810909', 'telephone' => '090-9012-3456', 'address' => '東京都豊島区9-9-9', 'status' => '01', 'room_code' => '109', 'blood_type' => 'A', 'severity' => '3', 'fall' => '0'],
            ['customer_no' => 'C010', 'name' => '田中 愛', 'sex' => 'F', 'birthdate' => '19831010', 'telephone' => '090-0123-4567', 'address' => '東京都北区10-10-10', 'status' => '01', 'room_code' => '110', 'blood_type' => 'B', 'severity' => '1', 'fall' => '1'],
        ];

        foreach ($data as $entry) {
            $customer = $customersTable->newEntity($entry);
            if ($customersTable->save($customer)) {
                $io->out('患者名 ' . $customer->name . ' 保存されました。');
            } else {
                $io->err('患者の保存が失敗しました。' . $entry['name']);
            }
        }
    }
}