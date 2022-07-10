<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * CashPoint Entity
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $customer_id
 * @property int|null $from_customer_id
 * @property string|null $description
 * @property float|null $cash_point
 * @property int|null $cash_point_claim_id
 * @property \Cake\I18n\FrozenTime|null $confirm_date
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Product $product
 * @property \AdminPanel\Model\Entity\Customer $customer
 * @property \AdminPanel\Model\Entity\FromCustomer $from_customer
 * @property \AdminPanel\Model\Entity\CashPointClaim $cash_point_claim
 */
class CashPoint extends Entity
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
        'product_id' => true,
        'customer_id' => true,
        'from_customer_id' => true,
        'description' => true,
        'cash_point' => true,
        'cash_point_claim_id' => true,
        'confirm_date' => true,
        'created' => true,
        'modified' => true,
        'product' => true,
        'customer' => true,
        'from_customer' => true,
        'cash_point_claim' => true,
    ];
}
