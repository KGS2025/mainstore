<?php $comingsoon = getNoImage('coming-soon');?>

<div class="mainContent px-3 px-lg-5">
    <?php $this->load->view('elements/body_logo');?>

    <?php $this->load->view('elements/flash_messages');?>

    <form class="form-horizontal" role="form" id="signup_form" method="POST" enctype="multipart/form-data">
        <div class="mb-4 container">
            <div class="car-lists productlisting productbaselisting float-start w-100 bg-white my-3 my-md-5 p-3 p-md-5 rounded">
                <h4 class="cart-user-form"><?php echo $admin_static_links['Signup']; ?>/<?php echo $admin_static_links['register']; ?></h4>
                <p class="mb-5"><?php echo $cart_instruction->fill_in_cart_details; ?></p>
                <div class="form-fill-cart float-start w-100 mb-0">
                    <div class="cart-form-grid float-start w-100">
                        <div class="col-lg-12 float-start w-100" id="hide_billing_details">
                            <div class="formGrid d-grid grid-col-3 gap-3 mb-0">
                                <div class="form-group float-start w-100 mb-3">
                                    <label for="salutation" class="col-sm-12 control-label"><?php echo $cart_instruction->title; ?>
                                        <span class="cart_asterisk">*</span>
                                    </label>
                                    <div class="col-lg-12">
                                        <span class="position-relative">
                                            <input id="radio11" type="radio" class="required_input" name="salutation" value="Mr." />
                                            <label class="text-dark" for="radio11"><?php echo $cart_instruction->mr_title; ?></label>
                                        </span>
                                        <span class="position-relative">
                                            <input id="radio12" type="radio" class="required_input" name="salutation" value="Miss." />
                                            <label class="text-dark" for="radio12"><?php echo $cart_instruction->ms_title; ?></label>
                                        </span>
                                        <span class="position-relative">
                                            <input id="radio13" type="radio" class="required_input" name="salutation" value="Other" />
                                            <label class="text-dark" for="radio13"><?php echo $cart_instruction->other_title; ?></label>
                                        </span>
                                    </div>
                                    <p class="help-block blink_error"></p>
                                </div>
                                <div class="form-group float-start w-100 mb-3">
                                    <label for="cart_company" class="w-100 float-start control-label"><?php echo $cart_instruction->company; ?></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" id="cart_company" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->company); ?>" name="company" value="">
                                    </div>
                                </div>

                                <div class="form-group float-start w-100">
                                    <label for="cart_surname" class="col-sm-12 left control-label"><?php echo $cart_instruction->name_surname; ?>
                                        <span class="cart_asterisk">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control required_input" id="cart_surname" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->name_surname); ?>" name="surname" value="" required>
                                    </div>
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group float-start w-100">
                                    <label for="cart_email" class="col-sm-12 control-label"><?php echo $cart_instruction->email; ?>
                                        <span class="cart_asterisk">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control required_input email_validate" id="cart_email" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->email); ?>" name="email" value="" required>
                                    </div>
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group float-start w-100">
                                    <label for="cart_country" class="col-sm-12 control-label"><?php echo $cart_instruction->country; ?>
                                        <span class="cart_asterisk">*</span></label>
                                    <div class="col-lg-12 position-relative" id="popupboxcountrywrap">
                                        <select autocomplete="no-fill" name="country" id="cart_country" class="form-control selectpicker1 kgt2 required_input">
                                            <?php foreach ($countries as $country) {?>
                                                <option value='<?php echo htmlentities($country['countryName'], ENT_QUOTES); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" <?php if (isset($ip_data['countryCode']) && strtoupper($country['alpha_2']) == $ip_data['countryCode']) {?> selected="selected" <?php } else if (isset($country['countryName']) && $country['countryName'] == "Canada") {?> selected="selected" <?php } else if ($country['lang_countryName'] == "Canada") {?>selected="selected" <?php }?>>
                                                    <?php echo $country['countryName']; ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <p class="help-block"></p>
                                </div>

                                <input type="hidden" name="cart_country_flag" id="cart_country_flag" value="<?=isset($cart_users_data['ship_country_shortcode']) ? $cart_users_data['ship_country_shortcode'] : 'ca';?>" />
                                <div class="form-group float-start w-100">
                                    <label for="cart_telephone" class="col-sm-12 control-label"><?php echo $cart_instruction->cellphone; ?>
                                        <span class="cart_asterisk">*</span>
                                    </label>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-3 col-lg-3 country_code_div">
                                            <input type="text" class="form-control required_input numeric_input" id="cart_country_code" placeholder="+1" name="country_code" value="+1" required autocomplete="no-fill" readonly>
                                        </div>
                                        <div class="col-xs-12 col-sm-9 col-lg-9">
                                            <input type="text" class="form-control required_input" id="cart_telephone" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->cellphone); ?>" name="telephone" value="" required onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group float-start w-100">
                                    <label for="address_1" class="col-sm-12 control-label"><?php echo $cart_instruction->address_1; ?>
                                        <span class="cart_asterisk">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control required_input" id="cart_address_1" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->address_1); ?>" name="cart_address_1" value="">
                                    </div>
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group float-start w-100">
                                    <label for="cart_city" class="col-sm-12 control-label"><?php echo $cart_instruction->city; ?><span class="cart_asterisk">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control required_input" id="cart_city" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->city); ?>" name="cart_city" value="" required>
                                    </div>
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group float-start w-100">
                                    <label for="cart_state" class="col-sm-12 control-label"><?php echo $cart_instruction->state; ?>
                                        <span class="cart_asterisk">*</span></label>
                                    <div class="col-lg-12" id="cart-state">
                                        <select name="cart_state" id="cart-state-list" class="form-control kgt2 rounded required_input">
                                        </select>
                                        <input type="hidden" name="cud_cart_state" id="cud_cart_state" value="<?php echo isset($ip_data['regionCode']) ? $ip_data['regionCode'] : ''; ?>">

                                    </div>
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group float-start w-100 mb-0">
                                    <label for="cart_zip" class="col-sm-12 control-label"><?php echo $cart_instruction->zip; ?><span class="cart_asterisk">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control required_input" id="cart_zip" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->zip); ?>" name="cart_zip" value="" required>
                                    </div>
                                    <p class="help-block"></p>
                                </div>

                                


                               


                          <?php if ($this->config->item('show_products_input') == "1") {?>
                                <!----     -->
                                <div class="form-group float-start w-100 mb-0">
                                    <label for="cart_zip" class="col-sm-12 control-label"><?php echo $cart_instruction->signup_category; ?><span class="cart_asterisk">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control required_input" id="signup_category" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_category); ?>" name="signup_category" value="" required>
                                    </div>
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group float-start w-100 mb-0">
                                    <label for="cart_zip" class="col-sm-12 control-label"><?php echo $cart_instruction->signup_maker; ?><span class="cart_asterisk">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control required_input" id="signup_maker" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_maker); ?>" name="signup_maker" value="" required>
                                    </div>
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group float-start w-100 mb-0">
                                    <label for="cart_zip" class="col-sm-12 control-label"><?php echo $cart_instruction->signup_model; ?><span class="cart_asterisk">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control required_input" id="signup_model" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_model); ?>" name="signup_model" value="" required>
                                    </div>
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group float-start w-100 mb-0">
                                    <label for="cart_zip" class="col-sm-12 control-label"><?php echo $cart_instruction->signup_group; ?><span class="cart_asterisk">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control required_input" id="signup_group" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_group); ?>" name="signup_group" value="" required>
                                    </div>
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group float-start w-100 mb-0">
                                    <label for="cart_zip" class="col-sm-12 control-label"><?php echo $cart_instruction->signup_year; ?><span class="cart_asterisk">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control required_input" id="signup_year" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_year); ?>" name="signup_year" value="" required>
                                    </div>
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group float-start w-100 mb-0">
                                    <label for="cart_zip" class="col-sm-12 control-label"><?php echo $cart_instruction->signup_engine; ?><span class="cart_asterisk">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control required_input" id="signup_engine" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_engine); ?>" name="signup_engine" value="" required>
                                    </div>
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group float-start w-100 mb-0">
                                    <label for="cart_zip" class="col-sm-12 control-label"><?php echo $cart_instruction->signup_vn; ?><span class="cart_asterisk">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control required_input" id="signup_vn" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_vn); ?>" name="signup_vn" value="" required>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <!----    -->
                                <?php }?>

                                
                            </div>
                            <div class="form-group float-start w-100 mb-0">
                                    <label for="cart_zip" class="col-sm-12 control-label"></label>
                                    <div class="col-lg-12">
                                    <a href="javascript:void(0)" class="btn  actn-btn rounded" id="signup_footer"><?php echo $general_instruction->sbmt; ?></a>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="nav-prex-next text-right removebuttons" id="cart_buttons">
                    <a href="javascript:void(0)" class="btn actn-btn rounded" id="signup_page"><?php echo $general_instruction->sbmt; ?></a>
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

