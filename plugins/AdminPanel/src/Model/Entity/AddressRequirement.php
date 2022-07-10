<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * AddressRequirement Entity
 *
 * @property int $id
 * @property int|null $address_submission_id
 * @property string|null $name
 * @property int|null $image_id
 * @property \Cake\I18n\FrozenTime|null $created
 *
 * @property \AdminPanel\Model\Entity\AddressSubmission $address_submission
 * @property \AdminPanel\Model\Entity\Image $image
 */
class AddressRequirement extends Entity
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
        'address_submission_id' => true,
        'name' => true,
        'image_id' => true,
        'created' => true,
        'address_submission' => true,
        'image' => true,
    ];
}
