<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// this code set the the global settings configuration.
$CI = &get_instance();
$CI->load->database();
$CI->db->select('setting_name, setting_value');
$settingsResult = $CI->db->get('global_settings')->result_array();
if (count($settingsResult) > 0) {
    foreach ($settingsResult as $result) {
        if ($result['setting_name'] && !empty($result['setting_value'])) {
            $CI->config->set_item($result['setting_name'], $result['setting_value']);
        }
    }
}

function getRealIpAddr()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')) {
        $ipaddress = getenv('HTTP_CLIENT_IP');
    } else if (getenv('HTTP_X_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    } else if (getenv('HTTP_X_FORWARDED')) {
        $ipaddress = getenv('HTTP_X_FORWARDED');
    } else if (getenv('HTTP_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    } else if (getenv('HTTP_FORWARDED')) {
        $ipaddress = getenv('HTTP_FORWARDED');
    } else if (getenv('REMOTE_ADDR')) {
        $ipaddress = getenv('REMOTE_ADDR');
    } else {
        $ipaddress = 'UNKNOWN';
    }

    return $ipaddress;
}

function getFrontenduserId()
{
    $ci = &get_instance();
    return !empty($ci->session->userdata('logged_user_id')) ? $ci->session->userdata('logged_user_id') : '';
}

function loginuserdata()
{
    $user_id = getFrontenduserId();
    $CI = &get_instance();
    $CI->db->select('*');
    $CI->db->from('users');
    $CI->db->where('id', $user_id);
    $query = $CI->db->get();
    $result = $query->row_array();
    return $result;
}

function check_product_access($product_id)
{
    $user_id = getFrontenduserId();
    $products = array();
    $CI = &get_instance();
    $CI->db->select('approved_products');
    $CI->db->from('users');
    $CI->db->where('id', $user_id);
    $query = $CI->db->get();
    $result = $query->row_array();
    $products = explode(",", $result['approved_products']);
    if ($CI->config->item('limited_price_option') == "1" && in_array($product_id, $products)) {
        return true;

    } else if ($CI->config->item('limited_price_option') == "0") {
        return true;

    } else {
        return false;
    }

}

function check_price_request_count()
{
    $CI = &get_instance();
    $price_request_product = $CI->session->userdata('price_request_product');
    if($price_request_product) {
    $total = count($price_request_product);
    } else {
    $total = 0;
    }
    return $total;
}

function loginuserterm()
{
    $user_id = getFrontenduserId();
    $CI = &get_instance();
    $CI->db->select('*');
    $CI->db->from('user_terms');
    $CI->db->where('user_id', $user_id);
    $CI->db->where('credit_term_status', "1");
    $query = $CI->db->get();
    $result = $query->row_array();
    return $result;
}

function generate_user_id()
{
    $starting_digit = 5;
    $first_part1 = rand(0, 99);
    if (strlen($first_part1) == 1) {
        $first_part = "0" . $first_part1;
    } else {
        $first_part = $first_part1;
    }
    $second_part1 = rand(1, 999);
    if (strlen($second_part1) == 1) {
        $second_part = "00" . $second_part1;
    } elseif (strlen($second_part1) == 2) {
        $second_part = "0" . $second_part1;
    } else {
        $second_part = $second_part1;
    }
    $third_part1 = rand(1, 9999);
    if (strlen($third_part1) == 1) {
        $third_part = "000" . $third_part1;
    } elseif (strlen($third_part1) == 2) {
        $third_part = "00" . $third_part1;
    } elseif (strlen($third_part1) == 3) {
        $third_part = "0" . $third_part1;
    } else {
        $third_part = $third_part1;
    }
    $userid = $starting_digit . $first_part . $second_part . $third_part;
    return $userid;
}

function generate_rand_no()
{
    $starting_digit = 5;
    $first_part1 = rand(0, 99);
    if (strlen($first_part1) == 1) {
        $first_part = "0" . $first_part1;
    } else {
        $first_part = $first_part1;
    }
    $second_part1 = rand(1, 999);
    if (strlen($second_part1) == 1) {
        $second_part = "00" . $second_part1;
    } elseif (strlen($second_part1) == 2) {
        $second_part = "0" . $second_part1;
    } else {
        $second_part = $second_part1;
    }

    $randno = $starting_digit . $first_part . $second_part;
    return $randno;
}

function generate_customer_no()
{
    $customer_no = generate_user_id();
    $CI = &get_instance();
    $CI->db->select('customer_no');
    $CI->db->from('users');
    $CI->db->where('customer_no', $customer_no);
    $query = $CI->db->get()->num_rows();
    if ($query == "0") {

        return $customer_no;
    } else {

        $customer_no = generate_user_id();
    }

    return $customer_no;
}

function used_credit_limit()
{
    $user_id = getFrontenduserId();
    $CI = &get_instance();
    $querysql = 'SELECT sum(`amount`) as pending_limit FROM `payments` WHERE user_id="' . $user_id . '" and payment_method="2" and status="2" ';
    $query = $CI->db->query($querysql);
    $result = $query->row_array();
    return $result['pending_limit'];
}

function available_credit_limit()
{
    $used_credit_limit = used_credit_limit();
    $user_term = loginuserterm();
    if (isset($user_term['term_amountlimit'])) {
        $remaing_limit = $user_term['term_amountlimit'] - $used_credit_limit;
        if ($remaing_limit > 0) {
            return $remaing_limit;
        } else {

            return 0;
        }
    } else {
        return 0;
    }
}

function setBrowserCountryCode()
{
    $ci = &get_instance();
    if (empty($ci->session->userdata('default_currency_code'))) {
        $ip_data = getUserIpData();
        $default_currency_code = 'CAD';
        $allowedCodes = array('US', 'CA', "IN");
        if ($ip_data && $ip_data['countryCode'] && in_array($ip_data['countryCode'], $allowedCodes) && $ip_data['countryCode'] == "IN") {
            $default_currency_code = 'INR';
        } else if ($ip_data && $ip_data['countryCode'] && in_array($ip_data['countryCode'], $allowedCodes) && $ip_data['countryCode'] == "CA") {
            $default_currency_code = 'CAD';
        } else if ($ip_data && $ip_data['countryCode'] && in_array($ip_data['countryCode'], $allowedCodes) && $ip_data['countryCode'] == "US") {
            $default_currency_code = 'USD';
        }

        //  $ci->session->set_userdata(array('default_currency_code' => $default_currency_code));
    }
}

function getUserIpData()
{
    $ip = getRealIpAddr();
    if($ip == '127.0.0.1')
        $ip = '172.218.200.55';//getRealIpAddr(); // This will contain the ip of the request
    $ci = &get_instance();
    $ip_data = $ci->comman_model->get_data_by_id('user_ip_data', array('ipaddress' => $ip));

   // print_r($ip);exit;
    if (count($ip_data) > 0) {
        return $ip_data;
    } else {
        $ch = curl_init("http://www.geoplugin.net/json.gp?ip=" . $ip);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        $data = curl_exec($ch);
        $ip_data = @json_decode($data, true);
        if ($ip_data && $ip_data['geoplugin_countryCode']) {
            $insertData = array(
                'ipAddress' => $ip,
                'countryCode' => $ip_data['geoplugin_countryCode'],
                'regionCode' => $ip_data['geoplugin_regionCode'],
                'rawData' => json_encode($ip_data),
                'dateAdded' => date('Y-m-d H:i:s'),
            );
            $ci->comman_model->insert_column('user_ip_data', $insertData);
            return $insertData;
        }
    }
}

function iscoupon_valid($coupon_code)
{

    $ci = &get_instance();
    $userLangData = get_user_lang_data(array('form_validation_instruction'), $ci->lang->default_lang_id);
    $form_validation_instruction = (object) $userLangData['form_validation_instruction'];
    if ($coupon_code) {
        // this function check is coupon   exist in the table  or not.
        $exists = $ci->comman_model->get_coupon($coupon_code);

        $responce = array();
        if ($exists) {
            $cart = $ci->session->userdata('cart');
            $cart_products = array_column($cart, 'item_id');
            $coupon_products = explode(",", $exists['products']);
            $coupon_users = explode(",", $exists['users']);
            $matched_records = array_intersect($coupon_products, $cart_products);
            $user_id = getFrontenduserId();

            if ($user_id) {
                $exists_cou = $ci->comman_model->get_data_by_id("cart_users", array("user_id" => $user_id, "coupon_applied" => 1, "discount_id" => $exists['id']));
                if ($exists_cou) {
                    $responce['status'] = 0;
                    $responce['message'] = $form_validation_instruction->coupon_already_used;
                    return $responce;
                }
            }

            if ((count($matched_records) > 0 || $exists['products'] == "All")) {

                if ((in_array($user_id, $coupon_users) || $exists['users'] == "All")) {
                    $responce['status'] = 1;
                    $responce['data'] = $exists;
                } else {
                    $responce['status'] = 0;
                    $responce['message'] = $form_validation_instruction->coupon_valid_user;
                }
            } else {

                $responce['status'] = 0;
                $responce['message'] = $form_validation_instruction->coupon_valid_product;
            }
        } else {
            // if not  exist than this code return true
            $responce['status'] = 0;
            $responce['message'] = $form_validation_instruction->coupon_expire_valid;
        }
    } else {
        $responce['status'] = 0;
        $responce['message'] = $form_validation_instruction->coupon_valid;
        return $responce;
    }
    return $responce;
}

function get_product_discount($product_id, $price, $quantity, $coupon_data)
{
     if(is_array($quantity)){
        $quantity_array = $quantity;
        $quantity  = 0;
        foreach ($quantity_array as $qstore=>$qty){
            $quantity += $qty;
        }
    }

    $discount = array('amount' => "");
    $coupon_products = explode(",", $coupon_data['products']);
    if (in_array($product_id, $coupon_products) || $coupon_data['products'] == "All") {
        foreach ($coupon_data['ranges'] as $ranges) {
            if ($quantity >= $ranges['fromstart'] && $quantity <= $ranges['fromend']) {
                $totprice = $price * $quantity;
                $discounted_amount = $totprice * $ranges['percentage'] / 100;
                $discount['amount'] = $discounted_amount;
                $discount['percentage'] = $ranges['percentage'];
                break;
            }
        }
    } else {
        $discount['amount'] = "";
    }
    return $discount;
}

function get_allproduct_user_discount($product_id, $quantity, $all = "")
{    
    if(is_array($quantity)){
        $qty_array = $quantity;
        $quantity = 0;
        foreach ($qty_array as $key=>$val){
            $quantity += $val;
        }
    }    
    
    $current_date = date("Y-m-d h:i:s");
    $user_id = getFrontenduserId();
    $ci = &get_instance();
    $query = "SELECT * FROM user_discounts LEFT JOIN user_discounts_ranges ON user_discounts_ranges.discount_id = user_discounts.id WHERE user_discounts.status = 1 AND user_discounts.expirytime > '" . $current_date . "' AND user_discounts_ranges.fromstart <= " . $quantity . " AND user_discounts_ranges.fromend >= " . $quantity;
    if ($user_id) {
        $query .= " AND (FIND_IN_SET(" . $user_id . ",user_discounts.users) <> '0' OR user_discounts.users = 'All') ";
    } else {
        $query .= " AND  user_discounts.users = 'All' ";
    }
    $query .= "AND ( FIND_IN_SET('" . $product_id . "',user_discounts.products) <> '0' OR user_discounts.products = 'All') ORDER BY user_discounts_ranges.percentage desc";
    $result = $ci->db->query($query)->row_array();
    return $result;
}

function get_user_product_discount($product_id, $price, $quantity)
{
    if(is_array($quantity)){
        $quantity_array = $quantity;
        $quantity  = 0;
        foreach ($quantity_array as $qstore=>$qty){
            $quantity += $qty;
        }
    }
    $discount = array('amount' => "");
    $result = get_allproduct_user_discount($product_id, $quantity);
    if ($result) {
        $totprice = $price * $quantity;
        $discounted_amount = $totprice * $result['percentage'] / 100;
        $discount['amount'] = $discounted_amount;
        $discount['percentage'] = $result['percentage'];
    } else {
        $discount['amount'] = "";
    }
    return $discount;
}

function setDefaultLanguage()
{
    $ci = &get_instance();
    $ip_data = getUserIpData();
    if ($ip_data && $ip_data['countryCode'] && $ip_data['regionCode']) {
        $ci->db->select('C.short_code');
        $ci->db->where("`DL`.`status` = 1 AND `DL`.`countryCode` = '" . strtolower($ip_data['countryCode']) . "' AND (`DL`.`stateCode` = '" . strtolower($ip_data['regionCode']) . "' OR `DL`.`stateCode` = '" . $ip_data['regionCode'] . "') AND C.status = 1");
        $ci->db->from('default_language as DL');
        $ci->db->join('country as C', 'C.id = DL.languageId');
        $response = $ci->db->get()->row_array();
        if (isset($response['short_code']) && $response['short_code']) {
            $ci->session->set_userdata(array('default_language' => $response['short_code']));
        } else {
            $ci->session->unset_userdata('default_language');
        }
    }
}

function getDefaultCurrencyCode($case = 'l')
{
    $ci = &get_instance();
    if ($ci->config->item('store_country') == '91') {
        $default_currency_code = 'INR';
    } else if ($ci->config->item('store_country') == '420' || $ci->config->item('store_country') == '49') {
        $default_currency_code = 'EUR';
    } else if ($ci->config->item('payment_gateway') == 'paymee') {
        $default_currency_code = 'TND';
    } else if ($ci->config->item('payment_gateway') == 'squareup') {
        $default_currency_code = 'CAD';
    } else if ($ci->config->item('payment_gateway') == 'clictopay') {
        $default_currency_code = 'TND';
    } else {
        $default_currency_code = $ci->config->item('default_currency_code') ? $ci->config->item('default_currency_code') : 'CAD';
    }
    return $case == 'l' ? strtolower($default_currency_code) : strtoupper($default_currency_code);
}

function isMobile()
{
    if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) {
        return true;
    } else {
        return false;
    }
}

