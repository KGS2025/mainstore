<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Front_blocks_list
 * Front_blocks_list Class handle all methods  related to block list of front  section like list blocked users, delete users.
 */
class Front_blocks_list extends CI_Controller {

     /**
     * __construct
     *
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model(array('comman_model', 'entry_door_front_block_data'));
        $this->load->helper('assets');
        validateAdminLogin();
        validateUser();
    }
    
    /**
     * Method index
     *  This Function Display  Front end   block list data.
     * @return void
     */
    function index() {

        check_lang_admin();
        
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('front_blocks_list');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_front_user_block_list', 'cart_timer', 'entry_door_timer'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                        => $access,
            'login'                         => $this->session->all_userdata(),
            'title'                         => get_page_title('front_user_block_list', 'admin_title'),
            'lang_id'                       => $this->lang->default_lang,
            'lang_num'                      => $this->lang->default_lang_id,
            'active'                        => 'front_blocks_list',
            'addscripts'                    => 'blocks_list',
            'primary_lang'                  => !empty($plang) ? $plang['short_code'] : 'en', 
            'all_data'                      => $this->entry_door_front_block_data->get_block_data(),
            'admin_validuser_data'          => $this->session->userdata('admin_validuser_data'),
            'country_data'                  => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'            => $all_language_data['admin_static_links'],
            'admin_front_user_block_list'   => $all_language_data['admin_front_user_block_list'],
            'cart_timer'                    => $all_language_data['cart_timer'],
            'entry_door_timer'              => $all_language_data['entry_door_timer']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/front_blocks_list/front_blocks_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method blocksDeleteAll
     * This Function Delete records from front block list tables as per the ids passed in the post parameter.
     * @return void
     */
    function blocksDeleteAll() {
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('front_blocks_list');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $block_ids = $this->security->xss_clean($this->input->post('block_ids'));
        foreach ($block_ids as $block_id) {
            // this loop iterate each block ids post paramter value and explode it to id and table parameter
            $id = explode('_', $block_id);

            // below code delete records as per id and table name
            $this->deleteBlockData($id[0],$id[1]);
        }
        echo "Successfully Delete"; exit;
    }
    
    /**
     * Method delete
     * This Function delete record from the table as per table name  and id   passed in the parameter.
     * @param $table $table [This parameter is the table name.]
     * @param $id $id [This parameter is the id of the row.]
     *
     * @return void
     */
    function delete($table = false, $id = false) {
        $access = validatePageAccess('front_blocks_list');
        if ($access['page_delete'] != 1) {
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        // below code delete records as per id and table name
        $this->deleteBlockData($table,$id);

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);
        redirect(base_url(). 'admin/' . $this->lang->default_lang . '/front_blocks_list');
    }

    /**
     * Method deleteBlockData
     * This Function deleteBlockData record from the table as per table name and id   passed in the parameter.
     * @param $table $table [This parameter is the table name.]
     * @param $id $id [This parameter is the id of the row.]
     *
     * @return void
     */
    function deleteBlockData($table,$id){
        if ($table == 'edfbd') {
            $this->blocksDeleteById($id, 'entry_door_front_block_data');
        } elseif ($table == 'bel') {
            $this->blocksDeleteById($id, 'block_email_list');
        } elseif ($table == 'edbe') {
            $this->blocksDeleteById($id, 'entry_door_block_emails');
        } elseif ($table == 'edbp') {
            $this->blocksDeleteById($id, 'entry_door_block_phones');
        } elseif ($table == 'cbe') {
            $this->blocksDeleteById($id, 'cart_block_emails');
        } else {
            $this->blocksDeleteById($id, 'cart_block_phones');
        }
    }
    
    /**
     * Method blocksDeleteById
     * This Function is the child function for delete and delete all.
     * @param $id $id [explicite description]
     * @param $table $table [explicite description]
     *
     * @return void
     */
    function blocksDeleteById($id = false, $table) {
        $access = validatePageAccess('front_blocks_list');
        if ($access['page_delete'] != 1) {
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if($table == 'block_email_list') {
            $condition = array('int_id' => $id);
        } else {
            $condition = array('id' => $id);
        }
        $this->comman_model->delete_where($table, $condition);
    }

}
