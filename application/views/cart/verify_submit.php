<style type="text/css">
   .form-control {
      border-color: #<?php echo $all_data['input_border_txt_color']; ?> !important;
      color: #<?php echo $all_data['input_border_txt_color']; ?> !important;
      background-color: #<?php echo $all_data['input_bg_color']; ?> !important;
   }

   .control-label {
      color: #<?php echo $all_data['input_label_color']; ?> !important;
   }
</style>

<!--Modal shopping decision cart start-->
<?php $this->load->view('elements/popup/action_notification_cart_popup'); ?>
<!--Modal shopping decision cart end-->

<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">
<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">

<span class="displaynon" id="fd_verification_block_msg"><?php if (isset($entry_door_message['fd_verification_block_msg'])) echo $entry_door_message['fd_verification_block_msg']; ?></span>
<span class="displaynon" id="fd_main_block_msg"><?php if (isset($entry_door_message['fd_main_block_msg'])) echo $entry_door_message['fd_main_block_msg']; ?></span>
<span class="displaynon" id="fd_edit_block_msg"><?php if (isset($entry_door_message['fd_edit_block_msg'])) echo $entry_door_message['fd_edit_block_msg']; ?></span>

<?php
$ASSET_VERSION = getenv('ASSET_VERSION');
$comingsoon    = getNoImage('coming-soon');
$this->load->view('elements/popup/user_block_box');
$otp_verification = $this->config->item('guestotp_verification');
$user_id = getFrontenduserId();

if ($otp_verification == 1  && empty($user_id)) {
} else if (front_on_checkout_verification(true)) {

   $this->load->view('elements/popup/notify_submit_popup');
   $this->load->view('elements/popup/modal_success_popup');

   $telephonevar            = isset($entry_users_data['country_code']) ? '+' . $entry_users_data['country_code'] . $entry_users_data['telephone'] : '';
   $invalidvar              = ["EMAILVAR", "SMSVAR"];
   $invalidfinalvar         = isset($entry_users_data['email']) ? [$entry_users_data['email'], $telephonevar] : '';
   $smsinvalid_message      = str_replace($invalidvar, $invalidfinalvar, $cart_instruction->email_verified_sms_not);
   $emailinvalid_message    = str_replace($invalidvar, $invalidfinalvar, $cart_instruction->sms_verified_email_not);
   $emailsmsinvalid_message = str_replace($invalidvar, $invalidfinalvar, $cart_instruction->email_and_sms_not_verified);

   $completedata['smsinvalid_message']      = $smsinvalid_message;
   $completedata['emailinvalid_message']    = $emailinvalid_message;
   $completedata['emailsmsinvalid_message'] = $emailsmsinvalid_message;
   $this->load->view('elements/popup/invalid_phone_popup', $completedata);
   $this->load->view('elements/popup/invalid_email_popup', $completedata);
   $this->load->view('elements/popup/invalid_email_phone_popup', $completedata); ?>


   <span class="displaynon" id="fd_verification_resent_block_msg"><?php if (isset($entry_door_message['fd_verification_resent_block_msg'])) echo $entry_door_message['fd_verification_resent_block_msg']; ?></span>
   <span class="displaynon" id="fd_verification_resent_block_msg_sms"><?php if (isset($entry_door_message['fd_verification_resent_block_msg_sms'])) echo $entry_door_message['fd_verification_resent_block_msg_sms']; ?></span>
   <span class="displaynon" id="fd_verification_resent_block_msg_email_sms"><?php if (isset($entry_door_message['fd_verification_resent_block_msg_email_sms'])) echo $entry_door_message['fd_verification_resent_block_msg_email_sms']; ?></span>
   <span class="displaynon" id="fd_verification_wrong_block_msg"><?php if (isset($entry_door_message['fd_verification_wrong_block_msg'])) echo $entry_door_message['fd_verification_wrong_block_msg']; ?></span>
   <span class="displaynon" id="fd_verification_wrong_block_msg_sms"><?php if (isset($entry_door_message['fd_verification_wrong_block_msg_sms'])) echo $entry_door_message['fd_verification_wrong_block_msg_sms']; ?></span>
   <span class="displaynon" id="fd_verification_wrong_block_msg_email_sms"><?php if (isset($entry_door_message['fd_verification_wrong_block_msg_email_sms'])) echo $entry_door_message['fd_verification_wrong_block_msg_email_sms']; ?></span>
   <span class="displaynon" id="fd_block_notification_msg"><?php if (isset($entry_door_message['fd_block_notification_msg'])) echo $entry_door_message['fd_block_notification_msg']; ?></span>
   <span class="displaynon" id="fd_block_notification_msg_sms"><?php if (isset($entry_door_message['fd_block_notification_msg_sms'])) echo $entry_door_message['fd_block_notification_msg_sms']; ?></span>
   <span class="displaynon" id="fd_block_notification_msg_email_sms"><?php if (isset($entry_door_message['fd_block_notification_msg_email_sms'])) echo $entry_door_message['fd_block_notification_msg_email_sms']; ?></span>
   <span class="displaynon" id="please_wait"><?php if (isset($general_instruction->please_wait)) echo $general_instruction->please_wait; ?></span>
   <span class="displaynon" id="hours"><?php if (isset($general_instruction->hours)) echo $general_instruction->hours; ?></span>
   <span class="displaynon" id="minutes"><?php if (isset($general_instruction->minutes)) echo $general_instruction->minutes; ?></span>
   <span class="displaynon" id="seconds"><?php if (isset($general_instruction->please_wait)) echo $general_instruction->seconds; ?></span>
   <span class="displaynon" id="formvalidation_title"><?php if (isset($form_validation_instruction->popup_title)) echo $form_validation_instruction->popup_title; ?></span>
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
<?php }


