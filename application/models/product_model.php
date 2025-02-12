<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * product_model
 * This Model Class Handle all the query functions related to products. List Category, models, makers and all products list is handles by this class only.
 */
class product_model extends CI_Model
{

    /**
     * __construct
     *
     *  All models  those we need to use in the model are initialized in the constructor.
     * @return void
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('product_items_model'));
    }


    function pricerequest_session_data()
    {
        $data = array();
        $price_request_product = $this->session->userdata('price_request_product');
        if (!empty($price_request_product)) {

             $querysql = "SELECT id,kgt_ref_number from products ";
            $prodstring = implode(',', $price_request_product);
            $querysql .= " WHERE  products.id IN ($prodstring) ";
            //echo  $querysql;
            $query = $this->db->query($querysql);
            // this function return all rows related to cart items from database 
            $data = $query->result_array();
            return  $data;
        } else {
            return $data;
        }
       

    }

    function products_number_by_id($products)
    {
        $data = array();
        if (!empty($products)) {

            $querysql = "SELECT kgt_ref_number from products ";
            $querysql .= " WHERE  products.id IN ($products) ";
            $query = $this->db->query($querysql);
            // this function return all rows related to cart items from database 
            $data = $query->result_array();
            $ids = array_column($data, 'kgt_ref_number');
            return $ids;
        } else {
            return $data;
        }
    }
    function products_number_andid($products)
    {
        $data = array();
        if (!empty($products)) {

            $querysql = "SELECT id,kgt_ref_number from products ";
            $querysql .= " WHERE  products.id IN ($products) ";
            $query = $this->db->query($querysql);
            // this function return all rows related to cart items from database 
            $data = $query->result_array();
            return $data;
        } else {
            return $data;
        }
    }


    /**
     * Method get_cart_items
     *  This Function return complete data of cart items from multiple tables using join.
     * @param $cart_details $cart_details [This parameter is the cart items array.]
     * @param $lang_id $lang_id [This parameter is the language id. ]
     *
     * @return void
     */
    function get_cart_items($cart_details, $lang_id)
    {
        $data = array();
        if (!empty($cart_details)) {

             $querysql = "SELECT products.*,products.quantity as ship_quantity,products_country.lang_part_name,products_country.lang_shipping_special_notes,  tbl_product_types.product_type_name,tbl_product_types_country.lang_product_type_name, tbl_product_types.menu_privilages,countries.countryName,countries_lang.lang_countryName FROM products   LEFT JOIN  countries ON countries.id = products.country_id JOIN  tbl_product_types ON tbl_product_types.id = products.product_type_id  LEFT JOIN tbl_product_types_country ON tbl_product_types_country.lang_id = tbl_product_types.id and tbl_product_types_country.country_id=" . $lang_id . " LEFT JOIN countries_lang ON countries_lang.lang_id = countries.id and countries_lang.country_id=" . $lang_id . " LEFT JOIN products_country ON products_country.lang_id = products.id and products_country.country_id=" . $lang_id . "  ";

            $items = array_column($cart_details, 'item_id');
            $prod_type_string = implode(',', $items);
            $querysql .= " WHERE  products.id IN ($prod_type_string) ";
            //echo  $querysql;
            $query = $this->db->query($querysql);
            // this function return all rows related to cart items from database 
            $resultobject = $query->result_array();
        }
        if (isset($resultobject)) {
            // this function return code in json format
            $data = json_decode(json_encode($resultobject));
        }

        return $data;
    }

    /**
     * Method getall_producttype_data
     * Thus function return the all product types from the table tbl_product_types with join of tbl_vehicle_categories table. 
     * @param $table $table [This parameter is the  table name]
     * @param $lang_id $lang_id [This parameter is the  language id]
     *
     * @return array
     */
    function getall_producttype_data($lang_id)
    {
        // this code return product types and their corresponding  categories
        $this->db->select('PT.*, V.category_name as category_name, V.id as cat_id, PTC.lang_product_type_name, VC.lang_category_name');
        $this->db->from('tbl_product_types as PT');
        $this->db->join('tbl_vehicle_categories as V', 'PT.vehicle_category_id = V.id', 'left');
        $this->db->join('tbl_product_types_country as PTC', 'PT.id = PTC.lang_id AND PTC.country_id =' . $lang_id, 'left');
        $this->db->join('tbl_vehicle_categories_country as VC', 'V.id = VC.lang_id AND PTC.country_id =' . $lang_id, 'left');
        return $this->db->get()->result_array();
    }

    /**
     * Method getProductNameById
     * This Function return row of the table products as per the row id passed in the parameter.
     * @param $product $product [This parameter is the  id for  the table products. ]
     *
     * @return void
     */
    function getProductNameById($productId)
    {
        $this->db->select('kgt_ref_number');
        $this->db->where('id', $productId);
        $result = $this->db->get('products')->row_array();
        return (isset($result['kgt_ref_number']) && $result['kgt_ref_number']) ? $result['kgt_ref_number'] : '';
    }

    /**
     * Method get_product_category_by_maker_id
     * This Function return vehicle categories ids as per parameter maker ids from table     tbl_makers.
     * @param $id $id [This paramter is the array of maker ids.]
     * 
     * @return array
     */
    function get_product_category_by_maker_id($id = array())
    {
        $response = array();
        if ($id) {
            $this->db->select('GROUP_CONCAT(DISTINCT(vehicle_category_id)) as vehicle_category_ids');
            $this->db->where_in('id', $id);
            // this code  get row from tbl_makers as per the maker id
            $result = $this->db->get('tbl_makers')->row_array();
            // this function return vehicle_category_ids in array format
            $response = $result['vehicle_category_ids'] ? array_unique(array_filter(explode(',', $result['vehicle_category_ids']))) : array();
        }
        return $response;
    }

    /**
     * Method get_product_maker_data_by_id
     * This Function return rows as  per parameter maker ids from table tbl_makers.
     * @param $maker_ids $maker_ids [This paramter is the array of maker ids.]
     *
     * @return array
     */
    function get_product_maker_data_by_id($maker_ids = array())
    {
        if ($maker_ids) {
            // if parameter is not empty than this code execute
            $this->db->where_in('tbl_makers.id', $maker_ids);
            $this->db->join('tbl_vehicle_categories', 'tbl_vehicle_categories.id=tbl_makers.vehicle_category_id');
            $query = $this->db->get('tbl_makers');
            // this code  get row from tbl_makers as per the maker id
            return $query->row_array();
        }
        return array();
    }

    /**
     * Method get_product_model_data_by_id
     * This function return model rows from table tbl_models as per the model ids passed in the parameter.
     * @param $model_ids $model_ids [explicite description]
     *
     * @return void
     */
    function get_product_model_data_by_id($model_ids)
    {
        if ($model_ids) {
            $this->db->where('tbl_models.id', $model_ids);
            $query = $this->db->get('tbl_models');
            $res = $query->row_array();
            if (!empty($res)) {
                $this->db->select('tbl_models.id');
                $this->db->where('tbl_models.model_name', $res['model_name']);
                $query1 = $this->db->get('tbl_models');
                return $query1->result_array();
            }
        }
        return array();
    }

    /**
     * Method getMakerListByCategoryCount
     * This Function return number of rows from table  tbl_vehicle_categories as per ids passed in the 
     * @param $categoryIds $categoryIds [This paramter is the array of category ids.]
     *
     * @return int
     */
    function getMakerListByCategoryCount($categoryIds,$search="")
    {
        $total = 0;

        $this->db->select('tbl_vehicle_categories.id');

        if (!empty($categoryIds)) {
            $this->db->where_in('tbl_vehicle_categories.id', $categoryIds);            
        }
        
        if ($this->session->userdata('search_by') == "product_type") {

            if(!empty($this->session->userdata('product_type'))) {
                $this->db->join('model_groups', 'model_groups.category_id = tbl_vehicle_categories.id', 'LEFT');
                $this->db->where_in('model_groups.product_type_id',$this->session->userdata('product_type'));
                $this->db->group_by('tbl_vehicle_categories.id');
            }
        }

        $total = $this->db->get('tbl_vehicle_categories')->num_rows();
        return $total;
    }

 


  


   

  

    /**
     * Method getMakerListByCategoryId
     *
     * This Function return makers data as per the category id and offset parameter. 
     * @param $categoryIds $categoryIds [This parameter is the array of category ids.]
     * @param $offset $offset [This Parameter is the offset of the pagination.]
     *
     * @return void
     */
    function getMakerListByCategoryId($categoryIds, $offset = 0)
    {
        //echo '<pre>';print_r($this->session->userdata);exit;
        //  echo "Makers";
        //  print_r($makerIds);
        // exit;
        $results = array();
        $this->db->select('C.id,C.category_name,C.vehicle_category_icon,L.lang_category_name');
        if ($this->session->userdata('hide_category') == 0 || true) {

            $this->db->where_in('C.id', $categoryIds);
        }

        if ($this->session->userdata('search_by') == "product_type") {

            if(!empty($this->session->userdata('product_type'))) {
                $this->db->join('model_groups', 'model_groups.category_id = C.id', 'LEFT');
                $this->db->where_in('model_groups.product_type_id',$this->session->userdata('product_type'));
                $this->db->group_by('C.id');
            }
        }
        $this->db->group_by('C.id');
        $this->db->from('tbl_vehicle_categories as C');
        $this->db->join('tbl_vehicle_categories_country as L', 'C.id = L.lang_id and L.country_id="' . $this->lang->default_lang_id . '"', 'left');
        $this->db->order_by("C.category_name", "ASC");

        if ($this->session->userdata('hide_category') == 0 || true) {
            // This code Run When Category is Shown 
            $this->db->limit($this->config->item('pagination_limit'), $offset);
            // This function iterate each category and its all makers as per activated products.
            // this function return category data with language as per the category id and language id
            $results = $this->db->get()->result_array();

      
            foreach ($results as $key => $result) {


                $active_cat = $result['id'];
                // this code  iterate each category and find makers related to  category 


                $this->db->select('maker_id');
                $this->db->where_in('category_id', $active_cat);
                $this->db->where('model_groups.status', "1");
                

                if ($this->session->userdata('search_by') == "product_type") {

                    if(!empty($this->session->userdata('product_type'))) {
                        $this->db->where_in('model_groups.product_type_id',$this->session->userdata('product_type'));
                    }
                }
                $this->db->group_by('model_groups.maker_id');
                $results[$key]['toatalMakers'] = $this->db->get('model_groups')->num_rows();
                //  echo $this->db->last_query()."<br>";
                // This code calculate number of total makers in the active products related to category.


                // This code get complete data related to makers 
                $this->db->select('M.*,L.lang_maker_name');


                $this->db->where_in('model_groups.category_id', $active_cat);
                $this->db->where('model_groups.status', "1");
                if ($makerIds) {
                    $this->db->where_in('model_groups.maker_id', $makerIds);
                }

                if ($this->session->userdata('search_by') == "product_type") {

                    if(!empty($this->session->userdata('product_type'))) {
                        $this->db->where_in('model_groups.product_type_id',$this->session->userdata('product_type'));
                    }
                }
                $this->db->group_by('M.id');
                $this->db->from('model_groups');
                $this->db->join('tbl_makers as M', 'model_groups.maker_id = M.id', 'left');
                $this->db->join('tbl_makers_country as L', 'M.id = L.lang_id and L.country_id="' . $this->lang->default_lang_id . '"', 'left');
                $this->db->order_by("M.maker_name", "ASC");
                $this->db->limit($this->config->item('pagination_limit'), 0);
                // this function get makers as per the category ids and conditions
                $makers = $this->db->get()->result_array();
                // echo $this->db->last_query()."<br>";exit;
                

                $results[$key]['makers'] = $makers;
            }
        } else {
            // This code Run When Category is Hide 
            $this->db->limit(1);
            // this function return category data with language as per the category id and language id
            $results = $this->db->get()->result_array();
            // This function iterate each category and its all makers as per activated products.

       
            foreach ($results as $key => $result) {


                $active_cat = $result['id'];
                // this code  iterate each category and find makers related to  category 


                $this->db->select('maker_id');
                $this->db->where('model_groups.status', "1");
                if ($makerIds) {
                    $this->db->where_in('maker_id', $makerIds);
                }
                // Product Group is set 

                if ($this->session->userdata('search_by') == "product_type") {

                    if(!empty($this->session->userdata('product_type'))) {
                        $this->db->where_in('model_groups.product_type_id',$this->session->userdata('product_type'));
                    }
                }
                $this->db->group_by('maker_id');
                $results[$key]['toatalMakers'] = $this->db->get('model_groups')->num_rows();
                //  echo $this->db->last_query()."<br>";
                // This code calculate number of total makers in the active products related to category.


                // This code get complete data related to makers 
                $this->db->select('M.*,L.lang_maker_name');
                $this->db->where('model_groups.status', "1");
                if ($makerIds) {
                    $this->db->where_in('model_groups.maker_id', $makerIds);
                }

                // Product Group is set 

                if ($this->session->userdata('search_by') == "product_type") {
                    $product_types = $this->session->userdata('product_type');
                    $this->db->where_in('model_groups.product_type_id', $product_types);
                }
                $this->db->group_by('M.id');
                $this->db->from('model_groups');
                $this->db->join('tbl_makers as M', 'model_groups.maker_id = M.id', 'left');
                $this->db->join('tbl_makers_country as L', 'M.id = L.lang_id and L.country_id="' . $this->lang->default_lang_id . '"', 'left');
                $this->db->order_by("M.maker_name", "ASC");
                $this->db->limit($this->config->item('pagination_limit'), 0);
                // this function get makers as per the category ids and conditions
                $makers = $this->db->get()->result_array();
                //  echo $this->db->last_query();
                //  echo "<pre>";print_r($makers);die;

                $results[$key]['makers'] = $makers;
            }
        }

        return $results;
    }


    /**
     * Method getMakerListBySingleCategory
     *
     *  This Function return rows from  table tbl_makers with language data of the row as per the category id  and offset value passed in the parameter.  
     * @param $categoryId $categoryId [This parameter is the  category id.]
     * @param $offset $offset [This parameter is the  offset number for the pagination. ]
     *
     * @return array
     */
    function  getMakerListBySingleCategory($categoryId, $offset)
    {
        $results = array();
        if ($categoryId) {


            // This code get complete data related to makers 
            $this->db->select('M.*,L.lang_maker_name');

            if ($this->session->userdata('hide_category') == 0) {

                $this->db->where_in('product_models.category_id', $categoryId);
            }

            // Product Group is set 

            if ($this->session->userdata('search_by') == "product_type") {
                $this->db->join('products', 'products.id = product_models.product_id', 'left');
                $product_types = $this->session->userdata('product_type');
                $this->db->where_in('products.product_type_id', $product_types);
            }
            $this->db->where('product_models.status', "1");
            $this->db->group_by('M.id');
            $this->db->from('product_models');
            $this->db->join('tbl_makers as M', 'product_models.maker_id = M.id', 'left');
            $this->db->join('tbl_makers_country as L', 'M.id = L.lang_id and L.country_id="' . $this->lang->default_lang_id . '"', 'left');
            $this->db->order_by("M.maker_name", "ASC");
            $this->db->limit($this->config->item('pagination_limit'), $offset);
            // this function get makers as per the category ids and conditions
            $results = $this->db->get()->result_array();
            // echo $this->db->last_query()."<br>";
        }
        return $results;
    }

    /**
     * Method get_product_maker_by_machine_id
     *
     * This Function return rows from  table tbl_makers with categories data  as per the category id  and offset value passed in the parameter.  
     * @param $ids $ids [This parameter is the  array of category ids]
     * @param $offset $offset [This parameter is the  offset number for the pagination.]
     *
     * @return void
     */
    function get_product_maker_by_machine_id($ids, $offset = 0)
    {
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
        // this function return rows as per the  pagination limit and offset
        return $query->result_array();
    }

