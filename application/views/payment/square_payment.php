<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">
<input type="hidden" id="total" value="<?php echo $total; ?>">
<input type="hidden" id="currency" value="<?php echo $currency; ?>">
<input type="hidden" id="customer_name" value="<?php echo $cart_users_data['user_name']; ?>">
<input type="hidden" id="card_number" value="<?php echo $payment_instruction->card_number; ?>">
<input type="hidden" id="mm_yy" value="<?php echo $payment_instruction->mm_yy; ?>">
<input type="hidden" id="cvc" value="<?php echo $payment_instruction->cvc; ?>">
<input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
<span class="displaynon" id="formvalidation_cart_payment_message"><?php if (isset($form_validation_instruction->cart_payment_message)) echo $form_validation_instruction->cart_payment_message; ?></span>
<span class="displaynon" id="formvalidation_cart_invoice_message"><?php if (isset($form_validation_instruction->cart_invoice_message)) echo $form_validation_instruction->cart_invoice_message; ?></span>
<?php $this->load->view('elements/loader_payment'); ?>
<div class="mainContent px-3 px-lg-5">
    <div class="container-fluid my-5 float-start w-100">
        <div id="payment-panels" class="paymentPanel d-flex flex-column panel my-5">
            <div class="panel-heading">
                <h3 class="panel-title d-flex align-items-center justify-content-between"><?php echo $payment_instruction->company_title; ?>
                    <p class="heading-price m-0">
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
                <!-- Payment form -->

                <div class="payment_div" <?php if ($loginuserterm['credit_term_status'] == "1" &&  $limit > $total) {  ?> style="display:none;" <?php } ?>>
                    <div class="card-errors"></div>
                    <form id="payment-form" action="<?php echo base_url() . $lang_id . '/payment/square_purchase'; ?>" method="POST">
                        <input type="hidden" name="token" id="square-token" />

                        <div class="form-group mb-3 d-flex flex-row flex-wrap">

                            <?php foreach ($user_cards as $card) {  ?>
                                <div class="previousCardDetails form-check position-relative mb-3">
                                    <input class="form-check-input filter_option h-auto" type="radio" name="card_value" value="<?php echo $card['card_id']; ?>" style="min-height:40px;">
                                    <label class="form-check-label" for="radio1">
                                        <span class="bankName"><?php echo $card['card_brand']; ?></span> <br> <span class="accountNumber">*************<?php echo $card['last_4']; ?></span> <br>

                                    </label>
                                </div>

                            <?php } ?>

                            <div class="previousCardDetails form-check position-relative mb-3" <?php if (empty($user_id)) { ?> style="Display:none;" <?php } ?>>
                                <input class="form-check-input filter_option h-auto" type="radio" name="card_value" value="newcard" style="min-height:40px;">
                                <label class="form-check-label" for="radio1">
                                    <span class="bankName"><?php echo $payment_instruction->payment_new_card_label; ?></span> <br> <br>

                                </label>
                            </div>

                        </div>
                        <div class="form-group newcarddiv" <?php if (count($user_cards) > 0) { ?> style="Display:none;" <?php } ?>>
                            <?php if ($all_data['payment_accept_section_status'] == 1 && count($payment_accept_icons) > 0) { ?>
                                <!-- <span style="border-radius: 5px;border: 1px solid #<?= $all_data['payment_accept_text_color']; ?>; padding:5px;background-color: #<?= $all_data['payment_accept_text_bg_color']; ?>;color: #<?= $all_data['payment_accept_text_color']; ?>;"><?php echo $payment_instruction->payment_accept_text; ?></span> -->
                                <table aria-label="social-information">
                                    <tbody>
                                        <tr>
                                            <?php foreach ($payment_accept_icons as $icon) { ?>
                                                <td style="padding:5px !important;">
                                                    <img src="<?= asset_url('assets/uploads/payment_card_icon/' . $icon["payment_card_icon"]); ?>" alt="Social media image" style="max-height:30px !important;">
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php } ?>
                            <div id="card-container"></div>
                        </div>

                        <div class="form-group">
                            <?php echo $cart_instruction->captcha_text; ?>:<br>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-6 control-label">
                                    <div id="captImg"><?php echo generate_captcha(); ?></div>
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="span12 form-control" id="captcha" placeholder="<?php echo $cart_instruction->captcha_text; ?>" name="captcha" data-form-field="captcha" required oninvalid="this.setCustomValidity('<?php if (isset($cart_instruction->invalid_captcha)) echo $cart_instruction->invalid_captcha; ?>');" onchange="try{setCustomValidity('')}catch(e){};" x-moz-errormessage="<?php if (isset($cart_instruction->invalid_captcha)) echo $cart_instruction->invalid_captcha; ?>">
                                    <span class="red1 trynewcaptcha"><?php echo $cart_instruction->try_new_captcha_text; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group newcarddiv">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" id="card-button" class="btn btn-primary btn-small btn-min-width btn-pay actn-btn rounded"><?php echo $payment_instruction->pay_button; ?></button>
                                    <a class="btn btn-primary btn-small btn-min-width btn-cancel actn-btn rounded" href="<?php echo base_url() . $lang_id . '/cart/cart_confirm'; ?>"><?php echo $payment_instruction->cancel_button; ?></a>
                                </div>
                            </div>
                        </div>


                        <div class="form-group existingcard">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" id="paycard-button" class="btn btn-primary btn-small btn-min-width btn-pay actn-btn rounded"><?php echo $payment_instruction->pay_button; ?></button>
                                    <a class="btn btn-primary btn-small btn-min-width btn-cancel actn-btn rounded" href="<?php echo base_url() . $lang_id . '/cart/cart_confirm'; ?>"><?php echo $payment_instruction->cancel_button; ?></a>
                                </div>
                            </div>
                        </div>



                    </form>

                </div>


                <div class="direct_payment" style="display:none;">

                    <div class="col-lg-12">
                        <a href="<?php echo base_url() . $lang_id . '/payment/charge_with_term'; ?>" class="btn  actn-btn rounded"><?php echo $general_instruction->sbmt; ?></a>

                        <a href="<?php echo base_url() . $lang_id . '/cart/cart_confirm'; ?>" class="btn  actn-btn rounded"><?php echo $payment_instruction->cancel_button; ?></a>

                    </div>
                </div>

            </div>
            <div class="outcome">
                <div class="error">
                    <div id="payment-status-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php foreach ($stripe_errors as $se) { ?>
    <span class="displaynon" id="<?php echo $se['error_code']; ?>"><?php echo $se['error_text']; ?></span>
<?php } ?>

