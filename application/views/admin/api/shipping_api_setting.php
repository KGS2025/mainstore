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
        <h5>
          <?php echo $api_instruction['shipping_api_settings']['admin']; ?>
        </h5>
        <!-- End page title -->
        <div class="body">


          <!-- Content container -->
          <div class="container">
            <!-- Pickers -->
            <form id="addApi" name="addApi" class="form-horizontal" method="post" enctype="multipart/form-data">
              <input type="hidden" name="operation" value="set" />
              <div class="row-fluid">
                <div class="span12">
                  <div class="block well">
                    <div class="control-group">
                    
                      <?php $activeApi = '';
                      foreach ($shipping_list as $shipping) { ?>
                        <input name="shipping_api" class="focustip required shipping_api" type="radio" value="<?php echo $shipping['slug']; ?>" <?php if ($this->config->item('shipping_gateway') == $shipping['slug']) {
                                                                                                                                                  $activeApi = $shipping['slug'];
                                                                                                                                                  echo 'checked';
                                                                                                                                                } ?>> <?php echo $shipping['api_name']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="row-fluid">
                  <!-- Column -->
                  <div id="ups" class="shipping_list" style="<?php if ($activeApi != 'ups') {
                                                                echo 'display: none;';
                                                              } ?>">
                    <div class="span12" id="api_main_content">
                      <div class="block well">
                        <div class="control-group">
                          <input name="shipping_api_mode" class="focustip required shipping_api_mode" type="radio" value="0" <?php if ($this->config->item('shipping_mode') != 1) {
                                                                                                                                echo "checked";
                                                                                                                              } ?>> <?php echo $api_instruction['shipping_mode_test']['front']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                          <input name="shipping_api_mode" class="focustip required shipping_api_mode" type="radio" value="1" <?php if ($this->config->item('shipping_mode') == 1) {
                                                                                                                                echo "checked";
                                                                                                                              } ?>> <?php echo $api_instruction['shipping_mode_live']['front']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                      </div>
                      <input type="hidden" class="delete_ups_api_id" name="delete_ups_api_id" value="" />
                      <!-- Time pickers -->
                      <?php if (!empty($all_data)) {
                        $i = 1;
                        foreach ($all_data as $a) {
                          if ($a->shipping_api_mode == '0') {
                            $class = "test-mode";
                          } else {
                            $class = "live-mode";
                          } ?>
                          <div class="block well apirow apirow_<?php echo $i; ?> <?= $class; ?>">
                            <div class="navbar">
                              <div class="navbar-inner">
                                <h5>
                                  <?php echo $api_instruction['api_list']['admin']; ?>
                                </h5>

                                <button type="button" class="btn btn-danger delete_api delete_api_<?php echo $i; ?>" data-api="<?= $a->id; ?>"><?php echo $api_instruction['delete']['admin']; ?></button>
                                <input type="hidden" name="api_id[<?php echo $i; ?>]" value="<?= $a->id; ?>" class="api-input">

                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label"><?php echo $api_instruction['country']['admin']; ?></label>
                              <div class="controls">
                                <?php $user_country = isset($a->country) ? $a->country : ''; ?>

                                <select name="country[<?php echo $i; ?>]" class="country required selectpicker1 kgt2 api-input">
                                  <?php foreach ($countries as $country) { ?>
                                    <option value='<?php echo htmlentities($country['alpha_2']); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" data-value="<?php echo $country['id']; ?>" <?php if ($a->country == $country['alpha_2']) { ?>selected="selected" <?php } ?>> <?php echo $country['countryName']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <label class="control-label"><?php echo $api_instruction['access']['admin']; ?></label>
                              <div class="controls"><input name="access[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->access; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('access'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['userid']['admin']; ?></label>
                              <div class="controls"><input name="userid[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->userid; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('userid'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['passwd']['admin']; ?></label>
                              <div class="controls"><input name="passwd[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->passwd; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('passwd'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipperNumber']['admin']; ?></label>
                              <div class="controls"><input name="shipperNumber[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipperNumber; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipperNumber'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_description']['admin']; ?></label>
                              <div class="controls"><input name="shipper_description[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_description; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_description'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_name']['admin']; ?></label>
                              <div class="controls"><input name="shipper_name[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_name; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_name'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_attentionname']['admin']; ?></label>
                              <div class="controls"><input name="shipper_attentionname[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_attentionname; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_attentionname'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_addressline1']['admin']; ?></label>
                              <div class="controls"><input name="shipper_addressline1[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_addressline1; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_addressline1'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_addressline2']['admin']; ?></label>
                              <div class="controls"><input name="shipper_addressline2[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_addressline2; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_addressline2'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_city']['admin']; ?></label>
                              <div class="controls"><input name="shipper_city[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_city; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_city'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_stateprovincecode']['admin']; ?></label>
                              <div class="controls"><input name="shipper_stateprovincecode[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_stateprovincecode; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_stateprovincecode'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_postalcode']['admin']; ?></label>
                              <div class="controls"><input name="shipper_postalcode[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_postalcode; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_postalcode'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_countrycode']['admin']; ?></label>
                              <div class="controls"><input name="shipper_countrycode[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_countrycode; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_countrycode'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_number']['admin']; ?></label>
                              <div class="controls"><input name="shipper_number[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_number; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_number'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['pickup_days']['admin']; ?></label>
                              <div class="controls"><input name="pickup_days[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->pickup_days; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('pickup_days'); ?></span>
                            </div>
                          </div>
                        <?php $i++;
                        }
                      } else { ?>
                        <div class="block well apirow apirow_1">
                          <div class="navbar">
                            <div class="navbar-inner">
                              <h5>
                                API List
                              </h5>
                            </div>
                          </div>
                          <div class="control-group">
                            <label class="control-label"><?php echo $api_instruction['country']['admin']; ?></label>
                            <div class="controls">
                              <?php $user_country = isset($edit_data['country']) ? $edit_data['country'] : ''; ?>
                              <select name="country[1]" class="country span12 selectpicker1 kgt2 required api-input">
                                <?php foreach ($countries as $country) { ?>
                                  <option value='<?php echo htmlentities($country['alpha_2']); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" data-value="<?php echo $country['id']; ?>" <?php if (isset($country['countryName']) && $country['countryName'] == "ca") { ?> selected="selected" <?php } ?>> <?php echo $country['countryName']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <label class="control-label"><?php echo $api_instruction['access']['admin']; ?></label>
                            <div class="controls"><input name="access[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('access'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['userid']['admin']; ?></label>
                            <div class="controls"><input name="userid[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('userid'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['passwd']['admin']; ?></label>
                            <div class="controls"><input name="passwd[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('passwd'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipperNumber']['admin']; ?></label>
                            <div class="controls"><input name="shipperNumber[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipperNumber'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_description']['admin']; ?></label>
                            <div class="controls"><input name="shipper_description[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_description'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_name']['admin']; ?></label>
                            <div class="controls"><input name="shipper_name[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_name'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_attentionname']['admin']; ?></label>
                            <div class="controls"><input name="shipper_attentionname[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_attentionname'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_addressline1']['admin']; ?></label>
                            <div class="controls"><input name="shipper_addressline1[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_addressline1'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_addressline2']['admin']; ?></label>
                            <div class="controls"><input name="shipper_addressline2[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_addressline2'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_city']['admin']; ?></label>
                            <div class="controls"><input name="shipper_city[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_city'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_stateprovincecode']['admin']; ?></label>
                            <div class="controls"><input name="shipper_stateprovincecode[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_stateprovincecode'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_postalcode']['admin']; ?></label>
                            <div class="controls"><input name="shipper_postalcode[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_postalcode'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_countrycode']['admin']; ?></label>
                            <div class="controls"><input name="shipper_countrycode[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_countrycode'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_number']['admin']; ?></label>
                            <div class="controls"><input name="shipper_number[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_number'); ?></span>


                            <label class="control-label"><?php echo $api_instruction['pickup_days']['admin']; ?></label>
                            <div class="controls"><input name="pickup_days[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('pickup_days'); ?></span>

                          </div>
                        </div>
                      <?php } ?>
                    </div>
                    <div class="row-fluid">
                      <!-- Column -->
                      <div class="span12">
                        <div class="form-actions align-right">
                          <button type="button" class="btn btn-primary" id="add_new_api"><?php echo $api_instruction['add_new_api']['admin']; ?>
                          </button>
                          <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" name="submit" type="submit">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div id="aramex" class="shipping_list" style="<?php if ($activeApi != 'aramex') {
                                                                  echo 'display: none;';
                                                                } ?>">
                    <!-- Column -->
                    <div class="span12">
                      <!-- Time pickers -->
                      <div class="block well">
                        <div class="control-group">

                          <label class="control-label"><?php echo $api_instruction['country']['admin']; ?></label>
                          <div class="controls">
                            <select name="account_country_code" class="country required" class="span12 selectpicker1 kgt2">
                              <?php foreach ($countries as $country) { ?>
                                <option value='<?php echo htmlentities($country['alpha_2']); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" data-value="<?php echo $country['id']; ?>" <?php if (strtolower($aramex_api_data['account_country_code']) == $country['alpha_2']) { ?>selected="selected" <?php } ?>> <?php echo $country['countryName']; ?></option>
                              <?php } ?>
                            </select>
                          </div>

                          <input type="hidden" name="aramex_api_id" value="<?= $aramex_api_data['id']; ?>">

                          <label class="control-label"><?php echo $api_instruction['account_entity']['admin']; ?></label>
                          <div class="controls "><input name="account_entity" class="focustip span12 required" type="text" value="<?php echo $aramex_api_data['account_entity']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('account_entity'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['paymee_account_number']['admin']; ?></label>
                          <div class="controls"><input name="account_number" class="focustip span12 required" type="text" value="<?php echo $aramex_api_data['account_number']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('account_number'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['account_pin']['admin']; ?></label>
                          <div class="controls"><input name="account_pin" class="focustip span12 required" type="text" value="<?php echo $aramex_api_data['account_pin']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('account_pin'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['userid']['admin']; ?></label>
                          <div class="controls"><input name="user_name" class="focustip span12 required" type="text" value="<?php echo $aramex_api_data['user_name']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('userName'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['passwd']['admin']; ?></label>
                          <div class="controls"><input name="password" class="focustip span12 required" type="text" value="<?php echo $aramex_api_data['password']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('password'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['version']['admin']; ?></label>
                          <div class="controls"><input name="version" class="focustip span12 required" type="text" value="<?php echo $aramex_api_data['version']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('version'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['shipper_department']['admin']; ?></label>
                          <div class="controls"><input name="shipper_department" class="focustip span12" type="text" value="<?php echo $aramex_api_data['shipper_department']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('shipper_department'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['shipper_name']['admin']; ?></label>
                          <div class="controls"><input name="ship_name" class="focustip span12 required" type="text" value="<?php echo $aramex_api_data['shipper_name']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('ship_name'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['shipper_title']['admin']; ?></label>
                          <div class="controls"><input name="shipper_title" class="focustip span12" type="text" value="<?php echo $aramex_api_data['shipper_title']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('shipper_title'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['shipper_company_name']['admin']; ?></label>
                          <div class="controls"><input name="shipper_company_name" class="focustip span12 required" type="text" value="<?php echo $aramex_api_data['shipper_company_name']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('shipper_company_name'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['shipper_addressline1']['admin']; ?></label>
                          <div class="controls"><input name="ship_addressline1" class="focustip span12 required" type="text" value="<?php echo $aramex_api_data['shipper_addressline1']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('shipper_addressline1'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['shipper_addressline2']['admin']; ?></label>
                          <div class="controls"><input name="ship_addressline2" class="focustip span12 required" type="text" value="<?php echo $aramex_api_data['shipper_addressline2']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('shipper_addressline2'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['shipper_city']['admin']; ?></label>
                          <div class="controls"><input name="ship_city" class="focustip span12 required" type="text" value="<?php echo $aramex_api_data['shipper_city']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('shipper_city'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['shipper_stateprovincecode']['admin']; ?></label>
                          <div class="controls"><input name="ship_stateprovincecode" class="focustip span12 required" type="text" value="<?php echo $aramex_api_data['shipper_stateprovincecode']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('shipper_stateprovincecode'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['shipper_postalcode']['admin']; ?></label>
                          <div class="controls"><input name="ship_postalcode" class="focustip span12 required" type="text" value="<?php echo $aramex_api_data['shipper_postalcode']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('shipper_postalcode'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['shipper_countrycode']['admin']; ?></label>
                          <div class="controls"><input name="ship_countrycode" class="focustip span12 required" type="text" value="<?php echo $aramex_api_data['shipper_countrycode']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('shipper_countrycode'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['shipper_phone1']['admin']; ?></label>
                          <div class="controls"><input name="shipper_phone1" class="focustip span12 required" type="text" value="<?php echo $aramex_api_data['shipper_phone1']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('shipper_phone1'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['shipper_phone1_ext']['admin']; ?></label>
                          <div class="controls"><input name="shipper_phone1_ext" class="focustip span12" type="text" value="<?php echo $aramex_api_data['shipper_phone1_ext']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('shipper_phone1_ext'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['shipper_phone2']['admin']; ?></label>
                          <div class="controls"><input name="shipper_phone2" class="focustip span12" type="text" value="<?php echo $aramex_api_data['shipper_phone2']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('shipper_phone2'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['shipper_phone2_ext']['admin']; ?></label>
                          <div class="controls"><input name="shipper_phone2_ext" class="focustip span12" type="text" value="<?php echo $aramex_api_data['shipper_phone2_ext']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('shipper_phone2_ext'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['shipper_fax_number']['admin']; ?></label>
                          <div class="controls"><input name="shipper_fax_number" class="focustip span12" type="text" value="<?php echo $aramex_api_data['shipper_fax_number']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('shipper_fax_number'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['shipper_email_id']['admin']; ?></label>
                          <div class="controls"><input name="shipper_email_id" class="focustip span12 required" type="text" value="<?php echo $aramex_api_data['shipper_email_id']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('shipper_email_id'); ?></span>

                          <label class="control-label"><?php echo $api_instruction['shipper_number']['admin']; ?></label>
                          <div class="controls"><input name="ship_number" class="focustip span12 required" type="text" value="<?php echo $aramex_api_data['shipper_number']; ?>">
                          </div>
                          <span class="red1"><?php echo form_error('shipper_number'); ?></span>

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

                  <div id="fedex" class="shipping_list" style="<?php if ($activeApi != 'fedex') {
                                                                echo 'display: none;';
                                                              } ?>">
                    <div class="span12" id="api_main_content_fedex">
                      <div class="block well">
                        <div class="control-group">
                          <input name="shipping_api_mode_fedex" class="focustip required shipping_api_mode" type="radio" value="0" <?php if ($this->config->item('shipping_mode') != 1) {
                                                                                                                                echo "checked";
                                                                                                                              } ?>> <?php echo $api_instruction['shipping_mode_test']['front']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                          <input name="shipping_api_mode_fedex" class="focustip required shipping_api_mode" type="radio" value="1" <?php if ($this->config->item('shipping_mode') == 1) {
                                                                                                                                echo "checked";
                                                                                                                              } ?>> <?php echo $api_instruction['shipping_mode_live']['front']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                      </div>
                      <input type="hidden" class="delete_fedex_api_id" name="delete_fedex_api_id" value="" />
                      <!-- Time pickers -->
                      <?php if (!empty($all_fedex)) {
                        $i = 1;
                        foreach ($all_fedex as $a) {
                          if ($a->shipping_api_mode == '0') {
                            $class = "test-mode";
                          } else {
                            $class = "live-mode";
                          } ?>
                          <div class="block well apirow apirowfedex_<?php echo $i; ?> <?= $class; ?>">
                            <div class="navbar">
                              <div class="navbar-inner">
                                <h5>
                                  <?php echo $api_instruction['api_list']['admin']; ?>
                                </h5>

                                <button type="button" class="btn btn-danger delete_api_fedex delete_api_<?php echo $i; ?>" data-api="<?= $a->id; ?>"><?php echo $api_instruction['delete']['admin']; ?></button>
                                <input type="hidden" name="fedex_api_id[<?php echo $i; ?>]" value="<?= $a->id; ?>" class="api-input">

                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label"><?php echo $api_instruction['country']['admin']; ?></label>
                              <div class="controls">
                                <?php $user_country = isset($a->country) ? $a->country : ''; ?>

                                <select name="country[<?php echo $i; ?>]" class="country required selectpicker1 kgt2 api-input">
                                  <?php foreach ($countries as $country) { ?>
                                    <option value='<?php echo htmlentities($country['alpha_2']); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" data-value="<?php echo $country['id']; ?>" <?php if ($a->country == $country['alpha_2']) { ?>selected="selected" <?php } ?>> <?php echo $country['countryName']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <label class="control-label"><?php echo $api_instruction['client_id']['admin']; ?></label>
                              <div class="controls"><input name="client_id[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->client_id; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('client_id'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['client_secret']['admin']; ?></label>
                              <div class="controls"><input name="client_secret[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->client_secret; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('client_secret'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['accountNumber']['admin']; ?></label>
                              <div class="controls"><input name="accountNumber[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->accountNumber; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('passwd'); ?></span>

                             
                              <label class="control-label"><?php echo $api_instruction['shipper_name']['admin']; ?></label>
                              <div class="controls"><input name="shipper_personName[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_personName; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_name'); ?></span>
                            

                              <label class="control-label"><?php echo $api_instruction['shipper_companyName']['admin']; ?></label>
                              <div class="controls"><input name="shipper_companyName[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_companyName; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_companyName'); ?></span>

                            

                              <label class="control-label"><?php echo $api_instruction['shipper_addressline1']['admin']; ?></label>
                              <div class="controls"><input name="shipper_addressline1[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_addressline1; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_addressline1'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_addressline2']['admin']; ?></label>
                              <div class="controls"><input name="shipper_addressline2[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_addressline2; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_addressline2'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_city']['admin']; ?></label>
                              <div class="controls"><input name="shipper_city[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_city; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_city'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_stateprovincecode']['admin']; ?></label>
                              <div class="controls"><input name="shipper_stateprovincecode[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_stateprovincecode; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_stateprovincecode'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_postalcode']['admin']; ?></label>
                              <div class="controls"><input name="shipper_postalcode[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_postalcode; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_postalcode'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_countrycode']['admin']; ?></label>
                              <div class="controls"><input name="shipper_countrycode[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_countrycode; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_countrycode'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_phoneNumber']['admin']; ?></label>
                              <div class="controls"><input name="shipper_phoneNumber[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_phoneNumber; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_phoneNumber'); ?></span>

                             
                            </div>
                          </div>
                        <?php $i++;
                        }
                      } else { ?>
                        <div class="block well apirow apirowfedex_1">
                          <div class="navbar">
                            <div class="navbar-inner">
                              <h5>
                                API List
                              </h5>
                            </div>
                          </div>
                          <div class="control-group">
                            <label class="control-label"><?php echo $api_instruction['country']['admin']; ?></label>
                            <div class="controls">
                              <?php $user_country = isset($edit_data['country']) ? $edit_data['country'] : ''; ?>
                              <select name="country[1]" class="country span12 selectpicker1 kgt2 required api-input">
                                <?php foreach ($countries as $country) { ?>
                                  <option value='<?php echo htmlentities($country['alpha_2']); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" data-value="<?php echo $country['id']; ?>" <?php if (isset($country['countryName']) && $country['countryName'] == "ca") { ?> selected="selected" <?php } ?>> <?php echo $country['countryName']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <label class="control-label"><?php echo $api_instruction['client_id']['admin']; ?></label>
                            <div class="controls"><input name="client_id[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('client_id'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['client_secret']['admin']; ?></label>
                            <div class="controls"><input name="client_secret[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('client_secret'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['accountNumber']['admin']; ?></label>
                            <div class="controls"><input name="accountNumber[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('accountNumber'); ?></span>

                          

                            <label class="control-label"><?php echo $api_instruction['shipper_companyName']['admin']; ?></label>
                            <div class="controls"><input name="shipper_companyName[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_companyName'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_name']['admin']; ?></label>
                            <div class="controls"><input name="shipper_personName[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_personName'); ?></span>

                          

                            <label class="control-label"><?php echo $api_instruction['shipper_addressline1']['admin']; ?></label>
                            <div class="controls"><input name="shipper_addressline1[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_addressline1'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_addressline2']['admin']; ?></label>
                            <div class="controls"><input name="shipper_addressline2[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_addressline2'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_city']['admin']; ?></label>
                            <div class="controls"><input name="shipper_city[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_city'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_stateprovincecode']['admin']; ?></label>
                            <div class="controls"><input name="shipper_stateprovincecode[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_stateprovincecode'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_postalcode']['admin']; ?></label>
                            <div class="controls"><input name="shipper_postalcode[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_postalcode'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_countrycode']['admin']; ?></label>
                            <div class="controls"><input name="shipper_countrycode[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_countrycode'); ?></span>

                          


                            <label class="control-label"><?php echo $api_instruction['shipper_phoneNumber']['admin']; ?></label>
                            <div class="controls"><input name="shipper_phoneNumber[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_phoneNumber'); ?></span>

                          </div>
                        </div>
                      <?php } ?>
                    </div>
                    <div class="row-fluid">
                      <!-- Column -->
                      <div class="span12">
                        <div class="form-actions align-right">
                          <button type="button" class="btn btn-primary" id="add_new_fedex"><?php echo $api_instruction['add_new_api']['admin']; ?>
                          </button>
                          <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" name="submit" type="submit">
                        </div>
                      </div>
                    </div>
                  </div>


                  <div id="freightcom" class="shipping_list" style="<?php if ($activeApi != 'freightcom') {
                                                                echo 'display: none;';
                                                              } ?>">
                    <div class="span12" id="api_main_content_freightcom">
                      <div class="block well">
                        <div class="control-group">
                          <input name="shipping_api_mode_freightcom" class="focustip required shipping_api_mode" type="radio" value="0" <?php if ($this->config->item('shipping_mode') != 1) {
                                                                                                                                echo "checked";
                                                                                                                              } ?>> <?php echo $api_instruction['shipping_mode_test']['front']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                          <input name="shipping_api_mode_freightcom" class="focustip required shipping_api_mode" type="radio" value="1" <?php if ($this->config->item('shipping_mode') == 1) {
                                                                                                                                echo "checked";
                                                                                                                              } ?>> <?php echo $api_instruction['shipping_mode_live']['front']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                      </div>
                      <input type="hidden" class="delete_freightcom_api_id" name="delete_freightcom_api_id" value="" />
                      <!-- Time pickers -->
                      <?php if (!empty($all_freightcom)) {
                        $i = 1;
                        foreach ($all_freightcom as $a) {
                          if ($a->shipping_api_mode == '0') {
                            $class = "test-mode";
                          } else {
                            $class = "live-mode";
                          } ?>
                          <div class="block well apirow apirowfreightcom_<?php echo $i; ?> <?= $class; ?>">
                            <div class="navbar">
                              <div class="navbar-inner">
                                <h5>
                                  <?php echo $api_instruction['api_list']['admin']; ?>
                                </h5>

                                <button type="button" class="btn btn-danger delete_freightcom delete_api_<?php echo $i; ?>" data-api="<?= $a->id; ?>"><?php echo $api_instruction['delete']['admin']; ?></button>
                                <input type="hidden" name="freightcom_api_id[<?php echo $i; ?>]" value="<?= $a->id; ?>" class="api-input">

                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label"><?php echo $api_instruction['country']['admin']; ?></label>
                              <div class="controls">
                                <?php $user_country = isset($a->country) ? $a->country : ''; ?>

                                <select name="country[<?php echo $i; ?>]" class="country required selectpicker1 kgt2 api-input">
                                  <?php foreach ($countries as $country) { ?>
                                    <option value='<?php echo htmlentities($country['alpha_2']); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" data-value="<?php echo $country['id']; ?>" <?php if ($a->country == $country['alpha_2']) { ?>selected="selected" <?php } ?>> <?php echo $country['countryName']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                           

                              <label class="control-label"><?php echo $api_instruction['client_secret']['admin']; ?></label>
                              <div class="controls"><input name="client_secret[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->client_token; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('client_secret'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['accountNumber']['admin']; ?></label>
                              <div class="controls"><input name="accountNumber[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->accountNumber; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('passwd'); ?></span>

                             
                              <label class="control-label"><?php echo $api_instruction['shipper_name']['admin']; ?></label>
                              <div class="controls"><input name="shipper_personName[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_personName; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_name'); ?></span>
                            

                              <label class="control-label"><?php echo $api_instruction['shipper_companyName']['admin']; ?></label>
                              <div class="controls"><input name="shipper_companyName[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_companyName; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_companyName'); ?></span>

                            

                              <label class="control-label"><?php echo $api_instruction['shipper_addressline1']['admin']; ?></label>
                              <div class="controls"><input name="shipper_addressline1[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_addressline1; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_addressline1'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_addressline2']['admin']; ?></label>
                              <div class="controls"><input name="shipper_addressline2[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_addressline2; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_addressline2'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_city']['admin']; ?></label>
                              <div class="controls"><input name="shipper_city[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_city; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_city'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_stateprovincecode']['admin']; ?></label>
                              <div class="controls"><input name="shipper_stateprovincecode[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_stateprovincecode; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_stateprovincecode'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_postalcode']['admin']; ?></label>
                              <div class="controls"><input name="shipper_postalcode[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_postalcode; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_postalcode'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_countrycode']['admin']; ?></label>
                              <div class="controls"><input name="shipper_countrycode[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_countrycode; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_countrycode'); ?></span>

                              <label class="control-label"><?php echo $api_instruction['shipper_phoneNumber']['admin']; ?></label>
                              <div class="controls"><input name="shipper_phoneNumber[<?php echo $i; ?>]" class="focustip span12 required api-input" type="text" value="<?php echo $a->shipper_phoneNumber; ?>">
                              </div>
                              <span class="red1"><?php echo form_error('shipper_phoneNumber'); ?></span>

                             
                            </div>
                          </div>
                        <?php $i++;
                        }
                      } else { ?>
                        <div class="block well apirow apirowfreightcom_1">
                          <div class="navbar">
                            <div class="navbar-inner">
                              <h5>
                                API List
                              </h5>
                            </div>
                          </div>
                          <div class="control-group">
                            <label class="control-label"><?php echo $api_instruction['country']['admin']; ?></label>
                            <div class="controls">
                              <?php $user_country = isset($edit_data['country']) ? $edit_data['country'] : ''; ?>
                              <select name="country[1]" class="country span12 selectpicker1 kgt2 required api-input">
                                <?php foreach ($countries as $country) { ?>
                                  <option value='<?php echo htmlentities($country['alpha_2']); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" data-value="<?php echo $country['id']; ?>" <?php if (isset($country['countryName']) && $country['countryName'] == "ca") { ?> selected="selected" <?php } ?>> <?php echo $country['countryName']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            

                            <label class="control-label"><?php echo $api_instruction['client_secret']['admin']; ?></label>
                            <div class="controls"><input name="client_secret[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('client_secret'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['accountNumber']['admin']; ?></label>
                            <div class="controls"><input name="accountNumber[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('accountNumber'); ?></span>

                          

                            <label class="control-label"><?php echo $api_instruction['shipper_companyName']['admin']; ?></label>
                            <div class="controls"><input name="shipper_companyName[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_companyName'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_name']['admin']; ?></label>
                            <div class="controls"><input name="shipper_personName[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_personName'); ?></span>

                          

                            <label class="control-label"><?php echo $api_instruction['shipper_addressline1']['admin']; ?></label>
                            <div class="controls"><input name="shipper_addressline1[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_addressline1'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_addressline2']['admin']; ?></label>
                            <div class="controls"><input name="shipper_addressline2[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_addressline2'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_city']['admin']; ?></label>
                            <div class="controls"><input name="shipper_city[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_city'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_stateprovincecode']['admin']; ?></label>
                            <div class="controls"><input name="shipper_stateprovincecode[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_stateprovincecode'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_postalcode']['admin']; ?></label>
                            <div class="controls"><input name="shipper_postalcode[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_postalcode'); ?></span>

                            <label class="control-label"><?php echo $api_instruction['shipper_countrycode']['admin']; ?></label>
                            <div class="controls"><input name="shipper_countrycode[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_countrycode'); ?></span>

                          


                            <label class="control-label"><?php echo $api_instruction['shipper_phoneNumber']['admin']; ?></label>
                            <div class="controls"><input name="shipper_phoneNumber[1]" class="focustip span12 required api-input" type="text">
                            </div>
                            <span class="red1"><?php echo form_error('shipper_phoneNumber'); ?></span>

                          </div>
                        </div>
                      <?php } ?>
                    </div>
                    <div class="row-fluid">
                      <!-- Column -->
                      <div class="span12">
                        <div class="form-actions align-right">
                          <button type="button" class="btn btn-primary" id="add_new_freightcom"><?php echo $api_instruction['add_new_api']['admin']; ?>
                          </button>
                          <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" name="submit" type="submit">
                        </div>
                      </div>
                    </div>
                  </div>


                </div>

              </div>
              <!-- /column -->
          </div>
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



    <?php if ($this->config->item('shipping_mode') == 1) { ?>

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


    $('#addApi').validate();
    $('body').on('click', '.delete_api', function() {
      var last_id = $(this).attr('class');
      var api_id = (last_id.split(" ")[3]).split("_");

      var row_id = $(this).attr('data-api');
      var delete_ups_api_id = $('.delete_ups_api_id').val();
      if (delete_ups_api_id) {
        $('.delete_ups_api_id').val(delete_ups_api_id + ',' + row_id);
      } else {
        $('.delete_ups_api_id').val(row_id);
      }

      $('.apirow_' + api_id[2]).remove();
    });
    
    // Fedex api delete function
    $('body').on('click', '.delete_api_fedex', function() {
      var last_id = $(this).attr('class');
      var api_id = (last_id.split(" ")[3]).split("_");

      var row_id = $(this).attr('data-api');
      var delete_fedex_api_id = $('.delete_fedex_api_id').val();
      if (delete_fedex_api_id) {
        $('.delete_fedex_api_id').val(delete_fedex_api_id + ',' + row_id);
      } else {
        $('.delete_fedex_api_id').val(row_id);
      }

      $('.apirowfedex_' + api_id[2]).remove();
    });


     // freightcom api delete function
     $('body').on('click', '.delete_freightcom', function() {
      var last_id = $(this).attr('class');
      var api_id = (last_id.split(" ")[3]).split("_");

      var row_id = $(this).attr('data-api');
      var delete_freightcom_api_id = $('.delete_freightcom_api_id').val();
      if (delete_freightcom_api_id) {
        $('.delete_freightcom_api_id').val(delete_freightcom_api_id + ',' + row_id);
      } else {
        $('.delete_freightcom_api_id').val(row_id);
      }

      $('.apirowfreightcom_' + api_id[2]).remove();
    });


    $('.shipping_api').on('click', function() {
      var get_api_val = $(this).val();     
      $('.shipping_list input,.shipping_list select').attr('disabled', true);
     $('#'+get_api_val+' input,#'+get_api_val+' select').removeAttr('disabled');
      $('.shipping_list').hide();
      $('#'+ get_api_val).show();

    });


    $('input[name="shipping_api"]:checked').trigger("click");
    $('.shipping_api_mode:checked').trigger("click");

    $('.shipping_api_mode').on('click', function() {
      var get_api_val = $(this).val();

     var active_api =  $('input[name="shipping_api"]:checked').val();
      if (get_api_val == 0) {
        $('#'+active_api+' .live-mode').hide();
        $('#'+active_api+' .live-mode .api-input').attr('disabled', true);
        $('#'+active_api+' .test-mode').show();
        $('#'+active_api+' .test-mode .api-input').removeAttr('disabled');
      } else {
        $('#'+active_api+' .test-mode').hide();
        $('#'+active_api+' .test-mode .api-input').attr('disabled', true);
        $('#'+active_api+' .live-mode').show();
        $('#'+active_api+' .live-mode .api-input').removeAttr('disabled');
      }
    });


    $("#add_new_api").click(function() {
      var last_id = $(".apirow").last().attr("class");
      var api_id = (last_id.split(" ")[3]).split("_");
      var html = '<div class="block well apirow apirow_' + (parseInt(api_id[1]) + 1) + '"> <div class="navbar"> <div class="navbar-inner"> <h5><?php echo $api_instruction["api_list"]['admin']; ?> </h5><button type="button" class="btn btn-danger delete_api delete_api_' + (parseInt(api_id[1]) + 1) + '"><?php echo $api_instruction["delete"]['admin']; ?></a> </div> </div> <div class="control-group"><label class="control-label"><?php echo str_replace("'", "\'", $api_instruction["country"]['admin']); ?></label><div class="controls"><?php $user_country = isset($edit_data["country"]) ? $edit_data["country"] : ""; ?><select name="country[' + (parseInt(api_id[1]) + 1) + ']" class="country span12 selectpicker1 kgt2 required api-input"><?php foreach ($countries as $country) { ?><option value="<?php echo htmlentities($country['alpha_2']); ?>"  data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo str_replace("'", "\'", htmlentities($country["alpha_2"])); ?>" data-rel="<?php echo $country["country_code"]; ?>" data-title="<?php echo str_replace("'", "\'", htmlentities($country["countryName"])); ?>" data-value="<?php echo $country["id"]; ?>" <?php if (isset($user_country) && $user_country != "" && $user_country == $country["lang_countryName"]) { ?> selected="selected" <?php } else if (isset($country["countryName"]) && $country["countryName"] == "ca") { ?> selected="selected"<?php } else if ($country["lang_countryName"] == "Canada") { ?>selected="selected" <?php } ?>> <?php echo str_replace("'", "\'", $country["countryName"]); ?></option> <?php } ?></select></div><label class="control-label"><?php echo $api_instruction["access"]['admin']; ?></label> <div class="controls"><input name="access[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["userid"]['admin']; ?></label> <div class="controls"><input name="userid[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["passwd"]['admin']; ?></label> <div class="controls"><input name="passwd[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipperNumber"]['admin']; ?></label> <div class="controls"><input name="shipperNumber[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_description"]['admin']; ?></label> <div class="controls"><input name="shipper_description[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_name"]['admin']; ?></label> <div class="controls"><input name="shipper_name[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_attentionname"]['admin']; ?></label> <div class="controls"><input name="shipper_attentionname[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_addressline1"]['admin']; ?></label> <div class="controls"><input name="shipper_addressline1[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_addressline2"]['admin']; ?></label> <div class="controls"><input name="shipper_addressline2[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_city"]['admin']; ?></label> <div class="controls"><input name="shipper_city[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_stateprovincecode"]['admin']; ?></label> <div class="controls"><input name="shipper_stateprovincecode[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_postalcode"]['admin']; ?></label> <div class="controls"><input name="shipper_postalcode[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_countrycode"]['admin']; ?></label> <div class="controls"><input name="shipper_countrycode[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_number"]['admin']; ?></label> <div class="controls"><input name="shipper_number[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["pickup_days"]['admin']; ?></label> <div class="controls"><input name="pickup_days[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> </div></div>';
      $('#api_main_content').append(html);
      $(".country").msDropdown({
        roundedBorder: false
      });
    });

    $("#add_new_fedex").click(function() {
      var last_id = $(".apirow").last().attr("class");
      var api_id = (last_id.split(" ")[3]).split("_");
      var html = '<div class="block well apirow apirowfedex_' + (parseInt(api_id[1]) + 1) + '"> <div class="navbar"> <div class="navbar-inner"> <h5><?php echo $api_instruction["api_list"]['admin']; ?> </h5><button type="button" class="btn btn-danger delete_api_fedex delete_api_' + (parseInt(api_id[1]) + 1) + '"><?php echo $api_instruction["delete"]['admin']; ?></a> </div> </div> <div class="control-group"><label class="control-label"><?php echo str_replace("'", "\'", $api_instruction["country"]['admin']); ?></label><div class="controls"><?php $user_country = isset($edit_data["country"]) ? $edit_data["country"] : ""; ?><select name="country[' + (parseInt(api_id[1]) + 1) + ']" class="country span12 selectpicker1 kgt2 required api-input"><?php foreach ($countries as $country) { ?><option value="<?php echo htmlentities($country['alpha_2']); ?>"  data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo str_replace("'", "\'", htmlentities($country["alpha_2"])); ?>" data-rel="<?php echo $country["country_code"]; ?>" data-title="<?php echo str_replace("'", "\'", htmlentities($country["countryName"])); ?>" data-value="<?php echo $country["id"]; ?>" <?php if (isset($user_country) && $user_country != "" && $user_country == $country["lang_countryName"]) { ?> selected="selected" <?php } else if (isset($country["countryName"]) && $country["countryName"] == "ca") { ?> selected="selected"<?php } else if ($country["lang_countryName"] == "Canada") { ?>selected="selected" <?php } ?>> <?php echo str_replace("'", "\'", $country["countryName"]); ?></option> <?php } ?></select></div><label class="control-label"><?php echo $api_instruction["client_id"]['admin']; ?></label> <div class="controls"><input name="client_id[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["client_secret"]['admin']; ?></label> <div class="controls"><input name="client_secret[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["accountNumber"]['admin']; ?></label> <div class="controls"><input name="accountNumber[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div>   <label class="control-label"><?php echo $api_instruction["shipper_name"]['admin']; ?></label> <div class="controls"><input name="shipper_personName[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_companyName"]['admin']; ?></label> <div class="controls"><input name="shipper_companyName[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_addressline1"]['admin']; ?></label> <div class="controls"><input name="shipper_addressline1[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_addressline2"]['admin']; ?></label> <div class="controls"><input name="shipper_addressline2[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_city"]['admin']; ?></label> <div class="controls"><input name="shipper_city[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_stateprovincecode"]['admin']; ?></label> <div class="controls"><input name="shipper_stateprovincecode[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_postalcode"]['admin']; ?></label> <div class="controls"><input name="shipper_postalcode[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_countrycode"]['admin']; ?></label> <div class="controls"><input name="shipper_countrycode[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_phoneNumber"]['admin']; ?></label> <div class="controls"><input name="shipper_phoneNumber[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div>  </div></div>';
      $('#api_main_content_fedex').append(html);
      $(".country").msDropdown({
        roundedBorder: false
      });
    });
   
    $("#add_new_freightcom").click(function() {
      var last_id = $(".apirow").last().attr("class");
      var api_id = (last_id.split(" ")[3]).split("_");
      var html = '<div class="block well apirow apirowfreightcom_' + (parseInt(api_id[1]) + 1) + '"> <div class="navbar"> <div class="navbar-inner"> <h5><?php echo $api_instruction["api_list"]['admin']; ?> </h5><button type="button" class="btn btn-danger delete_freightcom delete_api_' + (parseInt(api_id[1]) + 1) + '"><?php echo $api_instruction["delete"]['admin']; ?></a> </div> </div> <div class="control-group"><label class="control-label"><?php echo str_replace("'", "\'", $api_instruction["country"]['admin']); ?></label><div class="controls"><?php $user_country = isset($edit_data["country"]) ? $edit_data["country"] : ""; ?><select name="country[' + (parseInt(api_id[1]) + 1) + ']" class="country span12 selectpicker1 kgt2 required api-input"><?php foreach ($countries as $country) { ?><option value="<?php echo htmlentities($country['alpha_2']); ?>"  data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo str_replace("'", "\'", htmlentities($country["alpha_2"])); ?>" data-rel="<?php echo $country["country_code"]; ?>" data-title="<?php echo str_replace("'", "\'", htmlentities($country["countryName"])); ?>" data-value="<?php echo $country["id"]; ?>" <?php if (isset($user_country) && $user_country != "" && $user_country == $country["lang_countryName"]) { ?> selected="selected" <?php } else if (isset($country["countryName"]) && $country["countryName"] == "ca") { ?> selected="selected"<?php } else if ($country["lang_countryName"] == "Canada") { ?>selected="selected" <?php } ?>> <?php echo str_replace("'", "\'", $country["countryName"]); ?></option> <?php } ?></select></div> <label class="control-label"><?php echo $api_instruction["client_secret"]['admin']; ?></label> <div class="controls"><input name="client_secret[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["accountNumber"]['admin']; ?></label> <div class="controls"><input name="accountNumber[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div>   <label class="control-label"><?php echo $api_instruction["shipper_name"]['admin']; ?></label> <div class="controls"><input name="shipper_personName[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_companyName"]['admin']; ?></label> <div class="controls"><input name="shipper_companyName[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_addressline1"]['admin']; ?></label> <div class="controls"><input name="shipper_addressline1[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_addressline2"]['admin']; ?></label> <div class="controls"><input name="shipper_addressline2[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_city"]['admin']; ?></label> <div class="controls"><input name="shipper_city[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_stateprovincecode"]['admin']; ?></label> <div class="controls"><input name="shipper_stateprovincecode[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_postalcode"]['admin']; ?></label> <div class="controls"><input name="shipper_postalcode[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_countrycode"]['admin']; ?></label> <div class="controls"><input name="shipper_countrycode[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div> <label class="control-label"><?php echo $api_instruction["shipper_phoneNumber"]['admin']; ?></label> <div class="controls"><input name="shipper_phoneNumber[' + (parseInt(api_id[1]) + 1) + ']" class="focustip span12 required api-input" type="text"> </div>  </div></div>';
      $('#api_main_content_freightcom').append(html);
      $(".country").msDropdown({
        roundedBorder: false
      });
    });

  });
</script>