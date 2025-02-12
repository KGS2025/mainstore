<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Userblocked
 * Userblocked Class handle all methods  related to block list of admin section like list blocked users, delete users.
 */
class Userblocked extends CI_Controller {
    
    /**
     * __construct
     *
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model(array('comman_model', 'userblocked_model'));
        $this->load->helper('assets');
        validateAdminLogin();
        validateUser();
    }

    /**
     * Method index
     * This Function Display  users  block list data.
     * @return void
     */
    function index() {

        check_lang_admin();

        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('userblocked');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        
        $keypost = trim($this->security->xss_clean($this->input->post('search')));
        $seg5 = $this->uri->segment(5);

        if (isset($seg5) && $seg5 != '') {
            $keyget = $this->uri->segment(4);
        }

        if (isset($keypost) && $keypost != '') {
            $key = $keypost;
        } else if (isset($keyget) && $keyget != '') {
            $key = $keyget;
        } else {
            $key = '';
        }

        $config['per_page'] = 50;
        $config['num_links'] = 5;

        if ($key) {
            // if pagination get parameter is set in the url than this code execute.
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/userblocked/index/" . $key;
            $config['uri_segment']  = 5;
            $config['total_rows']   = $this->comman_model->record_search_count('user_blocked', $key, array('email'));
            $offset                 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
            $all_data               = $this->userblocked_model->search_user_blocked_data($key, $config['per_page'], $offset);
        } else {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/userblocked/index/";
            $config['uri_segment']  = 4;
            $config['total_rows']   = $this->comman_model->record_count('user_blocked');
            $offset                 = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $all_data               = $this->userblocked_model->search_user_blocked_data($key, $config['per_page'], $offset);
        }

        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_block_users'), $this->lang->default_lang_id);
        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('block_users', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'userblocked',
            'addscripts'            => 'userblocked',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'all_data'              => $all_data,
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_block_users'     => $all_language_data['admin_block_users']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/userblocked/userblocked_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method delete_userblocked
     *  This Function delete single  row as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the row id of the user_blocked table. ]
     *
     * @return void
     */
    function delete_selected_blocked_user() {
        $access = validatePageAccess('userblocked');
        //  this function validate the access of this page for current logged admin user.
        if ($access['page_delete'] != 1) {
        // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteAll')) {
            // this function delete all users 
            $this->comman_model->deleteAllDataWithLang('user_blocked');
        }

        if ($this->input->post('DeleteSelected')) {
            // this function delete all users as per the users ids posted  in the post parameter.
            $blockedIds = $this->security->xss_clean($this->input->post('deleteitem'));
            $this->comman_model->deleteAllById('user_blocked', $blockedIds, 'id');
        }

        // this function delete the record by id.
        $this->comman_model->delete_where('user_blocked ', array('id' => $id));

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);
        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/userblocked');
    }

    /**
     * Method delete_userblocked
     *  This Function delete single  row as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the row id of the user_blocked table. ]
     *
     * @return void
     */
    function delete_userblocked($id) {
        $access = validatePageAccess('userblocked');
        //  this function validate the access of this page for current logged admin user.
        if ($access['page_delete'] != 1) {
        // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        // this function delete the record by id.
        $this->comman_model->delete_where('user_blocked ', array('id' => $id));

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);
        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/userblocked');
    }

      /**
     * Method add_adminuser
     * This Function Display Add user form and save the new user.
     * @return void
     */
    function add_userblocked() {
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('userblocked');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            $post_data = array(
                'country'       => trim($this->input->post('country')),
                'country_code'  => str_replace('+', '', $this->input->post('country_code')),
                'telephone'     => trim($this->input->post('telephone')),
                'email'         => trim($this->input->post('email')),
                'created'       => date('Y-m-d')
            );
            $post_data = $this->security->xss_clean($post_data);

            // this code  save user in the user_blocked table 
            $result = $this->comman_model->add('user_blocked', $post_data);

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/userblocked');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_block_users'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('block_users', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'userblocked',
            'sub_menu'              => 'add_userblocked',
            'addscripts'            => 'add_userblocked',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_block_users'     => $all_language_data['admin_block_users'],
            'ip_data' =>getUserIpData()

        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/userblocked/userblocked_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method edit_adminuser
     * This Function Display edit user form and update the  user the behalf of user id passed in the parameter.
     * @param $id $id This parameter is the user id.]
     *
     * @return void
     */
    function edit_userblocked($id = false) {
        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/userblocked');
        }
       
        $access = validatePageAccess('userblocked');
        if ($access['page_edit'] != 1) {
            // this function validate the access of this page for current logged admin user.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();
        
        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            $post_data = array(
                'country'       => trim($this->input->post('country')),
                'country_code'  => str_replace('+', '', $this->input->post('country_code')),
                'telephone'     => trim($this->input->post('telephone')),
                'email'         => trim($this->input->post('email')),
                'created'       => date('Y-m-d')
            );
            $post_data = $this->security->xss_clean($post_data);

            $all_data = $this->comman_model->get_data_by_id('user_blocked', array('id' => $id));

            // this code  update users in the user_blocked table 
            $this->comman_model->update_data_by_id('user_blocked', $post_data, 'id', $id);
            
            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
            
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/userblocked');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_block_users'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('block_users', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'userblocked',
            'addscripts'            => 'edit_userblocked',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_block_users'     => $all_language_data['admin_block_users'],
            'edit_data'             => $this->comman_model->get_data_by_id('user_blocked', array('id' => $id))
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/userblocked/userblocked_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method checkEmailExists
     * This Function checked that is email  exist in the admin_users or not.
     * @param $id $id [This parameter is the user id.]
     * @return void
     */
    public function checkEmailExists($id = '') {
        // this is email  which is passes using post parameter
        $email = $this->security->xss_clean($this->input->post('email'));
        if($email && $id){
            $result = $this->comman_model->get_data_by_id('user_blocked', array('id' => $id));
            if ($email == $result['email']) {
                // if not  exist than this code return true
                echo json_encode(TRUE);
            }else{
                // this function check is email  exist in the table  or not.
                $exists = $this->comman_model->check_row_exists('user_blocked', array('email' => $email));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        }else if ($email) {
            // this function check is email  exist in the table  or not.
            $exists = $this->comman_model->check_row_exists('user_blocked', array('email' => $email));
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
     * This Function checked that is phone  exist in the user_blocked or not.
     * @param $id $id [This parameter is the user id.]
     * @return void
     */
    public function checkPhoneExists($id = '') {
        $country_code = $this->security->xss_clean($this->input->post('country_code'));
        $telephone    = $this->security->xss_clean($this->input->post('telephone'));
        if($id && $country_code && $telephone){
            $result = $this->comman_model->get_data_by_id('user_blocked', array('id' => $id));
            if ($country_code == $result['country_code'] && $telephone == $result['telephone']) {
                echo json_encode(TRUE);
            }else{
                // this function check is phone exist in the table with same phone or not.
                $exists = $this->comman_model->check_row_exists('user_blocked', array('country_code' => $country_code, 'telephone' => $telephone));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        }else if ($country_code && $telephone) {
            // this function check is phone exist in the table with same phone or not.
            $exists = $this->comman_model->check_row_exists('user_blocked', array('country_code' => $country_code, 'telephone' => $telephone));
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