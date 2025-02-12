<?php $comingsoon = getNoImage('coming-soon'); ?>

<div class="mainContent px-3 px-lg-5">
    <?php $this->load->view('elements/body_logo'); ?>



    <div class="my-account-area py-3 py-sm-5">
        <div class="container">
            <div class="row">
                <!-- user dahboard sidebar-->
                <?php $this->load->view('elements/userdashboard-sidebar'); ?>
                <div class="col-12 col-md-9">
                    <div class="my-account-content mb-50 h-100">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url() . $lang_id . '/'; ?>user/save_creditterm_data" id="cart_details_form" enctype="multipart/form-data">
                            <input type="hidden" value="submit" name="button_checkings" id="button_checkings">
                            <input type="hidden" id="block_timezone" name="block_timezone" value="" />
                            <input type="hidden" id="cart_block_timer" name="cart_block_timer" value="<?php echo $cart_timer->cart_block_timer; ?>" />
                            <div class="main-page">
                                <div class="car-lists productlisting productbaselisting">
                                    <?php if (!empty($cart_details)) { ?>
                                        <h4 class="cart-user-form" style="text-align:center;"><?php echo $cart_instruction->fill_in_cart_details; ?></h4>
                                    <?php } ?>
                                    <div class="form-fill-cart float-start w-100">
                                        <?php
                                        $yes_checked = "";
                                        $no_checked = "";

                                        ?>
                                        <div class="cart-user-form float-start w-100">
                                            <?php include('cart_timer.php'); ?>

                                        </div>

                                        <div class="cart-form-grid float-start w-100">

                                            <div class="col-lg-12 float-start w-100" id="hide_billing_details">

                                                <h4><?php echo $cart_instruction->term_dashboard_title; ?></h4>
                                                <p><?php echo $general_instruction->creditterm_instructions; ?></p>


                                                <div class="formGrid d-grid gap-3 grid-col-2">

                                                    <?php
                                                    
                                                  
                                                    
                                                    if ($loginuserterm['credit_term_status'] == "1") { ?>

                                                        <div class="form-group float-start w-100 mb-3">
                                                            <label for="cart_company" class="w-100 float-start control-label"><?php echo $cart_instruction->term_status; ?></label>
                                                            <div class="col-lg-12">
                                                                <?php
                                                                if ($loginuserterm['credit_term_status'] == "1") {
                                                                    echo $admin_static_links['approved_text'];
                                                                }
                                                                ?> </div>
                                                        </div>

                                                        <div class="form-group float-start w-100 mb-3">
                                                            <label for="cart_company" class="w-100 float-start control-label"><?php echo $cart_instruction->credit_file; ?></label>
                                                            <div class="col-lg-12">
                                                                <a href="<?php echo base_url() . '/assets/uploads/cart/' . $loginuserterm['term_final_file']; ?>" download class="btn  actn-btn rounded" id="signup_footer"><?php echo $cart_instruction->download_file; ?></a>
                                                            </div>
                                                        </div>


                                                        <div class="form-group float-start w-100">
                                                            <label for="cart_surname" class="col-sm-12 left control-label"><?php echo $cart_instruction->credit_days; ?>
                                                                <span class="cart_asterisk"></span></label>
                                                            <div class="col-lg-12">
                                                                <?php echo $loginuserterm['payment_term_days']; ?>
                                                            </div>
                                                            <p class="help-block"></p>
                                                        </div>


                                                        <div class="form-group float-start w-100">
                                                            <label for="cart_email" class="col-sm-12 control-label"><?php echo $cart_instruction->term_validity; ?>
                                                            </label>
                                                            <div class="col-lg-12">
                                                                <?php echo $loginuserterm['term_validity']; ?>
                                                            </div>
                                                            <p class="help-block"></p>
                                                        </div>
                                                        <div class="form-group float-start w-100">
                                                            <label for="cart_email" class="col-sm-12 control-label"><?php echo $cart_instruction->term_approved_date; ?>
                                                            </label>
                                                            <div class="col-lg-12">
                                                                <?php echo $loginuserterm['approved_on']; ?>
                                                            </div>
                                                            <p class="help-block"></p>
                                                        </div>


                                                        <div class="form-group float-start w-100">
                                                            <label for="cart_email" class="col-sm-12 control-label"><?php echo $cart_instruction->term_amountlimit; ?>
                                                            </label>
                                                            <div class="col-lg-12">
                                                                <?php echo $loginuserterm['term_amountlimit']; ?>
                                                            </div>
                                                            <p class="help-block"></p>
                                                        </div>


                                                        <div class="form-group float-start w-100">
                                                            <label for="cart_email" class="col-sm-12 control-label"><?php echo $cart_instruction->term_expiredate; ?>
                                                            </label>
                                                            <div class="col-lg-12">
                                                                <?php echo $loginuserterm['expire_date']; ?>
                                                            </div>
                                                            <p class="help-block"></p>
                                                        </div>



                                                        <div class="form-group float-start w-100">
                                                            <label for="cart_email" class="col-sm-12 control-label"><?php echo $cart_instruction->term_remainlimit; ?>
                                                            </label>
                                                            <div class="col-lg-12">
                                                                <?php echo  available_credit_limit(); ?>
                                                            </div>
                                                            <p class="help-block"></p>
                                                        </div>


                                                        

                                                    <?php } else if ($term_last_request['status'] == "2") { ?>



                                                        <div class="form-group float-start w-100 mb-3">
                                                            <label for="cart_company" class="w-100 float-start control-label"><?php echo $cart_instruction->term_status; ?></label>
                                                            <div class="col-lg-12">
                                                                <?php
                                                                if ($term_last_request['status'] == "2") {
                                                                    echo $admin_static_links['decline_text'];
                                                                }
                                                                ?> </div>
                                                        </div>

                                                        <div class="form-group float-start w-100 mb-3">
                                                            <label for="cart_company" class="w-100 float-start control-label"><?php echo $cart_instruction->decline_notes; ?></label>
                                                            <div class="col-lg-12">
                                                                <?php
                                                                echo $term_last_request['decline_notes'];

                                                                ?> </div>
                                                        </div>
                                                    <?php } else if ($term_last_request['status'] == "0") { ?>



                                                        <div class="form-group float-start w-100 mb-3">
                                                            <label for="cart_company" class="w-100 float-start control-label"><?php echo $cart_instruction->term_status; ?></label>
                                                            <div class="col-lg-12">
                                                                <?php
                                                                if ($term_last_request['status'] == "0") {
                                                                    echo $admin_static_links['pending_text'];
                                                                }
                                                                ?> </div>
                                                        </div>


                                                        <div class="form-group float-start w-100 mb-3">
                                                            <label for="cart_company" class="w-100 float-start control-label"><?php echo $cart_instruction->term_request_date; ?></label>
                                                            <div class="col-lg-12">
                                                                <?php
                                                                echo $term_last_request['request_date'];
                                                                ?> </div>
                                                        </div>

                                                        <div class="form-group float-start w-100 mb-3">
                                                            <label for="cart_company" class="w-100 float-start control-label"><?php echo $cart_instruction->term_request_file; ?></label>
                                                            <div class="col-lg-12">
                                                                <a href="<?php echo base_url() . '/assets/uploads/cart/' . $term_last_request['request_file']; ?>" download class="btn  actn-btn rounded" id="signup_footer"><?php echo $cart_instruction->download_file; ?></a>
                                                            </div>
                                                        </div>
                                                    <?php } else { ?>

                                                        <div class="form-group float-start w-100 mb-3">
                                                            <label for="cart_company" class="w-100 float-start control-label"><?php echo $api_instruction->apply_credit_term; ?></label>
                                                            <div class="col-lg-12">
                                                            </div>
                                                        </div>

                                                        <div class="form-group float-start w-100 mb-3">
                                                            <label for="cart_company" class="w-100 float-start control-label"></label>
                                                            <div class="col-lg-12">
                                                            </div>
                                                        </div>


                                                        <div class="form-group float-start w-100 mb-3">
                                                            <label for="cart_company" class="w-100 float-start control-label"><?php echo $api_instruction->creditterm_blank_file; ?></label>
                                                            <div class="col-lg-12">
                                                                <a href="<?php echo base_url() . '/assets/uploads/cart/'.$this->config->item('creditterm_blank_file'); ?>" download class="btn  actn-btn rounded"><?php echo $cart_instruction->download_file; ?></a>
                                                            </div>
                                                        </div>


                                                        <div class="form-group float-start w-100 mb-3">
                                                            <label for="cart_company" class="w-100 float-start control-label"><?php echo $cart_instruction->credit_file; ?></label>
                                                            <div class="col-lg-12">
                                                                <span class="customFileInput position-relative d-inline-block overflow-hidden">
                                                                    <span class="btn actn-btn rounded inputfilebtn"><?php echo $cart_instruction->choose_file; ?></span>
                                                                    <input id="credit_term_file" name="credit_term_file" class="focustip span12 inputfile" type="file">
                                                                </span>

                                                            </div>
                                                            <p class="help-block blink_error"></p>
                                                        </div>


                                                        <div class="form-group float-start w-100 mb-3">
                                                            <label for="cart_company" class="w-100 float-start control-label"></label>
                                                            <div class="col-lg-12">
                                                                <a href="javascript:void(0)" class="btn  actn-btn rounded" id="creditterm_submit"><?php echo $general_instruction->sbmt; ?></a>


                                                            </div>
                                                        </div>


                                                    <?php } ?>
                                                </div>

                                            </div>


                                        </div>

                                        <div class="col-md-12 brand_complete_info">

                                            <div class="table-responsive  float-start w-100" id="not_empty_cart">
                                                <input type="hidden" value="1" name="update" class="width50px">
                                                <table id="kgtcartactive" class="table table-bordered my-table productsbytype">
                                                    <?php
                                                    $i = 1;
                                                    $currentproducttype_id = '';
                                                    $currentproducttype = '';
                                                    $count = 0;

                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div id="empty_cart" class="out-box-modal displaynon float-start w-100">
                                                <div class="box-content-modal">
                                                    <h2 class="title-modal big"><?php echo $cart_instruction->empty_cart; ?></h2>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- <?php if (!empty($cart_details)) { ?>
                                    <div class="nav-prex-next text-right removebuttons" id="cart_buttons">
                                        <a href="<?php echo base_url() . $lang_id . '/products/product_list'; ?>" class="btn  actn-btn rounded" id="cart_back"><?php echo $general_instruction->back; ?></a>
                                        <a href="<?php echo base_url() . $lang_id . '/products'; ?>" class="btn  actn-btn rounded" id="cart_continue_shopping_header"><?php echo $general_instruction->continue_and_submit; ?></a>
                                        <a href="javascript:void(0)" class="btn  actn-btn rounded" id="cart_checkout"><?php echo $general_instruction->sbmt; ?></a>
                                    </div>
                                <?php } ?> -->
                            </div>
                            <!--End content-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>

