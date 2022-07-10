<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 *
 * @property \AdminPanel\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \AdminPanel\Model\Table\EventCategoriesTable&\Cake\ORM\Association\BelongsTo $EventCategories
 * @property \AdminPanel\Model\Table\EventAttendancesTable&\Cake\ORM\Association\HasMany $EventAttendances
 *
 * @method \AdminPanel\Model\Entity\Event get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Event newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Event[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Event|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Event saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Event patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Event[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Event findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventsTable extends Table
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

        $this->setTable('events');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'AdminPanel.Users',
        ]);
        $this->belongsTo('EventCategories', [
            'foreignKey' => 'event_category_id',
            'className' => 'AdminPanel.EventCategories',
        ]);
        $this->hasMany('EventAttendances', [
            'foreignKey' => 'event_id',
            'className' => 'AdminPanel.EventAttendances',
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
            ->scalar('title')
            ->maxLength('title', 50)
            ->allowEmptyString('title');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description');

        $validator
            ->dateTime('start')
            ->allowEmptyDateTime('start');

        $validator
            ->dateTime('end')
            ->allowEmptyDateTime('end');

        $validator
            ->scalar('classname')
            ->maxLength('classname', 255)
            ->allowEmptyString('classname');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['event_category_id'], 'EventCategories'));

        return $rules;
    }
}
