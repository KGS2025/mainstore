<div class="mainContent px-3 px-lg-5">
    <?php if (isset($all_data['left_logo_status']) && $all_data['left_logo_status'] == 1) {?>
        <div class="container-fluid py-3 py-md-5 text-center">
            <?php if (isset($all_data['logo']) && $all_data['logo'] != '') {
    $logo = asset_url() . "assets/uploads/logo/thumbnails/" . $all_data['logo'];?>
                <a class="logo navbar-logo navbar-brand text-center d-inline-block" href="<?php echo $all_data['logo_url']; ?>" aria-label="header logo icon">
                    <img src="<?php echo $logo; ?>" alt="<?php echo isset($all_data['title']) ? $all_data['title'] : ''; ?>" class="floatleft1 m-auto float-none" />
                </a>
            <?php } else {?>
                <a class="logo navbar-logo navbar-brand text-center d-inline-block" href="<?php echo $all_data['logo_url']; ?>" aria-label="header logo icon">
                    <img src="<?php echo asset_url('assets/uploads/logo/thumbnails/logo.png'); ?>" alt="34563456" class="floatleft1 m-auto float-none" />
                </a>
            <?php }?>
        <?php }?>
        <?php if (isset($all_data['right_logo_status']) && $all_data['right_logo_status'] == 1) {
    if (isset($all_data['header_image']) && $all_data['header_image'] != '') {
        $header_image = asset_url() . "assets/uploads/logo/thumbnails/" . $all_data['header_image'];?>
                <a class="logo demon_logo_link py-3 text-center d-inline-block" href="<?php echo $all_data['header_image_url']; ?>" target="_blank" rel="noopener noreferrer" aria-label="store icon">
                    <img src="<?php echo $header_image; ?>" alt="left logo image main" class="floatleft1 m-auto float-none" />
                </a>
            <?php }?>
        </div>
    <?php }?>

    <div class="ct-videoSection float-start w-100 px-4 px-md-5">
        <div class="ct-services float-start w-100">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="ct-team-box p-0">
                    <div class="common-search float-start w-100 my-3">
                        <div class="text-header">
                            <?php $this->load->view('elements/search');?>
                        </div>
                    </div>

                    <div class="home-quick-search-wrap float-start w-100">
                        <?php $this->load->view('elements/quicksearch');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-account-area py-3 py-sm-5">
        <div class="container-xxl">
            <div class="row">
                <!-- user dahboard sidebar-->
                <?php $this->load->view('elements/userdashboard-sidebar');?>
                <div class="col-12 col-md-9">
                    <div class="my-account-content mb-50 h-100">
                        <div class="col-md-12 brand_complete_info">
                            <h4 class="orderHistory"><?php echo $all_titles->sidebar_pricerequests; ?></h4>
                            <div class="table-responsive w-100 float-start mb-4">
                                <table class="w-100 table table-bordered my-table">
                                    <thead class="text-center">
                                        <tr>
                                            <th>
                                            <label class="control-label"><?php echo $admin_order_details['srno']['admin']; ?></label>
                                            </th>

                                            <th>
                                            <label class="control-label"><?php echo $general_instruction->requested_products; ?></label>
                                            </th>

                                            <th>
                                            <label class="control-label"><?php echo $general_instruction->requested_products_date; ?></label>
                                            </th>

                                            <th>
                                            <label class="control-label"><?php echo $general_instruction->expire_products_date; ?></label>
                                            </th>

                                            <th>
                                            <label class="control-label"><?php echo $general_instruction->requested_product_status; ?></label>
                                            </th>

                                            <th>
                                            <label class="control-label"><?php echo $general_instruction->action; ?></label>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php

if (!empty($all_orders) && count($all_orders) > 0) {
    if (isset($offset)) {
        $i = $offset + 1;
    } else {
        $i = 1;
    }
    foreach ($all_orders as $set_data) {

        $products = $this->product_model->products_number_by_id($set_data->products);
        ?>
                <tr>
                <td><?php echo $i; ?></td>
                <td> <?php echo implode(",", $products); ?></td>                             
                <td><?php echo date('Y-m-d', strtotime($set_data->createddate)); ?></td>
                <td><?php echo date('Y-m-d', strtotime($set_data->expire_date)); ?></td>
                <td> <?php echo getpaymentrequeststatus($set_data->status); ?></td>
                <td>
                <a href="<?php echo base_url(); ?>/<?php echo $lang_id; ?>/user/viewrequest/<?php echo $set_data->id; ?>" class="viewbtn"> <?php echo $general_instruction->requested_products_view; ?></a>
                </td>
                </tr>
                <?php $i++;
    }
} else {?>
                                <tr class="odd">
                                <td class="dataTables" valign="top" colspan="5"><?=$admin_static_links['no_data_available'];?></td>
                                </tr>
                                <?php }?>
                                    </tbody>
                                </table>
                            </div>
                            <?php if (isset($links)) {?>
                                <div class="custom_pagination float-start w-100 d-flex justify-content-center">
                                    <?php echo $links; ?>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">

<?php $this->load->view('elements/flash_messages'); ?>