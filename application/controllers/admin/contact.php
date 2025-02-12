<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Contact
 * Contact Class handle all methods  related to contact user list and delete the contacts.
 */
class Contact extends CI_Controller {
    
    /**
     * __construct
     *
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model(array('comman_model', 'contact_user_model'));
        $this->load->helper('assets');
        validateAdminLogin();
        validateUser();
    }

    /**
     * Method index
     * This Function Display contact users  list data.
     * @return void
     */
    function index($param1='',$param2=0) {

        check_lang_admin();

        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('contact_user');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        
        $keypost = trim($this->security->xss_clean($this->input->post('search')));
        $offset = 0; $key = ''; $uri_segment = 5;
        if (isset($param1) && $param1 != '' && isset($param2) && $param2 != '') {
            $offset = $param2;
            $key    = $param1;
            $uri_segment = 6;
        }else if (isset($param1) && $param1 != '') {
            $offset = $param1;
        }else if (isset($keypost) && $keypost != '') {
            $key = $keypost;
        }

        $config['per_page']     = 10;
        $config['num_links']    = 5;
        $config['uri_segment']  = $uri_segment;
        $config['first_link']   = '<< First';
        $config['last_link']    = 'Last >>';
        $config['next_link']    = 'Next ' . '&gt;';
        $config['prev_link']    = '&lt;' . ' Previous';

        if ($key) {
            // if pagination get parameter is set in the url than this code execute.
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/contact/index/" . $key;
            $config['total_rows']   = $this->contact_user_model->record_search_count($key);
        } else {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/contact/index/";
            $config['total_rows']   = $this->contact_user_model->record_search_count();
        }

        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_contact_list'), $this->lang->default_lang_id);
        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('contact_user', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'contact_user',
            'addscripts'            => 'contact_user',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'all_data'              => $this->contact_user_model->search_contact_user_data($key, $config['per_page'], $offset),
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_contact_list'    => $all_language_data['admin_contact_list']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/contact_user/contact_user_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method delete_selected_contact_user
     *  This Function delete selected row as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the row id of the user_blocked table. ]
     *
     * @return void
     */
    function delete_selected_contact_user() {
        $access = validatePageAccess('contact_user');
        //  this function validate the access of this page for current logged admin user.
        if ($access['page_delete'] != 1) {
        // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
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
        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/contact');
    }

    /**
     * Method delete_contact_user
     *  This Function delete single  row as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the row id of the user_blocked table. ]
     *
     * @return void
     */
    function delete_contact_user($id) {
        $access = validatePageAccess('contact_user');
        //  this function validate the access of this page for current logged admin user.
        if ($access['page_delete'] != 1) {
        // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $contact_data = $this->comman_model->get_data_by_id('contact_form', array('id' => $id));
        if(isset($contact_data['email']) && $contact_data['email']){
            $this->comman_model->deleteAllById('block_email_list', array($contact_data['email']), 'str_email');
        }

        // this function delete the record by id.
        $this->comman_model->delete_where('contact_form', array('id' => $id));

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);
        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/contact');
    }

}