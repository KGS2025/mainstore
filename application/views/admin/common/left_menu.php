<?php echo $this->lang->line('');
$page_access   = $this->session->userdata('page_access');
$logoimage     = getAdminLogo();
$all_language_data = get_admin_lang_data(array('admin_sidebar'), $this->lang->default_lang_id);
$admin_sidebar = $all_language_data['admin_sidebar'];
?>

<!-- Left sidebar -->
<div class="sidebar" id="left-sidebar">
    <center class="d-flex"><a href="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/index/dashboard"><img src="<?php echo $logoimage; ?>" width="177" alt="LOGO"></a>
	<div class="toggle-button">
			<span></span>
			<span></span>
			<span></span>
		</div>
	
	</center>
    <?php $remaining_time = $admin_validuser_data['remaining_time']; ?>
    <ul class="block sidebar-links kgt12">
        <li>
            <div class="date-sec">
                <?php if (isset($remaining_time) && $remaining_time != '') { ?>
                    <div class="sep"></div>
                    <div id="usertimer" class="user-time"><?php echo ucwords($admin_validuser_data['title']) . ' ' . $admin_validuser_data['first_name'] . ' ' . $admin_validuser_data['last_name']; ?> <br /> ( <span></span> )</div>
                <?php } ?>
            </div>
        </li>
    </ul>

    <script>
        (function($) {
            $(document).ready(function() {
                $('.dropdown a').on('click', function(event) {
                    event.stopPropagation();
                    $(this).parent().toggleClass('open');
                    $(this).first().children('ul').toggleClass('in');
                });
            });
		})(jQuery);
    </script>
	<script>
			
			$(document).ready(function() {

                
					$(".toggle-button").click(function(){
						$(".navigation-wrap").toggleClass('in collapse');
					});
				
                 });
	</script>
	
	
    <!-- Simple nav -->
	<div class="navigation-wrap collapse" id="navbarToggleExternalContent">
    <ul class="navigation-light block">
        <nav id="column_left">
            <ul class="nav nav-list">
                <?php if (in_array('welcome_page', $page_access) || in_array('general_instruction', $page_access) || in_array('product_instruction', $page_access) || in_array('cart_instruction', $page_access) || in_array('form_validation_instruction', $page_access) || in_array('countries', $page_access) || in_array('page_title', $page_access) || in_array('sales_order_preview', $page_access) || in_array('payment_instructions', $page_access) || in_array('state_instructions', $page_access) || in_array('language', $page_access) || in_array('set_default_language', $page_access) || in_array('userblocked', $page_access) || in_array('front_blocks_list', $page_access) || in_array('product', $page_access) || in_array('product_type', $page_access) || in_array('makers', $page_access) || in_array('importdata', $page_access) || in_array('exportdata', $page_access) || in_array('industry_type', $page_access) || in_array('marketplace_export', $page_access) || in_array('product_model', $page_access) || in_array('vehicle_categories', $page_access) || in_array('product_items', $page_access) || in_array('product_natures', $page_access) || in_array('part_relation', $page_access) || in_array('cart_timer', $page_access) || in_array('entry_door_timer', $page_access) || in_array('contact_timer', $page_access) || in_array('entry_door_message', $page_access) || in_array('selection_instruction', $page_access) || in_array('cart', $page_access) || in_array('price_requests', $page_access) || in_array('users_front_entry_door', $page_access) || in_array('signup_instructions', $page_access) || in_array('conditional_pages', $page_access) || in_array('time_digits', $page_access) || in_array('signup_timer', $page_access) || in_array('signup_users_details', $page_access) || in_array('pages', $page_access)  || in_array('ups_api_setting', $page_access) || in_array('bambora_api_setting', $page_access) || in_array('api_instruction', $page_access) || in_array('package', $page_access) || in_array('global_settings', $page_access) || in_array('contact_user', $page_access) || in_array('contact_message', $page_access) || in_array('stripe_api_setting', $page_access) || in_array('payment_api_setting', $page_access) || in_array('shipping_markup_setting', $page_access) || in_array('navigation_setting', $page_access) || in_array('gallery', $page_access)|| in_array('banner_setting', $page_access) || in_array('social_media_setting', $page_access) || in_array('payment_accept_card_setting', $page_access) || in_array('whats_new_setting', $page_access) || in_array('aramex_error', $page_access)) { ?>
                    <li class="dropdown<?php if (isset($active) && ($active == 'selection_instruction' || $active == 'users_front_entry_door_list' || $active == 'entry_door_message' || $active == 'cart_timer' || $active == 'contact_timer' || $active == 'entry_door_timer' || $active == 'globe_product' || $active == 'welcome' || $active == 'userblocked' || $active == 'front_blocks_list' || $active == 'product' || $active == 'product_type' || $active == 'makers' || $active == 'importdata'  || $active == 'exportdata' || $active == 'industry_type' || $active == 'marketplace_export' || $active == 'product_model' || $active == 'vehicle_categories'  || $active == 'price_requests' || $active == 'cart' || $active == 'users') || $active == 'general_instruction' || $active == 'product_instruction' || $active == 'cart_instruction' || $active == 'form_validation_instruction' || $active == 'language' || $active == 'set_default_language' || $active == 'countries' || $active == 'page_title' || $active == 'product_items' || $active == 'product_natures' || $active == 'part_relation' || $active == 'sales_order_preview' || $active == 'payment_instructions' || $active == 'state_instructions' || $active == 'signup_instructions' || $active == 'conditional_pages' || $active == 'time_digits' || $active == 'aramex_error' || $active == 'signup_timer' || $active == 'signup_users_details' || $active == 'pages' || $active == 'ups_api_setting' || $active == 'bambora_api_setting' || $active == 'api_instruction' || $active == 'package' || $active == 'global_settings' || $active == 'contact_user' || $active == 'contact_message' || $active == 'stripe_api_setting' || $active == 'shipping_markup_setting' || $active == 'payment_api_setting' || $active == 'navigation_setting' || $active == 'gallery' || $active == 'banner_setting' || $active == 'social_media_setting'  || $active == 'payment_accept_card_setting' || $active == 'whats_new_setting'  || $active == 'credit_term_settings'  || $active == 'credit_term_list' || $active == 'refferaluser_list' || $active == 'discount_list' || $active == 'discountusers_list' || $active == 'store' || ($active == 'distributor' && $this->config->item('enable_distributor_feature') == "1")) echo ' open'; ?>">

						
                        <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#front">
                            <span class="nav-header-primary"><?php echo $admin_sidebar['front_end_section_management']['admin']; ?></span>


                            <span class="pull-right"><b class="caret"></b></span>
                        </a>
                        <?php if ($lang_id == $primary_lang) { ?>
                            <div class="edit_text" style="display: inline-block; float: unset; "></div>
                            <input type="text" value="<?php echo $admin_sidebar['front_end_section_management']['admin']; ?>" class="edit_input_text" style="display: none;">
                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/front_end_section_management'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/front_end_section_management/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                            <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
						

                        <ul class="collapse in dropdown-menu" id="front">
                            <?php if (in_array('welcome_page', $page_access) || in_array('general_instruction', $page_access) || in_array('product_instruction', $page_access) || in_array('cart_instruction', $page_access) || in_array('form_validation_instruction', $page_access) || in_array('countries', $page_access) || in_array('page_title', $page_access) || in_array('sales_order_preview', $page_access) || in_array('payment_instructions', $page_access) || in_array('state_instructions', $page_access) || in_array('signup_instructions', $page_access) || in_array('conditional_pages', $page_access) || in_array('time_digits', $page_access) || in_array('aramex_error', $page_access) || in_array('api_instruction', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'globe_product' || $active == 'welcome' || $active == 'general_instruction') || $active == 'product_instruction' || $active == 'cart_instruction' || $active == 'form_validation_instruction' || $active == 'countries' || $active == 'page_title' || $active == 'sales_order_preview' || $active == 'payment_instructions' || $active == 'state_instructions' || $active == 'signup_instructions' || $active == 'conditional_pages' || $active == 'time_digits' || $active == 'aramex_error' || $active == 'api_instruction') echo ' open'; ?>">

                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#front_welcome">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['welcome_page']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['welcome_page']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/welcome_page'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/welcome_page/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="front_welcome">
                                        <?php if (in_array('welcome_page', $page_access)) { ?>
                                            <li class="<?php if (isset($active) && $active == 'welcome') echo ' active'; ?>">
                                                <a href="admin/<?php echo $lang_id; ?>/index/welcome_page" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "> <?php echo $admin_sidebar['settings']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['settings']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/settings'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/settings/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>


                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('general_instruction', $page_access)) { ?>
                                            <li class="<?php if (isset($active) && $active == 'general_instruction') echo ' active'; ?>">
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/general_instruction" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['general_instruction']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['general_instruction']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/general_instruction'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/general_instruction/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                        <?php if (in_array('product_instruction', $page_access)) { ?>
                                            <li class="<?php if (isset($active) && $active == 'product_instruction') echo ' active'; ?>">
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/product_instruction" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['product_instruction']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['product_instruction']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product_instruction'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product_instruction/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                        <?php if (in_array('cart_instruction', $page_access)) { ?>
                                            <li class="<?php if (isset($active) && $active == 'cart_instruction') echo ' active'; ?>">
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/cart_instruction" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['cart_instruction']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['cart_instruction']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/cart_instruction'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/cart_instruction/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                        <?php if (in_array('form_validation_instruction', $page_access)) { ?>
                                            <li class="<?php if (isset($active) && $active == 'form_validation_instruction') echo ' active'; ?>">
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/form_validation_instruction" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['form_validation_instruction']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['form_validation_instruction']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/form_validation_instruction'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/form_validation_instruction/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>


                                        <?php if (in_array('countries', $page_access)) { ?>
                                            <li class="<?php if (isset($active) && $active == 'countries') echo ' active'; ?>">
                                                <a href="admin/<?php echo $lang_id; ?>/countries" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['country_instructions']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['country_instructions']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/country_instructions'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/country_instructions/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                        <?php if (in_array('page_title', $page_access)) { ?>
                                            <li class="<?php if (isset($active) && $active == 'page_title') echo ' active'; ?>">
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/page_title" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['page_title']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['page_title']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/page_title'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/page_title/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                        <?php if (in_array('sales_order_preview', $page_access)) { ?>
                                            <li class="<?php if (isset($active) && $active == 'sales_order_preview') echo ' active'; ?>">
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/sales_order_preview" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['sales_order_preview']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['sales_order_preview']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/sales_order_preview'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/sales_order_preview/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                        <?php if (in_array('payment_instructions', $page_access)) { ?>
                                            <li class="<?php if (isset($active) && $active == 'payment_instructions') echo ' active'; ?>">
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/payment_instructions" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['payment_instructions']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['payment_instructions']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/payment_instructions'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/payment_instructions/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                        <?php if (in_array('state_instructions', $page_access)) { ?>
                                            <li class="<?php if (isset($active) && $active == 'state_instructions') echo ' active'; ?>">
                                                <a href="admin/<?php echo $lang_id; ?>/index/state_instructions" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['state_instructions']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['state_instructions']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/state_instructions'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/state_instructions/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('conditional_pagess', $page_access)) { ?>
                                            <li class="<?php if (isset($active) && $active == 'conditional_pages') echo ' active'; ?>">
                                                <a href="admin/<?php echo $lang_id; ?>/index/conditional_pages" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['conditional_pages']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['conditional_pages']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/conditional_pages'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/conditional_pages/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                        <?php if (in_array('api_instruction', $page_access)) { ?>
                                            <li class="<?php if (isset($active) && $active == 'api_instruction') echo ' active'; ?>">
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/api_instruction" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['api_instruction']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['api_instruction']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/api_instruction'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/api_instruction/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                        <?php if (in_array('time_digits', $page_access)) { ?>
                                            <li class="<?php if (isset($active) && $active == 'time_digits') echo ' active'; ?>">
                                                <a href="admin/<?php echo $lang_id; ?>/index/time_digits" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo @$admin_sidebar['time_digits']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo @$admin_sidebar['time_digits']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/time_digits'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/time_digits/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                        <?php if (in_array('aramex_error', $page_access)) { ?>
                                            <li class="<?php if (isset($active) && $active == 'aramex_error') echo ' active'; ?>">
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/aramex_error" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo @$admin_sidebar['aramex_error']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo @$admin_sidebar['aramex_error']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/aramex_error'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/aramex_error/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>

                            <?php } ?>
                            <?php if (in_array('language', $page_access) || in_array('set_default_language', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'language' || $active == 'set_default_language')) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#language">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['language']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['language']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/language'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/language/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="language">
                                        <?php if (in_array('language', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'language') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/language" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['language_list']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['language_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/language_list'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/language_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('set_default_language', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'set_default_language') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/language/default_language_list" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['set_default_language']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['set_default_language']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/language_list'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/set_default_language/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>

                            <?php if (in_array('userblocked', $page_access) || in_array('front_blocks_list', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'userblocked' || $active == 'front_blocks_list')) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#front_block">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['block']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['block']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/block'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/block/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="front_block">
                                        <?php if (in_array('userblocked', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'userblocked') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/userblocked" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['block_users']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['block_users']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/block_users'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/block_users/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('front_blocks_list', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'front_blocks_list') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/front_blocks_list" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['front_user_block_list']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['front_user_block_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/front_user_block_list'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/front_user_block_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if (in_array('product', $page_access) || in_array('product_type', $page_access) || in_array('makers', $page_access) || in_array('importdata', $page_access)  || in_array('exportdata', $page_access) || in_array('industry_type', $page_access) || in_array('marketplace_export', $page_access) || in_array('product_model', $page_access) || in_array('vehicle_categories', $page_access) || in_array('product_items', $page_access) || in_array('product_natures', $page_access) || in_array('part_relation', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'product' || $active == 'product_type' || $active == 'makers' || $active == 'importdata'  || $active == 'exportdata' || $active == 'industry_type' || $active == 'marketplace_export' || $active == 'product_model' || $active == 'vehicle_categories' || $active == 'product_items' || $active == 'product_natures'  || $active == 'part_relation')) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#front_product">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['product']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['product']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="front_product">


                                        <?php if (in_array('vehicle_categories', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'vehicle_categories') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/vehicle_categories" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['vehicle_category']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['vehicle_category']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/vehicle_category'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/vehicle_category/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('makers', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'makers') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/makers" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['product_makers']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['product_makers']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product_makers'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product_makers/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('product_model', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'product_model') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/product_model" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['product_models']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['product_models']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product_models'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product_models/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>


                                        <?php if (in_array('product_items', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'product_items') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/productitems" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['product_items']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['product_items']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product_items'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product_items/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('product_type', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'product_type') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/product_type" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['product_type']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['product_type']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product_type'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product_type/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('part_relation', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'part_relation') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/part_relation" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['part_relation']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['part_relation']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/part_relation'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/part_relation/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('product_natures', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'product_natures') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/productnatures" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['product_natures']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['product_natures']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product_natures'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product_natures/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>


                                        <?php if (in_array('importdata', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'importdata') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/importdata" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['product_import_data']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['product_import_data']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product_import_data'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product_import_data/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>



                                        <?php if (in_array('exportdata', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'exportdata') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/importdata/export" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['product_export_data']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['product_export_data']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product_export_data'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product_export_data/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('marketplace_export', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'marketplace_export') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/importdata/marketplace_export" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['marketplace_export']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['marketplace_export']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/marketplace_export'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/marketplace_export/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('industry_type', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'industry_type') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/industry" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['industry_type']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['industry_type']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/industry_type'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/industry_type/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>
                                        
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if (in_array('cart_timer', $page_access) || in_array('entry_door_timer', $page_access) || in_array('signup_timer', $page_access) || in_array('contact_timer', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'cart_timer' || $active == 'entry_door_timer' || $active == 'contact_timer')) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#front_timer">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['timer']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['timer']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/timer'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/timer/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="front_timer">
                                        <?php if (in_array('cart_timer', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'cart_timer') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/cart_timer" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['cart_timer']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['cart_timer']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/cart_timer'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/cart_timer/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('entry_door_timer', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'entry_door_timer') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/entry_door_timer" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['entry_door_timer']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['entry_door_timer']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/front_entry_door_timer'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/front_entry_door_timer/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('contact_timer', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'contact_timer') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/contact_timer" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['contact_timer']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['contact_timer']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/contact_timer'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/contact_timer/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if (in_array('entry_door_message', $page_access) || in_array('selection_instruction', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'entry_door_message' || $active == 'selection_instruction')) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#front_message">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['message']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['message']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/message'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/message/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="front_message">
                                        <?php if (in_array('entry_door_message', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'entry_door_message') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/entry_door_message" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['entry_door_message']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['entry_door_message']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/entry_door_message'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/entry_door_message/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                        <?php if (in_array('selection_instruction', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'selection_instruction') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/selection_instruction" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['selection_instruction']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['selection_instruction']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/selection_instructions'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/selection_instructions/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if (in_array('cart', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'cart' || $active == 'price_requests' || $active == 'users')) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#front_orders">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['orders']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['orders']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/orders'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/orders/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="front_orders">
                                        <?php if (in_array('cart', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'cart') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/orders" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['order_details']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['order_details']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/order_details'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/order_details/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                        <?php if (in_array('cart', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'users') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/users" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['user_details']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['user_details']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/user_details'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/user_details/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>


                                        <?php 
                                        
                                        if ($this->config->item('limited_price_option') == "1") {
                                        
                                        if (in_array('price_requests', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'price_requests') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/pricerequests" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['manage_pricerequests']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['manage_pricerequests']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/manage_pricerequests'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/manage_pricerequests/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php }  } ?>



                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if (in_array('users_front_entry_door', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'users_front_entry_door_list')) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#front_users">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['users']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['users']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/users'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/users/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="front_users">
                                        <?php if (in_array('users_front_entry_door', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'users_front_entry_door_list') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/users_front_entry_door" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['users_list']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['users_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/users_list'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/users_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>

                            <?php if (in_array('pages', $page_access) || (in_array('navigation_setting', $page_access)) || (in_array('gallery', $page_access)) || (in_array('banner_setting', $page_access)) || (in_array('social_media_setting', $page_access))  || (in_array('payment_accept_card_setting', $page_access)) || (in_array('whats_new_setting', $page_access))) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'pages') || $active == 'navigation_setting' || $active == 'gallery' || $active == 'banner_setting' || $active == 'social_media_setting' || $active == 'payment_accept_card_setting' || $active == 'whats_new_setting') echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#front_orders">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['pages']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['pages']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/pages'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/pages/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="front_orders">
                                        <?php if (in_array('pages', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'pages') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/homepagesetting" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['pages_block']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['pages_block']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/pages_block'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/pages_block/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('navigation_setting', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'navigation_setting') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/homepagesetting/navigation_setting" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "><?php echo $admin_sidebar['navigation_setting']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['navigation_setting']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/navigation_setting'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/navigation_setting/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('banner_setting', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'banner_setting') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/homepagesetting/banner_setting" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "><?php echo $admin_sidebar['banner_setting']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['banner_setting']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/banner_setting'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/banner_setting/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('social_media_setting', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'social_media_setting') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/homepagesetting/social_media_setting" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "><?php echo $admin_sidebar['social_media_setting']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['social_media_setting']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/social_media_setting'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/social_media_setting/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('whats_new_setting', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'whats_new_setting') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/homepagesetting/whats_new_setting" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "><?php echo $admin_sidebar['whats_new_setting']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['whats_new_setting']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/whats_new_setting'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/whats_new_setting/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('payment_accept_card_setting', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'payment_accept_card_setting') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/homepagesetting/payment_accept_card_setting" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "><?php echo $admin_sidebar['payment_accept_card_setting']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['payment_accept_card_setting']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/payment_accept_card_setting'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/payment_accept_card_setting/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>


                            <?php if (in_array('gallery', $page_access) && $this->config->item('enable_distributor_feature') == "1") {  ?>
                                            <li <?php if (isset($active) && $active == 'gallery') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/gallery" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "><?php echo $admin_sidebar['manage_gallery']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['manage_gallery']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/manage_gallery'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/manage_gallery/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>

                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if (in_array('ups_api_setting', $page_access) || in_array('bambora_api_setting', $page_access) || in_array('stripe_api_setting', $page_access) || in_array('payment_api_setting', $page_access) || in_array('shipping_markup_setting', $page_access)) { ?>

                                <li class="dropdown<?php if (isset($active) && ($active == 'ups_api_setting' || $active == 'bambora_api_setting' || $active == 'stripe_api_setting' || $active == 'payment_api_setting' || $active == 'shipping_markup_setting')) echo ' open'; ?>">

                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#front_message">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['api']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['api']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/api'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/api/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="front_message">
                                        <?php if (in_array('ups_api_setting', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'ups_api_setting') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/api/shipping_api_setting" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['ups_api_setting']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['ups_api_setting']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/ups_api_setting'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/ups_api_setting/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>


                                        <?php if (in_array('payment_api_setting', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'payment_api_setting') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/api/payment_api_setting" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['payment_api_setting']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['payment_api_setting']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/payment_api_setting'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/payment_api_setting/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                        <?php if (in_array('shipping_markup_setting', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'shipping_markup_setting') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/api/shipping_markup_setting" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['shipping_markup_setting']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['shipping_markup_setting']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/shipping_markup_setting'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/shipping_markup_setting/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>

                            <?php if (in_array('package', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'package')) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#front_orders">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['package']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['package']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/package'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/package/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="front_orders">
                                        <?php if (in_array('package', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'package') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/package" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['package_block']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['package_block']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/package_block'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/package_block/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>

                            <?php if (in_array('global_settings', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'global_settings')) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#front_orders">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['global_settings']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['global_settings']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/global_settings'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/global_settings/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="front_orders">
                                        <?php if (in_array('global_settings', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'global_settings') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/index/global_settings" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['global_settings_menu']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['global_settings_menu']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/global_settings_menu'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/global_settings_menu/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>

                            <?php if (in_array('contact_user', $page_access) || in_array('contact_message', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'contact_user' || $active == 'contact_message')) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#front_orders">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['contact_user']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['contact_user']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/contact_user'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/contact_user/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="front_orders">
                                        <?php if (in_array('contact_user', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'contact_user') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/contact" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['contact_user_list']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['contact_user_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/contact_user_list'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/contact_user_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('contact_message', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'contact_message') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/contact_message" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['contact_message']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['contact_message']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/contact_message'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/contact_message/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>



                            <?php if (in_array('credit_term_settings', $page_access) || in_array('credit_term_list', $page_access) || in_array('refferaluser_list', $page_access) || in_array('discount_list', $page_access) || in_array('discountusers_list', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'credit_term_settings' || $active == 'credit_term_list' || $active == 'refferaluser_list' || $active == 'discount_list' || $active == 'discountusers_list') ) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#front_orders">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['credit_term']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['credit_term']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/credit_term'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/credit_term/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="front_orders">
                                        <?php if (in_array('credit_term_settings', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'credit_term_settings') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/creditterm/settings" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['credit_term_settings']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['credit_term_settings']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/credit_term_settings'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/credit_term_settings/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('credit_term_list', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'credit_term_list') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/creditterm/index" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['credit_term_requests']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['credit_term_requests']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/credit_term_requests'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/credit_term_requests/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('refferaluser_list', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'refferaluser_list') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/referralusers/index" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['refferaluser_list']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['refferaluser_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/refferaluser_list'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/refferaluser_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('discount_list', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'discount_list') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/discounts/index" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['discount_list']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['discount_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/discount_list'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/discount_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('discountusers_list', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'discountusers_list') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/discountsusers/index" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['discountusers_list']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['discountusers_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/discountusers_list'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/discountusers_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>


                                    </ul>
                                </li>
                            <?php } ?>

                            <?php if (in_array('store', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'store' )) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#front_orders">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['manage_store']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['manage_store']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/manage_store'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/manage_store/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="front_orders">
                                        <?php if (in_array('store', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'store') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/store" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['store_list']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['store_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/store_list'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/store_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>                                        
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if (in_array('distributors', $page_access) && $this->config->item('enable_distributor_feature') == "1") { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'distributor' && $this->config->item('enable_distributor_feature') == "1")) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#front_orders">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['manage_distributor']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['manage_distributor']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/manage_distributor'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/manage_distributor/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="front_orders">
                                        <?php if (in_array('distributors', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'distributor') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/distributor" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['distributor_list']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['distributor_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/distributor_list'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/distributor_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </li>
                                        <?php } ?>                                        
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (in_array('admin_static_links', $page_access) || in_array('admin_products', $page_access) || in_array('admin_title', $page_access) || in_array('email_instruction', $page_access) || in_array('adminrole', $page_access) || in_array('adminuser', $page_access) || in_array('admin_blocks_list', $page_access) || in_array('admin_door_timer', $page_access) || in_array('sales_order_section', $page_access) || in_array('sales_order_block', $page_access) || in_array('stock_code_info', $page_access) || in_array('stock_line_info', $page_access) || in_array('tax_rate', $page_access) || in_array('ups_errors', $page_access) || in_array('ups_service_code_description', $page_access) || in_array('bambora_errors', $page_access) || in_array('stripe_errors', $page_access)) { ?>
                    <li class="dropdown<?php if (isset($active) && ($active == 'admin_door_timer' || $active == 'admin_blocks_list' || $active == 'adminrole' || $active == 'adminuser' || $active == 'admin_static_links' || $active == 'admin_products' || $active == 'admin_title' || $active == 'email_instruction' || $active == 'sales_order' || $active == 'sales_order_section' || $active == 'sales_order_block' || $active == 'stock_code_info' || $active == 'stock_line_info' || $active == 'tax_rate' || $active == 'ups_errors' || $active == 'ups_service_code_description' || $active == 'bambora_errors' || $active == 'stripe_errors')) echo ' open'; ?>">
                        <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#back_end">
                            <span class="nav-header-primary"><?php echo $admin_sidebar['back_end_section_management']['admin']; ?></span>

                            <span class="pull-right"><b class="caret"></b></span>
                        </a>
                        <?php if ($lang_id == $primary_lang) { ?>
                            <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                            <input type="text" value="<?php echo $admin_sidebar['back_end_section_management']['admin']; ?>" class="edit_input_text" style="display: none;">
                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/back_end_section_management'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/back_end_section_management/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                            <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>

                        <ul class="collapse in dropdown-menu" id="back_end">
                            <?php if (in_array('admin_static_links', $page_access) || in_array('admin_products', $page_access) || in_array('admin_title', $page_access) || in_array('email_instruction', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'admin_static_links' || $active == 'admin_products' || $active == 'admin_title' || $active == 'email_instruction')) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#setting">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['admin_translation']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['admin_translation']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_translation'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_translation/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="setting">
                                        <?php if (in_array('admin_static_links', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'admin_static_links') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/admin_static_links" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['admin_static_links']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['admin_static_links']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_setting_instructions'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_setting_instructions/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('admin_products', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'admin_products') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/admin_products" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['admin_products']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['admin_products']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_products'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_products/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('admin_title', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'admin_title') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/admin_title" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['admin_title']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['admin_title']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_title_instructions'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_title_instructions/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('email_instruction', $page_access)) { ?>
                                            <li class="<?php if (isset($active) && $active == 'email_instruction') echo ' active'; ?>">
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/email_instruction" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['email_instruction']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['email_instruction']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_email_instructions'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_email_instructions/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if (in_array('adminrole', $page_access) || in_array('adminuser', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'adminrole' || $active == 'adminuser')) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#back_admin">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['admin']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['admin']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="back_admin">
                                        <?php if (in_array('adminrole', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'adminrole') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/adminrole" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['admin_roles']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['admin_roles']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_roles'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_roles/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>

                                        <?php if (in_array('adminuser', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'adminuser') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/adminuser" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['admin_users']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['admin_users']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_users'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_users/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if (in_array('admin_blocks_list', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'admin_blocks_list')) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#back_block">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['admin_block']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['admin_block']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_block'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_block/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="back_block">
                                        <?php if (in_array('admin_blocks_list', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'admin_blocks_list') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/admin_blocks_list" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['admin_user_block_list']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['admin_user_block_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_user_block_list'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_user_block_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if (in_array('admin_door_timer', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'admin_door_timer')) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#back_timer">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['admin_timer']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['admin_timer']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_timer'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_timer/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="back_timer">
                                        <?php if (in_array('admin_door_timer', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'admin_door_timer') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/section/admin_door_timer" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['admin_door_timer']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['admin_door_timer']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/timer_admin_entry_door'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/timer_admin_entry_door/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if (in_array('sales_order', $page_access) || in_array('sales_order_section', $page_access) || in_array('sales_order_block', $page_access) || in_array('stock_code_info', $page_access) || in_array('stock_line_info', $page_access) || in_array('tax_rate', $page_access) || in_array('ups_errors', $page_access) || in_array('ups_service_code_description', $page_access) || in_array('bambora_errors', $page_access) || in_array('stripe_errors', $page_access)) { ?>
                                <li class="dropdown<?php if (isset($active) && ($active == 'sales_order' || $active == 'sales_order_section' || $active == 'sales_order_block' || $active == 'stock_code_info' || $active == 'stock_line_info' || $active == 'tax_rate' || $active == 'ups_errors' || $active == 'ups_service_code_description' || $active == 'bambora_errors' || $active == 'stripe_errors')) echo ' open'; ?>">
                                    <a class="accordion-heading dropdown-item" data-toggle="collapse" data-target="#sales_order">
                                        <span class="nav-header-primary"><?php echo $admin_sidebar['sales_order']['admin']; ?></span>

                                        <span class="pull-right"><b class="caret"></b></span>
                                    </a>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                        <input type="text" value="<?php echo $admin_sidebar['sales_order']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/sales_order'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/sales_order/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                    <ul class="collapse in dropdown-menu" id="sales_order">

                                        <?php if (in_array('tax_rate', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'tax_rate') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/tax_rate" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['tax_rate']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['tax_rate']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/tax_rate'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/tax_rate/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php }  ?>
                                        <?php if (in_array('ups_errors', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'ups_errors') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/errors/index/ups_errors" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['ups_errors']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['ups_errors']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/ups_errors'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/ups_errors/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php }  ?>
                                        <?php if (in_array('ups_service_code_description', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'ups_service_code_description') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/errors/index/ups_service_code_description" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['ups_service_code_description']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['ups_service_code_description']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/ups_service_code_description'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/ups_service_code_description/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php } ?>
                                        <?php if (in_array('bambora_errors', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'bambora_errors') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/errors/index/bambora_errors" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['bambora_errors']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['bambora_errors']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/bambora_errors'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/bambora_errors/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php }  ?>
                                        <?php if (in_array('stripe_errors', $page_access)) { ?>
                                            <li <?php if (isset($active) && $active == 'stripe_errors') echo 'class="active"'; ?>>
                                                <a href="admin/<?php echo $lang_id; ?>/errors/index/stripe_errors" title="" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                                                    <?php echo $admin_sidebar['stripe_errors']['admin']; ?></a>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                                                    <input type="text" value="<?php echo $admin_sidebar['stripe_errors']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/stripe_errors'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/stripe_errors/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                            </li>
                                        <?php }  ?>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
            </ul>

        </nav>
    </ul>
    <!-- /simple nav -->
    <div class="separator-doubled"></div>

    <!-- Dis code be laughing at me... I can't get rid of it and the site to carry on working :P -->
    <div class="outer sidebar-chart block displaynon">
        <div class="chart" id="sidebar-bars-horizontal"></div>
    </div>
    <div class="outer sidebar-chart block displaynon">
        <div class="chart" id="sidebar-bars"></div>
    </div>
    <div class="outer sidebar-chart block displaynon">
        <div class="chart" id="sidebar-chart"></div>
    </div>
    <!-- IM NOT A SKID FUCK OFF -->

    <div class="appendable">


        <!-- Links -->
        <ul class="block sidebar-links kgt12">
            <li>
				<div class="link-wrapper">
                <label class="control-label label_left_menu"><?php echo $admin_static_links['name']['front'] . ':'; ?></label>
                <?php if ($lang_id == $primary_lang) { ?>
                    <div class="edit_text pen_left_menu" style="display:block"></div>
                    <input type="text" value="<?php echo $admin_static_links['name']['front']; ?>" class="edit_input_text" style="display: none;">
                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_static_links/name'; ?>">
                <?php } ?>
                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_static_links/name/admin" class="fancybox  multi_language_common_edit admin_globe globe_left_menu sidebar_link_multi_lang">
                    <img src="assets/uploads/global.jpg" height="20" width="20">
                </a>

                <span class="floatright1"><?php echo ucwords($admin_validuser_data['title']) . ' ' . $admin_validuser_data['first_name'] . ' ' . $admin_validuser_data['last_name']; ?></span>
				</div>
				<div class="link-wrapper">
                <label class="control-label label_left_menu"><?php echo $admin_static_links['email']['front'] . ':'; ?></label>
                <?php if ($lang_id == $primary_lang) { ?>
                    <div class="edit_text pen_left_menu" style="display:block"></div>
                    <input type="text" value="<?php echo $admin_static_links['email']['front']; ?>" class="edit_input_text" style="display: none;">
                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_static_links/email'; ?>">
                <?php } ?>
                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_static_links/email/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu sidebar_link_multi_lang">
                    <img src="assets/uploads/global.jpg" height="20" width="20">
                </a>

                <span class="floatright1"><?php echo $admin_validuser_data['email']; ?></span>
				</div>
				<div class="link-wrapper">

                <label class="control-label label_left_menu"><?php echo $admin_static_links['cellphone']['front'] . ':'; ?></label>
                <?php if ($lang_id == $primary_lang) { ?>
                    <div class="edit_text pen_left_menu" style="display:block"></div>
                    <input type="text" value="<?php echo $admin_static_links['cellphone']['front']; ?>" class="edit_input_text" style="display: none;">
                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_static_links/cellphone'; ?>">
                <?php } ?>
                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_static_links/cellphone/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu sidebar_link_multi_lang">
                    <img src="assets/uploads/global.jpg" height="20" width="20">
                </a>
                <span class="floatright1"><?php echo '+' . $admin_validuser_data['country_code'] . ' ' . $admin_validuser_data['telephone']; ?></span>
				</div>
            </li>
        </ul>
        <!-- /links -->


        <div class="separator-doubled"></div>

        <!-- Form elements -->
        <a href="admin/<?php echo $lang_id; ?>/index/logout" class="btn btn-block btn-primary"><?php echo $admin_static_links['logout']['front']; ?></a>
        <!-- /form elements -->

    </div>
</div>
</div>
<!-- /left sidebar -->
<script>
    <?php if (isset($remaining_time) && $remaining_time != '') { ?>
        $(document).ready(function() {
            var time = '<?php echo $remaining_time; ?>';
            start(time);
        });
    <?php } ?>

    function reformatTime(timeText, lang = 'en') {

        var finalText = '';
        for (i = 0; i < timeText.length; i++) {
            if (timeText[i] == ':') {
                finalText += "&nbsp;" + timeText[i] + "&nbsp;";
            } else {
                if (time_digits != undefined) {
                    finalText += time_digits["time_digits"]["digit_" + timeText[i]];

                } else {
                    finalText += timeText[i];
                }

            }
        }
        return finalText;
    }

    function start(time) {
        if (time > 0) {
            var h = Math.floor(time / 3600);
            var mtime = time - (h * 3600);
            var m = Math.floor(mtime / 60);
            var s = mtime - (m * 60);

            var timeText = reformatTime(str_pad_left(h, '0', 2) + ':' + str_pad_left(m, '0', 2) + ':' + str_pad_left(s, '0', 2), 'en');
            $('#usertimer span').html(timeText);
            setTimeout(function() {
                start(parseInt(time) - 1);
            }, 1000);
        } else {
            logout_user();
        }

    }

    function logout_user() {
        $.ajax({
            type: "POST",
            url: "admin/<?php echo $lang_id; ?>/entry_door/logout_user",
            data: '',
            dataType: "json",
            success: function(msg) {
                window.location = msg.redirect;
            }
        });
    }

    function str_pad_left(string, pad, length) {
        return (new Array(length + 1).join(pad) + string).slice(-length);
    }
</script>
