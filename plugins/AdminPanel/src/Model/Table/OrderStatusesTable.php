<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderStatuses Model
 *
 * @property \AdminPanel\Model\Table\OrdersTable|\Cake\ORM\Association\HasMany $Orders
 *
 * @method \AdminPanel\Model\Entity\OrderStatus get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\OrderStatus newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\OrderStatus[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\OrderStatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\OrderStatus|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\OrderStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\OrderStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\OrderStatus findOrCreate($search, callable $callback = null, $options = [])
 */
class OrderStatusesTable extends Table
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

        $this->setTable('order_statuses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Orders', [
            'foreignKey' => 'order_status_id',
            'className' => 'AdminPanel.Orders'
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
            ->maxLength('name', 150)
            ->allowEmptyString('name');

        return $validator;
    }
}
