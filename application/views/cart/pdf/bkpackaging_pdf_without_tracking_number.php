<?php
ob_clean();
$comingsoon = FCPATH . '/assets/frontend/images/coming_soon.png';
$noimage    = FCPATH . '/assets/frontend/images/noimage1.png';


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
                ' .getFreightName($cart_users_data['freight']) . ' ' . $cart_users_data['method_of_transportation'] . '
            </td>
            <td style="border-bottom:1px solid black; border-top:1px solid black;"><strong>' . $sales_order_preview['carrier_account_no'] . '</strong><br />
                ' . $cart_users_data['carrier_account_number'] . '
            </td>
            <td style="border-bottom:1px solid black; border-top:1px solid black;"><strong>' . $sales_order_preview['ship_date'] . '</strong><br />
                ' . strtoupper($sales_order_preview['ship_date']) . '
            </td>
            <td style="border-bottom:1px solid black; border-top:1px solid black;"><strong>' . $sales_order_preview['freight'] . '</strong><br />
                ' .getFreightName($cart_users_data['freight']) . '
            </td>
        </tr>
    </table>
    <br />
    <table border="0" style="width: 100%;" cellpadding="5">
        <thead style="border-bottom: 1px solid #000; border-top: 1px solid #000;">
            <tr>
                <th style="border-bottom:1px solid black; width:5%; padding:20px 10px;"><strong>' . $sales_order_preview['chronological_display'] . '</strong>
                </th>
                <th style="border-bottom:1px solid black; width:10%; padding:20px 10px;"><strong>' . $sales_order_preview['item_number'] . '</strong>
                </th>
                <th style="border-bottom:1px solid black; width:20%; padding:20px 10px;"><strong>' . $sales_order_preview['part_name'] . '</strong>
                </th>
                <th style="border-bottom:1px solid black; width:5%; padding:20px 10px;"><strong>' . $sales_order_preview['quantity_shipped'] . '</strong>
                </th>
                <th style="border-bottom:1px solid black; width:10%; padding:20px 10px;"><strong>' . $sales_order_preview['uom'] . '</strong>
                </th>
            
                <th style="border-bottom:1px solid black; width:10%; padding:20px 10px;"><strong>' . $sales_order_preview['part_number_photo'] . '</strong>
                </th>
                
                <th style="border-bottom:1px solid black; width:10%;padding:20px 10px"><strong>' . $sales_order_preview['where_used_schematic_photo'] . '</strong>
                </th>
                <th style="border-bottom:1px solid black; width:30%;padding:20px 10px"><strong>' . $sales_order_preview['shipped'] . ' Shipped</strong>
                </th>
            </tr>
        </thead>
        <tbody>';
