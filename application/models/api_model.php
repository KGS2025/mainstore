<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Api_model
 *  This Class handle all functions related to api used in the system. Following tables are used ups_api_setting,aramex_api_setting etc.
 */
class Api_model extends CI_Model {
    
    /**
     * Method __construct
     * All models  those we need to use in the model are initialized in the constructor.
     * @return void
     */
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Method get_ups_api_details
     * This Function return all records from ups_api_setting table.
     * @return void
     */
    function get_ups_api_details() {
        $this->db->select('*');
        $this->db->from('ups_api_setting');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }


      /**
     * Method get_fedex_api_details
     * This Function return all records from fedex_settings table.
     * @return void
     */
    function get_fedex_api_details() {
        $this->db->select('*');
        $this->db->from('fedex_settings');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
     
          /**
     * Method get_freightcom_api_details
     * This Function return all records from fedex_settings table.
     * @return void
     */
    function get_freightcom_api_details() {
        $this->db->select('*');
        $this->db->from('freightcom_settings');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
     /**
      * Method get_aramex_api_details
      * This Function return all records from ups_api_setting table.
      * @return void
      */
     function get_aramex_api_details() {
        $this->db->select('*');
        $this->db->from('aramex_api_setting');
        return $this->db->get()->row_array();
    }

    /**
     * Method get_payment_api_details
     * This Function return all records from payment_api_setting table.
     * @return void
     */
    function get_payment_api_details($table) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * Method get_shipping_api_details
     * This Function return all records from shipping_api_settings table.
     * @return void
     */
    function get_shipping_api_details(){
        return $this->db->get('shipping_api_settings')->result_array();
    }
}
