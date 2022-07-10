<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface|\Cake\Collection\CollectionInterface $customer
 */
?>

<?php
$this->Html->script(['/member-assets/js/showpass.js'],['block' => true]);
?>

<div class="subheader py-6 py-lg-8 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Change Password');?></h5>
                <!--end::Page Title-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center flex-wrap">
        </div>
    </div>
</div>

<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">

        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="card-label"><?= __('Change Password');?></span>
                </h3>
            </div>
            <?php
                echo $this->Form->create($customer, ['class' => 'form', 'id' => 'kt_form_1', 'templates' => 'Member.simple_form']);
                $this->Form->setConfig('errorClass', 'is-invalid');
            ?>
            <div class="card-body">

                <?= $this->Flash->render() ?>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Current Password'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group show-hide-password">
                            <?= $this->Form->control('current_password', [
                                'class' => 'form-control',
                                'label' => false,
                                'div' => false,
                                'type' => 'password',
                                'value' => '',
                                'placeholder' => __( 'Current Password'),
                                'autocomplete' => 'off'
                            ]); ?>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="la la-eye"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'New Password'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group show-hide-password">
                            <?= $this->Form->control('password', [
                                'class' => 'form-control',
                                'label' => false,
                                'div' => false,
                                'type' => 'password',
                                'value' => '',
                                'placeholder' => __( 'New Password'),
                                'autocomplete' => 'off'
                            ]); ?>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="la la-eye"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Repeat Password'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group show-hide-password">
                            <?= $this->Form->control('repeat_password', [
                                'class' => 'form-control',
                                'label' => false,
                                'div' => false,
                                'type' => 'password',
                                'value' => '',
                                'placeholder' => __( 'Repeat Password'),
                                'autocomplete' => 'off'
                            ]); ?>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="la la-eye"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2"><?= __('Submit');?></button>
                <button type="reset" class="btn btn-secondary"><?= __('Cancel');?></button>
            </div>
            <?= $this->Form->end(); ?>
        </div>

    </div>
</div>
