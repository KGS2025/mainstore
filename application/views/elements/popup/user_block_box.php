<div class="modal fade" id="user_block_box">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
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
                        <div class="blockMsg" id="blockMsg"><?php echo lang('You Have Been Blocked.') ?> <br> <?php echo lang('Please Try After 120 minutes.') ?></div>
                        <div id="edit_cart_mode_on" class="displaynon"></div>
                    </div>
                    <h2 class="title-modal" id="blockMsg1"><?php echo lang('You Have Been Blocked. Please Try After 120 minutes.') ?></h2>

                    <div class="btn-modal">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 text-center">
                                <?php if ($lang_id == 'ar') { ?>
                                    <a href="javascript:void(0)" onClick="redirect_edit_mode();" class="btn btn-primary px-3 rounded" id="block_confirm_msg1"><i class="fa fa-angle-left"></i><?php echo $general_instruction->ok; ?> </a>
                                <?php } else { ?>
                                    <a href="javascript:void(0)" onClick="redirect_edit_mode();" class="btn btn-primary px-3 rounded" id="block_confirm_msg1"><?php echo $general_instruction->ok; ?> <i class="fa fa-angle-right"></i></a>
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
</div><!-- /.modal -->