function invoicenumber_front($string)
{
    $newtext = wordwrap($string, 4, "-", true);
    return $newtext;
}

function getRandomCode()
{
    $codes = array('ertu679', 'sd213', '4578214', 'aewrtf', '6783fr3f');
    $key = array_rand($codes);
    return $codes[$key];
}

function checkRandomCode($code)
{
    $codes = array('ertu679', 'sd213', '4578214', 'aewrtf', '6783fr3f');
    if (in_array($code, $codes)) {
        return true;
    } else {
        return false;
    }
}

if (!function_exists("triggerZeroBounceValidaorApi")) {
    // trigger the email validator api and return response
    function triggerZeroBounceValidaorApi($emailId)
    {
        // URL which should be requested
        $url = 'https://api.zerobounce.net/v2/validate?api_key=' . getenv('ZERO_BOUNCE_API_KEY') . '&email=' . urlencode($emailId) . '&ip_address=' . urlencode(getRealIpAddr());

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        //decode the json response
        $responseData = json_decode($response, true);

        $response = true;
        if (!isset($responseData['error']) && $responseData['status'] == 'valid') {
            $response = true;
        }
        return $response;
    }
}

if (!function_exists("getNoImage")) {
    function getNoImage($type = 'coming-soon')
    {
        $ci = &get_instance();
        $cdata = $ci->comman_model->get_data_by_id('country', array('status' => 1, 'short_code' => $ci->lang->default_lang));
        if ($type == 'coming-soon') {
            if (isset($cdata['coming_soon_image']) && $cdata['coming_soon_image'] != '') {
                $comingsoon = global_img_link($cdata['coming_soon_image'], 'uploads/country/coming_soon/');
            } else {
                $comingsoon = base_url() . 'assets/frontend/images/coming_soon.jpg';
            }
            return $comingsoon;
        } else if ($type == 'default-image') {
            if (isset($cdata['default_image']) && $cdata['default_image'] != '') {
                $defaultImage = global_img_link($cdata['default_image'], 'uploads/country/default_image/');
            } else {
                $defaultImage = base_url() . 'assets/frontend/images/no-image-available-icon.png';
            }
            return $defaultImage;
        } else if ($type == 'both') {
            if (isset($cdata['coming_soon_image']) && $cdata['coming_soon_image'] != '') {
                $comingsoon = global_img_link($cdata['coming_soon_image'], 'uploads/country/coming_soon/');
            } else {
                $comingsoon = base_url() . 'assets/frontend/images/coming_soon.jpg';
            }

            if (isset($cdata['no_image']) && $cdata['no_image'] != '') {
                $noimage = global_img_link($cdata['no_image'], 'uploads/country/no_image/');
            } else {
                $noimage = base_url() . 'assets/admin/images/previewimage.jpg';
            }
            return array('comingsoon' => $comingsoon, 'noimage' => $noimage);
        } else {
            if (isset($cdata['no_image']) && $cdata['no_image'] != '') {
                $noimage = global_img_link($cdata['no_image'], 'uploads/country/no_image/');
            } else {
                $noimage = base_url() . 'assets/admin/images/previewimage.jpg';
            }
            return $noimage;
        }
    }
}

