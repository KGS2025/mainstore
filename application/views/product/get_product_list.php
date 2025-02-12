<?php 
$comingsoon   = getNoImage('coming-soon');
$defaultIamge = $this->session->userdata('default_image');
$loggedUserData = loginuserdata();
?>

<div class="vehiclecategory_complete_info">
    <div class="brand_complete_info">
        <div class="table-responsive model_table_">
        <input type="hidden" id="num_of_products" value="<?php echo count($products); ?>" />

            <?php if (!empty($products)) {
                $i = $offset + 1;
                foreach ($products as $product) {
                    $privilage = explode('#', $product->menu_privilages);

                    $data['product']    = $product;
                    $data['i']          = $i;
                    $data['view_type']  = "0";
                    $data['loggedUserData']      = $loggedUserData;
                    $data['count']      = 0;
                    $data['product_instruction'] = $product_instruction;
                    $data['general_instruction'] = $general_instruction;
                    $data['product_items']       = $product_items;
                    $data['product_model_items'] = $product_model_items;
                    $data['searchItemValue']     = $searchItemValue;
                    $data['comingsoon']          = $comingsoon;
                    $data['colors']              = $this->comman_model->get_row_array('front_colors', '*', array('id' => 1))[0];
                    $this->load->view('product/product_element', $data);

                   
                    $i++;
                }
            } else { ?>
                <!-- <table class="table table-bordered my-table">
                    <tr class="bgrgb219">
                        <td <?php
                            if ($session_data['vehicle_type_id'] == 7) {

                                echo 'colspan="12"';
                            } else if ($session_data['vehicle_type_id'] == 7) {

                                echo 'colspan="15"';
                            } else {

                                echo 'colspan="11"';
                            }
                            ?>><?= $admin_static_links['no_data_available']; ?>
                        </td>
                    </tr>
                </table> -->
            <?php } ?>
        </div>
    </div>
</div>

<script src="<?php echo asset_url('assets/frontend/js/products-new.js?version='.getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>


