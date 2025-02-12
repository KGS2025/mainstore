<?php
$volume_unit = get_volume_unit();
$weight_unit = get_weight_unit();
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
                        <form id="packageForm" name="packageForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set" />
                            <input type="hidden" id="packageId" value="<?= isset($edit_data['id']) ? $edit_data['id'] : ''; ?>" />
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?= isset($edit_data['id']) ? $admin_package['edit_package']['admin'] : $admin_package['add_package']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_package['edit_package']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_package/edit_package'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_package/edit_package/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_package['packagename']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_package['packagename']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_package/packagename'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_package/packagename/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls">
                                                <input id="packagename" name="packagename" class="focustip span12" type="text" value="<?php echo isset($edit_data['packagename']) ? $edit_data['packagename'] : ''; ?>">
                                                <?php if (isset($edit_data['id'])) { ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/package_country/packagename" class="fancybox multi_language_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>
                                                <?php } ?>
                                            </div>
                                            <span class="red1"><?php echo form_error('packagename'); ?></span>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_package['package_code']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_package['package_code']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_package/package_code'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_package/package_code/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls">
                                                <input id="package_code" name="package_code" class="focustip span12" type="text" value="<?php echo isset($edit_data['package_code']) ? $edit_data['package_code'] : ''; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('package_code'); ?></span>
                                        </div>




                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_package['emptyweight']['admin']; ?> ( <?php echo $weight_unit; ?>) </label>
                                            <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_package['emptyweight']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_package/emptyweight'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_package/emptyweight/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <div class="controls">
                                                <input id="emptyweight" name="emptyweight" class="focustip span12" type="text" value="<?php echo isset($edit_data['emptyweight']) ? $edit_data['emptyweight'] : ''; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('emptyweight'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_package['innerwidth']['admin']; ?> ( <?php echo $volume_unit; ?>) </label>
                                            <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_package['innerwidth']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_package/innerwidth'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_package/innerwidth/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <div class="controls">
                                                <input id="innerwidth" name="innerwidth" class="focustip span12" type="text" value="<?php echo isset($edit_data['innerwidth']) ? $edit_data['innerwidth'] : ''; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('innerwidth'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_package['innerlength']['admin']; ?> ( <?php echo $volume_unit; ?>) </label>
                                            <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_package['innerlength']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_package/innerlength'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_package/innerlength/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <div class="controls">
                                                <input id="innerlength" name="innerlength" class="focustip span12" type="text" value="<?php echo isset($edit_data['innerlength']) ? $edit_data['innerlength'] : ''; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('innerlength'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_package['innerdepth']['admin']; ?> ( <?php echo $volume_unit; ?>) </label>
                                            <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_package['innerdepth']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_package/innerdepth'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_package/innerdepth/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <div class="controls">
                                                <input id="innerdepth" name="innerdepth" class="focustip span12" type="text" value="<?php echo isset($edit_data['innerdepth']) ? $edit_data['innerdepth'] : ''; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('innerdepth'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_package['maxweight']['admin']; ?> ( <?php echo $weight_unit; ?>) </label>
                                            <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_package['maxweight']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_package/maxweight'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_package/maxweight/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <div class="controls">
                                                <input id="maxweight" name="maxweight" class="focustip span12" type="text" value="<?php echo isset($edit_data['maxweight']) ? $edit_data['maxweight'] : ''; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('maxweight'); ?></span>
                                        </div>

                                        <?php if ($addscripts == 'edit_package') { ?>
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
                                $("#packageForm").validate({
                                    rules: {
                                        packagename: {
                                            required: true,
                                            remote: {
                                                url: "<?php echo base_url() . 'admin/' . $lang_id . '/package/checkPackageExists/'; ?>/" + $('#packageId').val(),
                                                type: "post",
                                                data: {
                                                    packagename: function() {
                                                        return $("#packagename").val();
                                                    }
                                                }
                                            }
                                        },
                                        package_code: {
                                            required: true,
                                            remote: {
                                                url: "<?php echo base_url() . 'admin/' . $lang_id . '/package/checkPackageNumberExists/'; ?>/" + $('#packageId').val(),
                                                type: "post",
                                                data: {
                                                    packagename: function() {
                                                        return $("#package_code").val();
                                                    }
                                                }
                                            },
                                            alphanumeric: true
                                        },
                                        outerwidth: {
                                            required: true
                                        },
                                        outerlength: {
                                            required: true
                                        },
                                        outerdepth: {
                                            required: true
                                        },
                                        emptyweight: {
                                            required: true
                                        },
                                        innerwidth: {
                                            required: true
                                        },
                                        innerlength: {
                                            required: true
                                        },
                                        innerdepth: {
                                            required: true
                                        },
                                        maxweight: {
                                            required: true
                                        }
                                    },
                                    messages: {
                                        packagename: {
                                            required: "<?php echo $admin_static_links['please_enter_packagename']['front']; ?>",
                                            remote: "<?php echo $admin_static_links['packagename_already_exists']['front']; ?>"
                                        },
                                        package_code: {
                                            required: "<?php echo $admin_static_links['please_enter_packagenuber']['front']; ?>",
                                            remote: "<?php echo $admin_static_links['packagenumber_already_exists']['front']; ?>"
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