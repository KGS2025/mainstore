<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function getcartcount($cart)
{
    $cart = cartCleanUp($cart);
    $cartcount = is_array($cart) ? count($cart) : 0;
    return $cartcount;
}

function cartCleanUp($cart = array())
{
    if (empty($cart)) return false;

    foreach ($cart as $key => $value) {
        if ($key != $value['item_id']) unset($cart[$key]);
    }

    return $cart;
}

function getEngineSizes_view($year = '', $product_id = '', $product_model_id = '', $product_item_id = '')
{
    $ci = &get_instance();

    $lang_id = $ci->lang->default_lang_id;

    // This Function return list of all engine sizes corresponding to product_id / product_model_id / product_item_id
    $response = array();
    if ($year) {
        // $product_id = $this->input->get('product_id');
        // $product_model_id  = $this->input->get('product_model_id');
        // $product_item_id = $this->input->get('product_item_id');

        $whereArr = array('product_id' => $product_id, 'product_model_id' => $product_model_id, 'product_item_id' => $product_item_id, 'value' => $year);
        // exit;

        // $ci->db->select('engine_size, id,position,vehicle_attributes,application_notes');
        // $ci->db->where($whereArr);
        // $ci->db->group_by('engine_size');

        // $response  = $ci->db->get('tbl_product_item_relation_dropdown')->result_array();

        $ci->db->select('pi.*, pic.*');
        $ci->db->where($whereArr);
        $ci->db->from('tbl_product_item_relation_dropdown as pi');
        $ci->db->join('tbl_product_item_relation_dropdown_country as pic', 'pi.id = pic.lang_id AND pic.country_id = ' . $lang_id, 'LEFT');
        $ci->db->group_by('engine_size');
        $response = $ci->db->get()->result_array();

        // exit;
    }

    // retutn the json response
    return $response;
}


if (!function_exists("getVehicleCategoryList")) {
    function getVehicleCategoryList($lang_id, $product_type_id = '')
    {
        $ci = &get_instance();
        $list = array();

        if ($product_type_id == '') {
        $ci->db->select('tbl_vehicle_categories.*,tbl_vehicle_categories_country.lang_category_name');

        $ci->db->join('tbl_vehicle_categories', 'tbl_models.vehicle_category_id=tbl_vehicle_categories.id', 'LEFT');
        $ci->db->join('tbl_vehicle_categories_country', 'tbl_vehicle_categories.id = tbl_vehicle_categories_country.lang_id AND tbl_vehicle_categories_country.country_id =' . $lang_id, 'LEFT');
        $ci->db->where('tbl_vehicle_categories.status',1);
        $ci->db->where('tbl_models.status',1);
        $ci->db->group_by('tbl_vehicle_categories.id');
        $ci->db->from('tbl_models');
        $list = $ci->db->get()->result_array();

        } else {

            $ci->db->select('tbl_vehicle_categories.*,tbl_vehicle_categories_country.lang_category_name');
            $ci->db->where('tbl_vehicle_categories.status',1);
    
            if ($product_type_id != '') {
            $ci->db->join('model_groups', 'model_groups.category_id=tbl_vehicle_categories.id', 'LEFT');
            $ci->db->where('model_groups.product_type_id', $product_type_id);
            }
            $ci->db->join('tbl_vehicle_categories_country', 'tbl_vehicle_categories.id = tbl_vehicle_categories_country.lang_id AND tbl_vehicle_categories_country.country_id =' . $lang_id, 'LEFT');
            $ci->db->where('tbl_vehicle_categories.status',1);

            $ci->db->group_by('tbl_vehicle_categories.id');
            $ci->db->from('tbl_vehicle_categories');
            $list = $ci->db->get()->result_array();

        }
        return $list;
    }
}

