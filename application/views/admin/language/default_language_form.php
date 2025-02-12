<div class="content zerorightmargin">
    <?php if ($this->session->flashdata('success')) {
        $msg = $this->session->flashdata('success'); ?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?>
            </div>
        </div>
    <?php } ?>

    <?php if ($this->session->flashdata('error')) {
        $msg = $this->session->flashdata('error'); ?>
        <div class="notice outer">
            <div class="error"><?php echo $msg; ?>
        </div>
    </div>
    <?php } ?>



    <div class="outer">
        <div class="inner">
            <div class="page-header">
                
                <div class="body">


                    <div class="container">
                            <form id="languageForm" name="languageForm" class="form-horizontal" method="post">
                                <input type="hidden" name="operation" value="set"/>

                                
                                <input type="hidden" id="delimageid" value="<?php echo isset($edit_data['id']) ? $edit_data['id'] : ''; ?>"/>
     
                                <div class="span12">
          
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5><?php $action = isset($edit_data['id']) ? 'edit_default_language' : 'add_default_language';
                                                 echo $admin_country->$action['admin']; ?></h5>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                  <div class="edit_text" style="display:block"></div>
                                                  <input type="text" value="<?php echo $admin_country->$action['admin']; ?>" class="edit_input_text" style="display: none;">
                                                  <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_country/'.$action; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_country/<?= $action;?>/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label"><?php echo $admin_country->country['admin']; ?></label>
                                          <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_country->country['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_country/country'; ?>">
                                          <?php } ?>
                                          <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_country/country/admin" class="fancybox multi_language_common_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                          </a>
                                            <div class="controls">
                                              <?php if(count($countries) > 0){?>
                                                <select name="countryCode" id="countryCode" required class="focustip span12">
                                                  <option value="">Select any one</option>
                                                  <?php foreach ($countries as $country) {?>
                                                    <option value="<?= $country['alpha_2'];?>" <?php if(isset($edit_data['countryCode']) && $edit_data['countryCode'] == $country['alpha_2']){ echo 'selected';}?>><?= $country['countryName'];?></option>
                                                  <?php } ?>
                                                </select>
                                              <?php } ?>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label"><?php echo $admin_country->state['admin']; ?></label>
                                          <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_country->state['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_country/state'; ?>">
                                          <?php } ?>
                                          <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_country/state/admin" class="fancybox multi_language_common_edit admin_globe">
                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                          </a>
                                          <div class="controls">
                                            <select name="stateCode" id="stateCode" required class="focustip span12">
                                              <option value="">Select any one</option>
                                              <?php if(isset($states) && $states){ echo $states;} ?>
                                            </select>
                                          </div>
            
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label"><?php echo $admin_country->language['admin']; ?></label>
                                          <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_country->language['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_country/language'; ?>">
                                          <?php } ?>
                                          <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_country/language/admin" class="fancybox multi_language_common_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                          </a>
                                            <div class="controls">
                                              <?php if(count($languages) > 0){?>
                                                <select name="languageId" id="languageId" required class="focustip span12">
                                                  <option value="">Select any one</option>
                                                  <?php foreach ($languages as $language) {
                                                    if($language['status'] == 1){?>
                                                      <option value="<?= $language['id'];?>" <?php if(isset($edit_data['languageId']) && $edit_data['languageId'] == $language['id']){ echo 'selected';}?>><?= $language['name'];?></option>
                                                    <?php } ?>
                                                  <?php } ?>
                                                </select>
                                              <?php } ?>
                                            </div>
                                            <span class="red1"><?php echo form_error('languageId'); ?></span>
                                        </div>

                                        <?php if($addscripts == 'edit_default_language'){?>
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                            </div>
                                        <?php } else { ?>
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="<?php echo $admin_static_links['static_add']['front']; ?>" id="send" type="submit">
                                                <input class="btn btn-danger" type="reset" value="<?php echo $admin_static_links['reset']['front']; ?>">
                                            </div>
                                        <?php } ?>

                                    </div>

                                </div>
                                
                            </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
  $(document).ready(function () {
      $("#languageForm").validate({
          rules: {
              countryCode: {
                  required: true,
                  remote: {
                      url: "<?php echo base_url() . 'admin/'.$lang_id.'/language/checkDefaultLanguagExists'; ?>/"+$('#delimageid').val(),
                      type: "post",
                      data: {
                          countryCode: function () {
                              return $("#countryCode").val();
                          },
                          stateCode: function () {
                              return $("#stateCode").val();
                          }
                      }
                  }
              },
              stateCode: {
                  required: true,
                  remote: {
                      url: "<?php echo base_url() . 'admin/'.$lang_id.'/language/checkDefaultLanguagExists'; ?>/"+$('#delimageid').val(),
                      type: "post",
                      data: {
                          countryCode: function () {
                              return $("#countryCode").val();
                          },
                          stateCode: function () {
                              return $("#stateCode").val();
                          }
                      }
                  }
              },
              languageId: {
                required: true,
              }
          },
          messages: {
              countryCode: {
                required: "<?php echo $admin_static_links['select_country']['front']; ?>",
                remote: "<?php echo $admin_static_links['default_language_already_exists']['front']; ?>"
              },
              stateCode: {
                required: "<?php echo $admin_static_links['select_state']['front']; ?>",
                remote: "<?php echo $admin_static_links['default_language_already_exists']['front']; ?>"
              },
              languageId: {
                required: "<?php echo $admin_static_links['select_language']['front']; ?>"
              }        
          }
      });

      $(document).on('change','#countryCode',function(){
        var countryCode = $(this).val();
        $.ajax({
          type: "POST",
          url: "<?php echo base_url().'admin/'.$lang_id.'/language/getStateByCountry'; ?>",
          data: {
            countryCode: $("#countryCode").val()
          },
          success: function (data) {
            $('#stateCode').html(data)
          },
          error: function (result) {
            alert('error');
          }
        });
      });
  });
</script>
