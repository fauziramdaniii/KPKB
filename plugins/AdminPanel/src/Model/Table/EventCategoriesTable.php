<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventCategories Model
 *
 * @property \AdminPanel\Model\Table\EventsTable&\Cake\ORM\Association\HasMany $Events
 *
 * @method \AdminPanel\Model\Entity\EventCategory get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\EventCategory newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\EventCategory[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\EventCategory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\EventCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\EventCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\EventCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\EventCategory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventCategoriesTable extends Table
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

        $this->setTable('event_categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Events', [
            'foreignKey' => 'event_category_id',
            'className' => 'AdminPanel.Events',
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
            ->maxLength('name', 255)
            ->requirePresence('name');

        return $validator;
    }
}
