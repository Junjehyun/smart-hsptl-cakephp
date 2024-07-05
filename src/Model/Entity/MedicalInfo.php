<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MedicalInfo Entity
 *
 * @property int $id
 * @property string $customer_no
 * @property string|null $department
 * @property string|null $doctor_name
 * @property string|null $department_code
 * @property string|null $severity
 * @property string|null $fall
 * @property bool $blood_warn
 * @property bool $contact_warn
 * @property bool $air_warn
 * @property bool $current_flag
 * @property string|null $remarks
 * @property int|null $creator_id
 * @property int|null $updater_id
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 * @property \Cake\I18n\FrozenTime|null $deleted_at
 */
class MedicalInfo extends Entity
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
        'department' => true,
        'doctor_name' => true,
        'department_code' => true,
        'severity' => true,
        'fall' => true,
        'blood_warn' => true,
        'contact_warn' => true,
        'air_warn' => true,
        'current_flag' => true,
        'remarks' => true,
        'creator_id' => true,
        'updater_id' => true,
        'created_at' => true,
        'updated_at' => true,
        'deleted_at' => true,
    ];
}
