<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $withdrawals
 * @var \Cake\I18n\Time $date
 * nevix
 */
?>

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"><?= __('Statements'); ?></h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('List Statement') ?></h3>
                    </div>

                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <a href="#" class="btn btn-default btn-bold btn-upper btn-font-sm" id="export2excel">
                                <i class="flaticon-download"></i>
                                <?= __('Export to Excel') ?>
                            </a>
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
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" value="<?= $date->format('m/Y'); ?>" class="form-control kt-input" placeholder="Statement date..." id="statementDate">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span>
                                                    <i class="la la-calendar"></i>
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
                                        0 => 'text-warning',
                                        1 => 'text-success',
                                        2 => 'text-danger',
                                    ];
                                    ?>
                                    <?php foreach($statusTypes as $key => $status):?>
                                        <li class="nav-item">
                                            <a class="nav-link <?= ($key == 0) ? 'active' : '';?> <?= $text[$key];?>" data-toggle="tab" href="#<?= strtolower($status);?>" data-status="<?= strtolower($status);?>" role="tab" aria-selected="false">
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
                                    <div class="tab-pane <?= ($key == 0) ? 'active' : '';?>" id="<?= strtolower($status);?>" role="tabpanel">

                                        <?php if($key == 0) :?>
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
                                        <div class="kt_datatable" id="table-confirmation-<?= strtolower($status);?>"></div>
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

    const datatables = {};
    const is_first_customer = false;
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
                            _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>',
                            query: {
                                statement_date: $("#statementDate").val(),
                                generalSearch: $("#generalSearch").val(),
                            }
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
                        return row.customer ? row.customer.username : '-';
                    }
                },
                {
                    field: 'Customers.first_name',
                    title: 'Full Name',
                    template: function(row) {
                        return row.customer ? row.customer.full_name : '';
                    }
                },
                {
                    field: 'CustomerStatements.bank_name',
                    title: 'Bank',
                    template: function(row) {
                        return row.bank_name;
                    }
                },
                {
                    field: 'CustomerStatements.bank_account_name',
                    title: 'Name',
                    template: function(row) {
                        return row.bank_account_name;
                    }
                },
                {
                    field: 'CustomerStatements.bank_account_number',
                    title: 'Number',
                    template: function(row) {
                        return row.bank_account_number;
                    }
                },
                {
                    field: 'CustomerStatements.statement_date',
                    title: 'Statement Date',
                    template: function(row) {
                        return moment(row.statement_date).format('YYYY-MM-DD');
                    }
                },
                {
                    field: 'CustomerStatements.total',
                    title: 'Total',
                    template: function(row) {
                        return row.total.toLocaleString();
                    }
                },
                {
                    field: 'CustomerStatements.id',
                    title: 'Detail',
                    template: function(row) {

                        if(row){
                            return `
                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" data-target="#modalAttachment${row.id}"> &nbsp;<i class="la la-paperclip"></i></a>
                                <div class="modal fade" id="modalAttachment${row.id}" tabindex="-1" role="dialog" aria-labelledby="modalAttachment${row.id}" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Statement Informations</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body kt-font-transform-c">
                                                <h4>Bank Information</h4>
                                                <table class="table table-hover" style="font-size: 1rem !important;">
                                                    <tbody>
                                                        <tr>
                                                            <td>Bank Name</td>
                                                            <td>${row.bank_name ? row.bank_name : ''}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bank City</td>
                                                            <td>${row.bank_city ? row.bank_city : ''}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bank Branch</td>
                                                            <td>${row.bank_branch ? row.bank_branch : ''}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Account Name</td>
                                                            <td>${row.bank_account_name ? row.bank_account_name : ''}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Account Number</td>
                                                            <td>${row.bank_account_number ? row.bank_account_number : ''}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <h4>Bonus Information</h4>
                                                <table class="table table-hover" style="font-size: 1rem !important;">
                                                    <tbody>
                                                        <tr>
                                                            <td>Bonus Cash Point</td>
                                                            <td class="text-right">${row.amount.toLocaleString()}</td>
                                                        </tr>
                                                        ${
                                                            row.customer_statement_details.length > 0 ? (
                                                                row.customer_statement_details.map(function(o) {
                                                                    return `<tr>
                                                                            <td>Bonus Royalti 10th ${o.sequence}</td>
                                                                            <td class="text-right">${o.amount.toLocaleString()}</td>
                                                                        </tr>`
                                                                })

                                                            ) : ''
                                                        }
                                                        <tr>
                                                             <td>Fee</td>
                                                            <td class="text-right">${row.fee > 0 ? '-' + row.fee.toLocaleString() : '0'}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total</td>
                                                            <td class="text-right">${row.total.toLocaleString()}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }else{
                            return '';
                        }
                    }
                },
            ],
        };

        options.search = {
            input: $('#generalSearch'),
        };

        allowed = ["pending"];
        if (allowed.indexOf(status) == -1) {
            options.columns[0].visible = false;
        }

        // allowedAwbInfo = ["complete"];
        // if (allowedAwbInfo.indexOf(status) == -1) {
        //     options.columns[3].visible = false;
        // }

        // allowedAttachment = ["waiting","complete"];
        // if (allowedAttachment.indexOf(status) == -1) {
        //     options.columns[7].visible = false;
        // }

        const datatable = $('#table-confirmation-'+status).KTDatatable(options);


        // $('#form__status').on('change', function() {
        //     datatable.search($(this).val().toLowerCase(), 'withdrawal_status_id');
        // });
        // console.log(status);
        $('#form__status, #form__status_selected_'+status).selectpicker();

        //const inCompleteReferal = [];

        datatable.on('kt-datatable--on-ajax-done', function(event, data) {
            //console.log(data)
            if (data.length > 0) {
                /*
                data.forEach(function(row) {
                    if (row && row.customer && !row.customer.upline_id) {
                        inCompleteReferal.push(String(row.id));
                    }

                });
                */
            }
        });

        datatable.on(
            'kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated',
            function(e, data) {

                var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes();
                var count = checkedNodes.length;
                $('#kt_datatable_selected_number_'+status).html(count);
                if (count > 0) {
                    $('#kt_datatable_group_action_form_'+status).collapse('show');
                } else {
                    $('#kt_datatable_group_action_form_'+status).collapse('hide');
                    $('.kt-checkbox--all').hide();

                }
                /*$(':checkbox').change(function(){
                    console.log(data);
                    $(':checkbox').not(this).prop('disabled', this.checked);
                });*/

                $(':checkbox').on('change', function checked() {

                    //$(':checkbox').not(this).prop('disabled', this.checked);
                    $(':checkbox').off('change', checked);
                })

            });


        $('#kt_modal_fetch_id_'+status).on('show.bs.modal', function(e) {

            var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes();
            var count = checkedNodes.length;
            $('.update-title').html((count > 1 ) ? 'Mass update confirmation status' : 'Update confirmation status');
            $('.update-ask').html((count > 1 ) ? 'Are you sure want to mass update this entire row?' : 'Are you sure want to update this row?');

            var ids = [];
            datatable.rows('.kt-datatable__row--active')
                .nodes()
                .find('.kt-checkbox--single > [type="checkbox"]')
                .map(function(i, chk) {
                    ids[i] = $(chk).val();
                });


            $('.btn-confirm-'+status).on('click',function process(e) {
                e.preventDefault();
                $.ajax({
                    url : '<?= $this->Url->build(['action' => 'process']);?>',
                    method : 'post',
                    data : {
                        status : $('#form__status_selected_'+status).val(),
                        ids :ids,
                        awb :$('#form__awb').val(),
                        _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                    },
                    dataType : 'json',
                    success : function (response) {
                        //location.reload();
                        if (datatables[status]) {
                            datatables[status].reload();
                        }
                    }
                });
                $(this).off('click', process);
            })

        });

        /*
        const statementDate = $("#statementDate");

        statementDate.on('change', function changed() {
            datatable.search($(this).val(), 'statement_date');
        })*/


        return datatable;
    };


    function setId(id){
        $('#update_awb').modal('show');
        $('#form__awb_id').val(id);
    }

    jQuery(document).ready(function() {
        // KTDatatableRecordSelectionDemo.init();

        //const datatable = tableWd('pending');



        const selector = '.nav-link';

        /*
        $(selector).each(function(i, row) {
           //console.log($(this).data('status'));
            const status = $(this).data('status');
            datatables[status] = tableWd(status);
        });*/

        datatables['pending'] = tableWd('pending');

        $('#export2excel').on('click', function() {
            //console.log(datatable.getDataSourceParam());
            const active = $('a.nav-link.active').data('status');
            console.log(active);
            location.href = '<?= $this->Url->build(['action' => 'export']);?>?' + $.param({...datatables[active].getDataSourceParam(), status: active});
        })

        $("#statementDate").datepicker({
            format: "mm/yyyy",
            startView: "months",
            minViewMode: "months",
            autoclose: true,
        }).on('change', function() {
            for(let i in datatables) {
                datatables[i].search($(this).val(), 'statement_date');
            }
        });


        $(selector).on('show.bs.tab',  function(e) {
            const status = $(this).data('status');
            if (datatables[status]) {
                datatables[status].reload();
            } else {
                datatables[status] = tableWd(status);
            }

        }).on('hide.bs.tab', function(e) {
            const status = $(this).data('status');
            if (datatables[status]) {
                //datatables[status].destroy();
            }
        }).on('hidden.bs.tab', function(e) {
            const status = $(this).data('status');
            if (datatables[status]) {
                //delete datatables[status];
            }
        })

    });
</script>
<?php $this->end(); ?>



