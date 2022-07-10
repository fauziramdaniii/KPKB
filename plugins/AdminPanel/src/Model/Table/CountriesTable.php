<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Countries Model
 *
 * @method \AdminPanel\Model\Entity\Country get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Country newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Country[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Country|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Country|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Country patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Country[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Country findOrCreate($search, callable $callback = null, $options = [])
 */
class CountriesTable extends Table
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

        $this->setTable('countries');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('iso')
            ->maxLength('iso', 2)
            ->requirePresence('iso', 'create')
            ->allowEmptyString('iso', false);

        $validator
            ->scalar('name')
            ->maxLength('name', 80)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        $validator
            ->scalar('nicename')
            ->maxLength('nicename', 80)
            ->requirePresence('nicename', 'create')
            ->allowEmptyString('nicename', false);

        $validator
            ->scalar('iso3')
            ->maxLength('iso3', 3)
            ->requirePresence('iso3', 'create')
            ->allowEmptyString('iso3', false);

        $validator
            ->integer('numcode')
            ->requirePresence('numcode', 'create')
            ->allowEmptyString('numcode', false);

        $validator
            ->integer('phonecode')
            ->requirePresence('phonecode', 'create')
            ->allowEmptyString('phonecode', false);

        return $validator;
    }
}
