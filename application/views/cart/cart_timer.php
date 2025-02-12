<?php
if ($last_inserted_cart_block_id) {
    if (!empty($current_cart_user_data)) {
        $bal_time = time() - $current_cart_user_data['created_time'];
        $bal_count_time = $cart_timer->main_cart_timer * 60 - $bal_time;
        if ($edit_cart_mode == 1)
            $bal_count_time = $cart_timer->cart_edit_timer * 60 - $bal_time; ?>
        <input type="hidden" id="bal_count_time" value="<?php echo $bal_count_time; ?>">
        <input type="hidden" id="edit_cart_mode" value="<?php echo $edit_cart_mode; ?>">
        <input type="hidden" id="cart_users_data_count" value="<?php echo count($cart_users_data);?>" >
    <?php } else {
        $bal_count_time = 3600; ?>
        <input type="hidden" id="cart_timer" value="<?php echo $cart_timer->cart_edit_timer * 60; ?>">
    <?php } ?>
<?php } ?>
