.<?php $comingsoon = getNoImage('coming-soon'); ?>
<?php 
$backUrl = base_url().$lang_id.'/products';
$loggedUserId = getFrontenduserId();
$front_validuser_data = $this->session->userdata('front_validuser_data');
$remaining_time = isset($front_validuser_data['remaining_time']) ? $front_validuser_data['remaining_time'] : 0;


$search_by     = $this->session->userdata('search_by');
$hide_category = $this->session->userdata('hide_category');
$filter_option = $this->session->userdata('filter_option');


$currencyV = getDefaultCurrencyCode('l') . '_currency';
$priceV    = 'price';
$currency  = $general_instruction->$currencyV;


if ($filter_option == "product-group" && $hide_category == 1) {
    $action_url = base_url() . $lang_id . '/product_maker';
} else if ($filter_option == "product-group" && $hide_category == 0) {
    $action_url = base_url() . $lang_id . '/products/vehicle_type';
} else if ($search_by == "product_type" && $hide_category == 0) {
    $action_url = base_url() . $lang_id . '/products/vehicle_type';
} else if ($search_by == "product_type" && $hide_category == 1) {
    $action_url = base_url() . $lang_id . '/products/product_maker';
} else {
    $action_url = base_url() . $lang_id . '/products/product_maker';
}

