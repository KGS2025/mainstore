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
                <!-- page title -->
                <h5>
                    <?php echo $admin_user_details['user_detail']['admin']; ?>
                </h5>
                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                    <div class="edit_text" style="display:block"></div>
                    <input type="text" value="<?php echo $admin_user_details['user_detail']['admin']; ?>" class="edit_input_text" style="display: none;">
                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_user_details/user_detail'; ?>">
                <?php } ?>
                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_user_details/user_detail/admin" class="fancybox multi_language_common_edit admin_globe">
                    <img src="assets/uploads/global.jpg" height="20" width="20">
                </a>

                <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well margintop-30px">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <h5>
                                        <?php echo $admin_user_details['user_info_page']['admin']; ?>
                                    </h5>
                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                        <div class="edit_text" style="display:block"></div>
                                        <input type="text" value="<?php echo $admin_user_details['user_info_page']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_user_details/user_info_page'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_user_details/user_info_page/admin" class="fancybox multi_language_common_edit admin_globe">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                </div>
                            </div>
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                    <div class="MainHeadDetailsBlock">
                                        <?php foreach ($main_data as $user_data) { ?>
                                            <div class="LeftPanel">
                                                <div>
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_user_details['company']['admin'] . ': '; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_user_details['company']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_user_details/company'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_user_details/company/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                    <?php echo $user_data->company; ?>
                                                </div>
                                                <div>
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_user_details['email']['admin'] . ': '; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_user_details['email']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_user_details/email'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_user_details/email/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                    <?php echo $user_data->email; ?>
                                                </div>
                                                <div>
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_user_details['country']['admin'] . ': '; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_user_details['country']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_user_details/country'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_user_details/country/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                    <?php echo $user_data->country; ?>
                                                </div>
                                                <div>
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_user_details['telephone']['admin'] . ': '; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_user_details['telephone']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_user_details/telephone'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_user_details/telephone/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                    <?php echo $user_data->telephone; ?>
                                                </div>



                                            </div>


                                            <div class="RightPanel">



                                                <div>
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_user_details['incoterms']['admin'] . ': '; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_user_details['incoterms ']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_user_details/incoterms'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_user_details/incoterms/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                    <?php echo $user_data->incoterms; ?>
                                                </div>
                                                
                                                <?php if (isset($user_data->tax_exoneration_number) && $user_data->tax_exoneration_number != '') { ?>
                                                    <div>
                                                        <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_user_details['tax_exoneration_number']['admin'] . ': '; ?></label>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_user_details['tax_exoneration_number']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_user_details/tax_exoneration_number'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_user_details/tax_exoneration_number/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>

                                                        <?php echo $user_data->tax_exoneration_number; ?>
                                                    </div>
                                                <?php } ?>



                                            </div>
                                            <div class="clear"></div>
                                        <?php } ?>
                                    </div>
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
    $(document).ready(function(e) {
        $("#open_download_image").click(function() {
            $("#download_packagelist").hide();
            $("#download_image").show();
        });

        $("#open_download_packagelist").click(function() {
            $("#download_image").hide();
            $("#download_packagelist").show();
        });
    });
</script>