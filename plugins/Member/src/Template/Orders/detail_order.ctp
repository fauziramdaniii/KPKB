<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \Member\View\AppView $this
 * @var \AdminPanel\Model\Entity\Order $orders
 * @var \AdminPanel\Model\Entity\CustomerBank $bank_transfer
 */
?>


<div class="subheader py-6 py-lg-8 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Detail Order');?></h5>
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

        <div class="card card-custom mb-5">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="card-label"><?= __( 'Please transfer to one of this bank accounts'); ?></span>
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php $bankConfigs = \Cake\Core\Configure::read('BankCompany');?>
                    <?php foreach($bankConfigs as $bankConfig) : ?>
                        <div class="col-xl-4 border-right-0 border-right-xl border-bottom border-bottom-xl-0">
                            <div class="py-20 px-10 px-lg-20">
                                <div class="d-flex flex-center position-relative py-20">
                                    <?= $this->Html->image('/img/'.$bankConfig['img'],['class' => 'img-responsive', 'width' => '200px']);?>
                                </div>
                                <!--begin::Content-->
                                <div class="d-flex flex-column flex-center text-center pt-10">
                                    <h4 class="font-size-h6 d-block d-block font-weight-bold text-dark-50 pb-5">
                                        <?= $bankConfig['acc_name']; ?> - <?= $bankConfig['acc_number']; ?>
                                    </h4>
                                </div>
                                <!--end::Content-->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="card card-custom overflow-hidden">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="card-label"><?= __( 'Detail Order'); ?></span>
                </h3>

                <div class="card-toolbar">
                    <a href="<?= $this->Url->build(['action' => 'lists']); ?>" class="btn btn-light-primary font-weight-bold">
                        <i class="flaticon flaticon2-back icon-md mr-2"></i> <?= __('Back Orders');?>
                    </a>
                </div>
            </div>

            <div class="card-body p-0">

                <?= $this->Flash->render() ?>
                <!-- begin: Invoice-->
                <!-- begin: Invoice header-->
                <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                            <h1 class="display-4 font-weight-boldest mb-10"><?= __('INVOICE');?></h1>
                        </div>
                        <div class="border-bottom w-100"></div>
                        <div class="d-flex justify-content-between pt-6">
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2"><?= __('Invoice To');?>.</span>
                                <span class="opacity-70">
                                    <?= $orders->customer->first_name;?> <?= $orders->customer->last_name;?><br>
                                    <?= $orders->address; ?>, <?= $orders->province->name; ?>, <?= $orders->city->name; ?>, <?= $orders->subdistrict->name; ?>, <?= $orders->zip ?>
                                </span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2"><?= __('INVOICE');?>.</span>
                                <span class="opacity-70"><?= $orders->invoice; ?></span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2"><?= __('Status');?></span>
                                <span class="opacity-70"><?= $orders->order_status->name; ?></span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2"><?= __('Invoice Date');?></span>
                                <span class="opacity-70"><?= $orders->created; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice header-->
                <!-- begin: Invoice body-->
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                    <div class="col-md-9">
                        <div class="table-responsive">

                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-right font-weight-bold text-muted text-uppercase">#</th>
                                    <th class="text-right font-weight-bold text-muted text-uppercase"><?= __('Product Name');?></th>
                                    <th class="text-right font-weight-bold text-muted text-uppercase"><?= __('Qty');?></th>
                                    <th class="text-right font-weight-bold text-muted text-uppercase" ><?= __('Price');?></th>
                                    <th  class="text-right font-weight-bold text-muted text-uppercase" ><?= __('Sub Total');?></th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; $subtotal = 0; foreach($orders->order_details as $key => $order) : ?>
                                    <tr>
                                        <th class="border-top-0 pr-0 py-4 text-right"><?= $i++ ; ?></th>
                                        <td class="border-top-0 pr-0 py-4 text-right"><?= $order['product']['name']; ?></td>
                                        <td class="border-top-0 pr-0 py-4 text-right">
                                            <?= $order['qty']; ?>
                                        </td>
                                        <td class="border-top-0 pr-0 py-4 text-right">Rp. <?= $this->Number->format($order['price']); ?></td>
                                        <td class="text-danger border-top-0 pr-0 py-4 text-right">Rp. <?= $this->Number->format($order['total']); ?></td>

                                    </tr>
                                    <?php $subtotal += $order['total']; endforeach; ?>
                                <tr>
                                    <td colspan="4" style="text-align: right;"><?= __('Sub Total');?></td>
                                    <td class="total pr-0 py-4 text-right">
                                        Rp. <?= $this->Number->format($subtotal); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class=" text-right"><?= __('Shipping Cost');?></td>
                                    <td class="total pr-0 py-4 text-right">
                                        <span style="<?= $orders->is_freeshipping ? 'text-decoration: line-through;' : ''; ?>">
                                            Rp. <?= $this->Number->format($orders->shipping_cost); ?>
                                        </span>
                                                <?php if ( $orders->is_freeshipping ) : ?>
                                                    (Free)
                                                <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: right;"><?= __('Grand Total');?></td>
                                    <td class="text-primary pr-0 py-4 text-right">
                                        Rp. <?= $this->Number->format($orders->total); ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">Download Invoice</button>
                            <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Invoice</button>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice action-->
                <!-- end: Invoice-->
            </div>
        </div>
    </div>

</div>




<?php $this->Html->script('/member-assets/plugins/numeral/numeral.min.js', ['block' => true]); ?>
<?php $this->append('script'); ?>
<script>
    jQuery(document).ready(function() {

    });
</script>
<?php $this->end(); ?>

