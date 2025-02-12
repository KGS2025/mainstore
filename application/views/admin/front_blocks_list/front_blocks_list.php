<div class="content zerorightmargin">
    <?php
    function isValidTimezoneId($timezoneId) 
    {
        try{
            new DateTimeZone($timezoneId);
        }catch(Exception $e){
            return FALSE;
        }
        return TRUE;
    } 
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
    <div id="result"></div>
    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <!-- page title -->

                <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well margintop-30px">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <h5>
                                        <?php echo $admin_front_user_block_list['front_user_block']['admin']; ?>
                                    </h5>
                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                    <input type="text" value="<?php echo $admin_front_user_block_list['front_user_block']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_front_user_block_list/front_user_block'; ?>">
                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_front_user_block_list/front_user_block/admin" class="fancybox multi_language_common_edit admin_globe">
                                        <img src="<?php echo asset_url()?>assets/uploads/global.jpg" height="20" width="20" >
                                    </a>

                                    <div class="dataTables_length float-right" id="data-table_length">
                                    
                                        <label class="control-label"><?php echo $admin_front_user_block_list['block_reasons']['admin']; ?></label>
                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                        <input type="text" value="<?php echo $admin_front_user_block_list['block_reasons']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_front_user_block_list/block_reasons'; ?>">
                                        <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_front_user_block_list/block_reasons/admin" class="fancybox multi_language_common_edit admin_globe">
                                            <img src="<?php echo asset_url()?>assets/uploads/global.jpg" height="20" width="20" >
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                    <table aria-describedby="data-table_info" class="table table-striped dataTable"
                                           id="data-table">
                                        <thead>
                                            <tr role="row">
                                                <th colspan="1" rowspan="1"><input id="delete_all_blocks" type="checkbox"
                                                                                   name="delete_option[]" value="all"></th>
                                                <th colspan="1" rowspan="1">
                                                    <label class="control-label"><?php echo $admin_front_user_block_list['srno']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_front_user_block_list['srno']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_front_user_block_list/srno'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_front_user_block_list/srno/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="<?php echo asset_url()?>assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_front_user_block_list['code_errors']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_front_user_block_list['code_errors']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_front_user_block_list/code_errors'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_front_user_block_list/code_errors/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="<?php echo asset_url()?>assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_front_user_block_list['email_code_sent']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_front_user_block_list['email_code_sent']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_front_user_block_list/email_code_sent'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_front_user_block_list/email_code_sent/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="<?php echo asset_url()?>assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_front_user_block_list['sms_code_sent']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_front_user_block_list['sms_code_sent']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_front_user_block_list/sms_code_sent'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_front_user_block_list/sms_code_sent/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="<?php echo asset_url()?>assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_front_user_block_list['block_reason']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_front_user_block_list['block_reason']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_front_user_block_list/block_reason'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_front_user_block_list/block_reason/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="<?php echo asset_url()?>assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_front_user_block_list['section']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_front_user_block_list['section']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_front_user_block_list/section'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_front_user_block_list/section/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="<?php echo asset_url()?>assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th colspan="1" rowspan="1">
                                                    <label class="control-label"><?php echo $admin_front_user_block_list['block_date']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_front_user_block_list['block_date']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_front_user_block_list/block_date'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_front_user_block_list/block_date/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="<?php echo asset_url()?>assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_front_user_block_list['time_remaining']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_front_user_block_list['time_remaining']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_front_user_block_list/time_remaining'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_front_user_block_list/time_remaining/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="<?php echo asset_url()?>assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_front_user_block_list['email_code']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_front_user_block_list['email_code']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_front_user_block_list/email_code'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_front_user_block_list/email_code/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="<?php echo asset_url()?>assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_front_user_block_list['sms_code']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_front_user_block_list['sms_code']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_front_user_block_list/sms_code'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_front_user_block_list/sms_code/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="<?php echo asset_url()?>assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_front_user_block_list['email']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_front_user_block_list['email']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_front_user_block_list/email'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_front_user_block_list/email/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="<?php echo asset_url()?>assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_front_user_block_list['applicant']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_front_user_block_list['applicant']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_front_user_block_list/applicant'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_front_user_block_list/applicant/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="<?php echo asset_url()?>assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_front_user_block_list['country']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_front_user_block_list['country']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_front_user_block_list/country'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_front_user_block_list/country/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="<?php echo asset_url()?>assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th colspan="1" rowspan="1">
                                                    <label class="control-label"><?php echo $admin_front_user_block_list['telephone']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_front_user_block_list['telephone']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_front_user_block_list/telephone'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_front_user_block_list/telephone/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="<?php echo asset_url()?>assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_front_user_block_list['ip_address']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_front_user_block_list['ip_address']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_front_user_block_list/ip_address'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_front_user_block_list/ip_address/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="<?php echo asset_url()?>assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>

                                                <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                    <th colspan="1" rowspan="1">
                                                        <button id="delete_checked"><?php echo $admin_static_links['delete_all']['front']; ?></button>
                                                    </th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody aria-relevant="all" aria-live="polite" role="alert">
                                            <?php
                                            if (!empty($all_data)){                                                
						                        $int_I = 1;
                                                foreach ($all_data as $set_data) {
                                                    ?>
                                                    <tr class="odd">
                                                        <td class="dataTables" valign="top">
                                                            
                                                            <?php if (isset($set_data['edfbd_id']) && $set_data['edfbd_id'] != '') { ?>
                                                                <input class="blocks" type="checkbox" name="delete_option[]"
                                                                       data-section="<?php echo $set_data['region']; ?>"
                                                                       value="<?php echo 'edfbd_' . $set_data['edfbd_id']; ?>">
                                                                   <?php } elseif (isset($set_data['bel_id']) && $set_data['bel_id'] != '') { ?>
                                                                <input class="blocks" type="checkbox" name="delete_option[]"
                                                                       data-section="<?php echo $set_data['region']; ?>"
                                                                       value="<?php echo 'bel_' . $set_data['bel_id']; ?>">
                                                                   <?php } elseif (isset($set_data['edbe_id']) && $set_data['edbe_id'] != '') { ?>
                                                                <input class="blocks" type="checkbox" name="delete_option[]"
                                                                       data-section="<?php echo $set_data['region']; ?>"
                                                                       value="<?php echo 'edbe_' . $set_data['edbe_id']; ?>">
                                                                   <?php } elseif (isset($set_data['edbp_id']) && $set_data['edbp_id'] != '') { ?>
                                                                <input class="blocks" type="checkbox" name="delete_option[]"
                                                                       data-section="<?php echo $set_data['region']; ?>"
                                                                       value="<?php echo 'edbp_' . $set_data['edbp_id']; ?>">
                                                                   <?php } elseif (isset($set_data['cbe_id']) && $set_data['cbe_id'] != '') { ?>
                                                                <input class="blocks" type="checkbox" name="delete_option[]"
                                                                       data-section="<?php echo $set_data['region']; ?>"
                                                                       value="<?php echo 'cbe_' . $set_data['cbe_id']; ?>">
                                                                   <?php } else { ?>
                                                                <input class="blocks" type="checkbox" name="delete_option[]"
                                                                       data-section="<?php echo $set_data['region']; ?>"
                                                                       value="<?php echo 'cbp_' . $set_data['cbp_id']; ?>">
                                                                   <?php } ?>

                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $int_I++; ?>
                                                        </td>

                                                        <?php if (isset($set_data['errors']) && $set_data['errors'] != '') { ?>
                                                            <td class="dataTables" valign="top">
                                                                <?php echo $set_data['errors']; ?>
                                                            </td>
                                                        <?php } else { ?>
                                                            <td class="dataTables" valign="top">
                                                                <?php echo $set_data['int_errors']; ?>
                                                            </td>
                                                        <?php } ?>

                                                        <?php if (isset($set_data['email_sents']) && $set_data['email_sents'] != '') { ?>
                                                            <td class="dataTables" valign="top">
                                                                <?php echo $set_data['email_sents']; ?>
                                                            </td>
                                                        <?php } else { ?>
                                                            <td class="dataTables" valign="top">
                                                                <?php echo $set_data['email_int_sents']; ?>
                                                            </td>
                                                        <?php } ?>
                                                            
                                                        <?php if (isset($set_data['sms_sents']) && $set_data['sms_sents'] != '') { ?>
                                                            <td class="dataTables" valign="top">
                                                                <?php echo $set_data['sms_sents']; ?>
                                                            </td>
                                                        <?php } else { ?>
                                                            <td class="dataTables" valign="top">
                                                                <?php echo $set_data['sms_int_sents']; ?>
                                                            </td>
                                                        <?php } ?>


                                                        <?php if (isset($set_data['block']) && $set_data['block'] != '') { ?>
                                                            <td class="dataTables" valign="top">
                                                                <?php echo $set_data['block']; ?>
                                                            </td>
                                                        <?php } else { ?>
                                                            <td class="dataTables" valign="top">
                                                                <?php echo $set_data['int_block']; ?>
                                                            </td>
                                                        <?php } ?>

                                                        <td class="dataTables" vallign="top">
                                                            <?php echo $set_data['region']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php

                                                            if (isset($set_data['timezone']) && $set_data['timezone'] != '') {
                                                                $validTimezone = isValidTimezoneId($set_data['timezone']);
                                                                if ($validTimezone == "true" || $validTimezone == true) {
                                                                    $timezone = $set_data['timezone'];
                                                                } else {
                                                                    $timezone = 'America/Los_Angeles';
                                                                }
                                                            } else {
                                                                $timezone = 'America/Los_Angeles';
                                                            }
                                                            if (isset($set_data['dte_block']) && $set_data['dte_block'] != '') {
								$default_timezone = date_default_timezone_get();
                                                                $date = date('Y-m-d H:i:s', strtotime($set_data['dte_block']));
								$dateTime = new DateTime($date, new DateTimeZone($default_timezone));
                                                                $dateTime->setTimezone(new DateTimeZone($timezone));
                                                                $created_time = $dateTime->format('Y-m-d H:i:s');
                                                                $created_time = strtotime($created_time);
                                                                echo date('m/d/Y', $created_time);
                                                            } else if (isset($set_data['created_time']) && $set_data['created_time'] != '') {
                                                                $default_timezone = date_default_timezone_get();
                                                                $date = date('Y-m-d H:i:s', $set_data['created_time']);
                                                                $dateTime = new DateTime($date, new DateTimeZone($default_timezone));
                                                                $dateTime->setTimezone(new DateTimeZone($timezone));
                                                                $created_time = $dateTime->format('Y-m-d H:i:s');
                                                                $created_time = strtotime($created_time);
                                                                echo date('m/d/Y', $created_time);
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php
                                                            $int_block = strtotime($set_data['dte_block']);
                                                            if(isset($set_data['str_country']) && $set_data['str_country'] != '') {
                                                                $blocktime = $cart_timer['cart_block_timer']['front'];
                                                            } else {
                                                                $blocktime = $entry_door_timer['entry_door_block_timer']['front'];
                                                            }
                                                            $int_TR = $blocktime - intval(((time() - $int_block) / 60));

                                                            if ($int_TR < 0)
                                                                $int_TR = 0;

                                                            echo $int_TR . $this->lang->line('minute');
                                                            ?>
                                                        </td>
                                                            <?php if (isset($set_data['email_code']) && $set_data['email_code'] != '') { ?>
                                                            <td class="dataTables" valign="top">
                                                            <?php echo $set_data['email_code']; ?>
                                                            </td>
                                                            <?php } else { ?>
                                                            <td class="dataTables" valign="top">
                                                            <?php echo $set_data['str_code']; ?>
                                                            </td>
                                                        <?php } ?>

                                                            <?php if (isset($set_data['sms_code']) && $set_data['sms_code'] != '') { ?>
                                                            <td class="dataTables" valign="top">
                                                            <?php echo $set_data['sms_code']; ?>
                                                            </td>
                                                            <?php } else { ?>
                                                            <td class="dataTables" valign="top">
                                                            <?php echo $set_data['str_sms_code']; ?>
                                                            </td>
                                                        <?php } ?>

                                                            <?php if (isset($set_data['email']) && $set_data['email'] != '') { ?>
                                                            <td class="dataTables" valign="top">
                                                            <?php echo $set_data['email']; ?>
                                                            </td>
                                                            <?php } else { ?>
                                                            <td class="dataTables" valign="top">
                                                            <?php echo $set_data['str_email']; ?>
                                                            </td>
                                                        <?php } ?>

                                                            <?php if (isset($set_data['applicant']) && $set_data['applicant'] != '') { ?>
                                                            <td class="dataTables" valign="top">
                                                            <?php echo $set_data['applicant']; ?>
                                                            </td>
                                                            <?php } else { ?>
                                                            <td class="dataTables" valign="top">
                                                            <?php echo $set_data['str_applicant']; ?>
                                                            </td>
                                                        <?php } ?>

                                                            <?php if (isset($set_data['country']) && $set_data['country'] != '') { ?>
                                                            <td class="dataTables" valign="top">
                                                            <?php echo $set_data['country']; ?>
                                                            </td>
                                                            <?php } else { ?>
                                                            <td class="dataTables" valign="top">
                                                            <?php echo $set_data['str_country']; ?>
                                                            </td>
                                                        <?php } ?>

                                                            <?php if (isset($set_data['telephone']) && $set_data['telephone'] != '') { ?>
                                                            <td class="dataTables" valign="top">
                                                            <?php echo $set_data['telephone']; ?>
                                                            </td>
                                                            <?php } else { ?>
                                                            <td class="dataTables" valign="top">
                                                            <?php echo $set_data['str_telephone']; ?>
                                                            </td>
                                                        <?php } ?>

                                                            <?php if (isset($set_data['ip_address']) && $set_data['ip_address'] != '') { ?>
                                                            <td class="dataTables" valign="top">
                                                            <?php echo $set_data['ip_address']; ?>
                                                            </td>
                                                            <?php } else { ?>
                                                            <td class="dataTables" valign="top">
                                                            <?php echo $set_data['str_ip_address']; ?>
                                                            </td>
                                                        <?php } ?>

                                                        <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                            <?php if (isset($set_data['edfbd_id']) && $set_data['edfbd_id'] != '') { ?>
                                                                <td class="dataTables" valign="top">
                                                                    <a href="admin/<?php echo $lang_id; ?>/front_blocks_list/delete/edfbd/<?php echo $set_data['edfbd_id']; ?>"
                                                                       onclick="return confirm_box('Are you sure you want to remove This block?');"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                                </td>
                                                            <?php } elseif (isset($set_data['bel_id']) && $set_data['bel_id'] != '') { ?>
                                                                <td class="dataTables" valign="top">
                                                                    <a href="admin/<?php echo $lang_id; ?>/front_blocks_list/delete/bel/<?php echo $set_data['bel_id']; ?>"
                                                                       onclick="return confirm_box('Are you sure you want to remove This block?');"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                                </td>
                                                            <?php } elseif (isset($set_data['edbe_id']) && $set_data['edbe_id'] != '') { ?>
                                                                <td class="dataTables" valign="top">
                                                                    <a href="admin/<?php echo $lang_id; ?>/front_blocks_list/delete/edbe/<?php echo $set_data['edbe_id']; ?>"
                                                                       onclick="return confirm_box('Are you sure you want to remove This block?');"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                                </td>
                                                            <?php } elseif (isset($set_data['edbp_id']) && $set_data['edbp_id'] != '') { ?>
                                                                <td class="dataTables" valign="top">
                                                                    <a href="admin/<?php echo $lang_id; ?>/front_blocks_list/delete/edbp/<?php echo $set_data['edbp_id']; ?>"
                                                                       onclick="return confirm_box('Are you sure you want to remove This block?');"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                                </td>
                                                            <?php } elseif (isset($set_data['cbe_id']) && $set_data['cbe_id'] != '') { ?>
                                                                <td class="dataTables" valign="top">
                                                                    <a href="admin/<?php echo $lang_id; ?>/front_blocks_list/delete/cbe/<?php echo $set_data['cbe_id']; ?>"
                                                                       onclick="return confirm_box('Are you sure you want to remove This block?');"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                                </td>
                                                        <?php } else { ?>
                                                                <td class="dataTables" valign="top">
                                                                    <a href="admin/<?php echo $lang_id; ?>/front_blocks_list/delete/cbp/<?php echo $set_data['cbp_id']; ?>"
                                                                       onclick="return confirm_box('Are you sure you want to remove This block?');"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                                </td>
                                                            <?php } ?>
                                                            
                                                    <?php } ?>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /default datatable -->


                        <!-- Pickers -->
                    </div>

                    <!-- /pickers -->

                </div>
                <!-- /content container -->

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function confirm_box(msg) {
        var answer = confirm(msg);
        if (!answer)
            return false;
    }

    $(document).ready(function () {
        $("#delete_all_blocks").click(function () {
            if ($("#delete_all_blocks").is(':checked')) {
                $(".blocks").prop('checked', true);
            } else {
                $(".blocks").prop('checked', false);
            }
        });
        $("#delete_checked").click(function () {
            if ($('input.blocks:checkbox:checked').length) {
                var msg = "<?php echo $admin_static_links['are_you_sure_want_to_delete_all']['front']; ?>";
                var answer = confirm(msg);
                if (answer) {
                    var blocksarray = [];
                    $('input.blocks:checkbox:checked').each(function () {
                        blocksarray.push($(this).val());
                        $(this).parents('tr').hide();
                    });

                    var url = "admin/<?php echo $lang_id; ?>/front_blocks_list/blocksDeleteAll";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {'block_ids': blocksarray},

                        success: function (data) {
                        }
                    });

                }
            } else {
                alert("<?php echo $admin_static_links['please_select_alteast_one_item']['front']; ?>");
            }

        });

    });
</script>