<span class="displaynon" id="maincart_block_msg"><?php if (isset($selection_instruction->maincart_block_msg)) {
    echo $selection_instruction->maincart_block_msg;
}
?></span>
<span class="displaynon" id="editcart_block_msg"><?php if (isset($selection_instruction->editcart_block_msg)) {
    echo $selection_instruction->editcart_block_msg;
}
?></span>
<span class="displaynon" id="cartpreview_block_msg"><?php if (isset($selection_instruction->cartpreview_block_msg)) {
    echo $selection_instruction->cartpreview_block_msg;
}
?></span>
<span class="displaynon" id="cartverification_block_msg"><?php if (isset($selection_instruction->cartverification_block_msg)) {
    echo $selection_instruction->cartverification_block_msg;
}
?></span>
<span class="displaynon" id="cartverification_resent_block_msg"><?php if (isset($selection_instruction->cartverification_resent_block_msg)) {
    echo $selection_instruction->cartverification_resent_block_msg;
}
?></span>
<span class="displaynon" id="cartverification_wrong_block_msg"><?php if (isset($selection_instruction->cartverification_wrong_block_msg)) {
    echo $selection_instruction->cartverification_wrong_block_msg;
}
?></span>
<span class="displaynon" id="block_notification_msg"><?php if (isset($selection_instruction->block_notification_msg)) {
    echo $selection_instruction->block_notification_msg;
}
?></span>
<span class="displaynon" id="cartverification_resent_block_msg_sms"><?php if (isset($selection_instruction->cartverification_resent_block_msg_sms)) {
    echo $selection_instruction->cartverification_resent_block_msg_sms;
}
?></span>
<span class="displaynon" id="cartverification_wrong_block_msg_sms"><?php if (isset($selection_instruction->cartverification_wrong_block_msg_sms)) {
    echo $selection_instruction->cartverification_wrong_block_msg_sms;
}
?></span>
<span class="displaynon" id="block_notification_msg_sms"><?php if (isset($selection_instruction->block_notification_msg_sms)) {
    echo $selection_instruction->block_notification_msg_sms;
}
?></span>
<span class="displaynon" id="cartverification_wrong_block_msg_email_sms"><?php if (isset($selection_instruction->cartverification_wrong_block_msg_email_sms)) {
    echo $selection_instruction->cartverification_wrong_block_msg_email_sms;
}
?></span>
<span class="displaynon" id="block_notification_msg_email_sms"><?php if (isset($selection_instruction->block_notification_msg_email_sms)) {
    echo $selection_instruction->block_notification_msg_email_sms;
}
?></span>
<span class="displaynon" id="cartverification_resent_block_msg_email_sms"><?php if (isset($selection_instruction->cartverification_resent_block_msg_email_sms)) {
    echo $selection_instruction->cartverification_resent_block_msg_email_sms;
}
?></span>
<span class="displaynon" id="please_wait"><?php if (isset($general_instruction->please_wait)) {
    echo $general_instruction->please_wait;
}
?></span>
<span class="displaynon" id="formvalidation_salutation"><?php if (isset($form_validation_instruction->invalid_title)) {
    echo $form_validation_instruction->invalid_title;
}
?></span>
<span class="displaynon" id="formvalidation_title"><?php if (isset($form_validation_instruction->invalid_title)) {
    echo $form_validation_instruction->invalid_title;
}
?></span>
<span class="displaynon" id="formvalidation_surname"><?php if (isset($form_validation_instruction->name)) {
    echo $form_validation_instruction->name;
}
?></span>
<span class="displaynon" id="formvalidation_billingShippingoptradio"><?php if (isset($form_validation_instruction->billing_shipping_details)) {
    echo $form_validation_instruction->billing_shipping_details;
}
?></span>
<span class="displaynon" id="formvalidation_company"><?php if (isset($form_validation_instruction->company)) {
    echo $form_validation_instruction->company;
}
?></span>
<span class="displaynon" id="formvalidation_cart_address_1"><?php if (isset($form_validation_instruction->address_1)) {
    echo $form_validation_instruction->address_1;
}
?></span>
<span class="displaynon" id="formvalidation_cart_address_2"><?php if (isset($form_validation_instruction->address_2)) {
    echo $form_validation_instruction->address_2;
}
?></span>
<span class="displaynon" id="formvalidation_cart_address_3"><?php if (isset($form_validation_instruction->address_3)) {
    echo $form_validation_instruction->address_3;
}
?></span>
<span class="displaynon" id="formvalidation_designation"><?php if (isset($form_validation_instruction->designation)) {
    echo $form_validation_instruction->designation;
}
?></span>
<span class="displaynon" id="formvalidation_country"><?php if (isset($form_validation_instruction->country)) {
    echo $form_validation_instruction->country;
}
?></span>
<span class="displaynon" id="formvalidation_telephone"><?php if (isset($form_validation_instruction->telephone)) {
    echo $form_validation_instruction->telephone;
}
?></span>
<span class="displaynon" id="formvalidation_telephone_numeric"><?php if (isset($form_validation_instruction->telephone_numeric)) {
    echo $form_validation_instruction->telephone_numeric;
}
?></span>
<span class="displaynon" id="formvalidation_valid_email"><?php if (isset($form_validation_instruction->email)) {
    echo $form_validation_instruction->email;
}
?></span>
<span class="displaynon" id="formvalidation_email"><?php if (isset($form_validation_instruction->valid_email)) {
    echo $form_validation_instruction->valid_email;
}
?></span>
<span class="displaynon" id="formvalidation_deadline"><?php if (isset($form_validation_instruction->deadline)) {
    echo $form_validation_instruction->deadline;
}
?></span>
<span class="displaynon" id="formvalidation_deadline_future"><?php if (isset($form_validation_instruction->deadline_future)) {
    echo $form_validation_instruction->deadline_future;
}
?></span>
<span class="displaynon" id="formvalidation_incoterms"><?php if (isset($form_validation_instruction->incoterms)) {
    echo $form_validation_instruction->incoterms;
}
?></span>
<span class="displaynon" id="email_and_sms_blank"><?php if (isset($form_validation_instruction->email_and_sms_blank)) {
    echo $form_validation_instruction->email_and_sms_blank;
}
?></span>
<span class="displaynon" id="email_blank"><?php if (isset($form_validation_instruction->email_blank)) {
    echo $form_validation_instruction->email_blank;
}
?></span>
<span class="displaynon" id="sms_blank"><?php if (isset($form_validation_instruction->sms_blank)) {
    echo $form_validation_instruction->sms_blank;
}
?></span>
<span class="displaynon" id="resend_email_attempt"><?php if (isset($form_validation_instruction->resend_email_attempt)) {
    echo $form_validation_instruction->resend_email_attempt;
}
?></span>
<span class="displaynon" id="resend_sms_attempt"><?php if (isset($form_validation_instruction->resend_sms_attempt)) {
    echo $form_validation_instruction->resend_sms_attempt;
}
?></span>
<span class="displaynon" id="wrong_email_code_attempt"><?php if (isset($form_validation_instruction->wrong_email_code_attempt)) {
    echo $form_validation_instruction->wrong_email_code_attempt;
}
?></span>
<span class="displaynon" id="wrong_sms_code_attempt"><?php if (isset($form_validation_instruction->wrong_sms_code_attempt)) {
    echo $form_validation_instruction->wrong_sms_code_attempt;
}
?></span>
<span class="displaynon" id="wrong_email_sms_code_attempt"><?php if (isset($form_validation_instruction->wrong_email_sms_code_attempt)) {
    echo $form_validation_instruction->wrong_email_sms_code_attempt;
}
?></span>
<span class="displaynon" id="invalid_phone_not_email"><?php if (isset($form_validation_instruction->invalid_phone_not_email)) {
    echo $form_validation_instruction->invalid_phone_not_email;
}
?></span>
<span class="displaynon" id="invalid_email_not_phone"><?php if (isset($form_validation_instruction->invalid_email_not_phone)) {
    echo $form_validation_instruction->invalid_email_not_phone;
}
?></span>
<span class="displaynon" id="invalid_email_and_sms"><?php if (isset($form_validation_instruction->invalid_email_and_sms)) {
    echo $form_validation_instruction->invalid_email_and_sms;
}
?></span>
<span class="displaynon" id="formvalidation_cart_city"><?php if (isset($form_validation_instruction->city)) {
    echo $form_validation_instruction->city;
}
?></span>
<span class="displaynon" id="formvalidation_cart_state"><?php if (isset($form_validation_instruction->state)) {
    echo $form_validation_instruction->state;
}
?></span>
<span class="displaynon" id="formvalidation_cart_zip"><?php if (isset($form_validation_instruction->postal_code)) {
    echo $form_validation_instruction->postal_code;
}
?></span>
<span class="displaynon" id="formvalidation_ship_zip"><?php if (isset($form_validation_instruction->ship_postal_code)) {
    echo $form_validation_instruction->ship_postal_code;
}
?></span>
<span class="displaynon" id="formvalidation_ship_title"><?php if (isset($form_validation_instruction->ship_title)) {
    echo $form_validation_instruction->ship_title;
}
?></span>
<span class="displaynon" id="formvalidation_ship_surname"><?php if (isset($form_validation_instruction->ship_fullname)) {
    echo $form_validation_instruction->ship_fullname;
}
?></span>
<span class="displaynon" id="formvalidation_ship_company"><?php if (isset($form_validation_instruction->ship_company)) {
    echo $form_validation_instruction->ship_company;
}
?></span>
<span class="displaynon" id="formvalidation_ship_designation"><?php if (isset($form_validation_instruction->ship_designation)) {
    echo $form_validation_instruction->ship_designation;
}
?></span>
<span class="displaynon" id="formvalidation_ship_email"><?php if (isset($form_validation_instruction->ship_email)) {
    echo $form_validation_instruction->ship_email;
}
?></span>
<span class="displaynon" id="formvalidation_ship_country"><?php if (isset($form_validation_instruction->ship_country)) {
    echo $form_validation_instruction->ship_country;
}
?></span>
<span class="displaynon" id="formvalidation_ship_telephone"><?php if (isset($form_validation_instruction->ship_cellphone)) {
    echo $form_validation_instruction->ship_cellphone;
}
?></span>
<span class="displaynon" id="formvalidation_ship_address_1"><?php if (isset($form_validation_instruction->ship_address_1)) {
    echo $form_validation_instruction->ship_address_1;
}
?></span>
<span class="displaynon" id="formvalidation_ship_address_2"><?php if (isset($form_validation_instruction->ship_address_2)) {
    echo $form_validation_instruction->ship_address_2;
}
?></span>
<span class="displaynon" id="formvalidation_ship_address_3"><?php if (isset($form_validation_instruction->ship_address_3)) {
    echo $form_validation_instruction->ship_address_3;
}
?></span>
<span class="displaynon" id="formvalidation_ship_city"><?php if (isset($form_validation_instruction->ship_city)) {
    echo $form_validation_instruction->ship_city;
}
?></span>
<span class="displaynon" id="formvalidation_ship_state"><?php if (isset($form_validation_instruction->ship_state)) {
    echo $form_validation_instruction->ship_state;
}
?></span>
<span class="displaynon" id="formvalidation_client_logo"><?php if (isset($form_validation_instruction->client_logo)) {
    echo $form_validation_instruction->client_logo;
}
?></span>
<span class="displaynon" id="formvalidation_tax_exoneration_file"><?php if (isset($form_validation_instruction->tax_exoneration_file)) {
    echo $form_validation_instruction->tax_exoneration_file;
}
?></span>
<span class="displaynon" id="formvalidation_tax_exoneration_file_size"><?php if (isset($form_validation_instruction->tax_exoneration_file_size)) {
    echo $form_validation_instruction->tax_exoneration_file_size;
}
?></span>
<span class="displaynon" id="formvalidation_email_exist"><?php if (isset($form_validation_instruction->email_exist)) {
    echo $form_validation_instruction->email_exist;
}
?></span>
<span class="displaynon" id="formvalidation_mobile_number_exist"><?php if (isset($form_validation_instruction->mobile_number_exist)) {
    echo $form_validation_instruction->mobile_number_exist;
}
?></span>
<span class="displaynon" id="formvalidation_tax_exoneration_number"><?php if (isset($cart_instruction->tax_exoneration_error)) {
    echo $cart_instruction->tax_exoneration_error;
}
?></span>
<span class="displaynon" id="formvalidation_tax_exoneration_number_numeric"><?php if (isset($cart_instruction->tax_exoneration_error)) {
    echo $cart_instruction->tax_exoneration_error;
}
?></span>
<span class="displaynon" id="formvalidation_tax_exoneration"><?php if (isset($cart_instruction->tax_exoneration_code_error)) {
    echo $cart_instruction->tax_exoneration_code_error;
}
?></span>
<span class="displaynon" id="invalid_captcha"><?php if (isset($cart_instruction->invalid_captcha)) {
    echo $cart_instruction->invalid_captcha;
}
?></span>


