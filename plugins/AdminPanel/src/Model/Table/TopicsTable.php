<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Topics Model
 *
 * @property \AdminPanel\Model\Table\BlogsTable|\Cake\ORM\Association\HasMany $Blogs
 *
 * @method \AdminPanel\Model\Entity\Topic get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Topic newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Topic[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Topic|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Topic|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Topic patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Topic[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Topic findOrCreate($search, callable $callback = null, $options = [])
 */
class TopicsTable extends Table
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

        $this->setTable('topics');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->addBehavior('Translate', [
            'fields' => ['name'],
            'allowEmptyTranslations' => false,
            'validator' => 'translated'
        ]);

        $this->hasMany('Blogs', [
            'foreignKey' => 'topic_id',
            'className' => 'AdminPanel.Blogs'
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
