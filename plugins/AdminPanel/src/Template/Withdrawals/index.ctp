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
            <h3 class="kt-subheader__title">Withdrawals</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('List Withdrawals') ?></h3>
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
                                    <li class="nav-item">
                                        <a class="nav-link active text-warning" data-toggle="tab" href="#pending" data-status="pending" role="tab" aria-selected="false">
                                            <?= __( 'Pending Requests')?>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-success" data-toggle="tab" href="#success"  data-status="success" role="tab" aria-selected="false">
                                            <?= __( 'Success Requests')?>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-danger" data-toggle="tab" href="#failed" data-status="failed"  role="tab" aria-selected="true">
                                            <?= __( 'Failed Requests')?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="pending" role="tabpanel">

                                    <div class="kt-form kt-fork--label-align-right kt-margin-t-20 collapse" id="kt_datatable_group_action_form">
                                        <div class="row align-items-center">
                                            <div class="kt-form__label kt-form__label-no-wrap col-xl-2">
                                                <label class="kt--font-bold kt--font-danger-">Selected
                                                    <span id="kt_datatable_selected_number">0</span> records:</label>
                                            </div>
                                            <div class="kt-form__control col-xl-2">
                                                <?php unset($statusTypes[1]); ?>
                                                <?= $this->Form->select('selected_status', $statusTypes, [
                                                    'class' => 'form-control bootstrap-select',
                                                    'id' => 'form__status_selected'
                                                ]); ?>
                                            </div>
                                            <button class="btn btn-success col-xl-2" type="button" data-toggle="modal" data-target="#kt_modal_fetch_id">Submit</button>
                                        </div>
                                    </div>

                                    <div class="kt_datatable" id="table-pending">
                                    </div>

                                    <div class="modal fade" id="kt_modal_fetch_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <div class="row align-items-center mt-2">
                                                        <div class="kt-form__control col-xl-12">
                                                            <?php unset($statusTypes[1]); ?>
                                                            <?= $this->Form->control('note', [
                                                                'label' => 'Reason why?',
                                                                'type' => 'textarea',
                                                                'class' => 'form-control',
                                                                'id' => 'form__note'
                                                            ]); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary btn-confirm" data-dismiss="modal">Confirm</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="success" role="tabpanel">
                                    <div class="kt_datatable" id="table-success"></div>
                                </div>
                                <div class="tab-pane" id="failed" role="tabpanel">
                                    <div class="kt_datatable" id="table-failed"></div>
                                </div>
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
                    selector: {
                        class: 'kt-checkbox--solid'
                    },
                    textAlign: 'center'
                },
                {
                    field: 'Customers.username',
                    title: 'Username',
                    template: function(row) {
                        return row.customer.username;
                    }
                },

                {
                    field: 'Withdrawals.bank_name',
                    title: 'Bank Name',
                    template: function(row) {
                        return row.bank_name;
                    }
                },


                {
                    field: 'Withdrawals.bank_account_name',
                    title: 'Account Name',
                    template: function(row) {
                        return row.bank_account_name;
                    }
                },

                {
                    field: 'Withdrawals.bank_account_number',
                    title: 'Account Number',
                    template: function(row) {
                        return row.bank_account_number;
                    }
                },

                {
                    field: 'WithdrawalStatuses.name',
                    title: 'Status',
                    template: function(row) {

                        const badge = {
                            '1': 'badge badge-warning',
                            '2': 'badge badge-success',
                            '3': 'badge badge-danger',
                        };

                        const classes = badge[row.withdrawal_status_id] ?
                            badge[row.withdrawal_status_id] :
                            'badge badge-secondary';

                        return `<span class="${classes}">
                            ${row.withdrawal_status.name}
                            </span>`;
                    }
                },

                {
                    field: 'Withdrawals.amount',
                    title: 'Amount',
                    template: function(row) {
                        return (new Intl.NumberFormat('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 2})).format(row.amount);
                    }
                },
                {
                    field: 'Withdrawals.created',
                    title: 'Request Date',
                    template: function(row) {
                        return moment(row.created).format('YYYY-MM-DD h:mm:ss');
                    }
                },
            ],
        };

        options.search = {
            input: $('#generalSearch'),
        };

       if(status != 'pending'){
           options.columns[0].visible = false;
       }
        var datatable = $('#table-'+status).KTDatatable(options);


        $('#form__status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'withdrawal_status_id');
        });

        $('#form__status, #form__status_selected').selectpicker();

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
                    url : '<?= $this->Url->build(['action' => 'process']);?>',
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

    };


    jQuery(document).ready(function() {
        // KTDatatableRecordSelectionDemo.init();
        tableWd('pending');
        $('.nav-link').on('click',function(){
            var status = $(this).data('status');
            tableWd(status);
        })
    });
</script>
<?php $this->end(); ?>



