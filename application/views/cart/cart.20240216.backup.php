<?php $comingsoon = getNoImage('coming-soon'); ?>
<style>
    <?php if($session_data['logged_user_id']){ ?>
        .session_hide{display:none;}
    <?php } ?>
    .backend_hide{display:none !important;}
</style>
<div class="mainContent px-3 px-lg-5">
    <?php $this->load->view('elements/body_logo'); ?>


    <!------ Search box start --->
    <div class="ct-videoSection ct-u-paddingTop10 ct-u-paddingBottom20 no_mobile_toppadding">
        <div class="ct-services">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="ct-team-box ct-u-paddingTop20" style="padding-top:0px !important">
                        <div class="float-start w-100 common-search">
                            <div class="text-header">
                                <?php $this->load->view('elements/search'); ?>
                            </div>
                        </div>

                        <div class="float-start w-100 home-quick-search-wrap">
                            <?php $this->load->view('elements/quicksearch'); ?>
                        </div>

                        <div class="clearfix" style="margin-top: 30px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!------ Search box end --->

    <?php $this->load->view('elements/flash_messages'); ?>

    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url() . $lang_id . '/'; ?>cart/save_cart_data" id="cart_details_form" enctype="multipart/form-data">
        <input type="hidden" value="submit" name="button_checkings" id="button_checkings">
        <input type="hidden" value="<?php echo $user_id; ?>" name="user_id" id="user_id">

        <input type="hidden" id="block_timezone" name="block_timezone" value="" />
        <input type="hidden" id="cart_block_timer" name="cart_block_timer" value="<?php echo $cart_timer->cart_block_timer; ?>" />
        <div class="main-page">
            <div class="car-lists productlisting productbaselisting">
                <?php if (!empty($cart_details)) { ?>
                    <h4 class="cart-user-form <?php echo ($this->config->item('show_mandatory_notes') == '0'?'backend_hide':'');?>" style="text-align:center;"><?php echo $cart_instruction->fill_in_cart_details; ?></h4>
                <?php } ?>
                <div class="form-fill-cart float-start w-100">
                    <?php
                    $yes_checked = "";
                    $no_checked = "";
                    if (!empty($cart_details)) { ?>
                        <div class="cart-user-form float-start w-100">
                            <?php include('cart_timer.php'); ?>
                            <div class="col-md-12">
                                <div class="form-group  billingShippingcheck float-start w-100 mb-3">
                                    <label for="cart_surname" class="billing-details center control-label"><?php echo $cart_instruction->billing_details_same_shipping_details_text; ?><span class="cart_asterisk">*</span></label>
                                    <div class="col-sm-5">
                                        <?php
                                        $yes_checked = "";
                                        $no_checked = "";

                                        if (isset($cart_users_data['billing_shipping_selection'])) {


                                            if ($cart_users_data['billing_shipping_selection'] == 1) {


                                                $yes_checked = "checked";
                                            } else {
                                                $no_checked = "checked";
                                            }
                                        } else if ($billing_info_check == 1) {
                                            $yes_checked = "checked";
                                        } ?>
                                        <div class="form-check form-check-inline radio-inline p-0 position-relative">
                                            <input class="billing_to_shipping_class required_input" type="radio" id="radio1" name="billingShippingoptradio" value="1" >
                                            <label for="radio1" class="text-dark">
                                                <?php echo $cart_instruction->billing_details_same_shipping_details_text_yes; ?>
                                            </label>
                                        </div>

                                        <div class="form-check form-check-inline radio-inline p-0 position-relative">
                                            <input class="billing_to_shipping_class required_input" id="radio2" type="radio" name="billingShippingoptradio" value="0" >
                                            <label for="radio2" class="text-dark">
                                                <?php echo $cart_instruction->billing_details_same_shipping_details_text_no; ?>
                                            </label>
                                        </div>
                                        <p class="help-block blink_error"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="cart-form-grid float-start w-100">
                        <?php if ($billing_info_check == 1 ||  $yes_checked == "checked") { ?>
                            <div class="col-lg-12" id="hide_billing_details" style="<?php if (empty($cart_details)) {
                                                                                        echo 'display:none;';
                                                                                    } ?>">
                            <?php } else { ?>
                                <div class="col-lg-12" id="hide_billing_details" style="display:none;">
                                <?php }  ?>
                                <!-- session wise show/hide address -->
                                <h4 class="session_hide"><?php echo $cart_instruction->billing_details_text; ?></h4>
                                <div class="form-group float-start w-100 mb-3  session_hide">
                                    <label for="salutation" class="col-sm-12 control-label session_hide"><?php echo $cart_instruction->title; ?>
                                        <span class="cart_asterisk">*</span></label>
                                    <?php
                                    if (isset($front_validuser_data['applicant']) && $front_validuser_data['applicant'] != '') {
                                        $title = $front_validuser_data['applicant'];
                                        $front_validuser_data1['applicant'] = explode(" ", $title);
                                        $front_validuser_data1['applicant'] = $front_validuser_data1['applicant'][0];
                                    } else {
                                        $front_validuser_data1['applicant'] = '';
                                    }


                                    if (isset($cart_users_data['user_name']) && $cart_users_data['user_name'] != '') {
                                        $title = $cart_users_data['user_name'];
                                        $cart_users_data1['user_name'] = explode(" ", $title);
                                        $cart_users_data1['user_name'] = $cart_users_data1['user_name'][0];
                                    } else {
                                        $cart_users_data1['user_name'] = '';
                                    }


                                    ?>
                                    <div class="col-lg-12">
                                        <!--    <select name="salutation" id="salutation" class="form-control selectpicker1 kgt2">
                                    <option value='<?php echo $cart_instruction->mr_title; ?>' data-title="<?php echo $cart_instruction->mr_title; ?>" <?php if ($cart_users_data1['user_name'] == $cart_instruction->mr_title) { ?> selected="selected"<?php } ?>>
                                    <?php echo $cart_instruction->mr_title; ?>
                                    </option>
                                    <option value='<?php echo $cart_instruction->ms_title; ?>' data-title="<?php echo $cart_instruction->ms_title; ?>" <?php if ($cart_users_data1['user_name'] == $cart_instruction->ms_title) { ?> selected="selected"<?php } ?>>
                                    <?php echo $cart_instruction->ms_title; ?>
                                    </option>
                                    </select> -->
                                        <span class="position-relative">
                                            <input id="radio11" type="radio" class="required_input" name="salutation" value="Mr." <?php if ($cart_users_data1['user_name'] == 'Mr.') { ?> checked="checked" <?php } else if ($front_validuser_data1['applicant'] == 'Mr.') { ?> checked="checked" <?php } ?> />
                                            <label class="text-dark" for="radio11"><?php echo $cart_instruction->mr_title; ?></label>
                                        </span>
                                        <span class="position-relative">
                                            <input id="radio12" type="radio" class="required_input" name="salutation" value="Miss." <?php if ($cart_users_data1['user_name'] == 'Miss.') { ?> checked="checked" <?php } else if ($front_validuser_data1['applicant'] == 'Miss.') { ?> checked="checked" <?php } ?> />
                                            <label class="text-dark" for="radio12"><?php echo $cart_instruction->ms_title; ?></label>
                                        </span>
                                        <span class="position-relative">
                                            <input id="radio13" type="radio" class="required_input" name="salutation" value="Other" <?php if ($cart_users_data1['user_name'] == 'Other') { ?> checked="checked" <?php } else if ($front_validuser_data1['applicant'] == 'Other') { ?> checked="checked" <?php } ?> />
                                            <label class="text-dark" for="radio13"><?php echo $cart_instruction->other_title; ?></label>
                                        </span>

                                    </div>

                                    <p class="help-block blink_error"></p>
                                </div>
                                <div class="formGrid d-grid grid-col-3 gap-3">
                                    <div class="form-group float-start w-100 mb-3 session_hide">
                                        <label for="cart_company" class="w-100 float-start control-label"><?php echo $cart_instruction->company; ?></label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" id="cart_company" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->company); ?>" name="company" value="<?php echo isset($cart_users_data['company']) ? $cart_users_data['company'] : '' ?>">
                                        </div>
                                    </div>

                                    <?php

                                    if (isset($cart_users_data['surname']) && $cart_users_data['surname'] != '') {
                                        $cart_users_data['user_name'] = explode(" ", $cart_users_data['user_name'], 2);
                                        $cart_users_data['user_name'] = $cart_users_data['surname'];
                                    } else if (isset($cart_users_data['user_name']) && $cart_users_data['user_name'] != '') {
                                        $cart_users_data['user_name'] = explode(" ", $cart_users_data['user_name'], 2);
                                        $cart_users_data['user_name'] = $cart_users_data['user_name'][1];
                                    } else if (isset($front_validuser_data['applicant']) && $front_validuser_data['applicant'] != '') {
                                        $user_name = explode(" ", $front_validuser_data['applicant'], 2);
                                        $cart_users_data['user_name'] = $user_name[1];
                                    }
                                    ?>
                                    <div class="form-group float-start w-100 session_hide">
                                        <label for="cart_surname" class="col-sm-12 left control-label"><?php echo $cart_instruction->name_surname; ?>
                                            <span class="cart_asterisk">*</span></label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control  required_input" id="cart_surname" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->name_surname); ?>" name="surname" value="<?php echo isset($cart_users_data['user_name']) ? $cart_users_data['user_name'] : ''; ?>" required>
                                        </div>
                                        <p class="help-block"></p>
                                    </div>

                                    <!--    <div class="form-group float-start w-100">
                                    <label for="cart_designation" class="col-sm-12 control-label"><?php echo $cart_instruction->designation; ?></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" id="cart_designation" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->designation); ?>"
                                                name="designation"
                                                value="<?php echo isset($cart_users_data['designation']) ? $cart_users_data['designation'] : '' ?>"
                                                required >
                                    </div>
                                </div> -->
                                    <div class="form-group float-start w-100 session_hide">
                                        <label for="cart_email" class="col-sm-12 control-label"><?php echo $cart_instruction->email; ?>
                                            <span class="cart_asterisk">*</span></label>
                                        <div class="col-lg-12">
                                            <?php if ($cart_email_confirm != 1) { ?>
                                                <input type="text" class="form-control required_input email_validate" id="cart_email" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->email); ?>" name="email" value="<?php if (isset($cart_users_data['email'])) {
                                                                                                                                                                                                                                                    echo  $cart_users_data['email'];
                                                                                                                                                                                                                                                } else if (isset($front_validuser_data['email'])) {
                                                                                                                                                                                                                                                    $front_validuser_data['email'];
                                                                                                                                                                                                                                                } ?>" required>
                                            <?php } else { ?>
                                                <input type="text" class="form-control required_input email_validate" id="cart_email" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->email); ?>" value="<?php if (isset($cart_users_data['email'])) {
                                                                                                                                                                                                                                        echo  $cart_users_data['email'];
                                                                                                                                                                                                                                    } else if (isset($front_validuser_data['email'])) {
                                                                                                                                                                                                                                        $front_validuser_data['email'];
                                                                                                                                                                                                                                    } ?>" required readonly>
                                            <?php } ?>
                                        </div>
                                        <p class="help-block"></p>
                                        <input type="hidden" value="0" name="email_phone_exist" id="email_phone_exist">
                                        <input type="hidden" value="0" name="email_block_check" id="email_block_check">


                                    </div>
                                    <div class="form-group float-start w-100 session_hide">
                                        <label for="cart_country" class="col-sm-12 control-label"><?php echo $cart_instruction->country; ?>
                                            <span class="cart_asterisk">*</span></label>
                                        <div class="col-lg-12 position-relative" id="popupboxcountrywrap">
                                            <?php if (isset($cart_users_data['country'])) {
                                                $cart_users_country = $cart_users_data['country'];
                                            } else if (isset($front_validuser_data['country'])) {
                                                $cart_users_country = $front_validuser_data['country'];
                                            } else if (isset($front_validuser_data['country'])) {
                                                $cart_users_country = $front_validuser_data['country'];
                                            }

                                            if (isset($ip_data['countryCode']) && empty($cart_users_country)) {
                                                $cart_users_country = $ip_data['countryCode'];
                                            }
                                            //echo $cart_users_country;
                                            ?>
                                            <select autocomplete="no-fill" name="country" id="cart_country" class="form-control selectpicker1 kgt2 required_input" <?php if (getFrontenduserId()) {
                                                                                                                                                                        echo 'disabled';
                                                                                                                                                                    } ?>>
                                                <?php foreach ($countries as $country) { ?>
                                                    <option value='<?php echo htmlentities($country['countryName'], ENT_QUOTES); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" <?php if (isset($cart_users_country) && $cart_users_country != '' && $cart_users_country == $country['lang_countryName']) { ?>selected="selected" <?php } else if (isset($cart_users_country) && $cart_users_country != '' && $cart_users_country == $country['countryName']) { ?>selected="selected" <?php } else if (isset($cart_users_country)  && strtoupper($country['alpha_2']) == $cart_users_country) { ?> selected="selected" <?php } else if (isset($country['countryName']) && $country['countryName'] == "Canada") { ?> selected="selected" <?php } else if ($country['lang_countryName'] == "Canada") { ?>selected="selected" <?php } ?>>
                                                        <?php echo $country['countryName']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <p class="help-block"></p>
                                    </div>

                                    <input type="hidden" name="cart_country_flag" id="cart_country_flag" value="<?= isset($cart_users_data['ship_country_shortcode']) ? $cart_users_data['ship_country_shortcode'] : 'ca'; ?>" />
                                    <div class="form-group float-start w-100 session_hide">
                                        <label for="cart_telephone" class="col-sm-12 control-label"><?php echo $cart_instruction->cellphone; ?>
                                            <span class="cart_asterisk">*</span>
                                        </label>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-3 col-lg-3 country_code_div">
                                                <input type="text" class="form-control required_input numeric_input" id="cart_country_code" placeholder="+1" name="country_code" value="+<?php if (isset($cart_users_data['country_code']) && $cart_users_data['country_code']) {
                                                                                                                                                                                                echo $cart_users_data['country_code'];
                                                                                                                                                                                            } else if (isset($front_validuser_data['country_code']) && $front_validuser_data['country_code']) {
                                                                                                                                                                                                echo $front_validuser_data['country_code'];
                                                                                                                                                                                            } else {
                                                                                                                                                                                                echo '1';
                                                                                                                                                                                            } ?>" required autocomplete="no-fill" readonly>
                                            </div>
                                            <div class="col-xs-12 col-sm-9 col-lg-9">
                                                <?php if ($cart_sms_confirm != 1) { ?>
                                                    <input type="text" class="form-control required_input numeric_input" id="cart_telephone" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->cellphone); ?>" name="telephone" value="<?php if (isset($cart_users_data['telephone'])) {
                                                                                                                                                                                                                                                                    echo  $cart_users_data['telephone'];
                                                                                                                                                                                                                                                                } else if (isset($front_validuser_data['telephone'])) {
                                                                                                                                                                                                                                                                    $front_validuser_data['telephone'];
                                                                                                                                                                                                                                                                } ?>" required onkeypress="return isNumber(event)">
                                                <?php } else { ?>
                                                    <input type="text" class="form-control required_input numeric_input" id="cart_telephone" placeholder="cellphone" value="<?php if (isset($cart_users_data['telephone'])) {
                                                                                                                                                                                echo  $cart_users_data['telephone'];
                                                                                                                                                                            } else if (isset($front_validuser_data['telephone'])) {
                                                                                                                                                                                $front_validuser_data['telephone'];
                                                                                                                                                                            } ?>" required readonly>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group float-start w-100 session_hide">
                                        <label for="address_1" class="col-sm-12 control-label"><?php echo $cart_instruction->address_1; ?>
                                            <span class="cart_asterisk">*</span></label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control required_input" id="cart_address_1" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->address_1); ?>" name="cart_address_1" value="<?php echo isset($cart_users_data['cart_address_1']) ? $cart_users_data['cart_address_1'] : '' ?>">
                                        </div>
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group float-start w-100 session_hide">
                                        <label for="address_2" class="col-sm-12 control-label"><?php echo $cart_instruction->address_2; ?></label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" id="cart_address_2" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->address_2); ?>" name="cart_address_2" value="<?php echo isset($cart_users_data['cart_address_2']) ? $cart_users_data['cart_address_2'] : '' ?>">
                                        </div>
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group float-start w-100 session_hide">
                                        <label for="address_3" class="col-sm-12 control-label"><?php echo $cart_instruction->address_3; ?></label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" id="cart_address_3" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->address_3); ?>" name="cart_address_3" value="<?php echo isset($cart_users_data['cart_address_3']) ? $cart_users_data['cart_address_3'] : '' ?>">
                                        </div>
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group float-start w-100 session_hide">
                                        <label for="cart_city" class="col-sm-12 control-label"><?php echo $cart_instruction->city; ?><span class="cart_asterisk">*</span></label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control required_input" id="cart_city" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->city); ?>" name="cart_city" value="<?php echo isset($cart_users_data['cart_city']) ? $cart_users_data['cart_city'] : '' ?>" required>
                                        </div>
                                        <p class="help-block"></p>
                                    </div>

                                    <?php if ($cart_email_confirm == 1) { ?>
                                        <input type="hidden" name="email" value="<?php if (count($cart_users_data) > 0) echo isset($cart_users_data['email']) ? $cart_users_data['email'] : $front_validuser_data['email'] ?>">
                                    <?php } ?>

                                    <?php if ($cart_sms_confirm == 1) { ?>
                                        <input type="hidden" name="telephone" value="<?php echo isset($cart_users_data['telephone']) ? $cart_users_data['telephone'] : $front_validuser_data['telephone'] ?>">
                                    <?php } ?>

                                    <!--    <div class="form-group float-start w-100">
                                    <label for="cart_address" class="col-sm-12 control-label"><?php echo $cart_instruction->state; ?></label>
                                    <div class="col-lg-12">
                                    <input type="text" class="form-control" id="cart_state" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->state); ?>" name="cart_state" value="<?php echo isset($cart_users_data['cart_state']) ? $cart_users_data['cart_state'] : '' ?>" required >
                                    </div>
                                </div> -->

                                    <div class="form-group float-start w-100 session_hide">
                                        <label for="cart_state" class="col-sm-12 control-label"><?php echo $cart_instruction->state; ?>
                                            <span class="cart_asterisk">*</span></label>
                                        <div class="col-lg-12" id="cart-state">
                                            <select name="cart_state" id="cart-state-list" class="form-control kgt2 rounded required_input">
                                            </select>
                                        </div>
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group float-start w-100 session_hide">
                                        <label for="cart_zip" class="col-sm-12 control-label"><?php echo $cart_instruction->zip; ?><span class="cart_asterisk">*</span></label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control required_input" id="cart_zip" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->zip); ?>" name="cart_zip" value="<?php echo isset($cart_users_data['cart_zip']) ? $cart_users_data['cart_zip'] : '' ?>" required>
                                        </div>
                                        <p class="help-block"></p>
                                    </div>

                                    <?php
                                    $limit = available_credit_limit();


                                    if (!empty($user_id) && $loginuserterm['credit_term_status'] == "1" &&  $limit > 1 && !empty($cart_users_data['edi_one'])) { ?>



                                        <div class="form-group float-start w-100">
                                            <label for="edi_one" class="col-sm-12 control-label"><?php echo $cart_instruction->edi_one; ?><span class="cart_asterisk">*</span></label>
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control required_input" id="edi_one" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->edi_one); ?>" name="edi_one" value="<?php echo isset($cart_users_data['edi_one']) ? $cart_users_data['edi_one'] : '' ?>" required>
                                            </div>
                                            <p class="help-block"></p>
                                        </div>

                                        <div class="form-group float-start w-100">
                                            <label for="edi_one" class="col-sm-12 control-label"><?php echo $cart_instruction->edi_two; ?><span class="cart_asterisk">*</span></label>
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control required_input" id="edi_two" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->edi_two); ?>" name="edi_two" value="<?php echo isset($cart_users_data['edi_two']) ? $cart_users_data['edi_two'] : '' ?>" required>
                                            </div>
                                            <p class="help-block"></p>
                                        </div>

                                    <?php } ?>

                                   <?php if (true) { ?>
                                    <div class="form-group float-start w-100 <?php echo ($this->config->item('enable_po_no') == '0'?'backend_hide':'');?>">
                                        <label for="po_number" class="col-sm-12 control-label"><?php echo $cart_instruction->po_number; ?><span class="cart_asterisk"></span></label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" id="po_number" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->po_number); ?>" name="po_number" value="<?php echo isset($cart_users_data['po_number']) ? $cart_users_data['po_number'] : '' ?>">
                                            <input type="hidden" value="0" name="check_po_number" id="check_po_number">

                                        </div>
                                        <p class="help-block"></p>
                                    </div>
                                    <?php } ?>

                                    <?php if (true) { ?>
                                    <div class="form-group float-start w-100 <?php echo ($this->config->item('enable_po_file') == '0'?'backend_hide':'');?>" id="po_file">
                                        <label for="tax_exoneration" class="col-sm-12 left control-label"><?php echo $cart_instruction->po_file; ?>
                                            <span class="cart_asterisk"></span></label>
                                        <div class="col-lg-12 float-start w-100">
                                            <div class="w-100">
                                                <span class="customFileInput position-relative d-inline-block overflow-hidden">
                                                    <span class="btn actn-btn rounded inputfilebtn"><?php echo $cart_instruction->choose_file_po; ?></span>
                                                    <input id="po_file_img" name="po_file" class="focustip span12 inputfile" type="file">
                                                    <input type="hidden" name="po_file_exist" class="po_file_exist" value="<?php echo isset($cart_users_data['po_file']) ? 1 : 0; ?>">
                                                </span>
                                            </div>
                                            <?php if (isset($cart_users_data['po_file']) && $cart_users_data['po_file'] != "") {
                                                $src = base_url() . 'assets/uploads/cart/' . $cart_users_data['po_file'];
                                                $ext = pathinfo($cart_users_data['po_file'], PATHINFO_EXTENSION);
                                            } else {
                                                $src = $ext = '';
                                            } ?>
                                            <a id="pdf_link_po" style="<?php if (empty($src) || $ext != 'pdf') {
                                                                            echo 'display: none;';
                                                                        } ?>color:#000; text-decoration:underline; cursor:pointer; " href="<?php echo $src; ?>" target="_blank"><?php echo $cart_instruction->click_to_view_doc; ?></a>
                                            <div id="pdf_link_po_delete" class="margintop-10px" style="<?php if (empty($src) || $ext != 'pdf') {
                                                                                                            echo 'display: none;';
                                                                                                        } ?>padding: 5px 0px;margin-top:0px;">
                                                <input type="button" class="focustip btn actn-btn" value="<?php echo $cart_instruction->delete_file; ?>" onclick="removepdf('pdf_link_po');">
                                            </div>
                                            <div class="imgPreview position-relative rounded d-flex w-100">
                                                <img id="modelimg_prvw3" src="<?php echo $src; ?>" alt="image preview" class="modelimgpreviewbox" style="<?php if (empty($src) || $ext == 'pdf') {
                                                                                                                                                                echo 'display: none;';
                                                                                                                                                            } ?>width:150px; height:auto;padding: 5px 0px;" />
                                                <div id="modelimg_prvw3_delete" class="position-absolute deleteImg" style="<?php if (empty($src) || $ext == 'pdf') {
                                                                                                                                echo 'display: none;';
                                                                                                                            } ?>padding: 5px 0px 0px 120px;margin-top:0px;">
                                                    <input type="button" class="focustip btn actn-btn rounded" style="padding: 0px;width: 26px;height: 26px;" value="&times;" onclick="removeimg('modelimg_prvw3');">
                                                </div>
                                            </div>
                                        </div>
                                        <p class="help-block" style="<?php if ($src) {
                                                                            echo 'display:none;';
                                                                        } ?>"><?php echo $form_validation_instruction->po_file; ?></p>
                                    </div>
                                    <?php } ?>

                                    <input type="hidden" value="<?php echo $this->config->item('hide_po_number'); ?>" name="hide_po_number" id="hide_po_number">


                                    <div class="form-group float-start w-100 <?php echo ($this->config->item('enable_company_logo') == '0'?'backend_hide':'');?>">
                                        <label for="client_logo" class="col-sm-12 control-label"><?php echo $cart_instruction->client_logo; ?></label>
                                        <div class="col-lg-12">
                                            <div class="w-100">
                                                <span class="customFileInput position-relative d-inline-block overflow-hidden">
                                                    <span class="btn actn-btn rounded inputfilebtn"><?php echo $cart_instruction->choose_file; ?></span>
                                                    <input id="client_logo_img" name="client_logo" class="focustip span12 inputfile" type="file">
                                                    <input type="hidden" name="client_logo_exist" class="client_logo_exist" value="<?php echo (isset($cart_users_data['client_logo']) && $cart_users_data['client_logo']) ? 1 : 0; ?>">
                                                </span>
                                            </div>
                                            <div class="col-12 float-start w-100">
                                                <?php if (isset($cart_users_data['client_logo']) && $cart_users_data['client_logo'] != "") {
                                                    $src = base_url() . 'assets/uploads/cart/' . $cart_users_data['client_logo']; ?>
                                                    <div class="imgPreview position-relative rounded d-flex w-100">
                                                        <img id="modelimg_prvw1" src="<?php echo $src; ?>" alt="image preview" class="modelimgpreviewbox" style="width:150px; height:auto;padding: 5px 0px;" />
                                                        <div id="modelimg_prvw1_delete" class="position-absolute deleteImg" style="padding: 5px 0px 0px 120px;margin-top:0px;">
                                                            <input type="button" class="btn  actn-btn rounded" style="padding: 0px;width: 26px;height: 26px;" value="&times;" onclick="removeimg('modelimg_prvw1');">
                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="imgPreview position-relative rounded d-flex w-100">
                                                        <img id="modelimg_prvw1" alt="image preview" class="modelimgpreviewbox" style="width:150px; height:auto; display:none;padding: 5px 0px;" />
                                                        <div id="modelimg_prvw1_delete" class="position-absolute deleteImg" style="display:none;padding: 5px 0px 0px 120px;margin-top:0px;">
                                                            <input type="button" class="btn  actn-btn rounded" style="padding: 0px;width: 26px;height: 26px;" value="&times;" onclick="removeimg('modelimg_prvw1');">
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <p class="help-block" style="<?php if (isset($cart_users_data['client_logo']) && $cart_users_data['client_logo'] != "") {
                                                                            echo 'display:none;';
                                                                        } ?>"><?php echo $form_validation_instruction->client_logo; ?></p>
                                    </div>


                                </div>






                                <div class="float-start w-100">


                                    <!--<br />
                                <input type="checkbox" id="billing_to_shipping" /> <?php echo $cart_instruction->billing_details_same_shipping_details_text; ?>
                                <br /> -->
                                    <h4 class = "<?php echo ($this->config->item('enable_shipping_method') == '0'?'backend_hide':'');?>" style="padding-top:25px;"><?php echo $cart_instruction->carrier_details_text; ?></h4>
                                </div>
                                <div class="formGrid d-grid gap-3 grid-col-3 <?php echo ($this->config->item('enable_shipping_method') == '0'?'backend_hide':'');?>">
                                    <div class="form-group float-start w-100 <?php echo ($this->config->item('enable_quotation_no') == '0'?'backend_hide':'');?>">
                                        <label for="cart_rfq" class="col-sm-12 control-label"><?php echo $cart_instruction->rfq_number; ?></label>
                                        <div class="col-lg-12" id="cart_rfq_number" style="padding-top: 10px;">
                                            <?php
                                            if(empty($this->session->userdata('order_number'))) {
                                            $randomString = time() . rand(10, 100);
                                            } else {
                                            $randomString = $this->session->userdata('order_number');
                                            }
                                            echo $randomString;

                                            ?>
                                            <input type="text" id="cart_rfq" value="" class="displaynon" />
                                            <input type="hidden" name="order_number" value="<?php echo $randomString; ?>" />
                                        </div>
                                    </div>

                                    <?php $free_delivery = $this->session->userdata('free_delivery') ? $this->session->userdata('free_delivery') : 0; ?>
                                    <div class="form-group float-start w-100 free_delivery" style="<?php if ($free_delivery == 0) {
                                                                                                        echo 'display:none;';
                                                                                                    } ?>">
                                        <label for="incoterms" class="col-sm-12 control-label"><?php echo $cart_instruction->incoterms; ?></label>
                                        <div class="col-lg-12" style="margin-top:10px;">
                                            <p><?php echo $cart_instruction->free_delivery; ?></p>
                                        </div>
                                        <input type="hidden" name="free_delivery" id="free_delivery" value="<?= $free_delivery; ?>">
                                    </div>                            


                                    <div class="form-group float-start w-100 no_free_delivery" style="<?php if ($free_delivery == 1) {
                                                                                                            echo 'display:none;';
                                                                                                        } ?>">
                                            <label for="incoterms" class="col-sm-12 control-label"><?php echo $cart_instruction->incoterms; ?>
                                                <span class="cart_asterisk"><?php echo ($this->config->item('shipping_method_optional') == '0'?'*':'');?></span></label>
                                            <div class="col-lg-12" style="margin-top:10px;">
                                                <?php if ($this->config->item('shipping_incoterm_options') == 'exw' || $this->config->item('shipping_incoterm_options') == 'both') { ?>
                                                    <span class="exw position-relative">
                                                        <span class="position-relative">
                                                            <input id="radio15" type="radio" name="incoterms" value="<?php echo 'EXW'; ?>" <?php if (isset($cart_users_data['incoterms']) && $cart_users_data['incoterms'] == 'EXW') {
                                                                                                                                                echo "";
                                                                                                                                            } ?> class="<?php echo ($this->config->item('shipping_method_optional') == '0'?'required_input':'');?>" />
                                                            <label class="text-dark" for="radio15"><?php echo $cart_instruction->EXW; ?></label>
                                                        </span>
                                                        &nbsp;&nbsp;<i style="cursor:pointer;" id="qexw_desc" class="fa fa-question-circle" aria-hidden="true"></i>
                                                    </span>
                                                    <!--   <input type="radio" name="" value="<?php echo $cart_instruction->FCA; ?>"/>&nbsp;<?php echo $cart_instruction->FCA; ?>&nbsp;&nbsp;<br />
                                            <input type="radio" name="" value="<?php echo $cart_instruction->CPT; ?>"/>&nbsp;<?php echo $cart_instruction->CPT; ?>&nbsp;&nbsp;<br />
                                            <input type="radio" name="" value="<?php echo $cart_instruction->CIP; ?>"/>&nbsp;<?php echo $cart_instruction->CIP; ?>&nbsp;&nbsp;<br />
                                            <input type="radio" name="" value="<?php echo $cart_instruction->DAT; ?>"/>&nbsp;<?php echo $cart_instruction->DAT; ?>&nbsp;&nbsp;<br /> -->
                                                <?php } ?>
                                                <?php if ($this->config->item('shipping_incoterm_options') == 'dap' || $this->config->item('shipping_incoterm_options') == 'both') { ?>
                                                    <span class="dap mx-4 position-relative">
                                                        <span class="position-relative">
                                                            <input type="radio" id="radio16" name="incoterms" value="<?php echo 'DAP'; ?>" <?php if (isset($cart_users_data['incoterms']) && $cart_users_data['incoterms'] == 'DAP') {
                                                                                                                                                echo "";
                                                                                                                                            } ?> class="<?php echo ($this->config->item('shipping_method_optional') == '0'?'required_input':'');?>" />
                                                            <label class="text-dark" for="radio16">
                                                                <?php echo $cart_instruction->DAP; ?>
                                                            </label>
                                                        </span>
                                                        &nbsp;&nbsp;<i style="cursor:pointer;" id="qdap_desc" class="fa fa-question-circle" aria-hidden="true"></i>
                                                    </span>

                                                    <!--    <input type="radio" name="" value="<?php echo $cart_instruction->FAS; ?>"/>&nbsp;<?php echo $cart_instruction->FAS; ?>&nbsp;&nbsp;<br />
                                            <input type="radio" name="" value="<?php echo $cart_instruction->FOB; ?>"/>&nbsp;<?php echo $cart_instruction->FOB; ?>&nbsp;&nbsp;<br />
                                            <input type="radio" name="" value="<?php echo $cart_instruction->CFR; ?>"/>&nbsp;<?php echo $cart_instruction->CFR; ?>&nbsp;&nbsp;<br />
                                            <input type="radio" name="" value="<?php echo $cart_instruction->CIF; ?>"/>&nbsp;<?php echo $cart_instruction->CIF; ?>&nbsp;&nbsp;<br />
                                            <input type="radio" name="" value="<?php echo $cart_instruction->DAF; ?>"/>&nbsp;<?php echo $cart_instruction->DAF ?>&nbsp;&nbsp;<br />
                                            <input type="radio" name="" value="<?php echo $cart_instruction->DES; ?>"/>&nbsp;<?php echo $cart_instruction->DES ?>&nbsp;&nbsp;<br />
                                            <input type="radio" name="" value="<?php echo $cart_instruction->DEQ; ?>"/>&nbsp;<?php echo $cart_instruction->DEQ ?>&nbsp;&nbsp;<br />
                                            <input type="radio" name="" value="<?php echo $cart_instruction->DDU; ?>"/>&nbsp;<?php echo $cart_instruction->DDU ?>&nbsp;&nbsp;<br />
                                            <input type="radio" name="" value="<?php echo $cart_instruction->DAF; ?>"/>&nbsp;<?php echo $cart_instruction->DAF ?>&nbsp;&nbsp;                       -->
                                                <?php } ?>
                                            </div>
                                            <p class="help-block"></p>

                                            <div class="form-group float-start w-100">
                                                <div class="col-lg-12">                                                                                                    
                                                    <p style="<?php echo ($this->config->item('enable_incoterms_content') == '2' || $this->config->item('enable_incoterms_content') == '3'?"":"display:none;");?>" id="dap_desc"><?php echo $cart_instruction->dap_description; ?></p>
                                                    <?php if ($this->config->item('shipping_incoterm_options') == 'dap' || $this->config->item('shipping_incoterm_options') == 'both') { ?>
                                                        <?php if ($this->config->item('shipping_gateway') == 'ups') { ?>
                                                            <p style="display:none;" class="shipping_note"><?php echo $cart_instruction->ups_transit_time_note; ?></p>
                                                        <?php } else if ($this->config->item('shipping_gateway') == 'aramex') { ?>
                                                            <p style="display:none;" class="shipping_note"><?php echo $cart_instruction->aramex_transit_time_note; ?></p>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                    </div>
                                    <?php  $package_both_box_count = $this->session->userdata('package_both_box_count');

                                    //echo $package_both_box_count;
?>

                                         <!--- Package options for DAP shipping --> 
                                         <div class="form-group float-start w-100 no_free_delivery <?php echo ($this->config->item('enable_freight_mode') == '0'?'backend_hide':'');?>"  id="ship_with_freight" style="<?php if ($free_delivery == 1 || $package_both_box_count < 1) {
                                                                                                            echo 'display:none;';
                                                                                                        } ?>">
                                            <label for="incoterms" class="col-sm-12 control-label">  <?php echo $cart_instruction->freight_otion_label; ?>
                                                <span class="cart_asterisk"><?php echo ($this->config->item('shipping_method_optional') == '0'?'*':'');?></span></label>
                                            <div class="col-lg-12" style="margin-top:10px;">
                                               
                                                    <span class="exw position-relative">
                                                        <span class="position-relative">
                                                            <input  type="radio" name="ship_with_freight" value="1" <?php if (isset($cart_users_data['ship_with_freight']) && $cart_users_data['ship_with_freight'] == '1') {
                                                                                                                                                echo "checked=checked";
                                                                                                                                            } ?> class="<?php echo ($this->config->item('shipping_method_optional') == '0'?'required_input':'');?>" />
                                                            <label class="text-dark" for="radio15"><?php echo $cart_instruction->freight_yes; ?></label>
                                                        </span>
                                                        &nbsp;&nbsp;<i style="cursor:pointer;" id="qexw_desc" class="fa fa-question-circle" aria-hidden="true"></i>
						    </span>
						   <div class="form-group float-start w-100">
                                                        <div class="col-lg-12">                                                                                                    
                                                            <p style="<?php echo ($this->config->item('enable_incoterms_content') == '1' || $this->config->item('enable_incoterms_content') == '3'?"":"display:none;");?>" id="exw_desc"><?php echo $cart_instruction->exw_description; ?></p>                                                    
                                                        </div>
                                                   </div>
                                                 
                                             
                                                   <span class="dap mx-4 position-relative">
                                                        <span class="position-relative">
                                                            <input type="radio" name="ship_with_freight" value="0" <?php if (isset($cart_users_data['ship_with_freight']) && $cart_users_data['ship_with_freight'] == '0') {
                                                                                                                                                echo "checked=checked";
                                                                                                                                            } ?> class="<?php echo ($this->config->item('shipping_method_optional') == '0'?'required_input':'');?>" />
                                                            <label class="text-dark" for="radio16">
                                                            <?php echo $cart_instruction->freight_no; ?>
                                                            </label>
                                                        </span>
                                                        &nbsp;&nbsp;<i style="cursor:pointer;" id="qdap_desc" class="fa fa-question-circle" aria-hidden="true"></i>
                                                    </span>

                                                   
                                
                                            </div>
                                            <p class="help-block"></p>

                                            <div class="form-group float-start w-100">
                                                <div class="col-lg-12">
                                                    <p  id="freight_desc"></p>
                                                    <?php echo $cart_instruction->freight_option_desc; ?>
                                                   
                                                    
                                                </div>
                                            </div>
                                    </div>
<!--- Package options for DAP shipping --> 

                                    <div class="form-group float-start w-100 no_free_delivery <?php echo ($this->config->item('enable_freight_mode') == '0'?'backend_hide':'');?>" style="<?php if ($free_delivery == 1) {
                                                                                                            echo 'display:none;';
                                                                                                        } ?>">
                                        <label for="freight" class="col-sm-12 left control-label"><?php echo $cart_instruction->freight; ?>
                                            <span class="cart_asterisk"><?php echo ($this->config->item('shipping_method_optional') == '0'?'*':'');?></span></label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" placeholder="" id="freight_display" name="freight_display" value="<?php echo isset($cart_users_data['freight_display']) ? $cart_users_data['freight_display'] : ''; ?>" readonly />
                                            <input type="hidden" id="freight" name="freight" value="<?php echo isset($cart_users_data['freight']) ? $cart_users_data['freight'] : ''; ?>" />

                                            <span class="displaynon" id="3RD"><?php echo $cart_instruction->RD; ?></span>
                                            <span class="displaynon" id="CHG"><?php echo $cart_instruction->CHG; ?></span>
                                            <span class="displaynon" id="COL"><?php echo $cart_instruction->COL; ?></span>
                                            <span class="displaynon" id="NA"><?php echo $cart_instruction->NA; ?></span>
                                            <span class="displaynon" id="PPD"><?php echo $cart_instruction->PPD; ?></span>



                                        </div>
                                        <p class="help-block"></p>
                                    </div>
                                    <?php $incoterms = (isset($cart_users_data['incoterms']) && $cart_users_data['incoterms']) ? $cart_users_data['incoterms'] : ''; ?>
                                    <?php if ($this->config->item('shipping_gateway') == 'ups') {
                                        $sCarrierName = "UPS";
                                        $sCarrierNamelabel = $cart_instruction->ups;
                                    } else if ($this->config->item('shipping_gateway') == 'aramex') {
                                        $sCarrierName = "ARAMEX";
                                        $sCarrierNamelabel = $cart_instruction->aramex;
                                    } else if ($this->config->item('shipping_gateway') == 'fedex') {
                                        $sCarrierName = "FEDEX";
                                        $sCarrierNamelabel = $cart_instruction->fedex;
                                    } else if ($this->config->item('shipping_gateway') == 'freightcom') {
                                        $sCarrierName = "FREIGHTCOM";
                                        $sCarrierNamelabel = $cart_instruction->freightcom;
                                    } 
                                    
                                    
                                    
                                    ?>
                                    <input type="hidden" class="carrier-active-name" value="<?= $sCarrierName; ?>">



                                    <div class="form-group float-start w-100 no_free_delivery" style="<?php if ($free_delivery == 1) {
                                                                                                            echo 'display:none;';
                                                                                                        } ?>">
                                        <label for="carrier_name" class="col-sm-12 control-label"><?php echo $cart_instruction->carrier_name; ?>
                                            <span class="cart_asterisk"><?php echo ($this->config->item('shipping_method_optional') == '0'?'*':'');?></span></label>
                                        <div class="col-lg-12">
                                            <select name="carrier_name" id="carrier_name" class="form-control kgt2 rounded" disabled>
                                                <option value="<?= $sCarrierName; ?>" selected=""><?= $sCarrierNamelabel; ?></option>
                                            </select>
                                            <?php $carrier_name = isset($cart_users_data['carrier_name']) ? $cart_users_data['carrier_name'] : ''; ?>
                                            <input type="text" class="form-control <?php if ($incoterms) {
                                                                                        echo ($this->config->item('shipping_method_optional') == '0'?'required_input':'');
                                                                                    } ?>" id="carrier_name_input" name="carrier_name" value="<?php echo $incoterms == 'DAP' ? $sCarrierName : $carrier_name; ?>" style="display:none;" <?php if ($incoterms == '') {
                                                                                                                                                                                                                                            echo 'readonly';
                                                                                                                                                                                                                                        } ?> />

                                            <p class="help-block"></p>
                                            <div class="w-100 float-start mt-2">
                                                <span id="fetch_shipping_rate" style="cursor:pointer;"><?php echo $general_instruction->fetch_shipping_rate; ?></span>
                                            </div>
                                        </div>


                                        <div class="form-group float-start w-100" id="upsrates" style="display:none;">
                                            <label for="upsrates" class="col-sm-12 control-label"><?php echo $cart_instruction->select_shipping_rate; ?><span class="cart_asterisk">*</span></label>
                                            <div class="col-lg-12" id="upsratesradio">
                                            </div>
                                            <p class="help-block"></p>
                                        </div>

                                        <div class="form-group float-start w-100" id="upsrateserr" style="display:none;">
                                            <div class="col-lg-12" id="upsrateserror"></div>
                                        </div>

                                        <div class="form-group float-start w-50" id="shipping_rate_field" style="display:none;">
                                            <label for="shipping_rate" class="col-sm-12 control-label"><?php echo $cart_instruction->shipping_rate; ?><span class="cart_asterisk">*</span></label>
                                            <div class="col-lg-12">
                                                <?php $shipping_rate = '';
                                                if (isset($cart_users_data['shipping_rate']) && !empty($cart_users_data['shipping_rate'])) {
                                                    $shipping_rate = $cart_users_data['shipping_currency'] . ' ' . $cart_users_data['shipping_rate'] . ' ' . $cart_users_data['method_of_transportation'];
                                                } ?>
                                                <input type="text" class="form-control" id="shipping_rate" name="shipping_rate" value="<?= $shipping_rate; ?>" readonly>
                                            </div>
                                            <p class="help-block"></p>
                                        </div>


                                        <div class="form-group float-start w-100" id="shipping_rate_field_freight" style="display:none;">
                                            <label for="shipping_rate_freight" class="col-sm-12 control-label"><?php echo $cart_instruction->shipping_rate_freight; ?><span class="cart_asterisk">*</span></label>
                                            <div class="col-lg-12">
                                                <?php $shipping_rate = '';
                                                if (isset($cart_users_data['shipping_rate_freight']) && !empty($cart_users_data['shipping_rate_freight'])) {
                                                    $shipping_rate = $cart_users_data['shipping_currency'] . ' ' . $cart_users_data['shipping_rate_freight'] . ' ' . $cart_users_data['method_of_transportation_freight'];
                                                } ?>
                                                <input type="text" class="form-control" id="shipping_rate_freight" name="shipping_rate_freight" value="<?= $shipping_rate; ?>" readonly>
                                            </div>
                                            <p class="help-block"></p>
                                        </div>
                                    </div>

                                    <div class="form-group float-start w-100 no_free_delivery" style="<?php if ($free_delivery == 1) {
                                                                                                            echo 'display:none;';
                                                                                                        } ?>">
                                        <label for="carrier_account_number" class="col-sm-12 control-label"><?php echo $cart_instruction->carrier_account_number; ?>
                                            <span class="cart_asterisk"><?php echo ($this->config->item('shipping_method_optional') == '0'?'*':'');?></span></label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control <?php if ($incoterms) {
                                                                                         echo ($this->config->item('shipping_method_optional') == '0'?'required_input':'');
                                                                                    } ?>" id="carrier_account_number" name="carrier_account_number" value="<?php echo isset($cart_users_data['carrier_account_number']) ? $cart_users_data['carrier_account_number'] : ""; ?>" <?php if ($incoterms == '') {
                                                                                                                                                                                                                                                                                    echo 'readonly';
                                                                                                                                                                                                                                                                                } ?>>
                                            <input type="hidden" class="form-control" id="service_code" name="service_code" value="<?php echo  isset($cart_users_data['service_code']) ? $cart_users_data['service_code'] : ""; ?>" />
                                            <input type="hidden" class="form-control" id="transit_days" name="transit_days" value="<?php echo isset($cart_users_data['transit_days']) ? $cart_users_data['transit_days'] : ""; ?>" />
                                            <input type="hidden" class="form-control" id="delivery_by_time" name="delivery_by_time" value="<?php echo isset($cart_users_data['delivery_by_time']) ? $cart_users_data['delivery_by_time'] : ""; ?>" />

                                            <input type="hidden" class="form-control" id="service_code_freight" name="service_code_freight" value="<?php echo  isset($cart_users_data['service_code_freight']) ? $cart_users_data['service_code_freight'] : ""; ?>" />
                                            <input type="hidden" class="form-control" id="freight_service_type" name="freight_service_type" value="<?php echo isset($cart_users_data['freight_service_type']) ? $cart_users_data['freight_service_type'] : ""; ?>" />
                                            <input type="hidden" class="form-control" id="delivery_by_time_freight" name="delivery_by_time_freight" value="<?php echo isset($cart_users_data['delivery_by_time_freight']) ? $cart_users_data['delivery_by_time_freight'] : ""; ?>" />
                                        </div>
                                        <p class="help-block"></p>
                                    </div>

                                    <input type="hidden" class="dap-c-account" value="<?php echo ($incoterms == 'DAP') ? $cart_users_data['carrier_account_number'] : ''; ?>" />
                                    <input type="hidden" class="dap-c-name" value="<?php echo ($incoterms == 'DAP') ? $sCarrierName : ''; ?>" />

                                    <input type="hidden" class="exw-c-account" value="<?php echo ($incoterms == 'EXW') ? $cart_users_data['carrier_account_number'] : ''; ?>" />
                                    <input type="hidden" class="exw-c-name" value="<?php echo ($incoterms == 'EXW') ? $cart_users_data['carrier_name'] : ''; ?>" />

                                    <div class="form-group float-start w-100" id="irs_fid_number">
                                        <label for="fid_number" class="col-sm-12 left control-label"><?php echo $cart_instruction->irs_fid_number; ?>
                                            <span class="cart_asterisk">*</span></label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" id="fid_number" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->irs_fid_number); ?>" name="irs_fid_number" value="<?php echo isset($cart_users_data['irs_fid_number']) ? $cart_users_data['irs_fid_number'] : ""; ?>">
                                        </div>
                                        <p class="help-block"></p>
                                    </div>


                                </div>

                                <div class="float-start w-100 no_free_delivery mb-3" style="<?php if ($free_delivery == 1) {
                                                                                                echo 'display:none;';
                                                                                            } ?>">

                                    <div class="form-group float-start w-100" id="packedbox" style="display:none;">
                                        <h5 class="col-sm-12 control-label">
                                            <?php echo  $cart_instruction->packing_details; ?> </h5>
                                        <div class="col-lg-12 float-start w-100" id="packedboxdetails"></div>
                                    </div>
                                </div>
                                <div class="formGrid d-grid gap-3 grid-col-3">
                                    <?php //echo "<pre>"; print_r($cart_users_data);die;
                                    ?>
                                    <div class="form-group float-start w-100 <?php echo ($this->config->item('enable_tax_ex_code') == '0'?'backend_hide':'');?>" id="tax_exoneration" style="display:<?php echo isset($cart_users_data) && !empty($cart_users_data) && (($this->config->item('store_country') != $cart_users_data['country_code'] && $this->config->item('tax_applicable') == 0) || $this->config->item('store_country') == $cart_users_data['country_code']) ? 'block' : ''; ?>">
                                        <label for="tax_exoneration" class="col-sm-12 control-label"><?php echo $cart_instruction->tax_exoneration; ?>
                                            <span class="cart_asterisk"></span></label>
                                        <div class="col-lg-12 mt-2">
                                            <span class="position-relative">
                                                <input type="radio" id="radio17" class="" style="margin-top: 8px;" name="tax_exoneration" value="1" <?php if (isset($cart_users_data['tax_exoneration']) && $cart_users_data['tax_exoneration'] == 1) {
                                                                                                                                                                        echo "checked=checked";
                                                                                                                                                                    } ?>>
                                                <label class="text-dark" for="radio17"> <?php echo $cart_instruction->yes; ?></label>
                                            </span>

                                            <span class="position-relative px-3">
                                                <input type="radio" id="radio18" class="required_input" style="margin-top: 8px;" name="tax_exoneration" value="0" <?php if (isset($cart_users_data['tax_exoneration']) && $cart_users_data['tax_exoneration'] == 0) {
                                                                                                                                                                        echo "checked=checked";
                                                                                                                                                                    } ?>>
                                                <label class="text-dark" for="radio18"><?php echo $cart_instruction->no; ?></label>
                                            </span>
                                        </div>

                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group float-start w-100" id="tax_exoneration_number">
                                        <label for="tax_exoneration_number" class="col-sm-12 left control-label "><?php echo $cart_instruction->tax_exoneration_number; ?>
                                            <span class="cart_asterisk">*</span></label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" id="tax_exoneration_number_value" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->tax_exoneration_number); ?>" name="tax_exoneration_number" value="<?php echo isset($cart_users_data['tax_exoneration_number']) ? $cart_users_data['tax_exoneration_number'] : ""; ?>">
                                        </div>
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="form-group float-start w-100" id="tax_exoneration_file">
                                        <label for="tax_exoneration" class="col-sm-12 left control-label"><?php echo $cart_instruction->tax_exoneration_file; ?>
                                            <span class="cart_asterisk">*</span></label>
                                        <div class="col-lg-12 float-start w-100">
                                            <div class="w-100">
                                                <span class="customFileInput position-relative d-inline-block overflow-hidden">
                                                    <span class="btn actn-btn rounded inputfilebtn"><?php echo $cart_instruction->choose_file; ?></span>
                                                    <input id="tax_exoneration_file_img" name="tax_exoneration_file" class="focustip span12 inputfile required_input " type="file">
                                                    <input type="hidden" name="tax_file_exist" class="tax_file_exist" value="<?php echo isset($cart_users_data['tax_exoneration_file']) ? 1 : 0; ?>">
                                                </span>
                                            </div>
                                            <?php if (isset($cart_users_data['tax_exoneration_file']) && $cart_users_data['tax_exoneration_file'] != "") {
                                                $src = base_url() . 'assets/uploads/cart/' . $cart_users_data['tax_exoneration_file'];
                                                $ext = pathinfo($cart_users_data['tax_exoneration_file'], PATHINFO_EXTENSION);
                                            } else {
                                                $src = $ext = '';
                                            } ?>
                                            <a id="pdf_link" style="<?php if (empty($src) || $ext != 'pdf') {
                                                                        echo 'display: none;';
                                                                    } ?>color:#000; text-decoration:underline; cursor:pointer; " href="<?php echo $src; ?>" target="_blank"><?php echo $cart_instruction->click_to_view_doc; ?></a>
                                            <div id="pdf_link_delete" class="margintop-10px" style="<?php if (empty($src) || $ext != 'pdf') {
                                                                                                        echo 'display: none;';
                                                                                                    } ?>padding: 5px 0px;margin-top:0px;">
                                                <input type="button" class="focustip btn actn-btn" value="<?php echo $cart_instruction->delete_file; ?>" onclick="removepdf('pdf_link');">
                                            </div>
                                            <div class="imgPreview position-relative rounded d-flex w-100">
                                                <img id="modelimg_prvw2" src="<?php echo $src; ?>" alt="image preview" class="modelimgpreviewbox" style="<?php if (empty($src) || $ext == 'pdf') {
                                                                                                                                                                echo 'display: none;';
                                                                                                                                                            } ?>width:150px; height:auto;padding: 5px 0px;" />
                                                <div id="modelimg_prvw2_delete" class="position-absolute deleteImg" style="<?php if (empty($src) || $ext == 'pdf') {
                                                                                                                                echo 'display: none;';
                                                                                                                            } ?>padding: 5px 0px 0px 120px;margin-top:0px;">
                                                    <input type="button" class="focustip btn actn-btn rounded" style="padding: 0px;width: 26px;height: 26px;" value="&times;" onclick="removeimg('modelimg_prvw2');">
                                                </div>
                                            </div>
                                        </div>
                                        <p class="help-block" style="<?php if ($src) {
                                                                            echo 'display:none;';
                                                                        } ?>"><?php echo $form_validation_instruction->tax_exoneration_file_size; ?></p>
                                    </div>
                                </div>

                                <div class="float-start w-100 <?php echo ($this->config->item('enable_discount_code') == '0'?'backend_hide':'');?>">


                                    <!--<br />