<!--  -->

<span class="displaynon" id="formvalidation_signup_category"><?php if (isset($form_validation_instruction->signup_category)) {
    echo $form_validation_instruction->signup_category;
}
?></span>

<span class="displaynon" id="formvalidation_signup_maker"><?php if (isset($form_validation_instruction->signup_maker)) {
    echo $form_validation_instruction->signup_maker;
}
?></span>

<span class="displaynon" id="formvalidation_signup_model"><?php if (isset($form_validation_instruction->signup_model)) {
    echo $form_validation_instruction->signup_model;
}
?></span>

<span class="displaynon" id="formvalidation_signup_group"><?php if (isset($form_validation_instruction->signup_group)) {
    echo $form_validation_instruction->signup_group;
}
?></span>

<span class="displaynon" id="formvalidation_signup_year"><?php if (isset($form_validation_instruction->signup_year)) {
    echo $form_validation_instruction->signup_year;
}
?></span>

<span class="displaynon" id="formvalidation_signup_engine"><?php if (isset($form_validation_instruction->signup_engine)) {
    echo $form_validation_instruction->signup_engine;
}
?></span>

<span class="displaynon" id="formvalidation_signup_vn"><?php if (isset($form_validation_instruction->signup_vn)) {
    echo $form_validation_instruction->signup_vn;
}
?></span>


