<div class="content zerorightmargin">
    <?php if ($this->session->flashdata('success')) {
        $msg = $this->session->flashdata('success'); ?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?></div>
        </div>
    <?php } ?>

    <?php if ($this->session->flashdata('error')) {
        $msg = $this->session->flashdata('error');?>
        <div class="notice outer">
            <div class="error"><?php echo $msg; ?></div>
        </div>
    <?php } ?>

    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <div class="body">
                    <div class="container">
                        <form id="blockedUser" name="blockedUser" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set"/>
                            <input type="hidden" id="blockedId" value="<?= isset($edit_data['id']) ? $edit_data['id'] : '';?>"/>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?= (isset($edit_data) && !empty($edit_data)) ? $admin_block_users['edit_block_users']['admin'] : $admin_block_users['add_block_users']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_block_users['edit_block_users']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_block_users/edit_block_users'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_block_users/edit_block_users/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_block_users['email']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_block_users['email']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_block_users/email'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_block_users/email/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input id="email" name="email" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> class="focustip span12" type="text" value="<?= isset($edit_data['email']) ? $edit_data['email'] : ''; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('email'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_block_users['country']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_block_users['country']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_block_users/country'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_block_users/country/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <?php $user_country = isset($edit_data['country']) ? $edit_data['country'] : ''; ?>
                                                <select name="country" id="country" class="span12 selectpicker1 kgt2">
                                                    <?php foreach ($countries as $country) { ?>
                                                        <option value='<?php if ($lang_id != $primary_lang) { echo htmlentities($country['lang_countryName'], ENT_QUOTES); } else { echo htmlentities($country['countryName']); } ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" <?php if (isset($user_country) && $user_country != '' && $user_country == $country['lang_countryName']) { ?>selected="selected"<?php } else if (isset($country['countryName']) && $user_country == $country['countryName']) { ?> selected="selected" <?php } else if(isset($ip_data['countryCode'])  && strtoupper($country['alpha_2']) == $ip_data['countryCode'])  { ?> selected="selected" <?php } ?>><?php echo $country['countryName']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('country'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_block_users['Telephone']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_block_users['Telephone']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_block_users/Telephone'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_block_users/Telephone/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input id="country_code" name="country_code" class="focustip span3" type="text" value="+<?php echo isset($edit_data['country_code']) ? $edit_data['country_code'] : '1'; ?>" readonly autocomplete="off">
                                                <input id="telephone" name="telephone" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> class="focustip span9" type="text" value="<?php echo isset($edit_data['telephone']) ? $edit_data['telephone'] : ''; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('telephone'); ?></span>
                                        </div>
                                        <?php if($addscripts == 'edit_userblocked'){?>
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


                                var country_code = $("#country").find(':selected').attr('data-rel');
                                $('#country_code').val('+' + country_code);

                                $("#blockedUser").validate({
                                    rules: {
                                        email: {
                                            required: true,
                                            email: true,
                                            remote: {
                                                url: "<?php echo base_url() . 'admin/'.$lang_id.'/userblocked/checkEmailExists/'; ?>/"+$('#blockedId').val(),
                                                type: "post",
                                                data: {
                                                    email: function () {
                                                        return $("#email").val();
                                                    }
                                                }
                                            }
                                        },
                                        telephone: {
                                            required: true,
                                            number: true,
                                            remote: {
                                                url: "<?php echo base_url() . 'admin/'.$lang_id.'/userblocked/checkPhoneExists/'; ?>/"+$('#blockedId').val(),
                                                type: "post",
                                                data: {
                                                    country_code: function () {
                                                        return $("#country_code").val();
                                                    },
                                                    telephone: function () {
                                                        return $("#telephone").val();
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    messages: {
                                        email: {
                                            required: "<?php echo $admin_static_links['please_enter_email']['front']; ?>",
                                            email: "<?php echo $admin_static_links['please_enter_valid_email']['front']; ?>",
                                            remote: "<?php echo $admin_static_links['email_already_exists']['front']; ?>"
                                        },
                                        telephone: {
                                            required: "<?php echo $admin_static_links['please_enter_telephone']['front']; ?>",
                                            email: "<?php echo $admin_static_links['please_enter_valid_telephone']['front']; ?>",
                                            remote: "<?php echo $admin_static_links['telephone_already_exists']['front']; ?>"
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
