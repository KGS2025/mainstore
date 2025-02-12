<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Contact
 * 
 * This Class handle user contact requests for the all specified  methods in the class.
 * 
 */
class Contact extends MY_Controller
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
        $this->load->model(array('comman_model', 'entry_door_front_block_data', 'contact_form_model'));
        $this->load->helper(array('assets', 'cart_helper', 'common_helper'));
    }

    /**
     * index
     *
     * This Function display the front end contact form. 
     * @link https://estorename.kondarsoft.com/en/contac
     * @return void
     */
    public function index()
    {
        $cart = $this->session->userdata('cart');
        $cart = cartCleanUp($cart);
        $this->session->set_userdata('cart', $cart);

        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'admin_static_links', 'cart_timer', 'product_instruction', 'contact_timer', 'contact_message', 'form_validation_instruction'), $this->lang->default_lang_id);

        $pageData = array(
            'title'                     => get_page_title('contactus_page'),
            'active'                    => 'contact',
            'pageType'                  => 'contact',
            'timestamp'                 => date_timestamp_get(date_create()),
            'countries'                 => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'country_data'              => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'lang_id'                   => $this->lang->default_lang,
            'lang_num'                  => $this->lang->default_lang_id,
            'all_data'                  => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'all_navigation_data'       => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'front_validuser_data'      => $this->session->userdata('front_validuser_data'),
            'cartcount'                 => getcartcount($cart),
            'all_social_media_data'     => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
            'menu_instruction'          => $this->comman_model->GetAllDataLangByid("menu", 'id', '1', $this->lang->default_lang_id, 'menu_country'),
            'general_instruction'       => (object)$userLangData['general_instruction'],
            'product_instruction'       => (object)$userLangData['product_instruction'],
            'selection_instruction'     => (object)$userLangData['selection_instruction'],
            'cart_instruction'          => (object)$userLangData['cart_instruction'],
            'cart_timer'                => (object)$userLangData['cart_timer'],
            'contact_timer'             => (object)$userLangData['contact_timer'],
            'form_validation_instruction' => (object)$userLangData['form_validation_instruction'],
            'contact_message'           => $userLangData['contact_message'],
            'admin_static_links'        => $userLangData['admin_static_links'],
            'ip_data' =>getUserIpData()

        );

        $this->load->view('common/header', $pageData);
        $this->load->view('master/home/contact_form', $pageData);
        $this->load->view('common/footer', $pageData);
    }

    /**
     * Method put_data_session
     * This Function save contact form data in the session.
     * @return void
     */
    function put_data_session()
    {
        $new_session['email']   = $this->input->post("email");
        $new_session['country'] = $this->input->post("country");
        $new_session['contact'] = $this->input->post("contact");
        $new_session['name']    = $this->input->post("name");
        $this->session->set_userdata("new_session", $new_session);
        echo "success";
        exit;
    }

    function preview_state_block()
    {
        $user_data = $this->session->userdata('new_session');
        $where_param = array();
        $where_param["email"] = isset($user_data['email']) ? $user_data['email'] : '';
        $select_param = array("email" => "email");
        $block_info = $this->comman_model->get_row('entry_door_front_block_data', $select_param, $where_param);
        if (!empty($block_info)) {
            $where_param = array();
            $where_param["email"] = $user_data['email'];
            $block_data = array();
            $block_data['block'] = 5;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            $this->comman_model->update_column("entry_door_front_block_data", $where_param, $block_data);
        } else {
            $block_data = array();
            $block_data['errors']       = 0;
            $block_data['email_sents']  = 0;
            $block_data['block']        = 5;
            $block_data['dte_block']    = date("Y-m-d H:i:s", time());
            $block_data['email']        = $this->input->post('email');
            $block_data['applicant']    = $this->input->post('salutation') . ' ' . $this->input->post('name');
            $block_data['country']      = $this->input->post('country');
            $block_data['ip_address']   = $_SERVER['REMOTE_ADDR'];
            $block_data['telephone']    = $this->input->post('email');
            $block_data['region']       = "contact";
            $this->comman_model->insert_column("entry_door_front_block_data", $block_data);
        }
        echo "success";
        exit;
    }


    /**
     * Method get_verify1
     *  This Function execute on the verification of otp code on the verify contact page.
     * @return void
     */
    function verify_otp()
    {

        $userLangData = get_user_lang_data(array('form_validation_instruction', 'email_instruction'), $this->lang->default_lang_id);
        $form_validation_instruction = (object)$userLangData['form_validation_instruction'];

        $user_data = $this->session->userdata('user_contact_data');

        $check_attempt = $this->session->userdata('attempts');
        if ($check_attempt < 3) {
            $code = $this->input->post('code');
            $check = $this->contact_form_model->as_array()->get_by(array('code' => $code));
            if (empty($check)) {
                $attmpt = $this->session->userdata('attempts') + 1;
                $set = array('attempts' => $attmpt);
                $this->session->set_userdata($set);
                $this->session->userdata('attempts');

                $where_param = array();
                $where_param['email'] = $user_data['email'];
                $select_param = array('errors ' => 'errors');
                $block_info = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);
                $block_data = array();
                $block_data['errors'] = $block_info[0]->errors + 1;
                $this->comman_model->update_column("entry_door_front_block_data", $where_param, $block_data);

                echo $form_validation_instruction->wrong_email_code_attempt;
                exit;
            } else {
                $user_data = $this->contact_form_model->as_array()->get_by(array('id' => $user_data['user_id']));

                $where_param = array();
                $where_param['email'] = $user_data['email'];
                $this->comman_model->delete_row("entry_door_front_block_data", $where_param);

                $this->load->library('email');
                $config = array(
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'priority' => '1'
                );
                $config = $this->config->item('emailconfig');
                $this->email->initialize($config);

                $email_instruction = $userLangData['email_instruction'];

                $from       = $this->config->item('fromemailaddress');;
                $fromname   = $user_data['name'];
                $to         = $email_instruction['contact_form_admin_email'];
                $toname     = $email_instruction['admin_contact_email_from_name'];
                $subject = $email_instruction['admin_contact_email_subject'];
                $message = htmlspecialchars_decode($email_instruction['admin_contact_email_body']);
                $message = str_replace('{user}', $user_data['name'], $message);
                $message = str_replace('{branch}', $user_data['branch'], $message);
                $message = str_replace('{company}', $user_data['company'], $message);
                $message = str_replace('{designation}', $user_data['designation'], $message);
                $message = str_replace('{country}', $user_data['country'], $message);
                $message = str_replace('{telephone}', $user_data['contact'], $message);
                $message = str_replace('{message}', $user_data['message'], $message);

                $this->email->from($from, $fromname);
                $this->email->to($to);
                $this->email->subject($subject);
                $this->email->message($message);
                $result = $this->email->send();

                $this->email->clear();

                $from       = $this->config->item('fromemailaddress');
                $fromName   = $email_instruction['contact_email_from_name'];
                $to         = $user_data['email'];
                $toname     = $user_data['name'];
                $subject    = $email_instruction['contact_email_subject'];

                // check if language is not an english, then will fetch sender name for english becoz send grid not support or not validated other language sender name
                if ($this->lang->default_lang_id != 13) {
                 //   $fromName = get_user_lang_data(array('email_instruction'), 13)['email_instruction']['contact_email_from_name'];
                }

                $message = htmlspecialchars_decode($email_instruction['contact_email_body']);
                $message = str_replace('{user}', $user_data['name'], $message);
                $message = str_replace('{branch}', $user_data['branch'], $message);
                $message = str_replace('{company}', $user_data['company'], $message);
                $message = str_replace('{designation}', $user_data['designation'], $message);
                $message = str_replace('{country}', $user_data['country'], $message);
                $message = str_replace('{telephone}', $user_data['contact'], $message);
                $message = str_replace('{message}', $user_data['message'], $message);
                $this->email->from($from, $fromName);
                $this->email->to($to);
                $this->email->set_header("To", $toname . '<' . $to . '>');
                $this->email->subject($subject);
                $this->email->message($message);
                $result = $this->email->send();
                $this->contact_form_model->update($user_data['id'], array('confirm' => 'confirm', 'block' => 0));

                $this->session->unset_userdata('set_user');
                $this->session->unset_userdata('user_contact_data');
                echo 'success';
                exit;
            }
        } else {
            $this->contact_form_model->update($user_data['user_id'], array('block' => 1, 'block_time' => time()));

            $this->session->unset_userdata('attempts');

            $where_param = array();
            $where_param['email'] = $user_data['email'];

            $block_data = array();
            $block_data['email_blocked '] = 1;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            $this->block_list_email->update_column("entry_door_front_block_data", $where_param, $block_data);
            echo 'redirect';
            exit;
        }
    }

    /**
     * Method set_contact_form
     * This Function save contact us form data in the database and send otp code on the email.
     * @return void
     */
    public function set_contact_form()
    {

        $userLangData     = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'admin_static_links', 'cart_timer', 'product_instruction', 'contact_timer', 'form_validation_instruction', 'email_instruction'), $this->lang->default_lang_id);
        $cart_instruction = (object)$userLangData['cart_instruction'];

        $data = array();
        $data["cart_instruction"] = $cart_instruction;

        //check captcha
        $captcha = validate_captcha();
        if (isset($captcha['response']) && $captcha['response'] != 'success') {
            echo $cart_instruction->invalid_captcha;
            exit;
        }


        $operation   = $this->input->post('operation');
        $title       = $this->input->post('salutation');
        $name        = $this->input->post('name');
        $email       = $this->input->post('email');
        $branch      = 'Canada-Vancouver';
        $branchflag[1] = 'ca';
        $country     = $this->input->post('country');
        $countryflag = explode(' ', $this->input->post('countryflag'));
        $contact     = $this->input->post('contact');
        $company     = $this->input->post('company');
        $msge        = $this->input->post('msge');
        $design      = $this->input->post('design');
        if ($this->input->post('operation')) {
            $length = 6;
            if (ENVIRONMENT == "production") {
                $dynamic_code = substr(str_shuffle("0123456789"), 0, $length);
            } else {
                $dynamic_code = getenv('TEST_EMAIL_CODE');
            }

            $post_data = array(
                'name'          => $title . '. ' . $name,
                'email'         => $email,
                'contact'       => $contact,
                'type'          => 'Contact',
                'branch'        => $branch,
                'company'       => $company,
                'designation'   => $design,
                'message'       => $msge,
                'create_date'   => time(),
                'country'       => $country,
                'code'          => $dynamic_code,
                'confirm'       => $dynamic_code
            );
            $check_user1 = $this->contact_form_model->as_array()->get_by(array('email' => $email, 'block' => 1));

            $where_param = array();
            $where_param['email'] = $email;
            $select_param = array("dte_block", "email", "region");
            $blocked_email = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);

            $date = date("Y-m-d H:i:s", time());
            $datelimit = strtotime('-120 minute', strtotime($date));
            $datelimit = date("Y-m-d H:i:s", $datelimit);
            if (!empty($blocked_email)) {
                $int_block = strtotime($blocked_email[0]->dte_block);
                $int_TR = 120 - intval(((time() - $int_block) / 60));
                if ($int_TR < 0)
                    $int_TR = 0;
            } else {
                $int_TR = 0;
            }
            $selection_instruction = (object)$userLangData['selection_instruction'];;

            if (!empty($blocked_email) && isset($blocked_email[0]->dte_block) && $blocked_email[0]->dte_block != NULL && $blocked_email[0]->dte_block > $datelimit) {

                $array1 = array('EMAILVAR', 'SECTIONVAR', 'TIMEVAR');
                $array2 = array($email, $blocked_email[0]->region, $int_TR);
                echo str_replace($array1, $array2, $selection_instruction->block_notification_msg);
                exit;
            } else {
                $where_param = array();
                if (isset($blocked_email[0]->email) && $blocked_email[0]->email != '') {
                    $where_param['email'] = $blocked_email[0]->email;
                    $this->comman_model->delete_row("entry_door_front_block_data", $where_param);
                }
                //end region
                if (!empty($check_user1)) {
                    $currentTime1 = time();
                    $blockTime1 = strtotime('+120 minutes', $check_user1['block_time']);

                    if ($blockTime1 > $currentTime1) {
                        $diff = strtotime(date('d-m-Y', $currentTime1) . " 00:00:00") + ($blockTime1 - $currentTime1);

                        $h = date('H', $diff);
                        $min = date('i', $diff);
                        if ($h == 00 || $h == 0) {

                            $min = $min;
                        } else {
                            $min = (($h * 60) + $min);
                        }
                    }
                    $array1 = array('EMAILVAR', 'SECTIONVAR', 'TIMEVAR');
                    $array2 = array($email, 'contact', $min);
                    echo str_replace($array1, $array2, $selection_instruction->block_notification_msg);
                    exit;
                } else {

                    $result = $this->contact_form_model->insert($post_data);

                    $session_data = array('name' => $post_data['name'], 'email' => $this->input->post('email'), 'user_id' => $result, 'countryflag' => $countryflag[1], 'branchflag' => $branchflag[1]);
                    $this->session->set_userdata('user_contact_data', $session_data);

                    $block_data = array();
                    $block_data['email_sents']  = 1;
                    $block_data['dte_block']    = NULL;
                    $block_data['email_code']   = $dynamic_code;
                    $block_data['email']        = $this->input->post('email');
                    $block_data['applicant']    = $this->input->post('name');
                    $block_data['country']      = $this->input->post('country');
                    $block_data['ip_address']   = $_SERVER['REMOTE_ADDR'];
                    $block_data['telephone']    = $this->input->post('contact');
                    $block_data['region']       = "Contact";
                    $this->comman_model->insert_column("entry_door_front_block_data", $block_data);

                    $this->load->library('email');
                    $config = array(
                        'mailtype' => 'html',
                        'charset' => 'utf-8',
                        'priority' => '1'
                    );
                    $config = $this->config->item('emailconfig');
                    $this->email->initialize($config);

                    $email_instruction = $userLangData['email_instruction'];
                    $msg = htmlspecialchars_decode($email_instruction['kgt_verification_code_contact_body']);
                    $msg = str_replace('{name}', $post_data['name'], $msg);
                    $msg = str_replace('{email_randomString}', $dynamic_code, $msg);

                    $from     = "noreply@kondarsoft.com";
                    $fromName = $email_instruction['kgt_verification_code_contact_from_name'];
                    $to       = $this->input->post('email');
                    $toname   = $post_data['name'];
                    $subject  = $email_instruction['kgt_verification_code_contact_subject'];

                    // check if language is not an english, then will fetch sender name for english becoz send grid not support or not validated other language sender name
                    if ($this->lang->default_lang_id != 13) {
                       // $fromName = get_user_lang_data(array('email_instruction'), 13)['email_instruction']['kgt_verification_code_contact_from_name'];
                    }

                    $this->email->from($from, $fromName);
                    $this->email->to($to);
                    $this->email->set_header("To", $toname . '<' . $to . '>');
                    $this->email->subject($subject);
                    $this->email->message($msg);
                    if (ENVIRONMENT == "production") {
                        $result = $this->email->send();
                    } else {
                        $result = 1;
                    }
                    echo 'success';
                    exit;
                }
            }
        }
    }

    public function verify_contact()
    {

        $user_data = $this->session->userdata('user_contact_data');

        if (empty($user_data)) {
            redirect('/' . $this->lang->default_lang . '/contact');
        }

        $set_user = $this->session->userdata('set_user');
        if (empty($set_user)) {
            $this->session->set_userdata('set_user', true);
        } else {
            $this->comman_model->update_column('contact_form', array('id' => $user_data['user_id']), array('block' => 1, 'block_time' => time()));

            $where_param  = array('id' => $user_data['user_id']);
            $select_param = array("name", "email", "country", "contact");
            $block_emails = $this->comman_model->get_row("contact_form", $select_param, $where_param);

            $block_data = array();
            $block_data['errors']       = 0;
            $block_data['email_sents']  = 0;
            $block_data['dte_block']    = date("Y-m-d H:i:s", time());
            $block_data['block']        = 1;
            $block_data['email_code']   = "";
            $block_data['email']        = $block_emails[0]->email;
            $block_data['applicant']    = $block_emails[0]->name;
            $block_data['country']      = $block_emails[0]->country;
            $block_data['ip_address']   = $_SERVER['REMOTE_ADDR'];
            $block_data['telephone']    = $block_emails[0]->contact;
            $block_data['region']       = "Contact";
            $this->comman_model->insert_column("entry_door_front_block_data", $block_data);

            $this->session->unset_userdata('set_user');
            $this->session->set_flashdata('error', 'Invalid code');
            $this->session->set_flashdata("email_address", $block_emails[0]->email);
            redirect('/' . $this->lang->default_lang . '/contact');
        }

        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'admin_static_links', 'form_validation_instruction', 'contact_message', 'product_instruction'), $this->lang->default_lang_id);

        $cart = $this->session->userdata('cart');
        $cart = cartCleanUp($cart);
        $this->session->set_userdata('cart', $cart);

        $pageData = array(
            'title'                     => get_page_title('contact_us'),
            'active'                    => 'contact',
            'pageType'                  => 'verifycontact',
            'timestamp'                 => date_timestamp_get(date_create()),
            'countries'                 => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'country_data'              => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'lang_id'                   => $this->lang->default_lang,
            'lang_num'                  => $this->lang->default_lang_id,
            'all_data'                  => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'all_navigation_data'       => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'front_validuser_data'      => $this->session->userdata('front_validuser_data'),
            'cartcount'                 => getcartcount($cart),
            'all_social_media_data'     => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
            'menu_instruction'          => $this->comman_model->GetAllDataLangByid("menu", 'id', '1', $this->lang->default_lang_id, 'menu_country'),
            'general_instruction'       => (object)$userLangData['general_instruction'],
            'cart_instruction'          => (object)$userLangData['cart_instruction'],
            'selection_instruction'     => (object)$userLangData['selection_instruction'],
            'product_instruction'       => (object)$userLangData['product_instruction'],
            'admin_static_links'        => $userLangData['admin_static_links'],
            'contact_message'           => $userLangData['contact_message'],
            'user_email'                => $user_data['email']
        );

        $this->load->view('common/header', $pageData);
        $this->load->view('master/home/verify_contact', $pageData);
        $this->load->view('common/footer', $pageData);
    }

    public function get_send_mail($attempt = '')
    {
        $page = $this->input->post('form');
        if ($page == 'contact') {
            $user_data = $this->session->userdata('user_contact_data');
            if (count($user_data) > 0) {
                $length = 6;
                if (ENVIRONMENT == "production") {
                    $dynamic_code = substr(str_shuffle("0123456789"), 0, $length);
                } else {
                    $dynamic_code = getenv('TEST_EMAIL_CODE');
                }
                $this->comman_model->update_column('contact_form', array('id' => $user_data['user_id']), array('code' => $dynamic_code, 'confirm' => $dynamic_code));

                $block_info = $this->comman_model->get_row("entry_door_front_block_data", 'email_sents', array('email' => $user_data['email']));

                $block_data = array();
                $block_data['email_sents'] = $block_info[0]->email_sents + 1;
                $block_data['email_code']  = $dynamic_code;
                $this->comman_model->update_column("entry_door_front_block_data", array('email' => $user_data['email']), $block_data);

                $this->load->library('email');
                $config = array(
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'priority' => '1'
                );
                $config = $this->config->item('emailconfig');
                $this->email->initialize($config);

                // This Function get email body content subject and from address  from the table email_instruction these values are manageable from the admin side
                $userLangData = get_user_lang_data(array('email_instruction', 'cart_instruction', 'form_validation_instruction'), $this->lang->default_lang_id);
                $email_instruction = $userLangData['email_instruction'];
                $cart_instruction  = (object)$userLangData['cart_instruction'];
                $form_validation_instruction = (object)$userLangData['form_validation_instruction'];

                $msg = htmlspecialchars_decode($email_instruction['kgt_verification_code_contact_body']);
                $msg = str_replace('{name}', $user_data['name'], $msg);
                $msg = str_replace('{email_randomString}', $dynamic_code, $msg);


                $to         = $user_data['email'];
                $toname     = $user_data['name'];
                $from       = $this->config->item('fromemailaddress');
                $fromName   = $email_instruction['kgt_verification_code_contact_from_name'];

                $subject    = $email_instruction['contact_verification_code_resend_attempt_subject'] . ' : ' . $attempt;

                // check if language is not an english, then will fetch sender name for english becoz send grid not support or not validated other language sender name
                if ($this->lang->default_lang_id != 13) {
                   // $fromName = get_user_lang_data(array('email_instruction'), 13)['email_instruction']['kgt_verification_code_contact_from_name'];
                }

                $this->email->from($from, $fromName);
                $this->email->to($to);
                $this->email->set_header("To", $toname . '<' . $to . '>');
                $this->email->subject($subject);
                $this->email->message($msg);
                if (ENVIRONMENT == "production") {
                    $this->email->send();
                }

                $result['responce']               = 'success';
                $result['resend_attempt_text']    = $form_validation_instruction->resend_email_attempt;
                $result['verification_code_text'] = str_replace('EMAILVAR', $user_data['email'], $cart_instruction->verification_code_to_email);
                echo json_encode($result);
                exit;
            } else {
                $result['responce'] = 'error';
                echo json_encode($result);
                exit;
            }
        }
    }


    public function test_email()
    {
        $this->load->library('email');
        $config = array(
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'priority' => '1'
        );
        $config = $this->config->item('emailconfig');
        $this->email->initialize($config);

        // This Function get email body content subject and from address  from the table email_instruction these values are manageable from the admin side
        $userLangData = get_user_lang_data(array('email_instruction', 'cart_instruction', 'form_validation_instruction'), $this->lang->default_lang_id);
        $email_instruction = $userLangData['email_instruction'];

        $msg = htmlspecialchars_decode($email_instruction['kgt_verification_code_contact_body']);
        $msg = str_replace('{name}', "Harpartap", $msg);
        $msg = str_replace('{email_randomString}', "99999", $msg);

        $to         =  "developerkondar@hotmail.com";
        $toname     =  "developer";
        $from       = $this->config->item('fromemailaddress');
        $fromName   = $email_instruction['kgt_verification_code_contact_from_name'];
        $subject    = $email_instruction['contact_verification_code_resend_attempt_subject'] . ' : ';
        $this->email->from($from, $fromName);
        $this->email->to($to);
        $this->email->set_header("To", $toname . '<' . $to . '>');
        $this->email->subject($subject);
        $this->email->message($msg);
        $this->email->attach(FCPATH . '/assets/frontend/images/about.png');
       $this->email->send();
    }


    public function test_packing()
    {

        $this->load->library('Packing');
        $items = array(
            array(
                'w' => '7.28 ',
                'h' => '10',
                'd' => '2.55',
                'q' => '10',
                'vr' => '1',
                'wg' => '3.52',
                'id' => 'Pad',
            )
            );

        $this->load->model("package_model");
        $boxes = $this->package_model->getboxData();
        $this->packing->addField('username','KondarSoft');
        $this->packing->addField('api_key','bf11d62ced488061319b68ec429eee87');
        $this->packing->addField('boxes',$boxes);
        $this->packing->addField('items',$items);
        $reposnce =  $this->packing->processAPI();
        echo "<pre>";
        print_r($reposnce);
        exit;
    }

    function block_email_check()
    {
        $email = $this->input->post("email");
        $where_param = array();
        $where_param['email'] = $email;
        $where_param['block !='] = 0;
        $select_param = array("id", "email", "dte_block", "region");
        $block_emails = $this->comman_model->get_row("entry_door_front_block_data", $select_param, $where_param);
        if (count($block_emails) > 0) {
            $int_block = strtotime($block_emails[0]->dte_block);
            $int_TR = 120 - intval(((time() - $int_block) / 60));
            echo $block_emails[0]->email . "#**#" . $int_TR . "#**#" . $block_emails[0]->region;
            exit;
        } else {
            echo "no_block";
            exit;
        }
    }

    function get_timer()
    {
        $contact_timer = get_user_lang_data(array('contact_timer'), $this->lang->default_lang_id)['contact_timer'];
        echo json_encode($contact_timer);
        exit;
    }

    function get_contact_msg($check = false)
    {
        $result = get_user_lang_data(array('contact_message'), $this->lang->default_lang_id)['contact_message'];
        if ($check == true) {
            return $result;
            exit;
        } else {
            echo json_encode($result);
            exit;
        }
    }

    public function user_block()
    {
        $user_data = $this->session->userdata('user_contact_data');
        $this->contact_form_model->update($user_data['user_id'], array('block' => 1, 'block_time' => time()));

        $where_param = array();
        $where_param["email"] = $user_data['email'];
        $select_param = array("email" => "email");
        $block_info = $this->comman_model->get_row('entry_door_front_block_data', $select_param, $where_param);
        $int_block  = $this->input->post('int_block');

        if (!empty($block_info)) {
            $where_param = array();
            $where_param["email"] = $user_data['email'];
            $block_data = array();
            if ($int_block) {
                $block_data['block'] = $int_block;
            } else {
                $block_data['block'] = 5;
            }
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            $this->comman_model->update_column("entry_door_front_block_data", $where_param, $block_data);
        } else {

            $where_param = array();
            $where_param["email"] = $user_data['email'];
            $select_param = array("name" => "name", "country" => "country", "contact" => "contact");
            $user_info = $this->comman_model->get_row('contact_form', $select_param, $where_param);


            $block_data = array();
            $block_data['errors']       = 0;
            $block_data['email_sents']  = 0;
            $block_data['block']        = 5;
            $block_data['dte_block']    = date("Y-m-d H:i:s", time());
            $block_data['email']        = $user_data['email'];
            $block_data['applicant']    = $user_info[0]->name;
            $block_data['country']      = $user_info[0]->country;
            $block_data['ip_address']   = $_SERVER['REMOTE_ADDR'];
            $block_data['telephone']    = $user_info[0]->contact;
            $block_data['region']       = "Contact";
            $this->comman_model->insert_column("entry_door_front_block_data", $block_data);
        }

        $this->session->unset_userdata('attempts');
        echo "success";
        exit;
    }

    public function get_cancel_form()
    {
        $page = $this->input->post('form');
        if ($page == 'contact') {
            $user_data = $this->session->userdata('user_contact_data');
            if (empty($user_data)) {
                redirect('/' . $this->lang->default_lang . '/contact');
            }
            $result = $this->contact_form_model->delete_by(array('id' => $user_data['user_id']));

            $this->load->model("block_list_email");
            $where_param = array();
            $where_param['email'] = $user_data['email'];
            $block_data = array();
            $block_data['block'] = 1;
            $block_data['dte_block'] = date("Y-m-d H:i:s", time());
            $this->comman_model->update_column("entry_door_front_block_data", $where_param, $block_data);

            $this->session->unset_userdata('user_contact_data');
            echo 'success';
            exit;
        }
    }
}
