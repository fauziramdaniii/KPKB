<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \Member\View\AppView $this
 */
?>

<?php
    $activeIndex = $this->getRequest()->getParam('action') == 'index' ? 'active' : '';
    $activePassword = $this->getRequest()->getParam('action') == 'changePassword' ? 'active' : '';
?>


<!--Begin:: App Aside-->
<div class="kt-grid__item kt-app__toggle kt-app__aside kt-app__aside--sm kt-app__aside--fit" id="kt_profile_aside">

    <!--Begin:: Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <div class="kt-widget kt-widget--general-1">
                <div class="kt-media kt-media--brand kt-media--md kt-media--circle">
                    <?= $this->Helper->avatar(true); ?>
                </div>
                <div class="kt-widget__wrapper">
                    <div class="kt-widget__label">
                        <a href="#" class="kt-widget__title">
                            <?= $this->Session->read('Auth.Customers.first_name'); ?>
                            <?= $this->Session->read('Auth.Customers.last_name'); ?>
                        </a>
                        <!-- <span class="kt-widget__desc">
                            Description
                        </span> -->
                    </div>

                </div>
            </div>
        </div>
        <div class="kt-portlet__separator"></div>
        <div class="kt-portlet__body">
            <ul class="kt-nav kt-nav--bolder kt-nav--fit-ver kt-nav--v4" role="tablist">
                <li class="kt-nav__item <?= $activeIndex; ?>">
                    <a class="kt-nav__link <?= $activeIndex; ?>" href="<?= $this->Url->build(['action' => 'index']); ?>" role="tab">
                        <span class="kt-nav__link-icon"><i class="flaticon2-user"></i></span>
                        <span class="kt-nav__link-text"><?= __( 'Personal Information'); ?></span>
                    </a>
                </li>

                <li class="kt-nav__item <?= $activePassword; ?>">
                    <a class="kt-nav__link <?= $activePassword; ?>" href="<?= $this->Url->build(['action' => 'changePassword']); ?>" role="tab">
                        <span class="kt-nav__link-icon"><i class="flaticon2-settings"></i></span>
                        <span class="kt-nav__link-text"><?= __( 'Change Password'); ?></span>
                    </a>
                </li>

            </ul>
        </div>
        <?php /*
                    <div class="kt-portlet__separator"></div>
                    <div class="kt-portlet__body">
                        <ul class="kt-nav kt-nav--bolder kt-nav--fit-ver kt-nav--v4" role="tablist">
                            <li class="kt-nav__item">
                                <a class="kt-nav__link" href="#" role="tab" data-toggle="kt-tooltip" data-placement="right" title="This feature is coming soon!">
                                    <span class="kt-nav__link-icon"><i class="flaticon2-chart2"></i></span>
                                    <span class="kt-nav__link-text">Email Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    */ ?>
    </div>

    <!--End:: Portlet-->

</div>
<!--End:: App Aside-->
