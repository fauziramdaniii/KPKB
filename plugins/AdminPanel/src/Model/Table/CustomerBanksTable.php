<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomerBanks Model
 *
 * @property \AdminPanel\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 * @property \AdminPanel\Model\Table\BanksTable|\Cake\ORM\Association\BelongsTo $Banks
 * @property \AdminPanel\Model\Table\WithdrawalsTable|\Cake\ORM\Association\HasMany $Withdrawals
 *
 * @method \AdminPanel\Model\Entity\CustomerBank get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\CustomerBank newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\CustomerBank[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CustomerBank|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\CustomerBank saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\CustomerBank patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CustomerBank[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CustomerBank findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomerBanksTable extends Table
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

        $this->setTable('customer_banks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'className' => 'AdminPanel.Customers'
        ]);
        $this->belongsTo('Banks', [
            'foreignKey' => 'bank_id',
            'className' => 'AdminPanel.Banks'
        ]);
        $this->hasMany('Withdrawals', [
            'foreignKey' => 'customer_bank_id',
            'className' => 'AdminPanel.Withdrawals'
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
            ->scalar('branch')
            ->maxLength('branch', 50)
            ->allowEmptyString('branch');

        $validator
            ->scalar('city')
            ->maxLength('city', 50)
            ->allowEmptyString('city');

        /*$validator
            ->scalar('account_name')
            ->maxLength('account_name', 50)
            ->allowEmptyString('account_name');

        $validator
            ->scalar('account_number')
            ->maxLength('account_number', 25)
            ->allowEmptyString('account_number');*/

        $validator
            ->requirePresence('bank_id')
            ->notBlank('bank_id');

        $validator
            ->requirePresence('account_name')
            ->notBlank('account_name');

        $validator
            ->requirePresence('account_number')
            ->notBlank('account_number')
            ->numeric('account_number', 'Please input numeric only');


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
        $rules->add($rules->existsIn(['bank_id'], 'Banks'));

        return $rules;
    }
}
