<?php
ob_clean();
$comingsoon = FCPATH . '/assets/frontend/images/coming_soon.png';
$noimage = FCPATH . '/assets/frontend/images/noimage1.png';

if (isset($all_data['cart_photo']) && $all_data['cart_photo'] != '' && file_exists(FCPATH . 'assets/uploads/cart/small/' . $all_data['cart_photo'])) {
    $cartphoto = FCPATH . '/assets/uploads/cart/small/' . $all_data['cart_photo'];
} elseif (isset($all_data['logo']) && file_exists(FCPATH . 'assets/uploads/logo/thumbnails/' . $all_data['logo'])) {
    $cartphoto = FCPATH . '/assets/uploads/logo/thumbnails/' . $all_data['logo'];
} else {
    $cartphoto = $noimage;
}

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
}

$invoicepdfname = 'Invoice_' . $payments['invoice_number'];
$invoicepdfURL = base_url() . '/assets/uploads/invoice/' . $invoicepdfname . '.pdf';
$invoicepdfPATH = FCPATH . '/assets/uploads/invoice/' . $invoicepdfname . '.pdf';

$cart_unit_of_meas = cart_unit_of_meas($cart_users_data['volume_unit'], $cart_users_data['weight_unit']);

$html = '<html>
        <table style="border: 1px solid #000;width:100%;" cellpadding="10">
            <tbody>
                <tr>
                    <td style="vertical-align: top; padding-top: 11px;">
                        <img width="100px" src="' . $cartphoto . '" alt="logo"/>
                        </td>
                    <td style="vertical-align: top; padding-top: 11px;">
                        <strong>' . $sales_order_preview['logo_tagline'] . '</strong><br />
                        ' . $sales_order_preview['company_address_1'] . '<br />
                        ' . $sales_order_preview['company_address_2'] . '<br />
                        ' . $sales_order_preview['company_address_3'] . '<br />
                    </td>

                    <td style="vertical-align: top;">
                        <table style="width: 100%; margin-top:25px;" cellpadding="2">
                            <tr>
                                <td><table style="border:solid 1px #000;width: 100%; text-align:center;" cellpadding="10">
                                    <tr>
                                        <td><strong>' . $sales_order_preview['invoice'] . '</strong>
                                        </td>
                                    </tr>
                                </table><br /><br />' . $sales_order_preview['company_phone'] . '<br />';

if (isset($sales_order_preview['company_fax']) && $sales_order_preview['company_fax'] != '') {
    $html .= $sales_order_preview['company_fax'] . '<br />';
}

if (isset($sales_order_preview['company_email']) && $sales_order_preview['company_email'] != '') {
    $html .= $sales_order_preview['company_email'] . '<br />';
}

$html .= $sales_order_preview['company_website'] . '<br />';

if ($cart_users_data['country_shortcode'] != 'ca') {
    if ((isset($sales_order_preview['fed_id']) && $sales_order_preview['fed_id'] != '') || (isset($sales_order_preview['gst_number']) && $sales_order_preview['gst_number'] != '')) {
        $html .= '<table style="border:solid 1px #000;width: 100%;" cellpadding="10">
                                                                                                            <tr>
                                                                                                                <td colspan="2">';
        if (isset($sales_order_preview['gst_number']) && $sales_order_preview['gst_number'] != '') {
            $html .= '<strong>' . $sales_order_preview['gst_text'] . ' : ' . $sales_order_preview['gst_number'] . '</strong><br />';
        }
        if (isset($sales_order_preview['fed_id']) && $sales_order_preview['fed_id'] != '') {
            $html .= '<strong>' . $sales_order_preview['fed_id_text'] . ' : ' . $sales_order_preview['fed_id'] . '</strong>';
        }
        $html .= '</td>

                                            </tr>
                                        </table>';
    }
}
$html .= '</td>

                            </tr>
                        </table>
                    </td>
                    <td style="vertical-align: top;">
                        <table style="border-collapse:collapse; border:solid 1px #000;width: 100%; text-align:center;" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding:0px;line-height:0px;">
                                    <div style="line-height:10px;margin:0px"> <strong style="width:100%;">' . $sales_order_preview['sales_preview_date'] . '</strong> <br/>
                                        ' . date("m/d/Y") . '</div>
                                    <div style="line-height:10px;margin:0px"><strong style="width:100%;">' . $sales_order_preview['invoice_number'] . '</strong><br/>
                                        ' . invoicenumber_front($payments['invoice_number']) . '</div>
                                    <div style="line-height:10px;margin:0px"><strong style="width:100%;">' . $sales_order_preview['order_number'] . '</strong><br/>
                                        ' . $cart_users_data['order_number'] . '</div>
                                    <div style="line-height:5px;">&nbsp;</div>
                                </td>
                            </tr>';

