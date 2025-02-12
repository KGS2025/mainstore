<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * entry_door_front_block_data
 *  This Class handle all functions related to entry_door_front_block_data table.
 */
class entry_door_front_block_data extends CI_Model {
    
    /**
     * Method __construct
     * All models  those we need to use in the model are initialized in the constructor.
     * @return void
     */
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function checkCurrentSession($post) {
        $this->db->select('*');
        $this->db->where($post);
        $this->db->order_by('created_time', 'desc');
        $query = $this->db->get('users_front_entry_door');
        return $query->row_array();
    }

    function updateSessionEndTime($id) {
        $sessionendtime = time();
        $this->db->set('sessionendtime', $sessionendtime);
        $this->db->where('id', $id);
        $this->db->update('users_front_entry_door');
    }
    
    /**
     * Method get_block_data
     * This Function return all rows from entry_door_front_block_data table.
     * @return void
     */
    function get_block_data() {
        
        $this->db->select('*, entry_door_front_block_data.id as edfbd_id');
        $q1 = $this->db->get('entry_door_front_block_data');
        $array = $q1->result_array();

        usort($array, function($a, $b) {
            return $b['dte_block'] - $a['dte_block'];
        });

        return $array;
    }

    function get_row($table_name, $select_param, $where_param) {
        $this->db->select($select_param);
        $this->db->where($where_param);
        $result = $this->db->get($table_name);
        return $result->result();
    }

}
