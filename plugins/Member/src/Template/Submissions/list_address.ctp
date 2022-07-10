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
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Pindah / Datang');?></h5>
                <!--end::Page Title-->

                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="<?= $this->Url->build(['action' => 'pindahAlamat']); ?>" class="text-muted"><?= __('Daftar Pengajuan Surat Pindah / Datang'); ?></a>
                    </li>
                    <li class="breadcrumb-item">
                        <?= __('Klasifikasi Pengajuan'); ?>
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
        <!--begin::Notice-->
        <div class="card card-custom gutter-b">
            <div class="card-body d-flex align-items-center py-5 py-lg-13">
                <!--begin::Icon-->
                <div class="d-flex flex-center position-relative ml-5 mr-15 ml-lg-9 mr-lg-15">
                                                <span class="svg-icon svg-icon-5x svg-icon-primary position-absolute opacity-15">
                                                    <!--begin::Svg Icon | path:/keen/theme/demo1/dist/assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="70px" height="70px" viewBox="0 0 70 70" fill="none">
                                                        <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                            <path d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z" fill="#000000" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                    <span class="svg-icon svg-icon-2x svg-icon-primary position-absolute">
                                                    <!--begin::Svg Icon | path:/keen/theme/demo1/dist/assets/media/svg/icons/Tools/Compass.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />
                                                            <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />
                                                        </g>
                                                    </svg>
                        <!--end::Svg Icon-->
                                                </span>
                </div>
                <!--end::Icon-->
                <!--begin::Description-->
                <div class="m-0 text-dark-50 font-weight-bold font-size-lg">Klasifikasi Pembuatan Surat Pindah / Datang <br /> Persyaratan harap dibawa ke kecamatan.</div>
                <!--end::Description-->
            </div>
        </div>
        <!--end::Notice-->
        <!--begin::Row-->
        <div class="row">
            <?php foreach($classifications as $classification) : ?>
                <div class="col-lg-6 col-xl-6 mb-5">
                    <!--begin::Iconbox-->
                    <div class="card card-custom card-stretch wave mb-8 mb-lg-0">
                        <div class="card-body">
                            <div class="d-block p-5 w-100">
                                <div class="">
                                    <a href="<?= $this->Url->build(['action' => 'addAddress', $classification->slug]); ?>" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-5"><?= $classification->name; ?></a>
                                    <div class="text-dark-75 mt-5">Persyaratan yang dibutuhkan : <br />
                                        <ul>
                                            <?php if($classification->requirements) : ?>
                                                <?php foreach ($classification->requirements as $requirement) : ?>
                                                    <li><?= $requirement->name; ?></li>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="<?= $this->Url->build(['action' => 'addAddress', $classification->slug]); ?>" class="btn btn-primary btn-sm btn-block">Ajukan</a>
                    </div>
                    <!--end::Iconbox-->
                </div>
            <?php endforeach; ?>

            <?php /*
            <div class="col-lg-6 col-xl-6 mb-5">
                <!--begin::Iconbox-->
                <div class="card card-custom card-stretch wave mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-block p-5 w-100">
                            <div class="">
                                <a href="<?= $this->Url->build(['action' => 'addAddress', 'Pindah']); ?>" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-5">Surat Pindah</a>
                                <div class="text-dark-75 mt-5">Persyaratan yang dibutuhkan : <br />
                                <ul>
                                    <li>Surat Keterangan Pindah</li>
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="<?= $this->Url->build(['action' => 'addAddress', 'Pindah']); ?>" class="btn btn-primary btn-sm btn-block">Ajukan</a>
                </div>
                <!--end::Iconbox-->
            </div>
            <div class="col-lg-6 col-xl-6 mb-5">
                <!--begin::Iconbox-->
                <div class="card card-custom card-stretch wave mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-block p-5 w-100">
                            <div class="">
                                <a href="<?= $this->Url->build(['action' => 'addAddress', 'Datang']); ?>" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Surat Datang</a>
                                <div class="text-dark-75 mt-5">Persyaratan yang dibutuhkan : <br />
                                    <ul>
                                        <li>Surat Keterangan Datang</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="<?= $this->Url->build(['action' => 'addAddress', 'Datang']); ?>" class="btn btn-primary btn-sm btn-block">Ajukan</a>
                </div>
                <!--end::Iconbox-->
            </div>
            */ ?>

        </div>
        <!--end::Row-->
    </div>
<!--end::Container-->
</div>


<?php $this->append('script'); ?>
<script>
    jQuery(document).ready(function() {

    });
</script>
<?php $this->end(); ?>

