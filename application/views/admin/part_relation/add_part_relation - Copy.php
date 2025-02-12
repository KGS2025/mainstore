<div class="content zerorightmargin">



    <div class="notice outer displaynon outer_message" id="outer_message">
        <div class="note product_fileMessage">
        </div>
    </div>

    <?php $noimage = getNoImage('no_image');

    //echo __FILE__;
    //print_r($product_items);
    //print_r($products);    exit;
    ?>


    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <!-- page title -->

                <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">

                        <!-- Pickers -->
                        <form id="addPartRelation" name="addPartRelation" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/part_relation/post_add_relation">
                            <input type="hidden" name="operation" value="set" />

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
                                            <label class="control-label"><?php echo $admin_products['template']['front']; ?>:</label>
                                            <div class="controls">
                                                <select name="template" id="template" class="focustip span12">
                                                    <option value="1"><?php echo $admin_products['parts_template']['front']; ?></option>
                                                    <option value="2"><?php echo $admin_products['equipment_template']['front']; ?></option>
                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('backorder_status'); ?></span>
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

                                        
                                        <?php if(count($store_data)>0){?>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['storewise_quantity']['front']; ?>:</label>
                                            <div class="controls">
                                                <?php foreach($store_data as $store){?>
                                                <div class="py1">
                                                    <span class="control-label"><?php echo $store['name']; ?>:</span>
                                                    <input name="store_quantity[]" class="store_quantity" type="text" min="0" value="0">
                                                    <input name="store_id[]" type="hidden" value="<?php echo $store['id']; ?>">
                                                </div>
                                                <?php }?>
                                            </div>
                                            <span class="red1"><?php echo form_error('min_quantity'); ?></span>
                                        </div>
                                        <?php } ?>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['quantity']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="quantity" name="quantity" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('quantity'); ?></span>
                                        </div>                
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['min_quantity']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="min_quantity" name="min_quantity" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('min_quantity'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['quantity_threshold']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="quantity_threshold" name="quantity_threshold" class="focustip span12" type="text" min="1" value="">
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
                                                <input id="replenishing_period" name="replenishing_period" class="focustip span12" type="text" min="1" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('replenishing_period'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['replenishing_period_tolerance_range']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="replenishing_period_tolerance_range" name="replenishing_period_tolerance_range" class="focustip span12" type="text" min="1" value="">
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
                                            <label class="control-label"><?php echo $admin_products['price']['front']; ?>:</label>
                                            <div class="controls">
                                                <input id="price_cad" name="price_cad" class="focustip span12" type="text" min="0" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('price_cad'); ?></span>
                                        </div>

                                        <?php
$volume_unit = get_volume_unit();
$weight_unit = get_weight_unit();
$unit_of_meas = get_unit_of_meas();
?>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['item_height']['front']; ?>( <?php echo $volume_unit; ?>):</label>
                                            <div class="controls">
                                                <input id="item_height" name="item_height" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('item_height'); ?></span>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['item_width']['front']; ?> ( <?php echo $volume_unit; ?> ):</label>
                                            <div class="controls">
                                                <input id="item_width" name="item_width" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('item_width'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['item_length']['front']; ?>( <?php echo $volume_unit; ?> ):</label>
                                            <div class="controls">
                                                <input id="item_length" name="item_length" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('item_length'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_products['item_weight']['front']; ?>( <?php echo $weight_unit; ?> ):</label>
                                            <div class="controls">
                                                <input id="item_weight" name="item_weight" class="focustip span12" type="text" value="">
                                            </div>
                                            <span class="red1"><?php echo form_error('item_weight'); ?></span>
                                        </div>

                                        <div class="select-wrapper control-group package_input">
                                            <label class="control-label"><?php echo $admin_products['package_multiple']['front']; ?>:</label>
                                            <div class="controls">
                                                <select class="package-multiple focustip span12" name="packageId[]" multiple="multiple" required>
                                                    <?php if (count($packages) > 0) {
    foreach ($packages as $package) {?>
                                                            <option value="<?=$package['package_code'];?>"><?=$package['lang_packagename'] ? $package['lang_packagename'] : $package['packagename'];?></option>
                                                        <?php }?>
                                                    <?php }?>
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
                                                        <option value="<?php echo $product_nature['id']; ?>">
                                                            <?php
if (isset($product_nature['lang_name']) && $product_nature['lang_name'] != '') {
        echo $product_nature['lang_name'];
    } else {
        echo $product_nature['name'];
    }
    ?>
                                                        </option>
                                                    <?php }?>
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
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $cart_instruction->country; ?>:</label>
                                                <div class="controls">
                                                    <select autocomplete="no-fill" name="country" id="cart_country" class="form-control selectpicker1 kgt2 required_input">
                                                        <?php foreach ($countries as $country) {?>
                                                            <option value='<?php echo htmlentities($country['countryName'], ENT_QUOTES); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" <?php if (isset($edit_data['country']) && $edit_data['country'] != '' && $edit_data['country'] == $country['lang_countryName']) {?>selected="selected" <?php } else if (isset($country['countryName']) && $country['countryName'] == $edit_data['country']) {?> selected="selected" <?php } else if (isset($ip_data['countryCode']) && strtoupper($country['alpha_2']) == $ip_data['countryCode']) {?>selected="selected" <?php } else if ($country['countryName'] == "Canada") {?>selected="selected" <?php } else if ($country['lang_countryName'] == "Canada") {?>selected="selected" <?php }?>>
                                                                <?php echo $country['countryName']; ?></option>
                                                        <?php }?>
                                                    </select>

                                                </div>
                                                <span class="red1"><?php echo form_error('country_origin'); ?></span>
                                            </div>

                                            <div class="control-group" id="item_real_photo">
                                                <label class="control-label"><?php echo $admin_products['item_real_photo']['front']; ?>:</label>

                                                <div class="controls">
                                                    <input id="item_real_photo_img" name="item_real_photo[]" class="focustip span12" type="file" multiple>
                                                    <label id="item_real_photo-error" class="error displaynon" for="item_real_photo"></label>
                                                    <!-- <img id="productimage1" src="<?php echo $noimage; ?>" alt=" image preview" class="modelimgpreviewbox" />

                                                <div id="productimage1_delete" class="margintop-10px"></div> -->
                                                </div>
                                                <span class="item_real_photo_error red1"><?php echo form_error('item_real_photo'); ?></span>
                                            </div>

                                            <div class="control-group" id="item_schematic_photo">
                                                <label class="control-label"><?php echo $admin_products['item_schematic_photo']['front']; ?>:</label>

                                                <div class="controls">
                                                    <input id="item_schematic_photo_img" name="item_schematic_photo" class="focustip span12" type="file">

                                                    <label id="item_schematic_photo-error" class="error displaynon" for="item_schematic_photo"></label>
                                                    <!-- <img id="productimage2" src="<?php echo $noimage; ?>" alt=" image preview" class="modelimgpreviewbox" />

                                                <div id="productimage2_delete" class="margintop-10px"></div> -->
                                                </div>
                                                <span class="red1"><?php echo form_error('item_schematic_photo'); ?></span>
                                                <label class="control-label"><?php echo $admin_products['item_schematic_photo_status']['front']; ?>:</label>
                                                <div class="controls">
                                                    <input type="checkbox" name="item_schematic_photo_status" value="1" />
                                                </div>
                                                <span class="item_schematic_photo_error red1"><?php echo form_error('item_schematic_photo_error'); ?></span>
                                            </div>

                                            <div class="control-group" id="vehicle_category_id">
                                                <label class="control-label"><?php echo $admin_products['product_type']['front']; ?>:</label>
                                                <?php foreach ($vehicle_categories as $catagory) {?>
                                                    <div class="controls vehicle_category_<?php echo $catagory['id']; ?>">
                                                        <input type="checkbox" name="vehicle_category_id[]" value="<?php echo $catagory['id']; ?>" />&nbsp; &nbsp;<?php if (isset($catagory['lang_category_name']) && $catagory['lang_category_name'] != '') {
    echo $catagory['lang_category_name'];
} else {
    echo $catagory['category_name'];
}?>
                                                    </div>
                                                <?php }?>
                                                <span class="red1 control-label"><?php echo form_error('vehicle_category_id'); ?></span>
                                            </div>


                                            <div class="control-group" id="maker_list">
                                                <label class="control-label"><?php echo $admin_products['maker_name']['front']; ?>:</label>
                                                <span class="red1 control-label"><?php echo form_error('vehicle_category_id'); ?></span>

                                            </div>

                                            <div class="control-group" id="model_list">
                                                <label class="control-label"><?php echo $admin_products['product_model_name']['front']; ?>:</label>
                                                <div class="model_list_with_attr"></div>
                                                <span class="red1 control-label"><?php echo form_error('vehicle_category_id'); ?></span>

                                            </div>

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
foreach ($product_types as $key => $product_type) {?>
                                                            <option value="<?php echo $product_type['id']; ?>" prev="<?php echo $product_type['menu_privilages_admin']; ?>"><?php if (isset($product_type['lang_product_type_name']) && $product_type['lang_product_type_name'] != '') {
    echo $product_type['lang_product_type_name'];
} else {
    echo $product_type['product_type_name'];
}?>
                                                            </option>
                                                        <?php
if ($key == 0) {
    $defaultselectedfileds = $product_type['menu_privilages_admin'] ? explode(',', $product_type['menu_privilages_admin']) : array();
}
}?>
                                                    </select>
                                                </div>
                                                <span class="red1"><?php echo form_error('product_type_id'); ?></span>
                                            </div>

                                            <div class="productfield_display">
                                                <?php foreach ($product_items as $pitem) {?>
                                                    <div class="control-group <?php if (!in_array($pitem['id'], $defaultselectedfileds)) {
    echo 'displaynon';
}?>" id="item_<?php echo $pitem['id']; ?>">
                                                        <label class="control-label"><?php echo $pitem['item_name']; ?>:</label>
                                                        <div class="controls">
                                                            <?php if ($pitem['field_type'] == 'image') {?>
                                                                <input name="product_item_img[<?php echo $pitem['id']; ?>]" class="focustip span12" type="file" <?php if (!in_array($pitem['id'], $defaultselectedfileds)) {
    echo 'disabled';
}?>>
                                                                <img id="modelimg_prvw<?php echo $pitem['id']; ?>" src="<?php echo $noimage; ?>" alt="image preview" class="modelimgpreviewbox" />
                                                                <div id="modelimg_prvw<?php echo $pitem['id']; ?>_delete" class="margintop-10px"></div>
                                                            <?php } else if ($pitem['field_type'] == 'dropdown') {?>
                                                                <input type="hidden" name="product_item[<?php echo $pitem['id']; ?>][field_type]" value="dropdown" <?php if (!in_array($pitem['id'], $defaultselectedfileds)) {
    echo 'disabled';
}?> class="focustip span12">
                                                                <div class="input_fields_wrap" id="dropdown_<?php echo $pitem['id']; ?>">
                                                                    <button class="add_field_button btn btn-success" style="margin-bottom:15px;">Add More Fields</button>
                                                                    <div style="padding-bottom:15px;"><input id="<?php echo $pitem['id']; ?>" name="product_item[<?php echo $pitem['id']; ?>][]" class="focustip span12" type="text" <?php if (!in_array($pitem['id'], $defaultselectedfileds)) {
    echo 'disabled';
}?>></div>
                                                                </div>

                                                                <script>
                                                                    $(document).ready(function() {

                                                                        var id = "dropdown_<?php echo $pitem['id']; ?>";
                                                                        var wrapper = $("#" + id); //Fields wrapper
                                                                        var add_button = $("#" + id + " .add_field_button"); //Add button ID

                                                                        var x = 1;
                                                                        $(add_button).click(function(e) { //on add input button click
                                                                            e.preventDefault();
                                                                            $(wrapper).append('<div style="padding-bottom:15px;"><input id="<?php echo $pitem['id']; ?>" name="product_item[<?php echo $pitem['id']; ?>][]" class="focustip span12"  type="text"/><a href="#" class="remove_field">Remove</a></div>');
                                                                        });

                                                                        $(wrapper).on("click", ".remove_field", function(e) {
                                                                            e.preventDefault();
                                                                            $(this).parent('div').remove();
                                                                            x--;
                                                                        })
                                                                    });
                                                                </script>
                                                            <?php } else {?>
                                                                <input id="<?php echo $pitem['id']; ?>" name="product_item[<?php echo $pitem['id']; ?>]" class="focustip span12" type="text" value="<?php echo set_value('product_item[' . $pitem['id'] . '][]'); ?>" <?php if (!in_array($pitem['id'], $defaultselectedfileds)) {
    echo 'disabled';
}?>>
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                <?php }?>
                                            </div>

                                         <?php if ($this->config->item('enable_distributor_feature') == "1") {?>
                                            <div class="select-wrapper control-group">
                                            <label class="control-label"><?php echo $admin_products['product_distributor']['front']; ?>:</label>
                                            <div class="controls">
                                                <select class="distributor-multiple focustip span12" name="distributor[]" multiple="multiple">
                                                    <?php if (count($distributors_data) > 0) {
    foreach ($distributors_data as $distributor) {
        if ($lang_id != 'en' && isset($distributor['lang_name'])) {
            $distributor_name = $distributor['lang_name'];
        } else {
            $distributor_name = $distributor['name'];
        }

        ?>
                                                           <option value="<?php echo $distributor['id']; ?>" > <?php echo $distributor_name; ?></option>

                                                        <?php }?>
                                                    <?php }?>
                                                </select>
                                            </div>
                                            <span class="red1"></span>
                                        </div>
<?php }?>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_products['display_kondarsoft']['front']; ?>:</label>

                                                <div class="controls">
                                                    <input type="radio" name="display_kondarsoft" value="1" /> <?php echo $admin_products['display_kondarsoft_yes']['front']; ?>
                                                    <input type="radio" name="display_kondarsoft" value="0" checked="checked" /> <?php echo $admin_products['display_kondarsoft_no']['front']; ?>
                                                </div>
                                                <span class="red1"><?php echo form_error('display_kondarsoft'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_products['status']['front']; ?>:</label>

                                                <div class="controls">
                                                    <input type="checkbox" name="status" value="1" />
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
<link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/dd.css?version=' . $ASSET_VERSION); ?>" />
<script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/msdropdown/jquery.dd.js?version=' . $ASSET_VERSION); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/flags.css?version=' . $ASSET_VERSION); ?>" />
<?php
$options = array();
$i = 0;
foreach ($products as $product) {
    $options[$i]['label'] = $product['kgt_ref_number'];
    $options[$i]['value'] = $product['id'];
    $i++;
}
$options = json_encode($options);


?>

<script>
    $(document).ready(function() {

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

        $("#addPartRelation").validate({
            rules: {
                ref_no: {
                    required: true,
                    alphanumeric: true,
                    remote: {
                        url: "<?php echo base_url() . 'admin/' . $lang_id . '/part_relation/checkPartNumber'; ?>",
                        type: "post",
                        data: {
                            ref_no: function() {
                                return $("#ref_no").val();
                            },
                            discount_id: function() {
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
                'vehicle_category_id[]': {
                    required: true
                },
                'maker_id[]': {
                    required: true
                },
                'model_id[]': {
                    required: true
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
                display_kondarsoft: {
                    required: true
                }
            },
            messages: {
                ref_no: {
                    required: "<?php echo $admin_static_links['please_enter_kgs_reference']['front']; ?>",
                    remote: "<?php echo $admin_static_links['kgs_reference_already_exists']['front']; ?>"
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
                        submit_form=false;
                        var year_val = $(this).val();
                        if($.inArray(year_val,arra_val[year_class])!==-1){
                            console.log('abc');
                            $(this).after("<span class='error'>Please Enter Unique Year</span>");
                            submit_form=false;
                        }else{
                            // submit_form=false;
                            if(year_val==""){

                                $(this).after("<span class='error'>Please Enter value</span>");
                                submit_form=false;
                            }else{
                                if($.isNumeric(year_val) && year_val.toString().length<4){
                                    $(this).after("<span class='error'>Please Enter Valid Formate YYYY</span>");
                                    submit_form=false;
                                }else{
                                    if(year_val.toString().length>4 && year_val.toString().length<9){
                                        $(this).after("<span class='error'>Please Enter Valid Format of Numbers</span>");
                                        submit_form=false;

                                    }else if(year_val.toString().length==4){

                                        if (year_val.match("^[0-9]{4}$") !== null) {
                                            arra_val[year_class].push(year_val);
                                            submit_form=true;
                                        }else{
                                            $(this).after("<span class='error'>Please Enter Valid Format YYYY</span>");
                                            submit_form=false;
                                        }
                                    }else if(year_val.toString().length==9){
                                        if (year_val.match("^[0-9]{4}\-[0-9]{4}$") !== null) {
                                            arra_val[year_class].push(year_val);
                                            submit_form=true;
                                        }else{
                                            $(this).after("<span class='error'>Please Enter Valid Format Like YYYY-YYYY</span>");
                                            submit_form=false;
                                        }
                                    } else if(year_val=="All" || year_val=="all"){
                                           arra_val[year_class].push(year_val);
                                            submit_form=true;
                                    } else{
                                        $(this).after("<span class='error'>Please Enter Valid String Like YYYY-YYYY</span>");
                                        submit_form=false;
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
                var modelCategoryMaker = [];
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


                // $('input[name^="model_id"]:checked').each(function() {
                //     console.log($(this).attr('class'));
                //     let clsName = $(this).attr('class');
                //     clsName = clsName.split(' ');
                //     let categoryId = clsName[0];
                //     categoryId = categoryId.replace('catcheck_', '');
                //     let makerId = clsName[1];
                //     makerId = makerId.replace('makercheck_', '');

                //     modelCategoryMaker.push($(this).val()+'_'+categoryId+'_'+makerId);
                // });

                // console.log("modelCategoryMaker >>>>>", modelCategoryMaker);


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
                            $(".package_input .red1").html("");
                            // If validation of the form is passed
                            var action_form = $('#addPartRelation').attr('action');
                            var proform = $('#addPartRelation')[0];
                            var data = new FormData(proform);
                            // data.append("model_categor_maker_relation", modelCategoryMaker);
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

                                        } else if (msg.element == "item_real_photo") {
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

                                        } else {
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
            value: [],
            multiple: true,
            autocomplete: true,
            icon: "fa fa-times",
            onChange: value => {
                $("#product_parent").val(value);
            },
        });

        $('.package-multiple').select2();
        $('.distributor-multiple').select2({
        maximumSelectionLength: 5
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