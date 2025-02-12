
<div class="content norightmargin">
  <?php if ($this->session->flashdata('success')) {
    $msg = $this->session->flashdata('success');?>
    <div class="notice outer">
      <div class="note"><?php echo $msg; ?></div>
    </div>
  <?php }?>

  <div id="result"></div>

  <div class="outer">
    <div class="inner">
      <div class="page-header">
        <div class="body">

            <div class="container">
              <div class="block well margintop30px">
                <div class="navbar">
                  <div class="navbar-inner">
                    <h5><?php echo $admin_contact_list['users_list']['admin']; ?></h5>
                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) {?>
                        <div class="edit_text" style="display:block"></div>
                        <input type="text" value="<?php echo $admin_contact_list['users_list']['admin']; ?>" class="edit_input_text"  style="display: none;">
                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_contact_list/users_list'; ?>">
                    <?php }?>
                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_contact_list/users_list/admin" class="fancybox multi_language_common_edit admin_globe">
                        <img src="assets/uploads/global.jpg" height="20" width="20">
                    </a>

                    <div class="control-group row-fluid width50_float_left">
                      <form action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/contact/index" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="controls">
                          <input type="search" id="search" name="search" value="<?php echo $search; ?>" class="focustip span6"/>
                          <span class="red1"></span>
                          <input type="submit" id="search" value="<?php echo $admin_static_links['search']['front']; ?>" name="Submit" class="btn btn-primary"/>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <form action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/contact/delete_selected_contact_user" method="post" class="form-horizontal">
                  <div class="table-overflow">
                    <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                      <table aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">
                        <?php