if (isset($cart_users_data['irs_fid_number']) && $cart_users_data['irs_fid_number'] != '') {
    $html .= '<tr>
                                    <td colspan="2" style="line-height:15px;"><strong>' . $sales_order_preview['irs_fid_number'] . '</strong>
                                        ' . $cart_users_data['irs_fid_number'] . '
                                    </td>
                                </tr>';
}

if (isset($cart_users_data['tax_exoneration']) && $cart_users_data['tax_exoneration'] == 1 && isset($cart_users_data['tax_exoneration_number']) && $cart_users_data['tax_exoneration_number'] != '' && (($this->config->item('store_country') != $cart_users_data['country_code'] && $this->config->item('tax_applicable') == 1) || $this->config->item('store_country') == $cart_users_data['country_code'])) {
    $html .= '<tr>
                                    <td colspan="2" style="line-height:15px;"><strong>' . $sales_order_preview['tax_exoneration_number'] . '</strong>
                                        ' . $cart_users_data['tax_exoneration_number'] . '
                                    </td>
                                </tr>';
}
$html .= '</table>
                        </td>
                                <td style="vertical-align: top;">
                                    <table style="width: 100%;" cellpadding="0">
                                        <tr>
                                            <td>';
if ($cart_users_data['client_logo'] != '' && file_exists("assets/uploads/cart/" . $cart_users_data['client_logo'])) {
    $html .= '<img src="' . FCPATH . '/assets/uploads/cart/' . $cart_users_data['client_logo'] . '" width="100" alt="' . $value[0] . '" width="100" height="auto"/>';
} else {
    $html .= '<img alt="client_logo" src="' . $noimage . '" width="100" height="auto" />';
}
$html .= '</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="border-collapse:collapse; width: 100%;">
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table style="border:none;width:100%;" cellpadding="0" cellspacing="0">
            <tr>
                <td style="width:50%; vertical-align: top;border: 1px solid #000;padding:0;">
                    <p style="border-bottom: 1px solid #000;line-height:5px;">&nbsp;&nbsp;<strong>' . $sales_order_preview['sold_to'];
if ($cart_users_data['country'] == 'Canada') {
    $html .= '0009993';
} else {
    $html .= '0009992';
}
$html .= '</strong>
                    </p>
                    <table style="width: 100%; border:none;" cellspacing="0" cellpadding="10">
                        <tr>
                            <td>' . $cart_users_data['company'] . '<br />
                                ' . $cart_users_data['user_name'] . '<br />
                                ' . $cart_users_data['cart_address_1'] . '<br />';
if (isset($cart_users_data['cart_address_2']) && $cart_users_data['cart_address_2'] != '') {
    $html .= $cart_users_data['cart_address_2'] . '<br />';
}
if (isset($cart_users_data['cart_address_2']) && $cart_users_data['cart_address_2'] != '') {
    $html .= $cart_users_data['cart_address_2'] . '<br />';
}

$html .= $cart_users_data['cart_city'] . ', ' . getState_Name($cart_users_data['country_shortcode'], $cart_users_data['cart_state']) . '<br />
                                        ' . $cart_users_data['country'] . ' ' . $cart_users_data['cart_zip'] . '<br />
                                    PH: +' . $cart_users_data['country_code'] . ' ' . $cart_users_data['telephone'] . '<br />
                                        ' . $cart_users_data['email'] . '
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width:50%; vertical-align: top;border: 1px solid #000;padding:0;">
                    <p style="border-bottom: 1px solid #000;line-height:5px;">
                        <strong>' . $sales_order_preview['ship_to'] . '</strong>
                    </p>
                    <table style="width: 100%; border:none;" cellpadding="10">
                        <tr>
                            <td>' . $cart_users_data['ship_company'] . '<br />
                                ' . getnametitle($cart_users_data['ship_title']) . ' ' . $cart_users_data['ship_surname'] . '<br />
                                ' . $cart_users_data['ship_address_1'] . '<br />';
