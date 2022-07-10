<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Suppliers Model
 *
 * @property &\Cake\ORM\Association\HasMany $Cards
 * @property &\Cake\ORM\Association\HasMany $Orders
 * @property &\Cake\ORM\Association\HasMany $ProductStocks
 *
 * @method \AdminPanel\Model\Entity\Supplier get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Supplier newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Supplier[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Supplier|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Supplier saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Supplier patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Supplier[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Supplier findOrCreate($search, callable $callback = null, $options = [])
 */
class SuppliersTable extends Table
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

        $this->setTable('suppliers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Cards', [
            'foreignKey' => 'supplier_id',
            'className' => 'AdminPanel.Cards',
        ]);
        $this->hasMany('Orders', [
            'foreignKey' => 'supplier_id',
            'className' => 'AdminPanel.Orders',
        ]);
        $this->hasMany('ProductStocks', [
            'foreignKey' => 'supplier_id',
            'className' => 'AdminPanel.ProductStocks',
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
            ->scalar('address')
            ->allowEmptyString('address');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 10)
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone');

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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
