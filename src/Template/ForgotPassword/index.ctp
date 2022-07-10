

<?php
    $this->Html->script(['https://www.google.com/recaptcha/api.js'],['block' => true]);
?>

<?php $this->append('css'); ?>
<style>
    .grecaptcha-badge{
        margin : 0 auto 30px auto;
    }
</style>
<?php $this->end(); ?>

<div class="kt-login-v2__container">
    <div class="text-center mt-5">
        <?= $this->Html->image('/admin-assets/media/logos/logo.png');?>
    </div>
    <div class="kt-login-v2__title">
        <h3><?= __('Forgot password'); ?></h3>

        <p><?= __('To receive a new password, enter your email address below.'); ?></p>
    </div>

    <?= $this->Form->create($login,[
        'id' => 'form-reset',
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
    <div class="row">
        <div class="col-lg-12">
            <?php
                echo $this->Flash->render();
                $this->Form->setConfig('errorClass', 'is-invalid');
            ?>
        </div>
    </div>
    <div class="form-group fv-plugins-icon-container">
        <?php echo  $this->Form->control('email',['class' => 'form-control form-control-solid h-auto p-6 rounded-lg', 'placeholder' => 'Username or email', 'label' => false]);?>
        <div class="fv-plugins-message-container"></div>
    </div>

    <div class="form-group">
        <button
                class="btn btn-brand btn-block btn-elevate btn-pill my-3 g-recaptcha"
                data-sitekey="<?= \Cake\Core\Configure::read('GoogleCaptcha.siteKey'); ?>"
                data-badge = "inline"
                data-callback="onSubmit">
            <?php echo __('Submit'); ?>
        </button>
    </div>
    <?= $this->Form->end(); ?>


    <div class="kt-separator kt-separator--space-lg  kt-separator--border-solid"></div>

    <h3 class="kt-login-v2__desc my-4"><?= __('Don\'t have an account yet?'); ?> <a href="<?= $this->Url->build(['controller' => 'SignUp', 'action' => 'index']); ?>"><?= __('Create new account'); ?></a>
    </h3>


</div>




<?php $this->append('script'); ?>
<script>
    var onSubmit = function(response) {
        document.getElementById("form-reset").submit();
    };
</script>
<?php $this->end(); ?>

