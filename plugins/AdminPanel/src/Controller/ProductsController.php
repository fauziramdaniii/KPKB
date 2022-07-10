<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;

/**
 * Products Controller
 * @property \AdminPanel\Model\Table\ProductsTable $Products
 * @property \AdminPanel\Model\Table\SuppliersTable $Suppliers
 * @property \AdminPanel\Model\Table\ProductStocksTable $ProductStocks
 *
 * @method \AdminPanel\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{


    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Products');
        $this->loadModel('AdminPanel.Suppliers');
        $this->loadModel('AdminPanel.ProductStocks');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {


        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Products->find('all')
                ->select();
            $data->contain(['ProductUnits']);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                        custom field for general search
                        ex : 'Users.email LIKE' => '%' . $search .'%'
                    **/
                    $data->where(['Products.name LIKE' => '%' . $search .'%']);
                }
                $data->where($query);
            }

            if (isset($sort['field']) && isset($sort['sort'])) {
                $data->order([$sort['field'] => $sort['sort']]);
            }

            if (isset($pagination['perpage']) && is_numeric($pagination['perpage'])) {
                $data->limit($pagination['perpage']);
            }
            if (isset($pagination['page']) && is_numeric($pagination['page'])) {
                $data->page($pagination['page']);
            }

            $total = $data->count();

            $result = [];
            $result['data'] = $data->toArray();


            $result['meta'] = array_merge((array) $pagination, (array) $sort);
            $result['meta']['total'] = $total;


            return $this->response->withType('application/json')
            ->withStringBody(json_encode($result));
        }


        //$this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('ajax');
        $product = $this->Products->get($id, [
            'contain' => ['Suppliers', 'ProductUnits', 'ProductStockMutations', 'ProductStocks']
        ]);

        $this->set('product', $product);
    }

    protected function addStocks($product_id, $stock = 0)
    {
        $suppliers = $this->Suppliers->find();
        if (!$suppliers->isEmpty()) {
            foreach($suppliers as $supplier) {
                $exists = $this->ProductStocks->find()
                    ->where([
                        'product_id' => $product_id,
                        'supplier_id' => $supplier->id,
                    ])
                    ->count();

                if ($exists === 0) {
                    $stockEntity = $this->ProductStocks->newEntity([
                        'product_id' => $product_id,
                        'supplier_id' => $supplier->id,
                        'quantity' => $stock
                    ]);
                    $this->ProductStocks->save($stockEntity);
                }

            }
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {

            $validator = $this->Products->getValidator('default');
            $validator->remove('point');
            $validator->add('image', 'mime', [
                'rule' => function($value) {
                    $mime = mime_content_type($value['tmp_name']);
                    return in_array($mime, [
                        'image/png',
                        'image/jpeg',
                        'image/gif',
                    ]);
                },
                'message' => 'Not valid file type'
            ]);

            $product = $this->Products->patchEntity($product, $this->request->getData());
            $product->card_type_id = 2;
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                $this->addStocks($product->id);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        //$suppliers = $this->Products->Suppliers->find('list', ['limit' => 200]);
        $productUnits = $this->Products->ProductUnits->find('list', ['limit' => 200]);
        $productType= $this->Products->CardTypes->find('list', ['limit' => 200]);
        $this->set(compact('product', 'productUnits','productType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $validator = $this->Products->getValidator('default')
            ->add('image', 'mime', [
                'rule' => function($value) {
                    $mime = mime_content_type($value['tmp_name']);
                    return in_array($mime, [
                        'image/png',
                        'image/jpeg',
                        'image/gif',
                    ]);
                },
                'message' => 'Not valid file type'
            ])
            ->allowEmptyFile('image');

            $product = $this->Products->patchEntity($product, $this->request->getData());
            $product->card_type_id = 2;
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        //$suppliers = $this->Products->Suppliers->find('list', ['limit' => 200]);
        $productUnits = $this->Products->ProductUnits->find('list', ['limit' => 200]);
        $productType= $this->Products->CardTypes->find('list', ['limit' => 200]);
        $this->set(compact('product', 'productUnits','productType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        try {
            if ($this->Products->delete($product)) {
                $this->Flash->success(__('The product has been deleted.'));
            } else {
                $this->Flash->error(__('The product could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
