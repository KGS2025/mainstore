<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">
<input type="hidden" id="total" value="<?php echo $total; ?>">
<input type="hidden" id="currency" value="<?php echo $currency; ?>">
<input type="hidden" id="customer_name" value="<?php echo $cart_users_data['user_name']; ?>">
<input type="hidden" id="card_number" value="<?php echo $payment_instruction->card_number; ?>">
<input type="hidden" id="mm_yy" value="<?php echo $payment_instruction->mm_yy; ?>">
<input type="hidden" id="cvc" value="<?php echo $payment_instruction->cvc; ?>">

<span class="displaynon" id="formvalidation_cart_payment_message"><?php if (isset($form_validation_instruction->cart_payment_message)) echo $form_validation_instruction->cart_payment_message; ?></span>
<span class="displaynon" id="formvalidation_cart_invoice_message"><?php if (isset($form_validation_instruction->cart_invoice_message)) echo $form_validation_instruction->cart_invoice_message; ?></span>

<?php $this->load->view('elements/loader_payment'); ?>
<div class="mainContent px-3 px-lg-5">
    <div class="container-fluid my-5 float-start w-100">
        <div class="container pad_left_right" style="padding-bottom: 20px;">
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
                <div class="panel-body ">

                    <?php

                    if ($loginuserterm['credit_term_status'] == "1") { ?>
                        <div class="col-md-12">
                            <div class="form-group  billingShippingcheck float-start w-100 mb-3">
                                <label for="cart_surname" class="billing-details center control-label"><?php echo $cart_instruction->term_remainlimit . " : " . $limit; ?>
                                    <span class="cart_asterisk"></span>

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
                        <?php if ($paymee_token) { ?>
                                <iframe src="<?php echo $payment_url; ?>" width="100%" height="700px" allowtransparency="true" frameborder="0" scrolling="no"></iframe>
                           
                        <?php } else { ?>
                            <div class="paymee-card-errors" style="text-align: center;color: red;"></div>
                        <?php } ?>


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
    </div>
</div>

<span class="displaynon" id="invalid_captcha"><?php if (isset($cart_instruction->invalid_captcha)) echo $cart_instruction->invalid_captcha; ?></span>
<span class="displaynon" id="backorder_not_accepted">
    <?php $msg = isset($warning['items']) ? $warning['items'] : '';
    if (isset($cart_instruction->backorder_not_accept_quantity)) echo str_replace('PRODUCTITEMS', $msg, $cart_instruction->backorder_not_accept_quantity); ?></span>
<span class="displaynon" id="backorder_not_accepted_multiple"><?php if (isset($cart_instruction->backorder_not_accept_more_quantity)) echo str_replace('PRODUCTITEMS', $msg, $cart_instruction->backorder_not_accept_more_quantity); ?></span>
<input type="hidden" value="<?php echo $paymee_token ? 1 : 0; ?>" id="call_true" />
<input type="hidden" value="<?php echo isset($warning['errors']) ? $warning['errors'] : ''; ?>" id="warning" />

<!--Modal Custom warning start-->
<?php $this->load->view('elements/popup/custom_warning_popup'); ?>
<!--Modal Custom warning end-->
