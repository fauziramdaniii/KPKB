<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * LiveBagan Entity
 *
 * @property int $id
 * @property int|null $game_id
 * @property string $name
 * @property string $embed
 * @property string $link
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Game $game
 */
class LiveBagan extends Entity
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
        'game_id' => true,
        'name' => true,
        'embed' => true,
        'link' => true,
        'created' => true,
        'modified' => true,
        'game' => true,
    ];
}
