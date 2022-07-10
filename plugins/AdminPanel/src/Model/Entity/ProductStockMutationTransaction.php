<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductStockMutationTransaction Entity
 *
 * @property int $id
 * @property int|null $product_stock_mutation_type_id
 * @property string $description
 * @property float $amount
 *
 * @property \AdminPanel\Model\Entity\ProductStockMutation[] $product_stock_mutations
 */
class ProductStockMutationTransaction extends Entity
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
        'product_stock_mutation_type_id' => true,
        'description' => true,
        'amount' => true,
        'product_stock_mutations' => true
    ];
}
