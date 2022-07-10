<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;

/**
 * Products Controller
 * @property \AdminPanel\Model\Table\ProductStocksTable $ProductStocks
 * @property \AdminPanel\Model\Table\ProductsTable $Products
 * @property \AdminPanel\Model\Table\CardsTable $Cards
 * @property \AdminPanel\Model\Table\SuppliersTable $Suppliers
 * @property \AdminPanel\Model\Table\ProductStockMutationTransactionsTable $ProductStockMutationTransactions
 *
 * @method \AdminPanel\Model\Entity\ProductStocks[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductStocksController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.ProductStocks');
        $this->loadModel('AdminPanel.Products');
        $this->loadModel('AdminPanel.Suppliers');
        $this->loadModel('AdminPanel.Cards');
        $this->loadModel('AdminPanel.ProductStockMutationTransactions');

    }

    public function index($supplier_id = null)
    {
        $supplier_id = $supplier_id == null ? 1 : $supplier_id;
        $suppliers = $this->Suppliers->find('list')->toArray();
        $auth = $this->Auth->user();
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');
            $status = $this->request->getData('status');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->ProductStocks->find('all')
                ->where([
                    'ProductStocks.supplier_id' => $supplier_id
                ])
                ->select();
            $data->contain([
                'Products'
            ]);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' => [
                        'Products.name LIKE' => '%' . $search .'%',
                        'Products.sku LIKE' => '%' . $search .'%',
                    ]]);
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

        $this->set(compact('auth', 'suppliers', 'supplier_id'));
    }

    protected function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function confirm(){

        $auth = $this->Auth->user();
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
            $data = $this->request->getData('ids');
            $supplier_id = $this->request->getData('supplier_id');
            if($data){
                $result = true;
                foreach($data as $vals){
                    $product_stock_type_id = ($vals['type'] == 'penambahan') ? 1 : 2;
                    $pStock = $this->ProductStocks->get($vals['id']);
                    $product_id = $pStock->product_id;
                    $qty = $vals['qty'];
                    $transaction = $this->ProductStockMutationTransactions->create($product_stock_type_id, $product_id, $supplier_id, $qty, strtolower($vals['type']), ucfirst($vals['type']).' stock mutasi by '.$auth['first_name'].' '.$auth['last_name']);
                    if($transaction){
                         //generate card

                        $lastCount = $this->Cards->find()
                            ->where(['Cards.card_type_id' => 2])
                            ->count();

                        /*
                        $this->Cards->getConnection()->begin();
                        for($i = 1; $i <= $qty; $i++) {
                            $entity = $this->Cards->newEntity([
                                'serial' => $this->generateRandomString(),
                                'supplier_id' => $supplier_id,
                                'product_id' => $product_id,
                                'card_number' => 'IDF'.sprintf('%07d',$lastCount + 1),
                                'card_status_id' => 1,
                                'card_type_id' => 2
                            ]);
                            $this->Cards->save($entity);
                            $lastCount++;
                        }

                        $this->Cards->getConnection()->commit();
                        */
                    }else{
                        $result = false;
                        break;
                    }
                }
                if($result){
                    $this->Flash->success(__('Stock produk berhasil di update'));
                }else{
                    $this->Flash->error(__('Gagal update stock produk silahkan periksa kembali'));
                }
            }else{

                $result = false;
            }

            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
    }

}
