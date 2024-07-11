<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FacilitiesFixture
 */
class FacilitiesFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'owner_name' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'logo_image_name' => 'Lorem ipsum dolor sit amet',
                'logo_short_image_name' => 'Lorem ipsum dolor sit amet',
                'background_image_name' => 'Lorem ipsum dolor sit amet',
                'banner_display_flag' => 1,
                'layout_no' => 'Lo',
                'room_layout_no' => 'Lo',
                'bed_layout_no' => 'Lo',
                'status' => 'Lo',
                'license_count' => 1,
                'lang_type' => 'Lo',
                'creator_id' => 1,
                'updater_id' => 1,
                'created_at' => 1720702628,
                'updated_at' => 1720702628,
                'deleted_at' => 1720702628,
            ],
        ];
        parent::init();
    }
}
