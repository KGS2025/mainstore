<?php
$volume_unit = get_volume_unit();
$weight_unit = get_weight_unit();
$noimage = getNoImage('no_image');
?>


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
                        <form id="galleryForm" name="galleryForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set" />
                            <input type="hidden" id="galleryId" value="<?= isset($edit_data['id']) ? $edit_data['id'] : ''; ?>" />
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?= isset($edit_data['id']) ? $admin_gallery['edit_gallery']['admin'] : $admin_gallery['add_gallery']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_gallery['edit_gallery']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_gallery/edit_gallery'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_gallery/edit_gallery/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_gallery['name']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_gallery['name']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_gallery/name'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_gallery/name/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                                <div class="controls">
                                                    <input id="name" name="name" class="focustip span12" type="text" value="<?php echo isset($edit_data['name']) ? $edit_data['name'] : ''; ?>">
                                                    <?php if (isset($edit_data['id'])) { ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/store_country/name" class="fancybox multi_language_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                                <span class="red1"><?php echo form_error('name'); ?></span>
                                            </div>


                                            

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_gallery['gallery_url']['admin']; ?></label>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_gallery['gallery_url']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_gallery/gallery_url'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_gallery/gallery_url/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>
                                                <div class="controls">
                                                    <input id="url" name="url" class="focustip span12" type="text" value="<?php echo isset($edit_data['url']) ? $edit_data['url'] : ''; ?>">
                                                    <?php if (isset($edit_data['id'])) { ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/1/gallery_items_country/url" class="fancybox multi_language_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                                <span class="red1"><?php echo form_error('url'); ?></span>
                                            </div>

                                          



                                            <div class="control-group" id="image">
                                                <label class="control-label"><?php echo $admin_gallery['images']['front']; ?>:</label>
                                                <div class="controls">
                                                    <input id="images" name="images[]" class="focustip span12 <?php if ($edit_data['images'] != "") { echo "ignore"; } ?>" type="file" multiple>  
                                                    <?php if ($edit_data['images'] != "") {
                                                    $real_photos = explode(",", $edit_data['images']); ?>

                                                    <input id="total_image" name="total_image" type="hidden" value="<?php echo !empty($real_photos) ? count($real_photos) : 0; ?>">
                                                    <?php foreach ($real_photos as $key => $real_photo) {
                                                        $real_photo = trim($real_photo);
                                                        $src = './assets/uploads/gallery/' . $real_photo; ?>
                                                        <img id="realPhoto<?php echo $key; ?>" src="<?php echo $src; ?>" alt=" image preview" class="modelimgpreviewbox" />
                                                        <div id="realPhoto<?php echo $key; ?>_delete" class="margintop-10px">
                                                            <input type="button" class="focustip nopadding" value="<?php echo $admin_static_links['delete_image']['front']; ?>" onclick="removeimg('realPhoto<?php echo $key; ?>', '<?php echo $real_photo; ?>');">
                                                        </div>
                                                    <?php
                                                    }
                                                }  ?>
                                                </div>
                                                <span class="red1"><?php echo form_error('image'); ?></span>
                                            </div>

                                      
            

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $admin_gallery['status']['admin']; ?> </label>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_gallery['status']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_gallery/status'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_gallery/status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                </a>

                                                <div class="controls">

                                                    <input type="checkbox" name="status" value="1" <?php if ($edit_data['status'] == 1) {
                                                                                                        echo 'checked="checked"';
                                                                                                    } ?> />

                                                </div>
                                                <span class="red1"><?php echo form_error('status'); ?></span>
                                            </div>



                                            <?php if ($addscripts == 'edit_gallery') { ?>

                                                <div class="form-actions align-right">
                                                    <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                                </div>
                                            <?php } else { ?>
                                                <div class="form-actions align-right">
                                                    <input class="btn btn-primary" value="<?php echo $admin_static_links['static_add']['front']; ?>" id="send" type="submit">
                                                    <input class="btn btn-danger" type="reset" value="<?php echo $admin_static_links['reset']['front']; ?>">
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                        </form>

                        <script type="text/javascript">

$(document).ready(function() {
                                $.ajaxSetup({
                                headers: {
                                'Csrf-Token': $('meta[name="csrf-token"]').attr('content')
                                }
                                });


                                $(".deletefile").click(function() {
                                    $(this).hide();
                                    $("#term_real_file").val("");


                                });
                                $("#galleryForm").validate({
                                    rules: {
                                        name: {
                                            required: true,
                                           
                                        },
                                        "images[]": {
                                            required: true
                                        }
                                    },
                                    ignore: ".ignore",
                                    messages: {
                                        name: {
                                            required: "<?php echo $admin_static_links['required_input']['front']; ?>",
                                        },
                                        url: {
                                            required: "<?php echo $admin_static_links['required_input']['front']; ?>",
                                        }
                                    },
                                    submitHandler: function(form) {                              
                            // If validation of the form is passed
                                    var action_form = $('#galleryForm').attr('action');
                                    var proform = $('#galleryForm')[0];
                                    var data = new FormData(proform);
                                    // data.append("model_categor_maker_relation", modelCategoryMaker);
                                    $.ajax({
                                    type: "POST",
                                    enctype: 'multipart/form-data',
                                    url: action_form,
                                    data: data,
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    dataType: "json",
                                    beforeSend: function() {
                                    $('#loading').show();
                                    $('.outer_message').hide();
                                    $('.item_real_photo_error').hide();
                                    $('.item_schematic_photo_error').hide();


                                    },
                                    success: function(msg) {
                                    $('#loading').hide();
                                    if (msg.status == "1") {
                                      
                                            window.location.href = '<?php echo base_url() . "admin/" . $lang_id . "/gallery"; ?>';
                                        $('.outer_message').show();
                                        $('.product_fileMessage').html(msg.message);
                                        

                                    } else {



                                        if (msg.element == "outer_message") {
                                            $('.outer_message').show();
                                            $('.product_fileMessage').html(msg.message);

                                            $([document.documentElement, document.body]).animate({
                                                scrollTop: $('.outer_message').offset().top
                                            }, 2000);

                                        } else if (msg.element == "item_real_photo") {
                                            $('.item_real_photo_error').show();
                                            $('.item_real_photo_error').html(msg.message);

                                            $([document.documentElement, document.body]).animate({
                                                scrollTop: $('.item_real_photo_error').offset().top
                                            }, 2000);

                                        }  else {
                                            $('#' + msg.element + "-error").show();
                                            $('#' + msg.element + "-error").html(msg.message);

                                            


                                        }
                                    }
                                    },
                                    error: function(msg) {
                                    $('.outer_message').show();
                                    $('.product_fileMessage').html(msg.message)
                                    $('#loading').hide();
                                    }
                                    });
                            // form.submit();


                                }

                                });
                            });

                        // function removeimg(wrapper) {
                        //     $('#' + wrapper).attr("src", "<?php echo $noimage; ?>");
                        //     $('#' + wrapper + '_delete').hide();
                        // }
                        function removeimg(wrapper, img) {

                            $('#' + wrapper + '_delete').remove();
                            // $("#item_real_photo_img").val('');
                            var imagetodelete = 'images';
                            var total_img = $('#total_image').val();
                            var left_img = parseInt(total_img) - 1;
                            $('#total_image').val(left_img);

                            del_galleryimagepermanently(imagetodelete, img)
                            if($('#total_image').val() == 0){
                            $('#' + wrapper).attr("src", "<?php echo $noimage; ?>");
                            }else{
                            $('#' + wrapper).remove();
                            }
                        }
    
                        function del_galleryimagepermanently(imagetodelete, img) {
                        $.ajax({
                            type: "POST",
                            data: {
                                imagetodelete: imagetodelete,
                                img: img,
                                id:  $('#galleryId').val(),
                            },
                            url: "admin/<?php echo $lang_id; ?>/gallery/del_galleryimagepermanently",
                            success: function(msg) {}
                        });
                    }

                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>