?>


<input type="hidden" id="cart_preview_timer" value="<?php echo $cart_timer->cart_preview_timer * 60; ?>">

<div class="varify-submit-page productlisting">
   <div class="d-flex flex-wrap justify-content-between align-items-center py-4">
      <div class="block-message warning">
         <h5 class="product_counter_msg counter_msg_wrap" style="color: #000000 !important;font-weight:600;"><?php echo $cart_timer->cart_preview_msg; ?></h5>
      </div>
      <div class="counter_msg_wrap_counter" id="cart_review_time">
         <div id="timer5"></div>
      </div>
   </div>

   <form action="#" id="cart_conifrm_form" method="post" enctype="multipart/form-data">

      <?php if (!front_on_checkout_verification(true)) { ?>
         <?php if ($front_validuser_data['country_code'] != $cart_users_data['country_code'] || $front_validuser_data['telephone'] != $cart_users_data['telephone']) { ?>
            <input type="hidden" value="<?php echo $sms_attempt; ?>" id="sms_attempt" name="sms_attempt">
         <?php } else { ?>
            <input type="hidden" value="0" id="sms_attempt" name="sms_attempt">
         <?php } ?>

         <?php if ($front_validuser_data['email'] != $cart_users_data['email']) { ?>
            <input type="hidden" value="<?php echo $email_attempt; ?>" id="email_attempt" name="email_attempt">
         <?php } else { ?>
            <input type="hidden" value="0" id="email_attempt" name="email_attempt">
         <?php } ?>
      <?php } ?>

      <input type="hidden" id="block_timezone" name="block_timezone" value="" />
      <input type="hidden" id="cart_block_timer" name="cart_block_timer" value="<?php echo $cart_timer->cart_block_timer; ?>" />
      <input type="hidden" id="admin_door_block_timer" value="<?php echo $cart_timer->cart_block_timer; ?>" />

      <?php if (isset($front_validuser_data['country_code']) && $front_validuser_data['country_code'] == $cart_users_data['country_code'] && isset($front_validuser_data['telephone']) && $front_validuser_data['telephone'] == $cart_users_data['telephone']) { ?>
         <input type="hidden" name="cart_sms_confirm_status" value="1" />
         <input type="hidden" id="part_cart_verification" name="part_cart_verification" value="1" />
      <?php } else if (isset($front_validuser_data['email']) && $front_validuser_data['email'] == $cart_users_data['email']) { ?>
         <input type="hidden" name="cart_email_confirm_status" value="1" />
         <input type="hidden" id="part_cart_verification" name="part_cart_verification" value="1" />
      <?php } else { ?>
         <input type="hidden" id="part_cart_verification" name="part_cart_verification" value="0" />
      <?php } ?>

      <input type="hidden" value="<?php echo isset($cart_users_data['user_name']) ? $cart_users_data['user_name'] : ''; ?>" id="user_name" name="user_name">
      <input type="hidden" value="<?php echo isset($cart_users_data['country_code']) ? $cart_users_data['country_code'] : ''; ?>" id="country_code" name="country_code">
      <input type="hidden" value="<?php echo isset($cart_users_data['telephone']) ? $cart_users_data['telephone'] : ''; ?>" id="telephone" name="telephone">
      <input type="hidden" value="<?php echo isset($cart_users_data['email']) ? $cart_users_data['email'] : ''; ?>" id="email" name="email">

      <?php $completedata['view_type'] = 'confirmcart';
      $this->load->view('cart/invoice_element', $completedata); ?>


      <?php if ($otp_verification == 1  && empty($user_id)) {
      } else {
         if (!front_on_checkout_verification(true)) { ?>
            <?php if ($front_validuser_data['email'] != $cart_users_data['email'] || $front_validuser_data['country_code'] != $cart_users_data['country_code'] || $front_validuser_data['telephone'] != $cart_users_data['telephone']) { ?>
               <div class="row">
                  <label class="control-label col-sm-6"><?php echo $cart_instruction->captcha_text; ?>:<br>
                     <div id="captImg"><?php echo generate_captcha(); ?></div>
                  </label>
                  <div class="controls col-sm-6" style="margin-top:25px;">
                     <input type="text" class="span12 form-control" id="captcha" placeholder="<?php echo $cart_instruction->captcha_text; ?>" name="captcha" value="" required autocomplete="off">
                     <span class="red1 btn actn-btn mt-2 trynewcaptcha"><?php echo $cart_instruction->try_new_captcha_text; ?></span>
                  </div>
               </div>
            <?php } ?>
      <?php }
      } ?>
   </form>

   <?php
   if ($otp_verification == 1  && empty($user_id)) {
   } else {


      if (front_on_checkout_verification(true)) { ?>
         <form class="form-horizontal" id="entry_door_form" role="form" action="<?php echo base_url() . $lang_id . '/'; ?>front/send_verification_code" method="post">
            <?php
            $full_name = $cart_users_data['user_name'];
            $salutation = explode(' ', $full_name)[0];
            $full_name = trim(str_replace($salutation, '', $full_name));
            ?>
            <div class="row">
               <label class="control-label col-sm-6"><?php echo $cart_instruction->captcha_text; ?>:<br>
                  <div id="captImg"><?php echo generate_captcha(); ?></div>
               </label>
               <div class="controls col-sm-6" style="margin-top:25px;">
                  <input type="text" class="span12 form-control" id="captcha" placeholder="<?php echo $cart_instruction->captcha_text; ?>" name="captcha" value="" required autocomplete="off">
                  <span class="red1 mt-2 trynewcaptcha d-inline-block"><?php echo $cart_instruction->try_new_captcha_text; ?></span>
               </div>
            </div>

            <input type="hidden" name="button_checkings" value="submit">
            <input type="hidden" id="entry_door_block_timer" name="entry_door_block_timer" value="<?php echo $entry_door_timer->entry_door_block_timer; ?>" />
            <input type="hidden" id="admin_door_block_timer" value="<?php echo $entry_door_timer->entry_door_block_timer; ?>" />
            <input type="hidden" value="<?php echo $email_attempt; ?>" id="email_attempt" name="email_attempt">
            <input type="hidden" value="<?php echo $sms_attempt; ?>" id="sms_attempt" name="sms_attempt">
            <input type="hidden" value="<?php echo $this->session->userdata('validemail'); ?>" id="validemail" name="validemail">
            <input type="hidden" value="<?php echo $this->session->userdata('validphone'); ?>" id="validphone" name="validphone">
            <input type="hidden" id="block_timezone" name="block_timezone" value="" />
            <input type="checkbox" style="display:none;" checked="checked" name="salutation" value="<?php echo $salutation ?>">
            <input type="hidden" name="name" value="<?php echo $full_name ?>">
            <input type="hidden" name="country" value="<?php echo $cart_users_data['country'] ?>">
            <input type="hidden" name="country_flag" value="">
            <input type="hidden" name="country_code" value="<?php echo $cart_users_data['country_code'] ?>">
            <input type="hidden" name="telephone" value="<?php echo $cart_users_data['telephone'] ?>" id="telephone">
            <input type="hidden" name="email" value="<?php echo $cart_users_data['email'] ?>" id="email">
            <input type="hidden" name="action" value="cart">
         </form>
   <?php }
   } ?>

   <div class="row">
      <div class="col-md-12 pull-right">
         <div class="nav-prex-next text-right">
            <?php if (!empty($cart_details)) { ?>
               <div class="row">
                  <div class="col-md-12">
                     <a onclick="javascript:printDiv();" class="btn btn-success actn-btn rounded" id="printBtn"><?php echo  $sales_order_preview['print_text']; ?></a>
                     <a href="<?php echo base_url() . $lang_id . '/'; ?>cart/edittocart" class="btn  actn-btn rounded"><?php echo $general_instruction->edit; ?></a>
                     <?php



                     if ($otp_verification == 1  && empty($user_id)) { ?>

                        <a href="<?php echo base_url() . $lang_id . '/'; ?>payment" class="btn  actn-btn rounded"><?php echo $general_instruction->quotation_proceed; ?></a>

                        <?php  } else {

                        if (front_on_checkout_verification(true)) { ?>
                           <a href="javascript:void(0)" class="btn  actn-btn rounded" id="entry_door_submit"><?php echo $general_instruction->quotation_proceed; ?></a>
                        <?php } else { ?>
                           <?php if ($front_validuser_data['country_code'] == $cart_users_data['country_code'] && $front_validuser_data['telephone'] == $cart_users_data['telephone'] && $front_validuser_data['email'] == $cart_users_data['email']) { ?>
                              <a href="javascript:void(0)" class="btn  actn-btn rounded rounded" id="validated_submit_confirm_cart"><?php  echo $general_instruction->quotation_proceed; ?></a>
                           <?php } else if ($front_validuser_data['country_code'] == $cart_users_data['country_code'] && $front_validuser_data['telephone'] == $cart_users_data['telephone'] && $cart_email_confirm == 1) { ?>
                              <a href="javascript:void(0)" class="btn  actn-btn rounded" id="validated_submit_confirm_cart"><?php echo $general_instruction->quotation_proceed; ?></a>
                           <?php } else if ($front_validuser_data['email'] == $cart_users_data['email'] && $cart_sms_confirm == 1) { ?>
                              <a href="javascript:void(0)" class="btn  actn-btn rounded" id="validated_submit_confirm_cart"><?php echo $general_instruction->quotation_proceed; ?></a>
                           <?php } else { ?>
                              <a href="javascript:void(0)" class="btn  actn-btn rounded" id="submit_confirm_cart"><?php echo $general_instruction->quotation_proceed; ?></a>
                           <?php }

                           $user_id = getFrontenduserId();

                           if ( ($user_id && $this->config->item('partial_payment_enable')=="0") || ($this->config->item('partial_payment_enable')=="1" && $user_id  && empty($this->session->userdata('partial_payment_percentage')) ) ){
                           ?>

                              <a href="<?php echo base_url() . $lang_id . '/'; ?>payment/save_quotation" class="btn  actn-btn rounded" id="save_quotation"><?php echo $general_instruction->save_quotation; ?></a>

                     <?php }
                        }
                     } ?>

                  </div>
               </div>
            <?php } ?>
         </div>
      </div>
   </div>

   <hr style="border-top: 1px solid #000;" />
   <div class="text-right pb-3"><?php echo $all_data['copyright']; ?></div>
