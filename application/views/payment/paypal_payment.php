<?php
$click_pay_error  = $this->session->userdata('click_pay_error');
$click_pay_message  = $this->session->userdata('click_pay_message');
$payment_api_error  = $this->session->userdata('payment_api_error');
$user_id = getFrontenduserId();
$loginuserdata =  loginuserdata();

?>
<script src="<?php echo base_url().'assets/frontend/js/';?>paypal_checkout.js"></script>
<input type="hidden" id="click_pay_error" value="<?php echo $click_pay_error; ?>">
<input type="hidden" id="payment_api_error" value="<?php echo $payment_api_error; ?>">
<input type="hidden" id="click_pay_message" value="<?php echo $click_pay_message; ?>">

<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">
<input type="hidden" id="total" value="<?php echo $total; ?>">
<input type="hidden" id="currency" value="<?php echo $currency; ?>">
<input type="hidden" id="customer_name" value="<?php echo $cart_users_data['user_name']; ?>">
<input type="hidden" id="card_number" value="<?php echo $payment_instruction->card_number; ?>">
<input type="hidden" id="mm_yy" value="<?php echo $payment_instruction->mm_yy; ?>">
<input type="hidden" id="cvc" value="<?php echo $payment_instruction->cvc; ?>">

<?php $this->load->view('elements/loader_payment'); ?>

<div class="container pad_left_right">

    <div id="payment-panels" class="paymentPanel d-flex flex-column panel my-5">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $payment_instruction->company_title; ?>
                <p class="heading-price">
                    <?php
                    $currencyV = getDefaultCurrencyCode('l') . '_currency';
                    $currency_final  = $general_instruction->$currencyV;
                    ?>
                    <?php echo round($total, 2) . ' ' . $currency_final;

                    $limit = available_credit_limit();
                    ?>
                </p>
            </h3>
        </div>
        
        <div class="panel-body float-start w-100">
            <?php
            if ($loginuserterm['credit_term_status'] == "1") { ?>
                <div class="col-md-12">
                    <div class="form-group  billingShippingcheck float-start w-100 mb-3">
                        <label for="cart_surname" class="billing-details center control-label"><?php echo $cart_instruction->term_remainlimit . " : " . $limit; ?> <span class="cart_asterisk"></span>

                            <?php if ($limit < $total) { ?>
                                <p class="cart_asterisk"> <?php echo $payment_instruction->payment_credlimitover; ?></p>
                            <?php } ?>

                        </label>

                    </div>
                </div>
            <?php } ?>

            <?php

            if ($loginuserterm['credit_term_status'] == "1" &&  $limit > $total) { ?>
                <div class="col-md-12">
                    <div class="form-group  billingShippingcheck float-start w-100 mb-3">
                        <label for="cart_surname" class="billing-details center control-label"><?php echo $cart_instruction->paywith_term; ?><span class="cart_asterisk">*</span></label>
                        <div class="col-sm-5">

                            <div class="form-check form-check-inline radio-inline p-0 position-relative">
                                <input class="billing_to_shipping_class required_input" type="radio" id="radio1" name="creditterm_payment" value="1" <?php echo $yes_checked; ?>>
                                <label for="radio1" class="text-dark">
                                    <?php echo $cart_instruction->billing_details_same_shipping_details_text_yes; ?>
                                </label>
                            </div>

                            <div class="form-check form-check-inline radio-inline p-0 position-relative">
                                <input class="billing_to_shipping_class required_input" id="radio2" type="radio" name="creditterm_payment" value="0" <?php echo $no_checked; ?>>
                                <label for="radio2" class="text-dark">
                                    <?php echo $cart_instruction->billing_details_same_shipping_details_text_no; ?>
                                </label>
                            </div>
                            <p class="help-block blink_error"></p>
                        </div>
                    </div>
                </div>

            <?php } ?>

            <div class="payment_div" <?php if ($loginuserterm['credit_term_status'] == "1" &&  $limit > $total) {  ?> style="display:none;" <?php } ?>>

                <?php if (($payment_api_error != "1" &&  $click_pay_error != "1") || empty($user_id)) {   ?>
                    <label for="cart_surname" class="billing-details center control-label"><?php echo $payment_instruction->paymentpage_instructions; ?> <span class="cart_asterisk"></span>
                    </label>
                <?php }  ?>

                <?php if ($click_pay_error == "1" && !empty($user_id)) {   ?>
                    <label for="cart_surname" class="billing-details center control-label"><?php echo $payment_instruction->paymentpage_instructions__paymemt_failed; ?> <span class="cart_asterisk"></span>
                    </label>
                <?php }  ?>

                <?php if ($payment_api_error == "1" && !empty($user_id)) {   ?>
                    <label for="cart_surname" class="billing-details center control-label"><?php echo $payment_instruction->paymentpage_instructions__gateway_notworking; ?> <span class="cart_asterisk"></span>
                    </label>
                <?php }  ?>

                <div class="col-lg-12">
                
                    <?php if ($payment_api_error != "1") {   ?>
                        <form class="form-horizontal" method="POST" action="https://www.sandbox.PayPal.com/cgi-bin/webscr ">
                            <input type='hidden' name='business' value='sb-p8kpf28900889@business.example.com'>
                            <input type='hidden' name='item_name' value='Camera'>
                            <input type='hidden' name='item_number' value='CAM#N1'>
                            <input type='hidden' id="amount" name='amount' value='<?php echo '1';//$total;?>'>
                            <input type='hidden' name='no_shipping' value='1'>
                            <input type='hidden' name='currency_code' value='<?php echo $currency;?>'>
                            <!-- <input type='hidden' name='notify_url' value='<?php echo $returnUrl; ?>'>
                            <input type='hidden' name='cancel_return' value='<?php echo $cancelUrl; ?>'>
                            <input type='hidden' name='return' value='<?php echo $returnUrl; ?>'> -->
                            
                            <input type="hidden" name="cmd" value="_xclick">
                            <!-- <button type="submit" class="btn  actn-btn rounded"><?php echo $payment_instruction->pay_button; ?></button> -->
                            </br>
                            </br>
                            <div class="item">                                
                                <div id="paypal-button"></div>                                
                            </div>
                            </br>
                            <a href="<?php echo base_url() . $lang_id . '/cart/cart_confirm'; ?>" class="btn  actn-btn rounded"><?php echo $payment_instruction->cancel_button; ?></a>
                        </form>
                    <?php }  ?>


                    <?php if (($click_pay_error == "1" || $payment_api_error == "1") && !empty($user_id)) {   ?>                        
                        <a href="<?php echo base_url() . $lang_id . '/'; ?>payment/save_quotation" class="btn  actn-btn rounded"><?php echo $payment_instruction->payment_btn_anothermethod; ?></a>
                        
                    <?php }  ?>
                    
                    <?php if ($payment_api_error == "1" & !empty($user_id)) {   ?>

                        <a href="<?php echo base_url() . $lang_id . '/'; ?>payment/save_quotation/1" class="btn  actn-btn rounded"><?php echo $payment_instruction->payment_btn_emailme; ?></a>


                    <?php }  ?>      
                    
                </div>

            </div>


            <div class="direct_payment" style="display:none;">

                <div class="col-lg-12">
                    <a href="<?php echo base_url() . $lang_id . '/payment/charge_with_term'; ?>" class="btn  actn-btn rounded"><?php echo $general_instruction->sbmt; ?></a>

                    <a href="<?php echo base_url() . $lang_id . '/cart/cart_confirm'; ?>" class="btn  actn-btn rounded"><?php echo $payment_instruction->cancel_button; ?></a>

                </div>
            </div>

                       

        </div>


    </div>
