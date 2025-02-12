<?php
if ($last_inserted_cart_block_id && !empty($current_cart_user_data)) {

    if ($edit_cart_mode == 1){
        $bal_time = time() - $current_cart_user_data['created_time'];
        $bal_count_time = $cart_timer->main_cart_timer * 60 - $bal_time;
    } else {
        $bal_count_time = $cart_timer->cart_edit_timer * 60;
    }

    ?>
    <input type="hidden" id="bal_count_time" value="<?php echo $bal_count_time; ?>">
    <input type="hidden" id="edit_cart_mode" value="<?php echo $edit_cart_mode; ?>">
<?php } ?>

<?php $cartCount = getcartcount($this->session->userdata('cart')); ?>

<!-- this might happen when user was in another page and then time has ended. then after that if he comes in cart then he will get this message. -->
<!--Modal shopping decision cart-->
<div class="modal fade" id="user_timeout_cart">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="box-content-modal">
                    <div class="blockElementWrap">
                        <?php
                        $session_data = $this->session->userdata('cart_users_data');
                        $email          = isset($sessiondata['email']) ? $sessiondata['email'] : '';
                        $telephone      = isset($sessiondata['telephone']) ? $sessiondata['telephone'] : '';
                        $country_code   = isset($sessiondata['country_code']) ? $sessiondata['country_code'] : '';
                        ?>
                        <div class="blockMsg" id="blockMsg2">
                            <?php if (isset($selection_instruction->maincart_block_msg)){
                                $maincart_block_msg = $selection_instruction->maincart_block_msg;
                                $maincart_block_msg = str_replace('BLOCKTIMEVAR',$cart_timer->cart_block_timer,$maincart_block_msg);
                                $maincart_block_msg = str_replace('EMAILVAR',$email,$maincart_block_msg);
                                $maincart_block_msg = str_replace('SMSVAR','+'.$country_code.$telephone,$maincart_block_msg);
                                echo $maincart_block_msg;
                            }?>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <div class="row">

                            <div class="col-md-12 col-xs-12 text-right">
                                
                                        
                                <?php if ($lang_id == 'ar') { ?>
                            <a href="javascript:void(0)" onClick="
                                    window.location.href = ' <?php echo base_url(); ?>cart/make_user_block';"
                                   class="btn btn-primary nopadding" id="block_confirm_msg"><i
                                        class="fa fa-angle-left"></i><?php echo $general_instruction->ok; ?> </a>
                        <?php } else { ?>
                            <a href="javascript:void(0)" onClick="
                                    window.location.href = ' <?php echo base_url(); ?>cart/make_user_block';"
                                   class="btn btn-primary nopadding" id="block_confirm_msg"><?php echo $general_instruction->ok; ?> <i
                                        class="fa fa-angle-right"></i></a>
                        <?php } ?>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
