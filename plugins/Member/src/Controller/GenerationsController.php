<?php
namespace Member\Controller;

use Cake\Database\Expression\QueryExpression;
use Cake\Database\Query;
use Member\Controller\AppController;

/**
 * Generations Controller
 *
 * @property \AdminPanel\Model\Table\GenerationsTable $Generations
 */
class GenerationsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Generations');
    }

    /**
     * Index method
     */
    public function index()
    {
        exit;
        $customer_id = $this->Auth->user('id');
        //debug($this->Generations->levelCount($customer_id));exit;
        //exit;

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            $data = $this->Generations->find();

            $data = $data
                ->select([
                    'id',
                    'level',
                    'refferal_id',
                    'total' => $data->func()->count('level')
                ])
                ->where([
                    'refferal_id' => $customer_id
                ])
                ->group(['level']);



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

    public function detail($level)
    {
        $customer_id = $this->Auth->user('id');

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            $data = $this->Generations->find();

            $data = $data
                ->select()
                ->contain([
                    'Customers' => [
                        'Ranks'
                    ]
                ])
                ->where([
                    'Generations.refferal_id' => $customer_id,
                    'level' => $level
                ]);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where([
                        'OR' => [
                            'Customers.username LIKE' => '%' . $search . '%',
                            'Customers.first_name LIKE' => '%' . $search . '%',
                            'Customers.last_name LIKE' => '%' . $search . '%',
                        ]
                    ]);
                }

                if (array_key_exists('rank_id', $query)) {
                    $data->where($query);
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

        $ranks = $this->Generations->Customers->Ranks->find('list');

        $this->set(compact('level','ranks'));
    }


}
