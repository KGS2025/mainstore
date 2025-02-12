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
                        <form id="adminUser" name="adminUser" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set"/>
                            <input type="hidden" id="userId" value="<?= isset($edit_data['id']) ? $edit_data['id'] : '';?>"/>
                            <div class="row-fluid">
                                <input type="hidden" id="delimageid" value="<?php echo isset($edit_data['id']) ? $edit_data['id'] : ''; ?>"/>
                                <div class="span12">
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5><?php echo $admin_admin_users['edit_admin_users']['admin']; ?></h5>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_admin_users['edit_admin_users']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/edit_admin_users'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/edit_admin_users/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_admin_users['title']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_admin_users['title']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/title'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/title/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>
                                            <div class="controls">
                                                <select class="span12" name="title" id="title">
                                                    <option value='Mr.' data-title="<?php echo $cart_instruction['mr_title']['front']; ?>" <?php if (isset($edit_data['title']) && $edit_data['title'] == 'Mr.') { ?> selected="selected"<?php } ?>><?php echo $cart_instruction['mr_title']['front']; ?></option>
                                                    <option value='Miss.' data-title="<?php echo $cart_instruction['ms_title']['front']; ?>" <?php if (isset($edit_data['title']) && $edit_data['title'] == 'Miss.') { ?> selected="selected"<?php } ?>><?php echo $cart_instruction['ms_title']['front']; ?></option>
                                                    <option value='Other' data-title="<?php echo $cart_instruction['other_title']['front']; ?>" <?php if (isset($edit_data['title']) && $edit_data['title'] == 'Other') { ?> selected="selected"<?php } ?>><?php echo $cart_instruction['other_title']['front']; ?></option>
                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('title'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_admin_users['first_name']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_admin_users['first_name']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/first_name'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/first_name/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input id="first_name" name="first_name" class="focustip span12" type="text" value="<?php echo isset($edit_data['first_name']) ? $edit_data['first_name'] : ''; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('first_name'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_admin_users['last_name']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_admin_users['last_name']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/last_name'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/last_name/admin" class="fancybox multi_language_common_edit admin_globe"><img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input id="last_name" name="last_name" class="focustip span12" type="text" value="<?php echo isset($edit_data['last_name']) ? $edit_data['last_name'] : ''; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('last_name'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_admin_users['country']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_admin_users['country']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/country'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/country/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <?php $user_country = isset($edit_data['country']) ? $edit_data['country'] : ''; ?>
                                                <select name="country" id="country" class="span12 selectpicker1 kgt2">
                                                    <?php foreach ($countries as $country) { ?>
                                                        <option value='<?php if ($lang_id != $primary_lang) { echo htmlentities($country['lang_countryName'], ENT_QUOTES); } else { echo htmlentities($country['countryName']); } ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" <?php if (isset($user_country) && $user_country != '' && $user_country == $country['lang_countryName']) { ?>selected="selected"<?php } else if (isset($country['countryName']) && $country['countryName'] == $user_country) { ?> selected="selected"<?php } else if (isset($ip_data['countryCode'])  && strtoupper($country['alpha_2']) == $ip_data['countryCode']) { ?>selected="selected" <?php } else if ($country['countryName'] == "Canada") { ?>selected="selected" <?php } else if ($country['lang_countryName'] == "Canada") { ?>selected="selected" <?php } ?>> <?php echo $country['countryName']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <span class="red1"><?php echo form_error('country'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_admin_users['email']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_admin_users['email']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/email'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/email/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input id="email" name="email" class="focustip span12" type="text" value="<?php echo isset($edit_data['email']) ? $edit_data['email'] : ''; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('email'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_admin_users['telephone']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_admin_users['telephone']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/telephone'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/telephone/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input id="country_code" name="country_code" class="focustip span3" type="text" value="+<?php echo isset($edit_data['country_code']) ? $edit_data['country_code'] : '1'; ?>" readonly autocomplete="off">
                                                <input id="telephone" name="telephone" class="focustip span9" type="text" value="<?php echo isset($edit_data['telephone']) ? $edit_data['telephone'] : ''; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('telephone'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_admin_users['role']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_admin_users['role']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/role'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/role/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <select class="span12" name="role" id="role">
                                                    <?php foreach ($roles as $role) { ?>
                                                        <?php foreach($admin_roles as $ar) { ?>
                                                            <?php if($ar['role'] == $role['role']) { ?>
                                                                <option value="<?php echo $role['id']; ?>" data-title="<?php echo $role['role']; ?>" <?php if (isset($edit_data['role_id']) && $edit_data['role_id'] == $role['id']) { ?> selected="selected"<?php } ?>><?php if(isset($ar['lang_role']) && $ar['lang_role'] != '') { echo $ar['lang_role']; } else { echo $role['role']; } ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_admin_users['status']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_admin_users['status']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>

                                                <div class="controls">
                                                    <input type="checkbox" name="status" value="1" <?php if (isset($edit_data['status']) && $edit_data['status'] == 1){echo 'checked="checked"'; } ?>  />
                                                </div>
                                                <span class="red1"><?php echo form_error('status'); ?></span>
                                            </div>

                                            <?php if($addscripts == 'edit_adminuser'){?>
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

                        <script>
                            $(document).ready(function () {


                            var country_code = $("#country").find(':selected').attr('data-rel');
                            $('#country_code').val('+' + country_code);

                                $("#adminUser").validate({
                                    rules: {
                                        first_name: {
                                            required: true
                                        },
                                        last_name: {
                                            required: true
                                        },
                                        email: {
                                            required: true,
                                            email: true,
                                            remote: {
                                                url: "<?php echo base_url() . 'admin/' . $lang_id . '/adminuser/checkEmailExists/'; ?>/"+$('#userId').val(),
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
                                                url: "<?php echo base_url() . 'admin/' . $lang_id . '/adminuser/checkPhoneExists/'; ?>/"+$('#userId').val(),
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
