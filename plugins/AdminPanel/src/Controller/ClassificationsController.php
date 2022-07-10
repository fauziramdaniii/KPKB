<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;

/**
 * Classification Controller
 *
 * @property \AdminPanel\Model\Table\ClassificationsTable $Classifications
 * @property \AdminPanel\Model\Table\RequirementsTable $Requirements
 *
 * @method \AdminPanel\Model\Entity\Setting[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClassificationsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Classifications');
        $this->loadModel('AdminPanel.Requirements');
    }

    public function ktp()
    {

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Classifications->find('all')
                ->where(['Classifications.type' => 'ktp'])
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['Classifications.name LIKE' => '%' . $search .'%']);
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

    public function addKtp()
    {
        $classification = $this->Classifications->newEntity();
        if ($this->request->is('post')) {
            $classification = $this->Classifications->patchEntity($classification, $this->request->getData());
            $classification->type = 'ktp';
            if ($this->Classifications->save($classification)) {
                $classification_id = $classification->id;
                if(!empty($this->request->getData('persyaratan'))){
                    foreach ($this->request->getData('persyaratan') as $value){
                        $requirement = $this->Requirements->newEntity();
                        $requirement = $this->Requirements->patchEntity($requirement, $this->request->getData());
                        $requirement->classification_id = $classification_id;
                        $requirement->name = $value['name'];
                        $this->Requirements->save($requirement);
                    }
                }
                $this->Flash->success(__('Klasifikasi KTP berhasil disimpan.'));
                return $this->redirect(['action' => 'ktp']);
            }
            $this->Flash->error(__('The classification could not be saved. Please, try again.'));
        }
        $this->set(compact('classification'));
    }


    public function editKtp($id = null)
    {
        $classification = $this->Classifications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $classification = $this->Classifications->patchEntity($classification, $this->request->getData());
            if ($this->Classifications->save($classification)) {
                $this->Flash->success(__('The classification has been saved.'));

                return $this->redirect(['action' => 'ktp']);
            }
            $this->Flash->error(__('The classification could not be saved. Please, try again.'));
        }
        $this->set(compact('classification'));
    }


    public function deleteKtp($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $classification = $this->Classifications->get($id);
        try {
            if ($this->Classifications->delete($classification)) {
                $this->Flash->success(__('The classification has been deleted.'));
            } else {
                $this->Flash->error(__('The classification could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The classification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'ktp']);
    }

    public function kk()
    {

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Classifications->find('all')
                ->where(['Classifications.type' => 'kk'])
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['Classifications.name LIKE' => '%' . $search .'%']);
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

    public function addKk()
    {
        $classification = $this->Classifications->newEntity();
        if ($this->request->is('post')) {
            $classification = $this->Classifications->patchEntity($classification, $this->request->getData());
            $classification->type = 'kk';
            if ($this->Classifications->save($classification)) {
                $classification_id = $classification->id;
                if(!empty($this->request->getData('persyaratan'))){
                    foreach ($this->request->getData('persyaratan') as $value){
                        $requirement = $this->Requirements->newEntity();
                        $requirement = $this->Requirements->patchEntity($requirement, $this->request->getData());
                        $requirement->classification_id = $classification_id;
                        $requirement->name = $value['name'];
                        $this->Requirements->save($requirement);
                    }
                }
                $this->Flash->success(__('Klasifikasi KK berhasil disimpan.'));
                return $this->redirect(['action' => 'kk']);
            }
            $this->Flash->error(__('The classification could not be saved. Please, try again.'));
        }
        $this->set(compact('classification'));
    }


    public function editKk($id = null)
    {
        $classification = $this->Classifications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $classification = $this->Classifications->patchEntity($classification, $this->request->getData());
            if ($this->Classifications->save($classification)) {
                $this->Flash->success(__('The classification has been saved.'));

                return $this->redirect(['action' => 'kk']);
            }
            $this->Flash->error(__('The classification could not be saved. Please, try again.'));
        }
        $this->set(compact('classification'));
    }


    public function deleteKk($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $classification = $this->Classifications->get($id);
        try {
            if ($this->Classifications->delete($classification)) {
                $this->Flash->success(__('The classification has been deleted.'));
            } else {
                $this->Flash->error(__('The classification could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The classification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'kk']);
    }

    public function kia()
    {

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Classifications->find('all')
                ->where(['Classifications.type' => 'kia'])
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['Classifications.name LIKE' => '%' . $search .'%']);
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

    public function addKia()
    {
        $classification = $this->Classifications->newEntity();
        if ($this->request->is('post')) {
            $classification = $this->Classifications->patchEntity($classification, $this->request->getData());
            $classification->type = 'kia';
            if ($this->Classifications->save($classification)) {
                $classification_id = $classification->id;
                if(!empty($this->request->getData('persyaratan'))){
                    foreach ($this->request->getData('persyaratan') as $value){
                        $requirement = $this->Requirements->newEntity();
                        $requirement = $this->Requirements->patchEntity($requirement, $this->request->getData());
                        $requirement->classification_id = $classification_id;
                        $requirement->name = $value['name'];
                        $this->Requirements->save($requirement);
                    }
                }
                $this->Flash->success(__('Klasifikasi KIA berhasil disimpan.'));
                return $this->redirect(['action' => 'kia']);
            }
            $this->Flash->error(__('The classification could not be saved. Please, try again.'));
        }
        $this->set(compact('classification'));
    }


    public function editKia($id = null)
    {
        $classification = $this->Classifications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $classification = $this->Classifications->patchEntity($classification, $this->request->getData());
            if ($this->Classifications->save($classification)) {
                $this->Flash->success(__('The classification has been saved.'));

                return $this->redirect(['action' => 'kia']);
            }
            $this->Flash->error(__('The classification could not be saved. Please, try again.'));
        }
        $this->set(compact('classification'));
    }


    public function deleteKia($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $classification = $this->Classifications->get($id);
        try {
            if ($this->Classifications->delete($classification)) {
                $this->Flash->success(__('The classification has been deleted.'));
            } else {
                $this->Flash->error(__('The classification could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The classification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'kia']);
    }

    public function address()
    {

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Classifications->find('all')
                ->where(['Classifications.type' => 'address'])
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['Classifications.name LIKE' => '%' . $search .'%']);
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

    public function addAddress()
    {
        $classification = $this->Classifications->newEntity();
        if ($this->request->is('post')) {
            $classification = $this->Classifications->patchEntity($classification, $this->request->getData());
            $classification->type = 'address';
            if ($this->Classifications->save($classification)) {
                $classification_id = $classification->id;
                if(!empty($this->request->getData('persyaratan'))){
                    foreach ($this->request->getData('persyaratan') as $value){
                        $requirement = $this->Requirements->newEntity();
                        $requirement = $this->Requirements->patchEntity($requirement, $this->request->getData());
                        $requirement->classification_id = $classification_id;
                        $requirement->name = $value['name'];
                        $this->Requirements->save($requirement);
                    }
                }
                $this->Flash->success(__('Klasifikasi Pindah / Datang berhasil disimpan.'));
                return $this->redirect(['action' => 'address']);
            }
            $this->Flash->error(__('The classification could not be saved. Please, try again.'));
        }
        $this->set(compact('classification'));
    }


    public function editAddress($id = null)
    {
        $classification = $this->Classifications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $classification = $this->Classifications->patchEntity($classification, $this->request->getData());
            if ($this->Classifications->save($classification)) {
                $this->Flash->success(__('The classification has been saved.'));

                return $this->redirect(['action' => 'address']);
            }
            $this->Flash->error(__('The classification could not be saved. Please, try again.'));
        }
        $this->set(compact('classification'));
    }


    public function deleteAddress($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $classification = $this->Classifications->get($id);
        try {
            if ($this->Classifications->delete($classification)) {
                $this->Flash->success(__('The classification has been deleted.'));
            } else {
                $this->Flash->error(__('The classification could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The classification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'address']);
    }

    public function requirementsKtp($id = null)
    {

        $classification_id = $id;

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Requirements->find('all')
                ->where(['Requirements.classification_id' => $id])
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['Requirements.name LIKE' => '%' . $search .'%']);
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


        $this->set(compact('classification_id'));
    }

    public function addRequirementKtp($classification_id = null)
    {
        $requirement = $this->Requirements->newEntity();
        if ($this->request->is('post')) {
            $requirement = $this->Requirements->patchEntity($requirement, $this->request->getData());
            $requirement->classification_id = $classification_id;
            if ($this->Requirements->save($requirement)) {
                $this->Flash->success(__('Persyaratan Klasifikasi berhasil disimpan.'));
                return $this->redirect(['action' => 'requirementsKtp', $classification_id]);
            }
            $this->Flash->error(__('The requirement could not be saved. Please, try again.'));
        }
        $this->set(compact('requirement'));
    }


    public function editRequirementKtp($id = null)
    {
        $requirement = $this->Requirements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requirement = $this->Requirements->patchEntity($requirement, $this->request->getData());
            if ($this->Requirements->save($requirement)) {
                $this->Flash->success(__('The requirement has been saved.'));

                return $this->redirect(['action' => 'requirementsKtp', $requirement->classification_id]);
            }
            $this->Flash->error(__('The requirement could not be saved. Please, try again.'));
        }
        $this->set(compact('requirement'));
    }


    public function deleteRequirementKtp($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requirement = $this->Requirements->get($id);
        try {
            if ($this->Requirements->delete($requirement)) {
                $this->Flash->success(__('The requirement has been deleted.'));
            } else {
                $this->Flash->error(__('The requirement could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The requirement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'requirementsKtp', $requirement->classification_id]);
    }

    public function requirementsKk($id = null)
    {

        $classification_id = $id;

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Requirements->find('all')
                ->where(['Requirements.classification_id' => $id])
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['Requirements.name LIKE' => '%' . $search .'%']);
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


        $this->set(compact('classification_id'));
    }

    public function addRequirementKk($classification_id = null)
    {
        $requirement = $this->Requirements->newEntity();
        if ($this->request->is('post')) {
            $requirement = $this->Requirements->patchEntity($requirement, $this->request->getData());
            $requirement->classification_id = $classification_id;
            if ($this->Requirements->save($requirement)) {
                $this->Flash->success(__('Persyaratan Klasifikasi berhasil disimpan.'));
                return $this->redirect(['action' => 'requirementsKk', $classification_id]);
            }
            $this->Flash->error(__('The requirement could not be saved. Please, try again.'));
        }
        $this->set(compact('requirement'));
    }


    public function editRequirementKk($id = null)
    {
        $requirement = $this->Requirements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requirement = $this->Requirements->patchEntity($requirement, $this->request->getData());
            if ($this->Requirements->save($requirement)) {
                $this->Flash->success(__('The requirement has been saved.'));

                return $this->redirect(['action' => 'requirementsKk', $requirement->classification_id]);
            }
            $this->Flash->error(__('The requirement could not be saved. Please, try again.'));
        }
        $this->set(compact('requirement'));
    }


    public function deleteRequirementKk($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requirement = $this->Requirements->get($id);
        try {
            if ($this->Requirements->delete($requirement)) {
                $this->Flash->success(__('The requirement has been deleted.'));
            } else {
                $this->Flash->error(__('The requirement could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The requirement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'requirementsKk', $requirement->classification_id]);
    }

    public function requirementsKia($id = null)
    {

        $classification_id = $id;

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Requirements->find('all')
                ->where(['Requirements.classification_id' => $id])
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['Requirements.name LIKE' => '%' . $search .'%']);
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


        $this->set(compact('classification_id'));
    }

    public function addRequirementKia($classification_id = null)
    {
        $requirement = $this->Requirements->newEntity();
        if ($this->request->is('post')) {
            $requirement = $this->Requirements->patchEntity($requirement, $this->request->getData());
            $requirement->classification_id = $classification_id;
            if ($this->Requirements->save($requirement)) {
                $this->Flash->success(__('Persyaratan Klasifikasi berhasil disimpan.'));
                return $this->redirect(['action' => 'requirementsKia', $classification_id]);
            }
            $this->Flash->error(__('The requirement could not be saved. Please, try again.'));
        }
        $this->set(compact('requirement'));
    }


    public function editRequirementKia($id = null)
    {
        $requirement = $this->Requirements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requirement = $this->Requirements->patchEntity($requirement, $this->request->getData());
            if ($this->Requirements->save($requirement)) {
                $this->Flash->success(__('The requirement has been saved.'));

                return $this->redirect(['action' => 'requirementsKia', $requirement->classification_id]);
            }
            $this->Flash->error(__('The requirement could not be saved. Please, try again.'));
        }
        $this->set(compact('requirement'));
    }


    public function deleteRequirementKia($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requirement = $this->Requirements->get($id);
        try {
            if ($this->Requirements->delete($requirement)) {
                $this->Flash->success(__('The requirement has been deleted.'));
            } else {
                $this->Flash->error(__('The requirement could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The requirement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'requirementsKia', $requirement->classification_id]);
    }

    public function requirementsAddress($id = null)
    {

        $classification_id = $id;

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Requirements->find('all')
                ->where(['Requirements.classification_id' => $id])
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['Requirements.name LIKE' => '%' . $search .'%']);
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


        $this->set(compact('classification_id'));
    }

    public function addRequirementAddress($classification_id = null)
    {
        $requirement = $this->Requirements->newEntity();
        if ($this->request->is('post')) {
            $requirement = $this->Requirements->patchEntity($requirement, $this->request->getData());
            $requirement->classification_id = $classification_id;
            if ($this->Requirements->save($requirement)) {
                $this->Flash->success(__('Persyaratan Klasifikasi berhasil disimpan.'));
                return $this->redirect(['action' => 'requirementsAddress', $classification_id]);
            }
            $this->Flash->error(__('The requirement could not be saved. Please, try again.'));
        }
        $this->set(compact('requirement'));
    }


    public function editRequirementAddress($id = null)
    {
        $requirement = $this->Requirements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requirement = $this->Requirements->patchEntity($requirement, $this->request->getData());
            if ($this->Requirements->save($requirement)) {
                $this->Flash->success(__('The requirement has been saved.'));

                return $this->redirect(['action' => 'requirementsAddress', $requirement->classification_id]);
            }
            $this->Flash->error(__('The requirement could not be saved. Please, try again.'));
        }
        $this->set(compact('requirement'));
    }


    public function deleteRequirementAddress($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requirement = $this->Requirements->get($id);
        try {
            if ($this->Requirements->delete($requirement)) {
                $this->Flash->success(__('The requirement has been deleted.'));
            } else {
                $this->Flash->error(__('The requirement could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The requirement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'requirementsAddress', $requirement->classification_id]);
    }

}
