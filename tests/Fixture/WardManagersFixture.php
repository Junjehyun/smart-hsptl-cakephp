<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * WardManagersFixture
 */
class WardManagersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 1,
                'ward_code' => 'Lorem ip',
                'creator_id' => 1,
                'created_at' => 1721103656,
                'updated_at' => 1721103656,
            ],
        ];
        parent::init();
    }
}
