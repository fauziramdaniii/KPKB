<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cards Model
 *
 * @property &\Cake\ORM\Association\BelongsTo $Stockists
 * @property \AdminPanel\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 * @property \AdminPanel\Model\Table\CardStatusesTable&\Cake\ORM\Association\BelongsTo $CardStatuses
 * @property \AdminPanel\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property &\Cake\ORM\Association\BelongsTo $Suppliers
 * @property \AdminPanel\Model\Table\CardTypesTable&\Cake\ORM\Association\BelongsTo $CardTypes
 * @property &\Cake\ORM\Association\HasMany $Installments
 * @property \AdminPanel\Model\Table\OrderDetailSerialsTable&\Cake\ORM\Association\HasMany $OrderDetailSerials
 * @property \AdminPanel\Model\Table\RepeatOrdersTable&\Cake\ORM\Association\HasMany $RepeatOrders
 *
 * @method \AdminPanel\Model\Entity\Card get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Card newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Card[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Card|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Card saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Card patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Card[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Card findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CardsTable extends Table
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

        $this->setTable('cards');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Stockists', [
            'foreignKey' => 'stockist_id',
            'className' => 'AdminPanel.Customers',
        ]);
        $this->belongsTo('CustomersAlias', [
            'foreignKey' => 'customer_id',
            'className' => 'AdminPanel.Customers',
        ]);
        $this->belongsTo('CardStatuses', [
            'foreignKey' => 'card_status_id',
            'className' => 'AdminPanel.CardStatuses',
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'className' => 'AdminPanel.Products',
        ]);
        $this->belongsTo('Suppliers', [
            'foreignKey' => 'supplier_id',
            'className' => 'AdminPanel.Suppliers',
        ]);
        $this->belongsTo('CardTypes', [
            'foreignKey' => 'card_type_id',
            'className' => 'AdminPanel.CardTypes',
        ]);
        $this->hasMany('Customers', [
            'foreignKey' => 'card_id',
            'className' => 'AdminPanel.Customers',
        ]);
        $this->hasMany('Installments', [
            'foreignKey' => 'card_id',
            'className' => 'AdminPanel.Installments',
        ]);
        $this->hasMany('OrderDetailSerials', [
            'foreignKey' => 'card_id',
            'className' => 'AdminPanel.OrderDetailSerials',
        ]);
        $this->hasMany('RepeatOrders', [
            'foreignKey' => 'card_id',
            'className' => 'AdminPanel.RepeatOrders',
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
            ->scalar('card_number')
            ->maxLength('card_number', 15)
            ->allowEmptyString('card_number');

        $validator
            ->scalar('serial')
            ->maxLength('serial', 15)
            ->allowEmptyString('serial')
            ->add('serial', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);


        $validator
            ->integer('stock_type')
            ->allowEmptyString('stock_type');

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
        $rules->add($rules->isUnique(['serial']));
        $rules->add($rules->existsIn(['stockist_id'], 'Stockists'));
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        $rules->add($rules->existsIn(['card_status_id'], 'CardStatuses'));
        $rules->add($rules->existsIn(['product_id'], 'Products'));
        $rules->add($rules->existsIn(['supplier_id'], 'Suppliers'));
        $rules->add($rules->existsIn(['card_type_id'], 'CardTypes'));

        return $rules;
    }
}
