<?php


if ($this->session->flashdata('flash_message')) {
    $flash_message = $this->session->flashdata('flash_message');
?>
    <?php if ($flash_message['type'] == "error") { ?>
        <div class="modal fade" id="modal_mssg">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="box-content-modal">
                            <h2 class="blink_error">Warning</h2>
                            <p><?php echo strip_tags($flash_message['message']); ?></p>
                            <div class="btn-modal">
                                <?php if ($lang_id == 'ar') { ?>
                                    <a href="javascript:void(0)" onClick="$('#modal_mssg').modal('hide');" class="floatright1 btn btn-primary rounded"><i class="fa fa-angle-left"></i>&nbsp;<?php echo $general_instruction->ok; ?>
                                    </a>
                                <?php } else { ?>
                                    <a href="javascript:void(0)" onClick="$('#modal_mssg').modal('hide');" class="floatright1 btn btn-primary rounded"><?php echo $general_instruction->ok; ?> &nbsp;<i class="fa fa-angle-right"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div><!-- /.modal -->
    <?php } ?>
    <?php if ($flash_message['type'] == "success") {
    ?>
        <div class="modal fade" id="modal_mssg">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="box-content-modal">
                            <h2>Success</h2>
                            <p><?php echo strip_tags($flash_message['message']); ?></p>
                            <div class="btn-modal">
                                <?php if ($lang_id == 'ar') { ?>
                                    <a href="javascript:void(0)" onClick="$('#modal_mssg').modal('hide');" class="floatright1 btn btn-primary rounded"><i class="fa fa-angle-left"></i>&nbsp;<?php echo $general_instruction->ok; ?>
                                    </a>
                                <?php } else { ?>
                                    <a href="javascript:void(0)" onClick="$('#modal_mssg').modal('hide');" class="floatright1 btn btn-primary rounded"><?php echo $general_instruction->ok; ?>&nbsp; <i class="fa fa-angle-right"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div><!-- /.modal -->
    <?php } ?>
<?php } ?>