<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LiveBagans Model
 *
 * @property \AdminPanel\Model\Table\GamesTable&\Cake\ORM\Association\BelongsTo $Games
 *
 * @method \AdminPanel\Model\Entity\LiveBagan get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\LiveBagan newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\LiveBagan[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\LiveBagan|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\LiveBagan saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\LiveBagan patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\LiveBagan[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\LiveBagan findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LiveBagansTable extends Table
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

        $this->setTable('live_bagans');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Games', [
            'foreignKey' => 'game_id',
            'className' => 'AdminPanel.Games',
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
            ->maxLength('name', 150)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('embed')
            ->requirePresence('embed', 'create')
            ->notEmptyString('embed');

        $validator
            ->scalar('link')
            ->requirePresence('link', 'create')
            ->notEmptyString('link');

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

        return $rules;
    }
}
