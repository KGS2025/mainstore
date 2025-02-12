<div class="content zerorightmargin">
    <?php if ($this->session->flashdata('success')) {
        $msg = $this->session->flashdata('success'); ?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?>
            </div>
        </div>
    <?php } ?>
    <div id="show_class" class="note displaynon"></div>
    <div id="result"></div>
    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <div class="body">

                <form action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/countries/index" method="post" enctype="multipart/form-data">    
                    <div class="container">
                        <div class="block well margintop-30px">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <h5> <?= $lang_data['countries_list']['admin'];?></h5>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display:block"></div>
                                        <input type="text" value="<?php echo $lang_data['countries_list']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/countries/countries_list'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/countries/countries_list/admin" class="fancybox multi_language_common_edit admin_globe">
                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                    </a>

                                    <div class="control-group row-fluid width50_float_left">
                                        <form action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/countries/index" method="post"
                                            enctype="multipart/form-data" class="form-horizontal">
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
                                                    <a class="floatright" tabindex="0"
                                                       id="data-table_first" href="admin/<?php echo $lang_id; ?>/countries/add_countries"><?php echo $admin_static_links['static_add']['front']; ?></a>
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
                                                <th><input type="checkbox" id="checkall" class="checkall" onchange="$('.rowitemdelete').prop('checked', this.checked);">
                                                </th>

                                                <th>
                                                    <label class="control-label"><?php echo $lang_data['srno']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $lang_data['srno']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/countries/srno'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/countries/srno/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>

                                                <th>
                                                    <label class="control-label"><?php echo $lang_data['country_name']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $lang_data['country_name']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/countries/country_name'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/countries/country_name/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>

                                                <th>
                                                    <label class="control-label"><?php echo $lang_data['country_alpha_2']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $lang_data['country_alpha_2']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/countries/country_alpha_2' ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/countries/country_alpha_2/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>

                                                <th>
                                                    <label class="control-label"><?php echo $lang_data['country_alpha_3']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $lang_data['country_alpha_3']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/countries/country_alpha_3'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/countries/country_alpha_3/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>

                                                <th>
                                                    <label class="control-label"><?php echo $lang_data['country_code']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $lang_data['country_code']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/countries/country_code'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/countries/country_code/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </th>

                                                <th>
                                                    <label class="control-label"><?php echo $lang_data['country_status']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $lang_data['country_status']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/countries/country_status'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/countries/country_status/admin" class="fancybox multi_language_common_edit admin_globe">
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
                                                        <td><input type="checkbox" id="checkitem" class="rowitemdelete" name="deleteitem[]" value="<?php echo $set_data['id']; ?>"></td>

                                                        <td class="dataTables" valign="top">
                                                            <?php echo $i; ?>
                                                        </td>

                                                        <td class="dataTables" valign="top">
                                                            <?php if(isset($set_data['lang_countryName']) && $set_data['lang_countryName'] != '') { ?>
                                                                <?php echo $set_data['lang_countryName']; ?>
                                                            <?php } else { ?>
                                                                <?php echo $set_data['countryName']; ?>
                                                            <?php } ?>
                                                        </td>

                                                        <td class="dataTables" valign="top"> <?= $set_data['alpha_2']; ?> </td>

                                                        <td class="dataTables" valign="top"> <?= $set_data['alpha_3']; ?> </td>

                                                        <td class="dataTables" valign="top"> <?= $set_data['country_code']; ?> </td>

                                                        <td class="dataTables" valign="top"> <?= $set_data['status'] == 1 ? $lang_data['country_active']['admin'] : $lang_data['country_inactive']['admin']; ?> </td>

                                                        <td class="dataTables" valign="top">
                                                            <?php if (isset($access['page_edit']) && $access['page_edit'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/countries/edit_countries/<?php echo $set_data['id']; ?>"><?php echo $admin_static_links['static_edit']['front']; ?></a>&nbsp;&nbsp;
                                                            <?php } ?>
                                                            <?php if (isset($access['page_delete']) && $access['page_delete'] == 1) { ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/countries/delete_countries/<?php echo $set_data['id']; ?>" onclick="return confirm_box();"><?php echo $admin_static_links['static_delete']['front']; ?></a>
                                                               <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php $i++; }
                                            } ?>

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
                    </div>
                    </form>
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
</script>
