<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SmartTag Entity
 *
 * @property int $id
 * @property string $tag_id
 * @property string|null $mac_address
 * @property string|null $tag_location
 * @property string|null $tag_location_nm
 * @property string|null $tag_type
 * @property string|null $gateway_ip
 * @property string|null $job_type
 * @property string|null $job_result
 * @property string|null $battery_charge_rate
 * @property string|null $temperature
 * @property string|null $receive_power
 * @property string|null $version
 * @property bool $use_flag
 * @property string|null $old_tag_location
 * @property string|null $old_tag_location_nm
 * @property \Cake\I18n\FrozenTime|null $latest_update
 * @property int|null $creator_id
 * @property int|null $updater_id
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 * @property \Cake\I18n\FrozenTime|null $deleted_at
 */
class SmartTag extends Entity
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
        'tag_id' => true,
        'mac_address' => true,
        'tag_location' => true,
        'tag_location_nm' => true,
        'tag_type' => true,
        'gateway_ip' => true,
        'job_type' => true,
        'job_result' => true,
        'battery_charge_rate' => true,
        'temperature' => true,
        'receive_power' => true,
        'version' => true,
        'use_flag' => true,
        'old_tag_location' => true,
        'old_tag_location_nm' => true,
        'latest_update' => true,
        'creator_id' => true,
        'updater_id' => true,
        'created_at' => true,
        'updated_at' => true,
        'deleted_at' => true,
    ];
}
