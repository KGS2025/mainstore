<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Noaccess
 * This Class is just used to display no acces page on admin side.
 */
class Noaccess extends CI_Controller {

    /**
     * __construct
     *
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(array('comman_model'));
        $this->load->helper('assets');
        validateAdminLoginNo();
        validateUser();
    }
    
    
    /**
     * Method index
     * This function display the no access page view.
     * @return void
     */
    function index() {
        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'active'                => 'noaccess',
            'title'                 => get_page_title('no_access', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => get_admin_lang_data(array('admin_static_links'), $this->lang->default_lang_id)['admin_static_links']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/noaccess', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
}
