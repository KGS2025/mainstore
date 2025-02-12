<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Contact
 * Contact Class handle all methods  related to contact user list and delete the contacts.
 */
class Creditterm extends CI_Controller
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
        $this->load->model(array('comman_model', 'contact_user_model', 'creditterm_model'));
        $this->load->helper('assets');
        validateAdminLogin();
        validateUser();
    }

    /**
     * Method index
     * This Function Display credit term  list data.
     * @return void
     */
    function index($param1 = '', $param2 = 0)
    {

        check_lang_admin();
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('credit_term_list');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $keypost = trim($this->security->xss_clean($this->input->post('search')));
        $offset = 0;
        $key = '';
        $uri_segment = 5;
        if (isset($param1) && $param1 != '' && isset($param2) && $param2 != '') {
            $offset = $param2;
            $key    = $param1;
            $uri_segment = 6;
        } else if (isset($param1) && $param1 != '') {
            $offset = $param1;
        } else if (isset($keypost) && $keypost != '') {
            $key = $keypost;
        }

        $config['per_page']     = 10;
        $config['num_links']    = 5;
        $config['uri_segment']  = $uri_segment;
        $config['first_link']   = '<< First';
        $config['last_link']    = 'Last >>';
        $config['next_link']    = 'Next ' . '&gt;';
        $config['prev_link']    = '&lt;' . ' Previous';


        $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/creditterm/index/";
        $config['total_rows']   = $this->creditterm_model->record_count('user_terms');


        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_user_details', 'api_instruction', 'cart_instruction'), $this->lang->default_lang_id);
        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('credit_term_list', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'credit_term_list',
            'addscripts'            => 'credit_term_list',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->creditterm_model->get_all_requests($config['per_page'], $offset),
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_user_details'   => $all_language_data['admin_user_details'],
            'api_instruction'       => $all_language_data['api_instruction'],
            'cart_instruction'      => $all_language_data['cart_instruction'],
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/credit_term/creditterm_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }



    /**
     * Method add_productmakers
     * This Function Display Add product maker and save the new maker   in the database.
     * @return void
     */
    function edit_term($id)
    {


        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect('admin/users');
        }
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('credit_term_list');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {
        }

        $plang      = $this->comman_model->getPrimaryLang();
        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer'), $this->lang->default_lang_id);
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_user_details', 'api_instruction', 'cart_instruction'), $this->lang->default_lang_id);




        $edit_data =  $this->creditterm_model->getSingle($id);


        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('credit_term_list', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'credit_term_list',
            'addscripts'            => 'add_users',
            'countries'                   => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'sub_menu'              => 'add_article',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'cart_instruction'         => (object)$userLangData['cart_instruction'],
            'form_validation_instruction' => (object)$userLangData['form_validation_instruction'],
            'admin_links'    => (object)$userLangData['admin_static_links'],
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_user_details' => $all_language_data['admin_user_details'],
            'edit_data'             => $edit_data,
            'edit_term'             => $this->comman_model->get_data_by_id('user_terms', array('user_id' => $edit_data['user_id'])),
            'api_instruction'       => $all_language_data['api_instruction']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/credit_term/creditterm_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }


    function save_request_data()
    {

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction'), $this->lang->default_lang_id);
        $form_validation_instruction =  (object)$all_language_data['form_validation_instruction'];
        $postData = $this->security->xss_clean($this->input->post());


        if ($this->input->post('operation')) {

            $postData = $this->security->xss_clean($this->input->post());
            $term_request_id  =  $postData['term_request_id'];
            $credit_term_request =  $this->creditterm_model->getSingle($term_request_id);
            $credit_term_file = "";
            if ($postData['status'] == "2") {


                // update request table when status is Decline.
                $credit_term_request_data = array();
                $credit_term_request_data['status'] = $postData['status'];
                $credit_term_request_data['decline_notes'] = $postData['decline_notes'];
                $this->comman_model->update_column('credit_term_requests', array("id" => $term_request_id), $credit_term_request_data);




                // This Function load email library
                $this->load->library('Email');

                // This Function load email configuration from config file and intialize the library
                $config = $this->config->item('emailconfig');
                $this->email->initialize($config);

                // This Function get email body content subject and from address  from the table email_instruction these values are manageable from the admin side
                $email_instruction = (object)get_user_lang_data(array('email_instruction'), $this->lang->default_lang_id)['email_instruction'];

                // set variable for  email function
                $fromeMailId =  $this->config->item('fromemailaddress');
                $fromName    = $email_instruction->admin_cart_mail_fromname;
                $toEmailId   = $credit_term_request['email'];
                $toName      = $credit_term_request['surname'];
                $signature   = $email_instruction->admin_cart_mail_fromname;
                $subject     = $email_instruction->credit_term_decline_subject;

                // Replace variable in the email and subject content
                $msg = htmlspecialchars_decode($email_instruction->credit_term_decline);
                $msg = str_replace('{name_details}', $credit_term_request['surname'], $msg);
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
                $this->email->clear(TRUE);
                // this function set success message in flash to display on frontend.
                $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/creditterm');
                exit;
            }


            if ($postData['status'] == "1") {

                // This Code runs only  when user choose the tax exoneration file on the cart form.
                if (isset($_FILES['credit_term_file']) && !empty($_FILES['credit_term_file']['name'])) {
                    // These are configuration variables  for  tax exoneration file
                    $config2['upload_path']   = './assets/uploads/cart';
                    $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                    $config2['max_size']      = '2048';
                    $config2['file_name']     = getRandomFileName($_FILES['credit_term_file']['name'], 'credit_term_file');

                    // This function initialize the upload library
                    $this->load->library('upload', $config2);
                    $this->upload->initialize($config2);
                    if (!$this->upload->do_upload('credit_term_file')) {
                        $error_lang =  'File should be Max 2 MB and either: jpg, png, jpeg, gif or pdf';
                        $message = array('message' => $error_lang, 'type' => 'error');
                        // This function save error message in the flash variable to display on cart page

                        if ($postData['credit_term'] == "1") {
                            $this->session->set_flashdata('flash_message', $message);
                            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/users/add_users');
                            exit;
                        }
                    } else {
                        $upload_data = $this->upload->data();
                        // save upload file name in variable to update in the database
                        $credit_term_file = $upload_data['file_name'];
                    }
                }


                if ($postData['status'] == "1" && $credit_term_file == "") {
                    $this->session->set_flashdata('flash_message', "Please upload Credit term file ");
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/users/add_users');
                    exit;
                }

                // update request table when status is approved.
                $credit_term_request_data = array();
                $credit_term_request_data['status'] = $postData['status'];
                $this->comman_model->update_column('credit_term_requests', array("id" => $term_request_id), $credit_term_request_data);


                // Add user requests 

                $user_terms = array();
                $user_terms['user_id'] =  $credit_term_request['user_id'];
                $user_terms['credit_term_status'] = $postData['status'];
                $user_terms['payment_term_days'] = $postData['credit_days'];
                $user_terms['request_file'] =  $credit_term_request['request_file'];
                $user_terms['request_date'] = $credit_term_request['request_date'];
                $user_terms['term_final_file'] =  $credit_term_file;
                $user_terms['expire_date'] =  date('Y-m-d', strtotime(date('Y-m-d') . ' + ' . $postData['term_validity'] . ' days'));
                $user_terms['term_validity'] =  $postData['term_validity'];
                $user_terms['term_amountlimit'] =  $postData['term_amountlimit'];
                $user_terms['approved_on'] =  date('Y-m-d');


                $user_terms_id = $this->comman_model->add('user_terms', $user_terms);

                // send email  for activation


                // This Function load email library
                $this->load->library('Email');

                // This Function load email configuration from config file and intialize the library
                $config = $this->config->item('emailconfig');
                $this->email->initialize($config);

                // This Function get email body content subject and from address  from the table email_instruction these values are manageable from the admin side
                $email_instruction = (object)get_user_lang_data(array('email_instruction'), $this->lang->default_lang_id)['email_instruction'];

                // set variable for  email function
                $fromeMailId =  $this->config->item('fromemailaddress');
                $fromName    = $email_instruction->admin_cart_mail_fromname;
                $toEmailId   = $credit_term_request['email'];
                $toName      = $credit_term_request['surname'];
                $signature   = $email_instruction->admin_cart_mail_fromname;
                $subject     = $email_instruction->credit_term_success_subject;

                // Replace variable in the email and subject content
                $msg = htmlspecialchars_decode($email_instruction->credit_term_success);
                $msg = str_replace('{name_details}', $credit_term_request['surname'], $msg);
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

                $term_file_path = FCPATH . '/assets/uploads/cart/' . $credit_term_file;
                $this->email->attach($term_file_path);
                // This Functions send email and clear email configuration
                $this->email->send();
                //echo $this->email->print_debugger();exit;
                $this->email->clear(TRUE);


                // this function set success message in flash to display on frontend.
                $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/creditterm');
                exit;
            }
        } else {
            $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
            $error_lang = "Submit the valid form ";

            // if file is not uploaded than  this function set error  message in flash to display on frontend.
            $this->session->set_flashdata('error', $error_lang);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/creditterm');
        }
    }










    /**
     * Method index
     * This Function Display contact users  list data.
     * @return void
     */
    function settings($param1 = '', $param2 = 0)
    {

        check_lang_admin();

        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('credit_term_settings');
        if ($access['page_access'] != 1) {
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('operation')) {


            $postData = $this->security->xss_clean($this->input->post());

            $credit_term_file = "";
            // This Code runs only  when user choose the tax exoneration file on the cart form.
            if (isset($_FILES['creditterm_blank_file']) && !empty($_FILES['creditterm_blank_file']['name'])) {


                // These are configuration variables  for  tax exoneration file
                $config['upload_path']   = './assets/uploads/cart';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                $config['max_size']     = '2048';
                $config['file_name']   = getRandomFileName($_FILES['creditterm_blank_file']['name'], 'user_term');
                // This function initialize the upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('creditterm_blank_file')) {
                    $error_lang =  'File should be Max 2 MB and either: jpg, png, jpeg, gif or pdf';

                    // This function save error message in the flash variable to display on cart page
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('error', $error['error']);

                    //$this->session->set_flashdata('error',$error_lang);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/creditterm/settings');
                    exit;
                } else {
                    $upload_data = $this->upload->data();
                    // save upload file name in variable to update in the database
                    $credit_term_file = $upload_data['file_name'];
                }
            }


            // this code save  details in the  global_settings table
            $this->db->where('setting_name', 'creditterm_blank_file');
            $this->db->update('global_settings', array('setting_value' => $credit_term_file));



            // this function set success message in flash to display on frontend.
            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/creditterm/settings');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'api_instruction', 'cart_instruction'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('credit_term_settings', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'credit_term_settings',
            'addscripts'            => 'api',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'api_instruction'       => $all_language_data['api_instruction'],
            'cart_instruction'      => (object)$all_language_data['cart_instruction'],
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id))
        );


        //echo '<pre>';print_r($pageData['cart_instruction']);exit;

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/credit_term/creditterm_setting', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }


    /**
     * Method delete_selected_contact_user
     *  This Function delete selected row as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the row id of the user_blocked table. ]
     *
     * @return void
     */
    function delete_selected_contact_user()
    {
        $access = validatePageAccess('contact_user');
        //  this function validate the access of this page for current logged admin user.
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteSelected')) {
            // this function delete all users as per the users ids posted  in the post parameter.
            $userIds = $this->security->xss_clean($this->input->post('delete_option'));

            // get the email data to delete  from blocked list
            $all_datas = $this->comman_model->getAllById('contact_form', $userIds, array('email'));
            if ($all_datas) {
                $str_email_array = array();
                foreach ($all_datas as $all_data) {
                    $str_email_array[] = $all_data[$field];
                }
                $this->comman_model->deleteAllById('block_email_list', $str_email_array, 'str_email');
            }

            $this->comman_model->deleteAllById('contact_form', $userIds, 'id');
        }

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];

        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);
        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/contact');
    }

    /**
     * Method delete_contact_user
     *  This Function delete single  row as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the row id of the user_blocked table. ]
     *
     * @return void
     */
    function delete_contact_user($id)
    {
        $access = validatePageAccess('contact_user');
        //  this function validate the access of this page for current logged admin user.
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $contact_data = $this->comman_model->get_data_by_id('contact_form', array('id' => $id));
        if (isset($contact_data['email']) && $contact_data['email']) {
            $this->comman_model->deleteAllById('block_email_list', array($contact_data['email']), 'str_email');
        }

        // this function delete the record by id.
        $this->comman_model->delete_where('contact_form', array('id' => $id));

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);
        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/contact');
    }
}
