<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;

/**
 * TransactionMutations Controller
 * @property \AdminPanel\Model\Table\TransactionMutationsTable $TransactionMutations
 *
 * @method \AdminPanel\Model\Entity\TransactionMutation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TransactionMutationsController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('AdminPanel.TransactionMutations');
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
            $data = $this->TransactionMutations->find('all')
                ->select();
            $data->contain(['Customers', 'Transactions' => ['TransactionTypes']]);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                        custom field for general search
                        ex : 'Users.email LIKE' => '%' . $search .'%'
                    **/
                    $data->where(['OR' =>
                        [
                            'Customers.username LIKE' => '%' . $search .'%',
                            'TransactionMutations.amount LIKE' => '%' . $search .'%',
                            'TransactionMutations.balance LIKE' => '%' . $search .'%',
                            'Transactions.txid LIKE' => '%' . $search .'%',
                            'Transactions.description LIKE' => '%' . $search .'%'
                        ]
                    ]);
                }
                if (isset($query['transaction_type_id'])) {
                    $transaction_type_id = $query['transaction_type_id'];
                    $data->where(['Transactions.transaction_type_id' => $transaction_type_id]);
                }
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


        $transactionsTypes = $this->TransactionMutations->Transactions->TransactionTypes->find('list');
        $this->set(compact('transactionsTypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Transaction Mutation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $transactionMutation = $this->TransactionMutations->get($id);
        try {
            if ($this->TransactionMutations->delete($transactionMutation)) {
                $this->Flash->success(__('The transaction mutation has been deleted.'));
            } else {
                $this->Flash->error(__('The transaction mutation could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The transaction mutation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
