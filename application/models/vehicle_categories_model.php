<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Vehicle_categories_model
 *  This Model Class Handle all the query functions related to product categories.
 */
class Vehicle_categories_model extends CI_Model
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
     * Method search_vehicle_category_data
     *
     * @param $table $table [This parameter is the  name of the table.] 
     * @param $key $key [This parameter is the name of the category.]
     * @param $field1 $field1 [This parameter is the column name of the category name field.]
     * @param $per_page $per_page [This Parameter is the limit  the pagination.]
     * @param $offset $offset [This Parameter is the offset of the pagination.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function search_vehicle_category_data($table, $key, $field1, $per_page, $offset, $lang_id)
    {
        if ($key != "") {
            $this->db->like($field1, $key);
        }
        $this->db->limit($per_page, $offset);
        $query = $this->db->get($table);
        $result = $query->result_array();
        $array = array();
        foreach ($result as $res) {
            $r3 = $this->db->query("SELECT c.lang_category_name FROM tbl_vehicle_categories as t, tbl_vehicle_categories_country as c WHERE t.id=c.lang_id  AND t.id = '" . $res['id'] . "' AND c.country_id = '" . $lang_id . "' ")->row_array();
            $array[] = array_merge($res, $r3);
        }
        return $array;
    }

    /**
     * Method getLanagugeVehicleCategories
     * This Function return all categories with multilangual data as per category name passed in the parameter.
     * @param $key $key [This Parameter is the category name.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function getLanagugeVehicleCategories($key, $lang_id)
    {
        $this->db->select('tm.*,tmc.lang_category_name');
        $this->db->like('tmc.lang_category_name', $key);
        $this->db->from('tbl_vehicle_categories as tm');
        $this->db->join('tbl_vehicle_categories_country as tmc', 'tm.id = tmc.lang_id AND tmc.country_id=' . $lang_id, 'left');
        return $this->db->get()->result_array();
    }

    /**
     * Method getVehicleDataById
     * This function return data of single category with multilangual data as per category id passed in the parameter.
     * @param $table $table [This parameter is the  name of the table.] 
     * @param $id $id [This parameter is the  category id.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return array
     */
    public function getVehicleDataById($id, $lang_id)
    {
        $this->db->select('tv.*, tvc.lang_category_name');
        $this->db->where('id', $id);
        $this->db->from('tbl_vehicle_categories as tv');
        $this->db->join('tbl_vehicle_categories_country as tvc', 'tv.id = tvc.lang_id AND tvc.country_id =' . $lang_id, 'LEFT');
        return $this->db->get()->row_array();
    }

    /**
     * Method getallvehiclecategory_data
     *
     * @param $lang_id $lang_id [explicite description]
     *
     * @return void
     */
    public function getallvehiclecategory_data($lang_id)
    {
        $this->db->select('tbl_vehicle_categories.*');
        $this->db->from('tbl_vehicle_categories');
        $this->db->where('tbl_vehicle_categories.status', 1);
     //  echo $lang_id, '= $lang_id';
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();   print_r($result);
        $array = array();
        foreach ($result as $res) {
            $r3 = $this->db->query("SELECT c.lang_category_name FROM tbl_vehicle_categories as t, tbl_vehicle_categories_country as c WHERE t.id=c.lang_id  AND t.id = '" . $res['id'] . "' AND c.country_id = '" . $lang_id . "' ")->row_array();
            $array[] = array_merge($res, $r3);
        }
        return $array;
    }


    /**
     * Method getvehiclecategory_model
     *
     * @param $lang_id $lang_id [explicite description]
     *
     * @return void
     */
    public function getvehiclecategory_model($lang_id)
    {
        $this->db->select('tbl_vehicle_categories.*');
        $this->db->from('tbl_models');
        $this->db->join('tbl_vehicle_categories', 'tbl_vehicle_categories.id = tbl_models.vehicle_category_id', 'left');
        $this->db->group_by('tbl_models.vehicle_category_id');

        $query = $this->db->get();
        $result = $query->result_array();
        $array = array();
        foreach ($result as $res) {
            $r3 = $this->db->query("SELECT c.lang_category_name FROM tbl_vehicle_categories as t, tbl_vehicle_categories_country as c WHERE t.id=c.lang_id  AND t.id = '" . $res['id'] . "' AND c.country_id = '" . $lang_id . "' ")->row_array();
            $array[] = array_merge($res, $r3);
        }
        return $array;
    }


    public function get_all_categories_industries()
    {

        $this->db->select('tbl_vehicle_categories.*');
        $this->db->from('tbl_vehicle_categories');
        $this->db->group_by('tbl_vehicle_categories.industries');
        $query = $this->db->get();
        $result = $query->result_array();
        $array = array();
        foreach ($result as $res) {
            $array[] = $res['industries'];
        }
        return $array;
    }
}
