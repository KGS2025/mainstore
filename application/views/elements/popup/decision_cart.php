<div class="modal fade" id="decision_cart">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4 p-md-5">
                <div class="box-content-modal">
                    <h4 class="title-modal"><?php echo $selection_instruction->addtocart_popup_header; ?></h4>
                    <p id="addtocart_success_msg"><?php $product_in_cart = isset($general_instruction->product_already_in_cart) ? $general_instruction->product_already_in_cart : "";
                    echo $product_in_cart;
                    ?></p>
                    <div class="btn-modal">
                        <?php if ($lang_id == 'ar') { ?>
                            <a href="<?php echo base_url() . $lang_id . '/'; ?>products/products" class="rounded px-3 py-2 btn btn-primary my-2 add_more"><i class="fa fa-angle-left"></i><?php echo $general_instruction->continue_shopping; ?></a>
                        <?php } else { ?>
                            <a href="<?php echo base_url() . $lang_id . '/'; ?>products/products" class="rounded px-3 py-2 btn btn-primary my-2 add_more"><?php echo $general_instruction->continue_shopping; ?><i class="fa fa-angle-right ps-2"></i></a>
                        <?php } ?>

                        <?php if ($lang_id == 'ar') { ?>
                            <a href="<?php echo base_url() . $lang_id . '/'; ?>cart/cart" class="rounded px-3 py-2 btn btn-primary my-2"><i class="fa fa-angle-left"></i><?php echo $general_instruction->edit_cart; ?></a>
                        <?php } else { ?>
                            <a href="<?php echo base_url() . $lang_id . '/'; ?>cart/cart" class="rounded px-3 py-2 btn btn-primary my-2"><?php echo $general_instruction->edit_cart; ?><i class="fa fa-angle-right ps-2"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->