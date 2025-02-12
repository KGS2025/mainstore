<?php
ob_clean();

$comingsoon = FCPATH . '/assets/frontend/images/coming_soon.png';
$noimage    = FCPATH . '/assets/frontend/images/noimage1.png';

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


$cart_unit_of_meas = cart_unit_of_meas($cart_users_data['volume_unit'], $cart_users_data['weight_unit']);



$html_delivery = '<html>
        <head>
		table tbody tr th{padding:20px 10px;}
		span{border:2px solid red;}
        </head>
        <body>
        <table border="1" style="width:5%; text-align:center;">
        <tbody>
            <tr>
                <td style="font-size: 30px;">X

                </td>
                </tr>
                <tr>
                <td style="font-size: 30px">&nbsp;

                </td>
            </tr>
        </tbody>
    </table>
        <table border="0" style="width:100%;" cellpadding="10">
        <tbody>
            <tr>
                <td style="width:25%; vertical-align: top; padding-top: 11px;">

                </td>

                <td style="width:25%; vertical-align: top;">

                </td>

                <td style="width:25%; vertical-align: top;">
                    <table border="0" style="width: 100%;" cellpadding="5">
                        <tr>
                            <td><strong>' . $sales_order_preview['sales_preview_date'] . '</strong> :' . date("m/d/Y") . '</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>' . $sales_order_preview['order_number'] . '</strong> :' . $cart_users_data['order_number'] . '</td>
                        </tr>';

                        if ($this->config->item('hide_po_number') == '0') {  

                            $html_delivery .= '<tr>
                            <td colspan="2"><strong>' . $sales_order_preview['po_number'] . '</strong> :' . $cart_users_data['po_number'];

                            if ($cart_users_data['po_file']) {
                            $html_delivery .=  "/" . $sales_order_preview['po_attached'];
                            } else {
                            $html_delivery .=  "/" . $sales_order_preview['po_notattached'];
                            }
                            $html_delivery .= '</td>
                            </tr>';
                        }
$html_delivery .= '</table>
                </td>

                <td style="width:25%; vertical-align: top; padding-top:15px">';
if ($cart_users_data['client_logo'] != '' && file_exists("assets/uploads/cart/thumb/" . $cart_users_data['client_logo'])) {
    $html_delivery .= '<img src="' . FCPATH . '/assets/uploads/cart/thumb/' . $cart_users_data['client_logo'] . '" style="max-width: 250px !important;"alt="' . $value[0] . '" width="175" height="auto"/>';
} else {
    $html_delivery .= '<img alt="client_logo" src="' . $noimage . '" width="175" height="auto" />';
}
$html_delivery .= '</td>
            </tr>
        </tbody>
    </table>

    <table border="0" style="width:100%;" cellpadding="5">
        <tr>
            <td style="width:50%; vertical-align: top;" colspan="2"><strong>' . $sales_order_preview['sold_to'];
if ($cart_users_data['country'] == 'Canada') {
    $html_delivery .= '0009993';
} else {
    $html_delivery .= '0009992';
}
$html_delivery .= '</strong><br />
                <table border="0" style="width: 100%;" cellpadding="5">
                    <tr>
                        <td>' . $cart_users_data['company'] . '<br />
                            ' . $cart_users_data['user_name'] . '<br />
                            ' . $cart_users_data['cart_address_1'] . '<br />';
if (isset($cart_users_data['cart_address_2']) && $cart_users_data['cart_address_2'] != '') {
    $html_delivery .= $cart_users_data['cart_address_2'] . '<br />';
}
if (isset($cart_users_data['cart_address_2']) && $cart_users_data['cart_address_2'] != '') {
    $html_delivery .= $cart_users_data['cart_address_2'] . '<br />';
}

