<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Product_type
 * Product_type Class handle all methods  related to product types  like list, add , edit , delete.
 */
class Product_type extends CI_Controller
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
        $this->load->model(array('comman_model', 'product_type_model', 'product_items_model', 'part_relation_model'));
        $this->load->helper('assets');
        validateAdminLogin();
        validateUser();
    }
    /**
     * Method index
     * This function list all product types. 
     * @param $param1='' $param1 [This parameter is used for pagination.]
     * @param $param2=0 $param2 [This parameter is used for pagination.]
     *
     * @return void
     */
    function index($param1 = '', $param2 = 0)
    {
        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('product_type');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        $userLangData = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id);
        $admin_static_links = $userLangData['admin_static_links'];
        $all_product_group =  $this->part_relation_model->all_product_group();


        if ($this->input->post('DeleteAll')) {

            if(!empty($all_product_group)) {
                
                $this->db->select('*');
                $this->db->where_not_in('id', $all_product_group);
                $data_result =     $this->db->get('tbl_product_types')->result_array();
                if(!empty($data_result)){
                    foreach($data_result as $data){
                        if (file_exists("assets/uploads/product_type_images/" . $data['Product_Type_Photo'])){
                            unlink("assets/uploads/product_type_images/" . $data['Product_Type_Photo']);
                        }
                            $with_lang = $this->comman_model->deleteDataWithLangById('tbl_product_types', $data['id'], 1);
                            
                        }
                    }
            $this->db->where_not_in('id',$all_product_group);
            $this->db->delete('tbl_product_types');
            }else{
                // $this->comman_model->delete_all_data('tbl_product_types');
                $this->comman_model->deleteAllDataWithLang('tbl_product_types', 1);
                $files = glob('assets/uploads/product_type_images/*'); // get all file names
                foreach ($files as $file) { // iterate files
                    if (is_file($file))
                        unlink($file); // delete file
                }
            }

            // // this function  delete all models from tbl_product_types table
            // $this->comman_model->deleteAllDataWithLang('tbl_product_types', 1);

            // // this function delete all image files from product_type_images  folder
            // $files = glob('assets/uploads/product_type_images/*');
            // foreach ($files as $file) { // iterate files
            //     if (is_file($file))
            //         unlink($file); // delete file
            // }

            // $files = glob('assets/uploads/product_images/*'); // get all file names
            // foreach ($files as $file) { // iterate files
            //     if (is_file($file))
            //         unlink($file); // delete file
            // }

            $this->session->set_flashdata('success', $admin_static_links['data_success_with_exist']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/product_type');
        }

        if ($this->input->post('DeleteSelected')) {

            // this function delete product type as per ids passed in the post parameter
            $selectedproducttypestodelete = $this->security->xss_clean($this->input->post('deleteitem'));

            $product_group_used = array_diff($selectedproducttypestodelete, $all_product_group);

            foreach ($product_group_used as $typetodelete) {
                // this function iterate each id and delete record acccordingly 
                $p_type_data = $this->comman_model->get_data_by_id('tbl_product_types', array('id' => $typetodelete));

                // this function update records in tbl_product_types table
                $result = $this->comman_model->deleteDataWithLangById('tbl_product_types', $typetodelete, 1);
                if ($result) {

                    // this function delete product type  file
                    if (file_exists("assets/uploads/product_type_images/" . $p_type_data['Product_Type_Photo']))
                        unlink("assets/uploads/product_type_images/" . $p_type_data['Product_Type_Photo']);
                }
            }

            $this->session->set_flashdata('success', $admin_static_links['data_success_with_exist']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/product_type');
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

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_products'), $this->lang->default_lang_id);
        $plang              = $this->comman_model->getPrimaryLang();
        $primary_lang       = !empty($plang) ? $plang['short_code'] : 'en';

        $config['per_page']  = 10;
        $config['num_links'] = 5;
        if ($key) {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/product_type/index/" . $key;
            $config['total_rows']   = $this->comman_model->record_search_count('tbl_product_types', $key, array('product_type_name'));
        } else {
            $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/product_type/index/";
            $config['total_rows']   = $this->comman_model->record_count('tbl_product_types');
        }

        $config['uri_segment'] = $uri_segment;
        $config['first_link']  = '<< First';
        $config['last_link']   = 'Last >>';
        $config['next_link']   = 'Next ' . '&gt;';
        $config['prev_link']   = '&lt;' . ' Previous';

        $key = trim($this->security->xss_clean($this->input->post('search')));
        if ($this->lang->default_lang != $primary_lang && $key != '') {
            $all_data = $this->product_type_model->getLanagugeProductTypes($key, $this->lang->default_lang_id);
            if (empty($all_data)) {
                $all_data = $this->product_type_model->search_producttype_data($key, $config['per_page'], $offset, $this->lang->default_lang_id);
            }
        } else {
            $all_data = $this->product_type_model->search_producttype_data($key, $config['per_page'], $offset, $this->lang->default_lang_id);
        }

        $this->pagination->initialize($config);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('product_type', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'product_type',
            'addscripts'            => 'product_type_list',
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
        $this->load->view('admin/product_type/product_type_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method delete_product
     * This Function delete single product type  as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the product type id. ]
     *
     * @return void
     */
    function delete_product($id)
    {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('product_type');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }



        $userLangData = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id);
        $admin_static_links = $userLangData['admin_static_links'];
        $all_product_group =  $this->part_relation_model->all_product_group();
        
        if (!in_array($id, $all_product_group)) {

            $p_type_data = $this->comman_model->get_data_by_id('tbl_product_types', array('id' => $id));

            // this function delete product type from tbl_product_types and tbl_product_types_country  table
            $result = $this->comman_model->delete_where('tbl_product_types', array('id' => $id));
            removeLangContent('tbl_product_types_country', $id);

            if ($result) {
                // this function delete product type image from the product_type_images folder.
                if (file_exists("assets/uploads/product_type_images/" . $p_type_data['Product_Type_Photo'])) {
                    unlink("assets/uploads/product_type_images/" . $p_type_data['Product_Type_Photo']);
                }
            }

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);
        } else {

            $this->session->set_flashdata('success', $admin_static_links['data_exist_in_other']);
        }
        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/product_type');
    }

    /**
     * Method add_producttype
     * This Function Display Add product type and save the new product type  in the database.
     * @return void
     */
    function add_producttype()
    {

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('product_type');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.

            // these variables are intialized for  image file
            $config['upload_path']      = './assets/uploads/product_type_images';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = '2048';
            $config['max_width']        = '100000';
            $config['max_height']       = '10000';
            if ($_FILES['pro_image']['name']) {
                $config['file_name']        = getRandomFileName($_FILES['pro_image']['name'], 'pro_type_img');
            }
            $this->load->library('upload', $config);
            $this->load->library('image_lib');

            // this code handle menu input data
            $menu_string = '';
            $menu_items  = $this->input->post('menu');
            $menu_string = implode(",", $menu_items);

            $menuadmin_string = '';
            $menuadmin_items  = $this->input->post('menuadmin');
            $menuadmin_string = implode(",", $menuadmin_items);

            // this array is intialized to save in the database
            $post_data = array(
                'product_type_name'     => $this->input->post('pro_typename'),
                'status'                => $this->input->post('status'),
                'menu_privilages'       => $menu_string,
                'menu_privilages_admin' => $menuadmin_string,
                'created_date'          => date('Y-m-d')
            );

            if ($_FILES['pro_image']['name']) {
                if (!$this->upload->do_upload('pro_image')) {
                    $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction->client_logo->front) ? $form_validation_instruction->client_logo->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                    // if file is not uploaded than  this function set error  message in flash to display on frontend.
                    $this->session->set_flashdata('error', $error_lang);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/product_type/add_producttype');
                }
            }
            $upload_data = $this->upload->data();

            if ($_FILES['pro_image']['name']) {
                if ($upload_data['file_name'] != '') {
                    //this function set image name for save in the database
                    $post_data['Product_Type_Photo'] = $upload_data['file_name'];
                    /***************** This Function  Resize image   *****************/
                    do_resize($config['upload_path'], $post_data['Product_Type_Photo']);
                    /***************** Resize image  *****************/
                }
            } else {

                $post_data['Product_Type_Photo'] = "";
            }
            $post_data = $this->security->xss_clean($post_data);

            // this function add new product type  in the database
            $this->comman_model->add('tbl_product_types', $post_data);

            $admin_static_links = $all_language_data['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']['front']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/product_type');
        }

        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('product_type', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'product_type',
            'sub_menu'              => 'add_article',
            'addscripts'            => 'add_producttype',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'product_items'         => $this->product_items_model->getproductitems_data(),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_products'        => $all_language_data['admin_products']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/product_type/product_type_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method edit_product
     * This Function Display edit  form and update the  product type  on the behalf of  id passed in the parameter.
     * @param $id $id [This Parameter is the product type  id. ]
     *
     * @return void
     */
    function edit_product($id)
    {
        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect('admin/product_type');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('product_type');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();





        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction', 'admin_static_links'), $this->lang->default_lang_id);
        $all_product_group =  $this->part_relation_model->all_product_group();
        $edit_data =  $this->product_type_model->getProductTypeById('tbl_product_types', $id, $this->lang->default_lang_id);

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.

            // these variables are intialized for  image file
            $config['upload_path']      = './assets/uploads/product_type_images';
            $config['allowed_types']    = 'gif|jpg|png|pdf';
            $config['max_size']         = '1024';
            $config['max_width']        = '100000';
            $config['max_height']       = '10000';
            $config['file_name']        = getRandomFileName($_FILES['pro_image']['name'], 'pro_type_img');
            $this->load->library('upload', $config);
            $this->load->library('image_lib');

            // this code handle menu input data
            $menu_items  = $this->input->post('menu');
            $menu_string = implode(",", $menu_items);

            $menuadmin_items  = $this->input->post('menuadmin');
            $menu_adminstring = implode(",", $menuadmin_items);


            if (in_array($id, $all_product_group)) {
                // this array is intialized to update in the database
                $post_data = array(
                    'product_type_name'     => $this->input->post('pro_typename'),
                    'menu_privilages'       => $menu_string,
                    'menu_privilages_admin' => $menu_adminstring,
                    'status'=>$edit_data['status']
                );
            } else {
                $post_data = array(
                    'product_type_name'     => $this->input->post('pro_typename'),
                    'menu_privilages'       => $menu_string,
                    'menu_privilages_admin' => $menu_adminstring,
                    'status'                => $this->input->post('status'),
                );
            }

            // if file is uploaded by the user than this code executed
            if (file_exists($_FILES['pro_image']['tmp_name']) || is_uploaded_file($_FILES['pro_image']['tmp_name'])) {
                if (!$this->upload->do_upload('pro_image')) {
                    $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction->client_logo->front) ? $form_validation_instruction->client_logo->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                    // if file is not uploaded than  this function set error  message in flash to display on frontend.
                    $this->session->set_flashdata('error', $error_lang);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/product_type/edit_product/' . $id);
                }
            }

            $upload_data = $this->upload->data();
            if ($upload_data['file_name'] != '') {
                //this function set image name for save in the database
                $post_data['Product_Type_Photo'] = $upload_data['file_name'];
                /***************** Resize image  *****************/
                do_resize($config['upload_path'], $post_data['Product_Type_Photo']);
                /***************** Resize image  *****************/

                // Get previous data for removing old image
                $p_type_data = $this->comman_model->get_data_by_id('tbl_product_types', array('id' => $id));
            }
            $post_data =  $this->security->xss_clean($post_data);

            // this function update record in the database
            $result = $this->comman_model->update_data_by_id('tbl_product_types', $post_data, 'id', $id);

            if ($result && $post_data['Product_Type_Photo']) {
                // this function delete previous image if  image is updated
                if (file_exists("assets/uploads/product_type_images/" . $p_type_data['Product_Type_Photo'])) {
                    unlink("assets/uploads/product_type_images/" . $p_type_data['Product_Type_Photo']);
                }
            }

            $admin_static_links = $all_language_data['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']['front']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/product_type');
        }

        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('product_type', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'product_type',
            'addscripts'            => 'edit_producttype',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'product_items'         => $this->product_items_model->getproductitems_data(),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_products'        => $all_language_data['admin_products'],
            'edit_data'             => $edit_data,
            'all_product_group' => $all_product_group
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/product_type/product_type_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method checkProTypeName
     * This Function checked that is product type  exist in the tbl_product_types or not.
     * @param $productTypeId $productTypeId [This Parameter is the product type  id. ]
     *
     * @return void
     */
    public function checkProTypeName($productTypeId = '')
    {
        $pro_typename =  $this->security->xss_clean($this->input->post('pro_typename'));
        if ($productTypeId && $pro_typename) {
            $result = $this->comman_model->get_data_by_id('tbl_product_types', array('id' => $productTypeId));
            if ($pro_typename == $result['product_type_name']) {
                echo json_encode(TRUE);
            } else {
                // this function check is record exist in the table with same name  or not.
                $exists = $this->comman_model->check_row_exists('tbl_product_types', array('product_type_name' => $pro_typename));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        } else if ($pro_typename) {
            // this function check is record exist in the table with same name  or not.
            $exists = $this->comman_model->check_row_exists('tbl_product_types', array('product_type_name' => $pro_typename));
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
     * Method delete_typeimage
     * This Function update image field and remove the images from the folder.
     * @param $id $id [This Parameter is the type id. ]
     */
    function delete_typeimage($id)
    {
        validateAdminLogin();
        $post_data['Product_Type_Photo'] = '';
        $all_data = $this->comman_model->get_data_by_id('tbl_product_types', array('id' => $id));
        $update   = $this->comman_model->update_data_by_id('tbl_product_types', $post_data, 'id', $id);
        if ($update) {
            if (file_exists("assets/uploads/product_type_images/" . $all_data['Product_Type_Photo']))
                unlink("assets/uploads/product_type_images/" . $all_data['Product_Type_Photo']);
        }
    }
}
