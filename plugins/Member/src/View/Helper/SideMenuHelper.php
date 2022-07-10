<?php
namespace Member\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\Utility\Inflector;
use Knp\Menu\MenuItem;

/**
 * @property \Knp\Menu\MenuItem $_menu
 * Menu helper
 */
class SideMenuHelper extends Helper
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
                'nest' => '<div class="menu__submenu"><span class="menu__arrow"></span><ul{{attrs}}>{{items}}</ul></div>',
                'item' => '<li{{attrs}}>{{link}}{{nest}}</li>',
                'link' => '<a href="{{url}}"{{attrs}}><span class="svg-icon menu-icon">{{icon}}</span><span class="menu-text">{{label}}</span>{{badge}}{{arrow}}</a>',
                'text' => '<span{{attrs}}>{{label}}</span>'
            ],
            'menuAttributes' => [
                'class' => 'menu-nav'
            ],
            'ancestorClass' => 'menu-item--open menu-item--here',
            'currentClass' => 'menu-item-active'
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
        if (is_array($menu)) {
            foreach($menu as $key => $val) {
                $hasChild = isset($val['children']) && is_array($val['children']) && count($val['children']) > 0;
                if ($item) {
                    $item->addChild($val['name'], [
                            'uri' => null,
                            'attributes' => [
                                'class' => 'menu-item  menu-item--parent',
                                'aria-haspopup' => 'true'
                            ],
                            'textAttributes' => [
                                'class' => 'menu-link'
                            ],
                            'templates' => [
                                'text' => '<span{{attrs}}><span class="menu-text"> {{label}}</span></span>'
                            ]
                        ]
                    );
                    $_menu = $item->addChild($val['name'], array_replace_recursive($this->_childOption, [
                        'uri' => $val['url'],
                        'templateVars' => [
                            'icon' => $val['icon'],
                            'badge' => !empty($val['badge']) ? $val['badge'] : ''
                        ]
                    ]));
                } else {
                    $_menu = $this->_menu->addChild($val['name'], array_replace_recursive(($hasChild ? $this->_hasChildOption : $this->_option), [
                        'uri' => $val['url'],
                        'templateVars' => [
                            'icon' => $val['icon'],
                            'badge' => !empty($val['badge']) ? $val['badge'] : ''
                        ]
                    ]));

                }

                if ($hasChild) {
                    $this->add($val['children'], $_menu);
                }
            }
        }



        return $this;
    }

    public function addSection($name)
    {
        $this->_menu->addChild($name, [
            'uri' => null,
            'attributes' => [
                'class' => 'menu-section'
            ],
            'textAttributes' => [
                'class' => 'menu-text'
            ],
            'templates' => [
                'text' => '<h4{{attrs}}>{{label}}</h4> <i class="menu-icon ki ki-bold-more-hor icon-md"></i>'
            ]
        ]);
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
