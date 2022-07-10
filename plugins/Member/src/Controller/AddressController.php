<?php
namespace Member\Controller;

use Cake\I18n\Time;
use Member\Controller\AppController;

/**
 * Banks Controller
 *
 * @property \AdminPanel\Model\Table\CustomerAddressTable $CustomerAddress
 * @method \Member\Model\Entity\Bank[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AddressController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.CustomerAddress');
    }


    public function primary(){

        $customer_id = $this->Auth->user('id');
        if ($this->request->is('ajax')) {
            $id = $this->request->getData('ids');

            $this->CustomerAddress->query()
                ->update()
                ->set([
                    'primary' => 0
                ])
                ->where([
                    'CustomerAddreses.customer_id' => $customer_id
                ])
                ->execute();

            $this->CustomerAddress->query()
                ->update()
                ->set([
                    'primary' => 1
                ])
                ->where([
                    'CustomerAddreses.id' => $id,
                    'CustomerAddreses.customer_id' => $customer_id
                ])
                ->execute();

            return $this->response->withType('application/json')
                ->withStringBody(true);
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $customer_id = $this->Auth->user('id');
        $countAddress = $this->CustomerAddress->find()->where(['CustomerAddress.customer_id' =>$customer_id ])->count();

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            $data = $this->CustomerAddress->find();

            $data = $data
                ->contain([
                    'Provinces',
                    'Cities',
                    'Subdistricts',
                ])
                ->where([
                    'CustomerAddress.customer_id' => $customer_id
                ])
                //->whereNull('deleted')
                ->orderDesc('CustomerAddress.id');


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
        $this->set(compact('countAddress'));
    }


    public function getCities()
    {
        $this->getRequest()->allowMethod('post');

        if ($province_id = $this->getRequest()->getData('id')) {
            $cities = $this->CustomerAddress->Cities->find('list', [
                'keyField' => 'id',
                'valueField' => function (\AdminPanel\Model\Entity\City $city) {
                    return $city->get('type') . ' ' . $city->get('name');
                }
            ])
                ->where([
                    'province_id' => $province_id
                ])
                ->toArray();

            return $this->getResponse()->withType('application/json')
                ->withStringBody(json_encode($cities));
        }


    }

    public function getDistricts()
    {
        $this->getRequest()->allowMethod('post');

        if ($city_id = $this->getRequest()->getData('id')) {
            $cities = $this->CustomerAddress->Subdistricts->find('list')
                ->where([
                    'city_id' => $city_id
                ])
                ->toArray();

            return $this->getResponse()->withType('application/json')
                ->withStringBody(json_encode($cities));
        }


    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer_id = $this->Auth->user('id');

//        $countAddress = $this->CustomerAddress->find()->where(['CustomerAddress.customer_id' =>$customer_id ])->count();
//        if($countAddress >= 1){
//            $this->redirect(['action' => 'index']);
//        }
        $customerAddress = $this->CustomerAddress->newEntity();
        $cities = [];
        $districts = [];

        if ($this->request->is('post')) {

            $cities = $this->CustomerAddress->Cities->find('list')
                ->where([
                    'province_id' => $this->getRequest()->getData('province_id')
                ]);

            $districts = $this->CustomerAddress->Subdistricts->find('list')
                ->where([
                    'city_id' => $this->getRequest()->getData('city_id')
                ]);


            $address = $this->CustomerAddress->patchEntity($customerAddress, $this->request->getData());
            $address->customer_id = $customer_id;
            $address->primary = 1;
            if ($this->CustomerAddress->save($customerAddress)) {
                $this->Flash->success(__('The address has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The address could not be saved. Please, try again.'));
        }

        $provinces = $this->CustomerAddress->Provinces->find('list');



        $this->set(compact('customerAddress', 'provinces', 'cities', 'districts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bank id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $customer_id = $this->Auth->user('id');

        $cities = [];
        $districts = [];

        $customerAddress = $this->CustomerAddress->find()
            ->where([
                'customer_id' => $customer_id,
                'id' => $id
            ])
            ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {


            $customerAddress = $this->CustomerAddress->patchEntity($customerAddress, $this->request->getData());
            $customerAddress->customer_id = $customer_id; //re set again
            $customerAddress->primary = 1;
            if ($this->CustomerAddress->save($customerAddress)) {
                $this->Flash->success(__('The address has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The address could not be saved. Please, try again.'));
        }

        if ($customerAddress) {
            $provinces = $this->CustomerAddress->Provinces->find('list');

            $cities = $this->CustomerAddress->Cities->find('list', [
                'keyField' => 'id',
                'valueField' => function (\AdminPanel\Model\Entity\City $city) {
                    return $city->get('type') . ' ' . $city->get('name');
                }
            ])
                ->where([
                    'province_id' => $customerAddress->get('province_id')
                ]);

            $districts = $this->CustomerAddress->Subdistricts->find('list')
                ->where([
                    'city_id' => $customerAddress->get('city_id')
                ]);
        }


        $this->set(compact('customerAddress', 'provinces', 'cities', 'districts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bank id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $customer_id = $this->Auth->user('id');
        $this->request->allowMethod(['post', 'delete']);

        //check serial number

        /**
         * @var \AdminPanel\Model\Entity\Customer $serial
         */
        /*$serial = $this->CustomerAddress->Customers->find()
            ->select('Cards.serial')
            ->contain('Cards')
            ->where([
                'Customers.id' => $customer_id
            ])
            ->first();

        if ($serial) {
            if ($this->request->getData('serial') != $serial->card->serial) {
                return $this->response->withStatus('403', __( 'Invalid serial number'))
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'status' => 'ERROR',
                        'message' => __( 'Invalid serial number')
                    ]));
            }
        }*/


        /**
         * @var \AdminPanel\Model\Entity\CustomerBank $bank
         */
        $address = $this->CustomerAddress->find()
            ->where([
                'customer_id' => $customer_id,
                'id' => $id
            ])->first();



        if ($this->CustomerAddress->delete($address)) {
            $this->Flash->success(__('The address has been deleted.'));
        } else {
            $this->Flash->error(__('The address could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
