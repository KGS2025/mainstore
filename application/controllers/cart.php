<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Cart Controller
 *
 *
 * Cart Class handle all methods  related to cart  like invoice, cart product list, add and remove product in cart, payment, invoice and send invoice to user and admin. This is   core file of the application.
 *
 * @author      Kondarsoft Dev Team
 * @link        https://kondarsoft.com/
 * @filesource
 */
class Cart extends MY_Controller
{

    /**
     * __construct
     *
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model(array('comman_model', 'cart_model', 'product_items_model', 'api_model', 'product_model', 'part_relation_model'));
        $this->load->helper(array('assets', 'cart_helper', 'file', 'api_helper'));
        $this->load->library('customlog');

    }

    /**
     * index
     *
     * This Function Display the cart page with two forms   (shipping and Billing) and list of products added by user in the cart. This function read data from session and database and passed to the views of carts page.
     * @return void
     */
    public function index()
    {
        if (!front_on_checkout_verification()) {
            // This Function Validate the current user using email and phone from session
            validateFrontUser();
        }

        // remove session variable related to clictopay payment gateway
        $this->session->unset_userdata('ctp_orderid');
        $this->session->unset_userdata('click_pay_message');
        $this->session->unset_userdata('click_pay_error');
        $this->session->unset_userdata('payment_api_error');

        $loginuserterm = loginuserterm();
        $cart = $this->session->userdata('cart');
        $cart = cartCleanUp($cart);
        
        foreach ($cart as $k=>$v){
            $cart[$k]['store_data'] = $this->comman_model->get_store_wise_quantity($k);
        }

        // print_r($cart);die();    
        $this->session->set_userdata('cart', $cart);
        $this->session->set_userdata('new_cart', $cart);
        
        // This Function return cart items  in multilangual format
        $cart_details = updateLanguageParameters($this->product_model->get_cart_items($cart, $this->lang->default_lang_id));
        // echo "<pre>";
        // print_r($cart_details);
        // exit;
        // this function set box type for the packagin api
        $this->set_box_type($cart_details);

        $cart_details = getCartProductDetails($cart_details);

        $cart_details = json_decode(json_encode($cart_details));

        // Get cart user form data

        $cart_users_data = $this->session->userdata('cart_users_data');

        $user_id = getFrontenduserId();
        $loginuserdata = loginuserdata();

        // This Function get records from block_email_list table and pass to the view files
        $sel_param = "*";
        $whr_param['str_email'] = isset($cart_users_data['email']) ? $cart_users_data['email'] : "";
        $whr_param['str_country_code'] = isset($cart_users_data['country_code']) ? $cart_users_data['country_code'] : "";
        $whr_param['str_telephone'] = isset($cart_users_data['telephone']) ? $cart_users_data['telephone'] : "";
        $block_data = $this->comman_model->get_row("block_email_list", $sel_param, $whr_param);

        //Get Last insted block id from session
        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
        if ($last_inserted_cart_block_id) {
            $current_cart_user_data = $this->comman_model->get_data_by_id('cart_block_users', array('id' => $last_inserted_cart_block_id));
        }

        // print_r($this->session->all_userdata());die;

        $all_data = allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country'));
        $all_navigation_data = $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country');

        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'product_instruction', 'cart_timer'), $this->lang->default_lang_id);
        $edit_cart_mode = $this->session->userdata('edit_cart_mode');
        // echo $edit_cart_mode;die();
        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('cart_page'),
            'pageType' => 'cart', // variable for the scripts and css on header and footer
            'lang_id' => $this->lang->default_lang,
            'user_id' => $user_id,
            'lang_num' => $this->lang->default_lang_id,
            'timestamp' => date_timestamp_get(date_create()),
            'session_data' => $this->session->all_userdata(), // This Function return all session data of current user
            'front_validuser_data' => $this->session->userdata('front_validuser_data'),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)), // This Function return list of countries for language dropdown on the header
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)), // This Function get list of countries for shiiping and billing form
            'all_data' => $all_data,
            'all_navigation_data' => $all_navigation_data,
            'product_items' => $this->product_items_model->getproductitems_data(),
            'product_model_items' => $this->product_items_model->getproductitems_data("product_model"),
            'cart_details' => $cart_details,
            'cart_data' => $cart, // This Variable pass cart data from session to the view
            'cart_users_data' => $cart_users_data, // this function passed shipping and billing  forms values to the view files from session.
            'cart_email_confirm' => isset($block_data[0]->cart_email_confirm) ? $block_data[0]->cart_email_confirm : "",
            'cart_sms_confirm' => isset($block_data[0]->cart_sms_confirm) ? $block_data[0]->cart_sms_confirm : "",
            'cartcount' => getcartcount($cart),
            'last_inserted_cart_block_id' => $last_inserted_cart_block_id,
            'current_cart_user_data' => isset($current_cart_user_data) ? $current_cart_user_data : array(),
            'edit_cart_mode' => isset($current_cart_user_data['cartmode']) ? $current_cart_user_data['cartmode'] : $edit_cart_mode,
            'general_instruction' => (object) $userLangData['general_instruction'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'product_instruction' => (object) $userLangData['product_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'cart_timer' => (object) $userLangData['cart_timer'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'freight' => $this->cart_model->getAllSalesOrderSectionDataBySectionBlock('freight', $this->lang->default_lang_id),
            'billing_info_check' => $all_data['shipping_section_status'],
            'searchItemValue' => '',
            'loginuserterm' => $loginuserterm,
            'ip_data' => getUserIpData(),

        );
        

        $footerData = array(
            'all_data' => $all_data,
            'all_navigation_data' => $all_navigation_data,
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
        );
        
        //echo '<pre>';print_r($this->session);exit;
        // view files required to generate cart page of the estore.
        $this->load->view('common/header', $pageData);        
        $this->load->view('cart/cart', $pageData);
        $this->load->view('common/footer', $footerData);
    }

    /**
     * cartValidation
     *
     * This Function set validation rule for the cart form this is child function of the  save_cart_data function.
     * @return void
     */
    public function cartValidation()
    {
        $shippingMethod = (int) $this->security->xss_clean($this->input->post('billingShippingoptradio'));

        $this->form_validation->set_rules('salutation', 'Salutation', 'trim|required|xss_clean');
        $this->form_validation->set_rules('surname', 'surname', 'trim|required|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|numeric|min_length[8]|max_length[15]|xss_clean');
        // Condition according to shipping method
        if ($shippingMethod == 0) {
            $this->form_validation->set_rules('ship_title', 'ship_title', 'trim|required||xss_clean');
            $this->form_validation->set_rules('ship_surname', 'ship_surname', 'trim|required|min_length[3]|max_length[30]|xss_clean');
            $this->form_validation->set_rules('ship_email', 'ship_email', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('ship_telephone', 'ship_telephone', 'trim|required|numeric|min_length[8]|max_length[15]|xss_clean');
        }
    }

    /**
     * save_cart_data
     *
     * This is action Function of the cart form which submit billing, shiiping and cart items and recdirect to next page according to button click.
     * @return void
     */
    public function save_cart_data()
    {
        $check_frieght_cart = $this->session->userdata('new_cart');
        // These are 6 patterns for matching the input values so that there should be not any script or hacking code should be there in input values.
        $pattern = '/[\'^£$%&*()}{@#~?><>:,|=_+¬]/';
        $pattern1 = '/[\'^£$%&*()}{@#~?><>:.,|=_¬-]/';
        $pattern2 = '/[\'^£$%&*()}{@#~?><>:,|=_¬-]/';
        $pattern3 = '/[\'^£$%&*()}{#~?><>:,|=_¬-]/';
        $pattern4 = '/[\'^£$%&*()}{@~?><>:|=_¬]/';
        $pattern5 = '/[\'^£$%&*()}{@#~?><>:,|=¬]/';
        $pattern6 = '/[\'^£$%&*()}{@#~?><>:.,|=+¬-]/';

        // Read all inputs and sanitize their values and saved in a seprate variable
        $csrf = $this->security->xss_clean($this->input->post('Csrf-Token'));
        $company = $this->security->xss_clean($this->input->post('company'));
        $salutation = $this->security->xss_clean($this->input->post('salutation'));
        $email = $this->security->xss_clean($this->input->post('email'));
        $country_code = $this->security->xss_clean($this->input->post('country_code'));
        $cart_address_3 = $this->security->xss_clean($this->input->post('cart_address_3'));
        $cart_zip = $this->security->xss_clean($this->input->post('cart_zip'));
        $po_number = $this->security->xss_clean($this->input->post('po_number'));
        $po_file = $this->security->xss_clean($this->input->post('po_file'));
        $client_logo = $this->security->xss_clean($this->input->post('client_logo'));
        $block_timezone = $this->security->xss_clean($this->input->post('block_timezone'));
        $ship_zip = $this->security->xss_clean($this->input->post('ship_zip'));
        $ship_city = $this->security->xss_clean($this->input->post('ship_city'));
        $cart_block_timer = str_replace("/", '$', $this->security->xss_clean($this->input->post('cart_block_timer')));
        $surname = $this->security->xss_clean($this->input->post('surname'));
        $shipping_special_notes = $this->security->xss_clean($this->input->post('shipping_special_notes'));
        
        $cart_fresh_data = $this->session->userdata('cart');
        foreach($cart_fresh_data as $k=>$v){
            $cart_fresh_data[$k]['store_id'] = $shipping_special_notes[$k];
        }
        $this->session->set_userdata('cart',$cart_fresh_data);
               

        // Match input values with pattern and if its matched than shows this error to front end user.
        if (preg_match($pattern, $csrf) || preg_match($pattern, $company) || preg_match($pattern2, $salutation) || preg_match($pattern3, $email) || preg_match($pattern1, $country_code) || preg_match($pattern4, $cart_address_3) || preg_match($pattern, $cart_zip) || preg_match($pattern5, $client_logo) || preg_match($pattern6, $block_timezone) || preg_match($pattern, $ship_zip) || preg_match($pattern, $ship_city) || preg_match($pattern, $cart_block_timer) || preg_match($pattern, $surname)) {
            show_error('Request was invalid. Input value not proper. Try Again! <p><a href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Go back</a></p>', 400);
            exit;
        }
        // This Function get list of  all forms validation messages from table form_validation_instruction. All these messages are manageable form the admin side.
        $form_validation_instruction = (object) get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];

        // This Function set validation rule for the cart form.
        $this->cartValidation();

        // Shows this error to customer if not filled all the mandatory fields with proper datatype
        if ($this->form_validation->run() == false) {
            $error_lang = isset($form_validation_instruction->popup_title) ? $form_validation_instruction->popup_title : 'Please complete the mandatory fields befores proceeding.';
            $messsge = array('message' => $error_lang, 'type' => 'error');
            $this->session->set_flashdata('flash_message', $messsge);
            redirect('cart');
        }

        if ($this->input->post('coupon_code') != "") {

            if (iscoupon_valid($this->input->post('coupon_code'))) {
                $coupon_data = $this->comman_model->get_coupon_data($this->input->post('coupon_code'));
                $session_data = array('coupon_applied' => "1", "coupon_data" => $coupon_data);
                $this->session->set_userdata($session_data);
            } else {

                $this->session->unset_userdata('coupon_applied');
                $this->session->unset_userdata('coupon_data');
            }
        } else {

            $this->session->unset_userdata('coupon_applied');
            $this->session->unset_userdata('coupon_data');
        }

        // Read  inputs and sanitize their values and saved in a seprate variable
        $user_name = $this->security->xss_clean($this->input->post('salutation')) . ' ' . $this->security->xss_clean($this->input->post('surname'));
        $country_code = str_replace('+', '', $this->security->xss_clean($this->input->post('country_code')));
        $ship_country_code = str_replace('+', '', $this->security->xss_clean($this->input->post('ship_country_code')));
        $telephone = ltrim($this->security->xss_clean($this->input->post('telephone')), '0');
        $ship_telephone = ltrim($this->security->xss_clean($this->input->post('ship_telephone')), '0');

        $client_logo = '';
        // This Code runs only  when user choose the client logo on the cart form.
        if (isset($_FILES['client_logo']) && !empty($_FILES['client_logo']['name'])) {
            // These are configuration variables  for  client logo file
            $config['upload_path'] = './assets/uploads/cart/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['max_width'] = '100000';
            $config['max_height'] = '10000';
            $config['file_name'] = getRandomFileName($_FILES['client_logo']['name'], 'client_logo');

            // This function initialize the upload library
            $this->load->library('upload', $config);
            // This function initialize the image library
            $this->load->library('image_lib');
            if (!$this->upload->do_upload('client_logo')) {
                $error_lang = isset($form_validation_instruction->client_logo) ? $form_validation_instruction->client_logo : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';
                $message = array('message' => $error_lang, 'type' => 'error');
                // This function save error message in the flash variable to display on cart page
                $this->session->set_flashdata('flash_message', $message);
                redirect('cart');
            } else {
                $upload_data = $this->upload->data();
                $client_logo = $upload_data['file_name'];

                /***************** This Function Resize image and make thumb file for the image *****************/
                do_resize($config['upload_path'], $client_logo);
            }
        }

        $po_file = '';
        // This Code runs only  when user choose the client logo on the cart form.
        if (isset($_FILES['po_file']) && !empty($_FILES['po_file']['name'])) {

            // These are configuration variables  for  client logo file
            $config2['upload_path'] = './assets/uploads/cart/';
            $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config2['max_size'] = '2048';
            $config2['file_name'] = getRandomFileName($_FILES['po_file']['name'], 'po_file');

            // This function initialize the upload library
            $this->load->library('upload', $config2);
            // This function initialize the image library
            $this->load->library('image_lib');
            if (!$this->upload->do_upload('po_file')) {
                $mesa_upld = $this->upload->display_errors();
                $error_lang = isset($form_validation_instruction->po_file) ? $form_validation_instruction->po_file : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';
                $message = array('message' => $mesa_upld, 'type' => 'error');
                // This function save error message in the flash variable to display on cart page
                $this->session->set_flashdata('flash_message', $message);
                redirect('cart');
            } else {
                $upload_data = $this->upload->data();
                $po_file = $upload_data['file_name'];
            }
        }

        $tax_exoneration_file = '';
        // This Code runs only  when user choose the tax exoneration file on the cart form.
        if (isset($_FILES['tax_exoneration_file']) && !empty($_FILES['tax_exoneration_file']['name'])) {
            // These are configuration variables  for  tax exoneration file
            $config3['upload_path'] = './assets/uploads/cart/';
            $config3['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config3['max_size'] = '2048';
            $config3['file_name'] = getRandomFileName($_FILES['tax_exoneration_file']['name'], 'tax_exoneration_file');

            // This function initialize the upload library
            $this->load->library('upload', $config3);
            $this->upload->initialize($config3);
            if (!$this->upload->do_upload('tax_exoneration_file')) {
                $error_lang = isset($form_validation_instruction->client_logo) ? $form_validation_instruction->client_logo : 'File should be Max 2 MB and either: jpg, png, jpeg, gif or pdf';
                $message = array('message' => $error_lang, 'type' => 'error');
                // This function save error message in the flash variable to display on cart page
                $this->session->set_flashdata('flash_message', $message);
                redirect('cart');
                exit;
            } else {
                $upload_data = $this->upload->data();
                // save upload file name in variable to update in the database
                $tax_exoneration_file = $upload_data['file_name'];
            }
        }

        // get users data from session variable
        $old_cart_users_data = $this->session->userdata('cart_users_data');

        // set client logo variable according to the condition to update in the database
        if ($client_logo == '' && isset($old_cart_users_data['client_logo']) && $old_cart_users_data['client_logo'] != '') {
            $client_logo = $old_cart_users_data['client_logo'];
            if ($this->input->post('client_logo_exist') == 0) {
                $client_logo = '';
            }
        }

        // set client logo variable according to the condition to update in the database
        if ($po_file == '' && isset($old_cart_users_data['po_file']) && $old_cart_users_data['po_file'] != '') {
            $po_file = $old_cart_users_data['po_file'];
            if ($this->input->post('po_file_exist') == 0) {
                $po_file = '';
            }
        }

        // set tax exoneration file  variable according to the condition to update in the database
        if ($tax_exoneration_file == '' && isset($old_cart_users_data['tax_exoneration_file']) && $old_cart_users_data['tax_exoneration_file'] != '') {
            $tax_exoneration_file = $old_cart_users_data['tax_exoneration_file'];
            if ($this->input->post('tax_file_exist') == 0) {
                $tax_exoneration_file = '';
            }
        }

        // get shipping currency,rate and method  from the shipping rate
        $upsrate = $this->security->xss_clean($this->input->post('shipping_rate'));
        $upsrate = $upsrate ? explode(' ', $upsrate, 3) : '';
        if ($upsrate) {
            //$shipping_currency = $upsrate[0];
            $shipping_currency = getDefaultCurrencyCode();
            $shipping_rate = $upsrate[1];
            $method_of_transportation = $upsrate[2];
        } else {
            $shipping_currency = $shipping_rate = $method_of_transportation = '';
        }

        // get shipping currency,rate and method  from the shipping rate freight
        $upsrate_freight = $this->security->xss_clean($this->input->post('shipping_rate_freight'));
        $upsrate_freight = $upsrate_freight ? explode(' ', $upsrate_freight, 3) : '';

        if ($upsrate_freight) {
            //$shipping_currency = $upsrate[0];
            $shipping_currency = getDefaultCurrencyCode();
            $shipping_rate_freight = $upsrate_freight[1];
            $method_of_transportation_freight = " " . $upsrate_freight[2];
        } else {

            $shipping_currency = $shipping_rate_freight = $method_of_transportation_freight = '';

        }

        $user_id = getFrontenduserId();
        $loginuserdata = loginuserdata();

        if ($user_id) {
            $country_cart = $loginuserdata['country'];
            $customer_num = $loginuserdata['customer_no'];
        } else {

            $country_cart = $this->input->post('country');
            if ($country_code == '1') {
                $customer_num = "0009993";
            } else {
                $customer_num = "0009992";
            }
        }

        // update cart forms data in the session according to conditions.
        $shippingMethod = (int) $this->security->xss_clean($this->input->post('billingShippingoptradio'));
        if ($shippingMethod == 1) {
            // if billing information is same as per shipping details than this code works
            $cart_users_data = array(
                'billing_shipping_selection' => $this->input->post('billingShippingoptradio'),
                'user_name' => $user_name,
                'customer_no' => $customer_num,
                'company' => $this->input->post('company'),
                'country_shortcode' => $this->input->post('cart_country_flag'),
                'country' => $country_cart,
                'country_code' => trim($country_code),
                'telephone' => trim($telephone),
                'email' => $this->input->post('email'),
                'order_number' => $this->input->post('order_number'),
                'incoterms' => $this->input->post('incoterms'),
                'ship_with_freight' => $this->input->post('ship_with_freight'),
                'cart_address_1' => $this->input->post('cart_address_1'),
                'cart_address_2' => $this->input->post('cart_address_2'),
                'cart_address_3' => $this->input->post('cart_address_3'),
                'cart_city' => $this->input->post('cart_city'),
                'cart_state' => $this->input->post('cart_state'),
                'cart_zip' => $this->input->post('cart_zip'),
                'edi_one' => $this->input->post('edi_one'),
                'edi_two' => $this->input->post('edi_two'),
                'po_number' => $this->input->post('po_number'),
                'freight_display' => $this->input->post('freight_display'),
                'freight' => $this->input->post('freight'),
                'carrier_name' => $this->input->post('carrier_name'),
                'ship_title' => $this->input->post('salutation'),
                'ship_surname' => $this->input->post('surname'),
                'ship_company' => $this->input->post('company'),
                'ship_email' => $this->input->post('email'),
                'ship_country_shortcode' => $this->input->post('cart_country_flag'),
                'ship_country' => $country_cart,
                'ship_country_code' => trim($country_code),
                'ship_telephone' => trim($telephone),
                'ship_address_1' => $this->input->post('cart_address_1'),
                'ship_address_2' => $this->input->post('cart_address_2'),
                'ship_address_3' => $this->input->post('cart_address_3'),
                'ship_city' => $this->input->post('cart_city'),
                'ship_state' => $this->input->post('cart_state'),
                'ship_zip' => $this->input->post('cart_zip'),
                'client_logo' => $client_logo,
                'po_file' => $po_file,
                'irs_fid_number' => $this->input->post('irs_fid_number'),
                'shipping_currency' => $shipping_currency,
                'shipping_rate' => $shipping_rate,
                'carrier_account_number' => $this->input->post('carrier_account_number'),
                'method_of_transportation' => $method_of_transportation,
                'service_code' => $this->input->post('service_code'),
                'shipping_rate_freight' => $shipping_rate_freight,
                'method_of_transportation_freight' => $method_of_transportation_freight,
                'service_code_freight' => $this->input->post('service_code_freight'),
                'freight_service_type' => $this->input->post('freight_service_type'),
                'tax_exoneration' => $this->input->post('tax_exoneration'),
                'tax_exoneration_number' => $this->input->post('tax_exoneration_number'),
                'tax_exoneration_file' => $tax_exoneration_file,
                'transit_days' => $this->input->post('transit_days'),
                'delivery_by_time' => $this->input->post('delivery_by_time'),
            );
            $cart_users_data = $this->security->xss_clean($cart_users_data);
        } else {

            // if billing information and shipping information is different than this code works
            $cart_users_data = array(
                'billing_shipping_selection' => $this->input->post('billingShippingoptradio'),
                'user_name' => $user_name,
                'customer_no' => $customer_num,
                'company' => $this->input->post('company'),
                'country_shortcode' => $this->input->post('cart_country_flag'),
                'country' => $country_cart,
                'country_code' => trim($country_code),
                'telephone' => trim($telephone),
                'email' => $this->input->post('email'),
                'order_number' => $this->input->post('order_number'),
                'incoterms' => $this->input->post('incoterms'),
                'ship_with_freight' => $this->input->post('ship_with_freight'),
                'cart_address_1' => $this->input->post('cart_address_1'),
                'cart_address_2' => $this->input->post('cart_address_2'),
                'cart_address_3' => $this->input->post('cart_address_3'),
                'cart_city' => $this->input->post('cart_city'),
                'cart_state' => $this->input->post('cart_state'),
                'cart_zip' => $this->input->post('cart_zip'),
                'edi_one' => $this->input->post('edi_one'),
                'edi_two' => $this->input->post('edi_two'),
                'po_number' => $this->input->post('po_number'),
                'freight_display' => $this->input->post('freight_display'),
                'freight' => $this->input->post('freight'),
                'carrier_name' => $this->input->post('carrier_name'),
                'ship_title' => $this->input->post('ship_title'),
                'ship_surname' => $this->input->post('ship_surname'),
                'ship_company' => $this->input->post('ship_company'),
                'ship_email' => $this->input->post('ship_email'),
                'ship_country_shortcode' => $this->input->post('ship_country_flag'),
                'ship_country' => $this->input->post('ship_country'),
                'ship_country_code' => trim($ship_country_code),
                'ship_telephone' => trim($ship_telephone),
                'ship_address_1' => $this->input->post('ship_address_1'),
                'ship_address_2' => $this->input->post('ship_address_2'),
                'ship_address_3' => $this->input->post('ship_address_3'),
                'ship_city' => $this->input->post('ship_city'),
                'ship_state' => $this->input->post('ship_state'),
                'ship_zip' => $this->input->post('ship_zip'),
                'client_logo' => $client_logo,
                'po_file' => $po_file,
                'irs_fid_number' => $this->input->post('irs_fid_number'),
                'shipping_currency' => $shipping_currency,
                'shipping_rate' => $shipping_rate,
                'carrier_account_number' => $this->input->post('carrier_account_number'),
                'method_of_transportation' => $method_of_transportation,
                'service_code' => $this->input->post('service_code'),
                'shipping_rate_freight' => $shipping_rate_freight,
                'method_of_transportation_freight' => $method_of_transportation_freight,
                'service_code_freight' => $this->input->post('service_code_freight'),
                'tax_exoneration' => $this->input->post('tax_exoneration'),
                'tax_exoneration_number' => $this->input->post('tax_exoneration_number'),
                'tax_exoneration_file' => $tax_exoneration_file,
                'transit_days' => $this->input->post('transit_days'),
                'delivery_by_time' => $this->input->post('delivery_by_time'),
            );
            $cart_users_data = $this->security->xss_clean($cart_users_data);
        }

        $user_id = getFrontenduserId();
        $loginuserdata = loginuserdata();
        if ($user_id) {

            $user_update_data = $cart_users_data;
            unset($user_update_data['customer_no']);
            unset($user_update_data['user_name']);
            unset($user_update_data['country_shortcode']);
            unset($user_update_data['order_number']);
            unset($user_update_data['freight_display']);
            unset($user_update_data['po_number']);
            unset($user_update_data['po_file']);
            unset($user_update_data['freight']);
            unset($user_update_data['irs_fid_number']);
            unset($user_update_data['shipping_currency']);
            unset($user_update_data['method_of_transportation']);
            unset($user_update_data['service_code']);
            unset($user_update_data['transit_days']);
            unset($user_update_data['delivery_by_time']);
            unset($user_update_data['shipping_rate']);
            unset($user_update_data['edi_two']);
            unset($user_update_data['shipping_rate_freight']);
            unset($user_update_data['service_code_freight']);
            unset($user_update_data['method_of_transportation_freight']);
            unset($user_update_data['freight_service_type']);
            unset($user_update_data['ship_with_freight']);

            $this->db->where('id', $user_id);
            $this->db->update('users', $user_update_data);
        }
        //check delivery is free or not
        $free_delivery = 0;

        if ($this->input->post('free_delivery') == 1) {
            $cart_users_data['incoterms'] = 'PPD';
            $cart_users_data['freight_display'] = 'COL (COL)';
            $cart_users_data['freight'] = 'COL';
            $cart_users_data['carrier_name'] = '';
            $cart_users_data['carrier_account_number'] = 'NA';
            $cart_users_data['shipping_currency'] = '';
            $cart_users_data['shipping_rate'] = '';
            $cart_users_data['method_of_transportation'] = '';
            $cart_users_data['service_code'] = '';
            $cart_users_data['transit_days'] = '';
            $cart_users_data['delivery_by_time'] = '';
            $free_delivery = 1;
        }

        $user_id = getFrontenduserId();

        if ($user_id) {

            $cart_users_data['user_id'] = $user_id;
        }

        $cart_users_data['volume_unit'] = $this->config->item('volume_unit');
        $cart_users_data['weight_unit'] = $this->config->item('weight_unit');
        // update forms data in the session
        $session_data = array('cart_users_data' => $cart_users_data);
        $this->session->set_userdata($session_data);
        $data['cart_users_data'] = $this->session->userdata('cart_users_data');

        $this->session->set_userdata(array('free_delivery' => $free_delivery));

        // update cart form email attempt variable according to conditions
        if ($data['cart_users_data']['email'] != $this->security->xss_clean($this->input->post('email'))) {
            $cart_email_attempt = 0;
        } else if ($this->session->userdata('cart_email_attempt') != '') {
            $cart_email_attempt = $this->session->userdata('cart_email_attempt');
        } else {
            $cart_email_attempt = 0;
        }

        // update cart form sms attempt variable according to conditions
        if ($data['cart_users_data']['telephone'] != $this->security->xss_clean($this->input->post('telephone'))) {
            $cart_sms_attempt = 0;
        } else if ($this->session->userdata('cart_sms_attempt') != '') {
            $cart_sms_attempt = $this->session->userdata('cart_sms_attempt');
        } else {
            $cart_sms_attempt = 0;
        }
        $cart_email = array(
            'cart_email_attempt' => $cart_email_attempt,
            'cart_sms_attempt' => $cart_sms_attempt,
        );
        // update sms and email attempt variable in the session
        $this->session->set_userdata($cart_email);

        // save cart products ,comments, quantity  input values in variable
        $product_ids = $this->security->xss_clean($this->input->post('product_id'));
        $quantity = $this->security->xss_clean($this->input->post('quantity'));
        $comments = $this->security->xss_clean($this->input->post('comment'));
        $quantity = ($quantity < 1 ? 1 : $quantity);
        // if product, comment and quantity count is not similar than  redirect user to cart page.
        if ((count($product_ids) != count($quantity)) || (count($product_ids) != count($comments))) {
            redirect('cart');
        }

        //This Function is used to update cart products comment, quantity in the session.
        $this->updatedcart();

        // pass cart form data to the views of cart page
        $data['cart_users_data'] = $this->session->userdata('cart_users_data');

	// if user click on the continue button than this function redirect user to product page
	if ($this->security->xss_clean($this->input->post('hidden_button_checkings')) == 'continue'){
	    $edit_cart_mode = array('edit_cart_mode' => 1);
            $this->session->set_userdata($edit_cart_mode);
            $where_param = array();
            $where_param['email'] = $cart_users_data['email'];
            $select_param = array('id' => 'id');
            //get block user   records from table cart_block_users using input email
            $recent_id = $this->comman_model->get_row("cart_block_users", $select_param, $where_param);
            if ($recent_id[0]->id != "") {
                //if users details exist than get id of the user
                $last_inserted_cart_block_id = $recent_id[0]->id;
            } else {
                //if users details does not  exist than insert data in the table cart_block_users
                $last_inserted_cart_block_id = $this->comman_model->insert_column("cart_block_users", $cart_users_data);
            }

            // update  id from table cart_block_users according to current user in session
            $this->session->set_userdata('last_inserted_cart_block_id', $last_inserted_cart_block_id);

	    $update_data = array('cartmode' => 1, 'created_time'=>time());
            $this->db->where('id', $last_inserted_cart_block_id);
            $this->db->update('cart_block_users', $update_data);  
            redirect('products');
        }
        if ($this->security->xss_clean($this->input->post('button_checkings')) == 'continue') {
            redirect('products');
        } else if ($this->security->xss_clean($this->input->post('button_checkings')) == 'back')
        // if user click on the back button than this function redirect user to product list  page
        {
            redirect('products/product_list');
        } else {
            if ($this->input->post('coupon_new') != "1") {
                $edit_cart_mode = array('edit_cart_mode' => 1);
                $this->session->set_userdata($edit_cart_mode);
            }
            $where_param = array();
            $where_param['email'] = $cart_users_data['email'];
            $select_param = array('id' => 'id');
            //get block user   records from table cart_block_users using input email
            $recent_id = $this->comman_model->get_row("cart_block_users", $select_param, $where_param);
            if ($recent_id[0]->id != "") {
                //if users details exist than get id of the user
                $last_inserted_cart_block_id = $recent_id[0]->id;
            } else {
                //if users details does not  exist than insert data in the table cart_block_users
                $last_inserted_cart_block_id = $this->comman_model->insert_column("cart_block_users", $cart_users_data);
            }

            // update  id from table cart_block_users according to current user in session
            $this->session->set_userdata('last_inserted_cart_block_id', $last_inserted_cart_block_id);

            $update_data = array('cartmode' => 1);
            $this->db->where('id', $last_inserted_cart_block_id);
            $this->db->update('cart_block_users', $update_data);

            $where_param = array();
            $where_param['str_email'] = $old_cart_users_data['email'];
            $where_param['str_country_code'] = $old_cart_users_data['country_code'];
            $where_param['str_telephone'] = $old_cart_users_data['telephone'];
            $select_param = array('int_id' => 'int_id');
            //get block email  records from table block_email_list using input email and phone
            $block_id = $this->comman_model->get_row("block_email_list", $select_param, $where_param);

            if (isset($block_id[0]->int_id) && $block_id[0]->int_id != "") {
                // if record exist in the block_email_list than update values in the table
                $whr_param['int_id'] = $block_id[0]->int_id;
                $block_data = array();
                $block_data['dte_block'] = null;
                $block_data['str_email'] = $this->security->xss_clean($this->input->post('email'));
                $block_data['str_applicant'] = $this->security->xss_clean($this->input->post('surname'));
                $block_data['str_country'] = $this->security->xss_clean($this->input->post('country'));
                $block_data['str_ip_address'] = $_SERVER['REMOTE_ADDR'];
                $block_data['str_country_code'] = $country_code;
                $block_data['str_telephone'] = $telephone;
                $block_data['region'] = "Cart";
                $block_data['created_time'] = time();
                $this->comman_model->update_column("block_email_list", $whr_param, $block_data);
            } else {
                // if record does  not exist in the block_email_list than insert  values in the table
                $block_data = array();
                $block_data['int_errors'] = 0;
                $block_data['email_int_sents'] = 0;
                $block_data['sms_int_sents'] = 0;
                $block_data['dte_block'] = null;
                $block_data['int_block'] = 0;
                $block_data['str_email'] = $this->security->xss_clean($this->input->post('email'));
                $block_data['str_applicant'] = $this->security->xss_clean($this->input->post('surname'));
                $block_data['str_country'] = $this->security->xss_clean($this->input->post('country'));
                $block_data['str_ip_address'] = $_SERVER['REMOTE_ADDR'];
                $block_data['str_country_code'] = $country_code;
                $block_data['str_telephone'] = $telephone;
                $block_data['region'] = "Cart";
                $block_data['timezone'] = trim($this->security->xss_clean($this->input->post('block_timezone')));
                $this->comman_model->insert_column("block_email_list", $block_data);
            }

            if ($this->input->post('coupon_new') == "1") {
                // This function redirect use from cart page to confirm page.

                // Same code of the cart_confirm

                $entry_users_data = $this->session->userdata('entry_users_data') ? $this->session->userdata('entry_users_data') : array();
                if (front_on_checkout_verification(true)) {
                    // if user verfication on checkout is true than this code will executed
                    if (!empty($entry_users_data)) {
                        $where_param = array();
                        $where_param['email'] = $entry_users_data['email'];
                        $where_param['country_code'] = $entry_users_data['country_code'];
                        $where_param['telephone'] = $entry_users_data['telephone'];
                        $select_param = array('*');
                        $rowdata = $this->comman_model->get_row_array("entry_door_front_block_data", $select_param, $where_param);
                        $entry_users_data = isset($rowdata[0]) ? $rowdata[0] : array();
                    }

                    // these conditions set email and sms attempt number and pass to the view file
                    if ($this->session->userdata('entry_email_attempt') != '' && $this->session->userdata('entry_email_attempt') <= 3) {
                        $email_attempt = $this->session->userdata('entry_email_attempt') + 1;
                    } else {
                        $email_attempt = 0;
                    }

                    if ($this->session->userdata('entry_sms_attempt') != '' && $this->session->userdata('entry_sms_attempt') <= 3) {
                        $sms_attempt = $this->session->userdata('entry_sms_attempt') + 1;
                    } else {
                        $sms_attempt = 0;
                    }

                    $entry_door_timer = (object) get_user_lang_data(array('entry_door_timer'), $this->lang->default_lang_id)['entry_door_timer'];
                } else {
                    if ($this->session->userdata('cart_email_attempt') != '' && $this->session->userdata('cart_email_attempt') <= 3) {
                        $email_attempt = $this->session->userdata('cart_email_attempt') + 1;
                    } else {
                        $email_attempt = 0;
                    }

                    if ($this->session->userdata('cart_sms_attempt') != '' && $this->session->userdata('cart_sms_attempt') <= 3) {
                        $sms_attempt = $this->session->userdata('cart_sms_attempt') + 1;
                    } else {
                        $sms_attempt = 0;
                    }

                    $entry_door_timer = '';
                }
                $loginuserterm = loginuserterm();
                // set edit cartt mode variable in the session
                $edit_cart_mode = array('edit_cart_mode' => 1);
                $this->session->set_userdata($edit_cart_mode);

                $cart = $this->session->userdata('new_cart');
                
                $cartCount = getcartcount($cart);
                // cart is empty than this code redirect user to cart page
                if (empty($cartCount)) {
                    redirect('cart');
                }

                $cart_users_data = $this->session->userdata('cart_users_data');
                $coupon_applied = $this->session->userdata('coupon_applied') ? $this->session->userdata('coupon_applied') : "";
                $coupon_data = $this->session->userdata('coupon_data') ? $this->session->userdata('coupon_data') : "";

                // get user email and checked block data for that user
                $email = $cart_users_data['email'];
                $block_data = $this->cart_model->getUserBlockByStatus('cart_block_users', $email, '1');

                // block data for the user is exist than check the time else set current time
                if (!empty($block_data)) {
                    $block_user_time = $block_data[0]->created_time;
                } else {
                    $block_user_time = time();
                }

                $now = time();
                $check_time_block = $now - $block_user_time;
                $block_flag = 0;
                $cart_users_data['created_time'] = time();

                if (!empty($block_data)) {

                    if ($check_time_block <= 3600 || $check_time_block >= 7200) {
                        $block_flag = 0;
                        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');

                        $this->comman_model->update_where('cart_block_users', $cart_users_data, array('id' => $last_inserted_cart_block_id));
                    } else if ($check_time_block >= 7200) {
                        $block_flag = 0;
                        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
                        $this->comman_model->update_where('cart_block_users', $cart_users_data, array('id' => $last_inserted_cart_block_id));
                    } else {
                        $block_flag = 1;
                    }
                } else {
                    $block_flag = 0;
                    $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
                    $this->comman_model->update_where('cart_block_users', $cart_users_data, array('id' => $last_inserted_cart_block_id));
                }
                $this->session->set_userdata('new_cart', $check_frieght_cart);
                redirect('cart/cart_confirm');
            } else {

                // This function redirect use from cart page to confirm page.
                $this->session->set_userdata('new_cart', $check_frieght_cart);

                redirect('cart/cart_confirm');
            }
        }
    }

    /**
     * reset_cart_user_session
     *
     * This Function is called on complete of countdown on the cart page. This Function block the current user email and phone and update the session.
     * @param  mixed $check
     * @param  mixed $user_data_delete
     * @return void
     */
    public function reset_cart_user_session($check = 0, $user_data_delete = 0)
    {

        $cart_users_data = $this->session->userdata('cart_users_data');
        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');

        // Update status in the cart_block_users table as per session id
        $update_data = array('status' => 1, 'created_time' => time());
        $this->db->where('id', $last_inserted_cart_block_id);
        $this->db->update('cart_block_users', $update_data);

        if ($check == 0) {
            // this condition block email and phone according to condition
            $where_param = array();
            $where_param['str_email'] = $cart_users_data['email'];
            $where_param['str_country_code'] = $cart_users_data['country_code'];
            $where_param['str_telephone'] = $cart_users_data['telephone'];

            $select_param = array('*');
            // get records from table block_email_list using cart email and phone number
            $block_info = $this->comman_model->get_row("block_email_list", $select_param, $where_param);

            $where_param = array('str_email' => $cart_users_data['email']);
            $select_param = array('*');
            // get records from table cart_block_emails using cart email
            $blockemail_info = $this->comman_model->get_row("cart_block_emails", $select_param, $where_param);

            $where_param = array();
            $where_param['str_country_code'] = $cart_users_data['country_code'];
            $where_param['str_telephone'] = $cart_users_data['telephone'];
            $select_param = array('*');
            // get records from table cart_block_phones using cart phone
            $blockphone_info = $this->comman_model->get_row("cart_block_phones", $select_param, $where_param);

            if (!empty($block_info)) {
                // if cart user email and phone both are  in block_email_list table than these conditions will work
                if (!empty($blockemail_info) && $block_info[0]->str_email != $cart_users_data['email']) {

                    // if block_email_list record email is not equal to the cart user email than add cart email in the cart_block_emails table
                    $insert_data = array();
                    $insert_data['int_id'] = $block_info[0]->int_id;
                    $insert_data['int_errors'] = $block_info[0]->int_errors;
                    $insert_data['email_int_sents'] = $block_info[0]->email_int_sents;
                    $insert_data['int_block'] = 5;
                    $insert_data['dte_block'] = date("Y-m-d H:i:s", time());
                    $insert_data['str_code'] = $block_info[0]->str_code;
                    $insert_data['str_email'] = $cart_users_data['email'];
                    $insert_data['str_applicant'] = $cart_users_data['user_name'];
                    $insert_data['str_country'] = $cart_users_data['country'];
                    $insert_data['str_ip_address'] = $_SERVER['REMOTE_ADDR'];
                    $insert_data['region'] = "Cart";
                    if ($this->input->post('timezone') != '') {
                        $insert_data['timezone'] = trim($this->security->xss_clean($this->input->post('timezone')));
                    } else {
                        $insert_data['timezone'] = trim($this->security->xss_clean($this->input->post('block_timezone')));
                    }
                    $this->db->insert('cart_block_emails', $insert_data);
                }

                if (!empty($blockphone_info) && $block_info[0]->str_country_code != $cart_users_data['country_code'] && $block_info[0]->str_telephone != $cart_users_data['telephone']) {

                    // if block_email_list record phone is not equal to the cart user phone than add cart user phone in the cart_block_phones table
                    $insert_data = array();
                    $insert_data['int_id'] = $block_info[0]->int_id;
                    $insert_data['int_errors'] = $block_info[0]->int_errors;
                    $insert_data['sms_int_sents'] = $block_info[0]->sms_int_sents;
                    $insert_data['int_block'] = 5;
                    $insert_data['dte_block'] = date("Y-m-d H:i:s", time());
                    $insert_data['str_sms_code'] = $block_info[0]->str_sms_code;
                    $insert_data['str_applicant'] = $cart_users_data['user_name'];
                    $insert_data['str_country'] = $cart_users_data['country'];
                    $insert_data['str_ip_address'] = $_SERVER['REMOTE_ADDR'];
                    $insert_data['str_country_code'] = $cart_users_data['country_code'];
                    $insert_data['str_telephone'] = $cart_users_data['telephone'];
                    $insert_data['region'] = "Cart";
                    if ($this->input->post('timezone') != '') {

                        $insert_data['timezone'] = trim($this->security->xss_clean($this->input->post('timezone')));
                    } else {
                        $insert_data['timezone'] = trim($this->security->xss_clean($this->input->post('block_timezone')));
                    }
                    $this->db->insert('cart_block_phones', $insert_data);
                }

                if ($block_info[0]->dte_block == '' || $block_info[0]->dte_block == null) {
                    // if block_email_list record having block time  null than update the block time in the table block_email_list
                    $block_data = array();
                    $block_data['int_block'] = 5;
                    $block_data['dte_block'] = date("Y-m-d H:i:s", time());
                    $this->comman_model->update_column("block_email_list", $where_param, $block_data);
                }
            } else {
                // if cart user email and phone both are not in block_email_list table than this code will add both in the table
                $block_data = array();
                $block_data['int_errors'] = 0;
                $block_data['email_int_sents'] = 0;
                $block_data['sms_int_sents'] = 0;
                $block_data['dte_block'] = date("Y-m-d H:i:s", time());
                $block_data['int_block'] = 5;
                $block_data['str_email'] = $cart_users_data['email'];
                $block_data['str_applicant'] = $cart_users_data['user_name'];
                $block_data['str_country'] = $cart_users_data['country'];
                $block_data['str_ip_address'] = $_SERVER['REMOTE_ADDR'];
                $block_data['str_country_code'] = $cart_users_data['country_code'];
                $block_data['str_telephone'] = $cart_users_data['telephone'];
                $block_data['region'] = "Cart";
                $this->comman_model->insert_column("block_email_list", $block_data);
            }
        }

        //  set sessions data variables
        if ($user_data_delete) {
            $session_data = array(
                'last_inserted_cart_block_id' => "",
                'edit_cart_mode' => 'false',
            );
        } else {
            $session_data = array(
                'last_inserted_cart_block_id' => $last_inserted_cart_block_id,
                'edit_cart_mode' => 'false',
            );
        }
        $this->session->set_userdata($session_data);
        // return result in json format
        $result['result'] = 'true';
        $result['email'] = $cart_users_data['email'];
        $result['telephone'] = '+' . $cart_users_data['country_code'] . ' ' . $cart_users_data['telephone'];
        echo json_encode($result);
    }

    /**
     * cart_confirm
     *
     * This Function display the verify cart page before the payment. This page has view similar to invoice and on submit the captcha user verify the  email and phone using otp.
     * @return void
     */
    public function cart_confirm()
    {        
        //print_r($this->session->userdata('newcart'));exit;
        // remove session variable related to clictopay payment gateway
        $this->session->unset_userdata('ctp_orderid');
        $this->session->unset_userdata('click_pay_message');
        $this->session->unset_userdata('click_pay_error');
        $this->session->unset_userdata('payment_api_error');

        
        
        // Read user information from session and pass to the view file
        $entry_users_data = $this->session->userdata('entry_users_data') ? $this->session->userdata('entry_users_data') : array();
        //echo '<pre>';print_r($this->session);echo '</pre>';
        if (front_on_checkout_verification(true)) {
            // if user verfication on checkout is true than this code will executed
            if (!empty($entry_users_data)) {
                $where_param = array();
                $where_param['email'] = $entry_users_data['email'];
                $where_param['country_code'] = $entry_users_data['country_code'];
                $where_param['telephone'] = $entry_users_data['telephone'];
                $select_param = array('*');
                $rowdata = $this->comman_model->get_row_array("entry_door_front_block_data", $select_param, $where_param);
                $entry_users_data = isset($rowdata[0]) ? $rowdata[0] : array();
            }

            // these conditions set email and sms attempt number and pass to the view file
            if ($this->session->userdata('entry_email_attempt') != '' && $this->session->userdata('entry_email_attempt') <= 3) {
                $email_attempt = $this->session->userdata('entry_email_attempt') + 1;
            } else {
                $email_attempt = 0;
            }

            if ($this->session->userdata('entry_sms_attempt') != '' && $this->session->userdata('entry_sms_attempt') <= 3) {
                $sms_attempt = $this->session->userdata('entry_sms_attempt') + 1;
            } else {
                $sms_attempt = 0;
            }

            $entry_door_timer = (object) get_user_lang_data(array('entry_door_timer'), $this->lang->default_lang_id)['entry_door_timer'];
        } else {
            if ($this->session->userdata('cart_email_attempt') != '' && $this->session->userdata('cart_email_attempt') <= 3) {
                $email_attempt = $this->session->userdata('cart_email_attempt') + 1;
            } else {
                $email_attempt = 0;
            }

            if ($this->session->userdata('cart_sms_attempt') != '' && $this->session->userdata('cart_sms_attempt') <= 3) {
                $sms_attempt = $this->session->userdata('cart_sms_attempt') + 1;
            } else {
                $sms_attempt = 0;
            }

            $entry_door_timer = '';
        }
        $loginuserterm = loginuserterm();
        // set edit cartt mode variable in the session
        $edit_cart_mode = array('edit_cart_mode' => 1);
        $this->session->set_userdata($edit_cart_mode);
        $this->session->set_userdata('new_cart',$this->session->userdata('cart'));
        $cart = $this->session->userdata('new_cart');
        // print_r($cart);
        $cartCount = getcartcount($cart);
        // cart is empty than this code redirect user to cart page
        if (empty($cartCount)) {
            redirect('cart');
        }

        $cart_users_data = $this->session->userdata('cart_users_data');

        $coupon_applied = $this->session->userdata('coupon_applied') ? $this->session->userdata('coupon_applied') : "";
        $coupon_data = $this->session->userdata('coupon_data') ? $this->session->userdata('coupon_data') : "";

        // get user email and checked block data for that user
        $email = $cart_users_data['email'];
        $block_data = $this->cart_model->getUserBlockByStatus('cart_block_users', $email, '1');

        // block data for the user is exist than check the time else set current time
        if (!empty($block_data)) {
            $block_user_time = $block_data[0]->created_time;
        } else {
            $block_user_time = time();
        }

        $now = time();
        $check_time_block = $now - $block_user_time;
        $block_flag = 0;
        $cart_users_data['created_time'] = time();

        if (!empty($block_data)) {

            if ($check_time_block <= 3600 || $check_time_block >= 7200) {
                $block_flag = 0;
                $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');

                $this->comman_model->update_where('cart_block_users', $cart_users_data, array('id' => $last_inserted_cart_block_id));
            } else if ($check_time_block >= 7200) {
                $block_flag = 0;
                $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
                $this->comman_model->update_where('cart_block_users', $cart_users_data, array('id' => $last_inserted_cart_block_id));
            } else {
                $block_flag = 1;
            }
        } else {
            $block_flag = 0;
            $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
            $this->comman_model->update_where('cart_block_users', $cart_users_data, array('id' => $last_inserted_cart_block_id));
        }

        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'product_instruction', 'sales_order_preview', 'entry_door_message', 'cart_timer'), $this->lang->default_lang_id);

        //This Function is used to get values of messages and timer from table cart_timer_country
        $cart_timer = (object) $userLangData['cart_timer'];

        $check_time_block = $check_time_block / 60;
        $check_time_block = $cart_timer->cart_block_timer - $check_time_block;
        $block_time = round($check_time_block);
        $block_flag = $block_flag;

        $cart = $this->session->userdata('new_cart');
        $cart = cartCleanUp($cart);
        $this->session->set_userdata('new_cart', $cart);
        $cart_3 = [];
        //echo '<pre>';print_r($cart);echo '</pre>';
        $remaining_cart = [];
        foreach($cart as $k=>$v){
            if(isset($v['frieght_package'])){
                if($v['frieght_package']=="1"){
                    $cart_3[$k] = $v;
                }else{
                    $remaining_cart[$k] = $v;
                }
            }            
        }
        if(count($cart_3)>0){
            $cart =$cart_3;
        }
        $remaining_cart = cartCleanUp($remaining_cart);
        $this->session->set_userdata('remaining_cart', $remaining_cart);
               
        // print_r($this->session->userdata('new_cart'));
        // print_r($this->session->userdata('remaining_cart'));
        // exit;

        // Get cart items data with details
        $cart_product_quantity = $this->session->userdata('cart_product_quantity');
        $cart_details = updateLanguageParameters($this->product_model->get_cart_items($cart, $this->lang->default_lang_id));
        $cart_details = getCartProductDetails($cart_details, 1, $cart_product_quantity);

        // echo "<pre>";
        // print_r($cart_details);
        // exit;
        // $this->session->set_userdata('cart_model_att', $cart_details);

        $sel_param = "*";
        $whr_param['str_email'] = $cart_users_data['email'];
        $whr_param['str_country_code'] = $cart_users_data['country_code'];
        $whr_param['str_telephone'] = $cart_users_data['telephone'];
        $block_data = $this->comman_model->get_row("block_email_list", $sel_param, $whr_param);

        $tax_base_rate = 0;
        // this function calculate tax base rate for the current user
        if (isset($cart_users_data['tax_exoneration']) && $cart_users_data['tax_exoneration'] != 1) {
            $rate = $this->cart_model->getTaxBaseRate($cart_users_data['cart_state'], $cart_users_data['cart_zip']);
            if (isset($rate['tax_base_rate']) && $rate['tax_base_rate'] != '' && $rate['tax_base_rate'] != 0) {
                $tax_base_rate = $rate['tax_base_rate'];
            }
        }

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('cart_confirm_page'),
            'pageType' => 'cart_confirm',
            'on_success_redirection' => 'cart/cart_confirm',
            'entry_users_data' => $entry_users_data,
            'email_attempt' => $email_attempt,
            'sms_attempt' => $sms_attempt,
            'entry_door_timer' => $entry_door_timer,
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'timestamp' => date_timestamp_get(date_create()),
            'front_validuser_data' => $this->session->userdata('front_validuser_data'),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)), // This Function return list of countries for language dropdown on the header
            'cart_timer' => $cart_timer,
            'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'product_items' => $this->product_items_model->getproductitems_data(),
            'product_model_items' => $this->product_items_model->getproductitems_data('product_model'),
            'cart_details' => $cart_details,
            'cart_data' => $cart, // This Variable pass cart data from session to the view
            'cart_users_data' => $cart_users_data, // this function passed shipping and billing  forms values to the view files from session.
            'cart_email_confirm' => $block_data[0]->cart_email_confirm,
            'cart_sms_confirm' => $block_data[0]->cart_sms_confirm,
            'email_verification_code' => $block_data[0]->str_code,
            'sms_verification_code' => $block_data[0]->str_sms_code,
            'cartcount' => $cartCount,
            'coupon_applied' => $coupon_applied,
            'coupon_data' => $coupon_data,
            'general_instruction' => (object) $userLangData['general_instruction'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'product_instruction' => (object) $userLangData['product_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'sales_order_preview' => $userLangData['sales_order_preview'],
            'entry_door_message' => $userLangData['entry_door_message'],
            'freight' => (isset($cart_users_data['shipping_rate']) && $cart_users_data['shipping_rate']) ? $cart_users_data['shipping_rate'] : 0,
            'block_time' => $block_time,
            'block_flag' => $block_flag,
            'tax_base_rate' => $tax_base_rate,
            'loginuserterm' => $loginuserterm,

        );
        $pageData['completedata'] = $pageData;
        
        // this function load file of the verify cart page
        $this->load->view('common/header_confirm', $pageData);
        $this->load->view('cart/verify_submit', $pageData);
    }

    /**
     * edittocart
     *
     * This Function Called on click of edit cart button. It update status in the database and redirect user to the cart page.
     * @return void
     */
    public function edittocart()
    {
        // get current user id from session
        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');
        $update_data = array(
            'cartmode' => 1,
            'created_time' => time(),
        );
        $this->db->where('id', $last_inserted_cart_block_id);
        // This function update status in the cart_block_users table and redirect user to the cart page
        $this->db->update('cart_block_users', $update_data);
        redirect('cart/cart');
    }

    public function save_cart_details()
    {
        $result = array();
        $cart_email_attempt = $this->session->userdata('cart_email_attempt');
        if ($cart_email_attempt == '') {
            $cart_email_attempt = 0;
        }

        $cart_sms_attempt = $this->session->userdata('cart_sms_attempt');
        if ($cart_sms_attempt == '') {
            $cart_sms_attempt = 0;
        }

        if ($cart_email_attempt > 3) {
            $cart_email_attempt = 0;
        }

        if ($cart_sms_attempt > 3) {
            $cart_sms_attempt = 0;
        }

        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');

        $condtion = array("id" => $last_inserted_cart_block_id);
        $blockuser_data = $this->comman_model->get_all_data_by_id('cart_block_users', $condtion);

        $blockuser_email = isset($blockuser_data[0]['email']) ? $blockuser_data[0]['email'] : '';
        $blockuser_country_code = isset($blockuser_data[0]['country_code']) ? $blockuser_data[0]['country_code'] : '';
        $blockuser_telephone = isset($blockuser_data[0]['telephone']) ? $blockuser_data[0]['telephone'] : '';

        $cart_details = $this->session->userdata('cart_randomString');
        $cart_verification_code = trim($this->security->xss_clean($this->input->post('ecart_verification_codemail')));

        $sms_details = $this->session->userdata('sms_randomString');
        $sms_verification_code = trim($this->security->xss_clean($this->input->post('ecart_verification_codesms')));

        $valid_email = trim($this->security->xss_clean($this->input->post('valid_email')));
        $valid_phone = trim($this->security->xss_clean($this->input->post('valid_phone')));

        if ($cart_verification_code == $cart_details && $sms_verification_code == $sms_details) {
            $where_param = array();
            $session_user = $this->session->userdata("cart_users_data");
            $where_param['str_email'] = $session_user['email'];
            $where_param['str_country_code'] = $session_user['country_code'];
            $where_param['str_telephone'] = $session_user['telephone'];
            $b_data['cart_email_confirm'] = '1';
            $b_data['cart_sms_confirm'] = '1';
            $this->comman_model->update_column("block_email_list", $where_param, $b_data);

            $front_validuser_data = $this->session->userdata('front_validuser_data');
            if ($front_validuser_data['country_code'] != $session_user['country_code'] || $front_validuser_data['telephone'] != $session_user['telephone'] || $front_validuser_data['email'] != $session_user['email']) {
                $updateData = array(
                    'country_code' => $session_user['country_code'],
                    'telephone' => $session_user['telephone'],
                    'email' => $session_user['email'],
                );
                $dbCondition = array('id' => $front_validuser_data['id']);
                $this->comman_model->update_column("entry_door_front_shopping_data", $dbCondition, $updateData);

                $front_validuser_data = array_merge($front_validuser_data, $updateData);
                $sessiondata = array('front_validuser_data' => $front_validuser_data);
                $this->session->set_userdata($sessiondata);
            }

            $session_data['final_price_data']['currency'] = $this->session->userdata('cart_final_currency');
            $session_data['final_price_data']['total'] = $this->session->userdata('cart_final_price');
            $session_data['final_price_data']['payment_price'] = $this->session->userdata('cart_payment_price');

            $this->session->set_userdata($session_data);

            $result['result'] = 'success';
            $result['email_attempt'] = $cart_email_attempt;
            $result['sms_attempt'] = $cart_sms_attempt;
            $result['cart_email_confirm_status'] = '1';
            $result['cart_sms_confirm_status'] = '1';
            $cart_email_attempt = 0;
            $cart_sms_attempt = 0;
        } else if ($cart_verification_code == $cart_details && $cart_sms_attempt < 3) {
            $cart_email_attempt = 0;

            $session_user = $this->session->userdata("cart_users_data");

            $where_param = array();
            $where_param['str_email'] = $session_user['email'];
            $where_param['str_country_code'] = $session_user['country_code'];
            $where_param['str_telephone'] = $session_user['telephone'];
            $select_param = '*';
            $block_info = $this->comman_model->get_row("block_email_list", $select_param, $where_param);

            $block_data = array();
            $block_data['int_errors'] = $block_info[0]->int_errors + 1;
            $block_data['cart_email_confirm'] = '1';
            $this->comman_model->update_column("block_email_list", $where_param, $block_data);

            $session_data_email = array(
                'cart_email_confirm' => $session_user['email'],
                'cart_email_confirm_status' => '1',
            );
            $this->session->set_userdata($session_data_email);

            $result['result'] = 'fail';
            $result['email_attempt'] = 0;
            $result['block_email'] = $blockuser_email;
            if ($valid_phone != 1) {
                $cart_sms_attempt = 0;
                $result['valid_phone'] = 0;
                $result['valid_email'] = 1;
                $result['sms_attempt'] = 0;
            } else {
                $cart_sms_attempt++;
                $result['valid_phone'] = 1;
                $result['valid_email'] = 1;
                $result['sms_attempt'] = $cart_sms_attempt;
            }
            $result['block_sms'] = '+' . $blockuser_country_code . ' ' . $blockuser_telephone;
            $result['cart_email_confirm_status'] = '1';
            if ($block_info[0]->dte_block != '' || $block_info[0]->phone_blocked == 1 || $block_info[0]->cart_email_confirm == 1) {
                $result['block_step'] = '2';
            } else {
                $result['block_step'] = '1';
            }
        } else if ($sms_verification_code == $sms_details && $cart_email_attempt < 3) {
            $cart_sms_attempt = 0;

            $session_user = $this->session->userdata("cart_users_data");

            $where_param = array();
            $where_param['str_email'] = $session_user['email'];
            $where_param['str_country_code'] = $session_user['country_code'];
            $where_param['str_telephone'] = $session_user['telephone'];
            $select_param = '*';
            $block_info = $this->comman_model->get_row("block_email_list", $select_param, $where_param);

            $block_data = array();
            $block_data['int_errors'] = $block_info[0]->int_errors + 1;
            $block_data['cart_sms_confirm'] = '1';
            $this->comman_model->update_column("block_email_list", $where_param, $block_data);

            $session_data_sms = array(
                'cart_sms_confirm' => '+' . $session_user['country_code'] . ' ' . $session_user['telephone'],
                'cart_sms_confirm_status' => '1',
            );
            $this->session->set_userdata($session_data_sms);

            $result['result'] = 'fail';
            if ($valid_email != 1) {
                $cart_email_attempt = 0;
                $result['valid_phone'] = 1;
                $result['valid_email'] = 0;
                $result['email_attempt'] = 0;
            } else {
                $cart_email_attempt++;
                $result['valid_phone'] = 1;
                $result['valid_email'] = 1;
                $result['email_attempt'] = $cart_email_attempt;
            }
            $result['block_email'] = $blockuser_email;
            $result['sms_attempt'] = 0;
            $result['block_sms'] = '+' . $blockuser_country_code . ' ' . $blockuser_telephone;
            $result['cart_sms_confirm_status'] = '1';
            if ($block_info[0]->dte_block != '' || $block_info[0]->email_blocked == 1 || $block_info[0]->cart_sms_confirm == 1) {
                $result['block_step'] = '2';
            } else {
                $result['block_step'] = '1';
            }
        } else {
            if ($cart_email_attempt > 2 || $cart_sms_attempt > 2) {
                $cart_email_attempt++;
                $cart_sms_attempt++;

                $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');

                $update_data = array(
                    'status' => 1,
                    'created_time' => time(),
                );
                $this->db->where('id', $last_inserted_cart_block_id);
                $this->db->update('cart_block_users', $update_data);

                $session_user = $this->session->userdata("cart_users_data");

                $where_param = array();
                $where_param['str_email'] = $session_user['email'];
                $where_param['str_country_code'] = $session_user['country_code'];
                $where_param['str_telephone'] = $session_user['telephone'];

                $block_data = array();
                $block_data['int_block'] = 2;
                $block_data['dte_block'] = date("Y-m-d H:i:s", time());
                $this->comman_model->update_column("block_email_list", $where_param, $block_data);

                $select_param = '*';
                $block_info = $this->comman_model->get_row("block_email_list", $select_param, $where_param);
                if ($cart_email_attempt > 2) {
                    $insert_data = array();
                    $insert_data['int_id'] = $block_info[0]->int_id;
                    $insert_data['int_errors'] = $block_info[0]->int_errors;
                    $insert_data['email_int_sents'] = $block_info[0]->email_int_sents;
                    $insert_data['int_block'] = 2;
                    $insert_data['dte_block'] = date("Y-m-d H:i:s", time());
                    $insert_data['str_code'] = $block_info[0]->str_code;
                    $insert_data['str_email'] = $session_user['email'];
                    $insert_data['str_applicant'] = $session_user['user_name'];
                    $insert_data['str_country'] = $session_user['country'];
                    $insert_data['str_ip_address'] = $_SERVER['REMOTE_ADDR'];
                    $insert_data['region'] = "Cart";
                    if ($this->input->post('timezone') != '') {
                        $insert_data['timezone'] = trim($this->security->xss_clean($this->input->post('timezone')));
                    } else {
                        $insert_data['timezone'] = trim($this->security->xss_clean($this->input->post('block_timezone')));
                    }
                    $this->db->insert('cart_block_emails', $insert_data);
                }
                if ($cart_sms_attempt > 2) {
                    $insert_data = array();
                    $insert_data['int_id'] = $block_info[0]->int_id;
                    $insert_data['int_errors'] = $block_info[0]->int_errors;
                    $insert_data['sms_int_sents'] = $block_info[0]->sms_int_sents;
                    $insert_data['int_block'] = 2;
                    $insert_data['dte_block'] = date("Y-m-d H:i:s", time());
                    $insert_data['str_sms_code'] = $block_info[0]->str_sms_code;
                    $insert_data['str_applicant'] = $session_user['user_name'];
                    $insert_data['str_country'] = $session_user['country'];
                    $insert_data['str_ip_address'] = $_SERVER['REMOTE_ADDR'];
                    $insert_data['str_country_code'] = $session_user['country_code'];
                    $insert_data['str_telephone'] = $session_user['telephone'];
                    $insert_data['region'] = "Cart";
                    if ($this->input->post('timezone') != '') {
                        $insert_data['timezone'] = trim($this->security->xss_clean($this->input->post('timezone')));
                    } else {
                        $insert_data['timezone'] = trim($this->security->xss_clean($this->input->post('block_timezone')));
                    }
                    $this->db->insert('cart_block_phones', $insert_data);
                }
                $block_data = array();
                $block_data['int_block'] = 2;
                $block_data['dte_block'] = date("Y-m-d H:i:s", time());
                $this->comman_model->update_column("block_email_list", $where_param, $block_data);
            } else {
                $cart_email_attempt++;
                $cart_sms_attempt++;

                $session_user = $this->session->userdata("cart_users_data");

                $where_param = array();
                $where_param['str_email'] = $session_user['email'];
                $where_param['str_country_code'] = $session_user['country_code'];
                $where_param['str_telephone'] = $session_user['telephone'];
                $select_param = array('int_errors' => 'int_errors');
                $block_info = $this->comman_model->get_row("block_email_list", $select_param, $where_param);

                $block_data = array();
                $block_data['int_errors'] = $block_info[0]->int_errors + 1;
                $this->comman_model->update_column("block_email_list", $where_param, $block_data);
            }

            $result['result'] = 'fail';

            if ($valid_email != 1 && $valid_phone == 1) {
                $result['valid_email'] = 0;
                $result['valid_phone'] = 1;
                $result['email_attempt'] = 0;
                $result['sms_attempt'] = $cart_sms_attempt;
            } else if ($valid_phone != 1 && $valid_email == 1) {
                $result['valid_email'] = 1;
                $result['valid_phone'] = 0;
                $result['email_attempt'] = $cart_email_attempt;
                $result['sms_attempt'] = 0;
            } else {
                $result['valid_email'] = 1;
                $result['valid_phone'] = 1;
                $result['email_attempt'] = $cart_email_attempt;
                $result['sms_attempt'] = $cart_sms_attempt;
            }

            $result['block_email'] = $blockuser_email;
            $result['block_sms'] = '+' . $blockuser_country_code . ' ' . $blockuser_telephone;
            $result['cart_email_confirm_status'] = '';
            $result['cart_sms_confirm_status'] = '';
        }

        $session_data_attempt = array(
            'cart_email_attempt' => $cart_email_attempt,
            'cart_sms_attempt' => $cart_sms_attempt,
        );
        $this->session->set_userdata($session_data_attempt);

        echo json_encode($result);
        exit;
    }

    /**
     * save_validated_cart_details
     *
     * This Function is called on click of next model after sms and email otp is confirmed. It just update the session.
     * @return void
     */
    public function save_validated_cart_details()
    {
        $result = array();

        //  get sms and email otp attempt values from session
        $cart_email_attempt = $this->session->userdata('cart_email_attempt');
        if ($cart_email_attempt == '') {
            $cart_email_attempt = 0;
        }

        $cart_sms_attempt = $this->session->userdata('cart_sms_attempt');
        if ($cart_sms_attempt == '') {
            $cart_sms_attempt = 0;
        }

        if ($cart_email_attempt > 3) {
            $cart_email_attempt = 0;
        }

        if ($cart_sms_attempt > 3) {
            $cart_sms_attempt = 0;
        }

        // Update currency and final amount in the session to use on payment page
        //echo '<pre>';print_r($this->session);echo '</pre>';exit;
        $session_data['final_price_data']['currency'] = $this->session->userdata('cart_final_currency');
        $session_data['final_price_data']['total'] = $this->session->userdata('cart_final_price');
        $session_data['final_price_data']['payment_price'] = $this->session->userdata('cart_payment_price');

        $this->session->set_userdata($session_data);

        $result['result'] = 'success';
        $result['email_attempt'] = $cart_email_attempt;
        $result['sms_attempt'] = $cart_sms_attempt;
        $result['cart_email_confirm_status'] = '1';
        $result['cart_sms_confirm_status'] = '1';
        $cart_email_attempt = 0;
        $cart_sms_attempt = 0;

        // update the session variable
        $session_data_attempt = array(
            'cart_email_attempt' => $cart_email_attempt,
            'cart_sms_attempt' => $cart_sms_attempt,
        );
        $this->session->set_userdata($session_data_attempt);
        // return the json
        echo json_encode($result);
        exit;
    }

    /**
     * cart_verification_code
     * This Function send and resend  OTP code to email and phone  on cart confirm page.
     * @return void
     */
    public function cart_verification_code($isPartial = 0)
    {

        $email = $this->security->xss_clean($this->input->post('email'));
        $name = $this->security->xss_clean($this->input->post('user_name'));
        $salutation = $this->security->xss_clean($this->input->post('salutation'));
        $country = $this->security->xss_clean($this->input->post('country'));
        $telephone = trim($this->security->xss_clean($this->input->post('telephone')));
        $country_code = trim($this->security->xss_clean($this->input->post('country_code')));
        $final_telephone = $country_code . ' ' . $telephone;
        $sms_telephone = $country_code . $telephone;
        $config = $this->config->item('emailconfig');

        if ($isPartial == 0) {
            $resend = $this->input->post('resend');
            if ($resend != 'true') {
                //check captcha
                $captcha = validate_captcha();
                if (isset($captcha['response']) && $captcha['response'] != 'success') {
                    echo json_encode($captcha);
                    exit;
                }
            } else if ($resend == 'true') {
                $tempf1 = $this->security->xss_clean($this->input->post('tempf1'));
                if ($tempf1) {
                    $ecodes = explode('-', base64_decode(base64_decode($tempf1)));
                    if (checkRandomCode($ecodes[1]) == 0 || trim($ecodes[0]) != $this->security->xss_clean($this->input->post('email'))) {
                        echo json_encode(array('status' => 'fail'));
                        exit;
                    }
                } else {
                    echo json_encode(array('status' => 'fail'));
                    exit;
                }

                $tempf2 = $this->security->xss_clean($this->input->post('tempf2'));
                if ($tempf2) {
                    $ecodes = explode('-', base64_decode(base64_decode($tempf2)));
                    if (checkRandomCode($ecodes[1]) == 0 || trim($ecodes[0]) != $this->security->xss_clean($this->input->post('telephone'))) {
                        echo json_encode(array('status' => 'fail'));
                        exit;
                    }
                } else {
                    echo json_encode(array('status' => 'fail'));
                    exit;
                }
            }

            $this->session->unset_userdata('captchaCode'); // reset captcha code.

            $length = 6;

            if (ENVIRONMENT == "production") {
                $cart_randomString = substr(str_shuffle("0123456789"), 0, $length);
                $sms_randomString = substr(str_shuffle("0123456789"), 0, $length);
            } else {
                $cart_randomString = getenv('TEST_EMAIL_CODE');
                $sms_randomString = getenv('TEST_SMS_CODE');
            }

            $session_data = array(
                'cart_randomString' => $cart_randomString,
                'sms_randomString' => $sms_randomString,
            );
            $this->session->set_userdata($session_data);

            $email_attempt = $this->security->xss_clean($this->input->post('email_attempt'));
            if ($email_attempt) {
                $ecodes = explode('-', base64_decode(base64_decode($email_attempt)));
                if (checkRandomCode($ecodes[1]) == 0 || strlen($email_attempt) == 1) {
                    echo json_encode(array('status' => 'fail'));
                    exit;
                }
                $email_attempt = trim($ecodes[0]);
            }

            $sms_attempt = $this->security->xss_clean($this->input->post('sms_attempt'));
            if ($sms_attempt) {
                $ecodes = explode('-', base64_decode(base64_decode($sms_attempt)));
                if (checkRandomCode($ecodes[1]) == 0 || strlen($sms_attempt) == 1) {
                    echo json_encode(array('status' => 'fail'));
                    exit;
                }
                $sms_attempt = trim($ecodes[0]);
            }

            $cart_email_confirm_status = $this->session->userdata('cart_email_confirm_status');
            $cart_sms_confirm_status = $this->session->userdata('cart_sms_confirm_status');
        } else if ($isPartial == 1) {
            //check captcha
            $captcha = validate_captcha();
            if (isset($captcha['response']) && $captcha['response'] != 'success') {
                echo json_encode($captcha);
                exit;
            }

            $email_attempt = $this->security->xss_clean($this->input->post('email_attempt'));
            if ($email_attempt) {
                $ecodes = explode('-', base64_decode(base64_decode($email_attempt)));
                if (checkRandomCode($ecodes[1]) == 0 || strlen($email_attempt) == 1) {
                    echo json_encode(array('status' => 'fail'));
                    exit;
                }
                $email_attempt = trim($ecodes[0]);
            }

            $sms_attempt = $this->security->xss_clean($this->input->post('sms_attempt'));
            if ($sms_attempt) {
                $ecodes = explode('-', base64_decode(base64_decode($sms_attempt)));
                if (checkRandomCode($ecodes[1]) == 0 || strlen($sms_attempt) == 1) {
                    echo json_encode(array('status' => 'fail'));
                    exit;
                }
                $sms_attempt = trim($ecodes[0]);
            }

            $email_attempt = $email_attempt ? $email_attempt : 0;
            $sms_attempt = $sms_attempt ? $sms_attempt : 0;

            $front_validuser_data = $this->session->userdata('front_validuser_data');

            $length = 6;
            if (ENVIRONMENT == "production") {
                $cart_randomString = getenv('TEST_EMAIL_CODE');
                $sms_randomString = getenv('TEST_SMS_CODE');
                if ($front_validuser_data['country_code'] != $country_code || $front_validuser_data['telephone'] != $telephone) {
                    $sms_randomString = substr(str_shuffle("0123456789"), 0, $length);
                }
                if ($front_validuser_data['email'] != $email) {
                    $cart_randomString = substr(str_shuffle("0123456789"), 0, $length);
                }
            } else {
                $cart_randomString = getenv('TEST_EMAIL_CODE');
                $sms_randomString = getenv('TEST_SMS_CODE');
            }

            $post_cart_email_confirm_status = $this->security->xss_clean($this->input->post('cart_email_confirm_status'));
            $post_cart_sms_confirm_status = $this->security->xss_clean($this->input->post('cart_sms_confirm_status'));

            if (isset($post_cart_email_confirm_status) && $post_cart_email_confirm_status != '') {
                $cart_email_confirm_status = $post_cart_email_confirm_status;
            } else {
                $cart_email_confirm_status = $this->session->userdata('cart_email_confirm_status');
            }

            if (isset($post_cart_sms_confirm_status) && $post_cart_sms_confirm_status != '') {
                $cart_sms_confirm_status = $post_cart_sms_confirm_status;
            } else {
                $cart_sms_confirm_status = $this->session->userdata('cart_sms_confirm_status');
            }

            $session_data = array(
                'cart_randomString' => $cart_randomString,
                'sms_randomString' => $sms_randomString,
            );

            $where_param = array();
            $where_param['str_email'] = $email;
            $where_param['str_country_code'] = $country_code;
            $where_param['str_telephone'] = $telephone;
            $block_data['str_code'] = $cart_randomString;
            $block_data['str_sms_code'] = $sms_randomString;
            $this->comman_model->update_column("block_email_list", $where_param, $block_data);
        }

        if ($email_attempt > 3 || $sms_attempt > 3) {
            $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');

            $update_data = array(
                'status' => 1,
                'created_time' => time(),
            );
            $this->db->where('id', $last_inserted_cart_block_id);
            $this->db->update('cart_block_users', $update_data);

            $where_param = array();
            $where_param['str_email'] = $email;
            $where_param['str_country_code'] = $country_code;
            $where_param['str_telephone'] = $telephone;

            $block_data = array();
            $block_data['int_block'] = 3;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            $this->comman_model->update_column("block_email_list", $where_param, $block_data);
        }

        if ($email_attempt > 3 && $sms_attempt > 3) {

            $result['result'] = 'fail';
            if ($cart_email_confirm_status == 1) {
                $result['email_attempt'] = 0;
                $result['sms_attempt'] = $sms_attempt;
            } else if ($cart_sms_confirm_status == 1) {
                $result['email_attempt'] = $email_attempt;
                $result['sms_attempt'] = 0;
            } else {
                $result['email_attempt'] = $email_attempt;
                $result['sms_attempt'] = $sms_attempt;
            }

            $result['email'] = $email;
            $result['telephone'] = $final_telephone;
            $result['cart_email_confirm_status'] = $cart_email_confirm_status;
            $result['cart_sms_confirm_status'] = $cart_sms_confirm_status;

            $sessiondata = array(
                'cart_email_attempt' => 0,
                'cart_sms_attempt' => 0,
            );
            $this->session->set_userdata($sessiondata);
        } else if ($email_attempt > 3) {
            $block_info = $this->comman_model->get_row("block_email_list", '*', $where_param);
            $insert_data = array();
            $insert_data['int_id'] = $block_info[0]->int_id;
            $insert_data['int_errors'] = $block_info[0]->int_errors;
            $insert_data['email_int_sents'] = $block_info[0]->email_int_sents;
            $insert_data['int_block'] = 3;
            $insert_data['dte_block'] = date("Y-m-d H:i:s", time());
            $insert_data['str_code'] = $block_info[0]->str_code;
            $insert_data['str_email'] = $email;
            $insert_data['str_applicant'] = $salutation . ' ' . $name;
            $insert_data['str_country'] = $country;
            $insert_data['str_ip_address'] = $_SERVER['REMOTE_ADDR'];
            $insert_data['region'] = "Cart";
            if ($this->input->post('timezone') != '') {
                $insert_data['timezone'] = trim($this->security->xss_clean($this->input->post('timezone')));
            } else {
                $insert_data['timezone'] = trim($this->security->xss_clean($this->input->post('block_timezone')));
            }
            $this->db->insert('cart_block_emails', $insert_data);

            $result['result'] = 'fail';
            if ($cart_sms_confirm_status == 1) {
                $result['email_attempt'] = $email_attempt;
                $result['sms_attempt'] = 0;
            } else {
                $result['email_attempt'] = $email_attempt;
                $result['sms_attempt'] = $sms_attempt;
            }

            $result['email'] = $email;
            $result['telephone'] = $final_telephone;
            $result['cart_email_confirm_status'] = $cart_email_confirm_status;
            $result['cart_sms_confirm_status'] = $cart_sms_confirm_status;
            $sessiondata = array(
                'cart_email_attempt' => 0,
            );
            $this->session->set_userdata($sessiondata);
        } else if ($sms_attempt > 3) {
            $block_info = $this->comman_model->get_row("block_email_list", '*', $where_param);
            $insert_data = array();
            $insert_data['int_id'] = $block_info[0]->int_id;
            $insert_data['int_errors'] = $block_info[0]->int_errors;
            $insert_data['sms_int_sents'] = $block_info[0]->sms_int_sents;
            $insert_data['int_block'] = 3;
            $insert_data['dte_block'] = date("Y-m-d H:i:s", time());
            $insert_data['str_sms_code'] = $block_info[0]->str_sms_code;
            $insert_data['str_applicant'] = $salutation . ' ' . $name;
            $insert_data['str_country'] = $country;
            $insert_data['str_ip_address'] = $_SERVER['REMOTE_ADDR'];
            $insert_data['str_country_code'] = $country_code;
            $insert_data['str_telephone'] = $telephone;
            $insert_data['region'] = "Cart";
            if ($this->input->post('timezone') != '') {
                $insert_data['timezone'] = trim($this->security->xss_clean($this->input->post('timezone')));
            } else {
                $insert_data['timezone'] = trim($this->security->xss_clean($this->input->post('block_timezone')));
            }
            $this->db->insert('cart_block_phones', $insert_data);

            $result['result'] = 'fail';
            if ($cart_email_confirm_status == 1) {
                $result['email_attempt'] = 0;
                $result['sms_attempt'] = $sms_attempt;
            } else {
                $result['email_attempt'] = $email_attempt;
                $result['sms_attempt'] = $sms_attempt;
            }

            $result['email'] = $email;
            $result['telephone'] = $final_telephone;
            $result['cart_email_confirm_status'] = $cart_email_confirm_status;
            $result['cart_sms_confirm_status'] = $cart_sms_confirm_status;
            $sessiondata = array(
                'cart_sms_attempt' => 0,
            );
            $this->session->set_userdata($sessiondata);
        } else {
            $sel_param = "*";
            $whr_param['str_email'] = $email;
            $whr_param['str_country_code'] = $country_code;
            $whr_param['str_telephone'] = $telephone;
            $bdata = $this->comman_model->get_row("block_email_list", $sel_param, $whr_param);
            $validphone = '';
            if (isset($cart_email_confirm_status) && $cart_email_confirm_status == 1 && isset($cart_sms_confirm_status) && $cart_sms_confirm_status == 1) {
                $cart_randomString = $bdata[0]->str_code;
                $sms_randomString = $bdata[0]->str_sms_code;
                $result['validphone'] = 1;
                $result['validemail'] = 1;
            } else if (isset($cart_email_confirm_status) && $cart_email_confirm_status == 1) {
                $cart_randomString = $bdata[0]->str_code;
                if (ENVIRONMENT == "production") {
                    $validphone = validatePhone($sms_telephone);
                    if ($validphone) {
                        sentSmsCode($sms_randomString, $sms_telephone, $country_code);
                        $result['validemail'] = 1;
                        $result['validphone'] = 1;
                        $result['block_step'] = 1;
                    } else {
                        $blocked = array();
                        $blocked['phone_blocked'] = '1';
                        $whr_param['str_email'] = $email;
                        $whr_param['str_country_code'] = $country_code;
                        $whr_param['str_telephone'] = $telephone;
                        $this->comman_model->update_column("block_email_list", $whr_param, $blocked);

                        $result['validemail'] = 1;
                        $result['validphone'] = 0;
                        $result['block_step'] = 2;
                    }
                } else {
                    $result['validemail'] = 1;
                    $result['validphone'] = 1;
                    $result['block_step'] = 1;
                }
            } else if (isset($cart_sms_confirm_status) && $cart_sms_confirm_status == 1) {
                $sms_randomString = $bdata[0]->str_sms_code;
                $validphone = 1;
                if (ENVIRONMENT == "production") {
                    $validemail = sentEmailCode($cart_randomString, $email, $final_telephone, $name, $email_attempt, $cart_sms_confirm_status, $validphone, 'cart');
                } else {
                    $validemail = 1;
                }

                if ($validemail) {
                    $result['validemail'] = 1;
                    $result['validphone'] = 1;
                    $result['block_step'] = 1;
                } else {
                    $blocked = array();
                    $blocked['email_blocked'] = '1';
                    $whr_param['str_email'] = $email;
                    $whr_param['str_country_code'] = $country_code;
                    $whr_param['str_telephone'] = $telephone;
                    $this->comman_model->update_column("block_email_list", $whr_param, $blocked);

                    $result['validemail'] = 0;
                    $result['validphone'] = 1;
                    $result['block_step'] = 2;
                }
            } else {
                $result['validphone'] = 1;
                if (ENVIRONMENT == "production") {
                    $validphone = validatePhone($sms_telephone);
                    if ($validphone) {
                        sentSmsCode($sms_randomString, $sms_telephone, $country_code);
                        $result['validphone'] = 1;
                    } else {
                        $blocked = array();
                        $blocked['phone_blocked'] = '1';
                        $whr_param['str_email'] = $email;
                        $whr_param['str_country_code'] = $country_code;
                        $whr_param['str_telephone'] = $telephone;
                        $this->comman_model->update_column("block_email_list", $whr_param, $blocked);
                        $result['validphone'] = 0;
                    }
                }

                if (ENVIRONMENT == "production") {
                    $validemail = sentEmailCode($cart_randomString, $email, $final_telephone, $name, $email_attempt, $cart_sms_confirm_status, $validphone, 'cart');
                } else {
                    $validemail = 1;
                }

                if ($validemail) {
                    $result['validemail'] = 1;
                } else {
                    $blocked = array();
                    $blocked['email_blocked'] = '1';
                    $whr_param['str_email'] = $email;
                    $whr_param['str_country_code'] = $country_code;
                    $whr_param['str_telephone'] = $telephone;
                    $this->comman_model->update_column("block_email_list", $whr_param, $blocked);
                    $result['validemail'] = 0;
                }
            }

            $session_data = array(
                'cart_randomString' => $cart_randomString,
                'sms_randomString' => $sms_randomString,
            );
            $this->session->set_userdata($session_data);

            $where_param = array();
            $where_param['str_email'] = $email;
            $where_param['str_country_code'] = $country_code;
            $where_param['str_telephone'] = $telephone;
            $select_param = array('email_int_sents' => 'email_int_sents', 'sms_int_sents' => 'sms_int_sents');
            $block_info = $this->comman_model->get_row("block_email_list", $select_param, $where_param);

            $block_data = array();
            if ($cart_email_confirm_status != 1) {
                $block_data['email_int_sents'] = $block_info[0]->email_int_sents + 1;
            }
            if ($cart_sms_confirm_status != 1) {
                $block_data['sms_int_sents'] = $block_info[0]->sms_int_sents + 1;
            }
            $block_data['str_code'] = $cart_randomString;
            $block_data['str_sms_code'] = $sms_randomString;
            $this->comman_model->update_column("block_email_list", $where_param, $block_data);

            $result['result'] = 'true';
            $result['email_attempt'] = $email_attempt;
            $result['sms_attempt'] = $sms_attempt;
            $result['email'] = $email;
            $result['telephone'] = $final_telephone;
            $result['cart_email_confirm_status'] = $cart_email_confirm_status;
            $result['cart_sms_confirm_status'] = $cart_sms_confirm_status;

            $sessiondata = array(
                'cart_email_attempt' => $email_attempt,
                'cart_sms_attempt' => $sms_attempt,
            );
            $this->session->set_userdata($sessiondata);
        }

        $carttimedata = $this->get_cart_pop_time();
        $result["cart_popup_timer"] = $carttimedata["cart_popup_timer"];
        $result["cart_popup_msg"] = $carttimedata["cart_popup_msg"];
        $result['cart_preview_timer'] = $carttimedata["cart_preview_timer"];

        echo json_encode($result);
        exit;
    }

    /**
     * updatedcart
     *
     * This Function is used to update cart products   comment, quantity in the session. This is child function of the save_cart_data .
     * @return void
     */
    public function updatedcart()
    {
        $product_ids = $this->security->xss_clean($this->input->post('product_id'));
        $product_item_dropdown = $this->security->xss_clean($this->input->post('product_item_dropdown'));
        $product_item_model_dropdown = $this->security->xss_clean($this->input->post('product_item_model_dropdown'));
        $quantity = $this->security->xss_clean($this->input->post('quantity'));
        $comments = $this->security->xss_clean($this->input->post('comment'));
        $update = $this->security->xss_clean($this->input->post('update'));
        $cart = $this->session->userdata('cart');

        $quantity = ($quantity < 1 ? 1 : $quantity);

        $cart = cartCleanUp($cart);
        $cart_selected_dropdowns = array();
        if (count($cart) > 0) {
            // This code read each product from cart session and update its quantity and comments in the session.
            foreach ($cart as $key => $value) {
                if ($quantity[$key] > 0) {
                    // $cart[$key]['dropdowns'] = $product_item_dropdown[$key];
                    // $cart_selected_dropdowns[$key]['dropdowns'] = $product_item_dropdown[$key];

                    // $cart[$key]['model']['dropdowns'] = $product_item_model_dropdown[$key];
                    // $cart_selected_dropdowns[$key]['model']['dropdowns'] = $product_item_model_dropdown[$key];

                    $cart[$key]['comment'] = $comments[$key];
                    $cart[$key]['quantity'] = $quantity[$key];
                } else {
                    // if quanity of a product is 0 or less than 1 than that item this code remove the session
                    unset($cart[$key]);
                }
            }
        }
        // these functions update session variables
        $this->session->set_userdata('cart', $cart);
        $this->session->set_userdata('cart_selected_dropdowns', $cart_selected_dropdowns);
        $this->session->set_userdata('new_cart', $cart);
    }

    /**
     * addtocart
     *
     *  This function  Add  Product in the cart using product id.
     * @return void
     */
    public function addtocart()
    {
        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction'), $this->lang->default_lang_id);
        $selection_instruction = (object) $userLangData['selection_instruction'];
        $general_instruction = (object) $userLangData['general_instruction'];

        $product_ids = $this->security->xss_clean($this->input->post('product_id'));
        $product_item_dropdown = $this->security->xss_clean($this->input->post('product_item_dropdown'));
        $product_item_model_dropdown = $this->security->xss_clean($this->input->post('product_item_model_dropdown'));

        $quantity = $this->config->item('product_minimumquantity');
        $update = $this->security->xss_clean($this->input->post('update'));
        $productcount = 0;
        
        $cart = $this->session->userdata('cart');
        $cartcount = is_array($cart) ? count($cart) : 0;

        $cart_products = array();
        $cart_selected_dropdowns = array();
        if (is_array($product_ids)) {
            foreach ($product_ids as $product_id) {
                $current_product_item_dropdown = false;

                if (is_array($product_item_dropdown) and isset($product_item_dropdown[$product_id])) {
                    $current_product_item_dropdown = $product_item_dropdown[$product_id];
                    $cartitems['dropdowns'] = $current_product_item_dropdown;
                    $cart_selected_dropdowns[$product_id]['dropdowns'] = $current_product_item_dropdown;
                }

                if (is_array($product_item_model_dropdown) and isset($product_item_model_dropdown[$product_id])) {
                    $cartitems['model']['dropdowns'] = $product_item_model_dropdown[$product_id];
                    $cart_selected_dropdowns[$product_id]['model']['dropdowns'] = $product_item_model_dropdown[$product_id];
                }

                if ($update == 1) {
                    // $cartitems['quantity'] = $quantity;
                } else {
                    if ((isset($cart[$product_id])) && ($cart[$product_id] != "")) {

                        $cartitems['quantity'] = $cart[$product_id]['quantity'];
                        $cartitems['comment'] = $cart[$product_id]['comment'];
                    } else {
                        if ($cartcount < getenv('CART_NUMBER')) {
                            // $cartitems['quantity'] = $quantity;
                            $cartitems['comment'] = "";
                            $cart_products[] = $this->product_model->getProductNameById($product_id);
                            $productcount++;
                        }
                    }
                }
                $cartitems['item_id'] = $product_id;

                if ($cartcount < getenv('CART_NUMBER')) {
                    $cart[$product_id] = $cartitems;
                }
            }
        }

        $session_data = array(
            'cart' => $cart,
            'cart_selected_dropdowns' => $cart_selected_dropdowns,
        );

        $this->session->set_userdata($session_data);
        $i = 1;
        $refname = '';
        $and_phrase = $general_instruction->and_text;
        foreach ($cart_products as $productname) {
            if ($refname != '') {
                if ($i == $productcount) {
                    $refname .= " " . $and_phrase . " ";
                } else {
                    $refname .= ', ';
                }

            }
            $refname .= $productname;
            $i++;
        }
        $msg = $this->session->userdata('cart_msg');
        $i = $i - 1;

        $phrase = ($productcount > 1 ? $general_instruction->are_text : $general_instruction->is_text);
        $phrase1 = ($productcount > 1 ? $general_instruction->items : $general_instruction->item);
        $phrase2 = ($productcount > 1 ? $general_instruction->these : $general_instruction->this);
        $phrase3 = ($productcount > 1 ? $general_instruction->them : $general_instruction->it);
        $new_msg = '';
        if ($i) {
            $new_msg = $selection_instruction->addtocart_msg;
            $new_msg = preg_replace('/\bITEMNUMBER\b/', $i, $new_msg);
            $new_msg = preg_replace('/\bPHRASE\b/', $phrase, $new_msg);
            $new_msg = preg_replace('/\bPHRASEITEM\b/', $phrase1, $new_msg);
            $new_msg = preg_replace('/\bPHRASETHIS\b/', $phrase2, $new_msg);
            $new_msg = preg_replace("/\bPHRASEIT\b/", $phrase3, $new_msg);
            $new_msg = preg_replace("/\bREFNAME\b/", $refname, $new_msg);
        }
        echo $msg . $new_msg;
    }

    /**
     * removecart
     *
     * This function  remove Product from  the cart using product id.
     * @return void
     */
    public function removecart()
    {
        $product_id = $this->security->xss_clean($this->input->post('id'));
        // read  cart items array from the session
        $cart = $this->session->userdata('cart');
        // remove product id  from the session
        unset($cart[$product_id]);
        // update cart session again after removing
        $this->session->unset_userdata('cart');
        $this->session->set_userdata('cart', $cart);
        $this->session->set_userdata('new_cart', $cart);
    }

    /**
     * cart_blockedemail_check
     *
     * This Function validate the email and phone both are blocked or not.
     * @param  mixed $email
     * @return void
     */
    public function cart_blockedemail_check($email = '')
    {
        $result = array();
        $postData = $this->input->post();
        if (count($postData) > 0) {
            $email = $this->security->xss_clean($this->input->post('email'));
            $country_code = str_replace('+', '', $this->security->xss_clean($this->input->post('country_code')));
            $telephone = trim($this->security->xss_clean($this->input->post('telephone')));

            if ($email && $country_code && $telephone) {

                $old_cartblock_emails = array();

                $session_data = $this->session->userdata('cart_users_data');
                if (count($session_data) > 0) {
                    $where_param = array(
                        'str_email' => $session_data['email'],
                        'str_country_code' => $session_data['country_code'],
                        'str_telephone' => $session_data['telephone'],
                    );
                    $select_param = "*";
                    $old_cartblock_emails = $this->comman_model->get_row("block_email_list", $select_param, $where_param);
                }

                $where_param = array(
                    'email' => $email,
                    'country_code' => $country_code,
                    'telephone' => $telephone,
                );
                $select_param = "*";
                $block_emails = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);

                if (count($old_cartblock_emails) > 0 && count($block_emails) == 0) {
                    $where_param = array();
                    $where_param['str_email'] = $cart_email->str_email;
                    $where_param['str_country_code'] = $cart_email->str_country_code;
                    $where_param['str_telephone'] = $cart_email->str_telephone;
                    $this->comman_model->delete_row("block_email_list", $where_param);
                    $result['result'] = 'success';
                    echo json_encode($result);
                    exit;
                }

                $where_param = array(
                    'email' => $email,
                );
                $select_param = "*";
                $blockemail_info = $this->comman_model->get_row("entry_door_block_emails", $select_param, $where_param);

                $where_param = array(
                    'country_code' => $country_code,
                    'telephone' => $telephone,
                );
                $select_param = "*";
                $blockphone_info = $this->comman_model->get_row("entry_door_block_phones", $select_param, $where_param);

                $where_param = array(
                    'str_email' => $session_data['email'],
                    'str_country_code' => $session_data['country_code'],
                    'str_telephone' => $session_data['telephone'],
                );
                $select_param = "*";
                $cart_blocks = $this->comman_model->get_row("block_email_list", $select_param, $where_param);

                $where_param = array(
                    'str_email' => $session_data['email'],
                );
                $select_param = "*";
                $cartblockemail_info = $this->comman_model->get_row("cart_block_emails", $select_param, $where_param);

                $where_param = array(
                    'str_country_code' => $session_data['country_code'],
                    'str_telephone' => $session_data['telephone'],
                );
                $select_param = "*";
                $cartblockphone_info = $this->comman_model->get_row("cart_block_phones", $select_param, $where_param);

                $cart_timer = (object) get_user_lang_data(array('cart_timer'), $this->lang->default_lang_id, 'cart_block_timer')['cart_timer'];
                $blockdoortime = '-' . $cart_timer->cart_block_timer . ' minute';

                if (!empty($block_emails)) {
                    foreach ($block_emails as $each_email) {
                        $date = date("Y-m-d H:i:s", time());
                        $datelimit = strtotime($blockdoortime, strtotime($date));
                        $datelimit = date("Y-m-d H:i:s", $datelimit);

                        if (isset($each_email->dte_block) && $each_email->dte_block != '' && $datelimit > $each_email->dte_block) {
                            $where_param = array();
                            $where_param['email'] = $each_email->email;
                            $where_param['country_code'] = $each_email->country_code;
                            $where_param['telephone'] = $each_email->telephone;
                            $this->comman_model->delete_row("entry_door_front_block_data", $where_param);
                            $result['result'] = 'success';
                        } else {
                            $block = strtotime($each_email->dte_block);
                            $check_time_block = $cart_timer->cart_block_timer - intval(((time() - $block) / 60));
                            $region = $each_email->region;

                            if ($each_email->entry_email_confirm != 1 && $each_email->entry_sms_confirm != 1 && $each_email->dte_block != '') {
                                $result['result'] = 'fail';
                                $result['error'] = 'all';
                                $result['check_time_block'] = $check_time_block;
                                $result['region'] = $region;
                                $result['email'] = $each_email->email;
                                $result['telephone'] = '+' . $each_email->country_code . ' ' . $each_email->telephone;
                            } else if ($each_email->entry_email_confirm != 1 && $each_email->dte_block != '') {
                                $result['result'] = 'fail';
                                $result['error'] = 'email';
                                $result['check_time_block'] = $check_time_block;
                                $result['region'] = $region;
                                $result['email'] = $each_email->email;
                                $result['telephone'] = '';
                            } else if ($each_email->entry_sms_confirm != 1 && $each_email->dte_block != '') {
                                $result['result'] = 'fail';
                                $result['error'] = 'sms';
                                $result['check_time_block'] = $check_time_block;
                                $result['region'] = $region;
                                $result['email'] = '';
                                $result['telephone'] = '+' . $each_email->country_code . ' ' . $each_email->telephone;
                            } else {
                                $result['result'] = 'success';
                            }
                        }
                    }
                } else if (!empty($blockemail_info) && !empty($blockphone_info)) {
                    $date = date("Y-m-d H:i:s", time());
                    $datelimit = strtotime($blockdoortime, strtotime($date));
                    $datelimit = date("Y-m-d H:i:s", $datelimit);

                    if (isset($blockemail_info[0]->dte_block) && $blockemail_info[0]->dte_block != '' && $datelimit > $blockemail_info[0]->dte_block) {
                        $where_param = array();
                        $where_param['email'] = $blockemail_info[0]->email;
                        $this->comman_model->delete_row("entry_door_block_emails", $where_param);

                        $where_param = array();
                        $where_param['country_code'] = $blockphone_info[0]->country_code;
                        $where_param['telephone'] = $blockphone_info[0]->telephone;
                        $this->comman_model->delete_row("entry_door_block_phones", $where_param);
                        $result['result'] = 'success';
                    } else {
                        $block = strtotime($blockemail_info[0]->dte_block);
                        $check_time_block = $cart_timer->cart_block_timer - intval(((time() - $block) / 60));
                        $region = "Front Door";
                        if (!empty($old_cartblock_emails)) {
                            if ($old_cartblock_emails[0]->entry_email_confirm != 1 && $old_cartblock_emails[0]->entry_sms_confirm != 1) {
                                $result['result'] = 'fail';
                                $result['error'] = 'all';
                                $result['check_time_block'] = $check_time_block;
                                $result['region'] = $region;
                                $result['email'] = $blockemail_info[0]->email;
                                $result['telephone'] = '+' . $blockphone_info[0]->country_code . ' ' . $blockphone_info[0]->telephone;
                            } else if ($old_cartblock_emails[0]->entry_email_confirm != 1) {
                                $result['result'] = 'fail';
                                $result['error'] = 'email';
                                $result['check_time_block'] = $check_time_block;
                                $result['region'] = $region;
                                $result['email'] = $blockemail_info[0]->email;
                                $result['telephone'] = '';
                            } else if ($old_block_phone[0]->entry_sms_confirm != 1) {
                                $result['result'] = 'fail';
                                $result['error'] = 'sms';
                                $result['check_time_block'] = $check_time_block;
                                $result['region'] = $region;
                                $result['email'] = '';
                                $result['telephone'] = '+' . $blockphone_info[0]->country_code . ' ' . $blockphone_info[0]->telephone;
                            } else {
                                $result['result'] = 'success';
                            }
                        } else {
                            $result['result'] = 'success';
                        }
                    }
                } else if (!empty($blockemail_info)) {
                    $date = date("Y-m-d H:i:s", time());
                    $datelimit = strtotime($blockdoortime, strtotime($date));
                    $datelimit = date("Y-m-d H:i:s", $datelimit);

                    if (isset($blockemail_info[0]->dte_block) && $blockemail_info[0]->dte_block != '' && $datelimit > $blockemail_info[0]->dte_block) {
                        $where_param = array();
                        $where_param['email'] = $blockemail_info[0]->email;
                        $this->comman_model->delete_row("entry_door_block_emails", $where_param);
                        $result['result'] = 'success';
                    } else {
                        $block = strtotime($blockemail_info[0]->dte_block);
                        $check_time_block = $cart_timer->cart_block_timer - intval(((time() - $block) / 60));
                        $region = "Front Door";
                        if ($old_cartblock_emails[0]->entry_email_confirm != 1) {
                            $result['result'] = 'fail';
                            $result['error'] = 'email';
                            $result['check_time_block'] = $check_time_block;
                            $result['region'] = $region;
                            $result['email'] = $blockemail_info[0]->email;
                            $result['telephone'] = '';
                        } else {
                            $result['result'] = 'success';
                        }
                    }
                } else if (!empty($blockphone_info)) {
                    $date = date("Y-m-d H:i:s", time());
                    $datelimit = strtotime($blockdoortime, strtotime($date));
                    $datelimit = date("Y-m-d H:i:s", $datelimit);

                    if (isset($blockphone_info[0]->dte_block) && $blockphone_info[0]->dte_block != '' && $datelimit > $blockphone_info[0]->dte_block) {
                        $where_param = array();
                        $where_param['country_code'] = $blockphone_info[0]->country_code;
                        $where_param['telephone'] = $blockphone_info[0]->telephone;
                        $this->comman_model->delete_row("entry_door_block_phones", $where_param);
                        $result['result'] = 'success';
                    } else {
                        $block = strtotime($blockphone_info[0]->dte_block);
                        $check_time_block = $cart_timer->cart_block_timer - intval(((time() - $block) / 60));
                        $region = "Front Door";

                        if ($old_cartblock_emails[0]->entry_sms_confirm != 1) {
                            $result['result'] = 'fail';
                            $result['error'] = 'sms';
                            $result['check_time_block'] = $check_time_block;
                            $result['region'] = $region;
                            $result['email'] = '';
                            $result['telephone'] = '+' . $blockphone_info[0]->country_code . ' ' . $blockphone_info[0]->telephone;
                        } else {
                            $result['result'] = 'success';
                        }
                    }
                } else if (!empty($cart_blocks)) {
                    foreach ($cart_blocks as $cart_email) {
                        $date = date("Y-m-d H:i:s", time());
                        $datelimit = strtotime($blockdoortime, strtotime($date));
                        $datelimit = date("Y-m-d H:i:s", $datelimit);

                        if (isset($cart_email->dte_block) && $cart_email->dte_block != '' && $datelimit > $cart_email->dte_block) {
                            $where_param = array();
                            $where_param['str_email'] = $cart_email->str_email;
                            $where_param['str_country_code'] = $cart_email->str_country_code;
                            $where_param['str_telephone'] = $cart_email->str_telephone;
                            $this->comman_model->delete_row("block_email_list", $where_param);
                            $result['result'] = 'success';
                        } else {
                            $block = strtotime($cart_email->dte_block);
                            $check_time_block = $cart_timer->cart_block_timer - intval(((time() - $block) / 60));
                            $region = $cart_email->region;

                            if ($cart_email->cart_email_confirm != 1 && $cart_email->cart_sms_confirm != 1 && $cart_email->dte_block != '') {
                                $result['result'] = 'fail';
                                $result['error'] = 'all';
                                $result['check_time_block'] = $check_time_block;
                                $result['region'] = $region;
                                $result['email'] = $cart_email->str_email;
                                $result['telephone'] = '+' . $cart_email->str_country_code . ' ' . $cart_email->str_telephone;
                            } else if ($cart_email->cart_email_confirm != 1 && $cart_email->dte_block != '') {
                                $result['result'] = 'fail';
                                $result['error'] = 'email';
                                $result['check_time_block'] = $check_time_block;
                                $result['region'] = $region;
                                $result['email'] = $cart_email->str_email;
                                $result['telephone'] = '';
                            } else if ($cart_email->cart_sms_confirm != 1 && $cart_email->dte_block != '') {
                                $result['result'] = 'fail';
                                $result['error'] = 'sms';
                                $result['check_time_block'] = $check_time_block;
                                $result['region'] = $region;
                                $result['email'] = '';
                                $result['telephone'] = '+' . $cart_email->str_country_code . ' ' . $cart_email->str_telephone;
                            } else {
                                $result['result'] = 'success';
                            }
                        }
                    }
                } else if (!empty($cartblockemail_info) && !empty($cartblockphone_info)) {
                    $date = date("Y-m-d H:i:s", time());
                    $datelimit = strtotime($blockdoortime, strtotime($date));
                    $datelimit = date("Y-m-d H:i:s", $datelimit);

                    if (isset($cartblockemail_info[0]->dte_block) && $cartblockemail_info[0]->dte_block != '' && $datelimit > $cartblockemail_info[0]->dte_block) {
                        $where_param = array();
                        $where_param['email'] = $cartblockemail_info[0]->str_email;
                        $this->comman_model->delete_row("cart_block_emails", $where_param);

                        $where_param = array();
                        $where_param['country_code'] = $cartblockphone_info[0]->str_country_code;
                        $where_param['telephone'] = $cartblockphone_info[0]->str_telephone;
                        $this->comman_model->delete_row("cart_block_phones", $where_param);
                        $result['result'] = 'success';
                    } else {
                        $block = strtotime($cartblockemail_info[0]->dte_block);
                        $check_time_block = $cart_timer->cart_block_timer - intval(((time() - $block) / 60));
                        $region = "Cart";

                        if ($old_cartblock_emails[0]->entry_email_confirm != 1 && $old_cartblock_emails[0]->entry_sms_confirm != 1) {
                            $result['result'] = 'fail';
                            $result['error'] = 'all';
                            $result['check_time_block'] = $check_time_block;
                            $result['region'] = $region;
                            $result['email'] = $cartblockemail_info[0]->str_email;
                            $result['telephone'] = '+' . $cartblockphone_info[0]->str_country_code . ' ' . $cartblockphone_info[0]->str_telephone;
                        } else if ($old_cartblock_emails[0]->entry_email_confirm != 1) {
                            $result['result'] = 'fail';
                            $result['error'] = 'email';
                            $result['check_time_block'] = $check_time_block;
                            $result['region'] = $region;
                            $result['email'] = $cartblockemail_info[0]->str_email;
                            $result['telephone'] = '';
                        } else if ($old_block_phone[0]->entry_sms_confirm != 1) {
                            $result['result'] = 'fail';
                            $result['error'] = 'sms';
                            $result['check_time_block'] = $check_time_block;
                            $result['region'] = $region;
                            $result['email'] = '';
                            $result['telephone'] = '+' . $cartblockphone_info[0]->str_country_code . ' ' . $cartblockphone_info[0]->str_telephone;
                        } else {
                            $result['result'] = 'success';
                        }
                    }
                } else if (!empty($cartblockemail_info)) {
                    $date = date("Y-m-d H:i:s", time());
                    $datelimit = strtotime($blockdoortime, strtotime($date));
                    $datelimit = date("Y-m-d H:i:s", $datelimit);

                    if (isset($cartblockemail_info[0]->dte_block) && $cartblockemail_info[0]->dte_block != '' && $datelimit > $cartblockemail_info[0]->dte_block) {
                        $where_param = array();
                        $where_param['str_email'] = $cartblockemail_info[0]->str_email;
                        $this->comman_model->delete_row("cart_block_emails", $where_param);
                        $result['result'] = 'success';
                    } else {
                        $block = strtotime($cartblockemail_info[0]->dte_block);
                        $check_time_block = $cart_timer->cart_block_timer - intval(((time() - $block) / 60));
                        $region = "Cart";
                        if ($old_cartblock_emails[0]->entry_email_confirm != 1) {
                            $result['result'] = 'fail';
                            $result['error'] = 'email';
                            $result['check_time_block'] = $check_time_block;
                            $result['region'] = $region;
                            $result['email'] = $cartblockemail_info[0]->str_email;
                            $result['telephone'] = '';
                        } else {
                            $result['result'] = 'success';
                        }
                    }
                } else if (!empty($cartblockphone_info)) {
                    $date = date("Y-m-d H:i:s", time());
                    $datelimit = strtotime($blockdoortime, strtotime($date));
                    $datelimit = date("Y-m-d H:i:s", $datelimit);

                    if (isset($cartblockphone_info[0]->dte_block) && $cartblockphone_info[0]->dte_block != '' && $datelimit > $cartblockphone_info[0]->dte_block) {
                        $where_param = array();
                        $where_param['str_country_code'] = $cartblockphone_info[0]->str_country_code;
                        $where_param['str_telephone'] = $cartblockphone_info[0]->str_telephone;
                        $this->comman_model->delete_row("cart_block_phones", $where_param);
                        $result['result'] = 'success';
                    } else {
                        $block = strtotime($cartblockphone_info[0]->dte_block);
                        $check_time_block = $cart_timer->cart_block_timer - intval(((time() - $block) / 60));
                        $region = "Cart";

                        if ($old_cartblock_emails[0]->entry_sms_confirm != 1) {
                            $result['result'] = 'fail';
                            $result['error'] = 'sms';
                            $result['check_time_block'] = $check_time_block;
                            $result['region'] = $region;
                            $result['email'] = '';
                            $result['telephone'] = '+' . $cartblockphone_info[0]->str_country_code . ' ' . $cartblockphone_info[0]->str_telephone;
                        } else {
                            $result['result'] = 'success';
                        }
                    }
                } else {
                    $result['result'] = 'success';
                }
            }
        }
        echo json_encode($result);
        exit;
    }

    /**
     * get_cart_pop_time
     *
     * This Function return cart pop up, preview Timer and its related messages.
     * @return array
     */
    public function get_cart_pop_time()
    {
        // This Function return cart timer  values from the database table cart_timer
        $cart_timer = (object) get_user_lang_data(array('cart_timer'), $this->lang->default_lang_id)['cart_timer'];
        // Reformat the timer and message and return as array
        $cart_pop_info["cart_popup_timer"] = $cart_timer->cart_popup_timer * 60;
        $cart_pop_info["cart_popup_msg"] = $cart_timer->cart_popup_msg;
        $cart_pop_info['cart_preview_timer'] = $cart_timer->cart_preview_timer * 60;
        return $cart_pop_info;
    }

    /**
     * make_user_block
     *
     * This function called when user cart time is over and  user open the cart page in another window at that time timer popup is appreared and it redirects  user on this function.
     * @return void
     */
    public function make_user_block()
    {
        $session_data = $this->session->userdata('cart_users_data');
        $email = $session_data['email'];
        $where_param = array('email' => $email);
        // Delete users entry from cart_block_users using email id of user from session
        $this->comman_model->delete_row("cart_block_users", $where_param);

        $where_param = array('str_email' => $email);
        // Delete users entry from block_email_list using email id of user from session
        $this->comman_model->delete_row("block_email_list", $where_param);

        // This Function update the session variables
        $session_data_to_remove = array(
            'last_inserted_cart_block_id' => "",
            'edit_cart_mode' => 'false',
        );
        $this->session->set_userdata($session_data_to_remove);

        // This function redirect user to cart page.
        redirect("cart/index");
    }

    /**
     * getState
     * This Function return list of states for select dropdown  on the behalf of country id on the cart page.
     * @return void
     */
    public function getState()
    {
        // save country id and state in a seprate variabel after sanitizing the input values.
        $country = $this->security->xss_clean($this->input->post('country_id'));

        // This Function return list of states on the behalf of country
        $states = $this->cart_model->getState($country, $this->lang->default_lang_id);

        echo json_encode($states);
        exit;
    }

    /**
     * getShippingRates
     *
     * This Function get shiiping rate of the items when INCOTERMS  is DAP. on click of fetch shipping rate this code works.
     * @return void
     */
    public function getShippingRates()
    {

        $cart_users_data = $this->input->post();
       
        $this->load->model("package_model");
        $packages = $this->package_model->getPackageData($this->lang->default_lang_id);
        $all_data = allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country'));

       
        $cart_users_data = $this->security->xss_clean($cart_users_data);
        // echo '<pre>';print_r($cart_users_data);print_r($this->session);exit;

        // Box Data to pass with array
        if (isset($cart_users_data['ship_with_freight'])) {
            $ship_with_freight = $cart_users_data['ship_with_freight'];
        } else {
            $ship_with_freight = 0;
        }
        $package_both_box_count = $this->session->userdata('package_both_box_count');
        $package_both_box = $this->session->userdata('package_both_box');
        $this->load->model("package_model");
        $boxes = $this->package_model->getboxData();

        $onlyPackageData = $this->package_model->onlyPackageData();
        $boxweight = array();
        $boxtype = array();

        foreach ($onlyPackageData as $singleboxw) {
            $boxweight[trim($singleboxw['package_code'])] = $singleboxw['emptyweight'];
            $boxtype[trim($singleboxw['package_code'])] = $singleboxw['package_type'];
        }

        $userLangData = get_user_lang_data(array('cart_instruction'), $this->lang->default_lang_id);
        $cart_instruction = (object) $userLangData['cart_instruction'];
        $data = array();

        // This code works when shipping information is different from the billing information
        if ($cart_users_data['billingShippingoptradio'] == '0') {
            $requiredParams = array('ship_title', 'ship_surname', 'ship_address_1', 'ship_city', 'ship_state', 'ship_zip', 'ship_country_flag');
            $form_validation_instruction = (object) get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];
            foreach ($requiredParams as $param) {
                if (!isset($cart_users_data[$param]) || empty($cart_users_data[$param])) {
                    $response = array('result' => 'fail', 'msg' => $form_validation_instruction->popup_title);
                    echo json_encode($response);
                    exit;
                }
            }
        } else if ($cart_users_data['billingShippingoptradio'] == '1') {
            // This code works when shipping information is similar to the billing information
            $requiredParams = array('salutation', 'surname', 'cart_address_1', 'cart_city', 'cart_state', 'cart_zip', 'cart_country_flag');
            $form_validation_instruction = (object) get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];
            foreach ($requiredParams as $param) {
                if (!isset($cart_users_data[$param]) || empty($cart_users_data[$param])) {
                    $response = array('result' => 'fail', 'msg' => $form_validation_instruction->popup_title);
                    echo json_encode($response);
                    exit;
                }
            }
            $cart_users_data['ship_title'] = $cart_users_data['salutation'];
            $cart_users_data['ship_surname'] = $cart_users_data['surname'];
            $cart_users_data['ship_address_1'] = $cart_users_data['cart_address_1'];
            $cart_users_data['ship_city'] = $cart_users_data['cart_city'];
            $cart_users_data['ship_state'] = $cart_users_data['cart_state'];
            $cart_users_data['ship_zip'] = $cart_users_data['cart_zip'];
            $cart_users_data['ship_country_flag'] = $cart_users_data['cart_country_flag'];
        }

        $cart = $this->session->userdata('new_cart');
        $cart = cartCleanUp($cart);
        $this->session->set_userdata('new_cart', $cart);
        
        if ($cart_users_data['ship_with_freight']=="0"){
            $cart_2 = [];
            foreach($cart as $key=>$val){
                foreach($cart_users_data['product_id'] as $k=>$v){
                    if($v==$key){
                        if($cart_users_data['frieght_package'][$k]=="1"){
                            $cart_2[$key] = $val; 
                            $cart[$key]['frieght_package'] = 1;
                        }else{
                            $cart[$key]['frieght_package'] = 0;
                        } 
                    }                                           
                }                                          
            }
        }else{
            foreach($cart as $key=>$val){
                unset($cart[$key]['frieght_package']);
            }
            $cart_2 = $cart;
        }
        $cart = cartCleanUp($cart);
        $this->session->set_userdata('new_cart', $cart);
        
        $cart = $cart_2;
        
        $cart_data = $cart;

        $cart_details = $this->product_model->get_cart_items($cart, $this->lang->default_lang_id);

        /*
         * Add items to be packed - e.g. from shopping cart stored in user session. Again, the dimensional information
         * (and keep-flat requirement) would normally come from a DB
         */
        $productsbynature = array();
        foreach ($cart_details as $order_detail) {
            
            $order_detail = (array) $order_detail;
            $productsbynature[$order_detail['item_nature_id']][] = $order_detail;
        }

        $general_instruction = (object) get_user_lang_data(array('general_instruction'), $this->lang->default_lang_id)['general_instruction'];

        $packedboxesdetails = array();
        $finalpackagedetails = array();
        $packeditems = array();

        // This Function make package data as per quantity package and product details and description to use on shipping label
        //echo '<pre>';print_r($productsbynature);exit;
        foreach ($productsbynature as $key => $value) {
            $box = 0;
            $count = 1;

            foreach ($value as $order_detail) {
                foreach($cart_users_data['quantity'][$order_detail['id']] as $store_id=>$quantity){
                    if($quantity>0){
                        // echo $quantity;
                        // echo '<pre>';print_r($cart_users_data['quantity'][$order_detail['id']]);echo '</pre>';
                        $ship_quantity = 0;
                        if ($order_detail['ship_quantity'] > $cart_users_data['quantity'][$order_detail['id']][$store_id]) {
                            $ship_quantity = $cart_users_data['quantity'][$order_detail['id']][$store_id];
                        } else {
                            $ship_quantity = $order_detail['ship_quantity'];
                        }

                        $availableQuantity = $order_detail['ship_quantity'];
                    
                        $userQuantity = $cart_users_data['quantity'][$order_detail['id']][$store_id];
                        if ($order_detail['backorder_status'] == 0) {
                            if ($availableQuantity > $userQuantity) {
                                $ship_quantity = $userQuantity;
                            } else if ($availableQuantity <= 0) {
                                $ship_quantity = 0;
                            } else if ($userQuantity > $availableQuantity) {
                                $ship_quantity = $availableQuantity;
                            }
                        } else if ($order_detail['backorder_status'] == 1) {
                            if ($availableQuantity > $userQuantity) {
                                $ship_quantity = $userQuantity;
                            } else if ($availableQuantity <= 0) {
                                $ship_quantity = $userQuantity;
                            } else if ($userQuantity > $availableQuantity) {
                                $ship_quantity = $availableQuantity;
                            }
                        }

                        $item_demsions = array(
                            'w' => ($order_detail['item_width']==0?9.00:$order_detail['item_width']),
                            'h' => ($order_detail['item_length']==0?12.00:$order_detail['item_length']),
                            'd' => ($order_detail['item_height']==0?6.5:$order_detail['item_height']),
                            'q' => $ship_quantity,
                            'vr' => '1',
                            'wg' => ($order_detail['item_weight']==0?0.4:$order_detail['item_weight']),
                            'id' => $order_detail['kgt_ref_number'],
                        );

                        if (!empty($order_detail['packageId'])) {

                            $all_box = explode(",", $order_detail['packageId']);
                            $all_box_store = $all_box;
                            $all_box = array();
                            foreach($all_box_store as $sb_key=>$sb_val){
                                $all_box[] = $sb_val.'-'.$store_id;
                            }
                            // echo '<pre>';print_r($all_box);echo '</pre>';
                            if (in_array($order_detail['kgt_ref_number'], $package_both_box) && $ship_with_freight == "0") {
                                foreach ($all_box as $singlebox) {
                                    if ($boxtype[trim($singlebox)] == "package") {                                        
                                        $item_box[] = $singlebox;
                                    }
                                }
                            } else {
                                $item_box = $all_box;
                            }
                        } else {
                            $item_box = array();
                        }
                        $item_demsions['acceptable_bins'] = $item_box;

                        $packeditems[] = $item_demsions;
                        // make items array
                        $boxes_loop = $boxes;
                        //$boxes = array ();
                        foreach ($boxes_loop as $box){
                            //echo '<pre>';print_r($box);echo '</pre>';
                            foreach ($packeditems as $packeditem){ 
                                //$box['id'] = $box['id'].'-'.$store_id;                       
                                if(in_array($box['id'].'-'.$store_id, $packeditem['acceptable_bins'])){  
                                    $box['id'] = $box['id'].'-'.$store_id;                                
                                    $boxes[] = $box;                    
                                }
                            }           
                        }
                    }
            }
            }
        }
        
        // This Function call the packing and return responce
        $this->load->library('Packing');
        $this->packing->addField('username', 'KondarSoft');
        $this->packing->addField('api_key', 'bf11d62ced488061319b68ec429eee87');
        $item_packed_color = $this->packing->hex2rgb($all_data['product_action_btn_bg_color']);
        $this->packing->addField('images_item_fill_color', $item_packed_color);
        $this->packing->addField('boxes', $boxes);

        //$packData['bins'] = $packData2['bins'];
        
        $store_wise_packed_items = $packeditems;
        
        $this->packing->addField('items', $store_wise_packed_items);        
        
        list($pack_resp, $packstatus) = $this->packing->processAPI();
		// echo '<pre>'; print_r($pack_resp); print_r($packstatus);exit;
        // If all items are packed than if condition will work else condition will work when any item is not packed.
        if (empty($pack_resp['response']['not_packed_items'])) {

            $boxtCount = 1;
            foreach ($pack_resp['response']['bins_packed'] as $box) {

                //print_r($box);
                $box_data = $box['bin_data'];
                $box_items = $box['items'];
                $finalpackagedetails[$boxtCount] = array(
                    'package_name' => $box_data['id'],
                    'weight' => $box_data['weight'],
                    'width' => $box_data['w'],
                    'length' => $box_data['h'],
                    'height' => $box_data['d'],
                );

                $finalpackagedetails[$boxtCount]['package_item_data'] = $box['items'];

                $box_display_weight = $box_data['weight'] + $boxweight[$box_data['id']];

                $string_box = '<h6><span>' . $cart_instruction->package_count . ' ' . $boxtCount . '.</span> ' . $box_data['id'] . ' , ' . $general_instruction->high_text . ' ' . $box_data['h'] . ' , ' . $general_instruction->wide_text . ' ' . $box_data['w'] . ' , ' . $general_instruction->long_text . ' ' . $box_data['d'] . ' ,  ' . $general_instruction->weight_text . ' ' . $box_display_weight;

                $string_box .= "<img class='mx-2' width='50' src=\"{$box['image_complete']}\"></h6>";

                $string_box .= '<h6>' . $cart_instruction->package_box_item . " " . $cart_instruction->package_count . " " . $boxtCount . " " . $box_data['id'] . '</h6>';

                $string_box .= '<div class="border table-responsive packageDetailtable w-100 float-start"> <table class="table m-0 w-100 float-start bg-white">
                <tr><th>' . $cart_instruction->package_head_item . '</th>
                <th>' . $cart_instruction->package_head_dimension . '</th>
                <th>' . $cart_instruction->package_head_weight . '</th>
                <th>' . $cart_instruction->package_head_seprate . '</th>
                <th>' . $cart_instruction->package_head_stepbystep . '</th></tr>';

                foreach ($box_items as $item) {
                    $string_box .= "<tr><td>{$item['id']}</td>
                    <td> {$item['d']} x {$item['w']} x {$item['h']}</td>
                    <td> {$item['wg']}</td>
                    <td><img  width='40' src=\"{$item['image_separated']}\"></td>
                    <td><img  width='40' src=\"{$item['image_sbs']}\"></td>
                </tr>";
                }
                $string_box .= '</table></div>';
                $string_box .= '<hr>';

                $packedboxesdetails[] = $string_box;

                $boxtCount++;
            }

            // echo '<pre>';print_r($finalpackagedetails);echo '</pre>';
            // echo "<br>";
            // print_r($packedboxesdetails);
            // exit;
            // hit api and get box as per items

            if ($cart_users_data['incoterms'] == 'DAP') {

                /* Package Dimension and Weight */
                $package = array();
                $this->session->set_userdata('package_data', $finalpackagedetails);
                // This Function read each package and set dimensions for each package to get shipping rates
                // echo '<pre>'; print_r($finalpackagedetails);echo '</pre>';exit;
                foreach ($finalpackagedetails as $key => $v) {
                    $original_package_name = $v['package_name'];
                    $package_store_id = 0;
                    if(count(explode("-",$v['package_name']))>0){
                        $arr_pkg_name = explode("-",$v['package_name']);
                        $original_package_name = $arr_pkg_name[0];
                        $package_store_id = $arr_pkg_name[1];
                    }
                    $currentpackage = array(
                        'weight' => $v['weight'] + $boxweight[$original_package_name],
                        'width' => $v['width'],
                        'length' => $v['length'],
                        'height' => $v['height'],
                        "package_type" => $boxtype[$original_package_name],
                        "package_name" => $v['package_name'],
                        'package_store_id' => $package_store_id
                    );
                    $package[] = $currentpackage;
                }
                $this->session->set_userdata('package_final', $package);
                // echo '<pre>';print_r($package);echo '</pre>';
                if ($cart_users_data['carrier_name'] == 'UPS') {
                    // get shipping rate when carrier is UPS
                    $sReponse = $this->getUpsShippingRate($cart_users_data, $package);
                } else if ($cart_users_data['carrier_name'] == 'ARAMEX') {
                    // get shipping rate when carrier is ARAMex
                    $sReponse = $this->getAramexShippingRate($cart_users_data, $package);
                } else if ($cart_users_data['carrier_name'] == 'FEDEX') {
                    // get shipping rate when carrier is Fedex
                    // print_r($package);exit;
                    $sReponse = $this->getFedexShippingRate($cart_users_data, $package);
                } else if ($cart_users_data['carrier_name'] == 'FREIGHTCOM') {
                    // get shipping rate when carrier is Fedex
                    $sReponse = $this->getFreightcomRate($cart_users_data, $package);
                }

                if ($sReponse['result'] == 'fail') {
                    // if rate functions return error than this code works
                    $data['result'] = 'fail';
		    $data['msg'] = $sReponse['msg'];
                } else {
                    // if rate function return success than this code work

                    $packedboxes = '';
                    // This function make html for the box type
                    //  $packedboxes .= '<strong>' . $general_instruction->for_type_text . '</strong><br />';
                    foreach ($packedboxesdetails as $value) {

                        $packedboxes .= $value . '<br />';
                    }

                    //This code set account number, radio html and package box html variable values
                    $data['result'] = 'success';
                    $data['carrier_account_number'] = $sReponse['carrier_account_number'];
                    $data['html'] = $sReponse['html'];
                    $data['packedboxes'] = $packedboxes;
                }
            } else {
                $data['result'] = 'fail';
            }
        } else {

            $error_message = $cart_instruction->items_not_packed;
            $notpackeditems = "";
            foreach ($pack_resp['response']['not_packed_items'] as $singlenotpacked) {
                $notpackeditems .= "," . $singlenotpacked['id'] . " ";
            }

            $error_message = str_replace('%notpacked%', $notpackeditems, $error_message);
            $data['result'] = 'fail';
	    $data['msg'] = $error_message;
	    $data['extra']= 'Not packed';


        }

        // This function return json
        echo json_encode($data);
        exit;
    }

    public function getUpsShippingRate($cart_users_data, $package)
    {

        $apisetting = array();
        $apisetting = $this->cart_model->get_ups_api_settings($cart_users_data['ship_country_flag']);
        $api_access = trim($apisetting['access']);
        $api_userid = trim($apisetting['userid']);
        $api_passwd = trim($apisetting['passwd']);
        $api_shipperNumber = trim($apisetting['shipperNumber']);
        $api_shipper_description = trim($apisetting['shipper_description']);
        $api_shipper_name = trim($apisetting['shipper_name']);
        $api_shipper_attentionname = trim($apisetting['shipper_attentionname']);
        $api_shipper_addressline1 = trim($apisetting['shipper_addressline1']);
        $api_shipper_addressline2 = trim($apisetting['shipper_addressline2']);
        $api_shipper_city = trim($apisetting['shipper_city']);
        $api_shipper_stateprovincecode = trim($apisetting['shipper_stateprovincecode']);
        $api_shipper_postalcode = trim($apisetting['shipper_postalcode']);
        $api_shipper_countrycode = trim($apisetting['shipper_countrycode']);
        $api_shipper_number = trim($apisetting['shipper_number']);
        $pickup_days = trim($apisetting['pickup_days']);

        $this->load->library('UpsRating');
        $this->upsrating->addField('access', $api_access);
        $this->upsrating->addField('userid', $api_userid);
        $this->upsrating->addField('passwd', $api_passwd);
        $this->upsrating->addField('shipperNumber', $api_shipperNumber);
        $this->upsrating->addField('shipper_description', $api_shipper_description);
        $this->upsrating->addField('shipper_name', $api_shipper_name);
        $this->upsrating->addField('shipper_attentionname', $api_shipper_attentionname);
        $this->upsrating->addField('shipper_addressline1', $api_shipper_addressline1);
        $this->upsrating->addField('shipper_addressline2', $api_shipper_addressline2);
        $this->upsrating->addField('shipper_city', $api_shipper_city);
        $this->upsrating->addField('shipper_stateprovincecode', $api_shipper_stateprovincecode);
        $this->upsrating->addField('shipper_postalcode', $api_shipper_postalcode);
        $this->upsrating->addField('shipper_countrycode', $api_shipper_countrycode);
        $this->upsrating->addField('shipper_number', $api_shipper_number);
        $this->upsrating->addField('pickup_days', $pickup_days);

        $name = $cart_users_data['ship_title'] . ' ' . $cart_users_data['ship_surname'];
        $this->upsrating->addField('ShipTo_Name', $name);
        $this->upsrating->addField('ShipTo_AddressLine', array(
            $cart_users_data['ship_address_1'], $cart_users_data['ship_address_2'],
        ));
        $this->upsrating->addField('ShipTo_City', $cart_users_data['ship_city']);
        $this->upsrating->addField('ShipTo_StateProvinceCode', $cart_users_data['ship_state']);
        $this->upsrating->addField('ShipTo_PostalCode', $cart_users_data['ship_zip']);
        $country = strtoupper($cart_users_data['ship_country_flag']);
        $this->upsrating->addField('ShipTo_CountryCode', $country);
        $this->upsrating->addField('ShipTo_phone', $cart_users_data['ship_telephone']);

        // echo "<pre>";
        // print_r($package);
        // exit;

        $package_shipment = array();
        $freight_shipment = array();

        foreach ($package as $single_package) {
            if ($single_package['package_type'] == "freight") {

                array_push($freight_shipment, $single_package);
            } else {

                array_push($package_shipment, $single_package);
            }

        }

        $this->upsrating->addField('dimensions', $package_shipment);
        $this->upsrating->addField('dimensions_freight', $freight_shipment);
        $this->upsrating->addField('NumOfPieces', count($package_shipment));
        $this->upsrating->addField('NumOfPieces_freight', count($freight_shipment));

        $language_data = get_user_lang_data(array('general_instruction', 'cart_instruction', 'sales_order_preview'), $this->lang->default_lang_id);

        $general_instruction = (object) $language_data['general_instruction'];
        $cart_instruction = (object) $language_data['cart_instruction'];

        $currencyV = getDefaultCurrencyCode('l') . '_currency';
        $currency = $general_instruction->$currencyV;

        $ups_service_code_description = $this->comman_model->getUpsServiceCodeDescription($this->lang->default_lang_id);
        $ups_shipments_description_usa = array();

        foreach ($ups_service_code_description as $desc) {
            if ($desc['country'] == 'ca') {
                $ups_shipments_description_ca[$desc['code']] = $desc['description'];
            } else {
                $ups_shipments_description_usa[$desc['code']] = $desc['description'];
            }
        }

        $sales_order_preview = (object) $language_data['sales_order_preview'];
        $html = "";
        $data = array();
        $status = 'success';
        if (!empty($package_shipment)) {
            $ups_response = $this->upsrating->processRate();

            // echo "<pre>";
            // print_r($ups_response);

            if ($ups_response['status'] == "success") {

                $businessdaysintransit = '';
                $businessdaysintransit_text = '';
                $deliverybytime = '';
                $deliverybytime_text = '';
                $html = '<div class="ups_package_rate">';
                foreach ($ups_response['rates'] as $key => $val) {

                    if ($this->config->item('shipping_markup_value') > 0) {
                        $val->TotalCharges->MonetaryValue = $val->TotalCharges->MonetaryValue * $this->config->item('shipping_markup_value');
                        $val->TotalCharges->MonetaryValue = round($val->TotalCharges->MonetaryValue, 2);
                    }
                    if (isset($val->GuaranteedDelivery->BusinessDaysInTransit) && $val->GuaranteedDelivery->BusinessDaysInTransit != '') {
                        $businessdaysintransit = $val->GuaranteedDelivery->BusinessDaysInTransit;
                        $businessdaysintransit_text = $sales_order_preview->transit_days;
                    }

                    if (isset($val->GuaranteedDelivery->DeliveryByTime) && $val->GuaranteedDelivery->DeliveryByTime != '') {
                        $deliverybytime = $val->GuaranteedDelivery->DeliveryByTime;
                        $deliverybytime_text = $sales_order_preview->delivery_by_time;
                    }
                    if ($cart_users_data['ship_country_flag'] == 'ca') {
                        if ($businessdaysintransit != '') {
                            $html .= '<input style="position:relative;left:0;margin-right:10px;opacity:1;width: auto;height: auto;" type="radio" name="upsrates" value="' . $val->TotalCharges->CurrencyCode . ' ' . $val->TotalCharges->MonetaryValue . ' ' . $ups_shipments_description_ca[$val->Service->Code] . '" data-id="' . $val->Service->Code . '" data-days="' . $businessdaysintransit . '" data-time="' . $deliverybytime . '" />' . $currency . ' ' . $val->TotalCharges->MonetaryValue . ' ' . $ups_shipments_description_ca[$val->Service->Code] . ' - ' . $businessdaysintransit . ' ' . $businessdaysintransit_text . ' ' . $deliverybytime_text . ' ' . $deliverybytime . '<br />';
                        } else {
                            $html .= '<input style="position:relative;left:0;margin-right:10px;opacity:1;width: auto;height: auto;" type="radio" name="upsrates" value="' . $val->TotalCharges->CurrencyCode . ' ' . $val->TotalCharges->MonetaryValue . ' ' . $ups_shipments_description_ca[$val->Service->Code] . '" data-id="' . $val->Service->Code . '" data-days="' . $businessdaysintransit . '" data-time="' . $deliverybytime . '" />' . $currency . ' ' . $val->TotalCharges->MonetaryValue . ' ' . $ups_shipments_description_ca[$val->Service->Code] . '<br />';
                        }
                    } else {
                        if ($businessdaysintransit != '') {
                            $html .= '<input style="position:relative;left:0;margin-right:10px;opacity:1;width: auto;height: auto;" type="radio" name="upsrates" value="' . $val->TotalCharges->CurrencyCode . ' ' . $val->TotalCharges->MonetaryValue . ' ' . $ups_shipments_description_usa[$val->Service->Code] . '" data-id="' . $val->Service->Code . '" data-days="' . $businessdaysintransit . '" data-time="' . $deliverybytime . '" />' . $currency . ' ' . $val->TotalCharges->MonetaryValue . ' ' . $ups_shipments_description_usa[$val->Service->Code] . ' - ' . $businessdaysintransit . ' ' . $businessdaysintransit_text . ' ' . $deliverybytime_text . ' ' . $deliverybytime . '<br />';
                        } else {
                            $html .= '<input style="position:relative;left:0;margin-right:10px;opacity:1;width: auto;height: auto;" type="radio" name="upsrates" value="' . $val->TotalCharges->CurrencyCode . ' ' . $val->TotalCharges->MonetaryValue . ' ' . $ups_shipments_description_usa[$val->Service->Code] . '" data-id="' . $val->Service->Code . '" data-days="' . $businessdaysintransit . '" data-time="' . $deliverybytime . '" />' . $currency . ' ' . $val->TotalCharges->MonetaryValue . ' ' . $ups_shipments_description_usa[$val->Service->Code] . '<br />';
                        }
                    }
                }

                $html .= '</div>';

                $data['carrier_account_number'] = $api_shipperNumber;
                $data['result'] = $status;
                $data['html'] = $html;
            } else if ($ups_response['status'] == "fail") {
                // if ($ups_response['error']->Fault->detail->Errors->ErrorDetail->PrimaryErrorCode->Code) {
                //     $error_code = $ups_response['error']->Fault->detail->Errors->ErrorDetail->PrimaryErrorCode->Code;
                // } else if ($ups_response['error']->response->errors[0]->code) {
                //     $error_code = $ups_response['error']->response->errors[0]->code;
                // }

                // $ups_errors = $this->comman_model->getUpsErrorsByCode($error_code, $this->lang->default_lang_id);

                // $error = '';
                // $error = $ups_errors[0]['error_text'];
                // $error = str_replace('%country.maxPkgWeight%', '100.00', $error);
                // $error = str_replace('%maxLengthGirth%', '165 Inches', $error);
                // $error = str_replace('%postal%', $cart_users_data['ship_zip'], $error);
                // $error = str_replace('%state%', $cart_users_data['ship_state'], $error);
                // $error = str_replace('%country%', $country, $error);
                // $error = str_replace('%dest.postal%', $cart_users_data['ship_zip'], $error);
                // $error = str_replace('%dest.country%', $country, $error);
                // $error = str_replace('%dest.AdjCountry%', $country, $error);
                // $error = str_replace('%dest.AdjCityName%', $cart_users_data['ship_city'], $error);
                // $error = str_replace('%dest.AdjPostal%', $cart_users_data['ship_zip'], $error);
                // if ($cart_users_data['ship_country_flag'] == 'ca') {
                //     $error = str_replace('%orig.postal%', 'V3M6J9', $error);
                //     $error = str_replace('%orig.country%', 'CA', $error);
                //     $error = str_replace('%orig.AdjCountry%', 'CA', $error);
                //     $error = str_replace('%orig.AdjCityName%', 'Delta', $error);
                // } else {
                //     $error = str_replace('%orig.postal%', '01747', $error);
                //     $error = str_replace('%orig.country%', 'US', $error);
                //     $error = str_replace('%orig.AdjCountry%', 'US', $error);
                //     $error = str_replace('%orig.AdjCityName%', 'HOPEDALE', $error);
                // }

                $data['error'] = $error;
                $status = 'fail';
                $msg = $cart_instruction->shipping_error_switch . '<a href="javascript:void(0)" class="btn  actn-btn rounded" id="switch_exw">' . $cart_instruction->shipping_error_switch_button . '
                    </a>';
                $data['msg'] = $msg;

            } else {

                $data['error'] = $error;
                $status = 'fail';
                $msg = $cart_instruction->shipping_error_switch . '<a href="javascript:void(0)" class="btn  actn-btn rounded" id="switch_exw">' . $cart_instruction->shipping_error_switch_button . '
                    </a>';
                $data['msg'] = $msg;

            }
        }

        if (!empty($freight_shipment)) {

            $html .= '<div class="ups_freight_rate" ><label for="upsrates" class="col-sm-12 control-label">Freight Shipping Rate<span class="cart_asterisk">*</span></label>';

            $requestoption = "ground";
            $ups_response = $this->upsrating->processfreightRate($requestoption);
            // echo "<pre>";
            // print_r($ups_response);
            if ($ups_response['status'] == "success") {
                //  echo $ups_response['rates']->TimeInTransit->DaysInTransit;
                if (isset($ups_response['rates']->TimeInTransit->DaysInTransit) && $ups_response['rates']->TimeInTransit->DaysInTransit != '') {
                    $businessdaysintransit = $ups_response['rates']->TimeInTransit->DaysInTransit;
                    $businessdaysintransit_text = $sales_order_preview->transit_days;
                }
                $html .= '<input style="position:relative;left:0;margin-right:10px;opacity:1;width: auto;height: auto;" type="radio" name="upsrates_freight" value="' . $ups_response['rates']->TotalShipmentCharge->CurrencyCode . ' ' . $ups_response['rates']->TotalShipmentCharge->MonetaryValue . ' ' . $ups_shipments_description_usa[$ups_response['rates']->Service->Code] . ' ' . ucfirst($requestoption) . '" data-id="' . $ups_response['rates']->Service->Code . '" data-days="' . $businessdaysintransit . '"   data-package_type="' . $requestoption . '"  />' . $currency . ' ' . $ups_response['rates']->TotalShipmentCharge->MonetaryValue . ' ' . $ups_shipments_description_usa[$ups_response['rates']->Service->Code] . '  ' . ucfirst($requestoption) . '<br />';

            } else if ($ups_response['status'] == "fail") {
                $status = 'fail';
                $msg = $cart_instruction->shipping_error_switch . '<a href="javascript:void(0)" class="btn  actn-btn rounded" id="switch_exw">' . $cart_instruction->shipping_error_switch_button . '
                </a>';
                $data['msg'] = $msg;

            } else {

                $status = 'fail';
                $msg = $cart_instruction->shipping_error_switch . '<a href="javascript:void(0)" class="btn  actn-btn rounded" id="switch_exw">' . $cart_instruction->shipping_error_switch_button . '
                </a>';
                $data['msg'] = $msg;
            }

            $html .= '</div>';

        }

        $data['carrier_account_number'] = $api_shipperNumber;
        $data['result'] = $status;
        $data['html'] = $html;

        return $data;
    }

    public function getFedexShippingRate($cart_users_data, $package)
    {

        $apisetting = array();
        $apisetting = $this->cart_model->get_fedex_api_settings($cart_users_data['ship_country_flag']);
        if (empty($apisetting)) {
            $apisetting = $this->cart_model->get_fedex_api_settings();
        }

        $this->load->library('FedexShipping');
        $this->fedexshipping->addField('client_id', trim($apisetting['client_id']));
        $this->fedexshipping->addField('client_secret', trim($apisetting['client_secret']));
        $this->fedexshipping->addField('accountNumber', trim($apisetting['accountNumber']));
        $this->fedexshipping->addField('shipper_companyName', trim($apisetting['shipper_companyName']));
        $this->fedexshipping->addField('shipper_personName', trim($apisetting['shipper_personName']));
        $this->fedexshipping->addField('shipper_addressline1', trim($apisetting['shipper_addressline1']));
        $this->fedexshipping->addField('shipper_addressline2', trim($apisetting['shipper_addressline2']));
        $this->fedexshipping->addField('shipper_phoneNumber', trim($apisetting['shipper_phoneNumber']));
        $this->fedexshipping->addField('shipper_city', trim($apisetting['shipper_city']));
        $this->fedexshipping->addField('shipper_stateprovincecode', trim($apisetting['shipper_stateprovincecode']));
        $this->fedexshipping->addField('shipper_postalcode', trim($apisetting['shipper_postalcode']));
        $this->fedexshipping->addField('shipper_countrycode', trim($apisetting['shipper_countrycode']));
        $name = $cart_users_data['ship_title'] . ' ' . $cart_users_data['ship_surname'];
        $this->fedexshipping->addField('ShipTo_Name', $name);
        $this->fedexshipping->addField('ShipTo_AddressLine', array(
            $cart_users_data['ship_address_1'], $cart_users_data['ship_address_2'],
        ));
        $this->fedexshipping->addField('ShipTo_City', $cart_users_data['ship_city']);
        $this->fedexshipping->addField('ShipTo_StateProvinceCode', $cart_users_data['ship_state']);
        $this->fedexshipping->addField('ShipTo_PostalCode', $cart_users_data['ship_zip']);
        $country = strtoupper($cart_users_data['ship_country_flag']);
        $this->fedexshipping->addField('ShipTo_CountryCode', $country);
        $this->fedexshipping->addField('ShipTo_phone', $cart_users_data['ship_telephone']);

        // echo "<pre>";
        // print_r($package);
        // exit;

        $package_shipment = array();
        $freight_shipment = array();

        foreach ($package as $single_package) {
            if ($single_package['package_type'] == "freight") {

                array_push($freight_shipment, $single_package);
            } else {

                array_push($package_shipment, $single_package);
            }

        }
        // echo '<pre>';print_r($package_shipment);echo '</pre>';

        $this->fedexshipping->addField('dimensions', $package_shipment);
        $this->fedexshipping->addField('dimensions_freight', $freight_shipment);
        $this->fedexshipping->addField('NumOfPieces', count($package_shipment));
        $this->fedexshipping->addField('NumOfPieces_freight', count($freight_shipment));

        $language_data = get_user_lang_data(array('general_instruction', 'cart_instruction', 'sales_order_preview'), $this->lang->default_lang_id);

        $general_instruction = (object) $language_data['general_instruction'];
        $cart_instruction = (object) $language_data['cart_instruction'];

        $currencyV = getDefaultCurrencyCode('l') . '_currency';
        $currency = $general_instruction->$currencyV;
        $this->fedexshipping->addField('currency', $currency);

        // $ups_service_code_description = $this->comman_model->getUpsServiceCodeDescription($this->lang->default_lang_id);
        // $ups_shipments_description_usa = array();

        //     foreach ($ups_service_code_description as $desc) {
        //         if ($desc['country'] == 'ca') {
        //             $ups_shipments_description_ca[$desc['code']] = $desc['description'];
        //         } else {
        //             $ups_shipments_description_usa[$desc['code']] = $desc['description'];
        //         }
        //     }

        $sales_order_preview = (object) $language_data['sales_order_preview'];
        $html = "";
        $data = array();
        $status = 'success';
        if (!empty($package_shipment)||!empty($freight_shipment)) {
            if(count($freight_shipment)>0){
                
                $fedex_response = $this->fedexshipping->processFrightRateFedex();
            }else{
                $fedex_response = $this->fedexshipping->processRate();
                
            }
            
            //  echo '<pre>';print_r($fedex_response);exit;
            if ($fedex_response['status'] == "success") {

                $businessdaysintransit = '';
                $businessdaysintransit_text = '';
                $deliverybytime = '';
                $deliverybytime_text = '';
		$html = '<div class="ups_package_rate">';
		$cart_instruction_array = (array)$cart_instruction;
                $general_instruction_array = (array)$general_instruction;
                foreach ($fedex_response['rates'] as $val) {
                    $all_rates = $val->ratedShipmentDetails;
                    foreach ($all_rates as $key => $singlerate) {                        
                        $currency_display = (isset($general_instruction_array[strtolower($singlerate->shipmentRateDetail->currency).'_currency'])?$general_instruction_array[strtolower($singlerate->shipmentRateDetail->currency).'_currency']:$singlerate->shipmentRateDetail->currency);               
                        if(($this->config->item('shipping_mode') == "1") || ($singlerate->rateType=="ACCOUNT" && $this->config->item('shipping_mode') == "0") ){
                            $html .= '<input style="position:relative;left:0;margin-right:10px;opacity:1;width: auto;height: auto;" type="radio" name="fedexrates" value="' .$singlerate->shipmentRateDetail->currency . ' ' . $singlerate->totalNetFedExCharge . ' ' . $val->serviceType . '" data-id="' . $val->serviceType . '" />' . $currency_display . ' ' . $singlerate->totalNetFedExCharge . ' ' . (isset($cart_instruction_array[$val->serviceType])?$cart_instruction_array[$val->serviceType]:$val->serviceType). '<br />';
                        }                    
                    }
                }   
                if(isset($val->customerMessages[0]->code)){
                    $customer_code = $val->customerMessages[0]->code;
                    $customer_msg = $val->customerMessages[0]->message;          
                    $html .= '<b>'.$cart_instruction_array["shipping_note"].'</b>'.(isset($cart_instruction_array[$customer_code])?$cart_instruction_array[$customer_code]:$customer_msg).'</br>';                    
                }   
                $html .= '</div>';

                $data['carrier_account_number'] = trim($apisetting['accountNumber']);
                $data['result'] = $status;
                $data['html'] = $html;
                return $data;

            } else if ($fedex_response['status'] == "fail") {

                $msg = $cart_instruction->shipping_error_switch . '<a href="javascript:void(0)" class="btn  actn-btn rounded" id="switch_exw">' . $cart_instruction->shipping_error_switch_button . '
                </a>';
                $data['msg'] = $msg;
                $data['error'] = $error;
                $data['result'] = 'fail';

                return $data;

            } else {

                $msg = $cart_instruction->shipping_error_switch . '<a href="javascript:void(0)" class="btn  actn-btn rounded" id="switch_exw">' . $cart_instruction->shipping_error_switch_button . '
                </a>';
                $data['msg'] = $msg;
                $data['error'] = $error;
                $data['result'] = 'fail';

                return $data;

            }
        }

        // if(!empty($freight_shipment)) {

        //     $html .= '<div class="ups_freight_rate" ><label for="upsrates" class="col-sm-12 control-label">Freight Shipping Rate<span class="cart_asterisk">*</span></label>';

        //     $requestoption = "ground";
        //     $ups_response = $this->upsrating->processfreightRate($requestoption);
        //     // echo "<pre>";
        //     // print_r($ups_response);
        //     if($ups_response['status']=="success") {
        //     //  echo $ups_response['rates']->TimeInTransit->DaysInTransit;
        //     if (isset($ups_response['rates']->TimeInTransit->DaysInTransit) && $ups_response['rates']->TimeInTransit->DaysInTransit != '') {
        //         $businessdaysintransit = $ups_response['rates']->TimeInTransit->DaysInTransit;
        //         $businessdaysintransit_text = $sales_order_preview->transit_days;
        //     }
        //     $html .= '<input style="position:relative;left:0;margin-right:10px;opacity:1;width: auto;height: auto;" type="radio" name="upsrates_freight" value="' . $ups_response['rates']->TotalShipmentCharge->CurrencyCode . ' ' . $ups_response['rates']->TotalShipmentCharge->MonetaryValue . ' ' . $ups_shipments_description_usa[$ups_response['rates']->Service->Code] .' '.ucfirst($requestoption).'" data-id="' . $ups_response['rates']->Service->Code . '" data-days="' . $businessdaysintransit . '"   data-package_type="' . $requestoption . '"  />' .  $currency . ' ' . $ups_response['rates']->TotalShipmentCharge->MonetaryValue . ' ' . $ups_shipments_description_usa[$ups_response['rates']->Service->Code] .'  '.ucfirst($requestoption).'<br />';

        //     } else  if($ups_response['status']=="fail") {
        //         $status = 'fail';
        //         $msg = $cart_instruction->shipping_error_switch.'<a href="javascript:void(0)" class="btn  actn-btn rounded" id="switch_exw">'.$cart_instruction->shipping_error_switch_button.'
        //         </a>';
        //         $data['msg'] = $msg;

        //     } else {

        //         $status = 'fail';
        //         $msg = $cart_instruction->shipping_error_switch.'<a href="javascript:void(0)" class="btn  actn-btn rounded" id="switch_exw">'.$cart_instruction->shipping_error_switch_button.'
        //         </a>';
        //         $data['msg'] = $msg;
        //     }

        //     $html .= '</div>';

        // }

    }

    public function getAramexShippingRate($cart_users_data, $package)
    {

        $general_instruction = (object) get_user_lang_data(array('general_instruction'), $this->lang->default_lang_id)['general_instruction'];
        $apiData = $this->api_model->get_aramex_api_details();
        $aramex_response = getAramexShippingRate($cart_users_data, $package, $apiData);
        $data = array();
        if ($aramex_response->HasErrors == 1) {
            $data['result'] = 'fail';
            $msg = array();
            if (count($aramex_response->Notifications->Notification) > 1) {
                foreach ($aramex_response->Notifications->Notification as $notifications) {
                    $msg[] = $notifications->Message;
                }
                $msg = implode(',</br>', $msg);
            } else if (!empty($aramex_response->Notifications->Notification->Code)) {
                $msg = $aramex_response->Notifications->Notification->Message;
            }
            $data['msg'] = $msg;
        } else {

            $businessdaysintransit = '';
            $businessdaysintransit_text = '';
            $deliverybytime = '';
            $deliverybytime_text = '';
            $html = '';

            $totalAmount = $aramex_response->TotalAmount->Value;
            $currencyCode = $aramex_response->TotalAmount->CurrencyCode;

            $currencyV = getDefaultCurrencyCode('l') . '_currency';

	    $currency = $general_instruction->$currencyV;

            if($currencyCode != $this->config->item('default_currency_code'))
                $totalAmount  = exchangeRage($totalAmount,$currencyCode,$this->config->item('default_currency_code'));

            if ($this->config->item('shipping_markup_value') > 0) {
                $totalAmount = $totalAmount * $this->config->item('shipping_markup_value');
                $totalAmount = round($totalAmount, 2);
            }

            if ($cart_users_data['ship_country_flag'] == 'ca') {
                if ($businessdaysintransit != '') {
                    $html .= '<input style="position:relative;left:0;margin-right:10px;opacity:1;width: auto;height: auto;" type="radio" name="upsrates" value="' . $currency . ' ' . $totalAmount . '" data-id="" data-days="' . $businessdaysintransit . '" data-time="' . $deliverybytime . '" /> ' . $currency . ' ' . $totalAmount . ' - ' . $businessdaysintransit . ' ' . $businessdaysintransit_text . ' ' . $deliverybytime_text . ' ' . $deliverybytime . '<br />';
                } else {
                    $html .= '<input style="position:relative;left:0;margin-right:10px;opacity:1;width: auto;height: auto;" type="radio" name="upsrates" value="' . $currency . ' ' . $totalAmount . '" data-id="" data-days="' . $businessdaysintransit . '" data-time="' . $deliverybytime . '" /> ' . $currency . ' ' . $totalAmount . '<br />';
                }
            } else {
                if ($businessdaysintransit != '') {
                    $html .= '<input style="position:relative;left:0;margin-right:10px;opacity:1;width: auto;height: auto;" type="radio" name="upsrates" value="' . $currency . ' ' . $totalAmount . '" data-id="" data-days="' . $businessdaysintransit . '" data-time="' . $deliverybytime . '" /> ' . $currency . ' ' . $totalAmount . ' - ' . $businessdaysintransit . ' ' . $businessdaysintransit_text . ' ' . $deliverybytime_text . ' ' . $deliverybytime . '<br />';
                } else {
                    $html .= '<input style="position:relative;left:0;margin-right:10px;opacity:1;width: auto;height: auto;" type="radio" name="upsrates" value="' . $currency . ' ' . $totalAmount . '" data-id="" data-days="' . $businessdaysintransit . '" data-time="' . $deliverybytime . '" /> ' . $currency . ' ' . $totalAmount . '<br />';
                }
            }
            $data['carrier_account_number'] = $apiData['account_number'];
            $data['result'] = 'success';
            $data['html'] = $html;
        }
        return $data;
    }

    public function getFreightcomRate($cart_users_data, $package)
    {

        $apisetting = array();
        $apisetting = $this->cart_model->get_freightcom_api_settings($cart_users_data['ship_country_flag']);
        if (empty($apisetting)) {
            $apisetting = $this->cart_model->get_freightcom_api_settings();
        }

        $this->load->library('FreightShipping');
        $this->freightshipping->addField('client_token', trim($apisetting['client_token']));
        $this->freightshipping->addField('shipper_companyName', trim($apisetting['shipper_companyName']));
        $this->freightshipping->addField('shipper_personName', trim($apisetting['shipper_personName']));
        $this->freightshipping->addField('shipper_addressline1', trim($apisetting['shipper_addressline1']));
        $this->freightshipping->addField('shipper_addressline2', trim($apisetting['shipper_addressline2']));
        $this->freightshipping->addField('shipper_phoneNumber', trim($apisetting['shipper_phoneNumber']));
        $this->freightshipping->addField('shipper_city', trim($apisetting['shipper_city']));
        $this->freightshipping->addField('shipper_stateprovincecode', trim($apisetting['shipper_stateprovincecode']));
        $this->freightshipping->addField('shipper_postalcode', trim($apisetting['shipper_postalcode']));
        $this->freightshipping->addField('shipper_countrycode', trim($apisetting['shipper_countrycode']));
        $name = $cart_users_data['ship_title'] . ' ' . $cart_users_data['ship_surname'];
        $this->freightshipping->addField('ShipTo_Name', $name);
        $this->freightshipping->addField('ShipTo_AddressLine1', $cart_users_data['ship_address_1']);
        $this->freightshipping->addField('ShipTo_AddressLine2', $cart_users_data['ship_address_2']);
        $this->freightshipping->addField('ShipTo_City', $cart_users_data['ship_city']);
        $this->freightshipping->addField('ShipTo_StateProvinceCode', $cart_users_data['ship_state']);
        $this->freightshipping->addField('ShipTo_PostalCode', $cart_users_data['ship_zip']);
        $country = strtoupper($cart_users_data['ship_country_flag']);
        $this->freightshipping->addField('ShipTo_CountryCode', $country);
        $this->freightshipping->addField('ShipTo_phone', $cart_users_data['ship_telephone']);

        // echo "<pre>";
        // print_r($package);
        // exit;

        $package_shipment = array();
        $freight_shipment = array();

        foreach ($package as $single_package) {
            if ($single_package['package_type'] == "freight") {

                array_push($freight_shipment, $single_package);
            } else {

                array_push($package_shipment, $single_package);
            }

        }

        $this->freightshipping->addField('dimensions', $package_shipment);
        $this->freightshipping->addField('dimensions_freight', $freight_shipment);
        $this->freightshipping->addField('NumOfPieces', count($package_shipment));
        $this->freightshipping->addField('NumOfPieces_freight', count($freight_shipment));

        $language_data = get_user_lang_data(array('general_instruction', 'cart_instruction', 'sales_order_preview'), $this->lang->default_lang_id);

        $general_instruction = (object) $language_data['general_instruction'];
        $cart_instruction = (object) $language_data['cart_instruction'];

        $currencyV = getDefaultCurrencyCode('l') . '_currency';
        $currency = $general_instruction->$currencyV;
        $this->freightshipping->addField('currency', $currency);

        // $ups_service_code_description = $this->comman_model->getUpsServiceCodeDescription($this->lang->default_lang_id);
        // $ups_shipments_description_usa = array();

        //     foreach ($ups_service_code_description as $desc) {
        //         if ($desc['country'] == 'ca') {
        //             $ups_shipments_description_ca[$desc['code']] = $desc['description'];
        //         } else {
        //             $ups_shipments_description_usa[$desc['code']] = $desc['description'];
        //         }
        //     }

        $sales_order_preview = (object) $language_data['sales_order_preview'];
        $html = "";
        $data = array();
        $status = 'success';
        if (!empty($package_shipment)) {
            $freightcom_response = $this->freightshipping->processRate();
            // echo "<pre>";
            // print_r($freightcom_response);
            // exit;

            if ($freightcom_response['status'] == "success") {

                $businessdaysintransit = '';
                $businessdaysintransit_text = '';
                $deliverybytime = '';
                $deliverybytime_text = '';
                $html = '<div class="ups_package_rate">';
                foreach ($freightcom_response['rates'] as $singlerate) {
                    $html .= '<input style="position:relative;left:0;margin-right:10px;opacity:1;width: auto;height: auto;" type="radio" name="fedexrates" value="' . $singlerate->total->currency . ' ' . round($singlerate->total->value / 100, 2) . ' ' . $singlerate->service_id . '" data-id="' . $singlerate->service_id . '" />' . $singlerate->total->currency . ' ' . round($singlerate->total->value / 100, 2) . ' ' . $singlerate->service_id . '<br />';
                }

                $html .= '</div>';

                $data['carrier_account_number'] = trim("786876587658");
                $data['result'] = $status;
                $data['html'] = $html;
                return $data;

            } else if ($fedex_response['status'] == "fail") {

                $msg = $cart_instruction->shipping_error_switch . '<a href="javascript:void(0)" class="btn  actn-btn rounded" id="switch_exw">' . $cart_instruction->shipping_error_switch_button . '
                </a>';
                $data['msg'] = $msg;
                $data['error'] = $error;
                $data['result'] = 'fail';

                return $data;

            } else {

                $msg = $cart_instruction->shipping_error_switch . '<a href="javascript:void(0)" class="btn  actn-btn rounded" id="switch_exw">' . $cart_instruction->shipping_error_switch_button . '
                </a>';
                $data['msg'] = $msg;
                $data['error'] = $error;
                $data['result'] = 'fail';

                return $data;

            }
        }

        // if(!empty($freight_shipment)) {

        //     $html .= '<div class="ups_freight_rate" ><label for="upsrates" class="col-sm-12 control-label">Freight Shipping Rate<span class="cart_asterisk">*</span></label>';

        //     $requestoption = "ground";
        //     $ups_response = $this->upsrating->processfreightRate($requestoption);
        //     // echo "<pre>";
        //     // print_r($ups_response);
        //     if($ups_response['status']=="success") {
        //     //  echo $ups_response['rates']->TimeInTransit->DaysInTransit;
        //     if (isset($ups_response['rates']->TimeInTransit->DaysInTransit) && $ups_response['rates']->TimeInTransit->DaysInTransit != '') {
        //         $businessdaysintransit = $ups_response['rates']->TimeInTransit->DaysInTransit;
        //         $businessdaysintransit_text = $sales_order_preview->transit_days;
        //     }
        //     $html .= '<input style="position:relative;left:0;margin-right:10px;opacity:1;width: auto;height: auto;" type="radio" name="upsrates_freight" value="' . $ups_response['rates']->TotalShipmentCharge->CurrencyCode . ' ' . $ups_response['rates']->TotalShipmentCharge->MonetaryValue . ' ' . $ups_shipments_description_usa[$ups_response['rates']->Service->Code] .' '.ucfirst($requestoption).'" data-id="' . $ups_response['rates']->Service->Code . '" data-days="' . $businessdaysintransit . '"   data-package_type="' . $requestoption . '"  />' .  $currency . ' ' . $ups_response['rates']->TotalShipmentCharge->MonetaryValue . ' ' . $ups_shipments_description_usa[$ups_response['rates']->Service->Code] .'  '.ucfirst($requestoption).'<br />';

        //     } else  if($ups_response['status']=="fail") {
        //         $status = 'fail';
        //         $msg = $cart_instruction->shipping_error_switch.'<a href="javascript:void(0)" class="btn  actn-btn rounded" id="switch_exw">'.$cart_instruction->shipping_error_switch_button.'
        //         </a>';
        //         $data['msg'] = $msg;

        //     } else {

        //         $status = 'fail';
        //         $msg = $cart_instruction->shipping_error_switch.'<a href="javascript:void(0)" class="btn  actn-btn rounded" id="switch_exw">'.$cart_instruction->shipping_error_switch_button.'
        //         </a>';
        //         $data['msg'] = $msg;
        //     }

        //     $html .= '</div>';

        // }

    }

    /**
     * invoice
     * This Function generate invoice and package pdf and  Display the view  of order invoice.
     * @return void
     */
    public function invoice()
    {
        $cart_user_id = $this->session->userdata('cart_user_id');
        // If cart user id is not empty than this function display the  invoice else it redirect to main page
        if (isset($cart_user_id) && $cart_user_id != '') {

            $final_price_data = $this->session->userdata('final_price_data');
            $total_price_invoice = $this->session->userdata('cart_final_price');
            $cart_final_currency = $this->session->userdata('cart_final_currency');

            // this function return data related to invoice from database
            $result = $this->cart_model->getInvoiceDetailsNew($cart_user_id);
            $coupon_applied = $result['cart_users_data']['coupon_applied'];
            $coupon_data = unserialize($result['cart_users_data']['coupon_data']);

            $cart_users_data = $result['cart_users_data'];
            $tax_base_rate = 0;
            if (isset($cart_users_data['tax_exoneration']) && $cart_users_data['tax_exoneration'] != 1) {
                $rate = $this->cart_model->getTaxBaseRate($cart_users_data['cart_state'], $cart_users_data['cart_zip']);
                if (isset($rate['tax_base_rate']) && $rate['tax_base_rate'] != '' && $rate['tax_base_rate'] != 0) {
                    $tax_base_rate = $rate['tax_base_rate'];
                }
            }

            // This function remove unnecesary variable from cart product list
            $cart = cartCleanUp($result['cart_details']);
            $cart_details = updateLanguageParameters($this->product_model->get_cart_items($cart, $this->lang->default_lang_id));
            $cart_product_quantity = $this->session->userdata('cart_product_quantity');
            $cart_details = getCartProductDetails($cart_details, 1, $cart_product_quantity);

            $userLangData = get_user_lang_data(array('general_instruction', 'cart_instruction', 'email_instruction', 'sales_order_preview', 'payment_instructions'), $this->lang->default_lang_id);

            // initialize data as Array to assign all required values for view files.
            $staticData = array(
                'title' => get_page_title('invoice_page'),
                'pageType' => 'invoice',
                'timestamp' => date_timestamp_get(date_create()),
                'front_validuser_data' => $this->session->userdata('front_validuser_data'),
                'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
                'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
                'product_items' => $this->product_items_model->getproductitems_data(),
                'product_model_items' => $this->product_items_model->getproductitems_data('product_model'),
                'general_instruction' => (object) $userLangData['general_instruction'],
                'cart_instruction' => (object) $userLangData['cart_instruction'],
                'email_instruction' => (object) $userLangData['email_instruction'],
                'sales_order_preview' => $userLangData['sales_order_preview'],
                'payment_instruction' => (object) $userLangData['payment_instructions'],
            );

            // get stored session model and maker data from filter and search box.
            $selModelIds = $this->session->userdata('searchModelIds') ? array_filter($this->session->userdata('searchModelIds')) : array();
            if (count($selModelIds) == 0) {
                $selModelIds = $this->session->userdata('model_id') ? array_filter($this->session->userdata('model_id')) : array();
            }
            $selMakerIds = $this->session->userdata('maker_id') ? array_filter($this->session->userdata('maker_id')) : array();

            // create cart related page data as array to store in the cart users table and reuse while creating invoice and package pdf via cron
            $dynamicData = array(
                'lang_id' => $this->lang->default_lang,
                'lang_num' => $this->lang->default_lang_id,
                'cart_details' => $cart_details,
                'cart_package_details' => $this->cart_model->getPackageDetails($cart_user_id),
                'cart_package_data' => $result['cart_package_data'] ? $result['cart_package_data'] : array(),
                'cart_data' => $cart,
                'cart_users_data' => $cart_users_data,
                'coupon_applied' => $coupon_applied,
                'coupon_data' => $coupon_data,
                'ship_via' => $this->cart_model->getAllSalesOrderSectionDataBySectionBlock('ship_via_code', $this->lang->default_lang_id),
                'freight' => (isset($cart_users_data['shipping_rate']) && $cart_users_data['shipping_rate']) ? $cart_users_data['shipping_rate'] : 0,
                'tax_base_rate' => $tax_base_rate,
                'total' => isset($final_price_data['total']) ? $final_price_data['total'] : $total_price_invoice,
                'currency' => isset($final_price_data['currency']) ? $final_price_data['currency'] : $cart_final_currency,
                'totalCartValue' => isset($final_price_data['total']) ? $final_price_data['total'] : $total_price_invoice,
                'selMakerIds' => $selMakerIds,
                'selModelIds' => $selModelIds,
                'session_cart' => $this->session->userdata('cart_selected_dropdowns'),
            );
            $pageData = array_merge($staticData, $dynamicData);

            // store the cart invoice page data in to tables
            $this->db->where('id', $cart_user_id);
            $this->db->update('cart_users', array('cart_all_data' => serialize($dynamicData)));

            /* old invoice generate function scripts
            // This Function create invoice pdf
            $invoice_pdf   = $this->generate_invoice_pdf($pageData);
            // This Function create packaging pdf
            $packaging_pdf = $this->generate_packaging_pdf($pageData);
            $pageData['invoicepdfURL']     = $invoice_pdf['url'];
            $pageData['packaging_pdfURL']  = $packaging_pdf['url'];
            $pageData['packaging_created'] = $packaging_pdf['created'];
             */
            $this->expire_trial();

            $pageData['completedata'] = $pageData;
            $pageData['packaging_created'] = 'no';
            $pageData['invoice_number'] = $this->session->userdata('invoice_number');
            $pageData['payment_method'] = $this->session->userdata('payment_method');
            $pageData['payments'] = $this->session->userdata('payments');

            // this function load view files of invoice
            $this->load->view('common/header_confirm', $pageData);
            $this->load->view('cart/invoice', $pageData);
        } else {
            redirect('/' . $this->lang->default_lang . '/front/entry_door', 'refresh');
        }
    }

    /**
     * generate_invoice_pdf
     *
     * This Function create invoice pdf using  data of cart session and cart user details.
     * @param  mixed $completedata
     * @param  action $action [which is define like create pdf from cron or default view ]
     * @return void
     */
    public function generate_invoice_pdf($completedata, $action = '')
    {
        // set the file name , url and absolute path of invoice pdf file.
        $invoicepdfname = 'Invoice_' . $completedata['payments']['invoice_number'] . '.pdf';
        $invoicepdfURL = base_url() . 'assets/uploads/invoice/' . $invoicepdfname;
        $invoicepdfPATH = FCPATH . '/assets/uploads/invoice/' . $invoicepdfname;
	// if file not exist than create the file otherwise else condition works
        if (!file_exists($invoicepdfPATH) || true) {
   
            // load the pdf library
            $this->load->library('Pdf');
            $pdfinvoice = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
            $pdfinvoice->SetTitle('Invoice');

            // remove default header/footer
            $pdfinvoice->setPrintHeader(false);
            $pdfinvoice->setPrintFooter(true);

            $lg = array();
            $l['a_meta_charset'] = 'UTF-8';
            $l['a_meta_dir'] = 'ltr';
            $l['a_meta_language'] = 'fa';
            $lg['w_page'] = 'page';

            // set some language-dependent strings (optional)
            $pdfinvoice->setLanguageArray($lg);

            if ($completedata['lang_id'] == 'ar') {
                $pdfinvoice->setRTL(true);
                $pdfinvoice->SetFont('aealarabiya', '', 12);
            } else if ($completedata['lang_id'] == 'frar') {
                $pdfinvoice->SetFont('aealarabiya', '', 12);
            } else if ($completedata['lang_id'] == 'cn') {
                $pdfinvoice->SetFont('stsongstdlight', '', 12);
            } else if ($completedata['lang_id'] == 'in') {
                $pdfinvoice->SetFont('freesans', '', 10);
            } else if ($completedata['lang_id'] == 'enar') {
                $pdfinvoice->SetFont('aealarabiya', '', 12);
            } else {
                $pdfinvoice->SetFont('helvetica', '', 10, '', 'false');
            }

            $completedata['action'] = $action;
            // Create first Page using the view file
            $pdfinvoice->AddPage('L');
            $first_page = $this->load->view('cart/pdf/invoice_pdf_firstpage', $completedata, true);
            $pdfinvoice->writeHTML($first_page);

            if ($completedata['payments']['payment_method'] != "3") {

                if ($completedata['payments']['status'] != "2") {
                    // Create second Page using the view file
                    $pdfinvoice->AddPage('L');
                    $second_page = $this->load->view('cart/pdf/invoice_pdf_secondpage', $completedata, true);
                    $pdfinvoice->writeHTML($second_page);
                }
            }
            // Save file in invoice folder
            $pdfinvoice->Output($invoicepdfPATH, 'F');
            // return responce in array format
            $responce['name'] = $invoicepdfname;
            $responce['url'] = $invoicepdfURL;
            $responce['path'] = $invoicepdfPATH;
	    $responce['created'] = "yes";
            return $responce;
        } else {
            // return responce in array format
            $responce['name'] = $invoicepdfname;
            $responce['url'] = $invoicepdfURL;
            $responce['path'] = $invoicepdfPATH;
            $responce['created'] = "not";
	    return $responce;
        }
    }

    /**
     * generate_packaging_pdf
     *
     * This Function create packaging pdf using  data of cart session , shipping and   user details.
     * @param  mixed $completedata
     * @param  action $action [which is define like create pdf from cron or default view ]
     * @return void
     */
    public function generate_packaging_pdf($completedata, $action = '')
    {
        // this funtion load pdf library
        $this->load->library('Pdf');

        $completedata['action'] = $action;

        if ($completedata['cart_users_data']['incoterms'] == 'DAP') {
            // if incoterms is DAP than this code will work
            $allPdfUrls = array();
	    
	    $created = 'no';
            if (!empty($completedata['cart_package_details'])) {
                foreach ($completedata['cart_package_details'] as $cpd) {
                    // set the variable for file name, url and  path
                    $packageListPdfName = 'Packagelist_' . $completedata['cart_users_data']['order_number'] . '_' . $cpd['package_name'] . '_' . $cpd['tracking_number'] . '.pdf';
                    $packageListPdfURL = base_url() . 'assets/uploads/invoice/' . $packageListPdfName;
                    $packagepdfPATH = FCPATH . '/assets/uploads/invoice/' . $packageListPdfName;
                    $allPdfUrls[] = $packageListPdfURL;
                    // if file not exist only than generate the pdf
                    if (!file_exists($packagepdfPATH)) {
                        $completedata['cpd'] = $cpd;
                        // create page using view file
                        $packaging_page = $this->load->view('cart/pdf/packaging_pdf_with_tracking_number', $completedata, true);

                        $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
                        $pdf->SetTitle('Packagelist');

                        // remove default header/footer
                        $pdf->setPrintHeader(false);
                        $pdf->setPrintFooter(true);

                        $lg = array();
                        $l['a_meta_charset'] = 'UTF-8';
                        $l['a_meta_dir'] = 'ltr';
                        $l['a_meta_language'] = 'fa';
                        $lg['w_page'] = 'page';

                        // set some language-dependent strings (optional)
                        $pdf->setLanguageArray($lg);

                        if ($completedata['lang_id'] == 'ar') {
                            $pdf->setRTL(true);
                            $pdf->SetFont('aealarabiya', '', 12);
                        } else if ($completedata['lang_id'] == 'frar') {
                            $pdf->SetFont('aealarabiya', '', 12);
                        } else if ($completedata['lang_id'] == 'cn') {
                            $pdf->SetFont('stsongstdlight', '', 12);
                        } else if ($completedata['lang_id'] == 'in') {
                            $pdf->SetFont('freesans', '', 10);
                        } else if ($completedata['lang_id'] == 'enar') {
                            $pdf->SetFont('aealarabiya', '', 12);
                        } else {
                            $pdf->SetFont('helvetica', '', 10, '', 'false');
                        }

                        $pdf->AddPage('L');

                        $pdf->writeHTML($packaging_page);
                        // save file in the folder
                        $pdf->Output($packagepdfPATH, 'F');
                        $created = 'yes';
                    } else {
                        $created = 'no';
                    }
                }
            }
            $response = array(
                'url' => implode(',', $allPdfUrls),
                'created' => $created,
            );
        } else {
            // set the file name , url and absolute path of packaging pdf file.
            $packagepdfname = 'Packagelist_' . $completedata['cart_users_data']['order_number'] . '.pdf';
            $packagepdfURL = base_url() . 'assets/uploads/invoice/' . $packagepdfname;
            $packagepdfPATH = FCPATH . '/assets/uploads/invoice/' . $packagepdfname;
            // if file exist in the folder than generate it else return url, name and path
            if (!file_exists($packagepdfPATH)) {
                $this->load->library('Pdf');
                $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
                $pdf->SetTitle('Packagelist');

                // remove default header/footer
                $pdf->setPrintHeader(false);
                $pdf->setPrintFooter(true);

                $lg = array();
                $l['a_meta_charset'] = 'UTF-8';
                $l['a_meta_dir'] = 'ltr';
                $l['a_meta_language'] = 'fa';
                $lg['w_page'] = 'page';

                // set some language-dependent strings (optional)
                $pdf->setLanguageArray($lg);

                if ($completedata['lang_id'] == 'ar') {
                    $pdf->setRTL(true);
                    $pdf->SetFont('aealarabiya', '', 12);
                } else if ($completedata['lang_id'] == 'frar') {
                    $pdf->SetFont('aealarabiya', '', 12);
                } else if ($completedata['lang_id'] == 'cn') {
                    $pdf->SetFont('stsongstdlight', '', 12);
                } else if ($completedata['lang_id'] == 'in') {
                    $pdf->SetFont('freesans', '', 10);
                } else if ($completedata['lang_id'] == 'enar') {
                    $pdf->SetFont('aealarabiya', '', 12);
                } else {
                    $pdf->SetFont('helvetica', '', 10, '', 'false');
                }

                $pdf->AddPage('L');
                // create page using view file
                $packaging_page = $this->load->view('cart/pdf/packaging_pdf_without_tracking_number', $completedata, true);

                $pdf->writeHTML($packaging_page);
                $pdf->Output($packagepdfPATH, 'F');

                $response = array(
                    'url' => $packagepdfURL,
                    'created' => 'yes',
                );
            } else {
                //  if file already exist than just return url
                $response = array(
                    'url' => $packagepdfURL,
                    'created' => 'no',
                );
            }
        }
        return $response;
    }


    public function expire_price_request(){

        if ($this->config->item('limited_price_option') == "1") {
            $today = date("Y-m-d");
            $pricerequests_query = "select * from price_requests where status!=3 and expire_date='".$today."' ";
            $price_request_data = $this->db->query($pricerequests_query)->result_array();
            if (count($price_request_data) > 0) {

                foreach($price_request_data as $singlpricerequest){
                    $p_user_data = $this->comman_model->get_data_by_id("users", array("id" => $singlpricerequest['user_id']));
                    $p_existing_product = explode(",", $user_data['approved_products']);
                    $request_products = explode(",", $singlpricerequest['products']);
                    $final_products = array_diff($p_existing_product,$request_products);
                    $user_approved_products = implode(",",array_unique($final_products));
                    $this->comman_model->update_data_by_id("users",array("approved_products"=>$user_approved_products), 'id',$request_data['user_id']);
                    $this->comman_model->update_data_by_id("price_requests", array('status' =>"3"), 'id',$singlpricerequest['id']);




                }


            }


        }

    }

    /**
     * generate_pdf_via_cron
     *
     * This Function create invoice pdf, packaging pdf and email notification to customer and admin via cron job time every 10 mins using data of cart , shipping and user details.
     */
    public function generate_pdf_via_cron()
    {
        ini_set('max_execution_time', 0); // for infinite time of execution
        //get all newly created cart user data which is not executed in the cron loop
        //   $querysql = "SELECT `id`, `cart_all_data` FROM `cart_users` WHERE `cart_all_data` != '' AND (`cronStatus` = 0 OR ((`cronStatus` = 0 OR `cronStatus` = 2) AND `cronUpdatedTime` <= date_sub(now(),interval 1 hour))) ORDER BY `id` ASC LIMIT 10";

        $this->expire_price_request();


        $querysql = "SELECT payments.*,payments.order_id, cart_users.cart_all_data,cart_users.freightcom_shipment_id,cart_users.carrier_name,cart_users.incoterms FROM `payments` left join cart_users on cart_users.id=payments.order_id  WHERE cart_users.cart_all_data != '' AND (payments.cronStatus = 0 OR ((payments.cronStatus = 0 OR payments.cronStatus = 2) AND payments.cronUpdatedTime <= date_sub(now(),interval 1 hour))) ORDER BY payments.id ASC LIMIT 10";
        $all_cart_users_data = $this->db->query($querysql)->result_array();
	$this->customlog->write_log(date('y-m-d h:i:s') . ' => ' . count($all_cart_users_data) . '  Orders Fetched for Cron', "cron");
        if (count($all_cart_users_data) > 0) {

            $this->customlog->write_log(date('y-m-d h:i:s') . ' => ' . count($all_cart_users_data) . '  Orders Fetched for Cron', "cron");
            // 0 => Pending, 2 => Inprogress, 1 => Completed
            // get all cart userid and update status inprogress before its execute pdf generation process
            $allUserIds = array();
            foreach ($all_cart_users_data as $cart_users_data) {
                $allUserIds[] = $cart_users_data['id'];
            }
            $this->db->where_in('id', $allUserIds);
            $this->db->update('payments', array('cronStatus' => 0, 'cronUpdatedTime' => date('Y-m-d H:i:s')));

            $this->customlog->write_log(date('y-m-d h:i:s') . ' => ' . implode(" ", $allUserIds) . '  Payments Fetched from Cron.', "cron");
            // Loop all the cart user data
            foreach ($all_cart_users_data as $cart_users_data) {

                if ($cart_users_data['cart_all_data']) {

                    if ($cart_users_data["incoterms"] == "DAP" && $cart_users_data["carrier_name"] == "FREIGHTCOM") {
                        if (!empty($cart_users_data["freightcom_shipment_id"])) {

                            $apisetting = $this->cart_model->get_freightcom_api_settings($cart_users_data['ship_country_code']);
                            if (empty($apisetting)) {
                                $apisetting = $this->cart_model->get_freightcom_api_settings();
                            }

                            $this->load->library('FreightShipping');
                            $this->freightshipping->addField('client_token', trim($apisetting['client_token']));

                            $freightcom_response = $this->freightshipping->get_shipping_details($cart_users_data["freightcom_shipment_id"]);

                                //  echo "<pre>";
                                //                                 print_r($freightcom_response);
                                //                                 // exit;

                            if ($freightcom_response['status'] == "success" && !empty($freightcom_response['shipment']->id)) {

                                $freightcom_response = $freightcom_response['shipment'];

                                $alllabels = $freightcom_response->labels;
                                $tracking_numbers = $freightcom_response->tracking_numbers[0];

                                // echo "<pre>";
                                // print_r($tracking_numbers);
                                // exit;

                                $this->db->where_in('id', $allUserIds);
                                $this->db->update('cart_packages', array('tracking_number' => $tracking_numbers));

                                $label_url = "";

                                foreach ($alllabels as $singlelabel) {

                                    if ($singlelabel->size == "a6" && $singlelabel->format == "pdf" && $singlelabel->padded == "") {
                                        $label_url = $singlelabel->url;

                                    }

                                }

                                foreach ($freightcom_response->details->packaging_properties->packages as $pkey => $singlePackageResults) {

                                    $path = FCPATH . '/assets/uploads/invoice/';
                                    $file_name_pdf = 'Shipping_label_' . $tracking_numbers . '.pdf';
                                    $filepdf = $path . $file_name_pdf;
                                    if ($label_url != "") {
                                        //save the file by using base name
                                        if (file_put_contents($filepdf, file_get_contents($label_url))) {
                                            // echo "File downloaded successfully!";
                                        }
                                    }

                                }

                                // Read and store the cart all data in the single varaible
                                $cart_user_id = $cart_users_data['order_id'];
                                $payment_id = $cart_users_data['id'];

                                $cart_data = unserialize($cart_users_data['cart_all_data']);

                                $payments_data = $cart_users_data;

                                $lang_id = (!empty($cart_data['lang_num'])) ? $cart_data['lang_num'] : $this->lang->default_lang_id;

                                //get user language data content from common table
                                $userLangData = get_user_lang_data(array('general_instruction', 'cart_instruction', 'email_instruction', 'sales_order_preview', 'payment_instructions'), $lang_id);

                                // create all the required data array.
                                $staticData = array(
                                    'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $lang_id, 'home_page_country')),
                                    'product_items' => $this->product_items_model->getproductitems_data('product_group', $lang_id),
                                    'product_model_items' => $this->product_items_model->getproductitems_data('product_model', $lang_id),
                                    'general_instruction' => (object) $userLangData['general_instruction'],
                                    'cart_instruction' => (object) $userLangData['cart_instruction'],
                                    'email_instruction' => (object) $userLangData['email_instruction'],
                                    'sales_order_preview' => $userLangData['sales_order_preview'],
                                    'payment_instruction' => (object) $userLangData['payment_instructions'],
                                    'payments' => $payments_data,
                                );

                                //merge the data array with cart related data
                                $completedata = array_merge($staticData, $cart_data);
                                $result = $this->cart_model->getInvoiceDetails($cart_users_data['id']);
                                $completedata['cart_package_data'] = $result['cart_package_data'];
                                $completedata['cart_package_details'] = $result['cart_package_details'];

                                // echo "<pre>";
                                // print_r($completedata['cart_package_data']);
                                // exit;

                                $invoiceStatus = 0; // initailize invoiceStatus as zero
                                $this->customlog->write_log(date('y-m-d h:i:s') . ' => For Payment ' . $payment_id . ' pdf creation process started.', "cron");

                                //call the invoice pdf generate function , if its success then below code will be execute.
                                $invoiceResponse = $this->generate_invoice_pdf($completedata, 'cron');

                                if (isset($invoiceResponse['created']) && $invoiceResponse['created'] == 'yes') {
                                    $this->customlog->write_log(date('y-m-d h:i:s') . ' => For Payment ' . $payment_id . ' invoice  pdf created successfully.', "cron");

                                    // Trigger the email notification to customer and admin with attached invoice pdf
                                    $this->send_invoice_email('customer', $cart_user_id, $completedata, $lang_id);
                                    $this->send_invoice_email('admin', $cart_user_id, $completedata, $lang_id);

                                    $coupon_applied = $cart_data['coupon_applied'];
                                    $coupon_data = $cart_data['coupon_data'];

                                    if ($coupon_applied == "1" && $coupon_data['refferal_users'] != "") {

                                        $this->send_invoice_email('refuser', $cart_user_id, $completedata, $lang_id);
                                    }

                                    // Trigger the email notification to shipping section with attached package pdf
                                    $packageResponse = $this->generate_packaging_pdf($completedata, 'cron');
                                    if (isset($packageResponse['created']) && $packageResponse['created'] == 'yes') {
                                        $this->customlog->write_log(date('y-m-d h:i:s') . ' => For Payment ' . $payment_id . ' packaging pdf created success.', "cron");

                                        $this->send_package_email_admin($cart_user_id, $completedata, $lang_id);
                                    } else {

                                        $this->customlog->write_log(date('y-m-d h:i:s') . ' => For Payment ' . $payment_id . ' packaging pdf not created successfully.', "cron");
                                    }

                                    $invoiceStatus = 1; // initailize invoiceStatus as success
                                }

                                // update the cron & invoice status in the cart user table.
                                $updateData = array(
                                    'cronStatus' => 1,
                                    'invoiceStatus' => 1,
                                    'cronUpdatedTime' => date('Y-m-d H:i:s'),
                                );
                               $this->comman_model->update_column('payments', array('id' => $payment_id), $updateData);
                            }
                        }
                    } else {

                        // Read and store the cart all data in the single varaible
                        $cart_user_id = $cart_users_data['order_id'];
                        $payment_id = $cart_users_data['id'];

                        $cart_data = unserialize($cart_users_data['cart_all_data']);
                        $payments_data = $cart_users_data;

                        $lang_id = (!empty($cart_data['lang_num'])) ? $cart_data['lang_num'] : $this->lang->default_lang_id;

                        //get user language data content from common table
                        $userLangData = get_user_lang_data(array('general_instruction', 'cart_instruction', 'email_instruction', 'sales_order_preview', 'payment_instructions'), $lang_id);

                        // create all the required data array.
                        $staticData = array(
                            'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $lang_id, 'home_page_country')),
                            'product_items' => $this->product_items_model->getproductitems_data('product_group', $lang_id),
                            'product_model_items' => $this->product_items_model->getproductitems_data('product_model', $lang_id),
                            'general_instruction' => (object) $userLangData['general_instruction'],
                            'cart_instruction' => (object) $userLangData['cart_instruction'],
                            'email_instruction' => (object) $userLangData['email_instruction'],
                            'sales_order_preview' => $userLangData['sales_order_preview'],
                            'payment_instruction' => (object) $userLangData['payment_instructions'],
                            'payments' => $payments_data,
                        );

                        //merge the data array with cart related data
                        $completedata = array_merge($staticData, $cart_data);

                        $invoiceStatus = 0; // initailize invoiceStatus as zero
                        $this->customlog->write_log(date('y-m-d h:i:s') . ' => For Payment ' . $payment_id . ' pdf creation process started.', "cron");



                        //call the invoice pdf generate function , if its success then below code will be execute.
                        $invoiceResponse = $this->generate_invoice_pdf($completedata, 'cron');

                        if (isset($invoiceResponse['created']) && $invoiceResponse['created'] == 'yes') {
                            $this->customlog->write_log(date('y-m-d h:i:s') . ' => For Payment ' . $payment_id . ' invoice  pdf created successfully.', "cron");

                            // Trigger the email notification to customer and admin with attached invoice pdf
                            $this->send_invoice_email('customer', $cart_user_id, $completedata, $lang_id);
                            $this->send_invoice_email('admin', $cart_user_id, $completedata, $lang_id);

                            $coupon_applied = $cart_data['coupon_applied'];
                            $coupon_data = $cart_data['coupon_data'];

                            if ($coupon_applied == "1" && $coupon_data['refferal_users'] != "") {

                                $this->send_invoice_email('refuser', $cart_user_id, $completedata, $lang_id);
                            }

                            // Trigger the email notification to shipping section with attached package pdf
                            $packageResponse = $this->generate_packaging_pdf($completedata, 'cron');
                            if (isset($packageResponse['created']) && $packageResponse['created'] == 'yes') {
                                $this->customlog->write_log(date('y-m-d h:i:s') . ' => For Payment ' . $payment_id . ' packaging pdf created success.', "cron");

                                $this->send_package_email_admin($cart_user_id, $completedata, $lang_id);
                            } else {

                                $this->customlog->write_log(date('y-m-d h:i:s') . ' => For Payment ' . $payment_id . ' packaging pdf not created successfully.', "cron");
                            }

                            $invoiceStatus = 1; // initailize invoiceStatus as success
                        }

                        // update the cron & invoice status in the cart user table.
                        $updateData = array(
                            'cronStatus' => 1,
                            'invoiceStatus' => $invoiceStatus,
                            'cronUpdatedTime' => date('Y-m-d H:i:s'),
                        );
			$this->comman_model->update_column('payments', array('id' => $payment_id), $updateData);

                    }
                } else {
                    $this->customlog->write_log(date('y-m-d h:i:s') . ' => For Payment ' . $payment_id . ' cart all data is not saved.', "cron");
                }
            }
        } else {
            $this->expire_trial();

            // $this->customlog->write_log(date('y-m-d h:i:s') . ' No Order Fetched', "cron");
        }

        echo "OK";
        exit;
    }

    /**
     * Method auto_term_cron
     * This Function send email to customer for the reminder of payment. Remove Credit term on reach the date.
     * @return void
     */
    public function auto_term_cron()
    {
        $today = date("Y-m-d");
        $tomorrow = date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days'));
        $third_day = date('Y-m-d', strtotime(date('Y-m-d') . ' + 2 days'));

        $dates[] = $today;
        $dates[] = $tomorrow;
        $dates[] = $third_day;

        $dates_string = implode("','", $dates);
        // Sending reminder will send email between 9 to 6 only  this will be a different function
        // send reminder email about payment  1 day before
        $querypayment = "SELECT surname,email,user_id,amount,currency,last_payment_date,invoice_number FROM `cart_users` WHERE payment_method='2' and payment_approved='2' and last_payment_date in ('" . $dates_string . "')";
        $querypayment_result = $this->db->query($querypayment)->result_array();
        if (count($querypayment_result) > 0) {
            $this->customlog->write_log(date('y-m-d h:i:s') . ' => ' . count($querypayment_result) . '  Orders Fetched for payment reminder', "autoterm");
            // 0 => Pending, 2 => Inprogress, 1 => Completed
            // get all cart userid and update status inprogress before its execute pdf generation process
            $allUserIds = array();
            foreach ($querypayment_result as $querypayment_single) {
                $this->send_reminder_email("payment", $querypayment_single);
            }
        }

        // send remain about credit term 1 day before
        $creditreminder = "select user_terms.*,users.email,users.surname from user_terms left join users on users.id = user_terms.user_id WHERE user_terms.`expire_date`in ('" . $dates_string . "')";
        $this->customlog->write_log(date('y-m-d h:i:s') . ' => ' . $creditreminder . ' ', "autoterm");
        $creditreminder_result = $this->db->query($creditreminder)->result_array();
        if (count($creditreminder_result) > 0) {

            $this->customlog->write_log(date('y-m-d h:i:s') . ' => ' . count($creditreminder_result) . ' Data Fetched for Credit term expire  reminder', "autoterm");
            foreach ($creditreminder_result as $creditreminders_ingle) {
                $this->send_reminder_email("term", $creditreminders_ingle);
            }
        }

        // Disable will run in the night  one time only  at 12:05

        // disable credit term if payment of any order is not received
        $payment_date_query = "SELECT email,user_id FROM `cart_users` WHERE payment_method='2' and payment_approved='2' and last_payment_date< '" . $today . "' ";
        $payment_date_result = $this->db->query($payment_date_query)->result_array();

        if (count($payment_date_result) > 0) {

            $this->customlog->write_log(date('y-m-d h:i:s') . ' => ' . count($payment_date_result) . ' Data Fetched for payment term', "autoterm");
            foreach ($payment_date_result as $payment_date_single) {
                $query = "UPDATE user_terms SET credit_term_status='3'   WHERE user_id=" . $payment_date_single['user_id'];
                $this->db->query($query);
                $query2 = "UPDATE credit_term_requests SET status='3'   WHERE user_id=" . $payment_date_single['user_id'];
                $this->db->query($query2);
            }
        }

        // run loop and make array for the user id to disable the credit term

        $term_expire_users = "SELECT user_id FROM `user_terms` WHERE expire_date < '" . $today . "'";
        $term_expire_users_result = $this->db->query($term_expire_users)->result_array();

        foreach ($term_expire_users_result as $singleuser) {
            $query3 = "UPDATE credit_term_requests SET status='3'   WHERE user_id=" . $singleuser['user_id'];
            $this->db->query($query3);
        }

        // disable credit term if payment date is previous date
        $updateterm = "UPDATE user_terms SET credit_term_status='3'   WHERE expire_date < '" . $today . "'";
        $updateterm = $this->db->query($updateterm);
    }

    /**
     * Method remind_quotations
     * This Function email  customers having quotations with email me me option.
     * @return void
     */
    public function remind_quotations()
    {
        $this->load->library('Clicpay');
        // this function  check back order product status
        $currency = getDefaultCurrencyCode();
        $retunrurl = base_url() . 'payment/createChargeForclictopay';
        $amount = "4343";
        $randomString = time() . rand(10, 100) . rand(111, 222);
        $this->clicpay->addField('amount', $amount);
        $this->clicpay->addField('retunrurl', $retunrurl);
        $this->clicpay->addField('currency', $currency);
        $this->clicpay->addField('orderNumber', $randomString);
        $responce = $this->clicpay->generateFormURL();

        if ($responce['status'] == "success") {
            // send remain about credit term 1 day before
            $quotationtreminder = "select quotations.*,users.email,users.surname from quotations left join users on users.id = quotations.user_id WHERE quotations.email_me=1 group by users.email limit 10";
            $this->customlog->write_log(date('y-m-d h:i:s') . ' => ' . $quotationtreminder . ' ', "quotreminder");
            $quotationtreminder_result = $this->db->query($quotationtreminder)->result_array();
            if (count($quotationtreminder_result) > 0) {

                $this->customlog->write_log(date('y-m-d h:i:s') . ' => ' . count($quotationtreminder_result) . ' Data Fetched for Credit term expire  reminder', "quotreminder");
                foreach ($quotationtreminder_result as $quotationtremindes_single) {
                    echo $quotationtremindes_single['email'];
                    $this->send_reminder_email("quotation_email", $quotationtremindes_single);
                }
            }
        } else {
            echo $quotationtreminder = "Gateway is not working.";
            $this->customlog->write_log(date('y-m-d h:i:s') . ' => ' . $quotationtreminder . ' ', "quotreminder");
        }
    }

    /**
     * Method expire_trial
     * This Function check trial of the store and if it expire it mark the satus of it.
     * @return void
     */
    public function expire_trial()
    {
        $commission_trial = $this->config->item('commission_trial');
        $commission_trial_expired_date = $this->config->item('commission_trial_expired_date');
        $commission_term_status = $this->config->item('commission_term_status');

        $store_url = substr(getenv('ASSET_URL'), 0, -1);
        $db2 = $this->load->database('kondarsoft', true);
        $db2->where("store_url", $store_url);
        $store_query = $db2->get("signup_final_data");
        $store_data = $store_query->row_array();
        if (!empty($store_data)) {
            $commission_trial = $this->config->item('commission_trial');
            $db2->select_sum('total_amount');
            $db2->where("store_id", $store_data['id']);
            $amount_query = $db2->get('orders');
            $amount_data = $amount_query->row_array();
            $total_amount = $amount_data['total_amount'];

            if (($total_amount >= $store_data['trial_amount'] || $commission_trial_expired_date < date("Y-m-d")) && $commission_trial == "1") {

                $db2->where("id", $store_data['id']);
                $db2->update("signup_final_data", array("trial_expired" => "1"));
                $db2->close();

                $this->db->where('setting_name', 'commission_trial');
                $this->db->update('global_settings', array('setting_value' => "0"));

                $this->db->where('setting_name', 'commission_trial_amount');
                $this->db->update('global_settings', array('setting_value' => "0"));

                // Email Related to comminsion term expire
                $email_instruction = (object) get_user_lang_data(array('email_instruction'), $this->lang->default_lang_id)['email_instruction'];

                $this->load->library('Email');
                $config = $this->config->item('emailconfig');
                $this->email->initialize($config);
                // set variable for  email function
                // set variable for  email function
                $fromeMailId = $this->config->item('fromemailaddress');
                $fromName = $email_instruction->admin_cart_mail_fromname;
                $toEmailId = $store_data['email'];
                $signature = $email_instruction->admin_cart_mail_fromname;
                $subject = $email_instruction->commission_expire_subject;
                $msg = htmlspecialchars_decode($email_instruction->commission_expire_message);
                $name = $store_data['title'] . ' ' . $store_data['firstname'] . ' ' . $store_data['lastname'];
                $msg = str_replace('{name}', $name, $msg);
                $msg = str_replace('{STOREURL}', $store_data['store_url'], $msg);
                $msg = str_replace('{signature}', $signature, $msg);
                $this->email->set_newline("\r\n");
                $this->email->from($fromeMailId, $fromName);
                $this->email->to($toEmailId);
                $this->email->set_header("To", $name . '<' . $toEmailId . '>');
                $this->email->subject($subject);
                $this->email->message($msg);
                // This Functions send email and clear email configuration
                $this->email->send();
                //echo $this->email->print_debugger();exit;
                $this->email->clear(true);
            }
        }
    }

    /**
     * Method send_reminder_email
     *
     * @param $type $type [payment and Term]
     * @param $data $data [data for the email]
     *
     * @return void
     */
    public function send_reminder_email($type = 'payment', $data)
    {
        // get customer  id from the cart session
        //  $lang_id =  $this->lang->default_lang_id;

        $lang_id = (!empty($data['lang_num'])) ? $data['lang_num'] : $this->lang->default_lang_id;

        if (!empty($data)) {
            // This Function load email library
            $this->load->library('Email');

            // This Function load email configuration from config file and intialize the library
            $config = $this->config->item('emailconfig');
            $this->email->initialize($config);

            // This Function get email body content subject and from address  from the table email_instruction these values are manageable from the admin side
            $email_instruction = (object) get_user_lang_data(array('email_instruction'), $lang_id)['email_instruction'];

            if ($type == 'payment') {
                // set variable for  email function
                $fromeMailId = $this->config->item('fromemailaddress');
                $fromName = $email_instruction->admin_cart_mail_fromname;
                $toEmailId = $data['email'];
                $toName = $data['surname'];
                $signature = $email_instruction->admin_cart_mail_fromname;
                $subject = $email_instruction->payment_reminder_subject;
                $msg = htmlspecialchars_decode($email_instruction->payment_reminder);
                $msg = str_replace('{name_details}', $data['surname'], $msg);
                $msg = str_replace('{ORDER_NO}', $data['invoice_number'], $msg);
                $msg = str_replace('{LAST_DATE}', $data['last_payment_date'], $msg);
                $msg = str_replace('{AMOUNT}', $data['amount'] . " " . $data['currency'], $msg);
                $msg = str_replace('{signature}', $signature, $msg);
            } else if ($type == 'term') {
                // set variable for  email function
                $fromeMailId = $this->config->item('fromemailaddress');
                $fromName = $email_instruction->admin_cart_mail_fromname;
                $toEmailId = $data['email'];
                $toName = $data['surname'];
                $signature = $email_instruction->admin_cart_mail_fromname;
                $subject = $email_instruction->term_reminder_subject;
                $msg = htmlspecialchars_decode($email_instruction->term_reminder);
                $msg = str_replace('{EXPIREDATE}', $data['expire_date'], $msg);
                $msg = str_replace('{name_details}', $data['surname'], $msg);
                $msg = str_replace('{signature}', $signature, $msg);
            } else if ($type == 'quotation_email') {
                // set variable for  email function
                $fromeMailId = $this->config->item('fromemailaddress');
                $fromName = $email_instruction->admin_cart_mail_fromname;
                $toEmailId = $data['email'];
                $toName = $data['surname'];
                $signature = $email_instruction->admin_cart_mail_fromname;
                $subject = $email_instruction->gateway_reminder_subject;
                $msg = htmlspecialchars_decode($email_instruction->gateway_reminder);
                $msg = str_replace('{name_details}', $data['surname'], $msg);
                $msg = str_replace('{signature}', $signature, $msg);
            }

            // check if language is not an english, then will fetch sender name for english becoz send grid not support or not validated other language sender name
            if ($lang_id != 13) {
                // $fromName = get_user_lang_data(array('email_instruction'), 13)['email_instruction']['admin_cart_mail_fromname'];
            }

            $this->email->set_newline("\r\n");
            $this->email->from($fromeMailId, $fromName);
            $this->email->to($toEmailId);
            $this->email->set_header("To", $toName . '<' . $toEmailId . '>');
            $this->email->subject($subject);
            $this->email->message($msg);
            // This Functions send email and clear email configuration
            $this->email->send();
            //echo $this->email->print_debugger();exit;
            $this->email->clear(true);
        }
    }

    /**
     * send_invoice_email
     * This Function Send order details  email to customer with attached invoice  on completion of order.
     * @return void
     */
    public function send_invoice_email($type = 'customer', $cart_user_id = '', $completedata = "", $lang_id = '')
    {
        // get customer  id from the cart session
        $cart_user_id = $cart_user_id ? $cart_user_id : $this->session->userdata('cart_user_id');

        $lang_id = $lang_id ? $lang_id : $this->lang->default_lang_id;

        if (isset($cart_user_id) && $cart_user_id != '') {
            // This Function load email library
            $this->load->library('Email');

            // This Function load email configuration from config file and intialize the library
            $config = $this->config->item('emailconfig');
            $this->email->initialize($config);

            // This Function get email body content subject and from address  from the table email_instruction these values are manageable from the admin side
            $userdata = get_user_lang_data(array('email_instruction', 'general_instruction'), $lang_id);
            $email_instruction = (object) $userdata['email_instruction'];

            // This Function return details of invoice number and customer details
            $result = $this->cart_model->getInvoiceDetails($cart_user_id);

            $cart_users_data = $result['cart_users_data'];
            $invoicepdfname = 'Invoice_' . $completedata['payments']['invoice_number'] . '.pdf';
            $invoicepdfpath = FCPATH . '/assets/uploads/invoice/' . $invoicepdfname;

            //This is function return general instruction from which we will get dynamic kondarsoft_solution
            $general_instruction = (object) $userdata['general_instruction'];
            $kondarsoft_solutions = $general_instruction->kondarsoft_solutions;

            if ($type == 'customer') {
                // set variable for  email function
                $fromeMailId = $this->config->item('fromemailaddress');
                $fromName = $email_instruction->admin_cart_mail_fromname;
                $toEmailId = $cart_users_data['email'];
                $toName = $cart_users_data['user_name'];
                $signature = $email_instruction->admin_cart_mail_fromname;
                $subject = $email_instruction->customer_cart_mail_subject;
                // Replace variable in the email and subject content
                $subject = str_replace('{invoice_number}', invoicenumber_front($completedata['payments']['invoice_number']), $subject);
                $msg = htmlspecialchars_decode($email_instruction->cart_mail);
                $msg = str_replace('{name_details}', $cart_users_data['user_name'], $msg);
                $msg = str_replace('{invoice_number}', invoicenumber_front($completedata['payments']['invoice_number']), $msg);
                $msg = str_replace('{signature}', $signature, $msg);
            } else if ($type == 'admin') {
                // set variable for  email function
                $fromeMailId = $this->config->item('fromemailaddress');
                $fromName = $email_instruction->admin_cart_mail_fromname;
                $toEmailId = $email_instruction->admin_invoice_email_to_list;
                $toName = $kondarsoft_solutions;
                $subject = $email_instruction->admin_invoice_email_subject;
                $msg = htmlspecialchars_decode($email_instruction->admin_invoice_email_body);
                // Replace variable in the email and subject content
                $msg = str_replace('{name}', 'Sales Team', $msg);
                $msg = str_replace('{invoice_number}', $completedata['payments']['invoice_number'], $msg);
                $msg = str_replace('{rfq_number}', $cart_users_data['order_number'], $msg);
            } else if ($type == 'refuser') {

                $coupon_applied = $cart_users_data['coupon_applied'];
                $coupon_data = unserialize($cart_users_data['coupon_data']);

                $to_refemail = "";
                if ($coupon_applied == "1" && $coupon_data['refferal_users'] != "") {

                    $to_refemail = $this->comman_model->get_ref_user_emails($coupon_data['refferal_users']);
                }
                // set variable for  email function
                $fromeMailId = $this->config->item('fromemailaddress');
                $fromName = $email_instruction->admin_cart_mail_fromname;
                // ref users list
                $toEmailId = $to_refemail;
                $toName = $kondarsoft_solutions;
                $subject = $email_instruction->invoice_ref_subject;
                $msg = htmlspecialchars_decode($email_instruction->invoice_ref_content);
                // Replace variable in the email and subject content
                $msg = str_replace('{invoice_number}', $completedata['payments']['invoice_number'], $msg);
                $msg = str_replace('{rfq_number}', $cart_users_data['order_number'], $msg);
            }

            // check if language is not an english, then will fetch sender name for english becoz send grid not support or not validated other language sender name
            if ($lang_id != 13) {
                //  $fromName = get_user_lang_data(array('email_instruction'), 13)['email_instruction']['admin_cart_mail_fromname'];
            }

            $this->email->set_newline("\r\n");
            $this->email->from($fromeMailId, $fromName);
            $this->email->to($toEmailId);
            $this->email->set_header("To", $toName . '<' . $toEmailId . '>');
            $this->email->subject($subject);
            $this->email->message($msg);
            // This Function attach invoice and tax exoneration file
            $this->email->attach($invoicepdfpath);
            if (isset($cart_users_data['tax_exoneration_file']) && $cart_users_data['tax_exoneration_file'] != '') {
                $this->email->attach(FCPATH . '/assets/uploads/cart/' . $cart_users_data['tax_exoneration_file']);
            }

            if (isset($cart_users_data['po_file']) && $cart_users_data['po_file'] != '') {
                $this->email->attach(FCPATH . '/assets/uploads/cart/' . $cart_users_data['po_file']);
            }

            if ($toEmailId != "") {
                // This Functions send email and clear email configuration
                $this->email->send();
            }
            //echo $this->email->print_debugger();exit;
            $this->email->clear(true);
        }
    }

    /**
     * send_package_email_admin
     * This Function Send shipping packages details with attached files to the emails specified on admin side.
     * @return void
     */
    public function send_package_email_admin($cart_user_id = '', $completedata = '', $lang_id = '')
    {
        // get customer  id from the cart session
        $cart_user_id = $cart_user_id ? $cart_user_id : $this->session->userdata('cart_user_id');

        $lang_id = $lang_id ? $lang_id : $this->lang->default_lang_id;

        if (isset($cart_user_id) && $cart_user_id != '') {
            // This Function load email configuration from config file and intialize the library
            $this->load->library('Email');
            $config = $this->config->item('emailconfig');
            $this->email->initialize($config);

            // This Function get email body content subject and from address  from the table email_instruction these values are manageable from the admin side
            $email_instruction = (object) get_user_lang_data(array('email_instruction'), $lang_id)['email_instruction'];
            // This Function return details of invoice number and customer details
            $result = $this->cart_model->getInvoiceDetails($cart_user_id);

            $cart_users_data = $result['cart_users_data'];
            $cart_package_data = $result['cart_package_data'];
            $cart_package_details = $result['cart_package_details'];

            $fromemailid = $this->config->item('fromemailaddress');
            $fromName = $email_instruction->admin_cart_mail_fromname;
            $subject = $email_instruction->admin_packagelist_email_subject;

            // check if language is not an english, then will fetch sender name for english becoz send grid not support or not validated other language sender name
            if ($lang_id != 13) {
                //  $fromName = get_user_lang_data(array('email_instruction'), 13)['email_instruction']['admin_cart_mail_fromname'];
            }

            // Replace variable in the email content
            $msg = htmlspecialchars_decode($email_instruction->admin_packagelist_email_body);
            $msg = str_replace('{name}', 'Packaging Team', $msg);
            $msg = str_replace('{invoice_number}', $cart_users_data['order_number'], $msg);
            $msg = str_replace('{rfq_number}', $cart_users_data['order_number'], $msg);

            $email = $email_instruction->admin_packagelist_email_to_list;
            $this->email->from($fromemailid, $fromName);
            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($msg);
            // This Function attach packaging list files  according to conditions
            if ($cart_users_data['incoterms'] == 'DAP') {
                if (!empty($cart_package_details)) {
                    foreach ($cart_package_details as $cart_package) {
                        if (isset($cart_package['tracking_number']) && $cart_package['tracking_number'] != '') {
                            $packageListPdfName = 'Packagelist_' . $cart_users_data['order_number'] . '_' . $cart_package['package_name'] . '_' . $cart_package['tracking_number'] . '.pdf';
                            $this->email->attach(FCPATH . '/assets/uploads/invoice/' . $packageListPdfName);

                            $labeljpg = FCPATH . '/assets/uploads/invoice/Shipping_label_' . $cart_package['tracking_number'] . '.jpeg';
                            $labelpng = FCPATH . '/assets/uploads/invoice/Shipping_label_' . $cart_package['tracking_number'] . '.png';
                            $labelpdf = FCPATH . '/assets/uploads/invoice/Shipping_label_' . $cart_package['tracking_number'] . '.pdf';

                            if (file_exists($labeljpg)) {
                                $shipping_label_image = 'Shipping_label_' . $cart_package['tracking_number'] . '.jpeg';
                                $this->email->attach(FCPATH . '/assets/uploads/invoice/' . $shipping_label_image);
                            }

                            if (file_exists($labelpng)) {
                                $shipping_label_image = 'Shipping_label_' . $cart_package['tracking_number'] . '.png';
                                $this->email->attach(FCPATH . '/assets/uploads/invoice/' . $shipping_label_image);
                            }
                            if (file_exists($labelpdf)) {
                                $shipping_label_pdf = 'Shipping_label_' . $cart_package['tracking_number'] . '.pdf';
                                $this->email->attach(FCPATH . '/assets/uploads/invoice/' . $shipping_label_pdf);
                            }
                        }
                    }
                }
            } else {
                $packageListPdfName = 'Packagelist_' . $completedata['cart_users_data']['order_number'] . '.pdf';
                $this->email->attach(FCPATH . '/assets/uploads/invoice/' . $packageListPdfName);
            }
            // This Function send email and clear email configuration
            $this->email->send();
            $this->email->clear(true);
        }
    }

    /**
     * logout
     *
     * This Function clear all session variables from the session and delete record related to current user  from table entry_door_front_shopping_data.
     * @return void
     */
    public function logout()
    {

        // clear all session variables
        /*$this->session->unset_userdata('cart_final_currency');
        $this->session->unset_userdata('cart_final_price');
        $this->session->unset_userdata('last_inserted_cart_block_id');
        $this->session->unset_userdata('edit_cart_mode');
        $this->session->unset_userdata('cart_sms_attempt');
        $this->session->unset_userdata('cart_email_attempt');
        $this->session->unset_userdata('cart_users_data');
        $this->session->unset_userdata('new_cart');
        $this->session->unset_userdata('cart_selected_dropdowns');
        $this->session->unset_userdata('cart_msg');
        $this->session->unset_userdata('vehicle_maker_id_and_cat_id_pair');
        $this->session->unset_userdata('model_id');
        $this->session->unset_userdata('maker_id');
        $this->session->unset_userdata('vehicle_category_id');
        $this->session->unset_userdata('entry_sms_attempt');
        $this->session->unset_userdata('entry_email_attempt');
        $this->session->unset_userdata('cart');
        $this->session->unset_userdata('coupon_applied');
        $this->session->unset_userdata('coupon_data');

         */

        $session_user = $this->session->userdata('front_validuser_data');
        $where_param['email'] = $session_user['email'];
        $where_param['country_code'] = $session_user['country_code'];
        $where_param['telephone'] = $session_user['telephone'];

        // Delete records from the entry_door_front_shopping_data using email and phone from user session.
        $this->comman_model->delete_row("entry_door_front_shopping_data", $where_param);
        $this->session->sess_destroy();

        /* $this->session->unset_userdata('front_validuser_data');
        $this->session->unset_userdata('entry_email_attempt');
        $this->session->unset_userdata('entry_sms_attempt');
        $this->session->unset_userdata('email_confirm');
        $this->session->unset_userdata('entry_email_confirm_status');
        $this->session->unset_userdata('sms_confirm');
        $this->session->unset_userdata('entry_sms_confirm_status');
        $this->session->unset_userdata('entry_users_data');
        $this->session->unset_userdata('front_va+liduser_data');
        $this->session->unset_userdata('email_randomString');
        $this->session->unset_userdata('sms_randomString');
        $this->session->unset_userdata('default_currency_code');
        $this->session->unset_userdata('logged_user_id');
         */

        redirect(base_url() . '/' . $this->lang->default_lang . '/products', 'refresh');
    }

    /**
     * Method checkCouponexist
     * This Function checked that is Coupon number is valid or not.
     * @return void
     */
    public function checkCouponexist()
    {
        $coupon_code = $this->security->xss_clean($this->input->post('coupon_code'));
        if ($coupon_code) {
            // this function check is coupon   exist in the table  or not.
            $valid = iscoupon_valid($coupon_code);
            if ($valid['status'] == 1) {
                $coupon_data = $this->comman_model->get_coupon_data($this->input->post('coupon_code'));
                $session_data = array('coupon_applied' => "1", "coupon_data" => $coupon_data);
                $this->session->set_userdata($session_data);
            }
            echo json_encode($valid);
        }
    }

    /**
     * Method checkCouponexist
     * This Function checked that is Coupon number is valid or not.
     * @return void
     */
    public function deleteCoupon()
    {

        $this->session->unset_userdata('coupon_applied');
        $this->session->unset_userdata('coupon_data');
        $valid['status'] = 1;
        echo json_encode($valid);
    }

    /**
     * Method fetch_discountprice
     * This Function checked the price as per .
     * @return void
     */
    public function fetch_discountprice()
    {

        $coupon_applied = $this->session->userdata('coupon_applied') ? $this->session->userdata('coupon_applied') : "";
        $coupon_data = $this->session->userdata('coupon_data') ? $this->session->userdata('coupon_data') : "";
        $price = $this->security->xss_clean($this->input->post('product_price'));
        $productid = $this->security->xss_clean($this->input->post('product_id'));
        $quantity = $this->security->xss_clean($this->input->post('quantity'));
        $responce = array();
        $userLangData = get_user_lang_data(array('general_instruction'), $this->lang->default_lang_id);
        $general_instruction = (object) $userLangData['general_instruction'];
        $currencyV = getDefaultCurrencyCode('l') . '_currency';
        $currency = $general_instruction->$currencyV;

        $u_price_v = "";
        $u_price = "";
        $d_price = "";
        $d_price_v = "";

        $final_discount = "";
        $final_discount_v = "";

        // Coupon Discount Price
        if ($coupon_applied == "1") {
            $product_discount = get_product_discount($productid, $price, $quantity, $coupon_data);

            if ($product_discount['amount']) {
                $d = $price * $product_discount['percentage'] / 100;
                $d_price = round($price - $d, 2);
                $d_price_v = $d_price . ' ' . $currency . "( " . $product_discount['percentage'] . " %)";
            }
        }

        // User Discount Price
        $user_discount = get_user_product_discount($productid, $price, $quantity);
        if ($user_discount['amount']) {
            $u = $price * $user_discount['percentage'] / 100;
            $u_price = round($price - $u, 2);
            $u_price_v = $u_price . ' ' . $currency . "( " . $user_discount['percentage'] . " %)";
        }

        $final_discount = $u_price;
        $final_discount_v = $u_price_v;

        // check which once is bigger
        if ($coupon_applied == "1" && !empty($d_price) && !empty($u_price)) {
            if ($d_price < $u_price) {
                $final_discount = $d_price;
                $final_discount_v = $d_price_v;
            }
        } else if ($coupon_applied == "1" && !empty($d_price) && empty($u_price)) {
            $final_discount = $d_price;
            $final_discount_v = $d_price_v;
        }

        if (!empty($final_discount) && ($final_discount_v)) {
            // this function check is coupon   exist in the table  or not.
            $responce['status'] = 1;
            $responce['data'] = $final_discount_v;
        } else {

            $responce['status'] = 0;
        }

        echo json_encode($responce);
        exit;
    }

    /**
     * move_to_cart
     *
     * This Function add .
     * @return void
     */
    public function move_to_cart($product_number)
    {
        if (!front_on_checkout_verification()) {
            // This Function Validate the current user using email and phone from session
            validateFrontUser();
        }
        $loginuserterm = loginuserterm();

        if (!empty($this->session->userdata('cart'))) {
            $cart = $this->session->userdata('cart');
        } else {
            $cart = [];
        }

        $product_number = base64_decode(urldecode($product_number));

        if (!empty($product_number)) {

            $all_product_data = allDataArray($this->comman_model->GetAllDataLangByid('products', 'kgt_ref_number', $product_number, $this->lang->default_lang_id, 'products_country'));
            $id = $all_product_data['id'];
            $store_data = $this->comman_model->get_store_wise_quantity($id);
            if (!empty($id)) {

                $cart[$id]['quantity'] = 1;
                $cart[$id]['comment'] = '';
                $cart[$id]['item_id'] = $id;
                $cart[$id]['store_data'] = $store_data;
                $cart[$id]['store_id'] = $this->security->xss_clean($this->input->post('shipping_special_notes'));
            }
        }

        $cart = cartCleanUp($cart);
        $this->session->set_userdata('cart', $cart);
        $this->session->set_userdata('new_cart', $cart);
        $this->session->set_userdata('cart_selected_dropdowns', $cart);
        redirect('cart');
    }

    public function update_price_request()
    {

        $is_loggedin = 0;
        if (isset($this->session->userdata('front_validuser_data')['email'])) {
            $is_loggedin = 1;
        }
        $result = array();
        $result['is_loggedin'] = $is_loggedin;

        if (!empty($this->session->userdata('price_request_product'))) {
            $price_request_product = $this->session->userdata('price_request_product');
        } else {
            $price_request_product = [];
        }

        $product_number = $this->input->post('product_number');

        if (!empty($product_number)) {
            array_push($price_request_product, $product_number);
            $this->session->set_userdata('price_request_product', $price_request_product);
            $result['status'] = 1;
            $result['count'] = count($price_request_product);
            echo json_encode($result);
            exit;
        } else {

            $result['status'] = 1;
            $result['count'] = count($price_request_product);
            echo json_encode($result);
            exit;

        }
    }

    public function remove_price_request()
    {
        $price_request_product = $this->session->userdata('price_request_product');

        $result = array();
        $product_number = $this->input->post('product_number');

        if (!empty($product_number)) {
            if (($key = array_search($product_number, $price_request_product)) !== false) {
                unset($price_request_product[$key]);
            }
            $this->session->set_userdata('price_request_product', $price_request_product);
            $result['status'] = 1;
            $result['count'] = count($price_request_product);
            $result['redirect'] = base_url() . 'user/pricerequests';

            echo json_encode($result);
            exit;
        } else {

            $result['status'] = 1;
            $result['count'] = count($price_request_product);
            $result['redirect'] = base_url() . 'user/pricerequests';

            echo json_encode($result);
            exit;

        }
    }

    /**
     * update_cart_ajax
     *
     * This Function add product in the cart using ajax.
     * @return void
     */
    public function update_cart_ajax()
    {
        if (!empty($this->session->userdata('cart'))) {
            $cart = $this->session->userdata('cart');
        } else {
            $cart = [];
        }
        $result = array();
        $product_number = base64_decode(urldecode(($this->input->post('product_number'))));
        $product_number_multi = $this->input->post('product_number_multi');

        if (!empty($product_number)) {

            $all_product_data = allDataArray($this->comman_model->GetAllDataLangByid('products', 'kgt_ref_number', $product_number, $this->lang->default_lang_id, 'products_country'));
            $id = $all_product_data['id'];
            if (!empty($id)) {
                $cart[$id]['quantity'] = 1;
                $cart[$id]['comment'] = '';
                $cart[$id]['item_id'] = $id;
            }

            $cart = cartCleanUp($cart);
            $this->session->set_userdata('cart', $cart);
            $this->session->set_userdata('new_cart', $cart);
            $this->session->set_userdata('cart_selected_dropdowns', $cart);
            $result['status'] = 1;
            $result['count'] = getcartcount($cart);
            echo json_encode($result);
            exit;
        } else if (!empty($product_number_multi)) {

            foreach ($product_number_multi as $single) {

                if (!empty($this->session->userdata('cart'))) {
                    $cart = $this->session->userdata('cart');
                } else {
                    $cart = [];
                }
                if (!empty($single) && !array_key_exists($single, $cart)) {
                    $cart[$single]['quantity'] = 1;
                    $cart[$single]['comment'] = '';
                    $cart[$single]['item_id'] = $single;
                }

                $cart = cartCleanUp($cart);
                $this->session->set_userdata('cart', $cart);
                $this->session->set_userdata('new_cart', $cart);
                $this->session->set_userdata('cart_selected_dropdowns', $cart);
            }
            $result['status'] = 1;
            $result['count'] = getcartcount($cart);
            echo json_encode($result);
            exit;
        } else {
            $result['status'] = 0;
            echo json_encode($result);
            exit;
        }
    }

    // set packaging box type in session
    private function set_box_type($cart_details)
    {
        $this->load->model("package_model");
        $boxes = $this->package_model->getboxData();

        // Box Weight Array
        $onlyPackageData = $this->package_model->onlyPackageData();
        $boxweight = array();
        $boxtype = array();

        foreach ($onlyPackageData as $singleboxw) {

            $boxweight[trim($singleboxw['packagename'])] = $singleboxw['emptyweight'];
            $boxtype[trim($singleboxw['packagename'])] = $singleboxw['package_type'];

        }

        //  echo "<pre>";

        $both_box = array();

        foreach ($cart_details as $single_product) {
            $package_box = 0;
            $freight_box = 0;
            $single_product = (array) $single_product;
            // print_r($single_product);
            $item_box = explode(",", $single_product['packageId']);
            foreach ($item_box as $singlebox) {
                if ($boxtype[trim($singlebox)] == "package") {
                    $package_box = 1;
                }
                if ($boxtype[trim($singlebox)] == "freight") {
                    $freight_box = 1;
                }
            }

            if ($package_box == 1 && $freight_box == 1) {
                $both_box[] = $single_product['kgt_ref_number'];
            }

        }

        $this->session->set_userdata('package_both_box_count', count($both_box));
        $this->session->set_userdata('package_both_box', $both_box);

    }
    public function fedex_test()
    {

        $this->load->library('FedexShipping');

        $this->fedexshipping->processRate();
        //$this->fedexshipping->processfreightRate();
        //$this->fedexshipping->processshipment();
        //   $this->fedexshipping->processsfreighthipment();

    }
}
