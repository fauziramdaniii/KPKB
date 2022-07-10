<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * PesParticipant Entity
 *
 * @property int $id
 * @property int|null $game_id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $ktp
 * @property string $bukti_vaksin
 * @property string $participant_status_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Game $game
 */
class PesParticipant extends Entity
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
        'phone' => true,
        'email' => true,
        'ktp' => true,
        'bukti_vaksin' => true,
        'participant_status_id' => true,
        'created' => true,
        'modified' => true,
        'game' => true,
    ];
}
