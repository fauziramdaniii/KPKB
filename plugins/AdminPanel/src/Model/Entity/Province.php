<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * Province Entity
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $shipping_cost
 *
 * @property \AdminPanel\Model\Entity\CustomerAddress[] $customer_addresses
 * @property \AdminPanel\Model\Entity\Regency[] $regencies
 */
class Province extends Entity
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
        'zone' => true,
        'regencies' => true,
        'shipping_cost' => true,
    ];
}
