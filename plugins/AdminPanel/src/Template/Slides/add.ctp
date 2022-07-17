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
            <h3 class="kt-subheader__title">Slide</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('Tambah Slide') ?></h3>
                    </div>
                </div>
                <?= $this->Form->create($slide,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form','id' => 'form-slide', 'type' => 'file']); ?>
                <div class="kt-portlet__body">
                    <?php
                    echo $this->Flash->render();
                    $default_class = 'form-control';
                    $this->Form->setConfig('errorClass', 'is-invalid');
                    echo $this->Form->control('title',['class' => $default_class, 'label' => 'Title']);
                    echo $this->Form->control('subtitle',['class' => $default_class, 'label' => 'Subtitle', 'type' => 'textarea']);
                    ?>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Image</label>
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
                                <button type="submit" class="btn btn-success" id="slide-submit">Submit</button>
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

    $("#slide-submit").click(function(){
        $(':required:invalid', '#form-slide').each(function () {
            var id = $('.tab-pane').find(':required:invalid').closest('.tab-pane').attr('id');
            $('.nav a[href="#' + id + '"]').tab('show');
        });
    });
</script>
<?php $this->end(); ?>

