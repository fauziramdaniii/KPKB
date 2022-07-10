<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Withdrawals Model
 *
 * @property \AdminPanel\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 * @property \AdminPanel\Model\Table\CustomerBanksTable|\Cake\ORM\Association\BelongsTo $CustomerBanks
 * @property \AdminPanel\Model\Table\WithdrawalStatusesTable|\Cake\ORM\Association\BelongsTo $WithdrawalStatuses
 * @property \AdminPanel\Model\Table\TransactionsTable|\Cake\ORM\Association\BelongsTo $Transactions
 *
 * @method \AdminPanel\Model\Entity\Withdrawal get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Withdrawal newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Withdrawal[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Withdrawal|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Withdrawal saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Withdrawal patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Withdrawal[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Withdrawal findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WithdrawalsTable extends Table
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

        $this->setTable('withdrawals');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'className' => 'AdminPanel.Customers'
        ]);
        $this->belongsTo('CustomerBanks', [
            'foreignKey' => 'customer_bank_id',
            'className' => 'AdminPanel.CustomerBanks'
        ]);
        $this->belongsTo('WithdrawalStatuses', [
            'foreignKey' => 'withdrawal_status_id',
            'className' => 'AdminPanel.WithdrawalStatuses'
        ]);
        $this->belongsTo('Transactions', [
            'foreignKey' => 'transaction_id',
            'className' => 'AdminPanel.Transactions'
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
            ->requirePresence('amount')
            ->numeric('amount')
            ->notBlank('amount');

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
        $rules->add($rules->existsIn(['customer_bank_id'], 'CustomerBanks'));
        $rules->add($rules->existsIn(['withdrawal_status_id'], 'WithdrawalStatuses'));
        $rules->add($rules->existsIn(['transaction_id'], 'Transactions'));

        return $rules;
    }
}
