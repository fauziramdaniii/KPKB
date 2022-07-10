<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Avatar helper
 */
class AvatarHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public $helpers = ['Url'];


    public function avatar($thumbnail = false, $classes = '', $filename = false)
    {
        $image_url = $this->avatar_url($thumbnail, $filename);
        return '<img src=" ' . $image_url . '" alt="image" ' . ($classes ? 'class="'.$classes.'"' : '') . '>';
    }

    public function avatar_url($thumbnail = false, $filename = false)
    {

        $avatar = $filename === false ? $this->request->getSession()->read('Auth.Customers.avatar') : $filename ;
        return $this->Url->build((empty($avatar) ?
            '/member-assets/media/users/default.jpg' : '/files/Customers/avatar/' .
            ($thumbnail ? 'thumbnail-' : '') . $avatar ));
    }
}
