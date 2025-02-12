<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * comman_model
 * This class handle common functions which can be used for any table. By passing the the table name we can utilize the function
 * anywhere in the system.
 */
class comman_model extends CI_Model
{

    /**
     * Method __construct
     *All models  those we need to use in the model are initialized in the constructor.
     * @return void
     */
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function table_count($table,$where_param)
    {
        $this->db->select('count(*) as total');
        $this->db->where($where_param);
        $this->db->from($table);
        $row_total = $this->db->get()->row_array();
        return $row_total['total'];
    }

    /**
     * Method add
     * This Function add new  row in the table and return id of inserted row.
     * @param $table $table [This parameter is the  name of the table.] 
     * @param $array $array [This parameter is the  array of row data.] 
     *
     * @return void
     */
    function add($table, $array)
    {
        $query = $this->db->insert($table, $array);
        return $this->db->insert_id();
    }

    /**
     * Method all_data
     * This Function return all rows of table.
     * @param $table_Name $table_Name [This parameter is the  name of the table.] 
     *
     * @return void
     */
    function all_data($table_Name)
    {
        $query = $this->db->get($table_Name);
        return $query->result_array();
    }

    /**
     * Method delete_where
     * This Function delete row from a table using conditional array.
     * @param $table $table [This parameter is the  name of the table.] 
     * @param $where $where [This parameter is the  array of conditions.] 
     *
     * @return void
     */
    function delete_where($table, $where)
    {
        $this->db->delete($table, $where);
        return TRUE;
    }

    /**
     * Method insert_column
     * This function insert data of table as per the passed parameter.
     * @param $table_name $table_name [This parameter is the  name of the table.] 
     * @param $data $data [This parameter is the  row data array  to update.]
     *
     * @return void
     */
    function insert_column($table_name, $data)
    {
        $this->db->insert($table_name, $data);
        return $this->db->insert_id();
    }

    /**
     * Method update_column
     * This function update columns of table as per the passed parameter.
     * @param $table_name $table_name [This parameter is the  name of the table.] 
     * @param $where $where [This parameter is the  array of conditions.]
     * @param $data $data [This parameter is the  row data array  to update.]
     *
     * @return void
     */
    function update_column($table_name, $where_param, $data)
    {
        $this->db->where($where_param);
        return $this->db->update($table_name, $data);
    }

    /**
     * Method delete_row
     * This function delete columns of table as per the passed parameter.
     * @param $table_name $table_name [This parameter is the  name of the table.] 
     * @param $where $where [This parameter is the  array of conditions.]
     *
     * @return void
     */
    function delete_row($table_name, $where_param)
    {
        $this->db->where($where_param);
        return $this->db->delete($table_name);
    }

    /**
     * Method get_row
     * This Function return single row from the table using select and where condition paramter.
     * @param $table_name $table_name [This parameter is the  name of the table.] 
     * @param $select_param $select_param [This parameter is the  column name to select from table.]
     * @param $where $where [This parameter is the  array of conditions.]
     *
     * @return void
     */
    function get_row($table_name, $select_param, $where_param)
    {
        $this->db->select($select_param);
        $this->db->where($where_param);
        $result = $this->db->get($table_name);
        return $result->result();
    }

    /**
     * Method get_row_array
     * This Function return single row in the array form from the table using select and where condition paramter.
     * @param $table_name $table_name [This parameter is the  name of the table.] 
     * @param $select_param $select_param [This parameter is the  column name to select from table.]
     * @param $where $where [This parameter is the  array of conditions.]
     *
     * @return void
     */
    function get_row_array($table_name, $select_param = '*', $where_param = array(), $limit = 0)
    {
        if ($table_name) {
            $this->db->select($select_param);
            $this->db->where($where_param);
            if ($limit > 0) {
                $this->db->limit($limit);
            }
            $result = $this->db->get($table_name);
            return $result->result_array();
        } else {
            return array();
        }
    }




    /**
     * Method deleteAllById
     * This Function delete all rows as per the parameter passed/
     * @param $table $table [This parameter is the  name of the table.] 
     * @param $array $array [This parameter is the  array of column values.] 
     * @param $field $field [This parameter is the  name  of column in table.]
     *
     * @return void
     */
    function deleteAllById($table, $array, $field = 'id')
    {
        $this->db->where_in($field, $array);
        $this->db->delete($table);
        return TRUE;
    }

    /**
     * Method getAllById
     * Not used
     * @param $table $table [This parameter is the  name of the table.]
     * @param $array $array [explicite description]
     * @param $fields $fields [explicite description]
     * @param $where_fields $where_fields [explicite description]
     *
     * @return void
     */

