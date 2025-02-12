<div class="modal fade" id="invalid-email">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body">
            <div class="box-content-modal">
               <h2 class="title-modal kgt42"><?php echo $emailinvalid_message; ?></h2>
               <div class="btn-modal toyota-page">
                  <div class="row">
                     <div class="col-md-12">
                        <?php if ($lang_id == 'ar') { ?>
                        <a href="<?php echo base_url() . $lang_id . '/'; ?>front/entry_door" class="btn btn-primary btn-sm"><i class="fa fa-angle-left"></i><?php echo $general_instruction->edit; ?></a>
                        <?php } else { ?>
                        <a href="<?php echo base_url() . $lang_id . '/'; ?>front/entry_door" class="btn btn-primary btn-sm"><?php echo $general_instruction->edit; ?><i class="fa fa-angle-right"></i></a>
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