<div class="container">
    <div class="main-page">
        <div class="car-lists">
            <div class="form-fill-cart">
                <div class="row">
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End content-->
</div>

<div class="modal fade" id="notify_submit">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <form action="#" method="post" id="target" accept-charset="utf-8">
                        <input type="hidden" id="resend_attempt" value="" />

                        <div class="alert-message block-message warning kgt67">
                            <div class="product_counter_msg counter_msg_wrap verfication_error_msg"></div>
                        </div>



                        <h5 class="title-modal kgt42"><?php echo str_replace("EMAILVAR", $user_email, $cart_instruction->verification_code_to_email); ?></h5>

                        <div class="blink float-start w-100">
                            <div class="show_error colorgray"></div>
                        </div>


                        <div class="col-lg-12 float-start w-100 my-3">
                            <div class="row">
                                <div class="col-sm-6"> <label><?php echo $cart_instruction->enter_email_code; ?>:</label></div>
                                <div class="col-sm-6"> <input type="text" id="email_code" name="code" class="form-control" required autofocus></div>
                            </div>
                        </div>

                        <div class="show_class kgt69 float-start w-100"></div>




                        <div class="col-lg-12 float-start w-100 mb-3">
                            <div class="row">
                                <div class="col-sm-6 timerdiv">
                                    <div id="countdownplace"></div>
                                </div>
                                <div class="col-sm-6">
                                    <img class="loaderimagecontinue " src="<?php echo base_url(); ?>assets/frontend/images/loading.gif" alt="loaderimagecontinue" style="display:none;" />
                                </div>
                            </div>
                        </div>



                        <div class="btn-modal toyota-page">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="javascript:void(0);" id="cancel_form" class="btn  actn-btn rounded"><?php echo $cart_instruction->cancel; ?> <i class="fa fa-angle-right"></i></a>
                                    <a href="javascript:void(0);" id="resend_mail" class="btn  actn-btn rounded"><?php echo $cart_instruction->resend; ?><i class="fa fa-angle-right"></i></a>
                                    <button id="confirm_contact_otp" class="btn  actn-btn rounded"><?php echo $cart_instruction->confirm; ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<span class="displaynon" id="hours"><?php if (isset($general_instruction->hours)) echo $general_instruction->hours; ?></span>
<span class="displaynon" id="minutes"><?php if (isset($general_instruction->minutes)) echo $general_instruction->minutes; ?></span>
<span class="displaynon" id="seconds"><?php if (isset($general_instruction->please_wait)) echo $general_instruction->seconds; ?></span>

<div class="modal fade" id="modal_success">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <?php
            $contact_msg_header = $contact_message['modal_success_header'];
            $contact_msg_body   = $contact_message['modal_success_body'];
            ?>
            <div class="modal-body">
                <div class="box-content-modal">


                    <h5 class="title-modal kgt42 "><?php echo preg_replace('/\bPHRASE\b/', $user_email, $contact_msg_header); ?></h5>

                    <p><?php echo preg_replace('/\bPHRASE\b/', $user_email, $contact_msg_body); ?></p>
                    <div class="btn-modal toyota-page">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="javascript:void(0)" id="ok_bttn" onClick="$('#modal_success').modal('hide')" class="btn  actn-btn rounded"><?php echo $general_instruction->ok; ?> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">
<div class="modal fade" id="modal_block">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal"><span class="blink"><?php echo $general_instruction->warning_text; ?></span></h2>
                    <?php
                    $user_data = $this->session->userdata('user_contact_data');
                    $contact_code_block_msg = $contact_message['error_code_block_msg'];
                    $msg = preg_replace('/\bPHRASE\b/', $user_email, $contact_code_block_msg);
                    ?>
                    <p><?php echo $msg; ?></p>
                    <div class="btn-modal"><a href="javascript:void(0)" id="block_bttn" onClick="$('#modal_block').modal('hide');window.location.href ='<?php echo base_url() . $lang_id; ?>/contact'" class="floatright1 btn btn-primary btn-sm"><?php echo $general_instruction->ok; ?> <i class="fa fa-angle-right"></i></a></div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_block1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal"><span class="blink"><?php echo $general_instruction->warning_text; ?></span></h2>

                    <?php
                    $user_data = $this->session->userdata('user_contact_data');
                    $contact_resend_block_msg = $contact_message['resend_block_msg'];
                    $msg = preg_replace('/\bPHRASE\b/', $user_email, $contact_resend_block_msg);
                    ?>

                    <p><?php echo $msg; ?></p>
                    <div class="btn-modal"><a href="javascript:void(0)" onClick="$('#modal_block1').modal('hide');window.location.href ='<?php echo base_url() . $lang_id; ?>/contact'" class="floatright1 block_bttn1 btn btn-primary btn-sm"><?php echo $general_instruction->ok; ?> <i class="fa fa-angle-right"></i></a></div>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- the following modal block is controlled by the verify_contact.js -> doneHandler() -->
<div class="modal fade" id="timeout_modal_block">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="box-content-modal">
                    <h2 class="title-modal"><span class="blink"><?php echo $general_instruction->warning_text; ?></span></h2>
                    <?php
                    $user_data = $this->session->userdata('new_session');
                    $contact_code_timeout_block_msg = $contact_message['code_timeout_block_msg'];
                    $msg = preg_replace('/\bPHRASE\b/', $user_email, $contact_code_timeout_block_msg);
                    ?>
                    <p><?php echo $msg; ?></p>
                    <div class="btn-modal">
                        <a href="javascript:" onClick="document.location.href = '<?php echo base_url() . $lang_id; ?>/contact'" class="floatright1 block_bttn1 btn btn-primary btn-sm"><?php echo $general_instruction->ok; ?> <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>