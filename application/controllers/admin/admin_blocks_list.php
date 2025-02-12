<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Admin_blocks_list
 * Admin_blocks_list Class handle all methods  related to block list of admin section like list blocked users, delete users.
 */
class Admin_blocks_list extends CI_Controller {

    /**
     * __construct
     *
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
     * This Function Display  Admin block list data.
     * @return void
     */
    function index($param1='',$param2=0) {

        check_lang_admin();

        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('admin_blocks_list');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $plang      = $this->comman_model->getPrimaryLang();

        $keypost = trim($this->security->xss_clean($this->input->post('search')));
        $offset  = 0; $keyword = ''; $uri_segment = 5;
        if (isset($param1) && $param1 != '' && isset($param2) && $param2 != '') {
            $offset = $param2;
            $keyword     = $param1;
            $uri_segment = 6;
        }else if (isset($param1) && $param1 != '') {
            $offset      = $param1;
        }else if (isset($keypost) && $keypost != '') {
            $keyword     = $keypost;
        }

        $config['per_page']  = 10;
        $config['num_links'] = 5;

        if($keyword){
            $config['base_url']   = base_url() . "admin/" . $this->lang->default_lang . "/admin_blocks_list/index/" . $keyword;
            $config['total_rows'] = $this->comman_model->record_search_count('entry_door_admin_block_data', $keyword, array('email', 'first_name', 'last_name', 'telephone'));
        }else{
            $config['base_url']   = base_url() . "admin/" . $this->lang->default_lang . "/admin_blocks_list/index/";
            $config['total_rows'] = $this->comman_model->record_count('entry_door_admin_block_data');
        }
        
        $config['uri_segment'] = $uri_segment;
        $config['first_link']  = '<< First';
        $config['last_link']   = 'Last >>';
        $config['next_link']   = 'Next ' . '&gt;';
        $config['prev_link']   = '&lt;' . ' Previous';
        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_blocks_list', 'entry_door_timer'), $this->lang->default_lang_id);

        // initialize Page data as array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('admin_user_block_list', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'addscripts'            => 'blocks_list',
            'active'                => 'admin_blocks_list',
            'all_data'              => $this->comman_model->record_search_data('entry_door_admin_block_data', $keyword, array('email', 'first_name', 'last_name', 'telephone'), $config['per_page'], $offset),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $keyword,
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_block_list'      => $all_language_data['admin_blocks_list'],
            'entry_door_timer'      => (object)$all_language_data['entry_door_timer']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/admin_blocks_list/admin_blocks_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method deleteSelectedBlockUser
     * This Function delete all rows as per the selected ids passed in the post parameter.
     * @return void
     */
    function deleteSelectedBlockUser() {
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('admin_blocks_list');
        if ($access['page_delete'] == 1) {
            $block_ids = $this->security->xss_clean($this->input->post('block_ids'));
            if(count($block_ids) > 0){
                $this->comman_model->deleteAllById('admin_door_block_emails', $block_ids, 'edb_id');
                $this->comman_model->deleteAllById('admin_door_block_phones', $block_ids, 'edb_id');
                $this->comman_model->deleteAllById('entry_door_admin_block_data', $block_ids, 'id');
            }
        }
    }
    
    /**
     * Method delete
     *  This Function delete single  row as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the row id of the admin_blocks_list table. ]
     *
     * @return void
     */
    function delete($id = false) {
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('admin_blocks_list');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        // this function delete the record by id.
        $this->comman_model->delete_where('admin_door_block_emails', array('edb_id' => $id));
        $this->comman_model->delete_where('admin_door_block_phones', array('edb_id' => $id));
        $this->comman_model->delete_where('entry_door_admin_block_data', array('id' => $id));

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);
        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/admin_blocks_list');
    }
}