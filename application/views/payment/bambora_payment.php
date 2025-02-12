<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">
<input type="hidden" id="total" value="<?php echo $total; ?>">
<input type="hidden" id="currency" value="<?php echo $currency; ?>">
<input type="hidden" id="customer_name" value="<?php echo $cart_users_data['user_name']; ?>">
<input type="hidden" id="card_number" value="<?php echo $payment_instruction->card_number; ?>">
<input type="hidden" id="mm_yy" value="<?php echo $payment_instruction->mm_yy; ?>">
<input type="hidden" id="cvc" value="<?php echo $payment_instruction->cvc; ?>">

<?php $this->load->view('elements/loader_payment'); ?>

<!-- <div class="container pad_left_right">
    <div id="page-wrapper" class="page-loading">
        <nav class="nav-pane" style="margin-top: 70px;">
            <div class="nav-pane-container" style="color:#00000 !important;background-color: #FFFFFF !important;">
                <div class="nav-links">
                    <span>
                        <?php echo $payment_instruction->company_title; ?>
                    </span>
                </div>

                <div class="nav-links">
                    <span>
                        <?php
                        $currencyV = getDefaultCurrencyCode('l') . '_currency';
                        $currency_final  = $general_instruction->$currencyV;
                        ?>
                        <?php echo round($total, 2) . ' ' . $currency_final; ?>
                    </span>
                </div>
        </nav>
        <div id="response-panel-success" class="container pad_left_right">
            <div class="message">
                <div class="response message-content">

                    <h3><?php echo $payment_instruction->payment_approved; ?></h3>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><?php echo $payment_instruction->transaction_id; ?></td>
                                <td id="response-id"></td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div id="response-panel-fail" class="container pad_left_right">

            <div class="message">
                <div class="response message-content">

                    <h3 class="errortable"><?php echo $payment_instruction->payment_declined; ?></h3>
                    <table class="table errortable">
                        <tbody>
                            <tr>
                                <td class="errortable"><?php echo $payment_instruction->error_message; ?></td>
                                <td id="response-error-message" class="errortable"></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div id="payment-panels" class="container pad_left_right">
            <div class="message" id="panel-card">
                <div class="message-content">
                    <form id="form-payment-card" method="POST">
                        <div class="form-group">
                            <label for="card-number"><?php echo $payment_instruction->card_number; ?></label>
                            <div class="input" id="card-number"></div>
                            <div class="feedback-icon"></div>
                            <label for="card-number" class="feedback-message invalid"></label>
                        </div>

                        <div class="input-row">
                            <div class="form-group">
                                <label for="expiry"><?php echo $payment_instruction->expiry; ?></label>
                                <div class="input" name="expiry" id="expiry"></div>
                                <div class="feedback-icon"></div>
                                <label for="expiry" class="feedback-message invalid"></label>
                            </div>

                            <div class="form-group">
                                <label for="cvv"><?php echo $payment_instruction->security_code; ?></label>
                                <div class="input" id="cvv"></div>
                                <div class="feedback-icon"></div>
                                <label for="cvv" class="feedback-message invalid"></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">
                                <?php echo $cart_instruction->captcha_text; ?>:<br>
                                <div id="captImg"><?php echo generate_captcha(); ?></div>
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="span12 form-control" id="captcha" placeholder="<?php echo $cart_instruction->captcha_text; ?>" name="captcha" data-form-field="captcha" required oninvalid="this.setCustomValidity('<?php if (isset($cart_instruction->invalid_captcha)) echo $cart_instruction->invalid_captcha; ?>');" onchange="try{setCustomValidity('')}catch(e){};" x-moz-errormessage="<?php if (isset($cart_instruction->invalid_captcha)) echo $cart_instruction->invalid_captcha; ?>">
                                <span class="red1 trynewcaptcha"><?php echo $cart_instruction->try_new_captcha_text; ?></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <button type="submit" id="card-payment-btn" class="btn btn-small btn-min-width actn-btn"><?php echo $payment_instruction->pay_button; ?></button>
                                <a class="btn btn-small btn-min-width actn-btn" href="<?php echo base_url() .  $lang_id . '/cart/cart_confirm'; ?>"><?php echo $payment_instruction->cancel_button; ?></a>
                            </div>
                            <?php if ($all_data['payment_accept_section_status'] == 1 && count($payment_accept_icons) > 0) { ?>
                                <div class="col-md-6">
                                    <span style="border-radius: 5px;border: 1px solid #<?= $all_data['payment_accept_text_color']; ?>; padding:5px;background-color: #<?= $all_data['payment_accept_text_bg_color']; ?>;color: #<?= $all_data['payment_accept_text_color']; ?>;"><?php echo $payment_instruction->payment_accept_text; ?></span>
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
                                </div>
                            <?php } ?>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div> -->


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

                <div class="card-errors error"></div>
                <!-- Payment form -->
                <form id="form-payment-card" method="POST">
                    <input type="hidden" name="token" />
                    <div class="form-group row">
                        <label class="col-md-4 control-label"><?php echo $payment_instruction->card_number; ?></label>
                        <div class="col-md-8">
                            <div id="card-number" class="form-control"></div>
                            <div class="feedback-icon"></div>
                            <label for="card-number" class="feedback-message invalid"></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 control-label"><?php echo $payment_instruction->expiry; ?></label>
                        <div class="col-md-8">
                            <div name="expiry" id="expiry" class="form-control"></div>
                            <div class="feedback-icon"></div>
                            <label for="expiry" class="feedback-message invalid"></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 control-label"><?php echo $payment_instruction->security_code; ?></label>
                        <div class="col-md-8">
                            <div name="expiry" id="cvv" class="form-control"></div>
                            <div class="feedback-icon"></div>
                            <label for="cvv" class="feedback-message invalid"></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 control-label">
                            <?php echo $cart_instruction->captcha_text; ?>:<br>
                            <div id="captImg"><?php echo generate_captcha(); ?></div>
                        </label>
                        <div class="col-md-8">
                            <input type="text" class="span12 form-control" id="captcha" placeholder="<?php echo $cart_instruction->captcha_text; ?>" name="captcha" data-form-field="captcha" required oninvalid="this.setCustomValidity('<?php if (isset($cart_instruction->invalid_captcha)) echo $cart_instruction->invalid_captcha; ?>');" onchange="try{setCustomValidity('')}catch(e){};" x-moz-errormessage="<?php if (isset($cart_instruction->invalid_captcha)) echo $cart_instruction->invalid_captcha; ?>">
                            <span class="red1 trynewcaptcha"><?php echo $cart_instruction->try_new_captcha_text; ?></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" id="card-payment-btn" class="btn btn-primary btn-small btn-min-width btn-pay actn-btn"><?php echo $payment_instruction->pay_button; ?></button>
                            <a class="btn btn-primary btn-small btn-min-width btn-cancel actn-btn" href="<?php echo base_url() . $lang_id . '/cart/cart_confirm'; ?>"><?php echo $payment_instruction->cancel_button; ?></a>
                        </div>
                        <?php if ($all_data['payment_accept_section_status'] == 1 && count($payment_accept_icons) > 0) { ?>
                            <div class="col-md-6">
                                <span style="border-radius: 5px;border: 1px solid #<?= $all_data['payment_accept_text_color']; ?>; padding:5px;background-color: #<?= $all_data['payment_accept_text_bg_color']; ?>;color: #<?= $all_data['payment_accept_text_color']; ?>;"><?php echo $payment_instruction->payment_accept_text; ?></span>
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
                            </div>
                        <?php } ?>
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


    </div>
</div>


<span class="displaynon" id="invalid_captcha"><?php if (isset($cart_instruction->invalid_captcha)) echo $cart_instruction->invalid_captcha; ?></span>
<span class="displaynon" id="backorder_not_accepted"><?php if (isset($cart_instruction->backorder_not_accept_quantity)) echo $cart_instruction->backorder_not_accept_quantity; ?></span>
<span class="displaynon" id="backorder_not_accepted_multiple"><?php if (isset($cart_instruction->backorder_not_accept_more_quantity)) echo $cart_instruction->backorder_not_accept_more_quantity; ?></span>

<!--Modal Custom warning start-->
<?php $this->load->view('elements/popup/custom_warning_popup'); ?>
<!--Modal Custom warning end-->