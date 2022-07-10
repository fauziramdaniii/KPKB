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
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Statements'); ?></h5>
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
                <div class="card-title">
                    <h3 class="card-label"><?= __('Statements');?></h3>
                </div>
            </div>

            <div class="card-body">

                <!--begin: Search Form-->
                <!--begin::Search Form-->
                <div class="mb-7">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-6 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" placeholder="Search..." name="generalSearch"  id="generalSearch" />
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2 my-md-0">
                                    <?php /*
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block"><?= __('Type');?>:</label>
                                        <?= $this->Form->select('', $transaction_types, [
                                            'div' => false,
                                            'label' => false,
                                            'empty' => '--',
                                            'class' => 'form-control bootstrap-select',
                                            'id' => 'kt_form_status',
                                        ]); ?>
                                    </div>
                                    */ ?>
                                </div>
                            </div>
                        </div>
                        <?php /*
                        <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                            <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                        </div>
                        */ ?>
                    </div>
                </div>
                <!--end::Search Form-->
                <!--end: Search Form-->



                <!--begin: Datatable -->
                <div  class="table-responsive">
                    <div class="datatable datatable-bordered datatable-head-custom" id="ajax_data_statement"></div>
                </div>
                <!--end: Datatable -->
            </div>
        </div>

    </div>
</div>


<?php $this->Html->script('/member-assets/plugins/numeral/numeral.min.js', ['block' => true]); ?>
<?php $this->append('script'); ?>
<script>
    $('#kt_form_status').selectpicker();
    jQuery(document).ready(function() {
        var datatable = $('#ajax_data_statement').KTDatatable({
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
                    field: 'statement_date',
                    title: "<?= __('Statement Date');?>",
                    template: function(row) {
                        return moment(row.statement_date).format('YYYY-MM-DD');
                    }
                },
                {
                    field: 'bank_name',
                    title: "<?= __('Bank');?>",
                    template: function(row) {
                        return row.bank_name;
                    }
                },
                {
                    field: 'bank_account_name',
                    title: "<?= __('Account name');?>",
                    template: function(row) {
                        return row.bank_account_name;
                    }
                },
                {
                    field: 'bank_account_number',
                    title: "<?= __('Account number');?>",
                    template: function(row) {
                        return row.bank_account_number;
                    }
                },
                {
                    field: 'total',
                    title: "<?= __('Total');?>",
                    template: function(row) {
                        return numeral(row.total).format('0,0');
                    }
                },
                {
                    field: 'status',
                    sortable: false,
                    title: "<?= __('Status Transfer');?>",
                    template: function(row) {

                        const badge = {
                            '0': 'badge badge-secondary',
                            '1': 'badge badge-success',

                        };

                        const classes = badge[row.status] ?
                            badge[row.status] :
                            'badge badge-secondary';

                        return `<span class="${classes}">
                            ${row.status === 1 ? '<?= __('Transferred'); ?>' : '<?= __('Pending'); ?>'}
                            </span>`
                    }
                },
                {
                    field: 'created',
                    title: "<?= __('Date');?>",
                    template: function(row) {
                        return moment(row.created).calendar()
                    }
                },
                {
                    field: 'Actions',
                    title: "<?= __('Actions');?>",
                    sortable: false,
                    width: 110,
                    overflow: 'visible',
                    autoHide: false,
                    template: function(row) {

                        let action = '\
						<a href="<?= $this->Url->build(['action' => 'detail']); ?>/'+ row.id +'" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Detail Statement">\
							<i class="flaticon-file-2"></i>\
						</a>';
                        return action;
                    },
                }
            ],

        });
        $('#kt_form_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'transaction_type_id');
        });
    });
</script>
<?php $this->end(); ?>
