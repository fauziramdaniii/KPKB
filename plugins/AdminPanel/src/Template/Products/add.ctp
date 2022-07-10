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
            <h3 class="kt-subheader__title">Title Page Menu</h3>
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
                        <h3 class="kt-portlet__head-title"><?= __('Add Product') ?></h3>
                    </div>
                </div>
                <?= $this->Form->create($product,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate', 'type' => 'file']); ?>
                <div class="kt-portlet__body">
                    <?php
                    echo $this->Flash->render();
                    $default_class = 'form-control';
                    $this->Form->setConfig('errorClass', 'is-invalid');
                                                    echo $this->Form->control('name',['class' => $default_class]);
                                echo $this->Form->control('sku',['class' => $default_class]);
                                //echo $this->Form->control('supplier_id', ['options' => $suppliers, 'class' => $default_class]);
                                echo $this->Form->control('product_unit_id', ['options' => $productUnits, 'class' => $default_class]);
                                echo $this->Form->control('description',['class' => $default_class]);
                                echo $this->Form->control('price',['class' => $default_class]);
                                //echo $this->Form->control('stokist_price',['class' => $default_class]);
                                echo $this->Form->control('weight',['class' => $default_class]);
                                //echo $this->Form->control('point',['class' => $default_class]);

                                 echo $this->Form->control('on_sales', ['options' => [0 => 'No', 1 => 'Yes'], 'class' => $default_class]);
                                // echo $this->Form->control('card_type_id', ['label' => 'Type Produk', 'options' => $productType, 'class' => $default_class]);
                                echo $this->Form->control('image', ['class' => $default_class, 'type' => 'file']);
                    ?>

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
<script>
    $('select').selectpicker();
</script>
<?php $this->end(); ?>

