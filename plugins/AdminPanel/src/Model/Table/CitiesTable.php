<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cities Model
 *
 * @property \AdminPanel\Model\Table\ProvincesTable|\Cake\ORM\Association\BelongsTo $Provinces
 * @property \AdminPanel\Model\Table\CustomerContactsTable|\Cake\ORM\Association\HasMany $CustomerContacts
 *
 * @method \AdminPanel\Model\Entity\City get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\City newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\City[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\City|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\City|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\City patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\City[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\City findOrCreate($search, callable $callback = null, $options = [])
 */
class CitiesTable extends Table
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

        $this->setTable('cities');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Provinces', [
            'foreignKey' => 'province_id',
            'className' => 'AdminPanel.Provinces'
        ]);
        $this->hasMany('CustomerContacts', [
            'foreignKey' => 'city_id',
            'className' => 'AdminPanel.CustomerContacts'
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

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->allowEmptyString('name');

        $validator
            ->scalar('type')
            ->maxLength('type', 200)
            ->allowEmptyString('type');

        $validator
            ->integer('postal_code')
            ->allowEmptyString('postal_code');

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
        $rules->add($rules->existsIn(['province_id'], 'Provinces'));

        return $rules;
    }
}
