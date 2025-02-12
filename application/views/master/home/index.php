<script type="text/javascript" src="<?php echo asset_url('assets/template/js/jssor.slider-22.1.8.mini.js'); ?>" defer></script>
<script type="text/javascript" src="<?php echo asset_url('assets/template/js/home-slider.js'); ?>" defer></script>
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
                    $noimage = base_url() . 'assets/admin/previewimage.jpg';
                }              
            }
        }
    }
    ?>
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
<style type="text/css">

.box-content-modal {
    background-color: #000000 !important;
}
.box-content-modal  .title-modal{
    color: #ffffff !important;
}
.box-content-modal .btn-modal .btn {
    background-color:  rgb(199, 8, 27) !important;
}
.box-content-modal .blink {
    color: #ffffff !important;
}
.nav-prex-next .text-right .btn .btn-primary .btn-sm {
    background-color: rgb(199, 8, 27) !important;
}
.col-md-12 .btn, .contact-us-page .col-md-12 .btn {
    background-color: rgb(199, 8, 27) !important;
}
.car-lists .btn {
    background-color: rgb(199, 8, 27) !important;
}
.boarder_2_red {
    border: 2px solid rgb(199, 8, 27) !important;
}
.read_more {
    color: #000000 !important;
}
.compressed_div {
    width: 100%;
    margin: 0 auto;
    overflow: hidden;
    position: relative;
    height: 180px !important;
    margin-bottom:35px;
}
img.compressed_image {
    position: absolute;
    top:-100%;
    left:0;
    right: 0;
    bottom:-100%;
    margin: auto;
}
.instagram_gallery {
    background-color:#FFF !important;
    padding:10px !important;
    border-radius:5px;
}
.instagram_gallery img {
    width:19.1% !important;
    display:inline-table;
}

</style>
<div class="container pad_left_right" style="margin-top: 20px; margin-bottom: 20px;">
    <div class="mobile-bnr">
        <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
            <!-- Loading Screen -->
            <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                
            </div>
            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
                <?php 
                    $active_string = "active";
                    $countInt = 0;
                    foreach ($all_banner_images as $banner_img ) { ?>
                        <div data-b="<?php echo $countInt ?>"> 
                            <img data-u="image" data-src2="<?php echo base_url() ?>assets/uploads/banner_images/<?php echo $banner_img->banner_image ?>" />
                            <div style="position:absolute;top:300px;left:425px;width:138px;height:48px;z-index:0; font-size:15px; line-height:45px; color:#fff !important;  background:#c7081b; text-align:center;"><a href="<?php echo $banner_img->button_url ?>"  style="color:#fff" target="_blank"><?php echo $banner_img->button_text ?></a></div>
                        </div>
                        <?php 
                            $countInt++;
                            if( strlen(trim( $active_string )) > 0 ){
                                $active_string = '';
                            }
                } ?>
            </div>
            <span data-u="arrowleft" class="jssora03l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span> 
            <span data-u="arrowright" class="jssora03r" style="top:0px;right:8px;width:55px;height:55px;" data-autocenter="2"></span>  
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h3 class="text-center text-uppercase ct-u-marginTop30 ct-u-marginBottom30 mob_margintop30" style="color:#FFF">Product</h3>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background:#FFF;">
                <h3 class="ct-fw-700 text-uppercase text-center" style="color:#000; padding-top:15px;">Demon Heavy Duty Ball Joints</h3>
                <img src="http://demonpowersports.com/uploads/product-images/20200814-151228-78361.jpg" alt="Demon Heavy Duty Ball Joints" title="Demon Heavy Duty Ball Joints" />
                <div class="clearfix"></div>
                <div class="ct-videoSection Product_Description" style="overflow: scroll !important; height:150px; min-height:150px; margin-bottom:20px;">
                    <ul style="list-style-type: square;">
                        <li>Made Up of 4340 Chromoly Steel Material</li>
                        <li>Greaseable and Serviceable</li>
                        <li>Reversed Flange Design for Upper Ball Joints</li>
                        <li>2 Times Stronger than OEM</li>
                        <li>Wear Adjustable</li>
                        <li>Reinforced Stub Design</li>
                        <li>Extended Life-Span</li>
                        <li>Backed by a 12&nbsp;- Month Limited Warranty*</li>
                        <li>Terms of Warranty:
                            <ul>
                                <li>Demon Powersports warrants it&rsquo;s Demon Heavy Duty Ball Joint to the original purchaser for 1 year from the date of purchase against manufacturing defects in workmanship and material only.</li>
                                <li>Demon Powersports warranty does not apply to failure resulting from misuse, negligence, accident, improper application, improper installation or alteration.</li>
                            </ul>
                        </li>
                    </ul>              
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center" style="height:40px;">
                    <a href="http://demonpowersports.com/product-details.php?pid=9" class="read_more" target="_blank">Read More</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h3 class="text-center text-uppercase ct-u-marginTop30 ct-u-marginBottom30 mob_margintop30" style="color:#FFF">What's New</h3>
            <div>
                <div class="compressed_div"> 
                    <a href="http://demonpowersports.com/blog-detail.php?id=1165" target="_blank">
                        <img src="http://demonpowersports.com/uploads/common-images/16-03-2020_06-38-20_Kyle_Chaney_King_of_Hammers_KOH_Hammer_Town_Rock_Racing_Best_ATV_UTV_SXS_Axles_Can_Am_Axles_Polaris_Axles_4340_Chromoly_Steel_Axles_Best_ATV_UTV_SXS_Axles_Strongest_Axles_Strong_Axles_Demon_Axles_ATV_Axles_UTV.jpg" class="compressed_image" align="center">
                    </a>
                    <a target="_blank" href="http://demonpowersports.com/blog-detail.php?id=1165" class="whats_new_caption">Kyle Chaney Dominates 2020 King of Hammers - Ultra                ...                </a>
                </div>
            </div>
            <div>
                <div class="compressed_div"> 
                    <a href="http://demonpowersports.com/blog-detail.php?id=1137" target="_blank">
                        <img src="http://demonpowersports.com/uploads/common-images/18-11-2019_12-26-21_Black_Friday_Sale_Demon_Axles_ATV_Axles_UTV_Axles_RZR_Axles_Polaris_Axles_Can_Am_Axles_RZR_1000_Axles_SXS_Axles_Aftermarket_ATV_UTV_SXS_Products_Quality_Products_Stock_Length_Axles_Lift_Kit_Axles_Long_Travel_Axles_Rugged.jpg" class="compressed_image" align="center">
                    </a>
                    <a target="_blank" href="http://demonpowersports.com/blog-detail.php?id=1137" class="whats_new_caption">Black Friday Sale : Up To 15% OFF Store-Wide!</a>
                </div>
            </div>
        </div>
    </div>
