<?php
namespace Member\Controller;

use Cake\Core\Configure;
use Cake\Database\Expression\QueryExpression;
use Cake\I18n\Number;
use Cake\I18n\Time;
use Cake\ORM\Query;
use Cake\Utility\Hash;
use Member\Controller\AppController;

/**
 * Dashboard Controller
 *
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 * @property \AdminPanel\Model\Table\KtpSubmissionsTable $KtpSubmissions
 * @property \AdminPanel\Model\Table\KkSubmissionsTable $KkSubmissions
 * @property \AdminPanel\Model\Table\KiaSubmissionsTable $KiaSubmissions
 * @property \AdminPanel\Model\Table\AddressSubmissionsTable $AddressSubmissions
 * @property \AdminPanel\Model\Table\SubmissionStatusesTable $SubmissionStatuses
 * @method \Member\Model\Entity\Dashboard[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Customers');
        $this->loadModel('AdminPanel.KtpSubmissions');
        $this->loadModel('AdminPanel.KkSubmissions');
        $this->loadModel('AdminPanel.KiaSubmissions');
        $this->loadModel('AdminPanel.AddressSubmissions');
        $this->loadModel('AdminPanel.SubmissionStatuses');
    }

    /**
     * Index method
     *
     */
    public function index()
    {
        $customer_id = $this->Auth->user('id');

        $total_ktp = $this->KtpSubmissions->find()->where(['KtpSubmissions.customer_id' => $customer_id])->count();
        $total_kk = $this->KkSubmissions->find()->where(['KkSubmissions.customer_id' => $customer_id])->count();
        $total_kia = $this->KiaSubmissions->find()->where(['KiaSubmissions.customer_id' => $customer_id])->count();
        $total_alamat = $this->AddressSubmissions->find()->where(['AddressSubmissions.customer_id' => $customer_id])->count();

        $dataktp = $this->KtpSubmissions->find()
            ->where([
                'KtpSubmissions.customer_id' => $customer_id,
                'KtpSubmissions.submission_status_id' => 2
            ])
            ->select()->toArray();

        $datakk = $this->KkSubmissions->find()
            ->where([
                'KkSubmissions.customer_id' => $customer_id,
                'KkSubmissions.submission_status_id' => 2
            ])
            ->select()->toArray();

        $datakia = $this->KiaSubmissions->find()
            ->where([
                'KiaSubmissions.customer_id' => $customer_id,
                'KiaSubmissions.submission_status_id' => 2
            ])
            ->select()->toArray();

        $dataalamat = $this->AddressSubmissions->find()
            ->where([
                'AddressSubmissions.customer_id' => $customer_id,
                'AddressSubmissions.submission_status_id' => 2
            ])
            ->select()->toArray();

        $this->set(compact('total_ktp',  'total_kk', 'total_kia', 'total_alamat', 'dataktp', 'datakk', 'datakia', 'dataalamat'));
    }

}
