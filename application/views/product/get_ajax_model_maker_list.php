<?php 
$comingsoon = getNoImage('coming-soon');
if($type == 'maker'){?>
    <?php if (isset($model['makers']) && count($model['makers']) > 0) {?>
        <?php foreach ($model['makers'] as $maker) {
            $maker_id = $maker['id']; ?>
            <div class="model_maker_parent">
                <h4 class="w-100 d-flex align-items-center p-3 d-inline-block rounded accordianHead justify-content-between">
                    <span class="position-relative d-inline-flex align-items-center"> 
                        <input id="Checkbox_model_<?php echo $maker['id']; ?>" type="checkbox" class="brandselectcheckbox modelcheckbox_<?php echo $maker['id']; ?> productcheck_<?php echo $category_id; ?>" value="<?php echo $maker['id']; ?>"/>
                    
                        <label class="text-white d-inline-flex align-items-center" for="Checkbox_model_<?php echo $maker['id']; ?>"></label>
                        <span><?php if (isset($maker['lang_maker_name']) && $maker['lang_maker_name'] != '') {
                                echo $maker['lang_maker_name'];
                            } else {
                                echo $maker['maker_name'];
                            } ?></span>
                        <?php if (isset($maker['maker_logo']) && $maker['maker_logo'] != '' && file_exists("assets/uploads/product_maker/" . $maker['maker_logo'])) { ?>
                            <img class="brandmodeltitlelogo px-2" src="<?= $this->session->userdata('default_image');?>" data-img="<?php echo asset_url();?>assets/uploads/product_maker/<?php echo $maker['maker_logo']; ?>" id="image_model_id_<?php echo $maker['maker_logo']; ?>" alt="<?php echo $maker['maker_logo']; ?>"/>
                        <?php } else { ?>
                            <img src="<?= $this->session->userdata('default_image');?>" data-img="<?php echo $comingsoon; ?>" class="brandmodeltitlelogo px-2" id="image_model_id_<?php echo $model1['type']; ?>" alt="coming soon"/>
                        <?php } ?>
                    </span>
                    <span class="font22pxarial"> 
                        <a onclick="showHide('.model_table_<?php echo $maker['id'].'-'.$category_id; ?>')" href="javascript:void(0)">
                            <span class="black2-displayinline model_table_<?php echo $maker['id'].'-'.$category_id; ?>_less_img">-</span>
                            <span class="black2-nodisplay model_table_<?php echo $maker['id'].'-'.$category_id; ?>_more_img">+</span>
                        </a>
                        <br/>
                    </span>
                </h4>
                <?php if (!empty($maker['models']) && count($maker['models']) > 0) { ?>
                    <div id="product_maker_block" class="float-start w-100 model_table_<?php echo $maker['id'].'-'.$category_id; ?>">
                        <div class="AllProducts">
                            <input type="hidden" class="total_models" value="<?= $model['totalModels'][$maker['id'].'-'.$category_id]; ?>">
                            <input type="hidden" class="loaded_models" value="0">
                            <?php foreach ($maker['models'] as $model2) {?>
                                <?php if (empty($model_id) || (!empty($model_id) && in_array($model2['id'], $model_id))) {?>
                                    <div class="ProductBlock">
                                        <div class="pro-item product_type_image_wrap product_brand_category_<?php echo $category_id ?> product_brand_type_<?php echo $maker_id ?> product_type_image_wrap1 singlestep <?php if (!empty($model_id) && in_array($model2['id'], $model_id)) { echo "boarder_2_red"; } ?>">
                                            <div class="height180px aligncenter">
                                                <a href="javascript:void(0);"
                                                class="product_image_wrap product_image_wrap_type__<?php echo $maker_id; ?>"
                                                data-rel="<?php echo $maker_id . '#' . $model2['id']; ?>">
                                                    <?php if (isset($model2['model_photo']) && $model2['model_photo'] != '' && file_exists("assets/uploads/product_model/" . $model2['model_photo'])) { ?>
                                                        <img class="img-responsive" src="<?= $this->session->userdata('default_image');?>" data-img="<?php echo asset_url();?>assets/uploads/product_model/<?php echo $model2['model_photo']; ?>" alt=""/>
                                                    <?php } else { ?>
                                                        <img class="img-responsive" src="<?= $this->session->userdata('default_image');?>" data-img="<?php echo $comingsoon; ?>" alt="coming soon"/>
                                                    <?php } ?>
                                                </a>
                                                <input type="hidden" name="model_id[]" value="<?php if (!empty($model_id) && in_array($model2['id'], $model_id)) { echo $maker_id . '#' . $model2['id']; } ?>" class="vehicle_type_id productcheck_<?php echo $maker_id; ?>">
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
                        <?php if ($model['totalModels'][$maker['id'].'-'.$category_id] > count($maker['models'])) { ?>
                            <div class="my-3 float-start w-100 d-flex align-items-center justify-content-center">
                                <div id="more_button_model" data-cid="<?= $category_id;?>" data-maker="<?= $maker['id'];?>" class="more_button_model load-more-data kgtloadmore w-auto m-auto"> <?= $general_instruction->load_more_product_model; ?> </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class="my-3 float-start w-100 d-flex align-items-center justify-content-center">
                        <div id="no_more_button_model" class="load-more-data kgtloadmore"><?= $general_instruction->no_more_product_model_to_load; ?></div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if ($model['toalMakers'][$category_id] > count($model['makers'])) { ?>
            <div class="float-start w-100 d-flex align-items-center justify-content-center">
                <div id="more_button_model_maker" data-cid="<?= $category_id;?>"class="more_button_model_maker load-more-data kgtloadmore w-auto m-auto"> <?= $general_instruction->load_more_product_maker; ?> </div>
            </div>
        <?php } ?>
    <?php }else{ ?>
        <div class="float-start w-100 d-flex align-items-center justify-content-center">
            <div id="no_more_button_model_maker" class="load-more-data kgtloadmore w-auto d-inline-block"><?php echo $general_instruction->no_more_product_maker_to_load; ?></div>
        </div>
    <?php } ?>
<?php }else if($type == 'model'){ ?>
    <div class="AllProducts">
    <?php foreach ($models as $model) {?>
            <div class="ProductBlock">
                <div class="pro-item product_type_image_wrap product_brand_category_<?php echo $category_id ?> product_brand_type_<?php echo $maker_id ?> product_type_image_wrap1 singlestep <?php if (!empty($model_id) && in_array($model['id'], $model_id)) { echo "boarder_2_red"; } ?>">
                    <div class="height180px aligncenter">
                        <a href="javascript:void(0);"
                        class="product_image_wrap product_image_wrap_type__<?php echo $maker_id; ?>"
                        data-rel="<?php echo $maker_id . '#' . $model['id']; ?>">
                            <?php if (isset($model['model_photo']) && $model['model_photo'] != '' && file_exists("assets/uploads/product_model/" . $model['model_photo'])) { ?>
                                <img class="img-responsive" src="<?= $this->session->userdata('default_image');?>" data-img="<?php echo asset_url();?>assets/uploads/product_model/<?php echo $model['model_photo']; ?>" alt=""/>
                            <?php } else { ?>
                                <img class="img-responsive" src="<?= $this->session->userdata('default_image');?>" data-img="<?php echo $comingsoon; ?>" alt="coming soon"/>
                            <?php } ?>
                        </a>
                        <input type="hidden" name="model_id[]" value="<?php if (!empty($model_id) && in_array($model['id'], $model_id)) { echo $maker_id . '#' . $model['id']; } ?>" class="vehicle_type_id productcheck_<?php echo $maker_id; ?>">
                    </div>
		</div>
		<div class="pro-item-title">
			<a href="javascript:void(0);" class="btn  actn-btn" aria-label="Showing the model name">
                        <?php if (isset($model['lang_model_name']) && $model['lang_model_name'] != '') {
                            echo $model['lang_model_name'];
                        } else {
                            echo $model['model_name'];
                        } ?>
			</a>

		</div>
            </div>
    <?php } ?>
    </div>
<?php } ?>
