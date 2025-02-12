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
                <h5>
                    <?php echo $section_data['selection_instruction']['admin']; ?>
                </h5>
                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                <input type="text" value="<?php echo $section_data['selection_instruction']['admin']; ?>" class="edit_input_text"  style="display: none;">
                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/selection_instruction'; ?>">
                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/selection_instruction/admin" class="fancybox multi_language_common_edit admin_globe">
                    <img src="assets/uploads/global.jpg" height="20" width="20">
                </a>
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
                                                <h5>
                                                    <?php echo $section_data['product_page']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['product_page']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/product_page'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/product_page/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['product_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['product_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/product_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/product_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea name="selection_instruction[product_msg]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['product_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/product_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('product_msg'); ?></span>
                                        </div>
                                    </div>

                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $section_data['product_page_guest']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['product_page_guest']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/product_page_guest'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/product_page_guest/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['products_guest_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['products_guest_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/products_guest_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/products_guest_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea name="selection_instruction[products_guest_warning]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo $section_data['products_guest_warning']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/products_guest_warning/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('products_guest_warning'); ?></span>
                                        </div>
                                    </div>


                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $section_data['product_type_page']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['product_type_page']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/product_type_page'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/product_type_page/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['product_type_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['product_type_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/product_type_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/product_type_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea name="selection_instruction[product_type_msg]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['product_type_msg']['front'])) echo $section_data['product_type_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/product_type_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('product_type_msg'); ?></span>
                                        </div>

                                    </div>
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $section_data['vehicle_type_page']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['vehicle_type_page']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/vehicle_type_page'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/vehicle_type_page/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['vehicle_type_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['vehicle_type_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/vehicle_type_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/vehicle_type_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea name="selection_instruction[vehicle_type_msg]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['vehicle_type_msg']['front'])) echo $section_data['vehicle_type_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/vehicle_type_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('vehicle_type_msg'); ?></span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $section_data['product_brand_page']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['product_brand_page']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/product_brand_page'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/product_brand_page/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['product_brand_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['product_brand_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/product_brand_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/product_brand_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea name="selection_instruction[product_brand_msg]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['product_brand_msg']['front'])) echo $section_data['product_brand_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/product_brand_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('product_brand_msg'); ?></span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $section_data['product_list_page']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['product_list_page']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/product_list_page'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/product_list_page/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['product_list_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['product_list_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/product_list_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/product_list_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea name="selection_instruction[product_list_msg]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['product_list_msg']['front'])) echo $section_data['product_list_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/product_list_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('product_list_msg'); ?></span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $section_data['selection_popup']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['selection_popup']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/selection_popup'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/selection_popup/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['selection_popup_header']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['selection_popup_header']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/selection_popup_header'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/selection_popup_header/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><input name="selection_instruction[selection_popup_header]"
                                                                         class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text"
                                                                         value="<?php if (isset($section_data['selection_popup_header']['front'])) echo $section_data['selection_popup_header']['front']; ?>"/>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/selection_popup_header/front" class="fancybox multi_language_common_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('selection_popup_header'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['selection_popup_body']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['selection_popup_body']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/selection_popup_body'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/selection_popup_body/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea name="selection_instruction[selection_popup_body]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['selection_popup_body']['front'])) echo $section_data['selection_popup_body']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/selection_popup_body/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('selection_popup_body'); ?></span>
                                        </div>
                                    </div>

                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $section_data['addtocart_popup']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['addtocart_popup']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/addtocart_popup'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/addtocart_popup/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['addtocart_popup_header']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['addtocart_popup_header']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/addtocart_popup_header'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/addtocart_popup_header/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea name="selection_instruction[addtocart_popup_header]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['addtocart_popup_header']['front'])) echo $section_data['addtocart_popup_header']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/addtocart_popup_header/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('already_exist_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['already_exist_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['already_exist_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/already_exist_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/already_exist_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea name="selection_instruction[already_exist_msg]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['already_exist_msg']['front'])) echo $section_data['already_exist_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/already_exist_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['already_exist_msg_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['already_exist_msg_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/already_exist_msg_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/already_exist_msg_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('already_exist_msg'); ?></span>
                                        </div>





                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['cart_limit_ignored']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['cart_limit_ignored']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cart_limit_ignored'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cart_limit_ignored/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea name="selection_instruction[cart_limit_ignored]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['cart_limit_ignored']['front'])) echo $section_data['cart_limit_ignored']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cart_limit_ignored/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['already_exist_msg_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['already_exist_msg_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/already_exist_msg_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/already_exist_msg_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('cart_limit_ignored'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['addtocart_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['addtocart_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/addtocart_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/addtocart_msg/admin" class="fancybox multi_language_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea name="selection_instruction[addtocart_msg]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['addtocart_msg']['front'])) echo $section_data['addtocart_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/addtocart_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['addtocart_msg_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['addtocart_msg_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/addtocart_msg_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/addtocart_msg_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('selection_popup_body'); ?></span>
                                        </div>
                                    </div>
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $section_data['cart_block_msg']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $section_data['cart_block_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cart_block_msg'; ?>">
                                                <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cart_block_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['maincart_block_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['maincart_block_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/maincart_block_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/maincart_block_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea name="selection_instruction[maincart_block_msg]" class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['maincart_block_msg']['front'])) echo $section_data['maincart_block_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/maincart_block_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['maincart_block_msg_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['maincart_block_msg_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/maincart_block_msg_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/maincart_block_msg_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('maincart_block_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['editcart_block_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['editcart_block_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/editcart_block_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/editcart_block_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea name="selection_instruction[editcart_block_msg]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['editcart_block_msg']['front'])) echo $section_data['editcart_block_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/editcart_block_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['editcart_block_msg_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['editcart_block_msg_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/editcart_block_msg_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/editcart_block_msg_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('editcart_block_msg'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['cartpreview_block_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['cartpreview_block_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cartpreview_block_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartpreview_block_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea name="selection_instruction[cartpreview_block_msg]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['cartpreview_block_msg']['front'])) echo $section_data['cartpreview_block_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartpreview_block_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>

                                            <span class="black1"><?php echo $section_data['cartpreview_block_msg_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['cartpreview_block_msg_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cartpreview_block_msg_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartpreview_block_msg_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('cartpreview_block_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['cartverification_block_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['cartverification_block_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cartverification_block_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_block_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <textarea name="selection_instruction[cartverification_block_msg]" class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['cartverification_block_msg']['front'])) echo $section_data['cartverification_block_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_block_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['cartverification_block_msg_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['cartverification_block_msg_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cartverification_block_msg_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_block_msg_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('cartverification_block_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['cartverification_resent_block_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['cartverification_resent_block_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cartverification_resent_block_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_resent_block_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea 
                                                                            name="selection_instruction[cartverification_resent_block_msg]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['cartverification_resent_block_msg']['front'])) echo $section_data['cartverification_resent_block_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_resent_block_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['cartverification_resent_block_msg_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['cartverification_resent_block_msg_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cartverification_resent_block_msg_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_resent_block_msg_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('cartverification_resent_block_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['cartverification_wrong_block_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['cartverification_wrong_block_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cartverification_wrong_block_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_wrong_block_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea 
                                                                            name="selection_instruction[cartverification_resent_block_msg_sms]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['cartverification_resent_block_msg_sms']['front'])) echo $section_data['cartverification_resent_block_msg_sms']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_resent_block_msg_sms/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['cartverification_resent_block_msg_sms_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['cartverification_resent_block_msg_sms_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cartverification_resent_block_msg_sms_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_resent_block_msg_sms_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('cartverification_resent_block_msg_sms'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['block_notification_msg']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['block_notification_msg']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/block_notification_msg'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/block_notification_msg/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea 
                                                                            name="selection_instruction[cartverification_resent_block_msg_email_sms]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['cartverification_resent_block_msg_email_sms']['front'])) echo $section_data['cartverification_resent_block_msg_email_sms']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_resent_block_msg_email_sms/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['cartverification_resent_block_msg_email_sms_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['cartverification_resent_block_msg_email_sms_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cartverification_resent_block_msg_email_sms_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_resent_block_msg_email_sms_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('cartverification_resent_block_msg_sms'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['cartverification_resent_block_msg_sms']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['cartverification_resent_block_msg_sms']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cartverification_resent_block_msg_sms'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_resent_block_msg_sms/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea 
                                                                            name="selection_instruction[cartverification_wrong_block_msg]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['cartverification_wrong_block_msg']['front'])) echo $section_data['cartverification_wrong_block_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_wrong_block_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['cartverification_wrong_block_msg_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['cartverification_wrong_block_msg_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cartverification_wrong_block_msg_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_wrong_block_msg_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('cartverification_wrong_block_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['cartverification_wrong_block_msg_sms']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['cartverification_wrong_block_msg_sms']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cartverification_wrong_block_msg_sms'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_wrong_block_msg_sms/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea 
                                                                            name="selection_instruction[cartverification_wrong_block_msg_sms]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['cartverification_wrong_block_msg_sms']['front'])) echo $section_data['cartverification_wrong_block_msg_sms']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_wrong_block_msg_sms/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['cartverification_wrong_block_msg_sms_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['cartverification_wrong_block_msg_sms_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cartverification_wrong_block_msg_sms_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_wrong_block_msg_sms_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('cartverification_wrong_block_msg_sms'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['block_notification_msg_sms']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['block_notification_msg_sms']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/block_notification_msg_sms'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/block_notification_msg_sms/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea 
                                                                            name="selection_instruction[cartverification_wrong_block_msg_email_sms]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['cartverification_wrong_block_msg_email_sms']['front'])) echo $section_data['cartverification_wrong_block_msg_email_sms']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_wrong_block_msg_email_sms/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['cartverification_wrong_block_msg_email_sms_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['cartverification_wrong_block_msg_email_sms_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cartverification_wrong_block_msg_email_sms_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_wrong_block_msg_email_sms_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('cartverification_wrong_block_msg_email_sms'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['cartverification_wrong_block_msg_email_sms']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['cartverification_wrong_block_msg_email_sms']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cartverification_wrong_block_msg_email_sms'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_wrong_block_msg_email_sms/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea name="selection_instruction[block_notification_msg]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['block_notification_msg']['front'])) echo $section_data['block_notification_msg']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/block_notification_msg/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['block_notification_msg_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['block_notification_msg_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/block_notification_msg_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/block_notification_msg_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('block_notification_msg'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['block_notification_msg_email_sms']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['block_notification_msg_email_sms']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/block_notification_msg_email_sms'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/block_notification_msg_email_sms/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea name="selection_instruction[block_notification_msg_sms]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['block_notification_msg_sms']['front'])) echo $section_data['block_notification_msg_sms']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/block_notification_msg_sms/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['block_notification_msg_sms_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['block_notification_msg_sms_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/block_notification_msg_sms_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/block_notification_msg_sms_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('block_notification_msg_sms'); ?></span>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $section_data['cartverification_resent_block_msg_email_sms']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $section_data['cartverification_resent_block_msg_email_sms']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/cartverification_resent_block_msg_email_sms'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/cartverification_resent_block_msg_email_sms/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls"><textarea name="selection_instruction[block_notification_msg_email_sms]"
                                                                            class="input-field focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php if (isset($section_data['block_notification_msg_email_sms']['front'])) echo $section_data['block_notification_msg_email_sms']['front']; ?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/block_notification_msg_email_sms/front/textarea" class="fancybox multi_language_common_textarea">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="black1"><?php echo $section_data['block_notification_msg_email_sms_note']['admin']; ?></span>
                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                            <textarea class="edit_input_text" rows="4" cols="175" style="display: none;"><?php echo $section_data['block_notification_msg_email_sms_note']['admin']; ?></textarea>
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/selection_instruction/block_notification_msg_email_sms_note'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/selection_instruction/block_notification_msg_email_sms_note/admin/textarea" class="fancybox multi_language_common_textarea admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <span class="red1"><?php echo form_error('block_notification_msg_email_sms'); ?></span>
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

<script type="text/javascript">
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
</script>