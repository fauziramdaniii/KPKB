<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $transactionMutations
 * nevix
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
                        <h3 class="kt-portlet__head-title"><?= __('Peserta Esport Valorant') ?></h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-toolbar-wrapper">
                            <a href="<?= $this->Url->build(['action' => 'downloadValorant']); ?>" class="btn btn-default btn-bold btn-upper btn-font-sm" target="_blank"> <i class="la la-download"></i> Download File Dokumen </a>
                            <button type="button" class="btn btn-default btn-bold btn-upper btn-font-sm  btn-export">
                                <i class="la la-download"></i> Export To Excel
                            </button>
                        </div>
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

                    <!--begin: Datatable -->
                    <div  class="table-responsive">
                        <div class="kt_datatable" id="table-valorant"></div>
                    </div>
                    <!--end: Datatable -->


                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->append('script'); ?>
<script>

    $('select').selectpicker();
    function delete_data(id) {
        $.post( "<?= $this->Url->build(['action' => 'deleteValorant']); ?>/" + id, { _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>' } )
            .done(function( data ) {
                location.href = '<?= $this->Url->build();?>';
            });
    }

    var DatatableRemoteAjaxDemo = function() {
        var demo = function() {
            var datatable = $('#table-valorant').KTDatatable({
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            method: 'POST',
                            url: '<?= $this->Url->build(); ?>',
                            cache: false,
                            params: {
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
                layout: {
                    scroll: true,
                    height: 550,
                    footer: false
                },
                sortable: true,
                pagination: true,
                toolbar: {
                    items: {
                        pagination: {
                            pageSizeSelect: [10, 20, 30, 50, 100],
                        },
                    },
                },
                search: {
                    input: $('#generalSearch'),
                },
                order: [[ 0, "desc" ]],
                columns: [
                    {
                        field: 'id',
                        title: '#',
                        sortable: false,
                        width: 40,
                        selector: false,
                        textAlign: 'center',
                        template: function(row, index, datatable) {
                            return ++index;
                        }
                    },
                    {
                        field: 'ValorantParticipants.team_name',
                        title: 'Nama Tim',
                        template: function(row) {
                            return row.team_name;
                        }
                    },
                    {
                        field: 'ValorantParticipants.person_in_charge',
                        title: 'Kontak Person',
                        template: function(row) {
                            return row.person_in_charge;
                        }
                    },
                    {
                        field: 'ValorantParticipants.phone',
                        title: 'Nomor Telepon',
                        template: function(row) {
                            return row.phone;
                        }
                    },
                    {
                        field: 'ValorantParticipants.email',
                        title: 'Email',
                        template: function(row) {
                            return row.email;
                        }
                    },
                    // {
                    //     field: 'PesParticipants.ktp',
                    //     title: 'KTP',
                    //     template: function(row) {
                    //         return row.email;
                    //     }
                    // },

                    {
                        field: 'ValorantParticipants.created',
                        title: 'Created',
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
                            return '<a href="<?= $this->Url->build(['action' => 'detailValorant']); ?>/'+ row.id +'"class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Rincian Data"><i class="la la-search"></i></a><a href="javascript:delete_data('+row.id+');" onclick="return confirm(\'Are you sure delete #'+row.id+'\');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"><i class="la la-trash"></i></a>';
                        }
                    }

                ]
            });
            var query = datatable.getDataSourceQuery();

            // $('#form__status').on('change', function() {
            //     datatable.search($(this).val().toLowerCase(), 'transaction_type_id');
            // });
        };
        return {
            init: function() {
                demo();
            },
        };
    }();

    jQuery(document).ready(function() {
        DatatableRemoteAjaxDemo.init();
        $(".btn-export").click(function(){
            $("#table-valorant").table2excel({
                exclude: ".noExl",
                name: "Excel Document Name"
            });
        });
    });
</script>
<?php $this->end(); ?>



