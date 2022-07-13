<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use AdminPanel\Plugin;
use Cake\I18n\Time;

/**
 * Dashboard Controller
 *
 * @property
 * @property \AdminPanel\Model\Table\BlogsTable $Blogs
 * @property \AdminPanel\Model\Table\MessagesTable $Messages
 * @property \AdminPanel\Model\Table\VideosTable $Videos
 * @property \AdminPanel\Model\Table\FaqsTable $Faqs
 * @method \AdminPanel\Model\Entity\Dashboard[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('AdminPanel.Blogs');
        $this->loadModel('AdminPanel.Messages');
        $this->loadModel('AdminPanel.Videos');
        $this->loadModel('AdminPanel.Faqs');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        $dashboard = null;
        $total_berita = $this->Blogs->find()->count();
        $total_pesan = $this->Messages->find()->count();
        $total_video = $this->Videos->find()->count();
        $total_faq = $this->Faqs->find()->count();

        $this->set(compact(
            'dashboard',
            'total_berita',
            'total_pesan',
            'total_video',
            'total_faq'
        ));

    }


}
