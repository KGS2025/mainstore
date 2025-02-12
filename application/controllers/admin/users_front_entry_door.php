<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Users_front_entry_door
 * Users_front_entry_door Class handle all methods  related to block list of front  section like list  users, delete users.
 */
class Users_front_entry_door extends CI_Controller {

    /**
     * __construct
     *
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model(array('comman_model', 'users_front_entry_door_model'));
        $this->load->helper('assets');
        validateAdminLogin();
        validateUser();
    }

    /**
     * Method index
     *  This Function Display front end users list data. This Function also used to download the displayed data in the csv.
     * @return void
     */
    function index($param1='',$param2=0) {  

        check_lang_admin();
        
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('users_front_entry_door');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $param1  = urldecode($param1);
        $keypost = trim($this->security->xss_clean($this->input->post('search')));
        $offset  = 0; $key = ''; $uri_segment = 5;
        if (isset($param1) && $param1 != '' && isset($param2) && $param2 != '') {
            $offset = $param2;
            $key    = $param1;
            $uri_segment = 6;
        }else if (isset($param1) && $param1 != '') {
            $offset = $param1;
        }else if (isset($keypost) && $keypost != '') {
            $key = $keypost;
        }

        $config['per_page']    = 50;
        $config['num_links']   = 5;
        $config['uri_segment'] = $uri_segment;
        $config['first_link']  = '<< First';
        $config['last_link']   = 'Last >>';
        $config['next_link']   = 'Next ' . '&gt;';
        $config['prev_link']   = '&lt;' . ' Previous';

        if ($key) {
            // if pagination get parameter is set in the url than this code execute.
            $config['base_url']    = base_url() . "admin/" . $this->lang->default_lang . "/users_front_entry_door/index/" . urlencode($key);
            $config['total_rows']  = $this->comman_model->record_search_count('users_front_entry_door', $key, array('applicant', 'country', 'telephone', 'email'));
        } else {
            $config['base_url']    = base_url() . "admin/" . $this->lang->default_lang . "/users_front_entry_door/index/";
            $config['total_rows']  = $this->comman_model->record_count('users_front_entry_door');
        }

        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_users_front_entry_door'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('user_list_front_door', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'users_front_entry_door_list',
            'addscripts'            => 'users_front_entry_door_list',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'all_data'              => $this->users_front_entry_door_model->get_row_in_array($key, $config['per_page'], $offset, $this->lang->default_lang_id),
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_users_front_entry_door'   => $all_language_data['admin_users_front_entry_door']
        );

        if(isset($_POST['submit']) && $_POST['submit'] == 'downloadcsv'){
            // this function download the csv 
            $this->load->view('admin/users_front_entry_door/users_front_entry_door_list_export', $pageData);
        } else {
            $this->load->view('admin/common/header', $pageData);
            $this->load->view('admin/common/left_menu', $pageData);
            $this->load->view('admin/users_front_entry_door/users_front_entry_door_list', $pageData);
            $this->load->view('admin/common/footer', $pageData);
        }
    }
}