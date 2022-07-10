<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CashPoints Model
 *
 * @property \AdminPanel\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \AdminPanel\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 * @property \AdminPanel\Model\Table\FromCustomersTable&\Cake\ORM\Association\BelongsTo $FromCustomers
 * @property \AdminPanel\Model\Table\CashPointClaimsTable&\Cake\ORM\Association\BelongsTo $CashPointClaims
 *
 * @method \AdminPanel\Model\Entity\CashPoint get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\CashPoint newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\CashPoint[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CashPoint|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\CashPoint saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\CashPoint patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CashPoint[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CashPoint findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CashPointsTable extends Table
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

        $this->setTable('cash_points');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'className' => 'AdminPanel.Products',
        ]);
        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'className' => 'AdminPanel.Customers',
        ]);
        $this->belongsTo('FromCustomers', [
            'foreignKey' => 'from_customer_id',
            'className' => 'AdminPanel.Customers',
        ]);
        $this->belongsTo('CashPointClaims', [
            'foreignKey' => 'cash_point_claim_id',
            'className' => 'AdminPanel.CashPointClaims',
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
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->numeric('cash_point')
            ->allowEmptyString('cash_point');

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
        $rules->add($rules->existsIn(['product_id'], 'Products'));
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        $rules->add($rules->existsIn(['from_customer_id'], 'FromCustomers'));
        $rules->add($rules->existsIn(['cash_point_claim_id'], 'CashPointClaims'));

        return $rules;
    }
}
