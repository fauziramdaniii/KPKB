<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use Cake\Validation\Validator;

/**
 * ProductStockMutationTransactions Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $ProductStockMutationTypes
 * @property \AdminPanel\Model\Table\ProductStockMutationsTable|\Cake\ORM\Association\HasMany $ProductStockMutations
 *
 * @method \AdminPanel\Model\Entity\ProductStockMutationTransaction get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\ProductStockMutationTransaction newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\ProductStockMutationTransaction[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\ProductStockMutationTransaction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\ProductStockMutationTransaction|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\ProductStockMutationTransaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\ProductStockMutationTransaction[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\ProductStockMutationTransaction findOrCreate($search, callable $callback = null, $options = [])
 */
class ProductStockMutationTransactionsTable extends Table
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

        $this->setTable('product_stock_mutation_transactions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');

        $this->belongsTo('ProductStockMutationTypes', [
            'foreignKey' => 'product_stock_mutation_type_id',
            'className' => 'AdminPanel.ProductStockMutationTypes'
        ]);
        $this->hasMany('ProductStockMutations', [
            'foreignKey' => 'product_stock_mutation_transaction_id',
            'className' => 'AdminPanel.ProductStockMutations'
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
            ->scalar('description')
            ->maxLength('description', 200)
            ->requirePresence('description', 'create')
            ->allowEmptyString('description', false);

        $validator
            ->numeric('amount')
            ->requirePresence('amount', 'create')
            ->allowEmptyString('amount', false);

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
        $rules->add($rules->existsIn(['product_stock_mutation_type_id'], 'ProductStockMutationTypes'));

        return $rules;
    }


    /**
     * @param $product_stock_type_id
     * @param $product_id
     * @param $supplier_id
     * @param $qty
     * @param $type
     * @param null $description
     * @param \Closure|null $callback
     * @return \AdminPanel\Model\Entity\ProductStock|bool|\Cake\Datasource\EntityInterface|false
     */
    public function create($product_stock_type_id, $product_id, $supplier_id, $qty, $type, $description = null, \Closure $callback = null)
    {
        /**
         * @var \AdminPanel\Model\Entity\ProductStock $products
         */
        $products = $this
            ->ProductStockMutations
            ->ProductStocks->find()
            ->select([
                'ProductStocks.id',
                'ProductStocks.product_id',
                'ProductStocks.quantity'
            ])
            ->where([
                'ProductStocks.product_id' => $product_id,
                'ProductStocks.supplier_id' => $supplier_id,
            ])
            ->epilog('FOR UPDATE')
            ->first();
//        debug([$product_id, $supplier_id]);exit;
        if ($products) {
            if($type == 'penambahan' ){
                $stock = floatval($products->get('quantity')) + $qty;
            }else{
                $stock = floatval($products->get('quantity')) + ($qty*-1);
            }

            if($stock >= 0){

                $entity = $this->newEntity([
                    'product_stock_mutation_type_id' => $product_stock_type_id,
                    'description' => $description,
                    'amount' => $qty
                ]);
                if ($this->save($entity)) {
                    $entityMutation = $this->ProductStockMutations->newEntity([
                        'product_stock_mutation_transaction_id' => $entity->id,
                        'product_stock_id' => $products->id,
                        'product_id' => $product_id,
                        'total_qty' => $stock
                    ]);

                    if($type == 'penambahan' ){
                        $entityMutation->qty_in = $qty;
                        $entityMutation->qty_out = 0;
                    }else{
                        $entityMutation->qty_in = 0;
                        $entityMutation->qty_out = $qty;
                    }

                    if ($this->ProductStockMutations->save($entityMutation)) {
                        $products->set('quantity', $stock);
                        $saved = $this
                            ->ProductStockMutations
                            ->ProductStocks
                            ->save($products);
                        if ($callback) {
                            call_user_func($callback, $entity, $entityMutation);
                        }
                        return $saved;
                    }
                }
            }else{

                return false;
            }
        }


        return false;
    }
}
