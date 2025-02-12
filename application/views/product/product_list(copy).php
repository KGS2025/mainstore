<?php
$comingsoon   = getNoImage('coming-soon');
$defaultIamge = $this->session->userdata('default_image');
$search_by    = $this->session->userdata('search_by');
if (empty($search_by)) {
    $backUrl = base_url() . $lang_id . '/products/product_items';
} else {
    $backUrl = base_url() . $lang_id . '/products/product_model';
}

$loggedUserData = loginuserdata();


?>

<?php $coupon_applied = $this->session->userdata('coupon_applied') ? $this->session->userdata('coupon_applied') : 0;
$coupon_data = $this->session->userdata('coupon_data') ? $this->session->userdata('coupon_data') : 0;


?>

<div class="mainContent px-3 px-lg-5">
    <?php $this->load->view('elements/body_logo'); ?>
    <!------   Search --->
    <div class="ct-videoSection ct-u-paddingTop10 ct-u-paddingBottom20 no_mobile_toppadding">
        <div class="ct-services">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="ct-team-box ct-u-paddingTop20" style="padding-top:0px !important">
                        <div class="float-start w-100 common-search">
                            <div class="text-header">
                                <?php $this->load->view('elements/search'); ?>
                            </div>
                        </div>

                        <div class="float-start w-100 home-quick-search-wrap">
                            <?php $this->load->view('elements/quicksearch'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!------   Search   box end--->

    <div class="text-bread customScrollbar" data-mcs-theme="dark">
        <?php echo '<a href="' . base_url() . $lang_id . '/products">' . $general_instruction->product_section . '</a>'; ?>
        / <?php echo $breadcrumb ? $breadcrumb : ' '; ?>
    </div>
    <input type="button" class="floatright1 show_more_breadcrumb" value="+" style="display: none;">

    <div class="main-page">
        <?php if ($all_data['instruction_section_status'] == 1) { ?>
            <div class="red1" style="color:#<?php echo $all_data['select_category_color_text']; ?>"><span class="fontblack" style="color:#<?php echo $all_data['select_category_color']; ?>"><?php echo $general_instruction->selection_instruction; ?> </span><?php echo $selection_instruction->product_list_msg; ?>
            </div>
        <?php } ?>
        <form action="<?php echo base_url() . $lang_id . '/'; ?>cart/addtocart" method="post" id="product_listing">
            <input name="update" id="update" value="0" type="hidden">
            <input type="hidden" id="cart_block_timer" name="cart_block_timer" value="<?php echo $cart_timer->cart_block_timer; ?>" />

            <div class="car-lists productlisting productbaselisting">
                <?php include('product_timer.php'); ?>
                <div class="col-md-12">
                    <div id="cartitemmsgWrap" class="kgt79"><?php echo isset($general_instruction->product_already_in_cart) ? $general_instruction->product_already_in_cart : ''; ?></div>
                    <div class="Productsearch_result">
                        <?php echo $general_instruction->product_show; ?>:<span id="products_count"><?php echo count($products); ?></span> / <span id="total_products_count"><?php echo $products_counts; ?></span>
                    </div>

                  


                    <div id="productsearch_list_show" class="canload">
                        <span class="custom_btn mb-3 d-inline-flex align-items-center position-relative">
                            <input id="Checkbox_all" name="Checkbox_all" type="checkbox" class="vehiclecategorycheckbox" value="all" />
                            <label for="Checkbox_all"></label>
                            <span><?php echo $general_instruction->select_all; ?></span>
                        </span>

                        <?php if($this->config->item('show_dropdown_in_search_pages') == "1") { ?>

                        <?php if ($products_counts > 2) { ?>

                        <div class="cl-filter p-3">
                        <h5 class="h5 clf-title"><?php echo $product_instruction->dropdown_instrunction;  ?></h5>
                        <div class="control-group"  style="width: 100%" >
                        <label class="control-label"> <?php echo $product_instruction->dropdown_product; ?> </label>
                        <div class="controls">
                        <select class="productslist_drop focustip span12" name="product_id[]" multiple="multiple" required>
                        </select>
                        </div>
                        <span id='product_id_form_validate' class='error displaynon'></span>
                      
                        </div>
                        </div>

                        <?php } ?>
                        <?php } ?>

                        <div class="vehiclecategory_complete_info">
                            <div class="brand_complete_info">
                                <div class="table-responsive">
                                    <?php if ($returnAllProduct == 1 && !empty($products)) { ?>
                                        <table class="table table-bordered my-table">
                                            <tr class="bgrgb219">
                                                <td <?php
                                                    if (isset($session_data['vehicle_type_id']) && $session_data['vehicle_type_id'] == 7) {
                                                        echo 'colspan="12"';
                                                    } else {
                                                        echo 'colspan="11"';
                                                    }
                                                    ?>><?php echo $general_instruction->no_data_available; ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    <?php } else if ($returnAllProduct == 1) { ?>
                                        <table class="table table-bordered my-table">
                                            <tr class="bgrgb219">
                                                <td <?php
                                                    if (isset($session_data['vehicle_type_id']) && $session_data['vehicle_type_id'] == 7) {
                                                        echo 'colspan="12"';
                                                    } else {
                                                        echo 'colspan="11"';
                                                    }
                                                    ?>><?php echo $general_instruction->no_active_product_data; ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    <?php } ?>

                                    <?php



                                    if (!empty($products)) {
                                        if ($offset == 0) {
                                            $offset++;
                                        }
                                        $i = $offset;
                                        foreach ($products as $product) {


                                            $privilage = explode(',', $product->menu_privilages);

                                            $data['product']    = $product;
                                            $data['i']          = $i;
                                            $data['view_type']  = "0";
                                            $data['count']      = 0;
                                            $data['loggedUserData']      = $loggedUserData;
                                            $data['product_instruction'] = $product_instruction;
                                            $data['general_instruction'] = $general_instruction;
                                            $data['product_items']       = $product_items;
                                            $data['coupon_applied']       = $coupon_applied;
                                            $data['coupon_data']       = $coupon_data;
                                            $data['product_model_items'] = $product_model_items;
                                            $data['searchItemValue']     = $searchItemValue;
                                            $data['comingsoon']          = $comingsoon;
                                            $data['colors']              = $this->comman_model->get_row_array('front_colors', '*', array('id' => 1))[0];
                                            $this->load->view('product/product_element', $data);

                                            
                                            $i++;
                                            $offset++;
                                        } ?>
                                    <?php } ?>



                                </div>
                            </div>
                        </div>

                        <div id="appended_products">
                        </div>
                    </div>

                    <?php if ($i > $this->config->item('pagination_limit_product_list_frist_page')) { ?>
                        <div class="removebuttons">
                                <div onclick="ajaxProductList('<?php echo $this->config->item('pagination_limit_product_list'); ?>');" id="loadmoreProducts" class="kgtloadmore actn-btn">
                                    <?php echo $general_instruction->load_more; ?>
                                </div>
                            n 
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="nav-prex-next text-right removebuttons">
                <div class="float-start mt-3 w-100">
                    <a href="<?= $backUrl; ?>" class="btn  actn-btn rounded"><?php echo $general_instruction->back; ?></a>
                    <?php if ($cartcount == getenv('CART_NUMBER')) { ?>
                        <a href="javascript:void(0);" class="btn actn-btn rounded cart_full"><?php echo $selection_instruction->cart_full; ?></a>
                    <?php } else { ?>
                        <a href="javascript:void(0);" id="addtocart" class="btn  actn-btn rounded"><?php echo $general_instruction->addtocart; ?></a>
                    <?php } ?>
                </div>
                <div id="display-num-of-products" class="pull-right kgtnumproducts" style="color: #000000 !important;">
                    <?php echo $general_instruction->product_show; ?>: <?php echo count($products); ?> <?php echo $general_instruction->of_text; ?> <?php echo $products_counts; ?>
                </div>
            </div>
        </form>
    </div>

    <?php if ($products_counts > $this->config->item('pagination_limit_product_list_frist_page')) { ?>
        <div class="loadMoreRecords text-center">
                <div onclick="ajaxProductList('<?php echo $this->config->item('pagination_limit_product_list_frist_page'); ?>');" id="loadmoreProductsFooter" class="kgtloadmore d-inline-block btn-lg rounded loadmoreProductsSticky actn-btn">
                    <?php echo $general_instruction->load_more; ?>
                </div>
        </div>
    <?php } ?>
</div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 s_button sticky_bottom productBtnsFixedBottom py-2 py-md-3 px-3 px-md-5" style="display: none;">
    <div class="nav-prex-next sticky_button_next d-flex flex-wrap align-items-center justify-content-between w-100">
        <div id="display-num-of-products-footer" class="kgtnumproducts">
            <?php echo $general_instruction->product_show; ?>: <?php echo count($products); ?> 
        </div>

        <div class="productActionBtns d-flex align-items-center">
            <a href="<?= $backUrl; ?>" class="btn  actn-btn rounded"><?php echo $general_instruction->back; ?></a>
            <?php if ($cartcount == getenv('CART_NUMBER')) { ?>
                <a href="javascript:void(0);" class="btn actn-btn rounded cart_full"><?php echo $selection_instruction->cart_full; ?></a>
            <?php } else { ?>
                <a href="javascript:void(0);" id="addtocart_footer" class="btn  actn-btn rounded"><?php echo $general_instruction->addtocart; ?></a>
            <?php } ?>
        </div>

    </div>
</div>
<span class="displaynon" id="maincart_block_msg"><?php if (isset($selection_instruction->maincart_block_msg)) echo $selection_instruction->maincart_block_msg; ?></span>
<span class="displaynon" id="editcart_block_msg"><?php if (isset($selection_instruction->editcart_block_msg)) echo $selection_instruction->editcart_block_msg; ?></span>
<span class="displaynon" id="cartpreview_block_msg"><?php if (isset($selection_instruction->cartpreview_block_msg)) echo $selection_instruction->cartpreview_block_msg; ?></span>
<span class="displaynon" id="cartverification_block_msg"><?php if (isset($selection_instruction->cartverification_block_msg)) echo $selection_instruction->cartverification_block_msg; ?></span>
<span class="displaynon" id="block_notification_msg"><?php if (isset($selection_instruction->block_notification_msg)) echo $selection_instruction->block_notification_msg; ?></span>
<span class="displaynon" id="cartverification_resent_block_msg"><?php if (isset($selection_instruction->cartverification_resent_block_msg)) echo $selection_instruction->cartverification_resent_block_msg; ?></span>
<span class="displaynon" id="cartverification_wrong_block_msg"><?php if (isset($selection_instruction->cartverification_wrong_block_msg)) echo $selection_instruction->cartverification_wrong_block_msg; ?></span>
<span class="displaynon" id="load_more"><?php if (isset($general_instruction->load_more)) echo $general_instruction->load_more; ?></span>
<span class="displaynon" id="no_more_product_to_load"><?php if (isset($general_instruction->no_more_product_to_load)) echo $general_instruction->no_more_product_to_load; ?></span>
<span class="displaynon" id="product_show"><?php if (isset($general_instruction->product_show)) echo $general_instruction->product_show; ?></span>
<span class="displaynon" id="product_warning"><?php if (isset($general_instruction->product_warning)) echo $general_instruction->product_warning; ?></span>
<span class="displaynon" id="of_text"><?php if (isset($general_instruction->of_text)) echo $general_instruction->of_text; ?></span>
<span class="displaynon" id="cart_full_msg"><?php if (isset($selection_instruction->cart_full_msg)) echo $selection_instruction->cart_full_msg; ?></span>

<!--Modal Custom warning start-->
<?php $this->load->view('elements/popup/custom_warning_popup'); ?>
<!--Modal Custom warning end-->



<!--Modal Custom warning start-->
<?php $this->load->view('elements/popup/product_warning_popup'); ?>
<!--Modal Custom warning end-->

<!--Modal user block popup start-->
<?php $this->load->view('elements/popup/user_block_box'); ?>
<!--Modal user block popup end-->

<!--Modal shopping decision cart start-->
<?php $this->load->view('elements/popup/decision_cart'); ?>
<!--Modal shopping decision cart end-->

<!--Modal shopping decision cart for already added item start-->
<?php $this->load->view('elements/popup/action_notification_cart_popup'); ?>
<!--Modal shopping decision cart for already added item end-->

<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">
<input type="hidden" id="returnAllProduct" value="<?php echo $returnAllProduct; ?>">
<input type="hidden" id="hide_decision_popup" value="<?php echo $this->config->item('hide_decision_popup'); ?>">
<input type="hidden" id="products_list_pagination" value="<?php echo $this->config->item('pagination_limit_product_list_frist_page'); ?>">


