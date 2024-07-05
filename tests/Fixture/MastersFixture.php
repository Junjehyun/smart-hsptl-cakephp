<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MastersFixture
 */
class MastersFixture extends TestFixture
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
                'master_key' => 'L',
                'master_name' => 'Lorem ipsum dolor sit amet',
                'item_code' => 'Lor',
                'item_name' => 'Lorem ipsum dolor sit amet',
                'item_nm_short' => 'Lorem ipsum dolor sit amet',
                'item_nm_eng' => 'Lorem ipsum dolor sit amet',
                'order' => 1,
                'use_flag' => 1,
                'remarks' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created_at' => 1720154416,
                'updated_at' => 1720154416,
            ],
        ];
        parent::init();
    }
}
