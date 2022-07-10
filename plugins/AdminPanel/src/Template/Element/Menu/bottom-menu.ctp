<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
    <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
<?php
$menu = [];
foreach($menus as $k => $vals){
    $menu[$k]['name'] = $vals['name'];
    $menu[$k]['url'] = ($vals['controller'] != '') ? ['controller' => $vals['controller'],'action' => $vals['action']] : 'javascript:;';
    $menu[$k]['icon'] = $vals['icon'];
    if(is_array($vals['children'])){
        foreach($vals['children'] as $ky => $val){
            $menu[$k]['children'][$ky]['name'] = $val['name'];
            $menu[$k]['children'][$ky]['url'] = ($val['controller'] != '') ? ['controller' => $val['controller'],'action' => $val['action']]  : 'javascript:;';;
            $menu[$k]['children'][$ky]['icon'] = $val['icon'];
            if(is_array($val['children'])){
                foreach($val['children'] as $key => $value){
                    $menu[$k]['children'][$ky]['children'][$key]['name'] = $value['name'];
                    $menu[$k]['children'][$ky]['children'][$key]['url'] = ($value['controller'] != '') ? ['controller' => $value['controller'],'action' => $value['action']]  : 'javascript:;';;
                    $menu[$k]['children'][$ky]['children'][$key]['icon'] = $value['icon'];
                }
            }
        }
    }
}
?>
<?php
echo $this->TopMenu->create('main')
        ->setHasChildOption([
            'uri' => 'javascript:;',
            'attributes' => [
                'class' => 'kt-menu__item',
                'aria-haspopup' => 'true',
                'data-ktmenu-submenu-toggle' => 'hover'
            ],
            'linkAttributes' => [
                'class' => 'kt-menu__link kt-menu__toggle'
            ],
            'templateVars' => [
                'icon' => 'kt-menu__link-icon flaticon-users',
                'arrow' => '<i class="kt-menu__hor-arrow la la-angle-down"></i><i class="kt-menu__ver-arrow la la-angle-right"></i>'
            ],
            'nestAttributes' => [
                'class' => 'kt-menu__subnav'
            ],
        ])
        ->setOption([
            'attributes' => [
                'class' => 'kt-menu__item',
                'aria-haspopup' => 'true'
            ],
                'linkAttributes' => [
                'class' => 'kt-menu__link'
            ],
            'templateVars' => [
                'icon' => ''
            ]
        ])
        ->setChildOption([
            'attributes' => [
                'class' => 'kt-menu__item',
                'aria-haspopup' => 'true'
            ],
            'linkAttributes' => [
                'class' => 'kt-menu__link'
            ],
            'templateVars' => [
                'icon' => 'kt-menu__link-bullet kt-menu__link-bullet--line',
                'span' => '<span></span>'
            ]
        ])
        ->add($menu)
        ->render();
?>
    </div>
</div>