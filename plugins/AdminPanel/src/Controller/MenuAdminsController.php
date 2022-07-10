<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;

/**
 * MenuAdmins Controller
 * @property \AdminPanel\Model\Table\MenuAdminsTable $MenuAdmins
 *
 * @method \AdminPanel\Model\Entity\MenuAdmin[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MenuAdminsController extends AppController
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
            $data = $this->MenuAdmins->find('all')
                ->select();
            $data->contain(['ParentMenuAdmins']);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                        custom field for general search
                        ex : 'Users.email LIKE' => '%' . $search .'%'
                    **/
                    $data->where(['MenuAdmins.name LIKE' => '%' . $search .'%']);
                }
                $data->where($query);
            }

            if (isset($sort['field']) && isset($sort['sort'])) {
                $data->order([$sort['field'] => $sort['sort']]);
            }

            $data->order(['MenuAdmins.lft' => 'ASC']);

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


        //$this->set(compact('menuAdmins'));
    }

    /**
     * View method
     *
     * @param string|null $id Menu Admin id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('ajax');
        $menuAdmin = $this->MenuAdmins->get($id, [
            'contain' => ['ParentMenuAdmins', 'ChildMenuAdmins']
        ]);

        $this->set('menuAdmin', $menuAdmin);
    }

    function move($type = null, $id = null ) {

        if ($type == 'up') {
            $node = $this->MenuAdmins->get($id);
            $this->MenuAdmins->moveUp($node,true);
            $this->redirect(array('action' => 'index'));
        }

        if ($type == 'down') {
            $node = $this->MenuAdmins->get($id);
            $this->MenuAdmins->moveDown($node,true);
            $this->redirect(array('action' => 'index'));
        }

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $menuAdmin = $this->MenuAdmins->newEntity();
        if ($this->request->is('post')) {
            $menuAdmin = $this->MenuAdmins->patchEntity($menuAdmin, $this->request->getData());
            if ($this->MenuAdmins->save($menuAdmin)) {
                $this->Flash->success(__('The menu admin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu admin could not be saved. Please, try again.'));
        }
        $parentMenuAdmins = $this->MenuAdmins->ParentMenuAdmins->find('treeList', ['limit' => 200]);
        $this->set(compact('menuAdmin', 'parentMenuAdmins'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Menu Admin id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $menuAdmin = $this->MenuAdmins->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menuAdmin = $this->MenuAdmins->patchEntity($menuAdmin, $this->request->getData());
            if ($this->MenuAdmins->save($menuAdmin)) {
                $this->Flash->success(__('The menu admin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu admin could not be saved. Please, try again.'));
        }
        $parentMenuAdmins = $this->MenuAdmins->ParentMenuAdmins->find('treeList', ['limit' => 200]);
        $this->set(compact('menuAdmin', 'parentMenuAdmins'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu Admin id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menuAdmin = $this->MenuAdmins->get($id);
        try {
            if ($this->MenuAdmins->delete($menuAdmin)) {
                $this->Flash->success(__('The menu admin has been deleted.'));
            } else {
                $this->Flash->error(__('The menu admin could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The menu admin could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
