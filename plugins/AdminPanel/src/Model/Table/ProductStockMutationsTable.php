<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductStockMutations Model
 *
 * @property \AdminPanel\Model\Table\ProductStockMutationTransactionsTable|\Cake\ORM\Association\BelongsTo $ProductStockMutationTransactions
 * @property \AdminPanel\Model\Table\ProductsTable|\Cake\ORM\Association\BelongsTo $Products
 * @property \AdminPanel\Model\Table\ProductStocksTable|\Cake\ORM\Association\BelongsTo $ProductStocks
 *
 * @method \AdminPanel\Model\Entity\ProductStockMutation get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\ProductStockMutation newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\ProductStockMutation[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\ProductStockMutation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\ProductStockMutation|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\ProductStockMutation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\ProductStockMutation[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\ProductStockMutation findOrCreate($search, callable $callback = null, $options = [])
 */
class ProductStockMutationsTable extends Table
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

        $this->setTable('product_stock_mutations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');

        $this->belongsTo('ProductStockMutationTransactions', [
            'foreignKey' => 'product_stock_mutation_transaction_id',
            'joinType' => 'INNER',
            'className' => 'AdminPanel.ProductStockMutationTransactions'
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
            'className' => 'AdminPanel.Products'
        ]);
        $this->belongsTo('ProductStocks', [
            'foreignKey' => 'product_stock_id',
            'joinType' => 'INNER',
            'className' => 'AdminPanel.ProductStocks'
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
            ->numeric('qty_in')
            ->requirePresence('qty_in', 'create')
            ->allowEmptyString('qty_in', false);

        $validator
            ->numeric('qty_out')
            ->requirePresence('qty_out', 'create')
            ->allowEmptyString('qty_out', false);

        $validator
            ->numeric('total_qty')
            ->requirePresence('total_qty', 'create')
            ->allowEmptyString('total_qty', false);

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
        $rules->add($rules->existsIn(['product_stock_mutation_transaction_id'], 'ProductStockMutationTransactions'));
        $rules->add($rules->existsIn(['product_id'], 'Products'));
        $rules->add($rules->existsIn(['product_stock_id'], 'ProductStocks'));

        return $rules;
    }
}
