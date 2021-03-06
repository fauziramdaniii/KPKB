<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use AdminPanel\Lib\AclSync;
use Cake\Database\Expression\QueryExpression;
use Cake\Database\Query;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Controller
 * @property \AdminPanel\Model\Table\UsersTable $Users
 * @method \AdminPanel\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->Auth->allow(['login', 'logout']);
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response
     */
    public function index()
    {

        /*$sync = new AclSync();
        $sync->startup($this);
        $sync->acoSync(['plugin' => 'AdminPanel']);*/
        //debug($this->Auth->user('group.level'));exit;



        $groups = $this->_listGroups();
        $user_statuses = $this->Users->UserStatus->find('list');
        $this->set(compact('groups', 'user_statuses'));


        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            $data = $this->Users->find('all')
                ->select()
                ->contain([
                    'Groups' => function (Query $q) {
                        return $this->Auth->user('group.level') === 0 ? $q :
                            $q->where(['Groups.level >' => $this->Auth->user('group.level')]);
                    },
                    'UserStatus'
                ]);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    $data->where(function (QueryExpression $exp, Query $query) use($search) {
                        $concat = $query->func()->concat([
                            'Users.first_name' => 'identifier',
                            ' ',
                            'Users.last_name' => 'identifier'
                        ]);
                        $orConditions = $exp->or_([
                            'Users.email LIKE' => '%' . $search .'%',
                        ]);
                        $orConditions->like($concat, '%' . $search .'%');
                        return $exp
                            ->add($orConditions);
                    });
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
     * change password
     */
    public function password()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => []
        ]);

        if ($this->request->is('put')) {
            $this->Users->getValidator('password')
                ->add('old_password', 'custom', [
                    'rule' => function($value, $context) use ($user) {
                        return (new DefaultPasswordHasher())->check($value, $user->get('password'));
                    },
                    'message' => 'Old password doesn\'t match'
                ]);

            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'validate' => 'password',
                'fields' => [
                    'password'
                ]
            ]);
            if ($this->Users->save($user)) {
                $this->request = $this->request->withoutData('old_password');
                $this->Flash->success(__('The password has been changed.'));
            } else {
                $this->Flash->error(__('The password could not be saved. Please, try again.'));
            }

        }

        $this->set('user', $user);
    }


    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
    }

    /**
     * @param string $name
     */
    protected function _validationGroup($name = 'default')
    {
        $this->Users->getValidator($name)
            ->add('group_id', 'custom', [
                'rule' => function ($value, $context) {
                    $list = $this->Users->Groups->find('list')
                        ->where(function (QueryExpression $exp) use($value) {
                            return $exp->gt('level', $this->Auth->user('group.level'));
                        })->toArray();
                    return count($list) > 0 && isset($list[$value]);
                },
                'message' => 'Invalid Group'
            ]);
    }

    /**
     * @return \Cake\ORM\Query
     */
    protected function _listGroups()
    {
        return $this->Users->Groups->find('list')
            ->where(function (QueryExpression $exp)  {
                return $exp->gt('level', $this->Auth->user('group.level'));
            });
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $this->_validationGroup();
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $groups = $this->_listGroups();
        $user_status = $this->Users->UserStatus->find('list');
        $this->set(compact('user', 'groups', 'user_status'));


        $this->Breadcrumb->push(
            [
                'title' => 'Add New User',
                'url' => \Cake\Routing\Router::url(['controller' => 'Users', 'action' => 'add']),
            ]
        );
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Groups']
        ]);

        if ($this->Auth->user('group.level') > $user->group->get('level')) {
            $this->Flash->error(__('Your privilege not enough to edit this user.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->request->getData('password') === '') {
                $this->request = $this->request->withoutData('password');
            }
            $this->_validationGroup('update');
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'update']);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        //$user->password = null;
        $groups = $this->_listGroups();
        $user_status = $this->Users->UserStatus->find('list');
        $this->set(compact('user', 'groups', 'user_status'));

        $this->Breadcrumb->push(
            [
                'title' => 'Edit User [ '.$user->first_name.' ]',
                'url' => \Cake\Routing\Router::url(['controller' => 'Users', 'action' => 'edit', $id]),
            ]
        );
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id, [
            'contain' => ['Groups']
        ]);

        if ($id != $this->Auth->user('id') &&
            $user['group']['level'] >= $this->Auth->user('group.level') &&
            $this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @return \Cake\Http\Response|null
     */
    public function login()
    {
        $this->viewBuilder()->setLayout('login');
        if ($this->Auth->user()) {
            return $this->redirect(['controller' => 'dashboard']);
        }
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                if (!$this->request->is('ajax')) {
                    return $this->redirect($this->Auth->redirectUrl());
                }
            } else {
                $this->Flash->error(__('Username or password is incorrect'));
                return $this->redirect('/admin-panel');
            }
            $this->viewBuilder()->setLayout('ajax');
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($user));
        }
    }

    /**
     * @return \Cake\Http\Response|null
     */
    public function logout()
    {
        $this->disableAutoRender();
        return $this->redirect($this->Auth->logout());
    }
}
