<div class="content zerorightmargin">
  <?php
  if ($this->session->flashdata('success')) {
    $msg = $this->session->flashdata('success');
  ?>
    <div class="notice outer">
      <div class="note"><?php echo $msg; ?>
      </div>
    </div>
  <?php
  }
  ?>
  <div id="show_class" class="note displaynon"></div>
  <div id="result"></div>
  <div class="outer">
    <div class="inner">
      <div class="page-header">

        <div class="body">
          <!-- Content container -->
          <div class="container">
            <!-- Default datatable -->
            <div class="block well margintop-30px">
              <div class="navbar">
                <div class="navbar-inner">
                  <h5>
                    <?php echo $api_instruction['import_list_page']['admin']; ?>
                  </h5>

                  <?php if (isset($access['page_add']) && $access['page_add'] == 1) { ?>
                    <div class="dataTables_length" id="data-table_length">
                      <label>
                        <div id="" class="selector">
                          <a class="floatright" tabindex="0" id="data-table_first" href="admin/<?php echo $lang_id; ?>/importdata/import"><?php echo $admin_static_links['static_add']['front']; ?></a>
                        </div>
                      </label>
                    </div>
                  <?php } ?>


                </div>
              </div>
              <div class="table-overflow">
                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                  <table aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">
                    <thead>
                      <tr role="row">

                        <th>
                          <label class="control-label"><?php echo $admin_user_details['srno']['admin']; ?></label>

                        </th>

                        <th>
                          <label class="control-label"><?php echo  $cart_instruction['import_request_date']['front']; ?></label>
                        </th>

                        <th>
                          <label class="control-label"><?php echo $cart_instruction['iterate_rows']['admin']; ?></label>

                        </th>

                        <th>
                          <label class="control-label"><?php echo $cart_instruction['created_rows']['admin']; ?></label>

                        </th>

                        <th>
                          <label class="control-label"><?php echo  $cart_instruction['log_file']['front']; ?></label>
                        </th>                  

                        <th>
                          <label class="control-label"><?php echo  $cart_instruction['import_csv_file']['front']; ?></label>
                        </th>

                        <th>
                          <label class="control-label"><?php echo  $cart_instruction['import_zip_file']['front']; ?></label>
                        </th>

                        <th>
                          <label class="control-label"><?php echo $admin_user_details['status']['admin']; ?></label>

                        </th>


                      </tr>
                    </thead>

                    <tbody aria-relevant="all" aria-live="polite" role="alert">

                      <?php if (empty($all_data)) { ?>
                        <tr class="odd">
                          <td class="dataTables" valign="top" colspan="5"><?php echo $admin_static_links['no_data_available']['front']; ?></td>
                        </tr>
                      <?php } ?>

                      <?php
                      if (isset($offset)) {
                        $i = $offset + 1;
                      } else {
                        $i = 1;
                      }
                      if (isset($all_data)) {
                        foreach ($all_data as $set_data) {




                      
                      ?>
                          <tr class="odd">

                            <td class="dataTables" valign="top">
                              <?php echo $i; ?>
                            </td>

                            <td class="dataTables" valign="top">
                              <?php

                              $c_date = date('Y-m-d', strtotime($set_data->createddate));

                              echo $c_date; ?>
                            </td>


                            <td class="dataTables" valign="top">
                              <?php echo $set_data->rowsiterated; ?>
                            </td>

                            <td class="dataTables" valign="top">
                              <?php echo $set_data->productcreated; ?>
                            </td>

                            
                            <td class="dataTables" valign="top">

                              <?php if ($set_data->log_file && file_exists(FCPATH . '/assets/uploads/logs/' . $set_data->log_file)) { ?>
                                <a href="<?php echo base_url() . 'assets/uploads/logs/' . $set_data->log_file; ?>" download> Download File </a>
                              <?php } ?>

                            </td>

                            <td class="dataTables" valign="top">

                              <?php if ($set_data->csv_file  && $set_data->status!="2") { ?>
                                <a href="<?php echo base_url() . '/assets/uploads/importproduct/productdata/' . $c_date . '/' . $set_data->csv_file; ?>" download> Download File </a>
                              <?php } ?>

                            </td>

                            <td class="dataTables" valign="top">

                              <?php if ($set_data->zip_file  && $set_data->status!="2") { ?>
                                <a href="<?php echo base_url() . '/assets/uploads/importproduct/productdata/' . $c_date . '/' . $set_data->zip_file; ?>" download> Download File </a>
                              <?php } ?>

                            </td>


                            <td class="dataTables" valign="top">


                              <?php
                              if ($set_data->status == "1") {
                                echo $admin_static_links['inprogress_text']['front'];
                              } else if ($set_data->status == "0") {
                                echo $admin_static_links['pending_text']['front'];
                              } else if ($set_data->status == "2") {
                                echo $admin_static_links['completed_txt']['front'];
                              }
                              ?>


                            </td>





                          </tr>
                      <?php
                          $i++;
                        }
                      }
                      ?>

                      <tr>
                        <td colspan="17">
                          <?php if (isset($links)) { ?>
                            <p class="floatright"><?php echo $links; ?></p>
                          <?php } ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /default datatable -->


            <!-- Pickers -->
          </div>

          <!-- /pickers -->

        </div>
        <!-- /content container -->

      </div>
    </div>
  </div>
</div>

<script>
  function user_status(name, id, value) {

    $.ajax({
      type: "POST",
      url: "admin/<?php echo $lang_id; ?>/update_status",
      data: "table_name=" + name + "&id=" + id + "&status=" + value,
      beforeSend: function() {

        $("#show_class").show();
        $("#show_class").html("Loading ...");
      },
      success: function(msg) {
        var msg = "Serial Code status successfully updated. ";
        $("#show_class").html(msg);
      }
    });
  }


  $(document).ready(function() {

    $("#delete_all_btn").click(function() {
      if ($("#delete_all_btn").is(':checked')) {
        $(".blocks").prop('checked', true);
      } else {
        $(".blocks").prop('checked', false);
      }
    });
    $("#delete_checked").click(function() {
      if ($('input.blocks:checkbox:checked').length) {
        var msg = "<?php echo $admin_static_links['are_you_sure']['front']; ?>";
        var answer = confirm(msg);
        if (answer) {
          var blocksarray = [];
          $('input.blocks:checkbox:checked').each(function() {
            blocksarray.push($(this).val());
            $(this).parents('tr').hide();
          });
          var url = "admin/<?php echo $lang_id; ?>/orders/deleteAll";
          $.ajax({
            type: "POST",
            url: url,
            data: {
              'block_ids': blocksarray,
              'table': 'cart_users'
            },
            success: function(data) {
              $("#delete_all_btn").prop('checked', false);
            }
          });
        }
      } else {
        alert("<?php echo $admin_static_links['please_select_alteast_one_item']['front']; ?>");
      }
    });

  });
</script>
<script type="text/javascript">
  function language_status(name, id, value) {
    $.ajax({
      type: "POST",
      url: "admin/<?php echo $lang_id; ?>/users/update_status",
      /* The country id will be sent to this file */
      data: "id=" + id + "&status=" + value,
      beforeSend: function() {

      },
      success: function(msg) {
        alert('<?= $admin_static_links['data_successfully_updated']['front']; ?>');
      }
    });
  }



  function confirm_box() {
    var answer = confirm("<?php echo $admin_static_links['are_you_sure']['front']; ?>");
    if (!answer)
      return false;
  }
</script>