$html_delivery .= $cart_users_data['cart_city'] . ', ' . getState_Name($cart_users_data['country_shortcode'], $cart_users_data['cart_state']) . '<br />
                                    ' . $cart_users_data['country'] . ' ' . $cart_users_data['cart_zip'] . '<br />
                                PH: +' . $cart_users_data['country_code'] . ' ' . $cart_users_data['telephone'] . '<br />
                                    ' . $cart_users_data['email'] . '
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width:50%; vertical-align: top;" colspan="2"><strong>' . $sales_order_preview['ship_to'] . '</strong><br />
                <table border="0" style="width: 100%;" cellpadding="5">
                    <tr>
                        <td>' . $cart_users_data['ship_company'] . '<br />
                            ' . getnametitle($cart_users_data['ship_title']) . ' ' . $cart_users_data['ship_surname'] . '<br />
                            ' . $cart_users_data['ship_address_1'] . '<br />';
if (isset($cart_users_data['ship_address_2']) && $cart_users_data['ship_address_2'] != '') {
    $html_delivery .= $cart_users_data['ship_address_2'] . '<br />';
}
if (isset($cart_users_data['ship_address_3']) && $cart_users_data['ship_address_3'] != '') {
    $html_delivery .= $cart_users_data['ship_address_3'] . '<br />';
}
$html_delivery .= $cart_users_data['ship_city'] . ', ' . getState_Name($cart_users_data['ship_country_shortcode'], $cart_users_data['ship_state']) . '<br />
                            ' . $cart_users_data['ship_country'] . ' ' . $cart_users_data['ship_zip'] . '<br />
                            PH: +' . $cart_users_data['ship_country_code'] . ' ' . $cart_users_data['ship_telephone'] . '<br />';
if (isset($cart_users_data['edi_one']) && $cart_users_data['edi_one'] != '') {
    $html_delivery .= $cart_users_data['edi_one'] . '<br />';
}
if (isset($cart_users_data['edi_two']) && $cart_users_data['edi_two'] != '') {
    $html_delivery .= $cart_users_data['edi_two'] . '<br />';
}


$html_delivery .= '       ' . $cart_users_data['ship_email'] . '
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table border="0" style="width: 100%; text-align:center;" cellpadding="5">
        <tr>
            <td style="border-bottom:1px solid black; border-top:1px solid black;"><strong>' . $sales_order_preview['customer_no'] . '</strong><br />
                ';
if ($cart_users_data['customer_no']) {
    $html_delivery .= $cart_users_data['customer_no'];
}
$html_delivery .= '
            </td>
            <td style="border-bottom:1px solid black; border-top:1px solid black;"><strong>' . $sales_order_preview['sls'] . '</strong><br />
                042
            </td>
            <td style="border-bottom:1px solid black; border-top:1px solid black;"><strong>' . $sales_order_preview['ship_via'] . '</strong><br />
                ' . getFreightName($cart_users_data['freight']) . ' ' . $cart_users_data['method_of_transportation'] . '
            </td>
            <td style="border-bottom:1px solid black; border-top:1px solid black;"><strong>' . $sales_order_preview['carrier_account_no'] . '</strong><br />
                ' . $cart_users_data['carrier_account_number'] . '
            </td>
            <td style="border-bottom:1px solid black; border-top:1px solid black;"><strong>' . $sales_order_preview['ship_date'] . '</strong><br />
                ' . strtoupper($sales_order_preview['ship_date']) . '
            </td>
            <td style="border-bottom:1px solid black; border-top:1px solid black;"><strong>' . $sales_order_preview['freight'] . '</strong><br />
                ' . getFreightName($cart_users_data['freight']) . '
            </td>
        </tr>
    </table>
    <br />
