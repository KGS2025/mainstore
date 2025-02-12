<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Tax_rate_model
 * This Class handle all functions related to tax_rate table.
 */
class Tax_rate_model extends CI_Model {
    
    /**
     * __construct
     *
     *  All models  those we need to use in the model are initialized in the constructor.
     * @return void
     */
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * Method search_tax_rate_data
     * This Function return all rows as per the key value , offset and pagination in the parameter.
     * @param $key $key [This parameter is the value to search.]
     * @param $per_page $per_page [This parameter is the limit the data to fetch from table.]
     * @param $offset $offset [This parameter is the start the data from table to search.]
     *
     * @return void
     */
    function search_tax_rate_data($key, $per_page, $offset) {
        $this->db->select('*');
        $this->db->from('tax_rate');
        if ($key != "") {
            // this code match key parameter value with three columns of table  tax_rate
            $this->db->like('tax_base_rate', $key);
            $this->db->or_like('state_code', $key);
            $this->db->or_like('zip', $key);
        }
        $this->db->limit($per_page, $offset);
        return $this->db->get()->result_array();
    }
}