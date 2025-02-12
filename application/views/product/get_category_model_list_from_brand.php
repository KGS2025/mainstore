<?php if (count($modelList['models']) > 0) {
    $comingsoon = getNoImage('coming-soon'); ?>
    <?php //print_r($modellist);?>
    <?php foreach ($modelList['models'] as $model) {

        $category_id = $model['id']; ?>
        <div class="model-parent accordianHead p-3 float-start w-100">
            <?php if ($this->session->userdata('hide_category') == 0 || true) { ?>
                <h4 class="w-100 d-flex align-items-center p-3 d-inline-block rounded accordianHead justify-content-between">
                    <span class="position-relative d-inline-flex align-items-center"> 
                        <input id="Checkbox_<?php echo $model['id']; ?>" <?php if ($disable_multiselect == 1) echo " disabled ";?> type="checkbox" class="brandcheckbox brandcheckbox_<?php echo $model['id']; ?>" value="<?php echo $model['id']; ?>" />
                        <label class="text-white d-inline-flex align-items-center" for="Checkbox_<?php echo $model['id']; ?>"></label>
                        <span>
                            <?php if (isset($model['lang_category_name']) && $model['lang_category_name'] != '') {
                                echo $model['lang_category_name'];
                            } else {
                                echo $model['category_name'];
                            } ?>
                        </span>
                        <?php if (isset($model['VehicleType_Photo']) && $model['VehicleType_Photo'] != '' && file_exists("assets/uploads/vehicle_categories/" . $model['VehicleType_Photo'])) { ?>
                            <img class="brandmodeltitlelogo mx-2" src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo asset_url(); ?>assets/uploads/vehicle_categories/<?php echo $model['VehicleType_Photo']; ?>" id="image_maker_id_<?php echo $model['id']; ?>" alt="<?php echo $model['VehicleType_Photo']; ?>" />
                        <?php } else { ?>
                            <img src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo $comingsoon; ?>" class="brandmodeltitlelogo mx-2" id="image_maker_id_<?php echo $model['id']; ?>" alt="coming soon" />
                        <?php } ?>
                    </span>
                    <span class="font22pxarial">
                        <a onclick="showHide('.brand_complete_info_<?php echo $model['id']; ?>')" href="javascript:void(0)">
                            <span class="black2-displayinline brand_complete_info_<?php echo $model['id']; ?>_less_img">-</span>
                            <span class="black2-nodisplay brand_complete_info_<?php echo $model['id']; ?>_more_img">+</span>
                        </a>
                        <br />
                    </span>
                </h4>
            <?php } ?>

            <div class="brand_complete_info p-3 brand_complete_info_<?php echo $model['id']; ?>" id="tbl-camry-<?php echo $model['id']; ?>" style="<?php if ($this->session->userdata('hide_category') == 1) { echo 'padding-left: 0px !important;'; } ?>">
                <?php if (isset($model['makers']) && count($model['makers']) > 0) { ?>
                    <input type="hidden" class="total_maker" value="<?= $modelList['toalMakers'][$category_id]; ?>">
                    <input type="hidden" class="loaded_makers" value="0">
                    <?php foreach ($model['makers'] as $maker) {
                       $maker_id = $maker['id'];

                        if (!empty($maker['models']) && count($maker['models']) > 0) { ?>
                            <div class="model_maker_parent">
                                <h4 class="w-100 d-flex align-items-center p-3 d-inline-block rounded accordianHead justify-content-between">
                                    <span class="position-relative d-inline-flex align-items-center"> 
                                        <input id="Checkbox_model_<?php echo $maker['id']; ?>" <?php if ($disable_multiselect == 1) echo " disabled ";?> type="checkbox"  class="brandselectcheckbox modelcheckbox_<?php echo $maker['id']; ?> productcheck_<?php echo $category_id; ?>" value="<?php echo $maker['id']; ?>" />
                                    
                                        <label class="text-white d-inline-flex align-items-center" for="Checkbox_model_<?php echo $maker['id']; ?>"></label>
                                        <span>
                                            <?php if (isset($maker['lang_maker_name']) && $maker['lang_maker_name'] != '') {
                                                echo $maker['lang_maker_name'];
                                            } else {
                                                echo $maker['maker_name'];
                                            } ?>
                                        </span>
                                        <?php if (isset($maker['maker_logo']) && $maker['maker_logo'] != '' && file_exists("assets/uploads/product_maker/" . $maker['maker_logo'])) { ?>
                                            <img class="brandmodeltitlelogo mx-2" src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo asset_url(); ?>assets/uploads/product_maker/<?php echo $maker['maker_logo']; ?>" id="image_model_id_<?php echo $maker['maker_logo']; ?>" alt="<?php echo $maker['maker_logo']; ?>" />
                                        <?php } else { ?>
                                            <img src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo $comingsoon; ?>" class="brandmodeltitlelogo mx-2" alt="coming soon" />
                                        <?php } ?>
                                    </span>
                                    <span class="font22pxarial">
                                        <a onclick="showHide('.model_table_<?php echo $maker['id'] . '-' . $category_id; ?>')" href="javascript:void(0)">
                                            <span class="black2-displayinline model_table_<?php echo $maker['id'] . '-' . $category_id; ?>_less_img">-</span>
                                            <span class="black2-nodisplay model_table_<?php echo $maker['id'] . '-' . $category_id; ?>_more_img">+</span>
                                        </a>
                                        <br />
                                    </span>
                                    </h4>
                                    <?php if($modelIdcheck=='yes'){ ?>

                                        <?php if($this->config->item('show_dropdown_in_search_pages') == "1") { ?>
                                    <div class="cl-filter">
                                    <?php if ($this->config->item('show_dropdown_description') == "1") { ?> 

                                        <h5 class="h5 clf-title"><?php echo $product_instruction->dropdown_instrunction;  ?></h5>
                                        <?php } ?>
                                        <div class="control-group abc"  style="width: 100%" >
                                        <label class="control-label"> <?php echo $product_instruction->dropdown_model;  ?> </label>
                                        <div class="controls">
                                                <select class="model_new_drop1 focustip span12" name="model_ids[]" multiple="multiple" required data-cat_id="<?php if ($this->session->userdata('hide_category') == 1) { echo "all"; } else { echo $category_id; } ?>" data-id="<?php echo $maker['id'];?>">
                                                </select>
                                            </div>
                                            <span id='attribute_file_validate' class='error displaynon'></span>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    
                                    <?php }else{ ?>

                                        <?php if($this->config->item('show_dropdown_in_search_pages') == "1") { ?>

                                        <div class="cl-filter">
                                        <?php if ($this->config->item('show_dropdown_description') == "1") { ?> 

                                        <h5 class="h5 clf-title"><?php echo $product_instruction->dropdown_instrunction;  ?></h5>
                                        <?php } ?>
                                        <div class="control-group abc"  style="width: 100%" >
                                        <label class="control-label"> <?php echo $product_instruction->dropdown_model;  ?> </label>
                                        <div class="controls">
                                                <select class="model_new_drop focustip span12" name="model_id[]" multiple="multiple" required data-cat_id="<?php if ($this->session->userdata('hide_category') == 1) { echo "all"; } else { echo $category_id; } ?>" data-id="<?php echo $maker['id'];?>" <?php echo ($disable_multiselect?"disabled":""); ?>>
                                                </select>
                                            </div>
                                            <span id='attribute_file_validate' class='error displaynon'></span>
                                        </div>
                                    </div>
                                    <?php } ?>
                                <?php } ?>
            
                                
                                <?php if (!empty($maker['models']) && count($maker['models']) > 0) { ?>
                                    <div id="product_maker_block" class="float-start w-100 model_table_<?php echo $maker['id'] . '-' . $category_id; ?>">
                                        <div class="AllProducts">
                                            <input type="hidden" class="total_models" value="<?= $modelList['totalModels'][$maker['id'] . '-' . $category_id]; ?>">
                                            <input type="hidden" class="loaded_models" value="0">
                                            <?php foreach ($maker['models'] as $model2) {
                                                 ?>
                                                <?php if (empty($model_id) || (!empty($model_id) && in_array($model2['id'], $model_id))) { ?>
                                                    <div class="ProductBlock<?php if ($disable_multiselect == 1) {echo " disable-multi-select";};?>">
                                                        <div class="pro-item product_type_image_wrap product_brand_category_<?php echo $category_id ?> product_brand_type_<?php echo $maker_id ?> product_type_image_wrap1 singlestep <?php if (!empty($model_id) && in_array($model2['id'], $model_id)) {
                                                                                                                                                                                                                                            echo "boarder_2_red";
                                                                                                                                                                                                                                        } ?>">
                                                            <div class="aligncenter">
                                                                <a href="javascript:void(0);" class="product_image_wrap product_image_wrap_type__<?php echo $maker_id; ?>" data-rel="<?php echo $maker_id . '#' . $model2['id']; ?>">
                                                                    <?php if (isset($model2['model_photo']) && $model2['model_photo'] != '' && file_exists("assets/uploads/product_model/" . $model2['model_photo'])) { ?>
                                                                        <img class="img-responsive" src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo asset_url(); ?>assets/uploads/product_model/<?php echo $model2['model_photo']; ?>" alt="" />
                                                                    <?php } else { ?>
                                                                        <img class="img-responsive" src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo $comingsoon; ?>" alt="coming soon" />
                                                                    <?php } ?>
                                                                </a>
                                                                <input type="hidden" name="model_id[]" value="<?php if (!empty($model_id) && in_array($model2['id'], $model_id)) {
                                                                                                                    echo $maker_id . '#' . $model2['id'];
                                                                                                                } ?>" class="vehicle_type_id productcheck_<?php echo $maker_id; ?>">
                                                            </div>
							</div>
							<div class="pro-item-title">
                                                            <a href="javascript:void(0);" class="btn  actn-btn" aria-label="Showing the model name">
                                                                <?php if (isset($model2['lang_model_name']) && $model2['lang_model_name'] != '') {
                                                                    echo $model2['lang_model_name'];
                                                                } else {
                                                                    echo $model2['model_name'];
                                                                } ?>
                                                            </a>                                                       
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                        <?php if ($modelList['totalModels'][$maker['id'] . '-' . $category_id] > count($maker['models'])) { ?>
                                            <div class="my-3 float-start w-100 d-flex align-items-center justify-content-center">
                                                <div id="more_button_model" data-cid="<?= $category_id; ?>" data-maker="<?= $maker['id']; ?>" class="more_button_model load-more-data kgtloadmore m-auto w-auto"> <?= $general_instruction->load_more_product_model; ?> </div>
                                            </div>                                                
                                        <?php } ?>
                                    </div>
                                    <?php } else { ?>
                                        <div class="my-3 float-start w-100 d-flex align-items-center justify-content-center">
                                            <div id="no_more_button_model" class="load-more-data kgtloadmore"><?= $general_instruction->no_more_product_model_to_load; ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } else { ?>
                    <div class="float-start w-100 d-flex align-items-center justify-content-center">
                        <div id="no_more_button_model_maker" class="load-more-data kgtloadmore w-auto d-inline-block"><?php echo $general_instruction->no_more_product_maker_to_load; ?></div>
                    </div>
                <?php } ?>
            </div>
            <?php if ($modelList['toalMakers'][$category_id] > count($model['makers'])) { ?>

                <div class="float-start w-100 d-flex align-items-center justify-content-center">
                    <div id="more_button_model_maker" data-cid="<?= $category_id; ?>" class="more_button_model_maker load-more-data kgtloadmore w-auto d-inline-block"> <?= $general_instruction->load_more_product_maker; ?> </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
<?php } else { ?>
    <div id="no_more_button_mak_cat" class="load-more-data kgtloadmore"><?php echo $general_instruction->no_more_vehicle_type_to_load; ?></div>
<?php } ?>
<input type="hidden" id="auto_load_value" value="1">
<script type="text/javascript">
    window.addEventListener('scroll', function() {
        var moreButton = document.getElementById('more_button_model');
        var target = document.querySelector('.AllProducts');
        if(target.style.display === 'none' || document.getElementById("auto_load_value").value==0){
            return;
        }else{
            var buttonPosition = moreButton.getBoundingClientRect().top + window.scrollY;
            var currentPosition = window.scrollY + window.innerHeight;

            if (currentPosition >= buttonPosition && currentPosition <= buttonPosition + window.innerHeight/4) {
                moreButton.click(); // Trigger the click event on the button
            }
        }

    });
</script>
