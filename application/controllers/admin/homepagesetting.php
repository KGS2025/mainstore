<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Homepagesetting
 * This Function handle different sections of front end. For eg  dynamic pages, navgation, banner images, social media, what new etc section. This class handle complete crud operation for each section like list, add, edit , delete etc.
 */
class Homepagesetting extends CI_Controller {

    /**
     * Method __construct
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model(array('comman_model', 'pages_model'));
        $this->load->helper('assets');
        validateAdminLogin();
        validateUser();
    }
    
    /**
     * Method index
     * This function list all pages. 
     * @return void
     */
    function index() {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('pages');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteAll')) {
            // this code  delete all pages from pages table
            $this->comman_model->deleteAllDataWithLang('pages');
        }

        if ($this->input->post('DeleteSelected')) {
            $pageIds = $this->security->xss_clean($this->input->post('deleteitem'));
            $this->comman_model->deleteAllById('pages', $pageIds);
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

        $config['per_page'] = 50;
        $config['num_links'] = 5;

        if ($key) {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/homepagesetting/index/" . $key;
            $config['uri_segment']  = 5;
            $config['total_rows']   = $this->comman_model->record_search_count('pages', $key, array('email'));
            $offset                 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
            $all_data               = $this->pages_model->get_search_key_data('pages', $key, 'email', $config['per_page'], $offset, $this->lang->default_lang_id);
        } else {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/homepagesetting/index/";
            $config['uri_segment']  = 4;
            $config['total_rows']   = $this->comman_model->record_count('pages');
            $offset                 = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $all_data               = $this->pages_model->get_search_key_data('pages', $key, 'email', $config['per_page'], $offset, $this->lang->default_lang_id);
        }

        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_pages'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('pages_block', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'pages',
            'addscripts'            => 'pages',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'all_data'              => $all_data,
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_pages']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/page_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method delete_page
     * This Function delete single page  as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the page id. ]
     *
     * @return void
     */
    function delete_page($id) {
         // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('pages');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        // this code delete pages from table pages and  as per id
        $this->comman_model->delete_where('pages ', array('id' => $id));

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting');
    }
    
