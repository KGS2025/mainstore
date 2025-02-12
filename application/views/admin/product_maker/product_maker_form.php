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
                        <form id="makerForm" name="makerForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set" />
                            <input type="hidden" id="delimageid" value="<?php echo isset($edit_data['id']) ? $edit_data['id'] : ''; ?>" />
                            <div class="span12">
                                <div class="block well">
                                    <div class="navbar">
                                        <div class="navbar-inner">
                                            <h5> <?= isset($edit_data['id']) ? $admin_products['edit_product_maker']['front'] : $admin_products['add_product_maker']['front']; ?></h5>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['product_type']['front']; ?>:</label>
                                        <div class="controls">
                                            <?php foreach ($product_catagory as $catagory) { ?>
                                                <input type="checkbox" name="vehicle_category_id[]" value="<?php echo $catagory['id']; ?>" <?php if (isset($edit_data['vehicle_category_id']) && in_array($catagory['id'], explode(',', $edit_data['vehicle_category_id']))) { ?> checked="checked" <?php /*if (in_array($edit_data['id'], $all_product_makers) && in_array($catagory['id'], $all_product_cat)) {
                                                                                                                                                                                                                                                                                                        echo "disabled";
                                                                                                                                                                                                                                                                                                    } */ ?> <?php } ?> />&nbsp; &nbsp;<span class="cat-label"> <?php if (isset($catagory['lang_category_name']) && $catagory['lang_category_name'] != '') {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo $catagory['lang_category_name'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo $catagory['category_name'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                            } ?>&nbsp; &nbsp; &nbsp; &nbsp; </span>
                                            <?php } ?>
                                        </div>
                                        <span class="red1"><?php echo form_error('part_number'); ?></span>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['product_maker_name']['front']; ?>:</label>
                                        <div class="controls">
                                            <input id="pro_makername" name="pro_makername" class="focustip span12" type="text" value="<?php echo isset($edit_data['maker_name']) ? $edit_data['maker_name'] : ''; ?>">
                                            <?php if (isset($edit_data['id'])) { ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $edit_data['id']; ?>/tbl_makers_country/maker_name" class="fancybox multi_language_edit">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <span class="red1"><?php echo form_error('pro_makername'); ?></span>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['logo']['front']; ?>:</label>
                                        <div class="controls">
                                            <input id="pro_makerlogo" name="pro_makerlogo" class="focustip span12" type="file" value="">
                                            <?php if (isset($edit_data['maker_logo']) && $edit_data['maker_logo'] != '') { ?>
                                                <img src="<?php echo './assets/uploads/product_maker/' . $edit_data['maker_logo']; ?>" id="makerimg_prvw" class="makerimg_prvw width100px1" />
                                                <div id="delimagebtn" class="margintop-10px">
                                                    <input type="button" class="focustip padding2px" value="Delete Image" onclick='removeimg();'>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <span class="red1"><?php echo form_error('pro_makerlogo'); ?></span>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['status']['front']; ?>:</label>
                                        <div class="controls">
                                            <input type="checkbox" name="status" value="1" <?php if (isset($edit_data['status']) && $edit_data['status'] == 1) {
                                                                                                echo 'checked="checked"';
                                                                                            } ?> <?php if (isset($edit_data['id']) && in_array($edit_data['id'], $all_product_makers)) {
                                                                                                                                                                                                    echo 'disabled';
                                                                                                                                                                                                } ?> />
                                        </div>
                                        <span class="red1"><?php echo form_error('status'); ?></span>
                                    </div>

                                    <?php if ($addscripts == 'edit_maker') { ?>
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
                                $("#makerForm").validate({
                                    rules: {
                                        pro_makername: {
                                            required: true,
                                            remote: {
                                                url: "<?php echo base_url() . 'admin/' . $lang_id . '/makers/checkMakerName/'; ?>/" + $('#delimageid').val(),
                                                type: "post",
                                                data: {
                                                    pro_makername: function() {
                                                        return $("#pro_makername").val();
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    messages: {
                                        pro_makername: {
                                            required: "<?php echo $admin_static_links['enter_product_maker_name']['front']; ?>",
                                            remote: "<?php echo $admin_static_links['product_maker_name_already_exists']['front']; ?>"
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
