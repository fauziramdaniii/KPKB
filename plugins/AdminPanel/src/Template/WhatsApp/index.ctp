<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $whatsapp
 */
?>

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">WhatsApp</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('No WhatsApp') ?></h3>
                    </div>
                    <!-- <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <a href="<?= $this->Url->build(['action' => 'add']); ?>"
                                class="btn btn-default btn-bold btn-upper btn-font-sm">
                                <i class="flaticon2-add-1"></i>
                                <?= __('Tambah WhatsApp') ?>
                            </a>
                        </div>
                    </div> -->
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
                                            <input type="text" class="form-control kt-input" placeholder="Search..."
                                                id="generalSearch">
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

                    <!--begin: Datatable -->
                    <div class="kt_datatable" id="table-whatsapp"></div>
                    <!--end: Datatable -->


                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->append('script'); ?>
<script>
function delete_data(id) {
    $.post("<?= $this->Url->build(['action' => 'delete']); ?>/" + id, {
            _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
        })
        .done(function(data) {
            location.href = '<?= $this->Url->build();?>';
        });
}

var DatatableRemoteAjaxDemo = function() {
    var demo = function() {
        var datatable = $('#table-whatsapp').KTDatatable({
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'POST',
                        url: '<?= $this->Url->build(['controller' => 'WhatsApp', 'action' => 'index']); ?>',
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
            order: [
                [0, "desc"]
            ],
            columns: [{
                    field: 'id',
                    title: '#',
                    sortable: true,
                    width: 40,
                    selector: false,
                    textAlign: 'center',
                    template: function(row, index, datatable) {
                        return ++index;
                    }
                },
                {
                    field: 'no_whatsapp',
                    title: 'No WhatsApp',
                    template: function(row) {
                        return '+62' + row.no_whatsapp;
                    }
                },
                {
                    field: 'updated',
                    title: 'Terakhir Diubah',
                    template: function(row) {
                        return moment(row.updated).format('YYYY-MM-DD h:mm:ss');
                    }
                },

                /** Action button **/
                {
                    field: "Actions",
                    width: 110,
                    title: "Actions",
                    sortable: false,
                    overflow: 'visible',
                    template: function(row, index, datatable) {
                        return '<a href="<?= $this->Url->build(['action' => 'edit']); ?>/' + row
                            .id +
                            '"class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit"><i class="la la-edit"></i></a><a href="javascript:delete_data(' +
                            row.id + ');" onclick="return confirm(\'Are you sure delete #' + row
                            .id
                    }
                }
            ]
        });
        var query = datatable.getDataSourceQuery();

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