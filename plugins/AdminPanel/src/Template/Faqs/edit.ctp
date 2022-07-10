<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $faq
 */
?>
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Edit Faq</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('Edit Faq') ?></h3>
                    </div>
                </div>
                <?= $this->Form->create($faq,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'id' => 'form-faq']); ?>
                <div class="kt-portlet__body">
                    <?php
                    echo $this->Flash->render();
                    $default_class = 'form-control';
                    $this->Form->setConfig('errorClass', 'is-invalid');
                    echo $this->Form->control('faq_category_id', ['options' => $faqCategories, 'class' => $default_class]);
                    //echo $this->Form->control('question',['class' => $default_class]);
                    //echo $this->Form->control('answer',['class' => $default_class]);
                    ?>

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
                        echo $this->Form->controls([
                            (($i == 0) ? 'question' : "_translations.{$key}.question") => ['class' => $default_class],
                            (($i ==0 ) ? 'answer' : "_translations.{$key}.answer") => ['class' => $default_class . ' summernote', 'id' => 'content-'.$key, 'data-id' => $key, 'required' => false]
                            ], ['fieldset' => false])
                            ?>
                        </div>
                        <?php $i++; ?>
                        <?php endforeach; ?>

                    </div>

                </div>

                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-success" id="faq-submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>


<?php $this->append('script'); ?>
<script>
    $('select').selectpicker();
    $('.summernote').summernote({
        height: 150,
        callbacks: {
            onImageUpload: function (image) {
                var id = $(this).data('id');
                uploadImage(image[0], id);
            }
        }
    });

    function uploadImage(image,id) {
        var data = new FormData();
        data.append("name", image);
        data.append("_csrfToken", "<?= $this->request->params['_csrfToken']; ?>");
        $.ajax({
            url: "<?= $this->Url->build(['controller' => 'Blogs','action' => 'upload']); ?>",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "post",
            success: function(url) {
                var image = $('<img>').attr('src', url.data.url +'/'+ url.data.name);
                $('#content-'+id).summernote("insertNode", image[0]);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
    $("#faq-submit").click(function(){
        $(':required:invalid', '#form-faq').each(function () {
            var id = $('.tab-pane').find(':required:invalid').closest('.tab-pane').attr('id');
            $('.nav a[href="#' + id + '"]').tab('show');
        });
    });
</script>
<?php $this->end(); ?>

