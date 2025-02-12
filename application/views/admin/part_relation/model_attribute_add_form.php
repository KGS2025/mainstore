<?php
$cat_array = array();


$year_size = $product_model_items[0];
$engine_size = $product_model_items[1];
$position = $product_model_items[2];
$vehi_attr = $product_model_items[3];
$app_size = $product_model_items[4];

$yearVal = (($year_size['lang_item_name']) && $year_size['lang_item_name']) ? $year_size['lang_item_name'] : $year_size['item_name'];
$engineSizeVal = (($engine_size['lang_item_name']) && $engine_size['lang_item_name']) ? $engine_size['lang_item_name'] : $engine_size['item_name'];
$positionVal = (($position['lang_item_name']) && $position['lang_item_name']) ? $position['lang_item_name'] : $position['item_name'];
$vehiclAttrVal = (($vehi_attr['lang_item_name']) && $vehi_attr['lang_item_name']) ? $vehi_attr['lang_item_name'] : $vehi_attr['item_name'];
$appSizeVal = (($app_size['lang_item_name']) && $app_size['lang_item_name']) ? $app_size['lang_item_name'] : $app_size['item_name'];

foreach ($model_info as $key => $model) { ?>

	<div class="controls model_<?= $model['maker_id']; ?>  modelcat_<?= $model['vehicle_category_id']; ?>" style="width: 100%;">

		<?php
		$head_name = $model['category_name'] . " : " . $model['maker_name'];
		if (!in_array($head_name, $cat_array)) { ?>
			<h4><?php echo $cat_array[] = $head_name; ?></h4>
		<?php } ?>
		<input type="checkbox" name="model_id[]" value="<?= $model['id']; ?>" class="catcheck_<?= $model['vehicle_category_id']; ?> makercheck_<?= $model['maker_id']; ?> chk" />&nbsp; &nbsp;<?= $model['model_name']; ?>
		<div class="product_model_field_display item_model_<?= $model['id']; ?> displaynon" style="border-bottom: 1px solid #eaeaea;">
			<?php if (count($product_model_items) > 0) { ?>
				<div class="manufactingYearblock control-group panel_<?= $model['id']; ?>_<?= $model['maker_id']; ?>">
					<button type="button" id="dropdown_<?= $model['id']; ?>_<?= $model['maker_id']; ?>" class="btn btn-success addManufactureYear"><?= $general_instruction['add_years']['front']; ?></button>
					<div class="moreModel model_<?= $model['id']; ?>_<?= $model['maker_id']; ?>">
						<div class="yearSelectionDiv" id="yearSelect">
							<div class="yearSelectionLeft">
								<label class="m-0" for="year"><?php echo $yearVal; ?> </label>
								<!-- <select name="model_item[year_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" class="model_year_<?= $model['id']; ?>_<?= $model['maker_id']; ?> mx-3">
									<option value="0" selected>Select year</option>
									<option value="All"><?= $general_instruction['label_all']['front']; ?></option>
									<?php for ($y = 1946; $y <= date('Y'); $y++) {?>
										<option value="<?= $y; ?>"><?= $y; ?></option>
										<?php } ?>
								</select> -->
								<input type="text" name="model_item[year_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" class="model_year_<?= $model['id']; ?>_<?= $model['maker_id']; ?> mx-3 change_input" >
								<button type="button" class="add_engine_<?= $model['id']; ?>_<?= $model['maker_id']; ?> btn btn-primary"><?php  echo $general_instruction['add_more_engies']['front']; ?></button>
							</div>
							<button type="button" class="btn btn-danger remove_field"><?php  echo $general_instruction['delete_attributes']['front']; ?></button>
						</div>
						<div class="engineBlock engine_<?= $model['id']; ?>_<?= $model['maker_id']; ?>">
							<div class="engineBlockHead">
								<h5><?= $general_instruction['add_attributes']['front']; ?></h5>
								<a href="Javsascript:void(0)" class="deleteEngine">&times;</a>
							</div>
							<div class="engineFldsblock">
								<div class="engineFlds">
									<label for=""><?php  echo $engineSizeVal; ?></label>
									<input type="text" name="model_item[][engine_size_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" class="focustip span12">
								</div>
								<div class="engineFlds">
									<label for=""><?php echo $positionVal; ?> </label>
									<input type="text" name="model_item[][position_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" class="focustip span12">
								</div>
								<div class="engineFlds">
									<label for=""> <?php echo $appSizeVal; ?> </label>
									<input type="text" name="model_item[][application_notes_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" class="focustip span12">
								</div>
								<div class="engineFlds">
									<label for=""> <?php echo $vehiclAttrVal; ?> </label>
									<input type="text" name="model_item[][vehicle_atr_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" class="focustip span12">
								</div>
							</div>
						</div>
					</div>
				</div>


				<script>
					$(document).ready(function() {
						// Javsascript function for repeating the outer panel on the click of 'Add Manufacturing Year Button'
						var id = "dropdown_<?= $model['id']; ?>_<?= $model['maker_id']; ?>";
						var appendYearWrapper = $(".manufactingYearblock.control-group.panel_<?= $model['id']; ?>_<?= $model['maker_id']; ?>");
						var addYearPanel = $("button#" + id);

						$(addYearPanel).click(function(e) { //on add input button click
							e.preventDefault();
							// var html = '<div class="moreModel model_<?= $model['id']; ?>_<?= $model['maker_id']; ?>"><div class="yearSelectionDiv" id="yearSelect"><div class="yearSelectionLeft"><label class="m-0" for="year">Year</label><select name="model_item[year_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]"  class="model_year_<?= $model['id']; ?>_<?= $model['maker_id']; ?> mx-3"><option value="0" selected>Select year</option><option value="All"><?= $general_instruction['label_all']['front']; ?></option><?php for ($y = 1946; $y <= date('Y'); $y++) { ?><option value="<?= $y; ?>"><?= $y; ?></option><?php } ?></select><button type="button" class="add_engine_<?= $model['id']; ?>_<?= $model['maker_id']; ?> btn btn-primary">Add More Engines</button></div><button class="btn btn-danger remove_field">Delete</button></div><div class="engineBlock" id="addEngineBlock"><div class="engineBlockHead"><h5 >Add Attributes</h5><a href="#" class="deleteEngine">&times;</a></div><div class="engineFldsblock"><div class="engineFlds"><label for="">Engine Size/ Type</label><input type="text" name="model_item[][engine_size_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" class="focustip span12"></div><div class="engineFlds"><label for="">Position </label><input type="text" name="model_item[][position_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" class="focustip span12"></div><div class="engineFlds"><label for="">Application Notes </label><input name="model_item[][application_notes_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" type="text" class="focustip span12"></div><div class="engineFlds"><label for="">Vehicle Attributes</label><input name="model_item[][vehicle_atr_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" type="text" class="focustip span12"></div></div></div></div>';
							
							var html = '<div class="moreModel model_<?= $model['id']; ?>_<?= $model['maker_id']; ?>"><div class="yearSelectionDiv" id="yearSelect"><div class="yearSelectionLeft"><label class="m-0" for="year"><?php echo $yearVal; ?></label><input type="text" name="model_item[year_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" class="model_year_<?= $model['id']; ?>_<?= $model['maker_id']; ?> mx-3  change_input"><button type="button" class="add_engine_<?= $model['id']; ?>_<?= $model['maker_id']; ?> btn btn-primary"><?php  echo $general_instruction['add_more_engies']['front']; ?></button></div><button class="btn btn-danger remove_field"><?php  echo $general_instruction['delete_attributes']['front']; ?></button></div><div class="engineBlock" id="addEngineBlock"><div class="engineBlockHead"><h5 ><?php  echo $general_instruction['add_more_engies']['front']; ?></h5><a href="#" class="deleteEngine">&times;</a></div><div class="engineFldsblock"><div class="engineFlds"><label for=""><?php  echo $engineSizeVal; ?></label><input type="text" name="model_item[][engine_size_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" class="focustip span12"></div><div class="engineFlds"><label for=""><?php echo $positionVal; ?> </label><input type="text" name="model_item[][position_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" class="focustip span12"></div><div class="engineFlds"><label for=""><?php echo $appSizeVal; ?> </label><input name="model_item[][application_notes_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" type="text" class="focustip span12"></div><div class="engineFlds"><label for=""><?php echo $vehiclAttrVal; ?></label><input name="model_item[][vehicle_atr_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" type="text" class="focustip span12"></div></div></div></div>';
							$(appendYearWrapper).append(html);
							resetModelYear('<?php echo $model['id'] . '_' . $model['maker_id']; ?>');
						});
						// Ends

						// Javsascript function for deleting the particular YEAR outer panel on the resepctive GREEN BUTTON CLICK

						$(appendYearWrapper).on("click", ".remove_field", function(e) {
							e.preventDefault();
							$(this).parent().parent('div').remove();
							resetModelYear('<?php echo $model['id'] . '_' . $model['maker_id']; ?>');
						});

						// Ends

						// Javsascript function for repeating the inner i.e Engines panel on the click of 'Add More Engines Button'
						var idE = "add_engine_<?= $model['id']; ?>_<?= $model['maker_id']; ?>";
						var appendEngineWrapper = $(".moreModel.model_<?= $model['id']; ?>_<?= $model['maker_id']; ?>");
						var addEnginePanel = $("button." + idE);

						$(document).on('click', "button." + idE, function(e) {
							e.preventDefault();
							var htmlE = '<div class="engineBlock engine_<?= $model['id']; ?>_<?= $model['maker_id']; ?>"><div class="engineBlockHead"><h5 ><?= $general_instruction['add_attributes']['front']; ?></h5><a href="Javsascript:void(0)" class="deleteEngine">&times;</a></div><div class="engineFldsblock"><div class="engineFlds"><label for=""><?php  echo $engineSizeVal; ?></label><input name="model_item[][engine_size_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" type="text" class="focustip span12"></div><div class="engineFlds"><label for=""><?php echo $positionVal; ?> </label><input name="model_item[][position_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" type="text" class="focustip span12"></div><div class="engineFlds"><label for=""><?php echo $appSizeVal; ?> </label><input name="model_item[][application_notes_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" type="text" class="focustip span12"></div><div class="engineFlds"><label for=""><?php echo $vehiclAttrVal; ?></label><input name="model_item[][vehicle_atr_<?php echo $model['id'] . '_' . $model['maker_id']; ?>][]" type="text" class="focustip span12"></div></div></div>';

							// $(this).parent().parent().parent().addClass('123456789');

							$(this).parent().parent().parent().append(htmlE);
							resetModelYear('<?php echo $model['id'] . '_' . $model['maker_id']; ?>');

							$(this).parent().find('.model_year_<?= $model['id']; ?>_<?= $model['maker_id']; ?>').trigger('change');
						});
						// Ends

						// Javsascript function for deleting the particular ENGINE inner panel on the resepctive CROSS BUTTON CLICK

						$(document).on('click', ".deleteEngine", function(e) {
							e.preventDefault();
							$(this).parent().parent('div').remove();
							resetModelYear('<?php echo $model['id'] . '_' . $model['maker_id']; ?>');
						});

						// Ends

						var selector = 'model_year_<?= $model['id']; ?>_<?= $model['maker_id']; ?>';

						$(document).on('change', '.' + selector + '.mx-3', function() {
							var selectedYear = $(this).val();
							$(this).parent().parent().parent().find('.engineFlds input').addClass('cl_' + $(this).val());

							var inputSelector = $(this).parent().parent().parent().find('.engineFlds input');

							$(inputSelector).each(function() {
								var attrName = $(this).attr('name');
								attrName = attrName.split('[');
								attrName = attrName[2];
								attrName = attrName.replace(']', '');
								var newAttrName = 'model_item[' + selectedYear + '_<?= $model['id']; ?>_<?= $model['maker_id']; ?>][' + attrName + '][]';

								$(this).attr('name', newAttrName);
							});

						});
					});
				</script>

				<!--<?php foreach ($model_product_items as $pitem) { ?>
	            <div class="control-group" id="item_<?php echo $model['id'] . '_' . $pitem['id']; ?>" style="padding-top: 0px !important; border-bottom:none;">
	                <label class="control-label"><?php if (isset($pitem['lang_item_name']) && $pitem['lang_item_name'] != '') {
														echo $pitem['lang_item_name'];
													} else {
														echo $pitem['item_name'];
													}  ?>:</label>
	                <div class="controls">
	                    <?php if ($pitem['field_type'] == 'image') { ?>
	                        <input name="<?php echo $model['id'] . '_' . $pitem['id']; ?>" class="focustip span12" type="file" disabled>
	                        <?php if (isset($product_model_itemr[$pitem['id']][$model['id']]) && $product_model_itemr[$pitem['id']][$model['id']] != "") {
								$src = './assets/uploads/product_images/' . $product_model_itemr[$pitem['id']][$model['id']][0]; ?>
	                            <img id="modelimg_prvw<?php echo $pitem['id']; ?>" src="<?php echo $src; ?>" alt=" image preview" class="modelimgpreviewbox"/>
	                            <div id="modelimg_prvw<?php echo $pitem['id']; ?>_delete" class="margintop-10px">
	                                <input type="button" class="focustip nopadding" value="Delete Image" onclick="removeimg('modelimg_prvw<?php echo $pitem['id']; ?>');">
	                            </div>
	                        <?php } else {
								$src = $noimage; ?>
	                            <img id="modelimg_prvw<?php echo $pitem['id']; ?>" src="<?php echo $src; ?>" alt="image preview" class="modelimgpreviewbox"/>
	                            <div id="modelimg_prvw<?php echo $pitem['id']; ?>_delete" class="margintop-10px"></div>
	                        <?php } ?>
	                    <?php } else if ($pitem['field_type'] == 'dropdown') { ?>
	                        <input type="hidden" name="product_item[<?php echo $model['id'] . '_' . $pitem['id']; ?>][field_type]" value="dropdown" disabled class="focustip span12"/>

	                        <input type="hidden" name="product_item[<?php echo $model['id'] . '_' . $pitem['id']; ?>][maker_id]" value="<?php echo $model['maker_id']; ?>">
	                                                                             
	                        <div class="input_fields_wrap" id="dropdown_<?php echo $model['id'] . '_' . $pitem['id']; ?>" >
	                            <button class="add_field_button btn btn-success drop_year" style="margin-bottom:15px;" data-id="<?php echo $model['id'] . '_' . $pitem['id']; ?>">Add More Fields</button>
	                            <?php if (isset($product_model_itemr[$pitem['id']][$model['id']][2]) && count($product_model_itemr[$pitem['id']][$model['id']][2]) > 0) { ?>
	                                <?php foreach ($product_model_itemr[$pitem['id']][$model['id']][2] as $key => $pitemdropdwon) { ?>
	                                    <div style="padding-bottom:15px;">
	                                        <?php if ($pitem['id'] == 1) { ?>
	                                            <select name="product_item[<?php echo $model['id'] . '_' . $pitem['id']; ?>][]" class="focustip span12 default_drop drop_<?php echo $model['id'] . '_' . $pitem['id']; ?>" <?php if ($pitem['required_attribute'] == 1) {
																																																								echo 'required';
																																																							} ?> data-id="<?php echo $model['id'] . '_' . $pitem['id']; ?>">
	                                                <option value="">Select any one</option>
	                                                <?php for ($y = 1946; $y <= date('Y'); $y++) { ?>
	                                                    <option value="<?= $y; ?>"><?= $y; ?></option>
	                                                <?php } ?>
	                                            </select>
	                                        <?php } else { ?>
	                                            <input name="product_item[<?php echo $model['id'] . '_' . $pitem['id']; ?>][]" class="focustip span12" type="text" value="" <?php if ($pitem['required_attribute'] == 1) {
																																												echo 'required';
																																											} ?>/>
	                                        <?php } ?>
	                                        <a href="#" class="remove_field">Remove</a>
	                                    </div>
	                                <?php } ?>
	                            <?php } ?>
	                        </div>
	                   
	                        <script>
	                             $(document).ready(function() {
	                                var id = "dropdown_<?php echo $model['id'] . '_' . $pitem['id']; ?>";
	                                var wrapper = $("#" + id); //Fields wrapper
	                                var add_button = $("#" + id + " .add_field_button"); //Add button ID

	                                var x = 1; //initlal text box count
	                                $(add_button).click(function(e){ //on add input button click
	                                    e.preventDefault();
	                                    var html = '<div style="padding-bottom:15px;">';
	                                    <?php if ($pitem['id'] == 1) { ?>
	                                        html += '<select name="product_item[<?php echo $model['id'] . '_' . $pitem['id']; ?>][]" class="focustip span12 default_drop drop_<?php echo $model['id'] . '_' . $pitem['id']; ?>" <?php if ($pitem['required_attribute'] == 1) {
																																																									echo 'required';
																																																								} ?> data-id="<?php echo $model['id'] . '_' . $pitem['id']; ?>"><option value="">Select any one</option><?php for ($y = 1946; $y <= date('Y'); $y++) { ?><option value="<?= $y; ?>"><?= $y; ?></option><?php } ?>
	                                        </select>';
	                                    <?php } else { ?>
	                                        html += '<input name="product_item[<?php echo $model['id'] . '_' . $pitem['id']; ?>][]" class="focustip span12" type="text" value="" <?php if ($pitem['required_attribute'] == 1) {
																																														echo 'required';
																																													} ?> />';
	                                    <?php } ?>
	                                    html += '<a href="#" class="remove_field">Remove</a></div>';
	                                    $(wrapper).append(html); //add input box
	                                    resetYear('<?php echo $model['id'] . '_' . $pitem['id']; ?>');
	                                });

	                                $(wrapper).on("click",".add_more_engies", function(e){ //user click on remove text
	                                    e.preventDefault(); $(this).parent('div').remove(); x--;
	                                    resetYear('<?php echo $model['id'] . '_' . $pitem['id']; ?>');
	                                });
	                            });
	                        </script>
	                    <?php } else { ?>
	                        <input id="<?php echo $model['id'] . '_' . $pitem['id']; ?>" name="product_item[<?php echo $model['id'] . '_' . $pitem['id']; ?>]" class="focustip span12" type="text" value="<?php if (isset($product_model_itemr[$pitem['id']][$model['id']][1]) && $product_model_itemr[$pitem['id']][$model['id']][1] != '') {
																																																				echo $product_model_itemr[$pitem['id']][$model['id']][1];
																																																			} else if (isset($product_model_itemr[$pitem['id']][$model['id']][0])) {
																																																				echo $product_model_itemr[$pitem['id']][$model['id']][0];
																																																			} ?>" disabled <?php if ($pitem['required_attribute'] == 1) {
								
																																																				echo 'required';
																																																					} ?>>
	                        <?php if ($pitem['multi_language'] == 1) { ?>
	                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $pitem['id']; ?>/tbl_product_item_relation_country/value" class="fancybox multi_language_edit admin_globe">
	                                <img src="assets/uploads/global.jpg" height="20" width="20" >
	                            </a>
	                        <?php } ?>
	                    <?php } ?>
	                </div>
	            </div>
	        <?php } ?>-->

			<?php } ?>
		</div>

	</div>


<?php } ?>