<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Product_natures_model
 * This Class handle all functions related to tbl_product_natures table.
 */
class Product_natures_model extends CI_Model {

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
     * Method search_product_nature_data
     *
     * @param $table $table [This parameter is the  name of the table.] 
     * @param $key $key [This parameter is the name of the product nature.]
     * @param $field1 $field1 [This parameter is the column name of the product nature name field.]
     * @param $per_page $per_page [This Parameter is the limit  the pagination.]
     * @param $offset $offset [This Parameter is the offset of the pagination.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function search_product_nature_data($key, $per_page, $offset, $lang_id) {
        $this->db->select('pn.*, pnc.lang_name');
        if ($key != "") {
            $this->db->like('pn.name',$key);
        }
        $this->db->from('tbl_product_natures as pn');
        $this->db->join('tbl_product_natures_country as pnc','pn.id = pnc.lang_id AND pnc.country_id ='.$lang_id,'left');
        $this->db->limit($per_page, $offset);
        return $this->db->get()->result_array();
    }
        
    /**
     * Method getproductnatures_data
     * This function return all  product natures rows with multilangual data.
     * @param $table $table  [This parameter is the  name of the table.] 
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function getproductnatures_data($lang_id) {
        $this->db->select('pn.*, pnc.lang_name');
        $this->db->from('tbl_product_natures as pn');
        $this->db->join('tbl_product_natures_country as pnc','pn.id = pnc.lang_id AND pnc.country_id ='.$lang_id,'left');
        return $this->db->get()->result_array();
    }
}