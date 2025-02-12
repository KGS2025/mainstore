<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php $ASSET_VERSION = getenv('ASSET_VERSION');
        if (isset($title)) {
            echo $title;
        } ?>
    </title>
    <base href="<?php echo base_url(); ?>">
    <?php
    $fevicon = global_fevicon_img_link();
    echo $fevicon;
    ?>
    <link href="<?php echo asset_url('assets/admin/css/mainc81e.css?version=' . $ASSET_VERSION) ?>" rel="stylesheet" type="text/css" />
    <?php if ($lang_id == 'ar') { ?>
        <link href="<?php echo asset_url('assets/admin/css/arabic_style.css?version=' . $ASSET_VERSION) ?>" rel="stylesheet" type="text/css" />
    <?php
    } ?>
    <script>
        var time_digits = <?php echo json_encode(getTimeDigits()); ?>;
        var base_url = "<?php echo base_url() . 'admin/'; ?>";
        var app_url = "<?php echo base_url() . '/'; ?>";
        var lang_id = "<?php echo $lang_id; ?>";
        var lang_num = '<?php echo $lang_num; ?>';
    </script>
    <script src="https://code.jquery.com/jquery-1.11.0.min.js?version=<?php echo $ASSET_VERSION; ?>"></script>
    <script src="<?php echo asset_url('assets/admin/js/jquery.validate.min.js?version=' . $ASSET_VERSION) ?>" type="text/javascript"></script>
    <?php if ($lang_id != 'en') { ?>
        <script type="text/javascript" src="<?php echo asset_url('assets/frontend/locales/messages_' . $lang_id . '.js?version=' . $ASSET_VERSION) ?>"></script>
    <?php } ?>
    <script src="<?php echo asset_url('assets/admin/js/admin.js?version=' . $ASSET_VERSION) ?>" type="text/javascript"></script>
    <script src="<?php echo asset_url('assets/admin/js/bootstrap-filestyle.js?version=' . $ASSET_VERSION) ?>" type="text/javascript"></script>
    <script src="<?php echo asset_url('assets/admin/js/common.js?version=' . $ASSET_VERSION) ?>" type="text/javascript"></script>
    <style type="text/css">
        .page-header .lang-contnet-pending {
            color: #e28131;
        }
    </style>
    <?php $noimage = getNoImage('no_image'); ?>

    <?php if (isset($addscripts) && $addscripts != '') {
        switch ($addscripts) {
            case 'dashboard': ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-strap-wos.js?version=' . $ASSET_VERSION); ?>"></script>
                <script src="<?php echo asset_url('assets/admin/js/language_csv_section.js?version=' . $ASSET_VERSION); ?>"></script>
                <style>
                    .out-box-modal {
                        border-radius: 5px;
                        background-color: #fff;
                        padding: 10px
                    }

                    .box-content-modal {
                        background-color: #ddd;
                        padding: 10px
                    }

                    .box-content-modal h2 {
                        font-size: 13px;
                        font-weight: 700
                    }

                    .btn-modal {
                        display: inline-block;
                        width: 100%
                    }

                    .btn-modal .btn {
                        background-color: #DE0200;
                        color: #fff;
                        text-transform: uppercase;
                        border: none;
                        border-radius: 0;
                        ;
                        font-weight: 700;
                        padding: 10px
                    }

                    .title-modal {
                        color: #DE0200;
                        font-family: Arial;
                        font-size: 23px;
                        text-decoration: underline;
                        margin: 0 0 20px;
                        padding: 0
                    }

                    .title-modal.big {
                        text-align: center;
                        font-size: 30px;
                        line-height: 3;
                        text-shadow: -3px -3px 15px #000
                    }
                </style>
            <?php break;
            case 'add_model': ?>
                <script>
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                $('#modelimg_prvw').attr('src', e.target.result);
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    $(document).ready(function(e) {
                        $("#pro_modelimage").change(function() {
                            readURL(this);
                            showdelbtn();
                        });
                    });

                    function showdelbtn() {
                        $("#delimagebtn").html("<input type='button' class='focustip padding2px' value='Delete Image' onclick='removeimg();'>");

                    }

                    function removeimg() {
                        $("#modelimg_prvw").attr("src", "<?php echo $noimage; ?>");
                    }
                </script>
            <?php break;
            case 'add_productmakers': ?>

                <script>
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                $('#makerimg_prvw').attr('src', e.target.result);
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    $(document).ready(function(e) {
                        $("#pro_makerlogo").change(function() {
                            readURL(this);
                            showdelbtn();
                        });
                    });

                    function showdelbtn() {
                        $("#delimagebtn").html("<input type='button' class='focustip padding2px' value='Delete Image'onclick='removeimg();'>");

                    }

                    function removeimg() {
                        $("#makerimg_prvw").attr("src", "<?php echo $noimage; ?>");
                    }

                    $(document).ready(function(e) {
                        $("#pro_makerlogo").change(function() {
                            readURL(this);
                            showdelbtn();
                        });
                    });
                </script>



            <?php
                break;
            case 'add_producttype':
            ?>

                <script>
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                $('#typeimg_prvw').attr('src', e.target.result);
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    $(document).ready(function(e) {
                        $("#pro_image").change(function() {
                            readURL(this);
                            showdelbtn();
                        });
                    });

                    function showdelbtn() {
                        $("#delimagebtn").html("<input type='button' class='focustip padding2px' value='Delete Image' onclick='removeimg();'>");

                    }

                    function removeimg() {
                        $("#typeimg_prvw").attr("src", "<?php echo $noimage; ?>");
                        $('#pro_image').val('');
                    }
                </script>


            <?php
                break;
            case 'add_product_category':
            ?>


                <script>
                    function readURL(input, wrapper) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $('#' + wrapper).attr('src', e.target.result);
                                showdelbtn(wrapper);
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    $(document).ready(function(e) {
                        $("#VehicleType_Photo").change(function() {
                            readURL(this, 'modelimg_prvw1');

                        });
                        $("#vehicle_category_icon").change(function() {
                            readURL(this, 'modelimg_prvw2');

                        });
                        $("#menu_image").change(function() {
                            readURL(this, 'modelimg_prvw3');

                        });

                    });

                    function showdelbtn(wrapper) {
                        $('#' + wrapper + '_delete').show();
                        $('#' + wrapper + '_delete').html('<input type="button" class="focustip nopadding" value="Delete Image" onclick="removeimg(\'' + wrapper + '\');">');
                    }

                    function removeimg(wrapper) {
                        $('#' + wrapper).attr("src", "<?php echo $noimage; ?>");
                        $('#' + wrapper + '_delete').hide();
                        if (wrapper == 'modelimg_prvw1')
                            $("#VehicleType_Photo").val('');
                        if (wrapper == 'modelimg_prvw2')
                            $("#vehicle_category_icon").val('');
                        if (wrapper == 'modelimg_prvw3')
                            $("#menu_image").val('');
                    }
                </script>

            <?php
                break;
            case 'add_part_relation':
            ?>
                <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?version=<?php echo $ASSET_VERSION; ?>" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
                <script src="<?php echo asset_url('assets/admin/js/bundle.min.js?version=' . $ASSET_VERSION); ?>"></script>
                <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js?version=<?php echo $ASSET_VERSION; ?>"></script>
                <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css?version=<?php echo $ASSET_VERSION; ?>" rel="stylesheet" type="text/css" />
                <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js?version=<?php echo $ASSET_VERSION; ?>"></script>
                <script src="<?php echo asset_url() . '/assets/frontend/locales/datepicker-' . $lang_id . '.js'; ?>"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
                <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
                <script>
                    $(document).ready(function(e) {



                        // On Add product category change function
                        $("#vehicle_category_id input[type='checkbox']").change(function(event) {
                            event.preventDefault();
                            if ($(this).prop("checked") == true) {
                                var checkValues = [];
                                $('input[name^="vehicle_category_id"]:checked').each(function() {
                                    checkValues.push($(this).val());
                                });

                                var makerValues = [];
                                $('input[name^="maker_id"]').each(function() {
                                    makerValues.push($(this).val());
                                });
                                $.ajax({
                                    type: "POST",
                                    data: {
                                        category_ids: checkValues,
                                        maker_ids: makerValues
                                    },
                                    url: "admin/<?php echo $lang_id; ?>/part_relation/getMakersByCategoryId/",
                                    success: function(data) {
                                        // append maker data
                                        $('#maker_list').append(data);
                                        $('input[name^="maker_id"]:checked').trigger("change");
                                    }
                                });
                            } else if ($(this).prop("checked") == false) {
                                var v_id = $(this).val();

                                var checkValues = [];
                                $('input[name^="vehicle_category_id"]:checked').each(function() {
                                    checkValues.push($(this).val());
                                });


                                var classes = $(".maker_" + v_id).attr('data-cat-id').split(/\s+/);


                                var common = $.grep(classes, function(element) {
                                    return $.inArray(element, checkValues) !== -1;
                                });



                                // Remove maker list
                                if (common.length < 1) {
                                    $('.maker_' + v_id).remove();
                                }
                                // Remove model list
                                $('.modelcat_' + v_id).remove();



                            }

                        });
                        // On Add product maker change function 
                        $(document).on("change", "#maker_list input[type='checkbox']", function(event) {
                            event.preventDefault();
                            if ($(this).prop("checked") == true) {
                                var m_id = $(this).val();

                                var makerValues = [];
                                $('input[name^="maker_id"]:checked').each(function() {
                                    makerValues.push($(this).val());
                                });

                                var checkValues = [];
                                $('input[name^="vehicle_category_id"]:checked').each(function() {
                                    checkValues.push($(this).val());
                                });

                                var modelValues = [];
                                $('input[name^="model_id"]').each(function() {
                                    modelValues.push($(this).val());
                                });
                                $.ajax({
                                    type: "POST",
                                    data: {
                                        maker_ids: makerValues,
                                        category_ids: checkValues,
                                        model_ids: modelValues
                                    },
                                    url: "admin/<?php echo $lang_id; ?>/part_relation/getModelsByMakerId/",
                                    success: function(data) {
                                        // append maker data
                                        $('.model_list_with_attr').append(data);
                                        //  checkmodellistattr();
                                    }
                                });

                            } else if ($(this).prop("checked") == false) {
                                //Remove model data
                                var m_id = $(this).val();
                                $('.model_' + m_id).remove();
                            }
                        });
                        // On Add product change model function 
                        $(document).on("change", ".model_list_with_attr input[type='checkbox']", function(event) {

                            event.preventDefault();
                            var mo_id = $(this).val();
                            if ($(this).prop("checked") == true) {
                                $('.item_model_' + mo_id).removeClass('displaynon');
                                $('.item_model_' + mo_id + ' .span12').removeAttr("disabled");
                            } else if ($(this).prop("checked") == false) {
                                $('.item_model_' + mo_id).addClass('displaynon');
                                $('.item_model_' + mo_id + ' .span12').attr("disabled", "true");
                            }
                        });



                        $("#product_type_id").change(function() {
                            AutosetfiledBoxesSelection();

                        });

                        $(document).on('change', '.default_drop', function() {
                            var id = $(this).attr('data-id');
                            resetYear(id);
                        });

                        $('.drop_year').each(function() {
                            var id = $(this).attr('data-id');
                            resetYear(id);
                        });
                    });





                    function resetYear(id) {
                        var sel = [];
                        $('.drop_' + id).each(function() {
                            if ($(this).val()) {
                                sel.push($(this).val());
                            }
                        });
                        if (sel.length > 0) {
                            $('.drop_' + id).each(function() {
                                var exist = $(this).val();
                                var selector = $(this);
                                selector.find("option").show();
                                $.each(sel, function(index, value) {
                                    selector.find("option[value=" + value + "]").hide();
                                });
                                $(this).val(exist);
                            });
                        }
                    }

                    function AutosetfiledBoxesSelection() {
                        var element = $("#product_type_id");

                        var selectedoption = $('option:selected', element).attr('prev');

                        $(".productfield_display div.control-group").addClass("displaynon");
                        var boxestodisplay = selectedoption.split(',');
                        for (i = 0; i < boxestodisplay.length; i++) {
                            var currentoption = "#item_" + boxestodisplay[i];
                            $(currentoption).removeClass("displaynon");

                        }
                    }

                    function showdelbtn(wrapper) {
                        $('#' + wrapper + '_delete').show();
                        $('#' + wrapper + '_delete').html('<input type="button" class="focustip nopadding" value="Delete Image" onclick="removeimg(\'' + wrapper + '\');">');
                    }


                    function resetModelYear(id) {
                        console.log("resetModelYear >>>>>", id);
                        var sel = [];
                        $('.model_year_' + id).each(function() {
                            if ($(this).val()) {
                                console.log($(this).val());
                                sel.push($(this).val());
                            }
                        });
                        if (sel.length > 0) {
                            $('.model_year_' + id).each(function() {
                                var exist = $(this).val();
                                var selector = $(this);
                                selector.find("option").show();
                                $.each(sel, function(index, value) {
                                    selector.find("option[value=" + value + "]").hide();
                                });
                                $(this).val(exist);
                            });
                        }
                    }
                </script>

            <?php
                break;
            case 'cart_list':
            ?>

            <?php
                break;
            case 'country_list':
            ?>

            <?php
                break;
            case 'edit_maker':
            ?>

                <script>
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                $('#makerimg_prvw').attr('src', e.target.result);
                                $("#delimagebtn").show();
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    $(document).ready(function(e) {
                        $("#pro_makerlogo").change(function() {
                            readURL(this);
                            showdelbtn();
                        });
                    });

                    function showdelbtn() {
                        $("#delimagebtn").html("<input type='button' class='focustip' value='Delete Image' class='padding2px' onclick='removeimg();'>");

                    }

                    function removeimg() {
                        $("#makerimg_prvw").attr("src", "<?php echo $noimage; ?>");
                        $("#delimagebtn").hide();
                        del_makerimagepermanently();


                    }
                </script>

                <script>
                    function del_makerimagepermanently() {
                        $.ajax({
                            type: "POST",
                            data: '',
                            url: "admin/makers/delete_makerimage/" + $('#delimageid').val(),
                            success: function(msg) {}
                        });
                    }
                </script>


            <?php
                break;
            case 'edit_producttype':
            ?>


                <script>
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $('#typeimg_prvw').attr('src', e.target.result);
                                $("#delimagebtn").show();
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    $(document).ready(function(e) {
                        $("#pro_image").change(function() {
                            readURL(this);
                            showdelbtn();
                        });
                    });

                    function showdelbtn() {
                        $("#delimagebtn").html("<input type='button' class='focustip padding2px' value='Delete Image' onclick='removeimg();'>");

                    }

                    function removeimg() {
                        $("#typeimg_prvw").attr("src", "<?php echo $noimage; ?>");
                        $("#delimagebtn").hide();
                        del_typeimagepermanently();
                    }
                </script>

                <script>
                    function del_typeimagepermanently() {
                        $.ajax({
                            type: "POST",
                            data: '',
                            url: "admin/product_type/delete_typeimage/" + $('#delimageid').val(),
                            success: function(msg) {}
                        });
                    }
                </script>


            <?php
                break;
            case 'edit_product_category':
            ?>



                <script>
                    function readURL(input, wrapper) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $('#' + wrapper).attr('src', e.target.result);
                                showdelbtn(wrapper);
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    $(document).ready(function(e) {
                        $("#VehicleType_Photo").change(function() {
                            readURL(this, 'modelimg_prvw1');

                        });
                        $("#vehicle_category_icon").change(function() {
                            readURL(this, 'modelimg_prvw2');

                        });
                        $("#menu_image").change(function() {
                            readURL(this, 'modelimg_prvw3');

                        });

                    });

                    function showdelbtn(wrapper) {
                        $('#' + wrapper + '_delete').show();
                        $('#' + wrapper + '_delete').html('<input type="button" class="focustip nopadding" value="Delete Image" onclick="removeimg(\'' + wrapper + '\');">');
                    }

                    function removeimg(wrapper) {
                        $('#' + wrapper).attr("src", "<?php echo $noimage; ?>");
                        $('#' + wrapper + '_delete').hide();
                        if (wrapper == 'modelimg_prvw1') {
                            $("#VehicleType_Photo").val('');
                            var imagetodelete = 'VehicleType_Photo';
                            del_vehiclecategoryimagepermanently(imagetodelete);
                        }
                        if (wrapper == 'modelimg_prvw2') {
                            $("#vehicle_category_icon").val('');
                            var imagetodelete = 'vehicle_category_icon';
                            del_vehiclecategoryimagepermanently(imagetodelete);
                        }
                        if (wrapper == 'modelimg_prvw3') {
                            $("#menu_image").val('');
                            var imagetodelete = 'menu_image';
                            del_vehiclecategoryimagepermanently(imagetodelete);
                        }
                    }

                    function del_vehiclecategoryimagepermanently(imagetodelete) {
                        $.ajax({
                            type: "POST",
                            data: '',
                            url: "admin/vehicle_categories/del_vehiclecategoryimagepermanently/" + $('#delimageid').val() + "/" + imagetodelete,
                            success: function(msg) {}
                        });
                    }
                </script>

            <?php
                break;
            case 'edit_industry':
            ?>
                <script>
                    function removeimg(wrapper) {
                        $('#' + wrapper).attr("src", "<?php echo $noimage; ?>");
                        $('#' + wrapper + '_delete').hide();
                        $("#industry_icon").val('');
                        $.ajax({
                            type: "POST",
                            data: '',
                            url: "admin/industry/del_imagepermanently/" + $('#industryId').val(),
                            success: function(msg) {}
                        });
                    }
                </script>

            <?php
                break;
            case 'edit_product_model':
            ?>


                <script>
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                $('#modelimg_prvw').attr('src', e.target.result);
                                $("#delimagebtn").show();
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    $(document).ready(function(e) {
                        $("#pro_modelimage").change(function() {
                            readURL(this);
                            showdelbtn();
                        });
                    });

                    function showdelbtn() {
                        $("#delimagebtn").html("<input type='button' class='focustip nopadding' value='Delete Image' onclick='removeimg();'>");

                    }

                    function removeimg() {
                        $("#modelimg_prvw").attr("src", "<?php echo $noimage; ?>");
                        $("#delimagebtn").hide();
                        del_modelimagepermanently();
                    }
                </script>

                <script>
                    function del_modelimagepermanently() {
                        $.ajax({
                            type: "POST",
                            data: '',
                            url: "admin/product_model/delete_modelimage/" + $('#delimageid').val(),
                            success: function(msg) {}
                        });
                    }
                </script>


            <?php
                break;
            case 'edit_part_relation':
            ?>
                <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?version=<?php echo $ASSET_VERSION; ?>" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
                <script src="<?php echo asset_url('assets/admin/js/bundle.min.js?version=' . $ASSET_VERSION); ?>"></script>
                <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js?version=<?php echo $ASSET_VERSION; ?>"></script>
                <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css?version=<?php echo $ASSET_VERSION; ?>" rel="stylesheet" type="text/css" />
                <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js?version=<?php echo $ASSET_VERSION; ?>"></script>
                <script src="<?php echo asset_url() . '/assets/frontend/locales/datepicker-' . $lang_id . '.js'; ?>"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
                <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
                <script>
                    $(document).ready(function(e) {


                        // On Add product category change function
                        $("#vehicle_category_id input[type='checkbox']").change(function(event) {
                            event.preventDefault();
                            if ($(this).prop("checked") == true) {
                                var checkValues = [];
                                $('input[name^="vehicle_category_id"]:checked').each(function() {
                                    checkValues.push($(this).val());
                                });

                                var makerValues = [];
                                $('input[name^="maker_id"]').each(function() {
                                    makerValues.push($(this).val());
                                });
                                $.ajax({
                                    type: "POST",
                                    data: {
                                        category_ids: checkValues,
                                        maker_ids: makerValues
                                    },
                                    url: "admin/<?php echo $lang_id; ?>/part_relation/getMakersByCategoryId/",
                                    success: function(data) {
                                        // append maker data
                                        $('#maker_list').append(data);
                                        $('input[name^="maker_id"]:checked').trigger("change");
                                    }
                                });
                            } else if ($(this).prop("checked") == false) {
                                var v_id = $(this).val();

                                var checkValues = [];
                                $('input[name^="vehicle_category_id"]:checked').each(function() {
                                    checkValues.push($(this).val());
                                });


                                var classes = $(".maker_" + v_id).attr('data-cat-id').split(/\s+/);


                                var common = $.grep(classes, function(element) {
                                    return $.inArray(element, checkValues) !== -1;
                                });



                                // Remove maker list
                                if (common.length < 1) {
                                    $('.maker_' + v_id).remove();
                                }
                                // Remove model list
                                $('.modelcat_' + v_id).remove();



                            }

                        });
                        // On Add product maker change function 
                        $(document).on("change", "#maker_list input[type='checkbox']", function(event) {
                            event.preventDefault();
                            if ($(this).prop("checked") == true) {
                                var m_id = $(this).val();

                                var makerValues = [];
                                $('input[name^="maker_id"]:checked').each(function() {
                                    makerValues.push($(this).val());
                                });

                                var checkValues = [];
                                $('input[name^="vehicle_category_id"]:checked').each(function() {
                                    checkValues.push($(this).val());
                                });

                                var modelValues = [];
                                $('input[name^="model_id"]').each(function() {
                                    modelValues.push($(this).val());
                                });
                                $.ajax({
                                    type: "POST",
                                    data: {
                                        maker_ids: makerValues,
                                        category_ids: checkValues,
                                        model_ids: modelValues
                                    },
                                    url: "admin/<?php echo $lang_id; ?>/part_relation/getModelsByMakerId/",
                                    success: function(data) {
                                        // append maker data
                                        $('.model_list_with_attr').append(data);
                                        //  checkmodellistattr();
                                    }
                                });

                            } else if ($(this).prop("checked") == false) {
                                //Remove model data
                                var m_id = $(this).val();
                                $('.model_' + m_id).remove();
                            }
                        });
                        // On Add product change model function 
                        $(document).on("change", ".model_list_with_attr input[type='checkbox']", function(event) {

                            event.preventDefault();
                            var mo_id = $(this).val();
                            if ($(this).prop("checked") == true) {
                                $('.item_model_' + mo_id).removeClass('displaynon');
                                $('.item_model_' + mo_id + ' .span12').removeAttr("disabled");
                            } else if ($(this).prop("checked") == false) {
                                $('.item_model_' + mo_id).addClass('displaynon');
                                $('.item_model_' + mo_id + ' .span12').attr("disabled", "true");
                            }
                        });


                        setTimeout(function() {

                            var productId = $('#productId').val();
                            var selectedmakerids = $('#selectedmakerids').val();
                            var selectedmodelids = $('#selectedmodelids').val();
                            if (productId && selectedmakerids) {
                                $('#loading').show();
                                $('#send').hide();
                                loadModelAttrContent();
                            }
                        }, 100);



                        $("#product_type_id").change(function() {
                            AutosetfiledBoxesSelection();

                        });

                        $(document).on('change', '.default_drop', function() {
                            var id = $(this).attr('data-id');
                            resetYear(id);
                        });

                        $('.drop_year').each(function() {
                            var id = $(this).attr('data-id');
                            resetYear(id);
                        });
                    });

                    var xhr1;



                    function loadModelAttrContent() {
                        var productId = $('#productId').val();
                        var selectedmakerids = $('#selectedmakerids').val();
                        var selectedmodelids = $('#selectedmodelids').val();
                        var selectedcatids = $('#selectedcatids').val();


                        $.ajax({
                            type: "POST",
                            data: {
                                maker_ids: selectedmakerids,
                                category_ids: selectedcatids,
                                model_ids: selectedmodelids,
                                productId: productId
                            },
                            url: "admin/<?php echo $lang_id; ?>/part_relation/getModelsByMakerEditId/",
                            success: function(data) {
                                // append maker data
                                $('.model_list_with_attr').append(data);
                                //  checkmodellistattr();
                            }
                        });

                    }

                    $(document).ajaxStop(function() {
                        $('#loading').hide();
                        $('#send').show();
                    });

                    function checkmodellistattr() {
                        $(".model_list_with_attr input[type='checkbox']").change(function(event) {
                            event.preventDefault();
                            var mo_id = $(this).val();
                            if ($(this).prop("checked") == true) {
                                $('.item_model_' + mo_id).removeClass('displaynon');
                                $('.item_model_' + mo_id + ' .span12').removeAttr("disabled");
                            } else if ($(this).prop("checked") == false) {
                                $('.item_model_' + mo_id).addClass('displaynon');
                                $('.item_model_' + mo_id + ' .span12').attr("disabled", "true");
                            }
                        });
                    }

                    function resetYear(id) {
                        var sel = [];
                        $('.drop_' + id).each(function() {
                            if ($(this).val()) {
                                sel.push($(this).val());
                            }
                        });
                        if (sel.length > 0) {
                            $('.drop_' + id).each(function() {
                                var exist = $(this).val();
                                var selector = $(this);
                                selector.find("option").show();
                                $.each(sel, function(index, value) {
                                    selector.find("option[value=" + value + "]").hide();
                                });
                                $(this).val(exist);
                            });
                        }
                    }

                    function AutosetfiledBoxesSelection() {
                        var element = $("#product_type_id");
                        var selectedoption = $('option:selected', element).attr('prev');
                        $(".productfield_display div.control-group").addClass("displaynon");
                        $(".productfield_display .span12").attr("disabled", "true");
                        var boxestodisplay = selectedoption.split(',');
                        for (i = 0; i < boxestodisplay.length; i++) {
                            var currentoption = "#item_" + boxestodisplay[i];
                            $(currentoption).removeClass("displaynon");
                            $(currentoption + " .span12").removeAttr("disabled");
                        }
                    }

                    function showdelbtn(wrapper) {
                        $('#' + wrapper + '_delete').show();
                        $('#' + wrapper + '_delete').html('<input type="button" class="focustip nopadding" value="Delete Image" onclick="removeimg(\'' + wrapper + '\');">');
                    }

                    function removeimg(wrapper, img) {
        
                        $('#' + wrapper + '_delete').remove();
                        if (wrapper == 'productimage2') {
                            $("#item_schematic_photo_img").val('');
                            $('#' + wrapper).attr("src", "<?php echo $noimage; ?>");
                            var imagetodelete = 'item_schematic_photo';
                            del_partrelationimagepermanently(imagetodelete, img);
                        }else{
                            // $("#item_real_photo_img").val('');
                            var imagetodelete = 'item_real_photo';
                            
                            del_partrelationimagepermanently(imagetodelete, img);
                            var total_img = $('#total_image').val();
                            var left_img = parseInt(total_img) - 1;
                            $('#total_image').val(left_img);
                            if($('#total_image').val() == 0){
                                $('#' + wrapper).attr("src", "<?php echo $noimage; ?>");
                            }else{
                                $('#' + wrapper).remove();
                            }
                        }
                    }
                </script>

                <script>
                    function del_partrelationimagepermanently(imagetodelete, img) {
                        $.ajax({
                            type: "POST",
                            data: {
                                imagetodelete: imagetodelete,
                                img: img,
                                id:  $('#delimageid').val(),
                            },
                            url: "admin/<?php echo $lang_id; ?>/part_relation/del_partrelationimagepermanently",
                            success: function(msg) {}
                        });
                    }
                </script>

            <?php
                break;
            case 'list_cart_details':
            ?>

        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?version=<?php echo $ASSET_VERSION; ?>" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script src="<?php echo asset_url('assets/admin/js/bundle.min.js?version=' . $ASSET_VERSION); ?>"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js?version=<?php echo $ASSET_VERSION; ?>"></script>
        <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css?version=<?php echo $ASSET_VERSION; ?>" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js?version=<?php echo $ASSET_VERSION; ?>"></script>
        <script src="<?php echo asset_url() . '/assets/frontend/locales/datepicker-' . $lang_id . '.js'; ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
      
                <script>
                    // $(document).ready(function(e) {
                    //     $(".mainrow .minimize_block").click(function() {
                    //         if ($(this).val() == '+')
                    //             $(this).val('-');
                    //         else
                    //             $(this).val('+');
                    //         $(this).closest(".mainrow").next(".detailedrow").toggle(100);
                    //     });
                    // });
                </script>
            <?php
                break;
            case 'makers_list':
            ?>

            <?php
                break;
            case 'product_catagory_list':
            ?>

            <?php
                break;
            case 'product_list':
            ?>

            <?php
                break;
            case 'product_model_list':
            ?>

            <?php
                break;
            case 'product_type_list':
            ?>

            <?php
                break;
            case 'welcome_page_list':
            ?>
                <script type="text/javascript">
                    function confirm_box() {
                        var answer = confirm("Are you sure?");
                        if (!answer)
                            return false;
                    }
                </script>
            <?php
                break;
            case 'edit_welcome_page':
            ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/rgpajscolor.js?version=' . $ASSET_VERSION); ?>"></script>
            <?php
                break;
            case 'form_productitems':
            ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/jscolor.js?version=' . $ASSET_VERSION); ?>"></script>
            <?php
                break;
            case 'edit_language':
            ?>
                <script>
                    function removeimg(wrapper) {
                        $('#' + wrapper).attr("src", "<?php echo $noimage; ?>");
                        $('#' + wrapper + '_delete').hide();
                        if (wrapper == 'image') {
                            $("#image_img").val('');
                            var imagetodelete = 'image';
                            del_languageimagepermanently(imagetodelete);
                        }
                        if (wrapper == 'coming_soon_image') {
                            $("#coming_soon_image_img").val('');
                            var imagetodelete = 'coming_soon_image';
                            del_languageimagepermanently(imagetodelete);
                        }
                        if (wrapper == 'no_image') {
                            $("#no_image_img").val('');
                            var imagetodelete = 'no_image';
                            del_languageimagepermanently(imagetodelete);
                        }
                        if (wrapper == 'default_image') {
                            $("#default_image_img").val('');
                            var imagetodelete = 'default_image';
                            del_languageimagepermanently(imagetodelete);
                        }
                    }

                    function del_languageimagepermanently(imagetodelete) {
                        $.ajax({
                            type: "POST",
                            data: '',
                            url: "admin/language/del_languageimagepermanently/" + $('#delimageid').val() + "/" + imagetodelete,
                            success: function(msg) {}
                        });
                    }
                </script>

            <?php
                break;
            case 'entrydoor':
            ?>

                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-strap-wos.js?version=' . $ASSET_VERSION); ?>"></script>
                <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/dd.css?version=' . $ASSET_VERSION); ?>" />
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/msdropdown/jquery.dd.js?version=' . $ASSET_VERSION); ?>"></script>
                <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/flags.css?version=' . $ASSET_VERSION); ?>" />
                <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/flipclock.css?version=' . $ASSET_VERSION); ?>" media="screen" />
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/flipclock.js?version=' . $ASSET_VERSION); ?>"></script>
                <script src="<?php echo asset_url('assets/frontend/js/admin_door.js?version=' . $ASSET_VERSION); ?>"></script>
                <style>
                    .out-box-modal {
                        border-radius: 5px;
                        background-color: #fff;
                        padding: 10px
                    }

                    .box-content-modal {
                        background-color: #ddd;
                        padding: 10px
                    }

                    .box-content-modal h2 {
                        font-size: 13px;
                        font-weight: 700
                    }

                    .btn-modal {
                        display: inline-block;
                        width: 100%
                    }

                    .btn-modal .btn {
                        background-color: #DE0200;
                        color: #fff;
                        text-transform: uppercase;
                        border: none;
                        border-radius: 0;
                        font-weight: 700;
                        padding: 10px
                    }

                    .title-modal {
                        color: #DE0200;
                        font-family: Arial;
                        font-size: 23px;
                        text-decoration: underline;
                        margin: 0 0 20px;
                        padding: 0
                    }

                    .title-modal.big {
                        text-align: center;
                        font-size: 30px;
                        line-height: 3;
                        text-shadow: -3px -3px 15px #000
                    }
                </style>

            <?php
                break;
            case 'adminuser':
            ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-strap-wos.js?version=' . $ASSET_VERSION); ?>"></script>
            <?php
                break;
            case 'add_adminuser':
            ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-strap-wos.js?version=' . $ASSET_VERSION); ?>"></script>
                <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/dd.css?version=' . $ASSET_VERSION); ?>" />
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/msdropdown/jquery.dd.js?version=' . $ASSET_VERSION); ?>"></script>
                <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/flags.css?version=' . $ASSET_VERSION); ?>" />
                <script>
                    $(document).ready(function() {

                        $("#country").msDropdown({
                            roundedBorder: false
                        });
                        $("#country").on('change', function() {
                            var country_code = $(this).find(':selected').attr('data-rel');
                            $('#country_code').val('+' + country_code);
                        });
                    });
                </script>

            <?php
                break;
            case 'edit_adminuser':
            ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-strap-wos.js?version=' . $ASSET_VERSION); ?>"></script>
                <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/dd.css?version=' . $ASSET_VERSION); ?>" />
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/msdropdown/jquery.dd.js?version=' . $ASSET_VERSION); ?>"></script>
                <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/flags.css?version=' . $ASSET_VERSION); ?>" />
                <script>
                    $(document).ready(function() {

                        $("#country").msDropdown({
                            roundedBorder: false
                        });
                        $("#country").on('change', function() {
                            var country_code = $(this).find(':selected').attr('data-rel');
                            $('#country_code').val('+' + country_code);
                        });
                    });
                </script>

            <?php
                break;
            case 'add_users':
            ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-strap-wos.js?version=' . $ASSET_VERSION); ?>"></script>
                <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/dd.css?version=' . $ASSET_VERSION); ?>" />
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/msdropdown/jquery.dd.js?version=' . $ASSET_VERSION); ?>"></script>
                <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/flags.css?version=' . $ASSET_VERSION); ?>" />

                <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?version=<?php echo $ASSET_VERSION; ?>" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
                <script src="<?php echo asset_url('assets/admin/js/bundle.min.js?version=' . $ASSET_VERSION); ?>"></script>
                <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js?version=<?php echo $ASSET_VERSION; ?>"></script>
                <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css?version=<?php echo $ASSET_VERSION; ?>" rel="stylesheet" type="text/css" />
                <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js?version=<?php echo $ASSET_VERSION; ?>"></script>
                <script src="<?php echo asset_url() . '/assets/frontend/locales/datepicker-' . $lang_id . '.js'; ?>"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
                <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
                <link href="<?php echo asset_url() . '/assets/frontend/css/datetimepicker.min.css'; ?>" rel="stylesheet" />

                <script src="<?php echo asset_url() . 'assets/frontend/js/datetimepicker.min.js'; ?>"></script>
                <script src="<?php echo asset_url() . '/assets/frontend/js/estore-strap-wos-select.js'; ?>"></script>

            <?php
                break;
            case 'userblocked':
            ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-strap-wos.js?version=' . $ASSET_VERSION); ?>"></script>
            <?php
                break;
            case 'add_userblocked':
            ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-strap-wos.js?version=' . $ASSET_VERSION); ?>"></script>
                <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/dd.css?version=' . $ASSET_VERSION); ?>" />
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/msdropdown/jquery.dd.js?version=' . $ASSET_VERSION); ?>"></script>
                <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/flags.css?version=' . $ASSET_VERSION); ?>" />
                <script>
                    $(document).ready(function() {

                        $("#country").msDropdown({
                            roundedBorder: false
                        });
                        $("#country").on('change', function() {
                            var country_code = $(this).find(':selected').attr('data-rel');
                            $('#country_code').val('+' + country_code);
                        });
                    });
                </script>

            <?php
                break;
            case 'edit_userblocked':
            ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-strap-wos.js?version=' . $ASSET_VERSION); ?>"></script>
                <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/dd.css?version=' . $ASSET_VERSION); ?>" />
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/msdropdown/jquery.dd.js?version=' . $ASSET_VERSION); ?>"></script>
                <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/flags.css?version=' . $ASSET_VERSION); ?>" />
                <script>
                    $(document).ready(function() {

                        $("#country").msDropdown({
                            roundedBorder: false
                        });
                        $("#country").on('change', function() {
                            var country_code = $(this).find(':selected').attr('data-rel');
                            $('#country_code').val('+' + country_code);
                        });
                    });
                </script>

            <?php
                break;
            case 'state_instructions':
            ?>
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/bootstrap.js'); ?>"></script>
                <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/dd.css?version=' . $ASSET_VERSION); ?>" />
                <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/msdropdown/jquery.dd.js?version=' . $ASSET_VERSION); ?>"></script>
                <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/flags.css?version=' . $ASSET_VERSION); ?>" />
                <script>
                    $(document).ready(function() {

                        $("#country").msDropdown({
                            roundedBorder: false
                        });
                        $("#country").on('change', function() {
                            var country_code = $(this).find(':selected').attr('data-shortcode');
                            window.location.href = '<?php echo base_url() . "admin/" . $lang_id . "/index/state_instructions"; ?>/' + country_code;
                        });
                    });
                </script>
				

    <?php
                break;
                case 'add_distributor':
                    ?>
                        <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-strap-wos.js?version=' . $ASSET_VERSION); ?>"></script>
                        <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/dd.css?version=' . $ASSET_VERSION); ?>" />
                        <script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/msdropdown/jquery.dd.js?version=' . $ASSET_VERSION); ?>"></script>
                        <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/flags.css?version=' . $ASSET_VERSION); ?>" />
        
                        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?version=<?php echo $ASSET_VERSION; ?>" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
                        <script src="<?php echo asset_url('assets/admin/js/bundle.min.js?version=' . $ASSET_VERSION); ?>"></script>
                        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js?version=<?php echo $ASSET_VERSION; ?>"></script>
                        <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css?version=<?php echo $ASSET_VERSION; ?>" rel="stylesheet" type="text/css" />
                        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js?version=<?php echo $ASSET_VERSION; ?>"></script>
                        <script src="<?php echo asset_url() . '/assets/frontend/locales/datepicker-' . $lang_id . '.js'; ?>"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
                        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
                        <link href="<?php echo asset_url() . '/assets/frontend/css/datetimepicker.min.css'; ?>" rel="stylesheet" />
        
                        <script src="<?php echo asset_url() . 'assets/frontend/js/datetimepicker.min.js'; ?>"></script>
                        <script src="<?php echo asset_url() . '/assets/frontend/js/estore-strap-wos-select.js'; ?>"></script>
        
                    <?php
                        break;
            default:
                break;
        }
    }
    ?>
