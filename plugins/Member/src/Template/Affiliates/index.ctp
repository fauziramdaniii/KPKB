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
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Affiliate');?></h5>
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
                    <h3 class="card-label"><?= __('Affiliate');?></h3>
                </div>

            </div>

            <div class="card-body">

                <?= $this->Flash->render() ?>

                <p><?= __('Refer to your friends, relatives or coworkers. You will get extra bonus by your refered members.');?></p>

                <div class="input-group col-md-6 mb-5">
                    <input type="text" class="form-control" id="reff" value="https://<?= $_SERVER['HTTP_HOST']; ?>/reff/<?= $this->request->getSession()->read('Auth.Customers.username');?>" readonly="">
                    <div class="input-group-prepend"><span class="input-group-text">
                        <a href="#" data-clipboard="true" data-clipboard-target="#reff"  data-clipboard-success="<?= __( 'Copied!'); ?>"  title="<?= __( 'Copy to clipboard'); ?>">
                            <i class="la la-copy"></i>
                        </a>
                    </div>
                </div>

                <p class="mt-1"><?= __('If you have a blog or website, you can use banners below to promote and potentially earn lifetime passive income by introducing to your website\'s visitors.');?></p>

                <div class="table-responsive">
                    <table id="affiliate-table" class="table display responsive nowrap">
                        <thead class="thead-colored thead-light">
                        <tr>
                            <th class="text-center" width="33%">160x600</th>
                            <th class="text-center" width="33%">336x280</th>
                            <th class="text-center" width="33%">728x90</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center align-middle"><?= $this->Html->image('/img/banner/160x600.gif',['class' => 'img-fluid']);?></td>
                            <td class="text-center align-middle"><?= $this->Html->image('/img/banner/336x280.gif',['class' => 'img-fluid']);?></td>
                            <td class="text-center align-middle"><?= $this->Html->image('/img/banner/728x90.gif',['class' => 'img-fluid']);?></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <textarea class="form-control" id="fr-1" rows="4" readonly=""><a href="https://<?= $_SERVER['HTTP_HOST']; ?>/reff/<?= $this->request->getSession()->read('Auth.Customers.username');?>"><img src="https://<?= $_SERVER['HTTP_HOST']; ?>/img/banner/160x600.gif" alt=""></a></textarea>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <textarea class="form-control" id="fr-2" rows="4" readonly=""><a href="https://<?= $_SERVER['HTTP_HOST']; ?>/reff/<?= $this->request->getSession()->read('Auth.Customers.username');?>"><img src="https://<?= $_SERVER['HTTP_HOST']; ?>/img/banner/336x280.gif" alt=""></a></textarea>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <textarea class="form-control" id="fr-3" rows="4" readonly=""><a href="https://<?= $_SERVER['HTTP_HOST']; ?>/reff/<?= $this->request->getSession()->read('Auth.Customers.username');?>"><img src="https://<?= $_SERVER['HTTP_HOST']; ?>/img/banner/728x90.gif" alt=""></a></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn btn-primary btn-block"  data-clipboard="true" data-clipboard-target="#fr-1"  data-clipboard-success="<?= __( 'Copied!'); ?>"  title="<?= __( 'Copy to clipboard'); ?>"><?= __('Copy to clipboard');?></button>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-block" data-clipboard="true" data-clipboard-target="#fr-2"  data-clipboard-success="<?= __( 'Copied!'); ?>"  title="<?= __( 'Copy to clipboard'); ?>"><?= __('Copy to clipboard');?></button>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-block"  data-clipboard="true" data-clipboard-target="#fr-3"  data-clipboard-success="<?= __( 'Copied!'); ?>"  title="<?= __( 'Copy to clipboard'); ?>"><?= __('Copy to clipboard');?></button>
                            </td>
                        </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<?php
$this->Html->script([
    '/member-assets/js/pages/features/forms/widgets/clipboard'
], ['block' => true]);
?>
<?php $this->append('script'); ?>
    <script>
    </script>
<?php $this->end(); ?>
