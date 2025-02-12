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
                    <form id="productNatureForm" name="productNatureForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="operation" value="set"/>
                        <input type="hidden" id="natureId" value="<?= isset($edit_data['id']) ? $edit_data['id'] : '';?>"/>
                        <div class="span12">
                            <div class="block well">
                                <div class="navbar">
                                    <div class="navbar-inner">
                                        <h5>
                                            <?php echo $admin_tbl_product_nature['edit_product_natures']['admin']; ?>
                                        </h5>
                                        <?php if ($lang_id == $primary_lang) { ?>
                                            <div class="edit_text" style="display:block"></div>
                                            <input type="text" value="<?php echo $admin_tbl_product_nature['edit_product_natures']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                            <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tbl_product_natures/edit_product_natures'; ?>">
                                        <?php } ?>
                                        <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tbl_product_natures/edit_product_natures/admin" class="fancybox multi_language_common_edit admin_globe">
                                            <img src="assets/uploads/global.jpg" height="20" width="20" >
                                        </a>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label"><?php echo $admin_tbl_product_nature['name']['admin']; ?></label>
                                    <?php if ($lang_id == $primary_lang) { ?>
                                        <div class="edit_text" style="display:block"></div>
                                        <input type="text" value="<?php echo $admin_tbl_product_nature['name']['admin']; ?>" class="edit_input_text"  style="display: none;">
                                        <input type="hidden" value="<?php echo base_url() . 'admin/' . $lang_id . '/multilangue/saveLanguageData/admin_tbl_product_natures/name'; ?>">
                                    <?php } ?>
                                    <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/saveLanguageDataByCountry/admin_tbl_product_natures/name/admin" class="fancybox multi_language_common_edit admin_globe">
                                        <img src="assets/uploads/global.jpg" height="20" width="20" >
                                    </a>

                                    <div class="controls">
                                        <input type="text" class="focustip span12" id="item_name" name="name" value="<?php echo isset($edit_data['name']) ? $edit_data['name'] : ''; ?>" <?php echo (($lang_id != $primary_lang) ? "readonly" : ""); ?>>
                                        <?php if(isset($edit_data['id'])){?>
                                            <a target="_blank" href="admin/<?php echo $lang_id; ?>/multilangue/index/<?php echo $edit_data['id']; ?>/tbl_product_natures_country/name" class="fancybox multi_language_edit admin_globe">
                                                <img src="assets/uploads/global.jpg" height="20" width="20" >
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <span class="red1"><?php echo form_error('name'); ?></span>
                                </div>

                                <?php if($addscripts == 'edit_productnatures'){?>
                                    <div class="form-actions align-right">
                                        <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']['front']; ?>" id="send" type="submit">
                                    </div>
                                <?php }else{ ?>
                                    <div class="form-actions align-right">
                                        <input class="btn btn-primary" value="<?php echo $admin_static_links['static_add']['front']; ?>" id="send" type="submit">
                                        <input class="btn btn-danger" type="reset" value="<?php echo $admin_static_links['reset']['front']; ?>">
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </form>

                    <script>
                        $(document).ready(function () {
                            $("#send").click(function (e) {
                                e.preventDefault();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url().'admin/'.$lang_id.'/productnatures/checkProductnatureExists'; ?>/"+$('#natureId').val(),
                                    data: {
                                        name: $("#item_name").val()
                                    },
                                    dataType: "json",
                                    success: function (msg) {
                                        if (msg.response != 'success') {
                                            $(".red1").html('<?php echo $admin_static_links['product_nature_already_exists']['front']; ?>');
                                        } else {
                                            $("#productNatureForm").submit();
                                        }
                                    },
                                    error: function (result) {
                                        alert('error');
                                    }
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
