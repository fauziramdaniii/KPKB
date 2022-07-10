<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use AdminPanel\Model\Entity\TransactionType;
use Cake\Core\Configure;
use Cake\I18n\Time;

/**
 * Withdrawals Controller
 * @property \AdminPanel\Model\Table\OrdersTable $Orders
 * @property \AdminPanel\Model\Table\CardsTable $Cards
 * @property \AdminPanel\Model\Table\OrderDetailsTable $OrderDetails
 * @property \AdminPanel\Model\Table\GenerationsTable $Generations
 * @property \AdminPanel\Model\Table\ProductStockMutationTransactionsTable $ProductStockMutationTransactions
 * @property \AdminPanel\Model\Table\ProductsTable $Products
 * @property \AdminPanel\Model\Table\TransactionsTable $Transactions
 * @property \AdminPanel\Model\Table\CashPointsTable $CashPoints
 * @property \AdminPanel\Model\Table\NetworksTable $Networks
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 * @property \AdminPanel\Controller\Component\LevelDeterminantComponent $LevelDeterminant
 */
class OrdersController extends AppController
{

    public function initialize()
    {

        parent::initialize();
        $this->loadModel('AdminPanel.Customers');
        $this->loadModel('AdminPanel.Orders');
        $this->loadModel('AdminPanel.OrderDetails');
        $this->loadModel('AdminPanel.Cards');
        $this->loadModel('AdminPanel.Products');
        $this->loadModel('AdminPanel.Transactions');
        $this->loadModel('AdminPanel.Networks');
        $this->loadModel('AdminPanel.CashPoints');
        $this->loadModel('AdminPanel.Generations');
        $this->loadComponent('AdminPanel.LevelDeterminant');
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

    public function print($invoice = null){
        $data = $this->Orders->find()
            ->contain([
            'OrderStatuses',
            'OrderConfirmations' => [
                'Images',
                'CustomerBanks' => [
                    'Banks'
                ]
            ],
            'Customers',
            'Provinces',
            'Cities',
            'Subdistricts',
            'OrderDetails' => [
                'Products'
            ],
        ])->where(['Orders.invoice' => $invoice])->first();

        $this->set(compact('data'));
    }

    public function updateAwb(){

        if ($this->request->is('ajax')) {
            $id = $this->request->getData('id');
            $awb = $this->request->getData('awb');
            $order =  $this->Orders->get($id);
            $order->awb = $awb;
            $this->Orders->save($order);

            $this->Flash->success(__('The order has been update.'));
            $result = ['ok'];
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
    }

    public function process(){

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
            $status = $this->request->getData('status');
            $ids = $this->request->getData('ids');
            $awb = $this->request->getData('awb');


            switch ($status) {
                case '3': //success

//                    if(empty($awb)){
//                        $this->Flash->error(__('The order could not be process. Please, enter Airway Bill number.'));
//                        continue;
//                    }

                    foreach($ids as $vals){

                        $order =  $this->Orders->get($vals);

                        if($order->get('order_status_id') != 2){
                            $this->Flash->error(__('The order has been success before, cannot do double process'));
                            continue;
                        }

                        $stockType = $order->stock_type;

                        $success = true;
                        if($success){

                            /**
                             * @var \AdminPanel\Model\Entity\OrderDetail[] $orderDetails
                             */

                            $orderDetails = $this->OrderDetails->find()
                                ->where([
                                    'order_id' => $order->get('id'),
                                ])
                                ->all()->toArray();

                            $idSerials = [];
                            foreach($orderDetails as $orderDetail) {

                                /**
                                 * @var \AdminPanel\Model\Entity\Product $product
                                 */
                                $product = $this->Products->get($orderDetail->product_id);

                                /* bonus pribadi */

                                $description = 'Bonus Pribadi Produk : '.$product->name.', Qty : '.$orderDetail->qty;
                                $amount = $product->bonus_pribadi * $orderDetail->qty;
//                                $this->Transactions->create(
//                                    TransactionType::REWARDMEMBER,
//                                    $order->customer_id,
//                                    $amount,
//                                    $description
//                                );

                                $cashPoint = $this->CashPoints->newEntity([
                                    'product_id' => $product->id,
                                    'customer_id' => $order->customer_id,
                                    'from_customer_id' => $order->customer_id,
                                    'description' => $description,
                                    'cash_point' => $amount,
                                    'confirm_date' => (Time::now())->format('Y-m-d')
                                ]);

                                if($this->CashPoints->save($cashPoint)){

                                    $generasi = $this->Generations->find()
                                        ->where([
                                            'customer_id' => $order->customer_id,
                                            'level <= ' => 3
                                        ])
                                        ->orderAsc('level');


                                    /**
                                     * @var \AdminPanel\Model\Entity\Generation[] $generasi
                                     */
                                    /* bonus level */
                                    foreach ($generasi as $gen){
                                        $description = 'Bonus Strata '.$gen->level. ' Produk : '.$product->name.', Qty : '.$orderDetail->qty;
                                        $amount = $product->{'bonus_strata_'.$gen->level} * $orderDetail->qty;
//                                        $this->Transactions->create(
//                                            TransactionType::REWARDMEMBER,
//                                            $gen->refferal_id,
//                                            $amount,
//                                            $description
//                                        );

                                        $cashPoint = $this->CashPoints->newEntity([
                                            'product_id' => $product->id,
                                            'customer_id' => $gen->refferal_id,
                                            'from_customer_id' => $order->customer_id,
                                            'description' => $description,
                                            'cash_point' => $amount,
                                            'confirm_date' => (Time::now())->format('Y-m-d')
                                        ]);
                                        $this->CashPoints->save($cashPoint);

                                    }
                                }

                            }

                            $order->order_status_id = $status;
                            $order->confirm_date = date('Y-m-d');
                            $this->Orders->save($order);


                            $this->Flash->success(__('The order has been update.'));
                        }else{
                            $this->Flash->error(__('Order total not balace with stock. please add new stock'));
                        }


                    }

                    break;

                default:
                    /* update status */
                    foreach($ids as $vals){
                        $order =  $this->Orders->get($vals);

                        $orderDetails = $this->OrderDetails->find()
                            ->where([
                                'order_id' => $order->get('id'),
                            ])
                            ->all()->toArray();
                        /* pemotongan stock produk ke stokis */
                        foreach($orderDetails as $orderDetail){
                            $this->ProductStockMutationTransactions->create(
                                1,
                                $orderDetail->product_id,
                                $order->supplier_id,
                                $orderDetail->qty,
                                strtolower('penambahan'),
                                'Penambahan kembali stock produk order canceled by admin '.$order->invoice
                            );
                        }
                        $order->order_status_id = $status;
                        $this->Orders->save($order);
                    }
                    $this->Flash->success(__('The order has been update.'));
            }


            $result = ['ok'];
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
    }

    public function index()
    {

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');
            $status = $this->request->getData('status');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Orders->find('all')
                ->select();
            $data->contain([
                'OrderStatuses',
                'OrderConfirmations' => [
                    'Images',
                    'CustomerBanks' => [
                        'Banks'
                    ]
                ],
                'Customers',
                'Provinces',
                'Cities',
                'Subdistricts',
                'OrderDetails' => [
                    'Products'
                ],
            ])->whereNull('Orders.deleted');

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' => [
                        'Customers.username LIKE' => '%' . $search .'%',
                        'Orders.invoice LIKE' => '%' . $search .'%',
                        'Orders.total LIKE' => '%' . $search .'%',
                        'OrderStatuses.name LIKE' => '%' . $search .'%',
                    ]]);
                }
                $data->where($query);
            }
//            if (isset($query['withdrawal_status_id'])) {
//                $withdrawal_status_id = $query['withdrawal_status_id'];
//                $data->where(['Withdrawals.withdrawal_status_id' => $withdrawal_status_id]);
//            }

            if (isset($status)) {
                $data->where(['OrderStatuses.name' => ucfirst($status)]);
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

            $webroot = $this->getRequest()->getAttribute('webroot');
            $data = $data->map(function (\AdminPanel\Model\Entity\Order $row) use ($webroot) {
				if($row->order_confirmation && $row->order_confirmation->image) {
					$path = explode(DS, $row->order_confirmation->image->dir);
					//unset($path[0]);
                    array_shift($path);
                    if ($webroot != '/') {
                        array_unshift(
                            $path,
                            trim($webroot, '/')
                        );
                    }


					$path = implode('/',$path);
					$row->order_confirmation->image->dir = $path;
				}
                return $row;
            });

            $result = [];
            $result['data'] = $data->toArray();


            $result['meta'] = array_merge((array) $pagination, (array) $sort);
            $result['meta']['total'] = $total;


            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }

        $statusTypes = $this->Orders->OrderStatuses->find('list')->toArray();

        $this->set(compact('statusTypes'));
    }
}
