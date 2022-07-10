<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \Member\View\AppView $this
 * @var \AdminPanel\Model\Entity\CustomerStatement $statement
 */
?>


<div class="subheader py-6 py-lg-8 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Detail Statement');?></h5>
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



        <div class="card card-custom overflow-hidden">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="card-label"><?= __( 'Detail Statement'); ?></span>
                </h3>

                <div class="card-toolbar">
                    <a href="<?= $this->Url->build(['action' => 'index']); ?>" class="btn btn-light-primary font-weight-bold">
                        <i class="flaticon flaticon2-back icon-md mr-2"></i> <?= __('Back Statements');?>
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
                                <span class="font-weight-bolder mb-2"><?= __('Transferred To');?>.</span>
                                <span class="opacity-70">

                                </span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2"><?= __('Statement Date');?>.</span>
                                <span class="opacity-70"><?= $statement->statement_date; ?></span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2"><?= __('Status');?></span>
                                <span class="opacity-70">

                                    <?php if ($statement->status == 0) : ?>
                                        <span class="badge badge-secondary">
                                            <?= __('Pending'); ?>
                                        </span>
                                    <?php elseif ($statement->status == 1) : ?>
                                        <span class="badge badge-success">
                                            <?= __('Transferred'); ?>
                                        </span>
                                    <?php endif; ?>
                                </span>
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
                                    <th class="font-weight-bold text-muted text-uppercase">#</th>
                                    <th class="font-weight-bold text-muted text-uppercase"><?= __('Bonus Name');?></th>
                                    <th class="text-right font-weight-bold text-muted text-uppercase" ><?= __('Amount');?></th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                <tr>
                                    <th class="border-top-0 pr-0 py-4"><?= $i++ ; ?></th>
                                    <td class="border-top-0 pr-0 py-4">Bonus Cash Point</td>
                                    <td class="border-top-0 pr-0 py-4 text-right">Rp. <?= $this->Number->format($statement->amount); ?></td>
                                </tr>

                                <?php  $subtotal = 0; foreach($statement->customer_statement_details as $key => $detail) : ?>
                                    <tr>
                                        <th class="pr-0 py-4"><?= $i++ ; ?></th>
                                        <td class="pr-0 py-4">Bonus Royalti 10th <?= $detail->sequence; ?> (<?= $this->Number->format($detail->cash_point_claim->total); ?> * <?= \Cake\Core\Configure::read('StatementIndex',0.0075); ?>)</td>
                                        <td class="pr-0 py-4 text-right">Rp. <?= $this->Number->format($detail->amount); ?></td>
                                    </tr>
                                <?php  endforeach; ?>

                                <tr>
                                    <td colspan="2" style="text-align: right;"><?= __('Fee');?></td>
                                    <td class="text-danger pr-0 py-4 text-right">
                                        <?php if ($statement->fee > 0) : ?>
                                        Rp. -<?= $this->Number->format($statement->fee); ?>
                                        <?php else : ?>
                                        0
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: right;"><?= __('Grand Total');?></td>
                                    <td class="text-primary pr-0 py-4 text-right">
                                        Rp. <?= $this->Number->format($statement->total); ?>
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

