<div class="content zerorightmargin">
    <?php if ($this->session->flashdata('success')) {
        $msg = $this->session->flashdata('success'); ?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?>
            </div>
        </div>
    <?php } ?>
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
                        <form id="langsectionform" name="langsectionform" class="form-horizontal" method="post">
                            <input type="hidden" name="operation" value="set"/>
                            <div class="row-fluid">
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar">
                                        <div class="navbar-inner"><h5><?php echo $lang_heading_title; ?></h5>
                                                

                                            </div>
                                        </div>
                                        <?php foreach ($section_data as $option_name => $single_section) { ?>
                                            
                                            <div class="control-group">
                                            
                                                <label class="control-label"><?php echo $single_section['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $single_section['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/'.$sectionType.'/'.$option_name; ?>">
                                                <?php } ?>
                                                <a href="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageDataByCountry/'.$sectionType.'/'.$option_name.'/admin'; ?>" class="fancybox multi_language_common_edit admin_globe" target="_blank">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                                  
                                                <div class="controls">
                                                    <input class="input-field focustip span12" type="text" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> value="<?php echo $single_section['front']; ?>" name="<?php echo $sectionType."[".$option_name."]"; ?>"  >
                                                    <a href="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageDataByCountry/'.$sectionType.'/'.$option_name; ?>/front" class="fancybox multi_language_common_edit" target="_blank">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                    </a>
                                                </div>
                                            </div>
                                       
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
        $("#langsectionform").validate();
        $("[name^=<?php echo $sectionType?>]").each(function () {
            var ele = $(this).context.name;
            if(ele != 'sales_order_preview[company_fax]' && ele != 'sales_order_preview[company_email]'){
                $(this).rules("add", {
                    required: true
                });
            }
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
