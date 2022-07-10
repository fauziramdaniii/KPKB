<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use Cake\Core\Configure;

/**
 * Blogs Controller
 * @property \AdminPanel\Model\Table\DownloadsTable $Downloads
 * @property \AdminPanel\Model\Table\DownloadCategoriesTable $DownloadCategories
 *
 */
class DownloadsController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('AdminPanel.Downloads');
        $this->loadModel('AdminPanel.DownloadCategories');
        $this->allowedFileType = [
            'image/jpg',
            'image/png',
            'image/jpeg',
            'application/pdf',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/msword',
            'application/vnd.ms-excel',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        ];
    }

    public function category()
    {

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->DownloadCategories->find('all')
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['DownloadCategories.name LIKE' => '%' . $search .'%']);
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

    public function addCategory()
    {

        $languages = Configure::read('App.Languages');
        $categories = $this->DownloadCategories->newEntity();
        if ($this->request->is('post')) {
            $categories = $this->DownloadCategories->patchEntity($categories, $this->request->getData());
            if ($this->DownloadCategories->save($categories)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'category']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $this->set(compact('categories','languages'));
    }

    public function editCategory($id = null)
    {

        $languages = Configure::read('App.Languages');
        $categories = $this->DownloadCategories->find('translations')
            ->where(['DownloadCategories.id' => $id])
            ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $categories = $this->DownloadCategories->patchEntity($categories, $this->request->getData());
            if ($this->DownloadCategories->save($categories)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'category']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $this->set(compact('categories','languages'));
    }

    public function deleteCategory($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $album = $this->DownloadCategories->get($id);
        try {
            if ($this->DownloadCategories->delete($album)) {
                $this->Flash->success(__('The category has been deleted.'));
            } else {
                $this->Flash->error(__('The category could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'category']);

    }

    public function files($id = null)
    {

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');
            $categoryId = $this->request->getParam('pass.0', 1);

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Downloads->find('all')
                ->select()
                ->where(['Downloads.download_category_id' => $categoryId]);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['Downloads.name LIKE' => '%' . $search .'%']);
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

            $data = $data->map(function (\AdminPanel\Model\Entity\Download $row) {
                $path = explode(DS,$row->dir);
                unset($path[0]);
                $path = implode('/',$path);
                $row->dir = $path;
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

        $categories = $this->Downloads->DownloadCategories->find('all');

        $languages = Configure::read('App.Languages');
        $this->set(compact('categories','languages'));
    }

    public function deleteFiles($id = null)
    {

        $this->request->allowMethod(['post', 'delete']);
        $files = $this->Downloads->get($id);
        try {
            if ($this->Downloads->delete($files)) {
                $this->Flash->success(__('The files has been deleted.'));
            } else {
                $this->Flash->error(__('The files could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The files could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'files']);
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
            $entity = $this->Downloads->newEntity();
            $this->Downloads->patchEntity($entity, $this->request->getData());
            $entity->download_category_id = $this->request->getData('category_id');
            $entity->title = $this->request->getData('title');
            $entity->description = $this->request->getData('description');
            if ($this->Downloads->save($entity)) {
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