if (!function_exists("getMakerByProductType")) {
    function getMakerByProductType($lang_id, $categoryId, $product_type_id,$search,$offset)
    {
        $ci = &get_instance();
        $list = array();
        $ci->db->select('tbl_makers.*,tbl_makers_country.lang_maker_name');
        $ci->db->join('model_groups', 'model_groups.maker_id=tbl_makers.id', 'LEFT');
        $ci->db->where('model_groups.product_type_id', $product_type_id);
        if($categoryId != "all") {
        $ci->db->where('model_groups.category_id', $categoryId);
        }

        if($search != '') {
        $ci->db->like('tbl_makers.maker_name', $search , 'both'); 
        }
        $ci->db->join('tbl_makers_country', 'tbl_makers.id = tbl_makers_country.lang_id AND tbl_makers_country.country_id =' . $lang_id, 'LEFT');
        $ci->db->group_by('tbl_makers.id');
        $ci->db->order_by('tbl_makers.maker_name', 'ASC');
        $ci->db->from('tbl_makers');
        $ci->db->limit($ci->config->item('pagination_limit'), $offset);

        $list = $ci->db->get()->result_array();
        return $list;
    }
}
if (!function_exists("getMakerByProductType_count")) {
    function getMakerByProductType_count($categoryId, $product_type_id,$search)
    {
        $ci = &get_instance();
        $list = array();
        $ci->db->select('count(*)  as total');
        $ci->db->join('model_groups', 'model_groups.maker_id=tbl_makers.id', 'LEFT');
        $ci->db->where('model_groups.product_type_id', $product_type_id);
        if($categoryId != "all") {
        $ci->db->where('model_groups.category_id', $categoryId);
        }
        if($search != '') {
        $ci->db->like('tbl_makers.maker_name', $search , 'both'); 
        }
        $ci->db->group_by('tbl_makers.id');
        $ci->db->from('tbl_makers');
        $list = $ci->db->get()->row_array();
        // echo $ci->db->last_query();
 
         return $list['total'];
    }
}


if (!function_exists("getModelByProductType")) {
    function getModelByProductType($lang_id, $categoryId, $product_type_id, $makerId,$search,$offset)
    {
        $ci = &get_instance();
        $list = array();
        $ci->db->select('tbl_models.*,tbl_models_country.lang_model_name');
        $ci->db->join('model_groups', 'model_groups.model_id=tbl_models.id', 'LEFT');
        $ci->db->where('model_groups.product_type_id', $product_type_id);

        if($categoryId != 'all') {
            $ci->db->where('model_groups.category_id', $categoryId);
        }
        $ci->db->where('model_groups.maker_id', $makerId);
        if($search != '') {
            $ci->db->like('tbl_models.model_name', $search , 'both'); 
           }
        $ci->db->where('model_groups.status', 1);
        $ci->db->where('tbl_models.status', 1);
        $ci->db->group_by('tbl_models.id');
        $ci->db->order_by('tbl_models.model_name', 'ASC');
        $ci->db->join('tbl_models_country', 'tbl_models.id = tbl_models_country.lang_id AND tbl_models_country.country_id =' . $lang_id, 'LEFT');
        $ci->db->from('tbl_models');
        $ci->db->limit($ci->config->item('pagination_limit'), $offset);
        $list = $ci->db->get()->result_array();
        return $list;
    }
}

if (!function_exists("getModelByProductType_count")) {
    function getModelByProductType_count($categoryId, $product_type_id, $makerId,$search)
    {
        $ci = &get_instance();
        $list = array();
        $ci->db->select('count(*) as total');
        $ci->db->join('model_groups', 'model_groups.model_id=tbl_models.id', 'LEFT');
        $ci->db->where('model_groups.product_type_id', $product_type_id);

        if($categoryId != 'all') {
            $ci->db->where('model_groups.category_id', $categoryId);
        }
        $ci->db->where('model_groups.maker_id', $makerId);
        if($search != '') {
            $ci->db->like('tbl_models.model_name', $search , 'both'); 
           }
        $ci->db->where('model_groups.status', 1);
        $ci->db->where('tbl_models.status', 1);
        $ci->db->group_by('tbl_models.id');
        $ci->db->from('tbl_models');
        $list = $ci->db->get()->row_array();
        return $list['total'];
    }
}


