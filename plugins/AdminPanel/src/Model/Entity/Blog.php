<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;

/**
 * Blog Entity
 *
 * @property int $id
 * @property int $topic_id
 * @property int $user_id
 * @property string $content
 * @property int $view
 * @property string $image
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \AdminPanel\Model\Entity\Topic $topic
 * @property \AdminPanel\Model\Entity\User $user
 * @property \AdminPanel\Model\Entity\BlogTag[] $blog_tags
 */
class Blog extends Entity
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
        'title' => true,
        'slug' => true,
        'topic_id' => true,
        'user_id' => true,
        'content' => true,
        'view' => true,
        'image' => true,
        'created' => true,
        'modified' => true,
        'topic' => true,
        'user' => true,
//        'blog_tags' => true,
        'tags' => true,
        '_translations' => true
    ];
}
