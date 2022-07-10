<?php


namespace App\View\Helper;
use Cake\View\Helper;

/**
 * Class ToolsHelper
 * @package App\View\Helper
 * @property \Cake\View\Helper\PaginatorHelper $Paginator
 */
class ToolsHelper extends Helper
{

    public $helpers = ['Paginator'];

    /**
     * @param array $menu
     * @return string
     */
    public function breadCrumb(array $menu)
    {
        $bread = '<ol class="breadcrumb">';

        foreach($menu as $val) {

            $props = [];
            foreach($val as $key => $prop) {
                if (!in_array($key, ['title', 'url', 'active', 'class', 'aria-current'])) {
                    array_push($props, "$key=" . '"'. $prop .'"');
                }
            }

            if (isset($val['active'])) {
                array_push($props, 'aria-current="page"');
            }


            $bread .= '<li class="breadcrumb-item' .
                (isset($val['active']) ? ' ' . $val['active'] : '') .
                '" '. (!empty($props) ? implode(' ', $props) : '') .' >';

            $bread .= !empty($val['url']) ? '<a href="'. $val['url'] .'">' : '';
            $bread .= $val['title'];
            $bread .= !empty($val['url']) ? '</a>' : '';
            $bread .= '</li>';
        }

        $bread .= '</ol>';

        return $bread;
    }

    public function pagination($model = null)
    {

        $this->Paginator->setTemplates([
            'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
            'current' => '<li class="page-item active"><a class="page-link" href="#">{{text}}</a></li>',
            'nextActive' => '<li class="page-item"><a class="page-link" href="{{url}}"><i class="fa fa-angle-right"></i></a></li>',
            'nextDisabled' => '',
            'prevActive' => '<li class="page-item"><a class="page-link" href="{{url}}"><i class="fa fa-angle-left"></i></a></li>',
            'prevDisabled' => '',
        ]);

        if ($this->Paginator->total() <= 1) {
            return '';
        }

        $paginate = '<ul class="pagination">';
        $paginate .= $this->Paginator->prev();
        $paginate .= $this->Paginator->numbers();
        $paginate .= $this->Paginator->next();

        $paginate .= '</ul>';

        return $paginate;
    }

    public function maskString($string, $digit = 4)
    {
        $pad = floor((strlen($string) - $digit) / 2);
        return substr($string, 0, $pad) . str_repeat('*', $digit) . substr($string, - (strlen($string) - ($pad + $digit)));
    }


}
