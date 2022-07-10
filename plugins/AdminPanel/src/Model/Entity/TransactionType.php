<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * TransactionType Entity
 *
 * @property int $id
 * @property string $name
 *
 * @property \AdminPanel\Model\Entity\Transaction[] $transactions
 */
class TransactionType extends Entity
{

     const BONUSNETWORK = 1;
     const BONUSCASHBACK = 2;
     const WITHDRAWAL = 3;
     const FEE = 4;
     const REFUND = 5;
     const UNALOCATEDBONUS = 6;
     const TRANSFER = 7;
     const RECEIVED = 8;
     const REWARDMEMBER = 9;
     const PENDINGBONUSINDEPENDENTSTAR = 10;
     const BREAKAWAY = 11;
     const BONUSPROMOTIONRANK= 12;

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
        'name' => true,
        'transactions' => true
    ];
}
