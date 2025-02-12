<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Industry_model
 * This Model Class Handle all the query functions related to industries table.
 */
class Industry_model extends CI_Model
{

    /**
     * Method __construct
     * All models  those we need to use in the model are initialized in the constructor.
     * @return void
     */
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * Method search_industry_data
     * This Function return all insdutries from the table industry as per the language id.
     * @param $table $table [This parameter is the  name of the table.] 
     * @param $key $key [This parameter is the name of the industry.]
     * @param $field1 $field1 [This parameter is the column name of the industry name field.]
     * @param $per_page $per_page [This Parameter is the limit  the pagination.]
     * @param $offset $offset [This Parameter is the offset of the pagination.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function search_industry_data($table, $key, $field1, $per_page, $offset, $lang_id)
    {
        $this->db->select('*');
        $this->db->from($table);
        if ($key != "") {
            $this->db->like($field1, $key);
        }
        $this->db->limit($per_page, $offset);
        $query = $this->db->get();
        $result = $query->result_array();

        $array = array();
        foreach ($result as $res) {
            $r = $this->db->query("SELECT c.lang_name FROM ".$table." as a, ".$table."_country as c WHERE a.id = c.lang_id  AND a.id = '" . $res['id'] . "' AND c.country_id = '" . $lang_id . "' ")->row_array();
            $array[] = array_merge($res, $r);
        }
        return $array;
    }

     /**
     * Method getIndustryData
     * This Function return all getIndustryData from the table industries as per the language id.
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function getIndustryData($lang_id)
    {
        $this->db->select('p.*, pc.lang_name');
        $this->db->from('industries as p');
        $this->db->join('industries_country as pc', 'p.id = pc.lang_id AND pc.country_id =' . $lang_id, 'left');
        return $this->db->get()->result_array();
    }

}
