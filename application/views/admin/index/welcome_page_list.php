<div class="content zerorightmargin">
    <?php if ($this->session->flashdata('success')) {
        $msg = $this->session->flashdata('success'); ?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?>
            </div>
        </div>
    <?php } ?>

    <?php if ($this->session->flashdata('error')) {
        $msg = $this->session->flashdata('error'); ?>
        <div class="notice outer">
            <div class="error"><?php echo $msg; ?>
            </div>
        </div>
    <?php } ?>
    <?php $noimage = getNoImage('no_image'); ?>

    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <div class="body">
                    <div class="container">
                        <div class="block well margintop-30px">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <h5><i class="font-user"></i><?php echo $admin_setting['welcome_page_setting']['admin']; ?></h5>

                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                        <input type="text" value="<?php echo $admin_setting['welcome_page_setting']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting/welcome_page_setting'; ?>">

                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id;?>/multilangue/saveLanguageDataByCountry/admin_setting/welcome_page_setting/admin" class="fancybox multi_language_common_edit admin_globe">
                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                    </a>

                                </div>
                            </div>
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                    <table width="100%" aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">
                                        <thead>
                                            <tr role="row">
                                                <th colspan="1" rowspan="1" style="width:50%"></th>
                                                <th colspan="1" rowspan="1" style="width:30%"></th>
                                                <th colspan="1" rowspan="1" style="width:20%"></th>
                                            </tr>
                                        </thead>

                                        <tbody aria-relevant="all" aria-live="polite" role="alert">
                                            <?php
                                            if (isset($set_data)) { ?>
                                                <tr height="" class="odd">
                                                    <td><span class="FontLarge"><?php echo $admin_setting['fevicon']['admin']; ?></span>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_setting['fevicon']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//fevicon'; ?>">
                                                        <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/fevicon/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>

                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (isset($set_data['fevicon']) && $set_data['fevicon'] != '' && file_exists('assets/uploads/logo/thumbnails/' . $set_data['fevicon'])) {
                                                            $fevicon = 'assets/uploads/logo/thumbnails/' . $set_data['fevicon'];
                                                        } else {
                                                            $fevicon = $noimage;
                                                        }
                                                        ?>
                                                        <img src="<?php echo $fevicon; ?>" height="100" width="100"/>

                                                    </td>
                                                    <td>

                                                        <?php
                                                        if ($set_data['fevicon'] == '') {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/fevicon/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_update']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/fevicon/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_update']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/empty_data/fevicon/<?php echo $set_data['id']; ?>"
                                                                   onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                               <?php } ?>
                                                               <?php
                                                           }
                                                           ?>

                                                    </td>
                                                </tr>

                                                <tr height="" class="odd">
                                                    <td><span class="FontLarge"><?php echo $admin_setting['logo']['admin']; ?></span>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_setting['logo']['admin']?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//logo'; ?>">
                                                        <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/logo/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (isset($set_data['logo']) && $set_data['logo'] != '' && file_exists('assets/uploads/logo/thumbnails/' . $set_data['logo'])) {
                                                            $logo = 'assets/uploads/logo/thumbnails/' . $set_data['logo'];
                                                        } else {

                                                            $logo = $noimage;
                                                        }
                                                        ?>
                                                        <img src="<?php echo $logo; ?>" height="100" width="100"/>

                                                    </td>
                                                    <td>

                                                        <?php
                                                        if ($set_data['logo'] == '') {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/logo/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_update']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/logo/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_update']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/empty_data/logo/<?php echo $set_data['id']; ?>"
                                                                   onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                               <?php } ?>
                                                               <?php
                                                           }
                                                           ?>

                                                    </td>
                                                </tr>

                                            

                                                <tr height="120">
                                                    
                                                    <td>
                                                        <span class="FontLarge"><?php echo $admin_setting['footer_text']['admin']; ?></span>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_setting['footer_text']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//footer_text'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/footer_text/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    </td>
                                                    <td><?php echo $admin_static_links['footer_text_details']['front']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($set_data['footer_phone1'] == '' || $set_data['footer_phone2'] == '' || $set_data['footer_address'] == '') {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/footer_text/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/footer_text/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a style="display: none;" href="admin/<?php echo $lang_id; ?>/index/empty_data/footer_text/<?php echo $set_data['id']; ?>"
                                                                   onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                               <?php } ?>
                                                               <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                                <tr height="120">
                                                    <td><span class="FontLarge"><?php echo $admin_setting['footer_name']['admin']; ?></span>
                                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_setting['footer_name']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//footer_name'; ?>">
                                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/footer_name/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    </td>
                                                    <td><?php echo $set_data['footer_name']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($set_data['footer_name'] == '') {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/footer_name/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_add']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/footer_name/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
        <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/empty_data/footer_name/<?php echo $set_data['id']; ?>"
                                                                   onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                               <?php } ?>
                                                               <?php
                                                           }
                                                           ?>
                                                    </td>
                                                </tr>
                                                

                                                <tr height="">
                                                    <td><span class="FontLarge"><?php echo $admin_setting['inner_background_image']['admin']; ?></span>
    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_setting['inner_background_image']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//inner_background_image'; ?>">
    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/inner_background_image/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (isset($set_data['main_background_image']) && $set_data['main_background_image'] != '' && file_exists('assets/uploads/background/thumbnails/' . $set_data['main_background_image'])) {
                                                            $background = 'assets/uploads/background/thumbnails/' . $set_data['main_background_image'];
                                                        } else {
                                                            $background = $noimage;
                                                        }
                                                        ?>
                                                        <img src="<?php echo $background; ?>" height="100" width="100"/>

                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($set_data['main_background_image'] == '') {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/main_background/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_update']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/main_background/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_update']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
        <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/empty_data/main_background/<?php echo $set_data['id']; ?>"
                                                                   onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                               <?php } ?>
                                                               <?php
                                                           }
                                                           ?>
                                                    </td>
                                                </tr>

                                                <tr height="">
                                                    <td><span class="FontLarge"><?php echo $admin_setting['inner_page_footer_background_image']['admin'];?></span>
    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_setting['inner_page_footer_background_image']['admin'];?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//inner_page_footer_background_image'; ?>">
    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/inner_page_footer_background_image/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (isset($set_data['main_footer_background']) && $set_data['main_footer_background'] != '' && file_exists('assets/uploads/background/thumbnails/' . $set_data['main_footer_background'])) {
                                                            $background = 'assets/uploads/background/thumbnails/' . $set_data['main_footer_background'];
                                                        } else {
                                                            $background = $noimage;
                                                        }
                                                        ?>
                                                        <img src="<?php echo $background; ?>" height="100" width="100"/>

                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($set_data['main_footer_background'] == '') {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/main_footer_background/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_update']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/main_footer_background/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_update']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
        <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/empty_data/main_footer_background/<?php echo $set_data['id']; ?>"
                                                                   onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                               <?php } ?>
                                                               <?php
                                                           }
                                                           ?>
                                                    </td>
                                                </tr>

                                                <tr height="120">
                                                    <td><span class="FontLarge"><?php echo $admin_setting['cart_image']['admin'];?></span>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_setting['cart_image']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//cart_image'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/cart_image/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (isset($set_data['cart_photo']) && $set_data['cart_photo'] != '' && file_exists('assets/uploads/cart/' . $set_data['cart_photo'])) {
                                                            $footer = 'assets/uploads/cart/' . $set_data['cart_photo'];
                                                        } else {
                                                            $footer = $noimage;
                                                        } ?>
                                                        <img src="<?php echo $footer; ?>" height="100" width="100"/>
                                                    </td>
                                                    <td>
                                                        <?php if ($set_data['cart_photo'] == '') { ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/cart_photo/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_update']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/cart_photo/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_update']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/empty_data/cart_photo/<?php echo $set_data['id']; ?>" onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </td>
                                                </tr> 

                                                
                                                <tr height="120" style="display: none;">
                                                    <td><span class="FontLarge"><?php echo $admin_setting['social_media']['admin']; ?></span>
                                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_setting['social_media']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//social_media'; ?>">
                                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/social_media/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    </td>
                                                    <td><?php echo $admin_static_links['social_media_details']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($set_data['social_media_text'] == '' || $set_data['facebook'] == '' || $set_data['twitter'] == '' || $set_data['linkedin'] == '' || $set_data['youtube'] == '') {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/social_media/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_add']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/social_media/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a style="display: none;" href="admin/<?php echo $lang_id; ?>/index/empty_data/social_media/<?php echo $set_data['id']; ?>"
                                                                   onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                               <?php } ?>
                                                               <?php
                                                           }
                                                           ?>
                                                    </td>
                                                </tr>
                                                
                                                <tr height="120">
                                                    <td><span class="FontLarge"><?php echo $admin_setting['front_colors']['admin']; ?></span>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_setting['front_colors']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//front_colors'; ?>">
                                                        <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/front_colors/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    </td>
                                                    <td><?php echo $admin_static_links['front_colors_text']['front']; ?></td>
                                                    <td>
                                                        <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                            <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/front_colors/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                
                                                
                                                <tr height="120">
                                                    <td><span class="FontLarge"><?php echo $admin_setting['copyright']['admin']; ?></span>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
							    <input type="text" value="<?php echo $admin_setting['copyright']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//copyright'; ?>">
                                                        <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/copyright/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    </td>
                                                    <td><?php echo $set_data['copyright']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($set_data['copyright'] == '') {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/copyright/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_add']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/copyright/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/empty_data/copyright/<?php echo $set_data['id']; ?>"
                                                                   onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                               <?php } ?>
                                                               <?php
                                                           }
                                                           ?>
                                                    </td>
                                                </tr>
                                                
                                                
                                                <tr height="120" style="display: none;">
                                                    <td><span class="FontLarge"><?php echo $admin_setting['cookie_popup']['admin']; ?></span>
                                                            <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_setting['cookie_popup']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//cookie_popup'; ?>">
                                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/cookie_popup/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    </td>
                                                    <td><?php echo $set_data['cookie_title']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($set_data['cookie_title'] == '') {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/cookie_popup/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_add']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/cookie_popup/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                                <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a style="display: none;" href="admin/<?php echo $lang_id; ?>/index/empty_data/cookie_popup/<?php echo $set_data['id']; ?>"
                                                                   onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                               <?php } ?>
                                                               <?php
                                                           }
                                                           ?>
                                                    </td>
                                                </tr>

                                                <tr height="120">
                                                    
                                                    <td>
                                                        <span class="FontLarge"><?php echo $admin_setting['home_product_section']['admin']; ?></span>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_setting['home_product_section']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//home_product_section'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/home_product_section/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    </td>
                                                    <td><?php echo $admin_static_links['home_product_section_details']['front']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($set_data['product_section_head'] == '' || $set_data['product_section_title'] == '' || $set_data['product_section_image'] == '' || $set_data['product_section_description'] == '' || $set_data['production_section_button_text'] == '' || $set_data['product_section_button_url'] == '') {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/home_product_section/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_add']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/home_product_section/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a style="display: none;" href="admin/<?php echo $lang_id; ?>/index/empty_data/home_product_section/<?php echo $set_data['id']; ?>"
                                                                   onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                               <?php } ?>
                                                               <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                                <tr height="120">
                                                    
                                                    <td>
                                                        <span class="FontLarge"><?php echo $admin_setting['home_page_heading']['admin']; ?></span>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_setting['home_page_heading']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//home_page_heading'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/home_page_heading/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    </td>
                                                    <td><?php echo $admin_static_links['home_page_heading_details']['front']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($set_data['footer_phone1'] == '' || $set_data['footer_phone2'] == '' || $set_data['footer_address'] == '') {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/home_page_headings/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/home_page_headings/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a style="display: none;" href="admin/<?php echo $lang_id; ?>/index/empty_data/home_page_headings/<?php echo $set_data['id']; ?>"
                                                                   onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                               <?php } ?>
                                                               <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                                <tr height="120">
                                                    <td>
                                                        <span class="FontLarge"><?php echo $admin_setting['home_page_instagram_feed']['admin']; ?></span>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_setting['home_page_instagram_feed']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//home_page_instagram_feed'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/home_page_instagram_feed/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    </td>
                                                    <td><?php echo $admin_static_links['home_page_instagram_feed_details']['front']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($set_data['footer_phone1'] == '' || $set_data['footer_phone2'] == '' || $set_data['footer_address'] == '') {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/home_page_instagram_feed/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/home_page_instagram_feed/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a style="display: none;" href="admin/<?php echo $lang_id; ?>/index/empty_data/home_page_instagram_feed/<?php echo $set_data['id']; ?>"
                                                                   onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                               <?php } ?>
                                                               <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                                <tr height="120">
                                                    <td><span class="FontLarge"><?php echo $admin_setting['product_type_img']['admin'];?></span>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_setting['product_type_img']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//product_type_img'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/product_type_img/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (isset($set_data['product_type_img']) && $set_data['product_type_img'] != '' && file_exists('assets/uploads/vehicle_categories/' . $set_data['product_type_img'])) {
                                                            $footer = 'assets/uploads/vehicle_categories/' . $set_data['product_type_img'];
                                                        } else {
                                                            $footer = $noimage;
                                                        } ?>
                                                        <img src="<?php echo $footer; ?>" height="100" width="100"/>
                                                    </td>
                                                    <td>
                                                        <?php if ($set_data['product_type_img'] == '') { ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/product_type_img/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_update']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/product_type_img/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_update']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/empty_data/product_type_img/<?php echo $set_data['id']; ?>" onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </td>
                                                </tr>

                                                <tr height="120">
                                                    <td><span class="FontLarge"><?php echo $admin_setting['vehicle_type_img']['admin'];?></span>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_setting['vehicle_type_img']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//vehicle_type_img'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/vehicle_type_img/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (isset($set_data['vehicle_type_img']) && $set_data['vehicle_type_img'] != '' && file_exists('assets/uploads/vehicle_categories/' . $set_data['vehicle_type_img'])) {
                                                            $footer = 'assets/uploads/vehicle_categories/' . $set_data['vehicle_type_img'];
                                                        } else {
                                                            $footer = $noimage;
                                                        } ?>
                                                        <img src="<?php echo $footer; ?>" height="100" width="100"/>
                                                    </td>
                                                    <td>
                                                        <?php if ($set_data['vehicle_type_img'] == '') { ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/vehicle_type_img/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_update']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/vehicle_type_img/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_update']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/empty_data/vehicle_type_img/<?php echo $set_data['id']; ?>" onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </td>
                                                </tr>

                                                <tr height="120">
                                                    <td><span class="FontLarge"><?php echo $admin_setting['common_loader_img']['admin'];?></span>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_setting['common_loader_img']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//common_loader_img'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/common_loader_img/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (isset($set_data['common_loader_img']) && $set_data['common_loader_img'] != '' && file_exists('assets/uploads/' . $set_data['common_loader_img'])) {
                                                            $footer = 'assets/uploads/' . $set_data['common_loader_img'];
                                                        } else {
                                                            $footer = $noimage;
                                                        } ?>
                                                        <img src="<?php echo $footer; ?>" height="100" width="100"/>
                                                    </td>
                                                    <td>
                                                        <?php if ($set_data['common_loader_img'] == '') { ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/common_loader_img/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_update']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/common_loader_img/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_update']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/empty_data/common_loader_img/<?php echo $set_data['id']; ?>" onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </td>
                                                </tr>

                                                <!-- SEO Module script STARTS here , added by SUJAN MAHARJAN -->
                                                <tr>                                                        
                                                    <td>
                                                        <span class="FontLarge"><?php echo $admin_setting['seo_module']['admin']; ?></span>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_setting['seo_module']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_setting//seo_module'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_setting/seo_module/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global-warming.png" height="20" width="20" >
                                                        </a>
                                                    </td>
                                                    <td><?php echo $admin_static_links['seo_module_details']['front']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($set_data['footer_phone1'] == '' || $set_data['footer_phone2'] == '' || $set_data['footer_address'] == '') {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/seo_module/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/index/edit_welcome_page/seo_module/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a style="display: none;" href="admin/<?php echo $lang_id; ?>/index/empty_data/seo_module/<?php echo $set_data['id']; ?>"
                                                                   onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                               <?php } ?>
                                                               <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <!-- SEO Module script ENDS here , added by SUJAN MAHARJAN -->

                                                <?php
                                                
                                            }
                                            ?>



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /default datatable -->


                        <!-- Pickers -->
                    </div>

                    <!-- /pickers -->

                </div>

            </div>
        </div>
    </div>
    <!-- /content -->

    <!-- Right sidebar -->

    <!-- /right sidebar -->
</div>
<!-- /main wrapper -->
