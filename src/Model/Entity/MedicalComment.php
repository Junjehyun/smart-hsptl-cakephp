<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MedicalComment Entity
 *
 * @property int $id
 * @property string $customer_no
 * @property string|null $department_code
 * @property string|null $employ_id
 * @property string|null $comments
 * @property \Cake\I18n\FrozenTime $create_date
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 * @property \Cake\I18n\FrozenTime|null $deleted_at
 */
class MedicalComment extends Entity
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
        'department_code' => true,
        'employ_id' => true,
        'comments' => true,
        'create_date' => true,
        'created_at' => true,
        'updated_at' => true,
        'deleted_at' => true,
    ];
}
