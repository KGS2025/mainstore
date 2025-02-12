
<div class="AllProducts">
<?php if(count($makers_list) > 0){?>
    <?php foreach ($makers_list as $maker) {
        $category_id = explode(',',$maker['vehicle_category_id'])[0];?>
        <div class="ProductBlock">
            <div class="pro-item product_type_image_wrap brand_type_image_wrap maker_row product_type_image_wrap1 singlestep">
                <div class="height180px">
                    <a href="<?php echo ($disable_multiselect?base_url().'products/maker_details/'.$maker['id']:'javascript:void(0);');?>" class="product_image_wrap"
                       data-rel="<?php echo $maker['id'] . '#' . $category_id; ?>">
                        <?php if (isset($maker['maker_logo']) && $maker['maker_logo'] != '' && file_exists("assets/uploads/product_maker/" . $maker['maker_logo'])) { ?>
                            <img src="<?= $this->session->userdata('default_image');?>" alt="" data-img="<?php echo asset_url();?>assets/uploads/product_maker/<?php echo $maker['maker_logo']; ?>" class="img-responsive img-pad" />
                        <?php } else { ?>
                            <img src="<?= $this->session->userdata('default_image');?>" data-img="<?php echo getNoImage(); ?>" alt="coming soon" class="img-responsive" />
                        <?php } ?>

                    </a>
                    <input type="hidden" name="maker_id[]" value="" class="vehicle_type_id makercheck_<?php echo $category_id; ?>">
                </div>
	    </div>
	    <div class="pro-item-title">
                <a href="<?php echo ($disable_multiselect?base_url().'products/maker_details/'.$maker['id']:'javascript:void(0);');?>" class="btn  actn-btn"><?php echo $maker['lang_maker_name'] ? $maker['lang_maker_name'] : $maker['maker_name']; ?></a>
            </div> 
        </div>
    <?php } ?>
<?php } ?>
</div>
