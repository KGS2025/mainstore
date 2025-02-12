<div class="content zerorightmargin">
    <?php




    if ($this->session->flashdata('success')) {
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
                    <?php echo $admin_order_details['order_details']['admin']; ?>
                </h5>
                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                    <div class="edit_text" style="display:block"></div>
                    <input type="text" value="<?php echo $admin_order_details['order_details']['admin']; ?>" class="edit_input_text" style="display: none;">
                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/order_details'; ?>">
                <?php } ?>
                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/order_details/admin" class="fancybox multi_language_common_edit admin_globe">
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
                                        <?php echo $admin_order_details['user_info_page']['admin']; ?>
                                    </h5>
                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                        <div class="edit_text" style="display:block"></div>
                                        <input type="text" value="<?php echo $admin_order_details['user_info_page']['admin']; ?>" class="edit_input_text" style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/user_info_page'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/user_info_page/admin" class="fancybox multi_language_common_edit admin_globe">
                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                    </a>

                                </div>
                            </div>            
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                    <div class="MainHeadDetailsBlock">
                                        <?php foreach ($main_data as $user_data) {


                                            $cart_unit_of_meas = cart_unit_of_meas($user_data->volume_unit, $user_data->weight_unit);

                                        ?>
                                            <div class="LeftPanel">
                                                <div class="d-flex">
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_order_details['name']['admin'] . ': '; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['name']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/name'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/name/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                    <div class="info"><?php echo $user_data->user_name; ?></div>
                                                </div>
                                                <div class="d-flex">
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_order_details['email']['admin'] . ': '; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['email']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/email'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/email/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                    <div class="info"><?php echo $user_data->email; ?></div>
                                                </div>
                                                <div class="d-flex">
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_order_details['country']['admin'] . ': '; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['country']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/country'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/country/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                    <div class="info"><?php echo $user_data->country; ?></div>
                                                </div>
                                                <div class="d-flex">
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_order_details['telephone']['admin'] . ': '; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['telephone']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/telephone'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/telephone/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                    <div class="info"><?php echo $user_data->telephone; ?></div>
                                                </div>

                                                <div class="d-flex">
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_order_details['amount']['admin'] . ': '; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['amount']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/amount'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/amount/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                    <div class="info"><?php echo $user_data->amount . ' ' . $user_data->currency; ?></div>
                                                </div>
                                             <?php   if($this->config->item('partial_payment_enable')!="0") {  ?>
                                                    <div class="d-flex">
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_order_details['amount_pending']['admin'] . ': '; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_order_details['amount_pending']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/amount_pending'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/amount_pending/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                    <div class="info"><?php echo $user_data->amount_pending . ' ' . $user_data->currency; ?>( <?php echo $percetange_payable = round($user_data->amount_pending / $user_data->amount * 100);
                                                    ?>%)</div>
                                                    </div>
                                                <?php } ?>
<input type="hidden" value="<?php echo round($user_data->amount_pending / $user_data->amount * 100); ?>" id="pending_percentage">
<?php   if($this->config->item('partial_payment_enable')!="0") {  ?>

                                                <div class="d-flex">
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_order_details['amount_received']['admin'] . ': '; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['amount_received']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/amount_received'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/amount_received/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                    <div class="info"><?php echo $user_data->amount_received . ' ' . $user_data->currency; ?>( <?php echo  round($user_data->amount_received / $user_data->amount * 100);
?>% )</div>
                                                </div>

