<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use AdminPanel\Model\Entity\TransactionType;

/**
 * Withdrawals Controller
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
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
 *
 * @method \AdminPanel\Model\Entity\Withdrawal[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubmissionsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Customers');
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
     * @return \Cake\Http\Response|void
     */
    public function ktp()
    {


        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');
            $status = $this->request->getData('status');

            $type = [
                'tertunda' => 'Tertunda',
                'diterima' => 'Diterima',
                'proses' => 'Proses',
                'selesai' => 'Selesai',
                'ditolak' => 'Ditolak'
            ];
            $status = $type[$status];

            /** custom default query : select, where, contain, etc. **/
            $data = $this->KtpSubmissions->find('all')
                ->select();
            $data->contain(['SubmissionStatuses', 'Classifications']);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                        custom field for general search
                        ex : 'Users.email LIKE' => '%' . $search .'%'
                    **/
                    $data->where(['OR' => [
                        'KtpSubmissions.name LIKE' => '%' . $search .'%',
                        'KtpSubmissions.nik LIKE' => '%' . $search .'%',
                        'KtpSubmissions.applicant LIKE' => '%' . $search .'%',
                        'Classifications.name LIKE' => '%' . $search .'%',
                    ]]);
                }
                $data->where($query);
            }

            /*
            if (isset($query['submission_status_id'])) {
                $submission_status_id = $query['submission_status_id'];
                $data->where(['KtpSubmissions.submission_status_id' => $submission_status_id]);
            }
            */

            if (isset($status)) {
                $data->where(['SubmissionStatuses.name' => ucfirst($status)]);
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


        $statusTypes = $this->KtpSubmissions->SubmissionStatuses->find('list')->toArray();
        $this->set(compact('statusTypes'));
    }

    public function updateKtp($id = null)
    {
        $ktp = $this->KtpSubmissions->get($id, [
            'contain' => [
                'Customers',
                'SubmissionStatuses',
                'Classifications'
            ]
        ]);
        $ktp_requirements = $this->KtpRequirements->find('all')
            ->where(['KtpRequirements.ktp_submission_id' => $ktp->id])
            ->contain(['Images'])
            ->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $ktp = $this->KtpSubmissions->patchEntity($ktp, $this->request->getData(), ['associated'=>['Customers', 'SubmissionStatuses', 'Classifications']]);
            if(!empty($this->request->getData(['tanggal_pengambilan_berkas'])) && !empty($this->request->getData(['tanggal_pengajuan_berkas']))){
                $ktp->tanggal_pengajuan_berkas = date('Y-m-d', strtotime($this->request->getData(['tanggal_pengajuan_berkas']), true));
                $ktp->tanggal_pengambilan_berkas = date('Y-m-d', strtotime($this->request->getData(['tanggal_pengambilan_berkas']), true));
            }
            if ($this->KtpSubmissions->save($ktp)) {
                $this->Flash->success(__('Pengajuan KTP berhasil di update.'));

                return $this->redirect(['action' => 'ktp']);
            }
            $this->Flash->error(__('Pengajuan KTP gagal disimpan, silahkan coba lagi.'));
        }

        if($ktp->submission_status_id == 1){
            $submissionStatuses = $this->SubmissionStatuses->find('list', [
                'conditions' => ['id IN' => [2, 5]]
            ]);
        }else if($ktp->submission_status_id == 2){
            $submissionStatuses = $this->SubmissionStatuses->find('list', [
                'conditions' => ['id' => 3]
            ]);
        }else if($ktp->submission_status_id == 3){
            $submissionStatuses = $this->SubmissionStatuses->find('list', [
                'conditions' => ['id' => 4]
            ]);
        }
        $this->set(compact('ktp', 'submissionStatuses', 'ktp_requirements'));
    }

    public function process_ktp(){

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
            $status = $this->request->getData('status');
            $ids = $this->request->getData('ids');
            $note = $this->request->getData('note');

            switch ($status){
                case '2':
                    /* success */
                    foreach($ids as $vals){
                        /* update status */
                        $ktp =  $this->KtpSubmissions->get($vals);
                        $ktp->submission_status_id = '2';
                        $ktp->note = $note;

                        //$customer = $this->Customers->get($withdrawal->customer_id);
//                        if($this->Withdrawals->save($withdrawal)){
//                            $this->Mailer->setVar([
//                                'name' => $customer->get('username'),
//                                'message' => 'Dear '.$customer->get('username').', Permintaan penarikan dana telah di proses.<br>Jumlah : Rp. '.$withdrawal->amount.' <br>Fee Admin : Rp. '.$withdrawal->fee.' <br> Bank : '.$withdrawal->bank_name.' <br> Nomor Rekening : '.$withdrawal->bank_account_number
//                            ])->send($customer->get('id'), 'Withdrawal Notification','notification');
//                        }
                    }

                    break;

                case '3':
                    /* Failed */
                    foreach($ids as $vals){
                        /* update status */
                        $ktp =  $this->KtpSubmissions->get($vals);

                        if($ktp->submission_status_id = '1'){
                            $ktp->submission_status_id = '3';
                            $ktp->note = $note;

                            $this->KtpSubmissions->getConnection()->begin();
                            if($this->KtpSubmissions->save($ktp)){
                                $this->KtpSubmissions->getConnection()->commit();
                            }
                        }
                    }

                    break;
            }

            $result = ['ok'];
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
    }

    public function kk()
    {

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');
            $status = $this->request->getData('status');

            $type = [
                'tertunda' => 'Tertunda',
                'diterima' => 'Diterima',
                'proses' => 'Proses',
                'selesai' => 'Selesai',
                'ditolak' => 'Ditolak'
            ];
            $status = $type[$status];

            /** custom default query : select, where, contain, etc. **/
            $data = $this->KkSubmissions->find('all')
                ->select();
            $data->contain(['SubmissionStatuses', 'Classifications']);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' => [
                        'KkSubmissions.name LIKE' => '%' . $search .'%',
                        'KkSubmissions.no_kk LIKE' => '%' . $search .'%',
                        'KkSubmissions.applicant LIKE' => '%' . $search .'%',
                        'Classifications.name LIKE' => '%' . $search .'%',
                    ]]);
                }
                $data->where($query);
            }

            /*
            if (isset($query['submission_status_id'])) {
                $submission_status_id = $query['submission_status_id'];
                $data->where(['KtpSubmissions.submission_status_id' => $submission_status_id]);
            }
            */

            if (isset($status)) {
                $data->where(['SubmissionStatuses.name' => ucfirst($status)]);
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


        $statusTypes = $this->KkSubmissions->SubmissionStatuses->find('list')->toArray();
        $this->set(compact('statusTypes'));
    }

    public function updateKk($id = null)
    {
        $kk = $this->KkSubmissions->get($id, [
            'contain' => [
                'Customers',
                'SubmissionStatuses',
                'Classifications'
            ]
        ]);
        $kk_requirements = $this->KkRequirements->find('all')
            ->where(['KkRequirements.kk_submission_id' => $kk->id])
            ->contain(['Images'])
            ->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $kk = $this->KkSubmissions->patchEntity($kk, $this->request->getData(), ['associated'=>['Customers', 'SubmissionStatuses', 'Classifications']]);
            if(!empty($this->request->getData(['tanggal_pengambilan_berkas'])) && !empty($this->request->getData(['tanggal_pengajuan_berkas']))){
                $kk->tanggal_pengajuan_berkas = date('Y-m-d', strtotime($this->request->getData(['tanggal_pengajuan_berkas']), true));
                $kk->tanggal_pengambilan_berkas = date('Y-m-d', strtotime($this->request->getData(['tanggal_pengambilan_berkas']), true));
            }
            if ($this->KkSubmissions->save($kk)) {
                $this->Flash->success(__('Pengajuan KK berhasil di update.'));

                return $this->redirect(['action' => 'kk']);
            }
            $this->Flash->error(__('Pengajuan KK gagal disimpan, silahkan coba lagi.'));
        }

        if($kk->submission_status_id == 1){
            $submissionStatuses = $this->SubmissionStatuses->find('list', [
                'conditions' => ['id IN' => [2, 5]]
            ]);
        }else if($kk->submission_status_id == 2){
            $submissionStatuses = $this->SubmissionStatuses->find('list', [
                'conditions' => ['id' => 3]
            ]);
        }else if($kk->submission_status_id == 3){
            $submissionStatuses = $this->SubmissionStatuses->find('list', [
                'conditions' => ['id' => 4]
            ]);
        }
        $this->set(compact('kk', 'submissionStatuses', 'kk_requirements'));
    }

    public function process_kk(){

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
            $status = $this->request->getData('status');
            $ids = $this->request->getData('ids');
            $note = $this->request->getData('note');

            switch ($status){
                case '2':
                    /* success */
                    foreach($ids as $vals){
                        /* update status */
                        $kk =  $this->KkSubmissions->get($vals);
                        $kk->submission_status_id = '2';
                        $kk->note = $note;

                        //$customer = $this->Customers->get($withdrawal->customer_id);
//                        if($this->Withdrawals->save($withdrawal)){
//                            $this->Mailer->setVar([
//                                'name' => $customer->get('username'),
//                                'message' => 'Dear '.$customer->get('username').', Permintaan penarikan dana telah di proses.<br>Jumlah : Rp. '.$withdrawal->amount.' <br>Fee Admin : Rp. '.$withdrawal->fee.' <br> Bank : '.$withdrawal->bank_name.' <br> Nomor Rekening : '.$withdrawal->bank_account_number
//                            ])->send($customer->get('id'), 'Withdrawal Notification','notification');
//                        }
                    }

                    break;

                case '3':
                    /* Failed */
                    foreach($ids as $vals){
                        /* update status */
                        $kk =  $this->KkSubmissions->get($vals);

                        if($kk->submission_status_id = '1'){
                            $kk->submission_status_id = '3';
                            $kk->note = $note;

                            $this->KkSubmissions->getConnection()->begin();
                            if($this->KkSubmissions->save($kk)){
                                $this->KkSubmissions->getConnection()->commit();
                            }
                        }
                    }

                    break;
            }

            $result = ['ok'];
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
    }

    public function kia()
    {

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');
            $status = $this->request->getData('status');

            $type = [
                'tertunda' => 'Tertunda',
                'diterima' => 'Diterima',
                'proses' => 'Proses',
                'selesai' => 'Selesai',
                'ditolak' => 'Ditolak'
            ];
            $status = $type[$status];

            /** custom default query : select, where, contain, etc. **/
            $data = $this->KiaSubmissions->find('all')
                ->select();
            $data->contain(['SubmissionStatuses', 'Classifications']);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' => [
                        'KiaSubmissions.name LIKE' => '%' . $search .'%',
                        'KiaSubmissions.nik LIKE' => '%' . $search .'%',
                        'KiaSubmissions.applicant LIKE' => '%' . $search .'%',
                        'Classifications.name LIKE' => '%' . $search .'%',
                    ]]);
                }
                $data->where($query);
            }

            /*
            if (isset($query['submission_status_id'])) {
                $submission_status_id = $query['submission_status_id'];
                $data->where(['KtpSubmissions.submission_status_id' => $submission_status_id]);
            }
            */

            if (isset($status)) {
                $data->where(['SubmissionStatuses.name' => ucfirst($status)]);
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


        $statusTypes = $this->KiaSubmissions->SubmissionStatuses->find('list')->toArray();
        $this->set(compact('statusTypes'));
    }

    public function updateKia($id = null)
    {
        $kia = $this->KiaSubmissions->get($id, [
            'contain' => [
                'Customers',
                'SubmissionStatuses',
                'Classifications'
            ]
        ]);
        $kia_requirements = $this->KiaRequirements->find('all')
            ->where(['KiaRequirements.kia_submission_id' => $kia->id])
            ->contain(['Images'])
            ->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $kia = $this->KiaSubmissions->patchEntity($kia, $this->request->getData(), ['associated'=>['Customers', 'SubmissionStatuses', 'Classifications']]);
            if(!empty($this->request->getData(['tanggal_pengambilan_berkas'])) && !empty($this->request->getData(['tanggal_pengajuan_berkas']))){
                $kia->tanggal_pengajuan_berkas = date('Y-m-d', strtotime($this->request->getData(['tanggal_pengajuan_berkas']), true));
                $kia->tanggal_pengambilan_berkas = date('Y-m-d', strtotime($this->request->getData(['tanggal_pengambilan_berkas']), true));
            }
            if ($this->KiaSubmissions->save($kia)) {
                $this->Flash->success(__('Pengajuan KIA berhasil di update.'));

                return $this->redirect(['action' => 'kia']);
            }
            $this->Flash->error(__('Pengajuan KIA gagal disimpan, silahkan coba lagi.'));
        }

        if($kia->submission_status_id == 1){
            $submissionStatuses = $this->SubmissionStatuses->find('list', [
                'conditions' => ['id IN' => [2, 5]]
            ]);
        }else if($kia->submission_status_id == 2){
            $submissionStatuses = $this->SubmissionStatuses->find('list', [
                'conditions' => ['id' => 3]
            ]);
        }else if($kia->submission_status_id == 3){
            $submissionStatuses = $this->SubmissionStatuses->find('list', [
                'conditions' => ['id' => 4]
            ]);
        }
        $this->set(compact('kia', 'submissionStatuses', 'kia_requirements'));
    }

    public function process_kia(){

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
            $status = $this->request->getData('status');
            $ids = $this->request->getData('ids');
            $note = $this->request->getData('note');

            switch ($status){
                case '2':
                    /* success */
                    foreach($ids as $vals){
                        /* update status */
                        $kia =  $this->KiaSubmissions->get($vals);
                        $kia->submission_status_id = '2';
                        $kia->note = $note;

                        //$customer = $this->Customers->get($withdrawal->customer_id);
//                        if($this->Withdrawals->save($withdrawal)){
//                            $this->Mailer->setVar([
//                                'name' => $customer->get('username'),
//                                'message' => 'Dear '.$customer->get('username').', Permintaan penarikan dana telah di proses.<br>Jumlah : Rp. '.$withdrawal->amount.' <br>Fee Admin : Rp. '.$withdrawal->fee.' <br> Bank : '.$withdrawal->bank_name.' <br> Nomor Rekening : '.$withdrawal->bank_account_number
//                            ])->send($customer->get('id'), 'Withdrawal Notification','notification');
//                        }
                    }

                    break;

                case '3':
                    /* Failed */
                    foreach($ids as $vals){
                        /* update status */
                        $kia =  $this->KiaSubmissions->get($vals);

                        if($kia->submission_status_id = '1'){
                            $kia->submission_status_id = '3';
                            $kia->note = $note;

                            $this->KiaSubmissions->getConnection()->begin();
                            if($this->KiaSubmissions->save($kia)){
                                $this->KiaSubmissions->getConnection()->commit();
                            }
                        }
                    }

                    break;
            }

            $result = ['ok'];
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
    }

    public function pindahAlamat()
    {

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');
            $status = $this->request->getData('status');

            $type = [
                'tertunda' => 'Tertunda',
                'diterima' => 'Diterima',
                'proses' => 'Proses',
                'selesai' => 'Selesai',
                'ditolak' => 'Ditolak'
            ];
            $status = $type[$status];

            /** custom default query : select, where, contain, etc. **/
            $data = $this->AddressSubmissions->find('all')
                ->select();
            $data->contain(['SubmissionStatuses', 'Classifications']);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' => [
                        'AddressSubmissions.name LIKE' => '%' . $search .'%',
                        'AddressSubmissions.nik LIKE' => '%' . $search .'%',
                        'Classifications.name LIKE' => '%' . $search .'%',
                    ]]);
                }
                $data->where($query);
            }

            /*
            if (isset($query['submission_status_id'])) {
                $submission_status_id = $query['submission_status_id'];
                $data->where(['KtpSubmissions.submission_status_id' => $submission_status_id]);
            }
            */

            if (isset($status)) {
                $data->where(['SubmissionStatuses.name' => ucfirst($status)]);
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


        $statusTypes = $this->AddressSubmissions->SubmissionStatuses->find('list')->toArray();
        $this->set(compact('statusTypes'));
    }

    public function updateAlamat($id = null)
    {
        $pindah_alamat = $this->AddressSubmissions->get($id, [
            'contain' => [
                'Customers',
                'SubmissionStatuses',
                'Classifications'
            ]
        ]);
        $address_requirements = $this->AddressRequirements->find('all')
            ->where(['AddressRequirements.address_submission_id' => $pindah_alamat->id])
            ->contain(['Images'])
            ->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $pindah_alamat = $this->AddressSubmissions->patchEntity($pindah_alamat, $this->request->getData(), ['associated'=>['Customers', 'SubmissionStatuses', 'Classifications']]);
            if(!empty($this->request->getData(['tanggal_pengambilan_berkas'])) && !empty($this->request->getData(['tanggal_pengajuan_berkas']))){
                $pindah_alamat->tanggal_pengajuan_berkas = date('Y-m-d', strtotime($this->request->getData(['tanggal_pengajuan_berkas']), true));
                $pindah_alamat->tanggal_pengambilan_berkas = date('Y-m-d', strtotime($this->request->getData(['tanggal_pengambilan_berkas']), true));
            }
            if ($this->AddressSubmissions->save($pindah_alamat)) {
                $this->Flash->success(__('Pengajuan Pindah Alamat berhasil di update.'));

                return $this->redirect(['action' => 'pindahAlamat']);
            }
            $this->Flash->error(__('Pengajuan Pindah Alamat gagal disimpan, silahkan coba lagi.'));
        }

        if($pindah_alamat->submission_status_id == 1){
            $submissionStatuses = $this->SubmissionStatuses->find('list', [
                'conditions' => ['id IN' => [2, 5]]
            ]);
        }else if($pindah_alamat->submission_status_id == 2){
            $submissionStatuses = $this->SubmissionStatuses->find('list', [
                'conditions' => ['id' => 3]
            ]);
        }else if($pindah_alamat->submission_status_id == 3){
            $submissionStatuses = $this->SubmissionStatuses->find('list', [
                'conditions' => ['id' => 4]
            ]);
        }
        $this->set(compact('pindah_alamat', 'submissionStatuses', 'address_requirements'));
    }
}
