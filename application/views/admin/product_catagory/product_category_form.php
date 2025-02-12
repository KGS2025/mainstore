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
    <?php $noimage = getNoImage('no_image'); ?>

    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <div class="body">
                    <div class="container">
                        <form id="vehicleCategoryForm" name="vehicleCategoryForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set"/>
                            <input type="hidden" id="delimageid" value="<?php echo isset($edit_data['id']) ? $edit_data['id'] : ''; ?>"/>
                            <div class="span12">
                                <div class="block well">
                                    <div class="navbar">
                                        <div class="navbar-inner">
                                            <h5> <?= isset($edit_data['id']) ? $admin_products['edit_vehicle_category']['front'] : $admin_products['add_vehicle_category']['front']; ?></h5>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['category_name']['front']; ?>:</label>
                                        <div class="controls">
                                            <input id="category_name" name="category_name" class="focustip span12" type="text" value="<?php if(isset($edit_data['lang_category_name']) && $edit_data['lang_category_name'] != '') {  echo $edit_data['lang_category_name']; } else if(isset($edit_data['category_name'])) { echo $edit_data['category_name']; } ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                            <?php if(isset($edit_data['id'])){?>
                                                <a href="admin/multilangue/index/<?php echo $edit_data['id']; ?>/tbl_vehicle_categories_country/category_name" class="fancybox multi_language_edit"   target="_blank">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <span class="red1"><?php echo form_error('category_name'); ?></span>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['vehicle_photo']['front']; ?>:</label>
                                        <div class="controls">
                                            <input id="VehicleType_Photo" name="VehicleType_Photo" class="focustip span12" type="file" value="<?php echo isset($edit_data['VehicleType_Photo']) ? $edit_data['VehicleType_Photo'] : ''; ?>">
                                            <?php if (isset($edit_data['VehicleType_Photo']) && $edit_data['VehicleType_Photo'] != "") { ?>
                                                <img id="modelimg_prvw1" src="<?php echo './assets/uploads/vehicle_categories/' . $edit_data['VehicleType_Photo']; ?>" alt=" image preview" class="modelimgpreviewbox"/>
                                                <div id="modelimg_prvw1_delete" class="margintop-10px">
                                                    <input type="button" class="focustip" value="<?php echo $admin_static_links['delete_image']['front']; ?>" class="nopadding" onclick="removeimg('modelimg_prvw1');">
                                                </div>
                                            <?php } else { ?>
                                                <img id="modelimg_prvw1" src="<?php echo $noimage; ?>" alt=" image preview" class="modelimgpreviewbox"/>
                                                <div id="modelimg_prvw1_delete" class="margintop-10px"></div>
                                            <?php } ?>
                                        </div>
                                        <span class="red1"><?php echo form_error('VehicleType_Photo'); ?></span>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['category_icon']['front']; ?>:</label>
                                        <div class="controls">
                                            <input id="vehicle_category_icon" name="vehicle_category_icon" class="focustip span12" type="file" value="<?php echo isset($edit_data['vehicle_category_icon']) ? $edit_data['vehicle_category_icon'] : ''; ?>">
                                            <?php if (isset($edit_data['vehicle_category_icon']) && $edit_data['vehicle_category_icon'] != "") { ?>
                                                <img id="modelimg_prvw2" src="<?php echo './assets/uploads/vehicle_categories/' . $edit_data['vehicle_category_icon']; ?>" alt=" image preview" class="modelimgpreviewbox"/>
                                                <div id="modelimg_prvw2_delete" class="margintop-10px">
                                                    <input type="button" class="focustip" value="<?php echo $admin_static_links['delete_image']['front']; ?>" class="nopadding" onclick="removeimg('modelimg_prvw2');">
                                                </div>
                                            <?php } else { ?>
                                                <img id="modelimg_prvw2" src="<?php echo $noimage; ?>" alt=" image preview" class="modelimgpreviewbox"/>
                                                <div id="modelimg_prvw2_delete" class="margintop-10px"></div>
                                            <?php } ?>
                                        </div>
                                        <span class="red1"><?php echo form_error('vehicle_category_icon'); ?></span>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['industry']['admin']; ?> </label>
                                        <div class="controls">
                                            <select class="focustip span12" name="industries" required>
                                                <?php if (count($industry) > 0) {
                                                    foreach ($industry as $indus) { ?>
                                                        <option value="<?= $indus['id']; ?>" <?php if ($indus['id'] == $edit_data['industries']) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?= $indus['lang_name'] ? $indus['lang_name'] : $indus['name']; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <span class="red1"><?php echo form_error('industry'); ?></span>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['status']['front']; ?>:</label>
                                        <div class="controls">
                                            <input type="checkbox" name="status" value="1" <?php if (isset($edit_data['status']) && $edit_data['status'] == 1) { echo ' checked="checked"'; } ?>  <?php if (isset($edit_data['id']) && in_array($edit_data['id'],$product_cat)) { echo 'disabled'; } ?>/>
                                        </div>
                                        <span class="red1"><?php echo form_error('status'); ?></span>
                                    </div>

                                    <?php if($addscripts == 'edit_product_category'){?>
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
                                $("#vehicleCategoryForm").validate({
                                    rules: {
                                        category_name: {
                                            required: true,
                                            remote: {
                                                url: "<?php echo base_url() . 'admin/' . $lang_id .'/vehicle_categories/checkVehicleCategoryName/'; ?>/"+$('#delimageid').val(),
                                                type: "post",
                                                data: {
                                                    pro_modelname: function () {
                                                        return $("#category_name").val();
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    messages: {
                                        category_name: {
                                            required: "<?php echo $admin_static_links['enter_vehicle_category_name']; ?>",
                                            remote: "<?php echo $admin_static_links['vehicle_category_name_already_exists']; ?>"
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
