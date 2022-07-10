<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $productUnit
 */
?>
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Daftar Pesan</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('Rincian Pesan') ?></h3>
                    </div>
                </div>
                <?= $this->Form->create($message,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate']); ?>
                <div class="kt-portlet__body">
                    <?php
                    echo $this->Flash->render();
                    $default_class = 'form-control';
                    $this->Form->setConfig('errorClass', 'is-invalid');
                    echo $this->Form->control('name',['class' => $default_class, 'value' => $message->name, 'readonly' => 'readonly', 'label' => 'Nama']);
                    echo $this->Form->control('email',['class' => $default_class, 'value' => $message->email, 'readonly' => 'readonly', 'label' => 'Email']);
                    echo $this->Form->control('subject',['class' => $default_class, 'value' => $message->subject, 'readonly' => 'readonly', 'label' => 'Subject']);
                    echo $this->Form->control('message',['class' => $default_class, 'value' => $message->message, 'readonly' => 'readonly', 'label' => 'Pesan']);
                    ?>

                </div>

                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <a href="<?= $this->Url->build(['action' => 'index']); ?>" class="btn btn-warning ">
                                    <?= __('Kembali') ?>
                                </a>
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

