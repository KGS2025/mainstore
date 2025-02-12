<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Makers
 * Makers Class handle all methods  related to product types  like list, add , edit , delete.
 */
class Makers extends CI_Controller
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
        $this->load->model(array('comman_model', 'product_maker_model', 'product_model', 'vehicle_categories_model', 'part_relation_model'));
        $this->load->helper('assets');
        validateAdminLogin();
        validateUser();
    }

    /**
     * Method index
     * This function list all product makers. 
     * @param $param1='' $param1 [This parameter is used for pagination.]
     * @param $param2=0 $param2 [This parameter is used for pagination.]
     *
     * @return void
     */
    function index($param1 = '', $param2 = 0)
    {

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('makers');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $userLangData = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id);
        $admin_static_links = $userLangData['admin_static_links'];
        $all_product_makers =  $this->part_relation_model->all_product_makers();

        if ($this->input->post('DeleteAll')) {
            if (!empty($all_product_makers)) {
                
                $this->db->select('*');
                $this->db->where_not_in('id', $all_product_makers);
                $data_result =     $this->db->get('tbl_makers')->result_array();
                if(!empty($data_result)){
                foreach($data_result as $data){
                    if (file_exists("assets/uploads/product_maker/" . $data['maker_logo'])){
                        unlink("assets/uploads/product_maker/" . $data['maker_logo']);
                    }
                        $with_lang = $this->comman_model->deleteDataWithLangById('tbl_makers', $data['id'], 1);
                    
                    }
                }
                $this->db->where_not_in('id', $all_product_makers);
                $this->db->delete('tbl_makers');
            }else{
                $this->comman_model->deleteAllDataWithLang('tbl_makers', 1);
                $this->comman_model->delete_all_data('tbl_makers');
                $files = glob('assets/uploads/product_maker/*'); // get all file names
                foreach ($files as $file) { // iterate files
                    if (is_file($file))
                        unlink($file); // delete file
                }
            }

            $this->session->set_flashdata('success', $admin_static_links['data_success_with_exist']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/makers');
        }

        if ($this->input->post('DeleteSelected')) {

            // this function delete product makers as per ids passed in the post parameter
            $selectedproductmakertodelete = $this->security->xss_clean($this->input->post('deleteitem'));
            
            $product_maker_used = array_diff($selectedproductmakertodelete, $all_product_makers);
            
            foreach ($product_maker_used as $makertodelete) {

                $p_type_data = $this->comman_model->get_data_by_id('tbl_makers', array('id' => $makertodelete));
                
                // $models_data = $this->comman_model->get_all_data_by_id('tbl_models', array('maker_id' => $makertodelete));

                // this functon delte maker as per maker id
                $result = $this->comman_model->deleteDataWithLangById('tbl_makers', $makertodelete, 1);

                if ($result) {
                    // this functiond delete images related to makers and their models

                    if (file_exists("assets/uploads/product_maker/" . $p_type_data['maker_logo']))
                        unlink("assets/uploads/product_maker/" . $p_type_data['maker_logo']);

                    // this loop delete the image of each model
                    // foreach ($models_data as $model) {
                    //     if (file_exists("assets/uploads/product_model/" . $model['model_photo']))
                    //         unlink("assets/uploads/product_model/" . $item['model_photo']);
                    // }
                }
            }

            $this->session->set_flashdata('success', $admin_static_links['data_success_with_exist']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/makers');
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

        $config['per_page']  = 10;
        $config['num_links'] = 5;
        if ($key) {
            // this code executed when pagination parameter is set
            $config['base_url']   = base_url() . "admin/" . $this->lang->default_lang . "/makers/index/" . $key;
            $config['total_rows'] = $this->comman_model->record_search_count('tbl_makers', $key, array('maker_name'));
        } else {
            $config['base_url']   = base_url() . "admin/" . $this->lang->default_lang . "/makers/index/";
            $config['total_rows'] = $this->comman_model->record_count('tbl_makers');
        }

        $config['uri_segment'] = $uri_segment;
        $config['first_link']  = '<< First';
        $config['last_link']   = 'Last >>';
        $config['next_link']   = 'Next ' . '&gt;';
        $config['prev_link']   = '&lt;' . ' Previous';

        $this->pagination->initialize($config);

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products'), $this->lang->default_lang_id);

        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('product_maker', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'makers',
            'addscripts'            => 'makers_list',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->product_maker_model->search_maker_data($key, $config['per_page'], $offset, $this->lang->default_lang_id),
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
        $this->load->view('admin/product_maker/makers_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method delete_product
     * This Function delete single maker  as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the maker id. ]
     *
     * @return void
     */
    function delete_maker($id)
    {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('makers');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        $userLangData = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id);
        $admin_static_links = $userLangData['admin_static_links'];
        $all_product_makers =  $this->part_relation_model->all_product_makers();
        
        if (!in_array($id, $all_product_makers)) {
            $p_type_data = $this->comman_model->get_data_by_id('tbl_makers', array('id' => $id));
            
            // this function delete maker records from  tbl_makers and  tbl_makers_country as per id
            $result = $this->comman_model->delete_where('tbl_makers ', array('id' => $id));
            removeLangContent('tbl_makers_country', $id);
            if ($result) {

                // this function delete product maker image
                if (file_exists("assets/uploads/product_maker/" . $p_type_data['maker_logo']))
                    unlink("assets/uploads/product_maker/" . $p_type_data['maker_logo']);

            }
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);
        } else {
            $this->session->set_flashdata('success', $admin_static_links['data_exist_in_other']);
        }
        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/makers');
    }

    /**
     * Method add_productmakers
     * This Function Display Add product maker and save the new maker   in the database.
     * @return void
     */
    function add_productmakers()
    {

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('makers');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction'), $this->lang->default_lang_id);
        $all_product_makers =  $this->part_relation_model->all_product_makers();


        if ($this->input->post('operation')) {

            // this  code  executed when user submit the form.

            // this array is intialized to save in the database
            $post_data = array(
                'maker_name'            => $this->input->post('pro_makername'),
                'vehicle_category_id'   => implode(',', $this->input->post('vehicle_category_id')),
                'status'                => $this->input->post('status')
            );

            if (!empty($_FILES['pro_makerlogo']['name'])) {
                // this  code  executed when user upload  the image.

                // these variables are intialized for  image file
                $config['upload_path']      = './assets/uploads/product_maker';
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = '2048';
                $config['max_width']        = '100000';
                $config['max_height']       = '10000';
                $config['file_name']        = getRandomFileName($_FILES['pro_makerlogo']['name'], 'pro_maker_logo');
                $this->load->library('upload', $config);
                $this->load->library('image_lib');

                if (!$this->upload->do_upload('pro_makerlogo')) {
                    $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction->client_logo->front) ? $form_validation_instruction->client_logo->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                    // if file is not uploaded than  this function set error  message in flash to display on frontend.
                    $this->session->set_flashdata('error', $error_lang);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/makers/add_productmakers');
                }

                $upload_data = $this->upload->data();
                if ($upload_data['file_name']) {
                    //this function set image name for save in the database
                    $post_data['maker_logo'] = $upload_data['file_name'];

                    /***************** Resize image  *****************/
                    do_resize($config['upload_path'], $upload_data['file_name']);
                    /***************** Resize image  *****************/
                }
            }

            $post_data = $this->security->xss_clean($post_data);
            // this function add new maker  in the database
            $this->comman_model->add('tbl_makers', $post_data);

            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/makers');
        }

        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('product_maker', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'makers',
            'addscripts'            => 'add_productmakers',
            'sub_menu'              => 'add_article',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_products'        => $all_language_data['admin_products'],
            'product_catagory'      => $this->vehicle_categories_model->getallvehiclecategory_data($this->lang->default_lang_id),
            'all_product_makers' => $all_product_makers

        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/product_maker/product_maker_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method edit_maker
     * This Function Display edit  form and update the maker  on the behalf of  id passed in the parameter.
     * @param $id $id [This Parameter is the maker  id. ]
     *
     * @return void
     */
    function edit_maker($id = false)
    {
        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect('admin/makers');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('makers');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        $edit_data = $this->comman_model->get_data_by_id('tbl_makers', array('id' => $id));

        $all_product_makers =  $this->part_relation_model->all_product_makers();
        $all_product_cat =  $this->part_relation_model->all_product_categories();

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_products', 'form_validation_instruction'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            // this array is intialized to update in the database


            if (in_array($edit_data['id'], $all_product_makers)) {
                $post_data = array(
                    'maker_name'            => $this->input->post('pro_makername'),
                    'status' =>  $edit_data['status']
                );
            } else {

                $post_data = array(
                    'maker_name'            => $this->input->post('pro_makername'),
                    'status'            => $this->input->post('status'),
                );
            }


            $post_cate = $this->input->post('vehicle_category_id');


           

            if (isset($post_cate) && !empty($post_cate)) {
               
                // // $exis_cat = implode(",", $edit_data['vehicle_category_id']);
                // // $update_cat = $this->input->post('vehicle_category_id');
                // $final_cat = implode(",", array_unique(array_merge($exis_cat, $update_cat)));
                $final_cat = implode(",",$this->input->post('vehicle_category_id'));
                $post_data['vehicle_category_id'] = $final_cat;
            }


            if (!empty($_FILES['pro_makerlogo']['name'])) {
                // these variables are intialized for  image file
                $config['upload_path']      = './assets/uploads/product_maker';
                $config['allowed_types']    = 'gif|jpg|png|pdf';
                $config['max_size']         = '1024';
                $config['max_width']        = '100000';
                $config['max_height']       = '10000';
                $config['file_name']        = getRandomFileName($_FILES['pro_makerlogo']['name'], 'pro_maker_logo');
                $this->load->library('upload', $config);
                $this->load->library('image_lib');

                if (!$this->upload->do_upload('pro_makerlogo')) {
                    $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction->client_logo->front) ? $form_validation_instruction->client_logo->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                    // if file is not uploaded than  this function set error  message in flash to display on frontend.
                    $this->session->set_flashdata('error', $error_lang);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/makers/edit_maker/' . $id);
                }

                $upload_data = $this->upload->data();
                if ($upload_data['file_name']) {
                    //this function set image name for save in the database
                    $post_data['maker_logo'] = $upload_data['file_name'];

                    /***************** Resize image  *****************/
                    do_resize($config['upload_path'], $upload_data['file_name']);
                    /***************** Resize image  *****************/
                }
            }

            $post_data = $this->security->xss_clean($post_data);
            $all_data  = $this->comman_model->get_data_by_id('tbl_makers', array('id' => $id));

            // this function update record in the database
            $result = $this->comman_model->update_data_by_id('tbl_makers', $post_data, 'id', $id);
            if ($result && $post_data['maker_logo']) {
                // this function delete previous image if  image is updated
                if (file_exists("assets/uploads/product_maker/" . $all_data['maker_logo'])) {
                    unlink("assets/uploads/product_maker/" . $all_data['maker_logo']);
                }
            }

            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/makers');
        }

        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('product_maker', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'makers',
            'addscripts'            => 'edit_maker',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_products'        => $all_language_data['admin_products'],
            'edit_data'             => $edit_data,
            'product_catagory'      => $this->vehicle_categories_model->getallvehiclecategory_data($this->lang->default_lang_id),
            'all_product_makers' => $all_product_makers,
            'all_product_cat' => $all_product_cat
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/product_maker/product_maker_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method checkMakerName
     * This Function checked that is maker name  exist in the tbl_makers or not.
     * @param $makerId $makerId [This Parameter is the maker  id. ]
     *
     * @return void
     */
    public function checkMakerName($makerId = '')
    {
        $maker_name = $this->security->xss_clean($this->input->post('pro_makername'));
        if ($makerId && $maker_name) {
            $result = $this->comman_model->get_data_by_id('tbl_makers', array('id' => $makerId));
            if ($maker_name == $result['maker_name']) {
                echo json_encode(TRUE);
            } else {
                // this function check is record exist in the table with same name  or not.
                $exists = $this->comman_model->check_row_exists('tbl_makers', array('maker_name' => $maker_name));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        } else if ($maker_name) {
            // this function check is record exist in the table with same name  or not.
            $exists = $this->comman_model->check_row_exists('tbl_makers', array('maker_name' => $maker_name));
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
     * Method delete_makerimage
     * This Function update image field and remove the images from the folder.
     * @param $id $id [This Parameter is the type id. ]
     */
    function delete_makerimage($id)
    {
        validateAdminLogin();
        $post_data['maker_logo'] = '';
        $all_data = $this->comman_model->get_data_by_id('tbl_makers', array('id' => $id));
        $update   = $this->comman_model->update_data_by_id('tbl_makers', $post_data, 'id', $id);
        if ($update) {
            if (file_exists("assets/uploads/product_maker/" . $all_data['maker_logo']))
                unlink("assets/uploads/product_maker/" . $all_data['maker_logo']);
        }
    }
}
