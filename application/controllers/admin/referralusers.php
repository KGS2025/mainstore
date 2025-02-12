<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Referralusers
 * This Class handle all functions related to orders. Display orders list, delete order and view order.
 */
class Referralusers extends CI_Controller
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
        $this->load->model(array('comman_model', 'cart_model', 'user_model'));
        $this->load->helper(array('assets', 'cart_helper'));
        validateAdminLogin();
        validateUser();
    }

    /**
     * Method index
     * This Function Display All orders with pagination.
     * @return void
     */
    function index()
    {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('refferaluser_list');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $key    = $this->security->xss_clean($this->input->post('search'));
        $offset = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/orders/index/";
        $config['total_rows']   = $this->cart_model->get_reffer_user_details('count');
        $config['per_page']     = 10;
        $config['uri_segment']  = 5;
        $config['num_links']    = 10;
        $config['first_link']   = '<< First';
        $config['last_link']    = 'Last >>';
        $config['next_link']    = 'Next ' . '&gt;';
        $config['prev_link']    = '&lt;' . ' Previous';
        $config['num_tag_open'] = '<span class="number">';
        $config['num_tag_close'] = '</span>';
        $config['cur_tag_open'] = '<span class="current"><a href="#">';
        $config['cur_tag_close'] = '</a></span>';
        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_user_details'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('refferaluser_list', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'refferaluser_list',
            'addscripts'            => 'cart_list',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->cart_model->get_reffer_user_details('all', $config['per_page'], $offset),
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_user_details'   => $all_language_data['admin_user_details'],
            'admin_static_links'    => $all_language_data['admin_static_links']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/refferalusers/refferalusers_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }


    /**
     * Method delete
     * This Function  delete single order as per the order id passed in the parameter.
     * @param $id $id [This parameter is the order id.]
     *
     * @return void
     */
    function delete($id)
    {
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('cart');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $this->comman_model->delete_where('refferal_users', array('id' => $id));
        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect('admin/referralusers');
    }

    /**
     * Method viewUser
     * This function display view  of single user as per id passed in the parameter.
     * @param $id $id [This parameter is the  order id.]
     *
     * @return void
     */
    function view($id = false)
    {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('cart');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'product_instruction', 'admin_user_details'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('user_details', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'users',
            'addscripts'            => 'list_cart_details',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'main_data'             => $this->cart_model->get_user_details('single', '', '', $id),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_user_details'   => $all_language_data['admin_user_details'],
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'product_instruction'   => $all_language_data['product_instruction']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/refferalusers/refferalusers_details', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }



    /**
     * Method update_status
     * This Function update status in the table as per table name passed in the post parameter.
     * @return void
     */
    function update_status()
    {
        $post_data = array('status' => $this->security->xss_clean($this->input->post('status')));
        $id = $this->security->xss_clean($this->input->post('id'));
        $table_name = "refferal_users";
        $this->comman_model->update_data_by_id($table_name, $post_data, 'id', $id);
    }



    /**
     * Method add_productmakers
     * This Function Display Add product maker and save the new maker   in the database.
     * @return void
     */
    function add()
    {

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('cart');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {
        }

        $plang      = $this->comman_model->getPrimaryLang();
        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer'), $this->lang->default_lang_id);


        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('add_refferal', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'refferaluser_list',
            'addscripts'            => 'add_users',
            'countries'                   => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'sub_menu'              => 'add_article',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'cart_instruction'         => (object)$userLangData['cart_instruction'],
            'form_validation_instruction' => (object)$userLangData['form_validation_instruction'],
            'general_instruction'        => (object)$userLangData['general_instruction'],
            'admin_links'    => (object)$userLangData['admin_static_links'],
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_products'        => $all_language_data['admin_products'],
            'product_catagory'      => "",
            'ip_data' =>getUserIpData()

        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/refferalusers/refferalusers_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }



    /**
     * Method add_productmakers
     * This Function Display Add product maker and save the new maker   in the database.
     * @return void
     */
    function edit($id)
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

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {
        }

        $plang      = $this->comman_model->getPrimaryLang();
        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer'), $this->lang->default_lang_id);

        $edit_data =  $this->comman_model->get_data_by_id('refferal_users', array('id' => $id));
        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('edit_refferal', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'refferaluser_list',
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
            'edit_data'             => $edit_data,
            'edit_term'             => $this->comman_model->get_data_by_id('user_terms', array('user_id' => $id)),
            'admin_products'        => $all_language_data['admin_products'],
            'product_catagory'      => ""
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/refferalusers/refferalusers_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }


    function save_data()
    {

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction'), $this->lang->default_lang_id);
        $form_validation_instruction =  (object)$all_language_data['form_validation_instruction'];
        $postData = $this->security->xss_clean($this->input->post());


        if ($this->input->post('operation')) {

            $postData = $this->security->xss_clean($this->input->post());

            $postData['country_code'] = str_replace('+', '', $postData['country_code']);
            $userExist = $this->user_model->checkRefferalExist($postData);


            if ($userExist == 1 &&  empty($postData['user_id'])) {

                $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                $error_lang = "User Already Exist with same details.";
                // if file is not uploaded than  this function set error  message in flash to display on frontend.
                $this->session->set_flashdata('error', $error_lang);
                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/referralusers/add');
            }


            // this code  save user in the users table 
            $usersData = array();
            $usersData['title'] = $postData['title'];
            $usersData['surname'] = $postData['surname'];
            $usersData['email'] = $postData['email'];
            $usersData['company'] = $postData['company'];
            $usersData['country'] = $postData['country'];
            $usersData['country_code'] = $postData['country_code'];
            $usersData['telephone'] = $postData['telephone'];
            $usersData['notes'] = $postData['notes'];
            $usersData['createddate'] = date('Y-m-d H:i:s');
            if ($postData['refferal_no']) {
                $refferal_no = $postData['refferal_no'];
            } else {
                $refferal_no = generate_customer_no();
            }
            $usersData['refferal_no'] = $refferal_no;
            if (empty($postData['user_id'])) {
                $usersData['status'] = "1";
                $userId = $this->comman_model->add('refferal_users', $usersData);
            } else {
                // this code  update users in the admin_users table 
                $this->comman_model->update_data_by_id('refferal_users', $usersData, 'id', $postData['user_id']);
                $userId = $postData['user_id'];
            }



            if ($userId) {

                // this function set success message in flash to display on frontend.
                $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);

                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/referralusers');
            } else {
                $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                $error_lang = "Submit the valid form ";

                // if file is not uploaded than  this function set error  message in flash to display on frontend.
                $this->session->set_flashdata('error', $error_lang);
                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/referralusers/add');
            }
        } else {
            $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
            $error_lang = "Submit the valid form ";

            // if file is not uploaded than  this function set error  message in flash to display on frontend.
            $this->session->set_flashdata('error', $error_lang);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/referralusers/add');
        }
    }

    /**
     * Method checkEmailExists
     * This Function checked that is email  exist in the admin_users or not.
     * @param $id $id [This parameter is the user id.]
     * @return void
     */
    public function checkEmailExists($refferalid ="")
    {
        // this is email  which is passes using post parameter
        $email = $this->security->xss_clean($this->input->post('email'));
        $id = $refferalid;
        if ($email && $id) {
            $result = $this->comman_model->get_data_by_id('refferal_users', array('id' => $id));
            if ($email == $result['email']) {
                // if not  exist than this code return true
                echo json_encode(TRUE);
            } else {
                // this function check is email  exist in the table  or not.
                $exists = $this->comman_model->check_row_exists('refferal_users', array('email' => $email));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        } else if ($email) {
            // this function check is email  exist in the table  or not.
            $exists = $this->comman_model->check_row_exists('refferal_users', array('email' => $email));
            if ($exists) {
                // if exist than this code return false
                echo json_encode(FALSE);
            } else {
                // if not  exist than this code return true
                echo json_encode(TRUE);
            }
        }
    }



    /**
     * Method checkCustomerExists
     * This Function checked that is Customer number   exist in the users or not.
     * @param $id $id [This parameter is the user id.]
     * @return void
     */
    public function checkCustomerExists($refferalid ="")
    {
        // this is email  which is passes using post parameter
        $refferal_no = $this->security->xss_clean($this->input->post('refferal_no'));
        $id = $refferalid;
        if ($refferal_no && $id) {
            $result = $this->comman_model->get_data_by_id('refferal_users', array('id' => $id));
            if ($refferal_no == $result['refferal_no']) {
                // if not  exist than this code return true
                echo json_encode(TRUE);
            } else {
                // this function check is email  exist in the table  or not.
                $exists = $this->comman_model->check_row_exists('refferal_users', array('refferal_no' => $refferal_no));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        } else if ($refferal_no) {
            // this function check is email  exist in the table  or not.
            $exists = $this->comman_model->check_row_exists('refferal_users', array('refferal_no' => $refferal_no));
            if ($exists) {
                // if exist than this code return false
                echo json_encode(FALSE);
            } else {
                // if not  exist than this code return true
                echo json_encode(TRUE);
            }
        }
    }

    /**
     * Method checkPhoneExists
     * This Function checked that is phone  exist in the admin_users or not.
     * @param $id $id [This parameter is the user id.]
     * @return void
     */
    public function checkPhoneExists($refferral_id="")
    {
        $country_code = str_replace('+', '', $this->security->xss_clean($this->input->post('country_code')));
        $id = $refferral_id;
        $telephone    = $this->security->xss_clean($this->input->post('telephone'));
        if ($id && $country_code && $telephone) {
            $result = $this->comman_model->get_data_by_id('refferal_users', array('id' => $id));
            if ($country_code == $result['country_code'] && $telephone == $result['telephone']) {
                echo json_encode(TRUE);
            } else {
                // this function check is phone exist in the table with same phone or not.
                $exists = $this->comman_model->check_row_exists('refferal_users', array('country_code' => $country_code, 'telephone' => $telephone));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        } else if ($country_code && $telephone) {
            // this function check is phone exist in the table with same phone or not.
            $exists = $this->comman_model->check_row_exists('refferal_users', array('country_code' => $country_code, 'telephone' => $telephone));
            if ($exists) {
                // if exist than this code return false
                echo json_encode(FALSE);
            } else {
                // if not  exist than this code return true
                echo json_encode(TRUE);
            }
        }
    }
}