<input type="checkbox" id="billing_to_shipping" /> <?php echo $cart_instruction->billing_details_same_shipping_details_text; ?>
<br /> -->

                                    <h4 style="padding-top:25px;"><?php echo $cart_instruction->discount_section; ?></h4>
                                </div>

                                <?php $coupon_applied = $this->session->userdata('coupon_applied') ? $this->session->userdata('coupon_applied') : 0;
                                $coupon_data = $this->session->userdata('coupon_data') ? $this->session->userdata('coupon_data') : 0;


                                ?>
                                <div class="formGrid disount_coupon d-grid gap-3 grid-col-3 <?php if ($coupon_applied == "1") {
                                                                                                echo "hide";
                                                                                            } ?> <?php echo ($this->config->item('enable_discount_code') == '0'?'backend_hide':'');?>">

                                    <div class="form-group float-start w-100 mb-3 ">
                                        <label for="coupon_code" class="w-100 float-start control-label"> <?php echo $cart_instruction->coupon_code; ?></label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" id="coupon_code" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->coupon_code); ?>" name="coupon_code" value="<?php if ($coupon_applied == "1") {
                                                                                                                                                                                                                                echo  $coupon_data["coupon_code"];
                                                                                                                                                                                                                            } ?>" role="presentation" autocomplete="off">
                                            <input type="hidden" id="coupon_new" name="coupon_new" value="0">


                                        </div>
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group float-start w-100 mb-3">
                                        <label for="cart_company" class="w-100 float-start control-label"> <?php echo $cart_instruction->discount_button_label; ?> </label>
                                        <div class="col-lg-12">
                                            <a href="javascript:void(0)" class="btn  actn-btn rounded" id="discount_apply"><?php echo $cart_instruction->apply_button; ?></a>
                                        </div>
                                    </div>

                                </div>


                                <div class="formGrid coupon_applied <?php if ($coupon_applied != "1") {
                                                                        echo "hide";
                                                                    } ?> d-grid gap-3 grid-col-3">

                                    <div class="form-group float-start w-100 mb-3">
                                        <label for="coupon_code" class="w-100 float-start control-label"> <?php echo $cart_instruction->coupon_code; ?></label>
                                        <div class="col-lg-12 coupon_apply_val">
                                            <?php if ($coupon_applied == "1") {
                                                echo  $coupon_data["coupon_code"] . "(Expiry Time " . $coupon_data["expirytime"] . ")";
                                            } ?>
                                        </div>
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group float-start w-100 mb-3">
                                        <label for="cart_company" class="w-100 float-start control-label"> <?php echo $cart_instruction->coupon_delete_label; ?> </label>
                                        <div class="col-lg-12">
                                            <a href="javascript:void(0)" class="btn  actn-btn rounded" id="delete_coupon"><?php echo $cart_instruction->delete_product; ?></a>
                                        </div>
                                    </div>

                                </div>

                                </div>
                                <?php if (isset($cart_users_data['billing_shipping_selection']) && $cart_users_data['billing_shipping_selection'] == 0) { ?>
                                    <div class="col-lg-12" id="show_shipping_details_div">
                                    <?php } else { ?>
                                        <div class="col-lg-12" id="show_shipping_details_div" style="display: none">
                                        <?php } ?>
                                        <h4><?php echo $cart_instruction->shipping_details_text; ?></h4>
                                        <div class="formGrid d-grid gap-3 grid-col-3">
                                            <div class="form-group float-start w-100 mb-3">
                                                <label for="salutation" class="col-sm-12 left control-label"><?php echo $cart_instruction->ship_title; ?>
                                                    <span class="cart_asterisk">*</span></label>
                                                <div class="col-lg-12" style="margin-top: 8px;">
                                                    <span class="position-relative">
                                                        <input type="radio" id="radio19" class="required_input" name="ship_title" value="Mr." <?php if (isset($cart_users_data['ship_title']) && $cart_users_data['ship_title'] == 'Mr.') {
                                                                                                                                                    echo "checked=checked";
                                                                                                                                                } ?> />
                                                        <label class="text-dark" for="radio19"><?php echo $cart_instruction->mr_title; ?></label>
                                                    </span>

                                                    <span class="position-relative">
                                                        <input type="radio" id="radio20" class="required_input" name="ship_title" value="Miss." <?php if (isset($cart_users_data['ship_title']) && $cart_users_data['ship_title'] == 'Miss.') {
                                                                                                                                                    echo "checked=checked";
                                                                                                                                                } ?> />
                                                        <label class="text-dark" for="radio20"> <?php echo $cart_instruction->ms_title; ?></label>
                                                    </span>

                                                    <span class="position-relative">
                                                        <input type="radio" id="radio21" class="required_input" name="ship_title" value="Other" <?php if (isset($cart_users_data['ship_title']) && $cart_users_data['ship_title'] == 'Other') {
                                                                                                                                                    echo "checked=checked";
                                                                                                                                                } ?> /><label class="text-dark" for="radio21"><?php echo $cart_instruction->other_title; ?></label>
                                                    </span>
                                                </div>
                                                <p class="help-block"></p>
                                            </div>

                                            <div class="form-group float-start w-100">
                                                <label for="ship_company" class="col-sm-12 control-label"><?php echo $cart_instruction->ship_company; ?></label>
                                                <div class="col-lg-12">
                                                    <input type="text" class="form-control" id="ship_company" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_company); ?>" name="ship_company" value="<?php echo isset($cart_users_data['ship_company']) ? $cart_users_data['ship_company'] : '' ?>">
                                                </div>
                                                <p class="help-block"></p>
                                            </div>

                                            <div class="form-group float-start w-100">
                                                <label for="ship_fullname" class="col-sm-12 left control-label"><?php echo $cart_instruction->ship_fullname; ?>
                                                    <span class="cart_asterisk">*</span></label>
                                                <div class="col-lg-12">
                                                    <input type="text" class="form-control required_input" id="ship_surname" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_fullname); ?>" name="ship_surname" value="<?php echo isset($cart_users_data['ship_surname']) ? $cart_users_data['ship_surname'] : '' ?>" required>
                                                </div>
                                                <p class="help-block"></p>
                                            </div>

                                            <div class="form-group float-start w-100">
                                                <label for="ship_email" class="col-sm-12 control-label"><?php echo $cart_instruction->ship_email; ?>
                                                    <span class="cart_asterisk">*</span></label>
                                                <div class="col-lg-12">
                                                    <input type="text" class="form-control required_input email_validate" id="ship_email" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_email); ?>" name="ship_email" value="<?php if (isset($cart_users_data)) echo isset($cart_users_data['ship_email']) ? $cart_users_data['ship_email'] : '' ?>" required>
                                                </div>
                                                <p class="help-block"></p>
                                            </div>

                                            <div class="form-group float-start w-100">
                                                <label for="ship_country" class="col-sm-12 control-label"><?php echo $cart_instruction->ship_country; ?>
                                                    <span class="cart_asterisk">*</span></label>
                                                <div class="col-lg-12 position-relative" id="popupboxcountrywrap">
                                                    <?php $cart_users_country = isset($cart_users_data['ship_country']) ? $cart_users_data['ship_country'] : ''; ?>
                                                    <select autocomplete="no-fill" name="ship_country" id="ship_country" class="form-control selectpicker1 kgt2 required_input">

                                                        <?php foreach ($countries as $country) { ?>
                                                            <option value='<?php echo htmlentities($country['countryName'], ENT_QUOTES); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-alpha2="<?php echo strtoupper($country['alpha_2']); ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" <?php if (isset($cart_users_country) && $cart_users_country != '' && $cart_users_country == $country['lang_countryName']) { ?>selected="selected" <?php } else if (isset($cart_users_country) && $cart_users_country != '' && $cart_users_country == $country['countryName']) { ?>selected="selected" <?php } else if (isset($ip_data['countryCode'])  && strtoupper($country['alpha_2']) == $ip_data['countryCode']) { ?> selected="selected" <?php } else if (isset($country['countryName']) && $country['countryName'] == "Canada") { ?> selected="selected" <?php } else if ($country['lang_countryName'] == "Canada") { ?>selected="selected" <?php } ?>>
                                                                <?php echo $country['countryName']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <p class="help-block"></p>
                                            </div>

                                            <input type="hidden" name="ship_country_flag" id="ship_country_flag" />
                                            <div class="form-group float-start w-100">
                                                <label for="ship_telephone" class="col-sm-12 control-label"><?php echo $cart_instruction->ship_cellphone; ?>
                                                    <span class="cart_asterisk">*</span>
                                                </label>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-3 col-lg-3 country_code_div" style="padding-right:0px;">
                                                        <input type="text" class="form-control required_input" id="ship_country_code" placeholder="+1" name="ship_country_code" value="<?php echo isset($cart_users_data['ship_country_code']) ? $cart_users_data['ship_country_code'] : '1' ?>" required readonly autocomplete="no-fill">
                                                    </div>
                                                    <div class="col-xs-12 col-sm-9 col-lg-9">
                                                        <input type="text" class="form-control required_input numeric_input" id="ship_telephone" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_cellphone); ?>" name="ship_telephone" value="<?php echo isset($cart_users_data['ship_telephone']) ? $cart_users_data['ship_telephone'] : '' ?>" required onkeypress="return isNumber(event)">
                                                    </div>
                                                </div>
                                                <p class="help-block"></p>
                                            </div>

                                            <div class="form-group float-start w-100">
                                                <label for="ship_address_1" class="col-sm-12 control-label"><?php echo $cart_instruction->ship_address_1; ?>
                                                    <span class="cart_asterisk">*</span></label>
                                                <div class="col-lg-12">
                                                    <input type="text" class="form-control required_input" id="ship_address_1" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_address_1); ?>" name="ship_address_1" value="<?php echo isset($cart_users_data['ship_address_1']) ? $cart_users_data['ship_address_1'] : '' ?>">
                                                </div>
                                                <p class="help-block"></p>
                                            </div>

                                            <div class="form-group float-start w-100">
                                                <label for="ship_address_2" class="col-sm-12 control-label"><?php echo $cart_instruction->ship_address_2; ?></label>
                                                <div class="col-lg-12">
                                                    <input type="text" class="form-control" id="ship_address_2" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_address_2); ?>" name="ship_address_2" value="<?php echo isset($cart_users_data['ship_address_2']) ? $cart_users_data['ship_address_2'] : '' ?>">
                                                </div>
                                                <p class="help-block"></p>
                                            </div>

                                            <div class="form-group float-start w-100">
                                                <label for="ship_address_3" class="col-sm-12 control-label"><?php echo $cart_instruction->ship_address_3; ?></label>
                                                <div class="col-lg-12">
                                                    <input type="text" class="form-control" id="ship_address_3" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_address_3); ?>" name="ship_address_3" value="<?php echo isset($cart_users_data['ship_address_3']) ? $cart_users_data['ship_address_3'] : '' ?>">
                                                </div>
                                                <p class="help-block"></p>
                                            </div>

                                            <div class="form-group float-start w-100">
                                                <label for="ship_city" class="col-sm-12 control-label"><?php echo $cart_instruction->ship_city; ?>
                                                    <span class="cart_asterisk">*</span></label>
                                                <div class="col-lg-12">
                                                    <input type="text" class="form-control required_input" id="ship_city" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_city); ?>" name="ship_city" value="<?php echo isset($cart_users_data['ship_city']) ? $cart_users_data['ship_city'] : '' ?>">
                                                </div>
                                                <p class="help-block"></p>
                                            </div>

                                            <div class="form-group float-start w-100">
                                                <label for="ship_state" class="col-sm-12 control-label"><?php echo $cart_instruction->ship_state; ?>
                                                    <span class="cart_asterisk">*</span></label>
                                                <div class="col-lg-12" id="ship-state">
                                                    <select name="ship_state" id="ship-state-list" class="form-control kgt2 rounded required_input">
                                                    </select>

                                                </div>
                                                <p class="help-block"></p>
                                            </div>

                                            <div class="form-group float-start w-100">
                                                <label for="ship_zip" class="col-sm-12 control-label"><?php echo $cart_instruction->ship_zip; ?>
                                                    <span class="cart_asterisk">*</span></label>
                                                <div class="col-lg-12">
                                                    <input type="text" class="form-control required_input" id="ship_zip" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_zip); ?>" name="ship_zip" value="<?php echo isset($cart_users_data['ship_zip']) ? $cart_users_data['ship_zip'] : '' ?>">
                                                </div>
                                                <p class="help-block"></p>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 brand_complete_info">
                                        <?php if (!empty($cart_details)) {
                                        ?>
                                            <div class="table-responsivefloat-start w-100" id="not_empty_cart">
                                                <input type="hidden" value="1" name="update" class="width50px">
                                                <div id="kgtcartactive" class="table table-bordered my-table productsbytype">
                                              
                                                    <?php
                                                    $i = 1;
                                                    $currentproducttype_id = '';
                                                    $currentproducttype = '';
                                                    $count = 0;
                                                    foreach ($cart_details as $cart) {
                                                        $current_ref = '';
                                                        $privilage = explode(',', $cart->menu_privilages);

                                                        $data['product'] = $cart;
                                                        $data['i'] = $i;
                                                        $data['view_type'] = "1";
                                                        $data['cart_instruction'] = $cart_instruction;
                                                        $data['product_instruction'] = $product_instruction;
                                                        $data['general_instruction'] = $general_instruction;
                                                        $data['product_items']       = $product_items;
                                                        $data['coupon_applied']       = $coupon_applied;
                                                        $data['coupon_data']       = $coupon_data;
                                                        $data['product_model_items'] = $product_model_items;
                                                        $data['searchItemValue']     = $searchItemValue;
                                                        $data['comingsoon'] = $comingsoon;
                                                        $this->load->view('product/product_element', $data);

                                                        $i++;

                                                        $count++;
                                                    }
                                                    ?>
                                                    
                                                </div>
                                            
                                                    <div id="empty_cart" class="out-box-modal displaynon float-start w-100">
                                                        <div class="box-content-modal">
                                                            <h2 class="title-modal big"><?php echo $cart_instruction->empty_cart; ?></h2>
                                                        </div>
                                                    </div>
                                             </div>
                                        <?php } else { ?>
                                            <div class="out-box-modal float-start w-100" id="empty_cart">
                                                <div class="box-content-modal">
                                                    <h2 class="title-modal big"><?php echo $cart_instruction->empty_cart; ?></h2>
                                                </div>
                                            </div>
											
                                        <?php } ?>
                                    </div>
                            </div>
                    </div>
                    <?php if (!empty($cart_details)) { ?>
                        <div class="nav-prex-next text-right removebuttons" id="cart_buttons">
                            <a href="<?php echo base_url() . $lang_id . '/products/product_list'; ?>" class="btn  actn-btn rounded" id="cart_back"><?php echo $general_instruction->back; ?></a>
                            <a href="<?php echo base_url() . $lang_id . '/products'; ?>" class="btn  actn-btn rounded" id="cart_continue_shopping_header"><?php echo $general_instruction->continue_and_submit; ?></a>
                            <a href="javascript:void(0)" class="btn  actn-btn rounded" id="cart_checkout"><?php echo $cart_instruction->cart_proceed; ?></a>
                        </div>
                    <?php } ?>
                </div>
                <!--End content-->
    </form>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 s_button sticky_bottom productBtnsFixedBottom py-2 py-md-3 px-3 px-md-5" style="display: none;">
    <?php if (!empty($cart_details)) { ?>
        <div class="nav-prex-next sticky_button_next d-flex flex-wrap align-items-center justify-content-between w-100" id="cart_buttons">
            <div class="productActionBtns d-flex align-items-center w-100 justify-content-end">
                <a href="<?php echo base_url() . $lang_id . '/products/product_list'; ?>" style="margin-right: auto;" class="btn2  actn-btn2 rounded cart_back_btn_color" id="cart_back"><?php echo $general_instruction->back; ?></a>
                <a href="javascript:void(0)" class="btn2  actn-btn2 rounded cart_save_btn_color" id="cart_continue_shopping"><?php echo $general_instruction->continue_and_submit; ?></a>
                <a href="javascript:void(0)" class="btn2  actn-btn2 rounded cart_submit_btn_color" style="margin-left: auto;" id="cart_checkout_footer"><?php echo $cart_instruction->cart_proceed; ?></a>
            </div>
        </div>
    <?php } ?>