$disable_multiselect= ($this->config->item('disable_multiselect')?"1":"0");
?>
<div class="mainContent px-3 px-lg-5">
     <?php $this->load->view('elements/body_logo'); ?>
    <div class="mobile-bnr float-start w-100">
        <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;overflow:hidden;visibility:hidden;">
            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;overflow:hidden;"></div>
        </div>
    </div>
    
    <div class="ct-videoSection ct-u-paddingTop10 no_mobile_toppadding">
        <div class="ct-services">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                    <div class="ct-team-box ct-u-paddingTop20" style="padding-top:40px !important">

                        <?php if($all_data['home_product_heading_status'] == 1){?>
                        <h1 style="padding-bottom: 5px;color:#<?php echo $all_data['category_label_txt_color'];?> !important;font-size: 20px;text-transform: none;"><?php echo $all_data['products'] ?></h1>
                        <?php } ?>
                        
                        <?php if($all_data['instruction_section_status'] == 1){?>
                            <div class="red1" style="color:#<?php echo $all_data['select_category_color_text'];?>"><span class="fontblack" style="color:#<?php echo $all_data['select_category_color']; ?>;"><?php echo $general_instruction->selection_instruction; ?> </span><?php echo $selection_instruction->product_msg; ?></div>
                        <?php } ?>
                        
                        <div class="float-start w-100 common-search">
                            <div class="text-header">
                                <?php $this->load->view('elements/search'); ?>
                            </div>
                        </div>

                        <div class="home-quick-search-wrap">
                            <?php $this->load->view('elements/quicksearch'); ?>
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
    </div>                            
    
    <div class="car-lists text-center productbaselisting">
        <form action="<?php echo  $action_url; ?>" id="products_catagory_list_form" enctype="multipart/form-data" method="post">
            <input type="hidden" id="cart_block_timer" name="cart_block_timer" value="<?php echo $cart_timer->cart_block_timer; ?>" />
            <div class="product-list pull-left">
            <input class="filter_option" type="radio" name="filter_option" value="product-group" checked="checked" style="Display:none;"> 

                <div class="product-group-list filter-list <?php echo ($disable_multiselect==1?"disable-multi-select":"");?>">
                <?php if($this->config->item('show_dropdown_in_search_pages') == "1") { ?>

                <div class="cl-filter p-3">
                <?php if ($this->config->item('show_dropdown_description') == "1") { ?> 

						<h5 class="h5 clf-title"><?php echo $product_instruction->dropdown_instrunction;  ?></h5>
						<?php } ?>
                        <div class="control-group" style="width: 100%"> 
							<label class="control-label"> <?php echo $product_instruction->dropdown_type;  ?></label>
							<div class="controls">
								<select class="group_new_drop focustip span12" name="product_type_id_drp[]" multiple="multiple" required>
									<?php
									foreach ($menu_product_types as $pro_type) {

								if (isset($pro_type['Product_Type_Photo']) && $pro_type['Product_Type_Photo'] != '' && file_exists("assets/uploads/product_type_images/" . $pro_type['Product_Type_Photo'])) {
											$vimg = asset_url('assets/uploads/product_type_images/'.$pro_type['Product_Type_Photo']);
										} else {
											$vimg = getNoImage('no-image');
										}?>
									
									<option value='<?php echo $pro_type['id']; ?>'  data-image="<?= $vimg;?>" >
									<?php echo $pro_type['product_type_name']; ?></option>
									<?php } ?>
									</select>
							</div>
							<span id='attribute_file_validate' class='error displaynon'></span>
						</div>
				</div>
                <?php } ?>


                    <div id="menu_product_types_block" class="float-start w-100">
                        <div class="AllProducts">
                            
                            <?php foreach ($menu_product_types as $pro_type) { ?>
                                <div class="ProductBlock" style="margin-bottom: 20px;">
                                    <div class="VehicleBlockItems">
                                        <div class="pro-item product_type_image_wrap step1 product_group_image_wrap boarder_2_red">
                                            <div class="height180px overflowhidden">
                                                <a href="javascript:void(0);" class="product_image_wrap" data-rel="<?php echo $pro_type['id']; ?>">
                                                    <?php if (isset($pro_type['Product_Type_Photo']) && $pro_type['Product_Type_Photo'] != '' && file_exists("assets/uploads/product_type_images/" . $pro_type['Product_Type_Photo'])) { ?>
                                                        <img src="<?= $this->session->userdata('default_image');?>" data-img="<?php echo asset_url();?>assets/uploads/product_type_images/<?php echo $pro_type['Product_Type_Photo']; ?>" class="img-responsive"  alt="image-<?php echo $pro_type['product_type_name']; ?>"  id="image_id_<?php echo $pro_type['id']; ?>"/>
                                                    <?php } else { ?>
                                                        <img src="<?= $this->session->userdata('default_image');?>" data-img="<?php echo $comingsoon; ?>" alt="coming soon" class="img-responsive" id="image_id_<?php echo $pro_type['id']; ?>"/>
                                                    <?php } ?>
                                                </a>
                                                <input type="hidden" name="product_type_id[]" value="<?php echo $pro_type['id']; ?>" class="product_types_id">
                                            </div> 
                                            <a href="javascript:void(0);" class="btn  Type_title actn-btn"><?php echo $pro_type['lang_product_type_name'] ? $pro_type['lang_product_type_name'] : $pro_type['product_type_name']; ?>  </a>
                                            <?php if (($this->config->item('product_group_minimum_price_show_to_guest_user') == "1" && $remaining_time <= 0 && empty($loggedUserId)) || ($this->config->item('product_group_minimum_price_show_to_all_users') == "1")) { ?>
                                                <span class="start_from"> <?php echo $general_instruction->start_from; ?> <?php echo $currency . " " . $pro_type['min_price']; ?> </span> <?php if ($pro_type['in_stock'] > 0) { ?> <span class="Instock"><?php echo strtoupper($product_instruction->in_stock); ?> </span> <?php } ?> <?php } ?>
                                            
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
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
    <div class="nav-prex-next text-right removebuttons productBtns" style="margin-top: 10px;">
        <a href="<?= $backUrl; ?>" class="btn  actn-btn rounded"><?php echo $general_instruction->back; ?> </a>
        <a href="javascript:void(0);" class="btn  actn-btn rounded" id="product_catagory_next"><?php echo $general_instruction->next; ?></a>
    </div>

</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 s_button sticky_bottom productBtnsFixedBottom py-2 py-md-3 px-3 px-md-5" style="display: none;">
    <div class="nav-prex-next sticky_button_next flex-wrap align-items-center justify-content-between w-100">
        <?php if($all_data['next_btn_user_msg_status'] == 1){?>
            <span class="next-btn-msg d-inline-block mb-2">  (<?php echo $general_instruction->next_btn_msg; ?>)</span>
        <?php } ?>
        <div class="productActionBtns d-flex align-items-center" >
            <a href="<?= $backUrl; ?>" class="btn  actn-btn rounded cart_back_btn_color" <?php if ($disable_multiselect == 1) {echo "style='display:none'";};?>><?php echo $general_instruction->back; ?> </a>
            <a href="javascript:void(0);" class="btn rounded  header-footer-sticky-btn actn-btn cart_submit_btn_color" id="product_catagory_next_footer" <?php if ($disable_multiselect == 1) {echo "style='display:none'";};?>><?php echo $general_instruction->next; ?></a>
        </div>
    </div>
</div>

<!--Modal Custom warning start-->
<?php $this->load->view('elements/popup/custom_warning_popup');?>
<!--Modal Custom warning end-->

<!--Modal user block popup start-->
<?php $this->load->view('elements/popup/user_block_box');?>
<!--Modal user block popup end-->

<input type="hidden" id="num_vehicle_type_for_menu" value="<?php echo $num_vehicle_type_for_menu; ?>">
<input type="hidden" id="num_product_type_for_menu" value="<?php echo $num_product_type_for_menu; ?>">
<input type="hidden" id="num_brand_type_for_menu" value="<?php echo $num_makers; ?>">
<input type="hidden" id="pagination_limit" value="<?php echo $this->config->item('pagination_limit'); ?>">
<input type="hidden" id="no_more_vehicle_type_to_load" value="<?php echo $general_instruction->no_more_vehicle_type_to_load; ?>">
<input type="hidden" id="no_more_product_maker_to_load" value="<?php echo $general_instruction->no_more_product_type_to_load; ?>">
<input type="hidden" id="no_more_brand_to_load" value="<?php echo $general_instruction->no_more_product_maker_to_load; ?>">
<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">    