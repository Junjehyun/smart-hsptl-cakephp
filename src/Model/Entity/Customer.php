<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Customer Entity
 *
 * @property int $id
 * @property string $customer_no
 * @property string $name
 * @property string $sex
 * @property string|null $birthdate
 * @property string|null $telephone
 * @property string|null $address
 * @property string|null $ward_code
 * @property string|null $room_code
 * @property string|null $bed_no
 * @property string|null $blood_type
 * @property string|null $severity
 * @property string|null $fall
 * @property \Cake\I18n\FrozenTime|null $hospitalized_date
 * @property string|null $remarks
 * @property string|null $old_ward_code
 * @property string|null $old_room_code
 * @property string|null $old_bed_no
 * @property string $status
 * @property int|null $device_seq
 * @property string|null $device_name
 * @property int|null $creator_id
 * @property int|null $updater_id
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 * @property \Cake\I18n\FrozenTime|null $deleted_at
 */
class Customer extends Entity
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
        'customer_no' => true,
        'name' => true,
        'sex' => true,
        'birthdate' => true,
        'telephone' => true,
        'address' => true,
        'ward_code' => true,
        'room_code' => true,
        'bed_no' => true,
        'blood_type' => true,
        'severity' => true,
        'fall' => true,
        'hospitalized_date' => true,
        'remarks' => true,
        'old_ward_code' => true,
        'old_room_code' => true,
        'old_bed_no' => true,
        'status' => true,
        'device_seq' => true,
        'device_name' => true,
        'creator_id' => true,
        'updater_id' => true,
        'created_at' => true,
        'updated_at' => true,
        'deleted_at' => true,
    ];
}
