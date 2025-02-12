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
    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <!-- page title -->
            <!--    <h5><i class="font-user"></i>General Instruction</h5> -->
                <!-- End page title -->
                <div class="body">
                    <!-- Content container -->
                    <div class="container">
                        <!-- Pickers -->
                        <form id="addUpsErrors" name="addUpsErrors" class="form-horizontal" method="post">
                            <input type="hidden" name="operation" value="set"/>
                            <div class="row-fluid">
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                              <h5><?php echo $admin_static_links['ups_errors']['front']; ?></h5>
                                              <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?><div class="edit_text" style="display:block"></div>
                                              <input type="text" value="<?php echo $admin_static_links['ups_errors']['front']; ?>" class="edit_input_text" style="display: none;">
                                              <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_static_links/ups_errors/front'; ?>">
                                              <?php } ?><a href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_static_links/ups_errors/front" class="fancybox multi_language_common_edit admin_globe" target="_blank">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                              </a>
                                            </div>
                                        </div>
                                        <?php foreach ($ups_errors as $ups_error) { ?>
                                            <?php if ((!strpos($ups_error['error_text'], 'COD') !== false) && (!strpos($ups_error['error_text'], 'attrName') !== false) && (!strpos($ups_error['error_text'], 'pallet') !== false) && (!strpos($ups_error['error_text'], 'localOverSize1MinWeight') !== false)) { ?>
                                            <div class="control-group">
                                                
                                                <?php foreach($admin_ups_errors as $admin_ups_error) { ?>
                                                        <?php if($ups_error['id'] == $admin_ups_error['id']) { ?>
                                                                <label class="control-label"><?php echo $admin_ups_error['error_text']; ?></label>
                                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                                <div class="edit_text" style="display:block"></div>
                                                                <input type="text" value="<?php echo $admin_ups_error['error_text']; ?>" class="edit_input_text" style="display: none;">
                                                                <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/index/saveLanguagedData/' . $admin_ups_error['id'] . '/admin_ups_errors/error_text'; ?>">
                                                                <?php } ?>
                                                                <a href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $admin_ups_error['id']; ?>/admin_ups_errors_country/error_text" class="fancybox multi_language_edit admin_globe" target="_blank">
                                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                                </a>
                                                        <?php } ?>
                                                <?php } ?>

                                                <div class="controls">
                                                    <input name="ups_errors[<?php echo $ups_error['id']; ?>]" class="input-field focustip span12" type="text" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> value="<?php echo $ups_error['error_text']; ?>">
                                                    <a href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $ups_error['id']; ?>/ups_errors_country/error_text" class="fancybox multi_language_edit" target="_blank">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php } ?>
                                    </div>
                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                    <div class="form-actions align-right">
                                        <input class="btn btn-primary form-submit" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                    </div>
                                  <?php } ?>
                                </div>
                            </div>
                            <!-- /column -->
                        </form>
                    </div>
                    <!-- /pickers -->
                </div>
                <!-- /content container -->
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#addUpsErrors").validate();
        $("[name^=ups_errors]").each(function () {
            $(this).rules("add", {
                required: true
            });
        });

        $(document).on('keyup','.input-field',function(){
            $(this).addClass('data-edit');
        });

        $(document).on('click','.form-submit',function(){
            $('.input-field').attr('disabled',true);
            $('.data-edit').removeAttr('disabled');
        });
    });
</script>
