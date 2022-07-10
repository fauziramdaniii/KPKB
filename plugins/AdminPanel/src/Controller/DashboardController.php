<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use AdminPanel\Plugin;
use Cake\I18n\Time;

/**
 * Dashboard Controller
 *
 * @property
 * @property \AdminPanel\Model\Table\GamesTable $Games
 * @property \AdminPanel\Model\Table\FfParticipantsTable $FfParticipants
 * @property \AdminPanel\Model\Table\MlParticipantsTable $MlParticipants
 * @property \AdminPanel\Model\Table\PesParticipantsTable $PesParticipants
 * @property \AdminPanel\Model\Table\PubgParticipantsTable $PubgParticipants
 * @property \AdminPanel\Model\Table\ValorantParticipantsTable $ValorantParticipants
 * @property \AdminPanel\Model\Table\LiveBagansTable $LiveBagans
 * @property \AdminPanel\Model\Table\MatchSchedulesTable $MatchSchedules
 * @method \AdminPanel\Model\Entity\Dashboard[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardController extends AppController
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
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        $dashboard = null;
        $total_pes = $this->PesParticipants->find()->count();
        $total_valorant = $this->ValorantParticipants->find()->count();
        $total_mole = $this->MlParticipants->find()->count();
        $total_ff = $this->FfParticipants->find()->count();
        $total_pubg = $this->PubgParticipants->find()->count();

        $this->set(compact(
            'dashboard',
            'total_pes',
            'total_valorant',
            'total_mole',
            'total_ff',
            'total_pubg'
        ));

    }


}
