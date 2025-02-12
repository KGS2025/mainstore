<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Importdata
 * Importdata Class handle all function related to import and export product data using csv.
 */
class Importdata extends MY_Controller
{

    /**
     * Method __construct
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('assets', 'cart_helper', 'common_helper'));
        $this->load->model(array('comman_model', 'product_maker_model', 'product_model', 'product_items_model', 'vehicle_categories_model', 'import_model', 'package_model'));
        $this->load->helper('assets');
        $this->load->library('customlog');

        //  validateAdminLogin();
        // validateUser();
    }

    /**
     * Method index
     * This Function Display import product form. This Function just handle view only.
     * @return void
     */
    public function index($param1 = '', $param2 = 0)
    {
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('importdata');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        
        check_lang_admin();
        $keypost = trim($this->security->xss_clean($this->input->post('search')));
        $offset = 0;
        $key = '';
        $uri_segment = 5;
        if (isset($param1) && $param1 != '' && isset($param2) && $param2 != '') {
            $offset = $param2;
            $key = $param1;
            $uri_segment = 6;
        } else if (isset($param1) && $param1 != '') {
            $offset = $param1;
        } else if (isset($keypost) && $keypost != '') {
            $key = $keypost;
        }

        $config['per_page'] = 50;
        $config['num_links'] = 5;
        $config['uri_segment'] = $uri_segment;
        $config['first_link'] = '<< First';
        $config['last_link'] = 'Last >>';
        $config['next_link'] = 'Next ' . '&gt;';
        $config['prev_link'] = '&lt;' . ' Previous';

        $config['base_url'] = base_url() . "admin/" . $this->lang->default_lang . "/importdata/index/" . $key;
        $config['total_rows'] = $this->import_model->record_count();

        $this->pagination->initialize($config);

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_user_details', 'api_instruction', 'cart_instruction'), $this->lang->default_lang_id);
        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access' => $access,
            'login' => $this->session->all_userdata(),
            'title' => get_page_title('import_product_page', 'admin_title'),
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'importdata',
            'addscripts' => 'importdata',
            'primary_lang' => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data' => $this->import_model->get_all_requests($config['per_page'], $offset),
            'links' => $this->pagination->create_links(),
            'offset' => $offset,
            'search' => $key,
            'admin_validuser_data' => $this->session->userdata('admin_validuser_data'),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links' => $all_language_data['admin_static_links'],
            'admin_user_details' => $all_language_data['admin_user_details'],
            'api_instruction' => $all_language_data['api_instruction'],
            'cart_instruction' => $all_language_data['cart_instruction'],
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/import/import_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method index
     * This Function Display import product form. This Function just handle view only.
     * @return void
     */
    public function export()
    {
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('importdata');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'admin_title', 'admin_importdata'), $this->lang->default_lang_id);

        $plang = $this->comman_model->getPrimaryLang();

