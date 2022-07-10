<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use Cake\Core\Configure;

/**
 * Blogs Controller
 * @property \AdminPanel\Model\Table\BlogsTable $Blogs
 * @property \AdminPanel\Model\Table\ImagesTable $Images
 * @property \AdminPanel\Model\Table\TagsTable $Tags
 *
 */
class BlogsController extends AppController
{

    protected $allowedFileType = [];

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('AdminPanel.Images');
        $this->loadModel('AdminPanel.Tags');
        $this->allowedFileType = [
            'image/jpg',
            'image/png',
            'image/jpeg'
        ];
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Blogs->find('all')
                ->select();
            $data->contain(['Topics']);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                        custom field for general search
                        ex : 'Users.email LIKE' => '%' . $search .'%'
                    **/
                    $data->where(['Blogs.name LIKE' => '%' . $search .'%']);
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


        //$this->set(compact('blogs'));
    }

    public function upload(){
        $this->request->allowMethod('post');
        $this->disableAutoRender();

        $file = $this->request->getData('name');

        $Response = $this->response->withType('application/json');

        $out = [];
        $out['error'] = '';
        $out['data'] = $file;

        $mime = mime_content_type($file['tmp_name']);

        if (in_array($mime, $this->allowedFileType)) {

            $size = getimagesize($file['tmp_name']);

            $width = $size[0];
            $height = $size[1];

            $min_image_size = [
                'width' => 500,
                'height' => 500
            ];

            if ($width < $min_image_size['width'] && $height < $min_image_size['height']) {
                $out['error'] = __( sprintf('minimal width %s dan height %s', $min_image_size['width'], $min_image_size['height']));
                $Response = $Response->withStatus('401');
                return $Response
                    ->withStringBody(json_encode($out));
            }
            $entity = $this->Images->newEntity();
            $this->Images->patchEntity($entity, $this->request->getData());
            if ($this->Images->save($entity)) {

				$path = explode('/',$entity->get('dir'));
				unset($path[0]);
				$path = implode('/',$path);
                $out['data'] = [
                    'original_name' => $file['name'],
                    'url' => $_SERVER[ 'HTTP_ORIGIN' ] . DS . $path,
                    'name' => $entity->get('name'),
                    'image_id' => $entity->get('id')
                ];
                $Response = $Response->withStatus('200');
            } else {
                $out['error'] = __( 'Gagal upload');
                $out['message'] = $entity->getErrors();

                $Response = $Response->withStatus('401');
            }
        } else {
            $out['error'] = __( 'file harus jpg, png');
            $Response = $Response->withStatus('401');
        }


        return $Response
            ->withStringBody(json_encode($out));
    }

    /**
     * View method
     *
     * @param string|null $id Blog id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('ajax');
        $blog = $this->Blogs->get($id, [
            'contain' => ['Topics', 'Users', 'BlogTags']
        ]);

        $this->set('blog', $blog);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $languages = Configure::read('App.Languages');
        $blog = $this->Blogs->newEntity();
        if ($this->request->is('post')) {
            $blog = $this->Blogs->patchEntity($blog, $this->request->getData(), ['associated'=>['Tags']]);
            $blog->set('status', $this->request->getData('status'));
            $blog->set('user_id', $this->Auth->user('id'));
            if ($this->Blogs->save($blog, ['associated'=>['Tags']])) {
                $this->Flash->success(__('The blog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blog could not be saved. Please, try again.'));
        }
        $topics = $this->Blogs->Topics->find('list', ['limit' => 200]);
        $listTags = $this->Tags->find('list', ['limit' => 200])->toArray();
        $this->set(compact('blog', 'topics', 'languages','listTags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Blog id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $languages = Configure::read('App.Languages');

        $blog = $this->Blogs->find('translations')
            ->where(['Blogs.id' => $id])
            ->contain(['Tags'])
            ->first();
        if ($this->request->is(['patch', 'post', 'put'])) {

            $blog = $this->Blogs->patchEntity($blog, $this->request->getData(), ['associated'=>['Tags']]);
            $blog->set('status', $this->request->getData('status'));
            $blog->set('user_id', $this->Auth->user('id'));
            if ($this->Blogs->save($blog, ['associated'=>['Tags']])) {
                $this->Flash->success(__('The blog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blog could not be saved. Please, try again.'));
        }
        $topics = $this->Blogs->Topics->find('list', ['limit' => 200]);
        $listTags = $this->Tags->find('list', ['limit' => 200])->toArray();
        $this->set(compact('blog', 'topics', 'languages','listTags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Blog id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $blog = $this->Blogs->get($id);
        try {
            if ($this->Blogs->delete($blog)) {
                $this->Flash->success(__('The blog has been deleted.'));
            } else {
                $this->Flash->error(__('The blog could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The blog could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
