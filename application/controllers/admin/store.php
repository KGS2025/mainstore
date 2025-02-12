<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Package
 * Package Class handle all methods  related to Package  like list, add , edit , delete.
 */
class Store extends CI_Controller
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
        $this->load->model(array('comman_model', 'store_model', 'product_model','industry_model'));
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
        $access = validatePageAccess('store');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteAll')) {
            // this function delete all records from package table.
            $this->comman_model->deleteAllDataWithLang('stores');
        }

        if ($this->input->post('DeleteSelected')) {
            // this function delete  records from package table as per the selected ids.
            $storeIds = $this->security->xss_clean($this->input->post('deleteitem'));
            $this->comman_model->deleteAllById('stores', $storeIds);
        }

        $key = '';

        $config['base_url']         = base_url() . "admin/" . $this->lang->default_lang . "/store/index/";
        $config['total_rows']       = $this->comman_model->record_count('store');
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

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_store', 'cart_instruction'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('store_block', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'store',
            'addscripts'            => 'store',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->store_model->search_store_data('store', $key, 'name', $config['per_page'], $offset, $this->lang->default_lang_id),
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'cart_instruction'    => $all_language_data['cart_instruction'],
            'admin_store'         => $all_language_data['admin_store']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/store/store_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method delete_store
     *  This Function delete single store as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the store id. ]
     *
     * @return void
     */
    function delete_store($id)
    {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('store');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        $this->comman_model->delete_where('store ', array('id' => $id));

        // this function update products table after delete the package
        // $this->store_model->update_product_on_delete_package($id);

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/store');
    }

    /**
     * Method add_store
     * This Function Display Add store form and save the new package in the database.
     * @return void
     */
    function add_store()
    {




        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('store');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_store', 'form_validation_instruction'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();


        if ($this->input->post('operation')) {

            // these variables are intialized for  image file
            $config['upload_path']      = './assets/uploads/store';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = '2048';
            $config['max_width']        = '100000';
            $config['max_height']       = '10000';
            $config['file_name']        = getRandomFileName($_FILES['image']['name'], 'image');
            $this->load->library('upload', $config);
            $this->load->library('image_lib');

            // this  code  executed when user submit the form

            // this  code  executed when user upload  the  image. 
            if (!empty($_FILES['image']['name'])) {

                if (!$this->upload->do_upload('image')) {
                    $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction->client_logo->front) ? $form_validation_instruction->client_logo->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                    // if file is not uploaded than  this function set error  message in flash to display on frontend.
                    $this->session->set_flashdata('error', $error_lang);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/store/add_store');
                }

                $upload_data = $this->upload->data();
                if ($upload_data['file_name']) {

                    /***************** Resize image  *****************/
                    do_resize($config['upload_path'], $upload_data['file_name']);
                    /***************** Resize image  *****************/
                }
            }

            $address = trim($this->input->post('address'));
            // $latitude =  '36.907240';
            // $longitude = '10.302450';


            if (!empty($address)) {
                $latlong    =  getlocation($address);
                $latitude         =   $latlong['lat'];
                $longitude    =   $latlong['long'];
            }

            // this array is intialized to save in the database
            $post_data = array(
                'name'   => trim($this->input->post('name')),
                'url'   => trim($this->input->post('url')),
                'description'   => trim($this->input->post('description')),
                'image'   => isset($upload_data['file_name']) ? $upload_data['file_name'] : '',
                'address'   => $address,
                'industries'    => implode(",",$this->input->post('industries')),
                'owner_email'    => trim($this->input->post('owner_email')),
                'status'   => trim($this->input->post('status')),
                'show_price'   => trim($this->input->post('show_price')),
                'latitude'   => $latitude,
                'longitude'   => $longitude,
            );

            $post_data = $this->security->xss_clean($post_data);
            // this function add  record in the database.
            $this->comman_model->add('store', $post_data);

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/store');
        }



        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('store_block', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'store',
            'addscripts'            => 'add_store',
            'sub_menu'              => 'add_store',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'industry'              => $this->industry_model->getIndustryData($this->lang->default_lang_id),
            'admin_store'         => $all_language_data['admin_store']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);

        $this->load->view('admin/store/store_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method edit_store
     * This Function Display edit store form and update  store in the database as per the store id.
     *
     * @return void
     */
    function edit_store($id = false)
    {
        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/store');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('store');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_store'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        if ($this->input->post('operation')) {

            // this  code  executed when user submit the form

            // these variables are intialized for  image file
            $config['upload_path']      = './assets/uploads/store';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = '2048';
            $config['max_width']        = '100000';
            $config['max_height']       = '10000';
            $config['file_name']        = getRandomFileName($_FILES['image']['name'], 'image');
            $this->load->library('upload', $config);
            $this->load->library('image_lib');

            $address = trim($this->input->post('address'));
            $latitude =  '36.907240';
            $longitude = '10.302450';

            if (!empty($address)) {

                $latlong    =  getlocation($address);
                $latitude         =   $latlong['lat'];
                $longitude    =   $latlong['long'];
            }



            // this array is intialized to save in the database
            $post_data = array(
                'name'   => trim($this->input->post('name')),
                'url'   => trim($this->input->post('url')),
                'description'   => trim($this->input->post('description')),
                'address'   => $address,
                'owner_email'    => trim($this->input->post('owner_email')),
                'industries'    => implode(",",$this->input->post('industries')),
                'status'   => trim($this->input->post('status')),
                'show_price'   => trim($this->input->post('show_price')),
                'latitude'   => $latitude,
                'longitude'   => $longitude,
            );


            // if file is uploaded by the user than this code executed
            if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {

                if (!$this->upload->do_upload('image')) {
                    $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction->client_logo->front) ? $form_validation_instruction->client_logo->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                    // if file is not uploaded than  this function set error  message in flash to display on frontend.
                    $this->session->set_flashdata('error', $error_lang);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/store/edit_store/' . $id);
                }

                $upload_data = $this->upload->data();
                if ($upload_data['file_name'] != '') {
                    //this function set image name for save in the database
                    $post_data['image'] = $upload_data['file_name'];

                    /***************** Resize image  *****************/
                    do_resize($config['upload_path'], $post_data['image']);
                    /***************** Resize image  *****************/

                    // Get previous data for removing old image
                    $store_data = $this->comman_model->get_data_by_id('store', array('id' => $id));
                }
            }

            $post_data = $this->security->xss_clean($post_data);
            // this function update record in the database.
            $result = $this->comman_model->update_data_by_id('store', $post_data, 'id', $id);

            // Update products of store
          //  $this->comman_model->update_where('tbl_product_category_maker_model_relation', array("status" =>trim($this->input->post('status'))), array('store_id' => $id));

            if ($result && $post_data['image']) {
                if (file_exists("assets/uploads/store/" . $store_data['image'])) {
                    unlink("assets/uploads/store/" . $store_data['image']);
                }
            }

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/store');
        }

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('store_block', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'store',
            'addscripts'            => 'edit_store',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_store'         => $all_language_data['admin_store'],
            'industry'              => $this->industry_model->getIndustryData($this->lang->default_lang_id),
            'edit_data'             => allDataArray($this->comman_model->GetAllDataLangByid('store', 'id', $id, $this->lang->default_lang_id, 'store_country'))
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/store/store_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method del_imagepermanently
     * This Function delete  image as per store id and imagename.
     * @param $id $id [This parameter is the store i]
     * @param $imagetodelete $imagetodelete [This parameter is the store image column name]
     *
     * @return void
     */
    public function del_imagepermanently($id)
    {
        validateAdminLogin();
        $post_data['image'] = '';

        $all_data = $this->comman_model->get_data_by_id('store', array('id' => $id));

        // this function update the image column in the database
        $update = $this->comman_model->update_data_by_id('store', $post_data, 'id', $id);

        if ($update) {
            // after update in the database this function remove the image.
            if (file_exists("assets/uploads/store/" . $all_data['image']))
                unlink("assets/uploads/store/" . $all_data['image']);
        }
    }

    /**
     * Method checkStoreExists
     * This Function checked that is store with same name   exist in the package table or not.
     * @param $id $id [This Parameter is the package id. ]
     *
     * @return void
     */
    public function checkStoreExists($id = '')
    {
        $name = $this->security->xss_clean(trim($this->input->post('name')));
        if ($id && $name) {
            $result = $this->comman_model->get_data_by_id('store', array('id' => $id));
            if ($name == $result['name']) {
                echo json_encode(TRUE);
            } else {
                // this function check is record exist in the table with same name or not.
                $exists = $this->comman_model->check_row_exists('store', array('name' => $name));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        } else if ($name) {
            // this function check is record exist in the table with same name or not.
            $exists = $this->comman_model->check_row_exists('store', array('name' => $name));
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
     * Method checkUrlExists
     * This Function checked that is store with same url   exist in the store table or not.
     * @param $id $id [This Parameter is the store id. ]
     *
     * @return void
     */
    public function checkUrlExists($id = '')
    {
        $url = $this->security->xss_clean(trim($this->input->post('url')));
        if ($id && $url) {
            $result = $this->comman_model->get_data_by_id('store', array('id' => $id));
            if ($url == $result['url']) {
                echo json_encode(TRUE);
            } else {
                // this function check is record exist in the table with same name or not.
                $exists = $this->comman_model->check_row_exists('store', array('url' => $url));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        } else if ($url) {
            // this function check is record exist in the table with same name or not.
            $exists = $this->comman_model->check_row_exists('store', array('url' => $url));
            if ($exists) {
                // if exist than this code return false
                echo json_encode(FALSE);
            } else {
                // if not  exist than this code return true
                echo json_encode(TRUE);
            }
        }
    }


    // function to get  the address
    function get_lat_long($address)
    {

        $address = str_replace(" ", "+", $address);

        $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&key=AIzaSyAYhPd2NZLq1RGpjSPLW4SCCVpOxPSYdVQ");
        
        $json = json_decode($json);

        $result = array();

        $result['latitude'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $result['longitude'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

        return  $result;
    }
}
