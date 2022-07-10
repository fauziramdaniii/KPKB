<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
        <?php

        $menu = [
            [
                'name' => 'Dashboard',
                'url' => ['controller' => 'Dashboard'],
                'icon' => 'm-menu__link-icon flaticon-line-graph'
            ],
            [
                'name' => 'Users & Groups',
                'url' => '#',
                'icon' => 'm-menu__link-icon flaticon-users',
                'children' => [
                    [
                        'name' => 'List Users',
                        'url' => ['controller' => 'Users', 'action' => 'index'],
                        'icon' => 'm-menu__link-bullet m-menu__link-bullet--dot'
                    ],
                    [
                        'name' => 'List Groups',
                        'url' => ['controller' => 'Groups', 'action' => 'index'],
                        'icon' => 'm-menu__link-bullet m-menu__link-bullet--dot'
                    ],
                ]
            ],
            [
                'name' => 'Customers',
                'url' => ['controller' => 'Customers', 'action' => 'index'],
                'icon' => 'm-menu__link-icon flaticon-users',
                'children' => []
            ],
            [
                'name' => 'Configurations',
                'url' => ['controller' => 'Customers', 'action' => 'index'],
                'icon' => 'm-menu__link-icon flaticon-settings',
                'children' => [
                    [
                        'name' => 'Master Data',
                        'url' => '#',
                        'icon' => '',
                        'children' => [
                            [
                                'name' => 'Province',
                                'url' => ['controller' => 'Provinces', 'action' => 'index'],
                                'icon' => '',
                                'children' => []
                            ],
                            [
                                'name' => 'Regency',
                                'url' => ['controller' => 'Regencies', 'action' => 'index'],
                                'icon' => '',
                                'children' => []
                            ],
                            [
                                'name' => 'District',
                                'url' => ['controller' => 'Districts', 'action' => 'index'],
                                'icon' => '',
                                'children' => []
                            ],
                            [
                                'name' => 'Village',
                                'url' => ['controller' => 'Villages', 'action' => 'index'],
                                'icon' => '',
                                'children' => []
                            ],
                        ]
                    ]
                ]
            ],
        ];

        echo $this->SideMenu->create('main')
            ->setHasChildOption([
                    'uri' => 'javascript:;',
                    'attributes' => [
                        'class' => 'm-menu__item',
                        'aria-haspopup' => 'true',
                        'data-menu-submenu-toggle' => 'hover'
                    ],
                    'linkAttributes' => [
                        'class' => 'm-menu__link m-menu__toggle'
                    ],
                    'templateVars' => [
                        'icon' => 'm-menu__link-icon flaticon-users',
                        'arrow' => '<i class="m-menu__ver-arrow la la-angle-right"></i>'
                    ],
                    'nestAttributes' => [
                        'class' => 'm-menu__subnav'
                    ],
                ]
            )
            ->setOption([
                'attributes' => [
                    'class' => 'm-menu__item',
                    'aria-haspopup' => 'true'
                ],
                'linkAttributes' => [
                    'class' => 'm-menu__link'
                ],
                'templateVars' => [
                    'icon' => ''
                ]
            ])
            ->setChildOption([
                    'attributes' => [
                        'class' => 'm-menu__item',
                        'aria-haspopup' => 'true'
                    ],
                    'linkAttributes' => [
                        'class' => 'm-menu__link'
                    ],
                    'templateVars' => [
                        'icon' => 'm-menu__link-bullet m-menu__link-bullet--dot',
                        'span' => '<span></span>'
                    ]
                ]
            )
            ->add($menu)
            ->render();
        ?>
    </div>

    <!-- END: Aside Menu -->
</div>

<!-- END: Left Aside -->