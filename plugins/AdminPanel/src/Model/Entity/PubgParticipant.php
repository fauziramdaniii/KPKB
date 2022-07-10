<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * PubgParticipant Entity
 *
 * @property int $id
 * @property int|null $game_id
 * @property string $team_name
 * @property string $person_in_charge
 * @property string $phone
 * @property string $email
 * @property string $document
 * @property string $participant_status_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Game $game
 */
class PubgParticipant extends Entity
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
        'team_name' => true,
        'person_in_charge' => true,
        'phone' => true,
        'email' => true,
        'document' => true,
        'participant_status_id' => true,
        'created' => true,
        'modified' => true,
        'game' => true,
    ];
}
