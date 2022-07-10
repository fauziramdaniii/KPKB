<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $customers
 * nevix
 */
?>

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Warga</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('Daftar Akun Warga') ?></h3>
                    </div>

                    <?php /*
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <a href="#" class="btn btn-default btn-bold btn-upper btn-font-sm" id="export2excel">
                                <i class="flaticon-download"></i>
                                <?= __('Export to Excel') ?>
                            </a>
                        </div>
                    </div>
                    */ ?>
                </div>
                <div class="kt-portlet__body">
                    <?= $this->Flash->render() ?>

                    <!--begin: Search Form -->
                    <div class="kt-form kt-fork--label-right kt-margin-b-10">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-12 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control kt-input" placeholder="Search..." id="generalSearch">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span>
                                                    <i class="la la-search"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <?php /*
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Status: </label>
                                            </div>
                                            <div class="kt-form__control">
                                                <?= $this->Form->select('is_active', ['1' => 'Active', '2' => 'Blocked'], [
                                                    'empty' => 'All',
                                                    'class' => 'form-control bootstrap-select',
                                                    'id' => 'form__status'
                                                ]); ?>
                                            </div>
                                        </div>
                                    </div>
                                    */ ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--end: Search Form -->

                    <!--begin: Datatable -->
                    <div class="kt_datatable" id="table-customers"></div>
                    <!--end: Datatable -->


                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->append('script'); ?>

<script>

    $('select').selectpicker();
    var DatatableRemoteAjaxDemo = function() {
        var demo = function() {
            var datatable = $('#table-customers').KTDatatable({
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
                        field: 'Customers.id',
                        title: '#',
                        sortable: true,
                        width: 40,
                        selector: false,
                        textAlign: 'center',
                        template: function(row, index, datatable) {
                            return (datatable.getCurrentPage() - 1) * datatable.getPageSize() + index + 1;
                        }
                    },
                    {
                        field: 'Customers.first_name',
                        title: 'Nama',
                        template: function(row) {
                            return row.full_name;
                        }
                    },
                    {
                        field: 'Customers.email',
                        title: 'Email',
                        template: function(row) {
                            return row.email;
                        }
                    },
                    {
                        field: 'Customers.phone',
                        title: 'Telepon',
                        template: function(row) {
                            return row.phone;
                        }
                    },
                    {
                        field: 'Customers.identity_number',
                        title: 'Nomor KTP',
                        template: function(row) {
                            return row.identity_number;
                        }
                    },
                    {
                        field: 'Customers.created',
                        title: 'Tanggal Daftar',
                        template: function(row) {
                            return moment(row.created).format('YYYY-MM-DD HH:mm');
                        }
                    },

                    /** Action button **/
                    /*
                    {
                        field: "Actions",
                        width: 110,
                        title: "Actions",
                        sortable: false,
                        overflow: 'visible',
                        template: function (row, index, datatable) {
                            return '<a target="_blank" href="<?= $this->Url->build(['action' => 'forceLogin']); ?>/'+ row.id +'"class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Login as User '+ row.username +'"><i class="la la-sign-in"></i></a>';
                        }
                    }
                    */
                ]
            });
            var query = datatable.getDataSourceQuery();

            $('#form__status').on('change', function() {
                datatable.search($(this).val().toLowerCase(), 'is_active');
            });

            $('#export2excel').on('click', function() {
               //console.log(datatable.getDataSourceParam());

                location.href = '<?= $this->Url->build(['action' => 'export']);?>?' + $.param(datatable.getDataSourceParam());
            })

        };
        return {
            init: function() {
                demo();
            },
        };
    }();

    jQuery(document).ready(function() {
        DatatableRemoteAjaxDemo.init();
    });
</script>
<?php $this->end(); ?>



