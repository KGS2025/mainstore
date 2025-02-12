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
        <div class="outer">
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
                <h5>
                    <?php echo $api_instruction['creditterm_setting_page']['admin']; ?>
                </h5>
                <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <!-- Pickers -->
                        <form id="addApi" name="addApi" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set" />
                            <div class="row-fluid">

                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $api_instruction['creditterm_blank_file']['admin']; ?></label>
                                            <div class="controls"><input name="creditterm_blank_file" class="focustip span12 required" type="file" id="creditterm_blank_file">
                                            </div>
                                            <?php if ($this->config->item('creditterm_blank_file')) { ?>
                                                <a href="<?php echo base_url() . '/assets/uploads/cart/' . $this->config->item('creditterm_blank_file'); ?>" download> Download File </a>
                                                <span class="red1"><?php echo form_error('creditterm_blank_file'); ?></span>
                                            <?php } ?>

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
        $("#addApi").validate();

    });
</script>