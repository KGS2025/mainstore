<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Payment Controller
 *
 *
 * Payment Class handle all methods related to payment gateway based on admin enable. This is core file of the application.
 *
 * @author      Kondarsoft Dev Team
 * @link        https://kondarsoft.com/
 * @filesource
 */
class Payment extends MY_Controller
{

    /**
     * __construct
     *
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * Payment Method : 1=>card, 2=>credit term, 3=> online
     * Payment Approved : 0= pending, 1=> Approved, 2=> Credit Term Hold
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model(array('product_model', 'comman_model', 'cart_model', 'api_model', 'part_relation_model'));
        $this->load->helper(array('assets', 'cart_helper', 'file', 'api_helper'));
        $this->load->library('stripe');

        // this line include the bamboora payment gateway library file.
        include APPPATH . 'third_party/bambora/Gateway.php';
        include APPPATH . 'third_party/moneris/mpgClasses.php';

    }

    /**
     * index
     * This Function Called the view of the payment page according to active payment gateway.
     * @return void
     */
    public function index()
    {

        // This is new modification related to otp for guest
        $cart_2 = $this->session->userdata('new_cart');       
        // echo '<pre>';print_r($cart_2);exit;
        $cart_3 = [];
        foreach($cart_2 as $k=>$v){
            if(isset($v['frieght_package'])){
                if($v['frieght_package']=="1"){
                    $cart_3[$k] = $v;
                }
            }            
        }
        
        if(count($cart_3)>0){
            $cart_2 =$cart_3;
        }
        // echo '<pre>';print_r($cart_2);exit;
        $cart_2 = cartCleanUp($cart_2);
        $this->session->set_userdata('new_cart', $cart_2);
        //print_r($this->session->userdata('new_cart'));die();
        
        $otp_verification = $this->config->item('guestotp_verification');

        $user_id = getFrontenduserId();
        if ($otp_verification == 1 && empty($user_id)) {

            $session_data['final_price_data']['currency'] = $this->session->userdata('cart_final_currency');
            $session_data['final_price_data']['total'] = $this->session->userdata('cart_final_price');
            $session_data['final_price_data']['payment_price'] = $this->session->userdata('cart_payment_price');

            $this->session->set_userdata($session_data);

            $cart_users_data = $this->session->userdata('cart_users_data');
            $where_param = array();
            $where_param['email'] = $cart_users_data['email'];
            $where_param['country_code'] = $cart_users_data['country_code'];
            $where_param['telephone'] = $cart_users_data['telephone'];

            $select_param = '*';
            $block_info = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);
            // delete record from block data table related to email and phone
            $this->comman_model->delete_row("entry_door_front_block_data", $where_param);

            $shopping_data = array();
            $shopping_data['applicant'] = $cart_users_data['user_name'];
            $shopping_data['country'] = $cart_users_data['country'];
            $shopping_data['country_code'] = $cart_users_data['country_code'];
            $shopping_data['telephone'] = $cart_users_data['telephone'];
            $shopping_data['email'] = $cart_users_data['email'];
            $shopping_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $shopping_data['created_time'] = time();
            // Add record in the table  entry_door_front_shopping_data
            $this->comman_model->insert_column("entry_door_front_shopping_data", $shopping_data);
            $session_data = array('front_validuser_data' => $shopping_data);
            $this->session->set_userdata($session_data);

            $where_param = array();
            $where_param['id'] = 1;
            $entry_door_timer = (object) get_user_lang_data(array('entry_door_timer'), $this->lang->default_lang_id)['entry_door_timer'];
            // $shopping_data['timezone']       = trim($this->input->post('timezone'));
            $shopping_data['shopping_timer'] = $entry_door_timer->entry_door_shopping_timer;
            $this->comman_model->insert_column("users_front_entry_door", $shopping_data);
            // This Function clear all session variable which are used while validating the email and phone
            $this->clear_user_session_final();
        }

        //  This Function Validate the current user using email and phone from session
        validateFrontUser();

        $loginuserterm = loginuserterm();

        // compare session variables values if not equal than redirect to cart confirm page.
        $final_price_data = $this->session->userdata('final_price_data');

        // if paymee transaction id and token is passed using the input than save both in session and redirect to same page.
        $payment_token = $this->input->get('payment_token');
        $transaction = $this->input->get('transaction');
        if ($payment_token && $transaction) {
            $session_data = array(
                'paymee_txnId' => $this->input->get('transaction'),
                'paymee_token' => $this->input->get('payment_token'),
            );
            $this->session->set_userdata($session_data);
            redirect('payment');
        }

        $new_cart = $this->session->userdata('new_cart');
        $cartcount = getcartcount($new_cart);
        // if cart is empty than redirect to cart page
        if (empty($cartcount)) {
            redirect('cart');
        }