if (isset($cart_users_data['ship_address_2']) && $cart_users_data['ship_address_2'] != '') {
    $html .= $cart_users_data['ship_address_2'] . '<br />';
}
if (isset($cart_users_data['ship_address_3']) && $cart_users_data['ship_address_3'] != '') {
    $html .= $cart_users_data['ship_address_3'] . '<br />';
}
$html .= $cart_users_data['ship_city'] . ', ' . getState_Name($cart_users_data['ship_country_shortcode'], $cart_users_data['ship_state']) . '<br />
                                ' . $cart_users_data['ship_country'] . ' ' . $cart_users_data['ship_zip'] . '<br />
                                PH: +' . $cart_users_data['ship_country_code'] . ' ' . $cart_users_data['ship_telephone'] . '<br />';

if (isset($cart_users_data['edi_one']) && $cart_users_data['edi_one'] != '') {
    $html .= $cart_users_data['edi_one'] . '<br />';
}
if (isset($cart_users_data['edi_two']) && $cart_users_data['edi_two'] != '') {
    $html .= $cart_users_data['edi_two'] . '<br />';
}

$html .= '       ' . $cart_users_data['ship_email'] . '
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse; width: 100%;">
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table style="border-collapse:collapse; border: 1px solid #000;width: 100%; text-align:center;" cellpadding="10">
            <tr>';

if ($this->config->item('hide_po_number') == '0') {

    $html .= '<td><strong>' . $sales_order_preview['po_number'] . '</strong><br />';

    if ($cart_users_data['po_number']) {
        $html .= $cart_users_data['po_number'];
    }

    if ($cart_users_data['po_file']) {
        $html .= "/" . $sales_order_preview['po_attached'];
    } else {
        $html .= "/" . $sales_order_preview['po_notattached'];
    }
    $html .= '</td>
                                <td><strong>' . $sales_order_preview['customer_no'] . '</strong><br />';

    if ($cart_users_data['customer_no']) {
        $html .= $cart_users_data['customer_no'];
    }

    $html .= '
                </td>';


}
$html .= '<td><strong>' . $sales_order_preview['sls'] . '</strong><br />
                    042
                </td>
                <td><strong>' . $sales_order_preview['order_date'] . '</strong><br />
                    ' . date("m/d/Y") . '
                </td>
                <td><strong>' . $sales_order_preview['ship_via'] . '</strong><br />
                    ' . getFreightName($cart_users_data['freight']) . ' ' . $cart_users_data['method_of_transportation'] . '
                </td>
                <td><strong>' . $sales_order_preview['carrier_account_no'] . '</strong><br />
                    ' . $cart_users_data['carrier_account_number'] . '
                </td>
                <td><strong>' . $sales_order_preview['terms'] . '</strong><br />';

if ($payments['payment_method'] == "1") {
    $html .= $sales_order_preview['credit_card'];
}
if ($payments['payment_method'] == "2") {

    $credit_term_date = str_replace('{days}', $payments['payment_term_days'], $sales_order_preview['credit_term_date']);
    $html .= $credit_term_date;
}
if ($payments['payment_method'] == "3") {
    $html .= $sales_order_preview['payment_proof'];
}

$html .= '</td>
                <td><strong>' . $sales_order_preview['initials'] . '</strong><br />
                    ' . getnametitle($cart_users_data['ship_title']) . ' ' . $cart_users_data['ship_surname'] . '
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse; width: 100%;">
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table style="border-collapse:collapse; border: 1px solid #000;width: 100%;" cellpadding="5">
            <thead style="border-bottom: 1px solid #000; border-top: 1px solid #000;">
                <tr>
                    <th style="width:6%;"><strong>' . $sales_order_preview['chronological_display'] . '</strong>
                    </th>
                    <th style="width:5%;"><strong>' . $sales_order_preview['quantity_ordered'] . '</strong>
                    </th>
                    <th style="width:5%;"><strong>' . $sales_order_preview['quantity_shipped'] . '</strong>
                    </th>
                    <th style="width:5%;"><strong>' . $sales_order_preview['country_origin'] . '</strong>
                    </th>
                    <th style="width:7%;"><strong>' . $sales_order_preview['item_number'] . '</strong>
                    </th>
                    <th style="width:17%;"><strong>' . $sales_order_preview['part_name'] . '</strong>
                    </th>
                    <th style="width:10%;"><strong>' . $sales_order_preview['unit_price'] . '</strong>
                    </th>
                    <th style="width:15%;"><strong>' . $sales_order_preview['uom'] . '</strong>
                    </th>
                    <th style="width:10%;"><strong>' . $sales_order_preview['extended_price'] . '</strong>
                    </th>
                    <th style="width:10%;"><strong>' . $sales_order_preview['part_number_photo'] . '</strong>
                    </th>
                    <th style="width:10%;"><strong>' . $sales_order_preview['where_used_schematic_photo'] . '</strong>
                    </th>
                </tr>
            </thead>
            <tbody style="border-top: 1px solid #000;">';

