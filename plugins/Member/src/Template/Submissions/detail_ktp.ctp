<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \Member\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $$transfer
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $customer_banks
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
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('KTP');?></h5>
                <!--end::Page Title-->

                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="<?= $this->Url->build(['action' => 'ktp']); ?>" class="text-muted"><?= __('Daftar Pengajuan KTP'); ?></a>
                    </li>
                    <li class="breadcrumb-item">
                        <?= __('Detail Pengajuan KTP'); ?>
                    </li>
                </ul>
                <!--end::Breadcrumb-->

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
                <div class="card-title">
                    <h3 class="card-label"><?= __('Detail Pengajuan KTP');?></h3>
                </div>

                <div class="card-toolbar">
                    <a href="<?= $this->Url->build(['action' => 'ktp']); ?>" class="btn btn-light-primary font-weight-bold">
                        <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/keen/releases/2020-10-07-041015/theme/demo1/dist/../src/media/svg/icons/Layout/Layout-left-panel-2.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M10,4 L21,4 C21.5522847,4 22,4.44771525 22,5 L22,7 C22,7.55228475 21.5522847,8 21,8 L10,8 C9.44771525,8 9,7.55228475 9,7 L9,5 C9,4.44771525 9.44771525,4 10,4 Z M10,10 L21,10 C21.5522847,10 22,10.4477153 22,11 L22,13 C22,13.5522847 21.5522847,14 21,14 L10,14 C9.44771525,14 9,13.5522847 9,13 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M10,16 L21,16 C21.5522847,16 22,16.4477153 22,17 L22,19 C22,19.5522847 21.5522847,20 21,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,17 C9,16.4477153 9.44771525,16 10,16 Z" fill="#000000"/>
                                        <rect fill="#000000" opacity="0.3" x="2" y="4" width="5" height="16" rx="1"/>
                                    </g>
                                </svg>
                            <!--end::Svg Icon-->
                            </span>
                        <?= __( 'Daftar Pengajuan KTP'); ?></a>
                </div>
            </div>

            <?php
            echo $this->Form->create($ktp, ['class' => 'kt-form kt-form--label-right', 'type' => 'file', 'id' => 'kt_profile_form', 'templates' => 'Member.simple_form']);
            $this->Form->setConfig('errorClass', 'is-invalid');
            ?>
            <div class="card-body">

                <?= $this->Flash->render() ?>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Klasifikasi Pembuatan'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('klasifikasi_pembuatan', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'value' => $ktp->classification->slug,
                            'readonly' => true,
                            'autocomplete' => 'off'
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Nama Calon'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('name', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off',
                            'value' => $ktp->name,
                            'readonly' => true
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Nomor NIK'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('nik', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off',
                            'value' => $ktp->nik,
                            'readonly' => true
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Address'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('address', [
                            'class' => 'form-control',
                            'type' => 'textarea',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off',
                            'value' => $ktp->address,
                            'readonly' => true
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Nama Pengaju'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('applicant', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off',
                            'value' => $ktp->applicant,
                            'readonly' => true
                        ]); ?>
                    </div>
                </div>

                <?php if($ktp_requirements) : ?>
                    <?php foreach ($ktp_requirements as $k => $requirement) : ?>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label"><?= $requirement->name; ?></label>
                            <div class="col-lg-9 col-xl-6">
                                <img src="<?= $this->Url->build('/'.$requirement->image->dir.$requirement->image->name);?>" class="kt-blog-grid__image" data-toggle="modal" data-target="#modal-image-<?= $k; ?>" style="width: 300px; height: 200px;"/>>
                            </div>
                        </div>

                        <!-- Modal-->
                        <div class="modal fade" id="modal-image-<?= $k; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $requirement->name; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="<?= $this->Url->build('/'.$requirement->image->dir.$requirement->image->name);?>" class="kt-blog-grid__image" style="width: 100%;"/>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Tanggal Pengajuan Berkas'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?php if($ktp->tanggal_pengajuan_berkas) : ?>
                            <?php $tanggal_pengajuan = $ktp->tanggal_pengajuan_berkas->format('d F Y'); ?>
                        <?php else : ?>
                            <?php $tanggal_pengajuan = '-'; ?>
                        <?php endif; ?>
                        <?= $this->Form->control('tanggal_pengajuan', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off',
                            'value' => $tanggal_pengajuan,
                            'readonly' => true
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Tanggal Pengambilan Berkas'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?php if($ktp->tanggal_pengambilan_berkas) : ?>
                            <?php $tanggal_pengambilan = $ktp->tanggal_pengambilan_berkas->format('d F Y'); ?>
                        <?php else : ?>
                            <?php $tanggal_pengambilan = '-'; ?>
                        <?php endif; ?>
                        <?= $this->Form->control('tanggal_pengambilan', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off',
                            'value' => $tanggal_pengambilan,
                            'readonly' => true
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Catatan'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('note', [
                            'type' => 'textarea',
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off',
                            'value' => $ktp->note,
                            'readonly' => true
                        ]); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><?= __( 'Status Pengajuan'); ?></label>
                    <div class="col-lg-9 col-xl-6">
                        <?= $this->Form->control('submission_status', [
                            'class' => 'form-control',
                            'label' => false,
                            'div' => false,
                            'autocomplete' => 'off',
                            'value' => $ktp->submission_status->name,
                            'readonly' => true
                        ]); ?>
                    </div>
                </div>

                <?php /*
                <?php if($status_pembuatan == 'Cetak') : ?>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"><?= __('Bukti Surat Kehilangan dari Polisi');?></label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="custom-file">
                                <?= $this->Form->control('attachment1', [
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
                <?php else : ?>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"><?= __('Bukti Surat Pengantar dari Desa');?></label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="custom-file">
                                <?= $this->Form->control('attachment1', [
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
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"><?= __('Bukti Kartu Keluarga');?></label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="custom-file">
                                <?= $this->Form->control('attachment2', [
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
                <?php endif; ?>
                */ ?>
            </div>
            <div class="card-footer">
                <a href="<?= $this->Url->build(['action' => 'ktp']); ?>" class="btn btn btn-info"><?= __( 'Kembali'); ?></a>
            </div>

            <?= $this->Form->end(); ?>
        </div>

    </div>
</div>



<?php $this->append('script'); ?>
<script>
    jQuery(document).ready(function() {

    });
</script>
<?php $this->end(); ?>

