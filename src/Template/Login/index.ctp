<?php
$this->Html->script(['https://www.google.com/recaptcha/api.js'], ['block' => true]);
?>

<div class="kt-login-v2__container">

    <div class="text-center mt-5 p-5">
        <a href="#">
            <?= $this->Html->image('/admin-assets/media/logos/logo.png', array('height' => '350px', 'width' => '100%')); ?>
        </a>
    </div>

    <div class="kt-login-v2__title">
        <h3><?= __('SIGN IN'); ?></h3>
    </div>

    <?= $this->Form->create($login, [
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
    <?php
    echo $this->Flash->render();
    $this->Form->setConfig('errorClass', 'is-invalid');
    ?>
    <div class="form-group fv-plugins-icon-container">
        <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
        <?php echo  $this->Form->control('email', ['class' => 'form-control form-control-solid h-auto p-6 rounded-lg', 'placeholder' => 'Username or email', 'label' => false]); ?>
        <div class="fv-plugins-message-container"></div>
    </div>
    <div class="form-group fv-plugins-icon-container">
        <div class="d-flex justify-content-between mt-n5">
            <label class="font-size-h6 font-weight-bolder text-dark pt-5"><?= __('Password'); ?></label>
            <?php /*
            <a href="<?= $this->Url->build(['controller' => 'ForgotPassword', 'action' => 'index']); ?>" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot"><?= __('Forgot password?'); ?></a>
            */ ?>
        </div>
        <?php echo  $this->Form->control('password', [
            'class' => 'form-control form-control-solid h-auto p-6 rounded-lg',
            'placeholder' => __('Password'),
            'label' => false,
            'autocomplete' => 'off',
            'type' => 'password'
        ]); ?>
        <div class="fv-plugins-message-container"></div>
    </div>

    <div class="text-center form-group">
        <button class="btn btn-brand btn-block btn-elevate btn-pill my-3 g-recaptcha" data-sitekey="<?= \Cake\Core\Configure::read('GoogleCaptcha.siteKey'); ?>" data-badge="inline" data-callback="onSubmit">
            <?php echo __('Sign In'); ?>
        </button>
    </div>
    <?= $this->Form->end(); ?>


    <div class="kt-separator kt-separator--space-lg  kt-separator--border-solid"></div>

    <h3 class="kt-login-v2__desc my-4"><?= __('Don\'t have an account yet?'); ?> <a href="<?= $this->Url->build(['controller' => 'SignUp', 'action' => 'index']); ?>"><?= __('Create new account'); ?></a>
    </h3>


</div>



<?php $this->append('css'); ?>
<style>
    div.grecaptcha-badge {
        margin: 0 auto 30px auto !important;
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