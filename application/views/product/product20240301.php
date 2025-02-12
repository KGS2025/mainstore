<?php

$comingsoon = getNoImage('coming-soon');
$cart = $this->session->userdata('cart');
$currencyV = getDefaultCurrencyCode('l') . '_currency';
$priceV    = 'price';
$currency  = $general_instruction->$currencyV;
$loggedUserId = getFrontenduserId();
$remaining_time = isset($front_validuser_data['remaining_time']) ? $front_validuser_data['remaining_time'] : 0;
$loggedUserData = loginuserdata();

?>
<?php $filter_option = ($this->session->userdata('filter_option')) ?  $this->session->userdata('filter_option') : ""; ?>

<style>
.example-image-link.empty-img {
    height: 200px !important;
}

.product-list-list.filter-list .empty-img img.img-responsive {
    height: 170px;
    position: relative;
}
</style>

<div class="mainContent px-3 px-lg-5">
    <div class="mobile-bnr float-start w-100">
        <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;overflow:hidden;visibility:hidden;">
            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;overflow:hidden;"></div>
        </div>
    </div>

    <?php $this->load->view('elements/body_logo'); ?>

    <div class="ct-videoSection">
        <div class="ct-services">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="ct-team-box p-0">
                    <div class="common-search float-start w-100 my-3">
                        <div class="text-header">
                            <?php $this->load->view('elements/search'); ?>
                        </div>
                    </div>

                    <div class="home-quick-search-wrap float-start w-100">
                        <?php $this->load->view('elements/quicksearch'); ?>
                    </div>
                    <div class="ProductNote float-start w-100 py-5 text-center search_radio">
                        <?php if ($all_data['home_product_heading_status'] == 1) { ?>
                            <h1 style="padding-bottom: 5px;color:#<?php echo $all_data['category_label_txt_color']; ?> !important;font-size: 25px;text-transform: none;"><?php echo $all_data['products'] ?></h1>
                        <?php } ?>

                        <?php if ($all_data['instruction_section_status'] == 1) { ?>
                            <div class="red1 w-75 m-auto" style="color:#<?php echo $all_data['select_category_color_text']; ?>"><span class="fontblack" style="color:#<?php echo $all_data['select_category_color']; ?>;"><?php echo $general_instruction->selection_instruction; ?> </span><?php echo $selection_instruction->product_msg; ?></div>
                        <?php } ?>
                    </div>
                    <div class="main-page-product">
                        <div class="car-lists text-center productbaselisting">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?php include('product_timer.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="car-lists productbaselisting float-start w-100">
        <form class="float-start w-100" action="<?php echo base_url() . $lang_id . '/'; ?>products/product_maker" id="products_catagory_list_form" enctype="multipart/form-data" method="post" autocomplete="off">
            <input type="hidden" id="cart_block_timer" name="cart_block_timer" value="<?php echo $cart_timer->cart_block_timer; ?>" />
            <div class="product-list float-start w-100">
                <div class="w-100 text-white mb-5 search_radio">
                    <?php
                    $hide_category = isset($all_data['quick_search_hide_category']) ? $all_data['quick_search_hide_category'] : 0;
                    if (isset($all_data['default_quick_search']) && $all_data['default_quick_search'] == 'category') {
                        $default_quick_search = $hide_category == 0 ? 'category' : 'brand';
                    } else if (isset($all_data['default_quick_search'])) {
                        $default_quick_search = $all_data['default_quick_search'];
                    } else {
                        $default_quick_search = 'category';
                    }

                    if (!empty($filter_option)) {
                        $default_quick_search = $filter_option;

                        if ($hide_category == 0 &&  $default_quick_search == "brand") {
                            $default_quick_search = "category";
                        }

                        if ($hide_category == 1 &&  $default_quick_search == "category") {
                            $default_quick_search = "brand";
                        }
                    }


                    ?>
                    <div class="form-check form-check-inline ps-0 position-relative">
                        <input class="form-check-input filter_option" type="radio" name="filter_option" id="radio1" value="category" <?php if ($default_quick_search == 'category') {
                                                                                                                                            echo 'checked';
                                                                                                                                        } ?>>
                        <label class="form-check-label" for="radio1"><?php echo $general_instruction->search_product_by_vehicle_type; ?></label>
                    </div>


                    <div class="form-check form-check-inline ps-0 position-relative">
                        <input class="form-check-input filter_option" type="radio" name="filter_option" id="radio2" value="brand" <?php if ($default_quick_search == 'brand') {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>>
                        <label for="radio2" class="form-check-label" for="inlineRadio1"><?php echo $general_instruction->search_product_by_brand_type; ?></label>
                    </div>

                    <div class="form-check form-check-inline ps-0 position-relative">
                        <input class="form-check-input filter_option" type="radio" name="filter_option" id="radio3" value="product-group" <?php if ($default_quick_search == 'product-group') {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>>
                        <label for="radio3" class="form-check-label" for="inlineRadio1"><?php echo $general_instruction->search_product_by_product_type; ?></label>
                    </div>
                    <?php if ($this->config->item('hide_industry') == "0") { ?>
                        <div class="form-check form-check-inline ps-0 position-relative">
                            <input class="form-check-input filter_option" type="radio" name="filter_option" id="radio4" value="industry-type" <?php if ($default_quick_search == 'industry-type') {
                                                                                                                                                    echo 'checked';
                                                                                                                                                } ?>>
                            <label for="radio4" class="form-check-label" for="inlineRadio1"><?php echo $general_instruction->search_product_by_industry; ?></label>
                        </div>
                    <?php } ?>

                    <?php if ($this->config->item('hide_product_list') == "0" && ($this->config->item('product_list_show_to_guest_user') == "1" || !empty($loggedUserId) ) ) {
 ?>
                        <div class="form-check form-check-inline ps-0 position-relative">
                            <input class="form-check-input filter_option" type="radio" name="filter_option" id="radio4" value="product-list" <?php if ($default_quick_search == 'product-list') {
                                                                                                                                                    echo 'checked';
                                                                                                                                                } ?>>
                            <label for="radio4" class="form-check-label" for="inlineRadio1"><?php echo $general_instruction->search_product_by_product; ?></label>
                        </div>
                    <?php } ?>


                </div>
                <div class="category-list filter-list <?php if ($disable_multiselect == 1) echo "disable-multi-select";?>" style="<?php if ($default_quick_search != 'category') {
                                                                    echo 'display: none;';
                                                                } ?>">
                    <span id="vehicle_check_all_btn" class="custom_btn mb-3 d-inline-flex align-items-center position-relative">
                        <input id="checkbox_vehicle" <?php if ($disable_multiselect == 1) echo " disabled ";?> class="category-list-box" type="checkbox" name="vehicle_option[]" value="all">
                        <label for="checkbox_vehicle"></label>
                        <span><?php echo $general_instruction->select_all; ?>(<span id="vehicle_categories_num"><?php echo count($vehicle_categories); ?></span>)</span>
                    </span>

                    <?php if($this->config->item('show_dropdown_in_search_pages') == "1") { ?>

					<div class="cl-filter p-3">
                    <?php if ($this->config->item('show_dropdown_description') == "1") { ?> 

						<h5 class="h5 clf-title">
                        <?php echo $product_instruction->dropdown_instrunction; ?>
                       </h5>
                       <?php } ?>
						<div class="control-group"  style="width: 100%" >
							
						<label class="control-label"> <?php echo $product_instruction->dropdown_categry; ?> </label>
						<div class="controls">
						<select class="category_new_drop focustip span12" name="vehicle_category_id[]" multiple="multiple" required <?php echo ($disable_multiselect?"disabled":""); ?>>
						</select>
						</div>
						<span id='attribute_file_validate' class='error displaynon'></span>
						</div>
					</div>

                    <?php } ?>


                 <div id="vehicle_type_block" class="float-start w-100">
                        <div class="AllProducts">
                           
                        </div>
                    </div>
                    <?php if ($num_vehicle_type_for_menu > count($vehicle_categories)) { ?>
                        <div class="float-start w-100 d-flex align-items-center justify-content-center">
                            <div id="more_button_vehicle_types" class="load-more-data kgtloadmore"> <?= $general_instruction->load_more_vehicle_type; ?> </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="brand-list filter-list <?php if ($disable_multiselect == 1) echo "disable-multi-select";?>" style="<?php if ($default_quick_search != 'brand') {
                                                                echo 'display: none;';
                                                            } ?>">
                    <span id="brand_check_all_btn" class="custom_btn mb-3 d-inline-flex align-items-center position-relative">
                        <input id="checkbox_brand" class="styled-checkbox" type="checkbox" name="brand_option[]" value="all" <?php echo ($disable_multiselect?"disabled":""); ?>>
                        <label for="checkbox_brand"></label>
                        <span for="checkbox_brand"><?php echo $general_instruction->select_all; ?>(<span id="brand_num"><?php echo count($makers_list); ?></span>)</span>
                    </span>
                    <?php if($this->config->item('show_dropdown_in_search_pages') == "1") { ?>
					<div class="cl-filter p-3">
                    <?php if ($this->config->item('show_dropdown_description') == "1") { ?> 

						<h5 class="h5 clf-title"><?php echo $product_instruction->dropdown_instrunction;  ?></h5>
						<?php }?>
                        <div class="control-group"  style="width: 100%" >
						<label class="control-label"> <?php echo $product_instruction->dropdown_maker; ?> </label>
						<div class="controls">
						<select class="maker_new_drop focustip span12" name="maker_id_dropdown[]" multiple="multiple" required <?php echo ($disable_multiselect?"disabled":""); ?>>
						</select>
						</div>
						<span id='attribute_file_validate' class='error displaynon'></span>
						</div>
					</div>

                    <?php } ?>
                    <div id="maker_block" class="float-start w-100">
                        <div class="AllProducts">
                         </div>
                    </div>
                    <?php if ($num_makers > count($makers_list)) { ?>
                        <div class="float-start w-100 d-flex align-items-center justify-content-center">
                            <div id="more_button_maker_types" class="load-more-data kgtloadmore w-auto m-auto"> <?= $general_instruction->load_more_product_maker; ?> </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="product-group-list filter-list <?php if ($disable_multiselect == 1) echo "disable-multi-select";?>" style="<?php if ($default_quick_search != 'product-group') {
                                                                        echo 'display: none;';
                                                                    } ?>">
																	
					<span id="product_check_all_btn" class="custom_btn mb-3 d-inline-flex align-items-center position-relative">
                        <input id="checkbox_product_option" class="styled-checkbox" type="checkbox" name="product_option[]" value="all" <?php echo ($disable_multiselect?"disabled":""); ?>>
                        <label></label>
                        <span for="checkbox_product_option"><?php echo $general_instruction->select_all; ?>(<span id="menu_product_types_num"><?php echo count($menu_product_types); ?></span>)</span>
                    </span>

                    <?php if($this->config->item('show_dropdown_in_search_pages') == "1") { ?>

					<div class="cl-filter p-3">
                    <?php if ($this->config->item('show_dropdown_description') == "1") { ?> 

						<h5 class="h5 clf-title"><?php echo $product_instruction->dropdown_instrunction;  ?></h5>
                        <?php } ?>
						<div class="control-group" style="width: 100%"> 
							<label class="control-label">  <?php echo $product_instruction->dropdown_type; ?> </label>
							<div class="controls">
								<select class="group_new_drop focustip span12" name="product_type_id_drp[]" multiple="multiple" required <?php echo ($disable_multiselect?"disabled":""); ?>>
								 </select>
							</div>
							<span id='attribute_file_validate' class='error displaynon'></span>
						</div>
					</div>

                    <?php } ?>
                        <div id="menu_product_types_block" class="float-start w-100">
                         <div class="AllProducts">
                        </div>
                    </div>
                       <?php if ($num_product_type_for_menu > count($menu_product_types)) { ?>
                        <div class="float-start w-100 d-flex align-items-center justify-content-center">
                            <div id="more_button_product_types" class="load-more-data kgtloadmore"> <?= $general_instruction->load_more_product_type; ?> </div>
                        </div>
                    <?php } ?>
                </div>

                <?php if ($this->config->item('hide_industry') == "0") { ?>
                 
                    <div class="industry-type-list filter-list <?php if ($disable_multiselect == 1) echo "disable-multi-select";?>" style="<?php if ($default_quick_search != 'industry-type') {
                                                                            echo 'display: none;';
                                                                        } ?>">
                        <span id="product_check_all_btn" class="custom_btn mb-3 d-inline-flex align-items-center position-relative">
                            <input id="indus_all" class="styled-checkbox" type="checkbox" name="indus_all" value="all" <?php echo ($disable_multiselect?"disabled":""); ?>>
                            <label></label>
                            <span for="checkbox_product_option"><?php echo $general_instruction->select_all; ?>(<span id="menu_product_types_num"><?php echo $num_industry_list; ?></span>)</span>
                        </span>

                        <?php if($this->config->item('show_dropdown_in_search_pages') == "1") { ?>

						
						<div class="cl-filter p-3">
                        <?php if ($this->config->item('show_dropdown_description') == "1") { ?> 

							<h5 class="h5 clf-title"><?php echo $product_instruction->dropdown_instrunction;  ?></h5>
                            <?php } ?>
							<div class="control-group" style="width: 100%"> 
								<label class="control-label"> <?php echo $product_instruction->dropdown_indust; ?>  </label>
								<div class="controls">
									<select class="group_new_drop_ind focustip span12" name="industry_type[]" multiple="multiple" required <?php echo ($disable_multiselect?"disabled":""); ?>>
									   </select>
								</div>
								<span id='attribute_file_validate' class='error displaynon'></span>
							</div>
						</div>

                        <?php }  ?>


                        <div id="menu_industry_types_block" class="float-start w-100">
                            <div class="AllProducts">
                                <?php foreach ($industry_list as $inds_type) { ?>
                                    <div class="ProductBlock" style="margin-bottom: 20px;">
                                        <div class="VehicleBlockItems h-float">
                                            <div class="pro-item product_type_image_wrap stepind product_group_image_wrap">
                                                <div class="overflowhidden">
                                                    <a href="javascript:void(0);" class="product_image_wrap" data-rel="<?php echo $inds_type['id']; ?>">
                                                        <?php if (isset($inds_type['icon']) && $inds_type['icon'] != '' && file_exists("assets/uploads/industries/" . $inds_type['icon'])) { ?>
                                                            <img src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo asset_url(); ?>assets/uploads/industries/<?php echo $inds_type['icon']; ?>" class="img-responsive" alt="image-<?php echo $pro_type['name']; ?>" id="image_id_<?php echo $inds_type['id']; ?>" />
                                                        <?php } else { ?>
                                                            <img src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo $comingsoon; ?>" alt="coming soon" class="img-responsive" id="image_id_<?php echo $inds_type['id']; ?>" />
                                                        <?php } ?>
                                                    </a>
                                                    <input type="hidden" name="industry_type[]" value="" class="product_types_id">
                                                </div>
                                                <a href="javascript:void(0);" class="btn  Type_title actn-btn"><?php echo $lang_id != 'en' && !empty($inds_type['lang_name']) ? $inds_type['lang_name'] : $inds_type['name']; ?><span class="element_desc"> <?php echo $lang_id != 'en' && !empty($inds_type['lang_description']) ? $inds_type['lang_description'] : $inds_type['description']; ?> </span></a>


                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        
                    </div>

                <?php  } ?>

                <?php if ($this->config->item('hide_product_list') == "0" && ($this->config->item('product_list_show_to_guest_user') == "1" || !empty($loggedUserId) ) ) { ?>
                    <div class="product-list-list filter-list <?php if ($disable_multiselect == 1) echo "disable-multi-select";?>" style="<?php if ($default_quick_search != 'product-list') {
                                                                            echo 'display: none;';
                                                                        } ?>">
                       
                        <?php if($this->config->item('show_dropdown_in_search_pages') == "1") { ?>


                            <div class="cl-filter p-3">
                            <?php if ($this->config->item('show_dropdown_description') == "1") { ?> 

                                    <h5 class="h5 clf-title"><?php echo $product_instruction->dropdown_instrunction;  ?></h5>
                                    <?php } ?>
                                    <div class="control-group"  style="width: 100%" >
                                    <label class="control-label"> <?php echo $product_instruction->dropdown_product; ?> </label>
                                    <div class="controls">
                                    <select class="products_new_drop focustip span12" name="product_id_form[]" multiple="multiple" required>
                                    </select>
                                    </div>
                                    <span id='product_id_form_validate' class='error displaynon'></span>
                                    <a href="#" class="clf-addcart mutiple_addtocart"><?= $general_instruction->addtocart; ?></a>
                                    </div>
                            </div>
               
                        <?php } ?>


                        <div id="menu_product_list_block" class="float-start w-100">
							<div class="prod_sort">
								<label><?= $general_instruction->sort_by; ?></label>
								<select class="prod_sort-select">
                                    <option value=""><?= $general_instruction->select; ?></option>
									<option value="price_low_high"><?= $general_instruction->price_low_high; ?></option>
									<option value="price_high_low"><?= $general_instruction->price_high_low; ?></option>
								</select>
							</div>
                            <div class="AllProducts">
                             </div>
                        </div>

                        <?php if ($num_product_list > count($product_list)) { ?>
                            <div class="float-start w-100 d-flex align-items-center justify-content-center">
                                <div id="more_button_home_product_list" class="load-more-data kgtloadmore"> <?= $general_instruction->load_more; ?> </div>
                            </div>
                        <?php }   ?>
                    </div>

                <?php  } ?>

                <div class="nav-prex-next text-right removebuttons productBtns" style="<?php if ($default_quick_search == 'product-list') {
                                                                                            echo 'display: none; margin-top: 10px;';
                                                                                        } else {
                                                                                            echo ' margin-top: 10px;';
                                                                                        } ?>">
                    <div class="col-md-12">
                        <?php if ($all_data['next_btn_user_msg_status'] == 1) { ?>
                            <p class="next-btn-msg"> (<?php echo $general_instruction->next_btn_msg; ?>)</p>
                        <?php } ?>
                        <a href="javascript:void(0);" class="btn  actn-btn rounded" id="product_catagory_next"><?php echo $general_instruction->next; ?></a>
                    </div>
                </div>
            </div>
            <input type="submit" value="Submit" style="display:none;">
        </form>
    </div>
    <span class="displaynon" id="maincart_block_msg"><?php if (isset($selection_instruction->maincart_block_msg)) echo $selection_instruction->maincart_block_msg; ?></span>
    <span class="displaynon" id="editcart_block_msg"><?php if (isset($selection_instruction->editcart_block_msg)) echo $selection_instruction->editcart_block_msg; ?></span>
    <span class="displaynon" id="cartpreview_block_msg"><?php if (isset($selection_instruction->cartpreview_block_msg)) echo $selection_instruction->cartpreview_block_msg; ?></span>
    <span class="displaynon" id="cartverification_block_msg"><?php if (isset($selection_instruction->cartverification_block_msg)) echo $selection_instruction->cartverification_block_msg; ?></span>
    <span class="displaynon" id="block_notification_msg"><?php if (isset($selection_instruction->block_notification_msg)) echo $selection_instruction->block_notification_msg; ?></span>
    <span class="displaynon" id="cartverification_resent_block_msg"><?php if (isset($selection_instruction->cartverification_resent_block_msg)) echo $selection_instruction->cartverification_resent_block_msg; ?></span>
    <span class="displaynon" id="cartverification_wrong_block_msg"><?php if (isset($selection_instruction->cartverification_wrong_block_msg)) echo $selection_instruction->cartverification_wrong_block_msg; ?></span>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 s_button sticky_bottom productBtnsFixedBottom py-2 py-md-3 px-3 px-md-5" style="<?php if ($default_quick_search == 'product-list') {
                                                                                                                                            echo 'display: none;';
                                                                                                                                        } ?>">
        <div class="nav-prex-next sticky_button_next flex-wrap align-items-center justify-content-between w-100">
            <?php if ($all_data['next_btn_user_msg_status'] == 1) { ?>
                <p class="next-btn-msg d-inline-block mb-2"> (<?php echo $general_instruction->next_btn_msg; ?>)</p>
            <?php } ?>
            <div class="productActionBtns d-flex align-items-center">
                <a href="javascript:void(0);" class="btn rounded header-footer-sticky-btn actn-btn cart_submit_btn_color" id="product_catagory_next_footer" <?php if ($disable_multiselect == 1) {echo "style='display:none'";};?>><?php echo $general_instruction->next; ?></a>
            </div>
        </div>
    </div>
