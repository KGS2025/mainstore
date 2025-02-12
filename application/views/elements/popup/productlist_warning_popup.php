<!--Modal Custom warning-->
<div class="modal fade" id="hideproductlistwarning" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <h4 id="hideproductlistwarning_title" class="title-modal ">
                        <span class="blink"> <?php echo $selection_instruction->selection_popup_header; ?> </span>
                    </h4>
                    <p id="hideproductlistwarning_msg"><?php echo $selection_instruction->selection_popup_body; ?></p>
                    <div class="btn-modal">
                        <?php if ($lang_id == 'ar') { ?>
                            <a href="<?php echo base_url() . $lang_id . '/' . 'user/login'; ?>" onClick="$('#hideproductlistwarning').modal('hide');"
                               class="px-3 py-2 btn btn-primary"><i
                                    class="fa fa-angle-left"></i> <?php echo $general_instruction->ok; ?> </a>
                            <?php } else { ?>
                            <a href="<?php echo base_url() . $lang_id . '/' . 'user/login'; ?>" onClick="$('#hideproductlistwarning').modal('hide');"
                               class="px-3 py-2 btn btn-primary"><?php echo $general_instruction->ok; ?> <i
                                    class="fa fa-angle-right"></i></a>
                            <?php } ?>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--Modal Custom warning ends-->