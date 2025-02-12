    <?php if(count($models) > 0){
        $comingsoon  = getNoImage('coming-soon');?>
        <?php foreach ($models as $model) { ?>
            <div class="ProductBlock">
                <div class="pro-item product_type_image_wrap product_type_image_wrap1 singlestep <?php if (in_array($model['maker_id'], $product_maker_id)) {
                        echo "boarder_2_red";
                    } ?>">
                    <div class="height180px">
                        <a href="javascript:void(0);" class="product_image_wrap" data-rel="<?php echo $model['id']; ?>">
                            <?php if (isset($model['model_photo']) && $model['model_photo'] != '' && file_exists("assets/uploads/product_model/" . $model['model_photo'])) { ?>
                                <img src="<?php echo asset_url();?>assets/uploads/product_model/<?php echo $model['model_photo']; ?>" alt=""/>
                            <?php } else { ?>
                                <img src="<?php echo $comingsoon; ?>" alt="coming soon"/>
                            <?php } ?>
                            </a>
                        <input type="hidden" name="model_id[]"
                            value="<?php  if (in_array($model['maker_id'], $product_maker_id)) {
                                echo $model['id'];
                            } ?>" class="vehicle_type_id">
                    </div>
                    <a href="javascript:void(0);" class="btn btn-primary btn-sm" aria-label="Showing the model name"><?php echo $model['model_name']; ?></a>
                </div>
            </div>
        <?php } ?>
    <?php } ?>