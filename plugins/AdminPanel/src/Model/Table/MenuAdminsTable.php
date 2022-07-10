<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MenuAdmins Model
 *
 * @property \AdminPanel\Model\Table\MenuAdminsTable|\Cake\ORM\Association\BelongsTo $ParentMenuAdmins
 * @property \AdminPanel\Model\Table\MenuAdminsTable|\Cake\ORM\Association\HasMany $ChildMenuAdmins
 *
 * @method \AdminPanel\Model\Entity\MenuAdmin get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\MenuAdmin newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\MenuAdmin[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\MenuAdmin|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\MenuAdmin|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\MenuAdmin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\MenuAdmin[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\MenuAdmin findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class MenuAdminsTable extends Table
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

        $this->setTable('menu_admins');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Tree');

        $this->belongsTo('ParentMenuAdmins', [
            'className' => 'AdminPanel.MenuAdmins',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildMenuAdmins', [
            'className' => 'AdminPanel.MenuAdmins',
            'foreignKey' => 'parent_id'
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
            ->maxLength('name', 50)
            ->notBlank('name', 'Please fill this field');

        $validator
            ->scalar('controller')
            ->maxLength('controller', 50)
            ->allowEmptyString('controller');

        $validator
            ->scalar('action')
            ->maxLength('action', 50)
            ->allowEmptyString('action');

        $validator
            ->scalar('icon')
            ->maxLength('icon', 50)
            ->allowEmptyString('icon');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentMenuAdmins'));

        return $rules;
    }
}
