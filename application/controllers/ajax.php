<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Ajax
 * 
 * This Class handle ajax requests for the all specified  methods in the class.
 * 
 */
class Ajax extends MY_Controller
{

    /**
     * __construct
     *
     * All helpers, models those we need to use in the controller are initialized in the constructor.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('comman_model', 'part_relation_model','product_model'));
        $this->load->helper(array('cart_helper', 'common_helper', 'assets_helper'));
    }

    /**
     * clear_cache
     *
     * @return void
     */
    function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

    /**
     * getKeywordSearchData k
     * This Function return results on the behalf of characters entered in search input.
     * @return void
     */
    function getKeywordSearchData()
    {
        $lang_id = $this->lang->default_lang_id;
        $cat_hide =  $this->session->userdata('hide_category');

        $this->db->select('pi.*, pic.lang_item_name');
        $this->db->where('pi.item_type', "product_model");
        $this->db->from('tbl_product_items as pi');
        $this->db->join('tbl_product_items_country as pic', 'pi.id = pic.lang_id AND pic.country_id = ' . $lang_id, 'LEFT');
        $types = $this->db->get()->result_array();
        $model_types = array();

        foreach ($types as $type) {
            if (isset($type['lang_item_name']) && $type['lang_item_name'] != '') {
                $model_types[$type['id']] = $type['lang_item_name'];
            } else {
                $model_types[$type['id']] = $type['item_name'];
            }
        }





        $keyword  = htmlspecialchars($this->input->post('keyword'));

        // This Function return the product section instruction labels and messages 
        $product_instruction = (object)get_user_lang_data(array('product_instruction'), $this->lang->default_lang_id)['product_instruction'];

        $general_instruction = (object)get_user_lang_data(array('general_instruction'), $this->lang->default_lang_id)['general_instruction'];


        if (!empty($keyword)) {
            // This function return list of items as per search keyword, which includes product ,category, maker , model and product type
            $searchList = $this->part_relation_model->getKeywordSearchData($lang_id, $keyword, $product_instruction, $model_types,$cat_hide);
            // print_r($searchList);die;
            if (!empty($searchList)) {
                //This Function sort search items
                $checkProductId = array();

                if(!empty($searchList['industry'])) {
                    echo '<li class="border-bottom1">'.$product_instruction->found_industry.':</li>';

                    foreach ($searchList['industry'] as $search) {
                    $display = $search['lang_name'] ? $search['lang_name'] : $search['display'];
                    echo '<a href="' . base_url() . $this->lang->default_lang . '/products/industry_type/' . $search['value'] . '"> ' . ucwords(strtolower($display)) . '</a>';

                    }
                }


                if(!empty($searchList['categorys'])) {
                    echo '<li class="border-bottom1">'.$product_instruction->found_category.':</li>';

                    foreach ($searchList['categorys'] as $search) {
                    $display = $search['lang_name'] ? $search['lang_name'] : $search['display'];
                    echo '<a href="' . base_url() . $this->lang->default_lang . '/products/vehicle_type/' . $search['value'] . '"> ' . ucwords(strtolower($display)) . '</a>';

                    }
                }

                if(!empty($searchList['makers'])) {
                    echo '<li class="border-bottom1">'.$product_instruction->found_makers.':</li>';

                    foreach ($searchList['makers'] as $search) {
                    $display = $search['lang_name'] ? $search['lang_name'] : $search['display'];
                    echo '<a href="' . base_url() . $this->lang->default_lang . '/products/product_maker/' . $search['value'] . '">' . ucwords(strtolower($display)) . '</a>';

                    }
                }

                if(!empty($searchList['models'])) {
                    echo '<li class="border-bottom1">'.$product_instruction->found_models.':</li>';

                    foreach ($searchList['models'] as $search) {
                    $display = $search['lang_name'] ? $search['lang_name'] : $search['display'];
                    echo '<a href="' . base_url() . $this->lang->default_lang . '/products/product_model/' . str_replace(",", "-", $search['categoryId']) . '/' . $search['makerId'] . '/' . $search['value'] . '">' . ucwords(strtolower($display)) . '</a>';

                    }
                }

                if(!empty($searchList['product_group'])) {
                    echo '<li class="border-bottom1">'.$product_instruction->found_product_group.':</li>';

                    foreach ($searchList['product_group'] as $search) {
                    $display = $search['lang_name'] ? $search['lang_name'] : $search['display'];
                    echo '<a href="' . base_url() . $this->lang->default_lang . '/products/product_group/' . $search['value'] . '">' . ucwords(strtolower($display)) . '</a>';

                    }
                }

                if(!empty($searchList['oem_number'])) {
                    echo '<li class="border-bottom1">'.$product_instruction->found_cross_reff.':</li>';

                    foreach ($searchList['oem_number'] as $search) {


                   $view = ' “Cross Refference : ' . $search['part_name'] . '”';

                    echo '<a href="javascript:void(0);" onClick="loadPartPage(this);" rel="' . htmlentities($search['value']) . '" ">“' . $keyword . '” ' . $general_instruction->isin_text . ' ' . $view . ' ' . $search['name']  . ' “' . ucwords(strtolower($search['display'])) . '”</a>';



                    }
                }

                if(!empty($searchList['products'])) {
                    echo '<li class="border-bottom1">'.$product_instruction->found_products.':</li>';
                    $search_sort= array();
                    foreach ($searchList['products'] as $search) {
                     if(!in_array($search['value'],$search_sort)) {
                    $view = ' “Part : ' . $search['part_name'] . '”';
                    $search_sort[] = $search['value'];
                    echo '<a href="javascript:void(0);" onClick="loadPartPage(this);" rel="' . htmlentities($search['value']) . '" ">“' . $keyword . '” ' . $general_instruction->isin_text . ' ' . $view . ' ' . $search['name']  . ' “' . ucwords(strtolower($search['display'])) . '”</a>';
                     }
                    }
                }

            } else {
                // This message  appears when there is not result in the searchlist variable.
                echo $product_instruction->part_number_is_not_recognized;
            }
        } else {
            // This message  appears when there is no keyword passed to the function.
            echo $product_instruction->part_number_is_not_recognized;
        }
    }

   

