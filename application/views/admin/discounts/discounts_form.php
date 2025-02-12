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
                        <form id="discount_coupon_form" action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/discounts/save_data" name="front_user_form" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set" />
                            <input type="hidden" id="discount_id" name="discount_id" value="<?php echo isset($edit_data['id']) ? $edit_data['id'] : ''; ?>" />
                            <div class="span12">
                                <div class="block well">
                                    <div class="navbar">
                                        <div class="navbar-inner">
                                            <h5> <?= isset($edit_data['id']) ? $admin_products['edit_discountcoupons']['front'] : $admin_products['add_discountcoupons']['front']; ?></h5>
                                        </div>
                                    </div>



                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->coupon_code; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control required_input" id="coupon_code" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->coupon_code); ?>" name="coupon_code" value="<?php echo isset($edit_data['coupon_code']) ? $edit_data['coupon_code'] : ''; ?>" <?php if ($edit_data['id']) {
                                                                                                                                                                                                                                                                                                                                echo "readonly";
                                                                                                                                                                                                                                                                                                                            } ?>>

                                        </div>

                                        <p class="red1 help-block"></p>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->coupon_expiry; ?>:</label>
                                        <div class="controls">
                                            <input type="text" class="form-control datetimepicker" id="expirytime" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->expirytime); ?>" name="expirytime" value="<?php echo isset($edit_data['expirytime']) ? $edit_data['expirytime'] : ''; ?>" required>

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>



                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->coupon_users; ?>:</label>
                                        <div class="controls">
                                                <input type="radio" value="All" class="coupon_usersss coup_user" name="coupon_users[]" />&nbsp; &nbsp;<label>All</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                                <input type="radio" class="coupon_usersss coup_user1" checked/>&nbsp; &nbsp;<label>Individual</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                                

                                                                                                                                                                                                                                                                                                                                                                             
                                        </div>
                                        <div class="controls select_radion">
                                            <select class="multiple-select-users focustip span12" name="coupon_users[]" multiple="multiple" required>
                                                <?php
                                                $selected_users =  isset($edit_data['users']) ? explode(',', $edit_data['users']) : '';
                                                foreach ($users as $user) {
                                                ?>
                                                    <option <?php if (in_array($user['id'], $selected_users)) {
                                                                echo  "selected";
                                                            } ?> value='<?php echo $user['id']; ?>'>
                                                        <?php echo $user['customer_no']; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->coupon_products; ?>:</label>
                                        
                                        <div class="controls">
                                                <input type="radio" value="All" class="coupon_prodsss prods" name="products[]" />&nbsp; &nbsp;<label>All</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                                <input type="radio" class="coupon_prodsss prods1"  checked/>&nbsp; &nbsp;<label>Individual</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                                

                                                                                                                                                                                                                                                                                                                                                                             
                                        </div>
                                        <div class="controls select_radion1">
                                                     
                                            
                                                <select class="products_new_drop focustip span12" name="products[]" multiple="multiple" required>

                                                 <?php
                                                $selected_products =  isset($edit_data['products']) ? explode(',', $edit_data['products']) : '';
                                                // echo "<pre>";print_r($selected_products);die;
                                                ?>

                                                    <?php
                                                foreach ($products as $product) {
                                                ?>
                                                    <option <?php if (in_array($product['id'], $selected_products)) {
                                                                echo  "selected";
                                                            } ?> value='<?php echo $product['id']; ?>'>
                                                        <?php echo $product['kgt_ref_number']; ?></option>
                                                <?php } ?> 
                                                  </select>
                                            
                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $cart_instruction->coupon_refusers; ?>:</label>
                                        <div class="controls">
                                                <input type="radio" value="All" class="refuserss refs" name="refusers[]" />&nbsp; &nbsp;<label>All</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                                <input type="radio" class="refuserss refs1" checked/>&nbsp; &nbsp;<label>Individual</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                                

                                                                                                                                                                                                                                                                                                                                                                             
                                        </div>
                                        <div class="controls select_radion2">
                                            <?php

                                            $selected_refusers =  isset($edit_data['refferal_users']) ? explode(',', $edit_data['refferal_users']) : '';


                                            ?>

                                            <select class="multiple-select-refusers focustip span12" name="refusers[]" multiple="multiple" required>
                                                <?php
                                                foreach ($refferal_users as $refferal_user) {
                                                ?>
                                                    <option <?php if (in_array($refferal_user['id'], $selected_refusers)) {
                                                                echo  "selected";
                                                            } ?> value='<?php echo $refferal_user['id']; ?>'>
                                                        <?php echo $refferal_user['refferal_no']; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        <p class="help-block red1"></p>
                                    </div>

                                    <div class="product_model_field_display item_model_3002" style="border-bottom: 1px solid #eaeaea;">
                                        <div class="manufactingYearblock control-group discountrangeblock">
                                            <button type="button" id="add_ranges" class="btn btn-success addManufactureYear">Add Discount Ranges</button>
                                            <input type="hidden" id="range_tot" value="<?php echo isset($edit_ranges) ? count($edit_ranges) : '2'; ?>">

                                            <?php
                                            if (isset($edit_ranges)) {
                                                foreach ($edit_ranges as $key => $range) { ?>
                                                    <div class="moreModel">
                                                        <div class="yearSelectionDiv"><button class="btn btn-danger remove_field">Delete</button></div>
                                                        <div class="engineBlock" id="addEngineBlock">
                                                            <div class="engineFldsblock">
                                                                <div class="engineFlds"><label for="">Start Range</label><input type="text" name="fromstart[<?php echo $key; ?>]" class="focustip rangeinput startrange span12" aria-required="true" value="<?php echo $range['fromstart']; ?>"></div>
                                                                <div class="engineFlds"><label for="">End Range </label><input type="text" name="fromend[<?php echo $key; ?>]" class="focustip rangeinput endrange span12" aria-required="true" value="<?php echo $range['fromend']; ?>"></div>
                                                                <div class="engineFlds"><label for="">Percentage </label><input name="percentage[<?php echo $key; ?>]" type="text" class="focustip  percetageinput span12" aria-required="true" value="<?php echo $range['percentage']; ?>"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }
                                            } else { ?>

                                                <div class="moreModel">
                                                    <div class="yearSelectionDiv"><button class="btn btn-danger remove_field">Delete</button></div>
                                                    <div class="engineBlock" id="addEngineBlock">
                                                        <div class="engineFldsblock">
                                                            <div class="engineFlds"><label for="">Start Range</label><input type="text" name="fromstart[1]" class="focustip rangeinput startrange span12" aria-required="true" value="<?php echo $range['fromstart']; ?>"></div>
                                                            <div class="engineFlds"><label for="">End Range </label><input type="text" name="fromend[1]" class="focustip endrange rangeinput span12" aria-required="true" value="<?php echo $range['fromend']; ?>"></div>
                                                            <div class="engineFlds"><label for="">Percentage </label><input name="percentage[1]" type="text" class="focustip  percetageinput span12" aria-required="true" value="<?php echo $range['fromend']; ?>"></div>
                                                        </div>
                                                    </div>
                                                </div>


                                            <?php } ?>

                                        </div>




                                    </div>


                                    <?php if (!empty($edit_data['id'])) { ?>
                                        <div class="form-actions align-right">
                                            <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" type="submit">
                                        </div>
                                    <?php } else { ?>
                                        <div class="form-actions align-right">
                                            <input class="btn btn-primary" value="<?php echo $admin_static_links['static_add']['front']; ?>" id="send" type="submit">
                                            <input class="btn btn-danger" type="reset" value="<?php echo $admin_static_links['reset']['front']; ?>">
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </form>
                        <span class="displaynon" id="formvalidation_credit_term"><?php if (isset($form_validation_instruction->credit_term)) echo $form_validation_instruction->credit_term; ?></span>
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
                        <span class="displaynon" id="user_email_exist"><?php if (isset($general_instruction->user_email_exist)) echo $general_instruction->user_email_exist; ?></span>
                        <span class="displaynon" id="user_phone_exist"><?php if (isset($general_instruction->user_phone_exist)) echo $general_instruction->user_phone_exist; ?></span>
                        <span class="displaynon" id="customer_no_exist"><?php if (isset($form_validation_instruction->customer_no_exist)) echo $form_validation_instruction->customer_no_exist; ?></span>
                        <span class="displaynon" id="formvalidation_customer_no"><?php if (isset($form_validation_instruction->customer_no)) echo $form_validation_instruction->customer_no; ?></span>

                        <script type="text/javascript">
                            $(document).ready(function() {
                                // Javsascript function for repeating the outer panel on the click of 'Add Manufacturing Year Button'
                                var id = "add_ranges";
                                var discountrangeblock = $(".discountrangeblock");
                                var addYearPanel = $("button#" + id);
                                var tot = $("#range_tot").val() + 1;

                                $('#add_ranges').click(function(e) { //on add input button click
                                    e.preventDefault();
                                    var html = '<div class="moreModel"><div class="yearSelectionDiv" ><button class="btn btn-danger remove_field">Delete</button></div><div class="engineBlock" id="addEngineBlock"><div class="engineFldsblock"><div class="engineFlds"><label for="">Start Range</label><input type="text" name="fromstart[' + tot + ']" class="focustip rangeinput startrange span12"></div><div class="engineFlds"><label for="">End Range </label><input type="text" name="fromend[' + tot + ']" class="focustip rangeinput endrange span12"></div><div class="engineFlds"><label for="">Percentage </label><input name="percentage[' + tot + ']" type="text" class="focustip  percetageinput span12"></div></div></div></div>';

                                    $(discountrangeblock).append(html);


                                    $('.startrange').each(function() {
                                        $(this).rules("add", {
                                            required: true,
                                            digits: true,
                                            startrange: true
                                        });
                                    });

                                    $('.endrange').each(function() {
                                        $(this).rules("add", {
                                            required: true,
                                            digits: true,
                                            maxrange: true
                                        });
                                    });

                                    $('.percetageinput').each(function() {
                                        $(this).rules("add", {
                                            required: true,
                                            digits: true,
                                            range: [1, 100]
                                        });
                                    });

                                    tot++;
                                    $("#range_tot").val(tot);

                                });
                                // Ends

                                // Javsascript function for deleting the particular YEAR outer panel on the resepctive GREEN BUTTON CLICK

                                $(".discountrangeblock").on("click", ".remove_field", function(e) {
                                    e.preventDefault();
                                    $(this).parent().parent('div').remove();
                                    resetModelYear('3002_335');
                                });

                                // Ends

                                // Javsascript function for repeating the inner i.e Engines panel on the click of 'Add More Engines Button'

                                // Ends

                                // Javsascript function for deleting the particular ENGINE inner panel on the resepctive CROSS BUTTON CLICK

                                $(document).on('click', ".deleteEngine", function(e) {
                                    e.preventDefault();
                                    $(this).parent().parent('div').remove();
                                });

                                // Ends

                                $.ajaxSetup({
                                    headers: {
                                        'Csrf-Token': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                $('#expirytime').datetimepicker({
                                    format: 'Y-m-d H:i',
                                    minDate : '-1969/12/31'
                                });
                                
                               
                                $("#send").click(function(e) {
                                    $("#discount_coupon_form").submit();
                                });

                                $("#discount_coupon_form").validate({
                                    rules: {
                                        coupon_code: {
                                            required: true,
                                            remote: {
                                                url: "<?php echo base_url() . 'admin/' . $lang_id . '/discounts/checkCouponexist'; ?>/" + $('#discount_id').val(),
                                                type: "post",
                                                data: {
                                                    coupon_code: function() {
                                                        return $("#coupon_code").val();
                                                    }
                                                }
                                            }
                                        },
                                        expirytime: {
                                            required: true
                                        },
                                        coupon_users: {
                                            required: true
                                        },
                                        products: {
                                            required: true
                                        },
                                        refusers: {
                                            required: true,
                                            email: true
                                        }
                                    },
                                    messages: {
                                        coupon_code: {
                                            remote: $.validator.format("{0} is already in use")
                                        }
                                    },
                                    errorElement: "p",
                                    errorClass: 'help-block red1',
                                    validClass: 'help-block',
                                    errorPlacement: function(error, element) {
                                        if ($(element).hasClass('rangeinput') || $(element).hasClass('percetageinput')) {
                                            error.insertAfter($(element));

                                        } else {
                                            error.insertAfter($(element).parents('.controls'));
                                        }

                                    }

                                });


                                $('.startrange').each(function() {
                                    $(this).rules("add", {
                                        required: true,
                                        digits: true,
                                        startrange: true
                                    });
                                });

                                $('.endrange').each(function() {
                                    $(this).rules("add", {
                                        required: true,
                                        digits: true,
                                        maxrange: true
                                    });
                                });

                                $('.percetageinput').each(function() {
                                    $(this).rules("add", {
                                        required: true,
                                        digits: true,
                                        range: [1, 100]
                                    });
                                });


                                $.validator.addMethod("maxrange", function(value, element) {
                                    var parent_div = $(element).closest('.moreModel');
                                    var start = parseInt($(parent_div).find("input[name^='fromstart']").val());
                                    if (parseInt(value) > start) {
                                        return true;
                                    } else {
                                        return false;
                                    }
                                }, jQuery.validator.format("Please enter the  value greater than start."));


                                $.validator.addMethod("startrange", function(value, element) {

                                    var $parent_div = $(element).closest('.moreModel');
                                    var $elems = $('.moreModel');
                                    var valid = 0;


                                    if ($elems.index($parent_div) == 0) {
                                        var valid = 1;


                                    } else {

                                        var previous = $elems.eq($elems.index($parent_div) - 1);
                                        var testing = $(previous).attr('class');
                                        var end = parseInt($(previous).find(".endrange").val());
                                        var valid = 1;
                                        if (parseInt(value) <= end) {
                                            valid = 0;
                                        }

                                    }

                                    if (valid == 1) {
                                        return true;
                                    } else {
                                        return false;
                                    }
                                }, jQuery.validator.format("Please enter the  value greater than start."));


                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
      $('.products_new_drop').select2({
        ajax: {
            type: "POST",
            url: base_url + lang_id + "/ajax/getProductListDataResultWithAll",
            dataType: 'json',
            data: function(params) {
                return {
                    // vehicle_category_id: $(parentDiv + " .vehicle_category_ids").val(),
                    // product_type_id: "",
                    search: params.term, // search term
                    page: params.page,
                    currentdata:$('.products_new_drop').val(),
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
    $('.multiple-select-users').select2({
        ajax: {
            type: "POST",
            url: base_url + lang_id + "/ajax/getUserListDataResultWithAll",
            dataType: 'json',
            data: function(params) {
                return {
                    // vehicle_category_id: $(parentDiv + " .vehicle_category_ids").val(),
                    // product_type_id: "",
                    search: params.term, // search term
                    page: params.page,
                    currentdata:$('.multiple-select-users').val(),
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
    $('.multiple-select-refusers').select2({
        ajax: {
            type: "POST",
            url: base_url + lang_id + "/ajax/getRefUserListDataResultWithAll",
            dataType: 'json',
            data: function(params) {
                return {
                    // vehicle_category_id: $(parentDiv + " .vehicle_category_ids").val(),
                    // product_type_id: "",
                    search: params.term, // search term
                    page: params.page,
                    currentdata:$('.multiple-select-refusers').val(),
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
        $('.coupon_usersss').change(function() {
            // alert('hi');
            $('.coupon_usersss').not(this).prop('checked', false);
            
            if($(this).val()==='All')
            {
                $(".select_radion").hide();
                $('.multiple-select-users').val("");
            } else{
                $(".select_radion").show();
                // alert('bye');
                // $("#selectedproducts").show();
                // $("#rangeproduct").hide();
            }
        });
        
        <?php if($edit_data['users']=='All'){ ?>
            
            $('.coup_user').not(this).prop('checked', true); 
            $(".coup_user1").removeAttr('checked');
            $(".select_radion").hide();
            $('.multiple-select-users').val("");
        <?php }else{ ?>
            $('.coup_user').not(this).prop('checked', false); 
            // $(".coup_user1").removeAttr('checked');
            $(".select_radion").show();

            <?php } ?>
        $('.coupon_prodsss').change(function() {
            // alert('hi');
            $('.coupon_prodsss').not(this).prop('checked', false);
            
            if($(this).val()==='All')
            {
                $(".select_radion1").hide();
                $('.products_new_drop').val("");
            } else{
                $(".select_radion1").show();
                // alert('bye');
                // $("#selectedproducts").show();
                // $("#rangeproduct").hide();
            }
        });
        <?php if($edit_data['products']=='All'){ ?>
            
            $('.prods').not(this).prop('checked', true); 
            $(".prods1").removeAttr('checked');
            $(".select_radion1").hide();
            $('.products_new_drop').val("");
        <?php }else{ ?>
            $('.prods').not(this).prop('checked', false); 
            // $(".prods1").removeAttr('checked');
            $(".select_radion1").show();
        <?php }?>
            
        $('.refuserss').change(function() {
            // alert('hi');
            $('.refuserss').not(this).prop('checked', false);
            if($(this).val()==='All')
            {
                $('.multiple-select-refusers').val("");
                $(".select_radion2").hide();
            } else{
                $(".select_radion2").show();
            }
        });

        <?php if($edit_data['refferal_users']=='All'){ ?>
            $('.refs').not(this).prop('checked', true); 
            $(".refs1").removeAttr('checked');
            $(".select_radion2").hide();
            $('.multiple-select-refusers').val("");
        <?php }else{ ?> 
            $('.refs').not(this).prop('checked', false); 
            // $(".refs1").removeAttr('checked');
            $(".select_radion2").show();
            // $('.multiple-select-refusers').val("");
        <?php } ?>
</script>