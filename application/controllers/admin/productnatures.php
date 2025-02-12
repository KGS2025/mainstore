<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Productnatures
 * Productnatures Class handle all methods  related to product nature  like list, add , edit , delete.
 */
class Productnatures extends CI_Controller
{

    /**
     * Method __construct
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model(array('comman_model', 'product_natures_model', 'part_relation_model'));
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
    function index($param1 = '', $param2 = 0)
    {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('product_natures');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }




        // if ($this->input->post('DeleteAll')) {
        //     // this function delete all records from  tbl_product_natures table
        //     $this->comman_model->deleteAllDataWithLang('tbl_product_natures', 1);
        // }

        if ($this->input->post('DeleteSelected')) {
            $userLangData = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id);
            $admin_static_links = $userLangData['admin_static_links'];
            $all_product_nature = $this->part_relation_model->all_product_nature();
            // this function delete all roles as per the ids posted  in the post parameter.
            $selectedIds = $this->security->xss_clean($this->input->post('deleteitem'));
            $nature_not_used = array_diff($selectedIds, $all_product_nature);
            if (!empty($nature_not_used)) {
                $this->comman_model->deleteAllById('tbl_product_natures', $nature_not_used, 'id');
                $this->comman_model->deleteAllById('tbl_product_natures_country', $nature_not_used, 'lang_id');
            }
            $this->session->set_flashdata('success', $admin_static_links['data_success_with_exist']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/productnatures');
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

        $plang        = $this->comman_model->getPrimaryLang();
        $primary_lang = !empty($plang) ? $plang['short_code'] : 'en';

        if ($key) {
            // if pagination get parameter is set in the url than this code execute.
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/productnatures/index/" . $key;
            $config['total_rows']   = $this->comman_model->record_search_count('tbl_product_natures', $key, array('name'));
            if ($this->lang->default_lang != $primary_lang) {
                $all_data     = $this->comman_model->search_table_data($key, array('t2.lang_name'), $config['per_page'], $offset, 't2.lang_name', 'tbl_product_natures');
                if (empty($all_data)) {
                    $all_data = $this->product_natures_model->search_product_nature_data($key, $config['per_page'], $offset, $this->lang->default_lang_id);
                }
            } else {
                $all_data     = $this->product_natures_model->search_product_nature_data($key, $config['per_page'], $offset, $this->lang->default_lang_id);
            }
        } else {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/productnatures/index/";
            $config['total_rows']   = $this->comman_model->record_count('tbl_product_natures');
            $all_data               = $this->product_natures_model->search_product_nature_data($key, $config['per_page'], $offset, $this->lang->default_lang_id);
        }

        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_tbl_product_natures'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('product_natures', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'product_natures',
            'addscripts'            => 'product_natures',
            'primary_lang'          => $primary_lang,
            'all_data'              => $all_data,
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_tbl_product_nature' => $all_language_data['admin_tbl_product_natures'],
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id))
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/productnatures/productnatures_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method delete_productnatures
     * This Function delete single  row as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the row id of the tbl_product_natures table. ]
     *
     * @return void
     */
    function delete_productnatures($id)
    {
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('product_natures');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        $userLangData = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id);
        $admin_static_links = $userLangData['admin_static_links'];
        $all_product_nature = $this->part_relation_model->all_product_nature();
        if (!in_array($id, $all_product_nature)) {
            // this function delete the record by row id from tbl_product_natures table.
            $this->comman_model->delete_where('tbl_product_natures', array('id' => $id));
            removeLangContent('tbl_product_natures_country', $id);
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);
        } else {

            $this->session->set_flashdata('success', $admin_static_links['data_exist_in_other']);
        }
        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/productnatures');
    }

    /**
     * Method add_productnatures
     * This Function Display Add product nature form and save the new product nature.
     * @return void
     */
    function add_productnatures()
    {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('product_natures');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_tbl_product_natures'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            $post_data = array(
                'name'      => trim($this->input->post('name')),
                'created'   => date('Y-m-d')
            );
            // this code  save record  in the tbl_product_natures  table 
            $post_data = $this->security->xss_clean($post_data);
            $this->comman_model->add('tbl_product_natures', $post_data);

            $admin_static_links = $all_language_data['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']['front']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/productnatures');
        }

        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('product_natures', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'product_natures',
            'sub_menu'              => 'add_productnatures',
            'addscripts'            => 'add_productnatures',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_tbl_product_nature' => $all_language_data['admin_tbl_product_natures']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/productnatures/product_nature_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method edit_productnatures
     * This Function Display edit  form and update the  product nature on the behalf of role id passed in the parameter.
     * @param $id $id [This parameter is the row id.]
     *
     * @return void
     */
    function edit_productnatures($id = false)
    {
        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/productnatures');
        }
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('product_natures');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        check_lang_admin();
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_tbl_product_natures'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            $post_data = array(
                'name'      => trim($this->input->post('name')),
                'created'   => date('Y-m-d')
            );
            $post_data = $this->security->xss_clean($post_data);
            // this function update record in the database.
            $this->comman_model->update_data_by_id('tbl_product_natures', $post_data, 'id', $id);

            $admin_static_links = $all_language_data['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']['front']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/productnatures');
        }

        $plang  = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                    => $access,
            'login'                     => $this->session->all_userdata(),
            'title'                     => get_page_title('product_natures', 'admin_title'),
            'lang_id'                   => $this->lang->default_lang,
            'lang_num'                  => $this->lang->default_lang_id,
            'active'                    => 'product_natures',
            'addscripts'                => 'edit_productnatures',
            'primary_lang'              => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'      => $this->session->userdata('admin_validuser_data'),
            'country_data'              => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'        => $all_language_data['admin_static_links'],
            'admin_tbl_product_nature'  => $all_language_data['admin_tbl_product_natures'],
            'edit_data'             => allDataArray($this->comman_model->GetAllDataLangByid('tbl_product_natures', 'id', $id, $this->lang->default_lang_id, 'tbl_product_items_country'))
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/productnatures/product_nature_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method checkProductnatureExists
     *  This Function checked that is product nature  exist in the tbl_product_natures or not.
     * @return void
     */
    public function checkProductnatureExists($id = '')
    {
        $data = array();
        $name = $this->security->xss_clean($this->input->post('name'));
        if ($id && $name) {
            $result = $this->comman_model->get_data_by_id('tbl_product_natures', array('id' => $id));
            if ($name == $result['name']) {
                $data['response'] = 'success';
            } else {
                // this function check is record exist in the table with same name or not.
                $exists = $this->comman_model->check_row_exists('tbl_product_natures', array('name' => $name));
                if ($exists) {
                    // if exist than this code return false
                    $data['response'] = 'fail';
                } else {
                    // if not  exist than this code return true
                    $data['response'] = 'success';
                }
            }
        } else if ($name) {
            // this function check is record exist in the table with same name or not.
            $exists = $this->comman_model->check_row_exists('tbl_product_natures', array('name' => $name));
            if ($exists) {
                // if exist than this code return false
                $data['response'] = 'fail';
            } else {
                // if not  exist than this code return true
                $data['response'] = 'success';
            }
        }
        echo json_encode($data);
        exit;
    }
}
