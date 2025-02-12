<?php
if (!empty($entry_users_data)) {
    $bal_time = time() - $entry_users_data['created_time'];
    $bal_count_time = $entry_door_timer->main_entry_door_timer * 60 - $bal_time;
} ?>
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">

<?php $this->load->view('elements/body_logo'); ?>


<div class="ct-videoSection float-start w-100 px-4 px-md-5">
    <div class="ct-services float-start w-100">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="ct-team-box p-0">
                <div class="common-search float-start w-100 my-3">
                    <div class="text-header">
                        <?php $this->load->view('elements/search'); ?>
                    </div>
                </div>

                <div class="home-quick-search-wrap float-start w-100">
                    <?php $this->load->view('elements/quicksearch'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
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
            <div id="countdownplace" class="kgt61"></div>
            <div class="contact-opacity">
                <input type="hidden" class="msg-length" value="<?php echo $contact_timer->edit_contact_msg_length; ?>" />
                <form class="form-horizontal" id="contact_form" role="form" action="<?php echo base_url() . $lang_id . '/'; ?>user/send_credit_verification_code" method="post">
                    <input type="hidden" value="submit" name="button_checkings" id="button_checkings">

                    <input type="hidden" id="data_preview_timer" name="data_preview_timer" value="<?php echo $contact_timer->contact_preview_timer; ?>" />
                    <input type="hidden" id="data_preview_msg" name="data_preview_msg" value="<?php echo $contact_timer->contact_preview_msg; ?>" />



                    <input type="hidden" id="main_contact_timer" name="main_contact_timer" value="<?php echo $contact_timer->main_contact_timer; ?>" />

                    <input type="hidden" id="main_contact_msg" name="main_contact_msg" value="<?php echo $contact_timer->main_contact_msg; ?>" />


                    <input type="hidden" id="contact_edit_timer" name="contact_edit_timer" value="<?php echo $contact_timer->contact_edit_timer; ?>" />

                    <input type="hidden" id="contact_edit_msg" name="contact_edit_msg" value="<?php echo $contact_timer->contact_edit_msg; ?>" />

                    <input type="hidden" id="block_timezone" name="block_timezone" value="" />
                    <input type="hidden" id="operation" name="operation" value="set">

                    <div class="form-group mb-3">
                        <label class="col-md-12 control-label"><?php echo $cart_instruction->title; ?></label>
                        <div class="col-md-12 controls">
                            <span class="position-relative"><input type="radio" class="required_input" name="salutation" value="Mr." /><label for="radio1"><?php echo $cart_instruction->mr_title; ?></label></span>
                            <span class="position-relative mx-3"><input type="radio" class="required_input" name="salutation" value="Miss." /><label for="radio2"><?php echo $cart_instruction->ms_title; ?></label></span>
                            <span class="position-relative"><input type="radio" class="required_input" name="salutation" value="Other" /><label for="radio3"><?php echo $cart_instruction->other_title; ?></label></span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="col-md-12 control-label"><?php echo $cart_instruction->name_surname; ?></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->name_surname); ?>" value="">
                            <span class="red1 w-100"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="col-md-12 control-label"><?php echo $cart_instruction->designation; ?></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="designation" id="designation" placeholder="<?php echo $cart_instruction->designation; ?>" value="">
                            <span class="red1 w-100"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="col-md-12 control-label"><?php echo $cart_instruction->company; ?></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="company" id="company" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->company); ?>" value="">
                            <span class="red1 w-100"><?php echo form_error('company'); ?></span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="col-md-12 control-label"><?php echo $cart_instruction->country; ?></label>
                        <div class="col-md-12 country_content position-relative">
                            <select autocomplete="no-fill" name="country" id="country" class="form-control selectpicker1 kgt2">
                                <?php foreach ($countries as $country) { ?>
                                    <option value='<?php echo htmlentities($country['countryName'], ENT_QUOTES); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" <?php if(isset($ip_data['countryCode'])  && strtoupper($country['alpha_2']) == $ip_data['countryCode']) { ?> selected="selected" <?php } else  if (isset($country['countryName']) && $country['countryName'] == "Canada") { ?> selected="selected" <?php } else if ($country['lang_countryName'] == "Canada") { ?>selected="selected" <?php } ?>>
                                        <?php echo $country['countryName']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="country_flag" id="country_flag" />

                    <div class="form-group mb-3">
                        <label for="telephone" class="col-sm-12 control-label"><?php echo $cart_instruction->cellphone; ?></label>
                        <div class="row">
                            <div class="col-sm-2 country_code_div" style="padding-right:0px;">
                                <input type="text" class="form-control" id="country_code" placeholder="+1" name="country_code" value="+1" required readonly autocomplete="no-fill">
                            </div>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="telephone" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->cellphone); ?>" name="telephone" required autocomplete="off">

                                <span class="red1 w-100"><?php echo form_error('telephone'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="col-md-12 control-label"><?php echo $cart_instruction->email; ?></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="email" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->email); ?>" name="email" value="" required autocomplete="off">
                            <span class="red1 w-100"><?php echo form_error('email'); ?></span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="col-md-12 control-label"><?php echo $cart_instruction->contact_message; ?></label>
                        <div class="col-md-12">
                            <textarea onclick="this.id" class="form-control" id="message" name="message" placeholder="<?php echo $form_validation_instruction->max_character_txt.' '.$contact_timer->edit_contact_msg_length; ?>" maxlength="<?= $contact_timer->edit_contact_msg_length;?>"> </textarea>
                            <span class="red1 w-100"><?php echo form_error('email'); ?></span>
                            <small class="pull-left w-100">(<?php echo $form_validation_instruction->max_character_txt ?>&nbsp;0/<span id="desc_chars"><?= $contact_timer->edit_contact_msg_length;?></span>)</small>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="col-md-12 control-label"><?php echo $cart_instruction->captcha_text; ?>:<br>
                            <div id="captImg"><?php echo generate_captcha(); ?></div><br>
                        </label>
                        <div class="col-md-12 controls">
                            <input type="text" class="form-control" id="captcha" placeholder="<?php echo $cart_instruction->captcha_text; ?>" name="captcha" value="" required autocomplete="off">
                            <span class="red1 trynewcaptcha mt-2 d-inline-block  w-100"><?php echo $cart_instruction->try_new_captcha_text; ?></span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="col-md-12 text-center">
                            <button class="btn actn-btn rounded btn-lg" id="entry_door_submit"><?php echo $general_instruction->sbmt; ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--End content-->
