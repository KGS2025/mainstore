<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Package
 * Package Class handle all methods  related to Package  like list, add , edit , delete.
 */
class Package extends CI_Controller
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
        $this->load->model(array('comman_model', 'package_model', 'product_model'));
        $this->load->library("pagination");
        $this->load->helper('assets');
        validateAdminLogin();
        validateUser();
    }

    /**
     * Method index
     * This function list all packages. 
     * @return void
     */
    function index()
    {
        //echo __FILE__;exit;
        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('package');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteAll')) {
            // this function delete all records from package table.
            $this->comman_model->deleteAllDataWithLang('package');
        }

        if ($this->input->post('DeleteSelected')) {
            // this function delete  records from package table as per the selected ids.
            $packageIds = $this->security->xss_clean($this->input->post('deleteitem'));
            $this->comman_model->deleteAllById('package', $packageIds);
        }

        $key = '';

        $config['base_url']         = base_url() . "admin/" . $this->lang->default_lang . "/package/index/";
        $config['total_rows']       = $this->comman_model->record_count('package');
        $config['per_page']         = 10;
        $config['uri_segment']      = 5;
        $config['num_links']        = 10;
        $config['first_link']       = '<< First';
        $config['last_link']        = 'Last >>';
        $config['next_link']        = 'Next ' . '&gt;';
        $config['prev_link']        = '&lt;' . ' Previous';
        $config['num_tag_open']     = '<span class="number">';
        $config['num_tag_close']    = '</span>';
        $config['cur_tag_open']     = '<span class="current"><a href="#">';
        $config['cur_tag_close']    = '</a></span>';

        $this->pagination->initialize($config);

        $offset     = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_package', 'cart_instruction'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('package_block', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'package',
            'addscripts'            => 'package',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->package_model->search_package_data('package', $key, 'packagename', $config['per_page'], $offset, $this->lang->default_lang_id),
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'cart_instruction'    => $all_language_data['cart_instruction'],
            'admin_package'         => $all_language_data['admin_package']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/package/package_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method delete_package
     *  This Function delete single package as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the package id. ]
     *
     * @return void
     */
    function delete_package($id)
    {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('package');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        $this->comman_model->delete_where('package ', array('id' => $id));

        // this function update products table after delete the package
        $this->product_model->update_product_on_delete_package($id);

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/package');
    }

    /**
     * Method add_package
     * This Function Display Add package form and save the new package in the database.
     * @return void
     */
    function add_package()
    {

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('package');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form

            // this array is intialized to save in the database
            $post_data = array(
                'packagename'   => trim($this->input->post('packagename')),
                'package_code'   => trim($this->input->post('package_code')),
                'emptyweight'   => trim($this->input->post('emptyweight')),
                'innerwidth'    => trim($this->input->post('innerwidth')),
                'innerlength'   => trim($this->input->post('innerlength')),
                'innerdepth'    => trim($this->input->post('innerdepth')),
                'maxweight'     => trim($this->input->post('maxweight'))
            );

            $length = trim($this->input->post('innerlength'));
            $grith = 2 * trim($this->input->post('innerwidth')) + 2 * trim($this->input->post('innerdepth'));
            $contraint_length = $length + $grith;
            $volume_unit =  $this->config->item('volume_unit');
            $weight_unit = $this->config->item('weight_unit');

            $package_type ="package";

            // if($weight_unit =="LB" && trim($this->input->post('maxweight')) > 149){

            // $package_type ="package";
            // } else if($weight_unit =="KG" && trim($this->input->post('maxweight')) > 67){

            // $package_type ="package";
            // } else if($volume_unit =="INCH" && $contraint_length > 159){

            // $package_type ="package";
            // } else if($volume_unit =="CM" && $contraint_length > 405){

            // $package_type ="package";
            // }

            $post_data['package_type'] = $package_type;
           
            $post_data = $this->security->xss_clean($post_data);
            // this function add  record in the database.
            $this->comman_model->add('package', $post_data);

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/package');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_package'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('package_block', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'package',
            'addscripts'            => 'add_package',
            'sub_menu'              => 'add_package',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_package'         => $all_language_data['admin_package']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/package/package_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method edit_package
     * This Function Display edit package form and update  package in the database as per the package id.
     * @param $id $id [This Parameter is the package id. ]
     *
     * @return void
     */
    function edit_package($id = false)
    {
        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/package');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('package');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form

            // this array is intialized to save in the database
            $post_data = array(
                'packagename'   => trim($this->input->post('packagename')),
                'package_code'   => trim($this->input->post('package_code')),
                'emptyweight'   => trim($this->input->post('emptyweight')),
                'innerwidth'    => trim($this->input->post('innerwidth')),
                'innerlength'   => trim($this->input->post('innerlength')),
                'innerdepth'    => trim($this->input->post('innerdepth')),
                'maxweight'     => trim($this->input->post('maxweight'))
            );

            $length = trim($this->input->post('innerlength'));
            $grith = 2 * trim($this->input->post('innerwidth')) + 2 * trim($this->input->post('innerdepth'));
            $contraint_length = $length + $grith;
            $volume_unit =  $this->config->item('volume_unit');
            $weight_unit = $this->config->item('weight_unit');

            $package_type ="package";

            if(strtoupper($weight_unit) =="LB" && trim($this->input->post('maxweight')) > 149){

            $package_type ="freight";
            } else if(strtoupper($weight_unit) =="KG" && trim($this->input->post('maxweight')) > 67){

            $package_type ="freight";
            } else if(strtoupper($volume_unit) =="INCH" && $contraint_length > 159){

            $package_type ="freight";
            } else if(strtoupper($volume_unit) =="CM" && $contraint_length > 405){

            $package_type ="freight";
            }

            $post_data['package_type'] = $package_type;

            $post_data = $this->security->xss_clean($post_data);
            // this function update record in the database.
            $this->comman_model->update_data_by_id('package', $post_data, 'id', $id);

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/package');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_package'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('package_block', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'package',
            'addscripts'            => 'edit_package',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_package'         => $all_language_data['admin_package'],
            'edit_data'             => allDataArray($this->comman_model->GetAllDataLangByid('package', 'id', $id, $this->lang->default_lang_id, 'package_country'))
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/package/package_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method checkPackageExists
     * This Function checked that is package with same name   exist in the package table or not.
     * @param $id $id [This Parameter is the package id. ]
     *
     * @return void
     */
    public function checkPackageExists($id = '')
    {
        $packagename = $this->security->xss_clean($this->input->post('packagename'));
        if ($id && $packagename) {
            $result = $this->comman_model->get_data_by_id('package', array('id' => $id));
            if ($packagename == $result['packagename']) {
                echo json_encode(TRUE);
            } else {
                // this function check is record exist in the table with same name or not.
                $exists = $this->comman_model->check_row_exists('package', array('packagename' => $packagename));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        } else if ($packagename) {
            // this function check is record exist in the table with same name or not.
            $exists = $this->comman_model->check_row_exists('package', array('packagename' => $packagename));
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
     * Method checkPackageNumberExists
     * This Function checked that is package with same number   exist in the package table or not.
     * @param $id $id [This Parameter is the package id. ]
     *
     * @return void
     */
    public function checkPackageNumberExists($id = '')
    {
        $package_code = $this->security->xss_clean($this->input->post('package_code'));
        if ($id && $package_code) {
            $result = $this->comman_model->get_data_by_id('package', array('id' => $id));
            if ($package_code == $result['package_code']) {
                echo json_encode(TRUE);
            } else {
                // this function check is record exist in the table with same name or not.
                $exists = $this->comman_model->check_row_exists('package', array('package_code' => $package_code));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        } else if ($package_code) {
            // this function check is record exist in the table with same name or not.
            $exists = $this->comman_model->check_row_exists('package', array('package_code' => $package_code));
            if ($exists) {
                // if exist than this code return false
                echo json_encode(FALSE);
            } else {
                // if not  exist than this code return true
                echo json_encode(TRUE);
            }
        }
    }

    function checkProductExistByPackageId()
    {
        $packageId = $this->input->post('packageId');
        $this->db->select('group_concat(kgt_ref_number) as partNumber');
        $this->db->where('packageId', $packageId);
        $results = $this->db->get('products')->row_array();
        if (isset($results['partNumber'])) {
            echo $results['partNumber'];
        }
    }


    /**
     * Method package_download
     * This Function Download the package  data.
     * @return void
     */
    public function package_download()
    {

        $currentTime  = time();
        $fileName   = "packges" . '_' . $currentTime . '.csv';

        $all_language_data  = get_admin_lang_data(array('admin_package'), $this->lang->default_lang_id);
        $admin_package = $all_language_data['admin_package'];


        $attribute_data = $this->comman_model->all_data('package', $this->lang->default_lang_id, 'tbl_product_items_country');


        // lang_item_name $exit;
        $header = array($admin_package['packagename']['admin'], $admin_package['package_code']['admin'], $admin_package['emptyweight']['admin'], $admin_package['innerwidth']['admin'], $admin_package['innerlength']['admin'], $admin_package['innerdepth']['admin'], $admin_package['maxweight']['admin']);

        header('Content-Type: application/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $fileName . '";');
        ob_end_clean();
        $handle = fopen('php://output', 'w');
        fputcsv($handle, $header);
        foreach ($attribute_data as $value) {

            $single_row = array($value['packagename'], $value['package_code'], $value['emptyweight'], $value['innerwidth'], $value['innerlength'], $value['innerdepth'], $value['maxweight']);
            fputcsv($handle, $single_row);
        }
        fclose($handle);
        ob_flush();
        exit();
    }

    /**
     * Method index
     * This Function Display import product form. This Function just handle view only.
     * @return void
     */
    public function import()
    {
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('package');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_products', 'admin_title', 'admin_importdata'), $this->lang->default_lang_id);

        $plang      = $this->comman_model->getPrimaryLang();
        $products = $this->comman_model->get_all_data_by_id('tbl_product_category_maker_model_relation', array('status' => "1", 'maker_id !=' => ""));

        $userLangData = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('import_product_page', 'admin_title'),
            'admin_title'           => $all_language_data['admin_title'],
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'package',
            'products'              => $products,
            'sub_menu'              => 'package',
            'addscripts'            => 'add_users',
            'form_validation_instruction' => (object)$userLangData['form_validation_instruction'],
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_products'        => $all_language_data['admin_products'],
            'admin_importdata'      => $all_language_data['admin_importdata']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/package/importdata', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    /**
     * Method import_packages
     * This Function handle the action when user submit the import packages form.
     * @return void
     */
    public function import_packages()
    {

        $all_language_data  = get_admin_lang_data(array('admin_title','admin_package'), $this->lang->default_lang_id);


        $admin_package = $all_language_data['admin_package'];

        $admin_title = $all_language_data['admin_title'];

        if ($this->input->post('operation')) {
            // this code Check csv file and its extension and size and return error accordingly
            if (!empty($_FILES['importproduct_file']['name'])) {
                $product_csvfile = explode(".", $_FILES['importproduct_file']['name']);
                if ($product_csvfile[1] != "csv") {
                    $result = array('message' => $admin_title['csv_file_type']['front'], 'status' => 0);
                    echo json_encode($result);
                    exit;
                }
                if ($_FILES['importproduct_file']['size'] > 40000000) {
                    $result = array('message' => $admin_title['import_csv_size']['front'], 'status' => 0);
                    echo json_encode($result);
                    exit;
                }
            } else {
                $result = array('message' => $admin_title['csv_file_type']['front'], 'status' => 0);
                echo json_encode($result);
                exit;
            }

            // Make Folders and set variables
            $import_folder = FCPATH . '/assets/uploads/importpackage/';
            if (!file_exists($import_folder)) {
                mkdir($import_folder, 0777, true);
            }

            $product_folder_main = $import_folder . date('Y-m-d');
            if (!file_exists($product_folder_main)) {
                mkdir($product_folder_main, 0777, true);
            }


            $header = array($admin_package['packagename']['admin'], $admin_package['package_code']['admin'], $admin_package['emptyweight']['admin'], $admin_package['innerwidth']['admin'], $admin_package['innerlength']['admin'], $admin_package['innerdepth']['admin'], $admin_package['maxweight']['admin']);

            $product_csv_name = time() . "." . $product_csvfile[1];
            $product_csv_path = $product_folder_main . "/" . $product_csv_name;

            // this code upload  csv file 
            if (!move_uploaded_file($_FILES['importproduct_file']['tmp_name'],  $product_csv_path)) {
                $result = array('message' => $admin_title['csv_file_error'], 'status' => 0);
                echo json_encode($result);
                exit;
            }




            // this function check is csv file exist in the folder
            if (!file_exists($product_csv_path)) {
                // if file csv file not exist than this function return error
                $result = array('message' => $admin_title['csv_file_error']['front'], 'status' => 0);
                echo json_encode($result);
                exit;
            } else {
                // Extract zip to for images and check folder exist in the zip folder 

                // Read a CSV file
                $handle = fopen($product_csv_path, "r");
                // Optionally, you can keep the number of the line where
                // the loop its currently iterating over
                $lineNumber = 1;
                $raw_string_header = fgets($handle);
                $rowheader = str_getcsv($raw_string_header);

                while (($raw_string = fgets($handle)) !== false) {
                    // this code  Iterate every row of the file
                    $row = str_getcsv($raw_string);
                    // this code  make an associated array with combination of header and  row of the file
                    $singlerow = array_combine($rowheader, $row);



                    if ($singlerow[$admin_package['packagename']['admin']]) {

                        // this function check that is product item exsit with same name or not
                        $item_row = $this->comman_model->get_data_by_id('package', array('packagename' => trim($singlerow[$admin_package['packagename']['admin']])));


                        $item_data = array(
                            'packagename' => $singlerow[$admin_package['packagename']['admin']],
                            'package_code' => $singlerow[$admin_package['package_code']['admin']],
                            'emptyweight' => $singlerow[$admin_package['emptyweight']['admin']],
                            'innerwidth' => $singlerow[$admin_package['innerwidth']['admin']],
                            'innerlength' => $singlerow[$admin_package['innerlength']['admin']],
                            'innerdepth' => $singlerow[$admin_package['innerdepth']['admin']],
                            'maxweight' => $singlerow[$admin_package['maxweight']['admin']],
                        );

                        if ($item_row) {
                            // if item with same name exist than this code update the row 
                            $item_id = $item_row['id'];

                            $this->comman_model->update_where('package', $item_data, array('id' => $item_row['id']));
                        } else {
                            // if item with same name not exist than this code create the new record 

                            $item_id =  $this->comman_model->add('package', $item_data);
                        }
                    }
                    $lineNumber++;
                }



                // this function delete images folder after upload
                unlink($product_csv_path);

                // this function return success message in json format
                $result = array('message' => $admin_title['csv_file_success']['front'], 'status' => 1);
                echo json_encode($result);
                exit;
            }
        }
    }
}
