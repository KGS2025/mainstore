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
                        <form id="editPage" name="editPage" class="form-horizontal" method="post" enctype="multipart/form-data">
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
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData//admin_whats_new/edit_page'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_whats_new/edit_page/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_pages['image']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_pages['image']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData//admin_whats_new/image'; ?>">
                                            <?php } ?>

                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_whats_new/image/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <?php if(isset($edit_data['image']) && $edit_data['image']){?>
                                            <div class="controls" style="margin-bottom: 15px;">
                                                <img src="assets/uploads/whats_new/<?php echo $edit_data['image'] ?>" class="img-responsive" height="100px" width="100px" />
                                            </div>
                                            <?php } ?>

                                            <div class="controls">
                                                <input type="file" name="image" id="image" />
                                            </div>

                                            <span class="red1"><?php echo form_error('big_head'); ?></span>

                                            <div class="controls">
                                                <label class="control-label red1"><?php echo $admin_pages['image_resolution']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_pages['image_resolution']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData//admin_whats_new/image_resolution'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_whats_new/image_resolution/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>

                                            <input type="hidden" value="<?php echo isset($edit_data['image']) ? $edit_data['image'] : ''; ?>" name="hidden_image" id="hidden_image" class="edit_input_text">
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_pages['heading']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_pages['heading']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData//admin_whats_new/heading'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_whats_new/heading/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>
                                            <div class="controls">
                                                <input id="heading" name="heading" class="focustip span12" type="text" value="<?php echo isset($edit_data['heading']) ? $edit_data['heading'] : ''; ?>">
                                                <?php if(isset($edit_data['id'])){?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $edit_data['id']; ?>/whats_new_country/heading" class="fancybox multi_language_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                <?php } ?>
                                            </div>
                                            <span class="red1"><?php echo form_error('heading'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_pages['url']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_pages['url']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData//admin_whats_new/url'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_whats_new/url/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>
                                            <div class="controls">
                                                <input id="url" name="url" class="focustip span12" type="text" value="<?php echo isset($edit_data['url']) ? $edit_data['url'] : ''; ?>">
                                                <?php if(isset($edit_data['id'])){?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $edit_data['id']; ?>/whats_new_country/url" class="fancybox multi_language_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                <?php } ?>
                                            </div>
                                            <span class="red1"><?php echo form_error('url'); ?></span>
                                        </div>
                    
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_pages['status']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_pages['status']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData//admin_whats_new/status'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_whats_new/status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>
                                            <div class="controls">
                                                <input type="checkbox" name="status" value="1" <?php if (isset($edit_data['status']) && $edit_data['status'] == 1) { echo 'checked="checked"'; } ?> />
                                            </div>
                                            <span class="red1"><?php echo form_error('status'); ?></span>
                                        </div>

                                        <?php if ($addscripts == 'edit_whats_new'){?>
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
