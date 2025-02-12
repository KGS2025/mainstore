<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Contact_user_model
 * This Model Class Handle all the query functions related to table contact_form .
 */
class Contact_user_model extends CI_Model {
    
    /**
     * Method __construct
     * All models  those we need to use in the model are initialized in the constructor.
     * @return void
     */
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    /**
     * Method search_contact_user_data
     *
    * @param $table $table [This parameter is the  name of the table.] 
     * @param $key $key [This parameter is the email.]
     * @param $per_page $per_page [This Parameter is the limit  the pagination.]
     * @param $offset $offset [This Parameter is the offset of the pagination.]
     *
     * @return void
     */
    function search_contact_user_data($key, $per_page, $offset) {
        $this->db->select('*');
        $this->db->from('contact_form');

        if ($key != "") {
            $this->db->like('email', $key);
            $this->db->or_like('name', $key);
            $this->db->or_like('contact', $key);
            $this->db->or_like('country', $key);
        }
        $this->db->where('block',0);
        $this->db->order_by("contact_form.id", 'DESC');

        $this->db->limit($per_page, $offset);
        return $this->db->get()->result_array();
    }


    function record_search_count($key="") {
        $this->db->select('*');
        $this->db->from('contact_form');

        if ($key != "") {
            $this->db->like('email', $key);
            $this->db->or_like('name', $key);
            $this->db->or_like('contact', $key);
            $this->db->or_like('country', $key);
        }
        $this->db->where('block',0);
        $query = $this->db->get();
        // this function return count of rows
        return $query->num_rows();
    }

}