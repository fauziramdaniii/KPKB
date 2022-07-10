<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $withdrawals
 * @var boolean $is_first_customer
 * nevix
 */
?>

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Request Activation Account</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('List Request') ?></h3>
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

    const is_first_customer = <?= ($is_first_customer ? 'true' : 'false'); ?>;
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
                    field: 'RefferalCustomers.username',
                    title: 'Referral',
                    template: function(row) {
                        return (row.customer && row.customer.refferal_customer) || row.customer.is_active ? (row.customer && row.customer.refferal_customer ? row.customer.refferal_customer.username : '-') :
                            `<a href="#" data-toggle="modal" data-target="#modalSetRefferal${row.id}">Set Refferal</a>
                                <div class="modal fade set-refferal-classes" id="modalSetRefferal${row.id}" tabindex="-1" role="dialog" aria-labelledby="modalSetRefferal${row.id}" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Set Refferal</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body kt-font-transform-c">
                                                <table class="table table-hover" style="font-size: 1rem !important;">
                                                    <tbody>

                                                        <tr>
                                                            <td>Account Email</td>
                                                            <td>${row.customer ? row.customer.email : ''}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Refferal</td>
                                                            <td>
                                                                <?= $this->Form->select('refferal_id', $networks, [
                                                                    'class' => 'form-control bootstrap-select'
                                                                ]); ?>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="save-refferal" data-id="${row.id}" data-customer-id="${row.customer ? row.customer.id : ''}" class="btn btn-primary" data-dismiss="modal">Save</button>
                                                <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                    }
                },
                {
                    field: 'Customers.email',
                    title: 'Email',
                    template: function(row) {
                        return row.customer ? row.customer.email : '-';
                    }
                },
                {
                    field: 'Customers.phone',
                    title: 'phone',
                    template: function(row) {
                        return row.customer ? row.customer.phone : '-';
                    }
                },

                {
                    field: 'CustomerActivations.created',
                    title: 'Request Date',
                    template: function(row) {
                        return moment(row.confirmation_date).format('YYYY-MM-DD h:mm:ss');
                    }
                },
                {
                    field: 'CustomerActivations.id',
                    title: 'Attachment',
                    template: function(row) {

                        if(row){
                            return `
                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" data-target="#modalAttachment${row.id}"> &nbsp;<i class="la la-paperclip"></i></a>
                                <div class="modal fade" id="modalAttachment${row.id}" tabindex="-1" role="dialog" aria-labelledby="modalAttachment${row.id}" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Attachment Informations</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body kt-font-transform-c">
                                                <table class="table table-hover" style="font-size: 1rem !important;">
                                                    <tbody>
                                                        <tr>
                                                            ${row.image ? `
                                                            <td rowspan="6" class="text-center"><img src="/${row.image.dir}${row.image.name}" class="img-responsive" style="width: 350px;"></td>
                                                            ` : ''}
                                                            <td>Bank</td>
                                                            <td>${row.customer_bank ? row.customer_bank.bank.name : ''}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Account Name</td>
                                                            <td>${row.customer_bank ? row.customer_bank.account_name : ''}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Account Number</td>
                                                            <td>${row.customer_bank ? row.customer_bank.account_number : ''}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Branch</td>
                                                            <td>${row.customer_bank ? row.customer_bank.branch : ''}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Confirmation date</td>
                                                            <td>${row.created ? moment(row.created).format('YYYY-MM-DD h:mm:ss') : ''}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Note</td>
                                                            <td>${row.note ? row.note : '-'}</td>
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

        var datatable = $('#table-confirmation-'+status).KTDatatable(options);


        // $('#form__status').on('change', function() {
        //     datatable.search($(this).val().toLowerCase(), 'withdrawal_status_id');
        // });
        // console.log(status);
        $('#form__status, #form__status_selected_'+status).selectpicker();

        const inCompleteReferal = [];

        datatable.on('kt-datatable--on-ajax-done', function(event, data) {
            //console.log(data)
            if (data.length > 0) {
                data.forEach(function(row) {
                   if (row && row.customer && !row.customer.upline_id) {
                       inCompleteReferal.push(String(row.id));
                   }

                });
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
                    /*const selector = data[0];

                    if (inCompleteReferal.indexOf(selector) > -1) {
                        //console.log(selector, inCompleteReferal);
                        $(this).prop('checked', false);
                        $(this).prop('disabled', true);
                        alert('please input refferal')
                    }*/


                    $(':checkbox').not(this).prop('disabled', this.checked);
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


            $('.btn-confirm-'+status).on('click',function (e) {
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
                        location.reload();
                    }
                });
            })

        });
        return datatable;
    };


    function setId(id){
        $('#update_awb').modal('show');
        $('#form__awb_id').val(id);
    }

    jQuery(document).ready(function() {
       // KTDatatableRecordSelectionDemo.init();
       const datatable = tableWd('pending');





        $(document).on('show.bs.modal', '.set-refferal-classes', function () {
            //alert('hi');
        })

        $("body").on("click", "#save-refferal", function() {
            const refferal_id = $(this).parents('.modal').find('select').val();
            const customer_id = $(this).data('customer-id');
            $.ajax({
                url : '<?= $this->Url->build(['action' => 'setRefferal']);?>',
                method : 'post',
                data : {
                    refferal_id: refferal_id,
                    customer_id: customer_id,
                    _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                },
                dataType : 'json',
                success : function (response) {
                    location.reload();
                }
            });



        })

       $('.nav-link').on('click',function(){
           var status = $(this).data('status');
           tableWd(status);
       })
        $('.btn-confirm-awb').on('click',function (e) {
            e.preventDefault();
            $.ajax({
                url : '<?= $this->Url->build(['action' => 'updateAwb']);?>',
                method : 'post',
                data : {
                    id :$('#form__awb_id').val(),
                    awb :$('#form__awb_update').val(),
                    _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                },
                dataType : 'json',
                success : function (response) {
                    location.reload();
                }
            });
        })
    });
</script>
<?php $this->end(); ?>



