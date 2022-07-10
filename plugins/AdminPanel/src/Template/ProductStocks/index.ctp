<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $pages
 * @var array $auth
 * nevix
 */
?>

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Product Stock</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('Product Stock') ?></h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <?= $this->Flash->render() ?>

                    <!--begin: Search Form -->
                    <div class="kt-form kt-fork--label-right kt-margin-b-10">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
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
                                    <?php foreach($suppliers as $k => $supplier):?>
                                    <li class="nav-item">
                                        <a class="nav-link <?= ($k == $supplier_id) ? 'active' : '';?>" href="<?= $this->Url->build(['action' => 'index', $k])?>" aria-selected="false">
                                            <?= $supplier;?>
                                        </a>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <!--begin: Selected Rows Group Action Form -->
                            <div class="kt-form kt-fork--label-align-right kt-margin-t-20 collapse" id="kt_datatable_group_action_form">
                                <div class="row align-items-center">
                                    <div class="col-xl-12">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__label kt-form__label-no-wrap">
                                                <label class="kt--font-bold kt--font-danger-">Selected
                                                    <span id="kt_datatable_selected_number">0</span> records:</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <div class="btn-toolbar">
                                                    <button class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#kt_modal_fetch_id">Process</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="kt-portlet__body kt-portlet__body--fit">
                                <!--begin: Datatable -->
                                <div  class="table-responsive">
                                    <div class="kt_datatable" id="table_products_stock"></div>
                                </div>
                                <!--end: Datatable -->


                                <!--begin::Modal-->
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
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary btn-confirm" data-dismiss="modal">Confirm</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Modal-->
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

    var KTDatatableRecordSelectionDemo = function() {
        // Private functions

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
                            _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>',
                            supplier_id : '<?= $supplier_id;?>'
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
                    field: 'product.name',
                    title: 'Name',
                    template: function(row) {
                        return row.product.name;
                    }
                },
                {
                    field: 'product.sku',
                    title: 'SKU',
                    template: function(row) {
                        return row.product.sku;
                    }
                },
                {
                    field: 'quantity',
                    title: 'Qty',
                    sortable: false,
                    template: function(row) {
                        return row.quantity;
                    }
                },

                /** Action button **/
                {
                    field: "Actions",
                    width: 310,
                    title: "Actions",
                    sortable: false,
                    overflow: 'visible',
                    template: function (row, index, datatable) {
                        return '<div class="form-group mt-2">\n' +
                            '<div class="kt-radio-inline">\n' +
                            '<label class="kt-radio">\n' +
                            '<input type="radio" name="ProductOptionStocks['+row.id+'][tipe]" value="penambahan" class="mutasi mutasi'+row.id+'" data-row="'+row.id+'"> Penambahan\n' +
                            '<span></span>\n' +
                            '</label>\n' +
                            '</div>\n' +
                            '</div>\n' +
                            '<div class="kt-form__group form-group row row-val-'+row.id+'" style="display:none;">\n' +
                            '<div class="col-xl-12"><input type="number" class="form-control" id="qty-'+row.id+'" name="ProductOptionStocks['+row.id+'][stock]" placeholder="Jumlah Stock"/></div>\n' +
                            '</div>';
                    }
                }],
        };

        // basic demo
        var localSelectorDemo = function() {

            options.search = {
                input: $('#generalSearch'),
            };

            var datatable = $('#table_products_stock').KTDatatable(options);

            $('#kt_form_status').on('change', function() {
                datatable.search($(this).val().toLowerCase(), 'status');
            });

            $('#kt_form_type').on('change', function() {
                datatable.search($(this).val().toLowerCase(), 'type');
            });

            $('#kt_form_status,#kt_form_type').selectpicker();

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
                $('.update-title').html((count > 1 ) ? 'Update stock' : 'Update stock');
                $('.update-ask').html((count > 1 ) ? 'Are you sure want to mass update this entire row?' : 'Are you sure want to update this row?');

                var ids = [];
                datatable.rows('.kt-datatable__row--active')
                    .nodes()
                    .find('.kt-checkbox--single > [type="checkbox"]')
                    .map(function(i, chk) {
                        var selected = $('input[type="radio"].mutasi'+$(chk).val()+':checked');
                        ids.push({
                            id : $(chk).val(),
                            qty : $('#qty-'+$(chk).val()).val(),
                            type : selected.val()
                        });
                    });

                $('.btn-confirm').on('click',function confirm(e) {
                    e.preventDefault();
                    $.ajax({
                        url : '<?= $this->Url->build(['action' => 'confirm']); ?>',
                        method : 'post',
                        data : {
                            ids :ids,
                            supplier_id : '<?= $supplier_id;?>',
                            _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                        },
                        dataType : 'json',
                        success : function (response) {
                            location.reload();
                            // console.log(response);
                        }
                    });
                    $(this).off('click', confirm);
                })

            });



            $("#table_products_stock").on('change', 'input.mutasi',function(){
                $('.row-val-'+$(this).data('row')).show()
            })
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
    });





</script>
<?php $this->end(); ?>
