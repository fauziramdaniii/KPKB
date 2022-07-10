<?php
    $this->Html->script(['https://www.google.com/recaptcha/api.js'],['block' => true]);
?>

<div class="kt-login-v2__container">
    <div class="text-center mt-5 p-5">
        <?= $this->Html->image('/admin-assets/media/logos/logo.png', array('width' => '100%'));?>
    </div>
    <div class="kt-login-v2__title">
        <h3><?= __('SIGN UP'); ?></h3>
        <p><?= __('Create an new account by entering the information below.'); ?></p>
    </div>

    <?= $this->Form->create($customer,[
        'id' => 'form-register',
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
    <div class="row">
        <div class="col-lg-12" style="margin-top: 40px; margin-bottom: 20px">
            <h4>Data Pribadi</h4>
        </div>
        <div class="col-lg-12">
            <?php
                $reff = ['class' => 'form-control', 'placeholder' => 'Sponsor', 'label' => false];
                if(!empty($this->request->getSession()->read('Refferal'))){
                    $reff['value'] = $this->request->getSession()->read('Refferal');
                    $reff['readonly'] = true;
                }
            ?>
            <?php echo  $this->Form->control('refferal',$reff);?>
        </div>
        <?php /*
        <div class="col-lg-12">
            <?php
            $sponsor = ['class' => 'form-control', 'placeholder' => 'Upline', 'label' => false];
            if(!empty($this->request->getSession()->read('Upline'))){
                $sponsor['value'] = $this->request->getSession()->read('Upline');
                $sponsor['readonly'] = true;
            }
            ?>
            <?php echo  $this->Form->control('upline', $sponsor);?>
        </div>
        */ ?>
        <div class="col-lg-6">
            <?php echo  $this->Form->control('first_name',['class' => 'form-control', 'placeholder' => __('First Name'), 'label' => false]);?>
        </div>
        <div class="col-lg-6">
            <?php echo  $this->Form->control('last_name',['class' => 'form-control', 'placeholder' => __('Last Name'), 'label' => false]);?>
        </div>
        <div class="col-lg-6">
            <?php echo  $this->Form->control('phone',['class' => 'form-control', 'placeholder' => __('Phone'), 'label' => false]);?>
        </div>
        <div class="col-lg-6">
            <?php echo  $this->Form->control('password', [
                'class' => 'form-control',
                'placeholder' => __('Password'),
                'id' => 'pwd',
                'autocomplete' => 'off',
                'label' => false,
                'type' => 'password',
                'templates' => [
                    'error' => '<div class="invalid-feedback">{{content}}</div>'
                ],
            ])
            ;?>
        </div>
        <div class="col-lg-12">
            <?php echo  $this->Form->control('email',['class' => 'form-control', 'placeholder' => __('Email'), 'label' => false]);?>
        </div>
        <div class="col-lg-12">
            <?php echo  $this->Form->control('identity_number', ['class' => 'form-control', 'placeholder' => __('Nomor KTP'), 'label' => false]);?>
        </div>
        <div class="col-lg-12">
            <?php echo  $this->Form->control('npwp', ['class' => 'form-control', 'placeholder' => __('Nomor Pokok Wajib Pajak'), 'label' => false]);?>
        </div>
        <div class="col-lg-12">
            <label><?= __('Citizenship'); ?></label>
            <?php echo  $this->Form->control('country_id', ['class' => 'form-control', 'placeholder' => __('Citizenship'), 'label' => false, 'default' => 100]);?>
        </div>
        <div class="col-lg-12">
            <?php echo  $this->Form->control('dob', [
                'type' => 'text',
                'class' => 'form-control datepicker',
                'placeholder' => __('Date of birthday'),
                'label' => false,
                'autocomplete' => 'off'
            ]
            );?>
        </div>
        <div class="col-lg-12">
            <?php echo  $this->Form->control('customer_address.address',['class' => 'form-control', 'placeholder' => __('Address'), 'label' => false]);?>
        </div>
        <div class="col-lg-6">
            <?php echo  $this->Form->control('customer_address.province_id', ['id' => 'province', 'class' => 'form-control', 'placeholder' => __('Province'), 'label' => false, 'empty' => __('Province')]);?>
        </div>
        <div class="col-lg-6">
            <?php echo  $this->Form->control('customer_address.city_id', ['id' => 'city', 'class' => 'form-control', 'placeholder' => __('City'), 'label' => false, 'empty' => __('City')]);?>
        </div>

        <div class="col-lg-6">
            <?php echo  $this->Form->control('customer_address.subdistrict_id', ['id' => 'district', 'class' => 'form-control', 'placeholder' => __('District'), 'label' => false, 'empty' => __('Subdistrict')]);?>
        </div>
        <div class="col-lg-6">
            <?php echo  $this->Form->control('customer_address.zip', ['class' => 'form-control', 'placeholder' => __('Zip'), 'label' => false]);?>
        </div>
        <div class="col-lg-12">
            <label><?= __('Religion'); ?></label>
            <?php echo  $this->Form->control('religion_id', ['class' => 'form-control', 'placeholder' => __('Religion'), 'label' => false, 'empty' => '--']);?>
        </div>
        <div class="col-lg-12">
            <label><?= __('Education'); ?></label>
            <?php echo  $this->Form->control('education_id', ['class' => 'form-control', 'placeholder' => __('Education'), 'label' => false, 'empty' => '--']);?>
        </div>
        <div class="col-lg-12" style="margin-top:40px; margin-bottom: 20px">
            <h4>Data Ahli Waris</h4>
        </div>
        <div class="col-lg-6">
            <?php echo  $this->Form->control('heir', ['class' => 'form-control', 'placeholder' => __('Name of Inheritance'), 'label' => false]);?>
        </div>
        <div class="col-lg-6">
            <?php echo  $this->Form->control('heir_relation' ,['class' => 'form-control', 'placeholder' => __('Inheritance Relation'), 'label' => false]);?>
        </div>

        <div class="col-lg-12">
            <label><?= __('Inheritance Citizenship'); ?></label>
            <?php echo  $this->Form->control('heir_country_id', ['class' => 'form-control', 'placeholder' => __('Inheritance Citizenship'), 'label' => false, 'default' => 100, 'options' => $countries]);?>
        </div>

        <div class="col-lg-12">
            <?php echo  $this->Form->control('heir_address' ,['class' => 'form-control', 'placeholder' => __('Inheritance Address'), 'label' => false]);?>
        </div>
        <div class="col-lg-12" style="margin-top:40px; margin-bottom: 20px">
            <h4>Data Bank</h4>
        </div>
        <div class="col-lg-12">
            <?php echo  $this->Form->control('customer_bank.bank_id', ['class' => 'form-control', 'placeholder' => __('Bank'), 'label' => false, 'empty' => __('Bank')]);?>
        </div>
        <div class="col-lg-12">
            <?php echo  $this->Form->control('customer_bank.account_name', ['class' => 'form-control', 'placeholder' => __('Account Name'), 'label' => false]);?>
        </div>
        <div class="col-lg-12">
            <?php echo  $this->Form->control('customer_bank.account_number', ['class' => 'form-control', 'placeholder' => __('Account Number'), 'label' => false]);?>
        </div>
        <div class="col-lg-12" style="margin-top: 40px;">
            <div class="d-flex flex-wrap justify-content-between">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="tos" value="1" type="checkbox" <?= ($this->request->getData('tos')  ? 'checked="checked"' : '') ?>"  id="remember-me">
                    <label class="custom-control-label" for="remember-me"><?= __('I agree with the term and conditions'); ?></label>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-4 form-group">
            <button
                    class="btn btn-brand btn-block btn-elevate btn-pill my-3 g-recaptcha"
                    data-sitekey="<?= \Cake\Core\Configure::read('GoogleCaptcha.siteKey'); ?>"
                    data-badge = "inline"
                    data-callback="onSubmit">
                <?php echo __('Sign Up'); ?>
            </button>
        </div>

    </div>

    <?= $this->Form->end(); ?>


    <div class="kt-separator kt-separator--space-lg  kt-separator--border-solid"></div>


    <h3 class="kt-login-v2__desc my-4"><?= __('Already have an account?'); ?> <a href="<?= $this->Url->build(['controller' => 'Login', 'action' => 'index']); ?>"><?= __('Sign In'); ?></a>
    </h3>


</div>



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
        document.getElementById("form-register").submit();
    };

    $(document).ready(function() {
        function drawTo(target, selected, url, title, callback){
            /* make ajax request */
            $.ajax({
                url: url,
                type : 'POST',
                data : {
                    id : selected,
                    _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                },
                dataType : 'json',
                success: function(response){
                    let options = '';
                    options += '<option value="">Pilih '+title+'</option>';
                    $.each(response,function(k,v){
                        options += '<option value="'+k+'">'+v+'</option>';
                    });
                    $(target).html(options);
                    if (typeof callback === 'function') {
                        callback();
                    }
                }
            });
        }

        $(".datepicker").datepicker({
            format: "yyyy-mm-dd",
            startView: "years",
            autoclose: true,
        });

        $("#province").change(function() {
            const province_id = $(this).val();
            drawTo('#city', province_id, '<?= $this->Url->build(['action' => 'getCities']); ?>', '<?= __('City'); ?>')
        });

        $("#city").change(function() {
            drawTo('#district', $(this).val(), '<?= $this->Url->build(['action' => 'getDistricts']); ?>', '<?= __('District'); ?>')
        });
    });

</script>
<?php $this->end(); ?>
