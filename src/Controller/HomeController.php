<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Home Controller
 *
 *
 * @property \AdminPanel\Model\Table\BlogsTable $Blogs
 * @property \AdminPanel\Model\Table\TagsTable $Tags
 * @property \AdminPanel\Model\Table\BlogTagsTable $BlogTags
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 * @property \AdminPanel\Model\Table\ImagesTable $Images
 * @property \AdminPanel\Model\Table\SlidesTable $Slides
 * @property \AdminPanel\Model\Table\VideosTable $Videos
 * @property \AdminPanel\Model\Table\GalleriesTable $Galleries
 * @property \AdminPanel\Model\Table\WhatsAppTable $WhatsApp
 */
class HomeController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Blogs');
		$this->loadModel('AdminPanel.Tags');
		$this->loadModel('AdminPanel.Images');
		$this->loadModel('AdminPanel.Slides');
		$this->loadModel('AdminPanel.Videos');
        $this->loadModel('AdminPanel.Albums');
        $this->loadModel('AdminPanel.Images');
		$this->loadModel('AdminPanel.Galleries');
		$this->loadModel('AdminPanel.WhatsApp');
    }

	protected function getTags($limit = 4)
    {
        $tags = $this->Tags->find();
        $tags = $tags
            ->select([
                'Tags.id',
                'Tags.name',
                'total' => $tags->func()->count('BlogTags.tag_id')
            ])
            ->innerJoin(['BlogTags' => 'blog_tags'], ['Tags.id = BlogTags.tag_id'])
            ->group('tag_id')
            ->limit($limit)
            ->toArray();



        return $tags;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $slides = $this->Slides->find()->select()->toArray();

        $video = $this->Videos->find()
        ->select()
        ->limit(6) 
        ->toArray();

        $whatsapp = $this->WhatsApp->find()->select()->toArray();

        $highlight = $this->Blogs->find()
            ->where([
                'status' => 1,
            ])
            ->contain([
                'Users',
                'Topics',
                'Tags'
            ])
            ->orderDesc('Blogs.id')
            ->limit(5)->toArray();

		$tags = $this->getTags();

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax'); // Use a different layout for Ajax requests
        }
        
        $album = $this->Albums->find()->all()->toArray();
        $gallery = $this->Galleries->find()
            ->contain([
                'Albums',
                'Images'
            ])
            // ->where(['Galleries.album_id' => $albums])
            ->orderDesc('Galleries.id');
            $galleries = $this->paginate($gallery, ['limit' => 6])
    ->map(function (\AdminPanel\Model\Entity\Gallery $row) {
        $path = explode(DS, $row->image->dir);
        unset($path[0]);
        $path = implode('/', $path);
        $row->image->dir = $path;
        
        // Set a default value for title if it is null
        $row->title = $row->title ?? 'Yo Check This Out';

        return $row;
    })
    ->toArray();

        $this->set(compact('whatsapp', 'highlight','tags','slides','video', 'galleries','album'));


    }

    private function startEndDate($year_month){

        $first_date_find = date("Y-m-d",strtotime(date("Y-m-d", strtotime($year_month)) . ", first day of this month"));
        $last_date_find = date("Y-m-d",strtotime(date("Y-m-d", strtotime($year_month)) . ", last day of this month"));
        $first_day_find = date("d",strtotime(date("Y-m-d", strtotime($year_month)) . ", first day of this month"));
        $last_day_find = date("d",strtotime(date("Y-m-d", strtotime($year_month)) . ", last day of this month"));

        return [
            $first_date_find,
            $last_date_find,
            $first_day_find,
            $last_day_find
        ];
    }

    public function filterShow(){

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
            $date = $this->request->getData('date') ?$this->request->getData('date') : date('Y-m');

            $startEndDate = $this->startEndDate($date);
            $start = $startEndDate[0];
            $end = $startEndDate[1];
            $day_start = $startEndDate[2];
            $day_end = $startEndDate[3];

            $counter_register = $this->Customers->find()
            ->select([
                'created' => 'Date(Customers.created)',
                'total' => $this->Customers->find()->func()->count('Customers.id'),
            ])
            ->where(function($exp) use($start,$end ){
                return $exp->between('created',$start,$end,'date');
            })->group(['DATE(Customers.created)'])->toArray();


            $counter_orders = $this->RepeatOrders->find()
                ->select([
                    'created' => 'Date(RepeatOrders.created)',
                    'total' => $this->RepeatOrders->find()->func()->count('RepeatOrders.id'),
                ])
                ->where(function($exp) use($start,$end ){
                    return $exp->between('created',$start,$end,'date');
                })->group(['DATE(RepeatOrders.created)'])->toArray();

            $counter = [];
            for($i=$day_start;$i<=$day_end;$i++){
                $number = intval($i);
                $counter['register'][$number]['category'] = $number;
                $counter['register'][$number]['value'] = 0;
                $counter['repeat_order'][$number]['category'] = $number;
                $counter['repeat_order'][$number]['value'] = 0;
            }
            foreach($counter_register as $vals){
                $numberDate = $vals['created']->format('d');
                $counter['register'][intval($numberDate)]['value'] = $vals['total'];
            }

            foreach($counter_orders as $vals){
                $numberDate = $vals['created']->format('d');
                $counter['repeat_order'][intval($numberDate)]['value'] = $vals['total'];
            }



            return $this->response->withType('application/json')
                ->withStringBody(json_encode($counter));
        }

    }
    public function filtering(){

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');



//            return $this->response->withType('application/json')
//                ->withStringBody(json_encode($result));
        }

    }

}