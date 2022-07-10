<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * Gallery Entity
 *
 * @property int $id
 * @property int|null $album_id
 * @property int|null $image_id
 * @property string|null $title
 * @property string|null $slug
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \AdminPanel\Model\Entity\Album $album
 */
class Gallery extends Entity
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
        'album_id' => true,
        'image_id' => true,
        'title' => true,
        'slug' => true,
        'created' => true,
        'album' => true
    ];
}
