
<?php $this->append('script'); ?>
<script>
    $(document).ready(function(){
        $('#load-notification').on('click',function(){
            $( "#list-notification" ).load( "<?= $this->Url->build(['controller' => 'Notifications', 'action' => 'list']); ?>" );
            $('.k-badge--notify').hide();
        })
    });
</script>
<?php $this->end(); ?>

<div id="k_header" class="k-header k-grid__item " data-kheader-minimize="on">
    <div class="k-header__title">
        <h3 class="k-header__title-title"><?php echo __($this->name);?></h3>
        <div class="k-header__title-breadcrumbs">
            <a href="<?= $this->Url->Build(['controller' => 'Dashboard']); ?>" class="k-header__title-breadcrumb-home"><i class="flaticon-home-2"></i></a>
            <span class="k-header__title-breadcrumb-separator"></span>
            <a href="<?= $this->Url->Build(['controller' => 'Dashboard']); ?>" class="k-header__title-breadcrumb-link"><?php echo __('Client');?></a>
            <span class="k-header__title-breadcrumb-separator"></span>
            <a href="#" class="k-header__title-breadcrumb-link"><?php echo __($this->name);?></a>
        </div>
    </div>

    <div class="k-header__topbar">
        <?php
        $languages = Cake\Core\Configure::read('App.Languages');
        $language = $this->request->getSession()->read('Auth.Clients.language');
        $language = $language ? $language : 'en';

        ?>
        <div class="k-header__topbar-item k-header__topbar-item--langs">
            <div class="k-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px -2px">
            <span class="k-header__topbar-icon">
                <img class="" src="<?= $this->Url->build('/client-assets/media/flags/' . $languages[$language]['flag']); ?>" alt="" />
            </span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim">
                <ul class="k-nav k-margin-t-10 k-margin-b-10">
                    <?php $i = 0; foreach($languages as $key => $val) : ?>
                    <li class="k-nav__item <?= ($this->request->getSession()->read('Auth.Clients.language') == $key) ? 'k-nav__item--active' : ''; ?>">
                        <a href="<?= $this->Url->build(['controller' => 'Languages', 'action' => 'index', $key]); ?>" class="k-nav__link">
                            <span class="k-nav__link-icon"><img src="<?= $this->Url->build('/client-assets/media/flags/' . $val['flag']); ?>" alt="" /></span>
                            <span class="k-nav__link-text"><?= $val['name']; ?></span>
                        </a>
                    </li>
                    <?php $i++; endforeach; ?>
                </ul>
            </div>
        </div>

        <!--end: Language bar -->

        <!--begin: Notifications -->
        <div class="k-header__topbar-item dropdown" id="load-notification">
            <div class="k-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px -2px">
                <span class="k-header__topbar-icon k-bg-brand"><i class="fa fa-bell k-font-light"></i></span>
                <?php echo ($counterUnred > 0) ? '<span class="k-badge k-badge--danger k-badge--notify">'.$counterUnred.'</span>' : '';?>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl" id="list-notification">

            </div>
        </div>

        <!--end: Notifications -->
        <div class="k-header__topbar-item k-header__topbar-item--user">
            <div class="k-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px -2px">
                <?php $avatar = $this->request->getSession()->read('Auth.Clients.avatar') != NULL ? $this->request->getSession()->read('Auth.Clients.avatar') : '300_21.jpg';?>
                <img alt="Pic" src="<?= $this->Url->build('/files/Clients/avatar/'.$avatar); ?>" class="avatar">
                <!--use below badge element instead the user avatar to display username's first letter(remove k-hidden class to display it) -->
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-md">
                <div class="k-user-card k-margin-b-50 k-margin-b-30-tablet-and-mobile" style="background-image: url(<?= $this->Url->build('/client-assets/media/misc/head_bg_sm.jpg'); ?>">
                    <div class="k-user-card__wrapper">
                        <div class="k-user-card__pic">
                            <img alt="Pic" src="<?= $this->Url->build('/files/Clients/avatar/'.$avatar); ?>" class="avatar">
                        </div>
                        <div class="k-user-card__details">
                            <div class="k-user-card__name"><?= $this->request->getSession()->read('Auth.Clients.name');?></div>
                            <div class="k-user-card__position"><?= $this->request->getSession()->read('Auth.Clients.email');?></div>
                        </div>
                    </div>
                </div>

                <ul class="k-nav k-margin-b-10">

                    <li class="k-nav__item">
                        <?= $this->Html->link('<span class="k-nav__link-icon"><i class="fa fa-money-bill-alt"></i></span><span class="k-nav__link-text">'.__('Assets').'</span>',['controller' => 'Assets', 'action' => 'index'],['class' => 'k-nav__link','escape' => false]);?>
                    </li>
                    <li class="k-nav__item">
                        <?= $this->Html->link('<span class="k-nav__link-icon"><i class="flaticon2-shield"></i></span><span class="k-nav__link-text">'.__('Verification').'</span>',['controller' => 'Verification', 'action' => 'index'],['class' => 'k-nav__link','escape' => false]);?>
                    </li>

                    <li class="k-nav__item">
                        <?= $this->Html->link('<span class="k-nav__link-icon"><i class="flaticon-bell"></i></span><span class="k-nav__link-text">'.__('Notifications').'</span>',['controller' => 'Notifications', 'action' => 'index'],['class' => 'k-nav__link','escape' => false]);?>
                    </li>

                    <li class="k-nav__item">
                        <?= $this->Html->link('<span class="k-nav__link-icon"><i class="flaticon2-gear"></i></span><span class="k-nav__link-text">'.__('Settings').'</span>',['controller' => 'Settings', 'action' => 'index'],['class' => 'k-nav__link','escape' => false]);?>
                    </li>

                    <li class="k-nav__item k-nav__item--custom k-margin-t-15">
                        <?= $this->Html->link(__('Sign Out'),['controller' => 'Account', 'action' => 'logout'],['class' => 'btn btn-outline-metal btn-hover-brand btn-upper btn-font-dark btn-sm btn-bold']);?>
                    </li>
                </ul>
            </div>
        </div>

    </div>

</div>

