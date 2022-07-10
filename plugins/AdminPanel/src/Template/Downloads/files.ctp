<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $faqCategories
 * nevix
 */
?>

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">File Downloads</h3>
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
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

        <div class="kt-grid__item kt-app__toggle kt-app__aside kt-app__aside--sm kt-app__aside--fit" id="kt_profile_aside" style="opacity: 1;">
            <!--Begin:: Portlet-->
            <div class="kt-portlet">

                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Categories</small></h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <ul class="kt-nav kt-nav--bolder kt-nav--fit-ver kt-nav--v4" role="tablist">
                        <?php foreach($categories as $category):?>
                            <li class="kt-nav__item">
                                <a class="kt-nav__link active" href="<?= $this->Url->build(['action' => 'files', $category->id]) ;?>" role="tab">
                                    <span class="kt-nav__link-icon"><i class="flaticon2-image-file"></i></span>
                                    <span class="kt-nav__link-text"><?= $category->name;?></span>
                                </a>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>

            </div>
            <!--End:: Portlet-->
        </div>


        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">List Files</small></h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <?php if($this->request->getParam('pass.0')):?>
                                <a href="#" class="btn btn-default btn-bold btn-upper btn-font-sm" class="btn btn-outline-brand" data-toggle="modal" data-target="#modalDropzone">
                                    <i class="flaticon2-add-1"></i>
                                    <?= __('New Files') ?>
                                </a>
                                <div class="modal fade" id="modalDropzone" tabindex="-1" role="dialog" aria-labelledby="modalDropzoneTitle" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Upload Files</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="input text required form-group row">
                                                    <label class="col-form-label col-lg-2">Title File</label>
                                                    <div class="col-lg-10">
                                                        <input type="text" name="title" class="form-control" id="title-files" placeholder="File title">
                                                    </div>
                                                </div>
                                                <div class="input text required form-group row">
                                                    <label class="col-form-label col-lg-2">Descriptions</label>
                                                    <div class="col-lg-10">
                                                        <input type="text" name="description" class="form-control" id="desc-files" placeholder="Description">
                                                    </div>
                                                </div>
                                                <div class="dropzone dropzone-default" id="kt_dropzone_3">
                                                    <div class="dropzone-msg dz-message needsclick">
                                                        <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
                                                        <span class="dropzone-msg-desc">Only pdf and psd files are allowed for upload</span>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt_datatable" id="table-download-files"></div>
                </div>
            </div>
        </div>


    </div>

</div>


<?php $this->append('script'); ?>
<script>

    function delete_data(id) {
        $.post( "<?= $this->Url->build(['action' => 'deleteFiles']); ?>/" + id, { _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>' } )
            .done(function( data ) {
                location.href = '<?= $this->Url->build();?>';
            });
    }

    var DatatableRemoteAjaxDemo = function() {
        var demo = function() {
            var datatable = $('#table-download-files').KTDatatable({
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            method: 'POST',
                            url: "<?= $this->Url->build(['action' => 'files', $this->request->getParam('pass.0', 1)]); ?>",
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
                        field: 'Downloads.title',
                        title: 'Name',
                        template: function(row) {
                            return row.title;
                        }
                    },
                    {
                        field: 'Downloads.name',
                        title: 'Name',
                        template: function(row) {
                            return row.name;
                        }
                    },

                    /** Action button **/
                    {
                        field: "Actions",
                        width: 110,
                        title: "Actions",
                        sortable: false,
                        overflow: 'visible',
                        template: function (row, index, datatable) {
                            return '<a href="/'+ row.dir +''+ row.name +'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Download"><i class="la la-download"></i></a><a href="javascript:delete_data('+row.id+');" onclick="return confirm(\'Are you sure delete #'+row.id+'\');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"><i class="la la-trash"></i></a>';
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

    var KTDropzoneDemo = {
        init: function() {
            $("#kt_dropzone_3").dropzone({
                url: "<?= $this->Url->build(['action' => 'upload']);?>",
                params: {
                    category_id : '<?= $this->request->getParam('pass.0');?>',
                    _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>',
                },
                paramName: "name",
                maxFiles: 1,
                maxFilesize: 100,
                addRemoveLinks: !0,
                acceptedFiles: "image/*,application/pdf,.doc,.docx,.ppt,.pptx,.xls",
                accept: function(e, o) {
                    "justinbieber.jpg" == e.name ? o("Naha, you don't.") : o()
                },
                init: function () {
                    var _this = this;
                    this.on("sending", function(file, xhr, data) {
                        data.append("title", $('#title-files').val());
                        data.append("description", $('#desc-files').val());
                    });
                }
            })
        }
    }
    jQuery(document).ready(function() {
        KTDropzoneDemo.init();
        DatatableRemoteAjaxDemo.init();
        $('#modalDropzone').on('hide.bs.modal', function(){
            location.reload();
        });
        $("#table-download-files thead").hide()
    });
</script>
<?php $this->end(); ?>



