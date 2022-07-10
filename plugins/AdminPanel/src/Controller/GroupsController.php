<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use AdminPanel\Lib\JsTree;
use AdminPanel\Lib\AclSync;
/**
 * Groups Controller
 *
 * @property \AdminPanel\Model\Table\GroupsTable $Groups
 *
 * @method \AdminPanel\Model\Entity\Group[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GroupsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response
     */

    public function index()
    {

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            $data = $this->Groups->find('all')
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    $data->where();
                }
                $exp = new QueryExpression();
                $exp->like('name', '%' . $search .'%');
                $data->where($exp);
            }

            $data->where(function (QueryExpression $exp)  {
                return $exp->gt('level', $this->Auth->user('group.level'));
            });

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
     * View method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $group = $this->Groups->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('group', $group);
    }

    public function sync()
    {
        $this->disableAutoRender();
        $sync = new AclSync();
        $sync->startup($this);
        $sync->acoSync(['plugin' => 'AdminPanel']);

        $this->Flash->success(__('Aco Syncronize has been complete'));
        return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tree = JsTree::register($this->Acl);
        $group = $this->Groups->newEntity();
        if ($this->request->is('post')) {
            $group = $this->Groups->patchEntity($group, $this->request->getData() +
                ['level' => $this->Auth->user('group.level') + 1]);
            if ($this->Groups->save($group)) {
                $tree->setRole($group->id)
                    ->setAllow($this->request->getData('aros_acos'));
                $this->Flash->success(__('The group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The group could not be saved. Please, try again.'));
        }
        $aco = $tree->format();
        $this->set(compact('group', 'aco'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tree = JsTree::register($this->Acl)
            ->setRole($id);

        $group = $this->Groups->get($id, [
            'contain' => []
        ]);
        if ($this->Auth->user('group.level') > $group->level) {
            $this->Flash->error(__('Your privilege not enough to edit this user.'));
            return $this->redirect(['action' => 'index']);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->Groups->patchEntity($group, $this->request->getData());
            if ($this->Groups->save($group)) {
                $tree->setAllow($this->request->getData('aros_acos'));
                $this->Flash->success(__('The group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The group could not be saved. Please, try again.'));
        }

        $aco = $tree->format();
        $this->set(compact('group', 'aco'));


        $this->Breadcrumb->push(
            [
                'title' => 'Edit Group [ '.$group->name.' ]',
                'url' => \Cake\Routing\Router::url(['controller' => 'Groups', 'action' => 'edit', $id]),
            ]
        );
    }

    /**
     * Delete method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $group = $this->Groups->get($id);
        if ($this->Auth->user('group.level') > $group->level) {
            $this->Flash->error(__('Your privilege not enough to edit this user.'));
            return $this->redirect(['action' => 'index']);
        }
        if ($this->Groups->delete($group)) {
            $this->Flash->success(__('The group has been deleted.'));
        } else {
            $this->Flash->error(__('The group could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
