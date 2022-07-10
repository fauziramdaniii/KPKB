
<?php $this->append('script'); ?>
<script>
    $(".k-nav__linkdemo").on("click",function(){
        swal("COMMING SOON","You have clicked on a dummy link!","warning")
    })
</script>
<?php $this->end(); ?>

<ul class="k-nav k-nav--bold k-nav--md-space k-nav--v3 k-margin-t-20 k-margin-b-20 nav nav-tabs" role="tablist">
    <li class="k-nav__item <?= $this->request->getParam('action') == 'index' ? 'k-nav__item--active' : ''; ?>">
        <?php
            echo $this->Html->link(
                '<span class="k-nav__link-icon"><i class="flaticon2-user-outline-symbol"></i></span><span class="k-nav__link-text">'.__('Acccount Information').'</span>',
                ['action' => 'index'],
                ['class' => 'k-nav__link', 'escape' =>false]
            );
        ?>
    </li>
    <li class="k-nav__item <?= $this->request->getParam('action') == 'changepass' ? 'k-nav__item--active' : ''; ?>">
        <?php
            echo $this->Html->link(
                 '<span class="k-nav__link-icon"><i class="flaticon2-lock"></i></span><span class="k-nav__link-text">'.__('Change Password').'</span>',
                ['action' => 'changepass'],
                ['class' => 'k-nav__link', 'escape' =>false]
            );
        ?>
    </li>
    <li class="k-nav__item <?= $this->request->getParam('action') == 'changeEmail' ? 'k-nav__item--active' : ''; ?>">
        <?php
            echo $this->Html->link(
                 '<span class="k-nav__link-icon"><i class="flaticon2-send"></i></span><span class="k-nav__link-text">'.__('Change Email').'</span>',
                ['action' => 'changeEmail'],
                ['class' => 'k-nav__link', 'escape' =>false]
            );
        ?>
    </li>
    <li class="k-nav__item <?= $this->request->getParam('action') == 'changephone' ? 'k-nav__item--active' : ''; ?>">
        <?php
            echo $this->Html->link(
                 '<span class="k-nav__link-icon"><i class="flaticon2-phone"></i></span><span class="k-nav__link-text">'.__('Change Phone Number').'</span>',
                ['action' => 'changephone'],
                ['class' => 'k-nav__link k-nav__linkdemo', 'escape' =>false]
            );
        ?>
    </li>
    <li class="k-nav__item <?= $this->request->getParam('action') == 'changeaddress' ? 'k-nav__item--active' : ''; ?>">
        <?php
            echo $this->Html->link(
                 '<span class="k-nav__link-icon"><i class="flaticon2-position"></i></span><span class="k-nav__link-text">'.__('Change Address').'</span>',
                ['action' => 'changeaddress'],
                ['class' => 'k-nav__link k-nav__linkdemo', 'escape' =>false]
            );
        ?>
    </li>
    <li class="k-nav__item <?= $this->request->getParam('action') == 'security' ? 'k-nav__item--active' : ''; ?>">
        <?php
            echo $this->Html->link(
                 '<span class="k-nav__link-icon"><i class="flaticon2-shield"></i></span><span class="k-nav__link-text">'.__('Security').'</span>',
                ['action' => 'security'],
                ['class' => 'k-nav__link', 'escape' =>false]
            );
        ?>
    </li>
    <li class="k-nav__item <?= $this->request->getParam('action') == 'bankaccount' ? 'k-nav__item--active' : ''; ?>">
        <?php
            echo $this->Html->link(
                 '<span class="k-nav__link-icon k-nav__linkdemo"><i class="flaticon-star"></i></span><span class="k-nav__link-text">'.__('Bank Account').'</span>',
                ['action' => 'bankaccount'],
                ['class' => 'k-nav__link', 'escape' =>false]
            );
        ?>
    </li>
    <li class="k-nav__item <?= $this->request->getParam('action') == 'languageTimezone' ? 'k-nav__item--active' : ''; ?>">
        <?php
        echo $this->Html->link(
            '<span class="k-nav__link-icon k-nav__linkdemo"><i class="flaticon-clock-2 "></i></span><span class="k-nav__link-text">'.__('Language & Timezone').'</span>',
            ['action' => 'languageTimezone'],
            ['class' => 'k-nav__link', 'escape' =>false]
        );
        ?>
    </li>
</ul>
