<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Utility\Text;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 * @property \AdminPanel\Model\Table\GamesTable $Games
 * @property \AdminPanel\Model\Table\FfParticipantsTable $FfParticipants
 * @property \AdminPanel\Model\Table\MlParticipantsTable $MlParticipants
 * @property \AdminPanel\Model\Table\PesParticipantsTable $PesParticipants
 * @property \AdminPanel\Model\Table\PubgParticipantsTable $PubgParticipants
 * @property \AdminPanel\Model\Table\ValorantParticipantsTable $ValorantParticipants
 * @property \AdminPanel\Model\Table\LiveBagansTable $LiveBagans
 * @property \AdminPanel\Model\Table\MatchSchedulesTable $MatchSchedules
 * @property \AdminPanel\Model\Table\ImagesTable $Images
 * @property \AdminPanel\Controller\Component\MailerComponent $Mailer
 */
class RegistrationController extends AppController
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
        $this->loadModel('AdminPanel.Images');
        $this->loadComponent('AdminPanel.Mailer');
    }


    public function pes()
    {
        $this->viewBuilder()->setLayout('pages');

        $pes = $this->PesParticipants->newEntity();
        if ($this->request->is('post')) {
            $total_peserta = $this->PesParticipants->find('all')->count();
//            $total_peserta = 200;
            if($total_peserta <= 199){
                $pes = $this->PesParticipants->patchEntity($pes, $this->request->getData());
                $pes->game_id = 1;
                $pes->participant_status_id = 2;
                if ($this->PesParticipants->save($pes)) {
                    $filename_vaksin = Text::slug($pes->name, '_') . '_vaksin.' . $pes->ext;
                    $filename_ktp = Text::slug($pes->name, '_') . '_ktp.' . $pes->ext;
                    $this->PesParticipants->query()
                        ->update('pes_participants')
                        ->set([
                            'bukti_vaksin' => $filename_vaksin,
                            'ktp' => $filename_ktp
                        ])
                        ->where(['id' => $pes->id])
                        ->execute();

//                    $this->Mailer->setVar([
//                        'name' => $pes->name,
//                        'message' => 'Terima kasih telah mendaftar menjadi peserta Piala Gubernur Esport Jawa Barat Nomor Pertandingan PES 2021, Selanjutnya data akan diverifikasi oleh Admin. Tunggu informasi selanjutnya perihal hasil verifikasi data.'
//                    ])->send($pes->email, 'Notifikasi Pendaftaran','notification');

                    $this->Flash->success_front(__('Pendaftaran Berhasil. Silahkan Tunggu Informasi Selanjutnya.'));
                }else{
                    $this->Flash->error_front(__('Pendaftaran Gagal, Silahkan Coba Lagi.'));
                }
            }else{
                $this->Flash->error_front(__('Kuota Pendaftaran Sudah Penuh.'));
            }

        }

    }

    public function ml()
    {
        $this->viewBuilder()->setLayout('pages');

        $mole = $this->MlParticipants->newEntity();
        if ($this->request->is('post')) {
            $total_peserta = $this->MlParticipants->find('all')->count();
//            $total_peserta = 200;
            if($total_peserta <= 299){
                $mole = $this->MlParticipants->patchEntity($mole, $this->request->getData());
                $mole->game_id = 2;
                $mole->participant_status_id = 2;
                if ($this->MlParticipants->save($mole)) {
                    $filename = Text::slug($mole->team_name, '_') . '.' . $mole->ext;
                    $this->MlParticipants->query()
                        ->update('ml_participants')
                        ->set('document', $filename)
                        ->where(['id' => $mole->id])
                        ->execute();

                    $this->Mailer->setVar([
                        'name' => $mole->team_name,
                        'message' => 'Terima kasih telah mendaftar menjadi peserta Piala Gubernur Esport Jawa Barat Nomor Pertandingan PES 2021, Selanjutnya data akan diverifikasi oleh Admin. Tunggu informasi selanjutnya perihal hasil verifikasi data.'
                    ])->send($mole->email, 'Notifikasi Pendaftaran','notification');

                    $this->Flash->success_front(__('Pendaftaran Berhasil. Silahkan Tunggu Informasi Selanjutnya.'));
                }else{
                    $this->Flash->error_front(__('Pendaftaran Gagal, Silahkan Coba Lagi.'));
                }
            }else{
                $this->Flash->error_front(__('Kuota Pendaftaran Sudah Penuh.'));
            }

        }

    }

    public function ff()
    {
        $this->viewBuilder()->setLayout('pages');

        $ff = $this->FfParticipants->newEntity();
        if ($this->request->is('post')) {
            $total_peserta = $this->FfParticipants->find('all')->count();
//            $total_peserta = 200;
            if($total_peserta <= 299){
                $ff = $this->FfParticipants->patchEntity($ff, $this->request->getData());
                $ff->game_id = 4;
                $ff->participant_status_id = 2;
                if ($this->FfParticipants->save($ff)) {
                    $filename = Text::slug($ff->team_name, '_') . '.' . $ff->ext;
                    $this->FfParticipants->query()
                        ->update('ff_participants')
                        ->set('document', $filename)
                        ->where(['id' => $ff->id])
                        ->execute();
                    $this->Flash->success_front(__('Pendaftaran Berhasil. Silahkan Tunggu Informasi Selanjutnya.'));
                }else{
                    $this->Flash->error_front(__('Pendaftaran Gagal, Silahkan Coba Lagi.'));
                }
            }else{
                $this->Flash->error_front(__('Kuota Pendaftaran Sudah Penuh.'));
            }

        }

    }

    public function pubgm()
    {
        $this->viewBuilder()->setLayout('pages');

        $pubg = $this->PubgParticipants->newEntity();
        if ($this->request->is('post')) {
            $total_peserta = $this->PubgParticipants->find('all')->count();
//            $total_peserta = 200;
            if($total_peserta <= 299){
                $pubg = $this->PubgParticipants->patchEntity($pubg, $this->request->getData());
                $pubg->game_id = 3;
                $pubg->participant_status_id = 2;
                if ($this->PubgParticipants->save($pubg)) {
                    $filename = Text::slug($pubg->team_name, '_') . '.' . $pubg->ext;
                    $this->PubgParticipants->query()
                        ->update('pubg_participants')
                        ->set('document', $filename)
                        ->where(['id' => $pubg->id])
                        ->execute();
                    $this->Flash->success_front(__('Pendaftaran Berhasil. Silahkan Tunggu Informasi Selanjutnya.'));
                }else{
                    $this->Flash->error_front(__('Pendaftaran Gagal, Silahkan Coba Lagi.'));
                }
            }else{
                $this->Flash->error_front(__('Kuota Pendaftaran Sudah Penuh.'));
            }

        }

    }

    public function valorant()
    {
        $this->viewBuilder()->setLayout('pages');

        $valorant = $this->ValorantParticipants->newEntity();
        if ($this->request->is('post')) {
            $total_peserta = $this->ValorantParticipants->find('all')->count();
//            $total_peserta = 200;
            if($total_peserta <= 199){
                $valorant = $this->ValorantParticipants->patchEntity($valorant, $this->request->getData());
                $valorant->game_id = 5;
                $valorant->participant_status_id = 2;
                if ($this->ValorantParticipants->save($valorant)) {
                    $filename = Text::slug($valorant->team_name, '_') . '.' . $valorant->ext;
                    $this->ValorantParticipants->query()
                        ->update('valorant_participants')
                        ->set('document', $filename)
                        ->where(['id' => $valorant->id])
                        ->execute();
                    $this->Flash->success_front(__('Pendaftaran Berhasil. Silahkan Tunggu Informasi Selanjutnya.'));
                }else{
                    $this->Flash->error_front(__('Pendaftaran Gagal, Silahkan Coba Lagi.'));
                }
            }else{
                $this->Flash->error_front(__('Kuota Pendaftaran Sudah Penuh.'));
            }

        }

    }


}
