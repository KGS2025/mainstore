<?php $hide_category = isset($all_data['quick_search_hide_category']) ? $all_data['quick_search_hide_category'] : 0; ?>
<form action="<?php echo base_url() . $lang_id . '/'; ?>products/product_list" method="post" id="quick_search_form" class="float-start w-100">
    <input type="hidden" name="quick_search" id="quick_search" value="quick_search">
    <div class="adv_srch p-1 my-3 position-relative">
<?php if ($this->config->item('show_quicksearch_label') == "1") { ?> 
<h5 class="paddingtopzero  px-2"><?= $general_instruction->quick_search_label; ?></h5>
<?php } ?>
        <div class="box-list-select width100percent3">            
            <div class="quickSearchFilter d-flex w-100 justify-content-between align-items-center">
                <?php $qSearchType = $this->session->userdata('qSearchType') ? $this->session->userdata('qSearchType') : 0;?>
                <!-- <input type="hidden" class="default_search" value="<?php echo $qSearchType; ?>" /> -->
                <!-- <div class="vehicle-type-filter d-flex flex-grow-1">
                    <?php if($hide_category == 0){ ?>
                        <input type="hidden" value="" class="product_year">
                        <input type="hidden" value="" class="engine_size">

                        <div class="fieldgroup px-2 position-relative">
                            <?php if ($this->config->item('show_quicksearch_label') == "1") { ?> 

                            <label class="control-label"  ><?= $general_instruction->quick_search_type; ?></label>
                            <?php } ?>
                            <select name="searchtype" class="form-control searchtype">
                                <?php
                                if ($all_data['vehicle_type_img'] != '' && file_exists("assets/uploads/vehicle_categories/" . $all_data['vehicle_type_img'])) { 
                                    $vimg = asset_url('assets/uploads/vehicle_categories/'.$all_data['vehicle_type_img']);
                                } else {
                                    $vimg = getNoImage('no-image');
                                }?>
                                <?php if ($all_data['product_type_img'] != '' && file_exists("assets/uploads/vehicle_categories/" . $all_data['product_type_img'])) { 
                                    $pimg = asset_url('assets/uploads/vehicle_categories/'.$all_data['product_type_img']);
                                } else {
                                    $pimg = getNoImage('no-image');
                                }?>
                                <option value="0" data-image="<?= $vimg;?>" <?php if($qSearchType == 0){echo 'selected';}?> ><?= $general_instruction->vehicle_type_label; ?></option>
                                <option value="1" data-image="<?= $pimg;?>" <?php if($qSearchType == 1){echo 'selected';}?> ><?= $general_instruction->product_type_label; ?></option>
                            </select>
                        </div>
                    <?php }else{ ?>
                        <input type="hidden" value="0" id="searchtype">
                    <?php } ?>

                    <?php if($hide_category == 0){?>
                    <div class="fieldgroup px-2 position-relative  category_qs_div qs_element_div">
                    <?php if ($this->config->item('show_quicksearch_label') == "1") { ?> 
                    
                    <label class="control-label"  ><?= $general_instruction->product_category; ?></label>
                      <?php } ?>
                    <span class="vehicle_type_span"> 
                            <select name="vehicle_category_ids[]" class="form-control vehicle_category_ids" onChange="getMakerList();">
                            </select>
                        </span>
                    </div>
                    <div class="fieldgroup px-2 position-relative maker_qs_div qs_element_div">
                    <?php if ($this->config->item('show_quicksearch_label') == "1") { ?> 

                    <label class="control-label"  ><?= $general_instruction->product_maker; ?></label>
                    <?php } ?>

                    <span class="product_maker_span float-start w-100 position-relative">
                    <select name="maker_id[]" class="form-control maker_id maker_id_qs" onChange="getModelList()">
                    </select>
                    </span>
                    </div>

                    <div class="fieldgroup px-2 position-relative model_qs_div  qs_element_div">
                    <?php if ($this->config->item('show_quicksearch_label') == "1") { ?> 

                    <label class="control-label"  ><?= $general_instruction->product_model; ?></label>

                    <?php } ?>

                    <span class="product_model_span float-start w-100 position-relative">
                    <select name="model_id[]" class="form-control model_id model_id_qs" onChange="getProductList()" >
                    </select>
                    </span>
                    </div>

                    <div class="fieldgroup px-2 position-relative product_qs_div qs_element_div">
                    <?php if ($this->config->item('show_quicksearch_label') == "1") { ?> 

                    <label class="control-label"  ><?= $general_instruction->product_group; ?></label>
                    <?php } ?>


                    <span class="product_type_span float-start w-100 position-relative">
                    <select name="product_type_id" class="form-control product_type_id" onChange="show_search()">
                    </select>
                    </span>
                    </div>

                    <?php }else { ?>
                        <input type="hidden" value="all" class="vehicle_category_ids">
                    <?php  ?>
                   
                 


                        <div class="fieldgroup px-2 position-relative maker_qs_div qs_element_div">
                        <?php if ($this->config->item('show_quicksearch_label') == "1") { ?> 

                            <label class="control-label"  ><?= $general_instruction->product_maker; ?></label>
                            <?php } ?>

                            <span class="product_maker_span float-start w-100 position-relative">
                                <select name="maker_id[]" class="form-control maker_id maker_id_qs" onChange="getModelList()" >
                                </select>
                            </span>
                        </div>

                        <div class="fieldgroup px-2 position-relative model_qs_div  qs_element_div">
                        <?php if ($this->config->item('show_quicksearch_label') == "1") { ?> 

                            <label class="control-label"  ><?= $general_instruction->product_model; ?></label>

                            <?php } ?>

                            <span class="product_model_span float-start w-100 position-relative">
                                <select name="model_id[]" class="form-control model_id model_id_qs" onChange="getYearList()" >
                                </select>
                            </span>
                        </div>
                       
                        <div class="fieldgroup px-2 position-relative year_qs_div qs_element_div">
                             <?php if ($this->config->item('show_quicksearch_label') == "1") { ?> 

                            <label class="control-label"><?= $general_instruction->model_year; ?></label>
                            <?php } ?>

                            <span class="product_year_span float-start w-100 position-relative">
                                <select name="model_year[]" class="form-control model_year" onChange="getEngineSizeList()">
                                </select>
                            </span>
                        </div>
                        
                        <div class="fieldgroup px-2 position-relative engine_qs_div qs_element_div">
                        <?php if ($this->config->item('show_quicksearch_label') == "1") { ?> 

                            <label class="control-label"  ><?= $general_instruction->model_engine_size; ?></label>
                            <?php } ?>

                            <span class="engine_size_span float-start w-100 position-relative">
                                <select name="engine_size[]" class="form-control engine_size" onChange="getProductTypeList()" >
                                </select>
                            </span>
                        </div>


                        <div class="fieldgroup px-2 position-relative group_qs_div qs_element_div">
                    <?php if ($this->config->item('show_quicksearch_label') == "1") { ?> 

                    <label class="control-label"  ><?= $general_instruction->product_group; ?></label>
                    <?php } ?>

                    <span class="product_type_span float-start w-100 position-relative">
                    <select name="product_type_id" class="form-control product_type_id_new" onChange="show_search()"  >
                    </select>
                    </span>
                    </div>

                
                    <?php } ?>

                   
                </div> -->

                <?php if($hide_category == 0){ ?>
                <div class="product-type-filter d-flex flex-grow-1 displaynon">

                    <div class="fieldgroup px-2 position-relative">
                        <?php if ($this->config->item('show_quicksearch_label') == "1") { ?> 

                        <label class="control-label"  ><?= $general_instruction->quick_search_type; ?></label>
                        <?php } ?>

                        <select name="searchtype" class="form-control searchtype">
                            <?php $qSearchType = $this->session->userdata('qSearchType') ? $this->session->userdata('qSearchType') : 0;
                            if ($all_data['vehicle_type_img'] != '' && file_exists("assets/uploads/vehicle_categories/" . $all_data['vehicle_type_img'])) { 
                                $vimg = asset_url('assets/uploads/vehicle_categories/'.$all_data['vehicle_type_img']);
                            } else {
                                $vimg = getNoImage('no-image');
                            }?>
                            <?php if ($all_data['product_type_img'] != '' && file_exists("assets/uploads/vehicle_categories/" . $all_data['product_type_img'])) { 
                                $pimg = asset_url('assets/uploads/vehicle_categories/'.$all_data['product_type_img']);
                            } else {
                                $pimg = getNoImage('no-image');
                            }?>
                            <option value="0" data-image="<?= $vimg;?>" <?php if($qSearchType == 0){echo 'selected';}?> ><?= $general_instruction->vehicle_type_label; ?></option>
                            <option value="1" data-image="<?= $pimg;?>" <?php if($qSearchType == 1){echo 'selected';}?> ><?= $general_instruction->product_type_label; ?></option>
                        </select>
                    </div>

                    <div class="fieldgroup px-2 position-relative product_qs_div qs_element_div">
                    <?php if ($this->config->item('show_quicksearch_label') == "1") { ?> 
                        <label class="control-label"  ><?= $general_instruction->product_group; ?></label>
                        <?php } ?>

                        <span class="product_type_span float-start w-100 position-relative"> 
                            <select name="product_type_id[]" class="form-control product_type_id" onChange="getCategoryList();">
                            </select>
                        </span>
                    </div>

                    <div class="fieldgroup px-2 position-relative qs_ps_category qs_element_div">
                    <?php if ($this->config->item('show_quicksearch_label') == "1") { ?> 

                        <label class="control-label"  ><?= $general_instruction->product_category; ?></label> 
                        <?php } ?>

                        <span class="vehicle_type_span float-start w-100 position-relative">
                            <select name="vehicle_category_ids[]" class="form-control vehicle_category_ids" onChange="getMakerList();">
                            </select>
                        </span>
                    </div>
                    
                    <div class="fieldgroup px-2 position-relative qs_ps_maker qs_element_div">
                    <?php if ($this->config->item('show_quicksearch_label') == "1") { ?> 

                        <label class="control-label"  ><?= $general_instruction->product_maker; ?></label>
                        <?php } ?>

                        <span class="product_maker_span float-start w-100 position-relative ">
                            <select name="maker_id[]" class="form-control maker_id maker_ps" onChange="getModelList();">
                            </select>
                        </span>
                    </div>

                    <div class="fieldgroup px-2 position-relative qs_ps_model qs_element_div" >
                    <?php if ($this->config->item('show_quicksearch_label') == "1") { ?> 

                        <label class="control-label"  ><?= $general_instruction->product_model; ?></label>
                        <?php } ?>

                        <span class="product_model_span float-start w-100 position-relative">
                            <select name="model_id[]" class="form-control model_id model_ps" onChange="show_search()">
                            </select>
                        </span>
                    </div>
                </div>
                <?php } ?>
                
                <div class="fix-btn-search-ad">
                    <button name="quicksearch" type="submit" class="btn btn-primary btn-search-ad rounded qs_element_div" id="quicker_search"><?= $general_instruction->search_label; ?></button>
                </div>
            </div>
        </div>

        <!-- Quick search Loader -->
        <div id="QuickSearchLoading" style="display: none;">
            <div class="loadingContent">
                <img src="<?= site_url('assets/frontend/images/spin-loader.svg');?>">   
                <p></p>
            </div>
        </div>
    </div>
</form>
