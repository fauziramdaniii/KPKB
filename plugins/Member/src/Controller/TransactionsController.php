<?php
namespace Member\Controller;

use Member\Controller\AppController;

/**
 * Transactions Controller
 *
 * @property \AdminPanel\Model\Table\TransactionsTable $Transactions
 * @method \Member\Model\Entity\Transaction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TransactionsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Transactions');
    }

    /**
     * Index method
     *
     */
    public function index()
    {
        $customer_id = $this->Auth->user('id');

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            $data = $this->Transactions->TransactionMutations->find();

            $data = $data
                ->contain([
                    'Transactions' => [
                        'TransactionTypes'
                    ]
                ])
                ->where([
                    'TransactionMutations.customer_id' => $customer_id
                ])
                ->orderDesc('Transactions.id');

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' => [
                        'TransactionMutations.amount LIKE' => '%' . $search .'%',
                        'Transactions.description LIKE' => '%' . $search .'%',
                    ]]);
                }

                $data->where($query);
                if (isset($query['transaction_type_id'])) {
                    $search = $query['transaction_type_id'];
                    $data->where([
                        'Transactions.transaction_type_id' => $search,
                    ]);
                }

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

        $transaction_types = $this->Transactions->TransactionTypes->find('list')->toArray();
        $this->set(compact('transaction_types'));
    }


}