<table border="0" style="width: 100%;" cellpadding="5">
    <thead style="border-bottom: 1px solid #000; border-top: 1px solid #000;">
        <tr>
           <th style="width:6%;padding:20px 10px;"><strong>' . $sales_order_preview['chronological_display'] . '</strong>
           </th>
            <th style="border-bottom:1px solid black;padding:20px 10px; width:10%"><strong>' . $sales_order_preview['item_number'] . '</strong>
            </th>
            <th style="border-bottom:1px solid black;padding:20px 10px; width:14%"><strong>' . $sales_order_preview['part_name'] . '</strong>
            </th>
            <th style="border-bottom:1px solid black;padding:20px 10px; width:10%"><strong>' . $sales_order_preview['quantity_shipped'] . '</strong>
            </th>
            <th style="border-bottom:1px solid black;padding:20px 10px; width:20%"><strong>' . $sales_order_preview['uom'] . '</strong>
            </th>
            <th style="width:10%;padding:20px 10px"><strong>' . $sales_order_preview['part_number_photo'] . '</strong>
            </th>
            <th style="width:10%;padding:20px 10px"><strong>' . $sales_order_preview['where_used_schematic_photo'] . '</strong>
            </th>
            <th style="width:20%;border-bottom:1px solid black;padding:20px 10px"><strong>' . $sales_order_preview['shipped'] . ' Shipped</strong>
            </th>
        </tr>
    </thead>
    <tbody>';


foreach ($cpd['cart_package_products'] as $pd) {
    $j = 1;
    foreach ($cart_details as $cart) {
    $store_id = 0;
    $s_count = 1;    
    foreach ($cart_data[$cart['id']]['quantity'] as $s_k=>$s_v){
        $store_id = $s_k;
        $pro_real_images = array();

        if (empty($cart_unit_of_meas)) {
            $cart_unit_of_meas = $cart['unit_of_measurement'];
        }
        if ($pd['product_id'] == $cart['id']) {
            $ship_quantity = 0;
            if ($cart['ship_quantity'] > $cart_data[$cart['id']]['quantity'][$store_id]) {
                $ship_quantity = $cart_data[$cart['id']]['quantity'][$store_id];
            } else {
                $ship_quantity = $cart['ship_quantity'];
            }

            $availableQuantity = $cart['ship_quantity'];
            $userQuantity      = $cart_data[$cart['id']]['quantity'][$store_id];
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


            if (isset($cart['product_type_name']) && $cart['product_type_name'] != '') {
                $type = $cart['product_type_name'];
            } else {
                $type = $cart['type'];
            }

            $html_delivery .= '<tr>
                                <td style="width:6%;padding:10px;">' . $j . '</td>
                                <td style="width:10%;padding:10px;">' . $cart['kgt_ref_number'] . '
                                </td>
                                <td style="width:14%;padding:10px;">' .  $cart['part_name'] . '
                                </td>
                                <td style="width:10%;padding:10px;">' . $ship_quantity . '
                                </td>
                                <td style="width:20%;padding:10px;">' . $sales_order_preview['uom_text'] . '<br />' .  $cart_unit_of_meas . '<br /><br />' . $sales_order_preview['item_dimension'] . '<br />' . $cart['item_height'] . 'X' . $cart['item_width'] . 'X' . $cart['item_length'] . '<br /><br />' . $sales_order_preview['item_weight'] . '<br />' . $cart['item_weight'] . '
                                </td>';


            if ($cart['item_real_photo'] != '') {

                $pro_real_images = explode(",", $cart['item_real_photo']);
                $single_real_image = $pro_real_images[0];
                if (isset($single_real_image) && $single_real_image != '' && file_exists("assets/uploads/product_images/" . $single_real_image)) {


                    $html_delivery .= '<td style="text-align:center; width:10%;padding:10px;"><a class="d-inline-block example-image-link" data-lightbox="example-' . $cart['id'] . '" href="' . FCPATH . '/assets/uploads/product_images/thumb/' . $single_real_image . '"><img src="' . FCPATH . '/assets/uploads/product_images/thumb/' . $cart['item_real_photo'] . '" height="70" alt="' . $single_real_image . '" align="center" style="margin-top:10px;"/></a></td>';
                } else {
                    $html_delivery .= '<td style="text-align:center; width:10%;padding:10px;"><a class="d-inline-block example-image-link" data-lightbox="example-' . $cart['id'] . '" href="' . $comingsoon . '"><img alt="product_images" src="' . $comingsoon . '" width="100" height="80"> </a></td>';
                }
            } else {
                $html_delivery .= '<td style="text-align:center; width:10%;padding:10px;"><a class="d-inline-block example-image-link" data-lightbox="example-' . $cart['id'] . '" href="' . $comingsoon . '"><img alt="product_images" src="' . $comingsoon . '" width="100" height="80"> </a></td>';
            }

           








            if ($cart['item_schematic_photo_status'] == 0) {

                if ($cart['item_schematic_photo'] != '' && file_exists("assets/uploads/product_images/thumb/" . $cart['item_schematic_photo'])) {
                    $html_delivery .= '<td style="text-align:center; width:10%;padding:10px;"><a class="d-inline-block example-image-link" data-lightbox="example-' . $cart['id'] . '" href="' . FCPATH . '/assets/uploads/product_images/thumb/' . $cart['item_schematic_photo'] . '"><img src="' . FCPATH . '/assets/uploads/product_images/thumb/' . $cart['item_schematic_photo'] . '" height="70" align="center" style="margin-top:10px;"/></a></td>';
                } else {

                    $html_delivery .= '<td style="text-align:center; width:10%;padding:10px;"><a class="d-inline-block example-image-link" data-lightbox="example-' . $cart['id'] . '" href="' . $comingsoon . '"><img alt="product_images" src="' . $comingsoon . '" width="100" height="70" align="center" style="margin-top:10px;"> </a></td>';
                }
            } else {

                $html_delivery .= '<td style="text-align:center; width:10%;padding:10px;">--</td>';
            }
            $html_delivery .= '<td style="width:20%"><br /><br />_________</td>';
            $html_delivery .= '</tr>';

            $html_delivery .=  '<tr>
            <td colspan="12" style="border-bottom:1px solid #000;">' . $sales_order_preview['description'] . ': ' .  $type . '</td>
            </tr>';


            if ($cart_data[$cart['id']]['comment'][$store_id]) {
                $html_delivery .=  '<tr>
                                <td colspan="12" style="border-bottom:1px solid #000;">' . $sales_order_preview['comments'] . ': ' . $cart_data[$cart['id']]['comment'][$store_id] . '</td>
                                </tr>';
            }
        }
        $j++;
    }
    }
}
$html_delivery .= '</tbody>
                      </table>
                      <br />
                      <br />
                      <br />
                      <br />
                      <br />
                      <br />
                      <br />
                      <br />
                      <br />
                      <br />
                      <br />
                      <br />
                      <table border="0" style="width:100%;" cellpadding="0">';
