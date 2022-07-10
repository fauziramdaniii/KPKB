<<?php
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
                <h5 class="text-dark font-weight-bold my-1 mr-5"><?= __('Destination Address');?></h5>
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
                    <h3 class="card-label"><?= __('Select Destination Address');?></h3>
                </div>

                <div class="card-toolbar">
                    <a href="<?= $this->Url->build(['controller' => 'Address','action' => 'add']); ?>" class="btn btn-light-primary font-weight-bold">
                        <i class="ki ki-plus icon-md mr-2"></i> <?= __( 'New Shipping Destination Address'); ?></a>
                </div>
            </div>

            <div class="card-body py-20">
                <?= $this->Form->create(null); ?>
                <?= $this->Flash->render(); ?>
                <div class="row">
                    <div class="col-lg-6">
                        <?= __('Please select destination address'); ?>
                        <div class="address_select"></div>
                    </div>
                    <div class="col-lg-3">
                        <div class="kt-form__section kt-form__section--first">
                            <div class="form-group">
                                <?= $this->Form->input('address_id', [
                                    'class' => 'form-control ',
                                    'label' => false,
                                    'div' => false,
                                    'id' => 'address_id',
                                    'options' => $address,
                                    'empty' => __('Select Address')
                                ]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <button type="submit" class="btn btn-primary btn-block ">
                            <?= __('Select');?>
                        </button>
                    </div>
                </div>

                <?= $this->Form->end(); ?>
            </div>
        </div>

    </div>
</div>

<?php $this->append('script'); ?>
<script>
    jQuery(document).ready(function() {

        $('#address_id').on('change',function(){
            var id  = $(this).val();$.ajax({
                url: '<?= $this->Url->build(['action' => 'getAddress']); ?>',
                type : 'POST',
                data : {
                    id : id,
                    _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                },
                dataType : 'json',
                success: function(response){
                    $('.address_select').html(response);
                }
            });
        })

    })
</script>

<?php $this->end(); ?>





