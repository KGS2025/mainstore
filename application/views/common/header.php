<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]>
<html class="no-js" lang="en"> <![endif]-->
<?php 
setBrowserCountryCode();
$contentView = getContentPosition($lang_id);
?>
<html dir="<?= $contentView;?>" lang="<?php echo $lang_id; ?>">
    <head>

        <script type="text/javascript">
        var time_digits = <?php echo json_encode(getTimeDigits());?>;
        </script>

        <?php $ASSET_VERSION = getenv('ASSET_VERSION'); ?>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> <?php if (isset($title)) { echo $title; } ?> </title>
        <?php if (isset($all_data['fevicon']) && $all_data['fevicon'] != '') {
            $fevicon = asset_url()."assets/uploads/logo/thumbnails/".$all_data['fevicon']; ?>
            <link rel="icon" href="<?php echo $fevicon; ?>" type="image/x-icon" />
        <?php } else { ?>
            <link rel="icon" href="<?php echo base_url() ?>favicon.ico" type="image/x-icon" />
        <?php } ?>

        <base href="<?php echo  base_url(); ?>">
        <!-- beware of these lines order. Changing the order of some of those lines could affect or cause the entire site to malfunctioning -->
        <!--  <link href="<?php echo asset_url('assets/frontend/css/estorestrap5.min.css?version='.$ASSET_VERSION); ?>" rel="stylesheet">-->
        <link rel="stylesheet" href="<?php echo asset_url('assets/frontend/css/estorestrap5.min.css?version='.$ASSET_VERSION); ?>" />
        <link rel="stylesheet" type="text/css" class="custom-css" data-href="<?php echo asset_url('assets/frontend/css/estorefont-min.css?version='.$ASSET_VERSION); ?>" media="screen">
        <!-- <link rel="stylesheet" type="text/css" href="<?php // echo asset_url('assets/frontend/css/estore-strap-min.css?version='.$ASSET_VERSION); ?>" media="screen"> -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/main.css?version='.$ASSET_VERSION); ?>" media="screen">


        <link rel="stylesheet" type="text/css" class="custom-css" data-href="<?php echo asset_url('assets/frontend/js/estore-ui/estore-ui-min.css?version=?'.$ASSET_VERSION); ?>" media="screen">
        <link rel="stylesheet" type="text/css" class="custom-css" data-href="<?php echo asset_url('assets/frontend/css/msdropdown/dd.css?version='.$ASSET_VERSION); ?>" media="screen">
       
        <link rel="stylesheet" type="text/css" class="custom-css" data-href="<?php echo asset_url('assets/frontend/css/flipclock-min.css?version='.$ASSET_VERSION); ?>" media="screen">
        <link rel="stylesheet" type="text/css" class="custom-css" data-href="<?php echo asset_url('assets/frontend/css/search-bar.css?version='.$ASSET_VERSION); ?>" media="screen">

         <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />


        <?php if(isset($pageType) && ($pageType == 'page' || $pageType == 'products' || $pageType == 'entry_door' || $pageType == 'cart' || $pageType == 'home' || $pageType == 'contact' || $pageType == 'signup')){ ?>
        <link rel="stylesheet" type="text/css" class="custom-css" data-href="<?php echo asset_url('assets/frontend/css/msdropdown/flags-min.css?version='.$ASSET_VERSION); ?>" />
        <link rel="stylesheet" type="text/css" class="custom-css" data-href="<?php echo asset_url('assets/frontend/css/estore-light-min.css?version='.$ASSET_VERSION); ?>" media="screen">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">


        <?php } ?>

        <?php if(isset($pageType) && ($pageType == 'entry_door' || $pageType == 'signup')){ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/entry_door.css'); ?>">
        <?php } ?>



        <?php if(isset($pageType) && $pageType == 'productmaker'){ ?>
        <link rel="stylesheet" type="text/css" class="custom-css" data-href="<?php echo asset_url('assets/frontend/css/product-maker-min.css?version='.$ASSET_VERSION); ?>" >
        <?php } ?>

        <?php if(isset($pageType) && $pageType == 'productmodel'){ ?>
        <link rel="stylesheet" type="text/css" class="custom-css" data-href="<?php echo asset_url('assets/frontend/css/product-model.css?version='.$ASSET_VERSION); ?>" > 
        <?php } ?>

        <?php if(isset($pageType) && $pageType == 'productitems'){ ?>
        <link rel="stylesheet" type="text/css" class="custom-css" data-href="<?php echo asset_url('assets/frontend/css/product-items.css?version='.$ASSET_VERSION); ?>" > 
        <?php } ?>

        <?php if(isset($pageType) && $pageType == 'productlist'){ ?>
        <link rel="stylesheet" type="text/css" class="custom-css" data-href="<?php echo asset_url('assets/frontend/css/product-list.css?version='.$ASSET_VERSION); ?>" >
        <link rel="stylesheet" type="text/css" class="custom-css" data-href="<?php echo asset_url('assets/frontend/css/estore-light-min.css?version='.$ASSET_VERSION); ?>" media="screen">
        <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/plugins/slick/slick/slick.css?version='.$ASSET_VERSION); ?>" media="screen">
        
      
        <?php } ?>

        <?php if(isset($pageType) && ($pageType == 'cart') ){ ?>
        <link rel="stylesheet" type="text/css" class="custom-css" data-href="<?php echo asset_url('assets/frontend/css/cart.css?version='.$ASSET_VERSION); ?>">
        <link rel="stylesheet" type="text/css" class="custom-css" data-href="<?php echo asset_url('assets/frontend/css/estore-light-min.css?version='.$ASSET_VERSION); ?>" media="screen">
        <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/plugins/slick/slick/slick.css?version='.$ASSET_VERSION); ?>" media="screen">


        <?php } ?>

        <?php if(isset($pageType) && ($pageType == 'paymentproof' || $pageType == 'stripepayment' || $pageType == 'paymeepayment' || $pageType == 'squareup' || $pageType == 'clictopay' )){ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/stripe.css?version='.$ASSET_VERSION); ?>" >
        <?php } ?>

        <?php if(isset($pageType) && $pageType == 'bamboopayment'){ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/stripe.css?version='.$ASSET_VERSION); ?>" >
  
        <?php } ?>

        <?php if(isset($pageType) && $pageType == 'moneris'){ ?>

        <link rel="stylesheet" type="text/css" href="<?php echo asset_url('assets/frontend/css/stripe.css?version='.$ASSET_VERSION); ?>" >

  
        <?php } ?>
        
        <?php $this->load->view('elements/dynamic_colors'); ?>
            <style>
                .lds-ellipsis {
                display: inline-block;
                position: relative;
                width: 80px;
                height: 80px;
                }
                .lds-ellipsis div {
                position: absolute;
                top: 0px;
                width: 13px;
                height: 13px;
                border-radius: 50%;
                animation-timing-function: cubic-bezier(0, 1, 1, 0);
                }
                .lds-ellipsis div:nth-child(1) {
                left: 8px;
                animation: lds-ellipsis1 0.6s infinite;
                }
                .lds-ellipsis div:nth-child(2) {
                left: 8px;
                animation: lds-ellipsis2 0.6s infinite;
                }
                .lds-ellipsis div:nth-child(3) {
                left: 32px;
                animation: lds-ellipsis2 0.6s infinite;
                }
                .lds-ellipsis div:nth-child(4) {
                left: 56px;
                animation: lds-ellipsis3 0.6s infinite;
                }
                @keyframes lds-ellipsis1 {
                0% {
                    transform: scale(0);
                }
                100% {
                    transform: scale(1);
                }
                }
                @keyframes lds-ellipsis3 {
                0% {
                    transform: scale(1);
                }
                100% {
                    transform: scale(0);
                }
                }
                @keyframes lds-ellipsis2 {
                0% {
                    transform: translate(0, 0);
                }
                100% {
                    transform: translate(24px, 0);
                }
            }
        </style>
    </head>

    <body>
        <div id="loading" style="display: none;" class="common-loading commonLoader">
            <div class="loadingContent loaderContent">
		<!-- <img src="<?php echo asset_url('assets/frontend/images/spin-loader.svg'); ?>" />   -->
                <?php if (isset($all_data['common_loader_img']) && $all_data['common_loader_img']) { ?> 
                    <img width="200" height="auto" class="mb-4" src="<?= asset_url().'assets/uploads/'.$all_data['common_loader_img'];?>" />   
                <?php } else { ?>
                    <img src="<?php echo asset_url('assets/frontend/images/spin-loader.svg'); ?>" /> 
                <?php } ?>
                <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                <p></p>
            </div>
        </div>
        
        <div class="commonLoader">
            <div class="loaderContent">
                <?php if (isset($all_data['common_loader_img']) && $all_data['common_loader_img']) { ?> 
                    <img width="200" height="auto" class="mb-4" src="<?= asset_url().'assets/uploads/'.$all_data['common_loader_img'];?>" />   
                <?php } else { ?>
                    <img src="<?php echo asset_url('assets/frontend/images/spin-loader.svg'); ?>" /> 
                <?php } ?>
                <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
            </div>
        </div>

        <?php if (isset($all_data['main_background_image']) && $all_data['main_background_image']) { ?>
            <div class="bodywrapper" style="background:url(<?php echo asset_url() ?>assets/uploads/background/full/<?php echo $all_data['main_background_image']; ?>) center top no-repeat, no-repeat left bottom; background-size: 100% 500px, auto; background-color: #<?php echo $all_data['select_background_color'];?>">
        <?php } else { ?>
            <div class="bodywrapper" style="background-size: 100% 500px, auto; background-color: #<?php echo $all_data['select_background_color'];?>;">
        <?php } ?>

        <?php $default_image = getNoImage('default-image'); $this->session->set_userdata(array('default_image' => $default_image)); ?>
        
        <?php if($this->config->item('menu_theme_settings')==1){?>
            <?php include 'menu_new1.php'; ?>
        <?php }else{?>
            <?php include 'menu.php'; ?>
        <?php }?>
