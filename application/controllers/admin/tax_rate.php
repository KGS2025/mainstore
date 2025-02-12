<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Tax_rate
 * Tax_rate Class handle all methods  related to tax rate  like list, add , edit , delete  and import rates.
 */
class Tax_rate extends CI_Controller {

    /**
     * __construct
     *
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model(array('comman_model', 'tax_rate_model'));
        $this->load->helper('assets');
        validateAdminLogin();
        validateUser();
    }
    
    /**
     * Method index
     * This function list all tax rates.
     * @return void
     */
    function index($param1='',$param2=0) {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('tax_rate');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteAll')) {
            // this function delete all tax rates 
            $this->comman_model->deleteAllDataWithLang('tax_rate');
        }
        if ($this->input->post('DeleteSelected')) {
            // this function delete all tax rates as per the role ids posted  in the post parameter
            $taxIds = $this->security->xss_clean($this->input->post('deleteitem'));
            $this->comman_model->deleteAllById('tax_rate', $taxIds, 'id');
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

        $config['per_page']  = 10;
        $config['num_links'] = 5;
        $config['uri_segment'] = $uri_segment;

        if ($key) {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/tax_rate/index/" . $key;
            $config['total_rows']   = $this->comman_model->record_search_count('tax_rate', $key, array('tax_base_rate', 'state_code', 'zip'));
        } else {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/tax_rate/index/";
            $config['total_rows']   = $this->comman_model->record_count('tax_rate');
        }

        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_tax_rate'), $this->lang->default_lang_id);
        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('tax_rate', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'tax_rate',
            'addscripts'            => 'tax_rate',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'all_data'              => $this->tax_rate_model->search_tax_rate_data($key, $config['per_page'], $offset),
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'searchText'            => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_tax_rate'        => $all_language_data['admin_tax_rate']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/tax_rate/tax_rate_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method delete_tax_rate
     * This Function delete tax rate as per the row id passed in the parameter.
     * @param $id $id [This parameter is the id of the row.]
     *
     * @return void
     */
    function delete_tax_rate($id) {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('tax_rate');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        // this function delete row from the tax_rate as per the row id.
        $this->comman_model->delete_where('tax_rate ', array('id' => $id));

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/tax_rate');
    }
    
    /**
     * Method add_tax_rate
     * This Function Display Add tax rate  form and save the information .
     * @return void
     */
    function add_tax_rate() {

        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('tax_rate');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {  
            // this  code  executed when user submit the form.
            $insertData = array(
                'tax_base_rate' => $this->input->post('tax_base_rate'),
                'state_code'    => $this->input->post('state_code'),
                'country_code'  => $this->input->post('country_code'),
                'zip'           => $this->input->post('zip')
            );
            $insertData = $this->security->xss_clean($insertData);

            // this code  save tax rate in the tax_rate table 
            $this->comman_model->add('tax_rate', $insertData);

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/tax_rate');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_tax_rate'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('tax_rate', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'tax_rate',
            'sub_menu'              => 'add_tax_rate',
            'addscripts'            => 'add_tax_rate',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_tax_rate'        => $all_language_data['admin_tax_rate']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/tax_rate/tax_rate_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method edit_tax_rate
     * This Function Display edit tax rate form and update the  rate on the behalf of rate  id passed in the parameter.
     * @param $id $id [This parameter is the tax rate  id.]
     * @return void
     */
    function edit_tax_rate($id = false) {
        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/tax_rate');
        }

        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('tax_rate');
        if ($access['page_edit'] != 1) {
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            $postData = array(
                'tax_base_rate' => $this->input->post('tax_base_rate'),
                'state_code'    => $this->input->post('state_code'),
                'country_code'  => $this->input->post('country_code'),
                'zip'           => $this->input->post('zip')
            );
            $postData = $this->security->xss_clean($postData);
            
            // this code  update tax rate  in the tax_rate table 
            $this->comman_model->update_data_by_id('tax_rate', $postData, 'id', $id);                      

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/tax_rate');
        }
        
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_tax_rate'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();
        $edit_data  = $this->comman_model->get_data_by_id('tax_rate',array('id'=>$id));

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('tax_rate', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'tax_rate',
            'addscripts'            => 'edit_tax_rate',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'edit_data'             => $edit_data,
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_tax_rate'        => $all_language_data['admin_tax_rate'],
            'states'                => $this->getStateByCountry($edit_data['country_code'], $edit_data['state_code'])
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/tax_rate/tax_rate_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method checkTaxRateExists
     * This Function checked that is tax rate exist for the zip code in the tax_rate table  or not.
     * @return void
     */
    public function checkTaxRateExists($id = '') {
        // this is zip code which is passed using post parameter
        $zip = $this->security->xss_clean($this->input->post('zip'));
        if($id && $zip){
            $result = $this->comman_model->get_data_by_id('tax_rate', array('id' => $id));
            if ($zip == $result['zip']) {
                // if not  exist than this code return true
                echo json_encode(TRUE);
            }else{
                // this function check is tax rate exist in the table with zip code or not.
                $exists = $this->comman_model->check_row_exists('tax_rate', array('zip' => $zip));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        }else if ($zip) {
            // this function check is tax rate exist in the table with zip code or not.
            $exists = $this->comman_model->check_row_exists('tax_rate', array('zip' => $zip));
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
     * Method tax_rate_download
     * This Function download tax rate in the database for using import csv.
     * @return void
     */
    function tax_rate_download(){
        //  this function validate the access of this page for current logged admin user.    
        $access = validatePageAccess('tax_rate');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        //Get existing tax rates and make array
        $tax_rates = $this->comman_model->all_data('tax_rate');
        $existingTaxData = array();
        if(count($tax_rates) > 0){
            foreach ($tax_rates as $tax_rate) {
                unset($tax_rate['id']);
                $existingTaxData[] = $tax_rate;
            }
        }

        // if existin data not available just create header array
        if (count($existingTaxData) == 0) {
            $existingTaxData = array('tax_rate' => '', 'state_code' => '', 'country_code' => '', 'zip' => '');
        }

        // process for making csv file
        $fileName   = 'tax_rate_' . time() . '.csv';
        dynamic_array_csv_download($existingTaxData, $fileName, 1);
    }
        
    /**
     * Method tax_rate_import
     * This Function import tax rate in the database using csv.
     * @return void
     */
    function tax_rate_import() {    
        //  this function validate the access of this page for current logged admin user.    
        $access = validatePageAccess('tax_rate');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();
        
        if ($this->input->post('operation')) { 

            $page_title = get_user_lang_data(array('admin_title'), $this->lang->default_lang_id)['admin_title'];
            
            // this  code  executed when user submit the form.
            $row      = 0;
            $filename = $_FILES['import_file']['tmp_name'];
            $mimes    = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
            if(in_array($_FILES['import_file']['type'],$mimes)){
                // if file uploaded is csv than this code executed
                $handle = @fopen($filename, "r");
                if ($handle){

                    //Get existing tax rates and make array
                    $tax_rates = $this->comman_model->all_data('tax_rate');
                    $existingTaxData = array();
                    if(count($tax_rates) > 0){
                        foreach ($tax_rates as $tax_rate) {
                            $existingTaxData[$tax_rate['state_code'].'_'.$tax_rate['zip']] = $tax_rate['id'];
                        }
                    }

                    //this loop iterate each row of csv and saved in the database
                    $insertData = array(); $skip_heading = 0;
                    while (($row = fgetcsv($handle, 4096)) !== false){
                        if(!empty($row)) { 
                            //it ommit the first row of the heading
                            if ($skip_heading == 0) {
                                $skip_heading++;
                                continue;
                            }

                            //check condition based on insert or update import data
                            if($row[0] && $row[1] && $row[2] && $row[3]){
                                if(isset($existingTaxData[$row[1].'_'.$row[3]]) && $existingTaxData[$row[1].'_'.$row[3]]){
                                    $this->comman_model->update_column('tax_rate', array('id' => $existingTaxData[$row[1].'_'.$row[3]]), array('tax_base_rate' => $row[0]));
                                }else{
                                    $insertData[] = array(
                                        'tax_base_rate' => $row[0],
                                        'state_code'    => $row[1],
                                        'country_code'  => $row[2],
                                        'zip'           => $row[3]              
                                    );
                                }
                            }
                        }
                    } 

                    if (!feof($handle)){
                        $this->session->set_flashdata('error',$page_title['csv_file_type']);
                        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/tax_rate/tax_rate_import');
                    }
                    
                    if(count($insertData) > 0){
                        $this->db->insert_batch('tax_rate',$insertData);
                    }
                    
                    fclose($handle);

                    $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                    // this function set success message in flash to display on frontend.
                    $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
                    redirect(base_url(). 'admin/' . $this->lang->default_lang . '/tax_rate');
                }
            } else {
                // if file uploaded is not csv than this code return error
                $this->session->set_flashdata('error',$page_title['csv_file_type']);
                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/tax_rate/tax_rate_import');
            }
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_tax_rate'), $this->lang->default_lang_id);
        $plang  = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('tax_rate', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'tax_rate',
            'addscripts'            => 'import_tax_rate',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_tax_rate'        => $all_language_data['admin_tax_rate']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/tax_rate/tax_rate_import', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method getStateByCountry
     * This Function checked and return the state list based on country code.
     * @param $countryCode $countryCode [This Parameter is the country code. ]
     * @param $stateCode $stateCode [This Parameter is the state code. ]
     *
     * @return void
     */
    function getStateByCountry($countryCode='',$stateCode=''){
        $countryCode = $countryCode ? $countryCode : $this->input->post('countryCode');
 
        $states = $this->comman_model->getStatesAdmin($this->lang->default_lang_id, $countryCode);
        $html = '<option value="">select any one</option>';
        if(count($states) > 0){
            foreach ($states as $state) {
                if($stateCode == $state['shortcode']){
                    $html .= '<option value="'.$state['shortcode'].'" selected>'.$state['name'].' - '.strtoupper($state['shortcode']).'</option>';
                }else{
                    $html .= '<option value="'.$state['shortcode'].'">'.$state['name'].' - '.strtoupper($state['shortcode']).'</option>';
                }
            }
        }
        if($stateCode){
            return $html;
        }else{
            echo $html;
        }
    }
}