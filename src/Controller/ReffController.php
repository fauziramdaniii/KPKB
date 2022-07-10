<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Reff Controller
 *
 *
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 */
class ReffController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Customers');
    }
    public function index($refferal = null){

        $checkUser = $this->Customers->find()
            ->select(['username'])
            ->where(['Customers.username' => $refferal])
            ->first();
        if($checkUser){
            $this->request->getSession()->write('Refferal',$checkUser->get('username'));
            $this->redirect(array('controller' => 'SignUp', 'action' => 'index'));
        }else{
            $this->request->getSession()->delete('Refferal');
            $this->request->getSession()->delete('RefferalFrom');
            $this->redirect(array('controller' => 'BrandRegister', 'action' => 'index'));
        }
    }
}