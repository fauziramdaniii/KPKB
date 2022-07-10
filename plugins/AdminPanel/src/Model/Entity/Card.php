<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * Card Entity
 *
 * @property int $id
 * @property string|null $card_number
 * @property string|null $serial
 * @property string|null $pin
 * @property int|null $stockist_id
 * @property int|null $customer_id
 * @property int|null $stock_type
 * @property int|null $card_status_id
 * @property int|null $product_id
 * @property int|null $supplier_id
 * @property int|null $card_type_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\CardStatus $card_status
 * @property \AdminPanel\Model\Entity\CardType $card_type
 * @property \AdminPanel\Model\Entity\Product $product
 * @property \AdminPanel\Model\Entity\Customer $customer
 * @property \AdminPanel\Model\Entity\RepeatOrder $repeat_order
 * @property \AdminPanel\Model\Entity\OrderDetailSerial $order_detail_serial
 */
class Card extends Entity
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
        'card_number' => true,
        'serial' => true,
        'pin' => true,
        'stockist_id' => true,
        'customer_id' => true,
        'stock_type' => true,
        'card_status_id' => true,
        'product_id' => true,
        'supplier_id' => true,
        'card_type_id' => true,
        'created' => true,
        'modified' => true,
        'card_status' => true,
        'card_type' => true,
        'product' => true,
        'customer' => true,
        'repeat_order' => true,
        'order_detail_serial' => true,
    ];
}
