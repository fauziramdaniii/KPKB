<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Database\Expression\QueryExpression;


/**
 * Users Model
 *
 * @property \AdminPanel\Model\Table\GroupsTable|\Cake\ORM\Association\BelongsTo $Groups
 * @property \AdminPanel\Model\Table\UserStatusTable|\Cake\ORM\Association\BelongsTo $UserStatus
 *
 * @method \AdminPanel\Model\Entity\User get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\User|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Acl.Acl', ['requester']);

        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER',
            'className' => 'AdminPanel.Groups'
        ]);
        $this->belongsTo('UserStatus', [
            'foreignKey' => 'user_status_id',
            'joinType' => 'INNER',
            'className' => 'AdminPanel.UserStatus'
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
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 50)
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->equalToField('repeat_password', 'password', 'Repeat password does not match with your password')
            ->allowEmpty('repeat_password', function ($context) {
                return !$context['data']['password'];
            });

        $validator
            ->notBlank('group_id')
            ->notBlank('user_status_id');

        $validator
            ->notBlank('first_name', 'first name is empty');

        return $validator;
    }

    /**
     * @param Validator $validator
     * @return Validator
     */
    public function validationUpdate(Validator $validator)
    {

        $validator
            ->lengthBetween('password', [6, 20], 'password min 6 - 20 character')
            ->regex('password', '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/',
                'password min 6 char at least one uppercase letter, one lowercase letter and one number')
            ->allowEmpty('password', 'update');

        $validator
            ->equalToField('repeat_password', 'password', 'Repeat password does not match with your password')
            ->allowEmpty('repeat_password', function ($context) {
                return !isset($context['data']['password']);
            });

        $validator
            ->notBlank('group_id')
            ->notBlank('user_status_id');

        return $validator;
    }

    public function validationPassword(Validator $validator)
    {
        $validator
            ->lengthBetween('password', [6, 20], 'password min 6 - 20 character')
            ->regex('password', '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/',
                'password min 6 char at least one uppercase letter, one lowercase letter and one number');

        $validator
            ->equalToField('repeat_password', 'password', 'Repeat password does not match with your password')
            ->allowEmpty('repeat_password', function ($context) {
                return !isset($context['data']['password']);
            });
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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['group_id'], 'Groups'));
        $rules->add($rules->existsIn(['user_status_id'], 'UserStatus'));

        return $rules;
    }

    /**
     * @param Query $query
     * @param array $options
     * @return Query
     */
    public function findAuth(Query $query, array $options)
    {
        $query
            ->select(['id', 'email', 'password', 'first_name', 'last_name', 'group_id'])
            ->contain([
                'Groups' => [
                    'fields' => ['Groups.name', 'Groups.level']
                ]
            ])
            ->where(['Users.email' => $options['username'], 'Users.user_status_id' => 1]);

        return $query;
    }
}
