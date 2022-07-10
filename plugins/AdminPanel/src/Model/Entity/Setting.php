<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * Setting Entity
 *
 * @property int $id
 * @property string|null $title_slide
 * @property string|null $description_slide
 * @property string $title_section1
 * @property string $shadow_title_section1
 * @property string $description_section1
 * @property string $icon_process1_section1
 * @property string $title_process1_section1
 * @property string $description_process1_section1
 * @property string $icon_process2_section1
 * @property string $title_process2_section1
 * @property string $description_process2_section1
 * @property string $icon_process3_section1
 * @property string $title_process3_section1
 * @property string $description_process3_section1
 * @property string $image
 * @property string $link_promo_video
 * @property string|null $title_promo_video
 * @property string|null $description_promo_video
 */
class Setting extends Entity
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
        'title_slide' => true,
        'description_slide' => true,
        'title_section1' => true,
        'shadow_title_section1' => true,
        'description_section1' => true,
        'icon_process1_section1' => true,
        'title_process1_section1' => true,
        'description_process1_section1' => true,
        'icon_process2_section1' => true,
        'title_process2_section1' => true,
        'description_process2_section1' => true,
        'icon_process3_section1' => true,
        'title_process3_section1' => true,
        'description_process3_section1' => true,
        'image' => true,
        'link_promo_video' => true,
        'title_promo_video' => true,
        'description_promo_video' => true,
    ];
}
