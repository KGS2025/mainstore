
<?php $ASSET_VERSION = getenv('ASSET_VERSION');
?>
<?php
    if (isset($country_data) && !empty($country_data)) {
        foreach ($country_data as $cdata) {
            if (($cdata['short_code'] == $lang_id)) {
                if(isset($cdata['coming_soon_image']) && $cdata['coming_soon_image'] != '') {
                    $comingsoon = global_img_link($cdata['coming_soon_image'], 'uploads/country/coming_soon/');
                } else {
                    $comingsoon = base_url() . 'images/coming_soon.jpg';
                }
                if(isset($cdata['no_image']) && $cdata['no_image'] != '') {
                    $noimage = global_img_link($cdata['no_image'], 'uploads/country/no_image/');
                } else {
                    $noimage = "<?php echo asset_url();?>assets/admin/previewimage.jpg";
                }
            }
        }
    }
?>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/home.css?version=' . $ASSET_VERSION); ?>">
<script type="text/javascript">
    function redirect_edit_mode() {
        $('#user_block_box').modal('hide');
        if ($("#edit_cart_mode_on").html() == "edit_cart_mode_on") {
            window.location.href = '<?php echo base_url(); ?>cart/edittocart';
        } else {

            window.location.href = '<?php echo base_url(); ?>cart/index';
        }

    }
