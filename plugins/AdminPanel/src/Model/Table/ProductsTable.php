<?php
namespace AdminPanel\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \AdminPanel\Model\Table\CardTypesTable&\Cake\ORM\Association\BelongsTo $CardTypes
 * @property \AdminPanel\Model\Table\ProductUnitsTable&\Cake\ORM\Association\BelongsTo $ProductUnits
 * @property \AdminPanel\Model\Table\CardsTable&\Cake\ORM\Association\HasMany $Cards
 * @property &\Cake\ORM\Association\HasMany $CustomerStockMutations
 * @property &\Cake\ORM\Association\HasMany $CustomerStocks
 * @property &\Cake\ORM\Association\HasMany $OrderDetails
 * @property \AdminPanel\Model\Table\ProductStockMutationsTable&\Cake\ORM\Association\HasMany $ProductStockMutations
 * @property \AdminPanel\Model\Table\ProductStocksTable&\Cake\ORM\Association\HasMany $ProductStocks
 *
 * @method \AdminPanel\Model\Entity\Product get($primaryKey, $options = [])
 * @method \AdminPanel\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \AdminPanel\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminPanel\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \AdminPanel\Model\Entity\Product findOrCreate($search, callable $callback = null, $options = [])
 */
class ProductsTable extends Table
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

        $this->setTable('products');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'image' => [
                'nameCallback' => function ($tableObj, $entity, $data, $field, $settings) {
                    $ext = substr(strrchr($data['name'], '.'), 1);
                    return str_replace('-', '', Text::uuid()) . '.' . 'jpg';
                },
                // This can also be in a class that implements
                // the TransformerInterface or any callable type.
                'transformer' => function (\Cake\Datasource\RepositoryInterface $table,
                                           \Cake\Datasource\EntityInterface $entity,
                                           $data, $field, $settings) {
                    // get the extension from the file
                    // there could be better ways to do this, and it will fail
                    // if the file has no extension
                    $extension = pathinfo($data['name'], PATHINFO_EXTENSION);
                    // Store the thumbnail in a temporary file
                    $tmp = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;
                    // Use the Imagine library to DO THE THING
                    $size = new \Imagine\Image\Box(80, 80);
                    $mode = \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;
                    $imagine = new \Imagine\Gd\Imagine();
                    // Save that modified file to our temp file

                    $save = false;

                    try {
                        $save = $imagine->open($data['tmp_name'])
                            ->thumbnail($size, $mode)
                            ->save($tmp);
                    } catch(\Exception $e) {
                        //debug($e->getMessage());exit;
                    }

                    if ($save && $entity->isDirty('avatar')) {
                        $original = $entity->getOriginal('avatar');
                        $path = WWW_ROOT . 'files' . DS . $this->getAlias() . DS . $field . DS;
                        if ($original && file_exists($path . $original)) {
                            unlink($path . $original);
                        }
                        if ($original && file_exists($path . 'thumbnail-' . $original)) {
                            unlink($path . 'thumbnail-' . $original);
                        }
                    }


                    // Now return the original *and* the thumbnail
                    return [
                        $data['tmp_name'] => $data['name'],
                        $tmp => 'thumbnail-' . $data['name'],
                    ];
                },
                'deleteCallback' => function ($path, $entity, $field, $settings) {
                    // When deleting the entity, both the original and the thumbnail will be removed
                    // when keepFilesOnDelete is set to false

                    return [
                        $path . $entity->{$field}
                    ];
                },
                'keepFilesOnDelete' => false
            ],
        ]);

        $this->belongsTo('CardTypes', [
            'foreignKey' => 'card_type_id',
            'joinType' => 'INNER',
            'className' => 'AdminPanel.CardTypes',
        ]);
        $this->belongsTo('ProductUnits', [
            'foreignKey' => 'product_unit_id',
            'joinType' => 'INNER',
            'className' => 'AdminPanel.ProductUnits',
        ]);
        $this->hasMany('Cards', [
            'foreignKey' => 'product_id',
            'className' => 'AdminPanel.Cards',
        ]);
        $this->hasMany('CustomerStockMutations', [
            'foreignKey' => 'product_id',
            'className' => 'AdminPanel.CustomerStockMutations',
        ]);
        $this->hasMany('CustomerStocks', [
            'foreignKey' => 'product_id',
            'className' => 'AdminPanel.CustomerStocks',
        ]);
        $this->hasMany('OrderDetails', [
            'foreignKey' => 'product_id',
            'className' => 'AdminPanel.OrderDetails',
        ]);
        $this->hasMany('ProductStockMutations', [
            'foreignKey' => 'product_id',
            'className' => 'AdminPanel.ProductStockMutations',
        ]);
        $this->hasMany('ProductStocks', [
            'foreignKey' => 'product_id',
            'className' => 'AdminPanel.ProductStocks',
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
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('sku')
            ->maxLength('sku', 50)
            ->requirePresence('sku', 'create')
            ->notEmptyString('sku');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->numeric('price')
            ->notEmptyString('price');

        $validator
            ->numeric('stokist_price')
            ->allowEmptyString('stokist_price');

        $validator
            ->integer('point')
            ->requirePresence('point', 'create')
            ->notEmptyString('point');

        $validator
            ->integer('on_sales')
            ->notEmptyString('on_sales');

        $validator
            ->numeric('weight')
            ->allowEmptyString('weight');

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
        $rules->add($rules->existsIn(['card_type_id'], 'CardTypes'));
        $rules->add($rules->existsIn(['product_unit_id'], 'ProductUnits'));

        return $rules;
    }
}
