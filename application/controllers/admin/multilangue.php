<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Multilangue
 * This Class handle multilangual data for all tables. This class display form related to multilangual and update that data.
 */
class Multilangue extends CI_Controller
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
        $this->load->model(array('comman_model'));
        $this->load->helper('assets');
        //  validateAdminLogin();
    }

    /**
     * Method index
     * Thuis Function Display form of  all  languages as per table and column name passed in the parameter. This Same function used to save the information in the database also.
     * @param $id $id [This parameter is the row id.]
     * @param $table_name $table_name [This parameter is the table name of language table.]
     * @param $field_name $field_name [This parameter is the column name of the table.]
     * @param $input_type $input_type [This parameter is the input type.]
     * @param $editor $editor [This parameter is the edtor.]
     *
     * @return void
     */
    function index($id, $table_name, $field_name, $input_type = 'input', $editor = "none")
    {

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id)['admin_static_links'];

        $modify = false;
        if ($this->input->post('operation')) {

            // this  code  executed when user submit the form.
            $update_valide = $admin_static_links['following_language_fields_changed'] . ' :';

            $country_list = $this->comman_model->all_data('country');
            foreach ($country_list as $country) {
                // this function iterate each country and get value of post parameter as per the country and save in the variable
                $libelle = "value_" . $country['id'];
                $libelle_hidden = "value_hidden_" . $country['id'];

                $field_value = trim($this->security->xss_clean($this->input->post($libelle)));
                if ($this->security->xss_clean($this->input->post($libelle)) == "<p><br></p>")
                    $field_value = "";
                if ($field_value != $this->security->xss_clean($this->input->post($libelle_hidden))) {
                    $country_id = $country['id'];
                    // this function update value in the table as per the language input
                    $result = $this->comman_model->addOrUpdateMultilangueValues($table_name, "lang_" . $field_name, $id, $field_value, $country_id);
                    // this code set value to display success message
                    $update_valide .= "<br /> - " . $country['name'];
                    $modify = true;
                }
            }
            if (!$modify) {
                $update_valide = $admin_static_links['no_fields_have_changed'];
            } else {
                $this->update_menu_language_status_by_table($id, $table_name, "lang_" . $field_name);
            }
        }

        $data_table_name = $table_name;

        if ($table_name == 'admin_country_lang') {
            $tablename = explode('_lang', $table_name);
        } else if ($table_name == 'admin_user_country_blocked_country') {
            $tablename[0] = 'admin_user_country_blocked';
        } else {
            $tablename = explode('_country', $table_name);
        }

        $edit_value = array();
        // this code fetch values from table as per the parameter and passed to the view file
        if ($field_name != 'cart_verification_code_mail' && $field_name != 'cart_verification_code_withphone_mail' && $field_name != 'entry_verification_code_mail' && $field_name != 'entry_verification_code_withphone_mail' && $field_name != 'admin_forgot_details_form_verification_code_mail' && $field_name != 'admin_user_details_mail' && $field_name != 'cart_mail' && $field_name != 'cookie_page') {

            // this conditional statement get records from table as per below condition
            if ($table_name == 'admin_countries_lang') {
                $edit_value = allDataArray($this->comman_model->GetAllDataLangByid('admin_countries', 'id', $id, $this->lang->default_lang_id, 'admin_countries_lang'));
            } else if ($table_name == 'countries_lang') {
                $edit_value = allDataArray($this->comman_model->GetAllDataLangByidCountry_new('countries', 'id', $id, $this->lang->default_lang_id, 'countries_lang'));            } else if ($table_name == 'admin_ups_service_code_description_country') {
                $edit_value = allDataArray($this->comman_model->GetAllDataLangByid('admin_ups_service_code_description', 'id', $id, $this->lang->default_lang_id, 'admin_ups_service_code_description_country'));
            } else if ($table_name == 'admin_ups_errors_country') {
                $edit_value = allDataArray($this->comman_model->GetAllDataLangByid('admin_ups_errors', 'id', $id, $this->lang->default_lang_id, 'admin_ups_errors_country'));
            } else if ($table_name == 'ups_service_code_description_country') {
                $edit_value = allDataArray($this->comman_model->GetAllDataLangByid('ups_service_code_description', 'id', $id, $this->lang->default_lang_id, 'ups_service_code_description_country'));
            } else if ($table_name == 'ups_errors_country') {
                $edit_value = allDataArray($this->comman_model->GetAllDataLangByid('ups_errors', 'id', $id, $this->lang->default_lang_id, 'ups_errors_country'));
            } else if ($table_name == 'admin_bambora_errors_country') {
                $edit_value = allDataArray($this->comman_model->GetAllDataLangByid('admin_bambora_errors', 'id', $id, $this->lang->default_lang_id, 'admin_bambora_errors_country'));
            } else if ($table_name == 'bambora_errors_country') {
                $edit_value = allDataArray($this->comman_model->GetAllDataLangByid('bambora_errors', 'id', $id, $this->lang->default_lang_id, 'bambora_errors_country'));
            } else if ($table_name == 'admin_state_country') {
                $edit_value = allDataArray($this->comman_model->GetAllDataLangByid('admin_state', 'id', $id, $this->lang->default_lang_id, 'admin_state_country'));
            } else if ($table_name == 'state_country') {
                $edit_value = allDataArray($this->comman_model->GetAllDataLangByid('state', 'id', $id, $this->lang->default_lang_id, 'state_country'));
            } else {
                $edit_value = allDataArray($this->comman_model->GetAllDataLangByid($tablename[0], 'id', $id, $this->lang->default_lang_id, $table_name));
            }
        }

        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('multi_language', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'multilangue',
            'addscripts'            => 'multilangue',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $admin_static_links,
            'edit_value'            => isset($edit_value[$field_name]) ? $edit_value[$field_name] : '',
            'values_list'           => $this->comman_model->getMultilangueValues($id, $table_name, "lang_" . $field_name),
            'id'                    => $id,
            'table_name'            => $data_table_name,
            'field_name'            => "lang_" . $field_name,
            'input_type'            => $input_type,
            'editor'                => $editor,
            'update_valide'         => isset($update_valide) ? $update_valide : ''
        );
        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/multilangue/multilangue', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method index
     * This Function Display  inputs related to section type  and handle submission of the form.
     * @return void
     */
    function section($sectionType)
    {
        if (!$sectionType) {
            // if sectionType is empty  this function redirect user to dashboard  page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/dashboard');
        }

        $access = validatePageAccess($sectionType);
        if ($access['page_access'] != 1) {
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        // this function get all records from the language  table as per section name.

        $all_language_data = get_admin_lang_data(array('admin_title', 'admin_static_links', 'general_instruction', $sectionType), $this->lang->default_lang_id);

        $admin_static_links =  $all_language_data['admin_static_links'];

        if ($this->input->post('operation')) {

            if (count($this->input->post($sectionType)) > 0) {

                // this  code  executed when user submit the form.
                foreach ($this->input->post($sectionType) as $key => $value) {
                    // this loop iterate each input and saved in the table
                    $this->comman_model->update_where('language_data', array('front_option_value ' => $value), array('section_name' => $sectionType, 'option_name' => $key));
                }

                // this function set success message in flash to display on frontend.
                $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']['front']);
                redirect(base_url() . "admin/" . $this->lang->default_lang . "/multilangue/section/" . $sectionType);
            }
        }
        $section_data = $all_language_data[$sectionType];

        $titles     =  $all_language_data['admin_title'];
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => $titles[$sectionType]['front'],
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => $sectionType,
            'sectionType'           => $sectionType,
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'lang_heading_title'    => isset($titles[$sectionType . '_inner']['front']) ? $titles[$sectionType . '_inner']['front'] : '',
            'admin_static_links'    => $admin_static_links,
            'general_instruction'   => $all_language_data['general_instruction'],
            'section_data'          => $section_data
        );

        //echo '<pre>';print_r($pageData['section_data']);exit;

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        if ($sectionType == 'entry_door_timer') {
            $this->load->view('admin/multilangue/entry_door_timer', $pageData);
        } else if ($sectionType == 'cart_timer') {
            $this->load->view('admin/multilangue/cart_timer', $pageData);
        } else if ($sectionType == 'admin_door_timer') {
            $this->load->view('admin/multilangue/admin_door_timer', $pageData);
        } else if ($sectionType == 'contact_timer') {
            $this->load->view('admin/multilangue/contact_timer', $pageData);
        } else if ($sectionType == 'contact_message') {
            $this->load->view('admin/multilangue/contact_message', $pageData);
        } else if ($sectionType == 'email_instruction') {
            $this->load->view('admin/multilangue/manage_email_instruction', $pageData);
        } else if ($sectionType == 'entry_door_message') {
            $this->load->view('admin/multilangue/entry_door_message', $pageData);
        } else if ($sectionType == 'selection_instruction') {
            $this->load->view('admin/multilangue/selection_instruction', $pageData);
        } else {
            $this->load->view('admin/multilangue/language_data_form', $pageData);
        }
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method update_menu_language_status_by_table
     * Already exist in the common helper.
     * @param $languageId $languageId [explicite description]
     * @param $table $table [explicite description]
     * @param $field $field [explicite description]
     *
     * @return void
     */
    function update_menu_language_status_by_table($languageId, $table, $field)
    {
        $this->db->select('group_concat(id) as id');
        $this->db->where('status', 1);
        $this->db->where('id !=', 13);
        $result = $this->db->get('country')->row_array();
        $countries = (isset($result['id']) && $result['id']) ? explode(',', $result['id']) : array();
        $total = count($countries);

        $this->db->select('lang_id');
        $this->db->where('lang_id', $languageId);
        $this->db->where_in('country_id', $countries);
        $this->db->where($field . ' !=', '');
        $exist = $this->db->get($table)->num_rows();
        $status = 0;
        if ($total == $exist) {
            $status = 1;
        }

        $conditionData = array('lang_id' => $languageId, 'table' => $table, 'field' => $field);

        $this->db->select('id');
        $this->db->where($conditionData);
        $status_check = $this->db->get('admin_all_language_status')->num_rows();
        if ($status_check == 0) {
            $conditionData['status'] = $status;
            $this->db->insert('admin_all_language_status', $conditionData);
        } else {
            $this->db->where($conditionData);
            $this->db->update('admin_all_language_status', array('status' => $status));
        }

        $getfile  = file_get_contents('vendor/admin_all_language_status.json');
        $jsonData = json_decode($getfile, true);
        $jsonData[$languageId . '-' . $table . '-' . $field] = $status;
        file_put_contents("vendor/admin_all_language_status.json", json_encode($jsonData));
    }

    /**
     * Method update_common_language_status_by_section
     * Already exist in the common helper.
     * @param $langId $langId [explicite description]
     * @param $section_name $table [explicite description]
     * @param $action $action [explicite description]
     * @param $option_name $option_name [explicite description]
     *
     * @return void
     */
    function update_common_language_status_by_section($langId, $section_name, $action, $option_name)
    {
        $this->db->select('group_concat(id) as id');
        $this->db->where('status', 1);
        $this->db->where('id !=', 13);
        $result = $this->db->get('country')->row_array();
        $countries = (isset($result['id']) && $result['id']) ? explode(',', $result['id']) : array();
        $total = count($countries);

        $this->db->select('id');
        $this->db->where('language_data_id ', $langId);
        $this->db->where_in('country_id', $countries);
        $this->db->where('lang_' . $action . '_option_value !=', '');
        $exist = $this->db->get('language_data_country')->num_rows();
        $status = 0;
        if ($total == $exist) {
            $status = 1;
        }

        $conditionData = array('lang_id' => 1, 'table' => $section_name, 'field' => $action . '_' . $option_name);
        $this->db->select('id');
        $this->db->where($conditionData);
        $status_check = $this->db->get('admin_all_language_status')->num_rows();
        if ($status_check == 0) {
            $conditionData['status'] = $status;
            $this->db->insert('admin_all_language_status', $conditionData);
        } else {
            $this->db->where($conditionData);
            $this->db->update('admin_all_language_status', array('status' => $status));
        }

        $getfile  = file_get_contents('vendor/admin_all_language_status.json');
        $jsonData = json_decode($getfile, true);
        $jsonData['1-' . $section_name . '-' . $action . '_' . $option_name] = $status;
        file_put_contents("vendor/admin_all_language_status.json", json_encode($jsonData));
    }

    /**
     * Method saveLanguageData
     * This function is used to save the label  value of sections on admin side . 
     * @param $section_name $section_name [This parameter is the section name.]
     * @param $option_name $option_name [This parameter is the option name.]
     * @param $action $action [This parameter is the column name of the row.]
     *
     * @return void
     */
    function saveLanguageData($section_name, $option_name, $action = 'admin')
    {
        // this post  parameter is the value for the column to update in the table
        $field_value = $this->security->xss_clean($this->input->post('field_value'));

        if ($section_name && $option_name && isset($field_value) && $field_value) {
            $field_name = $action . '_option_value';
            // if post paramter is not empty than this function update record in the database.
            $this->comman_model->update_column('language_data', array('section_name' => $section_name, 'option_name' => $option_name), array($field_name => $field_value));
            echo 'success';
        } else {
            echo 'fail';
        }
        exit;
    }

    /**
     * Method saveLanguageDataByCountry
     * Thuis Function Display form of  all  languages as per table and column name passed in the parameter. This Same function used to save the information in the database also.
     * @param $section_name $section_name [This parameter is the section name of language table.]
     * @param $option_name $option_name [This parameter is the column name of the table.]
     * @param $action $action [This parameter is the update coulum field.]
     * @param $input_type $input_type [This parameter is the input type.]
     * @param $editor $editor [This parameter is the edtor.]
     *
     * @return void
     */
    function saveLanguageDataByCountry($section_name, $option_name, $action = 'admin', $input_type = 'input', $editor = "none")
    {

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id)['admin_static_links'];

        $langData = $this->comman_model->get_data_by_id('language_data', array('section_name' => $section_name, 'option_name' => $option_name));

        $field_name = $action . '_option_value';

        $modify = false;
        if ($this->input->post('operation')) {
            if (isset($langData['id']) && $langData['id']) {
                // this  code  executed when user submit the form.
                $update_valide = $admin_static_links['following_language_fields_changed'] . ' :';

                $country_list = $this->comman_model->all_data('country');
                foreach ($country_list as $country) {
                    // this function iterate each country and get value of post parameter as per the country and save in the variable
                    $libelle = "value_" . $country['id'];
                    $libelle_hidden = "value_hidden_" . $country['id'];

                    $field_value = trim($this->security->xss_clean($this->input->post($libelle)));
                    if ($this->security->xss_clean($this->input->post($libelle)) == "<p><br></p>")
                        $field_value = "";

                    if ($field_value != $this->security->xss_clean($this->input->post($libelle_hidden))) {
                        $country_id = $country['id'];
                        $langCountryData = $this->comman_model->get_data_by_id('language_data_country', array('language_data_id' => $langData['id'], 'country_id' => $country_id));
                        if (count($langCountryData) > 0) {
                            // this function update value in the table as per the language input
                            $this->comman_model->update_column('language_data_country', array('language_data_id' => $langData['id'], 'country_id' => $country_id), array("lang_" . $field_name => $field_value));
                        } else {
                            // this function insert value in the table as per the language input
                            $this->comman_model->add('language_data_country', array('language_data_id' => $langData['id'], 'country_id' => $country_id, "lang_" . $field_name => $field_value));
                        }

                        // this code set value to display success message
                        $update_valide .= "<br /> - " . $country['name'];
                        $modify = true;
                    }
                }
                if (!$modify) {
                    $update_valide = $admin_static_links['no_fields_have_changed'];
                } else {
                    $this->update_common_language_status_by_section($langData['id'], $section_name, $action, $option_name);
                }
            }
        }

        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('multi_language', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'multilangue',
            'addscripts'            => 'multilangue',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $admin_static_links,
            'edit_value'            => $langData[$field_name],
            'values_list'           => $this->comman_model->getMultilangueValues($langData['id'], 'language_data_country', "lang_" . $field_name, 'language_data_id'),
            'field_name'            => "lang_" . $field_name,
            'input_type'            => $input_type,
            'editor'                => $editor,
            'update_valide'         => isset($update_valide) ? $update_valide : ''
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/multilangue/multilangue', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }


    /**
     * Method import_language_data
     * This Function is used for one time activity.
     * @return void
     */
    function import_language_data()
    {

        $full_tables = array('page_title', 'admin_title', 'general_instruction', 'product_instruction', 'cart_instruction', 'form_validation_instruction', 'sales_order_preview', 'admin_static_links', 'admin_products', 'api_instruction', 'email_instruction', 'entry_door_timer', 'bambora_instructions', 'cart_timer', 'admin_door_timer');



        foreach ($full_tables as $single_table) {
            // change only these two parameters only
            $table1 = $single_table;
            $admin_table1 = 'admin_' . $single_table;
            // old language table name
            $table2 = $table1 . '_country';
            $admin_table2 = $admin_table1 . '_country';


            //  new tables name
            $language_table = 'language_data';
            $language_country_table = 'language_data_country';


            // Admin option values
            $admin_eng = $this->comman_model->get_data_by_id($admin_table1, array('id' => '1'));
            // front option values
            $front_eng = $this->comman_model->get_data_by_id($table1, array('id' => '1'));
            unset($front_eng['id']);
            $front_lang = $this->comman_model->get_all_data_by_id($table2, array('lang_id' => 1));
            // echo "<pre>";
            // print_r($front_eng);

            foreach ($front_eng as $key => $value) {

                $lang_option_admin = ($admin_eng[$key]) ? $admin_eng[$key] : '';
                if ($table1 == "bambora_instructions") {

                    $section_name = "payment_instructions";
                } else {

                    $section_name = $table1;
                }
                $language_data = array(
                    'section_name' => $section_name,
                    'option_name' => $key,
                    'admin_option_value' => $lang_option_admin,
                    'front_option_value' => $value,
                );

                $language_row = $this->comman_model->get_data_by_id($language_table, array('section_name' => $section_name, 'option_name' => $key));
                if ($language_row) {
                    $this->comman_model->update_where($language_table, $language_data, array('id' => $language_row['id']));
                    $language_row_id = $language_row['id'];
                } else {
                    $language_row_id  =  $this->comman_model->add($language_table, $language_data);
                }

                $lang_key = "lang_" . $key;

                foreach ($front_lang as $single_lang_r) {
                    echo "<pre>";
                    $admin_val = $this->comman_model->get_data_by_id($admin_table2, array('lang_id' => '1', 'country_id' => $single_lang_r['country_id']));
                    unset($front_eng['id']);

                    $option_admin = ($admin_val[$lang_key]) ? $admin_val[$lang_key] : '';
                    $option_front = ($single_lang_r[$lang_key]) ? $single_lang_r[$lang_key] : '';

                    if (!empty($option_front) && !empty($option_front)) {
                        $language_data_country = array(
                            'language_data_id' => $language_row_id,
                            'country_id' => $single_lang_r['country_id'],
                            'lang_admin_option_value' => $option_admin,
                            'lang_front_option_value' => $option_front,
                        );

                        $language_data_country_row = $this->comman_model->get_data_by_id($language_country_table, array('language_data_id' => $language_row_id, 'country_id' => $single_lang_r['country_id']));

                        if ($language_data_country_row) {
                            $this->comman_model->update_where($language_country_table, $language_data_country, array('language_data_id' => $language_row_id, 'country_id' => $single_lang_r['country_id']));
                            $lang_count_row_id = $language_data_country_row['id'];
                        } else {
                            $lang_count_row_id  =  $this->comman_model->add($language_country_table, $language_data_country);
                        }
                    }
                }
            }

            echo "Data imported For Section = " . $single_table . "<br>";
        }
    }


    /**
     * Method import_language_diff
     * This Function is used for one time activity.
     * @return void
     */
    function import_language_diff()
    {

        $full_tables = array('entry_door_message', 'selection_instruction');


        foreach ($full_tables as $single_table) {
            // change only these two parameters only
            $table1 = $single_table;
            $admin_table1 = 'admin_' . $single_table;
            // old language table name
            $table2 = $table1 . '_country';
            $admin_table2 = $admin_table1 . '_country';


            //  new tables name
            $language_table = 'language_data';
            $language_country_table = 'language_data_country';


            // Admin option values
            $admin_eng = $this->comman_model->get_data_by_id($table1, array('id' => '1'));
            unset($admin_eng['id']);


            // front option values
            $front_eng = $this->comman_model->get_data_by_id($admin_table1, array('id' => '1'));
            unset($front_eng['id']);
            $front_lang = $this->comman_model->get_all_data_by_id($admin_table2, array('lang_id' => 1));
            // echo "<pre>";
            // print_r($front_eng);

            foreach ($front_eng as $key => $value) {


                if (isset($admin_eng[$key])) {

                    $lang_option_admin = $admin_eng[$key];
                } else {
                    $lang_option_admin = "";
                }

                $language_data = array(
                    'section_name' => $table1,
                    'option_name' => $key,
                    'admin_option_value' => $value,
                    'front_option_value' => $lang_option_admin,
                );



                $language_row = $this->comman_model->get_data_by_id($language_table, array('section_name' => $table1, 'option_name' => $key));
                if ($language_row) {
                    $this->comman_model->update_where($language_table, $language_data, array('id' => $language_row['id']));
                    $language_row_id = $language_row['id'];
                } else {
                    $language_row_id  =  $this->comman_model->add($language_table, $language_data);
                }

                $lang_key = "lang_" . $key;

                foreach ($front_lang as $single_lang_r) {
                    echo "<pre>";
                    $admin_val = $this->comman_model->get_data_by_id($table2, array('lang_id' => '1', 'country_id' => $single_lang_r['country_id']));


                    if (isset($admin_val[$lang_key])) {

                        $option_front = $admin_val[$lang_key];
                    } else {
                        $option_front = "";
                    }
                    $option_admin  = ($single_lang_r[$lang_key]) ? $single_lang_r[$lang_key] : '';

                    if (!empty($option_front) && !empty($option_front)) {
                        $language_data_country = array(
                            'language_data_id' => $language_row_id,
                            'country_id' => $single_lang_r['country_id'],
                            'lang_admin_option_value' => $option_admin,
                            'lang_front_option_value' => $option_front,
                        );


                        $language_data_country_row = $this->comman_model->get_data_by_id($language_country_table, array('language_data_id' => $language_row_id, 'country_id' => $single_lang_r['country_id']));

                        if ($language_data_country_row) {
                            $this->comman_model->update_where($language_country_table, $language_data_country, array('language_data_id' => $language_row_id, 'country_id' => $single_lang_r['country_id']));
                            $lang_count_row_id = $language_data_country_row['id'];
                        } else {
                            $lang_count_row_id  =  $this->comman_model->add($language_country_table, $language_data_country);
                        }
                    }
                }
            }

            echo "Data imported For Section = " . $single_table . "<br>";
        }
    }

    /**
     * Method import_admin_data
     * This Function is used for one time activity.
     * @return void
     */
    function import_admin_data()
    {

        $admin_tables = array('admin_admin_roles', 'admin_admin_users', 'admin_api_instruction', 'admin_banner_images', 'admin_blocks_list', 'admin_block_users', 'admin_admin_door_timer', 'admin_edit_welcomepage', 'admin_menu', 'admin_sales_order_preview', 'admin_setting', 'admin_sidebar', 'admin_social_media', 'admin_tax_rate', 'admin_tbl_product_items', 'admin_tbl_product_natures', 'admin_users_front_entry_door', 'admin_whats_new', 'bambora_instructions', 'admin_cart_timer', 'admin_order_details', 'admin_pages', 'admin_payment_accept_card', 'admin_navigation_pages', 'admin_package', 'admin_front_entry_door_verification', 'admin_importdata', 'admin_role_page', 'admin_page_title', 'admin_country', 'admin_front_user_block_list');

        foreach ($admin_tables as $single_table) {
            // change only these single parameters only
            $table1 = $single_table;
            if ($table1 == 'admin_country') {
                $table2 = 'admin_country_lang';
            } else {
                $table2 = $table1 . '_country';
            }

            //  new tables name
            $language_table = 'language_data';
            $language_country_table = 'language_data_country';


            // front option values
            $front_eng = $this->comman_model->get_data_by_id($table1, array('id' => '1'));
            unset($front_eng['id']);
            $front_lang = $this->comman_model->get_all_data_by_id($table2, array('lang_id' => 1));
            // echo "<pre>";
            // print_r($front_eng);

            foreach ($front_eng as $key => $value) {


                $language_data = array(
                    'section_name' => $table1,
                    'option_name' => $key,
                    'admin_option_value' => $value,
                    'front_option_value' => "",
                );

                $language_row = $this->comman_model->get_data_by_id($language_table, array('section_name' => $table1, 'option_name' => $key));
                if ($language_row) {
                    $this->comman_model->update_where($language_table, $language_data, array('id' => $language_row['id']));
                    $language_row_id = $language_row['id'];
                } else {
                    $language_row_id  =  $this->comman_model->add($language_table, $language_data);
                }

                $lang_key = "lang_" . $key;

                foreach ($front_lang as $single_lang_r) {
                    echo "<pre>";
                    unset($front_eng['id']);


                    $option_front = ($single_lang_r[$lang_key]) ? $single_lang_r[$lang_key] : '';

                    if (!empty($option_front)) {
                        $language_data_country = array(
                            'language_data_id' => $language_row_id,
                            'country_id' => $single_lang_r['country_id'],
                            'lang_admin_option_value' => $option_front,
                            'lang_front_option_value' => "",
                        );

                        $language_data_country_row = $this->comman_model->get_data_by_id($language_country_table, array('language_data_id' => $language_row_id, 'country_id' => $single_lang_r['country_id']));

                        if ($language_data_country_row) {
                            $this->comman_model->update_where($language_country_table, $language_data_country, array('language_data_id' => $language_row_id, 'country_id' => $single_lang_r['country_id']));
                            $lang_count_row_id = $language_data_country_row['id'];
                        } else {
                            $lang_count_row_id  =  $this->comman_model->add($language_country_table, $language_data_country);
                        }
                    }
                }
            }

            echo "Data imported For Section = " . $single_table . "<br>";
        }
    }


    /**
     * Method delete_unsed_tables
     * This Function is used for one time activity
     * @return void
     */
    function delete_unsed_tables()
    {

        $admin_tables = array('admin_admin_roles', 'admin_admin_users', 'admin_api_instruction', 'admin_banner_images', 'admin_blocks_list', 'admin_block_users', 'admin_admin_door_timer', 'admin_edit_welcomepage', 'admin_menu', 'admin_sales_order_preview', 'admin_selection_instruction', 'admin_setting', 'admin_sidebar', 'admin_social_media', 'admin_tax_rate', 'admin_tbl_product_items', 'admin_tbl_product_natures', 'admin_users_front_entry_door', 'admin_whats_new', 'bambora_instructions', 'admin_cart_timer', 'admin_order_details', 'admin_pages', 'admin_payment_accept_card', 'admin_navigation_pages', 'admin_package', 'admin_front_entry_door_verification', 'admin_importdata', 'admin_role_page', 'admin_front_user_block_list', 'paymee_api_setting', 'stripe_api_setting', 'payment_api_settings', 'tbl_products', 'admin_countries', 'menu');

        foreach ($admin_tables as $single) {
            // change only these single parameters only
            $f_table1 = $single;
            $f_table2 = $f_table1 . '_country';
            if ($single == 'admin_countries') {
                $f_table2 = 'admin_countries_lang';
            }

            if ($this->db->table_exists($f_table1)) {
                $query1 = $this->db->query('DROP TABLE ' . $f_table1 . '; ');

                echo "Table Deleted = " . $f_table1 . "<br>";
            }

            if ($this->db->table_exists($f_table2)) {
                $query2 = $this->db->query('DROP TABLE ' . $f_table2 . '; ');

                echo "Table Deleted = " . $f_table2 . "<br>";
            }
        }


        $full_tables = array('page_title', 'admin_title', 'general_instruction', 'product_instruction', 'cart_instruction', 'form_validation_instruction', 'sales_order_preview', 'admin_static_links', 'admin_products', 'api_instruction', 'email_instruction', 'entry_door_timer', 'selection_instruction', 'entry_door_message', 'bambora_instructions', 'cart_timer', 'admin_door_timer');


        foreach ($full_tables as $single_table) {
            // change only these two parameters only
            $table1 = $single_table;
            $admin_table1 = 'admin_' . $single_table;
            // old language table name
            $table2 = $table1 . '_country';
            $admin_table2 = $admin_table1 . '_country';

            if ($this->db->table_exists($table1)) {
                $query1 = $this->db->query('DROP TABLE ' . $table1 . '; ');

                echo "Table Deleted = " . $table1 . "<br>";
            }

            if ($this->db->table_exists($admin_table1)) {
                $query2 = $this->db->query('DROP TABLE ' . $admin_table1 . '; ');

                echo "Table Deleted = " . $admin_table1 . "<br>";
            }

            if ($this->db->table_exists($table2)) {
                $query3 = $this->db->query('DROP TABLE ' . $table2 . '; ');

                echo "Table Deleted = " . $table2 . "<br>";
            }

            if ($this->db->table_exists($admin_table2)) {
                $query4 = $this->db->query('DROP TABLE ' . $admin_table2 . '; ');

                echo "Table Deleted = " . $admin_table2 . "<br>";
            }
        }
    }






   
    /**
     * Method check_dynamic_language_data
     * This Function is used for one time activity.
     * @return void
     */
    public function check_dynamic_language_data()
    {



        $this->db->select('group_concat(id) as id');
        $this->db->where('status', 1);
        $this->db->where('id !=', 13);
        $result = $this->db->get('country')->row_array();
        $countries = (isset($result['id']) && $result['id']) ? explode(',', $result['id']) : array();
        $total = count($countries);
        $getfile  = file_get_contents('vendor/admin_all_language_status.json');
        $jsonData = json_decode($getfile, true);

        // $query2 = "";
        // $section_array = $this->db->query($query2)->result_array();


        $dynamic_tables = array("home_page", "pages", "tbl_vehicle_categories", "tbl_product_items", "tbl_product_natures", "tbl_product_types", "bambora_errors", "banner_images", "menu", "navigation_pages", "package", "payment_accept_card", "social_media", "tbl_makers", "tbl_models", "tbl_product_category_maker_model_relation", "admin_state", "admin_state", "admin_bambora_errors", "admin_roles", "admin_stripe_errors", "admin_ups_errors", "admin_ups_service_code_description", "admin_user_country_blocked", "front_entry_door_verification", "sales_order_section_fields", "sales_order_section_values", "time_digits", "ups_errors", "ups_service_code_description", "whats_new", "stripe_errors");


        foreach ($dynamic_tables as $singletable) {

            $table = $singletable;
            $table_country = $singletable . "_country";
            $columns_array = $this->db->get($table_country)->row_array();
            $columns_list = array_slice(array_keys($columns_array), 2);
            $this->db->select('id');
            $single_table_rows =  $this->db->get($singletable)->result_array();
            foreach ($single_table_rows as $single_row) {

                $languageId =  $single_row['id'];


                foreach ($columns_list as $single_colum) {

                    $field = $single_colum;

                    $this->db->select('lang_id');
                    $this->db->where('lang_id', $languageId);
                    $this->db->where_in('country_id', $countries);
                    $this->db->where($field . ' !=', '');
                    $exist = $this->db->get($table_country)->num_rows();
                    $status = 0;
                    if ($total == $exist) {
                        $status = 1;
                    }

                    $conditionData = array('lang_id' => $languageId, 'table' => $table_country, 'field' => $field);

                    $this->db->select('id');
                    $this->db->where($conditionData);
                    $status_check = $this->db->get('admin_all_language_status')->num_rows();
                    if ($status_check == 0) {
                        $conditionData['status'] = $status;
                        $this->db->insert('admin_all_language_status', $conditionData);
                    } else {
                        $this->db->where($conditionData);
                        $this->db->update('admin_all_language_status', array('status' => $status));
                    }

                    $jsonData[$languageId . '-' . $table_country . '-' . $field] = $status;
                }
            }
        }





        file_put_contents("vendor/admin_all_language_status.json", json_encode($jsonData));
    }


    /**
     * Method check_dynamic_language_data
     * This Function is used for one time activity.
     * @return void
     */
    public function language_diff_data()
    {



        $this->db->select('group_concat(id) as id');
        $this->db->where('status', 1);
        $this->db->where('id !=', 13);
        $result = $this->db->get('country')->row_array();
        $countries = (isset($result['id']) && $result['id']) ? explode(',', $result['id']) : array();
        $total = count($countries);
        $getfile  = file_get_contents('vendor/admin_all_language_status.json');
        $jsonData = json_decode($getfile, true);

        // $query2 = "";
        // $section_array = $this->db->query($query2)->result_array();


        $dynamic_tables = array("admin_countries", "admin_country", "countries");


        foreach ($dynamic_tables as $singletable) {

            $table = $singletable;
            $table_country = $singletable . "_lang";
            $columns_array = $this->db->get($table_country)->row_array();
            $columns_list = array_slice(array_keys($columns_array), 2);
            $this->db->select('id');
            $single_table_rows =  $this->db->get($singletable)->result_array();
            foreach ($single_table_rows as $single_row) {

                $languageId =  $single_row['id'];


                foreach ($columns_list as $single_colum) {

                    $field = $single_colum;

                    $this->db->select('lang_id');
                    $this->db->where('lang_id', $languageId);
                    $this->db->where_in('country_id', $countries);
                    $this->db->where($field . ' !=', '');
                    $exist = $this->db->get($table_country)->num_rows();
                    $status = 0;
                    if ($total == $exist) {
                        $status = 1;
                    }

                    $conditionData = array('lang_id' => $languageId, 'table' => $table_country, 'field' => $field);

                    $this->db->select('id');
                    $this->db->where($conditionData);
                    $status_check = $this->db->get('admin_all_language_status')->num_rows();
                    if ($status_check == 0) {
                        $conditionData['status'] = $status;
                        $this->db->insert('admin_all_language_status', $conditionData);
                    } else {
                        $this->db->where($conditionData);
                        $this->db->update('admin_all_language_status', array('status' => $status));
                    }

                    $jsonData[$languageId . '-' . $table_country . '-' . $field] = $status;
                }
            }
        }



        file_put_contents("vendor/admin_all_language_status.json", json_encode($jsonData));
    }
}