$subtotal = 0;
$discount = 0;
$currentproducttype = '';
$k = 1;

foreach ($cart_details as $cart) {
    $store_id = 0;
    $s_count = 1;    
    foreach ($cart_data[$cart['id']]['quantity'] as $s_k=>$s_v){
    $pro_real_images = array();
    if (empty($cart_unit_of_meas)) {
        $cart_unit_of_meas = $cart['unit_of_measurement'];
    }

    $ship_quantity = 0;
    $item_price = 0;

    
    $store_id = $s_k;
    $s_count++;
    if ($cart['ship_quantity'] > $cart_data[$cart['id']]['quantity'][$store_id]) {
        $ship_quantity = $cart_data[$cart['id']]['quantity'][$store_id];
    } else {
        $ship_quantity = $cart['ship_quantity'];
    }
    
    $availableQuantity = $cart['ship_quantity'];
    $userQuantity = $cart_data[$cart['id']]['quantity'][$store_id];
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

    if (isset($cart['product_type_name']) && $cart['product_type_name'] != '') {
        $type = $cart['product_type_name'];
    } else {
        $type = $cart['type'];
    }

    $html .= '<tr>
                            <td style="width:6%;">' . $k . '
                            </td>
                            <td style="width:5%;">' . $cart_data[$cart['id']]['quantity'][$store_id] . '
                            </td>
                            <td style="width:5%;">' . $ship_quantity . '
                            </td>
                            <td style="width:5%;">' . $cart['country_origin'] . '
                            </td>
                            <td style="width:7%;">' . $cart['kgt_ref_number'] . '
                            </td>
                            <td style="width:17%;">' . $cart['part_name'] . '
                            </td>
                            <td style="width:10%;">' . $item_price . '
                            </td>';
    $html .= '<td style="width:15%;">' . $sales_order_preview['uom_text'] . '<br />' . $cart_unit_of_meas . '<br /><br />' . $sales_order_preview['item_dimension'] . '<br />' . $cart['item_height'] . 'X' . $cart['item_width'] . 'X' . $cart['item_length'] . '<br /><br />' . $sales_order_preview['item_weight'] . '<br />' . $cart['item_weight'] . '
                            </td>
                            <td style="width:10%;">' . $item_price * $ship_quantity . '
                            </td>';

    if ($cart['item_real_photo'] != '') {

        $pro_real_images = explode(",", $cart['item_real_photo']);
        $single_real_image = $pro_real_images[0];

        if (isset($single_real_image) && $single_real_image != '' && file_exists("assets/uploads/product_images/" . $single_real_image)) {
            $html .= '<td style="text-align:center; width:10%;"><a class="d-inline-block example-image-link" data-lightbox="example-' . $cart['id'] . '" href="' . FCPATH . 'assets/uploads/product_images/' . $single_real_image . '"><img src="' . FCPATH . 'assets/uploads/product_images/' . $single_real_image . '" width="40" height="auto" alt="' . $single_real_image . '"/></a></td>';
        } else {
            $html .= '<td style="text-align:center; width:10%;"><a class="d-inline-block example-image-link" data-lightbox="example-' . $cart['id'] . '" href="' . $comingsoon . '"><img alt="product_images" src="' . $comingsoon . '" width="120" height="80"> </a></td>';
        }
    } else {
        $html .= '<td style="text-align:center; width:10%;"><a class="d-inline-block example-image-link" data-lightbox="example-' . $cart['id'] . '" href="' . $comingsoon . '"><img alt="product_images" src="' . $comingsoon . '" width="120" height="80"> </a></td>';
    }

    if ($cart['item_schematic_photo_status'] == 0) {

        if ($cart['item_schematic_photo'] != '' && @file_exists("assets/uploads/product_images/" . $cart['item_schematic_photo'])) {
            $html .= '<td style="text-align:center; width:10%;"><a class="d-inline-block example-image-link" data-lightbox="example-' . $cart['id'] . '" href="' . FCPATH . '/assets/uploads/product_images/' . $cart['item_schematic_photo'] . '">  <img src="' . FCPATH . '/assets/uploads/product_images/' . $cart['item_schematic_photo'] . '" width="40" height="auto"/></a></td>';
        } else {

            $html .= '<td style="text-align:center; width:10%;"><a class="d-inline-block example-image-link" data-lightbox="example-' . $cart['id'] . '" href="' . $comingsoon . '"> <img alt="product_images" src="' . $comingsoon . '" width="120" height="80"> </a></td>';
        }
    } else {

        $html .= '<td style="text-align:center; width:10%;">--</td>';
    }
    $html .= '</tr>';
    $html .= '<tr>
                    <td colspan="2">' . $sales_order_preview['description'] . ':</td>
                    <td colspan="10">' . $type . '</td>
                </tr>';

    if ($cart_data[$cart['id']]['comment'][$store_id]) {

        $html .= '<tr>
            <td colspan="2">' . $sales_order_preview['comments'] . ':</td>
            <td colspan="10">' . $cart_data[$cart['id']]['comment'][$store_id] . '</td>
        </tr>';
    }

    if ($isBackOrder == 1) {
        $html .= '<tr style="border-bottom:1px solid #000;">';
        if (isset($cart['lang_availability']) && $cart['lang_availability'] != '') {
            $availability_lang = $cart['lang_availability'];
        } else {
            $availability_lang = $cart['availability'];
        }
        $availability_lang = str_replace('{itemquantity}', $remaining_quantity, $cart_instruction->backorder_accept_msg);
        $availability_lang = str_replace('{product_items}', $cart['kgt_ref_number'], $availability_lang);
        $availability_lang = str_replace('{ex_stock_period}', $cart['ex_stock_period'], $availability_lang);

        $html .= '<td colspan="12">
                <p style="font-size:11px;">' . $availability_lang . '</p>
            </td>
        </tr>';
    }

    $price = 0;
    $price = $item_price * $ship_quantity;
    $subtotal += $price;
    $s_count++;
   }
    $k++;
}

