<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Master Entity
 *
 * @property int $id
 * @property string $master_key
 * @property string $master_name
 * @property string $item_code
 * @property string $item_name
 * @property string|null $item_nm_short
 * @property string|null $item_nm_eng
 * @property int|null $order
 * @property bool $use_flag
 * @property string|null $remarks
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 */
class Master extends Entity
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
        'master_key' => true,
        'master_name' => true,
        'item_code' => true,
        'item_name' => true,
        'item_nm_short' => true,
        'item_nm_eng' => true,
        'order' => true,
        'use_flag' => true,
        'remarks' => true,
        'created_at' => true,
        'updated_at' => true,
    ];
}
