<?php
namespace Member\Controller;

use Cake\Event\Event;
use AdminPanel\Model\Entity\TransactionType;
use Cake\Core\Configure;
use Cake\I18n\Time;
use Member\Controller\AppController;

/**
 * RepeatOrders Controller
 *
 * @property \AdminPanel\Model\Table\RepeatOrdersTable $RepeatOrders
 * @property \AdminPanel\Model\Table\CustomerRanksTable $CustomerRanks
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 * @property \AdminPanel\Model\Table\TransactionsTable $Transactions
 * @property \AdminPanel\Model\Table\GenerationsTable $Generations
 * @property \AdminPanel\Model\Table\CardsTable $Cards
 * @property \AdminPanel\Model\Table\NetworksTable $Networks
 * @method \Member\Model\Entity\RepeatOrder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SerialsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if ($this->Auth->user('customer_type_id') != 2) {
            $this->Flash->error(__('Oops...Authorization for customer only'));
            $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.RepeatOrders');
        $this->loadModel('AdminPanel.CustomerRanks');
        $this->loadModel('AdminPanel.Customers');
        $this->loadModel('AdminPanel.Cards');
        $this->loadModel('AdminPanel.Transactions');
        $this->loadModel('AdminPanel.Networks');
//        $this->loadModel('AdminPanel.Generations');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $customer_id = $this->Auth->user('id');


        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            $data = $this->Cards->find();

            $data = $data
                ->select([
                    'Cards.card_status_id',
                    'Cards.card_number',
                    'Cards.serial',
                    'Products.name',
                    'CardStatuses.name',
                    'CustomersAlias.username'
                ])
                ->contain([
                    'Products',
                    'CardStatuses',
                    'CustomersAlias',
                ])
                ->where([
                    'stockist_id' => $customer_id
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
                        'Cards.card_number LIKE' => '%' . $search .'%',
                        'Products.name LIKE' => '%' . $search .'%',
                        'Cards.serial LIKE' => '%' . $search .'%'
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

//    public function add()
//    {
//        $customer_id = $this->Auth->user('id');
//
//        $repeat_order = $this->RepeatOrders->newEntity([
//            'customer_id' => $customer_id
//        ]);
//
//        if ($this->getRequest()->is('post')) {
//
//            /**
//             * @var \AdminPanel\Model\Entity\Card $cardEntity
//             */
//            $cardEntity = $this->RepeatOrders->Cards->find()
//                ->where([
//                    'card_type_id' => 2,
//                    'serial' => $this->getRequest()->getData('serial')
//                ])
//                ->first();
//
//
//
//            $validator = $this->RepeatOrders->getValidator('default')
//                ->requirePresence('serial')
//                ->add('serial', 'check', [
//                    'rule' => function($value) use($cardEntity) {
//                        return $cardEntity && strtoupper($cardEntity->serial) === strtoupper($value);
//                    },
//                    'message' => __( 'Invalid serial number.')
//                ]);
//
//            if ($cardEntity) {
//                $validator
//                    ->add('serial', 'used', [
//                    'rule' => function($value) use($cardEntity) {
//                        return !in_array($cardEntity->card_status_id, [2]);
//                    },
//                    'message' => __( 'This serial has been used.')
//                ])
//                    ->add('serial', 'status', [
//                        'rule' => function($value) use($cardEntity) {
//                            return $cardEntity->card_status_id === 4 || $cardEntity->card_status_id === 2;
//                        },
//                        'message' => __( 'This serial has not active.')
//                    ]);
//            }
//
//
//            $this->RepeatOrders->patchEntity($repeat_order, $this->getRequest()->getData(), [
//                'fields' => [
//                    'serial'
//                ]
//            ]);
//
//           if (!$repeat_order->getErrors()) {
//                $repeat_order->card_id = $cardEntity->id;
//                $repeat_order->repeat_date = Time::now()->format('Y-m-d');
//                if ($this->RepeatOrders->save($repeat_order)) {
//                    $cardEntity->set('card_status_id', 2);
//                    $this->RepeatOrders->Cards->save($cardEntity);
//
//                    if(date('Y-m-d') >= '2020-03-01'){
//
//                        $rank_lists = Configure::read('SharingProfit.percentage', []);
//                        $customers = $this->Customers->find()
//                            ->select([
//                                'username' => 'Customers.username',
//                                'rank_id' => 'Customers.rank_id',
//                                'rank_name' => 'Ranks.name',
//                                'network_id' => 'Networks.id',
//                            ])
//                            ->contain([
//                                'Ranks',
//                                'Networks'
//                            ])
//                            ->where([
//                                'Customers.id' => $customer_id
//                            ])->first();
//
//                        $current_rank = $rank_lists[$customers->rank_id];
//                        $sharingProfit = Configure::read('SharingProfit.bonus', 14000);
//
//                        $bonus_out = 0;
//                        /* PERSONAL */
////                        $bonus = round(($sharingProfit * $current_rank['percent']), 2);
//                        $bonus = round(($sharingProfit * 0.35), 2);
//
//                        $this->Transactions->create(
//                            TransactionType::BONUSPROFIT,
//                            $customer_id,
//                            $bonus,
//                            'Bonus sharing profit personal'
//                        );
//
//
//                       $bonusShelters = $this->BonusShelters->find()
//                           ->where([
//                               'id' => $customers->rank_id,
//                           ])
//                           ->first();
//                       $bonusShelters->set('payout', $bonusShelters->payout + $bonus);
//                       $this->BonusShelters->save($bonusShelters);
//
//                        $bonus_out += $bonus;
//
//                        /*breakdown network keatas*/
//                        $path_upline = $this->Networks->find('path', ['for' => $customers->network_id])
//                            ->enableAutoFields(true)
//                            ->select([
//                                'username' => 'Customers.username',
//                                'rank_id' => 'Customers.rank_id',
//                                'id' => 'Customers.id',
//                                'rank_name' => 'Ranks.name',
//                                'customer_id' => 'Customers.id',
//                            ])
//                            ->leftJoin(['Customers' => 'customers'], ['Customers.id = Networks.customer_id'])
//                            ->leftJoin(['Ranks' => 'ranks'], ['Ranks.id = Customers.rank_id'])
//                            ->order(['Networks.lft' => 'DESC'])
//                            ->map(function (\AdminPanel\Model\Entity\Network $row){
//
//                                $row->total = $this->RepeatOrders->find()
//                                    ->where(['RepeatOrders.customer_id' => $row->customer_id])
//                                    ->where(function(\Cake\Database\Expression\QueryExpression $q) {
//                                        return $q->between(
//                                            'repeat_date',
//                                            date('Y-m-01'),
//                                            date('Y-m-t')
//                                        );
//                                    })->count();
//                                return $row;
//                            })
//                            ->toArray();
//
//                        foreach($path_upline as $key => $upline){
//                            if($upline->rank_id <= $customers->rank_id){
//                                unset($path_upline[$key]);
//                            }
//                        }
//
//                        foreach($rank_lists as $key => $vals){
//                            /* simpan tampungan bonus */
//                            $bonusShelters = $this->BonusShelters->find()
//                                ->where([
//                                    'id' => $key,
//                                ])
//                                ->first();
//                            $bonusShelters->set('amount', $bonusShelters->amount + round(($sharingProfit * $vals['percent']), 2));
//                            $this->BonusShelters->save($bonusShelters);
//                        }
//                        $holder_key = 0;
//                        $holder_key_arr = []; //
//                        foreach($path_upline as $upline){
//                            if($upline->rank_id > $customers->rank_id){
//                                $upline_rank = $rank_lists[$upline->rank_id];
//                                $bonus_omzet = round(($sharingProfit * $upline_rank['percent']), 2);
//
//
//                                if(($holder_key >= $upline->rank_id) || ($upline->rank_id == 5) || in_array($upline->rank_id,$holder_key_arr)){
//                                    continue;
//                                }else{
//
//                                    if($rank_lists[$upline->rank_id]['min_repeat_order'] <= $upline->total){
//
//                                        $holder_key = $upline->rank_id;
//                                        $holder_key_arr[] = $upline->rank_id;
//                                        /* memulai pembagian bonus ke upline */
//                                        $this->Transactions->create(
//                                            TransactionType::BONUSPROFIT,
//                                            $upline->id,
//                                            $bonus_omzet,
//                                            'Bonus sharing profit omzet group '.$customers->rank_name.' terhadap '.$upline->rank_name
//                                        );
//
//                                        $bonusShelters = $this->BonusShelters->find()
//                                            ->where([
//                                                'id' => $upline->rank_id,
//                                            ])
//                                            ->first();
//                                        $bonusShelters->set('payout', $bonusShelters->payout + $bonus_omzet);
//                                        $this->BonusShelters->save($bonusShelters);
//
//                                        $bonus_out += $bonus_omzet;
//                                    }
//
//                                }
//                            }
//                        }
//                    }
//                    $this->Flash->success(__( 'The repeat order process was successfully redeemed'));
//                    return $this->redirect(['action' => 'add']);
//                } else {
//                    $this->Flash->error(__( 'The repeat order process was failed redeemed'));
//                }
//           }
//
//        }
//
//        $this->set(compact('repeat_order'));
//    }


}
