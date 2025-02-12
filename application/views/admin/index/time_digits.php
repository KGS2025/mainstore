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
            <!--    <h5><i class="font-user"></i>General Instruction</h5> -->
                <!-- End page title -->
                <div class="body">
                    <!-- Content container -->
                    <div class="container">
                        <!-- Pickers -->
                        <form id="generalInstructions" name="generalInstructions" class="form-horizontal" method="post">
                            <input type="hidden" name="operation" value="set"/>
                            <div class="row-fluid">
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar">
                                        <div class="navbar-inner">
                                              <h5><?php echo $admin_title['time_digits_inner']['front']; ?></h5>
                                              <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                              <input type="text" value="<?php echo $admin_title['time_digits_inner']['front']; ; ?>" class="edit_input_text" style="display: none;">
                                              <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_title/time_digits_inner/front'; ?>">
                                              <?php } ?><a href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_title/time_digits_inner/front" class="fancybox multi_language_common_edit admin_globe" target="_blank">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                              </a>
                                            </div>

                                        </div>

                                         <div class="control-group">
                                            <label class="control-label"><?php echo $admin_time_digits[0]->digit_0; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_time_digits[0]->digit_0; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/index/saveLanguagedData/1/admin_time_digits/digit_0'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_0" class="fancybox multi_language_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input id="digit_0" name="digit_0" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> class="focustip span12" type="text" value="<?php echo @$time_digits['digit_0']; ?>">
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_0" class="fancybox multi_language_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('digit_0'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_time_digits[0]->digit_1; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_time_digits[0]->digit_1; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/index/saveLanguagedData/1/admin_time_digits/digit_1'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_1" class="fancybox multi_language_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input id="digit_1" name="digit_1" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> class="focustip span12" type="text" value="<?php echo @$time_digits['digit_1']; ?>">
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_1" class="fancybox multi_language_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('digit_1'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_time_digits[0]->digit_2; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_time_digits[0]->digit_2; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/index/saveLanguagedData/1/admin_time_digits/digit_2'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_2" class="fancybox multi_language_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input id="digit_2" name="digit_2" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> class="focustip span12" type="text" value="<?php echo @$time_digits['digit_2']; ?>">
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_2" class="fancybox multi_language_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('digit_2'); ?></span>
                                        </div>
                                         <div class="control-group">
                                            <label class="control-label"><?php echo $admin_time_digits[0]->digit_3; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_time_digits[0]->digit_3; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/index/saveLanguagedData/1/admin_time_digits/digit_3'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_3" class="fancybox multi_language_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input id="digit_3" name="digit_3" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> class="focustip span12" type="text" value="<?php echo @$time_digits['digit_3']; ?>">
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_3" class="fancybox multi_language_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('digit_3'); ?></span>
                                        </div>
                                         <div class="control-group">
                                            <label class="control-label"><?php echo $admin_time_digits[0]->digit_4; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_time_digits[0]->digit_4; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/index/saveLanguagedData/1/admin_time_digits/digit_4'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_4" class="fancybox multi_language_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input id="digit_4" name="digit_4" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> class="focustip span12" type="text" value="<?php echo @$time_digits['digit_4']; ?>">
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_4" class="fancybox multi_language_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('digit_4'); ?></span>
                                        </div>
                                         <div class="control-group">
                                            <label class="control-label"><?php echo $admin_time_digits[0]->digit_5; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_time_digits[0]->digit_5; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/index/saveLanguagedData/1/admin_time_digits/digit_5'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_5" class="fancybox multi_language_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input id="digit_5" name="digit_5" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> class="focustip span12" type="text" value="<?php echo @$time_digits['digit_5']; ?>">
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_5" class="fancybox multi_language_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('digit_5'); ?></span>
                                        </div>
                                         <div class="control-group">
                                            <label class="control-label"><?php echo $admin_time_digits[0]->digit_6; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_time_digits[0]->digit_6; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/index/saveLanguagedData/1/admin_time_digits/digit_6'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_6" class="fancybox multi_language_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input id="digit_6" name="digit_6" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> class="focustip span12" type="text" value="<?php echo @$time_digits['digit_6']; ?>">
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_6" class="fancybox multi_language_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('digit_6'); ?></span>
                                        </div>
                                         <div class="control-group">
                                            <label class="control-label"><?php echo $admin_time_digits[0]->digit_7; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_time_digits[0]->digit_7; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/index/saveLanguagedData/1/admin_time_digits/digit_7'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_7" class="fancybox multi_language_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input id="digit_7" name="digit_7" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> class="focustip span12" type="text" value="<?php echo @$time_digits['digit_7']; ?>">
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_7" class="fancybox multi_language_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('digit_7'); ?></span>
                                        </div>
                                         <div class="control-group">
                                            <label class="control-label"><?php echo $admin_time_digits[0]->digit_8; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_time_digits[0]->digit_8; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/index/saveLanguagedData/1/admin_time_digits/digit_8'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_8" class="fancybox multi_language_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input id="digit_8" name="digit_8" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> class="focustip span12" type="text" value="<?php echo @$time_digits['digit_8']; ?>">
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_8" class="fancybox multi_language_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('digit_8'); ?></span>
                                        </div>
                                         <div class="control-group">
                                            <label class="control-label"><?php echo $admin_time_digits[0]->digit_9; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_time_digits[0]->digit_9; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/index/saveLanguagedData/1/admin_time_digits/digit_9'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_9" class="fancybox multi_language_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input id="digit_9" name="digit_9" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> class="focustip span12" type="text" value="<?php echo @$time_digits['digit_9']; ?>">
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/time_digits_country/digit_9" class="fancybox multi_language_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('digit_9'); ?></span>
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
        $("#generalInstructions").validate({
            rules: {
                digit_0: "required",
                digit_1: "required",
                digit_2: "required",
                digit_3: "required",
                digit_4: "required",
                digit_5: "required",
                digit_6: "required",
                digit_7: "required",
                digit_8: "required",
                digit_9: "required",
               
            }
        });
    });
</script>
