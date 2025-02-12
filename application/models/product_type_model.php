<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Product_type_model
 * This Model Class Handle all the query functions related to product types.
 */
class Product_type_model extends CI_Model {

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
     * Method search_producttype_data
     *
     * @param $table $table [This parameter is the  name of the table.] 
     * @param $key $key [This parameter is the name of the product type.]
     * @param $field1 $field1 [This parameter is the column name of the product type field.]
     * @param $per_page $per_page [This Parameter is the limit  the pagination.]
     * @param $offset $offset [This Parameter is the offset of the pagination.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function search_producttype_data($key, $per_page, $offset, $lang_id) {
        $this->db->select('pt.*, ptc.lang_product_type_name');
        if ($key != "") {
            $this->db->like('pt.product_type_name',$key);
        }
        $this->db->from('tbl_product_types as pt');
        $this->db->join('tbl_product_types_country as ptc','pt.id = ptc.lang_id AND ptc.country_id ='.$lang_id,'left');
        $this->db->limit($per_page, $offset);
        return $this->db->get()->result_array();
    }
    
    /**
     * Method getLanagugeProductTypes
     * This Function return all product types with multilangual data as per product type name passed in the parameter.
     * @param $key $key [This parameter is the name of the product type.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function getLanagugeProductTypes($key, $lang_id) {
        $this->db->select('pt.*, ptc.lang_product_type_name');
        if ($key != "") {
            $this->db->like('ptc.lang_product_type_name',$key);
        }
        $this->db->from('tbl_product_types as pt');
        $this->db->join('tbl_product_types_country as ptc','pt.id = ptc.lang_id AND ptc.country_id ='.$lang_id,'left');
        return $this->db->get()->result_array();
    }
    
    /**
     * Method getProductTypeById
     * This function return data of single product type with multilangual data as per product type id passed in the parameter.
     * @param $table $table [This parameter is the  name of the table.] 
     * @param $id $id [This parameter is the  product type  id.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return array
     */
    public function getProductTypeById($table, $id, $lang_id) {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        $res = $query->row_array();
        $array = array();
        $r3 = $this->db->query("SELECT c.lang_product_type_name FROM tbl_product_types as t, tbl_product_types_country as c WHERE t.id=c.lang_id  AND t.id = '" . $res['id'] . "' AND c.country_id = '" . $lang_id . "' ")->row_array();
        $array = array_merge($res, $r3);
        return $array;
    }

}