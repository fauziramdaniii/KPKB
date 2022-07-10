<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Games Model
 *
 * @property \AdminPanel\Model\Table\FfParticipantsTable&\Cake\ORM\Association\HasMany $FfParticipants
 * @property \AdminPanel\Model\Table\LiveBagansTable&\Cake\ORM\Association\HasMany $LiveBagans
 * @property \AdminPanel\Model\Table\MatchSchedulesTable&\Cake\ORM\Association\HasMany $MatchSchedules
 * @property \AdminPanel\Model\Table\MlParticipantsTable&\Cake\ORM\Association\HasMany $MlParticipants
 * @property \AdminPanel\Model\Table\PesParticipantsTable&\Cake\ORM\Association\HasMany $PesParticipants
 * @property \AdminPanel\Model\Table\PubgParticipantsTable&\Cake\ORM\Association\HasMany $PubgParticipants
 * @property \AdminPanel\Model\Table\ValorantParticipantsTable&\Cake\ORM\Association\HasMany $ValorantParticipants
 *
 * @method \AdminPanel\Model\Entity\Game get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Game newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Game[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Game|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Game saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Game patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Game[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Game findOrCreate($search, callable $callback = null, $options = [])
 */
class GamesTable extends Table
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

        $this->setTable('games');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('FfParticipants', [
            'foreignKey' => 'game_id',
            'className' => 'AdminPanel.FfParticipants',
        ]);
        $this->hasMany('LiveBagans', [
            'foreignKey' => 'game_id',
            'className' => 'AdminPanel.LiveBagans',
        ]);
        $this->hasMany('MatchSchedules', [
            'foreignKey' => 'game_id',
            'className' => 'AdminPanel.MatchSchedules',
        ]);
        $this->hasMany('MlParticipants', [
            'foreignKey' => 'game_id',
            'className' => 'AdminPanel.MlParticipants',
        ]);
        $this->hasMany('PesParticipants', [
            'foreignKey' => 'game_id',
            'className' => 'AdminPanel.PesParticipants',
        ]);
        $this->hasMany('PubgParticipants', [
            'foreignKey' => 'game_id',
            'className' => 'AdminPanel.PubgParticipants',
        ]);
        $this->hasMany('ValorantParticipants', [
            'foreignKey' => 'game_id',
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

        $validator
            ->integer('max_participant')
            ->allowEmptyString('max_participant');

        return $validator;
    }
}
