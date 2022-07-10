<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomerBank Entity
 *
 * @property int $id
 * @property int|null $customer_id
 * @property int|null $bank_id
 * @property string|null $branch
 * @property string|null $city
 * @property string|null $account_name
 * @property string|null $account_number
 * @property \Cake\I18n\FrozenTime|null $deleted
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Customer $customer
 * @property \AdminPanel\Model\Entity\Bank $bank
 * @property \AdminPanel\Model\Entity\Withdrawal[] $withdrawals
 */
class CustomerBank extends Entity
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
        'bank_id' => true,
        'branch' => true,
        'city' => true,
        'account_name' => true,
        'account_number' => true,
        'deleted' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'bank' => true,
        'withdrawals' => true
    ];
}
