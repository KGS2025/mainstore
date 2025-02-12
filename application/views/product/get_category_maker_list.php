<?php $comingsoon = getNoImage('coming-soon');
foreach ($selected_vehicle_categories as $svc) {
    $category_id = $svc['id']; ?>
    <div class="maker-cat-list mb-4">
        <?php if($this->session->userdata('hide_category') == 0){?>
        <h4 class="w-100 d-flex align-items-center p-3 d-inline-block rounded accordianHead justify-content-between">
            <span class="position-relative d-inline-flex align-items-center"> 
                <input id="Checkbox_<?php echo $svc['id']; ?>" <?php if ($disable_multiselect == 1) echo " disabled ";?> type="checkbox" class="categorycheckbox categorycheckbox_<?php echo $svc['id']; ?>" value="<?php echo $svc['id']; ?>"/>
                <label class="text-white d-flex align-items-center" for="Checkbox_<?php echo $svc['id']; ?>"></label>
                <span> <?php echo (isset($svc['lang_category_name']) && $svc['lang_category_name']) ? $svc['lang_category_name'] : $svc['category_name']; ?> </span>
                <?php if (isset($svc['vehicle_category_icon']) && $svc['vehicle_category_icon'] != '' && file_exists("assets/uploads/vehicle_categories/" . $svc['vehicle_category_icon'])) { ?>
                    <img class="categorylogo mx-2" src="<?= $this->session->userdata('default_image');?>" data-img="<?php echo asset_url();?>assets/uploads/vehicle_categories/<?php echo $svc['vehicle_category_icon']; ?>" id="image_category_id_<?php echo $svc['id']; ?>" alt="<?php echo $svc['vehicle_category_icon']; ?>"/>
                <?php } else { ?>
                    <img src="<?= $this->session->userdata('default_image');?>" data-img="<?php echo $comingsoon; ?>" class="categorylogo mx-2" id="image_category_id_<?php echo $svc['id']; ?>" alt="coming soon"/>
                <?php } ?>
            </span>
            <span class="font22pxarial">
                <a onclick="showHide('.category_table_<?php echo $svc['id']; ?>')" href="javascript:void(0)">
                    <span class="black2-displayinline category_table_<?php echo $svc['id']; ?>_less_img">-</span>
                    <span class="black2-nodisplay category_table_<?php echo $svc['id']; ?>_more_img">+</span>
                </a>
                <br/>
            </span>
        </h4>
   


        <?php } ?>
        <div id="maker_block" class="mb-5 float-start w-100 category_table_<?php echo $category_id; ?>">
            <div class="AllProducts">

            <?php if($this->session->userdata('hide_category') == 0){?>
                <?php if($this->config->item('show_dropdown_in_search_pages') == "1") { ?>

            <div class="cl-filter">
            <?php if ($this->config->item('show_dropdown_description') == "1") { ?> 

                                        <h5 class="h5 clf-title"><?php echo $product_instruction->dropdown_instrunction;  ?></h5>
                                        <?php } ?>
                                        <div class="control-group"  style="width: 100%" >
                                        <label class="control-label"> <?php echo $product_instruction->dropdown_maker; ?></label>
                                        <div class="controls">
                                        <select class="maker_page_new_drop focustip span12" name="maker_id_dropdown[]" multiple="multiple" data-cat="<?php echo $category_id; ?>" required data-id="<?php echo $maker['id'];?>" <?php echo ($disable_multiselect?"disabled":""); ?>>
                                        </select>
                                        </div>
                                        <span id='attribute_file_validate' class='error displaynon'></span>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php } ?>

                <?php if(count($svc['makers']) > 0){?>
                <input type="hidden" class="total_maker" value="<?php echo $svc['toatalMakers']; ?>">
                <input type="hidden" class="loaded_makers" value="0">
                <?php foreach ($svc['makers'] as $maker) { ?>
                    <?php if ($maker['id']!='' || (!empty($maker_ids) && in_array($maker['id'], $maker_ids))) { ?>
                        <div class="ProductBlock">
                            <div class="pro-item product_type_image_wrap maker_<?php echo $category_id; ?> product_type_image_wrap1 singlestep <?php if (!empty($maker_ids) && in_array($maker['id'], $maker_ids)) { echo 'boarder_2_red'; } ?>">
                                <div class="height180px">
                                    <a href="javascript:void(0);" class="product_image_wrap"
                                        data-rel="<?php echo $maker['id'] . '#' . $category_id; ?>">
                                        <?php if (isset($maker['maker_logo']) && $maker['maker_logo'] != '' && file_exists("assets/uploads/product_maker/" . $maker['maker_logo'])) { ?>
                                            <img src="<?= $this->session->userdata('default_image');?>" alt="" data-img="<?php echo asset_url();?>assets/uploads/product_maker/<?php echo $maker['maker_logo']; ?>" class="img-responsive img-pad" />
                                        <?php } else { ?>
                                            <img src="<?= $this->session->userdata('default_image');?>" data-img="<?php echo $comingsoon; ?>" alt="coming soon" class="img-responsive" />
                                        <?php } ?>

                                    </a>
                                    <input type="hidden" name="maker_id[]" value="<?php if (!empty($maker_ids) && in_array($maker['id'], $maker_ids)) { echo $maker['id'] . '#' . $category_id; } ?>" class="vehicle_type_id makercheck_<?php echo $category_id; ?>">
                                </div>
			    </div>
			    <div class="pro-item-title">
                                <a href="javascript:void(0);" class="btn btn-primary btn-resize actn-btn"><?php echo $maker['lang_maker_name'] ? $maker['lang_maker_name'] : $maker['maker_name']; ?></a>
                            </div>

                        </div>
                    <?php } ?>
                <?php } ?>
                <?php }
                else{ ?>
                    <div id="no_more_button_makers" class="load-more-data kgtloadmore"> <?= $general_instruction->no_more_product_maker_to_load; ?> </div>
                <?php } ?>
            </div>
        </div>
        <?php if ($svc['toatalMakers'] > count($svc['makers'])) { ?>
            <div class="float-start w-100 d-flex align-items-center justify-content-center">
                <div id="more_button_makers" data-cid="<?php echo $svc['id']; ?>" class="more_button_makers load-more-data kgtloadmore w-auto m-auto"> <?= $general_instruction->load_more_product_maker; ?> </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>
