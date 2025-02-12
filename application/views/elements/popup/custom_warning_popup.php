<div class="modal fade" id="customwarning" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <h4 id="customwarning_msg_title" class="title-modal">
                        <span class="blink"> <?php echo $selection_instruction->selection_popup_header; ?> </span>
                    </h4> 
                    <p id="customwarning_msg"><?php echo $selection_instruction->selection_popup_body; ?></p>   
                    <div class="btn-modal">   
                        <?php if ($lang_id == 'ar') { ?>
                            <a href="javascript:void(0)" onClick="$('#customwarning').modal('hide');" class="rounded px-3 py-2 btn btn-primary my-2"><i class="fa fa-angle-left"></i> <?php echo $general_instruction->ok; ?> </a>
                        <?php } else { ?>
                            <a href="javascript:void(0)" onClick="$('#customwarning').modal('hide');" class="rounded px-3 py-2 btn btn-primary my-2"><?php echo $general_instruction->ok; ?> <i class="fa fa-angle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->