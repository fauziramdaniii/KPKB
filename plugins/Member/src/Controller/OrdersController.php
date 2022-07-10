<?php
namespace Member\Controller;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Core\Configure;
use Cake\Database\Expression\QueryExpression;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Utility\Security;
use Member\Controller\AppController;

/**
 * Orders Controller
 *
 * @property \AdminPanel\Model\Table\OrdersTable $Orders
 * @property \AdminPanel\Model\Table\ProductsTable $Products
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 * @property \AdminPanel\Model\Table\CustomerBanksTable $CustomerBanks
 * @property \AdminPanel\Model\Table\ImagesTable $Images
 * @property \AdminPanel\Model\Table\ProvincesTable $Provinces
 * @property \AdminPanel\Model\Table\CustomerAddressTable $CustomerAddress
 * @property \AdminPanel\Model\Table\ProductStockMutationTransactionsTable $ProductStockMutationTransactions
 * @property \AdminPanel\Controller\Component\RajaOngkirComponent $RajaOngkir
 * @method \Member\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
//        if(!in_array($this->Auth->user('customer_type_id'), [2,3])){
//            $this->Flash->error(__('Oops...Authorization need you become stokist first'));
//            $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
//        }
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Provinces');
        $this->loadModel('AdminPanel.Products');
        $this->loadModel('AdminPanel.Orders');
        $this->loadModel('AdminPanel.Customers');
        $this->loadModel('AdminPanel.CustomerAddress');
        $this->loadModel('AdminPanel.CustomerBanks');
        $this->loadModel('AdminPanel.Images');
        $this->loadModel('AdminPanel.ProductStockMutationTransactions');
        $this->loadComponent('AdminPanel.RajaOngkir');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
//        $this->getRequest()->getSession()->delete('Carts');
        /**
         * @var \AdminPanel\Model\Entity\CustomerAddres $customerAddress
         */
        $customer_id = $this->Auth->user('id');
        $customerAddress = $this->CustomerAddress->find()
            ->where(['customer_id' => $customer_id])->first();
        if(empty($customerAddress->province_id) && empty($customerAddress->address)){
            $this->Flash->error(__('Please complete your address.'));
            $this->redirect(['controller' => 'Address', 'action' => 'add']);

        }else{

            /**
             * @var \AdminPanel\Model\Entity\CustomerAddres $contact
             */
            $contact = $this->CustomerAddress->find()
                ->contain(['Provinces'])
                ->where([
                    'CustomerAddress.customer_id' => $customer_id,
                ])
                ->first();
            $zone = $contact->province->zone;

            $products = $this->Products->find()
                ->where([
                    'on_sales' => 1
                ]);
            if(!$products->isEmpty()) {
                /*
                $percent_zone = Configure::read('shipping_zone');
                foreach($products as $key => $product){
                    if($this->Auth->user('customer_type_id') == 3){
                        $products[$key]->price = floor($product->stokist_price + ($product->stokist_price * $percent_zone[$zone])) ;
                    }else if($this->Auth->user('customer_type_id') == 2){
                        $products[$key]->price = floor($product->price + ($product->price * $percent_zone[$zone])) ;
                    }
                }
                */
            }


            $this->set(compact('products'));

        }



    }

    public function getShipping(){
        if ($this->request->is('ajax')) {
            $data = $this->RajaOngkir->waybill($this->request->getData('awb'), strtolower($this->request->getData('courrier')));
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($data));
        }

    }

    public function getAddressAndShippingCost(){


        $customer_id = $this->Auth->user('id');
        if ($this->request->is('ajax')) {

            $customer_address_id = $this->request->getData('id');
            $courrier = Configure::read('Rajaongkir.courrier');

            $weight = $this->request->getData('weight', '1000');
            $origin_district_id = Configure::read('Rajaongkir.district_default');

            $result = [];
            $customer_address = $this->CustomerAddress->find()
                ->where([
                    'CustomerAddress.id' => $customer_address_id,
                    'CustomerAddress.customer_id' => $customer_id,
                ])
                ->contain([
                    'Provinces',
                    'Cities',
                    'Subdistricts',
                ])
                ->first()
                ->toArray();
            $result['customer_address'] = $customer_address;


            $out = $this->RajaOngkir->cost(
                $origin_district_id,
                'subdistrict',
                $customer_address['subdistrict_id'],
                'subdistrict',
                $courrier,
                $weight * 1000
            );

            $results = [];

            $results[] = [
                'code' => 'COD',
                'service' => 'COD',
                'name' => 'COD',
                'description' => 'Cash On Delivery',
                'cost' => 0,
                'etd' => '1 - 2'
            ];


            $rename = [
                'CTC' => 'reg',
                'CTCYES' => 'yes',
            ];

            if ($out && $out['rajaongkir']['status']['code'] == 200) {
                foreach($out['rajaongkir']['results'] as $key => $val) {
                    foreach($val['costs'] as $k => $cost) {
                        if(array_key_exists($cost['service'],$rename )) {
                            $label = $rename[$cost['service']];
                        }else{
                            $label = $cost['service'];
                        }
                        $val['code'] = strtoupper(str_replace('J&T', 'JNT', $val['code']));
                        $results[] = [
                            'code' => $val['code'],
                            'service' => $cost['service'],
                            'name' => $val['code'] . ' - ' . strtolower($label),
                            'description' => $cost['description'],
                            'cost' => $cost['cost'][0]['value'],
                            'etd' => $cost['cost'][0]['etd'],
                        ];
                    }
                }
            }


            $result['shipping_list'] = $results;

            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }

    }

    public function add($product_id)
    {
        $this->getRequest()->allowMethod('post');
        $carts = $this->getRequest()->getSession()->read('Carts');
        $carts = !$carts ? [] : $carts;

        $productEntity = $this->Products->find()
            ->where([
                'id' => $product_id
            ])
            ->first();

        $customer_id = $this->Auth->user('id');
        $address = $this->CustomerAddress->find()
            ->contain(['Provinces'])
            ->where(['CustomerAddress.customer_id' => $customer_id])
            ->first();
        $percent_zone = Configure::read('shipping_zone');

        if ($productEntity) {

//            $price = floor($productEntity->get('price') + ($productEntity->get('price') * $percent_zone[$address->province->zone])) ;
            $price = $productEntity->get('price') ;

            $carts[$product_id] = [
                'product_id' => $product_id,
                'name' => $productEntity->get('name'),
                'description' => $productEntity->get('description'),
                'price' => $price,
                'qty' => 1,
                'weight' =>  $productEntity->get('weight')
            ];
        }



        $this->getRequest()->getSession()->write('Carts', $carts);

        $this->Flash->success(__( 'Success added product to cart.'));

        return $this->redirect($this->referer());

    }

    public function updateCart(){
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
            if ($carts = $this->getRequest()->getSession()->read('Carts')) {
                $id = $this->request->getData('id');
                $qty = $this->request->getData('qty');
                $kode = $this->request->getData('kode');

                $blockAllowSingle = [6,7];//product id
                if (array_key_exists($id, $carts)) {

                    $customer_id = $this->Auth->user('id');
                    $address = $this->CustomerAddress->find()
                        ->contain(['Provinces'])
                        ->where(['CustomerAddress.customer_id' => $customer_id])
                        ->first();
                    $percent_zone = Configure::read('shipping_zone');

                    $productEntity = $this->Products->find()
                        ->contain([
                            'ProductStocks'
                        ])
                        ->where([
                            'Products.id' => $id
                        ])
                        ->first();

                    //$price = floor($productEntity->get('price') + ($productEntity->get('price') * $percent_zone[$address->province->zone])) ;
                    $price = $productEntity->get('price');


                    $carts[$id] = [
                        'product_id' => $id,
                        'name' => $productEntity->get('name'),
                        'description' => $productEntity->get('description'),
                        'price' => $price,
                        'qty' => $qty,
                        'weight' =>  $productEntity->get('weight'),
                    ];
                    $this->getRequest()->getSession()->write('Carts', $carts);
                }
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode(true));
        }

    }

    public function activation()
    {
        exit;
        $order = $this->Orders->newEntity();
        $customer_id = $this->Auth->user('id');


        if ($this->request->is('post')) {

            /**
             * @var \AdminPanel\Model\Entity\Order $orderEntity
             */
            $orderEntity = $this->Orders->find()
                ->where([
                    'customer_id' => $customer_id,
                    'invoice' => $this->request->getData('invoice')
                ])
                ->contain([
                    'OrderDetails' => [
                        'Products',
                        'OrderDetailSerials' => [
                            'Cards'
                        ]
                    ]
                ])
                ->first();


            $validator = $this->Orders->getValidator('default');

            $validator->remove('invoice');
            $validator->add('invoice', 'valid', [
                'rule' => function($value) use ($orderEntity) {
                    return $orderEntity && $orderEntity->invoice == $value;
                },
                'message' => 'Invoice not found'
            ])
                ->add('secret_key', 'secret_key_valid', [
                    'rule' => function($value) use ($orderEntity) {
                        return $orderEntity && strtoupper($orderEntity->secret_key) == ($value);
                    },
                    'message' => 'Invalid secret key'
                ]);

            $order = $this->Orders->patchEntity($order, $this->request->getData());

            if (!$order->getErrors()) {
                $activated = 0;
                foreach($orderEntity->order_details as $detail) {
                    foreach($detail->order_detail_serials as $serial) {
                        if ($serial->card->card_status_id == 3 && $serial->card->card_type_id == 2) {
                            $serial->card->card_status_id = 4; //mark ready to used
                            if ($this->Orders->OrderDetails->OrderDetailSerials->Cards->save($serial->card)) {
                                $activated++;
                            }
                        }
                    }
                }

                if ($activated > 0) {
                    $this->Flash->success(__('Activation of {0} serial was successful', [$activated]));
                } else {
                    $this->Flash->error(__('The activation process has been carried out'));
                }
            }

        }

        $this->set(compact('order', 'orderEntity'));
    }

    public function lists()
    {
        $customer_id = $this->Auth->user('id');

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            $data = $this->Orders->find();

            $data = $data
                ->contain([
                    'OrderStatuses',
                    'Provinces',
                    'Cities',
                    'OrderConfirmations'
                ])
                ->whereNull('deleted')
                ->where([
                    'Orders.customer_id' => $customer_id
                ])
                ->orderDesc('Orders.id');


            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['Orders.invoice LIKE' => '%' . $search .'%']);
                }
                $data->where($query);
            }


            // if (isset($sort['field']) && isset($sort['sort'])) {
            // $data->order([$sort['field'] => $sort['sort']]);
            // }

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

        $order_status = $this->Orders->OrderStatuses->find('list')->toArray();

        $this->set(compact('order_status'));

    }


    public function detailOrder($order_id)
    {
        $customer_id = $this->Auth->user('id');

        $orders = $this->Orders->find()
            ->contain([
                'Customers',
                'OrderStatuses',
                'Provinces',
                'Cities',
                'Subdistricts',
                'OrderDetails' => [
                    'Products'
                ]
            ])
            ->where([
                'Orders.id' => $order_id,
                'Orders.customer_id' => $customer_id
            ])
            ->first();
        $this->set(compact('orders'));
    }

    public function confirmOrder($order_id)
    {
        $customer_id = $this->Auth->user('id');

        /**
         * @var \AdminPanel\Model\Entity\Order $order
         */
        $order = $this->Orders->find()
            ->contain([
                'OrderConfirmations'
            ])
            ->where([
                'Orders.id' => $order_id,
                'Orders.customer_id' => $customer_id
            ])
            ->first();

        if (!$order_id || !$order || ($order && $order->order_confirmation)) {
            return $this->redirect(['action' => 'lists']);
        }

        $order_confirmation = $this->Orders->OrderConfirmations->newEntity();

        if ($this->getRequest()->is('post')) {

            $this->Orders->OrderConfirmations->getValidator('default')
                ->requirePresence('customer_bank_id')
                ->greaterThanOrEqual('amount', $order->total, __('This amount must be greater than {0}', [$order->total]))
                //->requirePresence('attachment')
                ->allowEmptyFile('attachment')
                ->add('attachment', 'mime', [
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


            $this->Orders->OrderConfirmations->patchEntity($order_confirmation, $this->getRequest()->getData());

            if (!$order_confirmation->getErrors()) {

                $image = $this->Images->newEntity([
                    'name' => $this->getRequest()->getData('attachment')
                ]);

                $this->Images->save($image);

                $order_confirmation->customer_id = $customer_id;
                $order_confirmation->order_id = $order->id;
                $order_confirmation->image_id = $image->id;
                $order_confirmation->note = strip_tags($order_confirmation->note);

                if ($this->Orders->OrderConfirmations->save($order_confirmation)) {
                    $order->order_status_id = 2;
                    $this->Orders->save($order);
                    $this->Flash->success(__( 'Success payment confirmation.'));
                    return $this->redirect(['action' => 'lists']);
                }
            }


        }



        $customer_banks = $this->CustomerBanks->find('list', [
            'keyField' => 'id',
            'valueField' => function(\AdminPanel\Model\Entity\CustomerBank $row) {
                return $row->bank->name . ' - ' . $row->account_name . ' - ' . $row->account_number;
            }
        ])
            ->contain([
                'Banks'
            ])
            ->where([
                'customer_id' => $customer_id
            ])
            ->toArray();

        $bankCompany = Configure::read('BankCompany');
        $bank_transfer = array();
        foreach($bankCompany as $vals){
            $bank_transfer[$vals['name'].'/'.$vals['acc_name'].'/'.$vals['acc_number']] = $vals['name'].' / '.$vals['acc_name'].' / '.$vals['acc_number'];
        }
        $this->set(compact('order_confirmation', 'order', 'customer_banks','bank_transfer'));

    }

    public function cart()
    {
        if ($carts = $this->getRequest()->getSession()->read('Carts')) {

            //check customer contact
            $customer_id = $this->Auth->user('id');
            if ($this->getRequest()->is('post')) {


                $customer_address_id = $this->request->getData('customer_address_id');
                $shipping_cost = $this->request->getData('shipping_cost', 0);
                $shipping_type = $this->request->getData('shipping_type');
                $shipping_courrier = $this->request->getData('shipping_courrier');
                $total_weight = $this->request->getData('total_weight', 0);

                if(($shipping_courrier != 'COD' && empty($shipping_cost)) || empty($shipping_type) || empty($shipping_courrier) ){
                    $this->Flash->error(__('Failed order please try again. error courrier connection'));
                    return $this->redirect(['action' => 'cart']);
                }


                /**
                 * @var \AdminPanel\Model\Entity\CustomerAddres $exists
                 */
                $exists = $this->CustomerAddress->find()
                    ->contain([
                        'Customers'
                    ])
                    ->where([
                        'CustomerAddress.id' => $customer_address_id,
                        'CustomerAddress.customer_id' => $customer_id,
                    ])
                    ->first();

                if (!$exists) {
                    $this->Flash->error(__( 'Unable to process, please complete your shipping address'));
                    return $this->redirect(['action' => 'cart']);
                }

                $invoice = strtoupper(date('ymdHs') . Security::randomString(4));
                $orderEntity = $this->Orders->newEntity([
                    'invoice' => $invoice,
                    'customer_id' => $customer_id,
                    'order_status_id' => 1,
                    'province_id' => $exists->province_id,
                    'city_id' => $exists->city_id,
                    'subdistrict_id' => $exists->subdistrict_id,
                    'address' => $exists->address,
                    'recipient_name' => $exists->name,
                    'recipient_phone' => $exists->phone_1,
                    'shipping_cost' => $shipping_cost,
                    'courrier' => $shipping_courrier,
                    'courrier_type' => $shipping_type,
                    'total_weight' => $total_weight,
                ]);

                if ($qtys = $this->getRequest()->getData('qty')) {

                    $total = 0;

                    /**
                     * @var \AdminPanel\Model\Entity\OrderDetail[] $orderDetailEntities
                     */
                    $orderDetailEntities = [];
                    foreach($qtys as $product_id_key => $qty) {
                        $qty = (int) $qty;

                        if (array_key_exists($product_id_key, $carts)) {

                            $product_id = $carts[$product_id_key]['product_id'];
                            $productDetail = $this->Products->get($product_id);

                            if ($qty <= 0) {
                                unset($carts[$product_id]);
                                continue;
                            }

                            $carts[$product_id]['qty'] = $qty;
                            $total += $carts[$product_id_key]['qty'] * $carts[$product_id_key]['price'];

                            array_push($orderDetailEntities, $this->Orders->OrderDetails->newEntity([
                                'product_id' => $product_id,
                                'qty' => $qty,
                                'price' => $carts[$product_id_key]['price'],
                                'total' => $carts[$product_id_key]['qty'] * $carts[$product_id_key]['price'],
                                'weight' => $carts[$product_id_key]['weight'],
                                'total_weight' => $carts[$product_id_key]['qty'] * $carts[$product_id_key]['weight'],
                            ]));
                        }
                    }


                    $this->getRequest()->getSession()->write('Carts', $carts);



                    $orderEntity->gross_total = $total;
                    $orderEntity->total = $total + $shipping_cost;

                    /* if stockist free shipping */
//                    $customer_type_id = $this->Auth->user('customer_type_id');
//                    if (in_array($customer_type_id, [2,3]) && $orderEntity->gross_total >= Configure::read('Order.free_shipping_min', 5000000)) {
//                        $orderEntity->is_freeshipping = 1;
//                        $orderEntity->total -= $shipping_cost; //total = - shipping cost
//                    }


                    $error = false;
                    $this->Orders->getConnection()->begin();
                    if ($this->Orders->save($orderEntity)) {
                        foreach($orderDetailEntities as $orderDetail) {
                            $orderDetail->order_id = $orderEntity->id;
                            if (!$this->Orders->OrderDetails->save($orderDetail)) {
                                $error = true;
                            } else {
                                $this->ProductStockMutationTransactions->create(
                                    2,
                                    $orderDetail->product_id,
                                    1,
                                    $orderDetail->qty,
                                    'pengurangan',
                                    sprintf('Pembelian invoice %s qty %d', $orderEntity->invoice, $orderDetail->qty)
                                );
                            }
                        }
                    }

                    if (!$error) {
                        $this->Orders->getConnection()->commit();
                        $this->Flash->success(__( 'The order {0} has been success, please do confirmation bank transfer.', $orderEntity->get('invoice')));
                        $this->getRequest()->getSession()->delete('Carts');
                        return $this->redirect(['action' => 'lists']);
                    } else {
                        $this->Orders->getConnection()->rollback();
                        $this->Flash->error(__( 'The order has been failed'));
                    }




                }

            }



            $addressList = $this->CustomerAddress->find('list')
                ->where([
                    'CustomerAddress.customer_id' => $customer_id
                ])->toArray();

            $address = $this->CustomerAddress->find()
                ->where([
                    'CustomerAddress.customer_id' => $customer_id,
                ])
                ->contain([
                    'Cities',
                    'Provinces',
                    'Subdistricts',
                ])
                ->first();
            if($address){
                $address = $address->toArray();
            }
            $this->set(compact('carts','address','addressList'));
        } else {
            return $this->redirect(['action' => 'index']);
        }
    }

    public function deleteCart($product_id)
    {
//        $this->getRequest()->allowMethod('delete');
        $carts = $this->getRequest()->getSession()->read('Carts');
        if (array_key_exists($product_id, $carts)) {
            unset($carts[$product_id]);
            $this->getRequest()->getSession()->write('Carts', $carts);
        }

        return $this->redirect($this->referer());

    }


    public function delete($id = null)
    {
        $customer_id = $this->Auth->user('id');
        $this->request->allowMethod(['post', 'delete']);

        //check serial number

        /**
         * @var \AdminPanel\Model\Entity\Customer $serial
         */
        $serial = $this->CustomerBanks->Customers->find()
            ->select(['password'])
            ->where([
                'Customers.id' => $customer_id
            ])
            ->first();

        if ($serial) {
            if (!(new DefaultPasswordHasher())->check($this->request->getData('password') , $serial->password)) {
                return $this->response->withStatus('403', __( 'Invalid password'))
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'status' => 'ERROR',
                        'message' => __( 'Invalid password')
                    ]));
            } else {

                /**
                 * @var \AdminPanel\Model\Entity\Order $order
                 */
                $order = $this->Orders->find()
                    ->where([
                        'customer_id' => $customer_id,
                        'order_status_id' => 1,
                        'id' => $id
                    ])->first();
                if ($order) {
                    $order->deleted = (Time::now())->format('Y-m-d H:i:s');
                }
                if ($this->Orders->save($order)) {
                    $this->Flash->success(__('The order has been deleted.'));
                    return $this->response->withStatus('200');
                } else {
                    return $this->response->withStatus('403', __( 'The order could not be deleted. Please, try again.'))
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'status' => 'ERROR',
                            'message' => __( 'The order could not be deleted. Please, try again.')
                        ]));
                }
            }
        }


    }


}
