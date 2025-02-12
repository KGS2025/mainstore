<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Front Controller
 * 
 * 
 * Class to handle all users related functions like login, logout, verification of user, check session of the users etc.
 *
 * @author      Kondarsoft Dev Team
 * @link        https://kondarsoft.com/
 * @filesource
 */

class Front extends MY_Controller
{
    
    /**
     * __construct
     *
     * All helpers, models those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('assets', 'cart_helper', 'common_helper', 'file'));
        $this->load->model(array('comman_model', 'entry_door_front_block_data', 'userblocked_model'));
    }
    
    /**
     * get_current_time
     *
     * This Function Display Current timestamp of server.
     * @return void
     */
    function get_current_time()
    {
        $date = date_create();
        echo date_timestamp_get($date);
    }
    
    /**
     * checkBlockedUser
     *
     * This Function check if user is blocked or not using email and phone.
     * @return array
     */
    function checkBlockedUser()
    {
        $error = array();
        $post = $this->input->post();
        // This is function of model  entry_door_front_block_data
        $result = $this->userblocked_model->checkBlockedUser($post);
        if (!empty($result)) {
            $error['response'] = 'error';
        } else {
            $error['response'] = 'success';
        }
        return $error;
    }
    
    /**
     * entry_door
     *
     * This Function display the front end login form. If user is not logged  only than this form is opened else it redirects user to the products page.
     * @link https://estorename.kondarsoft.com/en/front/entry_door
     * @return void
     */
    public function entry_door(){

        //  This is helper function to validate logged in user.
        $result = logged_user_validation(false);
        if (!$result) {

            if($this->uri->segment(2) == ''){
                setDefaultLanguage();
                if($this->session->userdata('default_language')){
                    redirect('/' . $this->session->userdata('default_language').'/front/entry_door', 'refresh');
                }
            }

            // If user is not logged in than this condition will  run.
            $entry_users_data     = $this->session->userdata('entry_users_data');

            if (!empty($entry_users_data)) {
                $where_param = array();
                $where_param['email']        = $entry_users_data['email'];
                $where_param['country_code'] = $entry_users_data['country_code'];
                $where_param['telephone']    = $entry_users_data['telephone'];

                $select_param = array('*');
                $rowdata = $this->comman_model->get_row_array("entry_door_front_block_data", $select_param, $where_param);
                $entry_users_data = $rowdata[0];
            } else {
                $entry_users_data = array();
            }

            // check email otp attempt  session variables and update. 
            if ($this->session->userdata('entry_email_attempt') != '' && $this->session->userdata('entry_email_attempt') <= 3) {
                $email_attempt = $this->session->userdata('entry_email_attempt')+1;
            } else {
                $email_attempt = 0;
            }
           
            // check sms otp attempt  session variables and update.
            if ($this->session->userdata('entry_sms_attempt') != '' && $this->session->userdata('entry_sms_attempt') <= 3) {
                $sms_attempt = $this->session->userdata('entry_sms_attempt')+1;
            } else {
                $sms_attempt = 0;
            }

            $cart = $this->session->userdata('cart');

            $userLangData = get_user_lang_data(array('general_instruction','selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer'),$this->lang->default_lang_id);

            // initialize data as Array to assign all required values for view files.
            $pageData = array(
                'title'                       => get_page_title('entry_door_page'),
                'pageType'                    => 'entry_door',
                'lang_id'                     => $this->lang->default_lang,
                'lang_num'                    => $this->lang->default_lang_id,
                'active'                      => 'entry_door',
                'timestamp'                  => date_timestamp_get(date_create()),
                'country_data'                => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
                'countries'                   => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
                'all_data'                    => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
                'all_navigation_data'         => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
                'entry_users_data'            => $entry_users_data,
                'email_attempt'               => $email_attempt,
                'sms_attempt'                 => $sms_attempt,
                'entry_door_timer'            => (object)$userLangData['entry_door_timer'],
                'general_instruction'         => (object)$userLangData['general_instruction'],
                'selection_instruction'       => (object)$userLangData['selection_instruction'],
                'form_validation_instruction' => (object)$userLangData['form_validation_instruction'],
                'cart_instruction'            => (object)$userLangData['cart_instruction'],
                'admin_static_links'          => $userLangData['admin_static_links'],
                'cartcount'                   => getcartcount($cart)
            );

            $pageData['completedata'] =  $pageData;

            // view files required to generate home page of the estore.
            $this->load->view('common/header', $pageData);
            $this->load->view('master/home/entry_door', $pageData);
            $this->load->view('common/footer', $pageData);
        } else {
            setDefaultLanguage();
            if($this->session->userdata('default_language')){
                redirect('/' . $this->session->userdata('default_language') . '/products', 'refresh');
            }else{
                redirect('/' . $this->lang->default_lang . '/products', 'refresh');
            }
            
            // if(getenv('DEFAULT_LANGUAGE')){
            //     redirect('/' . getenv('DEFAULT_LANGUAGE') . '/products', 'refresh');
            // }else{
            //     redirect('/' . $this->lang->default_lang . '/index', 'refresh');
            // }
        }
    }
    /**
     * save_data
     *
     * This Function is used to save and update information related to verification codes in the database table(entry_door_front_block_data). This is child function of the send_verification_code function.
     * @return void
     */
    public function save_data()
    {
        // set the variables from post inputs
        $user_name    = $this->input->post('salutation') . ' ' . $this->input->post('name');
        $country_code = str_replace('+', '', $this->input->post('country_code'));
        $telephone    = ltrim($this->input->post('telephone'), '0');

        $resend       = $this->input->post('resend');

        $old_entry_users_data = $this->session->userdata('entry_users_data') ? $this->session->userdata('entry_users_data') : array();

        // prepare Array for the session 
        $entry_users_data = array(
            'user_name'     => $user_name,
            'country'       => $this->input->post('country'),
            'country_code'  => trim($country_code),
            'telephone'     => trim($telephone),
            'email'         => $this->input->post('email')
        );
        $session_data = array('entry_users_data' => $entry_users_data);
        // save user details in the session variable
        $this->session->set_userdata($session_data);
        
        // set value of email attempt variable
        if ($entry_users_data['email'] != $this->input->post('email')) {
            $entry_email_attempt = 0;
        } else if ($this->session->userdata('entry_email_attempt') != '') {
            $entry_email_attempt = $this->session->userdata('entry_email_attempt');
        } else {
            $entry_email_attempt = 0;
        }

        // set value of sms attempt variable
        if ($entry_users_data['telephone'] != $this->input->post('telephone')) {
            $entry_sms_attempt = 0;
        } else if ($this->session->userdata('entry_sms_attempt') != '') {
            $entry_sms_attempt = $this->session->userdata('entry_sms_attempt');
        } else {
            $entry_sms_attempt = 0;
        }

        // save email and sms attempt variable values in the session
        $entry_email_sms = array(
            'entry_email_attempt' => $entry_email_attempt,
            'entry_sms_attempt'   => $entry_sms_attempt
        );
        $this->session->set_userdata($entry_email_sms);

        $block_id = array();
        if(count($old_entry_users_data) > 0){
            $where_param = array();
            // check that the email and phone is exist in the block table 
            $where_param['email']        = $old_entry_users_data['email'];
            $where_param['country_code'] = $old_entry_users_data['country_code'];
            $where_param['telephone']    = $old_entry_users_data['telephone'];
            $select_param = '*';
            $block_id = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);
        }

        $actionPage = $this->input->post('action');
        $region = $actionPage ? 'Cart' : 'Front Door';

