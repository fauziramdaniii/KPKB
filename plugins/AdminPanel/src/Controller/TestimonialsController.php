<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use Cake\Cache\Cache;
use Cake\Utility\Security;

/**
 * Customers Controller
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 * @property \AdminPanel\Model\Table\TestimonialsTable $Testimonials
 *
 * @method \AdminPanel\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
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
     * @return \Cake\Http\Response|void
     */
    public function index()
    {


        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Testimonials->find('all')
                ->select();
            $data->contain(['Customers']);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                        custom field for general search
                        ex : 'Users.email LIKE' => '%' . $search .'%'
                    **/
                    $data->where(['OR' =>[
                        'Customers.username LIKE' => '%' . $search .'%',
                        'Customers.email LIKE' => '%' . $search .'%',
                        'Customers.first_name LIKE' => '%' . $search .'%',
                        'Customers.last_name LIKE' => '%' . $search .'%',
                        'Testimonials.message LIKE' => '%' . $search .'%',
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


        $this->set(compact('customers'));
    }


    public function approved($id)
    {
        $this->disableAutoRender();
        /**
         * @var \AdminPanel\Model\Entity\Testimonial $testimonial
         */
        $testimonial = $this->Testimonials->find()
            ->where([
                'Testimonials.id' => $id
            ])
            ->first();

        if ($testimonial) {
            $testimonial->approved = 1;
            if ($this->Testimonials->save($testimonial)) {
                $this->Flash->success(__('Successfully approved testimonial'));
            } else {
                $this->Flash->error(__('failed approved testimonial'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    public function unApproved($id)
    {
        $this->disableAutoRender();
        /**
         * @var \AdminPanel\Model\Entity\Testimonial $testimonial
         */
        $testimonial = $this->Testimonials->find()
            ->where([
                'Testimonials.id' => $id
            ])
            ->first();

        if ($testimonial) {
            $testimonial->approved = 0;
            if ($this->Testimonials->save($testimonial)) {
                $this->Flash->success(__('Successfully un approved testimonial'));
            } else {
                $this->Flash->error(__('failed un approved testimonial'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    public function delete($id)
    {
        $this->disableAutoRender();
        /**
         * @var \AdminPanel\Model\Entity\Testimonial $testimonial
         */
        $testimonial = $this->Testimonials->find()
            ->where([
                'Testimonials.id' => $id
            ])
            ->first();

        if ($testimonial) {
            if ($this->Testimonials->delete($testimonial)) {
                $this->Flash->success(__('Successfully delete testimonial'));
            } else {
                $this->Flash->error(__('failed delete testimonial'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $testimonial = $this->Testimonials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $testimonial = $this->Testimonials->patchEntity($testimonial, $this->request->getData());
            if ($this->Testimonials->save($testimonial)) {
                $this->Flash->success(__('The testimonial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The testimonial could not be saved. Please, try again.'));
        }

        $this->set(compact('testimonial'));
    }

}
