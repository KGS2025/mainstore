<div class="modal fade" id="main_cart_block_box">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body text-center">
            <div class="box-content-modal">
               <div class="blockElementWrap">
                  <div class="blockMsglogo">
                     <?php if (isset($all_data['logo']) && $all_data['logo'] != '') {
                        $logo = global_img_link($all_data['logo'], 'uploads/logo/thumbnails/'); ?>
                        <img src="<?php echo $logo; ?>" alt="logo" />
                     <?php } else { ?>
                        <img src="<?php echo base_url('assets/frontend/images/logo.png'); ?>" alt="logo" />
                     <?php } ?>
                  </div>
                  <?php
                  $session_data  = $this->session->userdata('cart_users_data');
                  $email         = isset($session_data['email'])? $session_data['email'] :""; 
                  $telephone     = isset($session_data['telephone']) ? $session_data['email'] :""; 
                  $country_code  = isset($session_data['country_code']) ? $session_data['email'] : "";
                  ?>
                  <div class="blockMsg" id="blockMsg_main_cart">
                     <?php if (isset($selection_instruction->maincart_block_msg)){
                        $maincart_block_msg = $selection_instruction->maincart_block_msg;
                        $maincart_block_msg = str_replace('BLOCKTIMEVAR',$cart_timer->cart_block_timer,$maincart_block_msg);
                        $maincart_block_msg = str_replace('EMAILVAR',$email,$maincart_block_msg);
                        $maincart_block_msg = str_replace('SMSVAR','+'.$country_code.$telephone,$maincart_block_msg);
                        echo $maincart_block_msg;
                     }?>
                  </div>
               </div>
               <div class="btn-modal">
                  <div class="row">
                     <div class="col-md-12 col-xs-12 text-center mt-3">
                        <?php if ($lang_id == 'ar') { ?>
                           <a href="javascript:void(0)" onClick="$('#main_cart_block_box').modal('hide'); window.location.href = '<?php echo base_url(); ?>payment/clear_user_session'" class="btn btn-primary btn-sm px-3 py-2 rounded" id="block_confirm_msg2"> <i class="fa fa-angle-left"></i><?php echo $general_instruction->ok; ?>
                           </a>
                        <?php } else { ?>
                           <a href="javascript:void(0)" onClick="$('#main_cart_block_box').modal('hide'); window.location.href = ' <?php echo base_url(); ?>payment/clear_user_session'" class="btn btn-primary btn-sm px-3 py-2 rounded" id="block_confirm_msg2"><?php echo $general_instruction->ok; ?> <i class="fa fa-angle-right"></i></a>
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
</div>