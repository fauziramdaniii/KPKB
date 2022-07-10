<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $customers
 * nevix
 */
?>

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Events</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('List Participants') ?></h3>
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
                                                <?= $this->Form->select('confirm', ['1' => 'Confirm', '2' => 'Maybe'], [
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
                    <div id="present-button-wrap" style="display: none">
                        <button class="btn btn-primary btn-sm btn-present" data-present="1">PRESENT</button>
                        <button class="btn btn-danger btn-sm btn-present" data-present="0">NOT PRESENT</button>
                    </div>
                    <div class="kt_datatable" id="table-events"></div>
                    <!--end: Datatable -->


                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->append('script'); ?>

<script>

    $('select').selectpicker();
    var DatatableRemoteAjaxDemo = function() {
        var demo = function() {
            var datatable = $('#table-events').KTDatatable({
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
                            return row.customer && row.customer.username;
                        }
                    },
                    {
                        field: 'Customers.full_name',
                        title: 'Name',
                        template: function(row) {
                            return row.customer && row.customer.full_name;
                        }
                    },
                    {
                        field: 'Events.title',
                        title: 'Event',
                        template: function(row) {
                            return row.event && row.event.title;
                        }
                    },
                    {
                        field: 'EventAttendances.confirm',
                        title: 'Status',
                        template: function(row) {
                            const statuses = {
                                1: 'Confirm',
                                2: 'May',
                                3: 'No'
                            };
                            return statuses[row.confirm];
                        }
                    },
                    {
                        field: 'EventAttendances.present',
                        title: 'Attendance',
                        template: function(row) {

                            return row.present ? 'PRESENT' : 'NOT PRESENT';
                        }
                    },

                ]
            });

            let ids = [];
            datatable.on(
                'kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated',
                function(e) {
                    var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes();
                    var count = checkedNodes.length;
                    if (count > 0) {
                        $('#present-button-wrap').show();
                    } else {
                        $('#present-button-wrap').hide();
                    }

                    ids = []; //reset
                    datatable.rows('.kt-datatable__row--active')
                        .nodes()
                        .find('.kt-checkbox--single > [type="checkbox"]')
                        .map(function(i, chk) {
                            ids[i] = $(chk).val();
                        });

                });

            $('.btn-present').on('click', function() {
                $.ajax({
                    url : '<?= $this->Url->build(['action' => 'process']);?>',
                    method : 'post',
                    data : {
                        status : $(this).data('present'),
                        ids :ids,
                        // awb :$('#form__awb').val(),
                        _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                    },
                    dataType : 'json',
                    success : function (response) {
                        datatable.reload();
                    }
                });
            })


            var query = datatable.getDataSourceQuery();

            $('#form__status').on('change', function() {
                datatable.search($(this).val().toLowerCase(), 'confirm');
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



