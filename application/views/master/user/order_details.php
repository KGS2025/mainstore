<div class="mainContent px-3 px-lg-5">
    <div class="container-fluid py-3 py-md-5 text-center">
        <?php



        if (isset($all_data['left_logo_status']) && $all_data['left_logo_status'] == 1) { ?>
            <?php if (isset($all_data['logo']) && $all_data['logo'] != '') {
                $logo =  asset_url() . "assets/uploads/logo/thumbnails/" . $all_data['logo']; ?>
                <a class="logo navbar-logo navbar-brand text-center d-inline-block" href="<?php echo $all_data['logo_url']; ?>" aria-label="header logo icon">
                    <img src="<?php echo $logo; ?>" alt="<?php echo isset($all_data['title']) ? $all_data['title'] : ''; ?>" class="floatleft1 m-auto float-none" />
                </a>
            <?php } else { ?>
                <a class="logo navbar-logo navbar-brand text-center d-inline-block" href="<?php echo $all_data['logo_url']; ?>" aria-label="header logo icon">
                    <img src="<?php echo asset_url('assets/uploads/logo/thumbnails/logo.png'); ?>" alt="34563456" class="floatleft1 m-auto float-none" />
                </a>
            <?php } ?>
        <?php } ?>
        <?php if (isset($all_data['right_logo_status']) && $all_data['right_logo_status'] == 1) {
            if (isset($all_data['header_image']) && $all_data['header_image'] != '') {
                $header_image = asset_url() . "assets/uploads/logo/thumbnails/" . $all_data['header_image']; ?>
                <a class="logo demon_logo_link py-3 text-center d-inline-block" href="<?php echo $all_data['header_image_url']; ?>" target="_blank" rel="noopener noreferrer" aria-label="store icon">
                    <img src="<?php echo $header_image; ?>" alt="left logo image main" class="floatleft1 m-auto float-none" />
                </a>
            <?php } ?>
        <?php } ?>
    </div>
    <div class="ct-videoSection float-start w-100 px-4 px-md-5">
        <div class="ct-services float-start w-100">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="ct-team-box p-0">
                    <div class="common-search float-start w-100 my-3">
                        <div class="text-header">
                            <?php $this->load->view('elements/search'); ?>
                        </div>
                    </div>

                    <div class="home-quick-search-wrap float-start w-100">
                        <?php $this->load->view('elements/quicksearch'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-account-area py-3 py-sm-5">
        <div class="container">
            <div class="row">
                <!-- user dahboard sidebar-->
                <?php $this->load->view('elements/userdashboard-sidebar'); ?>
                <div class="col-12 col-md-9">
                    <div class="my-account-content mb-50 h-100">
                        <div class="col-md-12 brand_complete_info">
                            <h4 class="orderHistory"> <?php echo $admin_order_details['order_details']['admin']; ?></h4>
                            <div class="UserInformation float-start w-100 bg-white rounded p-4 mb-4">
                                <h5 class="border-bottom pb-3"> <?php echo $admin_order_details['user_info_page']['admin']; ?></h5>
                                <?php

                                foreach ($main_data as $user_data) {


                                    $cart_unit_of_meas = cart_unit_of_meas($user_data->volume_unit, $user_data->weight_unit);


                                ?>
                                    <div class="col-12 float-start w-100">
                                        <div class="formGrid d-grid gap-3 grid-col-2">
                                            <div class="col"><strong><?php echo $admin_order_details['name']['admin']; ?>:</strong> <?php echo $user_data->user_name; ?></div>
                                            <div class="col"><strong><?php echo $admin_order_details['email']['admin']; ?>:</strong> <?php echo $user_data->email; ?></div>
                                            <div class="col"><strong><?php echo $admin_order_details['country']['admin']; ?>:</strong> <?php echo $user_data->country; ?></div>
                                            <div class="col"><strong><?php echo $admin_order_details['telephone']['admin']; ?>:</strong> <?php echo $user_data->telephone; ?></div>
                                            <div class="col"><strong><?php echo $admin_order_details['amount']['admin']; ?>:</strong> <?php echo $user_data->amount . ' ' . $user_data->currency; ?></div>
                                            <div class="col"><strong><?php echo $admin_order_details['amount_received']['admin']; ?>:</strong> <?php echo $user_data->amount_received . ' ' . $user_data->currency; ?>( <?php echo  round($user_data->amount_received / $user_data->amount * 100);
?>%)</div>

<?php  if ($this->config->item('partial_payment_enable') != "0") { ?>
<div class="col"><strong><?php echo $admin_order_details['amount_pending']['admin']; ?>:</strong> <?php echo $user_data->amount_pending . ' ' . $user_data->currency; ?>( <?php echo  round($user_data->amount_pending / $user_data->amount * 100);
?>%)</div>
<?php } ?>
                                            <?php if ($user_data->discount) { ?>
                                                <div class="col"><strong><?php echo $admin_order_details['discount']['admin']; ?>:</strong> <?php echo $user_data->discount . ' ' . $user_data->currency; ?></div>
                                            <?php } ?>
                                            <div class="col"><strong><?php echo $admin_order_details['order_number']['admin']; ?>:</strong> <?php echo $user_data->order_number; ?></div>
                                            <div class="col"><strong><?php echo $admin_order_details['incoterms']['admin']; ?>:</strong> <?php echo $user_data->incoterms; ?></div>
                                            <div class="col"><strong><?php echo $admin_order_details['status']['admin']; ?>:</strong> <?php echo getOrderStatus($user_data->order_status); ?></div>
                                            <?php if ($user_data->edi_one) { ?>
                                                <div class="col"><strong><?php echo $admin_order_details['edi_one']['admin']; ?>:</strong> <?php echo $user_data->edi_one; ?></div>
                                            <?php } ?>
                                            <?php if ($user_data->edi_two) { ?>
                                                <div class="col"><strong><?php echo $admin_order_details['edi_two']['admin']; ?>:</strong> <?php echo $user_data->edi_two; ?></div>
                                            <?php } ?>

                                            <?php if ($user_data->po_number) { ?>
                                            <div class="col"><strong><?php echo $admin_order_details['po_number']['admin']; ?>:</strong> <?php echo $user_data->po_number; ?></div>
                                            <?php } ?>
                                            <?php if ($user_data->po_file) { ?>

                                                <div class="col"><strong><?php echo $admin_order_details['po_file']['admin']; ?>:</strong> <a href="<?php echo base_url() . 'assets/uploads/cart/' . $user_data->po_file; ?>" class="btn actn-btn downloadButton" download> <?php echo $cart_instruction->download_file; ?> </a>
                                                </div>


                                            <?php } ?>
                                            <?php if ($user_data->payment_method == "2") { ?>
                                                <div class="col"><strong><?php echo $cart_instruction->last_payment_date; ?>:</strong> <?php echo $user_data->last_payment_date; ?></div>

                                            <?php } ?>

                                        </div>
                                    </div>
                                    <?php if ($user_data->invoiceStatus == 1) { ?>
                                        <div class="border-top w-100 pt-3 downloadsection float-start w-100">
                                            <a href="<?php echo base_url() . 'assets/uploads/invoice/Invoice_' . $user_data->invoice_number . '.pdf'; ?>" class="btn actn-btn downloadButton" download><?php echo $cart_instruction->download_file; ?> </a>
                                        </div>
                                <?php }
                                } ?>
                            </div>

                            <div class="table-responsive w-100 float-start mb-4">
                                <table class="w-100 table table-bordered my-table orderDetailsTable" style="min-width: 900px;">
                                    <thead class="text-center">
                                        <tr>
                                            <th><?php echo $admin_order_details['srno']['admin']; ?> </th>
                                            <th><?php echo $admin_order_details['kgt_ref']['admin']; ?></th>
                                            <th><?php echo $admin_order_details['order_qty']['admin']; ?></th>
                                            <th><?php echo $admin_order_details['product_type_title']['admin']; ?></th>
                                            <th><?php echo $product_instruction->unit_of_measurement; ?></th>

                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php


                                        if (isset($cart_data)) {
                                            $i = 1;
                                            foreach ($cart_data as $set_data) {

                                        ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $set_data['kgt_ref_number']; ?></td>
                                                    <td><?php echo $set_data['cart_quantity']; ?></td>
                                                    <td><?php echo $set_data['product_type_name']; ?></td>
                                                    <td><?php echo $set_data['unit_of_measurement']; ?></td>
                                                    <td style="font-size:22px;" class="showHideDetails" data-bs-toggle="collapse" href="#detailView<?php echo $i; ?>" role="button" aria-expanded="false" aria-controls="detailView<?php echo $i; ?>">+</td>
                                                </tr>
                                                <tr id="detailView<?php echo $i; ?>" class="collapse">
                                                    <td colspan="7" class="text-start">
                                                        <div class="row row-cols-4 m-0">


                                                            <div class="col my-2"><strong><?php echo $product_instruction->item_dimension; ?>:</strong> <?php echo $set_data['item_height'] . 'X' . $set_data['item_width'] . 'X' . $set_data['item_length']; ?></div>
                                                            <div class="col my-2"><strong><?php echo $product_instruction->item_weight; ?>:</strong> <?php echo $set_data['item_weight']; ?></div>
                                                            <div class="col my-2"><strong><?php echo $product_instruction->shipping_special_notes; ?>:</strong><?php echo $set_data['shipping_special_notes']; ?></div>
                                                            <div class="col my-2"><strong><?php echo $product_instruction->comments; ?>:</strong><?php echo $set_data['comment']; ?> </div>

                                                        </div>











                                                    </td>
                                                </tr>
                                        <?php
                                                $i++;
                                            }
                                        } ?>

                                    </tbody>
                                </table>
                            </div>


                            <div class="table-responsive w-100 float-start mb-4">
                                <table class="w-100 table table-bordered my-table orderDetailsTable" style="min-width: 900px;">
                                    <thead class="text-center">
                                        <tr>
                                            <th><?php echo $admin_order_details['srno']['admin']; ?> </th>
                                            <th><?php echo $admin_order_details['invoice_number']['admin']; ?></th>
                                            <th><?php echo $admin_order_details['payment_method']['admin']; ?></th>
                                            <th><?php echo $admin_order_details['transaction_id']['admin']; ?></th>
                                            <th><?php echo $admin_order_details['paid_amount']['admin']; ?></th>
                                            <th><?php echo $admin_order_details['payment_date']['admin']; ?></th>

                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php
                                            $j = 1;
                                            if (isset($order_payments)) {
                                                foreach ($order_payments as $single_payment) {

                                                   
                                            ?>
                                                <tr>
                                                    <td><?php echo $j; ?></td>
                                                    <td><?php echo $single_payment['invoice_number']; ?></td>
                                                    <td><?php echo getpaymentmethod($single_payment['payment_method']); ?></td>
                                                    <td><?php echo $single_payment['transaction_id']; ?></td>
                                                    <td><?php echo $single_payment['amount']." ".$single_payment['currency']."(".round($single_payment['amount'] /$user_data->amount * 100)."%)"; ?></td>
                                                    <td><?php echo $single_payment['payment_created']; ?></td>
                                                    <td style="font-size:22px;" class="showHideDetails" data-bs-toggle="collapse" href="#detailView<?php echo $j; ?>" role="button" aria-expanded="false" aria-controls="detailView<?php echo $j; ?>">+</td>
                                                </tr>
                                                <tr id="detailView<?php echo $j; ?>" class="collapse">
                                                    <td colspan="7" class="text-start">
                                                        <div class="row row-cols-4 m-0">

                                                        <?php if($single_payment['payment_method']=="1") { ?>
                                                            <div class="col my-2">
                                                            <strong><?php echo $sales_order_preview->card_text; ?>:</strong> <?php echo $single_payment['card_number']; ?></div>


                                                            <?php } ?>
                                                            <?php if($single_payment['payment_method']=="2") { ?>
                                                                <div class="col my-2">
                                                            <strong><?php echo $admin_order_details['last_payment_date']['admin']; ?>>:</strong><?php echo $single_payment['last_payment_date']; ?></div>


                                                            <div class="col my-2">
                                                            <strong><?php echo $admin_order_details['payment_term_days']['admin']; ?> :</strong> <?php echo $single_payment['payment_term_days']; ?></div>


                                                            


                                                                <?php } ?>


                                                                <div class="col my-2">
                                                            <strong><?php echo $admin_order_details['payment_type']['admin']; ?> :</strong> <?php echo getpaymenttype($single_payment['payment_type']); ?></div>


                                                                <div class="col my-2">
                                                            <strong><?php echo $admin_order_details['status']['admin']; ?>:</strong> <?php echo getpaymentstatus($single_payment['status']); ?> </div>



                                                            <?php if ($single_payment['invoiceStatus'] == 1) {  ?>

                                                            <div class="col my-2">
                                                            <a href="<?php echo base_url() . 'assets/uploads/invoice/Invoice_' . $single_payment['invoice_number'] . '.pdf'; ?>" class="btn btn-primary" download><?php echo $admin_static_links['download_invoice']['front']; ?></a></div>

                                                            <?php } ?>

                                                        </div>











                                                    </td>
                                                </tr>
                                        <?php
                                                $j++;
                                            }
                                        } ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(e) {
        $("#open_download_image").click(function() {
            $("#download_packagelist").hide();
            $("#download_image").show();
        });

        $("#open_download_packagelist").click(function() {
            $("#download_image").hide();
            $("#download_packagelist").show();
        });
    });
</script>

<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">