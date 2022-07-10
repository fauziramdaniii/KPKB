<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Downloads Model
 *
 * @property \AdminPanel\Model\Table\DownloadCategoriesTable|\Cake\ORM\Association\BelongsTo $DownloadCategories
 *
 * @method \AdminPanel\Model\Entity\Download get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Download newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Download[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Download|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Download|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Download patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Download[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Download findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DownloadsTable extends Table
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

        $this->setTable('downloads');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('DownloadCategories', [
            'foreignKey' => 'download_category_id',
            'className' => 'AdminPanel.DownloadCategories'
        ]);
//        $this->addBehavior('Translate', [
//            'fields' => ['title'],
//            'allowEmptyTranslations' => false,
//            'validator' => 'translated'
//        ]);
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'name' => [
                'fields' => [
                    'dir' => 'dir', // defaults to `dir`
                    'size' => 'size', // defaults to `size`
                    'type' => 'type', // defaults to `type`
                ],
                'path' => 'webroot{DS}files{DS}{model}{DS}{field}{DS}{year}{DS}{month}{DS}',
            ],
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
            ->scalar('title')
            ->maxLength('title', 100)
            ->allowEmptyString('title');

//        $validator
//            ->scalar('name')
//            ->maxLength('name', 100)
//            ->allowEmptyString('name');

//        $validator
//            ->scalar('dir')
//            ->maxLength('dir', 255)
//            ->allowEmptyString('dir');
//
//        $validator
//            ->integer('size')
//            ->allowEmptyString('size');
//
//        $validator
//            ->scalar('type')
//            ->maxLength('type', 150)
//            ->allowEmptyString('type');

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
        $rules->add($rules->existsIn(['download_category_id'], 'DownloadCategories'));

        return $rules;
    }
//    public function validationTranslated(Validator $validator)
//    {
//        return $validator;
//    }
}
