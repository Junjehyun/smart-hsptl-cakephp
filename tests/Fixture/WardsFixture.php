<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * WardsFixture
 */
class WardsFixture extends TestFixture
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
                'ward_type' => 'Lo',
                'ward_code' => 'Lorem ip',
                'ward_name' => 'Lorem ipsum dolor sit amet',
                'ward_description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'coordinator_code' => 'Lor',
                'bgcolor' => 'Lorem',
                'image_name' => 'Lorem ipsum dolor sit amet',
                'remarks' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1721103170,
                'updated_at' => 1721103170,
            ],
        ];
        parent::init();
    }
}