</script>
<?php $this->load->view('elements/body_logo'); ?>


    <div class="ct-videoSection float-start w-100 container-fluid">
        <div class="ct-services float-start w-100">
            <div class="ct-team-box p-0 float-start w-100">
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



    <div class="mobile-bnr float-start w-100">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
            <?php 
            $slidecountInt = 0;
            foreach ($all_banner_images as $banner_img ) { ?>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $slidecountInt; ?>" class="active" aria-current="true" aria-label="Slide <?php echo $slidecountInt; ?>"></button>
              <?php $slidecountInt++; } ?>
            </div>
            <div class="carousel-inner" data-u="slides">
                <?php
                    $active_string = "active";
                    $countInt = 0;
                    foreach ($all_banner_images as $banner_img ) { ?>
                        <div class="carousel-item <?= $countInt>=0 ? $active_string : '';?>" data-b="<?php echo $countInt ?>">
                            <img class="w-100" data-u="image" src="<?php echo asset_url();?>assets/uploads/banner_images/<?php echo $banner_img->banner_image ?>" />
                            <div class="btn red_btn rounded" style="position:absolute;bottom: 70px;left: 50%;z-index:0;transform: translateX(-50%);"><a class="d-inline-block rounded" style="font-size:15px;line-height:30px;font-weight:600;text-align:center;color:#fff" href="<?php echo $banner_img->button_url ?>" target="_blank" rel="noopener noreferrer"><?php echo $banner_img->button_text ?></a></div>
                        </div>
                        <?php
                            $countInt++;
                            if( strlen(trim( $active_string )) > 0 ){
                                $active_string = '';
                            }
                } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="container-fluid p-lg-5 float-start w-100">
        <h1 class="text-center text-uppercase ct-u-marginTop30 ct-u-marginBottom30 mob_margintop30 home_head ct-fw-700" ><?php echo $all_data['product_section_head'] ?></h1>
        <div class="bg-white float-start w-100">
            <div class="col-12 float-start w-100">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 p-4">              
                        <img src="<?php echo asset_url();?>assets/uploads/home_product/full/<?php echo $all_data['product_section_image'] ?>" alt="Demon Heavy Duty Ball Joints" title="Demon Heavy Duty Ball Joints" />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 p-4">   
                        <h3 class="text-uppercase py-3 home_head"><?php echo $all_data['product_section_title'] ?></h3>
                        <div class="ct-videoSection">
                            <?php echo $all_data['product_section_description'] ?>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a href="<?php echo $all_data['product_section_button_url'] ?>" class="read_more d-inline-block" target="_blank" rel="noopener noreferrer"><?php echo $all_data['production_section_button_text'] ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="w-100 p-3 p-md-5 float-start whatsNewSection">
        <h1 class="text-center text-uppercase ct-u-marginTop30 ct-u-marginBottom30 mob_margintop30 mb-5 home_head ct-fw-700" ><?php echo $all_data['whats_new'] ?></h1>
        <div class="col-12 float-start w-100">
            <div class="row">
                <?php
                    foreach ($whats_new as $whats_new ) { ?>
                        <div class="compressed_div col-lg-6 col-md-6 col-sm-12 col-xs-12 p-0 p-md-4">
                            <a style="background-image:url('<?php echo asset_url();?>assets/uploads/whats_new/<?php echo $whats_new->image ?>');" href="<?php echo $whats_new->url ?>" target="_blank" rel="noopener noreferrer" class="productGallary w-100 d-inline-block position-relative">
                                <!-- <img src="" class="compressed_image w-100"> -->
                                <span class="imgLabelColor position-absolute w-100 text-center" style="left: 0;bottom: 0; padding: 10px; display: inline-block;"><?php echo $whats_new->heading ?> ...</span>
                            </a>
                            <!-- <a target="_blank" rel="noopener noreferrer" href="<?php //echo $whats_new->url ?>" class="whats_new_caption"><?php //echo $whats_new->heading ?> ...</a> -->
                        </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php if(isset($all_data['instagram_feed_status']) && $all_data['instagram_feed_status'] == 1) {?>
    <div class="ct-u-marginTop30 ct-u-marginBottom40 float-start w-100">
        <h3 class="text-center text-uppercase home_head ct-fw-700"><?php echo $general_instruction->intagram_feed_text; ?></h3>
        <div class="clearfix"></div>
        <p class="text-center"> 
            <a class="btn red_btn btn-primary" href="<?php echo $general_instruction->intagram_page_url; ?>" target="_blank" style=" border:0px !important;"><?php echo $general_instruction->intagram_followus_text; ?></a> 
        </p>
        <div id="instagram-feed-demo" class="instagram-gallery ct-u-marginTop30"> </div>
    </div>
    <?php } ?>

<!--Modal Custom warning-->
<div class="modal fade" id="customwarning" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <h4 id="customwarning_msg_title" class="title-modal">
                        <span class="blink"> <?php echo $selection_instruction->selection_popup_header; ?> </span>
                    </h4>
                    <p id="customwarning_msg"><?php echo $selection_instruction->selection_popup_body; ?></p>
                    <div class="btn-modal">
                        <?php if ($lang_id == 'ar') { ?>
                            <a href="javascript:void(0)" onClick="$('#customwarning').modal('hide');"
                               class="px-3 py-2 btn btn-primary"><i
                                    class="fa fa-angle-left"></i> <?php echo $general_instruction->ok; ?> </a>
                            <?php } else { ?>
                            <a href="javascript:void(0)" onClick="$('#customwarning').modal('hide');"
                               class="px-3 py-2 btn btn-primary"><?php echo $general_instruction->ok; ?> <i
                                    class="fa fa-angle-right"></i></a>
                            <?php } ?>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--Modal Custom warning ends-->


<!--Modal shopping decision cart-->
<div class="modal fade" id="user_block_box">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="box-content-modal">
                    <div class="blockElementWrap">
                        <div class="blockMsglogo">
                            <?php
                            if (isset($all_data['logo']) && $all_data['logo'] != '') { $logo = global_img_link($all_data['logo'], 'uploads/logo/thumbnails/'); ?>
                                <img src="<?php echo $logo; ?>" alt="logo"/>
                            <?php } else { ?>
                                <img src="<?php echo asset_url('assets/template/images/logo.png'); ?>" alt="logo"/>
                            <?php } ?>
                        </div>
                        <div class="blockMsg" id="blockMsg"><?php echo lang('You Have Been Blocked.') ?>
                            <br> <?php echo lang('Please Try After 120 minutes.') ?></div>
                        <div id="edit_cart_mode_on" class="displaynon"></div>

                    </div>
                    <h2 class="title-modal"
                        id="blockMsg1"><?php echo lang('You Have Been Blocked. Please Try After 120 minutes.') ?></h2>

                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 text-center">
                                <?php if ($lang_id == 'ar') { ?>
                                    <a href="javascript:void(0)" onClick="redirect_edit_mode();"
                                       class="btn btn-primary px-3 rounded" id="block_confirm_msg1"><i
                                            class="fa fa-angle-left"></i><?php echo $general_instruction->ok; ?> </a>
                                    <?php } else { ?>
                                    <a href="javascript:void(0)" onClick="redirect_edit_mode();"
                                       class="btn btn-primary px-3 rounded" id="block_confirm_msg1"><?php echo $general_instruction->ok; ?> <i
                                            class="fa fa-angle-right"></i></a>
                                    <?php } ?>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">
<input type="hidden" id="cud_cart_state" value="<?php echo isset($cart_users_data['cart_state']) ? $cart_users_data['cart_state'] : ""; ?>">
<input type="hidden" id="cud_ship_state" value="<?php echo isset($cart_users_data['ship_state']) ? $cart_users_data['ship_state']: ""; ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">


