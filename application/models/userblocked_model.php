<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Userblocked_model
 * This Model Class Handle all the query functions related to table  user_blocked .
 */
class Userblocked_model extends CI_Model {
    
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
     * Method search_user_blocked_data
     *
    * @param $table $table [This parameter is the  name of the table.] 
     * @param $key $key [This parameter is the email.]
     * @param $field1 $field1 [This parameter is the column name of the email field.]
     * @param $per_page $per_page [This Parameter is the limit  the pagination.]
     * @param $offset $offset [This Parameter is the offset of the pagination.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function search_user_blocked_data($key, $per_page, $offset) {
        $this->db->select('*');
        $this->db->from('user_blocked');
        if ($key != "") {
            $this->db->like('email', $key);
        }
        $this->db->limit($per_page, $offset);
        return $this->db->get()->result_array();
    }
    
    /**
     * Method checkBlockedUser
     * This function check is email and phone exist in the user_blocked table or not.
     * @param $post $post [This parameter is the post array.]
     *
     * @return void
     */
    function checkBlockedUser($post) {
        $this->db->where('email', $post['email']);
        $this->db->where('country_code', $post['country_code']);
        $this->db->where('telephone', $post['telephone']);
        $query = $this->db->get('user_blocked');
        return $query->row();
    }

}