<div class="content zerorightmargin">
    <?php

if ($this->session->flashdata('success')) {
    $msg = $this->session->flashdata('success');?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?>
            </div>
        </div>
    <?php }?>

    <div id="show_class" class="note displaynon"></div>
    <div id="result"></div>
    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <!-- page title -->
                <h5>
                <?php echo $general_instruction->requested_products_detail; ?>
                </h5>
                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) {?>
                    <div class="edit_text" style="display:block"></div>
                    <input type="text" value="<?php echo $admin_order_details['order_details']['admin']; ?>" class="edit_input_text" style="display: none;">
                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/order_details'; ?>">
                <?php }?>
                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/order_details/admin" class="fancybox multi_language_common_edit admin_globe">
                    <img src="assets/uploads/global.jpg" height="20" width="20">
                </a>

                <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well margintop-30px">
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                <div class="MainHeadDetailsBlock">
                                            <div class="LeftPanel">
                                                    <?php //$products = $this->product_model->products_number_by_id($main_data['products']);?>
                                                 

                                                    <div class="d-flex">
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $general_instruction->customer_email; ?>: </label>
                                                    <div class="info"><?php echo $main_data['email']; ?></div>
                                                    </div>


                                                    <div class="d-flex">
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $general_instruction->customer_name; ?>: </label>
                                                    <div class="info"><?php echo $main_data['salutation'] . " " . $main_data['company']; ?></div>
                                                    </div>

                                                    <div class="d-flex">
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $general_instruction->requested_products_date; ?>: </label>
                                                    <div class="info"><?php echo date('Y-m-d', strtotime($main_data['createddate'])); ?></div>
                                                    </div>

                                                    





                                            </div>


                                            <div class="RightPanel">

                                            <form class="price_request_update" role="form" method="post" action="<?php echo base_url() . 'admin/' . $lang_id . '/'; ?>pricerequests/update_request"  enctype="multipart/form-data">

                                            <div class="d-flex">
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $general_instruction->requested_products; ?>: </label>
                                                    <div class="info">


                                                            <?php //echo implode(",", $products); ?>

                                                            <?php
                                                            $approved_produts = explode(",", $main_data['products']);
                                                            $approved_produts = array_values(array_filter($approved_produts));
                                                            $all_existing = $this->product_model->products_number_andid(implode(",", $approved_produts));

                                                            foreach ($all_existing as $single) {?>

                                                            <div class="selected_div_prodct">
                                                            <div class="productname"> <?php echo $single['kgt_ref_number']; ?>   </div>
                                                            <div class="delete_selec_product">x   </div>

                                                            <input type="hidden" name="approved_products[]" value="<?php echo $single['id']; ?>">
                                                            </div>

                                                            <?php }?>


                                                </div>
                                                    </div>



                                              <div class="d-flex">
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $general_instruction->request_choose_more; ?> </label>
                                                    <div class="info">
                                                    <select class="products_new_drop form-control" name="new_requested[]" multiple="multiple" ></select>

                                                    </div>
                                                </div>


                                                <div class="d-flex">
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $general_instruction->expire_products_date; ?>: </label>
                                                    <div class="info">

                                                    <input id="expire_date" name="expire_date" class="focustip span12" type="text" value="<?php echo date('Y-m-d', strtotime($main_data['expire_date'])); ?>">

                                                
                                                
                                                </div>
                                                    </div>




                                                <div class="d-flex">
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $general_instruction->requested_product_status; ?> </label>
                                                      <div class="info">

                                                            <select class="width100px" name="status"  data-id="<?php echo $main_data['id']; ?>">
                                                                <option <?php if ($main_data['status'] == "0") {?> selected="selected"   <?php }?> value="0"><?php echo getpaymentrequeststatus(0); ?></option>
                                                                <option <?php if ($main_data['status'] == "1") {?> selected="selected"   <?php }?> value="1" ><?php echo getpaymentrequeststatus(1); ?></option>
                                                                <option <?php if ($main_data['status'] == "2") {?> selected="selected"   <?php }?> value="2"><?php echo getpaymentrequeststatus(2); ?></option>
                                                                <option <?php if ($main_data['status'] == "3") {?> selected="selected"   <?php }?> value="3"><?php echo getpaymentrequeststatus(3); ?></option>

                                                            </select>


                                                    </div>
                                                </div>



                                                <div class="d-flex">
                                                  
                                                      <div class="info">
                                                      <input id="request_id" name="request_id" type="hidden" value="<?php echo $main_data['id']; ?>">
                                                      <input class="btn  actn-btn rounded updatepricerequest" type="button" value="<?php echo $general_instruction->sbmt; ?>">


                                                    </div>
                                                </div>




                                                            </form>


                                            </div>
                                            <div class="clear"></div>


                                                                            </div>
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive w-100 float-start mb-4">
                            <h2>  <?php echo $general_instruction->messages; ?></h2>
                                    <div class="load_messages">

                                        <?php