</div>
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
<span class="displaynon" id="formvalidation_ship_with_freight"><?php if (isset($form_validation_instruction->ship_with_freight)) echo $form_validation_instruction->ship_with_freight; ?></span>

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
<span class="displaynon" id="formvalidation_tax_exoneration_file"><?php if (isset($form_validation_instruction->tax_exoneration_file)) echo $form_validation_instruction->tax_exoneration_file; ?></span>
<span class="displaynon" id="formvalidation_tax_exoneration_file_size"><?php if (isset($form_validation_instruction->tax_exoneration_file_size)) echo $form_validation_instruction->tax_exoneration_file_size; ?></span>
<span class="displaynon" id="formvalidation_freight_display"><?php if (isset($form_validation_instruction->freight)) echo $form_validation_instruction->freight; ?></span>
<span class="displaynon" id="formvalidation_carrier_name"><?php if (isset($form_validation_instruction->carrier_name)) echo $form_validation_instruction->carrier_name; ?></span>
<span class="displaynon" id="formvalidation_carrier_account_number"><?php if (isset($form_validation_instruction->carrier_account_number)) echo $form_validation_instruction->carrier_account_number; ?></span>
<span class="displaynon" id="formvalidation_irs_fid_number"><?php if (isset($form_validation_instruction->irs_fid_number)) echo $form_validation_instruction->irs_fid_number; ?></span>
<span class="displaynon" id="formvalidation_shipping_rate"><?php if (isset($form_validation_instruction->shipping_rate)) echo $form_validation_instruction->shipping_rate; ?></span>
<span class="displaynon" id="formvalidation_tax_exoneration_number"><?php if (isset($cart_instruction->tax_exoneration_error)) echo $cart_instruction->tax_exoneration_error; ?></span>
<span class="displaynon" id="formvalidation_tax_exoneration_number_numeric"><?php if (isset($cart_instruction->tax_exoneration_error)) echo $cart_instruction->tax_exoneration_error; ?></span>
<span class="displaynon" id="formvalidation_tax_exoneration"><?php if (isset($cart_instruction->tax_exoneration_code_error)) echo $cart_instruction->tax_exoneration_code_error; ?></span>
<span class="displaynon" id="formvalidation_modified_Product_fetch_rate_text"><?php if (isset($cart_instruction->modified_Product_fetch_rate_text)) echo $cart_instruction->modified_Product_fetch_rate_text; ?></span>
<span class="displaynon" id="formvalidation_address_change_fetch_rate_text"><?php if (isset($cart_instruction->address_change_fetch_rate_text)) echo $cart_instruction->address_change_fetch_rate_text; ?></span>
<span class="displaynon" id="formvalidation_quantity_change_fetch_rate_text"><?php if (isset($cart_instruction->quantity_change_fetch_rate_text)) echo $cart_instruction->quantity_change_fetch_rate_text; ?></span>
<span class="displaynon" id="fetch_rate_loader_text"><?php if (isset($general_instruction->fetch_rate_loader_text)) echo $general_instruction->fetch_rate_loader_text; ?></span>
<span class="displaynon" id="user_email_exist"><?php if (isset($general_instruction->user_email_exist)) echo $general_instruction->user_email_exist; ?></span>
<span class="displaynon" id="user_phone_exist"><?php if (isset($general_instruction->user_phone_exist)) echo $general_instruction->user_phone_exist; ?></span>
<span class="displaynon" id="formvalidation_po_number"><?php if (isset($form_validation_instruction->po_number)) echo $form_validation_instruction->po_number; ?></span>
<span class="displaynon" id="formvalidation_po_number_exist"><?php if (isset($form_validation_instruction->po_number_exist)) echo $form_validation_instruction->po_number_exist; ?></span>
<span class="displaynon" id="user_email_phone_exist"><?php if (isset($general_instruction->user_email_phone_exist)) echo $general_instruction->user_email_phone_exist; ?></span>

