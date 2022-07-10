<?php
namespace AdminPanel\Model\Entity;

use Cake\ORM\Entity;

/**
 * Requirement Entity
 *
 * @property int $id
 * @property int|null $classification_id
 * @property string $name
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \AdminPanel\Model\Entity\Classification $classification
 */
class Requirement extends Entity
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
        'classification_id' => true,
        'name' => true,
        'created' => true,
        'modified' => true,
        'classification' => true,
    ];
}
