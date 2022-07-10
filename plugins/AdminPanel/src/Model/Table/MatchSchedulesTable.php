<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MatchSchedules Model
 *
 * @property \AdminPanel\Model\Table\GamesTable&\Cake\ORM\Association\BelongsTo $Games
 * @property &\Cake\ORM\Association\BelongsTo $MatchStatuses
 *
 * @method \AdminPanel\Model\Entity\MatchSchedule get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\MatchSchedule newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\MatchSchedule[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\MatchSchedule|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\MatchSchedule saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\MatchSchedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\MatchSchedule[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\MatchSchedule findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MatchSchedulesTable extends Table
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

        $this->setTable('match_schedules');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Games', [
            'foreignKey' => 'game_id',
            'className' => 'AdminPanel.Games',
        ]);
        $this->belongsTo('MatchStatuses', [
            'foreignKey' => 'match_status_id',
            'joinType' => 'INNER',
            'className' => 'AdminPanel.MatchStatuses',
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
            ->maxLength('name', 100)
            ->allowEmptyString('name');

        $validator
            ->scalar('team_name_1')
            ->maxLength('team_name_1', 150)
            //->requirePresence('team_name_1', 'create')
            //->notEmptyString('team_name_1');
            ->allowEmptyString('team_name_1');

        $validator
            ->integer('score_team_1')
            ->allowEmptyString('score_team_1');

        $validator
            ->scalar('team_name_2')
            ->maxLength('team_name_2', 150)
            //->requirePresence('team_name_2', 'create')
            //->notEmptyString('team_name_2');
            ->allowEmptyString('team_name_2');

        $validator
            ->integer('score_team_2')
            ->allowEmptyString('score_team_2');

        $validator
            ->scalar('map')
            ->maxLength('map', 50)
            ->allowEmptyString('map');

        $validator
            ->dateTime('match_time')
            ->requirePresence('match_time', 'create')
            ->notEmptyDateTime('match_time');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['game_id'], 'Games'));
        $rules->add($rules->existsIn(['match_status_id'], 'MatchStatuses'));

        return $rules;
    }
}
