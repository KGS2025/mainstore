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

    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <div class="body">
                    <div class="container">
                        <form id="socialMediaForm" name="socialMediaForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set"/>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo isset($edit_data) ? $admin_pages['edit_page']['admin'] : $admin_pages['edit_page']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_pages['edit_page']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_social_media/edit_page'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_social_media/edit_page/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_pages['social_media_image']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_pages['social_media_image']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData//admin_social_media/social_media_image'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_social_media/social_media_image/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <?php if(isset($edit_data['social_media_image']) && $edit_data['social_media_image']){?>
                                            <div class="controls" style="margin-bottom: 15px;">
                                                <img src="assets/uploads/social_media/<?php echo $edit_data['social_media_image']; ?>" class="img-responsive" height="50px" width="50px" />
                                            </div>
                                            <?php } ?>

                                            <div class="controls">
                                                <input type="file" name="social_media_image" id="social_media_image" />
                                            </div>

                                            <span class="red1"><?php echo form_error('social_media_image'); ?></span>
                                            <div class="controls">
                                                <label class="control-label red1"><?php echo $admin_pages['social_media_image_resolution']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_pages['social_media_image_resolution']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData//admin_social_media/social_media_image_resolution'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_social_media/social_media_image_resolution/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                            <input type="hidden" value="<?php echo isset($edit_data['social_media_image']) ? $edit_data['social_media_image'] : ''; ?>" name="hidden_social_media_image" id="hidden_social_media_image" class="edit_input_text">
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_pages['social_media_url']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_pages['social_media_url']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData//admin_social_media/social_media_url'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_social_media/social_media_url/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>
                                            <div class="controls">
                                                <input id="social_media_url" name="social_media_url" class="focustip span12" type="text" value="<?php echo isset($edit_data['social_media_url']) ? $edit_data['social_media_url'] : ''; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('social_media_url'); ?></span>
                                        </div>
                    
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_pages['status']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_pages['status']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData//admin_social_media/status'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_social_media/status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>
                                            <div class="controls">
                                                <input type="checkbox" name="status" value="1" <?php if (isset($edit_data['status']) && $edit_data['status'] == 1) { echo 'checked="checked"'; } ?> />
                                            </div>
                                            <span class="red1"><?php echo form_error('status'); ?></span>
                                        </div>

                                        <?php if ($addscripts == 'edit_social_media'){?>
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        <?php }else{ ?>
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_add']['front']; ?>" id="send" type="submit">
                                                <input class="btn btn-danger" type="reset" value="<?php echo $admin_static_links['reset']['front']; ?>">
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
