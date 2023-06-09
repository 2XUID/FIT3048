<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Image Entity
 *
 * @property int $image_id
 * @property string|resource $image_photo
 * @property int $inspection_id
 * @property string $image_description
 * @property bool $finishallinspection
 * @property \App\Model\Entity\Inspection $inspection
 */
class Image extends Entity
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
        'image_photo' => true,
        'inspection_id' => true,
        'inspection' => true,
        'apartment' => true,
        'image_description'=>true,
        'finishallinspection'=>true
    ];
}
