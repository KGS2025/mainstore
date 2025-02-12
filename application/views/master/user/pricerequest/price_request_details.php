<div class="mainContent px-3 px-lg-5">
    <div class="container-fluid py-3 py-md-5 text-center">
        <?php

if (isset($all_data['left_logo_status']) && $all_data['left_logo_status'] == 1) {?>
            <?php if (isset($all_data['logo']) && $all_data['logo'] != '') {
    $logo = asset_url() . "assets/uploads/logo/thumbnails/" . $all_data['logo'];?>
                <a class="logo navbar-logo navbar-brand text-center d-inline-block" href="<?php echo $all_data['logo_url']; ?>" aria-label="header logo icon">
                    <img src="<?php echo $logo; ?>" alt="<?php echo isset($all_data['title']) ? $all_data['title'] : ''; ?>" class="floatleft1 m-auto float-none" />
                </a>
            <?php } else {?>
                <a class="logo navbar-logo navbar-brand text-center d-inline-block" href="<?php echo $all_data['logo_url']; ?>" aria-label="header logo icon">
                    <img src="<?php echo asset_url('assets/uploads/logo/thumbnails/logo.png'); ?>" alt="34563456" class="floatleft1 m-auto float-none" />
                </a>
            <?php }?>
        <?php }?>
        <?php if (isset($all_data['right_logo_status']) && $all_data['right_logo_status'] == 1) {
    if (isset($all_data['header_image']) && $all_data['header_image'] != '') {
        $header_image = asset_url() . "assets/uploads/logo/thumbnails/" . $all_data['header_image'];?>
                <a class="logo demon_logo_link py-3 text-center d-inline-block" href="<?php echo $all_data['header_image_url']; ?>" target="_blank" rel="noopener noreferrer" aria-label="store icon">
                    <img src="<?php echo $header_image; ?>" alt="left logo image main" class="floatleft1 m-auto float-none" />
                </a>
            <?php }?>
        <?php }?>
    </div>
    <div class="ct-videoSection float-start w-100 px-4 px-md-5">
        <div class="ct-services float-start w-100">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="ct-team-box p-0">
                    <div class="common-search float-start w-100 my-3">
                        <div class="text-header">
                            <?php $this->load->view('elements/search');?>
                        </div>
                    </div>

                    <div class="home-quick-search-wrap float-start w-100">
                        <?php $this->load->view('elements/quicksearch');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-account-area py-3 py-sm-5">
        <div class="container">
            <div class="row">
                <!-- user dahboard sidebar-->
                <?php $this->load->view('elements/userdashboard-sidebar');?>
                <div class="col-12 col-md-9">
                    <div class="my-account-content mb-50 h-100">
                        <div class="col-md-12 brand_complete_info">
                            <h4 class="orderHistory"> <?php echo $admin_order_details['requested_products_detail']['admin']; ?></h4>
                      <div class="UserInformation float-start w-100 bg-white rounded p-4 mb-4">

                                    <form class="price_request_update" role="form" method="post" action="<?php echo base_url() . $lang_id . '/'; ?>user/update_price_request"  enctype="multipart/form-data">


                                                           
                                    <div class="col-12 float-start w-100">
                                        <div class="formGrid d-grid gap-3 grid-col-2">

                                        <div class="col"><strong>
                                            
                                        <?php echo $general_instruction->requested_products; ?>:</strong>

                                       <div class="selected_prodct_wrap">
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

                                        <div class="col"><strong><?php echo $general_instruction->request_choose_more; ?>:</strong>
                                        <select class="products_new_drop form-control" name="new_requested[]" multiple="multiple" ></select>

                                        
                                        
                                        </div>


                                        <div class="col"><strong><?php echo $general_instruction->requested_products_date; ?>:</strong><?php echo date('Y-m-d', strtotime($main_data['createddate'])); ?></div>
                                        <div class="col"><strong><?php echo $general_instruction->expire_products_date; ?>:</strong><?php echo date('Y-m-d', strtotime($main_data['expire_date'])); ?></div>

                                        <div class="col"><strong><?php echo $general_instruction->requested_product_status; ?>:</strong> <?php echo getpaymentrequeststatus($main_data['status']); ?></div>

                                        <div class="col">
                                        <input id="request_id" name="request_id" type="hidden" value="<?php echo $main_data['id']; ?>">
    
                                        <input class="btn  actn-btn rounded updatepricerequest" type="button" value="<?php echo $general_instruction->request_resend; ?>">
                                        </div>

                                       
                                        </div>


                                    </div>

                            </div>


    </form>
                        </div>
                                    <div class="table-responsive w-100 float-start mb-4">
                                    <div class="load_messages">

                              <?php    
                              $data['all_messages']  = $all_messages;
                                 $this->load->view('product/get_request_message', $data);  ?>


                                    </div>
                                    </div>



                            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url() . $lang_id . '/'; ?>user/save_price_request" id="cart_details_form" enctype="multipart/form-data">

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




                </div>
            </div>
        </div>
    </div>
</div>


<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">
<input type="hidden" id="price_request_required" value="<?php echo $form_validation_instruction->price_request_required; ?>">
