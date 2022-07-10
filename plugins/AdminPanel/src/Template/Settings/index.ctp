<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $product
 */
?>
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Setting</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('Beranda Setting') ?></h3>
                    </div>
                </div>
                <?= $this->Form->create($setting,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'id' => 'form-setting', 'type' => 'file']); ?>
                <div class="kt-portlet__body">
                    <?php
                    echo $this->Flash->render();
                    $default_class = 'form-control';
                    $this->Form->setConfig('errorClass', 'is-invalid');
                                echo $this->Form->control('title_slide',['class' => $default_class, 'label' => 'Judul Slide']);
                                echo $this->Form->control('description_slide',['class' => $default_class, 'label' => 'Deskripsi Slide']);
                                echo $this->Form->control('title_section1',['class' => $default_class, 'label' => 'Judul Section 1']);
                                echo $this->Form->control('shadow_title_section1',['class' => $default_class, 'label' => 'Judul Bayangan Section 1']);
                                echo $this->Form->control('description_section1',['type' => 'textarea', 'class' => $default_class, 'label' => 'Deskripsi Section 1']);
                                echo $this->Form->control('icon_process1_section1',['class' => $default_class, 'label' => 'Ikon Proses 1']);
                                echo $this->Form->control('title_process1_section1',['class' => $default_class, 'label' => 'Judul Proses 1']);
                                echo $this->Form->control('description_process1_section1',['type' => 'textarea', 'class' => $default_class, 'label' => 'Deskripsi Proses 1']);
                                echo $this->Form->control('icon_process2_section1',['class' => $default_class, 'label' => 'Ikon Proses 2']);
                                echo $this->Form->control('title_process2_section1',['class' => $default_class, 'label' => 'Judul Proses 2']);
                                echo $this->Form->control('description_process2_section1',['type' => 'textarea', 'class' => $default_class, 'label' => 'Deskripsi Proses 2']);
                                echo $this->Form->control('icon_process3_section1',['class' => $default_class, 'label' => 'Ikon Proses 3']);
                                echo $this->Form->control('title_process3_section1',['class' => $default_class, 'label' => 'Judul Proses 3']);
                                echo $this->Form->control('description_process3_section1',['type' => 'textarea', 'class' => $default_class, 'label' => 'Deskripsi Proses 3']);
                                echo $this->Form->control('title_promo_video',['class' => $default_class, 'label' => 'Judul Promo Video']);
                                echo $this->Form->control('description_promo_video',['type' => 'textarea', 'class' => $default_class, 'label' => 'Deskripsi Promo Video']);
                                echo $this->Form->control('link_promo_video',['class' => $default_class, 'label' => 'Link Promo Video']);
                    ?>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Image Promo Video</label>
                        <div class="col-lg-3">
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-success" id="setting-submit">Submit</button>
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

    $("#setting-submit").click(function(){
        $(':required:invalid', '#form-setting').each(function () {
            var id = $('.tab-pane').find(':required:invalid').closest('.tab-pane').attr('id');
            $('.nav a[href="#' + id + '"]').tab('show');
        });
    });
</script>
<?php $this->end(); ?>

