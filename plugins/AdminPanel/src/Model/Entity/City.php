<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * City Entity
 *
 * @property int $id
 * @property int|null $province_id
 * @property string|null $name
 * @property string|null $type
 * @property int|null $postal_code
 *
 * @property \AdminPanel\Model\Entity\Province $province
 * @property \AdminPanel\Model\Entity\CustomerContact[] $customer_contacts
 */
class City extends Entity
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
        'province_id' => true,
        'name' => true,
        'type' => true,
        'postal_code' => true,
        'province' => true,
        'customer_contacts' => true
    ];
}