</div>

<!--Modal Custom warning start-->
<?php $this->load->view('elements/popup/custom_warning_popup'); ?>
<!--Modal Custom warning end-->


<!--Modal Custom warning start-->
<?php $this->load->view('elements/popup/productlist_warning_popup'); ?>
<!--Modal Custom warning end-->


<!--Modal user block popup start-->
<?php $this->load->view('elements/popup/user_block_box'); ?>
<!--Modal user block popup end-->

<input type="hidden" id="num_vehicle_type_for_menu" value="<?php echo $num_vehicle_type_for_menu; ?>" loaded="0">
<input type="hidden" id="num_product_type_for_menu" value="<?php echo $num_product_type_for_menu; ?>" loaded="0">
<input type="hidden" id="num_brand_type_for_menu" value="<?php echo $num_makers; ?>" loaded="0">
<input type="hidden" id="num_product_list_for_menu" value="<?php echo $num_product_list; ?>" loaded="0">
<input type="hidden" id="pagination_limit" value="<?php echo $this->config->item('pagination_limit'); ?>">
<input type="hidden" id="no_more_vehicle_type_to_load" value="<?php echo $general_instruction->no_more_vehicle_type_to_load; ?>">
<input type="hidden" id="no_more_product_maker_to_load" value="<?php echo $general_instruction->no_more_product_type_to_load; ?>">
<input type="hidden" id="no_more_product_to_load" value="<?php echo $general_instruction->no_more_product_to_load; ?>">
<input type="hidden" id="already_added_product" value="<?php echo $general_instruction->already_added_product; ?>">
<input type="hidden" id="no_more_brand_to_load" value="<?php echo $general_instruction->no_more_product_maker_to_load; ?>">
<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">
<input type="hidden" id="selection_popup_body" value="<?php echo $selection_instruction->selection_popup_body; ?>">
<input type="hidden" id="selection_group_body" value="<?php echo $selection_instruction->selection_group_body; ?>">
<input type="hidden" id="products_guest_warning" value="<?php echo $selection_instruction->products_guest_warning; ?>">
<input type="hidden" id="already_requested" value="<?php echo $general_instruction->requestprice_added; ?>">