if (!function_exists("getMakerList")) {
    function getMakerList($lang_id,$categoryId,$search='',$offset)
    {
        $ci = &get_instance();
        $ci->db->select('tbl_makers.*, mc.lang_maker_name');
        $ci->db->join('tbl_makers', 'tbl_makers.id=tbl_models.maker_id', 'LEFT');
        $ci->db->join('tbl_makers_country as mc', 'tbl_makers.id = mc.lang_id AND mc.country_id =' . $lang_id, 'LEFT');


      
        if ($categoryId != 'all') {
            $ci->db->where('tbl_models.vehicle_category_id', $categoryId);

        }

        if($search != '') {
        $ci->db->like('tbl_makers.maker_name', $search , 'both'); 
        }

        $ci->db->where('tbl_makers.status', 1);
        $ci->db->where('tbl_models.status', 1);
        $ci->db->order_by('tbl_makers.maker_name', 'ASC');
        $ci->db->group_by('tbl_models.maker_id');
        $ci->db->from('tbl_models');
        $ci->db->limit($ci->config->item('pagination_limit'), $offset);
        $list = $ci->db->get()->result_array();
      //  echo $ci->db->last_query();
        return $list;
    }
}

if (!function_exists("getMakerList_count")) {
    function getMakerList_count($categoryId,$search='')
    {
        $ci = &get_instance();
        $ci->db->select('count(*) as total');
        $ci->db->join('tbl_makers', 'tbl_makers.id=tbl_models.maker_id', 'LEFT');
        $ci->db->where('tbl_makers.status', 1);
        if ($categoryId != 'all') {
            $ci->db->where('tbl_models.vehicle_category_id', $categoryId);

        }

        if($search != '') {
        $ci->db->like('tbl_makers.maker_name', $search , 'both'); 
        }

        $ci->db->where('tbl_makers.status', 1);
        $ci->db->where('tbl_models.status', 1);
        $ci->db->order_by('tbl_makers.maker_name', 'ASC');
        $ci->db->group_by('tbl_models.maker_id');
        $ci->db->from('tbl_models');
        $list = $ci->db->get()->row_array();

        return $list['total'];
    }
}

if (!function_exists("getProductListData")) {
    function getProductListData($lang_id,$search='',$offset,$product_type_id=array())
    {
        $ci = &get_instance();
        $ci->db->select('tbl_product_types.*, ptc.lang_product_type_name');
        $ci->db->where('tbl_product_types.status', 1);
        if($search != '') {
        $ci->db->like('tbl_product_types.product_type_name', $search , 'both'); 
        }

        if(!empty($product_type_id)) {
            $ci->db->where_in('tbl_product_types.id',$product_type_id);
        }
        $ci->db->order_by("length(tbl_product_types.Product_Type_Photo)", "DESC");
        $ci->db->from('tbl_product_types');
        $ci->db->join('tbl_product_types_country as ptc', 'tbl_product_types.id = ptc.lang_id AND ptc.country_id =' . $lang_id, 'LEFT');
        $ci->db->limit($ci->config->item('pagination_limit'), $offset);
        $list = $ci->db->get()->result_array();
        return $list;
    }
}

if (!function_exists("getProductListData_count")) {
    function getProductListData_count($search='',$product_type_id=array())
    {
        $ci = &get_instance();
        $ci->db->select('count(*) as total');
        $ci->db->where('tbl_product_types.status', 1);
        if(!empty($product_type_id)) {
            $ci->db->where_in('tbl_product_types.id',$product_type_id);
        }

        if($search != '') {
        $ci->db->like('tbl_product_types.product_type_name', $search , 'both'); 
        }
        $ci->db->from('tbl_product_types');
        $list = $ci->db->get()->row_array();
       // echo $ci->db->last_query();

        return $list['total'];
    }
}

if (!function_exists("getIndustryListData")) {
    function getIndustryListData($lang_id,$search='',$offset,$industry_type=array())
    {
        $ci = &get_instance();
        $ci->db->select('industries.*, ptc.lang_name');
        $ci->db->where('industries.status', 1);
        if($search != '') {
        $ci->db->like('industries.name', $search , 'both'); 
        }

        if(!empty($industry_type)) {
            $ci->db->where_in('industries.id', $industry_type);
            }
        $ci->db->order_by('industries.name', 'ASC');
        $ci->db->from('industries');
        $ci->db->join('industries_country as ptc', 'industries.id = ptc.lang_id AND ptc.country_id =' . $lang_id, 'LEFT');
        $ci->db->limit($ci->config->item('pagination_limit'), $offset);
        $list = $ci->db->get()->result_array();
        return $list;
    }
}

