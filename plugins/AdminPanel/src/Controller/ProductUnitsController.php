<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;

/**
 * ProductUnits Controller
 * @property \AdminPanel\Model\Table\ProductUnitsTable $ProductUnits
 *
 * @method \AdminPanel\Model\Entity\ProductUnit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductUnitsController extends AppController
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
            $data = $this->ProductUnits->find('all')
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                        custom field for general search
                        ex : 'Users.email LIKE' => '%' . $search .'%'
                    **/
                    $data->where(['ProductUnits.name LIKE' => '%' . $search .'%']);
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


        $this->set(compact('productUnits'));
    }

    /**
     * View method
     *
     * @param string|null $id Product Unit id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('ajax');
        $productUnit = $this->ProductUnits->get($id, [
            'contain' => ['Products']
        ]);

        $this->set('productUnit', $productUnit);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productUnit = $this->ProductUnits->newEntity();
        if ($this->request->is('post')) {
            $productUnit = $this->ProductUnits->patchEntity($productUnit, $this->request->getData());
            if ($this->ProductUnits->save($productUnit)) {
                $this->Flash->success(__('The product unit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product unit could not be saved. Please, try again.'));
        }
        $this->set(compact('productUnit'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product Unit id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productUnit = $this->ProductUnits->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productUnit = $this->ProductUnits->patchEntity($productUnit, $this->request->getData());
            if ($this->ProductUnits->save($productUnit)) {
                $this->Flash->success(__('The product unit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product unit could not be saved. Please, try again.'));
        }
        $this->set(compact('productUnit'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product Unit id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productUnit = $this->ProductUnits->get($id);
        try {
            if ($this->ProductUnits->delete($productUnit)) {
                $this->Flash->success(__('The product unit has been deleted.'));
            } else {
                $this->Flash->error(__('The product unit could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The product unit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
