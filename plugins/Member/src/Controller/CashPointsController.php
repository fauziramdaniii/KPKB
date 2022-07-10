<?php
namespace Member\Controller;

use Member\Controller\AppController;

/**
 * CashPoints Controller
 *
 * @property \AdminPanel\Model\Table\CashPointsTable $CashPoints
 * @method \Member\Model\Entity\CashPoint[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CashPointsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.CashPoints');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $customer_id = $this->Auth->user('id');

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            $data = $this->CashPoints->find();

            $data = $data
                ->contain([
                    'FromCustomers'
                ])
                ->where([
                    'CashPoints.customer_id' => $customer_id
                ])
                ->orderDesc('CashPoints.id');

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' => [
                        //'CustomerStatements.amount' => '' . $search .'',
                        'FromCustomers.username LIKE' => '%' . $search .'%',
                        'CashPoints.description LIKE' => '%' . $search .'%',
                    ]]);
                }

                $data->where($query);
                /*
                if (isset($query['transaction_type_id'])) {
                    $search = $query['transaction_type_id'];
                    $data->where([
                        'Transactions.transaction_type_id' => $search,
                    ]);
                }
                */

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
