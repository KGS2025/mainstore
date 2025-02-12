<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Adminrole
 * This Class Handle all functions related to Admin user role like Add, Edit, List Delete etc. 
 */
class Adminrole extends CI_Controller {

     /**
     * __construct
     *
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model(array('comman_model', 'adminrole_model'));
        $this->load->helper('assets');
        validateAdminLogin();
        validateUser();
    }
    
    /**
     * Method index
     * This Function list all roles with pagination.
     * @return void
     */
    function index() {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('adminrole');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $keypost = trim($this->security->xss_clean($this->input->post('search')));
        $seg5    = $this->uri->segment(5);
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

        $plang        = $this->comman_model->getPrimaryLang();
        $primary_lang = !empty($plang) ? $plang['short_code'] : 'en';

        $config['per_page']  = 50;
        $config['num_links'] = 5;
        if ($key) {
            // if pagination get parameter is set in the url than this code execute.
            $config['base_url']    = base_url() . "admin/adminrole/index/" . $key;
            $config['uri_segment'] = 5;
            $config['total_rows']  = $this->comman_model->record_search_count('admin_roles', $key, array('role'));
            $offset                = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

            if($this->lang->default_lang != $primary_lang) {
                $all_data = $this->adminrole_model->getLanagugeAdminRoles($key, $this->lang->default_lang_id);               
                if(empty($all_data)) {
                    $all_data = $this->adminrole_model->search_admin_role_data($key, $config['per_page'], $offset, $this->lang->default_lang_id);
                }
            } else {
                $all_data = $this->adminrole_model->search_admin_role_data($key, $config['per_page'], $offset, $this->lang->default_lang_id);
            }   
        } else {
            $config['base_url']    = base_url() . "admin/adminrole/index/";
            $config['uri_segment'] = 4;
            $config['total_rows']  = $this->comman_model->record_count('admin_roles');
            $offset                = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $all_data              = $this->adminrole_model->search_admin_role_data($key, $config['per_page'], $offset, $this->lang->default_lang_id);
        }
        
        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_admin_roles'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('admin_roles', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'adminrole',
            'addscripts'            => 'adminrole',
            'primary_lang'          => $primary_lang, 
            'all_data'              => $all_data,
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_admin_roles'     => $all_language_data['admin_admin_roles']
        );
        
        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/adminrole/adminrole_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method delete_adminrole
     *  This Function delete single  row as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the row id of the admin_blocks_list table. ]
     *
     * @return void
     */
    function delete_selected_adminrole() {
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('admin_blocks_list');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        // this function delete the record by row id from admin_roles, admin_users and admin_role_access.

        if ($this->input->post('DeleteAll')) {
            // this function delete all roles 
            $this->adminrole_model->deleteAllAdminRoles();
        }

        if ($this->input->post('DeleteSelected')) {
            // this function delete all roles as per the role ids posted  in the post parameter.
            $adminRoleIds = $this->security->xss_clean($this->input->post('deleteitem'));
            $this->comman_model->deleteAllById('admin_roles', $adminRoleIds, 'id');
            $this->comman_model->deleteAllById('admin_users', $adminRoleIds, 'role_id');
            $this->comman_model->deleteAllById('admin_role_access', $adminRoleIds, 'role_id');
        }

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/adminrole');
    }
    
    /**
     * Method delete_adminrole
     *  This Function delete single  row as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the row id of the admin_blocks_list table. ]
     *
     * @return void
     */
    function delete_adminrole($id) {
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('admin_blocks_list');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }
         // this function delete the record by row id from admin_roles, admin_users and admin_role_access.
        $this->comman_model->delete_where('admin_roles ', array('id' => $id));
        $this->comman_model->delete_where('admin_users', array('role_id' => $id));
        $this->comman_model->delete_where('admin_role_access', array('role_id' => $id));

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/adminrole');
    }
    
    /**
     * Method add_adminrole
     * 
     * This Function Display Add role form and save the new role.
     * @return void
     */
    function add_adminrole() {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('adminrole');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            $post_data = array(
                'role'    => trim($this->security->xss_clean($this->input->post('roles'))),
                'created' => date('Y-m-d')
            );
            // this code  save role in the admin_roles table 
            $result = $this->comman_model->add('admin_roles', $post_data);

            $pageaccess_data = $this->security->xss_clean($this->input->post('pageaccess'));
            // this function save page access related to role in the database.
            $this->adminrole_model->updatePageAccess($pageaccess_data, $result);

            // this function set success message in flash to display on frontend.
            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect('admin/adminrole');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_admin_roles', 'admin_role_page'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('admin_roles', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'adminrole',
            'sub_menu'              => 'add_adminrole',
            'addscripts'            => 'adminrole',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_admin_roles'     => $all_language_data['admin_admin_roles'],
            'pages'                 => $all_language_data['admin_role_page']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/adminrole/admin_role_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method edit_adminrole
     * This Function Display edit role form and update the  role the behalf of role id passed in the parameter.
     * @param $id $id [This parameter is the role id.]
     *
     * @return void
     */
    function edit_adminrole($id = false) {
        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/adminrole');
        }

        check_lang_admin();

        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('adminrole');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        
        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            $post_data = array(
                'role'    => trim($this->security->xss_clean($this->input->post('roles'))),
                'created' => date('Y-m-d')
            );

            // this code  update role in the admin_roles table 
            $result = $this->comman_model->update_data_by_id('admin_roles', $post_data, 'id', $id);

            $pageaccess_data = $this->security->xss_clean($this->input->post('pageaccess'));
            // this function update page access related to role in the database.
            $this->adminrole_model->updatePageAccess($pageaccess_data, $id, 'edit');

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect('admin/adminrole');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_admin_roles', 'admin_role_page'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        $userAccess = $this->adminrole_model->getRoleAccess($id);
        $permission = array();
        if(count($userAccess) > 0){
            foreach ($userAccess as $access) {
                $permission[$access['page']] = array(
                    'page_access'   => $access['page_access'],
                    'page_add'      => $access['page_add'],
                    'page_edit'     => $access['page_edit'],
                    'page_delete'   => $access['page_delete']
                );
            }
        }

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('admin_roles', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'adminrole',
            'addscripts'            => 'edit_adminrole',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_admin_roles'     => $all_language_data['admin_admin_roles'],
            'pages'                 => $all_language_data['admin_role_page'],
            'edit_data'             => $this->adminrole_model->getAdminRoleById('admin_roles', $id, $this->lang->default_lang_id),
            'userAccess'            => $permission
            
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/adminrole/admin_role_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method checkRoleExists
     * This Function checked that is role exist in the admin_roles or not.
     * @param $id $id [This parameter is the user id.]
     * @return void
     */
    public function checkRoleExists($id = '') {
        // this is role which is passes using post parameter
        $role = $this->security->xss_clean($this->input->post('role'));
        if($id && $role){
            $result = $this->comman_model->get_data_by_id('admin_roles', array('id' => $id));
            if ($role == $result['role']) {
                echo json_encode(TRUE);
            }else{
                // this function check is role exist in the table with same name or not.
                $exists = $this->comman_model->check_row_exists('admin_roles', array('role' => $role));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        }else if ($role) {
            // this function check is role exist in the table with same name or not.
            $exists = $this->comman_model->check_row_exists('admin_roles', array('role' => $role));
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