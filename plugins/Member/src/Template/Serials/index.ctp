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
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Product Serials');?></h5>
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
                    <span class="card-label"><?= __('Product Serials');?></span>
                </h3>
            </div>
            <div class="card-body">
                <?= $this->Flash->render() ?>

                <div class="mb-7">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="input-icon">
                                <input type="text" class="form-control" name="generalSearch" placeholder="Search..." id="generalSearch">
                                <span>
                                    <i class="flaticon2-search-1 text-muted"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="datatable datatable-bordered datatable-head-custom" id="ajax_data_serials"></div>

            </div>
        </div>

    </div>
</div>





<?php $this->Html->script('/member-assets/plugins/numeral/numeral.min.js', ['block' => true]); ?>
<?php $this->append('script'); ?>
<script>

    $('#kt_form_status').selectpicker();
    let datatable;

    jQuery(document).ready(function() {


        datatable = $('#ajax_data_serials').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '<?= $this->Url->build(); ?>',
                        params: {
                            _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                        },
                        map: function(raw) {
                            // sample data mapping
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
            filterable: false,
            pagination: true,
            search: {
                input: $("#generalSearch")
            },

            // columns definition
            columns: [
                {
                    field: 'id',
                    title: '#',
                    sortable: false,
                    width: 30,
                    type: 'number',
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
                    sortable: false,
                    title: "<?= __('Card');?>",
                },
                {
                    field: 'serial',
                    sortable: false,
                    title: "<?= __('Serial Number');?>",
                },
                {
                    field: 'CardStatuses.name',
                    sortable: false,
                    title: "<?= __('Status');?>",
                    template: function(row) {
                        return row.card_status ? row.card_status.name : '-';
                    }
                },
                {
                    field: 'CustomersAlias.username',
                    sortable: false,
                    title: "<?= __('Used By');?>",
                    template: function(row) {
                        return row.customers_alias ? row.customers_alias.username : '-';
                    }
                }
            ],

        });
        $('#kt_form_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'transaction_type_id');
        });
    });
</script>
<?php $this->end(); ?>
