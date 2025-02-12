<div class="modal fade" id="modal_mssg">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <h5 id="already_added_msg_title" class="title-modal"><?php echo $general_instruction->already_added; ?></h5>
                    <p id="already_added_msg"></p>
                    <div class="btn-modal text-center">
                        <?php if($pageType != 'productlist'){?>
                            <?php if ($lang_id == 'ar') { ?>
                                <a href="javascript:void(0)" onClick="$('#modal_mssg').modal('hide');" class="btn btn-primary rounded"><i class="fa fa-angle-left"></i> &nbsp;<?php echo $general_instruction->ok; ?></a>
                            <?php } else { ?>
                                <a href="javascript:void(0)" onClick="$('#modal_mssg').modal('hide');" class="btn btn-primary rounded"><?php echo $general_instruction->ok; ?>&nbsp;<i class="fa fa-angle-right"></i></a>
                            <?php } ?>
                        <?php }else{ ?>
                            <?php if ($lang_id == 'ar') { ?>
                                <a href="javascript:void(0)" onClick="$('#modal_mssg').modal('hide'); addtocartinnotexistingproducts();" class="btn btn-primary rounded"><i class="fa fa-angle-left"></i>&nbsp;<?php echo $general_instruction->ok; ?></a>
                            <?php } else { ?>
                                <a href="javascript:void(0)" onClick="$('#modal_mssg').modal('hide'); addtocartinnotexistingproducts();" class="btn btn-primary rounded"><?php echo $general_instruction->ok; ?>&nbsp;<i class="fa fa-angle-right"></i></a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->