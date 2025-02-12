<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Referralusers
 * This Class handle all functions related to orders. Display orders list, delete order and view order.
 */
class Discountsusers extends CI_Controller
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
        $access = validatePageAccess('discountusers_list');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $key    = $this->security->xss_clean($this->input->post('search'));
        $offset = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/orders/index/";
        $config['total_rows']   = $this->cart_model->get_discountusers_list('count');
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
        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer'), $this->lang->default_lang_id);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_user_details'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        $users = $this->comman_model->get_all_data_by_id('users', array('user_status' => "1"));

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('discountusers_list', 'admin_title'),
            'users' => $users,
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'discountusers_list',
            'addscripts'            => 'cart_list',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->cart_model->get_discountusers_list('all', $config['per_page'], $offset),
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'cart_instruction'         => (object)$userLangData['cart_instruction'],
            'form_validation_instruction' => (object)$userLangData['form_validation_instruction'],
            'general_instruction'        => (object)$userLangData['general_instruction'],
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_user_details'   => $all_language_data['admin_user_details'],
            'admin_static_links'    => $all_language_data['admin_static_links']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/discountsusers/discountsusers_list', $pageData);
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
        $access = validatePageAccess('discountusers_list');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        $this->comman_model->delete_where('user_discounts', array('id' => $id));
        $this->comman_model->delete_where('user_discounts_ranges', array('discount_id' => $id));
        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect('admin/discountsusers');
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
        $table_name = "user_discounts";
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
        $access = validatePageAccess('discountusers_list');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {
        }

        $plang      = $this->comman_model->getPrimaryLang();
        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer'), $this->lang->default_lang_id);
        $users = $this->comman_model->get_all_data_by_id('users', array('user_status' => "1"));

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('add_user_discount', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'users' => $users,
            'active'                => 'discountusers_list',
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
            'product_catagory'      => ""
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/discountsusers/discountsusers_form', $pageData);
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
        $access = validatePageAccess('discountusers_list');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {
        }

        $plang      = $this->comman_model->getPrimaryLang();
        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'form_validation_instruction', 'admin_static_links', 'entry_door_timer'), $this->lang->default_lang_id);

        $edit_data =  $this->comman_model->get_data_by_id('user_discounts', array('id' => $id));
        // echo "<pre>";print_r($edit_data);die;
        $users = $this->comman_model->get_all_data_by_id('users', array('user_status' => "1"));
        $products = $this->comman_model->get_all_data_by_id('products', array('status' => "1"));
        $edit_ranges = $this->comman_model->get_all_data_by_id('user_discounts_ranges', array('discount_id' => $id));


        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('edit_user_discount', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'users' => $users,
            'products' => $products,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'discountusers_list',
            'addscripts'            => 'add_users',
            'edit_ranges' => $edit_ranges,
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
        $this->load->view('admin/discountsusers/discountsusers_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }


    /**
     * Method save_data
     *
     * @return void
     */
    function save_data()
    {

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction'), $this->lang->default_lang_id);
        $form_validation_instruction =  (object)$all_language_data['form_validation_instruction'];
        $postData = $this->security->xss_clean($this->input->post());


        if ($this->input->post('operation')) {

            $postData = $this->security->xss_clean($this->input->post());;




            // this code  save user in the users table 
            $insertData = array();
            $insertData['expirytime'] = $postData['expirytime'];
            $insertData['users'] = implode(',', $postData['coupon_users']);
            $insertData['products'] = implode(',', $postData['products']);
            $insertData['createddate'] = date('Y-m-d H:i:s');

            if (empty($postData['discount_id'])) {
                $insertData['status'] = "1";
                $insertID = $this->comman_model->add('user_discounts', $insertData);
            } else {
                // this code  update users in the admin_users table 
                $this->comman_model->update_data_by_id('user_discounts', $insertData, 'id', $postData['discount_id']);
                $insertID = $postData['discount_id'];
            }



            if ($insertID) {

                $fromstart = $postData['fromstart'];
                $fromend = $postData['fromend'];
                $percetnage = $postData['percentage'];

                $this->comman_model->delete_where('user_discounts_ranges', array('discount_id' => $insertID));


                foreach ($fromstart  as $key => $from) {


                    $range = array(
                        'discount_id' => $insertID,
                        'fromstart'  => $fromstart[$key],
                        'fromend'    => $fromend[$key],
                        'percentage' => $percetnage[$key]
                    );
                    $ranges_data[] = $range;
                }


                if (count($ranges_data) > 0) {
                    // this function save data in the discount_ranges table
                    $this->db->insert_batch('user_discounts_ranges', $ranges_data);
                }


                // this function set success message in flash to display on frontend.
                $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);

                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/discountsusers');
            } else {
                $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                $error_lang = "Submit the valid form ";

                // if file is not uploaded than  this function set error  message in flash to display on frontend.
                $this->session->set_flashdata('error', $error_lang);
                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/discounts/add');
            }
        } else {
            $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
            $error_lang = "Submit the valid form ";

            // if file is not uploaded than  this function set error  message in flash to display on frontend.
            $this->session->set_flashdata('error', $error_lang);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/discounts/add');
        }
    }
}
