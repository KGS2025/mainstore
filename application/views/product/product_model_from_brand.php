<?php
$search_by     = $this->session->userdata('search_by');
$hide_category = $this->session->userdata('hide_category');
$filter_option = $this->session->userdata('filter_option');
$catg_array = $this->session->userdata('vehicle_category_id');

if($hide_category == 1 && empty($search_by)){
    $backUrl = base_url().$lang_id.'/products';
}else{
    $backUrl = base_url().$lang_id.'/products/product_maker';
}

if($filter_option == "brand" || !empty($catg_array)){
    $backUrl = base_url().$lang_id.'/products/product_maker';
} 


?>


<div class="mainContent px-3 px-lg-5">
      <?php $this->load->view('elements/body_logo'); ?>
    <!------   Search box start --->
    <div class="ct-videoSection ct-u-paddingTop10 ct-u-paddingBottom20 no_mobile_toppadding">
        <div class="ct-services">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="ct-team-box ct-u-paddingTop20" style="padding-top:0px !important">
                        <div class="float-start w-100 common-search">
                            <div class="text-header">
                                <?php $this->load->view('elements/search'); ?>
                            </div>
                        </div>
                        
                        <div class="float-start w-100 home-quick-search-wrap">
                            <?php $this->load->view('elements/quicksearch'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!------   Search box end--->

    <div class="text-bread customScrollbar" data-mcs-theme="dark">
        <?php echo '<a href="' . base_url() . $lang_id . '/products">' . $general_instruction->product_section . '</a>'; ?>
        / <?php echo $breadcrumb; ?>
    </div>
    <input type="button" class="floatright1 show_more_breadcrumb" value="+" style="display: none;">

    <form action="<?= base_url().$lang_id.'/products/product_items'; ?>" id="products_brand_list_form" enctype="multipart/form-data" method="post">
        <input type="hidden" id="cart_block_timer" name="cart_block_timer" value="<?php echo $cart_timer->cart_block_timer; ?>" />
        <div class="main-page">
            <?php if($all_data['instruction_section_status'] == 1){?>
            <div class="red1" style="color:#<?php echo $all_data['select_category_color_text']; ?>"><span class="fontblack" style="color:#<?php echo $all_data['select_category_color']; ?>"><?php echo $general_instruction->selection_instruction; ?> </span><?php echo $selection_instruction->product_type_msg; ?> </div>
            <?php } ?>
            <div class="car-lists text-center productbaselisting">
                <?php include('product_timer.php'); ?>                 
                    <?php if ($this->config->item('is_product_selectall') == 1) { ?>
                        <div class="col-md-12">
                            <div id="check_all_btn" class="custom_btn mb-3 d-inline-flex align-items-center position-relative">
                                <input id="checkbox" type="checkbox" name="product_option[]" value="all">    
                                <label><?php echo $general_instruction->select_all; ?>(<span id="vehicle_makers_num"><?php echo $vehicle_model_count; ?></span>)</label>
                            </div> 
                        </div>                         
                    <?php } ?>
                <div class="canload kgt80 p-0 my-5 float-start w-100" id="productsearch_list_show">
                    <?php $data['modelList'] = $modelList;
                    $data['general_instruction'] = $general_instruction;
                    $data['model_id'] = $model_id;
                    $data['disable_multiselect'] = $disable_multiselect;
                    $this->load->view('product/get_category_model_list_from_brand',$data);?>
                </div>
                <?php if ($modelList['totalCategory'] > count($modelList['models'])) { ?>
                    <div class="float-start w-100 d-flex align-items-center justify-content-center">
                        <div id="more_button_model_cat" class="load-more-data kgtloadmore"> <?= $general_instruction->load_more_vehicle_type; ?> </div>
                    </div>
                <?php } ?>
            </div>

            <div class="nav-prex-next text-right removebuttons productBtns">
                <a href="<?= $backUrl; ?>" class="btn  actn-btn rounded"><?php echo $general_instruction->back; ?></a>
                <a href="javascript:void(0)" class="btn  actn-btn rounded" id="product_brand_next"><?php echo $general_instruction->next; ?></a>
            </div>
        </div>
    </form>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 s_button sticky_bottom productBtnsFixedBottom py-2 py-md-3 px-3 px-md-5" style="display: none;">
    <div class="nav-prex-next sticky_button_next flex-wrap align-items-center justify-content-between w-100">
        <?php if($all_data['next_btn_user_msg_status'] == 1){?>
            <span class="next-btn-msg d-inline-block mb-2">  (<?php echo $general_instruction->next_btn_msg; ?>)</span>
        <?php } ?>
        <div class="productActionBtns d-flex align-items-center">
            <a href="<?= $backUrl; ?>" class="btn  actn-btn rounded cart_back_btn_color" <?php if ($disable_multiselect == 1) {echo "style='display:none'";};?>><?php echo $general_instruction->back; ?></a>
            <a href="javascript:void(0)" class="btn  actn-btn rounded cart_submit_btn_color" id="product_brand_next_footer" <?php if ($disable_multiselect == 1) {echo "style='display:none'";};?>><?php echo $general_instruction->next; ?></a>
        </div>
    </div>
</div>
<span class="displaynon" id="maincart_block_msg"><?php if (isset($selection_instruction->maincart_block_msg)) echo $selection_instruction->maincart_block_msg; ?></span>
<span class="displaynon" id="editcart_block_msg"><?php if (isset($selection_instruction->editcart_block_msg)) echo $selection_instruction->editcart_block_msg; ?></span>
<span class="displaynon" id="cartpreview_block_msg"><?php if (isset($selection_instruction->cartpreview_block_msg)) echo $selection_instruction->cartpreview_block_msg; ?></span>
<span class="displaynon" id="cartverification_block_msg"><?php if (isset($selection_instruction->cartverification_block_msg)) echo $selection_instruction->cartverification_block_msg; ?></span>
<span class="displaynon" id="block_notification_msg"><?php if (isset($selection_instruction->block_notification_msg)) echo $selection_instruction->block_notification_msg; ?></span>
<span class="displaynon" id="cartverification_resent_block_msg"><?php if (isset($selection_instruction->cartverification_resent_block_msg)) echo $selection_instruction->cartverification_resent_block_msg; ?></span>
<span class="displaynon" id="cartverification_wrong_block_msg"><?php if (isset($selection_instruction->cartverification_wrong_block_msg)) echo $selection_instruction->cartverification_wrong_block_msg; ?></span>
      
<!--Modal Custom warning start-->
<?php $this->load->view('elements/popup/custom_warning_popup');?>
<!--Modal Custom warning end-->

<!--Modal shopping decision cart start-->
<?php $this->load->view('elements/popup/user_block_box');?>
<!--Modal shopping decision cart end-->

<input type="hidden" id="total_num_of_category" value="<?= $modelList['totalCategory']; ?>">
<input type="hidden" id="pagination_limit" value="<?php echo $this->config->item('pagination_limit'); ?>">
<input type="hidden" id="no_more_vehicle_type_to_load" value="<?php echo $general_instruction->no_more_vehicle_type_to_load; ?>">
<input type="hidden" id="no_more_product_maker_to_load" value="<?php echo $general_instruction->no_more_product_maker_to_load; ?>">
<input type="hidden" id="no_more_product_model_to_load" value="<?php echo $general_instruction->no_more_product_model_to_load; ?>">
<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">
