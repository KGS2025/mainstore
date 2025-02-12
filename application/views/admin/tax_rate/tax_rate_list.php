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
                <!-- page title -->

                <!-- End page title -->
                <div class="body">
                    <form action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/tax_rate" method="post" enctype="multipart/form-data" class="form-horizontal">

                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well margintop-30px">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <h5>
                                        <?php echo $admin_tax_rate['tax_rate']['admin']; ?>
                                    </h5>
                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                        <input type="text" value="<?php echo $admin_tax_rate['tax_rate']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tax_rate/tax_rate'; ?>">
                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tax_rate/tax_rate/admin" class="fancybox multi_language_common_edit admin_globe">
                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                    </a>
                                        
                                    <div class="control-group row-fluid">
                                        <div class="controls"><input type="search" id="search" name="search" value="<?php echo $searchText; ?>" class="focustip span6"/>
                                            <span class="red1"></span>
                                            <input type="submit" id="search" value="<?php echo $admin_static_links['search']['front']; ?>" name="Submit" class="btn btn-primary"/>
                                        </div>

                                    </div>
                                        
                                    <?php if (isset($access['page_add']) && $access['page_add'] == 1) { ?>
                                        <div class="dataTables_length" id="data-table_length">
                                            <label>
                                                <div id="" class="selector">
                                                    <a class="floatright" tabindex="0"
                                                       id="data-table_first" href="admin/<?php echo $lang_id; ?>/tax_rate/add_tax_rate"><?php echo $admin_static_links['static_add']['front']; ?></a>
                                                </div>
                                                <div id="" class="selector">
                                                    <a class="floatright" tabindex="0"
                                                       id="data-table_first" href="admin/<?php echo $lang_id; ?>/tax_rate/tax_rate_import"><?php echo $admin_static_links['import_tax_rate']['front']; ?></a>
                                                    
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
                                                    <label class="control-label"><?php echo $admin_tax_rate['srno']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_tax_rate['srno']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tax_rate/srno'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tax_rate/srno/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_tax_rate['tax_base_rate']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_tax_rate['tax_base_rate']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tax_rate/tax_base_rate'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tax_rate/tax_base_rate/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_tax_rate['country_code']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_tax_rate['country_code']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tax_rate/country_code'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tax_rate/country_code/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_tax_rate['state_code']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_tax_rate['state_code']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tax_rate/state_code'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tax_rate/state_code/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_tax_rate['zip']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_tax_rate['zip']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tax_rate/zip'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tax_rate/zip/admin" class="fancybox multi_language_common_edit admin_globe">
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
                                                            <?php echo $set_data['tax_base_rate']; ?>          
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo strtoupper($set_data['country_code']); ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['state_code']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['zip']; ?>
                                                        </td>
                                                        
                                                        <td class="dataTables" valign="top">
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/tax_rate/edit_tax_rate/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/tax_rate/delete_tax_rate/<?php echo $set_data['id']; ?>"
                                                                   onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>&nbsp;&nbsp;
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
