<div class="content zerorightmargin">
    <?php
    if ($this->session->flashdata('success')) {
        $msg = $this->session->flashdata('success');
    ?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?>
            </div>
        </div>
    <?php
    }
    ?>
    <div id="show_class" class="note displaynon"></div>
    <div id="result"></div>
    <div class="outer">
        <div class="inner">
            <div class="page-header">

                <div class="body">
                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well margintop-30px">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <h5>
                                        <?php echo $admin_order_details['request_list']['admin']; ?>
                                    </h5>
                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                        <div class="edit_text" style="display:block"></div>
                                        <input type="text" value="<?php echo $admin_order_details['request_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/request_list'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/request_list/admin" class="fancybox multi_language_common_edit admin_globe">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>
                                    <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                        <div class="pull-right">
                                            <button id="delete_checked" class="deletebtn"><?php echo $admin_static_links['delete_all']['front']; ?>
                                            </button>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                    <table aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">
                                        <thead>
                                            <tr role="row">
                                                <th colspan="1" rowspan="1"><input id="delete_all_btn" type="checkbox" name="delete_option[]" value="all"></th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_order_details['srno']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['srno']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/srno'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/srno/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>
                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $general_instruction->customer_email; ?></label>
                                                   
                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $general_instruction->customer_name; ?></label>
                                                   
                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $general_instruction->requested_products; ?></label>
                                                   
                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $general_instruction->requested_products_date; ?></label>
                                                
                                                </th>
                                                <th>
                                            <label class="control-label"><?php echo $general_instruction->expire_products_date; ?></label>
                                            </th>
                                                <th>
                                                    <label class="control-label"><?php echo $general_instruction->requested_product_status; ?></label>
                                                
                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $general_instruction->action; ?></label>
                                                  
                                                </th>
                                               
                                            </tr>
                                        </thead>

                                        <tbody aria-relevant="all" aria-live="polite" role="alert">

                                        <?php

if (!empty($all_orders) && count($all_orders) > 0) {
    if (isset($offset)) {
        $i = $offset + 1;
    } else {
        $i = 1;
    }
    foreach ($all_orders as $set_data) {

        $products = $this->product_model->products_number_by_id($set_data->products);
        ?>
                <tr>
                <td class="dataTables" valign="top">
                                                            <input class="blocks" type="checkbox" name="delete_option[]" value="<?php echo $set_data->id; ?>">
                                                        </td>
                <td><?php echo $i; ?></td>
                <td> <?php echo $set_data->email; ?></td> 
                <td><?php echo $set_data->salutation." ".$set_data->company; ?></td>
                <td> <?php echo implode(",", $products); ?></td>     
                                           <td><?php echo date('Y-m-d', strtotime($set_data->createddate)); ?></td>
                                           <td><?php echo date('Y-m-d', strtotime($set_data->expire_date)); ?></td>

              
                <td> <?php echo getpaymentrequeststatus($set_data->status); ?></td>
                <td>
                <a href="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/pricerequests/viewrequest/<?php echo $set_data->id; ?>" class="viewbtn"> <?php echo $general_instruction->requested_products_view; ?></a>


                <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/pricerequests/delete/<?php echo $set_data->id; ?>"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                            <?php } ?>

                </td>
                </tr>
                <?php $i++;
    }
} else {
    ?>
                                <tr class="odd">
                                <td class="dataTables" valign="top" colspan="5"><?=$admin_static_links['no_data_available']['front'];?></td>
                                </tr>
                                <?php }?>

                                <tr>
                                                <td colspan="4">
                                            

                                                    <?php if (isset($links)) { ?>
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

                </div>
                <!-- /content container -->

            </div>
        </div>
    </div>
</div>

<script>
    function order_status(id, value) {

        $.ajax({
            type: "POST",
            url: "admin/<?php echo $lang_id; ?>/orders/update_status",
            /* The country id will be sent to this file */
            data: "id=" + id + "&status=" + value,
            beforeSend: function() {

            },
            success: function(msg) {
                alert('<?= $admin_static_links['data_successfully_updated']['front']; ?>');
            }
        });
    }


    $(document).ready(function() {




        $("#delete_all_btn").click(function() {
            if ($("#delete_all_btn").is(':checked')) {
                $(".blocks").prop('checked', true);
            } else {
                $(".blocks").prop('checked', false);
            }
        });
        $("#delete_checked").click(function() {
            if ($('input.blocks:checkbox:checked').length) {
                var msg = "<?php echo $admin_static_links['are_you_sure']['front']; ?>";
                var answer = confirm(msg);
                if (answer) {
                    var blocksarray = [];
                    $('input.blocks:checkbox:checked').each(function() {
                        blocksarray.push($(this).val());
                        $(this).parents('tr').hide();
                    });
                    var url = "admin/<?php echo $lang_id; ?>/pricerequests/deleteAll";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            'block_ids': blocksarray,
                            'table': 'price_requests'
                        },
                        success: function(data) {
                            $("#delete_all_btn").prop('checked', false);
                        }
                    });
                }
            } else {
                alert("<?php echo $admin_static_links['please_select_alteast_one_item']['front']; ?>");
            }
        });

    });
</script>
<script type="text/javascript">
    function confirm_box() {
        var answer = confirm("<?php echo $admin_static_links['are_you_sure']['front']; ?>");
        if (!answer)
            return false;
    }
</script>