    function getAllById($table, $array, $fields = null, $where_fields = 'id')
    {
        if ($fields) {
            $table_field = '';
            foreach ($fields as $field) {
                $table_field .= $field . ', ';
            }
            $this->db->select($table_field);
        }
        $this->db->where_in($where_fields, $array);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    /**
     * Method update_where
     * @param $table_Name $table_Name [This parameter is the  name of the table.] 
     * @param $updatedata $updatedata [This parameter is the  array of row data .]
     * @param $wherearray $wherearray [This parameter is the  array of conditions.] 
     *
     * @return void
     */
    function update_where($table_Name, $updatedata, $wherearray)
    {
        $this->db->where($wherearray);
        $this->db->update($table_Name, $updatedata);
        return $this->db->affected_rows();
    }

    /**
     * Method update_data_by_id
     * @param $table_Name $table_Name [This parameter is the  name of the table.] 
     * @param $updatequery $updatequery [This parameter is the  array of row data .]
     * @param $field_name $field_name [This parameter is the  name  of field.] 
     * @param $field_name $field_name [This parameter is the  value  of column.] 
     *
     * @return void
     */
    function update_data_by_id($table_Name, $updatequery, $field_name, $value)
    {
        $this->db->where($field_name, $value);
        $this->db->update($table_Name, $updatequery);
        return $this->db->affected_rows();
    }

    /**
     * Method get_data_by_id
     * This Function return single row of table using conditional array.
     * @param $tablename $tablename [This parameter is the  name of the table.] 
     * @param $condition $condition [This parameter is the  array of conditions.] 
     *
     * @return void
     */
    function get_data_by_id($tablename, $condition)
    {
        $query = $this->db->get_where($tablename, $condition);
        return $query->row_array();
    }




    /**
     * Method get_all_data_by_id
     * This Function return all rows of table using conditional array.
     * @param $table $table [This parameter is the  name of the table.]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    function get_all_data_by_id($table_name, $condition)
    {   
        $query = $this->db->get_where($table_name, $condition);
        return $query->result_array();
    }


    /**
     * Method get_all_data_by_id_order_desc
     * This Function return all rows of table using conditional array.
     * @param $table $table [This parameter is the  name of the table.]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    function get_all_data_by_id_desc($table_name, $condition)
    {
        $this->db->order_by('id','DESC');
        $query = $this->db->get_where($table_name, $condition);
        return $query->result_array();
    }


    /**
     * Method get_all_data_by_select
     * This Function return all rows of table using conditional array.
     * @param $table $table [This parameter is the  name of the table.]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    function get_all_data_by_select($select, $table_name, $condition)
    {
        $this->db->select($select);
        $query = $this->db->get_where($table_name, $condition);
        return $query->result_array();
    }


    /**
     * Method get_all_data_by_limit
     * This Function return all rows of table using conditional array.
     * @param $table $table [This parameter is the  name of the table.]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    function get_all_data_by_limit($table_name, $condition)
    {
        $this->db->select("*");
        //$this->db->limit(20);
        $query = $this->db->get_where($table_name, $condition);
        return $query->result_array();
    }

    function get_table_data_by_limit($table_name, $condition,$limit=20)
    {
        $this->db->select("*");
        $this->db->limit($limit);
        $query = $this->db->get_where($table_name, $condition);
        return $query->result_array();
    }

    /**
     * Method delete_all_data
     *
     * @param $table $table [This parameter is the  name of the table.]
     *
     * @return void
     */
    function delete_all_data($table)
    {
        $this->db->empty_table($table);
    }

    function get_breadcrumbProductName($id){
        $this->db->select('part_name');
        $this->db->from('products');        
        $this->db->where('kgt_ref_number', $id);        
        $results = $this->db->get()->result();
        if(count($results)>0){
            $results = $results[0];
            $results = $results->part_name;
        }
        return $results;
    }

    function get_breadcrumbcategorydetailsbyid($vehicle_category_ids = array(), $country_id = 13)
    {
        $this->db->select('tbl_vehicle_categories.*, tbl_vehicle_categories_country.*');
        $this->db->from('tbl_vehicle_categories');
        $this->db->join('tbl_vehicle_categories_country', 'tbl_vehicle_categories_country.lang_id = tbl_vehicle_categories.id and tbl_vehicle_categories_country.country_id=' . $country_id, 'left');
        if (count($vehicle_category_ids) > 0) {
            $this->db->where_in('tbl_vehicle_categories.id', $vehicle_category_ids);
        }
        $results = $this->db->get()->result();
        $results = updateLanguageParameters($results);
        $aBreadcrumb = array();
        if (count($results) > 0) {

            $noImage = getNoImage('no_image');

            foreach ($results as $key => $result) {
                $breadcrumb = '';
                if ($result->vehicle_category_icon != '' && file_exists("assets/uploads/vehicle_categories/" . $result->vehicle_category_icon)) {
                    //$breadcrumb .= '&nbsp;&nbsp;<img alt="Kondar Global" src="' . $this->session->userdata('default_image') . '" data-img="' . asset_url() . 'assets/uploads/vehicle_categories/' . $result->vehicle_category_icon . '" width="35">';
                } else {
                    //$breadcrumb .= '&nbsp;&nbsp;<img alt="Kondar Global" src="' . $this->session->userdata('default_image') . '" data-img="' . $noImage . '" width="35">';
                }

                $breadcrumb .= '' . $result->category_name . '';

                $aBreadcrumb[$result->id] = $breadcrumb;
            }
        }
        return $aBreadcrumb;
    }

    function get_breadcrumbmakerdetailsbyidformodelpage($maker_id = array(), $country_id = '13')
    {
        $this->db->select('tbl_makers.*, tbl_makers_country.lang_maker_name');
        $this->db->from('tbl_makers as tbl_makers');
        $this->db->join('tbl_makers_country as tbl_makers_country', 'tbl_makers.id=tbl_makers_country.lang_id and tbl_makers_country.country_id=' . $country_id, 'left');
        if (count($maker_id) > 0) {
            $this->db->where_in('tbl_makers.id', $maker_id);
        }
        $results = $this->db->get()->result();
        $results = updateLanguageParameters($results);

        $aBreadcrumb = array();
        if (count($results) > 0) {

            $noImage = getNoImage('no_image');

            foreach ($results as $key => $result) {
                $breadcrumb = '';
                if ($result->maker_logo != '' && file_exists("assets/uploads/product_maker/" . $result->maker_logo)) {
                    //$breadcrumb .= '&nbsp;&nbsp;<img alt="Kondar Global" src="' . $this->session->userdata('default_image') . '" data-img="' . asset_url() . 'assets/uploads/product_maker/' . $result->maker_logo . '" width="35">';
                } else {
                    //$breadcrumb .= '&nbsp;&nbsp;<img alt="Kondar Global" src="' . $this->session->userdata('default_image') . '" data-img="' . $noImage . '" width="35">';
                }
                $breadcrumb .= '' . $result->maker_name . '';

                $aBreadcrumb[$result->id] = $breadcrumb;
            }
        }
        return $aBreadcrumb;
    }

    function get_breadcrumbmakerdetailsbyidforitempage($modal_id = array(), $country_id = 13)
    {
        $this->db->select('tbl_models.*, tbl_models_country.lang_model_name');
        $this->db->from('tbl_models as tbl_models');
        $this->db->join('tbl_models_country as tbl_models_country', 'tbl_models.id=tbl_models_country.lang_id and tbl_models_country.country_id=' . $country_id, 'left');
        if (count($modal_id) > 0) {
            $this->db->where_in('tbl_models.id', $modal_id);
        }
        $results = $this->db->get()->result();
        $results = updateLanguageParameters($results);
        $aBreadcrumb = array();
        if (count($results) > 0) {

            $noImage = getNoImage('no_image');

            foreach ($results as $key => $result) {
                $breadcrumb = '';
                if ($result->model_photo != '' && file_exists("assets/uploads/product_model/" . $result->model_photo)) {
                    //$breadcrumb .= '&nbsp;&nbsp;<img alt="Kondar Global" src="' . $this->session->userdata('default_image') . '" data-img="' . asset_url() . 'assets/uploads/product_model/' . $result->model_photo . '" width="35">';
                } else {
                    //$breadcrumb .= '&nbsp;&nbsp;<img alt="Kondar Global" src="' . $this->session->userdata('default_image') . '" data-img="' . $noImage . '" width="35">';
                }
                $breadcrumb .= '' . $result->model_name . '';

                $aBreadcrumb[$result->id] = $breadcrumb;
            }
        }
        return $aBreadcrumb;
    }

    /**
     * Method get_breadcrumbmakerdetailsbyid
     *
     * @param $product_maker_id $product_maker_id [explicite description]
     *
     * @return void
     */
    function get_breadcrumbmakerdetailsbyid($product_maker_id)
    {
        $this->db->where('id', $product_maker_id);
        $query = $this->db->get('tbl_makers');
        $result = $query->row();
        $breadcrumb = '&nbsp;&nbsp;' . $result->maker_name . '';
        return $breadcrumb;
    }

    /**
     * Method get_breadcrumbmodeldetailsbyid
     *
     * @param $product_model_id $product_model_id [explicite description]
     *
     * @return void
     */
    function get_breadcrumbmodeldetailsbyid($product_model_id)
    {
        $this->db->where('id', $product_model_id);
        $query = $this->db->get('tbl_models');
        $result = $query->row();
        $breadcrumb = '&nbsp;&nbsp;' . $result->model_name . '';
        return $breadcrumb;
    }

    /**
     * Method get_vehicle_categories
     *
     * @param $product_type $product_type [explicite description]
     * @param $offset $offset [explicite description]
     * @param $country_id $country_id [explicite description]
     *
     * @return void
     */
    function get_vehicle_categories($product_type, $offset = 0, $country_id = 0)
    {
        $this->db->select('tbl_vehicle_categories.*,tbl_vehicule_categories_country.*');
        $this->db->from('tbl_product_types');
        $this->db->join('tbl_vehicle_categories', 'tbl_product_types.vehicle_category_id = tbl_vehicle_categories.id');
        $this->db->join('tbl_vehicle_categories_country', 'tbl_vehicle_categories_country.lang_id = tbl_vehicle_categories.id and tbl_vehicle_categories_country.country_id=' . $country_id, 'left');
        $this->db->where('tbl_product_types.product_type_name', $product_type);
        $this->db->limit($this->config->item('pagination_limit'), $offset);

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Method get_vehicle_type_details_by_name
     *
     * @param $product_type $product_type [explicite description]
     *
     * @return void
     */
    function get_vehicle_type_details_by_name($product_type)
    {
        $query = $this->db->get_where('tbl_product_types', array('product_type_name' => $product_type));
        return $query->result();
    }

    /**
     * Method get_product_type_for_menu
     *
     * @param $offset $offset [explicite description]
     *
     * @return void
     */
    function get_product_type_for_menu($offset = 0)
    {
        $this->db->select('PT.*,tbl_product_types_country.lang_product_type_name');
        $this->db->where('PT.status', 1);
        $this->db->from('tbl_product_types as PT');
        $this->db->join('tbl_product_types_country', 'PT.id = tbl_product_types_country.lang_id AND tbl_product_types_country.country_id =' . $this->lang->default_lang_id, 'left');
        $this->db->order_by("PT.Product_Type_Photo", "DESC");
        $this->db->limit($this->config->item('pagination_limit'), $offset);
        $result = $this->db->get()->result_array();
        return $result;
    }

    /**
     * Method num_product_type_for_menu
     *
     * @return void
     */
    function num_product_type_for_menu()
    {
        $this->db->select('count(*) as total');
        $this->db->where('P.status', 1);
        $this->db->from('tbl_product_types as P');
        $row_total = $this->db->get()->row_array();
        return $row_total['total'];
    }

    function product_types_all($producTypeIds)
    {
        $this->db->select('tbl_product_types.*,tbl_product_types_country.*');
        if (!empty($producTypeIds)) {
            $this->db->where_in('tbl_product_types.id', $producTypeIds);
        }
        $this->db->where('tbl_product_types.status', 1);
        $this->db->from('tbl_product_types');
        $this->db->join('tbl_product_types_country', 'tbl_product_types.id = tbl_product_types_country.lang_id AND tbl_product_types_country.country_id =' . $this->lang->default_lang_id, 'left');

        $this->db->order_by('tbl_product_types.product_type_name', 'ASC');
        $productTypeList = $this->db->get()->result_array();
    //    echo $this->db->last_query();die;
    // echo "<pre>";print_r($productTypeList);die;
        return $productTypeList;
    }

    /**
     * Method product_types_all_count
     *
     * @return void
     */
    function product_types_all_count($producTypeIds)
    {
        $this->db->select('count(*) as total');
        if (!empty($producTypeIds)) {
            $this->db->where_in('P.id', $producTypeIds);
        }
        $this->db->where('P.status', 1);
        $this->db->from('tbl_product_types as P');
        $row_total = $this->db->get()->row_array();
        return $row_total['total'];
    }



    /**
     * Method get_tabledata_by_id 
     * This Function return data from table using id and where.
     * @param $table $table [This parameter is the  name of the table.]
     * @param $id $id [This parameter is the  id of the row in the table.]
     * @param $where $where [This parameter is the where field name.]
     *
     * @return void
     */
    function get_tabledata_by_id($table, $id, $where)
    {
        $this->db->where('id', $id);
        $this->db->where($where, 1);
        $result = $this->db->get($table);
        return $result->result_array();
    }

    /**
     * Method delete_block_email_list_by_id
     * This function delete rows from block_email_list table  as per the email passed in the parameter.
     * @param $email $email [This parameter is the email.]
     *
     * @return void
     */
    function delete_block_email_list_by_id($email)
    {
        $this->db->where('str_email', $email);
        $this->db->delete('block_email_list');
        return $this->db->affected_rows();
    }

    function get_vehicle_type_for_menu($offset = 0, $categoryIds = '', $producTypeIds = '',$search="")
    {
 
       
        $this->db->select('tbl_vehicle_categories.*,industries.name,industries_country.lang_name,tbl_vehicle_categories_country.lang_category_name');
        $this->db->join('tbl_vehicle_categories_country', 'tbl_vehicle_categories.id = tbl_vehicle_categories_country.lang_id AND tbl_vehicle_categories_country.country_id =' . $this->lang->default_lang_id, 'left');
        $this->db->join('industries', 'industries.id = tbl_vehicle_categories.industries', 'LEFT');
        $this->db->join('industries_country', 'industries.id = industries_country.lang_id AND industries_country.country_id =' . $this->lang->default_lang_id, 'left');

        if(!empty($categoryIds)) {

         $this->db->where_in('tbl_vehicle_categories.id', $categoryIds);
        }

 
        if(!empty($producTypeIds)) {
            $this->db->join('model_groups', 'model_groups.category_id = tbl_vehicle_categories.id', 'LEFT');
            $this->db->where_in('model_groups.product_type_id', $producTypeIds);
        }

        if($search != '') {
            $this->db->like('tbl_vehicle_categories.category_name', $search , 'both'); 
            }
       
        $this->db->where('tbl_vehicle_categories.status', 1);
        $this->db->where('tbl_vehicle_categories.status', 1);
        $this->db->order_by('tbl_vehicle_categories.VehicleType_Photo', 'DESC');
        $this->db->group_by('tbl_vehicle_categories.id');
        $this->db->limit($this->config->item('pagination_limit'), $offset);
        $result = $this->db->get('tbl_vehicle_categories')->result_array();
        return $result;
    }

    function num_vehicle_type_for_menu($categoryIds = '', $producTypeIds = '',$search="")
    {

            if(!empty($categoryIds)) {

                $this->db->where_in('tbl_vehicle_categories.id', $categoryIds);
            }

            if(!empty($producTypeIds)) {
                $this->db->join('model_groups', 'model_groups.category_id = tbl_vehicle_categories.id', 'LEFT');
                $this->db->where_in('model_groups.product_type_id', $producTypeIds);
            }

            if($search != '') {
            $this->db->like('tbl_vehicle_categories.category_name', $search , 'both'); 
            }


            $this->db->where('tbl_vehicle_categories.status', 1);
            $this->db->group_by('tbl_vehicle_categories.id');

            $num_rows = $this->db->get('tbl_vehicle_categories')->num_rows();
            return $num_rows;
    }




    function get_vehicle_type_for_ind($offset = 0, $industry = array())
    {
        $categoryList = array();

        if(!empty($industry)) {
            $this->db->select('tbl_vehicle_categories.*,industries.name,industries_country.lang_name,tbl_vehicle_categories_country.lang_category_name');
            $this->db->join('industries', 'industries.id = tbl_vehicle_categories.industries', 'LEFT');
            $this->db->join('industries_country', 'industries.id = industries_country.lang_id AND industries_country.country_id =' . $this->lang->default_lang_id, 'left');
            $this->db->join('tbl_vehicle_categories_country', 'tbl_vehicle_categories.id = tbl_vehicle_categories_country.lang_id AND tbl_vehicle_categories_country.country_id =' . $this->lang->default_lang_id, 'left');
            $this->db->where_in('industries', $industry);
            $this->db->order_by('category_name', 'ASC');
            $this->db->limit($this->config->item('pagination_limit'), $offset);
            $result = $this->db->get('tbl_vehicle_categories')->result_array();
            if (count($result) > 0) {
                foreach ($result as $res) {
                    if (isset($res['lang_category_name']) && $res['lang_category_name']) {
                        $res['category_name'] = $res['lang_category_name'];
                    }
                    if (isset($res['lang_name']) && $res['lang_name']) {
                        $res['name'] = $res['lang_name'];
                    }
                    $categoryList[] = $res;
                }
            }
        }
        return $categoryList;
    }

    function num_get_vehicle_type_for_ind($industry = array())
    {

        if(!empty($industry)) {
            $this->db->select('id');
            $this->db->where_in('industries', $industry);
            return $this->db->get('tbl_vehicle_categories')->num_rows();
        } else {
            return 0;
        }
    }


    function product_valid_category()
    {

        $this->db->select('id');
        $this->db->where('tbl_vehicle_categories.status', 1);
        $this->db->from('tbl_vehicle_categories');

        $query = $this->db->get()->result_array();

        $category_id   = array_map(function ($value) {
            return  $value['id'];
        }, $query);


        return  $category_id;
    }

    function product_valid_maker()
    {

        $this->db->select('maker_id');
        $this->db->where('product_models.status', 1);
        $this->db->group_by('product_models.maker_id');
        $this->db->from('product_models');

        $query = $this->db->get()->result_array();

        $maker_id   = array_map(function ($value) {
            return  $value['maker_id'];
        }, $query);


        return  $maker_id;
    }

    /**
     * Method get_maker_type_for_menu
     *  This Function return data from the tbl_makers table
     * @param $offset $offset [This is the param to fetch limited data.]
     *
     * @return void
     */
    function get_maker_type_for_menu($offset = 0)
    {
        $this->db->select('m.*, mc.lang_maker_name');
        $this->db->where('m.status', 1);
        $this->db->from('tbl_makers as m');
        $this->db->join('tbl_makers_country as mc', 'm.id = mc.lang_id AND mc.country_id =' . $this->lang->default_lang_id, 'LEFT');
        $this->db->order_by('m.maker_logo', 'DESC');
        $this->db->limit($this->config->item('pagination_limit'), $offset);
        $data =  $this->db->get()->result_array();
        return  $data;
    }

    function num_maker_type_for_menu()
    {
        $this->db->select('tbl_makers.id');
        $this->db->where('status', 1);
        $this->db->from('tbl_makers');
        $data = $this->db->get()->num_rows();

        return $data;
    }
    /**
     * Method getValidUserData
     *  This Function return data from the entry_door_front_shopping_data table as per conditional array.
     * @param $dbCondition $dbCondition [This array is the conditional array.]
     *
     * @return void
     */
    public function getValidUserData($dbCondition)
    {
        $this->db->select('*');
        $this->db->where($dbCondition);
        $this->db->order_by("created_time", "desc");
        $query = $this->db->get('entry_door_front_shopping_data');
        return $query->row_array();
    }

    /**
     * Method deleteValidUserdata 
     *  This Function delete data from the entry_door_front_shopping_data table as per conditional array.
     * @param $data $data [This array is the conditional array.]
     *
     * @return void
     */
    public function deleteValidUserdata($data)
    {
        $this->db->where($data);
        $this->db->delete('entry_door_front_shopping_data');
    }



    /**
     * Method getAdminValidUserData
     * This Function return data from the entry_door_admin_data table as per conditional array.
     * @param $data $data [This array is the conditional array.]
     *
     * @return void
     */
    public function row_by_id_order($data)
    {
        $this->db->select('*');
        $this->db->where($data);
        $this->db->order_by("created_date", "desc");
        $query = $this->db->get('credit_term_requests');
        return $query->row_array();
    }

    /**
     * Method getAdminValidUserData
     * This Function return data from the entry_door_admin_data table as per conditional array.
     * @param $data $data [This array is the conditional array.]
     *
     * @return void
     */
    public function getAdminValidUserData($data)
    {
        $this->db->select('*');
        $this->db->where($data);
        $this->db->order_by("created_time", "desc");
        $query = $this->db->get('entry_door_admin_data');
        return $query->row_array();
    }


    function get_industry_for_menu($offset = 0, $industry = array())
    {

        // $categoryIds = $this->product_valid_category();

            $this->db->select('*');
            $this->db->group_by('tbl_vehicle_categories.industries');
            $this->db->where_in('tbl_vehicle_categories.status', "1");

            $result_ct_indus = $this->db->get("tbl_vehicle_categories")->result_array();
            $cat = array();
            if (!empty($result_ct_indus)) {
                foreach ($result_ct_indus as $cat_single) {
                    $cat[] = $cat_single['industries'];
                }
                $this->db->select('m.*, mc.lang_name,mc.lang_description');
                $this->db->where('m.status', 1);
                if (empty($industry)) {
                    $this->db->where_in('m.id', $cat);
                } else {
                    $this->db->where_in('m.id', $industry);
                }
                $this->db->from('industries as m');
                $this->db->join('industries_country as mc', 'm.id = mc.lang_id AND mc.country_id =' . $this->lang->default_lang_id, 'LEFT');
                $this->db->order_by('m.icon', 'DESC');
                $this->db->limit($this->config->item('pagination_limit'), $offset);
                return $this->db->get()->result_array();
            }
        

        return array();
    }

    function num_get_industry_for_menu($industry = array())
    {

       
            $this->db->select('tbl_vehicle_categories.industries');
            $this->db->group_by('tbl_vehicle_categories.industries');
            $this->db->where_in('tbl_vehicle_categories.status', "1");
            $result_ct_indus = $this->db->get("tbl_vehicle_categories")->result_array();
            $cat = array();

            if (!empty($result_ct_indus)) {
                foreach ($result_ct_indus as $cat_single) {

                    $cat[] = $cat_single['industries'];
                }

                $this->db->select('id');

                if (empty($industry)) {
                    $this->db->where_in('industries.id', $cat);
                } else {
                    $this->db->where_in('industries.id', $industry);
                }

                $this->db->where('status', 1);
                return $this->db->get('industries')->num_rows();
            }
        

        return 0;
    }


    /**
     * Method deleteAdminValidUserdata  
     *  This Function delete data from the entry_door_admin_data table as per conditional array.
     * @param $data $data [This array is the conditional array.]
     *
     * @return void
     */
    public function deleteAdminValidUserdata($data)
    {
        $this->db->where($data);
        $this->db->delete('entry_door_admin_data');
    }

    /**
     * Method getMultilangueValues
     * This Function return table data with language data as per the parameter passed.
     * @param $id $id [This parameter is the  language id.]
     * @param $table $table [This parameter is the  name of the table.]
     * @param $field $field [This parameter is the  name column.]
     *
     * @return void
     */
    public function getMultilangueValues($id, $table, $field, $lang_id_name = 'lang_id')
    {
        $id_default_langue = 13;

    
         $query = "SELECT tab1.image,tab1.name as country_name,tab1.id,tab2." . $field . " FROM country AS tab1 LEFT JOIN " . $table . " AS tab2 ON tab1.id=tab2.country_id and tab2." . $lang_id_name . "=" . $id . " WHERE tab1.status ='1' and tab1.id <>" . $id_default_langue;
        return $this->db->query($query)->result();
    }

    /**
     * Method addMultilangueValues
     * This Function insert language data as per the table name other parameters.
     * @param $table_name $table_name [This parameter is the  name of the table.]
     * @param $field_name $field_name  [This parameter is the  name  of field.] 
     * @param $id $id [This parameter is the row id for the table.]
     * @param $field_value $field_value [This parameter is the  value  of field column.] 
     * @param $country_id $country_id [This parameter is the country id for language data.]
     * 
     * @return void
     */
    public function addOrUpdateMultilangueValues($table_name, $field_name, $id, $field_value, $country_id)
    {

        // $field_value = $this->db->escape($field_value);
        $data = array(
            'lang_id'      => $id,
            'country_id'   => $country_id,
            $field_name    => $field_value,
        );


        $this->db->where('lang_id', $id)->where('country_id',  $country_id);
        $q = $this->db->get($table_name);
        // $this->db->reset_query();
        // echo "<pre>";print_r($data);die;
        if ($q->num_rows() > 0) {
            return $this->db->where('lang_id', $id)->where('country_id',  $country_id)->update($table_name, $data);
        } else {

            return $this->db->insert($table_name, $data);
        }

        // $field_value = $this->db->escape($field_value);
        // $data = array(
        //         'lang_id'      => $id,
        //         'country_id'   => $country_id,
        //         $field_name    => $field_value,
        // );

        // return $this->db->replace($table_name, $data);
        // $query = "INSERT INTO " . $table_name . " (lang_id,country_id, " . $field_name . ") VALUES ('$id','$country_id'," . $field_value . ") ON DUPLICATE KEY UPDATE " . $field_name . "=$field_value";
        // print_r($query);die;
        // return $this->db->query($query);
    }
    /**
     * Method addAdminMultilangueValues
     * This Function insert language data as per the table name other parameters.
     * @param $table_name $table_name [This parameter is the  name of the table.]
     * @param $field_name $field_name  [This parameter is the  name  of field.] 
     * @param $id $id [This parameter is the row id for the table.]
     * @param $field_value $field_value [This parameter is the  value  of field column.] 
     * 
     * 
     * @return void
     */
    public function addOrUpdateAdminMultilangueValues($table_name, $field_name, $id, $field_value)
    {
        $field_value = $this->db->escape($field_value);
        $query = "INSERT INTO " . $table_name . " (id, " . $field_name . ") VALUES ('$id', " . $field_value . ") ON DUPLICATE KEY UPDATE " . $field_name . "=$field_value ";
        return $this->db->query($query);
    }

    /**
     * Method GetAllDataLangByid
     * This Function is used everywhere in the system this function return all data of table with language data as per the language id.
     * @param $tablename $tablename [This parameter is the  name of the table.]
     * @param $param $param [This parameter is the  conditional array.]
     * @param $id $id [This parameter is the row id for the table.]
     * @param $country_id $country_id [This parameter is the country id for language data.]
     * @param $tablelangname $tablelangname [This parameter is the  name of the language table.]
     *
     * @return void
     */
    public function GetAllDataLangByid($tablename, $param, $id, $country_id, $tablelangname = null)
    {
        if ($tablelangname) {
            $query = "SELECT * FROM " . $tablename . " AS tab1 LEFT JOIN " . $tablelangname . " AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $country_id . " WHERE tab1." . $param . "='" . $id . "'";
            $result = $this->db->query($query)->result();
            return updateLanguageParameters($result);
        } else {
            $query = "SELECT * FROM " . $tablename . " WHERE " . $param . "=" . $id;
            return $this->db->query($query)->result();
        }
    }

    /**
     * Method GetAllDataLangByid
     * This Function  return all data of table with language data as per the language id.
     * @param $tablename $tablename [This parameter is the  name of the table.]
     * @param $param $param [This parameter is the  conditional array.]
     * @param $country_id $country_id [This parameter is the country id for language data.]
     * @param $tablelangname $tablelangname [This parameter is the  name of the language table.]
     *
     * @return void
     */
    public function GetAllDataLangByidCountry($tablename, $param, $id, $country_id, $tablelangname = null)
    {
        if ($tablelangname) {
            $query = "SELECT * FROM " . $tablename . " AS tab1 LEFT JOIN " . $tablelangname . " AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $country_id . " WHERE tab1." . $param . "='" . $id . "'";
            $result = $this->db->query($query)->result();
            return updateLanguageParameters($result);
        } else {
            $query = "SELECT * FROM " . $tablename . " WHERE " . $param . "=" . $id;
            return $this->db->query($query)->result();
        }
    }

    public function GetAllDataLangByidCountry_new($tablename, $param, $id, $country_id, $tablelangname = null)
    {
        if ($tablelangname) {
            $query = "SELECT * FROM " . $tablename . " AS tab1 LEFT JOIN " . $tablelangname . " AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $country_id . " WHERE tab1." . $param . "='" . $id . "'";
            $result = $this->db->query($query)->result();
            return $result;
        } else {
            $query = "SELECT * FROM " . $tablename . " WHERE " . $param . "=" . $id;
            return $this->db->query($query)->result();
        }
    }

    /**
     * Method GetAllCountryDataLangByid
     * This Function return countries data with multilangual data.
     * @param $country_id $country_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    public function GetAllCountryDataLangByid($country_id)
    {
        $query  = "SELECT * FROM countries AS tab1 LEFT JOIN countries_lang AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $country_id . " WHERE tab1.status = 1";
        $result = $this->db->query($query)->result();
        return updateLanguageParameters($result);
    }

    /**
     * Method GetAllDataLang
     * This Function  return all data of table with language data as per the language id.
     * @param $tablename $tablename [This parameter is the  name of the table.]
     * @param $country_id $country_id  [This parameter is the country id for language data.]
     * @param $tablelangname $tablelangname [This parameter is the  name of the language table.]
     *
     * @return void
     */
    public function GetAllDataLang($tablename, $country_id, $tablelangname = null)
    {
        if ($tablelangname) {
            $query = "SELECT * FROM " . $tablename . " AS tab1 LEFT JOIN " . $tablelangname . " AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $country_id;

            $result = $this->db->query($query)->result();

            $final_result = null;
            foreach ($result as $row) {
                $final_result[] = get_object_vars($row);
            }

            return updateLanguageParameters($final_result);
        } else {
            $query = "SELECT * FROM " . $tablename;
            return $this->db->query($query)->result();
        }
    }

    /**
     * Method getCountriesAdmin
     *
     * @param $lang_id $lang_id [explicite description]
     *
     * @return void
     */
    public function getCountriesAdmin($lang_id)
    {
        $query = "SELECT * FROM countries AS tab1 LEFT JOIN countries_lang AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $lang_id;
        $result = $this->db->query($query)->result_array();
        $result = updateLanguageParameters($result);
        return $result;
    }

    /**
     * Method getCountriesAdminlanguage
     *
     * @param $lang_id $lang_id [explicite description]
     *
     * @return void
     */
    public function getCountriesAdminlanguage($lang_id)
    {
        $query = "SELECT * FROM admin_countries AS tab1 LEFT JOIN admin_countries_lang AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $lang_id;
        $result = $this->db->query($query)->result_array();
        return $result;
    }

    /**
     * Method getUpsErrors
     * This Function return all rows from ups_errors_country  table with language data.
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    public function getUpsErrors($lang_id)
    {
        $query = "SELECT * FROM ups_errors AS tab1 LEFT JOIN ups_errors_country AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $lang_id;
        $result = $this->db->query($query)->result_array();
        $result = updateLanguageParameters($result);
        return $result;
    }

    /**
     * Method getAdminUpsErrors
     * This Function return all rows from admin_ups_errors  table with language data.
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    public function getAdminUpsErrors($lang_id)
    {
        $query = "SELECT * FROM admin_ups_errors AS tab1 LEFT JOIN admin_ups_errors_country AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $lang_id;
        $result = $this->db->query($query)->result_array();
        $result = updateLanguageParameters($result);
        return $result;
    }

    /**
     * Method getUpsServiceCodeDescription
     * This Function return all rows from admin_ups_errors  table with language data.
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    public function getUpsServiceCodeDescription($lang_id)
    {
        $query = "SELECT * FROM ups_service_code_description AS tab1 LEFT JOIN ups_service_code_description_country AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $lang_id;
        $result = $this->db->query($query)->result_array();
        $result = updateLanguageParameters($result);
        return $result;
    }

    /**
     * Method getUpsErrorsByCode
     *
     * @param $error_code $error_code [explicite description]
     * @param $lang_id $lang_id [explicite description]
     *
     * @return void
     */
    public function getUpsErrorsByCode($error_code, $lang_id)
    {
        $query = "SELECT * FROM ups_errors AS tab1 LEFT JOIN ups_errors_country AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $lang_id . " WHERE tab1.error_code = " . $error_code;
        $result = $this->db->query($query)->result_array();
        $result = updateLanguageParameters($result);
        return $result;
    }

    /**
     * Method getAdminUpsServiceCodeDescription
     * This Function return all rows from admin_ups_service_code_description  table with language data.
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    public function getAdminUpsServiceCodeDescription($lang_id)
    {
        $query = "SELECT * FROM admin_ups_service_code_description AS tab1 LEFT JOIN admin_ups_service_code_description_country AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $lang_id;
        $result = $this->db->query($query)->result_array();
        $result = updateLanguageParameters($result);
        return $result;
    }
    /**
     * Method getBamboraErrors
     * This Function return all bamboora error code from bambora_errors_country  table with language data.
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    public function getBamboraErrors($lang_id)
    {
        $query = "SELECT * FROM bambora_errors AS tab1 LEFT JOIN bambora_errors_country AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $lang_id;
        $result = $this->db->query($query)->result_array();
        $result = updateLanguageParameters($result);
        return $result;
    }

    /**
     * Method getAdminBamboraErrors
     * This Function return all bamboora error code from admin_bambora_errors  table with language data.
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    public function getAdminBamboraErrors($lang_id)
    {
        $query = "SELECT * FROM admin_bambora_errors AS tab1 LEFT JOIN admin_bambora_errors_country AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $lang_id;
        $result = $this->db->query($query)->result_array();
        $result = updateLanguageParameters($result);
        return $result;
    }
    /**
     * Method getBamboraErrorsByCode
     * This Function return stripe error code from bambora_errors  table with language data.
     * @param $error_code $error_code [This parameter is the error code.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    public function getBamboraErrorsByCode($error_code, $lang_id)
    {
        $query = "SELECT * FROM bambora_errors AS tab1 LEFT JOIN bambora_errors_country AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $lang_id . " WHERE tab1.error_code = " . $error_code;
        $result = $this->db->query($query)->result_array();
        $result = updateLanguageParameters($result);
        return $result;
    }

    /**
     * Method getStripeErrors
     * This Function return all stripe error code from stripe_errors  table with language data.
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    public function getStripeErrors($lang_id)
    {
        $query = "SELECT * FROM stripe_errors AS tab1 LEFT JOIN stripe_errors_country AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $lang_id;
        $result = $this->db->query($query)->result_array();
        $result = updateLanguageParameters($result);
        return $result;
    }

    /**
     * Method getAdminStripeErrors
     * This Function return all stripe error code from admin_stripe_errors  table with language data.
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    public function getAdminStripeErrors($lang_id)
    {
        $query = "SELECT * FROM admin_stripe_errors AS tab1 LEFT JOIN admin_stripe_errors_country AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $lang_id;
        $result = $this->db->query($query)->result_array();
        $result = updateLanguageParameters($result);
        return $result;
    }

    /**
     * Method getStripeErrorsByCode
     * This Function return stripe error code from stripe_errors  table with language data.
     * @param $error_code $error_code [This parameter is the error code.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    public function getStripeErrorsByCode($error_code, $lang_id)
    {
        $query = "SELECT * FROM stripe_errors AS tab1 LEFT JOIN stripe_errors_country AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $lang_id . " WHERE tab1.error_code = '" . $error_code . "'";
        $result = $this->db->query($query)->result_array();
        $result = updateLanguageParameters($result);
        return $result;
    }

    /**
     * Method getSingleStripeErrorsByCode
     * This Function return stripe error code from stripe_errors  table with language data.
     * @param $error_code $error_code [This parameter is the error code.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
                                                                                                                                                                            public function getSingleStripeErrorsByCode($error_code, $lang_id)
    {
        $query = "SELECT * FROM stripe_errors AS tab1 LEFT JOIN stripe_errors_country AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $lang_id . " WHERE tab1.error_code = '" . $error_code . "'";
        $result = $this->db->query($query)->row_array();
        $result = updateLanguageParameters($result);
        return $result;
    }

    /**
     * Method getStatesAdmin
     * Not used
     * @param $lang_id $lang_id [explicite description]
     * @param $countryCode $countryCode [explicite description]
     *
     * @return void
     */
    public function getStatesAdmin($lang_id, $countryCode)
    {
        $query = "SELECT * FROM state AS tab1 LEFT JOIN state_country AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $lang_id . " WHERE tab1.country_id ='" . $countryCode . "'";
        $result = $this->db->query($query)->result_array();
        $result = updateLanguageParameters($result);
        return $result;
    }

    /**
     * Method getStatesAdminlanguage
     * Not used
     * @param $lang_id $lang_id [explicite description]
     * @param $countryCode $countryCode [explicite description]
     *
     * @return void
     */
    public function getStatesAdminlanguage($lang_id, $countryCode)
    {
        $query = "SELECT * FROM admin_state AS tab1 LEFT JOIN admin_state_country AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $lang_id . " WHERE tab1.country_id ='" . $countryCode . "'";
        $result = $this->db->query($query)->result_array();
        return $result;
    }

    public function adminGlobalSearch($search_text, $like_para)
    {
        $search_text = str_replace("'", "\'", $search_text);
        $search_text = trim($search_text);

        $result_in_tables = 0;
        $dbname = $this->db->database;
        $sql = 'show tables';
        $tables = $this->db->query('show tables')->result_array();
        for ($i = 0; $i < sizeof($tables); $i++) {
            $sql = 'select count(*) from ' . $tables[$i]['Tables_in_' . $dbname];

            $res = $this->db->query($sql);

            if ($res->num_rows() > 0) {
                $sql = 'desc ' . $tables[$i]['Tables_in_' . $dbname];
                $res = $this->db->query($sql);
                $collum = $res->result_array();

                $search_sql = 'select * from ' . $tables[$i]['Tables_in_' . $dbname] . ' where ';
                $no_varchar_field = 0;

                for ($j = 0; $j < sizeof($collum); $j++) {
                    $prmsql = $this->db->query("SELECT `COLUMN_NAME` FROM `information_schema`.`COLUMNS` WHERE (`TABLE_SCHEMA` = '" . $dbname . "') AND (`TABLE_NAME` = '" . $tables[$i]['Tables_in_' . $dbname] . "') AND (`COLUMN_KEY` = 'PRI')")->result_array();

                    if ($prmsql[0]['COLUMN_NAME'] != $collum[$j]['Field'] && $prmsql[1]['COLUMN_NAME'] != $collum[$j]['Field']) {
                        if ($tables[$i]['Tables_in_' . $dbname] == 'home_page') {
                            if ($collum[$j]['Field'] != 'fevicon' && $collum[$j]['Field'] != 'background_image' && $collum[$j]['Field'] != 'globe_image' && $collum[$j]['Field'] != 'footer_image' && $collum[$j]['Field'] != 'main_background_image' && $collum[$j]['Field'] != 'main_footer_background' && $collum[$j]['Field'] != 'cart_photo') {
                                if ($no_varchar_field != 0) {
                                    $search_sql .= ' or ';
                                }
                                if ($like_para == 'prefix_suffix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '" . $search_text . "' ";
                                } else if ($like_para == 'none') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "%' ";
                                } else if ($like_para == 'prefix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "' ";
                                } else if ($like_para == 'suffix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '" . $search_text . "%' ";
                                } else {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "%' ";
                                }
                            }
                        } else if ($tables[$i]['Tables_in_' . $dbname] == 'country') {
                            if ($collum[$j]['Field'] != 'image' && $collum[$j]['Field'] != 'coming_soon_image' && $collum[$j]['Field'] != 'no_image') {
                                if ($no_varchar_field != 0) {
                                    $search_sql .= ' or ';
                                }
                                if ($like_para == 'prefix_suffix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '" . $search_text . "' ";
                                } else if ($like_para == 'none') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "%' ";
                                } else if ($like_para == 'prefix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "' ";
                                } else if ($like_para == 'suffix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '" . $search_text . "%' ";
                                } else {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "%' ";
                                }
                            }
                        } else if ($tables[$i]['Tables_in_' . $dbname] == 'product_image') {
                            if ($collum[$j]['Field'] != 'image') {
                                if ($no_varchar_field != 0) {
                                    $search_sql .= ' or ';
                                }
                                if ($like_para == 'prefix_suffix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '" . $search_text . "' ";
                                } else if ($like_para == 'none') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "%' ";
                                } else if ($like_para == 'prefix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "' ";
                                } else if ($like_para == 'suffix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '" . $search_text . "%' ";
                                } else {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "%' ";
                                }
                            }
                        } else if ($tables[$i]['Tables_in_' . $dbname] == 'tbl_makers') {
                            if ($collum[$j]['Field'] != 'maker_logo') {
                                if ($no_varchar_field != 0) {
                                    $search_sql .= ' or ';
                                }
                                if ($like_para == 'prefix_suffix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '" . $search_text . "' ";
                                } else if ($like_para == 'none') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "%' ";
                                } else if ($like_para == 'prefix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "' ";
                                } else if ($like_para == 'suffix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '" . $search_text . "%' ";
                                } else {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "%' ";
                                }
                            }
                        } else if ($tables[$i]['Tables_in_' . $dbname] == 'tbl_models') {
                            if ($collum[$j]['Field'] != 'model_photo') {
                                if ($no_varchar_field != 0) {
                                    $search_sql .= ' or ';
                                }
                                if ($like_para == 'prefix_suffix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '" . $search_text . "' ";
                                } else if ($like_para == 'none') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "%' ";
                                } else if ($like_para == 'prefix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "' ";
                                } else if ($like_para == 'suffix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '" . $search_text . "%' ";
                                } else {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "%' ";
                                }
                            }
                        } else if ($tables[$i]['Tables_in_' . $dbname] == 'tbl_product_types') {
                            if ($collum[$j]['Field'] != 'Product_Type_Photo') {
                                if ($no_varchar_field != 0) {
                                    $search_sql .= ' or ';
                                }
                                if ($like_para == 'prefix_suffix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '" . $search_text . "' ";
                                } else if ($like_para == 'none') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "%' ";
                                } else if ($like_para == 'prefix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "' ";
                                } else if ($like_para == 'suffix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '" . $search_text . "%' ";
                                } else {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "%' ";
                                }
                            }
                        } else if ($tables[$i]['Tables_in_' . $dbname] == 'tbl_vehicle_categories') {
                            if ($collum[$j]['Field'] != 'VehicleType_Photo') {
                                if ($no_varchar_field != 0) {
                                    $search_sql .= ' or ';
                                }
                                if ($like_para == 'prefix_suffix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '" . $search_text . "' ";
                                } else if ($like_para == 'none') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "%' ";
                                } else if ($like_para == 'prefix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "' ";
                                } else if ($like_para == 'suffix') {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '" . $search_text . "%' ";
                                } else {
                                    $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "%' ";
                                }
                            }
                        } else {
                            if ($no_varchar_field != 0) {
                                $search_sql .= ' or ';
                            }
                            if ($like_para == 'prefix_suffix') {
                                $search_sql .= "`" . $collum[$j]['Field'] . "` like '" . $search_text . "' ";
                            } else if ($like_para == 'none') {
                                $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "%' ";
                            } else if ($like_para == 'prefix') {
                                $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "' ";
                            } else if ($like_para == 'suffix') {
                                $search_sql .= "`" . $collum[$j]['Field'] . "` like '" . $search_text . "%' ";
                            } else {
                                $search_sql .= "`" . $collum[$j]['Field'] . "` like '%" . $search_text . "%' ";
                            }
                        }
                        $no_varchar_field++;
                    }
                }
                if ($no_varchar_field > 0) {
                    $res = $this->db->query($search_sql);
                    $search_result = $res->row_array();
                    if (!empty($search_result)) {
                        $data[$tables[$i]['Tables_in_' . $dbname]] = $search_result;
                    }
                }
            }
        }

        return $data;
    }

    /**
     * Method GetAllDataLangByNavIdStatus
     *
     * @param $tablename $tablename [explicite description]
     * @param $param $param [explicite description]
     * @param $id $id [explicite description]
     * @param $country_id $country_id [explicite description]
     * @param $tablelangname $tablelangname [explicite description]
     *
     * @return void
     */
    public function GetAllDataLangByNavIdStatus($tablename, $param, $id, $country_id, $tablelangname = null)
    {
        if ($tablelangname) {
            $query = "SELECT * FROM " . $tablename . " AS tab1 LEFT JOIN " . $tablelangname . " AS tab2 ON tab1.id = tab2.lang_id AND tab2.country_id =" . $country_id . " WHERE " . $param . "=" . $id . " ORDER BY id ASC";
            $result = $this->db->query($query)->result();
            return updateLanguageParameters($result);
        } else {
            $query = "SELECT * FROM " . $tablename . " WHERE " . $param . "=" . $id . "ORDER BY id ASC";
            return $this->db->query($query)->result();
        }
    }

    /**
     * Method delete_banner_image_id
     *
     * @param $table $table [This parameter is the  name of the table.]
     * @param $where $where [This parameter is the  array of conditions.]
     *
     * @return void
     */
    function delete_banner_image_id($table, $where)
    {
        $this->db->select('banner_image');
        $this->db->from($table);
        $this->db->where('id', $where);
        $image = $this->db->get()->row();

        $this->db->where('id', $where);
        $this->db->delete($table);
        return $image;
    }

    /**
     * Method delete_social_media_id
     *
     * @param $table $table [This parameter is the  name of the table.]
     * @param $where $where [This parameter is the  array of conditions.]
     *
     * @return void
     */
    function delete_social_media_id($table, $where)
    {
        $this->db->select('social_media_image');
        $this->db->from($table);
        $this->db->where('id', $where);
        $image = $this->db->get()->row();

        $this->db->where('id', $where);
        $this->db->delete($table);
        return $image;
    }

    /**
     * Method delete_whats_new_id
     *  
     * @param $table $table [This parameter is the  name of the table.]
     * @param $where $where [This parameter is the  array of conditions.]
     *
     * @return void
     */
    function delete_whats_new_id($table, $where)
    {
        $this->db->where('id', $where);
        $this->db->delete($table);

        $this->db->select('image');
        $this->db->from($table);
        $this->db->where('id', $where);
        return $this->db->get()->row();
    }

    /**
     * Method get_product_maker_by_machine_id
     *
     * @param $tablename $tablename [explicite description]
     * @param $ids $ids [explicite description]
     * @param $offset $offset [explicite description]
     * @param $country_id $country_id [explicite description]
     * @param $tablelangname $tablelangname [explicite description]
     *
     * @return void
     */
    public function get_product_maker_by_machine_id($tablename, $ids, $offset = 0, $country_id, $tablelangname = null)
    {
        if ($tablelangname) {
            $this->db->select('tbl_makers.*,tbl_vehicle_categories.category_name as category_name, tmc.lang_maker_name');
            $this->db->from('tbl_vehicle_categories');
            $this->db->join('tbl_makers', 'tbl_makers.vehicle_category_id = tbl_vehicle_categories.id');
            $this->db->join('tbl_makers_country as tmc', 'tbl_makers.id = tmc.lang_id and tmc.country_id="' . $country_id . '"', 'left');

            if (!empty($ids)) {
                foreach ($ids as $id) {
                    if ($id != '')
                        $this->db->or_where('tbl_vehicle_categories.id', $id);
                }
            }
            $this->db->where("tbl_makers.status", 1);
            $this->db->group_by("tbl_makers.id");
            $this->db->order_by("tbl_makers.maker_name");
            $this->db->limit($this->config->item('pagination_limit'), $offset);
            $query = $this->db->get();
            $result = $query->result();
            $final_result = null;
            foreach ($result as $row) {
                $final_result[] = get_object_vars($row);
            }

            return updateLanguageParameters($final_result);
        } else {
            echo "else";
            $this->db->select('tbl_makers.*,tbl_vehicle_categories.category_name as category_name');
            $this->db->from('tbl_vehicle_categories');
            $this->db->join('tbl_makers', 'tbl_makers.vehicle_category_id = tbl_vehicle_categories.id');

            if (!empty($ids)) {
                foreach ($ids as $id) {
                    if ($id != '')
                        $this->db->or_where('tbl_vehicle_categories.id', $id);
                }
            }
            $this->db->group_by("tbl_makers.id");
            $this->db->order_by("tbl_makers.maker_name");
            $this->db->limit($this->config->item('pagination_limit'), $offset);
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    /**
     * Method allDefaultDataArray
     * Not used
     * @param $table1 $table1 [explicite description]
     *
     * @return void
     */
    public function allDefaultDataArray($table1)
    {
        $this->db->select('*');
        $this->db->from($table1);
        $query = $this->db->get();
        return $allData = $query->row_array();
    }

    /**
     * Method language_name_by_country
     * This function return all language name.
     * @return void
     */
    public function language_name_by_country()
    {
        $this->db->select('id as lang_country_id, name as language_name');
        $this->db->from('country');
        $query = $this->db->get();
        return $langNameData = $query->result_array();
    }

    /**
     * Method language_name_by_country_without_english
     * This function return all language list without english language.
     * @return void
     */
    public function language_name_by_country_without_english()
    {
        $this->db->select('id as lang_country_id, name as language_name');
        $this->db->from('country');
        $this->db->where_not_in('id', 13);
        $query = $this->db->get();
        return $langNameData = $query->result_array();
    }

    /**
     * Method language_data_by_country
     * Not used
     * @param $table2 $table2 [explicite description]
     *
     * @return void
     */
    public function language_data_by_country($table2)
    {
        $this->db->select('country.name as lang_language_name, ' . $table2 . '.*');
        $this->db->from($table2);
        $this->db->join('country as country', '' . $table2 . '.country_id = country.id', 'right');
        $this->db->where_not_in('country.id', 13);
        $query = $this->db->get();
        return $allData = $query->result_array();
    }

    public function getExportDataArray($table1, $table2, $field)
    {
        $allarr = array();
        $this->db->select('*');
        $this->db->from($table1);
        $allData = $this->db->get()->result();

        foreach ($allData as $kk => $value) {
            $tempARr = [];
            $tempARr[0] = $value->id;
            $tempARr[1] = $value->$field;
            $country_name_id = $this->language_name_by_country_without_english();
            foreach ($country_name_id as $key => $cntr_id) {
                $this->db->select('country.name as lang_language_name, ' . $table2 . '.*');
                $this->db->from($table2);
                $this->db->join('country as country', '' . $table2 . '.country_id = country.id', 'right');
                $this->db->where($table2 . '.lang_id', $value->id);
                $this->db->where($table2 . '.country_id', $cntr_id['lang_country_id']);
                $query = $this->db->get();
                $allMultilingualData = $query->result_array();
                if (is_array($allMultilingualData) && count($allMultilingualData) > 0) {
                    $temVal = $allMultilingualData[0]['lang_' . $field];
                } else {
                    $temVal = "";
                }
                array_push($tempARr, $temVal);
            }
            array_push($allarr, $tempARr);
        }
        return $allarr;
    }

    /**
     * Method getPrimaryLang
     * This Function return primary language row data.
     * @return void
     */
    public function getPrimaryLang()
    {
        $this->db->select('short_code');
        $this->db->where('primary_lang', '1');
        return $this->db->get('country')->row_array();
    }

    function getUserLoginData($email, $country_code, $telephone)
    {
        $data = array();
        $q1 = $this->db->get_where('admin_users', array('email' => $email, 'country_code' => $country_code, 'telephone' => $telephone, 'status' => '1'));
        $r1 = $q1->row_array();

        $this->db->select('page');
        $this->db->where('page_access', 1);
        $this->db->where('role_id', $r1['role_id']);
        $q2 = $this->db->get('admin_role_access');
        $r2 = $q2->result_array();
        $r2 = array_column($r2, 'page');
        $data['id'] = $r1['id'];
        $data['role_id'] = $r1['role_id'];
        $data['title'] = $r1['title'];
        $data['first_name'] = $r1['first_name'];
        $data['last_name'] = $r1['last_name'];
        $data['email'] = $r1['email'];
        $data['country_code'] = $r1['country_code'];
        $data['telephone'] = $r1['telephone'];
        $data['page_access'] = $r2;
        return $data;
    }

    /**
     * Method record_count
     * This Function return number of rows from  the  table.
     * @return void
     */
    function record_count($table)
    {
        return $this->db->count_all($table);
    }

    /**
     * Method record_search_count
     * This Function return number of rows as per the role name.
     * @param $table $table [This parameter is the name of the table.]
     * @param $searchKeyWord $searchKeyWord [This parameter is the keyword for the search name.]
     * @param $field $field [This parameter is the column name of role field.]
     *
     * @return void
     */
    function record_search_count($table, $searchKeyWord, $fields = array())
    {
        if ($searchKeyWord != "") {
            $fields = array_filter($fields);
            if (count($fields) > 1) {
                foreach ($fields as $key => $field) {
                    if ($key == 0) {
                        $this->db->like($field, $searchKeyWord);
                    } else {
                        $this->db->or_like($field, $searchKeyWord);
                    }
                }
            } else if (count($fields) == 1) {
                $this->db->like($fields[0], $searchKeyWord);
            }
        }
        return $this->db->get($table)->num_rows();
    }

    /**
     * Method record_search_data
     * This Function return number of rows as per the role name.
     * @param $table $table [This parameter is the name of the table.]
     * @param $searchKeyWord $searchKeyWord [This parameter is the keyword for the search name.]
     * @param $field $field [This parameter is the column name of role field.]
     * @param $per_page $per_page [This parameter is the number of per_page.]
     * @param $offset $offset [This parameter is the limit start from page offset.]
     *
     * @return void
     */
    function record_search_data($table, $searchKeyWord, $fields = array(), $per_page, $offset)
    {
        if ($searchKeyWord != "") {
            $fields = array_filter($fields);
            if (count($fields) > 1) {
                foreach ($fields as $key => $field) {
                    if ($key == 0) {
                        $this->db->like($field, $searchKeyWord);
                    } else {
                        $this->db->or_like($field, $searchKeyWord);
                    }
                }
            } else if (count($fields) == 1) {
                $this->db->like($fields[0], $searchKeyWord);
            }
        }
        $this->db->limit($per_page, $offset);
        return $this->db->get($table)->result_array();
    }

    /**
     * Method deleteAllDataWithLang
     * This Function delete all rows from tables & multilanguage content too.
     * @param $table $table  [This Parameter is the table]

     * @return void
     */
    function deleteAllDataWithLang($table, $isLang = 0)
    {
        $this->db->empty_table($table);
        if ($isLang) {
            removeAllLangContent($table . '_country');
        }
        return true;
    }

    /**
     * Method deleteDataWithLangById
     * This Function delete single row from tables & multilanguage content too as per the id.
     * @param $id $id  [This Parameter is the maker id]
     *
     * @return void
     */
    function deleteDataWithLangById($table, $id, $isLang = 0)
    {
        $this->db->delete($table, array('id' => $id));
        if ($isLang) {
            removeLangContent($table . '_country', $id);
        }
        return true;
    }

    /**
     * Method check_name_exists
     * This Function check is any row exist in the table as per the  table and column name passed in the parameter.
     * @param $table $table [This Parameter is the table name.]
     * @param $condition $condition [This Parameter is the condition array.]
     *
     * @return void
     */
    public function check_row_exists($table, $condition)
    {
        $q = $this->db->get_where($table, $condition);
        // if row exist as per the maker name than this code return true else false.
        if ($q->num_rows() > 0)
            return true;
        else
            return false;
    }

    /**
     * Method search_table_data
     *
     * @param $table1 $table1 [This parameter is the name of the table1.] 
     * @param $table2 $table2 [This parameter is the  name of the table2 for country.] 
     * @param $key $key [This parameter is the name of the country.]
     * @param $per_page $per_page [This Parameter is the limit  the pagination.]
     * @param $offset $offset [This Parameter is the offset of the pagination.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     * @param $field $field [This parameter is the matching the key based on column.]
     *
     * @return void
     */
    function search_table_data($searchKeyWord, $conditionFields, $per_page, $offset, $returnLangFields, $table1, $table2 = '')
    {
        $table2 = $table2 ? $table2 : $table1 . '_country';

        $this->db->select('t1.*, ' . $returnLangFields);
        if ($searchKeyWord && $conditionFields) {
            $fields = array_filter($conditionFields);
            if (count($fields) > 1) {
                foreach ($fields as $key => $field) {
                    if ($key == 0) {
                        $this->db->like($field, $searchKeyWord);
                    } else {
                        $this->db->or_like($field, $searchKeyWord);
                    }
                }
            } else if (count($fields) == 1) {
                $this->db->like($fields[0], $searchKeyWord);
            }
        }
        $this->db->from($table1 . ' as t1');
        $this->db->join($table2 . ' as t2', 't1.id = t2.lang_id AND t2.country_id =' . $this->lang->default_lang_id, 'left');
        $this->db->limit($per_page, $offset);
        return $this->db->get()->result_array();
    }

    /**
     * Method get_section_lang_data
     * This Function  return all data related to section name from language table.
     * @param $section_name $section_name [This parameter is the  name of the section ofr which you want to retreive data.]
     * @param $country_id $country_id  [This parameter is the country id for language data.]
     * @param $option_name $option_name  [This parameter is the option name.]
     * @return void
     */
    public function get_section_lang_data($section_name, $country_id = 13, $option_name = "")
    {

        $section_name = implode("', '", $section_name);

        // this code make query as per the condition
        if ($country_id != 13) {
            $query = "SELECT t1.*, t2.lang_admin_option_value, t2.lang_front_option_value FROM `language_data` as t1 left join language_data_country as t2 on t2.language_data_id = t1.id AND t2.country_id = " . $country_id . " where t1.section_name IN ('" . $section_name . "')";
            if (!empty($option_name)) {
                $query .= "and t1.option_name ='" . $option_name . "'";
            }
        } else {
            $query = "SELECT * FROM `language_data`  where `language_data`.section_name IN ('" . $section_name . "')";
            if (!empty($option_name)) {
                $query .= "and language_data.option_name='" . $option_name . "'";
            }
        }

        // this code return result from query
        return $this->db->query($query)->result_array();
    }

    /**
     * Method search_db
     *
     * @param $search_text $search_text [This is the user search keyword]
     * @param $like_para $like_para [This is the search param like full or partial search]
     *
     * @return void
     */
    function search_db($search_text, $like_para, $country_data)
    {
        
        // 
        $country_ids = $this->lang->default_lang_id;


        //Get the database name from .env file
        $db_name = getenv('DB_DATABASE');

        // Init vars
        $table_fields       = array();
        $cumulative_results = array();

        $search_text = $this->db->escape_like_str(trim($search_text));


        // Pull all table columns that have character data types
        $result = $this->db->query("
        SELECT TABLE_NAME, COLUMN_NAME, DATA_TYPE
        FROM  `INFORMATION_SCHEMA`.`COLUMNS` 
        WHERE  `TABLE_SCHEMA` =  '{$db_name}'
        AND `DATA_TYPE` IN ('varchar', 'char', 'text','mediumtext','longtext')
        ")->result_array();

        //Defined array for search exclude tables
        $excludeTables = array('admin_all_language_status', 'import_requests', 'order_attributes', 'order_models', 'user_discounts', 'user_discounts_ranges', 'user_ip_data', 'user_terms','product_items','product_attributes','product_details','products_country','product_attributes_country','product_details_country','product_items_country','product_models','tbl_product_category_maker_model_relation','tbl_product_natures','tbl_product_natures_country','tbl_product_parent','tbl_product_types','tbl_product_types_country');

        //Defined array for search exclude columns for each table.
        $excludeFields = array(
            'banner_images'         => array('banner_image', 'status'),
            'country'               => array('image', 'coming_soon_image', 'no_image', 'default_image'),
            'home_page'             => array('fevicon', 'background_image', 'globe_image', 'footer_image', 'main_background_image', 'main_footer_background', 'library_image', 'header_image', 'product_section_image', 'cart_photo', 'product_type_img', 'vehicle_type_img'),
            'social_media'          => array('social_media_image', 'status'),
            'tbl_vehicle_categories' => array('VehicleType_Photo', 'vehicle_category_icon', 'menu_image'),
            'whats_new'             => array('image', 'status'),
            'cart_order_products'   => array('item_real_photo', 'item_schematic_photo'),
            'products' => array('item_real_photo', 'item_schematic_photo', 'vehicle_category_id', 'maker_id', 'model_id'),
            'tbl_models'            => array('model_photo'),
            'tbl_product_types'     => array('Product_Type_Photo'),
            'payment_accept_card'   => array('payment_card_icon', 'status'),
            'language_data'   => array('section_name', 'option_name')

        );

        // Build table-keyed columns so we know which to query
        foreach ($result  as $o) {
            // check the condition for excluded tables
            if (!in_array($o['TABLE_NAME'], $excludeTables)) {
                // check the condition for excluded columns
                if ((isset($excludeFields[$o['TABLE_NAME']]) && !in_array($o['COLUMN_NAME'], $excludeFields[$o['TABLE_NAME']])) || !isset($excludeFields[$o['TABLE_NAME']])) {
                    $table_fields[$o['TABLE_NAME']][] = $o['COLUMN_NAME'];
                }
            }
        }

        // Build search query to pull the affected rows
        // Search Each Row for matches
        foreach ($table_fields as $table_name => $fields) {
            // Clear search array
            // echo  $table_name . "<br>";

            $result = array();

            // Add a search for each search match
            if (count($fields) > 0) {
                $i = 0;
                $search_string = '';
                foreach ($fields as $field) {
                    if ($i != 0) {
                        $search_string .= ' or ';
                    }

                    // create search query based on user search like full text or partial
                    if ($like_para == 'prefix_suffix') {
                        $search_string .= "`" . $field . "` like '" . $search_text . "' ";
                    } else if ($like_para == 'none') {
                        $search_string .= "`" . $field . "` like '%" . $search_text . "%' ";
                    } else if ($like_para == 'prefix') {
                        $search_string .= "`" . $field . "` like '%" . $search_text . "' ";
                    } else if ($like_para == 'suffix') {
                        $search_string .= "`" . $field . "` like '" . $search_text . "%' ";
                    } else {
                        $search_string .= "`" . $field . "` like '%" . $search_text . "%' ";
                    }

                    $i++;
                }


                // if search string exist then the below db query script will run
                if ($search_string) {


                    //Fetch the common data based on section name, because we stored all the section data under the same table
                    if ($table_name == 'language_data' && $this->lang->default_lang_id == "13") {
                        // echo  $table_name."<br>";

                        // echo  $search_string."<br>";
                        // echo  $table_name . " = " . $search_string . "<br>";
                        $this->db->select('*');
                        $this->db->where($search_string);
                        $this->db->group_by('section_name');
                        $result = $this->db->get($table_name)->result_array();
                    }

                    if ($table_name == 'country') {
                        // echo  $table_name."<br>";

                        // echo  $search_string."<br>";
                        // echo  $table_name . " = " . $search_string . "<br>";
                        $this->db->select('*');
                        $this->db->where($search_string);
                        $result = $this->db->get($table_name)->row_array();
                    }

                    if ($table_name == 'language_data_country' && $this->lang->default_lang_id != "13") {
                        // echo  $table_name."<br>";

                        // echo  $search_string."<br>";
                        // echo  $table_name . " = " . $search_string . "<br>";
                        $this->db->select('*');
                        $this->db->where('country_id', $country_ids);
                        $this->db->where($search_string);
                        //Fetch the common language data based on section name,country id because we stored all the section country data under the same table
                        $this->db->join('language_data', 'language_data.id = language_data_country.language_data_id');
                        $this->db->group_by(array('section_name', 'country_id'));
                        $result = $this->db->get($table_name)->result_array();

                        // echo "<pre>";
                        // print_r($result);
                        // exit;
                    }

                    if ((substr($table_name, -7) == "country" || substr($table_name, -4) == "lang") && $table_name != "admin_country" && $table_name != "country" && $this->lang->default_lang_id != "13" && $table_name != "language_data_country") {

                        // echo  $table_name . " = " . $search_string . "<br>";

                        // This is for stand alone tables.
                        $this->db->select('*');
                        $this->db->where('country_id', $country_ids);
                        $this->db->where($search_string);
                        $result = $this->db->get($table_name)->row_array();
                        // echo $this->db->last_query();
                    }
                    if (substr($table_name, -7) != "country" && substr($table_name, -4) != "lang" && $this->lang->default_lang_id == "13" && $table_name != "language_data") {
                        // if ($table_name == "tbl_product_natures") {
                        //      echo  $search_string."<br>";
                        // }
                        // echo  $table_name . " = " . $search_string . "<br>";
                        $this->db->select('*');
                        $this->db->where($search_string);

                        // This is for stand alone tables.
                        $result = $this->db->get($table_name)->row_array();
                    }

                    // If db result exist then we will merge the results as a common set of array based on table name
                    if (!empty($result)) {
                        $table_results[$table_name] =  $result;
                        $cumulative_results = array_merge($cumulative_results, $table_results);
                    }
                }
            }
        }

        

        // Make the single array for the languge_data & language_data_country table data, because we can run single loop with country data. For more check the controller
        if (isset($cumulative_results['language_data']) || isset($cumulative_results['language_data_country'])) {
            $language_data = isset($cumulative_results['language_data']) ? $cumulative_results['language_data'] : array();
            $language_data_country = isset($cumulative_results['language_data_country']) ? $cumulative_results['language_data_country'] : array();
            $newLangData = array_merge($language_data, $language_data_country);
            $cumulative_results['language_data'] = $newLangData;
            unset($cumulative_results['language_data_country']);
        }
     
        //Retun the common set of array results.
        return $cumulative_results;
    }

    function get_all_default_language_list($lang_id)
    {
        $this->db->select('DL.*, C.countryName, CL.lang_countryName, S.name as stateName, SC.lang_name as lang_stateName, CO.name as languageName');
        $this->db->from('default_language as DL');
        $this->db->join('countries as C', 'DL.countryCode = C.alpha_2');
        $this->db->join('countries_lang as CL', 'C.id = CL.lang_id AND CL.country_id =' . $lang_id, 'LEFT');
        $this->db->join('state as S', 'DL.stateCode = S.shortcode AND S.country_id = C.alpha_2');
        $this->db->join('state_country as SC', 'S.id = SC.lang_id AND SC.country_id =' . $lang_id, 'LEFT');
        $this->db->join('country as CO', 'DL.languageId = CO.id');
        return $this->db->get()->result_array();
    }
    


    /**
     * Method get_coupon_data
     *
     * @param $coupon_code $coupon_code [get coupon data in one array]
     *
     * @return void
     */
    function get_coupon_data($coupon_code)
    {

        $data_coupon = $this->get_data_by_id("discount_coupons", array("coupon_code" => $coupon_code));
        $data_ranges = $this->get_all_data_by_id("discount_ranges", array("discount_id" => $data_coupon['id']));
        $data_coupon['ranges'] =   $data_ranges;
        return $data_coupon;
    }

    /**
     * Method get_coupon_data
     *
     * @param $coupon_code $coupon_code [get coupon data in one array]
     *
     * @return void
     */
    function get_coupon($coupon_code)
    {
        $current_date = date("Y-m-d h:i:s");
        $where_array = array("coupon_code" => $coupon_code, "expirytime >" => $current_date, "status" => "1");
        $this->db->where($where_array);
        $query = $this->db->get("discount_coupons");
        return $query->row_array();
    }


    /**
     * Method get_ref_user_emails
     *
     * @param $refusers $refusers [ref users string]
     *
     * @return void
     */
    function get_ref_user_emails($users)
    {
        if ($users == "All") {
            $query = $this->db->get("refferal_users");
            $data = $query->result_array();
        } else {
            $user_ids = explode(",", $users);
            $this->db->where_in('id', $user_ids);
            $query = $this->db->get("refferal_users");
            $data = $query->result_array();
        }
        $emails = array();
        foreach ($data as $single) {
            $emails[] = $single['email'];
        }
        $final  = implode(",", $emails);
        return $final;
    }


    function delete_kgs_products($deleted_product_number)
    {
        // $this->load->library('customlog');

        // $db2 = $this->load->database('mainstore', TRUE);
        // if (!empty($deleted_product_number)) {
        //     $db2->select('*');
        //     $db2->from('products');
        //     $db2->where_in("kgt_ref_number", $deleted_product_number);
        //     $query_d = $db2->get();
        //     $delete_product_ids_arr = $query_d->result_array();

        //     if (!empty($delete_product_ids_arr)) {

        //         $kgs_product_id = array_column($delete_product_ids_arr, 'id');

        //         $this->customlog->write_log(date('y-m-d h:i:s') . " Delete products id  array = " . implode(',', $kgs_product_id), "deleteproduct");


        //         $db2->where_in("id", $kgs_product_id);
        //         $db2->delete("products");

        //         $db2->where_in("product_id", $kgs_product_id);
        //         $db2->delete("tbl_product_item_relation");


        //         $db2->where_in("product_id", $kgs_product_id);
        //         $db2->delete("tbl_product_item_relation_dropdown");

        //         $this->customlog->write_log(date('y-m-d h:i:s') . " Delete product function End", "deleteproduct");
        //     }
        // }
    }


    /**
     * Method get_category_by_industry
     *
     * @param $refusers $refusers [ref users string]
     *
     * @return void
     */
    function get_category_by_industry($industr)
    {
        $this->db->where_in('industries', $industr);
        $query = $this->db->get("tbl_vehicle_categories");
        $data = $query->result_array();

        $categories = array();
        foreach ($data as $cat) {
            $categories[] = $cat['id'];
        }

        return array_unique($categories);
    }

    /**
     * Method get_store_wise_quantity
     *
     * @param $product_id, $store_id
     *
     * @return void
     */
    function store_wise_product_quantity($store_id,$product_id){
        $this->db->select("c.*, st.name, sc.lang_name");
        $this->db->where('c.product_id', $product_id);
        $this->db->where('c.store_id', $store_id);
        $this->db->where('st.status', 1);
        $this->db->from('products_count as c');
        $this->db->join('store as st', 'st.id = c.store_id', 'LEFT');
        $this->db->join('store_country as sc', 'st.id = sc.lang_id AND sc.country_id =' . $this->lang->default_lang_id, 'LEFT');              
        $data =  $this->db->get()->result_array();
        return  $data;
    }
    
    /**
     * Method get_store_wise_quantity
     *
     * @param $product_id
     *
     * @return void
     */
    function get_store_wise_quantity($product_id)
    {
        if (isset($session_data['location_updated']) && ($session_data['location_updated'] == "1")) {
            $latitude = $session_data['latitude'];
            $longitude = $session_data['longitude'];
            
            
        } else {

            $ipdata =  getUserIpData();
            $latitude = $ipdata['latitude'];
            $longitude = $ipdata['longitude'];
             
        }
        $ipdata = json_decode($ipdata['rawData']);
        //print_r($ipdata->geoplugin_latitude);exit; //$ipdata['geoplugin_latitude']." ".$ipdata['geoplugin_longitude']; exit;
        //echo '<pre>';print_r ($ipdata);echo($latitude);exit;
        #$this->db->select("c.*, st.name, st.latitude, st.longitude , sc.lang_name, (((acos(sin((" . $ipdata->geoplugin_latitude . "*pi()/180)) * sin((st.latitude *pi()/180)) + cos((" . $ipdata->geoplugin_latitude . "*pi()/180)) * cos((st.latitude *pi()/180)) * cos(((" . $ipdata->geoplugin_longitude . "- st.longitude) * pi()/180)))) * 180/pi()) * 60 * 1.1515 * 1.609344) as distance");
        $this->db->select("c.*, st.name, st.latitude, st.longitude , sc.lang_name, st.id as distance");//by aditya
        $this->db->where('product_id', $product_id);
        $this->db->where('st.status', 1);
        $this->db->from('products_count as c');
        $this->db->join('store as st', 'st.id = c.store_id', 'LEFT');
        $this->db->join('store_country as sc', 'st.id = sc.lang_id AND sc.country_id =' . $this->lang->default_lang_id, 'LEFT');      
        $this->db->order_by('distance','ASC');
        $data =  $this->db->get()->result_array();
        return  $data;
    }
}