    /**
     * Method add_page
     * This Function Display Add page form  and save the new page   in the database.
     * @return void
     */
    function add_page() {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('pages');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            // this array is intialized to save in the database
            $post_data = array(
                'title'     => trim($this->input->post('title')),
                'page_url'  => trim($this->input->post('page_url')),
                'content'   => htmlspecialchars($this->input->post('content', FALSE)),
                'status'    => $this->input->post('status'),
                'created'   => date('Y-m-d')
            );
            $post_data = $this->security->xss_clean($post_data);
            // this function add new record  in the database
            $this->comman_model->add('pages', $post_data);

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_pages'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('pages_block', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'pages',
            'sub_menu'              => 'add_pages',
            'addscripts'            => 'add_pages',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_pages']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/page_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method edit_page
     * This Function Display edit page form  and update  record   in the database.
     * @param $id $id [This Parameter is the row  id. ]
     *
     * @return void
     */
    function edit_page($id = false) {
        if (!$id) {
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('pages');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            // this array is intialized to save in the database
            $post_data = array(
                'title'     => trim($this->input->post('title')),
                'page_url'  => trim($this->input->post('page_url')),
                'content'   => htmlspecialchars($this->input->post('content', FALSE)),
                'status'    => $this->input->post('status')
            );
            $post_data = $this->security->xss_clean($post_data);
            // this function update record in the database
            $this->comman_model->update_data_by_id('pages', $post_data, 'id', $id);

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting');
        }
        
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_pages'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('pages_block', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'pages',
            'addscripts'            => 'edit_pages',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_pages'],
            'edit_data'             => allDataArray($this->comman_model->GetAllDataLangByid('pages', 'id', $id, $this->lang->default_lang_id, 'pages_country'))
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/page_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method checkPageExists
     * This Function checked that is page with title  exist in the pages or not.
     * @param $id $id [explicite description]
     *
     * @return void
     */
    public function checkPageExists($id = '') {
        $title = $this->security->xss_clean($this->input->post('title'));
        if($id && $title){
            $result = $this->comman_model->get_data_by_id('pages', array('id' => $id));
            if ($title == $result['title']) {
                echo json_encode(TRUE);
            }else{
                // this function check is record exist in the table with title  or not.
                $exists = $this->comman_model->check_row_exists('pages', array('title' => $title));
                if ($exists) {
                     // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        }else if ($title) {
            // this function check is record exist in the table with title  or not.
            $exists = $this->comman_model->check_row_exists('pages', array('title' => $title));
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
     * Method checkPageurlExists
     * This function check is record exist in the table with url  or not.
     * @param $id $id [explicite description]
     *
     * @return void
     */
    public function checkPageurlExists($id = '') {
        $page_url = $this->security->xss_clean($this->input->post('page_url'));
        if($id && $page_url){
            $result = $this->comman_model->get_data_by_id('pages', array('id' => $id));
            if ($page_url == $result['page_url']) {
                echo json_encode(TRUE);
            }else{
                // this function check is record exist in the table with url  or not.
                $exists = $this->comman_model->check_row_exists('pages', array('page_url' => $page_url));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            } 
        }else if ($page_url) {
            // this function check is record exist in the table with url  or not.
            $exists = $this->comman_model->check_row_exists('pages', array('page_url' => $page_url));
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
     * Method navigation_setting
     * This function list navigantion records. 
     * @return void
     */
    function navigation_setting() {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('navigation_setting');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteAll')) {
            // this code  delete all rows from navigation_pages table
            $this->comman_model->deleteAllDataWithLang('navigation_pages');
        }

        if ($this->input->post('DeleteSelected')) {
            $pageIds = $this->security->xss_clean($this->input->post('deleteitem'));
            $this->comman_model->deleteAllById('navigation_pages', $pageIds);
        }

        $keypost = trim($this->security->xss_clean($this->input->post('search')));
        $seg5    = $this->uri->segment(6);
        if (isset($seg5) && $seg5 != '') {
            $keyget = $this->uri->segment(5);
        }
        if (isset($keypost) && $keypost != '') {
            $key = $keypost;
        } else if (isset($keyget) && $keyget != '') {
            $key = $keyget;
        } else {
            $key = '';
        }

        $config['per_page']     = 50;
        $config['num_links']    = 5;

        if ($key) {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/navigation_pages/index/" . $key;
            $config['uri_segment']  = 6;
            $config['total_rows']   = $this->comman_model->record_search_count('navigation_pages', $key, array('email'));
            $offset                 = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
            $all_data               = $this->pages_model->get_search_key_data('navigation_pages', $key, 'email', $config['per_page'], $offset, $this->lang->default_lang_id);
        } else {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/navigation_pages/index/";
            $config['uri_segment']  = 5;
            $config['total_rows']   = $this->comman_model->record_count('navigation_pages');
            $offset                 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
            $all_data               = $this->pages_model->get_search_key_data('navigation_pages', $key, 'email', $config['per_page'], $offset, $this->lang->default_lang_id);
        }

        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_navigation_pages'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('navigation_pages', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'navigation_setting',
            'addscripts'            => 'navigation_setting',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'all_data'              => $all_data,
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_navigation_pages']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/navigation_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method add_navigation_page
     * This Function Display Add navigantion form  and save the new navigantion   in the database.
     * @return void
     */
    function add_navigation_page() {
         // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('navigation_setting');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        check_lang_admin();
         
        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.

            // this array is intialized to save in the database
            $post_data = array(
                'title'     => trim($this->input->post('title')),
                'page_url'  => trim($this->input->post('page_url')),
                'status'    => $this->input->post('status'),
                'created'   => date('Y-m-d')
            );
            $post_data = $this->security->xss_clean($post_data);
            // this function add new record  in the database
            $this->comman_model->add('navigation_pages', $post_data);

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/navigation_setting');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_navigation_pages'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('navigation_pages', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'navigation_setting',
            'sub_menu'              => 'add_navigation_pages',
            'addscripts'            => 'add_navigation_pages',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_navigation_pages']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/navigation_page_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method edit_navigation_page
    * This Function Display edit navigantion form  and update  record   in the database.
    * @param $id $id [This Parameter is the navigantion id. ]
     *
     * @return void
     */
    function edit_navigation_page($id = false) {
        if (!$id) {
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/navigation_setting');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('navigation_setting');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            // this array is intialized to save in the database
            $post_data = array(
                'title'     => trim($this->input->post('title')),
                'page_url'  => trim($this->input->post('page_url')),
                'status'    => $this->input->post('status')
            );
            $post_data = $this->security->xss_clean($post_data);
            // this function update record in the database
            $this->comman_model->update_data_by_id('navigation_pages', $post_data, 'id', $id);

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/navigation_setting');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_navigation_pages'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('navigation_pages', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'navigation_setting',
            'addscripts'            => 'edit_navigation_page',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_navigation_pages'],
            'edit_data'             => allDataArray($this->comman_model->GetAllDataLangByid('navigation_pages', 'id', $id, $this->lang->default_lang_id, 'navigation_pages_country'))
        );
        
        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/navigation_page_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method delete_navigation_page
     * This Function delete single navigantion  as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the navigantion id. ]
     *
     * @return void
     */
    function delete_navigation_page($id) {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('navigation_setting');
        
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        // this code delete record from table navigation_pages  as per id
        $this->comman_model->delete_where('navigation_pages ', array('id' => $id));

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/navigation_setting');
    }

      
    /**
     * Method banner_setting
     * This function list all banner records. 
     * @return void
     */
    function banner_setting() {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('banner_setting');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteAll')) {
            // this code  delete all rows from banner_images table
            $this->pages_model->deleteAllWithImage('banner_images');
        }

        if ($this->input->post('DeleteSelected')) {
            $bannerIds = $this->security->xss_clean($this->input->post('deleteitem'));
            $this->pages_model->deleteSelectedWithImage('banner_images', 'banner_image', $bannerIds);
        }

        $keypost = trim($this->security->xss_clean($this->input->post('search')));
        $seg5 = $this->uri->segment(6);
        if (isset($seg5) && $seg5 != '') {
            $keyget = $this->uri->segment(5);
        }
        if (isset($keypost) && $keypost != '') {
            $key = $keypost;
        } else if (isset($keyget) && $keyget != '') {
            $key = $keyget;
        } else {
            $key = '';
        }

        $config['per_page']     = 50;
        $config['num_links']    = 5;

        if ($key) {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/banner_images/index/" . $key;
            $config['uri_segment']  = 6;
            $config['total_rows']   = $this->comman_model->record_search_count('banner_images', $key, array('email'));
            $offset                 = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
            $all_data               = $this->pages_model->get_search_key_data('banner_images', $key, 'email', $config['per_page'], $offset, $this->lang->default_lang_id);
        } else {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/banner_images/index/";
            $config['uri_segment']  = 5;
            $config['total_rows']   = $this->comman_model->record_count('banner_images');
            $offset                 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
            $all_data               = $this->pages_model->get_search_key_data('banner_images', $key, 'email', $config['per_page'], $offset, $this->lang->default_lang_id);
        }

        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_banner_images'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('banner_images', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'banner_setting',
            'addscripts'            => 'banner_setting',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'all_data'              => $all_data,
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_banner_images']
        );
        
        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/banner_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method add_banner_image
     * This Function Display Add banner form  and save the new banner   in the database.
     * @return void
     */
    function add_banner_image() {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('banner_setting');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            $this->form_validation->set_rules('button_text', 'Button Text', 'trim|required');
            $this->form_validation->set_rules('button_url', 'Button URL', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
            } else {
                if (!empty($_FILES['banner_image']['name'])) {
                    // this  code  executed when user upload  the image.
                    // these variables are intialized for  image file
                    $field_name = 'banner_image';
                    $config['upload_path']      = './assets/uploads/banner_images/';
                    $config['allowed_types']    = 'gif|jpg|png|jpeg';
                    $config['max_size']         = '2048';
                    $config['max_width']        = '2000';
                    $config['max_height']       = '2000';
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload($field_name)) {
                        $form_validation_instruction = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];
                        $error_lang = isset($form_validation_instruction['client_logo']['front']) ? $form_validation_instruction['client_logo']['front'] : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                        // if file is not uploaded than  this function set error  message in flash to display on frontend.
                        $this->session->set_flashdata('error', $error_lang);
                        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/add_banner_image');
                    } else {
                        //this code resize image and set image name for save in the database
                        $upload_data = $this->upload->data();
                        $this->load->library('image_lib');

                        /***************** This Function  Resize image   *****************/
                        do_resize($config['upload_path'], $upload_data['file_name'], 1200, 500);
                        /***************** Resize image  *****************/

                        $banner_image = $upload_data['file_name'];
                    }
                } else {
                    $banner_image = "";
                }
                 // this array is intialized to save in the database
                $post_data = array(
                    'banner_image'  => $banner_image,
                    'button_text'   => $this->input->post('button_text'),
                    'button_url'    => $this->input->post('button_url'),
                    'status'         => $this->input->post('status'),
                );
                $post_data = $this->security->xss_clean($post_data);
                // this function add new record  in the database
                $this->comman_model->add('banner_images', $post_data);

                $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                // this function set success message in flash to display on frontend.
                $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

                redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/banner_setting');
            }
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_banner_images'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('banner_images', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'banner_setting',
            'sub_menu'              => 'add_banner_image',
            'addscripts'            => 'add_banner_image',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_banner_images']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/banner_image_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method delete_banner_image
     * This Function delete single banner  as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the banner id. ]
     *
     * @return void
     */
    function delete_banner_image($id) {
         // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('banner_setting');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $result = $this->comman_model->delete_banner_image_id('banner_images', $id);
        unlink("assets/uploads/banner_images/".$result->banner_image);

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/banner_setting');
    }
    
    /**
     * Method edit_banner_image
     * This Function Display edit banner form  and update  record   in the database.
     * @param $id $id [This Parameter is the banner id. ]
     *
     * @return void
     */
    function edit_banner_image($id = false) {
        if (!$id) {
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/banner_setting');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('banner_setting');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
	    $this->form_validation->set_rules('button_text', 'Button Text', 'trim');
            $this->form_validation->set_rules('button_url', 'Button URL', 'trim');
            $this->form_validation->set_rules('desc_text', 'Description', 'trim');	    
            if ($this->form_validation->run() == FALSE) {
            } else {
                if (!empty($_FILES['banner_image']['name'])) {
                    // this  code  executed when user upload  the image.

                    // these variables are intialized for  image file
                    $field_name = 'banner_image';
                    $config['upload_path']      = './assets/uploads/banner_images/';
                    $config['allowed_types']    = 'gif|jpg|png|jpeg';
                    $config['max_size']         = '2048';
                    $config['max_width']        = '2000';
                    $config['max_height']       = '2000';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload($field_name)) {
                        $form_validation_instruction = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];
                        $error_lang = isset($form_validation_instruction['client_logo']['front']) ? $form_validation_instruction['client_logo']['front'] : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                        // if file is not uploaded than  this function set error  message in flash to display on frontend.
                        $this->session->set_flashdata('error', $error_lang);
                        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/add_banner_image');
                    } else {
                        //this code resize image and set image name for save in the database
                        $upload_data = $this->upload->data();
                        $this->load->library('image_lib');

                        /***************** This Function  Resize image   *****************/
                        do_resize($config['upload_path'], $upload_data['file_name'], 1200, 500);
                        /***************** Resize image  *****************/

                        $banner_image = $upload_data['file_name'];
                    }
                } else {
                    $banner_image = $this->input->post('hidden_banner_image');
                }

                // this array is intialized to save in the database
                $post_data = array(
                    'banner_image'  => $banner_image,
                    'button_url'    => $this->input->post('button_url'),
                    'button_text'   => $this->input->post('button_text'),
                    'desc_text'   => $this->input->post('desc_text'),
                    'status'        => $this->input->post('status'),
                );
                $post_data = $this->security->xss_clean($post_data);
                // this function update record in the database
                $result = $this->comman_model->update_data_by_id('banner_images', $post_data, 'id', $id);

                $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                // this function set success message in flash to display on frontend.
                $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

                redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/banner_setting');
            }
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_banner_images'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('banner_images', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'banner_setting',
            'addscripts'            => 'edit_banner_image',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_banner_images'],
            'edit_data'             => allDataArray($this->comman_model->GetAllDataLangByid('banner_images', 'id', $id, $this->lang->default_lang_id, 'banner_images_country'))
        );
        
        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/banner_image_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /* Social media functionality section  */
    function social_media_setting() {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('social_media_setting');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteAll')) {
            // this code  delete all rows from social_media table
            $this->pages_model->deleteAllWithImage('social_media');
        }

        if ($this->input->post('DeleteSelected')) {
            $mediaIds = $this->security->xss_clean($this->input->post('deleteitem'));
            $this->pages_model->deleteSelectedWithImage('social_media', 'social_media_image', $mediaIds);
        }

        $keypost = trim($this->security->xss_clean($this->input->post('search')));
        $seg5 = $this->uri->segment(6);
        if (isset($seg5) && $seg5 != '') {
            $keyget = $this->uri->segment(5);
        }
        if (isset($keypost) && $keypost != '') {
            $key = $keypost;
        } else if (isset($keyget) && $keyget != '') {
            $key = $keyget;
        } else {
            $key = '';
        }

        $config['per_page']     = 50;
        $config['num_links']    = 5;

        if ($key) {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/social_media/index/" . $key;
            $config['uri_segment']  = 6;
            $config['total_rows']   = $this->comman_model->record_search_count('social_media', $key, array('email'));
            $offset                 = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
            $all_data               = $this->pages_model->get_search_key_data('social_media', $key, 'email', $config['per_page'], $offset, $this->lang->default_lang_id);
        } else {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/social_media/index/";
            $config['uri_segment']  = 4;
            $config['total_rows']   = $this->comman_model->record_count('social_media');
            $offset                 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
            $all_data               = $this->pages_model->get_search_key_data('social_media', $key, 'email', $config['per_page'], $offset, $this->lang->default_lang_id);
        }

        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_social_media'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('social_media', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'social_media_setting',
            'addscripts'            => 'social_media_setting',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'all_data'              => $all_data,
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_social_media']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/social_media_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method add_social_media
     * This Function Display Add social media form  and save the new social media   in the database.
     * @return void
     */
    function add_social_media() {

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('social_media_setting');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            $this->form_validation->set_rules('social_media_url', 'Button URL', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
            } else {
                if (!empty($_FILES['social_media_image']['name'])) {
                    // this  code  executed when user upload  the image.

                    // these variables are intialized for  image file
                    $field_name = 'social_media_image';
                    $config['upload_path']      = './assets/uploads/social_media/';
                    $config['allowed_types']    = 'gif|jpg|png|jpeg';
                    $config['max_size']         = '2048';
                    $config['max_width']        = '2000';
                    $config['max_height']       = '2000';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload($field_name)) {
                        $form_validation_instruction = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];
                        $error_lang = isset($form_validation_instruction['client_logo']['front']) ? $form_validation_instruction['client_logo']['front'] : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                        // if file is not uploaded than  this function set error  message in flash to display on frontend.
                        $this->session->set_flashdata('error', $error_lang);
                        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/add_social_media');
                    } else {
                        //this code resize image and set image name for save in the database
                        $upload_data = $this->upload->data();
                        $this->load->library('image_lib');

                        /***************** This Function  Resize image   *****************/
                        do_resize($config['upload_path'], $upload_data['file_name'], 1200, 500);
                        /***************** Resize image  *****************/

                        $social_media_image = $upload_data['file_name'];
                    }
                } else {
                    $social_media_image = "";
                }

                // this array is intialized to save in the database
                $post_data = array(
                    'social_media_image'    => $social_media_image,
                    'social_media_url'      => $this->input->post('social_media_url'),
                    'status'                => $this->input->post('status'),
                );
                $post_data = $this->security->xss_clean($post_data);
                // this function add new record  in the database
                $result = $this->comman_model->add('social_media', $post_data);

                $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                // this function set success message in flash to display on frontend.
                $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

                redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/social_media_setting');
            }
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_social_media'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('social_media', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'social_media_setting',
            'sub_menu'              => 'add_social_media',
            'addscripts'            => 'add_social_media',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_social_media']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/social_media_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method edit_social_media
     * This Function Display edit social media  and update  record   in the database.
    * @param $id $id [This Parameter is the row id. ]
    *
    * @return void
    */
    function edit_social_media($id = false) {
        if (!$id) {
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/social_media_setting');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('social_media_setting');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            $this->form_validation->set_rules('social_media_url', 'Social Media URL', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
            } else {
                if (!empty($_FILES['social_media_image']['name'])) {
                    // this  code  executed when user upload  the image.

                    // these variables are intialized for  image file
                    $field_name = 'social_media_image';
                    $config['upload_path']      = './assets/uploads/social_media/';
                    $config['allowed_types']    = 'gif|jpg|png|jpeg';
                    $config['max_size']         = '2048';
                    $config['max_width']        = '2000';
                    $config['max_height']       = '2000';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload($field_name)) {
                        $form_validation_instruction = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];
                        $error_lang = isset($form_validation_instruction['client_logo']['front']) ? $form_validation_instruction['client_logo']['front'] : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                        // if file is not uploaded than  this function set error  message in flash to display on frontend.
                        $this->session->set_flashdata('error', $error_lang);
                        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/edit_social_media');
                    } else {
                        //this code resize image and set image name for save in the database
                        $upload_data = $this->upload->data();
                        $this->load->library('image_lib');
                        
                        /***************** This Function  Resize image   *****************/
                        do_resize($config['upload_path'], $upload_data['file_name'], 1200, 500);
                        /***************** Resize image  *****************/

                        $social_media_image = $upload_data['file_name'];
                    }
                } else {
                    $social_media_image = $this->security->xss_clean($this->input->post('hidden_social_media_image'));
                }

                // this array is intialized to save in the database
                $post_data = array(
                    'social_media_image'    => $social_media_image,
                    'social_media_url'      => $this->input->post('social_media_url'),
                    'status'                => $this->input->post('status'),
                );
                $post_data = $this->security->xss_clean($post_data);
                // this function update record in the database
                $result = $this->comman_model->update_data_by_id('social_media', $post_data, 'id', $id);

                $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                // this function set success message in flash to display on frontend.
                $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

                redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/social_media_setting');
            }
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_social_media'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('social_media', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'social_media_setting',
            'addscripts'            => 'edit_social_media',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_social_media'],
            'edit_data'             => allDataArray($this->comman_model->GetAllDataLangByid('social_media', 'id', $id, $this->lang->default_lang_id, 'social_media_country'))
        );
        
        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/social_media_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method delete_social_media
     * This Function delete single social media  as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the social media id. ]
     *
     * @return void
     */
    function delete_social_media($id) {
         // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('social_media_setting');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $result = $this->comman_model->delete_social_media_id('social_media', $id);
        unlink("assets/uploads/social_media/".$result->social_media_image);

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/social_media_setting');
    }

    /* Payment accept card functionality section  */
    function payment_accept_card_setting() {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('payment_accept_card_setting');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteAll')) {
            // this code  delete all rows from payment_accept_card table
            $this->db->truncate('payment_accept_card');
            $this->pages_model->deleteAllWithImage('payment_accept_card');
        }

        if ($this->input->post('DeleteSelected')) {
            $cardIds = $this->security->xss_clean($this->input->post('deleteitem'));
            $this->pages_model->deleteSelectedWithImage('payment_accept_card', 'payment_card_icon', $cardIds);
        }

        $keypost = trim($this->security->xss_clean($this->input->post('search')));
        $seg5 = $this->uri->segment(6);
        if (isset($seg5) && $seg5 != '') {
            $keyget = $this->uri->segment(5);
        }
        if (isset($keypost) && $keypost != '') {
            $key = $keypost;
        } else if (isset($keyget) && $keyget != '') {
            $key = $keyget;
        } else {
            $key = '';
        }

        $config['per_page']     = 50;
        $config['num_links']    = 5;

        if ($key) {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/homepagesetting/payment_accept_card_setting/" . $key;
            $config['uri_segment']  = 6;
            $config['total_rows']   = $this->comman_model->record_search_count('payment_accept_card', $key, array('email'));
            $offset                 = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
            $all_data               = $this->pages_model->get_search_key_data('payment_accept_card', $key, 'email', $config['per_page'], $offset, $this->lang->default_lang_id);
        } else {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/homepagesetting/payment_accept_card_setting/";
            $config['uri_segment']  = 5;
            $config['total_rows']   = $this->comman_model->record_count('payment_accept_card');
            $offset                 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
            $all_data               = $this->pages_model->get_search_key_data('payment_accept_card', $key, 'email', $config['per_page'], $offset, $this->lang->default_lang_id);
        }

        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_payment_accept_card'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('payment_accept_card_setting', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'payment_accept_card_setting',
            'addscripts'            => 'payment_accept_card_setting',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'all_data'              => $all_data,
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_payment_accept_card']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/payment_accept_card_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method add_payment_accept_card
     * This Function Display Add payment accept form  and save the new entry   in the database.
     * @return void
     */
    function add_payment_accept_card() {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('payment_accept_card_setting');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            $this->form_validation->set_rules('icon_alt_name', 'Icon Name', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
            } else {
                if (!empty($_FILES['payment_card_icon']['name'])) {
                    // this  code  executed when user upload  the image.

                    // these variables are intialized for  image file
                    $field_name = 'payment_card_icon';
                    $config['upload_path']      = './assets/uploads/payment_card_icon/';
                    if(!is_dir($config['upload_path'])){
                        mkdir($config['upload_path'],0777,TRUE);
                    }
                    $config['allowed_types']    = 'gif|jpg|png|jpeg';
                    $config['max_size']         = '2048';
                    $config['max_width']        = '2000';
                    $config['max_height']       = '2000';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload($field_name)) {
                        $form_validation_instruction = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];
                        $error_lang = isset($form_validation_instruction['client_logo']['front']) ? $form_validation_instruction['client_logo']['front'] : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                        // if file is not uploaded than  this function set error  message in flash to display on frontend.
                        $this->session->set_flashdata('error', $error_lang);
                        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/add_payment_accept_card');
                    } else {
                        //this code resize image and set image name for save in the database
                        $upload_data = $this->upload->data();
                        $this->load->library('image_lib');
                        
                        /***************** This Function  Resize image   *****************/
                        do_resize($config['upload_path'], $upload_data['file_name'], 1200, 500);
                        /***************** Resize image  *****************/

                        $payment_card_icon = $upload_data['file_name'];
                    }
                } else {
                    $payment_card_icon = "";
                }

                // this array is intialized to save in the database
                $post_data = array(
                    'payment_card_icon' => $payment_card_icon,
                    'icon_alt_name'     => $this->input->post('icon_alt_name'),
                    'status'            => $this->input->post('status'),
                );
                $post_data = $this->security->xss_clean($post_data);
                // this function add new record  in the database
                $result = $this->comman_model->add('payment_accept_card', $post_data);

                $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                // this function set success message in flash to display on frontend.
                $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

                redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/payment_accept_card_setting');
            }
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_payment_accept_card'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('payment_accept_card_setting', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'payment_accept_card_setting',
            'sub_menu'              => 'add_payment_accept_card',
            'addscripts'            => 'add_payment_accept_card',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_payment_accept_card']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/payment_accept_card_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method edit_payment_accept_card
    * This Function Display edit payment accept form   and update  record   in the database.
    * @param $id $id [This Parameter is the row id. ]
     *
     * @return void
     */
    function edit_payment_accept_card($id = false) {
        if (!$id) {
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/payment_accept_card_setting');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('payment_accept_card_setting');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            $this->form_validation->set_rules('icon_alt_name', 'Icon Name', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
            } else {
                if (!empty($_FILES['payment_card_icon']['name'])) {
                    // this  code  executed when user upload  the image.

                    // these variables are intialized for  image file
                    $field_name = 'payment_card_icon';
                    $config['upload_path']      = './assets/uploads/payment_card_icon/';
                    if(!is_dir($config['upload_path'])){
                        mkdir($config['upload_path'],0777,TRUE);
                    }
                    $config['allowed_types']    = 'gif|jpg|png|jpeg';
                    $config['max_size']         = '2048';
                    $config['max_width']        = '2000';
                    $config['max_height']       = '2000';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload($field_name)) {
                        $form_validation_instruction = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];
                        $error_lang = isset($form_validation_instruction['client_logo']['front']) ? $form_validation_instruction['client_logo']['front'] : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                        // if file is not uploaded than  this function set error  message in flash to display on frontend.
                        $this->session->set_flashdata('error', $error_lang);
                        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/edit_payment_accept_card');
                    } else {
                        //this code resize image and set image name for save in the database
                        $upload_data = $this->upload->data();
                        $this->load->library('image_lib');

                        /***************** This Function  Resize image   *****************/
                        do_resize($config['upload_path'], $upload_data['file_name'], 1200, 500);
                        /***************** Resize image  *****************/

                        $payment_card_icon = $upload_data['file_name'];
                    }
                } else {
                    $payment_card_icon = $this->security->xss_clean($this->input->post('hidden_payment_card_icon'));
                }

                // this array is intialized to save in the database
                $post_data = array(
                    'payment_card_icon' => $payment_card_icon,
                    'icon_alt_name'     => $this->input->post('icon_alt_name'),
                    'status'            => $this->input->post('status'),
                );
                $post_data = $this->security->xss_clean($post_data);
                // this function update record in the database
                $result = $this->comman_model->update_data_by_id('payment_accept_card', $post_data, 'id', $id);

                $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                // this function set success message in flash to display on frontend.
                $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

                redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/payment_accept_card_setting');
            }
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_payment_accept_card'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('payment_accept_card_setting', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'payment_accept_card',
            'addscripts'            => 'edit_payment_accept_card',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_payment_accept_card'],
            'edit_data'             => allDataArray($this->comman_model->GetAllDataLangByid('payment_accept_card', 'id', $id, $this->lang->default_lang_id, 'payment_accept_card_country'))
        );
        
        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/payment_accept_card_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method delete_payment_accept_card
     * This Function delete single record from payment_accept_card_setting table  as per the  id passed in the  parameter.
    * @param $id $id [This Parameter is the row  id. ]
    *
    * @return void
    */
    function delete_payment_accept_card($id) {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('payment_accept_card_setting');
        
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        $result = $this->comman_model->get_data_by_id('payment_accept_card', array('id' => $id));

        // this code delete record from table payment_accept_card  as per id        
        $this->comman_model->delete_where('payment_accept_card', array('id' => $id));
        unlink("assets/uploads/payment_card_icon/".$result['payment_card_icon']);

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/payment_accept_card_setting');
    }

