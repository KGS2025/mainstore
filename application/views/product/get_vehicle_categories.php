<?php 
$comingsoon = getNoImage('coming-soon');
foreach ($vehicle_categories as $vehicle) {
                                if ($vehicle['status'] == "1") { ?>
                                    <?php if (empty($vehicle_category_ids) || (!empty($vehicle_category_ids) && in_array($vehicle['id'], $vehicle_category_ids))) { ?>
                                        <div class="ProductBlock" style="margin-bottom: 20px;">
                                            <div class="VehicleBlockItems h-float">
                                                <div class="pro-item vehicle_category_image_wrap step1 <?php if (in_array($vehicle['id'], $vehicle_category_ids)) {
                                                                                                            echo 'boarder_2_red';
                                                                                                        } ?>">
                                                    <div class="overflowhidden">
                                                        <a href="javascript:void(0);" class="product_image_wrap" data-rel="<?php echo $vehicle['id']; ?>">
                                                            <?php if (isset($vehicle['VehicleType_Photo']) && $vehicle['VehicleType_Photo'] != '' && file_exists("assets/uploads/vehicle_categories/" . $vehicle['VehicleType_Photo'])) { ?>
                                                                <img src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo asset_url(); ?>assets/uploads/vehicle_categories/<?php echo $vehicle['VehicleType_Photo']; ?>" class="img-responsive" alt="image-<?php echo $vehicle['category_name']; ?>" id="image_id_<?php echo $vehicle['id']; ?>" />
                                                            <?php } else { ?>
                                                                <img src="<?= $this->session->userdata('default_image'); ?>" data-img="<?php echo $comingsoon; ?>" alt="coming soon" class="img-responsive" id="image_id_<?php echo $vehicle['id']; ?>" />
                                                            <?php } ?>
                                                        </a>
                                                        <input type="hidden" name="vehicle_category_id[]" value="<?php if (in_array($vehicle['id'], $vehicle_category_ids)) {
                                                                                                                        echo $vehicle['id'];
                                                                                                                    } ?>" class="vehicle_category_id">
                                                    </div> 
                                                    <a href="javascript:void(0);" class="btn  actn-btn"><?php echo $vehicle['lang_category_name'] ? $vehicle['lang_category_name'] : $vehicle['category_name']; 
                                                                                                        if (!empty($vehicle['name'])) { ?> <span class="element_desc"> (<?php echo $vehicle['lang_name'] ? $vehicle['lang_name'] : $vehicle['name']; ?> ) <?php } ?> </span></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>