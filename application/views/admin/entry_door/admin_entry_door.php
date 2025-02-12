<?php
if (!empty($admin_users_data)) {
    $bal_time = time() - $admin_users_data['created_time'];
    $bal_count_time = $admin_door_timer->main_admin_door_timer['front'] * 60 - $bal_time;
    if ($bal_count_time > 0) {
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                var time = '<?php echo $bal_count_time; ?>';
                blink(1);
                runCountDownClock('timer5', time);
            });
        </script>
    <?php }
} ?>
<script>
    var eCode = '<?php echo getRandomCode();?>';
    var sCode = '<?php echo getRandomCode();?>';
    var main_admin_door_timer = '<?php echo $admin_door_timer->main_admin_door_timer['front'] * 60; ?>';
</script>
<script src="<?php echo asset_url('assets/admin/js/login.js?version='.getenv('ASSET_VERSION')) ?>" type="text/javascript"></script>
<!-- Main wrapper -->
<?php $logoimage = getAdminLogo(); ?>
<div>
    <div class="entry_door">
        <center><a href="<?php echo base_url(); ?>admin/<?php echo $lang_id; ?>/index/dashboard"><img src="<?php echo $logoimage; ?>" width="250" alt="LOGO"></a></center>
        <div class="ddl">
            <!-- language end -->
            <div class="box">
                <div class="language_container">
                    <div id="polyglotLanguageSwitcher1">
                        <dl id="sample" class="dropdown">
                            <dt><a href="javascript:void(0);" onclick="return false;"><span>
                                        <?php
                                        if (isset($country_data) && !empty($country_data)) {
                                            foreach ($country_data as $set_data) {
                                                if ($set_data['short_code'] == $lang_id) {
                                                    if (isset($set_data['image']) && ($set_data['image'] != '' || $set_data['image'] != NULL)) {
                                                        echo '<img class="" src="' . asset_url('assets/uploads/country/thumbnails/'.$set_data['image']) . '" alt="' . $set_data['name'] . '" height="11" width="16"/>'. ' '.$set_data['name'];
                                                    } else {
                                                        echo $set_data['name'];
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </span></a></dt>
                            <dd>
                                <ul>
                                    <?php
                                    if (isset($country_data) && !empty($country_data)) {
                                    

                                        foreach ($country_data as $set_data) {
                                            if ($set_data['status'] == 1) {
                                                
                                                ?>

                                                                                <li>

                                                                                    <a href="<?= base_url() . 'admin/' . $set_data['short_code']; ?>/entry_door"> 
                                                    <?php if (isset($set_data['image']) && ($set_data['image'] != '' || $set_data['image'] != NULL)) { ?>
                                                                                                    <img class=""
                                                                                                        src="<?= asset_url('assets/uploads/country/thumbnails/'.$set_data['image']) ?>"
                                                                                                        alt="<?= $set_data['name'] ?>" height="11" width="16"/>
                                                    <?php } ?>
                                                    <?= $set_data['name']; ?>
                                                                                    </a>

                                                                                </li>

                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
<!--    <a href="#" title="" class="login-logo"><img src="logoc4ca.png?1" width="75%" alt=""/></a><br/>
<br/> -->
        <!-- Login block -->
        <div class="well" style="margin-bottom:20px;">
            <div class="navbar float-start w-100">
                <div class="navbar-inner w-100">
                    <h6><i class="font-user"></i><?php echo $admin_static_links['admin_entry_door_text']['front']; ?></h6>
                </div>
            </div>

            <div class="alert-message block-message warning kgtmargin" style="text-align:center;">
                <?php if (isset($bal_count_time) && $bal_count_time != '' && $bal_count_time > 0) { ?>
                    <div class="entry_door_counter counter_msg_wrap"><?php echo $admin_door_timer->main_admin_door_msg['front']; ?></div> 
                <?php } else { ?>
                    <div class="entry_door_counter counter_msg_wrap"></div> 
                <?php } ?>
                <div class="counter_msg_wrap_counter">
                    <div id="timer5"></div>
                </div>
                <div class="clear"></div>
            </div>
            <?php $emailmessage = $this->session->flashdata('message'); ?>
            <?php if (isset($emailmessage) && $emailmessage != '') { ?>
                <div class="kgtmargin" style="text-align:center;">
                    <p><?php echo $emailmessage; ?></p>
                </div>
            <?php } ?>
            <form action="<?php echo base_url() .'admin/' . $lang_id . '/'; ?>entry_door/send_verification_code" id="entry_door_form" method="POST" class="row-fluid" autocomplete = "off">
                <input type="hidden" value="submit" name="button_checkings" id="button_checkings">
                <input type="hidden" value="<?php echo $email_attempt; ?>" id="email_attempt" name="email_attempt">
                <input type="hidden" value="<?php echo $sms_attempt; ?>" id="sms_attempt" name="sms_attempt">
                <input type="hidden" id="admin_door_block_timer" name="admin_door_block_timer" value="<?php echo $admin_door_timer->admin_door_block_timer['front']; ?>" />
                <?php /*
                <div class="control-group">
                    <label class="control-label"><?php echo $cart_instruction->title['front']; ?></label>
                    <div class="controls">
                        <!-- <select class="span12" name="title" id="title">
                            <option value="Mr." data-title="<?php echo $cart_instruction->mr_title['front']; ?>" <?php if ($admin_users_data['title'] == $cart_instruction->mr_title['front']) { ?> selected="selected"<?php } ?>><?php echo $cart_instruction->mr_title['front']; ?></option>
                            <option value="Ms." data-title="<?php echo $cart_instruction->ms_title['front']; ?>" <?php if ($admin_users_data['title'] == $cart_instruction->ms_title['front']) { ?> selected="selected"<?php } ?>><?php echo $cart_instruction->ms_title['front']; ?></option>
                        </select> -->
                        
                        <input type="radio" name="title" value="Mr." <?php if (isset($admin_users_data['title']) && $admin_users_data['title'] == 'Mr.') { ?> checked="checked"<?php } ?>/>&nbsp;<?php echo $cart_instruction->mr_title['front']; ?>&nbsp;&nbsp;
                        <input type="radio" name="title" value="Miss." <?php if (isset($admin_users_data['title']) && $admin_users_data['title'] == 'Miss.') { ?> checked="checked"<?php } ?>/>&nbsp;<?php echo $cart_instruction->ms_title['front']; ?>&nbsp;&nbsp;
                        <input type="radio" name="title" value="Other" <?php if (isset($admin_users_data['title']) && $admin_users_data['title'] == 'Other') { ?> checked="checked"<?php } ?>/>&nbsp;<?php echo $cart_instruction->other_title['front']; ?>&nbsp;&nbsp;

                        <?php echo form_error('title'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo $cart_instruction->first_name['front']; ?>:</label>

                    <div class="controls">
                        <input type="text" class="span12" name="first_name" id="first_name" placeholder="<?php echo $cart_instruction->first_name['front']; ?>" value="<?php echo isset($admin_users_data['first_name']) ? $admin_users_data['first_name'] : '' ?>"></div>
                </div>
                        <?php echo form_error('name'); ?>
                <div class="control-group">
                    <label class="control-label"><?php echo $cart_instruction->last_name['front']; ?>:</label>

                    <div class="controls">
                        <input type="text" class="span12" name="last_name" id="last_name" placeholder="<?php echo $cart_instruction->last_name['front']; ?>" value="<?php echo isset($admin_users_data['last_name']) ? $admin_users_data['last_name'] : '' ?>"></div>
                </div>
                        <?php echo form_error('name'); ?>
                */ ?>
                <div class="control-group">
                    <label class="control-label"><?php echo $cart_instruction->country['front']; ?>:</label>

                    <div class="controls" style="position:relative;">
                        <?php $cart_users_country = isset($admin_users_data['country']) ? $admin_users_data['country'] : ''; ?>
                        <select name="country" id="country" class="span12 selectpicker1 kgt2" autocomplete="no-fill">
                            <?php foreach ($countries as $country) { ?>
                                <option value='<?php echo htmlentities($country['countryName'], ENT_QUOTES); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>"  <?php if (isset($ip_data['countryCode'])  && $ip_data['countryCode'] == strtoupper($country['alpha_2'])) { ?>selected="selected" <?php } else if (isset($cart_users_country) && $cart_users_country != '' && $cart_users_country == $country['lang_countryName']) { ?>selected="selected"<?php } else if (isset($cart_users_country) && $cart_users_country != '' && $cart_users_country == $country['countryName']) { ?>selected="selected"<?php } else if (isset($country['countryName']) && $country['countryName'] == "Canada") { ?> selected="selected"<?php } else if ($country['lang_countryName'] == "Canada") { ?>selected="selected" <?php } ?>> <?php echo $country['countryName']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="hidden" name="country_flag" id="country_flag"/>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo $cart_instruction->cellphone['front']; ?>:</label>

                    <div class="controls">
                        <input type="text" class="span3" id="country_code" placeholder="+1" name="country_code" value="+<?php echo isset($admin_users_data['country_code']) ? $admin_users_data['country_code'] : '1' ?>" required readonly autocomplete="no-fill">
                        <?php if (!isset($admin_users_data['admin_sms_confirm']) || (isset($admin_users_data['admin_sms_confirm']) && $admin_users_data['admin_sms_confirm'] != 1)) { ?>
                            <input type="text" class="span9" id="telephone" autocomplete="nope" placeholder="<?php echo $cart_instruction->cellphone['front']; ?>" name="telephone" value="<?php echo isset($admin_users_data['telephone']) ? $admin_users_data['telephone'] : '' ?>" required>
                        <?php } else { ?>
                            <input type="text" class="span9" id="telephone" autocomplete="nope" placeholder="<?php echo $cart_instruction->cellphone['front']; ?>" name="telephone" value="<?php echo isset($admin_users_data['telephone']) ? $admin_users_data['telephone'] : '' ?>" required readonly>
                        <?php } ?>
                    </div>
                        <?php echo form_error('telephone'); ?>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo $cart_instruction->email['front']; ?>:</label>

                    <div class="controls">
                        <?php if (!isset($admin_users_data['admin_email_confirm']) || (isset($admin_users_data['admin_email_confirm']) && $admin_users_data['admin_email_confirm'] != 1)) { ?>
                            <input type="text" class="span12" id="email" autocomplete="nope" placeholder="<?php echo $cart_instruction->email['front']; ?>" name="email" value="<?php if (count($admin_users_data) > 0) echo isset($admin_users_data['email']) ? $admin_users_data['email'] : '' ?>" required autocomplete="off">
                        <?php } else { ?>
                            <input type="text" class="span12" id="email" autocomplete="nope" placeholder="<?php echo $cart_instruction->email['front']; ?>" name="email" value="<?php if (count($admin_users_data) > 0) echo isset($admin_users_data['email']) ? $admin_users_data['email'] : '' ?>" required autocomplete="off" readonly>
                        <?php } ?>
                        <span class="red1"><?php echo form_error('email'); ?></span>
                    </div>
                        <?php echo form_error('password'); ?>
                </div>
                 <div class="control-group">
                    <label class="control-label">Enter Captcha:<br><div id="captImg"><?php echo generate_captcha();?></div></label>
                    <div class="controls">
                        <input type="text" class="span12" id="captcha" placeholder="Enter Captcha" name="captcha" value="" required autocomplete="off">
                        <span class="red1 trynewcaptcha" style="cursor: pointer;">Try new Captcha</span>
                    </div>
                </div>

                <div class="login-btn"><a href="javascript:void(0)" class="btn btn-info btn-block btn-large" id="entry_door_submit"><?php echo $general_instruction['sbmt']['front']; ?></a></div>
                <div style="text-align: center; padding-bottom: 10px; display: none;" id="forgotdetails"><a href="<?php echo base_url() .'admin/' . $lang_id . '/'; ?>entry_door/forgot_details">Forgot Details</a></div>
            </form>
<?php
if (isset($message) and $message != '') {
    echo '<span class="font12px">' . $message . '</span>';
} else if ($this->session->flashdata('success')) {
    $msg = $this->session->flashdata('success');
    echo '<span class="red3">' . $msg . '</span>';
} else if (isset($error) and $error != '') {
    echo '<span class="red3">' . $error . '</span>';
}
?>
        </div>
        <!-- /login block -->

    </div>

</div>
<!-- /main wrapper -->
<!--Modal shopping decision cart-->
<div class="modal fade" id="modal_mssg">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <h5 id="already_added_msg_title" class="title-modal"></h5> 
                    <p id="already_added_msg"></p>
                    <div class="btn-modal">                      
                        <?php if ($lang_id == 'ar') { ?>
                            <a href="javascript:void(0)" onClick="$('#modal_mssg').modal('hide');" class="floatright1 btn btn-primary  actn-btn rounded"><i class="fa fa-angle-left"></i><?php echo $general_instruction['ok']['front']; ?> </a>
                        <?php } else { ?>
                            <a href="javascript:void(0)" onClick="$('#modal_mssg').modal('hide');" class="floatright1 btn btn-primary  actn-btn rounded"><?php echo $general_instruction['ok']['front']; ?> <i class="fa fa-angle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="user_block_box">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <div class="box-content-modal">

                    <div class="blockElementWrap">
                        <div class="blockMsg" id="blockMsg"><?php echo lang('You Have Been Blocked.') ?>
                            <br> <?php echo lang('Please Try After 120 minutes.') ?></div>
                        <div id="edit_cart_mode_on" class="displaynon"></div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <div class="row">

                            <div class="col-md-12 col-xs-12 text-right">
                                
                                <?php if ($lang_id == 'ar') { ?>
                                    <a href="javascript:void(0)" onClick="redirect_edit_mode();" class="btn btn-primary  actn-btn rounded" id="block_confirm_msg"><i class="fa fa-angle-left"></i><?php echo $general_instruction['ok']['front']; ?> </a>
                                <?php } else { ?>
                                    <a href="javascript:void(0)" onClick="redirect_edit_mode();" class="btn btn-primary  actn-btn rounded" id="block_confirm_msg"><?php echo $general_instruction['ok']['front']; ?> <i class="fa fa-angle-right"></i></a>
                                <?php } ?>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="notify_submit">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">

                <div class="box-content-modal">
                    <form action="#" id="entry_verification_form" method="post" autocomplete="off">                       
                        <?php
                        $telephonevar = isset($entry_users_data) ? '+' . $entry_users_data['country_code'] . $entry_users_data['telephone'] : '';
                        $verificationvar = ["EMAILVAR", "SMSVAR"];
                        $verificationfinalvar = isset($entry_users_data['email']) ? [$entry_users_data['email'], $telephonevar] : '';
                        $verification_message = str_replace($verificationvar, $verificationfinalvar, $cart_instruction->verification_code_to_email_and_sms['front']);
                        ?> 
                        <h5 class="title-modal kgt42" id="email_sms_confirm"><?php echo $verification_message; ?></h5>   
                        <?php $verification_message = isset($entry_users_data['email']) ? str_replace('EMAILVAR', $entry_users_data['email'], $cart_instruction->verification_code_to_email['front']) : ''; ?>
                        <h5 class="title-modal kgt42 displaynon" id="email_confirm"><?php echo $verification_message; ?></h5>
                        <?php
                        $telephonevar = isset($entry_users_data) ? '+' . $entry_users_data['country_code'] . $entry_users_data['telephone'] : '';
                        $verification_message = str_replace('SMSVAR', $telephonevar, $cart_instruction->verification_code_to_sms['front']);
                        ?>  
                        <h5 class="title-modal kgt42 displaynon" id="sms_confirm"><?php echo $verification_message; ?></h5>
                      

                        <div class="blink">
                            <div class="product_counter_msg counter_msg_wrap verfication_error_msg colorgray"></div>
                        </div>

                        <div class="alert-message block-message warning">
                            <div class="product_counter_msg counter_msg_wrap" id="pop_msg"></div>
                            <span class="displaynon" id="main_preview_timer"></span>
                        </div>
                        <div class="alert-message block-message warning">

                        </div>

                        <input type="hidden" id="valid_email" name="valid_email" value=""/>
                        <input type="hidden" id="valid_phone" name="valid_phone" value=""/>
                        <?php if (empty($admin_users_data) || (isset($admin_users_data['admin_email_confirm']) && $admin_users_data['admin_email_confirm'] != 1 && isset($admin_users_data['admin_sms_confirm']) && $admin_users_data['admin_sms_confirm'] != 1)) { ?> 
                            <div class="col-lg-12"> 
                                <div class="row">
                                    <div class="col"><label><?php echo $cart_instruction->enter_email_code['front']; ?>:</label></div>
                                    <div class="col"><input class="form-control" type="text" name="entry_verification_codemail" id="entry_verification_codemail"> </div>
                                </div>
                            </div>
                            <div class="col-lg-12"> 
                                <div class="row">
                                    <div class="col"><label><?php echo $cart_instruction->enter_sms_code['front']; ?>:</label></div>
                                    <div class="col"><input class="form-control" type="text" name="entry_verification_codesms" id="entry_verification_codesms"></div>
                                </div>
                            </div>                          
                        <?php } else if (isset($admin_users_data['admin_email_confirm']) && $admin_users_data['admin_email_confirm'] != 1) { ?>
                            <div class="col-lg-12"> 
                                <div class="row">
                                    <div class="col"><label><?php echo $cart_instruction->enter_email_code['front']; ?>: </label></div>
                                    <div class="col"><input class="form-control" type="text" name="entry_verification_codemail" id="entry_verification_codemail"></div>
                                </div>
                            </div>
                            <input type="hidden" name="entry_verification_codesms" value="<?php echo $admin_users_data['sms_code']; ?>" />
                        <?php } else if (isset($admin_users_data['admin_sms_confirm']) && $admin_users_data['admin_sms_confirm'] != 1) { ?>
                            <div class="col-lg-12"> 
                                <div class="row">
                                    <div class="col"><label><?php echo $cart_instruction->enter_sms_code['front']; ?>:</label></div>
                                    <div class="col"><input class="form-control" type="text" name="entry_verification_codesms" id="entry_verification_codesms"></div>
                                </div>
                            </div>
                            <input type="hidden" name="entry_verification_codemail" value="<?php echo $admin_users_data['email_code']; ?>" /> 
                        <?php } ?>

                        <div class="col-12">
                            <div class="row">
                                <div class="col">
                                    <div id="timer11"></div>
                                </div>
                                <div class="col">
                                <img class="loaderimagecontinue displaynon mb-5" src="<?php echo base_url();?>assets/frontend/images/loading.gif"
                                         alt="loaderimagecontinue"/>
                                </div>
                            </div>
                        </div>
                        <div class="btn-modal toyota-page">
                            <div class="row">
                                <div class="col-md-12">

                                    <!-- when user click to cancel the verification code popup then it allocates 1200 seconds in the cart preview. -->
                                    
                                    <?php if ($lang_id == 'ar') { ?>
                                        <a href="javascript:void(0);" onclick="cancel_popup_click();" id="cart_pop_cancel" class="btn btn-primary  actn-btn rounded"><i class="fa fa-angle-left"></i><?php echo $cart_instruction->cancel['front']; ?> </a>
                                    <?php } else { ?>
                                        <a href="javascript:void(0);" onclick="cancel_popup_click();" id="cart_pop_cancel" class="btn btn-primary  actn-btn rounded"><?php echo $cart_instruction->cancel['front']; ?> <i class="fa fa-angle-right"></i></a>
                                    <?php } ?>
                                </div>
                                <div class="col-md-12">
                                    
                                    <?php if ($lang_id == 'ar') { ?>
                                        <a href="javascript:void(0);" class="btn btn-primary  actn-btn rounded" id="resend_code"><i class="fa fa-angle-left"></i><?php echo $cart_instruction->resend['front']; ?> </a>
                                    <?php } else { ?>
                                        <a href="javascript:void(0);" class="btn btn-primary  actn-btn rounded" id="resend_code"><?php echo $cart_instruction->resend['front']; ?> <i class="fa fa-angle-right"></i></a>
                                    <?php } ?>
                                </div>
                                <div class="col-md-12">
                                    <?php if ($lang_id == 'ar') { ?>
                                        <a href="javascript:void(0);" class="btn btn-primary  actn-btn rounded" id="entry_verification_confirm"><i class="fa fa-angle-left"></i><?php echo $cart_instruction->confirm['front']; ?> </a>  
                                    <?php } else { ?>
                                        <a href="javascript:void(0);" class="btn btn-primary  actn-btn rounded" id="entry_verification_confirm"><?php echo $cart_instruction->confirm['front']; ?> <i class="fa fa-angle-right"></i></a>  
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
$telephonevar = isset($entry_users_data) ? '+' . $entry_users_data['country_code'] . $entry_users_data['telephone'] : '';
$invalidvar = ["EMAILVAR", "SMSVAR"];
$invalidfinalvar = isset($entry_users_data['email']) ? [$entry_users_data['email'], $telephonevar] : '';
$smsinvalid_message = str_replace($invalidvar, $invalidfinalvar, $cart_instruction->email_verified_sms_not['front']);
$emailinvalid_message = str_replace($invalidvar, $invalidfinalvar, $cart_instruction->sms_verified_email_not['front']);
$emailsmsinvalid_message = str_replace($invalidvar, $invalidfinalvar, $cart_instruction->email_and_sms_not_verified['front']);
?>
<div class="modal fade" id="invalid-phone">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">  
                    <h2 class="title-modal kgt42"><?php echo $smsinvalid_message; ?></h2> 
                    <div class="btn-modal toyota-page">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <?php if ($lang_id == 'ar') { ?>
                                    <a href="<?php echo base_url() .'admin/' . $lang_id . '/'; ?>entry_door" class="btn btn-primary  actn-btn rounded"><i class="fa fa-angle-left"></i><?php echo $general_instruction['edit']['front']; ?></a>
                                <?php } else { ?>
                                    <a href="<?php echo base_url() .'admin/' . $lang_id . '/'; ?>entry_door" class="btn btn-primary  actn-btn rounded"><?php echo $general_instruction['edit']['front']; ?><i class="fa fa-angle-right"></i></a>
                                <?php } ?>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<div class="modal fade" id="invalid-email">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">  
                    <h2 class="title-modal kgt42"><?php echo $emailinvalid_message; ?></h2> 
                    <div class="btn-modal toyota-page">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <?php if ($lang_id == 'ar') { ?>
                                    <a href="<?php echo base_url() . 'admin/' . $lang_id . '/'; ?>entry_door" class="btn btn-primary  actn-btn rounded"><i class="fa fa-angle-left"></i><?php echo $general_instruction['edit']['front']; ?></a>
                                <?php } else { ?>
                                    <a href="<?php echo base_url() . 'admin/' . $lang_id . '/'; ?>entry_door" class="btn btn-primary  actn-btn rounded"><?php echo $general_instruction['edit']['front']; ?><i class="fa fa-angle-right"></i></a>
                                <?php } ?>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<div class="modal fade" id="invalid-email-phone">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">  
                    <h2 class="title-modal kgt42"><?php echo $emailsmsinvalid_message; ?></h2> 
                    <div class="btn-modal toyota-page">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <?php if ($lang_id == 'ar') { ?>
                                    <a href="<?php echo base_url() . 'admin/' . $lang_id . '/'; ?>entry_door" class="btn btn-primary  actn-btn rounded"><i class="fa fa-angle-left"></i><?php echo $general_instruction['edit']['front']; ?></a>
                                <?php } else { ?>
                                    <a href="<?php echo base_url() . 'admin/' . $lang_id . '/'; ?>entry_door" class="btn btn-primary  actn-btn rounded"><?php echo $general_instruction['edit']['front']; ?><i class="fa fa-angle-right"></i></a>
                                <?php } ?>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Modal shopping decision cart-->
<div class="modal fade" id="modal_success">
    <div class="modal-dialog modal-dialog-centered text-center">
        <div class="modal-content">

            <div class="modal-body">
                <div class="box-content-modal">
                    <h5 class="title-modal"><?php echo $cart_instruction->thankyou_entry_door['front']; ?></h5>

                    <p><?php echo isset($cart_instruction->admin_door_confirm_text['front']) ? $cart_instruction->admin_door_confirm_text['front'] : ''; ?></p>

                    <div class="btn-modal mt-3">
                        
                        <?php if ($lang_id == 'ar') { ?>
                            <a href="javascript:void(0)" onClick="$('#modal_success').modal('hide'); window.location.href = '<?php echo base_url() .'admin/' . $lang_id . '/'; ?>index'" class="floatright1 btn btn-primary  actn-btn rounded"><i class="fa fa-angle-left"></i><?php echo $general_instruction['ok']['front']; ?> </a>
                        <?php } else { ?>
                            <a href="javascript:void(0)" onClick="$('#modal_success').modal('hide'); window.location.href = '<?php echo base_url() .'admin/' . $lang_id . '/'; ?>index'" class="floatright1 btn btn-primary  actn-btn rounded"><?php echo $general_instruction['ok']['front']; ?> <i class="fa fa-angle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<span class="displaynon" id="fd_main_block_msg"><?php if (isset($selection_instruction->fd_main_block_msg['front'])) echo $selection_instruction->fd_main_block_msg['front']; ?></span>
<span class="displaynon" id="fd_edit_block_msg"><?php if (isset($selection_instruction->fd_edit_block_msg['front'])) echo $selection_instruction->fd_edit_block_msg['front']; ?></span>
<span class="displaynon" id="fd_verification_block_msg"><?php if (isset($selection_instruction->fd_verification_block_msg['front'])) echo $selection_instruction->fd_verification_block_msg['front']; ?></span>
<span class="displaynon" id="fd_verification_resent_block_msg"><?php if (isset($selection_instruction->fd_verification_resent_block_msg['front'])) echo $selection_instruction->fd_verification_resent_block_msg['front']; ?></span>
<span class="displaynon" id="fd_verification_resent_block_msg_sms"><?php if (isset($selection_instruction->fd_verification_resent_block_msg_sms['front'])) echo $selection_instruction->fd_verification_resent_block_msg_sms['front']; ?></span>
<span class="displaynon" id="fd_verification_resent_block_msg_email_sms"><?php if (isset($selection_instruction->fd_verification_resent_block_msg_email_sms['front'])) echo $selection_instruction->fd_verification_resent_block_msg_email_sms['front']; ?></span>
<span class="displaynon" id="fd_verification_wrong_block_msg"><?php if (isset($selection_instruction->fd_verification_wrong_block_msg['front'])) echo $selection_instruction->fd_verification_wrong_block_msg['front']; ?></span>
<span class="displaynon" id="fd_verification_wrong_block_msg_sms"><?php if (isset($selection_instruction->fd_verification_wrong_block_msg_sms['front'])) echo $selection_instruction->fd_verification_wrong_block_msg_sms['front']; ?></span>
<span class="displaynon" id="fd_verification_wrong_block_msg_email_sms"><?php if (isset($selection_instruction->fd_verification_wrong_block_msg_email_sms['front'])) echo $selection_instruction->fd_verification_wrong_block_msg_email_sms['front']; ?></span>
<span class="displaynon" id="fd_block_notification_msg"><?php if (isset($selection_instruction->fd_block_notification_msg['front'])) echo $selection_instruction->fd_block_notification_msg['front']; ?></span>
<span class="displaynon" id="fd_block_notification_msg_sms"><?php if (isset($selection_instruction->fd_block_notification_msg_sms['front'])) echo $selection_instruction->fd_block_notification_msg_sms['front']; ?></span>
<span class="displaynon" id="fd_block_notification_msg_email_sms"><?php if (isset($selection_instruction->fd_block_notification_msg_email_sms['front'])) echo $selection_instruction->fd_block_notification_msg_email_sms['front']; ?></span>

<span class="displaynon" id="please_wait"><?php if (isset($general_instruction['please_wait']['front'])) echo $general_instruction['please_wait']['front']; ?></span>
<span class="displaynon" id="hours"><?php if (isset($general_instruction['hours']['front'])) echo $general_instruction['hours']['front']; ?></span>
<span class="displaynon" id="minutes"><?php if (isset($general_instruction['minutes']['front'])) echo $general_instruction['minutes']['front']; ?></span>
<span class="displaynon" id="seconds"><?php if (isset($general_instruction['seconds']['front'])) echo $general_instruction['seconds']['front']; ?></span>

<span class="displaynon" id="formvalidation_title"><?php if (isset($form_validation_instruction->popup_title['front'])) echo $form_validation_instruction->popup_title['front']; ?></span>
<span class="displaynon" id="formvalidation_name"><?php if (isset($form_validation_instruction->name['front'])) echo $form_validation_instruction->name['front']; ?></span>
<span class="displaynon" id="formvalidation_country"><?php if (isset($form_validation_instruction->country['front'])) echo $form_validation_instruction->country['front']; ?></span>
<span class="displaynon" id="formvalidation_telephone"><?php if (isset($form_validation_instruction->telephone['front'])) echo $form_validation_instruction->telephone['front']; ?></span>
<span class="displaynon" id="formvalidation_telephone_numeric"><?php if (isset($form_validation_instruction->telephone_numeric['front'])) echo $form_validation_instruction->telephone_numeric['front']; ?></span>
<span class="displaynon" id="formvalidation_email"><?php if (isset($form_validation_instruction->email['front'])) echo $form_validation_instruction->email['front']; ?></span>
<span class="displaynon" id="formvalidation_valid_email"><?php if (isset($form_validation_instruction->valid_email['front'])) echo $form_validation_instruction->valid_email['front']; ?></span>
<span class="displaynon" id="email_and_sms_blank"><?php if (isset($form_validation_instruction->email_and_sms_blank['front'])) echo $form_validation_instruction->email_and_sms_blank['front']; ?></span>
<span class="displaynon" id="email_blank"><?php if (isset($form_validation_instruction->email_blank['front'])) echo $form_validation_instruction->email_blank['front']; ?></span>
<span class="displaynon" id="sms_blank"><?php if (isset($form_validation_instruction->sms_blank['front'])) echo $form_validation_instruction->sms_blank['front']; ?></span>
<span class="displaynon" id="resend_email_attempt"><?php if (isset($form_validation_instruction->resend_email_attempt['front'])) echo $form_validation_instruction->resend_email_attempt['front']; ?></span>
<span class="displaynon" id="resend_sms_attempt"><?php if (isset($form_validation_instruction->resend_sms_attempt['front'])) echo $form_validation_instruction->resend_sms_attempt['front']; ?></span>
<span class="displaynon" id="wrong_email_code_attempt"><?php if (isset($form_validation_instruction->wrong_email_code_attempt['front'])) echo $form_validation_instruction->wrong_email_code_attempt['front']; ?></span>
<span class="displaynon" id="wrong_sms_code_attempt"><?php if (isset($form_validation_instruction->wrong_sms_code_attempt['front'])) echo $form_validation_instruction->wrong_sms_code_attempt['front']; ?></span>
<span class="displaynon" id="wrong_email_sms_code_attempt"><?php if (isset($form_validation_instruction->wrong_email_sms_code_attempt['front'])) echo $form_validation_instruction->wrong_email_sms_code_attempt['front']; ?></span>
<span class="displaynon" id="invalid_phone_not_email"><?php if (isset($form_validation_instruction->invalid_phone_not_email['front'])) echo $form_validation_instruction->invalid_phone_not_email['front']; ?></span>
<span class="displaynon" id="invalid_email_not_phone"><?php if (isset($form_validation_instruction->invalid_email_not_phone['front'])) echo $form_validation_instruction->invalid_email_not_phone['front']; ?></span>
<span class="displaynon" id="invalid_email_and_sms"><?php if (isset($form_validation_instruction->invalid_email_and_sms['front'])) echo $form_validation_instruction->invalid_email_and_sms['front']; ?></span>

<span class="displaynon" id="invalid_country_email_telephone"><?php if (isset($form_validation_instruction->invalid_country_email_telephone['front'])) echo $form_validation_instruction->invalid_country_email_telephone['front']; ?></span>
<span class="displaynon" id="invalid_email"><?php if (isset($form_validation_instruction->invalid_email['front'])) echo $form_validation_instruction->invalid_email['front']; ?></span>
<span class="displaynon" id="invalid_country_telephone"><?php if (isset($form_validation_instruction->invalid_country_telephone['front'])) echo $form_validation_instruction->invalid_country_telephone['front']; ?></span>
<span class="displaynon" id="invalid_title_firstname_lastname"><?php if (isset($form_validation_instruction->invalid_title_firstname_lastname['front'])) echo $form_validation_instruction->invalid_title_firstname_lastname['front']; ?></span>
<span class="displaynon" id="invalid_title_firstname"><?php if (isset($form_validation_instruction->invalid_title_firstname['front'])) echo $form_validation_instruction->invalid_title_firstname['front']; ?></span>
<span class="displaynon" id="invalid_title_lastname"><?php if (isset($form_validation_instruction->invalid_title_lastname['front'])) echo $form_validation_instruction->invalid_title_lastname['front']; ?></span>
<span class="displaynon" id="invalid_firstname_lastname"><?php if (isset($form_validation_instruction->invalid_firstname_lastname['front'])) echo $form_validation_instruction->invalid_firstname_lastname['front']; ?></span>
<span class="displaynon" id="invalid_title"><?php if (isset($form_validation_instruction->invalid_title['front'])) echo $form_validation_instruction->invalid_title['front']; ?></span>
<span class="displaynon" id="invalid_firstname"><?php if (isset($form_validation_instruction->invalid_firstname['front'])) echo $form_validation_instruction->invalid_firstname['front']; ?></span>
<span class="displaynon" id="invalid_lastname"><?php if (isset($form_validation_instruction->invalid_lastname['front'])) echo $form_validation_instruction->invalid_lastname['front']; ?></span>
<span class="displaynon" id="invalid_block_details"><?php if (isset($form_validation_instruction->invalid_block_details['front'])) echo $form_validation_instruction->invalid_block_details['front']; ?></span>
<span class="displaynon" id="invalid_fields"><?php if (isset($form_validation_instruction->invalid_fields['front'])) echo $form_validation_instruction->invalid_fields['front']; ?></span>
<span class="displaynon" id="server_error"><?php if (isset($form_validation_instruction->server_issue['front'])) echo $form_validation_instruction->server_issue['front']; ?></span>



<span class="displaynon" id="verification_code_to_email"><?php if (isset($cart_instruction->verification_code_to_email['front'])) echo $cart_instruction->verification_code_to_email['front']; ?></span>
<span class="displaynon" id="verification_code_to_sms"><?php if (isset($cart_instruction->verification_code_to_sms['front'])) echo $cart_instruction->verification_code_to_sms['front']; ?></span>
<span class="displaynon" id="verification_code_to_email_and_sms"><?php if (isset($cart_instruction->verification_code_to_email_and_sms['front'])) echo $cart_instruction->verification_code_to_email_and_sms['front']; ?></span>
<span class="displaynon" id="email_verified_sms_not"><?php if (isset($cart_instruction->email_verified_sms_not['front'])) echo $cart_instruction->email_verified_sms_not['front']; ?></span>
<span class="displaynon" id="sms_verified_email_not"><?php if (isset($cart_instruction->sms_verified_email_not['front'])) echo $cart_instruction->sms_verified_email_not['front']; ?></span>
<span class="displaynon" id="email_and_sms_not_verified"><?php if (isset($cart_instruction->email_and_sms_not_verified['front'])) echo $cart_instruction->email_and_sms_not_verified['front']; ?></span>
<span class="displaynon" id="invalid_captcha"><?php if (isset($cart_instruction->invalid_captcha['front'])) echo $cart_instruction->invalid_captcha['front']; ?></span>

</body>
</html>         
