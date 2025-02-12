<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Language
 * Language Class handle all methods related to Language  like list, add , edit , delete, enable and disable
 */
class Language extends CI_Controller
{

    /**
     * Method __construct
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('security', 'assets'));
        $this->load->library('form_validation');
        $this->load->model(array('comman_model'));
        validateAdminLogin();
        validateUser();
    }

    /**
     * Method index
     * This function list all languages. 
     * @param $param1='' $param1 [This parameter is used for pagination.]
     * @param $param2=0 $param2 [This parameter is used for pagination.]
     *
     * @return void
     */
    function index()
    {

        $access = validatePageAccess('language');
        if ($access['page_access'] != 1) {
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteSelected')) {

            // this function delete language as per ids passed in the post parameter
            $allLanguageIds = $this->input->post('delete_option');

            $all_datas = $this->comman_model->getAllById('country', $allLanguageIds);

            $this->comman_model->deleteAllById('country', $allLanguageIds);

            foreach ($all_datas as $all_data) {
                $this->removeLanguageImage($all_data);
            }

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/language');
        }

        // This Function retutn language data as per the section name and language id
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_country'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('language', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'language',
            'addscripts'            => 'country_list',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->comman_model->all_data('country'),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_country'         => (object)$all_language_data['admin_country']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/language/language_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    function add_language()
    {

        $access = validatePageAccess('language');
        if ($access['page_add'] != 1) {
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('operation')) {
            $upload_data = array();

            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path']      = './assets/uploads/country/full/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = '2048';
                $config['max_width']        = '2000';
                $config['max_height']       = '2000';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    $form_validation_instruction = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction['client_logo']['front']) ? $form_validation_instruction['client_logo']['front'] : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';
                    $this->session->set_flashdata('error', $error_lang);
                    redirect('admin/language/add_language');
                } else {
                    $upload_data = $this->upload->data();

                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/country/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/country/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 450;
                    $config['height'] = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/uploads/country/full/' . $upload_data['file_name'];
                    $config['new_image'] = 'assets/uploads/country/small/' . $upload_data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 16;
                    $config['height'] = 11;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }

            $post_data = array(
                'name'          => $this->input->post('title'),
                'image'         => isset($upload_data['file_name']) ? $upload_data['file_name'] : '',
                'create_date'   => time(),
                'status'        => 1,
                'short_code'    => strtolower($this->input->post('short_code')),
                'position'      => $this->input->post('position')
            );
            $post_data = $this->security->xss_clean($post_data);
            $result    = $this->comman_model->add('country', $post_data);

            if (!empty($_FILES['coming_soon_image']['name'])) {
                $field_name = 'coming_soon_image';
                $config = array();
                $upload_data = array();
                $config['upload_path']      = './assets/uploads/country/coming_soon/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = '2048';
                $config['max_width']        = '2000';
                $config['max_height']       = '2000';
                $this->upload->initialize($config);
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    $form_validation_instruction = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction['client_logo']['front']) ? $form_validation_instruction['client_logo']['front'] : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';
                    $this->session->set_flashdata('error', $error_lang);
                    redirect('admin/language/add_language');
                } else {
                    $upload_data = $this->upload->data();
                    $post_data = array('coming_soon_image' => $upload_data['file_name']);
                    $this->comman_model->update_data_by_id('country', $post_data, 'id', $result);
                }
            }

            if (!empty($_FILES['no_image']['name'])) {
                $field_name = 'no_image';
                $config = array();
                $upload_data = array();
                $config['upload_path']   = './assets/uploads/country/no_image/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['max_width']     = '2000';
                $config['max_height']    = '2000';
                $this->upload->initialize($config);
                $this->load->library('upload', $config);
                $this->upload->do_upload($field_name);
                $upload_data = $this->upload->data();
                $post_data = array('no_image' => $upload_data['file_name']);
                $this->comman_model->update_data_by_id('country', $post_data, 'id', $result);
            }

            if (!empty($_FILES['default_image']['name'])) {
                $field_name = 'default_image';
                $config = array();
                $upload_data = array();
                $config['upload_path'] = './assets/uploads/country/default_image/';
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = '2048';
                $config['max_width']        = '2000';
                $config['max_height']       = '2000';
                $this->upload->initialize($config);
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($field_name)) {
                    $form_validation_instruction = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction['client_logo']['front']) ? $form_validation_instruction['client_logo']['front'] : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';
                    $this->session->set_flashdata('error', $error_lang);
                    redirect('admin/language/add_language');
                } else {
                    $upload_data = $this->upload->data();
                    $post_data = array('default_image' => $upload_data['file_name']);
                    $this->comman_model->update_data_by_id('country', $post_data, 'id', $result);
                }
            }

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/language');
        }

        // This Function retutn language data as per the section name and language id
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_country'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('language', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'sub_menu'              => 'add_article',
            'active'                => 'language',
            'addscripts'            => 'country_list',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->comman_model->all_data('country'),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_country'         => (object)$all_language_data['admin_country']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/language/language_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    function edit_language($id = false)
    {
        if (!$id) {
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/language');
        }

        $access = validatePageAccess('language');
        if ($access['page_edit'] != 1) {
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('operation')) {
            if (!empty($_FILES['file']['name'])) {
                $field_name = 'file';
                $config['upload_path']      = './assets/uploads/country/full/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = '2048';
                $config['max_width']        = '2000';
                $config['max_height']       = '2000';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($field_name)) {
                    $form_validation_instruction = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction['client_logo']['front']) ? $form_validation_instruction['client_logo']['front'] : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';
                    $this->session->set_flashdata('error', $error_lang);
                    redirect('admin/language/edit_language/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $config['image_library']    = 'gd2';
                    $config['source_image']     = 'assets/uploads/country/full/' . $upload_data['file_name'];
                    $config['new_image']        = 'assets/uploads/country/thumbnails/' . $upload_data['file_name'];
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 450;
                    $config['height']           = 450;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config['image_library']    = 'gd2';
                    $config['source_image']     = 'assets/uploads/country/full/' . $upload_data['file_name'];
                    $config['new_image']        = 'assets/uploads/country/small/' . $upload_data['file_name'];
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 16;
                    $config['height']           = 11;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }

            if (!empty($_FILES['file']['name'])) {
                $post_data = array(
                    'name'      => $this->input->post('title'),
                    'image'     => $upload_data['file_name'],
                    'position'  => $this->input->post('position')
                );
            } else {
                $post_data = array(
                    'name'      => $this->input->post('title'),
                    'position'  => $this->input->post('position')
                );
            }
            $post_data = $this->security->xss_clean($post_data);

            if (!empty($_FILES['coming_soon_image']['name'])) {
                $field_name = 'coming_soon_image';
                $config = array();
                $upload_data = array();
                $config['upload_path']      = './assets/uploads/country/coming_soon/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = '2048';
                $config['max_width']        = '2000';
                $config['max_height']       = '2000';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload($field_name);
                if (!$this->upload->do_upload($field_name)) {
                    $form_validation_instruction = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction['client_logo']['front']) ? $form_validation_instruction['client_logo']['front'] : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';
                    $this->session->set_flashdata('error', $error_lang);
                    redirect('admin/language/edit_language/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $post_data['coming_soon_image'] = $upload_data['file_name'];
                }
            }

            if (!empty($_FILES['no_image']['name'])) {
                $field_name = 'no_image';
                $config = array();
                $upload_data = array();
                $config['upload_path']      = './assets/uploads/country/no_image/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = '2048';
                $config['max_width']        = '2000';
                $config['max_height']       = '2000';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $this->upload->do_upload($field_name);
                $upload_data = $this->upload->data();
                $post_data['no_image'] = $upload_data['file_name'];
            }

            if (!empty($_FILES['default_image']['name'])) {
                $field_name = 'default_image';
                $config = array();
                $upload_data = array();
                $config['upload_path'] = './assets/uploads/country/default_image/';
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = '2048';
                $config['max_width']        = '2000';
                $config['max_height']       = '2000';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload($field_name);
                if (!$this->upload->do_upload($field_name)) {
                    $form_validation_instruction = get_user_lang_data(array('form_validation_instruction'), $this->lang->default_lang_id)['form_validation_instruction'];
                    $error_lang = isset($form_validation_instruction['client_logo']['front']) ? $form_validation_instruction['client_logo']['front'] : 'File should be Max 2 MB and either: jpg, png, jpeg or gif';
                    $this->session->set_flashdata('error', $error_lang);
                    redirect('admin/language/edit_language/' . $id);
                } else {
                    $upload_data = $this->upload->data();
                    $post_data['default_image'] = $upload_data['file_name'];
                }
            }

            $all_data = $this->comman_model->get_data_by_id('country', array('id' => $id));
            $result   = $this->comman_model->update_data_by_id('country', $post_data, 'id', $id);
            if ($result) {
                //This function delete language image from the country folder based on form updation.
                if (isset($post_data['image']) && $post_data['image']) {
                    if (file_exists("assets/uploads/country/full/" . $all_data['image']))
                        unlink("assets/uploads/country/full/" . $all_data['image']);
                    if (file_exists("assets/uploads/country/small/" . $all_data['image']))
                        unlink("assets/uploads/country/small/" . $all_data['image']);
                    if (file_exists("assets/uploads/country/thumbnails/" . $all_data['image']))
                        unlink("assets/uploads/country/thumbnails/" . $all_data['image']);
                } else if (isset($post_data['coming_soon_image']) && $post_data['coming_soon_image']) {
                    if (file_exists("assets/uploads/country/coming_soon/" . $all_data['coming_soon_image']))
                        unlink("assets/uploads/country/coming_soon/" . $all_data['coming_soon_image']);
                } else if (isset($post_data['no_image']) && $post_data['no_image']) {
                    if (file_exists("assets/uploads/country/no_image/" . $all_data['no_image']))
                        unlink("assets/uploads/country/no_image/" . $all_data['no_image']);
                } else if (isset($post_data['default_image']) && $post_data['default_image']) {
                    if (file_exists("assets/uploads/country/default_image/" . $all_data['default_image']))
                        unlink("assets/uploads/country/default_image/" . $all_data['default_image']);
                }
            }

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/language');
        }

        // This Function retutn language data as per the section name and language id
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_country'), $this->lang->default_lang_id);
        $plang  = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('language', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'language',
            'addscripts'            => 'edit_language',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->comman_model->all_data('country'),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_country'         => (object)$all_language_data['admin_country'],
            'edit_data'             => $this->comman_model->get_data_by_id('country', array('id' => $id))
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/language/language_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method delete_language
     * This Function delete single  language as per the  id passed in the  parameter.
     * @param $id $id  [This Parameter is the language id. ]
     *
     * @return void
     */
    function delete_language($id)
    {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('language');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        // this function get language data based on language id.
        $all_data = $this->comman_model->get_data_by_id('country', array('id' => $id));

        // this function delete language data from the table.
        $result   = $this->comman_model->delete_where('country', array('id' => $id));
        if ($result) {
            // this function delete language image from the country folder.
            $this->removeLanguageImage($all_data);
        }

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/language');
    }

    /**
     * Method removeLanguageImage
     * This function delete language image from the country folder.
     * @param $all_data $all_data [This Parameter is the language data. ]
     */
    function removeLanguageImage($all_data)
    {
        if (file_exists("assets/uploads/country/full/" . $all_data['image']))
            unlink("assets/uploads/country/full/" . $all_data['image']);
        if (file_exists("assets/uploads/country/small/" . $all_data['image']))
            unlink("assets/uploads/country/small/" . $all_data['image']);
        if (file_exists("assets/uploads/country/thumbnails/" . $all_data['image']))
            unlink("assets/uploads/country/thumbnails/" . $all_data['image']);
        if (file_exists("assets/uploads/country/coming_soon/" . $all_data['coming_soon_image']))
            unlink("assets/uploads/country/coming_soon/" . $all_data['coming_soon_image']);
        if (file_exists("assets/uploads/country/default_image/" . $all_data['default_image']))
            unlink("assets/uploads/country/default_image/" . $all_data['default_image']);
        if (file_exists("assets/uploads/country/no_image/" . $all_data['no_image']))
            unlink("assets/uploads/country/no_image/" . $all_data['no_image']);
    }

    /**
     * Method checkLanguageNameExists
     * This Function checked that is language exist in the country or not.
     * @param $languageId $languageId [This Parameter is the language id. ]
     *
     * @return void
     */
    public function checkLanguageNameExists($languageId = '')
    {
        $title = $this->input->post('title');
        if ($languageId && $title) {
            $result = $this->comman_model->get_data_by_id('country', array('id' => $languageId));
            if ($title == $result['name']) {
                echo json_encode(TRUE);
            } else {
                // this function check is record exist in the table with same language name or not.
                $exists = $this->comman_model->check_row_exists('country', array('name' => $title));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        } else if ($title) {
            // this function check is record exist in the table with same language name or not.
            $exists = $this->comman_model->check_row_exists('country', array('name' => $title));
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
     * Method checkLanguageCodeExists
     * This Function checked that is language exist in the country or not.
     * @param $languageId $languageId [This Parameter is the language id. ]
     *
     * @return void
     */
    public function checkLanguageCodeExists($languageId = '')
    {
        $short_code = $this->input->post('short_code');
        if ($languageId && $short_code) {
            $result = $this->comman_model->get_data_by_id('country', array('id' => $languageId));
            if ($short_code == $result['short_code']) {
                echo json_encode(TRUE);
            } else {
                // this function check is record exist in the table with same language code or not.
                $exists = $this->comman_model->check_row_exists('country', array('short_code' => $short_code));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        } else if ($short_code) {
            // this function check is record exist in the table with same language code or not.
            $exists = $this->comman_model->check_row_exists('country', array('short_code' => $short_code));
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
     * Method update_status
     * This Function update status in the table as per table name passed in the post parameter.
     * @return void
     */
    function update_status()
    {
        $post_data = array('status' => $this->security->xss_clean($this->input->post('status')));
        $id = $this->security->xss_clean($this->input->post('id'));
        $table_name = $this->input->post('table_name');
        if ($id != 13) {
            $this->comman_model->update_data_by_id($table_name, $post_data, 'id', $id);
            //$this->cron_language_status();
        }
    }

    /**
     * Method del_languageimagepermanently
     * This Function update image field and remove the images in the table as per field name passed in the post parameter.
     * @param $languageId $languageId [This Parameter is the language id. ]
     * @param $imagetodelete $imagetodelete [This Parameter is the image field name. ]
     * @return void
     */
    function del_languageimagepermanently($languageId, $imagetodelete)
    {
        $post_data[$imagetodelete] = '';
        $all_data = $this->comman_model->get_data_by_id('country', array('id' => $languageId));
        $update = $this->comman_model->update_data_by_id('country', $post_data, 'id', $languageId);
        if ($update) {
            if ($imagetodelete == 'image') {
                if (file_exists("assets/uploads/country/full/" . $all_data['image']))
                    unlink("assets/uploads/country/full/" . $all_data['image']);
                if (file_exists("assets/uploads/country/small/" . $all_data['image']))
                    unlink("assets/uploads/country/small/" . $all_data['image']);
                if (file_exists("assets/uploads/country/thumbnails/" . $all_data['image']))
                    unlink("assets/uploads/country/thumbnails/" . $all_data['image']);
            } else if ($imagetodelete == 'coming_soon_image') {
                if (file_exists("assets/uploads/country/coming_soon/" . $all_data['coming_soon_image']))
                    unlink("assets/uploads/country/coming_soon/" . $all_data['coming_soon_image']);
            } else {
                if (file_exists("assets/uploads/country/" . $imagetodelete . "/" . $all_data[$imagetodelete]))
                    unlink("assets/uploads/country/" . $imagetodelete . "/" . $all_data[$imagetodelete]);
            }
        }
    }

    /**
     * Method default_language_list
     * This function list all default language options. 
     * @return void
     */

    function default_language_list()
    {

        $access = validatePageAccess('set_default_language');
        if ($access['page_access'] != 1) {
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('DeleteSelected')) {

            // this function delete default language list as per ids passed in the post parameter
            $allLanguageIds = $this->input->post('delete_option');

            $this->comman_model->deleteAllById('default_language', $allLanguageIds);

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
            // this function set success message in flash to display on frontend.
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/language/default_language_list');
        }

        // This Function retutn language data as per the section name and language id
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_country'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('default_language', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'set_default_language',
            'addscripts'            => 'default_language_list',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->comman_model->get_all_default_language_list($this->lang->default_lang_id),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_country'         => (object)$all_language_data['admin_country']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/language/default_language_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    function add_default_language()
    {

        $access = validatePageAccess('set_default_language');
        if ($access['page_add'] != 1) {
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('operation')) {
            $post_data = array(
                'countryCode'   => $this->input->post('countryCode'),
                'stateCode'     => $this->input->post('stateCode'),
                'languageId'    => $this->input->post('languageId'),
                'dateAdded'     => date('Y-m-d H:i:s'),
                'dateUpdated'   => date('Y-m-d H:i:s')
            );
            $post_data = $this->security->xss_clean($post_data);
            $this->comman_model->add('default_language', $post_data);

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/language/default_language_list');
        }

        // This Function retutn language data as per the section name and language id
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_country'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('default_language', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'sub_menu'              => 'add_default_language',
            'active'                => 'set_default_language',
            'addscripts'            => 'add_default_language',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->comman_model->all_data('default_language'),
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'languages'             => $this->comman_model->all_data('country'),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_country'         => (object)$all_language_data['admin_country']
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/language/default_language_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    function edit_default_language($id = false)
    {
        if (!$id) {
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/language');
        }

        $access = validatePageAccess('set_default_language');
        if ($access['page_edit'] != 1) {
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        if ($this->input->post('operation')) {
            $post_data = array(
                'countryCode'   => $this->input->post('countryCode'),
                'stateCode'     => $this->input->post('stateCode'),
                'languageId'    => $this->input->post('languageId'),
                'dateUpdated'   => date('Y-m-d H:i:s')
            );
            $post_data = $this->security->xss_clean($post_data);

            $this->comman_model->update_data_by_id('default_language', $post_data, 'id', $id);

            $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_updated')['admin_static_links'];
            $this->session->set_flashdata('success', $admin_static_links['data_successfully_updated']);
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/language/default_language_list');
        }

        // This Function retutn language data as per the section name and language id
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_country'), $this->lang->default_lang_id);
        $plang  = $this->comman_model->getPrimaryLang();
        $editData = $this->comman_model->get_data_by_id('default_language', array('id' => $id));

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('default_language', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'set_default_language',
            'addscripts'            => 'edit_default_language',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'all_data'              => $this->comman_model->all_data('country'),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'countries'             => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'languages'             => $this->comman_model->all_data('country'),
            'states'                => $this->getStateByCountry($editData['countryCode'], $editData['stateCode']),
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'admin_country'         => (object)$all_language_data['admin_country'],
            'edit_data'             => $editData
        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/language/default_language_form', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method getStateByCountry
     * This Function checked and return the state list based on country code.
     * @param $countryCode $countryCode [This Parameter is the country code. ]
     * @param $stateCode $stateCode [This Parameter is the state code. ]
     *
     * @return void
     */
    function getStateByCountry($countryCode = '', $state_val = '')
    {
        $countryCode = $countryCode ? $countryCode : $this->input->post('countryCode');
        $stateCode = $state_val ? $state_val : $this->input->post('stateCode');
        $states = $this->comman_model->getStatesAdmin($this->lang->default_lang_id, $countryCode);
        $html = '<option value="">select any one</option>';
        if (count($states) > 0) {
            foreach ($states as $state) {
                if ($stateCode == $state['shortcode']) {
                    $html .= '<option value="' . $state['shortcode'] . '" selected>' . $state['name'] . '</option>';
                } else {
                    $html .= '<option value="' . $state['shortcode'] . '">' . $state['name'] . '</option>';
                }
            }
        }
        if ($stateCode) {
            echo $html;
        } else {
            echo $html;
        }
    }

    /**
     * Method checkDefaultLanguagExists
     * This Function checked that is default language exist in the country or not.
     * @param $defaultLanguageId $defaultLanguageId [This Parameter is the language id. ]
     *
     * @return void
     */
    public function checkDefaultLanguagExists($defaultLanguageId = '')
    {
        $countryCode = $this->input->post('countryCode');
        $stateCode   = $this->input->post('stateCode');
        if ($defaultLanguageId && $countryCode) {
            $result = $this->comman_model->get_data_by_id('default_language', array('id' => $defaultLanguageId));
            if ($countryCode == $result['countryCode'] && $stateCode == $result['stateCode']) {
                echo json_encode(TRUE);
            } else {
                // this function check is record exist in the table with same language code or not.
                $exists = $this->comman_model->check_row_exists('default_language', array('countryCode' => $countryCode, 'stateCode' => $stateCode));
                if ($exists) {
                    // if exist than this code return false
                    echo json_encode(FALSE);
                } else {
                    // if not  exist than this code return true
                    echo json_encode(TRUE);
                }
            }
        } else if ($countryCode) {
            // this function check is record exist in the table with same language code or not.
            $exists = $this->comman_model->check_row_exists('default_language', array('countryCode' => $countryCode, 'stateCode' => $stateCode));
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
     * Method delete_default_language
     * This Function delete single  language as per the  id passed in the  parameter.
     * @param $id $id  [This Parameter is the language id. ]
     *
     * @return void
     */
    function delete_default_language($id)
    {
        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('set_default_language');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        // this function delete language data from the table.
        $this->comman_model->delete_where('default_language', array('id' => $id));

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect(base_url() . 'admin/' . $this->lang->default_lang . '/language/default_language_list');
    }


    /**
     * Method cron_language_status
     * This Function is used for one time activity.
     * @return void
     */
    public function cron_language_status()
    {



        //  Admin language status change 
        $trunc_query = "TRUNCATE TABLE `admin_all_language_status`";
        $this->db->query($trunc_query);


        $emptyData = array();
        file_put_contents("vendor/admin_all_language_status.json", json_encode($emptyData));


        // Countries
        $this->db->select('group_concat(id) as id');
        $this->db->where('status', 1);
        $this->db->where('id !=', 13);
        $result = $this->db->get('country')->row_array();
        $countries = (isset($result['id']) && $result['id']) ? explode(',', $result['id']) : array();
        $total = count($countries);

        $getfile  = file_get_contents('vendor/admin_all_language_status.json');
        $jsonData = json_decode($getfile, true);

        $query2 = "SELECT language_data.*,(
            SELECT COUNT(*) 
            FROM `language_data_country` 
            WHERE `language_data_id` = `language_data`.`id` and language_data_country.country_id in (" . $result['id'] . ") )  AS `option_count`
         FROM  language_data left join  language_data_country on language_data.id = language_data_country.language_data_id group by language_data.id ";
        $section_array = $this->db->query($query2)->result_array();




        foreach ($section_array as $singlesection) {



            if ($singlesection['option_count'] == $total) {
                // $singlesection['section_name'] . " " . $singlesection['option_name'] . " rows" . $singlesection['option_count'] . "<br>";
                $status = 1;
                $section_name = $singlesection['section_name'];
                $option_name = $singlesection['option_name'];
                $action = "admin";


                /*  Admin Status */
                $conditionData = array('lang_id' => 1, 'table' => $section_name, 'field' => $action . '_' . $option_name);
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

                $jsonData['1-' . $section_name . '-' . $action . '_' . $option_name] = $status;

                /*  Front Status */
                $actionfront = "front";
                $conditionDatafront = array('lang_id' => 1, 'table' => $section_name, 'field' => $actionfront . '_' . $option_name);
                $this->db->select('id');
                $this->db->where($conditionDatafront);
                $statusfront_check = $this->db->get('admin_all_language_status')->num_rows();
                if ($statusfront_check == 0) {
                    $conditionDatafront['status'] = $status;
                    $this->db->insert('admin_all_language_status', $conditionDatafront);
                } else {
                    $this->db->where($conditionDatafront);
                    $this->db->update('admin_all_language_status', array('status' => $status));
                }

                $jsonData['1-' . $section_name . '-' . $actionfront . '_' . $option_name] = $status;
            }
        }


        /**************   Dynamic Tables Update */
        $dynamic_tables = array("home_page", "pages", "tbl_vehicle_categories", "tbl_product_items", "tbl_product_natures", "tbl_product_types", "bambora_errors", "banner_images", "menu", "navigation_pages", "package", "payment_accept_card", "social_media", "tbl_makers", "tbl_models", "products", "admin_state", "admin_state", "admin_bambora_errors", "admin_roles", "admin_stripe_errors", "admin_ups_errors", "admin_ups_service_code_description", "admin_user_country_blocked", "front_entry_door_verification", "sales_order_section_fields", "sales_order_section_values", "time_digits", "ups_errors", "ups_service_code_description", "whats_new", "stripe_errors");


        foreach ($dynamic_tables as $singletable) {

            $table = $singletable;
            $table_country = $singletable . "_country";
            $columns_array = $this->db->get($table_country)->row_array();
            $columns_list = array_slice(array_keys($columns_array), 2);
            $this->db->select('id');
            $single_table_rows =  $this->db->get($singletable)->result_array();
            foreach ($single_table_rows as $single_row) {

                $languageId =  $single_row['id'];


                foreach ($columns_list as $single_colum) {

                    $field = $single_colum;

                    $this->db->select('lang_id');
                    $this->db->where('lang_id', $languageId);
                    $this->db->where_in('country_id', $countries);
                    $this->db->where($field . ' !=', '');
                    $exist = $this->db->get($table_country)->num_rows();
                    $status = 0;
                    if ($total == $exist) {
                        $status = 1;
                    }

                    $conditionData = array('lang_id' => $languageId, 'table' => $table_country, 'field' => $field);

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

                    $jsonData[$languageId . '-' . $table_country . '-' . $field] = $status;
                }
            }
        }


        /************ Diff Structure tables  */

        $dynamic_tables_2 = array("admin_countries", "admin_country", "countries");


        foreach ($dynamic_tables_2 as $singletable2) {

            $table = $singletable2;
            $table_country = $singletable2 . "_lang";
            $columns_array = $this->db->get($table_country)->row_array();
            $columns_list = array_slice(array_keys($columns_array), 2);
            $this->db->select('id');
            $single_table_rows =  $this->db->get($singletable2)->result_array();
            foreach ($single_table_rows as $single_row) {

                $languageId =  $single_row['id'];


                foreach ($columns_list as $single_colum) {

                    $field = $single_colum;

                    $this->db->select('lang_id');
                    $this->db->where('lang_id', $languageId);
                    $this->db->where_in('country_id', $countries);
                    $this->db->where($field . ' !=', '');
                    $exist = $this->db->get($table_country)->num_rows();
                    $status = 0;
                    if ($total == $exist) {
                        $status = 1;
                    }

                    $conditionData = array('lang_id' => $languageId, 'table' => $table_country, 'field' => $field);

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

                    $jsonData[$languageId . '-' . $table_country . '-' . $field] = $status;
                }
            }
        }

        file_put_contents("vendor/admin_all_language_status.json", json_encode($jsonData));
    }
}
