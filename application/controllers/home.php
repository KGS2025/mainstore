<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Index  Controller Class
 * 
 * Class to handle home page of the estore. 
 * File not used
 * @author      Kondarsoft Dev Team
 * @link        https://kondarsoft.com/
 * @filesource
 */
class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('assets', 'cart_helper'));
        $this->load->model(array('comman_model', 'product_model', 'pages_model'));
    }
    
     public function index($url = NULL) {

        $page = allDataArray($this->comman_model->GetAllDataLangByid('pages', 'page_url', $url, $this->lang->default_lang_id, 'pages_country'));
        if($page['status'] != 1){
            show_404();
        } 

        $cart = $this->session->userdata('cart');
        $cart = cartCleanUp($cart);
        $this->session->set_userdata('cart', $cart);

        $userLangData = get_user_lang_data(array('general_instruction','selection_instruction', 'cart_instruction', 'admin_static_links', 'cart_timer', 'product_instruction'), $this->lang->default_lang_id);
      
        $pageData = array(
            'title'                     => get_page_title('welcome_page'),
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
            'all_banner_images'         => $this->comman_model->GetAllDataLangByNavIdStatus('banner_images', 'status', 1, $this->lang->default_lang_id, 'banner_images_country'),
            'whats_new'                 => $this->comman_model->GetAllDataLangByNavIdStatus('whats_new', 'status', 1, $this->lang->default_lang_id, 'whats_new_country'),
            'page_url'                  => $url,
            'content'                   => $page['content'],
            'menu_instruction'          => $this->comman_model->GetAllDataLangByid("menu", 'id', '1', $this->lang->default_lang_id, 'menu_country'),
            'general_instruction'       => (object)$userLangData['general_instruction'],
            'product_instruction'       => (object)$userLangData['product_instruction'],
            'selection_instruction'     => (object)$userLangData['selection_instruction'],
            'cart_instruction'          => (object)$userLangData['cart_instruction'],
            'cart_timer'                => (object)$userLangData['cart_timer'],
            'admin_static_links'        => $userLangData['admin_static_links']
        );
      
        $this->load->view('common/header', $pageData);
        $this->load->view('master/home/page', $pageData);
        $this->load->view('common/footer', $pageData);
    }
}