$html .= '</tbody>
        </table>
        <table style="width:100%; border: 1px solid #000;"  cellspacing="0" cellpadding="0">';
$html .= '<tr>';
if ($cart_users_data['freight'] != 'COL') {

    $html .= '<td style="width: 50%;">
                    <table style="margin: 5px 0px;" cellspacing="0" cellpadding="2">
                        <tr>
                            <td><strong>' . $sales_order_preview['tracking'] . '</strong><br />';
    $unique_tracking = array();
    foreach ($cart_package_data as $cart_package) {
        if (!in_array($cart_package['tracking_number'], $unique_tracking)) {
            $unique_tracking[] = $cart_package['tracking_number'];
            $html .= ucfirst($cart_package['package_type']) . " " . $cart_package['tracking_number'] . '<br />';
        }
    }
    $html .= '</td>
                        </tr>';

    if (isset($businessdaysintransit) && $businessdaysintransit != '') {
        $html .= '<tr>
                            <td><strong>' . $sales_order_preview['estimated_transit_time'] . ' - ' . $businessdaysintransit . ' ' . $businessdaysintransit_text . ' ' . $deliverybytime_text . ' ' . $deliverybytime . '</strong>
                            </td>
                        </tr>';
    }
    $html .= '</table>
                </td> ';
}
if ($cart_users_data['freight'] != 'COL') {
    $html .= '<td style="width: 50%;">';
} else {
    $html .= '<td style="width: 100%;">';
}
$html .= '<table style="text-align:right; margin: 5px 0px;" cellspacing="0" cellpadding="2">
                        <tr>
                            <td style="width:80%;">
                                <strong>' . $sales_order_preview['subtotal'] . '</strong>
                            </td>
                            <td style="width:20%;">
                                <strong style="float:right;">' . round($subtotal, 2) . '</strong>
                            </td>
                        </tr>';
