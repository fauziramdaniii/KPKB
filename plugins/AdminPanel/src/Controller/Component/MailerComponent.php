<?php
namespace AdminPanel\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
/**
 * Mailer component
 * @property \AdminPanel\Model\Table\CustomersTable $Customers
 * @property \Cake\Mailer\Email $Email
 */
class MailerComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = ['transport' => 'default'];

    protected $params = [];

    protected $Clients = null;

    protected $Email;

    protected $plugin = 'AdminPanel';

    public function initialize(array $config)
    {
        $this->_defaultConfig = array_replace($this->_defaultConfig, $config);
        parent::initialize($config);
    }

    /**
     * @param $plugin
     * @return $this
     */
    public function setPlugin($plugin)
    {
        $this->plugin = $plugin;
        return $this;
    }

    public function setVar(array $params)
    {
        $this->params += $params;
        return $this;
    }

    /**
     * @param $destination
     * @param $subject
     * @param $template
     * @param bool $send_later
     * @return \Cake\Mailer\Email
     */
    public function send($destination, $subject, $template)
    {
//        if (!filter_var($destination, FILTER_VALIDATE_EMAIL)) {
//
//            $this->Customers = TableRegistry::get('AdminPanel.Customers');
//            $data = $this->Customers->find()
//                ->select(['email', 'username'])
//                ->where([ 'id' => $destination])
//                ->first();
//            if ($data) {
//                $destination = $data->get('email');
//                $this->params['username'] = $data->get('username');
//            }
//        }

        $this->Email = new Email($this->_defaultConfig['transport']);
        $this->Email->setFrom([Configure::read('EmailSender') => Configure::read('SiteName')])
            ->setTo($destination)
            ->setViewVars($this->params)
            ->setLayout('AdminPanel.mailer')
            ->setTemplate($this->plugin . '.' . $template)
            ->setEmailFormat('html')
            ->setSubject($subject)
            ->send();

        return true;
    }

    public function sendToAdmin($destination, $subject, $template)
    {

        $this->Email = new Email($this->_defaultConfig['transport']);
        $this->Email->setFrom([Configure::read('EmailSender') => Configure::read('SiteName')])
            ->setTo($destination)
            ->setViewVars($this->params)
            ->setLayout('AdminPanel.mailer')
            ->setTemplate($this->plugin . '.' . $template)
            ->setEmailFormat('html')
            ->setSubject($subject)
            ->send();

        return true;
    }

}
