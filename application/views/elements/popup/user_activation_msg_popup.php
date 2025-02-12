<div class="modal fade" id="user_activation_modal">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-body text-center py-5">
            <div class="box-content-modal">
               <h5 class="title-modal kgt42"><?php echo $general_instruction->user_activation_msg; ?></h5>
               <div class="btn-modal toyota-page">
                  <div class="row">
                     <div class="col-md-12">
                        <?php if ($lang_id == 'ar') { ?>
                        <a href="<?php echo base_url() . $lang_id . '/'; ?>user/login" class="btn btn-primary btn-sm rounded px-3 py-2"> <i class="fa fa-angle-left"></i><?php echo $general_instruction->ok; ?></a>
                        <?php } else { ?>
                        <a href="<?php echo base_url() . $lang_id . '/'; ?>user/login" class="btn btn-primary btn-sm rounded px-3 py-2"><?php echo $general_instruction->ok; ?> <i class="fa fa-angle-right"></i></a>
                        <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- /.modal-content -->
</div>