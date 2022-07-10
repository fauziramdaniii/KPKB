<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * ParticipantStatus Entity
 *
 * @property int $id
 * @property string $name
 *
 * @property \AdminPanel\Model\Entity\FfParticipant[] $ff_participants
 * @property \AdminPanel\Model\Entity\MlParticipant[] $ml_participants
 * @property \AdminPanel\Model\Entity\PesParticipant[] $pes_participants
 * @property \AdminPanel\Model\Entity\PubgParticipant[] $pubg_participants
 * @property \AdminPanel\Model\Entity\ValorantParticipant[] $valorant_participants
 */
class ParticipantStatus extends Entity
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
        'name' => true,
        'ff_participants' => true,
        'ml_participants' => true,
        'pes_participants' => true,
        'pubg_participants' => true,
        'valorant_participants' => true,
    ];
}
