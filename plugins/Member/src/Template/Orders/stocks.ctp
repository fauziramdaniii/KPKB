<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \Member\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $customer
 */
?>

<div class="subheader py-6 py-lg-8 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Stock Mutations');?></h5>
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

        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="card-label"><?= __('Stock Mutations');?></span>
                </h3>
            </div>
            <div class="card-body">
                <?= $this->Flash->render() ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    </button>
                    <p><?= __('Attention, when the customer checks out, the stock of your goods will decrease according to the number of checkout made by the customer which is valid only temporarily until you confirm that the payment is received, if the customer does not make a payment until the specified deadline, the stock will be returned. provided that the time limit is 1x24 hours'); ?></p>
                </div>

                <div class="mb-7">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="input-icon">
                                <input type="text" class="form-control" name="generalSearch" placeholder="<?= __('Search');?>..." id="generalSearch">
                                    <span>
                                    <i class="flaticon2-search-1 text-muted"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="datatable datatable-bordered datatable-head-custom" id="table_products_mutation_customer"></div>

            </div>
        </div>

    </div>
</div>




<?php $this->append('script'); ?>
<script>

    var DatatableRemoteAjaxDemo = function() {
        var demo = function() {
            var datatable = $('#table_products_mutation_customer').KTDatatable({
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
                        title: '<?= __('Product Name');?>',
                        width: 100,
                        template: function(row) {
                            return row.customer_stock_mutations ? row.customer_stock_mutations[0].product.name : '-';
                        }
                    },
                    {
                        field: 'CustomerStockMutationTransactions.description',
                        title: '<?= __('Description');?>',
                        width: 400,
                        template: function(row) {
                            return row.description;
                        }
                    },
                    {
                        field: 'qty_in',
                        title: '<?= __('Qty In');?>',
                        width: 70,
                        sortable: false,
                        template: function(row) {
                            return row.customer_stock_mutations[0].qty_in;

                        }
                    },
                    {
                        field: 'qty_out',
                        title: '<?= __('Qty Out');?>',
                        width: 70,
                        sortable: false,
                        template: function(row) {
                            return row.customer_stock_mutations[0].qty_out;

                        }
                    },
                    {
                        field: 'total_qty',
                        title: '<?= __('Total');?>',
                        width: 90,
                        sortable: false,
                        template: function(row) {
                            return row.customer_stock_mutations[0].total_qty;
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
    });
</script>
<?php $this->end(); ?>
