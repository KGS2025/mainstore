<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Product_items_model
 * This Class handle all functions related to tbl_product_items table.
 */
class Product_items_model extends CI_Model
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
     * Method search_product_item_data
     * T
     * @param $key $key [This parameter is the name of the product item.]
     * @param $per_page $per_page [This Parameter is the limit  the pagination.]
     * @param $offset $offset [This Parameter is the offset of the pagination.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function search_product_item_data($key, $per_page, $offset, $lang_id)
    {
        $this->db->select('tpi.*, tpic.lang_item_name');
        $this->db->from('tbl_product_items as tpi');
        if ($key != "") {
            $this->db->like('tpi.item_name', $key);
        }
        $this->db->join('tbl_product_items_country as tpic', 'tpi.id = tpic.lang_id AND tpic.country_id =' . $lang_id, 'LEFT');
        $this->db->limit($per_page, $offset);
        return $this->db->get()->result_array();
    }

    /**
     * Method getproductitems_data
     * This function return data of single product item with multilangual data as per product item id passed in the parameter.
     * @param $table $table [This parameter is the  name of the table.] 
     * @param $item_type $item_type [This parameter is the item_type.]
     *
     * @return array
     */
    function getproductitems_data($item_type = 'product_group', $lang_id = '')
    {
        $lang_id = $lang_id ? $lang_id : $this->lang->default_lang_id;
        $this->db->select('pi.*, pic.lang_item_name');
        $this->db->where('pi.item_type', $item_type);
        $this->db->from('tbl_product_items as pi');
        $this->db->join('tbl_product_items_country as pic', 'pi.id = pic.lang_id AND pic.country_id = ' . $lang_id, 'LEFT');
        return $this->db->get()->result_array();
    }


    /**
     * Method getallproductitems
     * This function return data of single product item with multilangual data as per product item id passed in the parameter.
     *
     * @return array
     */
    function getallproductitems()
    {
        $this->db->select('pi.*, pic.lang_item_name');
        $this->db->from('tbl_product_items as pi');
        $this->db->join('tbl_product_items_country as pic', 'pi.id = pic.lang_id AND pic.country_id = ' . $this->lang->default_lang_id, 'LEFT');
        $this->db->order_by('pi.item_type', 'DESC');

        // SELECT pi.*, pic.lang_item_name
        // FROM tbl_product_items AS pi
        // LEFT JOIN tbl_product_items_country AS pic
        // ON pi.id = pic.lang_id AND pic.country_id = 13
        // ORDER BY pi.item_type DESC

        return $this->db->get()->result_array();
    }

    /**
     * Method getProductItemValueById 
     * OLD METHOD AS OF 1609201 ¬ DEVS.AO
     *
     * @param $table $table [explicite description]
     * @param $lang_id $lang_id [explicite description]
     * @param $field $field [explicite description]
     * @param $value $value [explicite description]
     *
     * @return void
     */
    function getProductItemValueById($table, $lang_id, $field, $value)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field, $value);
        $query = $this->db->get();
        $result = $query->result_array();
        $array = array();
        foreach ($result as $res) {
            // echo "<pre>";
            //     print_r($res);
            // exit;

                $r2 = $this->db->query("SELECT PI.id, PI.value, PIC.lang_id, PIC.country_id, PIC.lang_value FROM product_attributes PI LEFT JOIN product_attributes_country PIC ON PI.id = PIC.lang_id AND PIC.country_id = '" . $lang_id . "' WHERE `id` = '" . $res['id'] . "' AND product_id = '" . $res['product_id'] . "' AND item_id = '" . $res['item_id'] . "' GROUP BY value ")->result_array();
                $res['dropdown'] = array_reverse($r2);
            


            $array[] = array_merge($res);
        }
        return $array;
    }
    /**
     * Method getProductItemValueById 
     * OLD METHOD AS OF 1609201 ¬ DEVS.AO
     *
     * @param $table $table [explicite description]
     * @param $lang_id $lang_id [explicite description]
     * @param $field $field [explicite description]
     * @param $value $value [explicite description]
     *
     * @return void
     */
    function getProductItemValueBymodel_attr($table, $lang_id, $field, $value)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field, $value);
        $this->db->where("product_item_id", 1);
        $query = $this->db->get();
        $result = $query->result_array();
        $array = array();
        foreach ($result as $res) {
            $arrayd = array();
            if ($res['value'] == 'dropdown') {
                $r2 = $this->db->query("SELECT * FROM tbl_product_item_relation_dropdown picd LEFT JOIN tbl_product_item_relation_dropdown_country pic ON picd.id = pic.lang_id AND pic.country_id = '" . $lang_id . "' WHERE `product_item_relation_id` = '" . $res['id'] . "' AND product_id = '" . $res['product_id'] . "' AND product_item_id = '" . $res['product_item_id'] . "' ")->result_array();


                $res['dropdown'] = $r2;
            }
            $r3 = $this->db->query("SELECT c.lang_value FROM tbl_product_item_relation as t, tbl_product_item_relation_country as c WHERE c.lang_id=" . $res['id'] . "  AND t.id = '" . $res['id'] . "' AND c.country_id = '" . $lang_id . "' ")->row_array();


            $array[] = array_merge($res, $r3);
        };
        return $array;
    }

    /**
     * Method getProductItemmodels 
     * NEW METHOD AS OF UPDATED STRUCTURE 1609201 ¬ DEVS.AO
     *
     * @param $table $table [explicite description]
     * @param $lang_id $lang_id [explicite description]
     * @param $field $field [explicite description]
     * @param $value $value [explicite description]
     *
     * @return void
     */
    function getProductItemmodels($table, $lang_id, $field, $value)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field, $value);
        $this->db->where("product_item_id", 1);
        $query = $this->db->get();
        $result = $query->result_array();
        $array = array();
        foreach ($result as $res) {
            $arrayd = array();
            if ($res['value'] == 'dropdown') {
                $r2 = $this->db->query("SELECT id,value  FROM tbl_product_item_relation_dropdown WHERE product_item_relation_id = '" . $res['id'] . "' AND product_id = '" . $res['product_id'] . "' AND product_item_id = '" . $res['product_item_id'] . "' GROUP BY value")->result_array();
                $res['dropdown'] = array_reverse($r2);
            }
            $r3 = $this->db->query("SELECT c.lang_value FROM tbl_product_item_relation as t, tbl_product_item_relation_country as c WHERE c.lang_id=" . $res['id'] . "  AND t.id = '" . $res['id'] . "' AND c.country_id = '" . $lang_id . "' ")->row_array();


            $array[] = array_merge($res, $r3);
        };
        return $array;
    }


    function product_items($product_id, $lang_id)
    {

        $this->db->query("SET SESSION group_concat_max_len =  1000000;");
        $this->db->select('product_attributes.item_id,tbl_product_items.field_type,tbl_product_items.item_name,tbl_product_items.item_text_size,tbl_product_items.item_text_color,tbl_product_items_country.lang_item_name,group_concat(product_attributes.value) as value,group_concat(product_attributes_country.lang_value) as lang_value');
        $this->db->from('product_attributes');
        $this->db->join('tbl_product_items', 'tbl_product_items.id = product_attributes.item_id');
        $this->db->join('product_attributes_country', 'product_attributes_country.lang_id =product_attributes.id  AND product_attributes_country.country_id =' . $lang_id, 'left');
        $this->db->join('tbl_product_items_country', 'tbl_product_items_country.lang_id =tbl_product_items.id  AND tbl_product_items_country.country_id =' . $lang_id, 'left');
        $this->db->where('product_attributes.status', "1");
        $this->db->where('product_attributes.product_id',$product_id);
        $this->db->where('tbl_product_items.item_type', "product_group");
        $this->db->group_by('product_attributes.item_id');
        $query = $this->db->get();
        return $query->result_array();
    }


    function product_maker_with_attributes($product_id, $lang_id)
    {

        $this->db->select('product_items.model_id,product_items.item_id,tbl_product_items.field_type,tbl_product_items.item_name,tbl_product_items.item_text_size,tbl_product_items.item_text_color,tbl_product_items_country.lang_item_name,product_items.value as value,product_items_country.lang_value as  lang_value,product_items.value as value,product_items_country.lang_value as  lang_value,product_items.engine_size,product_items_country.lang_engine_size,product_items.position,product_items_country.lang_position,product_items_country.lang_engine_size,product_items.position,product_items.vehicle_attributes,product_items_country.lang_vehicle_attributes,product_items.application_notes,product_items_country.lang_application_notes');
        $this->db->from('product_items');
        $this->db->join('tbl_product_items', 'tbl_product_items.id = product_items.item_id');
        $this->db->join('product_items_country', 'product_items_country.lang_id =product_items.id  AND product_items_country.country_id =' . $lang_id, 'left');
        $this->db->join('tbl_product_items_country', 'tbl_product_items_country.lang_id =tbl_product_items.id  AND tbl_product_items_country.country_id =' . $lang_id, 'left');
        $this->db->where('product_items.status', "1");
        $this->db->where('product_items.product_id',$product_id);
        $this->db->where('tbl_product_items.item_type', "product_model");
        $query = $this->db->get();
        return $query->result_array();
    }

    function product_model_maker_with_attributes($product_id, $model_id, $lang_id)
    {

        $this->db->select('product_items.model_id,product_items.item_id,product_items.value as value,product_items_country.lang_value as  lang_value,product_items.value as value,product_items_country.lang_value as  lang_value,product_items.engine_size,product_items_country.lang_engine_size,product_items.position,product_items_country.lang_position,product_items_country.lang_engine_size,product_items.position,product_items.vehicle_attributes,product_items_country.lang_vehicle_attributes,product_items.application_notes,product_items_country.lang_application_notes');
        $this->db->from('product_items');
        $this->db->join('product_items_country', 'product_items_country.lang_id =product_items.id  AND product_items_country.country_id =' . $lang_id, 'left');
        $this->db->where('product_items.status', "1");
        $this->db->where('product_items.item_id', 1);
        $this->db->where('product_items.product_id',$product_id);
        $this->db->where('product_items.model_id',$model_id);
        $this->db->group_by('product_items.value');
        $query = $this->db->get();
        return $query->result_array();
    }



    
}
