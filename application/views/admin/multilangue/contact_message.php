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
                <!-- page title -->
               <h5>
                    <?php echo $section_data['contact_message_section']['admin']; ?>
                </h5>
                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                <input type="text" value="<?php echo $section_data['contact_message_section']['admin']; ?>" class="edit_input_text"  style="display: none;">
                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/contact_message_section'; ?>">
                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/contact_message_section/admin" class="fancybox multi_language_common_edit admin_globe">
                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                </a>
                <!-- End page title -->
                <div class="body">
                    <!-- Content container -->
                    <div class="container">
                        <!-- Pickers -->
                        <form class="form-horizontal" method="post" enctype="multipart/form-data" id="contactMessage">
                            <input type="hidden" name="operation" value="set"/>
                            <div class="row-fluid">
                                <!-- Column -->
                                <div class="span12">
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $section_data['timeout_from_preview_popup']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['timeout_from_preview_popup']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/timeout_from_preview_popup'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/timeout_from_preview_popup/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['timeout_from_preview_popup_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['timeout_from_preview_popup_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/timeout_from_preview_popup_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/timeout_from_preview_popup_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <textarea id="title1" name="contact_message[preview_timeout]" class="focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['preview_timeout']['front'])) echo $section_data['preview_timeout']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/preview_timeout/front/textarea" class="fancybox multi_language_common_edit" id="multi_language_common_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>                                           

                                            <span class="red1"><?php echo form_error('fd_main_block_msg'); ?></span>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $section_data['timeout_popup']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['timeout_popup']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/timeout_popup'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/timeout_popup/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['timeout_popup_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['timeout_popup_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/timeout_popup_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/timeout_popup_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <textarea id="title1" name="contact_message[verification_timeout]" class="focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['verification_timeout'])) echo $section_data['verification_timeout']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/verification_timeout/front/textarea" class="fancybox multi_language_common_edit" id="multi_language_common_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            
                                            <span class="black1"><?php echo $section_data['timeout_popup_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['timeout_popup_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/timeout_popup_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/timeout_popup_note/admin/textarea" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <span class="red1"><?php echo form_error('fd_main_block_msg'); ?></span>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $section_data['wrong_code_popup']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['wrong_code_popup']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/wrong_code_popup'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/wrong_code_popup/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['wrong_code_popup_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['wrong_code_popup_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/wrong_code_popup_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/wrong_code_popup_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <textarea id="title1" name="contact_message[error_code_block_msg]" class="focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['error_code_block_msg']['front'])) echo $section_data['error_code_block_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/error_code_block_msg/front/textarea" class="fancybox multi_language_common_edit" id="multi_language_common_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            
                                            <span class="black1"><?php echo $section_data['wrong_code_popup_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['wrong_code_popup_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/wrong_code_popup_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/wrong_code_popup_note/admin/textarea" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <span class="red1"><?php echo form_error('fd_main_block_msg'); ?></span>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $section_data['no_code_lead_time']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['no_code_lead_time']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/no_code_lead_time'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/no_code_lead_time/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['no_code_lead_time_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['no_code_lead_time_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/no_code_lead_time_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/no_code_lead_time_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <textarea id="title1" name="contact_message[code_timeout_block_msg]" class="focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['code_timeout_block_msg']['front'])) echo $section_data['code_timeout_block_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/code_timeout_block_msg/front/textarea" class="fancybox multi_language_common_edit" id="multi_language_common_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            
                                            <span class="black1"><?php echo $section_data['no_code_lead_time_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['no_code_lead_time_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/no_code_lead_time_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/no_code_lead_time_note/admin/textarea" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <span class="red1"><?php echo form_error('fd_main_block_msg'); ?></span>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $section_data['resend_block_popup']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['resend_block_popup']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/resend_block_popup'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/resend_block_popup/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['resend_block_popup_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['resend_block_popup_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/resend_block_popup_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/resend_block_popup_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <textarea id="title1" name="contact_message[resend_block_msg]" class="focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['resend_block_msg']['front'])) echo $section_data['resend_block_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/resend_block_msg/front/textarea" class="fancybox multi_language_common_edit" id="multi_language_common_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            
                                            <span class="black1"><?php echo $section_data['resend_block_popup_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['resend_block_popup_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/resend_block_popup_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/resend_block_popup_note/admin/textarea" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <span class="red1"><?php echo form_error('fd_main_block_msg'); ?></span>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $section_data['already_block_popup']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['already_block_popup']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/already_block_popup'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/already_block_popup/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['already_block_popup_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['already_block_popup_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/already_block_popup_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/already_block_popup_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <textarea id="title1" name="contact_message[blocked_email_msg]" class="focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['blocked_email_msg']['front'])) echo $section_data['blocked_email_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/blocked_email_msg/front/textarea" class="fancybox multi_language_common_edit" id="multi_language_common_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            
                                            <span class="black1"><?php echo $section_data['already_block_popup_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['already_block_popup_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/already_block_popup_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/already_block_popup_note/admin/textarea" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <span class="red1"><?php echo form_error('fd_main_block_msg'); ?></span>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $section_data['refreshed_page']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['refreshed_page']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/refreshed_page'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/refreshed_page/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['refreshed_page_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['refreshed_page_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/refreshed_page_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/refreshed_page_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <textarea id="title1" name="contact_message[refreshed_msg]" class="focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['refreshed_msg']['front'])) echo $section_data['refreshed_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/refreshed_msg/front/textarea" class="fancybox multi_language_common_edit" id="multi_language_common_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            
                                            <span class="black1"><?php echo $section_data['refreshed_page_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['refreshed_page_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/refreshed_page_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/refreshed_page_note/admin/textarea" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <span class="red1"><?php echo form_error('fd_main_block_msg'); ?></span>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $section_data['success_popup']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['success_popup']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/success_popup'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/success_popup/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['success_popup_header_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['success_popup_header_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/success_popup_header_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/success_popup_header_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <textarea id="title1" name="contact_message[modal_success_header]" class="focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['modal_success_header']['front'])) echo $section_data['modal_success_header']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/modal_success_header/front/textarea" class="fancybox multi_language_common_edit" id="multi_language_common_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>

                                            <span class="red1"><?php echo form_error('fd_main_block_msg'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['success_popup_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['success_popup_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/success_popup_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/success_popup_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <textarea id="title1" name="contact_message[modal_success_body]" class="focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['modal_success_body']['front'])) echo $section_data['modal_success_body']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/modal_success_body/front/textarea" class="fancybox multi_language_common_edit" id="multi_language_common_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            
                                            <span class="black1"><?php echo $section_data['success_popup_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['success_popup_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_message/success_popup_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_message/success_popup_note/admin/textarea" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <span class="red1"><?php echo form_error('fd_main_block_msg'); ?></span>
                                        </div>
                                        
                                    </div>
                                </div>

                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                    <div class="form-actions align-right">
                                        </br>
                                        <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
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