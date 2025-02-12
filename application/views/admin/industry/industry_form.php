<?php
$volume_unit = get_volume_unit();
$weight_unit = get_weight_unit();
$noimage = getNoImage('no_image');
?>


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
                        <form id="industryForm" name="industryForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set" />
                            <input type="hidden" id="industryId" value="<?= isset($edit_data['id']) ? $edit_data['id'] : ''; ?>" />
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?= isset($edit_data['id']) ? $admin_industries['edit_industry']['admin'] : $admin_industries['add_industry']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_industries['edit_industry']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_industries/edit_industry'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_industries/edit_industry/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_industries['industry_name']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_industries['industry_name']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_industries/industry_name'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_industries/industry_name/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <div class="controls">
                                                <input id="name" name="name" class="focustip span12" type="text" value="<?php echo isset($edit_data['name']) ? $edit_data['name'] : ''; ?>">
                                                <?php if (isset($edit_data['id'])) { ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $edit_data['id']; ?>/industries_country/name" class="fancybox multi_language_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>
                                                <?php } ?>
                                            </div>
                                            <span class="red1"><?php echo form_error('name'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_industries['industry_description']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_industries['industry_description']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_industries/industry_description'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_industries/industry_description/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls">
                                                <textarea id="description" name="description" class="focustip span12" rows="4" cols="50" value="<?php echo isset($edit_data['description']) ? $edit_data['description'] : ''; ?>" maxlength = '250'><?php echo isset($edit_data['description']) ? $edit_data['description'] : ''; ?></textarea>
                                                <?php if(isset($edit_data['id']) && !empty($edit_data['description'])){?>
                                                    <a href="admin/multilangue/index/<?php echo $edit_data['id']; ?>/industries_country/description" class="fancybox multi_language_edit"   target="_blank">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>
                                                <?php } ?>
                                            </div>
                                            <span class="red1"><?php echo form_error('description'); ?></span>
                                        </div>


                                        <div class="control-group" id="image">
                                            <label class="control-label"><?php echo $admin_industries['industry_icon']['front']; ?>:</label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_industries['industry_icon']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_industries/industry_icon'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_industries/industry_icon/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <div class="controls">
                                                <input id="industry_icon" name="icon" class="focustip span12" type="file">
                                                <?php if ($edit_data['icon'] != "") {
                                                    $src = './assets/uploads/industries/' . $edit_data['icon']; ?>
                                                    <img id="productimage1" src="<?php echo $src; ?>" alt=" image preview" class="modelimgpreviewbox" />
                                                    <div id="productimage1_delete" class="margintop-10px">
                                                        <input type="button" class="focustip nopadding" value="<?php echo $admin_static_links['delete_image']['front']; ?>" onclick="removeimg('productimage1');">
                                                    </div>
                                                <?php
                                                } else {
                                                    $src = $noimage; ?>
                                                    <img id="productimage1" src="<?php echo $src; ?>" alt=" image preview" class="modelimgpreviewbox" />
                                                    <div id="productimage1_delete" class="margintop-10px"></div>

                                                <?php } ?>
                                            </div>
                                            <span class="red1"><?php echo form_error('icon'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_industries['industry_status']['admin']; ?> </label>
                                            <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_industries['industry_status']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_industries/industry_status'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_industries/industry_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            
                                            <div class="controls">
                                            
                                                <input type="checkbox" name="status" value="1" <?php if ($edit_data['status'] == 1) { echo 'checked="checked"'; } ?>  <?php if (isset($edit_data['id']) && in_array($edit_data['id'],$cat_industries)) { echo 'disabled'; } ?> />
                                            
                                            </div>
                                            <span class="red1"><?php echo form_error('status'); ?></span>
                                        </div>

                                        

                                        <?php if ($addscripts == 'edit_industry') { ?>

                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        <?php } else { ?>
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_add']['front']; ?>" id="send" type="submit">
                                                <input class="btn btn-danger" type="reset" value="<?php echo $admin_static_links['reset']['front']; ?>">
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <script>
                            jQuery.validator.addMethod("alphanumeric", function(value, element) {
                                return this.optional(element) || /^[\w.-]+$/i.test(value) && value.indexOf(" ") < 0;
                            }, "<?php echo $admin_static_links['please_enter_alphanumeric']['front']; ?>");

                            $(document).ready(function() {
                                $("#industryForm").validate({
                                    rules: {
                                        name: {
                                            required: true,
                                            remote: {
                                                url: "<?php echo base_url() . 'admin/' . $lang_id . '/industry/checkindustryExists/'; ?>/" + $('#industryId').val(),
                                                type: "post",
                                                data: {
                                                    name: function() {
                                                        return $("#name").val();
                                                    }
                                                }
                                            }
                                        },
                                        description: {
                                            required: true
                                        }
                                    },
                                    messages: {
                                        name: {
                                            required: "<?php echo $admin_static_links['enter_industry_name']['front']; ?>",
                                            remote: "<?php echo $admin_static_links['industry_name_already_exists']['front']; ?>"
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