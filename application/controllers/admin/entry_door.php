<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Entry_door
 * This Class  handle all admin users related functions like login, logout, verification of user, check session of the users etc.
 */
class Entry_door extends MY_Controller
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
        $this->load->helper('security');
        $this->load->helper(array('assets', 'cart_helper', 'common_helper'));
        $this->load->model(array('comman_model', 'adminuser_model', 'userblocked_model'));
    }
    
    /**
     * Method index
     * This Function display the Admin end login form.
     * @return void
     */
    public function index() {
    
        $admin_users_data = $this->session->userdata('admin_users_data');

         // this code set admin_users_data  variable for view file
        if (!empty($admin_users_data)) {
            $where_param = array(
                'email'         => $admin_users_data['email'],
                'country_code'  => $admin_users_data['country_code'],
                'telephone'     => $admin_users_data['telephone']
            );
            $rowdata = $this->comman_model->get_row_array("entry_door_admin_block_data", '*', $where_param);
            $admin_users_data = $rowdata[0];
        } else {
            $admin_users_data = array();
        }

        // this code set email attempt variable for view file
        if ($this->session->userdata('admin_email_attempt') != '' && $this->session->userdata('admin_email_attempt') <= 3) {
            $email_attempt = $this->session->userdata('admin_email_attempt')+1;
        } else {
            $email_attempt = 0;
        }

         // this code set sms attempt variable for view file
        if ($this->session->userdata('admin_sms_attempt') != '' && $this->session->userdata('admin_sms_attempt') <= 3) {
            $sms_attempt = $this->session->userdata('admin_sms_attempt')+1;
        } else {
            $sms_attempt = 0;
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'form_validation_instruction', 'cart_instruction', 'general_instruction', 'admin_door_timer', 'entry_door_message'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'title'                 => get_page_title('admin_entry_door', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'entry_door',
            'addscripts'            => 'entrydoor',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'all_data'              => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_users_data'      => $admin_users_data,
            'email_attempt'         => $email_attempt,
            'sms_attempt'           => $sms_attempt,
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'form_validation_instruction' => (object)$all_language_data['form_validation_instruction'],
            'cart_instruction'      => (object)$all_language_data['cart_instruction'],
            'general_instruction'   => $all_language_data['general_instruction'],
            'admin_door_timer'      => (object)$all_language_data['admin_door_timer'],
            'selection_instruction' => (object)$all_language_data['entry_door_message'],
            'ip_data' =>getUserIpData()

        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/entry_door/admin_entry_door', $pageData);
    }
    
    /**entry_door
     * Method save_data
     * This Function is used to save and update information related to admin user in the in the database table(entry_door_admin_block_data). This is sub function of send_verification_code function.
     * @return void
     */
    public function save_data(){

        // set the variables from post inputs
        $country_code       = str_replace('+', '', $this->input->post('country_code'));
        $telephone          = ltrim($this->input->post('telephone'), '0');

        $post               = $this->security->xss_clean($this->input->post());
        $adminuser          = $this->adminuser_model->validateUserEntryDoor($post);

        // prepare array for the session 
        $admin_users_data = array(
            'title'         => $adminuser['title'],
            'first_name'    => $adminuser['first_name'],
            'last_name'     => $adminuser['last_name'],
            'country'       => $this->input->post('country'),
            'country_code'  => trim($country_code),
            'telephone'     => trim($telephone),
            'email'         => $this->input->post('email')
        );
        $admin_users_data     = $this->security->xss_clean($admin_users_data);
        $old_admin_users_data = $this->session->userdata('admin_users_data') ? $this->session->userdata('admin_users_data') : array();
        $session_data = array('admin_users_data' => $admin_users_data);

        // save user details in the session variable
        $this->session->set_userdata($session_data);

         // set value of email attempt variable
        if ($admin_users_data['email'] != $this->security->xss_clean($this->input->post('email'))) {
            $admin_email_attempt = 0;
        } else if ($this->session->userdata('admin_email_attempt') != '') {
            $admin_email_attempt = $this->session->userdata('admin_email_attempt');
        } else {
            $admin_email_attempt = 0;
        }

        // set value of sms attempt variable
        if ($admin_users_data['telephone'] != $this->security->xss_clean($this->input->post('telephone'))) {
            $admin_sms_attempt = 0;
        } else if ($this->session->userdata('admin_sms_attempt') != '') {
            $admin_sms_attempt = $this->session->userdata('admin_sms_attempt');
        } else {
            $admin_sms_attempt = 0;
        }

        // save email and sms attempt variable values in the session
        $entry_email_sms = array(
            'admin_email_attempt' => $admin_email_attempt,
            'admin_sms_attempt'   => $admin_sms_attempt
        );
        $this->session->set_userdata($entry_email_sms);

        // check that the email and phone is exist in the block table  entry_door_admin_block_data
        $block_id = array();
        if(count($old_admin_users_data) > 0){
            $where_param = array(
                'email'         => $old_admin_users_data['email'],
                'country_code'  => $old_admin_users_data['country_code'],
                'telephone'     => $old_admin_users_data['telephone']
            );
            $block_id = $this->comman_model->get_row("entry_door_admin_block_data", array('id' => 'id'), $where_param);
        }

        if (isset($block_id[0]->id) && $block_id[0]->id != "") {
            // if record exist in the table and block date and time is also set than this condition  executed and update the record 
            $whr_param['id'] = $block_id[0]->id;
            $block_data = array();
            $block_data['dte_block'] = NULL;
            $block_data['email'] = $this->input->post('email');
            $block_data['title'] = trim($adminuser['title']);
            $block_data['first_name'] = trim($adminuser['first_name']);
            $block_data['last_name'] = trim($adminuser['last_name']);
            $block_data['country'] = $this->input->post('country');
            $block_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $block_data['country_code'] = $country_code;
            $block_data['telephone'] = $telephone;
            $block_data['region'] = "Admin Door";
            $block_data = $this->security->xss_clean($block_data);
            $this->comman_model->update_column("entry_door_admin_block_data", $whr_param, $block_data);
        } else {
            // if record not exist in the table than this condition  execute and create new record in the entry_door_admin_block_data table
            $block_data = array();
            $block_data['errors'] = 0;
            $block_data['email_sents'] = 0;
            $block_data['sms_sents'] = 0;
            $block_data['dte_block'] = NULL;
            $block_data['block'] = 0;
            $block_data['email'] = $this->input->post('email');
            $block_data['title'] = trim($adminuser['title']);
            $block_data['first_name'] = trim($adminuser['first_name']);
            $block_data['last_name'] = trim($adminuser['last_name']);
            $block_data['country'] = $this->input->post('country');
            $block_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $block_data['country_code'] = $country_code;
            $block_data['telephone'] = $telephone;
            $block_data['region'] = "Admin Door";
            $block_data['created_time'] = time();
            $block_data = $this->security->xss_clean($block_data);
            $this->comman_model->insert_column("entry_door_admin_block_data", $block_data);
        }
    }
    
    /**
     * Method validateUserEntryDoor
     * This Function check if user is blocked or not using email and phone input values from post parameter.
     * @return array
     */
    function validateUserEntryDoor(){
        $error = array();
        $post = $this->input->post();
        $post = $this->security->xss_clean($post);
        // this function check is email and phone exist in the user_blocked table or not.
        $blockeduser = $this->userblocked_model->checkBlockedUser($post);
        if (!empty($blockeduser)) {
            // if email and phone exist than this code set error to responce array
            $error['response'] = 'error';
            $error['error'] = 'blockeduser';
        } else {
            // if email and phone not  exist than this code executed
            // this function check 
            $result = $this->adminuser_model->validateUserEntryDoor($post);
            if (empty($result)) {
                $error = $this->adminuser_model->validateCorrectUserData($post);
                $error['response'] = 'error';
            } else {
                $error['response']   = 'success';
                $error['title']      = $result['title'];
                $error['first_name'] = $result['first_name'];
                $error['last_name']  = $result['last_name'];
            }
        }
        return $error;
    }
    
   
    function send_verification_code(){
        // validation rules for the input values
        //$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[30]|xss_clean');
        //$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]|max_length[30]|xss_clean');
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
        
        // This Function check if user is blocked or not using email and phone input values
        $response = $this->validateUserEntryDoor();
        if (isset($response['response']) && $response['response'] != 'success') {
            echo json_encode($response);
            exit;
        }

        $this->session->unset_userdata('captchaCode'); // reset captcha code.
        
        // This Function is used to save and update information related to verification codes in the database table(entry_door_admin_block_data)
        $this->save_data();
        $length = 6;
        // Check if environment is production than send dynamic code else send static code.
        if (ENVIRONMENT == "production") {
            $email_randomString = substr(str_shuffle("0123456789"), 0, $length);
            $sms_randomString = substr(str_shuffle("0123456789"), 0, $length);
        } else {
            $email_randomString = getenv('TEST_EMAIL_CODE');
            $sms_randomString = getenv('TEST_SMS_CODE');
        }

        $email = $this->security->xss_clean($this->input->post('email'));
        $name = $response['title'] . ' ' . $response['first_name'] . ' ' . $response['last_name'];
        $telephone = trim($this->security->xss_clean($this->input->post('telephone')));
        $country_code = str_replace('+', '', $this->security->xss_clean($this->input->post('country_code')));
        $final_telephone = $country_code . ' ' . $telephone;
        $sms_telephone = $country_code . $telephone;
        $config = $this->config->item('emailconfig');

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

        $admin_email_confirm_status = $this->session->userdata('admin_email_confirm_status');
        $admin_sms_confirm_status = $this->session->userdata('admin_sms_confirm_status');

        if ($email_attempt > 3 && $sms_attempt > 3) {
            // This condition is executed when email and sms attempt is greater than 3.
            $where_param = array();
            $where_param['email'] = $email;
            $where_param['country_code'] = $country_code;
            $where_param['telephone'] = $telephone;
            $block_data = array();
            $block_data['block'] = 3;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
             // Add email and phone in the block list with time.
            $this->comman_model->update_column("entry_door_admin_block_data", $where_param, $block_data);
            $result['result'] = 'fail';
            if ($admin_email_confirm_status == 1) {
                $result['email_attempt'] = 0;
                $result['sms_attempt'] = $sms_attempt;
            } else if ($admin_sms_confirm_status == 1) {
                $result['email_attempt'] = $email_attempt;
                $result['sms_attempt'] = 0;
            } else {
                $result['email_attempt'] = $email_attempt;
                $result['sms_attempt'] = $sms_attempt;
            }

            $result['email'] = $email;
            $result['telephone'] = $final_telephone;
            $result['admin_email_confirm_status'] = $admin_email_confirm_status;
            $result['admin_sms_confirm_status'] = $admin_sms_confirm_status;
            $sessiondata = array(
                'admin_email_attempt' => 0,
                'admin_sms_attempt' => 0
            );
             // Update  sms  and email attempt in the session .
            $this->session->set_userdata($sessiondata);
        } else {
            // This condition is executed when email and sms attempt is less than 3.
            $sel_param = "*";
            $whr_param['email'] = $email;
            $whr_param['country_code'] = $country_code;
            $whr_param['telephone'] = $telephone;
            $bdata = $this->comman_model->get_row("entry_door_admin_block_data", $sel_param, $whr_param);
            $validphone = '';
            if (isset($admin_email_confirm_status) && $admin_email_confirm_status == 1 && isset($admin_sms_confirm_status) && $admin_sms_confirm_status == 1) {
                $email_randomString = $bdata[0]->email_code;
                $sms_randomString = $bdata[0]->sms_code;
                $result['validphone'] = 1;
                $result['validemail'] = 1;
            } else if (isset($admin_email_confirm_status) && $admin_email_confirm_status == 1) {
                $email_randomString = $bdata[0]->email_code;
                $validphone = validatePhone($sms_telephone);
                if ($validphone) {
                    if (ENVIRONMENT == "production") {
                        sentSmsCode($sms_randomString, $sms_telephone, $country_code);
                    } 
                    $result['validemail'] = 1;
                    $result['validphone'] = 1;
                    $result['block_step'] = 1;
                } else {
                    $blocked = array();
                    $blocked['phone_blocked'] = '1';
                    $whr_param['email'] = $email;
                    $whr_param['country_code'] = $country_code;
                    $whr_param['telephone'] = $telephone;
                    $this->comman_model->update_column("entry_door_admin_block_data", $whr_param, $blocked);
                    $result['validemail'] = 1;
                    $result['validphone'] = 0;
                    $result['block_step'] = 2;
                }
            } else if (isset($admin_sms_confirm_status) && $admin_sms_confirm_status == 1) {
                $sms_randomString = $bdata[0]->sms_code;
                $validphone = 1;

                if (ENVIRONMENT == "production") {
                    $validemail = sentEmailCode($email_randomString, $email, $final_telephone, $name, $email_attempt, $admin_sms_confirm_status, $validphone,'admin');
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
                    $this->comman_model->update_column("entry_door_admin_block_data", $whr_param, $blocked);
                    $result['validemail'] = 0;
                    $result['validphone'] = 1;
                    $result['block_step'] = 2;
                }
            } else {
                $validphone = validatePhone($sms_telephone);
                if ($validphone) {
                    if (ENVIRONMENT == "production") {
                        sentSmsCode($sms_randomString, $sms_telephone, $country_code);
                    }
                    $result['validphone'] = 1;
                } else {
                    $blocked = array();
                    $blocked['phone_blocked'] = '1';
                    $whr_param['email'] = $email;
                    $whr_param['country_code'] = $country_code;
                    $whr_param['telephone'] = $telephone;
                    $this->comman_model->update_column("entry_door_admin_block_data", $whr_param, $blocked);
                    $result['validphone'] = 0;
                }

                if (ENVIRONMENT == "production") {
                    $validemail = sentEmailCode($email_randomString, $email, $final_telephone, $name, $email_attempt, $admin_sms_confirm_status, $validphone,'admin');
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
                    $this->comman_model->update_column("entry_door_admin_block_data", $whr_param, $blocked);
                    $result['validemail'] = 0;
                }
            }

            $session_data = array(
                'email_randomString' => $email_randomString,
                'sms_randomString' => $sms_randomString,
                'admin_email_attempt' => $email_attempt,
                'admin_sms_attempt' => $sms_attempt
            );
            $this->session->set_userdata($session_data);

            $where_param = array();
            $where_param['email'] = $email;
            $where_param['country_code'] = $country_code;
            $where_param['telephone'] = $telephone;
            $select_param = array('email_sents' => 'email_sents', 'sms_sents' => 'sms_sents');
            $block_info = $this->comman_model->get_row("entry_door_admin_block_data", $select_param, $where_param);
            $block_data = array();
            $block_data['email_sents'] = $block_info[0]->email_sents + 1;
            $block_data['sms_sents'] = $block_info[0]->sms_sents + 1;
            $block_data['email_code'] = $email_randomString;
            $block_data['sms_code'] = $sms_randomString;
            $this->comman_model->update_column("entry_door_admin_block_data", $where_param, $block_data);
            $result['result'] = 'true';
            $result['email_attempt'] = $email_attempt;
            $result['sms_attempt'] = $sms_attempt;
            $result['email'] = $email;
            $result['telephone'] = $final_telephone;
            $result['admin_email_confirm_status'] = $admin_email_confirm_status;
            $result['admin_sms_confirm_status'] = $admin_sms_confirm_status;
        }

        $pop_info = $this->get_entry_pop_time();

        if (!empty($bdata) && $bdata[0]->created_time != '') {
            $bal_time = time() - $bdata[0]->created_time;
            $remaining_time = $pop_info["main_admin_door_timer"] - $bal_time;
            if ($remaining_time > 0) {
                $result["main_admin_door_timer"] = $remaining_time;
            } else {
                $result["main_admin_door_timer"] = $pop_info["main_admin_door_timer"];
            }
        } else {
            $result["main_admin_door_timer"] = $pop_info["main_admin_door_timer"];
        }
        $result["main_admin_door_msg"] = $pop_info["main_admin_door_msg"];
        $result["admin_door_popup_timer"] = $pop_info["admin_door_popup_timer"];
        $result["admin_door_popup_msg"] = $pop_info["admin_door_popup_msg"];
        echo json_encode($result);
        exit;
    }
    
     /**
     * get_entry_pop_time
     *
     * This Function is used to get values of messages and timer from table admin_door_timer. Values of this table is manageble from the admin side.
     * @return array
     */
    function get_entry_pop_time(){
       
        $timer = (object)get_user_lang_data(array('admin_door_timer'), $this->lang->default_lang_id)['admin_door_timer'];
        $pop_info["main_admin_door_timer"]  = $timer->main_admin_door_timer * 60;
        $pop_info["main_admin_door_msg"]    = $timer->main_admin_door_msg;
        $pop_info['admin_door_popup_timer'] = $timer->admin_door_popup_timer * 60;
        $pop_info['admin_door_popup_msg']   = $timer->admin_door_popup_msg;
        return $pop_info;
    }

    function blockedemailsms_check($email = ''){
        $result = array();
        $email = $this->security->xss_clean($this->input->post('email'));
        $country_code = str_replace('+', '', $this->security->xss_clean($this->input->post('country_code')));
        $telephone = trim($this->security->xss_clean($this->input->post('telephone')));
        $admin_door_timer = (object)get_user_lang_data(array('admin_door_timer'), $this->lang->default_lang_id)['admin_door_timer'];

        $where_param = array();
        $where_param['email'] = $email;
        $where_param['country_code'] = $country_code;
        $where_param['telephone'] = $telephone;
        $select_param = "*";
        $block_emails = $this->comman_model->get_row("entry_door_admin_block_data", $select_param, $where_param);

        if (!empty($block_emails)) {
            foreach ($block_emails as $each_email) {
                $date = date("Y-m-d H:i:s", time());
                $blocktime = '-' . $admin_door_timer->admin_door_block_timer . ' minute';
                $datelimit = strtotime($blocktime, strtotime($date));
                $datelimit = date("Y-m-d H:i:s", $datelimit);

                if (isset($each_email->dte_block) && $each_email->dte_block != '' && $datelimit > $each_email->dte_block) {
                    $where_param = array();
                    $where_param['email'] = $each_email->email;
                    $where_param['country_code'] = $each_email->country_code;
                    $where_param['telephone'] = $each_email->telephone;
                    $this->comman_model->delete_row("entry_door_admin_block_data", $where_param);
                } else {
                    $block = strtotime($each_email->dte_block);
                    $check_time_block = $admin_door_timer->admin_door_block_timer - intval(((time() - $block) / 60));
                    $region = $each_email->region;

                    if ($each_email->admin_email_confirm != 1 && $each_email->admin_sms_confirm != 1 && $each_email->dte_block != '') {
                        $result['result'] = 'fail';
                        $result['error'] = 'all';
                        $result['check_time_block'] = $check_time_block;
                        $result['region'] = $region;
                        $result['email'] = $each_email->email;
                        $result['telephone'] = '+' . $each_email->country_code . ' ' . $each_email->telephone;
                    } else if ($each_email->admin_email_confirm != 1 && $each_email->dte_block != '') {
                        $result['result'] = 'fail';
                        $result['error'] = 'email';
                        $result['check_time_block'] = $check_time_block;
                        $result['region'] = $region;
                        $result['email'] = $each_email->email;
                        $result['telephone'] = '';
                    } else if ($each_email->admin_sms_confirm != 1 && $each_email->dte_block != '') {
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
        } else {
            $result['result'] = 'success';
        }
        echo json_encode($result);
        exit;
    }
    
    /**
     * Method checkentryblockemails
     * This Function validate the email that is email is blocked or not.
     * @return void
     */
    function checkentryblockemails(){
        $email = $this->security->xss_clean($this->input->post('email'));

        $now = time();
        //$check_time_block = intval($now) - intval($block_user_time);
        $check_time_block = intval($now);
        $block_flag = 0;

        $admin_door_timer = (object)get_user_lang_data(array('admin_door_timer'), $this->lang->default_lang_id)['admin_door_timer'];
        $where_param = array();
        $where_param['email'] = $this->security->xss_clean($this->input->post('email'));
        $select_param = array('*');
        $block_info = $this->comman_model->get_row("entry_door_admin_block_data", $select_param, $where_param);
        $blockemail_info = $this->comman_model->get_row("admin_door_block_emails", $select_param, $where_param);

        if (isset($block_info[0]->admin_email_confirm) && $block_info[0]->admin_email_confirm != 1) {
            $date = date("Y-m-d H:i:s", time());
            $blocktime = '-' . $admin_door_timer->admin_door_block_timer . ' minute';
            $datelimit = strtotime($blocktime, strtotime($date));
            $datelimit = date("Y-m-d H:i:s", $datelimit);

            if (!empty($block_info) && $block_info[0]->dte_block != NULL && $datelimit < $block_info[0]->dte_block) {
                $int_block = strtotime($block_info[0]->dte_block);
                $int_TR = $admin_door_timer->admin_door_block_timer - intval(((time() - $int_block) / 60));
                if ($int_TR < 0)
                    $int_TR = 0;

                echo $int_TR . '##*##' . 2 . '##*##' . $block_info[0]->region . '##*##' . $this->security->xss_clean($this->input->post('email'));
            } else if (!empty($blockemail_info) && $blockemail_info[0]->dte_block != NULL && $datelimit < $blockemail_info[0]->dte_block) {
                $int_block = strtotime($blockemail_info[0]->dte_block);
                $int_TR = $admin_door_timer->admin_door_block_timer - intval(((time() - $int_block) / 60));
                if ($int_TR < 0)
                    $int_TR = 0;

                echo $int_TR . '##*##' . 2 . '##*##' . $block_info[0]->region . '##*##' . $this->security->xss_clean($this->input->post('email'));
            } else {
                $where_param = array();
                $where_param['email'] = $this->security->xss_clean($this->input->post('email'));
                $this->comman_model->delete_row("entry_door_admin_block_data", $where_param);
                $this->comman_model->delete_row("admin_door_block_emails", $where_param);
                echo round($check_time_block) . '##*##' . $block_flag;
            }
        } else {
            echo round($check_time_block) . '##*##' . $block_flag;
        }
    }
    
    /**
     * Method checkentryblocksms
     * This Function validate the phone that is phone is blocked or not.
     * @return void
     */
    function checkentryblocksms(){
      
        $country_code = str_replace('+', '', $this->security->xss_clean($this->input->post('country_code')));
        $telephone = trim($this->security->xss_clean($this->input->post('telephone')));

        $now = time();
        //$check_time_block = intval($now) - intval($block_user_time);
        $check_time_block = intval($now);
        $block_flag = 0;

        $admin_door_timer = (object)get_user_lang_data(array('admin_door_timer'), $this->lang->default_lang_id)['admin_door_timer'];
        $where_param = array();
        $where_param['country_code'] = $country_code;
        $where_param['telephone'] = $telephone;
        $select_param = array('*');
        $block_info = $this->comman_model->get_row("entry_door_admin_block_data", $select_param, $where_param);
        $blockphone_info = $this->comman_model->get_row("admin_door_block_phones", $select_param, $where_param);

        if (isset($block_info[0]->admin_sms_confirm) && $block_info[0]->admin_sms_confirm != 1) {
            $date = date("Y-m-d H:i:s", time());
            $blocktime = '-' . $admin_door_timer->admin_door_block_timer . ' minute';
            $datelimit = strtotime($blocktime, strtotime($date));
            $datelimit = date("Y-m-d H:i:s", $datelimit);
            if (!empty($block_info) && $block_info[0]->dte_block != NULL && $datelimit < $block_info[0]->dte_block) {

                $int_block = strtotime($block_info[0]->dte_block);
                $int_TR = $admin_door_timer->admin_door_block_timer - intval(((time() - $int_block) / 60));
                if ($int_TR < 0)
                    $int_TR = 0;

                echo $int_TR . '##*##' . 2 . '##*##' . $block_info[0]->region . "##*##" . "+" . $country_code . ' ' . $telephone;
            } else if (!empty($blockphone_info) && $blockphone_info[0]->dte_block != NULL && $datelimit < $blockphone_info[0]->dte_block) {
                $int_block = strtotime($blockphone_info[0]->dte_block);
                $int_TR = $admin_door_timer->admin_door_block_timer - intval(((time() - $int_block) / 60));
                if ($int_TR < 0)
                    $int_TR = 0;

                echo $int_TR . '##*##' . 2 . '##*##' . $block_info[0]->region . '##*##' . '+' . $country_code . ' ' . $telephone;
            } else {
                $where_param = array();
                $where_param['country_code'] = $country_code;
                $where_param['telephone'] = $telephone;
                $this->comman_model->delete_row("entry_door_admin_block_data", $where_param);
                $this->comman_model->delete_row("admin_door_block_phones", $where_param);
                echo round($check_time_block) . '##*##' . $block_flag;
            }
        } else {
            echo round($check_time_block) . '##*##' . $block_flag;
        }
    }

    function save_entry_details(){
        $result = array();
        $admin_email_attempt = $this->session->userdata('admin_email_attempt');
        if ($admin_email_attempt == '')
            $admin_email_attempt = 0;

        $admin_sms_attempt = $this->session->userdata('admin_sms_attempt');
        if ($admin_sms_attempt == '')
            $admin_sms_attempt = 0;

        if ($admin_email_attempt > 3)
            $admin_email_attempt = 0;

        if ($admin_sms_attempt > 3)
            $admin_sms_attempt = 0;

        $email_details = $this->session->userdata('email_randomString');
        $email_verification_code = trim($this->security->xss_clean($this->input->post('entry_verification_codemail')));

        $sms_details = $this->session->userdata('sms_randomString');
        $sms_verification_code = trim($this->security->xss_clean($this->input->post('entry_verification_codesms')));
        $valid_email = trim($this->security->xss_clean($this->input->post('valid_email')));
        $valid_phone = trim($this->security->xss_clean($this->input->post('valid_phone')));

        if ($email_verification_code == $email_details && $sms_verification_code == $sms_details) {
            $admin_users_data = $this->session->userdata('admin_users_data');
            $where_param = array();
            $where_param['email'] = $admin_users_data['email'];
            $where_param['country_code'] = $admin_users_data['country_code'];
            $where_param['telephone'] = $admin_users_data['telephone'];

            $select_param = '*';
            $block_info = $this->comman_model->get_row("entry_door_admin_block_data", $select_param, $where_param);
            $this->comman_model->delete_row("entry_door_admin_block_data", $where_param);

            $where_param = array();
            $where_param['edb_id'] = $block_info[0]->id;
            $this->comman_model->delete_row("admin_door_block_emails", $where_param);
            $this->comman_model->delete_row("admin_door_block_phones", $where_param);

            $shopping_data = array();
            $shopping_data['title'] = $admin_users_data['title'];
            $shopping_data['first_name'] = $admin_users_data['first_name'];
            $shopping_data['last_name'] = $admin_users_data['last_name'];
            $shopping_data['country'] = $admin_users_data['country'];
            $shopping_data['country_code'] = $admin_users_data['country_code'];
            $shopping_data['telephone'] = $admin_users_data['telephone'];
            $shopping_data['email'] = $admin_users_data['email'];
            $shopping_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $shopping_data['created_time'] = time();
            $this->comman_model->insert_column("entry_door_admin_data", $shopping_data);

            $session_data = array('admin_validuser_data' => $shopping_data);
            $this->session->set_userdata($session_data);

            $this->clear_user_session();
            $result['result'] = 'success';
            $result['email_attempt'] = $admin_email_attempt;
            $result['sms_attempt'] = $admin_sms_attempt;
            $result['admin_email_confirm_status'] = '1';
            $result['admin_sms_confirm_status'] = '1';
            $admin_email_attempt = 0;
            $admin_sms_attempt = 0;
        } else if ($email_verification_code == $email_details && $admin_sms_attempt < 3) {
            $admin_email_attempt = 0;
            $where_param = array();
            $session_user = $this->session->userdata("admin_users_data");
            $where_param['email'] = $session_user['email'];
            $where_param['country_code'] = $session_user['country_code'];
            $where_param['telephone'] = $session_user['telephone'];
            $select_param = '*';
            $block_info = $this->comman_model->get_row("entry_door_admin_block_data", $select_param, $where_param);
            $block_data = array();
            $block_data['errors'] = $block_info[0]->errors + 1;
            $this->comman_model->update_column("entry_door_admin_block_data", $where_param, $block_data);
            $b_data['admin_email_confirm'] = '1';
            $this->comman_model->update_column("entry_door_admin_block_data", $where_param, $b_data);

            $session_data_email = array(
                'admin_email_confirm' => $session_user['email'],
                'admin_email_confirm_status' => '1'
            );
            $this->session->set_userdata($session_data_email);

            $result['result'] = 'fail';
            $result['email_attempt'] = 0;
            $result['block_email'] = $session_user['email'];
            if ($valid_phone != 1) {
                $admin_sms_attempt = 0;
                $result['valid_phone'] = 0;
                $result['valid_email'] = 1;
                $result['sms_attempt'] = 0;
            } else {
                $admin_sms_attempt++;
                $result['valid_phone'] = 1;
                $result['valid_email'] = 1;
                $result['sms_attempt'] = $admin_sms_attempt;
            }
            $result['block_sms'] = '+' . $session_user['country_code'] . ' ' . $session_user['telephone'];
            $result['admin_email_confirm_status'] = '1';
            if ($block_info[0]->dte_block != '' || $block_info[0]->phone_blocked == 1 || $block_info[0]->admin_email_confirm == 1) {
                $result['block_step'] = '2';
            } else {
                $result['block_step'] = '1';
            }
        } else if ($sms_verification_code == $sms_details && $admin_email_attempt < 3) {
            $admin_sms_attempt = 0;
            $where_param = array();
            $session_user = $this->session->userdata("admin_users_data");
            $where_param['email'] = $session_user['email'];
            $where_param['country_code'] = $session_user['country_code'];
            $where_param['telephone'] = $session_user['telephone'];
            $select_param = '*';
            $block_info = $this->comman_model->get_row("entry_door_admin_block_data", $select_param, $where_param);
            $block_data = array();
            $block_data['errors'] = $block_info[0]->errors + 1;
            $this->comman_model->update_column("entry_door_admin_block_data", $where_param, $block_data);
            $b_data['admin_sms_confirm'] = '1';
            $this->comman_model->update_column("entry_door_admin_block_data", $where_param, $b_data);

            $session_data_sms = array(
                'admin_sms_confirm' => '+' . $session_user['country_code'] . ' ' . $session_user['telephone'],
                'admin_sms_confirm_status' => '1'
            );
            $this->session->set_userdata($session_data_sms);

            $result['result'] = 'fail';
            if ($valid_email != 1) {
                $admin_email_attempt = 0;
                $result['valid_phone'] = 1;
                $result['valid_email'] = 0;
                $result['email_attempt'] = 0;
            } else {
                $admin_email_attempt++;
                $result['valid_phone'] = 1;
                $result['valid_email'] = 1;
                $result['email_attempt'] = $admin_email_attempt;
            }
            $result['block_email'] = $session_user['email'];
            $result['sms_attempt'] = 0;
            $result['block_sms'] = '+' . $session_user['country_code'] . ' ' . $session_user['telephone'];
            $result['admin_sms_confirm_status'] = '1';
            if ($block_info[0]->dte_block != '' || $block_info[0]->email_blocked == 1 || $block_info[0]->admin_sms_confirm == 1) {
                $result['block_step'] = '2';
            } else {
                $result['block_step'] = '1';
            }
        } else {
            if ($admin_email_attempt > 2 || $admin_sms_attempt > 2) {
                $admin_email_attempt++;
                $admin_sms_attempt++;

                $where_param = array();
                $session_user = $this->session->userdata("admin_users_data");
                $where_param['email'] = $session_user['email'];
                $where_param['country_code'] = $session_user['country_code'];
                $where_param['telephone'] = $session_user['telephone'];

                $block_data = array();
                $block_data['block'] = 2;
                $block_data['dte_block'] = date("Y-m-d H:i:s", time());
                $this->comman_model->update_column("entry_door_admin_block_data", $where_param, $block_data);

                $select_param = '*';
                $block_info = $this->comman_model->get_row("entry_door_admin_block_data", $select_param, $where_param);
                $insert_data = array();
                if ($admin_email_attempt > 2) {
                    $insert_data = array(
                        'edb_id' => $block_info[0]->id,
                        'dte_block' => date("Y-m-d H:i:s", time()),
                        'email' => $session_user['email']
                    );
                    $this->db->insert('admin_door_block_emails', $insert_data);
                }
                if ($admin_sms_attempt > 2) {
                    $insert_data = array(
                        'edb_id' => $block_info[0]->id,
                        'dte_block' => date("Y-m-d H:i:s", time()),
                        'country_code' => $session_user['country_code'],
                        'telephone' => $session_user['telephone'],
                    );
                    $this->db->insert('admin_door_block_phones', $insert_data);
                }
                $block_data = array();
                $block_data['block'] = 2;
                $block_data['dte_block'] = date("Y-m-d H:i:s", time());
                $this->comman_model->update_column("entry_door_admin_block_data", $where_param, $block_data);
            } else {
                $admin_email_attempt++;
                $admin_sms_attempt++;

                $where_param = array();
                $session_user = $this->session->userdata("admin_users_data");
                $where_param['email'] = $session_user['email'];
                $where_param['country_code'] = $session_user['country_code'];
                $where_param['telephone'] = $session_user['telephone'];
                $select_param = array('errors' => 'errors');
                $block_info = $this->comman_model->get_row("entry_door_admin_block_data", $select_param, $where_param);
                $block_data = array();
                $block_data['errors'] = $block_info[0]->errors + 1;
                $this->comman_model->update_column("entry_door_admin_block_data", $where_param, $block_data);
            }

            $result['result'] = 'fail';

            if ($valid_email != 1 && $valid_phone == 1) {
                $result['valid_email'] = 0;
                $result['valid_phone'] = 1;
                $result['email_attempt'] = 0;
                $result['sms_attempt'] = $admin_sms_attempt;
            } else if ($valid_phone != 1 && $valid_email == 1) {
                $result['valid_email'] = 1;
                $result['valid_phone'] = 0;
                $result['email_attempt'] = $admin_email_attempt;
                $result['sms_attempt'] = 0;
            } else {
                $result['valid_email'] = 1;
                $result['valid_phone'] = 1;
                $result['email_attempt'] = $admin_email_attempt;
                $result['sms_attempt'] = $admin_sms_attempt;
            }

            $result['block_email'] = $session_user['email'];
            $result['block_sms'] = '+' . $session_user['country_code'] . ' ' . $session_user['telephone'];
            $result['admin_email_confirm_status'] = '';
            $result['admin_sms_confirm_status'] = '';
        }

        $session_data_attempt = array(
            'admin_email_attempt' => $admin_email_attempt,
            'admin_sms_attempt' => $admin_sms_attempt,
        );
        $this->session->set_userdata($session_data_attempt);
        echo json_encode($result);
        exit;
    }
    
    /**
     * Method block_user_timeout
     * This Function is called when timer is finshed on front end and due to timeout system blocked the admin user.
     * @param $check $check [explicite description]
     *
     * @return void
     */
    function block_user_timeout($check = 0){
        // this function read admin user session data
        $admin_users_data = $this->session->userdata('admin_users_data');

        // this code get data from the block table using email and phone
        $where_param = array();
        $where_param['email'] = $admin_users_data['email'];
        $where_param['country_code'] = $admin_users_data['country_code'];
        $where_param['telephone'] = $admin_users_data['telephone'];

        $select_param = array('dte_block' => 'dte_block', 'region' => 'region');
        $block_info = $this->comman_model->get_row("entry_door_admin_block_data", $select_param, $where_param);
        if (!empty($block_info)) {
            // if data is exist in the table than this function update the record in the entry_door_admin_block_data table
            $block_data = array();
            $block_data['block'] = 5;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            $this->comman_model->update_column("entry_door_admin_block_data", $where_param, $block_data);
        } else {
            // if data is not exist in the table than this function create new  record in the entry_door_admin_block_data table
            $block_data = array();
            $block_data['errors'] = 0;
            $block_data['email_sents'] = 0;
            $block_data['sms_sents'] = 0;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            $block_data['block'] = 5;
            $block_data['email'] = $admin_users_data['email'];
            $block_data['title'] = $admin_users_data['title'];
            $block_data['first_name'] = $admin_users_data['first_name'];
            $block_data['last_name'] = $admin_users_data['last_name'];
            $block_data['country'] = $admin_users_data['country'];
            $block_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $block_data['country_code'] = $admin_users_data['country_code'];
            $block_data['telephone'] = $admin_users_data['telephone'];
            $block_data['region'] = "Entry Door";
            $block_data['created_time'] = time();
            $this->comman_model->insert_column("entry_door_admin_block_data", $block_data);
        }

        // this code set sms and email attempt blank in the session
        $session_data = array(
            'admin_email_attempt' => '',
            'admin_sms_attempt' => ''
        );
        $this->session->set_userdata($session_data);

        // this code return status in json format
        $result['result'] = 'true';
        $result['email'] = $admin_users_data['email'];
        $result['telephone'] = $admin_users_data['country_code'] . ' ' . $admin_users_data['telephone'];
        echo json_encode($result);
    }
    
    /**
     * Method logout_user
     * This Function clear all session variables those are used while validating the admin user and delete record related to current logged in admin user from database.
     * @return void
     */
    function logout_user(){
        $data = array();
        // this function read data from the session
        $session_user = $this->session->userdata('admin_validuser_data');
        $where_param['email'] = $session_user['email'];
        $where_param['country_code'] = $session_user['country_code'];
        $where_param['telephone'] = $session_user['telephone'];
        // this function delete record related to email and phone from entry_door_admin_data table
        $this->comman_model->delete_row("entry_door_admin_data", $where_param);
        $this->session->unset_userdata('admin_email_attempt');
        $this->session->unset_userdata('admin_sms_attempt');
        $this->session->unset_userdata('email_confirm');
        $this->session->unset_userdata('admin_email_confirm_status');
        $this->session->unset_userdata('sms_confirm');
        $this->session->unset_userdata('admin_sms_confirm_status');
        $this->session->unset_userdata('admin_users_data');
        $this->session->unset_userdata('admin_validuser_data');
        $this->session->unset_userdata('email_randomString');
        $this->session->unset_userdata('sms_randomString');
        $data['redirect'] = base_url() . 'admin/entry_door';
        echo json_encode($data);
    }
    
    /**
     * Method clear_user_session
     * This Function clear all session variables those are used while validating the admin user.
     * @return void
     */
    function clear_user_session(){
        $this->session->unset_userdata('admin_email_attempt');
        $this->session->unset_userdata('admin_sms_attempt');
        $this->session->unset_userdata('email_confirm');
        $this->session->unset_userdata('admin_email_confirm_status');
        $this->session->unset_userdata('sms_confirm');
        $this->session->unset_userdata('admin_sms_confirm_status');
        $this->session->unset_userdata('admin_users_data');
        $this->session->unset_userdata('email_randomString');
        $this->session->unset_userdata('sms_randomString');
    }
    
}
