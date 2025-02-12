<?php

#print_r($loggedUserData);print_r($product);exit;
$ASSET_VERSION = getenv('ASSET_VERSION');
$current_ref = $product->kgt_ref_number;
$currentproducttype = $product->product_type_name;
$tbl_product_type_id = $product->id;
$chkbox_model_id = '';
$vehicle_category_id = isset($vehicle_category->vehicle_category_id) ? $vehicle_category->vehicle_category_id : '';
$maker_id = isset($product_type->maker_id) ? $product_type->maker_id : '';

$currencyV = getDefaultCurrencyCode('l') . '_currency';
$priceV = 'price';
$currency = $general_instruction->$currencyV;
$d_price_v = $price;
$price = $product->price;
$disable_multiselect = ($this->config->item('disable_multiselect')?"1":"0");
// echo '<pre>';print_r($cart_data);echo '</pre>';die();
if (isset($cart_data[$product->id]['quantity']) && $cart_data[$product->id]['quantity']) {
    $quantity = $cart_data[$product->id]['quantity'];
} else {
    $quantity = $product->min_quantity;
}

$user_country = $loggedUserData['ship_country'];
$user_zip_code = $loggedUserData['ship_zip'];
$user_state_code = $loggedUserData['ship_state'];
$product_distributor = get_product_distributor($product->id, $user_zip_code, $user_state_code, $user_country);

$volume_unit = get_volume_unit();
$weight_unit = get_weight_unit();
$unit_of_meas = $volume_unit . "/" . $weight_unit;
///////////// Discount Section Calulation re\\lated to products ///////////////////
$user_discount = "1";
$u_price_v = "";
$u_price = "";
$d_price = "";
$d_price_v = "";
$final_discount = "";
$final_discount_v = "";

// Coupon Discount Price
if ($coupon_applied == "1") {
    $product_discount = get_product_discount($product->id, $price, $quantity, $coupon_data);
    if ($product_discount['amount']) {
        $d = $price * $product_discount['percentage'] / 100;
        $d_price = round($price - $d, 2);
        $d_price_v = $d_price . ' ' . $currency . "( " . $product_discount['percentage'] . " %)";
    }
}
// User Discount Price
$user_discount = get_user_product_discount($product->id, $price, $quantity);
if ($user_discount['amount']) {
    $u = $price * $user_discount['percentage'] / 100;
    $u_price = round($price - $u, 2);
    $u_price_v = $u_price . ' ' . $currency . "( " . $user_discount['percentage'] . " %)";
}
// check which once is bigger
$final_discount = $u_price;
$final_discount_v = $u_price_v;
// check which once is bigger
if ($coupon_applied == "1" && !empty($d_price) && !empty($u_price)) {
    if ($d_price < $u_price) {
        $final_discount = $d_price;
        $final_discount_v = $d_price_v;
    }
} else if ($coupon_applied == "1" && !empty($d_price) && empty($u_price)) {
    $final_discount = $d_price;
    $final_discount_v = $d_price_v;
}

///////////// Discount Section Calulation related to products ///////////////////

$imagecount = 0;
if ($view_type == 0) {
    $maincolspan = 7;
}
if ($view_type == 1) {
    $maincolspan = 9;
}
if (isset($cart_data[$product->id]['comment']) && $cart_data[$product->id]['comment']) {
    $comment = $cart_data[$product->id]['comment'];
} else {
    $comment = "";
}
$isBlink = 0;
$ship_elem_quant = isset($product->ship_quantity) ? $product->ship_quantity : 0;
$storeQuantity = isset($product->quantity) ? $product->quantity : $ship_elem_quant;

if (isset($cart_data[$product->id]['quantity']) && $cart_data[$product->id]['quantity']) {
    $userQuantity = $cart_data[$product->id]['quantity'];
    if ($storeQuantity > 0 && $userQuantity > $storeQuantity) {
        $quantity = $storeQuantity;
        $isBlink = 1;
    }
}

$price_request_product = $this->session->userdata('price_request_product');

?>
<style>
.card__header {
display:none;
}
.card{
    padding:0 5px!important;
}
.accordion-body .single_detail{
    display: none;
}
</style>

