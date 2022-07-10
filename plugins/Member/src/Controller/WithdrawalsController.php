<?php
namespace Member\Controller;

use AdminPanel\Model\Entity\TransactionType;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Core\Configure;
use Member\Controller\AppController;

/**
 * Withdrawals Controller
 *
 * @property \AdminPanel\Model\Table\WithdrawalsTable $Withdrawals
 * @property \AdminPanel\Model\Table\CustomerBanksTable $CustomerBanks
 * @property \AdminPanel\Model\Table\TransactionsTable $Transactions
 * @method \Member\Model\Entity\Withdrawal[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WithdrawalsController extends AppController
{


    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Withdrawals');
        $this->loadModel('AdminPanel.CustomerBanks');
        $this->loadModel('AdminPanel.Transactions');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $customer_id = $this->Auth->user('id');

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');

            $pagination = $this->request->getData('pagination');
            $sort = $this->request->getData('sort');
            $query = $this->request->getData('query');

            $data = $this->Withdrawals->find();

            $data = $data
                ->contain([
                    'WithdrawalStatuses'
                ])
                ->where([
                    'Withdrawals.customer_id' => $customer_id
                ])
                ->orderDesc('Withdrawals.id');

            if ($query && is_array($query)) {
                if (isset($query['generalSearch'])) {
                    $search = $query['generalSearch'];
                    unset($query['generalSearch']);
                    /**
                    custom field for general search
                    ex : 'Users.email LIKE' => '%' . $search .'%'
                     **/
                    $data->where(['OR' => [
                        'Withdrawals.bank_name LIKE' => '%' . $search .'%',
                        'Withdrawals.bank_city LIKE' => '%' . $search .'%',
                        'Withdrawals.bank_branch LIKE' => '%' . $search .'%',
                        'Withdrawals.bank_account_number LIKE' => '%' . $search .'%',
                        'Withdrawals.created LIKE' => '%' . $search .'%',
                    ]]);
                }

                $data->where($query);
                if (isset($query['withdrawal_status_id'])) {
                    $search = $query['withdrawal_status_id'];
                    $data->where([
                        'Withdrawals.withdrawal_status_id' => $search,
                    ]);
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

        $withdrawal_status = $this->Withdrawals->WithdrawalStatuses->find('list')->toArray();
        $this->set(compact('withdrawal_status'));
    }



    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        if (!in_array(intval(date('d')), $rule_days = Configure::read('Withdrawal.request_periode_days', [24, 25, 26])) && count($rule_days) > 0) {
            if (count($rule_days) > 1) {
                $rule_message = implode(', ', $rule_days);
            } else {
                $rule_message = min($rule_days);
            }

            $this->Flash->error(__('The withdrawal requests can only be used on dates {0}', [
                $rule_message
            ]));
            return $this->redirect(['action' => 'index']);
        }

        $withdrawal = $this->Withdrawals->newEntity();

        $customer_id = $this->Auth->user('id');
        $username = $this->Auth->user('username');

        $customerEntity = $this->CustomerBanks->Customers->find()
            ->select(['id', 'balance'])
            ->where([
                'id' => $customer_id
            ])
            ->first();

        $balance = $customerEntity ? $customerEntity->get('balance') : 0;

        $customer_banks = $this->CustomerBanks->find('list', [
            'keyField' => 'id',
            'valueField' => function(\AdminPanel\Model\Entity\CustomerBank $row) {
                return $row->bank->name . ' - ' . $row->account_name . ' - ' . $row->account_number;
            }
        ])
            ->contain([
                'Banks'
            ])
            ->where([
                'customer_id' => $this->Auth->user('id')
            ])
            ->toArray();

        //debug(array_keys($customer_banks));exit;

        $withdrawalMinTransfer = Configure::read('Withdrawal.minimumTransfer', 100000);
        $withdrawalFee = Configure::read('Withdrawal.fee', 7500);




        if ($this->request->is('post')) {

            $emptyBalanceMessage = $balance > 0 ? __( 'This amount must be less than {0}', [$balance])
                : __( 'Insufficient balance');

            $validator = $this->Withdrawals->getValidator('default')
                ->requirePresence('customer_bank_id')
                ->requirePresence('amount')
                ->inList('customer_bank_id', array_keys($customer_banks), __( 'This bank not allowed'))
                ->greaterThanOrEqual('amount', $withdrawalMinTransfer, __('This amount must be greater than {0}', [$withdrawalMinTransfer]))
                ->lessThanOrEqual('amount', $balance, $emptyBalanceMessage)
                ->add('password', 'check', [
                    'rule' => function($value) use ($customer_id) {
                        /**
                         * @var \AdminPanel\Model\Entity\Customer $customer
                         */
                        $customer = $this->CustomerBanks->Customers->find()
                            ->select([
                                'Customers.password'
                            ])
                            ->where([
                                'Customers.id' => $customer_id
                            ])
                            ->first();
                        $check = (new DefaultPasswordHasher)->check($value, $customer->password);
                        return $check;
                    },
                    'message' => __( 'Invalid password')
                ]);


            $withdrawal = $this->Withdrawals->patchEntity($withdrawal, $this->request->getData());

            $withdrawal->customer_id = $customer_id;
            $withdrawal->withdrawal_status_id = 1; //pending

            /**
             * @var \AdminPanel\Model\Entity\CustomerBank $customerBankEntity
             */
            $customerBankEntity = $this->CustomerBanks->find()
                ->contain([
                    'Banks'
                ])
                ->where([
                    'CustomerBanks.id' => $this->request->getData('customer_bank_id'),
                    'CustomerBanks.customer_id' => $customer_id
                ])
                ->first();

            if ($customerBankEntity) {
                $withdrawal->bank_name = $customerBankEntity->bank->name;
                $withdrawal->bank_city = $customerBankEntity->city;
                $withdrawal->bank_branch = $customerBankEntity->branch;
                $withdrawal->bank_account_name = $customerBankEntity->account_name;
                $withdrawal->bank_account_number = $customerBankEntity->account_number;
            }

            if ($withdrawalFee > 0 && $withdrawal->amount > $withdrawalFee) {
                $withdrawal->fee = $withdrawalFee;
                $withdrawal->amount -= $withdrawalFee;
            }


            //begin transaction
            $this->Withdrawals->getConnection()->begin();

            if ($this->Withdrawals->save($withdrawal)) {

                //create transaction
                $transaction = $this->Transactions->create(
                    TransactionType::WITHDRAWAL,
                    $customer_id,
                    floatval($this->request->getData('amount')) * -1,
                    'Request Withdrawal',
                    function (\AdminPanel\Model\Entity\Transaction $transaction) use ($withdrawal) {
                        $withdrawal->transaction_id = $transaction->id;
                        $this->Withdrawals->save($withdrawal);
                    }
                );

                if ($transaction) {
                    $this->Withdrawals->getConnection()->commit();

//                    $this->Mailer->setVar([
//                        'name' => 'Admin',
//                        'message' => 'Dear admin, Ada user yang melakukan permintaan penarikan dana harap segera di proses.<br>user : <strong>'.$username.'</strong> <br>Jumlah : Rp. '.$this->request->getData('amount').' <br> Bank : '.$customerBankEntity->bank->name.' <br> Nomor Rekening : '.$customerBankEntity->account_number
//                    ])->sendToAdmin('admin@gardukita.com', 'Withdrawal Notification','notification');

                } else {
                    $this->Withdrawals->getConnection()->rollback();
                    $this->Flash->error(__('The withdrawal could not be saved. Please, try again.'));
                    return $this->redirect(['action' => 'index']);
                }


                $this->Flash->success(__( 'The withdrawal has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The withdrawal could not be saved. Please, try again.'));
        }



        $this->set(compact('withdrawal', 'customer_banks', 'balance'));
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
        if ($this->Withdrawals->delete($withdrawal)) {
            $this->Flash->success(__('The withdrawal has been deleted.'));
        } else {
            $this->Flash->error(__('The withdrawal could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
