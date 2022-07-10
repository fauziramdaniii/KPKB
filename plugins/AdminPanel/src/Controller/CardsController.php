<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use AdminPanel\Model\Entity\Product;

/**
 * Cards Controller
 *
 * @property \AdminPanel\Model\Table\CardsTable $Cards
 *
 * @method \AdminPanel\Model\Entity\Card[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CardsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {


        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Cards->find()
                ->select()
                ->contain([
                    'CardStatuses',
                    'CardTypes',
                    'CustomersAlias',
                    'Stockists',
                    'Products',
                    'Suppliers',
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
                        'Cards.serial LIKE' => '%' . $search .'%',
                        'Customers.username LIKE' => '%' . $search .'%',
                        'Cards.card_number LIKE' => '%' . $search .'%',
                    ]]);
                }
                if (isset($query['card_status_id'])) {
                    $card_status_id = $query['card_status_id'];
                    //unset($query['card_status_id']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['Cards.card_status_id' => $card_status_id]);
                }
                //$data->where($query);
            }

            if (isset($sort['field']) && isset($sort['sort'])) {
                $mapSort = [
                  'id' => 'Cards.id',
                  'serial' => 'Cards.serial',
                  'card_status' => 'CardStatuses.name',
                  'customer.username' => 'Customers.username',
                  'customer.phone' => 'Customers.phone',
                  'created' => 'Cards.created',
                ];
                if (isset($mapSort[$sort['field']])) {
                    $data->order([$mapSort[$sort['field']] => $sort['sort']]);
                }

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

        $cardStatuses = $this->Cards->CardStatuses->find('list', ['limit' => 200]);
        $this->set(compact('cardStatuses'));

    }

}
