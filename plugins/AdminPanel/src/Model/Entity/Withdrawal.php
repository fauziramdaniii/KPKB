<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * Withdrawal Entity
 *
 * @property int $id
 * @property int|null $customer_id
 * @property string|null $bank_name
 * @property string|null $bank_city
 * @property string|null $bank_branch
 * @property string|null $bank_account_name
 * @property string|null $bank_account_number
 * @property int|null $customer_bank_id
 * @property int|null $withdrawal_status_id
 * @property int|null $transaction_id
 * @property float|null $amount
 * @property string|null $note
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Customer $customer
 * @property \AdminPanel\Model\Entity\CustomerBank $customer_bank
 * @property \AdminPanel\Model\Entity\WithdrawalStatus $withdrawal_status
 * @property \AdminPanel\Model\Entity\Transaction $transaction
 */
class Withdrawal extends Entity
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
        'customer_bank_id' => true,
        'withdrawal_status_id' => true,
        'transaction_id' => true,
        'amount' => true,
        'note' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'customer_bank' => true,
        'withdrawal_status' => true,
        'transaction' => true
    ];
}
