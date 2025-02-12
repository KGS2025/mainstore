<?php
$page_access = $this->session->userdata('page_access');
$all_language_data = get_admin_lang_data(array('admin_sidebar'), $this->lang->default_lang_id);
$admin_sidebar = $all_language_data['admin_sidebar'];
?>
<!-- Main content -->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<div class="content zerorightmargin ">
  <div class="outer">
    <div class="inner">
      <div class="page-header">
        <!-- page title -->
        <h5><i class="font-user"></i><?php echo $admin_sidebar['dashboard']['admin']; ?></h5>
        <?php if ($lang_id == $primary_lang) { ?>
          <div class="edit_text"></div>
          <input type="text" value="<?php echo $admin_sidebar['dashboard']['admin']; ?>" class="edit_input_text" style="display: none;">
          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/dashboard'; ?>">
        <?php } ?>
        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/dashboard/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links" style="padding: 10px 0px 0px 7px !important;">
          <img src="assets/uploads/global.jpg" height="20" width="20">
        </a>
        <!-- End page title -->
        <div class="body dashboard">

          <!-- Content container -->
          <div class="container">

            <!-- Pickers -->
            <?php if (in_array('welcome_page', $page_access) || in_array('general_instruction', $page_access) || in_array('product_instruction', $page_access) || in_array('cart_instruction', $page_access) || in_array('form_validation_instruction', $page_access) || in_array('email_instruction', $page_access) || in_array('countries', $page_access) || in_array('page_title', $page_access) || in_array('sales_order_preview', $page_access) || in_array('payment_instructions', $page_access) || in_array('state_instructions', $page_access) || in_array('language', $page_access) || in_array('set_default_language', $page_access) || in_array('userblocked', $page_access) || in_array('front_blocks_list', $page_access) || in_array('product', $page_access) || in_array('product_type', $page_access) || in_array('makers', $page_access) || in_array('product_model', $page_access) || in_array('vehicle_categories', $page_access) || in_array('product_items', $page_access) || in_array('part_relation', $page_access) || in_array('product_natures', $page_access) || in_array('timer_cart', $page_access) || in_array('entry_door_timer', $page_access) || in_array('entry_door_message', $page_access) || in_array('selection_instruction', $page_access) || in_array('cart', $page_access) || in_array('users_front_entry_door', $page_access) || in_array('signup_instructions', $page_access) || in_array('conditional_pages', $page_access) || in_array('signup_timer', $page_access) || in_array('signup_users_details', $page_access) || in_array('pages', $page_access) || in_array('ups_api_setting', $page_access) || in_array('bambora_api_setting', $page_access) || in_array('api_instruction', $page_access) || in_array('package', $page_access) || in_array('global_settings', $page_access) || in_array('stripe_api_setting', $page_access) || in_array('payment_api_setting', $page_access) || in_array('shipping_markup_setting', $page_access)) { ?>
              <div class="row-fluid">
                <div class="span12">
                  <h5 class="d_links_heading"><?php echo $admin_sidebar['front_end_section_management']['admin']; ?></h5>
                  <?php if ($lang_id == $primary_lang) { ?>
                    <div class="edit_text"></div>
                    <input type="text" value="<?php echo $admin_sidebar['front_end_section_management']['admin']; ?>" class="edit_input_text" style="display: none;">
                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/front_end_section_management'; ?>">
                  <?php } ?>
                  <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/front_end_section_management/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                    <img src="assets/uploads/global.jpg" height="20" width="20">
                  </a>
                </div>
              </div>

              <?php
              $page_row_counter = 0;
              if ($page_row_counter == 0) {
                echo '<div class="row-fluid">';
              }
              $page_row_counter++;
              ?>
              <div class="span3">
                <div class="block well">
                  <div class="navbar">
                    <div class="navbar-inner">
                      <h5><?php echo $admin_sidebar['welcome_page']['admin']; ?></h5>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text"></div>
                        <input type="text" value="<?php echo $admin_sidebar['welcome_page']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/welcome_page'; ?>">
                      <?php } ?>
                      <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/welcome_page/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                    </div>
                  </div>
                  <div class="control-group">
                    <?php if (in_array('welcome_page', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/index/welcome_page" title="">
                        <?php echo $admin_sidebar['settings']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['settings']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/settings'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/settings/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_section_common_data/admin_setting/admin" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a> -->
                      <br />
                    <?php } ?>

                    <?php if (in_array('general_instruction', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/multilangue/section/general_instruction" title="">
                        <?php echo $admin_sidebar['general_instruction']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['general_instruction']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/general_instruction'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/general_instruction/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_section_common_data/general_instruction" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a>
                      <a href="javascript:void(0);" relation="general_instruction/front" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/upload_csv.png" height="30" width="30">
                      </a> -->

                      <br />
                    <?php } ?>

                    <?php if (in_array('product_instruction', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/multilangue/section/product_instruction" title="">
                        <?php echo $admin_sidebar['product_instruction']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['product_instruction']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product_instruction'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product_instruction/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_section_common_data/product_instruction" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a>

                      <a href="javascript:void(0);" relation="product_instruction/front" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/upload_csv.png" height="30" width="30">
                      </a> -->

                      <br />
                    <?php } ?>
                    <?php if (in_array('cart_instruction', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/multilangue/section/cart_instruction" title="">
                        <?php echo $admin_sidebar['cart_instruction']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['cart_instruction']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/cart_instruction'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/cart_instruction/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_section_common_data/cart_instruction" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a>

                      <a href="javascript:void(0);" relation="cart_instruction/front" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/upload_csv.png" height="30" width="30">
                      </a> -->

                      <br />
                    <?php } ?>
                    <?php if (in_array('form_validation_instruction', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/multilangue/section/form_validation_instruction" title="">
                        <?php echo $admin_sidebar['form_validation_instruction']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['form_validation_instruction']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/form_validation_instruction'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/form_validation_instruction/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_section_common_data/form_validation_instruction" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a>

                      <a href="javascript:void(0);" relation="form_validation_instruction/front" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/upload_csv.png" height="30" width="30">
                      </a> -->


                      <br />
                    <?php } ?>


                    <?php if (in_array('countries', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/countries" title="">
                        <?php echo $admin_sidebar['country_instructions']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['country_instructions']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/country_instructions'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/country_instructions/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_excel_data/admin_countries/admin_countries_lang/country_name" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a>

                      <a href="javascript:void(0);" relation="admin_countries/admin_countries_lang" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/upload_csv.png" height="30" width="30">
                      </a> -->


                      <br />
                    <?php } ?>
                    <?php if (in_array('page_title', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/multilangue/section/page_title" title="">
                        <?php echo $admin_sidebar['page_title']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['page_title']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/page_title'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/page_title/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_section_common_data/page_title" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a>

                      <a href="javascript:void(0);" relation="page_title/front" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/upload_csv.png" height="30" width="30">
                      </a> -->

                      <br />
                    <?php } ?>
                    <?php if (in_array('sales_order_preview', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/multilangue/section/sales_order_preview" title="">
                        <?php echo $admin_sidebar['sales_order_preview']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['sales_order_preview']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/sales_order_preview'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/sales_order_preview/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_section_common_data/sales_order_preview" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a>

                      <a href="javascript:void(0);" relation="sales_order_preview/front" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/upload_csv.png" height="30" width="30">
                      </a> -->

                      <br />
                    <?php } ?>
                    <?php if (in_array('payment_instructions', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/multilangue/section/payment_instructions" title="">
                        <?php echo $admin_sidebar['payment_instructions']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['payment_instructions']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/payment_instructions'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/payment_instructions/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_section_common_data/bambora_instructions/admin" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a>
                      <a href="javascript:void(0);" relation="bambora_instructions/admin" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/upload_csv.png" height="30" width="30">
                      </a> -->
                      <br />
                    <?php } ?>
                    <?php if (in_array('state_instructions', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/index/state_instructions" title="">
                        <?php echo $admin_sidebar['state_instructions']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['state_instructions']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/state_instructions'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/state_instructions/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_excel_data/state/state_country/name" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a>

                      <a href="javascript:void(0);" relation="state/state_country" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/upload_csv.png" height="30" width="30">
                      </a> -->
                      <br />
                    <?php } ?>

                    <?php if (in_array('conditional_pagess', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/index/conditional_pages" title="">
                        <?php echo $admin_sidebar['conditional_pages']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['conditional_pages']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/conditional_pages'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/conditional_pages/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_excel_section_wise/conditional_pages/conditional_pages_country" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a>

                      <a href="javascript:void(0);" relation="conditional_pages/conditional_pages_country" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/upload_csv.png" height="30" width="30">
                      </a> -->

                      <br />
                    <?php } ?>
                    <?php if (in_array('api_instruction', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/multilangue/section/api_instruction" title="">
                        <?php echo $admin_sidebar['api_instruction']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['api_instruction']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/api_instruction'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/api_instruction/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_section_common_data/api_instruction" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a>

                      <a href="javascript:void(0);" relation="api_instruction/front" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/upload_csv.png" height="30" width="30">
                      </a> -->

                      <br />
                    <?php } ?>

                    <?php if (in_array('time_digits', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/index/time_digits" title="">
                        <?php echo $admin_sidebar['time_digits']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['time_digits']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/time_digits'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/time_digits/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_excel_section_wise/time_digits/time_digits_country" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a> -->
                      <br />
                    <?php } ?>
                  </div>
                </div>
              </div>

              <?php if ($page_row_counter == 4) {
                $page_row_counter = 0;
                echo '</div><div class="row-fluid">';
              } ?>
              <?php
              if (in_array('language', $page_access) || in_array('set_default_language', $page_access)) {
                $page_row_counter++;
              ?>
                <div class="span3">
                  <div class="block well">
                    <div class="navbar">
                      <div class="navbar-inner">
                        <h5><?php echo $admin_sidebar['language']['admin']; ?></h5>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text"></div>
                          <input type="text" value="<?php echo $admin_sidebar['language']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/language'; ?>">
                        <?php } ?>
                        <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/language/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                    </div>
                    <div class="control-group">
                      <?php if (in_array('language', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/language" title=""> <?php echo $admin_sidebar['language_list']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['language_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/language_list'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/language_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      <?php } ?>
                      <br />
                      <?php if (in_array('set_default_language', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/language/default_language_list" title=""> <?php echo $admin_sidebar['set_default_language']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['set_default_language']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/set_default_language'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/set_default_language/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
              <?php if ($page_row_counter == 4) {
                $page_row_counter = 0;
                echo '</div><div class="row-fluid">';
              } ?>
              <?php
              if (in_array('userblocked', $page_access) || in_array('front_blocks_list', $page_access)) {
                $page_row_counter++;
              ?>
                <div class="span3">
                  <div class="block well">
                    <div class="navbar">
                      <div class="navbar-inner">
                        <h5><?php echo $admin_sidebar['block']['admin']; ?></h5>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text"></div>
                          <input type="text" value="<?php echo $admin_sidebar['block']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/block'; ?>">
                        <?php } ?>
                        <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/block/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                    </div>
                    <div class="control-group">
                      <?php if (in_array('userblocked', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/userblocked" title="">
                          <?php echo $admin_sidebar['block_users']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['block_users']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/block_users'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/block_users/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>

                        <br />
                      <?php } ?>


                      <?php if (in_array('front_blocks_list', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/front_blocks_list" title="">
                          <?php echo $admin_sidebar['front_user_block_list']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['front_user_block_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/front_user_block_list'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/front_user_block_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <br />
                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
              <?php if ($page_row_counter == 4) {
                $page_row_counter = 0;
                echo '</div><div class="row-fluid">';
              } ?>
              <?php
              if (in_array('product', $page_access) || in_array('product_type', $page_access) || in_array('makers', $page_access) || in_array('product_model', $page_access) || in_array('vehicle_categories', $page_access) || in_array('product_items', $page_access)  || in_array('product_natures', $page_access) || in_array('part_relation', $page_access)) {
                $page_row_counter++;
              ?>
                <div class="span3">
                  <div class="block well">
                    <div class="navbar">
                      <div class="navbar-inner">
                        <h5><?php echo $admin_sidebar['product']['admin']; ?></h5>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text"></div>
                          <input type="text" value="<?php echo $admin_sidebar['product']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product'; ?>">
                        <?php } ?>
                        <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                    </div>
                    <div class="control-group">

                      <?php if (in_array('vehicle_categories', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/vehicle_categories" title="">
                          <?php echo $admin_sidebar['vehicle_category']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['vehicle_category']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/vehicle_category'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/vehicle_category/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <!-- <a target="_blank" href="admin/<?php echo $lang_id; ?>/index/download_excel_data/tbl_vehicle_categories/tbl_vehicle_categories_country/category_name" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/download.png" height="30" width="30">
                        </a>

                        <a href="javascript:void(0);" relation="tbl_vehicle_categories/tbl_vehicle_categories_country" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/upload_csv.png" height="30" width="30">
                        </a> -->
                        <br />
                      <?php } ?>

                      <?php if (in_array('makers', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/makers" title="">
                          <?php echo $admin_sidebar['product_makers']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['product_makers']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product_makers'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product_makers/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <!-- <a target="_blank" href="admin/index/download_excel_data/tbl_makers/tbl_makers_country/maker_name" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/download.png" height="30" width="30">
                        </a>


                        <a href="javascript:void(0);" relation="tbl_makers/tbl_makers_country" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/upload_csv.png" height="30" width="30">
                        </a> -->
                        <br />
                      <?php } ?>

                      <?php if (in_array('product_model', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/product_model" title="">
                          <?php echo $admin_sidebar['product_models']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['product_models']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product_models'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product_models/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <br />
                      <?php } ?>

                      <?php if (in_array('product_items', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/productitems" title="">
                          <?php echo $admin_sidebar['product_items']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['product_items']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product_items'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product_items/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <!-- <a target="_blank" href="admin/index/download_excel_data/tbl_product_items/tbl_product_items_country/item_name" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/download.png" height="30" width="30">
                        </a>

                        <a href="javascript:void(0);" relation="tbl_product_items/tbl_product_items_country" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/upload_csv.png" height="30" width="30">
                        </a> -->

                        <br />
                      <?php } ?>

                      <?php if (in_array('product_type', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/product_type" title="">
                          <?php echo $admin_sidebar['product_type']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['product_type']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product_type'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product_type/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <!-- <a target="_blank" href="admin/index/download_excel_data/tbl_product_types/tbl_product_types_country/product_type_name" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/download.png" height="30" width="30">
                        </a>

                        <a href="javascript:void(0);" relation="tbl_product_types/tbl_product_types_country" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/upload_csv.png" height="30" width="30">
                        </a> -->
                        <br />
                      <?php } ?>


                      <?php if (in_array('part_relation', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/part_relation" title="">
                          <?php echo $admin_sidebar['part_relation']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['part_relation']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/part_relation'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/part_relation/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>


                        <br />
                      <?php } ?>





                      <?php if (in_array('product_natures', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/productnatures" title="">
                          <?php echo $admin_sidebar['product_natures']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['product_natures']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product_natures'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product_natures/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <!-- <a target="_blank" href="admin/index/download_excel_data/tbl_product_natures/tbl_product_natures_country/name" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/download.png" height="30" width="30">
                        </a> -->

                        <br />
                      <?php } ?>

                      <?php if (in_array('importdata', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/importdata" title="">
                          <?php echo $admin_sidebar['product_import_data']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['product_import_data']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product_import_data'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product_import_data/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <br />
                      <?php } ?>

                      <?php if (in_array('exportdata', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/importdata/export" title="">
                          <?php echo $admin_sidebar['product_export_data']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['product_export_data']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/product_export_data'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/product_export_data/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <br />
                      <?php } ?>

                      <?php if (in_array('marketplace_export', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/importdata/marketplace_export" title="">
                          <?php echo $admin_sidebar['marketplace_export']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['marketplace_export']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/marketplace_export'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/marketplace_export/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <br />
                      <?php } ?>
                     
                      <?php if (in_array('industry_type', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/industry" title="">
                          <?php echo $admin_sidebar['industry_type']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['industry_type']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/industry_type'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/industry_type/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <br />
                      <?php } ?>

                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
              <?php if ($page_row_counter == 4) {
                $page_row_counter = 0;
                echo '</div><div class="row-fluid">';
              } ?>
              <?php
              if (in_array('cart_timer', $page_access) || in_array('entry_door_timer', $page_access) || in_array('signup_timer', $page_access) || in_array('contact_timer', $page_access)) {
                $page_row_counter++;
              ?>
                <div class="span3">
                  <div class="block well">
                    <div class="navbar">
                      <div class="navbar-inner">
                        <h5><?php echo $admin_sidebar['timer']['admin']; ?></h5>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text"></div>
                          <input type="text" value="<?php echo $admin_sidebar['timer']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/timer'; ?>">
                        <?php } ?>
                        <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/timer/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>

                      </div>
                    </div>
                    <div class="control-group">
                      <?php if (in_array('cart_timer', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/multilangue/section/cart_timer" title="">
                          <?php echo $admin_sidebar['cart_timer']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['cart_timer']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/cart_timer'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/cart_timer/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <!-- <a target="_blank" href="admin/index/download_section_common_data/cart_timer" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/download.png" height="30" width="30">
                        </a>

                        <a href="javascript:void(0);" relation="cart_timer/front" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/upload_csv.png" height="30" width="30">
                        </a> -->

                        <br />
                      <?php } ?>

                      <?php if (in_array('entry_door_timer', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/multilangue/section/entry_door_timer" title="">
                          <?php echo $admin_sidebar['entry_door_timer']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['entry_door_timer']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/front_entry_door_timer'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/entry_door_timer/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <!-- <a target="_blank" href="admin/index/download_section_common_data/entry_door_timer" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/download.png" height="30" width="30">
                        </a>


                        <a href="javascript:void(0);" relation="entry_door_timer/front" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/upload_csv.png" height="30" width="30">
                        </a> -->

                        <br />
                      <?php } ?>

                      <?php if (in_array('contact_timer', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/multilangue/section/contact_timer" title="">
                          <?php echo $admin_sidebar['contact_timer']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['contact_timer']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/contact_timer'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/contact_timer/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <!-- <a target="_blank" href="admin/index/download_section_common_data/contact_timer" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/download.png" height="30" width="30">
                        </a>

                        <a href="javascript:void(0);" relation="contact_timer/front" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/upload_csv.png" height="30" width="30">
                        </a> -->
                        <br />
                      <?php } ?>

                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
              <?php if ($page_row_counter == 4) {
                $page_row_counter = 0;
                echo '</div><div class="row-fluid">';
              } ?>
              <?php
              if (in_array('entry_door_message', $page_access) || in_array('selection_instruction', $page_access)) {
                $page_row_counter++;
              ?>
                <div class="span3">
                  <div class="block well">
                    <div class="navbar">
                      <div class="navbar-inner">
                        <h5><?php echo $admin_sidebar['message']['admin']; ?></h5>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text"></div>
                          <input type="text" value="<?php echo $admin_sidebar['message']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/message'; ?>">
                        <?php } ?>
                        <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/message/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                    </div>
                    <div class="control-group">
                      <?php if (in_array('entry_door_message', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/multilangue/section/entry_door_message" title="">
                          <?php echo $admin_sidebar['entry_door_message']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['entry_door_message']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/entry_door_message'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/entry_door_message/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <!-- <a target="_blank" href="admin/index/download_section_common_data/entry_door_message" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/download.png" height="30" width="30">
                        </a>

                        <a href="javascript:void(0);" relation="entry_door_message/front" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/upload_csv.png" height="30" width="30">
                        </a> -->

                        <br />
                      <?php } ?>

                      <?php if (in_array('selection_instruction', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/multilangue/section/selection_instruction" title="">
                          <?php echo $admin_sidebar['selection_instruction']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['selection_instruction']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/selection_instructions'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/selection_instruction/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <!-- <a target="_blank" href="admin/index/download_section_common_data/selection_instruction" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/download.png" height="30" width="30">
                        </a>

                        <a href="javascript:void(0);" relation="selection_instruction/front" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/upload_csv.png" height="30" width="30">
                        </a> -->

                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
              <?php if ($page_row_counter == 4) {
                $page_row_counter = 0;
                echo '</div><div class="row-fluid">';
              } ?>
              <?php
              if (in_array('cart', $page_access)) {
                $page_row_counter++;
              ?>
                <div class="span3">
                  <div class="block well">
                    <div class="navbar">
                      <div class="navbar-inner">
                        <h5><?php echo $admin_sidebar['orders']['admin']; ?></h5>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text"></div>
                          <input type="text" value="<?php echo $admin_sidebar['orders']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/orders'; ?>">
                        <?php } ?>
                        <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/orders/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                    </div>
                    <div class="control-group">
                      <?php if (in_array('cart', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/orders" title="">
                          <?php echo $admin_sidebar['order_details']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['order_details']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/order_details'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/order_details/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>

                      <?php } ?>
                    </div>

                    <div class="control-group">
                      <?php if (in_array('cart', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/users" title="">
                          <?php echo $admin_sidebar['user_details']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['user_details']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/user_details'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/user_details/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>

                      <?php } ?>
                    </div>
                    <?php 
                         if ($this->config->item('limited_price_option') == "1") { ?>

                    <div class="control-group">
                      
                    <?php   if (in_array('price_requests', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/pricerequests" title="">
                          <?php echo $admin_sidebar['manage_pricerequests']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['manage_pricerequests']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/manage_pricerequests'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/manage_pricerequests/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>

                      <?php }   ?>
                    </div>
                    <?php }   ?>

                  </div>
                </div>
              <?php
              }
              ?>
              <?php if ($page_row_counter == 4) {
                $page_row_counter = 0;
                echo '</div><div class="row-fluid">';
              } ?>
              <?php
              if (in_array('users_front_entry_door', $page_access)) {
                $page_row_counter++;
              ?>
                <div class="span3">
                  <div class="block well">
                    <div class="navbar">
                      <div class="navbar-inner">
                        <h5><?php echo $admin_sidebar['users']['admin']; ?></h5>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text"></div>
                          <input type="text" value="<?php echo $admin_sidebar['users']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/users'; ?>">
                        <?php } ?>
                        <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/users/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                    </div>
                    <div class="control-group">
                      <?php if (in_array('users_front_entry_door', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/users_front_entry_door" title="">
                          <?php echo $admin_sidebar['users_list']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['users_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/users_list'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/users_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>

                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>

              <?php if ($page_row_counter == 4) {
                $page_row_counter = 0;
                echo '</div><div class="row-fluid">';
              } ?>
              <?php

              if (in_array('pages', $page_access)) {
                $page_row_counter++;
              ?>
                <div class="span3">
                  <div class="block well">
                    <div class="navbar">
                      <div class="navbar-inner">
                        <h5><?php echo $admin_sidebar['pages']['admin']; ?></h5>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text"></div>
                          <input type="text" value="<?php echo $admin_sidebar['pages']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/pages'; ?>">
                        <?php } ?>
                        <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/pages/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                    </div>
                    <div class="control-group">
                      <?php if (in_array('pages', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/homepagesetting" title=""><?php echo $admin_sidebar['pages_block']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['pages_block']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/pages_block'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/pages_block/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <br />
                      <?php } ?>
                      <?php if (in_array('navigation_setting', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/homepagesetting/navigation_setting" title=""><?php echo $admin_sidebar['navigation_setting']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['navigation_setting']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/navigation_setting'; ?>">
                        <?php } ?>
                        <!-- <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/navigation_setting/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <a target="_blank" href="admin/index/download_excel_data/navigation_pages/navigation_pages_country/title" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/download.png" height="30" width="30">
                        </a> -->
                        <br />
                      <?php } ?>
                      <?php if (in_array('banner_setting', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/homepagesetting/banner_setting" title=""><?php echo $admin_sidebar['banner_setting']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['banner_setting']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/banner_setting'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/banner_setting/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <!-- <a target="_blank" href="admin/index/download_excel_data/banner_images/banner_images_country/button_text" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/download.png" height="30" width="30">
                        </a> -->
                        <br />
                      <?php } ?>
                      <?php if (in_array('social_media_setting', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/homepagesetting/social_media_setting" title=""><?php echo $admin_sidebar['social_media_setting']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['social_media_setting']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/social_media_setting'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/social_media_setting/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <br />
                      <?php } ?>

                      <?php if (in_array('whats_new_setting', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/homepagesetting/whats_new_setting" title=""><?php echo $admin_sidebar['whats_new_setting']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['whats_new_setting']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/whats_new_setting'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/whats_new_setting/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <!-- <a target="_blank" href="admin/index/download_excel_data/whats_new/whats_new_country/heading" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/download.png" height="30" width="30">
                        </a> -->
                        <br />
                      <?php } ?>
                      <?php if (in_array('payment_accept_card_setting', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/homepagesetting/payment_accept_card_setting" title=""><?php echo $admin_sidebar['payment_accept_card_setting']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['payment_accept_card_setting']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/payment_accept_card_setting'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/payment_accept_card_setting/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <br />
                      <?php } ?>


                      <?php if (in_array('gallery', $page_access) && $this->config->item('enable_distributor_feature') == "1") {  ?>
                        <a href="admin/<?php echo $lang_id; ?>/gallery" title=""><?php echo $admin_sidebar['manage_gallery']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['manage_gallery']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/manage_gallery'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/manage_gallery/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <br />
                      <?php } ?>


                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
              <?php if ($page_row_counter == 4) {
                $page_row_counter = 0;
                echo '</div><div class="row-fluid">';
              } ?>
              <?php
              if (in_array('ups_api_setting', $page_access) || in_array('bambora_api_setting', $page_access) || in_array('stripe_api_setting', $page_access) || in_array('payment_api_setting', $page_access) || in_array('shipping_markup_setting', $page_access)) {
                $page_row_counter++;
              ?>
                <div class="span3">
                  <div class="block well">
                    <div class="navbar">
                      <div class="navbar-inner">
                        <h5><?php echo $admin_sidebar['api']['admin']; ?></h5>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text"></div>
                          <input type="text" value="<?php echo $admin_sidebar['api']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/api'; ?>">
                        <?php } ?>
                        <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/api/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                    </div>
                    <div class="control-group">
                      <?php if (in_array('ups_api_setting', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/api/shipping_api_setting" title="">
                          <?php echo $admin_sidebar['ups_api_setting']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['ups_api_setting']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/ups_api_setting'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/ups_api_setting/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                        <br />
                      <?php } ?>



                      <?php if (in_array('payment_api_setting', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/api/payment_api_setting" title="">
                          <?php echo $admin_sidebar['payment_api_setting']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['payment_api_setting']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/payment_api_setting'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/payment_api_setting/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>

                      <?php } ?>

                      <?php if (in_array('shipping_markup_setting', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/api/shipping_markup_setting" title=""><?php echo $admin_sidebar['shipping_markup_setting']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; ">
                          </div>
                          <input type="text" value="<?php echo $admin_sidebar['shipping_markup_setting']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/shipping_markup_setting'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/shipping_markup_setting/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links"><img src="assets/uploads/global.jpg" height="20" width="20"></a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
              <?php if ($page_row_counter == 4) {
                $page_row_counter = 0;
                echo '</div><div class="row-fluid">';
              } ?>
              <?php
              if (in_array('package', $page_access)) {
                $page_row_counter++;
              ?>
                <div class="span3">
                  <div class="block well">
                    <div class="navbar">
                      <div class="navbar-inner">
                        <h5><?php echo $admin_sidebar['package']['admin']; ?></h5>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text"></div>
                          <input type="text" value="<?php echo $admin_sidebar['package']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/package'; ?>">
                        <?php } ?>
                        <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/package/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                    </div>
                    <div class="control-group">
                      <?php if (in_array('package', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/package" title="">
                          <?php echo $admin_sidebar['package_block']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['package_block']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/package_block'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/package_block/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>

                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
              <?php if ($page_row_counter == 4) {
                $page_row_counter = 0;
                echo '</div><div class="row-fluid">';
              } ?>
              <?php
              if (in_array('global_settings', $page_access)) {
                $page_row_counter++;
              ?>
                <div class="span3">
                  <div class="block well">
                    <div class="navbar">
                      <div class="navbar-inner">
                        <h5><?php echo $admin_sidebar['global_settings']['admin']; ?></h5>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text"></div>
                          <input type="text" value="<?php echo $admin_sidebar['global_settings']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/global_settings'; ?>">
                        <?php } ?>
                        <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/global_settings/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                    </div>
                    <div class="control-group">
                      <?php if (in_array('global_settings', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/index/global_settings" title="">
                          <?php echo $admin_sidebar['global_settings_menu']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['global_settings_menu']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/global_settings_menu'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/global_settings_menu/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>

                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>

              <?php if ($page_row_counter == 4) {
                $page_row_counter = 0;
                echo '</div><div class="row-fluid">';
              } ?>
              <?php if (in_array('contact_user', $page_access) || in_array('contact_message', $page_access)) {
                $page_row_counter++; ?>
                <div class="span3">
                  <div class="block well">
                    <div class="navbar">
                      <div class="navbar-inner">
                        <h5><?php echo $admin_sidebar['contact_user']['admin']; ?></h5>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text"></div>
                          <input type="text" value="<?php echo $admin_sidebar['contact_user']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/contact_user'; ?>">
                        <?php } ?>
                        <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/contact_user/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                    </div>
                    <div class="control-group">
                      <?php if (in_array('contact_user', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/contact" title=""> <?php echo $admin_sidebar['contact_user_list']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['contact_user_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/contact_user_list'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/contact_user_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      <?php } ?>

                      <?php if (in_array('contact_message', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/multilangue/section/contact_message" title=""> <?php echo $admin_sidebar['contact_message']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['contact_message']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/contact_message'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/contact_message/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
              <?php if (in_array('contact_user', $page_access) || in_array('contact_message', $page_access)) {
                $page_row_counter++; ?>
                <div class="span3">
                  <div class="block well">
                    <div class="navbar">
                      <div class="navbar-inner">
                        <h5><?php echo $admin_sidebar['credit_term']['admin']; ?></h5>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text"></div>
                          <input type="text" value="<?php echo $admin_sidebar['credit_term']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/credit_term'; ?>">
                        <?php } ?>
                        <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/credit_term/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      </div>
                    </div>
                    <div class="control-group">
                      <?php if (in_array('credit_term_list', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/creditterm/settings" title=""> <?php echo $admin_sidebar['credit_term_settings']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['credit_term_settings']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/credit_term_settings'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/credit_term_settings/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      <?php } ?>

                      <?php if (in_array('credit_term_list', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/creditterm" title=""> <?php echo $admin_sidebar['credit_term_requests']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['credit_term_requests']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/credit_term_requests'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/credit_term_requests/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      <?php } ?>


                      <?php if (in_array('refferaluser_list', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/referralusers" title=""> <?php echo $admin_sidebar['refferaluser_list']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['refferaluser_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/refferaluser_list'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/refferaluser_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      <?php } ?>
                      <br>

                      <?php if (in_array('discount_list', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/discounts" title=""> <?php echo $admin_sidebar['discount_list']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['discount_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/discount_list'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/discount_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      <?php } ?>
                      <br>
                      <?php if (in_array('discountusers_list', $page_access)) { ?>
                        <a href="admin/<?php echo $lang_id; ?>/discountsusers" title=""> <?php echo $admin_sidebar['discountusers_list']['admin']; ?></a>
                        <?php if ($lang_id == $primary_lang) { ?>
                          <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                          <input type="text" value="<?php echo $admin_sidebar['discountusers_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                          <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/discountusers_list'; ?>">
                        <?php } ?>
                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/discountusers_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                          <img src="assets/uploads/global.jpg" height="20" width="20">
                        </a>
                      <?php } ?>

                    </div>
                  </div>
                </div>
              <?php
              }
              ?>


<?php
             if (in_array('distributors', $page_access) && $this->config->item('enable_distributor_feature') == "1") {
                $page_row_counter++;
              ?>
                  <div class="span3">
                    <div class="block well">
                      <div class="navbar">
                        <div class="navbar-inner">
                          <h5><?php echo $admin_sidebar['manage_distributor']['admin']; ?></h5>
                          <?php if ($lang_id == $primary_lang) { ?>
                            <div class="edit_text"></div>
                            <input type="text" value="<?php echo $admin_sidebar['manage_distributor']['admin']; ?>" class="edit_input_text" style="display: none;">
                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/manage_distributor'; ?>">
                          <?php } ?>
                          <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/manage_distributor/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                            <img src="assets/uploads/global.jpg" height="20" width="20">
                          </a>
                        </div>
                      </div>
                      <div class="control-group">
                        <?php if (in_array('distributors', $page_access)) { ?>
                          <a href="admin/<?php echo $lang_id; ?>/distributor" title="">
                            <?php echo $admin_sidebar['distributor_list']['admin']; ?></a>
                          <?php if ($lang_id == $primary_lang) { ?>
                            <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                            <input type="text" value="<?php echo $admin_sidebar['distributor_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/distributor_list'; ?>">
                          <?php } ?>
                          <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/distributor_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                            <img src="assets/uploads/global.jpg" height="20" width="20">
                          </a>

                        <?php } ?>
                      </div>
                    </div>
                  </div>
              <?php
              }
              ?>










              <?php echo '</div>'; ?>
              <hr />
            <?php } ?>

            <?php if (in_array('admin_static_links', $page_access) || in_array('admin_products', $page_access) || in_array('admin_title', $page_access) || in_array('email_instruction', $page_access) || in_array('adminrole', $page_access) || in_array('adminuser', $page_access) || in_array('admin_blocks_list', $page_access) || in_array('admin_door_timer', $page_access) || in_array('sales_order_section', $page_access) || in_array('sales_order_block', $page_access) || in_array('stock_code_info', $page_access) || in_array('stock_line_info', $page_access) || in_array('tax_rate', $page_access) || in_array('ups_errors', $page_access) || in_array('ups_service_code_description', $page_access) || in_array('bambora_errors', $page_access) || in_array('stripe_errors', $page_access)) { ?>
              <div class="row-fluid">
                <div class="span12">
                  <h5 class="d_links_heading"><?php echo $admin_sidebar['back_end_section_management']['admin']; ?></h5>
                  <?php if ($lang_id == $primary_lang) { ?>
                    <div class="edit_text"></div>
                    <input type="text" value="<?php echo $admin_sidebar['back_end_section_management']['admin']; ?>" class="edit_input_text" style="display: none;">
                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/back_end_section_management'; ?>">
                  <?php } ?>
                  <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/back_end_section_management/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                    <img src="assets/uploads/global.jpg" height="20" width="20">
                  </a>
                </div>
              </div>
            <?php } ?>
            <?php
            $page_row_counter = 0;
            if ($page_row_counter == 0) {
              echo '<div class="row-fluid">';
            }
            ?>

            <?php
            if (in_array('admin_static_links', $page_access) || in_array('admin_products', $page_access) || in_array('admin_title', $page_access)) {
              $page_row_counter++;
            ?>
              <div class="span3">
                <div class="block well">
                  <div class="navbar">
                    <div class="navbar-inner">
                      <h5><?php echo $admin_sidebar['admin_translation']['admin']; ?></h5>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text"></div>
                        <input type="text" value="<?php echo $admin_sidebar['admin_translation']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_translation'; ?>">
                      <?php } ?>
                      <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_translation/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                    </div>
                  </div>
                  <div class="control-group">
                    <?php if (in_array('admin_static_links', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/multilangue/section/admin_static_links" title="">
                        <?php echo $admin_sidebar['admin_static_links']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['admin_static_links']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_static_links'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_static_links/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_section_common_data/admin_static_links" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a>

                      <a href="javascript:void(0);" relation="admin_static_links/front" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/upload_csv.png" height="30" width="30">
                      </a> -->
                      <br />
                    <?php } ?>

                    <?php if (in_array('admin_products', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/multilangue/section/admin_products" title="">
                        <?php echo $admin_sidebar['admin_products']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['admin_products']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_products'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_products/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_section_common_data/admin_products" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a>

                      <a href="javascript:void(0);" relation="admin_products/front" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/upload_csv.png" height="30" width="30">
                      </a> -->

                      <br />
                    <?php } ?>

                    <?php if (in_array('admin_title', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/multilangue/section/admin_title" title="">
                        <?php echo $admin_sidebar['admin_title']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['admin_title']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_title_instructions'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_title/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_section_common_data/admin_title" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a>


                      <a href="javascript:void(0);" relation="admin_title/front" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/upload_csv.png" height="30" width="30">
                      </a> -->
                      <br />
                    <?php } ?>

                    <?php if (in_array('email_instruction', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/multilangue/section/email_instruction" title="">
                        <?php echo $admin_sidebar['email_instruction']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['email_instruction']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_email_instructions'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/email_instruction/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                    <?php } ?>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
            <?php if ($page_row_counter == 4) {
              $page_row_counter = 0;
              echo '</div><div class="row-fluid">';
            } ?>

            <?php
            if (in_array('adminrole', $page_access) || in_array('adminuser', $page_access)) {
              $page_row_counter++;
            ?>
              <div class="span3">
                <div class="block well">
                  <div class="navbar">
                    <div class="navbar-inner">
                      <h5><?php echo $admin_sidebar['admin']['admin']; ?></h5>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text"></div>
                        <input type="text" value="<?php echo $admin_sidebar['admin']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin'; ?>">
                      <?php } ?>
                      <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                    </div>
                  </div>
                  <div class="control-group">
                    <?php if (in_array('adminrole', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/adminrole" title="">
                        <?php echo $admin_sidebar['admin_roles']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['admin_roles']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_roles'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_roles/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <br />
                    <?php } ?>

                    <?php if (in_array('adminuser', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/adminuser" title="">
                        <?php echo $admin_sidebar['admin_users']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['admin_users']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_users'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_users/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                    <?php } ?>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
            <?php if ($page_row_counter == 4) {
              $page_row_counter = 0;
              echo '</div><div class="row-fluid">';
            } ?>
            <?php
            if (in_array('admin_blocks_list', $page_access)) {
              $page_row_counter++;
            ?>
              <div class="span3">
                <div class="block well">
                  <div class="navbar">
                    <div class="navbar-inner">
                      <h5><?php echo $admin_sidebar['admin_block']['admin']; ?></h5>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text"></div>
                        <input type="text" value="<?php echo $admin_sidebar['admin_block']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_block'; ?>">
                      <?php } ?>
                      <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_block/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                    </div>
                  </div>
                  <div class="control-group">
                    <?php if (in_array('admin_blocks_list', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/admin_blocks_list" title="">
                        <?php echo $admin_sidebar['admin_user_block_list']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['admin_user_block_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_user_block_list'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_user_block_list/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                    <?php } ?>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
            <?php if ($page_row_counter == 4) {
              $page_row_counter = 0;
              echo '</div><div class="row-fluid">';
            } ?>
            <?php
            if (in_array('admin_door_timer', $page_access)) {
              $page_row_counter++;
            ?>
              <div class="span3">
                <div class="block well">
                  <div class="navbar">
                    <div class="navbar-inner">
                      <h5><?php echo $admin_sidebar['admin_timer']['admin']; ?></h5>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text"></div>
                        <input type="text" value="<?php echo $admin_sidebar['admin_timer']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/admin_timer'; ?>">
                      <?php } ?>
                      <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_timer/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>

                    </div>
                  </div>
                  <div class="control-group">
                    <?php if (in_array('admin_door_timer', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/multilangue/section/admin_door_timer" title="">
                        <?php echo $admin_sidebar['admin_door_timer']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['admin_door_timer']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/timer_admin_entry_door'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/admin_door_timer/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_section_common_data/admin_door_timer" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a>
                      <a href="javascript:void(0);" relation="admin_door_timer/front" class="fancybox language_csv_upload_btn multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/upload_csv.png" height="30" width="30">
                      </a> -->

                    <?php } ?>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
            <?php if ($page_row_counter == 4) {
              $page_row_counter = 0;
              echo '</div><div class="row-fluid">';
            } ?>
            <?php
            if (in_array('sales_order_section', $page_access) || in_array('sales_order_block', $page_access) || in_array('stock_code_info', $page_access) || in_array('stock_line_info', $page_access) || in_array('tax_rate', $page_access) || in_array('ups_errors', $page_access) || in_array('ups_service_code_description', $page_access) || $active == in_array('bambora_errors', $page_access) || in_array('stripe_errors', $page_access)) {
              $page_row_counter++;
            ?>
              <div class="span3">
                <div class="block well">
                  <div class="navbar">
                    <div class="navbar-inner">
                      <h5><?php echo $admin_sidebar['sales_order']['admin']; ?></h5>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text"></div>
                        <input type="text" value="<?php echo $admin_sidebar['sales_order']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/sales_order'; ?>">
                      <?php } ?>
                      <a style="padding: 10px 0px 0px 7px !important;" target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/sales_order/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                    </div>
                  </div>
                  <div class="control-group">


                    <?php if (in_array('tax_rate', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/tax_rate" title="">
                        <?php echo $admin_sidebar['tax_rate']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['tax_rate']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/tax_rate'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/tax_rate/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <br />
                    <?php } ?>

                    <?php if (in_array('ups_errors', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/errors/index/ups_errors" title="">
                        <?php echo $admin_sidebar['ups_errors']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['ups_errors']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/ups_errors'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/ups_errors/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_excel_data/ups_errors/ups_errors_country" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a> -->
                      <br />
                    <?php } ?>

                    <?php if (in_array('ups_service_code_description', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/errors/index/ups_service_code_description" title="">
                        <?php echo $admin_sidebar['ups_service_code_description']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['ups_service_code_description']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/ups_service_code_description'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/ups_service_code_description/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_excel_data/ups_service_code_description/ups_service_code_description_country/description" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a> -->
                      <br />
                    <?php } ?>

                    <?php if (in_array('bambora_errors', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/errors/index/bambora_errors" title="">
                        <?php echo $admin_sidebar['bambora_errors']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['bambora_errors']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/bambora_errors'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/bambora_errors/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_excel_data/admin_bambora_errors/admin_bambora_errors_country" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a> -->
                      <br />
                    <?php } ?>

                    <?php if (in_array('stripe_errors', $page_access)) { ?>
                      <a href="admin/<?php echo $lang_id; ?>/errors/index/stripe_errors" title="">
                        <?php echo $admin_sidebar['stripe_errors']['admin']; ?></a>
                      <?php if ($lang_id == $primary_lang) { ?>
                        <div class="edit_text" style="display: inline-block; margin:0px 0px 0px 5px; float: unset; "></div>
                        <input type="text" value="<?php echo $admin_sidebar['stripe_errors']['admin']; ?>" class="edit_input_text" style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_sidebar/stripe_errors'; ?>">
                      <?php } ?>
                      <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_sidebar/stripe_errors/admin" class="fancybox multi_language_common_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                      </a>
                      <!-- <a target="_blank" href="admin/index/download_excel_data/stripe_errors/stripe_errors_country" class="fancybox multi_language_edit admin_globe globe_left_menu_links">
                        <img src="assets/uploads/download.png" height="30" width="30">
                      </a> -->

                    <?php } ?>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>

            <?php echo '</div>'; ?>

            <div class="separator-doubled"></div>

            <!-- Loaders, tooltips -->
            <div class="row-fluid">

              <!-- Column -->
              <div class="span6">


              </div>
              <!-- /column -->


            </div>
            <!-- /loaders/ tooltips -->

          </div>
          <!-- /content container -->

        </div>
      </div>
    </div>
  </div>
  <!-- /content -->

  <!-- Right sidebar -->
  <div class="sidebar" id="right-sidebar">

  </div>
  <!-- /right sidebar -->
</div>
<!-- /main wrapper -->


<?php
$data['lang_id']           = $lang_id;
$data['admin_title']       = $admin_title;
$this->load->view('admin/element/language_csv_form', $data); ?>


<span class="displaynon" id="formvalidation_language_csv_file"><?php echo $admin_title['csv_file']['front']; ?> </span>
<span class="displaynon" id="formvalidation_language_csv_file_type"><?php echo $admin_title['csv_file_type']['front']; ?> </span>

<span class="displaynon" id="formvalidation_language_csv_file_size"><?php echo $admin_title['csv_file_size']['front']; ?> </span>
<span class="displaynon" id="formvalidation_language_csv_file_success"><?php echo $admin_title['csv_file_success']['front']; ?>
</span>
<span class="displaynon" id="formvalidation_language_csv_file_fail"><?php echo $admin_title['csv_file_error']['front']; ?>
</span>
<span class="displaynon" id="formvalidation_language_csv_file_format"><?php echo $admin_title['csv_file_format']['front']; ?>
</span>