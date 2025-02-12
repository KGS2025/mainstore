<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Orders
 * This Class handle all functions related to orders. Display orders list, delete order and view order.
 */
class Pricerequests extends CI_Controller
{

    /**
     * __construct
     *
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model(array('comman_model', 'cart_model', 'product_model'));
        $this->load->helper(array('assets', 'cart_helper'));
        validateAdminLogin();
        validateUser();
    }

    /**
     * Method index
     * This Function Display All orders with pagination.
     * @return void
     */
    public function index()
    {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('price_requests');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $key = $this->security->xss_clean($this->input->post('search'));
        $offset = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $config['base_url'] = base_url() . "admin/" . $this->lang->default_lang . "/orders/index/";
        $config['total_rows'] = $this->cart_model->get_pricerequest_details('count');
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['num_links'] = 10;
        $config['first_link'] = '<< First';
        $config['last_link'] = 'Last >>';
        $config['next_link'] = 'Next ' . '&gt;';
        $config['prev_link'] = '&lt;' . ' Previous';
        $config['num_tag_open'] = '<span class="number">';
        $config['num_tag_close'] = '</span>';
        $config['cur_tag_open'] = '<span class="current"><a href="#">';
        $config['cur_tag_close'] = '</a></span>';
        $this->pagination->initialize($config);

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'admin_order_details', 'general_instruction'), $this->lang->default_lang_id);
        $userLangData = get_user_lang_data(array('general_instruction'), $this->lang->default_lang_id);

        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access' => $access,
            'login' => $this->session->all_userdata(),
            'title' => get_page_title('pricerequest', 'admin_title'),
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'price_requests',
            'addscripts' => 'cart_list',
            'primary_lang' => !empty($plang) ? $plang['short_code'] : 'en',
            'all_orders' => $this->cart_model->get_pricerequest_details('all', '', $config['per_page'], $offset),
            'links' => $this->pagination->create_links(),
            'offset' => $offset,
            'search' => $key,
            'admin_validuser_data' => $this->session->userdata('admin_validuser_data'),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_order_details' => $all_language_data['admin_order_details'],
            'admin_static_links' => $all_language_data['admin_static_links'],
            'general_instruction' => (object) $userLangData['general_instruction'],

        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/pricerequests/request_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method deleteAll
     * This Function delete all orders as ids passed in the post parameter.
     * @return void
     */
    public function deleteAll()
    {
        $access = validatePageAccess('price_requests');
        //  this function validate the access of this page for current logged admin user.
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        $data = array();
        $data['login'] = $this->session->all_userdata();

        $block_ids = $this->security->xss_clean($this->input->post('block_ids'));
        $table = $this->security->xss_clean($this->input->post('table'));
        // this function delete all orders from cart as per the ids
        $result = $this->comman_model->deleteAllById($table, $block_ids);
        echo "Successfully Delete";
        exit;
    }

    /**
     * Method delete
     * This Function  delete single order as per the order id passed in the parameter.
     * @param $id $id [This parameter is the order id.]
     *
     * @return void
     */
    public function delete($id)
    {
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('price_requests');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $this->comman_model->delete_where('price_requests', array('id' => $id));

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect('admin/pricerequests');
    }

    /**
     * Method viewOrder
     * This function display view  of single order as per id passed in the parameter.
     * @param $id $id [This parameter is the  order id.]
     *
     * @return void
     */
    public function viewrequest($id = false)
    {

        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('price_requests');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url() . 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $all_language_data = get_admin_lang_data(array('admin_static_links', 'product_instruction', 'sales_order_preview', 'admin_order_details', 'form_validation_instruction', 'general_instruction'), $this->lang->default_lang_id);
        $userLangData = get_user_lang_data(array('general_instruction'), $this->lang->default_lang_id);
        $all_messages = $this->comman_model->get_all_data_by_id('price_request_messages', array("request_id" => $id));

        $plang = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access' => $access,
            'all_messages' => $all_messages,
            'login' => $this->session->all_userdata(),
            'title' => get_page_title('pricerequest', 'admin_title'),
            'lang_id' => $this->lang->default_lang,
            'lang_num' => $this->lang->default_lang_id,
            'active' => 'price_requests',
            'addscripts' => 'list_cart_details',
            'primary_lang' => !empty($plang) ? $plang['short_code'] : 'en',
            'main_data' => $this->cart_model->get_pricerequest_details('single', $id),
            'admin_validuser_data' => $this->session->userdata('admin_validuser_data'),
            'country_data' => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_order_details' => $all_language_data['admin_order_details'],
            'admin_static_links' => $all_language_data['admin_static_links'],
            'product_instruction' => $all_language_data['product_instruction'],
            'sales_order_preview' => $all_language_data['sales_order_preview'],
            'general_instruction' => (object) $userLangData['general_instruction'],
            'form_validation_instruction' => $all_language_data['form_validation_instruction'],
            "order_id" => $id,

        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/pricerequests/request_details', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }

    /**
     * Method update_status
     * This Function update status in the table as per table name passed in the post parameter.
     * @return void
     */
    public function update_request()
    {

        if ($this->input->post('approved_products')) {
            $existing = $this->input->post('approved_products');
        } else {
            $existing = array();
        }

        if ($this->input->post('new_requested')) {
            $new_requested = $this->input->post('new_requested');
        } else {
            $new_requested = array();
        }
        $approved_products = array_unique(array_merge($existing, $new_requested));
        $approved_products_string = implode(",", $approved_products);

    
         $id = $this->security->xss_clean($this->input->post('request_id'));
        $post_data = array('status' => $this->security->xss_clean($this->input->post('status')),"products"=>$approved_products_string,"expire_date"=>$this->security->xss_clean($this->input->post('expire_date')));
        $table_name = "price_requests";
        $this->comman_model->update_data_by_id($table_name, $post_data, 'id', $id);
        $request_data = $this->comman_model->get_data_by_id($table_name, array("id" => $id));
        $user_data = $this->comman_model->get_data_by_id("users", array("id" => $request_data['user_id']));

        if ($post_data['status'] == "1") {
            $existing_product = explode(",", $user_data['approved_products']);
            $user_approved_products = implode(",",array_unique(array_merge($existing_product, $approved_products)));
            $this->comman_model->update_data_by_id("users",array("approved_products"=>$user_approved_products), 'id',$request_data['user_id']);
        } else  { 
            $existing_product = explode(",", $user_data['approved_products']);
            $final_products = array_diff($existing_product,$approved_products);
            $user_approved_products = implode(",",array_unique($final_products));
            $this->comman_model->update_data_by_id("users",array("approved_products"=>$user_approved_products), 'id',$request_data['user_id']);
        } 

        $products = $this->product_model->products_number_by_id($approved_products_string);


        // This Function load email library
        $this->load->library('Email');
        // This Function load email configuration from config file and intialize the library
        $config = $this->config->item('emailconfig');
        $this->email->initialize($config);
        // This Function get email body content subject and from address  from the table email_instruction these values are manageable from the admin side
        $email_instruction = (object)get_user_lang_data(array('email_instruction'), $this->lang->default_lang_id)['email_instruction'];
        // set variable for  email function
        $fromeMailId =  $this->config->item('fromemailaddress');
        $fromName    = $email_instruction->admin_cart_mail_fromname;
        $toEmailId   = $user_data['email'];
        $toName      = $user_data['user_name'];
        $signature   = $email_instruction->admin_cart_mail_fromname;
        $subject     = $email_instruction->price_requests_customer_subject;
        // Replace variable in the email and subject content
        $msg = htmlspecialchars_decode($email_instruction->price_requests_customer_body);
        $msg = str_replace('{name_details}', $order_details['user_name'], $msg);
        $msg = str_replace('{products}', implode(",",$products), $msg);
        $msg = str_replace('{status}', getpaymentrequeststatus($post_data['status']), $msg);
        $msg = str_replace('{signature}', $signature, $msg);
        $this->email->set_newline("\r\n");
        $this->email->from($fromeMailId, $fromName);
        $this->email->to($toEmailId);
        $this->email->set_header("To", $toName . '<' . $toEmailId . '>');
        $this->email->subject($subject);
        $this->email->message($msg);
        // This Functions send email and clear email configuration
        $this->email->send();
        //echo $this->email->print_debugger();exit;
        $this->email->clear(TRUE);

        $result['status'] = 1;
        echo json_encode($result);
        exit;

    }

    public function price_request_messages()
    {

        $request_number = $this->input->post('request_id');
        $request_message = $this->input->post('pricerequest_message');
        $session_data = $this->session->all_userdata();


        if (!empty($request_number)) {
            $price_requests_data = array();
            $price_requests_data['user_id'] = $session_data['id'];
            $price_requests_data['request_id'] = $request_number;
            $price_requests_data['user_type'] = "admin";
            $price_requests_data['message'] = $request_message;

            if ($this->comman_model->add('price_request_messages', $price_requests_data)) {

                $result['status'] = 1;
                echo json_encode($result);
                exit;
            }
        } else {

            $result['status'] = 0;
            echo json_encode($result);
            exit;

        }
    }

    public function load_price_request_messages()
    {

        $request_number = $this->input->post('request_id');
        $user_id = getFrontenduserId();

        if (!empty($request_number)) {
            $all_messages = $this->comman_model->get_all_data_by_id('price_request_messages', array("request_id" => $request_number));

            if ($all_messages) {

                $pageData['all_messages'] = $all_messages;
                $pageData['main_data'] = $this->cart_model->get_pricerequest_details('single',$request_number);

                // this is view file for product types
                $html = $this->load->view('admin/pricerequests/get_request_message', $pageData, true);

                $result['status'] = 1;
                $result['htmlbody'] = $html;

            }
        } else {

            $result['status'] = 0;
            $result['message'] = 1;

        }
        echo json_encode($result);
        exit;
    }

    

}