if (!function_exists("removeLangContent")) {
    function removeLangContent($table, $id)
    {
        if ($table && $id) {
            $ci = &get_instance();
            $ci->db->delete($table, array('lang_id' => $id));
        }
    }
}

if (!function_exists("removeAllLangContent")) {
    function removeAllLangContent($table)
    {
        if ($table) {
            $ci = &get_instance();
            $ci->db->empty_table($table);
        }
    }
}

if (!function_exists("getContentPosition")) {
    function getContentPosition($shortCode)
    {
        $ci = &get_instance();
        $ci->db->select('position');
        $ci->db->where('short_code', $shortCode);
        $response = $ci->db->get('country')->row_array();
        return $response['position'] ? strtolower($response['position']) : '';
    }
}

if (!function_exists("getTimeDigits")) {

    function getTimeDigits()
    {
        $result = array();
        $ci = &get_instance();
        $ci->load->model(array('comman_model'));
        $result['time_digits'] = allDataArray($ci->comman_model->GetAllDataLangByid('time_digits', 'id', 1, $ci->lang->default_lang_id, 'time_digits_country'));
        return $result;
    }
}

//check language function
if (!function_exists("check_lang_admin")) {

    function check_lang_admin()
    {
        $CI = &get_instance();
        $lang = $CI->session->all_userdata();
        if (isset($lang['lang']) && $lang['lang'] != '' && $lang['lang'] == 'russian') {
            $CI->lang->load("common", "russian");
            $CI->lang->load("admin", "russian");
        } else {
            $CI->lang->load("common", "english");
            $CI->lang->load("admin", "english");
        }
    }
}

//validate admin login
if (!function_exists("validateAdminLogin")) {

    function validateAdminLogin()
    {
        $CI = &get_instance();
        $logged_in = $CI->session->userdata('logged_in');
        if ((isset($logged_in) || $logged_in == true)) {

            $commission_trial = $CI->config->item('commission_trial');
            $commission_term_status = $CI->config->item('commission_term_status');

            if ($logged_in != "admin") {
                redirect('/admin/entry_door', 'refresh');
            }
            if ($commission_trial == "0" && $commission_term_status == "0") {
                redirect('/admin/noaccess', 'refresh');
            }
        } else {
            redirect('/admin/entry_door', 'refresh');
        }
    }
}

//validate admin login
if (!function_exists("validateAdminLoginNo")) {

    function validateAdminLoginNo()
    {
        $CI = &get_instance();
        $logged_in = $CI->session->userdata('logged_in');
        if ((isset($logged_in) || $logged_in == true)) {

            $commission_trial = $CI->config->item('commission_trial');
            $commission_term_expired = $CI->config->item('commission_term_expired');

            if ($logged_in != "admin") {
                redirect('/admin/entry_door', 'refresh');
            }
            if ($commission_trial == "1" || $commission_term_expired == "0") {
                redirect('/admin/index/dashboard', 'refresh');
            }
        } else {
            redirect('/admin/entry_door', 'refresh');
        }
    }
}

//validate page access
if (!function_exists("validatePageAccess")) {

    function validatePageAccess($page)
    {
        $CI = &get_instance();
        $role_id = $CI->session->userdata('role_id');
        $CI->db->select('*');
        $CI->db->from('admin_role_access');
        $CI->db->where('role_id', $role_id);
        $CI->db->where('page', $page);
        $query = $CI->db->get();
        $result = $query->row_array();
        if (!empty($result) && $result['page_access'] == 1) {
            $data = array(
                'page_access' => $result['page_access'],
                'page_add' => $result['page_add'],
                'page_edit' => $result['page_edit'],
                'page_delete' => $result['page_delete'],
            );
            return $data;
        } else {
            redirect('/admin/noaccess', 'refresh');
        }
    }
}

if (!function_exists("validateUser")) {

    function validateUser()
    {
        $CI = &get_instance();
        $sessiondata = $CI->session->userdata('admin_validuser_data');
        $where_param = array();
        $where_param['email'] = $sessiondata['email'];
        $where_param['country_code'] = $sessiondata['country_code'];
        $where_param['telephone'] = $sessiondata['telephone'];
        $result = $CI->comman_model->getAdminValidUserData($where_param);
        $id['id'] = 1;
        $timedata = get_user_lang_data(array('admin_door_timer'), $CI->lang->default_lang_id, 'admin_door_login_timer')['admin_door_timer'];
        $bal_time = time() - $result['created_time'];
        $time_diff = ($timedata['admin_door_login_timer'] * 60) - $bal_time;
        if (empty($result) || $time_diff < 0) {
            if (!empty($result)) {
                $CI->comman_model->deleteAdminValidUserdata($where_param);
            }
            $CI->session->unset_userdata('logged_in');
            $CI->session->unset_userdata('login');
            $CI->session->unset_userdata('id');
            $CI->session->unset_userdata('role_id');
            $CI->session->unset_userdata('first_name');
            $CI->session->unset_userdata('last_name');
            $CI->session->unset_userdata('email');
            $CI->session->unset_userdata('country_code');
            $CI->session->unset_userdata('telephone');
            $CI->session->unset_userdata('page_access');
            $CI->session->unset_userdata('admin_validuser_data');
            $CI->session->sess_destroy();
            redirect('/admin/entry_door', 'refresh');
        } else {
            $result['remaining_time'] = $time_diff;
            $userdata = $CI->comman_model->getUserLoginData($where_param['email'], $where_param['country_code'], $where_param['telephone']);
            $session_data = array(
                'logged_in' => 'admin',
                'login' => true,
                'id' => $userdata['id'],
                'role_id' => $userdata['role_id'],
                'title' => $userdata['title'],
                'first_name' => $userdata['first_name'],
                'last_name' => $userdata['last_name'],
                'email' => $userdata['email'],
                'country_code' => $userdata['country_code'],
                'telephone' => $userdata['telephone'],
                'page_access' => $userdata['page_access'],
                'admin_validuser_data' => $result,
            );
            $CI->session->set_userdata($session_data);
        }
    }
}

