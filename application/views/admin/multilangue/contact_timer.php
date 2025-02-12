<div class="content norightmargin">
    <?php if ($this->session->flashdata('success')) {
        $msg = $this->session->flashdata('success'); ?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?> </div>
        </div>
    <?php } ?>

    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <!-- page title -->
                <h5>
                    <div class="navbar-inner">
                        <h5><?php echo $section_data['contact_timer_text']['admin']; ?></h5>
                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                            <div class="edit_text" style="display:block"></div>
                            <input type="text" value="<?php echo $section_data['contact_timer_text']['admin']; ?>" class="edit_input_text"  style="display: none;">
                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_timer/contact_timer_text'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_timer/contact_timer_text/admin" class="fancybox multi_language_common_edit admin_globe">
                            <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                    </div>
                </h5>
                <!-- End page title -->
                <div class="body">

                    <!-- Content container -->
                    <div class="container">
                        <!-- Pickers -->
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set"/>

                            <div class="row-fluid">

                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5><?php echo $section_data['main_contact_timer']['admin']; ?></h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $section_data['main_contact_timer']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_timer/main_contact_timer'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_timer/main_contact_timer/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <select name="contact_timer[main_contact_timer]">
                                                    <?php for ($i = 1; $i <= 1440; $i = $i + 20) {
                                                        $selected = "";
                                                        if (isset($section_data['main_contact_timer']['front'])) {
                                                            if ($section_data['main_contact_timer']['front'] == $i) {
                                                                $selected = "selected='selected'";
                                                            }
                                                        }?>
                                                        <option value="<?php echo $i ?>" <?php echo $selected ?>><?php echo $i ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('main_contact_timer'); ?></span>
                                        </div>
                                        
                                        <div class="displaynon control-group">
                                            <label class="control-label">Message:</label>
                                            <div class="controls">
                                                <input id="title2" name="contact_timer[main_contact_msg]" class="focustip span12" type="text" value="<?php echo $section_data['main_contact_msg']['admin']; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('main_contact_msg'); ?></span>
                                        </div>
                                    </div>

                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5><?php echo $section_data['contact_preview_timer']['admin']; ?></h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $section_data['contact_preview_timer']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_timer/contact_preview_timer'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_timer/contact_preview_timer/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <select name="contact_timer[contact_preview_timer]">
                                                    <?php for ($i = 1; $i <= 1440; $i = $i + 20) {
                                                        $selected = "";
                                                        if (isset($section_data['contact_preview_timer']['front'])) {
                                                            if ($section_data['contact_preview_timer']['front'] == $i)
                                                                $selected = "selected='selected'";
                                                        } ?>
                                                        <option value="<?php echo $i ?>" <?php echo $selected ?>><?php echo $i ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('contact_preview_timer'); ?></span>
                                        </div>
                                        <div class="displaynon control-group">
                                            <label class="control-label">Message:</label>
                                            <div class="controls">
                                                <input id="title2" name="contact_timer[contact_preview_msg]" class="focustip span12" type="text" value="<?php if (isset($section_data['contact_preview_msg']['admin'])) echo $section_data['contact_preview_msg']['admin']; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('contact_preview_msg'); ?></span>
                                        </div>
                                    </div>

                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5><?php echo $section_data['contact_verification_code_timer']['admin']; ?></h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $section_data['contact_verification_code_timer']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_timer/contact_verification_code_timer'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_timer/contact_verification_code_timer/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <select name="contact_timer[contact_popup_timer]">
                                                    <?php for ($i = 1; $i <= 1440; $i = $i + 20) {
                                                        $selected = "";
                                                        if (isset($section_data['contact_popup_timer']['front'])) {
                                                            if ($section_data['contact_popup_timer']['front'] == $i)
                                                                $selected = "selected='selected'";
                                                        } ?>
                                                        <option
                                                            value="<?php echo $i ?>" <?php echo $selected ?>><?php echo $i ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('contact_popup_timer'); ?></span>
                                        </div>

                                        <div class="displaynon control-group">
                                            <label class="control-label">Message:</label>
                                            <div class="controls">
                                                <input id="title2" name="contact_timer[contact_popup_msg]" class="focustip span12" type="text" value="<?php if (isset($section_data['contact_popup_msg']['admin'])) echo $section_data['contact_popup_msg']['admin']; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('contact_popup_msg'); ?></span>
                                        </div>
                                    </div>

                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5><?php echo $section_data['edit_contact_timer']['admin']; ?></h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $section_data['edit_contact_timer']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_timer/edit_contact_timer'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_timer/edit_contact_timer/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <select name="contact_timer[contact_edit_timer]">
                                                    <?php for ($i = 1; $i <= 1440; $i = $i + 20) {
                                                        $selected = "";
                                                        if (isset($section_data['contact_edit_timer']['front'])) {
                                                            if ($section_data['contact_edit_timer']['front'] == $i)
                                                                $selected = "selected='selected'";
                                                        } ?>
                                                        <option value="<?php echo $i ?>" <?php echo $selected ?>><?php echo $i ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('contact_edit_timer'); ?></span>
                                        </div>

                                        <div class="displaynon control-group">
                                            <label class="control-label">Message:</label>
                                            <div class="controls">
                                                <input id="title2" name="contact_timer[contact_edit_msg]" class="focustip span12" type="text" value="<?php if (isset($section_data['contact_edit_msg']['front'])) echo $section_data['contact_edit_msg']['front']; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('contact_edit_msg'); ?></span>
                                        </div>
                                    </div>

                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5><?php echo $section_data['edit_contact_msg_length']['admin']; ?></h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $section_data['edit_contact_msg_length']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/contact_timer/edit_contact_msg_length'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/contact_timer/edit_contact_msg_length/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <select name="contact_timer[edit_contact_msg_length]">
                                                    <?php for ($i = 500; $i <= 5000; $i = $i + 500) {
                                                        $selected = "";
                                                        if (isset($section_data['edit_contact_msg_length']['front'])) {
                                                            if ($section_data['edit_contact_msg_length']['front'] == $i)
                                                                $selected = "selected='selected'";
                                                        } ?>
                                                        <option value="<?php echo $i ?>" <?php echo $selected ?>><?php echo $i ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('edit_contact_msg_length'); ?></span>
                                        </div>
                                    </div>

                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                        <div class="form-actions align-right">
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