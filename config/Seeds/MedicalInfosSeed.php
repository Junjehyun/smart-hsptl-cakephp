<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * MedicalInfos seed.
 */
class MedicalInfosSeed extends AbstractSeed
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
        $data = [
            [
                'customer_no' => 'C001',
                'department' => '循環器科',
                'doctor_name' => '鈴木医師',
                'department_code' => 'CD',
                'severity' => '1',
                'fall' => 'N',
                'blood_warn' => false,
                'contact_warn' => false,
                'air_warn' => false,
                'current_flag' => true,
                'remarks' => '問題なし',
                'creator_id' => 1,
                'updater_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'customer_no' => 'C002',
                'department' => '消化器科',
                'doctor_name' => '佐藤医師',
                'department_code' => 'GE',
                'severity' => '2',
                'fall' => 'N',
                'blood_warn' => false,
                'contact_warn' => false,
                'air_warn' => false,
                'current_flag' => true,
                'remarks' => '定期検診',
                'creator_id' => 1,
                'updater_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'customer_no' => 'C003',
                'department' => '内科',
                'doctor_name' => '高橋医師',
                'department_code' => 'IM',
                'severity' => '3',
                'fall' => 'Y',
                'blood_warn' => true,
                'contact_warn' => true,
                'air_warn' => true,
                'current_flag' => true,
                'remarks' => '注意が必要',
                'creator_id' => 1,
                'updater_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'customer_no' => 'C004',
                'department' => '外科',
                'doctor_name' => '山田医師',
                'department_code' => 'SR',
                'severity' => '2',
                'fall' => 'N',
                'blood_warn' => false,
                'contact_warn' => true,
                'air_warn' => false,
                'current_flag' => true,
                'remarks' => '術後経過観察',
                'creator_id' => 1,
                'updater_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'customer_no' => 'C005',
                'department' => '小児科',
                'doctor_name' => '中村医師',
                'department_code' => 'PD',
                'severity' => '1',
                'fall' => 'N',
                'blood_warn' => false,
                'contact_warn' => false,
                'air_warn' => true,
                'current_flag' => true,
                'remarks' => '健康診断',
                'creator_id' => 1,
                'updater_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'customer_no' => 'C006',
                'department' => '耳鼻咽喉科',
                'doctor_name' => '井上医師',
                'department_code' => 'EN',
                'severity' => '3',
                'fall' => 'Y',
                'blood_warn' => true,
                'contact_warn' => true,
                'air_warn' => false,
                'current_flag' => true,
                'remarks' => '重症患者',
                'creator_id' => 1,
                'updater_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'customer_no' => 'C007',
                'department' => '皮膚科',
                'doctor_name' => '松本医師',
                'department_code' => 'DR',
                'severity' => '2',
                'fall' => 'N',
                'blood_warn' => false,
                'contact_warn' => true,
                'air_warn' => true,
                'current_flag' => true,
                'remarks' => '定期チェック',
                'creator_id' => 1,
                'updater_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'customer_no' => 'C008',
                'department' => '眼科',
                'doctor_name' => '木村医師',
                'department_code' => 'OP',
                'severity' => '1',
                'fall' => 'N',
                'blood_warn' => false,
                'contact_warn' => false,
                'air_warn' => true,
                'current_flag' => true,
                'remarks' => '問題なし',
                'creator_id' => 1,
                'updater_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'customer_no' => 'C009',
                'department' => '精神科',
                'doctor_name' => '林医師',
                'department_code' => 'PS',
                'severity' => '3',
                'fall' => 'Y',
                'blood_warn' => true,
                'contact_warn' => true,
                'air_warn' => true,
                'current_flag' => true,
                'remarks' => '注意が必要',
                'creator_id' => 1,
                'updater_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'customer_no' => 'C010',
                'department' => '整形外科',
                'doctor_name' => '清水医師',
                'department_code' => 'OR',
                'severity' => '2',
                'fall' => 'N',
                'blood_warn' => false,
                'contact_warn' => true,
                'air_warn' => false,
                'current_flag' => true,
                'remarks' => '定期検査',
                'creator_id' => 1,
                'updater_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('medical_infos');
        $table->insert($data)->save();
    }
}