if (!function_exists("validateFrontUser")) {
    /**
     * validateFrontUser
     *
     * This Function Validate the current user using email and phone from session. According to condition it redirect user or update session.
     * @return void
     */
    function validateFrontUser()
    {
        $CI = &get_instance();
        // Get email and phone  of current user  from session
        $sessiondata = $CI->session->userdata('front_validuser_data');
        $where_param = array();
        $where_param['email'] = $sessiondata['email'];
        $where_param['country_code'] = $sessiondata['country_code'];
        $where_param['telephone'] = $sessiondata['telephone'];
        // get records related to user using email and password from database table  entry_door_front_shopping_data
        $result = $CI->comman_model->getValidUserData($where_param);
        $id['id'] = 1;
        // get values of login timer from database table  entry_door_timer.
        $timedata = get_user_lang_data(array('entry_door_timer'), $CI->lang->default_lang_id, 'entry_door_shopping_timer')['entry_door_timer'];
        $bal_time = time() - $result['created_time'];
        $time_diff = ($timedata['entry_door_shopping_timer'] * 60) - $bal_time;
        if (empty($result) || $time_diff < 0) {
            if (!empty($result)) {
                // if record exist than delete the records corresponding to email and phone from table entry_door_front_shopping_data
                $CI->comman_model->deleteValidUserdata($where_param);
            }
            redirect('/' . $CI->lang->default_lang . '/front/entry_door', 'refresh');
        } else {
            // if session expire time is still left than this code update the remaining time  in the session
            $result['remaining_time'] = $time_diff;
            $sessiondata = array('front_validuser_data' => $result);
            $CI->session->set_userdata($sessiondata);
        }
    }
}

if (!function_exists("getAdminLogo")) {

    function getAdminLogo()
    {
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->from('home_page');
        $CI->db->where('id', 1);
        $query = $CI->db->get();
        $result = $query->row_array();
        if (isset($result['logo']) && $result['logo'] != '') {
            $logo = global_img_link($result['logo'], 'uploads/logo/thumbnails/');
        } else {
            $logo = base_url('assets/frontend/images/logo.png');
        }
        return $logo;
    }
}

