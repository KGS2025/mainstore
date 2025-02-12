<?php
ob_clean();


$comingsoon = FCPATH.'/assets/frontend/images/coming_soon.png';
$noimage    = FCPATH.'/assets/frontend/images/noimage1.png';

if (isset($all_data['cart_photo']) && $all_data['cart_photo'] != '' && file_exists(FCPATH . 'assets/uploads/cart/thumbnails/' . $all_data['cart_photo'])) {
    $cartphoto_2 = FCPATH . '/assets/uploads/cart/thumbnails/' . $all_data['cart_photo'];
} elseif(isset($all_data['logo']) && file_exists(FCPATH . 'assets/uploads/logo/thumbnails/' . $all_data['logo'])) {
    $cartphoto_2 = FCPATH . '/assets/uploads/logo/thumbnails/' . $all_data['logo'];
} else{
    $cartphoto_2 = $noimage;
}

if (isset($all_data['cart_photo']) && $all_data['cart_photo'] != '' && file_exists(FCPATH . 'uploads/cart/small/' . $all_data['cart_photo'])) {
    $cartphoto = global_img_link($all_data['cart_photo'], 'uploads/cart/small/');
} elseif(isset($all_data['logo']) && file_exists(FCPATH . 'uploads/logo/thumbnails/' . $all_data['logo'])) {
    $cartphoto = global_img_link($all_data['logo'], 'uploads/logo/thumbnails/');
} else{
    $cartphoto = $noimage;
}


if ($cart_users_data['client_logo'] != '' && file_exists(FCPATH."assets/uploads/cart/".$cart_users_data['client_logo'])) {
 
    $client_logo =  FCPATH.'/assets/uploads/cart/'.$cart_users_data['client_logo'];
} else {
    $client_logo =  $noimage;
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


$html_2 = '<html>
            <head>
            </head>
            <body>
            <table border="0" style="width:100%; text-align:center; background-color:#f7f7f7;" cellpadding="10">
                  <tr>
                      <td style="width: 100%;"><strong>' . $sales_order_preview['receipt'] . '</strong>
                      </td>
                  </tr>
              </table>
              <br />
              <br />
              <table border="0" style="width:100%;" cellpadding="0">
                  <tr>
                      <td style="width: 25%;"><img src="'.$cartphoto_2.'" alt="logo" width="80" height="auto"><br /><strong>' . $sales_order_preview['logo_tagline'] . '</strong><br />
                        ' . $sales_order_preview['company_address_1'] . '<br />
                        ' . $sales_order_preview['company_address_2'] . '<br />
                        ' . $sales_order_preview['company_address_3'] . '<br />
                      </td>
                      <td style="width: 50%;">
                      </td>
                      <td style="width:25%; float: right;">';

                        $html_2 .= '<img alt="client_logo" src="'.$client_logo.'" width="80" height="auto" />';

                        $html_2 .= '</td>
                  </tr>
              </table>
              <br />
              <br />
              <table style="width: 100%; margin-top:25px;">
                  <tr>
                      <td>
                      <p style="line-height:2px;">' . $sales_order_preview['company_address_1'] . '</p>
                      <p style="line-height:2px;">' . $sales_order_preview['company_address_2'] . '</p>
                      <p style="line-height:2px;">' . $sales_order_preview['company_address_3'] . '</p>
                      <p style="line-height:2px;">' . $sales_order_preview['company_phone'] . '</p>';
                        if (isset($sales_order_preview['company_fax']) && $sales_order_preview['company_fax'] != '') {
                        $html_2 .= '<p style="line-height:2px;">' . $sales_order_preview['company_fax'] . '</p>';
                        }
                        if (isset($sales_order_preview['company_email']) && $sales_order_preview['company_email'] != '') {
                            $html_2 .= '<p style="line-height:2px;">' .$sales_order_preview['company_email'] . '</p>';
                        }
                        $html_2 .= '<p style="line-height:2px;">' .$sales_order_preview['company_website'] . '</p>';

                        if ($cart_users_data['country_shortcode'] != 'ca') {
                            
                            if (isset($sales_order_preview['gst_number']) && $sales_order_preview['gst_number'] != '') {
                                $html_2 .= '<p style="line-height:2px;">' . $sales_order_preview['gst_text'] . ' : ' . $sales_order_preview['gst_number'] . '</p>';
                            }
                            if (isset($sales_order_preview['fed_id']) && $sales_order_preview['fed_id'] != '') {
                                $html_2 .= '<p style="line-height:2px;">' . $sales_order_preview['fed_id_text'] . ' : ' . $sales_order_preview['fed_id'] . '</p>';
                            }
                        }

                        $html_2 .= '<p style="line-height:2px;">' . $sales_order_preview['invoice_number'] . ':' . invoicenumber_front($cart_users_data['invoice_number']). '</p>
                                            ' . $sales_order_preview['totalorder'];
                        // if (strtolower($cart_users_data['country']) == 'canada') {
                        //     $currency = $general_instruction->cad_currency;
                        // } else {
                        //     $currency = $general_instruction->usd_currency;
                        // }

                        $currencyV = $payments['currency'].'_currency';
                        $currency  = $general_instruction->$currencyV;

                        $html_2 .= ' : ' . round($totalCartValue, 2) . ' ( ' . $currency . ')
                      </td>
                      ';
                        // if (strtolower($cart_users_data['country']) == 'canada') {
                        //     $currency = $general_instruction->cad_currency;
                        // } else {
                        //     $currency = $general_instruction->usd_currency;
                        // }

                        $html_2 .= '<td><p style="line-height:2px;">' . $sales_order_preview['receipt_please_retails'] . '</p>';
                        $html_2 .= '<p style="line-height:2px;">' . $sales_order_preview['purchase'] . ' ' . date('Y-m-d') . '</p>';
                       
                        if ($this->config->item('payment_gateway') == 'paymee') {
                            $html_2 .= '<p style="line-height:2px;">'.$sales_order_preview['card_text'] . ' ' . $payments['card_number'] . ' ' . round($payments['amount'], 2) . ' ( ' . $currency . ')</p>';
                            $html_2 .= '<p style="line-height:2px;">'.$sales_order_preview['auth_text'] . ' ' . $payments['transaction_id'] . '</p>';
                        } else  if ($this->config->item('payment_gateway') != 'paymee') {
                            $html_2 .= '<p style="line-height:2px;">'.$sales_order_preview['card_text'] . ' ** ** **** ' . $payments['card_number'] . ' ' . round($payments['amount'], 2) . ' ( ' . $currency . ')</p>';
                            $html_2 .= '<p style="line-height:2px;">'.$sales_order_preview['auth_text'] . ' ' . $payments['transaction_id'] . '</p>';
                        }
                        $html_2 .= '<p style="line-height:2px;">' . $sales_order_preview['approved_thank_you'] . '</p>';
                        $html_2 .= '<p style="line-height:2px;">' . $sales_order_preview['cardholder_copy'] . '</p>';
                        $html_2 .= '<p style="line-height:2px;">' . date('d M Y H:i:s') . '</p> </td>';
                        $html_2 .= '</tr>
              </table>
                <table border="0" style="width:100%;" cellpadding="0">
                <tr>
                    <td style="text-align:center;  margin: 10px 0px;"><strong>' . $all_data['copyright'] . '</strong>
                    </td>
                </tr>
            </table>
            </body>
        </html>';

echo $html_2;
