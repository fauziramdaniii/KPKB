<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderDetails Model
 *
 * @property \AdminPanel\Model\Table\OrdersTable|\Cake\ORM\Association\BelongsTo $Orders
 * @property \AdminPanel\Model\Table\ProductsTable|\Cake\ORM\Association\BelongsTo $Products
 * @property \AdminPanel\Model\Table\OrderDetailSerialsTable|\Cake\ORM\Association\HasMany $OrderDetailSerials
 *
 * @method \AdminPanel\Model\Entity\OrderDetail get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\OrderDetail newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\OrderDetail[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\OrderDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\OrderDetail|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\OrderDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\OrderDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\OrderDetail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrderDetailsTable extends Table
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

        $this->setTable('order_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'className' => 'AdminPanel.Orders'
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'className' => 'AdminPanel.Products'
        ]);
        $this->hasMany('OrderDetailSerials', [
            'foreignKey' => 'order_detail_id',
            'className' => 'AdminPanel.OrderDetailSerials'
        ]);
        $this->hasMany('Cards', [
            'foreignKey' => 'card_id',
            'className' => 'AdminPanel.Cards'
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
            ->integer('qty')
            ->allowEmptyString('qty');

        $validator
            ->numeric('price')
            ->allowEmptyString('price');

        $validator
            ->numeric('total')
            ->allowEmptyString('total');

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
        $rules->add($rules->existsIn(['order_id'], 'Orders'));
        $rules->add($rules->existsIn(['product_id'], 'Products'));

        return $rules;
    }
}
