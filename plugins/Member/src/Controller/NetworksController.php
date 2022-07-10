<?php
namespace Member\Controller;

use Member\Controller\AppController;

/**
 * Networks Controller
 *
 * @property \AdminPanel\Model\Table\NetworksTable $Networks
 * @method \Member\Model\Entity\Network[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NetworksController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Networks');
    }


    protected function childCount(\AdminPanel\Model\Entity\Network &$node)
    {
        $node->childCount = $this->Networks->childCount($node);
        if (!empty($node->children)) {
            /**
             * @var \AdminPanel\Model\Entity\Network[] $children
             */

            foreach($node->children as &$child) {
                $child->childCount = $this->Networks->childCount($child);
                if (!empty($child->children)) {
                    $this->childCount($child);
                }
            }

        }
    }


    public function index($id = null)
    {
        $customer_id = $this->Auth->user('id');

        if ($this->getRequest()->is('post')) {
            $search = $this->getRequest()->getData('search');
            $search = strip_tags($search);
            $customerEntity = $this->Networks->Customers->find()
                ->where([
                    'OR' => [
                        'Customers.username' => $search,
                        'Customers.first_name' => $search,
                        'Customers.last_name' => $search
                    ]
                ])
                ->first();
            if ($customerEntity) {
                return $this->redirect(['action' => 'index', $customerEntity->id]);
            }
            $this->Flash->error(__( 'The search with keyword {0} not found', [$search]));
        }

        $node = !empty($id) ? $id : $customer_id;


        $mynetwork = $this->Networks->find()
            ->select(['id', 'customer_id'])
            ->where([
                'customer_id' => $customer_id
            ])
            ->first();


        $network = $this->Networks->find()
            ->contain([
                'Customers',
                'ParentNetworks' => [
                    'Customers'
                ]
            ])
            ->where([
                'Networks.customer_id' => $node
            ])
            ->map(function(\AdminPanel\Model\Entity\Network $row) {
                $row->childCount = $this->Networks->childCount($row);
                return $row;
            })
            ->first();
//        debug($network);exit;
        if ($network) {

            //debug($network);exit;
            if ($id) {
                $in_network = $this->Networks->find('children', ['for' => $mynetwork->id])
                    ->where([
                        'Networks.id' => $network->id
                    ])
                    ->count();

                if ($id != $mynetwork->customer_id && $in_network == 0) {
                    $this->Flash->error(__('The target not in your network.'));
                    return $this->redirect(['action' => 'index']);
                }
            }


            $childs = $this->Networks->find('children', ['for' => $network->id]);

            $childs = $childs
                ->enableAutoFields(true)
                ->select([
                    'rlevel' => "(Networks.level - {$network->get('level')} + 1)"
                ])
                ->find('threaded')
                ->contain([
                    'Customers'
                ])
                ->where(function(\Cake\Database\Expression\QueryExpression $q) use ($network) {
                    return $q->lte('level', intval($network->get('level')) + 4);
                })
                ->orderAsc('level')
                ->map(function(\AdminPanel\Model\Entity\Network $row) {
                    $this->childCount($row);
                    //debug($row);
                    return $row;
                })
                ->toArray();

//            debug($childs);exit;
        }

//        debug($network);exit;
        $this->set(compact('network', 'childs', 'mynetwork'));
    }

    /**
     * View method
     *
     * @param string|null $id Network id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $network = $this->Networks->get($id, [
            'contain' => []
        ]);

        $this->set('network', $network);
    }


}
