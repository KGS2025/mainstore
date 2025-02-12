<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Product_maker_model
 * This Model Class Handle all the query functions related to product makers.
 */
class Product_maker_model extends CI_Model
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
     * Method search_maker_data
     *
     * @param $key $key  [This Parameter is the maker name.]
     * @param $per_page $per_page  [This Parameter is the limit  the pagination.]
     * @param $offset $offset [This Parameter is the offset of the pagination.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function search_maker_data($key, $per_page, $offset, $lang_id)
    {
        $this->db->select('tm.*, tmc.lang_maker_name');
        $this->db->from('tbl_makers as tm');
        if ($key != "") {
            $this->db->like('tm.maker_name', $key);
        }
        $this->db->join('tbl_makers_country as tmc', 'tm.id = tmc.lang_id AND tmc.country_id =' . $lang_id, 'LEFT');
        $this->db->limit($per_page, $offset);
        $results = $this->db->get()->result_array();
        if (count($results) > 0) {
            foreach ($results as $key => $res) {
                if ($res['vehicle_category_id']) {
                    $this->db->select('group_concat(tv.category_name) as category_name, group_concat(tvc.lang_category_name) as lang_category_name');
                    $this->db->where_in('tv.id', explode(',', $res['vehicle_category_id']));
                    $this->db->from('tbl_vehicle_categories as tv');
                    $this->db->join('tbl_vehicle_categories_country as tvc', 'tv.id = tvc.lang_id AND tvc.country_id =' . $lang_id, 'LEFT');
                    $nameList = $this->db->get()->row_array();
                    $results[$key] = array_merge($res, $nameList);
                }
            }
        }
        return $results;
    }

    /**
     * Method getAllMakerInfo
     *
     * @return void
     */
    function getAllMakerInfo($categoryIds, $maker_ids = array())
    {

        if (!is_array($categoryIds)) {
            $categoryIds = explode(",", $categoryIds);
        }
        if ($categoryIds) {

            if (count($categoryIds) > 0) {
                $where_array = array();
                foreach ($categoryIds as $categoryId) {
                    if ($categoryId)
                        $where_array[] = "(FIND_IN_SET('" . $categoryId . "', vehicle_category_id))";
                }
                if ($where_array) {
                    $this->db->where('(' . implode(" OR ", $where_array) . ')');
                }
            }
        }


        if (!empty($maker_ids)) {
            $this->db->where_not_in('id', $maker_ids);
        }
        $this->db->where('status', 1);
        $this->db->group_by('maker_name');
        $query = $this->db->get('tbl_makers');
        // echo $this->db->last_query();     
        return $query->result_array();
    }


    /**
     * Method getAllMakerInfo
     *
     * @return void
     */
    function getMakerhasmodel($categoryIds, $maker_ids = array())
    {


        $this->db->select('tbl_makers.*');
        $this->db->from('tbl_models');

        if (!is_array($categoryIds)) {
            $categoryIds = explode(",", $categoryIds);
        }

        if (!is_array($maker_ids)) {
            $maker_ids = explode(",", $maker_ids);
        }


        $this->db->join('tbl_makers', 'tbl_makers.id = tbl_models.maker_id', 'left');
        if ($categoryIds) {
            $this->db->where_in('tbl_models.vehicle_category_id', $categoryIds);
        }
        if (!empty($maker_ids)) {
            $this->db->where_not_in('tbl_models.maker_id', $maker_ids);
        }
        $this->db->where('tbl_makers.status', 1);
        $this->db->group_by('tbl_makers.id');
        $query = $this->db->get();
        // echo $this->db->last_query();     
        return $query->result_array();
    }

    /**
     * Method getMakerName
     *
     * @return void
     */
    function getMakerName($makerIds = '')
    {
        if ($makerIds) {
            $this->db->where_in('id', explode(',', $makerIds));
        }
        $this->db->where('status', 1);
        $this->db->group_by('maker_name');
        $results = $this->db->get('tbl_makers')->result();
        $nameList = array();
        if (count($results) > 0) {
            foreach ($results as $key => $value) {
                $nameList[$value->id] = $value->maker_name;
            }
        }
        return $nameList;
    }

    /**
     * Method getProductMakers
     *
     * @return void
     */
    function getProductMakers()
    {
        $this->db->select('tbl_makers.*, tbl_vehicle_categories.category_name as category_name, tbl_vehicle_categories.id as cat_id');
        $this->db->from('tbl_makers');
        $this->db->where('tbl_makers.status',1);
        $this->db->join('tbl_vehicle_categories', 'tbl_makers.vehicle_category_id = tbl_vehicle_categories.id');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
}
