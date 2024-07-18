<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SmartTagsFixture
 */
class SmartTagsFixture extends TestFixture
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
                'tag_id' => 'Lorem ipsum do',
                'mac_address' => 'Lorem ipsum dolor sit amet',
                'tag_location' => 'Lorem ipsum dolor sit amet',
                'tag_location_nm' => 'Lorem ipsum dolor sit amet',
                'tag_type' => 'Lo',
                'gateway_ip' => 'Lorem ipsum dolor sit amet',
                'job_type' => 'Lorem ipsum do',
                'job_result' => 'Lorem ipsum do',
                'battery_charge_rate' => 'Lorem ',
                'temperature' => 'Lorem ',
                'receive_power' => 'Lorem ',
                'version' => 'Lorem ',
                'use_flag' => 1,
                'old_tag_location' => 'Lorem ipsum dolor sit amet',
                'old_tag_location_nm' => 'Lorem ipsum dolor sit amet',
                'latest_update' => 1721282566,
                'creator_id' => 1,
                'updater_id' => 1,
                'created_at' => 1721282566,
                'updated_at' => 1721282566,
                'deleted_at' => 1721282566,
            ],
        ];
        parent::init();
    }
}
