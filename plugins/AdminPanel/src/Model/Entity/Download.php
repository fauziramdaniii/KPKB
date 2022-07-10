<?php
namespace AdminPanel\Model\Entity;

//use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;

/**
 * Download Entity
 *
 * @property int $id
 * @property int|null $download_category_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $name
 * @property string|null $dir
 * @property int|null $size
 * @property string|null $type
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \AdminPanel\Model\Entity\DownloadCategory $download_category
 */
class Download extends Entity
{

//    use TranslateTrait;
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
        'download_category_id' => true,
        'title' => true,
        'description' => true,
        'name' => true,
        'dir' => true,
        'size' => true,
        'type' => true,
        'created' => true,
        'download_category' => true,
//        '_translations' => true
    ];
}
