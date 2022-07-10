<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="index, follow"/>
    <?= $this->Html->meta(
        'keywords',
        'azzury,persib,air mineral'
    );
    ?>
    <?= $this->Html->meta(
        'description',
        'deskripsi azzury'
    );
    ?>
    <?= $this->Html->meta(
        'author',
        'Azzury'
    );?>
    <title><?= Cake\Core\Configure::read('SiteName'); ?> - <?= $this->fetch('title') ?></title>


    <?= $this->Html->css([
        '/front-assets/css/reset',
        '/front-assets/css/plugins',
        '/front-assets/css/style',
        '/front-assets/css/color',
    ]); ?>

    <?= $this->Html->meta(
        'favicon.ico',
        '/front-assets/images/favicon.ico',
        ['type' => 'icon']
    ); ?>

    <?= $this->fetch('meta'); ?>
    <?= $this->fetch('css'); ?>
</head>

<body>
	<div class="loader-wrap">
		<div class="loader-inner">
			<div class="loader-inner-cirle"></div>
		</div>
	</div>
	<div id="main">
		<?= $this->element('Partial/header'); ?>
		<div id="wrapper">
			<div class="content">
				<?= $this->fetch('content') ?>
			</div>
		</div>
		<?= $this->element('Partial/footer'); ?>
        <!--register form -->
        <div class="main-register-wrap modal">
            <div class="reg-overlay"></div>
            <div class="main-register-holder tabs-act">
                <div class="main-register fl-wrap  modal_main">
                    <div class="main-register_title">Welcome to <span><strong><?= \Cake\Core\Configure::read('SiteName');?></strong><strong>.</strong></span></div>
                    <div class="close-reg"><i class="fal fa-times"></i></div>
                    <ul class="tabs-menu fl-wrap no-list-style">
                        <li class="current"><a href="#tab-1"><i class="fal fa-sign-in-alt"></i> Login</a></li>
                    </ul>
                    <!--tabs -->
                    <div class="tabs-container">
                        <div class="tab">
                            <!--tab -->
                            <div id="tab-1" class="tab-content first-tab">
                                <div class="custom-form">
                                    <?php
                                    $this->Html->script(['https://www.google.com/recaptcha/api.js'],['block' => true]);
                                    ?>
                                    <?php
                                    echo $this->Flash->render();
                                    $this->Form->setConfig('errorClass', 'is-invalid');
                                    ?>
                                    <?= $this->Form->create(null,[
                                        'url' => [
                                            'controller' => 'Login',
                                            'action' => 'index'
                                        ],
                                        'id' => 'form-login',
                                        'templates' => [
                                            'error' => '<div class="invalid-feedback">{{content}}</div>',
                                            'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
                                            'inputContainer' => '<div class="input form-group">{{content}}</div>',
                                            'inputContainerError' => '<div class="input  form-group has-danger">{{content}} {{error}}</div>',
                                        ],
                                        'class' => 'kt-login-v2__form kt-form',
                                        'novalidate',
                                        'autofocus' => false,
                                    ]); ?>
                                    <label>Username or Email Address <span>*</span> </label>
                                    <?php echo  $this->Form->control('email',['placeholder' => 'Username or email', 'label' => false]);?>
                                    <label >Password <span>*</span> </label>
                                    <?php echo  $this->Form->control('password',[
                                        'placeholder' =>__('Password'),
                                        'label' => false,
                                        'autocomplete' => 'off',
                                        'type' => 'password'
                                    ])
                                    ;?>
                                    <button
                                        class="btn float-btn color2-bg g-recaptcha"
                                        data-sitekey="<?= \Cake\Core\Configure::read('GoogleCaptcha.siteKey'); ?>"
                                        data-badge = "inline"
                                        data-callback="onSubmit">
                                        <?php echo __('Sign In'); ?>
                                        <i class="fas fa-caret-right"></i>
                                    </button>
                                    <div class="clearfix"></div>
                                    <?= $this->Form->end(); ?>
                                </div>
                            </div>
                            <!--tab end -->
                        </div>
                        <!--tabs end -->
                        <div class="wave-bg">
                            <div class='wave -one'></div>
                            <div class='wave -two'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--register form end -->
		<a class="to-top"><i class="fas fa-caret-up"></i></a>
	</div>
	<?= $this->Html->script([
		'/front-assets/js/jquery.min.js',
		'/front-assets/js/plugins.js',
		'/front-assets/js/scripts.js',
		'/front-assets/js/pjs.js'
	]); ?>

    <?php $this->append('css'); ?>
    <style>
        div.grecaptcha-badge{
            margin : 0 auto 30px auto !important;
        }
    </style>
    <?php $this->end(); ?>

    <?php $this->append('script'); ?>
    <script>
        var onSubmit = function(response) {
            document.getElementById("form-login").submit();
        };
    </script>
    <?php $this->end(); ?>

    <?= $this->fetch('script') ?>
</body>

</html>