        $userLangData = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login' => $this->session->all_userdata(),
            'title' => get_page_title('export_product_page', 'admin_title'),
            'admin_title' => $all_language_data['admin_title'],
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'exportdata',
            'sub_menu' => 'exportdata',
            'addscripts' => 'add_users',
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'primary_lang' => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data' => $this->session->userdata('admin_validuser_data'),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links' => $all_language_data['admin_static_links'],
            'admin_products' => $all_language_data['admin_products'],
            'admin_importdata' => $all_language_data['admin_importdata'],
        );


       //print_r($pageData);
        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/import/exportdata', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method index
     * This Function Display import product form. This Function just handle view only.
     * @return void
     */
    public function import()
    {
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('importdata');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'admin_title', 'admin_importdata'), $this->lang->default_lang_id);

        $plang = $this->comman_model->getPrimaryLang();
        $products = $this->comman_model->get_all_data_by_id('products', array('status' => "1"));

        $userLangData = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login' => $this->session->all_userdata(),
            'title' => get_page_title('import_product_page', 'admin_title'),
            'admin_title' => $all_language_data['admin_title'],
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'importdata',
            'products' => $products,
            'sub_menu' => 'importdata',
            'addscripts' => 'add_users',
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'primary_lang' => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data' => $this->session->userdata('admin_validuser_data'),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links' => $all_language_data['admin_static_links'],
            'admin_products' => $all_language_data['admin_products'],
            'admin_importdata' => $all_language_data['admin_importdata'],
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/import/importdata', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    /**
     * Method import_products
     * This Function handle the action when user submit the import product form.
     * @return void
     */
    public function import_products()
    {
        // echo "Tset";die;

        $all_language_data = get_admin_lang_data(array('admin_title'), $this->lang->default_lang_id);

        $admin_title = $all_language_data['admin_title'];

        if ($this->input->post('operation')) {

            // this code executed when form submission request is received.

            // this code Check Zip file and its extension and size and return error accordingly
            if (!empty($_FILES['images_zip']['name'])) {
                $product_zipfile = explode(".", $_FILES['images_zip']['name']);
                if ($product_zipfile[1] != "zip") {
                    $result = array('message' => $admin_title['zip_only']['front'], 'status' => 0);
                    echo json_encode($result);
                    exit;
                }
                if ($_FILES['images_zip']['size'] > 150000000) {
                    $result = array('message' => $admin_title['zip_file_size']['front'], 'status' => 0);
                    echo json_encode($result);
                    exit;
                }
            }

            // this code Check csv file and its extension and size and return error accordingly
            if (!empty($_FILES['importproduct_file']['name'])) {
                $product_csvfile = explode(".", $_FILES['importproduct_file']['name']);
                if ($product_csvfile[1] != "csv") {
                    $result = array('message' => $admin_title['csv_file_type']['front'], 'status' => 0);
                    echo json_encode($result);
                    exit;
                }
                if ($_FILES['importproduct_file']['size'] > 150000000) {
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
            $import_folder = FCPATH . '/assets/uploads/importproduct/';
            if (!file_exists($import_folder)) {
                mkdir($import_folder, 0777, true);
            }
            // Create folder for csv product file to upload
            $product_folder = $import_folder . 'productdata/';
            if (!file_exists($product_folder)) {
                mkdir($product_folder, 0777, true);
            }

            $product_folder_main = $product_folder . date('Y-m-d');
            if (!file_exists($product_folder_main)) {
                mkdir($product_folder_main, 0777, true);
            }

            $product_csv_name = time() . "." . $product_csvfile[1];
            $product_csv_path = $product_folder_main . "/" . $product_csv_name;

            if (!empty($_FILES['images_zip']['name'])) {
                $product_zip_name = time() . "." . $product_zipfile[1];
                $product_zip_path = $product_folder_main . "/" . $product_zip_name;
            } else {
                $product_zip_name = "";
                $product_zip_path = "";
            }
            // this code upload  csv file
            if (!move_uploaded_file($_FILES['importproduct_file']['tmp_name'], $product_csv_path)) {
                $result = array('message' => $admin_title['csv_file_error'], 'status' => 0);
                echo json_encode($result);
                exit;
            }

            if (!empty($_FILES['images_zip']['name'])) {
                // this code upload  zip  file
                if (!move_uploaded_file($_FILES['images_zip']['tmp_name'], $product_zip_path)) {
                    $result = array('message' => $admin_title['csv_file_error']['front'], 'status' => 0);
                    echo json_encode($result);
                    exit;
                }
            }

            // this function check is csv file exist in the folder
            if (!file_exists($product_csv_path)) {
                // if file csv file not exist than this function return error
                $result = array('message' => $admin_title['csv_file_error']['front'], 'status' => 0);
                echo json_encode($result);
                exit;
            } else {

                if (!empty($_FILES['images_zip']['name'])) {
                    // Extract zip to for images and check folder exist in the zip folder
                    $zip = new ZipArchive;
                    $res = $zip->open($product_zip_path);
                    if ($res === true) {
                        $zip->extractTo($product_folder_main);
                        $zip->close();
                    } else {
                        // if zip is not extracted than this function return error
                        $result = array('message' => $admin_title['csv_file_error']['front'], 'status' => 0);
                        echo json_encode($result);
                        exit;
                    }

                    $images_folder = $product_folder_main . "/images";
                    $images_folder_zip = $product_folder_main . "/" . $product_zipfile[0] . "/images";
                    if (file_exists($images_folder)) {
                        // if images folder in the zip is not exist than function return error.
                        $product_folder_images = $images_folder;
                    } else if (file_exists($images_folder_zip)) {
                        // if images folder in the zip is not exist than function return error.
                        $product_folder_images = $images_folder_zip;
                    } else {
                        // if images folder in the zip is not exist than function return error.
                        $product_folder_images = $images_folder_zip;
                    }

                    if (!file_exists($product_folder_images)) {
                        // if images folder in the zip is not exist than function return error.
                        $result = array('message' => $admin_title['zip_file_folder']['front'], 'status' => 0);
                        echo json_encode($result);
                        exit;
                    }
                    // Extract zip process is done

                } else {
                    $product_zip_name = "";
                }

                $request_data = array();
                $request_data["zip_real_name"] = $product_zipfile[0];
                $request_data["zip_file"] = $product_zip_name;
                $request_data["csv_file"] = $product_csv_name;
                $request_data["status"] = "0";
                $request_data["lang_id"] = $this->lang->default_lang_id;
                // this function delete zip file  after upload
                $request_id = $this->comman_model->add("import_requests", $request_data);

                if ($request_id) {
                    // this code executed when csv data is uploaded successfully
                    // this function delete images folder after upload
                    $this->deleteDir($product_folder_images);

                    // this function return success message in json format
                    $result = array('message' => $admin_title['csv_file_success']['front'], 'status' => 1);
                    echo json_encode($result);
                    exit;
                } else {
                    // this function return error message in json format when csv data is not uploaded successfully
                    $result = array('message' => $admin_title['csv_file_error']['front'], 'status' => 0);
                    echo json_encode($result);
                    exit;
                }
            }
        } else {
            // this function return error message in json format
            $result = array('message' => $admin_title['csv_file_error']['front'], 'status' => 0);
            echo json_encode($result);
            exit;
        }
    }

    /**
     * Method download_zip
     * This Function make zip file for the product images.
     * @return void
     */
    public function download_zip()
    {

        $folder_path = FCPATH . '/assets/uploads/importdata/' . date('Y-m-d') . "/downloadzip";
        // this code check the directory for cart data if exist or not
        $file_name = 'download_' . time() . '_.zip';
        $zip_file = FCPATH . '/assets/uploads/importdata/productdata/' . $file_name;
        $zip = new ZipArchive;

        //create the file and throw the error if unsuccessful
        if ($zip->open($zip_file, ZIPARCHIVE::CREATE) !== true) {
            exit("cannot open " . $zip_file . "\n");
        }

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($folder_path),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            // Skip directories (they would be added automatically)
            if (!$file->isDir()) {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($folder_path) + 0);
                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();
        //then send the headers to force download the zip file
        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Pragma: no-cache");
        header("Expires: 0");
        readfile("$zip_file");
        exit;
    }
    /**
     * Method import_csv_data
     * This Function read csv row one by one and save in the database.
     * @param $importfilePath $importfilePath [ This parameter is the csv file path.]
     * @param $product_folder_images $product_folder_images [ This parameter is the images folder path.]
     *
     * @return void
     */
    public function import_csv_data($importfilePath, $product_folder_images, $request_id, $log_file)
    {
        $all_language_data = get_admin_lang_data(array('cart_instruction', 'admin_products', 'admin_title', 'admin_importdata'), $this->lang->default_lang_id);
        $cart_instruction = $all_language_data['cart_instruction'];
        $categories = array();
        $models = array();
        $makers = array();
        $product_types = array();
        $product_nature_types = array();
        $recordcreated = 0;
        $model_list_array = array();
        $lineNumber = 1;
        $verified_product = array();
        $parent_update = array();
        $product_number = array();
        $industries = array();
        $attributes = $this->product_model->makes_attributes_column();
        $storewise_qty = $this->product_model->makes_storewise_qty_column();
        //print_r($storewise_qty);exit;

        $items_name_main = $attributes['items_name'];

        $field_types = $attributes['field_types'];
        $items_field = $attributes['items_field'];
        $items_count_field = $attributes['items_count_field'];
        if (!file_exists($importfilePath)) {
            // if csv file is not exist than this function return error
            $responce = array('recordscreated' => $recordcreated, "rowsiterated" => $lineNumber, 'status' => 0);
            return $responce;
        }
        $country_data = $this->comman_model->get_data_by_id('country', array('id' => $this->lang->default_lang_id));
        // this code get data from database to find  the column name of csv
        $admin_products = $all_language_data['admin_products'];
        // these variable are intialize to use in the function
        $part_lang_column = $country_data['name'] . "_" . $admin_products['part_name']['front'];
        $cat_lang_column = $country_data['name'] . "_" . $admin_products['category_name']['front'];
        $maker_lang_column = $country_data['name'] . "_" . $admin_products['product_maker_name']['front'];
      echo   $model_lang_column = $country_data['name'] . "_" . $admin_products['product_model_name']['front'];
        $shipping_lang_column = $country_data['name'] . "_" . $admin_products['shipping_special_notes']['front'];
        $unit_lang_column = $country_data['name'] . "_" . $admin_products['unit_of_measurement']['front'];
        $nature_lang_column = $country_data['name'] . "_" . $admin_products['item_nature']['front'];
        $ptype_lang_column = $country_data['name'] . "_" . $admin_products['product_type_title']['front'];
        $industry_lang_name = $country_data['name'] . "_" . $admin_products['industry_name']['front'];
        $industry_lang_description = $country_data['name'] . "_" . $admin_products['industry_description']['front'];

        // Read uploaded CSV file
        $handle = fopen($importfilePath, "r");
        // Optionally, you can keep the number of the line where
        // the loop its currently iterating over
        $raw_string_header = fgets($handle);
        $rowheader = str_getcsv($raw_string_header);
        // echo "<pre>";print_r($raw_string_header);
        // echo "<pre>";
        // print_r($admin_products);
        while (($raw_string = fgets($handle)) !== false) {
            // this loop Iterate  every row of the csv file
            $row = str_getcsv($raw_string);
            // echo "<pre>abc";print_r($row);
            // combine row column with header to define key for each row element
            $singlerow = array();
            foreach ($rowheader as $index => $key) {
                $singlerow[$key] = isset($row[$index]) ? $row[$index] : null;
            }

            // echo "<pre>";print_r($rowheader['46']['0']);die;
            //  echo "<pre>";
            //  print_r($singlerow);
            //  exit;

            //  print_r($admin_products);
            // echo $singlerow[$admin_products['upload_photo']['front']];
            //  exit;
            //  This code check industry add if its already in the array than ignore it else this code add industry in the database

            if ($singlerow[$admin_products['industry_name']['front']]) {
                $industry_col = $this->clean($singlerow[$admin_products['industry_name']['front']]);
                if (array_key_exists($industry_col, $industries)) {
                    $industry_id = $industries[$industry_col];
                } else {
                    $industry_row = $this->comman_model->get_data_by_id('industries', array('name' => $industry_col));

                    $industry_folder = FCPATH . '/assets/uploads/industries/';
                    if ($this->do_resize_import_data_image($product_folder_images, $industry_folder, $singlerow[$admin_products['industry_icon']['front']])) {
                        $industry_photo = $singlerow[$admin_products['industry_icon']['front']];
                    } elseif (!empty($industry_row) && !empty($industry_row["icon"])) {
                        $industry_photo = ($industry_row["icon"]) ? $industry_row["icon"] : "";
                    } else {
                        $industry_photo = $singlerow[$admin_products['industry_icon']['front']];
                    }

                    $industry_data = array(
                        'name' => $singlerow[$admin_products['industry_name']['front']],
                        'description' => $singlerow[$admin_products['industry_description']['front']],
                        'icon' => $industry_photo,
                        'status' => !empty($singlerow[$admin_products['industry_status']['front']]) ? $singlerow[$admin_products['industry_status']['front']] : '1',
                    );

                    if ($industry_row) {
                        $industry_id = $industry_row['id'];
                        $this->comman_model->update_where('industries', $industry_data, array('id' => $industry_row['id']));
                    } else {
                        $industry_id = $this->comman_model->add('industries', $industry_data);
                    }

                    if ($this->lang->default_lang_id != 13) {

                        if (trim($singlerow[$industry_lang_name])) {

                            //print_r($singlerow[$item_lang_column]);
                            $indus_lang_row = $this->comman_model->get_data_by_id('industries_country', array('lang_id' => $industry_id, 'country_id' => $this->lang->default_lang_id));

                            if ($indus_lang_row) {

                                $this->comman_model->update_where('industries_country', array('lang_name' => $singlerow[$industry_lang_name], 'lang_description' => $singlerow[$industry_lang_description]), array('lang_id' => $industry_id, 'country_id' => $this->lang->default_lang_id));
                            } else {

                                $this->comman_model->add('industries_country', array('lang_name' => $singlerow[$industry_lang_name], 'lang_description' => $singlerow[$industry_lang_description], 'lang_id' => $industry_id, 'country_id' => $this->lang->default_lang_id));
                            }
                        }
                    }
                    $industries[$industry_col] = $industry_id;
                }
            }
            //  This code check product category add if its already in the array than ignore it else this code add category in the database
            if ($singlerow[$admin_products['category_name']['front']]) {
                $vehicle_category_col = $this->clean($singlerow[$admin_products['category_name']['front']]);
                if (array_key_exists($vehicle_category_col, $categories)) {
                    $category_id = $categories[$vehicle_category_col];
                } else {
                    $category_row = $this->comman_model->get_data_by_id('tbl_vehicle_categories', array('category_name' => $vehicle_category_col));

                    $product_cat_folder = FCPATH . '/assets/uploads/vehicle_categories/';
                    if ($this->do_resize_import_data_image($product_folder_images, $product_cat_folder, $singlerow[$admin_products['vehicle_photo']['front']])) {
                        $cat_photo = $singlerow[$admin_products['vehicle_photo']['front']];
                    } else {
                        $cat_photo = ($category_row["VehicleType_Photo"]) ? $category_row["VehicleType_Photo"] : "";
                    }

                    $category_data = array(
                        'category_name' => $vehicle_category_col,
                        'VehicleType_Photo' => $cat_photo,
                        'vehicle_category_icon' => $cat_photo,
                        'vehicle_category_icon' => $cat_photo,
                        'menu_image' => $cat_photo,
                        'status' => "1",
                    );

                    if (!empty($industry_id)) {

                        $category_data['industries'] = $industry_id;
                    }

                    if ($category_row) {
                        $category_id = $category_row['id'];
                        $this->comman_model->update_where('tbl_vehicle_categories', $category_data, array('id' => $category_row['id']));
                    } else {
                        $category_id = $this->comman_model->add('tbl_vehicle_categories', $category_data);
                    }

                    if ($this->lang->default_lang_id != 13) {
                        if (trim($singlerow[$cat_lang_column])) {

                            //print_r($singlerow[$item_lang_column]);
                            $catg_lang_row = $this->comman_model->get_data_by_id('tbl_vehicle_categories_country', array('lang_id' => $category_id, 'country_id' => $this->lang->default_lang_id));

                            if ($catg_lang_row) {

                                $this->comman_model->update_where('tbl_vehicle_categories_country', array('lang_category_name' => $singlerow[$cat_lang_column]), array('lang_id' => $category_id, 'country_id' => $this->lang->default_lang_id));
                            } else {

                                $this->comman_model->add('tbl_vehicle_categories_country', array('lang_category_name' => $singlerow[$cat_lang_column], 'lang_id' => $category_id, 'country_id' => $this->lang->default_lang_id));
                            }
                        }
                    }
                    $categories[$vehicle_category_col] = $category_id;
                }
            }

            //  This code check product maker add if its already in the array than ignore it else this code add maker in the database
            if ($singlerow[$admin_products['product_maker_name']['front']]) {

                $maker_name_col = $this->clean($singlerow[$admin_products['product_maker_name']['front']]);

                $maker_row = $this->comman_model->get_data_by_id('tbl_makers', array('maker_name' => $maker_name_col));

                $maker_folder = FCPATH . '/assets/uploads/product_maker/';
                if ($this->do_resize_import_data_image($product_folder_images, $maker_folder, $singlerow[$admin_products['logo']['front']])) {
                    $maker_photo = $singlerow[$admin_products['logo']['front']];
                } else {
                    $maker_photo = ($maker_row["maker_logo"]) ? $maker_row["maker_logo"] : "";
                }

                $maker_data = array(
                    'maker_name' => $maker_name_col,
                    'maker_logo' => $maker_photo,
                    'status' => "1",
                );

                if ($maker_row) {
                    $maker_id = $maker_row['id'];

                    // Check Category
                    $maker_category_array = explode(",", $maker_row['vehicle_category_id']);
                    if (in_array($category_id, $maker_category_array)) {
                    } else {
                        array_push($maker_category_array, $category_id);
                        $maker_data['vehicle_category_id'] = implode(',', $maker_category_array);
                    }

                    $this->comman_model->update_where('tbl_makers', $maker_data, array('id' => $maker_row['id']));
                } else {
                    $maker_data['vehicle_category_id'] = $category_id;
                    $maker_id = $this->comman_model->add('tbl_makers', $maker_data);
                }
                $makers[$maker_name_col] = $maker_id;

                if ($this->lang->default_lang_id != 13) {

                    if (trim($singlerow[$maker_lang_column])) {

                        //print_r($singlerow[$item_lang_column]);
                        $maker_lang_row = $this->comman_model->get_data_by_id('tbl_makers_country', array('lang_id' => $maker_id, 'country_id' => $this->lang->default_lang_id));

                        if ($maker_lang_row) {

                            $this->comman_model->update_where('tbl_makers_country', array('lang_maker_name' => $singlerow[$maker_lang_column]), array('lang_id' => $maker_id, 'country_id' => $this->lang->default_lang_id));
                        } else {

                            $this->comman_model->add('tbl_makers_country', array('lang_maker_name' => $singlerow[$maker_lang_column], 'lang_id' => $maker_id, 'country_id' => $this->lang->default_lang_id));
                        }
                    }
                }
            }

            //  This code check product model add if its already in the array than ignore it else this code add model in the database
            if ($singlerow[$admin_products['product_model_name']['front']]) {

                // $this->customlog->write_log(date('y-m-d h:i:s') . " => linenumber " . $lineNumber . " top " . $singlerow[$admin_products['upload_photo']['front']], "log_" . $request_id);

                $mod_name = str_replace(' ', '-', strtolower(trim($singlerow[$admin_products['product_model_name']['front']])));
                $mak_name = str_replace(' ', '-', strtolower(trim($singlerow[$admin_products['product_maker_name']['front']])));

                $model_image = $singlerow[$admin_products['upload_photo']['front']];
                // $this->customlog->write_log(date('y-m-d h:i:s') . " => linenumber " . $lineNumber . " if" . $model_image, "log_" . $request_id);
                echo "Model_name".$singlerow[$admin_products['product_model_name']['front']]."<br>";
                echo "Model_name language".$singlerow[$model_lang_column]."<br>";

                $model_name_col = $this->clean($singlerow[$admin_products['product_model_name']['front']]);
                if (array_key_exists($model_name_col, $models)) {

                    $model_id = $models[$model_name_col];
                } else {
                    $model_row = $this->comman_model->get_data_by_id('tbl_models', array('model_name' => $model_name_col));
                    $model_folder = FCPATH . '/assets/uploads/product_model/';
                    if ($this->do_resize_import_data_image($product_folder_images, $model_folder, $model_image)) {
                        $model_photo = $model_image;

                        // $this->customlog->write_log(date('y-m-d h:i:s') . " => linenumber " . $lineNumber . " if" . $model_photo, "log_" . $request_id);
                    } else {
                        $model_photo = ($model_row["model_photo"]) ? $model_row["model_photo"] : "";
                        // $this->customlog->write_log(date('y-m-d h:i:s') . " => linenumber " . $lineNumber . " else  " . $model_photo, "log_" . $request_id);
                    }

                    $model_data = array(
                        'model_name' => $model_name_col,
                        'serial_number' => $model_name_col,
                        'model_photo' => $model_photo,
                        'vehicle_category_id' => $category_id,
                        'maker_id' => $maker_id,
                        'status' => "1",
                        "menu_privilages" => "1,2,167,168,169",
                        "menu_privilages_admin" => "1,2,167,168,169",
                        'created_date' => date('Y-m-d'),
                    );

                    if ($model_row) {
                        $model_id = $model_row['id'];
                        $this->comman_model->update_where('tbl_models', $model_data, array('id' => $model_row['id']));
                    } else {
                        $model_id = $this->comman_model->add('tbl_models', $model_data);
                    }
                    if ($this->lang->default_lang_id != 13) {
                        if (trim($singlerow[$model_lang_column])) {

                            //print_r($singlerow[$item_lang_column]);
                            $model_lang_row = $this->comman_model->get_data_by_id('tbl_models_country', array('lang_id' => $model_id, 'country_id' => $this->lang->default_lang_id));

                            if ($model_lang_row) {

                                $this->comman_model->update_where('tbl_models_country', array('lang_model_name' => $singlerow[$model_lang_column], 'lang_serial_number' => $singlerow[$model_lang_column]), array('lang_id' => $model_id, 'country_id' => $this->lang->default_lang_id));
                            } else {

                                $this->comman_model->add('tbl_models_country', array('lang_model_name' => $singlerow[$model_lang_column], 'lang_serial_number' => $singlerow[$model_lang_column], 'lang_id' => $model_id, 'country_id' => $this->lang->default_lang_id));
                            }
                        }
                    }

                    $models[$model_name_col] = $model_id;
                }
            }

            //  This code check product type add if its already in the array than ignore it else this code add product type in the database
            if ($singlerow[$admin_products['product_type_title']['front']]) {

                $product_type_col = $this->clean($singlerow[$admin_products['product_type_title']['front']]);
                if (array_key_exists($product_type_col, $product_types)) {

                    $product_type_id = $product_types[$product_type_col];
                } else {
                    $product_type_row = $this->comman_model->get_data_by_id('tbl_product_types', array('product_type_name' => $product_type_col));

                    $Product_Type_folder = FCPATH . '/assets/uploads/product_type_images/';
                    if ($this->do_resize_import_data_image($product_folder_images, $Product_Type_folder, $singlerow[$admin_products['product_type_photo']['front']])) {
                        $Product_Type_Photo = $singlerow[$admin_products['product_type_photo']['front']];
                    } else {
                        $Product_Type_Photo = ($product_type_row["Product_Type_Photo"]) ? $product_type_row["Product_Type_Photo"] : "";
                    }

                    $product_type_data = array(
                        'product_type_name' => $product_type_col,
                        'Product_Type_Photo' => $Product_Type_Photo,
                        "menu_privilages" => "149,166,176,177,178,179,180,181",
                        "menu_privilages_admin" => "149,166,176,177,178,179,180,181",
                        'status' => "1",
                    );

                    if ($product_type_row) {
                        $product_type_id = $product_type_row['id'];
                        $this->comman_model->update_where('tbl_product_types', $product_type_data, array('id' => $product_type_row['id']));
                    } else {

                        $product_type_id = $this->comman_model->add('tbl_product_types', $product_type_data);
                    }
                    if ($this->lang->default_lang_id != 13) {
                        if (trim($singlerow[$ptype_lang_column])) {

                            //print_r($singlerow[$item_lang_column]);
                            $ptype_lang_row = $this->comman_model->get_data_by_id('tbl_product_types_country', array('lang_id' => $product_type_id, 'country_id' => $this->lang->default_lang_id));

                            if ($ptype_lang_row) {

                                $this->comman_model->update_where('tbl_product_types_country', array('lang_product_type_name' => $singlerow[$ptype_lang_column]), array('lang_id' => $product_type_id, 'country_id' => $this->lang->default_lang_id));
                            } else {

                                $this->comman_model->add('tbl_product_types_country', array('lang_product_type_name' => $singlerow[$ptype_lang_column], 'lang_id' => $product_type_id, 'country_id' => $this->lang->default_lang_id));
                            }
                        }
                    }

                    $product_types[$product_type_col] = $product_type_id;
                }
            }
            //  This code check product nature add if its already in the array than ignore it else this code add product nature in the database
            if ($singlerow[$admin_products['item_nature']['front']]) {
                $nature_type_col = $this->clean($singlerow[$admin_products['item_nature']['front']]);

                if (array_key_exists($nature_type_col, $product_nature_types)) {

                    $nature_id = $product_nature_types[$nature_type_col];
                } else {
                    $nature_row = $this->comman_model->get_data_by_id('tbl_product_natures', array('name' => $nature_type_col));

                    if ($nature_row) {
                        $nature_id = $nature_row['id'];
                    } else {
                        $nature_data = array(
                            'name' => $nature_type_col,
                            'created' => date('Y-m-d'),

                        );

                        $nature_id = $this->comman_model->add('tbl_product_natures', $nature_data);
                    }
                    $product_nature_types[$nature_type_col] = $nature_id;
                }

                if ($this->lang->default_lang_id != 13) {

                    if (trim($singlerow[$nature_lang_column])) {

                        //print_r($singlerow[$item_lang_column]);
                        $nature_lang_row = $this->comman_model->get_data_by_id('tbl_product_natures_country', array('lang_id' => $nature_id, 'country_id' => $this->lang->default_lang_id));

                        if ($nature_lang_row) {

                            $this->comman_model->update_where('tbl_product_natures_country', array('lang_name' => $singlerow[$nature_lang_column]), array('lang_id' => $nature_id, 'country_id' => $this->lang->default_lang_id));
                        } else {

                            $this->comman_model->add('tbl_product_natures_country', array('lang_name' => $singlerow[$nature_lang_column], 'lang_id' => $nature_id, 'country_id' => $this->lang->default_lang_id));
                        }
                    }
                }
            }

            $row_validated = 0;

            if ($singlerow[$admin_products['kgt_ref_no']['front']]) {

                $product_country_col = $this->clean($singlerow[$admin_products['country_origin']['front']]);
                if($product_country_col){

                    $product_country = $this->comman_model->get_data_by_id('countries', array(
                        'countryName' =>ucfirst(strtolower($product_country_col))
                    ));
                    if($product_country['id']){
                        $product_country_id = $product_country['id'];
                    } else {
                        $product_country = $this->comman_model->get_data_by_id('countries', array(
                            'country_code' => trim($this->config->item('store_country'))
                        ));
                        $product_country_id = $product_country['id'];

                    }

                } else {
                    $product_country = $this->comman_model->get_data_by_id('countries', array(
                        'country_code' =>trim($this->config->item('store_country'))
                    ));
                    $product_country_id = $product_country['id'];


                }



                $produt_number_col = $this->clean($singlerow[$admin_products['kgt_ref_no']['front']]);
                $product_number_check = array(
                    'kgt_ref_number' => $produt_number_col,
                );

                $product_row = $this->comman_model->get_data_by_id('products', $product_number_check);

                if ($product_row) {
                    // if product with same name number exist than this code update product

                    $product_id = $product_row['id'];

                    // this function resize image and return image name
                    $product_folder = FCPATH . '/assets/uploads/product_images/';

                    if (!empty($singlerow[$admin_products['item_real_photo']['front']])) {

                        $photos_array = explode(",", $singlerow[$admin_products['item_real_photo']['front']]);
                        $real_images = [];

                        foreach ($photos_array as $real_photo) {
                            if ($this->do_resize_import_data_image($product_folder_images, $product_folder, $real_photo)) {
                                $real_images[] = $real_photo;
                            }
                        }
                        if (!empty($real_images)) {
                            $real_images = implode(",", $real_images);
                            $item_real_photo = $real_images;
                        } else {
                            $item_real_photo = ($product_row["item_real_photo"]) ? $product_row["item_real_photo"] : "";
                        }
                    } else {
                        $item_real_photo = ($product_row["item_real_photo"]) ? $product_row["item_real_photo"] : "";
                    }

                    // this function resize image and return image name
                    if ($this->do_resize_import_data_image($product_folder_images, $product_folder, $singlerow[$admin_products['item_schematic_photo']['front']])) {
                        $item_schematic_photo = $singlerow[$admin_products['item_schematic_photo']['front']];
                    } else {
                        $item_schematic_photo = ($product_row["item_schematic_photo"]) ? $product_row["item_schematic_photo"] : "";
                    }

                    // this array is Initialized to update product in the database
                    $update_array = array(
                        'kgt_ref_number' => $produt_number_col,
                        'part_name' => $singlerow[$admin_products['part_name']['front']],
                        'quantity' => $singlerow[$admin_products['quantity']['front']],
                        'min_quantity' => $singlerow[$admin_products['min_quantity']['front']],
                        'backorder_status' => 0,
                        // 'price' => $singlerow[$admin_products['price']['front']],
                        'price' => $row['32'],
                        'item_height' => $singlerow[$admin_products['item_height']['front']],
                        'item_width' => $singlerow[$admin_products['item_width']['front']],
                        'item_real_photo' => $item_real_photo,
                        'item_schematic_photo_status' => $singlerow[$admin_products['item_schematic_photo_status']['front']],
                        'item_schematic_photo' => $item_schematic_photo,
                        'item_length' => $singlerow[$admin_products['item_length']['front']],
                        'item_weight' => $singlerow[$admin_products['item_weight']['front']],
                        'item_nature_id' => $nature_id,
                        'country_id'=>$product_country_id,
                        'shipping_special_notes' => $singlerow[$admin_products['shipping_special_notes']['front']],
                        'packageId' => $singlerow[$admin_products['package_multiple']['front']],
                        'display_kondarsoft' => $singlerow[$admin_products['display_kondarsoft']['front']],
                        'template' => $singlerow[$admin_products['template']['front']],
                        "pushed_status" => "0",
                        'product_type_id' => $product_type_id,
                    );

                    $update_array['status'] = 1;
                    // Check Category in the column  else update category column

                    //   echo "<pre>";print_r($update_array);die;
                    $row_validated = $this->importValidation($update_array, $lineNumber, $request_id);
                    if ($row_validated == "1") {
                        // this function update product in the database
                        $this->comman_model->update_where('products', $update_array, array('id' => $product_row['id']));

                        if ($this->config->item('enable_distributor_feature') == "1") {
                            $this->comman_model->delete_where('product_distributors', array('product_id' => $product_row['id']));

                            $distributor_row = $singlerow[$admin_products['product_distributor']['front']];

                            if (!empty($distributor_row)) {
                                $distributor_name = explode("#", trim($distributor_row));
                                $distributor = $this->product_model->getdistributor_byname($distributor_name);

                                if (isset($distributor) && $distributor != '') {

                                    if (!empty($distributor)) {
                                        foreach ($distributor as $single_dist) {
                                            $distributor_data[] = array(
                                                'product_id' => $product_row['id'],
                                                'distributor_id' => $single_dist,
                                            );

                                        }
                                        if (count($distributor_data) > 0) {
                                            $this->db->insert_batch('product_distributors', $distributor_data);
                                        }

                                    }
                                }
                            }

                        }

                        // Update min price in the product group table.
                        $this->product_model->update_min_price($product_type_id);
                        $update_array = array('availability' => $cart_instruction['backorder_accept_msg']['front'],
                            'quantity_threshold' => $singlerow[$admin_products['quantity_threshold']['front']],
                            'availability_backorder_no' => $cart_instruction['max_availability_msg']['front'],
                            'availability_max_msg' => $singlerow[$admin_products['part_name']['front']],
                            'replenishment_order_number' => $singlerow[$admin_products['replenishment_order_number']['front']],
                            'replenishment_order_date' => $singlerow[$admin_products['replenishment_order_date']['front']],
                            'replenishing_period' => $singlerow[$admin_products['replenishing_period']['front']],
                            'replenishing_period_tolerance_range' => $singlerow[$admin_products['replenishing_period_tolerance_range']['front']],
                            'ex_stock_period' => $singlerow[$admin_products['replenishing_period']['front']] + $singlerow[$admin_products['replenishing_period_tolerance_range']['front']],
                        );
                        $this->comman_model->update_where('product_details', $update_array, array('product_id' => $product_row['id']));

                        // Update min price in the product group table.
                        $this->product_model->update_min_price($product_type_id);

                    }
                } else {

                    // if product with same  number not exist than this code create new  product

                    $product_folder = FCPATH . '/assets/uploads/product_images/';

                    if (!empty($singlerow[$admin_products['item_real_photo']['front']])) {

                        $photos_array = explode(",", $singlerow[$admin_products['item_real_photo']['front']]);
                        $real_images = [];

                        foreach ($photos_array as $real_photo) {
                            if ($this->do_resize_import_data_image($product_folder_images, $product_folder, $real_photo)) {
                                $real_images[] = $real_photo;
                            }
                        }

                        if (!empty($real_images)) {
                            $real_images = implode(",", $real_images);
                            $item_real_photo = $real_images;
                        } else {
                            $item_real_photo = "";
                        }
                    } else {
                        $item_real_photo = "";
                    }

                    // if ($this->do_resize_import_data_image($product_folder_images, $product_folder, $singlerow[$admin_products['item_real_photo']['front']])) {
                    //     $item_real_photo =  $singlerow[$admin_products['item_real_photo']['front']];
                    // } else {
                    //     $item_real_photo = "";
                    // }

                    if ($this->do_resize_import_data_image($product_folder_images, $product_folder, $singlerow[$admin_products['item_schematic_photo']['front']])) {
                        $item_schematic_photo = $singlerow[$admin_products['item_schematic_photo']['front']];
                    } else {
                        $item_schematic_photo = "";
                    }

                    // this array is Initialized to create new product in the database
                    // this array is Initialized to update product in the database
                    $product_data = array(
                        'kgt_ref_number' => $produt_number_col,
                        'part_name' => $singlerow[$admin_products['part_name']['front']],
                        'quantity' => $singlerow[$admin_products['quantity']['front']],
                        'min_quantity' => $singlerow[$admin_products['min_quantity']['front']],
                        'backorder_status' => 0,
                        // 'price' => $singlerow[$admin_products['price']['front']],
                        'price' => $row['32'],
                        'item_real_photo' => $item_real_photo,
                        'item_schematic_photo' => $item_schematic_photo,
                        'item_schematic_photo_status' => $singlerow[$admin_products['item_schematic_photo_status']['front']],
                        'shipping_special_notes' => $singlerow[$admin_products['shipping_special_notes']['front']],
                        'item_height' => $singlerow[$admin_products['item_height']['front']],
                        'item_width' => $singlerow[$admin_products['item_width']['front']],
                        'item_length' => $singlerow[$admin_products['item_length']['front']],
                        'item_weight' => $singlerow[$admin_products['item_weight']['front']],
                        'item_nature_id' => $nature_id,
                        'country_id' => $product_country_id,
                        // 'product_type_id' => '140',
                        'product_type_id' => $product_type_id,
                        'packageId' => $singlerow[$admin_products['package_multiple']['front']],
                        'display_kondarsoft' => $singlerow[$admin_products['display_kondarsoft']['front']],
                        "pushed_status" => "0",
                    );
                    $product_data['status'] = 1;
                    $product_data['created_date'] = date('Y-m-d');

                    //$add_data = json_encode($product_data);
                    $row_validated = $this->importValidation($product_data, $lineNumber, $request_id);

                    // this function create new product in the database
                    if ($row_validated == "1") {
                        $product_id = $this->comman_model->add('products', $product_data);

                        if ($product_id) {

                            if ($this->config->item('enable_distributor_feature') == "1") {
                                $distributor_row = $singlerow[$admin_products['product_distributor']['front']];
                                if (!empty($distributor_row)) {
                                    $distributor_name = explode("#", trim($distributor_row));
                                    $distributor = $this->product_model->getdistributor_byname($distributor_name);

                                    if (isset($distributor) && $distributor != '') {

                                        if (!empty($distributor)) {
                                            foreach ($distributor as $single_dist) {
                                                $distributor_data[] = array(
                                                    'product_id' => $product_id,
                                                    'distributor_id' => $single_dist,
                                                );

                                            }
                                            if (count($distributor_data) > 0) {
                                                $this->db->insert_batch('product_distributors', $distributor_data);
                                            }

                                        }
                                    }
                                }

                            }

                            // Update min price in the product group table.
                            $this->product_model->update_min_price($product_type_id);

                            //print_r($attributes['attributes']);

                            // foreach ($all_attributes as $single_att) {
                            //     if ($items_name[$single_att['item_id']]['field_type'] == "dropdown") {
                            //         $value[$items_field[$single_att['item_id']]][] = $single_att['value'];
                            //     } else {
                            //         $value[$items_field[$single_att['item_id']]] = $single_att['value'];
                            //     }
                            // }

                            // $attribus = $row['46'];
                            // $result_data_attrs = explode('#', $attribus);
                            // foreach ($result_data_attrs as $result_data_attr) {
                            //     $product_attributes_data_result = array(
                            //         'product_id' => $product_id,
                            //         'item_id' => 149,
                            //         'value' => $result_data_attr,
                            //         'status' => 1,
                            //     );
                            //     $this->comman_model->add('product_attributes', $product_attributes_data_result);
                            // }
                            // // Product Line code started
                            // $products_lines = $row['48'];
                            // $product_lines_data_result = array(
                            //     'product_id' => $product_id,
                            //     'item_id' => 166,
                            //     'value' => $products_lines,
                            //     'status' => 1,
                            // );
                            // $product_line_id = $this->comman_model->add('product_attributes', $product_lines_data_result);

                            // if ($this->lang->default_lang_id != 13) {
                            //     if (trim($singlerow[$row['49']])) {
                            //         $this->comman_model->add('product_attributes_country', array('lang_value' => $singlerow[$row['49']], 'lang_id' => $products_lines, 'country_id' => $this->lang->default_lang_id));
                            //     }
                            // }
                            // Product Line code add

                            $recordcreated++;
                            $update_product_detail_array = array(
                                'quantity_threshold' => $singlerow[$admin_products['quantity_threshold']['front']],
                                'availability' => $cart_instruction['backorder_accept_msg']['front'],
                                'availability_backorder_no' => $cart_instruction['max_availability_msg']['front'],
                                'availability_max_msg' => $singlerow[$admin_products['part_name']['front']],
                                'replenishment_order_number' => $singlerow[$admin_products['replenishment_order_number']['front']],
                                'replenishment_order_date' => $singlerow[$admin_products['replenishment_order_date']['front']],
                                'replenishing_period' => $singlerow[$admin_products['replenishing_period']['front']],
                                'replenishing_period_tolerance_range' => $singlerow[$admin_products['replenishing_period_tolerance_range']['front']],
                                'ex_stock_period' => $singlerow[$admin_products['replenishing_period']['front']] + $singlerow[$admin_products['replenishing_period_tolerance_range']['front']],
                            );
                            $update_product_detail_array['created_date'] = date('Y-m-d');
                            $update_product_detail_array['product_id'] = $product_id;
                            $this->comman_model->add('product_details', $update_product_detail_array);

                        } else {

                        }
                    }
                }




                if ($product_id) {
                    $this->comman_model->delete_where('products_count',array('product_id'=>$product_id));
                    foreach ($storewise_qty as $sid=>$qty_column_name){  
                        $qty_correction =  $singlerow[$qty_column_name]; 
                        if($singlerow[$qty_column_name]>$singlerow[$admin_products['quantity']['front']])   {
                            $qty_correction = $singlerow[$admin_products['quantity']['front']];
                        }               
                        $qty_data = array(
                            'quantity' => $qty_correction,
                            'product_id'=>$product_id,
                            'store_id'=> $sid
                        );                       
                        //insert quantity here
                        $this->comman_model->add('products_count',$qty_data);                        
                    }

                    if ($this->lang->default_lang_id != 13) {
                        if (trim($singlerow[$part_lang_column])) {


                            //print_r($singlerow[$item_lang_column]);
                            $product_lang_row = $this->comman_model->get_data_by_id('products_country', array('lang_id' =>$product_id, 'country_id' => $this->lang->default_lang_id));

                          $language_pr_update =   array('lang_part_name' =>trim($singlerow[$part_lang_column]),'lang_shipping_special_notes'=>trim($singlerow[$shipping_lang_column]),'country_id' => $this->lang->default_lang_id,'lang_id' => $product_id);

                            if ($product_lang_row) {

                                $this->comman_model->update_where('products_country',$language_pr_update, array('lang_id' => $product_id, 'country_id' => $this->lang->default_lang_id));
                            } else {

                                $this->comman_model->add('products_country',$language_pr_update);
                            }
                        }
                    }








                    $product_val_idddd = $this->comman_model->get_data_by_id('product_models', array('product_id' => $product_id, 'model_id' => $model_id));
                    if (!empty($product_val_idddd)) {

                        $product_model_data_array = array(
                            'product_id' => $product_id,
                            'category_id' => $category_id,
                            'maker_id' => $maker_id,
                            'model_id' => $model_id,
                            'status' => 1,
                        );
                        $this->comman_model->update_where('product_models', $product_model_data_array, array('id' => $product_val_idddd['id']));

                    } else {
                        $product_model_data_array = array(
                            'product_id' => $product_id,
                            'category_id' => $category_id,
                            'maker_id' => $maker_id,
                            'model_id' => $model_id,
                            'status' => 1,
                        );
                        $this->comman_model->add('product_models', $product_model_data_array);
                    }

                    $model_group_count = $this->comman_model->table_count("model_groups", array("product_type_id" => $product_type_id, "model_id" => $model_id));

                    if ($model_group_count < 1) {

                        $models_groups = array(
                            'model_id' => $model_id,
                            'category_id' => $category_id,
                            'maker_id' => $maker_id,
                            'product_type_id' => $product_type_id,
                            'status' => 1,
                        );
                        $this->db->insert('model_groups', $models_groups);

                    }
                }
                // $product_items_data_result= $this->comman_model->get_data_by_id('product_items', array('product_id'=>$product_id,'model_id'=>$model_id));
                // if($product_id == $product_items_data_result['product_id'] && $model_id == $product_items_data_result['model_id']){
                // $product_items_data_array = array(
                //     'product_id' => $product_id,
                //     'item_id' => 1,
                //     'model_id' => $model_id,
                //     'value'=>$singlerow[$attributes['attributes'][1]],
                //     'engine_size'=>$singlerow[$attributes['attributes'][168]],
                //     'vehicle_attributes'=>$singlerow[$attributes['attributes'][168]],
                //     'position'=>$row['54'],
                //     'application_notes'=>$row['58'],
                //     'status'  => 1
                //     );
                //     $this->comman_model->update_where('product_items', $product_items_data_array, array('id' => $product_items_data_result['id']));
                // }else{

                if ($product_id) {

                    foreach ($attributes['attributes'] as $i_key => $attr_key_name) {

                        if ($items_name_main[$i_key]['item_type'] == "product_group") {

                            if ($singlerow[$attr_key_name]) {
                                // echo $attr_key_name;
                                // print_r($single_row[$attr_key_name]);
                                // echo "<br>";
                                if ($items_name_main[$i_key]['field_type'] == "dropdown") {

                                    $result_data_attrs = explode('#', $singlerow[$attr_key_name]);
                                    foreach ($result_data_attrs as $result_data_attr) {
                                        $product_attributes_data_result = array(
                                            'product_id' => $product_id,
                                            'item_id' => $i_key,
                                            'value' => $result_data_attr,
                                            'status' => 1,
                                        );

                                        $product_attributesl_count = $this->comman_model->table_count("product_attributes", $product_attributes_data_result);

                                        if ($product_attributesl_count < 1) {
                                            $this->comman_model->add('product_attributes', $product_attributes_data_result);
                                        }

                                    }

                                } else {

                                    $product_lines_data_result = array(
                                        'product_id' => $product_id,
                                        'item_id' => $i_key,
                                        'value' => $singlerow[$attr_key_name],
                                        'status' => 1,
                                    );

                                    $product_attributes_t_count = $this->comman_model->table_count("product_attributes", $product_lines_data_result);

                                    if ($product_attributes_t_count < 1) {
                                        $this->comman_model->add('product_attributes', $product_lines_data_result);
                                    }

                                }

                            }
                        }
                    }

                    $product_items_data_array = array(
                        'product_id' => $product_id,
                        'item_id' => 1,
                        'model_id' => $model_id,
                        'value' => $singlerow[$attributes['attributes'][1]],
                        'engine_size' => $singlerow[$attributes['attributes'][2]],
                        'vehicle_attributes' => $singlerow[$attributes['attributes'][168]],
                        'position' => $singlerow[$attributes['attributes'][167]],
                        'application_notes' => $singlerow[$attributes['attributes'][169]],
                        'status' => 1,
                    );
                    $prodcut_items_count = $this->comman_model->table_count('product_items',array('product_id' => $product_id,'model_id' => $model_id));
                    if($prodcut_items_count<1){
                        $this->comman_model->add('product_items', $product_items_data_array);
                    }else{
                        $this->comman_model->update_where('product_items', $product_items_data_array, array('product_id' => $product_id,'model_id' => $model_id));
                    }
                        

                    $model_count = $this->comman_model->table_count("model_engines", array("years" => $singlerow[$attributes['attributes'][1]], "model_id" => $model_id, "engine_size" => $singlerow[$attributes['attributes'][2]]));

                    if ($model_count < 1) {

                        $models_years = array(
                            'model_id' => $model_id,
                            'years' => $singlerow[$attributes['attributes'][1]],
                            "engine_size" => $singlerow[$attributes['attributes'][2]],
                            'status' => 1,
                        );
                        $this->db->insert('model_engines', $models_years);
                    }

                    $model_groups_count = $this->comman_model->table_count("model_engines_groups", array("years" => $singlerow[$attributes['attributes'][1]], "model_id" => $model_id, "engine_size" => $singlerow[$attributes['attributes'][2]], 'product_type_id' => $product_type_id));

                    if ($model_groups_count < 1) {

                        $models_years_group = array(
                            'model_id' => $model_id,
                            'years' => $singlerow[$attributes['attributes'][1]],
                            "engine_size" => $singlerow[$attributes['attributes'][2]],
                            'product_type_id' => $product_type_id,
                            'status' => 1,
                        );
                        $this->db->insert('model_engines_groups', $models_years_group);
                    }

                }
                // }
                // if (($singlerow['attribute/Cross__reference/Drop Down'] !="") || ($singlerow['attribute/Cross__reference/Drop Down'] !="")) {
                //  //echo "test" ;
                // }
                // echo "<Pre>";print_r($singlerow);die;
                //echo "out\n";
                // this code  Insert product Attributes in the database
                $product_type_att_row = $this->comman_model->get_data_by_id('tbl_product_types', array('id' => $product_type_id));
                // $product_id, $product_type_att_row, $singlerow, $product_folder_images, $model_id, $maker_id, $product_number, $produt_number_col, $items_name_main, $field_types, $attributes

                // // this function save product items in the database
                // if ($product_id  && $row_validated == "1") {
                //     $this->all_product_item_insertion($product_id, $product_type_att_row, $singlerow, $product_folder_images, $model_id, $maker_id, $product_number, $produt_number_col, $items_name_main, $field_types, $attributes);
                //     $product_number[] = $produt_number_col;

                // }
            }

            // if ($row_validated == "1") {
            // $this->comman_model->delete_where('tbl_product_parent', array('product_id' => $product_id));

            // this code is executed when parent column is not empty
            // if ($singlerow[$admin_products['parent_multiselect']['front']]) {

            //     $parent_all = explode("#", $singlerow[$admin_products['parent_multiselect']['front']]);
            //     if (array_key_exists($product_id, $parent_update)) {
            //         // this code append parent product numbe in the parent array
            //         $parent_update[$product_id] = array_unique(array_merge($parent_update[$product_id], $parent_all));
            //     } else {

            //         $parent_update[$product_id] = $parent_all;
            //     }
            // }
            // if ($product_id) {
            //     if ($this->lang->default_lang_id != 13) {

            //         if (trim($singlerow[$shipping_lang_column])) {

            //             //print_r($singlerow[$item_lang_column]);
            //             $relation_lang_row = $this->comman_model->get_data_by_id('tbl_product_category_maker_model_relation_country', array('lang_id' => $product_id, 'country_id' => $this->lang->default_lang_id));

            //             if ($relation_lang_row) {

            //                 $this->comman_model->update_where('tbl_product_category_maker_model_relation_country', array('lang_shipping_special_notes' => $singlerow[$shipping_lang_column]), array('lang_id' => $product_id, 'country_id' => $this->lang->default_lang_id));
            //             } else {

            //                 $this->comman_model->add('tbl_product_category_maker_model_relation_country', array('lang_shipping_special_notes' => $singlerow[$shipping_lang_column], 'lang_id' => $product_id, 'country_id' => $this->lang->default_lang_id));
            //             }
            //         }

            //         if (trim($singlerow[$unit_lang_column])) {

            //             //print_r($singlerow[$item_lang_column]);
            //             $unit_lang_row = $this->comman_model->get_data_by_id('tbl_product_category_maker_model_relation_country', array('lang_id' => $product_id, 'country_id' => $this->lang->default_lang_id));

            //             if ($unit_lang_row) {

            //                 $this->comman_model->update_where('tbl_product_category_maker_model_relation_country', array('lang_unit_of_measurement' => $singlerow[$unit_lang_column]), array('lang_id' => $product_id, 'country_id' => $this->lang->default_lang_id));
            //             } else {

            //                 $this->comman_model->add('tbl_product_category_maker_model_relation_country', array('lang_unit_of_measurement' => $singlerow[$unit_lang_column], 'lang_id' => $product_id, 'country_id' => $this->lang->default_lang_id));
            //             }
            //         }

            //         if (trim($singlerow[$part_lang_column])) {

            //             //this function update language data for product table
            //             $catg_lang_row = $this->comman_model->get_data_by_id('tbl_product_category_maker_model_relation_country', array('lang_id' => $product_id, 'country_id' => $this->lang->default_lang_id));

            //             if ($catg_lang_row) {

            //                 $this->comman_model->update_where('tbl_product_category_maker_model_relation_country', array('lang_part_name' => $singlerow[$part_lang_column]), array('lang_id' => $product_id, 'country_id' => $this->lang->default_lang_id));
            //             } else {

            //                 $this->comman_model->add('tbl_product_category_maker_model_relation_country', array('lang_part_name' => $singlerow[$part_lang_column], 'lang_id' => $product_id, 'country_id' => $this->lang->default_lang_id));
            //             }
            //         }
            //     }
            // }

            // this function insert parent product in the database
            // $this->product_parent_insertion($parent_update);
            // }

            // Increase the current line
            $lineNumber++;
        }
        // loop closed

        //move log file to uploads/logs folder
        $file_path = FCPATH . '/assets/uploads/logs/';
        if (file_exists($log_file)) {
            if (!is_dir($file_path)) {
                mkdir($file_path, 0777, true);
            }
            rename($log_file, $file_path . 'log_' . $request_id . '.log');
        }
        fclose($handle);
        $responce = array('recordscreated' => $recordcreated, "rowsiterated" => $lineNumber, 'status' => 1);
        return $responce;
        exit;
    }

    /**
     * Method all_product_item_insertion
     *
     * @param $product_id $product_id [explicite description]
     * @param $product_type_row $product_type_row [explicite description]
     * @param $singlerow $singlerow [explicite description]
     * @param $product_folder_images $product_folder_images [explicite description]
     *
     * @return void
     */

    public function all_product_item_insertion($product_id, $product_type_row, $singlerow, $product_folder_images, $model_id, $maker_id, $product_number, $part_number, $items_name_main, $field_types, $attributes)
    {
        //    echo "<pre>";print_r($attributes);die;
        $attribute_real = array();
        $att_title = $attributes['attribute_title'] . '/';

        // Get only Attributes Columns and their values
        $attribute_columns = array_filter($singlerow, function ($key) use ($att_title) {
            return strpos($key, $att_title) === 0;
        }, ARRAY_FILTER_USE_KEY);

        foreach ($attribute_columns as $key => $value) {

            $string_name = explode('/', $key);

            $attribute_real[$string_name[1]]["type"] = $string_name[2];
            $attribute_real[$string_name[1]]["value"] = $value;
        }

        $items_count_field = $attributes['items_count_field'];

        // attribute_real is ready and now we need to add this under column

        foreach ($attribute_real as $item_key => $item_value) {

            $item_name = str_replace('__', ' ', $item_key);
            if ($this->lang->default_lang_id == 13) {
                $item_row = $this->comman_model->get_data_by_id('tbl_product_items', array('item_name' => trim($item_name)));
            } else {
                $item_lang = $this->comman_model->get_data_by_id('tbl_product_items_country', array('country_id' => $this->lang->default_lang_id, 'lang_item_name' => trim($item_name)));
                if ($item_lang) {
                    $item_row = $this->comman_model->get_data_by_id('tbl_product_items', array('id' => $item_lang['lang_id']));
                } else {
                    $item_row = $this->comman_model->get_data_by_id('tbl_product_items', array('item_name' => trim($item_name)));
                }
            }

            $array_valid = array("149", "1", "166");
            if (in_array($item_row['id'], $array_valid)) {

                $item_id = $item_row['id'];
                $item_name = $item_name;
                $item_type = $item_row['field_type'];
                $value = $item_value['value'];
                $product_lang_value = $singlerow[$items_count_field[$item_id]];
                // Add item value in the relational table
                if ($item_type == "dropdown") {
                    exit('asfasfafssafasfasf');
                    if (!in_array($part_number, $product_number)) {
                        $this->comman_model->delete_where('product_items', array('product_id' => $product_id, 'item_id' => $item_id));
                    }
                    $dropdown_values = explode("#", $value);
                    $dropdown_lang_values = explode("#", $product_lang_value);
                    foreach ($dropdown_values as $key => $single_drop_value) {
                        $this->part_item_insertion($product_id, $single_drop_value, $item_id, $item_type, $product_folder_images, $item_row['item_type'], $model_id, $maker_id, $items_name_main, $singlerow, $field_types, $attributes, $dropdown_lang_values[$key]);
                    }
                } else {
                    exit('hi');
                    $this->part_item_insertion($product_id, $value, $item_id, $item_type, $product_folder_images, $item_row['item_type'], $model_id, $maker_id, $items_name_main, $singlerow, $field_types, $attributes, $product_lang_value);
                }
            } else {

                $this->part_item_insertion($product_id, $item_value['value'], $item_id, $item_row['field_type'], $product_folder_images, $item_row['item_type'], $model_id, $maker_id, $items_name_main, $singlerow, $field_types, $attributes, $singlerow[$items_count_field[$item_id]]);
            }
        }

        return $attribute_real;
    }

    /**
     * Method part_item_insertion
     * This Function is used  to save  product item and its related values in two tables as per the product id.
     * @param $product_id $product_id [This parameter is the product id.]
     * @param $product_value $product_value [This parameter is the product item value.]
     * @param $product_item_id $product_item_id [This parameter is the product item id.]
     * @param $item_type $item_type [This parameter is the product item type.]
     * @param $product_folder_images $product_folder_images [This parameter is the product images folder path.]
     *
     * @return void
     */
    public function part_item_insertion($product_id, $product_value, $product_item_id, $item_type, $product_folder_images, $row_type, $model_id, $maker_id, $items_name_main, $singlerow, $field_types, $attributes, $product_value_lang)
    {

        $items_count_field = $attributes['items_count_field'];
        $items_field = $attributes['items_field'];

        if ($product_value) {
            // if product value paramter is set than this code executed.

            if ($item_type == "dropdown") {
                // if product item type is dropdown than this code executed
                $item_data = array(
                    'product_id' => $product_id,
                    'product_item_id' => $product_item_id,
                    'value' => $item_type,
                    'dropdown' => 1,
                    'image' => 0,
                );

                if ($row_type == "product_model" && $product_item_id = "1") {
                    $item_data['product_model_id'] = $model_id;
                    $item_data['product_maker_id'] = $maker_id;
                }
            } else {

                // if product item type is not dropdown and image than this code executed
                $item_data = array(
                    'product_id' => $product_id,
                    'product_item_id' => $product_item_id,
                    'value' => $product_value,
                    'dropdown' => 0,
                    'image' => 0,
                );

                if ($row_type == "product_model" && $product_item_id = "1") {
                    $item_data['product_model_id'] = $model_id;
                    $item_data['product_maker_id'] = $maker_id;
                }
            }

            $item_where = array(
                'product_id' => $product_id,
                'product_item_id' => $product_item_id,
            );

            if ($row_type == "product_model" && $product_item_id = "1") {
                $item_where['product_model_id'] = $model_id;
                $item_where['product_maker_id'] = $maker_id;
            }

            // this function check is product item related to product is exist or not
            $wheelpostion_row = $this->comman_model->get_data_by_id('tbl_product_items', $item_where);

            if ($wheelpostion_row) {

                //if exist than this code just return id of row
                $wheel_item_relation_id = $wheelpostion_row['id'];

                $this->comman_model->update_where('tbl_product_items', $item_data, array('id' => $wheel_item_relation_id));
            } else {

                //if not  exist than this code create new record and  return id of row
                $wheel_item_relation_id = $this->comman_model->add('tbl_product_items', $item_data);
            }

            // Add relation country
            if ($this->lang->default_lang_id != 13 && $item_type != "dropdown" && !empty($product_value_lang)) {
                // country dropdown values
                $item_relation_cpuntry['lang_id'] = $wheel_item_relation_id;
                $item_relation_cpuntry['country_id'] = $this->lang->default_lang_id;
                $item_relation_cpuntry['lang_value'] = $product_value_lang;

                // this code check is row exist with above column
                $wheel_relation_row_country = $this->comman_model->get_data_by_id('tbl_product_items_country', $item_relation_cpuntry);
                if ($wheel_relation_row_country) {
                } else {

                    $this->comman_model->add('tbl_product_items_country', $item_relation_cpuntry);
                }
            }

            // After insert product item related to product this code save item values related to products and items
            if ($item_type == "dropdown") {
                // if product item type is image than this code executed
                $item_relation_data = array(
                    'product_id ' => $product_id,
                    'product_item_id' => $product_item_id,
                    'product_item_relation_id' => $wheel_item_relation_id,
                    'value' => $product_value,
                );

                if ($row_type == "product_model" && $product_item_id == "1") {

                    // item  keys
                    $engine_size = str_replace(' ', '__', $items_name_main[2]['item_name']);
                    $position = str_replace(' ', '__', $items_name_main[167]['item_name']);
                    $vehic_att = str_replace(' ', '__', $items_name_main[168]['item_name']);
                    $app_notes = str_replace(' ', '__', $items_name_main[169]['item_name']);

                    // item keys name
                    $engine_size_value = "attribute/" . $engine_size . "/" . $field_types['dropdown'];
                    $position_value = "attribute/" . $position . "/" . $field_types['dropdown'];
                    $vehic_att_value = "attribute/" . $vehic_att . "/" . $field_types['dropdown'];
                    $app_notes_value = "attribute/" . $app_notes . "/" . $field_types['dropdown'];

                    // item keys value
                    $item_relation_data['product_model_id'] = $model_id;
                    $item_relation_data['product_maker_id'] = $maker_id;
                    $item_relation_data['engine_size'] = $singlerow[$items_field[2]];
                    $item_relation_data['position'] = $singlerow[$items_field[167]];
                    $item_relation_data['vehicle_attributes'] = $singlerow[$items_field[168]];
                    $item_relation_data['application_notes'] = $singlerow[$items_field[169]];

                    $item_relation_data_cpuntry['country_id'] = $maker_id;
                    $item_relation_data_cpuntry['lang_engine_size'] = $singlerow[$items_count_field[2]];
                    $item_relation_data_cpuntry['lang_position'] = $singlerow[$items_count_field[167]];
                    $item_relation_data_cpuntry['lang_vehicle_attributes'] = $singlerow[$items_count_field[168]];
                    $item_relation_data_cpuntry['lang_application_notes'] = $singlerow[$items_count_field[169]];

                    //  $csv_array[] = $country_data['name'] . "_attribute/" . $item_name . '/' . $field_types['dropdown'];
                }

                // this code check is row exist with above column
                $wheel_relation_row = $this->comman_model->get_data_by_id('product_items', $item_relation_data);

                if ($wheel_relation_row) {
                    // if exist than this code just return id
                    $item_dropdown_country_id = $wheel_relation_row['id'];
                } else {
                    $item_dropdown_country_id = $this->comman_model->add('tbl_product_item_relation_dropdown', $item_relation_data);
                }

                if ($this->lang->default_lang_id != 13 && !empty($product_value_lang) && $row_type == "product_model" && $product_item_id == "1") {
                    // country dropdown values
                    $item_relation_data_cpuntry['lang_id'] = $item_dropdown_country_id;
                    $item_relation_data_cpuntry['country_id'] = $this->lang->default_lang_id;
                    // $item_relation_data_cpuntry['lang_value'] =  $product_value_lang;

                    // this code check is row exist with above column
                    $wheel_relation_row_country = $this->comman_model->get_data_by_id('tbl_product_item_relation_dropdown_country', $item_relation_data_cpuntry);

                    // echo "<pre>";
                    // print_r($item_relation_data_cpuntry);

                    // echo "row data";
                    // print_r($wheel_relation_row_country);

                    if ($wheel_relation_row_country) {
                        // echo "exist=" . $wheel_relation_row_country['lang_id'];
                    } else {

                        $this->comman_model->add('tbl_product_item_relation_dropdown_country', $item_relation_data_cpuntry);
                        // echo "created=";
                    }
                }

                if ($this->lang->default_lang_id != 13 && !empty($product_value_lang) && $row_type == "product_group" && $product_item_id == "149") {
                    // country dropdown values
                    $item_relation_data_cpuntry['lang_id'] = $item_dropdown_country_id;
                    $item_relation_data_cpuntry['country_id'] = $this->lang->default_lang_id;
                    $item_relation_data_cpuntry['lang_value'] = $product_value_lang;

                    // this code check is row exist with above column
                    $wheel_relation_row_country = $this->comman_model->get_data_by_id('tbl_product_item_relation_dropdown_country', $item_relation_data_cpuntry);

                    if ($wheel_relation_row_country) {
                        // echo "exist=" . $wheel_relation_row_country['lang_id'];
                    } else {

                        $this->comman_model->add('tbl_product_item_relation_dropdown_country', $item_relation_data_cpuntry);
                        // echo "created=";
                    }
                }
            }
        }
    }

    /**
     * Method product_parent_insertion
     * This Function insert producta parent data after all products import.
     *
     * @return void
     */
    public function product_parent_insertion($all_parents)
    {
        // this loop iterate each element of the all_parents array
        foreach ($all_parents as $product_id => $parent) {
            // this loop iterate child array of the each element
            foreach ($parent as $single_parent) {
                // this function get the product id from the product number
                $part_number_check = array(
                    'kgt_ref_number' => $single_parent,
                );
                $part_number_check_row = $this->comman_model->get_data_by_id('tbl_product_category_maker_model_relation', $part_number_check);
                if ($part_number_check_row['id']) {

                    $pparent_data = array(
                        'product_id' => $product_id,
                        'parent_product_id' => $part_number_check_row['id'],
                    );
                    // if product exist than this code insert record in the database
                    $pparent_data_row = $this->comman_model->get_data_by_id('tbl_product_parent', $pparent_data);
                    if ($pparent_data_row) {
                        $pparent_data_row_id = $pparent_data_row['id'];
                    } else {
                        $pparent_data_row_id = $this->comman_model->add('tbl_product_parent', $pparent_data);
                    }
                }
            }
        }
    }

    /**
     * Method product_attribute_download
     * This Function Download the product items data.
     * @return void
     */
    public function product_attribute_download()
    {

        $currentTime = time();
        $fileName = "productattribute" . '_' . $currentTime . '.csv';

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_tbl_product_items'), $this->lang->default_lang_id);
        $admin_tbl_product_item = $all_language_data['admin_tbl_product_items'];
        $admin_static_links = $all_language_data['admin_static_links'];

        $attribute_data = $this->comman_model->GetAllDataLang('tbl_product_items', $this->lang->default_lang_id, 'tbl_product_items_country');
        $country_data = $this->comman_model->get_data_by_id('country', array('id' => $this->lang->default_lang_id));

        $item_lang_column = $country_data['name'] . "_" . $admin_tbl_product_item['product_item_title']['admin'];
        // lang_item_name $exit;
        $header = array($admin_tbl_product_item['product_item_title']['admin'], $item_lang_column, $admin_tbl_product_item['item_type']['admin'], $admin_tbl_product_item['field_type']['admin'], $admin_tbl_product_item['item_text_size']['admin'], $admin_tbl_product_item['item_text_color']['admin'], $admin_tbl_product_item['required_attribute']['admin'], $admin_tbl_product_item['multi_language']['admin']);
        $field_types = array_flip(array($admin_static_links['field_text']['front'] => "text", $admin_static_links['field_image']['front'] => "image", $admin_static_links['field_dropdown']['front'] => "dropdown"));
        $item_type = array_flip(array($admin_static_links['item_product_group']['front'] => "product_group", $admin_static_links['item_product_model']['front'] => "product_model"));
        header('Content-Type: application/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $fileName . '";');
        ob_end_clean();
        $handle = fopen('php://output', 'w');
        fputcsv($handle, $header);
        foreach ($attribute_data as $value) {
            $single_row = array_slice($value, 1, 3);
            if ($this->lang->default_lang_id != 13) {
                if ($value['lang_item_name']) {
                    $language_item_column = $value['item_name'];
                    $item_name = $value['lang_item_name'];
                } else {
                    $language_item_column = $value['lang_item_name'];
                    $item_name = $value['item_name'];
                }
            } else {

                if ($value['lang_item_name']) {
                    $language_item_column = $value['lang_item_name'];
                    $item_name = $value['lang_item_name'];
                } else {
                    $language_item_column = $value['item_name'];
                    $item_name = $value['item_name'];
                }
            }
            $single_row = array($item_name, $language_item_column, $item_type[$value['item_type']], $field_types[$value['field_type']], $value['item_text_size'], $value['item_text_color'], $value['required_attribute'], $value['multi_language']);
            fputcsv($handle, $single_row);
        }
        fclose($handle);
        ob_flush();
        exit();
    }

    /**
     * Method import_attribute
     * This Function import product items using product item csv.
     * @return void
     */
    public function import_attribute()
    {

        $all_language_data = get_admin_lang_data(array('admin_title', 'admin_static_links', 'admin_tbl_product_items'), $this->lang->default_lang_id);
        $admin_title = $all_language_data['admin_title'];
        $admin_tbl_product_item = $all_language_data['admin_tbl_product_items'];
        $admin_static_links = $all_language_data['admin_static_links'];

        // this code intialized the array of product item types name as per language data
        $field_types = array($admin_static_links['field_text']['front'] => "text", $admin_static_links['field_image']['front'] => "image", $admin_static_links['field_dropdown']['front'] => "dropdown");
        $item_type = array($admin_static_links['item_product_group']['front'] => "product_group", $admin_static_links['item_product_model']['front'] => "product_model");

        $country_data = $this->comman_model->get_data_by_id('country', array('id' => $this->lang->default_lang_id));

        $item_lang_column = $country_data['name'] . "_" . $admin_tbl_product_item['product_item_title']['admin'];
        $header = array($admin_tbl_product_item['product_item_title']['admin'], $admin_tbl_product_item['field_type']['admin'], $admin_tbl_product_item['multi_language']['admin'], $item_lang_column);

        if ($this->input->post('operation')) {
            // this code executed when used upload the file
            if (!empty($_FILES['attribute_file']['name'])) {

                $file_original = explode(".", $_FILES['attribute_file']['name']);
                if ($file_original[1] != "csv") {
                    // if file type is not csv than this function return error
                    $result = array('message' => $admin_title['csv_file_type']['front'], 'status' => 0);
                    echo json_encode($result);
                    exit;
                }

                // this code check importdata folder  if not exist than create this folder
                $import_folder = FCPATH . '/assets/uploads/importdata/';
                if (!file_exists($import_folder)) {
                    mkdir($import_folder, 0755, true);
                }

                // this code check productattribute folder if not exist than create this folder
                $product_folder = FCPATH . '/assets/uploads/importdata/productattribute/';
                if (!file_exists($product_folder)) {
                    mkdir($product_folder, 0755, true);
                }

                // this code create new folder with unique name in  productattribute folder
                $currentTime = time();
                $csv_file_name = $file_original[0] . "_" . $currentTime . "." . $file_original[1];
                $upload_path = './assets/uploads/importdata/productattribute/' . $csv_file_name;

                // this code upload csv file to newly unique name folder
                if (!move_uploaded_file($_FILES['attribute_file']['tmp_name'], $upload_path)) {
                    // if file is not uploaded than this function return error
                    $result = array('message' => $admin_title['csv_file_error']['front'], 'status' => 0);
                    echo json_encode($result);
                    exit;
                } else {
                    // if file is  uploaded than this code executed
                    $file_path = './assets/uploads/importdata/productattribute/' . $csv_file_name;
                    if (file_exists($file_path)) {
                    } else {
                        // if file is not exist than this function return error
                        $result = array('message' => $admin_title['csv_file_error']['front'], 'status' => 0);
                        echo json_encode($result);
                        exit;
                    }
                    // Read a CSV file
                    $handle = fopen($file_path, "r");
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

                        if ($singlerow[$admin_tbl_product_item['product_item_title']['admin']]) {

                            // this function check that is product item exsit with same name or not
                            $item_row = $this->comman_model->get_data_by_id('tbl_product_items', array('item_name' => trim($singlerow[$admin_tbl_product_item['product_item_title']['admin']])));

                            if ($item_row) {
                                // if item with same name exist than this code update the row
                                $item_id = $item_row['id'];
                                $item_data = array(
                                    'item_name' => $singlerow[$admin_tbl_product_item['product_item_title']['admin']],
                                    'field_type' => $field_types[$singlerow[$admin_tbl_product_item['field_type']['admin']]],
                                    'item_type' => $item_type[$singlerow[$admin_tbl_product_item['item_type']['admin']]],
                                    'item_text_color' => $singlerow[$admin_tbl_product_item['item_text_color']['admin']],
                                    'required_attribute' => $singlerow[$admin_tbl_product_item['required_attribute']['admin']],
                                    'item_text_size' => $singlerow[$admin_tbl_product_item['item_text_size']['admin']],
                                    'multi_language' => $singlerow[$admin_tbl_product_item['multi_language']['admin']],
                                );
                                $this->comman_model->update_where('tbl_product_items', $item_data, array('id' => $item_row['id']));
                            } else {
                                // if item with same name not exist than this code create the new record
                                $item_data = array(
                                    'item_name' => $singlerow[$admin_tbl_product_item['product_item_title']['admin']],
                                    'field_type' => $field_types[$singlerow[$admin_tbl_product_item['field_type']['admin']]],
                                    'item_type' => $item_type[$singlerow[$admin_tbl_product_item['item_type']['admin']]],
                                    'item_text_color' => $singlerow[$admin_tbl_product_item['item_text_color']['admin']],
                                    'required_attribute' => $singlerow[$admin_tbl_product_item['required_attribute']['admin']],
                                    'item_text_size' => $singlerow[$admin_tbl_product_item['item_text_size']['admin']],
                                    'multi_language' => $singlerow[$admin_tbl_product_item['multi_language']['admin']],
                                    'created' => date('Y-m-d h:i:s'),
                                );
                                $item_id = $this->comman_model->add('tbl_product_items', $item_data);
                            }

                            if ($this->lang->default_lang_id != 13) {
                                // this code executed when language is not english

                                // This code save language name of product item in the database
                                if (trim($singlerow[$item_lang_column])) {
                                    $item_lang_row = $this->comman_model->get_data_by_id('tbl_product_items_country', array('lang_id' => $item_id, 'country_id' => $this->lang->default_lang_id));

                                    if ($item_lang_row) {
                                        $item_lang_row = $this->comman_model->get_data_by_id('tbl_product_items_country', array('lang_id' => $item_id, 'country_id' => $this->lang->default_lang_id));
                                        $this->comman_model->update_where('tbl_product_items_country', array('lang_item_name' => $singlerow[$item_lang_column]), array('lang_id' => $item_id, 'country_id' => $this->lang->default_lang_id));
                                    } else {
                                        // this code create the new record

                                        $this->comman_model->add('tbl_product_items_country', array('lang_id' => $item_id, 'country_id' => $this->lang->default_lang_id, 'lang_item_name' => $singlerow[$item_lang_column]));
                                    }
                                }
                            }
                        }
                        $lineNumber++;
                    }

                    $result = array('message' => $admin_title['attribute_success']['front'], 'status' => 1);
                    echo json_encode($result);
                    exit;
                }
            } else {
                // if file not upload the this function return error
                $result = array('message' => $admin_title['csv_file_error']['front'], 'status' => 0);
                echo json_encode($result);
                exit;
            }
        } else {
            // if file not upload the this function return error
            $result = array('message' => $admin_title['csv_file_error']['front'], 'status' => 0);
            echo json_encode($result);
            exit;
        }
    }

    /**
     * Method product_data_download
     * This Function download the complete product data in the csv format.
     * @return void
     */
    public function product_data_download($type = "open", $products_passesd = array())
    {

        $currentTime = time();

        // this is the unique name of product file.
        $fileName = "productimport" . '_' . $currentTime . '.csv';

        $all_language_data = get_admin_lang_data(array('cart_instruction', 'admin_products', 'admin_title', 'admin_importdata', 'general_instruction'), $this->lang->default_lang_id);
        $admin_products = $all_language_data['admin_products'];

        $currencyV = getDefaultCurrencyCode('l') . '_currency';
        $currency = $all_language_data['general_instruction'][$currencyV]['front'];

        // this code check the directory for cart data if exist or not
        $exportdirectory = FCPATH . '/assets/uploads/exportdata/';
        if (!file_exists($exportdirectory)) {
            mkdir($exportdirectory, 0777, true);
        }

        $exportdirectory_date = FCPATH . '/assets/uploads/exportdata/' . date('Y-m-d');
        if (!file_exists($exportdirectory_date)) {
            mkdir($exportdirectory_date, 0777, true);
        }

        if ($type == "open") {
            if ($this->input->post('operation')) {

                $selected_products = $this->input->post('selected_products');
                $product_id = $this->input->post('product_id');
                $limit = $this->input->post('limit');

                $postdata = array("product_id" => $product_id, "limit" => $limit, "selected_products" => $selected_products);
            } else {
                $postdata = array("product_id" => "", "limit" => "1000", "selected_products" => "");
            }
        } else {

            $postdata = array("product_id" => "", "limit" => "", "selected_products" => $products_passesd);
        }

        // this function get all products related data
        // $product_table_data = $this->product_model->get_all_products_for_csv($this->lang->default_lang_id, $postdata);
        $product_table_data = $this->product_model->get_all_products_for_csv($this->lang->default_lang_id, $postdata);

        $country_data = $this->comman_model->get_data_by_id('country', array('id' => $this->lang->default_lang_id));
        $part_lang_column = $country_data['name'] . "_" . $admin_products['part_name']['front'];
        $cat_lang_column = $country_data['name'] . "_" . $admin_products['category_name']['front'];
        $maker_lang_column = $country_data['name'] . "_" . $admin_products['product_maker_name']['front'];
        $model_lang_column = $country_data['name'] . "_" . $admin_products['product_model_name']['front'];
        $shipping_lang_column = $country_data['name'] . "_" . $admin_products['shipping_special_notes']['front'];
        $unit_lang_column = $country_data['name'] . "_" . $admin_products['unit_of_measurement']['front'];
        $nature_lang_column = $country_data['name'] . "_" . $admin_products['item_nature']['front'];
        $ptype_lang_column = $country_data['name'] . "_" . $admin_products['product_type_title']['front'];
        $industry_lang_name = $country_data['name'] . "_" . $admin_products['industry_name']['front'];
        $industry_lang_description = $country_data['name'] . "_" . $admin_products['industry_description']['front'];
        $attributes = $this->product_model->makes_attributes_column();
        $items_field = $attributes['items_field'];
        $items_name = $attributes['items_name'];
        $storewise_qty =$this->product_model->makes_storewise_qty_column();        
        
        
        // this array make header fot the csv file as per the language
        $header = array(
            $admin_products['category_name']['front'],
            $cat_lang_column,
            $admin_products['vehicle_photo']['front'],
            $admin_products['product_maker_name']['front'],
            $maker_lang_column,
            $admin_products['logo']['front'],
            $admin_products['product_model_name']['front'],
            $model_lang_column,
            $admin_products['upload_photo']['front'],
            $admin_products['industry_name']['front'],
            $industry_lang_name,
            $admin_products['industry_icon']['front'],
            $admin_products['industry_description']['front'],
            $industry_lang_description,
            $admin_products['industry_status']['front'],
            $admin_products['item_schematic_photo_status']['front'],
            $admin_products['item_schematic_photo']['front'],
            $admin_products['item_real_photo']['front'],
            $admin_products['item_nature']['front'],
            $nature_lang_column,
            $admin_products['kgt_ref_no']['front'],
            $admin_products['product_type_title']['front'],
            $ptype_lang_column,
            $admin_products['part_name']['front'],
            $part_lang_column,
            $admin_products['product_type_photo']['front'],
            $admin_products['unit_of_measurement']['front'],
            $admin_products['currency']['front'],
            $admin_products['item_weight']['front'],
            $admin_products['item_length']['front'],
            $admin_products['item_width']['front'],
            $admin_products['item_height']['front'],
            $admin_products['price']['front'],
            $admin_products['country_origin']['front'],
            $admin_products['quantity']['front'],
            
        );
        $store_data = $this->comman_model->get_row_array('store',"*",array('status'=>1));
        foreach ($store_data as $s){ 
            $header[] = $storewise_qty[$s['id']];   //Aditya location wise store
        }
     
        $header_2 = array (
            $admin_products['min_quantity']['front'],
            $admin_products['quantity_threshold']['front'],
            $admin_products['replenishment_order_number']['front'],
            $admin_products['replenishment_order_date']['front'],
            $admin_products['replenishing_period']['front'],
            $admin_products['replenishing_period_tolerance_range']['front'],
            $admin_products['shipping_special_notes']['front'],
            $shipping_lang_column,
            $admin_products['package_multiple']['front'],
            $admin_products['display_kondarsoft']['front'],
            $admin_products['product_distributor']['front'],
            $admin_products['template']['front'],
            $attributes['attributes'][1],
            $attributes['attributes'][2],
            $attributes['attributes'][167],
            $attributes['attributes'][168],
            $attributes['attributes'][169],
        );
        $header = array_merge($header,$header_2);        

        // this code add   List of Attributes of to the Header of csv in
// echo "<pre>";

//         print_r(array_values($attributes['attributes']));
//         exit;

        // if (!empty($attributes['attributes'])) {
        //     $rowheader = array_merge($header, $attributes['attributes']);
        // } else {
        //     $rowheader = $header;
        // }

        foreach ($attributes['attributes'] as $i_key => $single_att) {
            if ($items_name[$i_key]['item_type'] == "product_group") {
                $header[] = $single_att;
            }
        }

        $rowheader = $header;

        if ($type == "open") {
            header('Content-Type: application/csv; charset=UTF-8');
            header('Content-Disposition: attachment; filename="' . $fileName . '";');
            ob_end_clean();
            $handle = fopen('php://output', 'w');
        } else {

            $file_name_new = $exportdirectory_date . "/" . $fileName;

            $handle = fopen($file_name_new, 'w');
        }

        fputcsv($handle, $rowheader);
        // this loop iterate each record of product data and append in the csv ..
        foreach ($product_table_data as $value) {

            $all_attributes = $this->comman_model->get_all_data_by_id("product_attributes", array("product_id" => $value['id']));
            $all_distributors = $this->product_model->getproduct_distributor_name($value['id']);
            unset($value['id']);
            unset($value['country_id']);
            unset($value['industry_id']);
            unset($value['industries']);

            $single_row = $value;

            if (!empty($all_distributors)) {
                $single_row['distributors'] = implode("#", $all_distributors);
            } else {
                $single_row['distributors'] = " ";
            }

            $cross_reff = array();
            $Product_line = "";

            foreach ($all_attributes as $single_att) {

                if ($items_name[$single_att['item_id']]['item_type'] == "product_group") {

                    if ($items_name[$single_att['item_id']]['field_type'] == "dropdown") {
                        $value[$items_field[$single_att['item_id']]][] = $single_att['value'];
                    } else {
                        $value[$items_field[$single_att['item_id']]] = $single_att['value'];
                    }
                }
            }

            $volume_unit = get_volume_unit();
            $weight_unit = get_weight_unit();
            $unit_of_meas = $volume_unit . "/" . $weight_unit;
            $single_row['Unit_Of_Measurement'] = $unit_of_meas;
            $single_row['English_Unit_Of_Measurement'] = $currency;

            foreach ($attributes['attributes'] as $attr_key_name) {

                // echo $attr_key_name."<br>";
                if ($value[$attr_key_name]) {
                    if (is_array($value[$attr_key_name])) {
                        $single_row[$attr_key_name] = implode("#", $value[$attr_key_name]);
                    } else {
                        $single_row[$attr_key_name] = $value[$attr_key_name];
                    }
                } else {
                    $single_row[$attr_key_name] = "";
                }
            }

            fputcsv($handle, $single_row);
        }

        fclose($handle);
        if ($type == "open") {
            ob_flush();
            exit();
        } else {

            return array("file_name" => $fileName, "file_path" => $file_name_new);
        }
    }

    /**
     * Method product_empty_download
     * This Function download the complete product data in the csv format.
     * @return void
     */
    public function product_empty_download()
    {
        $currentTime = time();
        // this is the unique name of product file.
        $fileName = "productempty" . '_' . $currentTime . '.csv';

        $all_language_data = get_admin_lang_data(array('cart_instruction', 'admin_products', 'admin_title', 'admin_importdata', 'general_instruction'), $this->lang->default_lang_id);
        $admin_products = $all_language_data['admin_products'];
        $currencyV = getDefaultCurrencyCode('l') . '_currency';
        $currency = $all_language_data['general_instruction'][$currencyV]['front'];
        // this function get all products related data
        $product_table_data = $this->product_model->empty_images_product();

        // this array make header fot the csv file as per the language
        $header = array(
            $admin_products['kgt_ref_no']['front'],
        );

        $rowheader = $header;
        header('Content-Type: application/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $fileName . '";');
        ob_end_clean();
        $handle = fopen('php://output', 'w');
        fputcsv($handle, $rowheader);
        // this loop iterate each record of product data and append in the csv ..
        foreach ($product_table_data as $value) {
            $single_row = $value;
            fputcsv($handle, $single_row);
        }

        //fclose($handle);
        if ($type == "open") {
            ob_flush();
            exit();
        } else {

            return array("file_name" => $fileName, "file_path" => $file_name_new);
        }
    }

    /**
     * Method product_data_images
     * This Function download the complete product images in zip format.
     * @return void
     */
    public function product_data_images($type = "open", $products_passesd = array())
    {

        // this code check the directory for cart data if exist or not
        $exportdirectory = FCPATH . '/assets/uploads/exportdata/';
        if (!file_exists($exportdirectory)) {
            mkdir($exportdirectory, 0777, true);
        }

        // this code check the directory for importdata exist or not
        $downloadzip = $exportdirectory . date('Y-m-d');
        if (!is_dir($downloadzip)) {
            mkdir($downloadzip, 0777, true);
        }
        // this code check the directory for downloadzip exist or not
        $zipdir = $downloadzip . "/downloadzip";
        if (!is_dir($zipdir)) {
            // if directory not exists than this function create directory
            mkdir($zipdir, 0777, true);
        }

        // this code check the directory for images exist or not
        $zipimagedir = $zipdir . '/images';
        if (!is_dir($zipimagedir)) {
            // if directory not exists than this function create directory
            mkdir($zipimagedir, 0777, true);
        }

        if ($type == "open") {

            if ($this->input->post('operation')) {

                $selected_products = $this->input->post('selected_products');
                $product_id = $this->input->post('product_id');

                $limit = $this->input->post('limit');

                $postdata = array("product_id" => $product_id, "limit" => $limit, "selected_products" => $selected_products);
            } else {

                $postdata = array("product_id" => "", "limit" => "10", "selected_products" => "");
            }
        } else {

            $postdata = array("product_id" => "", "limit" => "10", "selected_products" => $products_passesd);
        }

        // this function get all products and its related data from the database
        $product_table_data = $this->product_model->get_all_products_for_csv($this->lang->default_lang_id, $postdata);
        // echo '<pre>';print_r($product_table_data);die;
        foreach ($product_table_data as $value) {
            $single_row = $value;

            // this function check the image to their corresponding folder and copy to the zip folder
            if ($single_row['VehicleType_Photo']) {

                if (!file_exists($zipimagedir . '/' . $single_row['VehicleType_Photo'])) {

                    if (file_exists(FCPATH . '/assets/uploads/vehicle_categories/' . $single_row['VehicleType_Photo'])) {
                        // if product image is exist than this code copy product image to cart folder
                        copy(FCPATH . '/assets/uploads/vehicle_categories/' . $single_row['VehicleType_Photo'], $zipimagedir . '/' . $single_row['VehicleType_Photo']);
                    }
                }
            }

            if ($single_row['icon']) {

                if (!file_exists($zipimagedir . '/' . $single_row['icon'])) {

                    if (file_exists(FCPATH . '/assets/uploads/industries/' . $single_row['icon'])) {

                        // if product image is exist than this code copy product image to cart folder
                        copy(FCPATH . '/assets/uploads/industries/' . $single_row['icon'], $zipimagedir . '/' . $single_row['icon']);
                    }
                }
            }
            // this function check the image to their corresponding folder and copy to the zip folder

            if ($single_row['maker_logo']) {

                if (!file_exists($zipimagedir . '/' . $single_row['maker_logo'])) {

                    if (file_exists(FCPATH . '/assets/uploads/product_maker/' . $single_row['maker_logo'])) {

                        // if product image is exist than this code copy product image to cart folder
                        copy(FCPATH . '/assets/uploads/product_maker/' . $single_row['maker_logo'], $zipimagedir . '/' . $single_row['maker_logo']);
                    }
                }
            }
            // this function check the image to their corresponding folder and copy to the zip folder

            if ($single_row['model_photo']) {

                if (!file_exists($zipimagedir . '/' . $single_row['model_photo'])) {

                    if (file_exists(FCPATH . '/assets/uploads/product_model/' . $single_row['model_photo'])) {
                        // if product image is exist than this code copy product image to cart folder
                        copy(FCPATH . '/assets/uploads/product_model/' . $single_row['model_photo'], $zipimagedir . '/' . $single_row['model_photo']);
                    }
                }
            }

            // this function check the image to their corresponding folder and copy to the zip folder

            if ($single_row['item_schematic_photo']) {

                if (!file_exists($zipimagedir . '/' . $single_row['item_schematic_photo'])) {

                    if (file_exists(FCPATH . '/assets/uploads/product_images/' . $single_row['item_schematic_photo'])) {
                        // if product image is exist than this code copy product image to cart folder
                        copy(FCPATH . '/assets/uploads/product_images/' . $single_row['item_schematic_photo'], $zipimagedir . '/' . $single_row['item_schematic_photo']);
                    }
                }
            }
            // this function check the image to their corresponding folder and copy to the zip folder

            if ($single_row['item_real_photo'] && !empty($single_row['item_real_photo'])) {

                $item_real_img = explode(",", $single_row['item_real_photo']);

                foreach ($item_real_img as $real_img) {
                    if (!file_exists($zipimagedir . '/' . $real_img)) {
                        if (file_exists(FCPATH . '/assets/uploads/product_images/' . $real_img)) {

                            if (file_exists(FCPATH . '/assets/uploads/product_images/' . $real_img)) {

                                // if product image is exist than this code copy product image to cart folder
                                copy(FCPATH . '/assets/uploads/product_images/' . $real_img, $zipimagedir . '/' . $real_img);
                            }
                        }
                    }
                }
            }
            // this function check the image to their corresponding folder and copy to the zip folder

            if ($single_row['Product_Type_Photo']) {
                if (!file_exists($zipimagedir . '/' . $single_row['Product_Type_Photo'])) {

                    if (file_exists(FCPATH . '/assets/uploads/product_type_images/' . $single_row['Product_Type_Photo'])) {

                        // if product image is exist than this code copy product image to cart folder
                        copy(FCPATH . '/assets/uploads/product_type_images/' . $single_row['Product_Type_Photo'], $zipimagedir . '/' . $single_row['Product_Type_Photo']);
                    }
                }
            }
        }

        $folder_path = $zipdir;
        // this code check the directory for cart data if exist or not
        $file_name = 'product_images_' . time() . '_.zip';

        $zip_file = $downloadzip . "/" . $file_name;
        $zip = new ZipArchive;

        //create the file and throw the error if unsuccessful
        if ($zip->open($zip_file, ZIPARCHIVE::CREATE) !== true) {
            exit("cannot open " . $zip_file . "\n");
        }

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($folder_path),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            // Skip directories (they would be added automatically)
            if (!$file->isDir()) {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($folder_path) + 0);
                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();

        if ($type == "open") {

            // this function delete images folder after upload
            //  $this->deleteDir($folder_path);
            //then send the headers to force download the zip file
            header("Content-type: application/zip");
            header("Content-Disposition: attachment; filename=" . $file_name);
            header("Pragma: no-cache");
            header("Expires: 0");
            ob_end_clean();
            readfile($zip_file);
            // this function delete zip file  after upload
            // this function delete images folder after upload
            $this->deleteDir($zipimagedir);

            unlink($zip_file);
            -exit;
        } else {
            $this->deleteDir($zipimagedir);
            return array("file_name" => $file_name, "file_path" => $zip_file);
        }
    }

    /**
     * Method do_resize
     * This Functions resize image becuase when we upload form form it creates two images
     * Already exist in the common helper
     * @param $source_path $source_path [explicite description]
     * @param $destination_path $destination_path [explicite description]
     * @param $filename $filename [explicite description]
     *
     * @return void
     */
    public function do_resize_import_data_image($source_path, $destination_path, $filename)
    {

        $source_file = $source_path . '/' . $filename;
        $target_file = $destination_path . '/' . $filename;

        if ($source_path == "") {
            return false;
        }

        if (file_exists($target_file)) {
            return true;
        } else {
            if (file_exists($source_file)) {
                rename($source_file, $target_file);
            } else {
                return false;
            }

            $thumb_path = $destination_path . "/thumb";
            $thumb_target_path = $thumb_path . '/' . $filename;
            $this->load->library('image_lib');

            if (file_exists($target_file)) {
                $config_manip = array(
                    'image_library' => 'gd2',
                    'source_image' => $target_file,
                    'new_image' => $thumb_target_path,
                    'maintain_ratio' => true,
                    'width' => 140,
                    'height' => 90,
                );

                $this->image_lib->initialize($config_manip);

                if (!$this->image_lib->resize()) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }
    }

    /**
     * Method deleteDir
     * This function  delete  directory  and its containing file.
     * @param $dirPath $dirPath [This parameter is the directory path.]
     *
     * @return void
     */
    public static function deleteDir($dirPath)
    {
        if (!is_dir($dirPath)) {
            // if passed variable is not directory than nothing happen.

        } else {
            if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
                $dirPath .= '/';
            }
            // this function read all files and directory of the directory
            $files = glob($dirPath . '*', GLOB_MARK);
            foreach ($files as $file) {
                // this function iterate each item of the directory
                if (is_dir($file)) {
                    // if item is directory than this function delete directory
                    self::deleteDir($file);
                } else {
                    // if item is file that this function delete file.
                    unlink($file);
                }
            }
            rmdir($dirPath);
        }
    }

    /**
     * Method clean
     * Function to remove blank spaces from string.
     * @param $string $string [This parameter is string.]
     *
     * @return void
     */
    public function clean($string)
    {
        $string = trim($string); // Replaces all spaces.
        return $string; // Removes special chars.
    }

    public function delte_extra_records()
    {
        $all_types = $this->comman_model->all_data("tbl_product_types");
        $delete_record = array();
        foreach ($all_types as $type) {
            $products = $this->comman_model->get_all_data_by_id("tbl_product_category_maker_model_relation", array("product_type_id" => $type['id']));
            echo $type['id'] . "<br>";
            $k = 1;
            foreach ($products as $singleproduct) {
                if ($k > 5) {
                    //  echo  $singleproduct['id'] . ",";
                    $delete_record[] = $singleproduct['id'];
                }
                $k++;
            }

            echo "<br>";
        }
        $this->comman_model->deleteAllById("tbl_product_category_maker_model_relation", $delete_record);
    }

    /**
     * Method run_import_cron
     *
     * @return void
     */
    public function run_import_cron()
    {
        $request_data = $this->comman_model->get_data_by_id("import_requests", array("status" => "0"));
        

        $current_process = $this->comman_model->get_data_by_id("import_requests", array("status" => "1"));
        $log_file = '';
        // echo "<br/>get_defined_constants<br/>";
        // print_r(get_defined_constants());
        // echo "<br/>request_data<br/>";
        // print_r($request_data);
        // echo "<br/>current_process<br/>";
        // print_r($current_process);
        // exit;


        if ($request_data && empty($current_process)) {

            $this->lang->default_lang_id = $request_data['lang_id'];
            $update = $this->comman_model->update_column("import_requests", array("id" => $request_data['id']), array("status" => "0", "log_file" => "log_" . $request_data['id'] . ".log"));
            //validation log file is created
            if ($update) {
                $log_file = $this->customlog->write_log("", "log_" . $request_data['id']);
            }

            $all_language_data = get_admin_lang_data(array('admin_title'), $this->lang->default_lang_id);
            $admin_title = $all_language_data['admin_title'];
            // Make Folders and set variables
            $import_folder = FCPATH . 'assets' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'importproduct' . DIRECTORY_SEPARATOR;
            // Create folder for csv product file to upload
            $product_folder = $import_folder . 'productdata' . DIRECTORY_SEPARATOR;
            $product_folder_main = $product_folder . date('Y-m-d', strtotime($request_data['createddate']));
            $product_csv_name = $request_data['csv_file'];
            $product_zip_name = $request_data['zip_file'];

            $product_csv_path = $product_folder_main . DIRECTORY_SEPARATOR . $product_csv_name;
            $product_zip_path = $product_folder_main . DIRECTORY_SEPARATOR . $product_zip_name;

            $this->customlog->write_log(date('y-m-d h:i:s') . " => Request " . $request_data['id'] . " get and enter in the  function", "newlog");

            // this function check is csv file exist in the folder
            if (!file_exists($product_csv_path) && !file_exists($product_csv_path)) {
                // if file csv file not exist than this function return error
                $this->customlog->write_log(date('y-m-d h:i:s') . $product_csv_path . "file not exist", "newlog");
                $this->customlog->write_log(date('y-m-d h:i:s') . " Exit from the function", "newlog");
                $this->comman_model->update_column("import_requests", array("id" => $request_data['id']), array("status" => "2"));
                exit;
            } else {
                if (!empty($product_zip_name)) {

                    // Extract zip to for images and check folder exist in the zip folder
                    $zip = new ZipArchive;
                    $res = $zip->open($product_zip_path);
                    if ($res === true) {
                        $this->customlog->write_log($product_zip_path . "file  extracted", "newlog");

                        $zip->extractTo($product_folder_main);
                        $zip->close();
                    } else {
                        $this->customlog->write_log($product_zip_path . "file not extracted", "newlog");
                        $this->customlog->write_log(date('y-m-d h:i:s') . " Exit from the function", "newlog");
                        $this->comman_model->update_column("import_requests", array("id" => $request_data['id']), array("status" => "2"));
                        exit;
                    }

                    $images_folder = $product_folder_main . "/images";
                    $images_folder_zip = $product_folder_main . "/" . $request_data['zip_real_name'] . "/images";
                    if (file_exists($images_folder)) {
                        // if images folder in the zip is not exist than function return error.
                        $product_folder_images = $images_folder;
                    } else if (file_exists($images_folder_zip)) {
                        // if images folder in the zip is not exist than function return error.
                        $product_folder_images = $images_folder_zip;
                    } else {
                        // if images folder in the zip is not exist than function return error.
                        $product_folder_images = $images_folder_zip;
                    }

                    if (!file_exists($product_folder_images)) {
                        // if images folder in the zip is not exist than function return error.
                        $this->customlog->write_log($product_folder_images . "folder  not exist", "newlog");
                        $this->customlog->write_log(date('y-m-d h:i:s') . " Exit from the function", "newlog");
                        $this->comman_model->update_column("import_requests", array("id" => $request_data['id']), array("status" => "2"));
                        exit;
                    }
                } else {

                    $images_folder = "";
                    $images_folder_zip = "";
                    $product_folder_images = "";
                }

                // Extract zip process is done

                // this function import csv data in the database and return status
                $csv_update = $this->import_csv_data($product_csv_path, $product_folder_images, $request_data['id'], $log_file);
               
                if ($csv_update['status'] == 1) {
                    // this code executed when csv data is uploaded successfully
                    $this->auto_packing_boxes();
                    // this function delete zip file  after upload
                    unlink($product_zip_path);
                    unlink($product_csv_path);

                    if ($product_folder_images != "") {
                        // this function delete images folder after upload
                        $this->deleteDir($product_folder_images);
                    }

                    $this->customlog->write_log($product_csv_path . "rows iterated =>" . $csv_update['rowsiterated'] . " " . "rows created =>" . $csv_update['recordscreated'] . " file  data scuccefully here are logs", "newlog");

                    // this function return success message in json format
                    $this->customlog->write_log($product_csv_path . "file  data scuccefully added", "newlog");
                    $this->customlog->write_log(date('y-m-d h:i:s') . " Exit from the function", "newlog");

                    $this->comman_model->update_column("import_requests", array("id" => $request_data['id']), array("status" => "2", "rowsiterated" => $csv_update['rowsiterated'], "productcreated" => $csv_update['recordscreated']));

                    exit;
                } else {
                    // this function return error message in json format when csv data is not uploaded successfully
                    $this->customlog->write_log($product_csv_path . "file  data not added added", "newlog");
                    $this->customlog->write_log(date('y-m-d h:i:s') . " Exit from the function", "newlog");
                    $this->comman_model->update_column("import_requests", array("id" => $request_data['id']), array("status" => "2"));
                    exit;
                }
            }
        } else {
            echo "esle 1";die;
            $this->customlog->write_log(date('y-m-d h:i:s') . " No Request Found Exit from the function", "newlog");
        }
    }

    /**
     * importValidation
     *
     * This Function set validation rule for the import csv row.
     * @return void
     */
    public function importValidation($import_data, $lineNumber, $request_id)
    {

        $_POST = "";
        $_POST = $import_data;
        $messages_array = '';
        $return_data = 1;

        //get validation messages and labels data
        $all_language_data = get_admin_lang_data(array('form_validation_instruction', 'admin_products'), $this->lang->default_lang_id);
        $validation_msg = $all_language_data['form_validation_instruction'];
        $admin_products = $all_language_data['admin_products'];

        $this->form_validation->set_rules('kgt_ref_number', $admin_products['kgt_ref_no']['front'], 'trim|required|alpha_numeric');
        $this->form_validation->set_rules('part_name', $admin_products['part_name']['front'], 'trim|required');
        $this->form_validation->set_rules('quantity', $admin_products['quantity']['front'], 'trim|required');
        $this->form_validation->set_rules('min_quantity', $admin_products['min_quantity']['front'], 'trim|required');
        //$this->form_validation->set_rules('quantity_threshold', $admin_products['quantity_threshold']['front'], 'trim|required|numeric');
        //$this->form_validation->set_rules('replenishment_order_number', $admin_products['replenishment_order_number']['front'], 'trim|required');
        //$this->form_validation->set_rules('replenishment_order_date', $admin_products['replenishment_order_date']['front'], 'trim|required');
        // $this->form_validation->set_rules('replenishing_period', $admin_products['replenishing_period']['front'], 'trim|required');
        // $this->form_validation->set_rules('replenishing_period_tolerance_range', $admin_products['replenishing_period_tolerance_range']['front'], 'trim|required|numeric');
        // $this->form_validation->set_rules('ex_stock_period', $admin_products['ex_stock_period']['front'], 'trim|required|numeric');
        // $this->form_validation->set_rules('price_cad', $admin_products['price_cad']['front'], 'trim|required');
        // $this->form_validation->set_rules('price_usd', $admin_products['price_usd']['front'], 'trim|required');
        // $this->form_validation->set_rules('price_tnd', $admin_products['price_tnd']['front'], 'trim|required');
        // $this->form_validation->set_rules('price_inr', $admin_products['price_inr']['front'], 'trim|required');
        // $this->form_validation->set_rules('price_eur', $admin_products['price_eur']['front'], 'trim|required');

        //$this->form_validation->set_rules('backorder_status', $admin_products['backorder_status']['front'], 'trim|required');
        //$this->form_validation->set_rules('price', $admin_products['price']['front'], 'trim|required');
        $this->form_validation->set_rules('item_height', $admin_products['item_height']['front'], 'trim|required');
        $this->form_validation->set_rules('item_width', $admin_products['item_width']['front'], 'trim|required');
        $this->form_validation->set_rules('item_length', $admin_products['item_length']['front'], 'trim|required');
        $this->form_validation->set_rules('item_weight', $admin_products['item_weight']['front'], 'trim|required');
        $this->form_validation->set_rules('item_nature_id', $admin_products['item_nature']['front'], 'trim|required');
        //  $this->form_validation->set_rules('shipping_special_notes', $admin_products['shipping_special_notes']['front'], 'trim|required');
        //$this->form_validation->set_rules('availability', $admin_products['availability']['front'], 'trim|required');
        //$this->form_validation->set_rules('availability_backorder_no', $admin_products['availability_backorder_no']['front'], 'trim|required');
        //$this->form_validation->set_rules('availability_max_msg', $admin_products['availability_max_msg']['front'], 'trim|required');
        // $this->form_validation->set_rules('unit_of_measurement', $admin_products['unit_of_measurement']['front'], 'trim|required');
        //  $this->form_validation->set_rules('country_origin', $admin_products['country_origin']['front'], 'trim|required');
        //$this->form_validation->set_rules('product_type_id', $admin_products['product_type_title']['front'], 'trim|required');

        // $this->form_validation->set_rules('vehicle_category_id', $admin_products['category_name']['front'], 'trim|required');
        //$this->form_validation->set_rules('maker_id', $admin_products['product_maker_name']['front'], 'trim|required');
        //$this->form_validation->set_rules('model_id', $admin_products['product_model_name']['front'], 'trim|required');
        //  $this->form_validation->set_rules('packageId', $admin_products['package_multiple']['front'], 'trim|required');

        $this->form_validation->set_message('required', $validation_msg['log_message_required']['front']);
        $this->form_validation->set_message('numeric', $validation_msg['log_message_numeric']['front']);
        if ($this->form_validation->run() === true) {

            $messages_array = '';
            $return_data = 1;

            // $packages = explode(",", $import_data['packageId']);
            // $item_width = $import_data['item_width'];
            // $item_length = $import_data['item_length'];
            // $item_weight = $import_data['item_weight'];
            // $item_height = $import_data['item_height'];
            // if ($packages) {

            //     // this function check is record exist in the table with number  or not.
            //     $exists = $this->package_model->check_validbox($packages, $item_height, $item_width, $item_length, $item_weight);

            //     if ($exists >= count($packages)) {
            //         // if exist than this code return false
            //         $messages_array = '';
            //         $return_data = 1;
            //     } else {
            //         $this->form_validation->reset_values();
            //         // if not  exist than this code return true
            //         $messages_array =  $validation_msg['log_package_message']['front'];
            //         $return_data = 0;
            //     }
            // } else {

            //     $this->form_validation->reset_values();
            //     $messages_array =  $validation_msg['log_package_message']['front'];
            //     $return_data = 0;
            // }
        } else {
            $errors = validation_errors();
            $errors = $this->form_validation->error_array();
            $inputs = json_encode($_POST);
            $error_array = json_encode($errors);
            $messages = array_values($errors);
            $messages_array = json_encode($messages);

            $this->customlog->write_log(date('y-m-d h:i:s') . " => " . $validation_msg['row_num']['front'] . " => " . $lineNumber . " " . $validation_msg['error_import']['front'] . " =>" . $error_array . " ", "newlog");
            $this->form_validation->reset_values();
            $messages_array = $messages_array;
            $return_data = 0;
        }

        if ($return_data == 0) {
            $this->customlog->write_log(date('y-m-d h:i:s') . " => " . $validation_msg['row_num']['front'] . " = " . $lineNumber . " , " . $validation_msg['error_import']['front'] . " = " . $messages_array . " ", "log_" . $request_id);
        }
        return $return_data;
    }

    /**
     * export_products
     *
     * This Function used to export products from store to marketplace.
     * @return void
     */
    public function export_products()
    {
        $db2 = $this->load->database('mainstore', true);
        $main_folder_path = getenv('MAIN_STORE_PATH');
        //echo "<pre>";
        $store_url = substr(getenv('ASSET_URL'), 0, -1);
        $db2->select("*");
        $db2->from('store');
        $db2->where(array("url" => $store_url, "status" => "1"));
        $store_details = $db2->get()->row_array();

        if ($store_details) {
            $store_id = $store_details['id'];

            $products_to_export = $this->comman_model->get_all_data_by_select("*", "products", array("display_kondarsoft" => "1", "pushed_status" => "0", "status" => "1", "quantity >" => "0"), 10);

            if (count($products_to_export) > 0) {

                if ($products_to_export) {

                    // product items master tables
                    $all_group_items = $this->comman_model->get_all_data_by_id("tbl_product_items", array("item_type" => "product_group"));

                    foreach ($all_group_items as $single_group_items) {

                        $db2->select("*");
                        $db2->from('tbl_product_items');
                        $db2->where(array("item_name" => $single_group_items['item_name'], "item_type" => "product_group"));
                        $item_group_db2_details = $db2->get()->row_array();

                        if ($item_group_db2_details) {
                            $group_item_id = $item_group_db2_details['id'];
                        } else {

                            unset($single_group_items['id']);
                            unset($single_group_items['created']);
                            $db2->insert('tbl_product_items', $single_group_items);
                            $group_item_id = $db2->insert_id();

                        }

                        $group_items[$single_group_items['id']] = $group_item_id;

                    }
                    // product items master tables

                    // print_r($products_to_export);
                    $product_ids = array_column($products_to_export, 'id');
                    //  print_r($product_ids);

                    foreach ($products_to_export as $single_product) {

                        $nature_details = $this->comman_model->get_data_by_id("tbl_product_natures", array("id" => $single_product['item_nature_id']));
                        // item nature check or add
                        if ($nature_details) {

                            $db2->select("*");
                            $db2->from('tbl_product_natures');
                            $db2->where(array("name" => $nature_details['name']));
                            $naturedb_details = $db2->get()->row_array();

                            if ($naturedb_details) {
                                $nature_id = $naturedb_details['id'];
                            } else {
                                $query = $db2->insert('tbl_product_natures', array("name" => $nature_details['name']));
                                $nature_id = $db2->insert_id();
                            }
                            //  echo "nature_id " . $nature_id;

                        }

                        $store_product_id = $single_product['id'];
                        // item nature check or add

                        $product_type_details = $this->comman_model->get_data_by_id("tbl_product_types", array("id" => $single_product['product_type_id']));

                        if ($product_type_details) {

                            $db2->select("*");
                            $db2->from('tbl_product_types');
                            $db2->where(array("product_type_name" => $product_type_details['product_type_name']));
                            $product_typedb_details = $db2->get()->row_array();

                            unset($product_type_details['id']);
                            unset($product_type_details['created_date']);
                            unset($product_type_details['modified_date']);
                            unset($product_type_details['vehicle_category_id']);

                            if ($product_typedb_details) {
                                $db2->where(array("id" => $product_typedb_details['id']));
                                $db2->update('tbl_product_types', $product_type_details);
                                $product_type_id = $product_typedb_details['id'];

                            } else {

                                $query = $db2->insert('tbl_product_types', $product_type_details);
                                $product_type_id = $db2->insert_id();

                            }

                            copy(FCPATH . '/assets/uploads/product_type_images/' . $product_type_details['Product_Type_Photo'], $main_folder_path . "/assets/uploads/product_type_images/" . $product_type_details['Product_Type_Photo']);

                            copy(FCPATH . '/assets/uploads/product_type_images/thumb/' . $product_type_details['Product_Type_Photo'], $main_folder_path . "/assets/uploads/product_type_images/thumb/" . $product_type_details['Product_Type_Photo']);

                            // echo "type id  " . $product_type_id;

                        }

                        if ($single_product) {

                            $db2->select("*");
                            $db2->from('products');
                            $db2->where(array("kgt_ref_number" => $single_product['kgt_ref_number']));
                            $product_db2_details = $db2->get()->row_array();

                            unset($single_product['id']);
                            unset($single_product['updated_date']);
                            unset($single_product['created_date']);
                            //unset($single_product['template']);
                            unset($single_product['distributor']);
                            unset($single_product['shipping_address']);

                            $single_product['product_type_id'] = $product_type_id;
                            $single_product['item_nature_id'] = $nature_id;
                            $single_product['store_id'] = $store_id;

                            if ($product_db2_details) {
                                $db2->where(array("id" => $product_db2_details['id']));
                                $db2->update('products', $single_product);
                                $product_id = $product_db2_details['id'];

                            } else {
                                $single_product['store_id'] = $store_id;

                                $query = $db2->insert('products', $single_product);
                                $product_id = $db2->insert_id();

                            }

                            $product_images = explode(",", $single_product['item_real_photo']);
                            foreach ($product_images as $single_image) {

                                copy(FCPATH . '/assets/uploads/product_images/'.$single_image, $main_folder_path."/assets/uploads/product_images/" . $single_image);

                                copy(FCPATH . '/assets/uploads/product_images/thumb/'.$single_image,$main_folder_path."/assets/uploads/product_images/thumb/" . $single_image);
                            }

                            // Product Details
                            $product_details = $this->comman_model->get_data_by_id("product_details", array("product_id" => $store_product_id));

                            if ($product_details) {

                                unset($product_details['id']);
                                unset($product_details['updated_date']);
                                unset($product_details['created_date']);

                                $db2->select("*");
                                $db2->from('product_details');
                                $db2->where(array("product_id" => $product_id));
                                $productdetails_db2 = $db2->get()->row_array();
                                if ($productdetails_db2) {
                                    $db2->where(array("product_id" => $product_id));
                                    $db2->update('product_details', $product_details);
                                    $product_id = $product_db2_details['id'];

                                } else {
                                    $product_details['product_id'] = $product_id;
                                    $db2->insert('product_details', $product_details);

                                }
                            }
                            // product Details End

                            // echo "product id  " . $product_id;

                        }

                        // Product Models

                        $this->db->select('product_models.*,tbl_models.model_name,tbl_models.serial_number,tbl_models.model_photo,tbl_makers.maker_name,tbl_makers.status as maker_status,tbl_models.status as model_status,tbl_makers.maker_logo,tbl_makers.vehicle_category_id as maker_cat,tbl_vehicle_categories.category_name,tbl_vehicle_categories.VehicleType_Photo,tbl_vehicle_categories.vehicle_category_icon,tbl_vehicle_categories.status as category_status,tbl_vehicle_categories.menu_image,tbl_vehicle_categories.industries,industries.name as industryname,industries.description as industries_desc,industries.icon as industries_img,industries.status as indust_status');
                        $this->db->from('product_models');
                        $this->db->join('tbl_makers', 'tbl_makers.id = product_models.maker_id');
                        $this->db->join('tbl_models', 'tbl_models.id = product_models.model_id');
                        $this->db->join('tbl_vehicle_categories', 'tbl_vehicle_categories.id = product_models.category_id');
                        $this->db->join('industries', 'industries.id = tbl_vehicle_categories.industries');
                        $this->db->where('product_models.product_id', $store_product_id);
                        $all_product_models = $this->db->get()->result_array();

                        $industries[$industry_col] = $industry_id;

                        foreach ($all_product_models as $singlemodel) {

                            // industries check
                            if ($singlemodel['industries']) {
                                if (array_key_exists($singlemodel['industries'], $industries)) {
                                    $industry_id = $industries[$singlemodel['industries']];
                                } else {
                                    $db2->select("*");
                                    $db2->from('industries');
                                    $db2->where(array("name" => trim($singlemodel['industryname'])));
                                    $indust_db2_details = $db2->get()->row_array();

                                    $indust_data['description'] = $singlemodel['industries_desc'];
                                    $indust_data['icon'] = $singlemodel['industries_img'];
                                    $indust_data['status'] = $singlemodel['indust_status'];
                                    $indust_data['name'] = $singlemodel['industryname'];

                                    if ($indust_db2_details) {
                                        $db2->where(array("id" => $indust_db2_details['id']));
                                        $db2->update('industries', $indust_data);
                                        $industry_id = $product_typedb_details['id'];

                                    } else {

                                        $query = $db2->insert('industries', $indust_data);
                                        $industry_id = $db2->insert_id();

                                    }

                                    copy(FCPATH . '/assets/uploads/industries/' . $singlemodel['industries_img'], $main_folder_path . "/assets/uploads/industries/" . $singlemodel['industries_img']);

                                    copy(FCPATH . '/assets/uploads/industries/thumb/' . $singlemodel['industries_img'], $main_folder_path . "/assets/uploads/industries/thumb/" . $singlemodel['industries_img']);

                                    $industries[$singlemodel['industries']] = $industry_id;

                                }

                                // echo "indust id  " . $industry_id;

                            }

                            // Categories check
                            if ($singlemodel['category_id']) {
                                if (array_key_exists($singlemodel['category_id'], $categories)) {
                                    $category_id = $categories[$singlemodel['category_id']];
                                } else {
                                    $db2->select("*");
                                    $db2->from('tbl_vehicle_categories');
                                    $db2->where(array("category_name" => trim($singlemodel['category_name'])));
                                    $cat_db2_details = $db2->get()->row_array();

                                    $cat_data['industries'] = $industry_id;
                                    $cat_data['menu_image'] = $singlemodel['menu_image'];
                                    $cat_data['vehicle_category_icon'] = $singlemodel['vehicle_category_icon'];
                                    $cat_data['VehicleType_Photo'] = $singlemodel['VehicleType_Photo'];
                                    $cat_data['category_name'] = $singlemodel['category_name'];
                                    $cat_data['status'] = $singlemodel['category_status'];

                                    if ($cat_db2_details) {
                                        $db2->where(array("id" => $cat_db2_details['id']));
                                        $db2->update('tbl_vehicle_categories', $cat_data);
                                        $category_id = $cat_db2_details['id'];

                                    } else {

                                        $query = $db2->insert('tbl_vehicle_categories', $cat_data);
                                        $category_id = $db2->insert_id();

                                    }

                                    copy(FCPATH . '/assets/uploads/vehicle_categories/' . $singlemodel['vehicle_category_icon'], $main_folder_path . "/assets/uploads/vehicle_categories/" . $singlemodel['vehicle_category_icon']);

                                    copy(FCPATH . '/assets/uploads/vehicle_categories/thumb/' . $singlemodel['vehicle_category_icon'], $main_folder_path . "/assets/uploads/vehicle_categories/thumb/" . $singlemodel['vehicle_category_icon']);

                                    copy(FCPATH . '/assets/uploads/vehicle_categories/' . $singlemodel['VehicleType_Photo'], $main_folder_path . "/assets/uploads/vehicle_categories/" . $singlemodel['VehicleType_Photo']);

                                    copy(FCPATH . '/assets/uploads/vehicle_categories/thumb/' . $singlemodel['VehicleType_Photo'], $main_folder_path . "/assets/uploads/vehicle_categories/thumb/" . $singlemodel['VehicleType_Photo']);

                                    $categories[$singlemodel['category_id']] = $category_id;

                                }

                                // echo "CAtegory id  " . $category_id;

                            }

                            // Makers check
                            if ($singlemodel['maker_id']) {
                                if (array_key_exists($singlemodel['maker_id'], $makers)) {
                                    $maker_id = $makers[$singlemodel['maker_id']];
                                } else {
                                    $db2->select("*");
                                    $db2->from('tbl_makers');
                                    $db2->where(array("maker_name" => trim($singlemodel['maker_name'])));
                                    $maker_db2_details = $db2->get()->row_array();

                                    $mak_data['maker_logo'] = $singlemodel['maker_logo'];
                                    $mak_data['status'] = $singlemodel['maker_status'];
                                    $mak_data['maker_name'] = $singlemodel['maker_name'];

                                    if ($maker_db2_details) {
                                        $cat_make = explode(",", $maker_db2_details["vehicle_category_id"]);
                                        if (in_array($category_id, $cat_make)) {

                                            $mak_data['vehicle_category_id'] = $maker_db2_details["vehicle_category_id"];

                                        } else {

                                            array_push($cat_make, $category_id);
                                            $mak_data['vehicle_category_id'] = implode(",", $cat_make);

                                        }

                                        $db2->where(array("id" => $maker_db2_details['id']));
                                        $db2->update('tbl_makers', $mak_data);
                                        $maker_id = $maker_db2_details['id'];

                                    } else {
                                        $mak_data['vehicle_category_id'] = $category_id;

                                        $query = $db2->insert('tbl_makers', $mak_data);
                                        $maker_id = $db2->insert_id();

                                    }

                                    copy(FCPATH .'/assets/uploads/product_maker/' . $singlemodel['maker_logo'], $main_folder_path . "/assets/uploads/product_maker/" . $singlemodel['maker_logo']);

                                    copy(FCPATH .'/assets/uploads/product_maker/thumb/' . $singlemodel['maker_logo'], $main_folder_path . "/assets/uploads/product_maker/thumb/" . $singlemodel['maker_logo']);

                                    $makers[$singlemodel['maker_id']] = $maker_id;

                                }

                                // echo "Maker id  " . $maker_id;

                            }

                            // Models check
                            if ($singlemodel['model_id']) {
                                if (array_key_exists($singlemodel['model_id'], $models)) {
                                    $model_id = $models[$singlemodel['model_id']];
                                } else {
                                    $db2->select("*");
                                    $db2->from('tbl_models');
                                    $db2->where(array("model_name" => trim($singlemodel['model_name'])));
                                    $model_db2_details = $db2->get()->row_array();

                                    $model_data['model_name'] = $singlemodel['model_name'];
                                    $model_data['status'] = $singlemodel['model_status'];
                                    $model_data['serial_number'] = $singlemodel['serial_number'];
                                    $model_data['model_photo'] = $singlemodel['model_photo'];
                                    $model_data['vehicle_category_id'] = $category_id;
                                    $model_data['maker_id'] = $maker_id;

                                    if ($model_db2_details) {
                                        $db2->where(array("id" => $model_db2_details['id']));
                                        $db2->update('tbl_models', $model_data);
                                        $model_id = $model_db2_details['id'];

                                    } else {

                                        $query = $db2->insert('tbl_models', $model_data);
                                        $model_id = $db2->insert_id();

                                    }

                                    copy(FCPATH . '/assets/uploads/product_model/' . $singlemodel['model_photo'], $main_folder_path . "/assets/uploads/product_model/" . $singlemodel['model_photo']);

                                    copy(FCPATH . '/assets/uploads/product_model/thumb/' . $singlemodel['model_photo'], $main_folder_path . "/assets/uploads/product_model/thumb/" . $singlemodel['model_photo']);

                                    $models[$singlemodel['model_id']] = $model_id;

                                }

                                //  echo "Model id  " . $model_id;

                            }

                            // Combinations check
                            $db2->select("*");
                            $db2->from('product_models');
                            $db2->where(array("product_id" => $product_id, "category_id" => $category_id, "maker_id" => $maker_id, "model_id" => $model_id));
                            $product_model_com_data = $db2->get()->row_array();
                            if ($product_model_com_data) {

                            } else {
                                $db2->insert('product_models', array("product_id" => $product_id, "category_id" => $category_id, "maker_id" => $maker_id, "model_id" => $model_id));

                            }

                            $models_groups = array(
                                'model_id' => $model_id,
                                'category_id' => $category_id,
                                'maker_id' => $maker_id,
                                'product_type_id' => $product_type_id,
                                'status' => 1,
                            );

                            $db2->select("*");
                            $db2->from('model_groups');
                            $db2->where($models_groups);
                            $model_group_count = $db2->get()->row_array();
                            if ($model_group_count) {

                            } else {
                                $db2->insert('model_groups', $models_groups);

                            }

                        }

                        //  product Attributes

                        $product_attributes = $this->comman_model->get_all_data_by_id("product_attributes", array("product_id" => $store_product_id));

                        foreach ($product_attributes as $single_attr_value) {

                            unset($single_attr_value['id']);
                            unset($single_product['created_date']);

                            // Combinations check
                            $db2->select("*");
                            $db2->from('product_attributes');
                            $db2->where(array("product_id" => $product_id, "item_id" => $group_items[$single_attr_value['item_id']], "value" => $single_attr_value['value']));
                            $product_model_com_data = $db2->get()->row_array();
                            if ($product_model_com_data) {

                            } else {
                                $db2->insert('product_attributes', array("product_id" => $product_id, "item_id" => $group_items[$single_attr_value['item_id']], "value" => $single_attr_value['value']));

                            }

                            $db2->select("*");
                            $db2->from('tbl_product_types');
                            $db2->where(array("id" => $product_type_id));
                            $product_type_priviliages = $db2->get()->row_array();
                            if ($product_type_priviliages) {
                                $front_priv = explode(",", $product_type_priviliages['menu_privilages']);
                                $admin_priv = explode(",", $product_type_priviliages['menu_privilages_admin']);
                                if (in_array($group_items[$single_attr_value['item_id']], $front_priv)) {

                                } else {
                                    array_push($front_priv, $group_items[$single_attr_value['item_id']]);
                                }

                                if (in_array($group_items[$single_attr_value['item_id']], $admin_priv)) {

                                } else {
                                    array_push($admin_priv, $group_items[$single_attr_value['item_id']]);

                                }

                                $db2->where(array("id" => $product_typedb_details['id']));
                                $db2->update('tbl_product_types', array("menu_privilages"=>implode(",",$front_priv),"menu_privilages_admin"=>implode(",",$admin_priv)));

                            }

                        }
                        //  product Attributes END

                        //  product Model  Attributes

                        $product_model_items = $this->comman_model->get_all_data_by_id("product_items", array("product_id" => $store_product_id));
//			echo '<pre>';print_r($product_model_items);print_r($models);echo '</pre>';
                        foreach ($product_model_items as $single_model_item) {

                            unset($single_model_item['id']);
                            unset($single_model_item['created_date']);
                            unset($single_model_item['product_id']);
                            $single_model_item['product_id'] = $product_id;
                            $single_model_item['model_id'] = $models[$single_model_item['model_id']];

                            // Combinations check
                            $db2->select("*");
                            $db2->from('product_items');
                            $db2->where($single_model_item);
                            $single_model_item_data = $db2->get()->row_array();
                            if ($single_model_item_data) {

                            } else {
                                $db2->insert('product_items', $single_model_item);

                            }

                            // Model Engines
                            $engine_years = array(
                                'model_id' => $single_model_item['model_id'],
                                'years' => $single_model_item['value'],
                                "engine_size" => $single_model_item['engine_size'],
                                'status' => 1,
                            );

                            $db2->select("*");
                            $db2->from('model_engines');
                            $db2->where($engine_years);
                            $model_engines_count = $db2->get()->row_array();
                            if ($model_engines_count) {

			    } else {

				if($single_model_item['model_id']){
	                            $db2->insert('model_engines', $engine_years);
				}

                            }

                            // Model Engines Group
                            $model_engines_groups = array(
                                'model_id' => $single_model_item['model_id'],
                                'years' => $single_model_item['value'],
                                "engine_size" => $single_model_item['engine_size'],
                                'product_type_id' => $product_type_id,
                                'status' => 1,
                            );

                            $db2->select("*");
                            $db2->from('model_engines_groups');
                            $db2->where($model_engines_groups);
                            $model_engines_groups_data = $db2->get()->row_array();
                            // echo $db2->last_query();

                            if ($model_engines_groups_data) {

			    } else {
				if($single_model_item['model_id']){
	                                $db2->insert('model_engines_groups', $model_engines_groups);
				}
                                // echo $db2->last_query();
                            }

                        }

                        //  product Model  Attributes end
                        $this->comman_model->update_where("products", array("pushed_status " => "1"), array("id" => $store_product_id));
                        echo $store_product_id . " product exported to marketplace <br>";

                    }

                    exit;
                }

            } else {

                echo "Export product funcion run and products not available to export";
                $this->customlog->write_log(date('y-m-d h:i:s') . " Export product funcion run and products not available to export", "exportproduct");
                exit;

            }

        } else {
            echo "Export product funcion run and store not register on marketplace";
            $this->customlog->write_log(date('y-m-d h:i:s') . " Export product funcion run and store not register on marketplace", "exportproduct");
            exit;
        }

        exit;
    }

    /**
     * Method marketplace_export
     * This Function Display import product form. This Function just handle view only.
     * @return void
     */
    public function marketplace_export()
    {
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('marketplace_export');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'admin_title', 'admin_importdata'), $this->lang->default_lang_id);

        $plang = $this->comman_model->getPrimaryLang();

        $userLangData = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {

            $selected_products = $this->input->post('selected_products');
            $product_id = $this->input->post('product_id');

            $limit = $this->input->post('limit');

            $data = array('');
            if (!empty($selected_products)) {
                $query = $this->product_model->updateDisplayOnKondarsoft($product_id, $limit, 1, $selected_products);
            } else {
                $query = $this->product_model->updateDisplayOnKondarsoft($product_id, $limit, 0, $selected_products);
            }
            if ($query) {
                $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);

                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/importdata/marketplace_export');
            } else {

                $error_lang = isset($userLangData['form_validation_instruction']['client_logo']['front']) ? (object) $userLangData['form_validation_instruction']['client_logo']['front'] : 'Unable to update data.';
                $this->session->set_flashdata('error', $error_lang);
                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/importdata/marketplace_export');
            }
        }

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login' => $this->session->all_userdata(),
            'title' => get_page_title('marketplace_export', 'admin_title'),
            'admin_title' => $all_language_data['admin_title'],
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'marketplace_export',
            'sub_menu' => 'marketplace_export',
            'addscripts' => 'add_users',
            'form_validation_instruction' => (object) $userLangData['form_validation_instruction'],
            'primary_lang' => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data' => $this->session->userdata('admin_validuser_data'),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links' => $all_language_data['admin_static_links'],
            'admin_products' => $all_language_data['admin_products'],
            'admin_importdata' => $all_language_data['admin_importdata'],
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/import/marketplace_export', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method auto_packing_boxes
     *
     * @return void
     */
    public function auto_packing_boxes()
    {

        $empty_products = $this->comman_model->get_all_data_by_limit("products", array("packageId" => ""));
        $log_file = '';
        //echo count($empty_products);
       // exit;
        if (!empty($empty_products)) {

            $p_count = count($empty_products);
            $this->customlog->write_log(date('y-m-d h:i:s') . " total " . $p_count . " products ", "packagelog");
            foreach ($empty_products as $current_product) {
                $prd_packages = $this->package_model->single_valid_box($current_product['item_height'], $current_product['item_width'], $current_product['item_length'], $current_product['item_weight']);

                if (!empty($prd_packages)) {
                    $package_id = $prd_packages['package_code'];
                } else {
                    $box_height = $current_product['item_height'] * 1.5;
                    $box_length = $current_product['item_length'] * 1.5;
                    $box_width = $current_product['item_width'] * 1.5;
                    $box_weight = $current_product['item_weight'] * 2;
                    $box_empty = $current_product['item_weight'] / 5;

                    $uniq_number = generate_rand_no();

                    $package_data = array(
                        'packagename' => "Box-" . $box_length . "*" . $box_width . "*" . $box_height,
                        'package_code' => $uniq_number,
                        'emptyweight' => $box_empty,
                        'innerwidth' => $box_width,
                        'innerlength' => $box_length,
                        'innerdepth' => $box_height,
                        'maxweight' => $box_weight,
                    );
                    // this function add  record in the database.
                    $package_id = $this->comman_model->add('package', $package_data);
                    if (!empty($package_id)) {
                        $package_id = $uniq_number;
                    } else {
                        $package_id = "";
                    }
                }

                if (!empty($package_id)) {
                    $updateData = array('packageId' => $package_id);
                    $dbCondition = array('id' => $current_product['id']);
                    $this->comman_model->update_column('products', $dbCondition, $updateData);
                }
            }
        } else {

            $this->customlog->write_log(date('y-m-d h:i:s') . " No Request Found Exit from the function", "packagelog");
        }
    }

    public function resize_all_images()
    {
        $this->load->library('image_lib');
        $uploadsdirectory = FCPATH . '/assets/uploads/';

        $maindirectory = $uploadsdirectory . 'product_model';

        $allfiles = array_diff(scandir($maindirectory), array('.', '..'));
        // echo "<pre>";
        // print_r($allfiles);
        foreach ($allfiles as $singlefile) {

            // echo $singlefile;
            //  resize_main($maindirectory, $singlefile, 400, 400);

            // echo $singlefile;
            // resize_main($maindirectory, $singlefile, 400, 400);

            do_resize($maindirectory, $singlefile, 140, 90);
        }
    }

    /*************  Function to set categories of products table  after change the category on model  */
    public function set_categories_maker_of_product()
    {

        $allmodels = $this->comman_model->get_all_data_by_id("tbl_models", array('status' => "1"));
        $allmakers = $this->comman_model->get_all_data_by_id("tbl_makers", array('status' => "1"));
        $valid_makers = array();
        foreach ($allmakers as $singlemaker) {

            $valid_makers[] = $singlemaker['id'];
        }
        $valid_model = array();

        foreach ($allmodels as $singlemodel) {
            $valid_model[] = $singlemodel['id'];
        }

        $valid_model = array_unique($valid_model);
        $valid_makers = array_unique($valid_makers);

        $all_products = $this->comman_model->all_data("tbl_product_category_maker_model_relation");

        foreach ($all_products as $products) {

            $p_cat = array();
            $p_maker = array();
            $updatedata = array();
            $wherearray = array();
            $model_ids = explode(",", $products['model_id']);

            $model_ids = array_intersect($model_ids, $valid_model);

            $this->db->where_in('id', $model_ids);
            $query = $this->db->get("tbl_models");
            $models_data = $query->result_array();
            foreach ($models_data as $single_model) {
                $p_cat[] = $single_model['vehicle_category_id'];
                $p_maker[] = $single_model['maker_id'];
            }

            $p_maker = array_intersect($p_maker, $valid_makers);

            $updatedata['vehicle_category_id'] = implode(",", array_unique($p_cat));
            $updatedata['maker_id'] = implode(",", array_unique($p_maker));
            $updatedata['model_id'] = implode(",", array_unique($model_ids));

            $wherearray['id'] = $products['id'];
            $this->comman_model->update_where("tbl_product_category_maker_model_relation", $updatedata, $wherearray);
            // echo  $this->db->last_query();
            // echo "<br>";
            // exit;

        }
    }

    public function check_eagle_products()
    {
        $importfilePath = FCPATH . '/assets/uploads/InventoryControlReport.csv';

        // Read uploaded CSV file
        $handle = fopen($importfilePath, "r");
        // Optionally, you can keep the number of the line where
        // the loop its currently iterating over
        $raw_string_header = fgets($handle);
        $rowheader = str_getcsv($raw_string_header);
        // Match column and make a new sheet
        $csvHandleResult = fopen(FCPATH . '/assets/uploads/result.csv', "w");
        while (($raw_string = fgets($handle)) !== false) {

            $row = str_getcsv($raw_string);

            $produt_number_col = $this->clean($row['0']);

            if (!empty($produt_number_col)) {

                $crosssql = "select value from tbl_product_item_relation_dropdown where product_item_id=149 and value='" . $produt_number_col . "' ";
                $cross_ref_rows = $this->db->query($crosssql)->result_array();

                $productsql = "select kgt_ref_number,id from tbl_product_category_maker_model_relation where  kgt_ref_number='" . $produt_number_col . "' ";
                $products_rows = $this->db->query($productsql)->result_array();

                if (!empty($products_rows)) {

                    foreach ($products_rows as $single_product_row) {

                        $matched_row_cross = array();
                        $matched_row_cross[] = trim($produt_number_col);
                        $matched_row_cross[] = trim($single_product_row['kgt_ref_number']);
                        $matched_row_cross[] = trim($single_product_row['id']);
                        fputcsv($csvHandleResult, $matched_row_cross);
                    }

                }

                if (!empty($cross_ref_rows)) {

                    foreach ($cross_ref_rows as $single_cross_row) {

                        $matched_row_cross = array();
                        $matched_row_cross[] = trim($produt_number_col);
                        $matched_row_cross[] = trim($single_cross_row['value']);
                        $matched_row_cross[] = trim($single_cross_row['id']);

                        fputcsv($csvHandleResult, $matched_row_cross);
                    }

                }

            }

        }
        fclose($csvHandleResult);

    }

    public function create_productgroup($offset = 0)
    {

        // $range_groups =  range(1,28);
        // $products_type_details = array();

        // // create product groups
        // foreach ($range_groups as $single_number) {

        // $products_type_details[] = array(
        // 'product_type_name' => "Group ".$single_number,
        // 'Product_Type_Photo' => "",
        // 'menu_privilages' => "149,166",
        // 'menu_privilages_admin' => "149,166",
        // 'status'=>1,
        // 'in_stock'=>1
        // );

        // }

        // $this->db->insert_batch('tbl_product_types', $products_type_details);

        $this->db->select("id");
        $this->db->where('product_type_id', "");
        $this->db->limit(100000, $offset);
        $product_query = $this->db->get("products");
        $all_products = $product_query->result_array();

        $i = 1;
        foreach ($all_products as $single_partnumber) {
            if ($i > 28) {
                $i = 1;
            }

            $updatedata['product_type_id'] = $i;
            $wherearray['id'] = $single_partnumber['id'];
            $this->comman_model->update_where("products", $updatedata, $wherearray);

            $i++;
        }

        exit;
    }

    public function bmw_import($offset = 0)
    {

        $this->db->order_by('id', "asc");
        $this->db->where('maker_id', "349");
        $model_query = $this->db->get("tbl_models");
        $all_models = $model_query->result_array();

        $products_query = "select id,kgt_ref_number from products where part_name like '%BMW'  order by id asc limit 100000 offset " . $offset;
        $all_products = $this->db->query($products_query)->result_array();

        $i = 1;
        $m = 1;

        foreach ($all_products as $singleproduct) {
            if ($i == 1 || $i > 42) {

                $i = 1;

            }

            if ($m == 1 || $m > 177) {

                $m = 1;
                $inserted_models = $all_models;
            }

            // echo "<pre>";
            // print_r($product_id);

            if ($singleproduct['id']) {
                $product_g_items = array();

                $rangeof_product_group = range(1, 10);
                foreach ($rangeof_product_group as $single_group) {

                    $product_g_items[] = array(
                        'product_id' => $singleproduct['id'],
                        'item_id' => "149",
                        'value' => $singleproduct['kgt_ref_number'] . " " . $single_group,
                        'status' => "1",
                    );
                }

                $this->db->insert_batch('product_attributes', $product_g_items);

                if ($inserted_models) {
                    $product_models = array();
                    $product_items = array();

                    foreach ($inserted_models as $single_model) {
                        $product_models[] = array(
                            'product_id' => $singleproduct['id'],
                            'category_id' => $single_model['vehicle_category_id'],
                            'maker_id' => $single_model['maker_id'],
                            'model_id' => $single_model['id'],
                            'status' => "1",
                        );
                        $start = 2023 - $i;
                        $end = 2022 - $i;
                        $single_year = $end . "-" . $start;

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 1",
                            'position' => "position 1",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );
                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 2",
                            'position' => "position 2",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 3",
                            'position' => "position 3",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 4",
                            'position' => "position 4",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                    }
                    $this->db->insert_batch('product_models', $product_models);
                    $this->db->insert_batch('product_items', $product_items);
                }
            }
            array_pop($inserted_models);
            $m++;
            $i++;
        }

    }

    public function mercedes_import($offset = 0)
    {

        $this->db->order_by('id', "asc");
        $this->db->where('maker_id', "300");
        $model_query = $this->db->get("tbl_models");
        $all_models = $model_query->result_array();

        $products_query = "select id,kgt_ref_number from products where part_name like '%Mercedes-Benz' and id not in (select product_id from product_models)  order by id asc limit 100000 offset " . $offset;
        $all_products = $this->db->query($products_query)->result_array();

        $i = 1;
        $m = 1;

        foreach ($all_products as $singleproduct) {
            if ($i == 1 || $i > 42) {

                $i = 1;

            }

            if ($m == 1 || $m > 203) {

                $m = 1;
                $inserted_models = $all_models;
            }

            // echo "<pre>";
            // print_r($product_id);

            if ($singleproduct['id']) {
                $product_g_items = array();

                $rangeof_product_group = range(1, 10);
                foreach ($rangeof_product_group as $single_group) {

                    $product_g_items[] = array(
                        'product_id' => $singleproduct['id'],
                        'item_id' => "149",
                        'value' => $singleproduct['kgt_ref_number'] . " " . $single_group,
                        'status' => "1",
                    );
                }

                $this->db->insert_batch('product_attributes', $product_g_items);

                if ($inserted_models) {
                    $product_models = array();
                    $product_items = array();

                    foreach ($inserted_models as $single_model) {
                        $product_models[] = array(
                            'product_id' => $singleproduct['id'],
                            'category_id' => $single_model['vehicle_category_id'],
                            'maker_id' => $single_model['maker_id'],
                            'model_id' => $single_model['id'],
                            'status' => "1",
                        );
                        $start = 2023 - $i;
                        $end = 2022 - $i;
                        $single_year = $end . "-" . $start;

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 1",
                            'position' => "position 1",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );
                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 2",
                            'position' => "position 2",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 3",
                            'position' => "position 3",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 4",
                            'position' => "position 4",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                    }
                    $this->db->insert_batch('product_models', $product_models);
                    $this->db->insert_batch('product_items', $product_items);
                }
            }
            array_pop($inserted_models);
            $m++;
            $i++;
        }

    }

    public function maserati_import($offset = 0)
    {

        $this->db->order_by('id', "asc");
        $this->db->where('maker_id', "341");
        $model_query = $this->db->get("tbl_models");
        $all_models = $model_query->result_array();

        $products_query = "select id,kgt_ref_number from products where part_name like '%Maserati'  order by id asc limit 150000 offset " . $offset;
        $all_products = $this->db->query($products_query)->result_array();

        $i = 1;

        foreach ($all_products as $singleproduct) {
            if ($i == 1 || $i > 42) {
                $i = 1;
            }

            $inserted_models = $all_models;

            // echo "<pre>";
            // print_r($product_id);

            if ($singleproduct['id']) {
                $product_g_items = array();

                $rangeof_product_group = range(1, 10);
                foreach ($rangeof_product_group as $single_group) {

                    $product_g_items[] = array(
                        'product_id' => $singleproduct['id'],
                        'item_id' => "149",
                        'value' => $singleproduct['kgt_ref_number'] . " " . $single_group,
                        'status' => "1",
                    );
                }

                $this->db->insert_batch('product_attributes', $product_g_items);

                if ($inserted_models) {
                    $product_models = array();
                    $product_items = array();

                    foreach ($inserted_models as $single_model) {
                        $product_models[] = array(
                            'product_id' => $singleproduct['id'],
                            'category_id' => $single_model['vehicle_category_id'],
                            'maker_id' => $single_model['maker_id'],
                            'model_id' => $single_model['id'],
                            'status' => "1",
                        );
                        $start = 2023 - $i;
                        $end = 2022 - $i;
                        $single_year = $end . "-" . $start;

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 1",
                            'position' => "position 1",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );
                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 2",
                            'position' => "position 2",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 3",
                            'position' => "position 3",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 4",
                            'position' => "position 4",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                    }
                    $this->db->insert_batch('product_models', $product_models);
                    $this->db->insert_batch('product_items', $product_items);
                }
            }

            $i++;
        }

    }

    public function volvo_import($offset = 0)
    {

        $this->db->order_by('id', "asc");
        $this->db->where('maker_id', "279");
        $model_query = $this->db->get("tbl_models");
        $all_models = $model_query->result_array();

        $products_query = "select id,kgt_ref_number from products where part_name like '%Volvo'  order by id asc limit 100000 offset " . $offset;
        $all_products = $this->db->query($products_query)->result_array();

        $i = 1;
        $m = 1;

        foreach ($all_products as $singleproduct) {
            if ($i == 1 || $i > 42) {

                $i = 1;

            }

            if ($m == 1 || $m > 43) {

                $m = 1;
                $inserted_models = $all_models;
            }

            // echo "<pre>";
            // print_r($product_id);

            if ($singleproduct['id']) {
                $product_g_items = array();

                $rangeof_product_group = range(1, 10);
                foreach ($rangeof_product_group as $single_group) {

                    $product_g_items[] = array(
                        'product_id' => $singleproduct['id'],
                        'item_id' => "149",
                        'value' => $singleproduct['kgt_ref_number'] . " " . $single_group,
                        'status' => "1",
                    );
                }

                $this->db->insert_batch('product_attributes', $product_g_items);

                if ($inserted_models) {
                    $product_models = array();
                    $product_items = array();

                    foreach ($inserted_models as $single_model) {
                        $product_models[] = array(
                            'product_id' => $singleproduct['id'],
                            'category_id' => $single_model['vehicle_category_id'],
                            'maker_id' => $single_model['maker_id'],
                            'model_id' => $single_model['id'],
                            'status' => "1",
                        );
                        $start = 2023 - $i;
                        $end = 2022 - $i;
                        $single_year = $end . "-" . $start;

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 1",
                            'position' => "position 1",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );
                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 2",
                            'position' => "position 2",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 3",
                            'position' => "position 3",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 4",
                            'position' => "position 4",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                    }
                    $this->db->insert_batch('product_models', $product_models);
                    $this->db->insert_batch('product_items', $product_items);
                }
            }
            array_pop($inserted_models);
            $m++;
            $i++;
        }

    }

    public function volkswagon_import($offset = 0)
    {

        $this->db->order_by('id', "asc");
        $this->db->where('maker_id', "316");
        $model_query = $this->db->get("tbl_models");
        $all_models = $model_query->result_array();

        $products_query = "select id,kgt_ref_number from products where part_name like '%VAG'  order by id asc limit 100000 offset " . $offset;
        $all_products = $this->db->query($products_query)->result_array();

        $i = 1;
        $m = 1;

        foreach ($all_products as $singleproduct) {
            if ($i == 1 || $i > 42) {

                $i = 1;

            }

            if ($m == 1 || $m > 40) {

                $m = 1;
                $inserted_models = $all_models;
            }

            // echo "<pre>";
            // print_r($product_id);

            if ($singleproduct['id']) {
                $product_g_items = array();

                $rangeof_product_group = range(1, 10);
                foreach ($rangeof_product_group as $single_group) {

                    $product_g_items[] = array(
                        'product_id' => $singleproduct['id'],
                        'item_id' => "149",
                        'value' => $singleproduct['kgt_ref_number'] . " " . $single_group,
                        'status' => "1",
                    );
                }

                $this->db->insert_batch('product_attributes', $product_g_items);

                if ($inserted_models) {
                    $product_models = array();
                    $product_items = array();

                    foreach ($inserted_models as $single_model) {
                        $product_models[] = array(
                            'product_id' => $singleproduct['id'],
                            'category_id' => $single_model['vehicle_category_id'],
                            'maker_id' => $single_model['maker_id'],
                            'model_id' => $single_model['id'],
                            'status' => "1",
                        );
                        $start = 2023 - $i;
                        $end = 2022 - $i;
                        $single_year = $end . "-" . $start;

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 1",
                            'position' => "position 1",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );
                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 2",
                            'position' => "position 2",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 3",
                            'position' => "position 3",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 4",
                            'position' => "position 4",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                    }
                    $this->db->insert_batch('product_models', $product_models);
                    $this->db->insert_batch('product_items', $product_items);
                }
            }
            array_pop($inserted_models);
            $m++;
            $i++;
        }

    }

    public function porsche_import($offset = 0)
    {

        $this->db->order_by('id', "asc");
        $this->db->where('maker_id', "289");
        $model_query = $this->db->get("tbl_models");
        $all_models = $model_query->result_array();

        $products_query = "select id,kgt_ref_number from products where part_name like '%Porshe'  order by id asc limit 100000 offset " . $offset;
        $all_products = $this->db->query($products_query)->result_array();

        $i = 1;
        $m = 1;

        foreach ($all_products as $singleproduct) {
            if ($i == 1 || $i > 42) {

                $i = 1;

            }

            if ($m == 1 || $m > 13) {

                $m = 1;
                $inserted_models = $all_models;
            }

            // echo "<pre>";
            // print_r($product_id);

            if ($singleproduct['id']) {
                $product_g_items = array();

                $rangeof_product_group = range(1, 10);
                foreach ($rangeof_product_group as $single_group) {

                    $product_g_items[] = array(
                        'product_id' => $singleproduct['id'],
                        'item_id' => "149",
                        'value' => $singleproduct['kgt_ref_number'] . " " . $single_group,
                        'status' => "1",
                    );
                }

                $this->db->insert_batch('product_attributes', $product_g_items);

                if ($inserted_models) {
                    $product_models = array();
                    $product_items = array();

                    foreach ($inserted_models as $single_model) {
                        $product_models[] = array(
                            'product_id' => $singleproduct['id'],
                            'category_id' => $single_model['vehicle_category_id'],
                            'maker_id' => $single_model['maker_id'],
                            'model_id' => $single_model['id'],
                            'status' => "1",
                        );
                        $start = 2023 - $i;
                        $end = 2022 - $i;
                        $single_year = $end . "-" . $start;

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 1",
                            'position' => "position 1",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );
                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 2",
                            'position' => "position 2",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 3",
                            'position' => "position 3",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 4",
                            'position' => "position 4",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                    }
                    $this->db->insert_batch('product_models', $product_models);
                    $this->db->insert_batch('product_items', $product_items);
                }
            }
            array_pop($inserted_models);
            $m++;
            $i++;
        }

    }

    public function jaguar_import($offset = 0)
    {

        $this->db->order_by('id', "asc");
        $this->db->where('maker_id', "290");
        $model_query = $this->db->get("tbl_models");
        $all_models = $model_query->result_array();

        $products_query = "select id,kgt_ref_number from products where part_name like '%JLR'  order by id asc limit 100000 offset " . $offset;
        $all_products = $this->db->query($products_query)->result_array();

        $i = 1;
        $m = 1;

        foreach ($all_products as $singleproduct) {
            if ($i == 1 || $i > 42) {

                $i = 1;

            }

            if ($m == 1 || $m > 24) {

                $m = 1;
                $inserted_models = $all_models;
            }

            // echo "<pre>";
            // print_r($product_id);

            if ($singleproduct['id']) {
                $product_g_items = array();

                $rangeof_product_group = range(1, 10);
                foreach ($rangeof_product_group as $single_group) {

                    $product_g_items[] = array(
                        'product_id' => $singleproduct['id'],
                        'item_id' => "149",
                        'value' => $singleproduct['kgt_ref_number'] . " " . $single_group,
                        'status' => "1",
                    );
                }

                $this->db->insert_batch('product_attributes', $product_g_items);

                if ($inserted_models) {
                    $product_models = array();
                    $product_items = array();

                    foreach ($inserted_models as $single_model) {
                        $product_models[] = array(
                            'product_id' => $singleproduct['id'],
                            'category_id' => $single_model['vehicle_category_id'],
                            'maker_id' => $single_model['maker_id'],
                            'model_id' => $single_model['id'],
                            'status' => "1",
                        );
                        $start = 2023 - $i;
                        $end = 2022 - $i;
                        $single_year = $end . "-" . $start;

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 1",
                            'position' => "position 1",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );
                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 2",
                            'position' => "position 2",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 3",
                            'position' => "position 3",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                        $product_items[] = array(
                            'product_id' => $singleproduct['id'],
                            'item_id' => "1",
                            'model_id' => $single_model['id'],
                            'value' => $single_year,
                            'engine_size' => "Engine 4",
                            'position' => "position 4",
                            'vehicle_attributes' => "Vehicle " . $single_year,
                            'application_notes' => "Notes " . $single_year,
                            'status' => "1",
                        );

                    }
                    $this->db->insert_batch('product_models', $product_models);
                    $this->db->insert_batch('product_items', $product_items);
                }
            }
            array_pop($inserted_models);
            $m++;
            $i++;
        }

    }

    public function delete_duplicate()
    {
        $delete_query = $this->db->query("select * from products where id not in (select max(id) from products group by kgt_ref_number)");
        $delete_records = $delete_query->result_array();

        $i = 1;
        foreach ($delete_records as $singgle_record) {

            $this->db->where('id', $singgle_record['id']);
            $this->db->delete("products");

            $this->db->where('product_id', $singgle_record['id']);
            $this->db->delete("product_details");

            $this->db->where('product_id', $singgle_record['id']);
            $this->db->delete("product_models");

            $this->db->where('product_id', $singgle_record['id']);
            $this->db->delete("product_items");
            $i++;
        }
        echo "Total Records Deleted :" . $i;
    }
    /*************  Function to set categories of products table  after change the category on model  */
    public function teileparts_import($old_id, $new_id, $offset = 0)
    {

        // Fetch products
        $this->db->order_by('id', "asc");
        $this->db->where('id >', '1693730');
        $this->db->where('maker_id', $old_id);
        $this->db->limit(100000);
        $query = $this->db->get("tbl_product_category_maker_model_relation");
        $all_products = $query->result_array();

        $this->db->order_by('id', "asc");
        $this->db->where('maker_id', $new_id);
        $model_query = $this->db->get("tbl_models");
        $all_models = $model_query->result_array();
        // echo "<pre>";
        // print_r($all_products);

        $i = 1;
        foreach ($all_products as $products) {

            $products_data = array(
                'kgt_ref_number' => $products['kgt_ref_number'],
                'part_name' => $products['part_name'],
                'quantity' => $products['quantity'],
                'min_quantity' => $products['min_quantity'],
                'backorder_status' => "1",
                'price' => $products['price_tnd'],
                'item_height' => $products['item_height'],
                'item_width' => $products['item_width'],
                'item_length' => $products['item_length'],
                'item_weight' => $products['item_weight'],
                'item_nature_id' => $products['item_nature_id'],
                'shipping_special_notes' => $products['shipping_special_notes'],
                'country_id' => "227",
                'item_real_photo' => $products['item_real_photo'],
                'item_schematic_photo' => $products['item_schematic_photo'],
                'item_schematic_photo_status' => $products['item_schematic_photo_status'],
                'display_kondarsoft' => "0",
                'product_type_id' => $products['product_type_id'],
                'packageId' => $products['packageId'],
                'display_kondarsoft' => $products['display_kondarsoft'],
                "pushed_status" => "0",
                'status' => "1",
            );
            $product_id = $this->comman_model->add('products', $products_data);
            // echo "<pre>";
            // print_r($product_id);

            if ($product_id) {

                $products_details = array(
                    'product_id' => $product_id,
                    'availability' => $products['availability'],
                    'availability_max_msg' => $products['availability_max_msg'],
                    'availability_backorder_no' => $products['availability_backorder_no'],
                    'replenishment_order_number' => $products['replenishment_order_number'],
                    'replenishment_order_date' => $products['replenishment_order_date'],
                    'replenishing_period' => $products['replenishing_period'],
                    'replenishing_period_tolerance_range' => $products['replenishing_period_tolerance_range'],
                    'ex_stock_period' => $products['ex_stock_period'],
                );
                $this->comman_model->add('product_details', $products_details);

                if ($product_id) {
                    $product_g_items = array();

                    $rangeof_product_group = range(1, 10);
                    foreach ($rangeof_product_group as $single_group) {

                        $product_g_items[] = array(
                            'product_id' => $product_id,
                            'item_id' => "149",
                            'model_id' => "",
                            'value' => $products['kgt_ref_number'] . " " . $single_group,
                            'engine_size' => " ",
                            'position' => " ",
                            'vehicle_attributes' => " ",
                            'application_notes' => " ",
                            'status' => "1",
                        );
                    }

                    $this->db->insert_batch('product_items', $product_g_items);

                    if ($all_models) {
                        $product_models = array();
                        $product_items = array();
                        $i = 1;
                        foreach ($all_models as $single_model) {
                            $product_models[] = array(
                                'product_id' => $product_id,
                                'category_id' => $single_model['vehicle_category_id'],
                                'maker_id' => $new_id,
                                'model_id' => $single_model['id'],
                                'status' => "1",
                            );
                            $start = 2023 - $i;
                            $end = 2022 - $i;

                            $rangeof_years = range($start, $end);
                            foreach ($rangeof_years as $single_year) {

                                $product_items[] = array(
                                    'product_id' => $product_id,
                                    'item_id' => "1",
                                    'model_id' => $single_model['id'],
                                    'value' => $single_year,
                                    'engine_size' => "Diesel " . $products['kgt_ref_number'] . " " . $i,
                                    'position' => "Front right " . $products['kgt_ref_number'] . " " . $i,
                                    'vehicle_attributes' => "2.7L, 6Cyl, 2693cc" . $products['kgt_ref_number'] . " " . $i,
                                    'application_notes' => "Diesel,Front,2693cc" . $products['kgt_ref_number'] . " " . $i,
                                    'status' => "1",
                                );
                            }

                            $i++;
                        }
                        $this->db->insert_batch('product_models', $product_models);
                        $this->db->insert_batch('product_items', $product_items);
                    }
                }
            }
        }
    }

    /*************  Function to set categories of products table  after change the category on model  */
    public function optimize_import()
    {
        exit;
        $db2 = $this->load->database('kondarsoft', true);

        // $this->db->limit(1);
        // $this->db->order_by('id', "desc");
        // $prduct_query = $this->db->get("products");
        // $prduct_data =  $prduct_query->row_array();

        // $this->db->limit(1);
        // if ($prduct_data['kgt_ref_number']) {
        //     $this->db->where('kgt_ref_number', $prduct_data['kgt_ref_number']);
        // }
        // $this->db->order_by('id', "asc");
        // $prduct_query = $this->db->get("tbl_product_category_maker_model_relation");
        // $prduct_data_rel =  $prduct_query->row_array();

        $this->db->limit(100000, 14381);
        // if ($prduct_data_rel['kgt_ref_number']) {
        //     $this->db->where('id >', $prduct_data_rel['id']);
        // }
        // $this->db->where('pushed_status', '0');
        $this->db->order_by('id', "asc");
        $query = $this->db->get("tbl_product_category_maker_model_relation");
        $all_products = $query->result_array();
        // echo "<pre>";
        // print_r($all_products);

        $i = 1;
        foreach ($all_products as $products) {

            if ($i > 14380) {
                $i = 1;
            }
            $products_data = array(
                'kgt_ref_number' => $products['kgt_ref_number'],
                'part_name' => $products['part_name'],
                'quantity' => $products['quantity'],
                'min_quantity' => $products['min_quantity'],
                'backorder_status' => "1",
                'price' => $products['price_tnd'],
                'item_height' => $products['item_height'],
                'item_width' => $products['item_width'],
                'item_length' => $products['item_length'],
                'item_weight' => $products['item_weight'],
                'item_nature_id' => $products['item_nature_id'],
                'shipping_special_notes' => $products['shipping_special_notes'],
                'country_id' => "227",
                'item_real_photo' => $products['item_real_photo'],
                'item_schematic_photo' => $products['item_schematic_photo'],
                'item_schematic_photo_status' => $products['item_schematic_photo_status'],
                'display_kondarsoft' => "0",
                'product_type_id' => $products['product_type_id'],
                'packageId' => $products['packageId'],
                'display_kondarsoft' => $products['display_kondarsoft'],
                "pushed_status" => "0",
                'status' => "1",
            );
            $product_id = $this->comman_model->add('products', $products_data);
            // echo "<pre>";
            // print_r($product_id);

            if ($product_id) {

                $products_details = array(
                    'product_id' => $product_id,
                    'availability' => $products['availability'],
                    'availability_max_msg' => $products['availability_max_msg'],
                    'availability_backorder_no' => $products['availability_backorder_no'],
                    'replenishment_order_number' => $products['replenishment_order_number'],
                    'replenishment_order_date' => $products['replenishment_order_date'],
                    'replenishing_period' => $products['replenishing_period'],
                    'replenishing_period_tolerance_range' => $products['replenishing_period_tolerance_range'],
                    'ex_stock_period' => $products['ex_stock_period'],
                );
                $this->comman_model->add('product_details', $products_details);

                if ($product_id) {

                    $this->db->where("product_id", $i);
                    $store_query = $this->db->get("product_models");
                    $model_data = $store_query->result_array();

                    if ($model_data) {
                        $product_models = array();
                        foreach ($model_data as $single_model) {
                            $product_models[] = array(
                                'product_id' => $product_id,
                                'category_id' => $single_model['category_id'],
                                'maker_id' => $single_model['maker_id'],
                                'model_id' => $single_model['id'],
                                'status' => "1",
                            );
                        }
                        $this->db->insert_batch('product_models', $product_models);
                    }
                }

                if ($product_id) {

                    $this->db->where("product_id", $i);
                    $item_query = $this->db->get("product_items");
                    $item_data = $item_query->result_array();
                    // echo $db2->last_query();
                    // echo "<br>";
                    // echo "<pre>";
                    // print_r($item_data);
                    // echo "<br>";

                    if ($item_data) {
                        $product_items = array();
                        foreach ($item_data as $single_item) {
                            $product_items[] = array(
                                'product_id' => $product_id,
                                'item_id' => $single_item['item_id'],
                                'model_id' => $single_item['model_id'],
                                'value' => $single_item['value'],
                                'engine_size' => $single_item['engine_size'],
                                'position' => $single_item['position'],
                                'vehicle_attributes' => $single_item['vehicle_attributes'],
                                'application_notes' => $single_item['application_notes'],
                                'status' => "1",
                            );
                        }
                        // echo "<pre>";
                        // print_r($product_items);
                        $this->db->insert_batch('product_items', $product_items);
                    }
                }
            }
            $i++;
        }
    }

    public function get_id_from_old()
    {

        $products_id = array();
        $this->db->select('products.id as newid,tbl_product_category_maker_model_relation.id as oldid');
        $this->db->from('products');
        $this->db->join('tbl_product_category_maker_model_relation', 'tbl_product_category_maker_model_relation.kgt_ref_number  = products.kgt_ref_number');
        //$this->db->limit(50);
        $query = $this->db->get();
        $records = $query->result_array();

        foreach ($records as $single_record) {
            $products_id[$single_record['oldid']] = $single_record['newid'];
        }

        return $products_id;
    }

    public function optimize_multiple_import()
    {

        $records = $this->get_id_from_old();
        $this->db->select('*');
        $this->db->from('tbl_product_item_relation_dropdown');
        // $this->db->limit(5);
        $query = $this->db->get();
        $dropdown_values = $query->result_array();

        foreach ($dropdown_values as $single_dropdown) {

            // echo "<pre>";
            // print_r($products);
            // echo "<br>";
            $new_id = $records[$single_dropdown['product_id']];

            if ($new_id) {
                $products_dropdown_data = array(
                    'product_id' => $new_id,
                    'item_id' => $single_dropdown['product_item_id'],
                    'model_id' => $single_dropdown['product_model_id'],
                    'value' => $single_dropdown['value'],
                    'engine_size' => $single_dropdown['engine_size'],
                    'position' => $single_dropdown['position'],
                    'vehicle_attributes' => $single_dropdown['vehicle_attributes'],
                    'application_notes' => $single_dropdown['application_notes'],
                    'status' => "1",
                );
                $this->comman_model->add('product_items', $products_dropdown_data);
            }
        }
    }

    public function optimize_single_import()
    {

        $records = $this->get_id_from_old();
        $this->db->select('*');
        $this->db->from('tbl_product_item_relation');
        $this->db->where('value !=', "dropdown");

        // $this->db->limit(5);
        $query = $this->db->get();
        $dropdown_values = $query->result_array();
        // echo "<pre>";
        // print_r($dropdown_values);
        // exit;

        foreach ($dropdown_values as $single_dropdown) {

            // echo "<pre>";
            // print_r($products);
            // echo "<br>";
            $new_id = $records[$single_dropdown['product_id']];
            if ($new_id) {

                $products_dropdown_data = array(
                    'product_id' => $new_id,
                    'item_id' => $single_dropdown['product_item_id'],
                    'model_id' => "",
                    'value' => $single_dropdown['value'],
                    'engine_size' => "",
                    'position' => "",
                    'vehicle_attributes' => "",
                    'application_notes' => "",
                    'status' => "1",
                );
                $this->comman_model->add('product_items', $products_dropdown_data);
            }
        }
    }

    /************** Auto Update groups  */
    public function update_models_group()
    {

        $query = "select * from tbl_models where status=1 and  id not in(select model_id from model_groups)";

        $all_models = $this->db->query($query)->result_array();

        foreach ($all_models as $single_model) {
            $this->db->select('distinct(P.product_type_id)');
            $this->db->from('product_models');
            $this->db->join('products as P', 'P.id= product_models.product_id', 'left');
            $this->db->where('product_models.model_id', $single_model['id']);

            $model_groups = array();

            $all_groups = $this->db->get()->result_array();

            foreach ($all_groups as $single_group) {

                $model_groups[] = array(
                    'product_type_id' => $single_group['product_type_id'],
                    'model_id' => $single_model['id'],
                    'maker_id' => $single_model['maker_id'],
                    'category_id' => $single_model['vehicle_category_id'],
                    'status' => "1",
                );
            }

            if (count($model_groups) > 0) {
                $this->db->insert_batch('model_groups', $model_groups);
            }
        }
    }

    /************** Auto Update groups price  */

    public function update_product_group_price()
    {

        $result_query = $this->db->query("select tbl_product_types.*,min(price) as price  from tbl_product_types join products on products.product_type_id = tbl_product_types.id where tbl_product_types.status=1  group by tbl_product_types.id;
        ");
        $result_records = $result_query->result_array();

        echo "<pre>";
        print_r($result_records);

        foreach ($result_records as $singgle_record) {

            // echo $singgle_record['id']." ".$singgle_record['price']."<br>";
            $this->db->where("id", $singgle_record['id']);
            $this->db->update("tbl_product_types", array('min_price' => $singgle_record['price']));

        }
    }
    /************** Auto Update groups engines  */

    public function update_models_engines()
    {
        $query = "select id from tbl_models where status=1 and  id not in( select model_id from model_engines group by model_id)";

        $all_models = $this->db->query($query)->result_array();

        foreach ($all_models as $single_model) {
            $this->db->select('product_items.value');
            $this->db->from('product_items');
            $this->db->where('product_items.model_id', $single_model['id']);
            $this->db->group_by('product_items.value');
            $all_years = $this->db->get()->result_array();

            $model_years = array();
            foreach ($all_years as $single_year) {

                $this->db->select('product_items.engine_size');
                $this->db->from('product_items');
                $this->db->where('product_items.model_id', $single_model['id']);
                $this->db->where('product_items.value', $single_year['value']);
                $this->db->group_by('product_items.engine_size');

                $all_engines = $this->db->get()->result_array();

                foreach ($all_engines as $single_engine) {
                    $this->db->select('count(*) as total');
                    $this->db->from('model_engines');
                    $this->db->where('model_engines.model_id', $single_model['id']);
                    $this->db->where('model_engines.years', $single_year['value']);
                    $this->db->where('model_engines.engine_size', $single_engine['engine_size']);
                    $total_engine = $this->db->get()->row_array();
                    $model_total_engine = $total_engine['total'];

                    if ($model_total_engine < 1) {

                        $model_years[] = array(
                            'model_id' => $single_model['id'],
                            'years' => $single_year['value'],
                            'engine_size' => $single_engine['engine_size'],
                            'status' => "1",
                        );

                    }

                }
            }

            if (count($model_years) > 0) {
                $this->db->insert_batch('model_engines', $model_years);
            }
        }
    }

    public function update_models_engines_group()
    {
        $query = "select product_type_id from model_groups where status=1 group by product_type_id; ";

        $all_groups = $this->db->query($query)->result_array();

        foreach ($all_groups as $single_group) {
            $this->db->select('model_groups.model_id');
            $this->db->from('model_groups');
            $this->db->where('model_groups.product_type_id', $single_group['product_type_id']);
            $this->db->group_by('model_groups.model_id');
            $all_models = $this->db->get()->result_array();

            foreach ($all_models as $single_models) {

                $this->db->select('*');
                $this->db->from('model_engines');
                $this->db->where('model_engines.model_id', $single_models['model_id']);
                $all_engines = $this->db->get()->result_array();

                foreach ($all_engines as $single_engine) {

                    $query_group = "select products.product_type_id  from products  join product_items on products.id=product_items.product_id  where product_items.value='" . $single_engine['years'] . "' and product_items.model_id='" . $single_engine['model_id'] . "' and product_items.engine_size='" . $single_engine['engine_size'] . "' and products.product_type_id='" . $single_group['product_type_id'] . "' limit 1";

                    $all_groups = $this->db->query($query_group)->result_array();

                    if (count($all_groups) > 0) {

                        $this->db->select('count(*) as total');
                        $this->db->from('model_engines_groups');
                        $this->db->where('model_engines_groups.model_id', $single_engine['model_id']);
                        $this->db->where('model_engines_groups.years', $single_engine['years']);
                        $this->db->where('model_engines_groups.engine_size', $single_engine['engine_size']);
                        $this->db->where('model_engines_groups.product_type_id', $single_group['product_type_id']);
                        $total_engine = $this->db->get()->row_array();
                        $model_total_engine_group = $total_engine['total'];

                        if ($model_total_engine_group < 1) {
                            $model_years_group = array(
                                'model_id' => $single_engine['model_id'],
                                'years' => $single_engine['years'],
                                'engine_size' => $single_engine['engine_size'],
                                'product_type_id' => $single_group['product_type_id'],
                                'status' => "1",
                            );
                            $this->db->insert('model_engines_groups', $model_years_group);

                        }

                    }
                }

            }
        }

    }

    /**************** Function to convert database from old format to new */
    public function all_import($offset = 0)
    {
        // Fetch products
        $this->db->order_by('id', "asc");
        $this->db->limit(100000, $offset);
        $query = $this->db->get("tbl_product_category_maker_model_relation");
        $all_products = $query->result_array();
        foreach ($all_products as $products) {

            $products_data = array(
                'kgt_ref_number' => $products['kgt_ref_number'],
                'part_name' => $products['part_name'],
                'quantity' => $products['quantity'],
                'min_quantity' => $products['min_quantity'],
                'backorder_status' => "1",
                'price' => $products['price_tnd'],
                'item_height' => $products['item_height'],
                'item_width' => $products['item_width'],
                'item_length' => $products['item_length'],
                'item_weight' => $products['item_weight'],
                'item_nature_id' => $products['item_nature_id'],
                'shipping_special_notes' => $products['shipping_special_notes'],
                'country_id' => "227",
                'item_real_photo' => $products['item_real_photo'],
                'item_schematic_photo' => $products['item_schematic_photo'],
                'item_schematic_photo_status' => $products['item_schematic_photo_status'],
                'display_kondarsoft' => "0",
                'product_type_id' => $products['product_type_id'],
                'packageId' => $products['packageId'],
                'display_kondarsoft' => $products['display_kondarsoft'],
                "pushed_status" => "0",
                'status' => "1",
            );
            $product_id = $this->comman_model->add('products', $products_data);
            // echo "<pre>";
            // print_r($product_id);

            if ($product_id) {

                $products_details = array(
                    'product_id' => $product_id,
                    'availability' => $products['availability'],
                    'availability_max_msg' => $products['availability_max_msg'],
                    'availability_backorder_no' => $products['availability_backorder_no'],
                    'replenishment_order_number' => $products['replenishment_order_number'],
                    'replenishment_order_date' => $products['replenishment_order_date'],
                    'replenishing_period' => $products['replenishing_period'],
                    'replenishing_period_tolerance_range' => $products['replenishing_period_tolerance_range'],
                    'ex_stock_period' => $products['ex_stock_period'],
                );
                $this->comman_model->add('product_details', $products_details);

                if ($product_id) {
                    $product_g_items = array();

                    $this->db->where('product_id', $products['id']);
                    $this->db->where('product_item_id', "149");
                    $cross_query = $this->db->get("tbl_product_item_relation_dropdown");
                    $all_cross = $cross_query->result_array();

                    if (count($all_cross) > 0) {

                        foreach ($all_cross as $single_cross) {

                            $product_g_items[] = array(
                                'product_id' => $product_id,
                                'item_id' => "149",
                                'value' => $single_cross['value'],
                                'status' => "1",
                            );

                        }

                        $this->db->insert_batch('product_attributes', $product_g_items);
                    }

                    $models_exist = explode(",", $products['model_id']);
                    $this->db->where_in('id', $models_exist);
                    $model_query = $this->db->get("tbl_models");
                    $all_models = $model_query->result_array();

                    if ($all_models) {
                        $product_models = array();
                        $product_items = array();
                        foreach ($all_models as $single_model) {
                            $product_models[] = array(
                                'product_id' => $product_id,
                                'category_id' => $single_model['vehicle_category_id'],
                                'maker_id' => $single_model['maker_id'],
                                'model_id' => $single_model['id'],
                                'status' => "1",
                            );

                            $this->db->where('product_id', $products['id']);
                            $this->db->where('product_model_id', $single_model['id']);
                            $this->db->where('product_item_id', "1");
                            $year_query = $this->db->get("tbl_product_item_relation_dropdown");
                            $all_years = $year_query->result_array();

                            if (count($all_years) > 0) {

                                foreach ($all_years as $single_year) {

                                    $product_items[] = array(
                                        'product_id' => $product_id,
                                        'item_id' => "1",
                                        'model_id' => $single_model['id'],
                                        'value' => $single_year['value'],
                                        'engine_size' => $single_year['engine_size'],
                                        'position' => $single_year['position'],
                                        'vehicle_attributes' => $single_year['vehicle_attributes'],
                                        'application_notes' => $single_year['application_notes'],
                                        'status' => "1",
                                    );
                                }
                            }
                        }
                        if (count($product_models) > 0) {

                            $this->db->insert_batch('product_models', $product_models);
                        }
                        if (count($product_items) > 0) {

                            $this->db->insert_batch('product_items', $product_items);
                        }
                    }
                }
            }
        }
    }

    public function update_cross()
    {
        // Fetch products
        $this->db->where('product_item_id', "149");
        $query = $this->db->get("tbl_product_item_relation_dropdown");
        $all_dropdown = $query->result_array();

        $records = $this->get_id_from_old();

        foreach ($all_dropdown as $single_dropdown) {

            $new_id = $records[$single_dropdown['product_id']];
            if ($new_id) {

                $product_g_items = array(
                    'product_id' => $new_id,
                    'item_id' => "149",
                    'value' => $single_dropdown['value'],
                    'status' => "1",
                );

                $this->db->insert('product_attributes', $product_g_items);

            }
        }

    }

    public function product_data_eagler()
    {

        $this->db->select('id');
        $this->db->where('id >', '946139');
        $allproducts = $this->db->get('products')->result_array();

        // echo "<pre>";
        // print_r($allproducts);
        // exit;

        $this->db->select('*');
        $this->db->from('product_details');
        $this->db->where('product_id', 1);
        $product_details = $this->db->get()->row_array();

        $this->db->select('*');
        $this->db->from('product_attributes');
        $this->db->where('product_id', 1);
        $all_attributes = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('product_models');
        $this->db->where('product_id', 1);
        $all_models = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('product_items');
        $this->db->where('product_id', 1);
        $all_items = $this->db->get()->result_array();

        // echo "<pre>";
        // print_r($dropdown_values);
        // exit;

        foreach ($allproducts as $single_product) {

            $product_models = array();
            $attributes = array();
            $product_items = array();

            // Details Data
            $detail_data = array(
                'product_id' => $single_product['id'],
                'availability' => $product_details['availability'],
                'quantity_threshold' => $product_details['quantity_threshold'],
                'availability_max_msg' => $product_details['availability_max_msg'],
                'availability_backorder_no' => $product_details['availability_backorder_no'],
                'replenishment_order_number' => $product_details['replenishment_order_number'],
                'replenishment_order_date' => $product_details['replenishment_order_date'],
                'replenishing_period' => $product_details['replenishing_period'],
                'replenishing_period_tolerance_range' => $product_details['replenishing_period_tolerance_range'],
                'ex_stock_period' => $product_details['ex_stock_period'],
            );
            $this->comman_model->add('product_details', $detail_data);

            foreach ($all_models as $single_model) {
                $product_models[] = array(
                    'product_id' => $single_product['id'],
                    'category_id' => $single_model['category_id'],
                    'maker_id' => $single_model['maker_id'],
                    'model_id' => $single_model['model_id'],
                    'status' => "1",
                );
            }
            if (count($product_models) > 0) {

                $this->db->insert_batch('product_models', $product_models);
            }
            foreach ($all_attributes as $single_att) {
                $attributes[] = array(
                    'product_id' => $single_product['id'],
                    'item_id' => "149",
                    'value' => $single_att['value'],
                    'status' => "1",
                );

            }
            if (count($attributes) > 0) {
                $this->db->insert_batch('product_attributes', $attributes);
            }

            foreach ($all_items as $single_item) {

                $product_items[] = array(
                    'product_id' => $single_product['id'],
                    'item_id' => $single_item['item_id'],
                    'model_id' => $single_item['model_id'],
                    'value' => $single_item['value'],
                    'engine_size' => $single_item['engine_size'],
                    'position' => $single_item['position'],
                    'vehicle_attributes' => $single_item['vehicle_attributes'],
                    'application_notes' => $single_item['application_notes'],
                    'status' => "1",
                );
            }
            if (count($product_items) > 0) {

                $this->db->insert_batch('product_items', $product_items);

            }

        }

    }

    public function product_group_eagler_update()
    {

        $this->db->select('id');
        $this->db->where('product_type_id', '');
        $this->db->limit(100000);
        $allproducts = $this->db->get('products')->result_array();

        // echo "<pre>";
        // print_r($allproducts);
        // exit;

        $i = 358;

        foreach ($allproducts as $single_product) {

            if ($i > 857) {
                $i = 358;
            }

            $this->db->where("id", $single_product['id']);
            $this->db->update("products", array('product_type_id' => $i));

            $i++;
        }

    }

    public function move_table_data()
    {

        $db2 = $this->load->database('kondarsoft', true);

        $db2->select('id');
        $db2->order_by('id', "desc");
        $db2->limit(1);
        $single_row = $db2->get('product_items')->row_array();
        // echo "<pre>";
        // print_r($single_row['id']);
        // exit;

        $this->db->select('*');
        $this->db->where('id >', $single_row['id']);
        $this->db->limit(1000000);
        $allproducts = $this->db->get('product_items')->result_array();

        $all_rows = array_chunk($allproducts, 100);

        $db3 = $this->load->database('kondarsoft', true);

        foreach ($all_rows as $all_items) {

            $product_items = array();

            foreach ($all_items as $single_item) {

                $product_items[] = array(
                    'id' => $single_item['id'],
                    'product_id' => $single_item['product_id'],
                    'item_id' => $single_item['item_id'],
                    'model_id' => $single_item['model_id'],
                    'value' => $single_item['value'],
                    'engine_size' => $single_item['engine_size'],
                    'position' => $single_item['position'],
                    'vehicle_attributes' => $single_item['vehicle_attributes'],
                    'application_notes' => $single_item['application_notes'],
                    'status' => "1",
                );
            }
            if (count($product_items) > 0) {

                //  echo "<pre>";
                // print_r($product_items);
                // exit;

                $db3->insert_batch('product_items', $product_items);

            }
        }
    }

    public function move_teileparts_data()
    {

        $this->db->select('*');
        $this->db->where('id >', 100);

        $allproducts = $this->db->get('products')->result_array();

        $db2 = $this->load->database('kondarsoft', true);

        foreach ($allproducts as $single_product) {

            $db2->select('*');
            $db2->where('product_id', $single_product['id']);
            $attributes = $db2->get('product_attributes')->result_array();

            $all_attributes = array();

            foreach ($attributes as $single_attribute) {

                $all_attributes[] = array(
                    'product_id' => $single_attribute['product_id'],
                    'item_id' => $single_attribute['item_id'],
                    'value' => $single_attribute['value'],
                );
            }
            if (count($all_attributes) > 0) {
                $this->db->insert_batch('product_attributes', $all_attributes);
            }

            $db2->select('*');
            $db2->where('product_id', $single_product['id']);
            $all_models = $db2->get('product_models')->result_array();

            $product_models = array();

            foreach ($all_models as $single_models) {

                $product_models[] = array(
                    'product_id' => $single_models['product_id'],
                    'category_id' => $single_models['category_id'],
                    'maker_id' => $single_models['maker_id'],
                    'model_id' => $single_models['model_id'],
                    'status' => $single_models['status'],
                );
            }
            if (count($product_models) > 0) {
                $this->db->insert_batch('product_models', $product_models);
            }

            $db2->select('*');
            $db2->where('product_id', $single_product['id']);
            $all_items = $db2->get('product_items')->result_array();

            $product_items = array();

            foreach ($all_items as $single_item) {

                $product_items[] = array(
                    'product_id' => $single_item['product_id'],
                    'item_id' => $single_item['item_id'],
                    'model_id' => $single_item['model_id'],
                    'value' => $single_item['value'],
                    'engine_size' => $single_item['engine_size'],
                    'position' => $single_item['position'],
                    'vehicle_attributes' => $single_item['vehicle_attributes'],
                    'application_notes' => $single_item['application_notes'],
                    'status' => "1",
                );
            }
            if (count($product_items) > 0) {
                $this->db->insert_batch('product_items', $product_items);
            }
        }
    }

}