<input type="hidden" id="application_id" value="<?php echo $square_api_settings['application_id']; ?>">
<input type="hidden" id="location_id" value="<?php echo $square_api_settings['location_id']; ?>">

<span class="displaynon" id="invalid_captcha"><?php if (isset($cart_instruction->invalid_captcha)) echo $cart_instruction->invalid_captcha; ?></span>
<span class="displaynon" id="backorder_not_accepted"><?php if (isset($cart_instruction->backorder_not_accept_quantity)) echo $cart_instruction->backorder_not_accept_quantity; ?></span>
<span class="displaynon" id="backorder_not_accepted_multiple"><?php if (isset($cart_instruction->backorder_not_accept_more_quantity)) echo $cart_instruction->backorder_not_accept_more_quantity; ?></span>


<!--Modal Custom warning start-->
<?php $this->load->view('elements/popup/custom_warning_popup'); ?>
<!--Modal Custom warning end-->


<!-- Modal -->
<div class="modal fade" id="CVVModal" tabindex="-1" aria-labelledby="CVVModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h5 class="modal-title" id="CVVModalLabel">What is CVV?</h5>
                <img class="my-4" src="<?php echo asset_url('assets/frontend/images/cvv.png'); ?>" />
                <p>CVV number is the last three digits on the back of your card. </p>
                <button type="button" class="btn btn-primary rounded mt-0" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>