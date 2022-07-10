<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * CashPointClaim Entity
 *
 * @property int $id
 * @property int|null $customer_id
 * @property \Cake\I18n\FrozenDate|null $claim_date
 * @property \Cake\I18n\FrozenDate|null $expired_date
 * @property float|null $total
 *
 * @property \AdminPanel\Model\Entity\Customer $customer
 * @property \AdminPanel\Model\Entity\CashPoint[] $cash_points
 * @property \AdminPanel\Model\Entity\CustomerStatementDetail[] $customer_statement_details
 * @property \AdminPanel\Model\Entity\CustomerStatement[] $customer_statements
 */
class CashPointClaim extends Entity
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
        'claim_date' => true,
        'expired_date' => true,
        'total' => true,
        'customer' => true,
        'cash_points' => true,
        'customer_statement_details' => true,
        'customer_statements' => true,
    ];
}
