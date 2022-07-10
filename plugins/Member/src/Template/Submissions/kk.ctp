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
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('KK'); ?></h5>
                <!--end::Page Title-->

                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="<?= $this->Url->build(['action' => 'index']); ?>" class="text-muted"><?= __('Daftar Pengajuan KK'); ?></a>
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
                    <h3 class="card-label"><?= __('Daftar Pengajuan KK');?></h3>
                </div>

                <div class="card-toolbar">
                    <a href="<?= $this->Url->build(['action' => 'listKk']); ?>" class="btn btn-light-primary font-weight-bold">
                        <i class="ki ki-plus icon-md mr-2"></i> <?= __( 'Tambah Pengajuan'); ?></a>
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
                    <div class="datatable datatable-bordered datatable-head-custom" id="ajax_data_kk"></div>
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

    jQuery(document).ready(function() {


        datatable = $('#ajax_data_kk').KTDatatable({
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
                    width: 30,
                    type: 'number',
                    selector: false,
                    textAlign: 'center',
                    template: function(row, index, datatable) {
                        return (datatable.getCurrentPage() - 1) * datatable.getPageSize() + index + 1;
                    }
                },
                {
                    field: 'Classifications.name',
                    sortable: false,
                    title: "<?= __('Klasifikasi');?>",
                    template: function(row) {
                        return `<span class="badge badge-info">
                            ${row.classification.name}
                            </span>`
                    }
                },
                {
                    field: 'name',
                    sortable: false,
                    title: "<?= __('Nama');?>",
                },
                {
                    field: 'no_kk',
                    sortable: false,
                    title: "<?= __('Nomor KK');?>",
                },
                {
                    field: 'address',
                    sortable: false,
                    title: "<?= __('Alamat');?>",
                },
                {
                    field: 'applicant',
                    sortable: false,
                    title: "<?= __('Pengaju');?>",
                },
                {
                    field: 'submission_status',
                    sortable: false,
                    title: "<?= __('Status Pengajuan');?>",
                    template: function(row) {

                        const badge = {
                            '1': 'badge badge-warning',
                            '2': 'badge badge-primary',
                            '3': 'badge badge-info',
                            '4': 'badge badge-success',
                            '5': 'badge badge-danger',
                        };

                        const classes = badge[row.submission_status.id] ?
                            badge[row.submission_status.id] :
                            'badge badge-secondary';

                        return `<span class="${classes}">
                            ${row.submission_status.name}
                            </span>`
                    }
                },
                {
                    field: 'created',
                    sortable: false,
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
                        return '\
						<a href="<?= $this->Url->build(['action' => 'detailKk']); ?>/'+ row.id +'" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Detail Pengajuan">\
							<i class="flaticon-search-1"></i>\
						</a>';
                    },
                }
            ],

        });
    });
</script>
<?php $this->end(); ?>