    /**
     * getCategoryList
     *
     * This Function  handle select dropdown of vehicle type on quick search.  
     * @param  mixed $product_type_id
     * @return void
     */
    function getCategoryList()
    {

        $product_type_id = $this->input->post('product_type_id');
        // This Function return list of all product categories according to parameter passed
        // $product_type_id = $this->input->get('product_type_id');
        $category_details = getVehicleCategoryList($this->lang->default_lang_id, $product_type_id);

        // get the previous selected category id
        $qCategoryId = !empty($this->session->userdata('qCategoryId')) ? array_slice($this->session->userdata('qCategoryId'), 0, 1) : array();

        // this code run category data in foreach loop and geneate html of each option
        $response = array();
        foreach ($category_details as $key => $category) {
            // This Function return list of all categories  according to parameter passed
            if (isset($category['VehicleType_Photo']) && $category['VehicleType_Photo'] != '' && file_exists("assets/uploads/vehicle_categories/" . $category['VehicleType_Photo'])) {
                $img = asset_url('assets/uploads/vehicle_categories/' . $category['VehicleType_Photo']);
            } else {
                $img = getNoImage('coming-soon');
            }

            $selected = '';
            // if (in_array($category['id'], $qCategoryId)) {
            //     $selected = ' selected';
            // }
            // condition to display category name as per default language
            $category_name = $category['lang_category_name'] ? $category['lang_category_name'] : $category['category_name'];

            // Assign the response key & value to return json
            $response[$key]['name']     = $category_name;
            $response[$key]['id']       = $category['id'];
            $response[$key]['img']      = $img;
            $response[$key]['isActive'] = $selected;
        }

        // retutn the json response
        echo json_encode($response);
    }

    /**
     * getMakerList
     *
     * This Function  handle select dropdown of models on quick search.
     * @param  mixed $categoryId
     * @return void
     */
    function getMakerList()
    {
        $categoryId = $this->input->post('vehicle_category_id');
        $product_type_id = $this->input->post('product_type_id');
        $search = $this->input->post('search');
        $offset = $this->input->post('page') ?  $this->input->post('page') * $this->config->item('pagination_limit') : 0;

        if ($product_type_id != '') {
            $makers_details = getMakerByProductType($this->lang->default_lang_id, $categoryId, $product_type_id,$search,$offset);
            $makers_details_count = getMakerByProductType_count($this->lang->default_lang_id, $categoryId, $product_type_id,$search);
            $makers_count = $makers_details_count;
        } else {
            $makers_details = getMakerList($this->lang->default_lang_id, $categoryId,$search,$offset);
            $makers_count = getMakerList_count($categoryId,$search);

        }


        // echo "<pre>";
        // print_r($makers_details);
        // exit;
        // get the previous selected maker id
        $qMakerId = !empty($this->session->userdata('qMakerId')) ? array_slice($this->session->userdata('qMakerId'), 0, 1) : array();

        // this code run makers data in foreach loop and geneate html of each option of dropdown
        $response = array();
        foreach ($makers_details as $key => $maker) {
            // if image is exist than set image else coming soon image will be set
            if (isset($maker['maker_logo']) && $maker['maker_logo'] != '' && file_exists("assets/uploads/product_maker/" . $maker['maker_logo'])) {
                $img = asset_url('assets/uploads/product_maker/' . $maker['maker_logo']);
            } else {
                $img = getNoImage('coming-soon');
            }

           
              // condition to display maker name as per default language
            $maker_name = $maker['lang_maker_name'] ? $maker['lang_maker_name'] : $maker['maker_name'];

            $single_item = array("id"=>$maker['id'],"text"=> ucwords($maker_name),"img"=>$img);

            if (in_array($maker['id'], $qMakerId)) {
            $single_item['selected'] = true;
            }

            $items[] = $single_item;





          

            // Assign the response key & value to return json
            $response[$key]['name']     = $maker_name;
            $response[$key]['id']       = $maker['id'];
            $response[$key]['img']      = $img;
            $response[$key]['isActive'] = $selected;
        }
        // retutn the json response
        $data = array();
        $data['items'] = $items;
        $data['total_count']  = $makers_count;
        // retutn the json response
        echo json_encode($data);
    }


