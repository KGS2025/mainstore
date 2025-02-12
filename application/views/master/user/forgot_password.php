<div class="mainContent px-3 px-lg-5">
    <?php $this->load->view('elements/flash_messages'); ?>
    <form class="form-horizontal" role="form" method="post" id="password_form" enctype="multipart/form-data">
        <div class="loginWrapper m-auto">
            <div class="car-lists productlisting productbaselisting float-start w-100 bg-white my-3 my-md-5 p-3 p-md-5 rounded">
                <h4 class="cart-user-form"><?= $general_instruction->forgot_pwd_text; ?>?</h4>
                <p class="mb-4"><?= $general_instruction->forgot_pwd_page_sub_title; ?></p>
                <div class="form-fill-cart float-start w-100 mb-0">
                    <div class="cart-form-grid float-start w-100">
                        <div class="col-lg-12 float-start w-100">
                            <div class="form-group float-start w-100">
                                <label for="login_email" class="col-sm-12 control-label"><?php echo $cart_instruction->email; ?>
                                    <span class="cart_asterisk">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control required_input email_validate" id="login_email" placeholder="Email" name="email" required>
                                </div>
                                <p class="help-block"></p>
                            </div>

                            <div class="form-group float-start w-100 mb-0">
                                <a href="javascript:void(0)" class="btn actn-btn rounded" id="reset_password"><?= $general_instruction->reset; ?></a>
                                <a href="<?php echo base_url() . $lang_id . '/'; ?>user/login" class="btn actn-btn rounded"><?= $cart_instruction->cancel; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End content-->
    </form>
</div>

<span class="displaynon" id="formvalidation_valid_email"><?php if (isset($form_validation_instruction->email)) echo $form_validation_instruction->email; ?></span>
<span class="displaynon" id="formvalidation_email"><?php if (isset($form_validation_instruction->valid_email)) echo $form_validation_instruction->valid_email; ?></span>

<span class="displaynon" id="user_not_exist"><?php if (isset($general_instruction->user_not_exist)) echo $general_instruction->user_not_exist; ?></span>
<span class="displaynon" id="account_blocked"><?php if (isset($general_instruction->account_blocked)) echo $general_instruction->account_blocked; ?></span>
<span class="displaynon" id="login_user_not_exist"><?php if (isset($general_instruction->login_user_not_exist)) echo $general_instruction->login_user_not_exist; ?></span>
<span class="displaynon" id="password_not_set"><?php if (isset($general_instruction->password_not_set)) echo $general_instruction->password_not_set; ?></span>
<span class="displaynon" id="reset_link"><?php if (isset($general_instruction->reset_link)) echo $general_instruction->reset_link; ?></span>

<?php 
    $this->load->view('elements/popup/user_already_exist_popup'); 
    $this->load->view('elements/popup/user_activation_msg_popup');
?>