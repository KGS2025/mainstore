<div class="col-12 col-md-3 userSidebar">
    <div class="my-account-navigation mb-50 h-100">
        <?php $segment = $this->uri->segment(3);?>
        <ul>
            <li class="<?php if ($segment == 'dashboard') {
    echo 'active';
}?>"><a href="<?php echo base_url() . $lang_id . '/'; ?>user/dashboard"><i class="fa fa-tachometer" aria-hidden="true"></i> <?php echo $all_titles->sidebar_dashboard; ?></a></li>
            <li class="<?php if ($segment == 'orders') {
    echo 'active';
}?>"><a href="<?php echo base_url() . $lang_id . '/'; ?>user/orders"><i class="fa fa-list-alt" aria-hidden="true"></i> <?php echo $all_titles->sidebar_orders; ?></a></li>

            <li class="<?php if ($segment == 'quotations') {
    echo 'active';
}?>"><a href="<?php echo base_url() . $lang_id . '/'; ?>user/quotations"><i class="fa fa-align-justify" aria-hidden="true"></i> <?php echo $all_titles->sidebar_quotations; ?></a></li>

<?php if ($this->config->item('limited_price_option') == "1") {?>
            <li class="<?php if ($segment == 'pricerequests' || $segment == 'addpricerequest' || $segment == 'viewrequest') {
    echo 'active';
}?>"><a href="<?php echo base_url() . $lang_id . '/'; ?>user/pricerequests"><i class="fa fa-dollar" aria-hidden="true"></i> <?php echo $all_titles->sidebar_pricerequests; ?></a></li>

<?php }?>


            <li class="<?php if ($segment == 'profile') {
    echo 'active';
}?>"><a href="<?php echo base_url() . $lang_id . '/'; ?>user/profile"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $all_titles->sidebar_profile; ?></a></li>
            <?php if ($this->config->item('payment_gateway') == 'squareup') {?>
                <li class="<?php if ($segment == 'cards') {
    echo 'active';
}?>"><a href="<?php echo base_url() . $lang_id . '/'; ?>user/cards"><i class="fa fa-credit-card" aria-hidden="true"></i> <?php echo $all_titles->sidebar_cards; ?> </a></li>
            <?php }?>
            <li class="<?php if ($segment == 'crediterm') {
    echo 'active';
}?>"><a href="<?php echo base_url() . $lang_id . '/'; ?>user/crediterm"><i class="fa fa-file" aria-hidden="true"></i> <?php echo $all_titles->sidebar_crediterm; ?> <?php if ($loginuserterm['credit_term_status'] == "1") {?> <i class="fa fa-check-circle" style="color:green;" aria-hidden="true"> </i> <?php }?>
                </a></li>

            <li><a href="<?php echo site_url('cart/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo $admin_static_links['logout']; ?></a></li>
        </ul>
    </div>
</div>