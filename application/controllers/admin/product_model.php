<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Product_model
 * Product_model Class handle all methods  related to models  like list, add , edit , delete.
 */
class Product_model extends CI_Controller
{

    /**
     * Method __construct
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('comman_model', 'pro_model', 'product_maker_model', 'part_relation_model', 'vehicle_categories_model', 'product_items_model'));
        $this->load->helper('assets');
        validateAdminLogin();
        validateUser();
    }

    /**
     * Method index
     * This function list all product models. 
     * @param $param1='' $param1 [This parameter is used for pagination.]
     * @param $param2=0 $param2 [This parameter is used for pagination.]
     *
     * @return void
     */
    function index($param1 = '', $param2 = 0)
    {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('product_model');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $userLangData = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id);
        $admin_static_links = $userLangData['admin_static_links'];
        $all_product_models =  $this->part_relation_model->all_product_models();
        
        if ($this->input->post('DeleteAll')) {

            if (!empty($all_product_models)) {
                $this->db->select('*');
                $this->db->where_not_in('id', $all_product_models);
                $data_result =     $this->db->get('tbl_models')->result_array();

                if(!empty($data_result)){
                    foreach($data_result as $data){
                        if (file_exists("assets/uploads/product_model/" . $data['model_photo'])){
                            unlink("assets/uploads/product_model/" . $data['model_photo']);
                        }
                            $with_lang = $this->comman_model->deleteDataWithLangById('tbl_models', $data['id'], 1);
                            
                        }
                    }
            $this->db->where_not_in('id',$all_product_models);
            $this->db->delete('tbl_models');
            }else{
                // $this->comman_model->delete_all_data('tbl_models');
                $this->comman_model->deleteAllDataWithLang('tbl_models', 1);
                $files = glob('assets/uploads/product_model/*'); // get all file names
                foreach ($files as $file) { // iterate files
                    if (is_file($file))
                        unlink($file); // delete file
                }
            }

            $this->session->set_flashdata('success', $admin_static_links['data_success_with_exist']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/product_model');
        }

        if ($this->input->post('DeleteSelected')) {
            // this function delete product model as per ids passed in the post parameter
            $selectedproductmodeltodelete = $this->input->post('deleteitem');
            
            $product_model_used = array_diff($selectedproductmodeltodelete, $all_product_models);
            foreach ($product_model_used as $modeltodelete) {
                // this function iterate each id and delete record acccordingly 
                $p_type_data = $this->comman_model->get_data_by_id('tbl_models', array('id' => $modeltodelete));
                // this function  delete all models from tbl_models table
                $result = $this->comman_model->deleteDataWithLangById('tbl_models', $modeltodelete, 1);
                if ($result) {
                    // this function delete product model  file
                    if (file_exists("assets/uploads/product_model/" . $p_type_data['model_photo']))
                        unlink("assets/uploads/product_model/" . $p_type_data['model_photo']);
                }
            }

            $this->session->set_flashdata('success', $admin_static_links['data_success_with_exist']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/product_model');
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

        if ($key) {
            $config['base_url'] = base_url() . "admin/" . $this->lang->default_lang . "/product_model/index/" . $key;
        } else {
            $config['base_url'] = base_url() . "admin/" . $this->lang->default_lang . "/product_model/index/";
        }
        $config['per_page']     = 10;
        $config['num_links']    = 5;
        $config['uri_segment']  = $uri_segment;
        $config['first_link']   = '<< First';
        $config['last_link']    = 'Last >>';
        $config['next_link']    = 'Next ' . '&gt;';
        $config['prev_link']    = '&lt;' . ' Previous';
        $config['total_rows']   = $this->pro_model->record_search_count($key);

        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_products'), $this->lang->default_lang_id);
        $plang              = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('product_model', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'product_model',
            'addscripts'            => 'product_model_list',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->pro_model->get_all_model_data($key, $config['per_page'], $offset, $this->lang->default_lang_id),
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
        $this->load->view('admin/product_model/product_model_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method delete_model
     * This Function delete single  model as per the  id passed in the  parameter.
     * @param $id $id  [This Parameter is the model id. ]
     *
     * @return void
     */
    function delete_model($id)
    {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('product_model');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        $userLangData = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id);
        $admin_static_links = $userLangData['admin_static_links'];
        $all_product_models =  $this->part_relation_model->all_product_models();
        
        if (!in_array($id,$all_product_models)) {

            $p_type_data = $this->comman_model->get_data_by_id('tbl_models', array('id' => $id));

            // this function delete model from tbl_models and tbl_models_country  table
            $result = $this->comman_model->delete_where('tbl_models ', array('id' => $id));
            removeLangContent('tbl_models_country', $id);

            if ($result) {
                // this function delete model image from the model folder.
                if (file_exists("assets/uploads/product_model/" . $p_type_data['model_photo']))
                    unlink("assets/uploads/product_model/" . $p_type_data['model_photo']);
            }
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);
        } else {
            $this->session->set_flashdata('success', $admin_static_links['data_exist_in_other']);
        }

        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/product_model');
    }

    /**
     * Method add_model
     * This Function Display Add model form and save the new model in the database.
     * @return void
     */
    function add_model()
    {

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('product_model');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.

            // these variables are intialized for  image file
            $config['upload_path']      = './assets/uploads/product_model';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = '1024';
            $config['max_width']        = '100000';
            $config['max_height']       = '10000';
            $config['file_name']        = getRandomFileName($_FILES['pro_modelimage']['name'], 'pro_model_img');
            $this->load->library('upload', $config);
            $this->load->library('image_lib');

            // this code handle menu input data
            $menu_items  = $this->input->post('menu');
            $menu_string = implode(",", $menu_items);

            $menuadmin_items  = $this->input->post('menuadmin');
            $menu_adminstring = implode(",", $menuadmin_items);

            // this array is intialized to save in the database
            $post_data = array(
                'model_name'            => trim($this->input->post('pro_modelname')),
                'serial_number'         => $this->input->post('serial_number'),
                'maker_id'              => $this->input->post('maker_id'),
                'vehicle_category_id'   => $this->input->post('vehicle_category_id'),
                'status'                => $this->input->post('status'),
                'menu_privilages'       => $menu_string,
                'menu_privilages_admin' => $menu_adminstring,
                'created_date'          => date('Y-m-d')
            );

            if (!$this->upload->do_upload('pro_modelimage')) {
                $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                $error_lang = isset($form_validation_instruction->client_logo->front) ? $form_validation_instruction->client_logo->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';
                // if file is not uploaded than  this function set error  message in flash to display on frontend.
                $this->session->set_flashdata('error', $error_lang);
                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/product_model/add_model');
            }

            $upload_data = $this->upload->data();
            if ($upload_data['file_name'] != '') {
                //this function set image name for save in the database
                $post_data['model_photo'] = $upload_data['file_name'];
                /***************** This Function  Resize image  *****************/
                do_resize($config['upload_path'], $post_data['model_photo']);
                /***************** Resize image  *****************/
            }

            // this function add new model in the database
            $this->comman_model->add('tbl_models', $post_data);

            $admin_static_links = $all_language_data['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']['front']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/product_model');
        }

        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('product_model', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'product_model',
            'sub_menu'              => 'add_article',
            'addscripts'            => 'add_model',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_products'        => $all_language_data['admin_products'],
            'maker_info'            => $this->product_maker_model->getProductMakers(),
            'product_items'         => $this->product_items_model->getproductitems_data('product_model'),
            'product_catagory'      => $this->vehicle_categories_model->getallvehiclecategory_data($this->lang->default_lang_id)
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/product_model/product_model_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method edit_model
     * This Function Display edit  form and update the  product model on the behalf of  id passed in the parameter.
     * @param $id $id [This Parameter is the model id. ]
     *
     * @return void
     */
    function edit_model($id)
    {

        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect('admin/product_model');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('product_model');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction'), $this->lang->default_lang_id);
        $edit_data = $this->comman_model->get_data_by_id('tbl_models', array('id' => $id));
        $all_prduct_model =  $this->part_relation_model->all_product_models();
        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.

            // these variables are intialized for  image file
            $config['upload_path']      = './assets/uploads/product_model';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = '1024';
            $config['max_width']        = '100000';
            $config['max_height']       = '10000';
            $config['file_name']        = getRandomFileName($_FILES['pro_modelimage']['name'], 'pro_model_img');
            $this->load->library('upload', $config);
            $this->load->library('image_lib');

            // this code handle menu input data
            $menu_items  = $this->input->post('menu');
            $menu_string = implode(",", $menu_items);

            $menuadmin_items  = $this->input->post('menuadmin');
            $menu_adminstring = implode(",", $menuadmin_items);

            // this array is intialized to save in the database



           


            if (!in_array($edit_data['id'], $all_prduct_model)) {
                $post_data = array(
                    'model_name'            => trim($this->input->post('pro_modelname')),
                    'serial_number'         => $this->input->post('serial_number'),
                    'maker_id'              => $this->input->post('maker_id'),
                    'vehicle_category_id'   => $this->input->post('vehicle_category_id'),
                    'status'                => $this->input->post('status'),
                    'menu_privilages'       => $menu_string,
                    'menu_privilages_admin' => $menu_adminstring
                );
            } else {
                $post_data = array(
                    'model_name'            => trim($this->input->post('pro_modelname')),
                    'serial_number'         => $this->input->post('serial_number'),
                    'maker_id'              => $this->input->post('maker_id'),
                    'vehicle_category_id'   => $this->input->post('vehicle_category_id'),
                    'status'                =>$edit_data['status'],
                    'menu_privilages'       => $menu_string,
                    'menu_privilages_admin' => $menu_adminstring
                );
            }

            // if file is uploaded by the user than this code executed
            if (file_exists($_FILES['pro_modelimage']['tmp_name']) || is_uploaded_file($_FILES['pro_modelimage']['tmp_name'])) {

                if (!$this->upload->do_upload('pro_modelimage')) {
                    $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction->client_logo->front) ? $form_validation_instruction->client_logo->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                    // if file is not uploaded than  this function set error  message in flash to display on frontend.
                    $this->session->set_flashdata('error', $error_lang);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/product_model/edit_model/' . $id);
                }

                $upload_data = $this->upload->data();
                if ($upload_data['file_name'] != '') {
                    //this function set image name for save in the database
                    $post_data['model_photo'] = $upload_data['file_name'];

                    /***************** Resize image  *****************/
                    do_resize($config['upload_path'], $post_data['model_photo']);
                    /***************** Resize image  *****************/

                    // Get previous data for removing old image
                    $p_type_data = $this->comman_model->get_data_by_id('tbl_models', array('id' => $id));
                }
            }

            // this function update record in the database
            $result = $this->comman_model->update_data_by_id('tbl_models', $post_data, 'id', $id);
            if ($result && $post_data['model_photo']) {
                if (file_exists("assets/uploads/product_model/" . $p_type_data['model_photo'])) {
                    unlink("assets/uploads/product_model/" . $p_type_data['model_photo']);
                }
            }

            $admin_static_links = $all_language_data['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']['front']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/product_model');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_products'), $this->lang->default_lang_id);
        $plang              = $this->comman_model->getPrimaryLang();


        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('product_model', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'product_model',
            'addscripts'            => 'edit_product_model',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_products'        => $all_language_data['admin_products'],
            // 'maker_info'            => $this->product_maker_model->getProductMakers(),
            'product_items'         => $this->product_items_model->getproductitems_data('product_model'),
            'product_catagory'      => $this->vehicle_categories_model->getallvehiclecategory_data($this->lang->default_lang_id),
            'edit_data'             => $edit_data,
            'all_prduct_model' => $all_prduct_model
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/product_model/product_model_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method checkSerialNumber
     * This Function checked that is model  exist in the tbl_models or not.
     * @param $productModelId $productModelId [This Parameter is the model id. ]
     *
     * @return void
     */
    public function checkSerialNumber($productModelId = '')
    {
        $serial_number = $this->input->post('serial_number');
        if ($productModelId && $serial_number) {
            $result = $this->comman_model->get_data_by_id('tbl_models', array('id' => $productModelId));
            if ($serial_number == $result['serial_number']) {
                echo json_encode(TRUE);
            } else {
                // this function check is record exist in the table with same serial number or not.
                $exists = $this->comman_model->check_row_exists('tbl_models', array('serial_number' => $serial_number));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        } else if ($serial_number) {
            // this function check is record exist in the table with same serial number or not.
            $exists = $this->comman_model->check_row_exists('tbl_models', array('serial_number' => $serial_number));
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
     * Method delete_modelimage
     * This Function update image field and remove the images from the folder.
     * @param $id $id [This Parameter is the type id. ]
     */
    function delete_modelimage($id)
    {
        validateAdminLogin();
        $post_data['model_photo'] = '';
        $all_data = $this->comman_model->get_data_by_id('tbl_models', array('id' => $id));
        $update   = $this->comman_model->update_data_by_id('tbl_models', $post_data, 'id', $id);
        if ($update) {
            if (file_exists("assets/uploads/product_model/" . $all_data['model_photo']))
                unlink("assets/uploads/product_model/" . $all_data['model_photo']);
        }
    }

    /**
     * Method getProductMakersByCategory
     *
     * @return void
     */
    function getProductMakersByCategory()
    {
        $categoryId = $this->input->post('categoryId');
        $makerId = $this->input->post('makerId');
        $this->db->select('*');
        $this->db->from('tbl_makers');
        $this->db->where('tbl_makers.status', 1);
        $this->db->where('FIND_IN_SET("' . $categoryId . '",tbl_makers.vehicle_category_id) <>', '0');
        $query = $this->db->get();
        $result = $query->result_array();
        echo $this->db->last_query();
        $html = '';
        if (count($result) > 0) {
            foreach ($result as $maker) {
                if (!empty($makerId) && $makerId == $maker['id']) {
                    $html .= '<option value="' . $maker['id'] . '" selected>' . $maker['maker_name'] . '</option>';
                } else {
                    $html .= '<option value="' . $maker['id'] . '">' . $maker['maker_name'] . '</option>';
                }
            }
        }
        echo $html;
    }
}
