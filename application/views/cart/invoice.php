<?php
ob_clean();
if (isset($country_data) && !empty($country_data)) {
    foreach ($country_data as $cdata) {
        if (($cdata['short_code'] == $lang_id)) {
            if (isset($cdata['coming_soon_image']) && $cdata['coming_soon_image'] != '') {
                $comingsoon = global_img_link($cdata['coming_soon_image'], 'uploads/country/coming_soon/');
            } else {
                $comingsoon = base_url() . 'assets/frontend/images/coming_soon.jpg';
            }
            if (isset($cdata['no_image']) && $cdata['no_image'] != '') {
                $noimage = global_img_link($cdata['no_image'], 'uploads/country/no_image/');
            } else {
                $noimage = base_url() . 'assets/admin/images/previewimage.jpg';
            }
        }
    }
}


if (isset($all_data['cart_photo']) && $all_data['cart_photo'] != '') {
    $cartphoto = global_img_link($all_data['cart_photo'], 'uploads/cart/');
} else {
    $cartphoto = global_img_link($all_data['logo'], 'uploads/logo/thumbnails/');
}

$businessdaysintransit = '';
$businessdaysintransit_text = '';
$deliverybytime = '';
$deliverybytime_text = '';

if (isset($cart_users_data['transit_days']) && $cart_users_data['transit_days'] != '') {
    $businessdaysintransit = $cart_users_data['transit_days'];
    $businessdaysintransit_text = $sales_order_preview['transit_days'];
}

if (isset($cart_users_data['delivery_by_time']) && $cart_users_data['delivery_by_time'] != '') {
    $deliverybytime = $cart_users_data['delivery_by_time'];
    $deliverybytime_text = $sales_order_preview['delivery_by_time'];
}
?>

<div class="varify-submit-page productlisting">
    <?php

    $completedata['view_type'] = 'invoice';
    $completedata['noimage'] = $noimage;
    $this->load->view('cart/invoice_element', $completedata);
    ?>
    <div class="nav-prex-next text-right">
        <?php if (!empty($cart_details)) { ?>
            <div class="row">
                <div class="col-md-12">
                    <?php /*
                    <?php if($all_data['invoice_download_btn_status'] == 1){?>
                        <a href="<?php echo $invoicepdfURL; ?>" class="btn  actn-btn rounded" download> <?php echo $general_instruction->download_invoice; ?> </a>
                    <?php } ?>
                    <?php if($all_data['package_download_btn_status'] == 1){?>
                        <a href="javascript:void(0);" onClick="downloadAll();" class="btn  actn-btn rounded" download> <?php echo $general_instruction->download_txt; ?> </a>
                    <?php } ?>
                    */ ?>
                    <?php if($all_data['invoice_print_btn_status'] == 1){?>
                        <a onclick="javascript:printDiv();" class="btn btn-success actn-btn rounded"><?php echo $sales_order_preview['print_text']; ?></a>
                    <?php } ?>
                    <a href="<?php echo base_url() . $lang_id . '/products'; ?>" class="btn  actn-btn rounded"><?php echo $general_instruction->continue_shopping; ?></a>
                    <?php if($this->session->userdata('new_cart')){?>
                        <a href="<?php echo base_url() . $lang_id . '/cart'; ?>" class="btn  actn-btn rounded"><?php echo $general_instruction->continue_cart; ?></a>
                    <?php }?>
                </div>
            </div>
        <?php } ?>
    </div>
    <hr style="border-top: 1px solid #000;" />
    <div class="text-right pb-3"><?php echo $all_data['copyright']; ?></div>
</div>
<?php /*
<?php $allUrls = explode(',',$packaging_pdfURL);
if(count($allUrls) > 0){
    foreach ($allUrls as $url) {?>
        <a href="<?= $url;?>" class="downloadLink" style="display: none;"></a>
    <?php } ?>
<?php } ?>
*/ ?>
</body>
<script type="text/javascript">
    var base_url         = "<?php echo base_url(); ?>";
    var base_url_lang_id = "<?php echo base_url().$lang_id.'/'; ?>";
    var lang_id          = "<?php echo $lang_id; ?>";
    var lang_num         = '<?php echo $lang_num; ?>';
    var pageType         = '<?= $pageType;?>';
</script>
<script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/jquery.js?version='.getenv('ASSET_VERSION'));?>"></script>
<script type="text/javascript"> var packaging_created = '<?php echo $packaging_created;?>';</script>
<script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/invoice.js?version='.getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-light.js?version='.getenv('ASSET_VERSION'));?>"></script>
<script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/estore-strap-wos.js?version='.getenv('ASSET_VERSION'));?>"></script>
<?php if(ENVIRONMENT == 'production'){?>
<script type="text/javascript" src="<?php echo asset_url('assets/frontend/js/store-prevent.js?version=' . $ASSET_VERSION); ?>" defer></script>
<?php } ?>
</html>