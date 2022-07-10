<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $products
 * nevix
 */
?>

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"><?= __('Product Stock Mutations') ?></h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('Product Stock Mutations') ?></h3>
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
                <div class="kt-portlet__body">
                    <?= $this->Flash->render() ?>

                    <!--begin: Search Form -->
                    <div class="kt-form kt-fork--label-right kt-margin-b-10">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
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
                        <div class="kt_datatable" id="table_products_mutation"></div>
                    </div>
                    <!--end: Datatable -->


                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->append('script'); ?>
<script>

    function delete_data(id) {
        $.post( "<?= $this->Url->build(['action' => 'delete']); ?>/" + id, { _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>' } )
            .done(function( data ) {
                location.href = '<?= $this->Url->build();?>';
            });
    }

    var DatatableRemoteAjaxDemo = function() {
        var demo = function() {
            var datatable = $('#table_products_mutation').KTDatatable({
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
                order: [[ 6, "desc" ]],
                columns: [
                    {
                       field: 'id',
                       title: '#',
                       sortable: true,
                       width: 40,
                       selector: false,
                       textAlign: 'center',
                       template: function(row, index, datatable) {
                           return ++index;
                       }
                    },
                    {
                       field: 'Products.name',
                       title: 'Name',
                       width: 100,
                       template: function(row) {
                           return row.product.name;
                       }
                    },
                    {
                       field: 'product_stock.supplier.name',
                       title: 'Supplier',
                       width: 100
                    },
                    {
                       field: 'ProductStockMutationTransactions.description',
                       title: 'Description',
                        width: 400,
                       template: function(row) {
                           return row.product_stock_mutation_transaction.description;
                       }
                    },
                    {
                       field: 'qty_in',
                       title: 'Qty In',
                        width: 70,
                       template: function(row) {
                           return (new Intl.NumberFormat('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})).format(row.qty_in);

                       }
                    },
                    {
                       field: 'qty_out',
                       title: 'Qty Out',
                        width: 70,
                       template: function(row) {
                           return (new Intl.NumberFormat('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})).format(row.qty_out);

                       }
                    },
                    {
                       field: 'total_qty',
                       title: 'Qty Tersedia',
                        width: 90,
                       template: function(row) {
                           return (new Intl.NumberFormat('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})).format(row.total_qty);
                       }
                    },
                    {
                       field: 'created',
                       title: 'Tanggal',
                       template: function(row) {
                           return moment(row.created).format('YYYY-MM-DD h:mm:ss');
                       }
                    },
                ]
            });
            var query = datatable.getDataSourceQuery();

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
            $("#table_products_mutations").table2excel({
                exclude: ".noExl",
                name: "Excel Document Name"
            });
        });
    });
</script>
<?php $this->end(); ?>



