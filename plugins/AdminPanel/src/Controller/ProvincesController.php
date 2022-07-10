<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;

/**
 * Provinces Controller
 * @property \AdminPanel\Model\Table\ProvincesTable $Provinces
 *
 * @method \AdminPanel\Model\Entity\Province[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProvincesController extends AppController
{

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
            $data = $this->Provinces->find('all')
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                        custom field for general search
                        ex : 'Users.email LIKE' => '%' . $search .'%'
                    **/
                    $data->where(['Provinces.name LIKE' => '%' . $search .'%']);
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
        $provinces = $this->paginate($this->Provinces);

        $this->set(compact('provinces'));
    }

    /**
     * View method
     *
     * @param string|null $id Province id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('ajax');
        $province = $this->Provinces->get($id, [
            'contain' => ['CustomerAddresses', 'Regencies']
        ]);

        $this->set('province', $province);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $province = $this->Provinces->newEntity();
        if ($this->request->is('post')) {
            $province = $this->Provinces->patchEntity($province, $this->request->getData());
            if ($this->Provinces->save($province)) {
                $this->Flash->success(__('The province has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The province could not be saved. Please, try again.'));
        }
        $this->set(compact('province'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Province id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $province = $this->Provinces->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $province = $this->Provinces->patchEntity($province, $this->request->getData());
            if ($this->Provinces->save($province)) {
                $this->Flash->success(__('The province has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The province could not be saved. Please, try again.'));
        }
        $this->set(compact('province'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Province id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $province = $this->Provinces->get($id);
        try {
            if ($this->Provinces->delete($province)) {
                $this->Flash->success(__('The province has been deleted.'));
            } else {
                $this->Flash->error(__('The province could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The province could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
