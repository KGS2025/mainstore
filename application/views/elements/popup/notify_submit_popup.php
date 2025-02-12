<div class="modal fade" id="notify_submit">
   <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-body">
            <div class="box-content-modal">
               <input type="hidden" id="currentForm" value="entry_verification_form" />
               <form action="#" id="entry_verification_form" method="post">
                  <?php
                  $telephonevar    = isset($entry_users_data['country_code']) ? '+' . $entry_users_data['country_code'] . $entry_users_data['telephone'] : '';
                  $verificationvar = ["EMAILVAR", "SMSVAR"];
                  $verificationfinalvar = isset($entry_users_data['email']) ? [$entry_users_data['email'], $telephonevar] : '';
                  $verification_message = str_replace($verificationvar, $verificationfinalvar, $cart_instruction->verification_code_to_email_and_sms);
                  ?>
                  <h5 class="title-modal kgt42" id="email_sms_confirm"><?php echo $verification_message; ?></h5>
                  <?php $verification_message = isset($entry_users_data['email']) ? str_replace('EMAILVAR', $entry_users_data['email'], $cart_instruction->verification_code_to_email) : ''; ?>
                  <h5 class="title-modal kgt42 displaynon" id="email_confirm"><?php echo $verification_message; ?></h5>
                  <?php
                  $telephonevar = isset($entry_users_data['country_code']) ? '+' . $entry_users_data['country_code'] . $entry_users_data['telephone'] : '';
                  $verification_message = str_replace('SMSVAR', $telephonevar, $cart_instruction->verification_code_to_sms);
                  ?>
                  <h5 class="title-modal kgt42 displaynon" id="sms_confirm"><?php echo $verification_message; ?></h5>
                  <div class="blink">
                     <div class="product_counter_msg counter_msg_wrap verfication_error_msg colorgray"></div>
                  </div>
                  <div class="alert-message block-message warning">
                     <div class="product_counter_msg counter_msg_wrap" id="pop_msg"></div>
                     <span class="displaynon" id="main_preview_timer"></span>
                  </div>
                  <div class="alert-message block-message warning">
                  </div>
                  <input type="hidden" id="valid_email" name="valid_email" value="" />
                  <input type="hidden" id="valid_phone" name="valid_phone" value="" />
                  <input type="hidden" id="timezone" name="timezone" value="" />
                  <?php if (empty($entry_users_data) || (isset($entry_users_data['entry_email_confirm']) && $entry_users_data['entry_email_confirm'] != 1 && isset($entry_users_data['entry_sms_confirm']) && $entry_users_data['entry_sms_confirm'] != 1)) { ?>

                     <div class="col-lg-12 float-start w-100 mb-3">
                        <div class="row">
                           <div class="col-sm-6">
                              <label><?php echo $cart_instruction->enter_email_code; ?>: </label>
                           </div>
                           <div class="col-sm-6">
                              <input class="form-control" type="text" name="entry_verification_codemail" id="entry_verification_codemail">
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-12 float-start w-100 mb-3">
                        <div class="row">
                           <div class="col-sm-6">
                              <label><?php echo $cart_instruction->enter_sms_code; ?></label>
                           </div>
                           <div class="col-sm-6">
                              <input class="form-control" type="text" name="entry_verification_codesms" id="entry_verification_codesms">
                           </div>
                        </div>
                     </div>
                  <?php } else if (isset($entry_users_data['entry_email_confirm']) && $entry_users_data['entry_email_confirm'] != 1) { ?>
                     <div class="col-lg-12 float-start w-100 mb-3">
                        <div class="row">
                           <div class="col-sm-6"> <label><?php echo $cart_instruction->enter_email_code; ?>:</label></div>
                           <div class="col-sm-6"><input class="form-control" type="text" name="entry_verification_codemail" id="entry_verification_codemail"></div>
                        </div>
                     </div>
                     <input type="hidden" name="entry_verification_codesms" value="<?php echo $entry_users_data['sms_code']; ?>" />
                  <?php } else if (isset($entry_users_data['entry_sms_confirm']) && $entry_users_data['entry_sms_confirm'] != 1) { ?>
                     <div class="col-lg-12 float-start w-100 mb-3">
                        <div class="row">
                           <div class="col-sm-6">
                              <label><?php echo $cart_instruction->enter_sms_code; ?>:</label>
                           </div>

                           <div class="col-sm-6">
                              <input class="form-control" type="text" name="entry_verification_codesms" id="entry_verification_codesms">
                           </div>
                        </div>
                     </div>
                     <input type="hidden" name="entry_verification_codemail" value="<?php echo $entry_users_data['email_code']; ?>" />
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
                           <!-- when user click to cancel the verification code popup then it allocates 1200 seconds in the cart preview. -->
                           <?php if ($lang_id == 'ar') { ?>
                              <a href="javascript:void(0);" onclick="cancel_popup_click();" id="cart_pop_cancel" class="btn  actn-btn rounded"><i class="fa fa-angle-left"></i> <?php echo str_replace('<br />', ' - ', $cart_instruction->cancel); ?> </a>
                           <?php } else { ?>
                              <a href="javascript:void(0);" onclick="cancel_popup_click();" id="cart_pop_cancel" class="btn  actn-btn rounded"><?php echo str_replace('<br />', ' - ', $cart_instruction->cancel); ?> <i class="fa fa-angle-right"></i></a>
                           <?php } ?>
                           <?php if ($lang_id == 'ar') { ?>
                              <a href="javascript:void(0);" class="btn  actn-btn rounded" id="resend_code"><i class="fa fa-angle-left"></i> <?php echo str_replace('<br />', ' - ', $cart_instruction->resend); ?> </a>
                           <?php } else { ?>
                              <a href="javascript:void(0);" class="btn  actn-btn rounded" id="resend_code"><?php echo str_replace('<br />', ' - ', $cart_instruction->resend); ?> <i class="fa fa-angle-right"></i></a>
                           <?php } ?>
                           <?php if ($lang_id == 'ar') { ?>
                              <a href="javascript:void(0);" class="btn  actn-btn rounded" id="entry_verification_confirm"><i class="fa fa-angle-left"></i> <?php echo str_replace('<br />', ' - ', $cart_instruction->confirm); ?> </a>
                           <?php } else { ?>
                              <a href="javascript:void(0);" class="btn  actn-btn rounded" id="entry_verification_confirm"><?php echo str_replace('<br />', ' - ', $cart_instruction->confirm); ?> <i class="fa fa-angle-right"></i></a>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>