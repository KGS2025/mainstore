<?php
$comingsoon = base_url() . 'assets/frontend/images/coming_soon.jpg';
if (isset($country_data) && !empty($country_data)) {
    foreach ($country_data as $cdata) {
        if (($cdata['short_code'] == $lang_id)) {
            if (isset($cdata['coming_soon_image']) && $cdata['coming_soon_image'] != '') {
                $comingsoon = global_img_link($cdata['coming_soon_image'], 'uploads/country/coming_soon/');
            } else {
                $comingsoon = base_url() . 'assets/frontend/images/coming_soon.jpg';
            }
            if (isset($cdata['no_image']) && $cdata['no_image'] != '') {
                $noimage = global_img_link($cdata['no_image'], 'uploads/country/no_image/');
            } else {
                $noimage = asset_url() . 'assets/admin/images/previewimage.jpg';
            }
        }
    }
}

$user_id = getFrontenduserId();

$model_items_name = array();

foreach ($product_model_items as $item) {

    if ($item['lang_item_name']) {
        $model_items_name[$item['id']]['name'] = $item['lang_item_name'];
    } else {
        $model_items_name[$item['id']]['name'] = $item['item_name'];
    }

    $model_items_name[$item['id']]['item_text_size'] = $item['item_text_size'];
    $model_items_name[$item['id']]['item_text_color'] = $item['item_text_color'];
}


$volume_unit = get_volume_unit();
$weight_unit = get_weight_unit();

$unit_of_meas = $volume_unit . "/" . $weight_unit;


$ASSET_VERSION = getenv('ASSET_VERSION');

$currencyV = getDefaultCurrencyCode('l') . '_currency';
$currency = $general_instruction->$currencyV;
$cart_unit_of_meas = cart_unit_of_meas($cart_users_data['volume_unit'], $cart_users_data['weight_unit']);

?>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/invoice-element.css?version=' . $ASSET_VERSION); ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">

<style>
    .model-slider-image-td.brand_complete_info {
        display: block !important;
    }
</style>

