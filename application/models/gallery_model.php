<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Package_model
 * This Model Class Handle all the query functions related to package table.
 */
class Gallery_model extends CI_Model
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
     * Method search_package_data
     * This Function return all packages from the table package as per the language id.
     * @param $table $table [This parameter is the  name of the table.] 
     * @param $key $key [This parameter is the name of the package.]
     * @param $field1 $field1 [This parameter is the column name of the package name field.]
     * @param $per_page $per_page [This Parameter is the limit  the pagination.]
     * @param $offset $offset [This Parameter is the offset of the pagination.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function search_distributor_data($table, $key, $field1, $per_page, $offset, $lang_id)
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
            $r = $this->db->query("SELECT c.lang_name FROM distributors as a, distributors_country as c WHERE a.id = c.lang_id  AND a.id = '" . $res['id'] . "' AND c.country_id = '" . $lang_id . "' ")->row_array();

            $array[] = array_merge($res, $r);
        }
        return $array;
    }

    function gallery_list_home($lang_id,$offset = 0)
    {
        $this->db->select('*');
        $this->db->from('gallery_items');
        $this->db->join('gallery_items_country', 'gallery_items.id = gallery_items_country.lang_id AND gallery_items_country.country_id =' . $lang_id, 'LEFT');
        $this->db->where('gallery_items.status', "1");
        $this->db->limit($this->config->item('pagination_limit'), $offset);
        $query = $this->db->get();
        $data =  $query->result();
        return $data;
    }

    

}
