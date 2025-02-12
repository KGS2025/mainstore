<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Ajax
 * 
 * This Class handle ajax requests for the all specified  methods in the class.
 * 
 */
class Ajax extends MY_Controller
{

    /**
     * __construct
     *
     * All helpers, models those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('comman_model', 'part_relation_model','product_model'));
        $this->load->helper(array('cart_helper', 'common_helper', 'assets_helper'));
    }

    /**
     * clear_cache
.     *
     * @return void
     */
    function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

    /**
     * getKeywordSearchData k
     * This Function return results on the behalf of characters entered in search input.
     * @return void
     */
    
    function getProductListDataResult()
    {

        $search = $this->input->post('search');
        $offset = $this->input->post('page') ?  $this->input->post('page') * $this->config->item('pagination_limit') : 0;
        // This Function return list of all product types according to parameter passed
        $type_details =  getProductList_drp($search,$offset);
        
        $total_count = getProductList_drpcount($search);
        $response = array();
    
        // this code run product type data in foreach loop and geneate html of each option
        foreach ($type_details as $key => $type) {

            $selected = '';
            
            // condition to display product type name as per default language
            $product_type_name = $type['kgt_ref_number'];

            $single_item = array("id"=> $type['id'],"text"=> ucwords($type['kgt_ref_number']));

            $items[] = $single_item;
            // Assign the response key & value to return json
           
        }
        $data['items'] = $items;
        $data['total_count']  = $total_count;
        echo json_encode($data);
        exit;
    }
     /*******Vehcile type dropddown */
    /**
     * getProductListDataResult
     * This Function return results on the behalf of characters entered in search input.
     * @return void
     */
    
     function getProductListDataResultWithAll()
     { 
        //  $currentdata = $this->input->post('currentdata');         
         $search = $this->input->post('search');
         $offset = $this->input->post('page') ?  $this->input->post('page') * 5 : 0;
         // This Function return list of all product types according to parameter passed
         $type_details =  getProductList_drp($search,$offset);
         
         $total_count = getProductList_drpcount($search);
        //  $response = array();
        
         // this code run product type data in foreach loop and geneate html of each option
         foreach ($type_details as $key => $type) {
 
            //  $selected = '';
             
             // condition to display product type name as per default language
            //  $product_type_name = $type['kgt_ref_number'];
 
             $single_item = array("id"=> $type['id'],"text"=> ucwords($type['kgt_ref_number']));
 
             $items[] = $single_item;
             // Assign the response key & value to return json
            
         }
         

         $data['items'] = $items;
         $data['total_count']  = $total_count;
         echo json_encode($data);
         exit;
     }
     function getUserListDataResultWithAll()
     {
        
        //  $currentdata = $this->input->post('currentdata');         
         $search = $this->input->post('search');
         $offset = $this->input->post('page') ?  $this->input->post('page') * 5 : 0;
         // This Function return list of all product types according to parameter passed
        //  $selected_users =  isset($currentdata) ? explode(',', $currentdata) : '';
        //  echo "<pre>";print_r($selected_users);
        // $type_details =  getProductList_drp($search,$offset);
        
        // $total_count = getProductList_drpcount($search);
        $users =  get_user_list_data($search,$offset);
        
        $total_count = get_user_list_data_count($search);
        
        
         $response = array();
        
         // this code run product type data in foreach loop and geneate html of each option
         foreach ($users as $key => $type) {
              // condition to display product type name as per default language
             $single_item = array("id"=> $type['id'],"text"=> ucwords($type['customer_no']));
 
             $items[] = $single_item;
             // Assign the response key & value to return json
            
         }
         
         
         $data['items'] = $items;
         $data['total_count']  = $total_count;
         echo json_encode($data);
         exit;
     }
      /*******Vehcile type dropddown */   
      function getRefUserListDataResultWithAll()
      {
         
          $currentdata = $this->input->post('currentdata');         
          $search = $this->input->post('search');
          $offset = $this->input->post('page') ?  $this->input->post('page') * 5 : 0;
          // This Function return list of all product types according to parameter passed
         //  $selected_users =  isset($currentdata) ? explode(',', $currentdata) : '';
         //  echo "<pre>";print_r($selected_users);
         // $type_details =  getProductList_drp($search,$offset);
         
         // $total_count = getProductList_drpcount($search);
         $users =  refferal_users($search,$offset);
         
         $total_count = refferal_users_count($search);
         
         
          $response = array();
         
          // this code run product type data in foreach loop and geneate html of each option
          foreach ($users as $key => $type) {
  
              $selected = '';
              
              // condition to display product type name as per default language
              $product_type_name = $type['refferal_no'];
  
              $single_item = array("id"=> $type['id'],"text"=> ucwords($type['refferal_no']));
  
              $items[] = $single_item;
              // Assign the response key & value to return json
             
          }
          
          
          
          $data['items'] = $items;
          $data['total_count']  = $total_count;
          echo json_encode($data);
          exit;
      }
}
