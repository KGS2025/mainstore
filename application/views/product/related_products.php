<?php
$comingsoon = getNoImage('coming-soon');
$currencyV = getDefaultCurrencyCode('l') . '_currency';
$priceV    = 'price';
$currency  = $general_instruction->$currencyV;
$loggedUserId = getFrontenduserId();
$front_validuser_data = $this->session->userdata('front_validuser_data');
$remaining_time = isset($front_validuser_data['remaining_time']) ? $front_validuser_data['remaining_time'] : 0;
$cart = $this->session->userdata('cart');
$product_list = $all_data['related_products'];
?>
    <?php if(count($product_list)>0){?>
        <div class="Productsearch_result related_products_title">
            <?php echo $product_instruction->related_products;?>
        </div>
        <div class="product-list-list filter-list related-products-list" style="">
        <div id="menu_product_list_block" class="float-start w-100">
        <div class="AllProducts">
 
                                <?php foreach ($product_list as $single_product) { 
                                    
                                    $product_type_name = $single_product->lang_product_type_name ? $single_product->lang_product_type_name : $single_product->product_type_name;
 
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



                                                                    if (isset($single_real_image) && $single_real_image != '' && file_exists("assets/uploads/product_images/" . $single_real_image)) { ?>
                                                                        <div class="carousel-item <?php if (count($real_image_array) == 0) {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                                                                            <a class="d-inline-block example-image-link carousel_img" data-lightbox="examplereal-<?php echo $single_product->id; ?>" href="<?php echo asset_url(); ?>/assets/uploads/product_images/<?php echo $single_real_image; ?>"><img class="img-responsive" src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo asset_url(); ?>/assets/uploads/product_images/<?php echo $single_real_image; ?>" width="200" alt="<?php echo $single_real_image; ?>" /></a>
                                                                        </div>
                                                                    <?php } else { ?>
                                                                        <div class="carousel-item <?php if (count($real_image_array) == 0) {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                                                                            <a class="d-inline-block example-image-link carousel_img" data-lightbox="examplereal-<?php echo $single_product->id; ?>" href="<?php echo $comingsoon; ?>"><img class="img-responsive" alt="product_images" src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo $comingsoon; ?>" width="200"> </a>
                                                                        </div>
                                                                <?php }

                                                                    $real_image_array[] = $single_real_image;
                                                                }
                                                                ?>
                                                            </div>
                                                            <!-- Left and right controls -->


                                                            <button class="carousel-control-prev" <?php if (count($pro_real_images) == 1) { ?> style=" Display:none !important" ; <?php } ?> type="button" data-bs-target="#real-image-slider-<?php echo trim($single_product->id); ?>" data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" <?php if (count($pro_real_images) == 1) { ?> style=" Display:none !important" ; <?php } ?> type="button" data-bs-target="#real-image-slider-<?php echo trim($single_product->id); ?>" data-bs-slide="next">
                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </button>
                                                        </div>

                                                    <?php } else { ?>

                                                        <a class="d-inline-block example-image-link empty-img" data-lightbox="example-<?php echo $single_product->id; ?>" href="<?php echo $comingsoon; ?>"><img class="img-responsive" alt="product_images" src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo $comingsoon; ?>" width="120" height="80"> </a>

                                                    <?php } ?>

                                                </div>

                                                <?php

                                                $currencyV = getDefaultCurrencyCode('l') . '_currency';
                                                $priceV    = 'price';
                                                $currency  = $general_instruction->$currencyV;
                                                $price     = $single_product->$priceV;

                                                $product_number =  urlencode(base64_encode($single_product->kgt_ref_number));?>
                                <div class="related-prod-info-details">
                                    
                                    <div class="related-prod-info-price-title">
                                        <div class="avia-arrow"></div>
                                        <a href="javascript:void(0);" class="prod-name">
                                        <!-- <?php echo $single_product->kgt_ref_number; ?> -->
                                        <!-- <span class="element_desc"> <?php echo  $product_type_name; ?> </span> -->
                                        <span class="element_desc"> <?php echo $single_product->part_name; ?> </span></a>                                        
                                    </div>
                                    <div class="pro-item-ft">
                                        <div class="ele-left">
                                            <?php if($single_product->show_price=="1") { ?>
                                            <span class="start_from"> <?php //echo $product_instruction->price; 
                                            ?> <?php echo $currency . " " . $price; ?> </span>
                                            <?php } ?>                                
                                        </div>
                                            <div class="prod-type-btn-group">
                                                <?php $url_link = (base_url() . $this->lang->default_lang . '/' . 'products/product_list/' . $single_product->kgt_ref_number.'/'.str_replace("%2F","-",urlencode($single_product->product_type_name)).'-'.str_replace("%2F","-",urlencode($single_product->part_name)));?>
                                                <!-- <a target="_blank" href="<?php echo $single_product->url; ?>/cart/move_to_cart/<?php echo urlencode(base64_encode($single_product->kgt_ref_number)); ?>" data-item="<?php echo $product_number; ?>" class="add-cart-link addproductcart"> <?php 
                                                echo $general_instruction->addtocart;
                                                ?> </a> -->
                                                <a href="<?php echo $url_link; ?>" class="btn actn-btn btn-omega" target="_blank"> <?php echo $general_instruction->more_detail; ?> </a>	
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php } ?>
            </div>
        </div>
    </div>
    <?php }?>
                        

