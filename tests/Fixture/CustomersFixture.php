<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CustomersFixture
 */
class CustomersFixture extends TestFixture
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
                'customer_no' => 'Lorem ipsum dolor sit amet',
                'name' => 'Lorem ipsum dolor sit amet',
                'sex' => 'Lo',
                'birthdate' => 'Lorem ',
                'telephone' => 'Lorem ipsum dolor sit amet',
                'address' => 'Lorem ipsum dolor sit amet',
                'ward_code' => 'Lorem ip',
                'room_code' => 'Lorem ip',
                'bed_no' => 'Lor',
                'blood_type' => 'Lo',
                'severity' => 'Lorem ',
                'fall' => 'Lorem ',
                'hospitalized_date' => 1720081899,
                'remarks' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'old_ward_code' => 'Lorem ip',
                'old_room_code' => 'Lorem ip',
                'old_bed_no' => 'Lor',
                'status' => 'Lo',
                'device_seq' => 1,
                'device_name' => 'Lorem ipsum dolor sit amet',
                'creator_id' => 1,
                'updater_id' => 1,
                'created_at' => 1720081899,
                'updated_at' => 1720081899,
                'deleted_at' => 1720081899,
            ],
        ];
        parent::init();
    }
}