if (!function_exists("getIndustryListData_count")) {
    function getIndustryListData_count($search='',$industry_type=array())
    {
        $ci = &get_instance();
        $ci->db->select('count(*) as total');
        $ci->db->where('industries.status', 1);
       
        if(!empty($industry_type)) {
            $ci->db->where_in('industries.id', $industry_type);
            }
        if($search != '') {
        $ci->db->like('industries.name', $search , 'both'); 
        }
      
        $ci->db->from('industries');
        $list = $ci->db->get()->row_array();

        return $list['total'];
    }
}







// if (!function_exists("getMakerListByAttribute")) {
//     function getMakerListByAttribute($lang_id, $year)
//     {
//         $ci = &get_instance();
//         $ci->db->select('m.*, mc.lang_maker_name');
//         $ci->db->where('pird.value', $year);
//         $ci->db->where('pird.product_item_id', 1);
//         $ci->db->where('pir.product_maker_id >', 0);
//         $ci->db->where('P.product_type_id >', 0);
//         $ci->db->where('P.status', 1);
//         $ci->db->from('tbl_product_item_relation_dropdown as pird');
//         $ci->db->join('tbl_product_item_relation as pir', 'pir.id = pird.product_item_relation_id');
//         $ci->db->join('tbl_product_category_maker_model_relation as P', 'P.id = pird.product_id');
//         $ci->db->join('tbl_makers as m', 'm.id = pir.product_maker_id');
//         $ci->db->join('tbl_makers_country as mc', 'm.id = mc.lang_id AND mc.country_id =' . $lang_id, 'LEFT');
//         $ci->db->group_by('pir.product_maker_id');
//         $ci->db->order_by('m.maker_name', 'ASC');
//         return $ci->db->get()->result_array();
//     }
// }

if (!function_exists("getModelList")) {
    function getModelList($lang_id, $categoryId, $makerId,$search='',$offset)
    {
        $ci = &get_instance();
        $ci->db->select('tbl_models.*, mc.lang_model_name');
        if ($categoryId != 'all') {
           $ci->db->where('tbl_models.vehicle_category_id', $categoryId);
        }
        if($search != '') {
         $ci->db->like('tbl_models.model_name', $search , 'both'); 
        }
        $ci->db->where('tbl_models.status', 1);
        $ci->db->where('tbl_models.maker_id', $makerId);
        $ci->db->order_by('tbl_models.model_name', 'ASC');
        $ci->db->from('tbl_models');
        $ci->db->join('tbl_models_country as mc', 'tbl_models.id = mc.lang_id AND mc.country_id =' . $lang_id, 'LEFT');
        $ci->db->limit($ci->config->item('pagination_limit'), $offset);
        $list = $ci->db->get()->result_array();
        return $list;
    }
}

if (!function_exists("getModelList_count")) {
    function getModelList_count($categoryId, $makerId,$search='')
    {
        $ci = &get_instance();
        $ci->db->select('count(*) as total');
        if ($categoryId != 'all') {
           $ci->db->where('tbl_models.vehicle_category_id', $categoryId);
        }
        if($search != '') {
            $ci->db->like('tbl_models.model_name', $search , 'both'); 
        }
        $ci->db->where('tbl_models.status', 1);
        $ci->db->where('tbl_models.maker_id', $makerId);
        $ci->db->from('tbl_models');
        $list = $ci->db->get()->row_array();
        return $list['total'];
    }
}

if (!function_exists("getYearList")) {
    function getYearList($lang_id, $model_id,$search='',$offset)
    {
        $ci = &get_instance();
        $ci->db->select('model_engines.years');
        $ci->db->where('model_engines.model_id', $model_id);

        if($search != '') {
        $ci->db->like('model_engines.years', $search , 'both'); 
        }
        $ci->db->where('model_engines.status', 1);
        $ci->db->group_by('model_engines.years');
        $ci->db->from('model_engines');
        $ci->db->limit($ci->config->item('pagination_limit'), $offset);
        $list = $ci->db->get()->result_array();
        return $list;
    }
}

