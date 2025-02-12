<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Part_relation
 * Makers Class handle all methods  related to products   like list, add , edit , delete.
 */
class Part_relation extends CI_Controller
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
        $this->load->model(array('comman_model', 'part_relation_model', 'product_model', 'product_items_model', 'product_natures_model', 'product_maker_model', 'pro_model', 'vehicle_categories_model', 'package_model'));
        $this->load->helper('assets');
        $this->load->library('customlog');

        validateAdminLogin();
        validateUser();
    }

    /**
     * Method index
     * This function list all products. 
     * @param $param1='' $param1 [This parameter is used for pagination.]
     * @param $param2=0 $param2 [This parameter is used for pagination.]
     *
     * @return void
     */
    function index($param1 = '', $param2 = 0)
    {
        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('part_relation');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteAll')) {
            // this code  delete all products from products table
            $this->comman_model->deleteAllDataWithLang('products', 1);
            $this->comman_model->deleteAllDataWithLang('product_details',1);
            $this->comman_model->delete_all_data('product_models');
            $this->comman_model->delete_all_data('model_groups');
            $this->comman_model->delete_all_data('model_engines');
            $this->comman_model->delete_all_data('model_engines_groups');
            $this->comman_model->deleteAllDataWithLang('product_items',1);
            $this->comman_model->deleteAllDataWithLang('product_attributes',1);
            $files = glob('assets/uploads/product_images/*'); // get all file names

            foreach ($files as $file) { // iterate files
                if (is_file($file))
                    unlink($file); // delete file
            }
        }

        if ($this->input->post('DeleteSelected')) {
            // this function delete product  as per ids passed in the post parameter
            $selectedtodelete = $this->security->xss_clean($this->input->post('deleteitem'));
            foreach($selectedtodelete as $del_prod){
                $this->product_model->delete_product_data($del_prod);
            }
        }

        $keypost = trim($this->security->xss_clean($this->input->post('search')));
        $offset = 0;
        $key = '';
        $uri_segment = 5;
        if (isset($param1) && $param1 != '' && isset($param2) && $param2 != '') {
            $offset = $param2;
            $key    = $param1;
            $uri_segment = 6;
        } else if (isset($param1) && $param1 != '') {
            $offset = $param1;
        } else if (isset($keypost) && $keypost != '') {
            $key = $keypost;
        }

        $config['per_page']     = 400;
        $config['num_links']    = 5;
        $config['uri_segment']  = $uri_segment;
        $config['first_link']   = '<< First';
        $config['last_link']    = 'Last >>';
        $config['next_link']    = 'Next ' . '&gt;';
        $config['prev_link']    = '&lt;' . ' Previous';

        if ($key) {
            // this function exectuted when pagination parameter is set
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/part_relation/index/" . $key;
            $config['total_rows']   = $this->comman_model->record_search_count('products', $key, array('kgt_ref_number', 'part_name'));
        } else {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/part_relation/index/";
            $config['total_rows']   = $this->comman_model->record_count('products');
        }

        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_products'), $this->lang->default_lang_id);
        $plang              = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('part_relation', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'part_relation',
            'addscripts'            => 'part_relation_list',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->part_relation_model->get_part_relation_details($key, $config['per_page'], $offset, $this->lang->default_lang_id),
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_products'        => $all_language_data['admin_products']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/part_relation/part_relation_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method delete_part_relation
     * This Function delete single product  as per the  id passed in the  parameter.
     * @param $id $id  [This Parameter is the product id. ]
     *
     * @return void
     */
    function delete_part_relation($id)
    {
        $access = validatePageAccess('part_relation');
        if ($access['page_delete'] != 1) {
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        
        $this->product_model->delete_product_data($id);
        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/part_relation');
    }


    function post_add_relation()
    {
        check_lang_admin();
        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction', 'cart_instruction'), $this->lang->default_lang_id);

        $admin_static_links = (object)$all_language_data['admin_static_links'];

        try {
            if ($this->input->post('operation')) {

                // this  code  executed when user submit the form.

                // these variables are intialized for  image file
                $config['upload_path']      = './assets/uploads/product_images';
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = '2048';
                $config['max_width']        = '100000';
                $config['max_height']       = '10000';
                if (!empty($_FILES['item_real_photo'])) {
                    foreach ($_FILES['item_real_photo']['name'] as $key => $item_real_photo) {
                        $config['file_name'][]     = getRandomFileName($item_real_photo, 'item_real_photo');
                        $config['file_type'][]     = $_FILES['item_real_photo']['type'][$key];
                    }
                } else {
                    $config['file_name']     = [];
                    $config['file_type']     = [];
                }
                $this->load->library('upload', $config);
                $this->load->library('image_lib');

                $countryDetail = $this->comman_model->get_row_array('countries', 'id', array('countryName ' => $this->input->post('country')));

                // this array is intialized to save in the database
                $post_data = array(
                    'kgt_ref_number'            => $this->input->post('ref_no'),
                    'template'            => $this->input->post('template'),
                    'part_name'                 => $this->input->post('part_name'),
                    'quantity'                  => $this->input->post('quantity'),
                    'min_quantity'              => $this->input->post('min_quantity'),
                    'backorder_status'          => $this->input->post('backorder_status'),
                    'price'                     => $this->input->post('price_cad'),
                    'item_height'               => $this->input->post('item_height'),
                    'item_width'                => $this->input->post('item_width'),
                    'item_length'               => $this->input->post('item_length'),
                    'item_weight'               => $this->input->post('item_weight'),
                    'item_nature_id'            => $this->input->post('item_nature_id'),
                    'shipping_special_notes'    => $this->input->post('shipping_special_notes'),
                    'country_id'                => (isset($countryDetail) && isset($countryDetail[0]['id'])) ? $countryDetail[0]['id'] : '',
                    'product_type_id'           => $this->input->post('product_type_id'),
                    'packageId'                 => implode(',', $this->input->post('packageId')),
                    'display_kondarsoft'        => $this->input->post('display_kondarsoft'),

                    'hide_partid'               => $this->input->post('hide_partid'),//AR
                    'seo_meta_desc'             => $this->input->post('seo_meta_desc'),//AR
                    'seo_meta_keywords'         => $this->input->post('seo_meta_keywords'),//AR

                    "pushed_status"             => "0",
                    'status'                    => $this->input->post('status'),
                    'item_schematic_photo_status' => ($this->input->post('item_schematic_photo_status')) ? $this->input->post('item_schematic_photo_status') : 0,
                    'created_date'              => date('Y-m-d h:i:s')
                );

                // this  code  executed when user upload  the product   image. 
                if (!empty($_FILES['item_real_photo']['name'][0])) {

                    // print_r($this->upload->do_upload_multiple('item_real_photo'));die;
                    if (!$this->upload->do_upload_multiple('item_real_photo')) {
                        $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                        $error_lang = isset($form_validation_instruction->image_file->front) ? $form_validation_instruction->image_file->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                        // if file is not uploaded than  this function set error  message in flash to display on frontend.
                        // $this->session->set_flashdata('error', $error_lang);
                        // redirect(base_url() . 'admin/' . $this->lang->default_lang . '/part_relation/add_part_relation');

                        $response['status'] = "0";
                        $response['element'] = "item_real_photo";
                        $response['message'] = $error_lang;
                        echo json_encode($response);
                        exit;
                    }

                    $upload_data = $this->upload->data();

                    if ($upload_data['multiple_file_name']) {
                        //this function set product image for save in the database

                        $post_data['item_real_photo'] = implode(",", $upload_data['multiple_file_name']);
                        /***************** Resize image  *****************/
                        foreach ($upload_data['multiple_file_name'] as $img_name) {
                            do_resize($config['upload_path'], $img_name);
                        }
                        /***************** Resize image  *****************/
                    }
                }


                // this  code  executed when user upload  the product schematic   image. 
                $config['file_name']  = getRandomFileName($_FILES['item_schematic_photo']['name'], 'item_schematic_photo');
                if (!empty($_FILES['item_schematic_photo']['name'])) {
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('item_schematic_photo')) {
                        $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                        $error_lang = isset($form_validation_instruction->image_file->front) ? $form_validation_instruction->image_file->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                        // if file is not uploaded than  this function set error  message in flash to display on frontend.
                        // $this->session->set_flashdata('error', $error_lang);
                        // redirect(base_url() . 'admin/' . $this->lang->default_lang . '/part_relation/add_part_relation');


                        $response['status'] = "0";
                        $response['element'] = "item_schematic_photo";
                        $response['message'] = $error_lang;
                        echo json_encode($response);
                        exit;
                    }

                    $upload_data = $this->upload->data();
                    if ($upload_data['file_name']) {
                        //this function set product schematic  for save in the database
                        $post_data['item_schematic_photo'] = $upload_data['file_name'];

                        /***************** Resize image  *****************/
                        do_resize($config['upload_path'], $post_data['item_schematic_photo']);
                        /***************** Resize image  *****************/
                    }
                }

                $post_data = $this->security->xss_clean($post_data);
                // this fucntion add new product in the  products table and return product id.
                $product_id = $this->comman_model->add('products', $post_data);

                // this array is intialized to save product details in the database (product_details table)
                $post_detail_data = array(
                    'product_id'                => $product_id,
                    'quantity_threshold'        => $this->input->post('quantity_threshold'),
                    'availability'              => $this->input->post('availability'),
                    'availability_backorder_no' => $this->input->post('availability_backorder_no'),
                    'availability_max_msg'      => $this->input->post('availability_max_msg'),
                    'replenishment_order_number' => $this->input->post('replenishment_order_number'),
                    'replenishment_order_date'  => $this->input->post('replenishment_order_date'),
                    'replenishing_period'       => $this->input->post('replenishing_period'),
                    'replenishing_period_tolerance_range' => $this->input->post('replenishing_period_tolerance_range'),
                    'ex_stock_period'           => $this->input->post('ex_stock_period'),
                    'updateddate'               => date('Y-m-d h:i:s'),
                    'created_date'              => date('Y-m-d h:i:s')
                );
                // this fucntion add product details in the  product_details table against product id.

                $this->comman_model->add('product_details', $post_detail_data);


                // this array is used to update the store wise product count in database product_quanity
                $store_id = $this->security->xss_clean($this->input->post('store_id'));
                $store_quantity = $this->security->xss_clean($this->input->post('store_quantity'));

                for($s = 0; $s<count($store_id); $s++){
                    $post_store_qty = array(
                         'quantity' => $store_quantity[$s],
                         'product_id' =>$product_id,
                         'store_id'=> $store_id[$s]
                    );
                    $result = $this->comman_model->add('products_count',$post_store_qty);                    
                }
                
                // Adding data to product_models table
                if(!empty($this->input->post('model_id'))) {
                    $batchInsertData = [];
                    $models_groups= [];
                    foreach ($this->input->post('model_id') as $modelId)  {
                        $result = $this->comman_model->get_row_array('tbl_models', 'vehicle_category_id , maker_id ', array('id' => $modelId));

                        $batchInsertData[] = array(
                            'product_id'            => $product_id,
                            'category_id'           => isset($result[0]['vehicle_category_id']) ? $result[0]['vehicle_category_id'] : '',
                            'maker_id'              => isset($result[0]['maker_id']) ? $result[0]['maker_id'] : '',
                            'model_id'              => $modelId,
                            'status'                => $this->input->post('status'),
                            'updated_date'          => date('Y-m-d h:i:s'),
                            'created_date'          => date('Y-m-d h:i:s')
                        );

                      $model_group_count=  $this->comman_model->table_count("model_groups",array("product_type_id"=>$this->input->post('product_type_id'),"model_id"=>$modelId));


                        if($model_group_count<1) {


                            $models_groups[] = array(
                                'model_id'  => $modelId,
                                'category_id'           => isset($result[0]['vehicle_category_id']) ? $result[0]['vehicle_category_id'] : '',
                                'maker_id'              => isset($result[0]['maker_id']) ? $result[0]['maker_id'] : '',
                                'model_id'              => $modelId,
                                'product_type_id' => $this->input->post('product_type_id'),
                                'status'=>1
                            );


                        }

                      

                    }

                  

                    if (count($batchInsertData) > 0) {
                        // this function add product models values as per the product id and relational id in the database 
                        $this->db->insert_batch('product_models', $batchInsertData);
                    }

                    if (count($models_groups) > 0) {
                        // this function add product models values as per the product id and relational id in the database 
                        $this->db->insert_batch('model_groups', $models_groups);
                    }

                }

                 // Update min price in the product group table.
                 $this->product_model->update_min_price($this->input->post('product_type_id'));



                if (empty($product_id)) {
                    $response['status'] = "0";
                    $response['element'] = "outer_message";
                    $response['message'] = $admin_static_links->data_not_successfully_updated->front;
                    echo json_encode($response);
                    exit;
                }

                // define the empty array for the item attr data
                $post_item_data = array();
                $dropdown_item_data = array();

                // this function executed when user submit  the prduct items input and their values as per their type. This code prepare array for product items.
                $product_item = $this->security->xss_clean($_POST['product_item']); // all the attr item are mentioned name as product_item in the view
                $product_item_images = $this->security->xss_clean($_FILES['product_item_img']); 
                $batchInsertProductItemData = [];



                if (count($product_item_images) > 0) {

                    print_r($product_item_images);

                    foreach ($_FILES['product_item_img']['name'] as $image_key => $image_data) {
                        print_r($image_data);

                        exit;
                      
                        // Checking For CROSS Reference with multiple array values.

                        // if (is_array($val) && !empty($val)) {
                        //     unset($val['field_type']);
                        //     foreach ($val as $key2 => $dropdownVals) {
                        //             $batchInsertProductItemData[] = array(
                        //                 'product_id'            => $product_id,
                        //                 'item_id'               => $key,
                        //                 'value'                 => $dropdownVals,
                        //                 'status'                => $this->input->post('status'),
                        //                 'created_date'          => date('Y-m-d h:i:s')
                        //             );
                        //     }
                        // } else {
                        //     $batchInsertProductItemData[] = array(
                        //         'product_id'            => $product_id,
                        //         'item_id'               => $key,
                        //         'value'                 => $val,
                        //         'status'                => $this->input->post('status'),
                        //         'created_date'          => date('Y-m-d h:i:s')
                        //     );
                        // }
                    }
                }

                if (count($product_item) > 0) {
                    foreach ($product_item as $key => $val) {
                        // Checking For CROSS Reference with multiple array values.

                        if (is_array($val) && !empty($val)) {
                            unset($val['field_type']);
                            foreach ($val as $key2 => $dropdownVals) {
                                    $batchInsertProductItemData[] = array(
                                        'product_id'            => $product_id,
                                        'item_id'               => $key,
                                        'value'                 => $dropdownVals,
                                        'status'                => $this->input->post('status'),
                                        'created_date'          => date('Y-m-d h:i:s')
                                    );
                            }
                        } else {
                            $batchInsertProductItemData[] = array(
                                'product_id'            => $product_id,
                                'item_id'               => $key,
                                'value'                 => $val,
                                'status'                => $this->input->post('status'),
                                'created_date'          => date('Y-m-d h:i:s')
                            );
                        }
                    }
                }

                if (count($batchInsertProductItemData) > 0) {
                    // This function add product items mainly CROSS REFERENCE & Product Line data into product_items table against product_id  
                    $this->db->insert_batch('product_attributes', $batchInsertProductItemData);
                }


                // check if item image file are included
                if (isset($_FILES) && count($_FILES) > 0) {
                    // all files submit on the form is uploaded using this code.
                    foreach ($_FILES as $key => $val) {
                        if (isset($val['name']) && $val['name'] != '' && $key != "item_real_photo" && $key != "item_schematic_photo") {
                            // Split the key based on item attr for product model or product group
                            $split   = explode('_', $key);
                            $itemId  = isset($split[1]) ? $split[1] : $split[0];
                            $modelId = (isset($split[1]) && $split[1]) ? $split[0] : '';

                            // define dynamic image name
                            $config['file_name']  = getRandomFileName($val['name'], 'item_attr_img');

                            // initialize config and upload the image
                            $this->upload->initialize($config);
                            $this->upload->do_upload($key);
                            $upload_data = $this->upload->data();

                            // image are uploaded then resize and make array data
                            if ($upload_data['file_name']) {
                                $post_item_data[] = array($upload_data['file_name'], 1, $itemId, $modelId);
                                do_resize($config['upload_path'], $upload_data['file_name']);
                            }
                        }
                    }
                }

                $productItems = $this->input->post('model_item');
                $manuFYears = array();
                $finalInsArray =  array();

                if (!empty($this->input->post('maker_id')) && !empty($this->input->post('model_id'))) {
                    $makerIds = $this->input->post('maker_id');
                    $modelIds = $this->input->post('model_id');

                    $model_maker_pair = array();

                    foreach ($makerIds as $key => $makerId) {
                        foreach ($modelIds as $key => $modelId) {
                            $model_maker_pair[] = 'year_' . $modelId . '_' . $makerId;
                        }
                    }

                    $productItems = $this->input->post('model_item');

                    if (!empty($model_maker_pair) && count($model_maker_pair) > 0) {
                        foreach ($model_maker_pair as $pair) {
                            $matchedKey = $pair;
                            if (isset($productItems[$pair]) && (!empty($productItems[$pair]))) {
                                $manuFYears = $productItems[$pair];
                                $splitYear  = explode("_", $pair);

                                $currentModelId = $splitYear[1];
                                $currentMakeId  = $splitYear[2];
                                
                                if (!empty($manuFYears)) {
                                    foreach ($manuFYears as $year) {

                                        $mappedYear = $year . '_' . $currentModelId . '_' . $currentMakeId;

                                        if (isset($productItems[$mappedYear]) && (!empty($productItems[$mappedYear]))) {
                                            $boxYear = $productItems[$mappedYear]['engine_size_' . $currentModelId . '_' . $currentMakeId];

                                            foreach ($boxYear as $key3 => $attrvalues) {
                                                $finalInsArray[] = array(
                                                    'product_id'  => $product_id,
                                                    'item_id'   => 1,
                                                    'model_id'  => $currentModelId,
                                                    'value' => $year,
                                                    'engine_size' => $attrvalues,
                                                    'position'  => $productItems[$mappedYear]['position_' . $currentModelId . '_' . $currentMakeId][$key3],
                                                    'vehicle_attributes' => $productItems[$mappedYear]['vehicle_atr_' . $currentModelId . '_' . $currentMakeId][$key3],
                                                    'application_notes' =>  $productItems[$mappedYear]['application_notes_' . $currentModelId . '_' . $currentMakeId][$key3]

                                                );


                                               $model_count =   $this->comman_model->table_count("model_engines",array("years"=>$year,"model_id"=>$currentModelId,"engine_size"=>$attrvalues));


                                               if($model_count<1) {


                                                $models_years = array(
                                                    'model_id'  => $currentModelId,
                                                    'years' => $year,
                                                    'engine_size'=>$attrvalues,
                                                    'status'=>1
                                                );
                                                $this->db->insert('model_engines',  $models_years);


                                               }


                                               $model_group_count =   $this->comman_model->table_count("model_engines_groups",array("years"=>$year,"model_id"=>$currentModelId,"engine_size"=>$attrvalues,"product_type_id"=>$this->input->post('product_type_id')));


                                               if($model_group_count<1) {


                                                $models_group_years = array(
                                                    'model_id'  => $currentModelId,
                                                    'years' => $year,
                                                    'engine_size'=>$attrvalues,
                                                    "product_type_id"=>$this->input->post('product_type_id'),
                                                    'status'=>1
                                                );
                                                $this->db->insert('model_engines_groups',  $models_group_years);


                                               }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                // echo "<pre>";
                //     print_r($finalInsArray);
                // exit;


                if (count($finalInsArray) > 0) {
                    // this function add product item dropdown values as per the product id  and relational id in the database 
                    $this->db->insert_batch('product_items', $finalInsArray);
                }


               

                if (count($models_years) > 0) {
                    // this function add product item dropdown values as per the product id  and relational id in the database 
                    $this->db->insert_batch('model_engines',  $models_years);
                }


                // exit;

                // this code executed when user chosse the parent product 
                $product_parent = $this->input->post('product_parent');
                if (isset($product_parent) && $product_parent != '') {
                    $product_parent = explode(',', $product_parent);
                    if (count($product_parent) > 0) {
                        $pparent_data = array();
                        foreach ($product_parent as $pparent) {
                            $pparent_data[] = array(
                                'product_id'        => $product_id,
                                'parent_product_id' => $pparent
                            );
                        }

                        if (count($pparent_data) > 0) {
                            // this function add product parent priduct  values as per the product id
                            $this->db->insert_batch('tbl_product_parent', $pparent_data);
                        }
                    }
                }


                $distributor = $this->security->xss_clean($this->input->post('distributor'));
                if (isset($distributor) && $distributor != '') {
                  
                    if (!empty($distributor)) {
                        foreach ($distributor as $single_dist) {
                            $distributor_data[] = array(
                                'product_id'        => $product_id,
                                'distributor_id' => $single_dist
                            );

                        }
                        if (count($distributor_data) > 0) {
                        $this->db->insert_batch('product_distributors', $distributor_data);
                        }

                    }
                } 

                // Update min price in the product group table.
                $this->product_model->update_min_price($this->input->post('product_type_id'));
                $this->product_model->deactivate_unused_data();


                // this function set success message in flash to display on frontend.

                $response['status'] = "1";
                $response['message'] = $admin_static_links->data_successfully_updated['front'];
                echo json_encode($response);
                exit;
            }
        } catch (Exception $ex) {

            $response['status'] = "0";
            $response['element'] = "outer_message";
            $response['message'] = $admin_static_links->data_not_successfully_updated['front'];
            echo json_encode($response);
            exit;
        }
    }

    /**
     * Method add_part_relation
     * This Function Display Add product  form  and save the new product   in the database.
     * @return void
     */
    function add_part_relation()
    {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('part_relation');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction', 'cart_instruction'), $this->lang->default_lang_id);


        $plang = $this->comman_model->getPrimaryLang();

        $distributors_data = $this->comman_model->GetAllDataLang('distributors', $this->lang->default_lang_id, 'distributors_country');
        $store_data = $this->comman_model->get_all_data_by_id('store',array('status'=> 1));
        // print_r($store_data);exit;

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('part_relation', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'part_relation',
            'addscripts'            => 'add_part_relation',
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_products'        => $all_language_data['admin_products'],
            'cart_instruction'      => $all_language_data['cart_instruction'],
            'maker_info'            => $this->product_maker_model->getAllMakerInfo(""),
            'model_info'            => $this->pro_model->getAllModelInfo(),
            'vehicle_categories'    => $this->vehicle_categories_model->getvehiclecategory_model($this->lang->default_lang_id),
            'product_types'         => $this->product_model->getall_producttype_data($this->lang->default_lang_id),
            'product_items'         => $this->product_items_model->getproductitems_data(),
            'model_product_items'   => $this->product_items_model->getproductitems_data('product_model'),
            'product_natures'       => $this->product_natures_model->getproductnatures_data($this->lang->default_lang_id),
            'packages'              => $this->package_model->getPackageData($this->lang->default_lang_id),
            'distributors_data'            => $distributors_data,
            'store_data'            => $store_data,
            'products'            => $this->product_model->ar_getAllProductsForParent($product_id=0, $this->lang->default_lang_id),//AR

        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/part_relation/add_part_relation', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }



    function post_edit_part_relation($id = false)
    {

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction', 'cart_instruction'), $this->lang->default_lang_id);

        $admin_static_links = (object)$all_language_data['admin_static_links'];
        
        try {

            $plang  = $this->comman_model->getPrimaryLang();
            $edit_data = allDataArray($this->comman_model->GetAllDataLangByid('products', 'id', $id, $this->lang->default_lang_id, 'products_country'));
            if ($this->input->post('operation')) {

                // this  code  executed when user submit the form.

                // these variables are intialized for  image file
                $config['upload_path']      = './assets/uploads/product_images';
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = '2048';
                $config['max_width']        = '100000';
                $config['max_height']       = '10000';
                if (!empty($_FILES['item_real_photo'])) {
                    foreach ($_FILES['item_real_photo']['name'] as $key => $item_real_photo) {
                        $config['file_name'][]     = getRandomFileName($item_real_photo, 'item_real_photo');
                        $config['file_type'][]     = $_FILES['item_real_photo']['type'][$key];
                    }
                } else {
                    $config['file_name']     = [];
                    $config['file_type']     = [];
                }
                $this->load->library('upload', $config);
                $this->load->library('image_lib');

                $countryDetail = $this->comman_model->get_row_array('countries', 'id', array('countryName ' => $this->input->post('country')));

                // this array is intialized to save in the database
                $post_data = array(
                    'kgt_ref_number'            => $this->input->post('ref_no'),
                    'part_name'                 => $this->input->post('part_name'),
                    'template'                  => $this->input->post('template'),
                    'quantity'                  => $this->input->post('quantity'),
                    'min_quantity'              => $this->input->post('min_quantity'),
                    'backorder_status'          => $this->input->post('backorder_status'),
                    'price'                     => $this->input->post('price_cad'),
                    'item_height'               => $this->input->post('item_height'),
                    'item_width'                => $this->input->post('item_width'),
                    'item_length'               => $this->input->post('item_length'),
                    'item_weight'               => $this->input->post('item_weight'),
                    'item_nature_id'            => $this->input->post('item_nature_id'),
                    'shipping_special_notes'    => $this->input->post('shipping_special_notes'),
                    'country_id'                => (isset($countryDetail) && isset($countryDetail[0]['id'])) ? $countryDetail[0]['id'] : '',
                    'product_type_id'           => $this->input->post('product_type_id'),
                    'packageId'                 => implode(',', $this->input->post('packageId')),
                    'display_kondarsoft'        => $this->input->post('display_kondarsoft'),
                    "pushed_status"             => "0",
                    'status'                    => $this->input->post('status'),
                    'hide_partid'                    => $this->input->post('hide_partid'),
                    'seo_meta_desc'             => $this->input->post('seo_meta_desc'),
                    'seo_meta_keywords'         => $this->input->post('seo_meta_keywords'),
                    'item_schematic_photo_status' => ($this->input->post('item_schematic_photo_status')) ? $this->input->post('item_schematic_photo_status') : 0,
                    'updated_date'              => date('Y-m-d h:i:s')
                );

                if ($edit_data['display_kondarsoft'] == "1" && $edit_data['pushed_status'] == "1" && $edit_data['pushed_status'] == "1" && (empty($this->input->post('status')) || $this->input->post('display_kondarsoft') != "1" || $this->input->post('quantity') < "1" || $this->input->post('display_kondarsoft') == "0" || empty($this->input->post('display_kondarsoft')))) {

                    $delete_product_number[] = $this->input->post('ref_no');
                    $this->comman_model->delete_kgs_products($delete_product_number);
                }


                // this  code  executed when user upload  the product   image. 
                if (!empty($_FILES['item_real_photo']['name'][0])) {

                    // print_r($this->upload->do_upload_multiple('item_real_photo'));die;
                    if (!$this->upload->do_upload_multiple('item_real_photo')) {
                        $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                        $error_lang = isset($form_validation_instruction->client_logo->front) ? $form_validation_instruction->client_logo->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                        // if file is not uploaded than  this function set error  message in flash to display on frontend.
                        // $this->session->set_flashdata('error', $error_lang);
                        // redirect(base_url() . 'admin/' . $this->lang->default_lang . '/part_relation/edit_part_relation/' . $id);
                        $response['status'] = "0";
                        $response['element'] = "item_real_photo";
                        $response['message'] = $error_lang;
                        echo json_encode($response);
                        exit;
                    }

                    $upload_data = $this->upload->data();

                    if ($upload_data['multiple_file_name']) {
                        //this function set product image for save in the database

                        if (!empty($edit_data['item_real_photo'])) {
                            $multi_img = implode(",", $upload_data['multiple_file_name']);
                            $post_data['item_real_photo'] = $edit_data['item_real_photo'] . ',' . $multi_img;
                        } else {
                            $post_data['item_real_photo'] =  implode(",", $upload_data['multiple_file_name']);
                        }

                        /***************** Resize image  *****************/
                        foreach ($upload_data['multiple_file_name'] as $img_name) {
                            do_resize($config['upload_path'], $img_name);
                        }
                        /***************** Resize image  *****************/
                    }
                }

                // this  code  executed when user upload  the product schematic   image.
                $config['file_name']  = getRandomFileName($_FILES['item_schematic_photo']['name'], 'item_schematic_photo');


                if (!empty($_FILES['item_schematic_photo']['name'])) {
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('item_schematic_photo')) {
                        $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                        $error_lang = isset($form_validation_instruction->client_logo->front) ? $form_validation_instruction->client_logo->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                        // if file is not uploaded than  this function set error  message in flash to display on frontend.
                        // $this->session->set_flashdata('error', $error_lang);
                        // redirect(base_url() . 'admin/' . $this->lang->default_lang . '/part_relation/edit_part_relation/' . $id);

                        $response['status'] = "0";
                        $response['element'] = "item_schematic_photo";
                        $response['message'] = $error_lang;
                        echo json_encode($response);
                        exit;
                    }

                    $upload_data = $this->upload->data();
                    if ($upload_data['file_name']) {
                        //this function set product schematic  for save in the database
                        $post_data['item_schematic_photo'] = $upload_data['file_name'];

                        /***************** Resize image  *****************/
                        do_resize($config['upload_path'], $post_data['item_schematic_photo']);
                        /***************** Resize image  *****************/
                    }
                }

                $post_data = $this->security->xss_clean($post_data);

                
                // this function update product in the  products table as per the  product new structure.
                $result = $this->comman_model->update_data_by_id('products', $post_data, 'id', $id);


                // this array is intialized to update product details in the database (product_details table)
                $post_detail_data = array(
                    'product_id'                => $id,
                    'quantity_threshold'        => $this->input->post('quantity_threshold'),
                    'availability'              => $this->input->post('availability'),
                    'availability_backorder_no' => $this->input->post('availability_backorder_no'),
                    'availability_max_msg'      => $this->input->post('availability_max_msg'),
                    'replenishment_order_number' => $this->input->post('replenishment_order_number'),
                    'replenishment_order_date'  => $this->input->post('replenishment_order_date'),
                    'replenishing_period'       => $this->input->post('replenishing_period'),
                    'replenishing_period_tolerance_range' => $this->input->post('replenishing_period_tolerance_range'),
                    'ex_stock_period'           => $this->input->post('ex_stock_period'),
                    'updateddate'               => date('Y-m-d h:i:s')
                );
                // this fucntion add product details in the product_details table against product id.
                $result = $this->comman_model->update_data_by_id('product_details', $post_detail_data, 'product_id', $id);

                // this array is used to update the store wise product count in database product_quanity
                $store_id = $this->security->xss_clean($this->input->post('store_id'));
                $store_quantity = $this->security->xss_clean($this->input->post('store_quantity'));

                for($s = 0; $s < count($store_id); $s++){
                    $post_store_qty = array(
                         'quantity' => $store_quantity[$s]
                    );  
                    $where = array(
                        'product_id' =>$id,
                        'store_id'=> $store_id[$s]
                    );
                    $check_qty = $this->comman_model->get_row_array('products_count','*', $where);
                    if(count($check_qty)>0){
                        $result = $this->comman_model->update_where('products_count',$post_store_qty, $where);  
                    }else{
                        $post_store_qty = array(
                            'quantity' => $store_quantity[$s],
                            'product_id' =>$id,
                            'store_id'=> $store_id[$s]
                       );
                       $result = $this->comman_model->add('products_count',$post_store_qty);  
                    }
                                                          
                }
                
                // define the empty array for the item attr data
                $dropdown_item_data = $post_item_data = array();

                // this function executed when user submit  the prduct items input and their values as per their type. This code prepare array for product items.
                $product_item = $this->security->xss_clean($_POST['product_item']); // all the attr item are mentioned name as product_item in the view

                if (count($product_item) > 0) {
                    foreach ($product_item as $key => $val) {
                        // Split the key based on item attr for product model or product group
                        $split   = explode('_', $key);
                        $itemId  = (isset($split[1]) && $split[1]) ? $split[1] : $split[0];
                        $modelId = (isset($split[1]) && $split[1]) ? $split[0] : 0;
                        $makerId = (isset($val['maker_id']) && $val['maker_id']) ? $val['maker_id'] : 0;

                        // based on item type creating the array format
                        if (is_array($val) && !empty($val)) {
                            unset($val['maker_id']);
                            if ($val['field_type'] == 'dropdown' && $val[0] != '') {
                                // if product item is dropdown than this code executed
                                $post_item_data[] = array('dropdown', 0, $itemId, $modelId, $makerId);
                                $dropdown_item_data[$key] = $val;
                            }
                        } else if (isset($val) && $val != '') {
                            $post_item_data[] = array($val, 0, $itemId, $modelId, $makerId);
                        }
                    }
                }

                // check if item image file are included

                if (isset($_FILES) && count($_FILES) > 0) {
                    // all files submit on the form is uploaded using this code.
                    $item_image = $this->security->xss_clean($_POST['product_item_image']);
                    foreach ($_FILES as $key => $val) {
                        // Split the key based on item attr for product model or product group
                        $split   = explode('_', $key);
                        $itemId  = isset($split[1]) ? $split[1] : $split[0];
                        $modelId = (isset($split[1]) && $split[1]) ? $split[0] : '';

                        if (isset($val['name']) && $val['name'] != '' && $key != "item_real_photo" && $key != "item_schematic_photo") {
                            // define dynamic image name
                            $config['file_name']  = getRandomFileName($val['name'], 'item_attr_img');

                            // initialize config and upload the image
                            $this->upload->initialize($config);
                            $this->upload->do_upload($key);
                            $upload_data = $this->upload->data();

                            // image are uploaded then resize and make array data
                            if ($upload_data['file_name']) {
                                $post_item_data[] = array($upload_data['file_name'], 1, $itemId, $modelId);
                                /***************** Resize image  *****************/
                                do_resize($config['upload_path'], $upload_data['file_name']);
                                /***************** Resize image  *****************/
                            }
                        } else {
                            // image are not uploaded then create array with existing data
                            if (isset($item_image[$key]) && $item_image[$key]) {
                                $post_item_data[] = array($item_image[$key], 1, $itemId, $modelId);
                            }
                        }
                    }
                }


                // echo "<pre>";
                // echo $id;
                // print_r($post_item_data);
                // exit;

                // this function delete product items related to product before update
                $this->product_model->delete_product_relationaldata($id);

                // $result_item_relation = $this->comman_model->delete_where('tbl_product_item_relation', array('product_id' => $id, 'product_item_id' => 1));

                $finalInsArray =  array();

                // Adding data to product_models table
                if(!empty($this->input->post('model_id'))) {
                    $batchInsertData = [];
                    $models_groups= [];
                    foreach ($this->input->post('model_id') as $modelId)  {
                        $result = $this->comman_model->get_row_array('tbl_models', 'vehicle_category_id , maker_id ', array('id' => $modelId));

                        $batchInsertData[] = array(
                            'product_id'            => $id,
                            'category_id'           => isset($result[0]['vehicle_category_id']) ? $result[0]['vehicle_category_id'] : '',
                            'maker_id'              => isset($result[0]['maker_id']) ? $result[0]['maker_id'] : '',
                            'model_id'              => $modelId,
                            'status'                => $this->input->post('status'),
                            'updated_date'          => date('Y-m-d h:i:s'),
                            'created_date'          => date('Y-m-d h:i:s')
                        );



                        $model_group_count=    $this->comman_model->table_count("model_groups",array("product_type_id"=>$this->input->post('product_type_id'),"model_id"=>$modelId));


                        if($model_group_count<1) {


                            $models_groups[] = array(
                                'model_id'  => $modelId,
                                'category_id'           => isset($result[0]['vehicle_category_id']) ? $result[0]['vehicle_category_id'] : '',
                                'maker_id'              => isset($result[0]['maker_id']) ? $result[0]['maker_id'] : '',
                                'model_id'              => $modelId,
                                'product_type_id' => $this->input->post('product_type_id'),
                                'status'=>1
                            );


                        }

                    }


                    if (count($batchInsertData) > 0) {
                        // this function add product models values as per the product id and relational id in the database 
                        $this->db->insert_batch('product_models', $batchInsertData);
                    }

                    if (count($models_groups) > 0) {
                        // this function add product models values as per the product id and relational id in the database 
                        $this->db->insert_batch('model_groups', $models_groups);
                    }

                }


                // define the empty array for the item attr data
                $post_item_data = array();
                $dropdown_item_data = array();

                // this function executed when user submit  the prduct items input and their values as per their type. This code prepare array for product items.
                $product_item = $this->security->xss_clean($_POST['product_item']); // all the attr item are mentioned name as product_item in the view

                $batchInsertProductItemData = [];

                if (count($product_item) > 0) {
                    foreach ($product_item as $key => $val) {
                        // Checking For CROSS Reference with multiple array values.

                        if (is_array($val) && !empty($val)) {
                            unset($val['field_type']);
                            foreach ($val as $key2 => $dropdownVals) {
                                    $batchInsertProductItemData[] = array(
                                        'product_id'            => $id,
                                        'item_id'               => $key,
                                        'value'                 => $dropdownVals,
                                        'status'                => $this->input->post('status'),
                                        'created_date'          => date('Y-m-d h:i:s')
                                    );
                            }
                        } else {
                            $batchInsertProductItemData[] = array(
                                'product_id'            => $id,
                                'item_id'               => $key,
                                'value'                 => $val,
                                'status'                => $this->input->post('status'),
                                'created_date'          => date('Y-m-d h:i:s')
                            );
                        }
                    }
                }

                if (count($batchInsertProductItemData) > 0) {
                    // This function add product items mainly CROSS REFERENCE & Product Line data into product_items table against product_id  
                    $this->db->insert_batch('product_attributes', $batchInsertProductItemData);
                }


                // New logic based upon the updates structure 
                // firstly check how many makers & models selected

                $productItems = $this->input->post('model_item');
                $manuFYears = array();
                $finalInsArray =  array();
                if (!empty($this->input->post('maker_id')) && !empty($this->input->post('model_id'))) {
                    $makerIds = $this->input->post('maker_id');
                    $modelIds = $this->input->post('model_id');

                    $model_maker_pair = array();

                    foreach ($makerIds as $key => $makerId) {
                        foreach ($modelIds as $key => $modelId) {
                            $model_maker_pair[] = 'year_' . $modelId . '_' . $makerId;
                        }
                    }

                    $productItems = $this->input->post('model_item');

                    if (!empty($model_maker_pair) && count($model_maker_pair) > 0) {
                        foreach ($model_maker_pair as $pair) {
                            $matchedKey = $pair;
                            if (isset($productItems[$pair]) && (!empty($productItems[$pair]))) {
                                $manuFYears = $productItems[$pair];
                                $splitYear  = explode("_", $pair);

                                $currentModelId = $splitYear[1];
                                $currentMakeId  = $splitYear[2];
                                
                                if (!empty($manuFYears)) {
                                    foreach ($manuFYears as $year) {

                                        $mappedYear = $year . '_' . $currentModelId . '_' . $currentMakeId;

                                        if (isset($productItems[$mappedYear]) && (!empty($productItems[$mappedYear]))) {
                                            $boxYear = $productItems[$mappedYear]['engine_size_' . $currentModelId . '_' . $currentMakeId];

                                            foreach ($boxYear as $key3 => $attrvalues) {
                                                $finalInsArray[] = array(
                                                    'product_id'  => $id,
                                                    'item_id'   => 1,
                                                    'model_id'  => $currentModelId,
                                                    'value' => $year,
                                                    'engine_size' => $attrvalues,
                                                    'position'  => $productItems[$mappedYear]['position_' . $currentModelId . '_' . $currentMakeId][$key3],
                                                    'vehicle_attributes' => $productItems[$mappedYear]['vehicle_atr_' . $currentModelId . '_' . $currentMakeId][$key3],
                                                    'application_notes' =>  $productItems[$mappedYear]['application_notes_' . $currentModelId . '_' . $currentMakeId][$key3]

                                                );



                                                $model_count =   $this->comman_model->table_count("model_engines",array("years"=>$year,"model_id"=>$currentModelId,"engine_size"=>$attrvalues));


                                                if($model_count<1) {
 
 
                                                 $models_years = array(
                                                     'model_id'  => $currentModelId,
                                                     'years' => $year,
                                                     'engine_size'=>$attrvalues,
                                                     'status'=>1
                                                 );
                                                 $this->db->insert('model_engines',  $models_years);
 
 
                                                }
 
 
                                                $model_group_count =   $this->comman_model->table_count("model_engines_groups",array("years"=>$year,"model_id"=>$currentModelId,"engine_size"=>$attrvalues,"product_type_id"=>$this->input->post('product_type_id')));
 
 
                                                if($model_group_count<1) {
 
 
                                                 $models_group_years = array(
                                                     'model_id'  => $currentModelId,
                                                     'years' => $year,
                                                     'engine_size'=>$attrvalues,
                                                     "product_type_id"=>$this->input->post('product_type_id'),
                                                     'status'=>1
                                                 );
                                                 $this->db->insert('model_engines_groups',  $models_group_years);
 
 
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                // echo "<pre>";
                //     print_r($finalInsArray);
                // exit;

                if (count($finalInsArray) > 0) {
                    // this function add product item dropdown values as per the product id  and relational id in the database 
                    $this->db->insert_batch('product_items', $finalInsArray);
                }

              

                // this code executed when user chosse the parent product 
                $product_parent = $this->security->xss_clean($this->input->post('product_parent'));
                if (isset($product_parent) && $product_parent != '') {
                    $product_parent = explode(',', $product_parent);
                    if (!empty($product_parent)) {
                        $result = $this->comman_model->delete_where('tbl_product_parent', array('product_id' => $id));
                        foreach ($product_parent as $pparent) {
                            $pparent_data = array();
                            $pparent_data = array(
                                'product_id'        => $id,
                                'parent_product_id' => $pparent
                            );

                            // this function add product parent product  values as per the product id  
                            $this->comman_model->add('tbl_product_parent', $pparent_data);
                        }
                    }
                } else {
                    // this function delete product parent table as per the product id
                    $this->comman_model->delete_where('tbl_product_parent', array('product_id' => $id));
                }


                 // this code executed when user chosse the distributor 
                 $distributor = $this->security->xss_clean($this->input->post('distributor'));
                 if (isset($distributor) && $distributor != '') {
                   
                     if (!empty($distributor)) {
                         $this->comman_model->delete_where('product_distributors', array('product_id' => $id));
                         foreach ($distributor as $single_dist) {
                             $distributor_data[] = array(
                                 'product_id'        => $id,
                                 'distributor_id' => $single_dist
                             );

                         }
                         if (count($distributor_data) > 0) {
                         $this->db->insert_batch('product_distributors', $distributor_data);
                         }

                     }
                 } else {
                     // this function delete distributor table as per the product id
                     $this->comman_model->delete_where('product_distributors', array('product_id' => $id));
                 }

                // Update min price in the product group table.
                $this->product_model->update_min_price($this->input->post('product_type_id'));
                $this->product_model->deactivate_unused_data();
                $admin_static_links = $all_language_data['admin_static_links'];
                // // this function set success message in flash to display on frontend.
                // $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']['front']);

                // redirect(base_url() . 'admin/' . $this->lang->default_lang . '/part_relation');


                $response['status'] = "1";
                $response['message'] = $admin_static_links['data_successfully_updated']['front'];
                echo json_encode($response);
                exit;
            }
        } catch (Exception $ex) {

            $response['status'] = "0";
            $response['element'] = "outer_message";
            $response['message'] = $admin_static_links->data_not_successfully_updated['front'];
            echo json_encode($response);
            exit;
        }
    }

    /**
     * Method edit_part_relation
     *  This Function Display edit  form and update the product on the behalf of  id passed in the parameter.
     * @param $id $id [This parameter is the product id.]
     *
     * @return void
     */
    function edit_part_relation($id = false)
    {
        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect('admin/part_relation');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('part_relation');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction', 'cart_instruction'), $this->lang->default_lang_id);

        $plang  = $this->comman_model->getPrimaryLang();

        $edit_data = $this->fetchProductAllDataById($id);

        $store_data = $this->comman_model->get_store_wise_quantity($id);

        $only_stores = $this->comman_model->get_all_data_by_id('store', array('status'=>1));

        $product_item = $this->getProductItemData($id);

        $edit_data['id'] = $id;

        $edit_data['distributor'] = $this->product_model->getproduct_distributor($id);

        // echo "<pre>";
        //     print_r($edit_data);
        // exit;


        // $query = $this->db->get_where('tbl_product_item_relation_dropdown', array('product_id' => $id));
        // $pdtDropdownData =  $query->result_array();
        $distributors_data = $this->comman_model->GetAllDataLang('distributors', $this->lang->default_lang_id, 'distributors_country');

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('part_relation', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'part_relation',
            'addscripts'            => 'edit_part_relation',
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_products'        => $all_language_data['admin_products'],
            'cart_instruction'      => $all_language_data['cart_instruction'],
            'edit_data'             => $edit_data,
            'maker_info'            => $this->product_maker_model->getMakerhasmodel($edit_data['vehicle_category_id']),
            'model_info'            => $this->pro_model->getAllModelInfo($edit_data['maker_id']),
            'vehicle_categories'    => $this->vehicle_categories_model->getvehiclecategory_model($this->lang->default_lang_id),
            'product_types'         => $this->product_model->getall_producttype_data($this->lang->default_lang_id),
            'product_items'         => $this->product_items_model->getproductitems_data(),
            'model_product_items'   => $this->product_items_model->getproductitems_data('product_model'),
            'product_natures'       => $this->product_natures_model->getproductnatures_data($this->lang->default_lang_id),
            'product_itemr'         => $product_item['data_product_itemr'],
            'productedits'          => $this->product_model->getAllEditProducts($id),
            'packages'              => $this->package_model->getPackageData($this->lang->default_lang_id),
            'distributors_data'            => $distributors_data,
            'store_data' => $store_data,
            'only_stores' => $only_stores,
            'products'  => $this->product_model->ar_getAllProductsForParent($id, $this->lang->default_lang_id),//AR
        );

        // echo "<pre>";
        // print_r($pageData);die;

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/part_relation/edit_part_relation', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    function getProductItemData($productId)
    {
        $data_product_itemr = $data_product_model_itemr = array();
        $product_itemr = $this->product_items_model->getProductItemValueById('product_attributes', $this->lang->default_lang_id, 'product_id', $productId);

        // echo "<pre>";
        // print_r($product_itemr);die;

        foreach ($product_itemr as $ptr) {
         $data_product_itemr[$ptr['item_id']][$ptr['id']] = isset($ptr['lang_value']) ? $ptr['lang_value'] : $ptr['value'];
        }
        // echo "<pre>";
        //     print_r($data_product_itemr);
        // exit;
        return array('data_product_itemr' => $data_product_itemr);
    }

    /**
     * Method checkPartNumber
     * This Function checked that is part number   exist in the products or not.
     * @param $part_relation_id $part_relation_id [This parameter is the product id.]
     *
     * @return void
     */
    public function checkPartNumber($part_relation_id = '')
    {
        $ref_no = $this->security->xss_clean($this->input->post('ref_no'));
        if ($ref_no && $part_relation_id) {
            $result = $this->comman_model->get_data_by_id('products', array('id' => $part_relation_id));
            if ($ref_no == $result['kgt_ref_number']) {
                echo json_encode(TRUE);
            } else {
                // this function check is record exist in the table with number  or not.
                $exists = $this->comman_model->check_row_exists('products', array('kgt_ref_number' => $ref_no));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        } else if ($ref_no) {
            // this function check is record exist in the table with number  or not.
            $exists = $this->comman_model->check_row_exists('products', array('kgt_ref_number' => $ref_no));
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
     * Method ar_checkProductsParent
     * This Function checked that is part number   exist in the products or not.
     * @param $part_relation_id $part_relation_id [This parameter is the product id.]
     *
     * @return void
     */
    public function ar_checkProductsParent($part_relation_id = '')
    {
       $selectedValues = $this->security->xss_clean($this->input->get_post('selectedValues'));
     //print_r($selectedValues);
       //echo '<br/>part_relation_id='.$part_relation_id;
        $data=array('updatedValues'=>array(),'removedValues'=>array(),'complexRelation'=>false);
        $removedValues=array();
        if ($selectedValues && $part_relation_id) {
            //$result = $this->comman_model->get_data_by_id('products', array('id' => $part_relation_id));
           // $select_parents=explode(',',$selectedValues);
           // print_r($select_parents);
            $select_parents=$selectedValues;
            if($select_parents){
                foreach($select_parents as $sid){
                    $exists = $this->comman_model->check_row_exists('tbl_product_parent', array('parent_product_id' => $part_relation_id,'product_id' => $sid));
                    if ($exists) {
                        $data['removedValues'][$sid]=$this->product_model->ar_getProductRefNumById($sid);
                    }else{
                        $data['updatedValues'][]=$sid;
                    }
                }
            }

            if($data['removedValues']){
                $data['complexRelation']=true;
            }
            //echo '<pre>';
           // print_r($data);
            echo json_encode($data);


        } else if ($selectedValues) {
            // this function check is record exist in the table with number  or not.
            $select_parents=explode(',',$selectedValues);
           // print_r($select_parents);

            // if(count($select_parents)>1){
            //     foreach($select_parents as $sid){
            //         $exists = $this->comman_model->check_row_exists('tbl_product_parent', array('parent_product_id' => $part_relation_id,'product_id' => $sid));
            //         if ($exists) {
            //             $data['removedValues'][$sid]=$this->product_model->ar_getProductRefNumById($sid);
            //         }else{
            //             $data['updatedValues'][]=$sid;
            //         }
            //     }
            // }

            // if($data['removedValues']){
            //     $data['complexRelation']=true;
            // }
            //echo '<pre>';
           // print_r($data);
            echo json_encode($data);
        }
    }
    /**
     * Method del_partrelationimagepermanently
     * This Function delete product image as per product id and imagename.
     * @param $id $id [This parameter is the product i]
     * @param $imagetodelete $imagetodelete [This parameter is the product image column name]
     *
     * @return void
     */
    public function del_partrelationimagepermanently()
    {
        validateAdminLogin();
        $id = $this->input->post('id');
        $imagetodelete = $this->input->post('imagetodelete');
        $image = $this->input->post('img');


        $data_array[$imagetodelete] = '';
        $all_img = [];
        $images = '';

        $all_data = $this->comman_model->get_data_by_id('products', array('id' => $id));

        $del_img = !empty($image) ? $image : $all_data[$imagetodelete];
        if ($imagetodelete == 'item_real_photo') {
            if (!empty($all_data['item_real_photo'])) {
                $all_img = explode(",", $all_data['item_real_photo']);
                $all_img = array_map('trim', $all_img);
                if ($image != '') {
                    if (($key = array_search($image, $all_img)) !== false) {
                        unset($all_img[$key]);
                    }
                }
            }
            $images = implode(",", $all_img);
        }

        $data_array[$imagetodelete] = $images;

        // this function update the image column in the database
        $update = $this->comman_model->update_data_by_id('products', $data_array, 'id', $id);

        if ($update) {
            // after update in the database this function remove the image.
            if (file_exists("assets/uploads/product_images/" . $del_img))
                unlink("assets/uploads/product_images/" . $del_img);
        }

        echo json_encode(TRUE);
        exit;

    }

    public function getMakersByCategoryId()
    {

        $category_ids =  $this->security->xss_clean($this->input->post('category_ids'));
        $maker_ids =  $this->security->xss_clean($this->input->post('maker_ids'));

        $html = '';
        if ($category_ids) {
            $maker_info = $this->product_maker_model->getMakerhasmodel($category_ids, $maker_ids);
            foreach ($maker_info as $maker) {
                $vehicle_category_ids = explode(',', $maker['vehicle_category_id']);
                $class = '';
                $data_cat_id = "";
                foreach ($vehicle_category_ids as $vehicle_category_id) {
                    $class .= " maker_" . $vehicle_category_id;
                    $data_cat_id .= " " . $vehicle_category_id;
                }
                $html .= '<div class="controls' . $class . '" data-cat-id="' . $data_cat_id . '"><input type="checkbox" name="maker_id[]" value="' . $maker['id'] . '" data-name="' . $maker['maker_name'] . '" />&nbsp; &nbsp;' . $maker['maker_name'] . '</div>';
            }
        }
        echo $html;
        exit;
    }

    public function getModelsByMakerId()
    {
        $html = '';
        $category_ids =  $this->security->xss_clean($this->input->post('category_ids'));
        $maker_ids =  $this->security->xss_clean($this->input->post('maker_ids'));
        $model_ids =  $this->security->xss_clean($this->input->post('model_ids'));

        if ($maker_ids && $category_ids) {
            $model_info = $this->pro_model->getAllModelInfo($maker_ids, $category_ids, $model_ids);


            $product_model_items = $this->product_items_model->getproductitems_data("product_model");

            $all_language_data  = get_admin_lang_data(array('general_instruction'), $this->lang->default_lang_id);
            // print_r($all_language_data['general_instruction']['label_all']);die;

            $pageData = array(
                'model_info'                 => $model_info,
                'product_model_items'   => $product_model_items,
                'general_instruction' => $all_language_data['general_instruction']
            );
            $html .= $this->load->view('admin/part_relation/model_attribute_add_form', $pageData);
        }
        echo $html;
    }

    public function getModelsByMakerEditId()
    {
        $html = '';

        $category_ids =  explode(",", $this->security->xss_clean($this->input->post('category_ids')));
      
        $maker_ids =  explode(",", $this->security->xss_clean($this->input->post('maker_ids')));
        $model_ids =   explode(",", $this->security->xss_clean($this->input->post('model_ids')));
        $productId =  $this->security->xss_clean($this->input->post('productId'));
        if ($productId) {
            // die($productId);
            // $product_item = $this->getProductItemData($productId);
            $model_info   = $this->pro_model->getAllModelInfo($maker_ids, $category_ids);

            // echo "<pre>";
            // print_r($model_info);
            // exit;

            $query = $this->db->get_where('product_items', array('product_id' => $productId, 'item_id' => 1));

            $pdtDropdownData =  $query->result_array();

            $this->db->select('value, model_id')->from('product_items pi');
            $this->db->where('product_id', $productId);
            $this->db->where('item_id', 1);
            $this->db->group_by(array('pi.value', 'pi.model_id'));
            $query = $this->db->get();
            $groupByData = $query->result_array();

            if (count($model_info) > 0) {

                $all_language_data  = get_admin_lang_data(array('general_instruction'), $this->lang->default_lang_id);

                $pageData = array(
                    'category_ids'=> $category_ids,
                    'model_info'                 => $model_info,
                    'product_model_items'        => $this->product_items_model->getproductitems_data('product_model'),
                    'selectedmodelids'           => $model_ids,
                    'product_relation_dropdown'  => $pdtDropdownData,
                    'product_relation_group_by_dropdown' => $groupByData,
                    'general_instruction'        => $all_language_data['general_instruction']
                );
                $html .= $this->load->view('admin/part_relation/model_attribute_edit_form', $pageData);
            }
        }
        echo $html;
    }



    /**
     * Method checkPartNumber
     * This Function checked that is part number   exist in the products or not.
     * @param $part_relation_id $part_relation_id [This parameter is the product id.]
     *
     * @return void
     */
    public function checkPackage()
    {
        $packages = explode(",", $this->input->post('packges_num'));
        $item_width = $this->security->xss_clean($this->input->post('item_width'));
        $item_length = $this->security->xss_clean($this->input->post('item_length'));
        $item_weight = $this->security->xss_clean($this->input->post('item_weight'));
        $item_height = $this->security->xss_clean($this->input->post('item_height'));
        if ($packages) {
            // this function check is record exist in the table with number  or not.
            $exists = $this->package_model->check_validbox($packages, $item_height, $item_width, $item_length, $item_weight);

            if ($exists >= count($packages)) {
                // if exist than this code return false
                echo json_encode(TRUE);
            } else {
                // if not  exist than this code return true
                echo json_encode(FALSE);
            }
        } else {
            echo json_encode(FALSE);
        }
        exit;
    }

    private function fetchProductAllDataById ($productId = '') {
        $this->db->select('pro.* , pd.*,pd.id as prd_id,, group_concat(DISTINCT(pm.category_id)) as vehicle_category_id, group_concat(DISTINCT(pm.maker_id)) as maker_id, group_concat(DISTINCT(pm.model_id)) as model_id, con.countryName as country, PC.lang_part_name, PTC.lang_product_type_name, CL.lang_countryName');
        $this->db->from('products as pro');
        $this->db->join('countries as con', 'pro.country_id = con.id', 'left');
        $this->db->join('product_models as pm', 'pro.id = pm.product_id', 'inner');
        $this->db->join('product_details as pd', 'pro.id = pd.product_id', 'inner');
        $this->db->join('products_country as PC', 'pro.id = PC.lang_id AND PC.country_id =' . $this->lang->default_lang_id, 'left');
        $this->db->join('tbl_product_types_country as PTC', 'pro.product_type_id = PTC.lang_id AND PTC.country_id =' . $this->lang->default_lang_id, 'left');
        $this->db->join('countries_lang as CL', 'pro.country_id = CL.lang_id AND CL.country_id =' . $this->lang->default_lang_id, 'left');
        $this->db->where('pro.id', $productId);
        $edit_data = $this->db->get()->row_array();

        return $edit_data;
    }
    function delete_model_groups_data($product_type_id,$model_id,$productids){
        $this->comman_model->delete_where('model_groups', array('product_type_id' => $product_type_id,'model_id'=>$model_id));
         $query=$this->db->query('select id,product_type_id from products where product_type_id="'.$product_type_id.'" AND id NOT IN('.$productids.')')->result_array();
         $product_id = array();
         if(!empty($query)){
             foreach($query as $res){
                 $product_id[] =$res['id']   ;
             }
         }
         $product_id = implode(',',$product_id);
         
        $count= $this->db->query('select * from product_models where model_id="'.$model_id.'" AND product_id IN("'.$product_id.'")')->row_array();
         if(count($count)>0){
             $record_insert = array(
                 'product_type_id'=>$product_type_id,
                 'category_id' =>$count['category_id'],
                 'maker_id'=>$count['maker_id'],
                 'model_id'=>$model_id,
                 'status'=>1

             );
             $this->db->insert('model_groups',  $record_insert);
         }
       

    }


    //AR
     /**
     * Method ar_getPackages
     * This Function get all the packages based on the inputed width . height etc..
     * @param $part_relation_id $part_relation_id [This parameter is the product id.]
     *
     * @return void
     */
    public function ar_getPackages()
    {
       // unset($this->session);  session_write_close();
      //  echo __FILE__;exit;
        $item_width = $this->security->xss_clean($this->input->post('item_width'));
        $item_length = $this->security->xss_clean($this->input->post('item_length'));
        $item_weight = $this->security->xss_clean($this->input->post('item_weight'));
        $item_height = $this->security->xss_clean($this->input->post('item_height'));
       // echo $item_width .'x'. $item_length .'x'.$item_weight .'x'.$item_height .'<br>' ;
      //   $item_width = 10;
        // $item_length =10;
        // $item_weight = 10;
        // $item_height =10;


        if ($item_width || $item_width ||  $item_weight || $item_height) {
            // this function check is record exist in the table with number  or not.
            $results = $this->package_model->ar_getPackageData($item_height, $item_width, $item_length, $item_weight);
            //print_r($results);

            if ($results) {
                // if exist than this code return false
               echo json_encode($results);
            } else {
                // if not  exist than this code return true
               echo json_encode(FALSE);
            }
        } else {
            echo json_encode(FALSE);
        }
        exit;
    }


}
