<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reward Entity
 *
 * @property int $id
 * @property int|null $rank_id
 * @property string|null $image
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Rank $rank
 * @property \AdminPanel\Model\Entity\CustomerReward[] $customer_rewards
 */
class Reward extends Entity
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
        'rank_id' => true,
        'image' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'rank' => true,
        'customer_rewards' => true
    ];
}