<!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 s_button sticky_bottom productBtnsFixedBottom py-2 py-md-3 px-3 px-md-5" style="display: none;">
    <div class="nav-prex-next sticky_button_next d-flex flex-wrap align-items-center justify-content-between w-100" id="cart_buttons">
        <div class="productActionBtns d-flex align-items-center w-100 justify-content-end">
            <a href="javascript:void(0)" class="btn  actn-btn rounded" id="signup_footer"><?php echo $general_instruction->sbmt; ?></a>
        </div>
    </div>
</div> -->

<span class="displaynon" id="maincart_block_msg"><?php if (isset($selection_instruction->maincart_block_msg)) echo $selection_instruction->maincart_block_msg; ?></span>
<span class="displaynon" id="editcart_block_msg"><?php if (isset($selection_instruction->editcart_block_msg)) echo $selection_instruction->editcart_block_msg; ?></span>
<span class="displaynon" id="cartpreview_block_msg"><?php if (isset($selection_instruction->cartpreview_block_msg)) echo $selection_instruction->cartpreview_block_msg; ?></span>
<span class="displaynon" id="cartverification_block_msg"><?php if (isset($selection_instruction->cartverification_block_msg)) echo $selection_instruction->cartverification_block_msg; ?></span>
<span class="displaynon" id="cartverification_resent_block_msg"><?php if (isset($selection_instruction->cartverification_resent_block_msg)) echo $selection_instruction->cartverification_resent_block_msg; ?></span>
<span class="displaynon" id="cartverification_wrong_block_msg"><?php if (isset($selection_instruction->cartverification_wrong_block_msg)) echo $selection_instruction->cartverification_wrong_block_msg; ?></span>
<span class="displaynon" id="block_notification_msg"><?php if (isset($selection_instruction->block_notification_msg)) echo $selection_instruction->block_notification_msg; ?></span>
<span class="displaynon" id="cartverification_resent_block_msg_sms"><?php if (isset($selection_instruction->cartverification_resent_block_msg_sms)) echo $selection_instruction->cartverification_resent_block_msg_sms; ?></span>
<span class="displaynon" id="cartverification_wrong_block_msg_sms"><?php if (isset($selection_instruction->cartverification_wrong_block_msg_sms)) echo $selection_instruction->cartverification_wrong_block_msg_sms; ?></span>
<span class="displaynon" id="block_notification_msg_sms"><?php if (isset($selection_instruction->block_notification_msg_sms)) echo $selection_instruction->block_notification_msg_sms; ?></span>
<span class="displaynon" id="cartverification_wrong_block_msg_email_sms"><?php if (isset($selection_instruction->cartverification_wrong_block_msg_email_sms)) echo $selection_instruction->cartverification_wrong_block_msg_email_sms; ?></span>
<span class="displaynon" id="block_notification_msg_email_sms"><?php if (isset($selection_instruction->block_notification_msg_email_sms)) echo $selection_instruction->block_notification_msg_email_sms; ?></span>
<span class="displaynon" id="cartverification_resent_block_msg_email_sms"><?php if (isset($selection_instruction->cartverification_resent_block_msg_email_sms)) echo $selection_instruction->cartverification_resent_block_msg_email_sms; ?></span>
<span class="displaynon" id="please_wait"><?php if (isset($general_instruction->please_wait)) echo $general_instruction->please_wait; ?></span>
<span class="displaynon" id="formvalidation_salutation"><?php if (isset($form_validation_instruction->invalid_title)) echo $form_validation_instruction->invalid_title; ?></span>
<span class="displaynon" id="formvalidation_title"><?php if (isset($form_validation_instruction->invalid_title)) echo $form_validation_instruction->invalid_title; ?></span>
<span class="displaynon" id="formvalidation_surname"><?php if (isset($form_validation_instruction->name)) echo $form_validation_instruction->name; ?></span>
<span class="displaynon" id="formvalidation_billingShippingoptradio"><?php if (isset($form_validation_instruction->billing_shipping_details)) echo $form_validation_instruction->billing_shipping_details; ?></span>
<span class="displaynon" id="formvalidation_company"><?php if (isset($form_validation_instruction->company)) echo $form_validation_instruction->company; ?></span>
<span class="displaynon" id="formvalidation_cart_address_1"><?php if (isset($form_validation_instruction->address_1)) echo $form_validation_instruction->address_1; ?></span>
<span class="displaynon" id="formvalidation_cart_address_2"><?php if (isset($form_validation_instruction->address_2)) echo $form_validation_instruction->address_2; ?></span>
<span class="displaynon" id="formvalidation_cart_address_3"><?php if (isset($form_validation_instruction->address_3)) echo $form_validation_instruction->address_3; ?></span>
<span class="displaynon" id="formvalidation_designation"><?php if (isset($form_validation_instruction->designation)) echo $form_validation_instruction->designation; ?></span>
<span class="displaynon" id="formvalidation_country"><?php if (isset($form_validation_instruction->country)) echo $form_validation_instruction->country; ?></span>
<span class="displaynon" id="formvalidation_telephone"><?php if (isset($form_validation_instruction->telephone)) echo $form_validation_instruction->telephone; ?></span>
<span class="displaynon" id="formvalidation_telephone_numeric"><?php if (isset($form_validation_instruction->telephone_numeric)) echo $form_validation_instruction->telephone_numeric; ?></span>
<span class="displaynon" id="formvalidation_valid_email"><?php if (isset($form_validation_instruction->email)) echo $form_validation_instruction->email; ?></span>
<span class="displaynon" id="formvalidation_email"><?php if (isset($form_validation_instruction->valid_email)) echo $form_validation_instruction->valid_email; ?></span>
<span class="displaynon" id="formvalidation_deadline"><?php if (isset($form_validation_instruction->deadline)) echo $form_validation_instruction->deadline; ?></span>
<span class="displaynon" id="formvalidation_deadline_future"><?php if (isset($form_validation_instruction->deadline_future)) echo $form_validation_instruction->deadline_future; ?></span>
<span class="displaynon" id="formvalidation_incoterms"><?php if (isset($form_validation_instruction->incoterms)) echo $form_validation_instruction->incoterms; ?></span>
<span class="displaynon" id="email_and_sms_blank"><?php if (isset($form_validation_instruction->email_and_sms_blank)) echo $form_validation_instruction->email_and_sms_blank; ?></span>
<span class="displaynon" id="email_blank"><?php if (isset($form_validation_instruction->email_blank)) echo $form_validation_instruction->email_blank; ?></span>
<span class="displaynon" id="sms_blank"><?php if (isset($form_validation_instruction->sms_blank)) echo $form_validation_instruction->sms_blank; ?></span>
<span class="displaynon" id="resend_email_attempt"><?php if (isset($form_validation_instruction->resend_email_attempt)) echo $form_validation_instruction->resend_email_attempt; ?></span>
<span class="displaynon" id="resend_sms_attempt"><?php if (isset($form_validation_instruction->resend_sms_attempt)) echo $form_validation_instruction->resend_sms_attempt; ?></span>
<span class="displaynon" id="wrong_email_code_attempt"><?php if (isset($form_validation_instruction->wrong_email_code_attempt)) echo $form_validation_instruction->wrong_email_code_attempt; ?></span>
<span class="displaynon" id="wrong_sms_code_attempt"><?php if (isset($form_validation_instruction->wrong_sms_code_attempt)) echo $form_validation_instruction->wrong_sms_code_attempt; ?></span>
<span class="displaynon" id="wrong_email_sms_code_attempt"><?php if (isset($form_validation_instruction->wrong_email_sms_code_attempt)) echo $form_validation_instruction->wrong_email_sms_code_attempt; ?></span>
<span class="displaynon" id="invalid_phone_not_email"><?php if (isset($form_validation_instruction->invalid_phone_not_email)) echo $form_validation_instruction->invalid_phone_not_email; ?></span>
<span class="displaynon" id="invalid_email_not_phone"><?php if (isset($form_validation_instruction->invalid_email_not_phone)) echo $form_validation_instruction->invalid_email_not_phone; ?></span>
<span class="displaynon" id="invalid_email_and_sms"><?php if (isset($form_validation_instruction->invalid_email_and_sms)) echo $form_validation_instruction->invalid_email_and_sms; ?></span>
<span class="displaynon" id="formvalidation_cart_city"><?php if (isset($form_validation_instruction->city)) echo $form_validation_instruction->city; ?></span>
<span class="displaynon" id="formvalidation_cart_state"><?php if (isset($form_validation_instruction->state)) echo $form_validation_instruction->state; ?></span>
<span class="displaynon" id="formvalidation_cart_zip"><?php if (isset($form_validation_instruction->postal_code)) echo $form_validation_instruction->postal_code; ?></span>
<span class="displaynon" id="formvalidation_ship_zip"><?php if (isset($form_validation_instruction->ship_postal_code)) echo $form_validation_instruction->ship_postal_code; ?></span>
<span class="displaynon" id="formvalidation_ship_title"><?php if (isset($form_validation_instruction->ship_title)) echo $form_validation_instruction->ship_title; ?></span>
<span class="displaynon" id="formvalidation_ship_surname"><?php if (isset($form_validation_instruction->ship_fullname)) echo $form_validation_instruction->ship_fullname; ?></span>
<span class="displaynon" id="formvalidation_ship_company"><?php if (isset($form_validation_instruction->ship_company)) echo $form_validation_instruction->ship_company; ?></span>
<span class="displaynon" id="formvalidation_ship_designation"><?php if (isset($form_validation_instruction->ship_designation)) echo $form_validation_instruction->ship_designation; ?></span>
<span class="displaynon" id="formvalidation_ship_email"><?php if (isset($form_validation_instruction->ship_email)) echo $form_validation_instruction->ship_email; ?></span>
<span class="displaynon" id="formvalidation_ship_country"><?php if (isset($form_validation_instruction->ship_country)) echo $form_validation_instruction->ship_country; ?></span>
<span class="displaynon" id="formvalidation_ship_telephone"><?php if (isset($form_validation_instruction->ship_cellphone)) echo $form_validation_instruction->ship_cellphone; ?></span>
<span class="displaynon" id="formvalidation_ship_address_1"><?php if (isset($form_validation_instruction->ship_address_1)) echo $form_validation_instruction->ship_address_1; ?></span>
<span class="displaynon" id="formvalidation_ship_address_2"><?php if (isset($form_validation_instruction->ship_address_2)) echo $form_validation_instruction->ship_address_2; ?></span>
<span class="displaynon" id="formvalidation_ship_address_3"><?php if (isset($form_validation_instruction->ship_address_3)) echo $form_validation_instruction->ship_address_3; ?></span>
<span class="displaynon" id="formvalidation_ship_city"><?php if (isset($form_validation_instruction->ship_city)) echo $form_validation_instruction->ship_city; ?></span>
<span class="displaynon" id="formvalidation_ship_state"><?php if (isset($form_validation_instruction->ship_state)) echo $form_validation_instruction->ship_state; ?></span>
<span class="displaynon" id="formvalidation_client_logo"><?php if (isset($form_validation_instruction->client_logo)) echo $form_validation_instruction->client_logo; ?></span>
<span class="displaynon" id="formvalidation_tax_exoneration_file"><?php if (isset($form_validation_instruction->tax_exoneration_file)) echo $form_validation_instruction->tax_exoneration_file; ?></span>
<span class="displaynon" id="formvalidation_tax_exoneration_file_size"><?php if (isset($form_validation_instruction->tax_exoneration_file_size)) echo $form_validation_instruction->tax_exoneration_file_size; ?></span>
<span class="displaynon" id="formvalidation_email_exist"><?php if (isset($form_validation_instruction->email_exist)) echo $form_validation_instruction->email_exist; ?></span>
<span class="displaynon" id="formvalidation_mobile_number_exist"><?php if (isset($form_validation_instruction->mobile_number_exist)) echo $form_validation_instruction->mobile_number_exist; ?></span>
<span class="displaynon" id="formvalidation_tax_exoneration_number"><?php if (isset($cart_instruction->tax_exoneration_error)) echo $cart_instruction->tax_exoneration_error; ?></span>
<span class="displaynon" id="formvalidation_tax_exoneration_number_numeric"><?php if (isset($cart_instruction->tax_exoneration_error)) echo $cart_instruction->tax_exoneration_error; ?></span>
<span class="displaynon" id="formvalidation_tax_exoneration"><?php if (isset($cart_instruction->tax_exoneration_code_error)) echo $cart_instruction->tax_exoneration_code_error; ?></span>
<span class="displaynon" id="invalid_captcha"><?php if (isset($cart_instruction->invalid_captcha)) echo $cart_instruction->invalid_captcha; ?></span>
<span class="displaynon" id="fd_verification_resent_block_msg"><?php if (isset($entry_door_message['fd_verification_resent_block_msg'])) echo $entry_door_message['fd_verification_resent_block_msg']; ?></span>
<span class="displaynon" id="fd_verification_resent_block_msg_sms"><?php if (isset($entry_door_message['fd_verification_resent_block_msg_sms'])) echo $entry_door_message['fd_verification_resent_block_msg_sms']; ?></span>
<span class="displaynon" id="fd_verification_resent_block_msg_email_sms"><?php if (isset($entry_door_message['fd_verification_resent_block_msg_email_sms'])) echo $entry_door_message['fd_verification_resent_block_msg_email_sms']; ?></span>
<span class="displaynon" id="fd_verification_wrong_block_msg"><?php if (isset($entry_door_message['fd_verification_wrong_block_msg'])) echo $entry_door_message['fd_verification_wrong_block_msg']; ?></span>
<span class="displaynon" id="fd_verification_wrong_block_msg_sms"><?php if (isset($entry_door_message['fd_verification_wrong_block_msg_sms'])) echo $entry_door_message['fd_verification_wrong_block_msg_sms']; ?></span>
<span class="displaynon" id="fd_verification_wrong_block_msg_email_sms"><?php if (isset($entry_door_message['fd_verification_wrong_block_msg_email_sms'])) echo $entry_door_message['fd_verification_wrong_block_msg_email_sms']; ?></span>
<span class="displaynon" id="fd_block_notification_msg"><?php if (isset($entry_door_message['fd_block_notification_msg'])) echo $entry_door_message['fd_block_notification_msg']; ?></span>
<span class="displaynon" id="fd_block_notification_msg_sms"><?php if (isset($entry_door_message['fd_block_notification_msg_sms'])) echo $entry_door_message['fd_block_notification_msg_sms']; ?></span>
<span class="displaynon" id="fd_block_notification_msg_email_sms"><?php if (isset($entry_door_message['fd_block_notification_msg_email_sms'])) echo $entry_door_message['fd_block_notification_msg_email_sms']; ?></span>
<span class="displaynon" id="please_wait"><?php if (isset($general_instruction->please_wait)) echo $general_instruction->please_wait; ?></span>
<span class="displaynon" id="hours"><?php if (isset($general_instruction->hours)) echo $general_instruction->hours; ?></span>
<span class="displaynon" id="minutes"><?php if (isset($general_instruction->minutes)) echo $general_instruction->minutes; ?></span>
<span class="displaynon" id="seconds"><?php if (isset($general_instruction->please_wait)) echo $general_instruction->seconds; ?></span>
<span class="displaynon" id="formvalidation_title"><?php if (isset($form_validation_instruction->popup_title)) echo $form_validation_instruction->popup_title; ?></span>
<span class="displaynon" id="formvalidation_name"><?php if (isset($form_validation_instruction->name)) echo $form_validation_instruction->name; ?></span>
<span class="displaynon" id="formvalidation_company"><?php if (isset($form_validation_instruction->company)) echo $form_validation_instruction->company; ?></span>
<span class="displaynon" id="formvalidation_address"><?php if (isset($form_validation_instruction->address)) echo $form_validation_instruction->address; ?></span>
<span class="displaynon" id="formvalidation_designation"><?php if (isset($form_validation_instruction->designation)) echo $form_validation_instruction->designation; ?></span>
<span class="displaynon" id="formvalidation_country"><?php if (isset($form_validation_instruction->country)) echo $form_validation_instruction->country; ?></span>
<span class="displaynon" id="formvalidation_telephone"><?php if (isset($form_validation_instruction->telephone)) echo $form_validation_instruction->telephone; ?></span>
<span class="displaynon" id="formvalidation_telephone_numeric"><?php if (isset($form_validation_instruction->telephone_numeric)) echo $form_validation_instruction->telephone_numeric; ?></span>
<span class="displaynon" id="formvalidation_email"><?php if (isset($form_validation_instruction->email)) echo $form_validation_instruction->email; ?></span>
<span class="displaynon" id="formvalidation_valid_email"><?php if (isset($form_validation_instruction->valid_email)) echo $form_validation_instruction->valid_email; ?></span>
<span class="displaynon" id="formvalidation_deadline"><?php if (isset($form_validation_instruction->deadline)) echo $form_validation_instruction->deadline; ?></span>
<span class="displaynon" id="formvalidation_deadline_future"><?php if (isset($form_validation_instruction->deadline_future)) echo $form_validation_instruction->deadline_future; ?></span>
<span class="displaynon" id="formvalidation_incoterms"><?php if (isset($form_validation_instruction->incoterms)) echo $form_validation_instruction->incoterms; ?></span>
<span class="displaynon" id="email_and_sms_blank"><?php if (isset($form_validation_instruction->email_and_sms_blank)) echo $form_validation_instruction->email_and_sms_blank; ?></span>
<span class="displaynon" id="email_blank"><?php if (isset($form_validation_instruction->email_blank)) echo $form_validation_instruction->email_blank; ?></span>
<span class="displaynon" id="sms_blank"><?php if (isset($form_validation_instruction->sms_blank)) echo $form_validation_instruction->sms_blank; ?></span>
<span class="displaynon" id="resend_email_attempt"><?php if (isset($form_validation_instruction->resend_email_attempt)) echo $form_validation_instruction->resend_email_attempt; ?></span>
<span class="displaynon" id="resend_sms_attempt"><?php if (isset($form_validation_instruction->resend_sms_attempt)) echo $form_validation_instruction->resend_sms_attempt; ?></span>
<span class="displaynon" id="wrong_email_code_attempt"><?php if (isset($form_validation_instruction->wrong_email_code_attempt)) echo $form_validation_instruction->wrong_email_code_attempt; ?></span>
<span class="displaynon" id="wrong_sms_code_attempt"><?php if (isset($form_validation_instruction->wrong_sms_code_attempt)) echo $form_validation_instruction->wrong_sms_code_attempt; ?></span>
<span class="displaynon" id="wrong_email_sms_code_attempt"><?php if (isset($form_validation_instruction->wrong_email_sms_code_attempt)) echo $form_validation_instruction->wrong_email_sms_code_attempt; ?></span>
<span class="displaynon" id="invalid_phone_not_email"><?php if (isset($form_validation_instruction->invalid_phone_not_email)) echo $form_validation_instruction->invalid_phone_not_email; ?></span>
<span class="displaynon" id="invalid_email_not_phone"><?php if (isset($form_validation_instruction->invalid_email_not_phone)) echo $form_validation_instruction->invalid_email_not_phone; ?></span>
<span class="displaynon" id="invalid_email_and_sms"><?php if (isset($form_validation_instruction->invalid_email_and_sms)) echo $form_validation_instruction->invalid_email_and_sms; ?></span>
<span class="displaynon" id="verification_code_to_email"><?php if (isset($cart_instruction->verification_code_to_email)) echo $cart_instruction->verification_code_to_email; ?></span>
<span class="displaynon" id="verification_code_to_sms"><?php if (isset($cart_instruction->verification_code_to_sms)) echo $cart_instruction->verification_code_to_sms; ?></span>
<span class="displaynon" id="verification_code_to_email_and_sms"><?php if (isset($cart_instruction->verification_code_to_email_and_sms)) echo $cart_instruction->verification_code_to_email_and_sms; ?></span>
<span class="displaynon" id="email_verified_sms_not"><?php if (isset($cart_instruction->email_verified_sms_not)) echo $cart_instruction->email_verified_sms_not; ?></span>
<span class="displaynon" id="sms_verified_email_not"><?php if (isset($cart_instruction->sms_verified_email_not)) echo $cart_instruction->sms_verified_email_not; ?></span>
<span class="displaynon" id="email_and_sms_not_verified"><?php if (isset($cart_instruction->email_and_sms_not_verified)) echo $cart_instruction->email_and_sms_not_verified; ?></span>
<span class="displaynon" id="formvalidation_carrier_name"><?php if (isset($form_validation_instruction->carrier_name)) echo $form_validation_instruction->carrier_name; ?></span>
<span class="displaynon" id="formvalidation_carrier_account_number"><?php if (isset($form_validation_instruction->carrier_account_number)) echo $form_validation_instruction->carrier_account_number; ?></span>
<span class="displaynon" id="formvalidation_credit_term_file"><?php if (isset($form_validation_instruction->credit_term_file)) echo $form_validation_instruction->credit_term_file; ?></span>



<!--Modal user block popup start-->
<?php $this->load->view('elements/popup/user_block_box'); ?>
<!--Modal user block popup end-->

<!--Modal user cart shopping session timeout block popup start-->
<?php $this->load->view('elements/popup/user_shopping_timeout_popup'); ?>
<!--Modal user cart shopping session timeout block popup end-->

<?php $this->load->view('elements/popup/notify_submit_popup');
$this->load->view('elements/popup/modal_success_popup');
$this->load->view('elements/popup/invalid_phone_popup');
$this->load->view('elements/popup/invalid_email_popup');
$this->load->view('elements/popup/invalid_email_phone_popup');
?>


<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">
<input type="hidden" id="cud_cart_state" value="<?php echo isset($loginuserdata['cart_state']) ? $loginuserdata['cart_state'] : ""; ?>">
<input type="hidden" id="cud_ship_state" value="<?php echo isset($loginuserdata['ship_state']) ? $loginuserdata['ship_state'] : ""; ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">

<?php $this->load->view('elements/flash_messages'); ?>