</head>

<body>
    <div id="loading" style="display:none;">
        <p><?php echo isset($general_instruction->please_wait_verifing_information) ? $general_instruction->please_wait_verifing_information : 'Please wait...'; ?></p>
    </div>

    <?php $str = 'admin/' . $lang_id;
    $uri_string = str_replace($str, '', uri_string()); ?>
	
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="width: 80%;">
                    <?php if ($active != 'entry_door' && $active != 'fd_code_check' && $active != 'forgot_details' && $active != 'multilangue') { ?>
                        <div class="global_search" style="padding: 0px 0 0px 325px;">
                            <div class="control-group" style="text-align: right; margin: 19px auto auto;">
                                <div class="controls">
                                    <form action="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/search/" method="post" class="form-horizontal">
                                        <input type="search" id="search" name="search" value="<?php echo isset($search_text) ? $search_text : ''; ?>" class="focustip" style="width: 55%;" />
                                        <input type="submit" id="search" value="<?php echo $admin_static_links['master_search']['front']; ?>" name="Submit" class="btn btn-primary" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </td>

                <td style="width: 20%;">
                    <?php if ($active != 'entry_door' && $active != 'fd_code_check' && $active != 'forgot_details' && $active != 'multilangue') { ?>
                        <div id="lang-translate">
                            <div class="ddl">
                                <div class="box">
                                    <div class="language_container">
                                        <div id="polyglotLanguageSwitcher1">
                                            <dl id="sample" class="dropdown">
                                                <dt>
                                                    <a href="javascript:void(0);" onclick="return false;">
                                                        <span>
                                                            <?php $countryList = '';
                                                            if (isset($country_data) && !empty($country_data)) {
                                                                foreach ($country_data as $set_data) {

                                                                    if ($set_data['short_code'] == $lang_id) {

                                                                        if (isset($set_data['image']) && ($set_data['image'] != '' || $set_data['image'] != NULL)) {
                                                                            echo '<img class="" src="' . global_img_link($set_data['image'], 'uploads/country/thumbnails/') . '" alt="' . $set_data['name'] . '" height="11" width="16"/>' . ' ' . $set_data['name'];
                                                                        } else {
                                                                            echo $set_data['name'];
                                                                        }
                                                                    }

                                                                    $countryList .= '<li><a href=' . base_url() . 'admin/' . $set_data['short_code'] . $uri_string . '>';
                                                                    if (isset($set_data['image']) && ($set_data['image'] != '' || $set_data['image'] != NULL)) {
                                                                        $countryList .= '<img src="' . global_img_link($set_data['image'], 'uploads/country/thumbnails/') . '" alt="alt-' . $set_data['name'] . '" height="11" width="16"/>';
                                                                    }
                                                                    $countryList .= $set_data['name'] . ' </a> </li>';
                                                                }
                                                            } ?>
                                                        </span>
                                                    </a>
                                                </dt>

                                                <dd>
                                                    <ul>
                                                        <?= $countryList; ?>
                                                    </ul>
                                                </dd>

                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php } ?>
                </td>
            </tr>
        </tbody>
    </table>
	