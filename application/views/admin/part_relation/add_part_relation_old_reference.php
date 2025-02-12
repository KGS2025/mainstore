<div class="content zerorightmargin">
    <?php if ($this->session->flashdata('success')) {
        $msg = $this->session->flashdata('success'); ?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?>
            </div>
        </div>
    <?php } ?>

    <?php if ($this->session->flashdata('error')) {
        $msg = $this->session->flashdata('error'); ?>
        <div class="notice outer">
            <div class="error"><?php echo $msg; ?>
            </div>
        </div>
    <?php } ?>
    <?php $noimage = getNoImage('no_image'); ?>


    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <!-- page title -->

                <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">

                        <!-- Pickers -->
                        <form id="addPartRelation" name="addPartRelation" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set"/>

                            <div class="row-fluid">

                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5> <?php echo $admin_products['part_relation']['front']; ?></h5>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['kgt_ref_no']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="ref_no" name="ref_no" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('kgt_ref_no'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['part_name']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="part_name" name="part_name" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('part_name'); ?></span>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['quantity']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="quantity" name="quantity" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('quantity'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['quantity_threshold']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="quantity_threshold" name="quantity_threshold" class="focustip span12" type="number" min="1" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('quantity_threshold'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['replenishment_order_number']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="replenishment_order_number" name="replenishment_order_number" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('replenishment_order_number'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['replenishment_order_date']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="replenishment_order_date" name="replenishment_order_date" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('replenishment_order_date'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['replenishing_period']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="replenishing_period" name="replenishing_period" class="focustip span12" type="number" min="1" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('replenishing_period'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['replenishing_period_tolerance_range']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="replenishing_period_tolerance_range" name="replenishing_period_tolerance_range" class="focustip span12" type="number" min="1" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('replenishing_period_tolerance_range'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['ex_stock_period']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="ex_stock_period" name="ex_stock_period" class="focustip span12" type="text" value="" readonly="">
                                            </div>
                                            <span class="red1"><?php echo form_error('ex_stock_period'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['backorder_status']['front']; ?>:</label>
                                            <div class="controls">
                                                <select name="backorder_status" id="backorder_status" class="focustip span12">
                                                    <!--<option value="1"><?php echo $admin_products['backorder_yes']['front']; ?></option> -->
                                                    <option value="0"><?php echo $admin_products['backorder_no']['front']; ?></option>
                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('backorder_status'); ?></span>
                                        </div> 
                                        
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['price_cad']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="price_cad" name="price_cad" class="focustip span12" type="number" min="1" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('price_cad'); ?></span>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['price_usd']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="price_usd" name="price_usd" class="focustip span12" type="number" min="1" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('price_usd'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['price_tnd']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="price_tnd" name="price_tnd" class="focustip span12" type="number" min="1" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('price_tnd'); ?></span>
                                        </div>
                                        
                                        
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['item_height']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="item_height" name="item_height" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('item_height'); ?></span>
                                        </div>
                                        
                                        
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['item_width']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="item_width" name="item_width" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('item_width'); ?></span>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['item_length']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="item_length" name="item_length" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('item_length'); ?></span>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['item_weight']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="item_weight" name="item_weight" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('item_weight'); ?></span>
                                        </div>

                                        <div class="select-wrapper control-group">
                                            <label class="control-label"><?php echo $admin_products['package_multiple']['front']; ?>:</label>
                                            <div class="controls">
                                                <select class="package-multiple focustip span12" name="packageId[]" multiple="multiple" required>
                                                    <?php if(count($packages) > 0){
                                                        foreach ($packages as $package) {?>
                                                            <option value="<?= $package['id'];?>"><?= $package['lang_packagename'] ? $package['lang_packagename'] : $package['packagename'];?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['item_nature']['front']; ?>:</label>

                                            <div class="controls">
                                                <select name="item_nature_id" id="item_nature_id" class="focustip span12">
                                                    <?php
                                                    foreach ($product_natures as $product_nature) {
                                                        ?>
                                                        <option value="<?php echo $product_nature['id']; ?>">
                                                            <?php
                                                                if (isset($product_nature['lang_name']) && $product_nature['lang_name'] != '') {
                                                                    echo $product_nature['lang_name'];
                                                                } else {
                                                                    echo $product_nature['name'];
                                                                }
                                                            ?> 
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('item_nature_id'); ?></span>
                                        </div>                                        
                                        
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['shipping_special_notes']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="shipping_special_notes" name="shipping_special_notes" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('shipping_special_notes'); ?></span>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['availability']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="availability" name="availability" class="focustip span12" type="text" value="<?php echo $cart_instruction['backorder_accept_msg']['front']; ?>" readonly> 
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/cart_instruction/backorder_accept_msg/front" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('availability'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['availability_backorder_no']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="availability_backorder_no" name="availability_backorder_no" class="focustip span12" type="text" value="<?php echo $cart_instruction['backorder_not_accept_msg']['front']; ?>" readonly> 
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/cart_instruction/backorder_not_accept_msg/front" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('availability_backorder_no'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['availability_max_msg']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="availability_max_msg" name="availability_max_msg" class="focustip span12" type="text" value="<?php echo $cart_instruction['max_availability_msg']['front']; ?>" readonly> 
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/cart_instruction/max_availability_msg/front" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('availability_max_msg'); ?></span>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['unit_of_measurement']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="unit_of_measurement" name="unit_of_measurement" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('unit_of_measurement'); ?></span>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['country_origin']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="country_origin" name="country_origin" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('country_origin'); ?></span>
                                        </div>
                                        
                                        <div class="control-group" id="item_real_photo">
                                        <label class="control-label"><?php echo $admin_products['item_real_photo']['front']; ?>:</label>

                                            <div class="controls">
                                                <input id="item_real_photo_img" name="item_real_photo" class="focustip span12" type="file">
                                                <img id="productimage1" src="<?php echo $noimage; ?>" alt=" image preview"
                                                     class="modelimgpreviewbox"/>

                                                <div id="productimage1_delete" class="margintop-10px"></div>
                                            </div>
                                            <span class="red1"><?php echo form_error('item_real_photo'); ?></span>
                                        </div>
                                        
                                        <div class="control-group" id="item_schematic_photo">
                                        <label class="control-label"><?php echo $admin_products['item_schematic_photo']['front']; ?>:</label>

                                            <div class="controls">
                                                <input id="item_schematic_photo_img" name="item_schematic_photo" class="focustip span12" type="file">
                                                <img id="productimage2" src="<?php echo $noimage; ?>" alt=" image preview"
                                                     class="modelimgpreviewbox"/>

                                                <div id="productimage2_delete" class="margintop-10px"></div>
                                            </div>
                                            <span class="red1"><?php echo form_error('item_schematic_photo'); ?></span>
                                            <label class="control-label"><?php echo $admin_products['item_schematic_photo_status']['front']; ?>:</label> 
                                            <div class="controls">
                                                <input type="checkbox" name="item_schematic_photo_status" value="1" />
                                            </div>
                                        </div>

                                        <div class="control-group" id="vehicle_category_id">
                                            <label class="control-label"><?php echo $admin_products['product_type']['front']; ?>:</label>

                                            <?php $c = 0; ?>
                                                <?php foreach($vehicle_categories as $catagory) { ?>
                                                    
                                                    <div class="controls vehicle_category_<?php echo $catagory['id']; ?>">
                                                    <input type="checkbox" name="vehicle_category_id[]" value="<?php echo $catagory['id']; ?>"/>&nbsp; &nbsp;<?php if(isset($catagory['lang_category_name']) && $catagory['lang_category_name'] != '') {  echo $catagory['lang_category_name']; } else { echo $catagory['category_name']; } ?>
                                                    </div>
                                            <?php $c++; } ?>
                                            <span class="red1"><?php echo form_error('product_type_id'); ?></span>
                                        </div>
                                        
                                       

                                        <div class="control-group" id="maker_list" style="display:none;">
                                            <label class="control-label"><?php echo $admin_products['maker_name']['front']; ?>:</label>
                                                <?php $i = 0; ?>
                                                <?php foreach($maker_info as $maker) { 
                                                    $vehicle_category_ids = explode(',',$maker['vehicle_category_id']);
                                                    $class = '';
                                                    foreach($vehicle_category_ids as $vehicle_category_id) { 
                                                        $class .= " maker_".$vehicle_category_id;
                                                    }?>
                                                    
                                                    <div class="controls<?php echo $class; ?>">
                                                    <input type="checkbox" name="maker_id[]" value="<?php echo $maker['id']; ?>"/>&nbsp; &nbsp;<?php echo $maker['maker_name']; ?>
                                                    </div>
                                                <?php $i++; } ?>
                                        </div>

                                        <?php $j = 0; 
                                        if(count($model_info) > 0){?>
                                            <div style="border-bottom: none;padding:16px;">
                                                <label class="control-label"><?php echo $admin_products['product_model_name']['front']; ?>:</label>
                                            </div>
                                            </br>
                                            <?php foreach($model_info as $model) { ?>
                                                <div class="control-group model_list" style="padding-top: 0px !important; border-bottom:none;display: none;">
                                                    <div class="controls model_<?php echo $model['maker_id']; ?>">
                                                        <input type="checkbox" name="model_id[]" value="<?php echo $model['id']; ?>">&nbsp; &nbsp;<?php echo $model['model_name']; ?>
                                                    </div>
                                                </div>

                                                <div class="product_model_field_display item_model_<?= $model['id'];?> displaynon" style="border-bottom: 1px solid #eaeaea;">
                                                    <?php if(count($model_product_items) > 0){?>
                                                        <?php foreach($model_product_items as $pitem) { ?>
                                                            <div class="control-group" id="item_<?php echo $model['id'].'_'.$pitem['id']; ?>" style="padding-top: 0px !important; border-bottom:none;">
                                                                <label class="control-label"><?php if(isset($pitem['lang_item_name']) && $pitem['lang_item_name'] != '') { echo $pitem['lang_item_name']; } else { echo $pitem['item_name']; }  ?>:</label>
                                                                <div class="controls">
                                                                    <?php if($pitem['field_type'] == 'image') { ?>
                                                                        <input name="<?php echo $model['id'].'_'.$pitem['id']; ?>" class="focustip span12" type="file" disabled>
                                                                        <?php if (isset($product_model_itemr[$pitem['id']][$model['id']]) && $product_model_itemr[$pitem['id']][$model['id']] != "") {
                                                                            $src = './assets/uploads/product_images/' . $product_model_itemr[$pitem['id']][$model['id']][0]; ?>
                                                                            <img id="modelimg_prvw<?php echo $pitem['id']; ?>" src="<?php echo $src; ?>" alt=" image preview" class="modelimgpreviewbox"/>
                                                                            <div id="modelimg_prvw<?php echo $pitem['id']; ?>_delete" class="margintop-10px">
                                                                                <input type="button" class="focustip nopadding" value="Delete Image" onclick="removeimg('modelimg_prvw<?php echo $pitem['id']; ?>');">
                                                                            </div>
                                                                        <?php } else { $src = $noimage; ?>
                                                                            <img id="modelimg_prvw<?php echo $pitem['id']; ?>" src="<?php echo $src; ?>" alt="image preview" class="modelimgpreviewbox"/>
                                                                            <div id="modelimg_prvw<?php echo $pitem['id']; ?>_delete" class="margintop-10px"></div>
                                                                        <?php } ?>
                                                                    <?php } else if($pitem['field_type'] == 'dropdown') { ?>
                                                                        <input type="hidden" name="product_item[<?php echo $model['id'].'_'.$pitem['id']; ?>][field_type]" value="dropdown" disabled class="focustip span12"/>

                                                                        <input type="hidden" name="product_item[<?php echo $model['id'].'_'.$pitem['id']; ?>][maker_id]" value="<?php echo $model['maker_id']; ?>">
                                                                                                                             
                                                                        <div class="input_fields_wrap" id="dropdown_<?php echo $model['id'].'_'.$pitem['id']; ?>" >
                                                                            <button class="add_field_button btn btn-success drop_year" style="margin-bottom:15px;" data-id="<?php echo $model['id'].'_'.$pitem['id']; ?>">Add More Fields</button>
                                                                            <?php if(isset($product_model_itemr[$pitem['id']][$model['id']][2]) && count($product_model_itemr[$pitem['id']][$model['id']][2]) > 0){ ?>
                                                                                <?php foreach($product_model_itemr[$pitem['id']][$model['id']][2] as $key => $pitemdropdwon) { ?>
                                                                                    <div style="padding-bottom:15px;">
                                                                                        <?php if($pitem['id'] == 1){?>
                                                                                            <select name="product_item[<?php echo $model['id'].'_'.$pitem['id']; ?>][]" class="focustip span12 default_drop drop_<?php echo $model['id'].'_'.$pitem['id']; ?>" <?php if($pitem['required_attribute'] == 1){echo 'required';}?> data-id="<?php echo $model['id'].'_'.$pitem['id']; ?>">
                                                                                                <option value="">Select any one</option>
                                                                                                <?php for($y=1946; $y<= date('Y'); $y++){?>
                                                                                                    <option value="<?= $y;?>"><?= $y;?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        <?php }else{ ?>
                                                                                            <input name="product_item[<?php echo $model['id'].'_'.$pitem['id']; ?>][]" class="focustip span12" type="text" value="" <?php if($pitem['required_attribute'] == 1){echo 'required';}?>/>
                                                                                        <?php } ?>
                                                                                        <a href="#" class="remove_field">Remove</a>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        </div>
                                                                   
                                                                        <script>
                                                                             $(document).ready(function() {
                                                                                var id = "dropdown_<?php echo $model['id'].'_'.$pitem['id']; ?>";
                                                                                var wrapper = $("#" + id); //Fields wrapper
                                                                                var add_button = $("#" + id + " .add_field_button"); //Add button ID

                                                                                var x = 1; //initlal text box count
                                                                                $(add_button).click(function(e){ //on add input button click
                                                                                    e.preventDefault();
                                                                                    var html = '<div style="padding-bottom:15px;">';
                                                                                    <?php if($pitem['id'] == 1){?>
                                                                                        html += '<select name="product_item[<?php echo $model['id'].'_'.$pitem['id']; ?>][]" class="focustip span12 default_drop drop_<?php echo $model['id'].'_'.$pitem['id']; ?>" <?php if($pitem['required_attribute'] == 1){echo 'required';}?> data-id="<?php echo $model['id'].'_'.$pitem['id']; ?>"><option value="">Select any one</option><?php for($y=1946; $y<= date('Y'); $y++){?><option value="<?= $y;?>"><?= $y;?></option><?php } ?>
                                                                                        </select>';
                                                                                    <?php }else{ ?>
                                                                                        html += '<input name="product_item[<?php echo $model['id'].'_'.$pitem['id']; ?>][]" class="focustip span12" type="text" value="" <?php if($pitem['required_attribute'] == 1){echo 'required';}?> />';
                                                                                    <?php } ?>
                                                                                    html += '<a href="#" class="remove_field">Remove</a></div>';
                                                                                    $(wrapper).append(html); //add input box
                                                                                    resetYear('<?php echo $model['id'].'_'.$pitem['id']; ?>');
                                                                                });

                                                                                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                                                                                    e.preventDefault(); $(this).parent('div').remove(); x--;
                                                                                    resetYear('<?php echo $model['id'].'_'.$pitem['id']; ?>');
                                                                                });
                                                                            });
                                                                        </script>
                                                                    <?php } else { ?>
                                                                        <input id="<?php echo $model['id'].'_'.$pitem['id']; ?>" name="product_item[<?php echo $model['id'].'_'.$pitem['id']; ?>]" class="focustip span12" type="text" value="<?php if(isset($product_model_itemr[$pitem['id']][$model['id']][1]) && $product_model_itemr[$pitem['id']][$model['id']][1] != '') { echo $product_model_itemr[$pitem['id']][$model['id']][1]; } else if(isset($product_model_itemr[$pitem['id']][$model['id']][0])){ echo $product_model_itemr[$pitem['id']][$model['id']][0]; } ?>" disabled <?php if($pitem['required_attribute'] == 1){echo 'required';}?>>
                                                                        <?php if($pitem['multi_language'] == 1) { ?>
                                                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $pitem['id']; ?>/tbl_product_item_relation_country/value" class="fancybox multi_language_edit admin_globe">
                                                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                                            </a>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>

                                            <?php $j++;} ?>
                                        <?php } ?>
                                        
                                        <div class="select-wrapper control-group">
                                            <label class="control-label"><?php echo $admin_products['parent_multiselect']['front']; ?>:</label>

                                            <div class="controls">
                                                <span class="autocomplete-select"></span>
                                            </div>
                                        </div>
                                        <input type="hidden" id="product_parent" name="product_parent" value="" />
                                        
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['product_type_title']['front']; ?>:</label>

                                            <div class="controls">
                                                <select name="product_type_id" id="product_type_id" class="focustip span12">
                                                    <?php $defaultselectedfileds = array();
                                                    foreach ($product_types as $key => $product_type) { ?>
                                                        <option value="<?php echo $product_type['id']; ?>" prev="<?php echo $product_type['menu_privilages_admin']; ?>"><?php if (isset($product_type['lang_product_type_name']) && $product_type['lang_product_type_name'] != '') { echo $product_type['lang_product_type_name']; } else { echo $product_type['product_type_name']; } ?> 
                                                        </option>
                                                    <?php 
                                                        if($key == 0){
                                                            $defaultselectedfileds = $product_type['menu_privilages_admin'] ? explode(',', $product_type['menu_privilages_admin']) : array(); 
                                                        } 
                                                    } ?>
                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('product_type_id'); ?></span>
                                        </div>
                                        
                                        <div class="productfield_display">
                                            <?php foreach ($product_items as $pitem) { ?>
                                                <div class="control-group <?php if (!in_array($pitem['id'], $defaultselectedfileds)) { echo 'displaynon'; } ?>" id="item_<?php echo $pitem['id']; ?>">
                                                    <label class="control-label"><?php echo $pitem['item_name']; ?>:</label>
                                                    <div class="controls">
                                                        <?php if ($pitem['field_type'] == 'image') { ?>
                                                            <input name="<?php echo $pitem['id']; ?>" class="focustip span12" type="file" <?php if (!in_array($pitem['id'], $defaultselectedfileds)) { echo 'disabled'; } ?>>
                                                            <img id="modelimg_prvw<?php echo $pitem['id']; ?>" src="<?php echo $noimage; ?>" alt="image preview" class="modelimgpreviewbox"/>
                                                            <div id="modelimg_prvw<?php echo $pitem['id']; ?>_delete" class="margintop-10px"></div>
                                                        <?php } else if($pitem['field_type'] == 'dropdown') { ?>
                                                            <input type="hidden" name="product_item[<?php echo $pitem['id']; ?>][field_type]" value="dropdown" <?php if (!in_array($pitem['id'], $defaultselectedfileds)) { echo 'disabled'; } ?> class="focustip span12">
                                                            <div class="input_fields_wrap" id="dropdown_<?php echo $pitem['id']; ?>" >
                                                                <button class="add_field_button btn btn-success" style="margin-bottom:15px;">Add More Fields</button>
                                                                <div style="padding-bottom:15px;"><input id="<?php echo $pitem['id']; ?>" name="product_item[<?php echo $pitem['id']; ?>][]" class="focustip span12" type="text" <?php if (!in_array($pitem['id'], $defaultselectedfileds)) { echo 'disabled'; } ?>></div>
                                                            </div>
                                                            
                                                            <script>
                                                                 $(document).ready(function() {
                                                          
                                                                       var id = "dropdown_<?php echo $pitem['id']; ?>";
                                                                        var wrapper = $("#" + id); //Fields wrapper
                                                                        var add_button = $("#" + id + " .add_field_button"); //Add button ID

                                                                        var x = 1; 
                                                                        $(add_button).click(function(e){ //on add input button click
                                                                            e.preventDefault();
                                                                            $(wrapper).append('<div style="padding-bottom:15px;"><input id="<?php echo $pitem['id']; ?>" name="product_item[<?php echo $pitem['id']; ?>][]" class="focustip span12"  type="text"/><a href="#" class="remove_field">Remove</a></div>'); 
                                                                        });

                                                                        $(wrapper).on("click",".remove_field", function(e){ 
                                                                            e.preventDefault(); $(this).parent('div').remove(); x--;
                                                                        })
                                                                });
                                                            </script>
                                                        <?php } else { ?>
                                                            <input id="<?php echo $pitem['id']; ?>" name="product_item[<?php echo $pitem['id']; ?>]" class="focustip span12" type="text" value="<?php echo set_value('product_item[' . $pitem['id'] . '][]'); ?>" <?php if (!in_array($pitem['id'], $defaultselectedfileds)) { echo 'disabled'; } ?>>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['status']['front']; ?>:</label>

                                            <div class="controls">
                                                <input type="checkbox" name="status" value="1"/>
                                            </div>
                                            <span class="red1"><?php echo form_error('status'); ?></span>
                                        </div>

                                        <div class="form-actions align-right">
                                            <input class="btn btn-primary" value="<?php echo $admin_static_links['static_add']['front']; ?>" id="send" type="submit">
                                            <input class="btn btn-danger" type="reset" value="<?php echo $admin_static_links['reset']['front']; ?>">
                                        </div>

                                    </div>

                                </div>
                                <!-- /time pickers -->


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
<?php
$options = array();
$i = 0;
foreach($products as $product) { 
    $options[$i]['label'] = $product['kgt_ref_number'];
    $options[$i]['value'] = $product['id'];
    $i++;
}
$options = json_encode($options);
?>

<script>
        $(document).ready(function() {

            $(document).on('keyup','#replenishing_period,#replenishing_period_tolerance_range',function(){
                var period = $('#replenishing_period').val() ? $('#replenishing_period').val() : 0;
                var period_range = $('#replenishing_period_tolerance_range').val() ? $('#replenishing_period_tolerance_range').val() : 0;
                $('#ex_stock_period').val(Number(period)+Number(period_range));
            });

            $(document).on('change','#replenishing_period,#replenishing_period_tolerance_range',function(){
                var period = $('#replenishing_period').val() ? $('#replenishing_period').val() : 0;
                var period_range = $('#replenishing_period_tolerance_range').val() ? $('#replenishing_period_tolerance_range').val() : 0;
                $('#ex_stock_period').val(Number(period)+Number(period_range));
            });
            
            if ($('#replenishment_order_date').length > 0) {
                $('#replenishment_order_date').datepicker({
                    timepicker: false,
                    dateFormat: 'yy-mm-dd',
                    maxDate: 0
                });
            }
            
            $("#addPartRelation").validate({
                rules: {
                    ref_no: {
                        required: true,
                        remote: {
                            url: "<?php echo base_url() . 'admin/'.$lang_id.'/part_relation/checkPartNumber'; ?>",
                            type: "post",
                            data: {
                                ref_no: function () {
                                    return $("#ref_no").val();
                                }
                            }
                        }
                    },
                    part_name: {
                        required: true
                    },
                    'packageId[]': {
                        required: true
                    },
                    quantity: {
                        required: true
                    },
                    quantity_threshold: {
                        required: true,
                        digits: true
                    },
                    replenishment_order_number: {
                        required: true
                    },
                    replenishment_order_date: {
                        required: true
                    },
                    replenishing_period: {
                        required: true,
                        digits: true
                    },
                    replenishing_period_tolerance_range: {
                        required: true,
                        digits: true
                    },
                    ex_stock_period: {
                        required: true,
                        digits: true
                    },
                    price_cad: {
                        required: true
                    },
                    price_usd: {
                        required: true
                    },
                    price_tnd: {
                        required: true
                    },
                    item_height: {
                        required: true
                    },
                    item_width: {
                        required: true
                    },
                    item_length: {
                        required: true
                    },
                    item_weight: {
                        required: true
                    },
                    item_nature_id: {
                        required: true
                    },
                    availability: {
                        required: true
                    },
                    availability_backorder_no: {
                        required: true
                    },
                    unit_of_measurement: {
                        required: true
                    },
                    country_origin: {
                        required: true
                    },
                    shipping_special_notes: {
                        required: true
                    }   
                },
                messages: {
                    ref_no: {
                        required: "<?php echo $admin_static_links['please_enter_kgs_reference']['front']; ?>",
                        remote: "<?php echo $admin_static_links['kgs_reference_already_exists']['front']; ?>"
                    }
                }
            });
            
            var autocomplete = new SelectPure(".autocomplete-select", {
                options: <?php echo $options; ?>,
                value: [],
                multiple: true,
                autocomplete: true,
                icon: "fa fa-times",
                onChange: value => {
                    $("#product_parent").val(value);
                },
            });

            $('.package-multiple').select2();
        });
</script>