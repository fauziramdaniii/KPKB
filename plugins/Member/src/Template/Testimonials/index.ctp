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
                <h3 class="kt-subheader__title"><?= __('Testimonials');?></h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" class="kt-subheader__breadcrumbs-link">
                        <?= __('Testimonials');?> </a>

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
                        <?= __( 'Testimonials'); ?>

                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <?php if ($testimonialTotal == 0) : ?>
                        <a href="<?= $this->Url->build(['action' => 'add']); ?>" class="btn btn-secondary"><i class="flaticon flaticon-add"></i> <?= __('Create Testimonial');?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">

                <!--begin: Datatable -->
                <div class="kt-margin-t-15 kt-padding-l-15 kt-padding-r-15">
                    <?= $this->Flash->render() ?>
                </div>
                <div class="kt_datatable_testimonial" id="ajax_data_testimonial"></div>

                <!--end: Datatable -->
            </div>
        </div>

    </div>

    <!-- end:: Content -->
</div>

<?php $this->Html->script([
        '/member-assets/plugins/numeral/numeral.min.js',
        '/member-assets/plugins/bootbox/bootbox.all.min.js',
], ['block' => true]); ?>
<?php $this->append('script'); ?>
<script>

    let datatable;
    const deleteBank = function(id) {
        bootbox.prompt({
            //size: "small",
            title: "<?= __('Confirm serial number');?>",
            inputType: "password",
            required: true,
            placeholder: "<?= __('Please input your serial number');?>",
            closeButton: false,
            callback: function(serial) {
                if (serial) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= $this->Url->build(['action' => 'delete']); ?>/' + id,
                        data: {
                            id: id,
                            _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>',
                            serial: serial
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


         datatable = $('.kt_datatable_testimonial').KTDatatable({
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
                    field: 'approved',
                    sortable: false,
                    title: "<?= __('Approved');?>",
                    template: function(row) {
                        const badge = {
                            '0': 'badge badge-secondary',
                            '1': 'badge badge-success',
                        };

                        const classes = row.approved ? badge[1] : badge[0];

                        return `<span class="${classes}">
                            ${row.approved ? 'Approved' : 'Waiting Approve'}
                            </span>`
                    }
                },
                {
                    field: 'message',
                    title: "<?= __('Message');?>",
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

                        const edit = !row.approved ? '<a href="<?= $this->Url->build(['action' => 'edit']); ?>/'+ row.id +'" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit Testimonial">\
                    <i class="flaticon-edit-1"></i>\
                    </a>' : '';

                        return edit + '<a href="javascript:deleteBank('+ row.id + ')" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete Testimonial">\
                            <i class="flaticon-delete"></i>\
                        </a>\
					';
                    },
                }
            ],

        });
    });
</script>
<?php $this->end(); ?>
