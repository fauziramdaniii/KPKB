<?php
namespace AdminPanel\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\Utility\Inflector;
use Knp\Menu\MenuItem;

/**
 * @property \Knp\Menu\MenuItem $_menu
 * Menu helper
 */
class TopMenuHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    protected $_menu = null;

    protected $_index = [];

    protected $_hasChildOption = [];

    protected $_option = [];

    protected $_childOption = [];

    /**
     * @var array
     */
    public $helpers = ['Url', 'Icings/Menu.Menu'];


    public function create($name, $options = [])
    {
        $default = [
            'templates' => [
                'menu' => '<ul{{attrs}}>{{items}}</ul>',
                'nest' => '<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right"><ul{{attrs}}>{{items}}</ul></div>',
                'item' => '<li{{attrs}}>{{link}}{{nest}}</li>',
                'link' => '<a href="{{url}}"{{attrs}}><i class="{{icon}}">{{span}}</i><span class="kt-menu__link-text">{{label}}</span>{{arrow}}</a>',
                'text' => '<span{{attrs}}>{{label}}</span>'
            ],
            'menuAttributes' => [
                'class' => 'kt-menu__nav  kt-menu__nav--dropdown-submenu-arrow'
            ],
            'ancestorClass' => 'kt-menu__item--open m-menu__item--expanded',
            'branchClass' => 'kt-menu__item--submenu kt-menu__item--rel',
            //'currentClass' => 'kt-menu__item--active'
        ];
        if ($options !== []) {
            $default += $options;
        }
        $this->_menu = $this->Menu->create($name, $default);
        return $this;
    }



    public function setOption(array $options)
    {
        $this->_option = $options;
        return $this;
    }

    public function setChildOption(array $options)
    {
        $this->_childOption = $options;
        return $this;
    }

    public function setHasChildOption(array $options)
    {
        $this->_hasChildOption = $options;
        return $this;
    }

    public function add($menu = [], MenuItem $item = null)
    {
        foreach($menu as $key => $val) {
            $hasChild = isset($val['children']) && is_array($val['children']) && count($val['children']) > 0;
            if ($item) {
                $item->addChild(__($val['name']), [
                        'uri' => null,
                        'attributes' => [
                            'class' => 'kt-menu__item  kt-menu__item--parent',
                            'aria-haspopup' => 'true'
                        ],
                        'textAttributes' => [
                            'class' => 'kt-menu__link'
                        ],
                        'templates' => [
                            'text' => '<span{{attrs}}><span class="kt-menu__link-text"> {{label}}</span></span>'
                        ]
                    ]
                );
                $_menu = $item->addChild(__($val['name']), array_replace_recursive($hasChild ? $this->_hasChildOption : $this->_childOption, [
                    'uri' => $val['url'],
                    'templateVars' => [
                        'icon' => $val['icon']
                    ]
                ]));
            } else {
                $_menu = $this->_menu->addChild(__($val['name']), array_replace_recursive(($hasChild ? $this->_hasChildOption : $this->_option), [
                    'uri' => $val['url'],
                    'templateVars' => [
                        'icon' => $val['icon']
                    ]
                ]));

            }

            if ($hasChild) {
                $this->add($val['children'], $_menu);
            }
        }
        return $this;
    }

    public function getMenu()
    {
        return $this->_menu;
    }


    public function render()
    {
        return $this->Menu->render();
    }

}
