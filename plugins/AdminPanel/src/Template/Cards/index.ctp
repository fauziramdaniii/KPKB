<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $pages
 * nevix
 */
?>

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"><?= __('Product Serials');?></h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('Product Serials');?></h3>
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
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Status: </label>
                                            </div>
                                            <div class="kt-form__control">
                                                <?= $this->Form->select('card_status_id', $cardStatuses, [
                                                    'empty' => 'All',
                                                    'class' => 'form-control bootstrap-select',
                                                    'id' => 'form__status'
                                                ]); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end: Search Form -->

                    <!--begin: Datatable -->
                    <div class="kt_datatable" id="table-cards"></div>
                    <!--end: Datatable -->


                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->append('script'); ?>
<script>
    $('.bootstrap-select').selectpicker();


    var DatatableRemoteAjaxDemo = function() {
        var demo = function() {
            var datatable = $('#table-cards').KTDatatable({
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
                        sortable: true,
                        width: 40,
                        selector: false,
                        textAlign: 'center',
                        template: function(row, index, datatable) {
                            return (datatable.getCurrentPage() - 1) * datatable.getPageSize() + index + 1;
                        }
                    },
                    {
                        field: 'Products.name',
                        sortable: false,
                        title: "<?= __('Product');?>",
                        template: function(row) {
                            return row.product ? row.product.name : '-';
                        }
                    },
                    {
                        field: 'card_number',
                        title: 'Card',
                    },
                    {
                        field: 'serial',
                        title: 'Serial',
                    },
                    {
                        field: 'Suppliers.name',
                        sortable: false,
                        title: "<?= __('Werehouse');?>",
                        template: function(row) {
                            return row.supplier ? row.supplier.name : '-';
                        }
                    },

                    {
                        field: 'order_detail_serial.order_detail.order.customer.username',
                        title: 'On Stockist',
                        template: function(row) {
                            return row.stockist ? row.stockist.username : '-';
                        }
                    },
                    {
                        field: 'card_status',
                        title: 'Status',
                        template: function(row) {
                            let cls = {
                                '1' : 'kt-badge  kt-badge--success kt-badge--inline kt-badge--pill',
                                '2' : 'kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill',
                                '3' : 'kt-badge  badge-secondary kt-badge--inline kt-badge--pill',
                                '4' : 'kt-badge  badge-success kt-badge--inline kt-badge--pill',
                            };
                            let status = {
                                '1' : 'Active',
                                '2' : 'Used',
                                '3' : 'Inactive',
                                '4' : 'Ready to use',
                            };
                            return '<span class="'+cls[row.card_status_id]+'">'+status[row.card_status_id]+'</span>' ;
                        }
                    },
                    {
                        field: 'CustomersAlias.username',
                        sortable: false,
                        title: "<?= __('Used By');?>",
                        template: function(row) {
                            return row.customers_alias ? row.customers_alias.username : '-';
                        }
                    },

                    {
                        field: 'modified',
                        title: 'Last Update',
                        template: function(row) {
                            return moment(row.modified).format('YYYY-MM-DD h:mm:ss');
                        }
                    },


                ]
            });
            var query = datatable.getDataSourceQuery();

            $('#form__status').on('change', function() {
                datatable.search($(this).val().toLowerCase(), 'card_status_id');
            });

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



