<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Pro_model
 * This Model Class Handle all the query functions related to product models.
 */
class Pro_model extends CI_Model
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
    function record_search_count($model_name)
    {
        $this->db->select('tbl_models.*, tbl_makers.maker_name as maker_name, tbl_makers.id as maker_id');
        if ($model_name != "") {
            // if paramter is not empty than this condition execute
            $this->db->like('tbl_models.model_name', $model_name);
        }
        $this->db->from('tbl_models');
        $this->db->join('tbl_makers', 'tbl_models.maker_id = tbl_makers.id', 'left');
        $this->db->where('tbl_models.id !=', '');
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
    function get_all_model_data($key, $per_page, $offset, $lang_id)
    {
        $this->db->select('tml.*, tm.maker_name as maker_name, , tmc.lang_maker_name, tm.id as maker_id, tmlc.lang_model_name, tmlc.lang_serial_number');
        if ($key != "") {
            $this->db->like('tml.model_name', $key);
        }
        $this->db->from('tbl_models as tml');
        $this->db->join('tbl_makers as tm', 'tml.maker_id = tm.id', 'left');
        $this->db->join('tbl_makers_country as tmc', 'tm.id = tmc.lang_id AND tmc.country_id =' . $lang_id, 'left');
        $this->db->join('tbl_models_country as tmlc', 'tml.id = tmlc.lang_id AND tmlc.country_id =' . $lang_id, 'left');
        $this->db->where('tml.id !=', '');
        $this->db->limit($per_page, $offset);
        return $this->db->get()->result_array();
    }

    /**
     * Method getAllModelInfo
     *
     * @return void
     */
    function getAllModelInfo($maker_ids = array(),$category_ids = array(), $model_ids = array())
    {

        $this->db->select('tbl_models.*,tbl_makers.maker_name,tbl_vehicle_categories.category_name');

        if ($maker_ids) {
            $this->db->where_in('tbl_models.maker_id', $maker_ids);
        }
        if ($category_ids) {
            $this->db->where_in('tbl_models.vehicle_category_id', $category_ids);
        }
        if ($model_ids) {
            $this->db->where_not_in('tbl_models.id', $model_ids);
        }
        $this->db->where('tbl_models.status', 1);
        $this->db->group_by('tbl_models.model_name');
        $this->db->order_by("tbl_models.vehicle_category_id ASC, tbl_makers.id ASC");
        $this->db->from('tbl_models');
        $this->db->join('tbl_makers', 'tbl_makers.id = tbl_models.maker_id', 'left');
        $this->db->join('tbl_vehicle_categories', 'tbl_vehicle_categories.id = tbl_models.vehicle_category_id', 'left');

        $result = $this->db->get()->result_array();
        // echo $this->db->last_query();           exit;  

        return  $result;
    }


    
}