<div id="sales_preview_order">
    <div>
        <div class="table-responsive">
            <div class="brandDetailInfo" style="flex-wrap:wrap;margin-bottom: 10px;display: table; width:100%; align-items: start;justify-content: space-between;border: solid 1px #000;">
                <div class="brandDetails" style="display: table-cell; vertical-align: top; padding: 10px;">
                    <?php
                    if (isset($all_data['cart_photo']) && $all_data['cart_photo'] != '' && file_exists(FCPATH . 'assets/uploads/cart/small/' . $all_data['cart_photo'])) {
                        $cartphoto = global_img_link($all_data['cart_photo'], 'uploads/cart/small/');
                    } else if (isset($all_data['logo']) && file_exists(FCPATH . 'assets/uploads/logo/thumbnails/' . $all_data['logo'])) {
                        $cartphoto = global_img_link($all_data['logo'], 'uploads/logo/thumbnails/');
                    } else {
                        $cartphoto = $noimage;
                    }
                    ?>
                    <img src="<?php echo $cartphoto; ?>" alt="logo" style="max-width: 140px !important;">
                </div>
                <div class="brandDetails" style="display: table-cell; vertical-align: top; padding: 10px;">
                    <p style="padding-top: 12px;"><strong style="font-size:17.5px"><?php echo $sales_order_preview['logo_tagline']; ?></strong></p>
                    <p style="font-size:12px"><?php echo $sales_order_preview['company_address_1']; ?></p>
                    <p style="font-size:12px"><?php echo $sales_order_preview['company_address_2']; ?></p>
                    <p style="font-size:12px"><?php echo $sales_order_preview['company_address_3']; ?></p>
                </div>
                <div class="brandDetails" style="display: table-cell; vertical-align: top; padding: 10px;">
                    <div class="invoiceDetails">
                        <p style="text-align:center;border: solid 1px;margin-bottom: 10px;">
                            <strong>
                                <?php if ($view_type == "confirmcart") { ?>
                                    <?php echo $sales_order_preview['order_confirmation']; ?>
                                <?php } ?>

                                <?php if ($view_type == "invoice") { ?>

                                    <?php echo $sales_order_preview['invoice']; ?>

                                <?php } ?>
                            </strong>
                        </p>
                    </div>

                    <div class="brandDetails" style="display: table-cell; vertical-align: top; padding: 10px;">
                        <p style="font-size:12px;text-align:left;"><?php echo $sales_order_preview['company_phone']; ?></p>
                        <?php if (isset($sales_order_preview['company_fax']) && $sales_order_preview['company_fax'] != '') { ?>
                            <p style="font-size:12px;text-align:left;"><?php echo $sales_order_preview['company_fax']; ?></p>
                        <?php } ?>
                        <?php if (isset($sales_order_preview['company_email']) && $sales_order_preview['company_email'] != '') { ?>
                            <p style="font-size:12px;text-align:left;"><?php echo $sales_order_preview['company_email']; ?></p>
                        <?php } ?>
                        <p style="font-size:12px;text-align:left;"><?php echo $sales_order_preview['company_website']; ?></p>

                    </div>
                </div>
                <div class="brandDetails" style="display: table-cell; vertical-align: top; padding: 10px;">
                    <div style="border: solid 1px;padding:10px;">
                        <p style="text-align: center;">
                            <strong>
                                <?php echo $sales_order_preview['sales_preview_date']; ?>
                            </strong>
                        </p>
                        <p style="font-size:12px; text-align: center;">
                            <?php echo date("m/d/Y"); ?>
                        </p>

                        <?php if ($view_type == "invoice") { ?>
                            <p style="text-align: center;">
                                <strong>
                                    <?php echo $sales_order_preview['invoice_number']; ?>
                                </strong>
                            </p>
                            <p style="font-size:12px; text-align: center;">
                                <?php echo invoicenumber_front($payments['invoice_number']); ?>
                            </p>

                        <?php }  ?>
                        <p style="text-align: center;">
                            <strong>
                                <?php echo $sales_order_preview['order_number']; ?>
                            </strong>
                        </p>
                        <p style="font-size:12px; text-align: center;">
                            <?php echo $cart_users_data['order_number']; ?>
                        </p>

                        <?php if ($view_type != "invoice") {

                            $quotation_expdate = $this->session->userdata('quotation_expdate') ? $this->session->userdata('quotation_expdate') : "";

                            if ($quotation_expdate) {
                                $expiry_quot_date = date('Y-m-d', strtotime($quotation_expdate));
                            } else {
                                $quotation_daylimit = $this->config->item('quotation_daylimit');

                                $expiry_quot_date = date('Y-m-d', strtotime(date('Y-m-d') . ' + ' . $quotation_daylimit . ' days'));
                            }




                        ?>
                            <p style="text-align: center;">
                                <strong>
                                    <?php echo $sales_order_preview['quot_expiry_date']; ?>
                                </strong>
                            </p>
                            <p style="font-size:12px; text-align: center;">
                                <?php echo $expiry_quot_date; ?>
                            </p>

                        <?php }  ?>

                        <?php if (isset($cart_users_data['irs_fid_number']) && $cart_users_data['irs_fid_number'] != '') { ?>
                            <p style="text-align: center;">
                                <strong>
                                    <?php echo $sales_order_preview['irs_fid_number']; ?>
                                </strong>
                            </p>
                            <p style="font-size:12px; text-align: center;">
                                <?php echo $cart_users_data['irs_fid_number']; ?>
                            </p>
                        <?php } ?>
                        <?php if (isset($cart_users_data['tax_exoneration']) && $cart_users_data['tax_exoneration'] == 1 && isset($cart_users_data['tax_exoneration_number']) && $cart_users_data['tax_exoneration_number'] != '' && (($this->config->item('store_country') != $cart_users_data['country_code'] && $this->config->item('tax_applicable') == 1) || $this->config->item('store_country') == $cart_users_data['country_code'])) { ?>
                            <p style="text-align: center;">
                                <strong>
                                    <?php echo $sales_order_preview['tax_exoneration_number']; ?>
                                </strong>
                            </p>
                            <p style="font-size:12px; text-align: center;">
                                <?php echo $cart_users_data['tax_exoneration_number']; ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>

                <div class="brandDetails" style="display: table-cell; vertical-align: top; padding: 10px;">
                    <?php if (isset($cart_users_data['client_logo']) && $cart_users_data['client_logo'] != '' && file_exists(FCPATH . "assets/uploads/cart/thumb/" . $cart_users_data['client_logo'])) { ?>
                        <img src="<?php echo base_url(); ?>assets/uploads/cart/thumb/<?php echo $cart_users_data['client_logo']; ?>" alt="<?php echo $cart_users_data['client_logo']; ?>" width="88" height="auto" />
                    <?php } else { ?>
                        <img alt="client_logo" src="<?php echo $noimage; ?>" width="175" height="auto" />
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table style="width:100%;border: 1px solid #000;" cellpadding="10">
                <tr>
                    <td style="width:50%; vertical-align: top;" colspan="2">
                        <p style="margin:0px 0px 5px"><strong><?php echo $sales_order_preview['sold_to']; ?></strong></p>

                        <table border="1" style="width: 100%;" cellpadding="10">
                            <tr>
                                <td style="border:0px">
                                    <p style="font-size:12px;margin:4px 0px"><?php echo $cart_users_data['company']; ?></p>
                                    <p style="font-size:12px;margin:4px 0px"><?php echo $cart_users_data['user_name']; ?></p>
                                    <p style="font-size:12px;margin:4px 0px"><?php echo $cart_users_data['cart_address_1']; ?></p>
                                    <?php if (isset($cart_users_data['cart_address_2']) && $cart_users_data['cart_address_2'] != '') { ?>
                                        <p style="font-size:12px;margin:4px 0px"><?php echo $cart_users_data['cart_address_2']; ?></p>
                                    <?php } ?>
                                    <?php if (isset($cart_users_data['cart_address_3']) && $cart_users_data['cart_address_3'] != '') { ?>
                                        <p style="font-size:12px;margin:4px 0px"><?php echo $cart_users_data['cart_address_3']; ?></p>
                                    <?php } ?>
                                    <p style="font-size:12px;margin:4px 0px"><?php echo $cart_users_data['cart_city'] . ', ' . getState_Name($cart_users_data['country_shortcode'], $cart_users_data['cart_state']); ?></p>
                                    <p style="font-size:12px;margin:4px 0px"><?php echo $cart_users_data['country'] . ' ' . $cart_users_data['cart_zip']; ?></p>
                                    <p style="font-size:12px;margin:4px 0px">PH: +<?php echo $cart_users_data['country_code'] . ' ' . $cart_users_data['telephone']; ?></p>
                                    <p style="font-size:12px;margin:4px 0px"><?php echo $cart_users_data['email']; ?></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width:50%; vertical-align: top;" colspan="2">
                        <p style="margin:0px 0px 5px"><strong><?php echo $sales_order_preview['ship_to']; ?></strong></p>
                        <table border="1" style="width: 100%;" cellpadding="10">
                            <tr>
                                <td style="border:0px">
                                    <p style="font-size:12px;margin:4px 0px"><?php echo $cart_users_data['ship_company']; ?></p>
                                    <p style="font-size:12px;margin:4px 0px"><?php echo getnametitle($cart_users_data['ship_title']) . $cart_users_data['ship_surname']; ?></p>
                                    <p style="font-size:12px;margin:4px 0px"><?php echo $cart_users_data['ship_address_1']; ?></p>
                                    <?php if (isset($cart_users_data['ship_address_2']) && $cart_users_data['ship_address_2'] != '') { ?>
                                        <p style="font-size:12px;margin:4px 0px"><?php echo $cart_users_data['ship_address_2']; ?></p>
                                    <?php } ?>
                                    <?php if (isset($cart_users_data['ship_address_3']) && $cart_users_data['ship_address_3'] != '') { ?>
                                        <p style="font-size:12px;margin:4px 0px"><?php echo $cart_users_data['ship_address_3']; ?></p>
                                    <?php } ?>
                                    <p style="font-size:12px;margin:4px 0px"><?php echo $cart_users_data['ship_city'] . ', ' .  getState_Name($cart_users_data['ship_country_shortcode'], $cart_users_data['ship_state']); ?></p>
                                    <p style="font-size:12px;margin:4px 0px"><?php echo $cart_users_data['ship_country'] . ' ' . $cart_users_data['ship_zip']; ?></p>
                                    <p style="font-size:12px;margin:4px 0px">PH: +<?php echo $cart_users_data['ship_country_code'] . ' ' . $cart_users_data['ship_telephone']; ?></p>
                                    <?php if (isset($cart_users_data['edi_one']) && $cart_users_data['edi_one'] != '') { ?>
                                        <p style="font-size:12px;margin:4px 0px"><?php echo $cart_users_data['edi_one']; ?></p>
                                    <?php } ?>
                                    <?php if (isset($cart_users_data['edi_two']) && $cart_users_data['edi_two'] != '') { ?>
                                        <p style="font-size:12px;margin:4px 0px"><?php echo $cart_users_data['edi_two']; ?></p>
                                    <?php } ?>
                                    <p style="font-size:12px;margin:4px 0px"><?php echo $cart_users_data['ship_email']; ?></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div class="table-responsive" style="padding-top:10px">
            <table border="1" style="width: 100%; border: 1px solid #000;border-collapse: collapse;" cellpadding="10">
                <tr>
                <?php if ($this->config->item('hide_po_number') == '0') {  ?>
                    <td>
                        <p style="text-align:center;margin:4px 0px;"><strong><?php echo $sales_order_preview['po_number']; ?></strong></p>
                        <p style="font-size:12px; text-align:center;margin:4px 0px">
                        <?php 
                        
                        if ($cart_users_data['po_number']) {
                        echo $cart_users_data['po_number'];
                        }  if ($cart_users_data['po_file']) {
                        echo "/" . $sales_order_preview['po_attached'];
                        } else {
                        echo "/" . $sales_order_preview['po_notattached'];
                        }
                         ?>
                        </p>
                    </td>
                    <?php  } ?>
                    <td>
                        <p style="text-align:center;margin:4px 0px"><strong><?php echo $sales_order_preview['customer_no']; ?></strong></p>
                        <p style="font-size:12px; text-align:center;margin:4px 0px"><?php if ($cart_users_data['customer_no']) {
                                                                                        echo $cart_users_data['customer_no'];
                                                                                    } ?></p>
                    </td>
                    <td>
                        <p style="text-align:center;margin:4px 0px"><strong><?php echo $sales_order_preview['sls']; ?></strong></p>
                        <p style="font-size:12px; text-align:center;margin:4px 0px">042</p>
                    </td>
                    <td>
                        <p style="text-align:center;margin:4px 0px"><strong><?php echo $sales_order_preview['order_date']; ?></strong></p>
                        <p style="font-size:12px; text-align:center;margin:4px 0px"><?php echo date("m/d/Y"); ?></p>
                    </td>
                    <td>
			<p style="text-align:center;margin:4px 0px"><strong><?php echo $sales_order_preview['ship_via']; ?></strong></p>
			<?php $cart_instruction_array = (array)$cart_instruction; ?>
			    <p style="font-size:12px; text-align:center;margin:4px 0px"><?php echo getFreightName(trim($cart_users_data['freight'])). ' ' .$cart_instruction_array[$cart_users_data['method_of_transportation']]; ?></p><?php //echo $this->db->last_query();?>
                    </td>
                    <td>
                        <p style="text-align:center;margin:4px 0px"><strong><?php echo $sales_order_preview['carrier_account_no']; ?></strong></p>
                        <p style="font-size:12px; text-align:center;margin:4px 0px"><?php echo $cart_users_data['carrier_account_number']; ?></p>
                    </td>
                    <td>
                        <p style="text-align:center;margin:4px 0px"><strong><?php echo $sales_order_preview['terms']; ?></strong></p>
                        <p style="font-size:12px; text-align:center;margin:4px 0px"><?php if ($cart_users_data['payment_method'] == "1") {
                                                                                        echo $sales_order_preview['credit_card'];
                                                                                    } else if ($cart_users_data['payment_method'] == "3") {
                                                                                        echo $sales_order_preview['payment_proof'];
                                                                                    } else if ($cart_users_data['payment_method'] == "2" || $loginuserterm['credit_term_status'] == "1") {

                                                                                        $days =  ($loginuserterm['payment_term_days']) ? $loginuserterm['payment_term_days'] : $cart_users_data['payment_term_days'];
                                                                                        $credit_term_date = str_replace('{days}', $days, $sales_order_preview['credit_term_date']);
                                                                                        echo $credit_term_date;
                                                                                    } else {
                                                                                        if ($this->config->item('payment_gateway') == 'paymentproof') {
                                                                                        echo $sales_order_preview['payment_proof'];
                                                                                        } else {
                                                                                            echo $sales_order_preview['credit_card'];

                                                                                        }
                                                                                    } ?></p>
                    </td>
                    <td>
                        <p style="text-align:center;margin:4px 0px"><strong><?php echo $sales_order_preview['initials']; ?></strong></p>
                        <p style="font-size:12px; text-align:center;margin:4px 0px"><?php echo $cart_users_data['ship_title'] . $cart_users_data['ship_surname']; ?></p>
                    </td>
                </tr>
            </table>
        </div>
                                                            
        <div class="table-responsive" style="padding-top:10px">
            <table border="0" style="width: 100%;border: 1px solid #000;border-collapse: collapse;">
                <thead style="border-bottom: 1px solid #000; border-top: 1px solid #000;">
                    <tr>
                        <th style="width:80px">
                            <p style="text-align:center;font-size:12px;  margin:4px 0px"><strong><?php echo $sales_order_preview['chronological_display']; ?></strong></p>
                        </th>
                        <th style="width:40px">
                            <p style="text-align:center;font-size:12px; line-height:17px; margin:4px 0px"><strong><?php echo $sales_order_preview['quantity_ordered']; ?></strong></p>
                        </th>
                        <th style="width:40px">
                            <p style="text-align:center;font-size:12px;  margin:4px 0px"><strong><?php echo $sales_order_preview['quantity_shipped']; ?></strong></p>
                        </th>
                        <th>
                            <p style="text-align:center;font-size:12px;  margin:4px 0px"><strong><?php echo $sales_order_preview['country_origin']; ?></strong></p>
                        </th>
                        <th style="width:50px">
                            <p style="text-align:center;font-size:12px; margin:4px 0px"><strong><?php echo $sales_order_preview['item_number']; ?></strong></p>
                        </th>
                        <th style="width:80px">
                            <p style="text-align:center;font-size:12px; margin:4px 0px"><strong><?php echo $sales_order_preview['part_name']; ?></strong></p>
                        </th>
                        <th>
                            <p style="text-align:center;font-size:12px; margin:4px 0px"><strong><?php echo $sales_order_preview['unit_price']; ?></strong></p>
                        </th>
                        <th>
                            <p style="text-align:center;font-size:12px;margin:4px 0px"><strong><?php echo $sales_order_preview['uom']; ?></strong></p>
                        </th>
                        <th>
                            <p style="text-align:right;font-size:12px;  margin:4px 0px"><strong><?php echo $sales_order_preview['extended_price']; ?></strong></p>
                        </th>
                        <th style="width:50px">
                            <p style="text-align:right;font-size:12px;  margin:4px 0px"><strong><?php echo $sales_order_preview['part_number_photo']; ?></strong></p>
                        </th>

                        <th style="width:50px">
                            <p style="text-align:right;font-size:12px;  margin:4px 0px"><strong><?php echo $sales_order_preview['where_used_schematic_photo']; ?></strong></p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    $subtotal = 0;
                    $discount = 0;
                    $currentproducttype = '';
                    $order_attribute_data = array();
                    $order_models = array();


                    //echo '<pre>';print_r($cart_data);print_r($cart_details);echo '</pre>';
                    foreach ($cart_details as $cart) {
                       
                        $cart_information = $cart_data[$cart['id']];                       
                        $cart_quantity = $cart_information['quantity'];
                        if(!is_array($cart_quantity)){

                        }
                        foreach($cart_quantity as $key=>$cart_qty){
                        if($cart_qty>0){
                            //echo '<pre>';print_r($key);echo " ";print_r($cart_qty);echo " " ;print_r($ship_quantity);echo '</pre>';
                        if(isset($cart_information['store_data'])){
                            $stores_list = $cart_information['store_data'];
                            $item_store_name = '';
                            foreach ($stores_list as $st){                            
                                if($st['store_id']==$key){
                                    $item_store_name = $st['name'];
                                }
                            }      
                        }else{
                            $item_store_name = str_replace(":","", $cart_data[$cart['id']]['comment'][$key]);
                        }     

                        $ship_quantity = 0;
                        $item_price = 0;
                        $remaining_quantity = 0;
                        $pro_real_images = array();
                        if ($cart['ship_quantity'] >= $cart_qty) {
                            $ship_quantity = $cart_qty;
                        } else {
                            $ship_quantity = $cart['ship_quantity'];
                            $remaining_quantity = $cart_qty -  $cart['ship_quantity'];
                        }

                        $availableQuantity = $cart['ship_quantity'];
                        $userQuantity      = $cart_qty;
                        $isBlock = $isBackOrder = 0;
                        if ($cart['backorder_status'] == 0) {
                            if ($availableQuantity > $userQuantity) {
                                $ship_quantity = $userQuantity;
                            } else if ($availableQuantity <= 0) {
                                $ship_quantity = $remaining_quantity = 0;
                                $isBlock = 1;
                            } else if ($userQuantity > $availableQuantity) {
                                $ship_quantity = $availableQuantity;
                                $remaining_quantity = $availableQuantity;
                                $isBlock = 1;
                            }
                        } else if ($cart['backorder_status'] == 1) {
                            if ($availableQuantity > $userQuantity) {
                                $ship_quantity = $userQuantity;
                            } else if ($availableQuantity <= 0) {
                                $ship_quantity = $userQuantity;
                                $isBackOrder = 1;
                                $remaining_quantity = $userQuantity;
                            } else if ($userQuantity > $availableQuantity) {
                                $ship_quantity = $availableQuantity;
                                $remaining_quantity = $userQuantity - $availableQuantity;
                                $isBackOrder = 1;
                            }
                        }

                        $item_price = $cart['price'];

                    ?>
                        <tr>
                            <td>
                                <p style="text-align:center; font-size:12px;margin:4px 0px"><?php echo $i ?></p>
                            </td>
                            <td>
                                <p style="text-align:center; font-size:12px;margin:4px 0px"><?php echo $cart_qty; ?></p>
                            </td>
                            <td>
                                <p style="text-align:center; font-size:12px;margin:4px 0px"><?php echo $ship_quantity; ?></p>
                            </td>
                            <td>
                                <p style="text-align:center; font-size:12px;margin:4px 0px">

                                    <?php
                                    if (isset($cart['prodcntry']) && $cart['prodcntry'] != '') {
                                        echo $cart['prodcntry'];
                                    } else {
                                        echo  $cart['countryName'];
                                    }
                                    ?>


                                </p>
                            </td>
                            <td>
                                <p style="font-size:12px; text-align:center;margin:4px 0px"><?php echo $cart['kgt_ref_number']; ?></p>
                            </td>
                            <td>
                                <p style="font-size:12px; text-align:center;margin:4px 0px">
                                    <?php
                                    if (isset($cart['lang_part_name']) && $cart['lang_part_name'] != '') {
                                        echo $cart['part_name'];
                                    } else {
                                        echo  $cart['part_name'];
                                    }
                                    ?>
                                </p>
                            </td>
                            <td>
                                <p style="text-align:center; font-size:12px;margin:4px 0px"><?php echo $item_price; ?></p>
                            </td>
                            <td>

                                <p style="text-align:center; font-size:12px;margin:4px 0px"><?php echo $sales_order_preview['uom_text']; ?><br /><?php echo $unit_of_meas ?><br /><br /><?php echo $sales_order_preview['item_dimension']; ?><br /><?php echo $cart['item_height'] . 'X' . $cart['item_width'] . 'X' . $cart['item_length']; ?><br /><br /><?php echo $sales_order_preview['item_weight']; ?><br /><?php echo $cart['item_weight']; ?></p>
                            </td>
                            <td>
                                <p style="text-align:center; font-size:12px;margin:4px 0px"><?php echo $item_price * $ship_quantity; ?></p>
                            </td>
                            <?php if ($cart['item_real_photo'] != '') {

                                $pro_real_images = explode(",", $cart['item_real_photo']);
                                $single_real_image = $pro_real_images[0];


                            ?>
                                <td>
                                    <div class="model-slider-image-td brand_complete_info" style="display:block !important;">
                                        <div id="real-image-slider-<?php echo $cart['id']; ?>" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php

                                                if (isset($single_real_image) && $single_real_image != '' && file_exists("assets/uploads/product_images/" . $single_real_image)) {  ?>
                                                    <div class="carousel-item active">
                                                        <a class="d-inline-block example-image-link" data-lightbox="examplereal-<?php echo $cart['id']; ?>" href="<?php echo asset_url(); ?>assets/uploads/product_images/<?php echo $single_real_image; ?>"><img class="img-responsive" src="<?php echo asset_url(); ?>assets/uploads/product_images/<?php echo $single_real_image; ?>" width="50" height="auto" alt="<?php echo $single_real_image; ?>" /></a>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="carousel-item  active">
                                                        <a class="d-inline-block example-image-link" data-lightbox="examplereal-<?php echo $cart['id']; ?>" href="<?php echo $comingsoon; ?>"><img class="img-responsive" alt="product_images" src="<?php echo $comingsoon; ?>" width="50" height="auto"> </a>
                                                    </div>
                                                <?php }

                                                ?>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            <?php } else { ?>
                                <td style="text-align:center;"><a class="d-inline-block example-image-link" data-lightbox="example-<?php echo $cart['id']; ?>" href="<?php echo $comingsoon; ?>"><img alt="product_images" src="<?php echo $comingsoon; ?>" width="120" height="80"> </a></td>
                            <?php } ?>




                            <?php if ($cart['item_schematic_photo_status'] == 0) { ?>
                                <?php if ($cart['item_schematic_photo'] != '' && file_exists("assets/uploads/product_images/thumb/" . $cart['item_schematic_photo'])) { ?>
                                    <td style="text-align:center;"><a class="d-inline-block example-image-link" data-lightbox="example-<?php echo $cart['id']; ?>" href="<?php echo asset_url(); ?>assets/uploads/product_images/<?php echo $cart['item_schematic_photo']; ?>"><img src="<?php echo base_url(); ?>assets/uploads/product_images/thumb/<?php echo $cart['item_schematic_photo']; ?>" height="75" /></a></td>
                                <?php } else { ?>
                                    <td style="text-align:center;"><a class="d-inline-block example-image-link" data-lightbox="example-<?php echo $cart['id']; ?>" href="<?php echo $comingsoon; ?>"><img alt="product_images" src="<?php echo $comingsoon; ?>" width="120" height="80"> </a></td>
                                <?php } ?>
                            <?php } else { ?>
                                <td style="text-align:center;">--</td>
                            <?php } ?>
                        </tr>


                        <tr>
                            <td colspan="1">
                                <p style="font-size:12px;margin:4px 0px"><?php echo $sales_order_preview['description']; ?>:</p>
                            </td>
                            <td colspan="11">
                                <p style="font-size:12px;margin:4px 0px">
                                    <?php if (isset($cart['product_type_name']) && $cart['product_type_name'] != '') {
                                        echo $cart['product_type_name'];
                                    } else {
                                        echo  $cart['type'];
                                    }  ?>

                                <?php echo isset($item_store_name)?"( ".$item_store_name." )":""; ?> 
                                </p>
                            </td>
                            
                        </tr>



                        <?php if ($cart_data[$cart['id']]['comment']) { 
                            $cart_data[$cart['id']]['comment'][$key] = str_replace(":","",$cart_data[$cart['id']]['comment'][$key]);
                            ?>
                            <tr>
                                <td colspan="1">
                                    <p style="font-size:12px;margin:4px 0px"><?php echo $sales_order_preview['comments']; ?>:</p>
                                </td>
                                <td colspan="11">
                                    <p style="font-size:12px;margin:4px 0px"><?php echo $cart_data[$cart['id']]['comment'][$key]; ?></p>
                                </td>
                            </tr>
                        <?php } ?>




                        <?php if ($isBlock == 1) { ?>
                            <input type="hidden" class="p_block" value="1" />
                            <tr style="border-bottom:1px solid #000;">
                                <?php if (isset($cart['lang_availability_backorder_no']) && $cart['lang_availability_backorder_no'] != '') {
                                    $availability_no_lang = $cart['lang_availability_backorder_no'];
                                } else {
                                    $availability_no_lang = $cart['availability_backorder_no'];
                                }
                                $availability_no_lang = str_replace('{itemquantity}', $remaining_quantity, $cart_instruction->backorder_not_accept_msg);
                                $availability_no_lang = str_replace('{product_items}', $cart['kgt_ref_number'], $availability_no_lang);
                                $availability_no_lang = str_replace('{ex_stock_period}', $cart['ex_stock_period'], $availability_no_lang);
                                ?>
                                <td colspan="12">
                                    <p style="font-size:12px;"><?php echo $availability_no_lang; ?></p>
                                </td>
                            </tr>
                        <?php } ?>

                        <?php if ($isBackOrder == 1) { ?>
                            <tr style="border-bottom:1px solid #000;">
                                <?php if (isset($cart['lang_availability']) && $cart['lang_availability'] != '') {
                                    $availability_lang = $cart['lang_availability'];
                                } else {
                                    $availability_lang = $cart['availability'];
                                }
                                $availability_lang = str_replace('{itemquantity}', $remaining_quantity, $cart_instruction->backorder_accept_msg);
                                $availability_lang = str_replace('{product_items}', $cart['kgt_ref_number'], $availability_lang);
                                $availability_lang = str_replace('{ex_stock_period}', $cart['ex_stock_period'], $availability_lang);
                                ?>
                                <td colspan="12">
                                    <p style="font-size:12px;margin:4px 0px"><?php echo $availability_lang; ?></p>
                                </td>
                            </tr>
                        <?php } ?>

                        <?php
                        $price = 0;
                        $c_discount =  0;
                        $u_discount =  0;



                        $price = $item_price * $ship_quantity;
                        if ($coupon_applied == "1") {
                            $product_discount = get_product_discount($cart['id'], $item_price, $ship_quantity, $coupon_data);
                            if ($product_discount['amount']) {
                                $c_discount =  $product_discount['amount'];
                            } else {
                                $c_discount =  0;
                            }
                        }

                        // User Discount Price
                        $user_discount = get_user_product_discount($cart['id'], $item_price, $ship_quantity);
                        if ($user_discount['amount']) {
                            $u_discount =  $user_discount['amount'];
                        } else {
                            $u_discount =  0;
                        }

                        if ($u_discount > $c_discount) {
                            $discount += $u_discount;
                        } else {
                            $discount += $c_discount;
                        }


                        $subtotal += $price;
                        ?>
                    <?php $i++;
                    }}
                    }
                    $this->session->set_userdata(array('order_attribute_data' => $order_attribute_data, 'discount' => $discount, 'order_models' => $order_models));

                    ?>
                </tbody>
            </table>
        </div>

        
        <div class="table-responsive" style="padding-top:10px;">
            <table border="0" style="width:100%; border-top: 1px solid #000; border-bottom: 1px solid #000;" cellpadding="0">
                <tr>
                    <?php if ($cart_users_data['freight'] != 'COL') {
                        $businessdaysintransit = '';
                        $businessdaysintransit_text = '';
                        $deliverybytime = '';
                        $deliverybytime_text = '';

                        if (isset($cart_users_data['transit_days']) && $cart_users_data['transit_days'] != '') {
                            $businessdaysintransit = $cart_users_data['transit_days'];
                            $businessdaysintransit_text = $sales_order_preview['transit_days'];
                        }

                        if (isset($cart_users_data['delivery_by_time']) && $cart_users_data['delivery_by_time'] != '') {
                            $deliverybytime = $cart_users_data['delivery_by_time'];
                            $deliverybytime_text = $sales_order_preview['delivery_by_time'];
                        } ?>
                        <td style="width: 50%;">
                            <table border="0" style="width: 100%; float:left; margin: 5px 0px;" cellpadding="2">
                                <?php
                                                                if ($cart_users_data['carrier_name'] != 'FREIGHTCOM') { 

                                if (count($cart_package_data) > 0) { 
                                    
                                    
                                    
                                    
                                    ?>
                                    <tr>
                                        <td>
                                            <p style="font-size:12px;margin:4px 0px"><strong> <?php echo $sales_order_preview['tracking']; ?></strong></p>
                                            <?php
                                            $unique_tracking = array();
                                            foreach ($cart_package_data as $cart_package) {


                                                if (!in_array($cart_package['tracking_number'], $unique_tracking)) {
                                                    $unique_tracking[] = $cart_package['tracking_number']; ?>
                                                    <p style="font-size:12px;"><?php echo ucfirst($cart_package['package_type'])." ".$cart_package['tracking_number']; ?> </p>
                                            <?php }
                                            } ?>


                                        </td>
                                    </tr>
                                <?php } } ?>
                                <?php if (isset($businessdaysintransit) && $businessdaysintransit != '') { ?>
                                    <tr>
                                        <td>
                                            <p style="font-size:12px;margin:4px 0px"><strong><?php echo $sales_order_preview['estimated_transit_time']; ?> - <?php echo $businessdaysintransit . ' ' . $businessdaysintransit_text . ' ' . $deliverybytime_text . ' ' . $deliverybytime; ?></strong></p>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    <?php } ?>

                    <td style="width: 50%;">
                        <table border="0" style="width: 70%; float:right; margin: 5px 0px;" cellpadding="2">
                            <tr>
                                <td>
                                    <p style="font-size:12px;margin:4px 0px"><strong><?php echo $sales_order_preview['subtotal']; ?></strong></p>
                                </td>
                                <td>
                                    <p style="font-size:12px; float:right;margin:4px 0px"><strong><?php echo round($subtotal, 2); ?></strong></p>
                                </td>
                            </tr>
                            <?php if ((isset($freight) && $freight != 0) || (isset($cart_users_data['shipping_rate_freight']) && $cart_users_data['shipping_rate_freight'] != 0)) { 
                                
                                $freight = $freight  + $cart_users_data['shipping_rate_freight'];

                                
                                ?>
                                <tr>
                                    <td>
                                        <p style="font-size:12px;margin:4px 0px"><strong><?php echo $sales_order_preview['freight']; ?></strong></p>
                                    </td>
                                    <td>
                                        <p style="font-size:12px; float:right;margin:4px 0px"><strong><?php echo $freight; ?></strong></p>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td>
                                    <p style="font-size:12px;margin:4px 0px"><strong><?php echo $sales_order_preview['totaltax']; ?></strong></p>
                                </td>
                                <td>
                                    <p style="font-size:12px; float:right;margin:4px 0px"><strong>
                                            <?php

                                            $totaltax = 0;

                                            if (isset($tax_base_rate) && $tax_base_rate != 0 && ($this->config->item('store_country') != $cart_users_data['country_code'] && $this->config->item('tax_applicable') == 1) || $this->config->item('store_country') == $cart_users_data['country_code']) {
                                                $totaltax = (($subtotal + $freight) * $tax_base_rate) / 100;
                                            }
                                            $totaltax = round($totaltax, 2);
                                            echo $totaltax;
                                            ?>
                                        </strong></p>
                                </td>
                            </tr>
			    <?php if (!empty($discount)) { ?>
			    	<?php $discount_details = round(($discount/$subtotal)*100,2);?>
                                <tr style="border-bottom: 2px solid #000;">
                                    <td>
                                        <p style="font-size:12px;margin:4px 0px"><strong><?php echo $sales_order_preview['discount'].($discount_details?" (".$discount_details."%)":""); ?></strong></p>
                                    </td>
                                    <td>
                                        <p style="font-size:12px; float:right;margin:4px 0px"><strong><?php echo round($discount, 2); ?></strong></p>
                                    </td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <td>
                                    <p style="font-size:12px;margin:4px 0px">
                                        <strong><?php echo $sales_order_preview['totalorder']; ?>
                                            (<?php echo $currency; ?>)
                                        </strong>
                                    </p>
                                </td>
                                <?php $total = $subtotal + $freight + $totaltax - $discount; ?>

                                <td>
                                    <p style="font-size:12px; float:right;margin:4px 0px"><strong><?php echo round($total, 2); ?></strong></p>
                                </td>
                            </tr>

                            <?php 
                            

                            $payment_type = get_payment_type();
                                
                            
                            if ($this->config->item('partial_payment_enable')=="1" && (!empty($this->session->userdata('amount_received')) || !empty($cart_users_data['amount_received']))) {

                            if($this->session->userdata('amount_received')){

                            $amount_received = $this->session->userdata('amount_received');
                            } else if($cart_users_data['amount_received']){
                            $amount_received = $cart_users_data['amount_received'];

                            }

                            $amount_received_perc = round($amount_received / $total * 100);
                              ?>
                            <tr>
                                <td>
                                    <p style="font-size:12px;margin:4px 0px">
                                        <strong><?php echo $sales_order_preview['order_received_amount']; ?> 
                                        <?php if($amount_received_perc) { echo "(".$amount_received_perc.$sales_order_preview['percentage_in'].$currency.")"; } ?>   
                                        </strong>
                                    </p>
                                </td>
                                
                                

                                <td>
                                    <p style="font-size:12px; float:right;margin:4px 0px"><strong><?php echo round($amount_received, 2); ?></strong></p>
                                </td>
                            </tr>
                            <?php } ?>


                            <?php
                            $partial_payment_percentage =  ($this->session->userdata('partial_payment_percentage')) ? $this->session->userdata('partial_payment_percentage') : $this->config->item('partial_payment_percentage');
                            $payale_amount = "";
                            if ($this->config->item('partial_payment_enable')=="1" && $payment_type=="1" ) {
                            $payale_amount= $total * $partial_payment_percentage /100;
                            } else  if ($this->config->item('partial_payment_enable')=="1" && $payment_type=="2" ) {
                            $payale_amount = $total - $amount_received;
                            } else {
                            $payale_amount= $total;
                            }


                            if($view_type == "invoice" && $payments['payment_method'] == "1") {
                              $payale_amount=$payments['amount'];
                            } else {

                                $payale_amount= $total;

                            }
                            $percetange_payable= round($payale_amount /$total * 100);

                            ?>


                            <tr>
                                <td>
                                    <p style="font-size:12px;margin:4px 0px">
                                        <strong><?php echo $sales_order_preview['order_payment']; ?>
                                            <?php if($percetange_payable) { echo "(".$percetange_payable."% in ".$currency.")"; } ?>
                                        </strong>
                                    </p>
                                </td>
 
                                <td>
                                    <p style="font-size:12px; float:right;margin:4px 0px"><strong><?php echo round($payale_amount, 2); ?></strong></p>
                                </td>
                            </tr>

                         
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <div class="table-responsive" style="padding-top:10px;">
            <table border="0" style="width:100%;" cellpadding="0">
                <tr>
                    <td>
                        <p style="font-size:12px; margin:4px 0px text-align:center;"><strong><?php echo strtoupper($sales_order_preview['terms_condition_sale']); ?></strong></p>
                        <p style="font-size:12px; padding-bottom:12px; margin:4px 0px"><?php echo $sales_order_preview['terms_condition_text']; ?></p>
                    </td>
                </tr>
            </table>
        </div>




        <?php 
        /*******************  Show on invoice page */
        
        if ($view_type == "invoice" && $payments['payment_method'] == "1") { ?>
        

            <div class="table-responsive" style="padding-top:10px;">
                <table border="0" style="width:100%; text-align:center; background-color:#f7f7f7;" cellpadding="10">
                    <tr>
                        <td style="width: 100%;"><strong><?php echo $sales_order_preview['receipt']; ?></strong>
                        </td>
                    </tr>
                </table>
            </div>


            <div class="table-responsive" style="padding-top:10px;">
                <table border="0" style="width:100%;" cellpadding="0">
                    <tr>
                        <td style="width: 25%;"><img src="<?php echo $cartphoto; ?>" alt="logo" style="max-width: 250px !important;">
                            <p style="padding-top: 12px;margin:4px 0px"><strong style="font-size:17.5px"><?php echo $sales_order_preview['logo_tagline']; ?></strong></p>
                            <p style="font-size:12px;margin:4px 0px"><?php echo $sales_order_preview['company_address_1']; ?></p>
                            <p style="font-size:12px;margin:4px 0px"><?php echo $sales_order_preview['company_address_2']; ?></p>
                            <p style="font-size:12px;margin:4px 0px"><?php echo $sales_order_preview['company_address_3']; ?></p>
                        </td>
                        <td style="width: 50%;">
                        </td>
                        <td style="width:25%;">
                            <?php if ($cart_users_data['client_logo'] != '' && file_exists(FCPATH . "assets/uploads/cart/thumb/" . $cart_users_data['client_logo'])) { ?>
                                <img src="<?php echo base_url() . 'assets/uploads/cart/thumb/' . $cart_users_data['client_logo']; ?>" width="175" height="auto" />
                            <?php } else { ?>
                                <img alt="client_logo" src="<?php echo $noimage; ?>" width="175" height="auto" />
                            <?php } ?>
                        </td>
                    </tr>
                </table>
            </div>
            <br />

            <div class="table-responsive">
                <table style="width:100%;" cellpadding="0">
                    <tr>
                        <td>
                            <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['company_address_1']; ?></p>
                            <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['company_address_2']; ?></p>
                            <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['company_address_3']; ?></p>
                            <?php if (isset($sales_order_preview['company_phone']) && $sales_order_preview['company_phone'] != '') { ?>

                                <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['company_phone']; ?></p>
                            <?php } ?>
                            <?php if (isset($sales_order_preview['company_fax']) && $sales_order_preview['company_fax'] != '') { ?>
                                <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['company_fax']; ?></p>
                            <?php } ?>
                            <?php if (isset($sales_order_preview['company_email']) && $sales_order_preview['company_email'] != '') { ?>
                                <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['company_email']; ?></p>
                            <?php } ?>
                            <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['company_website']; ?></p>
                            <?php if ($cart_users_data['country_shortcode'] != 'ca') { ?>
                                <?php if (isset($sales_order_preview['gst_number']) && $sales_order_preview['gst_number'] != '') { ?>
                                    <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['gst_text'] . ' : ' . $sales_order_preview['gst_number']; ?></p>
                                <?php } ?>


                                <?php if (isset($sales_order_preview['fed_id']) && $sales_order_preview['fed_id'] != '') { ?>
                                    <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['fed_id_text'] . ' : ' . $sales_order_preview['fed_id']; ?></p>
                                <?php }
                                ?>

                            <?php
                            } ?>
                            <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['invoice_number']; ?>:<?php echo invoicenumber_front($payments['invoice_number']); ?></p>

                            <p style="font-size:13px; margin:4px 0px"><?php
                                                                        echo $sales_order_preview['totalorder'];
                                                                        echo ' : ' . round($total, 2) . ' ( ' . $currency . ' ) ';
                                                                        ?>
                            </p>
                        </td>


                        <td>
                            <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['receipt_please_retails']; ?></p>
                            <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['purchase']; ?><?php echo date('Y-m-d'); ?></p>

                            <?php if ($this->config->item('payment_gateway') == 'clictopay') { ?>
                                <p style="font-size:13px;margin:4px 0px"><?php echo $sales_order_preview['card_text']; ?> <?php echo $payments['card_number']; ?> <?php echo round($payments['amount'], 2) . '( ' . $currency . ' ) '; ?></p>
                                <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['auth_text']; ?> <?php echo $payments['transaction_id']; ?></p>
                            <?php } else if ($this->config->item('payment_gateway') == 'paymee') { ?>
                                <p style="font-size:13px;margin:4px 0px"><?php echo $sales_order_preview['card_text']; ?> <?php echo $payments['card_number']; ?> <?php echo round($payments['amount'], 2) . '( ' . $currency . ' ) '; ?></p>
                                <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['auth_text']; ?> <?php echo $payments['transaction_id']; ?></p>
                            <?php } else  if ($this->config->item('payment_gateway') != 'paymee') { ?>
                                <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['card_text']; ?> **** **** **** <?php echo $payments['card_number']; ?> <?php echo round($payments['amount'], 2) . '( ' . $currency . ' ) '; ?></p>
                                <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['auth_text']; ?> <?php echo $payments['transaction_id']; ?></p>
                            <?php } ?>
                            <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['approved_thank_you']; ?></p>
                            <p style="font-size:13px; margin:4px 0px"><?php echo $sales_order_preview['cardholder_copy']; ?></p>
                            <p style="font-size:13px; margin:4px 0px"><?php echo date('d M Y H:i:s'); ?></p>
                        </td>
                    </tr>
                </table>
            </div>
        <?php }  ?>
    </div>

</div>
