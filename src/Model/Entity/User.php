<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Cake\I18n\FrozenTime|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property \Cake\I18n\FrozenTime|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property string|null $telephone
 * @property string|null $department
 * @property string|null $employ_id
 * @property string|null $roles
 * @property string $user_type
 * @property \Cake\I18n\FrozenTime|null $approval_date
 * @property int|null $approval_user
 * @property \Cake\I18n\FrozenTime|null $last_activity_date
 * @property int|null $visit_count
 * @property string|null $wards_in_charge
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 * @property \Cake\I18n\FrozenTime|null $deleted_at
 */
class User extends Entity
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
        'name' => true,
        'email' => true,
        'email_verified_at' => true,
        'password' => true,
        'two_factor_secret' => true,
        'two_factor_recovery_codes' => true,
        'two_factor_confirmed_at' => true,
        'remember_token' => true,
        'current_team_id' => true,
        'profile_photo_path' => true,
        'telephone' => true,
        'department' => true,
        'employ_id' => true,
        'roles' => true,
        'user_type' => true,
        'approval_date' => true,
        'approval_user' => true,
        'last_activity_date' => true,
        'visit_count' => true,
        'wards_in_charge' => true,
        'created_at' => true,
        'updated_at' => true,
        'deleted_at' => true,

        'ward_code' => true,
        'Wards' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];
}
