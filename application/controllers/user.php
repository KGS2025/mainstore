<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * User Controller
 *
 *
 * User Class handle all methods  related to user login, register, forgot password, apply for credit term and all other user related activities.
 *
 * @author      Kondarsoft Dev Team
 * @link        https://kondarsoft.com/
 * @filesource
 */
class User extends MY_Controller
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
        $this->load->model(array('comman_model', 'user_model', 'cart_model', 'product_model'));
        $this->load->helper(array('assets', 'file', 'common', 'cart'));
    }

    /**
     * Method signup
     *  This Function Display the Singup page for front end user.
     * @return void
     */
    public function signup()
    {
        if (getFrontenduserId()) {
            redirect('index');
        }

        $cart = $this->session->userdata('cart');

        $all_data = allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country'));
        $all_navigation_data = $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country');

        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'product_instruction', 'cart_timer'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('sign_up'),
            'pageType' => 'signup', // variable for the scripts and css on header and footer
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'timestamp' => date_timestamp_get(date_create()),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'all_data' => $all_data,
            'all_navigation_data' => $all_navigation_data,
            'general_instruction' => (object) $userLangData['general_instruction'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'product_instruction' => (object) $userLangData['product_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'cart_timer' => (object) $userLangData['cart_timer'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'billing_info_check' => $all_data['shipping_section_status'],
            'cartcount' => getcartcount($cart),
            'ip_data' => getUserIpData(),

        );

        $footerData = array(
            'all_data' => $pageData['all_data'],
            'all_navigation_data' => $pageData['all_navigation_data'],
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
        );
        // view files required to generate cart page of the estore.
        $this->load->view('common/header', $pageData);
        $this->load->view('master/user/signup_form', $pageData);
        $this->load->view('common/footer', $footerData);
    }

    /**
     * Method checkEmailExists
     * This Function checked that is email  exist in the admin_users or not.
     * @param $id $id [This parameter is the user id.]
     * @return void
     */
    public function checkEmailExists($id = '')
    {
        // this is email  which is passes using post parameter
        $email = $this->security->xss_clean($this->input->post('email'));
        if ($email && $id) {
            $result = $this->comman_model->get_data_by_id('users', array('id' => $id));
            if ($email == $result['email']) {
                // if not  exist than this code return true
                echo json_encode(true);
            } else {
                // this function check is email  exist in the table  or not.
                $exists = $this->comman_model->check_row_exists('users', array('email' => $email));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(false);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(true);
                }
            }
        } else if ($email) {
            // this function check is email  exist in the table  or not.
            $exists = $this->comman_model->check_row_exists('users', array('email' => $email));
            if ($exists) {
                // if exist than this code return false
                echo json_encode(false);
            } else {
                // if not  exist than this code return true
                echo json_encode(true);
            }
        }
    }

    /**
     * Method checkPhoneExists
     * This Function checked that is phone  exist in the admin_users or not.
     * @param $id $id [This parameter is the user id.]
     * @return void
     */
    public function checkPhoneExists($id = '')
    {
        $country_code = str_replace('+', '', $this->security->xss_clean($this->input->post('country_code')));
        $telephone = $this->security->xss_clean($this->input->post('telephone'));
        if ($id && $country_code && $telephone) {
            $result = $this->comman_model->get_data_by_id('users', array('id' => $id));
            if ($country_code == $result['country_code'] && $telephone == $result['telephone']) {
                echo json_encode(true);
            } else {
                // this function check is phone exist in the table with same phone or not.
                $exists = $this->comman_model->check_row_exists('users', array('country_code' => $country_code, 'telephone' => $telephone));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(false);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(true);
                }
            }
        } else if ($country_code && $telephone) {
            // this function check is phone exist in the table with same phone or not.
            $exists = $this->comman_model->check_row_exists('users', array('country_code' => $country_code, 'telephone' => $telephone));
            if ($exists) {
                // if exist than this code return false
                echo json_encode(false);
            } else {
                // if not  exist than this code return true
                echo json_encode(true);
            }
        }
    }

    /**
     * Method checkPoExists
     * This Function checked that is po number  exist in the cart_users or not.
     * @param $id $id [This parameter is the user id.]
     * @return void
     */
    public function checkPoExists()
    {
        $po_number = $this->security->xss_clean($this->input->post('po_number'));
        $user_id = $this->security->xss_clean($this->input->post('user_id'));
        if ($po_number && $user_id) {

            // this function check is phone exist in the table with same phone or not.
            $exists = $this->comman_model->check_row_exists('cart_users', array('user_id' => $user_id, 'po_number' => $po_number));
            if ($exists) {
                // if exist than this code return false
                echo json_encode(false);
            } else {
                // if not  exist than this code return true
                echo json_encode(true);
            }
        }
    }

    public function login()
    {
        if (getFrontenduserId()) {
            redirect('index');
        }
        $cart = $this->session->userdata('cart');
        $cart = cartCleanUp($cart);
        $this->session->set_userdata('cart', $cart);
        $this->session->set_userdata('new_cart', $cart);

        $all_data = allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country'));
        $all_navigation_data = $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country');

        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'product_instruction', 'cart_timer', 'entry_door_timer'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('login'),
            'pageType' => 'signup', // variable for the scripts and css on header and footer
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'timestamp' => date_timestamp_get(date_create()),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'all_data' => $all_data,
            'all_navigation_data' => $all_navigation_data,
            'general_instruction' => (object) $userLangData['general_instruction'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'product_instruction' => (object) $userLangData['product_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'cart_timer' => (object) $userLangData['cart_timer'],
            'entry_door_timer' => (object) $userLangData['entry_door_timer'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'billing_info_check' => $all_data['shipping_section_status'],
            'cartcount' => getcartcount($cart),
        );

        $footerData = array(
            'all_data' => $pageData['all_data'],
            'all_navigation_data' => $pageData['all_navigation_data'],
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
        );

        // view files required to generate cart page of the estore.
        $this->load->view('common/header', $pageData);
        $this->load->view('master/user/login', $pageData);
        $this->load->view('common/footer', $footerData);
    }

    public function forgotpassword()
    {
        if (getFrontenduserId()) {
            redirect('index');
        }

        $cart = $this->session->userdata('cart');

        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('forgot_password'),
            'pageType' => 'signup',
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'credit_door',
            'timestamp' => date_timestamp_get(date_create()),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'all_navigation_data' => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'entry_door_timer' => (object) $userLangData['entry_door_timer'],
            'general_instruction' => (object) $userLangData['general_instruction'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'cartcount' => getcartcount($cart),
        );

        $footerData = array(
            'all_data' => $pageData['all_data'],
            'all_navigation_data' => $pageData['all_navigation_data'],
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
        );

        // view files required to generate cart page of the estore.
        $this->load->view('common/header', $pageData);
        $this->load->view('master/user/forgot_password', $pageData);
        $this->load->view('common/footer', $footerData);
    }

    public function setpassword($access_token = '', $action = '')
    {

        if (getFrontenduserId()) {
            redirect('index');
        }

        if ($access_token) {

            $user_status = ($action == 'reset') ? 1 : 0;

	    $userData = $this->comman_model->get_data_by_id('users', array('access_token' => $access_token, 'user_status' => $user_status));
            if (count($userData) > 0) {
                $cart = $this->session->userdata('cart');

                $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer'), $this->lang->default_lang_id);

                // initialize data as Array to assign all required values for view files.
                $pageData = array(
                    'title' => get_page_title('set_password'),
                    'pageType' => 'signup',
                    'lang_id' => $this->lang->default_lang,
                    'lang_num' => $this->lang->default_lang_id,
                    'active' => 'credit_door',
                    'timestamp' => date_timestamp_get(date_create()),
                    'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
                    'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
                    'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
                    'all_navigation_data' => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
                    'entry_door_timer' => (object) $userLangData['entry_door_timer'],
                    'general_instruction' => (object) $userLangData['general_instruction'],
                    'selection_instruction' => (object) $userLangData['selection_instruction'],
                    'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
                    'cart_instruction' => (object) $userLangData['cart_instruction'],
                    'admin_static_links' => $userLangData['admin_static_links'],
                    'cartcount' => getcartcount($cart),
                    'access_token' => $access_token,
                    'action' => $action,
                );

                $footerData = array(
                    'all_data' => $pageData['all_data'],
                    'all_navigation_data' => $pageData['all_navigation_data'],
                    'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
                );
                // view files required to generate cart page of the estore.
                $this->load->view('common/header', $pageData);
                $this->load->view('master/user/set_password', $pageData);
                $this->load->view('common/footer', $footerData);
            } else {
                redirect(site_url());
            }
        } else {
            redirect(site_url());
        }
    }

    public function add_password()
    {
        $postData = $this->security->xss_clean($this->input->post());
        if (count($postData) > 0) {

            $user_status = 0;
            if (isset($postData['action']) && $postData['action'] == 'reset') {
                $user_status = 1;
            }

            $userData = $this->comman_model->get_data_by_id('users', array('access_token' => $postData['token'], 'user_status' => $user_status));
            if (count($userData) > 0) {
                if ($userData['otp_code'] == $postData['otp_code']) {
                    $updateData = array(
                        'password' => sha1($postData['password']),
                        'user_status' => 1,
                        'otp_code' => 0,
                        'otp_code_attempt' => 0,
                        'dateUpdated' => date('Y-m-d H:i:s'),
                    );
                    $updateData = $this->security->xss_clean($updateData);
                    $this->comman_model->update_data_by_id('users', $updateData, 'id', $userData['id']);

                    $updateData = array('user_id' => $userData['id']);
                    $dbCondition = array('email' => $userData['email'], 'telephone' => $userData['telephone'], 'country_code' => $userData['country_code'], 'user_id IS NULL' => null);
                    $this->comman_model->update_column('cart_users', $dbCondition, $updateData);

                    $response = array('result' => 'success');
                } else {
                    $response = array('result' => 'incorrect_otp_code');
                }
            } else {
                $response = array('result' => 'user_not_exist');
            }
        } else {
            $response = array('result' => 'form_data_required');
        }
        echo json_encode($response);
    }

    public function send_otp_code()
    {
        $postData = $this->security->xss_clean($this->input->post());
        if (count($postData) > 0) {
            $user_status = 0;
            if (isset($postData['action']) && $postData['action'] == 'reset') {
                $user_status = 1;
            }
            $userData = $this->comman_model->get_data_by_id('users', array('access_token' => $postData['token'], 'user_status' => $user_status));
            if (count($userData) > 0) {
                $otp_code_attempt = $userData['otp_code_attempt'] + 1;
                $entry_door_timer = (object) get_user_lang_data(array('entry_door_timer'), $this->lang->default_lang_id)['entry_door_timer'];
                $resend_otp_attempt = $entry_door_timer->resend_otp_attempt ? $entry_door_timer->resend_otp_attempt : 10;
                if ($otp_code_attempt <= $resend_otp_attempt) {
                    if (ENVIRONMENT == "production") {
                        $sms_randomString = substr(str_shuffle("0123456789"), 0, 6);
                        $phone_sent = $userData['country_code'] . $userData['telephone'];
                        sentSmsCode($sms_randomString, $phone_sent, $userData['country_code'], 'password_page_otp_text');
                    } else {
                        $sms_randomString = getenv('TEST_SMS_CODE');
                    }

                    $updateData = array(
                        'otp_code' => $sms_randomString,
                        'otp_code_attempt' => $otp_code_attempt,
                        'dateUpdated' => date('Y-m-d H:i:s'),
                    );
                    $updateData = $this->security->xss_clean($updateData);
                    $this->comman_model->update_data_by_id('users', $updateData, 'id', $userData['id']);

                    $resend = $userData['otp_code_attempt'] > 0 ? true : false;

                    $response = array('result' => 'success', 'mobile_number' => $userData['country_code'] . $userData['telephone'], 'resend' => $resend);
                } else {
                    $updateData = array(
                        'user_status' => 2,
                        'dateUpdated' => date('Y-m-d H:i:s'),
                    );
                    $updateData = $this->security->xss_clean($updateData);
                    $this->comman_model->update_data_by_id('users', $updateData, 'id', $userData['id']);
                    $response = array('result' => 'maximum_attempt');
                }
            } else {
                $response = array('result' => 'user_not_exist');
            }
        } else {
            $response = array('result' => 'form_data_required');
        }
        echo json_encode($response);
    }

    public function check_user_login($param = '')
    {
        $postData = $this->security->xss_clean($this->input->post());
        if (count($postData) > 0) {
            $userData = $this->comman_model->get_data_by_id('users', array('email' => $postData['email']));
            if (count($userData) > 0) {
                if ($userData['user_status'] == 2) {
                    $response = array('result' => 'user_blocked');
                } else if ($userData['user_status'] == 0) {
                    $response = array('result' => 'password_not_set');
                } else if ($userData['user_status'] == 1 && $userData['password'] == sha1($postData['password']) && (empty($postData['otp_code']) || $postData['resend'] == 1)) {
                    $otp_code_attempt = $userData['otp_code_attempt'] + 1;
                    $entry_door_timer = (object) get_user_lang_data(array('entry_door_timer'), $this->lang->default_lang_id)['entry_door_timer'];
                    $resend_otp_attempt = $entry_door_timer->resend_otp_attempt ? $entry_door_timer->resend_otp_attempt : 10;
                    if ($otp_code_attempt <= $resend_otp_attempt) {
                        if (ENVIRONMENT == "production") {
                            $sms_randomString = substr(str_shuffle("0123456789"), 0, 6);
                            $phone_sent = $userData['country_code'] . $userData['telephone'];

                            sentSmsCode($sms_randomString, $phone_sent, $userData['country_code'], 'password_page_otp_text');
                        } else {
                            $sms_randomString = getenv('TEST_SMS_CODE');
                        }

                        $updateData = array(
                            'otp_code' => $sms_randomString,
                            'otp_code_attempt' => $otp_code_attempt,
                            'dateUpdated' => date('Y-m-d H:i:s'),
                        );
                        $updateData = $this->security->xss_clean($updateData);
                        $this->comman_model->update_data_by_id('users', $updateData, 'id', $userData['id']);

                        $resend = $userData['otp_code_attempt'] > 0 ? true : false;

                        $response = array('result' => 'otp_code_sent', 'mobile_number' => $userData['country_code'] . $userData['telephone'], 'resend' => $resend);
                    } else {
                        $updateData = array(
                            'user_status' => 2,
                            'dateUpdated' => date('Y-m-d H:i:s'),
                        );
                        $updateData = $this->security->xss_clean($updateData);
                        $this->comman_model->update_data_by_id('users', $updateData, 'id', $userData['id']);
                        $response = array('result' => 'maximum_attempt');
                    }
                } else if ($userData['user_status'] == 1 && $userData['password'] == sha1($postData['password']) && !empty($postData['otp_code']) && $param == '') {
                    if ($userData['otp_code'] == $postData['otp_code']) {
                        $updateData = array(
                            'otp_code' => 0,
                            'otp_code_attempt' => 0,
                            'dateUpdated' => date('Y-m-d H:i:s'),
                        );
                        $updateData = $this->security->xss_clean($updateData);
                        $this->comman_model->update_data_by_id('users', $updateData, 'id', $userData['id']);
                        $response = array('result' => 'success');
                    } else {
                        $response = array('result' => 'incorrect_otp_code');
                    }
                } else if ($userData['user_status'] == 1 && $userData['password'] == sha1($postData['password']) && !empty($postData['otp_code']) && $param) {

                    $user_session_data = array(
                        'applicant' => $userData['salutation'] . ' ' . $userData['surname'],
                        'country' => $userData['country'],
                        'country_code' => $userData['country_code'],
                        'telephone' => $userData['telephone'],
                        'email' => $userData['email'],
                        'ip_address' => $_SERVER['REMOTE_ADDR'],
                        'created_time' => time(),
                    );
                    $checkData = $this->comman_model->get_data_by_id('entry_door_front_shopping_data', array('email' => $postData['email']));
                    if (count($checkData) > 0) {
                        $this->comman_model->update_data_by_id("entry_door_front_shopping_data", array("created_time" => time()), "id", $checkData['id']);
                    } else {
                        $this->comman_model->insert_column("entry_door_front_shopping_data", $user_session_data);
                    }

                    $user_session_data['created_time'] = time();
                    $user_session_data['remaining_time'] = time();
                    $this->session->set_userdata(array('front_validuser_data' => $user_session_data));
                    $this->session->set_userdata('logged_user_id', $userData['id']);

                    $loginuserdata = loginuserdata();
                    $session_data = array('cart_users_data' => $loginuserdata);
                    $this->session->set_userdata($session_data);   

                    //staring of price request product
                    if($this->session->userdata('price_request_product')!==null){
                        if(count($this->session->userdata('price_request_product')[0])>0){                            
                            redirect('user/addpricerequest');
                        }
                    }
                    //end of price request product
                    
                    redirect('user/dashboard');
                } else {
                    $response = array('result' => 'incorrect_login');
                }
            } else {
                $response = array('result' => 'login_user_not_exist');
            }
        } else {
            $response = array('result' => 'form_data_required');
        }
        echo json_encode($response);
    }

    public function check_user_exist()
    {
        $postData = $this->security->xss_clean($this->input->post());
        if (count($postData) > 0) {
            $userData = $this->comman_model->get_data_by_id('users', array('email' => $postData['email']));
            if (count($userData) > 0) {
                if ($userData['user_status'] == 2) {
                    $response = array('result' => 'user_blocked');
                } else if ($userData['user_status'] == 0) {
                    $response = array('result' => 'password_not_set');
                } else if ($userData['user_status'] == 1) {

                    // This Function load email library
                    $this->load->library('Email');

                    // This Function load email configuration from config file and intialize the library
                    $config = $this->config->item('emailconfig');
                    $this->email->initialize($config);

                    // This Function get email body content subject and from address  from the table email_instruction these values are manageable from the admin side
                    $email_instruction = (object) get_user_lang_data(array('email_instruction'), $this->lang->default_lang_id)['email_instruction'];

                    // set variable for  email function
                    $fromeMailId = $this->config->item('fromemailaddress');
                    $fromName = $email_instruction->admin_cart_mail_fromname;
                    $toEmailId = $userData['email'];
                    $toName = $userData['surname'];
                    $signature = $email_instruction->admin_cart_mail_fromname;
                    $subject = $email_instruction->reset_pwd_mail_subject;

                    // Replace variable in the email and subject content
                    $activation_link = base_url() . $this->lang->default_lang . '/user/setpassword/' . $userData['access_token'] . '/reset';
                    $msg = htmlspecialchars_decode($email_instruction->reset_pwd_mail);
                    $msg = str_replace('{name_details}', $userData['surname'], $msg);
                    $msg = str_replace('{activation_link}', $activation_link, $msg);
                    $msg = str_replace('{signature}', $signature, $msg);

                    // check if language is not an english, then will fetch sender name for english becoz send grid not support or not validated other language sender name
                    if ($this->lang->default_lang_id != 13) {
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
		
		    $this->send_otp_code_forgotpassword($userData);
                    $response = array('result' => 'success');
                }
            } else {
                $response = array('result' => 'login_user_not_exist');
            }
        } else {
            $response = array('result' => 'form_data_required');
        }
        echo json_encode($response);
    }

    public function dashboard()
    {
        if (empty(getFrontenduserId())) {
            redirect('index');
        }

        $cart = $this->session->userdata('cart');
        $user_id = getFrontenduserId();
        $loginuserdata = loginuserdata();
        $loginuserterm = loginuserterm();

        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer', 'page_title'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('user_dashboard'),
            'pageType' => 'entry_door',
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'credit_door',
            'timestamp' => date_timestamp_get(date_create()),
            'front_validuser_data' => $this->session->userdata('front_validuser_data'),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'all_navigation_data' => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'entry_door_timer' => (object) $userLangData['entry_door_timer'],
            'general_instruction' => (object) $userLangData['general_instruction'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'user_id' => $user_id,
            'loginuserdata' => $loginuserdata,
            'loginuserterm' => $loginuserterm,
            'cartcount' => getcartcount($cart),
            'all_titles' => (object) $userLangData['page_title'],
        );

        $footerData = array(
            'all_data' => $pageData['all_data'],
            'all_navigation_data' => $pageData['all_navigation_data'],
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
        );

        // view files required to generate cart page of the estore.
        $this->load->view('common/header', $pageData);
        $this->load->view('master/user/dashboard', $pageData);
        $this->load->view('common/footer', $footerData);
    }

    public function profile()
    {
        if (empty(getFrontenduserId())) {
            redirect('index');
        }

        $cart = $this->session->userdata('cart');
        $user_id = getFrontenduserId();
        $loginuserdata = loginuserdata();
        $loginuserterm = loginuserterm();

        $userLangData = get_user_lang_data(array('product_instruction', 'general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer', 'page_title'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('user_profiile'),
            'pageType' => 'profile',
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'credit_door',
            'timestamp' => date_timestamp_get(date_create()),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'all_navigation_data' => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'entry_door_timer' => (object) $userLangData['entry_door_timer'],
            'general_instruction' => (object) $userLangData['general_instruction'],
            'product_instruction' => (object) $userLangData['product_instruction'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'cartcount' => getcartcount($cart),
            'all_titles' => (object) $userLangData['page_title'],
            'user_id' => $user_id,
            'loginuserdata' => $loginuserdata,
            'loginuserterm' => $loginuserterm,
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),

        );

        // view files required to generate cart page of the estore.
        $this->load->view('common/header', $pageData);
        $this->load->view('master/user/edit_profile', $pageData);
        $this->load->view('common/footer', $pageData);
    }

    public function crediterm()
    {
        if (empty(getFrontenduserId())) {
            redirect('index');
        }

        $cart = $this->session->userdata('cart');
        $user_id = getFrontenduserId();
        $loginuserdata = loginuserdata();

        $loginuserterm = loginuserterm();

        $term_last_request = $this->comman_model->row_by_id_order(array('user_id' => $user_id));

        $userLangData = get_user_lang_data(array('product_instruction', 'api_instruction', 'general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer', 'page_title'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('credit_term_profile'),
            'pageType' => 'credit_term',
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'credit_door',
            'timestamp' => date_timestamp_get(date_create()),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'all_navigation_data' => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'entry_door_timer' => (object) $userLangData['entry_door_timer'],
            'general_instruction' => (object) $userLangData['general_instruction'],
            'product_instruction' => (object) $userLangData['product_instruction'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'api_instruction' => (object) $userLangData['api_instruction'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'cartcount' => getcartcount($cart),
            'all_titles' => (object) $userLangData['page_title'],
            'user_id' => $user_id,
            'loginuserdata' => $loginuserdata,
            'loginuserterm' => $loginuserterm,
            'term_last_request' => $term_last_request,
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),

        );

        // view files required to generate cart page of the estore.
        $this->load->view('common/header', $pageData);
        $this->load->view('master/user/credit_term', $pageData);
        $this->load->view('common/footer', $pageData);
    }

    public function save_creditterm_data()
    {

        $userLangData = get_user_lang_data(array('product_instruction', 'general_instruction'), $this->lang->default_lang_id);

        $user_id = getFrontenduserId();

        $loginuserdata = loginuserdata();
        $loginuserterm = loginuserterm();

        // This Function get list of  all forms validation messages from table form_validation_instruction. All these messages are manageable form the admin side.
        $form_validation_instruction = (object) get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];

        // Read  inputs and sanitize their values and saved in a seprate variable
        $credit_term_file = '';
        // This Code runs only  when user choose the tax exoneration file on the cart form.
        if (isset($_FILES['credit_term_file']) && !empty($_FILES['credit_term_file']['name'])) {
            // These are configuration variables  for  tax exoneration file
            $config2['upload_path'] = './assets/uploads/cart';
            $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config2['max_size'] = '2048';
            $config2['file_name'] = getRandomFileName($_FILES['credit_term_file']['name'], 'credit_term_file');
            // This function initialize the upload library
            $this->load->library('upload', $config2);
            $this->upload->initialize($config2);
            if (!$this->upload->do_upload('credit_term_file')) {
                $error_lang = isset($form_validation_instruction->credit_term_file) ? $form_validation_instruction->credit_term_file : ' File should be Max 2 MB and either: jpg, png, jpeg, gif or pdf';
                $message = array('message' => $error_lang, 'type' => 'error');
                // This function save error message in the flash variable to display on cart page
                $this->session->set_flashdata('flash_message', $message);
                redirect('user/crediterm');
                exit;
            } else {
                $upload_data = $this->upload->data();
                // save upload file name in variable to update in the database
                $credit_term_file = $upload_data['file_name'];
            }
        }

        // set tax exoneration file  variable according to the condition to update in the database
        if ($credit_term_file == '') {
            $error_lang = isset($form_validation_instruction->credit_term_file) ? $form_validation_instruction->credit_term_file : 'File should be Max 2 MB and either: jpg, png, jpeg, gif or pdf';
            $message = array('message' => $error_lang, 'type' => 'error');
            // This function save error message in the flash variable to display on cart page
            $this->session->set_flashdata('flash_message', $message);
            redirect('user/crediterm');
            exit;
        }

        $credit_term_request = array();
        $credit_term_request['user_id'] = $user_id;
        $credit_term_request['status'] = "0";
        $credit_term_request['request_file'] = $credit_term_file;
        $credit_term_request['request_date'] = date('Y-m-d');

        if ($this->comman_model->add('credit_term_requests', $credit_term_request)) {
            $this->send_term_email("customer", $credit_term_request);
            $this->send_term_email("admin", $credit_term_request);
        }

        // if user click on the continue button than this function redirect user to product page
        $general_instruction = (object) $userLangData['general_instruction'];
        $messsge = array('message' => $general_instruction->profile_upadted, 'type' => 'success');
        $this->session->set_flashdata('flash_message', $messsge);
        redirect('user/crediterm');
    }

    public function addpricerequest()
    {
        if (empty(getFrontenduserId())) {
            redirect('index');
        }

        $price_request_product = $this->session->userdata('price_request_product');

        if (empty($price_request_product)) {
            redirect('user/pricerequests');
        }
        $cart = $this->session->userdata('cart');
        $user_id = getFrontenduserId();
        $loginuserdata = loginuserdata();
        $loginuserterm = loginuserterm();

        $userLangData = get_user_lang_data(array('product_instruction', 'general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer', 'page_title'), $this->lang->default_lang_id);
        $all_language_data = get_admin_lang_data(array('admin_order_details'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('user_pricerequests'),
            'pageType' => 'profile',
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'credit_door',
            'timestamp' => date_timestamp_get(date_create()),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'all_navigation_data' => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'entry_door_timer' => (object) $userLangData['entry_door_timer'],
            'general_instruction' => (object) $userLangData['general_instruction'],
            'product_instruction' => (object) $userLangData['product_instruction'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'all_titles' => (object) $userLangData['page_title'],
            'price_request_products' => $this->product_model->pricerequest_session_data(),
            'user_id' => $user_id,
            'admin_order_details' => $all_language_data['admin_order_details'],
            'loginuserdata' => $loginuserdata,
            'loginuserterm' => $loginuserterm,
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),

        );

        // view files required to generate cart page of the estore.
        $this->load->view('common/header', $pageData);
        $this->load->view('master/user/pricerequest/add_price_request', $pageData);
        $this->load->view('common/footer', $pageData);
    }
    public function pricerequests()
    {
        if (empty(getFrontenduserId())) {
            redirect('index');
        }

        $user_id = getFrontenduserId();
        $loginuserterm = loginuserterm();
        $cart = $this->session->userdata('cart');
        $key = $this->security->xss_clean($this->input->post('search'));
        $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $config['base_url'] = base_url() . "/" . $this->lang->default_lang . "/user/pricerequests/";
        $config['total_rows'] = $this->cart_model->get_pricerequest_details('count', '', '', '', $user_id, "yes");
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['num_links'] = 4;
        $config['first_link'] = '<<';
        $config['last_link'] = '>>';
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['num_tag_open'] = '<span class="number">';
        $config['num_tag_close'] = '</span>';
        $config['cur_tag_open'] = '<span class="current"><a href="#">';
        $config['cur_tag_close'] = '</a></span>';
        $this->pagination->initialize($config);
        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer', 'sales_order_preview', 'payment_instructions', 'page_title'), $this->lang->default_lang_id);
        $all_language_data = get_admin_lang_data(array('admin_order_details'), $this->lang->default_lang_id);
        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('user_pricerequests'),
            'pageType' => 'entry_door',
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'credit_door',
            'timestamp' => date_timestamp_get(date_create()),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'all_orders' => $this->cart_model->get_pricerequest_details('all', '', $config['per_page'], $offset, $user_id, "1"),
            'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'links' => $this->pagination->create_links(),
            'offset' => $offset,
            'search' => $key,
            'all_navigation_data' => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'search' => $key,
            'entry_door_timer' => (object) $userLangData['entry_door_timer'],
            'general_instruction' => (object) $userLangData['general_instruction'],
            'payment_instructions' => (object) $userLangData['payment_instructions'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'sales_order_preview' => (object) $userLangData['sales_order_preview'],
            'cartcount' => getcartcount($cart),
            'loginuserterm' => $loginuserterm,
            'admin_order_details' => $all_language_data['admin_order_details'],
            'all_titles' => (object) $userLangData['page_title'],
        );

        $footerData = array(
            'all_data' => $pageData['all_data'],
            'all_navigation_data' => $pageData['all_navigation_data'],
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
        );
        // view files required to generate cart page of the estore.
        $this->load->view('common/header', $pageData);
        $this->load->view('master/user/pricerequest/price_request_list', $pageData);
        $this->load->view('common/footer', $footerData);
    }
    public function viewrequest($id = false)
    {

        if (empty(getFrontenduserId())) {
            redirect('index');
        }

        $cart = $this->session->userdata('cart');
        $user_id = getFrontenduserId();
        $loginuserterm = loginuserterm();
        $userLangData = get_user_lang_data(array('product_instruction', 'general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer', 'page_title', 'sales_order_preview'), $this->lang->default_lang_id);
        $all_language_data = get_admin_lang_data(array('admin_order_details'), $this->lang->default_lang_id);

        $all_messages = $this->comman_model->get_all_data_by_id('price_request_messages', array("request_id" => $id));

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('user_pricerequests_detail'),
            'pageType' => 'entry_door',
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'all_messages' => $all_messages,
            'active' => 'credit_door',
            'timestamp' => date_timestamp_get(date_create()),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'all_navigation_data' => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'entry_door_timer' => (object) $userLangData['entry_door_timer'],
            'general_instruction' => (object) $userLangData['general_instruction'],
            'sales_order_preview' => (object) $userLangData['sales_order_preview'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'product_instruction' => (object) $userLangData['product_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'cartcount' => getcartcount($cart),
            'loginuserterm' => $loginuserterm,
            'main_data' => $this->cart_model->get_pricerequest_details('single', $id, "", "", $user_id),
            'all_titles' => (object) $userLangData['page_title'],
            'admin_order_details' => $all_language_data['admin_order_details'],
        );

        $footerData = array(
            'all_data' => $pageData['all_data'],
            'all_navigation_data' => $pageData['all_navigation_data'],
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
        );
        // view files required to generate cart page of the estore.
        $this->load->view('common/header', $pageData);
        $this->load->view('master/user/pricerequest/price_request_details', $pageData);
        $this->load->view('common/footer', $footerData);
    }

    public function save_price_request()
    {

        $userLangData = get_user_lang_data(array('product_instruction', 'general_instruction'), $this->lang->default_lang_id);

        $user_id = getFrontenduserId();
        $loginuserdata = loginuserdata();
        $loginuserterm = loginuserterm();

        $price_request_product = $this->session->userdata('price_request_product');

        if (!empty($price_request_product)) {
            $price_requests_data = array();
            $price_requests_data['user_id'] = $user_id;
            $price_requests_data['products'] = implode(",", $price_request_product);
            $expire_data = date('Y-m-d', strtotime(date('Y-m-d') . ' + '.$this->config->item('price_request_expire_days').' days'));
            $price_requests_data['expire_date'] = $expire_data;
            $price_requests_data['status'] = "0";
            $request_id = $this->comman_model->add('price_requests', $price_requests_data);
            if ($request_id) {
                $this->session->unset_userdata('price_request_product');

                if (trim($this->input->post('pricerequest_message'))) {
                    $price_requests_message['request_id'] = $request_id;
                    $price_requests_message['user_id'] = $user_id;
                    $price_requests_message['user_type'] = 'user';
                    $price_requests_message['message'] = $this->input->post('pricerequest_message');
                    $this->comman_model->add('price_request_messages', $price_requests_message);
                }
                $general_instruction = (object) $userLangData['general_instruction'];
                $messsge = array('message' => $general_instruction->request_added_success, 'type' => 'success');
                $this->session->set_flashdata('flash_message', $messsge);
                redirect('user/pricerequests');
            } else {
                $general_instruction = (object) $userLangData['general_instruction'];
                $messsge = array('message' => $general_instruction->request_added_error, 'type' => 'error');
                $this->session->set_flashdata('flash_message', $messsge);
                redirect('user/addpricerequest');

            }
        } else {

            $general_instruction = (object) $userLangData['general_instruction'];
            $messsge = array('message' => $general_instruction->request_added_error, 'type' => 'error');
            $this->session->set_flashdata('flash_message', $messsge);
            redirect('user/addpricerequest');

        }

        // if user click on the continue button than this function redirect user to product page

    }



    public function update_price_request()
    {
        $userLangData = get_user_lang_data(array('product_instruction', 'general_instruction'), $this->lang->default_lang_id);

        $user_id = getFrontenduserId();
        $loginuserdata = loginuserdata();
        $loginuserterm = loginuserterm();


        if ($this->input->post('approved_products')) {
            $existing = $this->input->post('approved_products');
        } else {
            $existing = array();
        }

        if ($this->input->post('new_requested')) {
            $new_requested = $this->input->post('new_requested');
        } else {
            $new_requested = array();
        }
        $approved_products = array_unique(array_merge($existing, $new_requested));
        $approved_products_string = implode(",", $approved_products);
        $expire_date = date('Y-m-d', strtotime(date('Y-m-d') . ' + '.$this->config->item('price_request_expire_days').' days'));
         $id = $this->security->xss_clean($this->input->post('request_id'));
        $post_data = array('expire_date' =>$expire_date,'status' =>"0","products"=>$approved_products_string);
        $table_name = "price_requests";
        if($this->comman_model->update_data_by_id($table_name, $post_data, 'id', $id)) {
            $general_instruction = (object) $userLangData['general_instruction'];
            $messsge = array('message' => $general_instruction->request_updated_success, 'type' => 'success');
            $this->session->set_flashdata('flash_message', $messsge);
            redirect('user/pricerequests');

        } else {

        $general_instruction = (object) $userLangData['general_instruction'];
            $messsge = array('message' => $general_instruction->request_updated_error, 'type' => 'error');
            $this->session->set_flashdata('flash_message', $messsge);
            redirect('user/pricerequests');

        }

    }

    public function price_request_messages()
    {

        $request_number = $this->input->post('request_id');
        $request_message = $this->input->post('pricerequest_message');
        $user_id = getFrontenduserId();

        if (!empty($request_number)) {
            $price_requests_data = array();
            $price_requests_data['user_id'] = $user_id;
            $price_requests_data['request_id'] = $request_number;
            $price_requests_data['user_type'] = "user";
            $price_requests_data['message'] = $request_message;

            if ($this->comman_model->add('price_request_messages', $price_requests_data)) {

                $result['status'] = 1;
                echo json_encode($result);
                exit;
            }
        } else {

            $result['status'] = 0;
            echo json_encode($result);
            exit;

        }
    }

    public function load_price_request_messages()
    {

        $request_number = $this->input->post('request_id');
        $user_id = getFrontenduserId();

        if (!empty($request_number)) {
            $all_messages = $this->comman_model->get_all_data_by_id('price_request_messages', array("request_id" => $request_number));

            if ($all_messages) {
                $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'product_instruction', 'admin_static_links', 'cart_timer'), $this->lang->default_lang_id);
                // this function load product types from database using offset
                $pageData['product_list'] = $this->product_model->product_list_home($this->lang->default_lang_id, $offset, $sort);
                $pageData['selection_instruction'] = (object) $userLangData['selection_instruction'];
                $pageData['general_instruction'] = (object) $userLangData['general_instruction'];
                $pageData['product_instruction'] = (object) $userLangData['product_instruction'];
                $pageData['all_messages'] = $all_messages;

                // this is view file for product types
                $html = $this->load->view('product/get_request_message', $pageData, true);

                $result['status'] = 1;
                $result['htmlbody'] = $html;

            }
        } else {

            $result['status'] = 0;
            $result['message'] = 1;

        }
        echo json_encode($result);
        exit;
    }
    /**
     * send_term_email
     * This Function Send Credit term request details  email to customer with attached file  on completion of order.
     * @return void
     */
    public function send_term_email($type = 'customer', $credit_term_request)
    {

        $lang_id = $this->lang->default_lang_id;
        $userdata = loginuserdata();

        if (!empty($credit_term_request)) {
            // This Function load email library
            $this->load->library('Email');

            // This Function load email configuration from config file and intialize the library
            $config = $this->config->item('emailconfig');
            $this->email->initialize($config);

            // This Function get email body content subject and from address  from the table email_instruction these values are manageable from the admin side
            $userdata = get_user_lang_data(array('email_instruction', 'general_instruction'), $lang_id);
            $email_instruction = (object) $userdata['email_instruction'];

            $term_filepath = FCPATH . '/assets/uploads/cart/' . $credit_term_request['request_file'];

            //This is function return general instruction from which we will get dynamic kondarsoft_solution
            $general_instruction = (object) $userdata['general_instruction'];
            $kondarsoft_solutions = $general_instruction->kondarsoft_solutions;

            if ($type == 'customer') {
                // set variable for  email function
                $fromeMailId = $this->config->item('fromemailaddress');
                $fromName = $email_instruction->admin_cart_mail_fromname;
                $toEmailId = $userdata['email'];
                $toName = $userdata['company'];
                $subject = $email_instruction->applycredit_subject;
                // Replace variable in the email and subject content
                $msg = htmlspecialchars_decode($email_instruction->applycredit_content);
                $msg = str_replace('{name}', $userdata['company'], $msg);
            } else if ($type == 'admin') {
                // set variable for  email function
                $fromeMailId = $this->config->item('fromemailaddress');
                $fromName = $email_instruction->admin_cart_mail_fromname;
                $toEmailId = $email_instruction->admin_applycredit_to_list;
                $toName = $kondarsoft_solutions;
                $subject = $email_instruction->admin_applycredit_subject;
                // Replace variable in the email and subject content
                $msg = htmlspecialchars_decode($email_instruction->admin_applycredit_content);
                $msg = str_replace('{name}', $userdata['company'], $msg);
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
            // This Function attach invoice and tax exoneration file
            $this->email->attach($term_filepath);

            if ($toEmailId != "") {
                // This Functions send email and clear email configuration
                $this->email->send();
            }
            //echo $this->email->print_debugger();exit;
            $this->email->clear(true);
        }
    }

    public function save_profile_data()
    {

        $userLangData = get_user_lang_data(array('product_instruction', 'general_instruction'), $this->lang->default_lang_id);

        $user_id = getFrontenduserId();
        $loginuserdata = loginuserdata();
        $loginuserterm = loginuserterm();
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
        $client_logo = $this->security->xss_clean($this->input->post('client_logo'));
        $block_timezone = $this->security->xss_clean($this->input->post('block_timezone'));
        $ship_zip = $this->security->xss_clean($this->input->post('ship_zip'));
        $ship_city = $this->security->xss_clean($this->input->post('ship_city'));
        $surname = $this->security->xss_clean($this->input->post('surname'));

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

        // Read  inputs and sanitize their values and saved in a seprate variable

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

        $tax_exoneration_file = '';
        // This Code runs only  when user choose the tax exoneration file on the cart form.
        if (isset($_FILES['tax_exoneration_file']) && !empty($_FILES['tax_exoneration_file']['name'])) {
            // These are configuration variables  for  tax exoneration file
            $config2['upload_path'] = './assets/uploads/cart/';
            $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config2['max_size'] = '2048';
            // This function initialize the upload library
            $this->load->library('upload', $config2);
            $this->upload->initialize($config2);
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

        // set tax exoneration file  variable according to the condition to update in the database
        if ($tax_exoneration_file == '' && isset($old_cart_users_data['tax_exoneration_file']) && $old_cart_users_data['tax_exoneration_file'] != '') {
            $tax_exoneration_file = $old_cart_users_data['tax_exoneration_file'];
            if ($this->input->post('tax_file_exist') == 0) {
                $tax_exoneration_file = '';
            }
        }

        // update cart forms data in the session according to conditions.
        $shippingMethod = (int) $this->security->xss_clean($this->input->post('billingShippingoptradio'));
        if ($shippingMethod == 1) {
            // if billing information is same as per shipping details than this code works
            $cart_users_data = array(
                'billing_shipping_selection' => $this->input->post('billingShippingoptradio'),
                'surname' => $this->input->post('surname'),
                'company' => $this->input->post('company'),
                'country' => $this->input->post('country'),
                'country_code' => trim($country_code),
                'telephone' => trim($telephone),
                'email' => $this->input->post('email'),
                'incoterms' => $this->input->post('incoterms'),
                'cart_address_1' => $this->input->post('cart_address_1'),
                'cart_address_2' => $this->input->post('cart_address_2'),
                'cart_address_3' => $this->input->post('cart_address_3'),
                'cart_city' => $this->input->post('cart_city'),
                'cart_state' => $this->input->post('cart_state'),
                'cart_zip' => $this->input->post('cart_zip'),
                'edi_one' => $this->input->post('edi_one'),
                'ship_title' => $this->input->post('salutation'),
                'ship_surname' => $this->input->post('surname'),
                'ship_company' => $this->input->post('company'),
                'ship_email' => $this->input->post('email'),
                'ship_country_shortcode' => $this->input->post('cart_country_flag'),
                'ship_country' => $this->input->post('country'),
                'ship_country_code' => trim($country_code),
                'ship_telephone' => trim($telephone),
                'ship_address_1' => $this->input->post('cart_address_1'),
                'ship_address_2' => $this->input->post('cart_address_2'),
                'ship_address_3' => $this->input->post('cart_address_3'),
                'ship_city' => $this->input->post('cart_city'),
                'ship_state' => $this->input->post('cart_state'),
                'ship_zip' => $this->input->post('cart_zip'),
                'client_logo' => $client_logo,
                'tax_exoneration' => $this->input->post('tax_exoneration'),
                'tax_exoneration_number' => $this->input->post('tax_exoneration_number'),
                'tax_exoneration_file' => $tax_exoneration_file,
            );
            $cart_users_data = $this->security->xss_clean($cart_users_data);
        } else {

            // if billing information and shipping information is different than this code works
            $cart_users_data = array(
                'billing_shipping_selection' => $this->input->post('billingShippingoptradio'),
                'surname' => $this->input->post('surname'),
                'company' => $this->input->post('company'),
                'country' => $this->input->post('country'),
                'country_code' => trim($country_code),
                'telephone' => trim($telephone),
                'email' => $this->input->post('email'),
                'incoterms' => $this->input->post('incoterms'),
                'cart_address_1' => $this->input->post('cart_address_1'),
                'cart_address_2' => $this->input->post('cart_address_2'),
                'cart_address_3' => $this->input->post('cart_address_3'),
                'cart_city' => $this->input->post('cart_city'),
                'cart_state' => $this->input->post('cart_state'),
                'cart_zip' => $this->input->post('cart_zip'),
                'edi_one' => $this->input->post('edi_one'),
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
                'carrier_account_number' => $this->input->post('carrier_account_number'),
                'tax_exoneration' => $this->input->post('tax_exoneration'),
                'tax_exoneration_number' => $this->input->post('tax_exoneration_number'),
                'tax_exoneration_file' => $tax_exoneration_file,
            );
            $cart_users_data = $this->security->xss_clean($cart_users_data);
        }

        if ($this->input->post('incoterms') == "EXW") {

            $cart_users_data['carrier_name'] = $this->input->post('carrier_name');
            $cart_users_data['carrier_account_number'] = $this->input->post('carrier_account_number');
        }

        $this->db->where('id', $user_id);
        $this->db->update('users', $cart_users_data);

        // update forms data in the session
        $session_data = array('cart_users_data' => $cart_users_data);
        $loginuserterm = loginuserterm();

        if (isset($loginuserterm['credit_term_status']) && $loginuserterm['credit_term_status'] == "1") {
            $updateData = array(
                'credit_term_status' => "0",
            );
            $where_term = array("user_id" => $user_id);
            $this->comman_model->update_column("user_terms", $where_term, $updateData);
        }
        $this->session->set_userdata($session_data);

        $front_validuser_data = $this->session->userdata('front_validuser_data');
        $updateData = array(
            'applicant' => $cart_users_data['salutation'] . ' ' . $cart_users_data['surname'],
            'country' => $cart_users_data['country'],
            'country_code' => $cart_users_data['country_code'],
            'telephone' => $cart_users_data['telephone'],
            'email' => $cart_users_data['email'],
        );

        $front_validuser_data = array_merge($front_validuser_data, $updateData);
        $sessiondata = array('front_validuser_data' => $front_validuser_data);
        $this->session->set_userdata($sessiondata);

        $checkData = $this->comman_model->get_data_by_id('entry_door_front_shopping_data', array('email' => $cart_users_data['email']));
        if (count($checkData) == 0) {
            $updateData['created_time'] = $front_validuser_data['created_time'];
            $updateData['ip_address'] = $front_validuser_data['ip_address'];
            $this->comman_model->insert_column("entry_door_front_shopping_data", $updateData);
        }

        // if user click on the continue button than this function redirect user to product page
        $general_instruction = (object) $userLangData['general_instruction'];
        $messsge = array('message' => $general_instruction->profile_upadted, 'type' => 'success');
        $this->session->set_flashdata('flash_message', $messsge);
        redirect('user/profile');
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

    public function managepassword()
    {

        $cart = $this->session->userdata('cart');

        $userLangData = get_user_lang_data(array('product_instruction', 'general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer', 'page_title'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('entry_door_page'),
            'pageType' => 'entry_door',
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'credit_door',
            'timestamp' => date_timestamp_get(date_create()),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'all_navigation_data' => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'entry_door_timer' => (object) $userLangData['entry_door_timer'],
            'general_instruction' => (object) $userLangData['general_instruction'],
            'product_instruction' => (object) $userLangData['product_instruction'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'cartcount' => getcartcount($cart),
            'all_titles' => (object) $userLangData['page_title'],
            'user_id' => $user_id,
            'loginuserdata' => $loginuserdata,
            'loginuserterm' => $loginuserterm,
        );

        $footerData = array(
            'all_data' => $pageData['all_data'],
            'all_navigation_data' => $pageData['all_navigation_data'],
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
        );

        // view files required to generate cart page of the estore.
        $this->load->view('common/header', $pageData);
        $this->load->view('master/user/manage_password', $pageData);
        $this->load->view('common/footer', $footerData);
    }

    public function orders()
    {
        if (empty(getFrontenduserId())) {
            redirect('index');
        }

        $user_id = getFrontenduserId();
        $loginuserterm = loginuserterm();
        $cart = $this->session->userdata('cart');
        $key = $this->security->xss_clean($this->input->post('search'));
        $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $config['base_url'] = base_url() . "/" . $this->lang->default_lang . "/user/orders/";
        $config['total_rows'] = $this->cart_model->get_cart_details('count', '', '', '', $user_id);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['num_links'] = 4;
        $config['first_link'] = '<<';
        $config['last_link'] = '>>';
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['num_tag_open'] = '<span class="number">';
        $config['num_tag_close'] = '</span>';
        $config['cur_tag_open'] = '<span class="current"><a href="#">';
        $config['cur_tag_close'] = '</a></span>';
        $this->pagination->initialize($config);
        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer', 'sales_order_preview', 'payment_instructions', 'page_title'), $this->lang->default_lang_id);
        $all_language_data = get_admin_lang_data(array('admin_order_details'), $this->lang->default_lang_id);
        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('user_orders'),
            'pageType' => 'entry_door',
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'credit_door',
            'timestamp' => date_timestamp_get(date_create()),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'all_orders' => $this->cart_model->get_cart_details('all', '', $config['per_page'], $offset, $user_id),
            'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'links' => $this->pagination->create_links(),
            'offset' => $offset,
            'search' => $key,
            'all_navigation_data' => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'search' => $key,
            'entry_door_timer' => (object) $userLangData['entry_door_timer'],
            'general_instruction' => (object) $userLangData['general_instruction'],
            'payment_instructions' => (object) $userLangData['payment_instructions'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'sales_order_preview' => (object) $userLangData['sales_order_preview'],
            'cartcount' => getcartcount($cart),
            'loginuserterm' => $loginuserterm,
            'admin_order_details' => $all_language_data['admin_order_details'],
            'all_titles' => (object) $userLangData['page_title'],
        );

        $footerData = array(
            'all_data' => $pageData['all_data'],
            'all_navigation_data' => $pageData['all_navigation_data'],
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
        );
        // view files required to generate cart page of the estore.
        $this->load->view('common/header', $pageData);
        $this->load->view('master/user/order_history', $pageData);
        $this->load->view('common/footer', $footerData);
    }

    public function vieworder($id = false, $invoice_no)
    {

        if (empty(getFrontenduserId())) {
            redirect('index');
        }

        $cart = $this->session->userdata('cart');
        $user_id = getFrontenduserId();
        $loginuserterm = loginuserterm();
        $userLangData = get_user_lang_data(array('product_instruction', 'general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer', 'page_title', 'sales_order_preview'), $this->lang->default_lang_id);
        $all_language_data = get_admin_lang_data(array('admin_order_details', 'admin_static_links'), $this->lang->default_lang_id);
        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('view_order'),
            'pageType' => 'entry_door',
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'credit_door',
            'timestamp' => date_timestamp_get(date_create()),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'all_navigation_data' => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'entry_door_timer' => (object) $userLangData['entry_door_timer'],
            'general_instruction' => (object) $userLangData['general_instruction'],
            'sales_order_preview' => (object) $userLangData['sales_order_preview'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'product_instruction' => (object) $userLangData['product_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'cartcount' => getcartcount($cart),
            'loginuserterm' => $loginuserterm,
            'main_data' => $this->cart_model->get_cart_details('single', $id, "", "", $user_id),
            'cart_data' => $this->cart_model->get_cart_order_data_by_invoice_id($invoice_no),
            'cart_package_data' => $this->cart_model->get_cart_package_databyid($id),
            'order_payments' => $this->cart_model->get_order_payments($id),
            'all_titles' => (object) $userLangData['page_title'],
            'admin_order_details' => $all_language_data['admin_order_details'],

        );

        $footerData = array(
            'all_data' => $pageData['all_data'],
            'all_navigation_data' => $pageData['all_navigation_data'],
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
        );
        // view files required to generate cart page of the estore.
        $this->load->view('common/header', $pageData);
        $this->load->view('master/user/order_details', $pageData);
        $this->load->view('common/footer', $footerData);
    }

    public function quotations()
    {
        if (empty(getFrontenduserId())) {
            redirect('index');
        }

        $user_id = getFrontenduserId();
        $loginuserterm = loginuserterm();
        $cart = $this->session->userdata('cart');
        $key = $this->security->xss_clean($this->input->post('search'));
        $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $config['base_url'] = base_url() . "/" . $this->lang->default_lang . "/user/quotations/";
        $config['total_rows'] = $this->cart_model->get_quotation_details('count', '', '', '', $user_id, "yes");
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['num_links'] = 4;
        $config['first_link'] = '<<';
        $config['last_link'] = '>>';
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['num_tag_open'] = '<span class="number">';
        $config['num_tag_close'] = '</span>';
        $config['cur_tag_open'] = '<span class="current"><a href="#">';
        $config['cur_tag_close'] = '</a></span>';
        $this->pagination->initialize($config);
        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer', 'sales_order_preview', 'payment_instructions', 'page_title'), $this->lang->default_lang_id);
        $all_language_data = get_admin_lang_data(array('admin_order_details'), $this->lang->default_lang_id);
        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('user_orders'),
            'pageType' => 'entry_door',
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'credit_door',
            'timestamp' => date_timestamp_get(date_create()),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'all_orders' => $this->cart_model->get_quotation_details('all', '', $config['per_page'], $offset, $user_id, "1"),
            'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'links' => $this->pagination->create_links(),
            'offset' => $offset,
            'search' => $key,
            'all_navigation_data' => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'search' => $key,
            'entry_door_timer' => (object) $userLangData['entry_door_timer'],
            'general_instruction' => (object) $userLangData['general_instruction'],
            'payment_instructions' => (object) $userLangData['payment_instructions'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'sales_order_preview' => (object) $userLangData['sales_order_preview'],
            'cartcount' => getcartcount($cart),
            'loginuserterm' => $loginuserterm,
            'admin_order_details' => $all_language_data['admin_order_details'],
            'all_titles' => (object) $userLangData['page_title'],
        );

        $footerData = array(
            'all_data' => $pageData['all_data'],
            'all_navigation_data' => $pageData['all_navigation_data'],
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
        );
        // view files required to generate cart page of the estore.
        $this->load->view('common/header', $pageData);
        $this->load->view('master/user/quotation_history', $pageData);
        $this->load->view('common/footer', $footerData);
    }

    public function viewquotations($id = false)
    {

        if (empty(getFrontenduserId())) {
            redirect('index');
        }

        $cart = $this->session->userdata('cart');
        $user_id = getFrontenduserId();
        $loginuserterm = loginuserterm();
        $userLangData = get_user_lang_data(array('product_instruction', 'general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer', 'page_title', 'sales_order_preview'), $this->lang->default_lang_id);
        $all_language_data = get_admin_lang_data(array('admin_order_details'), $this->lang->default_lang_id);
        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('view_order'),
            'pageType' => 'entry_door',
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'credit_door',
            'timestamp' => date_timestamp_get(date_create()),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'all_navigation_data' => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'entry_door_timer' => (object) $userLangData['entry_door_timer'],
            'general_instruction' => (object) $userLangData['general_instruction'],
            'sales_order_preview' => (object) $userLangData['sales_order_preview'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'product_instruction' => (object) $userLangData['product_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'cartcount' => getcartcount($cart),
            'loginuserterm' => $loginuserterm,
            'cart_data' => $this->cart_model->get_cart_order_data_by_id($id),
            'model_attr_data' => $this->cart_model->get_cart_order_attr_data_by_id($id, 'model'),
            'product_attr_data' => $this->cart_model->get_cart_order_attr_data_by_id($id, 'product'),
            'main_data' => $this->cart_model->get_cart_details('single', $id, "", "", $user_id),
            'cart_package_data' => $this->cart_model->get_cart_package_databyid($id),
            'all_titles' => (object) $userLangData['page_title'],
            'admin_order_details' => $all_language_data['admin_order_details'],

        );

        $footerData = array(
            'all_data' => $pageData['all_data'],
            'all_navigation_data' => $pageData['all_navigation_data'],
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
        );
        // view files required to generate cart page of the estore.
        $this->load->view('common/header', $pageData);
        $this->load->view('master/user/quotation_details', $pageData);
        $this->load->view('common/footer', $footerData);
    }

    /**
     * Method save_quotation
     *
     * Function to save the current quotation.
     *
     * @return void
     */
    public function quotation_pay($quotation_id)
    {

        $user_id = getFrontenduserId();
        $quotation_details = $this->comman_model->get_data_by_id('quotations', array("id" => $quotation_id));
        $cartusers_data = $this->comman_model->get_data_by_id('cart_users', array("id" => $quotation_details['order_id']));

        if ($quotation_details) {

            $quot_sess_data = unserialize($quotation_details['complete_data']);
            //echo "<pre>";
            unset($quot_sess_data['session_id']);
            unset($quot_sess_data['ip_address']);
            unset($quot_sess_data['user_agent']);
            unset($quot_sess_data['default_image']);
            unset($quot_sess_data['last_activity']);
            unset($quot_sess_data['Csrf-Token']);
            unset($quot_sess_data['hide_category']);
            unset($quot_sess_data['captchaCode']);
            // these functions clear the all session data related to cart
            $this->session->set_userdata($quot_sess_data);

            if ($this->config->item('partial_payment_enable') == "1") {

                $this->session->set_userdata(array('amount_received' => $cartusers_data['amount_received'], 'partial_payment_percentage' => $quotation_details['request_percentage'], 'payment_type' => $quotation_details['request_payment_type'], 'order_id' => $quotation_details['order_id'], 'order_number' => $cartusers_data['order_number'], 'quotation_id' => $quotation_id, 'quotation_expdate' => $quotation_details['expirydate']));

            } else {

                $this->session->set_userdata(array('amount_received' => $cartusers_data['amount_received'], 'order_id' => $quotation_details['order_id'], 'order_number' => $cartusers_data['order_number'], 'quotation_id' => $quotation_id, 'quotation_expdate' => $quotation_details['expirydate']));

            }
            redirect('cart/cart_confirm');
        }
    }

    public function cards()
    {

        if (empty(getFrontenduserId())) {
            redirect('index');
        }

        $cart = $this->session->userdata('cart');
        $user_id = getFrontenduserId();
        $loginuserdata = loginuserdata();
        $loginuserterm = loginuserterm();
        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer', 'page_title', 'payment_instructions'), $this->lang->default_lang_id);

        $user_cards = $this->comman_model->get_all_data_by_id("user_cards", array("user_id" => $user_id));
        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('list_cards'),
            'pageType' => 'entry_door',
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'credit_door',
            'timestamp' => date_timestamp_get(date_create()),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'user_cards' => $user_cards,
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'all_navigation_data' => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'entry_door_timer' => (object) $userLangData['entry_door_timer'],
            'general_instruction' => (object) $userLangData['general_instruction'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'payment_instructions' => (object) $userLangData['payment_instructions'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'all_titles' => (object) $userLangData['page_title'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'cartcount' => getcartcount($cart),
            'loginuserterm' => $loginuserterm,
        );

        $footerData = array(
            'all_data' => $pageData['all_data'],
            'all_navigation_data' => $pageData['all_navigation_data'],
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
        );

        // view files required to generate cart page of the estore.
        $this->load->view('common/header', $pageData);
        $this->load->view('master/user/card_list', $pageData);
        $this->load->view('common/footer', $footerData);
    }

    public function addcard()
    {

        if (empty(getFrontenduserId())) {
            redirect('index');
        }

        $loginuserdata = loginuserdata();
        $loginuserterm = loginuserterm();
        $user_id = getFrontenduserId();
        $user_cards = $this->comman_model->get_all_data_by_id("user_cards", array("user_id" => $user_id));
        if (count($user_cards) >= 3) {
            redirect('user/cards');
        }

        $square_customer_id = $this->get_square_customer_id();
        $cart = $this->session->userdata('cart');
        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'payment_instructions', 'entry_door_timer', 'cart_instruction', 'page_title'), $this->lang->default_lang_id);
        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title' => get_page_title('add_cards'),
            'pageType' => 'addcard',
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'credit_door',
            'timestamp' => date_timestamp_get(date_create()),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'all_navigation_data' => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'payment_instruction' => (object) $userLangData['payment_instructions'],
            'general_instruction' => (object) $userLangData['general_instruction'],
            'selection_instruction' => (object) $userLangData['selection_instruction'],
            'product_instruction' => (object) $userLangData['product_instruction'],
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'admin_static_links' => $userLangData['admin_static_links'],
            'cartcount' => getcartcount($cart),
            'all_titles' => (object) $userLangData['page_title'],
            'loginuserterm' => $loginuserterm,
        );

        $square_api_settings = $this->cart_model->square_api_settings("ca");
        $pageData['paymee_token'] = '';
        $pageData['square_api_settings'] = $square_api_settings;

        $footerData = array(
            'all_data' => $pageData['all_data'],
            'all_navigation_data' => $pageData['all_navigation_data'],
            'all_social_media_data' => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
        );

        // view files required to generate cart page of the estore.
        $this->load->view('common/header', $pageData);
        $this->load->view('master/user/add_card', $pageData);
        $this->load->view('common/footer', $footerData);
    }

    public function deletecard($id)
    {
        if (empty(getFrontenduserId())) {
            redirect('index');
        }

        $this->load->library('Square');
        $userLangData = get_user_lang_data(array('general_instruction'), $this->lang->default_lang_id);
        $general_instruction = (object) $userLangData['general_instruction'];
        // If payment form is submitted with token
        if ($id) {
            $user_id = getFrontenduserId();
            $card_data = $this->comman_model->get_data_by_id("user_cards", array("id" => $id, "user_id" => $user_id));
            if ($card_data) {
                $countryCode = 'ca';
                $square_api_settings = $this->cart_model->square_api_settings($countryCode);
                $this->square->addField('access_token', $square_api_settings['access_token']);
                $this->square->addField('payment_mode', $this->config->item('payment_mode'));
                $this->square->addField('card_id', $card_data['card_id']);
                $responce = $this->square->deleteCard();

                if ($responce['status'] == "success") {

                    $this->comman_model->delete_where("user_cards", array("id" => $id, "user_id" => $user_id));

                    $message = array('message' => $general_instruction->card_deleted, 'type' => 'success');
                    $this->session->set_flashdata('flash_message', $message);

                    redirect('user/cards');
                } else {

                    $message = array('message' => $general_instruction->card_not_deleted, 'type' => 'error');
                    $this->session->set_flashdata('flash_message', $message);
                    redirect('user/cards');
                }
            } else {

                $message = array('message' => $general_instruction->card_not_found, 'type' => 'error');
                $this->session->set_flashdata('flash_message', $message);
                redirect('user/cards');
            }
        } else {

            $message = array('message' => $general_instruction->card_not_found, 'type' => 'error');
            $this->session->set_flashdata('flash_message', $message);

            redirect('user/cards');
        }
    }

    public function save_card()
    {
        if (empty(getFrontenduserId())) {
            redirect('index');
        }

        // If payment form is submitted with token
        if ($this->input->post('token')) {

            $user_id = getFrontenduserId();
            $user_data = $this->comman_model->get_data_by_id("users", array("id" => $user_id));
            // Retrieve stripe token, card and user info from the submitted form data
            $customer_id = $this->get_square_customer_id();
            $postData = $this->input->post();
            $postData = $this->security->xss_clean($postData);

            $userLangData = get_user_lang_data(array('general_instruction'), $this->lang->default_lang_id);
            $general_instruction = (object) $userLangData['general_instruction'];

            $countryCode = 'ca';
            $square_api_settings = $this->cart_model->square_api_settings($countryCode);
            $this->square->addField('access_token', $square_api_settings['access_token']);
            $this->square->addField('payment_mode', $this->config->item('payment_mode'));
            $this->square->addField('customer_id', $customer_id);
            $this->square->addField('card_token', $postData['token']);
            $responce = $this->square->createCard();
            if ($responce['status'] == "success") {
                $card = $responce['detail'];
                $raw = json_encode($card);
                $this->comman_model->add("user_cards", array("user_id" => $user_data['id'], "type" => "square", "card_id" => $card['id'], "card_brand" => $card['card_brand'], "last_4" => $card['last_4'], "exp_month" => $card['exp_month'], "exp_year" => $card['exp_year'], "customer_id" => $card['customer_id'], "raw" => $raw));

                $message = array('message' => $general_instruction->card_success, 'type' => 'success');
                $this->session->set_flashdata('flash_message', $message);

                $result['card_id'] = $card['id'];
                $result['status'] = "success";
                echo json_encode($result);
                exit;
            } else {

                $result['status'] = "error";
                echo json_encode($result);
            }
        } else {

            $result['status'] = "error";
            echo json_encode($result);
            exit;
        }
    }

    private function get_square_customer_id()
    {
        $this->load->library('Square');
        $user_id = getFrontenduserId();
        $user_data = $this->comman_model->get_data_by_id("users", array("id" => $user_id));

        if (!empty($user_data["square_customer_id"])) {
            return $user_data['square_customer_id'];
        } else {

            $countryCode = 'ca';
            $square_api_settings = $this->cart_model->square_api_settings($countryCode);
            $this->square->addField('access_token', $square_api_settings['access_token']);
            $this->square->addField('payment_mode', $this->config->item('payment_mode'));
            $this->square->addField('email_address', $user_data['email']);
            $this->square->addField('company_name', $user_data['company']);
            $this->square->addField('reference_id', $user_data['id']);
            $responce = $this->square->createCustomer();
            if ($responce['status'] == "success") {
                $this->comman_model->update_data_by_id("users", array("square_customer_id" => $responce['customer_id']), "id", $user_data['id']);
                return $responce['customer_id'];
            } else {

                return false;
            }
        }
    }

    public function apply_credit()
    {
        //  This is helper function to validate logged in user.
        $result = logged_user_validation(false);
        if ($result) {
            // If user is not logged in than this condition will  run.
            $entry_users_data = $this->session->userdata('entry_users_data');

            if (!empty($entry_users_data)) {
                $where_param = array();
                $where_param['email'] = $entry_users_data['email'];
                $where_param['country_code'] = $entry_users_data['country_code'];
                $where_param['telephone'] = $entry_users_data['telephone'];

                $select_param = array('*');
                $rowdata = $this->comman_model->get_row_array("entry_door_front_block_data", $select_param, $where_param);
                $entry_users_data = $rowdata[0];
            } else {
                $entry_users_data = array();
            }

            // check email otp attempt  session variables and update.
            if ($this->session->userdata('entry_email_attempt') != '' && $this->session->userdata('entry_email_attempt') <= 3) {
                $email_attempt = $this->session->userdata('entry_email_attempt') + 1;
            } else {
                $email_attempt = 0;
            }

            // check sms otp attempt  session variables and update.
            if ($this->session->userdata('entry_sms_attempt') != '' && $this->session->userdata('entry_sms_attempt') <= 3) {
                $sms_attempt = $this->session->userdata('entry_sms_attempt') + 1;
            } else {
                $sms_attempt = 0;
            }

            $cart = $this->session->userdata('cart');

            $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer'), $this->lang->default_lang_id);

            // initialize data as Array to assign all required values for view files.
            $pageData = array(
                'title' => get_page_title('entry_door_page'),
                'pageType' => 'entry_door',
                'lang_id' => $this->lang->default_lang,
                'lang_num' => $this->lang->default_lang_id,
                'active' => 'credit_door',
                'timestamp' => date_timestamp_get(date_create()),
                'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
                'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
                'all_data' => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
                'all_navigation_data' => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
                'entry_users_data' => $entry_users_data,
                'email_attempt' => $email_attempt,
                'sms_attempt' => $sms_attempt,
                'entry_door_timer' => (object) $userLangData['entry_door_timer'],
                'general_instruction' => (object) $userLangData['general_instruction'],
                'selection_instruction' => (object) $userLangData['selection_instruction'],
                'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
                'cart_instruction' => (object) $userLangData['cart_instruction'],
                'admin_static_links' => $userLangData['admin_static_links'],
                'cartcount' => getcartcount($cart),
            );

            // view files required to generate home page of the estore.
            $this->load->view('common/header', $pageData);
            // $this->load->view('master/home/credit_form', $pageData);
            // $this->load->view('master/user/order_history', $pageData);
            // $this->load->view('master/user/edit_profile', $pageData);
            $this->load->view('master/user/signup_form', $pageData);
            $this->load->view('common/footer', $pageData);
        } else {
            if (getenv('DEFAULT_LANGUAGE')) {
                redirect('/' . getenv('DEFAULT_LANGUAGE') . '/products', 'refresh');
            } else {
                redirect('/' . $this->lang->default_lang . '/products', 'refresh');
            }
        }
    }

    public function send_credit_form_mail()
    {
        // If user is not logged in than this condition will  run.
        $front_validuser_data = $this->session->userdata('front_validuser_data');
        if (!empty($front_validuser_data)) {
            // This Function load email library
            $this->load->library('Email');

            // This Function load email configuration from config file and intialize the library
            $config = $this->config->item('emailconfig');
            $this->email->initialize($config);

            // This Function get email body content subject and from address  from the table email_instruction these values are manageable from the admin side
            $email_instruction = (object) get_user_lang_data(array('email_instruction'), $this->lang->default_lang_id)['email_instruction'];

            // set variable for  email function
            // $fromeMailId = $email_instruction->from_mail_id;
            // $fromName    = $email_instruction->admin_cart_mail_fromname;

            $fromeMailId = $this->config->item('fromemailaddress');
            //$fromName       = $this->config->item('fromemailname');
            $fromName = $email_instruction->admin_cart_mail_fromname;
            $toEmailId = $front_validuser_data['email'];
            $toName = $front_validuser_data['applicant'];
            $subject = $email_instruction->applycredit_subject;
            $msg = htmlspecialchars_decode($email_instruction->applycredit_content);
            $msg = str_replace('{name}', $front_validuser_data['applicant'], $msg);

            // check if language is not an english, then will fetch sender name for english becoz send grid not support or not validated other language sender name
            if ($this->lang->default_lang_id != 13) {
                // $fromName = get_user_lang_data(array('email_instruction'), 13)['email_instruction']['admin_cart_mail_fromname'];
            }

            $attched_file = FCPATH . 'assets/uploads/CREDIT-APPLICATION-FORM-2020.pdf';
            $this->email->from($fromeMailId, $fromName);
            $this->email->to($toEmailId);
            $this->email->subject($subject);
            $this->email->message($msg);
            // This Code attached credit application form with email
            if (file_exists($attched_file)) {
                $this->email->attach($attched_file);
            }
            // This Functions send email and clear email configuration
            $this->email->send();
            // This Function attach invoice and tax exoneration file

            $this->email->clear(true);

            $where_param['email'] = $front_validuser_data['email'];
            $where_param['country_code'] = $front_validuser_data['country_code'];
            $where_param['telephone'] = $front_validuser_data['telephone'];

            // Delete records from the entry_door_front_shopping_data using email and phone from user session.
            $this->comman_model->delete_row("entry_door_front_shopping_data", $where_param);
            $this->session->unset_userdata('entry_email_attempt');
            $this->session->unset_userdata('entry_sms_attempt');
            $this->session->unset_userdata('email_confirm');
            $this->session->unset_userdata('entry_email_confirm_status');
            $this->session->unset_userdata('sms_confirm');
            $this->session->unset_userdata('entry_sms_confirm_status');
            $this->session->unset_userdata('entry_users_data');
            $this->session->unset_userdata('front_validuser_data');
            $this->session->unset_userdata('email_randomString');
            $this->session->unset_userdata('sms_randomString');
        }
        redirect(site_url());
    }

    public function save_signup_data()
    {
        $postData = $this->security->xss_clean($this->input->post());
        if (count($postData) > 0) {
            $postData['country_code'] = str_replace('+', '', $postData['country_code']);
            $userExist = $this->user_model->checkUserExist($postData);
            if ($userExist == 0) {
                unset($postData['cart_country_flag']);
                unset($postData['Csrf-Token']);
                unset($postData['cud_cart_state']);
                // this code  save user in the users table
                $access_token = md5(uniqid($postData['email'], true));
                $customer_no = generate_customer_no();
                $postData['access_token'] = $access_token;
                $postData['customer_no'] = $customer_no;
		$postData['dateAdded'] = date('Y-m-d H:i:s');

		if (ENVIRONMENT == "production") {
                    $sms_randomString = substr(str_shuffle("0123456789"), 0, 6);
                    $phone_sent = $postData['country_code'] . $postData['telephone'];
                    sentSmsCode($sms_randomString, $phone_sent, $postData['country_code'], 'password_page_otp_text');
                } else {
                    $sms_randomString = getenv('TEST_SMS_CODE');
                }
                $postData['otp_code'] = $sms_randomString;
                $postData['otp_code_attempt'] = 0;

                if ($this->config->item('limited_price_option') == "1") {

                    $postData['user_status'] = "0";

                }
                $userId = $this->comman_model->add('users', $postData);
                if ($userId) {
                    // This Function load email library
                    $this->load->library('Email');
                    // This Function load email configuration from config file and intialize the library
                    $config = $this->config->item('emailconfig');
                    $this->email->initialize($config);
                    // This Function get email body content subject and from address  from the table email_instruction these values are manageable from the admin side
                    $email_instruction = (object) get_user_lang_data(array('email_instruction'), $this->lang->default_lang_id)['email_instruction'];
                    // set variable for  email function
                    $fromeMailId = $this->config->item('fromemailaddress');
                    $fromName = $email_instruction->admin_cart_mail_fromname;
                    $toEmailId = $postData['email'];
                    $toName = $postData['surname'];
                    $signature = $email_instruction->admin_cart_mail_fromname;

                    if ($this->config->item('limited_price_option') == "1") {
                        $subject = $email_instruction->signup_admin_approval_subject;
                        $msg = htmlspecialchars_decode($email_instruction->signup_admin_approval);

                    } else {

                        $subject = $email_instruction->signup_welcome_mail_subject;
                        $msg = htmlspecialchars_decode($email_instruction->signup_welcome_mail);

                    }

                    // Replace variable in the email and subject content
                    $activation_link = base_url() . $this->lang->default_lang . '/user/setpassword/' . $access_token;
                    $msg = str_replace('{name_details}', $postData['surname'], $msg);
                    $msg = str_replace('{activation_link}', $activation_link, $msg);
                    $msg = str_replace('{signature}', $signature, $msg);
                    // check if language is not an english, then will fetch sender name for english becoz send grid not support or not validated other language sender name
                    if ($this->lang->default_lang_id != 13) {
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

                    $response = array('result' => 'success');
                }
            } else {
                $response = array('result' => 'user_exist_already');
            }
        } else {
            $response = array('result' => 'form_data_required');
        }
        echo json_encode($response);
    }

    public function check_email_phone_exist()
    {
        $postData = $this->security->xss_clean($this->input->post());
        if (count($postData) > 0) {
            $postData['country_code'] = str_replace('+', '', $postData['country_code']);
            $userExist = $this->user_model->emailphoneExist($postData);
            if ($userExist == 0) {
                $response = array('result' => 'true');
            } else {
                $response = array('result' => 'user_exist_already');
            }
        } else {
            $response = array('result' => 'form_data_required');
        }
        echo json_encode($response);
    }

    public function send_otp_code_forgotpassword($userData){

        $otp_code_attempt = $userData['otp_code_attempt'];
        $entry_door_timer = (object) get_user_lang_data(array('entry_door_timer'), $this->lang->default_lang_id)['entry_door_timer'];
        $resend_otp_attempt = $entry_door_timer->resend_otp_attempt ? $entry_door_timer->resend_otp_attempt : 10;
        if ($otp_code_attempt <= $resend_otp_attempt) {
            if (ENVIRONMENT == "production") {
                $sms_randomString = substr(str_shuffle("0123456789"), 0, 6);
                $phone_sent = $userData['country_code'] . $userData['telephone'];
                sentSmsCode($sms_randomString, $phone_sent, $userData['country_code'], 'password_page_otp_text');
            } else {
                $sms_randomString = getenv('TEST_SMS_CODE');
            }

            $updateData = array(
                'otp_code' => $sms_randomString,
                'otp_code_attempt' => $otp_code_attempt,
                'dateUpdated' => date('Y-m-d H:i:s'),
            );
            $updateData = $this->security->xss_clean($updateData);
            $this->comman_model->update_data_by_id('users', $updateData, 'id', $userData['id']);
        }
    }
}
