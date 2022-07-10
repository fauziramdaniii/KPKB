<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomerStatement Entity
 *
 * @property int $id
 * @property int|null $customer_id
 * @property \Cake\I18n\FrozenTime|null $statement_date
 * @property float|null $point
 * @property float|null $amount
 * @property float|null $total
 * @property float|null $fee
 * @property string|null $bank_name
 * @property string|null $bank_city
 * @property string|null $bank_branch
 * @property string|null $bank_account_name
 * @property string|null $bank_account_number
 * @property int|null $status
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Customer $customer
 * @property \AdminPanel\Model\Entity\CustomerStatementDetail[] $customer_statement_details
 */
class CustomerStatement extends Entity
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
        'statement_date' => true,
        'point' => true,
        'amount' => true,
        'total' => true,
        'fee' => true,
        'bank_name' => true,
        'bank_city' => true,
        'bank_branch' => true,
        'bank_account_name' => true,
        'bank_account_number' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'customer_statement_details' => true,
    ];
}