<?php } ?>


                                                <?php if ($user_data->discount) { ?>
                                                    <div class="d-flex">
                                                        <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_order_details['discount']['admin'] . ': '; ?></label>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_order_details['discount']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/discount'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/discount/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>

                                                        <div class="info"><?php echo $user_data->discount . ' ' . $user_data->currency; ?></div>
                                                    </div>
                                                <?php } ?>

                                            </div>


                                            <div class="RightPanel">

                                              
                                                <div class="d-flex">
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_order_details['order_number']['admin'] . ': '; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['order_number']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/rfq'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/rfq/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                    <div class="info"> <?php echo $user_data->order_number; ?></div>
                                                </div>
                                                <div class="d-flex">
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_order_details['incoterms']['admin'] . ': '; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['incoterms']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/incoterms'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/incoterms/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                    <div class="info"><?php echo $user_data->incoterms; ?></div>
                                                </div>
                                                <?php if (!empty($cart_package_data) && $user_data->incoterms == 'DAP') { ?>
                                                    <div class="d-flex">
                                                        <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_order_details['ups_tracking_number']['admin'] . ': '; ?></label>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_order_details['ups_tracking_number']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/ups_tracking_number'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/ups_tracking_number/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img style="vertical-align: top;" src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>
                                                        <p style="display: inline-block; margin-top: 10px;">
                                                            <?php
                                                            $unique_tracking = array();
                                                            $first_tracking_number = intval($cart_package_data[0]['tracking_number']); 
                                                            $cart_user_id = $cart_package_data[0]['cart_user_id'];
                                                            $freight_package = 0;  
                                                            $cancel_status = 0;           
                                                            // echo '<pre>';print_r($cart_package_data);exit;
                                                            foreach ($cart_package_data as $cart_package) {
                                                                $temp_track_number = intval($cart_package['tracking_number']);
                                                                if($temp_track_number<$first_tracking_number){
                                                                    $first_tracking_number = $temp_track_number;
                                                                }   
                                                                if($cart_package['package_type']=="freight"){
                                                                    $freight_package = 1;
                                                                }
                                                                if($cart_package['cancel_status']==1){
                                                                    $cancel_status = 1;
                                                                }
                                                                if (!in_array($cart_package['tracking_number'], $unique_tracking)) {
                                                                    $unique_tracking[] = $cart_package['tracking_number']; ?>
                                                                    <?php echo ucfirst($cart_package['package_type'])." ".$cart_package['tracking_number'].": ".$aramex_error[$cart_package['tracking_number']]['front'] . '<br />'; ?>
                                                            <?php }
                                                            }
                                                            if($first_tracking_number && $freight_package == 0 && ($user_data->carrier_name == 'FEDEX' || $user_data->carrier_name == 'ARAMEX')){?>
                                                                <?php if($cancel_status == 0){?>
                                                                <button class="btn btn-danger" id="cancel_this_shipping" data-carrier='<?php echo $user_data->carrier_name;?>' data-track="<?php echo $first_tracking_number;?>" data-src="<?php echo $admin_static_links['shipment_cancel_prompt']['front'];?>" onClick="cancelShipment(this)"><?php echo $admin_static_links['cancel_this_shipping']['front']; ?></button>                                                                
                                                                <?php }else{
                                                                    echo '<font style="color:#F00">'.$admin_static_links['shipment_cancel_msg']['front'].'</font>';
                                                                }?>
                                                            <?php }else{
                                                                if($user_data->carrier_name == 'FEDEX'){
                                                                    echo '<font style="color:#00a67d">'.$admin_static_links['shipment_freight_pickup_request']['front'].'</font>';                                                                
                                                                }
                                                            } ?>
                                                        </p>
                                                    </div>
                                                <?php } ?>
                                                <?php if (isset($user_data->tax_exoneration) && $user_data->tax_exoneration  == 1 && isset($user_data->tax_exoneration_number) && $user_data->tax_exoneration_number != '') { ?>
                                                    <div class="d-flex">
                                                        <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_order_details['tax_exoneration_number']['admin'] . ': '; ?></label>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_order_details['tax_exoneration_number']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/tax_exoneration_number'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/tax_exoneration_number/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>

                                                        <div class="info"><?php echo $user_data->tax_exoneration_number; ?></div>
                                                    </div>
                                                <?php } ?>


                                                <?php if (isset($user_data->edi_one) && $user_data->edi_one != '') { ?>
                                                    <div class="d-flex">
                                                        <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_order_details['edi_one']['admin'] . ': '; ?></label>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_order_details['edi_one']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/edi_one'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/edi_one/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>

                                                        <div class="info"><?php echo $user_data->edi_one; ?></div>
                                                    </div>
                                                <?php } ?>




                                                <?php if (isset($user_data->edi_two) && $user_data->edi_two != '') { ?>
                                                    <div class="d-flex">
                                                        <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_order_details['edi_two']['admin'] . ': '; ?></label>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_order_details['edi_two']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/edi_two'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/edi_two/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>

                                                        <div class="info"><?php echo $user_data->edi_two; ?></div>
                                                    </div>
                                                <?php } ?>




                                                <?php if (isset($user_data->po_number) && $user_data->po_number != '') { ?>
                                                    <div class="d-flex">
                                                        <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_order_details['po_number']['admin'] . ': '; ?></label>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_order_details['po_number']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/po_number'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/po_number/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>

                                                        <div class="info"><?php echo $user_data->po_number; ?></div>
                                                    </div>
                                                <?php } ?>


                                                <?php if (isset($user_data->po_file) && $user_data->po_file != '') { ?>
                                                    <div class="d-flex">
                                                        <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_order_details['po_file']['admin'] . ': '; ?></label>
                                                        <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                            <div class="edit_text" style="display:block"></div>
                                                            <input type="text" value="<?php echo $admin_order_details['po_file']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/po_file'; ?>">
                                                        <?php } ?>
                                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/po_file/admin" class="fancybox multi_language_common_edit admin_globe">
                                                            <img src="assets/uploads/global.jpg" height="20" width="20">
                                                        </a>

                                                        <a href="<?php echo base_url() . 'assets/uploads/cart/' . $user_data->po_file; ?>" class="btn btn-primary" download><?php echo $admin_static_links['download_file']['front']; ?></a>

                                                    </div>
                                                <?php } ?>






                                              
                                             

                                                <div class="d-flex">
                                                    <label class="control-label" style="float: left; margin: 12px 10px 0px;"><?php echo $admin_order_details['status']['admin'] . ': '; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['status']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/status'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/status/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>
                                                    <div class="info">
                                                       <select class="width100px" name="order_status" id="order_status" data-id="<?php echo $user_data->id; ?>">
                                                        <option value="0" <?php if ($user_data->order_status == "0") { ?> selected="selected" <?php } ?>><?php echo $admin_static_links['pending_payment']['front']  ?></option>
                                                        <option value="1" <?php if ($user_data->order_status == "1") { ?> selected="selected" <?php } ?>><?php echo $admin_static_links['pending_received']['front']  ?></option>
                                                        <option value="2" <?php if ($user_data->order_status == "2") { ?> selected="selected" <?php } ?>><?php echo $admin_static_links['order_delivered']['front']  ?></option>
                                                       </select>
                                                    </div>
                                                </div>


                                              





                            <?php  if ($user_data->order_status == "0" && $this->config->item('partial_payment_enable')=="1") {  ?>
                                                <div class="form-horizontal">


                                                  
                                                <div class="control-group  <?php  if ($user_data->request_payment_type != "0") {   echo "hide";   }  ?>" >
                                                <label class="control-label">  <button class="btn btn-primary" id="generate_link_button" ><?php echo $admin_static_links['send_payment_link']['front']; ?></button> </label>
                                                </div>
                                               
                                                <div class="control-group  <?php  if ($user_data->request_payment_type == "0") {   echo "hide";   }  ?>" id="payment_link_div"  <?php  if ($user_data->request_payment_type == "0") {   ?> class="hide"  <?php }  ?>>
                                                <label class="control-label"><?php echo $admin_static_links['payment_link']['front']; ?> </label>
                                                <div class="controls" id="payment_link_element">
                                               <?php  echo base_url().$this->lang->default_lang."/user/quotation_pay/".$user_data->quotation_id; ?>
                                                </div>
                                                </div>

                                                

                                        <div id="generate_link_form" <?php  if ($user_data->request_payment_type == "0") {   echo "class='hide'";   }  ?>>

                                                <div class="control-group">
                                                <label class="control-label"><?php echo $admin_order_details['payment_type']['admin']; ?> </label>
                                                <div class="controls">
                                                <input type="radio" name="payment_type" value="2" <?php if(isset($user_data->request_payment_type) && $user_data->request_payment_type=="2"){ echo "checked"; } ?>>&nbsp;<?php echo $admin_static_links['payment_full']['front']; ?> &nbsp; &nbsp;<input type="radio"  <?php if(isset($user_data->request_payment_type) && $user_data->request_payment_type=="1"){ echo "checked"; } ?> name="payment_type" value="1">
                                                &nbsp;<?php echo $admin_static_links['payment_partial']['front']; ?>
                                                </div>
                                                <p class="red1 help-block"></p> 

                                                </div>

                                                <div class="control-group" id="percentage_div">
                                                <label class="control-label"><?php echo $admin_static_links['payment_percentage']['front']; ?></label>
                                                <div class="controls">
                                                <input type="text" class="form-control required_input"  id="limit" placeholder="limit" <?php if(isset($user_data->request_percentage) && $user_data->request_percentage!="0"){ echo "value='".$user_data->request_percentage."'"; } ?> name="limit" autocomplete="off" role="presentation">
                                                </div>
                                                <p class="red1 help-block"></p> 
                                                </div>

                                                <div class="control-group">
                                                <label class="control-label"><button class="btn btn-primary" id="generate_link" ><?php echo $admin_static_links['send_link']['front']; ?></button> </label>
                                                </div>
                                                </div>
                                         </div>
                            <?php } ?>
                                                <div class="download-controls">
                                                    <?php if ($user_data->order_status != "0") { ?>

                                                        <?php if (!empty($cart_package_data) && $user_data->incoterms == 'DAP') { ?>
                                                            <button class="btn btn-primary" id="open_download_packagelist"><?php echo $admin_static_links['download_package_list']['front']; ?></button>

                                                            <div style="display:none;" id="download_packagelist">
                                                                <?php $j = 1; $pack_type = array(); ?>
                                                                <?php foreach ($cart_package_data as $cart_package) { 
                                                                    
                                                                    $pack_type[] =$cart_package['package_type'];
                                                                    ?>
                                                                    <?php echo $j . '. '; ?><a href="<?php echo base_url() . 'assets/uploads/invoice/Packagelist_' . $user_data->order_number. '_' . $cart_package['package_name']  . '_' . $cart_package['tracking_number'] . '.pdf'; ?>" download><?php echo $admin_static_links['download_package_list']['front'] . '_' . $cart_package['package_name']  . '_' . $user_data->order_number.'_'.$cart_package['tracking_number'] . '.pdf'; ?></a><br />
                                                                    <?php $j++; ?>
                                                                <?php } ?>
                                                            </div>
                                                            <?php if(In_array("package",$pack_type)||(In_array("freight",$pack_type) && $user_data->carrier_name == 'FEDEX')){  ?>
                                                            <button class="btn btn-primary" id="open_download_image"><?php echo $admin_static_links['download_shipping_label']['front']; ?></button>

                                                            <div style="display:none;" id="download_image">
                                                                <?php $j = 1; ?>
                                                                <?php
                                                                $unique_label = array();

                                                                foreach ($cart_package_data as $cart_package) {

                                                                    if (!in_array($cart_package['tracking_number'], $unique_label)) {
                                                                        $unique_label[] = $cart_package['tracking_number'];
                                                                ?>
                                                                        <?php echo $j . '. ';

                                                                        $labeljpg = FCPATH . '/assets/uploads/invoice/Shipping_label_' . $cart_package['tracking_number'] . '.jpeg';
                                                                        $labelpng = FCPATH . '/assets/uploads/invoice/Shipping_label_' . $cart_package['tracking_number'] . '.png';
                                                                        $labelpdf = FCPATH . '/assets/uploads/invoice/Shipping_label_' . $cart_package['tracking_number'] . '.pdf';

                                                                        // if file not exist than create the file otherwise else condition works
                                                                        if (file_exists($labeljpg)) {
                                                                        ?>
                                                                            <a href="<?php echo base_url() . 'assets/uploads/invoice/Shipping_label_' . $cart_package['tracking_number'] . '.jpeg'; ?>" download><?php echo 'Shipping_label_' . $cart_package['tracking_number'] . '.jpeg'; ?></a>
                                                                        <?php }

                                                                        if (file_exists($labelpng)) {

                                                                        ?>
                                                                            <a href="<?php echo base_url() . 'assets/uploads/invoice/Shipping_label_' . $cart_package['tracking_number'] . '.png'; ?>" download><?php echo 'Shipping_label_' . $cart_package['tracking_number'] . '.png'; ?></a>


                                                                        <?php }  if (file_exists($labelpdf)) {

?>
    <a href="<?php echo base_url() . 'assets/uploads/invoice/Shipping_label_' . $cart_package['tracking_number'] . '.pdf'; ?>" download><?php echo 'Shipping_label_' . $cart_package['tracking_number'] . '.pdf'; ?></a>


<?php } ?> 
                                                                        <br />
                                                                        <?php $j++; ?>
                                                                <?php }
                                                                } ?>
                                                            </div>
                                                        <?php } } else { ?>
                                                            <button class="btn btn-primary" id="open_download_packagelist"><?php echo $admin_static_links['download_package_list']['front']; ?></button>
                                                            <div style="display:none;" id="download_packagelist">
                                                                <?php $j = 1; ?>
                                                                <?php echo $j . '. '; ?><a href="<?php echo base_url() . 'assets/uploads/invoice/Packagelist_' . $user_data->order_number.'.pdf'; ?>" download><?php echo $admin_static_links['download_package_list']['front']; ?></a><br />
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>

                                                    <?php if (isset($user_data->tax_exoneration_file) && $user_data->tax_exoneration_file != '') { ?>
                                                        <a href="<?php echo base_url() . 'assets/uploads/cart/' . $user_data->tax_exoneration_file; ?>" class="btn btn-primary" download><?php echo $admin_static_links['download_tax_exoneration_document']['front']; ?></a>
                                                    <?php } ?>
                                                </div>

                                            </div>
                                            <div class="clear"></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="navbar-inner">
                                <h5><?php echo $admin_order_details['order_details']['admin']; ?></h5>
                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                    <div class="edit_text" style="display:block"></div>
                                    <input type="text" value="<?php echo $admin_order_details['order_details']['admin']; ?>" class="edit_input_text" style="display: none;">
                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/order_details'; ?>">
                                <?php } ?>
                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/order_details/admin" class="fancybox multi_language_common_edit admin_globe">
                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                </a>
                            </div>
                            <div class="table-overflow">
                                <div class="dataTables_wrapper" role="grid">
                                    <table aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">
                                        <thead>
                                            <tr role="row">
                                                <th>

                                                    <label class="control-label"><?php echo $admin_order_details['srno']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['srno']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/srno'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/srno/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_order_details['kgt_ref']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['kgt_ref']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/kgt_ref'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/kgt_ref/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_order_details['order_qty']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['order_qty']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/order_qty'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/order_qty/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_order_details['product_type_title']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['product_type_title']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/product_type_title'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/product_type_title/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_order_details['unit_of_meas']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['unit_of_meas']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/unit_of_meas'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/unit_of_meas/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_order_details['order_qty']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['order_qty']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/order_qty'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/order_qty/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                </th>


                                            </tr>
                                        </thead>

                                        <tbody aria-relevant="all" aria-live="polite" role="alert">
                                            <?php
                                            $i = 1;
                                            if (isset($all_data)) {
                                                foreach ($all_data as $set_data) {

                                                    $privilage = isset($set_data['menuprivilages']) ? explode('#', $set_data['menuprivilages']) : array();
                                            ?>
                                                    <tr class="mainrow">
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $set_data['kgt_ref_number']; ?></td>
                                                    <td><?php echo ($set_data['product_qty']?$set_data['product_qty'].'/'.$set_data['cart_quantity']:$set_data['cart_quantity']); ?></td>
                                                    <td><?php echo $set_data['product_type_name']; ?></td>
                                                    <td><?php echo $set_data['unit_of_measurement']; ?></td>
                                                        <td><input type="button" id="minimize_block_<?php echo isset($set_data['id']) ? $set_data['id'] : ''; ?>" class="minimize_block" name="minimize_block" value="+"></td>
                                                    </tr>
                                                    <tr class="detailedrow minimize_block_<?php echo isset($set_data['id']) ? $set_data['id'] : ''; ?>">
                                                        <td colspan="11" class="paddingleft68px">

                                                            <div class="single_product_wrapper">
                                                                <div class="detail_wrap alignleft">
                                                                    
                                                                    <div class="single_detail">
                                                                        <span><?php echo $product_instruction['item_dimension']['front']; ?> :</span>
                                                                        <span><?php echo $set_data['item_height'] . 'X' . $set_data['item_width'] . 'X' . $set_data['item_length']; ?></span>
                                                                    </div>
                                                                    <div class="single_detail">
                                                                        <span><?php echo $product_instruction['item_weight']['front']; ?> :</span>
                                                                        <span><?php echo $set_data['item_weight']; ?></span>
                                                                    </div>
                                                                    <div class="single_detail">
                                                                        <span><?php echo $product_instruction['shipping_special_notes']['front']; ?> :</span>
                                                                        <span><?php echo $set_data['shipping_special_notes']; ?></span>
                                                                    </div>
                                                                    <div class="single_detail">
                                                                        <span><?php echo $product_instruction['quantity']['front']; ?> :</span>
                                                                        <span><?php echo ($set_data['product_qty']?$set_data['product_qty'].'/'.$set_data['cart_quantity']:$set_data['cart_quantity']); ?></span>
                                                                    </div>

                                                                    <div class="single_detail">
                                                                        <span><?php echo $product_instruction['comments']['front']; ?> :</span>
                                                                        <span><?php echo $set_data['comment']; ?></span>
                                                                    </div>
                                                                    <?php if(intval($set_data['tracking_number'])){?>
                                                                    <div class="single_detail">
                                                                        <?php
                                                                            $download_href="#";
                                                                            $labeljpg = FCPATH . '/assets/uploads/invoice/Shipping_label_' . $cart_package['tracking_number'] . '.jpeg';
                                                                            $labelpng = FCPATH . '/assets/uploads/invoice/Shipping_label_' . $cart_package['tracking_number'] . '.png';
                                                                            $labelpdf = FCPATH . '/assets/uploads/invoice/Shipping_label_' . $cart_package['tracking_number'] . '.pdf';
                                                                            if(file_exists($labeljpg)){
                                                                                $download_href = base_url().'/assets/uploads/invoice/Shipping_label_' . $cart_package['tracking_number'] . '.jpeg';
                                                                            }else if(file_exists($labelpng)){
                                                                                $download_href =  base_url().'/assets/uploads/invoice/Shipping_label_' . $cart_package['tracking_number'] . '.png';
                                                                            }else if (file_exists($labelpdf)){
                                                                                $download_href =  base_url().'/assets/uploads/invoice/Shipping_label_' . $cart_package['tracking_number'] . '.pdf';
                                                                            }else{
                                                                                $download_href = "";
                                                                            }
                                                                        ?>
                                                                        <span><?php echo $admin_order_details['ups_tracking_number']['admin']; ?> :</span>
                                                                        <span><a target="_blank" href="<?php echo $download_href;?>"><?php echo ucfirst($set_data['package_type'])." ". $set_data['tracking_number']; ?></a></span>
                                                                    </div>
                                                                    <?php }?>

                                                                </div>
                                                                <div class="detail_wrap aligncenter">

								    <?php if ($set_data['item_real_photo'] != '') { 
									 $item_images = explode(",",$set_data['item_real_photo']);
									?>
                                                                        <img src="<?= asset_url('assets/uploads/product_images/'.  $item_images[0]); ?>" width="95" height="80" />
                                                                    <?php } else { ?>
                                                                        <img src="./assets/admin/images/previewimage.jpg" width="75" />
                                                                    <?php } ?>


                                                                    <?php if ($set_data['item_schematic_photo'] != '') { ?>
                                                                        <img src="<?= asset_url('assets/uploads/cart/' . $set_data['cart_user_id'] . '/' . $set_data['pid'] . '/' . $set_data['item_schematic_photo']); ?>" width="95" height="80" />
                                                                    <?php } else { ?>
                                                                        <img src="./assets/admin/images/previewimage.jpg" width="75" />
                                                                    <?php } ?>

                                                                </div>
                                                                <div class="clear"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                        </tbody>

                                <?php
                                                    $i++;
                                                }
                                            }
                                ?>
                                    </table>
                                </div>
                            </div>

                            <!------------------    Payment History ---------->

                            <div class="navbar-inner">
                                <h5><?php echo $admin_order_details['order_payments']['admin']; ?></h5>
                                <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                    <div class="edit_text" style="display:block"></div>
                                    <input type="text" value="<?php echo $admin_order_details['order_payments']['admin']; ?>" class="edit_input_text" style="display: none;">
                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/order_payments'; ?>">
                                <?php } ?>
                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/order_payments/admin" class="fancybox multi_language_common_edit admin_globe">
                                    <img src="assets/uploads/global.jpg" height="20" width="20">
                                </a>
                            </div>
                            <div class="table-overflow">
                                <div class="dataTables_wrapper" role="grid">
                                    <table aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">
                                        <thead>
                                            <tr role="row">
                                                <th>

                                                    <label class="control-label"><?php echo $admin_order_details['srno']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['srno']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/srno'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/srno/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_order_details['invoice_number']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['invoice_number']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/invoice_number'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/invoice_number/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_order_details['payment_method']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['payment_method']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/payment_method'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/payment_method/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_order_details['transaction_id']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['transaction_id']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/transaction_id'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/transaction_id/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_order_details['paid_amount']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['paid_amount']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/paid_amount'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/paid_amount/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                </th>
                                                <th>
                                                    <label class="control-label"><?php echo $admin_order_details['payment_date']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang && ((isset($access['page_add']) && $access['page_add'] == 1) || (isset($access['page_edit']) && $access['page_edit'] == 1))) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_order_details['payment_date']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_order_details/payment_date'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_order_details/payment_date/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                </th>


                                            </tr>
                                        </thead>

                                        <tbody aria-relevant="all" aria-live="polite" role="alert">
                                            <?php
                                            $j = 1;
                                            if (isset($order_payments)) {
                                                foreach ($order_payments as $single_payment) {

                                                   
                                            ?>
                                                    <tr class="mainrow">
                                                    <td><?php echo $j; ?></td>
                                                    <td><?php echo $single_payment['invoice_number']; ?></td>
                                                    <td><?php echo getpaymentmethod($single_payment['payment_method']); ?></td>
                                                    <td><?php echo $single_payment['transaction_id']; ?></td>
                                                    <td><?php echo $single_payment['amount']." ".$single_payment['currency']."(".round($single_payment['amount'] /$user_data->amount * 100)."%)"; ?></td> 
                                                     <td><?php echo $single_payment['payment_created']; ?></td>
                                                        <td><input type="button" id="minimize_block_<?php echo isset($set_data['id']) ? $set_data['id'] : ''; ?>" class="minimize_block" name="minimize_block" value="+"></td>
                                                    </tr>
                                                    <tr class="detailedrow minimize_block_<?php echo isset($set_data['id']) ? $set_data['id'] : ''; ?>">
                                                        <td colspan="11" class="paddingleft68px">

                                                            <div class="single_product_wrapper">
                                                                <div class="detail_wrap alignleft">
                                                                    <?php if($single_payment['payment_method']=="1") { ?>
                                                                    <div class="single_detail">
                                                                        <span><?php echo $sales_order_preview['card_text']['front']; ?> :</span>
                                                                        <span><?php echo $single_payment['card_number']; ?></span>
                                                                    </div>
                                                                    <?php } ?>


                                                                    <?php if($single_payment['payment_method']=="3") { ?>
                                                                    <div class="single_detail">
                                                                        <span><?php echo $sales_order_preview['payment_proof_file']['front']; ?> :</span>
                                                                        <span><a href="<?php echo base_url() . 'assets/uploads/cart/' . $single_payment['payment_proof_file']; ?>" class="btn btn-primary" download><?php echo $admin_static_links['payment_payment_proof']['front']; ?></a></span>
                                                                    </div>
                                                                    <?php } ?>

                                                                    <?php if($single_payment['payment_method']=="2") { ?>

                                                                    <div class="single_detail">
                                                                        <span><?php echo $admin_order_details['last_payment_date']['admin']; ?> :</span>
                                                                        <span><?php echo $single_payment['last_payment_date']; ?></span>
                                                                    </div>

                                                                    <div class="single_detail">
                                                                        <span><?php echo $admin_order_details['payment_term_days']['admin']; ?> :</span>
                                                                        <span><?php echo $single_payment['payment_term_days']; ?></span>
                                                                    </div>
                                                                    <?php } ?>
                                                                    <div class="single_detail">
                                                                        <span><?php echo $admin_order_details['payment_type']['admin']; ?> :</span>
                                                                        <span><?php echo getpaymenttype($single_payment['payment_type']); ?></span>
                                                                    </div>
                                                                    <div class="single_detail">
                                                                        <span><?php echo $admin_order_details['status']['admin']; ?> :</span>
                                                                        <span><?php echo getpaymentstatus($single_payment['status']); ?></span>
                                                                    </div>
                                                                   <?php if ($single_payment['invoiceStatus'] == 1) {  ?>
                                                                    <div class="single_detail">
                                                                        <span></span>
                                                                        <span><a href="<?php echo base_url() . 'assets/uploads/invoice/Invoice_' . $single_payment['invoice_number'] . '.pdf'; ?>" class="btn btn-primary" download><?php echo $admin_static_links['download_invoice']['front']; ?></a></span>
                                                                    </div>
                                                                    <?php } ?>

                                                                </div>
                                                               
                                                                <div class="clear"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                        </tbody>

                                <?php
                                                    $j++;
                                                }
                                            }
                                ?>
                                    </table>
                                </div>
                            </div>
                                                        <!------------------    Payment History ---------->

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

               $(".mainrow .minimize_block").click(function() {
                            if ($(this).val() == '+')
                                $(this).val('-');
                            else
                                $(this).val('+');
                            $(this).closest(".mainrow").next(".detailedrow").toggle(100);
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


        function change_order_status(id, value) {

           
            $.ajax({
            type: "POST",
            url: "admin/<?php echo $lang_id; ?>/orders/update_status",
            /* The country id will be sent to this file */
            data: "id=" + id + "&status=" + value,
            beforeSend: function() {

            },
            success: function(msg) {
            alert('<?= $admin_static_links['data_successfully_updated']['front']; ?>');
            }
            });
        }

        $('#order_status').change(function() {

        change_order_status($("#order_status").attr("data-id"), $("#order_status").val())

        });


        
        $('#reset').click(function() {
            $("#limit").val("");
            $("input[name='payment_type']:radio").prop('checked', false);
            $('#generate_link_button').show();
            $('#generate_link_form').hide();
        });


        $('#generate_link').click(function() {
            var regex = new RegExp(/^\+?[0-9(),.-]+$/);


            if($("input[name='payment_type']:checked").length < 1) {
            var parent_div = $("input[name='payment_type']").closest('div.control-group');
            $(parent_div).addClass("has-error");
            $(parent_div).find('.help-block').html("<?= $form_validation_instruction['payment_option']['front']; ?>");
            $(parent_div).find('.help-block').addClass('blink_error');
            $("input[name='payment_type']").focus();
            return false;
            } else {
            var parent_div = $("input[name='payment_type']").closest('div.control-group');
            $(parent_div).addClass("has-error");
            $(parent_div).find('.help-block').html("");
            $(parent_div).find('.help-block').removeClass('blink_error');
            }

            // alert($("#pending_percentage").val());
            // alert($("#limit").val());

            // if(parseInt($("#limit").val()) > parseInt($("#pending_percentage").val())) {

            //     alert("fgsdfgsdfgsdf");
            // }
            if($("input[name='payment_type']:checked").val()=="1" && ($("#limit").val() =="" ||  isNaN($("#limit").val()) || parseFloat($("#limit").val()) > parseFloat($("#pending_percentage").val())) ) {
                var parent_div = $('#limit').closest('div.control-group');
                $(parent_div).addClass("has-error");
                $(parent_div).find('.help-block').addClass('blink_error');
                $(parent_div).find('.help-block').html("<?= $form_validation_instruction['payment_percentage']['front']; ?>");
                return false;
            }  else {
                var parent_div = $('#limit').closest('div.control-group');
                $(parent_div).addClass("has-error");
                $(parent_div).find('.help-block').removeClass('blink_error');
                $(parent_div).find('.help-block').html("");
            }

            $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'admin/' . $lang_id . '/orders/generate_link'; ?>",
                    type: "POST",
                    data: {
                        payment_type: function() {
                            return $("input[name='payment_type']:checked").val();
                        },
                        request_percentage: function() {
                            return $('#limit').val();
                        },
                        order_id: "<?php echo $order_id; ?>"
                      },
                    dataType: "json",
                    success: function(data) {

                        if(data.url){
                            $("#payment_link_div").show();
                            $("#payment_link_element").html(data.url);
                            alert('<?= $admin_static_links['data_sent_successfully']['front']; ?>');
                        }
                    }
                });

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

