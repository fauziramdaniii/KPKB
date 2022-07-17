<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use Cake\Core\Configure;

/**
 * Slides Controller
 *
 * @property \AdminPanel\Model\Table\SlidesTable $Slides
 *
 * @method \AdminPanel\Model\Entity\Slide[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SlidesController extends AppController
{
    protected $allowedFileType = [];

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Slides');
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
            $data = $this->Slides->find('all')
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['Slides.title LIKE' => '%' . $search .'%']);
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
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $slide = $this->Slides->newEntity();
        if ($this->request->is('post')) {
            $slide = $this->Slides->patchEntity($slide, $this->request->getData());
            if ($this->Slides->save($slide)) {
                $this->Flash->success(__('The slide has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The slide could not be saved. Please, try again.'));
        }
        $this->set(compact('slide'));
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
        $slide = $this->Slides->find()
            ->where(['Slides.id' => $id])
            ->first();
        if ($this->request->is(['patch', 'post', 'put'])) {

            $slide = $this->Slides->patchEntity($slide, $this->request->getData());
            if ($this->Slides->save($slide)) {
                $this->Flash->success(__('The slide has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The slide could not be saved. Please, try again.'));
        }
        $this->set(compact('slide'));
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
        $slide = $this->Slides->get($id);
        try {
            if ($this->Slides->delete($slide)) {
                $this->Flash->success(__('The slide has been deleted.'));
            } else {
                $this->Flash->error(__('The slide could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The slide could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
