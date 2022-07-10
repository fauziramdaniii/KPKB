<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomerStatementDetails Model
 *
 * @property \AdminPanel\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 * @property \AdminPanel\Model\Table\CashPointClaimsTable&\Cake\ORM\Association\BelongsTo $CashPointClaims
 *
 * @method \AdminPanel\Model\Entity\CustomerStatementDetail get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\CustomerStatementDetail newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\CustomerStatementDetail[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CustomerStatementDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\CustomerStatementDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\CustomerStatementDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CustomerStatementDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CustomerStatementDetail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomerStatementDetailsTable extends Table
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

        $this->setTable('customer_statement_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
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
            ->integer('year')
            ->allowEmptyString('year');

        $validator
            ->integer('month')
            ->allowEmptyString('month');

        $validator
            ->numeric('amount')
            ->allowEmptyString('amount');

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
        $rules->add($rules->existsIn(['cash_point_claim_id'], 'CashPointClaims'));

        return $rules;
    }
}
