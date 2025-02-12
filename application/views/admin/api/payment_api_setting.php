<div class="content zerorightmargin">
    <?php if ($this->session->flashdata('success')) {
        $msg = $this->session->flashdata('success'); ?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?>
            </div>
        </div>
    <?php } ?>
    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <!-- page title -->
                <h5> <?php echo $api_instruction['payment_api_settings']['admin']; ?> </h5>
                <!-- End page title -->
                <div class="body">

                    <!-- Content container -->
                    <div class="container">
                        <!-- Pickers -->
                        <form id="addApi" name="addApi" class="form-horizontal bambora-api" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set" />
                            <div class="row-fluid">
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="control-group">
                                            <?php
                                            $bambora_radio = "";
                                            $stripe_radio  = "";
                                            $paymee_radio  = "";
                                            $squareup_radio = "";
                                            $paypal_radio = "";
                                            if ($this->config->item('payment_gateway') == 'bambora') {
                                                $bambora_radio = 'checked';
                                            } else if ($this->config->item('payment_gateway') == 'paymee') {
                                                $paymee_radio = 'checked';
                                            } else if ($this->config->item('payment_gateway') == 'squareup') {
                                                $squareup_radio = 'checked';
                                            } else if ($this->config->item('payment_gateway') == 'clictopay') {
                                                $clictopay_radio = 'checked';
                                            } else if ($this->config->item('payment_gateway') == 'moneris') {
                                                $moneris_radio = 'checked';
                                            } else if ($this->config->item('payment_gateway') == 'paypal') {
                                                $paypal_radio = 'checked';
                                            } else if ($this->config->item('payment_gateway') == 'paymentproof') {
                                                $paymentproof = 'checked';
                                            } else {
                                                $stripe_radio = 'checked';
                                            }
                                            ?>
                                            <input name="payment_api" class="focustip required payment_api" type="radio" <?php echo $bambora_radio; ?> value="1"> <?php echo $api_instruction['bambora_api_list']['admin']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input name="payment_api" class="focustip required payment_api" type="radio" <?php echo $stripe_radio; ?> value="0"> <?php echo $api_instruction['stripe_api']['admin']; ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input name="payment_api" class="focustip required payment_api" type="radio" <?php echo $paymee_radio; ?> value="2"> <?php echo $api_instruction['paymee_api']['admin']; ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input name="payment_api" class="focustip required payment_api" type="radio" <?php echo $squareup_radio; ?> value="3"> <?php echo $api_instruction['squareup_api']['admin']; ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input name="payment_api" class="focustip required payment_api" type="radio" <?php echo $clictopay_radio; ?> value="4"> <?php echo $api_instruction['clictopay_api']['admin']; ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input name="payment_api" class="focustip required payment_api" type="radio" <?php echo $moneris_radio; ?> value="5"> <?php echo $api_instruction['moneris_api']['admin']; ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input name="payment_api" class="focustip required payment_api" type="radio" <?php echo $paypal_radio; ?> value="6"> <?php echo $api_instruction['paypal_api']['admin']; ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input name="payment_api" class="focustip required payment_api" type="radio" <?php echo $paymentproof; ?> value="99"> <?php echo $api_instruction['paymentproof']['admin']; ?>

                                        </div>
                                    </div>
                                </div>
                                <div id="stripe-api">
                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">

                                        <div class="control-group">
                                                <input name="stripe_payment_intent" class="focustip required stripe_payment_intent" type="radio" value="0" <?php if ($this->config->item('stripe_payment_intent') == 0) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?>> <?php echo $api_instruction['stripe_payment_no']['front']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                                <input name="stripe_payment_intent" class="focustip required stripe_payment_intent" type="radio" value="1" <?php if ($this->config->item('stripe_payment_intent') == 1) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?>> <?php echo $api_instruction['stripe_payment_yes']['front']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"><?php echo $api_instruction['stripe_live_publishable_key']['admin']; ?></label>
                                                <div class="controls"><input name="stripe_live_publishable_key" class="focustip span12 required" type="text" value="<?php echo $this->config->item('stripe_live_publishable_key'); ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('stripe_live_publishable_key'); ?></span>

                                                <label class="control-label"><?php echo $api_instruction['stripe_live_secret_key']['admin']; ?></label>
                                                <div class="controls"><input name="stripe_live_secret_key" class="focustip span12 required" type="text" value="<?php echo $this->config->item('stripe_live_secret_key'); ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('stripe_live_secret_key'); ?></span>

                                                <label class="control-label"><?php echo $api_instruction['stripe_sandbox_publishable_key']['admin']; ?></label>
                                                <div class="controls"><input name="stripe_sandbox_publishable_key" class="focustip span12 required" type="text" value="<?php echo $this->config->item('stripe_sandbox_publishable_key'); ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('stripe_sandbox_publishable_key'); ?></span>

                                                <label class="control-label"><?php echo $api_instruction['stripe_sandbox_secret_key']['admin']; ?></label>
                                                <div class="controls"><input name="stripe_sandbox_secret_key" class="focustip span12 required" type="text" value="<?php echo $this->config->item('stripe_sandbox_secret_key'); ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('stripe_sandbox_secret_key'); ?></span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <!-- Column -->
                                        <div class="span12">
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" name="submit" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="paymee-api">
                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $api_instruction['paymee_account_number']['admin']; ?></label>
                                                <div class="controls"><input name="account_number" class="focustip span12 required" type="text" value="<?php echo $this->config->item('paymee_account_number'); ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('account_number'); ?></span>

                                                <label class="control-label"><?php echo $api_instruction['paymee_token']['admin']; ?></label>
                                                <div class="controls"><input name="token" class="focustip span12 required" type="text" value="<?php echo $this->config->item('paymee_token'); ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('token'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <!-- Column -->
                                        <div class="span12">
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" name="submit" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="clictopay-api">
                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $api_instruction['ctp_apiuserName']['admin']; ?></label>
                                                <div class="controls"><input name="ctp_apiuserName" class="focustip span12 required" type="text" value="<?php echo $this->config->item('ctp_apiuserName'); ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('ctp_apiuserName'); ?></span>

                                                <label class="control-label"><?php echo $api_instruction['ctp_password']['admin']; ?></label>
                                                <div class="controls"><input name="ctp_password" class="focustip span12 required" type="text" value="<?php echo $this->config->item('ctp_password'); ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('ctp_password'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <!-- Column -->
                                        <div class="span12">
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" name="submit" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="bambora-api">
                                    <!-- Column -->
                                    <div class="span12" id="api_main_content">
                                        <input type="hidden" class="delete_bambora_api_id" name="delete_bambora_api_id" value="" />
                                        <!-- Time pickers -->
                                        <?php
                                        if (!empty($bambora_all_data)) {
                                            $i = 1;
                                            foreach ($bambora_all_data as $a) {
                                        ?>
                                                <div class="block well apirow apirow_bambora_<?php echo $i; ?>">
                                                    <div class="navbar">
                                                        <div class="navbar-inner">
                                                            <h5>
                                                                <?php echo $api_instruction['bambora_api_list']['admin']; ?>
                                                            </h5>
                                                            <?php if ($i > 1) { ?>
                                                                <button type="button" class="btn btn-danger delete_api delete_api_<?php echo $i; ?>" data-api="<?= $a->id; ?>" data-gateway="bambora"><?php echo $api_instruction['delete']['admin']; ?></button>
                                                            <?php } ?>
                                                            <input type="hidden" name="api_id[]" value="<?= $a->id; ?>">

                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label"><?php echo $api_instruction['country']['admin']; ?></label>
                                                        <div class="controls">
                                                            <?php $user_country = isset($a->country) ? $a->country : ''; ?>

                                                            <select name="country[]" class="country span12 selectpicker1 kgt2 required">
                                                                <?php foreach ($countries as $country) {
                                                                ?>
                                                                    <option value='<?php echo htmlentities($country['alpha_2']); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" data-value="<?php echo $country['id']; ?>" <?php if ($a->country == $country['alpha_2']) { ?>selected="selected" <?php } ?>> <?php echo $country['countryName']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <label class="control-label"><?php echo $api_instruction['merchant_id']['admin']; ?></label>
                                                        <div class="controls"><input name="merchant_id[]" class="focustip span12 required" type="text" value="<?php echo $a->merchant_id; ?>">
                                                        </div>
                                                        <span class="red1"><?php echo form_error('merchant_id'); ?></span>

                                                        <label class="control-label"><?php echo $api_instruction['api_key']['admin']; ?></label>
                                                        <div class="controls"><input name="api_key[]" class="focustip span12 required" type="text" value="<?php echo $a->api_key; ?>">
                                                        </div>
                                                        <span class="red1"><?php echo form_error('api_key'); ?></span>

                                                    </div>
                                                </div>
                                            <?php
                                                $i++;
                                            }
                                        } else {
                                            ?>

                                            <div class="block well apirow apirow_bambora_1">
                                                <div class="navbar">
                                                    <div class="navbar-inner">
                                                        <h5>
                                                            <?php echo $api_instruction['bambora_api_list']['admin']; ?>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo $api_instruction['country']['admin']; ?></label>

                                                    <div class="controls">
                                                        <?php $user_country = isset($edit_data['country']) ? $edit_data['country'] : ''; ?>
                                                        <select name="country[]" class="country span12 selectpicker1 kgt2 required">
                                                            <?php foreach ($countries as $country) { ?>
                                                                <option value='<?php echo htmlentities($country['alpha_2']); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" data-value="<?php echo $country['id']; ?>" <?php if (isset($country['countryName']) && $country['countryName'] == "ca") { ?> selected="selected" <?php } ?>> <?php echo $country['countryName']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <label class="control-label"><?php echo $api_instruction['merchant_id']['admin']; ?></label>
                                                    <div class="controls"><input name="merchant_id[]" class="focustip span12 required" type="text">
                                                    </div>
                                                    <span class="red1"><?php echo form_error('merchant_id'); ?></span>

                                                    <label class="control-label"><?php echo $api_instruction['api_key']['admin']; ?></label>
                                                    <div class="controls"><input name="api_key[]" class="focustip span12 required" type="text">
                                                    </div>
                                                    <span class="red1"><?php echo form_error('api_key'); ?></span>


                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row-fluid">
                                        <!-- Column -->
                                        <div class="span12">
                                            <div class="form-actions align-right">
                                                <button type="button" class="btn btn-primary" id="add_new_api"><?php echo $api_instruction['add_new_api']['admin']; ?></button>
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" name="submit" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="squareup-api">
                                    <!-- Column -->
                                    <div class="span12" id="api_squareup_content">
                                        <div class="block well">
                                            <div class="control-group">
                                                <input name="payment_api_mode" class="focustip required payment_api_mode" type="radio" value="0" <?php if ($this->config->item('payment_mode') != 1) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?>> <?php echo $api_instruction['shipping_mode_test']['front']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                                <input name="payment_api_mode" class="focustip required payment_api_mode" type="radio" value="1" <?php if ($this->config->item('payment_mode') == 1) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?>> <?php echo $api_instruction['shipping_mode_live']['front']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>
                                        <input type="hidden" class="delete_squareup_api_id" name="delete_squareup_api_id" value="" />
                                        <!-- Time pickers -->
                                        <?php $availableCountry = array('au', 'ca', 'gb', 'jp', 'us');
                                        if (!empty($squareup_all_data)) {
                                            $i = 1;
                                            foreach ($squareup_all_data as $a) {
                                                if ($a->payment_api_mode == '0') {
                                                    $class = "test-mode";
                                                } else {
                                                    $class = "live-mode";
                                                }
                                        ?>
                                                <div class="block well apirow_squareup apirow_squareup_<?php echo $i; ?> <?= $class; ?>">
                                                    <div class="navbar">
                                                        <div class="navbar-inner">
                                                            <h5> <?php echo $api_instruction['squareup_api']['admin']; ?> </h5>
                                                            <?php if ($i > 1) { ?>
                                                                <button type="button" class="btn btn-danger delete_api delete_api_<?php echo $i; ?>" data-api="<?= $a->id; ?>" data-gateway="squareup"><?php echo $api_instruction['delete']['admin']; ?></button>
                                                            <?php } ?>
                                                            <input type="hidden" name="api_squareup_id[]" value="<?= $a->id; ?>" class="api-input">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label"><?php echo $api_instruction['country']['admin']; ?></label>
                                                        <div class="controls">
                                                            <?php $user_country = isset($a->country) ? $a->country : ''; ?>
                                                            <select name="country_squareup[]" class="country span12 selectpicker1 kgt2 required api-input">
                                                                <?php foreach ($countries as $country) {
                                                                    if (in_array($country['alpha_2'], $availableCountry)) { ?>
                                                                        <option value='<?php echo htmlentities($country['alpha_2']); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" data-value="<?php echo $country['id']; ?>" <?php if ($a->country == $country['alpha_2']) { ?>selected="selected" <?php } ?>> <?php echo $country['countryName']; ?></option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <label class="control-label"><?php echo $api_instruction['application_id']['admin']; ?></label>
                                                        <div class="controls">
                                                            <input name="application_id[]" class="focustip span12 required api-input" type="text" value="<?php echo $a->application_id; ?>">
                                                        </div>
                                                        <span class="red1"><?php echo form_error('application_id'); ?></span>

                                                        <label class="control-label"><?php echo $api_instruction['location_id']['admin']; ?></label>
                                                        <div class="controls">
                                                            <input name="location_id[]" class="focustip span12 required api-input" type="text" value="<?php echo $a->location_id; ?>">
                                                        </div>
                                                        <span class="red1"><?php echo form_error('location_id'); ?></span>

                                                        <label class="control-label"><?php echo $api_instruction['access_token']['admin']; ?></label>
                                                        <div class="controls">
                                                            <input name="access_token[]" class="focustip span12 required api-input" type="text" value="<?php echo $a->access_token; ?>">
                                                        </div>
                                                        <span class="red1"><?php echo form_error('access_token'); ?></span>
                                                    </div>
                                                </div>
                                            <?php $i++;
                                            }
                                        } else { ?>
                                            <div class="block well apirow_squareup apirow_squareup_1">
                                                <div class="navbar">
                                                    <div class="navbar-inner">
                                                        <h5> <?php echo $api_instruction['squareup_api']['admin']; ?> </h5>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo $api_instruction['country']['admin']; ?></label>
                                                    <div class="controls">
                                                        <?php $user_country = isset($edit_data['country']) ? $edit_data['country'] : ''; ?>
                                                        <select name="country_squareup[]" class="country span12 selectpicker1 kgt2 required api-input">
                                                            <?php foreach ($countries as $country) {
                                                                if (in_array($country['alpha_2'], $availableCountry)) { ?>
                                                                    <option value='<?php echo htmlentities($country['alpha_2']); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" data-value="<?php echo $country['id']; ?>" <?php if (isset($country['countryName']) && $country['countryName'] == "ca") { ?> selected="selected" <?php } ?>> <?php echo $country['countryName']; ?></option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <label class="control-label"><?php echo $api_instruction['application_id']['admin']; ?></label>
                                                    <div class="controls">
                                                        <input name="application_id[]" class="focustip span12 required api-input" type="text">
                                                    </div>
                                                    <span class="red1"><?php echo form_error('application_id'); ?></span>

                                                    <label class="control-label"><?php echo $api_instruction['location_id']['admin']; ?></label>
                                                    <div class="controls">
                                                        <input name="location_id[]" class="focustip span12 required api-input" type="text">
                                                    </div>
                                                    <span class="red1"><?php echo form_error('location_id'); ?></span>

                                                    <label class="control-label"><?php echo $api_instruction['access_token']['admin']; ?></label>
                                                    <div class="controls">
                                                        <input name="access_token[]" class="focustip span12 required api-input" type="text">
                                                    </div>
                                                    <span class="red1"><?php echo form_error('access_token'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row-fluid">
                                        <!-- Column -->
                                        <div class="span12">
                                            <div class="form-actions align-right">
                                                <button type="button" class="btn btn-primary" id="add_new_squareup_api"><?php echo $api_instruction['add_new_api']['admin']; ?></button>
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" name="submit" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="moneris-api">
                                    <!-- Column -->
                                    <div class="span12" id="api_squareup_content">
                                        <div class="block well">
                                            <div class="control-group">
                                                <input name="payment_api_mode" class="focustip required payment_api_mode" type="radio" value="0" <?php if ($this->config->item('payment_mode') != 1) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?>> <?php echo $api_instruction['shipping_mode_test']['front']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                                <input name="payment_api_mode" class="focustip required payment_api_mode" type="radio" value="1" <?php if ($this->config->item('payment_mode') == 1) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?>> <?php echo $api_instruction['shipping_mode_live']['front']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>
                                       
                                        <div class="block well apirow_squareup live-mode">
                                            <div class="navbar">
                                                <div class="navbar-inner">
                                                    <h5> <?php echo $api_instruction['moneris_api']['admin']; ?> </h5>
                                                   
                                                </div>
                                            </div>
                                            <div class="control-group">
                                              
                                                <label class="control-label"><?php echo $api_instruction['store_id']['admin']; ?></label>
                                                <div class="controls">
                                                    <input name="moneris_live_store_id" class="focustip span12 required api-input" type="text" value="<?php echo $this->config->item('moneris_live_store_id'); ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('store_id'); ?></span>

                                                <label class="control-label"><?php echo $api_instruction['api_token']['admin']; ?></label>
                                                <div class="controls">
                                                    <input name="moneris_live_api_token" class="focustip span12 required api-input" type="text" value="<?php echo $this->config->item('moneris_live_api_token'); ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('api_token'); ?></span>
                                            </div>
                                        </div>

                                        <div class="block well apirow_squareup test-mode">
                                            <div class="navbar">
                                                <div class="navbar-inner">
                                                    <h5> <?php echo $api_instruction['moneris_api']['admin']; ?> </h5>
                                                   
                                                </div>
                                            </div>
                                            <div class="control-group">
                                              
                                                <label class="control-label"><?php echo $api_instruction['store_id']['admin']; ?></label>
                                                <div class="controls">
                                                    <input name="moneris_sandbox_store_id" class="focustip span12 required api-input" type="text" value="<?php echo $this->config->item('moneris_sandbox_store_id'); ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('store_id'); ?></span>

                                                <label class="control-label"><?php echo $api_instruction['api_token']['admin']; ?></label>
                                                <div class="controls">
                                                    <input name="moneris_sandbox_api_token" class="focustip span12 required api-input" type="text" value="<?php echo $this->config->item('moneris_sandbox_api_token'); ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('api_token'); ?></span>
                                            </div>
                                        </div>
                                       
                                      
                                    </div>
                                    <div class="row-fluid">
                                        <!-- Column -->
                                        <div class="span12">
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" name="submit" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="paypal-api">
                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $api_instruction['paypal_client_sandbox']['admin']; ?></label>
                                                <div class="controls"><input name="paypal_client_sandbox" class="focustip span12 required" type="text" value="<?php echo $this->config->item('paypal_client_sandbox'); ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('paypal_client_sandbox'); ?></span>

                                                <label class="control-label"><?php echo $api_instruction['paypal_secret_sandbox']['admin']; ?></label>
                                                <div class="controls"><input name="paypal_secret_sandbox" class="focustip span12 required" type="text" value="<?php echo $this->config->item('paypal_secret_sandbox'); ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('paypal_secret_sandbox'); ?></span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo $api_instruction['paypal_client_live']['admin']; ?></label>
                                                <div class="controls"><input name="paypal_client_live" class="focustip span12 required" type="text" value="<?php echo $this->config->item('paypal_client_live'); ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('paypal_secret_live'); ?></span>

                                                <label class="control-label"><?php echo $api_instruction['paypal_secret_live']['admin']; ?></label>
                                                <div class="controls"><input name="paypal_secret_live" class="focustip span12 required" type="text" value="<?php echo $this->config->item('paypal_secret_live'); ?>">
                                                </div>
                                                <span class="red1"><?php echo form_error('paypal_secret_live'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <!-- Column -->
                                        <div class="span12">
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" name="submit" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                                                                                
                                <div id="paymentproof-api">
                                    <!-- Column -->
                                    <div class="span12" id="api_squareup_content">
                                       
                                       
                                      
                                       
                                      
                                    </div>
                                    <div class="row-fluid">
                                        <!-- Column -->
                                        <div class="span12">
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" name="submit" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /column -->
                            </div>
                            <!-- /column -->
                        </form>
                    </div>
                    <!-- /pickers -->

                </div>
                <!-- /content container -->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.live-mode').hide();
        $('.live-mode .api-input').attr('disabled', true);

        <?php if ($this->config->item('payment_gateway') == 'bambora') { ?>
            $('#stripe-api,#paymee-api,#squareup-api,#moneris-api,#clictopay-api,#paymentproof-api,#paypal-api').hide();
            $('#bambora-api').show();
        <?php } else if ($this->config->item('payment_gateway') == 'paymee') { ?>
            $('#stripe-api,#bambora-api,#squareup-api,#moneris-api,#clictopay-api,#paymentproof-api,#paypal-api').hide();
            $('#paymee-api').show();
        <?php } else if ($this->config->item('payment_gateway') == 'squareup') { ?>
            $('#stripe-api,#bambora-api,#paymee-api,#moneris-api,#clictopay-api,#paymentproof-api,#paypal-api').hide();
            $('#squareup-api').show();
        <?php } else if ($this->config->item('payment_gateway') == 'clictopay') { ?>
            $('#stripe-api,#bambora-api,#paymee-api,#squareup-api,#moneris-api,#paymentproof-api,#paypal-api').hide();
            $('#clictopay-api').show();
        <?php } else if ($this->config->item('payment_gateway') == 'moneris') { ?>
            $('#stripe-api,#bambora-api,#paymee-api,#squareup-api,#clictopay-api,#paymentproof-api,#paypal-api').hide();
            $('#moneris-api').show();
        <?php } else if ($this->config->item('payment_gateway') == 'paypal') { ?>
            $('#stripe-api,#bambora-api,#paymee-api,#squareup-api,#clictopay-api,#paymentproof-api,#moneris-api').hide();
            $('#paypal-api').show();
        <?php } else if ($this->config->item('payment_gateway') == 'paymentproof') { ?>
            $('#stripe-api,#bambora-api,#paymee-api,#squareup-api,#moneris-api,#clictopay-api,#paypal-api').hide();
            $('#paymentproof-api').show();
        <?php } else { ?>
            $('#stripe-api').show();
            $('#bambora-api,#paymee-api,#squareup-api,#moneris-api,#clictopay-api,#paymentproof-api').hide();
        <?php } ?>

        $('.payment_api').on('change', function() {
            var get_api_val = $(this).val();
            if (get_api_val == 1) {
                $('#stripe-api,#paymee-api,#squareup-api,#moneris-api,#clictopay-api,#paymentproof-api,#paypal-api').hide();
                $('#bambora-api').show();
            } else if (get_api_val == 0) {
                $('#stripe-api').show();
                $('#bambora-api,#paymee-api,#squareup-api,#moneris-api,#clictopay-api,#paymentproof-api,#paypal-api').hide();
            } else if (get_api_val == 2) {
                $('#stripe-api,#bambora-api,#squareup-api,#moneris-api,#clictopay-api,#paymentproof-api,#paypal-api').hide();
                $('#paymee-api').show();
            } else if (get_api_val == 3) {
                $('#stripe-api,#bambora-api,#paymee-api,#moneris-api,#clictopay-api,#paymentproof-api,#paypal-api').hide();
                $('#squareup-api').show();
            } else if (get_api_val == 4) {
                $('#stripe-api,#bambora-api,#paymee-api,#squareup-api,#moneris-api,#paymentproof-api,#paypal-api').hide();
                $('#clictopay-api').show();
            } else if (get_api_val == 5) {
                $('#stripe-api,#bambora-api,#paymee-api,#squareup-api,#clictopay-api,#paymentproof-api,#paypal-api').hide();
                $('#moneris-api').show();
            } else if (get_api_val == 6) {
                $('#stripe-api,#bambora-api,#paymee-api,#squareup-api,#clictopay-api,#paymentproof-api,#moneris-api').hide();
                $('#paypal-api').show();
            }  else if (get_api_val == 99) {
                $('#stripe-api,#bambora-api,#paymee-api,#squareup-api,#moneris-api,#clictopay-api,#paypal-api').hide();
                $('#paymentproof-api').show();
            }
        });

        $('.payment_api_mode').on('click', function() {
            var get_api_val = $(this).val();
            if (get_api_val == 0) {
                $('.live-mode').hide();
                $('.live-mode .api-input').attr('disabled', true);
                $('.test-mode').show();
                $('.test-mode .api-input').removeAttr('disabled');
            } else {
                $('.test-mode').hide();
                $('.test-mode .api-input').attr('disabled', true);
                $('.live-mode').show();
                $('.live-mode .api-input').removeAttr('disabled');
            }
        });



        <?php if ($this->config->item('payment_mode') == 1) { ?>

            $('.test-mode').hide();
            $('.test-mode .api-input').attr('disabled', true);
            $('.live-mode').show();
            $('.live-mode .api-input').removeAttr('disabled');

        <?php } else { ?>

            $('.live-mode').hide();
            $('.live-mode .api-input').attr('disabled', true);
            $('.test-mode').show();
            $('.test-mode .api-input').removeAttr('disabled');

        <?php } ?>

        $("#addApi").validate();

        $('body').on('click', '.delete_api', function() {
            var gateway = $(this).attr('data-gateway');
            var last_id = $(this).attr('class');
            var api_id = (last_id.split(" ")[3]).split("_");
            $('.apirow_' + gateway + '_' + api_id[2]).remove();

            var row_id = $(this).attr('data-api');
            var delete_api_id = $('.delete_' + gateway + '_api_id').val();
            if (delete_api_id) {
                $('.delete_' + gateway + '_api_id').val(delete_api_id + ',' + row_id);
            } else {
                $('.delete_' + gateway + '_api_id').val(row_id);
            }
        });

        $("#add_new_api").click(function() {
            var last_id = $(".apirow").last().attr("class");
            var api_id = (last_id.split(" ")[3]).split("_");

            var html = '<div class="block well apirow apirow_bambora_' + (parseInt(api_id[2]) + 1) + '"> <div class="navbar"> <div class="navbar-inner"> <h5> <?php echo $api_instruction["bambora_api_list"]['admin']; ?> </h5><button type="button" class="btn btn-danger delete_api delete_api_' + (parseInt(api_id[2]) + 1) + '" data-gateway="bambora">Delete</a> </div> </div> <div class="control-group"><label class="control-label"><?php echo str_replace("'", "\'", $api_instruction["country"]['admin']); ?></label><div class="controls"><?php $user_country = isset($edit_data["country"]) ? $edit_data["country"] : ""; ?><select name="country[]" class="country span12 selectpicker1 kgt2 required"><?php foreach ($countries as $country) { ?><option value="<?php echo htmlentities($country['alpha_2']); ?>"  data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo str_replace("'", "\'", htmlentities($country["alpha_2"])); ?>" data-rel="<?php echo $country["country_code"]; ?>" data-title="<?php echo str_replace("'", "\'", htmlentities($country["countryName"])); ?>" data-value="<?php echo $country["id"]; ?>" <?php if (isset($user_country) && $user_country != "" && $user_country == $country["lang_countryName"]) { ?> selected="selected" <?php } else if (isset($country["countryName"]) && $country["countryName"] == "ca") { ?> selected="selected"<?php } else if ($country["lang_countryName"] == "Canada") { ?>selected="selected" <?php } ?>> <?php echo str_replace("'", "\'", $country["countryName"]); ?></option> <?php } ?></select></div><label class="control-label"><?php echo $api_instruction["merchant_id"]['admin']; ?></label> <div class="controls"><input name="merchant_id[]" class="focustip span12 required" type="text"> </div><label class="control-label"><?php echo $api_instruction["api_key"]['admin']; ?></label> <div class="controls"><input name="api_key[]" class="focustip span12 required" type="text"> </div> </div></div>';
            $('#api_main_content').append(html);
            $(".country").msDropdown({
                roundedBorder: false
            });
        });

        $("#add_new_squareup_api").click(function() {
            var last_id = $(".apirow_squareup").last().attr("class");
            var api_id = (last_id.split(" ")[3]).split("_");

            var html = '<div class="block well apirow_squareup apirow_squareup_' + (parseInt(api_id[2]) + 1) + '"> <div class="navbar"> <div class="navbar-inner"> <h5> <?php echo $api_instruction["squareup_api"]['admin']; ?> </h5><button type="button" class="btn btn-danger delete_api delete_api_' + (parseInt(api_id[2]) + 1) + '" data-gateway="squareup">Delete</a> </div> </div> <div class="control-group"><label class="control-label"><?php echo str_replace("'", "\'", $api_instruction["country"]['admin']); ?></label><div class="controls"><?php $user_country = isset($edit_data["country"]) ? $edit_data["country"] : ""; ?><select name="country_squareup[]" class="country span12 selectpicker1 kgt2 required api-input"><?php foreach ($countries as $country) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    if (in_array($country['alpha_2'], $availableCountry)) { ?>?><option value="<?php echo htmlentities($country['alpha_2']); ?>"  data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo str_replace("'", "\'", htmlentities($country["alpha_2"])); ?>" data-rel="<?php echo $country["country_code"]; ?>" data-title="<?php echo str_replace("'", "\'", htmlentities($country["countryName"])); ?>" data-value="<?php echo $country["id"]; ?>" <?php if (isset($user_country) && $user_country != "" && $user_country == $country["lang_countryName"]) { ?> selected="selected" <?php } else if (isset($country["countryName"]) && $country["countryName"] == "ca") { ?> selected="selected"<?php } else if ($country["lang_countryName"] == "Canada") { ?>selected="selected" <?php } ?>> <?php echo str_replace("'", "\'", $country["countryName"]); ?></option> <?php } ?><?php } ?></select></div><label class="control-label"><?php echo $api_instruction["application_id"]['admin']; ?></label> <div class="controls"><input name="application_id[]" class="focustip span12 required api-input" type="text"> </div><label class="control-label"><?php echo $api_instruction["location_id"]['admin']; ?></label> <div class="controls"><input name="location_id[]" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["access_token"]['admin']; ?></label> <div class="controls"><input name="access_token[]" class="focustip span12 required api-input" type="text"> </div></div></div>';
            $('#api_squareup_content').append(html);
            $(".country").msDropdown({
                roundedBorder: false
            });
        });
    });
</script>
