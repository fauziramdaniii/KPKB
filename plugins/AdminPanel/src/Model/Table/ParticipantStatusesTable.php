<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ParticipantStatuses Model
 *
 * @property \AdminPanel\Model\Table\FfParticipantsTable&\Cake\ORM\Association\HasMany $FfParticipants
 * @property \AdminPanel\Model\Table\MlParticipantsTable&\Cake\ORM\Association\HasMany $MlParticipants
 * @property \AdminPanel\Model\Table\PesParticipantsTable&\Cake\ORM\Association\HasMany $PesParticipants
 * @property \AdminPanel\Model\Table\PubgParticipantsTable&\Cake\ORM\Association\HasMany $PubgParticipants
 * @property \AdminPanel\Model\Table\ValorantParticipantsTable&\Cake\ORM\Association\HasMany $ValorantParticipants
 *
 * @method \AdminPanel\Model\Entity\ParticipantStatus get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\ParticipantStatus newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\ParticipantStatus[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\ParticipantStatus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\ParticipantStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\ParticipantStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\ParticipantStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\ParticipantStatus findOrCreate($search, callable $callback = null, $options = [])
 */
class ParticipantStatusesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('participant_statuses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('FfParticipants', [
            'foreignKey' => 'participant_status_id',
            'className' => 'AdminPanel.FfParticipants',
        ]);
        $this->hasMany('MlParticipants', [
            'foreignKey' => 'participant_status_id',
            'className' => 'AdminPanel.MlParticipants',
        ]);
        $this->hasMany('PesParticipants', [
            'foreignKey' => 'participant_status_id',
            'className' => 'AdminPanel.PesParticipants',
        ]);
        $this->hasMany('PubgParticipants', [
            'foreignKey' => 'participant_status_id',
            'className' => 'AdminPanel.PubgParticipants',
        ]);
        $this->hasMany('ValorantParticipants', [
            'foreignKey' => 'participant_status_id',
            'className' => 'AdminPanel.ValorantParticipants',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