if ((isset($freight) && $freight != 0) || (isset($cart_users_data['shipping_rate_freight']) && $cart_users_data['shipping_rate_freight'] != 0)) {

    $freight = $freight + $cart_users_data['shipping_rate_freight'];
    $html .= '<tr>
                                <td style="width:80%;">
                                    <strong>' . $sales_order_preview['freight'] . '</strong>
                                </td>
                                <td style="width:20%;">
                                    <strong style="float:right;">' . $freight . '</strong>
                                </td>
                            </tr>';
}
$html .= '<tr>
                            <td style="width:80%;">
                                <strong>' . $sales_order_preview['totaltax'] . '</strong>
                            </td>
                            <td >
                                <strong style="float:right;">';

$totaltax = 0;
if (isset($tax_base_rate) && $tax_base_rate != 0 && ($this->config->item('store_country') != $cart_users_data['country_code'] && $this->config->item('tax_applicable') == 1) || $this->config->item('store_country') == $cart_users_data['country_code']) {
    $totaltax = (($subtotal + $freight) * $tax_base_rate) / 100;
    $totaltax = round($totaltax, 2);
}

if (!empty($cart_users_data['discount'])) {

    $discount = $cart_users_data['discount'];

}

$html .= $totaltax . '</strong>
                                                                </td>
                                                            </tr>';
if (!empty($discount)) {

    $html .= '<tr>
                                                                <td style="width:80%;">
                                                                    <strong>' . $sales_order_preview['discount'] . ' )</strong>
                                                                </td>';

    $html .= '<td style="border-bottom: 1px solid #000;width:20%;">
                                <strong style="float:right;">' . round($discount, 2) . '</strong>
                            </td>
                        </tr>';
}
$total = $subtotal + $freight + $totaltax - $discount;

$html .= '<tr>
                                                                <td style="width:80%;">
                                                                    <strong>' . $sales_order_preview['totalorder'];
$currencyV = $cart_users_data['currency'] . '_currency';
$currency = $general_instruction->$currencyV;
$html .= '( ' . $currency . ' )</strong>
                                                                </td>';
$total = $subtotal + $freight + $totaltax - $discount;

$html .= '<td style="width:20%;">
                                <strong style="float:right;">' . round($total, 2) . '</strong>
                            </td>
                        </tr>';

if ($this->config->item('partial_payment_enable') == "1" && !empty($cart_users_data['amount_received'])) {
    $amount_received_perc = round($cart_users_data['amount_received'] / $total * 100);
    $html .= '<tr>
                        <td style="width:80%;">
                            <strong>' . $sales_order_preview['order_received_amount'];
    $currencyV = $cart_users_data['currency'] . '_currency';
    $currency = $general_instruction->$currencyV;
    $html .= '( ' . $currency . ' )</strong>
                        </td>';

    $html .= '<td style="width:20%;">
<strong style="float:right;">' . round($cart_users_data['amount_received'], 2) . '(' . $amount_received_perc . '%)</strong>
</td>
</tr>';
}

if ($this->config->item('partial_payment_enable') == "1") {
    $payale_amount = $payments['amount'];
} else {
    $payale_amount = $total;
}
$payale_amount_perce = round($payale_amount / $total * 100);

$html .= '<tr>
                                                                <td style="width:80%;">
                                                                    <strong>' . $sales_order_preview['order_payment'];
$html .= '( ' . $currency . ' )</strong>
                                                                </td>';

$html .= '<td style="width:20%;">
                                <strong style="float:right;">' . round($payale_amount, 2) . '(' . $payale_amount_perce . '%)</strong>
                            </td>
                        </tr>';

$html .= '</table>
                </td>
            </tr>
        </table>

        <table style="border-collapse:collapse; width: 100%;">
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table style="width:100%;"  cellspacing="0" cellpadding="0">
            <tr>
                <td style="text-align:center;  margin: 5px 0px;"><strong>' . strtoupper($sales_order_preview['terms_condition_sale']) . '</strong>
                </td>
            </tr>
            <tr>
                <td style="margin: 5px 0px;">' . $sales_order_preview['terms_condition_text'] . '
                </td>
            </tr>
        </table>
        <table style="width:100%;"  cellspacing="0" cellpadding="0">
            <tr>
                <td style="text-align:center;  margin: 10px 0px;"><strong>' . $all_data['copyright'] . '</strong>
                </td>
            </tr>
        </table>

            </body>
        </html>';

echo $html;
