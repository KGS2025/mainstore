<!---------------------------    pop up for csv upload    ----->


<div class="modal fade" id="language_csv">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">

                <div class="box-content-modal">
                    <form  enctype="multipart/form-data" action="admin/<?php echo $lang_id ; ?>/index/import_excel_section_wise" id="language_csv_form" method="post">

                        <h2 class="title-modal kgt42" id="email_sms_confirm"><?php echo $admin_title['csv_upload_title']['front']; ?>  <span class="csv_section"> </span> 
                        </h2>
                        <input type="hidden"  name="language_table" class="language_table">
                        <input type="hidden"  name="language_table_country" class="language_table_country">

                  
                        <div class="blink">
                            <div class="product_counter_msg counter_msg_wrap verfication_error_msg colorgray"></div>
                        </div>


                        <div class="form-group">
                                        <label for="language_csv_file" class="col-sm-4 left control-label"> <?php echo $admin_title['csv_upload_label']['front']; ?> :
                                            <span class="cart_asterisk">*</span></label>
                                        <div class="col-sm-12">
                                        <input type="file"
                                        name="language_csv_file" id="csv_file">
                                        </div>
                                        <span class="help-block"></span>
                                    </div>
                       
                        
                      


                        <div class="col-lg-4 col-lg-offset-4 timerdiv" style="margin-top: 20px;">
                          
                        </div>
                        <div class="col-lg-4"></div>
                        <div class="clearfix"></div>
                        <div class="btn-modal toyota-page">

                            <div class="row">

                            <div class="col-md-12">
                                    <img class="loaderimagecontinue displaynon" src="<?php echo base_url();?>assets/frontend/images/loading.gif"
                                         alt="loaderimagecontinue"/>

                                    <!-- when user click to cancel the verification code popup then it allocates 1200 seconds in the cart preview. -->
                                    
                                    <?php if ($lang_id == 'ar') { ?>
                                        <a href="javascript:void(0);" class=" language_csv_cancel_btn btn btn-primary btn-sm"><i class="fa fa-angle-left"></i><?php echo $admin_title['csv_upload_cancel']['front']; ?> </a>
                                    <?php } else { ?>
                                        <a href="javascript:void(0);"   class="language_csv_cancel_btn btn btn-primary btn-sm"><?php echo $admin_title['csv_upload_cancel']['front']; ?> <i class="fa fa-angle-right"></i></a>
                                    <?php } ?>
                                </div>
                            
                                <div class="col-md-12">
                                    <?php if ($lang_id == 'ar') { ?>
                                        <a href="javascript:void(0);" class="language_csv_submit_btn btn btn-primary btn-sm" ><i class="fa fa-angle-left"></i><?php echo $admin_title['csv_upload_confirm']['front']; ?> </a>  
                                    <?php } else { ?>
                                        <a href="javascript:void(0);" class="language_csv_submit_btn btn btn-primary btn-sm" ><?php echo $admin_title['csv_upload_confirm']['front']; ?> <i class="fa fa-angle-right"></i></a>  
                                    <?php } ?>
                                </div>


                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!---------------------------    pop up for csv upload    ----->


