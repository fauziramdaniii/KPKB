<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Security;
use Cake\Validation\Validator;

/**
 * Transactions Model
 *
 * @property \AdminPanel\Model\Table\TransactionTypesTable|\Cake\ORM\Association\BelongsTo $TransactionTypes
 * @property \AdminPanel\Model\Table\TransactionMutationsTable|\Cake\ORM\Association\HasMany $TransactionMutations
 *
 * @method \AdminPanel\Model\Entity\Transaction get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Transaction newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Transaction[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Transaction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Transaction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Transaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Transaction[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Transaction findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TransactionsTable extends Table
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

        $this->setTable('transactions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('TransactionTypes', [
            'foreignKey' => 'transaction_type_id',
            'className' => 'AdminPanel.TransactionTypes'
        ]);
        $this->hasMany('TransactionMutations', [
            'foreignKey' => 'transaction_id',
            'className' => 'AdminPanel.TransactionMutations'
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
            ->scalar('txid')
            ->maxLength('txid', 64)
            ->allowEmptyString('txid');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description');

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
        $rules->add($rules->existsIn(['transaction_type_id'], 'TransactionTypes'));

        return $rules;
    }

    /**
     * @param $transaction_type_id
     * @param $customer_id
     * @param $amount
     * @param null $description
     * @param \Closure|null $callback
     * @return bool
     */
    public function create($transaction_type_id, $customer_id, $amount, $description = null, \Closure $callback = null)
    {
        /**
         * @var \AdminPanel\Model\Entity\Customer $customer
         */
        $customer = $this
            ->TransactionMutations
            ->Customers->find()
            ->select([
                'id',
                'balance'
            ])
            ->where([
                'Customers.id' => $customer_id
            ])
            ->epilog('FOR UPDATE')
            ->first();

        if ($customer) {
            $entity = $this->newEntity([
                'transaction_type_id' => $transaction_type_id,
                'txid' => Security::randomString(),
                'description' => $description
            ]);
            if ($this->save($entity)) {
                $balance = floatval($customer->get('balance')) + $amount;
                $entityMutation = $this->TransactionMutations->newEntity([
                    'customer_id' => $customer_id,
                    'transaction_id' => $entity->id,
                    'amount' => $amount,
                    'balance' => $balance
                ]);
                if ($this->TransactionMutations->save($entityMutation)) {
                    $customer->set('balance', $balance);
                    $saved = $this
                        ->TransactionMutations
                        ->Customers
                        ->save($customer);
                    if ($callback) {
                        call_user_func($callback, $entity, $entityMutation);
                    }
                    return $saved;
                }
            }
        }


        return false;
    }
}
