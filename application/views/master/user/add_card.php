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
<div class="my-account-area py-3 py-sm-5">
    <div class="container">
        <div class="row">
            <!-- user dahboard sidebar-->
            <?php $this->load->view('elements/userdashboard-sidebar'); ?>
            <div class="col-12 col-md-9">
                <div class="my-account-content mb-50 h-100">                        
                    <div id="payment-panels" class="paymentPanel d-flex flex-column panel">
                        <div class="panel-heading">
                            <h5 class="panel-title d-flex align-items-center justify-content-between"> <?php echo $all_titles->add_cards_heading; ?>
                            </h5>
                        </div>

                        <div class="panel-body float-start w-100">
                            <div class="card-errors"></div>
                            <!-- Payment form -->
                            <form id="addcard-form" action="<?php echo base_url() . $lang_id . '/user/save_card'; ?>" method="POST">
                                <input type="hidden" name="token" id="square-token" />
                                <div class="form-group">
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="submit" id="card-button" class="btn btn-small btn-min-width btn-pay actn-btn rounded border-none"><?php echo $general_instruction->add_button; ?></button>
                                            <a class="btn btn-small btn-min-width btn-cancel actn-btn rounded border-none" href="<?php echo base_url() . $lang_id . '/cart/cart_confirm'; ?>"><?php echo $payment_instruction->cancel_button; ?></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="outcome">
                            <div class="error">
                                <div id="payment-status-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mainContent px-3 px-lg-5">
    <div class="container-fluid my-5 float-start w-100">
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