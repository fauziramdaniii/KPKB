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
                    <li class="breadcrumb-item">
                        <?= __( 'Detail Generation Level {0}',  $level); ?>
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
                    <h3 class="card-label"><?= __( 'Detail Generation Level {0}',  $level); ?></h3>
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
                                <div class="col-md-6 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block"><?= __('Rank');?>:</label>
                                        <?= $this->Form->select('', $ranks, [
                                            'div' => false,
                                            'label' => false,
                                            'empty' => '--',
                                            'class' => 'form-control bootstrap-select',
                                            'id' => 'kt_form_status',
                                        ]); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php /*
                        <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                            <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                        </div>
                        */ ?>
                    </div>
                </div>
                <!--end::Search Form-->
                <!--end: Search Form-->

                <div class="kt-margin-t-15 kt-padding-l-15 kt-padding-r-15">
                    <?= $this->Flash->render() ?>
                </div>

                <!--begin: Datatable -->
                <div  class="table-responsive">
                    <div class="datatable datatable-bordered datatable-head-custom" id="ajax_data_generation_detail"></div>
                </div>
                <!--end: Datatable -->
            </div>
        </div>

    </div>
</div>



<?php $this->append('script'); ?>
<script>
    jQuery(document).ready(function() {
        $('#kt_form_status').selectpicker();

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
                    field: 'customer.username',
                    sortable: true,
                    title: "<?= __('Username');?>",
                },
                {
                    field: 'customer.first_name',
                    title: "<?= __('First Name');?>"
                },
                {
                    field: 'customer.last_name',
                    title: "<?= __('Last Name');?>"
                },
                {
                    field: 'customer.rank.name',
                    title: "<?= __('Rank');?>"
                },
                {
                    field: 'created',
                    title: "<?= __('Join On');?>",
                    template: function(row) {
                        return moment(row.created).calendar();
                    }
                }
                ],

        });

        $('#kt_form_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'rank_id');
        });
    });
</script>
<?php $this->end(); ?>
