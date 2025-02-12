<div class="content zerorightmargin">
    <?php if ($this->session->flashdata('success')) {
    $msg = $this->session->flashdata('success');?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?>
            </div>
        </div>
    <?php }?>

    <?php if ($this->session->flashdata('error')) {
    $msg = $this->session->flashdata('error');?>
        <div class="notice outer">
            <div class="error"><?php echo $msg; ?>
            </div>
        </div>
    <?php }?>
    <?php $noimage = getNoImage('no_image');?>

    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <div class="body">
                    <div class="container">
                        <form id="front_user_form" action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/users/save_users_data" name="front_user_form" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set" />
                            <input type="hidden" id="delimageid" value="<?php echo isset($edit_data['id']) ? $edit_data['id'] : ''; ?>" />
                            <div class="span12">
                                <div class="block well">
                                    <div class="navbar">
                                        <div class="navbar-inner">
                                            <h5> <?=isset($edit_data['id']) ? $admin_products['edit_front_users']['front'] : $admin_products['add_front_users']['front'];?></h5>
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->title; ?>:</label>
                                        <div class="controls">
                                            <div class="col-lg-12">
                                                <span class="position-relative">
                                                    <input id="radio11" type="radio" class="required_input" name="salutation" value="Mr." <?php if (isset($edit_data['salutation']) && $edit_data['salutation'] == "Mr.") {
    echo "checked";
}?> />
                                                    <label class="text-dark" for="radio11"><?php echo $cart_instruction->mr_title; ?></label>
                                                </span>
                                                <span class="position-relative">
                                                    <input id="radio12" type="radio" class="required_input" name="salutation" value="Miss." <?php if (isset($edit_data['salutation']) && $edit_data['salutation'] == "Miss.") {
    echo "checked";
}?> />
                                                    <label class="text-dark" for="radio12"><?php echo $cart_instruction->ms_title; ?></label>
                                                </span>
                                                <span class="position-relative">
                                                    <input id="radio13" type="radio" class="required_input" name="salutation" value="Other" <?php if (isset($edit_data['salutation']) && $edit_data['salutation'] == "Other") {
    echo "checked";
}?> />
                                                    <label class="text-dark" for="radio13"><?php echo $cart_instruction->other_title; ?></label>
                                                </span>
                                            </div>
                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->company; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" id="cart_company" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->company); ?>" name="company" value="<?php echo isset($edit_data['company']) ? $edit_data['company'] : ''; ?>">
                                            <input type="hidden" id="user_id" name="user_id" value="<?php echo isset($edit_data['id']) ? $edit_data['id'] : ''; ?>">

                                        </div>

                                        <p class="red1 help-block"></p>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->customer_no; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control required_input" id="customer_no" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->customer_no); ?>" name="customer_no" value="<?php echo isset($edit_data['customer_no']) ? $edit_data['customer_no'] : ''; ?>">
                                            <input type="hidden" class="form-control" id="inv_customer_no" name="inv_customer_no" value="0">

                                        </div>

                                        <p class="red1 help-block"></p>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->name_surname; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control required_input" id="cart_surname" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->name_surname); ?>" name="surname" value="<?php echo isset($edit_data['surname']) ? $edit_data['surname'] : ''; ?>" required>

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>




                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->email; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control required_input email_validate" id="cart_email" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->email); ?>" name="email" value="<?php echo isset($edit_data['email']) ? $edit_data['email'] : ''; ?>" required>
                                            <input type="hidden" class="form-control" id="inv_email" name="inv_email" value="0">

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->country; ?>:</label>
                                        <div class="controls">
                                            <select autocomplete="no-fill" name="country" id="cart_country" class="form-control selectpicker1 kgt2 required_input">
                                                <?php foreach ($countries as $country) {?>
                                                    <option value='<?php echo htmlentities($country['countryName'], ENT_QUOTES); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" <?php if (isset($edit_data['country']) && $edit_data['country'] != '' && $edit_data['country'] == $country['lang_countryName']) {?>selected="selected" <?php } else if (isset($country['countryName']) && $country['countryName'] == $edit_data['country']) {?> selected="selected" <?php } else if (isset($ip_data['countryCode']) && strtoupper($country['alpha_2']) == $ip_data['countryCode']) {?>selected="selected" <?php } else if ($country['countryName'] == "Canada") {?>selected="selected" <?php } else if ($country['lang_countryName'] == "Canada") {?>selected="selected" <?php }?>>
                                                        <?php echo $country['countryName']; ?></option>
                                                <?php }?>
                                            </select>

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->cellphone; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control required_input numeric_input" id="cart_country_code" placeholder="+1" name="country_code" value="<?php echo isset($edit_data['country_code']) ? $edit_data['country_code'] : ''; ?>" required autocomplete="no-fill" readonly>
                                            <input type="text" class="form-control required_input" id="cart_telephone" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->cellphone); ?>" name="telephone" value="<?php echo isset($edit_data['telephone']) ? $edit_data['telephone'] : ''; ?>" required onkeypress="return isNumber(event)">
                                            <input type="hidden" class="form-control" id="inv_phone" value="0">

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->address_1; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control required_input" id="cart_address_1" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->address_1); ?>" name="cart_address_1" value="<?php echo isset($edit_data['cart_address_1']) ? $edit_data['cart_address_1'] : ''; ?>" required>

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->city; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control required_input" id="cart_city" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->city); ?>" name="cart_city" value="<?php echo isset($edit_data['cart_city']) ? $edit_data['cart_city'] : ''; ?>" required>

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->state; ?>:</label>
                                        <div class="controls">
                                            <select name="cart_state" id="cart-state-list" class="form-control kgt2 rounded required_input">
                                            </select>
                                            <input type="hidden" name="cud_cart_state" id="cud_cart_state" value="<?php if (isset($edit_data['cart_state'])) {
    echo $edit_data['cart_state'];
} else if (isset($ip_data['regionCode'])) {
    echo $ip_data['regionCode'];
} else {
    echo "";
}?>">

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->zip; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control required_input" id="cart_zip" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->zip); ?>" name="cart_zip" value="<?php echo isset($edit_data['cart_zip']) ? $edit_data['cart_zip'] : ''; ?>" required>

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>

                                    <?php if ($this->config->item('show_products_input') == "1") {?>

<!----    -->

<div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->signup_category; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control required_input" id="signup_category" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_category); ?>" name="signup_category" value="<?php echo isset($edit_data['signup_category']) ? $edit_data['signup_category'] : ''; ?>" required>

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->signup_maker; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control required_input" id="signup_maker" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_maker); ?>" name="signup_maker" value="<?php echo isset($edit_data['signup_maker']) ? $edit_data['signup_maker'] : ''; ?>" required>

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->signup_model; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control required_input" id="signup_model" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_model); ?>" name="signup_model" value="<?php echo isset($edit_data['signup_model']) ? $edit_data['signup_model'] : ''; ?>" required>

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->signup_group; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control required_input" id="signup_group" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_group); ?>" name="signup_group" value="<?php echo isset($edit_data['signup_group']) ? $edit_data['signup_group'] : ''; ?>" required>

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->signup_year; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control required_input" id="signup_year" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_year); ?>" name="signup_year" value="<?php echo isset($edit_data['signup_year']) ? $edit_data['signup_year'] : ''; ?>" required>

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->signup_engine; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control required_input" id="signup_engine" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_engine); ?>" name="signup_engine" value="<?php echo isset($edit_data['signup_engine']) ? $edit_data['signup_engine'] : ''; ?>" required>

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->signup_vn; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control required_input" id="cart_zip" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->signup_vn); ?>" name="signup_vn" value="<?php echo isset($edit_data['signup_vn']) ? $edit_data['signup_vn'] : ''; ?>" required>

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>


<?php }?>
<!---    -->



                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->edi_one; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" id="edi_one" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->edi_one); ?>" name="edi_one" value="<?php echo isset($edit_data['edi_one']) ? $edit_data['edi_one'] : ''; ?>">

                                        </div>

                                        <p class="red1 help-block"></p>
                                    </div>

                                <?php if ($this->config->item('limited_price_option') == "1") {?>

                                <div class="control-group">
                                <label class="control-label"><?php echo $cart_instruction->signup_products; ?>:</label>
                                <div class="controls">
                                <select class="products_new_drop form-control" name="new_requested[]" multiple="multiple" >

                                </select>
                                </div>

                                <p class="red1 help-block"></p>
                                </div>


                                <div class="control-group">
                                <label class="control-label"><?php echo $cart_instruction->signup_products_selected; ?>:</label>
                                <div class="controls">


                            <?php
			    $approved_produts = explode(",",$edit_data['approved_products']);                            
                            $approved_produts = array_values(array_filter($approved_produts));              
                            $all_existing =  $this->product_model->products_number_andid(implode(",",$approved_produts));
                            
                            foreach ($all_existing as $single) {  ?>

                <div class="selected_div_prodct">
                <div class="productname"> <?php echo $single['kgt_ref_number']; ?>   </div>
                <div class="delete_selec_product">x   </div>

                <input type="hidden" name="approved_products[]" value="<?php echo $single['id']; ?>">
                </div>

                            <?php  } ?>

                                </div>

                                <p class="red1 help-block">You can remove existing product from delete button.</p>
                                </div>



                                <?php }?>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->credit_term_yes_no; ?>:</label>
                                        <div class="controls">
                                            <div class="col-lg-12">
                                                <span class="position-relative">
                                                    <input id="radio11" type="radio" class="required_input" name="credit_term" value="1" <?php if (isset($edit_term['credit_term_status']) && $edit_term['credit_term_status'] == "1") {
    echo "checked";
}?> />
                                                    <label class="text-dark" for="radio11"><?php echo $cart_instruction->credit_yes; ?></label>
                                                </span>
                                                <span class="position-relative">
                                                    <input id="radio12" type="radio" class="required_input" name="credit_term" value="0" <?php if (isset($edit_term['credit_term_status']) && $edit_term['credit_term_status'] != "1") {
    echo "checked";
} else if (!isset($edit_term['credit_term_status'])) {
    echo "checked";
}?> />
                                                    <label class="text-dark" for="radio12"><?php echo $cart_instruction->credit_no; ?></label>
                                                </span>


                                            </div>
                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>

                                    <div id="credit_term_div">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $cart_instruction->credit_file; ?>:</label>
                                            <div class="controls">
                                                <input type="file" class="form-control" id="credit_term_file" name="credit_term_file">
                                                <?php if (isset($edit_term['term_final_file']) && $edit_term['term_final_file'] != '') {?>


                                                    <div class="col-lg-12">
                                                        <a href="<?php echo base_url() . '/assets/uploads/cart/' . $edit_term['term_final_file']; ?>" download><?php echo $cart_instruction->download_file; ?></a>
                                                    </div>
                                                    <div id="delimagebtn" class="margintop-10px">
                                                        <input type="button" class="focustip padding2px deletefile" value="Delete File" onclick='removeimg();'>
                                                    </div>
                                                <?php }?>

                                                <input type="hidden" class="form-control" id="term_real_file" name="term_real_file" value="<?php echo isset($edit_term['term_final_file']) ? $edit_term['term_final_file'] : ''; ?>">

                                            </div>
                                            <p class="help-block red1"></p>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label"><?php echo $cart_instruction->credit_days; ?>:</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" id="credit_days" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->credit_days); ?>" name="credit_days" value="<?php echo isset($edit_term['payment_term_days']) ? $edit_term['payment_term_days'] : ''; ?>">

                                            </div>
                                            <p class="help-block red1"></p>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label"><?php echo $cart_instruction->term_validity; ?>:</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" id="term_validity" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->term_validity); ?>" name="term_validity" value="<?php echo isset($edit_term['term_validity']) ? $edit_term['term_validity'] : ''; ?>">

                                            </div>
                                            <p class="help-block red1"></p>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label"><?php echo $cart_instruction->term_amountlimit; ?>:</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" id="term_amountlimit" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->term_amountlimit); ?>" name="term_amountlimit" value="<?php echo isset($edit_term['term_amountlimit']) ? $edit_term['term_amountlimit'] : ''; ?>">

                                            </div>
                                            <p class="help-block red1"></p>
                                        </div>

                                    </div>




                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_user_details['status']['admin']; ?>:</label>
                                        <div class="controls">
                                            <div class="col-lg-12">
                                                <span class="position-relative">
                                                    <input id="radio11" type="radio" class="required_input" name="user_status" value="1" <?php if (isset($edit_data['user_status']) && $edit_data['user_status'] == "1") {
    echo "checked";
}?> />
                                                    <label class="text-dark" for="radio11"><?php echo $admin_static_links['active_text']['front']; ?></label>
                                                </span>
                                                <span class="position-relative">
                                                    <input id="radio12" type="radio" class="required_input" name="user_status" value="0" <?php if (isset($edit_data['user_status']) && $edit_data['user_status'] == "0") {
    echo "checked";
}?> />
                                                    <label class="text-dark" for="radio12"><?php echo $admin_static_links['inactive_text']['front']; ?></label>
                                                </span>

                                            </div>
                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>



                                    <?php if (!empty($edit_data['id'])) {?>
                                        <div class="form-actions align-right">
                                            <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                        </div>
                                    <?php } else {?>
                                        <div class="form-actions align-right">
                                            <input class="btn btn-primary" value="<?php echo $admin_static_links['static_add']['front']; ?>" id="send" type="submit">
                                            <input class="btn btn-danger" type="reset" value="<?php echo $admin_static_links['reset']['front']; ?>">
                                        </div>
                                    <?php }?>
                                </div>
                            </div>
                        </form>
                        <span class="displaynon" id="formvalidation_credit_term"><?php if (isset($form_validation_instruction->credit_term)) {
    echo $form_validation_instruction->credit_term;
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
                        <span class="displaynon" id="formvalidation_credit_term_file"><?php if (isset($form_validation_instruction->credit_term_file)) {
    echo $form_validation_instruction->credit_term_file;
}
?></span>
                        <span class="displaynon" id="formvalidation_credit_term_file_size"><?php if (isset($form_validation_instruction->credit_term_file_size)) {
    echo $form_validation_instruction->credit_term_file_size;
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
                        <span class="displaynon" id="invalid_captcha"><?php if (isset($cart_instruction->invalid_captcha)) {
    echo $cart_instruction->invalid_captcha;
}
?></span>
                        <span class="displaynon" id="formvalidation_credit_days"><?php if (isset($form_validation_instruction->credit_days)) {
    echo $form_validation_instruction->credit_days;
}
?></span>
                        <span class="displaynon" id="formvalidation_term_validity"><?php if (isset($form_validation_instruction->term_validity)) {
    echo $form_validation_instruction->term_validity;
}
?></span>
                        <span class="displaynon" id="formvalidation_term_amountlimit"><?php if (isset($form_validation_instruction->term_amountlimit)) {
    echo $form_validation_instruction->term_amountlimit;
}
?></span>
                        <span class="displaynon" id="user_email_exist"><?php if (isset($general_instruction->user_email_exist)) {
    echo $general_instruction->user_email_exist;
}
?></span>
                        <span class="displaynon" id="user_phone_exist"><?php if (isset($general_instruction->user_phone_exist)) {
    echo $general_instruction->user_phone_exist;
}
?></span>
                        <span class="displaynon" id="customer_no_exist"><?php if (isset($form_validation_instruction->customer_no_exist)) {
    echo $form_validation_instruction->customer_no_exist;
}
?></span>
                        <span class="displaynon" id="formvalidation_customer_no"><?php if (isset($form_validation_instruction->customer_no)) {
    echo $form_validation_instruction->customer_no;
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

                        <script type="text/javascript">
                            $(document).ready(function() {
                                $.ajaxSetup({
                                    headers: {
                                        'Csrf-Token': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                            $(".delete_selec_product").click(function() {
                            $(this).closest('.selected_div_prodct').remove();
                            });

                            $('.products_new_drop').select2({
                            ajax: {
                            type: "POST",
                            url: base_url + lang_id + "/ajax/getProductListDataResult",
                            dataType: 'json',
                            data: function(params) {
                            return {
                            // vehicle_category_id: $(parentDiv + " .vehicle_category_ids").val(),
                            // product_type_id: "",
                            search: params.term, // search term
                            page: params.page,
                            };
                            },
                            processResults: function(data, params) {
                            // parse the results into the format expected by Select2
                            // since we are using custom formatting functions we do not need to
                            // alter the remote JSON data, except to indicate that infinite
                            // scrolling can be used
                            params.page = params.page || 1;

                            return {
                            results: data.items,
                            pagination: {
                            more: (params.page * 50) < data.total_count
                            }
                            };
                            },
                            },
                            placeholder: 'Select an option',
                            templateResult: formatState,
                            allowClear: true
                            });

                            function formatState(state) {
            if (!state.id) {
                return state.text;
            }

            var $state = $(
                '<span><img class="img-flag" /> <span></span></span>'
            );

            // Use .text() instead of HTML string concatenation to avoid script injection issues
            $state.find("span").text(state.text);
            $state.find("img").attr("src", state.img);

            return $state;
        };


                                $(".deletefile").click(function() {
                                    $(this).hide();
                                    $("#term_real_file").val("");


                                });



                                $("#cart_country").msDropdown({
                                    roundedBorder: false
                                });


                                $("#cart_country").change(function() {
                                    var country1 = $(this).find(':selected').attr('data-imagecss');
                                    var val = country1 ? country1.split(" ") : [];

                                    var s = $('#ship_country_title').find('img').attr('class');
                                    var sstr = s ? s.split(" ") : [];
                                    var country = sstr[1];

                                    $.ajax({
                                        type: "POST",
                                        url: base_url + lang_id + "/language/getStateByCountry",
                                        data: {
                                            countryCode: val[1],
                                            stateCode: val[1]
                                        },
                                        success: function(responce) {
                                            $("#cart-state-list").html(responce);
                                        }
                                    });
                                });







                                setTimeout(function() {
                                    var a = $('#cart_country_title').find('img').attr('class');
                                    var str = a ? a.split(" ") : [];
                                    var cart_country = str[1];
                                    var cart_country1 = $('#cart_country').find(':selected').attr('data-imagecss');
                                    var cart_val = cart_country1 ? cart_country1.split(" ") : [];
                                    var cart_state = $('#cud_cart_state').val();
                                    if ($.trim(cart_country) != '') {
                                        $.ajax({
                                            type: "POST",
                                            url: base_url + lang_id + "/language/getStateByCountry",
                                            data: {
                                                countryCode: cart_val[1],
                                                stateCode: cart_state
                                            },
                                            success: function(responce) {
                                                $("#cart-state-list").html(responce);
                                            }
                                        });
                                    }



                                }, 1000);







                                $("#cart_country").on('change', function() { // 2nd (A)
                                    var country_code = $(this).find(':selected').attr('data-rel');
                                    $('#cart_country_code').val('+' + country_code);
                                });


                                var country_code = $("#cart_country").find(':selected').attr('data-rel');
                                $('#cart_country_code').val('+' + country_code);
                            });



                            $("#send").click(function(e) {
                                var status = validationandsubmitsignup();


                                if (status == "true") {

                                    $("#front_user_form").submit();

                                }
                                return false;
                            });



                            $("input[name='credit_term']").click(function() {
                                var credit_term = $(this).val();
                                if (credit_term == 1) {

                                    var tax_numeric = $('#credit_days');
                                    $('#credit_days').addClass("required_input numeric_input");


                                    var term_validity = $('#term_validity');
                                    $('#term_validity').addClass("required_input numeric_input");



                                    var term_amountlimit = $('#term_amountlimit');
                                    $('#term_amountlimit').addClass("required_input numeric_input");


                                    $('#credit_term_div').show();
                                }

                                if (credit_term == 0) {
                                    $('#credit_days').removeClass("required_input numeric_input");
                                    $('#credit_term_div').hide();
                                }

                                var main_div = $(this).closest('div.control-group');
                                $(main_div).removeClass("has-error");
                                $(main_div).find('.help-block').html("");
                            });




                            $("input[name='credit_term']:checked").trigger("click");

                            function validationandsubmitsignup() {

                                validated = "true";



                                if ($("input[name='credit_term']").is(':checked')) {
                                    var credit_term = $("input[name='credit_term']:checked").val();
                                } else {
                                    var credit_term = '';
                                }


                                //validation for file input
                                if (credit_term == 1) {

                                    if ($('#credit_term_file').get(0).files.length === 0 && $("#user_id").val() != "") {

                                        var parent_div = $('#credit_term_file').closest('div.control-group');
                                        $(parent_div).addClass("has-error");
                                        var file_element_name = $('#credit_term_file').attr('name');
                                        var file_msg_element = $("#formvalidation_" + file_element_name).html();
                                        $(parent_div).find('.help-block').html(file_msg_element);

                                        $(parent_div).find('.help-block').addClass('blink_error');
                                        validated = "false";

                                    } else if ($('#credit_term_file').get(0).files.length) {
                                        var fileName = $('#credit_term_file')[0].files[0].name;
                                        var validExtensions = ['jpg', 'png', 'jpeg', 'gif', 'pdf']; //array of valid extensions
                                        var sizeInBytes = $('#credit_term_file')[0].files[0].size;
                                        var response = validateCartFileUpload(fileName, validExtensions, sizeInBytes, '#credit_term_file');
                                        if (response == 'false') {
                                            validated = "false";
                                        }
                                    }
                                }

                                if (credit_term == 1) {

                                    var tax_numeric = $('#credit_days');
                                    $('#credit_days').addClass("required_input numeric_input");


                                    var term_validity = $('#term_validity');
                                    $('#term_validity').addClass("required_input numeric_input");



                                    var term_amountlimit = $('#term_amountlimit');
                                    $('#term_amountlimit').addClass("required_input numeric_input");


                                    $('#credit_term_div').show();
                                }


                                /****************** Custom method for email *****************************/


                                if (checkEmail($('#cart_email').val())) {
                                    var Csrftoken = $("input[name='Csrf-Token']").val();
                                    $.ajax({
                                        type: "POST",
                                        async: false,
                                        url: base_url + lang_id + "/users/checkEmailExists",
                                        data: {
                                            email: $('#cart_email').val(),
                                            user_id: $('#user_id').val(),
                                            'Csrf-Token': Csrftoken
                                        },
                                        dataType: "json",
                                        success: function(msg) {
                                            if (msg == false) {

                                                var msg_element = $("#user_email_exist").html();
                                                alert(msg_element);
                                                var parent_div = $("#cart_email").closest('div.control-group');
                                                $(parent_div).addClass("has-error");
                                                $(parent_div).find('.help-block').html(msg_element);
                                                $(parent_div).find('.help-block').addClass('blink_error').show();
                                                $(parent_div).focus();
                                                $("#inv_email_phone").val("1");
                                                validated = "false";
                                            }
                                        }
                                    });


                                } else {
                                    var element_name = $("#cart_email").attr('name');
                                    var msg_element = $("#formvalidation_" + element_name).html();
                                    alert(msg_element);

                                    var parent_div = $("#cart_email").closest('div.control-group');
                                    $(parent_div).addClass("has-error");
                                    $(parent_div).find('.help-block').html(msg_element);
                                    $(parent_div).find('.help-block').addClass('blink_error').show();
                                    $(parent_div).focus();
                                    $("#inv_email_phone").val("1");
                                    validated = "false";
                                }






                                if ($('#customer_no').val()) {
                                    var Csrftoken = $("input[name='Csrf-Token']").val();
                                    $.ajax({
                                        type: "POST",
                                        url: base_url + lang_id + "/users/checkCustomerExists",
                                        data: {
                                            customer_no: $('#customer_no').val(),
                                            user_id: $('#user_id').val(),
                                            'Csrf-Token': Csrftoken
                                        },
                                        dataType: "json",
                                        success: function(msg) {
                                            if (msg == false) {
                                                var msg_element = $("#customer_no_exist").text();
                                                var parent_div = $("#customer_no").closest('div.control-group');
                                                $(parent_div).addClass("has-error");
                                                $(parent_div).find('.help-block').html(msg_element);
                                                $(parent_div).find('.help-block').addClass('blink_error').show();
                                                $(parent_div).focus();
                                                $("#inv_customer_no").val("1");
                                                validated = "false";
                                            }
                                        }
                                    });
                                }





                                if ($('#cart_country_code').val() && $('#cart_telephone').val()) {
                                    var Csrftoken = $("input[name='Csrf-Token']").val();
                                    $.ajax({
                                        type: "POST",
                                        async: false,
                                        url: base_url + lang_id + "/users/checkPhoneExists",
                                        data: {
                                            country_code: $('#cart_country_code').val(),
                                            telephone: $('#cart_telephone').val(),
                                            user_id: $('#user_id').val(),
                                            'Csrf-Token': Csrftoken
                                        },
                                        dataType: "json",
                                        success: function(msg) {
                                            if (msg == false) {
                                                var msg_element = $("#user_phone_exist").text();
                                                var parent_div = $("#cart_telephone").closest('div.control-group');
                                                $(parent_div).addClass("has-error");
                                                $(parent_div).find('.help-block').html(msg_element);
                                                $(parent_div).find('.help-block').addClass('blink_error').show();
                                                $(parent_div).focus();
                                                $("#inv_phone").val("1");
                                                validated = "false";
                                            }
                                        }
                                    });
                                }


                                /****************** Custom method for email *****************************/




                            


                                $(".required_input").each(function() {
                                    if ($(this).attr('type') == 'radio') {
                                        validate_radio(this);
                                    } else if ($(this).attr('type') == 'text') {
                                        validate_element(this);
                                    }
                                });


                                if ($("#inv_phone").val() == "1" || $("#inv_email").val() == "1" || $("#inv_customer_no").val() == "1") {
                                    validated = "false";
                                }

                                return validated;
                            }





                            function validateFields(page) {
                                validated = "true";

                                $(".required_input").each(function() {
                                    validate_element(this);
                                });

                                if (page == 'set_password') {
                                    if (validated == "true" && $('#new_password').val() != $('#confirm_password').val()) {
                                        validated = "false";
                                        $('.cnf_pwd').addClass("has-error");
                                        $('.cnf_pwd .help-block').html($('#formvalidation_confirm_password_mismatch').text()).addClass('blink_error')
                                    }
                                }

                                if (page == 'login' || page == 'reset_password') {
                                    var email = $("#login_email").val();
                                    if (!checkEmail($('#login_email').val())) {
                                        var element_name = $("#login_email").attr('name');
                                        var msg_element = $("#formvalidation_" + element_name).html();
                                        var parent_div = $("#login_email").closest('div.form-group');
                                        $(parent_div).addClass("has-error");
                                        $(parent_div).find('.help-block').html(msg_element);
                                        $(parent_div).find('.help-block').addClass('blink_error').show();
                                        $(parent_div).focus();
                                        validated = "false";
                                    }
                                }

                                return validated;
                            }


                            function validate_radio(element) {
                                var regex = new RegExp(/^\+?[0-9(),.-]+$/);
                                if ($(element).hasClass("required_input")) {

                                    if ($('input[name="' + $(element).attr('name') + '"]:checked').val()) {
                                        var parent_div = $(element).closest('div.control-group');
                                        $(parent_div).removeClass("has-error");
                                        $(parent_div).find('.help-block').html("");
                                        $(parent_div).find('.help-block').removeClass("blink_error");

                                    } else {
                                        var element_name = $(element).attr('name');
                                        var msg_element = $("#formvalidation_" + element_name).html();
                                        var parent_div = $(element).closest('div.control-group');
                                        $(parent_div).addClass("has-error");
                                        $(parent_div).find('.help-block').html(msg_element);
                                        $(parent_div).find('.help-block').addClass('blink_error');
                                        $(element).focus();
                                        validated = "false";
                                    }
                                }


                            }




                            /******************Validate input element function or select and text */

                            function validate_element(element) {
                                var regex = new RegExp(/^\+?[0-9(),.-]+$/);
                                if ($(element).val() == '' && $(element).hasClass("required_input")) {
                                    var element_name = $(element).attr('name');
                                    var msg_element = $("#formvalidation_" + element_name).html();
                                    var parent_div = $(element).closest('div.control-group');
                                    $(parent_div).addClass("has-error");
                                    $(parent_div).find('.help-block').html(msg_element);
                                    $(parent_div).find('.help-block').addClass('blink_error');
                                    $(element).focus();
                                    validated = "false";
                                } else if ($(element).val() != '' && $(element).hasClass("numeric_input")) {
                                    var element_name = $(element).attr('name');
                                    var strlen = $(element).val().length;
                                    if ((element_name == 'telephone' || element_name == 'ship_telephone') && (strlen < 8 || strlen > 15)) {
                                        var msg_element = $("#formvalidation_" + element_name).html();
                                        var parent_div = $(element).closest('div.control-group');
                                        $(parent_div).addClass("has-error");
                                        $(parent_div).find('.help-block').html(msg_element);
                                        $(parent_div).find('.help-block').addClass('blink_error').show();
                                        $(element).focus();
                                        validated = "false";
                                    } else if (!$(element).val().match(regex)) {
                                        var msg_element = $("#formvalidation_" + element_name + "_numeric").html();
                                        var parent_div = $(element).closest('div.control-group');
                                        $(parent_div).addClass("has-error");
                                        $(parent_div).find('.help-block').html(msg_element);
                                        $(parent_div).find('.help-block').addClass('blink_error');
                                        $(element).focus();
                                        validated = "false";
                                    }
                                } else {
                                    var element_name = $(element).attr('name');
                                    if ($(element).val()) {
                                        var strlen = $(element).val().length;
                                    } else {
                                        var strlen = 0;

                                    }
                                    if ((element_name == 'surname' || element_name == 'ship_surname' || element_name == 'password' || element_name == 'confirm_password') && (strlen < 3 || strlen > 30)) {
                                        var msg_element = $("#formvalidation_" + element_name).html();
                                        var parent_div = $(element).closest('div.control-group');
                                        $(parent_div).addClass("has-error");
                                        $(parent_div).find('.help-block').html(msg_element);
                                        $(parent_div).find('.help-block').addClass('blink_error');
                                        $(element).focus();
                                        validated = "false";
                                    } else {
                                        var parent_div = $(element).closest('div.control-group');
                                        $(parent_div).removeClass("has-error");
                                        $(parent_div).find('.help-block').html("");
                                        $(parent_div).find('.help-block').removeClass("blink_error");
                                    }
                                }
                            }

                            function isNumber(evt) {
                                evt = (evt) ? evt : window.event;
                                var charCode = (evt.which) ? evt.which : evt.keyCode;
                                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                    return false;
                                }
                                return true;
                            }

                            function checkEmail(inputvalue) {
                                const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                                return re.test(String(inputvalue).toLowerCase());
                            }


                            // Function for validating the image by chandan
                            function imageUploadExtensionValidation(filename, validExtensions) {
                                //check for filename should not be empty and valid extension should be array
                                if ((filename === undefined || filename === null || filename === '') && (Array.isArray(validExtensions) && validExtensions.length === 0)) {
                                    var fileTypeError = "Filename and Valid File Extension array should not empty";
                                    return fileTypeError;
                                } else {
                                    var fileNameExt = filename.substr(filename.lastIndexOf('.') + 1);
                                    if ($.inArray(fileNameExt, validExtensions) == -1) {
                                        var fileTypeError = "Only these file types are accepted : " + validExtensions.join(', ');
                                        return fileTypeError;
                                    } else {
                                        return 1;
                                    }
                                }
                            }

                            function validateCartFileUpload(fileName, validExtensions, sizeInBytes, target) {
                                var fileTypeError = imageUploadExtensionValidation(fileName, validExtensions);
                                if (fileTypeError !== 1) {
                                    var parent_div = $(target).closest('div.control-group');
                                    $(parent_div).addClass("has-error");
                                    var file_element_name = $(target).attr('name');
                                    var file_msg_element = $("#formvalidation_" + file_element_name).html();
                                    $(parent_div).find('.help-block').addClass("blink_error").html(file_msg_element).show();
                                    $(target).focus();
                                    return "false";
                                } else if (sizeInBytes > 2097152) {
                                    var parent_div = $(target).closest('div.control-group');
                                    $(parent_div).addClass("has-error");
                                    var file_element_name = $(target).attr('name');
                                    var file_msg_element = $("#formvalidation_" + file_element_name).html();
                                    $(parent_div).find('.help-block').addClass("blink_error").html(file_msg_element).show();
                                    $(target).focus();
                                    return "false";
                                } else {
                                    var parent_div = $(target).closest('div.control-group');
                                    $(parent_div).removeClass("has-error");
                                    $(parent_div).find('.help-block').removeClass("blink_error").hide();
                                    return '';
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