$data['all_messages'] = $all_messages;
$data['main_data'] = $main_data;

$this->load->view('admin/pricerequests/get_request_message', $data);
?>


                                    </div>
                                    </div>
                        <!-- /default datatable -->
                        <!-- Pickers -->
                    </div>

                    <!-- /pickers -->

                    <form class="form-horizontal message_form" role="form" method="post" action="<?php echo base_url() . 'admin/' . $lang_id . '/'; ?>pricerequests/save_price_request"  enctype="multipart/form-data">

<div class="form-group float-start w-100 mb-3">
<label for="cart_company" class="w-100 float-start control-label"><?php echo $cart_instruction->pricerequest_message; ?></label>
<div class="col-lg-12">

<textarea class="form-control pricerequest_message" name="pricerequest_message" data-id="<?php echo $main_data['id']; ?>" > </textarea>

</div>
<p class="help-block blink_error pricerequest_message_error"></p>
</div>

<div class="form-group float-start w-100 mb-3">
<div class="col-lg-12">
<input class="btn  actn-btn rounded sendpricerequest" type="button" value="<?php echo $general_instruction->request_send_message; ?>">
</div>
</div>

</form>


                </div>
                <!-- /content container -->

            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script>

<script>
    $(document).ready(function(e) {

        $('#expire_date').datepicker({
                timepicker: false,
                dateFormat: 'yy-mm-dd',
                minDate: 0
            });

        $(".delete_selec_product").click(function() {
                            $(this).closest('.selected_div_prodct').remove();
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

        CKEDITOR.replace('pricerequest_message', {
        height: 50,
       toolbarGroups: [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
       ],
       removeButtons : 'Source,Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Replace,Find,SelectAll,Scayt,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,NumberedList,BulletedList,Indent,Outdent,Blockquote,CreateDiv,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,Strike,Subscript,Superscript,Language,BidiRtl,BidiLtr,Link,Unlink,Anchor,Image,Table,Flash,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,FontSize,Font,Format,Styles,TextColor,BGColor,Maximize,ShowBlocks,About,Form'

  });

        $('input[type=radio][name=payment_type]').change(function() {
            if (this.value == "2") {
                $("#percentage_div").hide();
                $("#limit").val("");
            } else if (this.value == "1") {
                $("#percentage_div").show();
            }
        });

        $("input[name='payment_type']:checked").trigger("change");

        $('#generate_link_button').click(function() {
            $('#generate_link_form').show();
            $('#generate_link_button').hide();
        });


        $(".updatepricerequest").click(function() {


            var form_action = $(".price_request_update").attr('action');
           $.ajax({
            type: "POST",
            url: form_action,
            data: $('.price_request_update').serialize(),
            dataType: "json",
            beforeSend: function() {

            },
            success: function(msg) {
            // if(value=="1" || value=="2") {

            //     $(".message_form").hide();
            // }
            alert('<?=$admin_static_links['data_successfully_updated']['front'];?>');
            setTimeout(function() {
                                            window.location.href = '<?php echo base_url() . "admin/" . $lang_id . "/pricerequests"; ?>';
                                        }, 1000);
            }
            });
        });




        


     

        function loadprice_messages() {

$.ajax({
    type: "POST",
    url:base_url+"/" + lang_id + "/pricerequests/load_price_request_messages/",
    data: {
        "request_id": $(".pricerequest_message").attr("data-id")
    },
    dataType: 'json',
    success: function(data) {
        if (data.status == "1") {
            $(".load_messages").html(data.htmlbody);

        }
    }
});
}

$(document).on('click', '.sendpricerequest', function(element) {

element.preventDefault();
var request_message = CKEDITOR.instances.pricerequest_message.getData();
if ($.trim(request_message) != "") {
    $.ajax({
        type: "POST",
        url: base_url+"/" + lang_id + "/pricerequests/price_request_messages/",
        data: {
            "pricerequest_message": request_message,
            "request_id": $(".pricerequest_message").attr("data-id")
        },
        dataType: 'json',
        success: function(data) {
            if (data.status == "1") {
                CKEDITOR.instances.pricerequest_message.setData("");
                loadprice_messages()
                $(".pricerequest_message").val("")
                $(".pricerequest_message_error").html("").hide();

            }
        }
    });
} else {

   $(".pricerequest_message_error").html("<?php echo $form_validation_instruction['price_request_required']['front']; ?>").show();

}

});

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