<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FaqCategories Model
 *
 * @property \AdminPanel\Model\Table\FaqsTable|\Cake\ORM\Association\HasMany $Faqs
 *
 * @method \AdminPanel\Model\Entity\FaqCategory get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\FaqCategory newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\FaqCategory[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\FaqCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\FaqCategory|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\FaqCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\FaqCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\FaqCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class FaqCategoriesTable extends Table
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

        $this->setTable('faq_categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->addBehavior('Translate', [
            'fields' => ['name'],
            'allowEmptyTranslations' => false,
            'validator' => 'translated'
        ]);

        $this->hasMany('Faqs', [
            'foreignKey' => 'faq_category_id',
            'className' => 'AdminPanel.Faqs'
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
