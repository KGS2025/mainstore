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

    <?php
    $noimage = getNoImage();
    $privilage = isset($edit_data) ? explode(',', $edit_data['menu_privilages']) : array();
    $admin_menuprivilage = isset($edit_data) ? explode(',', $edit_data['menu_privilages_admin'])  : array();
    ?>

    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <div class="body">
                    <div class="container">
                        <form id="modelForm" name="modelForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set" />
                            <input type="hidden" id="delimageid" value="<?php echo isset($edit_data['id']) ? $edit_data['id'] : ''; ?>" />
                            <div class="span12">
                                <div class="block well">
                                    <div class="navbar">
                                        <div class="navbar-inner">
                                            <h5> <?php echo isset($edit_data['id']) ? $admin_products['edit_product_model']['front'] : $admin_products['add_product_model']['front']; ?></h5>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['product_type']['front']; ?>:</label>
                                        <div class="controls">
                                            <select id="vehicle_category_id" name="vehicle_category_id" class="focustip span12" <?php /*if (isset($edit_data['id']) && in_array($edit_data['id'], $all_prduct_model)) {
                                                                                                                                    echo 'disabled';
                                                                                                                                } */?>>
                                                <?php foreach ($product_catagory as $catagory) { ?>
                                                    <option value="<?php echo $catagory['id']; ?>" <?php if (isset($edit_data['vehicle_category_id']) && $edit_data['vehicle_category_id'] == $catagory['id']) {
                                                                                                        echo 'selected="selected"';
                                                                                                    } ?>><?php if (isset($catagory['lang_category_name']) && $catagory['lang_category_name'] != '') {
                                                                                                                echo $catagory['lang_category_name'];
                                                                                                            } else {
                                                                                                                echo $catagory['category_name'];
                                                                                                            } ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <span class="red1"><?php echo form_error('product_type'); ?></span>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['maker_name']['front']; ?>:</label>
                                        <div class="controls">
                                            <select id="maker_id" name="maker_id" class="focustip span12" <?php /* if (isset($edit_data['id']) && in_array($edit_data['id'], $all_prduct_model)) {
                                                                                                                echo 'disabled';
                                                                                                            } */ ?>>

                                            </select>
                                        </div>
                                        <span class="red1"><?php echo form_error('maker_id'); ?></span>
                                    </div>

                                  

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['product_model_name']['front']; ?>:</label>
                                        <div class="controls">
                                            <input id="pro_modelname" name="pro_modelname" class="focustip span12" type="text" value="<?php echo isset($edit_data['model_name']) ? $edit_data['model_name'] : ''; ?>">
                                            <?php if (isset($edit_data['id'])) { ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $edit_data['id']; ?>/tbl_models_country/model_name" class="fancybox multi_language_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <span class="red1"><?php echo form_error('pro_modelname'); ?></span>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['serial_number']['front']; ?>:</label>
                                        <div class="controls">
                                            <input id="serial_number" name="serial_number" class="focustip span12" type="text" value="<?php echo isset($edit_data['serial_number']) ? $edit_data['serial_number'] : ''; ?>">
                                            <?php if (isset($edit_data['id'])) { ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $edit_data['id']; ?>/tbl_models_country/serial_number" class="fancybox multi_language_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <span class="red1"><?php echo form_error('serial_number'); ?></span>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['upload_photo']['front']; ?>:</label>
                                        <div class="controls">
                                            <input id="pro_modelimage" name="pro_modelimage" class="focustip span12" type="file" value="">
                                            <?php if (isset($edit_data['model_photo']) && $edit_data['model_photo'] != "") { ?>
                                                <img src="<?php echo './assets/uploads/product_model/' . $edit_data['model_photo']; ?>" id="modelimg_prvw" class="modelimg_prvw width100px1" />
                                                <div id="delimagebtn" class="margintop-10px"><input type="button" class="focustip padding2px" value="Delete Image" onclick="removeimg();"></div>
                                            <?php } else { ?>
                                                <img src="<?php echo $noimage; ?>" id="modelimg_prvw" class="modelimg_prvw width100px1" />
                                                <div id="delimagebtn" class="margintop-10px"></div>
                                            <?php } ?>
                                        </div>
                                        <span class="red1"><?php echo form_error('pro_modelimage'); ?></span>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['status']['front']; ?>:</label>

                                        <div class="controls">
                                            <input type="checkbox" name="status" value="1" <?php if (isset($edit_data['status']) && $edit_data['status'] == 1) {
                                                                                                echo 'checked="checked"';
                                                                                            } ?> <?php if (isset($edit_data['id']) && in_array($edit_data['id'], $all_prduct_model)) {
                                                                                                        echo 'disabled';
                                                                                                    } ?> />
                                        </div>
                                        <span class="red1"><?php echo form_error('status'); ?></span>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['menu_items_to_display_frontend']['front']; ?></label>
                                        <?php $p_i_counter = 1;
                                        foreach ($product_items as $p_i) {
                                            if ($p_i_counter == 1) {
                                                echo '<div class="controls">';
                                            } ?>
                                            <div class="fieldalign">
                                                <?php if ($p_i['id'] <= 2) { ?>
                                                    <input name="menu[]" type="hidden" value="<?php echo $p_i['id']; ?>" />
                                                <?php } ?>
                                                <input name="menu[]" type="checkbox" class="focustip" value="<?php echo $p_i['id']; ?>" <?php if (in_array($p_i['id'], $privilage) || $p_i['id'] <= 2) {
                                                                                                                                            echo "checked=checked";
                                                                                                                                        } ?> <?php if ($p_i['id'] <= 2) {
                                                                                                                                                    echo "disabled";
                                                                                                                                                } ?> />
                                                <label class="marginleft-10px"> <?php echo ((!empty($p_i['lang_item_name']) ? $p_i['lang_item_name'] : $p_i['item_name'])); ?> </label>
                                            </div>
                                        <?php $p_i_counter++;
                                            if ($p_i_counter == 4) {
                                                $p_i_counter = 1;
                                                echo '<div class="clear-fix1"></div></div>';
                                            }
                                        }

                                        if ($p_i_counter != 1) {
                                            echo '<div class="clear-fix1"></div></div>';
                                        } ?>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['menu_items_to_display_backend']['front']; ?>:</label>
                                        <?php $p_i_counter = 1;
                                        foreach ($product_items as $p_i) {
                                            if ($p_i_counter == 1) {
                                                echo '<div class="controls">';
                                            } ?>
                                            <div class="fieldalign">
                                                <?php if ($p_i['id'] <= 2) { ?>
                                                    <input name="menuadmin[]" type="hidden" value="<?php echo $p_i['id']; ?>" />
                                                <?php } ?>
                                                <input name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo $p_i['id']; ?>" <?php if (in_array($p_i['id'], $admin_menuprivilage) || $p_i['id'] <= 2) {
                                                                                                                                                    echo "checked=checked";
                                                                                                                                                } ?> <?php if ($p_i['id'] <= 2) {
                                                                                                                                                            echo "disabled";
                                                                                                                                                        } ?> />
                                                <label class="marginleft-10px"> <?php echo ((!empty($p_i['lang_item_name']) ? $p_i['lang_item_name'] : $p_i['item_name'])); ?> </label>
                                            </div>

                                        <?php $p_i_counter++;
                                            if ($p_i_counter == 4) {
                                                $p_i_counter = 1;
                                                echo '<div class="clear-fix1"></div></div>';
                                            }
                                        }

                                        if ($p_i_counter != 1) {
                                            echo '<div class="clear-fix1"></div></div>';
                                        } ?>
                                    </div>

                                    <?php if ($addscripts == 'edit_product_model') { ?>
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
                            $(document).ready(function() {
                                $("#modelForm").validate({
                                    rules: {
                                        vehicle_category_id: {
                                            required: true,
                                        },
                                        maker_id: {
                                            required: true,
                                        },
                                        pro_modelname: {
                                            required: true,
                                        },
                                        serial_number: {
                                            required: true,
                                            remote: {
                                                url: "<?php echo base_url() . 'admin/' . $lang_id . '/product_model/checkSerialNumber'; ?>/" + $('#delimageid').val(),
                                                type: "post",
                                                data: {
                                                    serial_number: function() {
                                                        return $("#serial_number").val();
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    messages: {
                                        serial_number: {
                                            required: "<?php echo $admin_static_links['enter_serial_number']['front']; ?>",
                                            remote: "<?php echo $admin_static_links['serial_number_already_exists']['front']; ?>"
                                        }
                                    }
                                });

                                $("#checkboxID").on("click", function(e) {
                                    var checkbox = $(this);
                                    if (checkbox.is(":checked")) {
                                        e.preventDefault();
                                        return false;
                                    }
                                });
                            });

                            $("#vehicle_category_id").change(function() {
                                var id = $(this).val();
                                var maker_id = "";
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url() . 'admin/' . $lang_id . '/product_model/getProductMakersByCategory/'; ?>",
                                    data: {
                                        categoryId: id,
                                        makerId: maker_id
                                    },
                                    success: function(responce) {
                                        $("#maker_id").html(responce);
                                    },
                                    error: function(result) {
                                        alert('error');
                                    }
                                });
                            });


                            setTimeout(function() {

                                var id = $('#vehicle_category_id').val();
                                var maker_id = <?php if (isset($edit_data['maker_id']) && !empty($edit_data['maker_id'])) {
                                                    echo $edit_data['maker_id'];
                                                } ?> + "";
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url() . 'admin/' . $lang_id . '/product_model/getProductMakersByCategory/'; ?>" + id,
                                    data: {
                                        categoryId: id,
                                        makerId: maker_id
                                    },
                                    success: function(responce) {
                                        $("#maker_id").html(responce);
                                    },
                                    error: function(result) {
                                        alert('error');
                                    }
                                });


                            }, 1000);
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>