<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WithdrawalStatuses Model
 *
 * @property \AdminPanel\Model\Table\WithdrawalsTable|\Cake\ORM\Association\HasMany $Withdrawals
 *
 * @method \AdminPanel\Model\Entity\WithdrawalStatus get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\WithdrawalStatus newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\WithdrawalStatus[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\WithdrawalStatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\WithdrawalStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\WithdrawalStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\WithdrawalStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\WithdrawalStatus findOrCreate($search, callable $callback = null, $options = [])
 */
class WithdrawalStatusesTable extends Table
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

        $this->setTable('withdrawal_statuses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Withdrawals', [
            'foreignKey' => 'withdrawal_status_id',
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
            ->scalar('name')
            ->maxLength('name', 150)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        return $validator;
    }
}
