<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Part_relation_model
 * This Class handle all functions related to tbl_product_category_maker_model_relation table.
 */
class Part_relation_model extends CI_Model
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
     * Method get_part_relation_details
     * This Function return all rows of products with categories makers and models data as per the offset and labguage id.
     * @param $key $key [This Parameter is the key for search in the table.]
     * @param $per_page $per_page [This Parameter is the limit  the pagination.]
     * @param $offset $offset [This Parameter is the offset of the pagination.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function get_part_relation_details($key, $per_page, $offset, $lang_id)
    {

        $this->db->select('pro.id, pro.kgt_ref_number , pro.part_name, PC.lang_part_name, pro.quantity, pro.product_type_id, pt.product_type_name, PTC.lang_product_type_name, con.countryName, CL.lang_countryName');
        if ($key != "") {
            $this->db->like('kgt_ref_number', $key);
            $this->db->or_like('part_name', $key);
        }
        $this->db->from('products as pro');
        $this->db->join('tbl_product_types as pt', 'pro.product_type_id = pt.id', 'left');
        $this->db->join('countries as con', 'pro.country_id = con.id', 'left');
        $this->db->join('products_country as PC', 'pro.id = PC.lang_id AND PC.country_id =' . $lang_id, 'left');
        $this->db->join('tbl_product_types_country as PTC', 'pro.product_type_id = PTC.lang_id AND PTC.country_id =' . $lang_id, 'left');
        $this->db->join('countries_lang as CL', 'pro.country_id = CL.lang_id AND CL.country_id =' . $lang_id, 'left');
        $this->db->limit($per_page, $offset);
        $result = $this->db->get()->result_array();

        // echo "<pre>";
        //     print_r($result);
        // exit;
        return $result;
    }

    /**
     * Method update_product_on_delete_model
     * This Function remove model id from products relation table rows.
     * @param $model_id $model_id [This Parameter is the model id]
     *
     * @return void
     */
    function update_product_on_delete_model($model_id)
    {

        $sql_query = "SELECT * FROM `product_models` WHERE `model_id` = '" . $model_id . "' OR `model_id` LIKE '" . $model_id . ",%' OR `model_id` LIKE '%," . $model_id . ",%' OR `model_id` LIKE '%," . $model_id . "' ";
        $query = $this->db->query($sql_query);
        $result = $query->result_array();
        if ($result) {
            foreach ($result as $row) {

                $model_array =  explode(",", $row['model_id']);
                if (in_array($model_id, $model_array)) {
                    //delete maker id from array
                    if (($key = array_search($model_id, $model_array)) !== false) {
                        unset($model_array[$key]);
                    }
                    $update_data = array(
                        'model_id' => implode(',', $model_array)
                    );
                    $this->comman_model->update_where('product_models', $update_data, array('id' => $row['id']));
                }
            }
        }
    }

        /**
         * Method getKeywordSearchData
         * This Function return search result on the behalf keyword from all products related tables.
         * @param $lang_id $lang_id [This parameter is the language  id.]
         * @param $keyword $keyword [This parameter is the keyword to search in database.]
         * @param $product_instruction $product_instruction [This parameter is the product instructions table data.]
         *
         * @return void
         */
        function getKeywordSearchData($lang_id, $keyword, $product_instruction, $model_types,$cat_hide)
        {

            // $keyword = $this->db->escape($keyword);
            $product_instruction->kgt_ref = $this->db->escape($product_instruction->kgt_ref);

            $responce = array();
        
            if($cat_hide == "0"){
                // //category table
                $this->db->select("v.category_name as display,v.id as value, vc.lang_category_name as lang_name, 'category' as type, " . $product_instruction->kgt_ref . " as name", FALSE);
                $this->db->like('v.category_name', $keyword,'both');
                $this->db->from('tbl_vehicle_categories as v');
                $this->db->join('tbl_vehicle_categories_country as vc', 'v.id = vc.lang_id AND vc.country_id =' . $lang_id, 'LEFT');
                $this->db->limit(5);
                $categoryList = $this->db->get()->result_array();

                if(!empty($categoryList)) {
                    $responce['categorys'] = $categoryList;
                }
            }

            //Industry table
            $this->db->select("inds.name as display, inds.id as value, indsc.lang_name as lang_name, 'industry' as type, " . $product_instruction->kgt_ref . " as name", FALSE);
            $this->db->like('inds.name', $keyword,'both');
            $this->db->where('inds.status', 1);
            $this->db->from('industries as inds');
            $this->db->join('industries_country as indsc', 'inds.id = indsc.lang_id AND indsc.country_id =' . $lang_id, 'LEFT');
            $this->db->limit(5);
            $indsList = $this->db->get()->result_array();

            if(!empty($indsList)) {
                $responce['industry'] = $indsList;
            }

            //Maker table
            $this->db->select("tm.maker_name as display, tm.id as value, tm.vehicle_category_id as categoryId, tmc.lang_maker_name as lang_name, 'maker' as type, " . $product_instruction->kgt_ref . " as name", FALSE);
            $this->db->like('tm.maker_name', $keyword,'both');
            $this->db->where('tm.status', 1);
            $this->db->from('tbl_makers as tm');
            $this->db->join('tbl_makers_country as tmc', 'tm.id = tmc.lang_id AND tmc.country_id =' . $lang_id, 'LEFT');
            $this->db->limit(5);
            $makerList = $this->db->get()->result_array();

            if(!empty($makerList)) {
                $responce['makers'] = $makerList;
            }
            // Model Table
            $this->db->select("MO.model_name as display, MO.id as value, MO.maker_id as makerId, MOC.lang_model_name as lang_name, 'model' as type, " . $product_instruction->kgt_ref . " as name", FALSE);
            $this->db->where('MO.status', 1);
            $this->db->like('MO.model_name', $keyword,'both');
            $this->db->from('tbl_models as MO');
            $this->db->join('tbl_models_country as MOC', 'MO.id = MOC.lang_id AND MOC.country_id =' . $lang_id, 'LEFT');
            $this->db->limit(5);
            $modelList = $this->db->get()->result_array();
            if(!empty($modelList)) {

                $responce['models'] = $modelList;
            }
            //Product Type Table
            $this->db->select("PT.product_type_name as display, PT.id as value, PTC.lang_product_type_name as lang_name, 'product_type' as type, " . $product_instruction->kgt_ref . " as name", FALSE);
            $this->db->where('PT.status', 1);
            $this->db->like('PT.product_type_name', $keyword,'both');
            $this->db->from('tbl_product_types as PT');
            $this->db->join('tbl_product_types_country as PTC', 'PT.id = PTC.lang_id AND PTC.country_id =' . $lang_id, 'LEFT');
            $this->db->limit(5);
            $productTypeList = $this->db->get()->result_array();
            if(!empty($productTypeList)) {
                $responce['product_group'] = $productTypeList;
            }

            

            // OEM Number LIST
            $this->db->select("p.kgt_ref_number as display, p.kgt_ref_number as value, p.id, product_attributes.value as part_name, 'product' as type, " . $product_instruction->kgt_ref . " as name, product_attributes.value as item_value", FALSE);
            $this->db->where('product_attributes.status',"1");
            $this->db->where('product_attributes.value',$keyword);
            $this->db->from('product_attributes');
            $this->db->join('products as p', 'p.id = product_attributes.product_id', 'LEFT');
            $this->db->limit(20);
            $itemRelationList = $this->db->get()->result_array();
            if(!empty($itemRelationList)) {
                $responce['oem_number'] = $itemRelationList;
            }

            // product table
            $query_s= "select products.*,products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name," . $product_instruction->kgt_ref . " as name from products where status=1 and kgt_ref_number  like '".$keyword."%' limit 20";

            $products = $this->db->query($query_s)->result_array();
            if(!empty($products)) {
                $responce['products'] = $products;
            }

            if(empty($responce['products'])) {
                $query_s= "select products.*,products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name," . $product_instruction->kgt_ref . " as name from products where status=1 and part_name  like '%".$keyword."%' limit 20";

                $products = $this->db->query($query_s)->result_array();
                if(!empty($products)) {
                $responce['products'] = $products;
                }
            }

            if (count($products) < 1) {
                $keyword_array =  explode(" ",$keyword);

                if(count($keyword_array) >= 3){


                    $first = $keyword_array[0];
                    $second= $keyword_array[1];
                    $third= $keyword_array[2];

                    $first_maker = 0;
                    $first_model = 0;
                    $first_group = 0;
                    $first_number = 0;
                    $first_category = 0;
                    $first_year = 0;
                    $second_maker = 0;
                    $second_model = 0;
                    $second_group = 0;
                    $second_number = 0;
                    $second_category = 0;
                    $second_year = 0;
                    $third_maker = 0;
                    $third_model = 0;
                    $third_group = 0;
                    $third_number = 0;
                    $third_category = 0;
                    $third_year = 0;

                    if(isset($first) && !empty($first) && strlen((string)$first) >=3){

                    //check if maker
                    $query = 'select maker_name from tbl_makers where  tbl_makers.maker_name  like "%'.$first.'%" and status = 1 limit 1';
                    $maker1 = $this->db->query($query)->result_array();
                    if(!empty($maker1)) {
                    $first_maker = 1;
                    }

                    //check if model
                    if($first_maker != 1){
                    $query = 'select SUBSTRING(model_name, LOCATE(" ", CONCAT(model_name, " "))+1) as model_name from tbl_models where  model_name  like "%'.$first.'%" and status = 1 limit 1';
                    $model1 = $this->db->query($query)->result_array();
                    if(!empty($model1)) {
                    $first_model = 1;
                    }
                    }

                    // check if group
                    $query = 'select product_type_name from tbl_product_types where  tbl_product_types.product_type_name  like "%'.$first.'%" and status = 1 limit 1';
                    $group1 = $this->db->query($query)->result_array();
                    if(!empty($group1)) {
                    $first_group = 1;
                    }

                    //check if category
                    $query = 'select category_name from tbl_vehicle_categories where  tbl_vehicle_categories.category_name  like "%'.$first.'%" and status = 1 limit 1';
                    $category1 = $this->db->query($query)->result_array();
                    if(!empty($category1)) {
                    $first_category = 1;
                    }


                    if(is_numeric($first)){

                    // Check if number
                    $query = 'select kgt_ref_number from products where  products.kgt_ref_number  like "%'.$first.'%" and status = 1 limit 1';
                    $number1 = $this->db->query($query)->result_array();
                    if(!empty($number1)) {
                    $first_number = 1;
                    }

                    // Check if year
                    $year_query = 'select years from model_engines where  model_engines.years  like "%'.$first.'%" and status = 1 limit 1';
                    $year1 = $this->db->query($year_query)->result_array();
                    if(!empty($year1)) {
                    $first_year = 1;
                    }
                    }
                    }

                    if(isset($second) && !empty($second) && strlen((string)$second) >=3){

                    //check if maker
                    $query = 'select maker_name from tbl_makers where  tbl_makers.maker_name  like "%'.$second.'%" and status = 1 limit 1';
                    $maker2 = $this->db->query($query)->result_array();
                    if(!empty($maker2)) {
                    $second_maker = 1;
                    }

                    //check if model
                    if($second_maker != 1){

                    $query = 'select SUBSTRING(model_name, LOCATE(" ", CONCAT(model_name, " "))+1) as model_name from tbl_models where  model_name  like "%'.$second.'%" and status = 1 limit 1';
                    $model2 = $this->db->query($query)->result_array();
                    if(!empty($model2)) {
                    $second_model = 1;
                    }
                    }

                    // check if group
                    $query = 'select product_type_name from tbl_product_types where  tbl_product_types.product_type_name  like "%'.$second.'%" and status = 1 limit 1';
                    $group2 = $this->db->query($query)->result_array();
                    if(!empty($group2)) {
                    $second_group = 1;
                    }

                    //check if category
                    $query = 'select category_name from tbl_vehicle_categories where  tbl_vehicle_categories.category_name  like "%'.$second.'%" and status = 1 limit 1';
                    $category2 = $this->db->query($query)->result_array();
                    if(!empty($category2)) {
                    $second_category = 1;
                    }


                    if(is_numeric($second)){

                    // Check if number
                    $query = 'select kgt_ref_number from products where  products.kgt_ref_number  like "%'.$second.'%" and status = 1 limit 1';
                    $number2 = $this->db->query($query)->result_array();
                    if(!empty($number2)) {
                    $second_number = 1;
                    }

                    // Check if year
                    $year_query = 'select years from model_engines where  model_engines.years  like "%'.$second.'%" and status = 1 limit 1';
                    $year2 = $this->db->query($year_query)->result_array();
                    if(!empty($year2)) {
                    $second_year = 1;
                    }
                    }
                    }

                    if(isset($third) && !empty($third) && strlen((string)$third) >=3){

                    //check if maker
                    $query = 'select maker_name from tbl_makers where  tbl_makers.maker_name  like "%'.$third.'%" and status = 1 limit 1';
                    $maker3 = $this->db->query($query)->result_array();
                    if(!empty($maker3)) {
                    $third_maker = 1;
                    }

                    //check if model
                    if($third_maker != 1){
                    $query = 'select SUBSTRING(model_name, LOCATE(" ", CONCAT(model_name, " "))+1) as model_name from tbl_models where  model_name  like "%'.$third.'%" and status = 1 limit 1';

                    $model3 = $this->db->query($query)->result_array();
                    if(!empty($model3)) {
                    $third_model = 1;
                    }
                    }

                    // check if group
                    $query = 'select product_type_name from tbl_product_types where  tbl_product_types.product_type_name  like "%'.$third.'%" and status = 1 limit 1';
                    $group3 = $this->db->query($query)->result_array();
                    if(!empty($group3)) {
                    $third_group = 1;
                    }

                    //check if category
                    $query = 'select category_name from tbl_vehicle_categories where  tbl_vehicle_categories.category_name  like "%'.$third.'%" and status = 1 limit 1';
                    $category3 = $this->db->query($query)->result_array();
                    if(!empty($category3)) {
                    $third_category = 1;
                    }


                    if(is_numeric($third)){

                    // Check if number
                    $num_query = 'select kgt_ref_number from products where  products.kgt_ref_number  like "%'.$third.'%" and status = 1 limit 1';
                    $number3 = $this->db->query($num_query)->result_array();
                    if(!empty($number3)) {
                    $third_number = 1;
                    }

                    // Check if year
                    $year_query = 'select years from model_engines where  model_engines.years  like "%'.$third.'%" and status = 1 limit 1';
                    $year3 = $this->db->query($year_query)->result_array();
                     if(!empty($year3)) {
                    $third_year = 1;
                    }
                    }
                    }
                    // Maker model Group combinations Start
                    if(empty($responce['products'])) {

                        // Maker model Group
                        if($first_maker == 1 && $second_model == 1 && $third_group == 1){

                            $query_count ='select count(*) as total from model_groups left join tbl_makers on tbl_makers.id=model_groups.maker_id left join tbl_models on tbl_models.id=model_groups.model_id left join tbl_product_types on tbl_product_types.id=model_groups.product_type_id where   tbl_makers.maker_name  like "%'.$first.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%"  and  tbl_product_types.product_type_name  like "%'.$third.'%";';
                            $query_count_result = $this->db->query($query_count)->row_array();
                            $query_result_count = $query_count_result['total'];


                            if($query_result_count > 0){
                            $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id ,' . $product_instruction->kgt_ref . ' as name from product_models  left join tbl_models on tbl_models.id=product_models.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=product_models.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where  tbl_makers.maker_name  like "%'.$first.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%"  and  tbl_product_types.product_type_name  like "%'.$third.'%"   limit 10';
                            $products = $this->db->query($query)->result_array();
                            if(!empty($products)) {
                            $responce['products'] =  $products;
                            }
                            }
                        }

                        // Maker model Group

                        if ($second_maker == 1 && $first_model == 1 && $third_group == 1) {

                        $query_count ='select count(*) as total from model_groups left join tbl_makers on tbl_makers.id=model_groups.maker_id left join tbl_models on tbl_models.id=model_groups.model_id left join tbl_product_types on tbl_product_types.id=model_groups.product_type_id where   tbl_makers.maker_name  like "%'.$second.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%"  and  tbl_product_types.product_type_name  like "%'.$third.'%";';
                            $query_count_result = $this->db->query($query_count)->row_array();
                            $query_result_count = $query_count_result['total'];


                            if($query_result_count > 0){

                            $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id ,' . $product_instruction->kgt_ref . ' as name from product_models  left join tbl_models on tbl_models.id=product_models.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=product_models.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where  tbl_makers.maker_name  like "%'.$second.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%"  and  tbl_product_types.product_type_name  like "%'.$third.'%"  limit 10';
                            $products = $this->db->query($query)->result_array();
                            if(!empty($products)) {
                            $responce['products'] =  $products;
                            }
                            }
                        }
                        // Maker model Group

                        if ($third_maker == 1 && $first_model == 1 && $second_group == 1) {


                            $query_count ='select count(*) as total from model_groups left join tbl_makers on tbl_makers.id=model_groups.maker_id left join tbl_models on tbl_models.id=model_groups.model_id left join tbl_product_types on tbl_product_types.id=model_groups.product_type_id where   tbl_makers.maker_name  like "%'.$third.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%"  and  tbl_product_types.product_type_name  like "%'.$second.'%";';
                            $query_count_result = $this->db->query($query_count)->row_array();
                            $query_result_count = $query_count_result['total'];


                            if($query_result_count > 0){
                            $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id ,' . $product_instruction->kgt_ref . ' as name from product_models  left join tbl_models on tbl_models.id=product_models.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=product_models.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where  tbl_makers.maker_name  like "%'.$third.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%"  and  tbl_product_types.product_type_name  like "%'.$second.'%"  limit 10';
                            $products = $this->db->query($query)->result_array();
                            if(!empty($products)) {
                            $responce['products'] =  $products;
                            }
                            }
                        }
                        // Maker model Group

                        if ($third_maker == 1 && $second_model == 1 && $first_group == 1) {

                            $query_count ='select count(*) as total from model_groups left join tbl_makers on tbl_makers.id=model_groups.maker_id left join tbl_models on tbl_models.id=model_groups.model_id left join tbl_product_types on tbl_product_types.id=model_groups.product_type_id where   tbl_makers.maker_name  like "%'.$third.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%"  and  tbl_product_types.product_type_name  like "%'.$first.'%";';
                            $query_count_result = $this->db->query($query_count)->row_array();
                            $query_result_count = $query_count_result['total'];


                            if($query_result_count > 0){

                            $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id ,' . $product_instruction->kgt_ref . ' as name from product_models  left join tbl_models on tbl_models.id=product_models.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=product_models.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where  tbl_makers.maker_name  like "%'.$third.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%"  and  tbl_product_types.product_type_name  like "%'.$first.'%"  limit 10';
                            $products = $this->db->query($query)->result_array();
                            if(!empty($products)) {
                            $responce['products'] =  $products;
                            }
                            }
                        }
                        // Maker model Group

                        if ($second_maker == 1 && $third_model == 1 && $first_group == 1) {

                            $query_count ='select count(*) as total from model_groups left join tbl_makers on tbl_makers.id=model_groups.maker_id left join tbl_models on tbl_models.id=model_groups.model_id left join tbl_product_types on tbl_product_types.id=model_groups.product_type_id where   tbl_makers.maker_name  like "%'.$second.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%"  and  tbl_product_types.product_type_name  like "%'.$first.'%";';
                            $query_count_result = $this->db->query($query_count)->row_array();
                            $query_result_count = $query_count_result['total'];


                            if($query_result_count > 0){

                            $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id ,' . $product_instruction->kgt_ref . ' as name from product_models  left join tbl_models on tbl_models.id=product_models.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=product_models.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where  tbl_makers.maker_name  like "%'.$second.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%"  and  tbl_product_types.product_type_name  like "%'.$first.'%"  limit 10';
                            $products = $this->db->query($query)->result_array();
                            if(!empty($products)) {
                            $responce['products'] =  $products;
                            }
                            }
                        }
                        // Maker model Group

                        if ($first_maker == 1 && $third_model == 1 && $second_group == 1) {

                            $query_count ='select count(*) as total from model_groups left join tbl_makers on tbl_makers.id=model_groups.maker_id left join tbl_models on tbl_models.id=model_groups.model_id left join tbl_product_types on tbl_product_types.id=model_groups.product_type_id where   tbl_makers.maker_name  like "%'.$first.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%"  and  tbl_product_types.product_type_name  like "%'.$second.'%";';
                            $query_count_result = $this->db->query($query_count)->row_array();
                            $query_result_count = $query_count_result['total'];


                            if($query_result_count > 0){

                            $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id ,' . $product_instruction->kgt_ref . ' as name from product_models  left join tbl_models on tbl_models.id=product_models.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=product_models.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where  tbl_makers.maker_name  like "%'.$first.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%"  and  tbl_product_types.product_type_name  like "%'.$second.'%"   limit 10';
                            $products = $this->db->query($query)->result_array();
                            if(!empty($products)) {
                            $responce['products'] =  $products;
                            }
                            }

                        }
   
                    }
                    // Maker model Group combinations END

                    // Maker Model Number combinations Start
                    if(empty($responce['products'])) {

                        if ($first_maker == 1 && $second_model == 1 && $third_number == 1) {
                            $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_models as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id  where tbl_makers.maker_name  like "%'.$first.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%"  and  products.kgt_ref_number  like "%'.$third.'%" limit 50';
                            $products = $this->db->query($query)->result_array();
                            if(!empty($products)) {
                            $responce['products'] = $products;
                            }

                        }

                        if ($first_maker == 1 && $third_model == 1 && $second_number == 1) {

                                $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_models as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id  where tbl_makers.maker_name  like "%'.$first.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%"  and  products.kgt_ref_number  like "%'.$second.'%" limit 50';
                                $products = $this->db->query($query)->result_array();
                                if(!empty($products)) {
                                $responce['products'] = $products;
                                }
                                
        
                        }

                        if ($second_maker == 1 && $first_model == 1 && $third_number == 1) {
                            $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_models as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id  where tbl_makers.maker_name  like "%'.$second.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%"  and  products.kgt_ref_number  like "%'.$third.'%" limit 50';
                            $products = $this->db->query($query)->result_array();
                            if(!empty($products)) {
                            $responce['products'] = $products;
                            }

                        }

                        if ($second_maker == 1 && $third_model == 1 && $first_number == 1) {
                            $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_models as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id  where tbl_makers.maker_name  like "%'.$second.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%"  and  products.kgt_ref_number  like "%'.$first.'%" limit 50';
                            $products = $this->db->query($query)->result_array();
                            if(!empty($products)) {
                            $responce['products'] = $products;
                            }

                        }

                        if ($third_maker == 1 && $first_model == 1 && $second_number == 1) {
                            $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_models as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id  where tbl_makers.maker_name  like "%'.$third.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%"  and  products.kgt_ref_number  like "%'.$second_number.'%" limit 50';
                            $products = $this->db->query($query)->result_array();
                            if(!empty($products)) {
                            $responce['products'] = $products;
                            }

                        }

                        if ($third_maker == 1 && $second_model == 1 && $first_number == 1) {
                            $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_models as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id  where tbl_makers.maker_name  like "%'.$third.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%"  and  products.kgt_ref_number  like "%'.$first.'%" limit 50';
                            $products = $this->db->query($query)->result_array();
                            if(!empty($products)) {
                            $responce['products'] = $products;
                            }

                        }
                    
                    }
                    // Maker Model Number combinations END

                    //  Maker model Year  combinations Start
                    if(empty($responce['products'])) {

                        if ($first_maker == 1 && $second_model == 1 && $third_year == 1) {

                            $query_count ='select count(*) as total from model_engines_groups  left join tbl_models on model_engines_groups.model_id=tbl_models.id left join tbl_makers on tbl_makers.id=tbl_models.maker_id where tbl_makers.maker_name  like "%'.$first.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%"  and  model_engines_groups.years  like "%'.$third.'%" ;';
                            $query_count_result = $this->db->query($query_count)->row_array();
                            $query_result_count = $query_count_result['total'];


                            if($query_result_count > 0){

                                $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_models as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id  left join model_engines on tbl_models.id=model_engines.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$first.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%"  and  model_engines.years  like "%'.$third.'%"  limit 10';
                                $products = $this->db->query($query)->result_array();
                                if(!empty($products)) {
                                $responce['products'] = $products;
                                }
                            }
                        }

                        if ($first_maker == 1 && $third_model == 1 && $second_year == 1) {

                            $query_count ='select count(*) as total from model_engines_groups  left join tbl_models on model_engines_groups.model_id=tbl_models.id left join tbl_makers on tbl_makers.id=tbl_models.maker_id where tbl_makers.maker_name  like "%'.$first.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%"  and  model_engines_groups.years  like "%'.$second.'%" ;';
                            $query_count_result = $this->db->query($query_count)->row_array();
                            $query_result_count = $query_count_result['total'];


                            if($query_result_count > 0){
                                $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$first.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%"  and  prduct_drp.value  like "%'.$second.'%"   limit 10';
                                $products = $this->db->query($query)->result_array();
                                if(!empty($products)) {
                                $responce['products'] = $products;
                                }
                            }
                        }

                        if ($second_maker == 1 && $first_model == 1 && $third_year == 1) {

                            $query_count ='select count(*) as total from model_engines_groups  left join tbl_models on model_engines_groups.model_id=tbl_models.id left join tbl_makers on tbl_makers.id=tbl_models.maker_id where tbl_makers.maker_name  like "%'.$second.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%"  and  model_engines_groups.years  like "%'.$third.'%" ;';
                            $query_count_result = $this->db->query($query_count)->row_array();
                            $query_result_count = $query_count_result['total'];


                            if($query_result_count > 0){
                                $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$second.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%"  and  prduct_drp.value  like "%'.$third.'%" limit 10';
                                $products = $this->db->query($query)->result_array();
                                if(!empty($products)) {
                                $responce['products'] = $products;
                                }
                            }
                        }

                        if ($second_maker == 1 && $third_model == 1 && $first_year == 1) {
                            $query_count ='select count(*) as total from model_engines_groups  left join tbl_models on model_engines_groups.model_id=tbl_models.id left join tbl_makers on tbl_makers.id=tbl_models.maker_id where tbl_makers.maker_name  like "%'.$second.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%"  and  model_engines_groups.years  like "%'.$first.'%" ;';
                            $query_count_result = $this->db->query($query_count)->row_array();
                            $query_result_count = $query_count_result['total'];


                            if($query_result_count > 0){
                            $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$second.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%"  and  prduct_drp.value  like "%'.$first.'%" limit 10';
                            $products = $this->db->query($query)->result_array();
                            if(!empty($products)) {
                            $responce['products'] = $products;
                            }
                            }
                        }

                        if ($third_maker == 1 && $first_model == 1 && $second_year == 1) {

                            $query_count ='select count(*) as total from model_engines_groups  left join tbl_models on model_engines_groups.model_id=tbl_models.id left join tbl_makers on tbl_makers.id=tbl_models.maker_id where tbl_makers.maker_name  like "%'.$second.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%"  and  model_engines_groups.years  like "%'.$first.'%" ;';
                            $query_count_result = $this->db->query($query_count)->row_array();
                            $query_result_count = $query_count_result['total'];


                            if($query_result_count > 0){
                            $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$second.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%"  and  prduct_drp.value  like "%'.$first.'%" ';
                            $products = $this->db->query($query)->result_array();
                            if(!empty($products)) {
                            $responce['products'] = $products;
                            }
                            }
                        }

                        if ($third_maker == 1 && $second_model == 1 && $first_year == 1) {
                            $query_count ='select count(*) as total from model_engines_groups  left join tbl_models on model_engines_groups.model_id=tbl_models.id left join tbl_makers on tbl_makers.id=tbl_models.maker_id where tbl_makers.maker_name  like "%'.$third.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%"  and  model_engines_groups.years  like "%'.$first.'%" ;';
                            $query_count_result = $this->db->query($query_count)->row_array();
                            $query_result_count = $query_count_result['total'];


                            if($query_result_count > 0){
                                $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$third.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%"  and  prduct_drp.value  like "%'.$first.'%"   limit 10';
                                $products = $this->db->query($query)->result_array();
                                if(!empty($products)) {
                                $responce['products'] = $products;
                                }
                            }
                        }
                    }
                    // Maker model Year  combinations END
                    
                    // Maker Group Year  combinations Start
                    if(empty($responce['products'])) {
                        if ($first_maker == 1 && $second_group == 1 && $third_year == 1) {

                                $query_count ='select count(*) as total from model_engines_groups  left join tbl_models on model_engines_groups.model_id=tbl_models.id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_product_types on model_engines_groups.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$first.'%" and tbl_product_types.product_type_name  like "%'.$second.'%"   and  model_engines_groups.years  like "%'.$third.'%" ;';
                                $query_count_result = $this->db->query($query_count)->row_array();
                                $query_result_count = $query_count_result['total'];


                                if($query_result_count > 0){
                                $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$first.'%" and tbl_product_types.product_type_name  like "%'.$second.'%"  and  prduct_drp.value like "%'.$third.'%"  limit 10';
                                $products = $this->db->query($query)->result_array();
                                if(!empty($products)) {
                                $responce['products'] = $products;
                                }
                                }
                         }

                        if ($first_maker == 1 && $third_group == 1 && $second_year == 1) {

                            $query_count ='select count(*) as total from model_engines_groups  left join tbl_models on model_engines_groups.model_id=tbl_models.id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_product_types on model_engines_groups.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$first.'%" and tbl_product_types.product_type_name  like "%'.$third.'%"   and  model_engines_groups.years  like "%'.$second.'%" ;';
                            $query_count_result = $this->db->query($query_count)->row_array();
                            $query_result_count = $query_count_result['total'];


                            if($query_result_count > 0){
                                $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$first.'%" and tbl_product_types.product_type_name  like "%'.$third.'%"  and  prduct_drp.value like "%'.$second.'%"  limit 10';
                                $products = $this->db->query($query)->result_array();
                                if(!empty($products)) {
                                $responce['products'] = $products;
                                }
                            }
                        }

                        if ($second_maker == 1 && $one_group == 1 && $third_year == 1) {

                            $query_count ='select count(*) as total from model_engines_groups  left join tbl_models on model_engines_groups.model_id=tbl_models.id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_product_types on model_engines_groups.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$second.'%" and tbl_product_types.product_type_name  like "%'.$first.'%"   and  model_engines_groups.years  like "%'.$third.'%" ;';
                            $query_count_result = $this->db->query($query_count)->row_array();
                            $query_result_count = $query_count_result['total'];


                            if($query_result_count > 0){
                                $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$second.'%" and tbl_product_types.product_type_name  like "%'.$first.'%"  and  prduct_drp.value like "%'.$third.'%"  limit 10';
                                $products = $this->db->query($query)->result_array();
                                if(!empty($products)) {
                                $responce['products'] = $products;
                                }
                            }
                        }

                        if ($second_maker == 1 && $third_group == 1 && $first_year == 1) {

                            $query_count ='select count(*) as total from model_engines_groups  left join tbl_models on model_engines_groups.model_id=tbl_models.id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_product_types on model_engines_groups.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$second.'%" and tbl_product_types.product_type_name  like "%'.$third.'%"   and  model_engines_groups.years  like "%'.$first.'%" ;';
                            $query_count_result = $this->db->query($query_count)->row_array();
                            $query_result_count = $query_count_result['total'];


                            if($query_result_count > 0){    
                                $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$second.'%" and tbl_product_types.product_type_name  like "%'.$third.'%"  and  prduct_drp.value like "%'.$first.'%"  limit 10';
                                $products = $this->db->query($query)->result_array();
                                if(!empty($products)) {
                                $responce['products'] = $products;
                                }
                            }
                        }

                        if ($third_maker == 1 && $first_group == 1 && $second_year == 1) {

                            $query_count ='select count(*) as total from model_engines_groups  left join tbl_models on model_engines_groups.model_id=tbl_models.id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_product_types on model_engines_groups.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$third.'%" and tbl_product_types.product_type_name  like "%'.$first.'%"   and  model_engines_groups.years  like "%'.$second.'%" ;';
                            $query_count_result = $this->db->query($query_count)->row_array();
                            $query_result_count = $query_count_result['total'];


                            if($query_result_count > 0){   
                                $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$third.'%" and tbl_product_types.product_type_name  like "%'.$first.'%"  and  prduct_drp.value like "%'.$second.'%"  limit 10';
                                $products = $this->db->query($query)->result_array();
                                if(!empty($products)) {
                                $responce['products'] = $products;
                                }
                            }
                        }

                        if ($third_maker == 1 && $second_group == 1 && $first_year == 1) {
                        
                            $query_count ='select count(*) as total from model_engines_groups  left join tbl_models on model_engines_groups.model_id=tbl_models.id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_product_types on model_engines_groups.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$third.'%" and tbl_product_types.product_type_name  like "%'.$second.'%"   and  model_engines_groups.years  like "%'.$first.'%" ;';
                            $query_count_result = $this->db->query($query_count)->row_array();
                            $query_result_count = $query_count_result['total'];


                            if($query_result_count > 0){   
                                $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$third.'%" and tbl_product_types.product_type_name  like "%'.$second.'%"  and  prduct_drp.value like "%'.$first.'%"   limit 10';
                                $products = $this->db->query($query)->result_array();
                                if(!empty($products)) {
                                $responce['products'] = $products;
                                }
                            }
                        }
                    } 
                    // Maker Group Year  combinations END

                    // Maker Model Category
                    if(empty($responce['products'])) {

                        if ($first_maker == 1 && $second_model == 1 &&      $third_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id ,' . $product_instruction->kgt_ref . ' as name from product_models  left join tbl_models on tbl_models.id=product_models.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id  left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=product_models.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where  tbl_makers.maker_name  like "%'.$first.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%"  and  tbl_vehicle_categories.category_name  like "%'.$third.'%"    limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] =  $products;
                        }
                        }

                        if ($first_maker == 1 && $third_model == 1 && $second_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id ,' . $product_instruction->kgt_ref . ' as name from product_models  left join tbl_models on tbl_models.id=product_models.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id  left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=product_models.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where  tbl_makers.maker_name  like "%'.$first.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%"  and  tbl_vehicle_categories.category_name  like "%'.$second.'%"    limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] =  $products;
                        }
                        }

                        if ($second_maker == 1 && $first_model == 1 && $third_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id ,' . $product_instruction->kgt_ref . ' as name from product_models  left join tbl_models on tbl_models.id=product_models.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id  left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=product_models.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where  tbl_makers.maker_name  like "%'.$second.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%"  and  tbl_vehicle_categories.category_name  like "%'.$third.'%"    limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] =  $products;
                        }
                        }

                        if ($second_maker == 1 && $third_model == 1 && $first_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id ,' . $product_instruction->kgt_ref . ' as name from product_models  left join tbl_models on tbl_models.id=product_models.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id  left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=product_models.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where  tbl_makers.maker_name  like "%'.$second.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%"  and  tbl_vehicle_categories.category_name  like "%'.$first.'%"    limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] =  $products;
                        }
                        }

                        if ($third_maker == 1 && $first_model == 1 && $second_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id ,' . $product_instruction->kgt_ref . ' as name from product_models  left join tbl_models on tbl_models.id=product_models.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id  left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=product_models.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where  tbl_makers.maker_name  like "%'.$third.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%"  and  tbl_vehicle_categories.category_name  like "%'.$second.'%"    limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] =  $products;
                        }
                        }

                        if ($third_maker == 1 && $second_model == 1 && $first_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id ,' . $product_instruction->kgt_ref . ' as name from product_models  left join tbl_models on tbl_models.id=product_models.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id  left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=product_models.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where  tbl_makers.maker_name  like "%'.$third.'%" and SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%"  and  tbl_vehicle_categories.category_name  like "%'.$first.'%"    limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] =  $products;
                        }
                        }
                    }
                    // END  Maker model Year

                    // Maker Category Group  
                    if(empty($responce['products'])) {

                        if ($first_maker == 1 && $second_category == 1 && $third_group == 1) {
                         $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$first.'%" and tbl_vehicle_categories.category_name  like "%'.$second.'%"  and  tbl_product_types.product_type_name like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($first_maker == 1 && $third_category == 1 && $second_group == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$first.'%" and tbl_vehicle_categories.category_name  like "%'.$second.'%"  and  tbl_product_types.product_type_name like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($second_maker == 1 && $first_category == 1 && $third_group == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$second.'%" and tbl_vehicle_categories.category_name  like "%'.$first.'%"  and  tbl_product_types.product_type_name like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($second_maker == 1 && $third_category == 1 && $first_group == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$second.'%" and tbl_vehicle_categories.category_name  like "%'.$third.'%"  and  tbl_product_types.product_type_name like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($third_maker == 1 && $first_category == 1 && $second_group == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$third.'%" and tbl_vehicle_categories.category_name  like "%'.$first.'%"  and  tbl_product_types.product_type_name like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($third_maker == 1 && $second_category == 1 && $first_group == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$third.'%" and tbl_vehicle_categories.category_name  like "%'.$second.'%"  and  tbl_product_types.product_type_name like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }
                    }
                    // END Maker Group Category

                    // Maker Group Number Start
                    if(empty($responce['products'])) {

                        if ($first_maker == 1 && $second_group == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$first.'%" and tbl_product_types.product_type_name  like "%'.$second.'%"  and  products.kgt_ref_number like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($first_maker == 1 && $third_group == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$first.'%" and tbl_product_types.product_type_name  like "%'.$third.'%"  and  products.kgt_ref_number like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($second_maker == 1 && $first_group == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$second.'%" and tbl_product_types.product_type_name  like "%'.$first.'%"  and  products.kgt_ref_number like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($second_maker == 1 && $third_group == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$second.'%" and tbl_product_types.product_type_name  like "%'.$third.'%"  and  products.kgt_ref_number like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($third_maker == 1 && $first_group == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$third.'%" and tbl_product_types.product_type_name  like "%'.$first.'%"  and  products.kgt_ref_number like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($third_maker == 1 && $second_group == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$third.'%" and tbl_product_types.product_type_name  like "%'.$second.'%"  and  products.kgt_ref_number like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                         }
                    }
                    // END Maker Group Number

                    // Maker Year Category Start
                    if(empty($responce['products'])) {

                        if ($first_maker == 1 && $second_year == 1 && $third_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$first.'%" and prduct_drp.value  like "%'.$second.'%"  and  tbl_vehicle_categories.category_name like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($first_maker == 1 && $third_year == 1 && $second_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$first.'%" and prduct_drp.value  like "%'.$third.'%"  and  tbl_vehicle_categories.category_name like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($second_maker == 1 && $first_year == 1 && $third_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$second.'%" and prduct_drp.value  like "%'.$first.'%"  and  tbl_vehicle_categories.category_name like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($second_maker == 1 && $third_year == 1 && $first_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$second.'%" and prduct_drp.value  like "%'.$third.'%"  and  tbl_vehicle_categories.category_name like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($third_maker == 1 && $first_year == 1 && $second_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$third.'%" and prduct_drp.value  like "%'.$first.'%"  and  tbl_vehicle_categories.category_name like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($third_maker == 1 && $second_year == 1 && $first_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$third.'%" and prduct_drp.value  like "%'.$second.'%"  and  tbl_vehicle_categories.category_name like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }
                    }
                    // END Maker Year Category

                    // Maker Year Number 
                    if(empty($responce['products'])) {
    
                        if ($first_maker == 1 && $second_year == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$first.'%" and prduct_drp.value  like "%'.$second.'%"  and  products.kgt_ref_number like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($first_maker == 1 && $third_year == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$first.'%" and prduct_drp.value  like "%'.$third.'%"  and  products.kgt_ref_number like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($second_maker == 1 && $first_year == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$second.'%" and prduct_drp.value  like "%'.$first.'%"  and  products.kgt_ref_number like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($second_maker == 1 && $third_year == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$second.'%" and prduct_drp.value  like "%'.$third.'%"  and  products.kgt_ref_number like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($third_maker == 1 && $first_year == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$third.'%" and prduct_drp.value  like "%'.$first.'%"  and  products.kgt_ref_number like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($third_maker == 1 && $second_year == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$third.'%" and prduct_drp.value  like "%'.$second.'%"  and  products.kgt_ref_number like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        } 
                    }
                    // Maker Category Number
                    if(empty($responce['products'])) {

                        if ($first_maker == 1 && $second_category == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$first.'%" and tbl_vehicle_categories.category_name  like "%'.$second.'%"  and  products.kgt_ref_number like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($first_maker == 1 && $third_category == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$first.'%" and tbl_vehicle_categories.category_name  like "%'.$third.'%"  and  products.kgt_ref_number like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($second_maker == 1 && $first_category == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$second.'%" and tbl_vehicle_categories.category_name  like "%'.$first.'%"  and  products.kgt_ref_number like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($second_maker == 1 && $third_category == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$second.'%" and tbl_vehicle_categories.category_name  like "%'.$third.'%"  and  products.kgt_ref_number like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($third_maker == 1 && $first_category == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$third.'%" and tbl_vehicle_categories.category_name  like "%'.$first.'%"  and  products.kgt_ref_number like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($third_maker == 1 && $second_category == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_makers.maker_name  like "%'.$third.'%" and tbl_vehicle_categories.category_name  like "%'.$second.'%"  and  products.kgt_ref_number like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }
                    }
                    //Model group category
                    if(empty($responce['products'])) {

                        if ($first_model == 1 && $second_group == 1 && $third_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%" and tbl_product_types.product_type_name  like "%'.$second.'%"  and  tbl_vehicle_categories.category_name like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($first_model == 1 && $third_group == 1 && $second_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%" and tbl_product_types.product_type_name  like "%'.$third.'%"  and  tbl_vehicle_categories.category_name like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($second_model == 1 && $first_group == 1 && $third_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%" and tbl_product_types.product_type_name  like "%'.$first.'%"  and  tbl_vehicle_categories.category_name like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($second_model == 1 && $third_group == 1 && $first_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%" and tbl_product_types.product_type_name  like "%'.$third.'%"  and  tbl_vehicle_categories.category_name like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($third_model == 1 && $first_group == 1 && $second_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%" and tbl_product_types.product_type_name  like "%'.$first.'%"  and  tbl_vehicle_categories.category_name like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($third_model == 1 && $second_group == 1 && $first_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%" and tbl_product_types.product_type_name  like "%'.$second.'%"  and  tbl_vehicle_categories.category_name like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }
                    }

                    //Model group number
                    if(empty($responce['products'])) {

                        if ($first_model == 1 && $second_group == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%" and tbl_product_types.product_type_name  like "%'.$second.'%"  and  products.kgt_ref_number like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($first_model == 1 && $third_group == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%" and tbl_product_types.product_type_name  like "%'.$third.'%"  and  products.kgt_ref_number like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($second_model == 1 && $first_group == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%" and tbl_product_types.product_type_name  like "%'.$first.'%"  and  products.kgt_ref_number like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($second_model == 1 && $third_group == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%" and tbl_product_types.product_type_name  like "%'.$third.'%"  and  products.kgt_ref_number like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($third_model == 1 && $first_group == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%" and tbl_product_types.product_type_name  like "%'.$first.'%"  and  products.kgt_ref_number like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }

                        if ($third_model == 1 && $second_group == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id   left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%" and tbl_product_types.product_type_name  like "%'.$second.'%"  and  products.kgt_ref_number like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }

                        }
                    }
                    //Model category number
                    if(empty($responce['products'])) {

                        if ($first_model == 1 && $second_category == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%" and tbl_vehicle_categories.category_name  like "%'.$second.'%"  and  products.kgt_ref_number like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($first_model == 1 && $third_category == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%" and tbl_vehicle_categories.category_name  like "%'.$third.'%"  and  products.kgt_ref_number like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($second_model == 1 && $first_category == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%" and tbl_vehicle_categories.category_name  like "%'.$first.'%"  and  products.kgt_ref_number like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($second_model == 1 && $third_category == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%" and tbl_vehicle_categories.category_name  like "%'.$third.'%"  and  products.kgt_ref_number like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($third_model == 1 && $first_category == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%" and tbl_vehicle_categories.category_name  like "%'.$first.'%"  and  products.kgt_ref_number like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($third_model == 1 && $second_category == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%" and tbl_vehicle_categories.category_name  like "%'.$second.'%"  and  products.kgt_ref_number like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }
                    }

                    //Group category number
                    if(empty($responce['products'])) {

                        if ($first_group == 1 && $second_category == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_product_types.product_type_name  like "%'.$first.'%" and tbl_vehicle_categories.category_name  like "%'.$second.'%"  and  products.kgt_ref_number like "%'.$third.'%"   limit 10';

                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($first_group == 1 && $third_category == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_product_types.product_type_name  like "%'.$first.'%" and tbl_vehicle_categories.category_name  like "%'.$third.'%"  and  products.kgt_ref_number like "%'.$second.'%"   limit 10';

                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($second_group == 1 && $first_category == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_product_types.product_type_name  like "%'.$second.'%" and tbl_vehicle_categories.category_name  like "%'.$first.'%"  and  products.kgt_ref_number like "%'.$third.'%"   limit 10';

                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($second_group == 1 && $third_category == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_product_types.product_type_name  like "%'.$second.'%" and tbl_vehicle_categories.category_name  like "%'.$third.'%"  and  products.kgt_ref_number like "%'.$first.'%"   limit 10';

                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($third_group == 1 && $first_category == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_items as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_product_types.product_type_name  like "%'.$third.'%" and tbl_vehicle_categories.category_name  like "%'.$first.'%"  and  products.kgt_ref_number like "%'.$second.'%"   limit 10';

                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($third_group == 1 && $second_category == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from product_models as prduct_drp left join tbl_models on tbl_models.id=prduct_drp.model_id  left join model_engines on tbl_models.id=model_engines.model_id left join tbl_makers on tbl_makers.id=tbl_models.maker_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id  left join products on products.id=prduct_drp.product_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_product_types.product_type_name  like "%'.$third.'%" and tbl_vehicle_categories.category_name  like "%'.$second.'%"  and  products.kgt_ref_number like "%'.$first.'%"   limit 10';

                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }
                    }
                    //Model group year
                    if(empty($responce['products'])) {

                        if ($first_model == 1 && $second_group == 1 && $third_year == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%" and tbl_product_types.product_type_name  like "%'.$second.'%"  and  model_engines.years like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($first_model == 1 && $third_group == 1 && $second_year == 1) {                        
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%" and tbl_product_types.product_type_name  like "%'.$third.'%"  and  model_engines.years like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($second_model == 1 && $first_group == 1 && $third_year == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%" and tbl_product_types.product_type_name  like "%'.$first.'%"  and  model_engines.years like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($second_model == 1 && $third_group == 1 && $first_year == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%" and tbl_product_types.product_type_name  like "%'.$third.'%"  and  model_engines.years like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($third_model == 1 && $first_group == 1 && $second_year == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%" and tbl_product_types.product_type_name  like "%'.$first.'%"  and  model_engines.years like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($third_model == 1 && $second_group == 1 && $first_year == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%" and tbl_product_types.product_type_name  like "%'.$second.'%"  and  model_engines.years like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }
                    }
                    //Model year category
                    if(empty($responce['products'])) {

                        if ($first_model == 1 && $second_year == 1 && $third_category == 1) {
                    
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%" and model_engines.years  like "%'.$second.'%"  and tbl_vehicle_categories.category_name like "%'.$third.'%"   limit 10';

                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($first_model == 1 && $third_year == 1 && $second_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%" and model_engines.years  like "%'.$third.'%"  and tbl_vehicle_categories.category_name like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($second_model == 1 && $first_year == 1 && $third_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%" and model_engines.years  like "%'.$first.'%"  and tbl_vehicle_categories.category_name like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($second_model == 1 && $third_year == 1 && $first_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%" and model_engines.years  like "%'.$third.'%"  and tbl_vehicle_categories.category_name like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($third_model == 1 && $first_year == 1 && $second_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%" and model_engines.years  like "%'.$first.'%"  and tbl_vehicle_categories.category_name like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($third_model == 1 && $second_year == 1 && $first_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%" and model_engines.years  like "%'.$second.'%"  and tbl_vehicle_categories.category_name like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }
                    }
                    //Model year number
                    if(empty($responce['products'])) {

                        if ($first_model == 1 && $second_year == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%" and model_engines.years  like "%'.$second.'%"  and products.kgt_ref_number like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($first_model == 1 && $third_year == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$first.'%" and model_engines.years  like "%'.$third.'%"  and products.kgt_ref_number like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($second_model == 1 && $first_year == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%" and model_engines.years  like "%'.$first.'%"  and products.kgt_ref_number like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($second_model == 1 && $third_year == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$second.'%" and model_engines.years  like "%'.$third.'%"  and products.kgt_ref_number like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($third_model == 1 && $first_year == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%" and model_engines.years  like "%'.$first.'%"  and products.kgt_ref_number like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($third_model == 1 && $second_year == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id where SUBSTRING(tbl_models.model_name, LOCATE(" ", CONCAT(tbl_models.model_name, " "))+1)  like "%'.$third.'%" and model_engines.years  like "%'.$second.'%"  and products.kgt_ref_number like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }
                    }

                    //Group year category
                    if(empty($responce['products'])) {

                        if ($first_group == 1 && $second_year == 1 && $third_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where tbl_product_types.product_type_name  like "%'.$first.'%" and model_engines.years  like "%'.$second.'%"  and tbl_vehicle_categories.category_name like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($first_group == 1 && $third_year == 1 && $second_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where tbl_product_types.product_type_name  like "%'.$first.'%" and model_engines.years  like "%'.$third.'%"  and tbl_vehicle_categories.category_name like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($second_group == 1 && $first_year == 1 && $third_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where tbl_product_types.product_type_name  like "%'.$second.'%" and model_engines.years  like "%'.$first.'%"  and tbl_vehicle_categories.category_name like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($second_group == 1 && $third_year == 1 && $first_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where tbl_product_types.product_type_name  like "%'.$second.'%" and model_engines.years  like "%'.$third.'%"  and tbl_vehicle_categories.category_name like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($third_group == 1 && $first_year == 1 && $second_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where tbl_product_types.product_type_name  like "%'.$third.'%" and model_engines.years  like "%'.$first.'%"  and tbl_vehicle_categories.category_name like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($third_group == 1 && $second_year == 1 && $first_category == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where tbl_product_types.product_type_name  like "%'.$third.'%" and model_engines.years  like "%'.$second.'%"  and tbl_vehicle_categories.category_name like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }
                    }


                    //Group year number
                    if(empty($responce['products'])) {

                        if ($first_group == 1 && $second_year == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_product_types.product_type_name  like "%'.$first.'%" and model_engines.years  like "%'.$second.'%"  and products.kgt_ref_number like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($first_group == 1 && $third_year == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_product_types.product_type_name  like "%'.$first.'%" and model_engines.years  like "%'.$third.'%"  and products.kgt_ref_number like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($second_group == 1 && $first_year == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_product_types.product_type_name  like "%'.$second.'%" and model_engines.years  like "%'.$first.'%"  and products.kgt_ref_number like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($second_group == 1 && $third_year == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_product_types.product_type_name  like "%'.$second.'%" and model_engines.years  like "%'.$third.'%"  and products.kgt_ref_number like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($third_group == 1 && $first_year == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_product_types.product_type_name  like "%'.$third.'%" and model_engines.years  like "%'.$first.'%"  and products.kgt_ref_number like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($third_group == 1 && $second_year == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_product_types on products.product_type_id =  tbl_product_types.id where tbl_product_types.product_type_name  like "%'.$third.'%" and model_engines.years  like "%'.$second.'%"  and products.kgt_ref_number like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }
                    }

                    //Year category number
                    if(empty($responce['products'])) {

                        if ($first_year == 1 && $second_category == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where model_engines.years  like "%'.$first.'%" and tbl_vehicle_categories.category_name  like "%'.$second.'%"  and products.kgt_ref_number like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($first_year == 1 && $third_category == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where model_engines.years  like "%'.$first.'%" and tbl_vehicle_categories.category_name  like "%'.$third.'%"  and products.kgt_ref_number like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($second_year == 1 && $first_category == 1 && $third_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where model_engines.years  like "%'.$second.'%" and tbl_vehicle_categories.category_name  like "%'.$first.'%"  and products.kgt_ref_number like "%'.$third.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($second_year == 1 && $third_category == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where model_engines.years  like "%'.$second.'%" and tbl_vehicle_categories.category_name  like "%'.$third.'%"  and products.kgt_ref_number like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($third_year == 1 && $first_category == 1 && $second_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where model_engines.years  like "%'.$third.'%" and tbl_vehicle_categories.category_name  like "%'.$first.'%"  and products.kgt_ref_number like "%'.$second.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }

                        if ($third_year == 1 && $second_category == 1 && $first_number == 1) {
                        $query = 'select products.kgt_ref_number as value,products.kgt_ref_number as display,products.part_name,tbl_models.id as id,' . $product_instruction->kgt_ref . ' as name from products  left join product_models on products.id=product_models.product_id left join tbl_models on tbl_models.id=product_models.model_id left join model_engines on tbl_models.id=model_engines.model_id left join tbl_vehicle_categories on tbl_vehicle_categories.id=tbl_models.vehicle_category_id where model_engines.years  like "%'.$third.'%" and tbl_vehicle_categories.category_name  like "%'.$second.'%"  and products.kgt_ref_number like "%'.$first.'%"   limit 10';
                        $products = $this->db->query($query)->result_array();
                        if(!empty($products)) {
                        $responce['products'] = $products;
                        }
                        }
                    }
                    
                }
            }

               
            return $responce;
         }
        


        function all_product_categories()
        {

            $this->db->select('category_id');
            $this->db->from('product_models');
            $this->db->group_by('product_models.category_id');

            $result = $this->db->get()->result_array();
            
            $category_ids = array();
            foreach($result as $single_maker){

                $category_ids[]=$single_maker['category_id'];
            }
            

            return  $category_ids;
        }

        function all_product_makers()
        {
            
            $this->db->select('maker_id');
            $this->db->from('product_models');
            $this->db->group_by('product_models.maker_id');

            $result = $this->db->get()->result_array();
            $makerIds = array();
            foreach($result as $single_maker){

                $makerIds[]=$single_maker['maker_id'];
            }
            

            return  $makerIds;
        }

        function all_product_models()
        {
            $this->db->select('model_id');
            $this->db->from('product_models');
            $this->db->group_by('product_models.model_id');

            $result = $this->db->get()->result_array();
            $modelIds = array();
            foreach($result as $single_maker){

                $modelIds[]=$single_maker['model_id'];
            }
            

            return  $modelIds;
        }

        function all_product_group()
        {

            $this->db->select('product_type_id');
            $this->db->from('products');
            $this->db->group_by('products.product_type_id');

            $result = $this->db->get()->result_array();
            $groups = array();
            foreach($result as $single_group){

                $groups[]=$single_group['product_type_id'];
            }
            

            return  $groups;
        }

        function all_product_nature()
        {

            $this->db->select('item_nature_id');
            $this->db->from('products');
            $this->db->group_by('products.item_nature_id');

            $result = $this->db->get()->result_array();
            $groups = array();
            foreach($result as $single_group){

                $groups[]=$single_group['item_nature_id'];
            }
            

            return  $groups;
        }
    }