if (!function_exists('array_column')) {
    function array_column(array $input, $columnKey, $indexKey = null)
    {
        $array = array();
        foreach ($input as $value) {
            if (!isset($value[$columnKey])) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            } else {
                if (!isset($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if (!is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
}

if (!function_exists('logged_user_validation')) {
    function logged_user_validation($redirect = true, $on_checkout = true)
    {
        $ci = get_instance();
        $sessiondata = $ci->session->userdata('front_validuser_data');
        $where_param = array();
        $where_param['email'] = isset($sessiondata['email']) ? $sessiondata['email'] : '';
        if (empty(getFrontenduserId())) {
            $where_param['country_code'] = isset($sessiondata['country_code']) ? $sessiondata['country_code'] : '';
            $where_param['telephone'] = isset($sessiondata['telephone']) ? $sessiondata['telephone'] : '';
        }
        $result = $ci->comman_model->getValidUserData($where_param);
        $result['created_time'] = isset($result['created_time']) ? $result['created_time'] : 0;
        $timedata = get_user_lang_data(array('entry_door_timer'), $ci->lang->default_lang_id, 'entry_door_shopping_timer')['entry_door_timer'];
        $bal_time = time() - $result['created_time'];
        $time_diff = ($timedata['entry_door_shopping_timer'] * 60) - $bal_time;
        if ($on_checkout) {
            if (!front_on_checkout_verification() && (empty($result) || $time_diff < 0)) {
                if (!empty($result)) {
                    $ci->comman_model->deleteValidUserdata($where_param);
                }
                if ($redirect) {
                    redirect('/front/entry_door', 'refresh');
                }
                return false;
            } else {
                $result['remaining_time'] = $time_diff;
                $sessiondata = array('front_validuser_data' => $result);
                $ci->session->set_userdata($sessiondata);
                return true;
            }
        } else {
            if ((empty($result) || $time_diff < 0)) {
                if (!empty($result)) {
                    $ci->comman_model->deleteValidUserdata($where_param);
                }
                if ($redirect) {
                    redirect('/front/entry_door', 'refresh');
                }
                return false;
            } else {
                $result['remaining_time'] = $time_diff;
                $sessiondata = array('front_validuser_data' => $result);
                $ci->session->set_userdata($sessiondata);
                return true;
            }
        }
    }
}

if (!function_exists('tunisie_sms')) {
    function tunisie_sms($phone, $message)
    {
        $ci = get_instance();
        $message = urlencode($message);
        $sender = $ci->config->item('tunisiesms_sender');
        $key = $ci->config->item('tunisiesms_key');
        $url = "https://www.tunisiesms.tn/client/Api/Api.aspx?fct=sms&key=$key&mobile=$phone&sms=$message&sender=$sender";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
        curl_exec($curl);
        curl_close($curl);
    }
}

if (!function_exists('american_sms')) {
    function american_sms($phone, $message)
    {
        $ci = get_instance();
        $message = $message;
        class SMSParam
        {
            public $CellNumber;
            public $AccountKey;
            public $MessageBody;
        }
        $sender = getenv('SMS_US_PROVIDER_USERNAME');
        $key = $ci->config->item('tunisiesms_key');
        $client = new SoapClient('http://www.smsgateway.ca/sendsms.asmx?WSDL');
        $parameters = new SMSParam;
        $parameters->CellNumber = $phone;
        $parameters->AccountKey = $sender;
        $parameters->MessageBody = $message;
        $Result = $client->SendMessage($parameters);
    }
}

if (!function_exists('front_on_checkout_verification')) {
    function front_on_checkout_verification($assure_no_default_login = false)
    {
        $ci = &get_instance();
        if ($assure_no_default_login) {
            return !logged_user_validation(false, false) && ((bool) $ci->config->item('entry_door_verification_on_checkout'));
        }
        return (bool) $ci->config->item('entry_door_verification_on_checkout');
    }
}

if (!function_exists('generate_captcha')) {
    function generate_captcha()
    {
        $ci = &get_instance();

        $ci->load->library('session');

        // Captcha configuration
        $config = array(
            'word' => '', //Generate alternate word by default. You can also set your word.
            'word_length' => 10, // To set length of captcha word.
            'img_path' => './assets/uploads/captcha/', // Create  folder "images" in root directory, and give path.
            'img_url' => base_url() . 'assets/uploads/captcha/', // To store captcha images in "images" folder.
            'font_path' => FCPATH . 'system/fonts/texb.ttf',
            'img_width' => 230, //Set image width.
            'img_height' => 50, // Set image height.
        );
        $captcha = create_captcha($config);

        // Unset previous captcha and set new captcha word
        $ci->session->unset_userdata('captchaCode');
        $ci->session->set_userdata('captchaCode', $captcha['word']);

        // Pass captcha image to view
        return $captcha['image'];
    }
}

if (!function_exists('validate_captcha')) {
    function validate_captcha($code = '')
    {
        $output = array('response' => 'success');
        if (ENVIRONMENT == "production") {
            $ci = &get_instance();
            $inputCaptcha = $code ? $code : $ci->input->post('captcha');
            $sessCaptcha = $ci->session->userdata('captchaCode');
            if ($inputCaptcha !== $sessCaptcha) {
                $output = array('response' => 'error', 'error' => 'captcha');
            } else {
                $output = array('response' => 'success');
            }
        }
        return $output;
    }
}

/**
 * validatePhone
 *
 * This Function is used to vaildate the phone number using the third party Api. This is Child function on the send_verification_code.
 *
 * @param  mixed $sms_telephone
 * @return bool
 */
function validatePhone($sms_telephone)
{
    $sms_telephone = "00" . $sms_telephone;
    $url = 'https://api.cm.com/v1.1/numbervalidation/' . $sms_telephone;
    $ch = curl_init();
    curl_setopt_array(
        $ch,
        array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                'X-CM-PRODUCTTOKEN: 899AAD2A-D674-4C9E-BCFD-7BC3AF20C6CB',
                'Accept:application/json',
            ),
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
        )
    );

    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result, true);
// echo "<pre>";
//     print_r($result);

    if (!empty($result) && $result['carrier'] != '' && $result['valid_number'] == 1 && ($result['type']['mobile'] == 1 || $result['type']['fixed_line_or_mobile'] == 1)) {
        return true;
    } else {
        return true;
    }
}

/**
 * sentSmsCode
 *
 * This Function send sms code to the phone number via sms.
 * @param  mixed $sms_randomString
 * @param  mixed $telephone
 * @param  mixed $country_code
 * @return void
 */
function sentSmsCode($sms_randomString, $telephone, $country_code, $custom_msg = 'sms_message_text')
{

    //echo $sms_randomString." phone ".$telephone." code".$country_code."<br>";

    $ci = &get_instance();
    $email_instruction = get_user_lang_data(array('email_instruction'), $ci->lang->default_lang_id)['email_instruction'];
    $message = $email_instruction[$custom_msg];
    $message = str_replace('{sms_randomString}', $sms_randomString, $message);
    if ($country_code == 216) {
        tunisie_sms($telephone, $message);
        return true;
    }

    if ($country_code == 1) {
        american_sms($telephone, $message);
        return true;
    }

    require_once FCPATH . '/vendor/smpp/smppclient.class.php';
    require_once FCPATH . '/vendor/smpp/gsmencoder.class.php';
    require_once FCPATH . '/vendor/smpp/sockettransport.class.php';

    if ($country_code == 1) {
        $api_endpoint = getenv('SMS_US_PROVIDER_URL');
        $api_port = getenv('SMS_US_PROVIDER_PORT');
        $transport = new SocketTransport(array($api_endpoint), $api_port);
    } else {
        $api_endpoint = getenv('SMS_OTHER_PROVIDER_URL');
        $api_port = getenv('SMS_OTHER_PROVIDER_PORT');
        $transport = new SocketTransport(array($api_endpoint), $api_port);
    }

    $transport->setRecvTimeout(getenv('SMS_SEND_TIMEOUT'));
    $transport->setSendTimeout(getenv('SMS_RECEIVE_TIMEOUT'));
    $smpp = new SmppClient($transport);

    // Activate binary hex-output of server interaction
    $smpp->debug = true;
    $transport->debug = true;

    // Open the connection
    $transport->open();
    if ($country_code == 1) {
        $smpp->bindTransmitter(getenv('SMS_US_PROVIDER_USERNAME'), getenv('SMS_US_PROVIDER_PASSWORD'));
    } else {
        $smpp->bindTransmitter(getenv('SMS_OTHER_PROVIDER_USERNAME'), getenv('SMS_OTHER_PROVIDER_PASSWORD'));
    }

    SmppClient::$sms_null_terminate_octetstrings = false;
    if ($country_code == 1) {
        $encodedMessage = GsmEncoder::utf8_to_gsm0338($message);
    } else {
        $telephone = "00" . $telephone;
        $encodedMessage = mb_convert_encoding($message, "UCS2", "UTF-8");
    }
    $from = new SmppAddress('HERO', SMPP::TON_ALPHANUMERIC);
    $to = new SmppAddress($telephone, SMPP::TON_INTERNATIONAL, SMPP::NPI_E164);
    $tags = null;

    // Send
    if ($country_code == 1) {
        $smpp->sendSMS($from, $to, $encodedMessage, $tags);
    } else {
        $smpp->sendSMS($from, $to, $encodedMessage, $tags, SMPP::DATA_CODING_UCS2);
    }

    // Close connection
    $smpp->close();
}

/**
 * sentEmailCode
 *
 * This Function send email otp code to the user email by sending email.
 * @param  mixed $email_randomString
 * @param  mixed $email
 * @param  mixed $telephone
 * @param  mixed $name
 * @param  mixed $attempt
 * @param  mixed $entry_sms_confirm_status
 * @param  mixed $validphone
 * @param  mixed $actionPage
 * @return bool
 */
function sentEmailCode($email_randomString, $email, $telephone, $name, $attempt, $entry_sms_confirm_status, $validphone, $actionPage = 'entry')
{
    $ci = &get_instance();
    $response = triggerZeroBounceValidaorApi($email);
    if ($response == 0) {
        return false;
    } else {
        $ci->load->library('email');
        $config = array(
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'priority' => '1',
        );
        $config = $ci->config->item('emailconfig');
        $ci->email->initialize($config);

        $actionPage = trim($actionPage) ? $actionPage : 'entry';

        $email_instruction = get_user_lang_data(array('email_instruction'), $ci->lang->default_lang_id)['email_instruction'];
        if ($entry_sms_confirm_status == 1 || $validphone != 1) {
            $msg = htmlspecialchars_decode($email_instruction[$actionPage . '_verification_code_mail']);
        } else {
            $msg = htmlspecialchars_decode($email_instruction[$actionPage . '_verification_code_withphone_mail']);
            $msg = str_replace('{telephone}', $telephone, $msg);
        }

        $msg = str_replace('{name}', $name, $msg);
        if ($actionPage == 'cart') {
            $msg = str_replace('{cart_randomString}', $email_randomString, $msg);
        } else {
            $msg = str_replace('{email_randomString}', $email_randomString, $msg);
        }

        if ($attempt == "0") {
            $subject = $email_instruction[$actionPage . '_verification_code_mail_subject'];
        } else {
            $subject = $email_instruction[$actionPage . '_verification_code_withphone_mail_subject'] . ' ' . $email_instruction['attempt_text'] . ' ' . ($attempt);
        }

        $to = $email;
        $cc = '';
        $bcc = '';

        $actionPage = ($actionPage == 'cart') ? 'cart' : 'entry';
        $fromName = $email_instruction[$actionPage . '_verification_code_mail_fromname'];
        $from = $email_instruction['from_mail_id'];

        // check if language is not an english, then will fetch sender name for english becoz send grid not support or not validated other language sender name
        if ($ci->lang->default_lang_id != 13) {
            //  $fromName = get_user_lang_data(array('email_instruction'), 13)['email_instruction'][$actionPage . '_verification_code_mail_fromname'];
        }

        $ci->email->set_newline("\r\n");
        $ci->email->from($from, $fromName);
        $ci->email->to($to);
        $ci->email->set_header("To", $name . '<' . $to . '>');
        $ci->email->subject($subject);
        $ci->email->message($msg);
        $ci->email->send();
        // echo $this->email->print_debugger();

        return true;
    }
}

/**
 * This Function is used to make thumb image of uploaded image in the cart.
 *
 * @param  mixed $path
 * @param  mixed $filename
 * @return void
 */
function do_resize($path, $filename, $width = 140, $height = 90)
{
    $ci = &get_instance();

    $source_path = $path . "/" . $filename;
    $thumb_path = $path . "/thumb";
    // check thumb folder if not exist than make it
    if (!is_dir($thumb_path)) {
        mkdir($thumb_path, 0777, true);
    }
    $target_path = $thumb_path . '/' . $filename;
    if (file_exists($source_path)) {
        //if source file exist than this condition will run
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => true,
            'width' => $width,
            'height' => $height,
        );
        // this function intialize the image library
        $ci->image_lib->initialize($config_manip);
        // this function resize the image.
        if (!$ci->image_lib->resize()) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}

/**
 * This Function is used to make thumb image of uploaded image in the cart.
 *
 * @param  mixed $path
 * @param  mixed $filename
 * @return void
 */
function resize_main($path, $filename, $width = 400, $height = 267)
{
    $ci = &get_instance();

    $source_path = $path . "/" . $filename;
    $thumb_path = $path . "/main";
    // check thumb folder if not exist than make it
    if (!is_dir($thumb_path)) {
        mkdir($thumb_path, 0777, true);
    }
    $target_path = $thumb_path . '/' . $filename;
    if (file_exists($source_path)) {
        //if source file exist than this condition will run
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => true,
            'width' => $width,
            'height' => $height,
        );
        // this function intialize the image library
        $ci->image_lib->initialize($config_manip);
        // this function resize the image.
        if (!$ci->image_lib->resize()) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}

/**
 * Method getCartProductDetails
 * This function add product related data with product
 * @param $cart_details $cart_details [explicite description]
 * @param $isMenu $isMenu [explicite description]
 * @param $cart_product_quantity $cart_product_quantity [explicite description]
 *
 * @return void
 */
function getCartProductDetails($cart_details, $ismodel_items = 0, $cart_product_quantity = array())
{
    $ci = &get_instance();

    $productDetails = array();

    // This Function iterate all products from  the cart session one by one and corresponding to each product it get product attribute from the database and add in to the product array
    if (count($cart_details) > 0) {
        foreach ($cart_details as $product) {
            $product = (array) $product;
            $models = $ci->product_model->product_models_list($product['id'], $ci->lang->default_lang_id);
            $product['product_models'] = $models;
            $product['product_items'] = $ci->product_items_model->product_items($product['id'], $ci->lang->default_lang_id);

            // $product['product_model_items'] = $product_model_items;
            // if ($ismodel_items == "1") {
            //     // If Product maker and models and its attributes required than this code will work
            //     $product_model_items =  $ci->product_items_model->product_maker_with_attributes($product['id'], $ci->lang->default_lang_id, $models);
            //     foreach ($models as $single_models) {
            //         foreach ($product_model_items as $single_item) {
            //             if ($single_models['id'] == $single_item['model_id']) {
            //                 $single_models['items'][] =  $single_item;
            //             }
            //         }

            //         $makers['id'] = $single_models['maker_id'];
            //         $makers['lang_maker_name'] = $single_models['lang_maker_name'];
            //         $makers['maker_name'] = $single_models['maker_name'];
            //         $makers['maker_logo'] = $single_models['maker_logo'];

            //         $makers['models'][] =  $single_models;
            //         $product['makers'][$single_models['maker_id']] = $makers;
            //     }
            // }
            //retain the previous cart quantity
            if (count($cart_product_quantity) > 0) {
                $product['ship_quantity'] = isset($cart_product_quantity[$product['id']]) ? $cart_product_quantity[$product['id']] : $product['ship_quantity'];
            }
            // $productDetails[] = array_merge($product, $productitemr, $productitemmodels);
            $productDetails[] = array_merge($product);
        }
    }
    return $productDetails;
}

function getLastInsertedCartBlockId()
{
    //in cart and product section sometimes this is $last_inserted_cart_block_id getting false as the timer isn't showing. to make that more confirm i did this code.
    $ci = &get_instance();
    $last_inserted_cart_block_id = $ci->session->userdata('last_inserted_cart_block_id');
    if (!$last_inserted_cart_block_id) {
        $cart_user_info = $ci->session->userdata("cart_users_data");
        if (!empty($cart_user_info)) {

            unset($cart_user_info['square_customer_id']);
            unset($cart_user_info['salutation']);
            unset($cart_user_info['surname']);
            unset($cart_user_info['password']);
            unset($cart_user_info['user_status']);
            unset($cart_user_info['access_token']);
            unset($cart_user_info['otp_code']);
            unset($cart_user_info['dateAdded']);
            unset($cart_user_info['dateUpdated']);
            unset($cart_user_info['otp_code_attempt']);
            unset($cart_user_info['ship_country_shortcode']);
            unset($cart_user_info['user_id']);
            unset($cart_user_info['approved_products']);
            unset($cart_user_info['id']);

            if (empty($cart_user_info['incoterms'])) {
                $cart_user_info = array('incoterms' => "EXW");
            }

            $where_param = array();
            $where_param['email'] = $cart_user_info['email'];
            $select_param = array("id");
            $cart_user_id = $ci->comman_model->get_row("cart_block_users", $select_param, $where_param);
            if (!empty($cart_user_id)) {
                $last_inserted_cart_block_id = $cart_user_id[0]->id;
                $update_data = array();
                if (!empty($cart_user_info['user_name'])) {
                    $update_data['user_name'] = $cart_user_info['user_name'];
                }
                if (!empty($cart_user_info['company'])) {
                    $update_data['company'] = $cart_user_info['company'];
                }
                if (!empty($cart_user_info['designation'])) {
                    $update_data['designation'] = $cart_user_info['designation'];
                }
                if (!empty($cart_user_info['address'])) {
                    $update_data['address'] = $cart_user_info['address'];
                }
                if (!empty($cart_user_info['country'])) {
                    $update_data['country'] = $cart_user_info['country'];
                }
                if (!empty($cart_user_info['telephone'])) {
                    $update_data['telephone'] = $cart_user_info['telephone'];
                }
                if (!empty($cart_user_info['email'])) {
                    $update_data['email'] = $cart_user_info['email'];
                }
                if (!empty($cart_user_info['deadline'])) {
                    $update_data['deadline'] = $cart_user_info['deadline'];
                }
                if (!empty($cart_user_info['order_number'])) {
                    $update_data['order_number'] = $cart_user_info['order_number'];
                }
                if (!empty($cart_user_info['incoterms'])) {
                    $update_data['incoterms'] = $cart_user_info['incoterms'];
                }
                $where_param = array();
                $where_param['id'] = $last_inserted_cart_block_id;
                $ci->comman_model->update_column("cart_block_users", $where_param, $update_data);
            } else {
                $last_inserted_cart_block_id = $ci->comman_model->insert_column("cart_block_users", $cart_user_info);
            }
        }
    }
    $cart_user_info = array('incoterms' => 12);
    //$last_inserted_cart_block_id = $ci->comman_model->insert_column("cart_block_users", $cart_user_info);
    return $last_inserted_cart_block_id;
}

/**
 * Method updateLanguageParameters
 *
 *  This Function update language  values of section data.
 * @param $result $result [This is the array of the data.]
 *
 * @return void
 */
function updateLanguageParameters($result)
{

    // this code iterate each  record and update values
    for ($i = 0; $i < count($result); $i++) {
        if (isset($result[$i]) && is_object($result[$i])) {
            $attributes = get_object_vars($result[$i]);
            foreach ($attributes as $name => $value) {
                if ((strpos($name, "lang_") !== false) and (strlen($value) > 0)) {
                    $original_name = substr($name, 5, strlen($name) - 5);
                    $value = isset($result[$i]->$original_name) ? $result[$i]->$original_name : "";
                    $result[$i]->$original_name = $result[$i]->$name;
                    $result[$i]->$name = $value;
                }

                if (isset($result[$i]->lang_product_type_name) and isset($result[$i]->type)) {
                    if (strlen($result[$i]->lang_product_type_name) > 0) {
                        $value = $result[$i]->type;
                        $result[$i]->type = $result[$i]->lang_product_type_name;
                        $result[$i]->lang_product_type_name = $value;
                    }
                }

                if (isset($result[$i]->category_name) and isset($result[$i]->category)) {
                    if (strlen($result[$i]->category_name) > 0) {
                        $value = $result[$i]->category;
                        $result[$i]->category = $result[$i]->category_name;
                        $result[$i]->category_name = $value;
                    }
                }
            }
        } else {
            if (isset($result[$i])) {
                foreach ($result[$i] as $name => $value) {
                    if ((strpos($name, "lang_") !== false) and (strlen($value) > 0)) {
                        $original_name = substr($name, 5, strlen($name) - 5);
                        $value = $result[$i][$original_name];
                        $result[$i][$original_name] = $result[$i][$name];
                        $result[$i][$name] = $value;
                    }
                }
            }
        }
    }
    return $result;
}

/**
 * Method allDataArray
 *
 * @param $obj $obj [explicite description]
 *
 * @return void
 */
function allDataArray($obj)
{
    $array = array();
    if (count($obj) > 0) {
        $attributes = get_object_vars($obj[0]);
        foreach ($attributes as $name => $value) {
            $array[$name] = $value;
        }
    }
    return $array;
}

/**
 * Method allCountryDataArray
 *
 * @param $object $object [explicite description]
 *
 * @return void
 */
function allCountryDataArray($object)
{
    $array = array();
    $result = array();
    foreach ($object as $obj) {
        $attributes = get_object_vars($obj);
        foreach ($attributes as $name => $value) {
            $array[$name] = $value;
        }
        $result[] = $array;
    }
    return $result;
}

/**
 * Method dynamic_array_csv_download
 *
 * @param $array $array [explicite description]
 * @param $filename $filename [explicite description]
 * @param $isHeader $isHeader [explicite description]
 *
 * @return void
 */
function dynamic_array_csv_download($array, $filename, $isHeader = 0)
{
    $ci = &get_instance();

    if ($isHeader == 1) {
        $headerArr = [];
        foreach ($array[0] as $k => $v) {
            array_push($headerArr, $k);
        }
    } else {
        $header_title = $ci->comman_model->language_name_by_country();
        $addObj = array(array("lang_country_id" => "", "language_name" => "Id"));
        $header_title = array_merge($addObj, $header_title);

        $headerArr = [];
        foreach ($header_title as $k => $v) {
            array_push($headerArr, $v['language_name']);
        }
    }

    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    ob_end_clean();
    $handle = fopen('php://output', 'w');
    fputcsv($handle, $headerArr);
    foreach ($array as $value) {
        $arrNew = [];
        foreach ($value as $val) {
            array_push($arrNew, $val);
        }
        fputcsv($handle, $arrNew);
    }
    fclose($handle);
    ob_flush();
    exit();
}

function getRandomFileName($fileName, $code = '')
{
    if ($fileName) {
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        return time() . '_' . $code . '.' . $ext;
    } else {
        return $fileName;
    }
}

/**
 * Method get_admin_lang_data
 * This Function  return all data related to section name from language table.
 * @param $section_name $section_name [This parameter is the  name of the section ofr which you want to retreive data.]
 * @param $country_id $country_id  [This parameter is the country id for language data.]
 * @param $option_name $option_name  [This parameter is the option name.]
 * @return void
 */
function get_admin_lang_data($section_name, $country_id = 13, $option_name = "")
{
    $ci = &get_instance();

    $results = $ci->comman_model->get_section_lang_data($section_name, $country_id, $option_name);

    // this code make response array as per conditions
    $response = array();
    if (count($results) > 0) {
        foreach ($results as $singlerecord) {
            if ($country_id != 13) {
                $front_value = $singlerecord['lang_front_option_value'] ? $singlerecord['lang_front_option_value'] : $singlerecord['front_option_value'];
                $admin_value = $singlerecord['lang_admin_option_value'] ? $singlerecord['lang_admin_option_value'] : $singlerecord['admin_option_value'];
                $singlerecord_value = array("front" => $front_value, "admin" => $admin_value);
            } else {
                $singlerecord_value = array("front" => $singlerecord['front_option_value'], "admin" => $singlerecord['admin_option_value']);
            }
            $response[$singlerecord['section_name']][$singlerecord['option_name']] = $singlerecord_value;
        }
    }

    // this code return response array
    return $response;
}

/**
 * Method get_user_lang_data
 * This Function  return all data related to section name from language table.
 * @param $section_name $section_name [This parameter is the  name of the section ofr which you want to retreive data.]
 * @param $country_id $country_id  [This parameter is the country id for language data.]
 * @param $option_name $option_name  [This parameter is the option name.]
 * @return void
 */
function get_user_lang_data($section_name, $country_id = 13, $option_name = "")
{
    $ci = &get_instance();

    $results = $ci->comman_model->get_section_lang_data($section_name, $country_id, $option_name);
    // this code make response array as per conditions

    $response = array();
    if (count($results) > 0) {
        foreach ($results as $singlerecord) {
            if ($country_id != 13) {
                $singlerecord['front_option_value'] = $singlerecord['lang_front_option_value'] ? $singlerecord['lang_front_option_value'] : $singlerecord['front_option_value'];
            }
            if ($singlerecord['section_name'] && $singlerecord['option_name']) {
                $response[$singlerecord['section_name']][$singlerecord['option_name']] = $singlerecord['front_option_value'];
            }
        }
    }

    // this code return response array
    return $response;
}

/**
 * Method get_page_title
 * This Function  return all data related to section name from language table.
 * @param $page_name $page_name [This parameter is the  name of the page off which you want to retreive data.]
 * @return void
 */
function get_page_title($page_name, $section_name = 'page_title')
{
    $ci = &get_instance();

    $result = $ci->comman_model->get_section_lang_data(array($section_name), $ci->lang->default_lang_id, $page_name);

    // this code return response of the title name
    return (isset($result[0]['lang_front_option_value']) && $result[0]['lang_front_option_value']) ? $result[0]['lang_front_option_value'] : $result[0]['front_option_value'];
}

/**
 * Method replace_empty_string
 * This Function return response of the string after replaced
 * @param $string $string [This parameter is the  name of the string which you want to retreive data.]
 * @param $character $character [This parameter is the name of the character which you want to empty data.]
 * @return void
 */
function replace_empty_string($string, $character = '#')
{
    // this code return response of the string after replaced
    return str_replace($character, '', $string);
}

function getModelListByModelIds($modelIds)
{
    $ci = &get_instance();
    $ci->db->select('m.*, mc.lang_model_name, mk.maker_name, mkc.lang_maker_name');
    $ci->db->where_in('m.id', $modelIds);
    $ci->db->order_by('m.model_name', 'ASC');
    $ci->db->from('tbl_models as m');
    $ci->db->join('tbl_models_country as mc', 'm.id = mc.lang_id AND mc.country_id =' . $ci->lang->default_lang_id, 'LEFT');
    $ci->db->join('tbl_makers as mk', 'm.maker_id = mk.id', 'LEFT');
    $ci->db->join('tbl_makers_country as mkc', 'mk.id = mkc.lang_id AND mkc.country_id =' . $ci->lang->default_lang_id, 'LEFT');
    return $ci->db->get()->result_array();
}

function get_product_distributor($product_id, $zip_code, $state, $country)
{
    $ci = &get_instance();
    if ($ci->config->item('enable_distributor_feature') == "1") {
        $ci->db->select('distributors.name,distributors.url,distributors.logo');
        $ci->db->join('distributors', 'product_distributors.distributor_id = distributors.id');
        $ci->db->where('product_id', $product_id);
        $ci->db->where('distributors.zip_code', $zip_code);
        $ci->db->where('distributors.state', $state);
        $ci->db->where('distributors.country', $country);
        $query = $ci->db->get('product_distributors');
        $data = $query->result_array();
    } else {
        $data = array();
    }
    return $data;
}

/**
 * Method get_page_title
 * This Function  return all data related to section name from language table.
 * @param $page_name $page_name [This parameter is the  name of the page off which you want to retreive data.]
 * @return void
 */
function getState_Name($country, $shortcode)
{
    $ci = &get_instance();
    $result = $ci->cart_model->getState_Name($country, $ci->lang->default_lang_id, $shortcode);
    if (isset($result['lang_name'])) {
        return $result['lang_name'];
    } else {
        return $result['name'];
    }
}

function get_volume_unit()
{
    $ci = &get_instance();
    $volume_unit = $ci->config->item('volume_unit');
    $general_instruction = (object) get_user_lang_data(array('general_instruction'), $ci->lang->default_lang_id)['general_instruction'];
    $array_vol = array("INCH" => $general_instruction->inch_text, "CM" => $general_instruction->cm_text);
    return $array_vol[$volume_unit];
}

function get_weight_unit()
{
    $ci = &get_instance();
    $weight_unit = $ci->config->item('weight_unit');

    $general_instruction = (object) get_user_lang_data(array('general_instruction'), $ci->lang->default_lang_id)['general_instruction'];
    $array_unit = array("KG" => $general_instruction->kgs_text, "LB" => $general_instruction->lbs_text);

    // this code return response of the title name
    return $array_unit[$weight_unit];
}

function get_unit_of_meas()
{

    $volume_unit = get_volume_unit();
    $weight_unit = get_weight_unit();

    $unit_of_meas = $volume_unit . "/" . $weight_unit;

    return $unit_of_meas;
}

function cart_unit_of_meas($weight_unit, $volume_unit)
{

    $unit_of_meas = "";
    if (!empty($volume_unit) && !empty($volume_unit)) {
        $ci = &get_instance();
        $general_instruction = (object) get_user_lang_data(array('general_instruction'), $ci->lang->default_lang_id)['general_instruction'];

        $array_unit = array("KG" => $general_instruction->kgs_text, "LB" => $general_instruction->lbs_text);
        $array_vol = array("INCH" => $general_instruction->inch_text, "CM" => $general_instruction->cm_text);
        $unit_of_meas = $array_vol[$volume_unit] . "/" . $array_unit[$weight_unit];
    }
    return $unit_of_meas;
}

/**
 * Method get_longitude_latitude_from_adress
 * This Function get latitude and longitude.
 * @param $address $address [This Parameter is the store address. ]
 *
 * @return void
 */

function get_longitude_latitude_from_adress($address)
{

    $lat = 0;
    $long = 0;
    $address = str_replace(',,', ',', $address);
    $address = str_replace(', ,', ',', $address);
    $address = str_replace(" ", "+", $address);
    // Api access is on developer@kondarsoft.com
    try {
        $json = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $address . '&key=AIzaSyDj7mwa2LMsugKbx_qOSxaH3CJytR88LTo');
        $json1 = json_decode($json);

        if ($json1->{'status'} == 'ZERO_RESULTS') {
            return [
                'lat' => 0,
                'lng' => 0,
            ];
        }

        if (isset($json1->results)) {

            $lat = ($json1->{'results'}[0]->{'geometry'}->{'location'}->{'lat'});
            $long = ($json1->{'results'}[0]->{'geometry'}->{'location'}->{'lng'});
        }
    } catch (exception $e) {
    }
    return [
        'lat' => $lat,
        'lng' => $long,
    ];
}

function getlocation($address)
{

    $array = get_longitude_latitude_from_adress($address);
    $latlong['lat'] = round($array['lat'], 6);
    $latlong['long'] = round($array['lng'], 6);
    return $latlong;
}

if (!function_exists("getOrderStatus")) {

    function getOrderStatus($key)
    {
        $ci = &get_instance();
        $admin_static_links = (object) get_user_lang_data(array('admin_static_links'), $ci->lang->default_lang_id)['admin_static_links'];
        $status = array("0" => $admin_static_links->pending_payment, "1" => $admin_static_links->pending_received, "2" => $admin_static_links->order_delivered);
        return $status[$key];
    }
}

if (!function_exists("getpaymenttype")) {

    function getpaymenttype($key)
    {
        $ci = &get_instance();

        $admin_static_links = (object) get_user_lang_data(array('admin_static_links'), $ci->lang->default_lang_id)['admin_static_links'];
        $status = array("2" => $admin_static_links->payment_full, "1" => $admin_static_links->payment_partial);
        return $status[$key];
    }
}

if (!function_exists("getpaymentmethod")) {

    function getpaymentmethod($key)
    {
        $ci = &get_instance();

        $admin_static_links = (object) get_user_lang_data(array('admin_static_links'), $ci->lang->default_lang_id)['admin_static_links'];
        $status = array("1" => $admin_static_links->payment_card, "2" => $admin_static_links->payment_credit_term, "3" => $admin_static_links->payment_payment_proof,"4"=>$admin_static_links->paypal_express);
        return $status[$key];
    }
}

if (!function_exists("getpaymentstatus")) {

    function getpaymentstatus($key)
    {
        $ci = &get_instance();
        $admin_static_links = (object) get_user_lang_data(array('admin_static_links'), $ci->lang->default_lang_id)['admin_static_links'];
        $status = array("0" => $admin_static_links->pending_payment, "2" => $admin_static_links->payment_credit_term_pending, "1" => $admin_static_links->pending_received);
        return $status[$key];
    }
}

function get_payment_type()
{
    $ci = &get_instance();
    if ($ci->config->item('partial_payment_enable') == "1") {
        $payment_type = ($ci->session->userdata('payment_type')) ? $ci->session->userdata('payment_type') : "1";
    } else {
        $payment_type = "2";

    }
    // this code return response of the title name
    return $payment_type;
}

if (!function_exists("getpushedstatus")) {

    function getpushedstatus($key)
    {
        $ci = &get_instance();
        $admin_static_links = (object) get_user_lang_data(array('admin_static_links'), $ci->lang->default_lang_id)['admin_static_links'];
        $status = array("0" => $admin_static_links->pushed_pending, "1" => $admin_static_links->pushed_completed);
        return $status[$key];
    }
}


if (!function_exists("getpaymentrequeststatus")) {

    function getpaymentrequeststatus($key)
    {
        $ci = &get_instance();
        $admin_static_links = (object) get_user_lang_data(array('admin_static_links'), $ci->lang->default_lang_id)['admin_static_links'];
        $status = array("0" => $admin_static_links->pending_request, "2" => $admin_static_links->decline_request, "1" => $admin_static_links->approved_request,"3" => $admin_static_links->expired_request);
        return $status[$key];
    }
}


if (!function_exists("getnametitle")) {

    function getnametitle($key)
    {
        $ci = &get_instance();
        $cart_instruction = (object) get_user_lang_data(array('cart_instruction'), $ci->lang->default_lang_id)['cart_instruction'];
        $status = array("Mr." => $cart_instruction->mr_title, "Miss." => $cart_instruction->ms_title, "Other" => $cart_instruction->other_title);
        return $status[$key];
    }
}


if (!function_exists("getFreightName")) {

    function getFreightName($key)
    {
        $ci = &get_instance();
        $cart_instruction = (object) get_user_lang_data(array('cart_instruction'), $ci->lang->default_lang_id)['cart_instruction'];
        $status = array("COL" => $cart_instruction->COL, "CHG" => $cart_instruction->CHG, "Other" => $cart_instruction->other_title);
        return $status[$key];
    }
}
