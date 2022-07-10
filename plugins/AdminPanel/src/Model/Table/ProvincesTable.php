<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Provinces Model
 *
 * @property |\Cake\ORM\Association\HasMany $Cities
 * @property |\Cake\ORM\Association\HasMany $CustomerContacts
 *
 * @method \AdminPanel\Model\Entity\Province get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Province newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Province[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Province|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Province|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Province patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Province[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Province findOrCreate($search, callable $callback = null, $options = [])
 */
class ProvincesTable extends Table
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

        $this->setTable('provinces');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Cities', [
            'foreignKey' => 'province_id',
            'className' => 'AdminPanel.Cities'
        ]);
        $this->hasMany('CustomerContacts', [
            'foreignKey' => 'province_id',
            'className' => 'AdminPanel.CustomerContacts'
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
            ->maxLength('name', 200)
            ->allowEmptyString('name');

        return $validator;
    }
}