<div id="ar-show-parents-<?=$product->id?>"><!--P <?=$product->id?>--></div>
<?php if ($product->template == "2") {?>


<!-- ----------------------------New   Template ----------------------------------------->

<div class="prod-detail product_display_<?php echo $product->id; ?>">



        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center w-100 justify-content-between prod-header">
                    <div class="d-flex w-100 align-items-center">
                        <?php if ($storeQuantity <= 0) {?>
                            <?php if ($view_type == 0) {?>
                                <span class="position-relative">
                                    <input type="checkbox" readonly="" disabled="" />
                                    <label for=""></label>
                                </span>
                            <?php }?>
                            <?php if ($view_type == 1) {?>
                                <input type="hidden" value="<?php echo $product->id; ?>" name="product_id[]">
                            <?php }?>
                        <?php } else {?>
                            <?php if ($view_type == 0) {

    if ($this->config->item('enable_distributor_feature') == "0" || ($this->config->item('enable_distributor_feature') == "1" && empty($product_distributor))) {
        if (check_product_access($product->id)) {
            ?>
				<span class="position-relative">
                    <?php if ($disable_multiselect==0 || $view_type == 1){?>
				    <input id="Checkbox_product_type_<?php echo $product->id; ?>" type="checkbox" class="producttypecheckbox productcheckbox producttypecheckbox_<?php echo htmlspecialchars($tbl_product_type_id); ?> productcheck_<?php echo htmlspecialchars($maker_id); ?> modelcheckbox_<?php echo htmlspecialchars($product->model_id); ?> modelcheckbox_<?php echo htmlspecialchars($chkbox_model_id); ?> categorycheck_<?php echo htmlspecialchars($vehicle_category_id); ?>" value="<?php echo $tbl_product_type_id; ?>" name="product_id[]" />
				    <?php }?>
                                    <label for="Checkbox_product_type_<?php echo $product->id; ?>"></label>
                                </span>
                            <?php }}}?>
                            <?php if ($view_type == 1) {?>
                                <input type="hidden" value="<?php echo $product->id; ?>" name="product_id[]" class="width50px">
                                <input type="hidden" value="<?php echo $frieght_package; ?>" name="frieght_package[]" class="width50px">
                            <?php }?>
                        <?php }?>



                        <div class="d-inline-flex flex-wrap mb-0">


							<div class="h-col d-flex flex-column">
								<div class="h-label"><?=$product_instruction->product_no;?></div>
								<div class="h-value"><?php echo $i; ?></div>
							</div>

                            <?php if(!$product->hide_partid){ ?>
							<div class="h-col d-flex flex-column  d-none d-sm-block">
								<div class="h-label"><?=$product_instruction->part_number;?></div>
								<div class="h-value"><?php echo $product->kgt_ref_number; ?></div>
							</div>
			    <?php }?>
							<div class="h-col expanded_mode_<?php echo htmlspecialchars($tbl_product_type_id); ?>" style="display:none !important">
							<div class="h-col d-flex flex-column  d-none d-sm-block">
                                                                <div class="h-label"><?=$product_instruction->part_name;?></div>
                                                                <div class="h-value"><?php echo $product->part_name; ?></div>
                                                        </div>
							</div>


                            <?php if ($this->config->item('enable_distributor_feature') == "1" && count($product_distributor) > 0) {} else {?>
                                <div class="h-col expanded_mode_<?php echo htmlspecialchars($tbl_product_type_id); ?>" style="display:none !important">
                                    <div class="h-col d-flex flex-column">
								    <div class="h-label"><?=$product_instruction->availability;?></div>
								    <div class="h-value green"><?php if ($storeQuantity > 0) {echo strtoupper($product_instruction->in_stock);} else {echo strtoupper($product_instruction->out_of_stock) . "(" . str_replace('{ex_stock_period}', $product->ex_stock_period, $product_instruction->out_of_stock_user_msg) . ")";}?></div>
                                </div>
							</div>
                            <div class="h-col expanded_mode_<?php echo htmlspecialchars($tbl_product_type_id); ?>" style="display:none !important">
                                <div class="h-col d-flex flex-column">
                                    <div class="h-label"><?=$product_instruction->price;?></div>
                                    <?php if (check_product_access($product->id)) {?>
                                        <div class="h-value red"><?php echo $price . ' ' . $currency; ?></div>
                                    <?php } else {?>
                                        <div class="h-value red"><a href="#" data-item="<?php echo $product->id; ?>" class="add-cart-link addpricerequest <?php if (in_array($product->id, $price_request_product)) {echo "add-cart-grey";
                                        }?>"> <?php if (in_array($product->id, $price_request_product)) {
                                        echo $general_instruction->requestprice_added;
                                        } else {
                                        echo $general_instruction->requestprice;
                                        }?> </a>
                                            <input type="hidden" id="already_requested" value="<?php echo $general_instruction->requestprice_added;?>">
                                        </div>
                                    <?php }?>
                                </div>
                            </div>

							<div class="h-col d-flex flex-column b0 d-none d-sm-block" <?php if (empty($final_discount)) {?> style="display:none !important;" <?php }?>>
								<div class="h-label"><?=$product_instruction->user_discount;?></div>
								<div class="h-value red"><?php echo $final_discount_v; ?> </div>
							</div>

                          <?php }?>

                          <?php if ($disable_multiselect==1 && $view_type==0 && check_product_access($product->id)) {
                            ?>

                             <div class="h-col d-flex flex-column">
                                <div class="h-label">                               

                                </div>

                                    <div class="h-value red">
                                        <a href="<?php echo base_url() . $lang_id . '/'; ?>cart/move_to_cart/<?php echo urlencode(base64_encode($product->kgt_ref_number)); ?>" class="btn  actn-btn rounded "><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;<?php echo $general_instruction->addtocart; ?></a>
                                    </div>

                                </div>

                                <?php }?>



                        </div>
                    </div>

                    <?php if ($view_type == "1") {?>
					<span><a href="javascript:void(0);" class="black1" onClick="remove_cart(this,<?php echo $product->id; ?>);"><i class="fa fa-times"></i></a></span>
                            <?php }?>
                    <input type="button" id="minimize_block_<?php echo $tbl_product_type_id; ?>" class="minimize_block floatright1" name="minimize_block" value="-"/>
                </div>
            </div>
        </div>




    <div class="minimize_block_<?php echo htmlspecialchars($tbl_product_type_id); ?>">
		<div class="row">
		<div class="col-lg-6">




				  <div class="slider slider-for">
                        <?php

    $pro_real_images = explode(",", $product->item_real_photo);

    foreach ($pro_real_images as $single_real_image) {

        if (isset($single_real_image) && $single_real_image != '' && file_exists("assets/uploads/product_images/" . $single_real_image)) {?>
                        <div  class="slick-slide slick-current slick-active" style="display: inline-block;" aria-hidden="true"><div class="fig">

                        <a class="d-inline-block example-image-link carousel_img" data-lightbox="examplereal-<?php echo $product->id; ?>" href="<?php echo asset_url(); ?>/assets/uploads/product_images/<?php echo $single_real_image; ?>">

                        <img src="<?php echo asset_url(); ?>/assets/uploads/product_images/<?php echo $single_real_image; ?>"></a></div></div>

                        <?php }}?>
                    </div>

				    <div class="slider slider-nav" style="<?php echo (count($pro_real_images)<2?"display:none !important;":"");?>">
                        <?php
