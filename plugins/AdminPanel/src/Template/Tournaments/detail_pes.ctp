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
                        <h3 class="kt-portlet__head-title"><?= __('Rincian Data Peserta (PES)') ?></h3>
                    </div>
                </div>
                <?= $this->Form->create($pes,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate', 'type' => 'file']); ?>
                <div class="kt-portlet__body">
                    <div class="row">
                        <?php
                        echo $this->Flash->render();
                        $default_class = 'form-control';
                        $this->Form->setConfig('errorClass', 'is-invalid');
                        ?>
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">Nama Peserta</label>
                                <div class="col-lg-8"><input type="text"  class="form-control" disabled="disabled" value="<?php echo $pes->name; ?>">
                                </div>
                            </div>
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">Nomor Telepon</label>
                                <div class="col-lg-8"><input type="text"  class="form-control" disabled="disabled" value="<?php echo $pes->phone; ?>">
                                </div>
                            </div>
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">Email</label>
                                <div class="col-lg-8"><input type="text"  class="form-control" disabled="disabled" value="<?php echo $pes->email; ?>">
                                </div>
                            </div>
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">File Bukti Vaksin Ke - 2</label>
                                <div class="col-lg-8"><img src="<?= $this->Url->build('/files/PesParticipants/bukti_vaksin/'.$pes->bukti_vaksin);?>" class="kt-blog-grid__image" data-toggle="modal" data-target=".modal-image2" style="width: 300px;"/>
                                </div>
                            </div>
                            <div class="modal fade modal-image2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">File Bukti Vaksin Ke - 2</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="<?= $this->Url->build('/files/PesParticipants/bukti_vaksin/'.$pes->bukti_vaksin);?>" class="kt-blog-grid__image" style="width: 100%;"/>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">File KTP</label>
                                <div class="col-lg-8"><img src="<?= $this->Url->build('/files/PesParticipants/ktp/'.$pes->ktp);?>" class="kt-blog-grid__image" data-toggle="modal" data-target=".modal-image" style="width: 300px;"/>
                                </div>
                            </div>
                            <div class="modal fade modal-image" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">File KTP</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="<?= $this->Url->build('/files/PesParticipants/ktp/'.$pes->ktp);?>" class="kt-blog-grid__image" style="width: 100%;"/>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
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
                                <a href="<?= $this->Url->build(['action' => 'pes']); ?>" class="btn btn-warning ">
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

