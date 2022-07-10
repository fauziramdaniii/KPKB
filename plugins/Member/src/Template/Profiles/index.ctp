<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \Member\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $customer
 */
?>

<div class="subheader py-6 py-lg-8 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Profiles'); ?></h5>
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
                    <span class="card-label"><?= __('Personal Information');?></span>
                </h3>
            </div>
            <?php
                echo $this->Form->create($customer, ['class' => 'kt-form kt-form--label-right', 'type' => 'file', 'id' => 'kt_profile_form', 'templates' => 'Member.simple_form']);
                $this->Form->setConfig('errorClass', 'is-invalid');
            ?>
            <div class="card-body">

                <?= $this->Flash->render() ?>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __('Avatar');?></label>
                    <div class="col-lg-9 col-xl-6">

                        <div class="image-input  image-input-outline" id="kt_user_edit_avatar" style="background-image: url('<?= $this->Url->build('/member-assets/media/users/blank.png'); ?>'')">
                            <div class="image-input-wrapper" style="background-image: url('<?= $this->Helper->avatar_url(); ?>')"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="profile_avatar_remove" />
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'First Name'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('first_name', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'placeholder' => __( 'First Name'),
                            'autocomplete' => 'off'
                        ]); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Last Name'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('last_name', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'placeholder' => __( 'Last Name'),
                            'autocomplete' => 'off'
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Citizenship'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('country_id', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'placeholder' => __( 'Citizenship'),
                            'autocomplete' => 'off',
                            'default' => 100
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Nomor KTP'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('identity_number', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'placeholder' => __( 'Identity Number'),
                            'autocomplete' => 'off'
                        ]); ?>
                    </div>
                </div>

                <?php /*
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'NPWP'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('npwp', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'placeholder' => __( 'Nomor Pokok Wajib Pajak'),
                            'autocomplete' => 'off'
                        ]); ?>
                    </div>
                </div>
                */ ?>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Date of Birthday'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('dob', [
                            'class' => 'form-control datepicker',
                            'label' => false,
                            'div' => false,
                            'placeholder' => __( 'Date of Birthday'),
                            'autocomplete' => 'off',
                            'type' => 'text'
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Religion'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('religion_id', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'placeholder' => __( 'Religion'),
                            'autocomplete' => 'off',
                            'empty' => '--'
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Education'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('education_id', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'placeholder' => __( 'Education'),
                            'autocomplete' => 'off',
                            'empty' => '--'
                        ]); ?>
                    </div>
                </div>

                <?php /*
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Name of Inheritance'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('heir', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'placeholder' => __( 'Name of Inheritance'),
                            'autocomplete' => 'off'
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Inheritance Relation'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('heir_relation', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'placeholder' => __( 'Inheritance Relation'),
                            'autocomplete' => 'off'
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Inheritance Address'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('heir_address', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'placeholder' => __( 'Inheritance Address'),
                            'autocomplete' => 'off'
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Inheritance Citizenship'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('heir_country_id', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'placeholder' => __( 'Inheritance Citizenship'),
                            'autocomplete' => 'off',
                            'default' => 100,
                            'options' => $countries
                        ]); ?>
                    </div>
                </div>

                */ ?>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Contact Phone'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                            <?= $this->Form->control('phone', [
                                'class' => 'form-control',
                                'label' => false,
                                'div' => false,
                                'error' => false,
                                'placeholder' => __( 'Phone'),
                                'autocomplete' => 'off'
                            ]); ?>
                            <?php if ($error = $customer->getError('phone')) : ?>
                                <div class="invalid-feedback"><?= array_values($error)[0]; ?></div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Email Address'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                            <?= $this->Form->control('email', [
                                'class' => 'form-control',
                                'label' => false,
                                'div' => false,
                                'error' => false,
                                'placeholder' => __( 'Email'),
                                'readonly' => true,
                                'autocomplete' => 'off'
                            ]); ?>
                            <?php if ($error = $customer->getError('email')) : ?>
                                <div class="invalid-feedback"><?= array_values($error)[0]; ?></div>
                            <?php endif; ?>
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

<?php $this->append('script'); ?>
<script>

    // Class definition
    var KTUserEdit = function () {
        // Base elements
        var avatar;

        var initUserForm = function() {
            avatar = new KTImageInput('kt_user_edit_avatar');
        }

        return {
            // public functions
            init: function() {
                initUserForm();
            }
        };
    }();

    $(document).ready(function() {
        KTUserEdit.init();
        $(".datepicker").datepicker({
            format: "yyyy-mm-dd",
            startView: "years",
            autoclose: true,
        });
    });
</script>
<?php $this->end(); ?>