    /* Whats New for home page functionality section  */
    function whats_new_setting() {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('whats_new_setting');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteAll')) {
            // this code  delete all rows from whats_new table
            $this->pages_model->deleteAllWithImage('whats_new');
        }

        if ($this->input->post('DeleteSelected')) {
            $selectedIds = $this->security->xss_clean($this->input->post('deleteitem'));
            $this->pages_model->deleteSelectedWithImage('whats_new', 'image', $selectedIds);
        }

        $keypost = trim($this->security->xss_clean($this->input->post('search')));
        $seg5 = $this->uri->segment(6);
        if (isset($seg5) && $seg5 != '') {
            $keyget = $this->uri->segment(5);
        }
        if (isset($keypost) && $keypost != '') {
            $key = $keypost;
        } else if (isset($keyget) && $keyget != '') {
            $key = $keyget;
        } else {
            $key = '';
        }

        $config['per_page']     = 50;
        $config['num_links']     = 5;

        if ($key) {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/whats_new/index/" . $key;
            $config['uri_segment']  = 6;
            $config['total_rows']   = $this->comman_model->record_search_count('whats_new', $key, array('email'));
            $offset                 = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
            $all_data               = $this->pages_model->get_search_key_data('whats_new', $key, 'email', $config['per_page'], $offset, $this->lang->default_lang_id);
        } else {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/whats_new/index/";
            $config['uri_segment']  = 5;
            $config['total_rows']   = $this->comman_model->record_count('whats_new');
            $offset                 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
            $all_data               = $this->pages_model->get_search_key_data('whats_new', $key, 'email', $config['per_page'], $offset, $this->lang->default_lang_id);
        }

        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_whats_new'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('whats_new', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'whats_new_setting',
            'addscripts'            => 'whats_new_setting',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'all_data'              => $all_data,
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_whats_new']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/whats_new_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method add_whats_new
    * This Function Display Add what new setting form  and save the new entry   in the database.
     * @return void
     */
    function add_whats_new() {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('whats_new_setting');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            $this->form_validation->set_rules('heading', 'Heading', 'trim|required');
            $this->form_validation->set_rules('url', 'URL', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
            } else {
                if (!empty($_FILES['image']['name'])) {
                    // this  code  executed when user upload  the image.

                    // these variables are intialized for  image file
                    $field_name = 'image';
                    $config['upload_path']      = './assets/uploads/whats_new/';
                    $config['allowed_types']    = 'gif|jpg|png|jpeg';
                    $config['max_size']         = '2048';
                    $config['max_width']        = '2000';
                    $config['max_height']       = '2000';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload($field_name)) {
                        $form_validation_instruction = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];
                        $error_lang = isset($form_validation_instruction['client_logo']['front']) ? $form_validation_instruction['client_logo']['front'] : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                        // if file is not uploaded than  this function set error  message in flash to display on frontend.
                        $this->session->set_flashdata('error', $error_lang);
                        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/add_whats_new');
                    } else {
                        //this code resize image and set image name for save in the database
                        $upload_data = $this->upload->data();
                        $this->load->library('image_lib');

                        /***************** This Function  Resize image   *****************/
                        do_resize($config['upload_path'], $upload_data['file_name'], 1200, 500);
                        /***************** Resize image  *****************/

                        $image = $upload_data['file_name'];
                    }
                } else {
                    $image = "";
                }

