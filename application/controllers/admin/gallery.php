<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Distributor
 * Distributor Class handle all methods  related to Distributors  like list, add , edit , delete.
 */
class Gallery extends CI_Controller
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
        $this->load->model(array('comman_model', 'gallery_model'));
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

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('gallery');


        if ($access['page_access'] != 1 || $this->config->item('enable_distributor_feature') == "0") {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteAll')) {
            // this function delete all records from package table.
            $this->comman_model->deleteAllDataWithLang('gallery_items');
        }

        if ($this->input->post('DeleteSelected')) {
            // this function delete  records from package table as per the selected ids.
            $deletedIds = $this->security->xss_clean($this->input->post('deleteitem'));
            $this->comman_model->deleteAllById('gallery_items', $deletedIds);
        }

        $key = '';

        $config['base_url']         = base_url() . "admin/" . $this->lang->default_lang . "/gallery/index/";
        $config['total_rows']       = $this->comman_model->record_count('gallery_items');
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

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_gallery', 'cart_instruction'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('gallery_block', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'gallery',
            'addscripts'            => 'gallery',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->gallery_model->search_distributor_data('gallery_items', $key, 'name', $config['per_page'], $offset, $this->lang->default_lang_id),
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'cart_instruction'    => $all_language_data['cart_instruction'],
            'admin_gallery'         => $all_language_data['admin_gallery']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/gallery/list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method delete_gallery
     *  This Function delete single gallery as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the gallery id. ]
     *
     * @return void
     */
    function delete_gallery($id)
    {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('gallery');
        if ($access['page_delete'] != 1 || $this->config->item('enable_distributor_feature') == "0") {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        $this->comman_model->delete_where('gallery_items ', array('id' => $id));

        // this function update products table after delete the package

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/gallery');
    }

    /**
     * Method add_gallery
     * This Function Display Add gallery form and save the new package in the database.
     * @return void
     */
    function add_gallery()
    {




        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('gallery');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_gallery', 'form_validation_instruction'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();


        if ($this->input->post('operation')) {

            // this array is intialized to save in the database
            $post_data = array(
            'name'   => trim($this->input->post('name')),
            'url'   => trim($this->input->post('url')),
            'images'   => isset($upload_data['images']) ? $upload_data['images'] : '',
            'status'   => trim($this->input->post('status'))
            );



            // this  code  executed when user upload  the product   image. 
            if (!empty($_FILES['images']['name'][0])) {

            $config['upload_path']      = './assets/uploads/gallery';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = '2048';
            $config['max_width']        = '100000';
            $config['max_height']       = '10000';
            if (!empty($_FILES['images'])) {
            foreach ($_FILES['images']['name'] as $key => $item_real_photo) {
            $config['file_name'][]     = getRandomFileName($item_real_photo, 'images');
            $config['file_type'][]     = $_FILES['images']['type'][$key];
            }
            } else {
            $config['file_name']     = [];
            $config['file_type']     = [];
            }
            $this->load->library('upload', $config);
            $this->load->library('image_lib');

            // print_r($this->upload->do_upload_multiple('item_real_photo'));die;
            if (!$this->upload->do_upload_multiple('images')) {
            $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
            $error_lang = isset($form_validation_instruction->image_file->front) ? $form_validation_instruction->image_file->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

            // if file is not uploaded than  this function set error  message in flash to display on frontend.
            // $this->session->set_flashdata('error', $error_lang);
            // redirect(base_url() . 'admin/' . $this->lang->default_lang . '/gallery/add_gallery');

            $response['status'] = "0";
            $response['element'] = "images";
            $response['message'] = $error_lang;
            echo json_encode($response);
            exit;
            }

            $upload_data = $this->upload->data();

            if ($upload_data['multiple_file_name']) {
            //this function set product image for save in the database

            $post_data['images'] = implode(",", $upload_data['multiple_file_name']);
            /***************** Resize image  *****************/
            foreach ($upload_data['multiple_file_name'] as $img_name) {
            do_resize($config['upload_path'], $img_name);
            }
            /***************** Resize image  *****************/
            }
            }

            // this  code  executed when user submit the form

          
            

            $post_data = $this->security->xss_clean($post_data);
            // this function add  record in the database.
            $this->comman_model->add('gallery_items', $post_data);

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

           // redirect(base_url() . 'admin/' . $this->lang->default_lang . '/distributor');

            $response['status'] = "1";
            $response['message'] = $admin_static_links['data_successfully_updated'];
            echo json_encode($response);
            exit;
        }



        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('gallery_block', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'gallery',
            'addscripts'            => 'add_gallery',
            'sub_menu'              => 'add_gallery',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_gallery'         => $all_language_data['admin_gallery']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/gallery/form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method edit_gallery
     * This Function Display edit gallery form and update  gallery in the database as per the gallery id.
     *
     * @return void
     */
    function edit_gallery($id = false)
    {
        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/gallery');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('gallery');
        if ($access['page_edit'] != 1 ) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_gallery'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        $edit_data =allDataArray($this->comman_model->GetAllDataLangByid('gallery_items', 'id', $id, $this->lang->default_lang_id, 'gallery_items_country'));

        if ($this->input->post('operation')) {

                // this  code  executed when user submit the form
                // this array is intialized to save in the database
                $post_data = array(
                'name'   => trim($this->input->post('name')),
                'url'   => trim($this->input->post('url')),
                'status'   => trim($this->input->post('status'))
                );
                // these variables are intialized for  image file
                // this  code  executed when user upload  the product   image. 
                if (!empty($_FILES['images']['name'][0])) {

                        $config['upload_path']      = './assets/uploads/gallery';
                        $config['allowed_types']    = 'gif|jpg|png|jpeg';
                        $config['max_size']         = '2048';
                        $config['max_width']        = '100000';
                        $config['max_height']       = '10000';
                        if (!empty($_FILES['images'])) {
                        foreach ($_FILES['images']['name'] as $key => $item_real_photo) {
                        $config['file_name'][]     = getRandomFileName($item_real_photo, 'images');
                        $config['file_type'][]     = $_FILES['images']['type'][$key];
                        }
                        } else {
                        $config['file_name']     = [];
                        $config['file_type']     = [];
                        }
                        $this->load->library('upload', $config);
                        $this->load->library('image_lib');

                        // print_r($this->upload->do_upload_multiple('item_real_photo'));die;
                        if (!$this->upload->do_upload_multiple('images')) {
                        $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                        $error_lang = isset($form_validation_instruction->image_file->front) ? $form_validation_instruction->image_file->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                        // if file is not uploaded than  this function set error  message in flash to display on frontend.
                        // $this->session->set_flashdata('error', $error_lang);
                        // redirect(base_url() . 'admin/' . $this->lang->default_lang . '/gallery/add_gallery');

                        $response['status'] = "0";
                        $response['element'] = "images";
                        $response['message'] = $error_lang;
                        echo json_encode($response);
                        exit;
                        }

                        $upload_data = $this->upload->data();

                        if ($upload_data['multiple_file_name']) {
                        //this function set product image for save in the database


                        if (!empty($edit_data['images'])) {
                            $multi_img = implode(",", $upload_data['multiple_file_name']);
                            $post_data['images'] = $edit_data['images'] . ',' . $multi_img;
                        } else {
                            $post_data['images'] =  implode(",", $upload_data['multiple_file_name']);
                        }
                       
                        /***************** Resize image  *****************/
                        foreach ($upload_data['multiple_file_name'] as $img_name) {
                        do_resize($config['upload_path'], $img_name);
                        }
                        /***************** Resize image  *****************/
                        }
                }

                $post_data = $this->security->xss_clean($post_data);
                // this function update record in the database.
            $result = $this->comman_model->update_data_by_id('gallery_items', $post_data, 'id', $id);
            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            $response['status'] = "1";
            $response['message'] = $admin_static_links['data_successfully_updated'];

            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
            echo json_encode($response);
            exit;
        }

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('gallery_block', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'gallery',
            'addscripts'            => 'add_gallery',
            'sub_menu'              => 'add_gallery',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_gallery'         => $all_language_data['admin_gallery'],
            'edit_data'             => $edit_data
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/gallery/form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method del_imagepermanently
     * This Function delete  image as per gallery id and imagename.
     * @param $id $id [This parameter is the gallery i]
     * @param $imagetodelete $imagetodelete [This parameter is the gallery image column name]
     *
     * @return void
     */
    public function del_galleryimagepermanently()
    {
        validateAdminLogin();
        $id = $this->input->post('id');
        $imagetodelete = $this->input->post('imagetodelete');
        $image = $this->input->post('img');


        $data_array[$imagetodelete] = '';
        $all_img = [];
        $images = '';

        $all_data = $this->comman_model->get_data_by_id('gallery_items', array('id' => $id));

        $del_img = !empty($image) ? $image : $all_data[$imagetodelete];
        if ($imagetodelete == 'images') {
            if (!empty($all_data['images'])) {
                $all_img = explode(",", $all_data['images']);
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
        $update = $this->comman_model->update_data_by_id('gallery_items', $data_array, 'id', $id);

        if ($update) {
            // after update in the database this function remove the image.
            if (file_exists("assets/uploads/gallery/" . $del_img))
                unlink("assets/uploads/gallery/" . $del_img);
        }

        echo json_encode(TRUE);
        exit;

    }


 
}
