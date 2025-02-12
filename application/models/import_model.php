<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Pro_model
 * This Model Class Handle all the query functions related to product models.
 */
class Import_model extends CI_Model
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
        $this->db->select('*');
        $this->db->from('import_requests');
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
        $this->db->select('*');
        $this->db->from('import_requests');
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
        $this->db->select('*');
        $this->db->from('credit_term_requests');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }
}
