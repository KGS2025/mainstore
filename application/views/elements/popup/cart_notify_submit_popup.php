<div class="modal fade" id="notify_submit">
   <div class="modal-dialog modal-lg  modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-body">
            <div class="box-content-modal">
               <input type="hidden" id="cart_email" value="<?php echo $cart_users_data['email']; ?>" />
               <input type="hidden" id="currentForm" value="cart_verification_form" />
               <form action="#" id="cart_verification_form" method="post" enctype="multipart/form-data">
                  <?php if ($front_validuser_data['country_code'] == $cart_users_data['country_code'] && $front_validuser_data['telephone'] == $cart_users_data['telephone']) {
                     $verification_message = str_replace('EMAILVAR', $cart_users_data['email'], $cart_instruction->verification_code_to_email); ?>
                     <h5 class="title-modal kgt42"><?php echo $verification_message; ?></h5>
                  <?php } else if ($front_validuser_data['email'] == $cart_users_data['email']) {
                     $telephonevar = $cart_users_data['country_code'] . $cart_users_data['telephone'];
                     $verification_message = str_replace('SMSVAR', $telephonevar, $cart_instruction->verification_code_to_sms); ?>
                     <h5 class="title-modal kgt42"><?php echo $verification_message; ?></h5>
                  <?php } else if ($cart_email_confirm != 1 && $cart_sms_confirm != 1) {
                     $telephonevar = $cart_users_data['country_code'] . $cart_users_data['telephone'];
                     $verificationvar = ["EMAILVAR", "SMSVAR"];
                     $verificationfinalvar = [$cart_users_data['email'], $telephonevar];
                     $verification_message = str_replace($verificationvar, $verificationfinalvar, $cart_instruction->verification_code_to_email_and_sms); ?>
                     <h5 class="title-modal kgt42"><?php echo $verification_message; ?></h5>
                  <?php } else if ($cart_email_confirm != 1) {
                     $verification_message = str_replace('EMAILVAR', $cart_users_data['email'], $cart_instruction->verification_code_to_email); ?>
                     <h5 class="title-modal kgt42"><?php echo $verification_message; ?></h5>
                  <?php } else if ($cart_sms_confirm != 1) {
                     $telephonevar = $cart_users_data['country_code'] . $cart_users_data['telephone'];
                     $verification_message = str_replace('SMSVAR', $telephonevar, $cart_instruction->verification_code_to_sms); ?>
                     <h5 class="title-modal kgt42"><?php echo $verification_message; ?></h5>
                  <?php } ?>

                  <div class="blink">
                     <div class="product_counter_msg counter_msg_wrap verfication_error_msg colorgray"></div>
                  </div>
                  <div class="alert-message block-message warning">
                     <div class="product_counter_msg counter_msg_wrap" id="cart_pop_msg"></div>
                     <span class="displaynon" id="cart_preview_timer"></span>
                  </div>
                  <div class="alert-message block-message warning">
                  </div>

                  <input type="hidden" id="valid_email" name="valid_email" value="" />
                  <input type="hidden" id="valid_phone" name="valid_phone" value="" />
                  <input type="hidden" id="timezone" name="timezone" value="" />
                  <input type="hidden" name="currency" value="<?php echo $this->session->userdata('cart_final_currency'); ?>" />
                  <input type="hidden" name="total" value="<?php echo $this->session->userdata('cart_final_price'); ?>" />
                  <?php if (($front_validuser_data['country_code'] == $cart_users_data['country_code'] && $front_validuser_data['telephone'] == $cart_users_data['telephone']) && $cart_sms_confirm != 1) {
                     ?>
                     <div class="col-lg-12 float-start w-100 mb-3">
                        <div class="row">
                           <div class="col-sm-6">
                              <label><?php echo $cart_instruction->enter_email_code; ?>: </label>
                           </div>
                           <div class="col-sm-6">
                              <input class="form-control" type="text" name="ecart_verification_codemail" id="ecart_verification_codemail"> 
                           </div>
                        </div>
                     </div>
                     <input type="hidden" name="ecart_verification_codesms" value="<?php echo getenv('TEST_SMS_CODE');?>" />
                  <?php } else if ($front_validuser_data['email'] == $cart_users_data['email'] && $cart_email_confirm != 1) {
                     ?>
                     <div class="col-lg-12 float-start w-100 mb-3">
                        <div class="row">
                           <div class="col-sm-6">
                              <label><?php echo $cart_instruction->enter_sms_code; ?>:</label> 
                           </div>
                           <div class="col-sm-6">
                              <input class="form-control" type="text" name="ecart_verification_codesms" id="ecart_verification_codesms">
                           </div>
                        </div>
                     </div>
                     <input type="hidden" name="ecart_verification_codemail" value="<?php echo getenv('TEST_EMAIL_CODE');?>" />
                  <?php } else if ($cart_email_confirm != 1 && $cart_sms_confirm != 1) { ?>
                     <div class="col-lg-12 float-start w-100 mb-3">
                        <div class="row">
                           <div class="col-sm-6">
                              <label><?php echo $cart_instruction->enter_email_code; ?>:</label> 
                           </div>
                           <div class="col-sm-6">
                              <input class="form-control" type="text" name="ecart_verification_codemail" id="ecart_verification_codemail"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-12 float-start w-100 mb-3">
                        <div class="row">
                           <div class="col-sm-6">
                              <label><?php echo $cart_instruction->enter_sms_code; ?>:</label>
                           </div> 
                           <div class="col-sm-6">
                              <input class="form-control" type="text" name="ecart_verification_codesms" id="ecart_verification_codesms">
                           </div>
                        </div>
                     </div>
                  <?php } else if ($cart_email_confirm != 1) { ?>
                     <div class="col-lg-12 float-start w-100 mb-3">
                        <div class="row">
                           <div class="col-sm-6">
                              <label><?php echo $cart_instruction->enter_email_code; ?>:</label>
                           </div> 
                           <div class="col-sm-6">
                              <input  class="form-control" type="text" name="ecart_verification_codemail" id="ecart_verification_codemail"> 
                           </div>
                        </div>
                     </div>
                     <input type="hidden" name="ecart_verification_codesms" value="<?php echo $sms_verification_code; ?>" /> <?php } else if ($cart_sms_confirm != 1) { ?>
                     <div class="col-lg-12 float-start w-100 mb-3">
                        <div class="row">
                           <div class="col-sm-6">
                              <label><?php echo $cart_instruction->enter_sms_code; ?>:</label>
                           </div> 
                           <div class="col-sm-6">
                              <input  class="form-control" type="text" name="ecart_verification_codesms" id="ecart_verification_codesms">
                           </div>
                        </div>
                     </div>
                     <input type="hidden" name="ecart_verification_codemail" value="<?php echo $email_verification_code; ?>" />
                  <?php } ?>
                  
                  <div class="col-lg-12 float-start w-100 mb-3">
                     <div class="row">
                        <div class="col-sm-6 timerdiv">
                           <div id="timer11"></div>
                        </div>
                        <div class="col-sm-6">
                        <img class="loaderimagecontinue displaynon" src="<?php echo base_url();?>assets/frontend/images/loading.gif"
                                 alt="loaderimagecontinue"/>
                        </div>
                     </div>
                  </div>

                  <div class="btn-modal toyota-page">
                     <div class="row">  
                        <div class="col-md-12">
                           <?php if ($lang_id == 'ar') { ?>
                              <a href="javascript:void(0);" onclick="cancel_popup_click();" id="cart_pop_cancel" class="btn btn-primary  actn-btn rounded"><i class="fa fa-angle-left"></i><?php echo $cart_instruction->cancel; ?></a>
                           <?php } else { ?>
                              <a href="javascript:void(0);" onclick="cancel_popup_click();" id="cart_pop_cancel" class="btn btn-primary  actn-btn rounded"><?php echo $cart_instruction->cancel; ?> <i class="fa fa-angle-right"></i></a>
                           <?php } ?>
                           <?php if ($lang_id == 'ar') { ?>
                              <a href="javascript:void(0);" class="btn btn-primary  actn-btn rounded" id="resend_email_code"><i class="fa fa-angle-left"></i><?php echo $cart_instruction->resend; ?> </a>
                           <?php } else { ?>
                              <a href="javascript:void(0);" class="btn btn-primary  actn-btn rounded" id="resend_email_code"><?php echo $cart_instruction->resend; ?> <i class="fa fa-angle-right"></i></a>
                           <?php } ?>
                           <?php if ($lang_id == 'ar') { ?>
                              <a href="javascript:void(0);" class="btn btn-primary  actn-btn rounded" id="cart_verification_confirm"><i class="fa fa-angle-left"></i><?php echo $cart_instruction->confirm; ?> </a>
                           <?php } else { ?>
                              <a href="javascript:void(0);" class="btn btn-primary  actn-btn rounded" id="cart_verification_confirm"><?php echo $cart_instruction->confirm; ?> <i class="fa fa-angle-right"></i></a>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
               </form>

               <span class="displaynon" id="cartverification_block_msg"><?php if (isset($selection_instruction->cartverification_block_msg)) echo $selection_instruction->cartverification_block_msg; ?></span>
               <span class="displaynon" id="cartverification_resent_block_msg"><?php if (isset($selection_instruction->cartverification_resent_block_msg)) echo $selection_instruction->cartverification_resent_block_msg; ?></span>
               <span class="displaynon" id="cartverification_wrong_block_msg"><?php if (isset($selection_instruction->cartverification_wrong_block_msg)) echo $selection_instruction->cartverification_wrong_block_msg; ?></span>
               <span class="displaynon" id="block_notification_msg"><?php if (isset($selection_instruction->block_notification_msg)) echo $selection_instruction->block_notification_msg; ?></span>
               <span class="displaynon" id="cartverification_resent_block_msg_sms"><?php if (isset($selection_instruction->cartverification_resent_block_msg_sms)) echo $selection_instruction->cartverification_resent_block_msg_sms; ?></span>
               <span class="displaynon" id="cartverification_wrong_block_msg_sms"><?php if (isset($selection_instruction->cartverification_wrong_block_msg_sms)) echo $selection_instruction->cartverification_wrong_block_msg_sms; ?></span>
               <span class="displaynon" id="block_notification_msg_sms"><?php if (isset($selection_instruction->block_notification_msg_sms)) echo $selection_instruction->block_notification_msg_sms; ?></span>
               <span class="displaynon" id="cartverification_wrong_block_msg_email_sms"><?php if (isset($selection_instruction->cartverification_wrong_block_msg_email_sms)) echo $selection_instruction->cartverification_wrong_block_msg_email_sms; ?></span>
               <span class="displaynon" id="cartverification_resent_block_msg_email_sms"><?php if (isset($selection_instruction->cartverification_resent_block_msg_email_sms)) echo $selection_instruction->cartverification_resent_block_msg_email_sms; ?></span>
            </div>
         </div>
      </div>
   </div>
</div>