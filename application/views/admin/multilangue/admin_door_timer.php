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
                <!-- page title -->
                <h5><?php echo $lang_heading_title; ?></h5>
               
                <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <!-- Pickers -->
                        <form id="adminDoorTimer" name="adminDoorTimer" class="form-horizontal" method="post">
                            <input type="hidden" name="operation" value="set"/>

                            <div class="row-fluid">

                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5><?php echo $section_data['main_admin_door_timer']['admin']; ?></h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['main_admin_door_timer']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_door_timer/main_admin_door_timer'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_door_timer/main_admin_door_timer/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['main_admin_door_time']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['main_admin_door_time']['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_door_timer/main_admin_door_time'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_door_timer/main_admin_door_time/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <select name="admin_door_timer[main_admin_door_timer]">
                                                    <?php
                                                    for ($i = 1; $i <= 20; $i++) {
                                                        $selected = "";
                                                        if (isset($section_data['main_admin_door_timer'])) {
                                                            if ($section_data['main_admin_door_timer'] == $i) {
                                                                $selected = "selected='selected'";
                                                            }
                                                        }
                                                        ?>
                                                        <option
                                                            value="<?php echo $i ?>" <?php echo $selected ?>><?php echo $i ?></option>
                                                        <?php } ?>
                                                        <?php
                                                        for ($i = 21; $i <= 1440; $i = $i + 20) {
                                                            $selected = "";
                                                            if (isset($section_data['main_admin_door_timer']['front'])) {
                                                                if ($section_data['main_admin_door_timer']['front'] == $i) {
                                                                    $selected = "selected='selected'";
                                                                }
                                                            }
                                                            ?>
                                                        <option
                                                            value="<?php echo $i ?>" <?php echo $selected ?>><?php echo $i ?></option>
                                                        <?php } ?>

                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('main_admin_door_timer'); ?></span>
                                        </div>
                                        <div class="clear-fix1 control-group">
                                            <label class="control-label"><?php echo $section_data['main_admin_door_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['main_admin_door_msg']['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_door_timer/main_admin_door_msg'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_door_timer/main_admin_door_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls"><input id="title1" name="admin_door_timer[main_admin_door_msg]"
                                                                         class="focustip span12" type="text"
                                                                         value="<?php echo $section_data['main_admin_door_msg']['front']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_door_timer/main_admin_door_msg/front" class="fancybox multi_language_common_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('main_admin_door_msg'); ?></span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5><?php echo $section_data['admin_door_popup_timer']['admin']; ?></h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['admin_door_popup_timer']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_door_timer/admin_door_popup_timer'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_door_timer/admin_door_popup_timer/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['admin_door_popup_time']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['admin_door_popup_time']['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_door_timer/admin_door_popup_time'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_door_timer/admin_door_popup_time/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">

                                                <select name="admin_door_timer[admin_door_popup_timer]">
                                                    <?php
                                                    for ($i = 1; $i <= 20; $i++) {
                                                        $selected = "";
                                                        if (isset($section_data['admin_door_popup_timer']['front'])) {
                                                            if ($section_data['admin_door_popup_timer']['front'] == $i)
                                                                $selected = "selected='selected'";
                                                        }
                                                        ?>
                                                        <option
                                                            value="<?php echo $i ?>" <?php echo $selected ?>><?php echo $i ?></option>
                                                        <?php } ?>
                                                        <?php
                                                        for ($i = 21; $i <= 1440; $i = $i + 20) {
                                                            $selected = "";
                                                            if (isset($section_data['admin_door_popup_timer']['front'])) {
                                                                if ($section_data['admin_door_popup_timer']['front'] == $i)
                                                                    $selected = "selected='selected'";
                                                            }
                                                            ?>
                                                        <option
                                                            value="<?php echo $i ?>" <?php echo $selected ?>><?php echo $i ?></option>
                                                        <?php } ?>

                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('admin_door_popup_timer'); ?></span>
                                        </div>
                                        <div class="clear-fix1 control-group">
                                            <label class="control-label"><?php echo $section_data['admin_door_popup_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['admin_door_popup_msg']['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_door_timer/admin_door_popup_msg'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_door_timer/admin_door_popup_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls"><input id="title2" name="admin_door_timer[admin_door_popup_msg]"
                                                                         class="focustip span12" type="text"
                                                                         value="<?php if (isset($section_data['admin_door_popup_msg']['front'])) echo $section_data['admin_door_popup_msg']['front']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_door_timer/admin_door_popup_msg/front" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('admin_door_popup_msg'); ?></span>
                                        </div>

                                    </div>
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5><?php echo $section_data['admin_door_login_timer']['admin']; ?></h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['admin_door_login_timer']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_door_timer/admin_door_login_timer'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_door_timer/admin_door_login_timer/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['admin_door_login_time']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['admin_door_login_time']['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_door_timer/admin_door_login_time'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_door_timer/admin_door_login_time/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">

                                                <select name="admin_door_timer[admin_door_login_timer]">
                                                    <?php
                                                    for ($i = 1; $i < 20; $i++) {
                                                        $selected = "";
                                                        if (isset($section_data['admin_door_login_timer']['front'])) {
                                                            if ($section_data['admin_door_login_timer']['front'] == $i)
                                                                $selected = "selected='selected'";
                                                        }
                                                        ?>
                                                        <option
                                                            value="<?php echo $i ?>" <?php echo $selected ?>><?php echo $i ?></option>
                                                        <?php } ?>
                                                        <?php
                                                        for ($i = 20; $i <= 1440; $i = $i + 20) {
                                                            $selected = "";
                                                            if (isset($section_data['admin_door_login_timer']['front'])) {
                                                                if ($section_data['admin_door_login_timer']['front'] == $i)
                                                                    $selected = "selected='selected'";
                                                            }
                                                            ?>
                                                        <option
                                                            value="<?php echo $i ?>" <?php echo $selected ?>><?php echo $i ?></option>
                                                        <?php } ?>

                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('admin_door_login_timer'); ?></span>
                                        </div>
                                        <div class="clear-fix1 control-group">
                                            <label class="control-label"><?php echo $section_data['admin_door_login_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['admin_door_login_msg']['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_door_timer/admin_door_login_msg'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_door_timer/admin_door_login_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls"><input id="title3" name="admin_door_timer[admin_door_login_msg]"
                                                                         class="focustip span12" type="text"
                                                                         value="<?php if (isset($section_data['admin_door_login_msg']['front'])) echo $section_data['admin_door_login_msg']['front']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_door_timer/admin_door_login_msg/front" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('admin_door_login_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['admin_door_block_timer']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['admin_door_block_timer']['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_door_timer/admin_door_block_timer'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_door_timer/admin_door_block_timer/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">

                                                <select name="admin_door_timer[admin_door_block_timer]">
                                                        <?php
                                                        for ($i = 20; $i <= 1440; $i = $i + 20) {
                                                            $selected = "";
                                                            if (isset($section_data['admin_door_block_timer']['front'])) {
                                                                if ($section_data['admin_door_block_timer']['front'] == $i)
                                                                    $selected = "selected='selected'";
                                                            }
                                                            ?>
                                                        <option
                                                            value="<?php echo $i ?>" <?php echo $selected ?>><?php echo $i ?></option>
                                                        <?php } ?>

                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('admin_door_block_timer'); ?></span>
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
<script>
    $(document).ready(function () {
        $("#adminDoorTimer").validate({
            rules: {
                main_admin_door_timer: "required",
                main_admin_door_msg: "required",
                admin_door_popup_timer: "required",
                admin_door_popup_msg: "required",
                admin_door_login_timer: "required",
                admin_door_login_msg: "required"
            }
        });
    });
</script>
