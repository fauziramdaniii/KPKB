<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \Member\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $testimonialEntity
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $banks
 */
?>

<?php
$this->Html->script(['/member-assets/js/showpass.js'],['block' => true]);
?>

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title"><?= __('Testimonials');?></h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" class="kt-subheader__breadcrumbs-link">
                        <?= __('List Testimonials');?> </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" class="kt-subheader__breadcrumbs-link">
                        <?= __('Create Testimonial');?> </a>

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">

                </div>
            </div>
        </div>
    </div>

    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        <?= __( 'Testimonial'); ?>

                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <a href="<?= $this->Url->build(['action' => 'index']); ?>" class="btn btn-secondary"><i class="flaticon flaticon-list-1"></i> <?= __( 'List Testimonial'); ?></a>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <?php
                    echo $this->Form->create($testimonialEntity, ['class' => 'kt-form kt-form--label-right', 'type' => 'file', 'id' => 'kt_profile_form', 'templates' => 'Member.simple_form']);
                    $this->Form->setConfig('errorClass', 'is-invalid');
                ?>





                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Message'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('message', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off'
                        ]); ?>
                    </div>
                </div>


                <?php /*
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Serial Number'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group show-hide-password">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-lock"></i></span></div>
                            <?= $this->Form->control('serial', [
                                'type' => 'password',
                                'class' => 'form-control',
                                'label' => false,
                                'div' => false,
                                'error' => false,
                                'placeholder' => __( 'Serial Number'),
                                'autocomplete' => 'off'
                            ]); ?>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="la la-eye"></i></span>
                            </div>
                            <?php if ($error = $testimonialEntity->getError('serial')) : ?>
                                <div class="invalid-feedback"><?= array_values($error)[0]; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                */ ?>
                <div class="row">
                    <div class="col-lg-3 col-xl-3">
                    </div>
                    <div class="col-lg-9 col-xl-9">
                        <button type="submit" class="btn btn-success"><?= __('Submit');?></button>&nbsp;
                    </div>
                </div>



                <?= $this->Form->end(); ?>
            </div>
        </div>

    </div>

    <!-- end:: Content -->
</div>

