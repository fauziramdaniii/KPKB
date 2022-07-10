<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * BlogTag Entity
 *
 * @property int $id
 * @property int $blog_id
 * @property int $tag_id
 *
 * @property \AdminPanel\Model\Entity\Blog $blog
 * @property \AdminPanel\Model\Entity\Tag $tag
 */
class BlogTag extends Entity
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
        'blog_id' => true,
        'tag_id' => true,
        'blog' => true,
        'tag' => true
    ];
}
