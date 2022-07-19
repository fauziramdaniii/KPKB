<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 * @property \AdminPanel\Model\Table\MessagesTable $Messages
 */
class ContactsController extends AppController
{


    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Messages');
    }


    public function index()
    {
        $this->viewBuilder()->setLayout('pages');

        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
            $secret = Configure::read('GoogleCaptcha.secretKey');
            $gResponse = $this->request->getData('g-recaptcha-response');
            $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$gResponse);
            $res = json_decode($verify);
            if(@$res->success) {
                $message = $this->Messages->patchEntity($message, $this->request->getData());
                if ($this->Messages->save($message)) {
                    $this->Flash->success_front(__('Pesan Telah Terkirim. Silahkan tunggu informasi selanjutnya via email yang tertera.'));
                }else{
                    $this->Flash->error_front(__('Pesan gagal dikirim, silahkan ulangi kembali'));
                }
            }else{
                $this->Flash->error_front(__('Invalid Captcha.'));
            }
        }
    }


}