foreach ($pro_real_images as $single_real_image) {
        if (isset($single_real_image) && $single_real_image != '' && file_exists("assets/uploads/product_images/thumb/" . $single_real_image)) {?>
                        <div><div class="fig"><img src="<?php echo asset_url(); ?>/assets/uploads/product_images/thumb/<?php echo $single_real_image; ?>"></div></div>

                        <?php }}?>
                   </div>

		</div>

		<div class="col-lg-6 prod-descp">
			<div class="ele_name"><?php echo $product->part_name; ?></div>
            <!-- Added later for Ameleco Store -->
            <?php if(check_product_access($product->id)){?>
                <p>
                    <span><strong><?=$product_instruction->price;?> :</strong></span> 
                    <span <?php echo ($final_discount_v?'style="text-decoration: line-through;"':"");?>><?php echo $price . ' ' . $currency;?></span>
		</p>
		<?php if($final_discount_v) {?>
                <p>
                    <span><strong><?=$product_instruction->user_discount;?> :</strong></span> 
                    <span><?php echo $final_discount_v . ' ' . $currency;?></span>
                </p>
                <?php }?>
	    <?php }?>
	    
            <?php if ($storeQuantity > 0) {?>
                <p>
                    <span><strong><?=$product_instruction->availability;?> :</strong></span> 
                    <span><?php echo str_replace('{stock_quantity}', $storeQuantity, $product_instruction->quantity_text);?></span>
                </p>
            <?php }?>
            <?php if ($product->make) {
                     if (isset($product->maker_logo) && $product->maker_logo != '' && file_exists("assets/uploads/product_maker/" . $product->maker_logo)) {
                        $comingsoon = getNoImage('coming-soon');
                        $maker_logo = '<img class="brandmodeltitlelogo px-2" src=" ' . asset_url() . '/assets/uploads/product_maker/' . $product->maker_logo . '" data-img="' . asset_url() . '/assets/uploads/product_maker/' . $product->maker_logo. '" alt="' . $product->make . '" />';
                    } else {
                        $maker_logo = '<img class="brandmodeltitlelogo px-2" src="' . $comingsoon . '" data-img="' . $comingsoon . '" alt="coming soon" />';
                    }
                ?>
            <?php }?>
            <!-- End of Ameleco Store -->
			<?php if ($product->item_height>0||$product->item_width>0||$product->item_length>0||$product->item_weight>0) {?>
			<p>
				<span><strong><?php echo $product_instruction->unit_of_measurement; ?> :</strong></span>
				<span><?php echo $unit_of_meas; ?></span>
			</p>
			<?php }?>
			<?php if ($product->item_height>0||$product->item_width>0||$product->item_length>0) {?>
			<p>
				<span><strong><?php echo $product_instruction->item_dimension; ?> :</strong></span>
				<span><?php echo $product->item_height . 'X' . $product->item_width . 'X' . $product->item_length; ?></span>
			</p>
			<?php }?>
			<?php if($product->item_weight>0){ ?>
			<p>
				<span><strong><?php echo $product_instruction->item_weight; ?> :</strong></span>
				<span><?php echo $product->item_weight; ?></span>
			</p>
			<?php }?>            
            <?php if (($product->shipping_special_notes || count($store_data)>0) && $view_type == "1") {?>
            <?php //echo '<pre>';print_r($this->session->userdata('cart'));die();;
                if ($view_type == "1") {
                    $store_data = ($this->session->userdata('cart'));                            
                    $store_data = $store_data[$product->id]['store_data'];                        
                }
                ?>
            
            <?php $i =0;
                foreach($store_data as $store){?>
                <p>
                <span>
                    <strong>
                        <?php echo str_replace('{stock_quantity}',$store['quantity'],str_replace('{store_name}',$store['name'],$product_instruction->store_avaiable_text));?> 
                    </strong> <?php echo round($store['distance'],2);?> KM :
                </span>
                
                <?php if ($storeQuantity <= 0) {?>
                
                <span><?php echo $product_instruction->quantity; ?></span>
                <span>
                <input type="number" min="0" max="0" value="0" class="width50px" name="quantity[<?php echo $product->id; ?>]" readonly>
                </span>
                </p>
                <?php } else { ?>
                
                <span><?php echo $product_instruction->quantity; ?>:</span>
                <span class="position-relative" style="position:relative">
                <?php
                $default_qty = 0;
                if( isset($cart_data[$product->id]['quantity'][$store['store_id']])){
                    $default_qty = $cart_data[$product->id]['quantity'][$store['store_id']];
                }else{
                    $default_qty = ($i==0?1:0);
                }
                ?>
                <?php 
                    $max_qty = $store['quantity'];
                    if($this->config->item('product_quantity') < $max_qty){
                        $max_qty = $this->config->item('product_quantity');
                    }
                ?>
                <input type="number" min="0" max="<?php echo $max_qty; ?>" value="<?php echo $default_qty; ?>" class="quantity width50px" name="quantity[<?php echo $product->id; ?>][<?php echo $store['store_id'];?>]" onkeypress="return isNumber(event)" data-b="<?php echo $product->backorder_status; ?>" data-i="<?php echo $storeQuantity; ?>" data-pid="<?php echo $product->id; ?>" data-price="<?php echo $price; ?>">

                <span class="invalid-tooltip quantity_err blink_error e-<?php echo $product->id; ?>"><?php if ($isBlink) {
        echo $msg; }?></span>
                </span>
                <span class="displaynon m-<?php echo $product->id; ?>">
                <?php
$msg = str_replace('{itemquantity}', $storeQuantity, $cart_instruction->backorder_not_accept_msg);
        $msg = str_replace('{product_items}', $product->kgt_ref_number, $msg);
        echo $msg = str_replace('{ex_stock_period}', $product->ex_stock_period, $msg);
        ?>
                </span>

                <span class="displaynon qm-<?php echo $product->id; ?>">
                <?php echo $qmsg = str_replace('{max_allowed}', $this->config->item('product_quantity'), $cart_instruction->max_availability_msg); ?>
                </span>
                </p>
                <?php $i++;}?> 
            <?php  }?>      
            <?php }?>

            <?php if ($view_type == "1" && false) {?>
                <?php if ($storeQuantity <= 0) {?>
                <p>
                <span><strong><?php echo $product_instruction->quantity; ?></strong></span>
                <span>
                <input type="number" min="0" max="0" value="0" class="width50px" name="quantity[<?php echo $product->id;?>]" readonly>
                </span>
                </p>
                <?php } else {?>
                <p>
                <span><strong><?php echo $product_instruction->quantity; ?>:</strong></span>
                <span class="position-relative" style="position:relative">
                <input type="number" min="<?php echo $product->min_quantity; ?>" max="<?php echo $this->config->item('product_quantity'); ?>" value="<?php echo $quantity; ?>" class="quantity width50px" name="quantity[<?php echo $product->id; ?>]" onkeypress="return isNumber(event)" data-b="<?php echo $product->backorder_status; ?>" data-i="<?php echo $storeQuantity; ?>" data-pid="<?php echo $product->id; ?>" data-price="<?php echo $price; ?>">

                <span class="invalid-tooltip quantity_err blink_error e-<?php echo $product->id; ?>"><?php if ($isBlink) {
        echo $msg;}?></span>
                </span>
                <span class="displaynon m-<?php echo $product->id; ?>">
                <?php
$msg = str_replace('{itemquantity}', $storeQuantity, $cart_instruction->backorder_not_accept_msg);
        $msg = str_replace('{product_items}', $product->kgt_ref_number, $msg);
        echo $msg = str_replace('{ex_stock_period}', $product->ex_stock_period, $msg);
        ?>
                </span>

                <span class="displaynon qm-<?php echo $product->id; ?>">
                <?php echo $qmsg = str_replace('{max_allowed}', $this->config->item('product_quantity'), $cart_instruction->max_availability_msg); ?>
                </span>
                </p>
                <?php }?>        
            <?php }?>

            <?php if($view_type ==1){ ?>
                <p>
				<span><strong><?php echo $product_instruction->shipping_special_notes; ?> :</strong></span>
				<span><?php echo $product->shipping_special_notes; ?>             
                    <!-- <select id="shipping_special_notes" name="shipping_special_notes[<?php echo $product->id; ?>]">
                    <?php foreach($store_data as $store){?>  
                        <?php if($store['quantity']>0){ ?>                      
                            <option value="<?php echo $store['store_id'];?>" >
                                <?php //echo $store['name'] . ' ('.$store['quantity'].' unit/s) ';?>
                                <?php echo str_replace('{stock_quantity}',$store['quantity'],str_replace('{store_name}',$store['name'],$product_instruction->store_avaiable_text));?>
                            </option>
                        <?php }?>
                    <?php }?>
                    </select> -->
                </span>
			</p>
                <p>
                    <span><strong><?php echo $cart_instruction->comments; ?>:</strong></span>
                        <span>
                            <textarea onclick="this.id" class="user_comment" name="comment[<?php echo $product->id; ?>]" id="comment_<?php echo $product->id; ?>" rows="5" cols="10" placeholder="<?php echo $product_instruction->product_comment_placeholder ?>" maxlength="500"><?php echo $comment; ?></textarea>
                            <small class="pull-left">(<?php echo $product_instruction->product_comment_character ?>&nbsp;0/<span id="desc_chars_<?php echo $product->id; ?>">500</span>)</small>
                        </span>
                    <span class="comment_err blink_error"> </span>
                </p>
            <?php }?>
            <?php

    ////////////////////// Product Attributes ///////////////////
    $menu_priv = explode(',', $product->menu_privilages);
    $product_items = isset($product->product_items) ? (array) $product->product_items : array();
    foreach ($product_items as $item) {
        if ($item->field_type == 'image') {
            if (in_array($item->item_id, $menu_priv)) {
                if ($item->value) {

                    ?>
                    <p>
                    <span><strong>
                    <?php
if (isset($item->lang_item_name) && $item->lang_item_name != '') {
                        echo $item->lang_item_name;
                    } else {
                        echo $item->item_name;
                    }
                    ?> :
                    </strong></span>
                    <span>
                    <?php if (isset($item->value) && $item->value != '' && file_exists("assets/uploads/product_images/" . $item->value)) {?>
                    <img class="brandmodeltitlelogo px-2" src="<?=$this->session->userdata('default_image');?>" data-img="<?php echo asset_url(); ?>/assets/uploads/product_images/<?php echo $item->value; ?>" alt="<?php echo $item->value; ?>" />
                    <?php } else {?>
                    <img class="brandmodeltitlelogo px-2" src="<?=$this->session->userdata('default_image');?>" data-img="<?php echo $comingsoon; ?>" alt="coming soon" />
                    <?php }?>
                    </span>
                    </p>
                    <?php

                }
            }
        } else if ($item->field_type == 'text') {
            if (in_array($item->item_id, $menu_priv)&&((isset($item->lang_value) && $item->lang_value != '')||$item->value != "")) {
                ?>
                    <p>
                    <span><strong>
                    <?php
if (isset($item->lang_item_name) && $item->lang_item_name != '') {
                        echo $item->lang_item_name;
                    } else {
                        echo $item->item_name;
                    }
                    ?> :
                    </strong></span>
                    <span>
                    <?php if (isset($item->lang_value) && $item->lang_value != '') {
                        echo $item->lang_value;
                    } else {
                        echo $item->value;
                    }
                    ?>
                    </span>
                    </p>
                    <?php

            }
	}
         else if ($item->field_type == 'text_editor') {
            if (in_array($item->item_id, $menu_priv)) {
                if($item->value!="None"&&$item->value!=""){
                ?>                                

                                <p>
				<span>
				<strong>
                                <?php
                if (isset($item->lang_item_name) && $item->lang_item_name != '') {
                    echo $item->lang_item_name;
                } else {
                    echo $item->item_name;
                }
                ?> :
				</strong>
				</span>
                                <span>
                                <?php if (isset($item->lang_value) && $item->lang_value != '') {
                    echo $item->lang_value;
                } else {
                    echo $item->value;
                }
                ?>
                                </span>
                                </p>
                                <?php
                }
            }
        }
	else if ($item->field_type == 'dropdown') {
            if (in_array($item->item_id, $menu_priv) && count(explode(",",$item->value))>1) {
                ?>
                    <p>
                    <span><strong>
                    <?php
if (isset($item->lang_item_name) && $item->lang_item_name != '') {
                        echo $item->lang_item_name;
                    } else {
                        echo $item->item_name;
                    }
                    ?> :
                    </strong></span>
                    <span>
                    <?php if (isset($item->lang_value) && $item->lang_value != '') {
                        $item_d_val = $item->lang_value;
                    } else {
                        $item_d_val = $item->value;
                    }
                    $mutiple_values = explode(",", $item_d_val);
                    ?>

                    <select style="padding:0px; width: 180px;border-color:#<?=$item->item_text_color;?> !important;color:#<?=$item->item_text_color;?> !important;" name="product_item_dropdown[<?php echo $product->id ?>][]">
                    <?php foreach ($mutiple_values as $select_option) {
                        echo "<option  value='" . $select_option . "'>" . $select_option . "</option>";
                    }?>
                    </select>
                    </span>
                    </p>
                    <?php
}
        }
    }
    ////////////////////// Product Attributes ///////////////////
    ?>        
        <?php if($view_type==0) {?>
        <div class="row">
            <div class="accordion float-start w-100" id="productApplicationBlock">
            <div class="accordion-item float-start w-100">
            <h2 class="accordion-header" id="productApplication">
            <button class="accordion-button plusMinusIcons shadow-none product_model_title" type="button" data-bs-toggle="collapse" data-bs-target="#applicationCollapseOne<?php echo $product->id; ?>" aria-expanded="false" aria-controls="applicationCollapseOne<?php echo $product->id; ?>" onclick="getMakers(<?php echo $product->id; ?>)">
            <?=$product_instruction->product_model_title;?>
            </button>
            </h2>
            <div id="applicationCollapseOne<?php echo $product->id; ?>" class="accordion-collapse collapse float-start w-100" aria-labelledby="productApplication" data-bs-parent="#productApplicationBlock">
            <!--  Here application of items will be injected -->
            <div class="accordion-body float-start w-100">
            <div class="single_product_wrapper">
            <div class="detail_wrap alignleft" id="maker_data_<?php echo $product->id; ?>">
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
        </div>
        
        <p style="margin-top:10px;">
            <span><a href="<?php echo base_url() . $lang_id . '/'; ?>cart/move_to_cart/<?php echo urlencode(base64_encode($product->kgt_ref_number)); ?>" target="_blank" class="btn  actn-btn rounded"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;<?php echo $general_instruction->addtocart; ?></a></span>
        </p>
        <?php }?>
		</div>        
	 </div>
     </div>
