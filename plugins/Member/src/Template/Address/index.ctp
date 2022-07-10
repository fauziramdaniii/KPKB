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
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Shipping Address');?></h5>
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
                    <h3 class="card-label"><?= __('Shipping Address');?></h3>
                </div>

                <div class="card-toolbar">
                    <a href="<?= $this->Url->build(['action' => 'add']); ?>" class="btn btn-light-primary font-weight-bold">
                        <i class="ki ki-plus icon-md mr-2"></i> <?= __( 'New Shipping Destination Address'); ?></a>
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
                                        <input type="text" class="form-control" placeholder="Search..." name="generalSearch" id="generalSearch" />
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Search Form-->
                <!--end: Search Form-->

                <div class="kt-margin-t-15 kt-padding-l-15 kt-padding-r-15">
                    <?= $this->Flash->render() ?>
                </div>

                <!--begin: Datatable -->
                <div  class="table-responsive">
                    <div class="datatable datatable-bordered datatable-head-custom" id="ajax_data_address"></div>
                </div>
                <!--end: Datatable -->
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

    var KTDatatableRecordSelectionDemo = function() {
        // Private functions

        var options = {
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
            rows: {
                autoHide: !1
            },
            // columns definition
            columns: [
                {
                    field: 'id',
                    title: '#',
                    sortable: false,
                    width: 20,
                    selector: {
                        class: 'kt-checkbox--solid'
                    },
                    textAlign: 'center',
                },
                {
                    field: 'receiver_name',
                    sortable: false,
                    title: "<?= __('Receiver Name');?>",
                },
                {
                    field: 'receiver_phone',
                    sortable: false,
                    title: "<?= __('Receiver Phone');?>",
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
                    field: 'subdistrict.name',
                    sortable: false,
                    title: "<?= __('District');?>",
                },
                {
                    field: 'zip',
                    title: "<?= __('Zip');?>",
                },
                {
                    field: 'address',
                    title: "<?= __('Address');?>",
                },
                {
                    field: 'primary',
                    title: "<?= __('Primary Address');?>",
                    template: function(row) {
                        return row.primary ? '<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill"><?= __('Primary Address');?></span>' : ''
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
                        return '\
                        <a href="<?= $this->Url->build(['action' => 'edit']); ?>/'+ row.id +'" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit Alamat">\
                            <i class="flaticon-edit-1"></i>\
                        </a>\
                    ';
                    },
                }
            ],
        };

        // basic demo
        var localSelectorDemo = function() {

            options.search = {
                input: $('#generalSearch'),
            };

            var datatable = $('#ajax_data_address').KTDatatable(options);

            $('#kt_form_status').on('change', function() {
                datatable.search($(this).val().toLowerCase(), 'status');
            });

            $('#kt_form_type').on('change', function() {
                datatable.search($(this).val().toLowerCase(), 'type');
            });

            $('#kt_form_status,#kt_form_type').selectpicker();

            datatable.on(
                'datatable-on-check datatable-on-uncheck',
                function(e) {
                    var checkedNodes = datatable.rows('.datatable-row-active').nodes();
                    var count = checkedNodes.length;
                    var ids = datatable.rows('.datatable-row-active').
                    nodes().
                    find('.kt-checkbox--single > [type="checkbox"]').
                    map(function(i, chk) {
                        return $(chk).val();
                    });

                    $.ajax({
                        url : '<?= $this->Url->build(['action' => 'primary']);?>',
                        method : 'post',
                        data : {
                            ids :ids[0],
                            _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                        },
                        dataType : 'json',
                        success : function (response) {
                            location.reload();
                        }
                    });
                });


        };

        return {
            // public functions
            init: function() {
                localSelectorDemo();
            }
        };
    }();


    jQuery(document).ready(function() {

        KTDatatableRecordSelectionDemo.init();

        $('#ajax_data_address').on('kt-datatable--on-layout-updated', function() {
            $('#ajax_data_address .kt-checkbox--all').hide();
        })

        // $('#ajax_data_address').on('kt-datatable--on-check', function(args) {
        //     var ids = datatable.rows('.kt-datatable__row--active').
        //     nodes().
        //     find('.kt-checkbox--single > [type="checkbox"]').
        //     map(function(i, chk) {
        //         return $(chk).val();
        //     });
        //     // $('input').not(this).prop('checked', false);
        //     console.log(ids);
        //     // alert( $(this).find('input:checkbox').val());
        // })


    });
    </script>
    <?php $this->end(); ?>