</div>  

<!--Modal Custom warning-->
<div class="modal fade" id="customwarning">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 id="customwarning_msg_title" class="title-modal">
                        <span class="blink"> <?php echo $selection_instruction[0]->selection_popup_header; ?> </span>
                    </h2> 
                    <p id="customwarning_msg"><?php echo $selection_instruction[0]->selection_popup_body; ?></p>   
                    <div class="clearfix"></div>
                    <div class="btn-modal">   
                        <?php if ($lang_id == 'ar') { ?>
                            <a href="javascript:void(0)" onClick="$('#customwarning').modal('hide');"
                               class="floatright1 btn btn-primary btn-sm"><i
                                    class="glyphicon glyphicon-chevron-left"></i> <?php echo $general_instruction[0]->ok; ?> </a>
                            <?php } else { ?>
                            <a href="javascript:void(0)" onClick="$('#customwarning').modal('hide');"
                               class="floatright1 btn btn-primary btn-sm"><?php echo $general_instruction[0]->ok; ?> <i
                                    class="glyphicon glyphicon-chevron-right"></i></a>
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
                                <img src="<?php echo base_url('assets/template/images/logo.png'); ?>" alt="logo"/>
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
                            <div class="col-md-12 col-xs-12 text-right">
                                <?php if ($lang_id == 'ar') { ?>
                                    <a href="javascript:void(0)" onClick="redirect_edit_mode();"
                                       class="btn btn-primary btn-sm" id="block_confirm_msg1"><i
                                            class="glyphicon glyphicon-chevron-left"></i><?php echo $general_instruction[0]->ok; ?> </a>
                                    <?php } else { ?>
                                    <a href="javascript:void(0)" onClick="redirect_edit_mode();"
                                       class="btn btn-primary btn-sm" id="block_confirm_msg1"><?php echo $general_instruction[0]->ok; ?> <i
                                            class="glyphicon glyphicon-chevron-right"></i></a>
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

<script type="text/javascript">
    $(document).ready(function () {
        var tot_vehicle_types = <?php echo $num_vehicle_type_for_menu; ?>;
        var loaded_messages = 0;
        $("#more_button_vehicle_types").click(function () {
            if (loaded_messages < tot_vehicle_types - <?php echo $this->config->item('pagination_limit'); ?>) {

                var vehicleBtnText = $("#more_button_vehicle_types").text();
                $("#more_button_vehicle_types").text(plsWaitText);
                loaded_messages += <?php echo $this->config->item('pagination_limit'); ?>;
                $.get("products/get_vehicle_categories/" + loaded_messages, function (data) {
                    $("#vehicle_type_block").append(data);
                    $("#more_button_vehicle_types").text(vehicleBtnText);
                    $("#checkbox_vehicle").prop('checked', false);
                    $("#vehicle_categories_num").text($('.vehicle_category_id').length);
                    if (loaded_messages >= tot_vehicle_types - <?php echo $this->config->item('pagination_limit'); ?>) {
                        $("#more_button_vehicle_types").html('<?php echo $general_instruction[0]->no_more_vehicle_type_to_load; ?>');
                        $("#more_button_vehicle_types").attr('id', '');
                    }
                });
            }


        });

        if ($(".hours .flip-clock-label").html() != '') {
            $(".hours .flip-clock-label").html('<?php echo $general_instruction[0]->hours; ?>');
        }

        if ($(".minutes .flip-clock-label").html() != '') {
            $(".minutes .flip-clock-label").html('<?php echo $general_instruction[0]->minutes; ?>');
        }

        if ($(".seconds .flip-clock-label").html() != '') {
            $(".seconds .flip-clock-label").html('<?php echo $general_instruction[0]->seconds; ?>');
        }
    });
</script>