<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Cart_model
 * Cart_model Class handle all database methods  those are required for cart functionalty on front end and admin side both. 
 */
class Cart_model extends CI_Model
{

    /**
     * __construct
     *
     *  All models  those we need to use in the model are initialized in the constructor.
     * @return void
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Method get_cart_details
     *
     * This Function get list of all orders or single order details for admin side from cart_users table.
     * @param $per_page $per_page [This parameter is the per  page limit for the  pagination data. ]
     * @param $offset $offset [This parameter is the   offset number for the  pagination data.]
     * @param $return $return [Based on this parameter return the data from the table.]
     * @param $cart_user_id $cart_user_id [This parameter is the cart_user_id based fetch the order data.]
     * @return void
     */
    function get_cart_details($return = 'all', $cart_user_id = '', $per_page = '', $offset = '', $user_id = '')
    {
        $this->db->select('cart_users.*,count(cart.id) as count_of_cart, cart.product_id,quotations.request_payment_type,quotations.request_percentage,quotations.id as quotation_id');
        $this->db->from('cart_users');
        $this->db->join('cart', 'cart_users.id = cart.user_id', 'left');
        $this->db->join('quotations', 'cart_users.id = quotations.order_id', 'left');
        $this->db->group_by('cart_users.id');
        $this->db->order_by('cart_users.id', 'DESC');
        if (!empty($cart_user_id)) {
            $this->db->where('cart_users.id', $cart_user_id);
        }

        if (!empty($user_id)) {
            $this->db->where('cart_users.user_id', $user_id);
        }
        if (!empty($per_page) || !empty($offset)) {
            $this->db->limit($per_page, $offset);
        }
        if ($return == 'all') {
            return $this->db->get()->result();
        } else if ($return == 'count') {
            return $this->db->get()->num_rows();
        } else if ($return == 'single') {
            return $this->db->get()->result();
        }
    }


    /**
     * Method get_cart_details
     *
     * This Function get list of all orders or single order details for admin side from cart_users table.
     * @param $per_page $per_page [This parameter is the per  page limit for the  pagination data. ]
     * @param $offset $offset [This parameter is the   offset number for the  pagination data.]
     * @param $return $return [Based on this parameter return the data from the table.]
     * @param $cart_user_id $cart_user_id [This parameter is the cart_user_id based fetch the order data.]
     * @return void
     */
    function get_quotation_details($return = 'all', $quotations_id = '', $per_page = '', $offset = '', $user_id = '',$quotation_only="")
    {
        $this->db->select('quotations.*');
        $this->db->from('quotations');
        $this->db->order_by('quotations.id', 'DESC');
        if (!empty($quotation_only)) {
            $this->db->where('quotations.order_id is null');
        }
        if (!empty($quotations_id)) {
            $this->db->where('quotations.id', $quotations_id);
        }

        if (!empty($user_id)) {
            $this->db->where('quotations.user_id', $user_id);
        }
        if (!empty($per_page) || !empty($offset)) {
            $this->db->limit($per_page, $offset);
        }
        if ($return == 'all') {
            return $this->db->get()->result();
        } else if ($return == 'count') {
            return $this->db->get()->num_rows();
        } else if ($return == 'single') {
            return $this->db->get()->result();
        }
    }


    function get_pricerequest_details($return = 'all', $request_id = '', $per_page = '', $offset = '', $user_id = '')
    {
        $this->db->select('price_requests.*,users.salutation,users.surname,users.company,users.email');
        $this->db->from('price_requests');
        $this->db->join('users', 'price_requests.user_id = users.id', 'left');

        if (!empty($request_id)) {
            $this->db->where('price_requests.id', $request_id);
        }

        if (!empty($user_id)) {
            $this->db->where('price_requests.user_id', $user_id);
        }
      
        if ($return == 'all') {
            $this->db->order_by('price_requests.id', 'DESC');

            if (!empty($per_page) || !empty($offset)) {
                $this->db->limit($per_page, $offset);
            }
            return $this->db->get()->result();
        } else if ($return == 'count') {
            return $this->db->get()->num_rows();
        } else if ($return == 'single') {
            return $this->db->get()->row_array();
        }
    }





