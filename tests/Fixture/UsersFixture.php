<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'email' => 'Lorem ipsum dolor sit amet',
                'email_verified_at' => 1721102662,
                'password' => 'Lorem ipsum dolor sit amet',
                'two_factor_secret' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'two_factor_recovery_codes' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'two_factor_confirmed_at' => 1721102662,
                'remember_token' => 'Lorem ipsum dolor sit amet',
                'current_team_id' => 1,
                'profile_photo_path' => 'Lorem ipsum dolor sit amet',
                'telephone' => 'Lorem ipsum do',
                'department' => 'Lorem ipsum dolor sit amet',
                'employ_id' => 'Lorem ipsum dolor sit amet',
                'roles' => 'L',
                'user_type' => 'L',
                'approval_date' => 1721102662,
                'approval_user' => 1,
                'last_activity_date' => 1721102662,
                'visit_count' => 1,
                'wards_in_charge' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1721102662,
                'updated_at' => 1721102662,
                'deleted_at' => 1721102662,
            ],
        ];
        parent::init();
    }
}
