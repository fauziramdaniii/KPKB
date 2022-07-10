<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \Member\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $order_confirmation
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $banks
 * @var \AdminPanel\Model\Entity\Order $order
 */
?>

<div class="subheader py-6 py-lg-8 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Order Confirmation');?></h5>
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
                    <span class="card-label"><?= __('Order Confirmation');?></span>
                </h3>
            </div>
            <?php
            echo $this->Form->create($order_confirmation, ['class' => 'kt-form kt-form--label-right', 'type' => 'file', 'id' => 'kt_profile_form', 'templates' => 'Member.simple_form']);
            $this->Form->setConfig('errorClass', 'is-invalid');
            ?>
            <div class="card-body">
                <?= $this->Flash->render() ?>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Invoice'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('invoice', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off',
                            'disabled' => true,
                            'value' => $order->invoice
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Confirmation Date'); ?></label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="input-group date" id="kt_datetimepicker_1" data-target-input="nearest">
                            <?= $this->Form->control('confirmation_date', [
                                'type' => 'text',
                                'class' => 'form-control datetimepicker-input',
                                'label' => false,
                                'div' => false,
                                'data-target' => '#kt_datetimepicker_1',
                            ]); ?>
                            <div class="input-group-append" data-target="#kt_datetimepicker_1" data-toggle="datetimepicker">
                                <span class="input-group-text">
                                    <i class="ki ki-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Destination Transfer'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('destination_bank', [
                            'type' => 'select',
                            'options' => $bank_transfer,
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off'
                        ]); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Transfer From Bank'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('customer_bank_id', [
                            'type' => 'select',
                            'options' => $customer_banks,
                            'empty' => __( 'Please Select Bank'),
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off'
                        ]); ?>
                    </div>
                </div>



                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Amount'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('amount', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off',
                            'value' => $order->total
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Note'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('note', [
                            'type' => 'textarea',
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off'
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __('File Browser');?></label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="custom-file">
                            <?= $this->Form->control('attachment', [
                                'class' => 'custom-file-input',
                                'label' => false,
                                'div' => false,
                                'type' => 'file',
                                'id' => 'customFile'
                            ]); ?>
                            <label class="custom-file-label" for="customFile"><?= __('Choose file');?></label>
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
    jQuery(document).ready(function() {
        $('#kt_datetimepicker_1').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'YYYY-MM-DD hh:mm:ss'
        });
    });
</script>
<?php $this->end(); ?>




