<div class="content zerorightmargin">
    <div class="notice outer displaynon outer_message">
        <div class="note product_fileMessage">
        </div>
    </div>
    <?php
    $noimage = getNoImage('no_image');
    $values = array();
    //echo '<pre>'; print_r($productedits); exit;
    //echo '<pre>'; print_r($product_items); exit;
    //print_r($products);
    if (count($productedits) > 0) {
        foreach ($productedits as $pe) {
            $values[] = $pe['parent_product_id'];
        }
    }   
    ?>

    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <div class="body">
                    <div class="container">
                        <?php if (isset($edit_data) && !empty($edit_data)) { ?>
                            <form id="editPartRelation" name="editPartRelation" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/part_relation/post_edit_part_relation/<?php echo $edit_data['id']; ?>">
                                <input type="hidden" name="operation" value="set" />
                                <input type="hidden" id="delimageid" value="<?php echo $edit_data['id']; ?>" />
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
                                                <input id="ref_no" name="ref_no" class="focustip span12" type="text" value="<?php echo $edit_data['kgt_ref_number']; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('kgt_ref_no'); ?></span>
                                        </div>

                                        
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['template']['front']; ?>:</label>
                                            <div class="controls">
                                                <select name="template" id="template" class="focustip span12">
                                                    <option value="1" <?php if ($edit_data['template'] == "1") {
                                                                        echo 'selected';
                                                                    } ?>><?php echo $admin_products['parts_template']['front']; ?></option>
                                                    <option value="2" <?php if ($edit_data['template'] == "2") {
                                                                        echo 'selected';
                                                                    } ?>><?php echo $admin_products['equipment_template']['front']; ?></option>
                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('backorder_status'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['part_name']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="part_name" name="part_name" class="focustip span12" type="text" value="<?php echo $edit_data['part_name']; ?>">
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $edit_data['id']; ?>/products_country/part_name" class="fancybox multi_language_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>


                                            <span class="red1"><?php echo form_error('part_name'); ?></span>
                                        </div>                                        
                                        <?php 
                                        //print_r($only_stores);print_r($store_data);
                                        if(count($only_stores) > 0){?>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['storewise_quantity']['front']; ?>:</label>
                                            <div class="controls" id="ar_store_quantity">
                                                <?php 
                                                if(count($store_data)>0){
						foreach($only_stores as $store){?>
                                                    <?php 
                                                        $store_val = 0; 
                                                        foreach($store_data  as $store_qty){                                                             
                                                            if($store['id'] == $store_qty['store_id']){
                                                                $store_val = $store_qty['quantity'];
                                                                break;
                                                            }
                                                        }?>
                                                <div class="py1">
                                                    <span class="control-label"><?php echo $store['name']; ?>:</span>
                                                    <input name="store_quantity[]" class="span12 store_quantity" type="text" min="0" value="<?php echo ($store_val?$store_val:"0"); ?>">
                                                    <input name="store_id[]" type="hidden" value="<?php echo $store['id']; ?>">
                                                </div>
						<?php }}else{
                                                foreach($only_stores as $store){?>                                                
                                                <div class="py1">
                                                    <span class="control-label"><?php echo $store['name']; ?>:</span>
                                                    <input name="store_quantity[]" class="span12 store_quantity" type="text" min="0" value="0">
                                                    <input name="store_id[]" type="hidden" value="<?php echo $store['id']; ?>">
                                                </div>    
                                                <?php }}?>
                                            </div>
                                            <span class="red1"></span>
                                        </div>
                                        <?php }?>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['quantity']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="quantity" name="quantity" class="focustip span12" type="text" value="<?php echo $edit_data['quantity']; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('quantity'); ?></span>
                                            
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['min_quantity']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="min_quantity" name="min_quantity" class="focustip span12" type="text" value="<?php echo $edit_data['min_quantity']; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('min_quantity'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['quantity_threshold']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="quantity_threshold" name="quantity_threshold" class="focustip span12" type="text" min="1" value="<?php echo $edit_data['quantity_threshold']; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('quantity_threshold'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['replenishment_order_number']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="replenishment_order_number" name="replenishment_order_number" class="focustip span12" type="text" value="<?php echo $edit_data['replenishment_order_number']; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('replenishment_order_number'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['replenishment_order_date']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="replenishment_order_date" name="replenishment_order_date" class="focustip span12" type="text" value="<?php echo $edit_data['replenishment_order_date']; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('replenishment_order_date'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['replenishing_period']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="replenishing_period" name="replenishing_period" class="focustip span12" type="text" min="1" value="<?php echo $edit_data['replenishing_period']; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('replenishing_period'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['replenishing_period_tolerance_range']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="replenishing_period_tolerance_range" name="replenishing_period_tolerance_range" class="focustip span12" type="text" min="1" value="<?php echo $edit_data['replenishing_period_tolerance_range']; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('replenishing_period_tolerance_range'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['ex_stock_period']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="ex_stock_period" name="ex_stock_period" class="focustip span12" type="text" value="<?php echo $edit_data['ex_stock_period']; ?>" readonly>
                                            </div>
                                            <span class="red1"><?php echo form_error('ex_stock_period'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['backorder_status']['front']; ?>:</label>
                                            <div class="controls">
                                                <select name="backorder_status" id="backorder_status" class="focustip span12">
                                                    <!-- <option value="1" <?php if ($edit_data['backorder_status'] == 1) {
                                                                                echo 'selected';
                                                                            } ?> ><?php echo $admin_products['backorder_yes']['front']; ?></option>  
                                                <option value="0" <?php if ($edit_data['backorder_status'] == 0) {
                                                                        echo 'selected';
                                                                    } ?>><?php echo $admin_products['backorder_no']['front']; ?></option>
                                                -->
                                                    <option value="0" selected><?php echo $admin_products['backorder_no']['front']; ?></option>
                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('backorder_status'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['price']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="price_cad" name="price_cad" class="focustip span12" type="text" min="0" value="<?php echo $edit_data['price']; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('price_cad'); ?></span>
                                        </div>
                                        <?php
                                            $volume_unit = get_volume_unit();
                                            $weight_unit = get_weight_unit();

                                            $unit_of_meas = get_unit_of_meas();
                                        ?>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['item_height']['front']; ?> ( <?php echo $volume_unit; ?> ):</label>
                                            <div class="controls">
                                                <input id="item_height" name="item_height" class="focustip span12" type="text" value="<?php echo $edit_data['item_height']; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('item_height'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['item_width']['front']; ?> ( <?php echo $volume_unit; ?> ):</label>
                                            <div class="controls">
                                                <input id="item_width" name="item_width" class="focustip span12" type="text" value="<?php echo $edit_data['item_width']; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('item_width'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['item_length']['front']; ?> ( <?php echo $volume_unit; ?> ):</label>
                                            <div class="controls">
                                                <input id="item_length" name="item_length" class="focustip span12" type="text" value="<?php echo $edit_data['item_length']; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('item_length'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['item_weight']['front']; ?> ( <?php echo $weight_unit; ?>):</label>
                                            <div class="controls">
                                                <input id="item_weight" name="item_weight" class="focustip span12" type="text" value="<?php echo $edit_data['item_weight']; ?>">
                                            </div>

                                        </div>



                                        <div class="select-wrapper control-group package_input">
                                            <label class="control-label"><?php echo $admin_products['package_multiple']['front']; ?>:</label>
                                            <div class="controls">
                                                <select class="package-multiple focustip span12" name="packageId[]" multiple="multiple"  id="packageId" required>
                                                    <?php if (count($packages) > 0) {
                                                        $packageIds = explode(',', $edit_data['packageId']);
                                                        foreach ($packages as $package) { ?>
                                                            <option value="<?= $package['package_code']; ?>" <?php if (in_array($package['package_code'], $packageIds)) {
                                                                                                                    echo 'selected';
                                                                                                                } ?>><?= $package['lang_packagename'] ? $package['lang_packagename'] : $package['packagename']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <span class="red1"></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['item_nature']['front']; ?>:</label>

                                            <div class="controls">
                                                <select name="item_nature_id" id="item_nature_id" class="focustip span12">
                                                    <?php
                                                    foreach ($product_natures as $product_nature) {
                                                    ?>
                                                        <option value="<?php echo $product_nature['id']; ?>" <?php if ($product_nature['id'] == $edit_data['item_nature_id']) { ?> selected="selected" <?php } ?>>
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
                                                <input id="shipping_special_notes" name="shipping_special_notes" class="focustip span12" type="text" value="<?php echo $edit_data['shipping_special_notes']; ?>">

                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $edit_data['id']; ?>/products_country/shipping_special_notes" class="fancybox multi_language_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('shipping_special_notes'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['availability']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="availability" name="availability" class="focustip span12" type="text" value="<?php echo $cart_instruction['backorder_accept_msg']['front']; ?>" readonly>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/cart_instruction/backorder_accept_msg/front" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('availability'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['availability_backorder_no']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="availability_backorder_no" name="availability_backorder_no" class="focustip span12" type="text" value="<?php echo $cart_instruction['backorder_not_accept_msg']['front']; ?>" readonly>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/cart_instruction/backorder_not_accept_msg/front" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('availability_backorder_no'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['availability_max_msg']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="availability_max_msg" name="availability_max_msg" class="focustip span12" type="text" value="<?php echo $cart_instruction['max_availability_msg']['front']; ?>" readonly>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/cart_instruction/max_availability_msg/front" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                            <span class="red1"><?php echo form_error('availability_max_msg'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['country_origin']['front']; ?>:</label>

                                            <!-- <div class="controls">
                                                <input id="country_origin" name="country_origin" class="focustip span12" type="text" value="<?php //echo $edit_data['country_origin']; ?>">
                                            </div> -->


                                            <div class="controls">
                                                <select autocomplete="no-fill" name="country" id="cart_country" class="form-control selectpicker1 kgt2 required_input">
                                                    <?php foreach ($countries as $country) { ?>
                                                        <option value='<?php echo htmlentities($country['countryName'], ENT_QUOTES); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" <?php if (isset($edit_data['country']) && $edit_data['country'] != '' && $edit_data['country'] == $country['lang_countryName']) { ?>selected="selected" <?php } else if (isset($country['countryName']) && $country['countryName'] == $edit_data['country']) { ?> selected="selected" <?php } else if (isset($ip_data['countryCode'])  && strtoupper($country['alpha_2']) == $ip_data['countryCode']) { ?>selected="selected" <?php } else if ($country['countryName'] == "Canada") { ?>selected="selected" <?php } else if ($country['lang_countryName'] == "Canada") { ?>selected="selected" <?php } ?>>
                                                            <?php echo $country['countryName']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('country_origin'); ?></span>
                                        </div>

                                            <span class="red1"><?php echo form_error('country_origin'); ?></span>
                                        </div>

                                        <div class="control-group" id="item_real_photo">
                                            <label class="control-label"><?php echo $admin_products['item_real_photo']['front']; ?>:</label>
                                            <div class="controls">

                                                <input id="item_real_photo_img" name="item_real_photo[]" class="focustip span12" type="file" multiple>
                                                <label id="item_real_photo-error" class="error displaynon" for="item_real_photo"></label>
                                                <?php if ($edit_data['item_real_photo'] != "") {
                                                    $real_photos = explode(",", $edit_data['item_real_photo']); ?>

                                                    <input id="total_image" name="total_image" type="hidden" value="<?php echo !empty($real_photos) ? count($real_photos) : 0; ?>">
                                                    <?php foreach ($real_photos as $key => $real_photo) {
                                                        $real_photo = trim($real_photo);
                                                        $src = './assets/uploads/product_images/' . $real_photo; ?>
                                                        <img id="realPhoto<?php echo $key; ?>" src="<?php echo $src; ?>" alt=" image preview" class="modelimgpreviewbox" />
                                                        <div id="realPhoto<?php echo $key; ?>_delete" class="margintop-10px">
                                                            <input type="button" class="focustip nopadding" value="<?php echo $admin_static_links['delete_image']['front']; ?>" onclick="removeimg('realPhoto<?php echo $key; ?>', '<?php echo $real_photo; ?>');">
                                                        </div>
                                                    <?php
                                                    }
                                                } else {
                                                    $src = $noimage; ?>
                                                    <!-- <img id="productimage1" src="<?php echo $src; ?>" alt=" image preview" class="modelimgpreviewbox" />
                                                    <div id="productimage1_delete" class="margintop-10px"></div> -->

                                                <?php } ?>
                                            </div>
                                            <span class="item_real_photo_error red1"><?php echo form_error('item_real_photo'); ?></span>
                                        </div>

                                        <div class="control-group" id="item_schematic_photo">
                                            <label class="control-label"><?php echo $admin_products['item_schematic_photo']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="item_schematic_photo_img" name="item_schematic_photo" class="focustip span12" type="file">
                                                <label id="item_schematic_photo-error" class="error displaynon" for="item_schematic_photo"></label>
                                                <?php if ($edit_data['item_schematic_photo'] != "") {
                                                    $src = './assets/uploads/product_images/' . $edit_data['item_schematic_photo']; ?>
                                                    <img id="productimage2" src="<?php echo $src; ?>" alt=" image preview" class="modelimgpreviewbox" />
                                                    <div id="productimage2_delete" class="margintop-10px">
                                                        <input type="button" class="focustip nopadding" value="<?php echo $admin_static_links['delete_image']['front']; ?>" onclick="removeimg('productimage2', '');">
                                                    </div>
                                                <?php
                                                } else {
                                                    $src = $noimage; ?>
                                                    <!-- <img id="productimage2" src="<?php echo $src; ?>" alt=" image preview" class="modelimgpreviewbox" />
                                                    <div id="productimage2_delete" class="margintop-10px"></div> -->

                                                <?php } ?>
                                            </div>
                                            <label class="control-label"><?php echo $admin_products['item_schematic_photo_status']['front']; ?>:</label>
                                            <div class="controls">
                                                <input type="checkbox" name="item_schematic_photo_status" value="1" <?php if ($edit_data['item_schematic_photo_status'] == 1) {
                                                                                                                        echo 'checked';
                                                                                                                    }; ?> />
                                            </div>
                                            <span class="item_schematic_photo_error red1"><?php echo form_error('item_schematic_photo_error'); ?></span>

                                        </div>

                                        <div class="control-group" id="vehicle_category_id">
                                            <label class="control-label"><?php echo $admin_products['product_type']['front']; ?>:</label>

                                            <?php $selectedcategoryids = explode(',', $edit_data['vehicle_category_id']); ?>
                                            <?php foreach ($vehicle_categories as $catagory) { ?>
                                                <div class="controls vehicle_category_<?php echo $catagory['id']; ?>">
                                                    <input type="checkbox" name="vehicle_category_id[]" value="<?php echo $catagory['id']; ?>" <?php if (in_array($catagory['id'], $selectedcategoryids)) {
                                                                                                                                                    echo "checked=checked";
                                                                                                                                                } ?> />&nbsp; &nbsp;<?php if (isset($catagory['lang_category_name']) && $catagory['lang_category_name'] != '') {
                                                                                                                                                                        echo $catagory['lang_category_name'];
                                                                                                                                                                    } else {
                                                                                                                                                                        echo $catagory['category_name'];
                                                                                                                                                                    } ?>
                                                </div>
                                            <?php } ?>
                                            <span class="red1 control-label"><?php echo form_error('vehicle_category_id'); ?></span>

                                        </div>

                                        <div class="control-group" id="maker_list">
                                            <label class="control-label"><?php echo $admin_products['maker_name']['front']; ?>:</label>
                                            <?php $selectedmakerids = explode(',', $edit_data['maker_id']); ?>
                                            <?php foreach ($maker_info as $maker) {
                                                $vehicle_category_ids = explode(',', $maker['vehicle_category_id']);
                                                $m_vehicle_category_ids = implode(' ', $vehicle_category_ids);
                                                $class = '';
                                                $displaynon = ' displaynon';
                                                foreach ($vehicle_category_ids as $vehicle_category_id) {

                                                    $class .= " maker_" . $vehicle_category_id;
                                                    $data_cat_id .= " " . $vehicle_category_id;
                                                    if (in_array($vehicle_category_id, $selectedcategoryids)) {
                                                        $displaynon = ' ';
                                                    }
                                                } ?>
                                                <div class="controls <?php echo $class; ?><?php echo $displaynon; ?>" data-cat-id=" <?php echo  $m_vehicle_category_ids; ?>">
                                                    <input type="checkbox" name="maker_id[]" value="<?php echo $maker['id']; ?>" <?php if (in_array($maker['id'], $selectedmakerids)) {
                                                                                                                                        echo "checked=checked";
                                                                                                                                    } ?> data-name="<?php echo $maker['maker_name']; ?>" />&nbsp; &nbsp;<?php echo $maker['maker_name']; ?>
                                                </div>
                                            <?php } ?>
                                            <span class="red1 control-label"><?php echo form_error('vehicle_category_id'); ?></span>

                                        </div>
                                        <input type="hidden" id="selectedcatids" value="<?= $edit_data['vehicle_category_id']; ?>">
                                        <input type="hidden" id="selectedmakerids" value="<?= $edit_data['maker_id']; ?>">
                                        <input type="hidden" id="selectedmodelids" value="<?= $edit_data['model_id']; ?>">
                                        <input type="hidden" id="productId" value="<?= $edit_data['id']; ?>">
                                        <div class="control-group" id="model_list">
                                            <label class="control-label"><?php echo $admin_products['product_model_name']['front']; ?>:</label>
                                            <div class="model_list_with_attr"> </div>

                                            <span class="red1 control-label"><?php echo form_error('vehicle_category_id'); ?></span>

                                        </div>



                                        <!--//AR bof Selected Part Number Is Sub-Part of:--->

                                        <div class="select-wrapper control-group" style="border-bottom: 1px solid #eaeaea;">
                                            <label class="control-label"><?php echo $admin_products['parent_multiselect']['front']; ?>:</label>
                                            <div class="controls">
                                                <span class="autocomplete-select"></span>
                                            </div>
                                        </div>
                                        <div id="product_parent_error" style="color:red;padding:5px;">SKU660000000077 has a complex relation</div>

                                        <input type="text" id="product_parent" name="product_parent" value="<?php if (!empty($values)) {echo implode(',', $values); } ?>" />

                                        <!--//AR eof Selected Part Number Is Sub-Part of:--->

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['product_type_title']['front']; ?>:</label>

                                            <div class="controls">
                                                <select name="product_type_id" id="product_type_id" class="focustip span12">
                                                    <?php $defaultselectedfileds = array();
                                                    foreach ($product_types as $product_type) { ?>
                                                        <option value="<?php echo $product_type['id']; ?>" <?php if ($product_type['id'] == $edit_data['product_type_id']) { ?> selected="selected" <?php } ?> prev="<?php echo $product_type['menu_privilages_admin']; ?>"><?php if (isset($product_type['lang_product_type_name']) && $product_type['lang_product_type_name'] != '') {
                                                                                                                                                                                                                                                                                echo $product_type['lang_product_type_name'];
                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                echo $product_type['product_type_name'];
                                                                                                                                                                                                                                                                            } ?></option>
                                                    <?php

                                                        if ($product_type['id'] == $edit_data['product_type_id']) {
                                                            $defaultselectedfileds = $product_type['menu_privilages_admin'] ? explode(',', $product_type['menu_privilages_admin']) : array();
                                                        }
                                                    } ?>
                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('product_type_id'); ?></span>
                                        </div>

                                        <div class="productfield_display">
                                            <?php foreach ($product_items as $pitem) { ?>
                                                <div class="control-group <?php if (!in_array($pitem['id'], $defaultselectedfileds)) {
                                                                                echo 'displaynon';
                                                                            } ?>" id="item_<?php echo $pitem['id']; ?>">
                                                    <label class="control-label"><?php if (isset($pitem['lang_item_name']) && $pitem['lang_item_name'] != '') {
                                                                                        echo $pitem['lang_item_name'];
                                                                                    } else {
                                                                                        echo $pitem['item_name'];
                                                                                    }  ?>:</label>
                                                    <div class="controls">
                                                        <?php if ($pitem['field_type'] == 'image') { ?>
                                                            <input name="<?php echo $pitem['id']; ?>" class="focustip span12" type="file" <?php if (!in_array($pitem['id'], $defaultselectedfileds)) {
                                                                                                                                                echo "disabled";
                                                                                                                                            } ?>>
                                                            <?php if ($product_itemr[$pitem['id']] != "") {
                                                                $src = './assets/uploads/product_images/' . $product_itemr[$pitem['id']][0]; ?>
                                                                <img id="modelimg_prvw<?php echo $pitem['id']; ?>" src="<?php echo $src; ?>" alt=" image preview" class="modelimgpreviewbox" />
                                                                <div id="modelimg_prvw<?php echo $pitem['id']; ?>_delete" class="margintop-10px">
                                                                    <input type="button" class="focustip nopadding" value="Delete Image" onclick="removeimg('modelimg_prvw<?php echo $pitem['id']; ?>');">
                                                                </div>
                                                                <input name="product_item_image[<?php echo $pitem['id']; ?>]" class="focustip span12" type="hidden" value="<?= isset($product_itemr[$pitem['id']][0]) ? $product_itemr[$pitem['id']][0] : ''; ?>" <?php if (!in_array($pitem['id'], $defaultselectedfileds)) {
                                                                                                                                                                                                                                                                        echo "disabled";
                                                                                                                                                                                                                                                                    } ?>>
                                                            <?php } else {
                                                                $src = $noimage; ?>
                                                                <img id="modelimg_prvw<?php echo $pitem['id']; ?>" src="<?php echo $src; ?>" alt="image preview" class="modelimgpreviewbox" />
                                                                <div id="modelimg_prvw<?php echo $pitem['id']; ?>_delete" class="margintop-10px"></div>
                                                            <?php } ?>
                                                        <?php } else if ($pitem['field_type'] == 'dropdown') { ?>

                                                            <?php //echo "<pre>"; print_r($pitem); exit; ?>

                                                            <input type="hidden" name="product_item[<?php echo $pitem['id']; ?>][field_type]" value="dropdown" class="focustip span12" <?php if (!in_array($pitem['id'], $defaultselectedfileds)) {
                                                                                                                                                                                            echo "disabled";
                                                                                                                                                                                        } ?>>

                                                            <div class="input_fields_wrap" id="dropdown_<?php echo $pitem['id']; ?>">
                                                                <button class="add_field_button btn btn-success" style="margin-bottom:15px;">Add More Fields</button>
                                                                <?php if (isset($product_itemr[$pitem['id']]) && count($product_itemr[$pitem['id']]) > 0) { ?>
                                                                    <?php foreach ($product_itemr[$pitem['id']] as $key => $pitemdropdwon) { ?>
                                                                        <div style="padding-bottom:15px;"><input id="<?php echo $pitem['id']; ?>" name="product_item[<?php echo $pitem['id']; ?>][]" class="focustip span12" type="text" value="<?php echo $pitemdropdwon; ?>" <?php if (!in_array($pitem['id'], $defaultselectedfileds)) {
                                                                                                                                                                                                                                                                                    echo "disabled";
                                                                                                                                                                                                                                                                                } ?>>
                                                                            <?php if ($pitem['multi_language'] == 1 && isset($pitemdropdwon) && !empty($pitemdropdwon)) { ?>
                                                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $key; ?>/product_attributes_country/value" class="fancybox multi_language_edit admin_globe">
                                                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                                                </a>
                                                                            <?php } ?>
                                                                            <a href="#" class="remove_field">Remove</a>
                                                                        </div>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </div>
                                                            <script>
                                                                $(document).ready(function() {

                                                                    var id = "dropdown_<?php echo $pitem['id']; ?>";
                                                                    var wrapper = $("#" + id); //Fields wrapper
                                                                    var add_button = $("#" + id + " .add_field_button"); //Add button ID

                                                                    var x = 1; //initlal text box count
                                                                    $(add_button).click(function(e) { //on add input button click
                                                                        e.preventDefault();
                                                                        $(wrapper).append('<div style="padding-bottom:15px;"><input id="<?php echo $pitem['id']; ?>" name="product_item[<?php echo $pitem['id']; ?>][]" class="focustip span12"  type="text"/><a href="#" class="remove_field">Remove</a></div>'); //add input box

                                                                    });

                                                                    $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                                                                        e.preventDefault();
                                                                        $(this).parent('div').remove();
                                                                        x--;
                                                                    })
                                                                });
                                                            </script>
                                                        <?php } else { ?>
                                                            <!-- Here goes the text-editor                                                             -->                                           
                                                            <?php if($pitem['field_type']=='text_editor'){ ?>
                                                                <?php if (isset($product_itemr[$pitem['id']]) && $product_itemr[$pitem['id']] != '') {                                                            

                                                                    }  ?>
                                                                <textarea id="ckeditor1" name="product_item[<?php echo $pitem['id']; ?>]" class="input-field ckeditor ckeditor26 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                                    <?php if (isset($product_itemr[$pitem['id']]) && $product_itemr[$pitem['id']] != '') {                                                            
                                                                    echo reset($product_itemr[$pitem['id']]); } ?>
                                                                </textarea>
                                                                                                                         
                                                            <?php }else{?>
                                                                 <input id="<?php echo $pitem['id']; ?>" name="product_item[<?php echo $pitem['id']; ?>]" class="focustip span12" type="text" value="<?php if (isset($product_itemr[$pitem['id']]) && $product_itemr[$pitem['id']] != '') {
                                                            
                                                                                                                                                                                                    echo reset($product_itemr[$pitem['id']]);
                                                                                                                                                                                                }  ?>" >
                                                            <?php }?>                                                                                                                               
							    <?php if ($pitem['multi_language'] == 1 && isset( $product_itemr[$pitem['id']])) { 
									if($pitem['field_type']=='text_editor'){ $field_type_text_editor = '/textarea/editor';} ?>
								<a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo key($product_itemr[$pitem['id']]);; ?>/product_attributes_country/value<?php echo $field_type_text_editor;?>" class="fancybox multi_language_edit admin_globe">
                                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                                </a>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['display_kondarsoft']['front']; ?> <?php if ($edit_data['display_kondarsoft'] == 1) { ?>( <?php echo getpushedstatus($edit_data['pushed_status']); ?>) <?php } ?> :</label>

                                            <div class="controls">
                                                <input type="radio" name="display_kondarsoft" value="1" <?php if ($edit_data['display_kondarsoft'] == 1) {
                                                                                                            echo 'checked="checked"';
                                                                                                        } ?> /> <?php echo $admin_products['display_kondarsoft_yes']['front']; ?>
                                                <input type="radio" name="display_kondarsoft" value="0" <?php if ($edit_data['display_kondarsoft'] == 0) {
                                                                                                            echo 'checked="checked"';
                                                                                                        } ?> /> <?php echo $admin_products['display_kondarsoft_no']['front']; ?>
                                            </div>
                                            <span class="red1"><?php echo form_error('display_kondarsoft'); ?></span>
                                        </div>


                                        <?php if ($this->config->item('enable_distributor_feature') == "1") {?>

                                        <div class="select-wrapper control-group package_input">
                                            <label class="control-label"><?php echo $admin_products['product_distributor']['front']; ?>:</label>
                                            <div class="controls">
                                                <select class="distributor-multiple focustip span12" name="distributor[]" multiple="multiple">
                                                    <?php if (count($distributors_data) > 0) {
                                                        foreach ($distributors_data as $distributor) { 
                                                            if($lang_id != 'en' && isset($distributor['lang_name'])){
                                                                $distributor_name = $distributor['lang_name'];
                                                                }else{
                                                                $distributor_name = $distributor['name'];
                                                                }
                                                            
                                                            ?>
                                                         <option value="<?php echo $distributor['id']; ?>" <?php echo  isset($edit_data['distributor']) && in_array($distributor['id'],$edit_data['distributor']) ? "selected" : ''; ?>> <?php echo $distributor_name; ?></option>

                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <span class="red1"></span>
                                        </div>
					<?php } ?>
                                        <!-- This is for hide_partid in frontend -->
                                        <div class="control-group">
                                            <label class="control-label">Hide Part Id:</label>
                                            <div class="controls">                                                
                                                <select name="hide_partid" class="focustip span12">
                                                    <option value="1" <?php echo ($edit_data['hide_partid']?"selected":""); ?>>Yes</option>
                                                    <option value="0" <?php echo ($edit_data['hide_partid']?"":"selected"); ?>>No</option>
                                                </select>
                                             </div>  
                                        </div>
                                        <!-- End of hide_partid -->

                                        <!-- This is start of SEO module added by SUJAN MAHARJAN -->
                                                                                
                                        <div class="control-group">
                                            <label class="control-label">SEO Description:</label>
                                            <div class="controls">
                                                <input id="seo_meta_desc" name="seo_meta_desc" class="focustip span12" type="text" value="<?php echo $edit_data['seo_meta_desc']; ?>">
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $edit_data['id']; ?>/products_country/seo_meta_desc" class="fancybox multi_language_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                             </div>  
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label">SEO Meta Keywords:</label>
                                            <div class="controls">
                                                <input id="seo_meta_keywords" name="seo_meta_keywords" class="focustip span12" type="text" value="<?php echo $edit_data['seo_meta_keywords']; ?>">
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $edit_data['id']; ?>/products_country/seo_meta_keywords" class="fancybox multi_language_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                        </div>                          

                                        <!-- This is END of SEO Module added by SUJAN MAHARJAN -->
                                       

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['status']['front']; ?>:</label>

                                            <div class="controls">

                                                <input type="checkbox" name="status" value="1" <?php if ($edit_data['status'] == 1) {
                                                                                                    echo 'checked="checked"';
                                                                                                } ?> />
                                            </div>
                                            <span class="red1"><?php echo form_error('status'); ?></span>
                                        </div>


                                        <div class="form-actions align-right">
                                            <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                        </div>

                                    </div>
                                </div>
                            </form>
                            <?php $options = array();
                            $i = 0;
                            foreach ($products as $product) {
                                $options[$i]['label'] = $product['kgt_ref_number'];
                                $options[$i]['value'] = $product['id'];
                                $i++;
                            }
                            $options = json_encode($options);
                            $values = json_encode($values); ?>
                            <script>
                                $(document).ready(function() {
                                    //AR
                                    $(document).on('keyup', '#ar_store_quantity', function() { 
                                        var ar_quantity = parseInt($('#quantity').val(), 10);
                                            var ar_total = 0;
                                            $('.store_quantity').each(function() {
                                                ar_total += parseInt($(this).val(), 10) || 0;
                                            });

                                            $('#quantity').val(ar_total);
                                    });

/////////////////////////////////
            //AR packages
            $(document).on('keyup', '#item_height,#item_width,#item_weight,#item_length', function() {
                console.log('AJAX request triggered');

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'admin/' . $lang_id . '/part_relation/ar_getPackages'; ?>",
                    data: {
                        item_height: $('#item_height').val(),
                        item_length: $('#item_length').val(),
                        item_weight: $('#item_weight').val(),
                        item_width: $('#item_width').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log('Response received:', response);

                        if (response && response.length > 0) {
                            $('#packageId').empty(); // Clear existing options
                            $.each(response, function(index, package) {
                                var packageName = package.lang_packagename || package.packagename; // Use lang_packagename or fallback
                                $('#packageId').append($('<option>', {
                                    value: package.package_code,
                                    text: packageName
                                }));
                            });
                            $('#packageId').trigger('change'); // Trigger change event
                        } else {
                            $('#packageId').empty().append('<option value="">No packages found</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', status, error);
                        console.log('Response text:', xhr.responseText);
                    }
                });
            });


///////////////////////////eof packagess
/////////////////////////////////////



                                    $('.distributor-multiple').select2({
                                    maximumSelectionLength: 5
                                    });

                                    //$('.package-multiple').select2();
                                    //AR
                                    $('#packageId').select2({
                                        placeholder: 'Select a package',
                                        allowClear: true
                                    });

                                    $(document).on('keyup', '#replenishing_period,#replenishing_period_tolerance_range', function() {
                                        var period = $('#replenishing_period').val() ? $('#replenishing_period').val() : 0;
                                        var period_range = $('#replenishing_period_tolerance_range').val() ? $('#replenishing_period_tolerance_range').val() : 0;
                                        $('#ex_stock_period').val(Number(period) + Number(period_range));
                                    });

                                    $(document).on('change', '#replenishing_period,#replenishing_period_tolerance_range', function() {
                                        var period = $('#replenishing_period').val() ? $('#replenishing_period').val() : 0;
                                        var period_range = $('#replenishing_period_tolerance_range').val() ? $('#replenishing_period_tolerance_range').val() : 0;
                                        $('#ex_stock_period').val(Number(period) + Number(period_range));
                                    });

                                    if ($('#replenishment_order_date').length > 0) {
                                        $('#replenishment_order_date').datepicker({
                                            timepicker: false,
                                            dateFormat: 'yy-mm-dd',
                                            maxDate: 0
                                        });
                                    }


        jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[A-Za-z0-9]+$/.test(value);
}, "Enter Letters, numbers, Only");

        $.validator.addMethod("checkSum", function(value, element) {
                var existingQuantity = parseInt($('#quantity').val(), 10);
                var total = 0;
                $('.store_quantity').each(function() {
                    total += parseInt($(this).val(), 10) || 0;
                });
                return total == existingQuantity;
            }, "<?php echo $admin_products['storewise_qty_error']['front'];?>");


                                    $("#editPartRelation").validate({
                                        rules: {
                                            ref_no: {
                                                required: true,
                                                alphanumeric: true,
                                                remote: {
                                                    url: "<?php echo base_url() . 'admin/' . $lang_id . '/part_relation/checkPartNumber/' . $edit_data['id']; ?>",
                                                    type: "post",
                                                    data: {
                                                        ref_no: function() {
                                                            return $("#ref_no").val();
                                                        }
                                                    }
                                                }
                                            },
                                            quantity: {
                                            required: true,
                                            digits: true,
                                            min: 0,
                                            checkSum: true
                                            },
                                            min_quantity: {
                                            required: true,
                                            digits: true,
                                            min: 1
                                            },
                                            'packageId[]': {
                                                required: true
                                            },
                                            'vehicle_category_id[]': {
                                                required: true
                                            },
                                            'maker_id[]': {
                                                required: true
                                            },
                                            'model_id[]': {
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
                                            price_inr: {
                                                required: true
                                            },
                                            price_eur: {
                                                required: true
                                            },
                                            item_height: {
                                                required: true
                                            },
                                            item_width: {
                                                required: true
                                            },
                                            item_nature_id: {
                                                required: true
                                            },
                                            item_length: {
                                                required: true
                                            },
                                            item_weight: {
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
                                            display_kondarsoft: {
                                                required: true
                                            }
                                        },
                                        messages: {
                                            ref_no: {
                                                required: "<?php echo $admin_static_links['please_enter_kgs_reference']['front']; ?>",
                                                remote: "<?php echo $admin_static_links['kgs_reference_already_exists']['front']; ?>"
                                            },
                                            "packageId[]": {
                                                remote: "<?php echo $admin_static_links['packages_dimensions']['front']; ?>"
                                            }
                                        },
                                        submitHandler: function(form) {
                                             $(".error").remove();
                var submit_form = false;
                var arra_val = [];
                var test = [];
                $('input[name^="model_id"]:checked').each(function() {
                    
                    var modalID = $(this).val();
                    let className = $(this).attr('class');
                    className = className.split(' ');
                    let categoryId = className[0];
                    categoryId = categoryId.replace('catcheck_', '');
                    let makerId = className[1];
                    makerId = makerId.replace('makercheck_', '');
                    
                    var year_class = ".model_year_"+modalID+"_"+makerId;
                    arra_val[year_class] =[];
                    $(year_class).each(function(){
                        var year_val = $(this).val();
                        if($.inArray(year_val,arra_val[year_class])!==-1){
                            $(this).after("<span class='error'>Please Enter Unique Numbers</span>");
                                    submit_form=false;
                        }else{
                            if(year_val==""){
                                $(this).after("<span class='error'>Please Enter value</span>");
                                submit_form=false;
                            }else{
                                if($.isNumeric(year_val) && year_val.toString().length<4){
                                    submit_form=false;
                                    $(this).after("<span class='error'>Please Enter Valid Formate YYYY</span>");
                                }else{
                                    if(year_val.toString().length>4 && year_val.toString().length<9){
                                        submit_form=false;
                                        $(this).after("<span class='error'>Please Enter Valid Format of Numbers</span>");
                                        
                                    }else if(year_val.toString().length==4){
                                        if (year_val.match("^[0-9]{4}$") !== null) {
                                            arra_val[year_class].push(year_val);
                                            submit_form=true;
                                        }else{
                                            submit_form=false;
                                            $(this).after("<span class='error'>Please Enter Valid Format YYYY</span>");
                                        }
                                    }else if(year_val.toString().length==9){
                                        if (year_val.match("^[0-9]{4}\-[0-9]{4}$") !== null) {
                                            arra_val[year_class].push(year_val);
                                            submit_form=true;
                                        }else{
                                            submit_form=false;
                                            $(this).after("<span class='error'>Please Enter Valid Format Like YYYY-YYYY</span>");
                                        }
                                    }else if(year_val=="All" || year_val=="all"){
                                           arra_val[year_class].push(year_val);
                                            submit_form=true;
                                    }else{
                                        submit_form=false;
                                        $(this).after("<span class='error'>Please Enter Valid String Like YYYY-YYYY</span>");
                                    }
                                }
                            
                            }
                        }
                        test.push(submit_form);
                    });
                });
                if($.inArray(false,test)!==-1){
                    return false;
                }
                                            $(".package_input .red1").html("");
                                            $("#vehicle_category_id .red1").html("");
                                            $("#maker_list .red1").html("");



                                            var checkValues = [];
                                            var cat_make = 1;
                                            var make_chk = 1;
                                            var makervalues = [];
                                            $('input[name^="vehicle_category_id"]:checked').each(function() {
                                                checkValues.push($(this).val());
                                            });

                                            $.each(checkValues, function(index, value) {
                                                // alert(index + ": " + value);

                                                var catcheck = ".catcheck_" + value;

                                                if ($(catcheck).length > 0) {
                                                    if ($(catcheck + ':checkbox:checked').length < 1) {
                                                        cat_make = 0;
                                                        return false;
                                                    }


                                                } else {
                                                    cat_make = 0;
                                                    return false;

                                                }

                                            });



                                            $('input[name^="maker_id"]:checked').each(function() {
                                                makervalues.push($(this).val());
                                            });

                                            $.each(makervalues, function(index, value) {
                                                // alert(index + ": " + value);

                                                var macheck = ".makercheck_" + value;

                                                if ($(macheck).length > 0) {
                                                    if ($(macheck + ':checkbox:checked').length < 1) {
                                                        make_chk = 0;
                                                        return false;
                                                    }


                                                } else {
                                                    make_chk = 0;
                                                    return false;

                                                }

                                            });


                                            if (cat_make == 0) {

                                                $("#vehicle_category_id .red1").html("<?php echo $admin_static_links['cat_make_mod_error']['front']; ?>");
                                            }

                                            if (make_chk == 0) {

                                                $("#maker_list .red1").html("<?php echo $admin_static_links['maker_model_error']['front']; ?>");
                                            }






                                            $.ajax({
                                                type: "POST",
                                                url: "<?php echo base_url() . 'admin/' . $lang_id . '/part_relation/checkPackage'; ?>",
                                                type: "POST",
                                                data: {
                                                    packges_num: function() {
                                                        return $('.package-multiple').select2("val");
                                                    },
                                                    item_height: function() {
                                                        return $('#item_height').val();
                                                    },
                                                    item_length: function() {
                                                        return $('#item_length').val();
                                                    },
                                                    item_weight: function() {
                                                        return $('#item_weight').val();
                                                    },
                                                    item_width: function() {
                                                        return $('#item_width').val();
                                                    }
                                                },
                                                dataType: "json",
                                                success: function(data) {


                                                    if (data && cat_make == 1 && make_chk == 1) {
                                                        $("#vehicle_category_id .red1").html("");



                                                        // If validation of the form is passed

                                                        var action_form = $('#editPartRelation').attr('action');
                                                        var proform = $('#editPartRelation')[0];
                                                        var data = new FormData(proform);



                                                        $.ajax({
                                                            type: "POST",
                                                            enctype: 'multipart/form-data',
                                                            url: action_form,
                                                            data: data,
                                                            processData: false,
                                                            contentType: false,
                                                            cache: false,
                                                            dataType: "json",
                                                            beforeSend: function() {
                                                                $('#loading').show();
                                                                $('.outer_message').hide();
                                                                $('.item_real_photo_error').hide();
                                                                $('.item_schematic_photo_error').hide();


                                                            },
                                                            success: function(msg) {
                                                                $('#loading').hide();
                                                                if (msg.status == "1") {
                                                                    setTimeout(function() {
                                                                        window.location.href = '<?php echo base_url() . "admin/" . $lang_id . "/part_relation"; ?>';
                                                                    }, 2000);
                                                                    $('.outer_message').show();
                                                                    $('.product_fileMessage').html(msg.message);
                                                                    $([document.documentElement, document.body]).animate({
                                                                        scrollTop: $('.outer_message').offset().top
                                                                    }, 3000);
                                                                } else {

                                                                    if (msg.element == "outer_message") {
                                                                    $('.outer_message').show();
                                                                    $('.product_fileMessage').html(msg.message);

                                                                    $([document.documentElement, document.body]).animate({
                                                                    scrollTop: $('.outer_message').offset().top
                                                                    }, 2000);

                                                                    }else if (msg.element == "item_real_photo") {
                                                                    $('.item_real_photo_error').show();
                                                                    $('.item_real_photo_error').html(msg.message);

                                                                    $([document.documentElement, document.body]).animate({
                                                                    scrollTop: $('.item_real_photo_error').offset().top
                                                                    }, 2000);

                                                                    } else if (msg.element == "item_schematic_photo") {
                                                                    $('.item_schematic_photo_error').show();
                                                                    $('.item_schematic_photo_error').html(msg.message);

                                                                    $([document.documentElement, document.body]).animate({
                                                                    scrollTop: $('.item_schematic_photo_error').offset().top
                                                                    }, 2000);

                                                                    }  else {
                                                                    $('#' + msg.element + "-error").show();
                                                                    $('#' + msg.element + "-error").html(msg.message);

                                                                    $([document.documentElement, document.body]).animate({
                                                                    scrollTop: $('#' + msg.element + "-error").offset().top
                                                                    }, 2000);
                                                                    }
                                                                }
                                                            },
                                                            error: function(msg) {
                                                                $('.outer_message').show();
                                                                $('.product_fileMessage').html(msg.message)
                                                                $('#loading').hide();
                                                            }
                                                        });










                                                        // form.submit();



                                                    } else {

                                                        $(".package_input .red1").html("<?php echo $admin_static_links['packages_dimensions']['front']; ?>");
                                                        return false;

                                                    }
                                                }
                                            });
                                        }
                                    });

                                    var autocomplete = new SelectPure(".autocomplete-select", {
                                        options: <?php echo $options; ?>,
                                        value: <?php echo $values; ?>,
                                        multiple: true,
                                        autocomplete: true,
                                        icon: "fa fa-times",
                                        onChange: value => {
                                            alert(value);
                                            $("#product_parent").val(value);
///////////////////////
                var ar_url =  base_url + lang_id + '/part_relation/ar_checkProductsParent/<?php echo $edit_data['id']; ?>';
                // Perform the AJAX call
                        $.ajax({
                            url: ar_url, // Replace with your AJAX endpoint
                            type: "POST",
                            data: { selectedValues: value },
                            success: function (response) {
                                alert(response);
                                // Parse the response if it is a string
                                if (typeof response === "string") {
                                    alert('string');
                                    try {
                                        response = JSON.parse(response); // Convert to a JavaScript object
                                    } catch (error) {
                                        console.error("Failed to parse JSON response:", error);
                                        alert("Failed to parse JSON response:"+ error);
                                        return; // Exit the function if parsing fails
                                    }
                                }



                                alert('complexRelation: ' + response.complexRelation); // Log complexRelation
                                alert(response.updatedValues);
                                // Update values
                                const newValue = response.updatedValues || []; // Safeguard against undefined
                                const rValue = response.removedValues || []; // Safeguard against undefined
                                
                                // Display removed values as a message (if necessary)
                                if (Object.keys(rValue).length > 0) {
                                    alert('Removed values: ' + JSON.stringify(rValue)); // Display removed values

                                    $("#product_parent_error").html(JSON.stringify(rValue)); 
                                }
                                alert(newValue.join(','));
                                // Update the hidden input
                                $("#product_parent").val(newValue.join(',')); // Convert array to string

                                // Update SelectPure with the new values
                                autocomplete.setValue(newValue); // Programmatically set the new values
                            },
                            error: function (xhr, status, error) {
                                console.error("AJAX Error:", error);
                            }
                        });
/////////////////////////

                                        },
                                    });



                                    $("#cart_country").msDropdown({
                                        roundedBorder: false
                                    });


                                    $("#cart_country").change(function() {
                                        var country1 = $(this).find(':selected').attr('data-imagecss');
                                        var val = country1 ? country1.split(" ") : [];

                                        var s = $('#ship_country_title').find('img').attr('class');
                                        var sstr = s ? s.split(" ") : [];
                                        var country = sstr[1];

                                        $.ajax({
                                            type: "POST",
                                            url: base_url + lang_id + "/language/getStateByCountry",
                                            data: {
                                                countryCode: val[1],
                                                stateCode: val[1]
                                            },
                                            success: function(responce) {
                                                $("#cart-state-list").html(responce);
                                            }
                                        });
                                    });
                                });
                            </script>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/dd.css?version=' . $ASSET_VERSION); ?>" />
<script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/msdropdown/jquery.dd.js?version=' . $ASSET_VERSION); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/flags.css?version=' . $ASSET_VERSION); ?>" />
<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script>
<script>
  $(document).ready(function() {
    for (i = 1; i <= 2; i++) {
      CKEDITOR.replaceAll('ckeditor' + i, {
        height: 500
      });
    }

    for (var i in CKEDITOR.instances) {
      CKEDITOR.instances[i].on('change', function(e) {
        $('#' + e.sender.name).addClass('data-edit');
      });
    }

    $(document).on('keyup', '.input-field', function() {
      $(this).addClass('data-edit');
    });

    $(document).on('change', '.input-field', function() {
      $(this).addClass('data-edit');
    });

    $(document).on('click', '.form-submit', function() {
      $('.input-field').attr('disabled', true);
      $('.data-edit').removeAttr('disabled');
    });
  });
</script>
