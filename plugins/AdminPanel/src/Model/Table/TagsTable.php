<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tags Model
 *
 * @property \AdminPanel\Model\Table\BlogTagsTable|\Cake\ORM\Association\HasMany $BlogTags
 *
 * @method \AdminPanel\Model\Entity\Tag get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Tag newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Tag[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Tag|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Tag|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Tag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Tag[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Tag findOrCreate($search, callable $callback = null, $options = [])
 */
class TagsTable extends Table
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

        $this->setTable('tags');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->addBehavior('Translate', [
            'fields' => ['name'],
            'allowEmptyTranslations' => false,
            'validator' => 'translated'
        ]);

        $this->belongsToMany('Blogs', [
            'through' => 'BlogTags',
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