<!--    -->


<span class="displaynon" id="fd_verification_resent_block_msg"><?php if (isset($entry_door_message['fd_verification_resent_block_msg'])) {
    echo $entry_door_message['fd_verification_resent_block_msg'];
}
?></span>
   <span class="displaynon" id="fd_verification_resent_block_msg_sms"><?php if (isset($entry_door_message['fd_verification_resent_block_msg_sms'])) {
    echo $entry_door_message['fd_verification_resent_block_msg_sms'];
}
?></span>
   <span class="displaynon" id="fd_verification_resent_block_msg_email_sms"><?php if (isset($entry_door_message['fd_verification_resent_block_msg_email_sms'])) {
    echo $entry_door_message['fd_verification_resent_block_msg_email_sms'];
}
?></span>
   <span class="displaynon" id="fd_verification_wrong_block_msg"><?php if (isset($entry_door_message['fd_verification_wrong_block_msg'])) {
    echo $entry_door_message['fd_verification_wrong_block_msg'];
}
?></span>
   <span class="displaynon" id="fd_verification_wrong_block_msg_sms"><?php if (isset($entry_door_message['fd_verification_wrong_block_msg_sms'])) {
    echo $entry_door_message['fd_verification_wrong_block_msg_sms'];
}
?></span>
   <span class="displaynon" id="fd_verification_wrong_block_msg_email_sms"><?php if (isset($entry_door_message['fd_verification_wrong_block_msg_email_sms'])) {
    echo $entry_door_message['fd_verification_wrong_block_msg_email_sms'];
}
?></span>
   <span class="displaynon" id="fd_block_notification_msg"><?php if (isset($entry_door_message['fd_block_notification_msg'])) {
    echo $entry_door_message['fd_block_notification_msg'];
}
?></span>
   <span class="displaynon" id="fd_block_notification_msg_sms"><?php if (isset($entry_door_message['fd_block_notification_msg_sms'])) {
    echo $entry_door_message['fd_block_notification_msg_sms'];
}
?></span>
   <span class="displaynon" id="fd_block_notification_msg_email_sms"><?php if (isset($entry_door_message['fd_block_notification_msg_email_sms'])) {
    echo $entry_door_message['fd_block_notification_msg_email_sms'];
}
?></span>
   <span class="displaynon" id="please_wait"><?php if (isset($general_instruction->please_wait)) {
    echo $general_instruction->please_wait;
}
?></span>
   <span class="displaynon" id="hours"><?php if (isset($general_instruction->hours)) {
    echo $general_instruction->hours;
}
?></span>
   <span class="displaynon" id="minutes"><?php if (isset($general_instruction->minutes)) {
    echo $general_instruction->minutes;
}
?></span>
   <span class="displaynon" id="seconds"><?php if (isset($general_instruction->please_wait)) {
    echo $general_instruction->seconds;
}
?></span>
   <span class="displaynon" id="formvalidation_title"><?php if (isset($form_validation_instruction->popup_title)) {
    echo $form_validation_instruction->popup_title;
}
?></span>
   <span class="displaynon" id="formvalidation_name"><?php if (isset($form_validation_instruction->name)) {
    echo $form_validation_instruction->name;
}
?></span>
   <span class="displaynon" id="formvalidation_company"><?php if (isset($form_validation_instruction->company)) {
    echo $form_validation_instruction->company;
}
?></span>
   <span class="displaynon" id="formvalidation_address"><?php if (isset($form_validation_instruction->address)) {
    echo $form_validation_instruction->address;
}
?></span>
   <span class="displaynon" id="formvalidation_designation"><?php if (isset($form_validation_instruction->designation)) {
    echo $form_validation_instruction->designation;
}
?></span>
   <span class="displaynon" id="formvalidation_country"><?php if (isset($form_validation_instruction->country)) {
    echo $form_validation_instruction->country;
}
?></span>
   <span class="displaynon" id="formvalidation_telephone"><?php if (isset($form_validation_instruction->telephone)) {
    echo $form_validation_instruction->telephone;
}
?></span>
   <span class="displaynon" id="formvalidation_telephone_numeric"><?php if (isset($form_validation_instruction->telephone_numeric)) {
    echo $form_validation_instruction->telephone_numeric;
}
?></span>
   <span class="displaynon" id="formvalidation_email"><?php if (isset($form_validation_instruction->email)) {
    echo $form_validation_instruction->email;
}
?></span>
   <span class="displaynon" id="formvalidation_valid_email"><?php if (isset($form_validation_instruction->valid_email)) {
    echo $form_validation_instruction->valid_email;
}
?></span>
   <span class="displaynon" id="formvalidation_deadline"><?php if (isset($form_validation_instruction->deadline)) {
    echo $form_validation_instruction->deadline;
}
?></span>
   <span class="displaynon" id="formvalidation_deadline_future"><?php if (isset($form_validation_instruction->deadline_future)) {
    echo $form_validation_instruction->deadline_future;
}
?></span>
   <span class="displaynon" id="formvalidation_incoterms"><?php if (isset($form_validation_instruction->incoterms)) {
    echo $form_validation_instruction->incoterms;
}
?></span>
   <span class="displaynon" id="email_and_sms_blank"><?php if (isset($form_validation_instruction->email_and_sms_blank)) {
    echo $form_validation_instruction->email_and_sms_blank;
}
?></span>
   <span class="displaynon" id="email_blank"><?php if (isset($form_validation_instruction->email_blank)) {
    echo $form_validation_instruction->email_blank;
}
?></span>
   <span class="displaynon" id="sms_blank"><?php if (isset($form_validation_instruction->sms_blank)) {
    echo $form_validation_instruction->sms_blank;
}
?></span>
   <span class="displaynon" id="resend_email_attempt"><?php if (isset($form_validation_instruction->resend_email_attempt)) {
    echo $form_validation_instruction->resend_email_attempt;
}
?></span>
   <span class="displaynon" id="resend_sms_attempt"><?php if (isset($form_validation_instruction->resend_sms_attempt)) {
    echo $form_validation_instruction->resend_sms_attempt;
}
?></span>
   <span class="displaynon" id="wrong_email_code_attempt"><?php if (isset($form_validation_instruction->wrong_email_code_attempt)) {
    echo $form_validation_instruction->wrong_email_code_attempt;
}
?></span>
   <span class="displaynon" id="wrong_sms_code_attempt"><?php if (isset($form_validation_instruction->wrong_sms_code_attempt)) {
    echo $form_validation_instruction->wrong_sms_code_attempt;
}
?></span>
   <span class="displaynon" id="wrong_email_sms_code_attempt"><?php if (isset($form_validation_instruction->wrong_email_sms_code_attempt)) {
    echo $form_validation_instruction->wrong_email_sms_code_attempt;
}
?></span>
   <span class="displaynon" id="invalid_phone_not_email"><?php if (isset($form_validation_instruction->invalid_phone_not_email)) {
    echo $form_validation_instruction->invalid_phone_not_email;
}
?></span>
   <span class="displaynon" id="invalid_email_not_phone"><?php if (isset($form_validation_instruction->invalid_email_not_phone)) {
    echo $form_validation_instruction->invalid_email_not_phone;
}
?></span>
   <span class="displaynon" id="invalid_email_and_sms"><?php if (isset($form_validation_instruction->invalid_email_and_sms)) {
    echo $form_validation_instruction->invalid_email_and_sms;
}
?></span>
   <span class="displaynon" id="verification_code_to_email"><?php if (isset($cart_instruction->verification_code_to_email)) {
    echo $cart_instruction->verification_code_to_email;
}
?></span>
   <span class="displaynon" id="verification_code_to_sms"><?php if (isset($cart_instruction->verification_code_to_sms)) {
    echo $cart_instruction->verification_code_to_sms;
}
?></span>
   <span class="displaynon" id="verification_code_to_email_and_sms"><?php if (isset($cart_instruction->verification_code_to_email_and_sms)) {
    echo $cart_instruction->verification_code_to_email_and_sms;
}
?></span>
   <span class="displaynon" id="email_verified_sms_not"><?php if (isset($cart_instruction->email_verified_sms_not)) {
    echo $cart_instruction->email_verified_sms_not;
}
?></span>
   <span class="displaynon" id="sms_verified_email_not"><?php if (isset($cart_instruction->sms_verified_email_not)) {
    echo $cart_instruction->sms_verified_email_not;
}
?></span>
   <span class="displaynon" id="email_and_sms_not_verified"><?php if (isset($cart_instruction->email_and_sms_not_verified)) {
    echo $cart_instruction->email_and_sms_not_verified;
}
?></span>

<?php
$this->load->view('elements/popup/user_already_exist_popup');
$this->load->view('elements/popup/user_activation_msg_popup');
?>
<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">
