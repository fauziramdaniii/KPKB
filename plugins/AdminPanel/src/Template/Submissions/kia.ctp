<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $withdrawals
 * nevix
 */
?>

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">KIA</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('Daftar Pengajuan KIA') ?></h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <?= $this->Flash->render() ?>

                    <!--begin: Search Form -->
                    <div class="kt-form kt-fork--label-right kt-margin-b-10">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control kt-input" placeholder="Search..." id="generalSearch">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span>
                                                    <i class="la la-search"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end: Search Form -->

                    <div class="kt-portlet kt-portlet--tabs">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-toolbar">
                                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                                    <?php
                                    $text = [
                                        1 => 'text-warning',
                                        2 => 'text-primary',
                                        3 => 'text-info',
                                        4 => 'text-success',
                                        5 => 'text-danger'
                                    ];
                                    ?>
                                    <?php foreach($statusTypes as $key => $status):?>
                                        <li class="nav-item">
                                            <a class="nav-link <?= ($key == 1) ? 'active' : '';?> <?= $text[$key];?>" data-toggle="tab" href="#<?= strtolower($status);?>" data-status="<?= strtolower($status);?>" role="tab" aria-selected="false">
                                                <?= ucfirst($status);?>
                                            </a>
                                        </li>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content">
                                <?php $i = 1;?>
                                <?php foreach($statusTypes as $key => $status):?>
                                    <div class="tab-pane <?= ($key == 1) ? 'active' : '';?>" id="<?= strtolower($status);?>" role="tabpanel">

                                        <?php if($key == 1) :?>
                                            <div class="kt-form kt-fork--label-align-right kt-margin-t-20 collapse" id="kt_datatable_group_action_form_<?= strtolower($status);?>">
                                                <div class="row align-items-center">
                                                    <div class="kt-form__label kt-form__label-no-wrap col-xl-2">
                                                        <label class="kt--font-bold kt--font-danger-">Selected
                                                            <span id="kt_datatable_selected_number_<?= strtolower($status);?>">0</span> records:</label>
                                                    </div>
                                                    <div class="kt-form__control col-xl-2">
                                                        <?php
                                                        unset($statusTypes[0]);
                                                        ?>
                                                        <?= $this->Form->select('selected_status', $statusTypes, [
                                                            'class' => 'form-control bootstrap-select',
                                                            'id' => 'form__status_selected_'.strtolower($status)
                                                        ]); ?>
                                                    </div>
                                                    <button class="btn btn-success col-xl-2" type="button" data-toggle="modal" data-target="#kt_modal_fetch_id_<?= strtolower($status);?>">Submit</button>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="kt_modal_fetch_id_<?= strtolower($status);?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><span class="update-title"></span></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span class="update-ask"></span>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary btn-confirm-<?= strtolower($status);?>" data-dismiss="modal">Confirm</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $i++;?>
                                        <?php endif;?>

                                        <?php if($key == 3) :?>
                                            <div class="modal fade" id="update_awb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update AWB / Nomor Resi Pengiriman</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span class="update-ask"></span>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary btn-confirm-awb" data-dismiss="modal">Confirm</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif;?>
                                        <div class="kt_datatable" id="table-kias-<?= strtolower($status);?>"></div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->append('script'); ?>
<script>

    function tableWd(status) {
        var options = {
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'POST',
                        url: '<?= $this->Url->build(); ?>',
                        cache: false,
                        params: {
                            status: status,
                            _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                        },
                        map: function(raw) {
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    },
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },

            // layout definition
            layout: {
                theme: 'default', // datatable theme
                class: '', // custom wrapper class
                scroll: true, // enable/disable datatable scroll both horizontal and
                // vertical when needed.
                height: 350, // datatable's body's fixed height
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,

            pagination: true,

            // columns definition

            columns: [
                {
                    field: "id",
                    title: "#",
                    sortable: false,
                    width: 20,
                    selector : false,
                    textAlign: 'center',
                    template: function(row, index, datatable) {
                        return ++index;
                    }
                },
                {
                    field: 'Classifications.name',
                    title: 'Klasifikasi',
                    sortable: false,
                    template: function(row) {
                        return '<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">'+row.classification.name+'</span>' ;
                    }
                },

                {
                    field: 'KiaSubmissions.name',
                    title: 'Nama',
                    sortable: false,
                    template: function(row) {
                        return row.name;
                    }
                },

                {
                    field: 'KiaSubmissions.nik',
                    title: 'NIK',
                    sortable: false,
                    template: function(row) {
                        return row.nik;
                    }
                },

                {
                    field: 'KiaSubmissions.address',
                    title: 'Alamat',
                    sortable: false,
                    template: function(row) {
                        return row.address;
                    }
                },

                {
                    field: 'KiaSubmissions.applicant',
                    title: 'Pengaju',
                    sortable: false,
                    template: function(row) {
                        return row.applicant;
                    }
                },

                {
                    field: 'KiaSubmissions.created',
                    title: 'Tanggal Pengajuan',
                    sortable: false,
                    template: function(row) {
                        return moment(row.created).format('YYYY-MM-DD h:mm:ss');
                    }
                },
                {
                    field: "Actions",
                    width: 110,
                    title: "Actions",
                    sortable: false,
                    overflow: 'visible',
                    template: function (row, index, datatable) {
                        return '<a href="<?= $this->Url->build(['action' => 'updateKia']); ?>/'+ row.id +'"class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Update Pengajuan KIA"><i class="la la-edit"></i></a>';
                    }
                }
            ],
        };

        options.search = {
            input: $('#generalSearch'),
        };

        /*
       if(status != 'menunggu'){
           options.columns[0].visible = false;
       }
         */

        var datatable = $('#table-kias-'+status).KTDatatable(options);

        /*
        $('#form__status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'submission_status_id');
        });
         */

        $('#form__status, #form__status_selected_'+status).selectpicker();

        /*
        datatable.on(
            'kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated',
            function(e) {
                var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes();
                var count = checkedNodes.length;
                $('#kt_datatable_selected_number').html(count);
                if (count > 0) {
                    $('#kt_datatable_group_action_form').collapse('show');
                } else {
                    $('#kt_datatable_group_action_form').collapse('hide');
                }
            });

        $('#kt_modal_fetch_id').on('show.bs.modal', function(e) {

            var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes();
            var count = checkedNodes.length;
            $('.update-title').html((count > 1 ) ? 'Mass update withdrawal status' : 'Update withdrawal status');
            $('.update-ask').html((count > 1 ) ? 'Are you sure want to mass update '+status+' this entire row?' : 'Are you sure want to update '+status+' this row?');

            var ids = [];
            datatable.rows('.kt-datatable__row--active')
            .nodes()
            .find('.kt-checkbox--single > [type="checkbox"]')
            .map(function(i, chk) {
                ids[i] = $(chk).val();
            });


            $('.btn-confirm').on('click',function confirm(e) {
                e.preventDefault();
                $.ajax({
                    url : '<?= $this->Url->build(['action' => 'process_ktp']);?>',
                    method : 'post',
                    data : {
                        status : $('#form__status_selected').val(),
                        ids :ids,
                        note :$('#form__note').val(),
                        _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                    },
                    dataType : 'json',
                    success : function (response) {
                        location.reload();
                    }
                });
                $(this).off('click', confirm);
            })

        });
        */

        return datatable;

    };


    jQuery(document).ready(function() {
        // KTDatatableRecordSelectionDemo.init();
        const datatable = tableWd('tertunda');
        $('.nav-link').on('click',function(){
            var status = $(this).data('status');
            tableWd(status);
        })
    });
</script>
<?php $this->end(); ?>