                // this array is intialized to save in the database
                $post_data = array(
                    'image'     => $image,
                    'heading'   => $this->input->post('heading'),
                    'url'       => $this->input->post('url'),
                    'status'    => $this->input->post('status'),
                );
                $post_data = $this->security->xss_clean($post_data);
                // this function add new record  in the database
                $result = $this->comman_model->add('whats_new', $post_data);

                $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                // this function set success message in flash to display on frontend.
                $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

                redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/whats_new_setting');
            }
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_whats_new'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('whats_new', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'whats_new_setting',
            'sub_menu'              => 'add_whats_new',
            'addscripts'            => 'add_whats_new',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_whats_new']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/whats_new_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method edit_whats_new
     * This Function Display edit what new setting form  and update  record   in the database.
     * @param $id $id [This Parameter is the row  id. ]
     *
     * @return void
     */
    function edit_whats_new($id = false) {
        if (!$id) {
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/whats_new_setting');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('whats_new_setting');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            $this->form_validation->set_rules('heading', 'Heading', 'trim|required');
            $this->form_validation->set_rules('url', 'URL', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
            } else {
                if (!empty($_FILES['image']['name'])) {
                    // this  code  executed when user upload  the image.

                    // these variables are intialized for  image file
                    $field_name = 'image';
                    $config['upload_path']      = './assets/uploads/whats_new/';
                    $config['allowed_types']    = 'gif|jpg|png|jpeg';
                    $config['max_size']         = '2048';
                    $config['max_width']        = '2000';
                    $config['max_height']       = '2000';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload($field_name)) {
                        $form_validation_instruction = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];
                        $error_lang = isset($form_validation_instruction['client_logo']['front']) ? $form_validation_instruction['client_logo']['front'] : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                        // if file is not uploaded than  this function set error  message in flash to display on frontend.
                        $this->session->set_flashdata('error', $error_lang);
                        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/add_whats_new');
                    } else {
                        //this code resize image and set image name for save in the database
                        $upload_data = $this->upload->data();
                        $this->load->library('image_lib');

                        /***************** This Function  Resize image   *****************/
                        do_resize($config['upload_path'], $upload_data['file_name'], 1200, 500);
                        /***************** Resize image  *****************/

                        $image = $upload_data['file_name'];
                    }
                } else {
                    $image = $this->security->xss_clean($this->input->post('hidden_image'));
                }

                // this array is intialized to save in the database
                $post_data = array(
                    'image'     => $image,
                    'url'       => $this->input->post('url'),
                    'heading'   => $this->input->post('heading'),
                    'status'    => $this->input->post('status'),
                );
                $post_data = $this->security->xss_clean($post_data);
                // this function update record in the database
                $result = $this->comman_model->update_data_by_id('whats_new', $post_data, 'id', $id);

                $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                // this function set success message in flash to display on frontend.
                $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

                redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/whats_new_setting');
            }
        }
        
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_whats_new'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('whats_new', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'whats_new_setting',
            'addscripts'            => 'edit_whats_new',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_whats_new'],
            'edit_data'             => allDataArray($this->comman_model->GetAllDataLangByid('whats_new', 'id', $id, $this->lang->default_lang_id, 'whats_new_country'))
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/homepagesetting/whats_new_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method delete_whats_new
     * This Function delete single record from whats_new_setting table  as per the  id passed in the  parameter.
    * @param $id $id [This Parameter is the row  id. ]
     *
     * @return void
     */
    function delete_whats_new($id) {
         // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('whats_new_setting');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $response = $this->comman_model->delete_whats_new_id('whats_new', $id);
        unlink("assets/uploads/whats_new/".$response->image);

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);
        
        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/homepagesetting/whats_new_setting');
    }
}
