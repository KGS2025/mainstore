<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Adminuser_model
 * This Model Class Handle all the query functions related to admin_users table.
 */
class Adminuser_model extends CI_Model {
    
    /**
     * Method __construct
     * All models  those we need to use in the model are initialized in the constructor.
     * @return void
     */
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Method search_admin_user_data
     * This Function return all admin_users as per the key and offset.
     * @param $key $key [This parameter is the key to search.]
     * @param $per_page $per_page [This Parameter is the limit  the pagination.]
     * @param $offset $offset [This Parameter is the offset of the pagination.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function search_admin_user_data($key, $per_page, $offset, $lang_id) {
        $this->db->select('au.*, ar.role, arc.lang_role');
        if ($key != "") {
            $this->db->like('au.email', $key);
            $this->db->or_like('au.telephone', $key);
        }
        $this->db->from('admin_users as au');
        $this->db->join('admin_roles as ar', 'au.role_id = ar.id');
        $this->db->join('admin_roles_country as arc', 'ar.id = arc.lang_id AND arc.country_id ='.$lang_id, 'LEFT');
        $this->db->limit($per_page, $offset);
        return $this->db->get()->result_array();
    }
    
    /**
     * Method validateUserEntryDoor
     * This Functon return row from the table as per user data array values passed in the paramter.
     * @param $data $data [This parameter is the array of user data.]
     *
     * @return void
     */
    public function validateUserEntryDoor($data) {
        //$query = $this->db->query("SELECT * FROM admin_users WHERE LOWER(title) = '" . strtolower($data['title']) . "' AND LOWER(first_name) = '" . strtolower($data['first_name']) . "' AND LOWER(last_name) = '" . strtolower($data['last_name']) . "' AND LOWER(email) = '" . strtolower($data['email']) . "' AND country_code = '" . $data['country_code'] . "' AND telephone = '" . $data['telephone'] . "'");
        $query = $this->db->query("SELECT * FROM admin_users WHERE LOWER(email) = '" . strtolower($data['email']) . "' AND country_code = '" . $data['country_code'] . "' AND telephone = '" . $data['telephone'] . "'");
        return $query->row_array();
    }
    
    /**
     * Method validateCorrectUserData
     * This Function return error code related to different -2 conditions from admin_users. 
     * @param $data $data [This parameter is the array of user data.]
     *
     * @return void
     */
    public function validateCorrectUserData($data) {
        $userdata = array();
        $q1 = $this->db->query("SELECT * FROM admin_users WHERE LOWER(email) = '" . strtolower($data['email']) . "' AND country_code = '" . $data['country_code'] . "' AND telephone = '" . $data['telephone'] . "'");
        $r1 = $q1->row_array();
        
        if (!empty($r1)) {
            $q2 = $this->db->query("SELECT title FROM admin_users WHERE LOWER(title) = '" . strtolower($data['title']) . "' AND LOWER(email) = '" . strtolower($data['email']) . "' AND country_code = '" . $data['country_code'] . "' AND telephone = '" . $data['telephone'] . "'");
            $r2 = $q2->row_array();
            
            $q3 = $this->db->query("SELECT first_name FROM admin_users WHERE LOWER(first_name) = '" . strtolower($data['first_name']) . "' AND LOWER(email) = '" . strtolower($data['email']) . "' AND country_code = '" . $data['country_code'] . "' AND telephone = '" . $data['telephone'] . "'");
            $r3 = $q3->row_array();
            
            $q4 = $this->db->query("SELECT last_name FROM admin_users WHERE LOWER(last_name) = '" . strtolower($data['last_name']) . "' AND LOWER(email) = '" . strtolower($data['email']) . "' AND country_code = '" . $data['country_code'] . "' AND telephone = '" . $data['telephone'] . "'");
            $r4 = $q4->row_array();
            
            if(empty($r2) && empty($r3) && empty($r4)) {
                $userdata['error'] = 'title-firstname-lastname';
            } else if(empty($r2) && empty($r3) && !empty($r4)) {
                $userdata['error'] = 'title-firstname';
            } else if(empty($r2) && empty($r4) && !empty($r3)) {
                $userdata['error'] = 'title-lastname';
            } else if(empty($r3) && empty($r4) && !empty($r2)) {
                $userdata['error'] = 'firstname-lastname';
            } else if(empty($r2) && !empty($r3) && !empty($r4)) {
                $userdata['error'] = 'title';
            } else if(empty($r3) && !empty($r2) && !empty($r4)) {
                $userdata['error'] = 'firstname';
            } else if(empty($r4) && !empty($r2) && !empty($r3)) {
                $userdata['error'] = 'lastname';
            } else {
                return true;
            }           
        } else {
            $q5 = $this->db->query("SELECT email FROM admin_users WHERE LOWER(email) = '" . strtolower($data['email']) . "'");
            $r5 = $q5->row_array();
            
            $q6 = $this->db->query("SELECT telephone FROM admin_users WHERE country_code = '" . $data['country_code'] . "' AND telephone = '" . $data['telephone'] . "'");
            $r6 = $q6->row_array();
            
                
            if(empty($r5) && empty($r6)) {
                $userdata['error'] = 'country-email-telephone';
            } else if(empty($r1)) {
                $userdata['error'] = 'country-email-telephone';
            }  else if(empty($r5) && !empty($r6)) {
                $userdata['error'] = 'email';
            } else if(empty($r6) && !empty($r5)) {
                $userdata['error'] = 'country-telephone';
            } else {
                return true;
            }  
        }
        return $userdata;
    }
}