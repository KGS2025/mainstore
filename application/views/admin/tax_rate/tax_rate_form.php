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
                        <form id="editTaxRate" name="editTaxRate" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set" />
                            <input type="hidden" id="taxId" value="<?php echo isset($edit_data['id']) ? $edit_data['id'] : ''; ?>" />
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php $action = isset($edit_data['id']) ? 'edit_tax_rate' : 'add_tax_rate';
                                                    echo $admin_tax_rate[$action]['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_tax_rate[$action]['admin']; ?>" class="edit_input_text" style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tax_rate/' . $action; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tax_rate/edit_tax_rate/<?= $action; ?>/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" width="20">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control-group">

                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <label class="control-label"><?php echo $admin_tax_rate['country_code']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_tax_rate['country_code']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tax_rate/country_code'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tax_rate/country_code/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                </div>
                                                <div class="span8">
                                                    <?php if (count($countries) > 0) { ?>
                                                        <select name="country_code" id="country_code" required class="focustip span12">
                                                            <option value="">Select any one</option>
                                                            <?php foreach ($countries as $country) { ?>
                                                                <option value="<?= $country['alpha_2']; ?>" <?php if (isset($edit_data['country_code']) && $edit_data['country_code'] == $country['alpha_2']) {
                                                                                                                echo 'selected';
                                                                                                            } ?>><?= $country['countryName']; ?> - <?= strtoupper($country['alpha_2']); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <label class="control-label"><?php echo $admin_tax_rate['state_code']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_tax_rate['state_code']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tax_rate/state_code'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tax_rate/state_code/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>

                                                </div>
                                                <div class="span8">
                                                    <select name="state_code" id="state_code" required class="focustip span12">
                                                        <option value="">Select any one</option>
                                                        <?php if (isset($states) && $states) {
                                                            echo $states;
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <label class="control-label"><?php echo $admin_tax_rate['zip']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_tax_rate['zip']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tax_rate/zip'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tax_rate/zip/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>
                                                </div>
                                                <div class="span8">
                                                    <input type="text" class="right_value focustip span12" id="zip" name="zip" value="<?php echo isset($edit_data['zip']) ? $edit_data['zip'] : ''; ?>">
                                                </div>
                                            </div>

                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <label class="control-label"><?php echo $admin_tax_rate['tax_base_rate']['admin']; ?></label>
                                                    <?php if ($lang_id == $primary_lang) { ?>
                                                        <div class="edit_text" style="display:block"></div>
                                                        <input type="text" value="<?php echo $admin_tax_rate['tax_base_rate']['admin']; ?>" class="edit_input_text" style="display: none;">
                                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tax_rate/tax_base_rate'; ?>">
                                                    <?php } ?>
                                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tax_rate/tax_base_rate/admin" class="fancybox multi_language_common_edit admin_globe">
                                                        <img src="assets/uploads/global.jpg" height="20" width="20">
                                                    </a>
                                                </div>
                                                <div class="span8">
                                                    <input type="text" class="right_value focustip span12" id="tax_base_rate" name="tax_base_rate" value="<?php echo isset($edit_data['tax_base_rate']) ? $edit_data['tax_base_rate'] : ''; ?>">

                                                </div>
                                            </div>
                                        </div>

                                        <?php if ($addscripts == 'edit_tax_rate') { ?>
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        $("#editTaxRate").validate({
            rules: {
                state_code: {
                    required: true
                },
                tax_base_rate: {
                    required: true
                },
                zip: {
                    required: true,
                    remote: {
                        url: "<?php echo base_url() . 'admin/' . $lang_id . '/tax_rate/checkTaxRateExists'; ?>/" + $('#taxId').val(),
                        type: "post",
                        data: {
                            zip: function() {
                                return $("#zip").val();
                            }
                        }
                    }
                }
            },
            messages: {
                zip: {
                    required: "<?php echo $admin_static_links['enter_zip']['front']; ?>",
                    remote: "<?php echo $admin_static_links['zip_already_exists']['front']; ?>"
                }
            }
        });
    });

    $(document).on('change', '#country_code', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'admin/' . $lang_id . '/tax_rate/getStateByCountry'; ?>",
            data: {
                countryCode: $("#country_code").val()
            },
            success: function(data) {
                $('#state_code').html(data)
            },
            error: function(result) {
                alert('error');
            }
        });
    });
</script>