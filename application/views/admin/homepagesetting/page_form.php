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
                            <form id="pageForm" name="pageForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="operation" value="set"/>
                                <input type="hidden" id="pageId" value="<?= isset($edit_data['id']) ? $edit_data['id'] : '';?>"/>
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="block well">
                                            <div class="navbar">
                                                <div class="navbar-inner">
                                                    <h5>
                                                        <?php echo isset($edit_data) ? $admin_pages['edit_page']['admin'] : $admin_pages['add_page']['admin']; ?>
                                                    </h5>
                                                    <?php if ($lang_id == $primary_lang) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_pages['edit_page']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData//admin_pages/edit_page'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_pages/edit_page/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_pages['title']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_pages['title']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData//admin_pages/title'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_pages/title/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="title" name="title" class="focustip span12" type="text" value="<?php echo isset($edit_data['title']) ? $edit_data['title'] : ''; ?>">
                                                    <?php if(isset($edit_data['id'])){?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?= $edit_data['id'];?>/pages_country/title" class="fancybox multi_language_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                                <span class="red1"><?php echo form_error('title'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_pages['page_url']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_pages['page_url']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData//admin_pages/page_url'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_pages/page_url/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                <div class="controls">
                                                    <input id="page_url" name="page_url" class="focustip span12" type="text" value="<?php echo isset($edit_data['page_url']) ? $edit_data['page_url'] : ''; ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('page_url'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_pages['content']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_pages['content']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData//admin_pages/content'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_pages/content/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>

                                                <div class="controls">
                                                    <textarea id="ckeditor" name="content" class="ckeditor focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> ><?php echo isset($edit_data['content']) ? $edit_data['content'] : ''; ?></textarea>
                                                    <?php if(isset($edit_data['id'])){?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?= $edit_data['id'];?>/pages_country/content/textarea/editor" class="fancybox multi_language_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                                <span class="red1"><?php echo form_error('content'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_pages['status']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_pages['status']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData//admin_pages/status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_pages/status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" ></a>
                                                <div class="controls">
                                                    <input type="checkbox" name="status" value="1" <?php if (isset($edit_data['status']) && $edit_data['status'] == 1) { echo 'checked="checked"'; } ?> />
                                                </div>
                                                <span class="red1"><?php echo form_error('status'); ?></span>
                                            </div>

                                            <?php if ($addscripts == 'edit_pages'){?>
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
                            </div>
                        </form>
                        <script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script>
                        <script>
                            $(document).ready(function () {
                                CKEDITOR.replace('ckeditor', {
                                    height: 500
                                });
                            });
                        </script>
                        <script>
                            $(document).ready(function () {
                                $("#pageForm").validate({
                                    rules: {
                                        title: {
                                            required: true,
                                            remote: {
                                                url: "<?php echo base_url() . 'admin/'.$lang_id.'/homepagesetting/checkPageExists/'; ?>"+$('#pageId').val(),
                                                type: "post",
                                                data: {
                                                    title: function () {
                                                        return $("#title").val();
                                                    }
                                                }
                                            }
                                        },
                                        page_url: {
                                            required: true,
                                            remote: {
                                                url: "<?php echo base_url() . 'admin/'.$lang_id.'/homepagesetting/checkPageurlExists/'; ?>"+$('#pageId').val(),
                                                type: "post",
                                                data: {
                                                    page_url: function () {
                                                        return $("#page_url").val();
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    messages: {
                                        title: {
                                            required: "<?php echo $admin_static_links['please_enter_title']['front']; ?>",
                                            remote: "<?php echo $admin_static_links['title_already_exists']['front']; ?>"
                                        },
                                        page_url: {
                                            required: "<?php echo $admin_static_links['please_enter_page_url']['front']; ?>",
                                            remote: "<?php echo $admin_static_links['page_url_already_exists']['front']; ?>"
                                        }
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
