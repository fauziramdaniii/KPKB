<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventAttendance Entity
 *
 * @property int $id
 * @property int|null $event_id
 * @property int|null $customer_id
 * @property int|null $confirm
 * @property bool|null $present
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Event $event
 * @property \AdminPanel\Model\Entity\Customer $customer
 */
class EventAttendance extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'event_id' => true,
        'customer_id' => true,
        'confirm' => true,
        'present' => true,
        'created' => true,
        'modified' => true,
        'event' => true,
        'customer' => true,
    ];
}
