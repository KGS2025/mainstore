<?php $this->load->view('elements/body_logo'); ?>


<div class="ct-videoSection float-start w-100 px-4 px-md-5">
    <div class="ct-services float-start w-100">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
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

<div class="container-fluid float-start w-100 my-4 px-4 px-md-5">
    <div class="main-page static_pages">
        <?php echo html_entity_decode($content); ?>
    </div>
</div>


<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">
<input type="hidden" id="cud_cart_state" value="<?php echo isset($cart_users_data['cart_state']) ? $cart_users_data['cart_state'] : ""; ?>">
<input type="hidden" id="cud_ship_state" value="<?php echo isset($cart_users_data['ship_state']) ? $cart_users_data['ship_state']: ""; ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">