    /**
     * Method get_model_by_makers_details
     * This function get model  list on the behalf of  session data and offset.
     * @param $offset $offset [This parameter is the  offset number for the pagination.]
     * @param $country_id $country_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function get_model_by_makers_details($modelIds = array(), $offset = 0, $country_id)
    {
        $data = array();
        $session_data        = $this->session->all_userdata();
        // This code read  session data and saved in  variables
        $vehicle_category_id = isset($session_data['vehicle_category_id']) ? $session_data['vehicle_category_id'] : array();
        $cat_mak_group    = isset($session_data['cat_mak_group']) ? $session_data['cat_mak_group'] : array();


        $product_maker_id    = isset($session_data['maker_id']) ? $session_data['maker_id'] : array();
        $product_model_id    = isset($session_data['model_id']) ? $session_data['model_id'] : array();
        $maker_cat_id_pair   = isset($session_data['maker_cat_id_pair']) ? $session_data['maker_cat_id_pair'] : array();
        $vehicle_category_id = array_unique(array_filter($vehicle_category_id));
        $product_maker_id    = array_unique(array_filter($product_maker_id));
        $modelids            = array_unique(array_filter($product_model_id));

        // echo "<pre>";
        // print_r($product_model_id);

        if (!empty($modelids)) {


            // if models ids are  exists in the session than this code executed
            $this->db->select('model_groups.category_id as vehicle_category_id');
            $this->db->group_by('model_groups.category_id');
            $this->db->where_in('model_groups.model_id', $modelids);
            $query = $this->db->get('model_groups')->result_array();

            $vehicle_category_id   = array_map(function ($value) {
                return  $value['vehicle_category_id'];
            }, $query);
        }




        // number of categories 
        if ($this->session->userdata('hide_category') == 1) {
            $totalCategory = 1;
        } else {
            $this->db->select('id');
            $this->db->where_in('id', $vehicle_category_id);
            $totalCategory = $this->db->get('tbl_vehicle_categories')->num_rows();
        }
        $data['totalCategory'] = $totalCategory;
        // number of categories END


        $this->db->group_by('tbl_vehicle_categories.id');
        $this->db->select('tbl_vehicle_categories.*,tbl_vehicle_categories_country.*');
        $this->db->from('tbl_vehicle_categories');
        $this->db->join('tbl_vehicle_categories_country', 'tbl_vehicle_categories_country.lang_id = tbl_vehicle_categories.id and tbl_vehicle_categories_country.country_id=' . $country_id, 'left');
        $this->db->where_in('tbl_vehicle_categories.id', $vehicle_category_id);
        $this->db->order_by("tbl_vehicle_categories.category_name", 'ASC');

        if ($this->session->userdata('hide_category') == 0) {
            // this function return category data with multilanguage according to pagination offset
            $this->db->limit($this->config->item('pagination_limit'), $offset);
        } else {
            $this->db->limit(1);
        }
        $categories = $this->db->get()->result_array();

        if (count($categories) > 0) {
            $i = 0;
            foreach ($categories as $category) {
                $data['models'][$i] = $category;

                // Get Makers Count  Here 
                $this->db->select('tbl_makers.id');
                if ($this->session->userdata('hide_category') == 0 || true) {
                  
                    $this->db->join('model_groups', 'model_groups.maker_id=tbl_makers.id', 'left');

                  
                    $this->db->where_in('model_groups.category_id ', $category['id']);
                    $maker_id_cat =  array_unique($cat_mak_group[$category['id']]);
                    $this->db->where_in('model_groups.maker_id', $maker_id_cat);
                } else {
                    if (count($maker_cat_id_pair) > 0) {
                        $where_array = array();
                        foreach ($maker_cat_id_pair as $pair) {
                            if ($pair['maker_id']) {
                                $where_array[] =  $pair['maker_id'];
                            }
                        }
                        if ($where_array) {
                            $this->db->where_in('tbl_makers.id ', $where_array);
                        }
                    }
                }
                $this->db->where('tbl_makers.status', 1);

                $this->db->group_by('tbl_makers.id');

                $toalMakers = $this->db->get('tbl_makers')->num_rows();
                $data['toalMakers'][$category['id']] = $toalMakers;
                // Get Makers Count End    Here 


                // Get Makers List   Here 
                $this->db->select('tbl_makers.*, tbl_makers_country.lang_maker_name');
                $this->db->from('tbl_makers');
                $this->db->join('tbl_makers_country as tbl_makers_country', 'tbl_makers.id=tbl_makers_country.lang_id and tbl_makers_country.country_id=' . $country_id, 'left');
                if ($this->session->userdata('hide_category') == 0) {

                    $this->db->join('model_groups', 'model_groups.maker_id=tbl_makers.id', 'left');

                    $this->db->where_in('model_groups.category_id ', $category['id']);

                    $maker_id_cat =  array_unique($cat_mak_group[$category['id']]);
                    $this->db->where_in('model_groups.maker_id', $maker_id_cat);
                } else {
                    if (count($maker_cat_id_pair) > 0) {
                        $where_array = array();
                        foreach ($maker_cat_id_pair as $pair) {
                            if ($pair['maker_id']) {
                                $where_array[] =  $pair['maker_id'];
                            }
                        }
                        if ($where_array) {
                            $this->db->where_in('tbl_makers.id ', $where_array);
                        }
                    }
                }
                $this->db->where('tbl_makers.status', 1);
                $this->db->group_by('tbl_makers.id');
                $this->db->order_by("tbl_makers.maker_name", 'ASC');
                $this->db->limit($this->config->item('pagination_limit'), 0);
                $makers = $this->db->get()->result_array();
                // Get Makers List END  Here 

                // Get Models Here 
                if (count($makers) > 0) {
                    $j = 0;
                    foreach ($makers as $maker) {
                        $data['models'][$i]['makers'][$j] = $maker;


                        // Get model Numbers start
                        $this->db->select('tbl_models.id');
                        $this->db->from('tbl_models');
                        $this->db->where('tbl_models.maker_id', $maker['id']);
                        if ($this->session->userdata('hide_category') == 0 || true) {

                            $this->db->join('model_groups', 'tbl_models.id = model_groups.model_id', 'left');
                            $this->db->where('model_groups.category_id', $category['id']);
                        } else {
                            if ($maker['vehicle_category_id']) {
                                $vehicle_category_id = explode(',', $maker['vehicle_category_id']);
                                $this->db->where_in('tbl_models.vehicle_category_id', $vehicle_category_id);
                            }
                        }
                        if (count($modelids) > 0) {
                         $this->db->where_in('tbl_models.id', $modelids);
                        }

                        if (count($modelIds) > 0) {
                            $this->db->where_in('tbl_models.id', $modelIds);
                        }


                        // Product Group is set 

                        if ($this->session->userdata('search_by') == "product_type") {
                            if ($this->session->userdata('hide_category') != 0) {

                                $this->db->join('model_groups', 'tbl_models.id = model_groups.model_id', 'left');
                                }
                            $product_types = $this->session->userdata('product_type');
                            $this->db->where_in('model_groups.product_type_id', $product_types);
                        }
                        $this->db->where('tbl_models.status', 1);
                        $this->db->group_by("tbl_models.id");

                        $this->db->order_by("tbl_models.model_name", 'ASC');
                        $totalModels = $this->db->get()->num_rows();
                        $data['totalModels'][$maker['id'] . '-' . $category['id']] = $totalModels;
                        // Get model Numbers End


                        // Get model Numbers Rows

                        $this->db->select('tbl_models.*, tbl_models_country.lang_serial_number, tbl_models_country.lang_model_name');
                        $this->db->from('tbl_models');
                        $this->db->join('tbl_models_country as tbl_models_country', 'tbl_models.id=tbl_models_country.lang_id and tbl_models_country.country_id=' . $country_id, 'left');
                        $this->db->where('tbl_models.maker_id', $maker['id']);
                        if ($this->session->userdata('hide_category') == 0) {

                            $this->db->join('model_groups', 'tbl_models.id = model_groups.model_id', 'left');
                            $this->db->where('model_groups.category_id', $category['id']);
                        } else {
                            if ($maker['vehicle_category_id']) {
                                $vehicle_category_id = explode(',', $maker['vehicle_category_id']);
                                $this->db->where_in('tbl_models.vehicle_category_id', $vehicle_category_id);
                            }
                        }
                        if (count($modelids) > 0) {
                            $this->db->where_in('tbl_models.id', $modelids);
                        }

                        if (count($modelIds) > 0) {
                            $this->db->where_in('tbl_models.id', $modelIds);
                        }

                        // Product Group is set 

                        if ($this->session->userdata('search_by') == "product_type") {
                            if ($this->session->userdata('hide_category') != 0) {

                            $this->db->join('model_groups', 'tbl_models.id = model_groups.model_id', 'left');
                            }
                            $product_types = $this->session->userdata('product_type');
                            $this->db->where_in('model_groups.product_type_id', $product_types);
                        }

                        $this->db->where('tbl_models.status', 1);
                        $this->db->group_by('tbl_models.id');
                        $this->db->order_by("tbl_models.model_name", 'ASC');
                        $this->db->limit($this->config->item('pagination_limit'), 0);
                        $models = $this->db->get()->result_array();
                        $data['models'][$i]['makers'][$j]['models'] = $models;
                        // Get model Numbers Rows End 
                        
                        $j++;
                    }
                }
                $i++;
            }
        }
        
        //  echo '<pre>';print_r($data);exit;
        return $data;

    }

    function get_model_by_makers_details_new($modelIds = array(), $offset = 0, $country_id,$makerId = null,$search="",$vehicle_category_id_data)
    {
        
        $data = array();
        $session_data        = $this->session->all_userdata();
        $vehicle_category_id = isset($session_data['vehicle_category_id']) ? $session_data['vehicle_category_id'] : array();
        $vehicle_category_id = array_unique(array_filter($vehicle_category_id));
        if($vehicle_category_id_data == 'all'){
            
            $cat_mak_group    = isset($session_data['cat_mak_group']) ? $session_data['cat_mak_group'] : array();
    
    
            $product_maker_id    = isset($session_data['maker_id']) ? $session_data['maker_id'] : array();
            $product_model_id    = isset($session_data['model_id']) ? $session_data['model_id'] : array();
            $maker_cat_id_pair   = isset($session_data['maker_cat_id_pair']) ? $session_data['maker_cat_id_pair'] : array();
            $product_maker_id    = array_unique(array_filter($product_maker_id));
            $modelids            = array_unique(array_filter($product_model_id));
            // This code read  session data and saved in  variables

            if (!empty($modelids)) {


                // if models ids are  exists in the session than this code executed
                $this->db->select('model_groups.category_id as vehicle_category_id');
                $this->db->group_by('model_groups.category_id');
                $this->db->where_in('model_groups.model_id', $modelids);
                $this->db->limit($this->config->item('pagination_limit'), $offset);
                $query = $this->db->get('model_groups')->result_array();

                $vehicle_category_id   = array_map(function ($value) {
                    return  $value['vehicle_category_id'];
                }, $query);
            }




            // number of categories 
            if ($this->session->userdata('hide_category') == 1) {
                $totalCategory = 1;
            } else {
                $this->db->select('id');
                $this->db->where_in('id', $vehicle_category_id);
                $totalCategory = $this->db->get('tbl_vehicle_categories')->num_rows();
            }
            // number of categories END


            $this->db->group_by('tbl_vehicle_categories.id');
            $this->db->select('tbl_vehicle_categories.*,tbl_vehicle_categories_country.*');
            $this->db->from('tbl_vehicle_categories');
            $this->db->join('tbl_vehicle_categories_country', 'tbl_vehicle_categories_country.lang_id = tbl_vehicle_categories.id and tbl_vehicle_categories_country.country_id=' . $country_id, 'left');
            $this->db->where_in('tbl_vehicle_categories.id', $vehicle_category_id);
            $this->db->order_by("tbl_vehicle_categories.category_name", 'ASC');

            if ($this->session->userdata('hide_category') == 0) {
                // this function return category data with multilanguage according to pagination offset
                $this->db->limit($this->config->item('pagination_limit'), $offset);
            } else {
                $this->db->limit(1);
            }
            $categories = $this->db->get()->result_array();
            
            } else {
                // This code read  session data and saved in  variables
                $vehicle_category_id = $vehicle_category_id_data;
              
                $cat_mak_group    = isset($session_data['cat_mak_group']) ? $session_data['cat_mak_group'] : array();


                $product_maker_id    = isset($session_data['maker_id']) ? $session_data['maker_id'] : array();
                $product_model_id    = isset($session_data['model_id']) ? $session_data['model_id'] : array();
                $maker_cat_id_pair   = isset($session_data['maker_cat_id_pair']) ? $session_data['maker_cat_id_pair'] : array();
                // $vehicle_category_id = array_unique(array_filter($vehicle_category_id));
                $product_maker_id    = array_unique(array_filter($product_maker_id));
                $modelids            = array_unique(array_filter($product_model_id));

                /*if (!empty($modelids)) {
                    // if models ids are  exists in the session than this code executed
                    $this->db->select('model_groups.category_id as vehicle_category_id');
                    $this->db->group_by('model_groups.category_id');
                    $this->db->where_in('model_groups.model_id', $modelids);
                    $this->db->limit($this->config->item('pagination_limit'), $offset);
                    $query = $this->db->get('model_groups')->result_array();

                    $vehicle_category_id   = array_map(function ($value) {
                        return  $value['vehicle_category_id'];
                    }, $query);
                }*/




                // number of categories 
                if ($this->session->userdata('hide_category') == 1) {
                    $totalCategory = 1;
                } else {
                    $this->db->select('id');
                    $this->db->where('id', $vehicle_category_id);
                    $totalCategory = $this->db->get('tbl_vehicle_categories')->num_rows();
                }
                // number of categories END


                $this->db->group_by('tbl_vehicle_categories.id');
                $this->db->select('tbl_vehicle_categories.*,tbl_vehicle_categories_country.*');
                $this->db->from('tbl_vehicle_categories');
                $this->db->join('tbl_vehicle_categories_country', 'tbl_vehicle_categories_country.lang_id = tbl_vehicle_categories.id and tbl_vehicle_categories_country.country_id=' . $country_id, 'left');
                $this->db->where('tbl_vehicle_categories.id', $vehicle_category_id);
                $this->db->order_by("tbl_vehicle_categories.category_name", 'ASC');