$j = 1;
foreach ($cart_details as $cart) {

    if (empty($cart_unit_of_meas)) {
        $cart_unit_of_meas = $cart['unit_of_measurement'];
    }

    $ship_quantity = 0;

    if ($cart['ship_quantity'] > $cart_data[$cart['id']]['quantity']) {
        $ship_quantity = $cart_data[$cart['id']]['quantity'];
    } else {
        $ship_quantity = $cart['ship_quantity'];
    }

    if (isset($cart['product_type_name']) && $cart['product_type_name'] != '') {
        $type = $cart['product_type_name'];
    } else {
        $type = $cart['type'];
    }


    $html_delivery .= '<tr>
                        <td style="width:5%;padding:10px;">' . $j . '
                        </td>

                        <td style="width:10%;padding:10px;">' . $cart['kgt_ref_number'] . '
                        </td>
                        <td style="width:20%;padding:10px;">' . $cart['part_name'] . '
                        </td>
                        <td style="width:5%;padding:10px;">' . $ship_quantity . '
                        </td>
                        <td style="width:10%;padding:10px;">' . $sales_order_preview['uom_text'] . '<br />' . $cart_unit_of_meas . '<br /><br />' . $sales_order_preview['item_dimension'] . '<br />' . $cart['item_height'] . 'X' . $cart['item_width'] . 'X' . $cart['item_length'] . '<br /><br />' . $sales_order_preview['item_weight'] . '<br />' . $cart['item_weight'] . '
                        </td>';


    if ($cart['item_real_photo'] != '') {

        $pro_real_images = explode(",", $cart['item_real_photo']);
        $single_real_image = $pro_real_images[0];
        if (isset($single_real_image) && $single_real_image != '' && file_exists("assets/uploads/product_images/" . $single_real_image)) {



            $html_delivery .= '<td style=\"text-align:center; width:10%; padding:10px;\"><a class="d-inline-block example-image-link" data-lightbox="example-' . $cart['id'] . '" href="' . FCPATH . '/assets/uploads/product_images/thumb/' . $single_real_image . '"><img src="' . FCPATH . '/assets/uploads/product_images/thumb/' . $single_real_image . '" height="70" alt="' . $single_real_image . '" align="center" style=\"margin-top:10px;\"/></a></td>';
        } else {
            $html_delivery .= '<td style=\"text-align:center; width:10%; padding:10px;\"><a class="d-inline-block example-image-link" data-lightbox="example-' . $cart['id'] . '" href="' . $comingsoon . '"><img alt="product_images" src="' . $comingsoon . '" width="100" height="70"  align="center" style=\"margin-top:10px;\"> </a></td>';
        }
    } else {
        $html_delivery .= '<td style=\"text-align:center; width:10%; padding:10px;\"><a class="d-inline-block example-image-link" data-lightbox="example-' . $cart['id'] . '" href="' . $comingsoon . '"><img alt="product_images" src="' . $comingsoon . '" width="100" height="70"  align="center" style=\"margin-top:10px;\"> </a></td>';
    }



    if ($action == '') {
        $selModelIds = $this->session->userdata('searchModelIds') ? array_filter($this->session->userdata('searchModelIds')) : array();
        if (count($selModelIds) == 0) {
            $selModelIds = $this->session->userdata('model_id') ? array_filter($this->session->userdata('model_id')) : array();
        }
        $selMakerIds = $this->session->userdata('maker_id') ? array_filter($this->session->userdata('maker_id')) : array();
        $session_cart = get_instance()->session->userdata('cart_selected_dropdowns');
    }

    $modelimage_name = array();
    $model_image_count = 1;

   
    if ($cart['item_schematic_photo_status'] == 0) {

        if ($cart['item_schematic_photo'] != '' && file_exists("assets/uploads/product_images/thumb/" . $cart['item_schematic_photo'])) {
            $html_delivery .= '<td style=\"text-align:center; width:10%;padding:10px;\"><a class="d-inline-block example-image-link" data-lightbox="example-' . $cart['id'] . '" href="' . FCPATH . '/assets/uploads/product_images/thumb/' . $cart['item_schematic_photo'] . '"><img src="' . FCPATH . '/assets/uploads/product_images/thumb/' . $cart['item_schematic_photo'] . '" height="70" align="center" style=\"margin-top:10px;\"/></a></td>';
        } else {

            $html_delivery .= '<td style=\"text-align:center; width:10%;padding:10px;\"><a class="d-inline-block example-image-link" data-lightbox="example-' . $cart['id'] . '" href="' . $comingsoon . '"><img alt="product_images" src="' . $comingsoon . '" width="100" height="70" align="center" style=\"margin-top:10px;\" > </a></td>';
        }
    } else {


        $html_delivery .= '<td style=\"text-align:center; width:10%;padding:10px;\">--</td>';
    }


    $html_delivery .= '
                        <td style="width:30%"><br />____________________</td>';
    $html_delivery .= '</tr>';

    $html_delivery .=  '<tr>
    <td colspan="12" style="border-bottom:1px solid #000;">' . $sales_order_preview['description'] . ': ' . $type . '</td>
    </tr>';

    $dropdowns_html = "<tr style=\"border-bottom:1px solid black;width: 100%;\"><td style=\"border-bottom:1px solid black;\" colspan=\"9\"><p style=\"font-size:11px;\">";
    $row_count = 0;
    foreach ($product_items as $item) {
        if ($item['field_type'] == 'image') {
            if (isset($cart['product_itemr']) && count($cart['product_itemr']) > 0) {
                foreach ($cart['product_itemr'] as $key => $value) {
                    $menu_priv = explode(',', $cart['menu_privilages']);
                    if (in_array($key, $menu_priv)) {
                        if ($key == $item['id']) {
                            if (isset($item['lang_item_name']) && $item['lang_item_name'] != '') {
                                $dropdowns_html .= $item['lang_item_name'];
                            } else {
                                $dropdowns_html .= $item['item_name'];
                            }
                            $dropdowns_html .= " <span style='font-weight: normal'>";


                            if (isset($value[0]["image"]) && $value[0]["image"] == 1) {
                                if (isset($value[0]["value"]) && $value[0]["value"] != '' && file_exists("assets/uploads/product_images/" . $value[0]["value"])) {
                                    $dropdowns_html .= ' : <img class="brandmodeltitlelogo" src="' . FCPATH . '/assets/uploads/product_images/' . $value[0]["value"] . '" alt="' . $value[0]["value"] . '" width="20" height="20"/>';
                                } else {
                                    $dropdowns_html .= ' : <img class="brandmodeltitlelogo" src="' . $comingsoon . '" alt="coming soon" width="20" height="20"/>';
                                }
                            } else {
                                $dropdowns_html .= ' : <img class="brandmodeltitlelogo" src="' . $comingsoon . '" alt="coming soon" width="20" height="20"/>';
                            }

                            $dropdowns_html .= "</span> , ";

                            $row_count++;
                        }
                    }
                }
            }
        } else if ($item['field_type'] == 'text') {

            if (isset($cart['product_itemr']) && count($cart['product_itemr']) > 0) {
                foreach ($cart['product_itemr'] as $key => $value) {
                    $menu_priv = explode(',', $cart['menu_privilages']);
                    if (in_array($key, $menu_priv)) {
                        if ($key == $item['id']) {
                            if (isset($item['lang_item_name']) && $item['lang_item_name'] != '') {
                                $dropdowns_html .= $item['lang_item_name'];
                            } else {
                                $dropdowns_html .= $item['item_name'];
                            }
                            $dropdowns_html .= " <span style='font-weight: normal'>";

                            if (isset($value[0]["value"]) && $value[0]["value"] == 'All' && $lang_id !== 'en') {
                                $dropdowns_html .= $general_instruction->label_all;
                            } else {
                                $dropdowns_html .= isset($value[0]["value"]) ? $value[0]["value"] : '--';
                            }

                            $dropdowns_html .= "</span> , ";
?>
                <?php
                            $row_count++;
                        }
                    }
                }
            }
        } else if ($item['field_type'] == 'dropdown' and isset($session_cart[$cart['id']]) and isset($session_cart[$cart['id']]['dropdowns']) and is_array($session_cart[$cart['id']]['dropdowns'])) {
            $current_dropdowns = $session_cart[$cart['id']]['dropdowns'];
            foreach ($cart['product_itemr'] as $key => $value) {
                $menu_priv = explode(',', $cart['menu_privilages']);
                if (in_array($key, $menu_priv)) {
                    if ($key == $item['id'] and (isset($current_dropdowns[$key]) && !empty($current_dropdowns[$key]))) {
                        if (isset($item['lang_item_name']) && $item['lang_item_name'] != '') {
                            $dropdowns_html .= $item['lang_item_name'];
                        } else {
                            $dropdowns_html .= $item['item_name'];
                        }
                        $dropdowns_html .= " <span style='font-weight: normal'> : " . $current_dropdowns[$key];
                        $dropdowns_html .= " </span>";

                ?>
                        <?php $row_count++;
                    }
                }
            }
        }
    }

    $dropdowns_html .= "</p></td></tr>";


    $html_delivery .= ($row_count ? $dropdowns_html : '');



    $current_sel_maker = "no";
    $current_sel_model = "no";


    if (!empty($selMakerIds)) {


        foreach ($cart['related_submodels_arr']['maker'] as $single) {
            if ($selMakerIds && in_array($single['id'], $selMakerIds)) {
                $current_sel_maker = "yes";
            }
        }
    }



    $html_delivery .= '<tr><td style="width:100%;border-bottom:1px solid black;" colspan="12">';
    foreach ($cart['related_submodels_arr']['maker'] as $single) {
        if (($selMakerIds && in_array($single['id'], $selMakerIds) && $current_sel_maker == "yes") || empty($selMakerIds) || (!empty($selMakerIds) && $current_sel_maker == "no")) {
            $html_delivery .= '<span  style="margin-top:20px;">';
            $html_delivery .= '<span style="font-weight:700">' . $single['maker_name'] . '</span>';
            // if (isset($single['maker_logo']) && $single['maker_logo'] != '' && file_exists("assets/uploads/product_maker/thumb/" . $single['maker_logo'])) {
            //    $html_delivery .= '<img src="' . base_url() . 'assets/uploads/product_maker/thumb/' . $single['maker_logo'] . '" alt="' . $single['maker_logo'] . '" width="20" height="auto"/>';
            //   } else {
            //       $html_delivery .= '<img alt="client_logo" src="' . $noimage . '" width="20" height="auto" />';
            //   }
            $html_delivery .= '</span>';
            $html_delivery .= '<br />';
            $html_delivery .= '<div>';


            if (!empty($selModelIds)) {

                foreach ($single['models'] as $singlemode) {
                    //if ((in_array($singlemode['id'], $selModelIds)) || (count($selModelIds) <= 1)) {
                    if ((in_array($singlemode['id'], $selModelIds))) {
                        $current_sel_model = "yes";
                    }
                }
            }








            foreach ($single['models'] as $singlemode) {
                if ((in_array($singlemode['id'], $selModelIds)) || empty($selModelIds) || (!empty($selModelIds) && $current_sel_model == "no")) {
                    $html = "";
                    $html .= '<span style="padding-top:10px;">';
                    $html .= $singlemode['model_name'];
                    //  if (isset($singlemode['model_photo']) && $singlemode['model_photo'] != '' && file_exists("assets/uploads/product_model/thumb/" . $singlemode['model_photo'])) {
                    //     $html .= '<img src="' . base_url() . 'assets/uploads/product_model/thumb/' . $singlemode['model_photo'] . '" alt="' . $singlemode['model_photo'] . '" width="20" height="20"/>';
                    //  } else {
                    //      $html .= '<img alt="client_logo" src="' . $noimage . '" width="20" height="20" />';
                    //     }
                    $html .= '</span>';
                    $html .= '<br />';
                    $dropdowns_html = "<p style=\"font-size:11px;\">";
                    $row_count = 0;
                    foreach ($product_model_items as $item) {
                        if ($item['field_type'] == 'image') {
                            if (isset($cart['product_itemr']) && count($cart['product_itemr']) > 0) {
                                foreach ($cart['product_itemr'] as $key => $valueall) {
                                    $menu_priv = explode(',', $singlemode['menu_privilages']);
                                    if (in_array($key, $menu_priv)) {
                                        foreach ($valueall as $singlevalue) {
                                            if ($singlevalue['product_model_id'] == $singlemode['id']) {
                                                if ($key == $item['id']) {
                                                    if (isset($item['lang_item_name']) && $item['lang_item_name'] != '') {
                                                        $dropdowns_html .= $item['lang_item_name'];
                                                    } else {
                                                        $dropdowns_html .= $item['item_name'];
                                                    }
                                                    $dropdowns_html .= " <span style='font-weight: normal'>";

                                                    if (isset($singlevalue["image"]) && $singlevalue["image"] == 1) {
                                                        if (isset($singlevalue["value"]) && $singlevalue["value"] != '' && file_exists("assets/uploads/product_images/" . $value["value"])) {
                                                            $dropdowns_html .= ' : <img class="brandmodeltitlelogo" src="' . FCPATH . '/assets/uploads/product_images/' . $singlevalue["value"] . '" alt="' . $singlevalue["value"] . '" width="20" height="20"/>';
                                                        } else {
                                                            $dropdowns_html .= ' : <img class="brandmodeltitlelogo" src="' . $comingsoon . '" alt="coming soon" width="20" height="20"/>';
                                                        }
                                                    } else {
                                                        $dropdowns_html .= ' : <img class="brandmodeltitlelogo" src="' . $comingsoon . '" alt="coming soon" width="20" height="20"/>';
                                                    }
                                                    $dropdowns_html .= "</span> , ";

                                                    $row_count++;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        } else if ($item['field_type'] == 'text') {
                            foreach ($cart['product_itemr'] as $key => $valueall) {
                                $menu_priv = explode(',', $singlemode['menu_privilages']);
                                if (in_array($key, $menu_priv)) {
                                    foreach ($valueall as $singlevalue) {
                                        if ($singlevalue['product_model_id'] == $singlemode['id']) {
                                            if ($key == $item['id']) {
                                                if (isset($item['lang_item_name']) && $item['lang_item_name'] != '') {
                                                    $dropdowns_html .= $item['lang_item_name'];
                                                } else {
                                                    $dropdowns_html .= $item['item_name'];
                                                }
                                                $dropdowns_html .= " <span style='font-weight: normal'> : ";
                                                $dropdowns_html .= $singlevalue["value"] ? $singlevalue["value"] : '';
                                                $dropdowns_html .= "</span> , ";
                                                $row_count++;
                                            }
                                        }
                                    }
                                }
                            }
                        } else if ($item['field_type'] == 'dropdown' && isset($session_cart[$cart['id']]['model']['dropdowns']) && is_array($session_cart[$cart['id']]['model']['dropdowns'])) {


                            $current_dropdowns = $session_cart[$cart['id']]['model']['dropdowns'];


                            if (isset($current_dropdowns[$singlemode['id']][$item['id']]) && !empty($current_dropdowns[$singlemode['id']][$item['id']])) {
                                if (isset($item['lang_item_name']) && $item['lang_item_name'] != '') {
                                    $dropdowns_html .= '<span style="font-weight: bold">' . $item['lang_item_name'] . '</span>';
                                } else {
                                    $dropdowns_html .= '<span style="font-weight: bold">' . $item['item_name'] . '</span>';
                                }

                                if (isset($current_dropdowns[$singlemode['id']][$item['id']]) && $current_dropdowns[$singlemode['id']][$item['id']] == 'All' && $lang_id !== 'en') {
                                    $current_dropdowns_label = $general_instruction->label_all;
                                } else {
                                    $current_dropdowns_label =  $current_dropdowns[$singlemode['id']][$item['id']];
                                }

                                $dropdowns_html .= " <span style='font-weight: normal'> " . $current_dropdowns_label;
                                $dropdowns_html .= "</span> , ";
                                $row_count++;
                            }
                        }
                    }
                    $dropdowns_html .= "</p>";
                    $html .= ($row_count ? $dropdowns_html : '');
                    $html_delivery .=  $html;
                }
            }

            $html_delivery .= '</div>';
            $html_delivery .= '<br />';
        }
    }

    $html_delivery .= '</td></tr>';


    if ($cart_data[$cart['id']]['comment']) {
        $html_delivery .=  '<tr>
                        <td colspan="12" style="border-bottom:1px solid #000;">' . $sales_order_preview['comments'] . ': ' . $cart_data[$cart['id']]['comment'] . '</td>
                        </tr>';
    }
    $j++;
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
                          <table border="0" style="width:100%;" cellpadding="0">
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