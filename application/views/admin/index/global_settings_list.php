<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="content zerorightmargin">
    <?php if ($this->session->flashdata('success')) {
        $msg = $this->session->flashdata('success'); ?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?>
            </div>
        </div>
    <?php } ?>

    <div id="show_class" class="note displaynon"></div>
    <div id="result" class="displaynon"></div>
    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <div class="body">
                    <form id="settingsForm" name="settingsForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="operation" value="set" />

                        <div class="container">
                            <div class="block well margintop-30px">
                                <div class="navbar">
                                    <div class="navbar-inner">
                                        <h5> <?php echo $admin_sidebar['global_settings_menu']['admin']; ?> </h5>
                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_sidebar['global_settings_menu']['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/global_settings_menu'; ?>">
                                        <?php } ?>
                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_pages/pages_main_text/admin" class="fancybox multi_language_common_edit admin_globe">
                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                        </a>
                                    </div>
                                </div>

                                <div class="table-overflow">
                                    <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                        <table aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">
                                            <thead>
                                                <tr role="row">
                                                    <th>
                                                        <label class="control-label"><?php echo $admin_pages['srno']['admin']; ?></label>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_pages['srno']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_pages/srno'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_pages/srno/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>
                                                    </th>

                                                    <th>
                                                        <label class="control-label"><?php echo $admin_pages['setting_type']['admin']; ?></label>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_pages['setting_type']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_pages/setting_type'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_pages/setting_type/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>
                                                    </th>

                                                    <th>
                                                        <label class="control-label"><?php echo $admin_pages['setting_name']['admin']; ?></label>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_pages['setting_name']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_pages/setting_name'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_pages/setting_name/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>
                                                    </th>

                                                    <th>
                                                        <label class="control-label"><?php echo $admin_pages['setting_value']['admin']; ?></label>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_pages['setting_value']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_pages/setting_value'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_pages/setting_value/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>
                                                    </th>

                                                    <th>
                                                        <label class="control-label"><?php echo $admin_pages['createdDate']['admin']; ?></label>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_pages['createdDate']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_pages/createdDate'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_pages/createdDate/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>
                                                    </th>

                                                    <th>
                                                        <label class="control-label"><?php echo $admin_pages['updatedDate']['admin']; ?></label>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_pages['updatedDate']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_pages/updatedDate'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_pages/updatedDate/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody aria-relevant="all" aria-live="polite" role="alert">
                                                <?php if (empty($all_data)) { ?>
                                                    <tr class="odd">
                                                        <td class="dataTables" valign="top" colspan="9"><?php echo $admin_static_links['no_data_available']['front']; ?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php
                                                if (isset($offset)) {
                                                    $i = $offset + 1;
                                                } else {
                                                    $i = 1;
                                                }

                                                if (isset($all_data)) {
							foreach ($all_data as $set_data) { ?>
							<?php if ($set_data['setting_name'] == 'hide_po_file' || $set_data['setting_name'] == 'hide_po_number'){continue;}?>
                                                        <tr class="odd">
                                                            <td class="dataTables" valign="top"> <?php echo $i; ?> </td>
                                                            <td class="dataTables" valign="top"> <?php echo ucwords(str_replace('_', ' ', $set_data['setting_type'])); ?> </td>
                                                            <td class="dataTables" valign="top"> <?php echo ucwords(str_replace('_', ' ', $set_data['setting_name'])); ?> </td>
                                                            <td class="dataTables" valign="top">
                                                                <?php if ($set_data['setting_name'] == 'entry_door_verification_on_checkout') { ?>
                                                                    <span class="on_checkout_value">
                                                                        <?= $set_data['setting_value'] == 1 ? $admin_front_entry_door_verification['front_entry_door_verification_on']['admin'] : $admin_front_entry_door_verification['front_entry_door_verification_off']['admin']; ?>
                                                                        <i class="fa fa-pencil edit_settings" data-parent="on_checkout" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                    </span>
                                                                    <div class="displaynon on_checkout">
                                                                        <select class="form-control on_checkout_field" name="entry_door_verification_on_checkout" disabled>
                                                                            <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?= $admin_front_entry_door_verification['front_entry_door_verification_on']['admin']; ?></option>
                                                                            <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?= $admin_front_entry_door_verification['front_entry_door_verification_off']['admin']; ?></option>
                                                                        </select>
                                                                        <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                        <span class="close_edit" data-parent="on_checkout" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                    </div>
                                                                <?php } else if ($set_data['setting_name'] == 'payment_mode') { ?>
                                                                    <span class="payment_mode_value">
                                                                        <?= $set_data['setting_value'] == 1 ? $api_instruction['payment_mode_live']['admin'] : $api_instruction['payment_mode_test']['admin']; ?>
                                                                        <i class="fa fa-pencil edit_settings" data-parent="payment_mode" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                    </span>
                                                                    <div class="displaynon payment_mode">
                                                                        <select class="form-control payment_mode_field" name="payment_mode" disabled>
                                                                            <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $api_instruction['payment_mode_live']['admin']; ?></option>
                                                                            <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $api_instruction['payment_mode_test']['admin']; ?></option>
                                                                        </select>
                                                                        <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                        <span class="close_edit" data-parent="payment_mode" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                    <?php } else if ($set_data['setting_name'] == 'shipping_mode') { ?>
                                                                        <span class="shipping_mode_value">
                                                                            <?= $set_data['setting_value'] == 1 ? $api_instruction['shipping_mode_live']['front'] : $api_instruction['shipping_mode_test']['front']; ?>
                                                                            <i class="fa fa-pencil edit_settings" data-parent="shipping_mode" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                        </span>
                                                                        <div class="displaynon shipping_mode">
                                                                            <select class="form-control shipping_mode_field" name="shipping_mode" disabled>
                                                                                <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?php echo $api_instruction['shipping_mode_live']['front']; ?></option>
                                                                                <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?php echo $api_instruction['shipping_mode_test']['front']; ?></option>
                                                                            </select>
                                                                            <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                            <span class="close_edit" data-parent="shipping_mode" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                        <?php } else if ($set_data['setting_name'] == 'product_name_animation_text') { ?>
                                                                            <span class="animation_box_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="animation_box" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon animation_box">
                                                                                <select class="form-control animation_box_field" name="product_name_animation_text" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="animation_box" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php } else if ($set_data['setting_name'] == 'guestotp_verification') { ?>
                                                                            <span class="guestotp_verification_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'No' : 'Yes'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="guestotp_verification" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon guestotp_verification">
                                                                                <select class="form-control guestotp_verification_field" name="guestotp_verification" disabled>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="guestotp_verification" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>

                                                                        <?php } else if ($set_data['setting_name'] == 'volume_unit') { ?>
                                                                            <span class="volume_unit_value">
                                                                                <?php echo $set_data['setting_value']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="volume_unit" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon volume_unit">

                                                                                <select class="form-control volume_unit_field" name="volume_unit" disabled>
                                                                                    <option value="INCH" <?php if ($set_data['setting_value'] == "INCH") {
                                                                                                                echo 'selected';
                                                                                                            } ?>>INCH</option>
                                                                                    <option value="CM" <?php if ($set_data['setting_value'] == "CM") {
                                                                                                            echo 'selected';
                                                                                                        } ?>>CM</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="volume_unit" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>

                                                                        <?php } else if ($set_data['setting_name'] == 'weight_unit') { ?>
                                                                            <span class="weight_unit_value">
                                                                                <?php echo $set_data['setting_value']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="weight_unit" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon weight_unit">
                                                                                <select class="form-control weight_unit_field" name="weight_unit" disabled>
                                                                                    <option value="LB" <?php if ($set_data['setting_value'] == "LB") {
                                                                                                            echo 'selected';
                                                                                                        } ?>>LB</option>
                                                                                    <option value="KG" <?php if ($set_data['setting_value'] == "KG") {
                                                                                                            echo 'selected';
                                                                                                        } ?>>KG</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="weight_unit" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>

                                                                        <?php } else if ($set_data['setting_name'] == 'quotation_daylimit') { ?>
                                                                            <span class="quotation_daylimit_value">
                                                                                <?php echo $set_data['setting_value']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="quotation_daylimit" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon quotation_daylimit">
                                                                                <input class="form-control quotation_daylimit_field" value="<?php echo $set_data['setting_value']; ?>" name="quotation_daylimit" type="text" disabled>

                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="quotation_daylimit" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>

                                                                        <?php } else if ($set_data['setting_name'] == 'product_quantity') { ?>
                                                                            <span class="product_quantity_value">
                                                                                <?php echo $set_data['setting_value']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="product_quantity" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon product_quantity">
                                                                                <input class="form-control product_quantity_field" value="<?php echo $set_data['setting_value']; ?>" name="product_quantity" type="text" disabled>

                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="product_quantity" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>

                                                                        <?php } else if ($set_data['setting_name'] == 'pagination_limit') { ?>
                                                                            <span class="pagination_limit_value">
                                                                                <?php echo $set_data['setting_value']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="pagination_limit" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon pagination_limit">
                                                                                <input class="form-control pagination_limit_field" value="<?php echo $set_data['setting_value']; ?>" name="pagination_limit" type="text" disabled>

                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="pagination_limit" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>

                                                                        <?php }  else if ($set_data['setting_name'] == 'pagination_limit_product_list') { ?>
                                                                            <span class="pagination_limit_product_list_value">
                                                                                <?php echo $set_data['setting_value']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="pagination_limit_product_list" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon pagination_limit_product_list">
                                                                                <input class="form-control pagination_limit_product_list_field" value="<?php echo $set_data['setting_value']; ?>" name="pagination_limit_product_list" type="text" disabled>

                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="pagination_limit_product_list" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>

                                                                        <?php }  else if ($set_data['setting_name'] == 'pagination_limit_product_list_frist_page') { ?>
                                                                            <span class="pagination_limit_product_list_frist_page_value">
                                                                                <?php echo $set_data['setting_value']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="pagination_limit_product_list_frist_page" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon pagination_limit_product_list_frist_page">
                                                                                <input class="form-control pagination_limit_product_list_frist_page_field" value="<?php echo $set_data['setting_value']; ?>" name="pagination_limit_product_list_frist_page" type="text" disabled>

                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="pagination_limit_product_list_frist_page" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>

                                                                        <?php } else if ($set_data['setting_name'] == 'product_minimumquantity') { ?>
                                                                            <span class="product_minimumquantity_value">
                                                                                <?php echo $set_data['setting_value']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="product_minimumquantity" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon product_minimumquantity">
                                                                                <input class="form-control product_minimumquantity_field" value="<?php echo $set_data['setting_value']; ?>" name="product_minimumquantity" type="text" disabled>

                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="product_minimumquantity" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>

                                                                        <?php } else if ($set_data['setting_name'] == 'product_group_minimum_price_show_to_guest_user') { ?>
                                                                            <span class="productgroup_minimum_value">
                                                                                <?= $set_data['setting_value'] == 1 ? $admin_front_entry_door_verification['front_entry_door_verification_on']['admin'] : $admin_front_entry_door_verification['front_entry_door_verification_off']['admin']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="productgroup_minimum" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon productgroup_minimum">
                                                                                <select class="form-control productgroup_minimum_field" name="product_group_minimum_price_show_to_guest_user" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?= $admin_front_entry_door_verification['front_entry_door_verification_on']['admin']; ?></option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?= $admin_front_entry_door_verification['front_entry_door_verification_off']['admin']; ?></option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="productgroup_minimum" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php } else if ($set_data['setting_name'] == 'product_group_minimum_price_show_to_all_users') { ?>
                                                                            <span class="productgroup_minimum_logged_value">
                                                                                <?= $set_data['setting_value'] == 1 ? $admin_front_entry_door_verification['front_entry_door_verification_on']['admin'] : $admin_front_entry_door_verification['front_entry_door_verification_off']['admin']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="productgroup_minimum_logged" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon productgroup_minimum_logged">
                                                                                <select class="form-control productgroup_minimum_logged_field" name="product_group_minimum_price_show_to_all_users" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?= $admin_front_entry_door_verification['front_entry_door_verification_on']['admin']; ?></option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?= $admin_front_entry_door_verification['front_entry_door_verification_off']['admin']; ?></option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="productgroup_minimum_logged" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php } else if ($set_data['setting_name'] == 'product_list_show_to_guest_user') { ?>
                                                                            <span class="productlist_guest_value">
                                                                                <?= $set_data['setting_value'] == 1 ? $admin_front_entry_door_verification['front_entry_door_verification_on']['admin'] : $admin_front_entry_door_verification['front_entry_door_verification_off']['admin']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="productlist_guest" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon productlist_guest">
                                                                                <select class="form-control productlist_guest_field" name="product_list_show_to_guest_user" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?= $admin_front_entry_door_verification['front_entry_door_verification_on']['admin']; ?></option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?= $admin_front_entry_door_verification['front_entry_door_verification_off']['admin']; ?></option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="productlist_guest" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php } else if ($set_data['setting_name'] == 'store_country') { ?>
                                                                            <span class="store_country_value">
                                                                                <?php
                                                                                $store_cont = '';

                                                                                if (isset($set_data['setting_value'])) {
                                                                                    $index = array_search($set_data['setting_value'], array_column($countries, 'country_code'));
                                                                                    $store_cont = $countries[$index]['countryName'];
                                                                                }

                                                                                echo $store_cont; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="store_country" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon store_country">
                                                                                <?php $user_country = isset($set_data['setting_value']) ? $set_data['setting_value'] : ''; ?>
                                                                                <select class="form-control store_country_field" name="store_country" disabled>
                                                                                    <?php foreach ($countries as $country) { ?>
                                                                                        <option value='<?php echo $country['country_code']; ?>' <?php if (isset($user_country) && $user_country != '' && $user_country == $country['country_code']) { ?>selected="selected" <?php } ?>> <?php echo $country['countryName']; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="store_country" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>

                                                                        <?php } else if ($set_data['setting_name'] == 'tax_applicable') { ?>
                                                                            <span class="animation_box_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="animation_box" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon animation_box">
                                                                                <select class="form-control animation_box_field" name="tax_applicable" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="animation_box" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php }  else if ($set_data['setting_name'] == 'hide_industry') { ?>
                                                                            <span class="animation_box_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="animation_box" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon animation_box">
                                                                                <select class="form-control animation_box_field" name="hide_industry" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="animation_box" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php } else if ($set_data['setting_name'] == 'hide_decision_popup') { ?>
                                                                            <span class="hide_decision_popup_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="hide_decision_popup" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon hide_decision_popup">
                                                                                <select class="form-control hide_decision_popup_field" name="hide_decision_popup" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="hide_decision_popup" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php }else if ($set_data['setting_name'] == 'show_coookie_concent') { ?>
                                                                            <span class="show_coookie_concent_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="show_coookie_concent" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon show_coookie_concent">
                                                                                <select class="form-control show_coookie_concent_field" name="show_coookie_concent" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="show_coookie_concent" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php } else if ($set_data['setting_name'] == 'hide_product_list') { ?>
                                                                            <span class="hide_product_list_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="hide_product_list" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon hide_product_list">
                                                                                <select class="form-control hide_product_list_field" name="hide_product_list" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="hide_product_list" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                            
                                                                        <!-- Starting of multiselect option disable -->
                                                                        <?php } else  if ($set_data['setting_name'] == 'disable_multiselect') { ?>
                                                                            <span class="disable_multiselect_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="disable_multiselect" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon disable_multiselect">
                                                                                <select class="form-control disable_multiselect_field" name="disable_multiselect" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="disable_multiselect" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>                                                        
                                                                        <!-- Ending of multiselect oopotion disbale -->
                                                                        <?php } else  if ($set_data['setting_name'] == 'auto_show_collapse_bar') { ?>
                                                                            <span class="auto_show_collapse_bar_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="auto_show_collapse_bar" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon auto_show_collapse_bar">
                                                                                <select class="form-control auto_show_collapse_bar_field" name="auto_show_collapse_bar" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="auto_show_collapse_bar" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
									    </div>
									<?php } else  if ($set_data['setting_name'] == 'show_collapse_bar') { ?>
                                                                            <span class="show_collapse_bar_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="show_collapse_bar" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon show_collapse_bar">
                                                                                <select class="form-control show_collapse_bar_field" name="show_collapse_bar" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="show_related_products" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                        </div> 
                                                                        <?php } else  if ($set_data['setting_name'] == 'show_related_products') { ?>
                                                                            <span class="show_related_products_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="show_related_products" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon show_related_products">
                                                                                <select class="form-control show_related_products_field" name="show_related_products" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="show_related_products" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                        </div> 
                                                                        <?php } else if ($set_data['setting_name'] == 'no_of_related_products') { ?>
                                                                            <span class="no_of_related_products_value">
                                                                                <?php echo $set_data['setting_value']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="no_of_related_products" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon no_of_related_products">
                                                                                <input class="form-control no_of_related_products_field" value="<?php echo $set_data['setting_value']; ?>" name="no_of_related_products" type="text" disabled>

                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="no_of_related_products" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                        </div> 
                                                                        <!-- Starting of enable/disable of cart form -->
                                                                        <?php } else  if ($set_data['setting_name'] == 'enable_po_no') { ?>
                                                                            <span class="enable_po_no_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="enable_po_no" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon enable_po_no">
                                                                                <select class="form-control enable_po_no_field" name="enable_po_no">
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="enable_po_no" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div> 
                                                                        
                                                                        <?php } else  if ($set_data['setting_name'] == 'enable_po_file') { ?>
                                                                            <span class="enable_po_file_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="enable_po_file" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon enable_po_file">
                                                                                <select class="form-control enable_po_file_field" name="enable_po_file">
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="enable_po_file" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div> 
                                                                        
                                                                            <?php } else  if ($set_data['setting_name'] == 'enable_company_logo') { ?>
                                                                            <span class="enable_company_logo_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="enable_company_logo" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon enable_company_logo">
                                                                                <select class="form-control enable_company_logo_field" name="enable_company_logo">
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="enable_company_logo" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                            
                                                                            <?php } else  if ($set_data['setting_name'] == 'enable_quotation_no') { ?>
                                                                            <span class="enable_quotation_no_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="enable_quotation_no" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon enable_quotation_no">
                                                                                <select class="form-control enable_quotation_no_field" name="enable_quotation_no">
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="enable_quotation_no" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div> 
                                                                        
                                                                            <?php } else  if ($set_data['setting_name'] == 'enable_freight_mode') { ?>
                                                                            <span class="enable_freight_mode_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="enable_freight_mode" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon enable_freight_mode">
                                                                                <select class="form-control enable_freight_mode_field" name="enable_freight_mode">
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="enable_freight_mode" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div> 
										
									    <?php } else  if ($set_data['setting_name'] == 'enable_shipping_method') { ?>
                                                                            <span class="enable_shipping_method_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="enable_shipping_method" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon enable_shipping_method">
                                                                                <select class="form-control enable_shipping_method_field" name="enable_shipping_method">
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="enable_shipping_method" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div> 
                                                                            <?php } else  if ($set_data['setting_name'] == 'enable_incoterms_content') { ?>
                                                                            <span class="enable_incoterms_content_value">
                                                                                <?= $set_data['setting_value'] == 0 ? 'None' : ($set_data['setting_value'] == 1 ? 'EXW': ($set_data['setting_value'] == 2 ? 'DDP':'Both')); ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="enable_incoterms_content" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon enable_incoterms_content">
                                                                                <select class="form-control enable_incoterms_content_field" name="enable_incoterms_content">
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>None</option>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>EXW</option>
                                                                                    <option value="2" <?php if ($set_data['setting_value'] == 2) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>DPP</option>
                                                                                    <option value="3" <?php if ($set_data['setting_value'] == 3) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Both</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="enable_incoterms_content" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div> 
                                                                            <?php } else  if ($set_data['setting_name'] == 'show_mandatory_notes') { ?>
                                                                            <span class="shipping_method_optional_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Show' : 'Hide'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="show_mandatory_notes" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon show_mandatory_notes">
                                                                                <select class="form-control show_mandatory_notes_field" name="show_mandatory_notes">
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Show</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Hide</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="show_mandatory_notes" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                            <?php } else  if ($set_data['setting_name'] == 'shipping_method_optional') { ?>
                                                                            <span class="shipping_method_optional_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="shipping_method_optional" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon shipping_method_optional">
                                                                                <select class="form-control shipping_method_optional_field" name="shipping_method_optional">
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="shipping_method_optional" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div> 

                                                                            <?php } else  if ($set_data['setting_name'] == 'enable_tax_ex_code') { ?>
                                                                            <span class="enable_tax_ex_code_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="enable_tax_ex_code" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon enable_tax_ex_code">
                                                                                <select class="form-control enable_tax_ex_code_field" name="enable_tax_ex_code">
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="enable_tax_ex_code" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>

                                                                            <?php } else  if ($set_data['setting_name'] == 'enable_discount_code') { ?>
                                                                            <span class="enable_discount_code_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="enable_discount_code" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon enable_discount_code">
                                                                                <select class="form-control enable_discount_code_field" name="enable_discount_code">
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="enable_discount_code" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <!-- Ending of enable/disable of cart form -->

                                                                        <?php } else if ($set_data['setting_name'] == 'show_search_radio') { ?>
                                                                            <span class="show_search_radio_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="show_search_radio" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon show_search_radio">
                                                                                <select class="form-control show_search_radio_field" name="show_search_radio" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="show_search_radio" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php } else if ($set_data['setting_name'] == 'show_products_input') { ?>
                                                                            <span class="show_products_input_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="show_products_input" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon show_products_input">
                                                                                <select class="form-control show_products_input_field" name="show_products_input" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="show_products_input" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php } else if ($set_data['setting_name'] == 'enable_distributor_feature') { ?>
                                                                            <span class="enable_distributor_feature_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="enable_distributor_feature" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon enable_distributor_feature">
                                                                                <select class="form-control enable_distributor_feature_field" name="enable_distributor_feature" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="enable_distributor_feature" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php } else if ($set_data['setting_name'] == 'hide_po_number') { ?>
                                                                            <span class="hide_po_number_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="hide_po_number" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon hide_po_number">
                                                                                <select class="form-control hide_po_number_field" name="hide_po_number" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="hide_po_number" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php } else if ($set_data['setting_name'] == 'show_searchbyproduct_price_to_guest_user') { ?>
                                                                            <span class="show_searchbyproduct_price_to_guest_user_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="show_searchbyproduct_price_to_guest_user" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon show_searchbyproduct_price_to_guest_user">
                                                                                <select class="form-control show_searchbyproduct_price_to_guest_user_field" name="show_searchbyproduct_price_to_guest_user" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="show_searchbyproduct_price_to_guest_user" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php } else if ($set_data['setting_name'] == 'show_dropdown_in_search_pages') { ?>
                                                                            <span class="show_dropdown_in_search_pages_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="show_dropdown_in_search_pages" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon show_dropdown_in_search_pages">
                                                                                <select class="form-control show_dropdown_in_search_pages_field" name="show_dropdown_in_search_pages" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="show_dropdown_in_search_pages" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php } else if ($set_data['setting_name'] == 'partial_payment_enable') { ?>
                                                                            <span class="partial_payment_enable_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="partial_payment_enable" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon partial_payment_enable">
                                                                                <select class="form-control partial_payment_enable_field" name="partial_payment_enable" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="partial_payment_enable" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php } else if ($set_data['setting_name'] == 'show_quicksearch_label') { ?>
                                                                            <span class="show_quicksearch_label_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="show_quicksearch_label" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon show_quicksearch_label">
                                                                                <select class="form-control show_quicksearch_label_field" name="show_quicksearch_label" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="show_quicksearch_label" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php } else if ($set_data['setting_name'] == 'show_dropdown_description') { ?>
                                                                            <span class="show_dropdown_description_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="show_dropdown_description" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon show_dropdown_description">
                                                                                <select class="form-control show_dropdown_description_field" name="show_dropdown_description" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="show_dropdown_description" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php }else if ($set_data['setting_name'] == 'products_without_images_on_productpage') { ?>
                                                                            <span class="products_without_images_on_productpage_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="products_without_images_on_productpage" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon products_without_images_on_productpage">
                                                                                <select class="form-control products_without_images_on_productpage_field" name="products_without_images_on_productpage" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="products_without_images_on_productpage" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php } else if ($set_data['setting_name'] == 'limited_price_option') { ?>
                                                                            <span class="limited_price_option_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="limited_price_option" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon limited_price_option">
                                                                                <select class="form-control limited_price_option_field" name="limited_price_option" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="limited_price_option" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php } else if ($set_data['setting_name'] == 'partial_payment_percentage') { ?>
                                                                            <span class="partial_payment_percentage_value">
                                                                                <?php echo $set_data['setting_value']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="partial_payment_percentage" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon partial_payment_percentage">
                                                                                <input class="form-control partial_payment_percentage_field" value="<?php echo $set_data['setting_value']; ?>" name="partial_payment_percentage" type="text" disabled>

                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="partial_payment_percentage" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>

                                                                        <?php }  else if ($set_data['setting_name'] == 'price_request_expire_days') { ?>
                                                                            <span class="price_request_expire_days_value">
                                                                                <?php echo $set_data['setting_value']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="price_request_expire_days" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon price_request_expire_days">
                                                                                <input class="form-control price_request_expire_days_field" value="<?php echo $set_data['setting_value']; ?>" name="price_request_expire_days" type="text" disabled>

                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="price_request_expire_days" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
									    </div>
									<?php } else if ($set_data['setting_name'] == 'sub_menu_top_value') { ?>
                                                                            <span class="sub_menu_top_value_value">
                                                                                <?php echo $set_data['setting_value']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="sub_menu_top_value" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon sub_menu_top_value">
                                                                                <input class="form-control sub_menu_top_value_field" value="<?php echo $set_data['setting_value']; ?>" name="sub_menu_top_value" type="text" disabled>

                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="sub_menu_top_value" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
									<?php }  else if ($set_data['setting_name'] == 'open_exchange_rate_api_key') { ?>
                                                                            <span class="open_exchange_rate_api_key_value">
                                                                                <?php echo $set_data['setting_value']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="open_exchange_rate_api_key" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon open_exchange_rate_api_key">
                                                                                <input class="form-control open_exchange_rate_api_key" value="<?php echo $set_data['setting_value']; ?>" name="open_exchange_rate_api_key" type="text">

                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="open_exchange_rate_api_key" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
									    </div>

									<?php }  else if ($set_data['setting_name'] == 'shipper_tax_vat_id') { ?>
                                                                            <span class="shipper_tax_vat_id_value">
                                                                                <?php echo $set_data['setting_value']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="shipper_tax_vat_id" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon shipper_tax_vat_id">
                                                                                <input class="form-control shipper_tax_vat_id" value="<?php echo $set_data['setting_value']; ?>" name="shipper_tax_vat_id" type="text">

                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="shipper_tax_vat_id" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>

                                                                        <?php } else if ($set_data['setting_name'] == 'default_currency_code') { ?>
                                                                            <span class="default_currency_code_value">
                                                                                <?= $set_data['setting_value']; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="default_currency_code" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon default_currency_code">
                                                                                <select class="form-control default_currency_code_field" name="default_currency_code" disabled>
                                                                                    <option value="INR" <?php if ($set_data['setting_value'] == "INR") {
                                                                                                            echo 'selected';
                                                                                                        } ?>>INR</option>
                                                                                    <option value="EUR" <?php if ($set_data['setting_value'] == "EUR") {
                                                                                                            echo 'selected';
                                                                                                        } ?>>EUR</option>
                                                                                    <option value="TND" <?php if ($set_data['setting_value'] == "TND") {
                                                                                    echo 'selected';
                                                                                    } ?>>TND</option>
                                                                                    <option value="CAD" <?php if ($set_data['setting_value'] == "CAD") {
                                                                                    echo 'selected';
                                                                                    } ?>>CAD</option>
                                                                                    <option value="USD" <?php if ($set_data['setting_value'] == "USD") {
                                                                                    echo 'selected';
										    } ?>>USD</option>
								                    <option value="AED" <?php if ($set_data['setting_value'] == "AED") {
                                                                                    echo 'selected';
                                                                                    } ?>>AED</option>

                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="default_currency_code" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
									    </div>
									<?php } else  if ($set_data['setting_name'] == 'enable_banner') { ?>
                                                                            <span class="enable_banner_value">
                                                                                <?= $set_data['setting_value'] == 1 ? 'Yes' : 'No'; ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="enable_banner" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon enable_banner">
                                                                                <select class="form-control enable_banner_field" name="enable_banner">
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>Yes</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>No</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="enable_banner" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div> 
									<?php } else if ($set_data['setting_name'] == 'menu_theme_settings') { ?>
                                                                            <span class="menu_theme_settings_value">
                                                                                <?= $set_data['setting_value'] ?>
                                                                                <i class="fa fa-pencil edit_settings" data-parent="menu_theme_settings" style="font-size:20px;color:#8263cd;cursor: pointer;"></i>
                                                                            </span>
                                                                            <div class="displaynon menu_theme_settings">
                                                                                <select class="form-control menu_theme_settings_field" name="menu_theme_settings" disabled>
                                                                                    <option value="1" <?php if ($set_data['setting_value'] == 1) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>1</option>
                                                                                    <option value="0" <?php if ($set_data['setting_value'] == 0) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>0</option>
                                                                                </select>
                                                                                <span onClick="$('.save_settings').trigger('click');" title="save"><i class="fa fa-save" style="font-size:20px;color:green;cursor: pointer;"></i></span>
                                                                                <span class="close_edit" data-parent="menu_theme_settings" title="close"><i class="fa fa-close" style="font-size:20px;color:red;cursor: pointer;"></i></span>
                                                                            </div>
                                                                        <?php } else {
                                                                        echo $set_data['setting_value'];
                                                                         
                                                                    } ?>
         
         
         
         
         
         
         
                                                            </td>
                                                            <td class="dataTables" valign="top"> <?php echo $set_data['createdDate']; ?> </td>
                                                            <td class="dataTables" valign="top"> <?php echo $set_data['updatedDate']; ?> </td>
                                                        </tr>
                                                <?php $i++;
                                                    }
                                                } ?>

                                                <tr>
                                                    <td colspan="17">
                                                        <?php if (isset($links)) { ?>
                                                            <p class="floatright"><?php echo $links; ?></p>
                                                        <?php } ?>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="save_settings" style="display: none;"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on('click', '.edit_settings', function() {
        var parent = $(this).attr('data-parent');
        $('.' + parent + '_value').hide();
        $('.' + parent).removeClass('displaynon');
        $('.' + parent + '_field').removeAttr('disabled');
    });

    $(document).on('click', '.close_edit', function() {
        var parent = $(this).attr('data-parent');
        $('.' + parent + '_value').show();
        $('.' + parent).addClass('displaynon');
        $('.' + parent + '_field').attr('disabled', 'true');
    });
</script>
