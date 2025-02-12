<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Captcha Controller
 * 
 * 
 * Class to handle Cpatcha in the application. This Class is used to refresh the captcha on  request.
 *
 * @author		Kondarsoft Dev Team
 * @link		https://kondarsoft.com/
 * @filesource
 */
class Captcha extends MY_Controller
{    
    /**
     * __construct
     *
     * session library and captchs helpers are initialized in the constructor.
     * @return void
     */
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('captcha');
    }
        
    /**
     * refresh
     *
     * This is the function of the class which  refresh the captcha and save captcha code in the session.
     * @return void
     */
    public function refresh(){
        // Captcha configuration
        $config = array(
            'word'          => '',   //Generate alternate word by default. You can also set your word.
            'word_length'   => 10,  // To set length of captcha word.
            'img_path'      => './assets/uploads/captcha/',   // Create  folder "images" in root directory, and give path.
            'img_url'       => base_url() .'assets/uploads/captcha/',  // To store captcha images in "images" folder.
            'font_path'     => FCPATH.'system/fonts/texb.ttf',
            'img_width'     => 230,   //Set image width.
            'img_height'    => 50,   // Set image height.
            );
        // Function from captcha helper
        $captcha = create_captcha($config);
        
        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        
        // Display captcha image
        echo $captcha['image'];exit;
    }
}
// END Captcha class
/* End of file captcha.php */
/* Location: ./application/controllers/captcha.php */  