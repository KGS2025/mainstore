<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Index
 * This Class handle dashboard and some sections of Admin.
 */
class Index extends CI_Controller
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
        $this->load->model(array('comman_model'));
        $this->load->helper('assets');
        $this->load->library('form_validation');
        $this->clear_cache();
    }


    /**
     * Method index
     * This Function redirect user to dashboard function.
     * @return void
     */
    function index()
    {
        validateUser();
        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/dashboard');
    }
    
    /**
     * Method clear_cache
     * This Function Clear cache.
     * @return void
     */
    function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

    /**
     * Method dashboard
     * This Function Display the Admin Dashboard.
     * @return void
     */
    function dashboard() {
        validateAdminLogin();
        validateUser();

        // This Function retutn language data as per the section name and language id
        $all_language_data = get_admin_lang_data(array('admin_title', 'admin_static_links', 'general_instruction'), $this->lang->default_lang_id);

        $page_title = $all_language_data['admin_title'];
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => $page_title['dashboard']['front'],
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'dashboard',
            'addscripts'            => 'dashboard',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_title'           => $all_language_data['admin_title'],
            'general_instruction'   => $all_language_data['general_instruction']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/index/dashboard', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method welcome_page
     * This Function display list of welcome page settings.
     * @return void
     */
    function welcome_page()
    {
        check_lang_admin();

        validateUser();

        validateAdminLogin();

        // this function validate the access of this page for current logged admin user.

        $access = validatePageAccess('welcome_page');

        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        // This Function retutn language data as per the section name and language id
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_setting'), $this->lang->default_lang_id);
        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('welcome_page', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'welcome',
            'addscripts'            => 'welcome_page_list',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_setting'         => $all_language_data['admin_setting'],
            'set_data'              => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country'))
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/index/welcome_page_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method edit_welcome_page
     * This Function Display Welcome page form as per section name and row id.
     * @param $action $action [This parameter is the section for home page.]
     * @param $id $id [This parameter is the row id.]
     *
     * @return void
     */
    function edit_welcome_page($action = false, $id = false)
    {
        validateUser();

        validateAdminLogin();

        if (!$action) {
            // if action parameter is blank than this function redirect to listing page
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
        }

        if (!$id) {
            // if id parameter is blank than this function redirect to listing page

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('welcome_page');
        if ($access['page_edit'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        // this function return the data as pe the if passed from home page to view.
        $edit_data = allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country'));
        $front_colors = $this->comman_model->get_row_array('front_colors', '*', array('id' => 1));

        $edit_data = array_merge($edit_data,$front_colors[0]);

        if (empty($edit_data)) {
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
        }

        // This Function retutn language data as per the section name and language id
        $all_language_data  = get_admin_lang_data(array('general_instruction', 'admin_static_links', 'admin_edit_welcomepage', 'admin_social_media', 'admin_page_title', 'admin_products'), $this->lang->default_lang_id);

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('welcome_page', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => ($action == 'library') ? 'home' : 'welcome',
            'addscripts'            => 'edit_welcome_page',
            'edit_page'             => $action,
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'general_instruction'    => $all_language_data['general_instruction'],
            'admin_page_title'         => $all_language_data['admin_page_title'],
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_products'    => $all_language_data['admin_products'],
            'admin_edit_welcomepage'              => $all_language_data['admin_edit_welcomepage'],
            'edit_data'             => $edit_data,
        );

        // echo "<pre>";
        // print_r($pageData );die;

        // this code execute when user submit the logo form
        if ($this->input->post('logo')) {

            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('logo_url', 'Logo Image URL', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
            } else {
                if (!empty($_FILES['file']['name'])) {
                    $field_name = 'file';
                    $config['upload_path'] = './assets/uploads/logo/full/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_width'] = '960';
                    $config['max_height'] = '960';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload($field_name)) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('admin/index/edit_welcome_page/' . $action . '/' . $id);
                    } else {
                        $upload_data = $this->upload->data();
                        $this->load->library('image_lib');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/uploads/logo/full/' . $upload_data['file_name'];
                        $config['new_image'] = 'assets/uploads/logo/thumbnails/' . $upload_data['file_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 450;
                        $config['height'] = 133;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();

                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/uploads/logo/full/' . $upload_data['file_name'];
                        $config['new_image'] = 'assets/uploads/logo/small/' . $upload_data['file_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 100;
                        $config['height'] = 100;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                    }
                } 
                $post_data = array(
                    'name' => $this->input->post('title'),
                    'logo_url' => $this->input->post('logo_url'),
                    'left_logo_status' => $this->input->post('left_logo_status'),
                    'header_logo_status' => $this->input->post('header_logo_status')
                );

              
                if(!empty($upload_data['file_name'])){
                    $post_data['logo'] = $upload_data['file_name'];
                }
                $post_data = $this->security->xss_clean($post_data);
                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

                $result = $this->comman_model->update_where('home_page',$post_data,array('id' => $id));
               

                if ($result) {
                    

                    if(!empty($post_data['logo'])) {
                        if (file_exists("assets/uploads/logo/" . $all_data['logo']))
                            unlink("assets/uploads/logo/" . $all_data['logo']);


                        if (file_exists("assets/uploads/logo/full/" . $all_data['logo']))
                            unlink("assets/uploads/logo/full/" . $all_data['logo']);


                        if (file_exists("assets/uploads/logo/small/" . $all_data['logo']))
                            unlink("assets/uploads/logo/small/" . $all_data['logo']);

                        if (file_exists("assets/uploads/logo/thumbnails/" . $all_data['logo']))
                            unlink("assets/uploads/logo/thumbnails/" . $all_data['logo']);
                    }

                    $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);

                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
                }
            }
        }

        // this code execute when user submit the favicon form

        if ($this->input->post('fevicon')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/logo/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_welcome_page/' . $action . '/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/logo/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/logo/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 133;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/logo/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/logo/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }
            $post_data = array(
                'fevicon' => $upload_data['file_name']
            );

            $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

            $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));

            if ($result) {

                if (file_exists("assets/uploads/logo/" . $all_data['fevicon']))
                    unlink("assets/uploads/logo/" . $all_data['fevicon']);


                if (file_exists("assets/uploads/logo/full/" . $all_data['fevicon']))
                    unlink("assets/uploads/logo/full/" . $all_data['fevicon']);


                if (file_exists("assets/uploads/logo/small/" . $all_data['fevicon']))
                    unlink("assets/uploads/logo/small/" . $all_data['fevicon']);

                if (file_exists("assets/uploads/logo/thumbnails/" . $all_data['fevicon']))
                    unlink("assets/uploads/logo/thumbnails/" . $all_data['fevicon']);

                $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);

                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
            }
        }

        // this code execute when user submit the footer name form

        if ($this->input->post('footer_name')) {

            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
            } else {
                $post_data = array('footer_name' => $this->input->post('title'));
                $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));
                $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
            }
        }

        // this code execute when user submit the copyright form
        if ($this->input->post('copyright')) {

            $this->form_validation->set_rules('copyright', 'Copyright', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
            } else {
                $post_data = array('copyright' => $this->security->xss_clean($this->input->post('copyright')));
                $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));
                $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
            }
        }

        // this code execute when user submit the cookie  form
        if ($this->input->post('cookie_popup')) {
            $post_data = array(
                'cookie_yesno' => $this->input->post('cookie_yesno'),
                'cookie_title' => $this->input->post('cookie_title'),
                'cookie_description' => $this->input->post('cookie_description'),
                'cookie_page' => htmlspecialchars($this->input->post("cookie_page", FALSE))
            );
            $post_data = $this->security->xss_clean($post_data);
            $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));
            $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
        }
        // this code execute when user submit the mail  form
        if ($this->input->post('admin_mail')) {

            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
            } else {
                $post_data = array('admin_mail' => $this->security->xss_clean($this->input->post('title')));
                $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));
                $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
            }
        }
        // this code execute when user submit the cart photo  form
        if ($this->input->post('cart_photo')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/cart';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/edit_welcome_page/' . $action . '/' . $id);
                } else {
                    $upload_data = $this->upload->data();

                    $targetdir = './assets/uploads/cart/thumbnails/';
                    if (!is_dir($targetdir)) {
                        mkdir($targetdir, 0777, TRUE);
                    }

                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/cart/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/cart/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 133;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $targetdir = './assets/uploads/cart/small/';
                    if (!is_dir($targetdir)) {
                        mkdir($targetdir, 0777, TRUE);
                    }
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/cart/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/cart/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                $post_data = array('cart_photo' => $upload_data['file_name']);

                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

                $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));

                if ($result) {

                    if (file_exists("assets/uploads/cart/" . $all_data['cart_photo']))
                        unlink("assets/uploads/cart/" . $all_data['cart_photo']);


                    if (file_exists("assets/uploads/cart/full/" . $all_data['cart_photo']))
                        unlink("assets/uploads/cart/full/" . $all_data['cart_photo']);


                    if (file_exists("assets/uploads/cart/small/" . $all_data['cart_photo']))
                        unlink("assets/uploads/cart/small/" . $all_data['cart_photo']);

                    if (file_exists("assets/uploads/cart/thumbnails/" . $all_data['cart_photo']))
                        unlink("assets/uploads/cart/thumbnails/" . $all_data['cart_photo']);

                    $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);

                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
                }
            }
        }
        // this code execute when user submit the product type image  form
        if ($this->input->post('product_type_img')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path']   = './assets/uploads/vehicle_categories';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '800';
                $config['max_width']     = '2000';
                $config['max_height']    = '2000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/edit_welcome_page/' . $action . '/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                }
                $post_data = array('product_type_img' => $upload_data['file_name']);

                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

                $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));

                if ($result) {

                    if (file_exists("assets/uploads/vehicle_categories/" . $all_data['product_type_img']))
                        unlink("assets/uploads/vehicle_categories/" . $all_data['product_type_img']);
                    $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
                }
            }
        }

        // this code execute when user submit vehicle type image  form
        if ($this->input->post('vehicle_type_img')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path']   = './assets/uploads/vehicle_categories';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '800';
                $config['max_width']     = '2000';
                $config['max_height']    = '2000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/edit_welcome_page/' . $action . '/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                }
                $post_data = array('vehicle_type_img' => $upload_data['file_name']);

                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

                $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));

                if ($result) {

                    if (file_exists("assets/uploads/vehicle_categories/" . $all_data['vehicle_type_img']))
                        unlink("assets/uploads/vehicle_categories/" . $all_data['vehicle_type_img']);
                    $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
                }
            }
        }

        // this code execute when user submit vehicle type image  form
        if ($this->input->post('common_loader_img')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path']   = './assets/uploads';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '800';
                $config['max_width']     = '2000';
                $config['max_height']    = '2000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/edit_welcome_page/' . $action . '/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                }
                $post_data = array('common_loader_img' => $upload_data['file_name']);

                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

                $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));

                if ($result) {

                    if (file_exists("assets/uploads/" . $all_data['common_loader_img']))
                        unlink("assets/uploads/" . $all_data['common_loader_img']);
                    $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
                }
            }
        }

        // this code execute when user submit the footer name  form
        if ($this->input->post('footer')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/footer/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_welcome_page/' . $action . '/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/footer/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/footer/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 760;
                    $config['height'] = 190;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/footer/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/footer/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                $post_data = array('footer_image' => $upload_data['file_name']);

                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

                $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));

                if ($result) {

                    if (file_exists("assets/uploads/footer/" . $all_data['footer_image']))
                        unlink("assets/uploads/footer/" . $all_data['footer_image']);


                    if (file_exists("assets/uploads/footer/full/" . $all_data['footer_image']))
                        unlink("assets/uploads/footer/full/" . $all_data['footer_image']);


                    if (file_exists("assets/uploads/footer/small/" . $all_data['footer_image']))
                        unlink("assets/uploads/footer/small/" . $all_data['footer_image']);

                    if (file_exists("assets/uploads/footer/thumbnails/" . $all_data['footer_image']))
                        unlink("assets/uploads/footer/thumbnails/" . $all_data['footer_image']);

                    $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);

                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
                }
            }
        }
        // this code execute when user submit the library  form
        if ($this->input->post('library')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/background/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '3000';
                $config['max_height'] = '3000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/edit_welcome_page/' . $action . '/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/background/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/background/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/background/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/background/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                $post_data = array('library_image' => $upload_data['file_name']);


                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

                $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));

                if ($result) {

                    if (file_exists("assets/uploads/background/" . $all_data['library_image']))
                        unlink("assets/uploads/background/" . $all_data['library_image']);


                    if (file_exists("assets/uploads/background/full/" . $all_data['library_image']))
                        unlink("assets/uploads/background/full/" . $all_data['library_image']);


                    if (file_exists("assets/uploads/background/small/" . $all_data['library_image']))
                        unlink("assets/uploads/background/small/" . $all_data['library_image']);

                    if (file_exists("assets/uploads/background/thumbnails/" . $all_data['library_image']))
                        unlink("assets/uploads/background/thumbnails/" . $all_data['library_image']);

                    $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/library_page');
                }
            }
        }
        // this code execute when user submit the background  form
        if ($this->input->post('background')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/background/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '3000';
                $config['max_height'] = '3000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/edit_welcome_page/' . $action . '/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/background/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/background/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/background/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/background/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                $post_data = array('background_image' => $upload_data['file_name']);

                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

                $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));

                if ($result) {

                    if (file_exists("assets/uploads/background/" . $all_data['background_image']))
                        unlink("assets/uploads/background/" . $all_data['background_image']);


                    if (file_exists("assets/uploads/background/full/" . $all_data['background_image']))
                        unlink("assets/uploads/background/full/" . $all_data['background_image']);


                    if (file_exists("assets/uploads/background/small/" . $all_data['background_image']))
                        unlink("assets/uploads/background/small/" . $all_data['background_image']);

                    if (file_exists("assets/uploads/background/thumbnails/" . $all_data['background_image']))
                        unlink("assets/uploads/background/thumbnails/" . $all_data['background_image']);

                    $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);

                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
                }
            }
        }
        // this code execute when user submit the globe  form
        if ($this->input->post('globe')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/logo/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '3000';
                $config['max_height'] = '3000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {

                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/index/edit_welcome_page/' . $action . '/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/logo/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/logo/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/logo/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/logo/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }

                $post_data = array('globe_image' => $upload_data['file_name']);

                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

                $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));

                if ($result) {

                    if (file_exists("assets/uploads/logo/" . $all_data['globe_image']))
                        unlink("assets/uploads/logo/" . $all_data['globe_image']);


                    if (file_exists("assets/uploads/logo/full/" . $all_data['globe_image']))
                        unlink("assets/uploads/logo/full/" . $all_data['globe_image']);


                    if (file_exists("assets/uploads/logo/small/" . $all_data['globe_image']))
                        unlink("assets/uploads/logo/small/" . $all_data['globe_image']);

                    if (file_exists("assets/uploads/logo/thumbnails/" . $all_data['globe_image']))
                        unlink("assets/uploads/logo/thumbnails/" . $all_data['globe_image']);

                    $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);

                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
                }
            }
        }

        // this code execute when user submit the time  form
        if ($this->input->post('time')) {
            $post_data = array('time_position' => $this->security->xss_clean($this->input->post('time_position')));
            $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));
            $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
        }

        // this code execute when user submit the globe size  form
        if ($this->input->post('globe_size')) {
            $post_data = array('globe_size' => $this->security->xss_clean($this->input->post('globe_size_data')));
            $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));
            $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
        }
        // this code execute when user submit the globe position  form
        if ($this->input->post('globe_position')) {
            $post_data = array('globe_position' => $this->security->xss_clean($this->input->post('globe_position')));
            $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));
            $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
        }
        // this code execute when user submit the product position  form
        if ($this->input->post('product_position')) {
            $post_data = array('product_position' => $this->security->xss_clean($this->input->post('product_position')));
            $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));
            $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
        }
        // this code execute when user submit the main background  form
        if ($this->input->post('main_background')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/background/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '3000';
                $config['max_height'] = '3000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/edit_welcome_page/' . $action . '/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/background/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/background/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/background/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/background/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                $post_data = array('main_background_image' => $upload_data['file_name']);

                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

                $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));

                if ($result) {

                    if (file_exists("assets/uploads/background/" . $all_data['main_background_image']))
                        unlink("assets/uploads/background/" . $all_data['main_background_image']);


                    if (file_exists("assets/uploads/background/full/" . $all_data['main_background_image']))
                        unlink("assets/uploads/background/full/" . $all_data['main_background_image']);


                    if (file_exists("assets/uploads/background/small/" . $all_data['main_background_image']))
                        unlink("assets/uploads/background/small/" . $all_data['main_background_image']);

                    if (file_exists("assets/uploads/background/thumbnails/" . $all_data['main_background_image']))
                        unlink("assets/uploads/background/thumbnails/" . $all_data['main_background_image']);

                    $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);

                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
                }
            }
        }
        // this code execute when user submit the footer background  form
        if ($this->input->post('main_footer_background')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path'] = './assets/uploads/background/full/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '800';
                $config['max_width'] = '3000';
                $config['max_height'] = '3000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/edit_welcome_page/' . $action . '/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/background/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/background/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/background/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/background/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                $post_data = array('main_footer_background' => $upload_data['file_name']);

                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));

                $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));

                if ($result) {

                    if (file_exists("assets/uploads/background/" . $all_data['main_footer_background']))
                        unlink("assets/uploads/background/" . $all_data['main_footer_background']);


                    if (file_exists("assets/uploads/background/full/" . $all_data['main_footer_background']))
                        unlink("assets/uploads/background/full/" . $all_data['main_footer_background']);


                    if (file_exists("assets/uploads/background/small/" . $all_data['main_footer_background']))
                        unlink("assets/uploads/background/small/" . $all_data['main_footer_background']);

                    if (file_exists("assets/uploads/background/thumbnails/" . $all_data['main_footer_background']))
                        unlink("assets/uploads/background/thumbnails/" . $all_data['main_footer_background']);

                    $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);

                    redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
                }
            }
        }
        // this code execute when user submit the footer text  form
        if ($this->input->post('footer_text')) {

            $this->form_validation->set_rules('header_image_url', 'Header Image URL', 'trim|required');
            $this->form_validation->set_rules('footer_address', 'Address', 'trim');
            $this->form_validation->set_rules('footer_phone1', 'Phone1', 'trim');
            $this->form_validation->set_rules('footer_phone2', 'Phone2', 'trim');
            $this->form_validation->set_rules('footer_email', 'Email', 'trim');
            $this->form_validation->set_rules('footer_map_iframe', 'Google Map Iframe ', 'trim|required');
            $this->form_validation->set_rules('footer_facebook_iframe', 'Facebook Iframe ', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
            } else {
                if (!empty($_FILES['file']['name'])) {
                    $field_name = 'file';
                    $config['upload_path'] = './assets/uploads/logo/full/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '800';
                    $config['max_width'] = '2000';
                    $config['max_height'] = '2000';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload($field_name)) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('admin/index/edit_welcome_page/' . $action . '/' . $id);
                    } else {
                        $upload_data = $this->upload->data();
                        $this->load->library('image_lib');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/uploads/logo/full/' . $upload_data['file_name'];
                        $config['new_image'] = 'assets/uploads/logo/thumbnails/' . $upload_data['file_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 200;
                        $config['height'] = 120;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();

                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/uploads/logo/full/' . $upload_data['file_name'];
                        $config['new_image'] = 'assets/uploads/logo/small/' . $upload_data['file_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 100;
                        $config['height'] = 100;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                        $header_image = $upload_data['file_name'];
                    }
                } else {
                    $header_image = $this->input->post('hidden_header_image');
                }
                $post_data = array(
                    'header_image' => $header_image,
                    'header_image_url' => $this->input->post('header_image_url'),
                    'footer_address' => $this->input->post('footer_address'),
                    'footer_payment_methods' => $this->input->post('footer_payment_methods'),
                    'footer_phone1' => $this->input->post('footer_phone1'),
                    'footer_phone2' => $this->input->post('footer_phone2'),
                    'footer_email' => $this->input->post('footer_email'),
                    'footer_map_iframe' => $this->input->post('footer_map_iframe'),
                    'right_logo_status' => $this->input->post('right_logo_status'),
                    'footer_facebook_iframe' => $this->input->post('footer_facebook_iframe'),
                );
                $post_data = $this->security->xss_clean($post_data);
                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));
                $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));
                if (!empty($_FILES['file']['name'])) {
                    if ($result) {
                        if (file_exists("assets/uploads/logo/" . $all_data['header_image']))
                            unlink("assets/uploads/logo/" . $all_data['header_image']);

                        if (file_exists("assets/uploads/logo/full/" . $all_data['header_image']))
                            unlink("assets/uploads/logo/full/" . $all_data['header_image']);

                        if (file_exists("assets/uploads/logo/small/" . $all_data['header_image']))
                            unlink("assets/uploads/logo/small/" . $all_data['header_image']);

                        if (file_exists("assets/uploads/logo/thumbnails/" . $all_data['header_image']))
                            unlink("assets/uploads/logo/thumbnails/" . $all_data['header_image']);
                    }
                }
                $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
            }
        }
        // this code execute when user submit the colors  form
        if ($this->input->post('front_colors')) {
            $post_data = array(
                'date_time_color'               => replace_empty_string($this->input->post('date_time_color')),
                'breadcrumb_color'              => replace_empty_string($this->input->post('breadcrumb_color')),
                'username_runningtime_color'    => replace_empty_string($this->input->post('username_runningtime_color')),
                'select_category_color'         => replace_empty_string($this->input->post('select_category_color')),
                'select_category_color_text'    => replace_empty_string($this->input->post('select_category_color_text')),
                'select_background_color'       => replace_empty_string($this->input->post('select_background_color')),
                'heder_background_color'        => replace_empty_string($this->input->post('heder_background_color')),
                'header_menu_text_color'        => replace_empty_string($this->input->post('header_menu_text_color')),
                'header_menu_text_hover_color'  => replace_empty_string($this->input->post('header_menu_text_hover_color')),
                'search_input_background_color' => replace_empty_string($this->input->post('search_input_background_color')),
                'search_input_text_color'       => replace_empty_string($this->input->post('search_input_text_color')),
                'search_result_background_color' => replace_empty_string($this->input->post('search_result_background_color')),
                'search_result_text_color'      => replace_empty_string($this->input->post('search_result_text_color')),
                'footer_background_color'       => replace_empty_string($this->input->post('footer_background_color')),
                'footer_text_color'             => replace_empty_string($this->input->post('footer_text_color')),
                'product_action_btn_bg_color'   => replace_empty_string($this->input->post('product_action_btn_bg_color')),
                'product_action_btn_text_color' => replace_empty_string($this->input->post('product_action_btn_text_color')),
                'langdropdown_txt_color'        => replace_empty_string($this->input->post('langdropdown_txt_color')),
                'langdropdown_bg_color'         => replace_empty_string($this->input->post('langdropdown_bg_color')),
                'langdropdownhead_bg_color'     => replace_empty_string($this->input->post('langdropdownhead_bg_color')),
                'langdropdownhead_txt_color'    => replace_empty_string($this->input->post('langdropdownhead_txt_color')),
                'category_label_txt_color'      => replace_empty_string($this->input->post('category_label_txt_color')),
                'popup_txt_color'               => replace_empty_string($this->input->post('popup_txt_color')),
                'popup_bg_color'                => replace_empty_string($this->input->post('popup_bg_color')),
                'popup_btn_bg_color'            => replace_empty_string($this->input->post('popup_btn_bg_color')),
                'popup_btn_txt_color'           => replace_empty_string($this->input->post('popup_btn_txt_color')),
                'cart_productdisp_txt_color'    => replace_empty_string($this->input->post('cart_productdisp_txt_color')),
                'inner_bg_color'                => replace_empty_string($this->input->post('inner_bg_color')),
                'cart_table_bgcolor'            => replace_empty_string($this->input->post('cart_table_bgcolor')),
                'cart_instock_color'            => replace_empty_string($this->input->post('cart_instock_color')),
                'cart_outstock_color'           => replace_empty_string($this->input->post('cart_outstock_color')),
                'input_label_color'             => replace_empty_string($this->input->post('input_label_color')),
                'try_captcha_text_color'        => replace_empty_string($this->input->post('try_captcha_text_color')),
                'cart_table_txtcolor'           => replace_empty_string($this->input->post('cart_table_txtcolor')),
                'cart_table_tr_bg_color'        => replace_empty_string($this->input->post('cart_table_tr_bg_color')),
                'product_box_txt_color'         => replace_empty_string($this->input->post('product_box_txt_color')),
                'validation_color'              => replace_empty_string($this->input->post('validation_color')),
                'progress_bar_bg_color'         => replace_empty_string($this->input->post('progress_bar_bg_color')),
                'progress_bar_text_color'       => replace_empty_string($this->input->post('progress_bar_text_color')),
                'payment_success_text_color'    => replace_empty_string($this->input->post('payment_success_text_color')),
                'input_border_txt_color'        => replace_empty_string($this->input->post('input_border_txt_color')),
                'input_bg_color'                => replace_empty_string($this->input->post('input_bg_color')),
                'product_border_color'          => replace_empty_string($this->input->post('product_border_color')),
                'qs_bg_color'                   => replace_empty_string($this->input->post('qs_bg_color')),
                'qs_bottom_border_bg_color'     => replace_empty_string($this->input->post('qs_bottom_border_bg_color')),
                'qs_text_color'                 => replace_empty_string($this->input->post('qs_text_color')),
                'qs_btn_bg_color'               => replace_empty_string($this->input->post('qs_btn_bg_color')),
                'qs_btn_text_color'             => replace_empty_string($this->input->post('qs_btn_text_color')),
                'qs_btn_hover_bg_color'         => replace_empty_string($this->input->post('qs_btn_hover_bg_color')),
                'qs_btn_hover_text_color'       => replace_empty_string($this->input->post('qs_btn_hover_text_color')),
                'qs_select_bg_color'            => replace_empty_string($this->input->post('qs_select_bg_color')),
                'qs_select_text_color'          => replace_empty_string($this->input->post('qs_select_text_color')),
                'qs_dd_bg_color'                => replace_empty_string($this->input->post('qs_dd_bg_color')),
                'qs_dd_text_color'              => replace_empty_string($this->input->post('qs_dd_text_color')),
                'qs_dd_selected_bg_color'       => replace_empty_string($this->input->post('qs_dd_selected_bg_color')),
                'qs_dd_selected_text_color'     => replace_empty_string($this->input->post('qs_dd_selected_text_color')),
                'search_by_text_color'          => replace_empty_string($this->input->post('search_by_text_color')),
                'selectall_text_color'          => replace_empty_string($this->input->post('selectall_text_color')),
                'payment_accept_text_bg_color'  => replace_empty_string($this->input->post('payment_accept_text_bg_color')),
                'payment_accept_text_color'     => replace_empty_string($this->input->post('payment_accept_text_color')),
                'first_load_more_bg_color'      => replace_empty_string($this->input->post('first_load_more_bg_color')),
                'first_load_more_text_color'    => replace_empty_string($this->input->post('first_load_more_text_color')),
                'second_load_more_bg_color'     => replace_empty_string($this->input->post('second_load_more_bg_color')),
                'second_load_more_text_color'   => replace_empty_string($this->input->post('second_load_more_text_color')),
                'third_load_more_bg_color'      => replace_empty_string($this->input->post('third_load_more_bg_color')),
                'third_load_more_text_color'    => replace_empty_string($this->input->post('third_load_more_text_color')),
                'page_404_bg_color'             => replace_empty_string($this->input->post('page_404_bg_color')),
                'page_404_btn_bg_color'         => replace_empty_string($this->input->post('page_404_btn_bg_color')),
                'page_404_btn_text_color'       => replace_empty_string($this->input->post('page_404_btn_text_color')),
                'entry_pop_login_text_color'    => replace_empty_string($this->input->post('entry_pop_login_text_color')),
                'entry_pop_btn_text_color'      => replace_empty_string($this->input->post('entry_pop_btn_text_color')),
                'entry_pop_btn_bg_color'        => replace_empty_string($this->input->post('entry_pop_btn_bg_color')),
                'entry_pop_guest_text_color'    => replace_empty_string($this->input->post('entry_pop_guest_text_color')),
                'entry_pop_guest_text_hover_color' => replace_empty_string($this->input->post('entry_pop_guest_text_hover_color')),
                'entry_pop_permanent_text_color'   => replace_empty_string($this->input->post('entry_pop_permanent_text_color')),
                'entry_pop_apply_btn_text_color'   => replace_empty_string($this->input->post('entry_pop_apply_btn_text_color')),
                'entry_pop_apply_btn_bg_color'     => replace_empty_string($this->input->post('entry_pop_apply_btn_bg_color')),
                'entry_pop_apply_btn_text_hover_color' => replace_empty_string($this->input->post('entry_pop_apply_btn_text_hover_color')),
                'entry_pop_border_color'       => replace_empty_string($this->input->post('entry_pop_border_color')),
                'common_loader_bg_color'       => replace_empty_string($this->input->post('common_loader_bg_color')),
                'common_loader_text_color'     => replace_empty_string($this->input->post('common_loader_text_color'))
            );
            $post_data = $this->security->xss_clean($post_data);
            $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));

            $front_colors = array(
                'qs_search_shadow'              => replace_empty_string($this->input->post('qs_search_shadow')),
                'accordion_background_color'    => replace_empty_string($this->input->post('accordion_background_color')),
                'accordion_text_color'          => replace_empty_string($this->input->post('accordion_text_color')),
                'checkbox_checked_color'        => replace_empty_string($this->input->post('checkbox_checked_color')),
                'qs_search_label'               => replace_empty_string($this->input->post('qs_search_label')),
                'body_background_color'         => replace_empty_string($this->input->post('body_background_color')),
                'qs_heading_color'              => replace_empty_string($this->input->post('qs_heading_color')),
                'pop_up_title_color'            => replace_empty_string($this->input->post('pop_up_title_color')),
                'home_heading'                  => replace_empty_string($this->input->post('home_heading')),
                'header_border_color'           => replace_empty_string($this->input->post('header_border_color')),
                'header_border_shadow'          => replace_empty_string($this->input->post('header_border_shadow')),
                'insta_gallery_bg_color'        => replace_empty_string($this->input->post('insta_gallery_bg_color')),
                'home_whats_color'              => replace_empty_string($this->input->post('home_whats_color')),
                'home_whats_color_shadow'       => replace_empty_string($this->input->post('home_whats_color_shadow')),
                'home_whats_new_section_background'=> replace_empty_string($this->input->post('home_whats_new_section_background')),
                'home_whats_new_section_background_shadow'=> replace_empty_string($this->input->post('home_whats_new_section_background_shadow')),
                'selectall_bg_color'            => replace_empty_string($this->input->post('selectall_bg_color')),
                'part_number_title_color'       => replace_empty_string($this->input->post('part_number_title_color')),
                'price_title_color'             => replace_empty_string($this->input->post('price_title_color')),
                'product_attr_title_color'      => replace_empty_string($this->input->post('product_attr_title_color')),
                'product_model_title_color'     => replace_empty_string($this->input->post('product_model_title_color')),
                'Instock_detail_color'     => replace_empty_string($this->input->post('Instock_detail_color')),
                'outstock_detail_color'     => replace_empty_string($this->input->post('outstock_detail_color')),
                'addpricerequest_color'     => replace_empty_string($this->input->post('addpricerequest_color')),
                'addpricerequest_active_color'     => replace_empty_string($this->input->post('addpricerequest_active_color')),
                'cart_back_btn_color'     => replace_empty_string($this->input->post('cart_back_btn_color')),
                'cart_save_btn_color'     => replace_empty_string($this->input->post('cart_save_btn_color')),
		'cart_submit_btn_color'     => replace_empty_string($this->input->post('cart_submit_btn_color')),
		'product_load_more_btn'     => replace_empty_string($this->input->post('product_load_more_btn'))
            );
            $result = $this->comman_model->update_where('front_colors', $front_colors, array('id' => $id));


            $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
        }
        // this code execute when user submit the home product  form
        if ($this->input->post('home_product_section')) {
            $this->form_validation->set_rules('product_section_head', 'Product Head', 'trim|required');
            $this->form_validation->set_rules('product_section_title', 'Product Title', 'trim|required');
            $this->form_validation->set_rules('product_section_description', 'Product Description', 'trim|required');
            $this->form_validation->set_rules('production_section_button_text', 'Product Button Text', 'trim|required');
            $this->form_validation->set_rules('product_section_button_url', 'Product Button URL', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
            } else {
                if (!empty($_FILES['file']['name'])) {
                    $field_name = 'file';
                    $config['upload_path'] = './assets/uploads/home_product/full/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '800';
                    $config['max_width'] = '2000';
                    $config['max_height'] = '2000';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload($field_name)) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('admin/index/edit_welcome_page/' . $action . '/' . $id);
                    } else {
                        $upload_data = $this->upload->data();
                        $this->load->library('image_lib');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/uploads/home_product/full/' . $upload_data['file_name'];
                        $config['new_image'] = 'assets/uploads/home_product/thumbnails/' . $upload_data['file_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 200;
                        $config['height'] = 120;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();

                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/uploads/home_product/full/' . $upload_data['file_name'];
                        $config['new_image'] = 'assets/uploads/home_product/small/' . $upload_data['file_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 100;
                        $config['height'] = 100;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                        $product_section_image = $upload_data['file_name'];
                    }
                } else {
                    $product_section_image = $this->input->post('hidden_product_section_image');
                }
                $post_data = array(
                    'product_section_image' => $product_section_image,
                    'product_section_head' => $this->input->post('product_section_head'),
                    'product_section_title' => $this->input->post('product_section_title'),
                    'product_section_description' => $this->input->post('product_section_description'),
                    'production_section_button_text' => $this->input->post('production_section_button_text'),
                    'product_section_button_url' => $this->input->post('product_section_button_url'),
                );
                $post_data = $this->security->xss_clean($post_data);
                $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));
                $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));
                if (!empty($_FILES['file']['name'])) {
                    if ($result) {
                        if (file_exists("assets/uploads/home_product/" . $all_data['product_section_image']))
                            unlink("assets/uploads/home_product/" . $all_data['product_section_image']);

                        if (file_exists("assets/uploads/home_product/full/" . $all_data['product_section_image']))
                            unlink("assets/uploads/home_product/full/" . $all_data['product_section_image']);

                        if (file_exists("assets/uploads/home_product/small/" . $all_data['product_section_image']))
                            unlink("assets/uploads/home_product/small/" . $all_data['product_section_image']);

                        if (file_exists("assets/uploads/home_product/thumbnails/" . $all_data['product_section_image']))
                            unlink("assets/uploads/home_product/thumbnails/" . $all_data['product_section_image']);
                    }
                }
                $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
                redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
            }
        }
        // this code execute when user submit the home page heading  form
        if ($this->input->post('home_page_headings')) {

            $post_data = array(
                'whats_new'                 => $this->input->post('whats_new'),
                'contact_us'                => $this->input->post('contact_us'),
                'quick_links'               => $this->input->post('quick_links'),
                'route_map'                 => $this->input->post('route_map'),
                'social_media'              => $this->input->post('social_media'),
                'contact_us_status'         => $this->input->post('contact_us_status'),
                'quick_links_status'        => $this->input->post('quick_links_status'),
                'route_map_status'          => $this->input->post('route_map_status'),
                'social_media_status'       => $this->input->post('social_media_status'),
                'products'                  => $this->input->post('products'),
                'datetimer_section_status'  => $this->input->post('datetimer_section_status'),
                'instruction_section_status'=> $this->input->post('instruction_section_status'),
                'shipping_section_status'   => $this->input->post('shipping_section_status'),
                'poweredby_section_status'  => $this->input->post('poweredby_section_status'),
                'footer_email_status'       => $this->input->post('footer_email_status'),
                'home_product_heading_status'  => $this->input->post('home_product_heading_status'),
                'invoice_download_btn_status'  => $this->input->post('invoice_download_btn_status'),
                'package_download_btn_status'  => $this->input->post('package_download_btn_status'),
                'invoice_print_btn_status'  => $this->input->post('invoice_print_btn_status'),
                'next_btn_user_msg_status'  => $this->input->post('next_btn_user_msg_status'),
                'payment_accept_section_status'  => $this->input->post('payment_accept_section_status'),
                'header_search_status'      => $this->input->post('header_search_status'),
                'header_quick_search_status'=> $this->input->post('header_quick_search_status'),
                'show_home_page'      => $this->input->post('show_home_page'),
                'page_url'      => $this->input->post('page_url'),
                'default_quick_search'      => $this->input->post('default_quick_search'),
                'quick_search_hide_category'=> $this->input->post('quick_search_hide_category'),
                'instagram_feed_status'     => $this->input->post('instagram_feed_status'),
            );
            $post_data = $this->security->xss_clean($post_data);               
            $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));
            $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
        }
        
        // this code execute when user submit the home page instagram  form
        if ($this->input->post('home_page_instagram_feed')) {
            $postData = $this->input->post();
            $feeds = array();

            $targetdir = './assets/uploads/home_instagram/full/';
            if (!is_dir($targetdir)) {
                mkdir($targetdir, 0777, TRUE);
            }

            $targetdir = './assets/uploads/home_instagram/thumbnails/';
            if (!is_dir($targetdir)) {
                mkdir($targetdir, 0777, TRUE);
            }

            $targetdir = './assets/uploads/home_instagram/small/';
            if (!is_dir($targetdir)) {
                mkdir($targetdir, 0777, TRUE);
            }


            for ($i = 0; $i <= 4; $i++) {
                $feeds[$i]['url'] = $postData['insta_url_' . $i];
                if (!empty($_FILES['insta_file_' . $i]['name'])) {
                    $field_name = 'insta_file_' . $i;
                    $config['upload_path'] = './assets/uploads/home_instagram/full/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '800';
                    $config['max_width'] = '2000';
                    $config['max_height'] = '2000';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload($field_name)) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('admin/index/edit_welcome_page/' . $action . '/' . $id);
                    } else {
                        $upload_data = $this->upload->data();
                        $this->load->library('image_lib');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/uploads/home_instagram/full/' . $upload_data['file_name'];
                        $config['new_image'] = 'assets/uploads/home_instagram/thumbnails/' . $upload_data['file_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 200;
                        $config['height'] = 120;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();

                        $config['image_library'] = 'gd2';
                        $config['source_image'] = 'assets/uploads/home_instagram/full/' . $upload_data['file_name'];
                        $config['new_image'] = 'assets/uploads/home_instagram/small/' . $upload_data['file_name'];
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 100;
                        $config['height'] = 100;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                        $feeds[$i]['image'] = $upload_data['file_name'];
                    }
                } else {
                    $feeds[$i]['image'] = $postData['insta_image_' . $i];
                }
            }
            $feeds = serialize($feeds);
            $all_data = $this->comman_model->get_data_by_id('home_page', array('id' => $id));
            $result = $this->comman_model->update_where('home_page', array('home_page_instagram_feed' => $feeds), array('id' => $id));
            $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
        }

        // this is Start of SEO Module added by SUJAN
        if ($this->input->post('seo_module')) {
            
            $post_data = array(
                'seo_meta_desc'             => $this->input->post('seo_meta_desc'),
                'seo_meta_keywords'         => $this->input->post('seo_meta_keywords')
                
            );
            $post_data = $this->security->xss_clean($post_data);               
            $result = $this->comman_model->update_where('home_page', $post_data, array('id' => $id));
            $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
        }
        // This is end of SEO module added by SUJAN

        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('welcome_page', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => ($action == 'library') ? 'home' : 'welcome',
            'addscripts'            => 'edit_welcome_page',
            'edit_page'             => $action,
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'general_instruction'   => $all_language_data['general_instruction'],
            'admin_page_title'      => $all_language_data['admin_page_title'],
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_products'    => $all_language_data['admin_products'],
            'admin_edit_welcomepage' => $all_language_data['admin_edit_welcomepage'],
            'edit_data'             => $edit_data,
        );


        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/index/edit_home_page', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method empty_data
     *  This Function delete the image as per column name and row id from the home page table.
     * @param $page $page [This parameter is the column name.]
     * @param $id $id [This parameter is the row id.]
     *
     * @return void
     */
    function empty_data($page = false, $id = false)
    {

        validateAdminLogin();

        if (!$page || !$id) {
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
        }

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('welcome_page');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }


        $check = $this->comman_model->get_data_by_id('home_page', array('id' => $id));
        if (empty($check)) {
            // if data   is empty as per the row id than  this function redirect user to listing  page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
        }

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];

        if ($page == 'logo') {
            $field = array('logo' => '', 'name' => '');
            $column = 'logo';
            $name = 'Logo';
            $path = 'logo';
        } else if ($page == 'fevicon') {
            $field = array('fevicon' => '');
            $column = 'fevicon';
            $name = 'Fevicon';
            $path = 'logo';
        } else if ($page == 'background') {
            $field = array('background_image' => '');
            $column = 'background_image';
            $name = 'Background';
            $path = 'background';
        } else if ($page == 'main_background') {
            $field = array('main_background_image' => '');
            $column = 'main_background_image';
            $name = 'Inner Page Background';
            $path = 'background';
        } else if ($page == 'main_footer_background') {
            $field = array('main_footer_background' => '');
            $column = 'main_footer_background';
            $name = 'Inner Page Footer Background';
            $path = 'background';
        } else if ($page == 'footer_name') {
            $field = array('footer_name' => '');
            $name = 'Footer';
        } else if ($page == 'cart_photo') {
            $field = array('cart_photo' => '');
            $column = 'cart_photo';
            $name = 'Cart';
            $path = 'cart';
        } else if ($page == 'product_type_img') {
            $field = array('product_type_img' => '');
            $column = 'product_type_img';
            $name = 'Product type image';
            $path = 'vehicle_categories';
        } else if ($page == 'vehicle_type_img') {
            $field = array('vehicle_type_img' => '');
            $column = 'vehicle_type_img';
            $name = 'Vehicle type image';
            $path = 'vehicle_categories';
        } else if ($page == 'common_loader_img') {
            $field = array('common_loader_img' => '');
            $column = 'common_loader_img';
            $name = 'Common loader image';
            $path = '';
        } else if ($page == 'footer') {
            $field = array('footer_image' => '');
            $column = 'footer_image';
            $name = 'Footer';
            $path = 'footer';
        } else if ($page == 'home_page_headings') {
            $field =  array('whats_new' => '', 'contact_us' => '', 'quick_links' => '', 'route_map' => '', 'social_media' => '',  'products' => '');
            $column = '';
            $name = '';
            $path = '';
        } else {
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
        }

        $result = $this->comman_model->update_data_by_id('home_page', $field, 'id', $id);
        if ($result) {
            if ($column) {
                if (file_exists("assets/uploads/" . $path . "/" . $check[$column]))
                    unlink("assets/uploads/" . $path . "/" . $check[$column]);

                if (file_exists("assets/uploads/" . $path . "/full/" . $check[$column]))
                    unlink("assets/uploads/" . $path . "/full/" . $check[$column]);

                if (file_exists("assets/uploads/" . $path . "/small/" . $check[$column]))
                    unlink("assets/uploads/" . $path . "/small/" . $check[$column]);

                if (file_exists("assets/uploads/" . $path . "/thumbnails/" . $check[$column]))
                    unlink("assets/uploads/" . $path . "/thumbnails/" . $check[$column]);
            }
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);
        }

        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page');
    }

    /**
     * Method logout
     * This Function logout the admin user and clear all session variables.
     * @return void
     */
    function logout()
    {
        // this code delete all session variables
        $sessiondata = $this->session->userdata('admin_validuser_data');
        $where_param['email'] = $sessiondata['email'];
        $where_param['country_code'] = $sessiondata['country_code'];
        $where_param['telephone'] = $sessiondata['telephone'];
        $this->comman_model->deleteAdminValidUserdata($where_param);
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('login');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('first_name');
        $this->session->unset_userdata('last_name');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('country_code');
        $this->session->unset_userdata('telephone');
        $this->session->unset_userdata('page_access');
        $this->session->unset_userdata('admin_validuser_data');
        //  after clearing data this function redirect to the login page
        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/entry_door', 'refresh');
    }

    /**
     * Method time_digits
     * This Function Display edit form and update the time digits.
     * @return void
     */
    function time_digits(){

        validateUser();

        validateAdminLogin();

        // this function validate the access of this page for current logged admin user.

        $access = validatePageAccess('time_digits');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        // This Function retutn language data as per the section name and language id
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_title'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {
            $update_data = array();
            $update_data['digit_0'] = $this->input->post("digit_0");
            $update_data['digit_1'] = $this->input->post("digit_1");
            $update_data['digit_2'] = $this->input->post("digit_2");
            $update_data['digit_3'] = $this->input->post("digit_3");
            $update_data['digit_4'] = $this->input->post("digit_4");
            $update_data['digit_5'] = $this->input->post("digit_5");
            $update_data['digit_6'] = $this->input->post("digit_6");
            $update_data['digit_7'] = $this->input->post("digit_7");
            $update_data['digit_8'] = $this->input->post("digit_8");
            $update_data['digit_9'] = $this->input->post("digit_9");
            $update_data = $this->security->xss_clean($update_data);
            $this->comman_model->update_column("time_digits", array('id' => 1), $update_data);

            $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);

            redirect(base_url() . "admin/" . $this->lang->default_lang . "/index/time_digits");
        }

        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => $all_language_data['admin_title']['time_digits']['front'],
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'time_digits',
            'admin_title'           => $all_language_data['admin_title'],
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'time_digits'           => allDataArray($this->comman_model->GetAllDataLangByid('time_digits', 'id', 1, $this->lang->default_lang_id, 'time_digits_country')),
            'admin_time_digits'     => $this->comman_model->GetAllDataLangByid("time_digits", 'id', '1', $this->lang->default_lang_id, 'time_digits_country')
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/index/time_digits', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method state_instructions
     * This Function Display edit  form and update the states on the behalf of  country  passed in the parameter.
     * @param $countryCode $countryCode [This parameter is the country code.]
     *
     * @return void
     */
    function state_instructions($countryCode = 'ca')
    {
        validateUser();

        validateAdminLogin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('state_instructions');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        // this function return language data as per sections name
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_block_users'), $this->lang->default_lang_id);

        if ($this->input->post('operation')) {
            // this  code  executed when user submit the form.
            foreach ($this->input->post('states') as $key => $value) {
                $update_data = $this->security->xss_clean(array('name' => $value));
                // this function update states in the  state table as per the state id.
                $this->comman_model->update_column("state", array('id' => $key), $update_data);
            }

            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $all_language_data['admin_static_links']['data_successfully_updated']['front']);

            redirect(base_url() . "admin/" . $this->lang->default_lang . "/index/state_instructions/" . $countryCode);
        }

        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('state_instructions', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'state_instructions',
            'addscripts'            => 'state_instructions',
            'countryCode'           => $countryCode,
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_block_users'     => $all_language_data['admin_block_users'],
            'admin_states'          => $this->comman_model->getStatesAdminlanguage($this->lang->default_lang_id, $countryCode),
            'states'                => $this->comman_model->getStatesAdmin($this->lang->default_lang_id, $countryCode),
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id))

        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/index/state_instructions', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method download_section_common_data
     * This Function download the csv file as per section name passed in the parameter.
     * @param $section $section [This parameter is the section name.]
     * @param $view $view [This parameter is the type of view.]
     *
     * @return void
     */
    function download_section_common_data($section, $view = 'front')
    {
        check_lang_admin();
        validateUser();
        validateAdminLogin();
        $univrsalArr = array();
        $country_data = $this->comman_model->get_row_array('country','*', array('status' => 1));
        if (count($country_data) > 0) {
            // this code iterate each  row as per country id and append in to the univrsalArr array
            foreach ($country_data as  $country) {
                $page_title  = get_admin_lang_data(array($section), $country['id'])[$section];
                if (count($page_title) > 0) {
                    $langContent = array(
                        'language_name'  => $country['name'],
                        'country_id'     => $country['id']
                    );
                    foreach ($page_title as $key => $val) {
                        $langContent[$key] = $val[$view];
                    }
                    $univrsalArr[] = $langContent;
                }
            }

            // if univrsalArr is not empty than this function download the file else redirect to dashboard
            if (count($univrsalArr) > 0) {
                $fileName   = $section . '_' . time() . '.csv';
                dynamic_array_csv_download($univrsalArr, $fileName, 1);
            } else {
                redirect(base_url() . "admin/" . $this->lang->default_lang . "/index/dashboard");
            }
        }
    }
    
    /**
     * Method download_excel_section_wise
     * This Function download the csv file as per table and country table passed in the parameter.
     * @param $table1 $table1 [This parameter is the table name.]
     * @param $table2 $table2 [This parameter is the country table name.]
     *
     * @return void
     */
    function download_excel_section_wise($table1, $table2)
    {
        check_lang_admin();

        validateUser();

        validateAdminLogin();

        $data = array();
        $univrsalArr = array();
        $page_title = $this->comman_model->allDefaultDataArray($table1);
        $page_title = array("language_name" => "English") + $page_title;
        foreach ($page_title as $key => $val) {
            $page_title['lang_' . $key] = $val;
            unset($page_title[$key]);
        }
        $page_title  = array_slice($page_title, 0, 2, true) + array("country_id" => "13") + array_slice($page_title, 2, count($page_title) - 1, true);
        $language_data_by_country = $this->comman_model->language_data_by_country($table2);
        $page_title  = array($page_title);
        $univrsalArr = array_merge($page_title, $language_data_by_country);
        $fileName    = $table1 . '_' . time() . '.csv';
        dynamic_array_csv_download($univrsalArr, $fileName, 1);
    }
    
    /**
     * Method import_common_section_data
     * This Function import data in the database using csv as per section name.
     * @param $section $section [explicite description]
     * @param $view $view [explicite description]
     *
     * @return void
     */
    function import_common_section_data($section, $view = 'front')
    {
        // This Function retutn language data as per the section name and language id
        $all_language_data  = get_admin_lang_data(array($section, 'admin_title'));
        $page_title  = $all_language_data[$section];
        $admin_title = $all_language_data['admin_title'];
        if (count($page_title) > 0) {
            $langContent = array(
                'language_name'  => $country['name'],
                'country_id'     => $country['id']
            );
            foreach ($page_title as $key => $val) {
                $langContent[$key] = $val[$view];
            }
            $page_title = array_keys($langContent);
        }

        if (!empty($_FILES['language_csv_file']['name'])) {

            $file_original = explode(".", $_FILES['language_csv_file']['name']);
            if ($file_original[1] != "csv") {
                $result = array('message' => $admin_title['csv_file_type']['front'], 'status' => 0);
                echo json_encode($result);
                exit;
            }

            $csv_file_name = $file_original[0] . "_" . time() . "." . $file_original[1];
            $upload_path = './assets/uploads/languagecsv/' . $csv_file_name;
            if (!move_uploaded_file($_FILES['language_csv_file']['tmp_name'], $upload_path)) {
                $result = array('message' => $admin_title['csv_file_error']['front'], 'status' => 0);
                echo json_encode($result);
                exit;
            } else {
                $file_path = './assets/uploads/languagecsv/' . $csv_file_name;
                if (file_exists($file_path)) {
                } else {
                    $result = array('message' => $admin_title['csv_file_error']['front'], 'status' => 0);
                    echo json_encode($result);
                    exit;
                }

                $updatedrow = array();
                $notupdatedrow = array();
                $notcountry = array();


                if (($handle = fopen($file_path, "r")) !== FALSE) {
                    // Condition to check  file columns as per the section
                    $file_header = fgetcsv(fopen($file_path, "r"), 200000, ",");
                    if (array_diff($page_title, $file_header)) {
                        $result = array('message' => $admin_title['csv_file_format']['front'], 'status' => 0, "page_title" => $page_title, "file_header" => $file_header);
                        echo json_encode($result);
                        exit;
                    }

                    $row = 1;
                    $rowheader = array();
                    while (($data = fgetcsv($handle, 200000, ",")) !== FALSE) {
                        $singlerow = array();

                        if ($row == 1) {
                            $rowheader = $data;
                        } else {
                            $singlerow  = array_combine($rowheader, $data);
                            $country_id = $singlerow['country_id'];
                            unset($singlerow["language_name"]);
                            unset($singlerow["country_id"]);
                            if ($country_id) {
                                if ($country_id == 13) {
                                    foreach ($singlerow as $key => $value) {
                                        $this->comman_model->update_column('language_data', array('section_name' => $section, 'option_name' => $key), array($view . '_option_value' => $value));
                                    }
                                } else {
                                    foreach ($singlerow as $key => $value) {
                                        $langData = $this->comman_model->get_data_by_id('language_data', array('section_name' => $section, 'option_name' => $key));
                                        $langCountryData = $this->comman_model->get_data_by_id('language_data_country', array('language_data_id' => $langData['id'], 'country_id' => $country_id));
                                        if (count($langCountryData) > 0) {
                                            // this function update value in the table as per the language input
                                            $this->comman_model->update_column('language_data_country', array('language_data_id' => $langData['id'], 'country_id' => $country_id), array("lang_" . $view . "_option_value" => $value));
                                        } else {
                                            // this function insert value in the table as per the language input
                                            $this->comman_model->add('language_data_country', array('language_data_id' => $langData['id'], 'country_id' => $country_id, "lang_" . $view . "_option_value" => $value));
                                        }
                                    }
                                }
                                $updatedrow[] = $row;
                            } else {
                                $notupdatedrow[] = $row;
                            }
                        }
                        $row++;
                    }
                    fclose($handle);
                }
                $result = array('message' => $admin_title['csv_file_success']['front'], 'status' => 1, "updatedrow" => $updatedrow, "notupdatedrow" => $notupdatedrow);
                echo json_encode($result);
            }
        } else {
            $result = array('message' => $admin_title['csv_file']['front'], 'status' => 0);
            echo json_encode($result);
        }
    }
    
    /**
     * Method import_excel_section_wise
     * This Function import data in the database using csv as per table  name.
     * @return void
     */
    function import_excel_section_wise()
    {
        $admin_title = get_user_lang_data(array('admin_title'))['admin_title'];

        $table_Name = $this->security->xss_clean($this->input->post('language_table_country'));
        $page_array = $this->comman_model->get_row_array($table_Name, "*", array("lang_id" => "1"));
        $page_title = array_keys($page_array[0]);

        if (!empty($_FILES['language_csv_file']['name'])) {

            $file_original = explode(".", $_FILES['language_csv_file']['name']);
            if ($file_original[1] != "csv") {
                $result = array('message' => $admin_title['csv_file_type'], 'status' => 0);
                echo json_encode($result);
                exit;
            }

            $csv_file_name = $file_original[0] . "_" . time() . "." . $file_original[1];
            $upload_path = './assets/uploads/languagecsv/' . $csv_file_name;
            if (!move_uploaded_file($_FILES['language_csv_file']['tmp_name'], $upload_path)) {
                $result = array('message' => $admin_title['csv_file_error'], 'status' => 0);
                echo json_encode($result);
                exit;
            } else {
                $file_path = './assets/uploads/languagecsv/' . $csv_file_name;
                if (file_exists($file_path)) {
                } else {
                    $result = array('message' => $admin_title['csv_file_error'], 'status' => 0);
                    echo json_encode($result);
                    exit;
                }

                $updatedrow = array();
                $notupdatedrow = array();
                $notcountry = array();

                if (($handle = fopen($file_path, "r")) !== FALSE) {
                    // Condition to check  file columns as per the section
                    $file_header = fgetcsv(fopen($file_path, "r"), 200000, ",");
                    if (array_diff($page_title, $file_header)) {
                        $result = array('message' => $admin_title['csv_file_format'], 'status' => 0, "page_title" => $page_title, "file_header" => $file_header);
                        echo json_encode($result);
                        exit;
                    }
                    $row = 1;
                    $rowheader = array();
                    while (($data = fgetcsv($handle, 200000, ",")) !== FALSE) {
                        $singlerow = array();

                        if ($row == 1) {
                            $rowheader = $data;
                        } else {
                            $singlerow = array_combine($rowheader, $data);
                            unset($singlerow["lang_language_name"]);

                            if ($singlerow['country_id']) {
                                if ($singlerow['country_id'] == 13) {
                                    // check to add english language data only

                                    $table_Name_eng = $this->security->xss_clean($this->input->post('language_table'));
                                    $table_eng_id = $singlerow["lang_id"];

                                    unset($singlerow["country_id"]);
                                    unset($singlerow["lang_id"]);

                                    foreach ($singlerow as $key => $val) {
                                        $keydata = explode("lang_", $key);
                                        $singlerow[$keydata[1]] = $val;
                                        unset($singlerow[$key]);
                                    }
                                    $responce = $this->comman_model->update_data_by_id($table_Name_eng, $singlerow, "id", $table_eng_id);
                                } else {
                                    $responce = $this->comman_model->update_data_by_id($table_Name, $singlerow, "country_id", $singlerow['country_id']);
                                }
                                $updatedrow[] = $row;
                            } else {
                                $notupdatedrow[] = $row;
                            }
                        }
                        $row++;
                    }
                    fclose($handle);
                }
                $result = array('message' => $admin_title['csv_file_success'], 'status' => 1, "updatedrow" => $updatedrow, "notupdatedrow" => $notupdatedrow);
                echo json_encode($result);
            }
        } else {
            $result = array('message' => $admin_title['csv_file'], 'status' => 0);
            echo json_encode($result);
        }
    }
    
    /**
     * Method update_all_language_status
     * This Function make language  json file for admin sections.
     * @return void
     */
    function update_all_language_status()
    {
        $this->db->select('group_concat(id) as id');
        $this->db->where('status', 1);
        $this->db->where('id !=', 13);
        $result = $this->db->get('country')->row_array();
        $countries = (isset($result['id']) && $result['id']) ? explode(',', $result['id']) : array();
        $total = count($countries);

        // Fetch and store static table
        $lang_tables = array('admin_roles_country', 'admin_bambora_errors_country', 'bambora_errors_country', 'banner_images_country', 'countries_lang', 'home_page_country', 'tbl_product_category_maker_model_relation_country', 'tbl_product_item_relation_country', 'navigation_pages_country', 'package_country', 'pages_country', 'tbl_vehicle_categories_country', 'tbl_product_items_country', 'tbl_makers_country', 'tbl_models_country', 'tbl_product_natures_country', 'tbl_product_types_country', 'admin_stripe_errors_country', 'stripe_errors_country', 'time_digits_country', 'admin_ups_errors_country', 'ups_errors_country', 'admin_ups_service_code_description_country', 'ups_service_code_description_country', 'whats_new_country');

        foreach ($lang_tables as $table) {
            $this->db->select('*');
            $this->db->group_by('lang_id');
            $response = $this->db->get($table)->result_array();
            if (count($response) > 0) {
                foreach ($response as $key => $res) {
                    $languageId = $res['lang_id'];
                    unset($res['lang_id']);
                    unset($res['country_id']);
                    $res = array_keys($res);
                    if (count($res) > 0) {
                        foreach ($res as $field) {
                            $this->db->select('lang_id');
                            $this->db->where('lang_id', $languageId);
                            $this->db->where_in('country_id', $countries);
                            $this->db->where($field . ' !=', '');
                            $exist = $this->db->get($table)->num_rows();
                            $status = 0;
                            if ($total == $exist) {
                                $status = 1;
                            }
                            $conditionData = array('lang_id' => $languageId, 'table' => $table, 'field' => $field);
                            $this->db->select('id');
                            $this->db->where($conditionData);
                            $status_check = $this->db->get('admin_all_language_status')->num_rows();
                            if ($status_check == 0) {
                                $conditionData['status'] = $status;
                                $this->db->insert('admin_all_language_status', $conditionData);
                            } else {
                                $this->db->where($conditionData);
                                $this->db->update('admin_all_language_status', array('status' => $status));
                            }
                        }
                    }
                }
            }
        }

        // Fetch and store Common table
        $commonlangData = $this->db->get('language_data')->result_array();
        if (count($commonlangData) > 0) {
            foreach ($commonlangData as $langData) {
                $columns = array('admin' => 'lang_admin_option_value', 'front' => 'lang_front_option_value');
                foreach ($columns as $key => $column) {
                    $this->db->select('id');
                    $this->db->where('language_data_id ', $langData['id']);
                    $this->db->where_in('country_id', $countries);
                    $this->db->where($column . ' !=', '');
                    $exist = $this->db->get('language_data_country')->num_rows();
                    $status = 0;
                    if ($total == $exist) {
                        $status = 1;
                    }

                    $conditionData = array('lang_id' => 1, 'table' => $langData['section_name'], 'field' => $key . '_' . $langData['option_name']);
                    $this->db->select('id');
                    $this->db->where($conditionData);
                    $status_check = $this->db->get('admin_all_language_status')->num_rows();
                    if ($status_check == 0) {
                        $conditionData['status'] = $status;
                        $this->db->insert('admin_all_language_status', $conditionData);
                    } else {
                        $this->db->where($conditionData);
                        $this->db->update('admin_all_language_status', array('status' => $status));
                    }
                }
            }
        }

        $languageData = $this->db->get('admin_all_language_status')->result_array();
        $jsonData = array();
        foreach ($languageData as $language) {
            $jsonData[$language['lang_id'] . '-' . $language['table'] . '-' . $language['field']] = $language['status'];
        }

        if (count($jsonData) > 0) {
            unlink("vendor/admin_all_language_status.json");
            file_put_contents("vendor/admin_all_language_status.json", json_encode($jsonData));
        }
    }

    /**
     * Method saveLanguagedData
     * This function is used to save the label  value of sections on admin side . 
     * @param $id $id [This parameter is the id of the row.]
     * @param $table_name $table_name [This parameter is the table name.]
     * @param $field_name $field_name [This parameter is the column name of the row.]
     *
     * @return void
     */
    function saveLanguagedData($id, $table_name, $field_name)
    {
        // this post  parameter is the value for the column to update in the table
        $field_value = $this->security->xss_clean($this->input->post('field_value'));
        if (isset($field_value) && $field_value != '') {
            // if post paramter is not empty than this function update record in the database.
            $result = $this->comman_model->addOrUpdateAdminMultilangueValues($table_name, $field_name, $id, $field_value);
            echo 'success';
        } else {
            echo 'fail';
        }
        exit;
    }

    /**
     * Method download_excel_data
     * This Function download the excel data of the based on passed table name with multilangual data. 
     * @param $table1 $table1 [This parameter is the table name.]
     * @param $table2 $table2 [This parameter is the language table.]
     * @param $field $field [This parameter is the language field name of table.]
     *
     * @return void
     */
    function download_excel_data($table1, $table2, $field = 'error_text')
    {
        check_lang_admin();
        validateUser();
        validateAdminLogin();
        $page_title = $this->comman_model->getExportDataArray($table1, $table2, $field);
        $fileName   = $table1 . '_' . time() . '.csv';
        dynamic_array_csv_download($page_title, $fileName);
    }

    /**
     * Method global_settings
     * This function list all global settings. 
     * @return void
     */
    function global_settings(){

        validateUser();

        validateAdminLogin();

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('global_settings');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('operation')) {
            if (count($this->input->post()) > 0) {
                // this  code  executed when user submit the form.
                foreach ($this->input->post() as $key => $value) {

                    if ($key == "hide_industry" && $value == "1") {

                        $this->comman_model->update_column('home_page', array('id' =>"1"), array('default_quick_search' => "category"));
                    }

                    if ($key == "enable_distributor_feature" && $value == "1") {

                        $this->comman_model->update_column('global_settings', array('setting_name' => "product_list_show_to_guest_user"), array('setting_value' => "0", 'updatedDate' => date('Y-m-d H:i:s')));
                        $this->comman_model->update_column('global_settings', array('setting_name' => "hide_product_list"), array('setting_value' => "0", 'updatedDate' => date('Y-m-d H:i:s')));

                    }

                    if ($key == "enable_distributor_feature" && $value == "0") {

                        $this->comman_model->update_column('global_settings', array('setting_name' => "product_list_show_to_guest_user"), array('setting_value' => "1", 'updatedDate' => date('Y-m-d H:i:s')));

                        $this->comman_model->update_column('global_settings', array('setting_name' => "hide_product_list"), array('setting_value' => "1", 'updatedDate' => date('Y-m-d H:i:s')));

                    }
                    // this loop iterate each input and saved in the table
                    $this->comman_model->update_column('global_settings', array('setting_name' => $key), array('setting_value' => $value, 'updatedDate' => date('Y-m-d H:i:s')));
                }

                $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
                // this function set success message in flash to display on frontend.
                $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
                redirect(base_url() . "admin/" . $this->lang->default_lang . "/index/global_settings");
            }
        }


        // This code is for the pagination of the data.
        $config['per_page']     = 50;
        $config['num_links']    = 5;
        $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/index/global_settings/";
        $config['uri_segment']  = 5;
        $config['total_rows']   = $this->comman_model->record_count('global_settings');
        $offset                 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $key = '';
        $this->pagination->initialize($config);

        // This Function retutn language data as per the section name and language id
        $all_language_data  = get_admin_lang_data(array('admin_sidebar', 'admin_static_links', 'admin_pages', 'admin_front_entry_door_verification','api_instruction'), $this->lang->default_lang_id);
        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('global_settings', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'global_settings',
            'addscripts'            => 'global_settings',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->comman_model->record_search_data('global_settings', $key, 'setting_name', $config['per_page'], $offset),
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_sidebar'         => $all_language_data['admin_sidebar'],
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_pages'           => $all_language_data['admin_pages'],
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'api_instruction'       => $all_language_data['api_instruction'],
            'admin_front_entry_door_verification' => $all_language_data['admin_front_entry_door_verification']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/index/global_settings_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
}