    /**
     * getMakerList
     *
     * This Function  handle select dropdown of models on quick search.
     * @param  mixed $categoryId
     * @return void
     */
    function getMakerList_home()
    {
        $categoryId = "all";
        $search = $this->input->post('search');
        $offset = $this->input->post('page') ?  $this->input->post('page') * $this->config->item('pagination_limit') : 0;

       
        $makers_details = getMakerList($this->lang->default_lang_id, $categoryId,$search,$offset);
        $makers_count = getMakerList_count($categoryId,$search);

        


        // echo "<pre>";
        // print_r($makers_details);
        // exit;
        // get the previous selected maker id
        $qMakerId = !empty($this->session->userdata('qMakerId')) ? array_slice($this->session->userdata('qMakerId'), 0, 1) : array();

        // this code run makers data in foreach loop and geneate html of each option of dropdown
        $response = array();
        foreach ($makers_details as $key => $maker) {
            // if image is exist than set image else coming soon image will be set
            if (isset($maker['maker_logo']) && $maker['maker_logo'] != '' && file_exists("assets/uploads/product_maker/" . $maker['maker_logo'])) {
                $img = asset_url('assets/uploads/product_maker/' . $maker['maker_logo']);
            } else {
                $img = getNoImage('coming-soon');
            }

           
              // condition to display maker name as per default language
            $maker_name = $maker['lang_maker_name'] ? $maker['lang_maker_name'] : $maker['maker_name'];

            $single_item = array("id"=>$maker['id']."#".$categoryId,"text"=> ucwords($maker_name),"img"=>$img);

            if (in_array($maker['id'], $qMakerId)) {
            $single_item['selected'] = true;
            }

            $items[] = $single_item;





          

            // Assign the response key & value to return json
            $response[$key]['name']     = $maker_name;
            $response[$key]['id']       = $maker['id'];
            $response[$key]['img']      = $img;
            $response[$key]['isActive'] = $selected;
        }
        // retutn the json response
        $data = array();
        $data['items'] = $items;
        $data['total_count']  = $makers_count;
        // retutn the json response
        echo json_encode($data);
    }


    // code by Abdul


    /**
     * getMakerList
     *
     * This Function  handle select dropdown of models on quick search.
     * @param  mixed $categoryId
     * @return void
     */
    function getModelListData()
    {
        $vehicle_category_id_data = $this->input->post('vehicle_category_id');
        $modelIdsRelationVal = array();
        
        $product_type_id = $this->input->post('product_type_id');
        $makerId = $this->input->post('maker_ids');
        $search = $this->input->post('search');
    
        $offset = $this->input->post('page') ?  $this->input->post('page') * $this->config->item('pagination_limit') : 0;
        $modelLists = updateLanguageParameters($this->product_model->get_model_by_makers_details_new($modelIdsRelationVal, 0, $this->lang->default_lang_id,$makerId,$search,$vehicle_category_id_data));
        $makers_count = count($modelLists[0]);
        // get the previous selected maker id
        $qModelId = !empty($this->session->userdata('qModelId')) ? array_slice($this->session->userdata('qModelId'), 0, 1) : array();


     
        // this code run makers data in foreach loop and geneate html of each option of dropdown
        $response = array();
        foreach ($modelLists[0] as $key => $model) {
            // if image is exist than set image else coming soon image will be set
            if (isset($model['model_photo']) && $model['model_photo'] != '' && file_exists("assets/uploads/product_model/".$model['model_photo'])) {
                $img = asset_url('assets/uploads/product_model/'.$model['model_photo']);
            } else {
                $img = getNoImage('coming-soon');
            }

              // condition to display maker name as per default language
            $model_name = $model['lang_model_name'] ? $model['lang_model_name'] : $model['model_name'];

            $single_item = array("id"=>$makerId.'#'.$model['id'],"text"=> ucwords($model_name),"img"=>$img);

            if (in_array($model['id'], $qModelId)) {
            $single_item['selected'] = true;
            }

            $items[] = $single_item;

        }
        // retutn the json response
        $data = array();
        $data['items'] = $items;
        $data['total_count']  = $makers_count;
        // retutn the json response
        echo json_encode($data);
    }
    function getProductListData()
    {
        $product_type_id =  $this->session->userdata('product_type');

        $search = $this->input->post('search');
        $offset = $this->input->post('page') ?  $this->input->post('page') * $this->config->item('pagination_limit') : 0;

        
            $product_type_list = getProductListData($this->lang->default_lang_id, $search,$offset,$product_type_id);
            $product_count = getProductListData_count($search,$product_type_id);

      
        // get the previous selected maker id
        $qProductTypeId = !empty($this->session->userdata('qProductTypeId')) ? array_slice($this->session->userdata('qProductTypeId'), 0, 1) : array();

        // this code run makers data in foreach loop and geneate html of each option of dropdown
        $response = array();
        foreach ($product_type_list as $key => $ptc) {
            // if image is exist than set image else coming soon image will be set
            if (isset($ptc['Product_Type_Photo']) && $ptc['Product_Type_Photo'] != '' && file_exists("assets/uploads/product_type_images/" . $ptc['Product_Type_Photo'])) {
                $img = asset_url('assets/uploads/product_type_images/' . $ptc['Product_Type_Photo']);
            } else {
                $img = getNoImage('coming-soon');
            }

           
              // condition to display ptc name as per default language
            $product_name = $ptc['lang_product_type_name'] ? $ptc['lang_product_type_name'] : $ptc['product_type_name'];

            $single_item = array("id"=>$ptc['id'],"text"=> ucwords($product_name),"img"=>$img);

            if (in_array($ptc['id'], $qProductTypeId)) {
            $single_item['selected'] = true;
            }

            $items[] = $single_item;





          

            // Assign the response key & value to return json
            $response[$key]['name']     = $product_name;
            $response[$key]['id']       = $ptc['id'];
            $response[$key]['img']      = $img;
            $response[$key]['isActive'] = $selected;
        }
        // retutn the json response
        $data = array();
        $data['items'] = $items;
        $data['total_count']  = $product_count;
        // retutn the json response
        echo json_encode($data);
    }
    function get_mac_cat_data()
    {
        // $categoryId = $this->input->post('vehicle_category_id');
        // $product_type_id = $this->input->post('product_type_id');
        
        $vehicle_category_ids = $this->session->userdata('product_type') ? $this->session->userdata('product_type') : array();
        $search = $this->input->post('search');
        $offset = $this->input->post('page') ?  $this->input->post('page') * $this->config->item('pagination_limit') : 0;
        
        // if ($product_type_id != '') {
        //     $product_type_list = getMakerListByCategoryId($this->lang->default_lang_id, $categoryId, $product_type_id);
        //     getMakerListByCategoryId
        //     $product_count = count($makers_details);
        // } else {
        //     $product_type_list = getProductListData($this->lang->default_lang_id, $search,$offset);
        //     $product_count = getProductListData_count($search);

        // }
        $total_selected_vehicle_categories = $this->product_model->getMakerListByCategoryCount($vehicle_category_ids,$search);    
        $selected_vehicle_categories = $this->product_model->getMakerListByCategoryId($offset,$vehicle_category_ids,$search);


        // get the previous selected maker id
        $qProductTypeId = !empty($this->session->userdata('qProductTypeId')) ? array_slice($this->session->userdata('qProductTypeId'), 0, 1) : array();

        // this code run makers data in foreach loop and geneate html of each option of dropdown
        $response = array();
        foreach ($total_selected_vehicle_categories as $key => $ptc) {
            // if image is exist than set image else coming soon image will be set
            if (isset($ptc['Product_Type_Photo']) && $ptc['Product_Type_Photo'] != '' && file_exists("assets/uploads/product_type_images/" . $ptc['Product_Type_Photo'])) {
                $img = asset_url('assets/uploads/product_type_images/' . $ptc['Product_Type_Photo']);
            } else {
                $img = getNoImage('coming-soon');
            }

           
              // condition to display ptc name as per default language
            $product_name = $ptc['lang_product_type_name'] ? $ptc['lang_product_type_name'] : $ptc['product_type_name'];

            $single_item = array("id"=>$ptc['id'],"text"=> ucwords($product_name),"img"=>$img);

            if (in_array($ptc['id'], $qProductTypeId)) {
            $single_item['selected'] = true;
            }

            $items[] = $single_item;





          

            // Assign the response key & value to return json
            $response[$key]['name']     = $product_name;
            $response[$key]['id']       = $ptc['id'];
            $response[$key]['img']      = $img;
            $response[$key]['isActive'] = $selected;
        }
        // retutn the json response
        $data = array();
        $data['items'] = $items;
        $data['total_count']  = $product_count;
        // retutn the json response
        echo json_encode($data);
    }

