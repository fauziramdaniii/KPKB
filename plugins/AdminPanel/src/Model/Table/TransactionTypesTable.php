<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TransactionTypes Model
 *
 * @property \AdminPanel\Model\Table\TransactionsTable|\Cake\ORM\Association\HasMany $Transactions
 *
 * @method \AdminPanel\Model\Entity\TransactionType get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\TransactionType newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\TransactionType[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\TransactionType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\TransactionType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\TransactionType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\TransactionType[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\TransactionType findOrCreate($search, callable $callback = null, $options = [])
 */
class TransactionTypesTable extends Table
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

        $this->setTable('transaction_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Transactions', [
            'foreignKey' => 'transaction_type_id',
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
            ->scalar('name')
            ->maxLength('name', 150)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        return $validator;
    }
}
