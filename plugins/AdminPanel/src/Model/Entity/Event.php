<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property int $id
 * @property int $event_category_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $location
 * @property \Cake\I18n\FrozenTime|null $start
 * @property \Cake\I18n\FrozenTime|null $end
 * @property string|null $classname
 * @property int|null $user_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\User $user
 * @property \AdminPanel\Model\Entity\EventCategory $event_category
 * @property \AdminPanel\Model\Entity\EventAttendance[] $event_attendances
 */
class Event extends Entity
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
        'event_category_id' => true,
        'title' => true,
        'description' => true,
        'location' => true,
        'start' => true,
        'end' => true,
        'classname' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'event_category' => true,
        'event_attendances' => true,
    ];
}
