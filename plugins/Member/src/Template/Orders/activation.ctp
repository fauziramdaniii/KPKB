<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \Member\View\AppView $this
 * @var \AdminPanel\Model\Entity\Order $order
 * @var \AdminPanel\Model\Entity\Order $orderEntity
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
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Product Activation');?></h5>
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
                    <span class="card-label"><?= __('Product Activation');?></span>
                </h3>
            </div>
            <?php
            echo $this->Form->create($card, ['class' => 'kt-form kt-form--label-right', 'type' => 'file', 'id' => 'kt_profile_form', 'templates' => 'Member.simple_form']);
            $this->Form->setConfig('errorClass', 'is-invalid');
            ?>
            <div class="card-body">
                <?= $this->Flash->render() ?>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Product Serial'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('serial', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off',
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Password'); ?></label>

                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group show-hide-password">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-lock"></i></span></div>
                            <?= $this->Form->control('password', [
                                'type' => 'password',
                                'class' => 'form-control',
                                'label' => false,
                                'div' => false,
                                'error' => false,
                                'placeholder' => __( 'Password'),
                                'autocomplete' => 'off'
                            ]); ?>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="la la-eye"></i></span>
                            </div>
                            <?php if ($error = $card->getError('password')) : ?>
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