if (!function_exists("getYearList_count")) {
    function getYearList_count($model_id,$search='')
    {
        $ci = &get_instance();
        $ci->db->select('count(*) as total');
        $ci->db->where('model_engines.model_id', $model_id);
        if($search != '') {
        $ci->db->like('model_engines.years', $search , 'both'); 
        }
        $ci->db->where('model_engines.status', 1);
        $ci->db->group_by('model_engines.years');
        $ci->db->from('model_engines');
        $list = $ci->db->get()->row_array();
        return $list['total'];
    }
}

if (!function_exists("getEngineList")) {
    function getEngineList($lang_id,$year,$model_id,$search,$offset)
    {
        $ci = &get_instance();
        $ci->db->select('model_engines.engine_size');
        $ci->db->where('model_engines.model_id', $model_id);
        $ci->db->where('model_engines.years',$year);

        if($search != '') {
        $ci->db->like('model_engines.engine_size', $search , 'both'); 
        }
        $ci->db->where('model_engines.status', 1);
        $ci->db->group_by('model_engines.engine_size');
        $ci->db->from('model_engines');
        $ci->db->limit($ci->config->item('pagination_limit'), $offset);
        $list = $ci->db->get()->result_array();
        return $list;
    }
}


if (!function_exists("getProductList")) {
    function getProductList($lang_id, $categoryId = '', $makerId = '', $modelId = '',$search='',$offset)
    {
        $ci = &get_instance();
        $ci->db->select('tbl_product_types.*,tbl_product_types_country.lang_product_type_name');
        if ($modelId != '' && $categoryId != '' && $makerId != '') {
            if ($categoryId != 'all') {
            $ci->db->where('model_groups.category_id', $categoryId);
            }
            $ci->db->where('model_groups.maker_id', $makerId);
            $ci->db->where('model_groups.model_id', $modelId);

            if($search != '') {
            $ci->db->like('tbl_product_types.product_type_name', $search , 'both'); 
            }
            $ci->db->join('tbl_product_types', 'tbl_product_types.id = model_groups.product_type_id', 'LEFT');
            $ci->db->join('tbl_product_types_country', 'tbl_product_types.id = tbl_product_types_country.lang_id AND tbl_product_types_country.country_id =' . $lang_id, 'LEFT');
            $ci->db->where('model_groups.status', 1);
            $ci->db->where('tbl_product_types.status', 1);
            $ci->db->group_by('tbl_product_types.id');
            $ci->db->order_by('tbl_product_types.product_type_name', 'ASC');
            $ci->db->from('model_groups');
            $ci->db->limit($ci->config->item('pagination_limit'), $offset);
            $list = $ci->db->get()->result_array();
        } else {

        if($search != '') {
        $ci->db->like('tbl_product_types.product_type_name', $search , 'both'); 
        }
        $ci->db->join('tbl_product_types_country', 'tbl_product_types.id = tbl_product_types_country.lang_id AND tbl_product_types_country.country_id =' . $lang_id, 'LEFT');
        $ci->db->where('tbl_product_types.status', 1);
        $ci->db->order_by('tbl_product_types.product_type_name', 'ASC');
        $ci->db->from('tbl_product_types');
        $ci->db->limit($ci->config->item('pagination_limit'), $offset);
        $list = $ci->db->get()->result_array();

        }
        return $list;
    }
}

if (!function_exists("getProductList_count")) {
    function getProductList_count($categoryId = '', $makerId = '', $modelId = '',$search="")
    {
        $ci = &get_instance();
        if ($modelId != '' && $categoryId != '' && $makerId != '') {
            $ci->db->select('count(*) as total');
            if ($categoryId != 'all') {
                $ci->db->where('model_groups.category_id', $categoryId);
                }
            $ci->db->where('model_groups.maker_id', $makerId);
            $ci->db->where('model_groups.model_id', $modelId);
            if($search != '') {
                $ci->db->join('tbl_product_types', 'tbl_product_types.id = model_groups.product_type_id', 'LEFT');
                $ci->db->like('tbl_product_types.product_type_name', $search , 'both'); 
                    }
                $ci->db->where('model_groups.status', 1);
                // $ci->db->group_by('model_groups.product_type_id');
                $ci->db->from('model_groups');
                $list = $ci->db->get()->row_array();
        } else {
            $ci->db->select('count(*) as total');
            if($search != '') {
            $ci->db->like('tbl_product_types.product_type_name', $search , 'both'); 
            }
            $ci->db->where('tbl_product_types.status', 1);
            // $ci->db->group_by('model_groups.product_type_id');
            $ci->db->from('tbl_product_types');
            $list = $ci->db->get()->row_array();
        }

        return $list['total'];
    }
}





