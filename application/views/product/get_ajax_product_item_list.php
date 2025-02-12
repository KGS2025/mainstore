<?php $comingsoon = getNoImage('coming-soon');

$currencyV = getDefaultCurrencyCode('l') . '_currency';
$priceV    = 'price';
$currency  = $general_instruction->$currencyV;
$loggedUserId = getFrontenduserId();
$front_validuser_data = $this->session->userdata('front_validuser_data');
$remaining_time = isset($front_validuser_data['remaining_time']) ? $front_validuser_data['remaining_time'] : 0;


if ($type == 'category') { ?>
    <?php if (count($productgroup['categories']) > 0) {
        foreach ($productgroup['categories'] as $svc) {
            $category_id = $svc['id']; ?>
            <div class="item-parent-list">
                <?php if ($this->session->userdata('hide_category') == 0 || true) { ?>
                    <h4 class="w-100 d-flex align-items-center p-3 d-inline-block rounded accordianHead justify-content-between">
                        <span class="position-relative d-inline-flex align-items-center">
                            <input id="Checkbox_<?php echo $svc['id']; ?>" <?php if ($disable_multiselect == 1) echo " disabled ";?> type="checkbox" class="categorycheckbox categorycheckbox_<?php echo $svc['id']; ?>" value="<?php echo $svc['id']; ?>" />

                            <label class="text-white d-inline-flex align-items-center" for="Checkbox_<?php echo $svc['id']; ?>">
                            </label>
                            <span>
                                <?php echo (isset($svc['lang_category_name']) && $svc['lang_category_name']) ? $svc['lang_category_name'] : $svc['category_name']; ?>
                            </span>
                            <?php if (isset($svc['vehicle_category_icon']) && $svc['vehicle_category_icon'] != '' && file_exists("assets/uploads/vehicle_categories/" . $svc['vehicle_category_icon'])) { ?>
                                <img class="categorylogo px-2" src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo asset_url(); ?>assets/uploads/vehicle_categories/<?php echo $svc['vehicle_category_icon']; ?>" id="image_category_id_<?php echo $svc['id']; ?>" alt="<?php echo $svc['vehicle_category_icon']; ?>" />
                            <?php } else { ?>
                                <img src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo $comingsoon; ?>" class="categorylogo px-2" id="image_category_id_<?php echo $svc['id']; ?>" alt="coming soon" />
                            <?php } ?>
                        </span>
                        <span class="font22pxarial">
                            <a onclick="showHide('.category_table_<?php echo $svc['id']; ?>')" href="javascript:void(0)">
                                <span class="black2-displayinline category_table_<?php echo $svc['id']; ?>_less_img">-</span>
                                <span class="black2-nodisplay category_table_<?php echo $svc['id']; ?>_more_img">+</span>
                            </a>
                            <br />
                        </span>
                    </h4>

                   

                <?php } ?>
                <div id="maker_block" class="mb-5 float-start w-100 category_table_<?php echo $category_id; ?>">
                    <div class="AllProducts">
                    <?php if ($this->session->userdata('hide_category') == 0 || true) { ?>
                        <?php if($this->config->item('show_dropdown_in_search_pages') == "1") { ?>

                    <div class="cl-filter p-3">
                    <?php if ($this->config->item('show_dropdown_description') == "1") { ?> 

						<h5 class="h5 clf-title"><?php echo $product_instruction->dropdown_instrunction;  ?></h5>
                        <?php } ?>

                        <div class="control-group" style="width: 100%"> 
							<label class="control-label"> <?php echo $product_instruction->dropdown_type;  ?></label>
							<div class="controls">
                                <select class="group_new_drop_items_cat focustip span12" name="product_type[]" data_cat="<?php echo $svc['id']; ?>" multiple="multiple" required <?php echo ($disable_multiselect?"disabled":""); ?>>

                                </select>
							</div>
							<span id='attribute_file_validate' class='error displaynon'></span>
						</div>
					</div>
                    <?php } ?>

                    <?php } ?>
                        <?php if (count($svc['items']) > 0) { ?>
                            <input type="hidden" class="total_items" value="<?= $productgroup['totalItems'][$category_id]; ?>">
                            <input type="hidden" class="loaded_items" value="0">
                            <?php foreach ($svc['items'] as $product) { ?>
                                <?php if (empty($product_type_id) || (!empty($product_type_id) && in_array($product['id'], $product_type_id))) { ?>
                                    <div class="ProductBlock<?php if ($disable_multiselect == 1) {echo " disable-multi-select";};?>">
                                        <div class="pro-item product_type product_brand_category_<?php echo $category_id; ?> product_model_<?php echo $product['model_id']; ?> product_brand_type_<?php echo $product['maker_id']; ?> <?php if (!empty($product_type_id) && in_array($product['id'], $product_type_id)) {
                                                                                                                                                                                                                                            echo 'boarder_2_red';
                                                                                                                                                                                                                                        } ?>">
                                            <div class="height180px aligncenter">
                                                <a href="javascript:void(0);" class="product_image_wrap product_image_wrap_ajax product_image_wrap_type__<?php echo $product['maker_id']; ?>" data-rel="<?php echo $product['id']; ?>">
                                                    <?php if ($product['Product_Type_Photo'] != '' && file_exists("assets/uploads/product_type_images/" . $product['Product_Type_Photo'])) { ?>
                                                        <img class="img-responsive minheight1" src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo asset_url(); ?>assets/uploads/product_type_images/<?php echo $product['Product_Type_Photo']; ?>" alt="" />
                                                    <?php } else { ?>
                                                        <img class="img-responsive minheight1" src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo $comingsoon; ?>" alt="coming soon" />
                                                    <?php } ?>
                                                </a>
                                                <input type="hidden" name="product_type[]" value="<?php if (!empty($product_type_id) && in_array($product['id'], $product_type_id)) {
                                                                                                        echo $product['id'];
                                                                                                    } ?>" class="vehicle_type_id productcheck_<?php echo $product['id']; ?>   ">
                                            </div>
                                            </a>
                                            <?php if (($this->config->item('product_group_minimum_price_show_to_guest_user') == "1" && $remaining_time <= 0 && empty($loggedUserId)) || ($this->config->item('product_group_minimum_price_show_to_all_users') == "1")) { ?>
                                                <span class="start_from"> <?php echo $general_instruction->start_from; ?> <?php echo $currency . " " . $product['min_price']; ?> </span> <?php if ($product['in_stock'] > 0) { ?> <span class="Instock"><?php echo strtoupper($product_instruction->in_stock); ?> </span> <?php } ?> <?php } ?>
					</div>
					<div class="pro-item-title">
                                            <a href="javascript:void(0);" class="btn  actn-btn" aria-label="Showing the product type name"><?php echo $product['lang_product_type_name'] ? $product['lang_product_type_name'] : $product['product_type_name']; ?>
                                            </a>        
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        <?php } else { ?>
                            <div id="no_more_button_product_item" class="load-more-data kgtloadmore"> <?= $general_instruction->no_more_product_type_to_load; ?> </div>
                        <?php } ?>
                    </div>
                </div>
                <?php if ($productgroup['totalItems'][$category_id] > count($svc['items'])) { ?>
                    <div class="float-start w-100 d-flex align-items-center justify-content-center">
                        <div id="more_button_product_item" data-cid="<?= $category_id; ?>" class="more_button_product_item load-more-data kgtloadmore"> <?= $general_instruction->load_more_product_type; ?> </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div id="no_more_button_item_cat" class="load-more-data kgtloadmore"> <?= $general_instruction->no_more_vehicle_type_to_load; ?> </div>
    <?php } ?>
<?php } else if ($type == 'items') { ?>
    <?php if (count($items) > 0) { ?>
        <div class="AllProducts">
            <?php foreach ($items as $product) { ?>
                <div class="ProductBlock">
                    <div class="pro-item product_type product_brand_category_<?php echo $category_id; ?> product_model_<?php echo $product['model_id']; ?> product_brand_type_<?php echo $product['maker_id']; ?> <?php if (!empty($product_type_id) && in_array($product['id'], $product_type_id)) {
                                                                                                                                                                                                                        echo 'boarder_2_red';
                                                                                                                                                                                                                    } ?>">
                        <div class="height180px aligncenter">
                            <a href="javascript:void(0);" class="product_image_wrap product_image_wrap_ajax product_image_wrap_type__<?php echo $product['maker_id']; ?>" data-rel="<?php echo $product['maker_id'] . '#' . $product['model_id'] . '#' . $product['id'] . '#' . $category_id; ?>">
                                <?php if ($product['Product_Type_Photo'] != '' && file_exists("assets/uploads/product_type_images/" . $product['Product_Type_Photo'])) { ?>
                                    <img class="img-responsive minheight1" src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo asset_url(); ?>assets/uploads/product_type_images/<?php echo $product['Product_Type_Photo']; ?>" alt="" />
                                <?php } else { ?>
                                    <img class="img-responsive minheight1" src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo $comingsoon; ?>" alt="coming soon" />
                                <?php } ?>
                            </a>
                            <input type="hidden" name="product_type[]" value="<?php if (!empty($product_type_id) && in_array($product['id'], $product_type_id)) {
                                                                                    echo $product['maker_id'] . '#' . $product['model_id'] . '#' . $product['id'] . '#' . $category_id;
                                                                                } ?>" class="vehicle_type_id productcheck_<?php echo $product['id']; ?>   ">
                        </div>
                        <a href="javascript:void(0);" class="btn  actn-btn" aria-label="Showing the product type name"><?php echo $product['lang_product_type_name'] ? $product['lang_product_type_name'] : $product['product_type_name']; ?> </a>
                        <?php if (($this->config->item('product_group_minimum_price_show_to_guest_user') == "1" && $remaining_time <= 0 && empty($loggedUserId)) || ($this->config->item('product_group_minimum_price_show_to_all_users') == "1")) { ?>                            <span class="start_from"> <?php echo $general_instruction->start_from; ?> <?php echo $currency . " " . $product['min_price']; ?> </span> <?php if ($product['in_stock'] > 0) { ?> <span class="Instock"><?php echo strtoupper($product_instruction->in_stock); ?> </span> <?php } ?> <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
<?php } ?>
