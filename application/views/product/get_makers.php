    <?php if(count($product_maker) > 0){
        $comingsoon  = getNoImage('coming-soon');?>
        <?php foreach ($product_maker as $maker) { ?>
            <div class="ProductBlock">
                <div class="pro-item product_type_image_wrap product_type_image_wrap1 singlestep <?php if ((in_array($maker['id'], $maker_ids))) { echo 'boarder_2_red'; } ?>">
                    <div class="height180px">
                        <a href="javascript:void(0);" class="product_image_wrap" data-rel="<?php echo $maker['id']; ?>">
                            <?php if (isset($maker['maker_logo']) && $maker['maker_logo'] != '' && file_exists("assets/uploads/product_maker/" . $maker['maker_logo'])) { ?>
                                <img src="<?php echo asset_url();?>assets/uploads/product_maker/<?php echo $maker['maker_logo']; ?>" alt="" class=""/>
                            <?php } else { ?>
                                <img src="<?php echo $comingsoon; ?>" alt="coming soon"/>
                            <?php } ?>
                        </a>
                        <input type="hidden"  name="vehicle_type_id[]" value="<?php if (in_array($maker['id'], $maker_ids)) { echo $maker['id']; } ?>" class="vehicle_type_id">
                    </div>
                    <a href="javascript:void(0);" class="btn btn-primary btn-resize"><?php echo $maker['maker_name']; ?></a>
                </div>
            </div>
        <?php } ?>
    <?php } ?>