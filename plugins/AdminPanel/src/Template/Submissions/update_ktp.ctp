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
            <h3 class="kt-subheader__title">Pengajuan KTP</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('Detail Pengajuan') ?></h3>
                    </div>
                </div>
                <?= $this->Form->create($ktp,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate', 'type' => 'file']); ?>
                <div class="kt-portlet__body">
                    <?php
                    echo $this->Flash->render();
                    $default_class = 'form-control';
                    $this->Form->setConfig('errorClass', 'is-invalid');
                    echo $this->Form->control('classification',['class' => $default_class, 'label' => 'Klasifikasi', 'value' => $ktp->classification->name, 'readonly' => true]);
                    echo $this->Form->control('name',['class' => $default_class, 'label' => 'Nama', 'readonly' => true]);
                    echo $this->Form->control('nik',['class' => $default_class, 'label' => 'NIK', 'readonly' => true]);
                    echo $this->Form->control('address',['type' => 'textarea', 'class' => $default_class, 'label' => 'Alamat', 'readonly' => true]);
                    echo $this->Form->control('applicant',['class' => $default_class, 'label' => 'Pengaju', 'readonly' => true]);
                    ?>

                    <?php if($ktp_requirements) : ?>
                        <?php foreach($ktp_requirements as $k => $requirement) : ?>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label"><?= $requirement->name; ?></label>
                                <div class="col-10">
                                    <img src="<?= $this->Url->build('/'.$requirement->image->dir.$requirement->image->name);?>" class="kt-blog-grid__image" data-toggle="modal" data-target=".modal-image-<?= $k; ?>" style="width: 300px;"/>
                                </div>
                            </div>
                            <div class="modal fade modal-image-<?= $k; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><?= $requirement->name; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="<?= $this->Url->build('/'.$requirement->image->dir.$requirement->image->name);?>" class="kt-blog-grid__image" style="width: 100%;"/>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if($ktp->submission_status_id == 2) : ?>

                        <div class="form-group row">
                            <label class="col-form-label col-2">Tanggal Pengajuan Berkas</label>
                            <div class="col-3">
                                <div class="input-group date">
                                    <input type="text" name="tanggal_pengajuan_berkas" class="form-control" readonly placeholder="Pilih Tanggal (mm/dd/yyyy)" id="tanggal_pengajuan_berkas"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-2">Tanggal Pengambilan Berkas Kembali</label>
                            <div class="col-3">
                                <div class="input-group date">
                                    <input type="text" name="tanggal_pengambilan_berkas" class="form-control" readonly placeholder="Pilih Tanggal (mm/dd/yyyy)" id="tanggal_pengambilan_berkas"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <?php if($ktp->submission_status_id == 3 || $ktp->submission_status_id == 4) : ?>
                            <?php
                                echo $this->Form->control('tanggal_pengajuan',['class' => $default_class, 'label' => 'Tanggal Pengajuan Berkas', 'value' => $ktp->tanggal_pengajuan_berkas->format('d M Y'), 'readonly' => true]);
                                echo $this->Form->control('tanggal_pengambilan',['class' => $default_class, 'label' => 'Tanggal Pengambilan Berkas', 'value' => $ktp->tanggal_pengambilan_berkas->format('d M Y'), 'readonly' => true]);
                            ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if($ktp->submission_status_id == 4) : ?>
                        <?php if(empty($ktp->taker)) : ?>
                            <?php
                                echo $this->Form->control('submission_status', ['class' => $default_class, 'label' => 'Status Pengajuan', 'value' => $ktp->submission_status->name, 'readonly' => true]);
                                echo $this->Form->control('note',['type' => 'textarea', 'class' => $default_class, 'label' => 'Catatan', 'value' => $ktp->note, 'readonly' => true]);
                                echo $this->Form->control('taker',['class' => $default_class, 'placeholder' => 'Isi nama pengambil', 'label' => 'Diambil Oleh']);
                            ?>
                        <?php else : ?>
                            <?php
                            echo $this->Form->control('submission_status', ['class' => $default_class, 'label' => 'Status Pengajuan', 'value' => $ktp->submission_status->name, 'readonly' => true]);
                            echo $this->Form->control('note',['type' => 'textarea', 'class' => $default_class, 'label' => 'Catatan', 'value' => $ktp->note, 'readonly' => true]);
                            echo $this->Form->control('taker',['class' => $default_class, 'label' => 'Diambil Oleh', 'value' => $ktp->taker, 'readonly' => true]);
                            ?>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php
                            echo $this->Form->control('submission_status_id', ['class' => $default_class, 'label' => 'Status Pengajuan', 'option' => $submissionStatuses, 'empty' => 'Pilih Status Pengajuan']);
                            echo $this->Form->control('note',['type' => 'textarea', 'class' => $default_class, 'label' => 'Catatan']);
                        ?>
                    <?php endif; ?>
                </div>

                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <?php if($ktp->submission_status_id != 4) : ?>
                                <div class="col-10">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="<?= $this->Url->build(['action' => 'ktp']); ?>" class="btn btn btn-info"><?= __( 'Kembali'); ?></a>
                                </div>
                            <?php else : ?>
                                <?php if(empty($ktp->taker)) : ?>
                                    <div class="col-10">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <a href="<?= $this->Url->build(['action' => 'ktp']); ?>" class="btn btn btn-info"><?= __( 'Kembali'); ?></a>
                                    </div>
                                <?php else : ?>
                                    <div class="col-10">
                                        <a href="<?= $this->Url->build(['action' => 'ktp']); ?>" class="btn btn btn-info"><?= __( 'Kembali'); ?></a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>

<!--<button type="button" class="btn btn-outline-brand" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>-->


<?php $this->append('script'); ?>
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

    $('#tanggal_pengajuan_berkas').datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        orientation: "bottom left",
        templates: arrows,
    });
    $('#tanggal_pengambilan_berkas').datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        orientation: "bottom left",
        templates: arrows,
    });
</script>
<?php $this->end(); ?>

