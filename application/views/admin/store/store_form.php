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
                        <form id="storeForm" name="storeForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set" />
                            <input type="hidden" id="storeId" value="<?= isset($edit_data['id']) ? $edit_data['id'] : ''; ?>" />
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?= isset($edit_data['id']) ? $admin_store['edit_store']['admin'] : $admin_store['add_store']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_store['edit_store']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_store/edit_store'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_store/edit_store/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_store['name']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_store['name']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_store/name'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_store/name/admin" class="fancybox multi_language_common_edit admin_globe">
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
                                                <label class="control-label"><?php echo $admin_store['store_url']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_store['store_url']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_store/store_url'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_store/store_url/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                                <div class="controls">
                                                    <input id="url" name="url" class="focustip span12" type="url" value="<?php echo isset($edit_data['url']) ? $edit_data['url'] : ''; ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('url'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_store['description']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_store['description']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_store/description'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_store/description/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                                <div class="controls">
                                                    <textarea id="description" name="description" class="focustip span12" rows="4" cols="50" value="<?php echo isset($edit_data['description']) ? $edit_data['description'] : ''; ?>" maxlength='250'><?php echo isset($edit_data['description']) ? $edit_data['description'] : ''; ?></textarea>
                                                    <?php if (isset($edit_data['id']) && !empty($edit_data['description'])) { ?>
                                                        <a href="admin/multilangue/index/<?php echo $edit_data['id']; ?>/store_country/description" class="fancybox multi_language_edit" target="_blank">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                                <span class="red1"><?php echo form_error('description'); ?></span>
                                            </div>


                                            <div class="control-group" id="image">
                                                <label class="control-label"><?php echo $admin_store['image']['front']; ?>:</label>
                                                <div class="controls">
                                                    <input id="store_img" name="image" class="focustip span12" type="file">
                                                    <?php if ($edit_data['image'] != "") {
                                                        $src = './assets/uploads/store/' . $edit_data['image']; ?>
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
                                                <label class="control-label"><?php echo $admin_store['address']['admin']; ?> </label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_store['address']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_store/address'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_store/address/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                                <div class="controls">
                                                    <input id="address" name="address" class="focustip span12" type="text" value="<?php echo isset($edit_data['address']) ? $edit_data['address'] : ''; ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('address'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_store['owner_email']['admin']; ?> </label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_store['owner_email']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_store/owner_email'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_store/owner_email/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                                <div class="controls">
                                                    <input id="owner_email" name="owner_email" class="focustip span12" type="email" value="<?php echo isset($edit_data['owner_email']) ? $edit_data['owner_email'] : ''; ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('owner_email'); ?></span>
                                            </div>




                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_store['industry']['admin']; ?> </label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_store['industry']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_store/industry'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_store/industry/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                                <div class="controls">



                                                    <select class="industry-multiple focustip span12" name="industries[]" multiple="multiple" required>
                                                        <?php if (count($industry) > 0) {
                                                            $industry_id = explode(',', $edit_data['industries']);
                                                            foreach ($industry as $indus) { ?>
                                                                <option value="<?= $indus['id']; ?>" <?php if (in_array($indus['id'], $industry_id)) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?= $indus['lang_name'] ? $indus['lang_name'] : $indus['name']; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>


                                                </div>
                                                <span class="red1"><?php echo form_error('industry'); ?></span>
                                            </div>


                                <div class="control-group">
                                   <label class="control-label"><?php echo $admin_store['showprice_title']['front']; ?> </label>
                                    <div class="controls">
                                        <select class="focustip span12" name="show_price" required>
                                        <option value="1" <?php if($edit_data['show_price']=="1") { echo "selected"; } ?>> <?php echo $admin_store['showprice_yes']['front']; ?>  </option>
                                        <option value="0" <?php if($edit_data['show_price']=="0") { echo "selected"; } ?> > <?php echo $admin_store['showprice_no']['front']; ?> </option>
                                        </select>
                                    </div>
                                   <span class="red1"><?php echo form_error('show_price'); ?></span>
                                </div>




                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_store['status']['admin']; ?> </label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_store['status']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_store/status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_store/status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                                <div class="controls">

                                                    <input type="checkbox" name="status" value="1" <?php if ($edit_data['status'] == 1) {
                                                                                                        echo 'checked="checked"';
                                                                                                    } ?> />

                                                </div>
                                                <span class="red1"><?php echo form_error('status'); ?></span>
                                            </div>



                                            <?php if ($addscripts == 'edit_store') { ?>

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
                            $('.industry-multiple').select2();

                            jQuery.validator.addMethod("alphanumeric", function(value, element) {
                                return this.optional(element) || /^[\w.-]+$/i.test(value) && value.indexOf(" ") < 0;
                            }, "<?php echo $admin_static_links['please_enter_alphanumeric']['front']; ?>");

                            $(document).ready(function() {
                                $("#storeForm").validate({
                                    rules: {
                                        name: {
                                            required: true,
                                            remote: {
                                                url: "<?php echo base_url() . 'admin/' . $lang_id . '/store/checkStoreExists/'; ?>/" + $('#storeId').val(),
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
                                                url: "<?php echo base_url() . 'admin/' . $lang_id . '/store/checkUrlExists/'; ?>/" + $('#storeId').val(),
                                                type: "post",
                                                data: {
                                                    name: function() {
                                                        return $("#url").val();
                                                    }
                                                }
                                            }
                                        },
                                        description: {
                                            required: true
                                        },
                                        address: {
                                            required: true
                                        },
                                        owner_email: {
                                            required: true
                                        },
                                        show_price: {
                                            required: true
                                        }
                                    },
                                    messages: {
                                        name: {
                                            required: "<?php echo $admin_static_links['enter_store_name']['front']; ?>",
                                            remote: "<?php echo $admin_static_links['store_name_already_exists']['front']; ?>"
                                        },
                                        url: {
                                            required: "<?php echo $admin_static_links['please_enter_url']['front']; ?>",
                                            remote: "<?php echo $admin_static_links['store_url_already_exists']['front']; ?>"
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