</div>

<!--Modal shopping decision cart-->
<div class="modal fade" id="modal_mssg">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <h5 id="already_added_msg_title" class="title-modal"></h5>
                    <p id="already_added_msg"></p>
                    <div class="btn-modal text-center">
                        <?php if ($lang_id == 'ar') { ?>
                            <a href="javascript:void(0)" onClick="$('#modal_mssg').modal('hide');" class="btn   actn-btn rounded"><i class="fa fa-angle-left"></i> <?php echo $general_instruction->ok; ?></a>
                        <?php } else { ?>
                            <a href="javascript:void(0)" onClick="$('#modal_mssg').modal('hide');" class="btn   actn-btn rounded"><?php echo $general_instruction->ok; ?><i class="fa fa-angle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="user_block_box">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <div class="blockElementWrap">
                        <div class="blockMsg" id="blockMsg"><?php echo lang('You Have Been Blocked.') ?>
                            <br> <?php echo lang('Please Try After 120 minutes.') ?>
                        </div>
                        <div id="edit_cart_mode_on" class="displaynon"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 text-right">
                                <?php if ($lang_id == 'ar') { ?>
                                    <a href="javascript:void(0)" onClick="$('#user_block_box').modal('hide'); window.location.href = ' <?php echo base_url() . $lang_id . '/' . 'user/apply_credit'; ?>'" class="btn   actn-btn rounded" id="block_confirm_msg"><i class="fa fa-angle-left"></i> <?php echo $general_instruction->ok; ?> </a>
                                <?php } else { ?>
                                    <a href="javascript:void(0)" onClick="$('#user_block_box').modal('hide'); window.location.href = ' <?php echo base_url() . $lang_id . '/' . 'user/apply_credit'; ?>'" class="btn   actn-btn rounded" id="block_confirm_msg"><?php echo $general_instruction->ok; ?> <i class="fa fa-angle-right"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal_success">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal"><?php echo $general_instruction->success_text; ?></h2>
                    <p id="success_msge"></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <a href="javascript:void(0)" id="ok_bttn" onClick="$('#modal_success').modal('hide')" class="floatright1 btn btn-primary btn-sm"><?php echo $general_instruction->ok; ?> <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>






<div class="modal fade" id="timeout_modal_block">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal blink"><?php echo $general_instruction->warning_text; ?>: </h2>
                    <?php
                    $user_data = $this->session->userdata('new_session');
                    $msg = preg_replace('/\bPHRASE\b/', $user_data['email'], $contact_message['preview_timeout']); //"Unfortunately, you did not accomplish the required task within the given lead-time.  Therefore, you will be welcome to use an alternative email or wait for 120 minutes to use the current email " . $user_data['email'] . " within our website. ";
                    ?>
                    <p><?php echo $msg; ?></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <a href="javascript:void(0)" onClick="$('.modal').modal('hide');
                                if (typeof clock !== 'undefined') {
                                    clock.reset();
                                }
                                $('#countdownplace').html('');
                                contact_timer('edit');" class="floatright1 block_bttn1 btn btn-primary btn-sm"><?php echo $general_instruction->ok; ?> <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-----------  Preview popup  ----->
<div class="modal fade" id="contact_preview_block">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <div class="box-content-modal">
                    <h4 class="title-modal floatleft1"><?php echo $contact_timer->contact_preview_msg; ?></h4>

                    <div class="kgt9" id="contact_preview__msg"></div>
                    <div id="contact_view_timer" class="kgt62"></div>
                    <div class="show_data"></div>
                    <div class="btn-modal toyota-page">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="#" class="btn  actn-btn rounded" id="send_form"><?php echo $general_instruction->sbmt; ?> <i class="fa fa-angle-right"></i></a>
                                <a href="javascript:void(0)" id="edit_bttn" class="btn  actn-btn rounded"><?php echo $general_instruction->edit; ?> <i class="fa fa-angle-right"></i></a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-------------   Preview popup end ----->


<!--Modal shopping decision cart-->
<div class="modal fade" id="modal_mssg">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <h5 id="already_added_msg_title" class="title-modal"></h5>
                    <p id="already_added_msg"></p>
                    <div class="btn-modal text-center">
                        <?php if ($lang_id == 'ar') { ?>
                            <a href="javascript:void(0)" onClick="$('#modal_mssg').modal('hide');" class="btn   actn-btn rounded"><i class="fa fa-angle-left"></i> <?php echo $general_instruction->ok; ?></a>
                        <?php } else { ?>
                            <a href="javascript:void(0)" onClick="$('#modal_mssg').modal('hide');" class="btn   actn-btn rounded"><?php echo $general_instruction->ok; ?><i class="fa fa-angle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->







<!---- error Model ------>
<div class="modal fade" id="modal_error">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal blink"><?php echo $general_instruction->warning_text; ?>: </h2>
                    <p id="contact_form_error_msge"></p>
                    <div class="clearfix"></div>
                    <div class="btn-modal toyota-page">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="javascript:void(0)" id="error_bttn" onClick="$('#modal_error').modal('hide')" class="btn  actn-btn rounded"><?php echo $general_instruction->ok; ?> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!---- error Model ------>


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
<span class="displaynon" id="formvalidation_salutation"><?php if (isset($form_validation_instruction->invalid_title)) echo $form_validation_instruction->invalid_title; ?></span>

<span class="displaynon" id="formvalidation_title"><?php if (isset($form_validation_instruction->popup_title)) echo $form_validation_instruction->popup_title; ?></span>
<span class="displaynon" id="formvalidation_name"><?php if (isset($form_validation_instruction->name)) echo $form_validation_instruction->name; ?></span>
<span class="displaynon" id="formvalidation_company"><?php if (isset($form_validation_instruction->company)) echo $form_validation_instruction->company; ?></span>
<span class="displaynon" id="formvalidation_address"><?php if (isset($form_validation_instruction->address)) echo $form_validation_instruction->address; ?></span>
<span class="displaynon" id="formvalidation_message"><?php if (isset($form_validation_instruction->message)) echo $form_validation_instruction->message; ?></span>
<span class="displaynon" id="formvalidation_designation"><?php if (isset($form_validation_instruction->ship_designation)) echo $form_validation_instruction->ship_designation; ?></span>
<span class="displaynon" id="formvalidation_captcha"><?php if (isset($form_validation_instruction->captcha)) echo $form_validation_instruction->captcha; ?></span>

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
<span class="displaynon" id="session_name">credit_users_data</span>