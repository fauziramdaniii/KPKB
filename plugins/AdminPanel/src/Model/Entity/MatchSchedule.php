<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * MatchSchedule Entity
 *
 * @property int $id
 * @property int|null $game_id
 * @property string $team_name_1
 * @property int|null $score_team_1
 * @property string $team_name_2
 * @property int|null $score_team_2
 * @property string|null $map
 * @property \Cake\I18n\FrozenTime $match_time
 * @property string|null $description
 * @property string $match_status_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Game $game
 */
class MatchSchedule extends Entity
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
        'team_name_1' => true,
        'score_team_1' => true,
        'team_name_2' => true,
        'score_team_2' => true,
        'map' => true,
        'match_time' => true,
        'description' => true,
        'match_status_id' => true,
        'created' => true,
        'modified' => true,
        'game' => true,
    ];
}
