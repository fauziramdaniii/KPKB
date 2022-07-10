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
 * @property \AdminPanel\Model\Table\BlogsTable $News
 */
class NewsController extends AppController
{

	public $paginate = [
        'limit' => 6,
    ];

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Topics');
        $this->loadModel('AdminPanel.Tags');
        $this->loadModel('AdminPanel.Blogs');
        $this->loadModel('AdminPanel.BlogTags');
    }


    protected function getTopic($limit = 10)
    {
        return $this->Blogs->Topics->find()
            ->limit($limit)
            ->toArray();
    }

    protected function getTags($limit = 10)
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

    protected function getTopBlog($limit = 3)
    {
        return $this->Blogs->find()
            ->contain([
                'Users'
            ])
            // ->orderDesc('Blogs.view')
            ->order('rand()')
            ->limit($limit)
            ->toArray();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        $this->viewBuilder()->setLayout('blank');
        $this->viewBuilder()->setTemplate('topic');

		$title = 'Berita';
		$description = 'Lorem Ipsum';

        $blogs = $this->Blogs->find()
            ->contain([
                'Users',
                'Topics',
                'Tags'
            ])
            ->orderDesc('Blogs.id');

        $blogs = $this->paginate($blogs, ['limit' => 3])
            ->toArray();

        $topics = $this->getTopic();
        $tags = $this->getTags();
        $top_blogs = $this->getTopBlog();
        $this->set(compact('blogs', 'topics', 'tags', 'top_blogs', 'title', 'description'));
    }

    /**
     * View method
     *
     * @param string|null $id Blog id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        /**
         * @var \AdminPanel\Model\Entity\Blog $blog
         */

        $this->viewBuilder()->setLayout('blank');

        $blog = $this->Blogs->find()
            ->where([
                'slug' => $slug //TODO where status
            ])
            ->contain([
                'Users',
                'Topics',
                'Tags'
            ])
            ->first();

        if (!$blog) {
            throw new \Cake\Datasource\Exception\RecordNotFoundException('Not found blogs');
        }

        $blog->set('view', $blog->view + 1);
        $this->Blogs->save($blog);

        $topics = $this->getTopic();
        $tags = $this->getTags();
        $top_blogs = $this->getTopBlog();

        $this->set(compact('blog', 'topics', 'tags', 'top_blogs'));
    }


    public function topic($topic_id)
    {
        $this->viewBuilder()->setLayout('blank');

		$title = 'Berita';
		$description = 'Lorem Ipsum';

        $blogs = $this->Blogs->find()
            ->where([
                'topic_id' => $topic_id
            ])
            ->contain([
                'Users',
                'Topics',
                'Tags'
            ])
            ->orderDesc('Blogs.id');

        $blogs = $this->paginate($blogs, ['limit' => 3])
            ->toArray();

        $topics = $this->getTopic();
        $tags = $this->getTags();
        $top_blogs = $this->getTopBlog();

        //debug($blogs->toArray());

        $this->set(compact('blogs', 'topics', 'tags', 'top_blogs', 'title', 'description'));
    }

    public function tag($tag_id)
    {
        $this->viewBuilder()->setLayout('blank');
        $this->viewBuilder()->setTemplate('topic');

		$title = 'Berita';
		$description = 'Lorem Ipsum';

        $blogs = $this->Blogs->find()
            ->where([
                'BlogTags.tag_id' => $tag_id
            ])
            ->leftJoinWith('BlogTags')
            ->contain([
                'Users',
                'Topics',
                'Tags'
            ])
            ->orderDesc('Blogs.id');

        if ($blogs->isEmpty()) {
            throw new \Cake\Datasource\Exception\RecordNotFoundException('Not found blogs');
        }

        $blogs = $this->paginate($blogs)
            ->toArray();

        $topics = $this->getTopic();
        $tags = $this->getTags();
        $top_blogs = $this->getTopBlog();

        //debug($blogs);

        $this->set(compact('blogs', 'topics', 'tags', 'top_blogs', 'title', 'description'));
    }



    // public function index()
    // {
		// $this->viewBuilder()->setLayout('other');
		// $title = 'News';
		// $this->set('Title', $title);
		// $subtitle = 'Zensei Indonesia';
		// $this->set('Subtitle', $subtitle);
		// $description = 'Pelopor Sei Express pertama di dunia';
        // $this->set(compact('description'));

        // $news = $this->Blogs->find('all')
			// ->select()
            // ->order(['Blogs.id' => 'DESC']);
        // $news->contain(['Topics', 'BlogTags', 'Tags']);
        // $this->set(compact('news'));

        // $categories = $this->Topics->find('all')
            // ->select();
        // $this->set(compact('categories'));

        // $tags = $this->Tags->find('all')
            // ->select();
        // $this->set(compact('tags'));

        // $products = $this->Products->find('all')
            // ->select();
        // $this->set(compact('products'));

    // }



}
