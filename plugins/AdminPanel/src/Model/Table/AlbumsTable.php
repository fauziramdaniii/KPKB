<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Albums Model
 *
 * @property \AdminPanel\Model\Table\GalleriesTable|\Cake\ORM\Association\HasMany $Galleries
 *
 * @method \AdminPanel\Model\Entity\Album get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Album newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Album[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Album|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Album|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Album patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Album[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Album findOrCreate($search, callable $callback = null, $options = [])
 */
class AlbumsTable extends Table
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

        $this->setTable('albums');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Translate', [
            'fields' => ['name'],
            'allowEmptyTranslations' => false,
            'validator' => 'translated'
        ]);

        $this->hasMany('Galleries', [
            'foreignKey' => 'album_id',
            'className' => 'AdminPanel.Galleries'
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
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        return $validator;
    }
    public function validationTranslated(Validator $validator)
    {
        return $validator;
    }
}
