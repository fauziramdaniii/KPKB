<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subdistricts Model
 *
 * @property \AdminPanel\Model\Table\CitiesTable&\Cake\ORM\Association\BelongsTo $Cities
 * @property \AdminPanel\Model\Table\CustomerAddressTable&\Cake\ORM\Association\HasMany $CustomerAddress
 * @property \AdminPanel\Model\Table\OrdersTable&\Cake\ORM\Association\HasMany $Orders
 *
 * @method \AdminPanel\Model\Entity\Subdistrict get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Subdistrict newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Subdistrict[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Subdistrict|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Subdistrict saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Subdistrict patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Subdistrict[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Subdistrict findOrCreate($search, callable $callback = null, $options = [])
 */
class SubdistrictsTable extends Table
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

        $this->setTable('subdistricts');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'className' => 'AdminPanel.Cities',
        ]);
        $this->hasMany('CustomerAddress', [
            'foreignKey' => 'subdistrict_id',
            'className' => 'AdminPanel.CustomerAddress',
        ]);
        $this->hasMany('Orders', [
            'foreignKey' => 'subdistrict_id',
            'className' => 'AdminPanel.Orders',
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
            ->allowEmptyString('name');

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
        $rules->add($rules->existsIn(['city_id'], 'Cities'));

        return $rules;
    }
}
