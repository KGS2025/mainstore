
        <span class="displaynon" id="select_an_option"><?php echo $general_instruction->select_an_option; ?></span>
        <span class="displaynon" id="select_errorLoading"><?php echo $general_instruction->select_errorLoading; ?></span>
        <span class="displaynon" id="select_noResults"><?php echo $general_instruction->select_noResults; ?></span>
        <span class="displaynon" id="select_searching"><?php echo $general_instruction->select_searching; ?></span>


        <?php $ASSET_VERSION = getenv('ASSET_VERSION');
        $footer_image = '';
        if (isset($all_data['main_footer_background']) && $all_data['main_footer_background'] != '') {
            $footer_image = asset_url() . 'assets/uploads/background/full/' . $all_data['main_footer_background'] . '?version=' . getenv('ASSET_VERSION');
        } ?>
        <?php if ($footer_image) { ?>
            <div class="footerDiv pb-5" style="background:url(<?php echo $footer_image; ?>) no-repeat left bottom;padding: 30px;background-size: cover; float:left; width:100%;">
            <?php } else { ?>
                <div class="footerDiv pb-5" style="padding: 30px; float:left; width:100%;">
                <?php } ?>
                <div class="container-fluid">
                    <footer class="pb-5">
                        <div class="ct-prefooter ct-u-paddingBoth70">
                            <div class="row ct-u-paddingBoth5">
                                <?php if ($all_data['contact_us_status'] == 1) { ?>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                        <div class="widget ct-widget-contact">
                                            <!-- <h3 class="ct-widget-header text-uppercase ct-fw-400"><?php echo $all_data['contact_us'] ?></h3> -->
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left:0px !important; padding-right:0px !important;">
                                                <table aria-label="contact-information">
                                                        <?php              
                                                          if ($all_data['header_image']) { 
                                                            if (isset($all_data['header_image']) && $all_data['header_image'] != '' && file_exists('assets/uploads/logo/thumbnails/' . $all_data['header_image'])) {
                                                                $header_image = 'assets/uploads/logo/thumbnails/' . $all_data['header_image'];
                                                            } 
                                                        ?>                                                    
                                                        <tr>
                                                            <td></td>
                                                            <td class="ct-u-colorLightBlack colour-code"><img src="<?php echo $header_image; ?>"/></td>
                                                        </tr>
                                                    <?php } ?>
                                                    <?php if(count($all_social_media_data)>0){?> 
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td class="ct-u-colorLightBlack colour-code" style="vertical-align:top"><?php echo $general_instruction->follow_us_on;?></td>
                                                        </tr>       
                                                        <tr>     
                                                            <td></td>
                                                            <td>
                                                            <?php                                                       
                                                            foreach ($all_social_media_data as $social_media) {  ?>                                                                
                                                                <a href="<?php echo $social_media->social_media_url; ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo $social_media->social_media_image; ?>">
                                                                    <img src="" data-img="<?php echo asset_url(); ?>assets/uploads/social_media/thumb/<?php echo $social_media->social_media_image; ?>" alt="Social media image" style="max-height:30px !important;" />
                                                                </a>                                                                
                                                            <?php  } ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>                                 
                                                    
                                                </table>
                                                <br />

                                               
                                                <ul class="ct-socialIcons list-inline list-unstyled"></ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($all_data['quick_links_status'] == 1) { ?>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                        <div class="widget ct-widget-services">
                                            <h3 class="ct-widget-header text-uppercase ct-fw-400"><?php echo $all_data['quick_links'] ?></h3>
                                            <ul class="quick_links">
                                                <?php foreach ($all_navigation_data as $nav_bar) {
                                                    $currentURL = current_url();
                                                ?>
                                                    <li><a class="<?php if ($currentURL == trim($nav_bar->page_url)) {
                                                                        echo "active";
                                                                    } ?>" href="<?php echo $nav_bar->page_url ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp; <?php echo $nav_bar->title ?></a></li>
                                                <?php } ?>
                                                <li><a class="<?php if (isset($pageType) && ($pageType == 'products' || $pageType == 'productmaker' ||  $pageType == 'productmodel'  ||  $pageType == 'productitems' ||  $pageType == 'productlist')) {
                                                                    echo "active";
                                                                } ?>" href="<?php echo base_url() . $lang_id . '/' . 'products'; ?>" rel="noopener noreferrer" aria-label="<?php echo $general_instruction->product_menu_text; ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp; <?php echo $general_instruction->product_menu_text; ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <br/>
                                        <div class="widget-address">
                                            <table>
                                                    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                                            <?php if ($all_data['footer_address']) { ?>
                                                    <tr>
                                                        <td class="ct-u-colorLightBlack colour-code" style="vertical-align:top"><i class="fa fa-map-marker" aria-hidden="true"></i></td>
                                                        <td class="ct-u-colorLightBlack colour-code"><?php echo $all_data['footer_address']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                                <?php if ($all_data['footer_phone1']) { ?>
                                                    <tr>
                                                        <td class="ct-u-colorLightBlack colour-code"><i class="fa fa-phone" aria-hidden="true"></i></td>
                                                        <td class="ct-u-colorLightBlack colour-code"><a href="tel:<?php echo $all_data['footer_phone1']; ?>" class="ct-u-colorLightBlack colour-code"><?php echo $all_data['footer_phone1']; ?></a></td>
                                                    </tr>
                                                <?php } ?>
                                                <?php if ($all_data['footer_phone2']) { ?>
                                                    <tr>
                                                        <td class="ct-u-colorLightBlack colour-code"><i class="fa fa-phone" aria-hidden="true"></i></td>
                                                        <td class="ct-u-colorLightBlack colour-code"><a href="tel:<?php echo $all_data['footer_phone2']; ?>" class="ct-u-colorLightBlack colour-code"><?php echo $all_data['footer_phone2']; ?></a></td>
                                                    </tr>
                                                <?php } ?>
                                                <?php if ($all_data['footer_email_status'] == 1) { ?>
                                                        <tr>
                                                            <td class="ct-u-colorLightBlack colour-code"><i class="fa fa-envelope-o footer_icon pe-1" aria-hidden="true"></i></td>
                                                            <td class="ct-u-colorLightBlack colour-code"><a href="mailto:<?php echo $all_data['footer_email']; ?>" class="ct-u-colorLightBlack colour-code"><?php echo $all_data['footer_email']; ?></a></td>
                                                        </tr>
                                                <?php }?>
                                            </table>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($all_data['route_map_status'] == 1) { ?>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                        <div class="widget ct-widget-services">
                                            <h3 class="ct-widget-header text-uppercase ct-fw-400"><?php echo $all_data['route_map'] ?></h3>
                                            <iframe src="<?php echo $all_data['footer_map_iframe'] ?>" width="200" height="220" style="border:0" allowfullscreen title="Google Map"></iframe>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($all_data['social_media_status'] == 1 && false) { ?>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                        <div class="widget ct-widget-services">
                                            <h3 class="ct-widget-header text-uppercase ct-fw-400"><?php echo $all_data['social_media'] ?></h3>


                                            <iframe src="<?php echo $all_data['footer_facebook_iframe'] ?>" width="200" height="220" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>

                                        </div>
                                    </div>
                                <?php } ?>
                                
                                <?php if (true) { ?>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                        <div class="widget ct-widget-services">
                                            <h3 class="ct-widget-header text-uppercase ct-fw-400"><?php echo $general_instruction->footer_payment_methods; ?></h3>

                                            <div><?php echo $all_data['footer_payment_methods']; ?></div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            
                        </div>
                        
                </div>
                <div class="ct-postfooter ct-u-paddingBottom10">
                    <div class="row">
                        <div class="col-lg-9 col-md-6 ct-copyright">
                            <p><?php echo $all_data['footer_name']; ?></p>
                        </div>
                        <?php if ($all_data['poweredby_section_status'] == 1) { ?>
                            <div class="col-lg-3 col-md-6 ct-copyright">
                                <p><?php echo $all_data['copyright']; ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <i class="scroll-btn fa fa-arrow-circle-up fa-4" onclick="scrollToTop()"></i>
                <script type="text/javascript">
                    function scrollToTop() {
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                </script>
                </footer>
                </div>
            </div>
            </div>



            <?php
            if ($this->config->item('show_coookie_concent') == "1") {
                $cookie_session  = $this->session->userdata('gdpr_decision');
                $cookie_options  = $this->session->userdata('gdpr_options');
            ?>

                <!-- cookies -->
                <div class="cookies" <?php if ($cookie_session != "1") { ?> style="display: block;" <?php } else { ?> style="display: none;" <?php } ?>>
                    <div id="eu-handshake" style="display: block;">
                        <div class="divMsg">
                            <span class="close cokkie_close" style="float:right" onclick="exit();">
                                <img style="width: 27px;" alt="close" src="<?php echo asset_url() . 'assets/frontend/images/close-icon.png'; ?>"></span>
                            <h2><?php echo $general_instruction->cookikie_title; ?></h2>
                            <div style="clear:both">
                                <span id="lbMsg"><?php echo $general_instruction->cookikie_title_info; ?></span><a href="<?php echo base_url() . $lang_id . '/' . 'page/cookie-policy'; ?>" id="hlViceInfo" target="_blank"><?php echo $general_instruction->cookikie_find_more; ?></a><span id="btnHandshake" class="btnHandshake"><?php echo $general_instruction->cookikie_accept_all; ?></span><span id="btnSettings" class="btnHandshake"><?php echo $general_instruction->cookikie_detail_setting; ?></span>
                            </div>
                            <div id="divSettings" class="settings" style="display: none;">
                                <ol style="text-align: left;">
                                    <li>
                                        <span disabled="disabled" class="checker"><input id="chkIsF" value="EUhandshakechkIsF" type="checkbox" name="EUhandshakechkIsF" checked="checked" disabled="disabled"><label for="chkIsF"><?php echo $general_instruction->cookikie_save_setting_fun; ?></label></span>
                                        <div id="divKydyF" class="kydy"><?php echo $general_instruction->cookikie_save_setting_fun_info; ?></div>
                                    </li>
                                    <li>
                                        <span class="checker"><input id="chkIsA" type="checkbox" value="EUhandshakechkIsA" name="EUhandshakechkIsA"><label for="chkIsA"><?php echo $general_instruction->cookikie_save_setting_anl; ?></label></span>
                                        <div id="divKydyA" class="kydy"><?php echo $general_instruction->cookikie_save_setting_anl_info; ?></div>
                                    </li>
                                    <li>
                                        <span class="checker"><input id="chkIsM" type="checkbox" value="EUhandshakechkIsM" name="EUhandshakechkIsM"><label for="chkIsM"><?php echo $general_instruction->cookikie_save_setting_mar; ?></label></span>
                                        <div id="divKydyM" class="kydy"><?php echo $general_instruction->cookikie_save_setting_mar_info; ?></div>
                                    </li>
                                </ol>
                                <div id="divCookieInfo"><?php echo $general_instruction->cookikie_setting_info; ?></div>
                                <span id="btnSaveSettings" class="btnHandshake"><?php echo $general_instruction->cookikie_save_setting; ?></span>

                            </div>

                        </div>
                    </div>
                </div>

            <?php } ?>
            <!--//////---->


            <?php $front_validuser_data = $this->session->userdata('front_validuser_data');
              $user_id = getFrontenduserId();
             $prolist = $this->config->item('product_list_show_to_guest_user');
            ?>
            <input type="hidden" class="isLogged" value="<?= isset($front_validuser_data['email']) ? $front_validuser_data['email'] : ''; ?>"  logged="<?= !empty($user_id) ? "true" : ''; ?>" progu="<?= ($prolist=="1") ? "true" : 'false'; ?>" >
            <?php if ($pageType != 'entry_door' || $pageType != 'addcard') {
                // $this->load->view('elements/popup/user_entry_popup');
            } ?>

            <script type="text/javascript">
                var base_url = "<?php echo base_url(); ?>";
                var base_url_lang_id = "<?php echo base_url() . $lang_id . '/'; ?>";
                var lang_id = "<?php echo $lang_id; ?>";
                var lang_num = '<?php echo $lang_num; ?>';
                var month_names = ["<?php echo $general_instruction->january; ?>", "<?php echo $general_instruction->february; ?>", "<?php echo $general_instruction->march; ?>", "<?php echo $general_instruction->april; ?>", "<?php echo $general_instruction->may; ?>", "<?php echo $general_instruction->june; ?>", "<?php echo $general_instruction->july; ?>", "<?php echo $general_instruction->august; ?>", "<?php echo $general_instruction->september; ?>", "<?php echo $general_instruction->october; ?>", "<?php echo $general_instruction->november; ?>", "<?php echo $general_instruction->december; ?>"];
                var week_names = ["<?php echo $general_instruction->sunday; ?>", "<?php echo $general_instruction->monday; ?>", "<?php echo $general_instruction->tuesday; ?>", "<?php echo $general_instruction->wednesday; ?>", "<?php echo $general_instruction->thursday; ?>", "<?php echo $general_instruction->friday; ?>", "<?php echo $general_instruction->saturday; ?>"];
                var eCode = '<?php echo getRandomCode(); ?>';
                var sCode = '<?php echo getRandomCode(); ?>';
                var pageType = '<?= $pageType; ?>';
                var isMobile = '<?= isMobile(); ?>';
            </script>
             <?php if (isset($pageType) && ($pageType != 'productlist')) { ?>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <?php } ?>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/wos-lib-estore.js?version=' . $ASSET_VERSION); ?>"></script>
            <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/wos-lib-estore-migrate.js?version=' . $ASSET_VERSION); ?>"></script>
            <script type="text/javascript" class="custom-js" data-src="<?php echo asset_url('assets/frontend/js/estore-ui/wos-ui-estore.min.js?version=' . $ASSET_VERSION); ?>"></script>
            <script type="text/javascript" class="custom-js" data-src="<?php echo asset_url('assets/frontend/js/estore-ui/wos-ui-estore.minprod.js?version=' . $ASSET_VERSION); ?>"></script>
            <script type="text/javascript" class="custom-js" src="<?php echo asset_url('assets/frontend/js/estore-strap-wos.js?version=' . $ASSET_VERSION); ?>"></script>
            <script type="text/javascript" class="custom-js" data-src="<?php echo asset_url('assets/frontend/js/countdown.js?version=' . $ASSET_VERSION); ?>" defer></script>
            <script type="text/javascript" class="custom-js" data-src="<?php echo asset_url('assets/frontend/js/flipclock.js?version=' . $ASSET_VERSION); ?>" defer></script>
            <script type="text/javascript" class="custom-js" data-src="<?php echo asset_url('assets/frontend/js/estoremode.custom.min.js?version=' . $ASSET_VERSION); ?>" defer></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
           
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
            
            <script src="<?php echo asset_url('assets/plugins/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script>
           
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"> </script> 

            <?php if (ENVIRONMENT == 'production') { ?>
                <script type="text/javascript" class="custom-js" data-src="<?php echo asset_url('assets/frontend/js/store-prevent.js?version=' . $ASSET_VERSION); ?>" defer></script>
            <?php } ?>

            <?php if (isset($pageType) && ($pageType == 'products' || $pageType == 'vehicle_type' || $pageType == 'productmaker'   || $pageType == 'productmodel'   || $pageType == 'productitems'  || $pageType == 'productlist' || $pageType == 'cart' || $pageType == 'entry_door' || $pageType == 'home' || $pageType == 'stripepayment' || $pageType == 'paymentproof' || $pageType == 'bamboopayment' || $pageType == 'moneris' || $pageType == 'clictopay' || $pageType == 'paymeepayment' || $pageType == 'squareup' || $pageType == 'page' || $pageType == 'contact' || $pageType == 'verifycontact' || $pageType == 'signup' || $pageType == 'addcard' || $pageType == 'profile' || $pageType == 'credit_term')) { ?>
                <script type="text/javascript" class="custom-js" data-src="<?php echo asset_url('assets/frontend/js/estore-strap-wos-select.js?version=' . $ASSET_VERSION); ?>" defer></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/msdropdown/estore.dd.js?version=' . $ASSET_VERSION) ?>" defer></script>
                <script type="text/javascript" class="custom-js" data-src="<?php echo asset_url('assets/frontend/js/lang_select.js?version=' . $ASSET_VERSION); ?>" defer></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/quicksearch-new.js?version=' . $ASSET_VERSION); ?>" defer></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/products.js?version=' . $ASSET_VERSION) ?>" type="text/javascript"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/imask/3.4.0/imask.min.js"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-light.js?version=' . $ASSET_VERSION); ?>" defer></script>

            <?php } ?>

            <?php if (isset($pageType) && $pageType == 'home') { ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/jssor.slider-22.1.8.mini.js'); ?>"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-slider.js?version=' . $ASSET_VERSION); ?>" defer></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/home-slider.js'); ?>" defer></script>

                <script type="text/javascript">
                    $(document).ready(function() {
                        var tot_vehicle_types = <?php echo $num_vehicle_type_for_menu; ?>;
                        var loaded_messages = 0;
                        $("#more_button_vehicle_types").click(function() {
                            if (loaded_messages < tot_vehicle_types - <?php echo $this->config->item('pagination_limit'); ?>) {

                                var vehicleBtnText = $("#more_button_vehicle_types").text();
                                $("#more_button_vehicle_types").text(plsWaitText);
                                loaded_messages += <?php echo $this->config->item('pagination_limit'); ?>;
                                $.get("products/get_vehicle_categories/" + loaded_messages, function(data) {
                                    $("#vehicle_type_block").append(data);
                                    $("#more_button_vehicle_types").text(vehicleBtnText);
                                    $("#checkbox_vehicle").prop('checked', false);
                                    $("#vehicle_categories_num").text($('.vehicle_category_id').length);
                                    if (loaded_messages >= tot_vehicle_types - <?php echo $this->config->item('pagination_limit'); ?>) {
                                        $("#more_button_vehicle_types").html('<?php echo $general_instruction->no_more_vehicle_type_to_load; ?>');
                                        $("#more_button_vehicle_types").attr('id', '');
                                    }
                                });
                            }
                        });

                        if ($(".hours .flip-clock-label").html() != '') {
                            $(".hours .flip-clock-label").html('<?php echo $general_instruction->hours; ?>');
                        }

                        if ($(".minutes .flip-clock-label").html() != '') {
                            $(".minutes .flip-clock-label").html('<?php echo $general_instruction->minutes; ?>');
                        }

                        if ($(".seconds .flip-clock-label").html() != '') {
                            $(".seconds .flip-clock-label").html('<?php echo $general_instruction->seconds; ?>');
                        }
                    });
                </script>
            <?php } ?>

            <?php if (isset($pageType) && ($pageType == 'page' || $pageType == 'contact' || $pageType == 'verifycontact')) { ?>
                <script type="text/javascript">
                    $(document).ready(function() {

                        if ($(".hours .flip-clock-label").html() != '') {
                            $(".hours .flip-clock-label").html('<?php echo $general_instruction->hours; ?>');
                        }

                        if ($(".minutes .flip-clock-label").html() != '') {
                            $(".minutes .flip-clock-label").html('<?php echo $general_instruction->minutes; ?>');
                        }

                        if ($(".seconds .flip-clock-label").html() != '') {
                            $(".seconds .flip-clock-label").html('<?php echo $general_instruction->seconds; ?>');
                        }
                    });
                </script>
            <?php } ?>

            <?php if (isset($pageType) &&  ($pageType == 'contact')) { ?>
                <script type="text/javascript">
                    var branch_label = "<?php echo isset($cart_instruction->branch) ? $cart_instruction->branch : ''; ?>";
                    var title_label = "<?php echo $cart_instruction->title; ?>";
                    var name_surname_label = "<?php echo $cart_instruction->name_surname; ?>";
                    var company_label = "<?php echo $cart_instruction->company; ?>";
                    var designation_label = "<?php echo $cart_instruction->designation; ?>";
                    var country_label = "<?php echo $cart_instruction->country; ?>";
                    var cellphone_label = "<?php echo $cart_instruction->cellphone; ?>";
                    var email_label = "<?php echo $cart_instruction->email; ?>";
                    var message_label = "<?php echo $cart_instruction->contact_message; ?>";
                </script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-validation.js?version=' . $ASSET_VERSION) ?>" defer></script>
                <?php if ($lang_id != 'en') { ?>
                    <script type="text/javascript" src="<?php echo asset_url('assets/frontend/locales/messages_' . $lang_id . '.js?version=' . $ASSET_VERSION) ?>"></script>
                <?php } ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/contact_us.js?version=' . $ASSET_VERSION); ?>"></script>
                <script type="text/javascript">
                    $(window).load(function() {
                        $('.commonLoader').hide();
                    });
                </script>
            <?php } ?>

            <!-- Verify Contact Scripts --->
            <?php if ($pageType == "verifycontact") { ?>
                <script>
                    var verification_code_email_sent_text = "<?php echo str_replace('EMAILVAR', $user_email, $cart_instruction->verification_code_to_email); ?>";
                    var resend_attempt_text = "<?php echo $form_validation_instruction->resend_email_attempt; ?>";
                    var wrong_email_code_attempt = "<?php echo $form_validation_instruction->wrong_email_code_attempt; ?>";
                </script>
                <script type="text/javascript" src="<?php echo base_url('assets/frontend/js/verify_contact.js?version=' . $ASSET_VERSION);  ?>"></script>
                <script type="text/javascript">
                    $(window).load(function() {
                        $('.commonLoader').hide();
                    });
                </script>
            <?php } ?>

            <?php if (isset($pageType) && $pageType == 'entry_door') { ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/entry_door.js?version=' . $ASSET_VERSION); ?>"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/master.js?version=' . getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>
                <script type="text/javascript">
                    $(window).load(function() {
                        $('.commonLoader').hide();
                    });
                </script>
            <?php } ?>

            <?php if (isset($pageType) && $pageType == 'signup') { ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/entry_door.js?version=' . $ASSET_VERSION); ?>"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/master.js?version=' . getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/signup.js?version=' . getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>

                <script type="text/javascript">
                    $(window).load(function() {
                        $('.commonLoader').hide();
                    });
                </script>
            <?php } ?>


            <?php if (isset($pageType) && $pageType == 'profile') { ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/entry_door.js?version=' . $ASSET_VERSION); ?>"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/master.js?version=' . getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>

                <script type="text/javascript">
                    $(window).load(function() {
                        $('.commonLoader').hide();
                    });
                </script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-validation.js?version=' . $ASSET_VERSION) ?>" defer></script>

                <?php if ($lang_id != 'en') { ?>
                    <script type="text/javascript" src="<?php echo asset_url('assets/frontend/locales/messages_' . $lang_id . '.js?version=' . $ASSET_VERSION) ?>"></script>
                <?php } ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/profile.js?version=' . getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>
            <?php } ?>


            <?php if (isset($pageType) && $pageType == 'credit_term') { ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/entry_door.js?version=' . $ASSET_VERSION); ?>"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/master.js?version=' . getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>

                <script type="text/javascript">
                    $(window).load(function() {
                        $('.commonLoader').hide();
                    });
                </script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-validation.js?version=' . $ASSET_VERSION) ?>" defer></script>

                <?php if ($lang_id != 'en') { ?>
                    <script type="text/javascript" src="<?php echo asset_url('assets/frontend/locales/messages_' . $lang_id . '.js?version=' . $ASSET_VERSION) ?>"></script>
                <?php } ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/creditterm.js?version=' . getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>
            <?php } ?>


            <?php if (isset($pageType) && $pageType == 'addcard') { ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/entry_door.js?version=' . $ASSET_VERSION); ?>"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/master.js?version=' . getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/signup.js?version=' . getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>

                <script type="text/javascript">
                    $(window).load(function() {
                        $('.commonLoader').hide();
                    });
                </script>
            <?php } ?>


            <?php if (isset($pageType) && ($pageType == 'productmaker')) { ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/product-maker.js?version=' . $ASSET_VERSION) ?>" type="text/javascript"></script>
            <?php } ?>

            <?php if (isset($pageType) && ($pageType == 'productmodel')) { ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/product-model.js?version=' . $ASSET_VERSION) ?>" type="text/javascript"></script>
            <?php } ?>

            <?php if (isset($pageType) && ($pageType == 'productlist')) { ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/productslist.js?version=' . $ASSET_VERSION); ?>" defer></script>
 
                <script type="text/javascript" src="<?php echo asset_url('assets/plugins/slick/slick/slick.js?version=' . getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>

                    <script type="text/javascript">
                    $(window).load(function() {
                    $('.commonLoader').hide();
                    });
        //////////////////////////////////////////////////////////////
        /*
                    $(document).on('ready', function() {
                    $('.slider-for').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                asNavFor: '.slider-nav',
                rtl: document.dir=='rtl'?true:false
                    });
                if (window.matchMedia("(max-width: 767px)").matches)  
                { 
            
                $('.slider-nav').slick({
                slidesToShow: 2,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: false,
                centerMode: true,
                focusOnSelect: true,
                rtl: document.dir=='rtl'?true:false
                });
                } else { 
                
                $('.slider-nav').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: false,
                centerMode: true,
                focusOnSelect: true,
                rtl: document.dir=='rtl'?true:false
                }); 
                } 
                });
                */

                //$(document).on('ready', function() {
                document.addEventListener('DOMContentLoaded', function() {    
                    // Function to initialize a slider
                    function initializeSlickSliders(container) {
                        // Initialize the main slider
                        $(container).find('.slider-for').slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false,
                            fade: true,
                            asNavFor: '.slider-nav',
                            rtl: document.dir == 'rtl' ? true : false,
                            accessibility: false // Disables ARIA attributes if necessary
                        });

                        // Initialize the navigation slider based on screen size
                        if (window.matchMedia("(max-width: 767px)").matches) {
                            $(container).find('.slider-nav').slick({
                                slidesToShow: 2,
                                slidesToScroll: 1,
                                asNavFor: '.slider-for',
                                dots: false,
                                centerMode: true,
                                focusOnSelect: true,
                                rtl: document.dir == 'rtl' ? true : false
                            });
                        } else {
                            $(container).find('.slider-nav').slick({
                                slidesToShow: 4,
                                slidesToScroll: 1,
                                asNavFor: '.slider-for',
                                dots: false,
                                centerMode: true,
                                focusOnSelect: true,
                                rtl: document.dir == 'rtl' ? true : false
                            });
                        }
                    }

                    // Initialize existing sliders on page load
                    $('.product-slider-container').each(function() {
                        initializeSlickSliders(this);
                    });
                });
        /////////////////////////////////////////////////////////////////////////////////////

            </script>

            <?php } ?>

            <?php if (isset($pageType) && ($pageType == 'cart')) { ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-validation.js?version=' . $ASSET_VERSION) ?>" defer></script>

                <?php if ($lang_id != 'en') { ?>
                    <script type="text/javascript" src="<?php echo asset_url('assets/frontend/locales/messages_' . $lang_id . '.js?version=' . $ASSET_VERSION) ?>"></script>
                <?php } ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/carts-new.js?version=' . getenv('ASSET_VERSION')) ?>"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/cart.js?version=' . $ASSET_VERSION); ?>"></script>
                <script type="text/javascript">
                    $(window).load(function() {
                        $('.commonLoader').hide();
                    });
                </script>

                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/productslist.js?version=' . $ASSET_VERSION); ?>" defer></script>
                
                <script type="text/javascript" src="<?php echo asset_url('assets/plugins/slick/slick/slick.js?version=' . getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>

                <script type="text/javascript">
                            $(window).load(function() {
                $('.commonLoader').hide();
                });

                $(document).on('ready', function() {

                $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.slider-nav',
                rtl: document.dir=='rtl'?true:false
                });
                    if (window.matchMedia("(max-width: 767px)").matches)
                    {    
                        $('.slider-nav').slick({
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        asNavFor: '.slider-for',
                        dots: false,
                        centerMode: true,
                        focusOnSelect: true,
                        rtl: document.dir=='rtl'?true:false
                        });        
                    }else{    
                        $('.slider-nav').slick({
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        asNavFor: '.slider-for',
                        dots: false,
                        centerMode: true,
                        focusOnSelect: true,
                        rtl: document.dir=='rtl'?true:false
                        });        
                    }
                });
                </script>



            <?php } ?>

            <?php if (isset($pageType) && ($pageType == 'stripepayment')) { ?>
                <script src="https://js.stripe.com/v3/"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/cart.js?version=' . $ASSET_VERSION); ?>"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/carts-new.js?version=' . $ASSET_VERSION) ?>" type="text/javascript"></script>
                <script type="text/javascript">
                    $(window).load(function() {
                        $('.commonLoader').hide();


                        $('input:radio[name="creditterm_payment"]').change(
                            function() {
                                if ($(this).is(':checked') && $(this).val() == '1') {
                                    $(".payment_div").hide();
                                    $(".direct_payment").show();
                                } else if ($(this).is(':checked') && $(this).val() == '0') {
                                    $(".payment_div").show();
                                    $(".direct_payment").hide();

                                }
                            });










                    });
                </script>


            <?php } ?>


            <?php if (isset($pageType) && ($pageType == 'paymentproof')) { ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/cart.js?version=' . $ASSET_VERSION); ?>"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/carts-new.js?version=' . $ASSET_VERSION) ?>" type="text/javascript"></script>
                <script type="text/javascript">
                    $(window).load(function() {
                        $('.commonLoader').hide();


                        $('input:radio[name="creditterm_payment"]').change(
                            function() {
                                if ($(this).is(':checked') && $(this).val() == '1') {
                                    $(".payment_div").hide();
                                    $(".direct_payment").show();
                                } else if ($(this).is(':checked') && $(this).val() == '0') {
                                    $(".payment_div").show();
                                    $(".direct_payment").hide();

                                }
                            });



                    });
                </script>


            <?php } ?>


            <?php if (isset($pageType) && ($pageType == 'bamboopayment')) { ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/carts-new.js?version=' . getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>
                <script type="text/javascript" src='https://libs.na.bambora.com/customcheckout/1/customcheckout.js'></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/custom-checkout-ctrl.js?version=' . getenv('ASSET_VERSION')) ?>"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/main.js?version=' . getenv('ASSET_VERSION')) ?>"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/cart.js?version=' . $ASSET_VERSION); ?>"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/carts-new.js?version=' . $ASSET_VERSION) ?>" type="text/javascript"></script>
                <script type="text/javascript">
                    $(window).load(function() {
                        $('.commonLoader').hide();


                        $('input:radio[name="creditterm_payment"]').change(
                            function() {
                                if ($(this).is(':checked') && $(this).val() == '1') {
                                    $(".payment_div").hide();
                                    $(".direct_payment").show();
                                } else if ($(this).is(':checked') && $(this).val() == '0') {
                                    $(".payment_div").show();
                                    $(".direct_payment").hide();

                                }
                            });










                    });
                </script>
            <?php } ?>

            <?php if (isset($pageType) && ($pageType == 'paymeepayment')) { ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/carts-new.js?version=' . getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>
                <script type="text/javascript">
                    $(window).load(function() {
                        $('.commonLoader').hide();


                        $('input:radio[name="creditterm_payment"]').change(
                            function() {
                                if ($(this).is(':checked') && $(this).val() == '1') {
                                    $(".payment_div").hide();
                                    $(".direct_payment").show();
                                } else if ($(this).is(':checked') && $(this).val() == '0') {
                                    $(".payment_div").show();
                                    $(".direct_payment").hide();

                                }
                            });










                    });
                </script>

            <?php } ?>


            <?php if (isset($pageType) && ($pageType == 'moneris')) { ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/main.js?version=' . getenv('ASSET_VERSION')) ?>"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/cart.js?version=' . $ASSET_VERSION); ?>"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/carts-new.js?version=' . $ASSET_VERSION) ?>" type="text/javascript"></script>

    

                
                <script type="text/javascript">
            
                    $(window).load(function() {
                       
                 
                        $('.commonLoader').hide();


                        $('input:radio[name="creditterm_payment"]').change(
                            function() {
                                if ($(this).is(':checked') && $(this).val() == '1') {
                                    $(".payment_div").hide();
                                    $(".direct_payment").show();
                                } else if ($(this).is(':checked') && $(this).val() == '0') {
                                    $(".payment_div").show();
                                    $(".direct_payment").hide();

                                }
                            });










                    });
                </script>
            <?php } ?>
            <?php if (isset($pageType) && ($pageType == 'clictopay')) { ?>




                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/cart.js?version=' . $ASSET_VERSION); ?>"></script>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/carts-new.js?version=' . $ASSET_VERSION) ?>" type="text/javascript"></script>
                <script type="text/javascript">
                    $(window).load(function() {
                        $('.commonLoader').hide();


                        $('input:radio[name="creditterm_payment"]').change(
                            function() {
                                if ($(this).is(':checked') && $(this).val() == '1') {
                                    $(".payment_div").hide();
                                    $(".direct_payment").show();
                                } else if ($(this).is(':checked') && $(this).val() == '0') {
                                    $(".payment_div").show();
                                    $(".direct_payment").hide();

                                }
                            });


                        var click_pay_error = $("#click_pay_error").val();
                        if (click_pay_error == "1") {

                            var click_pay_message = $("#click_pay_message").val();
                            $('#customwarning_msg').text(click_pay_message);
                            $("#customwarning").modal('show');
                        }

                        var payment_api_error = $("#payment_api_error").val();
                        if (payment_api_error == "1") {

                            var click_pay_message = $("#click_pay_message").val();
                            $('#customwarning_msg').text(click_pay_message);
                            $("#customwarning").modal('show');
                        }








                    });
                </script>
            <?php } ?>

            <?php if (isset($pageType) && ($pageType == 'squareup')) { ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/cart.js?version=' . $ASSET_VERSION); ?>"></script>

                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/carts-new.js?version=' . getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>
                <?php if ($this->config->item('payment_mode') == 1) { ?>
                    <script type="text/javascript" src="https://web.squarecdn.com/v1/square.js"></script>
                <?php  } else { ?>
                    <script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
                <?php  } ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/squareup.js?version=' . getenv('ASSET_VERSION')) ?>"></script>
                <script type="text/javascript">
                    $(window).load(function() {

                        $('input:radio[name="creditterm_payment"]').change(
                            function() {
                                if ($(this).is(':checked') && $(this).val() == '1') {
                                    $(".payment_div").hide();
                                    $(".direct_payment").show();
                                } else if ($(this).is(':checked') && $(this).val() == '0') {
                                    $(".payment_div").show();
                                    $(".direct_payment").hide();

                                }
                            });
                    });
                </script>
            <?php } ?>



            <?php if (isset($pageType) && ($pageType == 'addcard')) { ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/cart.js?version=' . $ASSET_VERSION); ?>"></script>

                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/carts-new.js?version=' . getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>
                <?php if ($this->config->item('payment_mode') == 1) { ?>
                    <script type="text/javascript" src="https://web.squarecdn.com/v1/square.js"></script>
                <?php  } else { ?>
                    <script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
                <?php  } ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/addsquarecard.js?version=' . getenv('ASSET_VERSION')) ?>"></script>
                <script type="text/javascript">
                    $(window).load(function() {
                        // $('.commonLoader').hide();
                    });
                </script>
            <?php } ?>

            <script type="text/javascript">
                $(window).load(function() {

                    if ($('.quick-search-status').val() != 1) {
                        $('.commonLoader').hide();
                    }
                });
            </script>

            <?php if ($this->session->flashdata('flash_message')) { ?>

                <script type="text/javascript">
                    $(window).load(function() {
                        $('#modal_mssg').modal('show');

                    });
                </script>
            <?php } ?>

            </body>

            </html>