    function get_user_details($return = 'all', $per_page = '', $offset = '', $user_id = '')
    {
        $this->db->select('users.*');
        $this->db->from('users');
        $this->db->order_by('users.id', 'DESC');
        if (!empty($user_id)) {
            $this->db->where('users.id', $user_id);
        }
        if (!empty($per_page) || !empty($offset)) {
            $this->db->limit($per_page, $offset);
        }
        if ($return == 'all') {
            return $this->db->get()->result();
        } else if ($return == 'count') {
            return $this->db->get()->num_rows();
        } else if ($return == 'single') {
            return $this->db->get()->result();
        }
    }


    function get_reffer_user_details($return = 'all', $per_page = '', $offset = '', $user_id = '')
    {
        $this->db->select('refferal_users.*');
        $this->db->from('refferal_users');
        $this->db->order_by('refferal_users.id', 'DESC');
        if (!empty($user_id)) {
            $this->db->where('refferal_users.id', $user_id);
        }
        if (!empty($per_page) || !empty($offset)) {
            $this->db->limit($per_page, $offset);
        }
        if ($return == 'all') {
            return $this->db->get()->result();
        } else if ($return == 'count') {
            return $this->db->get()->num_rows();
        } else if ($return == 'single') {
            return $this->db->get()->result();
        }
    }


    function get_discount_list($return = 'all', $per_page = '', $offset = '', $user_id = '')
    {
        $this->db->select('discount_coupons.*');
        $this->db->from('discount_coupons');
        $this->db->order_by('discount_coupons.id', 'DESC');
        if (!empty($user_id)) {
            $this->db->where('discount_coupons.id', $user_id);
        }
        if (!empty($per_page) || !empty($offset)) {
            $this->db->limit($per_page, $offset);
        }
        if ($return == 'all') {
            return $this->db->get()->result();
        } else if ($return == 'count') {
            return $this->db->get()->num_rows();
        } else if ($return == 'single') {
            return $this->db->get()->result();
        }
    }

    function get_discountusers_list($return = 'all', $per_page = '', $offset = '', $user_id = '')
    {
        $this->db->select('user_discounts.*');
        $this->db->from('user_discounts');
        $this->db->order_by('user_discounts.id', 'DESC');
        if (!empty($user_id)) {
            $this->db->where('user_discounts.id', $user_id);
        }
        if (!empty($per_page) || !empty($offset)) {
            $this->db->limit($per_page, $offset);
        }
        if ($return == 'all') {
            return $this->db->get()->result();
        } else if ($return == 'count') {
            return $this->db->get()->num_rows();
        } else if ($return == 'single') {
            return $this->db->get()->result();
        }
    }