        $all_data = allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country'));
        $all_navigation_data = $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country');

        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'admin_static_links', 'form_validation_instruction', 'payment_instructions', 'product_instruction'), $this->lang->default_lang_id);

        $pageData = array(
            'title' => get_page_title('payment_page'),
            'timestamp' => date_timestamp_get(date_create()),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'all_data' => $all_data,
            'all_navigation_data' => $all_navigation_data,
            'cart_users_data' => $this->session->userdata('cart_users_data'),
            'front_validuser_data' => $this->session->userdata('front_validuser_data'),
            'payment_instruction' => (object) $userLangData['payment_instructions'],
            'general_instruction' => (object) $userLangData['general_instruction'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'product_instruction' => (object) $userLangData['product_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'payment_accept_icons' => $this->comman_model->get_all_data_by_id('payment_accept_card', array('status' => 1)),
            'total' => $final_price_data['payment_price'],
            'loginuserterm' => $loginuserterm,
            'currency' => $final_price_data['currency'],
            'cartcount' => $cartcount,
        );

        $footerData = array(
            'all_data' => $all_data,
            'all_navigation_data' => $all_navigation_data,
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
        );

        if ($this->config->item('payment_gateway') == 'stripe') {
            // if stripe is activated than call stripe view file

            // function related to payment intent if it is activated
            if ($this->config->item('stripe_payment_intent') == "1") {

                $currency = getDefaultCurrencyCode('l');
                $intent = $this->stripe->createintent($final_price_data['payment_price'], $currency);
                $pageData['intent'] = $intent->client_secret;
            }

            $pageData['pageType'] = 'stripepayment';
            $pageData['stripe_errors'] = $this->comman_model->getStripeErrors($this->lang->default_lang_id);
            $this->load->view('common/header', $pageData);
            $this->load->view('payment/stripe_payment', $pageData);
        } else if ($this->config->item('payment_gateway') == 'paymee') {
            // if paymee is activated than this condition will work
            $pageData['paymee_token'] = '';

            // generate paymee payment token
            $pageData['paymee_token'] = '';
            $pageData['payment_url'] = '';

            $pageData['warning'] = array();
            $apiResponse = $this->createPaymeeToken();
            if (isset($apiResponse['status']) && $apiResponse['status'] == 'success') {
                $pageData['paymee_token'] = $apiResponse['token'];
                $pageData['payment_url'] = $apiResponse['payment_url'];

                $session_data = array('paymee_token' => $apiResponse['token'], 'payment_url' => $apiResponse['payment_url']);
                $this->session->set_userdata($session_data);
            } else {
                $pageData['warning'] = $apiResponse;
            }
            $pageData['pageType'] = 'paymeepayment';

            $this->load->view('common/header', $pageData);
            // load paymee view file
            $this->load->view('payment/paymee_payment', $pageData);
        } else if ($this->config->item('payment_gateway') == 'squareup') {

            // This Function return currency code
            $currency = getDefaultCurrencyCode('l');
            $countryCode = 'ca';
            if ($currency == 'cad') {
                // if curreny is canading Dollar than country code ca or else us
                $countryCode = 'ca';
            }

            $user_id = getFrontenduserId();
            $user_cards = $this->comman_model->get_all_data_by_id("user_cards", array("user_id" => $user_id));
            // if curreny is canading Dollar than this  condition will executed
            $square_api_settings = $this->cart_model->square_api_settings($countryCode);
            $pageData['paymee_token'] = '';
            $pageData['user_id'] = $user_id;
            $pageData['user_cards'] = $user_cards;
            $pageData['square_api_settings'] = $square_api_settings;
            $pageData['pageType'] = 'squareup';
            $pageData['stripe_errors'] = array();

            $this->load->view('common/header', $pageData);
            // load paymee view file
            $this->load->view('payment/square_payment', $pageData);
        } else if ($this->config->item('payment_gateway') == 'clictopay') {
            // if paymee is activated than this condition will work
            $pageData['pageType'] = 'clictopay';
            $this->load->view('common/header', $pageData);
            //load bamboora payment view file
            $this->load->view('payment/clicktopay_payment', $pageData);
        } else if ($this->config->item('payment_gateway') == 'paypal') {
            // if paymee is activated than this condition will work
            $pageData['pageType'] = 'clictopay';
            $this->load->library('PaypalExpress');
            $paypal = $this->paypalexpress;
            if($this->config->item('payment_mode')==1){
                $testMode = false;
                $client_id = $this->config->item('paypal_client_live');
                $secret_id = $this->config->item('paypal_secret_live');
            }else{
                $testMode = true;
                $client_id = $this->config->item('paypal_client_sandbox');
                $secret_id = $this->config->item('paypal_secret_sandbox');
            }
            
            $paypal->testMode($testMode);
            $paypal->setClientId($client_id);
            $paypal->setSecretKey($secret_id);
            $pageData['paypal'] = $paypal;            
            
            $payment_unique_code = $this->unique_code();
            $this->session->set_userdata('payment_unique_code',$payment_unique_code);
            $pageData['payment_unique_code'] = $payment_unique_code;
            $pageData['cancelUrl'] = base_url()."en/payment/paypal_cancel";
            $pageData['returnUrl'] = base_url()."en/payment/paypal_return?pid=".$payment_unique_code;
            //echo '<pre>';print_r($pageData);exit;
            $this->load->view('common/header', $pageData);
            //load paypal payment view file
            $this->load->view('payment/paypal_payment', $pageData);
        } else if ($this->config->item('payment_gateway') == 'moneris') {
            // if paymee is activated than this condition will work
            $pageData['pageType'] = 'moneris';
            $this->load->view('common/header', $pageData);
            //load bamboora payment view file
            $this->load->view('payment/moneris_payment', $pageData);
        } else if ($this->config->item('payment_gateway') == 'paymentproof') {
            // if paymee is activated than this condition will work
            $pageData['pageType'] = 'paymentproof';
            $this->load->view('common/header', $pageData);
            //load bamboora payment view file
            $this->load->view('payment/paymentproof', $pageData);
        } else {
            $pageData['pageType'] = 'bamboopayment';
            $this->load->view('common/header', $pageData);
            //load bamboora payment view file
            $this->load->view('payment/bambora_payment', $pageData);
        }
        $this->load->view('common/footer', $footerData);
    }

    /**
     * charge
     * This Function is action function of the bamboora payment form. This function do payment on the behalf of token and card details.
     * @return void
     */
    public function charge()
    {

        $postdata = json_decode(file_get_contents('php://input'), 1);

        //check captcha if not valid than return error with message
        $captcha = validate_captcha($postdata['captcha']);
        if (isset($captcha['response']) && $captcha['response'] != 'success') {
            echo json_encode($captcha);
            exit;
        }

        // This Function  generate the unique code for the invoice number
        $invoice_num_unique = $this->unique_code();
        $token = isset($postdata['token']) ? $postdata['token'] : '';
        $amount = isset($postdata['amount']) ? $postdata['amount'] : '';
        $name = isset($postdata['name']) ? $postdata['name'] : '';
        $card_number = isset($postdata['card_number']) ? $postdata['card_number'] : '';
        if ($token && $amount && $name && $card_number) {
            // if required paramters are not empty than thos condition  executed

            // This function  check back order product status if error is there than  this function return responce
            $this->checkBackOrderQuantity();

            $cart_users_data = $this->session->userdata('cart_users_data');

            // This Function return currency code
            $currency = getDefaultCurrencyCode('l');
            $countryCode = 'us';
            if ($currency == 'cad') {
                // if curreny is canading Dollar than country code ca or else us
                $countryCode = 'ca';
            }

            // if curreny is canading Dollar than this  condition will executed
            $bambora_setting = $this->cart_model->bambora_ups_api_settings($countryCode);
            $merchant_id = trim($bambora_setting['merchant_id']); //INSERT MERCHANT ID (must be a 9 digit string)
            $api_key = trim($bambora_setting['api_key']); //INSERT API ACCESS PASSCODE
            $api_version = 'v1'; //default
            $platform = 'api'; //default (or use 'tls12-api' for the TLS 1.2-Only endpoint)

            $order_number = $cart_users_data['order_number'] . '2';

            // This Function HIt API and amke payment
            $beanstream = new \Beanstream\Gateway($merchant_id, $api_key, $platform, $api_version);
            $legato_payment_data = array(
                'order_number' => $order_number,
                'amount' => $amount,
                'name' => $name,
            );
            try {

                $result = $beanstream->payments()->makeLegatoTokenPayment($token, $legato_payment_data, true);
                if (!empty($result)) {

                    // This function update information in the database
                    $cart_users_data['authorizing_merchant_id'] = $result['authorizing_merchant_id'];
                    $cart_users_data['payment_approved'] = "1";
                    $cart_users_data['payment_created'] = $result['created'];
                    $cart_users_data['transaction_id'] = $result['id'];
                    $cart_users_data['payment_method'] = "1";
                    $cart_users_data['amount'] = $result['amount'];
                    $cart_users_data['currency'] = $currency;
                    $cart_users_data['invoice_number'] = $invoice_num_unique;
                    $cart_users_data['card_number'] = $card_number;

                    // This Function update information in the database and session after payment success
                    $this->cartProductFinalzeAfterPayment($invoice_num_unique, $cart_users_data);

                    // this code return json
                    echo json_encode($result);
                    exit;
                } else {
                    // in case of fail payment this code return error  message
                    $bambora_errors = $this->comman_model->getBamboraErrorsByCode('211', $this->lang->default_lang_id);
                    $error_message = '';
                    $error_message = $bambora_errors[0]['error_text'];
                    $result['error_message'] = $error_message;
                    // this code return json
                    echo json_encode($result);
                    exit;
                }
            } catch (\Beanstream\Exception $e) {
                // in case of any exception in  payment this code return error  message
                $err_message = $e->getMessage();
                $error_code = $e->getCode();

                if (strtolower($err_message) == 'approved') {
                    $bambora_errors = $this->comman_model->getBamboraErrorsByCode('1', $this->lang->default_lang_id);
                } else if (strtolower($err_message) == 'declined') {
                    $bambora_errors = $this->comman_model->getBamboraErrorsByCode('827', $this->lang->default_lang_id);
                } else if (strtolower($err_message) == 'service unavailable - please try again later') {
                    $bambora_errors = $this->comman_model->getBamboraErrorsByCode('211', $this->lang->default_lang_id);
                } else {
                    $bambora_errors = $this->comman_model->getBamboraErrorsByCode($error_code, $this->lang->default_lang_id);
                }

                $error_message = '';
                $error_message = $bambora_errors[0]['error_text'];
                $result['error_message'] = $error_message;
                // this code return json
                echo json_encode($result);
                exit;
            }
        } else {
            // if any required variable is not set for the function than this code return error in json format
            $result['error_message'] = 'Required data missing!';
            echo json_encode($result);
            exit;
        }
    }

/**
 * moneris_purchase
 *
 * This Function is executed when Stripe payment gateway is activated. This function executed on the submit of the stripe payment form.
 * @return void
 */
    public function moneris_purchase()
    {
        //check captcha
        $captcha = validate_captcha();
        if (isset($captcha['response']) && $captcha['response'] != 'success') {
            echo json_encode($captcha);
            exit;
        }

        $result = array();

        // If payment form is submitted with token
        if ($this->input->post('moneris_card')) {

            // Retrieve stripe token, card and user info from the submitted form data
            $postData = $this->input->post();

            $postData = $this->security->xss_clean($postData);

            // This Function check the quantity of the products and if not available than it retun json and stop execution of the next code.
            $this->checkBackOrderQuantity();

            // This Function make the payment and retun api responce
            $paymentID = $this->moneris_charge($postData);

            // If payment successful
            if ($paymentID) {
                // If payment successful and return transaction id than this code return transaction id and status.
                $result['transaction_id'] = $paymentID;
                $result['status'] = "success";
                echo json_encode($result);
                exit;
            } else {
                // If payment function does not return transaction id than this code return error with  status.
                $stripe_errors = $this->comman_model->getStripeErrorsByCode('do_not_honor', $this->lang->default_lang_id);
                $result['errors'] = $stripe_errors;
                $result['status'] = "error";
                echo json_encode($result);
                exit;
            }
        } else {
            $stripe_errors = $this->comman_model->getStripeErrorsByCode('do_not_honor', $this->lang->default_lang_id);
            $result['errors'] = $stripe_errors;
            $result['status'] = "error";
            echo json_encode($result);
            exit;
        }
    }
    /**
     * stripe_charge
     * This Function is child function of stripe_purchase.  This is the Final Step of the payment after generating token.
     * @param  mixed $postData
     * @return void
     */
    public function moneris_charge($postData)
    {
        // This Function  generate the unique code for the invoice number
        $invoice_num_unique = $this->unique_code();
        $cart_users_data = $this->session->userdata('cart_users_data');
        $final_price_data = $this->session->userdata('final_price_data');

        if ($this->config->item('payment_mode') == 1) {
            $store_id = $this->config->item('moneris_live_store_id');
            $api_token = $this->config->item('moneris_live_api_token');
        } else {
            $store_id = $this->config->item('moneris_sandbox_store_id');
            $api_token = $this->config->item('moneris_sandbox_api_token');
        }
        if (!empty($postData)) {
            $order_number = $cart_users_data['order_number'];
            $email = $cart_users_data['email'];
            $productname = 'KGS_' . $cart_users_data['order_number'];
            $currency = getDefaultCurrencyCode('l');
            $type = 'purchase';
            $order_id = $order_number;
            $amount = number_format($final_price_data['payment_price'], 2);
            $pan = $postData['moneris_card'];
            $expdate = $postData['moneris_date'];
            $crypt = '7';
            /************************** CVD Variables *****************************/
            $cvd_indicator = '1';
            $cvd_value = $postData['moneris_code'];

            /********************** CVD Associative Array *************************/
            $cvdTemplate = array(
                'cvd_indicator' => $cvd_indicator,
                'cvd_value' => $cvd_value,
            );

            /************************** CVD Object ********************************/
            $mpgCvdInfo = new mpgCvdInfo($cvdTemplate);

            /***************** Transactional Associative Array ********************/

            $txnArray = array(
                'type' => $type,
                'order_id' => $order_id,
                'amount' => $amount,
                'pan' => $pan,
                'expdate' => $expdate,
                'crypt_type' => $crypt,
            );

            /********************** Transaction Object ****************************/
            $mpgTxn = new mpgTransaction($txnArray);
            /************************ Set AVS and CVD *****************************/
            $mpgTxn->setCvdInfo($mpgCvdInfo);
            /************************ Request Object ******************************/

            $mpgRequest = new mpgRequest($mpgTxn);
            $mpgRequest->setProcCountryCode("CA"); //"US" for sending transaction to US environment
            if ($this->config->item('payment_mode') == 1) {
                $mpgRequest->setTestMode(false); //false or comment out this line for production transactions
            } else {
                $mpgRequest->setTestMode(true); //false or comment out this line for production transactions
            }
            /*********************** HTTPS Post Object ****************************/
            $mpgHttpPost = new mpgHttpsPost($store_id, $api_token, $mpgRequest);
            // this function hit the payment api for charge the card and return transaction id

            $mpgResponse = $mpgHttpPost->getMpgResponse();
            $TxnNumber = $mpgResponse->getTxnNumber();
            if ($TxnNumber != "null" && !empty($TxnNumber)) {

                $paidAmount = $mpgResponse->getTransAmount();

                // This function update information in the database

                $cart_users_data['amount'] = $paidAmount;
                $cart_users_data['currency'] = $currency;

                $payments = array();
                $payments['payment_type'] = $cart_users_data['payment_type'];
                $payments['payment_created'] = date('Y-m-d H:i:s');
                $payments['transaction_id'] = $TxnNumber;
                $payments['payment_method'] = '1';
                $payments['status'] = '1';
                $payments['amount'] = $paidAmount;
                $payments['currency'] = $currency;
                $payments['invoice_number'] = $invoice_num_unique;
                $payments['card_number'] = $mpgResponse->getSourcePanLast4();
                $user_id = getFrontenduserId();

                if ($user_id) {
                    $payments['user_id'] = $user_id;
                }

                $this->session->set_userdata(array('payments' => $payments));

                // This Function update information in the database and session after payment success
                $this->cartProductFinalzeAfterPayment($payments, $cart_users_data);

                // This code return transation id
                return $mpgResponse->getTxnNumber();

            }

        }
        // this return false when there is no data in form input
        return false;
    }

    /**
     * stripe_purchase
     *
     * This Function is executed when Stripe payment gateway is activated. This function executed on the submit of the stripe payment form.
     * @return void
     */
    public function stripe_purchase()
    {
        //check captcha
        $captcha = validate_captcha();
        if (isset($captcha['response']) && $captcha['response'] != 'success') {
            echo json_encode($captcha);
            exit;
        }
        
        $result = array();

        // If payment form is submitted with token
        
        if ($this->input->post('token')) {

            // Retrieve stripe token, card and user info from the submitted form data
            $postData = $this->input->post();

            $postData = $this->security->xss_clean($postData);

            // This Function check the quantity of the products and if not available than it retun json and stop execution of the next code.
            $this->checkBackOrderQuantity();

            // This Function make the payment and retun api responce
            
	        $paymentID = $this->stripe_charge($postData);
	        //var_dump($paymentID);exit;
            // If payment successful
            if ($paymentID) {
                // If payment successful and return transaction id than this code return transaction id and status.
                $result['transaction_id'] = $paymentID;
                $result['status'] = "success";
                echo json_encode($result);
                exit;
            } else {
                // If payment function does not return transaction id than this code return error with  status.
                if (!empty($this->stripe->api_error)) {
                    $apiError = $this->stripe->api_error;
                    $stripe_errors = $this->comman_model->getStripeErrorsByCode($apiError['error']['decline_code'], $this->lang->default_lang_id);

                    $result['errors'] = $stripe_errors;
                    $result['status'] = "error";
                    echo json_encode($result);
                    exit;
                } else {
                    $stripe_errors = $this->comman_model->getStripeErrorsByCode('do_not_honor', $this->lang->default_lang_id);
                    $result['errors'] = $stripe_errors;
                    $result['status'] = "error";
                    echo json_encode($result);
                    exit;
                }
            }
        } else {            
            $result['errors'] = '';
            $result['status'] = "error";
            echo json_encode($result);
            exit;
        }
    }

    /**
     * stripe_charge
     * This Function is child function of stripe_purchase.  This is the Final Step of the payment after generating token.
     * @param  mixed $postData
     * @return void
     */
    public function stripe_charge($postData)
    {

        // This Function  generate the unique code for the invoice number
        $invoice_num_unique = $this->unique_code();
        $cart_users_data = $this->session->userdata('cart_users_data');
        $final_price_data = $this->session->userdata('final_price_data');

        $order_number = $cart_users_data['order_number'];
        $email = $cart_users_data['email'];
        $productname = 'KGS_' . $cart_users_data['order_number'];

        $currency = getDefaultCurrencyCode('l');

        if (!empty($postData)) {

            // Retrieve stripe token, card and user info from the submitted form data
            $token = $postData['token'];
            // This function generate stripe customer id on the behalf of token and card
	    $customer = $this->stripe->addCustomer($email, $token);
//	    var_dump($email);var_dump($customer);exit;
            if ($customer) {
                // this function hit the payment api for charge the card and return transaction id
                $charge = $this->stripe->createCharge($customer->id, $productname, $final_price_data['payment_price'], $currency, $order_number);
                if (count($charge) > 0) {
                    if ($charge['amount_refunded'] == 0 && empty($charge['failure_code']) && $charge['paid'] == 1 && $charge['captured'] == 1) {

                        $paidAmount = $charge['amount'];
                        $paidAmount = ($paidAmount / 100);

                        // This function update information in the database

                        $cart_users_data['amount'] = $final_price_data['total'];
                        $cart_users_data['currency'] = $currency;

                        $payments = array();
                        $payments['payment_type'] = $cart_users_data['payment_type'];
                        $payments['payment_created'] = date('Y-m-d H:i:s');
                        $payments['transaction_id'] = $charge['balance_transaction'];
                        $payments['payment_method'] = '1';
                        $payments['status'] = '1';

                        $payments['amount'] = $paidAmount;
                        $payments['currency'] = $currency;
                        $payments['invoice_number'] = $invoice_num_unique;
                        $payments['card_number'] = $charge['payment_method_details']['card']['last4'];
                        $user_id = getFrontenduserId();

                        if ($user_id) {
                            $payments['user_id'] = $user_id;
                        }

                        $this->session->set_userdata(array('payments' => $payments));

                        // This Function update information in the database and session after payment success
                        $this->cartProductFinalzeAfterPayment($payments, $cart_users_data);

                        // This code return transation id
                        return $charge['balance_transaction'];
                    }
                }
            }
        }
        // this return false when there is no data in form input
        return false;
    }

    /**
     * stripe_charge
     * This Function is child function of stripe_purchase.  This is the Final Step of the payment after generating token.
     * @param  mixed $postData
     * @return void
     */
    public function stripe_intent($postData)
    {

        // This Function  generate the unique code for the invoice number
        $invoice_num_unique = $this->unique_code();
        $cart_users_data = $this->session->userdata('cart_users_data');
        $final_price_data = $this->session->userdata('final_price_data');

        $order_number = $cart_users_data['order_number'];
        $email = $cart_users_data['email'];
        $productname = 'KGS_' . $cart_users_data['order_number'];

        $currency = getDefaultCurrencyCode('l');

        if (!empty($postData)) {

            // Retrieve stripe token, card and user info from the submitted form data
            //     echo "intent";
            $intent_id = $postData['intent_id'];
            // This function generate stripe customer id on the behalf of token and card
            if ($intent_id) {

                $intent_id = $postData['intent_id'];

                // this function hit the payment api to get intent details
                $intent_details = $this->stripe->getintent($intent_id);
                if (count($intent_details) > 0) {

                    //print_r($intent_details);
                    $charge = $intent_details['charges']['data'][0];
                    //  print_r($charge);
                    //  exit;

                    if ($charge['amount_refunded'] == 0 && empty($charge['failure_code']) && $charge['paid'] == 1 && $charge['captured'] == 1) {

                        $paidAmount = $charge['amount'];
                        $paidAmount = ($paidAmount / 100);

                        // This function update information in the database
                        $cart_users_data['payment_approved'] = "1";
                        $cart_users_data['payment_created'] = date('Y-m-d H:i:s');
                        $cart_users_data['transaction_id'] = $charge['balance_transaction'];
                        $cart_users_data['payment_method'] = "1";
                        $cart_users_data['amount'] = $paidAmount;
                        $cart_users_data['currency'] = $charge['currency'];
                        $cart_users_data['invoice_number'] = $invoice_num_unique;
                        $cart_users_data['card_number'] = $charge['payment_method_details']['card']['last4'];

                        // This Function update information in the database and session after payment success
                        $this->cartProductFinalzeAfterPayment($invoice_num_unique, $cart_users_data);

                        // This code return transation id
                        return $charge['balance_transaction'];
                    }
                }
            }
        }
        // this return false when there is no data in form input
        return false;
    }
    /**
     * stripe_purchase
     *
     * This Function is executed when Stripe payment gateway is activated. This function executed on the submit of the stripe payment form.
     * @return void
     */
    public function stripe_intent_purchase()
    {
        //check captcha
        $captcha = validate_captcha();
        if (isset($captcha['response']) && $captcha['response'] != 'success') {
            echo json_encode($captcha);
            exit;
        }

        $result = array();

        // If payment form is submitted with token
        if ($this->input->post('intent')) {

            // Retrieve stripe token, card and user info from the submitted form data
            $postData = $this->input->post();

            $postData = $this->security->xss_clean($postData);

            // This Function check the quantity of the products and if not available than it retun json and stop execution of the next code.
            $this->checkBackOrderQuantity();

            // This Function make the payment and retun api responce
            $paymentID = $this->stripe_intent($postData);

            // If payment successful
            if ($paymentID) {
                // If payment successful and return transaction id than this code return transaction id and status.
                $result['transaction_id'] = $paymentID;
                $result['status'] = "success";
                echo json_encode($result);
                exit;
            } else {
                // If payment function does not return transaction id than this code return error with  status.
                if (!empty($this->stripe->api_error)) {
                    $apiError = $this->stripe->api_error;
                    $stripe_errors = $this->comman_model->getStripeErrorsByCode($apiError['error']['decline_code'], $this->lang->default_lang_id);

                    $result['errors'] = $stripe_errors;
                    $result['status'] = "error";
                    echo json_encode($result);
                    exit;
                } else {
                    $stripe_errors = $this->comman_model->getStripeErrorsByCode('do_not_honor', $this->lang->default_lang_id);
                    $result['errors'] = $stripe_errors;
                    $result['status'] = "error";
                    echo json_encode($result);
                    exit;
                }
            }
        } else {
            $result['errors'] = '';
            $result['status'] = "error";
            echo json_encode($result);
            exit;
        }
    }

    /**
     * generateClicTopayOrder
     * This Function generate the orderid for the  payment when clictopay gateway is activated.
     * @return void
     */
    public function generateClicTopayOrder()
    {
        $this->load->library('Clicpay');
        // this function  check back order product status
        $itemQuantity = $this->checkBackOrderQuantity('array');
        $currency = getDefaultCurrencyCode();
        if (isset($itemQuantity['msg']) && $itemQuantity['msg']) {
            // if selected product item quantity < 0 this code will work
            return array('errors' => $itemQuantity['error_message'], 'items' => $itemQuantity['msg']);
            exit;
        }
        $retunrurl = base_url() . $this->lang->default_lang . '/payment/createChargeForclictopay';
        $final_price_data = $this->session->userdata('final_price_data');
        $cart_users_data = $this->session->userdata('cart_users_data');
        $amount = $final_price_data['total'];
        $randomString = time() . rand(10, 100) . rand(111, 222);

        $this->clicpay->addField('amount', $amount);
        $this->clicpay->addField('retunrurl', $retunrurl);
        $this->clicpay->addField('currency', $currency);
        $this->clicpay->addField('orderNumber', $randomString);
        $responce = $this->clicpay->generateFormURL();

        // echo "<pre>";
        // print_r($responce);
        // exit;
        return $responce;
        exit;
    }

    /**
     * generateClicTopayOrder
     * This Function get the order status for the clicktopay on order success.
     * @return void
     */
    public function getClicTopayOrder()
    {
        $this->load->library('Clicpay');
        $ctp_orderid = $this->session->userdata('ctp_orderid');
        $this->clicpay->addField('orderid', $ctp_orderid);
        $responce = $this->clicpay->getOrderstatus();
        return $responce;
        exit;
    }

    /**
     * Method clicktopay_redirect
     * This Function generate form url of the  clictopay.
     * @return void
     */
    public function clicktopay_redirect()
    {
        $payment_instructions = get_user_lang_data(array('payment_instructions'), $this->lang->default_lang_id);

        if ($this->config->item('payment_gateway') == 'clictopay') {

            // generate order id for the clictopay and generate order id
            $clitopay_responce = $this->generateClicTopayOrder();
            if ($clitopay_responce['status'] == "success") {
                $this->session->set_userdata('ctp_orderid', $clitopay_responce['orderId']);
                redirect($clitopay_responce['formUrl']);
            } else {
                $this->session->set_userdata('payment_api_error', "1");
                $this->session->set_userdata('click_pay_message', $payment_instructions['payment_instructions']['payment_gateway_notworking']);
                redirect("payment");
            }
            exit;
        } else {
            $this->session->set_userdata('payment_api_error', "1");
            $this->session->set_userdata('click_pay_message', $payment_instructions['payment_instructions']['payment_gateway_notworking']);
            redirect("payment");
            exit;
        }
    }

   /**
     * createChargeForclictopay
     *
     * This Function is executed when clictopay payment gateway is activated. This is the Final Step of the payment.
     * @return void
     */
    public function createChargeForclictopay()
    {
        $payment_instructions = get_user_lang_data(array('payment_instructions'), $this->lang->default_lang_id);

        $cart_users_data = $this->session->userdata('cart_users_data');
        // this function get paymee token from the session
        $ctp_orderid = $this->session->userdata('ctp_orderid');

        // this function get cureency code
        $currency = getDefaultCurrencyCode();
        // if token is saved in session than this condition executed.
        // This Function  generate the unique code for the invoice number
        $invoice_num_unique = $this->unique_code();
        if ($ctp_orderid) {
            $orderstatus = $this->getClicTopayOrder();

            if ($orderstatus['status'] == "success") {
                $final_price_data = $this->session->userdata('final_price_data');
                $amount = $final_price_data['total'];
                $clickpay_txnId = $orderstatus['responce']['OrderNumber'];
                // This function update information in the database
                $cart_users_data['payment_approved'] = "1";
                $cart_users_data['payment_created'] = date('Y-m-d H:i:s');
                $cart_users_data['transaction_id'] = $clickpay_txnId;
                $cart_users_data['payment_method'] = '1';
                $cart_users_data['amount'] = $amount;
                $cart_users_data['currency'] = $currency;
                $cart_users_data['invoice_number'] = $invoice_num_unique;
                $cart_users_data['card_number'] = $orderstatus['responce']['Pan'];
                // This Function update information in the database and session after payment success
                // exit;
                $this->cartProductFinalzeAfterPayment($invoice_num_unique, $cart_users_data);
                $this->session->unset_userdata('ctp_orderid');
                $this->session->unset_userdata('click_pay_message');
                $this->session->unset_userdata('click_pay_error');
                $this->session->unset_userdata('payment_api_error');

                redirect("cart/invoice");
            } else {
                //  exit;
                $this->session->set_userdata('click_pay_error', "1");
                $this->session->set_userdata('click_pay_message', $payment_instructions['payment_instructions']['payment_notsuccess']);
                redirect("payment");
            }
        } else {
            // exit;
            $this->session->set_userdata('click_pay_error', "1");
            $this->session->set_userdata('click_pay_message', $payment_instructions['payment_instructions']['payment_notsuccess']);
            redirect("payment");
        }
    }

    /**
     * createPaymeeToken
     * This Function generate the token for the  payment when paymee gateway is activated.
     * @return void
     */
    public function createPaymeeToken()
    {

        // this function  check back order product status
        $itemQuantity = $this->checkBackOrderQuantity('array');
        if (isset($itemQuantity['msg']) && $itemQuantity['msg']) {
            // if selected product item quantity < 0 this code will work
            return array('errors' => $itemQuantity['error_message'], 'items' => $itemQuantity['msg']);
            exit;
        }

        $final_price_data = $this->session->userdata('final_price_data');
        $cart_users_data = $this->session->userdata('cart_users_data');
        // echo "<pre>";
        // print_r($cart_users_data);
        // exit;

        $asset_url = asset_url();
        $return_url = $asset_url . '/payment/createChargeForPaymee';
        // create token for payment gateway
        $headers = array("Authorization: Token " . $this->config->item('paymee_token'));

        if (!empty($cart_users_data['ship_company'])) {
            $first_name = $cart_users_data['ship_company'];
        } else {
            $first_name = $cart_users_data['ship_surname'];
        }
        $curl_post_data = array(
            'vendor' => $this->config->item('paymee_account_number'),
            'amount' => $final_price_data['total'],
            'note' => "Quotation Number " . $cart_users_data['order_number'],
            'email' => $cart_users_data['ship_email'],
            'first_name' => $first_name,
            'last_name' => $cart_users_data['ship_surname'],
            'webhook_url' => $return_url,
        );

        // print_r($curl_post_data);

        // echo "<pre>";
        // print_r($curl_post_data);

        // print_r($headers);
        // condition for payment gateway endpoint in case of devmode or production mode
        if ($this->config->item('payment_mode') == 1) {
            $url = 'https://app.paymee.tn/api/v2/payments/create';
        } else {
            $url = 'https://sandbox.paymee.tn/api/v2/payments/create';
        }

        //echo $url;
        // curl request to generate token
        $curl_handle = curl_init($url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POST, true);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $curl_post_data);
        $response = json_decode(curl_exec($curl_handle), true);
        curl_close($curl_handle);

        if (isset($response['status']) && $response['status'] == true && isset($response['data']['token']) && $response['data']['token']) {
            // if token generated successfully than this code will work
            $aResult = array(
                'token' => $response['data']['token'],
                'payment_url' => $response['data']['payment_url'],
                'status' => 'success',
            );
            return $aResult;
            exit;
        } else {
            // if token will not generated succesfully than this code will work
            return array('errors' => 'order_upstream_timeout');
            exit;
        }
    }

    /**
     * createChargeForPaymee
     *
     * This Function is executed when Paymee payment gateway is activated. This is the Final Step of the payment after generating token.
     * @return void
     */
    public function createChargeForPaymee()
    {

        // this function get paymee token from the session
        $paymee_token = $this->session->userdata('paymee_token');
        //$paymee_txnId = $this->session->userdata('paymee_txnId');
        $paymee_txnId = '';
        if ($paymee_token) {
            // if token is saved in session than this condition executed.
            // This Function  generate the unique code for the invoice number
            $invoice_num_unique = $this->unique_code();

            $cart_users_data = $this->session->userdata('cart_users_data');

            // this function get cureency code
            $currency = getDefaultCurrencyCode('l');

            $headers = array("Authorization: Token " . $this->config->item('paymee_token'));
            // Add condition for production and sandbox mode
            if ($this->config->item('payment_mode') == 1) {
                $curl_handle = curl_init('https://app.paymee.tn/api/v2/payments/' . $paymee_token . '/check');
            } else {
                $curl_handle = curl_init('https://sandbox.paymee.tn/api/v2/payments/' . $paymee_token . '/check');
            }
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
            $query = json_decode(curl_exec($curl_handle), true);
            curl_close($curl_handle);

            // echo "<pre>";
            // print_r($query);
            // exit;
            if (isset($query['data']['payment_status']) && $query['data']['payment_status'] == "1") {
                $paymee_txnId = $query['data']['transaction_id'];
                // This function update information in the database
                $cart_users_data['payment_approved'] = "1";
                $cart_users_data['payment_created'] = date('Y-m-d H:i:s');
                $cart_users_data['transaction_id'] = $paymee_txnId;
                $cart_users_data['payment_method'] = '1';
                $cart_users_data['amount'] = $query['data']['amount'];
                $cart_users_data['currency'] = $currency;
                $cart_users_data['invoice_number'] = $invoice_num_unique;
                $cart_users_data['card_number'] = $query['data']['buyer_id'];

                // echo "<pre>";
                // print_r($cart_users_data);
                // exit;

                // This Function update information in the database and session after payment success
                $this->cartProductFinalzeAfterPayment($invoice_num_unique, $cart_users_data);

                redirect("cart/invoice");
            } else {
                // if payment api does not respond success than this function return error in json format
                redirect("payment");
            }
        } else {
            // if payment token is not exist in the session than this function return error in json format
            redirect("payment");
        }
    }

    /**
     * Method charge_with_payment_file
     * This Function is executed when Paymee payment gateway is activated. This is the Final Step of the payment after generating token.
     * @return void
     */
    public function charge_with_payment_file()
    {

        // this function get paymee token from the session
        $final_price_data = $this->session->userdata('final_price_data');
        //$paymee_txnId = $this->session->userdata('paymee_txnId');

        $form_validation_instruction = (object) get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];

        $po_file = '';
        // This Code runs only  when user choose the client logo on the cart form.
        if (isset($_FILES['payment_proof_file']) && !empty($_FILES['payment_proof_file']['name'])) {

            // These are configuration variables  for  client logo file
            $config2['upload_path'] = './assets/uploads/cart/';
            $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config2['max_size'] = '2048';
            $config2['file_name'] = getRandomFileName($_FILES['payment_proof_file']['name'], 'payment_proof_file');

            // This function initialize the upload library
            $this->load->library('upload', $config2);
            // This function initialize the image library
            $this->load->library('image_lib');
            if (!$this->upload->do_upload('payment_proof_file')) {
                $error_lang = isset($form_validation_instruction->payment_proof_file) ? $form_validation_instruction->payment_proof_file : 'File should be Max 2 MB and either: pdf,jpg, png, jpeg or gif';
                // This function save error message in the flash variable to display on cart page
                $result['errors'] = $error_lang;
                $result['status'] = "error";
                echo json_encode($result);
                exit;
            } else {
                $upload_data = $this->upload->data();
                $paymemt_proof_file = $upload_data['file_name'];
            }
        }

        if ($paymemt_proof_file) {
            // if token is saved in session than this condition executed.
            // This Function  generate the unique code for the invoice number
            $invoice_num_unique = $this->unique_code();

            $cart_users_data = $this->session->userdata('cart_users_data');

            // this function get cureency code
            $currency = getDefaultCurrencyCode('l');

            $last_payment_date = date('Y-m-d', strtotime(date('Y-m-d') . ' + ' . $loginuserterm['payment_term_days'] . ' days'));

            //
            $paymee_txnId = "";
            // This function update information in the database

            $cart_users_data['amount'] = $final_price_data['total'];
            $cart_users_data['currency'] = $currency;

            $payments = array();
            $payments['payment_type'] = $cart_users_data['payment_type'];
            $payments['payment_created'] = date('Y-m-d H:i:s');
            $payments['transaction_id'] = "";
            $payments['payment_method'] = '3';
            $payments['amount'] = $final_price_data['payment_price'];
            $payments['currency'] = $currency;
            $payments['invoice_number'] = $invoice_num_unique;
            $payments['payment_proof_file'] = $paymemt_proof_file;
            $payments['status'] = '0';

            $user_id = getFrontenduserId();
            if ($user_id) {
                $payments['user_id'] = $user_id;
            }

            // This Function update information in the database and session after payment success
            $this->cartProductFinalzeAfterPayment($payments, $cart_users_data);

	    $result['status'] = "success";
            echo json_encode($result);
            exit;
        } else {
            // if payment token is not exist in the session than this function return error in json format
            $error_lang = isset($form_validation_instruction->payment_proof_file) ? $form_validation_instruction->payment_proof_file : 'File should be Max 2 MB and either: pdf,jpg, png, jpeg or gif';
            $result['errors'] = $error_lang;
            $result['status'] = "error";
            echo json_encode($result);
            exit;
        }
    }

    /**
     * Method charge_with_term
     * This Function is executed when Paymee payment gateway is activated. This is the Final Step of the payment after generating token.
     * @return void
     */
    public function charge_with_term()
    {

        // this function get paymee token from the session
        $final_price_data = $this->session->userdata('final_price_data');
        //$paymee_txnId = $this->session->userdata('paymee_txnId');

        $limit = available_credit_limit();
        $loginuserterm = loginuserterm();

        if ($limit < $final_price_data['total']) {
            redirect("payment");
            exit;
        }

        if ($final_price_data['payment_price']) {
            // if token is saved in session than this condition executed.
            // This Function  generate the unique code for the invoice number
            $invoice_num_unique = $this->unique_code();

            $cart_users_data = $this->session->userdata('cart_users_data');

            // this function get cureency code
            $currency = getDefaultCurrencyCode('l');

            $last_payment_date = date('Y-m-d', strtotime(date('Y-m-d') . ' + ' . $loginuserterm['payment_term_days'] . ' days'));

            //
            $paymee_txnId = "";
            // This function update information in the database

            $cart_users_data['amount'] = $final_price_data['total'];
            $cart_users_data['currency'] = $currency;

            $payments = array();
            $payments['payment_type'] = $cart_users_data['payment_type'];
            $payments['payment_created'] = date('Y-m-d H:i:s');
            $payments['transaction_id'] = $paymee_txnId;
            $payments['payment_method'] = '2';
            $payments['amount'] = $final_price_data['payment_price'];
            $payments['currency'] = $currency;
            $payments['invoice_number'] = $invoice_num_unique;
            $payments['card_number'] = "";
            $payments['status'] = '2';
            $payments['last_payment_date'] = $last_payment_date;
            $payments['payment_term_days'] = $loginuserterm['payment_term_days'];
            $user_id = getFrontenduserId();
            if ($user_id) {
                $payments['user_id'] = $user_id;
            }

            // This Function update information in the database and session after payment success
            $this->cartProductFinalzeAfterPayment($payments, $cart_users_data);

            redirect("cart/invoice");
        } else {
            // if payment token is not exist in the session than this function return error in json format
            redirect("payment");
        }
    }

    /**
     * cartProductFinalzeAfterPayment
     *
     * This Function is executed when Paymee payment gateway is activated. This is the Final Step of the payment after generating token.
     * @return void
     */
    public function cartProductFinalzeAfterPayment($payments, $cart_users_data)
    {
        $payment_type = get_payment_type();
        
        
        $invoice_num_unique = $cart_users_data['invoice_number'];

        // If payment completed successfully than this code executed

        $volume_unit = get_volume_unit();
        $weight_unit = get_weight_unit();
        $unit_of_meas = $volume_unit . "/" . $weight_unit;

        $user_id = getFrontenduserId();

        if ($user_id) {
            $cart_users_data['user_id'] = $user_id;
        }

        $coupon_applied = $this->session->userdata('coupon_applied') ? $this->session->userdata('coupon_applied') : "";
        $coupon_data = $this->session->userdata('coupon_data') ? $this->session->userdata('coupon_data') : "";
        $discount = $this->session->userdata('discount') ? $this->session->userdata('discount') : "";
        $userLangData = get_user_lang_data(array('cart_instruction',  'product_instruction'), $this->lang->default_lang_id);
        $product_instruction = (object)$userLangData['product_instruction'];
        if ($coupon_applied == "1") {
            $cart_users_data['coupon_applied'] = $coupon_applied;
            $cart_users_data['coupon_data'] = serialize($coupon_data);
            $cart_users_data['discount_id'] = $coupon_data['id'];
            $couponupdate = array();
            $couponupdate['used_number'] = $coupon_data['used_number'] + 1;
            $this->comman_model->update_column("discount_coupons", array("id" => $coupon_data['id']), $couponupdate);
        }
        if ($discount) {
            $cart_users_data['discount'] = $discount;
        }

        $quotation_id = $this->session->userdata('quotation_id') ? $this->session->userdata('quotation_id') : "";
        $existing_order_id = $this->session->userdata('order_id');

        // increment discount coupon number
        if ($this->config->item('partial_payment_enable') == "0") {
            $cart_users_data['amount_received'] = $payments['amount'];
            $cart_users_data['amount_pending'] = "0";
            $cart_users_data['order_status'] = "1";

        } else if ($this->config->item('partial_payment_enable') == "1" && $payment_type == "1") {

            if (empty($existing_order_id)) {
                $amount_received = $payments['amount'];
                $pending_amount = $cart_users_data['amount'] - $payments['amount'];
            } else {
                $received_amount = $this->cart_model->get_order_payments_total($existing_order_id);
                $amount_received = $payments['amount'] + $received_amount;
                $pending_amount = $cart_users_data['amount'] - $amount_received;
            }
            $cart_users_data['amount_received'] = round($amount_received, 2);
            $cart_users_data['amount_pending'] = round($pending_amount, 2);
            $cart_users_data['order_status'] = "0";

        } else if ($this->config->item('partial_payment_enable') == "1" && $payment_type == "2") {

            $amount_received = $cart_users_data['amount'];
            $pending_amount = "0";

            $cart_users_data['amount_received'] = round($amount_received, 2);
            $cart_users_data['amount_pending'] = round($pending_amount, 2);
            $cart_users_data['order_status'] = "1";

        }

        if ($payments['payment_method'] == "3") {
            $cart_users_data['order_status'] = "0";
        }
        $this->session->set_userdata(array('amount_received' => $cartusers_data['amount_received']));
        // This function update information in the database
        if (empty($existing_order_id)) {
            
            $this->db->insert('cart_users', $cart_users_data);
            $order_id = $this->db->insert_id();
        } else {
            $order_id = $existing_order_id;
            $this->db->where('id', $existing_order_id);
            $this->db->update('cart_users', $cart_users_data);
        }

        // update or delete quotations as per case
        if ($this->config->item('partial_payment_enable') == "0") {
            if ($quotation_id) {
                $this->session->set_userdata(array('quotation_id' => $quotation_id));
                $this->comman_model->delete_row("quotations", array("id" => $quotation_id));
            }
        } else if ($this->config->item('partial_payment_enable') == "1" && $payment_type == "1") {

            if ($quotation_id) {
                $this->session->set_userdata(array('quotation_id' => $quotation_id));
                $quotation_data['order_id'] = $order_id;
                $this->db->where('id', $quotation_id);
                $this->db->update('quotations', $quotation_data);
            }

        } else if ($this->config->item('partial_payment_enable') == "1" && $payment_type == "2") {

            if ($quotation_id) {
                $this->session->set_userdata(array('quotation_id' => $quotation_id));
                $this->comman_model->delete_row("quotations", array("id" => $quotation_id));
            }

        }
        // update or delete quotations as per case

        // this function delete user records from cart_block_users and block_email_list tables using email and phone
        $this->db->delete("cart_block_users", array("email" => $cart_users_data['email'], "country_code" => $cart_users_data['country_code'], "telephone" => $cart_users_data['telephone']));

        $where_param = array();
        $where_param['str_email'] = $cart_users_data['email'];
        $where_param['str_country_code'] = $cart_users_data['country_code'];
        $where_param['str_telephone'] = $cart_users_data['telephone'];
        $this->comman_model->delete_row("block_email_list", $where_param);

        // save payment details in payment

        $payments['order_id'] = $order_id;
        $payments['payment_created'] = date('Y-m-d H:i:s');
        $payments['payment_type'] = $payment_type;
        $this->db->insert('payments', $payments);
        $this->session->set_userdata(array('payments' => $payments));

        // save payment details in payment

	// Run shiiping and package details only when final payment will be there
        if ($payment_type == "2") {
            
		// This Function make shipment as per packages and return tracking number
            //print_r($cart_users_data);
            $shippingdetails = $this->getShippingDetails($cart_users_data['amount']);
            
            $package_data = $this->session->userdata('package_data');
            // echo '<pre>';print_r($shippingdetails);print_r($this->session->userdata("package_final"));exit;
            // Box Weight Array
            
            $this->load->model("package_model");
            $boxes = $this->package_model->getboxData();
            $onlyPackageData = $this->package_model->onlyPackageData();
            $boxweight = array();
            $boxtype = array();
            
            foreach ($onlyPackageData as $singleboxw) {

                $boxtype[trim($singleboxw['package_code'])] = $singleboxw['package_type'];

            }

            if ($cart_users_data['carrier_name'] == 'FREIGHTCOM') {
                $this->db->where('id', $order_id);
                $this->db->update('cart_users', array("freightcom_shipment_id" => $shippingdetails['shipment_tracking_number']));
            }

            // print_r($shippingdetails['shipment_tracking_number']);
            // exit;

            if ($single_package['package_type'] == "freight") {

                array_push($freight_shipment, $single_package);
            } else {

                array_push($package_shipment, $single_package);
            }
            // echo '<pre>';print_r($package_data);exit;
           
            if (is_array($package_data) && count($package_data) > 0) {
                $pack_num = 0;
                $fre_num = 0;
                $package_final = $this->session->userdata("package_final");
                $i = 0;
                // echo '<pre>';print_r($package_final);echo '</pre>';exit;
                foreach ($package_data as $key => $value) {
                    $value_pkg_name = $value['package_name'];
                    $value_pkg_name = explode("-",$value_pkg_name);
                    $value['package_name'] = $value_pkg_name[0];
                    if ($boxtype[trim($value['package_name'])] == "freight") {

                        if ($shippingdetails['shipment_tracking_number']["freight"][$fre_num]) {
                            $track_number = $shippingdetails['shipment_tracking_number']["freight"][$fre_num];

                        } else {
                            $track_number = "NA";

                        }

                        $package_post_data = array(
                            'cart_user_id' => $order_id,
                            'store_id' => $package_final[$i]['package_store_id'],
                            'package_nature' => 12,
                            'package_name' => $value['package_name'],
                            'width' => $value['width'],
                            'length' => $value['length'],
                            'height' => $value['height'],
                            'weight' => $value['weight'],
                            'tracking_number' => $track_number,
                            'package_type' => $boxtype[trim($value['package_name'])],
                        );

                        // this function save all cart  session packages in to the cart_packages  table
                        $this->db->insert('cart_packages', $package_post_data);

                        $cart_package_id = $this->db->insert_id();

                        foreach ($value['package_item_data'] as $pidata => $pivalue) {
                            $package_item_post_data = array();
                            $product_id = $this->product_model->getProductIdByName($pivalue['id']);
                            $package_item_post_data = array(
                                'cart_user_id' => $order_id,
                                'cart_package_id' => $cart_package_id,
                                'product_id' => $product_id,
                                'product_name' => $pivalue['id'],
                            );
                            // this function save all cart packages items from   session in to the cart_package_products  table
                            $this->db->insert('cart_package_products', $package_item_post_data);
                        }
                        $fre_num++;
                    } else {

                        if ($cart_users_data['carrier_name'] == 'FREIGHTCOM') {
                            $pack_track_box = "";
                        } else {

                            $pack_track_box = $shippingdetails['shipment_tracking_number']["package"][$pack_num];
                        }

                        $package_post_data = array(
                            'cart_user_id' => $order_id,
                            'store_id' => $package_final[$i]['package_store_id'],
                            'package_nature' => 12,
                            'package_name' => $value['package_name'],
                            'width' => $value['width'],
                            'length' => $value['length'],
                            'height' => $value['height'],
                            'weight' => $value['weight'],
                            'tracking_number' => $pack_track_box,
                            'package_type' => $boxtype[trim($value['package_name'])],
                        );
                                               

                        // this function save all cart  session packages in to the cart_packages  table
                        $this->db->insert('cart_packages', $package_post_data);

                        $cart_package_id = $this->db->insert_id();

                        foreach ($value['package_item_data'] as $pidata => $pivalue) {
                            $package_item_post_data = array();
                            $product_id = $this->product_model->getProductIdByName($pivalue['id']);
                            $package_item_post_data = array(
                                'cart_user_id' => $order_id,
                                'cart_package_id' => $cart_package_id,
                                'product_id' => $product_id,
                                'product_name' => $pivalue['id'],
                            );
                            // this function save all cart packages items from   session in to the cart_package_products  table
                            $this->db->insert('cart_package_products', $package_item_post_data);
                        }

                        $pack_num++;
                    }
                $i++;
                }
            }
        }

        if (empty($existing_order_id)) {
            $cart_details = $this->session->userdata('new_cart');
            $cart_data_with_store = $this->session->userdata('cart');
            
            if (count($cart_details) > 0) {
                // this function save all cart session products in to the cart table
                $allProductIds = $allProductQuantity = $allStoreId =  array();
                foreach ($cart_details as $cart) {
                        $var_qty = 0;
                        foreach ($cart['quantity'] as $i_key=>$i_qty){                       
                            if($i_qty>0){
                            $cart1['user_id'] = $order_id;
                            $cart1['quantity'] = empty($i_qty) ? 0 : $i_qty;
                            $storename = "";
                            $store_id_value = 0;
                            $cart_data_with_store[$cart['item_id']]['store_id'] = $i_key;
                            foreach($cart_data_with_store[$cart['item_id']]['store_data'] as $storedata){
                                if($storedata['store_id'] == $cart_data_with_store[$cart['item_id']]['store_id']){
                                    $storename = $storedata['name'];
                                    $store_id_value = $storedata['store_id'];
                                }
                            }
                            $cart1['comment'] = $storename .":".$cart['comment'];
                            $cart1['product_id'] = $cart['item_id'];
                            $cart1['store_id'] = $store_id_value;
                            $this->db->insert('cart', $cart1);

                            $allProductIds[] = $cart['item_id'];
                            $allStoreId[] = $cart_data_with_store[$cart['item_id']]['store_id'];
                            foreach($cart_data_with_store[$cart['item_id']]['store_data'] as $s_data){
                                if($cart_data_with_store[$cart['item_id']]['store_id'] == $s_data['store_id']){
                                    $allStoreName[] = $s_data['name'];
                                }
                            }                            
                            $allProductQuantity[] = empty($i_qty) ? 0 : $i_qty;
                        }
                    }
                }
                // echo '<pre>';print_r($allProductIds);print_r($allStoreId);print_r($allProductQuantity);print_r($allStoreName);exit;
                //This Function send email to admin when Quanity and threshold quantity  of any product is reached after order
                $this->updateInventoryItems($allProductIds, $allProductQuantity, $user_id, $invoice_num_unique,$allStoreId);
            }
            // print_r($allStoreName);print_r($cart_data_with_store);exit;
            //This Function fetch all ordered cart products data and save product data related to order.
            $cartData = $this->cart_model->get_cart_user_product_data($order_id);
            //echo '<pre>';print_r($cartData);echo '</pre>';exit;
            if (count($cartData) > 0) {

                $cart_order_products = array();

                //This Function store all ordered products in a seprate table.
                foreach ($cartData as $res) {
                                        
                    // echo '<pre>';print_r($allProductIds);print_r($allStoreId);echo '</pre> '. $store_id;
                    // this code insert data related to each product from the cart table to different table
                    $productData = array(
                        'pid' => $res['id'],
                        'kgt_ref_number' => $res['kgt_ref_number'],
                        'status' => $res['status'],
                        'cart_store_id' => $res['store_id'],
                        'cart_quantity' => $res['cart_quantity'],
                        'quantity' => $res['quantity'] < 1 ? 1 : $res['quantity'],
                        'comment' => $res['comment'],
                        'item_real_photo' => $res['item_real_photo'],
                        'item_schematic_photo' => $res['item_schematic_photo'],
                        'item_height' => $res['item_height'],
                        'item_width' => $res['item_width'],
                        'item_length' => $res['item_length'],
                        'item_weight' => $res['item_weight'],
                        'shipping_special_notes' => str_replace('{stock_quantity}',$res['cart_quantity'],str_replace('{store_name}',$allStoreName[$res['id']],$product_instruction->store_avaiable_text)),
                        'availability' => " ",
                        'unit_of_measurement' => $unit_of_meas,
                        'product_type_name' => $res['product_type_name'],
                        'product_type_photo' => $res['product_type_photo'],
                    );

                    // if invoice number is not empty than this condition execute
                    $productData['cart_user_id'] = $order_id;
                    $productData['order_number'] = $cart_users_data['order_number'];

                    // this code check the directory for cart data if exist or not
                    $targetdir = './assets/uploads/cart/' . $order_id . '/' . $res['id'] . '/';
                    if (!is_dir($targetdir)) {
                        // if directory not exists than this function create directory
                        mkdir($targetdir, 0777, true);
                    }

                    if ($productData['item_real_photo']) {
                        // if product image is exist than this code copy product image to cart folder
                        $item_real_photo = FCPATH . '/assets/uploads/product_images/' . $productData['item_real_photo'];
                        if (file_exists($item_real_photo)) {
                            copy('./assets/uploads/product_images/' . $productData['item_real_photo'], './assets/uploads/cart/' . $order_id . '/' . $res['id'] . '/' . $productData['item_real_photo']);
                        }
                    }

                    if ($productData['item_schematic_photo']) {
                        // if product image is exist than this code copy product image to cart folder
                        $item_schematic_photo = FCPATH . '/assets/uploads/product_images/' . $productData['item_schematic_photo'];
                        if (file_exists($item_schematic_photo)) {
                            copy('./assets/uploads/product_images/' . $productData['item_schematic_photo'], './assets/uploads/cart/' . $order_id . '/' . $res['id'] . '/' . $productData['item_schematic_photo']);
                        }
                    }

                    if ($productData['product_type_photo']) {
                        // if product image is exist than this code copy product image to cart folder
                        $product_type_photo = FCPATH . '/assets/uploads/product_type_images/' . $productData['product_type_photo'];
                        if (file_exists($product_type_photo)) {
                            copy('./assets/uploads/product_type_images/' . $productData['product_type_photo'], './assets/uploads/cart/' . $order_id . '/' . $res['id'] . '/' . $productData['product_type_photo']);
                        }
                    }

                    $cart_order_products[] = $productData; // making array format to store insert batch data
                }

                if (count($cart_order_products) > 0) {
                    // this function save data in the cart_order_products table
                    $this->db->insert_batch('cart_order_products', $cart_order_products);
                }
            }

        }

        // Save order information in database   of kondarsoft if its final payment
        if ($payment_type == "2") {

            $kondar_order = array();
            $store_url = substr(getenv('ASSET_URL'), 0, -1);
            $currency = getDefaultCurrencyCode('l');
            $db2 = $this->load->database('kondarsoft', true);
            $db2->where("store_url", $store_url);
            $store_query = $db2->get("signup_final_data");
            $store_data = $store_query->row_array();
            if (!empty($store_data)) {

                $commission_trial = $this->config->item('commission_trial');

                $kondar_order["store_id"] = $store_data['id'];
                $kondar_order["order_id"] = $invoice_num_unique;
                $kondar_order["currency"] = $currency;
                if ($commission_trial == "1") {
                    $kondar_order["commission_percentage"] = "0";
                    $kondar_order["commission_amount"] = "0";
                } else {
                    $commission_percentage = $this->config->item('commission_percentage');
                    $commission_amount = ($cart_users_data['amount'] * $commission_percentage) / 100;
                    $kondar_order["commission_percentage"] = $commission_percentage;
                    $kondar_order["commission_amount"] = $commission_amount;
                }
                $kondar_order["total_amount"] = $cart_users_data['amount'];
                $kondar_order["invoice_number"] = $invoice_num_unique;
                $kondar_order["email"] = $cart_users_data['email'];
                $kondar_order["country_code"] = $cart_users_data['country_code'];
                $kondar_order["telephone"] = $cart_users_data['telephone'];
                $kondar_order["store_url"] = $store_url;
                $db2->insert("orders", $kondar_order);

                // $db2->select_sum('total_amount');
                // $db2->where("store_id", $store_data['id']);
                // $amount_query =   $db2->get('orders');
                // $amount_data =  $amount_query->row_array();
                // $total_amount =  $amount_data['total_amount'];

                // if ($total_amount >= $store_data['trial_amount'] && $commission_trial == "1") {

                //     $db2->where("id",$store_data['id']);
                //     $db2->update("signup_final_data",array("trial_expired"=>"1"));
                //     $db2->close();

                //     $this->db->where('setting_name', 'commission_trial');
                //     $this->db->update('global_settings', array('setting_value' => "0"));

                //     $this->db->where('setting_name', 'commission_trial_amount');
                //     $this->db->update('global_settings', array('setting_value' => "0"));

                //     // Email Related to comminsion term expire
                //     $email_instruction = (object)get_user_lang_data(array('email_instruction'), $this->lang->default_lang_id)['email_instruction'];
                //     // set variable for  email function
                //     // set variable for  email function
                //     $fromeMailId =  $this->config->item('fromemailaddress');
                //     $fromName    = $email_instruction->admin_cart_mail_fromname;
                //     $toEmailId   = $store_data['email'];
                //     $signature   = $email_instruction->admin_cart_mail_fromname;
                //     $subject     = $email_instruction->gateway_reminder_subject;
                //     $msg = htmlspecialchars_decode($email_instruction->gateway_reminder);
                //     $name = $store_data['title'] . ' ' . $store_data['firstname'] . ' ' . $store_data['lastname'];
                //     $msg = str_replace('{name}', $name, $msg);
                //     $msg = str_replace('{ur}', $store_data['store_url'], $msg);
                //     $msg = str_replace('{signature}', $signature, $msg);
                //     $this->email->set_newline("\r\n");
                //     $this->email->from($fromeMailId, $fromName);
                //     $this->email->to($toEmailId);
                //     $this->email->set_header("To",  $name . '<' . $toEmailId . '>');
                //     $this->email->subject($subject);
                //     $this->email->message($msg);
                //     // This Functions send email and clear email configuration
                //     $this->email->send();
                //     //echo $this->email->print_debugger();exit;
                //     $this->email->clear(TRUE);
                // }
            }
        }

        // Save order information in database   of kondarsoft
        
        // these functions clear the all session data related to cart
        $remaining_cart = $this->session->userdata('remaining_cart');
        $this->session->unset_userdata('remaining_cart');
        if(count($remaining_cart)>0){
            $session_data = array(
                'paymee_token' => '',
                'paymee_txnId' => '',
                'cart' => $remaining_cart,
                'last_inserted_cart_block_id' => "",
                'edit_cart_mode' => '1',
                'cart_randomString' => '',
                'new_cart' => $remaining_cart,
                'vehicle_maker_id_and_cat_id_pair' => '',
                'maker_id_array' => '',
                // 'model_id' => '',
                // 'maker_id' => '',
                'vehicle_category_id' => '',
                'sms_randomString' => '',
                'cart_user_id' => $order_id,
                'order_attribute_data' => '',
                'amount_received' => "",
                'order_id' => "",
                'order_number' => "",
                'quotation_id' => "",
                'quotation_expdate' => "",
            );
            $this->session->set_userdata($session_data);
        }else{
            $session_data = array(
                'paymee_token' => '',
                'paymee_txnId' => '',
                'cart' => '',
                'last_inserted_cart_block_id' => "",
                'edit_cart_mode' => 'false',
                'cart_randomString' => '',
                'new_cart' => '',
                'vehicle_maker_id_and_cat_id_pair' => '',
                'maker_id_array' => '',
                // 'model_id' => '',
                // 'maker_id' => '',
                'vehicle_category_id' => '',
                'sms_randomString' => '',
                'cart_user_id' => $order_id,
                'order_attribute_data' => '',
                'amount_received' => "",
                'order_id' => "",
                'order_number' => "",
                'quotation_id' => "",
                'quotation_expdate' => "",
            );
            $this->session->set_userdata($session_data);
            $this->remove_all_items_from_cartfinish(1);
        }
       
    }

    /**
     * getShippingDetails
     *
     * This Function call the shipping api according to conditions and return shipment number.
     * @return void
     */

    public function getShippingDetails($amount)
    {
        $data = array();

        $cart = $this->session->userdata('new_cart');
        $cart = cartCleanUp($cart);
        $this->session->set_userdata('new_cart', $cart);

        // this function return cart user data from session
        $cart_users_data = $this->session->userdata('cart_users_data');
        //echo '<pre>';print_r($cart_users_data);
        $cart_users_data['amount'] = $amount;
        // echo '<pre>';print_r($this->session->userdata('package_final'));print_r($cart);print_r($cart_users_data);echo '<pre>';exit;
        // this function hit the api as per inco terms choose by customer
        if ($cart_users_data['incoterms'] == 'DAP') {
            if ($cart_users_data['carrier_name'] == 'UPS') {
                $shipment_tracking_number = $this->createShippmentForUps($cart_users_data);
            } else if ($cart_users_data['carrier_name'] == 'ARAMEX') {
                $shipment_tracking_number = $this->createShippmentForAramex($cart_users_data);
            } else if ($cart_users_data['carrier_name'] == 'FEDEX') {
                $shipment_tracking_number = $this->createShippmentForFedex($cart_users_data);
            } else if ($cart_users_data['carrier_name'] == 'FREIGHTCOM') {
                $shipment_tracking_number = $this->createShippmentForFreightcom($cart_users_data);
            }

            // echo "<pre>";
            // print_r($shipment_tracking_number);
            // exit;

	    // if shipment tracking number array is not empty than function return success with tracking number

            if(is_string($shipment_tracking_number) && !empty($shipment_tracking_number)){
                $data['result'] = 'success';
                $data['shipment_tracking_number'] = $shipment_tracking_number;
            }else if (count($shipment_tracking_number) > 0) {
                $data['result'] = 'success';
                $data['shipment_tracking_number'] = $shipment_tracking_number;
            } else {
                // if shipment tracking number array is  empty than function return fail
                $data['result'] = 'fail';
            }
        } else {
            // if inco terms input is  empty than this function return fail
            $data['result'] = 'fail';
        }
        return $data;
    }

    /**
     * createShippmentForUps
     * This Function generate shipping label and return shipment tracking number for UPS.
     * @param  mixed $cart_users_data
     * @return void
     */
    public function createShippmentForUps($cart_users_data)
    {
        $this->load->library('UpsShipping');

        $apisetting = array();
        // This Function return UPs shiiping api details from database
        $apisetting = $this->cart_model->get_ups_api_settings($cart_users_data['ship_country_shortcode']);

        // Set variable values to generate UPs shipping label using API call
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
        $api_userid = trim($apisetting['userid']);

        //  set UPS Shiiping api paramters to call API
        $this->upsshipping->addField('access', $api_access);
        $this->upsshipping->addField('userid', $api_userid);
        $this->upsshipping->addField('passwd', $api_passwd);
        $this->upsshipping->addField('shipperNumber', $api_shipperNumber);
        $this->upsshipping->addField('shipper_description', $api_shipper_description);
        $this->upsshipping->addField('shipper_name', $api_shipper_name);
        $this->upsshipping->addField('shipper_attentionname', $api_shipper_attentionname);
        $this->upsshipping->addField('shipper_addressline1', $api_shipper_addressline1);
        $this->upsshipping->addField('shipper_addressline2', $api_shipper_addressline2);
        $this->upsshipping->addField('shipper_city', $api_shipper_city);
        $this->upsshipping->addField('shipper_stateprovincecode', $api_shipper_stateprovincecode);
        $this->upsshipping->addField('shipper_postalcode', $api_shipper_postalcode);
        $this->upsshipping->addField('shipper_countrycode', $api_shipper_countrycode);
        $this->upsshipping->addField('shipper_number', $api_shipper_number);
        $carrier_account_number = $api_shipperNumber;
        $name = $cart_users_data['ship_title'] . ' ' . $cart_users_data['ship_surname'];
        $this->upsshipping->addField('ShipTo_Name', $name);
        $this->upsshipping->addField('ShipTo_AddressLine', array(
            $cart_users_data['ship_address_1'], $cart_users_data['ship_address_2'], $cart_users_data['ship_address_3'],
        ));
        $this->upsshipping->addField('ShipTo_City', $cart_users_data['ship_city']);
        $this->upsshipping->addField('ShipTo_StateProvinceCode', $cart_users_data['ship_state']);
        $this->upsshipping->addField('ShipTo_PostalCode', $cart_users_data['ship_zip']);
        $country = strtoupper($cart_users_data['ship_country_shortcode']);
        $this->upsshipping->addField('ShipTo_CountryCode', $country);
        $ship_to_number = $cart_users_data['country_code'] . $cart_users_data['telephone'];
        $this->upsshipping->addField('ShipTo_Number', $ship_to_number);
        $this->upsshipping->addField('Service_Code', $cart_users_data['service_code']);
        $this->upsshipping->addField('ShipTo_phone', $cart_users_data['ship_telephone']);
        $this->upsshipping->addField('freight_service_type', $cart_users_data['freight_service_type']);

        /* Package Dimension and Weight */
        $package_data = $this->session->userdata('package_final');
        $package_items_data = $this->session->userdata('package_items_data');
        $shipment_tracking_number = array("package" => array(), "freight" => array());
        // iterate each shipment package in the loop
        // set packages dimensions and quantity for API Call

        $package_shipment = array();
        $freight_shipment = array();

        foreach ($package_data as $single_package) {
            if ($single_package['package_type'] == "freight") {

                array_push($freight_shipment, $single_package);
            } else {

                array_push($package_shipment, $single_package);
            }

        }

        //  echo "<pre>";

        // print_r($package_shipment);
        // exit;

        $this->upsshipping->addField('dimensions', $package_shipment);
        $this->upsshipping->addField('dimensions_freight', $freight_shipment);
        $this->upsshipping->addField('NumOfPieces', count($package_shipment));
        $this->upsshipping->addField('NumOfPieces_freight', count($freight_shipment));
        $mt_amount = (string) $cart_users_data['amount'];
        $this->upsshipping->addField('MonetaryValue', $mt_amount);

        if (!empty($package_shipment)) {
            // this function hit api for each package
            $api_response = $this->upsshipping->processShipAccept();

            if ($api_response["status"] == "success") {
                $ups_response = $api_response["ups_response"];

                if (count($package_shipment) > 1) {
                    $pac_number = 0;
                    foreach ($ups_response->ShipmentResponse->ShipmentResults->PackageResults as $pkey => $singlePackageResults) {
                        $path = FCPATH . '/assets/uploads/invoice/';
                        $file_name_jpeg = 'Shipping_label_' . $singlePackageResults->TrackingNumber . '.jpeg';
                        $filejpg = $path . $file_name_jpeg;

                        if (isset($singlePackageResults->ShippingLabel->GraphicImage)) {
                            $imageData = base64_decode($singlePackageResults->ShippingLabel->GraphicImage);

                            $source = imagecreatefromstring($imageData);
                            $angle = 270;
                            $rotate = imagerotate($source, $angle, 0);
                            imagejpeg($rotate, $filejpg, 100);
                            imagedestroy($source);
                        }

                        $shipment_tracking_number["package"][$pac_number] = $singlePackageResults->TrackingNumber;

                        $pac_number++;
                    }

                } else {

                    $path = FCPATH . '/assets/uploads/invoice/';
                    $file_name_jpeg = 'Shipping_label_' . $ups_response->ShipmentResponse->ShipmentResults->ShipmentIdentificationNumber . '.jpeg';
                    $filejpg = $path . $file_name_jpeg;

                    if (isset($ups_response->ShipmentResponse->ShipmentResults->PackageResults->ShippingLabel->GraphicImage)) {
                        $imageData = base64_decode($ups_response->ShipmentResponse->ShipmentResults->PackageResults->ShippingLabel->GraphicImage);

                        $source = imagecreatefromstring($imageData);
                        $angle = 270;
                        $rotate = imagerotate($source, $angle, 0);
                        imagejpeg($rotate, $filejpg, 100);
                        imagedestroy($source);
                    }

                    $tracking_number = $ups_response->ShipmentResponse->ShipmentResults->ShipmentIdentificationNumber;

                    $shipment_tracking_number["package"][0] = $tracking_number;

                }

            }

        }

        if (!empty($freight_shipment)) {

            //Feight Shipment when shipment size is
            $api_response = $this->upsshipping->process_frieght_ShipAccept();

            // print_r($api_response);
            // exit;

            if ($api_response["status"] == "success") {
                $ups_response = $api_response["ups_response"];
                $tracking_number = $ups_response->FreightShipResponse->ShipmentResults->ShipmentNumber;
                $fre_pack_number = 0;
                foreach ($freight_shipment as $single_shipment) {
                    $shipment_tracking_number["freight"][$fre_pack_number] = $tracking_number;
                    $fre_pack_number++;
                }

            }
        }
        return $shipment_tracking_number;

    }

    /**
     * createShippmentForAramex
     *
     *  This Function generate shipping label and return shipment tracking number for Aramex.
     * @param  mixed $cart_users_data
     * @return void
     */
    public function createShippmentForAramex($cart_users_data)
    {
        /* Package Dimension and Weight */
        $package_data = $this->session->userdata('package_data');
        $package_items_data = $this->session->userdata('package_items_data');
        // This Function return aramex api details from database which includes account number, username password etc
        $apiData = $this->api_model->get_aramex_api_details();

        $shipment_tracking_number = array();
        // iterate each shipment package in the loop
        // echo "<pre>";

        // print_r($value);

        // this function hit the api and return responce
        $aramex_response = createShippmentForAramex($cart_users_data, $package_data, $apiData);
        if ($aramex_response->HasErrors != 1) {

            $path = FCPATH . '/assets/uploads/invoice/';
            $file_name_jpeg = 'Shipping_label_' . $aramex_response->Shipments->ProcessedShipment->ID . '.png';
            // Image path
            $img = $path . $file_name_jpeg;

            // Label image URL
            $url = $aramex_response->Shipments->ProcessedShipment->ShipmentLabel->LabelURL;

            // print_r($aramex_response->Shipments);
            // Save image
            // var_dump($img); 
            // var_dump($url);
            $result = file_put_contents($img, file_get_contents($url));
            //echo $result;die();
            $pac_number = 0;
            foreach ($package_data as $pkey => $value) {
                //$shipment_tracking_number[$pkey] = $aramex_response->Shipments->ProcessedShipment->ID;
                $shipment_tracking_number["package"][$pac_number] = $aramex_response->Shipments->ProcessedShipment->ID;
                $pac_number++;
            }
            // this code append shipment tracking number of package in the array

        } else {
            $pac_number = 0;
            foreach ($package_data as $pkey => $value) {
                //$shipment_tracking_number[$pkey] = $aramex_response->Shipments->ProcessedShipment->ID;
                $shipment_tracking_number["package"][$pac_number] = $aramex_response->Shipments->ProcessedShipment->Notifications->Notification->Code;
                $pac_number++;
            }            
            // echo "<pre>";
            // echo "Error Row of Packing";
            // echo "<br>";
            // print_r($aramex_response);            
            // print_r($shipment_tracking_number);
            // exit;
            
        }
        // echo '<pre>';
        // print_r($aramex_response);
        // exit;
        // this code return  shipping tracking number array
        return $shipment_tracking_number;
    }

    /**
     * createShippmentForUps
     * This Function generate shipping label and return shipment tracking number for UPS.
     * @param  mixed $cart_users_data
     * @return void
     */
    public function createShippmentForFedex($cart_users_data)
    {
        
        $this->load->library('FedexShipping');
        $apisetting = array();
        // This Function return Fedex shiiping api details from database
        $apisetting = array();
	    $apisetting = $this->cart_model->get_fedex_api_settings($cart_users_data['ship_country_flag']);
        if (empty($apisetting)) {
            $apisetting = $this->cart_model->get_fedex_api_settings();
        }
        // Set variable values to generate UPs shipping label using API call
        
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
        if ($cart_users_data['ship_country_flag']) {
            $country = strtoupper($cart_users_data['ship_country_flag']);
        } else {
            $country = strtoupper($cart_users_data['ship_country_shortcode']);

        }
        $this->fedexshipping->addField('ShipTo_CountryCode', $country);
        $this->fedexshipping->addField('ShipTo_phone', $cart_users_data['ship_telephone']);
        $this->fedexshipping->addField('Service_Code', $cart_users_data['service_code']);
        $this->fedexshipping->addField('ShipTo_phone', $cart_users_data['ship_telephone']);
        $mt_amount = (string) $cart_users_data['amount'];
        $this->fedexshipping->addField('MonetaryValue', $mt_amount);
        /* Package Dimension and Weight */
        $package_data = $this->session->userdata('package_final');
        $package_items_data = $this->session->userdata('package_items_data');
        $shipment_tracking_number = array("package" => array(), "freight" => array());
        // iterate each shipment package in the loop
        // set packages dimensions and quantity for API Call
        $language_data = get_user_lang_data(array('general_instruction'), $this->lang->default_lang_id);
        $general_instruction = (object) $language_data['general_instruction'];
        $currencyV = getDefaultCurrencyCode('l') . '_currency';
        $currency = $general_instruction->$currencyV;
        $this->fedexshipping->addField('currency', $currency);

        $package_shipment = array();
        $freight_shipment = array();
        
        foreach ($package_data as $single_package) {
            if ($single_package['package_type'] == "freight") {
                array_push($freight_shipment, $single_package);
            } else {
                array_push($package_shipment, $single_package);
            }

        }

        //  echo "<pre>";
        //  print_r($package_shipment);
        //  print_r($freight_shipment);
        // exit;

        $this->fedexshipping->addField('dimensions', $package_shipment);
        $this->fedexshipping->addField('dimensions_freight', $freight_shipment);
        $this->fedexshipping->addField('NumOfPieces', count($package_shipment));
        $this->fedexshipping->addField('NumOfPieces_freight', count($freight_shipment));

        if (!empty($package_shipment) || !empty($freight_shipment)) {
            // this function hit api for each package 
            
            if(count($freight_shipment)>0){
                $api_response = $this->fedexshipping->processFreightShipment();
            }else{                
                $api_response = $this->fedexshipping->processshipment();
            }
            

            // echo "<pre>";
            // print_r($api_response);exit;

            if ($api_response["status"] == "success") {
                $fedex_response = $api_response["fedex_response"];

                if (count($package_shipment) > 0 || count($freight_shipment)>0) {
                    $pac_number = 0;
                    // echo "<pre>";
                    // print_r($fedex_response);exit;
                    foreach ($fedex_response->pieceResponses as $pkey => $singlePackageResults) {

                        $path = FCPATH . '/assets/uploads/invoice/';
                        $file_name_jpeg = 'Shipping_label_' . $singlePackageResults->trackingNumber . '.jpeg';
                        $filejpg = $path . $file_name_jpeg;

                        if (isset($singlePackageResults->packageDocuments[0]->encodedLabel)) {
                            $imageData = base64_decode($singlePackageResults->packageDocuments[0]->encodedLabel);

                            $source = imagecreatefromstring($imageData);
                            $angle = 270;
                            $rotate = imagerotate($source, $angle, 0);
                            imagejpeg($rotate, $filejpg, 100);
                            imagedestroy($source);
                        }

                        $tracking_number = $singlePackageResults->trackingNumber;

                        $shipment_tracking_number[$package_data[$pac_number]['package_type']][] = $tracking_number;     
                        $pac_number++;                   
                    }

                }

            }

        }

        // if(!empty($freight_shipment)) {

        //         //Feight Shipment when shipment size is
        //         $api_response = $this->upsshipping->process_frieght_ShipAccept();

        //         // print_r($api_response);
        //         // exit;

        //         if($api_response["status"]=="success") {
        //         $ups_response = $api_response["ups_response"];
        //         $tracking_number = $ups_response->FreightShipResponse->ShipmentResults->ShipmentNumber;
        //         $fre_pack_number = 0;
        //         foreach($freight_shipment as $single_shipment){
        //           $shipment_tracking_number["freight"][$fre_pack_number] = $tracking_number;
        //           $fre_pack_number++;
        //         }

        //         }
        // }

        // print_r($shipment_tracking_number);
        // exit;
        return $shipment_tracking_number;

    }

    /**
     * createShippmentForUps
     * This Function generate shipping label and return shipment tracking number for UPS.
     * @param  mixed $cart_users_data
     * @return void
     */
    public function createShippmentForFreightcom($cart_users_data)
    {
        $this->load->library('FreightShipping');
        // echo "<pre>";
        // print_r($cart_users_data);

        $apisetting = array();
        // This Function return Fedex shiiping api details from database
        $apisetting = array();
        $apisetting = $this->cart_model->get_freightcom_api_settings($cart_users_data['ship_country_flag']);
        if (empty($apisetting)) {
            $apisetting = $this->cart_model->get_freightcom_api_settings();
        }
        // Set variable values to generate UPs shipping label using API call
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
        if ($cart_users_data['ship_country_flag']) {
            $country = strtoupper($cart_users_data['ship_country_flag']);
        } else {
            $country = strtoupper($cart_users_data['ship_country_shortcode']);

        }
        $this->freightshipping->addField('ShipTo_CountryCode', $country);
        $this->freightshipping->addField('ShipTo_phone', $cart_users_data['ship_telephone']);
        $this->freightshipping->addField('Shipment_order_number', $cart_users_data['order_number']);
        $this->freightshipping->addField('Service_Code', $cart_users_data['service_code']);
        $mt_amount = (string) $cart_users_data['amount'];
        $this->freightshipping->addField('MonetaryValue', $mt_amount);
        $package_data = $this->session->userdata('package_final');
        $package_items_data = $this->session->userdata('package_items_data');
        $shipment_tracking_number = array("package" => array(), "freight" => array());

        // echo "<pre>";
        // print_r($package);
        // exit;

        $package_shipment = array();
        $freight_shipment = array();

        foreach ($package_data as $single_package) {
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

        $sales_order_preview = (object) $language_data['sales_order_preview'];
        $html = "";
        $data = array();
        $status = 'success';

        if (!empty($package_shipment)) {
            $freightcom_response = $this->freightshipping->processShipment();

            if ($freightcom_response['status'] == "success") {

                $shipment_tracking_number = $freightcom_response['shipment_id'];

                // $freightcom_response = $freightcom_response['shipment'];

                // $alllabels = $freightcom_response->labels;
                // $tracking_numbers = $freightcom_response->tracking_numbers;

                // $label_url = "";

                // foreach ($alllabels as $singlelabel) {

                //     if ($singlelabel->size == "a6" && $singlelabel->format == "pdf" && $singlelabel->padded == "") {
                //         $label_url = $singlelabel->url;

                //     }

                // }

                // if (count($package_shipment) > 0) {
                //     $pac_number = 0;

                //     foreach ($freightcom_response->details->packaging_properties->packages as $pkey => $singlePackageResults) {

                //         $path = FCPATH . '/assets/uploads/invoice/';
                //         $file_name_pdf = 'Shipping_label_' . $tracking_numbers[$pkey] . '.pdf';
                //         $filepdf = $path . $file_name_pdf;
                //         if ($label_url != "") {
                //             //save the file by using base name
                //             if (file_put_contents($filepdf, file_get_contents($label_url))) {
                //                 // echo "File downloaded successfully!";
                //             }
                //         }
                //         $shipment_tracking_number["package"][$pac_number] = $tracking_numbers[$pkey];
                //         $pac_number++;
                //     }

                // }

            }

        }

        //     echo "<pre>";
        //    print_r($shipment_tracking_number);
        //     exit;

        // if(!empty($freight_shipment)) {

        //         //Feight Shipment when shipment size is
        //         $api_response = $this->upsshipping->process_frieght_ShipAccept();

        //         // print_r($api_response);
        //         // exit;

        //         if($api_response["status"]=="success") {
        //         $ups_response = $api_response["ups_response"];
        //         $tracking_number = $ups_response->FreightShipResponse->ShipmentResults->ShipmentNumber;
        //         $fre_pack_number = 0;
        //         foreach($freight_shipment as $single_shipment){
        //           $shipment_tracking_number["freight"][$fre_pack_number] = $tracking_number;
        //           $fre_pack_number++;
        //         }

        //         }
        // }

        // print_r($shipment_tracking_number);
        // exit;
        return $shipment_tracking_number;

    }

    /**
     * unique_code
     *
     * This Function is used to generate random number or unique code for the invoice number.
     * @return void
     */
    public function unique_code()
    {
        return time() . rand(10, 100);
    }

    /**
     * updateInventoryItems
     *
     * This Function send email to admin when Quanity and threshold quantity  of any product is reached.
     * @param  mixed $allProductIds
     * @param  mixed $allProductQuantity
     * @param  mixed $user_id
     * @param  mixed $invoice_num_unique
     * @return void
     */
    public function updateInventoryItems($allProductIds, $allProductQuantity, $user_id, $invoice_num_unique, $allStoreId = array())
    {
       
        // if product id array is not empty than this condition will work
        if (count($allProductIds) > 0) {
            $this->db->select('products.id, products.kgt_ref_number, products.quantity, product_details.quantity_threshold, product_details.replenishment_order_date, product_details.ex_stock_period, product_details.replenishing_period, product_details.replenishment_order_number');

            $this->db->join('product_details', 'products.id = product_details.product_id', 'LEFT');

            $this->db->where_in('products.id', $allProductIds);
            $this->db->from('products');
            $productInfo = $this->db->get()->result_array();
            if (count($productInfo) > 0) {
                // declare variable for the function
                $previous_quantity = $negative_list = $q_thres_list = array();
                $negative = 0;
                $q_thres = 0;

                //This Function load email library and initialize the email configuration from config file
                $this->load->library('Email');
                $config = $this->config->item('emailconfig');
                $this->email->initialize($config);
                // This Function get email body content subject and from address  from the table email_instruction these values are manageable from the admin side
                $email_instruction = (object) get_user_lang_data(array('email_instruction'), $this->lang->default_lang_id)['email_instruction'];

                // Set variable for the email
                // $fromEmailId    = $email_instruction->from_mail_id;
                // $fromName       = $email_instruction->admin_forgot_details_form_verification_code_fromname;

                $fromEmailId = $this->config->item('fromemailaddress');
                //$fromName       = $this->config->item('fromemailname');
                $fromName = $email_instruction->admin_forgot_details_form_verification_code_fromname;

                $toEmailId = $email_instruction->admin_invoice_email_to_list;

                // check if language is not an english, then will fetch sender name for english becoz send grid not support or not validated other language sender name
                if ($this->lang->default_lang_id != 13) {
                    // $fromName = get_user_lang_data(array('email_instruction'), 13)['email_instruction']['admin_forgot_details_form_verification_code_fromname'];
                }
                $p_count = 0;
                $newProductInfo = array();
                foreach($productInfo as $prod_key=>$prod_val){
                    $newProductInfo[$prod_val['id']] = $prod_val;
                }
                $productInfo = $newProductInfo;
                //echo '<pre>';print_r($productInfo);print_r($allProductQuantity);print_r($allProductIds);echo '</pre>';exit;
                foreach ($allProductIds as $prod_id) {
                    $product = $productInfo[$prod_id];
                    $availableQuantity = $product['quantity'];
                    $userQuantity = $allProductQuantity[$p_count];
                    //$userQuantity = 0;
                                                            
                    // if item available  quantity in the inventory is greater than 0 than this condition will  executed
                    if ($availableQuantity > 0) {
                        // get the newquantity after deducting the  required quantity from available quantity
                        $newQuantity = $availableQuantity - $userQuantity;

                        // if newquantity is less than 0 than this condition will add the product number in the negative product list array
                        if ($newQuantity < 0) {
                            $back_order_items = array(
                                'product_id' => $product['id'],
                                'cart_user_id' => $user_id,
                                'invoice_number' => $invoice_num_unique,
                                'backorder_quantity' => $newQuantity,
                                'store_quantity' => $availableQuantity,
                                'user_quantity' => $userQuantity,
                            );
                            $this->db->insert('cart_back_order_products', $back_order_items);

                            //this code will add product number and quanity in the trigger email for negative inventory array
                            $negative_list[] = $product['kgt_ref_number'] . ' , ' . $newQuantity;
                            $negative++;
                        } else if ($newQuantity < $product['quantity_threshold']) {
                            // if newquantity is less than the threshold quantity  than this condition will add the product number in the quantity threshold array
                            //  this code will add product number and quanity in the trigger email for quantity threshold reached array
                            $q_thres_list[] = $product['kgt_ref_number'] . ' , ' . $product['quantity_threshold'];
                            $q_thres++;
                        }
                    } else {
                        // if item available  quantity in the inventory is less than or equal to  0 than this condition will  executed
                        $newQuantity = $availableQuantity - $userQuantity;
                        $back_order_items = array(
                            'product_id' => $product['id'],
                            'cart_user_id' => $user_id,
                            'invoice_number' => $invoice_num_unique,
                            'backorder_quantity' => $newQuantity,
                            'store_quantity' => $availableQuantity,
                            'user_quantity' => $userQuantity,
                        );
                        $this->db->insert('cart_back_order_products', $back_order_items);

                        //Add product number in trigger email for negative inventory array
                        $negative_list[] = $product['kgt_ref_number'] . ' , ' . $newQuantity;
                        $negative++;
                    }

                    $this->db->where('id', $product['id']);
                    $this->db->update('products', array('quantity' => $newQuantity));
                    $previous_quantity[$p_count] = $availableQuantity;
                    //echo $this->db->last_query();exit;
                    //replenishment order expired alert
                    if ($newQuantity < 0 || $newQuantity < $product['quantity_threshold']) {
                        $orderDate = $product['replenishment_order_date'];
                        $stockPeriod = $product['ex_stock_period'];
                        if ($orderDate && $stockPeriod) {
                            $today = date('Y-m-d');
                            $startTimeStamp = strtotime($today);
                            $endTimeStamp = strtotime($orderDate);
                            $timeDiff = abs($endTimeStamp - $startTimeStamp);
                            $numberDays = $timeDiff / 86400;
                            $numberDays = intval($numberDays);
                            if ($numberDays > $stockPeriod) {
                                $subject = $email_instruction->replenishment_period_expired_subject;
                                $msg = htmlspecialchars_decode($email_instruction->replenishment_period_expired_mail);
                                $msg = str_replace('{replenishment_period}', $product['replenishing_period'], $msg);
                                $msg = str_replace('{replenishment_order_number}', $product['replenishment_order_number'], $msg);
                                $msg = str_replace('{OrderDate}', $orderDate, $msg);
                                $msg = str_replace('{existing_quantity}', $newQuantity, $msg);
                                $msg = str_replace('{quantity_threshold}', $product['quantity_threshold'], $msg);
                                $this->email->from($fromEmailId, $fromName);
                                $this->email->to($toEmailId);
                                $this->email->subject($subject);
                                $this->email->message($msg);
                                $this->email->send();
                            }
                        }
                    }
                    
                    if (count($allStoreId)>0){   
                        $sql ="update products_count set quantity = (quantity-".$userQuantity.") where store_id=".$allStoreId[$p_count]." and product_id = ".$product['id']."";                     
                        $query= $this->db->query($sql);
                        $productInfo[$prod_id]['quantity'] = $productInfo[$prod_id]['quantity']-$userQuantity;
                    }
                    $p_count++;
                }

                // if negative quantity list and quantity threshold array if anyone from both is not empty than this condition will executed and send emails according to conditions
                if ($negative > 0 || $q_thres > 0) {

                    // This Code will send emails for negative Quanity products to admin
                    if ($negative > 1) {
                        $subject = $email_instruction->fews_product_negative_backorder_yes_subject;
                        $msg = htmlspecialchars_decode($email_instruction->fews_product_negative_backorder_yes_mail);
                        $msg = str_replace('{rfq_number_with_existing_quantity}', implode(',', $negative_list), $msg);
                        $this->email->from($fromEmailId, $fromName);
                        $this->email->to($toEmailId);
                        $this->email->subject($subject);
                        $this->email->message($msg);
                        $this->email->send();
                    } else if ($negative == 1) {
                        $subject = $email_instruction->one_product_negative_backorder_yes_subject;
                        $msg = htmlspecialchars_decode($email_instruction->one_product_negative_backorder_yes_mail);
                        $pList = explode(' , ', $negative_list[0]);
                        $msg = str_replace('{rfq_number}', $pList[0], $msg);
                        $msg = str_replace('{existing_quantity}', $pList[1], $msg);
                        $this->email->from($fromEmailId, $fromName);
                        $this->email->to($toEmailId);
                        $this->email->subject($subject);
                        $this->email->message($msg);
                        $this->email->send();
                    }

                    // This Code will send emails for Quanity threshold products to admin
                    if ($q_thres > 1) {
                        $subject = $email_instruction->fews_product_quantity_threshold_subject;
                        $msg = htmlspecialchars_decode($email_instruction->fews_product_quantity_threshold_mail);
                        $msg = str_replace('{rfq_number_with_quantity_threshold}', implode(',', $q_thres_list), $msg);
                        $this->email->from($fromEmailId, $fromName);
                        $this->email->to($toEmailId);
                        $this->email->subject($subject);
                        $this->email->message($msg);
                        $this->email->send();
                    } else if ($q_thres == 1) {
                        $subject = $email_instruction->one_product_quantity_threshold_subject;
                        $msg = htmlspecialchars_decode($email_instruction->one_product_quantity_threshold_mail);
                        $pList = explode(' , ', $q_thres_list[0]);
                        $msg = str_replace('{rfq_number}', $pList[0], $msg);
                        $msg = str_replace('{quantity_threshold}', $pList[1], $msg);
                        $this->email->from($fromEmailId, $fromName);
                        $this->email->to($toEmailId);
                        $this->email->subject($subject);
                        $this->email->message($msg);
                        $this->email->send();
                    }
                }
                // This Function will update the session variable related to quantity
                $this->session->unset_userdata('cart_product_quantity');
                $session_data = array('cart_product_quantity' => $previous_quantity);
                $this->session->set_userdata($session_data);
            }

        }
    }

    /**
     * checkBackOrderQuantity
     *
     * This Function check the quantity of the products in the cart and according to back order accept it returns the list of items those are not available.
     * @return void
     */
    public function checkBackOrderQuantity($returnType = 'json')
    {
        $product_not_available = array();
        // This function read cart data from session
        $cart_details = $this->session->userdata('new_cart');
        // This Condition executed the  code if cart session is not empty
        if (count($cart_details) > 0) {
            // This loop iterate each item of the cart and check the backorder status of the product
            foreach ($cart_details as $cart) {
                
                $var_qty= 0;
                foreach($cart['quantity'] as $cart_qty){
                    $var_qty += $cart_qty;
                }
                // set the quantity variable of the item
                $userQuantity = empty($var_qty) ? 0 : $var_qty;
                $this->db->select('quantity,kgt_ref_number,backorder_status');
                $this->db->where('id', $cart['item_id']);
                $this->db->from('products');
                $productInfo = $this->db->get()->row_array();
                // if the back order status of the item is disabled than this condition will work
                if (isset($productInfo['backorder_status']) && $productInfo['backorder_status'] == 0) {
                    $availableQuantity = $productInfo['quantity'];
                    $newQuantity = $availableQuantity - $userQuantity;
                    // if available quantity is less than 0 than add item number in product not available array
                    if ($availableQuantity < 0 || $newQuantity < 0) {
                        $product_not_available[] = $productInfo['kgt_ref_number'];
                    }
                }
            }
        }
        // this condition executed the code if product not available array is not empty
        if (count($product_not_available) > 0) {
            // convert the array in to string by implode function
            $product_items = implode(', ', $product_not_available);
            if (count($product_not_available) > 1) {
                // if mutiple products status is not accepted than this function executed
                $output = array('msg' => $product_items, 'error_message' => 'backorder_not_accepted_multiple');
            } else {
                // if single product status is not available than this function executed
                $output = array('msg' => $product_items, 'error_message' => 'backorder_not_accepted');
            }
            // this function return json
            if ($returnType == 'array') {
                return $output;
                exit;
            } else {
                echo json_encode($output);
                exit;
            }
        }
    }

    /**
     * remove_all_items_from_cartfinish
     *
     * This Function is called on payment completion. The main role of this functions to clear the cart after order.
     * @param  mixed $check
     * @param  mixed $user_data_delete
     * @return void
     */
    public function remove_all_items_from_cartfinish($check = 0, $user_data_delete = 0)
    {

        $cart_users_data = $this->session->userdata('cart_users_data');
        $last_inserted_cart_block_id = $this->session->userdata('last_inserted_cart_block_id');

        $update_data = array(
            'status' => 1,
            'created_time' => time(),
        );
        // Update status in the cart_block_users table as per session id
        $this->db->where('id', $last_inserted_cart_block_id);
        $this->db->update('cart_block_users', $update_data);

        if ($check == 0) {
            $where_param = array();
            $where_param['str_email'] = $cart_users_data['email'];
            $where_param['str_country_code'] = $cart_users_data['country_code'];
            $where_param['str_telephone'] = $cart_users_data['telephone'];

            $select_param = array('dte_block' => 'dte_block', 'region' => 'region');
            $block_info = $this->comman_model->get_row("block_email_list", $select_param, $where_param);
            if (!empty($block_info)) {

                // if block_email_list table having records as per cart email and phone  than update the block time in the table block_email_list
                $block_data = array();
                $block_data['int_block'] = 5;
                $block_data['dte_block'] = date("Y-m-d H:i:s", time());
                $this->comman_model->update_column("block_email_list", $where_param, $block_data);
            } else {
                // if block_email_list table having no records as per cart email and phone  than insert  the data in the table block_email_list
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
                $block_data['created_time'] = time();
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

        $cart_update_users_data = $cart_users_data;
        unset($cart_update_users_data['po_number']);
        unset($cart_update_users_data['po_file']);
        unset($cart_update_users_data['order_number']);
        unset($cart_update_users_data['ship_with_freight']);
        unset($cart_update_users_data['carrier_name']);
        unset($cart_update_users_data['shipping_rate']);
        unset($cart_update_users_data['shipping_rate_freight']);
        unset($cart_update_users_data['shipping_rate_freight']);
        unset($cart_update_users_data['shipping_rate_freight']);
        unset($cart_update_users_data['shipping_rate_freight']);
        unset($cart_update_users_data['shipping_rate_freight']);
        unset($cart_update_users_data['discount']);
        unset($cart_update_users_data['amount_received']);
        unset($cart_update_users_data['amount_pending']);
        $session_data_update = array('cart_users_data' => $cart_update_users_data);
        $this->session->set_userdata($session_data_update);
        $this->session->set_userdata($session_data);

        // this function clear all cart user session variables
        $this->clear_user_session('no');
    }

    /**
     * clear_user_session
     *
     * This Function clear only cart related session variables and redirect to cart page.
     * @return void
     */
    public function clear_user_session($isRedirect = 'yes')
    {
        $this->session->unset_userdata('cart_email_attempt');
        $this->session->unset_userdata('cart_sms_attempt');
        $this->session->unset_userdata('cart_email_confirm');
        $this->session->unset_userdata('cart_email_confirm_status');
        $this->session->unset_userdata('cart_sms_confirm');
        $this->session->unset_userdata('cart_sms_confirm_status');
        $this->session->unset_userdata('final_price_data');
        $this->session->unset_userdata('coupon_applied');
        $this->session->unset_userdata('coupon_data');
        $this->session->unset_userdata('discount');
        $this->session->unset_userdata('quotation_id');
        $this->session->unset_userdata('quotation_expdate');
        $this->session->unset_userdata('package_both_box_count');
        $this->session->unset_userdata('package_both_box');
        $this->session->unset_userdata('amount_received');
        $this->session->unset_userdata('order_id');
        $this->session->unset_userdata('order_number');
        $this->session->unset_userdata('partial_payment_percentage');
        $this->session->unset_userdata('payment_type');

        if ($isRedirect == 'yes') {
            redirect("cart/index");
        }
    }

    /**
     * createSquarePayment
     * This Function make payment and return transaction id for square payment.
     * @return void
     */
    public function createSquarePayment($accesstoken, $currency, $amount, $uniquekey, $cardtoken, $cardtype)
    {

        if ($currency == "cad" || $currency == "CAD") {
            $currency = "CAD";
        } else {
            $currency = "CAD";
        }

        $final_amount = intval($amount * 100);
        // this function  check back order product status
        // create token for payment gateway
        $headers = array("Authorization: Bearer " . $accesstoken, 'Content-Type:application/json');
        $money_array = array(
            "amount" => $final_amount,
            "currency" => $currency,
        );

        $postdata = array(
            'amount_money' => $money_array,
            'idempotency_key' => $uniquekey,
            'source_id' => $cardtoken,
            'accept_partial_authorization' => false,
            "autocomplete" => true,
        );
        if ($cardtype != "newcard") {

            $user_id = getFrontenduserId();
            $user_data = $this->comman_model->get_data_by_id("users", array("id" => $user_id));

            $postdata["customer_id"] = $user_data['square_customer_id'];
        }
        $curl_post_data = json_encode($postdata);
        // condition for payment gateway endpoint in case of devmode or production mode
        if ($this->config->item('payment_mode') == 1) {
            $url = 'https://connect.squareup.com/v2/payments';
        } else {
            $url = 'https://connect.squareupsandbox.com/v2/payments';
        }

        // curl request to generate token
        $curl_handle = curl_init($url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POST, true);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $curl_post_data);
        $response = json_decode(curl_exec($curl_handle), true);
        curl_close($curl_handle);
        if (isset($response['payment']['status']) && $response['payment']['status'] == "COMPLETED" && isset($response['payment']['id']) && $response['payment']['id']) {

            // if token generated successfully than this code will work
            $aResult = array(
                'transaction_id' => $response['payment']['id'],
                'status' => 'success',
                'detail' => $response['payment'],
            );
            return $aResult;
            exit;
        } else {
            $errors = $response['errors'][0];
            // if token will not generated succesfully than this code will work
            $aResult = array('errors' => $errors, 'status' => 'error');
            return $aResult;
            exit;
        }
    }

    /**
     * Method square_purchase
     *
     * @return void
     */
    public function square_purchase()
    {

        $cart_users_data = $this->session->userdata('cart_users_data');
        $final_price_data = $this->session->userdata('final_price_data');

        $order_number = $cart_users_data['order_number'];
        $email = $cart_users_data['email'];
        $productname = 'KGS_' . $cart_users_data['order_number'];

        //check captcha
        $captcha = validate_captcha();
        if (isset($captcha['response']) && $captcha['response'] != 'success') {
            echo json_encode($captcha);
            exit;
        }

        $result = array();

        // If payment form is submitted with token
        if ($this->input->post('token')) {

            // Retrieve stripe token, card and user info from the submitted form data
            $postData = $this->input->post();
            $postData = $this->security->xss_clean($postData);
            // This Function check the quantity of the products and if not available than it retun json and stop execution of the next code.
            $this->checkBackOrderQuantity();
            // This Function return currency code
            $currency = getDefaultCurrencyCode();
            $countryCode = 'ca';
            if ($currency == 'cad') {
                // if curreny is canading Dollar than country code ca or else us
                $countryCode = 'ca';
            }
            // if curreny is canading Dollar than this  condition will executed
            $square_api_settings = $this->cart_model->square_api_settings($countryCode);
            $accesstoken = $square_api_settings['access_token'];
            $amount = $final_price_data['total'];
            $uniquekey = time() . '-' . mt_rand();
            $cardtoken = $this->input->post('token');
            $cardtype = $this->input->post('card_value');

            // This Function make the payment and retun api responce
            $responce = $this->createSquarePayment($accesstoken, $currency, $amount, $uniquekey, $cardtoken, $cardtype);
            // If payment successful
            if ($responce['status'] == "success") {
                // If payment successful and return transaction id than this code return transaction id and status.
                $invoice_num_unique = $this->unique_code();
                $tansaaction_detail = $responce['detail'];

                // This function update information in the database
                $cart_users_data['payment_approved'] = "1";
                $cart_users_data['payment_created'] = date('Y-m-d H:i:s');
                $cart_users_data['transaction_id'] = $responce['transaction_id'];
                $cart_users_data['payment_method'] = "1";
                $cart_users_data['amount'] = $final_price_data['total'];
                $cart_users_data['currency'] = $currency;
                $cart_users_data['invoice_number'] = $invoice_num_unique;
                $cart_users_data['card_number'] = $tansaaction_detail['card_details']['card']['last_4'];

                // This Function update information in the database and session after payment success
                $this->cartProductFinalzeAfterPayment($invoice_num_unique, $cart_users_data);

                $result['transaction_id'] = $responce['transaction_id'];
                $result['status'] = "success";
                echo json_encode($result);
                exit;
            } else {
                // If payment function does not return transaction id than this code return error with  status.

                if ($responce['errors']['code'] == "CVV_FAILURE") {

                    $stripe_errors = $this->comman_model->getSingleStripeErrorsByCode('invalid_cvc', $this->lang->default_lang_id);
                } else if ($responce['errors']['code'] == "CARD_TOKEN_USED") {

                    $stripe_errors = $this->comman_model->getSingleStripeErrorsByCode('try_again_later', $this->lang->default_lang_id);
                } else if ($responce['errors']['code'] == "ADDRESS_VERIFICATION_FAILURE") {

                    $stripe_errors = $this->comman_model->getSingleStripeErrorsByCode('incorrect_zip', $this->lang->default_lang_id);
                } else if ($responce['errors']['code'] == "INVALID_EXPIRATION") {

                    $stripe_errors = $this->comman_model->getSingleStripeErrorsByCode('invalid_expiry_year', $this->lang->default_lang_id);
                } else if ($responce['errors']['code'] == "GENERIC_DECLINE") {

                    $stripe_errors = $this->comman_model->getSingleStripeErrorsByCode('do_not_honor', $this->lang->default_lang_id);
                } else {
                    $stripe_errors = $this->comman_model->getSingleStripeErrorsByCode('processing_error', $this->lang->default_lang_id);
                }

                $result['error'] = $stripe_errors;
                $result['status'] = "error";
                echo json_encode($result);
                exit;
            }
        } else {
            $result['errors'] = '';
            $result['status'] = "error";
            echo json_encode($result);
            exit;
        }
    }

    public function clear_user_session_final()
    {
        $this->session->unset_userdata('entry_email_attempt');
        $this->session->unset_userdata('entry_sms_attempt');
        $this->session->unset_userdata('email_confirm');
        $this->session->unset_userdata('entry_email_confirm_status');
        $this->session->unset_userdata('sms_confirm');
        $this->session->unset_userdata('entry_sms_confirm_status');
        $this->session->unset_userdata('entry_users_data');
        $this->session->unset_userdata('email_randomString');
        $this->session->unset_userdata('sms_randomString');
        $this->session->unset_userdata('blocked_emails');
        $this->session->unset_userdata('blocked_phones');
        $this->session->unset_userdata('validemail');
        $this->session->unset_userdata('validphone');
    }

    /**
     * Method save_quotation
     *
     * Function to save the current quotation.
     *
     * @return void
     */
    public function save_quotation($emailMe = '')
    {
        $session_data = $this->session->all_userdata();
        $user_id = getFrontenduserId();

        $quotation_daylimit = $this->config->item('quotation_daylimit');

        if ($user_id) {
            $quotation_data = array();
            $quotation_data['user_id'] = $user_id;
            $quotation_data['quotation_number'] = $session_data['cart_users_data']['order_number'];
            $quotation_data['amount'] = $session_data['cart_final_price'];
            $quotation_data['currency'] = $session_data['cart_final_currency'];
            $quotation_data['expirydate'] = date('Y-m-d', strtotime(date('Y-m-d') . ' + ' . $quotation_daylimit . ' days'));
            $quotation_data['complete_data'] = serialize($session_data);

            if ($emailMe == "1") {
                $quotation_data['email_me'] = 1;
            }
            $quotation_data['status'] = 0;

            $quotation_id_seesion = $this->session->userdata('quotation_id') ? $this->session->userdata('quotation_id') : "";

            if ($quotation_id_seesion) {
                $this->comman_model->update_column("quotations", array("id" => $quotation_id_seesion), $quotation_data);
                $quotation_id = $quotation_id_seesion;
            } else {
                $quotation_id = $this->comman_model->add('quotations', $quotation_data);
            }

            if ($quotation_id) {

                $session_updatedata = array(
                    'paymee_token' => '',
                    'paymee_txnId' => '',
                    'cart' => '',
                    'last_inserted_cart_block_id' => "",
                    'edit_cart_mode' => 'false',
                    +'cart_randomString' => '',
                    'new_cart' => '',
                    'vehicle_maker_id_and_cat_id_pair' => '',
                    'maker_id_array' => '',
                    // 'model_id' => '',
                    // 'maker_id' => '',
                    'vehicle_category_id' => '',
                    'sms_randomString' => '',
                    'cart_user_id' => $user_id,
                    'order_attribute_data' => '',
                );
                // these functions clear the all session data related to cart
                $this->session->set_userdata($session_updatedata);
                $cart_update_users_data = $session_data['cart_users_data'];
                unset($cart_update_users_data['po_number']);
                unset($cart_update_users_data['po_file']);
                unset($cart_update_users_data['order_number']);
                $session_data_update = array('cart_users_data' => $cart_update_users_data);
                $this->session->set_userdata($session_data_update);
                $this->session->unset_userdata('entry_email_attempt');
                $this->session->unset_userdata('entry_sms_attempt');
                $this->session->unset_userdata('email_confirm');
                $this->session->unset_userdata('entry_email_confirm_status');
                $this->session->unset_userdata('sms_confirm');
                $this->session->unset_userdata('entry_sms_confirm_status');
                $this->session->unset_userdata('entry_users_data');
                $this->session->unset_userdata('email_randomString');
                $this->session->unset_userdata('sms_randomString');
                $this->session->unset_userdata('blocked_emails');
                $this->session->unset_userdata('blocked_phones');
                $this->session->unset_userdata('validemail');
                $this->session->unset_userdata('validphone');
                $this->session->unset_userdata('quotation_id');
                $this->clear_user_session("no");
                redirect("products");
            }
        }
    }

    /**
     * Method paypal_redirect
     * This Function generate form url of the  paypal.
     * @return void
     */
    public function paypal_return()
    {        
        // echo '<pre>';print_r($_GET);exit;
        $return_pid = $this->input->get("pid");
        $PayerID = $this->input->get("paymentID");
        $cart_users_data = $this->session->userdata('cart_users_data');
        if($this->session->userdata("payment_unique_code") == $return_pid){
            //here is success msg for checkout
            $invoice_num_unique = $this->unique_code();
            $final_price_data = $this->session->userdata('final_price_data');
            
            // This function update information in the database

            $cart_users_data['amount'] = $final_price_data['total'];
            $cart_users_data['currency'] =  $final_price_data['currency'];

            $payments = array();
            $payments['payment_type'] = $cart_users_data['payment_type'];
            $payments['payment_created'] = date('Y-m-d H:i:s');
            $payments['transaction_id'] = $PayerID;
            $payments['payment_method'] = '4';
            $payments['status'] = '1';

            $payments['amount'] = $final_price_data['total'];
            $payments['currency'] = $final_price_data['currency'];
            $payments['invoice_number'] = $invoice_num_unique;
            $payments['card_number'] = 'Paypal';
            $user_id = getFrontenduserId();

            if ($user_id) {
                $payments['user_id'] = $user_id;
            }

            $this->session->set_userdata(array('payments' => $payments));

            // This Function update information in the database and session after payment success
            $this->cartProductFinalzeAfterPayment($payments, $cart_users_data);
            //////////////////////////////////////////
            $this->session->unset_userdata('payment_unique_code');
            redirect("cart/invoice");

        }else{            
            redirect('/payment');
        }
    }

    public function paypal_cancel()
    {
        redirect('/payment');
    }
}

