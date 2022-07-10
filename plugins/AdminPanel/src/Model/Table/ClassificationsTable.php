<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Classifications Model
 *
 * @property \AdminPanel\Model\Table\AddressSubmissionsTable&\Cake\ORM\Association\HasMany $AddressSubmissions
 * @property \AdminPanel\Model\Table\KiaSubmissionsTable&\Cake\ORM\Association\HasMany $KiaSubmissions
 * @property \AdminPanel\Model\Table\KkSubmissionsTable&\Cake\ORM\Association\HasMany $KkSubmissions
 * @property \AdminPanel\Model\Table\KtpSubmissionsTable&\Cake\ORM\Association\HasMany $KtpSubmissions
 * @property \AdminPanel\Model\Table\RequirementsTable&\Cake\ORM\Association\HasMany $Requirements
 *
 * @method \AdminPanel\Model\Entity\Classification get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Classification newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Classification[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Classification|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Classification saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Classification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Classification[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Classification findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClassificationsTable extends Table
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

        $this->setTable('classifications');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('AddressSubmissions', [
            'foreignKey' => 'classification_id',
            'className' => 'AdminPanel.AddressSubmissions',
        ]);
        $this->hasMany('KiaSubmissions', [
            'foreignKey' => 'classification_id',
            'className' => 'AdminPanel.KiaSubmissions',
        ]);
        $this->hasMany('KkSubmissions', [
            'foreignKey' => 'classification_id',
            'className' => 'AdminPanel.KkSubmissions',
        ]);
        $this->hasMany('KtpSubmissions', [
            'foreignKey' => 'classification_id',
            'className' => 'AdminPanel.KtpSubmissions',
        ]);
        $this->hasMany('Requirements', [
            'foreignKey' => 'classification_id',
            'className' => 'AdminPanel.Requirements',
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');

        $validator
            ->scalar('type')
            ->maxLength('type', 50)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        return $validator;
    }
}
