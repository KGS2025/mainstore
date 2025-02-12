<div class="mainContent px-3 px-lg-5">
    <?php $this->load->view('elements/flash_messages'); ?>
    <form class="form-horizontal" role="form" method="post" id="password_form" enctype="multipart/form-data">
        <div class="loginWrapper m-auto">
            <div class="car-lists productlisting productbaselisting float-start w-100 bg-white my-3 my-md-5 p-3 p-md-5 rounded">
                <h4 class="cart-user-form mb-4"><?= $action ? $general_instruction->reset_password_title : $general_instruction->create_password_title; ?></h4>
                <div class="form-fill-cart float-start w-100 mb-0">
                    <div class="cart-form-grid float-start w-100">
                        <div class="col-lg-12 float-start w-100">

                            <div class="form-group float-start w-100">
                                <input type="hidden" name="token" class="user_token" value="<?= $access_token; ?>">
                                <?php if ($action) { ?>
                                    <input type="hidden" name="action" class="reset_action" value="reset">
                                <?php } else { ?>
                                    <input type="hidden" name="action" class="reset_action" value="">
                                <?php } ?>
                                <label for="address_1" class="col-sm-12 control-label"><?= $general_instruction->password_label; ?> <span class="cart_asterisk">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control required_input" id="new_password" placeholder="*************" name="password">
                                    <span class="input-group-text" onclick="password_show_hide('new_password');">
                                        <i class="fa fa-eye d-none" id="new_password_show_eye"></i>
                                        <i class="fa fa-eye-slash " id="new_password_hide_eye"></i>
                                    </span>
                                </div>
                                <p class="help-block"></p>
                            </div>

                            <div class="form-group float-start w-100 cnf_pwd">
                                <label for="address_1" class="col-sm-12 control-label"><?= $general_instruction->confirm_password_label; ?> <span class="cart_asterisk">*</span></label>
                                <div class="input-group mb-3">

                                    <input type="password" class="form-control required_input" id="confirm_password" placeholder="*************" name="confirm_password">
                                    <span class="input-group-text" onclick="password_show_hide('confirm_password');">
                                        <i class="fa fa-eye d-none" id="confirm_password_show_eye"></i>
                                        <i class="fa fa-eye-slash" id="confirm_password_hide_eye"></i>
                                    </span>
                                </div>
                                <p class="help-block"></p>
                            </div>

                            <div class="form-group float-start w-100">
                                <label for="cart_email" class="col-sm-12 control-label"><?= $general_instruction->otp_code_label; ?>
                                    <span class="cart_asterisk">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control required_input" id="otp_code" placeholder="OTP Code" name="otp_code" required>
                                </div>
                                <p class="help-block"></p>
                            </div>

                            <div class="form-group float-start w-100 mb-3 d-flex justify-content-start  otpFld">
                                <button type="button" class="forgot-btn border-0 bg-transparent" id="send_otp_code"><?= $general_instruction->send_otp; ?></button>
                                <div class="timerdiv p-0">
                                    <div id="timer11"></div>
                                </div>
                            </div>

                            <div class="form-group float-start w-100 mb-0">
                                <a href="javascript:void(0)" class="btn actn-btn rounded" id="create_password"><?= $general_instruction->update_btn_text; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End content-->
    </form>
</div>

<span class="displaynon" id="formvalidation_password"><?php if (isset($form_validation_instruction->new_password)) echo $form_validation_instruction->new_password; ?></span>
<span class="displaynon" id="formvalidation_confirm_password"><?php if (isset($form_validation_instruction->confirm_password)) echo $form_validation_instruction->confirm_password; ?></span>
<span class="displaynon" id="formvalidation_otp_code"><?php if (isset($form_validation_instruction->otp_code)) echo $form_validation_instruction->otp_code; ?></span>
<span class="displaynon" id="formvalidation_confirm_password_mismatch"><?php if (isset($form_validation_instruction->confirm_password_mismatch)) echo $form_validation_instruction->confirm_password_mismatch; ?></span>
<span class="displaynon" id="incorrect_otp_code"><?php if (isset($form_validation_instruction->incorrect_otp_code)) echo $form_validation_instruction->incorrect_otp_code; ?></span>
<span class="displaynon" id="resend_otp"><?php if (isset($general_instruction->resend_otp)) echo $general_instruction->resend_otp; ?></span>
<span class="displaynon" id="user_not_exist"><?php if (isset($general_instruction->user_not_exist)) echo $general_instruction->user_not_exist; ?></span>
<span class="displaynon" id="password_success"><?php if (isset($general_instruction->password_success)) echo $general_instruction->password_success; ?></span>
<span class="displaynon" id="account_blocked"><?php if (isset($general_instruction->account_blocked)) echo $general_instruction->account_blocked; ?></span>
<span class="displaynon" id="otp_sent_msg"><?php if (isset($general_instruction->otp_sent_msg)) echo $general_instruction->otp_sent_msg; ?></span>

<input type="hidden" id="signup_otp_timer" value="<?php if (isset($entry_door_timer->signup_otp_timer)) echo $entry_door_timer->signup_otp_timer; ?>" />

<?php
$this->load->view('elements/popup/user_already_exist_popup');
$this->load->view('elements/popup/user_activation_msg_popup');
?>