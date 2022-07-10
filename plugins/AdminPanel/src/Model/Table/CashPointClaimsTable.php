<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CashPointClaims Model
 *
 * @property \AdminPanel\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 * @property \AdminPanel\Model\Table\CashPointsTable&\Cake\ORM\Association\HasMany $CashPoints
 * @property \AdminPanel\Model\Table\CustomerStatementDetailsTable&\Cake\ORM\Association\HasMany $CustomerStatementDetails
 * @property \AdminPanel\Model\Table\CustomerStatementsTable&\Cake\ORM\Association\HasMany $CustomerStatements
 *
 * @method \AdminPanel\Model\Entity\CashPointClaim get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\CashPointClaim newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\CashPointClaim[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CashPointClaim|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\CashPointClaim saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\CashPointClaim patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CashPointClaim[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CashPointClaim findOrCreate($search, callable $callback = null, $options = [])
 */
class CashPointClaimsTable extends Table
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

        $this->setTable('cash_point_claims');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'className' => 'AdminPanel.Customers',
        ]);
        $this->hasMany('CashPoints', [
            'foreignKey' => 'cash_point_claim_id',
            'className' => 'AdminPanel.CashPoints',
        ]);
        $this->hasMany('CustomerStatementDetails', [
            'foreignKey' => 'cash_point_claim_id',
            'className' => 'AdminPanel.CustomerStatementDetails',
        ]);
        $this->hasMany('CustomerStatements', [
            'foreignKey' => 'cash_point_claim_id',
            'className' => 'AdminPanel.CustomerStatements',
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
            ->date('claim_date')
            ->allowEmptyDate('claim_date');

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
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));

        return $rules;
    }
}
