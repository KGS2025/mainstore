<?php $comingsoon = getNoImage('coming-soon');
?>

<?php $this->load->view('elements/body_logo'); ?>

<div class="mainContent px-3 px-lg-5 pt-3">
<div class="ct-videoSection">
    <div class="ct-services float-start w-100">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
            <div class="ct-team-box p-0">
                <div class="common-search float-start w-100 my-3">
                    <div class="text-header">
                        <?php $this->load->view('elements/search'); ?>
                    </div>
                </div>

                <div class="home-quick-search-wrap float-start w-100">
                    <?php $this->load->view('elements/quicksearch'); ?>
                </div>
            </div>
        </div>
    </div>
</div>   

<div class="container-fluid float-start w-100 my-4 text-center">
    <div class="main-page static_pages">
	<div class="row">
		<div class="col-12 glry-title"><?php echo $general_instruction->gallery_maintitle; ?></div>
		<div class="col-12 glry-sub-title"><?php echo $general_instruction->gallery_subntitle; ?></div>
	</div>
    <div class="row">
    <?php 
       
       foreach ($all_items as $single_product) { 
           ?>
<div class="col-6 col-lg-3 glry-col mb-3">
<div class="glry-card">
           <?php
        if ($single_product->images != '') {

            $pro_real_images = explode(",", $single_product->images);
            ?>



 <div id="real-image-slider-<?php  echo trim($single_product->id); ?>" class="carousel slide" data-ride="carousel">
                                                            <div class="carousel-inner" style="width:100%;margin:0 auto;">
                                                                <?php $real_image_array = array();
                                                                foreach ($pro_real_images as $single_real_image) {



                                                                    if (isset($single_real_image) && $single_real_image != '' && file_exists("assets/uploads/gallery/" . $single_real_image)) { ?>
                                                                        <div class="carousel-item <?php if (count($real_image_array) == 0) {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                                                                            <a class="d-inline-block example-image-link carousel_img" data-lightbox="examplereal-<?php echo $single_product->id; ?>" href="<?php echo asset_url(); ?>/assets/uploads/gallery/<?php echo $single_real_image; ?>"><img class="img-responsive" src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo asset_url(); ?>/assets/uploads/gallery/<?php echo $single_real_image; ?>" width="200" alt="<?php echo $single_real_image; ?>" /></a>
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

            <?php 

        } else { ?>

<a href="<?php  echo $single_product->url; ?>"><img alt="<?php  echo $single_product->name; ?>" class="img-fluid img-thumbnail" src="<?php echo $comingsoon; ?>" /> </a>

        <?php }

        ?>
           
     

<div class="caption">
<?php  if(!empty($single_product->url)) { ?>
<p><a href="<?php  echo $single_product->url; ?>"><?php echo $single_product->name; ?></a></p>
<?php } else { ?>

    <p><?php echo $single_product->name; ?></p>


<?php } ?>
</div>
</div>
</div>



       <?php } ?>
       </div>
    </div>
</div>

</div>






<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">
<input type="hidden" id="cud_cart_state" value="<?php echo isset($cart_users_data['cart_state']) ? $cart_users_data['cart_state'] : ""; ?>">
<input type="hidden" id="cud_ship_state" value="<?php echo isset($cart_users_data['ship_state']) ? $cart_users_data['ship_state']: ""; ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">


