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
                        <form id="productItemForm" name="productItemForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set"/>
                            <input type="hidden" id="itemId" value="<?= isset($edit_data['id']) ? $edit_data['id'] : '';?>"/>
                            <div class="span12">
                                <div class="block well">
                                    <div class="navbar">
                                        <div class="navbar-inner">
                                            <h5>
                                                <?= isset($edit_data) ? $admin_tbl_product_item['edit_product_items']['admin'] : $admin_tbl_product_item['add_product_items']['admin']; ?>
                                            </h5>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_tbl_product_item['edit_product_items']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tbl_product_items/edit_product_items'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tbl_product_items/edit_product_items/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_tbl_product_item['item_type']['admin']; ?></label>
                                        <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_tbl_product_item['item_type']['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tbl_product_items/item_type'; ?>">
                                        <?php } ?>
                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tbl_product_items/item_type/admin" class="fancybox multi_language_common_edit admin_globe">
                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                        </a>

                                        <div class="controls">
                                            <select name="item_type" required id="item_type">
                                                <?php if(isset($edit_data['id']) && in_array($edit_data['id'],array(1,2,167,168,169))){?>
                                                    <option value="product_model" <?php if(isset($edit_data['item_type']) && $edit_data['item_type'] == 'product_model') { echo "selected"; } ?>><?php echo $admin_static_links['item_product_model']['front']; ?></option>

                                                <?php } else { ?>
                                                    <option value="product_group" <?php if(isset($edit_data['item_type']) && $edit_data['item_type'] == 'product_group') { echo "selected"; } ?>><?php echo $admin_static_links['item_product_group']['front']; ?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_tbl_product_item['product_item_title']['admin']; ?></label>
                                        <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_tbl_product_item['product_item_title']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tbl_product_items/product_item_title'; ?>">
                                        <?php } ?>
                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tbl_product_items/product_item_title/admin" class="fancybox multi_language_common_edit admin_globe">
                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                        </a>
                                        <div class="controls">
                                            <input type="text" class="focustip span12" id="item_name" name="item_name" value="<?php echo isset($edit_data['item_name']) ? $edit_data['item_name'] : ''; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                            <?php if(isset($edit_data['id'])){?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $edit_data['id']; ?>/tbl_product_items_country/item_name" class="fancybox multi_language_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <span class="red1 item_name_error"><?php echo form_error('item_name'); ?></span>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_tbl_product_item['field_type']['admin']; ?></label>
                                        <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_tbl_product_item['field_type']['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tbl_product_items/field_type'; ?>">
                                        <?php } ?>
                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tbl_product_items/field_type/admin" class="fancybox multi_language_common_edit admin_globe">
                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                        </a>

                                        <div class="controls">
                                            <select name="field_type" required >
                                                <?php if(isset($edit_data['id']) && $edit_data['id'] == 1){?>
                                                    <option value="dropdown" <?php if(isset($edit_data['field_type']) && $edit_data['field_type'] == 'dropdown') { echo "selected"; } ?>><?php echo $admin_static_links['field_dropdown']['front']; ?></option>
                                                <?php }else if(isset($edit_data['id']) && $edit_data['id'] == 2){?>
                                                    <option value="dropdown" <?php if(isset($edit_data['field_type']) && $edit_data['field_type'] == 'dropdown') { echo "selected"; } ?>><?php echo $admin_static_links['field_dropdown']['front']; ?></option>
                                                <?php } else { ?>
                                                    <option value="text" <?php if(isset($edit_data['field_type']) && $edit_data['field_type'] == 'text') { echo "selected"; } ?>><?php echo $admin_static_links['field_text']['front']; ?></option>
                                                    <option value="image" <?php if(isset($edit_data['field_type']) && $edit_data['field_type'] == 'image') { echo "selected"; } ?>><?php echo $admin_static_links['field_image']['front']; ?></option>                        
						    <option value="dropdown" <?php if(isset($edit_data['field_type']) && $edit_data['field_type'] == 'dropdown') { echo "selected"; } ?>><?php echo $admin_static_links['field_dropdown']['front']; ?></option>		
						    <option value="text_editor" <?php if(isset($edit_data['field_type']) && $edit_data['field_type'] == 'text_editor') { echo "selected"; } ?>><?php echo $admin_static_links['field_edit_text']['front']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_tbl_product_item['item_text_size']['admin']; ?></label>
                                        <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_tbl_product_item['item_text_size']['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tbl_product_items/item_text_size'; ?>">
                                        <?php } ?>
                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tbl_product_items/item_text_size/admin" class="fancybox multi_language_common_edit admin_globe">
                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                        </a>

                                        <div class="controls">
                                            <select name="item_text_size" required >
                                                <?php for($i=12; $i<=30; $i++){?>
                                                    <option value="<?= $i;?>" <?php if(isset($edit_data['item_text_size']) && $edit_data['item_text_size'] == $i) { echo "selected"; } ?>><?= $i;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_tbl_product_item['item_text_color']['admin']; ?></label>
                                        <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_tbl_product_item['item_text_color']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tbl_product_items/item_text_color'; ?>">
                                        <?php } ?>
                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tbl_product_items/item_text_color/admin" class="fancybox multi_language_common_edit admin_globe">
                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                        </a>
                                        <div class="controls">
                                            <input type="text" class="focustip span12 jscolor" id="item_text_color" name="item_text_color" value="<?php echo isset($edit_data['item_text_color']) ? $edit_data['item_text_color'] : ''; ?>">
                                        </div>
                                        <span class="red1 item_name_error"><?php echo form_error('item_text_color'); ?></span>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_tbl_product_item['multi_language']['admin']; ?></label>
                                        <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_tbl_product_item['multi_language']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tbl_product_items/multi_language'; ?>">
                                        <?php } ?>
                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tbl_product_items/multi_language/admin" class="fancybox multi_language_common_edit admin_globe">
                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                        </a>

                                        <div class="controls">
                                            <input type="checkbox" name="multi_language" value="1" <?php if (isset($edit_data['multi_language']) && $edit_data['multi_language'] == 1) { echo 'checked="checked"';} ?>  />
                                        </div>
                                        <span class="red1"><?php echo form_error('multi_language'); ?></span>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_tbl_product_item['required_attribute']['admin']; ?></label>
                                        <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_tbl_product_item['required_attribute']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tbl_product_items/required_attribute'; ?>">
                                        <?php } ?>
                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tbl_product_items/required_attribute/admin" class="fancybox multi_language_common_edit admin_globe">
                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                        </a>

                                        <div class="controls">
                                            <input type="checkbox" name="required_attribute" value="1" <?php if (isset($edit_data['required_attribute']) && $edit_data['required_attribute'] == 1) { echo 'checked="checked"';} ?>  />
                                        </div>
                                        <span class="red1"><?php echo form_error('required_attribute'); ?></span>
                                    </div>
                                    <?php if(isset($edit_data['id']) && $edit_data['id']){?>
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
                        </form>

                        <script>
                            $(document).ready(function () {
                                $("#send").click(function (e) {
                                    e.preventDefault();
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo base_url() . 'admin/' . $lang_id . '/productitems/checkProductitemExists'; ?>/"+$('#itemId').val(),
                                        data: {
                                            item_name: $("#item_name").val(),
                                            item_type: $("#item_type").val(),
                                        },
                                        dataType: "json",
                                        success: function (msg) {
                                            if (msg.response != 'success') {
                                                $(".item_name_error").html('<?php echo $admin_static_links['product_item_already_exists']['front']; ?>');
                                            } else {
                                                $("#productItemForm").submit();
                                            }
                                        },
                                        error: function (result) {
                                            alert('error');
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
