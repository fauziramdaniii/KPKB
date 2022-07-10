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
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Order List');?></h5>
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
                    <span class="card-label"><?= __('Order List');?></span>
                </h3>
            </div>
            <div class="card-body">
                <?= $this->Flash->render() ?>

                <div class="mb-7">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" name="generalSearch" placeholder="<?= __('Search');?>..." id="generalSearch">
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block"><?= __('Status');?>:</label>
                                        <?= $this->Form->select('', $order_status, [
                                            'div' => false,
                                            'label' => false,
                                            'empty' => '--',
                                            'class' => 'form-control',
                                            'id' => 'kt_form_status',
                                        ]); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="datatable datatable-bordered datatable-head-custom" id="ajax_data_order"></div>

            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="modalTrack" tabindex="-1" role="dialog" aria-labelledby="modalTrack" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Track Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="spinner-grow" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="show-tracking" style="display:none;">
                    <div class="row">
                        <div class="col-md-6">
                            <p><span class="kt-font-boldest">Hasil pelacakan Paket</span></p>
                            <table class="table table-hover table-striped m-table">
                                <thead>
                                <tr>
                                    <th style="width: 45%;">Informasi</th>
                                    <th style="width: 10%;"></th>
                                    <th style="width: 45%;">Keterangan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Nomor resi</td>
                                    <td>:</td>
                                    <td class="waybill_number"></td>
                                </tr>
                                <tr>
                                    <td>Jenis layanan</td>
                                    <td>:</td>
                                    <td class="service_code"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal pengiriman</td>
                                    <td>:</td>
                                    <td class="waybill_date"></td>
                                </tr>
                                <tr>
                                    <td>Berat kiriman</td>
                                    <td>:</td>
                                    <td><span class="weight">0</span> Kg</td>
                                </tr>
                                <tr>
                                    <td>Nama pengirim</td>
                                    <td>:</td>
                                    <td class="shippper_name"></td>
                                </tr>
                                <tr>
                                    <td>Kota asal pengirim</td>
                                    <td>:</td>
                                    <td class="shipper_city"></td>
                                </tr>
                                <tr>
                                    <td>Nama penerima</td>
                                    <td>:</td>
                                    <td class="receiver_name"></td>
                                </tr>
                                <tr>
                                    <td>Alamat penerima</td>
                                    <td>:</td>
                                    <td><span class="receiver_address1"></span>, <span class="receiver_address2"></span>, <span class="receiver_address3"></span>, <span class="receiver_city"></span></td>
                                </tr>
                                </tbody>
                            </table>

                            <p><span class="kt-font-boldest">Status pengiriman</span></p>
                            <table class="table table-hover table-striped m-table">
                                <thead>
                                <tr>
                                    <th style="width: 45%;">Informasi</th>
                                    <th style="width: 10%;"></th>
                                    <th style="width: 45%;">Keterangan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td class="status"></td>
                                </tr>
                                <tr>
                                    <td>Nama penerima</td>
                                    <td>:</td>
                                    <td class="pod_receiver"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal diterima</td>
                                    <td>:</td>
                                    <td class="pod_date"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">

                            <p><span class="kt-font-boldest">Riwayat pengiriman</span></p>
                            <table class="table table-hover table-striped m-table status-pengiriman">
                                <thead>
                                <tr>
                                    <th style="width: 50%;">Tanggal</th>
                                    <th style="width: 50%;">Keterangan</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->Html->script([
    '/member-assets/plugins/numeral/numeral.min.js',
    '/member-assets/plugins/bootbox/bootbox.all.min.js',
], ['block' => true]); ?>
<?php $this->append('script'); ?>
<script>

    let datatable;

    $('#modalTrack').on('hidden.bs.modal', function () {
        $('.spinner-grow').show();
    });

    function trackOrder(awb,courrier){
        $('#modalTrack').modal('show');
        $.ajax({
            url : '<?= $this->Url->build(['action' => 'getShipping']);?>',
            method : 'post',
            data : {
                awb :awb,
                courrier :courrier,
                _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
            },
            dataType : 'json',
            success : function (response) {
                if(response.rajaongkir){
                    $('.show-tracking').show();
                    $('.spinner-grow').hide();
                    var status_pengiriman = '';
                    $.each(response.rajaongkir.result.details, function (className, value){
                        $('.'+className).text(value);
                    })
                    $.each(response.rajaongkir.result.delivery_status, function (className, value){
                        $('.'+className).text(value);
                    })

                    $.each(response.rajaongkir.result.manifest, function (className, value){
                        status_pengiriman += `<tr><td>${value.manifest_date} ${value.manifest_time}</td><td>${value.manifest_description}</td></tr>`;
                    })
                    $('.service_code').text(response.rajaongkir.result.summary.service_code);
                    $('.status-pengiriman > tbody').html(status_pengiriman);
                }
            }
        });
    }

    const deleteOrder = function(id) {
        bootbox.prompt({
            //size: "small",
            title: "<?= __('Confirm password');?>",
            inputType: "password",
            required: true,
            placeholder: "<?= __('Please input your password');?>",
            closeButton: false,
            callback: function(serial) {
                if (serial) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= $this->Url->build(['action' => 'delete']); ?>/' + id,
                        data: {
                            id: id,
                            _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>',
                            password: serial
                        }
                    })
                        .done(function( data ) {
                            location.reload();
                        })
                        .fail(function(data) {
                            //console.log('error', data.responseJSON)
                            swal.fire("ERROR!", data.responseJSON.message ,"error")
                                .then(function(result) {
                                    if (result.value) {
                                        deleteBank(id);
                                    }
                                })


                        });
                }
            }
        });
    };

    jQuery(document).ready(function() {

        $('#kt_form_status').selectpicker();

         datatable = $('#ajax_data_order').KTDatatable({
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

            // layout definition
            layout: {
                scroll: false,
                footer: false,
            },

            // column sorting
            sortable: false,
            pagination: true,

            search: {
                input: $('#generalSearch'),
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
                    field: 'invoice',
                    sortable: false,
                    title: "<?= __('Invoice');?>",
                },
                {
                    field: 'province.name',
                    sortable: false,
                    title: "<?= __('Province');?>",
                },
                {
                    field: 'city.name',
                    sortable: false,
                    title: "<?= __('City');?>",
                },
                {
                    field: 'address',
                    sortable: false,
                    title: "<?= __('Address');?>",
                },
                {
                    field: 'total',
                    title: "<?= __('Total');?>",
                    template: function(row) {
                        return numeral(row.total).format('0,0');
                    }
                },

                {
                    field: 'flag',
                    title: "<?= __('Order To');?>",
                    template: function(row) {
                        return (row.flag == 1) ? 'Company' : 'Stockist';
                    }
                },

                {
                    field: 'order_status_id',
                    sortable: false,
                    title: "<?= __('Status');?>",
                    template: function(row) {

                        const badge = {
                            '1': 'badge badge-info',
                            '2': 'badge badge-warning',
                            '3': 'badge badge-success',
                            '4': 'badge badge-danger',
                        };

                        const classes = badge[row.order_status_id] ?
                            badge[row.order_status_id] :
                            'badge badge-secondary';

                        return `<span class="${classes}">
                            ${row.order_status.name}
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
						<a href="<?= $this->Url->build(['action' => 'detailOrder']); ?>/'+ row.id +'" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Detail Order">\
							<i class="flaticon-file-2"></i>\
						</a>';

                        if ((row.order_status_id == 1)) {
                            action += '<a href="<?= $this->Url->build(['action' => 'confirmOrder']); ?>/'+ row.id + '" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Confirm Order">\
                            <i class="flaticon-tool-1"></i>\
                            </a>';
                        }

                        if ((row.order_status_id == 3) && (row.shipping_status_id == 2)) {
                            action += '<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-sm track-order" title="Track Order"  onclick="trackOrder(\''+row.awb+'\', \''+row.courrier+'\')"><i class="flaticon-map-location"></i></a>';
                        }

                        if(row.order_status_id == 1){
                            action += '<a href="javascript:deleteOrder('+ row.id + ')" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Confirm Order">\
                            <i class="flaticon-delete"></i>\
                            </a>';

                        }
                        return action;
                    },
                }
            ],

        });

        $('#kt_form_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'order_status_id');
        });

    });
</script>
<?php $this->end(); ?>
