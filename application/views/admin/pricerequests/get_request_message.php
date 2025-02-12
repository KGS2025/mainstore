

<?php foreach ($all_messages as $single_message) {

?>
        <div class="col-12 w-100 float-start <?php if ($single_message['user_type'] == 'user') {?>
user_message <?php } else {?>  admin_message  <?php }?>">

        <div class="msg-cont"><?php echo htmlspecialchars_decode(stripslashes($single_message['message'])); ?>
        <span class="msg-info"><?php if ($single_message['user_type'] == 'user') {?> <?php echo $main_data['salutation']." ". $main_data['company']; ?>  <?php  echo date("y-m-d h:i:s",strtotime($single_message['createddate'])); } else { ?>  Admin  <?php  echo date("y-m-d h:i:s",strtotime($single_message['createddate'])); }?></span></div>
        </div>
<?php

}?>

