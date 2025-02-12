<div class="my-account-area py-3 py-sm-5">
    <div class="container">
        <div class="row">
            <!-- user dahboard sidebar-->
            <?php $this->load->view('elements/userdashboard-sidebar'); ?>

            <div class="col-12 col-md-9">
                <div class="my-account-content mb-50 h-100">
                    <div class="paymentCardDetails">
                        <?php if (count($user_cards) < 3) { ?>
                            <a href="<?php echo base_url() . $lang_id . '/'; ?>user/addcard" class="btn actn-btn rounded border-none addCard"><?php echo $payment_instructions->add_card_btn_text; ?></a>
                        <?php }  ?>
                        <div class="table-responsive mt-3">
                            <table class="table w-100 border">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th><?php echo $payment_instructions->card_label_cardid; ?></th>
                                        <th><?php echo $payment_instructions->card_label_cardbrand; ?></th>
                                        <th><?php echo $payment_instructions->card_number; ?></th>
                                        <th><?php echo $payment_instructions->expiry; ?></th>
                                        <th><?php echo $payment_instructions->card_label_cardaction; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user_cards as $card) {  ?>
                                        <tr>
                                            <td>
                                                <div class="form-check position-relative p-0 m-0">
                                                    <input class="form-check-input filter_option" type="radio" name="user_cards" value="<?php echo $card['id']; ?>">
                                                    <label class="form-check-label" for="radio1">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td><?php echo $card['card_id']; ?> </td>
                                            <td><?php echo $card['card_brand']; ?></td>
                                            <td> **************<?php echo $card['last_4']; ?></td>
                                            <td><?php echo $card['exp_month']; ?>/<?php echo $card['exp_year']; ?></td>
                                            <td>
                                                <a href="<?php echo base_url() . $lang_id . '/'; ?>user/deletecard/<?php echo $card['id']; ?> " title="Delete" class="deletebtn delete_card fs-4"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center py-5">
                <h3 class="modal-title" id="confirmationModalLabel"><?php echo $payment_instructions->delete_card_pop; ?></h3>
                <p><?php echo $payment_instructions->delete_card_pop_ques; ?></p>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $payment_instructions->delete_card_no; ?></button>
                <a href="" class="delete_card_yes btn actn-btn"><?php echo $payment_instructions->delete_card_yes; ?></a>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('elements/flash_messages'); ?>

<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">
