<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * KkRequirements Model
 *
 * @property \AdminPanel\Model\Table\KkSubmissionsTable&\Cake\ORM\Association\BelongsTo $KkSubmissions
 * @property \AdminPanel\Model\Table\ImagesTable&\Cake\ORM\Association\BelongsTo $Images
 *
 * @method \AdminPanel\Model\Entity\KkRequirement get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\KkRequirement newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\KkRequirement[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\KkRequirement|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\KkRequirement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\KkRequirement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\KkRequirement[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\KkRequirement findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class KkRequirementsTable extends Table
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

        $this->setTable('kk_requirements');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('KkSubmissions', [
            'foreignKey' => 'kk_submission_id',
            'className' => 'AdminPanel.KkSubmissions',
        ]);
        $this->belongsTo('Images', [
            'foreignKey' => 'image_id',
            'className' => 'AdminPanel.Images',
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
            ->allowEmptyString('name');

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
        $rules->add($rules->existsIn(['kk_submission_id'], 'KkSubmissions'));
        $rules->add($rules->existsIn(['image_id'], 'Images'));

        return $rules;
    }
}
