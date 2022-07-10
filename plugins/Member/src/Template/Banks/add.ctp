<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \Member\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $$transfer
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $customer_banks
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
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Bank'); ?></h5>
                <!--end::Page Title-->

                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="<?= $this->Url->build(['action' => 'index']); ?>" class="text-muted"><?= __('List Bank'); ?></a>
                    </li>
                    <li class="breadcrumb-item">
                        <?= __('New Bank'); ?>
                    </li>
                </ul>
                <!--end::Breadcrumb-->

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
                <div class="card-title">
                    <h3 class="card-label"><?= __('Bank');?></h3>
                </div>

                <div class="card-toolbar">
                    <a href="<?= $this->Url->build(['action' => 'index']); ?>" class="btn btn-light-primary font-weight-bold">
                        <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/keen/releases/2020-10-07-041015/theme/demo1/dist/../src/media/svg/icons/Layout/Layout-left-panel-2.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M10,4 L21,4 C21.5522847,4 22,4.44771525 22,5 L22,7 C22,7.55228475 21.5522847,8 21,8 L10,8 C9.44771525,8 9,7.55228475 9,7 L9,5 C9,4.44771525 9.44771525,4 10,4 Z M10,10 L21,10 C21.5522847,10 22,10.4477153 22,11 L22,13 C22,13.5522847 21.5522847,14 21,14 L10,14 C9.44771525,14 9,13.5522847 9,13 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M10,16 L21,16 C21.5522847,16 22,16.4477153 22,17 L22,19 C22,19.5522847 21.5522847,20 21,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,17 C9,16.4477153 9.44771525,16 10,16 Z" fill="#000000"/>
                                        <rect fill="#000000" opacity="0.3" x="2" y="4" width="5" height="16" rx="1"/>
                                    </g>
                                </svg>
                            <!--end::Svg Icon-->
                            </span>
                        <?= __( 'List Bank'); ?></a>
                </div>
            </div>


            <?php
            echo $this->Form->create($customerBank, ['class' => 'kt-form kt-form--label-right', 'type' => 'file', 'id' => 'kt_profile_form', 'templates' => 'Member.simple_form']);
            $this->Form->setConfig('errorClass', 'is-invalid');
            ?>
            <div class="card-body">

                <?= $this->Flash->render() ?>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Bank'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('bank_id', [
                            'type' => 'select',
                            'options' => $banks,
                            'empty' => __( 'Please Select Bank'),
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off'
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'City'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('city', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off'
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Branch'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('branch', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off'
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Account Name'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('account_name', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off'
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Account Number'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('account_number', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off'
                        ]); ?>
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



