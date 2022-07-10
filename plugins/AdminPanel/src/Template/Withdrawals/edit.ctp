<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $withdrawal
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
                        <h3 class="kt-portlet__head-title"><?= __('Edit Withdrawal') ?></h3>
                    </div>
                </div>
                <?= $this->Form->create($withdrawal,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate']); ?>
                <div class="kt-portlet__body">
                    <?php
                    echo $this->Flash->render();
                    $default_class = 'form-control';
                    $this->Form->setConfig('errorClass', 'is-invalid');
                                                    echo $this->Form->control('customer_id', ['options' => $customers, 'empty' => true, 'class' => $default_class]);
                                echo $this->Form->control('bank_name',['class' => $default_class]);
                                echo $this->Form->control('bank_city',['class' => $default_class]);
                                echo $this->Form->control('bank_branch',['class' => $default_class]);
                                echo $this->Form->control('bank_account_name',['class' => $default_class]);
                                echo $this->Form->control('bank_account_number',['class' => $default_class]);
                                echo $this->Form->control('customer_bank_id', ['options' => $customerBanks, 'empty' => true, 'class' => $default_class]);
                                echo $this->Form->control('withdrawal_status_id', ['options' => $withdrawalStatuses, 'empty' => true, 'class' => $default_class]);
                                echo $this->Form->control('transaction_id', ['options' => $transactions, 'empty' => true, 'class' => $default_class]);
                                echo $this->Form->control('amount',['class' => $default_class]);
                                echo $this->Form->control('note',['class' => $default_class]);
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
</script>
<?php $this->end(); ?>

