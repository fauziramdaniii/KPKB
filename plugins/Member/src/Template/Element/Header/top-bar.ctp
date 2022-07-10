<?php
/**
 * @var \Member\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $customer
 */
?>


<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
</div>
<!--begin::Topbar-->
<div class="topbar">
    <!--begin::Languages-->
    <div class="dropdown mr-1">

        <?php
            $languages = Cake\Core\Configure::read('App.Languages');
            $language = $this->request->getParam('lang');
            $language = $language ? $language : 'en';
        ?>

        <?php /*
        <!--begin::Toggle-->
        <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
            <div class="btn btn-icon btn-clean btn-dropdown btn-lg">
                <?php echo $this->Html->image('/member-assets/media/svg/flags/' . $languages[$language]['flag'], ['class' => 'h-20px w-20px rounded-sm']);?>
            </div>
        </div>
        <!--end::Toggle-->
        <!--begin::Dropdown-->
        <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
            <!--begin::Nav-->
            <ul class="navi navi-hover py-4">
                <!--begin::Item-->
                <?php foreach($languages as $key => $val) : ?>
                    <li class="navi-item  <?php echo ($this->request->getParam('lang') == $key) ? 'k-nav__item--active' : ''; ?>">
                        <a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index', 'lang' => $key]); ?>" class="navi-link">
                        <span class="symbol symbol-20 mr-3">
                            <?php echo $this->Html->image('/member-assets/media/svg/flags/' . $val['flag']);?>
                        </span>
                            <span class="navi-text"><?= $val['name']; ?></span>
                        </a>
                    </li>
                <?php  endforeach; ?>
                <!--end::Item-->
            </ul>
            <!--end::Nav-->
        </div>
        */ ?>
        <!--end::Dropdown-->
        <div class="topbar-item ml-4">
            <div class="btn btn-icon btn-light-primary h-40px w-40px p-0" id="kt_quick_user_toggle">
                <img src="<?= $this->Helper->avatar_url(true); ?>" class="h-30px align-self-end" alt="" />
            </div>
        </div>
    </div>
    <!--end::Languages-->
</div>


<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0"><?= __('User Profile');?> </h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <div class="symbol-label" style="background-image:url('<?= $this->Helper->avatar_url(true); ?>')"></div>
                <i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <span style="font-weight: 600;font-size: 16px"><?= $this->Session->read('Auth.Customers.username'); ?></span>
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                    <?= ucfirst($this->Session->read('Auth.Customers.first_name')); ?>
                    <?= ucfirst($this->Session->read('Auth.Customers.last_name')); ?>
                </a>

                <div class="navi mt-1">
                    <a href="#" class="navi-item">
                        <span class="navi-link p-0 pb-2">
                            <span class="navi-icon mr-1">
                                <span class="svg-icon svg-icon-lg svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                            <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <span class="navi-text text-muted text-hover-primary"><?= $this->Session->read('Auth.Customers.email'); ?></span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Separator-->
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <!--end::Separator-->
        <!--begin::Nav-->
        <div class="navi navi-spacer-x-0 p-0">
            <!--begin::Item-->
            <a href="<?= $this->Url->build([
                'controller' => 'Profiles',
                'action' => 'index'
            ]); ?>" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
                            <span class="svg-icon svg-icon-md svg-icon-danger">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Adress-book2.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z" fill="#000000" opacity="0.3" />
                                        <path d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold"><?= __('Change Profile');?></div>
                        <div class="text-muted"><?= __('Profile info');?></div>
                    </div>
                </div>
            </a>
            <!--end:Item-->
            <!--begin::Item-->
            <a href="<?= $this->Url->build([
                'controller' => 'Profiles',
                'action' => 'ChangePassword'
            ]); ?>" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
                            <span class="svg-icon svg-icon-md svg-icon-success">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                        <path d="M14.5,11 C15.0522847,11 15.5,11.4477153 15.5,12 L15.5,15 C15.5,15.5522847 15.0522847,16 14.5,16 L9.5,16 C8.94771525,16 8.5,15.5522847 8.5,15 L8.5,12 C8.5,11.4477153 8.94771525,11 9.5,11 L9.5,10.5 C9.5,9.11928813 10.6192881,8 12,8 C13.3807119,8 14.5,9.11928813 14.5,10.5 L14.5,11 Z M12,9 C11.1715729,9 10.5,9.67157288 10.5,10.5 L10.5,11 L13.5,11 L13.5,10.5 C13.5,9.67157288 12.8284271,9 12,9 Z" fill="#000000"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold"><?= __('Change Password');?></div>
                        <div class="text-muted"><?= __('Access Account');?></div>
                    </div>
                </div>
            </a>
            <!--end:Item-->
            <!--begin::Item-->
            <span class="navi-item mt-2">
                <span class="navi-link">
                    <a href="<?= $this->Url->build([
                        'controller' => 'Profiles',
                        'action' => 'logout'
                    ]); ?>" class="btn btn-sm btn-light-primary font-weight-bolder py-3 px-6"><?= __('Sign Out');?></a>
                </span>
            </span>
            <!--end:Item-->
        </div>
        <!--end::Nav-->
    </div>
    <!--end::Content-->
</div>
