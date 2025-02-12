<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Search
 * This class handle master search on admin dashboard.
 */
class Search extends CI_Controller
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
        validateAdminLogin();
        validateUser();
    }

    /**
     * Method index
     * This Function Display search result as per search text enter by the admin user.
     * @return void
     */
    function index()
    {
        //Get the  user keyword from post method
        $search_text        = $this->security->xss_clean($this->input->post('search'));

        //Get the common data to use views.
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_sidebar'), $this->lang->default_lang_id);
        $admin_sidebar      = $all_language_data['admin_sidebar'];
        $admin_static_links = $all_language_data['admin_static_links'];

        // get the country data to define the search result is availale in which country
        $country_data      = $this->comman_model->get_row_array('country', '*', array('status' => 1));

        //initialise empty variables
        $searchData = array();

        if (isset($search_text) && $search_text != '') {

            // check and define the db query search key format based on user serach keywordd
            if ($search_text[0] == '*' && $search_text[strlen($search_text) - 1] == '*') {
                $like_para = 'prefix_suffix';
                $search_text = ltrim($search_text, '*');
                $search_text = rtrim($search_text, '*');
            } else if ($search_text[0] == '*') {
                $like_para = 'prefix';
                $search_text = ltrim($search_text, '*');
                $search_text = rtrim($search_text, '*');
            } else if ($search_text[strlen($search_text) - 1] == '*') {
                $like_para = 'suffix';
                $search_text = ltrim($search_text, '*');
                $search_text = rtrim($search_text, '*');
            } else {
                $like_para = 'none';
                $search_text = ltrim($search_text, '*');
                $search_text = rtrim($search_text, '*');
            }

            // Get the Master global search data in the retun of array format
            $result     = $this->comman_model->search_db($search_text, $like_para, $country_data);

            // echo "<pre>";
            // print_r($result);
            // exit;

            $searchData = $this->getSearchResultData($result, $admin_sidebar, $country_data);
        }

        $plang  = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('global_search', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'home',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en',
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $country_data,
            'admin_sidebar'         => $admin_sidebar,
            'admin_static_links'    => $admin_static_links,
            'searchData'            => $searchData,
            'search_text'           => $search_text
        );

        // Load the required view files
        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/search/global_search', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * getSearchResultData
     *
     * This function return the search dispaly data based on search results
     * @param  mixed $result
     * @param  mixed $admin_sidebar
     * @param  mixed $country_data
     * @return void
     */
    function getSearchResultData($result, $admin_sidebar, $country_data)
    {

        // get the country data to define the search result is availale in which country
        $countrylang = $langname = array();
        foreach ($country_data as $cd) {
            $countrylang[$cd['id']] = $cd['short_code'];
            $langname[$cd['short_code']] = ' (' .  $cd['name'] . ')';
        }

        // The below listed all the conditions are will check based on table name and create the list search array data to return view files.

        $searchData = array();

        // Defined zero and exclude the list repeated for if some static and dynamic table exists 
        $welcome_page = $menu = $language = $userblocked = $front_blocks_list = $orders = $adminrole = $adminuser = $admin_blocks_list = 0;


        // Country related data  pages and their conditions
        if (isset($result['language_data']) && count($result['language_data']) > 0) {

            $commonSectionNames = array('general_instruction', 'product_instruction', 'cart_instruction', 'form_validation_instruction', 'email_instruction', 'page_title', 'cart_timer', 'entry_door_timer', 'entry_door_message', 'selection_instruction', 'admin_static_links', 'admin_products', 'admin_title', 'admin_door_timer', 'sales_order_preview', 'payment_instructions', "contact_message", "bambora_instructions", "api_instruction");



            foreach ($result['language_data'] as $language) {

                //check and defined the country shortcode, if country id exist in the result array or else it will be default.
                if (isset($language['country_id']) && $language['country_id']) {
                    $lang_id = isset($countrylang[$language['country_id']]) ? $countrylang[$language['country_id']] : 'en';
                } else {
                    $lang_id = 'en';
                }

                if ($language['country_id'] == $this->lang->default_lang_id || $this->lang->default_lang_id == "13") {
                    // Check Common Language section exist and create search data
                    if (in_array($language['section_name'], $commonSectionNames)) {
                        $searchData[] = array(
                            'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/multilangue/section/' . $language['section_name'],
                            'pagename' => $admin_sidebar[$language['section_name']]['admin'] . $langname[$lang_id]
                        );

                        //  echo $admin_sidebar[$language['section_name']]['admin'] .$language['country_id']."<br>";
                    } else if ($language['section_name'] == 'admin_setting' || $language['section_name'] == 'admin_edit_welcomepage') {
                        $searchData[] = array(
                            'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page',
                            'pagename' => $admin_sidebar['settings']['admin'] . $langname[$lang_id]
                        );
                        $welcome_page = 1;
                    } else if ($language['section_name'] == 'admin_sidebar') {
                        $searchData[] = array(
                            'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/index/dashboard',
                            'pagename' => $admin_sidebar['dashboard']['admin'] . $langname[$lang_id]
                        );
                        $welcome_page = 1;
                    } else if ($language['section_name'] == 'countries') {
                        $searchData[] = array(
                            'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/countries',
                            'pagename' => $admin_sidebar['country_instructions'] . $langname[$lang_id]
                        );
                    } else if ($language['section_name'] == 'admin_country') {
                        $searchData[] = array(
                            'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/language',
                            'pagename' => $admin_sidebar['language_list']['admin'] . $langname[$lang_id]
                        );
                        $language = 1;
                    } else if ($language['section_name'] == 'admin_block_users') {
                        $searchData[] = array(
                            'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/userblocked',
                            'pagename' => $admin_sidebar['block_users']['admin'] . $langname[$lang_id]
                        );
                        $userblocked = 1;
                    } else if ($language['section_name'] == 'admin_front_user_block_list') {
                        $searchData[] = array(
                            'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/front_blocks_list',
                            'pagename' => $admin_sidebar['front_user_block_list']['admin'] . $langname[$lang_id]
                        );
                        $front_blocks_list = 1;
                    } else if ($language['section_name'] == 'admin_order_details') {
                        $searchData[] = array(
                            'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/orders',
                            'pagename' => $admin_sidebar['order_details']['admin'] . $langname[$lang_id]
                        );
                        $orders = 1;
                    } else if ($language['section_name'] == 'admin_users_front_entry_door') {
                        $searchData[] = array(
                            'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/users_front_entry_door',
                            'pagename' => $admin_sidebar['users_list']['admin'] . $langname[$lang_id]
                        );
                    } else if ($language['section_name'] == 'admin_admin_roles' || $language['section_name'] == 'admin_role_page') {
                        $searchData[] = array(
                            'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/adminrole',
                            'pagename' => $admin_sidebar['admin_roles']['admin'] . $langname[$lang_id]
                        );
                        $adminrole = 1;
                    } else if ($language['section_name'] == 'admin_admin_users') {
                        $searchData[] = array(
                            'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/adminuser',
                            'pagename' => $admin_sidebar['admin_users']['admin'] . $langname[$lang_id]
                        );
                        $adminuser = 1;
                    } else if ($language['section_name'] == 'admin_blocks_list') {
                        $searchData[] = array(
                            'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/admin_blocks_list',
                            'pagename' => $admin_sidebar['admin_user_block_list']['admin'] . $langname[$lang_id]
                        );
                        $admin_blocks_list = 1;
                    } else if ($language['section_name'] == 'admin_tbl_product_items') {
                        $searchData[] = array(
                            'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/productitems',
                            'pagename' => $admin_sidebar['product_items']['admin'] . $langname[$lang_id]
                        );
                    } else if ($language['section_name'] == 'admin_pages') {
                        $searchData[] = array(
                            'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/homepagesetting',
                            'pagename' => $admin_sidebar['pages_block']['admin'] . $langname[$lang_id]
                        );
                    } else if ($language['section_name'] == 'admin_navigation_pages') {
                        $searchData[] = array(
                            'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/homepagesetting/navigation_setting',
                            'pagename' => $admin_sidebar['pages_block']['admin'] . $langname[$lang_id]
                        );
                    } else if ($language['section_name'] == 'admin_title') {
                        $searchData[] = array(
                            'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/homepagesetting/navigation_setting',
                            'pagename' => $admin_sidebar['admin_title']['admin'] . $langname[$lang_id]
                        );
                    }
                }
            }
        }

        if (!empty($result['admin_state']) || !empty($result['admin_state_country'])) {

            if (!empty($result['admin_state']) && $this->lang->default_lang_id == "13") {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/index/state_instructions',
                    'pagename' => $admin_sidebar['state_instructions']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            if (!empty($result['admin_state_country']) && $result['admin_state_country']['country_id'] == $this->lang->default_lang_id) {
                if (!empty($result['admin_state_country'])) {
                    $lang_id = $countrylang[$result['admin_state_country']['country_id']];
                } else {
                    $lang_id = 'en';
                }
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/index/state_instructions',
                    'pagename' => $admin_sidebar['state_instructions']['admin'] . $langname[$lang_id]
                );
            }
        }


        if (!empty($result['state']) || !empty($result['state_country'])) {

            if (!empty($result['admin_state']) && $this->lang->default_lang_id == "13") {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/index/state_instructions',
                    'pagename' => $admin_sidebar['state_instructions']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            if (!empty($result['state_country']) && $result['state_country']['country_id'] == $this->lang->default_lang_id) {
                if (!empty($result['state_country'])) {
                    $lang_id = $countrylang[$result['state_country']['country_id']];
                } else {
                    $lang_id = 'en';
                }
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/index/state_instructions',
                    'pagename' => $admin_sidebar['state_instructions']['admin'] . $langname[$lang_id]
                );
            }
        }

        if (!empty($result['banner_images']) || !empty($result['banner_images_country'])) {

            if (!empty($result['banner_images']) && $this->lang->default_lang_id == "13") {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/homepagesetting/banner_setting',
                    'pagename' => $admin_sidebar['banner_setting']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            if (!empty($result['banner_images_country']) && $result['banner_images_country']['country_id'] == $this->lang->default_lang_id) {
                if (!empty($result['banner_images_country'])) {
                    $lang_id = $countrylang[$result['banner_images_country']['country_id']];
                } else {
                    $lang_id = 'en';
                }
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/homepagesetting/banner_setting',
                    'pagename' => $admin_sidebar['banner_setting']['admin'] . $langname[$lang_id]
                );
            }
        }

        if (!empty($result['package']) || !empty($result['package_country'])) {

            if (!empty($result['package']) && $this->lang->default_lang_id == "13") {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/package',
                    'pagename' => $admin_sidebar['package']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            if (!empty($result['package_country']) && $result['package_country']['country_id'] == $this->lang->default_lang_id) {
                if (!empty($result['package_country'])) {
                    $lang_id = $countrylang[$result['package_country']['country_id']];
                } else {
                    $lang_id = 'en';
                }
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/package',
                    'pagename' => $admin_sidebar['package']['admin'] . $langname[$lang_id]
                );
            }
        }


        if (!empty($result['stripe_errors']) || !empty($result['stripe_errors_country'])) {

            if (!empty($result['stripe_errors']) && $this->lang->default_lang_id == "13") {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/errors/index/stripe_errors',
                    'pagename' => $admin_sidebar['stripe_errors']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            if (!empty($result['stripe_errors_country']) && $result['stripe_errors_country']['country_id'] == $this->lang->default_lang_id) {
                if (!empty($result['stripe_errors_country'])) {
                    $lang_id = $countrylang[$result['stripe_errors_country']['country_id']];
                } else {
                    $lang_id = 'en';
                }
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/vehicle_categories',
                    'pagename' => $admin_sidebar['stripe_errors']['admin'] . $langname[$lang_id]
                );
            }
        }



        if (!empty($result['tbl_vehicle_categories']) || !empty($result['tbl_vehicle_categories_country'])) {

            if (!empty($result['tbl_vehicle_categories']) && $this->lang->default_lang_id == "13") {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/vehicle_categories',
                    'pagename' => $admin_sidebar['vehicle_category']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            if (!empty($result['tbl_vehicle_categories_country']) && $result['tbl_vehicle_categories_country']['country_id'] == $this->lang->default_lang_id) {
                if (!empty($result['tbl_vehicle_categories_country'])) {
                    $lang_id = $countrylang[$result['tbl_vehicle_categories_country']['country_id']];
                } else {
                    $lang_id = 'en';
                }
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/vehicle_categories',
                    'pagename' => $admin_sidebar['vehicle_category']['admin'] . $langname[$lang_id]
                );
            }
        }


        if (!empty($result['tbl_makers']) || !empty($result['tbl_makers_country'])) {

            if (!empty($result['tbl_makers']) && $this->lang->default_lang_id == "13") {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/makers',
                    'pagename' => $admin_sidebar['product_makers']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            if (!empty($result['tbl_makers_country']) && $result['tbl_makers_country']['country_id'] == $this->lang->default_lang_id) {
                if (!empty($result['tbl_makers_country'])) {
                    $lang_id = $countrylang[$result['tbl_makers_country']['country_id']];
                } else {
                    $lang_id = 'en';
                }
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/makers',
                    'pagename' => $admin_sidebar['product_makers']['admin'] . $langname[$lang_id]
                );
            }
        }

        if (!empty($result['tbl_models']) || !empty($result['tbl_models_country'])) {

            if (!empty($result['tbl_models']) && $this->lang->default_lang_id == "13") {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/product_model',
                    'pagename' => $admin_sidebar['product_models']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            if (!empty($result['tbl_models_country']) && $result['tbl_models_country']['country_id'] == $this->lang->default_lang_id) {
                if (!empty($result['tbl_models_country'])) {
                    $lang_id = $countrylang[$result['tbl_models_country']['country_id']];
                } else {
                    $lang_id = 'en';
                }
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/product_model',
                    'pagename' => $admin_sidebar['product_models']['admin'] . $langname[$lang_id]
                );
            }
        }

        if (!empty($result['tbl_product_types']) || !empty($result['tbl_product_types_country'])) {

            if (!empty($result['tbl_product_types']) && $this->lang->default_lang_id == "13") {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/product_type',
                    'pagename' => $admin_sidebar['product_type']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            if (!empty($result['tbl_product_types_country']) && $result['tbl_product_types_country']['country_id'] == $this->lang->default_lang_id) {
                if (!empty($result['tbl_product_types_country'])) {
                    $lang_id = $countrylang[$result['tbl_product_types_country']['country_id']];
                } else {
                    $lang_id = 'en';
                }
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/product_type',
                    'pagename' => $admin_sidebar['product_type']['admin'] . $langname[$lang_id]
                );
            }
        }

        if (!empty($result['products']) || !empty($result['products_country']) || !empty($result['products'])) {

            if (!empty($result['products']) && $this->lang->default_lang_id == "13" || !empty($result['products'])) {

                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/part_relation',
                    'pagename' => $admin_sidebar['part_relation']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            if (!empty($result['products_country']) && $result['products_country']['country_id'] == $this->lang->default_lang_id) {
                if (!empty($result['products_country'])) {
                    $lang_id = $countrylang[$result['products_country']['country_id']];
                } else {
                    $lang_id = 'en';
                }
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/part_relation',
                    'pagename' => $admin_sidebar['part_relation']['admin'] . $langname[$lang_id]
                );
            }
        }


        if (!empty($result['tbl_product_natures']) || !empty($result['tbl_product_natures_country'])) {

            if (!empty($result['tbl_product_natures']) && $this->lang->default_lang_id == "13") {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/productnatures',
                    'pagename' => $admin_sidebar['product_natures']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            if (!empty($result['tbl_product_natures_country']) && $result['tbl_product_natures_country']['country_id'] == $this->lang->default_lang_id) {
                if (!empty($result['tbl_product_natures_country'])) {
                    $lang_id = $countrylang[$result['tbl_product_natures_country']['country_id']];
                } else {
                    $lang_id = 'en';
                }
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/productnatures',
                    'pagename' => $admin_sidebar['product_natures']['admin'] . $langname[$lang_id]
                );
            }
        }

        if (!empty($result['tbl_product_items']) || !empty($result['tbl_product_items_country'])) {
            if (!empty($result['tbl_product_items']) && $this->lang->default_lang_id == "13") {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/productitems',
                    'pagename' => $admin_sidebar['product_items']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            $lang_id = 'en';
            if (!empty($result['tbl_product_items_country']) && $result['tbl_product_items_country']['country_id'] == $this->lang->default_lang_id) {
                $lang_id = $countrylang[$result['tbl_product_items_country']['country_id']];
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/productitems',
                    'pagename' => $admin_sidebar['product_items']['admin'] . $langname[$lang_id]
                );
            }
        }


        if (!empty($result['whats_new']) || !empty($result['whats_new_country'])) {
            if (!empty($result['whats_new']) && $this->lang->default_lang_id == "13") {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/homepagesetting/whats_new_setting',
                    'pagename' => $admin_sidebar['whats_new_setting']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            if (!empty($result['whats_new_country']) && $this->lang->default_lang_id == $result['whats_new_country']['country_id']) {
                if (!empty($result['whats_new_country'])) {
                    $lang_id = $countrylang[$result['whats_new_country']['country_id']];
                } else {
                    $lang_id = 'en';
                }
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/homepagesetting/whats_new_setting',
                    'pagename' => $admin_sidebar['whats_new_setting']['admin'] . $langname[$lang_id]
                );
            }
        }


        if (!empty($result['ups_errors']) || !empty($result['ups_errors_country']) || !empty($result['admin_ups_errors']) || !empty($result['admin_ups_errors_coumntry'])) {

            if (!empty($result['ups_errors']) || !empty($result['admin_ups_errors'])) {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $lang_id . '/errors/index/ups_errors',
                    'pagename' => $admin_sidebar['ups_errors']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            if (!empty($result['ups_errors_country']) || !empty($result['admin_ups_errors_country'])) {
                if (!empty($result['ups_errors_country'])) {
                    $lang_id = $countrylang[$result['ups_errors_country']['country_id']];
                } else if (!empty($result['admin_ups_errors_country'])) {
                    $lang_id = $countrylang[$result['admin_ups_errors_country']['country_id']];
                } else {
                    $lang_id = 'en';
                }

                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $lang_id . '/errors/index/ups_errors',
                    'pagename' => $admin_sidebar['ups_errors']['admin'] . $langname[$lang_id]
                );
            }
        }


        if (!empty($result['ups_service_code_description']) || !empty($result['ups_service_code_description_country']) || !empty($result['admin_ups_service_code_description']) || !empty($result['admin_ups_service_code_description_country'])) {

            if (!empty($result['ups_service_code_description']) || !empty($result['admin_ups_service_code_description'])) {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/errors/index/ups_service_code_description',
                    'pagename' => $admin_sidebar['ups_service_code_description']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            if (!empty($result['ups_service_code_description_country']) || !empty($result['admin_ups_service_code_description_country'])) {
                if (!empty($result['ups_service_code_description_country'])) {
                    $lang_id = $countrylang[$result['ups_service_code_description_country']['country_id']];
                } else if (!empty($result['admin_ups_service_code_description_country'])) {
                    $lang_id = $countrylang[$result['admin_ups_service_code_description_country']['country_id']];
                } else {
                    $lang_id = 'en';
                }
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/errors/index/ups_service_code_description',
                    'pagename' => $admin_sidebar['ups_service_code_description']['admin'] . $langname[$lang_id]
                );
            }
        }

        if (!empty($result['bambora_errors']) || !empty($result['bambora_errors_country']) || !empty($result['admin_bambora_errors']) || !empty($result['admin_bambora_errors_coumntry'])) {

            if (!empty($result['bambora_errors']) || !empty($result['admin_bambora_errors'])) {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/errors/index/bambora_errors',
                    'pagename' => $admin_sidebar['bambora_errors']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            if (!empty($result['bambora_errors_country']) || !empty($result['admin_bambora_errors_country'])) {
                if (!empty($result['bambora_errors_country'])) {
                    $lang_id = $countrylang[$result['bambora_errors_country']['country_id']];
                } else if (!empty($result['admin_bambora_errors_country'])) {
                    $lang_id = $countrylang[$result['admin_bambora_errors_country']['country_id']];
                } else {
                    $lang_id = 'en';
                }
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/errors/index/bambora_errors',
                    'pagename' => $admin_sidebar['bambora_errors']['admin'] . $langname[$lang_id]
                );
            }
        }

        if (!empty($result['pages']) || !empty($result['pages_country'])) {

            if (!empty($result['pages'])) {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/homepagesetting/edit_page/' . $result['pages']['id'],
                    'pagename' => $result['pages']['title'] . $langname[$this->lang->default_lang]
                );
            }

            $lang_id = 'en';
            if (!empty($result['pages_country'])) {
                $lang_id = $countrylang[$result['pages_country']['country_id']];

                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/homepagesetting/edit_page/' . $result['pages']['id'],
                    'pagename' => $result['pages_country']['lang_title'] . $langname[$lang_id]
                );
            }
        }

        if (!empty($result['navigation_pages']) || !empty($result['navigation_pages_country'])) {

            if (!empty($result['navigation_pages'])) {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/homepagesetting/edit_navigation_page/' . $result['navigation_pages']['id'],
                    'pagename' => $result['navigation_pages']['title'] . $langname[$this->lang->default_lang]
                );
            }

            $lang_id = 'en';
            if (!empty($result['navigation_pages_country']) || !empty($result['admin_navigation_pages_country'])) {
                $lang_id = $countrylang[$result['navigation_pages_country']['country_id']];
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $lang_id . '/homepagesetting/edit_navigation_page/' . $result['navigation_pages_country']['lang_id'],
                    'pagename' => $result['navigation_pages_country']['lang_title'] . $langname[$lang_id]
                );
            }
        }


        if (!empty($result['home_page']) || !empty($result['home_page_country'])) {
            if (!empty($result['home_page']) && $welcome_page == 0) {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page',
                    'pagename' => $admin_sidebar['settings']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            if (!empty($result['home_page_country']) && $this->lang->default_lang_id == $result['home_page_country']['country_id']) {
                if (!empty($result['home_page_country'])) {
                    $lang_id = $countrylang[$result['home_page_country']['country_id']];
                } else {
                    $lang_id = 'en';
                }
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/index/welcome_page',
                    'pagename' => $admin_sidebar['settings']['admin'] . $langname[$lang_id]
                );
            }
        }


        if (!empty($result['admin_roles']) || !empty($result['admin_roles_country']) || !empty($result['admin_role_access'])) {

            if ($adminrole == 0 || (!empty($result['admin_roles']) || !empty($result['admin_role_access']))) {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/adminrole',
                    'pagename' => $admin_sidebar['admin_roles']['admin'] . $langname[$this->lang->default_lang]
                );
            }

            $lang_id = 'en';
            if (!empty($result['admin_roles_country'])) {
                $lang_id = $countrylang[$result['admin_roles_country']['country_id']];
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/adminrole',
                    'pagename' => $admin_sidebar['admin_roles']['admin'] . $langname[$lang_id]
                );
            }
        }
        //  END Country related data  pages and their conditions


        // Country related data  pages and their conditions


        if (!empty($result['country']) && $language == 0) {
            $searchData[] = array(
                'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/language',
                'pagename' => $admin_sidebar['language_list']['admin'] . $langname[$this->lang->default_lang]
            );
        }

        if (!empty($result['aramex_api_setting']) && $language == 0) {
            $searchData[] = array(
                'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/api/shipping_api_setting',
                'pagename' => $admin_sidebar['ups_api_setting']['admin'] . $langname[$this->lang->default_lang]
            );
        }


        if (!empty($result['ups_api_setting']) && $language == 0) {
            $searchData[] = array(
                'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/api/shipping_api_setting',
                'pagename' => $admin_sidebar['ups_api_setting']['admin'] . $langname[$this->lang->default_lang]
            );
        }

        if (!empty($result['payment_accept_card']) && $language == 0) {
            $searchData[] = array(
                'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/homepagesetting/payment_accept_card_setting',
                'pagename' => $admin_sidebar['payment_accept_card_setting']['admin'] . $langname[$this->lang->default_lang]
            );
        }


        if (!empty($result['country']) && $language == 0) {
            $searchData[] = array(
                'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/language',
                'pagename' => $admin_sidebar['language_list']['admin'] . $langname[$this->lang->default_lang]
            );
        }

        if (!empty($result['user_blocked']) && $userblocked == 0) {
            $searchData[] = array(
                'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/userblocked',
                'pagename' => $admin_sidebar['block_users']['admin'] . $langname[$this->lang->default_lang]
            );
        }

        if (!empty($result['entry_door_front_block_data']) || !empty($result['block_email_list']) || !empty($result['entry_door_block_emails']) || !empty($result['entry_door_block_phones']) || !empty($result['cart_block_emails']) || !empty($result['cart_block_phones'])) {
            if ($front_blocks_list == 0) {
                $searchData[] = array(
                    'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/front_blocks_list',
                    'pagename' => $admin_sidebar['front_user_block_list']['admin'] . $langname[$this->lang->default_lang]
                );
            }
        }

        if (!empty($result['users'])) {
            $searchData[] = array(
                'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/users',
                'pagename' => $admin_sidebar['user_details']['admin'] . $langname[$this->lang->default_lang]
            );
        }

        if (!empty($result['discount_coupons'])) {
            $searchData[] = array(
                'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/discounts',
                'pagename' => $admin_sidebar['discount_list']['admin'] . $langname[$this->lang->default_lang]
            );
        }

        if (!empty($result['refferal_users'])) {
            $searchData[] = array(
                'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/referralusers',
                'pagename' => $admin_sidebar['refferaluser_list']['admin'] . $langname[$this->lang->default_lang]
            );
        }

        if (!empty($result['credit_term_requests'])) {
            $searchData[] = array(
                'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/creditterm',
                'pagename' => $admin_sidebar['credit_term_requests']['admin'] . $langname[$this->lang->default_lang]
            );
        }

        if (!empty($result['contact_form'])) {
            $searchData[] = array(
                'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/contact',
                'pagename' => $admin_sidebar['contact_user']['admin'] . $langname[$this->lang->default_lang]
            );
        }

        if (!empty($result['cart']) && $orders == 0) {
            $searchData[] = array(
                'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/orders',
                'pagename' => $admin_sidebar['order_details']['admin'] . $langname[$this->lang->default_lang]
            );
        }

        if (!empty($result['cart_users'])) {
            $searchData[] = array(
                'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/orders/viewOrder/' . $result['cart_users']['id'],
                'pagename' => $admin_sidebar['order_details']['admin'] . $langname[$this->lang->default_lang]
            );
        }

        if (!empty($result['users_front_entry_door'])) {
            $searchData[] = array(
                'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/users_front_entry_door',
                'pagename' => $admin_sidebar['users_list']['admin'] . $langname[$this->lang->default_lang]
            );
        }



        if (!empty($result['admin_users']) && $adminuser == 0) {
            $searchData[] = array(
                'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/adminuser',
                'pagename' => $admin_sidebar['admin_users']['admin'] . $langname[$lang_id]
            );
        }

        if (!empty($result['entry_door_admin_block_data']) && $admin_blocks_list == 0) {
            $searchData[] = array(
                'url'      => base_url() . 'admin/' . $this->lang->default_lang . '/admin_blocks_list',
                'pagename' => $admin_sidebar['admin_user_block_list']['admin'] . $langname[$this->lang->default_lang]
            );
        }




        // Return search display data
        return $searchData;
    }
}
