<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Api
 * This Function handle all api's  UPS, PAYMEE,STRIPE, BAMBOORA related functions.
 */
class Api extends CI_Controller
{

    /**
     * __construct
     *
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model(array('api_model', 'product_model', 'comman_model', 'cart_model', 'product_items_model'));
        $this->load->helper(array('assets', 'cart_helper', 'file'));
    }

    /**
     * Method shipping_api_setting
     * This Function handle both ups and aramex shiiping api  forms. This Function do both actions display and submit form. 
     * @return void
     */
    function shipping_api_setting()
    {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('ups_api_setting');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('operation')) {
            // echo "<pre>";
            // print_r($this->input->post());
            // exit;
          
            // this  code  executed when user submit the form.
            if ($this->input->post('shipping_api') == 'ups') {
                // this  code  executed when user choose ups shiiping api radio button and submit the ups shipping form
                if (isset($_POST['access']) && count($_POST['access']) > 0) {
                    $postKeys = array_keys($_POST['access']);
                    foreach ($postKeys as $i) {
                        if (isset($_POST['country'][$i]) && isset($_POST['country'][$i])) {
                            // this function iterate setting related to each country and save in the database
                            $formData = array(
                                'country'                   => isset($_POST['country'][$i]) ? $_POST['country'][$i] : '',
                                'access'                    => isset($_POST['access'][$i]) ? $_POST['access'][$i] : '',
                                'userid'                    => isset($_POST['userid'][$i]) ? $_POST['userid'][$i] : '',
                                'passwd'                    => isset($_POST['passwd'][$i]) ? $_POST['passwd'][$i] : '',
                                'shipperNumber'             => isset($_POST['shipperNumber'][$i]) ? $_POST['shipperNumber'][$i] : '',
                                'shipper_description'       => isset($_POST['shipper_description'][$i]) ? $_POST['shipper_description'][$i] : '',
                                'shipper_name'              => isset($_POST['shipper_name'][$i]) ? $_POST['shipper_name'][$i] : '',
                                'shipper_attentionname'     => isset($_POST['shipper_attentionname'][$i]) ? $_POST['shipper_attentionname'][$i] : '',
                                'shipper_addressline1'      => isset($_POST['shipper_addressline1'][$i]) ? $_POST['shipper_addressline1'][$i] : '',
                                'shipper_addressline2'      => isset($_POST['shipper_addressline2'][$i]) ? $_POST['shipper_addressline2'][$i] : '',
                                'shipper_city'              => isset($_POST['shipper_city'][$i]) ? $_POST['shipper_city'][$i] : '',
                                'shipper_stateprovincecode' => isset($_POST['shipper_stateprovincecode'][$i]) ? $_POST['shipper_stateprovincecode'][$i] : '',
                                'shipper_postalcode'        => isset($_POST['shipper_postalcode'][$i]) ? $_POST['shipper_postalcode'][$i] : '',
                                'shipper_countrycode'       => isset($_POST['shipper_countrycode'][$i]) ? $_POST['shipper_countrycode'][$i] : '',
                                'shipper_number'            => isset($_POST['shipper_number'][$i]) ? $_POST['shipper_number'][$i] : '',
                                'pickup_days'            => isset($_POST['pickup_days'][$i]) ? $_POST['pickup_days'][$i] : ''

                            );
                            $formData = $this->security->xss_clean($formData);

                            // check if api id exist or new data based on script will run 
                            $api_id  = isset($_POST['api_id'][$i]) ? $_POST['api_id'][$i] : '';
                            if ($api_id) {
                                $this->comman_model->update_column('ups_api_setting', array('id' => $api_id), $formData);
                            } else {
                                $formData['shipping_api_mode'] = $this->input->post('shipping_api_mode');
                                $this->comman_model->insert_column('ups_api_setting', $formData);
                            }

                            //check if any api data deleted then it will remove from table
                            $delete_ups_api_id   = (isset($_POST['delete_ups_api_id']) && $_POST['delete_ups_api_id']) ? array_filter(explode(',', $_POST['delete_ups_api_id'])) : array();
                            if (count($delete_ups_api_id) > 0) {
                                $this->comman_model->deleteAllById('ups_api_setting', $delete_ups_api_id);
                            }
                        }
                    }

                    // this code save production and sandbox mode of the shiipping in global settings 
                    $this->comman_model->update_where('global_settings', array("setting_value" => $this->input->post('shipping_api_mode')), array('setting_type' => 'shipping_setting', 'setting_name' => 'shipping_mode'));
                }
            } else if ($this->input->post('shipping_api') == 'aramex') {
                // this  code  executed when user choose aramex shiiping api radio button and submit the aramex shipping form
                $formData = array(
                    'account_country_code'   => isset($_POST['account_country_code']) ? strtoupper($_POST['account_country_code']) : '',
                    'account_entity'         => isset($_POST['account_entity']) ? $_POST['account_entity'] : '',
                    'account_number'         => isset($_POST['account_number']) ? $_POST['account_number'] : '',
                    'account_pin'            => isset($_POST['account_pin']) ? $_POST['account_pin'] : '',
                    'user_name'              => isset($_POST['user_name']) ? $_POST['user_name'] : '',
                    'password'               => isset($_POST['password']) ? $_POST['password'] : '',
                    'version'                => isset($_POST['version']) ? $_POST['version'] : '',
                    'shipper_department'     => isset($_POST['shipper_department']) ? $_POST['shipper_department'] : '',
                    'shipper_name'           => isset($_POST['ship_name']) ? $_POST['ship_name'] : '',
                    'shipper_title'          => isset($_POST['shipper_title']) ? $_POST['shipper_title'] : '',
                    'shipper_company_name'   => isset($_POST['shipper_company_name']) ? $_POST['shipper_company_name'] : '',
                    'shipper_addressline1'   => isset($_POST['ship_addressline1']) ? $_POST['ship_addressline1'] : '',
                    'shipper_addressline2'   => isset($_POST['ship_addressline2']) ? $_POST['ship_addressline2'] : '',
                    'shipper_city'           => isset($_POST['ship_city']) ? $_POST['ship_city'] : '',
                    'shipper_stateprovincecode' => isset($_POST['ship_stateprovincecode']) ? $_POST['ship_stateprovincecode'] : '',
                    'shipper_postalcode'     => isset($_POST['ship_postalcode']) ? $_POST['ship_postalcode'] : '',
                    'shipper_countrycode'    => isset($_POST['ship_countrycode']) ? $_POST['ship_countrycode'] : '',
                    'shipper_phone1'         => isset($_POST['shipper_phone1']) ? $_POST['shipper_phone1'] : '',
                    'shipper_phone1_ext'     => isset($_POST['shipper_phone1_ext']) ? $_POST['shipper_phone1_ext'] : '',
                    'shipper_phone2'         => isset($_POST['shipper_phone2']) ? $_POST['shipper_phone2'] : '',
                    'shipper_phone2_ext'     => isset($_POST['shipper_phone2_ext']) ? $_POST['shipper_phone2_ext'] : '',
                    'shipper_fax_number'     => isset($_POST['shipper_fax_number']) ? $_POST['shipper_fax_number'] : '',
                    'shipper_email_id'       => isset($_POST['shipper_email_id']) ? $_POST['shipper_email_id'] : '',
                    'shipper_number'         => isset($_POST['ship_number']) ? $_POST['ship_number'] : '',

                );
                $formData = $this->security->xss_clean($formData);

                // check if api id exist or new data based on script will run 
                $aramex_api_id   = isset($_POST['aramex_api_id']) ? $_POST['aramex_api_id'] : '';
                if ($aramex_api_id) {
                    $this->comman_model->update_column('aramex_api_setting', array('id' => $aramex_api_id), $formData);
                } else {
                    $this->comman_model->insert_column('aramex_api_setting', $formData);
                }
            } else if ($this->input->post('shipping_api') == 'fedex') {
                // this  code  executed when user choose ups shiiping api radio button and submit the ups shipping form
                if (isset($_POST['client_id']) && count($_POST['client_id']) > 0) {
                    $postKeys = array_keys($_POST['client_id']);
                    foreach ($postKeys as $i) {
                        if (isset($_POST['country'][$i]) && isset($_POST['country'][$i])) {
                            // this function iterate setting related to each country and save in the database
                            $formData = array(
                                'country'                   => isset($_POST['country'][$i]) ? $_POST['country'][$i] : '',
                                'client_id'                 => isset($_POST['client_id'][$i]) ? $_POST['client_id'][$i] : '',
                                'client_secret'             => isset($_POST['client_secret'][$i]) ? $_POST['client_secret'][$i] : '',
                                'accountNumber'             => isset($_POST['accountNumber'][$i]) ? $_POST['accountNumber'][$i] : '',
                                'shipper_companyName'       => isset($_POST['shipper_companyName'][$i]) ? $_POST['shipper_companyName'][$i] : '',
                                'shipper_personName'       => isset($_POST['shipper_personName'][$i]) ? $_POST['shipper_personName'][$i] : '',
                                'shipper_addressline1'      => isset($_POST['shipper_addressline1'][$i]) ? $_POST['shipper_addressline1'][$i] : '',
                                'shipper_addressline2'      => isset($_POST['shipper_addressline2'][$i]) ? $_POST['shipper_addressline2'][$i] : '',
                                'shipper_city'              => isset($_POST['shipper_city'][$i]) ? $_POST['shipper_city'][$i] : '',
                                'shipper_stateprovincecode' => isset($_POST['shipper_stateprovincecode'][$i]) ? $_POST['shipper_stateprovincecode'][$i] : '',
                                'shipper_postalcode'        => isset($_POST['shipper_postalcode'][$i]) ? $_POST['shipper_postalcode'][$i] : '',
                                'shipper_countrycode'       => isset($_POST['shipper_countrycode'][$i]) ? $_POST['shipper_countrycode'][$i] : '',
                                'shipper_phoneNumber'            => isset($_POST['shipper_phoneNumber'][$i]) ? $_POST['shipper_phoneNumber'][$i] : ''

                            );
                            $formData = $this->security->xss_clean($formData);

                            // check if api id exist or new data based on script will run 
                            $api_id  = isset($_POST['fedex_api_id'][$i]) ? $_POST['fedex_api_id'][$i] : '';

                            $formData['shipping_api_mode'] = $this->input->post('shipping_api_mode_fedex');
                            if ($api_id) {
                               $this->comman_model->update_column('fedex_settings', array('id' => $api_id), $formData);
                            } else {
                                $formData['shipping_api_mode'] = $this->input->post('shipping_api_mode_fedex');
                                $this->comman_model->insert_column('fedex_settings', $formData);
                            }
                             
                           
                        }
                    }

                    // this code save production and sandbox mode of the shiipping in global settings 
                    $this->comman_model->update_where('global_settings', array("setting_value" => $this->input->post('shipping_api_mode')), array('setting_type' => 'shipping_setting', 'setting_name' => 'shipping_mode'));
                }


                //check if any api data deleted then it will remove from table
                $delete_fedex_api_id   = (isset($_POST['delete_fedex_api_id']) && $_POST['delete_fedex_api_id']) ? array_filter(explode(',', $_POST['delete_fedex_api_id'])) : array();

                                        
                if (count($delete_fedex_api_id) > 0) {
                    $this->comman_model->deleteAllById('fedex_settings', $delete_fedex_api_id);
                }



            } else if ($this->input->post('shipping_api') == 'freightcom') {
                // this  code  executed when user choose ups shiiping api radio button and submit the ups shipping form
                if (isset($_POST['client_secret']) && count($_POST['client_secret']) > 0) {
                    $postKeys = array_keys($_POST['client_secret']);
                    foreach ($postKeys as $i) {
                        if (isset($_POST['country'][$i]) && isset($_POST['country'][$i])) {
                            // this function iterate setting related to each country and save in the database
                            $formData = array(
                                'country'                   => isset($_POST['country'][$i]) ? $_POST['country'][$i] : '',
                                'client_token'             => isset($_POST['client_secret'][$i]) ? $_POST['client_secret'][$i] : '',
                                'accountNumber'             => isset($_POST['accountNumber'][$i]) ? $_POST['accountNumber'][$i] : '',
                                'shipper_companyName'       => isset($_POST['shipper_companyName'][$i]) ? $_POST['shipper_companyName'][$i] : '',
                                'shipper_personName'       => isset($_POST['shipper_personName'][$i]) ? $_POST['shipper_personName'][$i] : '',
                                'shipper_addressline1'      => isset($_POST['shipper_addressline1'][$i]) ? $_POST['shipper_addressline1'][$i] : '',
                                'shipper_addressline2'      => isset($_POST['shipper_addressline2'][$i]) ? $_POST['shipper_addressline2'][$i] : '',
                                'shipper_city'              => isset($_POST['shipper_city'][$i]) ? $_POST['shipper_city'][$i] : '',
                                'shipper_stateprovincecode' => isset($_POST['shipper_stateprovincecode'][$i]) ? $_POST['shipper_stateprovincecode'][$i] : '',
                                'shipper_postalcode'        => isset($_POST['shipper_postalcode'][$i]) ? $_POST['shipper_postalcode'][$i] : '',
                                'shipper_countrycode'       => isset($_POST['shipper_countrycode'][$i]) ? $_POST['shipper_countrycode'][$i] : '',
                                'shipper_phoneNumber'            => isset($_POST['shipper_phoneNumber'][$i]) ? $_POST['shipper_phoneNumber'][$i] : ''

                            );
                            $formData = $this->security->xss_clean($formData);

                            // check if api id exist or new data based on script will run 
                            $api_id  = isset($_POST['freightcom_api_id'][$i]) ? $_POST['freightcom_api_id'][$i] : '';

                            $formData['shipping_api_mode'] = $this->input->post('shipping_api_mode_freightcom');
                            if ($api_id) {
                               $this->comman_model->update_column('freightcom_settings', array('id' => $api_id), $formData);
                            } else {
                                $formData['shipping_api_mode'] = $this->input->post('shipping_api_mode_freightcom');
                                $this->comman_model->insert_column('freightcom_settings', $formData);
                            }
                             
                           
                        }
                    }

                    // this code save production and sandbox mode of the shiipping in global settings 
                    $this->comman_model->update_where('global_settings', array("setting_value" => $this->input->post('shipping_api_mode_freightcom')), array('setting_type' => 'shipping_setting', 'setting_name' => 'shipping_mode'));
                }


                //check if any api data deleted then it will remove from table
                $delete_freightcom_api_id   = (isset($_POST['delete_freightcom_api_id']) && $_POST['delete_freightcom_api_id']) ? array_filter(explode(',', $_POST['delete_freightcom_api_id'])) : array();

                                        
                if (count($delete_freightcom_api_id) > 0) {
                    $this->comman_model->deleteAllById('freightcom_settings', $delete_freightcom_api_id);
                }



            }

            // this code save shipping type  in the global_settings table 
            $this->db->where('setting_name', 'shipping_gateway');
            $this->db->update('global_settings', array('setting_value' => $this->input->post('shipping_api')));

            // if ($this->input->post('shipping_api') == 'aramex') {
            //     // $payment_gateway = 'paymee';
            //     // $currency_code = 'TND';
            //     // this code save payment_gateway type  in the global_settings table 
            //     // $this->db->where('setting_name', 'payment_gateway');
            //     // $this->db->update('global_settings', array('setting_value' => $payment_gateway));

            //     // this code save currency code  in the global_settings table 
            //     // $this->db->where('setting_name', 'default_currency_code');
            //     // $this->db->update('global_settings', array('setting_value' => $currency_code));
            // } else {
            //     $currency_code = 'CAD';

            //     // this code save currency code  in the global_settings table 
            //     $this->db->where('setting_name', 'default_currency_code');
            //     $this->db->update('global_settings', array('setting_value' => $currency_code));
            // }




            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/api/shipping_api_setting');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'api_instruction'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('ups_api_setting', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'ups_api_setting',
            'addscripts'            => 'api',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->api_model->get_ups_api_details(),
            'all_fedex'              => $this->api_model->get_fedex_api_details(),
            'all_freightcom'              => $this->api_model->get_freightcom_api_details(),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'api_instruction'       => $all_language_data['api_instruction'],
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'aramex_api_data'       => $this->api_model->get_aramex_api_details(),
            'shipping_list'         => $this->api_model->get_shipping_api_details()
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/api/shipping_api_setting', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /*payment api setting*/
    /**
     * Method payment_api_setting
     * This Function Display payment setting form and handle submission of the form.
     * @return void
     */
    function payment_api_setting()
    {

        check_lang_admin();

        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('payment_api_setting');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('operation')) {
            // echo "<pre>";
            // print_r($this->input->post());
            // exit;
            // this  code  executed when user submit the form.
            $payment_api_data = array();
            $paymentOptions = $this->input->post('payment_api');
            if ($this->input->post('payment_api') == 1) {
                // this code execute when user choose bambora payment api 
                $payment_gateway  = 'bambora';
                if (isset($_POST['merchant_id']) && count($_POST['merchant_id']) > 0) {
                    for ($i = 0; $i < count($_POST['merchant_id']); $i++) {
                        $formData = array(
                            'country'       => isset($_POST['country'][$i]) ? $_POST['country'][$i] : '',
                            'merchant_id'   => isset($_POST['merchant_id'][$i]) ? $_POST['merchant_id'][$i] : '',
                            'api_key'       => isset($_POST['api_key'][$i]) ? $_POST['api_key'][$i] : ''
                        );
                        $formData = $this->security->xss_clean($formData);

                        // check if api id exist or new data based on script will run 
                        $api_id   = isset($_POST['api_id'][$i]) ? $_POST['api_id'][$i] : '';
                        if ($api_id) {
                            $this->comman_model->update_column('bambora_api_setting', array('id' => $api_id), $formData);
                        } else {
                            $this->comman_model->insert_column('bambora_api_setting', $formData);
                        }

                        // check if any api data deleted then it will remove from table
                        $delete_bambora_api_id   = (isset($_POST['delete_bambora_api_id']) && $_POST['delete_bambora_api_id']) ? array_filter(explode(',', $_POST['delete_bambora_api_id'])) : array();
                        if (count($delete_bambora_api_id) > 0) {
                            $this->comman_model->deleteAllById('bambora_api_setting', $delete_bambora_api_id);
                        }
                    }

                    $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                    // this function set success message in flash to display on frontend.
                    $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
                }
            } else if ($this->input->post('payment_api') == 2) {
                // this code execute when user choose paymee payment api 
                $payment_gateway  = 'paymee';
                $insert_data = array(
                    'account_number'    => isset($_POST['account_number']) ? $_POST['account_number'] : '',
                    'token'             => isset($_POST['token']) ? $_POST['token'] : ''
                );
                // this code save paymee details in the  global_settings table
                $insert_data = $this->security->xss_clean($insert_data);
                $this->db->where('setting_name', 'paymee_account_number');
                $this->db->update('global_settings', array('setting_value' => $insert_data['account_number']));

                $this->db->where('setting_name', 'paymee_token');
                $this->db->update('global_settings', array('setting_value' => $insert_data['token']));

                $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
            } else if ($this->input->post('payment_api') == 5) {
                // this code execute when user choose paymee payment api 
                $payment_gateway  = 'moneris';
                $insert_data = array(
                    'moneris_live_store_id'    => isset($_POST['moneris_live_store_id']) ? $_POST['moneris_live_store_id'] : '',
                    'moneris_live_api_token'             => isset($_POST['moneris_live_api_token']) ? $_POST['moneris_live_api_token'] : '',
                    'moneris_sandbox_store_id'             => isset($_POST['moneris_sandbox_store_id']) ? $_POST['moneris_sandbox_store_id'] : '',
                    'moneris_sandbox_api_token'             => isset($_POST['moneris_sandbox_api_token']) ? $_POST['moneris_sandbox_api_token'] : ''
                );
                // this code save paymee details in the  global_settings table
                $insert_data = $this->security->xss_clean($insert_data);

                if($this->input->post('payment_api_mode') =="1"){
                $this->db->where('setting_name', 'moneris_live_store_id');
                $this->db->update('global_settings', array('setting_value' => $insert_data['moneris_live_store_id']));

                $this->db->where('setting_name', 'moneris_live_api_token');
                $this->db->update('global_settings', array('setting_value' => $insert_data['moneris_live_api_token']));

                }

            
                // this code save paymee details in the  global_settings table
                if($this->input->post('payment_api_mode') =="0"){

                $this->db->where('setting_name', 'moneris_sandbox_store_id');
                $this->db->update('global_settings', array('setting_value' => $insert_data['moneris_sandbox_store_id']));

                $this->db->where('setting_name', 'moneris_sandbox_api_token');
                $this->db->update('global_settings', array('setting_value' => $insert_data['moneris_sandbox_api_token']));
                
                }
                $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
            }  else if ($this->input->post('payment_api') == 4) {
                // this code execute when user choose paymee payment api 
                $payment_gateway  = 'clictopay';
                $insert_data = array(
                    'ctp_apiuserName'    => isset($_POST['ctp_apiuserName']) ? $_POST['ctp_apiuserName'] : '',
                    'ctp_password'             => isset($_POST['ctp_password']) ? $_POST['ctp_password'] : ''
                );
                // this code save paymee details in the  global_settings table
                $insert_data = $this->security->xss_clean($insert_data);
                $this->db->where('setting_name', 'ctp_apiuserName');
                $this->db->update('global_settings', array('setting_value' => $insert_data['ctp_apiuserName']));

                $this->db->where('setting_name', 'ctp_password');
                $this->db->update('global_settings', array('setting_value' => $insert_data['ctp_password']));

                $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
            } else if ($this->input->post('payment_api') == 3) {
                // this code execute when user choose bambora payment api 
                $payment_gateway  = 'squareup';
                if (isset($_POST['application_id']) && count($_POST['application_id']) > 0) {
                    $postKeys = array_keys($_POST['application_id']);
                    foreach ($postKeys as $i) {
                        if (isset($_POST['country_squareup'][$i]) && $_POST['country_squareup'][$i]) {
                            $formData = array(
                                'country'           => isset($_POST['country_squareup'][$i]) ? $_POST['country_squareup'][$i] : '',
                                'application_id'    => isset($_POST['application_id'][$i]) ? $_POST['application_id'][$i] : '',
                                'location_id'       => isset($_POST['location_id'][$i]) ? $_POST['location_id'][$i] : '',
                                'access_token'      => isset($_POST['access_token'][$i]) ? $_POST['access_token'][$i] : ''
                            );
                            $formData = $this->security->xss_clean($formData);

                            // check if api id exist or new data based on script will run 
                            $api_squareup_id   = isset($_POST['api_squareup_id'][$i]) ? $_POST['api_squareup_id'][$i] : '';
                            if ($api_squareup_id) {
                                $this->comman_model->update_column('squareup_api_setting', array('id' => $api_squareup_id), $formData);
                            } else {
                                $formData['payment_api_mode'] = $this->input->post('payment_api_mode');
                                $this->comman_model->insert_column('squareup_api_setting', $formData);
                            }

                            // check if any api data deleted then it will remove from table
                            $delete_squareup_api_id = (isset($_POST['delete_squareup_api_id']) && $_POST['delete_squareup_api_id']) ? array_filter(explode(',', $_POST['delete_squareup_api_id'])) : array();
                            if (count($delete_squareup_api_id) > 0) {
                                $this->comman_model->deleteAllById('squareup_api_setting', $delete_squareup_api_id);
                            }
                        }
                    }

                    $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                    // this function set success message in flash to display on frontend.
                    $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
                }
            }  else if ($this->input->post('payment_api') == 6) {//added for paypal
                // this code execute when user choose paymee payment api 
                $payment_gateway  = 'paypal';
                $insert_data = array(
                    'paypal_client_sandbox'    => isset($_POST['paypal_client_sandbox']) ? $_POST['paypal_client_sandbox'] : '',
                    'paypal_secret_sandbox'             => isset($_POST['paypal_secret_sandbox']) ? $_POST['paypal_secret_sandbox'] : '',
                    'paypal_client_live'    => isset($_POST['paypal_client_live']) ? $_POST['paypal_client_live'] : '',
                    'paypal_secret_live'             => isset($_POST['paypal_secret_live']) ? $_POST['paypal_secret_live'] : '',                    
                    'updated_date'  => Date('Y-m-d h:i:s'),
                    'updated_by'  => $this->session->userdata('admin_validuser_data')['id']
                );
                //print_r($insert_data);exit;
                // this code save paymee details in the  global_settings table
                $insert_data = $this->security->xss_clean($insert_data);
                $this->db->where('setting_name', 'paypal_client_sandbox');
                $this->db->update('global_settings', array('setting_value' => $insert_data['paypal_client_sandbox']));

                $this->db->where('setting_name', 'paypal_secret_sandbox');
                $this->db->update('global_settings', array('setting_value' => $insert_data['paypal_secret_sandbox']));

                $this->db->where('setting_name', 'paypal_client_live');
                $this->db->update('global_settings', array('setting_value' => $insert_data['paypal_client_live']));

                $this->db->where('setting_name', 'paypal_secret_live');
                $this->db->update('global_settings', array('setting_value' => $insert_data['paypal_secret_live']));

                //$this->db->where('1=1');
                $this->db->update('paypal_api_setting',$insert_data);

                $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            } else if ($this->input->post('payment_api') == 99) {
                // this code execute when user choose paymee payment api 
                $payment_gateway  = 'paymentproof';
               
              
                $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
            }  else {
                // this code execute when user choose stripe payment api 
                $payment_gateway  = 'stripe';
                $insert_data = array(
                    'stripe_live_secret_key' => isset($_POST['stripe_live_secret_key']) ? $_POST['stripe_live_secret_key'] : '',
                    'stripe_live_publishable_key'      => isset($_POST['stripe_live_publishable_key']) ? $_POST['stripe_live_publishable_key'] : '',
                    'stripe_sandbox_secret_key'      => isset($_POST['stripe_sandbox_secret_key']) ? $_POST['stripe_sandbox_secret_key'] : '',
                    'stripe_sandbox_publishable_key'      => isset($_POST['stripe_sandbox_publishable_key']) ? $_POST['stripe_sandbox_publishable_key'] : '',
                    'stripe_payment_intent'      => isset($_POST['stripe_payment_intent']) ? $_POST['stripe_payment_intent'] : '0'
                );
                $insert_data = $this->security->xss_clean($insert_data);

                // this code save stripe details in the  global_settings table
                $this->db->where('setting_name', 'stripe_payment_intent');
                $this->db->update('global_settings', array('setting_value' => $insert_data['stripe_payment_intent']));

                $this->db->where('setting_name', 'stripe_live_secret_key');
                $this->db->update('global_settings', array('setting_value' => $insert_data['stripe_live_secret_key']));

                $this->db->where('setting_name', 'stripe_live_publishable_key');
                $this->db->update('global_settings', array('setting_value' => $insert_data['stripe_live_publishable_key']));
               
                $this->db->where('setting_name', 'stripe_sandbox_secret_key');
                $this->db->update('global_settings', array('setting_value' => $insert_data['stripe_sandbox_secret_key']));

                $this->db->where('setting_name', 'stripe_sandbox_publishable_key');
                $this->db->update('global_settings', array('setting_value' => $insert_data['stripe_sandbox_publishable_key']));


                $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                // this function set success message in flash to display on frontend.
                $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
            }

            // this code save production and sandbox mode of the payment in global settings 
            $this->comman_model->update_where('global_settings', array("setting_value" => $this->input->post('payment_api_mode')), array('setting_type' => 'payment_setting', 'setting_name' => 'payment_mode'));

            // this code payment gateway  details in the  global_settings table
            $this->db->where('setting_name', 'payment_gateway');
            $this->db->update('global_settings', array('setting_value' => $payment_gateway));

            // if ($paymentOptions == 0 || $paymentOptions == 1 || $paymentOptions == 3) {
            //     $shipping_gateway = 'ups';
            //     $currency_code = 'CAD';
            // } else if ($paymentOptions == 2 || $paymentOptions == 4) {
            //     $shipping_gateway = 'aramex';
            //     $currency_code = 'TND';
            // } else if ($paymentOptions == 5) {
            //     $shipping_gateway = 'ups';
            //     $currency_code = 'CAD';
            // }
            // $this->db->where('setting_name', 'shipping_gateway');
            // $this->db->update('global_settings', array('setting_value' => $shipping_gateway));

            // $this->db->where('setting_name', 'default_currency_code');
            // $this->db->update('global_settings', array('setting_value' => $currency_code));

            // this function redirect user to payment settings table.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/api/payment_api_setting');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'api_instruction'), $this->lang->default_lang_id);
        $plang  = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('payment_api_setting', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'payment_api_setting',
            'addscripts'            => 'api',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'bambora_all_data'      => $this->api_model->get_payment_api_details('bambora_api_setting'),
            'squareup_all_data'     => $this->api_model->get_payment_api_details('squareup_api_setting'),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'api_instruction'       => $all_language_data['api_instruction'],
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'aramex_api_data'       => $this->api_model->get_aramex_api_details(),
            'shipping_list'         => $this->api_model->get_shipping_api_details()
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/api/payment_api_setting', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method shipping_markup_setting
     * This Function Display shipping markup setting form and handle submission of the form. 
     * @return void
     */
    function shipping_markup_setting()
    {

        check_lang_admin();

        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('shipping_markup_setting');
        if ($access['page_access'] != 1) {
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            $insert_data = array(
                'shipping_markup_value'     => isset($_POST['shipping_markup_value']) ? $_POST['shipping_markup_value'] : 0,
                'shipping_incoterm_options' => isset($_POST['shipping_incoterm_options']) ? $_POST['shipping_incoterm_options'] : 'both'
            );
            $insert_data = $this->security->xss_clean($insert_data);

            // this code save  details in the  global_settings table
            $this->db->where('setting_name', 'shipping_markup_value');
            $this->db->update('global_settings', array('setting_value' => $insert_data['shipping_markup_value']));

            $this->db->where('setting_name', 'shipping_incoterm_options');
            $this->db->update('global_settings', array('setting_value' => $insert_data['shipping_incoterm_options']));

            // this function set success message in flash to display on frontend.
            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/api/shipping_markup_setting');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'api_instruction', 'cart_instruction'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('shipping_markup_setting', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'shipping_markup_setting',
            'addscripts'            => 'api',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'api_instruction'       => $all_language_data['api_instruction'],
            'cart_instruction'      => (object)$all_language_data['cart_instruction'],
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id))
        );

        //echo '<pre>';print_r($pageData['cart_instruction']);exit;

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/api/shipping_markup_setting', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
}

