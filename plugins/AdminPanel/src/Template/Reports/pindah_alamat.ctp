
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Laporan Pembuatan Surat Pindah / Datang</h3>
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
    <?php  echo $this->Flash->render();?>
    <?= $this->Form->create(null, ['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate']); ?>
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Filter Tanggal Laporan</label>
        <div class="col-lg-4">
            <div class='input-group pull-right' id='kt_daterangepicker_2'>
                <input type='text' class="form-control"  name="daterange" readonly  placeholder="Select date range"/>
                <div class="input-group-append">
                    <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <button type="submit" class="btn btn-brand">Filter</button>
        </div>
    </div>
    <?= $this->Form->end(); ?>


    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Laporan Pembuatan Surat Pindah / Datang</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-default btn-bold btn-upper btn-font-sm  btn-export">
                                    <i class="la la-download"></i> Export
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="report_sales">
                            <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Klasifikasi</th>
                                <th>Nama Calon</th>
                                <th>NIK</th>
                                <th>Alamat Asal</th>
                                <th>Alamat Tujuan</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($data_alamat) : ?>
                                <?php foreach($data_alamat as $data):?>
                                    <tr>
                                        <td><?= $data->created->format('d F Y');?></td>
                                        <td><?= $data->classification->name;?></td>
                                        <td><?= $data->name;?></td>
                                        <td><?= $data->nik;?></td>
                                        <td><?= $data->original_address;?></td>
                                        <td><?= $data->destination_address;?></td>
                                        <td><?= $data->submission_status->name;?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" style="text-align: center;">Data Tidak Ditemukan</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                            <thead>
                                <tr>
                                    <th style="border: none;"><br></th>
                                </tr>
                            </thead>
                            <?php foreach($alamat as $ala) : ?>
                                <thead>
                                    <tr>
                                        <th colspan="7" style="text-align: center;">Total Klasifikasi <?= $ala->name; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="7" style="text-align: center;"><?= $ala->total; ?></td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr>
                                        <th style="border: none;"><br></th>
                                    </tr>
                                </thead>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>

                <?php /*
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title ">Total Product Sales </h3>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fluid row">
                    <?php foreach($total_order as $total) : ?>
                        <?php $total_penjualan_produk = $total['price'] * $total['total']; ?>
                        <div class="col-12">
                            <p class="text-dark font-weight-normal">
                                <span class="font-weight-bold"><?= $total['product']; ?></span>  <br> <?= $total['total']; ?> box x <?= $this->Number->format(round($total['price'],2), ['locale' => 'id-ID']);?> = <strong><?= $this->Number->format(round($total_penjualan_produk,2), ['locale' => 'id-ID']);?></strong>
                            </p>
                        </div>
                    <?php endforeach; ?>
<!--                    <div class="col-12">-->
<!--                        <p class="text-dark font-weight-normal">-->
<!--                            <span class="font-weight-bold">Dolzit Dodol Wajit Premium</span> <br> 120 box x 88.000 = <strong>10.560.000</strong>-->
<!--                        </p>-->
<!--                    </div>-->
                    <div class="col-12">
                        <p class="text-dark font-weight-normal">
                        <h3 class="font-weight-bold">Total All Sales = <?= $this->Number->format(round($total_sales,2), ['locale' => 'id-ID']);?></h3>
                        </p>
                    </div>
                </div>
                */ ?>

            </div>
            <!--end::Portlet-->

        </div>
    </div>
</div>

<?php $this->append('script'); ?>
<script>
    var KTBootstrapDaterangepicker = {
        init: function() {
            ! function() {
                var t = moment().subtract(29, "days"),
                    a = moment();
                $("#kt_daterangepicker_2").daterangepicker({
                    buttonClasses: "btn btn-sm",
                    applyClass: "btn-primary",
                    cancelClass: "btn-secondary",
                    startDate: moment().subtract(6, "days"),
                    endDate: moment(),
                    ranges: {
                        Today: [moment(), moment()],
                        Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
                        "Last 7 Days": [moment().subtract(6, "days"), moment()],
                        "Last 30 Days": [moment().subtract(29, "days"), moment()],
                        "This Month": [moment().startOf("month"), moment().endOf("month")],
                        "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                    }
                }, function(t, a, e) {
                    $("#kt_daterangepicker_2 .form-control").val(t.format("YYYY-MM-DD") + " - " + a.format("YYYY-MM-DD"))
                })
            }()
        }
    };


    jQuery(document).ready(function() {
        KTBootstrapDaterangepicker.init()


        $(".btn-export").click(function(){
            $("#report_sales").table2excel({
                exclude: ".noExl",
                name: "Excel Document Name"
            });
        });

    });


</script>
<?php $this->end(); ?>
