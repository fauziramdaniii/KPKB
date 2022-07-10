<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use Cake\Auth\Storage\StorageInterface;
use Cake\Core\Configure;
use Composer\Package\Archiver\ZipArchiver;
//use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;
use ZipArchive;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipStream\Option\Archive;
use ZipStream\ZipStream;
use Cake\Filesystem\File;

/**
 * Tournaments Controller
 *
 * @property \AdminPanel\Model\Table\GamesTable $Games
 * @property \AdminPanel\Model\Table\FfParticipantsTable $FfParticipants
 * @property \AdminPanel\Model\Table\MlParticipantsTable $MlParticipants
 * @property \AdminPanel\Model\Table\PesParticipantsTable $PesParticipants
 * @property \AdminPanel\Model\Table\PubgParticipantsTable $PubgParticipants
 * @property \AdminPanel\Model\Table\ValorantParticipantsTable $ValorantParticipants
 * @property \AdminPanel\Model\Table\LiveBagansTable $LiveBagans
 * @property \AdminPanel\Model\Table\MatchSchedulesTable $MatchSchedules
 * @property \AdminPanel\Model\Table\MatchStatusesTable $MatchStatuses
 * @property \AdminPanel\Model\Table\ImagesTable $Images
 * @property \AdminPanel\Model\Table\EmailSendsTable $EmailSends
 * @property \AdminPanel\Controller\Component\MailerComponent $Mailer
 *
 * @method \AdminPanel\Model\Entity\Tournament[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TournamentsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Games');
        $this->loadModel('AdminPanel.FfParticipants');
        $this->loadModel('AdminPanel.MlParticipants');
        $this->loadModel('AdminPanel.PesParticipants');
        $this->loadModel('AdminPanel.PubgParticipants');
        $this->loadModel('AdminPanel.ValorantParticipants');
        $this->loadModel('AdminPanel.LiveBagans');
        $this->loadModel('AdminPanel.MatchSchedules');
        $this->loadModel('AdminPanel.MatchStatuses');
        $this->loadModel('AdminPanel.Images');
        $this->loadModel('AdminPanel.EmailSends');
        $this->loadComponent('AdminPanel.Mailer');
    }

    public function pes()
    {


        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->PesParticipants->find('all')
                ->select();
            $data->contain(['Games']);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' =>
                        [
                            'PesParticipants.name LIKE' => '%' . $search .'%',
                            'PesParticipants.phone LIKE' => '%' . $search .'%',
                            'PesParticipants.email LIKE' => '%' . $search .'%',
                            'PesParticipants.ktp LIKE' => '%' . $search .'%'
                        ]
                    ]);
                }
//                if (isset($query['transaction_type_id'])) {
//                    $transaction_type_id = $query['transaction_type_id'];
//                    $data->where(['Transactions.transaction_type_id' => $transaction_type_id]);
//                }
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


//        $transactionsTypes = $this->TransactionMutations->Transactions->TransactionTypes->find('list');
//        $this->set(compact('transactionMutations','transactionsTypes'));
    }

    public function pesEmail()
    {
        $this->autoRender = false;
        $pes = $this->PesParticipants->find('all')
            ->where([
                'PesParticipants.status' => 3,
            ])
            ->where(function($exp) {
                return $exp->between('PesParticipants.id', '170', '200');
            })
            ->select()
            ->toArray();

        foreach ($pes as $val){
            debug($val->name);

            //BERHASIL
            $this->Mailer->setVar([
                'name' => $val->name,
                'message' => 'Verifikasi Data Telah dilakukan. Data KTP dan Bukti Vaksin ke - 2 telah valid. Silahkan untuk bergabung dengan channel discord PILGUB JABAR 2022 - PES21 untuk informasi mengenai pertandingan : <br /> <b> <a href="https://discord.gg/DeXsWrQF">DISCORD PILGUB JABAR 2022 - PES21</a> </b>'
            ])->send($val->email, 'Verifikasi Data','verification');

            //GAGAL
//            $this->Mailer->setVar([
//                'name' => $val->name,
//                'message' => 'Mohon maaf dikarenakan yang bersangkutan tidak mengirim ulang kekurangan persyaratan yang telah ditentukan dalam 1x24 jam. Maka yang bersangkutan dianggap mengundurkan diri dari keikutsertaan dalam lomba PILGUB JABAR cabor PES2021.'
//            ])->send($val->email, 'Verifikasi Data','verification');

            $email = $this->EmailSends->newEntity();
            $email = $this->EmailSends->patchEntity($email, $this->request->getData());
            $email->name = $val->name;
            $email->email = $val->email;
            $email->status = 1;
            $this->EmailSends->save($email);
        }
    }

    public function detailPes($id = null)
    {
        $pes = $this->PesParticipants->get($id, [
            'contain' => [
                'Games'
            ]
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

        }
        $this->set(compact('pes'));
    }

    public function deletePes($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pes = $this->PesParticipants->get($id);
        try {
            if ($this->PesParticipants->delete($pes)) {
                $this->Flash->success(__('Peserta PES 2021 Berhasil Dihapus.'));
            } else {
                $this->Flash->error(__('Peserta PES 2021 Gagal Dihapus. Silahkan Coba Lagi.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('Peserta PES 2021 Gagal Dihapus. Silahkan Coba Lagi.'));
        }

        return $this->redirect(['action' => 'pes']);
    }

    public function emailPes($id = null)
    {
        $pes = $this->PesParticipants->find()
            ->where(['PesParticipants.id' => $id])
            ->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            if($this->request->getData()){
                if($this->Mailer->setVar([
                    'name' => $this->request->getData(['name']),
                    'message' => $this->request->getData(['message'])
                ])->send($this->request->getData(['email']), $this->request->getData(['subject']),'verification')){
                    $this->Flash->success(__('Email Berhasil Dikirim.'));

                    return $this->redirect(['action' => 'pes']);
                }
                $this->Flash->error(__('Email Gagal dikirim. Silahkan Coba Lagi.'));
            }
            $this->Flash->error(__('Email Gagal dikirim. Silahkan Coba Lagi.'));
        }
        $this->set(compact('pes'));
    }

    public function mobileLegends()
    {


        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->MlParticipants->find('all')
                ->select();
            $data->contain(['Games']);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' =>
                        [
                            'MlParticipants.team_name LIKE' => '%' . $search .'%',
                            'MlParticipants.person_in_charge LIKE' => '%' . $search .'%',
                            'MlParticipants.phone LIKE' => '%' . $search .'%',
                            'MlParticipants.email LIKE' => '%' . $search .'%'
                        ]
                    ]);
                }
//                if (isset($query['transaction_type_id'])) {
//                    $transaction_type_id = $query['transaction_type_id'];
//                    $data->where(['Transactions.transaction_type_id' => $transaction_type_id]);
//                }
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


//        $transactionsTypes = $this->TransactionMutations->Transactions->TransactionTypes->find('list');
//        $this->set(compact('transactionMutations','transactionsTypes'));
    }

    public function detailMl($id = null)
    {
        $mole = $this->MlParticipants->get($id, [
            'contain' => [
                'Games'
            ]
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

        }
        $this->set(compact('mole'));
    }

    public function deleteMl($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mole = $this->MlParticipants->get($id);
        try {
            if ($this->MlParticipants->delete($mole)) {
                $this->Flash->success(__('Peserta Mobile Legends Berhasil Dihapus.'));
            } else {
                $this->Flash->error(__('Peserta Mobile Legends Gagal Dihapus. Silahkan Coba Lagi.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('Peserta Mobile Legends Gagal Dihapus. Silahkan Coba Lagi.'));
        }

        return $this->redirect(['action' => 'mobileLegends']);
    }

    public function mlEmail()
    {
        $this->autoRender = false;
        $ml = $this->MlParticipants->find('all')
            ->where([
                'MlParticipants.status' => 0,
            ])
            ->where(function($exp) {
                return $exp->between('MlParticipants.id', '331', '360');
            })
            ->select()
            ->toArray();

           $this->Mailer->setVar([
               'name' => 'Kingpin',
               'message' => 'Verifikasi Data Telah dilakukan. <b style="color: #00FF00;">Data Anggota Tim dinyatakan VALID.</b> Silahkan untuk bergabung dengan channel discord PILGUB JABAR 2022 - MLBB untuk informasi mengenai pertandingan : <br /> <b> <a href="https://discord.gg/Fr3HAeJm">DISCORD PILGUB JABAR 2022 - MLBB</a> </b>'
           ])->send('scratatu@gmail.com', 'Verifikasi Data','verification');
           exit;

        foreach ($ml as $val){
            debug($val->team_name);

            //EMAIL DC
            $this->Mailer->setVar([
                'name' => $val->team_name,
                'message' => 'Technical Meeting akan Segera dilaksanakan pada tanggal <b> 23 Mei 2022 Pukul 19:00. </b> Silahkan untuk bergabung dengan channel discord PILGUB JABAR 2022 - MLBB untuk informasi mengenai pertandingan : <br /> <b> <a href="https://discord.gg/Fr3HAeJm">DISCORD PILGUB JABAR 2022 - MLBB</a> </b>'
            ])->send($val->email, 'Verifikasi Data','verification');

            //BERHASIL
            // $this->Mailer->setVar([
            //     'name' => $val->team_name,
            //     'message' => 'Verifikasi Data Telah dilakukan. <b style="color: #00FF00;">Data Anggota Tim dinyatakan VALID.</b> Silahkan untuk bergabung dengan channel discord PILGUB JABAR 2022 - MLBB untuk informasi mengenai pertandingan : <br /> <b> <a href="https://discord.gg/Fr3HAeJm">DISCORD PILGUB JABAR 2022 - MLBB</a> </b>'
            // ])->send($val->email, 'Verifikasi Data','verification');

            //GAGAL
//            $this->Mailer->setVar([
//                'name' => $val->team_name,
//                'message' => 'Verifikasi Data Telah dilakukan. <b style="color: #ff0000;">Data Anggota Tim dinyatakan TIDAK VALID, dikarenakan tidak mengisi data anggota tim sesuai dengan form docx yang telah ditentukan.</b> Kirim kekurangan persyaratan pendaftaran ke email : <b> admin@esportpilgubjabar.com </b> dengan subject Email: <b> MLBB - (NAMA TIM ANDA) </b> <br/> <br/> <b style="color: #ff0000;">Kirim Kekurangan persyaratan dalam 1x24 jam, jika tidak mengirimkan maka peserta dianggap mengundurkan diri.</b> <br/> <br/> <b> <a href="https://esportpilgubjabar.com/template-file/Template%20Data%20Tim%20(Mobile%20Legends).docx">DOWNLOAD TEMPLATE FORM PENDAFTARAN</a> </b>'
//            ])->send($val->email, 'Verifikasi Data','verification');

            $email = $this->EmailSends->newEntity();
            $email = $this->EmailSends->patchEntity($email, $this->request->getData());
            $email->name = $val->team_name;
            $email->email = $val->email;
            $email->status = 1;
            $this->EmailSends->save($email);
        }
    }

    public function pubgm()
    {


        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->PubgParticipants->find('all')
                ->select();
            $data->contain(['Games']);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' =>
                        [
                            'PubgParticipants.team_name LIKE' => '%' . $search .'%',
                            'PubgParticipants.person_in_charge LIKE' => '%' . $search .'%',
                            'PubgParticipants.phone LIKE' => '%' . $search .'%',
                            'PubgParticipants.email LIKE' => '%' . $search .'%'
                        ]
                    ]);
                }
//                if (isset($query['transaction_type_id'])) {
//                    $transaction_type_id = $query['transaction_type_id'];
//                    $data->where(['Transactions.transaction_type_id' => $transaction_type_id]);
//                }
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


//        $transactionsTypes = $this->TransactionMutations->Transactions->TransactionTypes->find('list');
//        $this->set(compact('transactionMutations','transactionsTypes'));
    }

    public function detailPubgm($id = null)
    {
        $pubg = $this->PubgParticipants->get($id, [
            'contain' => [
                'Games'
            ]
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

        }
        $this->set(compact('pubg'));
    }

    public function deletePubgm($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pubgm = $this->PubgParticipants->get($id);
        try {
            if ($this->PubgParticipants->delete($pubgm)) {
                $this->Flash->success(__('Peserta PUBG Berhasil Dihapus.'));
            } else {
                $this->Flash->error(__('Peserta PUBG Gagal Dihapus. Silahkan Coba Lagi.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('Peserta PUBG Gagal Dihapus. Silahkan Coba Lagi.'));
        }

        return $this->redirect(['action' => 'pubgm']);
    }

    public function pubgEmail()
    {
        $this->autoRender = false;
        $pubg = $this->PubgParticipants->find('all')
            ->where([
                'PubgParticipants.status' => 0,
            ])
            ->where(function($exp) {
                return $exp->between('PubgParticipants.id', '161', '190');
            })
            ->select()
            ->toArray();

//            $this->Mailer->setVar([
//                'name' => 'dev2',
//                'message' => 'Verifikasi Data Telah dilakukan. <b style="color: #00FF00;">Data Anggota Tim dinyatakan VALID.</b> Silahkan untuk bergabung dengan channel discord PILGUB JABAR 2022 - PUBG MOBILE untuk informasi mengenai pertandingan : <br /> <b> <a href="https://discord.gg/yRk3zz9v3P">DISCORD PILGUB JABAR 2022 - PUBG MOBILE</a> </b>'
//            ])->send('dimaskurniawan2290@gmail.com', 'Verifikasi Data','verification');
//            exit;

        foreach ($pubg as $val){
            debug($val->team_name);

            //EMAIL DC
            $this->Mailer->setVar([
                'name' => $val->team_name,
                'message' => 'Technical Meeting akan Segera dilaksanakan pada tanggal <b> 23 Mei 2022 Pukul 19:00. </b> Silahkan untuk bergabung dengan channel discord PILGUB JABAR 2022 - PUBG MOBILE untuk informasi mengenai pertandingan : <br /> <b> <a href="https://discord.gg/yRk3zz9v3P">DISCORD PILGUB JABAR 2022 - PUBG MOBILE</a> </b>'
            ])->send($val->email, 'Verifikasi Data','verification');

            //BERHASIL
            // $this->Mailer->setVar([
            //     'name' => $val->team_name,
            //     'message' => 'Verifikasi Data Telah dilakukan. <b style="color: #00FF00;">Data Anggota Tim dinyatakan VALID.</b> Silahkan untuk bergabung dengan channel discord PILGUB JABAR 2022 - PUBG MOBILE untuk informasi mengenai pertandingan : <br /> <b> <a href="https://discord.gg/yRk3zz9v3P">DISCORD PILGUB JABAR 2022 - PUBG MOBILE</a> </b>'
            // ])->send($val->email, 'Verifikasi Data','verification');

            //GAGAL
//            $this->Mailer->setVar([
//                'name' => $val->team_name,
//                'message' => 'Verifikasi Data Telah dilakukan. <b style="color: #ff0000;">Data Anggota Tim dinyatakan TIDAK VALID, dikarenakan tidak mengisi data anggota tim sesuai dengan form docx yang telah ditentukan.</b> Kirim kekurangan persyaratan pendaftaran ke email : <b> cs2@esportpilgubjabar.com </b> dengan subject Email: <b> PUBG - (NAMA TIM ANDA) </b> <br/> <br/> <b style="color: #ff0000;">Kirim Kekurangan persyaratan dalam 1x24 jam, jika tidak mengirimkan maka peserta dianggap mengundurkan diri.</b> <br/> <br/> <b> <a href="https://esportpilgubjabar.com/template-file/Template%20Data%20Tim%20(PUBG%20Mobile).docx">DOWNLOAD TEMPLATE FORM PENDAFTARAN</a> </b>'
//            ])->send($val->email, 'Verifikasi Data','verification');

            $email = $this->EmailSends->newEntity();
            $email = $this->EmailSends->patchEntity($email, $this->request->getData());
            $email->name = $val->team_name;
            $email->email = $val->email;
            $email->status = 1;
            $this->EmailSends->save($email);
        }
    }

    public function freeFire()
    {


        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->FfParticipants->find('all')
                ->select();
            $data->contain(['Games']);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' =>
                        [
                            'FfParticipants.team_name LIKE' => '%' . $search .'%',
                            'FfParticipants.person_in_charge LIKE' => '%' . $search .'%',
                            'FfParticipants.phone LIKE' => '%' . $search .'%',
                            'FfParticipants.email LIKE' => '%' . $search .'%'
                        ]
                    ]);
                }
//                if (isset($query['transaction_type_id'])) {
//                    $transaction_type_id = $query['transaction_type_id'];
//                    $data->where(['Transactions.transaction_type_id' => $transaction_type_id]);
//                }
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


//        $transactionsTypes = $this->TransactionMutations->Transactions->TransactionTypes->find('list');
//        $this->set(compact('transactionMutations','transactionsTypes'));
    }

    public function detailFf($id = null)
    {
        $ff = $this->FfParticipants->get($id, [
            'contain' => [
                'Games'
            ]
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

        }
        $this->set(compact('ff'));
    }

    public function deleteFf($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ff = $this->FfParticipants->get($id);
        try {
            if ($this->FfParticipants->delete($ff)) {
                $this->Flash->success(__('Peserta Free Fire Berhasil Dihapus.'));
            } else {
                $this->Flash->error(__('Peserta Free Fire Gagal Dihapus. Silahkan Coba Lagi.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('Peserta Free Fire Gagal Dihapus. Silahkan Coba Lagi.'));
        }

        return $this->redirect(['action' => 'freeFire']);
    }

    public function ffEmail()
    {
        $this->autoRender = false;
        $ff = $this->FfParticipants->find('all')
            ->where([
                'FfParticipants.status' => 0,
            ])
            ->where(function($exp) {
                return $exp->between('FfParticipants.id', '211', '240');
            })
            ->select()
            ->toArray();

           $this->Mailer->setVar([
               'name' => 'CN Fierce',
               'message' => 'Technical Meeting akan Segera dilaksanakan pada tanggal <b> 23 Mei 2022 Pukul 19:00. </b> Silahkan untuk bergabung dengan channel discord PILGUB JABAR 2022 - FREE FIRE untuk informasi mengenai pertandingan : <br /> <b> <a href="https://discord.gg/HjhBegrq">DISCORD PILGUB JABAR 2022 - FREE FIRE</a> </b>'
           ])->send('mishbah2004@gmail.com', 'Verifikasi Data','verification');
           exit;

        foreach ($ff as $val){
            debug($val->team_name);

            //EMAIL DC
            $this->Mailer->setVar([
                'name' => $val->team_name,
                'message' => 'Technical Meeting akan Segera dilaksanakan pada tanggal <b> 23 Mei 2022 Pukul 19:00. </b> Silahkan untuk bergabung dengan channel discord PILGUB JABAR 2022 - FREE FIRE untuk informasi mengenai pertandingan : <br /> <b> <a href="https://discord.gg/HjhBegrq">DISCORD PILGUB JABAR 2022 - FREE FIRE</a> </b>'
            ])->send($val->email, 'Verifikasi Data','verification');

            //BERHASIL
//            $this->Mailer->setVar([
//                'name' => $val->team_name,
//                'message' => 'Verifikasi Data Telah dilakukan. <b style="color: #00FF00;">Data Anggota Tim dinyatakan VALID.</b> Silahkan untuk bergabung dengan channel discord PILGUB JABAR 2022 - FREE FIRE untuk informasi mengenai pertandingan : <br /> <b> <a href="https://discord.gg/HjhBegrq">DISCORD PILGUB JABAR 2022 - FREE FIRE</a> </b>'
//            ])->send($val->email, 'Verifikasi Data','verification');

            //GAGAL
//            $this->Mailer->setVar([
//                'name' => $val->team_name,
//                'message' => 'Verifikasi Data Telah dilakukan. <b style="color: #ff0000;">Data Anggota Tim dinyatakan TIDAK VALID, dikarenakan tidak mengisi data anggota tim sesuai dengan form docx yang telah ditentukan.</b> Kirim kekurangan persyaratan pendaftaran ke email : <b> cs@esportpilgubjabar.com </b> dengan subject Email: <b> Free Fire - (NAMA TIM ANDA) </b> <br/> <br/> <b style="color: #ff0000;">Kirim Kekurangan persyaratan dalam 1x24 jam, jika tidak mengirimkan maka peserta dianggap mengundurkan diri.</b> <br/> <br/> <b> <a href="https://esportpilgubjabar.com/template-file/Template%20Data%20Tim%20(Free%20Fire).docx">DOWNLOAD TEMPLATE FORM PENDAFTARAN</a> </b>'
//            ])->send($val->email, 'Verifikasi Data','verification');

            $email = $this->EmailSends->newEntity();
            $email = $this->EmailSends->patchEntity($email, $this->request->getData());
            $email->name = $val->team_name;
            $email->email = $val->email;
            $email->status = 1;
            $this->EmailSends->save($email);
        }
    }

    public function valorant()
    {


        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->ValorantParticipants->find('all')
                ->select();
            $data->contain(['Games']);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' =>
                        [
                            'ValorantParticipants.team_name LIKE' => '%' . $search .'%',
                            'ValorantParticipants.person_in_charge LIKE' => '%' . $search .'%',
                            'ValorantParticipants.phone LIKE' => '%' . $search .'%',
                            'ValorantParticipants.email LIKE' => '%' . $search .'%'
                        ]
                    ]);
                }
//                if (isset($query['transaction_type_id'])) {
//                    $transaction_type_id = $query['transaction_type_id'];
//                    $data->where(['Transactions.transaction_type_id' => $transaction_type_id]);
//                }
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


//        $transactionsTypes = $this->TransactionMutations->Transactions->TransactionTypes->find('list');
//        $this->set(compact('transactionMutations','transactionsTypes'));
    }

    public function detailValorant($id = null)
    {
        $valorant = $this->ValorantParticipants->get($id, [
            'contain' => [
                'Games'
            ]
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

        }
        $this->set(compact('valorant'));
    }

    public function deleteValorant($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $valorant = $this->ValorantParticipants->get($id);
        try {
            if ($this->ValorantParticipants->delete($valorant)) {
                $this->Flash->success(__('Peserta Valorant Berhasil Dihapus.'));
            } else {
                $this->Flash->error(__('Peserta Valorant Gagal Dihapus. Silahkan Coba Lagi.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('Peserta Valorant Gagal Dihapus. Silahkan Coba Lagi.'));
        }

        return $this->redirect(['action' => 'valorant']);
    }

    public function valorantEmail()
    {
        $this->autoRender = false;
        $valorant = $this->ValorantParticipants->find('all')
            ->where([
                'ValorantParticipants.status' => 3,
            ])
            ->where(function($exp) {
                return $exp->between('ValorantParticipants.id', '1', '20');
            })
            ->select()
            ->toArray();

            $this->Mailer->setVar([
                'name' => 'Tel-U Cloud Bread',
                'message' => 'Verifikasi Data Telah dilakukan. <b style="color: #00FF00;">Data Anggota Tim dinyatakan VALID.</b> Silahkan untuk bergabung dengan channel discord PILGUB JABAR 2022 - VALORANT untuk informasi mengenai pertandingan : <br /> <b> <a href="https://discord.gg/WzSD38HZfc">DISCORD PILGUB JABAR 2022 - VALORANT</a> </b>'
            ])->send('aldwinlm04@gmail.com', 'Verifikasi Data','verification');
            exit;

        foreach ($valorant as $val){
            debug($val->team_name);

            //BERHASIL
            $this->Mailer->setVar([
                'name' => $val->team_name,
                'message' => 'Verifikasi Data Telah dilakukan. <b style="color: #00FF00;">Data Anggota Tim dinyatakan VALID.</b> Silahkan untuk bergabung dengan channel discord PILGUB JABAR 2022 - VALORANT untuk informasi mengenai pertandingan : <br /> <b> <a href="https://discord.gg/WzSD38HZfc">DISCORD PILGUB JABAR 2022 - VALORANT</a> </b>'
            ])->send($val->email, 'Verifikasi Data','verification');

            //GAGAL
//            $this->Mailer->setVar([
//                'name' => $val->team_name,
//                'message' => 'Verifikasi Data Telah dilakukan. <b style="color: #ff0000;">Data Anggota Tim dinyatakan TIDAK VALID, dikarenakan tidak mengisi data anggota tim sesuai dengan form docx yang telah ditentukan.</b> Kirim kekurangan persyaratan pendaftaran ke email : <b> cs2@esportpilgubjabar.com </b> dengan subject Email: <b> Valorant - (NAMA TIM ANDA) </b> <br/> <br/> <b style="color: #ff0000;">Kirim Kekurangan persyaratan dalam 1x24 jam, jika tidak mengirimkan maka peserta dianggap mengundurkan diri.</b> <br/> <br/> <b> <a href="https://esportpilgubjabar.com/template-file/Template%20Data%20Tim%20(Valorant).docx">DOWNLOAD TEMPLATE FORM PENDAFTARAN</a> </b>'
//            ])->send($val->email, 'Verifikasi Data','verification');

            $email = $this->EmailSends->newEntity();
            $email = $this->EmailSends->patchEntity($email, $this->request->getData());
            $email->name = $val->team_name;
            $email->email = $val->email;
            $email->status = 1;
            $this->EmailSends->save($email);
        }
    }

    public function liveBagan()
    {
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->LiveBagans->find('all')
                ->select();
            $data->contain(['Games']);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' =>
                        [
                            'LiveBagans.name LIKE' => '%' . $search .'%'
                        ]
                    ]);
                }
//                if (isset($query['transaction_type_id'])) {
//                    $transaction_type_id = $query['transaction_type_id'];
//                    $data->where(['Transactions.transaction_type_id' => $transaction_type_id]);
//                }
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


//        $transactionsTypes = $this->TransactionMutations->Transactions->TransactionTypes->find('list');
//        $this->set(compact('transactionMutations','transactionsTypes'));
    }

    public function addBagan()
    {
        $bagan = $this->LiveBagans->newEntity();
        if ($this->request->is('post')) {
            $bagan = $this->LiveBagans->patchEntity($bagan, $this->request->getData());
            if ($this->LiveBagans->save($bagan)) {
                $this->Flash->success(__('Live Bagan berhasil ditambahkan.'));

                return $this->redirect(['action' => 'liveBagan']);
            }
            $this->Flash->error(__('Live Bagan gagal ditambahkan. Silahkan coba lagi.'));
        }
        $games = $this->Games->find('list', ['limit' => 200]);
        $this->set(compact('bagan', 'games'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Faq id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editBagan($id = null)
    {
        $bagan = $this->LiveBagans->find()
            ->where(['LiveBagans.id' => $id])
            ->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bagan = $this->LiveBagans->patchEntity($bagan, $this->request->getData());
            if ($this->LiveBagans->save($bagan)) {
                $this->Flash->success(__('Live Bagan Berhasil disimpan.'));

                return $this->redirect(['action' => 'liveBagan']);
            }
            $this->Flash->error(__('Live Bagan Gagal disimpan. Silahkan Coba Lagi.'));
        }
        $games = $this->Games->find('list', ['limit' => 200]);
        $this->set(compact('bagan', 'games'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Faq id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteBagan($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bagan = $this->LiveBagans->get($id);
        try {
            if ($this->LiveBagans->delete($bagan)) {
                $this->Flash->success(__('Live Bagan Berhasil Dihapus.'));
            } else {
                $this->Flash->error(__('Live Bagan Gagal Dihapus. Silahkan Coba Lagi.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('Live Bagan Gagal Dihapus. Silahkan Coba Lagi.'));
        }

        return $this->redirect(['action' => 'liveBagan']);
    }

    public function games()
    {
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Games->find('all')
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' =>
                        [
                            'Games.name LIKE' => '%' . $search .'%'
                        ]
                    ]);
                }
//                if (isset($query['transaction_type_id'])) {
//                    $transaction_type_id = $query['transaction_type_id'];
//                    $data->where(['Transactions.transaction_type_id' => $transaction_type_id]);
//                }
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


//        $transactionsTypes = $this->TransactionMutations->Transactions->TransactionTypes->find('list');
//        $this->set(compact('transactionMutations','transactionsTypes'));
    }

    public function schedules($id = null)
    {
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->MatchSchedules->find('all')
                ->where(['MatchSchedules.game_id' => $id])
                ->select();
            $data->contain(['Games', 'MatchStatuses']);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' =>
                        [
                            'MatchSchedules.name LIKE' => '%' . $search .'%',
                            'Games.name LIKE' => '%' . $search .'%',
                            'MatchSchedules.match_time LIKE' => '%' . $search .'%'
                        ]
                    ]);
                }
//                if (isset($query['transaction_type_id'])) {
//                    $transaction_type_id = $query['transaction_type_id'];
//                    $data->where(['Transactions.transaction_type_id' => $transaction_type_id]);
//                }
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


        $games_id = $id;
        $this->set(compact('games_id'));
    }

    public function addSchedule($game_id = null)
    {
        $schedule = $this->MatchSchedules->newEntity();
        if ($this->request->is('post')) {
            $schedule = $this->MatchSchedules->patchEntity($schedule, $this->request->getData());
            $schedule->game_id = $game_id;
            $schedule->match_time = date('Y-m-d H:i:s', strtotime($this->request->getData(['match_time']), true));
            if ($this->MatchSchedules->save($schedule)) {
                $this->Flash->success(__('Jadwal pertandingan berhasil ditambahkan.'));

                return $this->redirect(['action' => 'schedules', $game_id]);
            }
            $this->Flash->error(__('Jadwal pertandingan gagal ditambahkan. Silahkan coba lagi.'));
        }
        $game = $this->Games->find()
            ->where(['Games.id' => $game_id])
            ->first();
        $status = $this->MatchStatuses->find('list', ['limit' => 200]);
        $this->set(compact('schedule', 'game', 'status'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Faq id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editSchedule($id = null)
    {
        $schedule = $this->MatchSchedules->find()
            ->where(['MatchSchedules.id' => $id])
            ->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schedule = $this->MatchSchedules->patchEntity($schedule, $this->request->getData());
            $schedule->match_time = date('Y-m-d H:i:s', strtotime($this->request->getData(['match_time']), true));
            if ($this->MatchSchedules->save($schedule)) {
                $this->Flash->success(__('Jadwal pertandingan Berhasil disimpan.'));

                return $this->redirect(['action' => 'schedules', $schedule->game_id]);
            }
            $this->Flash->error(__('Jadwal pertandingan Gagal disimpan. Silahkan Coba Lagi.'));
        }
        $game = $this->Games->find()
            ->where(['Games.id' => $schedule->game_id])
            ->first();
        $status = $this->MatchStatuses->find('list', ['limit' => 200]);
        $this->set(compact('schedule', 'game', 'status'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Faq id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteSchedule($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $schedule = $this->MatchSchedules->get($id);
        try {
            if ($this->MatchSchedules->delete($schedule)) {
                $this->Flash->success(__('Jadwal pertandingan Berhasil Dihapus.'));
            } else {
                $this->Flash->error(__('Jadwal pertandingan Gagal Dihapus. Silahkan Coba Lagi.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('Jadwal pertandingan Gagal Dihapus. Silahkan Coba Lagi.'));
        }

        return $this->redirect(['action' => 'games']);
    }

    public function detailSchedule($id = null)
    {
        $schedule = $this->MatchSchedules->get($id, [
            'contain' => [
                'Games',
                'MatchStatuses'
            ]
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

        }
        $this->set(compact('schedule'));
    }

    public function downloadFile()
    {
        $this->autoRender = false;
        $zipname = 'valorant.zip';
        $zip = new ZipArchive();
        $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $path = realpath("files/ValorantParticipants/document");
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        foreach ($files as $k => $file){
            if(!$file->isDir()){
                $filepath = $file->getRealPath();

                $relativepath = 'valorant/' . substr($filepath, strlen($path) + 1);

                $zip->addFile($filepath, $relativepath);
            }
        }
        $zip->close();

        $pathfile = WWW_ROOT.$zipname;
        $response = $this->response->file($pathfile, array(
            'download' => true,
            'name' => $zipname
        ));
        return $response;
    }

    public function downloadVaksin()
    {
        $this->autoRender = false;
        $zipname = 'PES_bukti_vaksin.zip';
        $zip = new ZipArchive();
        $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $path = realpath("files/PesParticipants/bukti_vaksin");
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        foreach ($files as $k => $file){
            if(!$file->isDir()){
                $filepath = $file->getRealPath();

                $relativepath = 'pes_bukti_vaksin/' . substr($filepath, strlen($path) + 1);

                $zip->addFile($filepath, $relativepath);
            }
        }
        $zip->close();

        $pathfile = WWW_ROOT.$zipname;
        $response = $this->response->file($pathfile, array(
            'download' => true,
            'name' => $zipname
        ));
        return $response;
    }

    public function downloadKtp()
    {
        $this->autoRender = false;
        $zipname = 'PES_ktp.zip';
        $zip = new ZipArchive();
        $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $path = realpath("files/PesParticipants/ktp");
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        foreach ($files as $k => $file){
            if(!$file->isDir()){
                $filepath = $file->getRealPath();

                $relativepath = 'pes_ktp/' . substr($filepath, strlen($path) + 1);

                $zip->addFile($filepath, $relativepath);
            }
        }
        $zip->close();

        $pathfile = WWW_ROOT.$zipname;
        $response = $this->response->file($pathfile, array(
            'download' => true,
            'name' => $zipname
        ));
        return $response;
    }

    public function downloadMole()
    {
        $this->autoRender = false;
        $zipname = 'mobile_legends_document.zip';
        $zip = new ZipArchive();
        $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $path = realpath("files/MlParticipants/document");
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        foreach ($files as $k => $file){
            if(!$file->isDir()){
                $filepath = $file->getRealPath();

                $relativepath = 'mobile_legends_document/' . substr($filepath, strlen($path) + 1);

                $zip->addFile($filepath, $relativepath);
            }
        }
        $zip->close();

        $pathfile = WWW_ROOT.$zipname;
        $response = $this->response->file($pathfile, array(
            'download' => true,
            'name' => $zipname
        ));
        return $response;
    }

    public function downloadPubg()
    {
        $this->autoRender = false;
        $zipname = 'PUBG_document.zip';
        $zip = new ZipArchive();
        $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $path = realpath("files/PubgParticipants/document");
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        foreach ($files as $k => $file){
            if(!$file->isDir()){
                $filepath = $file->getRealPath();

                $relativepath = 'PUBG_document/' . substr($filepath, strlen($path) + 1);

                $zip->addFile($filepath, $relativepath);
            }
        }
        $zip->close();

        $pathfile = WWW_ROOT.$zipname;
        $response = $this->response->file($pathfile, array(
            'download' => true,
            'name' => $zipname
        ));
        return $response;
    }

    public function downloadFreefire()
    {
        $this->autoRender = false;
        $zipname = 'free_fire_document.zip';
        $zip = new ZipArchive();
        $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $path = realpath("files/FfParticipants/document");
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        foreach ($files as $k => $file){
            if(!$file->isDir()){
                $filepath = $file->getRealPath();

                $relativepath = 'free_fire_document/' . substr($filepath, strlen($path) + 1);

                $zip->addFile($filepath, $relativepath);
            }
        }
        $zip->close();

        $pathfile = WWW_ROOT.$zipname;
        $response = $this->response->file($pathfile, array(
            'download' => true,
            'name' => $zipname
        ));
        return $response;
    }

    public function downloadValorant()
    {
        $this->autoRender = false;
        $zipname = 'valorant_document.zip';
        $zip = new ZipArchive();
        $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $path = realpath("files/ValorantParticipants/document");
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        foreach ($files as $k => $file){
            if(!$file->isDir()){
                $filepath = $file->getRealPath();

                $relativepath = 'valorant_document/' . substr($filepath, strlen($path) + 1);

                $zip->addFile($filepath, $relativepath);
            }
        }
        $zip->close();

        $pathfile = WWW_ROOT.$zipname;
        $response = $this->response->file($pathfile, array(
            'download' => true,
            'name' => $zipname
        ));
        return $response;
    }

}
