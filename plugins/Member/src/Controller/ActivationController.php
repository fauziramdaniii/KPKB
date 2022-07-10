<?php
namespace Member\Controller;

use Cake\Core\Configure;
use Cake\I18n\Time;
use Member\Controller\AppController;

/**
 * Banks Controller
 *
 * @property \AdminPanel\Model\Table\CustomerActivationsTable $CustomerActivations
 * @property \AdminPanel\Model\Table\CustomerBanksTable $CustomerBanks
 * @property \AdminPanel\Model\Table\ImagesTable $Images
 * @method \Member\Model\Entity\Bank[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivationController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.CustomerActivations');
        $this->loadModel('AdminPanel.CustomerBanks');
        $this->loadModel('AdminPanel.Images');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $customer_id = $this->Auth->user('id');

        /**
         * @var \AdminPanel\Model\Entity\CustomerActivation $confirm
         */
        $confirm = $this->CustomerActivations->find()
            ->where([
                'CustomerActivations.customer_id' => $customer_id
            ])
            ->orderDesc('id')
            ->first();
        if ($confirm && (in_array($confirm->status, [0,1]))) {
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index', 'plugin' => 'Member']);
        }

        $confirmation = $this->CustomerActivations->newEntity();

        if ($this->getRequest()->is('post')) {

            $activation_amount = Configure::read('Activation.amount', 150000);
            $this->CustomerActivations->getValidator('default')
                ->requirePresence('customer_bank_id')
                ->equals('amount', $activation_amount)
                ->allowEmptyFile('attachment')
                ->add('attachment', 'mime', [
                    'rule' => function($value) {
                        $mime = mime_content_type($value['tmp_name']);
                        return in_array($mime, [
                            'image/png',
                            'image/jpeg',
                            'image/gif',
                        ]);
                    },
                    'message' => 'Not valid file type'
                ]);


            $this->CustomerActivations->patchEntity($confirmation, $this->getRequest()->getData());

            if (!$confirmation->getErrors()) {

                $image = $this->Images->newEntity([
                    'name' => $this->getRequest()->getData('attachment')
                ]);

                $this->Images->save($image);

                $confirmation->customer_id = $customer_id;
                $confirmation->image_id = $image->id;
                $confirmation->note = strip_tags($confirmation->note);

                if ($this->CustomerActivations->save($confirmation)) {
                    $this->Flash->success(__( 'Success payment confirmation.'));
                    return $this->redirect(['action' => 'Dashboard', 'action' => 'index']);
                }
            }


        }



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
                'customer_id' => $customer_id
            ])
            ->toArray();

        $bankCompany = Configure::read('BankCompany');
        $bank_transfer = array();
        foreach($bankCompany as $vals){
            $bank_transfer[$vals['name'].'/'.$vals['acc_name'].'/'.$vals['acc_number']] = $vals['name'].' / '.$vals['acc_name'].' / '.$vals['acc_number'];
        }
        $this->set(compact('confirmation', 'customer_banks','bank_transfer'));

    }


}
