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
                        <?php 
                        $privilage = isset($edit_data) ? explode(',', $edit_data['menu_privilages']) : array();
                        $admin_menuprivilage = isset($edit_data) ? explode(',', $edit_data['menu_privilages_admin'])  : array();
                        ?>
                        <form id="productTypeForm" name="productTypeForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set"/>
                            <input type="hidden" id="delimageid" value="<?php echo isset($edit_data['id']) ? $edit_data['id'] : ''; ?>"/>
                            <div class="span12">
                                <div class="block well">
                                    <div class="navbar">
                                        <div class="navbar-inner"><h5> <?= isset($edit_data['id']) ? $admin_products['edit_producttype']['front'] : $admin_products['add_producttype']['front']; ?></h5></div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['product_type_name']['front']; ?>:</label>
                                        <div class="controls">
                                            <input id="pro_typename" name="pro_typename" class="focustip span12" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> type="text" value="<?php if(isset($edit_data['lang_product_type_name']) && $edit_data['lang_product_type_name'] != '') {  echo $edit_data['lang_product_type_name']; } else if(isset($edit_data['product_type_name'])) { echo $edit_data['product_type_name']; } ?>">
                                            <?php if(isset($edit_data['id'])){?>
                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $edit_data['id']; ?>/tbl_product_types_country/product_type_name" class="fancybox multi_language_edit" target="_blank">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <span class="red1"><?php echo form_error('pro_typename'); ?></span>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['product_type_photo']['front']; ?>:</label>
                                        <div class="controls">
                                            <input id="pro_image" name="pro_image" class="focustip span12" type="file" value="">
                                            <?php if (isset($edit_data['Product_Type_Photo']) && $edit_data['Product_Type_Photo']) { ?>
                                                <img src="<?php echo './assets/uploads/product_type_images/' . $edit_data['Product_Type_Photo']; ?>" id="typeimg_prvw" class="typeimg_prvw width100px1" />
                                                <div id="delimagebtn" class="margintop-10px"><input type="button" class="focustip padding2px" value="Delete Image" onclick="removeimg();"></div>
                                            <?php } else { ?>
                                                <img src="<?php echo $noimage; ?>" id="typeimg_prvw" class="typeimg_prvw width100px1"
                                                    />
                                                <div id="delimagebtn" class="margintop-10px"><input type="button" class="focustip padding2px" value="Delete Image" onclick="removeimg();"></div>
                                            <?php } ?>
                                        </div>
                                        <span class="red1"><?php echo form_error('pro_image'); ?></span>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['status']['front']; ?>:</label>
                                        <div class="controls">
                                            <input type="checkbox" name="status" value="1" <?php if (isset($edit_data['status']) && $edit_data['status'] == 1) { echo 'checked="checked"'; } ?>  <?php if (isset($edit_data['id']) && in_array($edit_data['id'], $all_product_group)) {
                                                                                                                                                                                                    echo 'disabled';
                                                                                                                                                                                                } ?> />
                                        </div>
                                        <span class="red1"><?php echo form_error('status'); ?></span>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['menu_items_to_display_frontend']['front']; ?></label>
                                        <?php $p_i_counter = 1;
                                        foreach($product_items as $p_i){
                                            if($p_i_counter == 1){
                                                echo '<div class="controls">';
                                            } ?>
                                            <div class="fieldalign">
                                                <input name="menu[]" type="checkbox" class="focustip" value="<?php echo $p_i['id']; ?>" <?php if(in_array($p_i['id'],$privilage )) { echo "checked=checked"; } ?>/>
                                                <label class="marginleft-10px"> <?php echo ((!empty($p_i['lang_item_name']) ? $p_i['lang_item_name'] : $p_i['item_name'])); ?> </label>
                                            </div>
                                            <?php $p_i_counter++;
                                            if($p_i_counter == 4){
                                                $p_i_counter = 1;
                                                echo '<div class="clear-fix1"></div></div>';
                                            }
                                        }

                                        if($p_i_counter != 1){
                                            echo '<div class="clear-fix1"></div></div>';
                                        } ?>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><?php echo $admin_products['menu_items_to_display_backend']['front']; ?>:</label>
                                        <?php $p_i_counter = 1;
                                        foreach($product_items as $p_i){
                                            if($p_i_counter == 1){
                                                echo '<div class="controls">';
                                            } ?>
                                            <div class="fieldalign">
                                                <input name="menuadmin[]" type="checkbox" class="focustip" value="<?php echo $p_i['id']; ?>" <?php if(in_array($p_i['id'],$admin_menuprivilage )) { echo "checked=checked"; } ?>/>
                                                <label class="marginleft-10px"> <?php echo ((!empty($p_i['lang_item_name'])?$p_i['lang_item_name']:$p_i['item_name'])); ?> </label>
                                            </div>

                                            <?php $p_i_counter++;
                                            if($p_i_counter == 4){
                                                $p_i_counter = 1;
                                                echo '<div class="clear-fix1"></div></div>';
                                            }
                                        }

                                        if($p_i_counter != 1){
                                            echo '<div class="clear-fix1"></div></div>';
                                        }?>
                                    </div>
                                    <?php if($addscripts == 'edit_producttype'){?>
                                        <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        <?php } ?>
                                    <?php }else{ ?>
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
                                $("#productTypeForm").validate({
                                    rules: {
                                        pro_typename: {
                                            required: true,
                                            remote: {
                                                url : "<?php echo base_url() . 'admin/' .  $lang_id . '/product_type/checkProTypeName'; ?>/"+$('#delimageid').val(),
                                                type: "post",
                                                data: {
                                                    pro_typename: function() {
                                                        return $( "#pro_typename" ).val();
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    messages: {
                                        pro_typename: {
                                            required: "<?php echo $admin_static_links['enter_product_type_name']['front']; ?>",
                                            remote: "<?php echo $admin_static_links['product_type_name_already_exists']['front']; ?>"
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
