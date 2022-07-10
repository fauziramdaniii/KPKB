<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Blogs Model
 *
 * @property \AdminPanel\Model\Table\TopicsTable|\Cake\ORM\Association\BelongsTo $Topics
 * @property \AdminPanel\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \AdminPanel\Model\Table\BlogTagsTable|\Cake\ORM\Association\HasMany $BlogTags
 *
 * @method \AdminPanel\Model\Entity\Blog get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Blog newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Blog[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Blog|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Blog|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Blog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Blog[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Blog findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BlogsTable extends Table
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

        $this->setTable('blogs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Translate', [
            'fields' => ['title','content'],
            'allowEmptyTranslations' => false,
//            'validator' => 'translated'
        ]);

        $this->addBehavior('Timestamp');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'image' => []
        ]);


        $this->belongsTo('Topics', [
            'foreignKey' => 'topic_id',
            'joinType' => 'INNER',
            'className' => 'AdminPanel.Topics'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'AdminPanel.Users'
        ]);
        $this->belongsToMany('Tags', [
            'through' => 'BlogTags',
        ]);
        $this->hasMany('BlogTags', [
            'foreignKey' => 'blog_id',
            'className' => 'AdminPanel.BlogTags'
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
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->allowEmptyFile('title', false);

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->allowEmptyFile('slug', false);

//        $validator
//            ->scalar('content')
//            ->requirePresence('content', 'create')
//            ->allowEmptyString('content', false);

//        $validator
//            ->integer('view')
//            ->requirePresence('view', 'create')
//            ->allowEmptyString('view', false);

        $validator
//            ->scalar('image')
            ->requirePresence('image', 'create')
            ->allowEmptyFile('image', true);

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
        $rules->add($rules->existsIn(['topic_id'], 'Topics'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
    public function validationTranslated(Validator $validator)
    {
        return $validator;
    }
}
