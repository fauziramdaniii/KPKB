<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property int $card_type_id
 * @property string $name
 * @property string $sku
 * @property int $product_unit_id
 * @property string $description
 * @property double $bonus_pribadi
 * @property double $bonus_strata_1
 * @property double $bonus_strata_2
 * @property double $bonus_strata_3
 * @property float $price
 * @property float|null $stokist_price
 * @property int $point
 * @property int $on_sales
 * @property float|null $weight
 * @property string|null $image
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\ProductUnit $product_unit
 * @property \AdminPanel\Model\Entity\CardType $card_type
 * @property \AdminPanel\Model\Entity\ProductStockMutation[] $product_stock_mutations
 * @property \AdminPanel\Model\Entity\ProductStock $product_stock
 * @property \AdminPanel\Model\Entity\Card[] $cards
 */
class Product extends Entity
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
        'card_type_id' => true,
        'name' => true,
        'sku' => true,
        'product_unit_id' => true,
        'description' => true,
        'price' => true,
        'stokist_price' => true,
        'point' => true,
        'on_sales' => true,
        'weight' => true,
        'image' => true,
        'created' => true,
        'modified' => true,
        'bonus_pribadi' => true,
        'bonus_strata_1' => true,
        'bonus_strata_2' => true,
        'bonus_strata_3' => true,
        'product_unit' => true,
        'card_type' => true,
        'product_stock_mutations' => true,
        'product_stock' => true,
        'cards' => true,
    ];
}
