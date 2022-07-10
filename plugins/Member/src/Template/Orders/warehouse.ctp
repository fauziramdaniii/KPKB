<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \Member\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $customer
 */
?>


<div class="subheader py-6 py-lg-8 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Order Product');?></h5>
                <!--end::Page Title-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center flex-wrap">
        </div>
    </div>
</div>

<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">

        <div class="card card-custom">
            <div class="card-body py-20">
                <?= $this->Flash->render(); ?>
                <div class="row">

                    <?php foreach($suppliers as $supplier) : ?>
                    <div class="col-xl-6 border-right-0 border-right-xl border-bottom border-bottom-xl-0">
                        <div class="py-20 px-10 px-lg-20">
                            <!--begin::Content-->
                            <div class="d-flex flex-column flex-center text-center pt-10">
                                <h4 class="font-size-h6 d-block d-block font-weight-bold text-dark-50 pb-5"><?= __('Warehouse {0}',[$supplier->name]);?></h4>
                                <ul class="list-unstyled text-muted mb-10">
                                    <?php foreach($supplier->product_stocks as $product):?>
                                        <li><?= $product->product->name; ?> : <?= $product->quantity; ?> </li>
                                    <?php endforeach;?>
                                </ul>
                                <?= $this->Form->postLink(
                                    '<button type="button" class="btn btn-primary text-uppercase font-weight-bolder px-16 py-4">'.__('Select Warehouse').'</button>',
                                    ['action' => 'selectWarehouse', $supplier->id],
                                    ['escape' => false])
                                ?>
                            </div>
                            <!--end::Content-->
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>

    </div>
</div>


