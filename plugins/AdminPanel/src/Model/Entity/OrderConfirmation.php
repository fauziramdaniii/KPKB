<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderConfirmation Entity
 *
 * @property int $id
 * @property int|null $customer_id
 * @property int|null $order_id
 * @property int|null $customer_bank_id
 * @property float|null $amount
 * @property \Cake\I18n\FrozenTime|null $confirmation_date
 * @property int|null $image_id
 * @property string|null $note
 * @property string|null $destination_bank
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Customer $customer
 * @property \AdminPanel\Model\Entity\Order $order
 * @property \AdminPanel\Model\Entity\Bank $bank
 * @property \AdminPanel\Model\Entity\Image $image
 */
class OrderConfirmation extends Entity
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
        'order_id' => true,
        'customer_bank_id' => true,
        'amount' => true,
        'confirmation_date' => true,
        'destination_bank' => true,
        'image_id' => true,
        'note' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'order' => true,
        'bank' => true,
        'image' => true
    ];
}
