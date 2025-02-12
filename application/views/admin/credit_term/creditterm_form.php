<div class="content zerorightmargin">
    <?php if ($this->session->flashdata('success')) {
        $msg = $this->session->flashdata('success'); ?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?>
            </div>
        </div>
    <?php } ?>

    <?php if ($this->session->flashdata('error')) {
        $msg = $this->session->flashdata('error'); ?>
        <div class="notice outer">
            <div class="error"><?php echo $msg; ?>
            </div>
        </div>
    <?php } ?>
    <?php $noimage = getNoImage('no_image'); ?>

    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <div class="body">
                    <div class="container">
                        <form id="front_user_form" action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/creditterm/save_request_data" name="front_user_form" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set" />
                            <input type="hidden" id="delimageid" value="<?php echo isset($edit_data['id']) ? $edit_data['id'] : ''; ?>" />
                            <div class="span12">
                                <div class="block well">
                                    <div class="navbar">
                                        <div class="navbar-inner">
                                            <h5> <?php echo $api_instruction['creditterm_edit_page']['admin']; ?></h5>
                                        </div>
                                    </div>



                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->company; ?>:</label>
                                        <div class="controls">
                                            <?php echo $edit_data['company']; ?>

                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->name_surname; ?>:</label>
                                        <div class="controls">
                                            <?php echo $edit_data['salutation'] . " " . $edit_data['surname']; ?>
                                        </div>
                                    </div>




                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->email; ?>:</label>
                                        <div class="controls">
                                            <?php echo $edit_data['email'];  ?>
                                            <input type="hidden" name="term_request_id" value="<?php echo $edit_data['id']; ?> ">
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->country; ?>:</label>
                                        <div class="controls">
                                            <?php echo $edit_data['country']; ?>

                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->cellphone; ?>:</label>
                                        <div class="controls">
                                            <?php echo $edit_data['telephone']; ?>

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->term_request_date; ?>:</label>
                                        <div class="controls">
                                            <?php echo $edit_data['request_date']; ?>


                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->term_request_file; ?>:</label>
                                        <div class="controls">
                                            <?php if ($edit_data['request_file']) { ?>
                                                <a href="<?php echo base_url() . '/assets/uploads/cart/' . $edit_data['request_file']; ?>" download> Download File </a>
                                            <?php } ?>


                                        </div>
                                    </div>



                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_user_details['status']['admin']; ?>:</label>
                                        <div class="controls">



                                            <select name="status" id="status" class="form-control kgt2 rounded required_input" <?php if (!empty($edit_data['id']) && ($edit_data['status'] != "0")) {
                                                                                                                                    echo "disabled";
                                                                                                                                } ?>>
                                            <option value="0" <?php if ($edit_data['status'] == "0") {
                                            echo "selected";
                                            } ?>> <?php echo  $admin_static_links['pending_text']['front']; ?> </option>
                                            <option value="1" <?php if ($edit_data['status'] == "1") {
                                            echo "selected";
                                            } ?>> <?php echo  $admin_static_links['approved_text']['front']; ?> </option>
                                            <option value="2" <?php if ($edit_data['status'] == "2") {
                                            echo "selected";
                                            } ?>> <?php echo  $admin_static_links['decline_text']['front']; ?> </option>
                                            <option value="3" <?php if ($edit_data['status'] == "3") {
                                            echo "selected";
                                            } ?>> <?php echo  $admin_static_links['expired_text']['front']; ?> </option>
                                            </select>


                                        </div>
                                    </div>






                                    <div id="accept_trm_div" class="conditional_div">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $cart_instruction->credit_file; ?>:</label>
                                            <div class="controls">

                                                <?php if (!empty($edit_data['id']) && ($edit_data['status'] == "0")) { ?>
                                                    <input type="file" class="form-control" id="credit_term_file" name="credit_term_file">
                                                <?php } else { ?>

                                                    <?php if ($edit_term['term_final_file']) { ?>
                                                        <a href="<?php echo base_url() . '/assets/uploads/cart/' . $edit_term['term_final_file']; ?>" download> Download File </a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <p class="help-block red1"></p>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label"><?php echo $cart_instruction->credit_days; ?>:</label>
                                            <div class="controls">
                                                <?php if (!empty($edit_data['id']) && ($edit_data['status'] == "0")) { ?>
                                                    <input type="text" class="form-control" id="credit_days" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->credit_days); ?>" name="credit_days" value="<?php echo isset($edit_data['payment_term_days']) ? $edit_data['payment_term_days'] : ''; ?>">
                                                <?php } else { ?>
                                                    <?php echo $edit_term['payment_term_days']; ?>
                                                <?php } ?>
                                            </div>
                                            <p class="help-block red1"></p>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label"><?php echo $cart_instruction->term_validity; ?>:</label>
                                            <div class="controls">
                                                <?php if (!empty($edit_data['id']) && ($edit_data['status'] == "0")) { ?>

                                                    <input type="text" class="form-control" id="term_validity" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->term_validity); ?>" name="term_validity" value="<?php echo isset($edit_data['term_validity']) ? $edit_data['term_validity'] : ''; ?>">
                                                <?php } else { ?>
                                                    <?php echo $edit_term['term_validity']; ?>
                                                <?php } ?>
                                            </div>
                                            <p class="help-block red1"></p>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label"><?php echo $cart_instruction->term_amountlimit; ?>:</label>
                                            <div class="controls">
                                                <?php if (!empty($edit_data['id']) && ($edit_data['status'] == "0")) { ?>

                                                    <input type="text" class="form-control" id="term_amountlimit" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->term_amountlimit); ?>" name="term_amountlimit" value="<?php echo isset($edit_data['term_amountlimit']) ? $edit_data['term_amountlimit'] : ''; ?>">
                                                <?php } else { ?>
                                                    <?php echo $edit_term['term_amountlimit']; ?>
                                                <?php } ?>
                                            </div>
                                            <p class="help-block red1"></p>
                                        </div>

                                    </div>


                                    <div id="decline_term_div" class="conditional_div">



                                        <div class="control-group">
                                            <label class="control-label"><?php echo $cart_instruction->decline_notes; ?>:</label>
                                            <div class="controls">
                                                <?php if (!empty($edit_data['id']) && ($edit_data['status'] == "0")) { ?>
                                                    <textarea class="form-control" id="decline_notes" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->decline_notes); ?>" name="decline_notes"><?php echo isset($edit_data['decline_notes']) ? $edit_data['decline_notes'] : ''; ?></textarea>
                                                <?php } else { ?>
                                                    <?php echo $edit_data['decline_notes']; ?>
                                                <?php } ?>
                                            </div>
                                            <p class="help-block red1"></p>
                                        </div>




                                    </div>




                                    <?php if (!empty($edit_data['id']) && ($edit_data['status'] == "0")) { ?>
                                        <div class="form-actions align-right ">
                                            <input class="btn btn-primary" id="send" value="<?php echo $admin_static_links['static_update']['front']; ?>" type="submit">
                                        </div>
                                    <?php }  ?>

                                </div>
                            </div>
                        </form>
                        <span class="displaynon" id="formvalidation_credit_term"><?php if (isset($form_validation_instruction->invalid_title)) echo $form_validation_instruction->invalid_title; ?></span>
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
                        <span class="displaynon" id="formvalidation_credit_term_file"><?php if (isset($form_validation_instruction->credit_term_file)) echo $form_validation_instruction->credit_term_file; ?></span>
                        <span class="displaynon" id="formvalidation_credit_term_file_size"><?php if (isset($form_validation_instruction->credit_term_file_size)) echo $form_validation_instruction->credit_term_file_size; ?></span>
                        <span class="displaynon" id="formvalidation_email_exist"><?php if (isset($form_validation_instruction->email_exist)) echo $form_validation_instruction->email_exist; ?></span>
                        <span class="displaynon" id="formvalidation_mobile_number_exist"><?php if (isset($form_validation_instruction->mobile_number_exist)) echo $form_validation_instruction->mobile_number_exist; ?></span>
                        <span class="displaynon" id="invalid_captcha"><?php if (isset($cart_instruction->invalid_captcha)) echo $cart_instruction->invalid_captcha; ?></span>
                        <span class="displaynon" id="formvalidation_credit_days"><?php if (isset($form_validation_instruction->credit_days)) echo $form_validation_instruction->credit_days; ?></span>
                        <span class="displaynon" id="formvalidation_term_validity"><?php if (isset($form_validation_instruction->term_validity)) echo $form_validation_instruction->term_validity; ?></span>
                        <span class="displaynon" id="formvalidation_term_amountlimit"><?php if (isset($form_validation_instruction->term_amountlimit)) echo $form_validation_instruction->term_amountlimit; ?></span>

                        <span class="displaynon" id="formvalidation_decline_notes"><?php if (isset($form_validation_instruction->decline_notes)) echo $form_validation_instruction->decline_notes; ?></span>

                        <script type="text/javascript">
                            $(document).ready(function() {


                                $.ajaxSetup({
                                    headers: {
                                        'Csrf-Token': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });



                                $("#send").attr('disabled', 'disabled');


                                $("#status").change(function() {


                                    var status = $(this).val();
                                    var credit_term = $(this).val();
                                    if (status == "1") {
                                        $("#send").removeAttr("disabled");

                                        $(".conditional_div").hide();
                                        $("#accept_trm_div").show();
                                        var tax_numeric = $('#credit_days');
                                        $('#credit_days').addClass("required_input numeric_input");
                                        // validate_element(tax_numeric);

                                        var term_validity = $('#term_validity');
                                        $('#term_validity').addClass("required_input numeric_input");
                                        // validate_element(term_validity);



                                        var term_amountlimit = $('#term_amountlimit');
                                        $('#term_amountlimit').addClass("required_input numeric_input");

                                        $('#credit_term_div').show();
                                    } else if (status == "2") {
                                        $("#send").removeAttr("disabled");

                                        $(".conditional_div").hide();
                                        var decline_notes = $('#decline_notes');
                                        $('#decline_notes').addClass("required_input");
                                        // validate_element(term_validity);

                                        $("#decline_term_div").show();
                                    } else {
                                        $('#credit_days').removeClass("required_input numeric_input");
                                        $('#term_validity').removeClass("required_input numeric_input");
                                        $('#term_amountlimit').removeClass("required_input numeric_input");

                                        $(".conditional_div").hide();
                                    }



                                });

                                $("#send").click(function(e) {
                                    var status = validationandsubmitsignup();


                                    if (status == "true") {

                                        $("#front_user_form").submit();

                                    }
                                    return false;
                                });


                                $("#status").trigger("change");
                            });

                            function validationandsubmitsignup() {

                                validated = "true";

                                // Billing Details Validation
                                $(".required_input").each(function() {
                                    if ($(this).attr('type') == 'radio') {
                                        validate_radio(this);
                                    } else if ($(this).attr('type') == 'text') {
                                        validate_element(this);
                                    } else if ($(this).attr('id') == 'decline_notes') {
                                        validate_element(this);
                                    }
                                });


                                /****************** Custom method for email *****************************/



                                var status = $("#status").val();



                                //validation for file input 
                                if (status == 1) {

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

                                var element_name = $(element).attr('name');

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