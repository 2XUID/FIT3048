<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Email Entity
 *
 * @property int $email_id
 * @property string $email_address
 * @property string $email_name
 * @property string $email_body
 * @property \Cake\I18n\FrozenTime|null $email_created
 * @property bool $email_sent
 */
class Email extends Entity
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
        'email_address' => true,
        'email_name' => true,
        'email_body' => true,
        'email_created' => true,
        'email_sent' => true,
    ];
}
