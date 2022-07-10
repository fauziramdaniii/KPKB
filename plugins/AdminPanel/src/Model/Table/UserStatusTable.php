<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserStatus Model
 *
 * @property \AdminPanel\Model\Table\UsersTable|\Cake\ORM\Association\HasMany $Users
 *
 * @method \AdminPanel\Model\Entity\UserStatus get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\UserStatus newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\UserStatus[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\UserStatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\UserStatus|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\UserStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\UserStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\UserStatus findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserStatusTable extends Table
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

        $this->setTable('user_status');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Users', [
            'foreignKey' => 'user_status_id',
            'className' => 'AdminPanel.Users'
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 150)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
