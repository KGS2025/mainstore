<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Orders
 * This Class handle all functions related to orders. Display orders list, delete order and view order.
 */
class Users extends CI_Controller
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
        $this->load->model(array('comman_model', 'cart_model', 'user_model', 'product_model'));
        $this->load->helper(array('assets', 'cart_helper'));
        validateAdminLogin();
        validateUser();
    }

    /**
     * Method index
     * This Function Display All orders with pagination.
     * @return void
     */
    public function index()
    {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('cart');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $key = $this->security->xss_clean($this->input->post('search'));
        $offset = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $config['base_url'] = base_url() . "admin/" . $this->lang->default_lang . "/users/index/";
        $config['total_rows'] = $this->cart_model->get_user_details('count');
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['num_links'] = 10;
        $config['first_link'] = '<< First';
        $config['last_link'] = 'Last >>';
        $config['next_link'] = 'Next ' . '&gt;';
        $config['prev_link'] = '&lt;' . ' Previous';
        $config['num_tag_open'] = '<span class="number">';
        $config['num_tag_close'] = '</span>';
        $config['cur_tag_open'] = '<span class="current"><a href="#">';
        $config['cur_tag_close'] = '</a></span>';
        $this->pagination->initialize($config);

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_user_details', 'general_instruction'), $this->lang->default_lang_id);
        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access' => $access,
            'login' => $this->session->all_userdata(),
            'title' => get_page_title('user_list', 'admin_title'),
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'users',
            'addscripts' => 'cart_list',
            'primary_lang' => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data' => $this->cart_model->get_user_details('all', $config['per_page'], $offset),
            'links' => $this->pagination->create_links(),
            'offset' => $offset,
            'search' => $key,
            'admin_validuser_data' => $this->session->userdata('admin_validuser_data'),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_user_details' => $all_language_data['admin_user_details'],
            'admin_static_links' => $all_language_data['admin_static_links'],
            'general_instruction' => $all_language_data['general_instruction'],
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/users/users_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method delete
     * This Function  delete single order as per the order id passed in the parameter.
     * @param $id $id [This parameter is the order id.]
     *
     * @return void
     */
    public function delete($id)
    {
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('cart');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $this->comman_model->delete_where('users', array('id' => $id));
        $this->comman_model->delete_where('user_cards', array('user_id' => $id));
        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect('admin/users');
    }

    /**
     * Method viewUser
     * This function display view  of single user as per id passed in the parameter.
     * @param $id $id [This parameter is the  order id.]
     *
     * @return void
     */
    public function viewUser($id = false)
    {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('cart');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'product_instruction', 'admin_user_details'), $this->lang->default_lang_id);
        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access' => $access,
            'login' => $this->session->all_userdata(),
            'title' => get_page_title('user_details', 'admin_title'),
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'users',
            'addscripts' => 'list_cart_details',
            'primary_lang' => !empty($plang) ? $plang['short_code'] : 'en',
            'main_data' => $this->cart_model->get_user_details('single', '', '', $id),
            'admin_validuser_data' => $this->session->userdata('admin_validuser_data'),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_user_details' => $all_language_data['admin_user_details'],
            'admin_static_links' => $all_language_data['admin_static_links'],
            'product_instruction' => $all_language_data['product_instruction'],
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/users/user_details', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method update_status
     * This Function update status in the table as per table name passed in the post parameter.
     * @return void
     */
    public function update_status()
    {
        $post_data = array('user_status' => $this->security->xss_clean($this->input->post('status')));
        $id = $this->security->xss_clean($this->input->post('id'));
        $table_name = "users";
        $this->comman_model->update_data_by_id($table_name, $post_data, 'id', $id);
    }

    /**
     * Method add_productmakers
     * This Function Display Add product maker and save the new maker   in the database.
     * @return void
     */
    public function add_users()
    {

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('cart');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction', 'admin_user_details'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {
        }

        $plang = $this->comman_model->getPrimaryLang();
        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login' => $this->session->all_userdata(),
            'title' => get_page_title('add_user', 'admin_title'),
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'users',
            'addscripts' => 'add_users',
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'sub_menu' => 'add_article',
            'primary_lang' => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data' => $this->session->userdata('admin_validuser_data'),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'general_instruction' => (object) $userLangData['general_instruction'],
            'admin_links' => (object) $userLangData['admin_static_links'],
            'admin_static_links' => $all_language_data['admin_static_links'],
            'admin_products' => $all_language_data['admin_products'],
            'product_catagory' => "",
            'ip_data' => getUserIpData(),
            'admin_user_details' => $all_language_data['admin_user_details'],

        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/users/user_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method add_productmakers
     * This Function Display Add product maker and save the new maker   in the database.
     * @return void
     */
    public function edit_user($id)
    {

        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect('admin/users');
        }
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('cart');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction', 'admin_user_details'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {
        }

        $plang = $this->comman_model->getPrimaryLang();
        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer'), $this->lang->default_lang_id);

        $edit_data = $this->comman_model->get_data_by_id('users', array('id' => $id));
        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login' => $this->session->all_userdata(),
            'title' => get_page_title('edit_user', 'admin_title'),
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'users',
            'addscripts' => 'add_users',
            'countries' => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'sub_menu' => 'add_article',
            'primary_lang' => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data' => $this->session->userdata('admin_validuser_data'),
            'general_instruction' => (object) $userLangData['general_instruction'],
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'cart_instruction' => (object) $userLangData['cart_instruction'],
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'admin_links' => (object) $userLangData['admin_static_links'],
            'admin_static_links' => $all_language_data['admin_static_links'],
            'edit_data' => $edit_data,
            'edit_term' => $this->comman_model->get_data_by_id('user_terms', array('user_id' => $id)),
            'admin_products' => $all_language_data['admin_products'],
            'product_catagory' => "",
            'admin_user_details' => $all_language_data['admin_user_details'],

        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/users/user_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    public function save_users_data()
    {

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction'), $this->lang->default_lang_id);
        $form_validation_instruction = (object) $all_language_data['form_validation_instruction'];
        $postData = $this->security->xss_clean($this->input->post());

        if ($this->input->post('operation')) {

            $postData = $this->security->xss_clean($this->input->post());

            $postData['country_code'] = str_replace('+', '', $postData['country_code']);
            $userExist = $this->user_model->checkUserExist($postData);

            $credit_term_file = $postData['term_real_file'];
            if ($userExist == 1 && empty($postData['user_id'])) {

                $form_validation_instruction = (object) $all_language_data['form_validation_instruction'];
                $error_lang = "User Already Exist with same details.";

                // if file is not uploaded than  this function set error  message in flash to display on frontend.
                // $this->session->set_flashdata('error', $error_lang);
                // redirect(base_url() . 'admin/' . $this->lang->default_lang . '/users/add_users');
            }

            // This Code runs only  when user choose the tax exoneration file on the cart form.
            if (isset($_FILES['credit_term_file']) && !empty($_FILES['credit_term_file']['name'])) {
                // These are configuration variables  for  tax exoneration file
                $config2['upload_path'] = './assets/uploads/cart';
                $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                $config2['max_size'] = '2048';
                $config['file_name'] = getRandomFileName($_FILES['credit_term_file']['name'], 'credit_term_file');

                // This function initialize the upload library
                $this->load->library('upload', $config2);
                $this->upload->initialize($config2);
                if (!$this->upload->do_upload('credit_term_file')) {
                    $error_lang = 'File should be Max 2 MB and either: jpg, png, jpeg, gif or pdf';
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

            if ($postData['credit_term'] == "1" && $credit_term_file == "" && $postData['user_id'] == "") {
                $this->session->set_flashdata('flash_message', "Please upload Credit term file ");
                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/users/add_users');
                exit;
            }

            if (!empty($postData['user_id'])) {

                $existing_data_user = $this->comman_model->get_data_by_id("users", array("id" => $postData['user_id']));

            }

            // this code  save user in the users table
            $access_token = md5(uniqid($postData['email'], true));
            $usersData = array();
            $usersData['salutation'] = $postData['salutation'];
            $usersData['surname'] = $postData['surname'];
            $usersData['company'] = $postData['company'];
            $usersData['email'] = $postData['email'];
            $usersData['country'] = $postData['country'];
            $usersData['country_code'] = $postData['country_code'];
            $usersData['telephone'] = $postData['telephone'];
            $usersData['cart_address_1'] = $postData['cart_address_1'];
            $usersData['cart_city'] = $postData['cart_city'];
            $usersData['cart_state'] = $postData['cart_state'];
            $usersData['cart_zip'] = $postData['cart_zip'];
            $usersData['edi_one'] = $postData['edi_one'];
            $usersData['dateAdded'] = date('Y-m-d H:i:s');
            $usersData['access_token'] = $access_token;
            $usersData['user_status'] = $postData['user_status'];

            /**************/
            if ($this->config->item('show_products_input') == "1") {
                $usersData['signup_category'] = $postData['signup_category'];
                $usersData['signup_maker'] = $postData['signup_maker'];
                $usersData['signup_model'] = $postData['signup_model'];
                $usersData['signup_group'] = $postData['signup_group'];
                $usersData['signup_year'] = $postData['signup_year'];
                $usersData['signup_engine'] = $postData['signup_engine'];
                $usersData['signup_vn'] = $postData['signup_vn'];
            }

            if ($this->config->item('limited_price_option') == "1") {
                if ($postData['approved_products']) {
                    $existing = $postData['approved_products'];
                } else {
                    $existing = array();
                }

                if ($postData['new_requested']) {
                    $new_requested = $postData['new_requested'];
                } else {
                    $new_requested = array();
                }
                $approved_products = array_unique(array_merge($existing, $new_requested));
                $usersData['approved_products'] = implode(",", $approved_products);

            }

            /**************** */
            if ($postData['customer_no']) {
                $customer_no = $postData['customer_no'];
            } else {
                $customer_no = generate_customer_no();
            }
            $usersData['customer_no'] = $customer_no;
            if (empty($postData['user_id'])) {
                $userId = $this->comman_model->add('users', $usersData);
            } else {
                // this code  update users in the admin_users table
                $this->comman_model->update_data_by_id('users', $usersData, 'id', $postData['user_id']);
                $userId = $postData['user_id'];
            }

            if ($userId) {

                $user_term = $this->comman_model->get_data_by_id("user_terms", array("user_id" => $userId));

                if ($postData['credit_term'] == "1") {

                    if (empty($user_term)) {
                        $user_terms = array();
                        $user_terms['user_id'] = $userId;
                        $user_terms['credit_term_status'] = $postData['credit_term'];
                        $user_terms['payment_term_days'] = $postData['credit_days'];
                        $user_terms['request_file'] = $credit_term_file;
                        $user_terms['request_date'] = date('Y-m-d');
                        $user_terms['term_final_file'] = $credit_term_file;
                        $user_terms['expire_date'] = date('Y-m-d', strtotime(date('Y-m-d') . ' + ' . $postData['term_validity'] . ' days'));
                        $user_terms['term_validity'] = $postData['term_validity'];
                        $user_terms['term_amountlimit'] = $postData['term_amountlimit'];
                        $user_terms['approved_on'] = date('Y-m-d');

                        $user_terms_id = $this->comman_model->add('user_terms', $user_terms);

                        // send email  for activation

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
                        $subject = $email_instruction->credit_term_success_subject;

                        // Replace variable in the email and subject content
                        $msg = htmlspecialchars_decode($email_instruction->credit_term_success);
                        $msg = str_replace('{name_details}', $postData['surname'], $msg);
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
                        $this->email->clear(true);
                    } else {
                        // update terms
                        $term_file = !empty($credit_term_file) ? $credit_term_file : $postData['term_final_file'];
                        $user_terms = array();
                        $user_terms['user_id'] = $userId;
                        $user_terms['credit_term_status'] = $postData['credit_term'];
                        $user_terms['payment_term_days'] = $postData['credit_days'];
                        $user_terms['request_file'] = $term_file;
                        $user_terms['term_final_file'] = $term_file;
                        $user_terms['expire_date'] = date('Y-m-d', strtotime(date('Y-m-d') . ' + ' . $postData['term_validity'] . ' days'));
                        $user_terms['term_validity'] = $postData['term_validity'];
                        $user_terms['term_amountlimit'] = $postData['term_amountlimit'];
                        $user_terms['request_date'] = date('Y-m-d');
                        $user_terms['approved_on'] = date('Y-m-d');
                        $this->comman_model->update_column('user_terms', array("id" => $user_term['id']), $user_terms);
                        $user_terms_id = $user_term['id'];
                    }
                }

                if ($postData['credit_term'] == "0" && !empty($postData['user_id'])) {

                    $this->comman_model->delete_row("user_terms", array("user_id" => $userId));
                    if ($user_term['credit_term_status'] == "1") {
                        // send mail for deactivation
                    }
                }

                if (empty($postData['user_id'])) {

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
                    $subject = $email_instruction->signup_welcome_mail_subject;

                    // Replace variable in the email and subject content
                    $activation_link = base_url() . $this->lang->default_lang . '/user/setpassword/' . $access_token;
                    $msg = htmlspecialchars_decode($email_instruction->signup_welcome_mail);
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
                }

                if (!empty($postData['user_id']) && $existing_data_user['user_status'] != $postData['user_status']) {

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
                   

                    // Replace variable in the email and subject content

                    if ($postData['user_status'] == "1") {

                        $subject = $email_instruction->signup_welcome_mail_subject;
                        $activation_link = base_url() . $this->lang->default_lang . '/user/setpassword/' . $access_token. '/reset';
                        $msg = htmlspecialchars_decode($email_instruction->signup_welcome_mail);
                        $msg = str_replace('{name_details}', $postData['surname'], $msg);
                        $msg = str_replace('{activation_link}', $activation_link, $msg);
                        $msg = str_replace('{signature}', $signature, $msg);
                    } else {
                        $subject = $email_instruction->signup_email_inactive_subject;
                        $msg = htmlspecialchars_decode($email_instruction->signup_inactive_email_body);
                        $msg = str_replace('{name_details}', $postData['surname'], $msg);
                        $msg = str_replace(' {status}',$all_language_data['admin_static_links']['inactive_text']['front'], $msg);
                        $msg = str_replace('{signature}', $signature, $msg);


                    }
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
                }
                // this function set success message in flash to display on frontend.
                $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);

                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/users');
            }
        } else {
            $form_validation_instruction = (object) $all_language_data['form_validation_instruction'];
            $error_lang = "Submit the valid form ";

            // if file is not uploaded than  this function set error  message in flash to display on frontend.
            $this->session->set_flashdata('error', $error_lang);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/users/add_users');
        }
    }

    /**
     * Method checkEmailExists
     * This Function checked that is email  exist in the admin_users or not.
     * @param $id $id [This parameter is the user id.]
     * @return void
     */
    public function checkEmailExists()
    {
        // this is email  which is passes using post parameter
        $email = $this->security->xss_clean(trim($this->input->post('email')));
        $id = $this->input->post('user_id');
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
     * Method checkCustomerExists
     * This Function checked that is Customer number   exist in the users or not.
     * @param $id $id [This parameter is the user id.]
     * @return void
     */
    public function checkCustomerExists()
    {
        // this is email  which is passes using post parameter
        $customer_no = $this->security->xss_clean($this->input->post('customer_no'));
        $id = $this->input->post('user_id');
        if ($customer_no && $id) {
            $result = $this->comman_model->get_data_by_id('users', array('id' => $id));
            if ($customer_no == $result['customer_no']) {
                // if not  exist than this code return true
                echo json_encode(true);
            } else {
                // this function check is email  exist in the table  or not.
                $exists = $this->comman_model->check_row_exists('users', array('customer_no' => $customer_no));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(false);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(true);
                }
            }
        } else if ($customer_no) {
            // this function check is email  exist in the table  or not.
            $exists = $this->comman_model->check_row_exists('users', array('customer_no' => $customer_no));
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
    public function checkPhoneExists()
    {
        $country_code = str_replace('+', '', $this->security->xss_clean(trim($this->input->post('country_code'))));
        $id = $this->input->post('user_id');
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
}
