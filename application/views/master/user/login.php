<div class="mainContent px-3 px-md-5">
    <?php $this->load->view('elements/flash_messages'); ?>
    <form class="form-horizontal" autocomplete="off"   role="form" method="post" action="<?php echo base_url() . $lang_id . '/'; ?>user/check_user_login/true" id="login_form">
        <div class="loginWrapper m-auto">
            <div class="car-lists productlisting productbaselisting float-start w-100 bg-white my-3 my-md-5 p-3 p-md-5 rounded">
                <h4 class="cart-user-form mb-4"><?= $general_instruction->login_now_title; ?></h4>
                <div class="form-fill-cart float-start w-100 mb-0">
                    <div class="cart-form-grid float-start w-100">
                        <div class="col-lg-12 float-start w-100">

                            <div class="email_field">
                                <div class="form-group float-start w-100">
                                    <label for="login_email" class="col-sm-12 control-label"><?php echo $cart_instruction->email; ?>
                                        <span class="cart_asterisk">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control required_input email_validate" id="login_email" placeholder="<?php echo $cart_instruction->email; ?>" name="email" autocomplete="unInput" required>
                                    </div>
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group float-start w-100">
                                    <label for="address_1" class="col-sm-12 control-label"><?= $general_instruction->password_label; ?> <span class="cart_asterisk">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control required_input" id="password" placeholder="*************" name="password" value="">
                                        <span class="input-group-text" onclick="password_show_hide('password');">
                                            <i class="fa fa-eye d-none" id="password_show_eye"></i>
                                            <i class="fa fa-eye-slash " id="password_hide_eye"></i>
                                        </span>
                                    </div>
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group float-start w-100 mb-3">
                                    <a href="<?php echo base_url() . $lang_id . '/'; ?>user/forgotpassword" class="forgot-btn border-0 bg-transparent"><?= $general_instruction->forgot_pwd_text; ?></a>
                                    

                                </div>
                                <div class="form-group float-start w-100 mb-3">
                                   
                                    <?= $general_instruction->forgot_pwd_signup_content; ?>

                                    <a  href="<?php echo base_url() . $lang_id . '/' . 'user/signup'; ?>" class="forgot-btn border-0 bg-transparent"><?= $general_instruction->forgot_pwd_signup_click; ?></a>

                                </div>

                            </div>

                            <div class="otp_field" style="display: none;">
                                <div class="form-group float-start w-100">
                                    <label for="cart_email" class="col-sm-12 control-label"><?= $general_instruction->otp_code_label; ?>
                                        <span class="cart_asterisk">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" id="otp_code" placeholder="<?= $general_instruction->otp_code; ?>" name="otp_code">
                                    </div>
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group float-start w-100 mb-3 d-flex justify-content-start otpFld">
                                    <button type="button" class="forgot-btn border-0 bg-transparent" id="resend_otp" style="display: none;"><?= $general_instruction->resend_otp; ?></button>
                                    <div class="timerdiv p-0">
                                        <div id="timer11"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="resend" class="action_resend" value="0">
                            </div>

                            <div class="form-group float-start w-100 mb-0">
                                <a href="javascript:void(0)" class="btn actn-btn rounded" id="login"><?= $general_instruction->login_btn_text; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End content-->
    </form>
</div>

<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">



<span class="displaynon" id="hours"><?php echo $general_instruction->hours; ?></span>
<span class="displaynon" id="minutes"><?php echo $general_instruction->minutes; ?></span>
<span class="displaynon" id="seconds"><?php echo $general_instruction->seconds; ?></span>


<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">

<span class="displaynon" id="user_not_exist"><?php if (isset($general_instruction->user_not_exist)) echo $general_instruction->user_not_exist; ?></span>
<span class="displaynon" id="account_blocked"><?php if (isset($general_instruction->account_blocked)) echo $general_instruction->account_blocked; ?></span>
<span class="displaynon" id="password_not_set"><?php if (isset($general_instruction->password_not_set)) echo $general_instruction->password_not_set; ?></span>
<span class="displaynon" id="login_user_not_exist"><?php if (isset($general_instruction->login_user_not_exist)) echo $general_instruction->login_user_not_exist; ?></span>
<span class="displaynon" id="incorrect_login"><?php if (isset($general_instruction->incorrect_login)) echo $general_instruction->incorrect_login; ?></span>

<span class="displaynon" id="formvalidation_valid_email"><?php if (isset($form_validation_instruction->email)) echo $form_validation_instruction->email; ?></span>
<span class="displaynon" id="formvalidation_email"><?php if (isset($form_validation_instruction->valid_email)) echo $form_validation_instruction->valid_email; ?></span>
<span class="displaynon" id="formvalidation_password"><?php if (isset($form_validation_instruction->new_password)) echo $form_validation_instruction->new_password; ?></span>
<span class="displaynon" id="otp_sent_msg"><?php if (isset($general_instruction->otp_sent_msg)) echo $general_instruction->otp_sent_msg; ?></span>
<span class="displaynon" id="resend_otp"><?php if (isset($general_instruction->resend_otp)) echo $general_instruction->resend_otp; ?></span>
<span class="displaynon" id="formvalidation_otp_code"><?php if (isset($form_validation_instruction->otp_code)) echo $form_validation_instruction->otp_code; ?></span>
<span class="displaynon" id="incorrect_otp_code"><?php if (isset($form_validation_instruction->incorrect_otp_code)) echo $form_validation_instruction->incorrect_otp_code; ?></span>
<input type="hidden" id="signup_otp_timer" value="<?php if (isset($entry_door_timer->signup_otp_timer)) echo $entry_door_timer->signup_otp_timer * 60; ?>" />
<?php
$this->load->view('elements/popup/user_already_exist_popup');
?>