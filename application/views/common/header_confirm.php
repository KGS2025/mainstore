<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]>
<html class="no-js" lang="en"> <![endif]-->
<html dir="<?php echo getContentPosition($lang_id);?>" lang="<?php echo $lang_id; ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
            <?php
            if (isset($title)) {
                echo $title;
            }
            ?>
        </title>
    <?php
            $ASSET_VERSION = getenv('ASSET_VERSION');
            if (isset($all_data['fevicon']) && $all_data['fevicon'] != '') {

                $fevicon = global_img_link($all_data['fevicon'], 'uploads/logo/thumbnails/');
                ?>

               <link rel="icon" href="<?php echo $fevicon; ?>" type="image/png" />
                <?php
            } else {
                ?>
               <link rel="icon" href="<?php echo base_url() ?>favicon.ico" type="image/x-icon" >
            <?php } ?>
    <base href="<?php echo base_url(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/estorefont.css?version='.$ASSET_VERSION);?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/estore-strap-select.css?version='.$ASSET_VERSION);?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/style.css?version='.$ASSET_VERSION);?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/style_repos.css?version='.$ASSET_VERSION);?>" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/avstyles.css?version='.$ASSET_VERSION);?>" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/flipclock.css?version='.$ASSET_VERSION); ?>"
          media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/msdropdown/flags.css?version='.$ASSET_VERSION);?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/estore-light.css?version='.$ASSET_VERSION);?>" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/avstyles.css?version='.$ASSET_VERSION);?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url() . 'assets/frontend/css/header-confirm.css'; ?>"> 
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/cart-confirm.css?version='.$ASSET_VERSION); ?>">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <?php echo get_file_lang ('assets/frontend/js/', 'style.js', $lang_id ,'js'); ?>
    <?php echo get_file_lang ('assets/frontend/css/', 'style.css', $lang_id ,'css'); ?>
    <?php $this->load->view('elements/dynamic_colors'); ?>
</head>
<body >
    <div id="loading" style="display:none;">
        <div class="loadingContent">
            <img src="<?php echo asset_url('assets/frontend/images/spin-loader.svg'); ?>" />   
            <p><?php echo $general_instruction->please_wait_verifing_information; ?></p>
        </div>
    </div>
    <div class="container varify-submit-page">


    