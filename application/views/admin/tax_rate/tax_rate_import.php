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
    <?php
    if ($this->session->flashdata('error')) {
        $msg = $this->session->flashdata('error');
        ?>
        <div class="notice outer">
            <div class="error"><?php echo $msg; ?>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <!-- page title -->

                <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <form id="importTaxRate" name="importTaxRate" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set"/>

                            <div class="row-fluid">

                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner">
                                                <h5>
                                                    <?php echo $admin_tax_rate['tax_rate_import']['admin']; ?>
                                                </h5>
                                                <?php if ($lang_id == $primary_lang) { ?><div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_tax_rate['tax_rate_import']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tax_rate/tax_rate_import'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tax_rate/tax_rate_import/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>
                                        <div class="control-group" id="import_file">
                                            <label class="control-label"><?php echo $admin_tax_rate['import_file']['admin']; ?>:</label>

                                            <div class="controls">
                                                <input id="import_file_img" name="import_file" class="focustip span12" type="file" required>
                                                <div id="modelimg_prvw1_delete" class="margintop-10px"></div>
                                            </div>
                                            <span class="red1"><?php echo form_error('import_file'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <h5><a class="btn btn-primary" href="<?= base_url() . 'admin/'.$lang_id.'/tax_rate/tax_rate_download';?>"> <?php echo $admin_tax_rate['download_file']['admin']; ?> </a></h5>

                                                <?php if ($lang_id == $primary_lang) { ?>
                                                    <div class="edit_text" style="display:block"></div>
                                                    <input type="text" value="<?php echo $admin_tax_rate['download_file']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                                    <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tax_rate/download_file'; ?>">
                                                <?php } ?>
                                                <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tax_rate/download_file/admin" class="fancybox multi_language_common_edit admin_globe">
                                                    <img src="assets/uploads/global.jpg" height="20" width="20" >
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-actions align-right">
                                            <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                        </div>
                                    </div>
                                </div>
                                <!-- /time pickers -->
                            </div>
                            <!-- /column -->
                        </form>
                        <!-- Pickers -->
                    </div>

                    <!-- /pickers -->

                </div>
                <!-- /content container -->
            </div>
        </div>
    </div>
</div>
