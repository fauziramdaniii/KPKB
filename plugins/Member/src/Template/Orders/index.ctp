<<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \Member\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $customer
 * @var \AdminPanel\Model\Entity\Product[] $products
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
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label"> <?= __( 'Order'); ?></h3>
                </div>

                <div class="card-toolbar">
                    <?php if ($cart = $this->getRequest()->getSession()->read('Carts')) : ?>
                        <a href="<?= $this->Url->build(['action' => 'cart']); ?>" class="btn btn-secondary">
                            <i class="flaticon flaticon2-shopping-cart-1"></i> <?= __('Checkout');?>
                            <span class="kt-menu__link-badge"><span class="kt-badge kt-badge--brand"><?= count($cart); ?></span></span>

                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card-body py-20">
                <?= $this->Flash->render(); ?>

                <div class="row">

                    <?php foreach($products as $k => $product) : ?>
                        <div class="col-xl-3 border-right-0 border-right-xl border-bottom border-bottom-xl-0">
                            <div class="py-20 px-10 px-lg-20">
                                <!--begin::Content-->

                                <?php
                                if ($product->image) {
                                    echo $this->Html->image('/files/Products/image/' . $product->image, ['class' => 'img-fluid']);
                                }
                                ?>
                                <div class="d-flex flex-column flex-center text-center pt-10">
                                    <div class="d-flex justify-content-center pb-10">
                                        <span class="text-muted font-size-h3 align-self-start mr-2">IDR</span>
                                        <span class="font-weight-bolder display-4 text-dark-75 align-self-center"><?= $this->Number->format($product->price); ?></span>
                                    </div>
                                    <h4 class="font-size-h6 d-block d-block font-weight-bold text-dark-50 pb-5">
                                        <?= $product->name; ?>
                                    </h4>
                                    <?= $this->Form->postLink(
                                        '<button type="button" class="btn btn-primary text-uppercase font-weight-bolder px-16 py-4">'.__('PURCHASE').'</button>',
                                        ['action' => 'add', $product->id],
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


