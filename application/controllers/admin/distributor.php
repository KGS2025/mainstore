<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Distributor
 * Distributor Class handle all methods  related to Distributors  like list, add , edit , delete.
 */
class Distributor extends CI_Controller
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
        $this->load->model(array('comman_model', 'distributor_model', 'product_model','industry_model'));
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
        $access = validatePageAccess('distributors');


        if ($access['page_access'] != 1 || $this->config->item('enable_distributor_feature') == "0") {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteAll')) {
            // this function delete all records from package table.
            $this->comman_model->deleteAllDataWithLang('distributors');
        }

        if ($this->input->post('DeleteSelected')) {
            // this function delete  records from package table as per the selected ids.
            $deletedIds = $this->security->xss_clean($this->input->post('deleteitem'));
            $this->comman_model->deleteAllById('distributors', $deletedIds);
        }

        $key = '';

        $config['base_url']         = base_url() . "admin/" . $this->lang->default_lang . "/distributor/index/";
        $config['total_rows']       = $this->comman_model->record_count('distributors');
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

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_distributor', 'cart_instruction'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('distributor_block', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'distributor',
            'addscripts'            => 'distributor',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->distributor_model->search_distributor_data('distributors', $key, 'name', $config['per_page'], $offset, $this->lang->default_lang_id),
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'cart_instruction'    => $all_language_data['cart_instruction'],
            'admin_distributor'         => $all_language_data['admin_distributor']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/distributor/list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method delete_distributors
     *  This Function delete single distributors as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the distributors id. ]
     *
     * @return void
     */
    function delete_distributor($id)
    {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('distributors');
        if ($access['page_delete'] != 1 || $this->config->item('enable_distributor_feature') == "0") {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        $this->comman_model->delete_where('distributors ', array('id' => $id));

        // this function update products table after delete the package

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/distributor');
    }

    /**
     * Method add_distributor
     * This Function Display Add distributor form and save the new package in the database.
     * @return void
     */
    function add_distributor()
    {




        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('distributors');
        if ($access['page_add'] != 1 || $this->config->item('enable_distributor_feature') == "0") {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_distributor', 'form_validation_instruction'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();


        if ($this->input->post('operation')) {

            // these variables are intialized for  image file
            $config['upload_path']      = './assets/uploads/distributor';
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
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/distributor/add_distributor');
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
                'email'   => trim($this->input->post('email')),
                'phone'   => trim($this->input->post('phone')),
                'city'   => trim($this->input->post('city')),
                'address'   => trim($this->input->post('address')),
                'country'   => trim($this->input->post('country')),
                'state'   => trim($this->input->post('state')),
                'zip_code'   => trim($this->input->post('zip_code')),
                'logo'   => isset($upload_data['file_name']) ? $upload_data['file_name'] : '',
                'address'   => $address,
                'status'   => trim($this->input->post('status')),
                'latitude'   => $latitude,
                'longitude'   => $longitude,
            );

            $post_data = $this->security->xss_clean($post_data);
            // this function add  record in the database.
            $this->comman_model->add('distributors', $post_data);

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/distributor');
        }



        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('distributor_block', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'distributor',
            'addscripts'            => 'add_distributor',
            'sub_menu'              => 'add_distributor',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'industry'              => $this->industry_model->getIndustryData($this->lang->default_lang_id),
            'admin_distributor'         => $all_language_data['admin_distributor']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/distributor/form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method edit_distributors
     * This Function Display edit distributors form and update  distributors in the database as per the distributor id.
     *
     * @return void
     */
    function edit_distributor($id = false)
    {
        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/distributor');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('distributors');
        if ($access['page_edit'] != 1 || $this->config->item('enable_distributor_feature') == "0") {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_distributor'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        if ($this->input->post('operation')) {

            // this  code  executed when user submit the form

            // these variables are intialized for  image file
            $config['upload_path']      = './assets/uploads/distributor';
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
                'email'   => trim($this->input->post('email')),
                'phone'   => trim($this->input->post('phone')),
                'city'   => trim($this->input->post('city')),
                'address'   => trim($this->input->post('address')),
                'country'   => trim($this->input->post('country')),
                'state'   => trim($this->input->post('state')),
                'zip_code'   => trim($this->input->post('zip_code')),
                'address'   => $address,
                'status'   => trim($this->input->post('status')),
                'latitude'   => $latitude,
                'longitude'   => $longitude,
            );
            if(isset($upload_data['file_name'])) {
                        $post_data['logo'] = $upload_data['file_name'];
            }

            // if file is uploaded by the user than this code executed
            if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {

                if (!$this->upload->do_upload('image')) {
                    $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction->client_logo->front) ? $form_validation_instruction->client_logo->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                    // if file is not uploaded than  this function set error  message in flash to display on frontend.
                    $this->session->set_flashdata('error', $error_lang);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/distributor/edit_distributor/' . $id);
                }

                $upload_data = $this->upload->data();
                if ($upload_data['file_name'] != '') {
                    //this function set image name for save in the database
                    $post_data['logo'] = $upload_data['file_name'];

                    /***************** Resize image  *****************/
                    do_resize($config['upload_path'], $post_data['image']);
                    /***************** Resize image  *****************/

                    // Get previous data for removing old image
                    $distributor_data = $this->comman_model->get_data_by_id('distributors', array('id' => $id));
                }
            }

            $post_data = $this->security->xss_clean($post_data);
            // this function update record in the database.
            $result = $this->comman_model->update_data_by_id('distributors', $post_data, 'id', $id);

            // Update products of distributor
          //  $this->comman_model->update_where('tbl_product_category_maker_model_relation', array("status" =>trim($this->input->post('status'))), array('distributor_id' => $id));

            if ($result && $post_data['image']) {
                if (file_exists("assets/uploads/distributor/" . $distributor_data['image'])) {
                    unlink("assets/uploads/distributor/" . $distributor_data['image']);
                }
            }

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/distributor');
        }

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('distributor_block', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'distributor',
            'addscripts'            => 'add_distributor',
            'sub_menu'              => 'add_distributor',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_distributor'         => $all_language_data['admin_distributor'],
            'industry'              => $this->industry_model->getIndustryData($this->lang->default_lang_id),
            'edit_data'             => allDataArray($this->comman_model->GetAllDataLangByid('distributors', 'id', $id, $this->lang->default_lang_id, 'distributors_country'))
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/distributor/form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method del_imagepermanently
     * This Function delete  image as per distributor id and imagename.
     * @param $id $id [This parameter is the distributor i]
     * @param $imagetodelete $imagetodelete [This parameter is the distributor image column name]
     *
     * @return void
     */
    public function del_imagepermanently($id)
    {
        validateAdminLogin();
        $post_data['image'] = '';

        $all_data = $this->comman_model->get_data_by_id('distributors', array('id' => $id));

        // this function update the image column in the database
        $update = $this->comman_model->update_data_by_id('distributors', $post_data, 'id', $id);

        if ($update) {
            // after update in the database this function remove the image.
            if (file_exists("assets/uploads/distributor/" . $all_data['image']))
                unlink("assets/uploads/distributor/" . $all_data['image']);
        }
    }

    /**
     * Method checkStoreExists
     * This Function checked that is distributor with same name   exist in the package table or not.
     * @param $id $id [This Parameter is the package id. ]
     *
     * @return void
     */
    public function checkdistributorExists($id = '')
    {
        $name = $this->security->xss_clean(trim($this->input->post('name')));
        if ($id && $name) {
            $result = $this->comman_model->get_data_by_id('distributors', array('id' => $id));
            if ($name == $result['name']) {
                echo json_encode(TRUE);
            } else {
                // this function check is record exist in the table with same name or not.
                $exists = $this->comman_model->check_row_exists('distributors', array('name' => $name));
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
            $exists = $this->comman_model->check_row_exists('distributors', array('name' => $name));
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
     * This Function checked that is distributor with same url   exist in the distributor table or not.
     * @param $id $id [This Parameter is the distributor id. ]
     *
     * @return void
     */
    public function checkUrlExists($id = '')
    {
        $url = $this->security->xss_clean(trim($this->input->post('url')));
        if ($id && $url) {
            $result = $this->comman_model->get_data_by_id('distributors', array('id' => $id));
            if ($url == $result['url']) {
                echo json_encode(TRUE);
            } else {
                // this function check is record exist in the table with same name or not.
                $exists = $this->comman_model->check_row_exists('distributors', array('url' => $url));
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
            $exists = $this->comman_model->check_row_exists('distributors', array('url' => $url));
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
