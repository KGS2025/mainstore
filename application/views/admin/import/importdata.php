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
    <?php
    if ($this->session->flashdata('error')) {
        $msg = $this->session->flashdata('error');
    ?>
        <div class="notice outer">
            <div class="error"><?php echo $msg; ?>

            </div>
        </div>
    <?php
    }
    ?>
<div class="notice outer" id="ar_cron_success" style="display:none">
    <div class="note"  id="ar_cron_success_msg">Data processed successfully.</div>
</div>
    <div class="notice outer displaynon outer_message">
        <div class="note product_fileMessage">
        </div>
    </div>


    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <div class="body">


                    <!-- Content container -->
                    <div class="container">

                        <!-- Pickers -->

                        <div class="row-fluid">

                            <!-- Column -->
                            <div class="span12">
                                <!-- Time pickers -->
                                <div class="block well">
                                    <div class="navbar">
                                        <div class="navbar-inner">
                                            <h5> <?php echo $admin_products['add_importdata']['front']; ?></h5>
                                            <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_products['add_importdata']['front']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_products/add_importdata/front'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_products/add_importdata/front" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="control-group displaynon" id="attribute_success">

                                        <label class="control-label attribute_success_msg"></label>

                                    </div>

                                    <img class="loaderimagecontinue displaynon" src="<?php echo base_url(); ?>assets/frontend/images/loading.gif" alt="loaderimagecontinue" />


                                    <form id="importproduct" name="importproduct" class="form-horizontal importforms" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/importdata/import_products">
                                        <input type="hidden" name="operation" value="set" />
                                        

                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_importdata['importzip_message']['admin']; ?></label>
                                            <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_importdata['importzip_message']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_importdata/importzip_message'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_importdata/importzip_message/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                        </div>



                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_importdata['importzip_label']['admin']; ?>:</label>
                                            <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_importdata['importzip_label']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_importdata/importzip_label'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_importdata/importzip_label/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls">
                                                <input name="images_zip" id="images_zip" class="focustip span12" type="file">



                                            </div>
                                            <span id='images_zip_validate' class='error displaynon'></span>
                                        </div>



                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_importdata['importproduct_label']['admin']; ?>:</label>
                                            <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_importdata['importproduct_label']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_importdata/importproduct_label'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_importdata/importproduct_label/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls">
                                                <input name="importproduct_file" id="importproduct_file" class="focustip span12" type="file">



                                            </div>
                                            <span id='importproduct_file_validate' class='error displaynon'></span>
                                        </div>

                                        <div class="form-actions align-right">
                                            <input class="btn btn-danger reset" value="<?php echo $admin_static_links['reset']['front']; ?>" type="button">
                                            <input class="btn btn-primary" value="<?php echo $admin_static_links['static_upload']['front']; ?>" id="send" type="submit">

                                        </div>
                                    </form>
                                </div>

                            </div>
                            <!-- /time pickers -->


                        </div>
                        <!-- /column -->


                    </div>

                    <!-- /pickers -->

                </div>
                <!-- /content container -->

            </div>
        </div>
    </div>
</div>

