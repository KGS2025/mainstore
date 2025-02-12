<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Pages_model
 * This Class handle all functions related to pages table.
 */
class Pages_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    /**
     * Method get_search_key_data
     * This Function return data from tables as per parameter passed.
     * @param $table $table [This parameter is the name of the table.]
     * @param $key $key [This parameter is the column value for the table.]
     * @param $field1 $field1 [This parameter is the column name for the table.]
     * @param $per_page $per_page [This parameter is the per page for pagination.]
     * @param $offset $offset [This parameter is the offset for pagination.]
     * @param $lang_id $lang_id [This parameter is the langage id.]
     *
     * @return void
     */
    function get_search_key_data($table, $key, $field1, $per_page, $offset, $lang_id) {
        $this->db->select('*');
        $this->db->from($table);
        if ($key != "") {
            $this->db->like($field1, $key);
        }
        $this->db->limit($per_page, $offset);
        $query = $this->db->get();
        $result = $query->result_array();
        
        $array = array();
        foreach($result as $res) {  
           $r = $this->db->query("SELECT c.* FROM ".$table." as a, ".$table."_country as c WHERE a.id = c.lang_id  AND a.id = '" . $res['id']."' AND c.country_id = '" . $lang_id."' ")->row_array();
           
           $array[] = array_merge($res, $r);
        }
        return $array;
    }
    
    /**
     * Method deleteSelectedWithImage
     * This function delete rows and their related images as per ids and column name passed in the function.
     * @param $table $table [This parameter is the table name.]
     * @param $selectField $selectField [This parameter is the column name.]
     * @param $selectedIds $selectedIds [This parameter is the ids of row.]
     *
     * @return void
     */
    function deleteSelectedWithImage($table, $selectField, $selectedIds) {
        $this->db->select($selectField);
        $this->db->where_in('id', $selectedIds);
        $results = $this->db->get($table)->result_array();
        if(count($results) > 0){
            $folderName = $table;
            if($table == 'payment_accept_card'){
                $folderName = 'payment_card_icon';
            }
            foreach ($results as $result) {
                unlink("assets/uploads/".$folderName."/".$result[$selectField]);
            }
        }
        $this->db->where_in('id', $selectedIds);
        $this->db->delete($table);
        return TRUE;
    }
    
    /**
     * Method deleteAllWithImage
     * This function delete all rows and their related images as per table  name passed in the function.
     * @param $table $table [This parameter is the table name.]
     *
     * @return void
     */
    function deleteAllWithImage($table) {
        $folder_path = "assets/uploads/".$table."/"; 
        $files = glob($folder_path.'/*');  
        foreach($files as $file) { 
            if(is_file($file))  
              unlink($file);  
        } 
        $this->db->empty_table($table);
    }
}