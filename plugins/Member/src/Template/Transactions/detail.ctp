<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \Member\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $customer
 */
?>


<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title"><?= __('Network');?></h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" class="kt-subheader__breadcrumbs-link">
                        <?= __('Detail Generation');?>  </a>

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">

                </div>
            </div>
        </div>
    </div>

    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        <?= __( 'Detail Generation Level {0}',  $level); ?>

                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <a href="<?= $this->Url->build(['action' => 'index']); ?>" class="btn btn-default btn-bold btn-upper btn-font-sm">
                            <i class="flaticon2-back"></i>
                            Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">

                <!--begin: Datatable -->
                <div class="kt_datatable" id="ajax_data"></div>

                <!--end: Datatable -->
            </div>
        </div>

    </div>

    <!-- end:: Content -->
</div>

<?php $this->append('script'); ?>
<script>
    jQuery(document).ready(function() {
        var datatable = $('.kt_datatable').KTDatatable({
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
                    title: "<?= __('First Name');?>",
                },
                {
                    field: 'customer.last_name',
                    title: "<?= __('Last Name');?>",
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
    });
</script>
<?php $this->end(); ?>
