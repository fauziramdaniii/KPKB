<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MatchStatuses Model
 *
 * @property \AdminPanel\Model\Table\MatchSchedulesTable&\Cake\ORM\Association\HasMany $MatchSchedules
 *
 * @method \AdminPanel\Model\Entity\MatchStatus get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\MatchStatus newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\MatchStatus[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\MatchStatus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\MatchStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\MatchStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\MatchStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\MatchStatus findOrCreate($search, callable $callback = null, $options = [])
 */
class MatchStatusesTable extends Table
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

        $this->setTable('match_statuses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('MatchSchedules', [
            'foreignKey' => 'match_status_id',
            'className' => 'AdminPanel.MatchSchedules',
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
