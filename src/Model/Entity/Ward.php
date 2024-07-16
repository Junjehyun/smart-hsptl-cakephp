<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ward Entity
 *
 * @property int $id
 * @property string $ward_type
 * @property string $ward_code
 * @property string $ward_name
 * @property string|null $ward_description
 * @property string|null $coordinator_code
 * @property string|null $bgcolor
 * @property string|null $image_name
 * @property string|null $remarks
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 */
class Ward extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'ward_type' => true,
        'ward_code' => true,
        'ward_name' => true,
        'ward_description' => true,
        'coordinator_code' => true,
        'bgcolor' => true,
        'image_name' => true,
        'remarks' => true,
        'created_at' => true,
        'updated_at' => true,
    ];
}
