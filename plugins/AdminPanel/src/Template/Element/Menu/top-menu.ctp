<!-- begin:: Brand -->
<div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
    <div class="kt-header__brand-logo">
        <a href="/">
            <img alt="Logo" src="<?= $this->Url->build('/admin-assets/media/logos/logo-white.png'); ?>" width="auto" height="60px" class="kt-header__brand-logo-default" />
            <img alt="Logo" src="<?= $this->Url->build('/admin-assets/media/logos/logo-white.png'); ?>" width="auto" height="60px" class="kt-header__brand-logo-sticky" />
        </a>
    </div>
</div>
<!-- end:: Brand -->

<!-- begin:: Topbar -->
<div class="kt-header__topbar">
    <?php
    $languages = Cake\Core\Configure::read('App.Languages');
    $language = $this->request->getParam('lang');
    $language = $language ? $language : 'en';

    ?>
    <?php /*
    <div class="kt-header__topbar-item kt-header__topbar-item--langs">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                <span class="kt-header__topbar-icon">
                    <?php echo $this->Html->image('/member-assets/media/svg/flags/' . $languages[$language]['flag']);?>
                </span>
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround">
            <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
                <?php foreach($languages as $key => $val) : ?>
                    <li class="kt-nav__item <?php echo ($this->request->getParam('lang') == $key) ? 'k-nav__item--active' : ''; ?>">
                        <a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index', 'lang' => $key]); ?>" class="kt-nav__link">
                            <span class="kt-nav__link-icon"><?php echo $this->Html->image('/member-assets/media/svg/flags/' . $val['flag']);?></span>
                            <span class="kt-nav__link-text"><?= $val['name']; ?></span>
                        </a>
                    </li>
                <?php  endforeach; ?>
            </ul>
        </div>
    </div>
    */ ?>

    <!--begin: Quick Panel Toggler -->
    <div class="kt-header__topbar-item" data-toggle="kt-tooltip" title="Sync Access" data-placement="top">
        <div class="kt-header__topbar-wrapper">
            <a href="<?= $this->Url->build(['controller' => 'groups', 'action' => 'sync']); ?>" class="kt-header__topbar-icon" id="kt_quick_panel_toggler_btn"><i class="flaticon2-refresh"></i></a>
        </div>
    </div>

    <!--end: Quick Panel Toggler -->

    <!--end: Notifications -->


    <!--begin: User -->
    <div class="kt-header__topbar-item kt-header__topbar-item--user">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="20px,10px">
            <img alt="Pic" src="<?= $this->Url->build('/admin-assets/media/users/300_21.jpg'); ?>" />
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-md">
            <div class="kt-user-card-v4 kt-user-card-v4--skin-light kt-notification-item-padding-x">
                <div class="kt-user-card-v4__avatar">

                    <!--use "kt-rounded" class for rounded avatar style-->
                    <img class="kt-rounded-" alt="Pic" src="<?= $this->Url->build('/admin-assets/media/users/300_21.jpg'); ?>" />

                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden">S</span>
                </div>
                <div class="kt-user-card-v4__name">
                    <?php echo implode(' ', [$auth_info['first_name'], $auth_info['last_name']]) ?>
                    <small><?= $auth_info['group']['name']; ?></small>
                </div>
                <div class="kt-user-card-v4__badge kt-hidden">
                    <span class="btn btn-label-primary btn-sm btn-bold btn-font-md">23 messages</span>
                </div>
            </div>
            <ul class="kt-nav kt-margin-b-10">
                <li class="kt-nav__custom kt-space-between">
                    <a href="<?= $this->Url->build(['controller' => 'users', 'action' => 'logout']); ?>" target="_blank" class="btn btn-label-brand btn-upper btn-sm btn-bold">Sign Out</a>
                </li>
            </ul>
        </div>
    </div>
    <!--end: User -->
</div>