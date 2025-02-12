<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Users_front_entry_door_model
 * This Class handle all functions related to users_front_entry_door table.
 */
class Users_front_entry_door_model extends CI_Model {
    
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
     * Method get_row_in_array
     * This Function return all rows of  users_front_entry_door with pagination.
     * @param $key $key [This parameter is the value to search.]
     * @param $per_page $per_page [This parameter is the per  page limit for the  pagination data. ]
     * @param $offset $offset [This parameter is the   offset number for the  pagination data.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function get_row_in_array($key,$per_page,$offset,$lang_id) {
        $data = array();
        $this->db->select('*');
        if ($key != "") {
            $this->db->like('applicant', $key);
            $this->db->or_like('country', $key);
            $this->db->or_like('telephone', $key);
            $this->db->or_like('email', $key);
        }
        $this->db->from('users_front_entry_door');
        $this->db->limit($per_page,$offset);
        $query = $this->db->get();
        return $query->result_array();
    }
}
