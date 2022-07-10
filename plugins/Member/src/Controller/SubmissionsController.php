<?php
namespace Member\Controller;

use Cake\I18n\Time;
use Cake\Validation\Validator;
use Member\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;


/**
 * Submissions Controller
 *
 * @property \AdminPanel\Model\Table\KtpSubmissionsTable $KtpSubmissions
 * @property \AdminPanel\Model\Table\KkSubmissionsTable $KkSubmissions
 * @property \AdminPanel\Model\Table\KiaSubmissionsTable $KiaSubmissions
 * @property \AdminPanel\Model\Table\AddressSubmissionsTable $AddressSubmissions
 * @property \AdminPanel\Model\Table\SubmissionStatusesTable $SubmissionStatuses
 * @property \AdminPanel\Model\Table\ClassificationsTable $Classifications
 * @property \AdminPanel\Model\Table\RequirementsTable $Requirements
 * @property \AdminPanel\Model\Table\KtpRequirementsTable $KtpRequirements
 * @property \AdminPanel\Model\Table\KkRequirementsTable $KkRequirements
 * @property \AdminPanel\Model\Table\KiaRequirementsTable $KiaRequirements
 * @property \AdminPanel\Model\Table\AddressRequirementsTable $AddressRequirements
 * @property \AdminPanel\Model\Table\ImagesTable $Images
 * @method \Member\Model\Entity\Bank[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubmissionsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.KtpSubmissions');
        $this->loadModel('AdminPanel.KkSubmissions');
        $this->loadModel('AdminPanel.KiaSubmissions');
        $this->loadModel('AdminPanel.AddressSubmissions');
        $this->loadModel('AdminPanel.SubmissionStatuses');
        $this->loadModel('AdminPanel.Classifications');
        $this->loadModel('AdminPanel.Requirements');
        $this->loadModel('AdminPanel.KtpRequirements');
        $this->loadModel('AdminPanel.KkRequirements');
        $this->loadModel('AdminPanel.KiaRequirements');
        $this->loadModel('AdminPanel.AddressRequirements');
        $this->loadModel('AdminPanel.Images');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function ktp()
    {
        $customer_id = $this->Auth->user('id');

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            $data = $this->KtpSubmissions->find();

            $data = $data
                ->contain([
                    'SubmissionStatuses',
                    'Classifications'
                ])
                ->where([
                    'KtpSubmissions.customer_id' => $customer_id
                ])
                ->orderDesc('KtpSubmissions.id');


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

    public function listKtp()
    {
        $customer_id = $this->Auth->user('id');

        $classifications = $this->Classifications->find('all')
            ->where(['Classifications.type' => 'ktp'])
            ->contain(['Requirements'])
            ->toArray();

        $this->set(compact('customer_id', 'classifications'));
    }

    public function addKtp($status = null)
    {
        $customer_id = $this->Auth->user('id');
        $status_pembuatan = $status;
        $classification = $this->Classifications->find()
            ->where(['Classifications.slug' => $status])
            ->first();
        $requirements = $this->Requirements->find('all')
            ->where(['Classifications.slug' => $status])
            ->contain(['Classifications'])
            ->toArray();
        $ktp = $this->KtpSubmissions->newEntity();
        if ($this->request->is('post')) {

            $validator = $this->KtpSubmissions->getValidator('default')
                ->requirePresence('name')
                ->requirePresence('nik')
                ->requirePresence('address')
                ->requirePresence('applicant');

            $validator_image = new Validator();
            foreach($this->request->getData('requirement') as $key => $value){
                $validator_image->requirePresence('name');
                $validator_image->requirePresence('attachment')
                    ->add('attachment', 'check', [
                        'rule' => function($val) {
                            $mime = mime_content_type($val['tmp_name']);
                            return in_array($mime, [
                                'image/png',
                                'image/jpeg',
                                'image/gif',
                            ]);
                        },
                        'message' => 'Not valid file type'
                    ]);
            }
            $validator->addNestedMany('requirement', $validator_image);

            $ktp = $this->KtpSubmissions->patchEntity($ktp, $this->request->getData());
            $ktp->classification_id = $classification->id;
            $ktp->submission_status_id = 1;
            $ktp->customer_id = $customer_id;
            if ($this->KtpSubmissions->save($ktp)) {
                $ktp_submission_id = $ktp->id;
                if($this->request->getData(['requirement'])){
                    foreach($this->request->getData(['requirement']) as $requirement){
                        $ktp_requirement = $this->KtpRequirements->newEntity();

//                        $this->KtpRequirements->getValidator('default')
//                            ->requirePresence('attachment')
//                            //->allowEmptyFile('attachment')
//                            ->add('attachment', 'mime', [
//                                'rule' => function($value) {
//                                    $mime = mime_content_type($value['tmp_name']);
//                                    return in_array($mime, [
//                                        'image/png',
//                                        'image/jpeg',
//                                        'image/gif',
//                                    ]);
//                                },
//                                'message' => 'Not valid file type'
//                            ]);

                        $image = $this->Images->newEntity([
                            'name' => $requirement['attachment']
                        ]);
                        $this->Images->save($image);
                        $ktp_requirement = $this->KtpRequirements->patchEntity($ktp_requirement, $this->request->getData());
                        $ktp_requirement->ktp_submission_id = $ktp_submission_id;
                        $ktp_requirement->name = $requirement['name'];
                        $ktp_requirement->image_id = $image->id;
                        $this->KtpRequirements->save($ktp_requirement);
                    }
                }
                $this->Flash->success(__('Pengajuan KTP berhasil, Harap Tunggu Konfirmasi Selanjutnya.'));

                return $this->redirect(['action' => 'ktp']);
            }
        }
//        debug($ktp);exit;
        $this->set(compact('ktp', 'status_pembuatan', 'requirements'));
    }

    public function detailKtp($id = null)
    {
        $customer_id = $this->Auth->user('id');

        $ktp = $this->KtpSubmissions->find()
            ->where([
                'KtpSubmissions.customer_id' => $customer_id,
                'KtpSubmissions.id' => $id,
            ])
            ->contain(['Classifications', 'SubmissionStatuses', 'Customers'])
            ->first();

        $ktp_requirements = $this->KtpRequirements->find('all')
            ->where(['KtpRequirements.ktp_submission_id' => $ktp->id])
            ->contain(['Images'])
            ->toArray();

        $this->set(compact('customer_id', 'ktp', 'ktp_requirements'));
    }

    public function editKtp($id = null)
    {

        $customer_id = $this->Auth->user('id');
        $ktp = $this->KtpSubmissions->find()
            ->where([
                'customer_id' => $customer_id,
                'id' => $id
            ])
            ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {

            $ktp = $this->KtpSubmissions->patchEntity($ktp, $this->request->getData());
            $ktp->customer_id = $customer_id; //re set again
            if ($this->KtpSubmissions->save($ktp)) {
                $this->Flash->success(__('Pengajuan KTP berhasil di update.'));

                return $this->redirect(['action' => 'ktp']);
            }
            $this->Flash->error(__('Pengajuan KTP gagal disimpan, silahkan coba lagi.'));
        }
        $this->set(compact('ktp'));
    }

    public function deleteKtp($id = null)
    {
        $customer_id = $this->Auth->user('id');
        $this->request->allowMethod(['post', 'delete']);

        $ktp = $this->KtpSubmissions->find()
            ->where([
                'customer_id' => $customer_id,
                'id' => $id
            ])->first();



        if ($this->KtpSubmissions->delete($ktp)) {
            $this->Flash->success(__('Pengajuan KTP berhasil dihapus.'));
        } else {
            $this->Flash->error(__('Pengajuan KTP gagal dihapus, silahkan coba lagi.'));
        }

        return $this->redirect(['action' => 'ktp']);
    }

    public function kk()
    {
        $customer_id = $this->Auth->user('id');

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            $data = $this->KkSubmissions->find();

            $data = $data
                ->contain([
                    'SubmissionStatuses',
                    'Classifications'
                ])
                ->where([
                    'KkSubmissions.customer_id' => $customer_id
                ])
                ->orderDesc('KkSubmissions.id');


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

    public function listKk()
    {
        $customer_id = $this->Auth->user('id');

        $classifications = $this->Classifications->find('all')
            ->where(['Classifications.type' => 'kk'])
            ->contain(['Requirements'])
            ->toArray();

        $this->set(compact('customer_id', 'classifications'));
    }

    public function addKk($status = null)
    {
        $customer_id = $this->Auth->user('id');
        $status_pembuatan = $status;
        $classification = $this->Classifications->find()
            ->where(['Classifications.slug' => $status])
            ->first();
        $requirements = $this->Requirements->find('all')
            ->where(['Classifications.slug' => $status])
            ->contain(['Classifications'])
            ->toArray();
        $kk = $this->KkSubmissions->newEntity();
        if ($this->request->is('post')) {

            $validator = $this->KkSubmissions->getValidator('default')
                ->requirePresence('name')
                ->requirePresence('no_kk')
                ->requirePresence('address')
                ->requirePresence('applicant');

            $validator_image = new Validator();
            foreach($this->request->getData('requirement') as $key => $value){
                $validator_image->requirePresence('name');
                $validator_image->requirePresence('attachment')
                    ->add('attachment', 'check', [
                        'rule' => function($val) {
                            $mime = mime_content_type($val['tmp_name']);
                            return in_array($mime, [
                                'image/png',
                                'image/jpeg',
                                'image/gif',
                            ]);
                        },
                        'message' => 'Not valid file type'
                    ]);
            }
            $validator->addNestedMany('requirement', $validator_image);

            $kk = $this->KkSubmissions->patchEntity($kk, $this->request->getData());
            $kk->classification_id = $classification->id;
            $kk->submission_status_id = 1;
            $kk->customer_id = $customer_id;
            if ($this->KkSubmissions->save($kk)) {
                $kk_submission_id = $kk->id;
                if($this->request->getData(['requirement'])){
                    foreach($this->request->getData(['requirement']) as $requirement){
                        $kk_requirement = $this->KkRequirements->newEntity();

                        $image = $this->Images->newEntity([
                            'name' => $requirement['attachment']
                        ]);
                        $this->Images->save($image);
                        $kk_requirement = $this->KkRequirements->patchEntity($kk_requirement, $this->request->getData());
                        $kk_requirement->kk_submission_id = $kk_submission_id;
                        $kk_requirement->name = $requirement['name'];
                        $kk_requirement->image_id = $image->id;
                        $this->KkRequirements->save($kk_requirement);
                    }
                }
                $this->Flash->success(__('Pengajuan KK berhasil, Harap Tunggu Konfirmasi Selanjutnya.'));

                return $this->redirect(['action' => 'kk']);
            }
        }
        $this->set(compact('kk', 'status_pembuatan', 'requirements'));
    }

    public function detailKk($id = null)
    {
        $customer_id = $this->Auth->user('id');

        $kk = $this->KkSubmissions->find()
            ->where([
                'KkSubmissions.customer_id' => $customer_id,
                'KkSubmissions.id' => $id,
            ])
            ->contain(['Classifications', 'SubmissionStatuses', 'Customers'])
            ->first();

        $kk_requirements = $this->KkRequirements->find('all')
            ->where(['KkRequirements.kk_submission_id' => $kk->id])
            ->contain(['Images'])
            ->toArray();

        $this->set(compact('customer_id', 'kk', 'kk_requirements'));
    }

    public function editKk($id = null)
    {

        $customer_id = $this->Auth->user('id');
        $kk = $this->KkSubmissions->find()
            ->where([
                'customer_id' => $customer_id,
                'id' => $id
            ])
            ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {

            $kk = $this->KkSubmissions->patchEntity($kk, $this->request->getData());
            $kk->customer_id = $customer_id; //re set again
            if ($this->KkSubmissions->save($kk)) {
                $this->Flash->success(__('Pengajuan KK berhasil di update.'));

                return $this->redirect(['action' => 'kk']);
            }
            $this->Flash->error(__('Pengajuan KK gagal disimpan, silahkan coba lagi.'));
        }
        $this->set(compact('kk'));
    }

    public function deleteKk($id = null)
    {
        $customer_id = $this->Auth->user('id');
        $this->request->allowMethod(['post', 'delete']);

        $kk = $this->KkSubmissions->find()
            ->where([
                'customer_id' => $customer_id,
                'id' => $id
            ])->first();

        if ($this->KkSubmissions->delete($kk)) {
            $this->Flash->success(__('Pengajuan KK berhasil dihapus.'));
        } else {
            $this->Flash->error(__('Pengajuan KK gagal dihapus, silahkan coba lagi.'));
        }

        return $this->redirect(['action' => 'kk']);
    }

    public function kia()
    {
        $customer_id = $this->Auth->user('id');

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            $data = $this->KiaSubmissions->find();

            $data = $data
                ->contain([
                    'SubmissionStatuses',
                    'Classifications'
                ])
                ->where([
                    'KiaSubmissions.customer_id' => $customer_id
                ])
                ->orderDesc('KiaSubmissions.id');


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

    public function listKia()
    {
        $customer_id = $this->Auth->user('id');

        $classifications = $this->Classifications->find('all')
            ->where(['Classifications.type' => 'kia'])
            ->contain(['Requirements'])
            ->toArray();

        $this->set(compact('customer_id', 'classifications'));
    }

    public function addKia($status = null)
    {
        $customer_id = $this->Auth->user('id');
        $status_pembuatan = $status;
        $classification = $this->Classifications->find()
            ->where(['Classifications.slug' => $status])
            ->first();
        $requirements = $this->Requirements->find('all')
            ->where(['Classifications.slug' => $status])
            ->contain(['Classifications'])
            ->toArray();
        $kia = $this->KiaSubmissions->newEntity();
        if ($this->request->is('post')) {

            $validator = $this->KiaSubmissions->getValidator('default')
                ->requirePresence('name')
                ->requirePresence('nik')
                ->requirePresence('address')
                ->requirePresence('applicant');

            $validator_image = new Validator();
            foreach($this->request->getData('requirement') as $key => $value){
                $validator_image->requirePresence('name');
                $validator_image->requirePresence('attachment')
                    ->add('attachment', 'check', [
                        'rule' => function($val) {
                            $mime = mime_content_type($val['tmp_name']);
                            return in_array($mime, [
                                'image/png',
                                'image/jpeg',
                                'image/gif',
                            ]);
                        },
                        'message' => 'Not valid file type'
                    ]);
            }
            $validator->addNestedMany('requirement', $validator_image);

            $kia = $this->KiaSubmissions->patchEntity($kia, $this->request->getData());
            $kia->classification_id = $classification->id;
            $kia->submission_status_id = 1;
            $kia->customer_id = $customer_id;
            if ($this->KiaSubmissions->save($kia)) {
                $kia_submission_id = $kia->id;
                if ($this->request->getData(['requirement'])) {
                    foreach ($this->request->getData(['requirement']) as $requirement) {
                        $kia_requirement = $this->KiaRequirements->newEntity();

                        $image = $this->Images->newEntity([
                            'name' => $requirement['attachment']
                        ]);
                        $this->Images->save($image);
                        $kia_requirement = $this->KiaRequirements->patchEntity($kia_requirement, $this->request->getData());
                        $kia_requirement->kia_submission_id = $kia_submission_id;
                        $kia_requirement->name = $requirement['name'];
                        $kia_requirement->image_id = $image->id;
                        $this->KiaRequirements->save($kia_requirement);
                    }
                }
                $this->Flash->success(__('Pengajuan KIA berhasil, Harap Tunggu Konfirmasi Selanjutnya.'));

                return $this->redirect(['action' => 'kia']);
            }
        }
        $this->set(compact('kia', 'status_pembuatan', 'requirements'));
    }

    public function detailKia($id = null)
    {
        $customer_id = $this->Auth->user('id');

        $kia = $this->KiaSubmissions->find()
            ->where([
                'KiaSubmissions.customer_id' => $customer_id,
                'KiaSubmissions.id' => $id,
            ])
            ->contain(['Classifications', 'SubmissionStatuses', 'Customers'])
            ->first();

        $kia_requirements = $this->KiaRequirements->find('all')
            ->where(['KiaRequirements.kia_submission_id' => $kia->id])
            ->contain(['Images'])
            ->toArray();

        $this->set(compact('customer_id', 'kia', 'kia_requirements'));
    }

    public function editKia($id = null)
    {

        $customer_id = $this->Auth->user('id');
        $kia = $this->KiaSubmissions->find()
            ->where([
                'customer_id' => $customer_id,
                'id' => $id
            ])
            ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {

            $kia = $this->KiaSubmissions->patchEntity($kia, $this->request->getData());
            $kia->customer_id = $customer_id; //re set again
            if ($this->KiaSubmissions->save($kia)) {
                $this->Flash->success(__('Pengajuan KIA berhasil di update.'));

                return $this->redirect(['action' => 'kia']);
            }
            $this->Flash->error(__('Pengajuan KIA gagal disimpan, silahkan coba lagi.'));
        }
        $this->set(compact('kia'));
    }

    public function deleteKia($id = null)
    {
        $customer_id = $this->Auth->user('id');
        $this->request->allowMethod(['post', 'delete']);

        $kia = $this->KiaSubmissions->find()
            ->where([
                'customer_id' => $customer_id,
                'id' => $id
            ])->first();

        if ($this->KiaSubmissions->delete($kia)) {
            $this->Flash->success(__('Pengajuan KIA berhasil dihapus.'));
        } else {
            $this->Flash->error(__('Pengajuan KIA gagal dihapus, silahkan coba lagi.'));
        }

        return $this->redirect(['action' => 'kia']);
    }

    public function pindahAlamat()
    {
        $customer_id = $this->Auth->user('id');

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            $data = $this->AddressSubmissions->find();

            $data = $data
                ->contain([
                    'SubmissionStatuses',
                    'Classifications'
                ])
                ->where([
                    'AddressSubmissions.customer_id' => $customer_id
                ])
                ->orderDesc('AddressSubmissions.id');


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

    public function listAddress()
    {
        $customer_id = $this->Auth->user('id');

        $classifications = $this->Classifications->find('all')
            ->where(['Classifications.type' => 'address'])
            ->contain(['Requirements'])
            ->toArray();

        $this->set(compact('customer_id', 'classifications'));
    }

    public function addAddress($status = null)
    {
        $customer_id = $this->Auth->user('id');
        $status_pembuatan = $status;
        $classification = $this->Classifications->find()
            ->where(['Classifications.slug' => $status])
            ->first();
        $requirements = $this->Requirements->find('all')
            ->where(['Classifications.slug' => $status])
            ->contain(['Classifications'])
            ->toArray();
        $address = $this->AddressSubmissions->newEntity();
        if ($this->request->is('post')) {

            $validator = $this->AddressSubmissions->getValidator('default')
                ->requirePresence('name')
                ->requirePresence('nik')
                ->requirePresence('original_address')
                ->requirePresence('destination_address');

            $validator_image = new Validator();
            foreach($this->request->getData('requirement') as $key => $value){
                $validator_image->requirePresence('name');
                $validator_image->requirePresence('attachment')
                    ->add('attachment', 'check', [
                        'rule' => function($val) {
                            $mime = mime_content_type($val['tmp_name']);
                            return in_array($mime, [
                                'image/png',
                                'image/jpeg',
                                'image/gif',
                            ]);
                        },
                        'message' => 'Not valid file type'
                    ]);
            }
            $validator->addNestedMany('requirement', $validator_image);

            $address = $this->AddressSubmissions->patchEntity($address, $this->request->getData());
            $address->classification_id = $classification->id;
            $address->submission_status_id = 1;
            $address->customer_id = $customer_id;
            if ($this->AddressSubmissions->save($address)) {
                $address_submission_id = $address->id;
                if($this->request->getData(['requirement'])){
                    foreach($this->request->getData(['requirement']) as $requirement){
                        $address_requirement = $this->AddressRequirements->newEntity();
//                        $this->KtpRequirements->getValidator('default')
//                            ->requirePresence('attachment')
//                            //->allowEmptyFile('attachment')
//                            ->add('attachment', 'mime', [
//                                'rule' => function($value) {
//                                    $mime = mime_content_type($value['tmp_name']);
//                                    return in_array($mime, [
//                                        'image/png',
//                                        'image/jpeg',
//                                        'image/gif',
//                                    ]);
//                                },
//                                'message' => 'Not valid file type'
//                            ]);

                        $image = $this->Images->newEntity([
                            'name' => $requirement['attachment']
                        ]);
                        $this->Images->save($image);
                        $address_requirement = $this->AddressRequirements->patchEntity($address_requirement, $this->request->getData());
                        $address_requirement->address_submission_id = $address_submission_id;
                        $address_requirement->name = $requirement['name'];
                        $address_requirement->image_id = $image->id;
                        $this->AddressRequirements->save($address_requirement);
                    }
                }
                $this->Flash->success(__('Pengajuan Surat berhasil, Harap Tunggu Konfirmasi Selanjutnya.'));

                return $this->redirect(['action' => 'pindahAlamat']);
            }
        }
        $this->set(compact('address', 'status_pembuatan', 'requirements'));
    }

    public function detailAddress($id = null)
    {
        $customer_id = $this->Auth->user('id');

        $address = $this->AddressSubmissions->find()
            ->where([
                'AddressSubmissions.customer_id' => $customer_id,
                'AddressSubmissions.id' => $id,
            ])
            ->contain(['Classifications', 'SubmissionStatuses', 'Customers'])
            ->first();

        $address_requirements = $this->AddressRequirements->find('all')
            ->where(['AddressRequirements.address_submission_id' => $address->id])
            ->contain(['Images'])
            ->toArray();

        $this->set(compact('customer_id', 'address', 'address_requirements'));
    }

    public function editAddress($id = null)
    {

        $customer_id = $this->Auth->user('id');
        $address = $this->AddressSubmissions->find()
            ->where([
                'customer_id' => $customer_id,
                'id' => $id
            ])
            ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {

            $address = $this->AddressSubmissions->patchEntity($address, $this->request->getData());
            $address->customer_id = $customer_id; //re set again
            if ($this->AddressSubmissions->save($address)) {
                $this->Flash->success(__('Pengajuan Pindah Alamat berhasil di update.'));

                return $this->redirect(['action' => 'pindahAlamat']);
            }
            $this->Flash->error(__('Pengajuan Pindah Alamat gagal disimpan, silahkan coba lagi.'));
        }
        $this->set(compact('address'));
    }

    public function deleteAddress($id = null)
    {
        $customer_id = $this->Auth->user('id');
        $this->request->allowMethod(['post', 'delete']);

        $address = $this->AddressSubmissions->find()
            ->where([
                'customer_id' => $customer_id,
                'id' => $id
            ])->first();

        if ($this->AddressSubmissions->delete($address)) {
            $this->Flash->success(__('Pengajuan Pindah Alamat berhasil dihapus.'));
        } else {
            $this->Flash->error(__('Pengajuan Pindah Alamat gagal dihapus, silahkan coba lagi.'));
        }

        return $this->redirect(['action' => 'pindahAlamat']);
    }
}
