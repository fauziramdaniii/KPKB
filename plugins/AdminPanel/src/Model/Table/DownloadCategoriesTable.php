<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DownloadCategories Model
 *
 * @property \AdminPanel\Model\Table\DownloadsTable|\Cake\ORM\Association\HasMany $Downloads
 *
 * @method \AdminPanel\Model\Entity\DownloadCategory get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\DownloadCategory newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\DownloadCategory[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\DownloadCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\DownloadCategory|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\DownloadCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\DownloadCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\DownloadCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class DownloadCategoriesTable extends Table
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

        $this->setTable('download_categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Downloads', [
            'foreignKey' => 'download_category_id',
            'className' => 'AdminPanel.Downloads'
        ]);
        $this->addBehavior('Translate', [
            'fields' => ['name'],
            'allowEmptyTranslations' => false,
            'validator' => 'translated'
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
            ->maxLength('name', 150)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        return $validator;
    }
    public function validationTranslated(Validator $validator)
    {
        return $validator;
    }
}
