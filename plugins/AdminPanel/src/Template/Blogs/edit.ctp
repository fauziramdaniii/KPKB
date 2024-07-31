<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $blog
 */
?>
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Edit Blog</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('Edit Blog') ?></h3>
                    </div>
                </div>
                <?= $this->Form->create($blog,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form','id' => 'form-blog', 'type' => 'file']); ?>
                <div class="kt-portlet__body">
                    <?php
                    echo $this->Flash->render();
                    $default_class = 'form-control';
                    $this->Form->setConfig('errorClass', 'is-invalid');
                    echo $this->Form->control('topic_id', ['options' => $topics, 'class' => $default_class. ' select', 'label' => 'Topic [Eng]']);

                    ?>

                    <div class="input text required form-group row">
                        <label class="col-form-label col-lg-2">Content</label>
                        <div class="col-lg-7">
                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger" role="tablist">
                                <?php $i = 0; foreach($languages as $key => $val) :?>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link <?= ($i == 0) ? 'active' : ''; ?>" data-toggle="tab" href="#kt_tabs_<?= $key; ?>" role="tab"><?= $val['name']; ?></a>
                                </li>
                                <?php $i++; endforeach; ?>
                            </ul>

                            <div class="tab-content">
                                <?php $i = 0; foreach($languages as $key => $val) :?>
                                    <div class="tab-pane <?= ($i == 0) ? 'active' : ''; ?>" id="kt_tabs_<?= $key; ?>" role="tabpanel">
                                        <?php
                                        echo $this->Form->control(($i ==0 ) ? 'title' : "_translations.{$key}.title",[
                                            'class' => $default_class,
                                            'placeholder' => 'Blog title',
                                            'label' => false,
                                            'templates' => [
                                                'formGroup' => '{{label}}<div class="col-lg-12">{{input}}{{error}}</div>'
                                            ]
                                        ]);
                                        echo $this->Form->control(($i ==0 ) ? 'content' : "_translations.{$key}.content",[
                                                'class' => $default_class . ' summernote',
                                                'id' => 'content-'.$key,
                                                'data-id' => $key,
                                                'label' => false ,
                                                'required' => false,
                                                'templates' => [
                                                    'formGroup' => '{{label}}<div class="col-lg-12">{{input}}{{error}}</div>'
                                                ]
                                            ]
                                        );
                                        ?>
                                    </div>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <?php echo  $this->Form->control('slug',['class' => $default_class.' slug', 'readonly']);?>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Tags [Eng]</label>
                        <div class="col-lg-8">
                            <?php
                                echo $this->Form->select(
                                    'tags._ids',
                                    $listTags,
                                    [
                                        'multiple' => true,
                                        'class' => 'form-select',
                                    ]
                                );
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Image</label>
                        <input type="text" name="image" class="" hidden id="image">
                        <div class="dropzone dropzone-default" id="kt_dropzone_3">
                            <div class="dropzone-msg dz-message needsclick">
                                <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
                                <span class="dropzone-msg-desc">Only image allowed for upload</span>
                            </div>
                        </div>
                    </div>


                    <div class="input text required form-group row">
                        <label class="col-form-label col-lg-2">Status</label>
                        <div class="col-lg-7">
                            <span class="kt-switch kt-switch--icon">
                                <?php echo $this->Form->control('status',[
                                    'label' => false,
                                    'type' => 'checkbox',
                                    'templates' => [
                                        'inputContainer' => '<label>{{content}}<span></span></label>'
                                    ]]);?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-success" id="blog-submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->Html->css([
'/admin-assets/plugins/bootstrap-duallistbox/bootstrap-duallistbox',
],['block' => true]);
?>
<?php
$this->Html->script([
'/admin-assets/plugins/custom/slugify/speakingurl.min',
'/admin-assets/plugins/custom/slugify/slugify.min',
'/admin-assets/plugins/bootstrap-duallistbox/jquery.bootstrap-duallistbox',
],['block' => true]);
?>
<?php $this->append('script'); ?>
<script>
    var uploadedImageNames = [];
    $('.form-select').bootstrapDualListbox();
    $('#slug').slugify('#title');
    $('.select').selectpicker();
    $('.summernote').summernote({
        height: 150 ,
        callbacks: {}
    });

    $("#blog-submit").click(function(){
        $(':required:invalid', '#form-blog').each(function () {
            var id = $('.tab-pane').find(':required:invalid').closest('.tab-pane').attr('id');
            $('.nav a[href="#' + id + '"]').tab('show');
        });
    });

    var KTDropzoneDemo = {
        init: function() {
            $("#kt_dropzone_3").dropzone({
                url: "<?= $this->Url->build(['action' => 'upload']);?>",
                params: {
                    _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                },
                paramName: "name",
                maxFiles: 10,
                maxFilesize: 10,
                addRemoveLinks: !0,
                acceptedFiles: "image/*",
                accept: function(e, o) {
                    "justinbieber.jpg" == e.name ? o("Naha, you don't.") : o()
                },
                init: function() {
                    this.on("success", function(file, response) {
                        uploadedImageNames.push(response.data.name);
                        $('#image').val(uploadedImageNames.join(','));
                    });

                    this.on("error", function(file, response) {
                    });

                    this.on("complete", function(file) {
                    });

                    this.on("removedfile", function(file) {
                        var filename = file.name;
                        var index = uploadedImageNames.indexOf(filename);
                        if (index > -1) {
                            uploadedImageNames.splice(index, 1);
                            $('#image').val(uploadedImageNames.join(','));
                        }
                    });
                }
            })
        }
    }
    jQuery(document).ready(function() {
        KTDropzoneDemo.init();
    });
</script>
<?php $this->end(); ?>

