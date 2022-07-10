<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductUnits Model
 *
 * @property \AdminPanel\Model\Table\ProductsTable|\Cake\ORM\Association\HasMany $Products
 *
 * @method \AdminPanel\Model\Entity\ProductUnit get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\ProductUnit newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\ProductUnit[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\ProductUnit|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\ProductUnit|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\ProductUnit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\ProductUnit[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\ProductUnit findOrCreate($search, callable $callback = null, $options = [])
 */
class ProductUnitsTable extends Table
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

        $this->setTable('product_units');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Products', [
            'foreignKey' => 'product_unit_id',
            'className' => 'AdminPanel.Products'
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
            ->maxLength('name', 20)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        return $validator;
    }
}
