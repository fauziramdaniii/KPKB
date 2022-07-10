<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Banks Model
 *
 * @property \AdminPanel\Model\Table\CustomerBanksTable|\Cake\ORM\Association\HasMany $CustomerBanks
 *
 * @method \AdminPanel\Model\Entity\Bank get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Bank newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Bank[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Bank|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Bank saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Bank patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Bank[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Bank findOrCreate($search, callable $callback = null, $options = [])
 */
class BanksTable extends Table
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

        $this->setTable('banks');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('CustomerBanks', [
            'foreignKey' => 'bank_id',
            'className' => 'AdminPanel.CustomerBanks'
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
            ->scalar('code')
            ->maxLength('code', 4)
            ->allowEmptyString('code');

        $validator
            ->scalar('name')
            ->maxLength('name', 150)
            ->allowEmptyString('name');

        return $validator;
    }
}
