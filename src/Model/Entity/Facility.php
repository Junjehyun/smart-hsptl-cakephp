<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Facility Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $owner_name
 * @property string|null $description
 * @property string|null $logo_image_name
 * @property string|null $logo_short_image_name
 * @property string|null $background_image_name
 * @property bool $banner_display_flag
 * @property string|null $layout_no
 * @property string|null $room_layout_no
 * @property string|null $bed_layout_no
 * @property string $status
 * @property int $license_count
 * @property string $lang_type
 * @property int|null $creator_id
 * @property int|null $updater_id
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 * @property \Cake\I18n\FrozenTime|null $deleted_at
 */
class Facility extends Entity
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
        'owner_name' => true,
        'description' => true,
        'logo_image_name' => true,
        'logo_short_image_name' => true,
        'background_image_name' => true,
        'banner_display_flag' => true,
        'layout_no' => true,
        'room_layout_no' => true,
        'bed_layout_no' => true,
        'status' => true,
        'license_count' => true,
        'lang_type' => true,
        'creator_id' => true,
        'updater_id' => true,
        'created_at' => true,
        'updated_at' => true,
        'deleted_at' => true,
    ];
}
