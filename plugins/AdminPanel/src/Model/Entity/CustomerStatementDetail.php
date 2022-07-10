<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomerStatementDetail Entity
 *
 * @property int $id
 * @property int|null $customer_statement_id
 * @property int|null $customer_id
 * @property int|null $cash_point_claim_id
 * @property int|null $sequence
 * @property int|null $year
 * @property int|null $month
 * @property float|null $amount
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Customer $customer
 * @property \AdminPanel\Model\Entity\CashPointClaim $cash_point_claim
 * @property \AdminPanel\Model\Entity\CustomerStatement $customer_statement
 */
class CustomerStatementDetail extends Entity
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
        'customer_statement_id' => true,
        'customer_id' => true,
        'cash_point_claim_id' => true,
        'sequence' => true,
        'year' => true,
        'month' => true,
        'amount' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'cash_point_claim' => true,
        'customer_statement' => true,
    ];
}
