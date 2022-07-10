<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductStockMutation Entity
 *
 * @property int $id
 * @property int $product_stock_mutation_transaction_id
 * @property int $product_id
 * @property int $product_stock_id
 * @property float $qty_in
 * @property float $qty_out
 * @property float $total_qty
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\ProductStockMutationTransaction $product_stock_mutation_transaction
 * @property \AdminPanel\Model\Entity\Product $product
 * @property \AdminPanel\Model\Entity\ProductStock $product_stock
 */
class ProductStockMutation extends Entity
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
        'product_stock_mutation_transaction_id' => true,
        'product_id' => true,
        'product_stock_id' => true,
        'qty_in' => true,
        'qty_out' => true,
        'total_qty' => true,
        'product_stock_mutation_transaction' => true,
        'product' => true,
        'product_stock' => true,
        'created' => true,
        'modified' => true
    ];
}
