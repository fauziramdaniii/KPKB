<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomerAddres Entity
 *
 * @property int $id
 * @property int|null $customer_id
 * @property int|null $province_id
 * @property int|null $city_id
 * @property int|null $subdistrict_id
 * @property int|null $zip
 * @property string|null $address
 * @property string|null $receiver_name
 * @property string|null $receiver_phone
 * @property bool|null $primary
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Customer $customer
 * @property \AdminPanel\Model\Entity\Province $province
 * @property \AdminPanel\Model\Entity\City $city
 * @property \AdminPanel\Model\Entity\Subdistrict $subdistrict
 */
class CustomerAddres extends Entity
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
        'customer_id' => true,
        'province_id' => true,
        'city_id' => true,
        'subdistrict_id' => true,
        'zip' => true,
        'address' => true,
        'primary' => true,
        'receiver_phone' => true,
        'receiver_name' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'province' => true,
        'city' => true,
        'subdistrict' => true
    ];
}
