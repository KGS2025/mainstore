<?php
if (!empty($entry_users_data)) {
    $bal_time = time() - $entry_users_data['created_time'];
    $bal_count_time = $entry_door_timer->main_entry_door_timer * 60 - $bal_time;
} ?>

<div class="mainContent px-3 px-lg-5">
        <div class="entry_door">
            <div class="entryDoorBlock float-start w-100">
        <div class="alert-message block-message warning kgtmargin" style="text-align:center;">
            <?php if (isset($bal_count_time) && $bal_count_time != '' && $bal_count_time > 0) { ?>
                <div class="entry_door_counter counter_msg_wrap"><?php echo $entry_door_timer->main_entry_door_msg; ?></div>
            <?php } else { ?>
                <div class="entry_door_counter counter_msg_wrap"></div>
            <?php } ?>
            <div class="counter_msg_wrap_counter">
                <div id="timer5"></div>
            </div>
        </div>
                <div class="kgt60" id="contact_msg"></div>
                <div id="countdownplace" class="kgt61" ></div>
                <div class="contact-opacity">
                    <form class="form-horizontal" id="entry_door_form" role="form" action="<?php echo base_url() . $lang_id . '/'; ?>front/send_verification_code" method="post" >
                        <input type="hidden" value="submit" name="button_checkings" id="button_checkings">
                        <input type="hidden" id="entry_door_block_timer" name="entry_door_block_timer" value="<?php echo $entry_door_timer->entry_door_block_timer; ?>" />
                        <input type="hidden" value="<?php echo $email_attempt; ?>" id="email_attempt" name="email_attempt">
                        <input type="hidden" value="<?php echo $sms_attempt; ?>" id="sms_attempt" name="sms_attempt">
                        <input type="hidden" value="<?php echo $this->session->userdata('validemail'); ?>" id="validemail" name="validemail">
                        <input type="hidden" value="<?php echo $this->session->userdata('validphone'); ?>" id="validphone" name="validphone">
                        <input type="hidden" id="block_timezone" name="block_timezone" value=""/>
                        <div class="form-group mb-3">
                            <label class="col-md-12 control-label"><?php echo $cart_instruction->title; ?></label>
                            <?php
                            if (isset($entry_users_data['applicant']) && $entry_users_data['applicant'] != '') {
                                $title = $entry_users_data['applicant'];
                                $entry_users_data1['applicant'] = explode(" ", $title);
                                $entry_users_data1['applicant'] = $entry_users_data1['applicant'][0];
                            } else {
                                $entry_users_data1['applicant'] = '';
                            }?>
                            <div class="col-md-12 controls">
                                <span class="position-relative"><input type="radio" name="salutation" value="Mr." <?php if ($entry_users_data1['applicant'] == 'Mr.') { ?> checked="checked"<?php } ?>/><label for="radio1"><?php echo $cart_instruction->mr_title; ?></label></span>
                                <span class="position-relative mx-3"><input type="radio" name="salutation" value="Miss." <?php if ($entry_users_data1['applicant'] == 'Miss.') { ?> checked="checked"<?php } ?>/><label for="radio2"><?php echo $cart_instruction->ms_title; ?></label></span>
                                <span class="position-relative"><input type="radio" name="salutation" value="Other" <?php if ($entry_users_data1['applicant'] == 'Other') { ?> checked="checked"<?php } ?>/><label for="radio3"><?php echo $cart_instruction->other_title; ?></label></span>
                            </div>
                        </div>

                        <?php if (isset($entry_users_data['applicant']) && $entry_users_data['applicant'] != '') {
                            $entry_users_data['applicant'] = explode(" ", $entry_users_data['applicant']);
                            $entry_users_data['applicant'] = $entry_users_data['applicant'][1];
                        }?>

                        <div class="form-group mb-3">
                            <label class="col-md-12 control-label"><?php echo $cart_instruction->name_surname; ?></label>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo str_replace('<br />',' - ', $cart_instruction->name_surname); ?>" value="<?php echo isset($entry_users_data['applicant']) ? $entry_users_data['applicant'] : '' ?>">
                                <span class="red1"><?php echo form_error('name'); ?></span>

                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="col-md-12 control-label"><?php echo $cart_instruction->country; ?></label>
                            <div class="col-md-12 country_content position-relative">
                                    <?php $cart_users_country = isset($entry_users_data['country']) ? $entry_users_data['country'] : ''; ?>
                                <select autocomplete="no-fill" name="country" id="country" class="form-control selectpicker1 kgt2">
                                    <?php foreach ($countries as $country) {
                                        ?>
                                        <option value='<?php echo htmlentities($country['countryName'], ENT_QUOTES); ?>'
                                                data-image="assets/frontend/images/msdropdown/icons/blank.gif"
                                                data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>"
                                                data-rel="<?php echo $country['country_code']; ?>"
                                                data-title="<?php echo htmlentities($country['countryName']); ?>"
                                            <?php if (isset($cart_users_country) && $cart_users_country != '' && $cart_users_country == $country['lang_countryName']) { ?>selected="selected"<?php } else if (isset($cart_users_country) && $cart_users_country != '' && $cart_users_country == $country['countryName']) { ?>selected="selected"<?php } else if (isset($country['countryName']) && $country['countryName'] == "Canada") { ?> selected="selected"<?php } else if ($country['lang_countryName'] == "Canada") { ?>selected="selected" <?php } ?>>
                                        <?php echo $country['countryName']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="country_flag" id="country_flag"/>

                        <div class="form-group mb-3">
                            <label for="telephone" class="col-sm-12 control-label"><?php echo $cart_instruction->cellphone; ?></label>
                            <div class="row">
                                <div class="col-sm-2 country_code_div" style="padding-right:0px;">
                                    <input type="text" class="form-control" id="country_code" placeholder="+1" name="country_code" value="+<?php echo isset($entry_users_data['country_code']) ? $entry_users_data['country_code'] : '1' ?>" required readonly autocomplete="no-fill">
                                </div>

                                <div class="col-sm-10">
                                    <?php if (isset($entry_users_data['entry_sms_confirm']) && $entry_users_data['entry_sms_confirm'] == 1) { ?>
                                        <input type="text" class="form-control" id="telephone" placeholder="<?php echo str_replace('<br />',' - ', $cart_instruction->cellphone); ?>" name="telephone" value="<?php echo isset($entry_users_data['telephone']) ? $entry_users_data['telephone'] : '' ?>" required autocomplete="off" readonly>
                                        
                                        
                                        
                                        
                                    <?php } else { ?>

                                        <input type="text" class="form-control" id="telephone" placeholder="<?php echo str_replace('<br />',' - ', $cart_instruction->cellphone); ?>" name="telephone" value="<?php echo isset($entry_users_data['telephone']) ? $entry_users_data['telephone'] : '' ?>" required autocomplete="off">
                                    
                                    <?php } ?>
                                    <span class="red1"><?php echo form_error('telephone'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="col-md-12 control-label"><?php echo $cart_instruction->email; ?></label>
                            <div class="col-md-12">
                                <?php if (isset($entry_users_data['entry_sms_confirm']) && $entry_users_data['entry_email_confirm'] == 1) { ?>
                                    <input type="text" class="form-control" id="email" placeholder="<?php echo str_replace('<br />',' - ', $cart_instruction->email); ?>" name="email" value="<?php if (count($entry_users_data) > 0) echo isset($entry_users_data['email']) ? $entry_users_data['email'] : '' ?>" required autocomplete="off" readonly>
                                <?php } else { ?>

                                    <input type="text" class="form-control" id="email" placeholder="<?php echo str_replace('<br />',' - ', $cart_instruction->email); ?>" name="email" value="<?php if (count($entry_users_data) > 0) echo isset($entry_users_data['email']) ? $entry_users_data['email'] : '' ?>" required autocomplete="off">
                                    
                                <?php } ?>
                                <span class="red1"><?php echo form_error('email'); ?></span>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="col-md-12 control-label"><?php echo $cart_instruction->captcha_text; ?>:<br><div id="captImg"><?php echo generate_captcha();?></div><br></label>
                            <div class="col-md-12 controls">
                                <input type="text" class="form-control" id="captcha" placeholder="<?php echo $cart_instruction->captcha_text; ?>" name="captcha" value="" required autocomplete="off">
                                <span class="red1 trynewcaptcha mt-2 d-inline-block"><?php echo $cart_instruction->try_new_captcha_text; ?></span>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="col-md-12 text-center">
                                <a href="javascript:void(0)" class="btn  actn-btn rounded btn-lg" id="entry_door_submit"><?php echo $general_instruction->sbmt; ?></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>

<?php

$entry_users_data['country_code'] = isset($entry_users_data['country_code']) ? $entry_users_data['country_code'] : '';
$entry_users_data['telephone'] = isset($entry_users_data['telephone']) ? $entry_users_data['telephone'] : '';
$entry_users_data['email'] = isset($entry_users_data['email']) ? $entry_users_data['email'] : '';

$telephonevar            = '+' . $entry_users_data['country_code'] . $entry_users_data['telephone'];
$invalidvar              = ["EMAILVAR", "SMSVAR"];
$invalidfinalvar         = [$entry_users_data['email'], $telephonevar];
$smsinvalid_message      = str_replace($invalidvar, $invalidfinalvar, $cart_instruction->email_verified_sms_not);
$emailinvalid_message    = str_replace($invalidvar, $invalidfinalvar, $cart_instruction->sms_verified_email_not);
$emailsmsinvalid_message = str_replace($invalidvar, $invalidfinalvar, $cart_instruction->email_and_sms_not_verified);
$completedata['smsinvalid_message']      = $smsinvalid_message;
$completedata['emailinvalid_message']    = $emailinvalid_message; 
$completedata['emailsmsinvalid_message'] = $emailsmsinvalid_message;
$this->load->view('elements/popup/invalid_phone_popup', $completedata); 
$this->load->view('elements/popup/invalid_email_popup', $completedata);
$this->load->view('elements/popup/invalid_email_phone_popup', $completedata);
$this->load->view('elements/popup/action_notification_cart_popup');
$this->load->view('elements/popup/user_block_box');
$this->load->view('elements/popup/notify_submit_popup');
$this->load->view('elements/popup/entry_door_success_popup');
?>

<span class="displaynon" id="fd_main_block_msg"><?php if (isset($selection_instruction->fd_main_block_msg)) echo $selection_instruction->fd_main_block_msg; ?></span>
<span class="displaynon" id="fd_edit_block_msg"><?php if (isset($selection_instruction->fd_edit_block_msg)) echo $selection_instruction->fd_edit_block_msg; ?></span>
<span class="displaynon" id="fd_verification_block_msg"><?php if (isset($selection_instruction->fd_verification_block_msg)) echo $selection_instruction->fd_verification_block_msg; ?></span>
<span class="displaynon" id="fd_verification_resent_block_msg"><?php if (isset($selection_instruction->fd_verification_resent_block_msg)) echo $selection_instruction->fd_verification_resent_block_msg; ?></span>
<span class="displaynon" id="fd_verification_resent_block_msg_sms"><?php if (isset($selection_instruction->fd_verification_resent_block_msg_sms)) echo $selection_instruction->fd_verification_resent_block_msg_sms; ?></span>
<span class="displaynon" id="fd_verification_resent_block_msg_email_sms"><?php if (isset($selection_instruction->fd_verification_resent_block_msg_email_sms)) echo $selection_instruction->fd_verification_resent_block_msg_email_sms; ?></span>
<span class="displaynon" id="fd_verification_wrong_block_msg"><?php if (isset($selection_instruction->fd_verification_wrong_block_msg)) echo $selection_instruction->fd_verification_wrong_block_msg; ?></span>
<span class="displaynon" id="fd_verification_wrong_block_msg_sms"><?php if (isset($selection_instruction->fd_verification_wrong_block_msg_sms)) echo $selection_instruction->fd_verification_wrong_block_msg_sms; ?></span>
<span class="displaynon" id="fd_verification_wrong_block_msg_email_sms"><?php if (isset($selection_instruction->fd_verification_wrong_block_msg_email_sms)) echo $selection_instruction->fd_verification_wrong_block_msg_email_sms; ?></span>
<span class="displaynon" id="fd_block_notification_msg"><?php if (isset($selection_instruction->fd_block_notification_msg)) echo $selection_instruction->fd_block_notification_msg; ?></span>
<span class="displaynon" id="fd_block_notification_msg_sms"><?php if (isset($selection_instruction->fd_block_notification_msg_sms)) echo $selection_instruction->fd_block_notification_msg_sms; ?></span>
<span class="displaynon" id="fd_block_notification_msg_email_sms"><?php if (isset($selection_instruction->fd_block_notification_msg_email_sms)) echo $selection_instruction->fd_block_notification_msg_email_sms; ?></span>
<span class="displaynon" id="please_wait"><?php if (isset($general_instruction->please_wait)) echo $general_instruction->please_wait; ?></span>
<span class="displaynon" id="hours"><?php if (isset($general_instruction->hours)) echo $general_instruction->hours; ?></span>
<span class="displaynon" id="minutes"><?php if (isset($general_instruction->minutes)) echo $general_instruction->minutes; ?></span>
<span class="displaynon" id="seconds"><?php if (isset($general_instruction->please_wait)) echo $general_instruction->seconds; ?></span>
<span class="displaynon" id="formvalidation_title"><?php if (isset($form_validation_instruction->invalid_title)) echo $form_validation_instruction->invalid_title; ?></span>
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
<span class="displaynon" id="invalid_captcha"><?php if (isset($cart_instruction->invalid_captcha)) echo $cart_instruction->invalid_captcha; ?></span>
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">
