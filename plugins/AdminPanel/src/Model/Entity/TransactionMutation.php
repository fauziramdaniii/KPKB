<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * TransactionMutation Entity
 *
 * @property int $id
 * @property int|null $customer_id
 * @property int|null $transaction_id
 * @property float|null $amount
 * @property float|null $balance
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Customer $customer
 * @property \AdminPanel\Model\Entity\Transaction $transaction
 */
class TransactionMutation extends Entity
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
        'transaction_id' => true,
        'amount' => true,
        'balance' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'transaction' => true
    ];
}
