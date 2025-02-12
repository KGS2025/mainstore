<div class="modal fade" id="modal_success">
    <div class="modal-dialog modal-dialog-centered text-center">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <h5 class="title-modal"><?php echo $cart_instruction->thankyou_entry_door; ?></h5>
                    <p><?php echo $cart_instruction->entry_door_confirm_text; ?></p>
                    <div class="btn-modal text-center mt-3">
                       <?php if ($lang_id == 'ar') { ?>
                            <a href="javascript:void(0)" onClick="$('#modal_success').modal('hide');window.location.href = ' <?php echo base_url() . $lang_id . '/' . ((isset($on_success_redirection) and !empty($on_success_redirection)) ? $on_success_redirection : 'products'); ?>'" class="btn  actn-btn rounded"><i class="fa fa-angle-left"></i><?php echo $general_instruction->ok; ?> </a>
                       <?php } else { ?>
                            <a href="javascript:void(0)" onClick="$('#modal_success').modal('hide');window.location.href = ' <?php echo base_url() . $lang_id . '/' . ((isset($on_success_redirection) and !empty($on_success_redirection)) ? $on_success_redirection : 'products') ?>'" class="btn  actn-btn rounded"><?php echo $general_instruction->ok; ?> <i class="fa fa-angle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>