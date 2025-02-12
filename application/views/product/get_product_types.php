<?php

$currencyV = getDefaultCurrencyCode('l') . '_currency';
$priceV    = 'price';
$currency  = $general_instruction->$currencyV;
$loggedUserId = getFrontenduserId();
$front_validuser_data = $this->session->userdata('front_validuser_data');
$remaining_time = isset($front_validuser_data['remaining_time']) ? $front_validuser_data['remaining_time'] : 0;
$comingsoon = getNoImage('coming-soon');


foreach ($menu_product_types as $pro_type) { 
    
    $product_type_name = $pro_type['lang_product_type_name'] ? $pro_type['lang_product_type_name'] : $pro_type['product_type_name'];
    
    ?>
    <div class="ProductBlock" style="margin-bottom: 20px;">
        <div class="VehicleBlockItems">
            <div class="pro-item product_type_image_wrap step1 product_group_image_wrap">
                <div class="overflowhidden">
                    <a href="javascript:void(0);" class="product_image_wrap" data-rel="<?php echo $pro_type['id']; ?>">
                        <?php if (isset($pro_type['Product_Type_Photo']) && $pro_type['Product_Type_Photo'] != '' && file_exists("assets/uploads/product_type_images/" . $pro_type['Product_Type_Photo'])) { ?>
                            <img src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo asset_url(); ?>assets/uploads/product_type_images/<?php echo $pro_type['Product_Type_Photo']; ?>" class="img-responsive" alt="image-<?php echo $pro_type['product_type_name']; ?>" id="image_id_<?php echo $pro_type['id']; ?>" />
                        <?php } else { ?>
                            <img src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo $comingsoon; ?>" alt="coming soon" class="img-responsive" id="image_id_<?php echo $vehicle['id']; ?>" />
                        <?php } ?>
                    </a>
                    <input type="hidden" name="product_type_id[]" value="" class="product_types_id">
                </div>
                </a>
                <?php if (($this->config->item('product_group_minimum_price_show_to_guest_user') == "1" && $remaining_time <= 0 && empty($loggedUserId)) || ($this->config->item('product_group_minimum_price_show_to_all_users') == "1")) { ?>
                                                <span class="start_from"> <?php echo $general_instruction->start_from; ?> <?php echo $currency . " " . $pro_type['min_price']; ?> </span> <?php if ($pro_type['in_stock'] > 0) { ?> <span class="Instock"><?php echo strtoupper($product_instruction->in_stock); ?> </span> <?php } ?> <?php } ?>


               
            </div>
	</div>
	<div class="pro-item-title">
            <a href="javascript:void(0);" class="btn  Type_title actn-btn"><?php echo  $product_type_name; ?></a>
        </div>
    </div>
<?php } ?>