</div>

<span class="displaynon" id="invalid_captcha"><?php if (isset($cart_instruction->invalid_captcha)) echo $cart_instruction->invalid_captcha; ?></span>
<span class="displaynon" id="please_wait"><?php if (isset($general_instruction->please_wait)) echo $general_instruction->please_wait; ?></span>
<span class="displaynon" id="hours"><?php if (isset($general_instruction->hours)) echo $general_instruction->hours; ?></span>
<span class="displaynon" id="minutes"><?php if (isset($general_instruction->minutes)) echo $general_instruction->minutes; ?></span>
<span class="displaynon" id="seconds"><?php if (isset($general_instruction->please_wait)) echo $general_instruction->seconds; ?></span>
<span class="displaynon" id="verification_code_to_email"><?php if (isset($cart_instruction->verification_code_to_email)) echo $cart_instruction->verification_code_to_email; ?></span>
<span class="displaynon" id="verification_code_to_sms"><?php if (isset($cart_instruction->verification_code_to_sms)) echo $cart_instruction->verification_code_to_sms; ?></span>
<span class="displaynon" id="verification_code_to_email_and_sms"><?php if (isset($cart_instruction->verification_code_to_email_and_sms)) echo $cart_instruction->verification_code_to_email_and_sms; ?></span>
<span class="displaynon" id="email_verified_sms_not"><?php if (isset($cart_instruction->email_verified_sms_not)) echo $cart_instruction->email_verified_sms_not; ?></span>
<span class="displaynon" id="sms_verified_email_not"><?php if (isset($cart_instruction->sms_verified_email_not)) echo $cart_instruction->sms_verified_email_not; ?></span>
<span class="displaynon" id="email_and_sms_not_verified"><?php if (isset($cart_instruction->email_and_sms_not_verified)) echo $cart_instruction->email_and_sms_not_verified; ?></span>
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
<span class="displaynon" id="maincart_block_msg"><?php if (isset($selection_instruction->maincart_block_msg)) echo $selection_instruction->maincart_block_msg; ?></span>
<span class="displaynon" id="editcart_block_msg"><?php if (isset($selection_instruction->editcart_block_msg)) echo $selection_instruction->editcart_block_msg; ?></span>
<span class="displaynon" id="cartpreview_block_msg"><?php if (isset($selection_instruction->cartpreview_block_msg)) echo $selection_instruction->cartpreview_block_msg; ?></span>