        if (isset($block_id[0]->id) && $block_id[0]->id != "" && isset($block_id[0]->dte_block) && $block_id[0]->dte_block != '') {
            // if record exist in the table and block date and time is also set than this condition will execute
            $whr_param['id'] = $block_id[0]->id;
            $block_data = array();
            $block_data['dte_block'] = NULL;
            $block_data['email'] = $this->input->post('email');
            $block_data['applicant'] = $user_name;
            $block_data['country'] = $this->input->post('country');
            $block_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $block_data['country_code'] = $country_code;
            $block_data['telephone'] = $telephone;
            $block_data['region'] = $region;
            $block_data['created_time'] = time();
            $this->comman_model->update_column("entry_door_front_block_data", $whr_param, $block_data);
        } else if (isset($block_id[0]->id) && $block_id[0]->id != "") {
            // if record exist in the table than this condition will execute
            $whr_param['id'] = $block_id[0]->id;
            $block_data = array();
            $block_data['dte_block'] = NULL;
            $block_data['email'] = $this->input->post('email');
            $block_data['applicant'] = $user_name;
            $block_data['country'] = $this->input->post('country');
            $block_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $block_data['country_code'] = $country_code;
            $block_data['telephone'] = $telephone;
            $block_data['region'] = $region;
            $this->comman_model->update_column("entry_door_front_block_data", $whr_param, $block_data);
        } else {
            // if no record exist in the database table than this condition will execute
            $block_data = array();
            $block_data['errors'] = 0;
            $block_data['email_sents'] = 0;
            $block_data['sms_sents'] = 0;
            $block_data['dte_block'] = NULL;
            $block_data['block'] = 0;
            $block_data['email'] = $this->input->post('email');
            $block_data['applicant'] = $user_name;
            $block_data['country'] = $this->input->post('country');
            $block_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $block_data['country_code'] = $country_code;
            $block_data['telephone'] = $telephone;
            $block_data['region'] = $region;
            $block_data['created_time'] = time();
            $block_data['timezone'] = trim($this->input->post('block_timezone'));
            // this function will add entry in the block table
            $this->comman_model->insert_column("entry_door_front_block_data", $block_data);
        }

