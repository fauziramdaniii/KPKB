<?php
/**
 * WARNING Dont remove this. because autocomplete IDE for helper
 * @var \Member\View\AppView $this
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
                    <h3 class="card-label"><?= __( 'Cart'); ?></h3>
                </div>

            </div>

            <?= $this->Form->create(null); ?>
            <div class="card-body">

                <?= $this->Flash->render() ?>
                <div  class="table-responsive">
                    <table class="table table-head-noborder cart">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?= __('Product Name');?></th>
                            <th style="width: 20%;"><?= __('Qty');?></th>
                            <th style="text-align: right;"><?= __('Weight');?> (kg)</th>
                            <th style="text-align: right;"><?= __('Sub Total Weight');?> (kg)</th>
                            <th style="text-align: right;"><?= __('Price');?></th>
                            <th style="text-align: right;"><?= __('Sub Total');?></th>
                            <th><?= __('Action');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; $subtotal = 0;$subtotalweight = 0; foreach($carts as $key => $cart) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ; ?></th>
                                <td><?= $cart['name']; ?></td>
                                <td>
                                    <input type="number" name="qty[<?= $key; ?>]" style="width: 80px;"  data-id="<?= $key; ?>" class="form-control input-qty" value="<?= $cart['qty']; ?>" min="1" max="1000" />
                                </td>
                                <td class="weight" style="text-align: right;"><?= $this->Number->format($cart['weight'] / 1000, ['locale' => 'en-US']); ?></td>
                                <td class="subtotalweight" style="text-align: right;"><?= $this->Number->format($cart['weight'] / 1000 * $cart['qty'] , ['locale' => 'en-US']); ?></td>
                                <td class="price" style="text-align: right;"><?= $this->Number->format($cart['price'], ['locale' => 'en-US']); ?></td>
                                <td class="subtotal" style="text-align: right;">
                                    <?= $this->Number->format($cart['price'] * $cart['qty'], ['locale' => 'en-US']); ?>
                                </td>
                                <td>
                                    <?= $this->Html->link('<span class="btn btn-sm btn-clean btn-icon btn-icon-sm"> <i class="flaticon-delete"></i></span>',
                                        [ 'action' => 'deleteCart',$key],
                                        ['escape' => false,'confirm' => 'Are you sure delete this cart?']);
                                    ?>
                                </td>
                            </tr>
                            <?php $subtotal += $cart['price'] * $cart['qty'];?>
                            <?php $subtotalweight += $cart['weight']  / 1000 * $cart['qty']; endforeach; ?>
                        <tr>
                            <td colspan="4" style="text-align: right;"><strong><?= __('Total Weight');?></strong></td>
                            <td style="text-align: right;">
                                <strong><span class="totalweight"><?= $this->Number->format($subtotalweight, ['locale' => 'en-US']); ?></span> gram</strong>
                            </td>
                            <td style="text-align: right;"><strong><?= __('Total');?></strong></td>
                            <td style="text-align: right;">
                                <strong>Rp. <span class="totaltotal"><?= $this->Number->format($subtotal, ['locale' => 'en-US']); ?></span></strong>
                            </td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="kt-form__section kt-form__section--first">
                            <div class="form-group">

                                <label><?= __( 'Receiver Name'); ?></label>

                                <div class="row">
                                    <div class="col-md-6">
                                        <?= $this->Form->control('customer_address_id', [
                                            'type' => 'select',
                                            'options' => $addressList,
                                            'class' => 'form-control',
                                            'label' => false,
                                            'div' => false,
                                            'autocomplete' => 'off'
                                        ]); ?>
                                        <?= $this->Form->hidden('shipping_cost', [
                                            'class' => 'form-control ',
                                            'label' => false,
                                            'div' => false,
                                            'id' => 'shipping_cost'
                                        ]); ?>
                                        <?= $this->Form->hidden('shipping_type', [
                                            'class' => 'form-control ',
                                            'label' => false,
                                            'div' => false,
                                            'id' => 'shipping_type'
                                        ]); ?>
                                        <?= $this->Form->hidden('total_weight', [
                                            'class' => 'form-control ',
                                            'label' => false,
                                            'div' => false,
                                            'id' => 'total_weight',
                                            'value' => $subtotalweight
                                        ]); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= $this->Html->link(__('Manage Shipping Address'),['controller' => 'Stockists', 'action' => 'info'],['class' => 'btn btn-secondary']);?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?= __( 'Address'); ?></label>
                                <p class="form-control-static text-bold address-shipping">
                                    <?= $address['address'];?>, <?= $address['province']['name'];?>, <?= $address['city']['type'];?> <?= $address['city']['name'];?>, <?= $address['subdistrict']['name'];?>, <?= $address['zip'];?>
                                </p>
                            </div>
                            <div class="form-group">
                                <label><?= __( 'Phone'); ?></label>
                                <p class="form-control-static text-bold phone-shipping"><?= $address['receiver_phone'];?></p>
                            </div>
                            <div class="form-group">
                                <label><?= __( 'Notes'); ?></label>
                                <?= $this->Form->textarea('notes', [
                                    'class' => 'form-control ',
                                    'label' => false,
                                    'div' => false,
                                    'id' => 'notes',
                                    'placeholder' => __('Text your notes such as delivery point location, etc.')
                                ]); ?>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?= __( 'Shipping Courrier'); ?></label>
                                            <?= $this->Form->control('shipping_courrier', [
                                                'type' => 'select',
                                                'class' => 'form-control',
                                                'label' => false,
                                                'div' => false,
                                                'autocomplete' => 'off'
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?= __( 'Estimated delivery'); ?></label>
                                            <p class="form-control-static text-bold address-etd mt-2">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?= __( 'Shipping Cost'); ?></label>
                                            <p class="form-control-static text-bold mt-2"><strong>Rp. <span class="address-cost">-</span></strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 offset-1">
                        <div class="kt-form__section kt-form__section--first">
                            <div class="kt-heading kt-heading--md"><?= __('Detail Payments');?></div>

                            <div class="form-group row">
                                <label class="col-lg-5"><?= __( 'Sub Total'); ?></label>
                                <p class="col-lg-7 form-control-static text-right ">
                                    <strong>Rp. <span class="total"><?= $this->Number->format($subtotal, ['locale' => 'en-US']); ?></span></strong>
                                </p>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-5"><?= __( 'Total Shipping Cost'); ?></label>
                                <p class="col-lg-7 form-control-static text-right ">
                                    <strong>Rp. <span class="shipping-cost">0</span></strong>
                                </p>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-5"><?= __( 'Total Payment'); ?></label>
                                <p class="col-lg-7 form-control-static text-right ">
                                    <strong>Rp. <span class="total-payment">0</span></strong>
                                </p>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg">
                            <i class="flaticon flaticon2-shopping-cart-1"></i> <?= __('Order Now');?>
                        </button>
                    </div>
                </div>

            </div>
            <?= $this->Form->end(); ?>
        </div>

    </div>
</div>





<?php $this->Html->script('/member-assets/plugins/numeral/numeral.min.js', ['block' => true]); ?>
<?php $this->append('script'); ?>
<script>
    jQuery(document).ready(function() {

        var id = $('#customer-address-id').val();
        changeShipping(id);

        function triggerChange() {
            let qty = parseInt($(this).val());
            let productId = parseInt($(this).data('id'));
            let max_qty = parseInt($(this).attr('max'));
            qty = qty > max_qty ? max_qty : qty;
            $(this).val(qty)
            if (isNaN(qty) || (qty <= 0)) {
                $(this).val(1);
                qty = 1;
            }
            const tr = $(this).parents('tr');
            let price = numeral(tr.find('.price').text()).value();
            let weight = numeral(tr.find('.weight').text()).value();
            tr.find('.subtotal').text(numeral(price * qty).format('0,0'));
            tr.find('.subtotalweight').text(numeral(weight * qty).format('0.00'));
            let total = 0;
            let totalweight = 0;
            $('.subtotal').each(function() {
                total += numeral($(this).text()).value();
            });
            $('.subtotalweight').each(function() {
                totalweight += numeral($(this).text()).value();
            });
            $('table.cart').find('.totalweight').text(numeral(totalweight).format('0.00'));
            $('table.cart').find('.totaltotal').text(numeral(total).format('0,0'));
            $('.total').text(numeral(total).format('0,0'));

            $.ajax({
                url: '<?= $this->Url->build(['action' => 'updateCart']); ?>',
                type : 'POST',
                data : {
                    id : productId,
                    qty : qty,
                    _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                },
                dataType : 'json',
                success: function(response){

                }
            });


            var id = $('#customer-address-id').val();
            changeShipping(id);
        }

        $('.input-qty')
            .change(triggerChange)
            .blur(triggerChange);


        $('#customer-address-id').on('change',function(){
            var id  = $(this).val();
            changeShipping(id);
        })


        function changeShipping(id){
            var totalweight  = parseFloat($.trim($('.totalweight').text()).replace(/,/g, ''));
            $.ajax({
                url: '<?= $this->Url->build(['action' => 'getAddressAndShippingCost']); ?>',
                type : 'POST',
                data : {
                    id : id,
                    weight : totalweight,
                    courrier : 'jne',
                    _csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'
                },
                dataType : 'json',
                success: function(response){
                    var address = response.customer_address.address + ', '+ response.customer_address.province.name + ', '+ response.customer_address.city.type + ' ' + response.customer_address.city.name + ', ' + response.customer_address.subdistrict.name + ', ' + response.customer_address.city.postal_code;
                    $('.address-shipping').text(address);
                    $('.phone-shipping').text(response.customer_address.receiver_phone);

                    var options = '';
                    $.each(response.shipping_list, function(k,v){
                        options += '<option value="'+v.code+'" data-cost="'+v.cost+'" data-etd="'+v.etd+'" data-service="'+v.name+'">'+v.name+'</option>';
                    })
                    // console.log(response.shipping_list[0])
                    $('.address-etd').html(response.shipping_list ? response.shipping_list[0].etd : '-');
                    $('.address-cost').html(response.shipping_list ?  (new Intl.NumberFormat('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 2})).format(response.shipping_list[0].cost) : '-');
                    $('.shipping-cost').html(response.shipping_list ?  (new Intl.NumberFormat('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 2})).format(response.shipping_list[0].cost) : '-');

                    $('#shipping_cost').val(response.shipping_list ? response.shipping_list[0].cost : 0);
                    $('#shipping_courrier').val(response.shipping_list ? response.shipping_list[0].code : '');
                    $('#shipping_type').val(response.shipping_list ? response.shipping_list[0].name : '');

                    $('#shipping-courrier').html(options);
                    var total = (parseFloat($.trim($('.total').text()).replace(/,/g, '')) + parseFloat($.trim($('.shipping-cost').text()).replace(/,/g, '')));
                    $('.total-payment').html((new Intl.NumberFormat('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 2})).format(
                        total
                    ));

                }
            });
        }


        $('#shipping-courrier').on('change',function(){
            var selected = $(this).val();
            var etd = $(this).find("option:selected").data('etd');
            var cost = $(this).find("option:selected").data('cost');
            var service = $(this).find("option:selected").data('service');
            var totalweight  = parseFloat($.trim($('.totalweight').text()).replace(/,/g, ''));

            $('#shipping_cost').val(cost);
            $('#shipping_courrier').val(selected);
            $('#shipping_type').val(service);
            $('#total_weight').val(totalweight);

            $('.address-etd').html(etd)
            $('.address-cost').html((new Intl.NumberFormat('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 2})).format(cost));
            $('.shipping-cost').html((new Intl.NumberFormat('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 2})).format(cost));
            var total = (parseFloat($.trim($('.total').text()).replace(/,/g, '')) + cost);
            $('.total-payment').html((new Intl.NumberFormat('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 2})).format(
                total
            ));
        })

    });
</script>
<?php $this->end(); ?>

