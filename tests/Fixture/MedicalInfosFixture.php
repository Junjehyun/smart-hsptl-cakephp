<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MedicalInfosFixture
 */
class MedicalInfosFixture extends TestFixture
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
                'department' => 'Lorem ipsum dolor sit amet',
                'doctor_name' => 'Lorem ipsum dolor sit amet',
                'department_code' => 'Lorem ',
                'severity' => 'Lorem ',
                'fall' => 'Lorem ',
                'blood_warn' => 1,
                'contact_warn' => 1,
                'air_warn' => 1,
                'current_flag' => 1,
                'remarks' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'creator_id' => 1,
                'updater_id' => 1,
                'created_at' => 1720142992,
                'updated_at' => 1720142992,
                'deleted_at' => 1720142992,
            ],
        ];
        parent::init();
    }
}
