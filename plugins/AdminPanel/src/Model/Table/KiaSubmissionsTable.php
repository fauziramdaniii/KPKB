<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * KiaSubmissions Model
 *
 * @property \AdminPanel\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 * @property &\Cake\ORM\Association\BelongsTo $Classifications
 * @property \AdminPanel\Model\Table\SubmissionStatusesTable&\Cake\ORM\Association\BelongsTo $SubmissionStatuses
 * @property &\Cake\ORM\Association\HasMany $KiaRequirements
 *
 * @method \AdminPanel\Model\Entity\KiaSubmission get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\KiaSubmission newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\KiaSubmission[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\KiaSubmission|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\KiaSubmission saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\KiaSubmission patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\KiaSubmission[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\KiaSubmission findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class KiaSubmissionsTable extends Table
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

        $this->setTable('kia_submissions');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'className' => 'AdminPanel.Customers',
        ]);
        $this->belongsTo('Classifications', [
            'foreignKey' => 'classification_id',
            'className' => 'AdminPanel.Classifications',
        ]);
        $this->belongsTo('SubmissionStatuses', [
            'foreignKey' => 'submission_status_id',
            'className' => 'AdminPanel.SubmissionStatuses',
        ]);
        $this->hasMany('KiaRequirements', [
            'foreignKey' => 'kia_submission_id',
            'className' => 'AdminPanel.KiaRequirements',
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
            ->scalar('nik')
            ->maxLength('nik', 50)
            ->requirePresence('nik', 'create')
            ->notEmptyString('nik');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->allowEmptyString('address');

        $validator
            ->scalar('applicant')
            ->maxLength('applicant', 50)
            ->requirePresence('applicant', 'create')
            ->notEmptyString('applicant');

        $validator
            ->scalar('taker')
            ->maxLength('taker', 50)
            ->allowEmptyString('taker');

        $validator
            ->scalar('note')
            ->maxLength('note', 255)
            ->allowEmptyString('note');

        $validator
            ->date('tanggal_pengajuan_berkas')
            ->allowEmptyDate('tanggal_pengajuan_berkas');

        $validator
            ->date('tanggal_pengambilan_berkas')
            ->allowEmptyDate('tanggal_pengambilan_berkas');

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
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        $rules->add($rules->existsIn(['classification_id'], 'Classifications'));
        $rules->add($rules->existsIn(['submission_status_id'], 'SubmissionStatuses'));

        return $rules;
    }
}