                if ($this->session->userdata('hide_category') == 0) {
                    // this function return category data with multilanguage according to pagination offset
                    $this->db->limit($this->config->item('pagination_limit'), $offset);
                } else {
                    $this->db->limit(1);
                }
                $categories = $this->db->get()->result_array();
        
            }
        if (count($categories) > 0) {
            $i = 0;
            foreach ($categories as $category) {

                // Get Makers List   Here 
                $this->db->select('tbl_makers.*, tbl_makers_country.lang_maker_name');
                $this->db->from('tbl_makers');
                $this->db->join('tbl_makers_country as tbl_makers_country', 'tbl_makers.id=tbl_makers_country.lang_id and tbl_makers_country.country_id=' . $country_id, 'left');
                if ($this->session->userdata('hide_category') == 0) {

                    $this->db->join('model_groups', 'model_groups.maker_id=tbl_makers.id', 'left');

                    $this->db->where_in('model_groups.category_id ', $category['id']);

                    $maker_id_cat =  array_unique($cat_mak_group[$category['id']]);
                    $this->db->where_in('model_groups.maker_id', $maker_id_cat);
                } else {
                    
                    if (count($maker_cat_id_pair) > 0) {
                        $where_array = array();
                        foreach ($maker_cat_id_pair as $pair) {
                            if ($pair['maker_id']) {
                                $where_array[] =  $pair['maker_id'];
                            }
                        }
                        if ($where_array) {
                            $this->db->where('tbl_makers.id ', $makerId);
                        }
                    }
                }
                
                $this->db->where('tbl_makers.status', 1);
                $this->db->group_by('tbl_makers.id');
                $this->db->order_by("tbl_makers.maker_name", 'ASC');
                $this->db->limit($this->config->item('pagination_limit'), 0);
                $maker = $this->db->get()->row_array();
                
                
                // Get Makers List END  Here 

                // Get Models Here 
                


                        // Get model Numbers Rows

                        $this->db->select('tbl_models.*, tbl_models_country.lang_serial_number, tbl_models_country.lang_model_name');
                        $this->db->from('tbl_models');
                        $this->db->join('tbl_models_country as tbl_models_country', 'tbl_models.id=tbl_models_country.lang_id and tbl_models_country.country_id=' . $country_id, 'left');
                        $this->db->where('tbl_models.maker_id', $makerId);
                        if ($this->session->userdata('hide_category') == 0) {

                            $this->db->join('model_groups', 'tbl_models.id = model_groups.model_id', 'left');
                            $this->db->where('model_groups.category_id', $category['id']);
                        } else {
                            if ($maker['vehicle_category_id']) {
                                $vehicle_category_id = explode(',', $maker['vehicle_category_id']);
                                $this->db->where_in('tbl_models.vehicle_category_id', $vehicle_category_id);
                            }
                        }
                        if (count($modelids) > 0) {
                            $this->db->where_in('tbl_models.id', $modelids);
                        }

                        if (count($modelIds) > 0) {
                            $this->db->where_in('tbl_models.id', $modelIds);
                        }

                        // Product Group is set 

                        if ($this->session->userdata('search_by') == "product_type") {
                            if ($this->session->userdata('hide_category') != 0) {

                            $this->db->join('model_groups', 'tbl_models.id = model_groups.model_id', 'left');
                            }
                            $product_types = $this->session->userdata('product_type');
                            $this->db->where_in('model_groups.product_type_id', $product_types);
                        }
                        if($search != '') {
                            $this->db->like('tbl_models.model_name', $search , 'both'); 
                            }
                       
                        $this->db->where('tbl_models.status', 1);
                        $this->db->group_by('tbl_models.id');
                        $this->db->order_by("tbl_models.model_name", 'ASC');
                        $this->db->limit($this->config->item('pagination_limit'), 0);
                        $models = $this->db->get()->result_array();

                        $data[$i] = $models;
                        // Get model Numbers Rows End 
        $i++;
            }
        }
        
        return $data;

    }

    function get_model_by_makerId($maker_id,$country_id){
        
        //SELECT * FROM `tbl_models` where vehicle_category_id in (select vehicle_category_id from tbl_makers where id = '404')
        $this->db->select('tbl_models.*, tbl_models_country.lang_serial_number, tbl_models_country.lang_model_name');
        $this->db->from('tbl_models');
        $this->db->join('tbl_models_country as tbl_models_country', 'tbl_models.id=tbl_models_country.lang_id and tbl_models_country.country_id=' . $country_id, 'left');
        $this->db->where('tbl_models.maker_id', $maker_id);
        $result = $this->db->get()->result_array();       
        $categories = array();
        $categories_ids = array();
        
        $makers = array();
        foreach($result as $row){
            $vehicle_id = $row['vehicle_category_id'];
            if(!in_array($vehicle_id, $categories_ids)){
                $categories_ids[] = $vehicle_id;
                $this->db->select('tbl_vehicle_categories.*, tbl_vehicle_categories_country.lang_category_name');
                $this->db->from('tbl_vehicle_categories');
                $this->db->join('tbl_vehicle_categories_country','tbl_vehicle_categories.id = tbl_vehicle_categories_country.lang_id and tbl_vehicle_categories_country.country_id='.$country_id, 'left');
                $this->db->where('tbl_vehicle_categories.id',$vehicle_id);
                $category_r = $this->db->get()->row_array();  
                $this->db->select('tbl_makers.*,tbl_makers_country.lang_maker_name');
                $this->db->from('tbl_makers');
                $this->db->join('tbl_makers_country','tbl_makers.id = tbl_makers_country.lang_id and tbl_makers_country.country_id='.$country_id,'left');
                $this->db->where('tbl_makers.id',$row['maker_id']);
                $maker_r = $this->db->get()->row_array();
                $category_r['makers'][0]['id'] = $maker_r['id'];
                // $category_r['makers'][0]['maker_name'] = $category_r['category_name'];
                // $category_r['makers'][0]['status'] = $category_r['status'];
                // $category_r['makers'][0]['lang_maker_name'] = $category_r['lang_category_name'];
                $category_r['makers'][0]['maker_name'] = $maker_r['maker_name'];
                $category_r['makers'][0]['status'] = $maker_r['status'];
                $category_r['makers'][0]['lang_maker_name'] = $maker_r['lang_maker_name'];
                $category_r['makers'][0]['maker_logo'] = $maker_r['maker_logo'];                
                $category_r['makers'][0]['vehicle_category_id'] = $maker_r['vehicle_category_id'];                
                $category_r['makers'][0]['models'][] = $row;
                $categories[$vehicle_id] = $category_r;
            }else{
                $categories[$vehicle_id]['makers'][0]['models'][] = $row;
            }
                
        }
        // echo '<pre>';print_r($categories);
        $total_makers = array();
        $total_models = array();
        $data_category = array();
        foreach($categories as $cat){
            $data_catego[] = $cat;
            $total_models[$cat['makers'][0]['id'].'-'.$cat['id']] = count($cat['makers'][0]['models']);
            $total_makers[$cat['id']] = count($cat['makers']);
        }
        
        $data['totalCategory'] = count($categories);
        $data['models'] = $categories;
        $data['toalMakers'] = $total_makers;
        $data['totalModels'] = $total_models;
        // $data2 = array();
        // if (true){
        //     $data2['totalCategory'] = 1;
        //     $data2['models'] = $categories;
        //     $data2['toalMakers'] = $total_makers[0];
        //     $data2['totalModels'] = $total_models[0];
        // }
        //echo '<pre>';print_r($data);print_r($data2);exit;
        return $data;
    }


    /**
     * Method get_model_makers_by_category_makerId
     *
     * @param $categoryId $categoryId [explicite description]
     * @param $product_maker_id $product_maker_id [explicite description]
     * @param $offset $offset [This parameter is the  offset number for the pagination.]
     * @param $country_id $country_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function get_model_makers_by_category_makerId($categoryId, $product_maker_id, $offset, $country_id)
    {


        $this->db->select('tbl_makers.*');
        $this->db->from('tbl_makers');
        $this->db->where('tbl_makers.id', $product_maker_id);
        $this->db->where('tbl_makers.status', 1);
        $maker = $this->db->get()->row_array();

        // Get model Numbers Rows
        $this->db->select('tbl_models.*, tbl_models_country.lang_serial_number, tbl_models_country.lang_model_name');
        $this->db->from('tbl_models');
        $this->db->join('tbl_models_country as tbl_models_country', 'tbl_models.id=tbl_models_country.lang_id and tbl_models_country.country_id=' . $country_id, 'left');
        $this->db->where('tbl_models.maker_id', $product_maker_id);
        if ($this->session->userdata('hide_category') == 0) {

            $this->db->join('model_groups', 'model_groups.model_id=tbl_models.id', 'left');
            $this->db->where_in('model_groups.category_id ', $categoryId);
        } else {
            if ($maker['vehicle_category_id']) {
                $vehicle_category_id = explode(',', $maker['vehicle_category_id']);
                $this->db->where_in('tbl_models.vehicle_category_id', $vehicle_category_id);
            }
        }

        // Product Group is set 

        if ($this->session->userdata('search_by') == "product_type") {
            if ($this->session->userdata('hide_category') != 0) {
            $this->db->join('model_groups', 'tbl_models.id = model_groups.model_id', 'left');
            }
            $product_types = $this->session->userdata('product_type');
            $this->db->where_in('model_groups.product_type_id', $product_types);
        }
        $this->db->where('tbl_models.status', 1);
        $this->db->group_by('tbl_models.id');
        $this->db->order_by("tbl_models.model_name", 'ASC');
        $this->db->limit($this->config->item('pagination_limit'), $offset);
        $models = $this->db->get()->result_array();
        // echo $this->db->last_query();
        // exit;

        return $models;
    }
    /**
     * Method get_model_makers_by_categoryId
     * This function get model  list on the behalf of  session data and offset.
     * @param $categoryId $categoryId [This parameter is the  category id.]
     * @param $offset $offset [This parameter is the  offset number for the pagination.]
     * @param $country_id $country_id This parameter is the country id for language data.]
     *
     * @return void
     */
    function get_model_makers_by_categoryId($categoryId, $offset, $country_id)
    {
        $data = array();
        // This code read  session data and saved in  variables
        $session_data        = $this->session->all_userdata();
        $product_maker_id    = isset($session_data['maker_id']) ? $session_data['maker_id'] : array();
        $product_maker_id    = array_unique(array_filter($product_maker_id));
        $maker_cat_id_pair   = isset($session_data['maker_cat_id_pair']) ? $session_data['maker_cat_id_pair'] : array();

        $cat_mak_group    = isset($session_data['cat_mak_group']) ? $session_data['cat_mak_group'] : array();




        $this->db->select('tbl_makers.*, tbl_makers_country.lang_maker_name');
        $this->db->from('tbl_makers');
        $this->db->join('tbl_makers_country as tbl_makers_country', 'tbl_makers.id=tbl_makers_country.lang_id and tbl_makers_country.country_id=' . $country_id, 'left');
        if ($this->session->userdata('hide_category') == 0) {

            $this->db->join('model_groups', 'model_groups.maker_id=tbl_makers.id', 'left');

            $this->db->where_in('model_groups.category_id ', $category['id']);

            $maker_id_cat =  array_unique($cat_mak_group[$category['id']]);
            $this->db->where_in('model_groups.maker_id', $maker_id_cat);
        } else {
            if (count($maker_cat_id_pair) > 0) {
                $where_array = array();
                foreach ($maker_cat_id_pair as $pair) {
                    if ($pair['maker_id']) {
                        $where_array[] =  $pair['maker_id'];
                    }
                }
                if ($where_array) {
                    $this->db->where_in('tbl_makers.id ', $where_array);
                }
            }
        }
        $this->db->where('tbl_makers.status', 1);
        $this->db->group_by('tbl_makers.id');
        $this->db->order_by("tbl_makers.maker_name", 'ASC');
        $this->db->limit($this->config->item('pagination_limit'),$offset);
        $makers = $this->db->get()->result_array();

        if (count($makers) > 0) {
            $j = 0;
            foreach ($makers as $maker) {
                $data['makers'][$j] = $maker;
                // Get model Numbers Rows

                $this->db->select('tbl_models.*, tbl_models_country.lang_serial_number, tbl_models_country.lang_model_name');
                $this->db->from('tbl_models');
                $this->db->join('tbl_models_country as tbl_models_country', 'tbl_models.id=tbl_models_country.lang_id and tbl_models_country.country_id=' . $country_id, 'left');
                $this->db->where('tbl_models.maker_id', $maker['id']);
                if ($this->session->userdata('hide_category') == 0) {

                    $this->db->join('model_groups', 'tbl_models.id = model_groups.model_id', 'left');
                    $this->db->where('model_groups.category_id', $category['id']);
                } else {
                    if ($maker['vehicle_category_id']) {
                        $vehicle_category_id = explode(',', $maker['vehicle_category_id']);
                        $this->db->where_in('tbl_models.vehicle_category_id', $vehicle_category_id);
                    }
                }
                if (count($modelids) > 0) {
                    $this->db->where_in('tbl_models.model_id', $modelids);
                }

                if (count($modelIds) > 0) {
                    $this->db->where_in('tbl_models.model_id', $modelIds);
                }

                // Product Group is set 

                if ($this->session->userdata('search_by') == "product_type") {
                    $this->db->join('model_groups', 'tbl_models.id = model_groups.model_id', 'left');
                    $product_types = $this->session->userdata('product_type');
                    $this->db->where_in('model_groups.product_type_id', $product_types);
                }

                $this->db->where('tbl_models.status', 1);
                $this->db->group_by('tbl_models.id');
                $this->db->order_by("tbl_models.model_name", 'ASC');
                $this->db->limit($this->config->item('pagination_limit'), 0);
                $models = $this->db->get()->result_array();
                $data['makers'][$j]['models'] = $models;
                // Get model Numbers Rows End 

                $j++;
            }
        }
// echo "<pre>";
// print_r($data);
        return $data;
    }



    /**
     * Method getModelListByMakerId
     * This Function return rows from tbl_models as per the maker id.
     * @param $makerId $makerId [This parameter is the array of maker ids.]
     *
     * @return void
     */
    function getModelListByMakerId($makerId)
    {
        $this->db->select('tbl_models.id as model_id,tbl_models.model_name,tbl_models.maker_id');
        $this->db->where_in('tbl_models.maker_id', $makerId);
        $this->db->where('tbl_models.status', 1);
        return $this->db->get('tbl_models')->result_array();
    }

    /**
     * Method getProductIdByPartNumber
     * This Function return product id as per product number passed in the parameter.
     * @param $kgt_ref_number $kgt_ref_number [This parameter is the product number.]
     *
     * @return void
     */
    function getProductIdByPartNumber($kgt_ref_number)
    {
        $this->db->select('id');
        $product = $this->db->get_where('products', array('kgt_ref_number' => $kgt_ref_number))->row_array();
        return $product['id'];
    }

   

    /**
     * Method productByKGTRefNo
     * This Function get details of single product as per the product number passed as the paramter. 
     * @param $kgt_ref_number $kgt_ref_number [This parameter is the product number.]
     * @param $lang_id $lang_id [This parameter is the language id.]
     *
     * @return void
     */
    function productByKGTRefNo($kgt_ref_number, $lang_id)
    {


        // this function make query as per the conditions and session data
        $querysql = "SELECT P.id,P.hide_partid, P.kgt_ref_number,P.part_name, products_country.lang_part_name, P.quantity,P.min_quantity,P.price, P.item_real_photo, P.item_schematic_photo, P.item_schematic_photo_status, P.item_width, P.item_height, P.item_length, P.item_weight, P.shipping_special_notes,products_country.lang_shipping_special_notes, tbl_makers.id as maker_id, tbl_makers.maker_name as make,tbl_makers.maker_logo as maker_logo, tbl_models.id as model_id, tbl_models.model_name as model,tbl_models.model_photo as model_photo, tbl_vehicle_categories.id as vehicle_category_id, tbl_vehicle_categories.category_name as category, tbl_vehicle_categories.vehicle_category_icon as category_icon,  tbl_product_types.product_type_name,tbl_product_types_country.lang_product_type_name,tbl_product_types.Product_Type_Photo as type_photo, tbl_product_types.menu_privilages, tbl_vehicle_categories_country.country_id, tbl_vehicle_categories_country.lang_category_name,tbl_product_types_country.lang_product_type_name,tbl_product_parent.parent_product_id,distributors.name as dist_name,distributors.url as dist_url,distributors.logo as dist_logo,distributors.country as dist_country,distributors.zip_code  as dist_zip_code,P.template FROM product_models ";


        $querysql .= " LEFT JOIN products as P ON P.id = product_models.product_id JOIN tbl_makers ON tbl_makers.id = product_models.maker_id 
                JOIN tbl_models ON tbl_models.id = product_models.model_id 
                JOIN tbl_vehicle_categories ON tbl_vehicle_categories.id = product_models.category_id 
                JOIN tbl_product_types ON tbl_product_types.id = P.product_type_id 
                LEFT JOIN distributors ON distributors.id = P.distributor
                LEFT JOIN tbl_product_parent ON tbl_product_parent.product_id = P.id
                LEFT JOIN tbl_vehicle_categories_country ON tbl_vehicle_categories_country.lang_id = tbl_vehicle_categories.id and tbl_vehicle_categories_country.country_id=" . $lang_id . " 
                LEFT JOIN products_country ON products_country.lang_id = P.id and products_country.country_id=" . $lang_id . " LEFT JOIN tbl_product_types_country ON tbl_product_types_country.lang_id = tbl_product_types.id and tbl_product_types_country.country_id=" . $lang_id . " WHERE product_models.status='1'  ";

        // this code prepare conditions array from the session data
        if (!empty($kgt_ref_number)) {
            $querysql .= " AND P.kgt_ref_number='" . $kgt_ref_number . "'";
        }


        $querysql .= " AND P.status = 1 GROUP BY P.id ORDER BY  P.price ASC ";

       // echo $querysql;

        $query = $this->db->query($querysql);
        $result = $query->result_array();
        return json_decode(json_encode($result));
    }


    /**
     * Method getProductChild
     * This function get child products data as per the product id.
     * @param $product_id $product_id [This parameter is the product id .]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function getProductChild($product_id, $lang_id)
    {
         $querysql = "SELECT tbl_product_parent.product_id, tbl_product_parent.parent_product_id, products.id, products.kgt_ref_number, products.part_name, products_country.lang_part_name,products.quantity,products.min_quantity,
         product_details.ex_stock_period, products.price,products.item_real_photo, products.item_schematic_photo, products.item_schematic_photo_status, products.item_width, products.item_height, products.item_length, products.item_weight, products.shipping_special_notes, products.availability, products.unit_of_measurement,  tbl_product_types.product_type_name,
        tbl_product_types_country.lang_product_type_name,tbl_product_types.menu_privilages
                FROM tbl_product_parent 
                JOIN products ON products.id = tbl_product_parent.product_id
                JOIN product_details ON products.id = product_details.product_id
                JOIN tbl_product_types ON tbl_product_types.id = products.product_type_id LEFT JOIN products_country ON products_country.lang_id = products.id and products_country.country_id=" . $lang_id . " 
                LEFT JOIN tbl_product_types_country ON tbl_product_types_country.lang_id = tbl_product_types.id and tbl_product_types_country.country_id=" . $lang_id . " WHERE 1 = 1 AND tbl_product_parent.parent_product_id = '" . $product_id . "'";


                //AR corect query
                $querysql = "SELECT tbl_product_parent.product_id, tbl_product_parent.parent_product_id, products.id, products.kgt_ref_number, products.template, products.part_name, products_country.lang_part_name,products.quantity,products.min_quantity,
                product_details.ex_stock_period,product_details.availability,  products.price,products.item_real_photo, products.item_schematic_photo, products.item_schematic_photo_status, products.item_width, products.item_height, products.item_length, products.item_weight, products.shipping_special_notes,  tbl_product_types.product_type_name,
               tbl_product_types_country.lang_product_type_name,tbl_product_types.menu_privilages
                       FROM tbl_product_parent 
                       JOIN products ON products.id = tbl_product_parent.product_id
                       JOIN product_details ON products.id = product_details.product_id
                       JOIN tbl_product_types ON tbl_product_types.id = products.product_type_id LEFT JOIN products_country ON products_country.lang_id = products.id and products_country.country_id=" . $lang_id . " 
                       LEFT JOIN tbl_product_types_country ON tbl_product_types_country.lang_id = tbl_product_types.id and tbl_product_types_country.country_id=" . $lang_id . " WHERE 1 = 1 AND tbl_product_parent.parent_product_id = '" . $product_id . "'";
       

     
        // this function return products related data with joins from different different tables
        $result = $this->db->query($querysql)->result();


        return getCartProductDetails($result, 1);
    }


    /**
     * Method getProductParent
     * This function get child products data as per the product id.
     * @param $product_id $product_id [This parameter is the product id .]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function getProductParent($product_id, $lang_id)
    {
       $querysql = "SELECT tbl_product_parent.product_id, tbl_product_parent.parent_product_id, products.id, products.kgt_ref_number, products.part_name,products_country.lang_part_name,products.quantity,products.min_quantity, products.ex_stock_period, products.price, products.price, products.item_real_photo, tbl_product_category_maker_products.model_relation.item_schematic_photo, tbl_product_category_maker_model_relation.item_schematic_photo_status, tbl_product_category_maker_model_relation.item_width, tbl_product_category_maker_model_relation.item_height, tbl_product_category_maker_model_relation.item_length, tbl_product_category_maker_model_relation.item_weight, tbl_product_category_maker_model_relation.shipping_special_notes, tbl_product_category_maker_model_relation.availability, tbl_product_category_maker_model_relation.unit_of_measurement,  tbl_product_type
        s.product_type_name,
        tbl_product_types_country.lang_product_type_name,tbl_product_types.menu_privilages, 
        FROM tbl_product_parent 
        JOIN products ON products.id = tbl_product_parent.product_id
        JOIN tbl_product_types ON tbl_product_types.id = products.product_type_id  LEFT JOIN products_country ON products_country.lang_id = products.id and products_country.country_id=" . $lang_id . " 
        LEFT JOIN tbl_product_types_country ON tbl_product_types_country.lang_id = tbl_product_types.id and tbl_product_types_country.country_id=" . $lang_id . " WHERE 1 = 1 AND tbl_product_parent.product_id = '" . $product_id . "'";

    //AR correct query 
    $querysql = "SELECT tbl_product_parent.product_id, tbl_product_parent.parent_product_id, products.id, products.kgt_ref_number, products.template, products.part_name, products_country.lang_part_name,products.quantity,products.min_quantity,
    product_details.ex_stock_period,product_details.availability,  products.price,products.item_real_photo, products.item_schematic_photo, products.item_schematic_photo_status, products.item_width, products.item_height, products.item_length, products.item_weight, products.shipping_special_notes,  tbl_product_types.product_type_name,
   tbl_product_types_country.lang_product_type_name,tbl_product_types.menu_privilages
           FROM tbl_product_parent 
           JOIN products ON products.id = tbl_product_parent.parent_product_id
           JOIN product_details ON products.id = product_details.product_id
           JOIN tbl_product_types ON tbl_product_types.id = products.product_type_id LEFT JOIN products_country ON products_country.lang_id = products.id and products_country.country_id=" . $lang_id . " 
           LEFT JOIN tbl_product_types_country ON tbl_product_types_country.lang_id = tbl_product_types.id and tbl_product_types_country.country_id=" . $lang_id . " WHERE 1 = 1 AND tbl_product_parent.product_id = '" . $product_id . "'";


//echo $querysql;

        // this function return products related data with joins from different different tables
        $result = $this->db->query($querysql)->result();


        return getCartProductDetails($result);
    }

    /**
     * Method getParentProductId
     * This Function return parent product id  according to the  product  id  passed in the parameter.
     * @param $product_id $product_id [This paramter is the id of the product.]
     *
     * @return void
     */
    function getParentProductId($product_id)
    {
        $result = array();
        $this->db->select('parent_product_id');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('tbl_product_parent');
        $result = $query->row_array();
        if (!empty($result)) {
            return $result['parent_product_id'];
        } else {
            return "";
        }
    }

    /**
     * Method get_product_types_from_model
     * This Function return product types data as per the session and offset.
     * @param $offset $offset [This parameter is the  offset number for the pagination.]
     * @param $country_id $country_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function get_product_types_from_model($offset = 0, $country_id)
    {
        $data = array();

        // This code read  session data and saved in  variables
        $session_data = $this->session->all_userdata();
        $vehicle_category_id = isset($session_data['vehicle_category_id']) ? $session_data['vehicle_category_id'] : array();
        $vehicle_category_id = array_unique(array_filter($vehicle_category_id));
        $product_type_arr    = isset($session_data['product_type']) ? $session_data['product_type'] : array();
        $product_type_arr    = array_unique(array_filter($product_type_arr));

        $session_maker_id = $this->session->userdata('maker_id');

        $session_model_id = $this->session->userdata('model_id');

        // those code get categories data as per the categories ids in the session

        if ($this->session->userdata('hide_category') == 1) {
            $totalCategory = 1;
        } else {
            $this->db->select('id');
            $this->db->where_in('id', $vehicle_category_id);
            $totalCategory = $this->db->get('tbl_vehicle_categories')->num_rows();
        }
        $data['totalCategory'] = $totalCategory;

        $this->db->select('VC.id,VC.category_name,VC.vehicle_category_icon,VCC.lang_category_name');
        $this->db->group_by('VC.id');
        $this->db->from('tbl_vehicle_categories as VC');
        $this->db->join('tbl_vehicle_categories_country as VCC', 'VCC.lang_id = VC.id and VCC.country_id=' . $country_id, 'left');
        $this->db->where_in('VC.id', $vehicle_category_id);
        $this->db->order_by("VC.category_name", 'ASC');
        $this->db->limit($this->config->item('pagination_limit'), $offset);
        $categories = $this->db->get()->result_array();
        // the categories data return data as per session and pagination limit
        if (count($categories) > 0) {
            // if category data  is not empty than this condition execute
            $i = 0;
            if ($this->session->userdata('hide_category') == 1) {
                $singleCategory = $categories[0];
                $categories     = array();
                $categories[]   = $singleCategory;
            }
            foreach ($categories as $category) {
                // this loop iterate each category and get product type accordingly
                $data['categories'][$i] = $category;
                $this->db->select('tbl_product_types.id');
                $this->db->group_by('tbl_product_types.id');
                $this->db->from('model_groups');
                $this->db->join('tbl_product_types', 'tbl_product_types.id= model_groups.product_type_id', 'left');

                if ($this->session->userdata('hide_category') == 0) {
                    $this->db->where('model_groups.category_id', $category['id']);
                }

                if (!empty($session_maker_id)) {
                    $this->db->where_in('model_groups.maker_id', $session_maker_id);
                }

                if (!empty($session_model_id)) {
                    $this->db->where_in('model_groups.model_id', $session_model_id);
                }

                if (!empty($product_type_arr)) {
                    $this->db->where_in('model_groups.product_type_id', $product_type_arr);
                }
                $data['totalItems'][$category['id']] = $this->db->get()->num_rows();

                $this->db->select('tbl_product_types.product_type_name,tbl_product_types.Product_Type_Photo,tbl_product_types.min_price,tbl_product_types.in_stock,tbl_product_types.id as id,
                tbl_product_types_country.lang_product_type_name');
                $this->db->group_by('tbl_product_types.id');
                $this->db->from('model_groups');
                $this->db->join('tbl_product_types', 'tbl_product_types.id= model_groups.product_type_id', 'left');
                $this->db->join('tbl_product_types_country', 'tbl_product_types_country.lang_id = tbl_product_types.id AND tbl_product_types_country.country_id =' . $this->lang->default_lang_id, 'LEFT');

                if ($this->session->userdata('hide_category') == 0) {
                    $this->db->where('model_groups.category_id', $category['id']);
                }

                if (!empty($session_maker_id)) {
                    $this->db->where_in('model_groups.maker_id', $session_maker_id);
                }

                if (!empty($session_model_id)) {
                    $this->db->where_in('model_groups.model_id', $session_model_id);
                }

                if (!empty($product_type_arr)) {
                    $this->db->where_in('model_groups.product_type_id', $product_type_arr);
                }

                $this->db->limit($this->config->item('pagination_limit'), $offset);
                $items = $this->db->get()->result_array();

                $data['categories'][$i]['items'] = $items;

                $i++;
            }


            //  exit;
        }
        return $data;
    }

    /**
     * Method get_product_types_by_categoryId
     * This Function return  Product types data as per the  category id , session data , offset and country id.
     * @param $categoryId $categoryId [This parameter is the category id/]
     * @param $offset $offset [This parameter is the  offset number for the pagination.]
     * @param $country_id $country_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function get_product_types_by_categoryId($categoryId, $offset, $country_id)
    {
        $data = array();

        // This code read  session data and saved in  variables
        $session_data = $this->session->all_userdata();
        $vehicle_category_id = isset($session_data['vehicle_category_id']) ? $session_data['vehicle_category_id'] : array();
        $vehicle_category_id = array_unique(array_filter($vehicle_category_id));
        $product_type_arr    = isset($session_data['product_type']) ? $session_data['product_type'] : array();
        $product_type_arr    = array_unique(array_filter($product_type_arr));

        $session_maker_id = $this->session->userdata('maker_id');

        $session_model_id = $this->session->userdata('model_id');


        $this->db->select('tbl_product_types.product_type_name,tbl_product_types.Product_Type_Photo,tbl_product_types.min_price,tbl_product_types.in_stock,tbl_product_types.id as id,
        tbl_product_types_country.lang_product_type_name');
        $this->db->group_by('tbl_product_types.id');
        $this->db->from('model_groups');
        $this->db->join('tbl_product_types', 'tbl_product_types.id= model_groups.product_type_id', 'left');
        $this->db->join('tbl_product_types_country', 'tbl_product_types_country.lang_id = tbl_product_types.id AND tbl_product_types_country.country_id =' . $this->lang->default_lang_id, 'LEFT');

        if ($this->session->userdata('hide_category') == 0) {
            $this->db->where('model_groups.category_id', $categoryId);
        }

        if (!empty($session_maker_id)) {
            $this->db->where_in('model_groups.maker_id', $session_maker_id);
        }

        if (!empty($session_model_id)) {
            $this->db->where_in('model_groups.model_id', $session_model_id);
        }

        if (!empty($product_type_arr)) {
            $this->db->where_in('P.product_type_id', $product_type_arr);
        }

        $this->db->limit($this->config->item('pagination_limit'), $offset);

        $data = $this->db->get()->result_array();

        // this query return product type data as per session data and pagination limit
        return $data;
    }
    /**
     * Method get_products_by_makers_cats_pair
     * This function get all products as per session values and offset.
     * @param $limit $limit [explicite description]
     * @param $offset $offset [This parameter is the  offset number for the pagination.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     * @param $returnAllProduct $returnAllProduct [This parameter is the return all the product items without any filter data.]
     *
     * @return void
     */
    function get_products_by_makers_cats_pair($return, $lang_id, $limit = 0, $offset = 0, $returnAllProduct = 0)
    {
      
        // This code read  session data and saved in  variables
        $session_data = $this->session->all_userdata();
        if ($returnAllProduct == 0) {
            if ($this->session->userdata('hide_category') == 0) {
                $vehicle_category_id = isset($session_data['vehicle_category_id']) ? $session_data['vehicle_category_id'] : array();
            } else {
                $vehicle_category_id = array();
            }
            $session_maker_array    = isset($session_data['maker_id']) ? $session_data['maker_id'] : array();

            $session_model_array    = isset($session_data['model_id']) ? $session_data['model_id'] : array();

            $product_type_arr    = isset($session_data['product_type']) ? $session_data['product_type'] : array();
        } else {

            $product_type_arr = $session_maker_array   =  $session_model_array   =   $session_maker_array  = array();
        }

        // this function make query as per the conditions and session data
        $querysql = "SELECT distinct(P.id), P.kgt_ref_number,P.part_name,P.hide_partid, products_country.lang_part_name, P.quantity,P.min_quantity,P.price, P.item_real_photo, P.item_schematic_photo, P.item_schematic_photo_status, P.item_width, P.item_height, P.item_length, P.item_weight, P.shipping_special_notes,products_country.lang_shipping_special_notes,  tbl_product_types.product_type_name,tbl_product_types_country.lang_product_type_name,tbl_product_types.Product_Type_Photo as type_photo, tbl_product_types.menu_privilages,tbl_product_types_country.lang_product_type_name,tbl_product_parent.parent_product_id,distributors.name as dist_name,distributors.url as dist_url,distributors.logo as dist_logo,distributors.country as dist_country,distributors.zip_code  as dist_zip_code,P.template";
        $querysql .= " FROM product_models";
        $querysql .= " LEFT JOIN products as P ON P.id = product_models.product_id";
        $qEngineSize = $this->session->userdata('qEngineSize');

        if (!empty($qEngineSize)) {

            $qProduct_year = $this->session->userdata('qProduct_year');
            $qEngineSize = $this->session->userdata('qEngineSize');

            $querysql .= " LEFT JOIN product_items ON P.id = product_items.product_id ";
        }




        $querysql .= " 
                JOIN tbl_product_types ON tbl_product_types.id = P.product_type_id 
                LEFT JOIN tbl_product_parent ON tbl_product_parent.product_id = P.id 
                LEFT JOIN distributors ON distributors.id = P.distributor 
                LEFT JOIN products_country ON products_country.lang_id = P.id and products_country.country_id=" . $lang_id . " LEFT JOIN tbl_product_types_country ON tbl_product_types_country.lang_id = tbl_product_types.id and tbl_product_types_country.country_id=" . $lang_id . " WHERE product_models.status='1'  ";

        // this code prepare conditions array from the session data




        if (!empty($vehicle_category_id)) {
            $session_category_string = implode(',', $vehicle_category_id);
            $querysql .= " AND product_models.category_id IN ($session_category_string) ";
        }

        if (!empty($session_maker_array)) {
            $session_maker_string = implode(',', $session_maker_array);
            $querysql .= " AND product_models.maker_id IN ($session_maker_string) ";
        }

        if (!empty($session_model_array)) {
            $session_model_string = implode(',', $session_model_array);
            $querysql .= " AND product_models.model_id IN ($session_model_string) ";
        }

        if (!empty($product_type_arr)) {
            $prod_type_string = implode(',', $product_type_arr);
             if(empty($prod_type_string)) {
               $prod_type_string = $product_type_arr;
             }

            $querysql .= " AND P.product_type_id IN ($prod_type_string) ";
        }

        if (!empty($qEngineSize)) {

            $qProduct_year = $this->session->userdata('qProduct_year');
            $qEngineSize = $this->session->userdata('qEngineSize');

            if (!empty($qProduct_year)) {
                $querysql .= " AND product_items.value  = '" . $qProduct_year[0] . "'";
            }
            if (!empty($qEngineSize)) {
                $querysql .= " AND product_items.engine_size  = '" . $qEngineSize[0] . "'";
            }
        }



        $querysql .= " AND P.status = 1  ";

                $querysql .= " order by P.id asc ";


        if ($limit) {
            $querysql .= " limit " . $offset . "," . $limit;
        }




        $query = $this->db->query($querysql);

        // echo $this->db->last_query();
        // exit;

        // this function return data from the database as per the above query
        if ($return == 'list') {
            // this function return data from the database as per the above query
            $result = $query->result_array();
            // if (!empty($result)) {
            //     foreach ($result as $key => $res) {
            //         // if data is not empty than this condition works
            //         $parent = $this->db->query("SELECT id FROM tbl_product_parent WHERE parent_product_id = '" . $res['id'] . "'")->num_rows();
            //         if ($parent > 0) {
            //             // this function get child products data and append in the array
            //             $child_addded = $this->getChildProducts($res['id'], $lang_id);

            //             $result[$key]['child'] =  $child_addded;
            //         }

            //         $parent_product_id = $this->getParentProductId($res['id']);
            //         $result[$key]['parent_product_id'] = $parent_product_id;
            //     }
            // }


            // this function return json data
            return json_decode(json_encode($result));
        } else if ($return == 'total') {
            // echo $this->db->last_query();
            return $query->num_rows();
        }
    }



    /**
     * Method get_products_count
     * This function get all products as per session values and offset.
     * @param $limit $limit [explicite description]
     * @param $offset $offset [This parameter is the  offset number for the pagination.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     * @param $returnAllProduct $returnAllProduct [This parameter is the return all the product items without any filter data.]
     *
     * @return void
     */
    function get_products_count($search = "")
    {
      
        // This code read  session data and saved in  variables
        $session_data = $this->session->all_userdata();
        if ($this->session->userdata('hide_category') == 0) {
            $vehicle_category_id = isset($session_data['vehicle_category_id']) ? $session_data['vehicle_category_id'] : array();
        } else {
            $vehicle_category_id = array();
        }
        $session_maker_array    = isset($session_data['maker_id']) ? $session_data['maker_id'] : array();

        $session_model_array    = isset($session_data['model_id']) ? $session_data['model_id'] : array();

        $product_type_arr    = isset($session_data['product_type']) ? $session_data['product_type'] : array();
        

        // this function make query as per the conditions and session data
        $querysql = "SELECT distinct(P.id)";
        $querysql .= " FROM product_models";
        $querysql .= " LEFT JOIN products as P ON P.id = product_models.product_id";
        $qEngineSize = $this->session->userdata('qEngineSize');

        if (!empty($qEngineSize)) {
            $qProduct_year = $this->session->userdata('qProduct_year');
            $qEngineSize = $this->session->userdata('qEngineSize');
            $querysql .= " LEFT JOIN product_items ON P.id = product_items.product_id ";
        }
        $querysql .= " 
                JOIN tbl_product_types ON tbl_product_types.id = P.product_type_id 
                LEFT JOIN tbl_product_parent ON tbl_product_parent.product_id = P.id 
                LEFT JOIN products_country ON products_country.lang_id = P.id LEFT JOIN tbl_product_types_country ON tbl_product_types_country.lang_id = tbl_product_types.id  WHERE product_models.status='1'  ";

        if (!empty($vehicle_category_id)) {
            $session_category_string = implode(',', $vehicle_category_id);
            $querysql .= " AND product_models.category_id IN ($session_category_string) ";
        }

        if (!empty($session_maker_array)) {
            $session_maker_string = implode(',', $session_maker_array);
            $querysql .= " AND product_models.maker_id IN ($session_maker_string) ";
        }

        if (!empty($session_model_array)) {
            $session_model_string = implode(',', $session_model_array);
            $querysql .= " AND product_models.model_id IN ($session_model_string) ";
        }

        if (!empty($product_type_arr)) {
            $prod_type_string = implode(',', $product_type_arr);
             if(empty($prod_type_string)) {
               $prod_type_string = $product_type_arr;
             }

            $querysql .= " AND P.product_type_id IN ($prod_type_string) ";
        }

        if (!empty($qEngineSize)) {

            $qProduct_year = $this->session->userdata('qProduct_year');
            $qEngineSize = $this->session->userdata('qEngineSize');

            if (!empty($qProduct_year)) {
                $querysql .= " AND product_items.value  = '" . $qProduct_year[0] . "'";
            }
            if (!empty($qEngineSize)) {
                $querysql .= " AND product_items.engine_size  = '" . $qEngineSize[0] . "'";
            }
        }

        if($search != '') {
            $querysql .= " AND P.kgt_ref_number LIKE '%".$search."%' ";
            }

        $querysql .= " AND P.status = 1  ";
        $query = $this->db->query($querysql);

        // echo $this->db->last_query();
        // exit;
        // echo $this->db->last_query();
        return $query->num_rows();
        
    }


    function product_list_dropdown($limit = 0,$offset = 0,$search = "")
    {
        // This code read  session data and saved in  variables
        $session_data = $this->session->all_userdata();
        if ($this->session->userdata('hide_category') == 0) {
            $vehicle_category_id = isset($session_data['vehicle_category_id']) ? $session_data['vehicle_category_id'] : array();
        } else {
            $vehicle_category_id = array();
        }
        $session_maker_array    = isset($session_data['maker_id']) ? $session_data['maker_id'] : array();

        $session_model_array    = isset($session_data['model_id']) ? $session_data['model_id'] : array();

        $product_type_arr    = isset($session_data['product_type']) ? $session_data['product_type'] : array();
        

        // this function make query as per the conditions and session data
        $querysql = "SELECT distinct(P.id),P.item_real_photo,P.kgt_ref_number";
        $querysql .= " FROM product_models";
        $querysql .= " LEFT JOIN products as P ON P.id = product_models.product_id";
        $qEngineSize = $this->session->userdata('qEngineSize');

        if (!empty($qEngineSize)) {
            $qProduct_year = $this->session->userdata('qProduct_year');
            $qEngineSize = $this->session->userdata('qEngineSize');
            $querysql .= " LEFT JOIN product_items ON P.id = product_items.product_id ";
        }
        $querysql .= " 
                JOIN tbl_product_types ON tbl_product_types.id = P.product_type_id 
                LEFT JOIN tbl_product_parent ON tbl_product_parent.product_id = P.id 
                LEFT JOIN products_country ON products_country.lang_id = P.id LEFT JOIN tbl_product_types_country ON tbl_product_types_country.lang_id = tbl_product_types.id  WHERE product_models.status='1'  ";

        if (!empty($vehicle_category_id)) {
            $session_category_string = implode(',', $vehicle_category_id);
            $querysql .= " AND product_models.category_id IN ($session_category_string) ";
        }

        if (!empty($session_maker_array)) {
            $session_maker_string = implode(',', $session_maker_array);
            $querysql .= " AND product_models.maker_id IN ($session_maker_string) ";
        }

        if (!empty($session_model_array)) {
            $session_model_string = implode(',', $session_model_array);
            $querysql .= " AND product_models.model_id IN ($session_model_string) ";
        }

        if (!empty($product_type_arr)) {
            $prod_type_string = implode(',', $product_type_arr);
             if(empty($prod_type_string)) {
               $prod_type_string = $product_type_arr;
             }

            $querysql .= " AND P.product_type_id IN ($prod_type_string) ";
        }

        if (!empty($qEngineSize)) {

            $qProduct_year = $this->session->userdata('qProduct_year');
            $qEngineSize = $this->session->userdata('qEngineSize');

            if (!empty($qProduct_year)) {
                $querysql .= " AND product_items.value  = '" . $qProduct_year[0] . "'";
            }
            if (!empty($qEngineSize)) {
                $querysql .= " AND product_items.engine_size  = '" . $qEngineSize[0] . "'";
            }
        }

        $querysql .= " AND P.status = 1  ";

        if($search != '') {
        $querysql .= " AND P.kgt_ref_number LIKE '%".$search."%' ";
        }

        $querysql .= " order by P.id asc ";


        if ($limit) {
        $querysql .= " limit " . $offset . "," . $limit;
        }

        $query = $this->db->query($querysql);
      
        // echo $this->db->last_query();
        // exit;
       // echo $this->db->last_query();

        $data = $query->result_array();
        return $data;
        
    }

    /**
     * Method getEngineSizeBasedProductId
     *  This Function get related product id based on model and enine size.
     * @param $search_engine_size $search_engine_size [This parameter is the maker id]
     * @param $model_ids $model_ids [This parameter is the maker id]
     * @return void
     */
    public function getEngineSizeBasedProductId($search_engine_size, $model_ids)
    {
        // $this->db->select('GROUP_CONCAT(DISTINCT(pir.product_id)) as productIds');
        // $this->db->where('pird.product_item_id',2);
        // $this->db->where_in('pir.product_model_id',$model_ids);
        // $this->db->where('pird.value',$search_engine_size);
        // $this->db->from('tbl_product_item_relation_dropdown as pird');
        // $this->db->join('tbl_product_item_relation as pir','pir.id = pird.product_item_relation_id');
        // $result = $this->db->get()->row_array();
        // return $result['productIds'] ? $result['productIds'] : 0;

        $qProduct_year = $this->session->userdata('qProduct_year')[0];

        $this->db->select('GROUP_CONCAT(DISTINCT(pird.product_id)) as productIds');
        $this->db->where('pird.product_item_id', 1);
        $this->db->where_in('pird.product_model_id', $model_ids);
        $this->db->where('pird.value', $qProduct_year);
        $this->db->where('pird.engine_size', $search_engine_size);
        $this->db->from('tbl_product_item_relation_dropdown as pird');
        $result = $this->db->get()->row_array();
        $yearBasedProductIds = $result['productIds'] ? explode(',', $result['productIds']) : array();
        $productId = 0;

        if (count($yearBasedProductIds) > 0) {
            $productId =  implode(',', $yearBasedProductIds);
        } else {
            $productId = 0;
        }
        return $productId;
    }

    function makes_storewise_qty_column(){
        $quantity_array = array();
        $store_data = $this->comman_model->get_row_array('store',"*",array('status'=>1));
        
        $all_language_data  = get_admin_lang_data(array('admin_products'), $this->lang->default_lang_id);
        $admin_products = $all_language_data['admin_products'];
        $store_array = array();
        foreach ($store_data as $s){
            $storename = preg_replace('/\s+/', '__', $s['name']);            
            $store_array[$s['id']] = $admin_products['quantity']['front']."/".$storename;            
        }
        //echo '<pre>';print_r($store_array);exit;
        return $store_array;
    }

    /**
     * Method makes_attributes_column
     * This Function return product attributes as per the language id.
     * @return void
     */
    function makes_attributes_column()
    {
        $csv_array = array();
        // this function return all attributes as per the language id
        $attributes = $this->product_items_model->getallproductitems();
        $country_data = $this->comman_model->get_data_by_id('country', array('id' => $this->lang->default_lang_id));


        // this function return all admin title  as per the language id
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_title', 'admin_importdata'), $this->lang->default_lang_id);
        $admin_title = $all_language_data['admin_title'];
        $items_name = array();

        // this function return all field type name   as per the language id
        $admin_static_links = $all_language_data['admin_static_links'];

        $field_types = array_flip(array($admin_static_links['text_editor']['front'] => "text_editor",$admin_static_links['field_text']['front'] => "text", $admin_static_links['field_image']['front'] => "image", $admin_static_links['field_dropdown']['front'] => "dropdown"));
        
        $attributes = $this->comman_model->all_data('tbl_product_items');
        foreach ($attributes as $main_array) {
            if ($this->lang->default_lang_id != 13) {
                if ($main_array['lang_item_name']) {

                    $itemname = $main_array['lang_item_name'];
                } else {
                    $itemname = $main_array['item_name'];
                }
            } else {
                $itemname = $main_array['item_name'];
            }
            // this code append column name as per language id in the array
            $item_name = preg_replace('/\s+/', '__', $itemname);
            // $csv_array[] = $admin_title['attribute_csv']['front'] . "/" . $item_name . '/' . $admin_title['csv_frontend']['front'];
            //  $csv_array[] = $admin_title['attribute_csv']['front'] . "/" . $item_name . '/' . $admin_title['csv_backend']['front'];
            $csv_array[$main_array['id']] = $admin_title['attribute_csv']['front'] . "/" . $item_name . '/' . $field_types[$main_array['field_type']];

            $items_name[$main_array['id']] = $main_array;

            // New addition for use name
            $items_count_field[$main_array['id']] = $country_data['name'] . "_" . $admin_title['attribute_csv']['front'] . "/" . $item_name . '/' . $field_types[$main_array['field_type']];

            $items_field[$main_array['id']] = $admin_title['attribute_csv']['front'] . "/" . $item_name . '/' . $field_types[$main_array['field_type']];
        }
        // this is the final return data
        $result = array(
            "attributes" => $csv_array, 
            "items_name" => $items_name, 
            'field_types' => $field_types, 
            "items_field" => $items_field, 
            "items_count_field" => $items_count_field, 
            'attribute_title' => $admin_title['attribute_csv']['front']
        );
        
        return $result;
    }

    /**
     * Method update_product_on_delete_maker
     *
     *  This Function remove maker id from tbl_product_category_maker_model_relation  table rows as per the maker id passed in the parameter.
     * @param $maker_id $maker_id [This parameter is the maker id]
     *
     * @return void
     */
    function update_product_on_delete_maker($maker_id)
    {

        $sql_query = "SELECT * FROM `product_models` WHERE `maker_id` = '" . $maker_id . "' OR `maker_id` LIKE '" . $maker_id . ",%' OR `maker_id` LIKE '%," . $maker_id . ",%' OR `maker_id` LIKE '%," . $maker_id . "' ";
        $query = $this->db->query($sql_query);
        // this code return rows as per the maker id from the table tbl_product_category_maker_model_relation
        $result = $query->result_array();
        if ($result) {
            foreach ($result as $row) {
                // this loop iterate each product and update maker id column  in the row

                $maker_array =  explode(",", $row['maker_id']);
                if (in_array($maker_id, $maker_array)) {
                    //delete maker id from array
                    if (($key = array_search($maker_id, $maker_array)) !== false) {
                        unset($maker_array[$key]);
                    }
                    $update_data = array(
                        'maker_id' => implode(',', $maker_array)
                    );
                    // this function update row of the tbl_product_category_maker_model_relation table
                    $this->comman_model->update_where('product_models', $update_data, array('id' => $row['id']));
                }
            }
        }
    }

    /**
     * update_product_on_delete_category
     * This Function remove category id from products relation table rows.
     * @return void
     */
    function update_product_on_delete_category($category_id)
    {
        
        $sql_query = "SELECT * FROM `product_models` WHERE `category_id` = '" . $category_id . "' OR `category_id` LIKE '" . $category_id . ",%' OR `category_id` LIKE '%," . $category_id . ",%' OR `category_id` LIKE '%," . $category_id . "' ";
        $query = $this->db->query($sql_query);
        $result = $query->result_array();
        
        if ($result) {
            foreach ($result as $row) {

                $category_array =  explode(",", $row['category_id']);
                if (in_array($category_id, $category_array)) {
                    //delete maker id from array
                    if (($key = array_search($category_id, $category_array)) !== false) {
                        unset($category_array[$key]);
                    }
                    $update_data = array(
                        'category_id' => implode(',', $category_array)
                    );
                    $this->comman_model->update_where(' product_models', $update_data, array('id' => $row['id']));
                }
            }
        }
    }

    /**
     * Method update_product_on_delete_package
     *
     *  This Function remove package id from  tbl_makers table rows as per the package id passed in the parameter.
     * @param $packageId $packageId [This parameter is the package id]
     *
     * @return void
     */
    function update_product_on_delete_package($packageId)
    {

        $sql_query = "SELECT id,packageId FROM `products` WHERE `packageId` = '" . $packageId . "' OR `packageId` LIKE '" . $packageId . ",%' OR `packageId` LIKE '%," . $packageId . ",%' OR `packageId` LIKE '%," . $packageId . "' ";
        $query = $this->db->query($sql_query);
        // this code return rows as per the maker id from the table tbl_product_category_maker_model_relation
        $result = $query->result_array();
        if ($result) {
            foreach ($result as $row) {
                // this loop iterate each product and update maker id column  in the row

                $package_array =  array_filter(explode(",", $row['packageId']));
                if (in_array($packageId, $package_array)) {
                    //delete maker id from array
                    if (($key = array_search($packageId, $package_array)) !== false) {
                        unset($package_array[$key]);
                    }
                    $package_array =  array_filter($package_array);
                    if (count($package_array) > 0) {
                        $update_data = array(
                            'packageId' => implode(',', $package_array)
                        );
                    } else {
                        $update_data = array(
                            'packageId' => '',
                            'status'    => 0
                        );
                    }

                    // this function update row of the tbl_product_category_maker_model_relation table
                    $this->comman_model->update_where('tbl_product_category_maker_model_relation', $update_data, array('id' => $row['id']));
                }
            }
        }
    }

    function empty_images_product(){
        $querysql = "select kgt_ref_number from products where item_real_photo='' ";
        $query = $this->db->query($querysql);
        //    echo $this->db->last_query();die;
           return $query->result_array();

    }
    /**
     * Method get_all_products_for_csv
     * This Function return all products data from database.
     * @param $lang_id $lang_id [explicite description]
     *
     * @return void
     */
    function get_all_products_for_csv($lang_id, $postdata)
    {   
        // echo "<pre>";print_r($postdata);die;
        // This Function return product attributes as per the language id.
        $data = $this->makes_attributes_column();
        
        $store_wise_qty_column = $this->makes_storewise_qty_column();
        //print_r($store_wise_qty_column);
        foreach ($store_wise_qty_column as $sid=>$sq){
            $query_append .= " (select quantity from products_count where product_id = products.id and store_id = $sid) as '". $sq."', ";
        }
  
        $country_data = $this->comman_model->get_data_by_id('country', array('id' => $this->lang->default_lang_id));

        
        $all_language_data  = get_admin_lang_data(array('admin_static_links', 'admin_title', 'admin_importdata'), $this->lang->default_lang_id);
        
        $admin_title = $all_language_data['admin_title'];
        $csv_array   = $data['attributes'];
        $items_name  = $data['items_name'];
        $field_types = $data['field_types'];
        // $admin_title = get_user_lang_data(array('admin_title'), $this->lang->default_lang_id)['admin_title'];
      
            if($lang_id==13){
                
                $querysql = "SELECT 
                tbl_vehicle_categories.category_name as a,
                tbl_vehicle_categories.category_name as category_name_a,
                tbl_vehicle_categories.VehicleType_Photo as VehicleType_Photo,
                tbl_makers.maker_name as Machinename,
                tbl_makers.maker_name as English_Machinename,
                tbl_makers.maker_logo as maker_logo,
                tbl_models.model_name as model_name,
                tbl_models.model_name as Englis_model_name,
                tbl_models.model_photo as model_photo,
                industries.name as names,
                industries.name as lang_name,
                industries.icon as icon,
                industries.description as descriptions,
                industries.description as lang_description,
                industries.status as statuse,
                products.item_schematic_photo_status as item_schematic_photo_status,
                products.item_schematic_photo as item_schematic_photo,
                products.item_real_photo as item_real_photo,
                tbl_product_natures.name as sname,
                tbl_product_natures.name as lang_names,
                products.kgt_ref_number as kgt_ref_number,
                tbl_product_types.product_type_name as v,
                tbl_product_types.product_type_name as lang_product_type_name, 
                products.part_name as part_name,
                products.part_name as part_names,
                tbl_product_types.Product_Type_Photo as Product_Type_Photo,
                products.kgt_ref_number as 'Unit_Of_Measurement',
                products.kgt_ref_number as 'English_Unit_Of_Measurement',
                products.item_weight as item_weight,
                products.item_length as item_length,
                products.item_width as item_width,
                products.item_height as item_height,
                products.price,
                admin_countries.country_name as country_name,
                products.quantity as Existing_Quantity,
                $query_append
                products.min_quantity as Minimum_Quantity,
                product_details.quantity_threshold as ao,
                product_details.replenishment_order_number,
                product_details.replenishment_order_date,
                product_details.replenishing_period as ar,
                product_details.replenishing_period_tolerance_range as replenishing_period_tolerance_range,
                products.shipping_special_notes as shipping_special_notes,
                products.shipping_special_notes as lang_shipping_special_notes,
                products.packageId as packageId,
                products.display_kondarsoft as display_kondarsoft,
                distributors.name as distributors,
                products.template as template,
            product_items.value as '".$data['attributes'][1]."',
            product_items.engine_size as '".$data['attributes'][2]."',
            product_items.position as '".$data['attributes'][167]."',
            product_items.vehicle_attributes as '".$data['attributes'][168]."',
            product_items.application_notes as '".$data['attributes'][169]."',
            products.id as id
           FROM products 

           LEFT join products_country On products_country.lang_id = products.id and products_country.country_id=" . $lang_id . " 
           LEFT join product_details On product_details.product_id = products.id
           LEFT join distributors On distributors.id = products.distributor
           LEFT join tbl_product_natures On products.item_nature_id = tbl_product_natures.id
           LEFT join tbl_product_natures_country On tbl_product_natures_country.lang_id = tbl_product_natures.id  and tbl_product_natures_country.country_id=" . $lang_id . "
           LEFT join product_items On product_items.product_id = products.id
           left join tbl_product_types on products.product_type_id=tbl_product_types.id
           left join tbl_product_types_country on tbl_product_types_country.lang_id=tbl_product_types.id  and tbl_product_types_country.country_id=" . $lang_id . "
           LEFT join product_models On product_models.product_id = product_items.product_id and product_items.model_id = product_models.model_id
           Left join tbl_vehicle_categories on product_models.category_id = tbl_vehicle_categories.id
           Left join tbl_vehicle_categories_country on tbl_vehicle_categories_country.lang_id = tbl_vehicle_categories.id  and tbl_vehicle_categories_country.country_id=" . $lang_id . "
           Left join industries on tbl_vehicle_categories.industries = industries.id
           Left join industries_country on industries_country.lang_id = industries.id and industries_country.country_id=" . $lang_id . "
           left JOIN tbl_models on tbl_models.id = product_models.model_id
           left JOIN tbl_models_country on tbl_models_country.lang_id = tbl_models.id and tbl_models_country.country_id=" . $lang_id . "
           left JOIN tbl_makers on tbl_makers.id = product_models.maker_id
           left JOIN tbl_makers_country on tbl_makers_country.lang_id = tbl_makers.id and tbl_makers_country.country_id=" . $lang_id . " 
           left join admin_countries on products.country_id = admin_countries.id";
           //where products.id IN(".implode(',',$postdata['selected_products']).")";
            if(!empty($postdata['selected_products']))
            {
            $querysql.= " where products.id IN(".implode(',',$postdata['selected_products']).")";
            } else if(!empty($postdata['product_id']))
            {
                $query_products = "select id from products where  products.id >= ".$postdata['product_id']." limit ".$postdata['limit'];
                $query_products_sql = $this->db->query($query_products);
                $query_data = $query_products_sql->result_array();
                $selc_prod = array();
                foreach($query_data as $single_data){
                    $selc_prod[] = $single_data['id'];

                }


                    $querysql.= " where products.id IN(".implode(',',$selc_prod).")";

                    }
                $query = $this->db->query($querysql);
                //echo $this->db->last_query();die;
                return $query->result_array();
            }else{
                $querysql = "SELECT 
                tbl_vehicle_categories.category_name as a,
                (case when (tbl_vehicle_categories_country.lang_category_name IS NULL or tbl_vehicle_categories_country.lang_category_name = '') THEN tbl_vehicle_categories.category_name ELSE tbl_vehicle_categories_country.lang_category_name END) as lang_category_name,
                tbl_vehicle_categories.VehicleType_Photo as VehicleType_Photo,
                tbl_makers.maker_name as Machinename,
                (case when (tbl_makers_country.lang_maker_name IS NULL or tbl_makers_country.lang_maker_name = '') THEN tbl_makers.maker_name ELSE tbl_makers_country.lang_maker_name END) as lang_maker_name,
                tbl_makers.maker_logo as maker_logo,
                tbl_models.model_name as model_name,
                (case when (tbl_models_country.lang_model_name IS NULL or tbl_models_country.lang_model_name = '') THEN tbl_models.model_name ELSE tbl_models_country.lang_model_name END) as lang_modal_name,
                tbl_models.model_photo as model_photo,
                industries.name as names,
                (case when (industries_country.lang_name IS NULL or industries_country.lang_name = '') THEN industries.name ELSE industries_country.lang_name END) as lang_industries_name,
                industries.icon as icon,
                industries.description as descriptions,
                (case when (industries_country.lang_description IS NULL or industries_country.lang_description = '') THEN industries.description ELSE industries_country.lang_description END) as lang_industries_desc,
                industries.status as statuse,
                products.item_schematic_photo_status as item_schematic_photo_status,
                products.item_schematic_photo as item_schematic_photo,
                products.item_real_photo as item_real_photo,
                tbl_product_natures.name as sname,
                (case when (tbl_product_natures_country.lang_name IS NULL or tbl_product_natures_country.lang_name = '') THEN tbl_product_natures.name ELSE tbl_product_natures_country.lang_name END) as lang_nature,
                products.kgt_ref_number as kgt_ref_number,
                tbl_product_types.product_type_name as v,
                (case when (tbl_product_types_country.lang_product_type_name IS NULL or tbl_product_types_country.lang_product_type_name = '') THEN tbl_product_types.product_type_name ELSE tbl_product_types_country.lang_product_type_name END) as lang_product_type,
                products.part_name as part_name,
                (case when (products_country.lang_part_name IS NULL or products_country.lang_part_name = '') THEN products.part_name ELSE products_country.lang_part_name END) as lang_part_name,
                tbl_product_types.Product_Type_Photo as Product_Type_Photo,
                products.kgt_ref_number as 'Unit_Of_Measurement',
                products.kgt_ref_number as 'English_Unit_Of_Measurement',
                products.item_weight as item_weight,
                products.item_length as item_length,
                products.item_width as item_width,
                products.item_height as item_height,
                products.price,
                admin_countries.country_name as country_name,
                products.quantity as Existing_Quantity,
                $query_append
                products.min_quantity as Minimum_Quantity,
                product_details.quantity_threshold as ao,
                product_details.replenishment_order_number,
                product_details.replenishment_order_date,
                product_details.replenishing_period as ar,
                product_details.replenishing_period_tolerance_range as replenishing_period_tolerance_range,
                products.shipping_special_notes as shipping_special_notes,
                (case when (products_country.lang_shipping_special_notes IS NULL or products_country.lang_shipping_special_notes = '') THEN products.shipping_special_notes ELSE products_country.lang_shipping_special_notes END) as lang_shipping_notes,
                products.packageId as packageId,
                products.display_kondarsoft as display_kondarsoft,
                distributors.name as distributors,
                products.template as template,
            product_items.value as '".$data['attributes'][1]."',
            product_items.engine_size as '".$data['attributes'][2]."',
            product_items.position as '".$data['attributes'][167]."',
            product_items.vehicle_attributes as '".$data['attributes'][168]."',
            product_items.application_notes as '".$data['attributes'][169]."',
            products.id as id
           FROM products 
           LEFT join products_country On products_country.lang_id = products.id and products_country.country_id=" . $lang_id . " 
           LEFT join product_details On product_details.product_id = products.id
           LEFT join distributors On distributors.id = products.distributor
           LEFT join tbl_product_natures On products.item_nature_id = tbl_product_natures.id
           LEFT join tbl_product_natures_country On tbl_product_natures_country.lang_id = tbl_product_natures.id  and tbl_product_natures_country.country_id=" . $lang_id . "
           LEFT join product_items On product_items.product_id = products.id
           left join tbl_product_types on products.product_type_id=tbl_product_types.id
           left join tbl_product_types_country on tbl_product_types_country.lang_id=tbl_product_types.id  and tbl_product_types_country.country_id=" . $lang_id . "
           LEFT join product_models On product_models.product_id = product_items.product_id and product_items.model_id = product_models.model_id
           Left join tbl_vehicle_categories on product_models.category_id = tbl_vehicle_categories.id
           Left join tbl_vehicle_categories_country on tbl_vehicle_categories_country.lang_id = tbl_vehicle_categories.id  and tbl_vehicle_categories_country.country_id=" . $lang_id . "
           Left join industries on tbl_vehicle_categories.industries = industries.id
           Left join industries_country on industries_country.lang_id = industries.id and industries_country.country_id=" . $lang_id . "
           left JOIN tbl_models on tbl_models.id = product_models.model_id
           left JOIN tbl_models_country on tbl_models_country.lang_id = tbl_models.id and tbl_models_country.country_id=" . $lang_id . "
           left JOIN tbl_makers on tbl_makers.id = product_models.maker_id
           left JOIN tbl_makers_country on tbl_makers_country.lang_id = tbl_makers.id and tbl_makers_country.country_id=" . $lang_id . " 
           left join admin_countries on products.country_id = admin_countries.id";
           if(!empty($postdata['selected_products']))
           {
            $querysql.= " where products.id IN(".implode(',',$postdata['selected_products']).")";
           }
            if(!empty($postdata['limit']))
            {
               $querysql.= " limit ".$postdata['limit'];
            
           }
           
           $query = $this->db->query($querysql);

           return $query->result_array();
            }
            
           
    }

    /**
     * Method getChildProducts
     * This function get child products data as per the product id.
     * @param $product_id $product_id [This parameter is the product id .]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function getChildProducts($product_id)
    {
        $querysql = "SELECT tbl_product_parent.product_id, tbl_product_parent.parent_product_id FROM tbl_product_parent  WHERE tbl_product_parent.parent_product_id = '" . $product_id . "'";

        // this function return products related data with joins from different different tables
        $result = $this->db->query($querysql)->result_array();
        return  $result;
    }

    /**
     * Method getProductMakersModelsArray
     * This Function return the maker and model array  as per the product id.
     * @param $product_id $product_id [explicite description]
     *
     * @return array
     */
    function getProductMakersModelsArray($product_id)
    {
        // this function return  row from the  products table as per the product id 
        $product_row = $this->db->get_where('product_models', array('id' => $product_id))->row_array();
        $makers = explode(',', $product_row['maker_id']);
        return $this->get_maker_by_language($makers, $product_row['model_id'], $this->lang->default_lang_id);
    }

    /**
     * Method get_maker_by_language
     * This function return single maker data by maker id and language id
     * @param $maker_id $maker_id [This parameter is the maker id.]
     * @param $country_id $country_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function get_maker_by_language($maker_id, $model_id, $country_id)
    {
        // this function return maker data as per maker id and country id
        $this->db->select('tbl_makers.*, tbl_makers_country.lang_maker_name');
        $this->db->from('tbl_makers as tbl_makers');
        $this->db->join('tbl_makers_country as tbl_makers_country', 'tbl_makers.id=tbl_makers_country.lang_id and tbl_makers_country.country_id=' . $country_id, 'left');
        $this->db->where_in('tbl_makers.id', $maker_id);
        $results = $this->db->get()->result_array();

        $makers_arr = $nameList = array();
        // this function replace language variable in the array
        foreach ($results as $value) {
            $value['maker_name'] = $value['lang_maker_name'] = (isset($value['lang_maker_name']) && $value['lang_maker_name']) ? $value['lang_maker_name'] : $value['maker_name'];
            // this function return model data by maker id and model ids
            $models_rows = $this->get_model_by_language($value['id'], $model_id, $this->lang->default_lang_id);
            $modelName   = array();
            foreach ($models_rows as $row) {
                $modelName[] = (isset($row['lang_model_name']) && $row['lang_model_name']) ? $row['lang_model_name'] : $row['model_name'];
            }
            // this code append string  in the  array
            $nameList[] =  $value['maker_name'] . " ---> " . implode(",", $modelName);

            // this code append data in the array 
            $value['models'] =  $models_rows;
            $makers_arr[$value['id']] = $value;
        }

        $finalData = array(
            'maker'         => $makers_arr,
            'final_string'  => implode(" , ", $nameList)
        );
        return $finalData;
    }

    /**
     * Method get_model_by_language
     * This Function return models rows as per the language id , maker and models ids.
     * @param $maker_id $maker_id [This Parameter is the maker id.]
     * @param $models $models [This Parameter is the modeld ids string.]
     * @param $country_id $country_id [This parameter is the country id for language data.]
     *
     * @return array 
     */
    function get_model_by_language($maker_id, $models, $country_id)
    {
        // this function get model rows as per maker and model id
        $prod_models = explode(',', $models);
        $this->db->select('tbl_models.*,tbl_models_country.*');
        $this->db->from('tbl_models as tbl_models');
        $this->db->join('tbl_models_country as tbl_models_country', 'tbl_models.id=tbl_models_country.lang_id and tbl_models_country.country_id=' . $country_id, 'left');
        $this->db->where("tbl_models.maker_id", $maker_id);
        $this->db->where_in("tbl_models.id", $prod_models);
        $result = $this->db->get()->result_array();

        // this function update language parameters 
        $finalresult = updateLanguageParameters($result);
        return  $finalresult;
    }

    /**
     * Method getModelIdfromSameProductName
     * This Function return model rows on the behalf of models ids passed in the parameter.
     * @param $model_id $model_id [This parameter is the array of models ids.]
     *
     * @return void
     */
    function getModelIdfromSameProductName($model_id)
    {
        $this->db->select('id,model_name');
        $this->db->where_in('id', $model_id);
        $results  = $this->db->get('tbl_models')->result_array();
        // this code get rows from the table   tbl_models as per ids passed
        $response = array();
        if (count($results) > 0) {
            foreach ($results as $result) {
                // this loop iterate each model and add append data in the array
                $this->db->select('id, maker_id');
                $q1 = $this->db->get_where('tbl_models', array('model_name' => $result['model_name']));
                $response[$result['id']] = $q1->result_array();
            }
        }
        return $response;
    }

    /**
     * Method getAllEditProducts
     * This Function return records from tbl_product_parent  as per the product id passed as the parameter.
     * @param $id $id [This paramter is the product id.]
     *
     * @return void
     */
    function getAllEditProducts($product_id)
    {
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('tbl_product_parent');
        return $query->result_array();
    }


     /**
     * Method getproduct_distributor
     * This Function return records from getproduct_distributor  as per the product id passed as the parameter.
     * @param $id $id [This paramter is the product id.]
     *
     * @return void
     */
    function getproduct_distributor($product_id)
    {
        $this->db->select('distributor_id');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('product_distributors');
        $data =  $query->result_array();
        $pro_dist = array();
        if(!empty($data)){
            $pro_dist = array_column($data, 'distributor_id');
        }
        return $pro_dist;
    }

     /**
     * Method getproduct_distributor
     * This Function return records from getproduct_distributor  as per the product id passed as the parameter.
     * @param $id $id [This paramter is the product id.]
     *
     * @return void
     */
    function getproduct_distributor_name($product_id)
    {
        $this->db->select('product_distributors.distributor_id,distributors.name');
        $this->db->join('distributors', 'product_distributors.distributor_id = distributors.id');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('product_distributors');
        $data =  $query->result_array();
        $pro_dist = array();
        if(!empty($data)){
            $pro_dist = array_column($data, 'name');
        }
        return $pro_dist;
    }


       /**
     * Method getproduct_distributor
     * This Function return records from getproduct_distributor  as per the product id passed as the parameter.
     * @param $id $id [This paramter is the product id.]
     *
     * @return void
     */
    function getdistributor_byname($product_names)
    {
        $this->db->select('distributors.id');
        $this->db->where_in('distributors.name',$product_names);
        $query = $this->db->get('distributors');
        $data =  $query->result_array();
        $pro_dist = array();
        if(!empty($data)){
            $pro_dist = array_column($data,'id');
        }
        return $pro_dist;
    }

    /**
     * Method getProductIdByName
     * This Function return product number by using product name.
     * @param $product_name $product_name [This parameter is the product name.]
     *
     * @return void
     */
    function getProductIdByName($product_name)
    {
        $this->db->select('id');
        $this->db->where('kgt_ref_number', $product_name);
        $data = $this->db->get('products')->row_array();
        return (isset($data['id']) && $data['id']) ? $data['id'] : '';
    }


  

    /**
     * Method updateDisplayOnKondarsoft
     * This Function return true or false.
     * @param $productId $productId [This parameter is id of product.]
     * @param $limit $limit 
     * @param $multiple $multiple [This parameter is update multiple ids]
     * @param $selected_products $selected_products [This parameter is for multiple ids] 
     *
     * @return void
     */
    function updateDisplayOnKondarsoft($productId, $limit, $multiple, $selected_products)
    {
        $query = '';
        $data = array(
            'display_kondarsoft' => 1,
            'pushed_status' => 0
        );
        if ($multiple == 1 && !empty($selected_products)) {
            $this->db->where_in("id", $selected_products);
        } else {
            $this->db->where("id >=", $productId);
            $this->db->where("pushed_status", "0");
            $this->db->limit($limit);
        }

        return $this->db->update("products", $data);
    }


    function product_list_home($lang_id, $offset = 0,$sort="")
    {
        
        $this->db->select('products.id,products.hide_partid,products.item_real_photo,products.price,products.kgt_ref_number,products.part_name,products_country.lang_part_name,tbl_product_types.product_type_name,tbl_product_types_country.lang_product_type_name,products.quantity');
        $this->db->from('products');
        $this->db->join('products_country ', 'products.id = products_country.lang_id AND products_country.country_id =' . $lang_id, 'LEFT');
        $this->db->join('tbl_product_types', 'tbl_product_types.id = products.product_type_id', 'LEFT');
        $this->db->join('tbl_product_types_country', 'tbl_product_types.id = tbl_product_types_country.lang_id AND tbl_product_types_country.country_id =' . $lang_id, 'LEFT');
        $this->db->where('products.status', "1");

        if($this->config->item('products_without_images_on_productpage') == "0") {
        $this->db->where('products.item_real_photo !=',"");
        }
        // $this->db->group_by('products.id');
        // $this->db->order_by("products.price", "ASC");
        if($sort=="price_low_high"){
          $this->db->order_by("products.price", "ASC");
        } else if($sort=="price_high_low"){
           $this->db->order_by("products.price", "DESC");
        } else {
           $this->db->order_by("products.item_real_photo", "DESC");
        }
        $this->db->limit($this->config->item('pagination_limit'), $offset);
        $query = $this->db->get();
        $data =  $query->result();
        // echo $this->db->last_query();
        // exit;
        return $data;
    }

    function num_product_list_home()
    {
        $this->db->select('count(*) as total');
        $this->db->from('products');
        if($this->config->item('products_without_images_on_productpage') == "0") {
        $this->db->where('products.item_real_photo !=',"");
        }
        $this->db->where('products.status', "1");
        $query = $this->db->get()->row_array();
        return $query['total'];
    }


    function product_models_list($product_id, $country_id)
    {

        $this->db->select('tbl_models.*, (case when products_country.lang_part_name is null then products.part_name else products_country.lang_part_name end ) as seo_model_name,tbl_models_country.lang_model_name,tbl_makers_country.lang_maker_name,tbl_makers.maker_name,tbl_makers.maker_logo,tbl_vehicle_categories.category_name,tbl_vehicle_categories_country.lang_category_name, (case when products_country.lang_seo_meta_desc is null then products.seo_meta_desc else products_country.lang_seo_meta_desc end) as seo_meta_desc, (case when products_country.lang_seo_meta_keywords is null then products.seo_meta_keywords else products_country.lang_seo_meta_keywords end) as seo_meta_keywords');
        $this->db->from('product_models');
        $this->db->where('product_models.status', "1");
        $this->db->where('product_models.product_id', $product_id);
        $this->db->join('products','product_models.product_id=products.id','left');
        $this->db->join('products_country','products.id=products_country.lang_id and products_country.country_id=' . $country_id,'left');
        $this->db->join('tbl_vehicle_categories', 'tbl_vehicle_categories.id=product_models.category_id ', 'left');
        $this->db->join('tbl_vehicle_categories_country', 'tbl_vehicle_categories.id=tbl_vehicle_categories_country.lang_id and tbl_vehicle_categories_country.country_id=' . $country_id, 'left');
        $this->db->join('tbl_models', 'tbl_models.id=product_models.model_id', 'left');
        $this->db->join('tbl_models_country as tbl_models_country', 'tbl_models.id=tbl_models_country.lang_id and tbl_models_country.country_id=' . $country_id, 'left');
        $this->db->join('tbl_makers', 'tbl_makers.id=product_models.maker_id', 'left');
        $this->db->join('tbl_makers_country as tbl_makers_country', 'tbl_makers.id=tbl_makers_country.lang_id and tbl_models_country.country_id=' . $country_id, 'left');
        $this->db->distinct();

        $data  = $this->db->get()->result_array();
        return  $data;
    }

    function getMakerByProduct($product_id, $country_id)
    {
        $this->db->select('tbl_makers.*, tbl_makers_country.lang_maker_name');
        $this->db->from('product_models');
        $this->db->where('product_models.status', "1");
        $this->db->where('product_models.product_id', $product_id);
        $this->db->join('tbl_makers', 'tbl_makers.id=product_models.maker_id', 'left');
        $this->db->join('tbl_makers_country as tbl_makers_country', 'tbl_makers.id=tbl_makers_country.lang_id and tbl_makers_country.country_id=' . $country_id, 'left');
        $this->db->distinct();
        $data  = $this->db->get()->result_array();
        return  $data;
    }

    function getModelByMaker($makerId, $product_id, $country_id)
    {
        $this->db->select('tbl_models.*, tbl_models_country.lang_model_name');
        $this->db->from('product_models');
        $this->db->where('product_models.status', "1");
        $this->db->where('product_models.maker_id', $makerId);
        $this->db->where('product_models.product_id', $product_id);
        $this->db->join('tbl_models', 'tbl_models.id=product_models.model_id', 'left');
        $this->db->join('tbl_models_country as tbl_models_country', 'tbl_models.id=tbl_models_country.lang_id and tbl_models_country.country_id=' . $country_id, 'left');
        $this->db->distinct();
        $data  = $this->db->get()->result_array();
        return  $data;
    }

    function getMakers($makerId) {

        $this->db->select('tbl_makers.vehicle_category_id');
        $this->db->where_in('tbl_makers.id', $makerId);
        $query = $this->db->get('tbl_makers')->result_array();

        $vehicle_category_id   = array_map(function ($value) {
        return  $value['vehicle_category_id'];
        }, $query);

        return   $vehicle_category_id;
    }

     /**
     * Method get_product_types_from_model
     * This Function return product types data as per the session and offset.
     * @param $offset $offset [This parameter is the  offset number for the pagination.]
     * @param $country_id $country_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function product_types_drop_modal($offset = 0, $country_id,$search="",$category_id="")
    {
        $data = array();

        // This code read  session data and saved in  variables
        $session_data = $this->session->all_userdata();
        $vehicle_category_id = isset($session_data['vehicle_category_id']) ? $session_data['vehicle_category_id'] : array();
        $vehicle_category_id = array_unique(array_filter($vehicle_category_id));
        $product_type_arr    = isset($session_data['product_type']) ? $session_data['product_type'] : array();
        $product_type_arr    = array_unique(array_filter($product_type_arr));

        $session_maker_id = $this->session->userdata('maker_id');
        $session_model_id = $this->session->userdata('model_id');

        // those code get categories data as per the categories ids in the session

  


                $this->db->select('tbl_product_types.product_type_name,tbl_product_types.Product_Type_Photo,tbl_product_types.min_price,tbl_product_types.in_stock,tbl_product_types.id as id,
                tbl_product_types_country.lang_product_type_name');
                $this->db->group_by('tbl_product_types.id');
                $this->db->from('model_groups');
                $this->db->join('tbl_product_types', 'tbl_product_types.id= model_groups.product_type_id', 'left');
                $this->db->join('tbl_product_types_country', 'tbl_product_types_country.lang_id = tbl_product_types.id AND tbl_product_types_country.country_id =' . $this->lang->default_lang_id, 'LEFT');

                if($search != '') {
                $this->db->like('tbl_product_types.product_type_name', $search , 'both'); 
                }

                if ($this->session->userdata('hide_category') == 0) {
                    $this->db->where('model_groups.category_id', $category_id);
                }

                if (!empty($session_maker_id)) {
                $this->db->where_in('model_groups.maker_id', $session_maker_id);
                }

                if (!empty($session_model_id)) {
                $this->db->where_in('model_groups.model_id', $session_model_id);
                }

                if (!empty($product_type_arr)) {
                $this->db->where_in('model_groups.product_type_id', $product_type_arr);
                }

                $items = $this->db->get()->result_array();


        
        return $items;
    }

     /**
     * Method get_product_types_from_model
     * This Function return product types data as per the session and offset.
     * @param $offset $offset [This parameter is the  offset number for the pagination.]
     * @param $country_id $country_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function product_types_drop_modal_count($search="",$category_id="")
    {
        $data = array();

        // This code read  session data and saved in  variables
        $session_data = $this->session->all_userdata();
        $vehicle_category_id = isset($session_data['vehicle_category_id']) ? $session_data['vehicle_category_id'] : array();
        $vehicle_category_id = array_unique(array_filter($vehicle_category_id));
        $product_type_arr    = isset($session_data['product_type']) ? $session_data['product_type'] : array();
        $product_type_arr    = array_unique(array_filter($product_type_arr));

        $session_maker_id = $this->session->userdata('maker_id');
        $session_model_id = $this->session->userdata('model_id');

        // those code get categories data as per the categories ids in the session

 
                $this->db->select('tbl_product_types.id as id');
                $this->db->group_by('tbl_product_types.id');
                $this->db->from('model_groups');
                $this->db->join('tbl_product_types', 'tbl_product_types.id= model_groups.product_type_id', 'left');

                if($search != '') {
                $this->db->like('tbl_product_types.product_type_name', $search , 'both'); 
                }

                if (!empty($session_maker_id)) {
                $this->db->where_in('model_groups.maker_id', $session_maker_id);
                }

                if ($this->session->userdata('hide_category') == 0) {
                    $this->db->where('model_groups.category_id', $category_id);
                }

                if (!empty($session_model_id)) {
                $this->db->where_in('model_groups.model_id', $session_model_id);
                }

                if (!empty($product_type_arr)) {
                $this->db->where_in('model_groups.product_type_id', $product_type_arr);
                }

                $items = $this->db->get()->num_rows();


        
        return $items;
    }
    function delete_product_data($product_id){
        $product_list = $this->db->query('select kgt_ref_number,product_type_id,item_real_photo,item_schematic_photo from products where id="'.$product_id.'"')->row_array();

        // Check and delete if product exist on markteplace
        $this->delete_marketplace_product($product_list['kgt_ref_number']);

        $product_items_list = $this->db->query('select model_id,value,engine_size from product_items where product_id="'.$product_id.'" group by model_id,value,engine_size')->result_array();
        $product_models_list = $this->db->query('select product_models.model_id, products.product_type_id from product_models left join products on products.id=product_models.product_id where products.id="'.$product_id.'"')->result_array();
        foreach($product_items_list as $res){
            $product_items_perticular = $this->db->query('select model_id,value,engine_size from product_items where product_id !="'.$product_id.'" and model_id="'.$res['model_id'].'" and value="'.$res['value'].'" and engine_size="'.$res['engine_size'].'" limit 1')->row_array();
            
            if(count($product_items_perticular)<1){
                $this->comman_model->delete_where('model_engines', array('model_id' => $res['model_id'],'years'=>$res['value']));
            }
            $product_item_records = $this->db->query('select product_items.model_id,product_items.value,product_items.engine_size,products.product_type_id from product_items left join products on products.id=product_items.product_id  where product_items.product_id !="'.$product_id.'" and product_items.model_id="'.$res['model_id'].'" and product_items.value="'.$res['value'].'" and product_items.engine_size="'.$res['engine_size'].'" and products.product_type_id="'.$product_list['product_type_id'].'" limit 1')->row_array();
            
            if(count($product_item_records)<1){
                $this->comman_model->delete_where('model_engines_groups', array('model_id' => $res['model_id'],'years'=>$res['value'],'engine_size'=>$res['engine_size'],'product_type_id'=>$product_list['product_type_id']));
            }
        }
        
        foreach($product_models_list as $pro_mod_list){
            $product_models_res = $this->db->query('select product_models.model_id,products.product_type_id from product_models left join products on products.id=product_models.product_id  where product_models.product_id !="'.$product_id.'" and product_models.model_id="'.$pro_mod_list['model_id'].'" and  products.product_type_id="'.$product_list['product_type_id'].'" limit 1')->row_array();
            if(count($product_models_res)<1){
                $this->comman_model->delete_where('model_groups', array('model_id' => $pro_mod_list['model_id'],'product_type_id'=>$pro_mod_list['product_type_id']));
            }
        }
        if (!empty($product_list['item_real_photo'])) {
            $all_img = explode(",", $product_list['item_real_photo']);

            foreach ($all_img as $del_img) {
                $del_img = trim($del_img);
                if (file_exists("assets/uploads/product_images/" . $del_img))
                unlink("assets/uploads/product_images/" . $del_img);
            }
        }
        if (file_exists("assets/uploads/product_images/" . $product_list['item_schematic_photo']))
            unlink("assets/uploads/product_images/" . $product_list['item_schematic_photo']);

        $this->comman_model->delete_where('product_items ', array('product_id' => $product_id));
        removeLangContent('product_items_country', $product_id);
        $this->comman_model->delete_where('product_models', array('product_id' => $product_id));
        $this->comman_model->delete_where('product_attributes', array('product_id' => $product_id));
        removeLangContent('product_attributes_country', $product_id);
        $this->comman_model->delete_where('product_details', array('product_id' => $product_id));
        removeLangContent('product_details_country', $product_id);
        $this->comman_model->delete_where('products ', array('id' => $product_id));
        removeLangContent('products_country', $product_id);
        // update status of non used 

        $this->db->query('update  tbl_vehicle_categories set status="0" where id not in (select category_id from product_models group by category_id)');
        $this->db->query('update  tbl_makers  set status="0" where id not in (select maker_id from product_models group by maker_id)');
        $this->db->query('update tbl_models  set status="0" where id not in (select model_id  from product_models group by model_id)');
        $this->db->query('update tbl_product_types  set status="0" where id not in (select product_type_id  from products group by product_type_id)');
        $this->db->query('update industries  set status="0" where id not in( select industries from tbl_vehicle_categories group by industries)');


    }

    function delete_marketplace_product($product_number){
        $db2 = $this->load->database('mainstore', true);
        $main_folder_path = getenv('MAIN_STORE_PATH');

        $store_url = substr(getenv('ASSET_URL'), 0, -1);
        $db2->select("*");
        $db2->from('store');
        $db2->where(array("url" => $store_url, "status" => "1"));
        $store_details = $db2->get()->row_array();

        if ($store_details) {
            $store_id = $store_details['id'];

            $db2->select("*");
            $db2->from('products');
            $db2->where(array("kgt_ref_number" => $product_number));
            $marketplace_product_number = $db2->get()->row_array();
            if ($marketplace_product_number) {
                    $product_id = $marketplace_product_number['id'];

                $product_list =$db2->query('select product_type_id,item_real_photo,item_schematic_photo from products where id="'.$product_id.'"')->row_array();
                $product_items_list = $db2->query('select model_id,value,engine_size from product_items where product_id="'.$product_id.'" group by model_id,value,engine_size')->result_array();
                $product_models_list = $db2->query('select product_models.model_id, products.product_type_id from product_models left join products on products.id=product_models.product_id where products.id="'.$product_id.'"')->result_array();
                foreach($product_items_list as $res){
                    $product_items_perticular = $db2->query('select model_id,value,engine_size from product_items where product_id !="'.$product_id.'" and model_id="'.$res['model_id'].'" and value="'.$res['value'].'" and engine_size="'.$res['engine_size'].'" limit 1')->row_array();
                    
                    if(count($product_items_perticular)<1){
                        $db2->delete('model_engines', array('model_id' => $res['model_id'],'years'=>$res['value']));
                    }
                    $product_item_records = $db2->query('select product_items.model_id,product_items.value,product_items.engine_size,products.product_type_id from product_items left join products on products.id=product_items.product_id  where product_items.product_id !="'.$product_id.'" and product_items.model_id="'.$res['model_id'].'" and product_items.value="'.$res['value'].'" and product_items.engine_size="'.$res['engine_size'].'" and products.product_type_id="'.$product_list['product_type_id'].'" limit 1')->row_array();
                    
                    if(count($product_item_records)<1){
                        $db2->delete('model_engines_groups', array('model_id' => $res['model_id'],'years'=>$res['value'],'engine_size'=>$res['engine_size'],'product_type_id'=>$product_list['product_type_id']));
                    }
                }

                foreach($product_models_list as $pro_mod_list){
                    $product_models_res = $db2->query('select product_models.model_id,products.product_type_id from product_models left join products on products.id=product_models.product_id  where product_models.product_id !="'.$product_id.'" and product_models.model_id="'.$pro_mod_list['model_id'].'" and  products.product_type_id="'.$product_list['product_type_id'].'" limit 1')->row_array();
                    if(count($product_models_res)<1){
                        $db2->delete('model_groups', array('model_id' => $pro_mod_list['model_id'],'product_type_id'=>$pro_mod_list['product_type_id']));
                    }
                }
                if (!empty($product_list['item_real_photo'])) {
                    $all_img = explode(",", $product_list['item_real_photo']);

                    foreach ($all_img as $del_img) {
                        $del_img = trim($del_img);
                        
                    }
                }
                $db2->delete('product_items ', array('product_id' => $product_id));
                $db2->delete('product_items_country', array('lang_id' => $product_id));
                $db2->delete('product_models', array('product_id' => $product_id));
                $db2->delete('product_attributes', array('product_id' => $product_id));
                $db2->delete('product_attributes_country', array('lang_id' => $product_id));
                $db2->delete('product_details', array('product_id' => $product_id));
                $db2->delete('product_details_country', array('lang_id' => $product_id));
                $db2->delete('products ', array('id' => $product_id));
                $db2->delete('products_country', array('lang_id' => $product_id));

                // update status of non used 

                $db2->query('update  tbl_vehicle_categories set status="0" where id not in (select category_id from product_models group by category_id)');
                $db2->query('update  tbl_makers  set status="0" where id not in (select maker_id from product_models group by maker_id)');
                $db2->query('update tbl_models  set status="0" where id not in (select model_id  from product_models group by model_id)');
                $db2->query('update tbl_product_types  set status="0" where id not in (select product_type_id  from products group by product_type_id)');
                $db2->query('update industries  set status="0" where id not in( select industries from tbl_vehicle_categories group by industries)');
            }

        }


    }

    function delete_product_relationaldata($product_id){
        $product_list = $this->db->query('select product_type_id,item_real_photo,item_schematic_photo from products where id="'.$product_id.'"')->row_array();
        $product_items_list = $this->db->query('select model_id,value,engine_size from product_items where product_id="'.$product_id.'" group by model_id,value,engine_size')->result_array();
        $product_models_list = $this->db->query('select product_models.model_id, products.product_type_id from product_models left join products on products.id=product_models.product_id where products.id="'.$product_id.'"')->result_array();
        foreach($product_items_list as $res){
            $product_items_perticular = $this->db->query('select model_id,value,engine_size from product_items where product_id !="'.$product_id.'" and model_id="'.$res['model_id'].'" and value="'.$res['value'].'" and engine_size="'.$res['engine_size'].'" limit 1')->row_array();
            
            if(count($product_items_perticular)<1){
                $this->comman_model->delete_where('model_engines', array('model_id' => $res['model_id'],'years'=>$res['value']));
            }
            $product_item_records = $this->db->query('select product_items.model_id,product_items.value,product_items.engine_size,products.product_type_id from product_items left join products on products.id=product_items.product_id  where product_items.product_id !="'.$product_id.'" and product_items.model_id="'.$res['model_id'].'" and product_items.value="'.$res['value'].'" and product_items.engine_size="'.$res['engine_size'].'" and products.product_type_id="'.$product_list['product_type_id'].'" limit 1')->row_array();
            
            if(count($product_item_records)<1){
                $this->comman_model->delete_where('model_engines_groups', array('model_id' => $res['model_id'],'years'=>$res['value'],'engine_size'=>$res['engine_size'],'product_type_id'=>$product_list['product_type_id']));
            }
        }
        
        foreach($product_models_list as $pro_mod_list){
            $product_models_res = $this->db->query('select product_models.model_id,products.product_type_id from product_models left join products on products.id=product_models.product_id  where product_models.product_id !="'.$product_id.'" and product_models.model_id="'.$pro_mod_list['model_id'].'" and  products.product_type_id="'.$product_list['product_type_id'].'" limit 1')->row_array();
            if(count($product_models_res)<1){
                $this->comman_model->delete_where('model_groups', array('model_id' => $pro_mod_list['model_id'],'product_type_id'=>$pro_mod_list['product_type_id']));
            }
        }
        
     

        $this->comman_model->delete_where('product_items ', array('product_id' => $product_id));
        removeLangContent('product_items_country', $product_id);
        $this->comman_model->delete_where('product_models', array('product_id' => $product_id));
        $this->comman_model->delete_where('product_attributes', array('product_id' => $product_id));
        removeLangContent('product_attributes_country', $product_id);

     
    }

    function  deactivate_unused_data(){

    $this->db->query('update  tbl_vehicle_categories set status="0" where id not in (select category_id from product_models group by category_id)');
    $this->db->query('update  tbl_makers  set status="0" where id not in (select maker_id from product_models group by maker_id)');
    $this->db->query('update tbl_models  set status="0" where id not in (select model_id  from product_models group by model_id)');
    $this->db->query('update tbl_product_types  set status="0" where id not in (select product_type_id  from products group by product_type_id)');
    $this->db->query('update industries  set status="0" where id not in( select industries from tbl_vehicle_categories group by industries)');
       

    }


    function update_min_price($product_type_id){

        $result_query =  $this->db->query("select min(price) as price  from products where product_type_id=".$product_type_id.";");
        $singgle_record = $result_query->row_array();
        if(isset($singgle_record['price'])){

            $this->db->where("id",$product_type_id);
            $this->db->update("tbl_product_types", array('min_price'=>$singgle_record['price']));

        }
    }

    ################# Added for SEO by SUJAN ##################
    function product_link_home(){
        $this->db->select('*');
        $this->db->from('products');       
        $this->db->join('tbl_product_types', 'tbl_product_types.id = products.product_type_id', 'LEFT');        
        $this->db->where('products.status', "1");
        $query = $this->db->get();
        $data =  $query->result();
        // echo $this->db->last_query();
        // exit;
        return $data;
    }
    ################## EBD for SEO by SUJAN ###################
    function get_related_productsComplex($keywords,$prod_id){
        $array_seo_keywords = explode(",",trim($keywords));
        $array_seo_keywords = array_filter($array_seo_keywords);
        
        $query_for_related_products = "SELECT products.id,products.item_real_photo,products.price,products.kgt_ref_number,products.part_name,tbl_product_types.product_type_name,tbl_product_types_country.lang_product_type_name,store.name as storename,store.url,store.show_price FROM products ";
        $query_for_related_products .="LEFT JOIN store ON store.id = products.store_id
        LEFT JOIN tbl_product_types ON tbl_product_types.id = products.product_type_id
        LEFT JOIN tbl_product_types_country ON tbl_product_types.id = tbl_product_types_country.lang_id AND tbl_product_types_country.country_id = ". $this->lang->default_lang_id;
        
        if($prod_id){
            $prod_id;
        }else{
            $prod_id = 0;
        }
          
        $query_for_related_products_where  = " WHERE products.status = 1 AND products.id != ".$prod_id." AND (";
        $query_for_related_products_sum = "";
        if (count($array_seo_keywords)>0){
            $query_for_related_products_sum .= "(case when FIND_IN_SET(replace('".trim($array_seo_keywords[0])."',' ',''), replace(seo_meta_keywords,' ','')) >0 then 1 else 0 end )";
            $query_for_related_products_where .= "FIND_IN_SET(replace('".trim($array_seo_keywords[0])."',' ',''), replace(seo_meta_keywords,' ','')) > 0 ";
        }else{
            $query_for_related_products_where .= "0=1";
            $query_for_related_products_sum .= "0";
        }
        for($i=1;$i<count($array_seo_keywords);$i++){        
            $query_for_related_products_sum .= "+ (case when FIND_IN_SET(replace('".trim($array_seo_keywords[$i])."',' ',''), replace(seo_meta_keywords,' ','')) >0 then 1 else 0 end )";
            $query_for_related_products_where .= "OR FIND_IN_SET(replace('".trim($array_seo_keywords[$i])."',' ',''), replace(seo_meta_keywords,' ','')) > 0 ";
        }        
        $query_for_related_products_sum .= ") as weightage";              
        $query_for_related_products_where .= ") group by id order by weightage desc LIMIT ".$this->config->item('no_of_related_products');
    
        $query_for_realed_products_inner_query = "SELECT id, SUM( " .  $query_for_related_products_sum . " FROM products " . $query_for_related_products_where;
        //echo $query_for_realed_products_inner_query;exit;
       
        
        $query_for_related_products = "SELECT products.id,products.item_real_photo,products.price,products.kgt_ref_number,products.part_name,tbl_product_types.product_type_name,tbl_product_types_country.lang_product_type_name,'1' show_price FROM products ";
        $query_for_related_products .="INNER JOIN (".$query_for_realed_products_inner_query.") as rel on rel.id = products.id ";
        $query_for_related_products .="LEFT JOIN tbl_product_types ON tbl_product_types.id = products.product_type_id
        LEFT JOIN tbl_product_types_country ON tbl_product_types.id = tbl_product_types_country.lang_id AND tbl_product_types_country.country_id = ". $this->lang->default_lang_id;
    
        $query_for_related_products .=" ORDER by rel.weightage desc";
        
        
        $result = $this->db->query($query_for_related_products);
        return $result->result();
    
    }


      /** 
     * Method ar_getAllProductsForParent
     * This Function return records from products
     * @param $product_id $product_id [This paramter is the product id.]
     *
     * @return void
     *///AR
    function ar_getAllProductsForParent($product_id=false, $lang_id =false)
    {

        /*
        if($product_id){
            $this->db->select('p.id AS product_id, tpp.parent_product_id AS parent_product_id, p.kgt_ref_number, p.part_name');
            $this->db->from('products p');
            $this->db->join('tbl_product_parent tpp', 'p.id = tpp.product_id', 'left');
            $this->db->join('tbl_product_parent grandparent', 'tpp.parent_product_id = grandparent.product_id', 'left');
            $this->db->where('p.id !=', 3387); // Exclude product_id 3387

            // Subquery for NOT IN condition
            $this->db->where('tpp.parent_product_id NOT IN (
                SELECT DISTINCT grandparent.parent_product_id 
                FROM tbl_product_parent grandparent 
                WHERE grandparent.product_id = tpp.product_id
            )', NULL, FALSE);

            $this->db->group_by('p.id, tpp.parent_product_id, p.kgt_ref_number, p.part_name');
            $this->db->order_by('p.id', 'ASC');

            $query = $this->db->get();
          return  $result = $query->result_array(); // Fetch the results

        }
        */

        $data =array();
        $this->db->select('id as product_id, id as parent_product_id, id, kgt_ref_number, part_name');
        $this->db->from('products');
        $this->db->where('status', 1);
        if($product_id){
        $this->db->where('id !=', $product_id); // Use variable for the product ID
        }           
        $query = $this->db->get(); 
       // echo $this->db->last_query();
        $data = $query->result_array(); 
        /*
        if($product_id){
        $query_for_related_products="SELECT tpp.product_id AS product_id, GROUP_CONCAT(DISTINCT tpp.parent_product_id) AS parent_ids, GROUP_CONCAT(DISTINCT p_child.product_id) AS child_ids FROM tbl_product_parent tpp LEFT JOIN tbl_product_parent p_child ON tpp.parent_product_id = p_child.product_id GROUP BY tpp.product_id";
        $results = $this->db->query($query_for_related_products);
        $alreay_exists=array();
            if($results){
                foreach($results as $k=>$val){
                    $alreay_exists[$val['product_id']]=array('parents_ids'=>@explode(",",$val['product_id']),'child_ids'=>@explode(",",$val['child_ids']));
                }
            }
            $new_data=array();
            foreach($data as $k=>$v){

                if(array_key_exists($v->id,$alreay_exists)){
                    if(!in_array($v->id,$alreay_exists[$v->id]['parents_ids']) || !in_array($v->id,$alreay_exists[$v->id]['child_ids'])){
                        $new_data = $v;
                    }
                }else{
                    $new_data = $v;
                }

                return $new_data;
            }

        }*/
       
        return $data;
    }

    function ar_getAllProductsForParent22($product_id=false, $lang_id =false)
    {
        $data =array();
       
        if($product_id){
        $this->db->select('p.id as product_id, p.id as parent_product_id, p.id, p.kgt_ref_number, p.part_name');
        $this->db->from('products p');
         $this->db->join('tbl_product_parent tpp', 'p.id = tpp.product_id', 'left');
       // $this->db->join('tbl_product_parent tpp', 'p.id = tpp.product_id OR p.id = tpp.parent_product_id', 'left');
        //$this->db->join('tbl_product_parent tpp', 'p.id = tpp.parent_product_id', 'left');

        $this->db->where('tpp.product_id IS NULL');
        $this->db->where('p.id !=', $product_id); // Add the additional condition
       // $query = $this->db->get();

        }else{
            $this->db->select('id as product_id, id as parent_product_id, id, kgt_ref_number, part_name');
            $this->db->from('products');
            $this->db->where('status', 1);
        } 
        
        /*

        SELECT 
    p.id AS product_id,
    tpp.parent_product_id AS parent_product_id,
    p.kgt_ref_number,
    p.part_name
FROM products p
LEFT JOIN tbl_product_parent tpp 
       ON p.id = tpp.product_id
LEFT JOIN tbl_product_parent grandparent 
       ON tpp.parent_product_id = grandparent.product_id
WHERE p.id != 3387 -- Exclude product_id 3387
  AND tpp.parent_product_id NOT IN (
    SELECT DISTINCT grandparent.parent_product_id
    FROM tbl_product_parent grandparent
    WHERE grandparent.product_id = tpp.product_id
)
GROUP BY p.id, tpp.parent_product_id, p.kgt_ref_number, p.part_name
ORDER BY p.id;


        SELECT 
            tpp.product_id AS product_id,
            GROUP_CONCAT(DISTINCT tpp.parent_product_id) AS parent_ids,
            GROUP_CONCAT(DISTINCT p_child.product_id) AS child_ids
        FROM tbl_product_parent tpp
        LEFT JOIN tbl_product_parent p_child ON tpp.parent_product_id = p_child.product_id
        GROUP BY tpp.product_id;

        SELECT tpp.product_id AS product_id, 
            GROUP_CONCAT(DISTINCT tpp.parent_product_id) AS parent_ids, 
            GROUP_CONCAT(DISTINCT p_child.product_id) AS child_ids 
        FROM tbl_product_parent tpp 
        LEFT JOIN tbl_product_parent p_child ON tpp.product_id = p_child.parent_product_id 
        GROUP BY tpp.product_id

        */
        $query = $this->db->get(); 
       // echo $this->db->last_query();
        $data = $query->result_array(); 
       
        return $data;
    }
    /** 
     * Method ar_getProductRefNumById
     * This Function return records from products
     * @param $product_id $product_id [This paramter is the product id.]
     *
     * @return void
     *///AR
    function ar_getProductRefNumById($product_id)
    {
        $data =array();
        $this->db->select('id, kgt_ref_number');
        $this->db->from('products');
        $this->db->where('id', $product_id);                 
        $query = $this->db->get(); 
       // echo $this->db->last_query();     
        $data = $query->row_array(); 
        return $data['kgt_ref_number'];
    }
    
 /** 
     * Method ar_getProductIdByRefNum
     * This Function return records from products
     * @param $product_id $product_id [This paramter is the product id.]
     *
     * @return void
     *///AR
     function ar_getProductIdByRefNum($kgt_ref_number)
     {
         $data =array();
         $this->db->select('id, kgt_ref_number');
         $this->db->from('products');
         $this->db->where('kgt_ref_number', $kgt_ref_number);                 
         $query = $this->db->get(); 
        // echo $this->db->last_query();     
         $data = $query->row_array(); 
         return $data['id'];
     }

   /** 
     * Method ar_getProductInfoById
     * This Function return records from products
     * @param $product_id $product_id [This paramter is the product id.]
     *
     * @return void
     *///AR
     function ar_getProductInfoById($product_id)
     {

        /*
         $product_row = $this->comman_model->get_data_by_id('products', array('id' => $product_id));
        */        
         $data =array();
         $this->db->select('*');
         $this->db->from('products');
         $this->db->where('id', $product_id);                 
         $query = $this->db->get(); 
        // echo $this->db->last_query();     
         $data = $query->row_array(); 
         return $data;
     }

      /**
     * Method ar_productByKGTRefNo
     * This Function get details of single product as per the product number passed as the paramter. 
     * @param $kgt_ref_number $kgt_ref_number [This parameter is the product number.]
     * @param $lang_id $lang_id [This parameter is the language id.]
     *
     * @return void
     */
    function ar_productByKGTRefNo($kgt_ref_number, $lang_id)
    {


        // this function make query as per the conditions and session data
        $querysql = "SELECT P.id,P.hide_partid, P.kgt_ref_number,P.part_name, products_country.lang_part_name, P.quantity,P.min_quantity,P.price, P.item_real_photo, P.item_schematic_photo, P.item_schematic_photo_status, P.item_width, P.item_height, P.item_length, P.item_weight, P.shipping_special_notes,products_country.lang_shipping_special_notes, tbl_makers.id as maker_id, tbl_makers.maker_name as make,tbl_makers.maker_logo as maker_logo, tbl_models.id as model_id, tbl_models.model_name as model,tbl_models.model_photo as model_photo, tbl_vehicle_categories.id as vehicle_category_id, tbl_vehicle_categories.category_name as category, tbl_vehicle_categories.vehicle_category_icon as category_icon,  tbl_product_types.product_type_name,tbl_product_types_country.lang_product_type_name,tbl_product_types.Product_Type_Photo as type_photo, tbl_product_types.menu_privilages, tbl_vehicle_categories_country.country_id, tbl_vehicle_categories_country.lang_category_name,tbl_product_types_country.lang_product_type_name,tbl_product_parent.parent_product_id,distributors.name as dist_name,distributors.url as dist_url,distributors.logo as dist_logo,distributors.country as dist_country,distributors.zip_code  as dist_zip_code,P.template FROM product_models ";


        $querysql .= " LEFT JOIN products as P ON P.id = product_models.product_id JOIN tbl_makers ON tbl_makers.id = product_models.maker_id 
                JOIN tbl_models ON tbl_models.id = product_models.model_id 
                JOIN tbl_vehicle_categories ON tbl_vehicle_categories.id = product_models.category_id 
                JOIN tbl_product_types ON tbl_product_types.id = P.product_type_id 
                LEFT JOIN distributors ON distributors.id = P.distributor
                LEFT JOIN tbl_product_parent ON tbl_product_parent.product_id = P.id
                LEFT JOIN tbl_vehicle_categories_country ON tbl_vehicle_categories_country.lang_id = tbl_vehicle_categories.id and tbl_vehicle_categories_country.country_id=" . $lang_id . " 
                LEFT JOIN products_country ON products_country.lang_id = P.id and products_country.country_id=" . $lang_id . " LEFT JOIN tbl_product_types_country ON tbl_product_types_country.lang_id = tbl_product_types.id and tbl_product_types_country.country_id=" . $lang_id . " WHERE product_models.status='1'  ";

        // this code prepare conditions array from the session data
        if (!empty($kgt_ref_number)) {
            $querysql .= " AND P.kgt_ref_number='" . $kgt_ref_number . "'";
        }


        $querysql .= " AND P.status = 1 GROUP BY P.id ORDER BY  P.price ASC ";

        echo $querysql;

        $query = $this->db->query($querysql);
        $result = $query->result_array();
        return json_decode(json_encode($result));
    }
    
}
