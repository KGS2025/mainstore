<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Package
 * Package Class handle all methods  related to Package  like list, add , edit , delete.
 */
class Industry extends CI_Controller
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
        $this->load->model(array('comman_model', 'industry_model', 'product_model', 'vehicle_categories_model'));
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
        $access = validatePageAccess('industry_type');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $key = '';

        $config['base_url']         = base_url() . "admin/" . $this->lang->default_lang . "/industry/index/";
        $config['total_rows']       = $this->comman_model->record_count('industries');
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

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_industry', 'cart_instruction', 'admin_industries'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('industries', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'industry_type',
            'addscripts'            => 'industries',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->industry_model->search_industry_data('industries', $key, 'name', $config['per_page'], $offset, $this->lang->default_lang_id),
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'cart_instruction'    => $all_language_data['cart_instruction'],
            'admin_industries'         => $all_language_data['admin_industries']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/industry/industry_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method delete_industry
     *  This Function delete single industry as per the  id passed in the  parameter.
     * @param $id $id [This Parameter is the industry id. ]
     *
     * @return void
     */
    function delete_industry($id)
    {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('industry_type');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $cat_industries = $this->vehicle_categories_model->get_all_categories_industries();
        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];

        $userLangData = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id);

        $admin_static_links = $userLangData['admin_static_links'];

        if (!in_array($id, $cat_industries)) {
            $this->comman_model->delete_where('industries ', array('id' => $id));
            // this function update products table after delete the package
            // $this->industry_model->update_product_on_delete_package($id);
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);
        } else {

            $this->session->set_flashdata('success', $admin_static_links['data_exist_in_other']);
        }
        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/industry');
    }

    /**
     * Method add_industry
     * This Function Display Add industry form and save the new package in the database.
     * @return void
     */
    function add_industry()
    {

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('industry_type');
        if ($access['page_add'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_industry', 'form_validation_instruction', 'admin_industries'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();


        if ($this->input->post('operation')) {

            // these variables are intialized for  image file
            $config['upload_path']      = './assets/uploads/industries';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = '2048';
            $config['max_width']        = '100000';
            $config['max_height']       = '10000';
            $config['file_name']        = getRandomFileName($_FILES['icon']['name'], 'image');
            $this->load->library('upload', $config);
            $this->load->library('image_lib');

            // this  code  executed when user submit the form

            // this  code  executed when user upload  the  image. 
            if (!empty($_FILES['icon']['name'])) {

                if (!$this->upload->do_upload('icon')) {
                    $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction->client_logo->front) ? $form_validation_instruction->client_logo->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                    // if file is not uploaded than  this function set error  message in flash to display on frontend.
                    $this->session->set_flashdata('error', $error_lang);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/industry/add_industry');
                }

                $upload_data = $this->upload->data();
                if ($upload_data['file_name']) {

                    /***************** Resize image  *****************/
                    do_resize($config['upload_path'], $upload_data['file_name']);
                    /***************** Resize image  *****************/
                }
            }

            // this array is intialized to save in the database
            $post_data = array(
                'name'   => trim($this->input->post('name')),
                'description'   => trim($this->input->post('description')),
                'icon'   => isset($upload_data['file_name']) ? $upload_data['file_name'] : '',
                'status'   => trim($this->input->post('status'))
            );

            $post_data = $this->security->xss_clean($post_data);
            // this function add  record in the database.
            $this->comman_model->add('industries', $post_data);

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/industry');
        }



        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('industries', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'industry_type',
            'addscripts'            => 'add_industry',
            'sub_menu'              => 'industry_type',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_industries'         => $all_language_data['admin_industries']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);

        $this->load->view('admin/industry/industry_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method edit_industry
     * This Function Display edit industry form and update  industry in the database as per the industry id.
     *
     * @return void
     */
    function edit_industry($id = false)
    {
        if (!$id) {
            // if id is empty  this function redirect user to listing  page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/industry');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('industry_type');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        check_lang_admin();

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_industries'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        $cat_industries = $this->vehicle_categories_model->get_all_categories_industries();
        $edit_data = allDataArray($this->comman_model->GetAllDataLangByid('industries', 'id', $id, $this->lang->default_lang_id, 'industries_country'));

        if ($this->input->post('operation')) {

            // this  code  executed when user submit the form

            // these variables are intialized for  image file
            $config['upload_path']      = './assets/uploads/industries';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = '2048';
            $config['max_width']        = '100000';
            $config['max_height']       = '10000';
            $config['file_name']        = getRandomFileName($_FILES['icon']['name'], 'image');
            $this->load->library('upload', $config);
            $this->load->library('image_lib');


            if (in_array($edit_data['id'], $cat_industries)) {

                // this array is intialized to save in the database
                $post_data = array(
                    'name'   => trim($this->input->post('name')),
                    'description'   => trim($this->input->post('description')),
                    'status'   => $edit_data['status'],
                );
            } else {
                // this array is intialized to save in the database
                $post_data = array(
                    'name'   => trim($this->input->post('name')),
                    'description'   => trim($this->input->post('description')),
                    'status'   => trim($this->input->post('status'))
                );
            }



            // if file is uploaded by the user than this code executed
            if (file_exists($_FILES['icon']['tmp_name']) || is_uploaded_file($_FILES['icon']['tmp_name'])) {

                if (!$this->upload->do_upload('icon')) {
                    $form_validation_instruction = (object)$all_language_data['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction->client_logo->front) ? $form_validation_instruction->client_logo->front : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';

                    // if file is not uploaded than  this function set error  message in flash to display on frontend.
                    $this->session->set_flashdata('error', $error_lang);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/industry/edit_industry/' . $id);
                }

                $upload_data = $this->upload->data();
                if ($upload_data['file_name'] != '') {
                    //this function set image name for save in the database
                    $post_data['icon'] = $upload_data['file_name'];

                    /***************** Resize image  *****************/
                    do_resize($config['upload_path'], $post_data['image']);
                    /***************** Resize image  *****************/

                    // Get previous data for removing old image
                    $industry_data = $this->comman_model->get_data_by_id('industries', array('id' => $id));
                }
            }

            $post_data = $this->security->xss_clean($post_data);
            // this function update record in the database.
            $result = $this->comman_model->update_data_by_id('industries', $post_data, 'id', $id);

            if ($result && $post_data['icon']) {
                if (file_exists("assets/uploads/industries/" . $industry_data['icon'])) {
                    unlink("assets/uploads/industries/" . $industry_data['icon']);
                }
            }

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/industry');
        }


        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('industries', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'industry_type',
            'addscripts'            => 'edit_industry',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_industries'         => $all_language_data['admin_industries'],
            'edit_data'             => $edit_data,
            'cat_industries' => $cat_industries
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/industry/industry_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method del_imagepermanently
     * This Function delete  image as per industry id and imagename.
     * @param $id $id [This parameter is the industry i]
     * @param $imagetodelete $imagetodelete [This parameter is the industry image column name]
     *
     * @return void
     */
    public function del_imagepermanently($id)
    {
        validateAdminLogin();
        $post_data['icon'] = '';

        $all_data = $this->comman_model->get_data_by_id('industries', array('id' => $id));

        // this function update the image column in the database
        $update = $this->comman_model->update_data_by_id('industries', $post_data, 'id', $id);

        if ($update) {
            // after update in the database this function remove the image.
            if (file_exists("assets/uploads/industries/" . $all_data['icon']))
                unlink("assets/uploads/industries/" . $all_data['icon']);
        }
    }

    /**
     * Method checkindustryExists
     * This Function checked that is industry with same name   exist in the package table or not.
     * @param $id $id [This Parameter is the package id. ]
     *
     * @return void
     */
    public function checkindustryExists($id = '')
    {
        $name = $this->security->xss_clean(trim($this->input->post('name')));
        if ($id && $name) {
            $result = $this->comman_model->get_data_by_id('industries', array('id' => $id));
            if ($name == $result['name']) {
                echo json_encode(TRUE);
            } else {
                // this function check is record exist in the table with same name or not.
                $exists = $this->comman_model->check_row_exists('industries', array('name' => $name));
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
            $exists = $this->comman_model->check_row_exists('industries', array('name' => $name));
            if ($exists) {
                // if exist than this code return false
                echo json_encode(FALSE);
            } else {
                // if not  exist than this code return true
                echo json_encode(TRUE);
            }
        }
    }
}
