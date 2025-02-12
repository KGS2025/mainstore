<?php $comingsoon   = getNoImage('coming-soon'); ?>





<?php
$search_by     = $this->session->userdata('search_by');
$hide_category = $this->session->userdata('hide_category');
$filter_option = $this->session->userdata('filter_option');





if ($filter_option == "product-group" && $hide_category == 1) {
    $backUrl = base_url() . $lang_id . '/products';
} else if ($filter_option == "product-group" && $hide_category == 0) {
    $backUrl = base_url() . $lang_id . '/products/product_group';
}  else if ($filter_option == "industry-type") {
    $backUrl = base_url() . $lang_id . '/products/industry_type';
} else {
    $backUrl = base_url() . $lang_id . '/products';
}
?>


<div class="mainContent px-3 px-lg-5">
    <?php $this->load->view('elements/body_logo'); ?>
    <!------ Search box start --->
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
    <!------ Search box end --->

    <div class="text-bread customScrollbar" data-mcs-theme="dark">
        <?php echo '<a href="' . base_url() . $lang_id . '/products">' . $general_instruction->product_section . '</a>'; ?>
        / <?php echo $breadcrumb; ?>
    </div>
    <input type="button" class="floatright1 show_more_breadcrumb" value="+" style="display: none;">

    <form action="<?php echo base_url() . $lang_id . '/'; ?>products/product_maker" id="products_type_list_form" enctype="multipart/form-data" method="post">
        <input type="hidden" name="method_one" value="1" />
        <input type="hidden" id="cart_block_timer" name="cart_block_timer" value="<?php echo $cart_timer->cart_block_timer; ?>" />
        <div class="main-page">
            <?php if ($all_data['instruction_section_status'] == 1) { ?>
                <div class="red1" style="color:#<?php echo $all_data['select_category_color_text']; ?>"><span class="fontblack" style="color:#<?php echo $all_data['select_category_color']; ?>"><?php echo $general_instruction->selection_instruction; ?> </span><?php echo $selection_instruction->product_msg; ?></div>
            <?php } ?>

            <?php if($this->config->item('show_dropdown_in_search_pages') == "1") { ?>
            <div class="cl-filter p-3">
            <?php if ($this->config->item('show_dropdown_description') == "1") { ?> 

                <h5 class="h5 clf-title"><?php echo $product_instruction->dropdown_instrunction;  ?></h5>
                <?php } ?>
                <div class="control-group" style="width: 100%"> 
                    <label class="control-label"><?php echo $product_instruction->dropdown_categry;  ?></label>
                    <div class="controls">
                        <select class="vehicle_type_drp focustip span12" name="vehicle_category_id[]" multiple="multiple" required>
                        </select>
                    </div>
                    <span id='attribute_file_validate' class='error displaynon'></span>
                </div>
            </div>
            <?php } ?>

            <span class="custom_btn mt-3 mb-0 d-inline-flex align-items-center position-relative">
                <input type="checkbox" class="category-list-box" />
                <label for="Checkbox_all"></label>
                <span><?php echo $general_instruction->select_all; ?></span>
            </span>

            <div class="car-lists text-center productbaselisting mb-4">
                <?php include('product_timer.php'); ?>
                <div class="col-md-12">
                    <?php if ($this->config->item('is_product_selectall') == 1) { ?>
                        <div id="check_all_btn" class="custom_btn mb-3 d-inline-flex align-items-center position-relative">
                            <input id="checkbox" type="checkbox" name="product_option[]" value="all">
                            <label><?php echo $general_instruction->select_all; ?>(<span id="vehicle_type_num"><?php echo count($vehicle_categories); ?></span>)</label>
                        </div>
                    <?php } ?>
                </div>
                <div id="vehicle_type_block" class="float-start w-100">
                    <div class="AllProducts">
                        <?php foreach ($vehicle_categories as $vehicle) {
                            if ($vehicle['status'] == "1") { ?>
                                <?php if (empty($vehicle_category_ids) || (!empty($vehicle_category_ids) && in_array($vehicle['id'], $vehicle_category_ids))) { ?>
                                    <div class="ProductBlock">
                                        <div class="VehicleBlockItems h-float">
                                            <div class="pro-item vehicle_category_image_wrap step1 <?php if (in_array($vehicle['id'], $vehicle_category_ids)) {
                                                                                                        echo 'boarder_2_red';
                                                                                                    } ?>">
                                                <div class="overflowhidden">
                                                    <a href="javascript:void(0);" class="product_image_wrap" data-rel="<?php echo $vehicle['id']; ?>">
                                                        <?php if (isset($vehicle['VehicleType_Photo']) && $vehicle['VehicleType_Photo'] != '' && file_exists("assets/uploads/vehicle_categories/" . $vehicle['VehicleType_Photo'])) { ?>
                                                            <img src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo asset_url(); ?>assets/uploads/vehicle_categories/<?php echo $vehicle['VehicleType_Photo']; ?>" class="img-responsive" alt="image-<?php echo $vehicle['category_name']; ?>" id="image_id_<?php echo $vehicle['id']; ?>" />
                                                        <?php } else { ?>
                                                            <img src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo $comingsoon; ?>" alt="coming soon" class="img-responsive" id="image_id_<?php echo $vehicle['id']; ?>" />
                                                        <?php } ?>
                                                    </a>
                                                    <input type="hidden" name="vehicle_category_id[]" value="<?php if (in_array($vehicle['id'], $vehicle_category_ids)) {
                                                                                                                    echo $vehicle['id'];
                                                                                                                } ?>" class="vehicle_category_id">
                                                </div>
                                                <div class="clearfix"></div>
                                                <a href="javascript:void(0);" class="btn  actn-btn"><?php echo $vehicle['lang_category_name'] ? $vehicle['lang_category_name'] : $vehicle['category_name']; 
                                                                                                        if (!empty($vehicle['name'])) { ?> <span class="element_desc"> (<?php echo $vehicle['name']; ?> ) </span> <?php } ?></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <?php if ($num_vehicle_type_for_menu > count($vehicle_categories)) { //disable cause not isset noumber of vehicle_type by page
                ?>
                    <div class="float-start w-100 d-flex align-items-center justify-content-center">
                        <div id="more_button_vehicle_types" class="load-more-data kgtloadmore"> <?= $general_instruction->load_more_vehicle_type; ?> </div>
                    </div>
                <?php } ?>
            </div>

            <div class="nav-prex-next text-right removebuttons productBtns">
                <a href="<?php echo $backUrl; ?>" class="btn  actn-btn rounded"><?php echo $general_instruction->back; ?> </a>
                <a href="javascript:void(0);" class="btn  actn-btn rounded" id="product_type_next"><?php echo $general_instruction->next; ?> </a>
            </div>

        </div>
    </form>

</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 s_button sticky_bottom productBtnsFixedBottom py-2 py-md-3 px-3 px-md-5" style="display: none;">
    <div class="nav-prex-next sticky_button_next d-flex flex-wrap align-items-center justify-content-between w-100">
        <?php if ($all_data['next_btn_user_msg_status'] == 1) { ?>
            <span class="next-btn-msg d-inline-block mb-2"> (<?php echo $general_instruction->next_btn_msg; ?>)</span>
        <?php } ?>
        <div class="productActionBtns d-flex align-items-center">
            <a href="<?php echo $backUrl; ?>" class="btn  actn-btn rounded"><?php echo $general_instruction->back; ?> </a>
            <a href="javascript:void(0);" class="btn  actn-btn rounded" id="product_type_next_footer"><?php echo $general_instruction->next; ?> </a>
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
<?php $this->load->view('elements/popup/custom_warning_popup'); ?>
<!--Modal Custom warning end-->

<!--Modal user block popup start-->
<?php $this->load->view('elements/popup/user_block_box'); ?>
<!--Modal user block popup end-->

<input type="hidden" id="num_vehicle_type_for_menu" value="<?php echo $num_vehicle_type_for_menu; ?>">
<input type="hidden" id="pagination_limit" value="<?php echo $this->config->item('pagination_limit'); ?>">
<input type="hidden" id="no_more_product_maker_to_load" value="<?php echo $general_instruction->no_more_vehicle_type_to_load; ?>">
<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">