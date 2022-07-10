<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * Network Entity
 *
 * @property int $id
 * @property int|null $customer_id
 * @property int|null $parent_id
 * @property int|null $lft
 * @property int|null $rght
 * @property int|null $level
 *
 * @property \AdminPanel\Model\Entity\Customer $customer
 * @property \AdminPanel\Model\Entity\ParentNetwork $parent_network
 * @property \AdminPanel\Model\Entity\ChildNetwork[] $child_networks
 */
class Network extends Entity
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
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'level' => true,
        'customer' => true,
        'parent_network' => true,
        'child_networks' => true
    ];
}
