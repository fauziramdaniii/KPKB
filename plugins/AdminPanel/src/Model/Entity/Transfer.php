<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transfer Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property int $target_customer_id
 * @property int|null $transaction_id
 * @property int|null $status
 * @property float|null $amount
 * @property float|null $fee
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Customer $customer
 * @property \AdminPanel\Model\Entity\TargetCustomer $target_customer
 * @property \AdminPanel\Model\Entity\Transaction $transaction
 */
class Transfer extends Entity
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
        'target_customer_id' => true,
        'transaction_id' => true,
        'status' => true,
        'amount' => true,
        'fee' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'target_customer' => true,
        'transaction' => true
    ];
}
