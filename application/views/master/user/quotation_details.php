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

                                foreach ($main_data as $user_data) { ?>
                                    <div class="col-12 float-start w-100">
                                        <div class="formGrid d-grid gap-3 grid-col-2">
                                            <div class="col"><strong><?php echo $admin_order_details['name']['admin']; ?>:</strong> <?php echo $user_data->user_name; ?></div>
                                            <div class="col"><strong><?php echo $admin_order_details['email']['admin']; ?>:</strong> <?php echo $user_data->email; ?></div>
                                            <div class="col"><strong><?php echo $admin_order_details['country']['admin']; ?>:</strong> <?php echo $user_data->country; ?></div>
                                            <div class="col" style="word-break:break-all"><strong><?php echo $admin_order_details['transaction_id']['admin']; ?>:</strong> <?php echo $user_data->transaction_id; ?></div>
                                            <div class="col" style="word-break:break-all"><strong><?php echo $sales_order_preview->invoice_number; ?>:</strong> <?php echo $user_data->invoice_number; ?></div>

                                            <div class="col"><strong><?php echo $admin_order_details['telephone']['admin']; ?>:</strong> <?php echo $user_data->telephone; ?></div>

                                            <div class="col"><strong><?php echo $admin_order_details['amount']['admin']; ?>:</strong> <?php echo $user_data->amount . ' ' . $user_data->currency; ?></div>
                                            <?php if ($user_data->discount) { ?>
                                                <div class="col"><strong><?php echo $admin_order_details['discount']['admin']; ?>:</strong> <?php echo $user_data->discount . ' ' . $user_data->currency; ?></div>
                                            <?php } ?>
                                            <div class="col"><strong><?php echo $admin_order_details['order_number']['admin']; ?>:</strong> <?php echo $user_data->rfq; ?></div>
                                            <div class="col"><strong><?php echo $admin_order_details['incoterms']['admin']; ?>:</strong> <?php echo $user_data->incoterms; ?></div>
                                            <div class="col"><strong><?php echo $admin_order_details['status']['admin']; ?>:</strong> <?php if ($user_data->payment_approved == "1") {
                                                                                                                                            echo $admin_static_links['approved_text'];
                                                                                                                                        } else if ($user_data->payment_approved == "2") {
                                                                                                                                            echo $admin_static_links['credit_term_status'];
                                                                                                                                        } else {
                                                                                                                                            echo $admin_static_links['pending_text'];
                                                                                                                                        } ?></div>
                                            <?php if ($user_data->edi_one) { ?>
                                                <div class="col"><strong><?php echo $admin_order_details['edi_one']['admin']; ?>:</strong> <?php echo $user_data->edi_one; ?></div>
                                            <?php } ?>
                                            <?php if ($user_data->edi_two) { ?>
                                                <div class="col"><strong><?php echo $admin_order_details['edi_two']['admin']; ?>:</strong> <?php echo $user_data->edi_two; ?></div>
                                            <?php } ?>
                                            <div class="col"><strong><?php echo $admin_order_details['po_number']['admin']; ?>:</strong> <?php echo $user_data->po_number; ?></div>

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
                                            <th><?php echo $admin_order_details['vehicle_category_title']['admin']; ?></th>
                                            <th><?php echo $admin_order_details['vehicle_brand_name']['admin']; ?></th>
                                            <th><?php echo $admin_order_details['product_type_title']['admin']; ?></th>
                                            <th><?php echo $admin_order_details['order_qty']['admin']; ?></th>
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
                                                    <td><?php echo $set_data['vehicle_categories']; ?></td>
                                                    <td><?php echo $set_data['makers']; ?></td>
                                                    <td><?php echo $set_data['models']; ?></td>
                                                    <td><?php echo $set_data['cart_quantity']; ?></td>
                                                    <td style="font-size:22px;" class="showHideDetails" data-bs-toggle="collapse" href="#detailView<?php echo $i; ?>" role="button" aria-expanded="false" aria-controls="detailView<?php echo $i; ?>">+</td>
                                                </tr>
                                                <tr id="detailView<?php echo $i; ?>" class="collapse">
                                                    <td colspan="7" class="text-start">
                                                        <div class="row row-cols-4 m-0">
                                                            <div class="col my-2"><strong><?php echo $product_instruction->unit_of_measurement; ?>:</strong> <?php echo $set_data['unit_of_measurement']; ?></div>
                                                            <div class="col my-2"><strong><?php echo $product_instruction->item_dimension; ?>:</strong> <?php echo $set_data['item_height'] . 'X' . $set_data['item_width'] . 'X' . $set_data['item_length']; ?></div>
                                                            <div class="col my-2"><strong><?php echo $product_instruction->item_weight; ?>:</strong> <?php echo $set_data['item_weight']; ?></div>
                                                            <div class="col my-2"><strong><?php echo $product_instruction->shipping_special_notes; ?>:</strong><?php echo $set_data['shipping_special_notes']; ?></div>
                                                            <div class="col my-2"><strong><?php echo $product_instruction->quantity; ?>:</strong> <?php echo $set_data['cart_quantity']; ?></div>
                                                            <div class="col my-2"><strong><?php echo $product_instruction->comments; ?>:</strong><?php echo $set_data['comment']; ?> </div>


                                                            <?php if (isset($product_attr_data[$set_data['pid']]) && count($product_attr_data[$set_data['pid']]) > 0) {
                                                                foreach ($product_attr_data[$set_data['pid']] as $attr) { ?>
                                                                    <div class="col my-2"><strong><?= $attr['attribute_name']; ?> :</strong>
                                                                        <?php if ($attr['attribute_type'] == 'image') { ?>

                                                                            <?php if ($attr['attribute_value'] != '') { ?>
                                                                                <img src="<?= asset_url('assets/uploads/cart/' . $set_data['cart_user_id'] . '/' . $set_data['pid'] . '/' . $attr['attribute_value']); ?>" width="30" height="30" />
                                                                            <?php } else { ?>
                                                                                <img src="./assets/admin/images/previewimage.jpg" width="75" />
                                                                            <?php } ?>

                                                                        <?php } else { ?>
                                                                            <?= $attr['attribute_value']; ?>
                                                                        <?php } ?>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } ?>






                                                        </div>






                                                        <?php if (isset($model_attr_data[$set_data['pid']]) && count($model_attr_data[$set_data['pid']]) > 0) {
                                                            foreach ($model_attr_data[$set_data['pid']] as $makName => $modelAttr) { ?>
                                                                <div class="ProductmodelInfo border-top pt-2 mt-2 px-1">
                                                                    <p class="mb-0 px-2"><strong><?= $makName; ?></strong></p>
                                                                    <br>
                                                                    <?php foreach ($modelAttr as $modelName => $attributes) { ?>

                                                                        <p class="mb-0 px-2"><?= $modelName; ?></p>

                                                                        <div class="row row-cols-4 ps-3 m-0">
                                                                            <?php foreach ($attributes as $attr) { ?>
                                                                                <div class="col my-2"><strong><?= $attr['attribute_name']; ?> : </strong>
                                                                                    <?php if ($attr['attribute_type'] == 'image') { ?>

                                                                                        <?php if ($attr['attribute_value'] != '') { ?>
                                                                                            <img src="<?= asset_url('assets/uploads/cart/' . $set_data['cart_user_id'] . '/' . $set_data['pid'] . '/' . $attr['attribute_value']); ?>" width="30" height="30" />
                                                                                        <?php } else { ?>
                                                                                            <img src="./assets/admin/images/previewimage.jpg" width="75" />
                                                                                        <?php } ?>

                                                                                    <?php } else { ?>
                                                                                        <?= $attr['attribute_value']; ?>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            <?php } ?>
                                                                        </div>
                                                                    <?php } ?>

                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>




                                                    </td>
                                                </tr>
                                        <?php
                                                $i++;
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