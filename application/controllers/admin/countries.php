<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Countries
 * Countries Class handle all methods  related to Country like list, add , edit , delete.
 */
class Countries extends CI_Controller {
    
    /**
     * Method __construct
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model(array('comman_model'));
        $this->load->helper('assets');
        validateAdminLogin();
        validateUser();
    }
    
    /**
     * Method index
     * This function list all product nature. 
     * @param $param1='' $param1 [This parameter is used for pagination.]
     * @param $param2=0 $param2 [This parameter is used for pagination.]
     *
     * @return void
     */
    function index($param1='',$param2=0) {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('countries');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteAll')) {
            // this function delete all records from  countries table
            $this->comman_model->deleteAllDataWithLang('countries', 1);
        }

        if ($this->input->post('DeleteSelected')) {
            // this function delete all roles as per the ids posted  in the post parameter.
            $selectedIds = $this->security->xss_clean($this->input->post('deleteitem'));
            $this->comman_model->deleteAllById('countries', $selectedIds, 'id');
            $this->comman_model->deleteAllById('countries_lang', $selectedIds, 'lang_id');
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

        $plang        = $this->comman_model->getPrimaryLang();
        $primary_lang = !empty($plang) ? $plang['short_code'] : 'en';

        if ($key) {
            // if pagination get parameter is set in the url than this code execute.
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/countries/index/" . $key;
            $config['total_rows']   = $this->comman_model->record_search_count('countries', $key, array('countryName'));
            if($this->lang->default_lang != $primary_lang) {
                $all_data     = $this->comman_model->search_table_data($key, array('t2.lang_countryName'), $config['per_page'], $offset, 't2.lang_countryName', 'countries', 'countries_lang');   
                if(empty($all_data)) {
                    $all_data = $this->comman_model->search_table_data($key, array('t1.countryName'), $config['per_page'], $offset, 't2.lang_countryName', 'countries', 'countries_lang');   
                }
            } else {
                $all_data     = $this->comman_model->search_table_data($key, array('t1.countryName'), $config['per_page'], $offset, 't2.lang_countryName', 'countries', 'countries_lang');
            }  
        } else {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/countries/index/";
            $config['total_rows']   = $this->comman_model->record_count('countries');
            $all_data               = $this->comman_model->search_table_data($key, array('t1.countryName'), $config['per_page'], $offset, 't2.lang_countryName', 'countries', 'countries_lang');
        }

        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('countries', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'countries',
            'addscripts'            => 'countries_list',
            'primary_lang'          => $primary_lang, 
            'all_data'              => $all_data,
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'lang_data'             => get_admin_lang_data(array('countries'), $this->lang->default_lang_id)['countries'],
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id))
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/countries/countries_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method delete_countries
     * This Function delete single  row as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the row id of the countries table. ]
     *
     * @return void
     */
    function delete_countries($id) {
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('countries');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        // this function delete the record by row id from tbl_product_natures table.
        $this->comman_model->delete_where('countries', array('id' => $id));
        removeLangContent('countries_lang',$id);

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);
        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/countries');
    }
    
    /**
     * Method add_countries
     * This Function Display Add Country form and save the new country.
     * @return void
     */
    function add_countries() {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('countries');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            $post_data = array(
                'countryName'  => trim($this->input->post('countryName')),
                'alpha_2'      => trim($this->input->post('alpha_2')),
                'alpha_3'      => trim($this->input->post('alpha_3')),
                'country_code' => trim($this->input->post('country_code')),
                'status'       => trim($this->input->post('status')),
                'created'      => date('Y-m-d H:i:s')
            );
            // this code  save record  in the tbl_product_natures  table 
            $post_data = $this->security->xss_clean($post_data);
            $this->comman_model->add('countries', $post_data);

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/countries');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links'), $this->lang->default_lang_id);
        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('countries', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'add_countries',
            'sub_menu'              => 'add_countries',
            'addscripts'            => 'add_countries',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'lang_data'             => get_admin_lang_data(array('countries'), $this->lang->default_lang_id)['countries'],
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/countries/country_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method edit_countries
     * This Function Display edit  form and update the  countries on the behalf of row id passed in the parameter.
     * @param $id $id [This parameter is the row id.]
     *
     * @return void
     */
    function edit_countries($id = false) {
        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/productnatures');
        }

        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('countries');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            $post_data = array(
                'countryName'  => trim($this->input->post('countryName')),
                'alpha_2'      => trim($this->input->post('alpha_2')),
                'alpha_3'      => trim($this->input->post('alpha_3')),
                'country_code' => trim($this->input->post('country_code')),
                'status'       => trim($this->input->post('status')),
                'created'      => date('Y-m-d H:i:s')
            );
            $post_data = $this->security->xss_clean($post_data);
            // this function update record in the database.
            $this->comman_model->update_data_by_id('countries', $post_data, 'id', $id);

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/countries');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('countries', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'countries',
            'addscripts'            => 'edit_countries',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'lang_data'             => get_admin_lang_data(array('countries'), $this->lang->default_lang_id)['countries'],
            'edit_data'             => allDataArray($this->comman_model->GetAllDataLangByid('countries', 'id', $id, $this->lang->default_lang_id, 'countries_lang'))
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/countries/country_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method checkCountryNameExists
     *  This Function checked that is product nature  exist in the tbl_product_natures or not.
     * @return void
     */
    public function checkCountryNameExists($id = '') {
        $data = array();
        $countryName = $this->security->xss_clean($this->input->post('countryName'));
        if($id && $countryName){
            $result = $this->comman_model->get_data_by_id('countries', array('id' => $id));
            if ($countryName == $result['countryName']) {
                echo json_encode(TRUE);
            }else{
                // this function check is record exist in the table with same name or not.
                $exists = $this->comman_model->check_row_exists('countries', array('countryName' => $countryName));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        }else if ($countryName) {
            // this function check is record exist in the table with same name or not.
            $exists = $this->comman_model->check_row_exists('countries', array('countryName' => $countryName));
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