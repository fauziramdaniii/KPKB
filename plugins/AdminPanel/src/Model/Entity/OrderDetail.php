<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderDetail Entity
 *
 * @property int $id
 * @property int|null $order_id
 * @property int|null $product_id
 * @property int|null $qty
 * @property float|null $price
 * @property float|null $total
 * @property float|null $weight
 * @property float|null $total_weight
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Order $order
 * @property \AdminPanel\Model\Entity\Product $product
 * @property \AdminPanel\Model\Entity\OrderDetailSerial[] $order_detail_serials
 */
class OrderDetail extends Entity
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
        'order_id' => true,
        'product_id' => true,
        'qty' => true,
        'price' => true,
        'total' => true,
        'weight' => true,
        'total_weight' => true,
        'created' => true,
        'modified' => true,
        'order' => true,
        'product' => true,
        'order_detail_serials' => true
    ];
}
