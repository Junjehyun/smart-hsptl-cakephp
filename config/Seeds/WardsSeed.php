<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * WardsSeed seed.
 */
class WardsSeed extends AbstractSeed
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
                'ward_code' => '1000', 
                'ward_name' => '一般病棟1000', 
                'ward_description' => '一般的な病棟です。',
                'coordinator_code' => 'CELBU',
                'bgcolor' => '#02e073',
                'image_name' => 'image1.jpg',
                'remarks' => '患者のための一般病棟です。',
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'ward_code' => '2000',
                'ward_name' => '一般病棟2000',
                'ward_description' => '一般的な病棟です。',
                'coordinator_code' => 'L529D',
                'bgcolor' => '#1b7093', 
                'image_name' => 'image2.jpg', 
                'remarks' => '患者のための一般病棟です。',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'ward_code' => '3000',
                'ward_name' => '集中治療室3000',
                'ward_description' => '集中治療を提供する病棟です。', 
                'coordinator_code' => '0IW04', 
                'bgcolor' => '#a7f510', 
                'image_name' => 'image3.jpg', 
                'remarks' => '重症患者のための集中治療室です。',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
                ],
            [
                'ward_code' => '4000',
                'ward_name' => '集中治療室4000',
                'ward_description' => '集中治療を提供する病棟です。', 
                'coordinator_code' => '1OV94', 
                'bgcolor' => '#e8b425', 
                'image_name' => 'image4.jpg', 
                'remarks' => '重症患者のための集中治療室です。',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'ward_code' => '5000',
                'ward_name' => '一般病棟5000',
                'ward_description' => '一般的な病棟です。', 
                'coordinator_code' => 'YWY6I', 
                'bgcolor' => '#bade42', 
                'image_name' => 'image5.jpg', 
                'remarks' => '患者のための一般病棟です。',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];

        $table = $this->table('wards');
        $table->insert($data)->save();
    }
}
