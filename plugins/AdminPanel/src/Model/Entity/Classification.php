<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * Classification Entity
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $type
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\AddressSubmission[] $address_submissions
 * @property \AdminPanel\Model\Entity\KiaSubmission[] $kia_submissions
 * @property \AdminPanel\Model\Entity\KkSubmission[] $kk_submissions
 * @property \AdminPanel\Model\Entity\KtpSubmission[] $ktp_submissions
 * @property \AdminPanel\Model\Entity\Requirement[] $requirements
 */
class Classification extends Entity
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
        'name' => true,
        'slug' => true,
        'type' => true,
        'created' => true,
        'modified' => true,
        'address_submissions' => true,
        'kia_submissions' => true,
        'kk_submissions' => true,
        'ktp_submissions' => true,
        'requirements' => true,
    ];
}
