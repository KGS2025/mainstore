<div class="content zerorightmargin">
  <?php if ($this->session->flashdata('success')) {
    $msg = $this->session->flashdata('success'); ?>
    <div class="notice outer">
      <div class="note"><?php echo $msg; ?>
      </div>
    </div>
  <?php } ?>
  <div class="outer">
    <div class="inner">
      <div class="page-header">
        <div class="body">
          <div class="container">

            <form id="emailInstructions" name="emailInstructions" class="form-horizontal" method="post">
              <input type="hidden" name="operation" value="set" />
              <div class="row-fluid">

                <div class="span12">

                  <div class="block well">
                    <div class="navbar">
                      <div class="navbar-inner">
                        <h5><?php echo $lang_heading_title; ?></h5>
                      </div>
                    </div>



                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['invoice_ref_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['invoice_ref_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/invoice_ref_subject'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/invoice_ref_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <input id="invoice_ref_subject" name="email_instruction[invoice_ref_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['invoice_ref_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/invoice_ref_subject/front" class="fancybox multi_language_common_edit admin_globe"> <img src="assets/uploads/global.jpg" height="20" width="20"></a>
                      </div>
                      <span class="red1"><?php echo form_error('invoice_ref_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['invoice_ref_content']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['invoice_ref_content']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/invoice_ref_content'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/invoice_ref_content/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <textarea id="ckeditor27" name="email_instruction[invoice_ref_content]" class="input-field ckeditor22 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['invoice_ref_content']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/invoice_ref_content/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('invoice_ref_content'); ?></span>
                    </div>



                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['gateway_reminder_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['gateway_reminder_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/gateway_reminder_subject'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/gateway_reminder_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <input id="gateway_reminder_subject" name="email_instruction[gateway_reminder_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['gateway_reminder_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/gateway_reminder_subject/front" class="fancybox multi_language_common_edit admin_globe"> <img src="assets/uploads/global.jpg" height="20" width="20"></a>
                      </div>
                      <span class="red1"><?php echo form_error('gateway_reminder_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['gateway_reminder']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['gateway_reminder']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/gateway_reminder'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/gateway_reminder/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <textarea id="ckeditor22" name="email_instruction[gateway_reminder]" class="input-field ckeditor22 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['gateway_reminder']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/gateway_reminder/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('gateway_reminder'); ?></span>
                    </div>



                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['commission_expire_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['commission_expire_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/commission_expire_subject'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/commission_expire_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <input id="commission_expire_subject" name="email_instruction[commission_expire_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['commission_expire_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/commission_expire_subject/front" class="fancybox multi_language_common_edit admin_globe"> <img src="assets/uploads/global.jpg" height="20" width="20"></a>
                      </div>
                      <span class="red1"><?php echo form_error('commission_expire_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['commission_expire_message']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['commission_expire_message']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/commission_expire_message'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/commission_expire_message/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <textarea id="ckeditor29" name="email_instruction[commission_expire_message]" class="input-field ckeditor22 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['commission_expire_message']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/commission_expire_message/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('commission_expire_message'); ?></span>
                    </div>










                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['term_reminder_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['term_reminder_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/term_reminder_subject'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/term_reminder_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <input id="term_reminder_subject" name="email_instruction[term_reminder_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['term_reminder_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/term_reminder_subject/front" class="fancybox multi_language_common_edit admin_globe"> <img src="assets/uploads/global.jpg" height="20" width="20"></a>
                      </div>
                      <span class="red1"><?php echo form_error('term_reminder_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['term_reminder']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['term_reminder']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/term_reminder'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/term_reminder/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <textarea id="ckeditor30" name="email_instruction[term_reminder]" class="input-field ckeditor22 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['term_reminder']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/term_reminder/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('term_reminder'); ?></span>
                    </div>




                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['order_status_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['order_status_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/order_status_subject'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/order_status_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <input id="order_status_subject" name="email_instruction[order_status_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['order_status_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/order_status_subject/front" class="fancybox multi_language_common_edit admin_globe"> <img src="assets/uploads/global.jpg" height="20" width="20"></a>
                      </div>
                      <span class="red1"><?php echo form_error('order_status_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['order_status_change']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['order_status_change']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/order_status_change'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/order_status_change/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <textarea id="ckeditor24" name="email_instruction[order_status_change]" class="input-field ckeditor24 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['order_status_change']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/order_status_change/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('order_status_change'); ?></span>
                    </div>

























                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['payment_reminder_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['payment_reminder_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/payment_reminder_subject'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/payment_reminder_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <input id="payment_reminder_subject" name="email_instruction[payment_reminder_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['payment_reminder_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/payment_reminder_subject/front" class="fancybox multi_language_common_edit admin_globe"> <img src="assets/uploads/global.jpg" height="20" width="20"></a>
                      </div>
                      <span class="red1"><?php echo form_error('payment_reminder_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['payment_reminder']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['payment_reminder']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/payment_reminder'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/payment_reminder/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <textarea id="ckeditor34" name="email_instruction[payment_reminder]" class="input-field ckeditor34 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['payment_reminder']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/payment_reminder/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('payment_reminder'); ?></span>
                    </div>


                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['partial_email_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['partial_email_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/partial_email_subject'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/partial_email_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <input id="partial_email_subject" name="email_instruction[partial_email_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['partial_email_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/partial_email_subject/front" class="fancybox multi_language_common_edit admin_globe"> <img src="assets/uploads/global.jpg" height="20" width="20"></a>
                      </div>
                      <span class="red1"><?php echo form_error('partial_email_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['order_payment_link_email']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['order_payment_link_email']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/order_payment_link_email'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/order_payment_link_email/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <textarea id="ckeditor31" name="email_instruction[order_payment_link_email]" class="input-field ckeditor22 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['order_payment_link_email']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/order_payment_link_email/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('order_payment_link_email'); ?></span>
                    </div>





                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_applycredit_to_list']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_applycredit_to_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_applycredit_to_list'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_applycredit_to_list/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="admin_applycredit_to_list" name="email_instruction[admin_applycredit_to_list]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['admin_applycredit_to_list']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_applycredit_to_list/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_applycredit_to_list'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['applycredit_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['applycredit_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/applycredit_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/applycredit_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="applycredit_subject" name="email_instruction[applycredit_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['applycredit_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/applycredit_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('entry_verification_code_mail_subject'); ?></span>
                    </div>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['applycredit_content']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['applycredit_content']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/applycredit_content'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/applycredit_content/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor6" name="email_instruction[applycredit_content]" class="input-field ckeditor10 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['applycredit_content']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/applycredit_content/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('applycredit_content'); ?></span>
                    </div>




                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_applycredit_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_applycredit_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_applycredit_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_applycredit_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="admin_applycredit_subject" name="email_instruction[admin_applycredit_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['admin_applycredit_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_applycredit_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('entry_verification_code_mail_subject'); ?></span>
                    </div>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_applycredit_content']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_applycredit_content']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_applycredit_content'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_applycredit_content/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor28" name="email_instruction[admin_applycredit_content]" class="input-field ckeditor28 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['admin_applycredit_content']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_applycredit_content/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_applycredit_content'); ?></span>
                    </div>












                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['credit_term_success_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['credit_term_success_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/credit_term_success_subject'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/credit_term_success_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <input id="credit_term_success_subject" name="email_instruction[credit_term_success_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['credit_term_success_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/credit_term_success_subject/front" class="fancybox multi_language_common_edit admin_globe"> <img src="assets/uploads/global.jpg" height="20" width="20"></a>
                      </div>
                      <span class="red1"><?php echo form_error('credit_term_success_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['credit_term_success']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['credit_term_success']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/credit_term_success'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/credit_term_success/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <textarea id="ckeditor25" name="email_instruction[credit_term_success]" class="input-field ckeditor25 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['credit_term_success']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/credit_term_success/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('credit_term_success'); ?></span>
                    </div>




                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['credit_term_decline_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['credit_term_decline_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/credit_term_decline_subject'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/credit_term_decline_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <input id="credit_term_decline_subject" name="email_instruction[credit_term_decline_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['credit_term_decline_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/credit_term_decline_subject/front" class="fancybox multi_language_common_edit admin_globe"> <img src="assets/uploads/global.jpg" height="20" width="20"></a>
                      </div>
                      <span class="red1"><?php echo form_error('credit_term_decline_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['credit_term_decline']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['credit_term_decline']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/credit_term_decline'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/credit_term_decline/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <textarea id="ckeditor23" name="email_instruction[credit_term_decline]" class="input-field ckeditor23 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['credit_term_decline']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/credit_term_decline/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('credit_term_decline'); ?></span>
                    </div>














                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['cart_verification_code_mail_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['cart_verification_code_mail_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/cart_verification_code_mail_subject'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/cart_verification_code_mail_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <input id="cart_verification_code_mail_subject" name="email_instruction[cart_verification_code_mail_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['cart_verification_code_mail_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/cart_verification_code_mail_subject/front" class="fancybox multi_language_common_edit admin_globe"> <img src="assets/uploads/global.jpg" height="20" width="20"></a>
                      </div>
                      <span class="red1"><?php echo form_error('cart_verification_code_mail_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['cart_verification_code_mail']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['cart_verification_code_mail']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/cart_verification_code_mail'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/cart_verification_code_mail/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <textarea id="ckeditor1" name="email_instruction[cart_verification_code_mail]" class="input-field ckeditor1 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['cart_verification_code_mail']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/cart_verification_code_mail/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('cart_verification_code_mail'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['cart_verification_code_withphone_mail_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['cart_verification_code_withphone_mail_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/cart_verification_code_withphone_mail_subject'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/cart_verification_code_withphone_mail_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <input id="cart_verification_code_withphone_mail_subject" name="email_instruction[cart_verification_code_withphone_mail_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['cart_verification_code_withphone_mail_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/cart_verification_code_withphone_mail_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('cart_verification_code_withphone_mail_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['cart_verification_code_withphone_mail']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['cart_verification_code_withphone_mail']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/cart_verification_code_withphone_mail'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/cart_verification_code_withphone_mail/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <textarea id="ckeditor2" name="email_instruction[cart_verification_code_withphone_mail]" class="input-field ckeditor2 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['cart_verification_code_withphone_mail']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/cart_verification_code_withphone_mail/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('cart_verification_code_withphone_mail'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['entry_verification_code_mail_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['entry_verification_code_mail_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/entry_verification_code_mail_subject'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/entry_verification_code_mail_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls">
                        <input id="entry_verification_code_mail_subject" name="email_instruction[entry_verification_code_mail_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['entry_verification_code_mail_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/entry_verification_code_mail_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('entry_verification_code_mail_subject'); ?></span>
                    </div>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['entry_verification_code_mail']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['entry_verification_code_mail']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/entry_verification_code_mail'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/entry_verification_code_mail/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor3" name="email_instruction[entry_verification_code_mail]" class="input-field ckeditor3 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['entry_verification_code_mail']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/entry_verification_code_mail/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('entry_verification_code_mail'); ?></span>
                    </div>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['entry_verification_code_withphone_mail_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['entry_verification_code_withphone_mail_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/entry_verification_code_withphone_mail_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/entry_verification_code_withphone_mail_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="entry_verification_code_withphone_mail_subject" name="email_instruction[entry_verification_code_withphone_mail_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['entry_verification_code_withphone_mail_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/entry_verification_code_withphone_mail_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('entry_verification_code_withphone_mail_subject'); ?></span>
                    </div>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['entry_verification_code_withphone_mail']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['entry_verification_code_withphone_mail']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/entry_verification_code_withphone_mail'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/entry_verification_code_withphone_mail/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor4" name="email_instruction[entry_verification_code_withphone_mail]" class="input-field ckeditor4 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['entry_verification_code_withphone_mail']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/entry_verification_code_withphone_mail/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('entry_verification_code_withphone_mail'); ?></span>
                    </div>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['sms_message_text']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['sms_message_text']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/sms_message_text'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/sms_message_text/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="sms_message_text" name="email_instruction[sms_message_text]" type="text" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> class="input-field focustip span12" value="<?php echo $section_data['sms_message_text']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/sms_message_text/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('sms_message_text'); ?></span>
                    </div>


                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['customer_cart_mail_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['customer_cart_mail_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/customer_cart_mail_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/customer_cart_mail_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="customer_cart_mail_subject" name="email_instruction[customer_cart_mail_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['customer_cart_mail_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/customer_cart_mail_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('customer_cart_mail_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['cart_mail']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['cart_mail']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/cart_mail'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/cart_mail/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor5" name="email_instruction[cart_mail]" class="input-field ckeditor4 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['cart_mail']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/cart_mail/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('cart_mail'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['entry_verification_code_mail_fromname']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['entry_verification_code_mail_fromname']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/entry_verification_code_mail_fromname'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/entry_verification_code_mail_fromname" class="fancybox multi_language_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="entry_verification_code_mail_fromname" name="email_instruction[entry_verification_code_mail_fromname]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['entry_verification_code_mail_fromname']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/entry_verification_code_mail_fromname/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('entry_verification_code_mail_fromname'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['cart_verification_code_mail_fromname']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['cart_verification_code_mail_fromname']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/cart_verification_code_mail_fromname'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/cart_verification_code_mail_fromname/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="cart_verification_code_mail_fromname" name="email_instruction[cart_verification_code_mail_fromname]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['cart_verification_code_mail_fromname']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/cart_verification_code_mail_fromname/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('cart_verification_code_mail_fromname'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_cart_mail_fromname']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_cart_mail_fromname']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_cart_mail_fromname'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_cart_mail_fromname/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="admin_cart_mail_fromname" name="email_instruction[admin_cart_mail_fromname]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['admin_cart_mail_fromname']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_cart_mail_fromname/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_cart_mail_fromname'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_forgot_details_form_verification_code_fromname']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_forgot_details_form_verification_code_fromname']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_forgot_details_form_verification_code_fromname'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_forgot_details_form_verification_code_fromname/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="admin_forgot_details_form_verification_code_fromname" name="email_instruction[admin_forgot_details_form_verification_code_fromname]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['admin_forgot_details_form_verification_code_fromname']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_forgot_details_form_verification_code_fromname/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_forgot_details_form_verification_code_fromname'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['sales_manager']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['sales_manager']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/sales_manager'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/sales_manager/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="sales_manager" name="email_instruction[sales_manager]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['sales_manager']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/sales_manager/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('sales_manager'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['from_mail_id']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['from_mail_id']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/from_mail_id'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/from_mail_id/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="from_mail_id" name="email_instruction[from_mail_id]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['from_mail_id']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/from_mail_id/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('from_mail_id'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['attempt_text']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['attempt_text']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/attempt_text'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/attempt_text/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="attempt_text" name="email_instruction[attempt_text]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['attempt_text']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/attempt_text/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('attempt_text'); ?></span>
                    </div>



                    <!------   Apply Credit Email  ---->






                    <!--------------------   Apply Credit email done  ------>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_forgot_details_form_verification_code_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_forgot_details_form_verification_code_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_forgot_details_form_verification_code_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_forgot_details_form_verification_code_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="admin_forgot_details_form_verification_code_subject" name="email_instruction[admin_forgot_details_form_verification_code_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['admin_forgot_details_form_verification_code_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_forgot_details_form_verification_code_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_forgot_details_form_verification_code_subject'); ?></span>
                    </div>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_forgot_details_form_verification_code_mail']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_forgot_details_form_verification_code_mail']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_forgot_details_form_verification_code_mail'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_forgot_details_form_verification_code_mail/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor7" name="email_instruction[admin_forgot_details_form_verification_code_mail]" class="input-field ckeditor focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['admin_forgot_details_form_verification_code_mail']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_forgot_details_form_verification_code_mail/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_forgot_details_form_verification_code_mail'); ?></span>
                    </div>


                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_user_details_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_user_details_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_user_details_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_user_details_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="admin_user_details_subject" name="email_instruction[admin_user_details_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['admin_user_details_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_user_details_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_user_details_subject'); ?></span>
                    </div>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['entry_verification_code_withphone_mail']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['entry_verification_code_withphone_mail']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/entry_verification_code_withphone_mail'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/entry_verification_code_withphone_mail/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor8" name="email_instruction[admin_user_details_mail]" class="input-field ckeditor focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['admin_user_details_mail']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_user_details_mail/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_user_details_mail'); ?></span>
                    </div>


                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_invoice_email_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_invoice_email_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_invoice_email_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_invoice_email_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="admin_invoice_email_subject" name="email_instruction[admin_invoice_email_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['admin_invoice_email_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_invoice_email_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_invoice_email_subject'); ?></span>
                    </div>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_invoice_email_body']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_invoice_email_body']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_invoice_email_body'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_invoice_email_body/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor9" name="email_instruction[admin_invoice_email_body]" class="input-field ckeditor4 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['admin_invoice_email_body']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_invoice_email_body/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_invoice_email_body'); ?></span>
                    </div>


                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_packagelist_email_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_packagelist_email_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_packagelist_email_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_packagelist_email_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="admin_packagelist_email_subject" name="email_instruction[admin_packagelist_email_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['admin_packagelist_email_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_packagelist_email_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_packagelist_email_subject'); ?></span>
                    </div>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_packagelist_email_body']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_packagelist_email_body']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_packagelist_email_body'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_packagelist_email_body/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor10" name="email_instruction[admin_packagelist_email_body]" class="input-field ckeditor4 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['admin_packagelist_email_body']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_packagelist_email_body/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_packagelist_email_body'); ?></span>
                    </div>


                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_invoice_email_to_list']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_invoice_email_to_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_invoice_email_to_list'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_invoice_email_to_list/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="admin_invoice_email_to_list" name="email_instruction[admin_invoice_email_to_list]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['admin_invoice_email_to_list']['front']; ?>" />

                      </div>
                      <span class="red1"><?php echo form_error('admin_invoice_email_to_list'); ?></span>
                    </div>


                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_packagelist_email_to_list']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_packagelist_email_to_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_packagelist_email_to_list'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_packagelist_email_to_list/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="admin_packagelist_email_to_list" name="email_instruction[admin_packagelist_email_to_list]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['admin_packagelist_email_to_list']['front']; ?>" />
                      </div>
                      <span class="red1"><?php echo form_error('admin_packagelist_email_to_list'); ?></span>
                    </div>



                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_verification_code_mail_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_verification_code_mail_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_verification_code_mail_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_verification_code_mail_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="admin_verification_code_mail_subject" name="email_instruction[admin_verification_code_mail_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['admin_verification_code_mail_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_verification_code_mail_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_verification_code_mail_subject'); ?></span>
                    </div>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_verification_code_mail']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_verification_code_mail']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_verification_code_mail'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_verification_code_mail/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor11" name="email_instruction[admin_verification_code_mail]" class="input-field ckeditor4 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['admin_verification_code_mail']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_verification_code_mail/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_verification_code_mail'); ?></span>
                    </div>



                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_verification_code_withphone_mail_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_verification_code_withphone_mail_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_verification_code_withphone_mail_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_verification_code_withphone_mail_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="admin_verification_code_withphone_mail_subject" name="email_instruction[admin_verification_code_withphone_mail_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['admin_verification_code_withphone_mail_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_verification_code_withphone_mail_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_verification_code_withphone_mail_subject'); ?></span>
                    </div>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_verification_code_withphone_mail']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_verification_code_withphone_mail']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_verification_code_withphone_mail'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_verification_code_withphone_mail/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor12" name="email_instruction[admin_verification_code_withphone_mail]" class="input-field ckeditor4 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['admin_verification_code_withphone_mail']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_verification_code_withphone_mail/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_verification_code_withphone_mail'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['one_product_negative_backorder_yes_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['one_product_negative_backorder_yes_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/one_product_negative_backorder_yes_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/one_product_negative_backorder_yes_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="one_product_negative_backorder_yes_subject" name="email_instruction[one_product_negative_backorder_yes_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['one_product_negative_backorder_yes_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/one_product_negative_backorder_yes_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('one_product_negative_backorder_yes_subject'); ?></span>
                    </div>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['one_product_negative_backorder_yes_mail']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['one_product_negative_backorder_yes_mail']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/one_product_negative_backorder_yes_mail'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/one_product_negative_backorder_yes_mail/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor13" name="email_instruction[one_product_negative_backorder_yes_mail]" class="input-field ckeditor4 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['one_product_negative_backorder_yes_mail']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/one_product_negative_backorder_yes_mail/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('one_product_negative_backorder_yes_mail'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['fews_product_negative_backorder_yes_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['fews_product_negative_backorder_yes_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/fews_product_negative_backorder_yes_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/fews_product_negative_backorder_yes_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="fews_product_negative_backorder_yes_subject" name="email_instruction[fews_product_negative_backorder_yes_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['fews_product_negative_backorder_yes_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/fews_product_negative_backorder_yes_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('fews_product_negative_backorder_yes_subject'); ?></span>
                    </div>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['fews_product_negative_backorder_yes_mail']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['fews_product_negative_backorder_yes_mail']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/fews_product_negative_backorder_yes_mail'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/fews_product_negative_backorder_yes_mail/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor14" name="email_instruction[fews_product_negative_backorder_yes_mail]" class="input-field ckeditor4 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['fews_product_negative_backorder_yes_mail']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/fews_product_negative_backorder_yes_mail/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('fews_product_negative_backorder_yes_mail'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['one_product_quantity_threshold_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['one_product_quantity_threshold_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/one_product_quantity_threshold_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/one_product_quantity_threshold_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="one_product_quantity_threshold_subject" name="email_instruction[one_product_quantity_threshold_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['one_product_quantity_threshold_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/one_product_quantity_threshold_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('one_product_quantity_threshold_subject'); ?></span>
                    </div>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['one_product_quantity_threshold_mail']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['one_product_quantity_threshold_mail']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/one_product_quantity_threshold_mail'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/one_product_quantity_threshold_mail/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor15" name="email_instruction[one_product_quantity_threshold_mail]" class="input-field ckeditor4 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['one_product_quantity_threshold_mail']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/one_product_quantity_threshold_mail/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('one_product_quantity_threshold_mail'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['fews_product_quantity_threshold_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['fews_product_quantity_threshold_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/fews_product_quantity_threshold_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/fews_product_quantity_threshold_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="fews_product_quantity_threshold_subject" name="email_instruction[fews_product_quantity_threshold_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['fews_product_quantity_threshold_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/fews_product_quantity_threshold_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('fews_product_quantity_threshold_subject'); ?></span>
                    </div>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['fews_product_quantity_threshold_mail']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['fews_product_quantity_threshold_mail']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/fews_product_quantity_threshold_mail'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/fews_product_quantity_threshold_mail/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor16" name="email_instruction[fews_product_quantity_threshold_mail]" class="input-field ckeditor4 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['fews_product_quantity_threshold_mail']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/fews_product_quantity_threshold_mail/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('fews_product_quantity_threshold_mail'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['replenishment_period_expired_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['replenishment_period_expired_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/replenishment_period_expired_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/replenishment_period_expired_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="replenishment_period_expired_subject" name="email_instruction[replenishment_period_expired_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['replenishment_period_expired_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/replenishment_period_expired_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('replenishment_period_expired_subject'); ?></span>
                    </div>
                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['replenishment_period_expired_mail']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['replenishment_period_expired_mail']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/replenishment_period_expired_mail'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/replenishment_period_expired_mail/admin" class="fancybox multi_language_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor17" name="email_instruction[replenishment_period_expired_mail]" class="input-field ckeditor4 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['replenishment_period_expired_mail']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/replenishment_period_expired_mail/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('replenishment_period_expired_mail'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['contact_email_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['contact_email_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/contact_email_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/contact_email_subject/admin" class="fancybox multi_language_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="contact_email_subject" name="email_instruction[contact_email_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="focustip span12" value="<?php echo $section_data['contact_email_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/contact_email_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('contact_email_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['contact_email_from_name']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['contact_email_from_name']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/contact_email_from_name'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/contact_email_from_name/admin" class="fancybox multi_language_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="contact_email_from_name" name="email_instruction[contact_email_from_name]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="focustip span12" value="<?php echo $section_data['contact_email_from_name']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/contact_email_from_name/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('contact_email_from_name'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['contact_email_body']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['contact_email_body']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/contact_email_body'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/contact_email_body/admin" class="fancybox multi_language_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor18" name="email_instruction[contact_email_body]" class="ckeditor1 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['contact_email_body']['front']; ?></textarea>

                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/contact_email_body/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('contact_email_body'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['kgt_verification_code_contact_from_name']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['kgt_verification_code_contact_from_name']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/kgt_verification_code_contact_from_name'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/kgt_verification_code_contact_from_name/admin" class="fancybox multi_language_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="kgt_verification_code_contact_from_name" name="email_instruction[kgt_verification_code_contact_from_name]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="focustip span12" value="<?php echo $section_data['kgt_verification_code_contact_from_name']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/kgt_verification_code_contact_from_name/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('kgt_verification_code_contact_from_name'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['kgt_verification_code_contact_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['kgt_verification_code_contact_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/kgt_verification_code_contact_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/kgt_verification_code_contact_subject/admin" class="fancybox multi_language_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="kgt_verification_code_contact_subject" name="email_instruction[kgt_verification_code_contact_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="focustip span12" value="<?php echo $section_data['kgt_verification_code_contact_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/kgt_verification_code_contact_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('kgt_verification_code_contact_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['kgt_verification_code_contact_body']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['kgt_verification_code_contact_body']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/kgt_verification_code_contact_body'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/kgt_verification_code_contact_body/admin" class="fancybox multi_language_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor19" name="email_instruction[kgt_verification_code_contact_body]" class="ckeditor2 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['kgt_verification_code_contact_body']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/kgt_verification_code_contact_body/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('kgt_verification_code_contact_body'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['contact_verification_code_resend_attempt_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['contact_verification_code_resend_attempt_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/contact_verification_code_resend_attempt_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/contact_verification_code_resend_attempt_subject/admin" class="fancybox multi_language_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="contact_verification_code_resend_attempt_subject" name="email_instruction[contact_verification_code_resend_attempt_subject]" type="text" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> class="focustip span12" value="<?php echo $section_data['contact_verification_code_resend_attempt_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/contact_verification_code_resend_attempt_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('contact_verification_code_resend_attempt_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_contact_email_from_name']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_contact_email_from_name']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_contact_email_from_name'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_contact_email_from_name/admin" class="fancybox multi_language_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="admin_contact_email_from_name" name="email_instruction[admin_contact_email_from_name]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="focustip span12" value="<?php echo $section_data['admin_contact_email_from_name']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_contact_email_from_name/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_contact_email_from_name'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_contact_email_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_contact_email_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_contact_email_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_contact_email_subject/admin" class="fancybox multi_language_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="admin_contact_email_subject" name="email_instruction[admin_contact_email_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="focustip span12" value="<?php echo $section_data['admin_contact_email_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_contact_email_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_contact_email_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['admin_contact_email_body']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['admin_contact_email_body']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/admin_contact_email_body'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_contact_email_body/admin" class="fancybox multi_language_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor20" name="email_instruction[admin_contact_email_body]" class="ckeditor4 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['admin_contact_email_body']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/admin_contact_email_body/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('admin_contact_email_body'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['contact_form_admin_email']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['contact_form_admin_email']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/contact_form_admin_email'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/contact_form_admin_email/admin" class="fancybox multi_language_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="contact_form_admin_email" name="email_instruction[contact_form_admin_email]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="focustip span12" value="<?php echo $section_data['contact_form_admin_email']['front']; ?>" />
                      </div>
                      <span class="red1"><?php echo form_error('contact_form_admin_email'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['signup_welcome_mail_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['signup_welcome_mail_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/signup_welcome_mail_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/signup_welcome_mail_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="signup_welcome_mail_subject" name="email_instruction[signup_welcome_mail_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['signup_welcome_mail_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/signup_welcome_mail_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('signup_welcome_mail_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['signup_welcome_mail']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['signup_welcome_mail']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/signup_welcome_mail'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/signup_welcome_mail/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor21" name="email_instruction[signup_welcome_mail]" class="input-field ckeditor21 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['signup_welcome_mail']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/signup_welcome_mail/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('signup_welcome_mail'); ?></span>
                    </div>



                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['signup_email_inactive_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['signup_email_inactive_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/signup_email_inactive_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/signup_email_inactive_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="signup_email_inactive_subject" name="email_instruction[signup_email_inactive_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['signup_email_inactive_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/signup_email_inactive_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('signup_email_inactive_subject'); ?></span>
                    </div>




                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['signup_inactive_email_body']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['signup_inactive_email_body']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/signup_inactive_email_body'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/signup_inactive_email_body/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor35" name="email_instruction[signup_inactive_email_body]" class="input-field ckeditor35 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['signup_inactive_email_body']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/signup_inactive_email_body/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('signup_inactive_email_body'); ?></span>
                    </div>




                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['signup_admin_approval_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['signup_admin_approval_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/signup_admin_approval_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/signup_admin_approval_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="signup_admin_approval_subject" name="email_instruction[signup_admin_approval_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['signup_admin_approval_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/signup_admin_approval_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('signup_admin_approval_subject'); ?></span>
                    </div>


                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['signup_admin_approval']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['signup_admin_approval']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/signup_welcome_mail'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/signup_welcome_mail/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor33" name="email_instruction[signup_admin_approval]" class="input-field ckeditor33 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['signup_admin_approval']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/signup_admin_approval/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('signup_admin_approval'); ?></span>
                    </div>



                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['price_requests_customer_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['price_requests_customer_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/price_requests_customer_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/price_requests_customer_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="price_requests_customer_subject" name="email_instruction[price_requests_customer_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['price_requests_customer_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/price_requests_customer_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('price_requests_customer_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['price_requests_customer_body']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['price_requests_customer_body']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/price_requests_customer_body'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/price_requests_customer_body/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor32" name="email_instruction[price_requests_customer_body]" class="input-field ckeditor32 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['price_requests_customer_body']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/price_requests_customer_body/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('price_requests_customer_body'); ?></span>
                    </div>


                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['password_page_otp_text']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['password_page_otp_text']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/password_page_otp_text'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/password_page_otp_text/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="password_page_otp_text" name="email_instruction[password_page_otp_text]" type="text" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> class="input-field focustip span12" value="<?php echo $section_data['password_page_otp_text']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/password_page_otp_text/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('password_page_otp_text'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['reset_pwd_mail_subject']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['reset_pwd_mail_subject']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/reset_pwd_mail_subject'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/reset_pwd_mail_subject/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><input id="reset_pwd_mail_subject" name="email_instruction[reset_pwd_mail_subject]" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" class="input-field focustip span12" value="<?php echo $section_data['reset_pwd_mail_subject']['front']; ?>" />
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/reset_pwd_mail_subject/front" class="fancybox multi_language_common_edit admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('reset_pwd_mail_subject'); ?></span>
                    </div>

                    <div class="control-group">
                      <label class="control-label"><?php echo $section_data['reset_pwd_mail']['admin']; ?></label>
                      <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $section_data['reset_pwd_mail']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/email_instruction/reset_pwd_mail'; ?>">
                      <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/reset_pwd_mail/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                      <div class="controls"><textarea id="ckeditor26" name="email_instruction[reset_pwd_mail]" class="input-field ckeditor26 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['reset_pwd_mail']['front']; ?></textarea>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/email_instruction/reset_pwd_mail/front/textarea/editor" class="fancybox multi_language_common_textarea_editor admin_globe">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                      <span class="red1"><?php echo form_error('reset_pwd_mail'); ?></span>
                    </div>


                  </div>
                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                    <div class="form-actions align-right">
                      <input class="btn btn-primary form-submit" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                    </div>
                  <?php } ?>
                </div>
              </div>
              <!-- /column -->
            </form>
          </div>
          <!-- /pickers -->
        </div>
        <!-- /content container -->
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script>
<script>
  $(document).ready(function() {
    for (i = 1; i <= 35; i++) {
      CKEDITOR.replace('ckeditor' + i, {
        height: 500
      });
    }

    for (var i in CKEDITOR.instances) {
      CKEDITOR.instances[i].on('change', function(e) {
        $('#' + e.sender.name).addClass('data-edit');
      });
    }

    $("#emailInstructions").validate();

    $(document).on('keyup', '.input-field', function() {
      $(this).addClass('data-edit');
    });

    $(document).on('change', '.input-field', function() {
      $(this).addClass('data-edit');
    });

    $(document).on('click', '.form-submit', function() {
      $('.input-field').attr('disabled', true);
      $('.data-edit').removeAttr('disabled');
    });
  });
</script>