    function getProductgroup_data()
    {

        $search = $this->input->post('search');
        $category_id = $this->input->post('category_id');

        $offset = $this->input->post('page') ?  $this->input->post('page') * $this->config->item('pagination_limit') : 0;

        $product_type_list = $this->product_model->product_types_drop_modal($offset,$this->lang->default_lang_id, $search,$category_id);
        $product_count = $this->product_model->product_types_drop_modal_count($search,$category_id);

        // this code run makers data in foreach loop and geneate html of each option of dropdown
        $response = array();
        foreach ($product_type_list as $ptc) {
            // if image is exist than set image else coming soon image will be set
            if (isset($ptc['Product_Type_Photo']) && $ptc['Product_Type_Photo'] != '' && file_exists("assets/uploads/product_type_images/" . $ptc['Product_Type_Photo'])) {
                $img = asset_url('assets/uploads/product_type_images/' . $ptc['Product_Type_Photo']);
            } else {
                $img = getNoImage('coming-soon');
            }

           
              // condition to display ptc name as per default language
            $product_name = $ptc['lang_product_type_name'] ? $ptc['lang_product_type_name'] : $ptc['product_type_name'];

            $single_item = array("id"=>$ptc['id'],"text"=> ucwords($product_name),"img"=>$img);

            if (in_array($ptc['id'], $qProductTypeId)) {
            $single_item['selected'] = true;
            }

            $items[] = $single_item;
        }
        // retutn the json response
        $data = array();
        $data['items'] = $items;
        $data['total_count']  = $product_count;
        // retutn the json response
        echo json_encode($data);
    }
     function getIndustryListData()
    {
        $industry_type = $this->session->userdata('industry_type');

        $search = $this->input->post('search');
        $offset = $this->input->post('page') ?  $this->input->post('page') * $this->config->item('pagination_limit') : 0;

       
            $product_type_list = getIndustryListData($this->lang->default_lang_id, $search,$offset,$industry_type);
            $product_count = getIndustryListData_count($search,$industry_type);


       

        // this code run makers data in foreach loop and geneate html of each option of dropdown
        $response = array();
        foreach ($product_type_list as $key => $ptc) {
            // if image is exist than set image else coming soon image will be set
            if (isset($ptc['icon']) && $ptc['icon'] != '' && file_exists("assets/uploads/industries/" . $ptc['icon'])) {
                $img = asset_url('assets/uploads/industries/' . $ptc['icon']);
            } else {
                $img = getNoImage('coming-soon');
            }

           
              // condition to display ptc name as per default language
            $product_name = $ptc['lang_name'] ? $ptc['lang_name'] : $ptc['name'];

            $single_item = array("id"=>$ptc['id'],"text"=> ucwords($product_name),"img"=>$img);

            if (in_array($ptc['id'], $qProductTypeId)) {
            $single_item['selected'] = true;
            }

            $items[] = $single_item;


        }
        // retutn the json response
        $data = array();
        $data['items'] = $items;
        $data['total_count']  = $product_count;
        // retutn the json response
        echo json_encode($data);
    }
    
