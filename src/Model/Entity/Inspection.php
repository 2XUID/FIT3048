<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Inspection Entity
 *
 * @property int $inspection_id
 * @property \Cake\I18n\FrozenDate $inspection_datetime
 * @property int|null $user_id
 * @property int $apartment_id
 * @property string $inspection_status
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Apartment $apartment
 * @property \App\Model\Entity\Image[] $images
 */
class Inspection extends Entity
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
        'inspection_datetime' => true,
        'inspection_description'=>true,
        'user_id' => true,
        'apartment_id' => true,
        'inspection_status' => true,
        'user' => true,
        'apartment' => true,
        'images'=>true,
        'inspection_type' => true,
        'inspection_content' => true,
    ];
}
