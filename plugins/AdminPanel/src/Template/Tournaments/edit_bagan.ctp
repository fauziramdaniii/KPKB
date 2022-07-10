<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $productUnit
 */
?>
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Live Bagan</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('Edit Live Bagan') ?></h3>
                    </div>
                </div>
                <?= $this->Form->create($bagan,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate']); ?>
                <div class="kt-portlet__body">
                    <?php
                    echo $this->Flash->render();
                    $default_class = 'form-control';
                    $this->Form->setConfig('errorClass', 'is-invalid');
                        echo $this->Form->control('game_id',['type' => 'select', 'options' => $games, 'empty' => 'Pilih Game', 'class' => $default_class, 'label' => 'Jenis Game']);
                        echo $this->Form->control('name',['class' => $default_class, 'label' => 'Nama Bagan']);
                        echo $this->Form->control('embed',['type' => 'textarea', 'class' => $default_class, 'label' => 'Embed']);
                        echo $this->Form->control('link',['type' => 'textarea', 'class' => $default_class, 'label' => 'Link']);

                    ?>

                </div>

                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-success">Simpan</button>
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
</script>
<?php $this->end(); ?>

