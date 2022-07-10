<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Networks Model
 *
 * @property \AdminPanel\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 * @property \AdminPanel\Model\Table\NetworksTable|\Cake\ORM\Association\BelongsTo $ParentNetworks
 * @property \AdminPanel\Model\Table\NetworksTable|\Cake\ORM\Association\HasMany $ChildNetworks
 *
 * @method \AdminPanel\Model\Entity\Network get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Network newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Network[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Network|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Network saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Network patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Network[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Network findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class NetworksTable extends Table
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

        $this->setTable('networks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Tree');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'className' => 'AdminPanel.Customers'
        ]);
        $this->belongsTo('ParentNetworks', [
            'className' => 'AdminPanel.Networks',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildNetworks', [
            'className' => 'AdminPanel.Networks',
            'foreignKey' => 'parent_id'
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
            ->integer('level')
            ->allowEmptyString('level');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentNetworks'));

        return $rules;
    }

    public function saving($refferal_id, $customer_id)
    {
        $parent = $this->find()
            ->select(['id', 'level'])
            ->where([
                'customer_id' => $refferal_id
            ])
            ->first();

        $entity = $this->newEntity([
            'parent_id' => $parent ? $parent->id : null,
            'level' => $parent ? $parent->get('level') + 1 : 1,
            'customer_id' => $customer_id
        ]);

        return $this->save($entity);

    }
}
