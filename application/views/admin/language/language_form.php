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
                            <form id="languageForm" name="languageForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="operation" value="set"/>

                                
                                <input type="hidden" id="delimageid" value="<?php echo isset($edit_data['id']) ? $edit_data['id'] : ''; ?>"/>
     
                                <div class="span12">
          
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5><?php $action = isset($edit_data['id']) ? 'edit_language' : 'add_language';
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
                                          <label class="control-label"><?php echo $admin_country->name['admin']; ?></label>
                                          <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_country->name['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_country/name'; ?>">
                                          <?php } ?>
                                          <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_country/name/admin" class="fancybox multi_language_common_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                          </a>
                                            <div class="controls"><input id="title" name="title" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> class="focustip span12" type="text" value="<?php echo isset($edit_data['name']) ? $edit_data['name'] : ''; ?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('title'); ?></span>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label"><?php echo $admin_country->short_code['admin']; ?></label>
                                          <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_country->short_code['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_country/short_code'; ?>">
                                          <?php } ?>
                                          <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_country/short_code/admin" class="fancybox multi_language_common_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                          </a>

                                            <div class="controls"><input id="short_code" name="short_code" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?> class="focustip span12" type="text" value="<?php echo isset($edit_data['short_code']) ? $edit_data['short_code'] : ''; ?>" <?php echo isset($edit_data['short_code']) ? 'readonly' : ''; ?>>
                                            </div>
                                            <span class="red1"><?php echo form_error('short_code'); ?></span>
                                        </div>


                                        <div class="control-group">
                                          <label class="control-label"><?php echo $admin_country->position['admin']; ?></label>
                                          <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_country->position['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_country/position'; ?>">
                                          <?php } ?>
                                          <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_country/position/admin" class="fancybox multi_language_common_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                          </a>
                                            <div class="controls">
                                                <select name="position" id="position" required>
                                                    <option value=""><?php echo $admin_static_links['select_text']['front']; ?></option>
                                                    <option value="LTR" <?php if(isset($edit_data['position']) && $edit_data['position'] == 'LTR') { echo 'selected=selected'; } ?>><?php echo $admin_static_links['left_to_right']['front']; ?></option>
                                                    <?php if(!isset($edit_data['id']) || (isset($edit_data['id']) && $edit_data['id'] != '13')){?>
                                                        <option value="RTL" <?php if(isset($edit_data['position']) && $edit_data['position'] == 'RTL') { echo 'selected=selected'; } ?>><?php echo $admin_static_links['right_to_left']['front']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label"><?php echo $admin_country->photo['admin']; ?></label>
                                          <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_country->photo['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_country/photo'; ?>">
                                          <?php } ?>
                                          <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_country/photo/admin" class="fancybox multi_language_common_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                          </a>
                                            <div class="controls">
                                                <input type="file" name="file" id="image_img"/>
                                                <?php if(isset($edit_data['image']) && $edit_data['image'] != '') { ?>
                                                <img id="image" width="100" height="100" src="./assets/uploads/country/thumbnails/<?php echo $edit_data['image']; ?>">
                                                <div id="image_delete" class="margintop-10px"><input type="button" class="focustip nopadding" value="<?php echo $admin_static_links['delete_image']['front']; ?>" onclick="removeimg('image');"></div>
                                                <?php } ?>
                                            </div>

                                        </div>
                                        
                                        
                                        <div class="control-group">
                                          <label class="control-label"><?php echo $admin_country->coming_soon['admin']; ?></label>
                                          <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_country->coming_soon['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_country/coming_soon'; ?>">
                                          <?php } ?>
                                          <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_country/coming_soon/admin" class="fancybox multi_language_common_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                          </a>
                                            <div class="controls">
                                                <input type="file" name="coming_soon_image" id="coming_soon_image_img"/>
                                                <?php if(isset($edit_data['coming_soon_image']) && $edit_data['coming_soon_image'] != '') { ?>
                                                  <img id="coming_soon_image" width="100" height="100" src="./assets/uploads/country/coming_soon/<?php echo $edit_data['coming_soon_image']; ?>">
                                                  <div id="coming_soon_image_delete" class="margintop-10px"><input type="button" class="focustip nopadding" value="<?php echo $admin_static_links['delete_image']['front']; ?>" onclick="removeimg('coming_soon_image');"></div>
                                                <?php } ?>
                                            </div>

                                        </div>
                                        
                                        <div class="control-group" style="display: none;">
                                          <label class="control-label"><?php echo $admin_country->no_image['admin']; ?></label>
                                          <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_country->no_image['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_country/no_image'; ?>">
                                          <?php } ?>
                                          <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_country/no_image/admin" class="fancybox multi_language_common_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                          </a>
                                            <div class="controls">
                                                <input type="file" name="no_image" id="no_image_img"/>
                                                <?php if(isset($edit_data['no_image']) && $edit_data['no_image'] != '') { ?>
                                                <img id="no_image" width="100" height="100" src="./assets/uploads/country/no_image/<?php echo $edit_data['no_image']; ?>">
                                                <div id="no_image_delete" class="margintop-10px"><input type="button" class="focustip nopadding" value="<?php echo $admin_static_links['delete_image']['front']; ?>" onclick="removeimg('no_image');"></div>
                                                <?php } ?>
                                            </div>

                                        </div>


                                        <div class="control-group">
                                          <label class="control-label"><?php echo $admin_country->default_image['admin']; ?></label>
                                          <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_country->default_image['admin']; ?>" class="edit_input_text" style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/'.$lang_id.'/multilangue/saveLanguageData/admin_country/default_image'; ?>">
                                          <?php } ?>
                                          <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_country/default_image/admin" class="fancybox multi_language_common_edit admin_globe">
                                              <img src="assets/uploads/global.jpg" height="20" width="20" >
                                          </a>
                                            <div class="controls">
                                                <input type="file" name="default_image" id="default_image_img"/>
                                                <?php if(isset($edit_data['default_image']) && $edit_data['default_image'] != '') { ?>
                                                <img id="default_image" width="100" height="100" src="./assets/uploads/country/default_image/<?php echo $edit_data['default_image']; ?>">
                                                <div id="default_image_delete" class="margintop-10px"><input type="button" class="focustip nopadding" value="<?php echo $admin_static_links['delete_image']['front']; ?>" onclick="removeimg('default_image');"></div>
                                                <?php } ?>
                                            </div>

                                        </div>

                                        <?php if($addscripts == 'edit_language'){?>
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
                title: {
                    required: true,
                    remote: {
                        url: "<?php echo base_url() . 'admin/'.$lang_id.'/language/checkLanguageNameExists'; ?>/"+$('#delimageid').val(),
                        type: "post",
                        data: {
                            title: function () {
                                return $("#title").val();
                            }
                        }
                    }
                },
                short_code: {
                    required: true,
                    remote: {
                        url: "<?php echo base_url() . 'admin/'.$lang_id.'/language/checkLanguageCodeExists'; ?>/"+$('#delimageid').val(),
                        type: "post",
                        data: {
                            short_code: function () {
                                return $("#short_code").val();
                            }
                        }
                    }
                },
                position: "required"
            },
            messages: {
                title: {
                    required: "<?php echo $admin_static_links['please_enter_language_name']['front']; ?>",
                    remote: "<?php echo $admin_static_links['language_name_already_exists']['front']; ?>"
                },
                short_code: {
                    required: "<?php echo $admin_static_links['please_enter_language_short_code']['front']; ?>",
                    remote: "<?php echo $admin_static_links['language_code_already_exists']['front']; ?>"
                }         
            }
        });
    });
</script>
