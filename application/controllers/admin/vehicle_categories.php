<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Vehicle_categories
 * Makers Class handle all methods  related to product categories  like list, add , edit , delete.
 */
class Vehicle_categories extends CI_Controller
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
        $this->load->model(array('comman_model', 'vehicle_categories_model', 'product_model', 'industry_model', 'part_relation_model'));
        $this->load->helper('assets');
        validateAdminLogin();
        validateUser();
    }

    /**
     * Method index
     * This function list all product categories. 
     * @param $param1='' $param1 [This parameter is used for pagination.]
     * @param $param2=0 $param2 [This parameter is used for pagination.]
     *
     * @return void
     */
    function index($param1 = '', $param2 = 0)
    {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('vehicle_categories');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $userLangData = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id);

        $admin_static_links = $userLangData['admin_static_links'];

        if ($this->input->post('DeleteAll')) {
            // this code  delete all categories from tbl_vehicle_categories table
            // $this->comman_model->deleteAllDataWithLang('tbl_vehicle_categories', 1);
            $product_cat =  $this->part_relation_model->all_product_categories();
            
            if (!empty($product_cat)) {
                
                $this->db->select('*');
                $this->db->where_not_in('id', $product_cat);
                $data_result =     $this->db->get('tbl_vehicle_categories')->result_array();
                    if(!empty($data_result)){
                    foreach($data_result as $data){
                        if (file_exists("assets/uploads/vehicle_categories/" . $data['VehicleType_Photo'])){
                                unlink("assets/uploads/vehicle_categories/" . $data['VehicleType_Photo']);
                            }
                            if (file_exists("assets/uploads/vehicle_categories/" . $data['vehicle_category_icon'])){
                                unlink("assets/uploads/vehicle_categories/" . $data['vehicle_category_icon']);
                            }   

                            if (file_exists("assets/uploads/vehicle_categories/" . $data['menu_image'])){
                                unlink("assets/uploads/vehicle_categories/" . $data['menu_image']);
                            }

                            $with_lang = $this->comman_model->deleteDataWithLangById('tbl_vehicle_categories', $data['id'], 1);
                        
                        }
                    }
                    $this->db->where_not_in('id', $product_cat);
                    $this->db->delete('tbl_vehicle_categories');

                    // $this->db->where_not_in('id', $product_cat);
                    // $this->db->delete('tbl_vehicle_categories');
            }else{
                $this->comman_model->deleteAllDataWithLang('tbl_vehicle_categories', 1);
                $this->comman_model->delete_all_data('tbl_vehicle_categories');
                $files = glob('assets/uploads/vehicle_categories/*'); // get all file names
                foreach ($files as $file) { // iterate files
                    if (is_file($file))
                        unlink($file); // delete file
                }
            }
            // this function update products table after delete the category
            // $update_data = array(
            //     'vehicle_category_id' => ""
            // );
            // $this->db->update('tbl_product_category_maker_model_relation', $update_data);

            // // this function delete all image files from vehicle_categories  folder
            

            // // this function delete all image files from product_images  folder
            // $files = glob('assets/uploads/product_images/*'); // get all file names
            // foreach ($files as $file) { // iterate files
            //     if (is_file($file))
            //         unlink($file); // delete file
            // }


            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_success_with_exist']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/vehicle_categories');
        }

        if ($this->input->post('DeleteSelected')) {

            // this function delete product categories as per ids passed in the post parameter
            $selectedvehiclecategories = $this->security->xss_clean($this->input->post('deleteitem'));
            $product_cat =  $this->part_relation_model->all_product_categories();
            $product_used = array_diff($selectedvehiclecategories, $product_cat);

            // print_r($product_used);
            // exit;


            // if (!in_array($id, $product_cat)) {
            // }

            foreach ($product_used as $vehtodelete) {

                $p_type_data = $this->comman_model->get_data_by_id('tbl_vehicle_categories', array('id' => $vehtodelete));

                $result = $this->comman_model->deleteDataWithLangById('tbl_vehicle_categories', $vehtodelete, 1);

                if ($result) {

                    // this function delete images related to categories 

                    if (file_exists("assets/uploads/vehicle_categories/" . $p_type_data['VehicleType_Photo']))
                        unlink("assets/uploads/vehicle_categories/" . $p_type_data['VehicleType_Photo']);

                    if (file_exists("assets/uploads/vehicle_categories/" . $p_type_data['vehicle_category_icon']))
                        unlink("assets/uploads/vehicle_categories/" . $p_type_data['vehicle_category_icon']);

                    if (file_exists("assets/uploads/vehicle_categories/" . $p_type_data['menu_image']))
                        unlink("assets/uploads/vehicle_categories/" . $p_type_data['menu_image']);
                }
            }

            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_success_with_exist']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/vehicle_categories');
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

        $plang        = $this->comman_model->getPrimaryLang();
        $primary_lang = !empty($plang) ? $plang['short_code'] : 'en';

        if ($key) {
            // this code executed when pagination parameter is set
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/vehicle_categories/index/" . $key;
            $config['total_rows']   = $this->comman_model->record_search_count('tbl_vehicle_categories', $key, array('category_name'));
        } else {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/vehicle_categories/index/";
            $config['total_rows']   = $this->comman_model->record_count('tbl_vehicle_categories');
        }

        $config['per_page']     = 10;
        $config['num_links']    = 5;
        $config['uri_segment']  = $uri_segment;
        $config['first_link']   = '<< First';
        $config['last_link']    = 'Last >>';
        $config['next_link']    = 'Next ' . '&gt;';
        $config['prev_link']    = '&lt;' . ' Previous';

        if ($this->lang->default_lang != $primary_lang && $key != '') {
            $all_data       = $this->vehicle_categories_model->getLanagugeVehicleCategories($key, $this->lang->default_lang_id);
            if (empty($all_data)) {
                $all_data   = $this->vehicle_categories_model->search_vehicle_category_data('tbl_vehicle_categories', $key, 'category_name', $config['per_page'], $offset, $this->lang->default_lang_id);
            }
        } else {
            $all_data       = $this->vehicle_categories_model->search_vehicle_category_data('tbl_vehicle_categories', $key, 'category_name', $config['per_page'], $offset, $this->lang->default_lang_id);
        }

        $this->pagination->initialize($config);

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('vehicle_category', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'vehicle_categories',
            'addscripts'            => 'product_catagory_list',
            'primary_lang'          => $primary_lang,
            'all_data'              => $all_data,
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
        $this->load->view('admin/product_catagory/product_catagory_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method delete
     * This Function delete single category  as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the category id. ]
     *
     * @return void
     */
    function delete($id)
    {
       // this function validate the access of this page for current logged admin user.
       $access = validatePageAccess('vehicle_categories');
       
       if ($access['page_delete'] != 1) {
        // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];

        $userLangData = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id);
        $admin_static_links = $userLangData['admin_static_links'];
        $product_cat =  $this->part_relation_model->all_product_categories();
            
        if (!in_array($id, $product_cat)) {
            $p_type_data = $this->comman_model->get_data_by_id('tbl_vehicle_categories', array('id' => $id));
            $result = $this->comman_model->delete_where('tbl_vehicle_categories', array('id' => $id));
            removeLangContent('tbl_vehicle_categories_country', $id);
            if ($result) {
                // this function delete images related to categories 
                if (file_exists("assets/uploads/vehicle_categories/" . $p_type_data['VehicleType_Photo']))
                    unlink("assets/uploads/vehicle_categories/" . $p_type_data['VehicleType_Photo']);

                if (file_exists("assets/uploads/vehicle_categories/" . $p_type_data['vehicle_category_icon']))
                    unlink("assets/uploads/vehicle_categories/" . $p_type_data['vehicle_category_icon']);

                if (file_exists("assets/uploads/vehicle_categories/" . $p_type_data['menu_image']))
                    unlink("assets/uploads/vehicle_categories/" . $p_type_data['menu_image']);
            }
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);
        } else {

            $this->session->set_flashdata('success', $admin_static_links['data_exist_in_other']);
        }

        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/vehicle_categories');
        
    }

    /**
     * Method add_product_category
     * This Function Display Add product category form  and save the new category   in the database.
     * @return void
     */
    function add_product_category()
    {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('vehicle_categories');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {

            // this  code  executed when user submit the form.

            // these variables are intialized for  image file
            $config['upload_path']      = './assets/uploads/vehicle_categories';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = '2048';
            $config['max_width']        = '100000';
            $config['max_height']       = '10000';
            $config['file_name']        = getRandomFileName($_FILES['VehicleType_Photo']['name'], 'pro_category_logo');
            $this->load->library('upload', $config);
            $this->load->library('image_lib');

            // this array is intialized to save in the database
            $post_data = array(
                'category_name' => $this->input->post('category_name'),
                'industries' => $this->input->post('industries'),
                'status'        => $this->input->post('status'),
                'created_date'  => date('Y-m-d')
            );

            // this  code  executed when user upload  the category  image. 
            if (file_exists($_FILES['VehicleType_Photo']['tmp_name']) || is_uploaded_file($_FILES['VehicleType_Photo']['tmp_name'])) {

                if (!$this->upload->do_upload('VehicleType_Photo')) {
                    $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction->client_logo->front) ? $form_validation_instruction->client_logo->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                    // if file is not uploaded than  this function set error  message in flash to display on frontend.
                    $this->session->set_flashdata('error', $error_lang);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/vehicle_categories/add_product_category');
                }

                $upload_data = $this->upload->data();
                if ($upload_data['file_name'] != '') {
                    //this function set image name for save in the database
                    $post_data['VehicleType_Photo'] = $upload_data['file_name'];

                    /***************** Resize image  *****************/
                    do_resize($config['upload_path'], $post_data['VehicleType_Photo']);
                    /***************** Resize image  *****************/
                }
            }

            // this  code  executed when user upload  the category  icon. 
            if (file_exists($_FILES['vehicle_category_icon']['tmp_name']) || is_uploaded_file($_FILES['vehicle_category_icon']['tmp_name'])) {
                $config['file_name'] = getRandomFileName($_FILES['vehicle_category_icon']['name'], 'category_icon');
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('vehicle_category_icon')) {
                    $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction->client_logo->front) ? $form_validation_instruction->client_logo->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                    // if file is not uploaded than  this function set error  message in flash to display on frontend.
                    $this->session->set_flashdata('error', $error_lang);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/vehicle_categories/add_product_category');
                }

                $upload_data2 = $this->upload->data();
                if ($upload_data2['file_name'] != '') {
                    //this function set icon name for save in the database
                    $post_data['vehicle_category_icon'] = $upload_data2['file_name'];

                    /***************** Resize image  *****************/
                    do_resize($config['upload_path'], $post_data['vehicle_category_icon']);
                    /***************** Resize image  *****************/
                }
            }

            $post_data = $this->security->xss_clean($post_data);
            // this function add new category  in the database
            $this->comman_model->add('tbl_vehicle_categories', $post_data);

            $admin_static_links = $all_language_data['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']['front']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/vehicle_categories');
        }

        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('vehicle_category', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'vehicle_categories',
            'addscripts'            => 'add_product_category',
            'sub_menu'              => 'add_article',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_products'        => $all_language_data['admin_products'],
            'industry'              => $this->industry_model->getIndustryData($this->lang->default_lang_id),
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/product_catagory/product_category_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method edit_product_category
     *  This Function Display edit  form and update the category  on the behalf of  id passed in the parameter.
     * @param $id $id [This Parameter is the category id. ]
     *
     * @return void
     */
    function edit_product_category($id = false)
    {
        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect('admin/vehicle_categories');
        }


        $product_cat =  $this->part_relation_model->all_product_categories();
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('vehicle_categories');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        $edit_data = $this->vehicle_categories_model->getVehicleDataById($id, $this->lang->default_lang_id);
        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction'), $this->lang->default_lang_id);

        check_lang_admin();

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.

            // these variables are intialized for  image file
            $config['upload_path']      = './assets/uploads/vehicle_categories';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = '2048';
            $config['max_width']        = '100000';
            $config['max_height']       = '10000';
            $config['file_name']        = getRandomFileName($_FILES['VehicleType_Photo']['name'], 'pro_category_logo');
            $this->load->library('upload', $config);
            $this->load->library('image_lib');

            if (in_array($edit_data['id'],$product_cat)) {

                // this array is intialized to save in the database
                $post_data = array(
                    'category_name' => $this->input->post('category_name'),
                    'industries' => $this->input->post('industries'),
                    'status' => $edit_data['status']
                );
            } else {

                // this array is intialized to save in the database
                $post_data = array(
                    'category_name' => $this->input->post('category_name'),
                    'industries' => $this->input->post('industries'),
                    'status' => $this->input->post('status')
                );
            }



            // this  code  executed when user upload  the category  image.
            if (file_exists($_FILES['VehicleType_Photo']['tmp_name']) || is_uploaded_file($_FILES['VehicleType_Photo']['tmp_name'])) {
                if (!$this->upload->do_upload('VehicleType_Photo')) {
                    $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction->client_logo->front) ? $form_validation_instruction->client_logo->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                    // if file is not uploaded than  this function set error  message in flash to display on frontend.
                    $this->session->set_flashdata('error', $error_lang);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/vehicle_categories/edit_product_category/' . $id);
                }

                $upload_data = $this->upload->data();
                if ($upload_data['file_name'] != '') {
                    //this function set image name for save in the database
                    $post_data['VehicleType_Photo'] = $upload_data['file_name'];

                    /***************** Resize image  *****************/
                    do_resize($config['upload_path'], $post_data['VehicleType_Photo']);
                    /***************** Resize image  *****************/
                }
            }

            // this  code  executed when user upload  the category  icon. 
            if (file_exists($_FILES['vehicle_category_icon']['tmp_name']) || is_uploaded_file($_FILES['vehicle_category_icon']['tmp_name'])) {
                $config['file_name'] = getRandomFileName($_FILES['vehicle_category_icon']['name'], 'category_icon');
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('vehicle_category_icon')) {
                    $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction->client_logo->front) ? $form_validation_instruction->client_logo->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                    // if file is not uploaded than  this function set error  message in flash to display on frontend.
                    $this->session->set_flashdata('error', $error_lang);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/vehicle_categories/edit_product_category/' . $id);
                }

                $upload_data2 = $this->upload->data();
                if ($upload_data2['file_name'] != '') {
                    //this function set image icon for save in the database
                    $post_data['vehicle_category_icon'] = $upload_data2['file_name'];

                    /***************** Resize image  *****************/
                    do_resize($config['upload_path'], $post_data['vehicle_category_icon']);
                    /***************** Resize image  *****************/
                }
            }
            $post_data = $this->security->xss_clean($post_data);

            $all_data  = $this->comman_model->get_data_by_id('tbl_vehicle_categories', array('id' => $id));

            // this function update  category  in the database
            $result    = $this->comman_model->update_data_by_id('tbl_vehicle_categories', $post_data, 'id', $id);

            if ($result) {
                // after category update this function delete  previous images if images are updated
                if ($post_data['VehicleType_Photo']) {
                    if (file_exists("assets/uploads/vehicle_categories/" . $all_data['VehicleType_Photo']))
                        unlink("assets/uploads/vehicle_categories/" . $all_data['VehicleType_Photo']);
                }

                if ($post_data['vehicle_category_icon']) {
                    if (file_exists("assets/uploads/vehicle_categories/" . $all_data['vehicle_category_icon']))
                        unlink("assets/uploads/vehicle_categories/" . $all_data['vehicle_category_icon']);
                }
            }

            $admin_static_links = $all_language_data['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']['front']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/vehicle_categories');
        }

        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('vehicle_category', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'vehicle_categories',
            'addscripts'            => 'edit_product_category',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_products'        => $all_language_data['admin_products'],
            'edit_data'             => $edit_data,
            'industry'              => $this->industry_model->getIndustryData($this->lang->default_lang_id),
            'product_cat' => $product_cat
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/product_catagory/product_category_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method checkVehicleCategoryName
     * This Function checked that is category name  exist in the tbl_vehicle_categories or not.
     * @param $vehiclecategoryId $vehiclecategoryId [This Parameter is the category id. ]
     *
     * @return void
     */
    public function checkVehicleCategoryName($vehiclecategoryId = '')
    {
        $category_name = $this->input->post('category_name');
        if ($vehiclecategoryId && $category_name) {
            $result = $this->comman_model->get_data_by_id('tbl_vehicle_categories', array('id' => $vehiclecategoryId));
            if ($category_name == $result['category_name']) {
                echo json_encode(TRUE);
            } else {
                // this function check is record exist in the table with same name  or not.
                $exists = $this->comman_model->check_row_exists('tbl_vehicle_categories', array('category_name' => $category_name));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        } else if ($category_name) {
            // this function check is record exist in the table with same name  or not.
            $exists = $this->comman_model->check_row_exists('tbl_vehicle_categories', array('category_name' => $category_name));
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
     * Method del_vehiclecategoryimagepermanently
     * This Function update image field and remove the images in the table as per field name passed in the post parameter.
     * @param $id $id [This Parameter is the id. ]
     * @param $imagetodelete $imagetodelete [This Parameter is the image field name. ]
     * @return void
     */
    function del_vehiclecategoryimagepermanently($id, $imagetodelete)
    {
        validateAdminLogin();
        $post_data[$imagetodelete] = '';

        $all_data = $this->comman_model->get_data_by_id('tbl_vehicle_categories', array('id' => $id));
        $update   = $this->comman_model->update_data_by_id('tbl_vehicle_categories', $post_data, 'id', $id);
        if ($update) {
            if (file_exists("assets/uploads/vehicle_categories/" . $all_data[$imagetodelete]))
                unlink("assets/uploads/vehicle_categories/" . $all_data[$imagetodelete]);
            if (file_exists("assets/uploads/vehicle_categories/thumb/" . $all_data[$imagetodelete]))
                unlink("assets/uploads/vehicle_categories/thumb/" . $all_data[$imagetodelete]);
        }
    }
}