<?php $subtotal = 0;
$discount = 0;
// echo '<pre>';print_r($cart_data);echo '</pre>';exit;

foreach ($cart_details as $cart) {
   $ship_quantity = 0;
   $item_price = 0;
   $cart_information = $cart_data[$cart['id']];
   $cart_quantity = $cart_information['quantity'];
                        
   foreach($cart_quantity as $key=>$cart_qty){                                            
   $stores_list = $cart_information['store_data'];
   

   if ($cart['ship_quantity'] > $cart_qty) {
      $ship_quantity = $cart_qty;
   } else {
      $ship_quantity = $cart['ship_quantity'];
   }

   $availableQuantity = $cart['ship_quantity'];
   $userQuantity      = $cart_qty;
   if ($cart['backorder_status'] == 0) {
      if ($availableQuantity > $userQuantity) {
         $ship_quantity = $userQuantity;
      } else if ($availableQuantity <= 0) {
         $ship_quantity = $remaining_quantity = 0;
      } else if ($userQuantity > $availableQuantity) {
         $ship_quantity = $availableQuantity;
         $remaining_quantity = $availableQuantity;
      }
   } else if ($cart['backorder_status'] == 1) {
      if ($availableQuantity > $userQuantity) {
         $ship_quantity = $userQuantity;
      } else if ($availableQuantity <= 0) {
         $ship_quantity = $userQuantity;
         $remaining_quantity = $userQuantity;
      } else if ($userQuantity > $availableQuantity) {
         $ship_quantity = $availableQuantity;
         $remaining_quantity = $userQuantity - $availableQuantity;
      }
   }

   $item_price = $cart['price'];

   $price = 0;

   $c_discount =  0;
   $u_discount =  0;

   $price = $item_price * $ship_quantity;

   if ($coupon_applied == "1") {
      $product_discount = get_product_discount($cart['id'], $item_price, $ship_quantity, $coupon_data);

      if ($product_discount['amount']) {
         $c_discount =  $product_discount['amount'];
      } else {
         $c_discount =  0;
      }
   }

   // User Discount Price
   $user_discount = get_user_product_discount($cart['id'], $item_price, $ship_quantity);
   if ($user_discount['amount']) {
      $u_discount =  $user_discount['amount'];
   } else {
      $u_discount =  0;
   }

   if ($u_discount > $c_discount) {
      $discount += $u_discount;
   } else {
      $discount += $c_discount;
   }

   $subtotal += $price;
}
}

