<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Orders Model
 *
 * @property \AdminPanel\Model\Table\OrderStatusesTable|\Cake\ORM\Association\BelongsTo $OrderStatuses
 * @property \AdminPanel\Model\Table\StockistCustomersTable|\Cake\ORM\Association\BelongsTo $StockistCustomers
 * @property \AdminPanel\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 * @property \AdminPanel\Model\Table\ProvincesTable|\Cake\ORM\Association\BelongsTo $Provinces
 * @property \AdminPanel\Model\Table\CitiesTable|\Cake\ORM\Association\BelongsTo $Cities
 * @property \AdminPanel\Model\Table\OrderDetailsTable|\Cake\ORM\Association\HasMany $OrderDetails
 * @property \AdminPanel\Model\Table\OrderConfirmationsTable|\Cake\ORM\Association\HasOne $OrderConfirmations
 *
 * @method \AdminPanel\Model\Entity\Order get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Order newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Order[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Order|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Order|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Order[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Order findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdersTable extends Table
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

        $this->setTable('orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('OrderStatuses', [
            'foreignKey' => 'order_status_id',
            'className' => 'AdminPanel.OrderStatuses'
        ]);
        $this->belongsTo('StockistCustomers', [
            'foreignKey' => 'stockist_customer_id',
            'className' => 'AdminPanel.Customers'
        ]);
        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'className' => 'AdminPanel.Customers'
        ]);
        $this->belongsTo('Provinces', [
            'foreignKey' => 'province_id',
            'className' => 'AdminPanel.Provinces'
        ]);
        $this->belongsTo('Subdistricts', [
            'foreignKey' => 'subdistrict_id',
            'className' => 'AdminPanel.Subdistricts'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'className' => 'AdminPanel.Cities'
        ]);
        $this->hasMany('OrderDetails', [
            'foreignKey' => 'order_id',
            'className' => 'AdminPanel.OrderDetails'
        ]);
        $this->hasOne('OrderConfirmations', [
            'foreignKey' => 'order_id',
            'className' => 'AdminPanel.OrderConfirmations'
        ]);
        $this->hasOne('Suppliers', [
            'foreignKey' => 'supplier_id',
            'className' => 'AdminPanel.Suppliers'
        ]);
        $this->belongsTo('Ranks', [
            'foreignKey' => 'rank_id',
            'className' => 'AdminPanel.Ranks'
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
            ->scalar('invoice')
            ->maxLength('invoice', 15)
            ->allowEmptyString('invoice')
            ->add('invoice', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->allowEmptyString('address');

        $validator
            ->scalar('recipient_name')
            ->maxLength('recipient_name', 255)
            ->allowEmptyString('recipient_name');

        $validator
            ->scalar('recipient_phone')
            ->maxLength('recipient_phone', 255)
            ->allowEmptyString('recipient_phone');

        $validator
            ->numeric('gross_total')
            ->allowEmptyString('gross_total');

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
        $rules->add($rules->isUnique(['invoice']));
        $rules->add($rules->isUnique(['secret_key']));
        $rules->add($rules->existsIn(['order_status_id'], 'OrderStatuses'));
        $rules->add($rules->existsIn(['stockist_customer_id'], 'StockistCustomers'));
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        $rules->add($rules->existsIn(['province_id'], 'Provinces'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));

        return $rules;
    }
}
