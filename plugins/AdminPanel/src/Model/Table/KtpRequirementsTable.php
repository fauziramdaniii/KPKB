<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * KtpRequirements Model
 *
 * @property \AdminPanel\Model\Table\KtpSubmissionsTable&\Cake\ORM\Association\BelongsTo $KtpSubmissions
 * @property \AdminPanel\Model\Table\ImagesTable&\Cake\ORM\Association\BelongsTo $Images
 *
 * @method \AdminPanel\Model\Entity\KtpRequirement get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\KtpRequirement newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\KtpRequirement[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\KtpRequirement|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\KtpRequirement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\KtpRequirement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\KtpRequirement[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\KtpRequirement findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class KtpRequirementsTable extends Table
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

        $this->setTable('ktp_requirements');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('KtpSubmissions', [
            'foreignKey' => 'ktp_submission_id',
            'className' => 'AdminPanel.KtpSubmissions',
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
        $rules->add($rules->existsIn(['ktp_submission_id'], 'KtpSubmissions'));
        $rules->add($rules->existsIn(['image_id'], 'Images'));

        return $rules;
    }
}
