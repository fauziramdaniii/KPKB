
<div class="kt-login-v2__container">
    <div class="text-center mt-5">
        <?= $this->Html->image('/admin-assets/media/logos/logo.png');?>
    </div>
    <div class="kt-login-v2__title">
        <h3><?= __('Reset Password'); ?></h3>
    </div>

    <?php if(@$customer):?>
        <?= $this->Form->create($customer,[
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
        <?php
            echo $this->Flash->render();
            $this->Form->setConfig('errorClass', 'is-invalid');
        ?>

        <div class="form-group fv-plugins-icon-container">
            <?php echo  $this->Form->control('password',['class' => 'form-control form-control-solid h-auto p-6 rounded-lg', 'placeholder' => 'New Password', 'label' => false, 'autocomplete' => 'off', 'value' => '']);?>
        </div>
        <div class="form-group fv-plugins-icon-container">
            <?php echo  $this->Form->control('repeat_password',['class' => 'form-control form-control-solid h-auto p-6 rounded-lg','type' => 'password', 'placeholder' => 'Confirmation Password', 'label' => false, 'autocomplete' => 'off', 'value' => '']);?>
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-block my-4"  >
                <?php echo __('Reset Password'); ?>
            </button>
        </div>
        <?= $this->Form->end(); ?>

    <?php endif;?>



</div>


