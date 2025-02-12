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
    <div id="result"></div>
    <div class="outer">
        <div class="inner">
            <div class="page-header">
                
                <div class="body">

                  <form action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/language/default_language_list" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well margintop-30px">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <h5><?php echo $admin_country->default_language_list['admin']; ?></h5>

                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                        <div class="edit_text" style="display:block"></div>
                                        <input type="text" value="<?php echo $admin_country->default_language_list['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_country/default_language_list'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_country/default_language_list/admin" class="fancybox multi_language_common_edit admin_globe ">
                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                    </a>

                                    <?php if (isset($access['page_add']) && $access['page_add'] == 1) { ?>
                                        <div class="dataTables_length" id="data-table_length">
                                            <label>
                                                <div id="" class="selector">
                                                    <a class="floatright" tabindex="0"
                                                       id="data-table_first"
                                                       href="admin/<?php echo $lang_id; ?>/language/add_default_language"><?php echo $admin_static_links['static_add']['front']; ?></a>
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
                                                <th colspan="1" rowspan="1"><input type="checkbox" id="checkall" class="checkall" onchange="$('.rowitemdelete').prop('checked',this.checked);">
                                                <th colspan="1" rowspan="1">
                                                    <label class="control-label"><?php echo $admin_country->country['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_country->country['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_country/country'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_country/country/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                    
                                                <th colspan="1" rowspan="1">
                                                    <label class="control-label"><?php echo $admin_country->state['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                      <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_country->image['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_country/state'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_country/state/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>

                                                <th colspan="1" rowspan="1" >
                                                    <label class="control-label"><?php echo $admin_country->language['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                      <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_country->language['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_country/language'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_country/language/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>

                                                <th colspan="1" rowspan="1" >
                                                    <label class="control-label"><?php echo $admin_country->status['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                      <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_country->status['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_country/status'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_country/status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>

                                            </tr>
                                        </thead>

                                        <tbody aria-relevant="all" aria-live="polite" role="alert">
                                            <?php
                                            if (isset($all_data)) {
                                                foreach ($all_data as $set_data) {
                                                    ?>
                                                    <tr class="odd">
                                                        <td class="dataTables" valign="top">
                                                            <input class="rowitemdelete" type="checkbox" name="delete_option[]" value="<?php echo $set_data['id']; ?>">
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo isset($set_data['lang_countryName']) && $set_data['lang_countryName'] ? $set_data['lang_countryName'] : $set_data['countryName']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo isset($set_data['lang_stateName']) && $set_data['lang_stateName'] ? $set_data['lang_stateName'] : $set_data['stateName']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo isset($set_data['languageName']) ? $set_data['languageName'] : ''; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <select onchange="language_status('default_language',<?php echo $set_data['id']; ?>, this.value)" class="width100px" name="martial_id">
                                                                <?php if ($set_data['status'] == 1) {
                                                                    echo '<option value="1" selected="selected">' . $admin_static_links['active_text']['front'] . '</option>';
                                                                    echo '<option value="0">' . $admin_static_links['inactive_text']['front'] . '</option>';
                                                                } else if ($set_data['status'] == 0) {
                                                                    echo '<option value="1">' . $admin_static_links['active_text']['front'] . '</option>';
                                                                    echo '<option value="0" selected="selected">' . $admin_static_links['inactive_text']['front'] . '</option>';
                                                                } ?>
                                                            </select>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                            <a href="admin/<?php echo $lang_id; ?>/language/edit_default_language/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/language/delete_default_language/<?php echo $set_data['id']; ?>" onclick="return confirm_box_single();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="17">
                                                    <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                      <input type="submit" id="DeleteSelected" value="<?php echo $admin_static_links['delete_selected']['front']; ?>" name="DeleteSelected" class="btn btn-primary" onclick="return confirm_box_selected();"/>
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

<script>
function language_status(name, id, value) {
   $.ajax({
       type: "POST",
       url: "admin/<?php echo $lang_id; ?>/language/update_status", /* The country id will be sent to this file */
       data: "table_name=" + name + "&id=" + id + "&status=" + value,
       beforeSend: function () {

       },
       success: function (msg) {
        alert('<?= $admin_static_links['data_successfully_updated']['front'];?>');
       }
   });
}

function confirm_box_single() {
    var answer = confirm("Are you sure?");
    if (!answer)
        return false;
}

function confirm_box_selected() {
    if ($('input.rowitemdelete:checkbox:checked').length) {
      var msg = "<?php echo $admin_static_links['are_you_sure_want_to_delete_all']['front']; ?>";
      var answer = confirm(msg);
      if (!answer)
        return false;
    } else {
      alert('<?php echo $admin_static_links['please_select_alteast_one_item']['front']; ?>');
      return false;
    }
  }
</script>
