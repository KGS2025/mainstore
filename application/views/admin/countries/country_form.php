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
                        <form id="countryForm" name="countryForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set"/>
                            <input type="hidden" id="countryId" value="<?= isset($edit_data['id']) ? $edit_data['id'] : '';?>"/>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php $action = isset($edit_data['id']) ? 'edit_country' : 'add_country';
                                                    echo $lang_data[$action]['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?= $lang_data[$action]['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/countries/'.$action; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/countries/<?= $action;?>/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $lang_data['country_name']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $lang_data['country_name']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/countries/country_name'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/countries/country_name/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input type="text" class="focustip span12" id="countryName" name="countryName" value="<?php echo isset($edit_data['countryName']) ? $edit_data['countryName'] : ''; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                                <?php if(isset($edit_data['id'])){?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $edit_data['id']; ?>/countries_lang/countryName" class="fancybox multi_language_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                <?php } ?>
                                            </div>
                                            <span class="red1"><?php echo form_error('countryName'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $lang_data['country_alpha_2']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $lang_data['country_alpha_2']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/countries/country_alpha_2'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/countries/country_alpha_2/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input type="text" class="focustip span12" id="alpha_2" name="alpha_2" value="<?php echo isset($edit_data['alpha_2']) ? $edit_data['alpha_2'] : ''; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                            </div>
                                            <span class="red1"><?php echo form_error('alpha_2'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $lang_data['country_alpha_3']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $lang_data['country_alpha_3']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/countries/country_alpha_3'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/countries/country_alpha_3/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input type="text" class="focustip span12" id="alpha_3" name="alpha_3" value="<?php echo isset($edit_data['alpha_3']) ? $edit_data['alpha_3'] : ''; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                            </div>
                                            <span class="red1"><?php echo form_error('alpha_3'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $lang_data['country_code']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $lang_data['country_code']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/countries/country_code'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/countries/country_code/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input type="number" min="1" class="focustip span12" id="country_code" name="country_code" value="<?php echo isset($edit_data['country_code']) ? $edit_data['country_code'] : ''; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                            </div>
                                            <span class="red1"><?php echo form_error('country_code'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $lang_data['country_status']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $lang_data['country_status']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/countries/country_status'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/countries/country_status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input type="checkbox" name="status" value="1" <?php if (isset($edit_data['status']) && $edit_data['status'] == 1){echo 'checked="checked"'; } ?>  />
                                            </div>
                                            <span class="red1"><?php echo form_error('status'); ?></span>
                                        </div>

                                        <?php if($addscripts == 'edit_countries'){?>
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

                        <script>
                            $(document).ready(function () {
                                $("#countryForm").validate({
                                    rules: {
                                        country_code: {
                                            required: true
                                        },
                                        alpha_2: {
                                            required: true
                                        },
                                        alpha_3: {
                                            required: true
                                        },
                                        countryName: {
                                            required: true,
                                            remote: {
                                                url: "<?php echo base_url() . 'admin/' . $lang_id . '/countries/checkCountryNameExists/'; ?>/"+$('#countryId').val(),
                                                type: "post",
                                                data: {
                                                    countryName: function () {
                                                        return $("#countryName").val();
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    messages: {
                                        countryName: {
                                            remote: "<?php echo $lang_data['country_name_exists']['admin']; ?>"
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
