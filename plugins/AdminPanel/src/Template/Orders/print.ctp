<?php
/**
 * @var \App\View\AppView $this
 */

?>
<?php
$this->Html->css(['/admin-assets/css/pages/invoice/invoice-v2.css'],['block' => true]);
$this->Html->script(['/admin-assets/js/pages/jquery.qrcode.js','/admin-assets/js/pages/qrcode.js'],['block' => true]);
?>
<style>
    @page { size: auto;  margin: 0mm; }
</style>

<?php $this->append('script'); ?>
<script>
    $(document).ready(function(){
        jQuery('#qrcodeTable').qrcode({
            text	: "<?= \Cake\Core\Configure::read('EmailConfig.siteInfo');?>/activated/<?= $data->invoice;?>/<?= $data->secret_key;?>"
        });
    })
</script>
<?php $this->end(); ?>
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Invoice</h3>
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
    <div class="kt-portlet">
        <div class="kt-invoice-2">
            <div class="kt-invoice__head pb-0">
                <div class="kt-invoice__container">
                    <div class="kt-invoice__brand">
                        <h1 class="kt-invoice__title"><?= __('INVOICE');?></h1>

                        <div href="#" class="kt-invoice__logo">
                            <a href="#"><?= $this->Html->image('/assets/logo/logo.png', ['style' => 'width : unset !important;']);?></a>
                            <span class="kt-invoice__desc">
                                <span><?= \Cake\Core\Configure::read('EmailConfig.address');?></span>
                                <span>
                                    No Kantor Operasional : <?= \Cake\Core\Configure::read('EmailConfig.phone');?>,
                                    <?= __('Email');?> : <?= \Cake\Core\Configure::read('EmailConfig.emailInfo');?>
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="kt-invoice__items mt-0">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle"><?= __('Bill to');?>:</span>
                            <span class="kt-invoice__text">
                                <?= $data->customer->first_name;?> <?= $data->customer->last_name;?><br> <?= $data->address;?>,<br>
                                <?= $data->city->type;?> <?= $data->city->name;?>, <?= $data->subdistrict->name;?>, <?= $data->province->name;?>, <?= $data->city->postal_code;?><br>
                                <?= $data->recipient_phone;?>
                            </span>
                        </div>

                        <div class="kt-invoice__item">
                            <span class="kt-invoice__text"><?= __('Date');?> : <?= date('Y-m-d', strtotime($data->modified));?></span>
                            <span class="kt-invoice__text"><?= __('Invoice Number');?> : <strong><?= $data->invoice;?></strong></span>
                            <span class="kt-invoice__text"><?= __('Order Notes');?> : <?= $data->notes;?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kt-invoice__body">
                <div class="kt-invoice__container">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td><?= __('Product Name');?></td>
                                    <td><?= __('Amount');?></td>
                                    <td><?= __('Price');?></td>
                                    <td><?= __('Total');?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data->order_details as $vals): ?>
                                    <tr>
                                        <td><?= $vals->product->name;?></td>
                                        <td><?= $vals->qty;?></td>
                                        <td><?= $this->Number->format($vals->price, ['locale' => 'en-US']); ?></td>
                                        <td><?= $this->Number->format($vals->total, ['locale' => 'en-US']); ?></td>
                                    </tr>
                                <?php endforeach;?>
                                <tr>
                                    <td><?= __('Total Weight');?></td>
                                    <td><?= $this->Number->format($data->total_weight, ['locale' => 'en-US']); ?> Gram</td>
                                    <td class="text-right"><?= __('Sub Total Product');?></td>
                                    <td>Rp. <?= $this->Number->format($data->gross_total, ['locale' => 'en-US']); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="kt-invoice__footer">
                <div class="kt-invoice__container">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?= __('Grand Total');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="kt-font-danger kt-font-xl kt-font-boldest"> <?= $this->Number->format($data->total, ['locale' => 'en-US']); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="kt-invoice__body">
                <div class="kt-invoice__container text-center">
                    <div id="qrcodeTable"></div>
                </div>
            </div>

            <div class="kt-invoice__actions">
                <div class="kt-invoice__container">
                    <button type="button" class="btn btn-brand btn-bold" onclick="window.print();"><?= __('Print Invoice');?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: Content -->
