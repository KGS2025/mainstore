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
                        <form id="adminRoleForm" name="adminRoleForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set"/>
                            <input type="hidden" id="roleId" value="<?= isset($edit_data['id']) ? $edit_data['id'] : '';?>"/>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5><?= isset($edit_data) ? $admin_admin_roles['edit_admin_role']['admin'] : $admin_admin_roles['add_admin_role']['admin']; ?></h5>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_admin_roles['edit_admin_role']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_roles/edit_admin_role'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_roles/edit_admin_role/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_admin_roles['add_role']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_admin_roles['add_role']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_roles/add_role'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_roles/add_role/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <input id="role" name="roles" class="focustip span12" type="text" value="<?php if(isset($edit_data['lang_role']) && $edit_data['lang_role'] != '') { echo $edit_data['lang_role']; } else if(isset($edit_data['role'])) { echo $edit_data['role']; } ?>" <?php echo ($lang_id != $primary_lang || (isset($edit_data['role']) && $edit_data['role'] == 'Administrator')) ? "readonly" : ""; ?>>
                                                <?php if(isset($edit_data['id'])){?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $edit_data['id']; ?>/admin_roles_country/role" class="fancybox multi_language_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                <?php } ?>
                                            </div>
                                            <span class="red1"><?php echo form_error('role'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_admin_roles['page_access']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?>
                                                <div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_admin_roles['page_access']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_roles/page_access'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_roles/page_access/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>

                                            <div class="controls">
                                                <table class="table" id="accesspage">
                                                    <thead>
                                                        <tr>
                                                            <th><input type="checkbox" id="checkall" class="checkall"/>&nbsp;
                                                                <label class="control-label"><?php echo $admin_admin_roles['select_all']['admin']; ?></label>
                                                                <?php if ($lang_id == $primary_lang) { ?>
                                                                    <div class="edit_text" style="display:block"></div>
                                                                    <input type="text" value="<?php echo $admin_admin_roles['select_all']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_roles/select_all'; ?>">
                                                                <?php } ?>
                                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_roles/select_all/admin" class="fancybox multi_language_common_edit admin_globe">
                                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                                </a>
                                                            </th>

                                                            <th>
                                                                <label class="control-label"><?php echo $admin_admin_roles['page_name']['admin']; ?></label>
                                                                <?php if ($lang_id == $primary_lang) { ?>
                                                                    <div class="edit_text" style="display:block"></div>
                                                                    <input type="text" value="<?php echo $admin_admin_roles['page_name']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_roles/page_name'; ?>">
                                                                <?php } ?>
                                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_roles/page_name/admin" class="fancybox multi_language_common_edit admin_globe">
                                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                                </a>
                                                            </th>

                                                            <th>
                                                                <label class="control-label"><?php echo $admin_admin_roles['access']['admin']; ?></label>
                                                                <?php if ($lang_id == $primary_lang) { ?>
                                                                    <div class="edit_text" style="display:block"></div>
                                                                    <input type="text" value="<?php echo $admin_admin_roles['access']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_roles/access'; ?>">
                                                                <?php } ?>
                                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_roles/access/admin" class="fancybox multi_language_common_edit admin_globe">
                                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                                </a>
                                                            </th>

                                                            <th>
                                                                <label class="control-label"><?php echo $admin_admin_roles['add_list']['admin']; ?></label>
                                                                <?php if ($lang_id == $primary_lang) { ?>
                                                                    <div class="edit_text" style="display:block"></div>
                                                                    <input type="text" value="<?php echo $admin_admin_roles['add_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_roles/add_list'; ?>">
                                                                <?php } ?>
                                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_roles/add_list/admin" class="fancybox multi_language_common_edit admin_globe">
                                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                                </a>
                                                            </th>

                                                            <th>
                                                                <label class="control-label"><?php echo $admin_admin_roles['edit_list']['admin']; ?></label>
                                                                <?php if ($lang_id == $primary_lang) { ?>
                                                                    <div class="edit_text" style="display:block"></div>
                                                                    <input type="text" value="<?php echo $admin_admin_roles['edit_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_roles/edit_list'; ?>">
                                                                <?php } ?>
                                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_roles/edit_list/admin" class="fancybox multi_language_common_edit admin_globe">
                                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                                </a>
                                                            </th>

                                                            <th>
                                                                <label class="control-label"><?php echo $admin_admin_roles['delete_list']['admin']; ?></label>
                                                                <?php if ($lang_id == $primary_lang) { ?>
                                                                    <div class="edit_text" style="display:block"></div>
                                                                    <input type="text" value="<?php echo $admin_admin_roles['delete_list']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_admin_roles/delete_list'; ?>">
                                                                <?php } ?>
                                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_admin_roles/delete_list/admin" class="fancybox multi_language_common_edit admin_globe">
                                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                                </a>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1;
                                                        foreach ($pages as $key => $value) {
                                                            if($key != 'id' && $key != 'country_id' && !is_numeric(strpos($key,'lang_'))) { 
                                                                $page_access    = isset($userAccess[$key]['page_access']) ? $userAccess[$key]['page_access'] : 0;
                                                                $page_add       = isset($userAccess[$key]['page_add']) ? $userAccess[$key]['page_add'] : 0;
                                                                $page_edit      = isset($userAccess[$key]['page_edit']) ? $userAccess[$key]['page_edit'] : 0;
                                                                $page_delete    = isset($userAccess[$key]['page_delete']) ? $userAccess[$key]['page_delete'] : 0;
                                                                ?>
                                                                <tr id="row_<?php echo $i.strpos($key,'lang'); ?>">
                                                                    <td><input type="checkbox" class="rowitem" id="rowitem_<?php echo $i; ?>" name="pageaccess[<?php echo $i; ?>][select]" onchange="$('.rowinneritem_<?php echo $i; ?>').prop('checked', this.checked);" value="1"  <?php if ($page_access == 1 || $page_add == 1 || $page_edit == 1 || $page_delete == 1) { echo "checked=checked"; } ?>/></td>
                                                                    <td>
                                                                        <input type="hidden" class="accessrow rowinneritem_<?php echo $i; ?>" name="pageaccess[<?php echo $i; ?>][page]" value="<?php echo $key; ?>" />
                                                                        <input type="hidden" class="accessrow rowinneritem_<?php echo $i; ?>" name="pageaccess[<?php echo $i; ?>][pagename]" value="<?php echo $value['admin']; ?>" />
                                                                        <p><?php echo $value['admin']; ?></p>
                                                                    <?php if ($lang_id == $primary_lang) { ?>
                                                                        <div class="edit_text" style="display:block"></div>
                                                                        <input type="text" value="<?php echo $value['admin']; ?>" class="edit_input_text" style="display: none;">
                                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_role_page/' . $key; ?>">
                                                                    <?php } ?>
                                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_role_page/<?php echo $key; ?>/admin" class="fancybox multi_language_common_edit admin_globe">
                                                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                                        </a>
                                                                    </td>

                                                                    <td>
                                                                        <input type="checkbox" class="accessrow rowinneritem_<?php echo $i; ?>" name="pageaccess[<?php echo $i; ?>][page_access]" value="1" <?php if ($page_access == 1) { echo "checked=checked"; } ?> />
                                                                    </td>

                                                                    <td>
                                                                        <input type="checkbox" class="accessrow rowinneritem_<?php echo $i; ?>" name="pageaccess[<?php echo $i; ?>][page_add]" value="1" <?php if ($page_add == 1) { echo "checked=checked"; } ?> />
                                                                    </td>

                                                                    <td>
                                                                        <input type="checkbox" class="accessrow rowinneritem_<?php echo $i; ?>" name="pageaccess[<?php echo $i; ?>][page_edit]" value="1" <?php if ($page_edit == 1) { echo "checked=checked"; } ?> />
                                                                    </td>

                                                                    <td>
                                                                        <input type="checkbox" class="accessrow rowinneritem_<?php echo $i; ?>" name="pageaccess[<?php echo $i; ?>][page_delete]" value="1" <?php if ($page_delete == 1) { echo "checked=checked"; } ?> />
                                                                    </td>
                                                                </tr>
                                                            <?php $i++; }
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
                                        <?php if ($addscripts == 'edit_adminrole'){?>
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
                            </div>
                        </form>

                        <script>
                            $(document).ready(function () {
                                $("#adminRoleForm").validate({
                                    rules: {
                                        role: {
                                            required: true,
                                            email: true,
                                            remote: {
                                                url: "<?php echo base_url() . 'admin/' . $lang_id . '/adminrole/checkRoleExists/'; ?>/"+$('#roleId').val(),
                                                type: "post",
                                                data: {
                                                    email: function () {
                                                        return $("#role").val();
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    messages: {
                                        role: {
                                            required: "<?php echo $admin_static_links['please_enter_role']['front']; ?>",
                                            remote: "<?php echo $admin_static_links['role_already_exists']['front']; ?>"
                                        }
                                    }
                                });
                            });
                            $('#accesspage').on('click', '#checkall', function () {
                                $('.rowitem').prop('checked', this.checked);

                                $(".rowitem").each(function () {
                                    var id = $(this).attr('id');
                                    var a = id.split('_');
                                    $('.rowinneritem_' + a[1]).prop('checked', this.checked);
                                });

                            });

                            $('#accesspage').on('click', '.accessrow', function () {
                                var classes = $(this).attr('class');
                                var arr = classes.split(' ');
                                var a = arr[1].split('_');
                                if ($("#rowitem_" + a[1]).is(':checked')) {
                                    var flag = 0;
                                    $(".rowinneritem_" + a[1]).each(function () {
                                        if ($(this).is(':checked')) {
                                            flag = 1;
                                        }
                                    });

                                    if (flag == 0) {
                                        $("#rowitem_" + a[1]).prop('checked', false);
                                    }
                                } else {
                                    var flag = 0;
                                    $(".rowinneritem_" + a[1]).each(function () {
                                        if ($(this).is(':checked')) {
                                            flag = 1;
                                        }
                                    });

                                    if (flag == 1) {
                                        $("#rowitem_" + a[1]).prop('checked', true);
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
