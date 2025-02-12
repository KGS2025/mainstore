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
                                        <?php echo $admin_user_details['user_details']['admin']; ?>
                                    </h5>
                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                        <div class="edit_text" style="display:block"></div>
                                        <input type="text" value="<?php echo $admin_user_details['order_details']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_user_details/order_details'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_user_details/order_details/admin" class="fancybox multi_language_common_edit admin_globe">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>



                                    <?php if (isset($access['page_add']) && $access['page_add'] == 1) { ?>
                                        <div class="dataTables_length" id="data-table_length">
                                            <label>
                                                <div id="" class="selector">
                                                    <a class="floatright" tabindex="0" id="data-table_first" href="admin/<?php echo $lang_id; ?>/users/add_users"><?php echo $admin_static_links['static_add']['front']; ?></a>
                                                </div>
                                            </label>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                    <table aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">
                                        <thead>
                                            <tr role="row">

                                                <th>
                                                    <label class="control-label"><?php echo $admin_user_details['srno']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_user_details['srno']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_user_details/srno'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_user_details/srno/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>
                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_user_details['company']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_user_details['company']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_user_details/company'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_user_details/company/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>
                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_user_details['email']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_user_details['email']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_user_details/email'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_user_details/email/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>
                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_user_details['country']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_user_details['country']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_user_details/country'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_user_details/country/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>
                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_user_details['telephone']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_user_details['telephone']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_user_details/telephone'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_user_details/telephone/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>
                                                </th>


                                                <th>
                                                    <label class="control-label"><?php echo $admin_user_details['customer_no']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_user_details['customer_no']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_user_details/customer_no'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_user_details/customer_no/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>
                                                </th>

                                                <th>
                                                    <label class="control-label"><?php echo $general_instruction['otp_code']['front']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $general_instruction['otp_code']['front']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/general_instruction/otp_code'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/general_instruction/otp_code/front" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>
                                                </th>

                                                <th>
                                                    <label class="control-label"><?php echo $general_instruction['set_password_link']['front']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $general_instruction['set_password_link']['front']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/general_instruction/set_password_link'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/general_instruction/set_password_link/front" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>
                                                </th>

                                                <th>
                                                    <label class="control-label"><?php echo $admin_user_details['status']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_user_details['status']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_user_details/status'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_user_details/status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>
                                                </th>


                                                <th>
                                                    <label class="control-label"><?php echo $admin_user_details['action']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_user_details['action']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_user_details/action'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_user_details/action/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>
                                                </th>

                                            </tr>
                                        </thead>

                                        <tbody aria-relevant="all" aria-live="polite" role="alert">

                                            <?php if (empty($all_data)) { ?>
                                                <tr class="odd">
                                                    <td class="dataTables" valign="top" colspan="5"><?php echo $admin_static_links['no_data_available']['front']; ?></td>
                                                </tr>
                                            <?php } ?>

                                            <?php
                                            if (isset($offset)) {
                                                $i = $offset + 1;
                                            } else {
                                                $i = 1;
                                            }
                                            if (isset($all_data)) {
                                                foreach ($all_data as $set_data) {
                                                    $timestamp = $set_data->created_date;
                                                    $splitTimeStamp = explode(" ", $timestamp);
                                                    $date = $splitTimeStamp[0];
                                                    $time = $splitTimeStamp[1];
                                            ?>
                                                    <tr class="odd">

                                                        <td class="dataTables" valign="top">
                                                            <?php echo $i; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data->company; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data->email; ?>
                                                        </td>



                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data->country; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data->telephone; ?>
                                                        </td>

                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data->customer_no; ?>
                                                        </td>

                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data->otp_code; ?>
                                                        </td>

                                                        <td class="dataTables" valign="top">
                                                            <a href="<?php echo base_url() . $this->lang->default_lang . '/user/setpassword/' . $set_data->access_token . '/reset'; ?>" target="_blank"> <?php echo $general_instruction['set_password_link']['front']; ?> </a>
                                                        </td>

                                                        <td class="dataTables" valign="top">


                                                            <select onchange="language_status('country',<?php echo $set_data->id; ?>, this.value)" class="width100px" name="martial_id">
                                                                <?php
                                                                if ($set_data->user_status == 1) {
                                                                    echo '<option value="1" selected="selected">' . $admin_static_links['active_text']['front'] . '</option>';
                                                                    echo '<option value="0">' . $admin_static_links['inactive_text']['front'] . '</option>';
                                                                } else if ($set_data->user_status == 0) {
                                                                    echo '<option value="1">' . $admin_static_links['active_text']['front'] . '</option>';
                                                                    echo '<option value="0" selected="selected">' . $admin_static_links['inactive_text']['front'] . '</option>';
                                                                }
                                                                ?>

                                                            </select>

                                                        </td>




                                                        <td class="dataTables" valign="top" class="width85px">
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/users/edit_user/<?php echo $set_data->id; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                                <?php } ?>&nbsp;&nbsp;
                                                                <a href="admin/<?php echo $lang_id; ?>/users/delete/<?php echo $set_data->id; ?>" onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    $i++;
                                                }
                                            }
                                            ?>

                                            <tr>
                                                <td colspan="17">
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
    function user_status(name, id, value) {

        $.ajax({
            type: "POST",
            url: "admin/<?php echo $lang_id; ?>/update_status",
            data: "table_name=" + name + "&id=" + id + "&status=" + value,
            beforeSend: function() {

                $("#show_class").show();
                $("#show_class").html("Loading ...");
            },
            success: function(msg) {
                var msg = "Serial Code status successfully updated. ";
                $("#show_class").html(msg);
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
                    var url = "admin/<?php echo $lang_id; ?>/orders/deleteAll";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            'block_ids': blocksarray,
                            'table': 'cart_users'
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
    function language_status(name, id, value) {
        $.ajax({
            type: "POST",
            url: "admin/<?php echo $lang_id; ?>/users/update_status",
            /* The country id will be sent to this file */
            data: "id=" + id + "&status=" + value,
            beforeSend: function() {

            },
            success: function(msg) {
                alert('<?= $admin_static_links['data_successfully_updated']['front']; ?>');
            }
        });
    }



    function confirm_box() {
        var answer = confirm("<?php echo $admin_static_links['are_you_sure']['front']; ?>");
        if (!answer)
            return false;
    }
</script>