if (!function_exists("getProductTypeList")) {
    function getProductTypeList($lang_id,$modelId,$year,$engine_size,$search,$offset)
    {

    $engine_size = urldecode($engine_size);
    $ci = &get_instance();
    $ci->db->select('tbl_product_types.*,tbl_product_types_country.lang_product_type_name');
    $ci->db->where('model_engines_groups.model_id', $modelId);
    $ci->db->where('model_engines_groups.years',$year);
    $ci->db->where('model_engines_groups.engine_size',$engine_size);
    $ci->db->join('tbl_product_types', 'tbl_product_types.id = model_engines_groups.product_type_id', 'LEFT');
    $ci->db->join('tbl_product_types_country', 'tbl_product_types.id = tbl_product_types_country.lang_id AND tbl_product_types_country.country_id =' . $lang_id, 'LEFT');
    if($search != '') {
    $ci->db->like('tbl_product_types.product_type_name', $search , 'both'); 
    }
    $ci->db->where('tbl_product_types.status', 1);
    $ci->db->order_by('tbl_product_types.product_type_name', 'ASC');
    $ci->db->where('model_engines_groups.status', 1);
    $ci->db->group_by('tbl_product_types.id');
    $ci->db->from('model_engines_groups');
    //$ci->db->limit($ci->config->item('pagination_limit'), $offset);
    $list = $ci->db->get()->result_array();
   // echo $ci->db->last_query();
    return $list;

    }
}


if (!function_exists("getProductTypeList_count")) {
    function getProductTypeList_count($search)
    {

    $ci = &get_instance();
    $ci->db->select('count(*) as total');
    $ci->db->where('tbl_product_types.status', 1);
    if($search != '') {
    $ci->db->like('tbl_product_types.product_type_name', $search , 'both'); 
    }
    $ci->db->from('tbl_product_types');
    $list = $ci->db->get()->row_array();
    return $list['total'];

    }
}



if (!function_exists("addorupdatequotation")) {
    function addorupdatequotation($quotation_id_seesion, $quotation_data)
    {
        $ci = &get_instance();
        if ($quotation_id_seesion) {
            $where_param = array("id" => $quotation_id_seesion);
            $ci->db->where($where_param);
            $ci->db->update("quotations", $quotation_data);
            return $quotation_id_seesion;
        } else {
            $ci->db->insert("quotations", $quotation_data);
            return $ci->db->insert_id();
        }
    }
}



if (!function_exists("getProductList_drp")) {
    function getProductList_drp($search='',$offset)
    {
        $ci = &get_instance();
        $ci->db->select('products.kgt_ref_number,products.id,products.item_real_photo');
        if($search != '') {
        $ci->db->like('products.kgt_ref_number', $search , 'both'); 
        }
        $ci->db->where('products.status', 1);
        $ci->db->from('products');
       // $ci->db->order_by("length(products.item_real_photo)", "DESC");
        $ci->db->limit($ci->config->item('pagination_limit'), $offset);
        $list = $ci->db->get()->result_array();
        return $list;

    }
    
}

if (!function_exists("getProductList_drpcount")) {
    function getProductList_drpcount($search="")
    {
        $ci = &get_instance();
        $ci->db->select('count(*) as total');
        if($search != '') {
        $ci->db->like('products.kgt_ref_number', $search , 'both'); 
        }
        $ci->db->where('products.status', 1);
        //$ci->db->group_by('model_groups.product_type_id');
        $ci->db->from('products');
        $list = $ci->db->get()->row_array();
        return $list['total'];
    }
}

