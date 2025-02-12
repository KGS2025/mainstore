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
                        <form id="distributorForm" name="distributorForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set" />
                            <input type="hidden" id="distributorId" value="<?= isset($edit_data['id']) ? $edit_data['id'] : ''; ?>" />
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?= isset($edit_data['id']) ? $admin_distributor['edit_distributor']['admin'] : $admin_distributor['add_distributor']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_distributor['edit_distributor']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_distributor/edit_distributor'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_distributor/edit_distributor/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_distributor['name']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_distributor['name']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_distributor/name'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_distributor/name/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                                <div class="controls">
                                                    <input id="name" name="name" class="focustip span12" type="text" value="<?php echo isset($edit_data['name']) ? $edit_data['name'] : ''; ?>">
                                                    <?php if (isset($edit_data['id'])) { ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/store_country/name" class="fancybox multi_language_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                                <span class="red1"><?php echo form_error('name'); ?></span>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_distributor['owner_email']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_distributor['owner_email']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_distributor/owner_email'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_distributor/owner_email/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                                <div class="controls">
                                                    <input id="email" name="email" class="focustip span12" type="text" value="<?php echo isset($edit_data['email']) ? $edit_data['email'] : ''; ?>">
                                                    <?php if (isset($edit_data['id'])) { ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/distributors_country/email" class="fancybox multi_language_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                                <span class="red1"><?php echo form_error('email'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_distributor['phone']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_distributor['phone']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_distributor/phone'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_distributor/name/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                                <div class="controls">
                                                    <input id="phone" name="phone" class="focustip span12" type="text" value="<?php echo isset($edit_data['phone']) ? $edit_data['phone'] : ''; ?>">
                                                    <?php if (isset($edit_data['id'])) { ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/distributors_country/phone" class="fancybox multi_language_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                                <span class="red1"><?php echo form_error('phone'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_distributor['city']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_distributor['city']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_distributor/city'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_distributor/name/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                                <div class="controls">
                                                    <input id="city" name="city" class="focustip span12" type="text" value="<?php echo isset($edit_data['city']) ? $edit_data['city'] : ''; ?>">
                                                    <?php if (isset($edit_data['id'])) { ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/distributors_country/city" class="fancybox multi_language_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                                <span class="red1"><?php echo form_error('city'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_distributor['address']['admin']; ?> </label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_distributor['address']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_distributor/address'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_distributor/address/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                                <div class="controls">
                                                    <input id="address" name="address" class="focustip span12" type="text" value="<?php echo isset($edit_data['address']) ? $edit_data['address'] : ''; ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('address'); ?></span>
                                            </div>
                                          

                                          

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_distributor['country']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_distributor['country']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_distributor/country'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_distributor/country/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                                <div class="controls">
                                                <select autocomplete="no-fill" name="country" id="cart_country" class="form-control selectpicker1 kgt2 required_input">
                                                <?php foreach ($countries as $country) { ?>
                                                    <option value='<?php echo htmlentities($country['countryName'], ENT_QUOTES); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" <?php if (isset($edit_data['country']) && $edit_data['country'] != '' && $edit_data['country'] == $country['lang_countryName']) { ?>selected="selected" <?php } else if (isset($country['countryName']) && $country['countryName'] == $edit_data['country']) { ?> selected="selected" <?php } else if (isset($ip_data['countryCode'])  && strtoupper($country['alpha_2']) == $ip_data['countryCode']) { ?>selected="selected" <?php } else if ($country['countryName'] == "Canada") { ?>selected="selected" <?php } else if ($country['lang_countryName'] == "Canada") { ?>selected="selected" <?php } ?>>
                                                        <?php echo $country['countryName']; ?></option>
                                                <?php } ?>
                                                </select>
                                                
                                                </div>
                                                <span class="red1"><?php echo form_error('state'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_distributor['state']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_distributor['state']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_distributor/state'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_distributor/state/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                                <div class="controls">
                                                    <select name="state" id="cart-state-list" class="form-control kgt2 rounded required_input">
                                                    </select>
                                                    <input type="hidden" name="cud_state" id="cud_state" value="<?php if (isset($edit_data['state'])) { echo  $edit_data['state']; }?>">
                                                    </div>
                                                    <span class="red1"><?php echo form_error('state'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_distributor['zip_code']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_distributor['zip_code']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_distributor/state'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_distributor/state/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                                <div class="controls">
                                                    <input id="zip_code" name="zip_code" class="focustip span12" type="text" value="<?php echo isset($edit_data['zip_code']) ? $edit_data['zip_code'] : ''; ?>">
                                                    <?php if (isset($edit_data['id'])) { ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/distributors_country/zip_code" class="fancybox multi_language_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>
                                                    <?php } ?>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_distributor['distributor_url']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_distributor['distributor_url']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_distributor/distributor_url'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_distributor/distributor_url/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                                <div class="controls">
                                                    <input id="url" name="url" class="focustip span12" type="url" value="<?php echo isset($edit_data['url']) ? $edit_data['url'] : ''; ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('url'); ?></span>
                                            </div>

                                          


                                            <div class="control-group" id="image">
                                                <label class="control-label"><?php echo $admin_distributor['image']['front']; ?>:</label>
                                                <div class="controls">
                                                    <input id="store_img" name="image" class="focustip span12" type="file">
                                                    <?php if ($edit_data['logo'] != "") {
                                                        $src = './assets/uploads/distributor/' . $edit_data['logo']; ?>
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
                                                <span class="red1"><?php echo form_error('image'); ?></span>
                                            </div>

                                      
            

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_distributor['status']['admin']; ?> </label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_distributor['status']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_distributor/status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_distributor/status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                                <div class="controls">

                                                    <input type="checkbox" name="status" value="1" <?php if ($edit_data['status'] == 1) {
                                                                                                        echo 'checked="checked"';
                                                                                                    } ?> />

                                                </div>
                                                <span class="red1"><?php echo form_error('status'); ?></span>
                                            </div>



                                            <?php if ($addscripts == 'edit_distributor') { ?>

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

                        <script type="text/javascript">

$(document).ready(function() {
                                $.ajaxSetup({
                                    headers: {
                                        'Csrf-Token': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });


                                $(".deletefile").click(function() {
                                    $(this).hide();
                                    $("#term_real_file").val("");


                                });



                                $("#cart_country").msDropdown({
                                    roundedBorder: false
                                });


                                $("#cart_country").change(function() {
                                    var country1 = $(this).find(':selected').attr('data-imagecss');
                                    var val = country1 ? country1.split(" ") : [];

                                    var s = $('#ship_country_title').find('img').attr('class');
                                    var sstr = s ? s.split(" ") : [];
                                    var country = sstr[1];

                                    $.ajax({
                                        type: "POST",
                                        url: base_url + lang_id + "/language/getStateByCountry",
                                        data: {
                                            countryCode: val[1],
                                            stateCode: val[1]
                                        },
                                        success: function(responce) {
                                            $("#cart-state-list").html(responce);
                                        }
                                    });
                                });







                                setTimeout(function() {
                                    var a = $('#cart_country_title').find('img').attr('class');
                                    var str = a ? a.split(" ") : [];
                                    var cart_country = str[1];
                                    var cart_country1 = $('#cart_country').find(':selected').attr('data-imagecss');
                                    var cart_val = cart_country1 ? cart_country1.split(" ") : [];
                                    var cart_state = $('#cud_state').val();
                                    if ($.trim(cart_country) != '') {
                                        $.ajax({
                                            type: "POST",
                                            url: base_url + lang_id + "/language/getStateByCountry",
                                            data: {
                                                countryCode: cart_val[1],
                                                stateCode: cart_state
                                            },
                                            success: function(responce) {
                                                $("#cart-state-list").html(responce);
                                            }
                                        });
                                    }


                                }, 1000);







                                $("#cart_country").on('change', function() { // 2nd (A)
                                    var country_code = $(this).find(':selected').attr('data-rel');
                                    $('#cart_country_code').val('+' + country_code);
                                });


                                var country_code = $("#cart_country").find(':selected').attr('data-rel');
                                $('#cart_country_code').val('+' + country_code);
                            });
                            $('.-multiple').select2();

                            jQuery.validator.addMethod("alphanumeric", function(value, element) {
                                return this.optional(element) || /^[\w.-]+$/i.test(value) && value.indexOf(" ") < 0;
                            }, "<?php echo $admin_static_links['please_enter_alphanumeric']['front']; ?>");

                            $(document).ready(function() {
                                $("#distributorForm").validate({
                                    rules: {
                                        name: {
                                            required: true,
                                            remote: {
                                                url: "<?php echo base_url() . 'admin/' . $lang_id . '/distributor/checkdistributorExists/'; ?>/" + $('#distributorId').val(),
                                                type: "post",
                                                data: {
                                                    name: function() {
                                                        return $("#name").val();
                                                    }
                                                }
                                            }
                                        },
                                        url: {
                                            required: true,
                                            remote: {
                                                url: "<?php echo base_url() . 'admin/' . $lang_id . '/distributor/checkUrlExists/'; ?>/" + $('#distributorId').val(),
                                                type: "post",
                                                data: {
                                                    name: function() {
                                                        return $("#url").val();
                                                    }
                                                }
                                            }
                                        },
                                        city: {
                                            required: true
                                        },
                                        phone: {
                                            required: true
                                        },
                                        address: {
                                            required: true
                                        },
                                        country: {
                                            required: true
                                        },
                                        state: {
                                            required: true
                                        },
                                        zip_code: {
                                            required: true
                                        },
                                        email: {
                                            required: true,
                                            email: true
                                        }
                                    },
                                    messages: {
                                        name: {
                                            required: "<?php echo $admin_static_links['required_input']['front']; ?>",
                                            remote: "<?php echo $admin_static_links['duplicate_input']['front']; ?>"
                                        },
                                        url: {
                                            required: "<?php echo $admin_static_links['required_input']['front']; ?>",
                                            remote: "<?php echo $admin_static_links['duplicate_input']['front']; ?>"
                                        }
                                    }
                                });
                            });

                        function removeimg(wrapper) {
                            $('#' + wrapper).attr("src", "<?php echo $noimage; ?>");
                            $('#' + wrapper + '_delete').hide();
                        }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>