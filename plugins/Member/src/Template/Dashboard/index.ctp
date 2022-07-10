<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $customers
 * @var \Cake\I18n\Time $date_min
 * @var \Cake\I18n\Time $date_max
 */
?>


<div class="subheader py-6 py-lg-8 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Dashboard'); ?></h5>
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
        <?php  echo $this->Flash->render(); ?>
        <div class="row">
            <?php if($dataktp) : ?>
                <?php foreach($dataktp as $ktp) : ?>
                    <div class="col-lg-12">
                        <div class="alert alert-custom alert-primary fade show" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                            <div class="alert-text">Data Pengajuan KTP dengan NIK <?= $ktp->nik; ?> Harap Persyaratan Pengajuan KTP Dibawa Ke Kantor Kecamatan, Terima Kasih.</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if($datakk) : ?>
                <?php foreach($datakk as $kk) : ?>
                    <div class="col-lg-12">
                        <div class="alert alert-custom alert-primary fade show" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                            <div class="alert-text">Data Pengajuan KK dengan Nomor KK <?= $kk->no_kk; ?> Harap Persyaratan Pengajuan KK Dibawa Ke Kantor Kecamatan, Terima Kasih.</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if($datakia) : ?>
                <?php foreach($datakia as $kia) : ?>
                    <div class="col-lg-12">
                        <div class="alert alert-custom alert-primary fade show" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                            <div class="alert-text">Data Pengajuan KIA dengan NIK <?= $kia->nik; ?> Harap Persyaratan Pengajuan KIA Dibawa Ke Kantor Kecamatan, Terima Kasih.</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if($dataalamat) : ?>
                <?php foreach($dataalamat as $alamat) : ?>
                    <div class="col-lg-12">
                        <div class="alert alert-custom alert-primary fade show" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                            <div class="alert-text">Data Pengajuan Surat <?= $alamat->status; ?> dengan NIK <?= $alamat->nik; ?> Harap Persyaratan Pengajuan Dibawa Ke Kantor Kecamatan, Terima Kasih.</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-custom gutter-b card-stretch">
                    <div class="card-header border-0 pt-6">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder font-size-h5 text-dark-75"><?= __('Total Pengajuan KTP'); ?></span>
                        </h3>
                        <div class="card-toolbar">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-column h-100">
                            <div class="text-center">
                                <h3 class="text-dark-75 font-weight-bold display4"><?= $total_ktp; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-custom gutter-b card-stretch">
                    <div class="card-header border-0 pt-6">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder font-size-h5 text-dark-75"><?= __('Total Pengajuan KK'); ?></span>
                        </h3>
                        <div class="card-toolbar">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-column h-100">
                            <div class="text-center">
                                <h3 class="text-dark-75 font-weight-bold display4"><?= $total_kk; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-custom gutter-b card-stretch">
                    <div class="card-header border-0 pt-6">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder font-size-h5 text-dark-75"><?= __('Total Pengajuan KIA'); ?></span>
                        </h3>
                        <div class="card-toolbar">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-column h-100">
                            <div class="text-center">
                                <h3 class="text-dark-75 font-weight-bold display4"><?= $total_kia; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-custom gutter-b card-stretch">
                    <div class="card-header border-0 pt-6">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder font-size-h5 text-dark-75"><?= __('Total Pengajuan Surat Pindah / Datang'); ?></span>
                        </h3>
                        <div class="card-toolbar">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-column h-100">
                            <div class="text-center">
                                <h3 class="text-dark-75 font-weight-bold display4"><?= $total_alamat; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


<?php $this->Html->script('/member-assets/plugins/numeral/numeral.min.js', ['block' => true]); ?>

<?php $this->append('script'); ?>
<script>

    jQuery(document).ready(function() {

    });

</script>
<?php $this->end(); ?>
