<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;

/**
 * WhatsApp Controller
 *
 * @property \AdminPanel\Model\Table\WhatsAppTable $WhatsApp
 */
class WhatsAppController extends AppController
{

    public function index()
    {

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->WhatsApp->find('all')
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['WhatsApp.no_whatsapp LIKE' => '%' . $search .'%']);
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

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $whatsapp = $this->WhatsApp->newEntity();
        if ($this->request->is('post')) {
            $whatsapp = $this->WhatsApp->patchEntity($whatsapp, $this->request->getData());
            if ($this->WhatsApp->save($whatsapp)) {
                $this->Flash->success(__('The WhatsApp has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The WhatsApp could not be saved. Please, try again.'));
        }
        $this->set(compact('whatsapp'));
    }

    /**
     * Edit method
     *
     * @param string|null $id WhatsApp id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $whatsapp = $this->WhatsApp->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $whatsapp = $this->WhatsApp->patchEntity($whatsapp, $this->request->getData());
            if ($this->WhatsApp->save($whatsapp)) {
                $this->Flash->success(__('The WhatsApp has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The WhatsApp could not be saved. Please, try again.'));
        }
        $this->set(compact('whatsapp'));
    }

    /**
     * Delete method
     *
     * @param string|null $id WhatsApp id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $whatsapp = $this->WhatsApp->get($id);
        try {
            if ($this->WhatsApp->delete($whatsapp)) {
                $this->Flash->success(__('The WhatsApp has been deleted.'));
            } else {
                $this->Flash->error(__('The WhatsApp could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The WhatsApp could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}