if (!function_exists("get_user_list_data")) {
    function get_user_list_data($search='',$offset)
    {
        $ci = &get_instance();
        $ci->db->select('users.customer_no,users.id');
        if($search != '') {
        $ci->db->like('users.customer_no', $search , 'both'); 
        }
        $ci->db->where('users.user_status', '1');
        $ci->db->from('users');
       // $ci->db->order_by("length(products.item_real_photo)", "DESC");
        $ci->db->limit($ci->config->item('pagination_limit'), $offset);
        $list = $ci->db->get()->result_array();
        return $list;

    }
    
}

if (!function_exists("get_user_list_data_count")) {
    function get_user_list_data_count($search="")
    {
        $ci = &get_instance();
        $ci->db->select('count(*) as total');
        if($search != '') {
        $ci->db->like('users.customer_no', $search , 'both'); 
        }
        $ci->db->where('users.user_status', '1');
        //$ci->db->group_by('model_groups.product_type_id');
        $ci->db->from('users');
        $list = $ci->db->get()->row_array();
        return $list['total'];
    }
}
if (!function_exists("refferal_users")) {
    function refferal_users($search='',$offset)
    {
        $ci = &get_instance();
        $ci->db->select('refferal_users.refferal_no,refferal_users.id');
        if($search != '') {
        $ci->db->like('refferal_users.refferal_no', $search , 'both'); 
        }
        $ci->db->where('refferal_users.status', '1');
        $ci->db->from('refferal_users');
       // $ci->db->order_by("length(products.item_real_photo)", "DESC");
        $ci->db->limit($ci->config->item('pagination_limit'), $offset);
        $list = $ci->db->get()->result_array();
        return $list;

    }
    
}

if (!function_exists("refferal_users_count")) {
    function refferal_users_count($search="")
    {
        $ci = &get_instance();
        $ci->db->select('count(*) as total');
        if($search != '') {
        $ci->db->like('refferal_users.refferal_no', $search , 'both'); 
        }
        $ci->db->where('refferal_users.status', '1');
        //$ci->db->group_by('model_groups.product_type_id');
        $ci->db->from('refferal_users');
        $list = $ci->db->get()->row_array();
        return $list['total'];
    }
}
if (!function_exists("getMakerByProductType_drp")) {
    function getMakerByProductType_drp($lang_id, $categoryId, $product_type_id,$search="")
    {
        $ci = &get_instance();
        $selected_maker_id = $ci->session->userdata('maker_id');

        $list = array();
        $ci->db->select('tbl_makers.*,tbl_makers_country.lang_maker_name');
        $ci->db->join('model_groups', 'model_groups.maker_id=tbl_makers.id', 'LEFT');
        if(!empty($product_type_id)) {

        $ci->db->where_in('model_groups.product_type_id', $product_type_id);
        }
        if($categoryId !="all") {
        $ci->db->where_in('model_groups.category_id', $categoryId);
        }
        if(!empty($selected_maker_id)) {
            $ci->db->where_in('tbl_makers.id', $selected_maker_id);
        }
        if($search != '') {
        $ci->db->like('tbl_makers.maker_name', $search , 'both'); 
        }
        $ci->db->join('tbl_makers_country', 'tbl_makers.id = tbl_makers_country.lang_id AND tbl_makers_country.country_id =' . $lang_id, 'LEFT');
        $ci->db->where('tbl_makers.status',1);

        $ci->db->group_by('tbl_makers.id');
        $ci->db->order_by('tbl_makers.maker_name', 'ASC');
        $ci->db->from('tbl_makers');
        $list = $ci->db->get()->result_array();

        // echo  $ci->db->last_query();
        // exit;
        return $list;
    }
}
if (!function_exists("getMakerByProductTypedrp_count")) {
    function getMakerByProductTypedrp_count($categoryId, $product_type_id)
    {
        $ci = &get_instance();
        $list = array();
        $ci->db->select('product_models.maker_id');
        $ci->db->join('model_groups', 'model_groups.model_id=products.id', 'LEFT');
        $ci->db->where('products.product_type_id', $product_type_id);
        if($categoryId !="all") {
        $ci->db->where('product_models.category_id', $categoryId);
        }
        $ci->db->where('products.status', 1);
        $ci->db->where('product_models.status', 1);
        $ci->db->group_by('product_models.maker_id');
        $ci->db->from('product_models');
        $list = $ci->db->get()->num_rows();
        return $list;
    }
}