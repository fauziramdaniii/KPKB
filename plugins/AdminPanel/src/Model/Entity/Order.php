<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property string|null $invoice
 * @property string|null $awb
 * @property int|null $order_status_id
 * @property int|null $stockist_customer_id
 * @property int|null $customer_id
 * @property int|null $province_id
 * @property int|null $city_id
 * @property int|null $stock_type
 * @property int|null $supplier_id
 * @property int|null $flag
 * @property string|null $address
 * @property string|null $recipient_name
 * @property string|null $secret_key
 * @property string|null $courrier
 * @property string|null $courrier_type
 * @property string|null $recipient_phone
 * @property string|null $zip
 * @property string|null $notes
 * @property float|null $gross_total
 * @property float|null $base_price
 * @property float|null $shipping_cost
 * @property boolean $is_freeshipping
 * @property float|null $total_weight
 * @property float|null $total
 * @property \Cake\I18n\FrozenTime|null $deleted
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $confirm_date
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\OrderStatus $order_status
 * @property \AdminPanel\Model\Entity\StockistCustomer $stockist_customer
 * @property \AdminPanel\Model\Entity\Customer $customer
 * @property \AdminPanel\Model\Entity\Province $province
 * @property \AdminPanel\Model\Entity\City $city
 * @property \AdminPanel\Model\Entity\OrderDetail[] $order_details
 * @property \AdminPanel\Model\Entity\OrderConfirmation $order_confirmation
 */
class Order extends Entity
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
        'invoice' => true,
        'awb' => true,
        'secret_key' => true,
        'order_status_id' => true,
        'stockist_customer_id' => true,
        'customer_id' => true,
        'province_id' => true,
        'city_id' => true,
        'address' => true,
        'notes' => true,
        'supplier_id' => true,
        'recipient_name' => true,
        'recipient_phone' => true,
        'gross_total' => true,
        'base_price' => true,
        'subdistrict_id' => true,
        'shipping_cost' => true,
        'is_freeshipping' => true,
        'courrier' => true,
        'courrier_type' => true,
        'total_weight' => true,
        'total' => true,
        'deleted' => true,
        'confirm_date' => true,
        'stock_type' => true,
        'created' => true,
        'modified' => true,
        'order_status' => true,
        'stockist_customer' => true,
        'customer' => true,
        'province' => true,
        'zip' => true,
        'flag' => true,
        'city' => true,
        'order_details' => true
    ];
}