</div>


<span class="displaynon" id="invalid_captcha"><?php if (isset($cart_instruction->invalid_captcha)) echo $cart_instruction->invalid_captcha; ?></span>
<span class="displaynon" id="backorder_not_accepted"><?php if (isset($cart_instruction->backorder_not_accept_quantity)) echo $cart_instruction->backorder_not_accept_quantity; ?></span>
<span class="displaynon" id="backorder_not_accepted_multiple"><?php if (isset($cart_instruction->backorder_not_accept_more_quantity)) echo $cart_instruction->backorder_not_accept_more_quantity; ?></span>

<!--Modal Custom warning start-->
<?php $this->load->view('elements/popup/custom_warning_popup'); ?>
<!--Modal Custom warning end-->

<script type="text/javascript">
paypal.Button.render({
    // Configure environment
    env: '<?php echo $paypal->paypalEnv; ?>',
    client: {
        sandbox: '<?php echo $paypal->paypalClientID; ?>',
        production: '<?php echo $paypal->paypalClientID; ?>'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
        size: 'medium',
        color: 'gold',
        shape: 'rect',
    },
    // Set up a payment
    payment: function (data, actions) {
        return actions.payment.create({
            transactions: [{
                amount: {
                    total: '<?php echo $paypal->paypalEnv=='sandbox'?$total:$total; ?>',
                    currency: '<?php echo $currency;?>'
                }
            }]
      });
    },
    // Execute the payment
    onAuthorize: function (data, actions) {
        return actions.payment.execute()
        .then(function () {
            // Show a confirmation message to the buyer
            //window.alert('Thank you for your purchase!');
            
            // Redirect to the payment process page
            window.location = "<?php echo $returnUrl;?>&paymentID="+data.paymentID+"&token="+data.paymentToken+"&payerID="+data.payerID;
        });
    }
}, '#paypal-button');
</script>
