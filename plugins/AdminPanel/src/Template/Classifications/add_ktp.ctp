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
            <h3 class="kt-subheader__title">Klasifikasi KTP</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('Tambah Klasifikasi') ?></h3>
                    </div>
                </div>
                <?= $this->Form->create($classification,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate', 'type' => 'file']); ?>
                <div class="kt-portlet__body">
                    <?php
                    echo $this->Flash->render();
                    $default_class = 'form-control';
                    $this->Form->setConfig('errorClass', 'is-invalid');
                        echo $this->Form->control('name',['class' => $default_class]);
                        echo $this->Form->control('slug',['class' => $default_class.' slug', 'readonly']);
                    ?>

                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Persyaratan</label>
                        <div class="col-lg-7">
                            <div class="kt-repeater">
                                <div data-repeater-list="persyaratan">
                                    <div data-repeater-item class="kt-repeater__item">
                                        <div class="input-group row">
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Persyaratan" required="required" name="name" id="name">
                                                    <div class="input-group-append">
                                                        <button data-repeater-delete="" class="btn btn-danger btn-icon">
                                                            <i class="la la-close kt-font-light"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--space-sm"></div>
                                    </div>
                                </div>
                                <div class="kt-repeater__add-data">
									<span data-repeater-create="" class="btn btn-info btn-sm">
										<i class="la la-plus"></i> Tambah
									</span>
                                </div>
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
                                <button type="submit" class="btn btn-success">Submit</button>
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
<?php
    $this->Html->script(['/admin-assets/js/pages/components/forms/layouts/repeater.js'],['block' => true]);
?>
<?php
    $this->Html->script([
        '/admin-assets/plugins/custom/slugify/speakingurl.min',
        '/admin-assets/plugins/custom/slugify/slugify.min',
        '/admin-assets/plugins/bootstrap-duallistbox/jquery.bootstrap-duallistbox',
    ],['block' => true]);
?>
<script>
    $('select').selectpicker();
    $('#slug').slugify('#name');
</script>
<?php $this->end(); ?>

