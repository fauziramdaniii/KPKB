<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \Member\View\AppView $this
 * @var \AdminPanel\Model\Entity\Network $network
 * @var \AdminPanel\Model\Entity\Network[] $childs
 */
?>


<div class="subheader py-6 py-lg-8 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Network'); ?></h5>
                <!--end::Page Title-->

                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="<?= $this->Url->build(['action' => 'index']); ?>" class="text-muted"><?= __('Network Diagram'); ?></a>
                    </li>
                </ul>
                <!--end::Breadcrumb-->
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

        <div class="card card-custom gutter-b card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label"><?= __('Networks');?></h3>
                </div>

            </div>

            <div class="card-body" >


                <!--begin: Search Form -->
                <?= $this->Form->create(null); ?>

                <div class="kt-form kt-fork--label-right kt-margin-t-20 kt-margin-b-10">


                    <div class="mb-7">
                        <div class="row align-items-center">
                            <div class="col-lg-9 col-xl-8">
                                <div class="row align-items-center">
                                    <div class="col-md-6 my-2 my-md-0">
                                        <div class="input-icon">
                                            <input type="text" class="form-control" placeholder="Search..." name="search" id="generalSearch" />
                                            <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php /*
                        <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                            <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                        </div>
                        */ ?>
                        </div>
                    </div>


                    <?= $this->Form->end(); ?>
                </div>
                <!--end: Search Form -->


                <div class="kt-margin-t-15 kt-padding-l-15 kt-padding-r-15">
                    <?= $this->Flash->render() ?>
                </div>

                <!--begin: wrap -->

                <?= $this->Flash->render() ?>

                <?php if ($this->getRequest()->getParam('pass.0') && $network->id != $mynetwork->id): ?>
                    <div style="margin-bottom: 40px;">
                        <a class="btn btn-secondary btn-elevate btn-pill" href="<?= $this->Url->build(['action' => 'index', $network->parent_network->customer_id]); ?>">
                            <i class="flaticon2-back"></i> <?= __('Upline');?>: <?= $network->parent_network->customer->username; ?>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="kt-scroll" data-scroll="true" data-scroll-x="true" style="overflow: auto;">
                    <div id="wrapper-network">
                        <div class="label-network <?= $network->customer->is_vip ? 'ribbon ribbon-top-left' : ''; ?>">
                            <?php if ($network->customer->is_vip) : ?>
                                <span class="vip"><i class="flaticon-star"></i> VIP</span>
                            <?php endif; ?>
                            <div class="kt-user-card-v2  text-left">
                                <div class="kt-user-card-v2__pic">
                                    <?= $this->Helper->avatar(true, 'avatar-rounded', $network->customer->avatar); ?>
                                </div>
                                <div class="kt-user-card-v2__details">
                                    <a class="kt-user-card-v2__name text-primary" href="#"><?= $network->customer->username; ?></a>
                                    <span class="kt-user-card-v2__email" title="<?= h(@$network->customer->full_name); ?>"><?= @$network->customer->full_name; ?>
                                        <?php if ($childs) : ?>
                                            <br> <?= __('Downline');?> : <?= $network->childCount;?>
                                        <?php endif; ?>
                                </span>
                                </div>
                            </div>
                        </div>

                        <?php if ($childs) : ?>
                            <div class="branch lv1">
                                <?= $this->Helper->generateChild($childs); ?>
                            </div>

                        <?php endif; ?>


                    </div>
                    <!--end: wrap -->
                </div>


            </div>

    </div>
</div>



<?php $this->Html->css('/member-assets/css/network.css', ['block' => true]); ?>
