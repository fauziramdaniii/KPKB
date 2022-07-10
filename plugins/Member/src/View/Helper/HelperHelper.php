<?php


namespace Member\View\Helper;

use Cake\View\Helper;

/**
 * Class HelperHelper
 * @package Member\View\Helper
 * @property Helper\UrlHelper $Url
 */
class HelperHelper extends Helper
{

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


    public function generateChild($childs, $levelLimit = 4)
    {
        /**
         * @var \AdminPanel\Model\Entity\Network[] $childs
         */



        foreach($childs as $child) {
            if ($child->rlevel <= $levelLimit) {
                $sole = (is_array($childs) && count($childs) === 1) ? ' sole' : '';
                echo '<div class="entry'.$sole.'">
                <div class="label-network ' . ($child->customer->is_vip ? 'ribbon ribbon-top-left' : '') . '">
                ' . ($child->customer->is_vip ? '<span class="vip"><i class="flaticon-star"></i> VIP</span>' : '') . '
                <div class="kt-user-card-v2 text-left">
                            <div class="kt-user-card-v2__pic">
                                ' . $this->avatar(true, 'avatar-rounded', $child->customer->avatar) . '
                            </div>
                            <div class="kt-user-card-v2__details">
                                '.(!empty($child['children']) ? '<a class="kt-user-card-v2__name text-primary" href="'. $this->Url->build(['action' => 'index', $child->customer->id]) .'">' : '<a class="kt-user-card-v2__name" href="#">') . $child->customer->username . (!empty($child['children'])  ? '</a>' : '</a>') .'
                                <span class="kt-user-card-v2__email" title="'. h(@$child->customer->full_name) .'">'. @$child->customer->full_name  .(!empty($child['children']) ? '<br> Downline : ' . $child->childCount : '<br> Downline : 0') . '</span> </div>
                        </div> </div>';

                if (!empty($child['children']) && $child->rlevel != $levelLimit) {
                    echo '<div class="branch lv'.$child->rlevel.'">';
                        $this->generateChild($child['children']);
                    echo '</div>';
                }

                echo '</div>';
            }

        }
    }

}
