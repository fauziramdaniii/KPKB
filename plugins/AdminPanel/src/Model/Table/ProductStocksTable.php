<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductStocks Model
 *
 * @property \AdminPanel\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property &\Cake\ORM\Association\BelongsTo $Suppliers
 * @property \AdminPanel\Model\Table\ProductStockMutationsTable&\Cake\ORM\Association\HasMany $ProductStockMutations
 *
 * @method \AdminPanel\Model\Entity\ProductStock get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\ProductStock newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\ProductStock[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\ProductStock|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\ProductStock saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\ProductStock patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\ProductStock[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\ProductStock findOrCreate($search, callable $callback = null, $options = [])
 */
class ProductStocksTable extends Table
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

        $this->setTable('product_stocks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
            'className' => 'AdminPanel.Products',
        ]);
        $this->belongsTo('Suppliers', [
            'foreignKey' => 'supplier_id',
            'className' => 'AdminPanel.Suppliers',
        ]);
        $this->hasMany('ProductStockMutations', [
            'foreignKey' => 'product_stock_id',
            'className' => 'AdminPanel.ProductStockMutations',
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->numeric('quantity')
            ->notEmptyString('quantity');

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
        $rules->add($rules->existsIn(['product_id'], 'Products'));
        $rules->add($rules->existsIn(['supplier_id'], 'Suppliers'));

        return $rules;
    }
}
