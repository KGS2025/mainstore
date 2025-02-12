<div class="content zerorightmargin">
    <?php
    if ($this->session->flashdata('success')) {
        $msg = $this->session->flashdata('success');
        ?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?>
            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if ($this->session->flashdata('error')) {
        $msg = $this->session->flashdata('error');
        ?>
        <div class="notice outer">
            <div class="error"><?php echo $msg; ?>
            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (isset($country_data) && !empty($country_data)) {
        foreach ($country_data as $cdata) {
            if (($cdata['short_code'] == $lang_id)) {
                if(isset($cdata['coming_soon_image']) && $cdata['coming_soon_image'] != '') {
                    $comingsoon = global_img_link($cdata['coming_soon_image'], 'uploads/country/coming_soon/');
                } else {
                    $comingsoon = base_url() . 'assets/frontend/images/coming_soon.jpg';
                }
                if(isset($cdata['no_image']) && $cdata['no_image'] != '') {
                    $noimage = global_img_link($cdata['no_image'], 'uploads/country/no_image/');
                } else {
                    $noimage = base_url() . 'assets/admin/images/previewimage.jpg';
                }              
            }
        }
    }
    ?>



    <div class="outer">
        <div class="inner">
            <div class="page-header">
                
                <div class="body">


                    <!-- Content container -->
                    <div class="container">

                        <!-- Pickers -->
                        <?php
                        if ($edit_page == 'time') {
                            ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="time" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner">
                                                    <h5><?php echo $admin_edit_welcomepage['time_position']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['time_position']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/time_position'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/time_position/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['time_position_text']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['time_position_text']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/time_position_text'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/time_position_text/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>

                                                <div class="controls">
                                                    <select name="time_position" id="rom_pay" required >
                                                        <option value="">Select</option>
                                                        <option value="top_left">Top Left</option>
                                                        <option value="top_right">Top Right</option>
                                                        <option value="bottom_left">Bottom Left</option>
                                                        <option value="bottom_right">Bottom Right</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>
                            <?php
                        } else if ($edit_page == 'globe_position') {
                            ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="globe_position" value="set"/>

                                <div class="row-fluid">
                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5> <?php echo $admin_edit_welcomepage['globe_position']['admin']; ?></h5>

                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['globe_position']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/globe_position'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/globe_position/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['globe_position_text']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['globe_position_text']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/globe_position_text'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/globe_position_text/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <select name="globe_position" id="rom_pay" required >
                                                        <option value=""><?php echo $admin_static_links['select_text']['front']; ?></option>
                                                        <option value="left"><?php echo $admin_static_links['left_text']['front']; ?></option>
                                                        <option value="right"><?php echo $admin_static_links['right_text']['front']; ?></option>
                                                        <option value="center"><?php echo $admin_static_links['center']['front']; ?></option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>
                            <?php
                        } else if ($edit_page == 'product_position') {
                            ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="product_position" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5> <?php echo $admin_edit_welcomepage['product_position']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['product_position']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/product_position'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/product_position/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['product_position_text']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['product_position_text']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/product_position_text'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/product_position_text/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <select name="product_position" id="rom_pay" required >
                                                        <option value=""><?php echo $admin_static_links['select_text']['front']; ?></option>
                                                        <option value="left"><?php echo $admin_static_links['left_text']['front']; ?></option>
                                                        <option value="right"><?php echo $admin_static_links['right_text']['front']; ?></option>
                                                        <option value="center"><?php echo $admin_static_links['center']['front']; ?></option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>
                            <?php
                        } else if ($edit_page == 'globe_size') {
                            ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="globe_size" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5> <?php echo $admin_edit_welcomepage['globe_size']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['globe_size']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/globe_size'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/globe_size/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['size']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['size']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/size'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/size/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <select name="globe_size_data" id="rom_pay" required>
                                                        <option value=""><?php echo $admin_static_links['select_text']['front']; ?></option>
                                                        <option value="left"><?php echo $admin_static_links['small']['front']; ?></option>
                                                        <option value="right"><?php echo $admin_static_links['medium']['front']; ?></option>
                                                        <option value="center"><?php echo $admin_static_links['large']['front']; ?></option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>
                            <?php
                        } else if ($edit_page == 'background') {
                            ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="background" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5><?php echo $admin_edit_welcomepage['background']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['background']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/background'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/background/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['background_photo']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['background_photo']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/background_photo'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/background_photo/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls"><input type="file" name="file"/></div>
                                            </div>

                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>


                                        </div>

                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>
                            <?php
                        } else if ($edit_page == 'main_background') {
                            ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="main_background" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5> <?php echo $admin_edit_welcomepage['inner_page_background']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['inner_page_background']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/inner_page_background'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/inner_page_background/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['inner_page_background_photo']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['inner_page_background_photo']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/inner_page_background_photo'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/inner_page_background_photo/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls"><input type="file" name="file"/></div>
                                                <span>Allowed Types : <b>'gif|jpg|png'</b> -  Dimensions : <b>(Max of 3000X3000)</b></span>
                                            </div>

                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>


                                        </div>

                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>
                            <?php
                        } else if ($edit_page == 'main_footer_background') {
                            ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="main_footer_background" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5> <?php echo $admin_edit_welcomepage['inner_page_footer_background']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['inner_page_footer_background']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/inner_page_footer_background'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/inner_page_footer_background/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['inner_page_footer_background_photo']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['inner_page_footer_background_photo']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/inner_page_footer_background_photo'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/inner_page_footer_background_photo/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls"><input type="file" name="file"/></div>
                                                <span>Allowed Types : <b>'gif|jpg|png'</b> -  Dimensions : <b>(Max of 3000X3000)</b></span>
                                            </div>

                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>


                                        </div>

                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>
                            <?php
                        } else if ($edit_page == 'social_media') {
                            ?>
                            <form class="form-horizontal" method="post">
                                <input type="hidden" name="social_media" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5><?php echo $admin_edit_welcomepage['social_media']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['social_media']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/social_media'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/social_media/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['social_media_text']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['social_media_text']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/social_media_text'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/social_media_text/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title1" name="social_media_text" class="focustip span12" type="text"
                                                           value="<?php echo $edit_data['social_media_text']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/social_media_text" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('social_media_text'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['facebook_url']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['facebook_url']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/facebook_url'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/facebook_url/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls"><input id="title2" name="facebook" class="focustip span12" type="text"
                                                                             value="<?php echo $edit_data['facebook']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>></div>
                                                <span class="red1"><?php echo form_error('facebook'); ?></span>

                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['twitter_url']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['twitter_url']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/twitter_url'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/twitter_url/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls"><input id="title3" name="twitter" class="focustip span12" type="text"
                                                                             value="<?php echo $edit_data['twitter']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>></div>
                                                <span class="red1"><?php echo form_error('twitter'); ?></span>

                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['linkedin_url']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['linkedin_url']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/linkedin_url'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/linkedin_url/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls"><input id="title4" name="linkedin" class="focustip span12" type="text"
                                                                             value="<?php echo $edit_data['linkedin']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>></div>
                                                <span class="red1"><?php echo form_error('linkedin'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['youtube_url']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['youtube_url']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/youtube_url'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/youtube_url/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls"><input id="title5" name="youtube" class="focustip span12" type="text"
                                                                             value="<?php echo $edit_data['youtube']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>></div>
                                                <span class="red1"><?php echo form_error('youtube'); ?></span>
                                            </div>
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>

                        <?php
                        } else if ($edit_page == 'footer_text') {
                            ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="footer_text" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5><?php echo $admin_edit_welcomepage['footer_text']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['footer_text']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/footer_text'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/footer_text/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['header_image']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['header_image']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/header_image'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/header_image/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <?php
                                                   
                                                    if (isset($edit_data['header_image']) && $edit_data['header_image'] != '' && file_exists('assets/uploads/logo/thumbnails/' . $edit_data['header_image'])) {
                                                        $header_image = 'assets/uploads/logo/thumbnails/' . $edit_data['header_image'];
                                                    } else {
                                                        $header_image = $noimage;
                                                    }
                                                    ?>
                                                    <img src="<?php echo $header_image; ?>" height="100" width="100"/>
                                                    <input type="hidden" name="hidden_header_image" id="hidden_header_image" value="<?php echo $edit_data['header_image'] ?>">
                                                </div>
                                                <div class="controls"><input type="file" name="file"/></div>
                                                <div class="controls"><span class="red1"><?php echo $admin_static_links['attach_header_image_resolution']['front']; ?></span></div>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_static_links['attach_header_image_resolution']['front']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_static_links/attach_header_image_resolution'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_static_links_country/attach_header_image_resolution/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>



                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['right_logo_status']['admin'];?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['right_logo_status']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/right_logo_status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/right_logo_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="right_logo_status" name="right_logo_status"  type="checkbox" <?php if($edit_data['right_logo_status'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('right_logo_status'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['header_image_url']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['header_image_url']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/header_image_url'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/header_image_url/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="header_image_url" name="header_image_url" class="focustip span12" type="text" value="<?php echo $edit_data['header_image_url']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/header_image_url" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('header_image_url'); ?></span>
                                            </div>
                                            
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['footer_phone1']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['footer_phone1']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/footer_phone1'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/footer_phone1/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="footer_phone1" name="footer_phone1" class="focustip span12" type="text" value="<?php echo $edit_data['footer_phone1']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/footer_phone1" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('footer_phone1'); ?></span>

                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['footer_phone2']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['footer_phone2']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/footer_phone2'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/footer_phone2/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls"><input id="footer_phone2" name="footer_phone2" class="focustip span12" type="text"
                                                                             value="<?php echo $edit_data['footer_phone2']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/footer_phone2" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('footer_phone2'); ?></span>

                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['footer_address']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['footer_address']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/footer_address'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/footer_address/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <textarea id="footer_address" name="footer_address" class="ckeditor4 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                    <?php echo $edit_data['footer_address']; ?> </textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/footer_address/textarea/editor" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('footer_address'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['footer_payment_methods']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['footer_payment_methods']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/footer_payment_methods'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/footer_payment_methods/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <textarea id="footer_payment_methods" name="footer_payment_methods" class="ckeditor4 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                    <?php echo $edit_data['footer_payment_methods']; ?> </textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/footer_payment_methods" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('footer_payment_methods'); ?></span>
                                            </div>
                                            
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['footer_email']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['footer_email']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/footer_email'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/footer_email/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls"><input id="footer_email" name="footer_email" class="focustip span12" type="text"
                                                                             value="<?php echo $edit_data['footer_email']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                
                                                </div>
                                                <span class="red1"><?php echo form_error('footer_email'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['footer_map_iframe']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['footer_map_iframe']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/footer_map_iframe'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/footer_map_iframe/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <textarea cols="6" rows="4" id="footer_map_iframe" name="footer_map_iframe" class="focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> ><?php echo $edit_data['footer_map_iframe']; ?></textarea> 
                                                </div>
                                                <span class="red1"><?php echo form_error('footer_map_iframe'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['footer_facebook_iframe']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['footer_facebook_iframe']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/footer_facebook_iframe'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/footer_facebook_iframe/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <textarea cols="6" rows="4" id="footer_facebook_iframe" name="footer_facebook_iframe" class="focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> ><?php echo $edit_data['footer_facebook_iframe']; ?></textarea> 
                                                </div>
                                                <span class="red1"><?php echo form_error('footer_facebook_iframe'); ?></span>
                                            </div>

                                           

                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>

                            <?php
                        } else if ($edit_page == 'home_product_section') {
                            ?>
                            
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="home_product_section" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5><?php echo $admin_edit_welcomepage['home_product_section']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['home_product_section']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/home_product_section'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/home_product_section/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['product_section_head']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['product_section_head']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/product_section_head'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/product_section_head/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="product_section_head" name="product_section_head" class="focustip span12" type="text" value="<?php echo $edit_data['product_section_head']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/product_section_head" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('product_section_head'); ?></span>

                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['product_section_title']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['product_section_title']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/product_section_title'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/product_section_title/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="product_section_title" name="product_section_title" class="focustip span12" type="text" value="<?php echo $edit_data['product_section_title']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/product_section_title" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('product_section_title'); ?></span>

                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['product_section_image']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['product_section_image']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/product_section_image'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/product_section_image/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <?php 
                                                    if (isset($edit_data['product_section_image']) && $edit_data['product_section_image'] != '' && file_exists('assets/uploads/home_product/thumbnails/' . $edit_data['product_section_image'])) {
                                                        $product_section_image = 'assets/uploads/home_product/thumbnails/' . $edit_data['product_section_image'];
                                                    } else {
                                                        $product_section_image = $noimage;
                                                    }
                                                    ?>
                                                    <img src="<?php echo $product_section_image; ?>" height="100" width="100"/>
                                                    <input type="hidden" name="hidden_product_section_image" id="hidden_product_section_image" value="<?php echo $edit_data['product_section_image'] ?>">
                                                </div>
                                                <div class="controls"><input type="file" name="file"/></div>
                                                <div class="controls"><span class="red1"><?php echo $admin_static_links['attach_product_section_image_resolution']['front']; ?></span></div>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_static_links['attach_product_section_image_resolution']['front']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_static_links/attach_product_section_image_resolution'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_static_links_country/attach_product_section_image_resolution/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['product_section_description']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['product_section_description']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/product_section_description'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/product_section_description/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <textarea id="product_section_description" name="product_section_description" class="ckeditor4 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>><?php echo htmlentities($edit_data['product_section_description']); ?></textarea>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/product_section_description/textarea/editor" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('product_section_description'); ?></span>
                                            </div>
                                            
                                            
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['production_section_button_text']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['production_section_button_text']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/production_section_button_text'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/production_section_button_text/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls"><input id="production_section_button_text" name="production_section_button_text" class="focustip span12" type="text"
                                                                             value="<?php echo $edit_data['production_section_button_text']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/production_section_button_text" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('production_section_button_text'); ?></span>

                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['product_section_button_url']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['product_section_button_url']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/product_section_button_url'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/product_section_button_url/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls"><input id="product_section_button_url" name="product_section_button_url" class="focustip span12" type="text"
                                                                             value="<?php echo $edit_data['product_section_button_url']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                
                                                </div>
                                                <span class="red1"><?php echo form_error('product_section_button_url'); ?></span>
                                            </div>
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>

                            <?php
                        } else if ($edit_page == 'home_page_headings') {

                          
                            ?>
                            
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="home_page_headings" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5><?php echo $admin_edit_welcomepage['home_page_headings']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['home_page_headings']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/home_page_headings'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/home_page_headings/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <div class="controls">
                                                    <input id="whats_new" name="whats_new" class="focustip span12" type="text" value="<?php echo $edit_data['whats_new']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> required>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/whats_new" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('whats_new'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <div class="controls">
                                                    <input id="contact_us" name="contact_us" class="focustip span12" type="text" value="<?php echo $edit_data['contact_us']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> required>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/contact_us" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('contact_us'); ?></span>

                                                <div class="controls">
                                                    <label class="control-label"><?php echo $admin_static_links['page_section_status']['front']; ?></label>
                                                    <div class="controls">
                                                        <input id="contact_us_status" name="contact_us_status"  type="checkbox" <?php if($edit_data['contact_us_status'] == 1){echo 'checked';}?> value="1">
                                                    </div>
                                                    <span class="red1"><?php echo form_error('contact_us_status'); ?></span>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <div class="controls">
                                                    <input id="quick_links" name="quick_links" class="focustip span12" type="text" value="<?php echo $edit_data['quick_links']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> required>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/quick_links" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('quick_links'); ?></span>

                                                <div class="controls">
                                                    <label class="control-label"><?php echo $admin_static_links['page_section_status']['front']; ?></label>
                                                    <div class="controls">
                                                        <input id="quick_links_status" name="quick_links_status"  type="checkbox" <?php if($edit_data['quick_links_status'] == 1){echo 'checked';}?> value="1">
                                                    </div>
                                                    <span class="red1"><?php echo form_error('quick_links_status'); ?></span>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <div class="controls">
                                                    <input id="route_map" name="route_map" class="focustip span12" type="text" value="<?php echo $edit_data['route_map']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> required>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/route_map" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('route_map'); ?></span>

                                                <div class="controls">
                                                    <label class="control-label"><?php echo $admin_static_links['page_section_status']['front']; ?></label>
                                                    <div class="controls">
                                                        <input id="route_map_status" name="route_map_status"  type="checkbox" <?php if($edit_data['route_map_status'] == 1){echo 'checked';}?> value="1">
                                                    </div>
                                                    <span class="red1"><?php echo form_error('route_map_status'); ?></span>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <div class="controls">
                                                    <input id="social_media" name="social_media" class="focustip span12" type="text" value="<?php echo $edit_data['social_media']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> required>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/social_media" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('social_media'); ?></span>

                                                <div class="controls">
                                                    <label class="control-label"><?php echo $admin_static_links['page_section_status']['front']; ?></label>
                                                    <div class="controls">
                                                        <input id="social_media_status" name="social_media_status"  type="checkbox" <?php if($edit_data['social_media_status'] == 1){echo 'checked';}?> value="1">
                                                    </div>
                                                    <span class="red1"><?php echo form_error('social_media_status'); ?></span>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <div class="controls">
                                                    <input id="products" name="products" class="focustip span12" type="text" value="<?php echo $edit_data['products']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> required>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/products" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('products'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['datetimer_section_status']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['datetimer_section_status']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/datetimer_section_status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/datetimer_section_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="datetimer_section_status" name="datetimer_section_status"  type="checkbox" <?php if($edit_data['datetimer_section_status'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('datetimer_section_status'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['instruction_section_status']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['instruction_section_status']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/instruction_section_status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/instruction_section_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="instruction_section_status" name="instruction_section_status"  type="checkbox" <?php if($edit_data['instruction_section_status'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('instruction_section_status'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['shipping_section_status']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['shipping_section_status']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/shipping_section_status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/shipping_section_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="shipping_section_status" name="shipping_section_status"  type="checkbox" <?php if($edit_data['shipping_section_status'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('shipping_section_status'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['poweredby_section_status']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['poweredby_section_status']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/poweredby_section_status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/poweredby_section_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="poweredby_section_status" name="poweredby_section_status"  type="checkbox" <?php if($edit_data['poweredby_section_status'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('poweredby_section_status'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['footer_email_status']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['footer_email_status']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/footer_email_status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/footer_email_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="footer_email_status" name="footer_email_status"  type="checkbox" <?php if($edit_data['footer_email_status'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('footer_email_status'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['home_product_heading_status']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['home_product_heading_status']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/home_product_heading_status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/home_product_heading_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="home_product_heading_status" name="home_product_heading_status"  type="checkbox" <?php if($edit_data['home_product_heading_status'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('home_product_heading_status'); ?></span>
                                            </div>

                                            <div class="control-group displaynon">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['invoice_download_btn_status']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['invoice_download_btn_status']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/invoice_download_btn_status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/invoice_download_btn_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="invoice_download_btn_status" name="invoice_download_btn_status"  type="checkbox" <?php if($edit_data['invoice_download_btn_status'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('invoice_download_btn_status'); ?></span>
                                            </div>

                                            <div class="control-group displaynon">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['package_download_btn_status']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['package_download_btn_status']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/package_download_btn_status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/package_download_btn_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="package_download_btn_status" name="package_download_btn_status"  type="checkbox" <?php if($edit_data['package_download_btn_status'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('package_download_btn_status'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['invoice_print_btn_status']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['invoice_print_btn_status']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/invoice_print_btn_status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/invoice_print_btn_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="invoice_print_btn_status" name="invoice_print_btn_status"  type="checkbox" <?php if($edit_data['invoice_print_btn_status'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('invoice_print_btn_status'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['next_btn_user_msg_status']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['next_btn_user_msg_status']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/next_btn_user_msg_status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/next_btn_user_msg_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="next_btn_user_msg_status" name="next_btn_user_msg_status"  type="checkbox" <?php if($edit_data['next_btn_user_msg_status'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('next_btn_user_msg_status'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['payment_accept_section_status']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['payment_accept_section_status']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/payment_accept_section_status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/payment_accept_section_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="payment_accept_section_status" name="payment_accept_section_status"  type="checkbox" <?php if($edit_data['payment_accept_section_status'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('payment_accept_section_status'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['instagram_feed_status']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['instagram_feed_status']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/instagram_feed_status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/instagram_feed_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="instagram_feed_status" name="instagram_feed_status"  type="checkbox" <?php if($edit_data['instagram_feed_status'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('instagram_feed_status'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['header_search_status']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['header_search_status']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/header_search_status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/header_search_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="header_search_status" name="header_search_status"  type="checkbox" <?php if($edit_data['header_search_status'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('header_search_status'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['header_quick_search_status']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['header_quick_search_status']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/header_quick_search_status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/header_quick_search_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="header_quick_search_status" name="header_quick_search_status"  type="checkbox" <?php if($edit_data['header_quick_search_status'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('header_quick_search_status'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['quick_search_hide_category']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['quick_search_hide_category']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/quick_search_hide_category'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/quick_search_hide_category/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="quick_search_hide_category" name="quick_search_hide_category"  type="checkbox" <?php if($edit_data['quick_search_hide_category'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('quick_search_hide_category'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['show_home_page']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['show_home_page']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/show_home_page'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/show_home_page/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <div class="radio">
                                                        <label><input type="radio" name="show_home_page" class="show_home_page" <?php if($edit_data['show_home_page'] == '1'){echo 'checked';}?> value="1"><?= $admin_products['display_kondarsoft_yes']['front']; ?></label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="show_home_page" class="show_home_page" <?php if($edit_data['show_home_page'] == '0'){echo 'checked';}?> value="0"><?= $admin_products['display_kondarsoft_no']['front']; ?></label>
                                                    </div>
                                                </div>
                                                <span class="red1"><?php echo form_error('show_home_page'); ?></span>
                                            </div>

                                            <div class="control-group" id="page_url_section" style="display: <?php if($edit_data['show_home_page'] == '0'){ echo 'block';}else{ echo 'none';} ?>">
                                                <div class="controls">
                                                    <input id="page_url" name="page_url" class="focustip span12" type="url" value="<?php echo $edit_data['page_url']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> <?php if($edit_data['show_home_page'] == '0'){ echo 'required';}else{ echo '';} ?> placeholder="http://abc.com">
                                                    <!-- <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/page_url" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a> -->
                                                </div>
                                                <span class="red1"><?php echo form_error('page_url'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['default_quick_search']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['default_quick_search']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/default_quick_search'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/default_quick_search/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <div class="radio">
                                                        <label><input type="radio" name="default_quick_search" <?php if($edit_data['default_quick_search'] == 'category'){echo 'checked';}?> value="category"><?= $general_instruction['vehicle_type_label']['front']; ?> / <?= $general_instruction['brand_type_label']['front']; ?></label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="default_quick_search" <?php if($edit_data['default_quick_search'] == 'product-group'){echo 'checked';}?> value="product-group"><?= $general_instruction['product_type_label']['front']; ?></label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="default_quick_search" <?php if($edit_data['default_quick_search'] == 'industry-type'){echo 'checked';}?> value="industry-type"><?= $general_instruction['industry_type_label']['front']; ?></label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="default_quick_search" <?php if($edit_data['default_quick_search'] == "product-list" ){echo 'checked';}?> value="product-list" ><?= $general_instruction['search_product_by_product']['front']; ?></label>
                                                    </div>
                                                </div>
                                                <span class="red1"><?php echo form_error('default_quick_search'); ?></span>
                                            </div>

                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>

                            <?php
                        } 
                        /* This is section of SEO Module added by SUJAN MAHARJAN */
                        /**##################################################### */
                        else if ($edit_page == 'seo_module') {
                            //echo '<pre>';
                            //print_r($admin_edit_welcomepage);
                            ?>
                            
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="seo_module" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5><?php echo $admin_edit_welcomepage['seo_module']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['seo_module']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/seo_module'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/seo_module/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global-warming.png" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>                                          
                                                       

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['seo_meta_desc']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['seo_meta_desc']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/seo_meta_desc'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/seo_meta_desc/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global-warming.png" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                   
                                                <textarea id="seo_meta_desc" name="seo_meta_desc" rows="5" cols="50"><?php echo $edit_data['seo_meta_desc'];?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/seo_meta_desc" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>    
                                            </div>
                                                <span class="red1"><?php echo form_error('datetimer_section_status'); ?></span>
                                            </div>    
                                            
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['seo_meta_keywords']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['seo_meta_keywords']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/seo_meta_keywords'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/seo_meta_keywords/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global-warming.png" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                   
                                                <textarea id="seo_meta_keywords" name="seo_meta_keywords" rows="5" cols="50"><?php echo $edit_data['seo_meta_keywords'];?></textarea>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/seo_meta_keywords" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>   
                                                </div>
                                                <span class="red1"><?php echo form_error('datetimer_section_status'); ?></span>
                                            </div> 

                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>

                            <?php
                        }
                        /**##################################################### */
                        /* End section of SEO Module added by SUjan Maharjan.    */
                        else if ($edit_page == 'home_page_instagram_feed') {
                            ?>
                            
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="home_page_instagram_feed" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5><?php echo $admin_edit_welcomepage['home_page_instagram_feed']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['home_page_instagram_feed']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/home_page_instagram_feed'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/home_page_instagram_feed/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>

                                            <?php $feeds = $edit_data['home_page_instagram_feed'] ? unserialize($edit_data['home_page_instagram_feed']) : array();?>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $general_instruction['intagram_image_label']['front']; ?></label>
                                                
                                                <div class="controls">
                                                    <?php
                                                    
                                                    if (isset($feeds[0]['image']) && $feeds[0]['image'] != '' && file_exists('assets/uploads/home_instagram/thumbnails/' . $feeds[0]['image'])) {
                                                        $insta_image = 'assets/uploads/home_instagram/thumbnails/' . $feeds[0]['image'];
                                                    } else {
                                                        $insta_image = $noimage;
                                                    }
                                                    ?>
                                                    <img src="<?php echo $insta_image; ?>" height="100" width="100"/>
                                                    <input type="hidden" name="insta_image_0" id="insta_image_0" value="<?php echo $feeds[0]['image']; ?>">
                                                </div>
                                                <div class="controls"><input type="file" name="insta_file_0"/></div>
                                                <div class="controls"><span class="red1"><?php echo $admin_static_links['attach_product_section_image_resolution']['front']; ?></span></div>

                                                <label class="control-label"><?php echo $general_instruction['intagram_post_url_label']['front']; ?></label>
                                                
                                                <div class="controls"><input type="text" class="focustip span12" name="insta_url_0" value="<?php echo $feeds[0]['url'];?>" /></div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $general_instruction['intagram_image_label']['front']; ?></label>
                                                
                                                <div class="controls">
                                                    <?php 
                                                    if (isset($feeds[1]['image']) && $feeds[1]['image'] != '' && file_exists('assets/uploads/home_instagram/thumbnails/' . $feeds[1]['image'])) {
                                                        $insta_image = 'assets/uploads/home_instagram/thumbnails/' . $feeds[1]['image'];
                                                    } else {
                                                        $insta_image = $noimage;
                                                    }
                                                    ?>
                                                    <img src="<?php echo $insta_image; ?>" height="100" width="100"/>
                                                    <input type="hidden" name="insta_image_1" id="insta_image_1" value="<?php echo $feeds[1]['image']; ?>">
                                                </div>
                                                <div class="controls"><input type="file" name="insta_file_1"/></div>
                                                <div class="controls"><span class="red1"><?php echo $admin_static_links['attach_product_section_image_resolution']['front']; ?></span></div>

                                                <label class="control-label"><?php echo $general_instruction['intagram_post_url_label']['front']; ?></label>
                                                
                                                <div class="controls"><input type="text" class="focustip span12" name="insta_url_1" value="<?php echo $feeds[1]['url'];?>" /></div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $general_instruction['intagram_image_label']['front']; ?></label>
                                                
                                                <div class="controls">
                                                    <?php 
                                                    if (isset($feeds[2]['image']) && $feeds[2]['image'] != '' && file_exists('assets/uploads/home_instagram/thumbnails/' . $feeds[2]['image'])) {
                                                        $insta_image = 'assets/uploads/home_instagram/thumbnails/' . $feeds[2]['image'];
                                                    } else {
                                                        $insta_image = $noimage;
                                                    }
                                                    ?>
                                                    <img src="<?php echo $insta_image; ?>" height="100" width="100"/>
                                                    <input type="hidden" name="insta_image_2" id="insta_image_2" value="<?php echo $feeds[2]['image']; ?>">
                                                </div>
                                                <div class="controls"><input type="file" name="insta_file_2"/></div>
                                                <div class="controls"><span class="red1"><?php echo $admin_static_links['attach_product_section_image_resolution']['front']; ?></span></div>

                                                <label class="control-label"><?php echo $general_instruction['intagram_post_url_label']['front']; ?></label>
                                                
                                                <div class="controls"><input type="text" class="focustip span12" name="insta_url_2" value="<?php echo $feeds[2]['url'];?>" /></div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $general_instruction['intagram_image_label']['front']; ?></label>
                                                
                                                <div class="controls">
                                                    <?php 
                                                    if (isset($feeds[3]['image']) && $feeds[3]['image'] != '' && file_exists('assets/uploads/home_instagram/thumbnails/' . $feeds[3]['image'])) {
                                                        $insta_image = 'assets/uploads/home_instagram/thumbnails/' . $feeds[3]['image'];
                                                    } else {
                                                        $insta_image = $noimage;
                                                    }
                                                    ?>
                                                    <img src="<?php echo $insta_image; ?>" height="100" width="100"/>
                                                    <input type="hidden" name="insta_image_3" id="insta_image_3" value="<?php echo $feeds[3]['image']; ?>">
                                                </div>
                                                <div class="controls"><input type="file" name="insta_file_3"/></div>
                                                <div class="controls"><span class="red1"><?php echo $admin_static_links['attach_product_section_image_resolution']['front']; ?></span></div>

                                                <label class="control-label"><?php echo $general_instruction['intagram_post_url_label']['front']; ?></label>
                                                
                                                <div class="controls"><input type="text" class="focustip span12" name="insta_url_3" value="<?php echo $feeds[3]['url'];?>" /></div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $general_instruction['intagram_image_label']['front']; ?></label>
                                                
                                                <div class="controls">
                                                    <?php 
                                                    if (isset($feeds[4]['image']) && $feeds[4]['image'] != '' && file_exists('assets/uploads/home_instagram/thumbnails/' . $feeds[4]['image'])) {
                                                        $insta_image = 'assets/uploads/home_instagram/thumbnails/' . $feeds[4]['image'];
                                                    } else {
                                                        $insta_image = $noimage;
                                                    }
                                                    ?>
                                                    <img src="<?php echo $insta_image; ?>" height="100" width="100"/>
                                                    <input type="hidden" name="insta_image_4" id="insta_image_4" value="<?php echo $feeds[4]['image']; ?>">
                                                </div>
                                                <div class="controls"><input type="file" name="insta_file_4"/></div>
                                                <div class="controls"><span class="red1"><?php echo $admin_static_links['attach_product_section_image_resolution']['front']; ?></span></div>

                                                <label class="control-label"><?php echo $general_instruction['intagram_post_url_label']['front']; ?></label>
                                                
                                                <div class="controls"><input type="text" class="focustip span12" name="insta_url_4" value="<?php echo $feeds[4]['url'];?>" /></div>
                                            </div>

                                            
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>

                            <?php
                        } else if ($edit_page == 'globe') {
                            ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="globe" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5> <?php echo $admin_edit_welcomepage['globe']['admin'] ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['globe']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/globe'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/globe/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['globe_photo']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['globe_photo']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/globe_photo'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/globe_photo/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls"><input type="file" name="file"/></div>
                                            </div>

                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>


                                        </div>

                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>

                            <?php
                        } else if ($edit_page == 'logo') {
                            ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="logo" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5><?php echo $admin_edit_welcomepage['logo']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['logo']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/logo'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/logo/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['logo_url']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['logo_url']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/logo_url'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/logo_url/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title2" name="logo_url" class="focustip span12" type="text" value="<?php echo $edit_data['logo_url']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/logo_url" class="fancybox multi_language_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('logo_url'); ?></span>
                                            </div>
                                            
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['logo_name']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['logo_name']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/logo_name'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/logo_name/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title2" name="title" class="focustip span12" type="text" value="<?php echo $edit_data['name']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/name" class="fancybox multi_language_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                                <span class="red1"><?php echo form_error('title'); ?></span>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['logo_image']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['logo_image']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/logo_image'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/logo_image/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls"><input type="file" name="file"/></div>
                                                
                                                <div class="controls"><span class="red1"><?php echo $admin_static_links['attach_image_resolution_logo']['front']; ?></span></div>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_static_links['attach_image_resolution_logo']['front']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_static_links/attach_image_resolution_logo'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_static_links_country/attach_image_resolution_logo/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['header_logo_status']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['header_logo_status']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/header_logo_status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title/header_logo_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="header_logo_status" name="header_logo_status"  type="checkbox" <?php if($edit_data['header_logo_status'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('header_logo_status'); ?></span>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['left_logo_status']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['left_logo_status']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/left_logo_status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title/left_logo_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="left_logo_status" name="left_logo_status"  type="checkbox" <?php if($edit_data['left_logo_status'] == 1){echo 'checked';}?> value="1">
                                                </div>
                                                <span class="red1"><?php echo form_error('left_logo_status'); ?></span>
                                            </div>



                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>


                                        </div>

                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>

                            <?php
                        } else if ($edit_page == 'fevicon') {
                            ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="fevicon" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5><?php echo $admin_edit_welcomepage['fevicon']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['fevicon']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/fevicon'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/fevicon/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['fevicon_image']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['fevicon_image']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/fevicon_image'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/fevicon_image/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls"><input type="file" name="file"/></div>
                                                <div class="controls"><span class="red1"><?php echo $admin_static_links['attach_image_resolution_fevicon']['front']; ?></span></div>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_static_links['attach_image_resolution_fevicon']['front']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_static_links/attach_image_resolution_fevicon'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_static_links_country/attach_image_resolution_fevicon/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>

                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>


                                        </div>

                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>

                            <?php
                        } else if ($edit_page == 'footer_name') {
                            ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="footer_name" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5><?php echo $admin_edit_welcomepage['footer']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['footer']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/footer'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/footer/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['footer_name']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['footer_name']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/footer_name'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/footer_name/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title2" name="title" class="focustip span12" type="text"
                                                           value="<?php echo $edit_data['footer_name']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/footer_name" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a></div>
                                                <span class="red1"><?php echo form_error('title'); ?></span>
                                            </div>
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>

                            <?php
                        } else if ($edit_page == 'copyright') {
                            ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="copyright" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5><?php echo $admin_edit_welcomepage['copyright']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['copyright']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/copyright'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/copyright/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                               
						<div class="controls">
                                                    <textarea id="copyright_editor" name="copyright" class="ckeditor5 focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                    <?php echo $edit_data['copyright']; ?> </textarea>
                                                    <!--input id="title2" name="copyright" class="focustip span12" type="text"
                                                           value="<?php echo $edit_data['copyright']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> -->
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/copyright/textarea/editor" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a></div>
                                                <span class="red1"><?php echo form_error('copyright'); ?></span>
                                            </div>
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>

                            <?php
                        } else if ($edit_page == 'footer') {
                            ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="footer" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5> <?php echo $admin_edit_welcomepage['footer_photo']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['footer_photo']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/footer_photo'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/footer_photo/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['footer_photo_text']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['footer_photo_text']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/footer_photo_text'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/footer_photo_text/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls"><input type="file" name="file" required/></div>
                                                <div class="controls"><span class="red1"><?php echo $admin_static_links['attach_image_resolution_footer']['front']; ?></span></div>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_static_links['attach_image_resolution_footer']['front']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_static_links/attach_image_resolution_footer'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_static_links_country/attach_image_resolution_footer/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>

                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>


                                        </div>

                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>

                        <?php }  else if ($edit_page == 'cart_photo') { ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="cart_photo" value="set"/>

                                <div class="row-fluid">
                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner">
                                                    <h5> <?php echo $admin_edit_welcomepage['cart_image']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['cart_image']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/cart_image'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/cart_image/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['cart_photo']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['cart_photo']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/cart_photo'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/cart_photo/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input type="file" name="file" required />
                                                    <span>Allowed Types : <b>'gif|jpg|png'</b> -  Dimensions : <b>(Max of 2000X2000)</b></span>
                                                </div>
                                                <div class="form-actions align-right">
                                                    <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /time pickers -->
                                    </div>
                                    <!-- /column -->
                            </form>
                        <?php }  else if ($edit_page == 'product_type_img') { ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="product_type_img" value="set"/>

                                <div class="row-fluid">
                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner">
                                                    <h5> <?php echo $admin_edit_welcomepage['product_type_img_title']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['product_type_img_title']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/product_type_img_title'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/product_type_img_title/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['product_type_img']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['product_type_img']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/product_type_img'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/product_type_img/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input type="file" name="file" required />
                                                    <span>Allowed Types : <b>'gif|jpg|png|jpeg'</b> -  Dimensions : <b>(Max of 2000X2000)</b></span>
                                                </div>
                                                <div class="form-actions align-right">
                                                    <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /time pickers -->
                                    </div>
                                    <!-- /column -->
                            </form>
                        <?php }  else if ($edit_page == 'vehicle_type_img') { ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="vehicle_type_img" value="set"/>

                                <div class="row-fluid">
                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner">
                                                    <h5> <?php echo $admin_edit_welcomepage['vehicle_type_img_title']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['vehicle_type_img_title']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/vehicle_type_img_title'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/vehicle_type_img_title/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['vehicle_type_img']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['vehicle_type_img']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/vehicle_type_img'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/vehicle_type_img/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input type="file" name="file" required />
                                                    <span>Allowed Types : <b>'gif|jpg|png|jpeg'</b> -  Dimensions : <b>(Max of 2000X2000)</b></span>
                                                </div>
                                                <div class="form-actions align-right">
                                                    <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /time pickers -->
                                    </div>
                                    <!-- /column -->
                            </form>
                        <?php }  else if ($edit_page == 'common_loader_img') { ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="common_loader_img" value="set"/>

                                <div class="row-fluid">
                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner">
                                                    <h5> <?php echo $admin_edit_welcomepage['common_loader_img_title']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['common_loader_img_title']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/common_loader_img_title'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/common_loader_img_title/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['common_loader_img']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['common_loader_img']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/common_loader_img'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/common_loader_img/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input type="file" name="file" required />
                                                    <span>Allowed Types : <b>'gif|jpg|png|jpeg'</b> -  Dimensions : <b>(Max of 2000X2000)</b></span>
                                                </div>
                                                <div class="form-actions align-right">
                                                    <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /time pickers -->
                                    </div>
                                    <!-- /column -->
                            </form>
                        <?php }  else if ($edit_page == 'cookie_popup') { ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="cookie_popup" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5><?php echo $admin_edit_welcomepage['cookie_popup']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['cookie_popup']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/cookie_popup'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/cookie_popup/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                               <label class="control-label"><?php echo $admin_edit_welcomepage['cookie_yesno']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['cookie_yesno']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/cookie_yesno'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/cookie_yesno/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input type="radio" name="cookie_yesno" value="1" <?php if($edit_data['cookie_yesno'] == '1') { echo "checked=checked"; } ?>> <?php echo $admin_static_links['yes_text']['front']; ?>
                                                    <input type="radio" name="cookie_yesno" value="0" <?php if($edit_data['cookie_yesno'] == '0') { echo "checked=checked"; } ?>> <?php echo $admin_static_links['no_text']['front']; ?>
                                                   </div>
                                                <span class="red1"><?php echo form_error('cookie_yesno'); ?></span>
                                            </div>
                                            <div class="control-group">
                                               <label class="control-label"><?php echo $admin_edit_welcomepage['cookie_title']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['cookie_title']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/cookie_title'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/cookie_title/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title2" name="cookie_title" class="focustip span12" type="text"
                                                           value="<?php echo $edit_data['cookie_title']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/cookie_title" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a></div>
                                                <span class="red1"><?php echo form_error('cookie_title'); ?></span>
                                            </div>
                                            <div class="control-group">
                                               <label class="control-label"><?php echo $admin_edit_welcomepage['cookie_description']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['cookie_description']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/cookie_description'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/cookie_description/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title2" name="cookie_description" class="focustip span12" type="text"
                                                           value="<?php echo $edit_data['cookie_description']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/home_page_country/cookie_description" class="fancybox multi_language_edit">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a></div>
                                                <span class="red1"><?php echo form_error('cookie_description'); ?></span>
                                            </div>
                                            <div class="control-group">
                                               <label class="control-label"><?php echo $admin_edit_welcomepage['cookie_page']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['cookie_page']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/cookie_page'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/cookie_page/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                
                                                <input id="title2" name="cookie_page" class="focustip span12" type="text" value="<?php echo $edit_data['cookie_page']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('cookie_page'); ?></span>
                                            </div>
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>

                            <?php
                        } else if ($edit_page == 'front_colors') {
                            ?>
                            <form class="form-horizontal" method="post">
                                <input type="hidden" name="front_colors" value="set"/>

                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner"><h5><?php echo $admin_edit_welcomepage['front_colors']['admin']; ?></h5>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage['front_colors']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/front_colors'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/front_colors/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['date_time_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['date_time_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/date_time_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/date_time_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title1" name="date_time_color" data-jscolor="{required:false, format:'rgba'}" class="focustip span12" type="text" value="<?php echo $edit_data['date_time_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('date_time_color'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['breadcrumb_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['breadcrumb_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/breadcrumb_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/breadcrumb_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls"><input id="title2" name="breadcrumb_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['breadcrumb_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>></div>
                                                <span class="red1"><?php echo form_error('breadcrumb_color'); ?></span>

                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['username_runningtime_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['username_runningtime_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/username_runningtime_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/username_runningtime_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="username_runningtime_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['username_runningtime_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('username_runningtime_color'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['select_category_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['select_category_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/select_category_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/select_category_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="select_category_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['select_category_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('select_category_color'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['select_category_color_text']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['select_category_color_text']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/select_category_color_text'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/select_category_color_text/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="select_category_color_text" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['select_category_color_text']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('select_category_color_text'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['select_background_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['select_background_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/select_background_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/select_background_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="select_background_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['select_background_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('select_background_color'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['heder_background_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['heder_background_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/heder_background_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/heder_background_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="heder_background_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['heder_background_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('heder_background_color'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['header_menu_text_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['header_menu_text_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/header_menu_text_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/header_menu_text_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="header_menu_text_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['header_menu_text_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('header_menu_text_color'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['header_menu_text_hover_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['header_menu_text_hover_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/header_menu_text_hover_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/header_menu_text_hover_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="header_menu_text_hover_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['header_menu_text_hover_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('header_menu_text_hover_color'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['search_input_background_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['search_input_background_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/search_input_background_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/search_input_background_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="search_input_background_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['search_input_background_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('search_input_background_color'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['search_input_text_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['search_input_text_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/search_input_text_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/search_input_text_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="search_input_text_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['search_input_text_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('search_input_text_color'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['search_result_background_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['search_result_background_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/search_result_background_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/search_result_background_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="search_result_background_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['search_result_background_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('search_result_background_color'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['search_result_text_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['search_result_text_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/search_result_text_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/search_result_text_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="search_result_text_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['search_result_text_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('search_result_text_color'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['footer_background_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['footer_background_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/footer_background_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/footer_background_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="footer_background_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['footer_background_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('footer_background_color'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['footer_text_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['footer_text_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/footer_text_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/footer_text_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="footer_text_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['footer_text_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('footer_text_color'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['product_action_btn_bg_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['product_action_btn_bg_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/product_action_btn_bg_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/product_action_btn_bg_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="product_action_btn_bg_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['product_action_btn_bg_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('product_action_btn_bg_color'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['product_action_btn_text_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['product_action_btn_text_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/product_action_btn_text_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/product_action_btn_text_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="product_action_btn_text_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['product_action_btn_text_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('product_action_btn_text_color'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['product_border_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['product_border_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/product_border_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/product_border_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="product_border_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['product_border_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('product_border_color'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['langdropdown_txt_color']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['langdropdown_txt_color']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/langdropdown_txt_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/langdropdown_txt_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="langdropdown_txt_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['langdropdown_txt_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('langdropdown_txt_color'); ?></span>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['langdropdown_bg_color']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['langdropdown_bg_color']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/langdropdown_bg_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/langdropdown_bg_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="langdropdown_bg_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['langdropdown_bg_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('langdropdown_bg_color'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['langdropdownhead_bg_color']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['langdropdownhead_bg_color']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/langdropdownhead_bg_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/langdropdownhead_bg_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="langdropdownhead_bg_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['langdropdownhead_bg_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('langdropdownhead_bg_color'); ?></span>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['langdropdownhead_txt_color']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['langdropdownhead_txt_color']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/langdropdownhead_txt_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/langdropdownhead_txt_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="langdropdownhead_txt_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['langdropdownhead_txt_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('langdropdownhead_txt_color'); ?></span>
                                            </div>



                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['category_label_txt_color']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['category_label_txt_color']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/category_label_txt_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/category_label_txt_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="category_label_txt_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['category_label_txt_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('category_label_txt_color'); ?></span>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['popup_txt_color']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['popup_txt_color']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/popup_txt_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/popup_txt_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="popup_txt_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['popup_txt_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('popup_txt_color'); ?></span>
                                            </div>




                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['popup_bg_color']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['popup_bg_color']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/popup_bg_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/popup_bg_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="popup_bg_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['popup_bg_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('popup_bg_color'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['popup_btn_bg_color']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['popup_btn_bg_color']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/popup_btn_bg_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/popup_btn_bg_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="popup_btn_bg_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['popup_btn_bg_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('popup_btn_bg_color'); ?></span>
                                            </div>



                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['popup_btn_txt_color']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['popup_btn_txt_color']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/popup_btn_txt_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/popup_btn_txt_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="popup_btn_txt_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['popup_btn_txt_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('popup_btn_txt_color'); ?></span>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['cart_productdisp_txt_color']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['cart_productdisp_txt_color']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/cart_productdisp_txt_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/cart_productdisp_txt_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="cart_productdisp_txt_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['cart_productdisp_txt_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('cart_productdisp_txt_color'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['inner_bg_color']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['inner_bg_color']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/inner_bg_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/inner_bg_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="inner_bg_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['inner_bg_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('inner_bg_color'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['cart_table_bgcolor']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['cart_table_bgcolor']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/cart_table_bgcolor'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/cart_table_bgcolor/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="cart_table_bgcolor" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['cart_table_bgcolor']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('cart_table_bgcolor'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['cart_table_tr_bg_color']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['cart_table_tr_bg_color']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/cart_table_tr_bg_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/cart_table_tr_bg_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="cart_table_tr_bg_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['cart_table_tr_bg_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('cart_table_tr_bg_color'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['cart_outstock_color']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['cart_outstock_color']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/cart_outstock_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/cart_outstock_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="cart_outstock_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['cart_outstock_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('cart_outstock_color'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['cart_instock_color']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['cart_instock_color']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/cart_instock_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/cart_instock_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="cart_instock_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['cart_instock_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('cart_instock_color'); ?></span>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_page_title['input_label_color']['admin'] ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_page_title['input_label_color']['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/input_label_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/input_label_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="input_label_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['input_label_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('input_label_color'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['try_captcha_text_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['try_captcha_text_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/try_captcha_text_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/try_captcha_text_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="try_captcha_text_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['try_captcha_text_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('try_captcha_text_color'); ?></span>
                                            </div>



                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['cart_table_txtcolor']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['cart_table_txtcolor']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/cart_table_txtcolor'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/cart_table_txtcolor/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="cart_table_txtcolor" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['cart_table_txtcolor']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('cart_table_txtcolor'); ?></span>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['product_box_txt_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['product_box_txt_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/product_box_txt_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/product_box_txt_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="product_box_txt_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['product_box_txt_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('product_box_txt_color'); ?></span>
                                            </div>



                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['validation_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['validation_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/validation_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/validation_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="validation_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['validation_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('validation_color'); ?></span>
                                                </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['progress_bar_bg_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['progress_bar_bg_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/progress_bar_bg_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/progress_bar_bg_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="progress_bar_bg_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['progress_bar_bg_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('progress_bar_bg_color'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['progress_bar_text_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['progress_bar_text_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/progress_bar_text_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/progress_bar_text_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="progress_bar_text_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['progress_bar_text_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('progress_bar_text_color'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['payment_success_text_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['payment_success_text_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/payment_success_text_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/payment_success_text_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="payment_success_text_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['payment_success_text_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('payment_success_text_color'); ?></span>
                                            </div>



                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['input_border_txt_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['input_border_txt_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/input_border_txt_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/input_border_txt_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="input_border_txt_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['input_border_txt_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('input_border_txt_color'); ?></span>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['input_bg_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['input_bg_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/input_bg_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/input_bg_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title3" name="input_bg_color" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data['input_bg_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('input_bg_color'); ?></span>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['qs_search_shadow']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['qs_search_shadow']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/qs_search_shadow'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/qs_search_shadow/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title1" name="qs_search_shadow" data-jscolor="{required:false, format:'rgba'}" class="focustip span12" type="text" value="<?php echo $edit_data['qs_search_shadow']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('qs_search_shadow'); ?></span>
                                            </div>



                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['accordion_background_color']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['accordion_background_color']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/accordion_background_color'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/accordion_background_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title1" name="accordion_background_color" data-jscolor="{required:false, format:'rgba'}" class="focustip span12" type="text" value="<?php echo $edit_data['accordion_background_color']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('accordion_background_color'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['home_whats_color_shadow']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['home_whats_color_shadow']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/home_whats_color_shadow'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/home_whats_color_shadow/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title1" name="home_whats_color_shadow" data-jscolor="{required:false, format:'rgba'}" class="focustip span12" type="text" value="<?php echo $edit_data['home_whats_color_shadow']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('home_whats_color_shadow'); ?></span>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_edit_welcomepage['home_whats_new_section_background_shadow']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_edit_welcomepage['home_whats_new_section_background_shadow']['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/home_whats_new_section_background_shadow'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/home_whats_new_section_background_shadow/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title1" name="home_whats_new_section_background_shadow" data-jscolor="{required:false, format:'rgba'}" class="focustip span12" type="text" value="<?php echo $edit_data['home_whats_new_section_background_shadow']; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                </div>
                                                <span class="red1"><?php echo form_error('home_whats_new_section_background_shadow'); ?></span>
                                            </div>

                                            <?php $colorFields = array('selectall_bg_color','home_whats_new_section_background','home_heading','home_whats_color','pop_up_title_color','body_background_color','header_border_color','accordion_text_color','checkbox_checked_color','qs_search_label','qs_heading_color','qs_bg_color','qs_bottom_border_bg_color','qs_text_color','qs_btn_bg_color','qs_btn_text_color','qs_btn_hover_bg_color','qs_btn_hover_text_color','qs_select_bg_color','qs_select_text_color','qs_dd_bg_color','qs_dd_text_color','qs_dd_selected_bg_color','qs_dd_selected_text_color','search_by_text_color','selectall_text_color','payment_accept_text_bg_color','payment_accept_text_color', 'insta_gallery_bg_color','part_number_title_color','price_title_color','product_attr_title_color','product_model_title_color','Instock_detail_color','outstock_detail_color','addpricerequest_color','addpricerequest_active_color','cart_back_btn_color','cart_save_btn_color','cart_submit_btn_color','product_load_more_btn');
                                            foreach ($colorFields as $field) {?>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo $admin_edit_welcomepage[$field]['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_edit_welcomepage[$field]['admin']; ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_edit_welcomepage/'.$field; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_edit_welcomepage/<?= $field;?>/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                    <div class="controls">
                                                        <input id="title3" name="<?= $field;?>" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data[$field]; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                    </div>
                                                    <span class="red1"><?php echo form_error($field); ?></span>
                                                </div>
                                            <?php } ?>  

                                            <?php $colorFields = array('first_load_more_bg_color','first_load_more_text_color','second_load_more_bg_color','second_load_more_text_color','third_load_more_bg_color','third_load_more_text_color', 'entry_pop_login_text_color', 'entry_pop_btn_text_color', 'entry_pop_btn_bg_color', 'entry_pop_guest_text_color', 'entry_pop_guest_text_hover_color', 'entry_pop_permanent_text_color', 'entry_pop_apply_btn_text_color', 'entry_pop_apply_btn_bg_color', 'entry_pop_apply_btn_text_hover_color', 'entry_pop_border_color', 'common_loader_bg_color', 'common_loader_text_color','cart_back_btn_color','cart_save_btn_color','cart_submit_btn_color');

                                            foreach ($colorFields as $field) {?>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo $admin_page_title[$field]['admin'] ?></label>
                                                    <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_page_title[$field]['admin'] ?>"  class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_page_title/'.$field; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_page_title_country/<?= $field;?>/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                    <div class="controls">
                                                        <input id="title3" name="<?= $field;?>" class="focustip span12 jscolor" type="text" value="<?php echo $edit_data[$field]; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                    </div>
                                                    <span class="red1"><?php echo form_error($field); ?></span>
                                                </div>
                                            <?php } ?> 

                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /time pickers -->


                                </div>
                                <!-- /column -->

                            </form>

                            <?php
                        }
                        ?>


                    </div>

                    <!-- /pickers -->

                </div>
                <!-- /content container -->

            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script>
<?php if ($edit_page == 'cookie_popup' || $edit_page == 'home_product_section') { ?>
<script>
    $(document).ready(function () {
        CKEDITOR.replace('product_section_description', {
            height: 300
        });
        
        
    });
</script>
<?php } ?>
<script>
    $(document).ready(function () {
        CKEDITOR.replace('footer_address', {
            height: 300
        });
	CKEDITOR.replace('copyright_editor', {
            height: 300
        }); 
	
        CKEDITOR.replace('footer_payment_methods',{
            height: 300
        });     
    });
</script>
<?php if ($edit_page == 'home_page_headings') { ?>
<script>
    $('.show_home_page').click(function(){
            var value = $(this).val();
            if(value == 0){
                $('#page_url_section').show();
                $('#page_url').prop('required', true);
            }else{
                $('#page_url_section').hide();
                $('#page_url').prop('required', false);
            }
    });
</script>
<?php } ?>
