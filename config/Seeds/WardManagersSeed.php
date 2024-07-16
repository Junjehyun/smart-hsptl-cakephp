<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Faker\Factory;

/**
 * WardsManagers seed.
 */
class WardManagersSeed extends AbstractSeed
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
        $faker = Factory::create('ja_JP');
        $data = [];
        $currentTimestamp = date('Y-m-d H:i:s');
        $wardCodes = [1000, 2000, 3000, 4000, 5000];

        for ($i = 1; $i <= 50; $i++) {
            $wardCode = $wardCodes[($i - 1) % 5];
            $data[] = [
                'user_id' => $i,
                'ward_code' => $wardCode,
                'creator_id' => $faker->numberBetween(0, 25), 
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp 
            ];
        }

        $table = $this->table('ward_managers');
        $table->insert($data)->save();
    }
}
