<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Productitems
 *  Productitems Class handle all methods  related to product items  like list, add , edit , delete.
 */
class Productitems extends CI_Controller {
    
    /**
     * Method __construct
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model(array('comman_model', 'product_items_model'));
        $this->load->helper('assets');
        validateAdminLogin();
        validateUser();
    }
    
    /**
     * Method index
     * This function list all product items. 
     * @param $param1='' $param1 [This parameter is used for pagination.]
     * @param $param2=0 $param2 [This parameter is used for pagination.]
     *
     * @return void
     */
    function index($param1='', $param2=0) {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('product_items');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteAll')) {
            // this function  delete all rows from tbl_product_items table
            $this->comman_model->deleteAllDataWithLang('tbl_product_items',1);
        }

        if ($this->input->post('DeleteSelected')) {
            // this function delete product items as per ids passed in the post parameter
            $selectedItemId = $this->security->xss_clean($this->input->post('deleteitem'));
            $this->comman_model->deleteAllById('tbl_product_items', $selectedItemId, 'id');
            $this->comman_model->deleteAllById('tbl_product_items_country', $selectedItemId, 'lang_id');
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
            // this code execute when pagination parameter is set.
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/productitems/index/" . $key;
            $config['total_rows']   = $this->comman_model->record_search_count('tbl_product_items', $key, array('item_name'));
            if($this->lang->default_lang != $primary_lang) {
                $all_data     = $this->comman_model->search_table_data($key, array('t2.lang_item_name'), $config['per_page'], $offset, 't2.lang_item_name', 'tbl_product_items');   
                if(empty($all_data)) {
                    $all_data = $this->product_items_model->search_product_item_data($key, $config['per_page'], $offset, $this->lang->default_lang_id);
                }
            } else {
                $all_data     = $this->product_items_model->search_product_item_data($key, $config['per_page'], $offset, $this->lang->default_lang_id);
            }  
        } else {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/productitems/index/";
            $config['total_rows']   = $this->comman_model->record_count('tbl_product_items');
            $all_data               = $this->product_items_model->search_product_item_data($key, $config['per_page'], $offset, $this->lang->default_lang_id);
        }

        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_tbl_product_items'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('product_items', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'product_items',
            'addscripts'            => 'product_items',
            'primary_lang'          => $primary_lang, 
            'all_data'              => $all_data,
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_tbl_product_item'=> $all_language_data['admin_tbl_product_items'],
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id))
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/productitems/productitems_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method delete_productitems
     * This Function delete single product item as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the product item id. ]
     *
     * @return void
     */
    function delete_productitems($id) {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('product_items');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        // this function delete product item from tbl_product_items and tbl_product_items_country  table
        $this->comman_model->delete_where('tbl_product_items ', array('id' => $id));
        removeLangContent('tbl_product_items_country',$id);

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/productitems');
    }
    
    /**
     * Method add_productitems
     *  This Function Display Add product item and save the new item  in the database
     * @return void
     */
    function add_productitems() {

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('product_items');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_tbl_product_items'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {
             // this  code  executed when user submit the form.

             // this array is intialized to save in the database
            $post_data = array(
                'item_name'         => trim($this->input->post('item_name')),
                'item_type'         => trim($this->input->post('item_type')),
                'field_type'        => trim($this->input->post('field_type')),
                'item_text_size'    => trim($this->input->post('item_text_size')),
                'item_text_color'   => trim($this->input->post('item_text_color')),
                'multi_language'    => trim($this->input->post('multi_language')),
                'required_attribute'=> trim($this->input->post('required_attribute')),
                'created'           => date('Y-m-d')
            );
            $post_data = $this->security->xss_clean($post_data);

            // this function add new product item  in the database
            $this->comman_model->add('tbl_product_items', $post_data);

            $admin_static_links = $all_language_data['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']['front']);

            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/productitems');
        }

        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('product_items', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'product_items',
            'sub_menu'              => 'add_productitems',
            'addscripts'            => 'form_productitems',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_tbl_product_item'=> $all_language_data['admin_tbl_product_items']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/productitems/product_items_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method edit_productitems
     *  This Function Display edit  form and update the  product item  on the behalf of  id passed in the parameter.
     * @param $id $id [This Parameter is the product item  id. ]
     *
     * @return void
     */
    function edit_productitems($id = false) {
        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/productitems');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('product_items');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_tbl_product_items'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {
             // this  code  executed when user submit the form.

             // this array is intialized to update in the database
            $post_data = array(
                'item_name'         => trim($this->input->post('item_name')),
                'item_type'         => trim($this->input->post('item_type')),
                'field_type'        => trim($this->input->post('field_type')),
                'item_text_size'    => trim($this->input->post('item_text_size')),
                'item_text_color'   => trim($this->input->post('item_text_color')),
                'multi_language'    => trim($this->input->post('multi_language')),
                'required_attribute'=> trim($this->input->post('required_attribute')),
                'created'           => date('Y-m-d')
            );
            $post_data = $this->security->xss_clean($post_data);

            // this function update record in the database
            $this->comman_model->update_data_by_id('tbl_product_items', $post_data, 'id', $id);

            $admin_static_links = $all_language_data['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']['front']);

            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/productitems');
        }

        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('product_items', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'product_items',
            'addscripts'            => 'form_productitems',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_tbl_product_item'=> $all_language_data['admin_tbl_product_items'],
            'edit_data'             => allDataArray($this->comman_model->GetAllDataLangByid('tbl_product_items', 'id', $id, $this->lang->default_lang_id, 'tbl_product_items_country'))
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/productitems/product_items_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method checkProductitemExists
     * This Function checked that is product item  exist in the tbl_product_items or not.
     * @return void
     */
    public function checkProductitemExists($id = '') {
        $data = array();
        $item_name = $this->security->xss_clean($this->input->post('item_name'));
        $item_type = $this->security->xss_clean($this->input->post('item_type'));
        if($id && $item_name && $item_type){
            $result = $this->comman_model->get_data_by_id('tbl_product_items', array('id' => $id));
            if ($item_name == $result['item_name'] && $item_type == $result['item_type']) {
                $data['response'] = 'success';
            }else{
                // this function check is record exist in the table with same name  or not.
                $exists = $this->comman_model->check_row_exists('tbl_product_items', array('item_name' => $item_name, 'item_type' => $item_type));
                if ($exists) {
                     // if exist than this code return false
                    $data['response'] = 'fail';
                } else {
                    // if not  exist than this code return true
                    $data['response'] = 'success';
                }
            }
        }else if ($item_name && $item_type) {
            // this function check is record exist in the table with same name  or not.
            $exists = $this->comman_model->check_row_exists('tbl_product_items', array('item_name' => $item_name, 'item_type' => $item_type));
            if ($exists) {
                // if exist than this code return false
                $data['response'] = 'fail';
            } else {
                // if not  exist than this code return true
                $data['response'] = 'success';
            }
        }
        echo json_encode($data); exit;
    }
}