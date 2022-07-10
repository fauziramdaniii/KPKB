<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $product
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
                        <h3 class="kt-portlet__head-title"><?= __('Rincian Data Tim (Free Fire)') ?></h3>
                    </div>
                </div>
                <?= $this->Form->create($ff,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate', 'type' => 'file']); ?>
                <div class="kt-portlet__body">
                    <div class="row">
                        <?php
                        echo $this->Flash->render();
                        $default_class = 'form-control';
                        $this->Form->setConfig('errorClass', 'is-invalid');
                        ?>
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">Nama Tim</label>
                                <div class="col-lg-8"><input type="text"  class="form-control" disabled="disabled" value="<?php echo $ff->team_name; ?>">
                                </div>
                            </div>
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">Kontak Person</label>
                                <div class="col-lg-8"><input type="text"  class="form-control" disabled="disabled" value="<?php echo $ff->person_in_charge; ?>">
                                </div>
                            </div>
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">Nomor Telepon</label>
                                <div class="col-lg-8"><input type="text"  class="form-control" disabled="disabled" value="<?php echo $ff->phone; ?>">
                                </div>
                            </div>
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">Email</label>
                                <div class="col-lg-8"><input type="text"  class="form-control" disabled="disabled" value="<?php echo $ff->email; ?>">
                                </div>
                            </div>
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">File Data Tim</label>
                                <div class="col-lg-8">
                                    <a href="<?= $this->Url->build('/files/FfParticipants/document/'.$ff->document);?>" target="_blank"><?php echo $ff->document; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <a href="<?= $this->Url->build(['action' => 'freeFire']); ?>" class="btn btn-warning ">
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
<?php
$this->Html->script(['/admin-assets/js/pages/components/forms/layouts/repeater.js'],['block' => true]);
?>
<script>
    $('select').selectpicker();
    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class=\"la la-angle-right\"></i>',
            rightArrow: '<i class=\"la la-angle-left\"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class=\"la la-angle-left\"></i>',
            rightArrow: '<i class=\"la la-angle-right\"></i>'
        }
    }

</script>
<?php $this->end(); ?>

