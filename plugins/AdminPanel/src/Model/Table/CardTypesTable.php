<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CardTypes Model
 *
 * @property \AdminPanel\Model\Table\CardsTable|\Cake\ORM\Association\HasMany $Cards
 *
 * @method \AdminPanel\Model\Entity\CardType get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\CardType newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\CardType[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CardType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\CardType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\CardType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CardType[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CardType findOrCreate($search, callable $callback = null, $options = [])
 */
class CardTypesTable extends Table
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

        $this->setTable('card_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Cards', [
            'foreignKey' => 'card_type_id',
            'className' => 'AdminPanel.Cards'
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
}