$freight = $freight  + $cart_users_data['shipping_rate_freight'];

$totaltax = 0;

if (isset($tax_base_rate) && $tax_base_rate != 0 && ($this->config->item('store_country') != $cart_users_data['country_code'] && $this->config->item('tax_applicable') == 1) || $this->config->item('store_country') == $cart_users_data['country_code']) {

   $totaltax = (($subtotal + $freight) * $tax_base_rate) / 100;
}

$totaltax = round($totaltax, 2);
$total = $subtotal + $freight + $totaltax -  $discount;


$currencyV = getDefaultCurrencyCode('l') . '_currency';
$currency  = $general_instruction->$currencyV;

$cart_final_price = array(
   'cart_final_price'     =>   $total,
   'cart_final_currency'  =>   $currency
);

$payment_type = get_payment_type();

if ($this->config->item('partial_payment_enable')=="1" && $payment_type=="1") {
   $partial_payment_percentage =  ($this->session->userdata('partial_payment_percentage')) ? $this->session->userdata('partial_payment_percentage') : $this->config->item('partial_payment_percentage');
   $payale_amount= $total * $partial_payment_percentage /100;
   $cart_final_price['cart_payment_price'] = $payale_amount;     
} else  if ($this->config->item('partial_payment_enable')=="1" && $payment_type=="2" ) {
   $payale_amount = $total - $this->session->userdata('amount_received');
   $cart_final_price['cart_payment_price'] = $payale_amount;
}  else {
   $cart_final_price['cart_payment_price'] = $total;
}


