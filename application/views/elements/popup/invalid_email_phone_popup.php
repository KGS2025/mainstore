<div class="modal fade" id="invalid-email-phone">
   <div class="modal-dialog  modal-dialog-centered text-center">
      <div class="modal-content">
         <div class="modal-body">
            <div class="box-content-modal">
               <h5 class="title-modal kgt42"><?php echo $emailsmsinvalid_message; ?></h5>
               <div class="btn-modal toyota-page">
                  <div class="row">
                     <div class="col-md-12">
                        <?php if ($lang_id == 'ar') { ?>
                        <a href="<?php echo base_url() . $lang_id . '/'; ?>cart/edittocart" class="btn btn-primary"><i class="fa fa-angle-left"></i><?php echo $general_instruction->edit; ?></a>
                        <?php } else { ?>
                        <a href="<?php echo base_url() . $lang_id . '/'; ?>cart/edittocart" class="btn btn-primary"><?php echo $general_instruction->edit; ?><i class="fa fa-angle-right"></i></a>
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