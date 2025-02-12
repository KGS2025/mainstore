
<script type="text/javascript">
    function confirm_box(msg) {
        var answer = confirm(msg);
        if (!answer)
            return false;
    }
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
                                    <h5><?php echo $admin_users_front_entry_door['user_list_front_door']['admin']; ?></h5>
                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                        <div class="edit_text" style="display:block"></div>
                                        <input type="text" value="<?php echo $admin_users_front_entry_door['user_list_front_door']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_users_front_entry_door/user_list_front_door'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_users_front_entry_door/user_list_front_door/admin" class="fancybox multi_language_common_edit admin_globe">
                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                    </a>
                                    <div class="control-group row-fluid width50_float_left">
                                        <form action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/users_front_entry_door/index" method="post"
                                            enctype="multipart/form-data" class="form-horizontal">
                                            <div class="controls">
                                                <input type="search" id="search" name="search" value="<?php echo $search; ?>" class="focustip span6"/>
                                                <span class="red1"></span>
                                                <input type="submit" id="search" value="<?php echo $admin_static_links['search']['front']; ?>" name="Submit" class="btn btn-primary"/>
                                            </div>
                                        </form>
                                    </div>
                                    <?php if (isset($access['page_access']) && $access['page_access'] == 1) { ?>
                                        <div class="dataTables_length" id="data-table_length">

                            
                                            <form method="post">
                                                <button type="submit" name="submit" value="downloadcsv" class="btn btn-primary"><?php echo $admin_static_links['download_users_list']['front']; ?></button>
                                            </form>
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
                                                <th colspan="1" rowspan="1">
                                                    <label class="control-label"><?php echo $admin_users_front_entry_door['slno']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_users_front_entry_door['slno']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_users_front_entry_door/slno'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_users_front_entry_door/slno/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>

                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_users_front_entry_door['ip_address']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_users_front_entry_door['ip_address']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_users_front_entry_door/ip_address'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_users_front_entry_door/ip_address/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>

                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_users_front_entry_door['time_surfing']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_users_front_entry_door['time_surfing']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_users_front_entry_door/time_surfing'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_users_front_entry_door/time_surfing/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>

                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_users_front_entry_door['date_front_door']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_users_front_entry_door['date_front_door']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_users_front_entry_door/date_front_door'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_users_front_entry_door/date_front_door/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>

                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_users_front_entry_door['applicant']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_users_front_entry_door['applicant']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_users_front_entry_door/applicant'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_users_front_entry_door/applicant/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>

                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_users_front_entry_door['email']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_users_front_entry_door['email']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_users_front_entry_door/email'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_users_front_entry_door/email/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>

                                                </th>
                                                <th colspan="1" rowspan="1">
                                                    <label class="control-label"><?php echo $admin_users_front_entry_door['country']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_users_front_entry_door['country']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_users_front_entry_door/country'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_users_front_entry_door/country/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>

                                                </th>
                                                <th colspan="1"
                                                    rowspan="1">
                                                    <label class="control-label"><?php echo $admin_users_front_entry_door['cellphone']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_users_front_entry_door['cellphone']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_users_front_entry_door/cellphone'; ?>">
                                                    <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_users_front_entry_door/cellphone/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>

                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody aria-relevant="all" aria-live="polite" role="alert">
                                            <?php
                                            if(isset($offset)) {
                                                $i = $offset + 1;
                                            }
                                            else {
                                                $i = 1;
                                            }
                                            if (!empty($all_data)) {
                                                foreach ($all_data as $set_data) {
                                                    ?>
                                                    <tr class="odd">
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $i; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['ip_address']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php
                                                            if (isset($set_data['timezone']) && $set_data['timezone'] != '') {
                                                                $timezone = $set_data['timezone'];
                                                            } else {
                                                                $timezone = 'America/Los_Angeles';
                                                            }
                                                            if (isset($set_data['sessionendtime']) && $set_data['sessionendtime'] != '') {
                                                                $default_timezone = date_default_timezone_get();
                                                                $date = date('Y-m-d H:i:s', $set_data['created_time']);
                                                                $dateTime = new DateTime($date, new DateTimeZone($default_timezone));
                                                                $dateTime->setTimezone(new DateTimeZone($timezone));
                                                                $created_time = $dateTime->format('Y-m-d H:i:s');

                                                                $created_time = strtotime($created_time);
                                                                $time1 = date('H:i:s', $created_time);


                                                                $date1 = date('Y-m-d H:i:s', $set_data['sessionendtime']);
                                                                $dateTime1 = new DateTime($date1, new DateTimeZone($default_timezone));
                                                                $dateTime1->setTimezone(new DateTimeZone($timezone));
                                                                $created_time1 = $dateTime1->format('Y-m-d H:i:s');

                                                                $created_time1 = strtotime($created_time1);
                                                                $time2 = date('H:i:s', $created_time1);
                                                                echo 'From ' . $time1 . ' to ' . $time2;
                                                            } else {
                                                                $default_timezone = date_default_timezone_get();
                                                                $date = date('Y-m-d H:i:s', $set_data['created_time']);
                                                                $dateTime = new DateTime($date, new DateTimeZone($default_timezone));
                                                                $dateTime->setTimezone(new DateTimeZone($timezone));
                                                                $created_time = $dateTime->format('Y-m-d H:i:s');

                                                                $created_time = strtotime($created_time);
                                                                $time1 = date('H:i:s', $created_time);

                                                                $timeend = '+ ' . $set_data['shopping_timer'] . ' minutes';
                                                                $time2 = date("H:i:s", strtotime($timeend, $created_time));
                                                                $int_TR = $set_data['shopping_timer'] - intval(((time() - $set_data['created_time']) / 60));

                                                                if ($int_TR > 0) {
                                                                    echo 'From ' . $time1 . ' to Ongoing';
                                                                } else {
                                                                    echo 'From ' . $time1 . ' to ' . $time2;
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo date('m/d/Y', $created_time); ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['applicant']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['email']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['country']; ?>
                                                        </td>

                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['telephone']; ?>
                                                        </td>
                                                    </tr>
                                                    <?php $i++;
                                                }
                                            }
                                            ?>
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
