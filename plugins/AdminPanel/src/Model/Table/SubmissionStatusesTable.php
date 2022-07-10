<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SubmissionStatuses Model
 *
 * @property \AdminPanel\Model\Table\KiaSubmissionsTable&\Cake\ORM\Association\HasMany $KiaSubmissions
 * @property \AdminPanel\Model\Table\KkSubmissionsTable&\Cake\ORM\Association\HasMany $KkSubmissions
 * @property \AdminPanel\Model\Table\KtpSubmissionsTable&\Cake\ORM\Association\HasMany $KtpSubmissions
 *
 * @method \AdminPanel\Model\Entity\SubmissionStatus get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\SubmissionStatus newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\SubmissionStatus[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\SubmissionStatus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\SubmissionStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\SubmissionStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\SubmissionStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\SubmissionStatus findOrCreate($search, callable $callback = null, $options = [])
 */
class SubmissionStatusesTable extends Table
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

        $this->setTable('submission_statuses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('KiaSubmissions', [
            'foreignKey' => 'submission_status_id',
            'className' => 'AdminPanel.KiaSubmissions',
        ]);
        $this->hasMany('KkSubmissions', [
            'foreignKey' => 'submission_status_id',
            'className' => 'AdminPanel.KkSubmissions',
        ]);
        $this->hasMany('KtpSubmissions', [
            'foreignKey' => 'submission_status_id',
            'className' => 'AdminPanel.KtpSubmissions',
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
            ->maxLength('name', 150)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
