<div class="content zerorightmargin">
    <?php if ($this->session->flashdata('success')) {
        $msg = $this->session->flashdata('success'); ?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?>
            </div>
        </div>
    <?php } ?>
    <?php $noimage = getNoImage(); ?>
    <div id="show_class" class="note displaynon"></div>
    <div id="result"></div>
    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <!-- page title -->
                <!-- End page title -->
                <div class="body">

                    <form action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/product_model/index" method="post" enctype="multipart/form-data">
                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well margintop-30px">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <h5><?php echo $admin_products['product_model']['front']; ?></h5>
                                    <div class="control-group row-fluid width50_float_left">
                                        <form action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/product_model/index" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            <div class="controls">
                                                <input type="search" id="search" name="search" value="<?php echo $search; ?>" class="focustip span6"/>
                                                <span class="red1"></span>
                                                <input type="submit" id="search" value="<?php echo $admin_static_links['search']['front']; ?>" name="Submit" class="btn btn-primary"/>
                                            </div>
                                        </form>
                                    </div>

                                    <?php if (isset($access['page_add']) && $access['page_add'] == 1) { ?>
                                        <div class="dataTables_length" id="data-table_length">
                                            <label>
                                                <div id="" class="selector">
                                                    <a class="floatright" tabindex="0" id="data-table_first" href="admin/<?php echo $lang_id; ?>/product_model/add_model"><?php echo $admin_static_links['static_add']['front']; ?></a>
                                                </div>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                    <table aria-describedby="data-table_info" class="table table-striped dataTable"
                                           id="data-table">
                                        <thead>
                                        <tr role="row">
                                            <th><input type="checkbox" id="checkall" class="checkall" onchange="$('.rowitemdelete').prop('checked',this.checked);">
                                            </th>
                                            <th><?php echo $admin_products['slno']['front']; ?></th>
                                            <th><?php echo $admin_products['vehicle_model_name']['front']; ?></th>
                                            <th><?php echo $admin_products['vehicle_model_image']['front']; ?></th>
                                            <th><?php echo $admin_products['serial_number']['front']; ?></th> 
                                            <th><?php echo $admin_products['vehicle_brand_name']['front']; ?></th>
                                            <th><?php echo $admin_products['status']['front']; ?></th>
                                        </tr>
                                        </thead>

                                        <tbody aria-relevant="all" aria-live="polite" role="alert">
                                        <?php if (empty($all_data)) { ?>
                                            <tr class="odd">
                                                <td class="dataTables" valign="top" colspan="5"><?php echo $admin_static_links['no_data_available']['front']; ?></td>
                                            </tr>
                                        <?php } ?>

                                        <?php
                                        if(isset($offset)) {
                                            $i = $offset + 1;
                                        }
                                        else {
                                            $i = 1;
                                        }
                                        if (isset($all_data)) {
                                            foreach ($all_data as $set_data) {
                                                ?>
                                                <tr class="odd">
                                                    <td><input type="checkbox" id="checkitem" class="rowitemdelete" name="deleteitem[]" value="<?php echo $set_data['id']; ?>"></td>
                                                    <td class="dataTables" valign="top">
                                                        <?php echo $i; ?>
                                                    </td>
                                                    <td class="dataTables" valign="top">
                                                        <?php if(isset($set_data['lang_model_name']) && $set_data['lang_model_name'] != '') { ?>
                                                            <?php echo $set_data['lang_model_name']; ?>
                                                        <?php } else { ?>
                                                            <?php echo $set_data['model_name']; ?>
                                                        <?php } ?>    
                                                    </td>
                                                    

                                                    <td class="dataTables" valign="top">
                                                        <?php
                                                            if (isset($set_data['model_photo']) && $set_data['model_photo'] != '' && file_exists("assets/uploads/product_model/" . $set_data['model_photo'])) {
                                                                $image = 'assets/uploads/product_model/' . $set_data['model_photo'];
                                                            } else {
                                                                $image = $noimage;;
                                                            }
                                                        ?>
                                                        <img src="<?php echo $image; ?>" width="100" />

                                                    </td>

                                                    <td class="dataTables" valign="top">
                                                        <?php if(isset($set_data['lang_serial_number']) && $set_data['lang_serial_number'] != '') { ?>
                                                            <?php echo $set_data['lang_serial_number']; ?>
                                                        <?php } else { ?>
                                                            <?php echo $set_data['serial_number']; ?>
                                                        <?php } ?>    
                                                    </td>

                                                    <td class="dataTables" valign="top">
                                                        <?php if(isset($set_data['lang_maker_name']) && $set_data['lang_maker_name'] != '') { ?>
                                                            <?php echo $set_data['lang_maker_name']; ?>
                                                        <?php } else { ?>
                                                            <?php echo $set_data['maker_name']; ?>
                                                        <?php } ?>
                                                    </td>

                                                    <td class="dataTables" valign="top">
                                                        <?php if ($set_data['status'] == "0") {
                                                            echo $admin_static_links['unpublished']['front'];
                                                        } else {
                                                            echo $admin_static_links['published']['front'];
                                                        } ?>
                                                    </td>
                                                    <td class="dataTables" valign="top">
                                                        <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                        <a href="admin/<?php echo $lang_id; ?>/product_model/edit_model/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                        <?php } ?>
                                                        <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                        <a href="admin/<?php echo $lang_id; ?>/product_model/delete_model/<?php echo $set_data['id']; ?>"
                                                           onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                        }
                                        ?>

                                        <tr>
                                            <td colspan="17">
                                                <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                <input type="submit" id="DeleteSelected" value="<?php echo $admin_static_links['delete_selected']['front']; ?>" name="DeleteSelected" class="btn btn-primary" onclick="return confirm_box();"/>
                                                <input type="submit" id="DeleteAll" value="<?php echo $admin_static_links['delete_all']['front']; ?>" name="DeleteAll" class="btn btn-primary" onclick="return confirm_box();"/>
                                                 <?php } ?>
                                                <?php if(isset($links)) { ?>
                                                    <p class="floatright"><?php echo $links; ?></p>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /default datatable -->


                        <!-- Pickers -->
                    </div>

                    <!-- /pickers -->
                    </form>
                </div>
                <!-- /content container -->

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function confirm_box() {
        var answer = confirm("<?php echo $admin_static_links['are_you_sure']['front']; ?>");
        if (!answer)
            return false;
    }
</script>

