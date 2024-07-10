<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MedicalCommentsFixture
 */
class MedicalCommentsFixture extends TestFixture
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
                'department_code' => 'Lorem ',
                'employ_id' => 'Lorem ipsum dolor sit amet',
                'comments' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'create_date' => 1720586572,
                'created_at' => 1720586572,
                'updated_at' => 1720586572,
                'deleted_at' => 1720586572,
            ],
        ];
        parent::init();
    }
}
