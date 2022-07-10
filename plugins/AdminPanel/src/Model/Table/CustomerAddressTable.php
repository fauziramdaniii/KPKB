<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomerAddress Model
 *
 * @property \AdminPanel\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 * @property \AdminPanel\Model\Table\ProvincesTable|\Cake\ORM\Association\BelongsTo $Provinces
 * @property \AdminPanel\Model\Table\CitiesTable|\Cake\ORM\Association\BelongsTo $Cities
 * @property \AdminPanel\Model\Table\SubdistrictsTable|\Cake\ORM\Association\BelongsTo $Subdistricts
 *
 * @method \AdminPanel\Model\Entity\CustomerAddres get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\CustomerAddres newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\CustomerAddres[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CustomerAddres|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\CustomerAddres|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\CustomerAddres patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CustomerAddres[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CustomerAddres findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomerAddressTable extends Table
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

        $this->setTable('customer_address');
        $this->setDisplayField('receiver_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'className' => 'AdminPanel.Customers'
        ]);
        $this->belongsTo('Provinces', [
            'foreignKey' => 'province_id',
            'className' => 'AdminPanel.Provinces'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'className' => 'AdminPanel.Cities'
        ]);
        $this->belongsTo('Subdistricts', [
            'foreignKey' => 'subdistrict_id',
            'className' => 'AdminPanel.Subdistricts'
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
            ->allowEmptyString('id', 'create');

        /*$validator
            ->integer('zip')
            ->allowEmptyString('zip');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->allowEmptyString('address');

        $validator
            ->boolean('primary')
            ->allowEmptyString('primary');*/

        $validator
            ->requirePresence('zip')
            ->maxLength('zip', 5)
            ->minLength('zip', 5)
            ->numeric('zip');

        $validator
            ->requirePresence('province_id');

        $validator
            ->requirePresence('city_id');

        $validator
            ->requirePresence('subdistrict_id');

        $validator
            ->requirePresence('address');

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
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        $rules->add($rules->existsIn(['province_id'], 'Provinces'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['subdistrict_id'], 'Subdistricts'));

        return $rules;
    }
}