    /**
     * Method get_cart_package_databyid
     * This Function return cart shipping packages as per the order id.
     * @param $id $id [This parameter is the id of the order.]
     *
     * @return void
     */
    function get_cart_package_databyid($id)
    {
        $this->db->select('*');
        $this->db->from('cart_packages');
        $this->db->where('cart_user_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

     /**
     * Method get_order_payments
     * This Function return cart shipping packages as per the order id.
     * @param $id $id [This parameter is the id of the order.]
     *
     * @return void
     */
    function get_order_payments($id)
    {
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->where('order_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }


      /**
     * Method get_order_payments
     * This Function return cart shipping packages as per the order id.
     * @param $id $id [This parameter is the id of the order.]
     *
     * @return void
     */
    function get_order_payments_total($id)
    {
        $this->db->select_sum('amount');
        $this->db->from('payments');
        $this->db->where('order_id',$id);
        $query = $this->db->get();
        $amount_data = $query->row_array();
        $total_amount =  $amount_data['amount'];
        return $total_amount;
    }

    /**
     * Method get_cart_user_product_data
     *
     * @param $cart_user_id $cart_user_id [This parameter is the id of the order.]
     *
     * @return void
     */
    function get_cart_user_product_data($cart_user_id)
    {
        // this code select data related to cart , cart products and cart users from cart, cart_users and tbl_product_category_maker_model_relation table
        $this->db->select('P.id as productid,P.*,cart.quantity as cart_quantity, cart.comment as comment, cart.store_id as store_id, cart_users.user_name as username,cart_users.id as userid,tbl_product_types.product_type_name,tbl_product_types.Product_Type_Photo as product_type_photo');
        $this->db->from('cart');
        $this->db->join('cart_users', 'cart.user_id = cart_users.id', 'left');
        $this->db->join('products as P', 'cart.product_id = P.id', 'left');
        $this->db->join('tbl_product_types', 'P.product_type_id  = tbl_product_types.id', 'left');
        $this->db->where('cart.user_id', $cart_user_id);
        return $this->db->get()->result_array();
    }

    /**
     * Method get_cart_order_data_by_id
     *
     * This Function return single  order products  data for admin side from cart_order_products  table as per the Id of the order. 
     * @param $cart_user_id $cart_user_id [explicite description]
     *
     * @return void
     */
    function get_cart_order_data_by_id($cart_user_id)
    {
        $this->db->select('*');
        $this->db->where('cart_user_id', $cart_user_id);
        return $this->db->get('cart_order_products')->result_array();
    }

    /**
     * Method get_cart_order_data_by_invoice_id
     *
     * This Function return single  order products  data for admin side from cart_order_products  table as per the product_id of the order. 
     * @param $product_id $product_id [explicite description]
     *
     * @return void
     */
    function get_cart_order_data_by_invoice_id($order_number)
    {
        $this->db->select('*');
        $this->db->join('(SELECT cart_user_id, cart_package_id,product_id,product_name, 1 as product_qty FROM cart_package_products 
        group by cart_user_id, cart_package_id,product_id,product_name) as cart_package_products','cart_package_products.cart_user_id = cart_order_products.cart_user_id and cart_package_products.product_name = cart_order_products.kgt_ref_number','left');
        $this->db->join('cart_packages','cart_packages.id = cart_package_products.cart_package_id  and cart_order_products.cart_store_id = cart_packages.store_id','left');
        $this->db->where('order_number', $order_number);
        $this->db->order_by('cart_packages.tracking_number','ASC');
        $result =  $this->db->get('cart_order_products')->result_array();
	//echo $this->db->last_query();exit;
        return $result;
        //(SELECT cart_user_id, cart_package_id,product_id,product_name,count(product_name) product_qty FROM cart_package_products group by cart_user_id, cart_package_id,product_id,product_name) as cart_package_products
    }

    /**
     * Method get_cart_order_attr_data_by_id
     *
     * This Function return single order products  attribute data for admin side from order_model & att  table as per the Id of the order. 
     * @param $cart_user_id $cart_user_id [explicite description]
     * @param $type $type [explicite description]
     *
     * @return void
     */
    function get_cart_order_attr_data_by_id($cart_user_id, $type)
    {
        $this->db->select('oa.*, om.category_name,om.maker_name,om.model_name');
        $this->db->where('oa.order_id', $cart_user_id);
        if ($type == 'model') {
            $this->db->where('oa.category_id >', 0);
        } else {
            $this->db->where('oa.category_id', 0);
        }
        $this->db->from('order_attributes as oa');
        $this->db->join('order_models as om', 'om.order_id = oa.order_id AND om.order_product_id = oa.order_product_id AND om.model_id = oa.model_id', 'LEFT');
        $order_attributes = $this->db->get()->result_array();
        $returnData = array();
        if (count($order_attributes) > 0) {
            foreach ($order_attributes as $attributes) {
                if ($type == 'model') {
                    $returnData[$attributes['order_product_id']][$attributes['maker_name']][$attributes['model_name']][] = $attributes;
                } else {
                    $returnData[$attributes['order_product_id']][] = $attributes;
                }
            }
        }
        //echo '<pre>';print_r($returnData);exit;
        return $returnData;
    }

    /**
     * Method getBlockDetails
     * This Function is used on a page which is not used. 
     * @return void
     */
    function getBlockDetails()
    {
        $query = $this->db->query('SELECT * FROM cart_block_users l JOIN (SELECT id FROM cart_block_users s  ORDER BY created_time desc ) as cart_block_users ON l.id=cart_block_users.id group by email');
        return $query->result();
    }

    /**
     * Method getAllSalesOrderSectionDataBySectionBlock
     * This Function get list of order section data on the behalf of section name and language id.
     * @param $section_block $section_block [This parameter is the name of the section]
     * @param $lang_id $lang_id [This paramter is the language id.]
     *
     * @return void
     */
    function getAllSalesOrderSectionDataBySectionBlock($section_block, $lang_id)
    {
        // this code return section data on the behalf section name
        $this->db->select('*');
        $this->db->where('section_block', $section_block);
        $result = $this->db->get('sales_order_section')->row_array();

        // this code return section data fields on the behalf section id
        $this->db->select('*');
        $this->db->where('sales_order_section_id', $result['id']);
        $this->db->order_by('id', 'ASC');
        $result1 = $this->db->get('sales_order_section_fields')->result_array();

        $array = array();
        foreach ($result1 as $res1) {
            // this code return section data fields and their values on the behalf section field id
            $this->db->select('S.*,SC.lang_value');
            $this->db->from('sales_order_section_values as S');
            $this->db->join('sales_order_section_values_country as SC', 'S.id = SC.lang_id AND SC.country_id = ' . $lang_id, 'LEFT');
            $this->db->where('S.sales_order_section_id', $result['id']);
            $this->db->where('S.sales_order_section_field_id', $res1['id']);
            $this->db->order_by('S.id', 'ASC');
            $this->db->order_by('S.sales_order_section_field_id', 'ASC');
            $result2 = $this->db->get()->result_array();

            // this function update field name on the behalf of language 
            $array[] = updateLanguageParameters($result2);
        }
        return $array;
    }

    /**
     * Method getState
     *
     * This Function return list of states on the behalf of country id and language id.
     * @param $country $country [This parameter is the country id.]
     * @param $lang_id $lang_id [This parameter is the language  id.]
     *
     * @return array
     */
    function getState($country, $lang_id)
    {
        // this code get list of states on the behalf of country id.
        $this->db->select('S.*, SC.lang_name');
        $this->db->where('S.country_id', $this->security->xss_clean($country));
        $this->db->from('state as S');
        $this->db->join('state_country as SC', 'S.id = SC.lang_id AND SC.country_id = ' . $lang_id, 'LEFT');
        $this->db->order_by('S.name', 'ASC');
        return $this->db->get()->result_array();
    }


    /**
     * Method getState_Name
     *
     * This Function return single state row on the behalf of country id and language id and state code.
     * @param $country $country [This parameter is the country id.]
     * @param $lang_id $lang_id [This parameter is the language  id.]
     *
     * @return array
     */
    function getState_Name($country_shortcode, $lang_id, $shortcode)
    {
        // this code get list of states on the behalf of country id.
        $this->db->select('S.*, SC.lang_name');
        $this->db->where('S.country_id', $this->security->xss_clean($country_shortcode));
        $this->db->where('S.shortcode', $this->security->xss_clean($shortcode));
        $this->db->from('state as S');
        $this->db->join('state_country as SC', 'S.id = SC.lang_id AND SC.country_id = ' . $lang_id, 'LEFT');
        $this->db->order_by('S.name', 'ASC');
        // $this->db->get()->row_array();
        // echo $this->db->last_query();
        // exit;
        return $this->db->get()->row_array();
    }

    /**
     * Method getTaxBaseRate
     * This Function return tax base rate on the behalf of state code and Zip code.
     * @param $state $state [This parameter is the state code.]
     * @param $zip $zip [This parameter is the zip code.]
     *
     * @return void
     */
    function getTaxBaseRate($state, $zip)
    {
        $this->db->select('*');
        $this->db->from('tax_rate');
        $this->db->where('state_code', $state);
        // $this->db->where('zip', $zip);
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Method getInvoiceDetails
     * This Function return complete cart data on the behalf on cart user id.
     * @param $user_id $user_id [This parameter is the cart user id.]
     *
     * @return array
     */
    function getInvoiceDetails($user_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('cart_users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        $cart_user = $query->row_array();
        unset($cart_user['cart_all_data']);

        $cartdata = array();
        $this->db->select('*');
        $this->db->from('cart');
        $this->db->where('user_id', $cart_user['id']);
        $query = $this->db->get();
        // this function return all products of the cart on the behalf of cart user id 
        $cart_details = $query->result_array();
        foreach ($cart_details as $cart) {
            // this function iterate each product of the cart and append in the  array
            $cartdata[$cart['product_id']] = array(
                'item_id'  => $cart['product_id'],
                'comment'  => $cart['comment'],
                'quantity' => $cart['quantity']

            );
        }

        $cartpackagedata = array();
        $this->db->select('*');
        $this->db->from('cart_packages');
        $this->db->where('cart_user_id', $cart_user['id']);
        $query = $this->db->get();
        // this function return all shipping packages of the cart on the behalf of cart user id 
        $cart_package_details = $query->result_array();
        foreach ($cart_package_details as $cart_package) {
            // this function iterate each package  of the cart and append in the  array
            $cartpackagedata[] = array(
                'tracking_number' => $cart_package['tracking_number'],
                'package_type' => $cart_package['package_type']
            );
        }
        $data['cart_users_data']        = $cart_user;
        $data['cart_details']           = $cartdata;
        $data['cart_package_data']      = $cartpackagedata;
        $data['cart_package_details']   = $cart_package_details;
        return $data;
    }

    function getInvoiceDetailsNew($user_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('cart_users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        $cart_user = $query->row_array();
        unset($cart_user['cart_all_data']);

        $cartdata = array();
        $this->db->select('cart.*,store.id as store_id');
        $this->db->from('cart');
        $this->db->join('store',"cart.comment = concat(store.name,':')");
        $this->db->where('user_id', $cart_user['id']);
        $query = $this->db->get();
        // this function return all products of the cart on the behalf of cart user id 
        $cart_details = $query->result_array();
        
        $new_cartDetails= array();
        foreach ($cart_details as $cart) {
            // this function iterate each product of the cart and append in the  array
            $cartdata[$cart['product_id']] = array(
                'item_id'  => $cart['product_id'],
                'comment'  => $cart['comment'],
                'quantity' => $cart['quantity']

            );
            $quantity = array($cart['store_id'] =>$cart['quantity']);
            $comment = array($cart['store_id'] => $cart['comment']);
            if(count($new_cartDetails[$cart['product_id']])>0){                 
                $new_cartDetails[$cart['product_id']]['quantity'][$cart['store_id']] = $cart['quantity'];
                $new_cartDetails[$cart['product_id']]['comment'][$cart['store_id']] = $cart['comment'];
            }else{
                $new_cartDetails[$cart['product_id']] = array (
                    'item_id'  => $cart['product_id'],
                    'comment'  => $comment,
                    'quantity' => $quantity
                );
            }            
        }
        $cartdata = $new_cartDetails;
        
        // echo '<pre>'; print_r($cartdata); echo '</pre>';
       
        $cartpackagedata = array();
        $this->db->select('*');
        $this->db->from('cart_packages');
        $this->db->where('cart_user_id', $cart_user['id']);
        $query = $this->db->get();
        // this function return all shipping packages of the cart on the behalf of cart user id 
        $cart_package_details = $query->result_array();
        foreach ($cart_package_details as $cart_package) {
            // this function iterate each package  of the cart and append in the  array
            $cartpackagedata[] = array(
                'tracking_number' => $cart_package['tracking_number'],
                'package_type' => $cart_package['package_type']
            );
        }
        $data['cart_users_data']        = $cart_user;
        $data['cart_details']           = $cartdata;
        $data['cart_package_data']      = $cartpackagedata;
        $data['cart_package_details']   = $cart_package_details;
        return $data;
    }

    /**
     * Method getPackageDetails
     *
     * This Function  return ups shipping api setting on tha behalf of country id.
     * @param $cart_user_id $cart_user_id [This parameter is the cart user id.]
     *
     * @return array 
     */
    function getPackageDetails($cart_user_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('cart_packages');
        $this->db->where('cart_user_id', $cart_user_id);
        $query = $this->db->get();
        $cart_package_details = $query->result_array();
        foreach ($cart_package_details as $cart_package) {
            $cart_package_products = array();
            $cart_package_products = $this->db->query("SELECT cart_package_id, product_id, product_name, count(*) as quantity FROM cart_package_products WHERE cart_user_id = '" . $cart_package['cart_user_id'] . "' AND cart_package_id = '" . $cart_package['id'] . "' GROUP BY product_id")->result_array();

            $data[] = array(
                'id' => $cart_package['id'],
                'cart_user_id' => $cart_package['cart_user_id'],
                'package_nature' => $cart_package['package_nature'],
                'package_name' => $cart_package['package_name'],
                'tracking_number' => $cart_package['tracking_number'],
                'cart_package_products' => $cart_package_products
            );
        }
        return $data;
    }

    /**
     * Method get_ups_api_settings
     *
     * This Function  return ups shipping api setting on tha behalf of country id.
     * @param $country_code $country_code [This parameter is the country id.]
     *
     * @return array 
     */
    function get_ups_api_settings($country_code = 'us')
    {
        if (!in_array($country_code, array('us', 'ca', 'in'))) {
            $country_code = 'us';
        }

        $shipping_mode = $this->config->item('shipping_mode');
        if (empty($shipping_mode)) {
            $shipping_mode = 0;
        }

        $this->db->select('*');
        $this->db->where('country', $country_code);
        $this->db->where('shipping_api_mode', $shipping_mode);
        return $this->db->get('ups_api_setting')->row_array();
    }

    /**
     * Method get_fedex_api_settings
     *
     * This Function  return ups shipping api setting on tha behalf of country id.
     * @param $country_code $country_code [This parameter is the country id.]
     *
     * @return array 
     */
    function get_fedex_api_settings($country_code = 'ca')
    {
        
        $shipping_mode = $this->config->item('shipping_mode');
        if (empty($shipping_mode)) {
            $shipping_mode = 0;
        }

        $this->db->select('*');
        $this->db->where('country', $country_code);
        $this->db->where('shipping_api_mode', $shipping_mode);
        return $this->db->get('fedex_settings')->row_array();
    }

    /**
     * Method get_freightcom_api_settings
     *
     * This Function  return ups shipping api setting on tha behalf of country id.
     * @param $country_code $country_code [This parameter is the country id.]
     *
     * @return array 
     */
    function get_freightcom_api_settings($country_code = 'us')
    {
        
        $shipping_mode = $this->config->item('shipping_mode');
        if (empty($shipping_mode)) {
            $shipping_mode = 0;
        }

        $this->db->select('*');
        $this->db->where('country', $country_code);
        $this->db->where('shipping_api_mode', $shipping_mode);
        return $this->db->get('freightcom_settings')->row_array();
    }

    /**
     * Method bambora_ups_api_settings
     *
     * This Function  return bambora  payment api settings on tha behalf of country id.
     * @param $country_code $country_code [This parameter is the country id.]
     *
     * @return array 
     */
    function bambora_ups_api_settings($country_code = 'us')
    {
        $this->db->select('*');
        $this->db->where('country', $country_code);
        return $this->db->get('bambora_api_setting')->row_array();
    }


    /**
     * Method square_api_settings
     *
     * This Function  return squareup  payment api settings on tha behalf of country id.
     * @param $country_code $country_code [This parameter is the country id.]
     *
     * @return array 
     */
    function square_api_settings($country_code = 'us')
    {
        $payment_mode = $this->config->item('payment_mode');
        if (empty($payment_mode)) {
            $payment_mode = 0;
        }
        $this->db->select('*');
        $this->db->where('country', $country_code);
        $this->db->where('payment_api_mode', $payment_mode);
        return $this->db->get('squareup_api_setting')->row_array();
    }

    /**
     * Method getUserBlockByStatus
     *
     * This Function  return bambora  payment api settings on tha behalf of country id.
     * @param $table $table [This parameter is the table.]
     * @param $email $email [This parameter is the email id.]
     * @param $status $status [This parameter is the status.]
     *
     * @return array 
     */
    function getUserBlockByStatus($table, $email, $status = '')
    {
        $querystr = 'SELECT * FROM ' . $table . ' WHERE id = (SELECT MAX(id) FROM ' . $table . ' WHERE email = "' . $email . '"';
        if ($status != '')
            $querystr .= ' and status = "' . $status . '" ';
        $querystr .= ' and FROM_UNIXTIME(created_time)>DATE_SUB(now(), INTERVAL 2 HOUR )  )';
        $query = $this->db->query($querystr);
        return $query->result();
    }

    /**
     * Method delete_blocked_id
     *
     * @param $table $table [This parameter is the  name of the table.]
     * @param $array $array [explicite description]
     *
     * @return void
     */
    function delete_blocked_id($table, $array)
    {
        $this->db->where($array);
        $query = $this->db->get($table);
        $result = $query->result_array();
        $email = $result[0]['email'];
        $this->db->delete($table, array('email' => $email));
        return true;
    }
}