<span class="displaynon" id="import_csv_file"><?php echo $admin_title['csv_file']['front']; ?> </span>
<span class="displaynon" id="import_csv_file_type"><?php echo $admin_title['csv_file_type']['front']; ?> </span>
<span class="displaynon" id="import_csv_file"><?php echo $admin_title['csv_file_size']['front']; ?> </span>
<span class="displaynon" id="import_zip_file"><?php echo $admin_title['zip_only']['front']; ?></span>
<span class="displaynon" id="import_zip_size"><?php echo $admin_title['zip_file_size']['front']; ?></span>
<script>
    $(document).ready(function() {

        $("#importproduct").show();


        $('.reset').click(function() {
            alert('reset');
            $("#Import_question").show();
            $("input[name='attribute']:radio").prop('checked', false);
            $(".error").hide();
            $('.badge').remove();
            $('#importattribute').hide();

            $('.attribute_success_msg').html("");
           //$('#importproduct, #attribute_success').hide();
            $('#importattribute')[0].reset();
            $('#importproduct')[0].reset();
            $('.outer_message').hide();
            //$('.product_fileMessage').html("");

        });


        $("#importproduct").validate({
            submitHandler: function(form) {
                var action_form = $('#importproduct').attr('action');
                var validated = "true"
                var form = $('#importproduct')[0];
                var data = new FormData(form);
                $('#loading p').html('<?php echo $admin_title['import_progress']['front']; ?>');
                $('#loading').show();
                if ($('#images_zip').get(0).files.length) {
                    var sizeInBytes = $('#images_zip')[0].files[0].size;
                    var filename = $('#images_zip')[0].files[0].name;
                    var file_format = filename.split('.');
                    if (file_format[1] != "zip") {
                        var Message_string = $("#import_zip_file").html();
                        $("#images_zip_validate").html(Message_string).show();
                        $("#images_zip_validate").removeClass("displaynon").show();
                        $('#images_zip').focus();
                        validated = "false";
                    }

                    //AR Check if the file size exceeds 50MB
                    if (sizeInBytes > 400 * 1024 * 1024) { // 400MB limit
                        $("#images_zip_validate").html("File size exceeds the limit of 50MB");
                        $("#images_zip_validate").removeClass("displaynon").show();
                        $('#images_zip').focus();
                        validated = "false";
                    }

                }



                if ($('#importproduct_file').get(0).files.length === 0) {
                    var Message_string = $("#import_csv_file").html();
                    $("#importproduct_file_validate").html(Message_string).show();
                    $('#importproduct_file').focus();
                    $("#importproduct_file").removeClass("displaynon").show();
                    validated = "false";
                } else {
                    var sizeInBytes = $('#importproduct_file')[0].files[0].size;
                    var filename = $('#importproduct_file')[0].files[0].name;
                    var file_format = filename.split('.');
                    if (file_format[1] != "csv") {
                        var Message_string = $("#import_csv_file_type").html();
                        $("#importproduct_file_validate").html(Message_string).show();
                        $('#importproduct_file').focus();
                        $("#importproduct_file_validate").removeClass("displaynon").show();
                        $("#importproduct_file").removeClass("displaynon").show();
                        validated = "false";
                    }





                }


                // If validation of the form is passed
                if (validated == "true") {
                   // alert('Validation Passed');
                    $(".error").hide();
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: action_form,
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: "json",
                        timeout: 600000, //AR 10 minutes (in milliseconds)
                        beforeSend: function() {},
                        success: function(msg) {
                            console.log('Response:', msg);
                            // Alert the response as a JSON string
                           // alert('Success: ' + JSON.stringify(msg));

                            if (msg.status == 1) {

                                $('.outer_message').show();
                                $('.product_fileMessage').html(msg.message);
                               

                                // setTimeout(function() {
                                //     $('.product_fileMessage').html('Processing cron file, please wait');
                                //     $('#loading p').html('Started Processing cron file, please wait..');
                                //   //  window.location.href = '<?php echo base_url() . "admin/" . $lang_id . "/importdata"; ?>';
                                //     window.location.href = '<?php echo base_url() . "admin/" . $lang_id . "/importdata/run_import_cron/"; ?>';
                                //     $('#loading p').html('Processing cron file, please wait..');
                                //     //$('#loading').hide();
                                
                                // }, 1000);


/////////////////////////AR run_import_cron///////////////////////////////////
                    setTimeout(function() {
                        // Update the message while processing
                        $('.product_fileMessage').html('Processing cron file, please wait...');
                        $('#loading p').html('Started processing cron file, please wait...');

                        // Make an AJAX call to run the cron method
                        $.ajax({
                            url: '<?php echo base_url() . "admin/" . $lang_id . "/importdata/run_import_cron/"; ?>',
                            type: 'GET', // Or POST, depending on your backend
                            success: function(response) {
                                console.log('Cron response:', response);
                                $('#loading p').html('Cron processing completed successfully!');
                                $('.product_fileMessage').html('Cron processing completed successfully!');
                                $('#ar_cron_success_msg').html('Resetting the form');
                                //$('#loading p').html();
                                $('#loading').hide();


                                /////////
                                // Reset the form
                                $('#importproduct')[0].reset();
                                // Optionally, hide validation messages
                                $('.error').hide();
                                $('#images_zip_validate').hide();
                                $('#importproduct_file_validate').hide();

                                $('#ar_cron_success_msg').html('Cron processing completed successfully!');
                                window.location.href = '<?php echo base_url() . "admin/" . $lang_id . "/importdata/"; ?>';
                             

                            },
                            error: function(error) {
                                console.error('Cron processing failed:', error);
                                $('#loading p').html('Cron processing failed.');
                                $('.product_fileMessage').html('Cron processing failed. Please try again.');
                            }
                        });
                    }, 1000);
//////////////////////AR run_import_cron/////////////////////////////////////////




                            } else {
                                $('.outer_message').show();
                                $(".product_fileMessage").html(msg.message);
                                $('#loading').html("").hide();

                            }
                        },
                        error: function(msg) {
                            //alert('errorrrrrrrrr'); 
                            $('.outer_message').show();
                            $(".product_fileMessage").html("<?php echo $admin_title['csv_file_error']['front']; ?>");
                            $('#loading p').html();
                            $('#loading').hide();


                        }
                    });


                } else {
                   // alert('failed validator');                   
                    $('#loading p').html();
                    $('#loading').hide();
                }
            },
            rules: {

                importproduct_file: {
                    required: true
                }
            },
            messages: {
                images_zip: {
                    required: "<?php echo $admin_title['csv_file']['front']; ?>",
                },
                importproduct_file: {
                    required: "<?php echo $admin_title['csv_file']['front']; ?>"
                }
            }

        });

    });
</script>