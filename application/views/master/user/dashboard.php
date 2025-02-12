<div class="my-account-area py-3 py-sm-5">
    <div class="container">
        <div class="row">
            <!-- user dahboard sidebar-->
            <?php $this->load->view('elements/userdashboard-sidebar'); ?>
            <div class="col-12 col-md-9">
                <div class="my-account-content mb-50 h-100">
                    <div class="dashboardContent">
                        <p><strong><?php echo    str_replace('{user}',getnametitle($loginuserdata['salutation'])." ".$loginuserdata['surname'],$general_instruction->user_dashboard_name_label); ?></strong></p>
                        <p><?php echo $general_instruction->dashboard_text; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="gi_hours" value="<?php echo $general_instruction->hours; ?>">
<input type="hidden" id="gi_minutes" value="<?php echo $general_instruction->minutes; ?>">
<input type="hidden" id="gi_seconds" value="<?php echo $general_instruction->seconds; ?>">
<input type="hidden" id="server_time" value="<?php echo $timestamp; ?>">
