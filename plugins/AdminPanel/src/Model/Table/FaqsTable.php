<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Faqs Model
 *
 * @property \AdminPanel\Model\Table\FaqCategoriesTable|\Cake\ORM\Association\BelongsTo $FaqCategories
 *
 * @method \AdminPanel\Model\Entity\Faq get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Faq newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Faq[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Faq|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Faq|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Faq patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Faq[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Faq findOrCreate($search, callable $callback = null, $options = [])
 */
class FaqsTable extends Table
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

        $this->setTable('faqs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Translate', [
            'fields' => ['question','answer'],
            'allowEmptyTranslations' => false,
            'validator' => 'translated'
        ]);

        $this->belongsTo('FaqCategories', [
            'foreignKey' => 'faq_category_id',
            'joinType' => 'INNER',
            'className' => 'AdminPanel.FaqCategories'
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
            ->scalar('question')
            ->maxLength('question', 150)
            ->requirePresence('question', 'create')
            ->allowEmptyString('question', false);

        $validator
            ->scalar('answer')
            ->requirePresence('answer', 'create')
            ->allowEmptyString('answer', false);

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
        $rules->add($rules->existsIn(['faq_category_id'], 'FaqCategories'));

        return $rules;
    }


    public function validationTranslated(Validator $validator)
    {
        return $validator;
    }
}
