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
                                            <h5> <?php echo $admin_products['add_exportdata']['front']; ?></h5>
                                            <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_products['add_exportdata']['front']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_products/add_exportdata/front'; ?>">
                                            <?php } ?><a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_products/add_exportdata/front" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                        </div>
                                    </div>


                                    <!--
                                    <div class="form-horizontal">
                                        <div class="control-group" id="import_instruction">

                                            <label class="control-label"><?php echo $admin_title['import_instruction']['front']; ?></label>
                                        </div>

                                        <div class="control-group" id="Import_question">

                                            <label class="control-label"><?php echo $admin_importdata['import_question']['admin']; ?></label>

                                            <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_importdata['import_question']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_importdata/import_question'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_importdata/import_question/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls">
                                                <input type="radio" name="attribute" value="1" />&nbsp; &nbsp;<?php echo $admin_importdata['attribute_yes']['admin'];  ?>&nbsp; &nbsp; &nbsp; &nbsp;
                                                &nbsp;<?php echo $admin_importdata['attribute_no']['admin'];  ?>&nbsp; &nbsp; &nbsp; &nbsp;<input type="radio" name="attribute" value="0" />


                                            </div>

                                        </div>

                                    </div>
 -->

                                    <div class="form-horizontal">


                                        <div class="control-group" id="Import_question">

                                            <label class="control-label"><?php echo $admin_importdata['export_question']['admin']; ?></label>

                                            <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_importdata['export_question']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_importdata/export_question'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_importdata/export_question/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls">
                                                <input type="radio" name="export" value="1" />&nbsp; &nbsp;<?php echo $admin_importdata['attribute_yes']['admin'];  ?>&nbsp; &nbsp; &nbsp; &nbsp;
                                                &nbsp;<?php echo $admin_importdata['attribute_no']['admin'];  ?>&nbsp; &nbsp; &nbsp; &nbsp;<input type="radio" name="export" value="0" />


                                            </div>

                                        </div>

                                    </div>
                                    <div class="control-group displaynon" id="attribute_success">

                                        <label class="control-label attribute_success_msg"></label>

                                    </div>

                                    <img class="loaderimagecontinue displaynon" src="<?php echo base_url(); ?>assets/frontend/images/loading.gif" alt="loaderimagecontinue" />

                                    <form id="selectedproducts" name="importattribute" class="form-horizontal importforms" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/importdata/product_data_images">
                                        <input type="hidden" name="operation" value="set" />




                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_importdata['choose_product']['admin']; ?>:</label>
                                            <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_importdata['choose_product']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_importdata/choose_product'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_importdata/choose_product/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls">
                                                <select class="products_new_drop focustip span12" name="selected_products[]" multiple="multiple" required>
                                                   
                                                </select>


                                            </div>
                                            <span id='attribute_file_validate' class='error displaynon'></span>
                                        </div>



                                        <div class="form-actions align-right">

                                <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/importdata/product_empty_download" download ><?php echo $admin_static_links['download_empty_product']['front']; ?></a>
                                <input class="btn btn-primary images_download_product" value="<?php echo $admin_static_links['download_images']['front']; ?>" type="submit">

                                <input class="btn btn-primary csv_download_product" value="<?php echo $admin_static_links['download_csv']['front']; ?>" id="send" type="submit">
                                        </div>
                                    </form>






                                    <form id="rangeproduct" name="importattribute" class="form-horizontal importforms" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/importdata/product_data_images">
                                        <input type="hidden" name="operation" value="set" />




                                        <div class="control-group">
                                         y    <label class="control-label"><?php echo $admin_importdata['range_product']['admin']; ?>:</label>
                                            <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_importdata['range_product']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_importdata/range_product'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_importdata/range_product/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>

                                            <div class="controls">
                                                <select class="products_new_drop focustip span12" name="product_id" required>
                                                  
                                                </select>


                                            </div>
                                            <span id='attribute_file_validate' class='error displaynon'></span>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label"><?php echo $admin_importdata['limit_product']['admin']; ?>:</label>
                                            <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                <input type="text" value="<?php echo $admin_importdata['limit_product']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_importdata/limit_product'; ?>">
                                            <?php } ?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_importdata/limit_product/admin" class="fancybox multi_language_common_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20">
                                            </a>
                                            <div class="controls">
                                                <input type="text" class="form-control required_input" id="limit" placeholder="limit" name="limit">

                                            </div>

                                            <p class="red1 help-block"></p>
                                        </div>



                                        <div class="form-actions align-right">

                                            <input class="btn btn-primary images_download_limit" value="<?php echo $admin_static_links['download_images']['front']; ?>" id="send" type="submit">
                                            <input class="btn btn-primary csv_download_limit" value="<?php echo $admin_static_links['download_csv']['front']; ?>" id="send" type="submit">
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


        $('input[type=radio][name=attribute]').change(function() {
            if (this.value == 0) {
                $("#importattribute").hide();
                $("#importproduct").show();
            } else if (this.value == 1) {
                $("#importattribute").show();
                $("#importproduct").hide();
            }
        });



        $('.csv_download_limit,.csv_download_product').click(function() {
            var product_csv = "<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/importdata/product_data_download";
            $(this).closest("form").attr('action', product_csv);
        });


        $('.images_download_limit,.images_download_product').click(function() {
            var product_image = "<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/importdata/product_data_images";
            $(this).closest("form").attr('action', product_image);
        });


        $('input[type=radio][name=export]').change(function() {
            if (this.value == 0) {
                $("#selectedproducts").hide();
                $("#rangeproduct").show();
            } else if (this.value == 1) {
                $("#selectedproducts").show();
                $("#rangeproduct").hide();
            }
        });


        // $('.products_new_drop').select2();



        $('.reset').click(function() {
            $("#Import_question").show();
            $("input[name='attribute']:radio").prop('checked', false);
            $(".error").hide();
            $('.badge').remove();
            $('#importattribute').hide();

            $('.attribute_success_msg').html("");
            $('#importproduct, #attribute_success').hide();
            $('#importattribute')[0].reset();
            $('#importproduct')[0].reset();
            $('.outer_message').hide();
            $('.product_fileMessage').html("");

        });
        $("#selectedproducts").validate({

            rules: {
                selected_products: {
                    required: true
                }
            },
            messages: {
                selected_products: {
                    required: "<?php echo $form_validation_instruction->required; ?>",
                }
            },
            errorElement: "p",
            errorClass: 'help-block red1',
            validClass: 'help-block'

        });

        $("#rangeproduct").validate({

            rules: {
                product_id: {
                    required: true
                },
                limit: {
                    required: true,
                    digits: true,
                    range: [1, 1000]
                }
            },
            messages: {
                product_id: {
                    required: "<?php echo $form_validation_instruction->required; ?>",
                },
                limit: {
                    required: "<?php echo $form_validation_instruction->required; ?>",
                    digits: "<?php echo $form_validation_instruction->digits; ?>",
                    range: "<?php echo $form_validation_instruction->range; ?>"
                }
            },
            errorElement: "p",
            errorClass: 'help-block red1',
            validClass: 'help-block'

        });







    });
    
    $('.products_new_drop').select2({
        ajax: {
            type: "POST",
            url: base_url + lang_id + "/ajax/getProductListDataResult",
            dataType: 'json',
            data: function(params) {
                return {
                    // vehicle_category_id: $(parentDiv + " .vehicle_category_ids").val(),
                    // product_type_id: "",
                    search: params.term, // search term
                    page: params.page,
                };
            },
            processResults: function(data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 50) < data.total_count
                    }
                };
            },
        },
        placeholder: 'Select an option',
        templateResult: formatState,
        allowClear: true
    });
    function formatState(state) {
            if (!state.id) {
                return state.text;
            }

            var $state = $(
                '<span><img class="img-flag" /> <span></span></span>'
            );

            // Use .text() instead of HTML string concatenation to avoid script injection issues
            $state.find("span").text(state.text);
            $state.find("img").attr("src", state.img);

            return $state;
        };
</script>