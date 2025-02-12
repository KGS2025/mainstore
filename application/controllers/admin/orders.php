<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Orders
 * This Class handle all functions related to orders. Display orders list, delete order and view order.
 */
class Orders extends CI_Controller {
    
    /**
     * __construct
     *
     * All helpers, models and libraries those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model(array('comman_model', 'cart_model','api_model'));
        $this->load->helper(array('assets','cart_helper','api_helper'));
        validateAdminLogin();
        validateUser();
    }
    
    /**
     * Method index
     * This Function Display All orders with pagination.
     * @return void
     */
    function index() {
        
        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('cart');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $key    = $this->security->xss_clean($this->input->post('search'));
        $offset = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $config['base_url']     = base_url() . "admin/" . $this->lang->default_lang . "/orders/index/";
        $config['total_rows']   = $this->cart_model->get_cart_details('count');
        $config['per_page']     = 10;
        $config['uri_segment']  = 5;
        $config['num_links']    = 10;
        $config['first_link']   = '<< First';
        $config['last_link']    = 'Last >>';
        $config['next_link']    = 'Next ' . '&gt;';
        $config['prev_link']    = '&lt;' . ' Previous';
        $config['num_tag_open'] = '<span class="number">';
        $config['num_tag_close']= '</span>';
        $config['cur_tag_open'] = '<span class="current"><a href="#">';
        $config['cur_tag_close']= '</a></span>';
        $this->pagination->initialize($config);

        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_order_details'), $this->lang->default_lang_id);
        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('order_details', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'cart',
            'addscripts'            => 'cart_list',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'all_data'              => $this->cart_model->get_cart_details('all','',$config['per_page'],$offset),
            'links'                 => $this->pagination->create_links(),
            'offset'                => $offset,
            'search'                => $key,
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_order_details'   => $all_language_data['admin_order_details'],
            'admin_static_links'    => $all_language_data['admin_static_links']
        );


        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/orders/orders_list', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
    
    /**
     * Method deleteAll
     * This Function delete all orders as ids passed in the post parameter.
     * @return void
     */
    function deleteAll() {
        $access = validatePageAccess('cart');
        //  this function validate the access of this page for current logged admin user.
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }
        $data = array();
        $data['login'] = $this->session->all_userdata();

        $block_ids = $this->security->xss_clean($this->input->post('block_ids'));
        $table = $this->security->xss_clean($this->input->post('table'));
        // this function delete all orders from cart as per the ids 
        $result = $this->comman_model->deleteAllById($table, $block_ids);
        $this->comman_model->deleteAllById('cart', $block_ids, 'user_id');
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
    function delete($id) {
        //  this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('cart');
        if ($access['page_delete'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $this->comman_model->delete_where('cart_users', array('id' => $id));
        $this->comman_model->delete_where('cart', array('user_id' => $id));

        $admin_static_links = get_user_lang_data(array('admin_static_links'), $this->lang->default_lang_id, 'data_successfully_deleted')['admin_static_links'];
        // this function set success message in flash to display on frontend.
        $this->session->set_flashdata('success', $admin_static_links['data_successfully_deleted']);

        redirect('admin/orders');
    }
    
    /**
     * Method viewOrder
     * This function display view  of single order as per id passed in the parameter.
     * @param $id $id [This parameter is the  order id.]
     *
     * @return void
     */
    function viewOrder($id = false, $order_number = false) {
        
        check_lang_admin();

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('cart');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            redirect(base_url(). 'admin/' . $this->lang->default_lang . '/noaccess');
        }

        $all_language_data  = get_admin_lang_data(array('admin_static_links','product_instruction','sales_order_preview', 'admin_order_details','form_validation_instruction','aramex_error'), $this->lang->default_lang_id);
        

        $plang      = $this->comman_model->getPrimaryLang();

        // initialize data as Array to assign all required values for view files.
        $pageData = array(
            'access'                => $access,
            'login'                 => $this->session->all_userdata(),
            'title'                 => get_page_title('order_details', 'admin_title'),
            'lang_id'               => $this->lang->default_lang,
            'lang_num'              => $this->lang->default_lang_id,
            'active'                => 'cart',
            'addscripts'            => 'list_cart_details',
            'primary_lang'          => !empty($plang) ? $plang['short_code'] : 'en', 
            'all_data'              => $this->cart_model->get_cart_order_data_by_invoice_id($order_number),
            'main_data'             => $this->cart_model->get_cart_details('single',$id),
            'cart_package_data'     => $this->cart_model->get_cart_package_databyid($id),
            'order_payments'     => $this->cart_model->get_order_payments($id),
            'admin_validuser_data'  => $this->session->userdata('admin_validuser_data'),
            'country_data'          => $this->comman_model->get_row_array('country', '*', array('status' => 1)),
            'admin_order_details'   => $all_language_data['admin_order_details'],
            'admin_static_links'    => $all_language_data['admin_static_links'],
            'product_instruction'   => $all_language_data['product_instruction'],
            'sales_order_preview'   => $all_language_data['sales_order_preview'],
            'form_validation_instruction'   => $all_language_data['form_validation_instruction'],
            "aramex_error"          => $all_language_data['aramex_error'],
            "order_id"=>$id

        );

        $this->load->view('admin/common/header', $pageData);
        $this->load->view('admin/common/left_menu', $pageData);
        $this->load->view('admin/orders/order_details', $pageData);
        $this->load->view('admin/common/footer', $pageData);
    }
     /**
     * Method cancelShipment
     * This Function update status of tracking_number in the table as per table name passed in the parameter.
     * @return void
     */
    function cancelShipment($tracking_number = null,$id= null, $order_number =null)
    {
        check_lang_admin();
        $this->load->library('FedexShipping');
        $apisetting = array();        
        $apisetting = $this->cart_model->get_fedex_api_settings();     

        // Set variable values to generate UPs shipping label using API call       
        $this->fedexshipping->addField('client_id', trim($apisetting['client_id']));
        $this->fedexshipping->addField('client_secret', trim($apisetting['client_secret']));
        $this->fedexshipping->addField('accountNumber', trim($apisetting['accountNumber']));
        $this->fedexshipping->addField('shipper_companyName', trim($apisetting['shipper_companyName']));
        $this->fedexshipping->addField('shipper_personName', trim($apisetting['shipper_personName']));
        $this->fedexshipping->addField('shipper_addressline1', trim($apisetting['shipper_addressline1']));
        $this->fedexshipping->addField('shipper_addressline2', trim($apisetting['shipper_addressline2']));
        $this->fedexshipping->addField('shipper_phoneNumber', trim($apisetting['shipper_phoneNumber']));
        $this->fedexshipping->addField('shipper_city', trim($apisetting['shipper_city']));
        $this->fedexshipping->addField('shipper_stateprovincecode', trim($apisetting['shipper_stateprovincecode']));
        $this->fedexshipping->addField('shipper_postalcode', trim($apisetting['shipper_postalcode']));
        $this->fedexshipping->addField('shipper_countrycode', trim($apisetting['shipper_countrycode']));

        // this function validate the access of this page for current logged admin user.
        $access = validatePageAccess('cart');
        if ($access['page_access'] != 1) {
            // if current loggedin admin user does not have access of this section than this function redirect user to no access page.
            return null;
        }        
        
        $return_response = $this->fedexshipping->cancelShipment($tracking_number);        
        //print_r($return_response['fedex_response']->message);
        if($return_response['status']=='success' && $return_response['fedex_response']->cancelledShipment==true){
            $this->db->where(array('tracking_number'=>$tracking_number,'cart_user_id'=>$id));
            $result =$this->db->update('cart_packages',array('cancel_status'=>1));
        }else{
            $result = $return_response['fedex_response']->message;
        }        
        echo $result;
    }

     /**
     * Method cancelShipment
     * This Function update status of tracking_number in the table as per table name passed in the parameter.
     * @return void
     */
    function cancelAramexShipment($tracking_number = null,$id= null, $order_number =null)
    {
        check_lang_admin();
        $aramex_language_data  = get_admin_lang_data(array('aramex_error'), $this->lang->default_lang_id);
        $apisetting = $this->api_model->get_aramex_api_details();    
        $return_response = cancelShippmentForAramex($tracking_number,$apisetting);        
        
        if($return_response->HasErrors !='1' && $return_response->ProcessedShipmentHolds->ProcessedShipmentHold->ID==$tracking_number){
            $this->db->where(array('tracking_number'=>$tracking_number,'cart_user_id'=>$id));
            $result =$this->db->update('cart_packages',array('cancel_status'=>1));
        }else{
            $err_code = $return_response->ProcessedShipmentHolds->ProcessedShipmentHold->Notifications->Notification->Code;
            $err_msg = $return_response->ProcessedShipmentHolds->ProcessedShipmentHold->Notifications->Notification->Message;
            $lang_msg = $aramex_language_data['aramex_error'][$err_code]['front'];
            $result = $err_code.": ".($lang_msg?$lang_msg:$err_msg);
        }        
        echo $result;
    }

      /**
     * Method update_status
     * This Function update status in the table as per table name passed in the post parameter.
     * @return void
     */
    function update_status()
    {
        $post_data = array('order_status' => $this->security->xss_clean($this->input->post('status')));

        $post_status = $this->security->xss_clean($this->input->post('status'));
        if($post_status == "2") {
            $payment_status ="1";
        } else {
            $payment_status =$post_status;

        }
        $id = $this->security->xss_clean($this->input->post('id'));
        $table_name = "cart_users";
        $this->comman_model->update_data_by_id($table_name,$post_data,'id',$id);
        $this->comman_model->update_data_by_id("payments", array('status'=>$payment_status),'order_id',$id);

        $order_details = $this->comman_model->get_data_by_id("cart_users", array("id" => $id));


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
            $toEmailId   = $order_details['email'];
            $toName      = $order_details['user_name'];
            $signature   = $email_instruction->admin_cart_mail_fromname;
            $subject     = $email_instruction->order_status_subject;
            // Replace variable in the email and subject content
            $msg = htmlspecialchars_decode($email_instruction->order_status_change);
            $msg = str_replace('{name_details}', $order_details['user_name'], $msg);
            $msg = str_replace('{ORDER_NO}', $order_details['order_number'], $msg);
            $msg = str_replace('{status}', getOrderStatus($order_details['order_status']), $msg);
            $msg = str_replace('{AMOUNT}', $order_details['amount'] . " " . strtoupper($order_details['currency']), $msg);
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

        
    }


     /**
     * Method update_status
     * This Function update status in the table as per table name passed in the post parameter.
     * @return void
     */
    function generate_link()
    {
        $post_data = array('request_payment_type' => $this->security->xss_clean($this->input->post('payment_type')),'request_percentage'=> $this->security->xss_clean($this->input->post('request_percentage')));
        $id = $this->security->xss_clean($this->input->post('order_id'));
        $order_data = $this->cart_model->get_cart_details('single',$id);
        $main_data =  $order_data[0];
        $quotation = $this->comman_model->get_data_by_id("quotations", array("order_id" => $id));
        $table_name = "quotations";
        $this->comman_model->update_data_by_id($table_name,$post_data,'order_id',$id);
        $url =  base_url().$this->lang->default_lang."/user/quotation_pay/".$quotation['id'];
        $result = array("status"=>1,"url"=>$url);

        if(!empty($id)) {

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
            $toEmailId   = $main_data->email;
            $toName      = $main_data->user_name;
            $signature   = $email_instruction->admin_cart_mail_fromname;
            $subject     = $email_instruction->partial_email_subject;

            // Replace variable in the email and subject content
            $msg = htmlspecialchars_decode($email_instruction->order_payment_link_email);
            $msg = str_replace('{name_details}', $main_data->user_name, $msg);
            $msg = str_replace('{payment_link}', $url, $msg);
            $msg = str_replace('{optstanding}', $main_data->amount_pending, $msg);
            $msg = str_replace('{ordernumber}', $main_data->order_number, $msg);
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


        }
        echo json_encode($result);
        exit;
    }

}

