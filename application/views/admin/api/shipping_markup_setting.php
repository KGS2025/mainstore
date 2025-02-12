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


    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <!-- page title -->
                <h5>
                    <?php echo $api_instruction['shipping_markup_setting']['admin']; ?>
                </h5>
                <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <!-- Pickers -->
                        <form id="addApi" name="addApi" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set"/>
                            <div class="row-fluid">

                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $api_instruction['shipping_markup_setting']['admin']; ?></label>
                                            <div class="controls"><input name="shipping_markup_value" class="focustip span12 required" type="text" id="decimal" value="<?php echo $this->config->item('shipping_markup_value');?>">
                                            </div>
                                            <span class="red1"><?php echo form_error('shipping_markup_value'); ?></span>

                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo $api_instruction['shipping_incoterm_options']['admin']; ?></label>

                                            <div class="controls">
                                                <input type="radio" name="shipping_incoterm_options" value="exw" <?php if($this->config->item('shipping_incoterm_options') == 'exw') { echo "checked=checked"; } ?>> <?php echo $cart_instruction->EXW['front'];?>
                                                <input type="radio" name="shipping_incoterm_options" value="dap" <?php if($this->config->item('shipping_incoterm_options') == 'dap') { echo "checked=checked"; } ?>> <?php echo $cart_instruction->DAP['front'];?>
                                                <input type="radio" name="shipping_incoterm_options" value="both" <?php if($this->config->item('shipping_incoterm_options') == 'both') { echo "checked=checked"; } ?>> BOTH
                                            </div>
                                            <span class="red1"><?php echo form_error('shipping_incoterm_options'); ?></span>

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
    $(document).ready(function () {
        $("#addApi").validate();

        $('#decimal').keyup(function(e) {
            var inputValue = document.getElementById("decimal").value;
            if (isNaN(inputValue)) {
                this.value = this.value.substring(0, this.value.length - 1);
            }else{
                this.value = inputValue.replace(/^0+/, '');
                if(inputValue > 99.99){
                    this.value = 99.99
                }
            }
        });

        $(document).on("blur","#decimal",function(){
            if($(this).val() == 0){
                $(this).val($(this).val().replace(/^0+/, ''));
            }
        });
    });


</script>
