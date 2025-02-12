<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Package_model
 * This Model Class Handle all the query functions related to package table.
 */
class Package_model extends CI_Model
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
    function search_package_data($table, $key, $field1, $per_page, $offset, $lang_id)
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
            $r = $this->db->query("SELECT c.lang_packagename FROM package as a, package_country as c WHERE a.id = c.lang_id  AND a.id = '" . $res['id'] . "' AND c.country_id = '" . $lang_id . "' ")->row_array();

            $array[] = array_merge($res, $r);
        }
        return $array;
    }

    /**
     * Method getPackageData
     * This Function return all packages from the table package as per the language id.
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function getPackageData($lang_id)
    {
        $this->db->select('p.*, pc.lang_packagename');
        $this->db->from('package as p');
        $this->db->join('package_country as pc', 'p.id = pc.lang_id AND pc.country_id =' . $lang_id, 'left');
        return $this->db->get()->result_array();
    }


    function onlyPackageData()
    {
        $this->db->select('*');
        $this->db->from('package');
        return $this->db->get()->result_array();
    }

    /**
     * Method getPackageData
     * This Function return all packages from the table package as per the language id.
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function getboxData()
    {
        $this->db->select('p.package_code as id,p.maxweight as max_wg,p.innerwidth as w,p.innerlength as h,p.innerdepth as d');
        $this->db->from('package as p');
        return $this->db->get()->result_array();
    }


    /**
     * Method check_validbox
     * This Function return all packages from the table package as per the language id.
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function check_validbox($packages, $height, $width, $length, $weight)
    {
        $this->db->select('*');
        $this->db->where_in("package_code", $packages);
        $this->db->where('maxweight >', $weight);
        $this->db->where('innerdepth >', $height);
        $this->db->where('innerwidth >', $width);
        $this->db->where('innerlength >', $length);
        $this->db->from('package');


        $result = $this->db->get()->result_array();

        // echo $this->db->last_query();
        // exit;
        return count($result);
    }



    /**
     * Method single_valid_box
     * This Function return all packages from the table package as per the language id.
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function single_valid_box($height, $width, $length, $weight)
    {
        $this->db->select('*');
        $this->db->where('maxweight >', $weight);
        $this->db->where('innerdepth >', $height);
        $this->db->where('innerwidth >', $width);
        $this->db->where('innerlength >', $length);
        $this->db->order_by('innerwidth', 'asc');
        $this->db->from('package');
        $result = $this->db->get()->row_array();
        return $result;
    }


     /**
     * Method ar_getPackageData
     * This Function return all packages from the table package as per the language id and condition .
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function ar_getPackageData($height, $width, $length, $weight, $lang_id=13)
    {
        $this->db->select('p.*, pc.lang_packagename');
        $this->db->from('package as p');
        $this->db->join('package_country as pc', 'p.id = pc.lang_id AND pc.country_id =' . $lang_id, 'left');
        if($height && $width && $length && $weight){
            $this->db->where('p.innerdepth >=', $height);
            $this->db->where('p.innerwidth >=', $width);
            $this->db->where('p.innerlength >=', $length);
            $this->db->where('p.maxweight >=', $weight);            
        }elseif($height && $width && $length){
            $this->db->where('p.innerdepth >=', $height);
            $this->db->where('p.innerwidth >=', $width);
            $this->db->where('p.innerlength >=', $length);
        }elseif($height && $width){
            $this->db->where('p.innerdepth >=', $height);
            $this->db->where('p.innerwidth >=', $width);
        }elseif($height){
            $this->db->where('p.innerdepth >=', $height);
        }elseif($width){
            $this->db->where('p.innerdepth >=', $width);
        }
        $query=$this->db->get();
       // echo $this->db->last_query();
        return $query->result_array();
    }
}