    /**
     * getModelList
     *
     * This Function  handle select dropdown of models on quick search.
     * @param  mixed $categoryId
     * @param  mixed $makerId
     * @return void
     */
    function getModelList()
    {

        $categoryId = $this->input->post('vehicle_category_id');
        $product_type_id = $this->input->post('product_type_id');
        $makerId = $this->input->post('maker_id');
        $search = $this->input->post('search');
        $offset = $this->input->post('page') ?  $this->input->post('page') * $this->config->item('pagination_limit') : 0;



        if ($product_type_id != '') {
            $model_details = getModelByProductType($this->lang->default_lang_id, $categoryId, $product_type_id, $makerId,$search,$offset);

            $models_count = getModelByProductType_count($categoryId, $product_type_id, $makerId,$search);
        } else {
            $model_details = getModelList($this->lang->default_lang_id, $categoryId, $makerId,$search,$offset);

            $models_count = getModelList_count($categoryId,$makerId,$search);
        }
        // get the previous selected model id
        $qModelId = !empty($this->session->userdata('qModelId')) ? array_slice($this->session->userdata('qModelId'), 0, 1) : array();

        // this code run model data in foreach loop and geneate html of each option of dropdown
        $response = array();
        $response['product_type_id'] = $product_type_id;
        foreach ($model_details as $key => $model) {
            // if image is exist than set image else coming soon image will be set
            if (isset($model['model_photo']) && $model['model_photo'] != '' && file_exists("assets/uploads/product_model/" . $model['model_photo'])) {
                $img = asset_url('assets/uploads/product_model/' . $model['model_photo']);
            } else {
                $img = getNoImage('coming-soon');
            }

            // condition to display model name as per default language
            $model_name = $model['lang_model_name'] ? $model['lang_model_name'] : $model['model_name'];
            $single_item = array("id"=>$model['id'],"text"=> ucwords($model_name),"img"=>$img);

            $selected = '';
            // if (in_array($model['id'], $qModelId)) {
            // $single_item['selected'] = true;
            // }
           
            $items[] = $single_item;

            // Assign the response key & value to return json
            $response['model'][$key]['name']     = $model_name;
            $response['model'][$key]['id']       = $model['id'];
            $response['model'][$key]['img']      = $img;
            $response['model'][$key]['isActive'] = $selected;
        }

        $data = array();
        $data['items'] = $items;
        $data['total_count']  = $models_count;
        // retutn the json response
        echo json_encode($data);
    }


    function getProductList()
    {

        $categoryId = $this->input->post('vehicle_category_id');
        $makerId = $this->input->post('maker_id');
        $modelId = $this->input->post('model_id');
        $search = $this->input->post('search');
        $offset = $this->input->post('page') ?  $this->input->post('page') * $this->config->item('pagination_limit') : 0;
        //echo $offset;
        // This Function return list of all product types according to parameter passed
        $type_details =  getProductList($this->lang->default_lang_id, $categoryId, $makerId, $modelId,$search,$offset);
        $total_count = getProductList_count($categoryId, $makerId, $modelId,$search);
        $response = array();
        if ($categoryId && $makerId && $modelId) {
            $response['product_type_id'] = $categoryId;
        } else {
            $response['product_type_id'] = '';
        }
        // get the previous selected product type id
        $qProductTypeId = !empty($this->session->userdata('qProductTypeId')) ? array_slice($this->session->userdata('qProductTypeId'), 0, 1) : array();

        // this code run product type data in foreach loop and geneate html of each option


        foreach ($type_details as $key => $type) {

            // if image is exist than set image else coming soon image will be set
            if (isset($type['Product_Type_Photo']) && $type['Product_Type_Photo'] != '' && file_exists("assets/uploads/product_type_images/" . $type['Product_Type_Photo'])) {
                $img = asset_url('assets/uploads/product_type_images/' . $type['Product_Type_Photo']);
            } else {
                $img = getNoImage('coming-soon');
            }

            $selected = '';
            
            // condition to display product type name as per default language
            $product_type_name = $type['lang_product_type_name'] ? $type['lang_product_type_name'] : $type['product_type_name'];

            $single_item = array("id"=> $type['id'],"text"=> ucwords($product_type_name),"img"=>$img);

            if(in_array($type['id'], $qProductTypeId)) {
                $single_item['selected'] = true;
            }

            $items[] = $single_item;
            // Assign the response key & value to return json
            $response['type'][$key]['name']     = ucwords($product_type_name);
            $response['type'][$key]['id']       = $type['id'];
            $response['type'][$key]['img']      = $img;
            $response['type'][$key]['isActive'] = $selected;
            $i++;
        }

        $data['items'] = $items;
        $data['total_count']  = $total_count;
        // $data = $items;
        // return the json response
        echo json_encode($data);
        exit;
    }


    function getYearList()
    {
        // get the previous selected model id
        $qModelId = !empty($this->session->userdata('qModelId')) ? array_slice($this->session->userdata('qModelId'), 0, 1) : array();

        $modelId = $this->input->post('model_id');
        $search = $this->input->post('search');
        $offset = $this->input->post('page') ?  $this->input->post('page') * $this->config->item('pagination_limit') : 0;
        //echo $offset;
        // This Function return list of all product types according to parameter passed
        $year_details = getYearList($this->lang->default_lang_id,$modelId,$product_type_id,$search,$offset);
        $total_count = getYearList_count($modelId,$product_type_id,$search);
        // this code run model data in foreach loop and geneate html of each option of dropdown
        $response = array();
        foreach ($year_details as $key => $year) {
            $selected = '';
          
            $single_item = array("id"=> $year['years'],"text"=> ucwords($year['years']));
            $items[] = $single_item;

        }

        $data['items'] = $items;
        $data['total_count']  = $total_count;
        // $data = $items;
        // return the json response
        echo json_encode($data);
        exit;
    }