$this->session->set_userdata($cart_final_price);

?>

<?php
$this->load->view('elements/popup/product_warning_popup');

if ($otp_verification == 1  && empty($user_id)) {
} else if (!front_on_checkout_verification(true)) {
   $this->load->view('elements/popup/cart_notify_submit_popup');
   $telephonevar            = '+' . $cart_users_data['country_code'] . $cart_users_data['telephone'];
   $invalidvar              = ["EMAILVAR", "SMSVAR"];
   $invalidfinalvar         = [$cart_users_data['email'], $telephonevar];
   $smsinvalid_message      = str_replace($invalidvar, $invalidfinalvar, $cart_instruction->email_verified_sms_not);
   $emailinvalid_message    = str_replace($invalidvar, $invalidfinalvar, $cart_instruction->sms_verified_email_not);
   $emailsmsinvalid_message = str_replace($invalidvar, $invalidfinalvar, $cart_instruction->email_and_sms_not_verified);
   $completedata['smsinvalid_message']      = $smsinvalid_message;
   $completedata['emailinvalid_message']    = $emailinvalid_message;
   $completedata['emailsmsinvalid_message'] = $emailsmsinvalid_message;
   $this->load->view('elements/popup/invalid_phone_popup', $completedata);
   $this->load->view('elements/popup/invalid_email_popup', $completedata);
   $this->load->view('elements/popup/invalid_email_phone_popup', $completedata);
}
?>


<?php /* code to save quotations */

$user_id = getFrontenduserId();


if ($user_id) {
   $session_data = $this->session->all_userdata();
   $quotation_daylimit = $this->config->item('quotation_daylimit');
   $quotation_data = array();
   $quotation_data['user_id'] = $user_id;
   $quotation_data['quotation_number'] = $session_data['cart_users_data']['order_number'];
   $quotation_data['amount'] =   $session_data['cart_final_price'];
   $quotation_data['amount'] =   $session_data['cart_final_price'];
   $quotation_data['currency'] =  $session_data['cart_final_currency'];
   $quotation_data['expirydate'] =  date('Y-m-d', strtotime(date('Y-m-d') . ' + ' . $quotation_daylimit . ' days'));
   $quotation_data['complete_data'] = serialize($session_data);
   $quotation_data['status'] = 0;

   $quotation_id_seesion = $this->session->userdata('quotation_id') ? $this->session->userdata('quotation_id') : "";
   $quotation_id = addorupdatequotation($quotation_id_seesion,$quotation_data);
   $this->session->set_userdata('quotation_id', $quotation_id);
}


?>

<script type="text/javascript">
   var base_url = "<?php echo base_url(); ?>";
   var lang_id = "<?php echo $lang_id; ?>";
   var lang_num = '<?php echo $lang_num; ?>';
   var eCode = '<?php echo getRandomCode(); ?>';
   var sCode = '<?php echo getRandomCode(); ?>';
</script>
<script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/jquery.js?version=' . $ASSET_VERSION); ?>"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js?version=" .$ASSET_VERSION></script>
<script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-strap-wos.js?version=' . $ASSET_VERSION); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/lang_select.js?version=' . $ASSET_VERSION); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/msdropdown/jquery.dd.js?version=' . $ASSET_VERSION); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-strap-wos-select.js?version=' . $ASSET_VERSION); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/countdown.js?version=' . $ASSET_VERSION); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/flipclock.js?version=' . $ASSET_VERSION); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-light.js?version=' . $ASSET_VERSION); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/verify-cart.js?version=' . $ASSET_VERSION); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/entry_door.js?version=' . $ASSET_VERSION); ?>"></script>
<?php if (ENVIRONMENT == 'production') { ?>
   <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/store-prevent.js?version=' . $ASSET_VERSION); ?>" defer></script>
<?php } ?>

</body>

</html>
