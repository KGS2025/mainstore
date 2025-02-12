
<script type="text/javascript">
    function confirm_box(msg) {
        var answer = confirm(msg);
        if (!answer)
            return false;
    }

    $(document).ready(function () {
        $("#delete_all_blocks").click(function () {
            if ($("#delete_all_blocks").is(':checked')) {
                $(".blocks").prop('checked', true);
            } else {
                $(".blocks").prop('checked', false);
            }
        });
        $("#delete_checked").click(function () {
            if ($('input.blocks:checkbox:checked').length) {
                var msg = "<?php echo $admin_static_links['are_you_sure_want_to_delete_all']['front']; ?>";
                var answer = confirm(msg);
                if (answer) {
                    var blocksarray = [];
                    $('input.blocks:checkbox:checked').each(function () {
                        blocksarray.push($(this).val());
                        $(this).parents('tr').hide();
                    });

                    var url = "admin/<?php echo $lang_id; ?>/admin_blocks_list/deleteSelectedBlockUser";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {'block_ids': blocksarray},

                        success: function (data) {
                          location.reload();
                        }
                    });

                }
            } else {
                alert("<?php echo $admin_static_links['please_select_alteast_one_item']['front']; ?>");
            }

        });

    });
</script>
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
                                  <h5><?php echo $admin_block_list['admin_blocks_list']['admin']; ?></h5>
                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                    <div class="edit_text" style="display:block"></div>
                                    <input type="text" value="<?php echo $admin_block_list['admin_blocks_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_blocks_list/admin_blocks_list'; ?>">
                                  <?php } ?>
                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_blocks_list/admin_blocks_list/admin" class="fancybox multi_language_common_edit admin_globe">
                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                  </a>

                                  <div class="control-group row-fluid width50_float_left">
                                      <form action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/admin_blocks_list/index" method="post" class="form-horizontal">
                                          <div class="controls">
                                              <input type="search" id="search" name="search" value="<?php echo $search; ?>" class="focustip span6"/>
                                              <span class="red1"></span>
                                              <input type="submit" id="search" value="<?php echo $admin_static_links['search']['front']; ?>" name="Submit" class="btn btn-primary"/>
                                          </div>
                                      </form>
                                  </div>

                                    <div class="dataTables_length float-right" id="data-table_length">
                                        <label class="control-label"><?php echo $admin_block_list['reason']['admin']; ?></label>
                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                        <div class="edit_text" style="display:block"></div>
                                        <input type="text" value="<?php echo $admin_block_list['reason']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_blocks_list/reason'; ?>">
                                        <?php } ?>
                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_blocks_list/reason/admin" class="fancybox multi_language_common_edit admin_globe">
                                          <img src="assets/uploads/global.jpg" height="20" width="20" >
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                    <table aria-describedby="data-table_info" class="table table-striped dataTable"
                                           id="data-table">
                                        <thead>
                                          <tr role="row">
                                              <th colspan="1" rowspan="1"><input id="delete_all_blocks" type="checkbox"
                                                                                 name="delete_option[]" value="all"></th>
                                              <th colspan="1" rowspan="1">
                                                <label class="control-label"><?php echo $admin_block_list['srno']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_block_list['srno']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_blocks_list/srno'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_blocks_list/srno/admin" class="fancybox multi_language_common_edit admin_globe">
                                                  <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                              </th>
                                              <th colspan="1"
                                                  rowspan="1">
                                                  <label class="control-label"><?php echo $admin_block_list['code_error']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_block_list['code_error']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_blocks_list/code_error'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_blocks_list/code_error/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>
                                                </th>
                                              <th colspan="1"
                                                  rowspan="1">
                                                  <label class="control-label"><?php echo $admin_block_list['email_code_sent']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_block_list['email_code_sent']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_blocks_list/email_code_sent'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_blocks_list/email_code_sent/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                                <th colspan="1"
                                                  rowspan="1">
                                                  <label class="control-label"><?php echo $admin_block_list['sms_code_sent']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_block_list['sms_code_sent']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_blocks_list/sms_code_sent'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_blocks_list/sms_code_sent/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                              <th colspan="1"
                                                  rowspan="1">
                                                  <label class="control-label"><?php echo $admin_block_list['block_reason']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_block_list['block_reason']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_blocks_list/block_reason'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_blocks_list/block_reason/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                              <th colspan="1" rowspan="1">
                                                <label class="control-label"><?php echo $admin_block_list['section']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_block_list['section']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_blocks_list/section'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_blocks_list/section/admin" class="fancybox multi_language_common_edit admin_globe">
                                                  <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>

                                              </th>
                                              <th colspan="1"
                                                  rowspan="1">
                                                  <label class="control-label"><?php echo $admin_block_list['block_date']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_block_list['block_date']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_blocks_list/block_date'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_blocks_list/block_date/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                              <th colspan="1"
                                                  rowspan="1">
                                                  <label class="control-label"><?php echo $admin_block_list['time_remaining']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_block_list['time_remaining']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_blocks_list/time_remaining'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_blocks_list/time_remaining/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                               <th colspan="1"
                                                  rowspan="1">
                                                  <label class="control-label"><?php echo $admin_block_list['email_code']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_block_list['email_code']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_blocks_list/email_code'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_blocks_list/email_code/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                              <th colspan="1"
                                                  rowspan="1">
                                                  <label class="control-label"><?php echo $admin_block_list['sms_code']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_block_list['sms_code']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_blocks_list/sms_code'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_blocks_list/sms_code/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                              <th colspan="1"
                                                  rowspan="1">
                                                  <label class="control-label"><?php echo $admin_block_list['email']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_block_list['email']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_blocks_list/email'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_blocks_list/email/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                              <th colspan="1"
                                                  rowspan="1">
                                                  <label class="control-label"><?php echo $admin_block_list['applicant']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_block_list['applicant']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_blocks_list/applicant'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_blocks_list/applicant/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                              <th colspan="1" rowspan="1">
                                                <label class="control-label"><?php echo $admin_block_list['country']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_block_list['country']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_blocks_list/country'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_blocks_list/country/admin" class="fancybox multi_language_common_edit admin_globe">
                                                  <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>

                                              </th>
                                              <th colspan="1"
                                                  rowspan="1">
                                                  <label class="control-label"><?php echo $admin_block_list['ip_address']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_block_list['ip_address']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_blocks_list/ip_address'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_blocks_list/ip_address/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                              <th colspan="1"
                                                  rowspan="1">
                                                  <label class="control-label"><?php echo $admin_block_list['telephone']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_block_list['telephone']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_blocks_list/telephone'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_blocks_list/telephone/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                              <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                              <th colspan="1" rowspan="1">
                                                  <button id="delete_checked"><?php echo $admin_static_links['delete_all']['front']; ?></button>
                                              </th>
                                              <?php } ?>
                                          </tr>
                                        </thead>
                                        <tbody aria-relevant="all" aria-live="polite" role="alert">
                                          <?php 
                                          if(isset($offset)) { 
                                            $i = $offset + 1;
                                          }else {
                                            $i = 1;
                                          }
                                          if (!empty($all_data)) {
                                              foreach ($all_data as $set_data) { ?>
                                                  <tr class="odd">
                                                      <td class="dataTables" valign="top">
                                                          <input class="blocks" type="checkbox" name="delete_option[]" data-section="<?php echo $set_data['region']; ?>" value="<?php echo $set_data['id']; ?>">
                                                      </td>
                                                      <td class="dataTables" valign="top">
                                                          <?php echo $i; ?>
                                                      </td>
                                                      <td class="dataTables" valign="top">
                                                          <?php echo $set_data['errors']; ?>
                                                      </td>
                                                      <td class="dataTables" valign="top">
                                                          <?php echo $set_data['email_sents']; ?>
                                                      </td>
                                                      <td class="dataTables" valign="top">
                                                          <?php echo $set_data['sms_sents']; ?>
                                                      </td>
                                                      <td class="dataTables" valign="top">
                                                          <?php echo $set_data['block']; ?>
                                                      </td>
                                                      <td class="dataTables" vallign="top">
                                                          <?php echo $set_data['region']; ?>
                                                      </td>
                                                      <td class="dataTables" valign="top">
                                                          <?php if (isset($set_data['timezone']) && $set_data['timezone'] != '') {
                                                              $timezone = $set_data['timezone'];
                                                          } else {
                                                              $timezone = 'America/Los_Angeles';
                                                          }
                                                          if (isset($set_data['dte_block']) && $set_data['dte_block'] != '') {
                                                              $default_timezone = date_default_timezone_get();
                                                              $date = date('Y-m-d H:i:s', strtotime($set_data['dte_block']));
                                                              $dateTime = new DateTime($date, new DateTimeZone($default_timezone));
                                                              $dateTime->setTimezone(new DateTimeZone($timezone));
                                                              $created_time = $dateTime->format('Y-m-d H:i:s');
                                                              $created_time = strtotime($created_time);
                                                              echo date('m/d/Y', $created_time);
                                                          } else {
                                                              $default_timezone = date_default_timezone_get();
                                                              $date = date('Y-m-d H:i:s', $set_data['created_time']);
                                                              $dateTime = new DateTime($date, new DateTimeZone($default_timezone));
                                                              $dateTime->setTimezone(new DateTimeZone($timezone));
                                                              $created_time = $dateTime->format('Y-m-d H:i:s');
                                                              $created_time = strtotime($created_time);
                                                              echo date('m/d/Y', $created_time);
                                                          } ?>
                                                      </td>
                                                      <td class="dataTables" valign="top">
                                                          <?php
                                                          $int_block = strtotime($set_data['dte_block']);
                                                          $int_TR = $entry_door_timer->entry_door_block_timer['front'] - intval(((time() - $int_block) / 60));

                                                          if ($int_TR < 0)
                                                              $int_TR = 0;

                                                          echo $int_TR . $this->lang->line('minute');
                                                          ?>
                                                      </td>
                                                      <td class="dataTables" valign="top">
                                                          <?php echo $set_data['email_code']; ?>
                                                      </td>
                                                      <td class="dataTables" valign="top">
                                                          <?php echo $set_data['sms_code']; ?>
                                                      </td>
                                                      <td class="dataTables" valign="top">
                                                          <?php echo $set_data['email']; ?>
                                                      </td>
                                                      <td class="dataTables" valign="top">
                                                         <?php echo ucfirst($set_data['title']) . ' ' . ucfirst($set_data['first_name']) . ' ' . ucfirst($set_data['last_name']); ?>
                                                      </td>
                                                      <td class="dataTables" valign="top">
                                                          <?php echo $set_data['country']; ?>
                                                      </td>
                                                      <td class="dataTables" valign="top">
                                                          <?php echo $set_data['ip_address']; ?>
                                                      </td>
                                                      <td class="dataTables" valign="top">
                                                          <?php echo $set_data['telephone']; ?>
                                                      </td>
                                                      <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                      <td class="dataTables" valign="top">
                                                          <a href="admin/<?php echo $lang_id; ?>/admin_blocks_list/delete/<?php echo $set_data['id']; ?>" onclick="return confirm_box('Are you sure you want to remove This block?');"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                      </td>
                                                      <?php } ?>
                                                  </tr>
                                              <?php $i++;}
                                          } ?>

                                          <tr>
                                            <td colspan="17">
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

                </div>
                <!-- /content container -->

            </div>
        </div>
    </div>
</div>
