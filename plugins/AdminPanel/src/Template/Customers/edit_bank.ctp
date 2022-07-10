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
            <h3 class="kt-subheader__title">Edit Akun Bank Pengguna</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('Edit Akun Bank Pengguna') ?></h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <a href="<?= $this->Url->build(['action' => 'edit', $customerBank->customer_id]); ?>" class="btn btn-default btn-bold btn-upper btn-font-sm">
                                <i class="flaticon-edit"></i>
                                <?= __('Edit Data Pengguna') ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?= $this->Form->create($customerBank,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate']); ?>
                <div class="kt-portlet__body">
                    <?php
                    echo $this->Flash->render();
                    $default_class = 'form-control';
                    $this->Form->setConfig('errorClass', 'is-invalid');
                                echo $this->Form->control('bank_id', ['class' => $default_class, 'options' => $banks, 'empty' => __( 'Please Select Bank')]);
                                echo $this->Form->control('account_name',['class' => $default_class]);
                                echo $this->Form->control('account_number',['class' => $default_class]);
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

