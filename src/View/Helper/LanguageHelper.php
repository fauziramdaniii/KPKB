<?php

namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

/**
 * Class LanguageHelper
 * @package App\View\Helper
 * @property \Cake\View\Helper\UrlHelper $Url
 */

class LanguageHelper extends Helper {

    public $helpers = ['Url'];

    /**
     * @return mixed
     */
    public function get()
    {
        return Configure::read('App.Languages');
    }

    /**
     * get current language
     * @return mixed
     */
    public function current()
    {
        return $this->getView()->getRequest()->getParam('lang', 'en');
    }

    public function getFlagIcon($lang = null)
    {
        return $this->Url->build('/assets/vendor/flag-icon/flags/4x3/' . $lang);
    }

}