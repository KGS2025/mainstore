<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Errors
 * This Class Handle  functions related to Bambora, Stripe and UPS error messages. Update message using form and download using csv.
 */
class Errors extends CI_Controller {
    
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
     * This Function Display bamboora messages form and handle submission of the form.
     * @return void
     */
    function index($errorType = 'bambora_errors') {

        validateAdminLogin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess($errorType);
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        

        if ($this->input->post('operation')) {
            if(count($this->input->post($errorType)) > 0){
                $field = 'error_text';
                if($errorType == 'ups_service_code_description'){
                    $field = 'description';
                }
                
                // this  code  executed when user submit the form.
                foreach ($this->input->post($errorType) as $key => $value) {
                    // this loop iterate each input and saved in the table
                    $this->comman_model->update_column($errorType, array('id' => $key), array($field => $value));
                }

                // this function set success message in flash to display on frontend.
                $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
                redirect(base_url() . "admin/" . $this->lang->default_lang . "/errors/index/".$errorType);
            }
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links'), $this->lang->default_lang_id);
        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title($errorType, 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => $errorType,
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
        );

        // this function get all errors from the table and passed to the view file.
        if($errorType == 'bambora_errors'){
            $pageData['bambora_errors']       = $this->comman_model->getBamboraErrors($this->lang->default_lang_id);
            $pageData['admin_bambora_errors'] = $this->comman_model->getAdminBamboraErrors($this->lang->default_lang_id);
        }else if($errorType == 'stripe_errors'){
            $pageData['stripe_errors']       = $this->comman_model->getStripeErrors($this->lang->default_lang_id);
            $pageData['admin_stripe_errors'] = $this->comman_model->getAdminStripeErrors($this->lang->default_lang_id);
        }else if($errorType == 'ups_service_code_description'){
            $pageData['ups_service_code_description']       = $this->comman_model->getUpsServiceCodeDescription($this->lang->default_lang_id);
            $pageData['admin_ups_service_code_description'] = $this->comman_model->getAdminUpsServiceCodeDescription($this->lang->default_lang_id);
        }else if($errorType == 'ups_errors'){
            $pageData['ups_errors']       = $this->comman_model->getUpsErrors($this->lang->default_lang_id);
            $pageData['admin_ups_errors'] = $this->comman_model->getAdminUpsErrors($this->lang->default_lang_id);
        }

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/errors/'.$errorType, $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
}