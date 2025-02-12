<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Index  Controller Class
 * 
 * Class to handle home page of the estore. 
 *
 * @author      Kondarsoft Dev Team
 * @link        https://kondarsoft.com/
 * @filesource
 */
class index extends MY_Controller
{

    /**
     * __construct
     * All helpers, models those we need to use in the controller are initialized in the constructor.  
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('product_model', 'comman_model', 'product_items_model', 'part_relation_model','gallery_model'));
        $this->load->helper(array('assets', 'cart_helper', 'common_helper'));
    }

    /**
     * index
     *
     * This Function is used to display home page of the estore. 
     * This method collect data from models  and functions and pass to the views of the home page. 
     * @link https://estorename.kondarsoft.com/en/index 
     * @return void
     */
    function index()
    {
        //  This is helper function to validate logged in user.
        logged_user_validation();

        $all_data = allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country'));

        if($all_data['show_home_page'] == 0 && !empty($all_data['page_url'])){
            redirect($all_data['page_url'], 'refresh');
        }

        // unset session data for some variables
        $this->session->unset_userdata('vehicle_category_id');
        $this->session->unset_userdata('maker_id');
        $this->session->unset_userdata('model_id');
        $this->session->unset_userdata('vehicle_maker_id_and_cat_id_pair');

        //in cart and product section sometimes this is $last_inserted_cart_block_id getting false as the timer isn't showing. to make that more confirm i did this code.
        $last_inserted_cart_block_id = getLastInsertedCartBlockId();
        if ($last_inserted_cart_block_id) {
            $current_cart_user_data = $this->comman_model->get_data_by_id('cart_block_users', array('id' => $last_inserted_cart_block_id));
        }

        $cart = $this->session->userdata('cart');
        $cart = cartCleanUp($cart);
        $this->session->set_userdata('cart', $cart);

        $userLangData = get_user_lang_data(array('general_instruction', 'selection_instruction', 'cart_instruction', 'admin_static_links', 'cart_timer', 'product_instruction'), $this->lang->default_lang_id);

        $pageData = array(
            'title'                             => get_page_title('welcome_page'),
            'productsdropdown'                  => true,
            'active'                            => 'home',
            'pageType'                          => 'home',
            'timestamp'                         => date_timestamp_get(date_create()),
            'country_data'                      => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'lang_id'                           => $this->lang->default_lang,
            'lang_num'                          => $this->lang->default_lang_id,
            'all_data'                          => $all_data,
            'all_navigation_data'               => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'front_validuser_data'              => $this->session->userdata('front_validuser_data'),
            'current_cart_user_data'            => $current_cart_user_data,
            'edit_cart_mode'                    => isset($current_cart_user_data['cartmode']) ? $current_cart_user_data['cartmode'] : '',
            'last_inserted_cart_block_id'       => $last_inserted_cart_block_id,
            'cartcount'                         => getcartcount($cart),
            'vehicle_category_ids'              => array(),
            'vehicle_categories'                => $this->comman_model->GetAllDataLang('tbl_vehicle_categories', $this->lang->default_lang_id, 'tbl_vehicle_categories_country'),
            'num_vehicle_type_for_menu'         => $this->comman_model->num_vehicle_type_for_menu(),
            'all_social_media_data'             => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
            'all_banner_images'                 => $this->comman_model->GetAllDataLangByNavIdStatus('banner_images', 'status', 1, $this->lang->default_lang_id, 'banner_images_country'),
            'whats_new'                         => $this->comman_model->GetAllDataLangByNavIdStatus('whats_new', 'status', 1, $this->lang->default_lang_id, 'whats_new_country'),
            'general_instruction'               => (object)$userLangData['general_instruction'],
            'product_instruction'               => (object)$userLangData['product_instruction'],
            'selection_instruction'             => (object)$userLangData['selection_instruction'],
            'cart_instruction'                  => (object)$userLangData['cart_instruction'],
            'cart_timer'                        => (object)$userLangData['cart_timer'],
            'admin_static_links'                => $userLangData['admin_static_links'],
            'countries'                         => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
        );

        // view files required to generate home page of the estore.
        $this->load->view('common/header', $pageData);
        $this->load->view('master/home/home', $pageData);
        $this->load->view('common/footer', $pageData);
    }

    public function gallery() {

       

        $cart = $this->session->userdata('cart');
        $cart = cartCleanUp($cart);
        $this->session->set_userdata('cart', $cart);

        $userLangData = get_user_lang_data(array('general_instruction','selection_instruction', 'cart_instruction', 'admin_static_links', 'cart_timer', 'product_instruction'), $this->lang->default_lang_id);


        $all_items = $this->gallery_model->gallery_list_home($this->lang->default_lang_id);
      
        $pageData = array(
            'title'                     => get_page_title('gallery_page'),
            'active'                    => 'page',
            'pageType'                  => 'page',
            'timestamp'                  => date_timestamp_get(date_create()),
            'countries'                 => allCountryDataArray($this->comman_model->GetAllCountryDataLangByid($this->lang->default_lang_id)),
            'country_data'              => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'lang_id'                   => $this->lang->default_lang,
            'lang_num'                  => $this->lang->default_lang_id,
            'all_data'                  => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
            'all_navigation_data'       => $this->comman_model->GetAllDataLangByNavIdStatus('navigation_pages', 'status', 1, $this->lang->default_lang_id, 'navigation_pages_country'),
            'front_validuser_data'      => $this->session->userdata('front_validuser_data'),
            'cartcount'                 => getcartcount($cart),
            'num_vehicle_type_for_menu'         => $this->comman_model->num_vehicle_type_for_menu(),
            'all_social_media_data'     => $this->comman_model->GetAllDataLangByNavIdStatus('social_media', 'status', 1, $this->lang->default_lang_id, 'social_media_country'),
            'all_items'                   => $all_items,
            'menu_instruction'          => $this->comman_model->GetAllDataLangByid("menu", 'id', '1', $this->lang->default_lang_id, 'menu_country'),
            'general_instruction'       => (object)$userLangData['general_instruction'],
            'product_instruction'       => (object)$userLangData['product_instruction'],
            'selection_instruction'     => (object)$userLangData['selection_instruction'],
            'cart_instruction'          => (object)$userLangData['cart_instruction'],
            'cart_timer'                => (object)$userLangData['cart_timer'],
            'admin_static_links'        => $userLangData['admin_static_links']
        );
      
        $this->load->view('common/header', $pageData);
        $this->load->view('master/home/gallery', $pageData);
        $this->load->view('common/footer', $pageData);
    }

}
// END index class
/* End of file index.php */
/* Location: ./application/controllers/index.php */
