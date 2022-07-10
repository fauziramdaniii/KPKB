<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * KkRequirement Entity
 *
 * @property int $id
 * @property int|null $kk_submission_id
 * @property string|null $name
 * @property int|null $image_id
 * @property \Cake\I18n\FrozenTime|null $created
 *
 * @property \AdminPanel\Model\Entity\KkSubmission $kk_submission
 * @property \AdminPanel\Model\Entity\Image $image
 */
class KkRequirement extends Entity
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
        'kk_submission_id' => true,
        'name' => true,
        'image_id' => true,
        'created' => true,
        'kk_submission' => true,
        'image' => true,
    ];
}
