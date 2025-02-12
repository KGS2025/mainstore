
<div class="mainContent px-3 px-lg-5">
    <?php $this->load->view('elements/body_logo'); ?>
    <!------   Search --->
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
    <!------   Search --->

    <div class="text-bread customScrollbar" data-mcs-theme="dark">
        <?php echo '<a href="' . base_url() . $lang_id . '/products">' . $general_instruction->product_section . '</a>'; ?>
        <?php echo (strpos($breadcrumb,'/')==1?'':'/ ');?><?php echo $breadcrumb; ?>
    </div>
    <input type="button" class="floatright1 show_more_breadcrumb" value="+" style="display: none;">

    <div class="main-page">
        <?php if($all_data['instruction_section_status'] == 1){?>
            <div class="red1" style="color:#<?php echo $all_data['select_category_color_text']; ?>"><span class="fontblack" style="color:#<?php echo $all_data['select_category_color']; ?>"><?php echo $general_instruction->selection_instruction; ?> </span><?php echo $selection_instruction->vehicle_type_msg; ?>
            </div>
        <?php } ?>




        
        <form action="<?php echo base_url() . $lang_id . '/'; ?>products/product_list" method="post" id="product_type_listing">
            <input name="update" id="update" value="0" type="hidden">
            <input type="hidden" id="cart_block_timer" name="cart_block_timer" value="<?php echo $cart_timer->cart_block_timer; ?>" />
            <div class="car-lists productlisting productbaselisting">
                <?php include('product_timer.php'); ?> 

                <?php if ($this->session->userdata('hide_category') == 1) { ?>
                    <?php if($this->config->item('show_dropdown_in_search_pages') == "1") { ?>

                <div class="cl-filter p-3">
                <?php if ($this->config->item('show_dropdown_description') == "1") { ?> 

						<h5 class="h5 clf-title"><?php echo $product_instruction->dropdown_instrunction;  ?></h5>
				<?php } ?>
                        <div class="control-group" style="width: 100%"> 
							<label class="control-label">  <?php echo $product_instruction->dropdown_type;  ?></label>
							<div class="controls">
								<select class="group_new_drop_items focustip span12" name="product_type[]" multiple="multiple" required>
								
									</select>
							</div>
							<span id='attribute_file_validate' class='error displaynon'></span>
						</div>
					</div>
                    <?php }  ?>
                    <?php }  ?>


                <div id="productsearch_list_show" class="kgt80 mt-4" style="padding: 0px;">
                    <?php $data['productgroup'] = $productgroup;
                    $data['general_instruction'] = $general_instruction;
                    $data['product_type_id'] = $product_type_id;
                    $data['type'] = 'category';
                    $data['disable_multiselect']  = $disable_multiselect;
                    $this->load->view('product/get_ajax_product_item_list',$data);?>
                </div>
                <?php if ($productgroup['totalCategory'] > count($productgroup['categories'])) { ?>
                    <div class="float-start w-100 d-flex align-items-center justify-content-center">
                        <div id="more_button_item_cat" class="load-more-data kgtloadmore"> <?= $general_instruction->load_more_vehicle_type; ?> </div>
                    </div>   
                <?php } ?>
            </div>

            <div class="nav-prex-next text-right removebuttons productBtns">
                <a href="<?php echo base_url() . $lang_id . '/'; ?>products/product_model" class="btn  actn-btn rounded"><?php echo $general_instruction->back; ?></a>
                <a href="javascript:void(0)" class="btn  actn-btn rounded" id="product_item_next"><?php echo $general_instruction->next; ?></a>
            </div>
        </form>
    </div>
    <!--End content-->
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 s_button sticky_bottom  productBtnsFixedBottom py-3 px-5" style="display: none;">
    <div class="nav-prex-next sticky_button_next flex-wrap align-items-center justify-content-between w-100">
        <?php if($all_data['next_btn_user_msg_status'] == 1){?>
            <span class="next-btn-msg d-inline-block mb-2">  (<?php echo $general_instruction->next_btn_msg; ?>)</span>
        <?php } ?>
        <div class="productActionBtns d-flex align-items-center">
            <a href="<?php echo base_url() . $lang_id . '/'; ?>products/product_model" class="btn  actn-btn rounded cart_back_btn_color" <?php if ($disable_multiselect == 1) {echo "style='display:none'";};?>><?php echo $general_instruction->back; ?></a>
            <a href="javascript:void(0)" class="btn  actn-btn rounded cart_submit_btn_color" id="product_item_next_footer" <?php if ($disable_multiselect == 1) {echo "style='display:none'";};?>><?php echo $general_instruction->next; ?></a>
        </div>
    </div>
</div>
<!--Modal Custom warning start-->
<?php $this->load->view('elements/popup/custom_warning_popup');?>
<!--Modal Custom warning end-->

<!--Modal shopping decision cart start-->
<?php $this->load->view('elements/popup/user_block_box');?>
<!--Modal shopping decision cart end-->

<input type="hidden" id="total_num_of_category" value="<?= $productgroup['totalCategory']; ?>">
<input type="hidden" id="pagination_limit" value="<?php echo $this->config->item('pagination_limit'); ?>">
<input type="hidden" id="no_more_vehicle_type_to_load" value="<?php echo $general_instruction->no_more_vehicle_type_to_load; ?>">
<input type="hidden" id="no_more_product_type_to_load" value="<?php echo $general_instruction->no_more_product_type_to_load; ?>">
<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">
