<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use Cake\Core\Configure;

/**
 * Blogs Controller
 * @property \AdminPanel\Model\Table\AlbumsTable $Albums
 * @property \AdminPanel\Model\Table\ImagesTable $Images
 * @property \AdminPanel\Model\Table\GalleriesTable $Galleries
 *
 */

class GalleriesController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('AdminPanel.Albums');
        $this->loadModel('AdminPanel.Galleries');
        $this->loadModel('AdminPanel.Images');
        $this->allowedFileType = [
            'image/jpg',
            'image/png',
            'image/jpeg'
        ];
    }

    public function album()
    {

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Albums->find('all')
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['Albums.name LIKE' => '%' . $search .'%']);
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

    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addAlbum()
    {
        $languages = Configure::read('App.Languages');
        $albums = $this->Albums->newEntity();
        if ($this->request->is('post')) {
            $albums = $this->Albums->patchEntity($albums, $this->request->getData());
            if ($this->Albums->save($albums)) {
                $this->Flash->success(__('The album has been saved.'));

                return $this->redirect(['action' => 'album']);
            }
            $this->Flash->error(__('The album could not be saved. Please, try again.'));
        }
        $this->set(compact('albums','languages'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Albums id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editAlbum($id = null)
    {
        $languages = Configure::read('App.Languages');
        $albums = $this->Albums->find('translations')
            ->where(['Albums.id' => $id])
            ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $albums = $this->Albums->patchEntity($albums, $this->request->getData());
            if ($this->Albums->save($albums)) {
                $this->Flash->success(__('The Albums has been saved.'));

                return $this->redirect(['action' => 'album']);
            }
            $this->Flash->error(__('The Albums could not be saved. Please, try again.'));
        }
        $this->set(compact('albums','languages'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Albums id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteAlbum($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $album = $this->Albums->get($id);
        try {
            if ($this->Albums->delete($album)) {
                $this->Flash->success(__('The Albums has been deleted.'));
            } else {
                $this->Flash->error(__('The Albums could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The Albums could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'album']);
    }


    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $image = $this->Galleries->get($id);
        try {
            if ($this->Galleries->delete($image)) {
                $this->Flash->success(__('The Image has been deleted.'));
            } else {
                $this->Flash->error(__('The Image could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The Image could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }



    public function index($id = null)
    {


        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');
            $albumId = $this->request->getParam('pass.0', 1);

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Galleries->find('all')
                ->select()
                ->contain(['Albums','Images'])
                ->where(['Galleries.album_id' => $albumId]);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['Galleries.name LIKE' => '%' . $search .'%']);
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


            $data = $data->map(function (\AdminPanel\Model\Entity\Gallery $row) {
                $path = explode(DS,$row->image->dir);
                unset($path[0]);
                $path = implode('/',$path);
                $row->image->dir = $path;
                return $row;
            });

            $total = $data->count();


            $result = [];
            $result['data'] = $data->toArray();


            $result['meta'] = array_merge((array) $pagination, (array) $sort);
            $result['meta']['total'] = $total;


            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }

        $albums = $this->Galleries->Albums->find('all');
        $this->set(compact('albums'));
    }

    public  function  upload(){
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



                $galleryEntity = $this->Galleries->newEntity();
                $galleryEntity->album_id = $this->request->getData('album_id');
                $galleryEntity->image_id = $entity->get('id');

                $this->Galleries->save($galleryEntity);


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
}
