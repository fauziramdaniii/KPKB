<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * KiaRequirement Entity
 *
 * @property int $id
 * @property int|null $kia_submission_id
 * @property string|null $name
 * @property int|null $image_id
 * @property \Cake\I18n\FrozenTime|null $created
 *
 * @property \AdminPanel\Model\Entity\KiaSubmission $kia_submission
 * @property \AdminPanel\Model\Entity\Image $image
 */
class KiaRequirement extends Entity
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
        'kia_submission_id' => true,
        'name' => true,
        'image_id' => true,
        'created' => true,
        'kia_submission' => true,
        'image' => true,
    ];
}
