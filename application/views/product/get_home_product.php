<?php
$comingsoon = getNoImage('coming-soon');
$currencyV = getDefaultCurrencyCode('l') . '_currency';
$priceV = 'price';
$currency = $general_instruction->$currencyV;
$loggedUserId = getFrontenduserId();
$front_validuser_data = $this->session->userdata('front_validuser_data');
$remaining_time = isset($front_validuser_data['remaining_time']) ? $front_validuser_data['remaining_time'] : 0;
$cart = $this->session->userdata('cart');
$loggedUserData = loginuserdata();
$lang_id = $this->lang->default_lang;
$price_request_product = $this->session->userdata('price_request_product');

?>


<?php foreach ($product_list as $single_product) {

    $product_type_name = $single_product->lang_product_type_name ? $single_product->lang_product_type_name : $single_product->product_type_name;

    $product_name = $single_product->lang_part_name ? $single_product->lang_part_name : $single_product->part_name;
    $user_country = $loggedUserData['ship_country'];
    $user_zip_code = $loggedUserData['ship_zip'];
    $user_state_code = $loggedUserData['ship_state'];

    $currencyV = getDefaultCurrencyCode('l') . '_currency';
    $priceV = 'price';
    $currency = $general_instruction->$currencyV;
    $price = $single_product->$priceV;

    $product_number = urlencode(base64_encode($single_product->kgt_ref_number));

    $product_distributor = get_product_distributor($single_product->id, $user_zip_code, $user_state_code, $user_country);
//print_r($product_distributor);

    ?>
  <div class="ProductBlock" style="margin-bottom: 20px;">
                                        <div class="VehicleBlockItems h-float">
                                            <div class="pro-item product_type_image_wrap">
                                                <div class="overflowhidden">
                                                    <?php if ($single_product->item_real_photo != '') {

        $pro_real_images = explode(",", $single_product->item_real_photo);

        ?>

                                                        <div id="real-image-slider-<?php echo trim($single_product->id); ?>" class="carousel slide" data-ride="carousel">
                                                            <div class="carousel-inner" style="width:100%;margin:0 auto;">
                                                                <?php $real_image_array = array();
        foreach ($pro_real_images as $single_real_image) {

            if (isset($single_real_image) && $single_real_image != '' && file_exists("assets/uploads/product_images/" . $single_real_image)) {?>
                                                                        <div class="carousel-item <?php if (count($real_image_array) == 0) {
                echo 'active';
            }?>">
                                                                            <a class="d-inline-block example-image-link carousel_img" data-lightbox="examplereal-<?php echo $single_product->id; ?>" href="<?php echo asset_url(); ?>/assets/uploads/product_images/<?php echo $single_real_image; ?>"><img class="img-responsive" src="<?=$this->session->userdata('default_image');?>" data-img="<?php echo asset_url(); ?>/assets/uploads/product_images/<?php echo $single_real_image; ?>" width="200" alt="<?php echo $single_real_image; ?>" /></a>
                                                                        </div>
	    
                                                                    <?php } else {?>
                                                                        <div class="carousel-item <?php if (count($real_image_array) == 0) {
                echo 'active';
            }?>">
                                                                            <a class="d-inline-block example-image-link carousel_img" data-lightbox="examplereal-<?php echo $single_product->id; ?>" href="<?php echo $comingsoon; ?>"><img class="img-responsive" alt="product_images" src="<?=$this->session->userdata('default_image');?>" data-img="<?php echo $comingsoon; ?>" width="200"> </a>
                                                                        </div>
                                                                <?php }

            $real_image_array[] = $single_real_image;
        }
        ?>
                                                            </div>
                                                            <!-- Left and right controls -->


                                                            <button class="carousel-control-prev" <?php if (count($pro_real_images) == 1) {?> style=" Display:none !important" ; <?php }?> type="button" data-bs-target="#real-image-slider-<?php echo trim($single_product->id); ?>" data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" <?php if (count($pro_real_images) == 1) {?> style=" Display:none !important" ; <?php }?> type="button" data-bs-target="#real-image-slider-<?php echo trim($single_product->id); ?>" data-bs-slide="next">
                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </button>
                                                        </div>

                                                    <?php } else {?>

                                                        <a class="d-inline-block example-image-link empty-img" data-lightbox="example-<?php echo $single_product->id; ?>" href="<?php echo $comingsoon; ?>"><img class="img-responsive" alt="product_images" src="<?=$this->session->userdata('default_image');?>" data-img="<?php echo $comingsoon; ?>" width="120" height="80"> </a>

                                                    <?php }?>

                                                </div>

												<div class="d-flex price">
													 <?php if ($this->config->item('enable_distributor_feature') == "1" && count($product_distributor) > 0) {?>


                                                    <?php } else {?>



                                                        <?php if ($single_product->quantity > 0) {?>
                                                        <span class="Instock Instock_detail"><?php echo strtoupper($product_instruction->in_stock); ?> </span>
                                                        <?php } else {?>

                                                            <span class="Instock Outstock_detail"><?php echo strtoupper($product_instruction->out_of_stock); ?> </span>

                                                            <?php }?>

                                                        <span class="start_from"> <?php //echo $product_instruction->price;

        if ($this->config->item('show_searchbyproduct_price_to_guest_user') == "1" || !empty($loggedUserId)) {

            if (check_product_access($single_product->id)) {
                ?>
                                                        <?php echo $currency . " " . $price; ?>

                                                        <?php }?>



                                                        <?php } else {?>
                                                        <a href="<?php echo base_url() . $lang_id . '/' . 'user/login/'; ?>" class="availnow_buton" > <?php echo $product_instruction->avail_now; ?> </a>
                                                        <?php }?>
                                                        </span>


                                                    <?php }?>

                                                 </div>

												<div class="d-flex <?php if ($this->config->item('enable_distributor_feature') == "1" && count($product_distributor) > 0) {?> col-one <?php }?>">


												<div class="col-left">
                                                <a href="javascript:void(0);" class="prod-name">
													<span class="element_desc"> <?php echo $product_name; ?> </span>
													<span class="element_desc element_name"> <?php echo $product_type_name; ?> </span>
												</a>



												</div>
