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
            <h3 class="kt-subheader__title">Peserta</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('Kirim Email Kepada Peserta') ?></h3>
                    </div>
                </div>
                <?= $this->Form->create($pes,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate']); ?>
                <div class="kt-portlet__body">
                    <?php
                    echo $this->Flash->render();
                    $default_class = 'form-control';
                    $this->Form->setConfig('errorClass', 'is-invalid');
                        echo $this->Form->control('name',['class' => $default_class, 'label' => 'Nama Peserta', 'value' => $pes->name, 'readonly' => true]);
                        echo $this->Form->control('email',['class' => $default_class, 'label' => 'Email Peserta', 'value' => $pes->email, 'readonly' => true]);
                        echo $this->Form->control('subject',['class' => $default_class, 'label' => 'Subject Email', 'value' => 'Verifikasi Pendaftaran', 'readonly' => true]);
                        echo $this->Form->control('message',['type' => 'textarea', 'class' => $default_class, 'label' => 'Pesan']);

                    ?>

                </div>

                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-success">Kirim Email</button>
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
    $('form').submit(function(){
        $(this).find('button[type=submit]').prop('disabled', true);
        //return false; // return false stops the from from actually submitting.. this is only for demo purposes
    });
</script>
<?php $this->end(); ?>

