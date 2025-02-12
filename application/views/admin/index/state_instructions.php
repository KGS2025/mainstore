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
                        <form id="addstate" name="addstate" class="form-horizontal" method="post">
                            <input type="hidden" name="operation" value="set"/>
                            <div class="row-fluid">
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                              <h5><?php echo $admin_static_links['state_instruction']['front']; ?></h5>
                                              <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                              <input type="text" value="<?php echo $admin_static_links['state_instruction']['front']; ; ?>" class="edit_input_text" style="display: none;">
                                              <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_static_links/state_instruction/front'; ?>">
                                              <?php } ?><a href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_static_links/state_instruction/admin" class="fancybox multi_language_common_edit admin_globe" target="_blank">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                              </a>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label"><?php echo $admin_block_users['country']['admin']; ?></label>
                                          <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                          <input type="text" value="<?php echo $admin_block_users['country']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                          <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_block_users/country'; ?>">
                                          <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_block_users/country/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                            <div class="controls">
                                                <select name="country" id="country" class="span12 selectpicker1 kgt2">
                                                    <?php foreach ($countries as $country) { ?>
                                                        <option value='<?php if ($lang_id != $primary_lang) { echo htmlentities($country['lang_countryName'], ENT_QUOTES); } else { echo htmlentities($country['countryName']); } ?>'
                                                                data-image="assets/frontend/images/msdropdown/icons/blank.gif"
                                                                data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>"
                                                                data-rel="<?php echo $country['country_code']; ?>" data-rel="<?php echo $country['alpha_2']; ?>"
                                                                data-shortcode="<?php echo htmlentities($country['alpha_2']); ?>"
                                                                <?php if (isset($country['alpha_2']) && $country['alpha_2'] == $countryCode) { ?> selected="selected"<?php } else if ($country['lang_countryName'] == "Canada") { ?>selected="selected" <?php } ?>>
                                                            <?php echo $country['countryName']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('country'); ?></span>
                                        </div>
                                        <?php $i = 0; ?>
                                        <?php foreach ($states as $state) { ?>

                                            <div class="control-group">
                                                
                                                            <?php if($lang_id != 'en') { ?>
                                                                <label class="control-label"><?php echo $admin_states[$i]['lang_name']; ?></label>
                                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                                <div class="edit_text" style="display:block"></div>
                                                                <input type="text" value="<?php echo $admin_states[$i]['lang_name']; ?>" class="edit_input_text" style="display: none;">
                                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/index/saveLanguagedData/' . $admin_states[$i] . '/admin_state/name'; ?>">
                                                                <?php } ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $admin_states[$i]['id']; ?>/admin_state_country/name" class="fancybox multi_language_edit admin_globe" target="_blank">
                                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                                </a>
                                                            <?php } else { ?>
                                                                <label class="control-label"><?php echo $admin_states[$i]['name']; ?></label>
                                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                                <div class="edit_text" style="display:block"></div>
                                                                <input type="text" value="<?php echo $admin_states[$i]['name']; ?>" class="edit_input_text" style="display: none;">
                                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/index/saveLanguagedData/' . $admin_states[$i]['id'] . '/admin_state/name'; ?>">
                                                                <?php } ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $admin_states[$i]['id']; ?>/admin_state_country/name" class="fancybox multi_language_edit admin_globe" target="_blank">
                                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                                </a>
                                                            <?php } ?>

                                                <div class="controls">
                                                    <input name="states[<?php echo $state['id']; ?>]" class="input-field focustip span12" type="text" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> value="<?php echo ucfirst($state['name']); ?>">
                                                    <a href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $state['id']; ?>/state_country/name" class="fancybox multi_language_edit" target="_blank">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                        <?php $i++; ?>
                                        <?php } ?>
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
        $("#addstate").validate();
        $("[name^=states]").each(function () {
            $(this).rules("add", {
                required: true
            });
        });

        $(document).on('keyup','.input-field',function(){
            $(this).addClass('data-edit');
            $('.input-field').removeAttr('disabled');
        });

        $(document).on('click','.form-submit',function(){
            $('.input-field').attr('disabled',true);
            $('.data-edit').removeAttr('disabled');
        });
    });
</script>
