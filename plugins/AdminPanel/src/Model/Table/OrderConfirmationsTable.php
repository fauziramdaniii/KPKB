<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderConfirmations Model
 *
 * @property \AdminPanel\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 * @property \AdminPanel\Model\Table\OrdersTable|\Cake\ORM\Association\BelongsTo $Orders
 * @property \AdminPanel\Model\Table\BanksTable|\Cake\ORM\Association\BelongsTo $Banks
 * @property \AdminPanel\Model\Table\ImagesTable|\Cake\ORM\Association\BelongsTo $Images
 *
 * @method \AdminPanel\Model\Entity\OrderConfirmation get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\OrderConfirmation newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\OrderConfirmation[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\OrderConfirmation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\OrderConfirmation|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\OrderConfirmation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\OrderConfirmation[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\OrderConfirmation findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrderConfirmationsTable extends Table
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

        $this->setTable('order_confirmations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'className' => 'AdminPanel.Customers'
        ]);
        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'className' => 'AdminPanel.Orders'
        ]);
        $this->belongsTo('CustomerBanks', [
            'foreignKey' => 'customer_bank_id',
            'className' => 'AdminPanel.CustomerBanks'
        ]);
        $this->belongsTo('Images', [
            'foreignKey' => 'image_id',
            'className' => 'AdminPanel.Images'
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
            ->numeric('amount')
            ->allowEmptyString('amount');

        $validator
            ->dateTime('confirmation_date')
            ->allowEmptyDateTime('confirmation_date');

        $validator
            ->scalar('note')
            ->maxLength('note', 255)
            ->allowEmptyString('note');

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
        $rules->add($rules->existsIn(['order_id'], 'Orders'));
        $rules->add($rules->existsIn(['customer_bank_id'], 'CustomerBanks'));
        $rules->add($rules->existsIn(['image_id'], 'Images'));

        return $rules;
    }
}
