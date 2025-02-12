    <?php foreach ($makers as $maker) { ?>
        <?php if (empty($maker_ids) || (!empty($maker_ids) && in_array($maker['id'], $maker_ids))) { ?>
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
                    <div class="clearfix"></div>
		</div>
		<div class="pro-item-title">
		    <a href="javascript:void(0);" class="btn btn-primary btn-resize actn-btn"><?php echo $maker['lang_maker_name'] ? $maker['lang_maker_name'] : $maker['maker_name']; ?></a>
		</div>
            </div>
        <?php } ?>
    <?php } ?>
