<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Pro_model
 * This Model Class Handle all the query functions related to product models.
 */
class Creditterm_model extends CI_Model
{

    /**
     * __construct
     *
     *  All models  those we need to use in the model are initialized in the constructor.
     * @return void
     */
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * Method record_search_count
     * This Function return number of rows from the tbl_models table as per the model name.
     * @param $key $key [This Parameter is the name of the model for search in the table.]
     *
     * @return void
     */
    function record_count()
    {
        $this->db->select('credit_term_requests.*,users.*');
        $this->db->from('credit_term_requests');
        $this->db->join('users', 'credit_term_requests.user_id = users.id', 'left');
        $query = $this->db->get();
        // this function return count of rows
        return $query->num_rows();
    }

    /**
     * Method get_all_model_data
     * This Function return all models from the table tbl_models as per the offset,language id and model name. 
     * @param $table $table [This paramter is the table name.]
     * @param $key $key [This Parameter is the model name.]
     * @param $per_page $per_page [This Parameter is the limit  the pagination.]
     * @param $offset $offset [This Parameter is the offset of the pagination.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function get_all_requests($per_page, $offset)
    {
        $this->db->select('credit_term_requests.*,users.salutation,users.surname,users.company,users.email,users.telephone,users.country');
        $this->db->from('credit_term_requests');
        $this->db->join('users', 'credit_term_requests.user_id = users.id', 'left');
        $this->db->limit($per_page, $offset);
        return $this->db->get()->result();
    }

    /**
     * Method getSingle
     *
     * @return void
     */
    function getSingle($id)
    {
        $this->db->select('credit_term_requests.*,users.salutation,users.surname,users.company,users.email,users.telephone,users.country');
        $this->db->from('credit_term_requests');
        $this->db->join('users', 'credit_term_requests.user_id = users.id', 'left');
        $this->db->where('credit_term_requests.id', $id);
        return $this->db->get()->row_array();
    }
}
