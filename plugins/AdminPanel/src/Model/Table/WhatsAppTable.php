<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WhatsApp Table
 *
 * @method \AdminPanel\Model\Entity\WhatsApp get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\WhatsApp newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\WhatsApp[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\WhatsApp|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\WhatsApp saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\WhatsApp patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\WhatsApp[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\WhatsApp findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WhatsAppTable extends Table
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

        $this->setTable('whats_app');
        $this->setPrimaryKey('id');
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('no_whatsapp')
            ->maxLength('no_whatsapp', 20)
            ->requirePresence('no_whatsapp', 'create')
            ->notEmptyString('no_whatsapp');

        return $validator;
    }
}