<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Galleries Model
 *
 * @property \AdminPanel\Model\Table\AlbumsTable|\Cake\ORM\Association\BelongsTo $Albums
 * @property |\Cake\ORM\Association\BelongsTo $Images
 *
 * @method \AdminPanel\Model\Entity\Gallery get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Gallery newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Gallery[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Gallery|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Gallery|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Gallery patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Gallery[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Gallery findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GalleriesTable extends Table
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

        $this->setTable('galleries');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Albums', [
            'foreignKey' => 'album_id',
            'className' => 'AdminPanel.Albums'
        ]);
        $this->belongsTo('Images', [
            'foreignKey' => 'image_id',
            'className' => 'AdminPanel.Images'
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
            ->maxLength('title', 150)
            ->allowEmptyString('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 200)
            ->allowEmptyString('slug');

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
        $rules->add($rules->existsIn(['album_id'], 'Albums'));
        $rules->add($rules->existsIn(['image_id'], 'Images'));

        return $rules;
    }
}
