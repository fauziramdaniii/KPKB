<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CardStatuses Model
 *
 * @property \AdminPanel\Model\Table\CardsTable|\Cake\ORM\Association\HasMany $Cards
 *
 * @method \AdminPanel\Model\Entity\CardStatus get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\CardStatus newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\CardStatus[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CardStatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\CardStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\CardStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CardStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\CardStatus findOrCreate($search, callable $callback = null, $options = [])
 */
class CardStatusesTable extends Table
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

        $this->setTable('card_statuses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Cards', [
            'foreignKey' => 'card_status_id',
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
