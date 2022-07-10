<?php
namespace Member\Controller;

use Cake\I18n\Time;
use Member\Controller\AppController;

/**
 * Banks Controller
 *
 * @property \AdminPanel\Model\Table\TestimonialsTable $Testimonials
 * @method \Member\Model\Entity\Bank[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TestimonialsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Testimonials');
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

            $data = $this->Testimonials->find();

            $data = $data
                ->where([
                    'Testimonials.customer_id' => $customer_id
                ])
                ->orderDesc('Testimonials.id');


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

        $testimonialTotal = $this->Testimonials->find()
            ->where([
                'Testimonials.customer_id' => $customer_id
            ])
            ->count();

        $this->set(compact('testimonialTotal'));

    }



    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer_id = $this->Auth->user('id');

        $testimonialEntity = $this->Testimonials->newEntity();
        if ($this->request->is('post')) {

//            $this->Testimonials->getValidator('default')
//                ->add('serial', 'check', [
//                    'rule' => function($value) use ($customer_id) {
//                        /**
//                         * @var \AdminPanel\Model\Entity\Customer $check
//                         */
//                        $check = $this->Testimonials->Customers->find()
//                            ->select([
//                                'Cards.serial'
//                            ])
//                            ->contain('Cards')
//                            ->where([
//                                'Customers.id' => $customer_id
//                            ])
//                            ->first();
//                        return $check && strtoupper($check->card->serial) === strtoupper($value);
//                    },
//                    'message' => __( 'Invalid serial number')
//                ]);

            $testimonial = $this->Testimonials->patchEntity($testimonialEntity, $this->request->getData());
            $testimonial->customer_id = $customer_id;
            $testimonial->approved = 0;
            if ($this->Testimonials->save($testimonialEntity)) {
                $this->Flash->success(__('The testimonial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The testimonial could not be saved. Please, try again.'));

        }


        $this->set(compact('testimonialEntity'));
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

        $testimonialEntity = $this->Testimonials->find()
            ->where([
                'customer_id' => $customer_id,
                'id' => $id
            ])
            ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {

//            $this->Testimonials->getValidator('default')
//                ->add('serial', 'check', [
//                    'rule' => function($value) use ($customer_id) {
//                        /**
//                         * @var \AdminPanel\Model\Entity\Customer $check
//                         */
//                        $check = $this->Testimonials->Customers->find()
//                            ->select([
//                                'Cards.serial'
//                            ])
//                            ->contain('Cards')
//                            ->where([
//                                'Customers.id' => $customer_id
//                            ])
//                            ->first();
//                        return $check && strtoupper($check->card->serial) === strtoupper($value);
//                    },
//                    'message' => __( 'Invalid serial number')
//                ]);

            $testimonialEntity = $this->Testimonials->patchEntity($testimonialEntity, $this->request->getData());
            $testimonialEntity->customer_id = $customer_id; //re set again
            if ($this->Testimonials->save($testimonialEntity)) {
                $this->Flash->success(__('The testimonial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The testimonial could not be saved. Please, try again.'));
        }


        $this->set(compact('testimonialEntity'));
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
        $serial = $this->Testimonials->Customers->find()
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
            }else{

                /**
                 * @var \AdminPanel\Model\Entity\Testimonial $testimonial
                 */
                $testimonial = $this->Testimonials->find()
                    ->where([
                        'customer_id' => $customer_id,
                        'id' => $id
                    ])->first();


                if ($this->Testimonials->delete($testimonial)) {
                    $this->Flash->success(__('The testimonial has been deleted.'));
                    return $this->response->withStatus('200');
                } else {
                    return $this->response->withStatus('403', __( 'The testimonial could not be deleted. Please, try again.'))
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'status' => 'ERROR',
                            'message' => __( 'The testimonial could not be deleted. Please, try again.')
                        ]));
                }
            }
        }

    }
}