<span class="displaynon" id="formvalidation_po_file"><?php if (isset($form_validation_instruction->po_file)) echo $form_validation_instruction->po_file; ?></span>
<span class="displaynon" id="formvalidation_edi_one"><?php if (isset($form_validation_instruction->edi_one)) echo $form_validation_instruction->edi_one; ?></span>
<span class="displaynon" id="formvalidation_edi_two"><?php if (isset($form_validation_instruction->edi_two)) echo $form_validation_instruction->edi_two; ?></span>
<span class="displaynon" id="validation_ajax_text"><?php if (isset($general_instruction->validation_ajax_text)) echo $general_instruction->validation_ajax_text; ?></span>


<!--Modal user block popup start-->
<?php $this->load->view('elements/popup/user_block_box'); ?>
<!--Modal user block popup end-->

<!--Modal user cart shopping session timeout block popup start-->
<?php $this->load->view('elements/popup/user_shopping_timeout_popup'); ?>
<!--Modal user cart shopping session timeout block popup end-->

<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">
<input type="hidden" id="cud_cart_state" value="<?php if (isset($cart_users_data['cart_state'])) {
                                                    echo  $cart_users_data['cart_state'];
                                                } else if (isset($ip_data['regionCode'])) {
                                                    echo $ip_data['regionCode'];
                                                } else {
                                                    echo "";
                                                } ?>">
<input type="hidden" id="cud_ship_state" value="<?php if (isset($cart_users_data['ship_state'])) {
                                                    echo  $cart_users_data['ship_state'];
                                                } else if (isset($ip_data['regionCode'])) {
                                                    echo $ip_data['regionCode'];
                                                } else {
                                                    echo "";
                                                } ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">
<input type="hidden" id="ip_country" value="<?php echo $ip_data['countryCode']; ?>">
<input type="hidden" id="ip_state" value="<?php echo $ip_data['regionCode']; ?>">
<input type="hidden" id="store_country" value="<?php echo !empty($this->config->item('store_country')) ? $this->config->item('store_country') : ''; ?>">
<input type="hidden" id="tax_applicable" value="<?php echo !empty($this->config->item('tax_applicable')) ? $this->config->item('tax_applicable') : 0; ?>">
<input type="hidden" id="shipping_opt" value="<?php echo $this->config->item('shipping_incoterm_options'); ?>">
<input type="hidden" id="package_both_box_count" value="<?php echo $package_both_box_count; ?>">