        // This condition compare input email and phone with session variable and return result accordingly
        if (!empty($old_entry_users_data) && $resend != 'true') {
            if ($old_entry_users_data['email'] != $this->input->post('email') && ($old_entry_users_data['country_code'] != $country_code || $old_entry_users_data['telephone'] != $telephone)) {
                $result = 'all';
            } else if ($old_entry_users_data['email'] != $this->input->post('email')) {
                $result = 'email';
            } else if ($old_entry_users_data['country_code'] != $country_code || $old_entry_users_data['telephone'] != $telephone) {
                $result = 'telephone';
            } else {
                $result = 'none';
            }
        } else {
            $result = 'all';
        }
        return $result;
    }
    
    /**
     * checkCurrentSession
     *
     * This function is used to check current user details from session variables. This is child function of send_verification_code.
     * @return void
     */
    function checkCurrentSession()
    {
        $error = array();
        $post  = $this->input->post();
        $where_param = array();
        $where_param['email']        = $post['email'];
        $where_param['country_code'] = str_replace('+', '', $post['country_code']);
        $where_param['telephone']    = $post['telephone'];
        // this function get details from table users_front_entry_door.
        $result = $this->entry_door_front_block_data->checkCurrentSession($where_param);
        $result['created_time'] = isset($result['created_time']) && $result['created_time'] ? $result['created_time'] : 0;
        // this function get details from table entry_door_front_shopping_data.
        $result1 = $this->comman_model->getValidUserData($where_param);
        $result1['ip_address'] = isset($result1['ip_address']) ? $result1['ip_address'] : '';
        $id['id'] = 1;
        //This Function is used to get values of messages and timer from table entry_door_timer
        $timedata = get_user_lang_data(array('entry_door_timer'), $this->lang->default_lang_id, 'entry_door_shopping_timer')['entry_door_timer'];
        $bal_time = time() - $result['created_time'];
        $time_diff = ($timedata['entry_door_shopping_timer'] * 60) - $bal_time;
        
        if (empty($result) || empty($result1) || $time_diff < 0 || $result1['ip_address'] != $_SERVER['REMOTE_ADDR']) {
            //this condition run when ip address is not matched
            if (!empty($result1)) {
                // delete user entry from table entry_door_front_shopping_data
                $this->comman_model->deleteValidUserdata($where_param);
            }
            if ($result1['ip_address'] != $_SERVER['REMOTE_ADDR'] && isset($result['id'])) {
                $this->entry_door_front_block_data->updateSessionEndTime($result['id']);
            }
            // it assign value to responce variable 
            $error['response'] = 'current-session-error';
        } else {
            // when data is matched than this condition will executed
            $shopping_data = array();
            $shopping_data['applicant']     = $result1['applicant'];
            $shopping_data['country']       = $result1['country'];
            $shopping_data['country_code']  = $result1['country_code'];
            $shopping_data['telephone']     = $result1['telephone'];
            $shopping_data['email']         = $result1['email'];
            $shopping_data['ip_address']    = $_SERVER['REMOTE_ADDR'];
            $shopping_data['created_time']  = $result1['created_time'];
            $shopping_data['remaining_time']= $time_diff;
            $session_data = array('front_validuser_data' => $shopping_data);
            $this->session->set_userdata($session_data);

            // get message from table entry_door_message to display on front end
            $entry_door_message = (object)get_user_lang_data(array('entry_door_message'),$this->lang->default_lang_id)['entry_door_message'];
            $error['response'] = 'current-session-success';
            // this code replace variable on message string
            $message1 = $entry_door_message->welcomback_back_text;
            $message1 = preg_replace('/\bAPPLICANT\b/', $result1['applicant'], $message1);
            $message2 = $entry_door_message->remaining_time_text;
            $time_dff = round($time_diff / 60);
            $message2 = preg_replace('/\bTIMEVAR\b/', $time_dff, $message2);
            $error['message1'] = $message1;
            $error['message2'] = $message2;
        }
        return $error;
    }
    
    /**
     * send_verification_code
     * 
     * This Function send and resend verification code on email and phone and update values in databases and session both.
     * @return void
     */
    function send_verification_code()
    { 

        // validation rules for the input values
        $this->form_validation->set_rules('salutation', 'Title', 'trim|required|xss_clean');
        $this->form_validation->set_rules('name', 'First Name', 'trim|required|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|numeric|min_length[8]|max_length[15]|xss_clean');
        if ($this->form_validation->run() == false) {
            $messsge = array('response' => 'input-validation', 'error' => validation_errors());
            echo json_encode($messsge);
            exit;
            
        }
        // condition to check if resend request is there or not.
        $resend = $this->input->post('resend');
        if($resend != 'true'){
            //check captcha
            $captcha = validate_captcha();
            if (isset($captcha['response']) && $captcha['response'] != 'success') {
                echo json_encode($captcha);
                exit;
            }
        }else if($resend == 'true'){
            $tempf1 = $this->security->xss_clean($this->input->post('tempf1'));
            if($tempf1){
                $ecodes = explode('-',base64_decode(base64_decode($tempf1)));
                if(checkRandomCode($ecodes[1]) == 0 || trim($ecodes[0]) != $this->security->xss_clean($this->input->post('email'))){
                    echo json_encode(array('status'=>'fail'));exit;
                }
            }else{
                echo json_encode(array('status'=>'fail'));exit;
            }

            $tempf2 = $this->security->xss_clean($this->input->post('tempf2'));
            if($tempf2){
                $ecodes = explode('-',base64_decode(base64_decode($tempf2)));
                if(checkRandomCode($ecodes[1]) == 0 || trim($ecodes[0]) != $this->security->xss_clean($this->input->post('telephone'))){
                    echo json_encode(array('status'=>'fail'));exit;
                }
            }else{
                echo json_encode(array('status'=>'fail'));exit;
            }
        }
        // This Function check if user is blocked or not using email and phone input values.
        $response = $this->checkBlockedUser();
        if (isset($response['response']) && $response['response'] != 'success') {
            echo json_encode($response);
            exit;
        }
        // This function is used to check current user details from session variables
        $existingsession = $this->checkCurrentSession();
        if (isset($existingsession['response']) && $existingsession['response'] == 'current-session-success') {
            echo json_encode($existingsession);
            exit;
        }
        // reset captcha code.
        $this->session->unset_userdata('captchaCode'); 

        // This Function is used to save and update information related to verification codes in the database table(entry_door_front_block_data)
        $resendcodeornot = $this->save_data();

        // Check if environment is production than send dynamic code else send static code.
        if (ENVIRONMENT == "production") {
            $length = 6;
            $email_randomString = substr(str_shuffle("0123456789"), 0, $length);
            $sms_randomString = substr(str_shuffle("0123456789"), 0, $length);
        } else {
            $email_randomString = getenv('TEST_EMAIL_CODE');
            $sms_randomString = getenv('TEST_SMS_CODE');
        }

        $email          = $this->input->post('email');
        $name           = $this->input->post('name');
        $salutation     = $this->input->post('salutation');
        $country        = $this->input->post('country');
        $telephone      = trim($this->input->post('telephone'));
        $country_code   = str_replace('+', '', $this->input->post('country_code'));
        $final_telephone = $country_code . ' ' . $telephone;
        $sms_telephone  = $country_code . $telephone;
        
        $config         = $this->config->item('emailconfig');

        $email_attempt = $this->security->xss_clean($this->input->post('email_attempt'));
        if($email_attempt){
            $ecodes = explode('-',base64_decode(base64_decode($email_attempt)));
            if(checkRandomCode($ecodes[1]) == 0 || strlen($email_attempt) == 1){
                echo json_encode(array('status'=>'fail'));exit;
            }
            $email_attempt = trim($ecodes[0]);
        }

        $sms_attempt = $this->security->xss_clean($this->input->post('sms_attempt'));
        if($sms_attempt){
            $ecodes = explode('-',base64_decode(base64_decode($sms_attempt)));
            if(checkRandomCode($ecodes[1]) == 0 || strlen($sms_attempt) == 1){
                echo json_encode(array('status'=>'fail'));exit;
            }
            $sms_attempt = trim($ecodes[0]);
        }

        $post_valid_email = $this->input->post('validemail');
        $post_valid_phone = $this->input->post('validphone');
        $entry_email_confirm_status = $this->session->userdata('entry_email_confirm_status');
        $entry_sms_confirm_status = $this->session->userdata('entry_sms_confirm_status');

        $actionPage = $this->input->post('action');
     
        if ($email_attempt > 3 && $sms_attempt > 3) {
            // This condition is executed email and sms attempt is greater than 3.
            $where_param = array();
            $where_param['email'] = $email;
            $where_param['country_code'] = $country_code;
            $where_param['telephone'] = $telephone;
            $block_data = array();
            $block_data['block'] = 3;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            // Add email and phone in the block list with time.
            $this->comman_model->update_column("entry_door_front_block_data", $where_param, $block_data);
            $result['result'] = 'fail';
            if ($entry_email_confirm_status == 1) {
                $result['email_attempt'] = 0;
                $result['sms_attempt'] = $sms_attempt;
            } else if ($entry_sms_confirm_status == 1) {
                $result['email_attempt'] = $email_attempt;
                $result['sms_attempt'] = 0;
            } else {
                $result['email_attempt'] = $email_attempt;
                $result['sms_attempt'] = $sms_attempt;
            }
             // Update  email and phone in the session block list.
            $block_session_emaildata = $this->session->userdata('blocked_emails');
            $blockemail_session_data = array();
            if (isset($block_session_emaildata) && $block_session_emaildata != '') {
                $blockemail_session_data['blocked_emails'] = $block_session_emaildata;
                if (!in_array($email, $block_session_emaildata)) {
                    $blockemail_session_data['blocked_emails'][] = $email;
                }
            } else {
                $blockemail_session_data['blocked_emails'][] = $email;
            }
            $this->session->set_userdata($blockemail_session_data);

            $block_session_phonedata = $this->session->userdata('blocked_phones');
            $blockphone_session_data = array();
            if (isset($block_session_phonedata) && $block_session_phonedata != '') {
                $blockphone_session_data['blocked_phones'] = $block_session_phonedata;
                if (!in_array('+' . $country_code . ' ' . $telephone, $block_session_phonedata)) {
                    $blockphone_session_data['blocked_phones'][] = '+' . $country_code . ' ' . $telephone;
                }
            } else {
                $blockphone_session_data['blocked_phones'][] = '+' . $country_code . ' ' . $telephone;
            }
            // update session values related to block data.
            $this->session->set_userdata($blockphone_session_data);

            $result['email'] = $email;
            $result['telephone'] = $final_telephone;
            $result['entry_email_confirm_status'] = $entry_email_confirm_status;
            $result['entry_sms_confirm_status'] = $entry_sms_confirm_status;
            $sessiondata = array(
                'entry_email_attempt' => 0,
                'entry_sms_attempt'   => 0
            );
            // update session values related to block data.
            $this->session->set_userdata($sessiondata);
        } else if ($email_attempt > 3) {
            // This condition is executed email attempt is greater than 3.
            $where_param = array();
            $where_param['email'] = $email;
            $where_param['country_code'] = $country_code;
            $where_param['telephone'] = $telephone;
            $block_data = array();
            $block_data['block'] = 3;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            // Add email and phone in the block list with time.
            $this->comman_model->update_column("entry_door_front_block_data", $where_param, $block_data);

            $select_param = '*';
            $block_info = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);

            $insert_data = array();
            $insert_data['edb_id'] = $block_info[0]->id;
            $insert_data['errors'] = $block_info[0]->errors;
            $insert_data['email_sents'] = $block_info[0]->email_sents;
            $insert_data['block'] = 3;
            $insert_data['dte_block'] = date("Y-m-d H:i:s", time());
            $insert_data['email_code'] = $block_info[0]->email_code;
            $insert_data['email'] = $email;
            $insert_data['applicant'] = $salutation . ' ' . $name;
            $insert_data['country'] = $country;
            $insert_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $insert_data['region'] = "Front Door";
            $insert_data['timezone'] = trim($this->input->post('timezone'));
            // Add email in the block email table.
            $this->db->insert('entry_door_block_emails', $insert_data);

            $result['result'] = 'fail';
            if ($entry_sms_confirm_status == 1) {
                $result['email_attempt'] = $email_attempt;
                $result['sms_attempt'] = 0;
            } else {
                $result['email_attempt'] = $email_attempt;
                $result['sms_attempt'] = $sms_attempt;
            }

            $block_session_emaildata = $this->session->userdata('blocked_emails');
            $blockemail_session_data = array();
            if (isset($block_session_emaildata) && $block_session_emaildata != '') {
                $blockemail_session_data['blocked_emails'] = $block_session_emaildata;
                if (!in_array($email, $block_session_emaildata)) {
                    $blockemail_session_data['blocked_emails'][] = $email;
                }
            } else {
                $blockemail_session_data['blocked_emails'][] = $email;
            }
            $this->session->set_userdata($blockemail_session_data);

            $result['email'] = $email;
            $result['telephone'] = $final_telephone;
            $result['entry_email_confirm_status'] = $entry_email_confirm_status;
            $result['entry_sms_confirm_status'] = $entry_sms_confirm_status;
            $sessiondata = array(
                'entry_email_attempt' => 0
            );
            // update session values related to block data.
            $this->session->set_userdata($sessiondata);
        } else if ($sms_attempt > 3) {
            // This condition is executed sms attempt is greater than 3.
            $where_param = array();
            $where_param['email'] = $email;
            $where_param['country_code'] = $country_code;
            $where_param['telephone'] = $telephone;
            $block_data = array();
            $block_data['block'] = 3;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            // update data in block table.
            $this->comman_model->update_column("entry_door_front_block_data", $where_param, $block_data);

            $select_param = '*';
            $block_info = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);

            $insert_data = array();
            $insert_data['edb_id'] = $block_info[0]->id;
            $insert_data['errors'] = $block_info[0]->errors;
            $insert_data['sms_sents'] = $block_info[0]->sms_sents;
            $insert_data['block'] = 3;
            $insert_data['dte_block'] = date("Y-m-d H:i:s", time());
            $insert_data['sms_code'] = $block_info[0]->sms_code;
            $insert_data['applicant'] = $salutation . ' ' . $name;
            $insert_data['country'] = $country;
            $insert_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $insert_data['country_code'] = $country_code;
            $insert_data['telephone'] = $telephone;
            $insert_data['region'] = "Front Door";
            $insert_data['timezone'] = trim($this->input->post('timezone'));
             // Add phone in the block phone table.
            $this->db->insert('entry_door_block_phones', $insert_data);

            $result['result'] = 'fail';
            if ($entry_email_confirm_status == 1) {
                $result['email_attempt'] = 0;
                $result['sms_attempt'] = $sms_attempt;
            } else {
                $result['email_attempt'] = $email_attempt;
                $result['sms_attempt'] = $sms_attempt;
            }
            // update session variables.
            $block_session_phonedata = $this->session->userdata('blocked_phones');
            $blockphone_session_data = array();
            if (isset($block_session_phonedata) && $block_session_phonedata != '') {
                $blockphone_session_data['blocked_phones'] = $block_session_phonedata;
                if (!in_array('+' . $country_code . ' ' . $telephone, $block_session_phonedata)) {
                    $blockphone_session_data['blocked_phones'][] = '+' . $country_code . ' ' . $telephone;
                }
            } else {
                $blockphone_session_data['blocked_phones'][] = '+' . $country_code . ' ' . $telephone;
            }

            $this->session->set_userdata($blockphone_session_data);

            $result['email'] = $email;
            $result['telephone'] = $final_telephone;
            $result['entry_email_confirm_status'] = $entry_email_confirm_status;
            $result['entry_sms_confirm_status'] = $entry_sms_confirm_status;
            $sessiondata = array(
                'entry_sms_attempt' => 0
            );
            // update session values related to block data.
            $this->session->set_userdata($sessiondata);
        } else {
            // This Condition executed when email and sms attempt is less than 3.
            $sel_param = "*";
            $whr_param['email'] = $email;
            $whr_param['country_code'] = $country_code;
            $whr_param['telephone'] = $telephone;
            $bdata = $this->comman_model->get_row("entry_door_front_block_data", $sel_param, $whr_param);
            $validphone = '';
            if (isset($entry_email_confirm_status) && $entry_email_confirm_status == 1 && isset($entry_sms_confirm_status) && $entry_sms_confirm_status == 1) {
                // This condition run when email and sms both otp needs to confirmed.
                $email_randomString = $bdata[0]->email_code;
                $sms_randomString = $bdata[0]->sms_code;
                $result['validphone'] = 1;
                $result['validemail'] = 1;
            } else if (isset($entry_email_confirm_status) && $entry_email_confirm_status == 1) {
                // This condition run when only sms  otp needs to send and email code is confirmed.
                if ($resendcodeornot != 'none') {
                    $email_randomString = $bdata[0]->email_code;
                    $validphone = 0;
                    if (ENVIRONMENT == "production") {
                        // vaildate the phone number using the third party Api
                        $validphone = validatePhone($sms_telephone);
                        if($validphone){
                            // This Function send sms code to the phone number via sms
                            sentSmsCode($sms_randomString, $sms_telephone, $country_code);
                            $result['validemail'] = 1;
                            $result['validphone'] = 1;
                            $result['block_step'] = 1;
                        }else{
                            $blocked = array();
                            $blocked['phone_blocked'] = '1';
                            $whr_param['email'] = $email;
                            $whr_param['country_code'] = $country_code;
                            $whr_param['telephone'] = $telephone;
                            $this->comman_model->update_column("entry_door_front_block_data", $whr_param, $blocked);
                            $result['validemail'] = 1;
                            $result['validphone'] = 0;
                            $result['block_step'] = 2;
                        }
                    } else {
                        $result['validemail'] = 1;
                        $result['validphone'] = 1;
                        $result['block_step'] = 1;
                    }
                } else {
                    $result['validemail'] = $post_valid_email;
                    $result['validphone'] = $post_valid_phone;
                }
            } else if (isset($entry_sms_confirm_status) && $entry_sms_confirm_status == 1) {
                // This condition run when only email  otp needs to send and sms is confirmed.
                if ($resendcodeornot != 'none') {
                    $sms_randomString = $bdata[0]->sms_code;
                    $validphone = 1;
                    if (ENVIRONMENT == "production") {
                        // This Function send email otp code to the user email by sending email.
                        $validemail = sentEmailCode($email_randomString, $email, $final_telephone, $name, $email_attempt, $entry_sms_confirm_status, $validphone, $actionPage);
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
                        $whr_param['email'] = $email;
                        $whr_param['country_code'] = $country_code;
                        $whr_param['telephone'] = $telephone;
                        $this->comman_model->update_column("entry_door_front_block_data", $whr_param, $blocked);
                        $result['validemail'] = 0;
                        $result['validphone'] = 1;
                        $result['block_step'] = 2;
                    }
                } else {
                    $result['validemail'] = $post_valid_email;
                    $result['validphone'] = $post_valid_phone;
                }
            } else {
                if ($resendcodeornot != 'none') {
                    $result['validphone'] = 1;
                    if (ENVIRONMENT == "production") {
                        // vaildate the phone number using the third party Api
                        $validphone = validatePhone($sms_telephone);
                        if ($validphone) {
                            // This Function send sms code to the phone number via sms
                            sentSmsCode($sms_randomString, $sms_telephone, $country_code);
                        } else {
                            $blocked = array();
                            $blocked['phone_blocked'] = '1';
                            $whr_param['email'] = $email;
                            $whr_param['country_code'] = $country_code;
                            $whr_param['telephone'] = $telephone;
                            $this->comman_model->update_column("entry_door_front_block_data", $whr_param, $blocked);
                            $result['validphone'] = 0;
                        }
                    }

                    if (ENVIRONMENT == "production") {
                        // This Function send email otp code to the user email by sending email.
                        $validemail = sentEmailCode($email_randomString, $email, $final_telephone, $name, $email_attempt, $entry_sms_confirm_status, $validphone, $actionPage);
                    } else {
                        $validemail = 1;
                    }

                    if ($validemail) {
                        $result['validemail'] = 1;
                    } else {
                        $blocked = array();
                        $blocked['email_blocked'] = '1';
                        $whr_param['email'] = $email;
                        $whr_param['country_code'] = $country_code;
                        $whr_param['telephone'] = $telephone;
                        $this->comman_model->update_column("entry_door_front_block_data", $whr_param, $blocked);
                        $result['validemail'] = 0;
                    }
                } else {
                    $result['validemail'] = $post_valid_email;
                    $result['validphone'] = $post_valid_phone;
                }
            }
            // Save random number, attempt numbers for email and sms in the sessions.
            if ($resendcodeornot != 'none') {
                $session_data = array(
                    'email_randomString' => $email_randomString,
                    'sms_randomString' => $sms_randomString,
                    'entry_email_attempt' => $email_attempt,
                    'entry_sms_attempt' => $sms_attempt,
                    'validemail' => $result['validemail'],
                    'validphone' => $result['validphone']
                );

                $this->session->set_userdata($session_data);

                $where_param = array();
                $where_param['email'] = $email;
                $where_param['country_code'] = $country_code;
                $where_param['telephone'] = $telephone;
                $select_param = array('email_sents' => 'email_sents', 'sms_sents' => 'sms_sents');
                $block_info = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);
                $block_data = array();
                if ($entry_email_confirm_status != 1) {
                    $block_data['email_sents'] = $block_info[0]->email_sents + 1;
                }
                if ($entry_sms_confirm_status != 1) {
                    $block_data['sms_sents'] = $block_info[0]->sms_sents + 1;
                }
                $block_data['email_code'] = $email_randomString;
                $block_data['sms_code'] = $sms_randomString;
                // update random codes for sms and email in database.
                $this->comman_model->update_column("entry_door_front_block_data", $where_param, $block_data);

                $where_param = array(
                    'str_email'         => $email,
                    'str_country_code'  => $country_code,
                    'str_telephone'     => $telephone
                );
                $updateBlock = array(
                    'str_code'      => $email_randomString,
                    'str_sms_code'  => $sms_randomString
                );
                // update random codes  in database.
                $this->comman_model->update_column("block_email_list", $where_param, $updateBlock);

                $where_param = array();
                $where_param['email'] = $email;
                $select_param = array('email_sents' => 'email_sents');
                $block_info = $this->comman_model->get_row("entry_door_block_emails", $select_param, $where_param);
                $block_data = array();
                if ($entry_email_confirm_status != 1) {
                    $email_sents = isset($block_info[0]->email_sents) ? $block_info[0]->email_sents : 0;
                    $block_data['email_sents'] = $email_sents + 1;
                }
                $block_data['email_code'] = $email_randomString;
                // update email attempt number  in database.
                $this->comman_model->update_column("entry_door_block_emails", $where_param, $block_data);

                $where_param = array();
                $where_param['country_code'] = $country_code;
                $where_param['telephone'] = $telephone;
                $select_param = array('sms_sents' => 'sms_sents');
                $block_info = $this->comman_model->get_row("entry_door_block_phones", $select_param, $where_param);
                $block_data = array();
                if ($entry_sms_confirm_status != 1) {
                    $sms_sents = isset($block_info[0]->sms_sents) ? $block_info[0]->sms_sents : 0;
                    $block_data['sms_sents'] = $sms_sents + 1;
                }
                $block_data['sms_code'] = $sms_randomString;
                  // update sms attempt number  in database.
                $this->comman_model->update_column("entry_door_block_phones", $where_param, $block_data);
            }else{
                $sessiondata = array(
                    'entry_email_attempt' => $email_attempt,
                    'entry_sms_attempt'   => $sms_attempt
                );
                $this->session->set_userdata($sessiondata);
            }

            $result['result'] = 'true';
            $result['email_attempt'] = $email_attempt;
            $result['sms_attempt'] = $sms_attempt;
            $result['email'] = $email;
            $result['telephone'] = $final_telephone;
            $result['entry_email_confirm_status'] = $entry_email_confirm_status;
            $result['entry_sms_confirm_status'] = $entry_sms_confirm_status;
        }
        //This Function is used to get values of messages and timer from table entry_door_timer
        $pop_info = $this->get_entry_pop_time();

        if (!empty($bdata) && $bdata[0]->created_time != '') {
            $bal_time = time() - $bdata[0]->created_time;
            $remaining_time = $pop_info["main_entry_door_timer"] - $bal_time;
            if ($remaining_time > 0) {
                $result["main_entry_door_timer"] = $remaining_time;
            } else {
                $result["main_entry_door_timer"] = $pop_info["main_entry_door_timer"];
            }
        } else {
            $result["main_entry_door_timer"] = $pop_info["main_entry_door_timer"];
        }
        $result["main_entry_door_msg"] = $pop_info["main_entry_door_msg"];
        $result["entry_door_popup_timer"] = $pop_info["entry_door_popup_timer"];
        $result["entry_door_popup_msg"] = $pop_info["entry_door_popup_msg"];
        // return values in json format
        echo json_encode($result);
        exit;
    }
    
    /**
     * get_entry_pop_time
     *
     * This Function is used to get values of messages and timer from table entry_door_timer. Values of this table is manageble from the admin side.
     * @return array
     */
    function get_entry_pop_time()
    {
        
        $timer = (object)get_user_lang_data(array('entry_door_timer'),$this->lang->default_lang_id)['entry_door_timer'];
        $pop_info["main_entry_door_timer"]  = $timer->main_entry_door_timer * 60;
        $pop_info["main_entry_door_msg"]    = $timer->main_entry_door_msg;
        $pop_info['entry_door_popup_timer'] = $timer->entry_door_popup_timer * 60;
        $pop_info['entry_door_popup_msg']   = $timer->entry_door_popup_msg;
        return $pop_info;
    }
    
    /**
     * blockedemailsms_check
     *
     * This Function validate the email and phone both are blocked or not.
     * @param  mixed $email
     * @return void
     */
    function blockedemailsms_check($email = '')
    {
        $result = array();
        // save email and phone post variables 
        $email        = $this->input->post('email');
        $country_code = str_replace('+', '', $this->input->post('country_code'));
        $telephone    = trim($this->input->post('telephone'));

        $old_block_emails = array();
        $session_data = $this->session->userdata('entry_users_data') ? $this->session->userdata('entry_users_data') : array();
        if(count($session_data) > 0){
            $where_param  = array();
            $where_param['email']        = $session_data['email'];
            $where_param['country_code'] = $session_data['country_code'];
            $where_param['telephone']    = $session_data['telephone'];
            $select_param = "*";
            // get records from table entry_door_front_block_data using session email and phone number
            $old_block_emails = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);
        }

        $where_param = array();
        $where_param['email']        = $email;
        $where_param['country_code'] = $country_code;
        $where_param['telephone']    = $telephone;
        $select_param = "*";
        // get records from table entry_door_front_block_data using input email and phone number
        $block_emails = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);

        $where_param = array();
        $where_param['email'] = $email;
        $select_param = "*";
        // get block email records from table entry_door_block_emails using input email 
        $blockemail_info = $this->comman_model->get_row("entry_door_block_emails", $select_param, $where_param);

        $where_param = array();
        $where_param['country_code'] = $country_code;
        $where_param['telephone'] = $telephone;
        $select_param = "*";
        // get block phone records from table entry_door_block_phones using input phone 
        $blockphone_info = $this->comman_model->get_row("entry_door_block_phones", $select_param, $where_param);

        $where_param = array();
        $where_param['str_email']        = $email;
        $where_param['str_country_code'] = $country_code;
        $where_param['str_telephone']    = $telephone;
        $select_param = "*";
        // get block email  records from table block_email_list using input email 
        $cart_blocks = $this->comman_model->get_row("block_email_list", $select_param, $where_param);

        $where_param = array();
        $where_param['str_email'] = $email;
        $select_param = "*";
        // get block email  records from table cart_block_emails using input email 
        $cartblockemail_info = $this->comman_model->get_row("cart_block_emails", $select_param, $where_param);

        $where_param = array();
        $where_param['str_country_code'] = $country_code;
        $where_param['str_telephone'] = $telephone;
        $select_param = "*";
        // get block phone records from table cart_block_phones using input phone 
        $cartblockphone_info = $this->comman_model->get_row("cart_block_phones", $select_param, $where_param);
        
        // get login page timer values from table entry_door_timer.
        $entry_door_timer = (object)get_user_lang_data(array('entry_door_timer'),$this->lang->default_lang_id)['entry_door_timer'];
        $blockdoortime = '-' . $entry_door_timer->entry_door_block_timer . ' minute';


        /*
        * Above code get block data records related to email and phone from 6 database tables.
        * Below are 8 conditions related to these records.
        * if any email and phone is exist in any of these tables. 
        * Than system check if the block time is over than the email or phone is valid. 
        * Else email or phone is not valid.
        */
        if (!empty($block_emails)) {
            // if email and phone record exist in the entry_door_front_block_data than this condition work
            foreach ($block_emails as $each_email) {

                $date = date("Y-m-d H:i:s", time());
                $datelimit = strtotime($blockdoortime, strtotime($date));
                $datelimit = date("Y-m-d H:i:s", $datelimit);

                if (isset($each_email->dte_block) && $each_email->dte_block != '' && $datelimit > $each_email->dte_block) {
                    // if block time limit is over than function make email and phone valid

                    $where_param = array();
                    $where_param['email'] = $each_email->email;
                    $where_param['country_code'] = $each_email->country_code;
                    $where_param['telephone'] = $each_email->telephone;
                    $this->comman_model->delete_row("entry_door_front_block_data", $where_param);
                    $result['result'] = 'success';
                } else {
                    // if block time limit is not over than function make email and phone invalid

                    $block = strtotime($each_email->dte_block);
                    $check_time_block = $entry_door_timer->entry_door_block_timer - intval(((time() - $block) / 60));
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
                $check_time_block = $entry_door_timer->entry_door_block_timer - intval(((time() - $block) / 60));
                $region = "Front Door";

                if ($old_block_emails[0]->entry_email_confirm != 1 && $old_block_emails[0]->entry_sms_confirm != 1) {
                    $result['result'] = 'fail';
                    $result['error'] = 'all';
                    $result['check_time_block'] = $check_time_block;
                    $result['region'] = $region;
                    $result['email'] = $blockemail_info[0]->email;
                    $result['telephone'] = '+' . $blockphone_info[0]->country_code . ' ' . $blockphone_info[0]->telephone;
                } else if ($old_block_emails[0]->entry_email_confirm != 1) {
                    $result['result'] = 'fail';
                    $result['error'] = 'email';
                    $result['check_time_block'] = $check_time_block;
                    $result['region'] = $region;
                    $result['email'] = $blockemail_info[0]->email;
                    $result['telephone'] = '';
                } else if ($old_block_emails[0]->entry_sms_confirm != 1) {
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
                $check_time_block = $entry_door_timer->entry_door_block_timer - intval(((time() - $block) / 60));
                $region = "Front Door";
                if ($old_block_emails[0]->entry_email_confirm != 1) {
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
                $check_time_block = $entry_door_timer->entry_door_block_timer - intval(((time() - $block) / 60));
                $region = "Front Door";

                if ($old_block_emails[0]->entry_sms_confirm != 1) {
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
                    $check_time_block = $entry_door_timer->entry_door_block_timer - intval(((time() - $block) / 60));
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
                $where_param['str_email'] = $cartblockemail_info[0]->str_email;
                $this->comman_model->delete_row("cart_block_emails", $where_param);

                $where_param = array();
                $where_param['str_country_code'] = $cartblockphone_info[0]->str_country_code;
                $where_param['str_telephone'] = $cartblockphone_info[0]->str_telephone;
                $this->comman_model->delete_row("cart_block_phones", $where_param);
                $result['result'] = 'success';
            } else {
                $block = strtotime($cartblockemail_info[0]->dte_block);
                $check_time_block = $entry_door_timer->entry_door_block_timer - intval(((time() - $block) / 60));
                $region = "Cart";

                if ($old_block_emails[0]->entry_email_confirm != 1 && $old_block_emails[0]->entry_sms_confirm != 1) {
                    $result['result'] = 'fail';
                    $result['error'] = 'all';
                    $result['check_time_block'] = $check_time_block;
                    $result['region'] = $region;
                    $result['email'] = $cartblockemail_info[0]->str_email;
                    $result['telephone'] = '+' . $cartblockphone_info[0]->str_country_code . ' ' . $cartblockphone_info[0]->str_telephone;
                } else if ($old_block_emails[0]->entry_email_confirm != 1) {
                    $result['result'] = 'fail';
                    $result['error'] = 'email';
                    $result['check_time_block'] = $check_time_block;
                    $result['region'] = $region;
                    $result['email'] = $cartblockemail_info[0]->str_email;
                    $result['telephone'] = '';
                } else if ($old_block_emails[0]->entry_sms_confirm != 1) {
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
                $where_param['str_email'] = $cartblockemail_info[0]->email;
                $this->comman_model->delete_row("cart_block_emails", $where_param);
                $result['result'] = 'success';
            } else {
                $block = strtotime($cartblockemail_info[0]->dte_block);
                $check_time_block = $entry_door_timer->entry_door_block_timer - intval(((time() - $block) / 60));
                $region = "Cart";
                if ($old_block_emails[0]->entry_email_confirm != 1) {
                    $result['result'] = 'fail';
                    $result['error'] = 'email';
                    $result['check_time_block'] = $check_time_block;
                    $result['region'] = $region;
                    $result['email'] = $cartblockemail_info[0]->email;
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
                $check_time_block = $entry_door_timer->entry_door_block_timer - intval(((time() - $block) / 60));
                $region = "Cart";

                if ($old_block_emails[0]->entry_sms_confirm != 1) {
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
            // if email and phone does not exist in any of above tables or conditions than functions return success which means both are valid.
            $result['result'] = 'success';
        }
        echo json_encode($result);
        exit;
    }
    
    /**
     * save_entry_details
     *
     * This Function called on confirm verification code of email and password.
     * @return void
     */
    function save_entry_details()
    {
        $result = array();
        $entry_email_attempt = $this->session->userdata('entry_email_attempt');
        if ($entry_email_attempt == '')
            $entry_email_attempt = 0;

        $entry_sms_attempt = $this->session->userdata('entry_sms_attempt');
        if ($entry_sms_attempt == '')
            $entry_sms_attempt = 0;

        if ($entry_email_attempt > 3)
            $entry_email_attempt = 0;

        if ($entry_sms_attempt > 3)
            $entry_sms_attempt = 0;
        // read email verification code from session  and post variable
        $email_details = $this->session->userdata('email_randomString');
        $email_verification_code = trim($this->input->post('entry_verification_codemail'));
        // read sms verification code from session  and post variable
        $sms_details = $this->session->userdata('sms_randomString');
        $sms_verification_code = trim($this->input->post('entry_verification_codesms'));
        $valid_email = trim($this->input->post('valid_email'));
        $valid_phone = trim($this->input->post('valid_phone'));
        
        // if post email and sms code both are matched with code which is sent via email and sms than this condition will executed
        if ($email_verification_code == $email_details && $sms_verification_code == $sms_details) {
            $entry_users_data = $this->session->userdata('entry_users_data');
            $where_param = array();
            $where_param['email']        = $entry_users_data['email'];
            $where_param['country_code'] = $entry_users_data['country_code'];
            $where_param['telephone']    = $entry_users_data['telephone'];

            $select_param = '*';
            $block_info = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);
            // delete record from block data table related to email and phone
            $this->comman_model->delete_row("entry_door_front_block_data", $where_param);

            $shopping_data = array();
            $shopping_data['applicant']     = $entry_users_data['user_name'];
            $shopping_data['country']       = $entry_users_data['country'];
            $shopping_data['country_code']  = $entry_users_data['country_code'];
            $shopping_data['telephone']     = $entry_users_data['telephone'];
            $shopping_data['email']         = $entry_users_data['email'];
            $shopping_data['ip_address']    = $_SERVER['REMOTE_ADDR'];
            $shopping_data['created_time']  = time();
            // Add record in the table  entry_door_front_shopping_data
            $this->comman_model->insert_column("entry_door_front_shopping_data", $shopping_data);
            $session_data = array('front_validuser_data' => $shopping_data);
            $this->session->set_userdata($session_data);

            $where_param = array();
            $where_param['id'] = 1;
            $entry_door_timer = (object)get_user_lang_data(array('entry_door_timer'),$this->lang->default_lang_id)['entry_door_timer'];
            $shopping_data['timezone']       = trim($this->input->post('timezone'));
            $shopping_data['shopping_timer'] = $entry_door_timer->entry_door_shopping_timer;
            $this->comman_model->insert_column("users_front_entry_door", $shopping_data);
            // This Function clear all session variable which are used while validating the email and phone
            $this->clear_user_session_final();
            $result['result'] = 'success';
            $result['email_attempt']              = $entry_email_attempt;
            $result['sms_attempt']                = $entry_sms_attempt;
            $result['entry_email_confirm_status'] = '1';
            $result['entry_sms_confirm_status']   = '1';
            $entry_email_attempt = 0;
            $entry_sms_attempt = 0;
        } else if ($email_verification_code == $email_details && $entry_sms_attempt < 3) {
            // if post email code only matched  and sms code is not matched than this condition will executed
            $entry_email_attempt = 0;
            $where_param = array();
            $session_user = $this->session->userdata("entry_users_data");
            $where_param['email'] = $session_user['email'];
            $where_param['country_code'] = $session_user['country_code'];
            $where_param['telephone'] = $session_user['telephone'];
            $select_param = '*';
            $block_info = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);
            $block_data = array();
            $block_data['errors'] = $block_info[0]->errors + 1;
            $block_data['entry_email_confirm'] = '1';
            $this->comman_model->update_column("entry_door_front_block_data", $where_param, $block_data);
            // update email confirm status in session
            $session_data_email = array(
                'entry_email_confirm' => $session_user['email'],
                'entry_email_confirm_status' => '1'
            );
            $this->session->set_userdata($session_data_email);
            // set variable values as per conditions to return as json
            $result['result'] = 'fail';
            $result['email_attempt'] = 0;
            $result['block_email'] = $session_user['email'];
            if ($valid_phone != 1) {
                $entry_sms_attempt = 0;
                $result['valid_phone'] = 0;
                $result['valid_email'] = 1;
                $result['sms_attempt'] = 0;
            } else {
                $entry_sms_attempt++;
                $result['valid_phone'] = 1;
                $result['valid_email'] = 1;
                $result['sms_attempt'] = $entry_sms_attempt;
            }
            $result['block_sms'] = '+' . $session_user['country_code'] . ' ' . $session_user['telephone'];
            $result['entry_email_confirm_status'] = '1';
            if ($block_info[0]->dte_block != '' || $block_info[0]->phone_blocked == 1 || $block_info[0]->entry_email_confirm == 1) {
                $result['block_step'] = '2';
            } else {
                $result['block_step'] = '1';
            }
        } else if ($sms_verification_code == $sms_details && $entry_email_attempt < 3) {
            // if post sms code only matched  and email  code is not matched than this condition will executed

            $entry_sms_attempt = 0;
            $where_param = array();
            $session_user = $this->session->userdata("entry_users_data");
            $where_param['email'] = $session_user['email'];
            $where_param['country_code'] = $session_user['country_code'];
            $where_param['telephone'] = $session_user['telephone'];
            $select_param = '*';
            $block_info = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);
            $block_data = array();
            $block_data['errors'] = $block_info[0]->errors + 1;
            $block_data['entry_sms_confirm'] = '1';
            $this->comman_model->update_column("entry_door_front_block_data", $where_param, $block_data);
            // update sms confirm status on session variable
            $session_data_sms = array(
                'entry_sms_confirm' => '+' . $session_user['country_code'] . ' ' . $session_user['telephone'],
                'entry_sms_confirm_status' => '1'
            );
            $this->session->set_userdata($session_data_sms);
            // set variable values as per conditions to return as json
            $result['result'] = 'fail';
            if ($valid_email != 1) {
                $entry_email_attempt = 0;
                $result['valid_phone'] = 1;
                $result['valid_email'] = 0;
                $result['email_attempt'] = 0;
            } else {
                $entry_email_attempt++;
                $result['valid_phone'] = 1;
                $result['valid_email'] = 1;
                $result['email_attempt'] = $entry_email_attempt;
            }
            $result['block_email'] = $session_user['email'];
            $result['sms_attempt'] = 0;
            $result['block_sms'] = '+' . $session_user['country_code'] . ' ' . $session_user['telephone'];
            $result['entry_sms_confirm_status'] = '1';
            if ($block_info[0]->dte_block != '' || $block_info[0]->email_blocked == 1 || $block_info[0]->entry_sms_confirm == 1) {
                $result['block_step'] = '2';
            } else {
                $result['block_step'] = '1';
            }
        } else {
            // if both email and sms code is not matched than condition will executed 
            if ($entry_email_attempt > 2 || $entry_sms_attempt > 2) {
                $entry_email_attempt++;
                $entry_sms_attempt++;

                $where_param = array();
                $session_user = $this->session->userdata("entry_users_data");
                $where_param['email'] = $session_user['email'];
                $where_param['country_code'] = $session_user['country_code'];
                $where_param['telephone'] = $session_user['telephone'];

                $block_data = array();
                $block_data['block'] = 2;
                $block_data['dte_block'] = date("Y-m-d H:i:s", time());
                // update block table with error code
                $this->comman_model->update_column("entry_door_front_block_data", $where_param, $block_data);

                $select_param = '*';
                $block_info = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);

                if ($entry_email_attempt > 2) {
                    // if email confirm attempt is greater than 2 than this condition will execute
                    $insert_data = array();
                    $insert_data['edb_id'] = $block_info[0]->id;
                    $insert_data['errors'] = $block_info[0]->errors;
                    $insert_data['email_sents'] = $block_info[0]->email_sents;
                    $insert_data['block'] = 2;
                    $insert_data['dte_block'] = date("Y-m-d H:i:s", time());
                    $insert_data['email_code'] = $block_info[0]->email_code;
                    $insert_data['email'] = $session_user['email'];
                    $insert_data['applicant'] = $session_user['user_name'];
                    $insert_data['country'] = $session_user['country'];
                    $insert_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
                    $insert_data['region'] = "Front Door";
                    $insert_data['timezone'] = trim($this->input->post('timezone'));
                    // Add entry in block email table with errors 
                    $this->db->insert('entry_door_block_emails', $insert_data);
                    

                    // Add email in blocked emails list of session
                    $block_session_emaildata = $this->session->userdata('blocked_emails');
                    $blockemail_session_data = array();
                    if (isset($block_session_emaildata) && $block_session_emaildata != '') {
                        $blockemail_session_data['blocked_emails'] = $block_session_emaildata;
                        if (!in_array($session_user['email'], $block_session_emaildata)) {
                            $blockemail_session_data['blocked_emails'][] = $session_user['email'];
                        }
                    } else {
                        $blockemail_session_data['blocked_emails'][] = $session_user['email'];
                    }
                    $this->session->set_userdata($blockemail_session_data);
                }
                if ($entry_sms_attempt > 2) {
                  // if sms confirm attempt is greater than 2 than this condition will execute
                    $insert_data = array();
                    $insert_data['edb_id'] = $block_info[0]->id;
                    $insert_data['errors'] = $block_info[0]->errors;
                    $insert_data['sms_sents'] = $block_info[0]->sms_sents;
                    $insert_data['block'] = 2;
                    $insert_data['dte_block'] = date("Y-m-d H:i:s", time());
                    $insert_data['sms_code'] = $block_info[0]->sms_code;
                    $insert_data['applicant'] = $session_user['user_name'];
                    $insert_data['country'] = $session_user['country'];
                    $insert_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
                    $insert_data['country_code'] = $session_user['country_code'];
                    $insert_data['telephone'] = $session_user['telephone'];
                    $insert_data['region'] = "Front Door";
                    $insert_data['timezone'] = trim($this->input->post('timezone'));
                    // Add entry in block phone table with errors 
                    $this->db->insert('entry_door_block_phones', $insert_data);
                    // Add phone in blocked phone list of session
                    $block_session_phonedata = $this->session->userdata('blocked_phones');
                    $blockphone_session_data = array();
                    if (isset($block_session_phonedata) && $block_session_phonedata != '') {
                        $blockphone_session_data['blocked_phones'] = $block_session_phonedata;
                        if (!in_array('+' . $session_user['country_code'] . ' ' . $session_user['telephone'], $block_session_phonedata)) {
                            $blockphone_session_data['blocked_phones'][] = '+' . $session_user['country_code'] . ' ' . $session_user['telephone'];
                        }
                    } else {
                        $blockphone_session_data['blocked_phones'][] = '+' . $session_user['country_code'] . ' ' . $session_user['telephone'];
                    }

                    $this->session->set_userdata($blockphone_session_data);
                }
                $block_data = array();
                $block_data['block'] = 2;
                $block_data['dte_block'] = date("Y-m-d H:i:s", time());
                // update block table with error code
                $this->comman_model->update_column("entry_door_front_block_data", $where_param, $block_data);
            } else {
                $entry_email_attempt++;
                $entry_sms_attempt++;

                $where_param = array();
                $session_user = $this->session->userdata("entry_users_data");
                $where_param['email'] = $session_user['email'];
                $where_param['country_code'] = $session_user['country_code'];
                $where_param['telephone'] = $session_user['telephone'];
                $select_param = array('errors' => 'errors');
                $block_info = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);
                $block_data = array();
                $block_data['errors'] = $block_info[0]->errors + 1;
                // update block table with error code
                $this->comman_model->update_column("entry_door_front_block_data", $where_param, $block_data);
            }
            // set variable values as per conditions to return as json
            $result['result'] = 'fail';

            if ($valid_email != 1 && $valid_phone == 1) {
                $result['valid_email'] = 0;
                $result['valid_phone'] = 1;
                $result['email_attempt'] = 0;
                $result['sms_attempt'] = $entry_sms_attempt;
            } else if ($valid_phone != 1 && $valid_email == 1) {
                $result['valid_email'] = 1;
                $result['valid_phone'] = 0;
                $result['email_attempt'] = $entry_email_attempt;
                $result['sms_attempt'] = 0;
            } else {
                $result['valid_email'] = 1;
                $result['valid_phone'] = 1;
                $result['email_attempt'] = $entry_email_attempt;
                $result['sms_attempt'] = $entry_sms_attempt;
            }

            $result['block_email'] = $session_user['email'];
            $result['block_sms'] = '+' . $session_user['country_code'] . ' ' . $session_user['telephone'];
            $result['entry_email_confirm_status'] = '';
            $result['entry_sms_confirm_status'] = '';
        }
        // update session variables and return json
        $session_data_attempt = array(
            'entry_email_attempt' => $entry_email_attempt,
            'entry_sms_attempt' => $entry_sms_attempt,
        );
        $this->session->set_userdata($session_data_attempt);
        echo json_encode($result);
        exit;
    }
    
    /**
     * block_user_timeout
     *
     * This Function is called when timer is finshed on front end and due to timeout system blocked the user.
     * @return void
     */
    function block_user_timeout()
    {
        // read current user session variable
        $entry_users_data = $this->session->userdata('entry_users_data') ? $this->session->userdata('entry_users_data') : array();
        if(count($entry_users_data) == 0){
            $entry_users_data = $this->session->userdata('front_validuser_data');
            $entry_users_data['user_name'] = $entry_users_data['applicant'];
        }
        
        $where_param = array();
        $where_param['email']        = $entry_users_data['email'];
        $where_param['country_code'] = $entry_users_data['country_code'];
        $where_param['telephone']    = $entry_users_data['telephone'];

        $select_param = array('*');
        // get data from the block table using email and phone
        $block_info = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);

        $where_param = array();
        $where_param['email'] = $entry_users_data['email'];

        $select_param = array('*');
        // get data from block email table using email 
        $blockemail_info = $this->comman_model->get_row("entry_door_block_emails", $select_param, $where_param);

        $where_param = array();
        $where_param['country_code'] = $entry_users_data['country_code'];
        $where_param['telephone'] = $entry_users_data['telephone'];

        $select_param = array('*');
        // get data from block email table using email 
        $blockphone_info = $this->comman_model->get_row("entry_door_block_phones", $select_param, $where_param);

        //This Function is used to get values of messages and timer from table entry_door_timer
        $entry_door_timer = (object)get_user_lang_data(array('entry_door_timer'),$this->lang->default_lang_id)['entry_door_timer'];
        // if email and phone exist in the block table
        if (!empty($block_info)) {

            // if email is not exist in the entry_door_block_emails table and  email is not equal to the entry_door_front_block_data table email than add email in the entry_door_block_emails table
            if (empty($blockemail_info) || $block_info[0]->email != $entry_users_data['email']) {
                $insert_data = array();
                $insert_data['edb_id'] = $block_info[0]->id;
                $insert_data['errors'] = $block_info[0]->errors;
                $insert_data['email_sents'] = $block_info[0]->email_sents;
                $insert_data['block'] = 5;
                $insert_data['dte_block'] = date("Y-m-d H:i:s", time());
                $insert_data['email_code'] = $block_info[0]->email_code;
                $insert_data['email'] = $entry_users_data['email'];
                $insert_data['applicant'] = $entry_users_data['user_name'];
                $insert_data['country'] = $entry_users_data['country'];
                $insert_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
                $insert_data['region'] = "Front Door";
                $insert_data['timezone'] = trim($this->input->post('block_timezone'));
                // this function add email in the entry_door_block_emails table
                $this->db->insert('entry_door_block_emails', $insert_data);
            }
            // if phone is not exist in the entry_door_block_phones table and  phone is not equal to the entry_door_front_block_data table phone than add phone in the entry_door_block_phones table
            if (empty($blockphone_info) || ($block_info[0]->country_code != $entry_users_data['country_code'] && $block_info[0]->telephone != $entry_users_data['telephone'])) {
                $insert_data = array();
                $insert_data['edb_id'] = $block_info[0]->id;
                $insert_data['errors'] = $block_info[0]->errors;
                $insert_data['sms_sents'] = $block_info[0]->sms_sents;
                $insert_data['block'] = 5;
                $insert_data['dte_block'] = date("Y-m-d H:i:s", time());
                $insert_data['sms_code'] = $block_info[0]->sms_code;
                $insert_data['applicant'] = $entry_users_data['user_name'];
                $insert_data['country'] = $entry_users_data['country'];
                $insert_data['country_code'] = $entry_users_data['country_code'];
                $insert_data['telephone'] = $entry_users_data['telephone'];
                $insert_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
                $insert_data['region'] = "Front Door";
                $insert_data['timezone'] = trim($this->input->post('block_timezone'));
                // this function add phone in the entry_door_block_phones table
                $this->db->insert('entry_door_block_phones', $insert_data);
            }
            if ($block_info[0]->dte_block == '' || $block_info[0]->dte_block == NULL) {
                $block_data = array();
                $block_data['block'] = 5;
                $block_data['dte_block'] = date("Y-m-d H:i:s", time());
                // if date and time is empty in the entry_door_front_block_data than update it
                $this->comman_model->update_column("entry_door_front_block_data", $where_param, $block_data);
            }
        } else {
            $block_data = array();
            $block_data['errors'] = 0;
            $block_data['email_sents'] = 0;
            $block_data['sms_sents'] = 0;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            $block_data['block'] = 5;
            $block_data['email'] = $entry_users_data['email'];
            $block_data['applicant'] = $entry_users_data['user_name'];
            $block_data['country'] = $entry_users_data['country'];
            $block_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $block_data['country_code'] = $entry_users_data['country_code'];
            $block_data['telephone'] = $entry_users_data['telephone'];
            $block_data['region'] = "Entry Door";
            $block_data['created_time'] = time();
            // Add entry in the entry_door_front_block_data table
            $this->comman_model->insert_column("entry_door_front_block_data", $block_data);
        }


        // Add email in the session blocked email list
        $block_session_emaildata = $this->session->userdata('blocked_emails');
        $blockemail_session_data = array();
        if (isset($block_session_emaildata) && $block_session_emaildata != '') {
            $blockemail_session_data['blocked_emails'] = $block_session_emaildata;
            if (!in_array($entry_users_data['email'], $block_session_emaildata)) {
                $blockemail_session_data['blocked_emails'][] = $entry_users_data['email'];
            }
        } else {
            $blockemail_session_data['blocked_emails'][] = $entry_users_data['email'];
        }
        $this->session->set_userdata($blockemail_session_data);
       
        // Add phone in the session blocked phone list
        $block_session_phonedata = $this->session->userdata('blocked_phones');
        $blockphone_session_data = array();
        if (isset($block_session_phonedata) && $block_session_phonedata != '') {
            $blockphone_session_data['blocked_phones'] = $block_session_phonedata;
            if (!in_array('+' . $entry_users_data['country_code'] . ' ' . $entry_users_data['telephone'], $block_session_phonedata)) {
                $blockphone_session_data['blocked_phones'][] = '+' . $entry_users_data['country_code'] . ' ' . $entry_users_data['telephone'];
            }
        } else {
            $blockphone_session_data['blocked_phones'][] = '+' . $entry_users_data['country_code'] . ' ' . $entry_users_data['telephone'];
        }
        $this->session->set_userdata($blockphone_session_data);

        // update  email and phone attempt values in the session
        $attempt_session_data = array(
            'entry_email_attempt' => '',
            'entry_sms_attempt' => ''
        );
        $this->session->set_userdata($attempt_session_data);

        // check each blocked email from session and update session time of that email  in the session
        foreach ($blockemail_session_data['blocked_emails'] as $email) {

            $where_param = array();
            $where_param['email'] = $email;
            $select_param = array('*');
            // get records related to email from entry_door_front_block_data table
            $blocksession_info = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);

            $where_param = array();
            $where_param['email'] = $email;
            $select_param = array('*');
             // get records related to email from entry_door_block_emails table
            $blockemailsession_info = $this->comman_model->get_row("entry_door_block_emails", $select_param, $where_param);

            if (!empty($blocksession_info)) {
                $int_block = strtotime($blocksession_info[0]->dte_block);
            } else if (!empty($blockemailsession_info)) {
                $int_block = strtotime($blockemailsession_info[0]->dte_block);
            }
            $int_TR = $entry_door_timer->entry_door_block_timer - intval(((time() - $int_block) / 60));

            if ($int_TR < 0)
                $int_TR = 0;

            $blockedemail_ses_data[] = $email . '(' . $int_TR . ' minutes)';
        }
        // check each blocked phone from session and update session time of that phone  in the session

        foreach ($blockphone_session_data['blocked_phones'] as $phone) {
            $exphone = str_replace("+", "", $phone);
            $exphone = explode(' ', $exphone);
            $where_param = array();
            $where_param['country_code'] = $exphone[0];
            $where_param['telephone'] = $exphone[1];
            $select_param = array('*');
             // get records related to phone from entry_door_front_block_data table
            $blocksession_info = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);

            $where_param = array();
            $where_param['country_code'] = $exphone[0];
            $where_param['telephone'] = $exphone[1];
            $select_param = array('*');
            // get records related to phone from entry_door_block_phones table
            $blockphonesession_info = $this->comman_model->get_row("entry_door_block_phones", $select_param, $where_param);

            if (!empty($blocksession_info)) {
                $int_block = strtotime($blocksession_info[0]->dte_block);
            } else if (!empty($blockphonesession_info)) {
                $int_block = strtotime($blockphonesession_info[0]->dte_block);
            }
            $int_TR = $entry_door_timer->entry_door_block_timer - intval(((time() - $int_block) / 60));

            if ($int_TR < 0)
                $int_TR = 0;

            $blockedphone_ses_data[] = $phone . '(' . $int_TR . ' minutes)';
        }
        $result['result'] = 'true';
        $result['email'] = implode(', ', $blockedemail_ses_data);
        $result['telephone'] = implode(', ', $blockedphone_ses_data);
        // return result in json format
        echo json_encode($result);
        exit;
    }
    
    /**
     * logout_user
     *
     * This Function logout the current user and remove all session variables from  current session.
     * @return void
     */
    function logout_user()
    {
        // Clear all session variables
        $this->session->unset_userdata('cart_final_currency');
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

        $session_user = $this->session->userdata('front_validuser_data');
        $where_param['email']        = $session_user['email'];
        $where_param['country_code'] = $session_user['country_code'];
        $where_param['telephone']    = $session_user['telephone'];
        // Delete row from the table entry_door_front_shopping_data
        $this->comman_model->delete_row("entry_door_front_shopping_data", $where_param);
        $this->session->unset_userdata('front_validuser_data');
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
        
        $this->session->unset_userdata('logged_user_id');
        $this->session->sess_destroy();

        $data['redirect'] = base_url() . 'user/login';
        echo json_encode($data);
    }
    
    /**
     * clear_user_session
     * This Function is not used
     * @return void
     */
    function clear_user_session()
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
    }
    
    /**
     * clear_user_session_final
     *
     * This Function clear all session variables those are used while validating the email and phone
     * @return void
     */
    function clear_user_session_final()
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

}
// END Front class
/* End of file front.php */
/* Location: ./application/controllers/front.php */    

