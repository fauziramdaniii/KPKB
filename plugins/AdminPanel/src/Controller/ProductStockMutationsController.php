<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;

/**
 * Products Controller
 * @property \AdminPanel\Model\Table\ProductStockMutationsTable $ProductStockMutations
 *
 * @method \AdminPanel\Model\Entity\ProductStockMutations[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductStockMutationsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.ProductStockMutations');

    }

    public function index()
    {



        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->ProductStockMutations->find('all')
                ->select();
            $data->contain([
                'Products',
                'ProductStockMutationTransactions',
                'ProductStocks' => [
                    'Suppliers'
                ],
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
                        'ProductStockMutationTransactions.description LIKE' => '%' . $search .'%',
                        'ProductStockMutationTransactions.created LIKE' => '%' . $search .'%',
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
    }


}