if ($cart_users_data['freight'] != 'COL') {
    $html_delivery .=  '<tr>
                              <td colspan="4"><strong>' . $sales_order_preview['tracking'] . '</strong>&nbsp;&nbsp;&nbsp;&nbsp;' . $cpd['tracking_number'] . '<br /><br /></td>';
}
$html_delivery .= '</tr>
                          <tr>
                              <td><strong>' . $sales_order_preview['picked_by'] . ':____________________</strong>
                              </td>
                              <td><strong>' . $sales_order_preview['date_text'] . ':____________________</strong>
                              </td>
                              <td><strong>' . $sales_order_preview['weight_text'] . ':____________________</strong>
                              </td>
                              <td><strong>' . $sales_order_preview['number_of_cartoons'] . ':____________________</strong>
                              </td>
                          </tr>
                          <tr>
                              <td colspan="2"><br /><br /><br />' . $sales_order_preview['run_date'] . ': ' . date('d/m/Y', time()) . date('H:i:s', time()) . '
                              </td>
                              <td colspan="2" style="text-align:right;"><br /><br /><br />' . $sales_order_preview['entered_by'] . ':' . $cart_users_data['user_name'] . '
                              </td>
                          </tr>
                      </table>
                      <br /><br />
      <hr />
      <br /><br />
      <table border="0" style="width:100%;" cellpadding="0">
    <tr>
        <td style="text-align:center;  margin: 10px 0px;"><strong>' . $all_data['copyright'] . '</strong>
        </td>
    </tr>
</table>
                          </body>
                      </html>';

echo $html_delivery;
