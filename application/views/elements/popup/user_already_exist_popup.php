<div class="modal fade" id="user_exist_modal">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-body text-center py-5">
            <div class="box-content-modal">
               <h5 class="title-modal kgt42"><?php echo $general_instruction->user_exist; ?></h5>
               <div class="btn-modal toyota-page">
                  <div class="row">
                     <div class="col-md-12">
                        <?php if ($lang_id == 'ar') { ?>
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm rounded px-3 py-2" onClick="$('#user_exist_modal').modal('hide');"> <i class="fa fa-angle-left"></i><?php echo $general_instruction->ok; ?></a>
                        <?php } else { ?>
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm rounded px-3 py-2" onClick="$('#user_exist_modal').modal('hide');"><?php echo $general_instruction->ok; ?> <i class="fa fa-angle-right"></i></a>
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