    /**
     * getEngineSizeList
     *
     * This Function  handle select dropdown of models on quick search.
     * @param  mixed $modelId
     * @return void
     */
    function getEngineSizeList()
    {

        $modelId = $this->input->post('model_id');
        $product_type_id = $this->input->post('product_type_id');

        $year = $this->input->post('year');
        $search = $this->input->post('search');
        $offset =  0;

        // This Function return list of all models  according to parameter passed
        $details = getEngineList($this->lang->default_lang_id,$year,$modelId, $product_type_id,$search,$offset);

      

        // get the previous selected model id
        $qEngineSize = !empty($this->session->userdata('qEngineSize')) ? array_slice($this->session->userdata('qEngineSize'), 0, 1) : array();

        // this code run model data in foreach loop and geneate html of each option of dropdown
        $response = array();
        $names = array();

        foreach ($details as $key => $detail) {

             

                $engine_size_label =  '';

                // if ($this->lang->default_lang_id !== 13 && isset($detail['lang_engine_size']) && !empty($detail['lang_engine_size'])) {
                //     $engine_size_label = $detail['lang_engine_size'];
                // } elseif (isset($detail['engine_size']) && !empty($detail['engine_size'])) {
                //     $engine_size_label = $detail['engine_size'];
                // }
                $engine_size_label = $detail['engine_size'];
                $engine_size_name = $detail['engine_size'] ? $detail['engine_size'] : '';

                    if(in_array($engine_size_name,$names)) {


                    } else {

                        $names[] =$engine_size_name;
                        // Assign the response key & value to return json

                        $single_item = array("id"=> urldecode($engine_size_name),"text"=> ucwords($engine_size_name));
                        $items[] = $single_item;

                }

               
               
            }        

        // retutn the json response
        $data['items'] = $items;
        $data['total_count']  = count($items);
        // $data = $items;
        // return the json response
        echo json_encode($data);
        exit;
    }

    /**
     * getProductTypeList
     *
     * This Function  handle select dropdown of product type on quick search.  
     * @param  mixed $categoryId
     * @param  mixed $makerId
     * @param  mixed $modelId
     * @return void
     */
    function getProductTypeList()
    {

        $modelId = $this->input->post('model_id');
        $year = $this->input->post('year');
        $engine =  urlencode($this->input->post('engine'));
        $search = $this->input->post('search');
        $offset = $this->input->post('page') ?  $this->input->post('page') * $this->config->item('pagination_limit') : 0;
        // This Function return list of all product types according to parameter passed
        $type_details = getProductTypeList($this->lang->default_lang_id,$modelId,$year,$engine,$search,$offset);
       // $type_count = getProductTypeList_count($search);
        $response = array();
        // get the previous selected product type id
        $qProductTypeId = !empty($this->session->userdata('qProductTypeId')) ? array_slice($this->session->userdata('qProductTypeId'), 0, 1) : array();


        // echo "<pre>";
        // print_r($type_details);

        // this code run product type data in foreach loop and geneate html of each option
        foreach ($type_details as $key => $type) {
            // if image is exist than set image else coming soon image will be set
            if (isset($type['Product_Type_Photo']) && $type['Product_Type_Photo'] != '' && file_exists("assets/uploads/product_type_images/" . $type['Product_Type_Photo'])) {
                $img = asset_url('assets/uploads/product_type_images/' . $type['Product_Type_Photo']);
            } else {
                $img = getNoImage('coming-soon');
            }

          
            // condition to display product type name as per default language
            $product_type_name = $type['lang_product_type_name'] ? $type['lang_product_type_name'] : $type['product_type_name'];

            // Assign the response key & value to return json
            $single_item = array("id"=> $type['id'],"text"=> ucwords($product_type_name),"img"=>$img);

            if(in_array($type['id'], $qProductTypeId)) {
                $single_item['selected'] = true;
            }

            $items[] = $single_item;
        }

        // return the json response
          // retutn the json response
          $data['items'] = $items;
          $data['total_count']  = count($items);
          // $data = $items;
          // return the json response
          echo json_encode($data);
          exit;
    }


    /**
     * getEngineSizes
     *
     * This Function  handle select dropdown of models on quick search.
     * @param  mixed $categoryId
     * @return void
     */
    function getEngineSizes($year = '', $product_id = '', $product_model_id = '', $product_item_id = '')
    {
        // This Function return list of all engine sizes corresponding to product_id / product_model_id / product_item_id
        $response = array();
        $result = array();
        if ($year) {

            $whereArr = array('product_id' => $product_id, 'model_id' => $product_model_id, 'item_id' => $product_item_id, 'value' => $year);

            // $whereArr = array('product_id' => 28157, 'model_id' => 3520, 'item_id' => 1, 'value' => 1950);

            // echo "<pre>";
            //     print_r($whereArr);
            // exit;

            $lang_id = $this->lang->default_lang_id;

            $this->db->select('pi.*, pic.*');
            $this->db->where($whereArr);
            $this->db->from('product_items as pi');
            $this->db->join('product_items_country as pic', 'pi.id = pic.lang_id AND pic.country_id = ' . $lang_id, 'LEFT');
            $result = $this->db->get()->result();
        }

        $response = updateLanguageParameters($result);
        // retutn the json response
        echo json_encode($response);
    }

 




