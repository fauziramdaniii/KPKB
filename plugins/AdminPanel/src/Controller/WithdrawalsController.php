<?php
namespace AdminPanel\Controller;

use AdminPanel\Controller\AppController;
use AdminPanel\Model\Entity\TransactionType;

/**
 * Withdrawals Controller
 * @property \AdminPanel\Model\Table\WithdrawalsTable $Withdrawals
 * @property \AdminPanel\Model\Table\TransactionsTable $Transactions
 * @property \AdminPanel\Model\Table\CustomersTable Customers
 *
 * @method \AdminPanel\Model\Entity\Withdrawal[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WithdrawalsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Withdrawals');
        $this->loadModel('AdminPanel.Transactions');
        $this->loadModel('AdminPanel.Customers');
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
            $status = $this->request->getData('status');

            /** custom default query : select, where, contain, etc. **/
            $data = $this->Withdrawals->find('all')
                ->select();
            $data->contain(['Customers', 'CustomerBanks', 'WithdrawalStatuses', 'Transactions']);

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                        custom field for general search
                        ex : 'Users.email LIKE' => '%' . $search .'%'
                    **/
                    $data->where(['OR' => [
                        'Customers.username LIKE' => '%' . $search .'%',
                        'Withdrawals.bank_name LIKE' => '%' . $search .'%',
                        'Withdrawals.bank_city LIKE' => '%' . $search .'%',
                        'Withdrawals.amount LIKE' => '%' . $search .'%',
                        'Withdrawals.bank_account_name LIKE' => '%' . $search .'%',
                        'Withdrawals.bank_account_number LIKE' => '%' . $search .'%',
                    ]]);
                }
                $data->where($query);
            }
            if (isset($query['withdrawal_status_id'])) {
                $withdrawal_status_id = $query['withdrawal_status_id'];
                $data->where(['Withdrawals.withdrawal_status_id' => $withdrawal_status_id]);
            }
            if (isset($status)) {
                $data->where(['WithdrawalStatuses.name' => ucfirst($status)]);
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


        $statusTypes = $this->Withdrawals->WithdrawalStatuses->find('list')->toArray();
        $this->set(compact('withdrawals','statusTypes'));
    }

    public function process(){

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
            $status = $this->request->getData('status');
            $ids = $this->request->getData('ids');
            $note = $this->request->getData('note');

            switch ($status){
                case '2':
                    /* success */
                    foreach($ids as $vals){
                        /* update status */
                        $withdrawal =  $this->Withdrawals->get($vals);
                        $withdrawal->withdrawal_status_id = '2';
                        $withdrawal->note = $note;

                        $customer = $this->Customers->get($withdrawal->customer_id);
//                        if($this->Withdrawals->save($withdrawal)){
//                            $this->Mailer->setVar([
//                                'name' => $customer->get('username'),
//                                'message' => 'Dear '.$customer->get('username').', Permintaan penarikan dana telah di proses.<br>Jumlah : Rp. '.$withdrawal->amount.' <br>Fee Admin : Rp. '.$withdrawal->fee.' <br> Bank : '.$withdrawal->bank_name.' <br> Nomor Rekening : '.$withdrawal->bank_account_number
//                            ])->send($customer->get('id'), 'Withdrawal Notification','notification');
//                        }
                    }

                break;

                case '3':
                    /* Failed */
                    foreach($ids as $vals){
                        /* update status */
                        $withdrawal =  $this->Withdrawals->get($vals);

                        if($withdrawal->withdrawal_status_id = '1'){
                            $withdrawal->withdrawal_status_id = '3';
                            $withdrawal->note = $note;

                            $this->Withdrawals->getConnection()->begin();
                            if($this->Withdrawals->save($withdrawal)){
                                //create transaction
                                $transaction = $this->Transactions->create(
                                    TransactionType::REFUND,
                                    $withdrawal->customer_id,
                                    floatval($withdrawal->amount + $withdrawal->fee),
                                    'Failed Withdrawal '.$note
                                );

                                if ($transaction) {
                                    $this->Withdrawals->getConnection()->commit();
                                    /* Email Send */
                                    $customer = $this->Customers->get($withdrawal->customer_id);
//                                    $this->Mailer->setVar([
//                                        'name' => $customer->get('username'),
//                                        'message' => 'Dear '.$customer->get('username').', Permintaan penarikan dana gagal di proses.<br>Jumlah : Rp. '.$withdrawal->amount.' <br>Fee Admin : Rp. '.$withdrawal->fee.' <br> Bank : '.$withdrawal->bank_name.' <br> Nomor Rekening : '.$withdrawal->bank_account_number.' <br> Note : '.$withdrawal->note.'<br><br> Silahkan ulangi kembali.'
//                                    ])->send($customer->get('id'), 'Withdrawal Notification','notification');
                                } else {
                                    $this->Withdrawals->getConnection()->rollback();
                                }
                            }
                        }
                    }

                break;
            }

            $result = ['ok'];
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Withdrawal id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $withdrawal = $this->Withdrawals->get($id);
        try {
            if ($this->Withdrawals->delete($withdrawal)) {
                $this->Flash->success(__('The withdrawal has been deleted.'));
            } else {
                $this->Flash->error(__('The withdrawal could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('The withdrawal could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
