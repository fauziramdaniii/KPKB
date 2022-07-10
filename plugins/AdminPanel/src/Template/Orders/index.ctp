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
            <h3 class="kt-subheader__title">Orders</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('List Orders') ?></h3>
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
                                            1 => 'text-primary',
                                            2 => 'text-warning',
                                            3 => 'text-success',
                                            4 => 'text-danger',
                                            5 => 'text-danger',
                                        ];
                                    ?>
                                    <?php foreach($statusTypes as $key => $status):?>
                                    <li class="nav-item">
                                        <a class="nav-link <?= ($key == 2) ? 'active' : '';?> <?= $text[$key];?>" data-toggle="tab" href="#<?= strtolower($status);?>" data-status="<?= strtolower($status);?>" role="tab" aria-selected="false">
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
                                    <div class="tab-pane <?= ($key == 2) ? 'active' : '';?>" id="<?= strtolower($status);?>" role="tabpanel">

                                        <?php if($key == 2) :?>
                                            <div class="kt-form kt-fork--label-align-right kt-margin-t-20 collapse" id="kt_datatable_group_action_form_<?= strtolower($status);?>">
                                                <div class="row align-items-center">
                                                    <div class="kt-form__label kt-form__label-no-wrap col-xl-2">
                                                        <label class="kt--font-bold kt--font-danger-">Selected
                                                            <span id="kt_datatable_selected_number_<?= strtolower($status);?>">0</span> records:</label>
                                                    </div>
                                                    <div class="kt-form__control col-xl-2">
                                                        <?php
                                                            unset($statusTypes[1]);
                                                            unset($statusTypes[2]);
                                                            unset($statusTypes[5]);
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
                                        <div class="kt_datatable" id="table-order-<?= strtolower($status);?>"></div>
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
                    field: 'Orders.invoice',
                    title: 'Invoice',
                    template: function(row) {
                        return row.invoice;
                    }
                },
                {
                    field: 'Customers.username',
                    title: 'Username',
                    template: function(row) {
                        return row.customer.username;
                    }
                },
                {
                    field: 'Orders.total',
                    title: 'Total',
                    template: function(row) {

                        var tablerow = '';
                        $.each(row.order_details, function(k,v){
                            tablerow += `<tr>
                                            <td>${v.product.name}</td>
                                            <td>${v.qty}</td>
                                            <td>${(new Intl.NumberFormat('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 2})).format(v.total)}</td>
                                        </tr>`;
                        })

                        return `
                            ${(new Intl.NumberFormat('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 2})).format(row.total)}
                            <a class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" data-target="#modalOrder${row.id}"> <i class="la la-shopping-cart"></i> </a>
                            <div class="modal fade" id="modalOrder${row.id}" tabindex="-1" role="dialog" aria-labelledby="modalOrder${row.id}" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Order Invoice ${row.invoice}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body kt-font-transform-c">
                                            <p>Order Detail Informations</p>
                                            <table class="table table-hover" style="font-size: 1rem !important;">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    ${tablerow}
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
                    }
                },
                {
                    field: 'Orders.order_status_id',
                    title: 'Status',
                    template: function(row) {
                        const badge = {
                            '1': 'badge badge-secondary',
                            '2': 'badge badge-warning',
                            '3': 'badge badge-success',
                            '4': 'badge badge-danger',
                        };

                        const classes = badge[row.order_status_id] ?
                            badge[row.order_status_id] :
                            'badge badge-secondary';

                        return `<span class="${classes}">
                            ${row.order_status.name}
                            </span>`;
                    }
                },

                {
                    field: 'Orders.created',
                    title: 'Request Date',
                    template: function(row) {
                        return moment(row.created).format('YYYY-MM-DD h:mm:ss');
                    }
                },
                {
                    field: 'Orders.id',
                    title: 'Attachment',
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
                        var cards = '';
                        var i = 1;
                        $.each(row.order_details, function(k,v){
                            $.each(v.order_detail_serials, function(kk, vv){
                                cards += '<tr><td>'+i+'</td><td>'+v.product.name+'</td><td>'+vv.card.card_number+'</td><td style="text-transform: lowercase;">'+vv.card.serial+'</td><td><span class="'+cls[vv.card.card_status_id]+'">'+status[vv.card.card_status_id]+'</span></td></tr>'
                                i++;
                            })
                        })
                        if(row.order_confirmation){
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
                                                    <td rowspan="6" class="text-center">`
                                                        +
                                                        ( (row.order_confirmation && row.order_confirmation.image) ?
                                                            `<img src="/${row.order_confirmation.image.dir}${row.order_confirmation.image.name}" class="img-responsive" style="width: 350px;">` : ''
                                                        )
                                                        +
                                                        `</td><td>Bank</td>
                                                            <td>${row.order_confirmation.customer_bank ? row.order_confirmation.customer_bank.bank.name : ''}</td></tr>
                                                        <tr>
                                                            <td>Account Name</td>
                                                            <td>${row.order_confirmation.customer_bank ? row.order_confirmation.customer_bank.account_name : ''}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Account Number</td>
                                                            <td>${row.order_confirmation.customer_bank ? row.order_confirmation.customer_bank.account_number : ''}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Branch</td>
                                                            <td>${row.order_confirmation.customer_bank ? row.order_confirmation.customer_bank.branch : ''}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Confirmation date</td>
                                                            <td>${row.order_confirmation.created ? moment(row.order_confirmation.created).format('YYYY-MM-DD h:mm:ss') : ''}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Note</td>
                                                            <td>${row.order_confirmation.note ? row.order_confirmation.note : '-'}</td>
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
                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" data-target="#modalAddress${row.id}"> &nbsp; <i class="la la-map-marker"></i></a>
                                <div class="modal fade" id="modalAddress${row.id}" tabindex="-1" role="dialog" aria-labelledby="modalAddress${row.id}" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Address Informations</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body kt-font-transform-c">
                                                <table class="table table-hover" style="font-size: 1rem !important;">
                                                    <tbody>
                                                        <tr>
                                                            <td>Receive Name</td>
                                                            <td>${row.customer.full_name ? row.customer.full_name : '-'}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Provice</td>
                                                            <td>${row.province.name}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>City</td>
                                                            <td>${row.city.name}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Subdistrict</td>
                                                            <td>${row.subdistrict ? row.subdistrict.name : '-'}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address</td>
                                                            <td>${row.address}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phone</td>
                                                            <td>${row.customer.phone ? row.customer.phone : '-'}</td>
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
                                <a href="<?= $this->Url->build(['action' => 'print']);?>/${row.invoice}" class="btn btn-sm btn-clean btn-icon btn-icon-md"> &nbsp; <i class="la la-print"></i></a>
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

        allowed = ["waiting"];
        if (allowed.indexOf(status) == -1) {
            options.columns[0].visible = false;
        }

        // allowedAwbInfo = ["complete"];
        // if (allowedAwbInfo.indexOf(status) == -1) {
        //     options.columns[3].visible = false;
        // }

        allowedAttachment = ["waiting","complete"];
        if (allowedAttachment.indexOf(status) == -1) {
            options.columns[6].visible = false;
        }

        var datatable = $('#table-order-'+status).KTDatatable(options);


        // $('#form__status').on('change', function() {
        //     datatable.search($(this).val().toLowerCase(), 'withdrawal_status_id');
        // });

        $('#form__status, #form__status_selected_'+status).selectpicker();

        datatable.on(
            'kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated',
            function(e) {
                var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes();
                var count = checkedNodes.length;
                $('#kt_datatable_selected_number_'+status).html(count);
                if (count > 0) {
                    $('#kt_datatable_group_action_form_'+status).collapse('show');
                } else {
                    $('#kt_datatable_group_action_form_'+status).collapse('hide');
                    $('.kt-checkbox--all').hide();

                }
                $(':checkbox').on('change', function checked() {
                    $(':checkbox').not(this).prop('disabled', this.checked);
                    $(':checkbox').off('change', checked);
                })

            });


        $('#kt_modal_fetch_id_'+status).on('show.bs.modal', function(e) {

            var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes();
            var count = checkedNodes.length;
            $('.update-title').html((count > 1 ) ? 'Mass update order status' : 'Update order status');
            $('.update-ask').html((count > 1 ) ? 'Are you sure want to mass update this entire row?' : 'Are you sure want to update this row?');

            var ids = [];
            datatable.rows('.kt-datatable__row--active')
                .nodes()
                .find('.kt-checkbox--single > [type="checkbox"]')
                .map(function(i, chk) {
                    ids[i] = $(chk).val();
                });

            const is_fire = $(this).data('is_fire');

            if (!is_fire) {
                $(this).data('is_fire', true);
                $('.btn-confirm-' + status).on('click', function confirm(e) {
                    $.ajax({
                        url: '<?= $this->Url->build(['action' => 'process']);?>',
                        method: 'post',
                        data: {
                            status: $('#form__status_selected_' + status).val(),
                            ids: ids,
                            // awb :$('#form__awb').val(),
                            _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                        },
                        dataType: 'json',
                        success: function (response) {
                            location.reload();
                        }
                    });
                    $(this).off('click', confirm);
                    e.preventDefault();
                })
            }

        });

    };


    function setId(id){
        $('#update_awb').modal('show');
        // $('#form__awb_id').val(id);
    }

    jQuery(document).ready(function() {
       // KTDatatableRecordSelectionDemo.init();
       tableWd('waiting');
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
                    // awb :$('#form__awb_update').val(),
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