    /**
     * getEngineSizes
     *
     * This Function  handle select dropdown of models on quick search.
     * @param  mixed $categoryId
     * @return void
     */
    function update_search_type($val)
    {
        // This Function return list of all engine sizes corresponding to product_id / product_model_id / product_item_id
        $response = array();
        $data =  $this->comman_model->update_column("home_page", array("id" => 1), array("quick_search_hide_category" => $val));
        $response  = array("status" => 1);
        if ($val == "1") {
            $this->session->unset_userdata('qSearchType');
            $this->session->set_userdata('filter_option', "brand");
        } else {
            $this->session->unset_userdata('qSearchType');

            $this->session->set_userdata('filter_option', "category");
        }
        // retutn the json response
        echo json_encode($response);
    }



    /**
     * getEngineSizes
     *
     * This Function  handle select dropdown of models on quick search.
     * @param  mixed $categoryId
     * @return void
     */
    function update_coookie_data()
    {
        // This Function return list of all engine sizes corresponding to product_id / product_model_id / product_item_id
        // $response = array();
        // $data =  $this->comman_model->update_column("home_page", array("id" => 1), array("quick_search_hide_category" => $val));

        $selected_val =  $this->input->post('selected_val');
        $EUhandshakechkIsF =  $this->input->post('EUhandshakechkIsF');
        $EUhandshakechkIsA =  $this->input->post('EUhandshakechkIsA');
        $EUhandshakechkIsM =  $this->input->post('EUhandshakechkIsM');

        $values = array("EUhandshakechkIsF" => $EUhandshakechkIsF, "EUhandshakechkIsA" => $EUhandshakechkIsA, "EUhandshakechkIsM" => $EUhandshakechkIsM);
        $response  = array("status" => 1);
        if ($selected_val == "1") {
            $this->session->set_userdata('gdpr_decision', "1");
            $this->session->set_userdata('gdpr_options', $values);
        } else {
            $this->session->set_userdata('gdpr_decision', "0");
        }
        // retutn the json response
        echo json_encode($response);
    }

    function getCategory_drop()
    {

        $product_type_id = $this->input->post('product_type_id');
        // This Function return list of all product categories according to parameter passed
        // $product_type_id = $this->input->get('product_type_id');
        $category_details = getVehicleCategoryList($this->lang->default_lang_id, $product_type_id);

        // get the previous selected category id
        $qCategoryId = !empty($this->session->userdata('qCategoryId')) ? array_slice($this->session->userdata('qCategoryId'), 0, 1) : array();

        // this code run category data in foreach loop and geneate html of each option
        $response = array();
        foreach ($category_details as $key => $category) {
            // This Function return list of all categories  according to parameter passed
            if (isset($category['VehicleType_Photo']) && $category['VehicleType_Photo'] != '' && file_exists("assets/uploads/vehicle_categories/" . $category['VehicleType_Photo'])) {
                $img = asset_url('assets/uploads/vehicle_categories/' . $category['VehicleType_Photo']);
            } else {
                $img = getNoImage('coming-soon');
            }

            $selected = '';
            // if (in_array($category['id'], $qCategoryId)) {
            //     $selected = ' selected';
            // }
            // condition to display category name as per default language
            $category_name = $category['lang_category_name'] ? $category['lang_category_name'] : $category['category_name'];


               // condition to display maker name as per default language
               $category_name = $category_name;

               $single_item = array("id"=>$category['id'],"text"=> ucwords($category_name),"img"=>$img);
   
               if (in_array($category['id'], $qCategoryId)) {
               $single_item['selected'] = true;
               }
   
               $items[] = $single_item;

               
            // Assign the response key & value to return json
            $response[$key]['name']     = $category_name;
            $response[$key]['id']       = $category['id'];
            $response[$key]['img']      = $img;
            $response[$key]['isActive'] = $selected;
        }

        // retutn the json response
        $data = array();
        $data['items'] = $items;
        $data['total_count']  = $items;
        // retutn the json response
        echo json_encode($data);
    }

   


    function getProductList_drop()
    {


        $search = $this->input->post('search');
        $offset = $this->input->post('page') ?  $this->input->post('page') * $this->config->item('pagination_limit') : 0;
        // This Function return list of all product types according to parameter passed
        $type_details =  getProductList_drp($search,$offset);
        $total_count = getProductList_drpcount($search);
        $response = array();

                    if (!empty($this->session->userdata('cart'))) {
                    $cart = $this->session->userdata('cart');
                    } else {
                    $cart = [];
                    }
    
        // this code run product type data in foreach loop and geneate html of each option
        foreach ($type_details as $key => $type) {

            // if image is exist than set image else coming soon image will be set
            $pro_real_images = explode(",", $type['item_real_photo']);

            
            if (isset($pro_real_images[0]) && $pro_real_images[0] != '' && file_exists("assets/uploads/product_images/" .$pro_real_images[0])) { 

                $img = asset_url('assets/uploads/product_images/'.$pro_real_images[0]);
            } else {
                $img = getNoImage('coming-soon');
            }

            $selected = '';
            
            // condition to display product type name as per default language
            $product_type_name = $type['kgt_ref_number'];

            

            $single_item = array("id"=> $type['id'],"text"=> ucwords($type['kgt_ref_number']),"img"=>$img);

            if (array_key_exists($type['id'],$cart)) {
                    $single_item['selected'] = true;
            }

            $items[] = $single_item;
            // Assign the response key & value to return json
          
           
        }
        $data['items'] = $items;
        $data['total_count']  = $total_count;
        // $data = $items;
        // return the json response
        echo json_encode($data);
        exit;
    }

