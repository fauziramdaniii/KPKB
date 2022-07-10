<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transaction Entity
 *
 * @property int $id
 * @property int|null $transaction_type_id
 * @property string|null $txid
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\TransactionType $transaction_type
 * @property \AdminPanel\Model\Entity\TransactionMutation[] $transaction_mutations
 */
class Transaction extends Entity
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
        'transaction_type_id' => true,
        'txid' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'transaction_type' => true,
        'transaction_mutations' => true
    ];
}
