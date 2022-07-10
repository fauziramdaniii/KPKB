<?php
namespace AdminPanel\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Event\Event;

/**
 * Breadcrumb component
 */
class BreadcrumbComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    protected $crumbs = [];
    protected $controller;

    public function startup(Event $event)
    {
        $this->controller = $event->getSubject();
    }

    public function beforeRender(Event $event)
    {
        $this->controller->set('BreadCrumbCrumbs', $this->get());
    }

    public function push(array $crumb)
    {
        $this->crumbs[] = $crumb;
    }

    public function get()
    {
        $this->addActive();

        return $this->crumbs;
    }

    private function addActive()
    {
        if(empty($this->crumbs)) {
            return;
        }   

        foreach($this->crumbs as &$crumb) {
            if(empty($crumb['url'])){
                $crumb['active'] = true;
            } else {
                $crumb['active'] = $this->isActive($crumb['url']);
            }
        }
    }

    private function isActive($url)
    {
        if($url == $this->controller->request->here) {
            return true;
        }

        return false;
    }
}