     /*******Vehcile type dropddown */
     function getvehicletype_list()
     {
 
 
         $search = $this->input->post('search');
         $offset = $this->input->post('page') ?  $this->input->post('page') * $this->config->item('pagination_limit') : 0;
 
         $vehicle_category_ids = $this->session->userdata('vehicle_category_id') ? $this->session->userdata('vehicle_category_id') : array();
         $product_type_id      = $this->session->userdata('product_type');
         // This Function return list of all product types according to parameter passed
 
         $type_details =  $this->comman_model->get_vehicle_type_for_menu($offset, $vehicle_category_ids, $product_type_id,$search);
         $total_count = $this->comman_model->num_vehicle_type_for_menu($vehicle_category_ids, $product_type_id,$search);
         $response = array();
     
         // this code run product type data in foreach loop and geneate html of each option
         foreach ($type_details as $key => $category) {
 
             // if image is exist than set image else coming soon image will be set
            
             if (isset($category['VehicleType_Photo']) && $category['VehicleType_Photo'] != '' && file_exists("assets/uploads/vehicle_categories/" . $category['VehicleType_Photo'])) {
                 $img = asset_url('assets/uploads/vehicle_categories/' . $category['VehicleType_Photo']);
             } else {
                 $img = getNoImage('coming-soon');
             }
 
                 
            
 
             $selected = '';
             
             // condition to display product type name as per default language
             $category_name = $category['lang_category_name'] ? $category['lang_category_name'] : $category['category_name'];
 
 
 
 
                $single_item = array("id"=>$category['id'],"text"=> ucwords($category_name),"img"=>$img);
    
                if (in_array($category['id'], $qCategoryId)) {
                $single_item['selected'] = true;
                }
    
                $items[] = $single_item;
 
             // Assign the response key & value to return json
           
            
         }
         $data['items'] = $items;
         $data['total_count']  = $total_count;
         // $data = $items;
         // return the json response
         echo json_encode($data);
         exit;
     }


       /**
     * getMakerList
     *
     * This Function  handle select dropdown of models on quick search.
     * @param  mixed $categoryId
     * @return void
     */
    function getMakerList_drp()
    {
        $product_type_id      = $this->session->userdata('product_type');

        if ($this->session->userdata('hide_category') == 0) {

            $categoryId = $this->input->post('vehicle_category_id');

        } else {

            $categoryId = $this->input->post('vehicle_category_id');

        }
       
        $search = $this->input->post('search');
        $offset = $this->input->post('page') ?  $this->input->post('page') * $this->config->item('pagination_limit') : 0;

        $makers_details = getMakerByProductType_drp($this->lang->default_lang_id,$categoryId, $product_type_id,$search);

        $makers_count = count($makers_details);
       
        // this code run makers data in foreach loop and geneate html of each option of dropdown
        $response = array();
        foreach ($makers_details as $key => $maker) {
            // if image is exist than set image else coming soon image will be set
            if (isset($maker['maker_logo']) && $maker['maker_logo'] != '' && file_exists("assets/uploads/product_maker/" . $maker['maker_logo'])) {
                $img = asset_url('assets/uploads/product_maker/' . $maker['maker_logo']);
            } else {
                $img = getNoImage('coming-soon');
            }

           
              // condition to display maker name as per default language
            $maker_name = $maker['lang_maker_name'] ? $maker['lang_maker_name'] : $maker['maker_name'];

            $single_item = array("id"=>$maker['id']."#".$categoryId,"text"=> ucwords($maker_name),"img"=>$img);

          

            $items[] = $single_item;


        }
        // retutn the json response
        $data = array();
        $data['items'] = $items;
        $data['total_count']  = $makers_count;
        // retutn the json response
        echo json_encode($data);
    }
    function get_model_list_data()
    {
        // $product_type_id      = $this->session->userdata('product_type');
        // echo $product_type_id;die;
        // if ($this->session->userdata('hide_category') == 0) {

        //     $categoryId = $this->input->post('vehicle_category_id');

        // } else {

        //     $categoryId = $this->input->post('vehicle_category_id');

        // }
           $model_id = $this->session->userdata('model_id');
        // $search = $this->input->post('search');
        $country_id = $this->lang->default_lang_id;
        // $offset = $this->input->post('page') ?  $this->input->post('page') * $this->config->item('pagination_limit') : 0;
            // echo $country_id;die;
        // $makers_details = getMakerByProductType_drp($this->lang->default_lang_id,$categoryId, $product_type_id,$search);
        $this->db->select('tbl_models.*,tbl_models_country.lang_model_name');
        $this->db->from('tbl_models');
        $this->db->join('tbl_models_country as tbl_models_country', 'tbl_models.id=tbl_models_country.lang_id and tbl_models_country.country_id=' . $country_id, 'left');
        $this->db->where_in('tbl_models.id', $model_id);
        $this->db->where('tbl_models.status', 1);
        $this->db->order_by("tbl_models.model_name", 'ASC');
        $models = $this->db->get()->result_array();
            
        $model_count = count($models);
       
        // this code run makers data in foreach loop and geneate html of each option of dropdown
        $response = array();
        foreach ($models as $key => $maker) {
            // if image is exist than set image else coming soon image will be set
            if (isset($maker['model_photo']) && $maker['model_photo'] != '' && file_exists("assets/uploads/product_model/" . $maker['model_photo'])) {
                $img = asset_url('assets/uploads/product_model/' . $maker['model_photo']);
            } else {
                $img = getNoImage('coming-soon');
            }

           
              // condition to display maker name as per default language
            $maker_name = $maker['lang_model_name'] ? $maker['lang_model_name'] : $maker['model_name'];

            $single_item = array("id"=>$maker['id']."#".$categoryId,"text"=> ucwords($maker_name),"img"=>$img);

          

            $items[] = $single_item;


        }
        // retutn the json response
        $data = array();
        $data['items'] = $items;
        $data['total_count']  = $model_count;
        // retutn the json response
        echo json_encode($data);
    }
}
