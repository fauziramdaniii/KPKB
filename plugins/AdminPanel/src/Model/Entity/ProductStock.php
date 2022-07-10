<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductStock Entity
 *
 * @property int $id
 * @property int $product_id
 * @property int|null $supplier_id
 * @property float $quantity
 *
 * @property \AdminPanel\Model\Entity\Product $product
 * @property \AdminPanel\Model\Entity\ProductStockMutation[] $product_stock_mutations
 */
class ProductStock extends Entity
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
        'product_id' => true,
        'supplier_id' => true,
        'quantity' => true,
        'product' => true,
        'product_stock_mutations' => true,
    ];
}
