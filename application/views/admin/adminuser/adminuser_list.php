

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

                    <form action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/adminuser/delete_selected_adminuser" method="post"> 
                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well margintop-30px">
                            <div class="navbar">
                                <div class="navbar-inner">
                                  <h5><?php echo $admin_admin_users['admin_users']['admin']; ?></h5>
                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                  <div class="edit_text" style="display:block"></div>
                                  <input type="text" value="<?php echo $admin_admin_users['admin_users']['admin']; ?>" class="edit_input_text" style="display: none;">
                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/admin_users'; ?>">
                                  <?php } ?>
                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/admin_users/admin" class="fancybox multi_language_common_edit admin_globe">
                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                  </a>

                                    
                                    <?php if (isset($access['page_add']) && $access['page_add'] == 1) { ?>
                                        <div class="dataTables_length" id="data-table_length">
                                            <label>
                                                <div id="" class="selector">
                                                    <a class="floatright" tabindex="0"
                                                       id="data-table_first" href="admin/<?php echo $lang_id; ?>/adminuser/add_adminuser"><?php echo $admin_static_links['static_add']['front']; ?></a>
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
                                                <th><input type="checkbox" id="checkall" class="checkall"
                                                           onchange="$('.rowitemdelete').prop('checked', this.checked);">
                                                </th>
                                                <th>
                                                  <label class="control-label"><?php echo $admin_admin_users['srno']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_admin_users['srno']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/srno'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/srno/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                                <th>
                                                  <label class="control-label"><?php echo $admin_admin_users['name_list']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_admin_users['name_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/name_list'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/name_list/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                                <th>
                                                  <label class="control-label"><?php echo $admin_admin_users['email_list']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_admin_users['email_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/email_list'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/email_list/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                                <th>
                                                  <label class="control-label"><?php echo $admin_admin_users['country']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_admin_users['country']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/country'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/country/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                                <th>
                                                  <label class="control-label"><?php echo $admin_admin_users['country_code_list']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_admin_users['country_code_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/country_code_list'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/country_code_list/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                                <th>
                                                  <label class="control-label"><?php echo $admin_admin_users['telephone']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_admin_users['telephone']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/telephonet'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/telephone/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                                <th>
                                                  <label class="control-label"><?php echo $admin_admin_users['admin_role_list']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_admin_users['admin_role_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/admin_role_list'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/admin_role_list/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                                <th>
                                                  <label class="control-label"><?php echo $admin_admin_users['status']['admin']; ?></label>
                                                  <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_admin_users['status']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_users/status'; ?>">
                                                  <?php } ?>
                                                  <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_users/status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                  </a>

                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody aria-relevant="all" aria-live="polite" role="alert">
                                            <?php if (empty($all_data)) { ?>
                                                <tr class="odd">
                                                    <td class="dataTables" valign="top" colspan="9"><?php echo $admin_static_links['no_data_available']['front']; ?></td>
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
                                                    ?>
                                                    <tr class="odd">
                                                        <td><input type="checkbox" id="checkitem" class="rowitemdelete"
                                                                   name="deleteitem[]"
                                                                   value="<?php echo $set_data['id']; ?>"></td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $i; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['title'] . ' ' . ucfirst($set_data['first_name']) . ' ' . ucfirst($set_data['last_name']); ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">

                                                            <?php echo $set_data['email']; ?>

                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['country']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['country_code']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['telephone']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="Role">
                                                            <?php if(isset($set_data['lang_role']) && $set_data['lang_role'] != '') { ?>
                                                                <?php echo $set_data['lang_role']; ?>
                                                            <?php } else { ?>
                                                                <?php echo $set_data['role']; ?>
                                                            <?php } ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php
                                                            if ($set_data['status'] == "0") {
                                                                echo $admin_static_links['inactive_text']['front'];
                                                            } else {
                                                                echo $admin_static_links['active_text']['front'];
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/adminuser/edit_adminuser/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/adminuser/delete_adminuser/<?php echo $set_data['id']; ?>"
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
                                                        <?php } ?>
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
