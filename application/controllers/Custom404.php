<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Custom404 Controller
 * 
 * 
 * Class to handle custom 404 page. This class is used to just display custom 404 page.
 *
 * @author		Kondarsoft Dev Team
 * @link		https://kondarsoft.com/
 * @filesource
 */
class Custom404 extends MY_Controller {
  
  /**
   * __construct
   *
   * Url helper is initialized in the constructor.
   * @return void
   */
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model(array('comman_model'));
  }
  
  /**
   * index
   *
   * This Function Display 404 page with custom design.
   * @return void
   */
  public function index(){
    //This Function set http headers for 404.
    $this->output->set_status_header('404'); 
    // initialize data as Array to assign all required values for view files.
    $pageData = array(
     'all_data'                   => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
      'general_instruction'       => (object)get_user_lang_data(array('general_instruction'), $this->lang->default_lang_id)['general_instruction']
    );

    // This function load view file for 404 page
    $this->load->view('elements/error404',$pageData);
  }

}
// END Custom404 class
/* End of file Custom404.php */
/* Location: ./application/controllers/Custom404.php */  