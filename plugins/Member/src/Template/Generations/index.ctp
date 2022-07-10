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
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Network'); ?></h5>
                <!--end::Page Title-->

                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="<?= $this->Url->build(['action' => 'index']); ?>" class="text-muted"><?= __('Generations'); ?></a>
                    </li>
                </ul>
                <!--end::Breadcrumb-->
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
                    <h3 class="card-label"><?= __('Generations');?></h3>
                </div>

            </div>

            <div class="card-body">

                <div class="kt-margin-t-15 kt-padding-l-15 kt-padding-r-15">
                    <?= $this->Flash->render() ?>
                </div>

                <!--begin: Datatable -->
                <div  class="table-responsive">
                    <div class="datatable datatable-bordered datatable-head-custom" id="ajax_data_generation"></div>
                </div>
                <!--end: Datatable -->
            </div>
        </div>

    </div>
</div>


<?php $this->append('script'); ?>
<script>
    jQuery(document).ready(function() {
        var datatable = $('.datatable').KTDatatable({
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
                        return ++index;
                    }
                },
                {
                    field: 'level',
                    sortable: false,
                    title: "<?= __('Generation Level');?>",
                    template: function(row) {
                        return `Generation level ${row.level}`;
                    }
                },
                {
                    field: 'total',
                    title: "<?= __('Total');?>",
                    template: function(row) {
                        return row.total;
                    },
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
						<a href="<?= $this->Url->build(['action' => 'detail']); ?>/'+ row.level +'" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Detail Generation">\
							<i class="flaticon2-paper"></i>\
						</a>\
					';
                    },
                }],

        });
    });
</script>
<?php $this->end(); ?>
