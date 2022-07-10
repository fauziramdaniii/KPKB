<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\Database\Query;
use Cake\I18n\I18n;
use Cake\Core\Configure;

/**
 * FaqCategories Controller
 * @property \AdminPanel\Model\Table\FaqCategoriesTable $FaqCategories
 *
 * @method \AdminPanel\Model\Entity\FaqCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FaqCategoriesController extends AppController
{

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
            $data = $this->FaqCategories->find('all')
                ->select();

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                        custom field for general search
                        ex : 'Users.email LIKE' => '%' . $search .'%'
                    **/
                    $data->where(['FaqCategories.name LIKE' => '%' . $search .'%']);
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


        //$this->set(compact('faqCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Faq Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('ajax');
        $faqCategory = $this->FaqCategories->get($id, [
            'contain' => ['Faqs']
        ]);

        $this->set('faqCategory', $faqCategory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $languages = Configure::read('App.Languages');
        $faqCategory = $this->FaqCategories->newEntity();
        if ($this->request->is('post')) {
            $faqCategory = $this->FaqCategories->patchEntity($faqCategory, $this->request->getData());
            if ($this->FaqCategories->save($faqCategory)) {
                $this->Flash->success(__('The faq category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The faq category could not be saved. Please, try again.'));
        }
        $this->set(compact('faqCategory','languages'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Faq Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $languages = Configure::read('App.Languages');
        $faqCategory = $this->FaqCategories->find('translations')
            ->where(['FaqCategories.id' => $id])
            ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $faqCategory = $this->FaqCategories->patchEntity($faqCategory, $this->request->getData());
            if ($this->FaqCategories->save($faqCategory)) {
                $this->Flash->success(__('The faq category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The faq category could not be saved. Please, try again.'));
        }
        $this->set(compact('faqCategory','languages'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Faq Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $faqCategory = $this->FaqCategories->get($id);
        try {
            if ($this->FaqCategories->delete($faqCategory)) {
                $this->Flash->success(__('The faq category has been deleted.'));
            } else {
                $this->Flash->error(__('The faq category could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The faq category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