</div>
<!-- ----------------------------New   Template END ----------------------------------------->

<?php } else {?>
<!-- ----------------------------Existing Template ----------------------------------------->

<div class="prod-detail product_display_<?php echo $product->id; ?>">

<table class="table table-bordered my-table model_table_ product_display_final">


        <thead>
        <tr>
            <th colspan="<?php echo ($maincolspan); ?>">
                <span class="d-flex align-items-center w-100 justify-content-between">
                    <span class="d-flex w-100 align-items-center">
                        <?php if ($storeQuantity <= 0) {?>
                            <?php if ($view_type == 0) {?>
                                <span class="position-relative">
                                    <input type="checkbox" readonly="" disabled="" />
                                    <label for=""></label>
                                </span>
                            <?php }?>
                            <?php if ($view_type == 1) {?>
                                <input type="hidden" value="<?php echo $product->id; ?>" name="product_id[]">
                            <?php }?>
                        <?php } else {?>
                            <?php if ($view_type == 0) {

    if ($this->config->item('enable_distributor_feature') == "0" || ($this->config->item('enable_distributor_feature') == "1" && empty($product_distributor))) {
        if (check_product_access($product->id)) {
            ?>
                                <span class="position-relative">
                                    <input id="Checkbox_product_type_<?php echo $product->id; ?>" type="checkbox" class="producttypecheckbox productcheckbox producttypecheckbox_<?php echo htmlspecialchars($tbl_product_type_id); ?> productcheck_<?php echo htmlspecialchars($maker_id); ?> modelcheckbox_<?php echo htmlspecialchars($product->model_id); ?> modelcheckbox_<?php echo htmlspecialchars($chkbox_model_id); ?> categorycheck_<?php echo htmlspecialchars($vehicle_category_id); ?>" value="<?php echo $tbl_product_type_id; ?>" name="chk_product_type[]" />
                                    <label for="Checkbox_product_type_<?php echo $product->id; ?>"></label>
                                </span>
                            <?php }}}?>
                            <?php if ($view_type == 1) {?>
                                <input type="hidden" value="<?php echo $product->id; ?>" name="product_id[]" class="width50px">
                            <?php }?>
                        <?php }?>
                        <div class="d-inline-flex align-items-center mb-0">


                             <div class="h-col d-flex flex-column">
								<div class="col-label"><?=$product_instruction->product_no;?></div>
								<div class="value ar_thead"><?php echo $i; ?></div>
							</div>
							<?php if(!$product->hide_partid){ 	?>
							<div class="h-col d-flex flex-column">
								<div class="col-label"><?=$product_instruction->part_number;?></div>
								<div class="value"><?php echo $product->kgt_ref_number; ?></div>
							</div>
							<?php }?>

							<div class="h-col d-flex flex-column">
								<div class="col-label"> <?=$product_instruction->availability;?></div>

                               <?php if ($storeQuantity > 0) {?>
								<div class="value"><?php echo strtoupper($product_instruction->in_stock); ?></div>

                                <?php } else {?>
                                    <?php echo strtoupper($product_instruction->out_of_stock); ?>

                                    <?php }?>
							</div>
                            <?php if (check_product_access($product->id)) {?>
							<div class="h-col d-flex flex-column">
								<div class="col-label"><?=$product_instruction->price;?></div>
								<div class="value"><?php echo $price . ' ' . $currency; ?></div>
							</div>
                            <?php } else {?>


                            <div class="h-col d-flex flex-column">
                            <div class="col-label"><?=$product_instruction->price;?></div>
                            <div class="value"><a href="#" data-item="<?php echo $product->id; ?>" class="add-cart-link addpricerequest <?php if (in_array($product->id, $price_request_product)) {echo "add-cart-grey";
}?>"> <?php if (in_array($product->id, $price_request_product)) {
    echo $general_instruction->requestprice_added;
} else {
    echo $general_instruction->requestprice;
}?> </a>
                            <input type="hidden" id="already_requested" value="<?php echo $general_instruction->requestprice_added; ?>"></div>
                            </div>






                           <?php }?>



                           <?php if (check_product_access($product->id)) {?>


							<div class="h-col d-flex flex-column" <?php if (empty($final_discount)) {?> style="display:none !important;" <?php }?>>
								<div class="col-label"><?=$product_instruction->user_discount;?></div>
								<div class="value"><?php echo $final_discount_v; ?></div>
							</div>

                            <?php }?>

                            <?php if($disable_multiselect==1 && $view_type==0 && check_product_access($product->id)){?>
                                <?php if ($this->config->item('enable_distributor_feature') == "0" || ($this->config->item('enable_distributor_feature') == "1" && !empty($product_distributor))) {
                                ?>

                             <div class="h-col d-flex flex-column">
                                <div class="col-label"></div>
                               <div class="value">
                                    <a href="<?php echo base_url() . $lang_id . '/'; ?>cart/move_to_cart/<?php echo urlencode(base64_encode($product->kgt_ref_number)); ?>" class="btn  actn-btn rounded cart_submit_btn_color"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;<?php echo $general_instruction->addtocart; ?></a>
                                    </div>
                                </div>

                                <?php }?>
                            <?php }?>
                        </div>
                    </span>

                    <span class="childparent-arrow" style="width:200px;">
                        <table border="0" style="width:100px;background:none;margin-bottom:0;" class="table"><tr>
                        <!--childparent-arrow-->
                        <?php if(isset($parent_products)&&count($parent_products)>=1){ ?><td>
                        <!--
                            <span id="ar-child-hide-<?php echo $product->id; ?>" class="ar-child-hide" element-count="<?=$i?>" style="padding:20px;cursor:pointer;" onclick="ar_showPCData('<?php echo $product->id; ?>','parent', '<?php echo $i; ?>')"> ↑ </span>
                        -->
                        <span id="ar-child-hide-<?php echo $product->id; ?>" class="ar-child-hide" element-count="<?=$i?>" element-total-parent="<?=count($parent_products)?>" style="padding:20px;cursor:pointer;"> ↑ </span>
                        </td><?php } ?>
                        
                        <?php if(isset($child_products)&&count($child_products)>=1){  ?><td>
                        <!--
                            <span id="ar-child-show-<?php echo $product->id; ?>" class="ar-child-show" element-count="<?=$i?>" style="padding:20px;cursor:pointer;" onclick="ar_showPCData('<?php echo $product->id; ?>','child', '<?php echo $i; ?>')"> ↓ </span>
                        -->
                            <span id="ar-child-show-<?php echo $product->id; ?>" class="ar-child-show" element-count="<?=$i?>" element-total-child="<?=count($child_products)?>" style="padding:20px;cursor:pointer;"> ↓ </span>
                        </td><?php } ?>
                        <!--eof childparent-arrow-->
                        </tr></table>
                    </span>




                    <?php if ($view_type == "1") {?>
                        <span><a href="javascript:void(0);" class="black1" onClick="remove_cart(this,<?php echo $product->id; ?>);"><i class="fa fa-times"></i></a></span>
                            <?php }?>

                    <input type="button" id="minimize_block_<?php echo $tbl_product_type_id; ?>" class="minimize_block floatright1" name="minimize_block" value="-">
                </span>
                    </th>
                 
        </tr>

        <tr class="minimize_block_<?php echo htmlspecialchars($tbl_product_type_id); ?>">
            <?php $colspan = 5;?>

            <?php if ($view_type == "1") {?>

                <th><?php echo $cart_instruction->delete_product; ?></th>

            <?php }?>

            <?php if ($view_type == "0") {?>

                <th><?php echo $product_instruction->select_product; ?></th>

            <?php }?>

            <th><?php echo $product_instruction->product_no; ?></th>
            <?php if ($view_type == "1") {?>
                <th><?php echo $product_instruction->quantity; ?></th>
                <th><?php echo $cart_instruction->comments; ?></th>

            <?php }?>
            <th><?php echo $product_instruction->part_name; ?></th>
            <th><?php echo $product_instruction->spare_part_photo; ?></th>
            <th><?php echo $product_instruction->product_sub_model_photo; ?></th>
            <?php if ($product->item_schematic_photo_status == 0) {?>
                <th><?php echo $product_instruction->where_used_schematic_photo; ?></th>
            <?php }?>
            <th>.</th>
        </tr>
        <?php //}
    ?>
        </thead>


        <tbody class="minimize_block_<?php echo htmlspecialchars($tbl_product_type_id); ?>">

        <tr class="main_info bgrgb219">
            <?php if ($storeQuantity <= 0) {?>
                <?php if ($view_type == "0") {?>
                    <td class="width60px">storeQuantity
                        <span class="position-relative">
                            <input type="checkbox" readonly="" disabled="" />
                            <label for=""></label>
                        </span>
                    </td>
                <?php }?>
            <?php } else {?>
                <?php if ($view_type == "0") {
        ?>
                    <td class="width60px">
                        <span class="position-relative">
                        <?php if ($this->config->item('enable_distributor_feature') == "0" || ($this->config->item('enable_distributor_feature') == "1" && empty($product_distributor))) {
            if (check_product_access($product->id)) {?>


                            <input id="Checkbox_product_<?php echo $product->id; ?>" type="checkbox" class="productcheckbox product_type_<?php echo htmlspecialchars($tbl_product_type_id); ?> productcheck_<?php echo htmlspecialchars($product->maker_id); ?> modelcheckbox_<?php echo htmlspecialchars($product->model_id); ?> part_<?php echo htmlspecialchars($product->id); ?> modelcheckbox_<?php echo htmlspecialchars($chkbox_model_id); ?> categorycheck_<?php echo htmlspecialchars($vehicle_category_id); ?>" value="<?php echo $product->id; ?>" name="product_id[]" />
                            <label for="Checkbox_product_<?php echo $product->id; ?>"></label>
                            <?php }}?>
                        </span>
                    </td>
                <?php }?>
            <?php }?>

            <?php if ($view_type == "1") {?>
                <td><span><a href="javascript:void(0);" class="black1" onClick="remove_cart(this,<?php echo $product->id; ?>);"><i class="fa fa-times"></i></a></span>
                </td>

            <?php }?>

            <td class="font575757 width60px">
                <span id="ar_tbody_<?php echo $product->id; ?>" class="item_count_product ar_tbody"><?php echo $i; ?></span>
            </td>

            <?php if ($view_type == "1") {?>
                <?php if ($storeQuantity <= 0) {?>
                    <td>
                        <span class="font575757">
                            <input type="number" min="0" max="0" value="0" class="width50px" name="quantity[<?php echo $product->id; ?>]" readonly>
                        </span>
                    </td>
                <?php } else {?>
                    <td>
                        <span class="font575757 needs-validation position-relative">
                            <input type="number" min="<?php echo $product->min_quantity; ?>" max="<?php echo $this->config->item('product_quantity'); ?>" value="<?php echo $quantity; ?>" class="quantity width50px" name="quantity[<?php echo $product->id; ?>]" onkeypress="return isNumber(event)" data-b="<?php echo $product->backorder_status; ?>" data-i="<?php echo $storeQuantity; ?>" data-pid="<?php echo $product->id; ?>" data-price="<?php echo $price; ?>">

                            <span class="invalid-tooltip quantity_err blink_error e-<?php echo $product->id; ?>"><?php if ($isBlink) {
        echo $msg;
    }?></span>
                        </span>
                        <span class="displaynon m-<?php echo $product->id; ?>">
                            <?php
$msg = str_replace('{itemquantity}', $storeQuantity, $cart_instruction->backorder_not_accept_msg);
        $msg = str_replace('{product_items}', $product->kgt_ref_number, $msg);
        echo $msg = str_replace('{ex_stock_period}', $product->ex_stock_period, $msg);
        ?>
                        </span>

                        <span class="displaynon qm-<?php echo $product->id; ?>">
                            <?php echo $qmsg = str_replace('{max_allowed}', $this->config->item('product_quantity'), $cart_instruction->max_availability_msg); ?>
                        </span>
                    </td>
                <?php }?>

                <td class="font575757"><span>
                        <textarea onclick="this.id" class="user_comment" name="comment[<?php echo $product->id; ?>]" id="comment_<?php echo $product->id; ?>" rows="5" cols="20" placeholder="<?php echo $product_instruction->product_comment_placeholder ?>" maxlength="500"><?php echo $comment; ?></textarea>
                        <small class="pull-left">(<?php echo $product_instruction->product_comment_character ?>&nbsp;0/<span id="desc_chars_<?php echo $product->id; ?>">500</span>)</small>
                    </span>

                    <span class="comment_err blink_error"> </span>

                </td>
            <?php }?>


            <td class="font575757">
                <span class="text-center w-100 d-block">
                   <?php echo $product->part_name; ?>
                </span>


            </td>
            <?php if ($product->item_real_photo != '') {

        $pro_real_images = explode(",", $product->item_real_photo);

        ?>

                <td class="px-0 brand_complete_info">
                    <div id="real-image-slider-<?php echo $product->id; ?>" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" style="width:200px;margin:0 auto;">
                                <?php $real_image_array = array();
        foreach ($pro_real_images as $single_real_image) {

            if (isset($single_real_image) && $single_real_image != '' && file_exists("assets/uploads/product_images/" . $single_real_image)) {?>
                                <div class="carousel-item <?php if (count($real_image_array) == 0) {
                echo 'active';
            }?>">
                                <a class="d-inline-block example-image-link carousel_img" data-lightbox="examplereal-<?php echo $product->id; ?>" href="<?php echo asset_url(); ?>/assets/uploads/product_images/<?php echo $single_real_image; ?>"><img class="img-responsive" src="<?=$this->session->userdata('default_image');?>" data-img="<?php echo asset_url(); ?>/assets/uploads/product_images/<?php echo $single_real_image; ?>" width="200" alt="<?php echo $single_real_image; ?>" /></a>
                                </div>
                                <?php } else {?>
                                <div class="carousel-item <?php if (count($real_image_array) == 0) {
                echo 'active';
            }?>">
                                <a class="d-inline-block example-image-link carousel_img" data-lightbox="examplereal-<?php echo $product->id; ?>" href="<?php echo $comingsoon; ?>"><img class="img-responsive" alt="product_images" src="<?=$this->session->userdata('default_image');?>" data-img="<?php echo $comingsoon; ?>" width="200"> </a>
                                </div>
                                <?php }

            $real_image_array[] = $single_real_image;
        }
        ?>
                        </div>
                        <!-- Left and right controls -->


                        <button class="carousel-control-prev" <?php if (count($pro_real_images) == 1) {?> style=" Display:none !important" ; <?php }?> type="button" data-bs-target="#real-image-slider-<?php echo $product->id; ?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" <?php if (count($pro_real_images) == 1) {?> style=" Display:none !important" ; <?php }?> type="button" data-bs-target="#real-image-slider-<?php echo $product->id; ?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </td>
            <?php } else {?>
                <td>
                    <a class="d-inline-block example-image-link" data-lightbox="example-<?php echo $product->id; ?>" href="<?php echo $comingsoon; ?>"><img class="img-responsive" alt="product_images" src="<?=$this->session->userdata('default_image');?>" data-img="<?php echo $comingsoon; ?>" width="120" height="80"> </a>
                </td>
            <?php }?>
            <td class="px-0 brand_complete_info">
                <div id="model-slider-<?php echo $product->id; ?>" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" style="width:200px;margin:0 auto;">
                                    <?php $modelimage_name = array();
    foreach ($product->product_models as $singlemode) {
        if (!in_array($singlemode->model_photo, $modelimage_name)) {
            if (isset($singlemode->model_photo) && $singlemode->model_photo != '' && file_exists("assets/uploads/product_model/" . $singlemode->model_photo)) {?>
                                    <div class="carousel-item <?php if (count($modelimage_name) == 0) {
                echo 'active';
            }?>">
                                    <a class="d-inline-block example-image-link carousel_img" data-lightbox="example-<?php echo $product->id; ?>" href="<?php echo asset_url(); ?>/assets/uploads/product_model/<?php echo $singlemode->model_photo; ?>"><img class="img-responsive" src="<?=$this->session->userdata('default_image');?>" data-img="<?php echo asset_url(); ?>/assets/uploads/product_model/<?php echo $singlemode->model_photo; ?>" width="200" alt="<?php echo $singlemode->model_photo; ?>" /></a>
                                    </div>
                                    <?php } else {?>
                                    <div class="carousel-item <?php if (count($modelimage_name) == 0) {
                echo 'active';
            }?>">
                                    <a class="d-inline-block example-image-link carousel_img" data-lightbox="example-<?php echo $product->id; ?>" href="<?php echo $comingsoon; ?>"><img class="img-responsive" alt="product_images" src="<?=$this->session->userdata('default_image');?>" data-img="<?php echo $comingsoon; ?>" width="200"> </a>
                                    </div>
                                    <?php }
            $modelimage_name[] = $singlemode->model_photo;
        }
    }
    ?>
                    </div>
                    <!-- Left and right controls -->

                    <button class="carousel-control-prev" <?php if (count($modelimage_name) == 1) {?> style=" Display:none !important" ; <?php }?> type="button" data-bs-target="#model-slider-<?php echo $product->id; ?>" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" <?php if (count($modelimage_name) == 1) {?> style=" Display:none !important" ; <?php }?> type="button" data-bs-target="#model-slider-<?php echo $product->id; ?>" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </td>

            <?php if ($product->item_schematic_photo_status == 0) {?>

                <?php if ($product->item_schematic_photo != '' && file_exists("assets/uploads/product_images/" . $product->item_schematic_photo)) {?>
                    <td><a class="d-inline-block example-image-link" data-lightbox="example-<?php echo $product->id; ?>" href="<?php echo asset_url(); ?>/assets/uploads/product_images/<?php echo $product->item_schematic_photo; ?>"><img class="img-responsive" src="<?=$this->session->userdata('default_image');?>" data-img="<?php echo asset_url(); ?>/assets/uploads/product_images/<?php echo $product->item_schematic_photo; ?>" height="75" /></a></td>
                <?php } else {?>
                    <td>
                        <a class="d-inline-block example-image-link" data-lightbox="example-<?php echo $product->id; ?>" href="<?php echo $comingsoon; ?>"><img class="img-responsive" alt="product_images" src="<?=$this->session->userdata('default_image');?>" data-img="<?php echo $comingsoon; ?>" width="120" height="80"> </a>
                    </td>
                <?php }?>

            <?php }?>


            <td class="font575757">
                <a href="javascript:void(0)" class="text-dark" onClick="$(this).parent().parent().siblings('.less_info').toggle(); $(this).find('.less_img').toggle();$(this).find('.more_img').toggle();">
                    <span class="less_img black2-displayinline" style="display: inline;">-</span>
                    <span class="more_img black2-nodisplay" style="display: none;">+</span>
                </a>
            </td>

        </tr>
        <tr class="less_info bgrgb219show">
            <td colspan="<?php echo $maincolspan; ?>" class="font575757-c">

                <div class="accordion float-start w-100" id="productAttributesBlock">
                    <div class="accordion-item float-start w-100">
                        <h2 class="accordion-header" id="productAttributes">
                            <button class="accordion-button plusMinusIcons shadow-none product_attr_title" type="button" data-bs-toggle="collapse" data-bs-target="#attributesCollapseOne<?php echo $product->id; ?>" aria-expanded="false" aria-controls="attributesCollapseOne<?php echo $product->id; ?>" style="color:#<?php echo $colors['product_attr_title_color']; ?> !important;">
                                <?=$product_instruction->product_attr_title;?>
                            </button>
                        </h2>
                        <div id="attributesCollapseOne<?php echo $product->id; ?>" class="accordion-collapse collapse" aria-labelledby="productAttributes" data-bs-parent="#productAttributesBlock">
                            <div class="accordion-body">
                                <div class="single_product_wrapper">
                                    <div class="detail_wrap alignleft d-flex flex-wrap">
                                        <div class="single_detail">
                                            <span><?php echo $product_instruction->product_type_title; ?> :</span>
                                            <span>
                                                <?php if ($view_type == 0) {
        echo $product->product_type_name;
    }

    if ($view_type == 1) {
        echo $product->product_type_name;
    }?>
                                            </span>
					</div>
					<?php if ($product->item_height>0||$product->item_width>0||$product->item_length>0||$product->item_weight>0) {?>
                                        <div class="single_detail">
                                            <span><?php echo $product_instruction->unit_of_measurement; ?> :</span>
                                            <span><?php echo $unit_of_meas; ?></span>
					</div>
					<?php }?>
					<?php if ($product->item_height>0||$product->item_width>0||$product->item_length>0) {?>
                                        <div class="single_detail">
                                            <span><?php echo $product_instruction->item_dimension; ?> :</span>
                                            <span><?php echo $product->item_height . 'X' . $product->item_width . 'X' . $product->item_length; ?></span>
					</div>
					<?php }?>
					<?php if ($product->item_weight>0) {?>
                                        <div class="single_detail">
                                            <span><?php echo $product_instruction->item_weight; ?> :</span>
                                            <span><?php echo $product->item_weight; ?></span>
					</div>
					<?php }?>

                                        <?php if ($product->shipping_special_notes) {?>
                                        <div class="single_detail">
                                            <span><?php echo $product_instruction->shipping_special_notes; ?> :</span>
                                            <span><?php echo $product->shipping_special_notes; ?></span>
                                        </div>
                                        <?php }?>

                                <?php

    // display only product items
    $menu_priv = explode(',', $product->menu_privilages);

    $product_items = isset($product->product_items) ? (array) $product->product_items : array();

    foreach ($product_items as $item) {

        if ($item->field_type == 'image') {
            if (in_array($item->item_id, $menu_priv)) {
                if ($item->value) {

                    ?>
                                <div class="single_detail" style="color:#<?=$item->item_text_color;?> !important; ">
                                <span>
                                <?php
if (isset($item->lang_item_name) && $item->lang_item_name != '') {
                        echo $item->lang_item_name;
                    } else {
                        echo $item->item_name;
                    }
                    ?> :
                                </span>
                                <span>
                                <?php if (isset($item->value) && $item->value != '' && file_exists("assets/uploads/product_images/" . $item->value)) {?>
                                <img class="brandmodeltitlelogo px-2" src="<?=$this->session->userdata('default_image');?>" data-img="<?php echo asset_url(); ?>/assets/uploads/product_images/<?php echo $item->value; ?>" alt="<?php echo $item->value; ?>" />
                                <?php } else {?>
                                <img class="brandmodeltitlelogo px-2" src="<?=$this->session->userdata('default_image');?>" data-img="<?php echo $comingsoon; ?>" alt="coming soon" />
                                <?php }?>



                                </span>
                                </div>
                                <?php
}

            }
        } else if ($item->field_type == 'text') {
            if (in_array($item->item_id, $menu_priv)&&((isset($item->lang_value) && $item->lang_value != '')||$item->value != "")) {
                ?>
                                <div class="single_detail" style="color:#<?=$item->item_text_color;?> !important; ">
                                <span>
                                <?php
if (isset($item->lang_item_name) && $item->lang_item_name != '') {
                        echo $item->lang_item_name;
                    } else {
                        echo $item->item_name;
                    }
                    ?> :
                                </span>
                                <span>
                                <?php if (isset($item->lang_value) && $item->lang_value != '') {
                        echo $item->lang_value;
                    } else {
                        echo $item->value;
                    }
                    ?>
                                </span>
                                </div>
                                <?php

            }
        } else if ($item->field_type == 'text_editor') {
            if (in_array($item->item_id, $menu_priv)) {
                ?>                                
                                <div class="single_detail" style="color:#<?=$item->item_text_color;?> !important; display:inline-block;">
                                <span>
                                <?php
if (isset($item->lang_item_name) && $item->lang_item_name != '') {
                    echo $item->lang_item_name;
                } else {
                    echo $item->item_name;
                }
                ?> :
                                </span>
                                <span>
                                <?php if (isset($item->lang_value) && $item->lang_value != '') {
                    echo $item->lang_value;
                } else {
                    echo $item->value;
                }
                ?>
                                </span>
                                </div>
                                <?php

            }
        } else if ($item->field_type == 'dropdown') {
            if (in_array($item->item_id, $menu_priv)) {
                ?>
                                <div class="single_detail" style="color:#<?=$item->item_text_color;?> !important; ">
                                <span>
                                <?php
if (isset($item->lang_item_name) && $item->lang_item_name != '') {
                        echo $item->lang_item_name;
                    } else {
                        echo $item->item_name;
                    }
                    ?> :
                                </span>
                                <span>
                                <?php if (isset($item->lang_value) && $item->lang_value != '') {
                        $item_d_val = $item->lang_value;
                    } else {
                        $item_d_val = $item->value;
                    }

                    $mutiple_values = explode(",", $item_d_val);

                    ?>

                                <select style="padding:0px; width: 180px;border-color:#<?=$item->item_text_color;?> !important;color:#<?=$item->item_text_color;?> !important;" name="product_item_dropdown[<?php echo $product->id ?>][]">

                                <?php foreach ($mutiple_values as $select_option) {
                        echo "<option  value='" . $select_option . "'>" . $select_option . "</option>";
                    }?>
                                </select>






                                </span>
                                </div>
                                <?php

            }
        }
    }

    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr class="less_info bgrgb219show">
            <td colspan="<?php echo $maincolspan; ?>" class="font575757-c">
                <div class="accordion float-start w-100" id="productApplicationBlock">
                    <div class="accordion-item float-start w-100">
                        <h2 class="accordion-header" id="productApplication">
                            <button class="accordion-button plusMinusIcons shadow-none product_model_title" type="button" data-bs-toggle="collapse" data-bs-target="#applicationCollapseOne<?php echo $product->id; ?>" aria-expanded="false" aria-controls="applicationCollapseOne<?php echo $product->id; ?>" style="color:#<?php echo $colors['product_model_title_color']; ?> !important;" onclick="getMakers(<?php echo $product->id; ?>)">
                                <?=$product_instruction->product_model_title;?>
                            </button>
                        </h2>
                        <div id="applicationCollapseOne<?php echo $product->id; ?>" class="accordion-collapse collapse float-start w-100" aria-labelledby="productApplication" data-bs-parent="#productApplicationBlock">
                            <!---  Here application of items will be injected -->
                            <div class="accordion-body float-start w-100">
                                <div class="single_product_wrapper">
                                    <div class="detail_wrap alignleft" id="maker_data_<?php echo $product->id; ?>">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>

        </tbody>
