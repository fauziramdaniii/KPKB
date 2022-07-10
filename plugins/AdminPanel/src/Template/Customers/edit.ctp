<?php
/**
 * @var \App\View\AppView $this
 * @var \AdminPanel\Model\Entity\Customer $customer
 */
?>
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Title Page Menu</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <?= $this->Breadcrumb->display($BreadCrumbCrumbs);?>
            </div>
        </div>
    </div>
</div>
<!-- end:: Subheader -->

<!-- begin:: Content -->
<div class="kt-container  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title"><?= __('Edit Customer') ?></h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <a href="<?= $this->Url->build(['action' => 'editBank', $customer->id]); ?>" class="btn btn-default btn-bold btn-upper btn-font-sm">
                                <i class="flaticon-edit"></i>
                                <?= __('Edit Bank Account') ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?= $this->Form->create($customer,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate']); ?>
                <div class="kt-portlet__body">
                    <?php
                    echo $this->Flash->render();
                    $default_class = 'form-control';
                    $options = ['1' => 'Active', '2' => 'Blocked'] ;
                    $this->Form->setConfig('errorClass', 'is-invalid');
                                echo $this->Form->control('username',['class' => $default_class, 'readonly' => true]);
                                echo $this->Form->control('refferal_id', ['type' => 'text','class' => 'form-control', 'disabled' => true, 'value' => $customer->refferal_customer ? $customer->refferal_customer->username : '']);
                                echo $this->Form->control('email',['class' => $default_class, 'readonly' => true]);
                                echo $this->Form->control('first_name',['class' => $default_class]);
                                echo $this->Form->control('last_name',['class' => $default_class]);
                                echo $this->Form->control('identity_number',['class' => $default_class]);
                                echo $this->Form->control('npwp',['class' => $default_class]);
                                echo $this->Form->control('dob',['class' => $default_class . ' datepicker', 'type' => 'text', 'value' => $this->getRequest()->getData('dob', $customer->dob ? $customer->dob->format('Y-m-d') : '')]);
                                echo $this->Form->control('religion_id',['class' => $default_class, 'empty' => '--']);
                                echo $this->Form->control('education_id',['class' => $default_class, 'empty' => '--']);
                                echo $this->Form->control('country_id',['class' => $default_class]);
                                echo $this->Form->control('phone',['class' => $default_class]);
                                if (in_array($customer->is_active, [1, 2])) {
                                    echo $this->Form->control('is_active', ['class' => $default_class, 'options' => $options, 'empty' => '--']);
                                }
                                echo $this->Form->control('customer_type_id',['class' => $default_class, 'options' => $customer_types]);
                                echo $this->Form->control('heir',['class' => $default_class]);
                                echo $this->Form->control('heir_relation',['class' => $default_class]);
                                echo $this->Form->control('heir_address',['class' => $default_class]);
                                echo $this->Form->control('heir_country_id',['class' => $default_class, 'options' => $countries]);
                                echo '<hr>';
                                echo $this->Form->control('password', [
                                    'class' => $default_class,
                                    'type' => 'password',
                                    'value' => '',
                                    'placeholder' => __('Password Baru'),
                                    'autocomplete' => 'off'
                                ]);
                    ?>

                </div>

                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>


<?php $this->append('script'); ?>
<script>
    $('select').selectpicker();
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        startView: "years",
        autoclose: true,
    });
</script>
<?php $this->end(); ?>