if (isset($offset)) {
    $i = $offset + 1;
} else {
    $i = 1;
}
if (isset($all_data)) {?>
                          <thead>
                            <tr role="row">
                              <th colspan="1" rowspan="1"><input id="delete_all_btn" type="checkbox" name="delete_option[]" value="all"></th>
                              <th colspan="1" rowspan="1">
                                <label class="control-label"><?php echo $admin_contact_list['srno']['admin']; ?></label>
                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) {?>
                                    <div class="edit_text" style="display:block"></div>
                                    <input type="text" value="<?php echo $admin_contact_list['srno']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_contact_list/srno'; ?>">
                                <?php }?>
                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_contact_list/srno/admin" class="fancybox multi_language_common_edit admin_globe">
                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                </a>
                              </th>

                              <th colspan="1" rowspan="1">
                                <label class="control-label"><?php echo $admin_contact_list['reg_date']['admin']; ?></label>
                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) {?>
                                    <div class="edit_text" style="display:block"></div>
                                    <input type="text" value="<?php echo $admin_contact_list['reg_date']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_contact_list/reg_date'; ?>">
                                <?php }?>
                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_contact_list/reg_date/admin" class="fancybox multi_language_common_edit admin_globe">
                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                </a>
                              </th>

                              <th colspan="1" rowspan="1">
                                <label class="control-label"><?php echo $admin_contact_list['applicant']['admin']; ?></label>
                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) {?>
                                    <div class="edit_text" style="display:block"></div>
                                    <input type="text" value="<?php echo $admin_contact_list['applicant']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_contact_list/applicant'; ?>">
                                <?php }?>
                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_contact_list/applicant/admin" class="fancybox multi_language_common_edit admin_globe">
                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                </a>
                              </th>

                              <th colspan="1" rowspan="1">
                                <label class="control-label"><?php echo $admin_contact_list['email']['admin']; ?></label>
                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) {?>
                                    <div class="edit_text" style="display:block"></div>
                                    <input type="text" value="<?php echo $admin_contact_list['email']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_contact_list/email'; ?>">
                                <?php }?>
                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_contact_list/email/admin" class="fancybox multi_language_common_edit admin_globe">
                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                </a>
                              </th>

                              <th colspan="1" rowspan="1">
                                <label class="control-label"><?php echo $admin_contact_list['company']['admin']; ?></label>
                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) {?>
                                    <div class="edit_text" style="display:block"></div>
                                    <input type="text" value="<?php echo $admin_contact_list['company']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_contact_list/company'; ?>">
                                <?php }?>
                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_contact_list/company/admin" class="fancybox multi_language_common_edit admin_globe">
                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                </a>
                              </th>

                              <th colspan="1" rowspan="1">
                                <label class="control-label"><?php echo $admin_contact_list['branch']['admin']; ?></label>
                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) {?>
                                    <div class="edit_text" style="display:block"></div>
                                    <input type="text" value="<?php echo $admin_contact_list['branch']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_contact_list/branch'; ?>">
                                <?php }?>
                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_contact_list/branch/admin" class="fancybox multi_language_common_edit admin_globe">
                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                </a>
                              </th>

                              <th colspan="1" rowspan="1">
                                <label class="control-label"><?php echo $admin_contact_list['designation']['admin']; ?></label>
                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) {?>
                                    <div class="edit_text" style="display:block"></div>
                                    <input type="text" value="<?php echo $admin_contact_list['designation']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_contact_list/designation'; ?>">
                                <?php }?>
                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_contact_list/designation/admin" class="fancybox multi_language_common_edit admin_globe">
                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                </a>
                              </th>

                              <th colspan="1" rowspan="1">
                                <label class="control-label"><?php echo $admin_contact_list['contact']['admin']; ?></label>
                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) {?>
                                    <div class="edit_text" style="display:block"></div>
                                    <input type="text" value="<?php echo $admin_contact_list['contact']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_contact_list/contact'; ?>">
                                <?php }?>
                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_contact_list/contact/admin" class="fancybox multi_language_common_edit admin_globe">
                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                </a>
                              </th>

                              <th colspan="1" rowspan="1">
                                <label class="control-label"><?php echo $admin_contact_list['country']['admin']; ?></label>
                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) {?>
                                    <div class="edit_text" style="display:block"></div>
                                    <input type="text" value="<?php echo $admin_contact_list['country']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_contact_list/country'; ?>">
                                <?php }?>
                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_contact_list/country/admin" class="fancybox multi_language_common_edit admin_globe">
                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                </a>
                              </th>

                              <th colspan="1" rowspan="1">
                                <label class="control-label"><?php echo $admin_contact_list['message']['admin']; ?></label>
                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) {?>
                                    <div class="edit_text" style="display:block"></div>
                                    <input type="text" value="<?php echo $admin_contact_list['message']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_contact_list/message'; ?>">
                                <?php }?>
                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_contact_list/message/admin" class="fancybox multi_language_common_edit admin_globe">
                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                </a>
                              </th>

                              <th colspan="1" rowspan="1">
                                <label class="control-label"><?php echo $admin_contact_list['confirm']['admin']; ?></label>
                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) {?>
                                    <div class="edit_text" style="display:block"></div>
                                    <input type="text" value="<?php echo $admin_contact_list['confirm']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_contact_list/confirm'; ?>">
                                <?php }?>
                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_contact_list/confirm/admin" class="fancybox multi_language_common_edit admin_globe">
                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                </a>
                              </th>

                              <th colspan="1" rowspan="1">
                                <label class="control-label"><?php echo $admin_contact_list['option_text']['admin']; ?></label>
                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) {?>
                                    <div class="edit_text" style="display:block"></div>
                                    <input type="text" value="<?php echo $admin_contact_list['option_text']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_contact_list/option_text'; ?>">
                                <?php }?>
                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_contact_list/option_text/admin" class="fancybox multi_language_common_edit admin_globe">
                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                </a>
                              </th>

                            </tr>
                          </thead>

                          <tbody aria-relevant="all" aria-live="polite" role="alert">

                            <?php foreach ($all_data as $set_data) {
    if ($set_data['block'] == 0) {
        $date = date("Y-m-d", $set_data['create_date']);?>
                                <tr class="odd">
                                  <td class="dataTables" valign="top">
                                    <input class="blocks" type="checkbox" name="delete_option[]"
                                    value="<?php echo $set_data['id']; ?>">
                                  </td>
                                  <td class="dataTables" valign="top">
                                    <?php echo $i; ?>
                                  </td>
                                  <td class="dataTables" valign="top">
                                    <?php echo $date; ?>
                                  </td>
                                  <td class="dataTables" valign="top">
                                    <?php echo $set_data['name']; ?>
                                  </td>
                                  <td class="dataTables" valign="top">
                                    <?php echo $set_data['email']; ?>
                                  </td>
                                  <td class="dataTables" valign="top">
                                    <?php echo $set_data['company']; ?>
                                  </td>
                                  <td class="dataTables" valign="top">
                                    <?php echo $set_data['branch']; ?>
                                  </td>
                                  <td class="dataTables" valign="top">
                                    <?php echo $set_data['designation']; ?>
                                  </td>
                                  <td class="dataTables" valign="top">
                                    <?php echo $set_data['contact']; ?>
                                  </td>
                                  <td class="dataTables" valign="top">
                                    <?php echo $set_data['country']; ?>
                                  </td>
                                  <td class="dataTables" valign="top">
                                    <?php echo $set_data['message']; ?>
                                  </td>
                                  <td class="dataTables" valign="top">
                                    <?php
if ($set_data['confirm'] == 'confirm') {
            echo $admin_contact_list['confirm']['admin'];
        } else {
            echo $admin_contact_list['not_confirm']['admin'];
        }
        ?>
                                  </td>
                                  <td class="dataTables" valign="top">
                                  <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) {?>
                                    <a href="admin/<?php echo $lang_id; ?>/contact/delete_contact_user/<?php echo $set_data['id']; ?>" onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                  <?php }?>
                                  </td>
                                  </tr>
                                  <?php
                                    $i++;
}
  
}
}?>
                            <tr>
                              <td colspan="17">
                                  <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) {?>
                                      <input type="submit" id="DeleteSelected" value="<?php echo $admin_static_links['delete_selected']['front']; ?>" name="DeleteSelected" class="btn btn-primary" onclick="return confirm_box();"/>
                                  <?php }?>
                                  <?php if (isset($links)) {?>
                                      <p class="floatright"><?php echo $links; ?></p>
                                  <?php }?>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

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


    $(document).ready(function() {

$("#delete_all_btn").click(function() {
    if ($("#delete_all_btn").is(':checked')) {
        $(".blocks").prop('checked', true);
    } else {
        $(".blocks").prop('checked', false);
    }
});


});
  </script>