<!--
												<div class="col-right pro-item-ft">



                                                    <?php if ($this->config->item('enable_distributor_feature') == "1" && count($product_distributor) > 0) {?>

                                                        <?php } else {?>
                                                    <div class="prod-type-btn-group">

                                                           <?php $url_link = (base_url() . $lang_id . '/' . 'products/product_list/' . $single_product->kgt_ref_number . '/' .  str_replace("%2F", "-",urlencode($single_product->product_type_name)) . '-' . str_replace("%2F", "-", urlencode(trim($single_product->part_name))));?>
                                                           <a href="<?php echo $url_link; ?>" class="more-info-link"> <?php echo $general_instruction->more_detail; ?> </a>

                                                    </div>
                                                    <?php }?>

												</div> -->
												</div>
												<div class="refern-row d-flex">
                                                    <div class="left"> </div>
                                                    <div class="right">
                                                        <?php if ($this->config->item('enable_distributor_feature') == "1" && count($product_distributor) > 0) {?>

                                                            <?php } else {?>
                                                        <div class="prod-type-btn-group">

                                                            <?php $url_link = (base_url() . $lang_id . '/' . 'products/product_list/' . $single_product->kgt_ref_number . '/' .  str_replace("%2F", "-",urlencode($single_product->product_type_name)) . '-' . str_replace("%2F", "-", urlencode(trim($single_product->part_name))));?>
                                                            <a href="<?php echo $url_link; ?>" class="more-info-link" target="_blank"> <?php echo $general_instruction->more_detail; ?> </a>

                                                        </div>
                                                        <?php }?>
                                                    </div>
                                                </div>
												<div class="refern-row d-flex">
													<div class="left"> <?php if(!$single_product->hide_partid){  echo $single_product->kgt_ref_number; }?> </div>
													<div class="right">
                                                 <?php if (check_product_access($single_product->id)) {?>

														<a href="#" data-item="<?php echo $product_number; ?>" class="add-cart-link addproductcart  <?php if (array_key_exists($single_product->id, $cart)) {echo "add-cart-grey";
    } else if ($single_product->quantity < 1) {echo "add-cart-grey";}?>"> <?php if (array_key_exists($single_product->id, $cart)) {
        echo $general_instruction->already_added_product;
    } else if ($single_product->quantity < 1) {echo strtoupper($product_instruction->out_of_stock);} else {
        echo $general_instruction->addtocart;
    }?> </a>
                                                            <?php } else {?>


                                                                <a href="#" data-item="<?php echo $single_product->id; ?>" class="add-cart-link addpricerequest <?php if (in_array($single_product->id, $price_request_product)) {echo "add-cart-grey";
    }?>"> <?php if (in_array($single_product->id, $price_request_product)) {
        echo $general_instruction->requestprice_added;
    } else {
        echo $general_instruction->requestprice;
    }?> </a>

                                                                <?php }?>
													</div>
												</div>

												  <?php
if ($this->config->item('enable_distributor_feature') == "1" && count($product_distributor) > 0) {?>
											<div class="d-flex distributor">
                                                <span class="prod-hero-title"> <?php echo $general_instruction->distributor_list; ?> </span>
                                            <?php foreach ($product_distributor as $single_distributor) {?>
                                                <div class="prod-hero">
                                                <span class="hero_ele_desc"> <div class="hero_ele_name"><a href="<?php echo $single_distributor['url']; ?>/cart/move_to_cart/<?php echo urlencode(base64_encode($single_product->kgt_ref_number)); ?>" target="_blank" data-item="<?php echo $product_number; ?>" class=""> <div class="d-none"><?php echo $single_distributor['name']; ?></div> <img class="img-responsive" src="<?php echo asset_url(); ?>assets/uploads/distributor/<?php echo $single_distributor['logo']; ?>"  alt="<?php echo $single_distributor['logo']; ?>" /> </a></div>
                                                <a href="<?php echo $single_distributor['url']; ?>/cart/move_to_cart/<?php echo urlencode(base64_encode($single_product->kgt_ref_number)); ?>" data-item="<?php echo $product_number; ?>"  target="_blank"class="link"> <?php echo $general_instruction->buynow; ?> </a>
                                                </span>
                                                </div>
												</div>
                                            <?php }}?>


                                            </div>
                                        </div>
                                    </div>
<?php }?>

