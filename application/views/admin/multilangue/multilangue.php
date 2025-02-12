<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script>
<div class="zerorightmargin">
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
                        <?php if( $update_valide ) echo '<div class="valide_update">'.$update_valide.'</div>'; ?>

                        <form id="editMultilangue" name="editMultilangue" class="form-horizontal" method="post" enctype="multipart/form-data" action="" accept-charset="UTF-8">
                            <input type="hidden" name="operation" value="set"/>

                            <div class="row-fluid">
                                <input type="hidden" id="delimageid" value="<?php echo isset($edit_data['id']) ? $edit_data['id'] : ''; ?>"/>

                                <div class="span12" style="margin-left:0px !important">

                                    <div class="block well">
                                        <div class="navbar">
                                            <?php if($edit_value) { ?>
                                            <?php } else { ?>
                                            <?php } ?>
                                            <div class="navbar-inner"><h5> <?php echo $admin_static_links['edit_value']; ?> <br /> <b><?php if(isset($edit_value) && $edit_value != '' && $editor != 'editor') { echo $edit_value; } ?></b> </h5></div>
                                        </div>
                                        <?php 
                                    
                                        foreach( $values_list as $value ){ ?>
                                            <div class="control-group ">

                                                <?php $libelle_input = "value_".$value->id;
                                                $libelle_content_div = "content_div_".$value->id;
                                                ?>

                                                <?php if( $editor == 'editor' ){ ?>
                                                    <?php if($value->image != '') { ?>
                                                        <img src="assets/uploads/country/thumbnails/<?php echo $value->image; ?>" height="20" width="20" >
                                                    <?php } ?>
                                                    <p style="display: inline-block; float: left; margin-right: 10px; margin-top: 5px;"><?php echo $value->country_name; ?></p>
                                                <?php } ?>
                                                <div class="controls multilangue" style="margin-left:0px !important" id="<?php echo $libelle_content_div; ?>">
                                                    <?php if( $editor == 'none' ){ ?>
                                                        <?php if($value->image != '') { ?>
                                                            <img src="assets/uploads/country/thumbnails/<?php echo $value->image; ?>" height="20" width="20" >
                                                        <?php } ?>
                                                        <p style="display: inline-block; float: left; margin-right: 10px; margin-top: 5px;"><?php echo $value->country_name; ?></p>
                                                    <?php } ?>
                                                    <?php if( $input_type == 'input' ){ ?>
                                                        <input  style="float:right !important;" id="value_<?php echo $value->id; ?>" name="value_<?php echo $value->id; ?>" class="focustip span12 language_value" type="text" value="<?php echo htmlentities($value->$field_name); ?>" >
                                                    <?php } else { ?>
                                                        <textarea style="float:right !important;" <?php if( $editor == 'editor' ){ echo 'class="content"'; } ?> id="<?php echo $libelle_input; ?>" name="<?php echo $libelle_input; ?>"><?php echo htmlentities($value->$field_name); ?></textarea>
                                                        <?php if( $editor == 'editor'){ ?>
                                                            <script>
								$(document).ready(function () {
                                                                    CKEDITOR.replace('<?php echo $libelle_input; ?>', {
                                                                        height: 300
                                                                    });
                                                                });
                                                            </script>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <input id="value_hidden_<?php echo $value->id; ?>" name="value_hidden_<?php echo $value->id; ?>" type="hidden" value="<?php echo htmlentities($value->$field_name); ?>" >
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <div class="form-actions align-right">
                                            <input class="btn btn-primary" value="<?php echo $admin_static_links['static_update']; ?>" id="send" type="submit">
                                        </div>

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
