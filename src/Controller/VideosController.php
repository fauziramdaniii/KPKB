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
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 * @property \AdminPanel\Model\Table\VideosTable $Videos
 */
class VideosController extends AppController
{


    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Videos');
    }

    public function index()
    {

        $this->viewBuilder()->setLayout('blank');

        $title = 'Video - Youtube';
        $description = '';

        $videos = $this->Videos->find()
            ->orderDesc('Videos.id');

//        $blogs = $this->paginate($blogs, ['limit' => 3])
//            ->toArray();

        $this->set(compact('videos', 'title', 'description'));
    }

    public function baganValorant()
    {
        $this->viewBuilder()->setLayout('pages');

        $baganvalorant = $this->LiveBagans->find()
            ->where([
                'LiveBagans.game_id' => 5
            ])
            ->contain([
                'Games'
            ])
            ->select()->toArray();

        $this->set(compact('baganvalorant'));
    }

    public function baganMole()
    {
        $this->viewBuilder()->setLayout('pages');

        $baganmole = $this->LiveBagans->find()
            ->where([
                'LiveBagans.game_id' => 2
            ])
            ->contain([
                'Games'
            ])
            ->select()->toArray();

        $this->set(compact('baganmole'));
    }

    public function baganFreefire()
    {
        $this->viewBuilder()->setLayout('pages');

        $baganff = $this->LiveBagans->find()
            ->where([
                'LiveBagans.game_id' => 4
            ])
            ->contain([
                'Games'
            ])
            ->select()->toArray();

        $this->set(compact('baganff'));
    }

    public function baganPubg()
    {
        $this->viewBuilder()->setLayout('pages');

        $baganpubg = $this->LiveBagans->find()
            ->where([
                'LiveBagans.game_id' => 3
            ])
            ->contain([
                'Games'
            ])
            ->select()->toArray();

        $this->set(compact('baganpubg'));
    }

    public function matchRules()
    {
        $this->viewBuilder()->setLayout('pages');

    }

    public function registrationRules()
    {
        $this->viewBuilder()->setLayout('pages');

    }

    public function matchSchedule()
    {
        $this->viewBuilder()->setLayout('pages');

    }

    public function registrationMethod()
    {
        $this->viewBuilder()->setLayout('pages');

    }

    public function schedulePes()
    {
        $this->viewBuilder()->setLayout('pages');

        $pes_schedules = $this->MatchSchedules->find()
            ->contain([
                'MatchStatuses',
                'Games'
            ])
            ->where([
                //'MatchSchedules.match_status_id !=' => 3,
                'MatchSchedules.game_id' => 1
            ])
            ->orderAsc('MatchSchedules.id')->toArray();

        $this->set(compact('pes_schedules'));
    }

    public function scheduleValorant()
    {
        $this->viewBuilder()->setLayout('pages');

        $valorant_schedules = $this->MatchSchedules->find()
            ->contain([
                'MatchStatuses',
                'Games'
            ])
            ->where([
                //'MatchSchedules.match_status_id !=' => 3,
                'MatchSchedules.game_id' => 5
            ])
            ->orderAsc('MatchSchedules.id')->toArray();

        $this->set(compact('valorant_schedules'));
    }

    public function scheduleMole()
    {
        $this->viewBuilder()->setLayout('pages');

        $mole_schedules = $this->MatchSchedules->find()
            ->contain([
                'MatchStatuses',
                'Games'
            ])
            ->where([
                //'MatchSchedules.match_status_id !=' => 3,
                'MatchSchedules.game_id' => 2
            ])
            ->orderAsc('MatchSchedules.id')->toArray();

        $this->set(compact('mole_schedules'));
    }

    public function scheduleFreefire()
    {
        $this->viewBuilder()->setLayout('pages');

        $ff_schedules = $this->MatchSchedules->find()
            ->contain([
                'MatchStatuses',
                'Games'
            ])
            ->where([
                //'MatchSchedules.match_status_id !=' => 3,
                'MatchSchedules.game_id' => 4
            ])
            ->orderAsc('MatchSchedules.id')->toArray();

        $this->set(compact('ff_schedules'));
    }

    public function schedulePubg()
    {
        $this->viewBuilder()->setLayout('pages');

        $pubg_schedules = $this->MatchSchedules->find()
            ->contain([
                'MatchStatuses',
                'Games'
            ])
            ->where([
                //'MatchSchedules.match_status_id !=' => 3,
                'MatchSchedules.game_id' => 3
            ])
            ->orderAsc('MatchSchedules.id')->toArray();

        $this->set(compact('pubg_schedules'));
    }


}