</table>
</div>
<!-- ----------------------------Existing Template  END ----------------------------------------->
<?php } ?>
<div id="ar-show-childs-<?=$product->id?>"><!--C <?=$product->id?>--></div>

<!-- ----------------------------Starting of Parent Products ----------------------------------------->
<?php 
//echo "<br/>Current Product :".  $product->kgt_ref_number .', ID: '.$product->id.'<br/>';
?>
  
<?php /*?>
  <?php if(isset($parent_products)&&count($parent_products)>=1){ ?>
        <div id="child-hide-<?php echo $product->id; ?>" class="child-hide" element-count="<?=$i?>">(Parent Product <?php echo $product->id; ?>) ↑ </div>
     
        <div class="parent_product_block related_product_block">
            <div class="col-md-12">
                    <h4>Parents</h4>
                    <div class="product-list-list filter-list related-products-list" style="">
                        <div id="menu_product_list_block" class="float-start w-100">
                            <div class="AllProducts ar_parent">
                                <table border="1" class="table table-bordered my-table model_table_ product_display_final" width="100%">
                                    <thead>
                                        <tr>
                                            <td>ID</td>
                                            <td>Display</td>
                                            <td>Name</td>
                                            <td>SKU</td>
                                            <td></td>
                                        </tr>   
                                    </thead>
                                    <tbody>
                               <?php //print_r($parent_products);  
                               $ar_p=1;                              
                               foreach ($parent_products as $pinfo) { 
                                $number = $i. ".P." . $ar_p;
                                    
                               // $product_type_name = $single_product->lang_product_type_name ? $single_product->lang_product_type_name : $single_product->product_type_name;
                                if ($pinfo->item_real_photo != '') {
                                    $pro_real_images = explode(",", $pinfo->item_real_photo);
                                     }
                                     $url_link = (base_url() . $this->lang->default_lang . '/' . 'products/product_list/' . $pinfo['kgt_ref_number'].'/'.str_replace("%2F","-",urlencode($pinfo['product_type_name'])).'-'.str_replace("%2F","-",urlencode($pinfo['part_name'])));
                                    echo '<tr>
                                            <td>'.$pinfo['id'].'</td>
                                             <td>'.$number.'</td>
                                            <td>'.$pinfo['part_name'].'</td>
                                            <td>'.$pinfo['kgt_ref_number'].'</td>
                                            <td> <a href="'.$url_link.'" class="btn actn-btn btn-omega" target="_blank">'. $general_instruction->more_detail.'</a></td>
                                        </tr>';
                                        $ar_p++;
                               }
                               
                               ?>
                                 </tbody>
                               </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <br/>
    <?php }?>
<!-- ----------------------------Starting of Child Products ----------------------------------------->
<?php if(isset($child_products)&&count($child_products)>=1){  ?>
    <div id="child-show-<?php echo $product->id; ?>" class="child-show" element-count="<?=$i?>">Child Product <?php echo $product->id; ?> ↓ </div>
     
        <div class="child_product_block">
            <div class="col-md-12">
                     <h4>Childs</h4>
                    <div class="product-list-list filter-list related-products-list" style="">
                        <div id="menu_product_list_block" class="float-start w-100">
                            <div class="AllProducts ar_child">
                                <table border="1" class="table table-bordered my-table model_table_ product_display_final" width="100%">
                                        <thead>
                                            <tr>
                                                <td>ID</td>
                                                <td>Display</td>
                                                <td>Name</td>
                                                <td>SKU</td>
                                                <td></td>
                                            </tr>   
                                        </thead>
                                        <tbody>
                                <?php //print_r($parent_products);      
                                 $ar_c=1;                          
                                foreach ($child_products as $pinfo) { 
                                    $number = $i. ".C." . $ar_c;
                                // $product_type_name = $single_product->lang_product_type_name ? $single_product->lang_product_type_name : $single_product->product_type_name;
                                    if ($pinfo->item_real_photo != '') {
                                        $pro_real_images = explode(",", $pinfo->item_real_photo);
                                        }
                                        $url_link = (base_url() . $this->lang->default_lang . '/' . 'products/product_list/' . $pinfo['kgt_ref_number'].'/'.str_replace("%2F","-",urlencode($pinfo['product_type_name'])).'-'.str_replace("%2F","-",urlencode($pinfo['part_name'])));
                                        echo '<tr>
                                                <td>'.$pinfo['id'].'</td>
                                                <td>'.$number.'</td>
                                                <td>'.$pinfo['part_name'].'</td>
                                                <td>'.$pinfo['kgt_ref_number'].'</td>
                                                <td> <a href="'.$url_link.'" class="btn actn-btn btn-omega" target="_blank">'. $general_instruction->more_detail.'</a></td>
                                            </tr>';
                                            $ar_c++;
                                }
                                
                                ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <br/><br/><br/>
    <?php }?>
<?php */ ?>
<!-- ----------------------------Starting of Related Products ----------------------------------------->
<?php if($this->config->item('show_related_products')){?>
    <?php if(isset($products)&&count($products)<2){?>
        <div class="related_product_block">
            <div class="col-md-12">
                <?php $this->load->view('product/related_products'); ?>
            
            </div>
    </div>
    <?php }?>
<?php }?>
<!-- ----------------------------Related Products END ----------------------------------------->
<?php if($this->config->item('show_collapse_bar')){?>
<?php if($this->config->item('auto_show_collapse_bar')){?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){        
        //$(".product_model_title").trigger("click");    
        getMakersAuto('<?php echo $product->id; ?>');             
    });
</script>
<?php }}?>