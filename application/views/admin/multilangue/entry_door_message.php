<div class="content zerorightmargin">
    <?php
    if ($this->session->flashdata('success')) {
        $msg = $this->session->flashdata('success');
        ?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="outer">
        <div class="inner">
            <div class="page-header">
                
                <div class="body">
                    <!-- Content container -->
                    <div class="container">
                        <!-- Pickers -->
                        <form class="form-horizontal" method="post" enctype="multipart/form-data" id="entryDoorMessage">
                            <input type="hidden" name="operation" value="set"/>
                            <div class="row-fluid">
                                <!-- Column -->
                                <div class="span12">
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $section_data['fd_block_related_message']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['fd_block_related_message']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_block_related_message'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_block_related_message/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['fd_main_block_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['fd_main_block_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_main_block_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_main_block_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea id="title1" name="entry_door_message[fd_main_block_msg]" class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['fd_main_block_msg']['front'])) echo $section_data['fd_main_block_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_main_block_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['fd_main_block_msg_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['fd_main_block_msg_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_main_block_msg_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_main_block_msg_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <span class="red1"><?php echo form_error('fd_main_block_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['fd_edit_block_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['fd_edit_block_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_edit_block_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_edit_block_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>


                                            <div class="controls"><textarea id="title2" name="entry_door_message[fd_edit_block_msg]" class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['fd_edit_block_msg']['front'])) echo $section_data['fd_edit_block_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_edit_block_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['fd_edit_block_msg_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['fd_main_block_msg_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_edit_block_msg_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_edit_block_msg_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('fd_edit_block_msg'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['fd_verification_block_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['fd_verification_block_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_verification_block_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_block_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea id="title3" name="entry_door_message[fd_verification_block_msg]" class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['fd_verification_block_msg']['front'])) echo $section_data['fd_verification_block_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_block_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['fd_verification_block_msg_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['fd_verification_block_msg_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_verification_block_msg_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_block_msg_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['fd_verification_resent_block_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['fd_verification_resent_block_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_verification_resent_block_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_resent_block_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>


                                            <div class="controls"><textarea id="title4" name="entry_door_message[fd_verification_resent_block_msg]" class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['fd_verification_resent_block_msg']['front'])) echo $section_data['fd_verification_resent_block_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_resent_block_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['fd_verification_resent_block_msg_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['fd_verification_resent_block_msg_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_verification_resent_block_msg_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_resent_block_msg_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('fd_verification_resent_block_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['fd_verification_resent_block_msg_sms']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['fd_verification_resent_block_msg_sms']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_verification_resent_block_msg_sms'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_resent_block_msg_sms/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>


                                            <div class="controls"><textarea id="title5" name="entry_door_message[fd_verification_resent_block_msg_sms]" class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['fd_verification_resent_block_msg_sms']['front'])) echo $section_data['fd_verification_resent_block_msg_sms']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_resent_block_msg_sms/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['fd_verification_resent_block_msg_sms_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['fd_verification_resent_block_msg_sms_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_verification_resent_block_msg_sms_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_resent_block_msg_sms_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('fd_verification_resent_block_msg_sms'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['fd_verification_resent_block_msg_email_sms']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['fd_verification_resent_block_msg_email_sms']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_verification_resent_block_msg_email_sms'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_resent_block_msg_email_sms/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>


                                            <div class="controls"><textarea id="title6" name="entry_door_message[fd_verification_resent_block_msg_email_sms]" class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['fd_verification_resent_block_msg_email_sms']['front'])) echo $section_data['fd_verification_resent_block_msg_email_sms']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_resent_block_msg_email_sms/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['fd_verification_resent_block_msg_email_sms_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['fd_verification_resent_block_msg_email_sms_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_verification_resent_block_msg_email_sms_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_resent_block_msg_email_sms_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('fd_verification_resent_block_msg_email_sms'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['fd_verification_wrong_block_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['fd_verification_wrong_block_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_verification_wrong_block_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_wrong_block_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>


                                            <div class="controls"><textarea id="title7" name="entry_door_message[fd_verification_wrong_block_msg]" class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['fd_verification_wrong_block_msg']['front'])) echo $section_data['fd_verification_wrong_block_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_wrong_block_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['fd_verification_wrong_block_msg_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['fd_verification_wrong_block_msg_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_verification_wrong_block_msg_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_wrong_block_msg_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('fd_verification_wrong_block_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['fd_verification_wrong_block_msg_sms']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['fd_verification_wrong_block_msg_sms']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_verification_wrong_block_msg_sms'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_wrong_block_msg_sms/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>


                                            <div class="controls"><textarea id="title8" name="entry_door_message[fd_verification_wrong_block_msg_sms]" class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['fd_verification_wrong_block_msg_sms']['front'])) echo $section_data['fd_verification_wrong_block_msg_sms']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_wrong_block_msg_sms/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['fd_verification_wrong_block_msg_sms_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['fd_verification_wrong_block_msg_sms_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_verification_wrong_block_msg_sms_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_wrong_block_msg_sms_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('fd_verification_wrong_block_msg_sms'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['fd_verification_wrong_block_msg_email_sms']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['fd_verification_wrong_block_msg_email_sms']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_verification_wrong_block_msg_email_sms'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_wrong_block_msg_email_sms/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>


                                            <div class="controls"><textarea id="title9" name="entry_door_message[fd_verification_wrong_block_msg_email_sms]" class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['fd_verification_wrong_block_msg_email_sms']['front'])) echo $section_data['fd_verification_wrong_block_msg_email_sms']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_wrong_block_msg_email_sms/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['fd_verification_wrong_block_msg_email_sms_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['fd_verification_wrong_block_msg_email_sms_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_verification_wrong_block_msg_email_sms_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_verification_wrong_block_msg_email_sms_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('fd_verification_wrong_block_msg_email_sms'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['fd_block_notification_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['fd_block_notification_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_block_notification_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_block_notification_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea id="title10" name="entry_door_message[fd_block_notification_msg]" class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['fd_block_notification_msg']['front'])) echo $section_data['fd_block_notification_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_block_notification_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['fd_block_notification_msg_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['fd_block_notification_msg_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_block_notification_msg_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_block_notification_msg_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('fd_block_notification_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['fd_block_notification_msg_sms']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['fd_block_notification_msg_sms']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_block_notification_msg_sms'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_block_notification_msg_sms/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>


                                            <div class="controls"><textarea id="title11" name="entry_door_message[fd_block_notification_msg_sms]" class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['fd_block_notification_msg_sms']['front'])) echo $section_data['fd_block_notification_msg_sms']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_block_notification_msg_sms/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['fd_block_notification_msg_sms_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['fd_block_notification_msg_sms_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_block_notification_msg_sms_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_block_notification_msg_sms_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('fd_block_notification_msg_sms'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['fd_block_notification_msg_email_sms']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['fd_block_notification_msg_email_sms']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_block_notification_msg_email_sms'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_block_notification_msg_email_sms/admin" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>


                                            <div class="controls"><textarea id="title12" name="entry_door_message[fd_block_notification_msg_email_sms]" class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['fd_block_notification_msg_email_sms']['front'])) echo $section_data['fd_block_notification_msg_email_sms']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_block_notification_msg_email_sms/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['fd_block_notification_msg_email_sms_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['fd_block_notification_msg_email_sms_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/fd_block_notification_msg_email_sms_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/fd_block_notification_msg_email_sms_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('fd_block_notification_msg_email_sms'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['welcomback_back_text']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['welcomback_back_text']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/welcomback_back_text'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/welcomback_back_text/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>


                                            <div class="controls"><input type="text" id="welcomback_back_text" name="entry_door_message[welcomback_back_text]" class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> value="<?php echo $section_data['welcomback_back_text']['front']; ?>" />
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/welcomback_back_text/front" class="fancybox multi_language_common_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('welcomback_back_text'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['remaining_time_text']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['remaining_time_text']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/entry_door_message/remaining_time_text'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/remaining_time_text/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><input type="text" id="remaining_time_text" name="entry_door_message[remaining_time_text]" class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> value="<?php echo $section_data['remaining_time_text']['front']; ?>" />
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/entry_door_message/remaining_time_text/front" class="fancybox multi_language_common_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('remaining_time_text'); ?></span>
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

<script>
    $(document).ready(function () {
        $("#entryDoorMessage").validate({
            rules: {
                fd_main_block_msg: "required",
                fd_edit_block_msg: "required",
                fd_verification_block_msg: "required",
                fd_verification_resent_block_msg: "required",
                fd_verification_resent_block_msg_sms: "required",
                fd_verification_resent_block_msg_email_sms: "required",
                fd_verification_wrong_block_msg: "required",
                fd_verification_wrong_block_msg_sms: "required",
                fd_verification_wrong_block_msg_email_sms: "required",
                fd_block_notification_msg: "required",
                fd_block_notification_msg_sms: "required",
                fd_block_notification_msg_email_sms: "required"
            }
        });

        $(document).on('keyup','.input-field',function(){
            $(this).addClass('data-edit');
        });

        $(document).on('change','.input-field',function(){
            $(this).addClass('data-edit');
        });

        $(document).on('click','.form-submit',function(){
            $('.input-field').attr('disabled',true);
            $('.data-edit').removeAttr('disabled');
        });
    });
</script>
