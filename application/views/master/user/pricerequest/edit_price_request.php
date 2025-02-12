<?php $comingsoon = getNoImage('coming-soon');



?>

<div class="mainContent px-3 px-lg-5">
    <?php $this->load->view('elements/body_logo'); ?>



    <div class="my-account-area py-3 py-sm-5">
        <div class="container">
            <div class="row">
                <!-- user dahboard sidebar-->
                <?php $this->load->view('elements/userdashboard-sidebar'); ?>
                <div class="col-12 col-md-9">
                    <div class="my-account-content mb-50 h-100">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url() . $lang_id . '/'; ?>user/save_profile_data" id="cart_details_form" enctype="multipart/form-data">
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
                                            <div class="col-md-12">
                                                <div class="form-group  billingShippingcheck float-start w-100 mb-3">
                                                    <label for="cart_surname" class="billing-details center control-label"><?php echo $cart_instruction->billing_details_same_shipping_details_text; ?><span class="cart_asterisk">*</span></label>
                                                    <div class="col-sm-5">
                                                        <?php
                                                        $yes_checked = "";
                                                        $no_checked = "";

                                                        if (isset($loginuserdata['billing_shipping_selection'])) {
                                                            if ($billing_info_check == 1 || $loginuserdata['billing_shipping_selection'] == 1) {
                                                                $yes_checked = "checked";
                                                            } else {
                                                                $no_checked = "checked";
                                                            }
                                                        } else if ($billing_info_check == 1) {
                                                            $yes_checked = "checked";
                                                        } ?>
                                                        <div class="form-check form-check-inline radio-inline p-0 position-relative">
                                                            <input class="billing_to_shipping_class required_input" type="radio" id="radio1" name="billingShippingoptradio" value="1" <?php echo $yes_checked; ?>>
                                                            <label for="radio1" class="text-dark">
                                                                <?php echo $cart_instruction->billing_details_same_shipping_details_text_yes; ?>
                                                            </label>
                                                        </div>

                                                        <div class="form-check form-check-inline radio-inline p-0 position-relative">
                                                            <input class="billing_to_shipping_class required_input" id="radio2" type="radio" name="billingShippingoptradio" value="0" <?php echo $no_checked; ?>>
                                                            <label for="radio2" class="text-dark">
                                                                <?php echo $cart_instruction->billing_details_same_shipping_details_text_no; ?>
                                                            </label>
                                                        </div>
                                                        <p class="help-block blink_error"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="cart-form-grid float-start w-100">

                                            <div class="col-lg-12 float-start w-100" id="hide_billing_details">

                                                <h4><?php echo $cart_instruction->billing_details_text; ?></h4>
                                                <div class="form-group float-start w-100 mb-3">
                                                    <label for="salutation" class="col-sm-12 control-label"><?php echo $cart_instruction->title; ?>
                                                        <span class="cart_asterisk">*</span></label>
                                                    <?php
                                                    if (isset($front_validuser_data['applicant']) && $front_validuser_data['applicant'] != '') {
                                                        $title = $front_validuser_data['applicant'];
                                                        $front_validuser_data1['applicant'] = explode(" ", $title);
                                                        $front_validuser_data1['applicant'] = $front_validuser_data1['applicant'][0];
                                                    } else {
                                                        $front_validuser_data1['applicant'] = '';
                                                    }


                                                    if (isset($loginuserdata['user_name']) && $loginuserdata['user_name'] != '') {
                                                        $title = $loginuserdata['user_name'];
                                                        $loginuserdata['user_name'] = explode(" ", $title);
                                                        $loginuserdata['user_name'] = $loginuserdata['user_name'][0];
                                                    } else {
                                                        $loginuserdata['user_name'] = '';
                                                    }


                                                    ?>
                                                    <div class="col-lg-12">
                                                        <!--    <select name="salutation" id="salutation" class="form-control selectpicker1 kgt2">
                                                            <option value='<?php echo $cart_instruction->mr_title; ?>' data-title="<?php echo $cart_instruction->mr_title; ?>" <?php if ($loginuserdata['user_name'] == $cart_instruction->mr_title) { ?> selected="selected"<?php } ?>>
                                                            <?php echo $cart_instruction->mr_title; ?>
                                                            </option>
                                                            <option value='<?php echo $cart_instruction->ms_title; ?>' data-title="<?php echo $cart_instruction->ms_title; ?>" <?php if ($loginuserdata['user_name'] == $cart_instruction->ms_title) { ?> selected="selected"<?php } ?>>
                                                            <?php echo $cart_instruction->ms_title; ?>
                                                            </option>
                                                            </select> -->
                                                        <span class="position-relative">
                                                            <input id="radio11" type="radio" class="required_input" name="salutation" value="Mr." <?php if ($loginuserdata['salutation'] == 'Mr.') { ?> checked="checked" <?php } ?> />
                                                            <label class="text-dark" for="radio11"><?php echo $cart_instruction->mr_title; ?></label>
                                                        </span>
                                                        <span class="position-relative">
                                                            <input id="radio12" type="radio" class="required_input" name="salutation" value="Miss." <?php if ($loginuserdata['salutation'] == 'Miss.') { ?> checked="checked" <?php } ?> />
                                                            <label class="text-dark" for="radio12"><?php echo $cart_instruction->ms_title; ?></label>
                                                        </span>
                                                        <span class="position-relative">
                                                            <input id="radio13" type="radio" class="required_input" name="salutation" value="Other" <?php if ($loginuserdata['salutation'] == 'Other') { ?> checked="checked" <?php } ?> />
                                                            <label class="text-dark" for="radio13"><?php echo $cart_instruction->other_title; ?></label>
                                                        </span>

                                                    </div>
                                                    <p class="help-block blink_error"></p>
                                                </div>
                                                <div class="formGrid d-grid gap-3 grid-col-2">

                                                    <div class="form-group float-start w-100 mb-3">
                                                        <label for="customer_no" class="w-100 float-start control-label"><?php echo $cart_instruction->customer_no; ?></label>
                                                        <div class="col-lg-12">
                                                            <?php echo isset($loginuserdata['customer_no']) ? $loginuserdata['customer_no'] : ''; ?> </div>
                                                    </div>
                                                    <div class="form-group float-start w-100 mb-3">
                                                        <label for="cart_company" class="w-100 float-start control-label"><?php echo $cart_instruction->company; ?></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control" id="cart_company" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->company); ?>" name="company" value="<?php echo isset($loginuserdata['company']) ? $loginuserdata['company'] : '' ?>">
                                                        </div>
                                                    </div>


                                                    <div class="form-group float-start w-100">
                                                        <label for="cart_surname" class="col-sm-12 left control-label"><?php echo $cart_instruction->name_surname; ?>
                                                            <span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control  required_input" id="cart_surname" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->name_surname); ?>" name="surname" value="<?php echo isset($loginuserdata['surname']) ? $loginuserdata['surname'] : ''; ?>" required>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <!--    <div class="form-group float-start w-100">
                                                            <label for="cart_designation" class="col-sm-12 control-label"><?php echo $cart_instruction->designation; ?></label>
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" id="cart_designation" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->designation); ?>"
                                                                        name="designation"
                                                                        value="<?php echo isset($loginuserdata['designation']) ? $loginuserdata['designation'] : '' ?>"
                                                                        required >
                                                            </div>
                                                        </div> -->
                                                    <div class="form-group float-start w-100">
                                                        <label for="cart_email" class="col-sm-12 control-label"><?php echo $cart_instruction->email; ?>
                                                            <span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <?php if ($cart_email_confirm != 1) { ?>
                                                                <input type="text" class="form-control required_input email_validate" id="cart_email" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->email); ?>" name="email" value="<?php if (isset($loginuserdata['email'])) {
                                                                                                                                                                                                                                                                    echo  $loginuserdata['email'];
                                                                                                                                                                                                                                                                } else if (isset($front_validuser_data['email'])) {
                                                                                                                                                                                                                                                                    $front_validuser_data['email'];
                                                                                                                                                                                                                                                                } ?>" required>
                                                            <?php } else { ?>
                                                                <input type="text" class="form-control required_input email_validate" id="cart_email" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->email); ?>" value="<?php if (isset($loginuserdata['email'])) {
                                                                                                                                                                                                                                                        echo  $loginuserdata['email'];
                                                                                                                                                                                                                                                    } else if (isset($front_validuser_data['email'])) {
                                                                                                                                                                                                                                                        $front_validuser_data['email'];
                                                                                                                                                                                                                                                    } ?>" required readonly>
                                                            <?php } ?>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>
                                                    <div class="form-group float-start w-100">
                                                        <label for="cart_country" class="col-sm-12 control-label"><?php echo $cart_instruction->country; ?>
                                                            <span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12 position-relative" id="popupboxcountrywrap">
                                                            <?php if (isset($loginuserdata['country'])) {
                                                                $cart_users_country = $loginuserdata['country'];
                                                            } else if (isset($front_validuser_data['country'])) {
                                                                $cart_users_country = $front_validuser_data['country'];
                                                            } ?>
                                                            <select autocomplete="no-fill" name="country" id="cart_country" class="form-control selectpicker1 kgt2 required_input">
                                                                <?php foreach ($countries as $country) { ?>
                                                                    <option value='<?php echo htmlentities($country['countryName'], ENT_QUOTES); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" <?php if (isset($cart_users_country) && $cart_users_country != '' && $cart_users_country == $country['lang_countryName']) { ?>selected="selected" <?php } else if (isset($cart_users_country) && $cart_users_country != '' && $cart_users_country == $country['countryName']) { ?>selected="selected" <?php } else if (isset($country['countryName']) && $country['countryName'] == "Canada") { ?> selected="selected" <?php } else if ($country['lang_countryName'] == "Canada") { ?>selected="selected" <?php } ?>>
                                                                        <?php echo $country['countryName']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <input type="hidden" name="cart_country_flag" id="cart_country_flag" value="<?= isset($loginuserdata['ship_country_shortcode']) ? $loginuserdata['ship_country_shortcode'] : 'ca'; ?>" />
                                                    <div class="form-group float-start w-100">
                                                        <label for="cart_telephone" class="col-sm-12 control-label"><?php echo $cart_instruction->cellphone; ?>
                                                            <span class="cart_asterisk">*</span>
                                                        </label>
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-3 col-lg-3 country_code_div">
                                                                <input type="text" class="form-control required_input numeric_input" id="cart_country_code" placeholder="+1" name="country_code" value="+<?php if (isset($loginuserdata['country_code']) && $loginuserdata['country_code']) {
                                                                                                                                                                                                                echo $loginuserdata['country_code'];
                                                                                                                                                                                                            } else if (isset($front_validuser_data['country_code']) && $front_validuser_data['country_code']) {
                                                                                                                                                                                                                echo $front_validuser_data['country_code'];
                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                echo '1';
                                                                                                                                                                                                            } ?>" required autocomplete="no-fill" readonly>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-9 col-lg-9">
                                                                <?php if ($cart_sms_confirm != 1) { ?>
                                                                    <input type="text" class="form-control required_input numeric_input" id="cart_telephone" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->cellphone); ?>" name="telephone" value="<?php if (isset($loginuserdata['telephone'])) {
                                                                                                                                                                                                                                                                                    echo  $loginuserdata['telephone'];
                                                                                                                                                                                                                                                                                } else if (isset($front_validuser_data['telephone'])) {
                                                                                                                                                                                                                                                                                    $front_validuser_data['telephone'];
                                                                                                                                                                                                                                                                                } ?>" required onkeypress="return isNumber(event)">
                                                                <?php } else { ?>
                                                                    <input type="text" class="form-control required_input numeric_input" id="cart_telephone" placeholder="cellphone" value="<?php if (isset($loginuserdata['telephone'])) {
                                                                                                                                                                                                echo  $loginuserdata['telephone'];
                                                                                                                                                                                            } else if (isset($front_validuser_data['telephone'])) {
                                                                                                                                                                                                $front_validuser_data['telephone'];
                                                                                                                                                                                            } ?>" required readonly>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <div class="form-group float-start w-100">
                                                        <label for="address_1" class="col-sm-12 control-label"><?php echo $cart_instruction->address_1; ?>
                                                            <span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control required_input" id="cart_address_1" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->address_1); ?>" name="cart_address_1" value="<?php echo isset($loginuserdata['cart_address_1']) ? $loginuserdata['cart_address_1'] : '' ?>">
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <div class="form-group float-start w-100">
                                                        <label for="address_2" class="col-sm-12 control-label"><?php echo $cart_instruction->address_2; ?></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control" id="cart_address_2" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->address_2); ?>" name="cart_address_2" value="<?php echo isset($loginuserdata['cart_address_2']) ? $loginuserdata['cart_address_2'] : '' ?>">
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <div class="form-group float-start w-100">
                                                        <label for="address_3" class="col-sm-12 control-label"><?php echo $cart_instruction->address_3; ?></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control" id="cart_address_3" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->address_3); ?>" name="cart_address_3" value="<?php echo isset($loginuserdata['cart_address_3']) ? $loginuserdata['cart_address_3'] : '' ?>">
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <div class="form-group float-start w-100">
                                                        <label for="cart_city" class="col-sm-12 control-label"><?php echo $cart_instruction->city; ?><span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control required_input" id="cart_city" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->city); ?>" name="cart_city" value="<?php echo isset($loginuserdata['cart_city']) ? $loginuserdata['cart_city'] : '' ?>" required>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <?php if ($cart_email_confirm == 1) { ?>
                                                        <input type="hidden" name="email" value="<?php if (count($loginuserdata) > 0) echo isset($loginuserdata['email']) ? $loginuserdata['email'] : $front_validuser_data['email'] ?>">
                                                    <?php } ?>

                                                    <?php if ($cart_sms_confirm == 1) { ?>
                                                        <input type="hidden" name="telephone" value="<?php echo isset($loginuserdata['telephone']) ? $loginuserdata['telephone'] : $front_validuser_data['telephone'] ?>">
                                                    <?php } ?>

                                                    <!--    <div class="form-group float-start w-100">
                                                            <label for="cart_address" class="col-sm-12 control-label"><?php echo $cart_instruction->state; ?></label>
                                                            <div class="col-lg-12">
                                                            <input type="text" class="form-control" id="cart_state" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->state); ?>" name="cart_state" value="<?php echo isset($loginuserdata['cart_state']) ? $loginuserdata['cart_state'] : '' ?>" required >
                                                            </div>
                                                        </div> -->

                                                    <div class="form-group float-start w-100">
                                                        <label for="cart_state" class="col-sm-12 control-label"><?php echo $cart_instruction->state; ?>
                                                            <span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12" id="cart-state">
                                                            <select name="cart_state" id="cart-state-list" class="form-control kgt2 rounded required_input">
                                                            </select>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <div class="form-group float-start w-100">
                                                        <label for="cart_zip" class="col-sm-12 control-label"><?php echo $cart_instruction->zip; ?><span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control required_input" id="cart_zip" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->zip); ?>" name="cart_zip" value="<?php echo isset($loginuserdata['cart_zip']) ? $loginuserdata['cart_zip'] : '' ?>" required>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>


                                                    <!----------   -->
                                                <?php    if($this->config->item('show_products_input') == "1") { ?>
                                                    <div class="form-group float-start w-100">
                                                        <label for="signup_category" class="col-sm-12 control-label"><?php echo $cart_instruction->signup_category; ?><span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control required_input" id="signup_category" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_category); ?>" name="signup_category" value="<?php echo isset($loginuserdata['signup_category']) ? $loginuserdata['signup_category'] : '' ?>" required>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <div class="form-group float-start w-100">
                                                        <label for="signup_maker" class="col-sm-12 control-label"><?php echo $cart_instruction->signup_maker; ?><span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control required_input" id="signup_maker" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_maker); ?>" name="signup_maker" value="<?php echo isset($loginuserdata['signup_maker']) ? $loginuserdata['signup_maker'] : '' ?>" required>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>
                                                    <div class="form-group float-start w-100">
                                                        <label for="signup_model" class="col-sm-12 control-label"><?php echo $cart_instruction->signup_model; ?><span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control required_input" id="signup_model" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_model); ?>" name="signup_model" value="<?php echo isset($loginuserdata['signup_model']) ? $loginuserdata['signup_model'] : '' ?>" required>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>
                                                    <div class="form-group float-start w-100">
                                                        <label for="signup_group" class="col-sm-12 control-label"><?php echo $cart_instruction->signup_group; ?><span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control required_input" id="signup_group" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_group); ?>" name="signup_group" value="<?php echo isset($loginuserdata['signup_group']) ? $loginuserdata['signup_group'] : '' ?>" required>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>
                                                 
                                                   
                                                    <div class="form-group float-start w-100">
                                                        <label for="signup_year" class="col-sm-12 control-label"><?php echo $cart_instruction->signup_year; ?><span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control required_input" id="signup_year" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_year); ?>" name="signup_year" value="<?php echo isset($loginuserdata['signup_year']) ? $loginuserdata['signup_year'] : '' ?>" required>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>
                                                    <div class="form-group float-start w-100">
                                                        <label for="signup_engine" class="col-sm-12 control-label"><?php echo $cart_instruction->signup_engine; ?><span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control required_input" id="signup_engine" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_engine); ?>" name="signup_engine" value="<?php echo isset($loginuserdata['signup_engine']) ? $loginuserdata['signup_engine'] : '' ?>" required>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>


                                                    <div class="form-group float-start w-100">
                                                        <label for="signup_vn" class="col-sm-12 control-label"><?php echo $cart_instruction->signup_vn; ?><span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control required_input" id="signup_vn" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_vn); ?>" name="signup_vn" value="<?php echo isset($loginuserdata['signup_vn']) ? $loginuserdata['signup_vn'] : '' ?>" required>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <!---   -->
<?php } ?>
                            

                                                    <div class="form-group float-start w-100">
                                                        <label for="edi_one" class="col-sm-12 control-label"><?php echo $cart_instruction->edi_one; ?></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control" id="edi_one" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->edi_one); ?>" name="edi_one" value="<?php echo isset($loginuserdata['edi_one']) ? $loginuserdata['edi_one'] : '' ?>" >
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="float-start w-100">
                                                    <div class="form-group float-start w-100">
                                                        <label for="client_logo" class="col-sm-12 control-label"><?php echo $cart_instruction->client_logo; ?></label>
                                                        <div class="col-lg-12">
                                                            <div class="w-100">
                                                                <span class="customFileInput position-relative d-inline-block overflow-hidden">
                                                                    <span class="btn actn-btn rounded inputfilebtn"><?php echo $cart_instruction->choose_file; ?></span>
                                                                    <input id="client_logo_img" name="client_logo" class="focustip span12 inputfile" type="file">
                                                                    <input type="hidden" name="client_logo_exist" class="client_logo_exist" value="<?php echo (isset($loginuserdata['client_logo']) && $loginuserdata['client_logo']) ? 1 : 0; ?>">
                                                                </span>
                                                            </div>
                                                            <div class="col-12 float-start w-100">
                                                                <?php if (isset($loginuserdata['client_logo']) && $loginuserdata['client_logo'] != "") {
                                                                    $src = base_url() . 'assets/uploads/cart/' . $loginuserdata['client_logo']; ?>
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
                                                        <p class="help-block" style="<?php if (isset($loginuserdata['client_logo']) && $loginuserdata['client_logo'] != "") {
                                                                                            echo 'display:none;';
                                                                                        } ?>"><?php echo $form_validation_instruction->client_logo; ?></p>
                                                    </div>

                                                    <!--<br />
                                                        <input type="checkbox" id="billing_to_shipping" /> <?php echo $cart_instruction->billing_details_same_shipping_details_text; ?>
                                                        <br /> -->

                                                    <h4 style="padding-top:25px;"><?php echo $cart_instruction->carrier_details_text; ?></h4>
                                                </div>
                                                <div class="formGrid d-grid gap-3 grid-col-2">

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
                                                            <span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12" style="margin-top:10px;">
                                                            <?php if ($this->config->item('shipping_incoterm_options') == 'exw' || $this->config->item('shipping_incoterm_options') == 'both') { ?>
                                                                <span class="exw position-relative">
                                                                    <span class="position-relative">
                                                                        <input id="radio15" type="radio" name="incoterms" value="<?php echo 'EXW'; ?>" <?php if (isset($loginuserdata['incoterms']) && $loginuserdata['incoterms'] == 'EXW') {
                                                                                                                                                            echo "checked=checked";
                                                                                                                                                        } ?> class="required_input" />
                                                                        <label class="text-dark" for="radio15"><?php echo $cart_instruction->EXW; ?></label>
                                                                    </span>
                                                                    &nbsp;&nbsp;<i style="cursor:pointer;" id="qexw_desc" class="fa fa-question-circle" aria-hidden="true"></i>
                                                                </span>

                                                            <?php } ?>
                                                            <?php if ($this->config->item('shipping_incoterm_options') == 'dap' || $this->config->item('shipping_incoterm_options') == 'both') { ?>
                                                                <span class="dap mx-4 position-relative">
                                                                    <span class="position-relative">
                                                                        <input type="radio" id="radio16" name="incoterms" value="<?php echo 'DAP'; ?>" <?php if (isset($loginuserdata['incoterms']) && $loginuserdata['incoterms'] == 'DAP') {
                                                                                                                                                            echo "checked=checked";
                                                                                                                                                        } ?> class="required_input" />
                                                                        <label class="text-dark" for="radio16">
                                                                            <?php echo $cart_instruction->DAP; ?>
                                                                        </label>
                                                                    </span>
                                                                    &nbsp;&nbsp;<i style="cursor:pointer;" id="qdap_desc" class="fa fa-question-circle" aria-hidden="true"></i>
                                                                </span>


                                                            <?php } ?>
                                                        </div>
                                                        <p class="help-block"></p>

                                                        <div class="form-group float-start w-100">
                                                            <div class="col-lg-12">
                                                                <p style="display:none;" id="exw_desc"><?php echo $cart_instruction->exw_description; ?></p>
                                                                <p style="display:none;" id="dap_desc"><?php echo $cart_instruction->dap_description; ?></p>
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

                                                    <div class="form-group float-start w-100 carrier_name_divs" <?php if ($loginuserdata['incoterms'] != "EXW") { ?> style="display:none;" <?php } ?>>
                                                        <?php $carrier_name = isset($loginuserdata['carrier_name']) ? $loginuserdata['carrier_name'] : ''; ?>
                                                        <label for="carrier_name" class="col-sm-12 control-label"><?php echo $cart_instruction->carrier_name; ?>
                                                            <span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control <?php if ($loginuserdata['incoterms'] == "EXW") {
                                                                                                        echo 'required_input';
                                                                                                    } ?>" id="carrier_name_input" name="carrier_name" value="<?php echo $carrier_name; ?>">
                                                        </div>
                                                        <p class="help-block"></p>

                                                    </div>

                                                    <div class="form-group float-start w-100 carrier_name_divs" <?php if ($loginuserdata['incoterms'] != "EXW") { ?> style="display:none;" <?php } ?>>

                                                        <label for="carrier_account_number" class="col-sm-12 control-label"><?php echo $cart_instruction->carrier_account_number; ?>
                                                            <span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control <?php if ($loginuserdata['incoterms'] == "EXW") {
                                                                                                        echo 'required_input';
                                                                                                    } ?>" id="carrier_account_number" name="carrier_account_number" value="<?php echo isset($loginuserdata['carrier_account_number']) ? $loginuserdata['carrier_account_number'] : ""; ?>">

                                                        </div>
                                                        <p class="help-block"></p>

                                                    </div>



                                                </div>

                                                <div class="formGrid d-grid gap-3 grid-col-2">
                                                    <div class="form-group float-start w-100" id="tax_exoneration">
                                                        <label for="tax_exoneration" class="col-sm-12 control-label"><?php echo $cart_instruction->tax_exoneration; ?>
                                                            <span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12 mt-2">
                                                            <span class="position-relative">
                                                                <input type="radio" id="radio17" class="required_input" style="margin-top: 8px;" name="tax_exoneration" value="1" <?php if (isset($loginuserdata['tax_exoneration']) && $loginuserdata['tax_exoneration'] == 1) {
                                                                                                                                                                                        echo "checked=checked";
                                                                                                                                                                                    } ?>>
                                                                <label class="text-dark" for="radio17"> <?php echo $cart_instruction->yes; ?></label>
                                                            </span>

                                                            <span class="position-relative px-3">
                                                                <input type="radio" id="radio18" class="required_input" style="margin-top: 8px;" name="tax_exoneration" value="0" <?php if (isset($loginuserdata['tax_exoneration']) && $loginuserdata['tax_exoneration'] == 0) {
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
                                                            <input type="text" class="form-control" id="tax_exoneration_number_value" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->tax_exoneration_number); ?>" name="tax_exoneration_number" value="<?php echo isset($loginuserdata['tax_exoneration_number']) ? $loginuserdata['tax_exoneration_number'] : ""; ?>">
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
                                                                    <input type="hidden" class="tax_file_exist" value="<?php echo isset($loginuserdata['tax_exoneration_file']) ? 1 : 0; ?>">
                                                                </span>
                                                            </div>
                                                            <?php if (isset($loginuserdata['tax_exoneration_file']) && $loginuserdata['tax_exoneration_file'] != "") {
                                                                $src = base_url() . 'assets/uploads/cart/' . $loginuserdata['tax_exoneration_file'];
                                                                $ext = pathinfo($loginuserdata['tax_exoneration_file'], PATHINFO_EXTENSION);
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
                                            </div>

                                            <div class="col-lg-12 float-start w-100" id="show_shipping_details_div">


                                                <h4><?php echo $cart_instruction->shipping_details_text; ?></h4>
                                                <div class="formGrid d-grid gap-3 grid-col-2">
                                                    <div class="form-group float-start w-100 mb-3">
                                                        <label for="salutation" class="col-sm-12 left control-label"><?php echo $cart_instruction->ship_title; ?>
                                                            <span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12" style="margin-top: 8px;">
                                                            <span class="position-relative">
                                                                <input type="radio" id="radio19" class="required_input" name="ship_title" value="Mr." <?php if (isset($loginuserdata['ship_title']) && $loginuserdata['ship_title'] == 'Mr.') {
                                                                                                                                                            echo "checked=checked";
                                                                                                                                                        } ?> />
                                                                <label class="text-dark" for="radio19"><?php echo $cart_instruction->mr_title; ?></label>
                                                            </span>

                                                            <span class="position-relative">
                                                                <input type="radio" id="radio20" class="required_input" name="ship_title" value="Miss." <?php if (isset($loginuserdata['ship_title']) && $loginuserdata['ship_title'] == 'Miss.') {
                                                                                                                                                            echo "checked=checked";
                                                                                                                                                        } ?> />
                                                                <label class="text-dark" for="radio20"> <?php echo $cart_instruction->ms_title; ?></label>
                                                            </span>

                                                            <span class="position-relative">
                                                                <input type="radio" id="radio21" class="required_input" name="ship_title" value="Other" <?php if (isset($loginuserdata['ship_title']) && $loginuserdata['ship_title'] == 'Other') {
                                                                                                                                                            echo "checked=checked";
                                                                                                                                                        } ?> /><label class="text-dark" for="radio21"><?php echo $cart_instruction->other_title; ?></label>
                                                            </span>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <div class="form-group float-start w-100">
                                                        <label for="ship_company" class="col-sm-12 control-label"><?php echo $cart_instruction->ship_company; ?></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control" id="ship_company" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_company); ?>" name="ship_company" value="<?php echo isset($loginuserdata['ship_company']) ? $loginuserdata['ship_company'] : '' ?>">
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <div class="form-group float-start w-100">
                                                        <label for="ship_fullname" class="col-sm-12 left control-label"><?php echo $cart_instruction->ship_fullname; ?>
                                                            <span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control required_input" id="ship_surname" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_fullname); ?>" name="ship_surname" value="<?php echo isset($loginuserdata['ship_surname']) ? $loginuserdata['ship_surname'] : '' ?>" required>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <div class="form-group float-start w-100">
                                                        <label for="ship_email" class="col-sm-12 control-label"><?php echo $cart_instruction->ship_email; ?>
                                                            <span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control required_input email_validate" id="ship_email" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_email); ?>" name="ship_email" value="<?php if (isset($loginuserdata)) echo isset($loginuserdata['ship_email']) ? $loginuserdata['ship_email'] : '' ?>" required>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <div class="form-group float-start w-100">
                                                        <label for="ship_country" class="col-sm-12 control-label"><?php echo $cart_instruction->ship_country; ?>
                                                            <span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12 position-relative" id="popupboxcountrywrap">
                                                            <?php $cart_users_country = isset($loginuserdata['ship_country']) ? $loginuserdata['ship_country'] : ''; ?>
                                                            <select autocomplete="no-fill" name="ship_country" id="ship_country" class="form-control selectpicker1 kgt2 required_input">

                                                                <?php foreach ($countries as $country) { ?>
                                                                    <option value='<?php echo htmlentities($country['countryName'], ENT_QUOTES); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" <?php if (isset($cart_users_country) && $cart_users_country != '' && $cart_users_country == $country['lang_countryName']) { ?>selected="selected" <?php } else if (isset($cart_users_country) && $cart_users_country != '' && $cart_users_country == $country['countryName']) { ?>selected="selected" <?php } else if (isset($country['countryName']) && $country['countryName'] == "Canada") { ?> selected="selected" <?php } else if ($country['lang_countryName'] == "Canada") { ?>selected="selected" <?php } ?>>
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
                                                                <input type="text" class="form-control required_input" id="ship_country_code" placeholder="+1" name="ship_country_code" value="<?php echo isset($loginuserdata['ship_country_code']) ? $loginuserdata['ship_country_code'] : '1' ?>" required readonly autocomplete="no-fill">
                                                            </div>
                                                            <div class="col-xs-12 col-sm-9 col-lg-9">
                                                                <input type="text" class="form-control required_input numeric_input" id="ship_telephone" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_cellphone); ?>" name="ship_telephone" value="<?php echo isset($loginuserdata['ship_telephone']) ? $loginuserdata['ship_telephone'] : '' ?>" required onkeypress="return isNumber(event)">
                                                            </div>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <div class="form-group float-start w-100">
                                                        <label for="ship_address_1" class="col-sm-12 control-label"><?php echo $cart_instruction->ship_address_1; ?>
                                                            <span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control required_input" id="ship_address_1" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_address_1); ?>" name="ship_address_1" value="<?php echo isset($loginuserdata['ship_address_1']) ? $loginuserdata['ship_address_1'] : '' ?>">
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <div class="form-group float-start w-100">
                                                        <label for="ship_address_2" class="col-sm-12 control-label"><?php echo $cart_instruction->ship_address_2; ?></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control" id="ship_address_2" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_address_2); ?>" name="ship_address_2" value="<?php echo isset($loginuserdata['ship_address_2']) ? $loginuserdata['ship_address_2'] : '' ?>">
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <div class="form-group float-start w-100">
                                                        <label for="ship_address_3" class="col-sm-12 control-label"><?php echo $cart_instruction->ship_address_3; ?></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control" id="ship_address_3" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_address_3); ?>" name="ship_address_3" value="<?php echo isset($loginuserdata['ship_address_3']) ? $loginuserdata['ship_address_3'] : '' ?>">
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>

                                                    <div class="form-group float-start w-100">
                                                        <label for="ship_city" class="col-sm-12 control-label"><?php echo $cart_instruction->ship_city; ?>
                                                            <span class="cart_asterisk">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control required_input" id="ship_city" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_city); ?>" name="ship_city" value="<?php echo isset($loginuserdata['ship_city']) ? $loginuserdata['ship_city'] : '' ?>">
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
                                                            <input type="text" class="form-control required_input" id="ship_zip" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->ship_zip); ?>" name="ship_zip" value="<?php echo isset($loginuserdata['ship_zip']) ? $loginuserdata['ship_zip'] : '' ?>">
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>
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
                                <?php if (!empty($cart_details)) { ?>
                                    <div class="nav-prex-next text-right removebuttons" id="cart_buttons">
                                        <a href="<?php echo base_url() . $lang_id . '/products/product_list'; ?>" class="btn  actn-btn rounded" id="cart_back"><?php echo $general_instruction->back; ?></a>
                                        <a href="<?php echo base_url() . $lang_id . '/products'; ?>" class="btn  actn-btn rounded" id="cart_continue_shopping_header"><?php echo $general_instruction->continue_and_submit; ?></a>
                                        <a href="javascript:void(0)" class="btn  actn-btn rounded" id="cart_checkout"><?php echo $general_instruction->sbmt; ?></a>
                                    </div>
                                <?php } ?>
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

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 s_button sticky_bottom productBtnsFixedBottom py-2 py-md-3 px-3 px-md-5" style="display: none;">
    <div class="nav-prex-next sticky_button_next d-flex flex-wrap align-items-center justify-content-between w-100" id="cart_buttons">
        <div class="productActionBtns d-flex align-items-center w-100 justify-content-end">
            <a href="javascript:void(0)" class="btn  actn-btn rounded" id="signup_footer"><?php echo $general_instruction->sbmt; ?></a>
        </div>
    </div>
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

<!--  -->

<span class="displaynon" id="formvalidation_signup_category"><?php if (isset($form_validation_instruction->signup_category)) echo $form_validation_instruction->signup_category; ?></span>

<span class="displaynon" id="formvalidation_signup_maker"><?php if (isset($form_validation_instruction->signup_maker)) echo $form_validation_instruction->signup_maker; ?></span>

<span class="displaynon" id="formvalidation_signup_model"><?php if (isset($form_validation_instruction->signup_model)) echo $form_validation_instruction->signup_model; ?></span>

<span class="displaynon" id="formvalidation_signup_group"><?php if (isset($form_validation_instruction->signup_group)) echo $form_validation_instruction->signup_group; ?></span>

<span class="displaynon" id="formvalidation_signup_year"><?php if (isset($form_validation_instruction->signup_year)) echo $form_validation_instruction->signup_year; ?></span>

<span class="displaynon" id="formvalidation_signup_engine"><?php if (isset($form_validation_instruction->signup_engine)) echo $form_validation_instruction->signup_engine; ?></span>

<span class="displaynon" id="formvalidation_signup_vn"><?php if (isset($form_validation_instruction->signup_vn)) echo $form_validation_instruction->signup_vn; ?></span>


<!--    -->
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