<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;

/**
 * Album Entity
 *
 * @property int $id
 * @property string|null $name
 *
 * @property \AdminPanel\Model\Entity\Gallery[] $galleries
 */
class Album extends Entity
{

    use TranslateTrait;
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
        'name' => true,
        'galleries' => true,
        '_translations' => true
    ];
}
