<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $faqCategory
 */
?>
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Add Category Downloads</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('Add Category Downloads') ?></h3>
                    </div>
                </div>
                <?= $this->Form->create($categories,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'id' => 'form-category']); ?>
                <div class="kt-portlet__body">
                    <?php
                    echo $this->Flash->render();
                    $default_class = 'form-control';
                    $this->Form->setConfig('errorClass', 'is-invalid');
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
                                    (($i == 0) ? 'name' : "_translations.{$key}.name") => ['class' => $default_class],
                                ], ['fieldset' => false])
                                ?>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>

                    </div>

                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-2">
                                </div>
                                <div class="col-10">
                                    <button type="submit" class="btn btn-success" id="category-submit">Submit</button>
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
        $(document).ready(function() {
            $("#category-submit").click(function(){
                $(':required:invalid', '#form-category').each(function () {
                    var id = $('.tab-pane').find(':required:invalid').closest('.tab-pane').attr('id');
                    $('.nav a[href="#' + id + '"]').tab('show');
                });
            });
        });
    </script>
    <?php $this->end(); ?>

