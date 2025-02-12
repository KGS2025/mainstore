<?php

if (count($front_validuser_data) == 0 || !empty($this->session->userdata('front_validuser_data'))) {
    $front_validuser_data = $this->session->userdata('front_validuser_data');
}

$loggedUserId = getFrontenduserId();
$loggedUserData = loginuserdata();
$this->session->unset_userdata('filter_option');

$cart_user_session_data = $this->session->userdata('cart_users_data');

$user_ip = "172.218.200.55";
$user_ip = getenv('REMOTE_ADDR');
// $this->session->unset_userdata('geoplugin_city');
$manual_postal_code = $this->session->userdata("manual_postal_code");
if($cart_user_session_data['cart_zip']==null){
	if($manual_postal_code){
		$this->session->set_userdata("geoplugin_postCode",substr($manual_postal_code,0,3));
		$this->session->set_userdata("geoplugin_latitude","1");
		$this->session->set_userdata("geoplugin_longitude","-1");
		$this->session->set_userdata("geoplugin_city","");
	}
	else if($this->session->userdata("geoplugin_city")==null){
		$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
		$lat = $geo['geoplugin_latitude'];
		$long = $geo['geoplugin_longitude'];
		$geoplugin = unserialize(file_get_contents("http://www.geoplugin.net/extras/postalcode.gp?lat=$lat&long=$long"));

		$this->session->unset_userdata("manual_postal_code");
		$this->session->set_userdata("geoplugin_postCode",$geoplugin['geoplugin_postCode']);
		$this->session->set_userdata("geoplugin_latitude",$geoplugin['geoplugin_latitude']);
		$this->session->set_userdata("geoplugin_longitude",$geoplugin['geoplugin_longitude']);
		$this->session->set_userdata("geoplugin_city",$geo['geoplugin_city']);
	}
}else{
	$this->session->unset_userdata("manual_postal_code");
	$this->session->set_userdata("geoplugin_postCode",substr($cart_user_session_data['cart_zip'],0,3));
	$this->session->set_userdata("geoplugin_city",$cart_user_session_data['cart_city']);
}


$this->session->set_userdata('browser_location',ucfirst($this->session->userdata("geoplugin_city"))."<br />".$this->session->userdata("geoplugin_postCode"));

//$this->session->set_userdata('browser_location','Burnaby V1C');
if ($loggedUserId) {
    $created_time = isset($front_validuser_data['created_time']) ? $front_validuser_data['created_time'] : 0;
    $timedata = get_user_lang_data(array('entry_door_timer'), $this->lang->default_lang_id, 'entry_door_shopping_timer')['entry_door_timer'];
    $bal_time = time() - $created_time;
    $time_diff = ($timedata['entry_door_shopping_timer'] * 60) - $bal_time;
    $remaining_time = $time_diff ? $time_diff : 0;
    $userName = $loggedUserData['salutation'] . " " . $loggedUserData['surname'] . " ";

    if ($this->config->item('enable_distributor_feature') == "1") {

        if ((empty($loggedUserData['ship_zip']) || empty($loggedUserData['ship_country'])) && $pageType != "profile") {
            redirect('user/profile');
        }

    }

    if ($remaining_time < 0) {

        redirect('cart/logout');
    }
} else {
    $remaining_time = isset($front_validuser_data['remaining_time']) ? $front_validuser_data['remaining_time'] : 0;
    $userName = isset($front_validuser_data['applicant']) ? $front_validuser_data['applicant'] : '';
}

$str = $lang_id . '/';
$uri_string = str_replace($str, '/', uri_string());

if ($userName) {
    $applicant = explode(" ", $userName);
    if ($applicant[0] == 'Mr.') {
        $userName = str_replace('Mr.', $cart_instruction->mr_title, $userName);
    } else if ($applicant == 'Miss.') {
        $userName = str_replace('Miss.', $cart_instruction->ms_title, $userName);
    } else if ($applicant == 'Other') {
        $userName = str_replace('Miss.', $cart_instruction->other_title, $userName);
    } 
}
 
?>
<?php
	$category_menu = getVehicleCategoryList($this->lang->default_lang_id);
	$brand_menu = $this->comman_model->get_maker_type_for_menu();				
?>
<input type="hidden" class="search-status" value="<?=isset($all_data['header_search_status']) ? $all_data['header_search_status'] : 0;?>">
<input type="hidden" class="quick-search-status" value="<?=isset($all_data['header_quick_search_status']) ? $all_data['header_quick_search_status'] : 0;?>">
<input type="hidden" class="hide_category" value="<?=isset($all_data['quick_search_hide_category']) ? $all_data['quick_search_hide_category'] : 0;?>">
<input type="hidden" class="show_search_radio" value="<?php echo $this->config->item('show_search_radio'); ?>">


<?php $sticky = ' fixed-top';
if (isset($pageType) && $pageType == 'products') {
    $sticky = ' fixed-top';
}?>
<header class="MainHeader1 ct-mainHeader<?=$sticky;?>" id="MainHeader" style="<?=$sticky ? 'padding: 0px;' : '';?>">
	<nav class="navbar navbar-expand-xl navbar-dark bg-dark fixed-topct-u-backgroundPureBlack big-hide py-0" style="background-color: #<?php echo $all_data['heder_background_color']; ?> !important;">
		<div class="container-fluid">
			<?php if (isset($all_data['header_logo_status']) && $all_data['header_logo_status'] == 1) {?>

				<?php if (isset($all_data['logo']) && $all_data['logo'] != '') {
    $logo = asset_url() . "assets/uploads/logo/thumbnails/" . $all_data['logo'];?>
					<a class="logo navbar-logo navbar-brand p-0" href="<?php echo $all_data['logo_url']; ?>" aria-label="header logo icon">
						<img src="<?php echo $logo; ?>" alt="<?php echo isset($all_data['title']) ? $all_data['title'] : ''; ?>" class="floatleft1" style="max-width: 150px;max-height: 70px;object-fit: cover;" />
					</a>
				<?php } else {?>
					<a class="logo navbar-logo navbar-brand p-0" href="<?php echo $all_data['logo_url']; ?>" aria-label="header logo icon">
						<img src="<?php echo asset_url('assets/uploads/logo/thumbnails/logo.png'); ?>" alt="34563456" class="floatleft1" style="max-width: 150px;max-height: 70px;object-fit: cover;" />
					</a>
				<?php }?>

			<?php }?>

			<?php if (isMobile()&&false) {?>
			<?php if (isset($remaining_time) && $remaining_time != '' && !front_on_checkout_verification(true)) {?>
				<div class="timer-wrap"> 
					<span><?php echo $general_instruction->header_shoppingtimer; ?></span>
					<div class="timer-info">( <span id="usertimer"></span> )</div>
				</div>
			<?php } ?>
<?php } ?>
			<div class="mobileToggleBtn d-flex">
				<?php if (isMobile()||true) {?>
					<ul class="navbar-nav showInMobile flex-row">
						<?php if (isset($pageType) && ($pageType != 'entry_door' && $pageType != 'stripepayment' && $pageType != 'bamboopayment' && $pageType != 'clictopay' && $pageType != 'paymeepayment' && $pageType != 'page' && $pageType != 'squareup')) {?>
							
						<?php							
						$price_request_product = check_price_request_count();
						if ($this->config->item('limited_price_option') == "1" && $price_request_product>0) {

    						

    ?>
							<li class="nav-item px-1 px-sm-2">
								<a href="<?php echo base_url() . $lang_id . '/user/' . 'addpricerequest'; ?>" title="<?php echo $general_instruction->price_request_menu; ?>" class="kgtcart position-relative qs-icon nav-link  <?php if (isset($pageType) && ($pageType == 'cart')) {
        echo "active"; }?>" id="cart_title">
									<i class="fa fa-usd" aria-hidden="true"></i>
									<span class="badge position-absolute price_request_count"><?php echo $price_request_product; ?></span>
									<label class="nav-label"><?php echo $general_instruction->price_request_menu; ?></label>
								</a>
							</li>
							<?php }?>

							<li class="nav-item px-1 px-sm-2">
								<a href="<?php echo base_url() . $lang_id . '/' . 'cart'; ?>" title="<?php echo $general_instruction->cart_menu_text; ?>" class="kgtcart position-relative qs-icon nav-link  <?php if (isset($pageType) && ($pageType == 'cart')) {
    echo "active";
}?>" id="cart_title">
									<i class="fa fa-shopping-cart" aria-hidden="true"></i>
									<span class="badge position-absolute cartcount"><?php echo $cartcount; ?></span>
									<label class="nav-label"><?php echo $general_instruction->cart_menu_text; ?></label>
								</a>
							</li>
							<li class="nav-item px-1 px-sm-2">
								<a href="javascript:void(0);" title="<?php echo $general_instruction->quick_search_label; ?>" class="qs-icon nav-link ">
									<i class="fa fa-filter" aria-hidden="true"></i>
									<label class="nav-label"><?php echo $general_instruction->quick_search_label; ?></label>

								</a>
							</li>
							<?php if($pageType=="products") { ?>
							<li class="nav-item px-1 px-sm-2">
								<a href="javascript:void(0);" title="<?php echo $general_instruction->quick_search_label; ?>" class="qs-search nav-link ">
									<i class="fa fa-bars" aria-hidden="true"></i>
									<label class="nav-label"><?php echo $general_instruction->search_label; ?></label>
								</a>
							</li>
							<?php } ?>
							<li class="nav-item px-1 px-sm-2">
								<a href="javascript:void(0);" title="<?php echo $general_instruction->search_label; ?>" class="c-search-icon nav-link ">
									<i class="fa fa-search" aria-hidden="true"></i>
									<label class="nav-label"><?php echo $general_instruction->instant_search_menu; ?></label>	
								</a>
							</li>
						<?php }?>						
					</ul>
				<?php }?>
								
			</div>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
                
				<?php //echo 'Search';?>
				<?php if (!isMobile()) {?>

					<div id="nav-global-location-slot">
							<span id="nav-global-location-data-modal-action" class="a-declarative nav-progressive-attribute" data-a-modal="" data-action="a-modal">
								
									
									<div id="glow-ingress-block">
										<div id="glow-ingress-block">
										<div style="width: 124px;" class="nav-line-1 nav-progressive-content" id="glow-ingress-line1">
											<?php echo $general_instruction->header_delivery_text; ?> <?php echo $this->session->userdata("browser_location");?>
										</div>
										<div class="nav-line-2 nav-progressive-content" id="glow-ingress-line2">
											<i class="fa fa-location-arrow" aria-hidden="true"></i>
											<?php if($cart_user_session_data['cart_zip']==null){?>
											<span class="nav_update_location">
												<strong><?php echo $general_instruction->header_location_update_text;?></strong>
												<div class="nav_block1">
													<div id="">
														<div id="" class="">													
															<span class="nav-action-inner">
																<a href="<?php echo base_url() . $lang_id . '/' . 'user/login'; ?>" class="btn actn-btn btn-small rounded"><?php echo $admin_static_links['Signin']; ?></a>
															</span>													
															<div id="" class="">
																<?= $general_instruction->forgot_pwd_signup_content; ?>
																<a href="<?php echo base_url() . $lang_id . '/' . 'user/signup'; ?>" rel="nofollow" class="nav-a">
																	<?php echo $admin_static_links['Signup']; ?>
																</a>
															</div>
															<hr/>
															<div>
																<span><?php echo $general_instruction->header_ask_postal_text;?></span>
																<p class="location_form">
																	<input type="text" value="" id="manual_postal_code" name="manual_postal_code"/>
																	<button type="button" class="btn btn-small rounded" onClick="updateLocation()"><?php echo $general_instruction->header_apply_button_text;?></button>
																</p>
																<div class="a-box-inner a-alert-container">
																	<i class="fa fa-warning"></i>
																	<span><?php echo $general_instruction->header_postal_error_text;?></span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</span>
											<?php }else {?>
												<strong><a href="<?php echo base_url().$lang_id.'/user/profile';?>"><?php echo $general_instruction->header_location_update_text;?></a></strong>
											<?php }?>
											
										</div>
	                        			          		</div>
									</div>
								
							</span>							
					</div>

					<div class="text-header1 home-main-search-wrap">
						<?php $this->load->view('elements/search_new1'); ?>
					</div>
				<?php }?>	
				<div class="top-header-meta">
					<div class="top-header-social">
						<div class="ddl">
							<div class="box">
								<ul class="navbar-nav align-items-center p-0">
                                <li class="nav-item px-0 px-md-1 py-0 py-xl-3">
										<div class="language_container">
											<div id="polyglotLanguageSwitcher1">
												<div class="nav-item dropdown" id="sample">
													<a class="nav-link dropdown-toggle " href="javascript:void(0);" onclick="return false;" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
														<span>
															<?php $languageList = '';
$active = (isset($active) && $active) ? $active : '';
if (isset($country_data) && !empty($country_data)) {
    foreach ($country_data as $set_data) {
        if ($set_data['short_code'] == $lang_id) {
            if (isset($set_data['image']) && ($set_data['image'] != '' || $set_data['image'] != null)) {
                echo '<img src="' . asset_url('assets/uploads/country/thumbnails/' . $set_data['image']) . '" alt="alt-' . $set_data['name'] . '" height="11" width="16"/>' . ' ' . $set_data['name'];
            } else {
                echo $set_data['name'];
            }
        }

        if ($set_data['status'] == 1) {
            if ($set_data['short_code'] != $lang_id) {
                if ($active != 'entry_door' && $active != 'signup' && $active != 'cookiepolicy' && $active != 'page') {
                    $languageList .= '<li><a class="dropdown-item" href="' . base_url() . $set_data['short_code'] . $uri_string . '">';
                    if (isset($set_data['image']) && ($set_data['image'] != '' || $set_data['image'] != null)) {
                        $languageList .= '<img class="" src="" data-img="' . asset_url('assets/uploads/country/thumbnails/' . $set_data['image']) . '" alt="alt-' . $set_data['name'] . '" height="11" width="16"/>';
                    }
                    $languageList .= $set_data['name'] . '</a></li>';
                } else {
                    if ($active == 'entry_door') {
                        $languageList .= '<li><a class="dropdown-item" href="' . base_url() . $set_data['short_code'] . '/front/entry_door">';
                        if (isset($set_data['image']) && ($set_data['image'] != '' || $set_data['image'] != null)) {
                            $languageList .= '<img class="" src="" data-img="' . asset_url('assets/uploads/country/thumbnails/' . $set_data['image']) . '" alt="' . $set_data['name'] . '" height="11" width="16"/>';
                        }
                        $languageList .= $set_data['name'] . '</a></li>';
                    } else if ($active == 'cookiepolicy') {
                        $languageList .= '<li><a class="dropdown-item" href="' . base_url() . $set_data['short_code'] . '"/front/cookieplicy">';
                        if (isset($set_data['image']) && ($set_data['image'] != '' || $set_data['image'] != null)) {
                            $languageList .= '<img class="" src="" data-img="' . asset_url('assets/uploads/country/thumbnails/' . $set_data['image']) . '" alt="' . $set_data['name'] . '" height="11" width="16"/>';
                        }
                        $languageList .= $set_data['name'] . '</a></li>';
                    } else if ($active == 'page') {
                        $languageList .= '<li><a class="dropdown-item" href="' . base_url() . $set_data['short_code'] . '/page/' . $page_url . '">';
                        if (isset($set_data['image']) && ($set_data['image'] != '' || $set_data['image'] != null)) {
                            $languageList .= '<img class="" src="" data-img="' . asset_url('assets/uploads/country/thumbnails/' . $set_data['image']) . '" alt="' . $set_data['name'] . '" height="11" width="16"/>';
                        }
                        $languageList .= $set_data['name'] . '</a></li>';
                    } else {
                        $languageList .= '<li><a class="dropdown-item" href="' . base_url() . $set_data['short_code'] . '/signup/index/">';
                        if (isset($set_data['image']) && ($set_data['image'] != '' || $set_data['image'] != null)) {
                            $languageList .= '<img class="" src="" data-img="' . asset_url('assets/uploads/country/thumbnails/' . $set_data['image']) . '" alt="' . $set_data['name'] . '" height="11" width="16"/>';
                        }
                        $languageList .= $set_data['name'] . '</a></li>';
                    }
                }
            }
        }
    }
}
?>
														</span>
													</a>
													<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
														<?=$languageList;?>
													</ul>
												</div>
											</div>
										</div>
									</li>

									<?php if (!isMobile()) {?>
										<li class="nav-item hideInMobile">
                                                                                                <a href="javascript:void(0);" title="<?php echo $general_instruction->quick_search_label; ?>" class="qs-icon nav-link ">
                                                                                                        <i class="fa fa-filter" aria-hidden="true"></i>
                                                                                                        <label class="nav-label"><?php echo $general_instruction->quick_search_label; ?></label>
                                                                                                </a>
                                                                                        </li>

										<?php if (isset($pageType) && ($pageType != 'entry_door' && $pageType != 'stripepayment' && $pageType != 'clictopay' && $pageType != 'bamboopayment' && $pageType != 'paymeepayment' && $pageType != 'squareup')) {?>
                     
                                        <?php if($pageType=="products") { ?>
											<li class="nav-item hideInMobile">
												<a href="javascript:void(0);" title="<?php echo $general_instruction->search_label; ?>" class="qs-search nav-link ">
													<i class="fa fa-bars" aria-hidden="true"></i>
													<label class="nav-label"><?php echo $general_instruction->search_label; ?></label>
												</a>
											</li>
                                        <?php } ?>
											<!-- 
											<li class="nav-item hideInMobile">
												<a href="javascript:void(0);" title="<?php echo $general_instruction->instant_search_menu; ?>" class="c-search-icon nav-link ">
													<i class="fa fa-search" aria-hidden="true" type="button"></i>
													<label class="nav-label"><?php echo $general_instruction->instant_search_menu; ?></label>	
												</a>
											</li> -->
										<?php }?>
                                        




											
									<?php }?>

									<?php if ($all_data['datetimer_section_status'] == 1) {?>
										<li class="nav-item px-0 px-md-1">
											<div class="hidden-mob">
												<div class="date-sec">
													<div id="dateActive" class="date-time color-white widthauto"></div>
													<div class="date-time color-white" id="timeActive"></div>
												</div>
											</div>
										</li>
									<?php }?>
									<?php if (empty($loggedUserId)) {?>
										<li class="nav-item hideInMobile">
											<span class="login_span_div hideInMobile">
												<div class="login_buttons nav-line1"><?php echo $general_instruction->header_signing_text1;?></div>
												<div class="login_buttons nav-line2"><?php echo $general_instruction->header_signing_text2;?></div>
												<div class="nav_block">
													<div id="">
														<div id="" class="">													
															<span class="nav-action-inner">
																<a style="background-color: #1e63ec !important;" href="<?php echo base_url() . $lang_id . '/' . 'user/login'; ?>" class="btn actn-btn btn-small rounded"><?php echo $admin_static_links['Signin']; ?><i style="padding-left: 5px;"class="fa fa-sign-out" aria-hidden="true"></i></a>
															</span>	
																											
															<div id="" class="">
																<?= $general_instruction->forgot_pwd_signup_content; ?> 
																<a href="<?php echo base_url() . $lang_id . '/' . 'user/signup'; ?>" rel="nofollow" class="nav-a">
																	<?php echo $admin_static_links['Signup']; ?>
																</a>
															</div>
														</div>
													</div>
												</div>
											</span>											
										</li>
<!--
										<li class="nav-item px-0 mx-0 py-0 py-xl-3 hideInMobile">
											<a class="nav-link" href="<?php echo base_url() . $lang_id . '/' . 'user/login'; ?>"><i class="fa fa-sign-in" aria-hidden="true"></i> <?php echo $admin_static_links['Signin']; ?></a>
										</li>
										<li class="nav-item px-0 mx-0 py-0 py-xl-3 hideInMobile">
											<a class="nav-link" href="<?php echo base_url() . $lang_id . '/' . 'user/signup'; ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $admin_static_links['Signup']; ?></a>
										</li>
-->
									<?php }?>
									
									<?php if (isset($remaining_time) && $remaining_time != '' && !front_on_checkout_verification(true)) {?>
										<li class="nav-item px-0 px-md-1 py-0 py-xl-3">
											<div class="hidden-mob">
												<div class="date-sec dropdown">
													<a class="nav-link dropdown-toggle " href="javascript:void(0);" onclick="return false;" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
														<?php echo $userName; ?>
														
													</a>
													<ul class="dropdown-menu p-2" aria-labelledby="navbarDropdown1">
														<!--<li class="py-2">
															( <span id="usertimer"></span> )
														</li>-->
														<?php if (getFrontenduserId()) {?>
															<li class="py-2">
																<a class="logout-btn " href="<?php echo site_url('user/dashboard'); ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> <?php echo $admin_static_links['dashboard']; ?> </a>
															</li>
														<?php }?>
														<li class="py-2">
															<a class="logout-btn " href="<?php echo site_url('cart/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo $admin_static_links['logout']; ?></a>
														</li>
													</ul>

												</div>

											</div>
										</li>                                        
									<?php }?>
									                        
						<?php if (getFrontenduserId()) {
							$price_request_count = check_price_request_count();
								if ($this->config->item('limited_price_option') == "1" && $price_request_count >0) {?>
										<li class="nav-item hideInMobile">
											<a href="<?php echo base_url() . $lang_id . '/user/' . 'addpricerequest'; ?>" title="<?php echo $general_instruction->price_request_menu; ?>" class="kgtcart position-relative nav-link  <?php if (isset($pageType) && ($pageType == 'cart')) {
	echo "active";
}?>" id="cart_title">
												<i class="fa fa-usd" aria-hidden="true"></i>
												<span class="badge position-absolute price_request_count"><?php echo $price_request_count; ?></span>
												<label class="nav-label"><?php echo $general_instruction->price_request_menu; ?></label>
											</a>
										</li>
								<?php } }?>
                                        <li class="nav-item hideInMobile">
												<a href="<?php echo base_url() . $lang_id . '/' . 'cart'; ?>" title="<?php echo $general_instruction->cart_menu_text; ?>" class="kgtcart position-relative nav-link  <?php if (isset($pageType) && ($pageType == 'cart')) {
    echo "active";}?>" id="cart_title">
													<i class="fa fa-shopping-cart" aria-hidden="true"></i>
													<span class="badge position-absolute cartcount"><?php echo $cartcount; ?></span>
													<label class="nav-label"><?php echo $general_instruction->cart_menu_text; ?></label>
												</a>
										</li>
								</ul>
									<ul class="mobile-lower-menu-login showInMobile flex-row">
										<?php if (empty($loggedUserId) || $remaining_time < 0) {?>
											<li class="nav-item px-0 px-md-1 py-0 py-xl-3">
												<a class="nav-link" href="<?php echo base_url() . $lang_id . '/' . 'user/login'; ?>"><i class="fa fa-sign-in" aria-hidden="true"></i> <?php echo $admin_static_links['Signin']; ?></a>
											</li>
											<li class="nav-item px-2 px-md-1 py-0 py-xl-3">
												<a class="nav-link" href="<?php echo base_url() . $lang_id . '/' . 'user/signup'; ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $admin_static_links['Signup']; ?></a>
											</li>
										<?php }?>
									</ul>
									<div class="mobile-nav-menu showInMobile">
										<ul class="mobile-lower-menu">
											<?php foreach($all_navigation_data as $nav_bar){?>
												<li>
													<a href="<?php echo $nav_bar->page_url ?>">															
														<?php echo $nav_bar->title ?>
													</a>													
												</li>
											<?php }?>
												<li>
													<a href="<?php echo base_url() . $lang_id . '/' . 'products'; ?>"><?php echo $general_instruction->product_menu_text; ?></a>
												</li>
											<?php if(count($category_menu)>0){?>												
												<li class="has-mobile-submenu">
													<a><?php echo $general_instruction->search_product_by_vehicle_type;?></a>
													<ul class="mobile-submenu">
													<?php foreach($category_menu as $category){?>
														<li>
															<a  href="<?php echo base_url()."products/category_details/".$category["id"];?>">
																<img src="<?php echo base_url();?>assets/uploads/vehicle_categories/<?php echo $category['vehicle_category_icon']?>" />
																<?php echo strtoupper($category['lang_category_name']?$category['lang_category_name']:$category['category_name']);?>
															</a>
														</li>
													<?php }?>
													</ul>
												</li>
											<?php }?>
											<?php if(count($brand_menu)>0){?>
											<li class="has-mobile-submenu"><a><?php echo $general_instruction->search_product_by_brand_type;?></a>
												<ul class="mobile-submenu">
												<?php foreach($brand_menu as $brand){?>
													<?php $explode_val = explode(",",$brand['vehicle_category_id']); ?>												
													<li>
														<a href="<?php echo base_url()."products/maker_details/".$brand['id'];?>">
															<img src="<?php echo base_url();?>assets/uploads/product_maker/<?php echo $brand['maker_logo'];?>" />
															<?php echo strtoupper($brand['lang_maker_name']?$brand['lang_maker_name']:$brand['maker_name']);?>
														</a>
													</li>																									
												<?php }?>
												</ul>
											</li>
											<?php }?>
											<?php if (isset($remaining_time) && $remaining_time != '' && !front_on_checkout_verification(true)) {?>
												<div>&nbsp;</div>
												<div class="timer-wrap"> 
													<span><?php echo $general_instruction->header_shoppingtimer; ?></span>
													<div class="timer-info">( <span id="usertimer"></span> )</div>
												</div>
											<?php } ?>
											
										</ul>
										
									</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if (!isMobile()) {?>
			<?php if (isset($remaining_time) && $remaining_time != '' && !front_on_checkout_verification(true)) {?>

			<div class="timer-wrap hideInMobile"> 
				<span><?php echo $general_instruction->header_shoppingtimer; ?></span>
				<div class="timer-info">( <span id="usertimer"></span> )</div>
			</div>

			<?php if (getFrontenduserId()) {
					$price_request_count = check_price_request_count(); 
					if ($this->config->item('limited_price_option') == "1" && $price_request_count>0) {
						                     
					?>
			<!--
			 <div class="mobil-cart hideInMobile">
						<a href="<?php echo base_url() . $lang_id . '/user/' . 'addpricerequest'; ?>" title="<?php echo $general_instruction->price_request_menu; ?>" class="kgtcart position-relative nav-link  <?php if (isset($pageType) && ($pageType == 'cart')) {
			echo "active";
			}?>" id="cart_title">
							<i class="fa fa-usd" aria-hidden="true"></i>
							<span class="badge position-absolute price_request_count"><?php echo $price_request_count; ?></span>				
						</a>
					</div> -->
					<?php } }?> 
					
			<!--	<div class="mobil-cart hideInMobile">
				<a href="<?php echo base_url() . $lang_id . '/' . 'cart'; ?>" title="<?php echo $general_instruction->cart_menu_text; ?>" class="kgtcart position-relative nav-link  <?php if (isset($pageType) && ($pageType == 'cart')) {
			echo "active";}?>" id="cart_title">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					<span class="badge position-absolute cartcount"><?php echo $cartcount; ?></span>
				</a>
			</div> -->
			
<?php } ?>
<?php } ?>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>    
	</nav>








    <div class="lower-header">
            <ul class="menu-ul-lower-header">
            <?php foreach ($all_navigation_data as $nav_bar) {
        $currentURL = current_url();?>
            <li class="nav-item">
                <a class="lower-head-menu <?php if ($currentURL == trim($nav_bar->page_url)) {
echo "active";
}?>" href="<?php echo $nav_bar->page_url ?>" rel="noopener noreferrer" aria-label="<?php echo $nav_bar->title ?>"><?php echo $nav_bar->title ?></a>
            </li>
			<?php }?>
            <li class="nav-item">
						<a class="lower-head-menu <?php if (isset($pageType) && ($pageType == 'products' || $pageType == 'productmaker' || $pageType == 'productmodel' || $pageType == 'productitems' || $pageType == 'productlist')) {
    echo "active";
}?>" href="<?php echo base_url() . $lang_id . '/' . 'products'; ?>" rel="noopener noreferrer" aria-label="<?php echo $general_instruction->product_menu_text; ?>"><?php echo $general_instruction->product_menu_text; ?></a>
			</li>
			
			<?php if (count($category_menu)>0){ ?>
            <li class="nav-item has-submenu">
                <a class="lower-head-menu" rel="noopener noreferrer"><?php echo $general_instruction->search_product_by_vehicle_type;?></a>
                
				<!-- <ul class="submenu"  style="top:<?php echo $this->config->item('sub_menu_top_value');?>"> -->
				<ul class="submenu"  style="top: 211px;">
				<div>
					<?php foreach($category_menu as $category){?>
                        <li data-image="<?php echo base_url();?>assets/uploads/vehicle_categories/<?php echo $category['vehicle_category_icon']?>"><a class="submenu_a"  href="<?php echo base_url()."products/category_details/".$category["id"];?>"><?php echo strtoupper($category['lang_category_name']?$category['lang_category_name']:$category['category_name']);?></a></li>                        
					<?php }?>						
					</div>					
                    <div class="submenu-images"><img src="<?php echo base_url();?>assets/uploads/vehicle_categories/<?php echo $category_menu[0]['vehicle_category_icon'];?>"></div>
                </ul>
				
				<form class="float-start w-100" action="" id="products_category_list_form" enctype="multipart/form-data" method="post" autocomplete="off">
					<input type="hidden" name="vehicle_category_id[]" value="" class="vehicle_category_id" />
					<input type="hidden" name="filter_option" value="category" />
					<input type="hidden" name="cart_block_timer" value="60" />
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					<input type="hidden" name="from_menu" value="1" />
				</form>
            </li>
			<?php }?>
			<?php if (count($brand_menu)>0){ ?>
            <li class="nav-item has-submenu">
                <a class="lower-head-menu" rel="noopener noreferrer"><?php echo $general_instruction->search_product_by_brand_type;?></a>
                <!-- <ul class="submenu"  id="ul_brand"  style="top:<?php echo $this->config->item('sub_menu_top_value');?>"> -->
				<ul class="submenu"  id="ul_brand"  style="top: 211px;">
				<div>
						<?php foreach($brand_menu as $brand){?>
							<?php $explode_val = explode(",",$brand['vehicle_category_id']); ?>
							<li data-image="<?php echo base_url();?>assets/uploads/product_maker/<?php echo $brand['maker_logo'];?>"><a class="submenu_a" href="<?php echo base_url()."products/maker_details/".$brand['id'];?>"><?php echo strtoupper($brand['lang_maker_name']?$brand['lang_maker_name']:$brand['maker_name']);?></a></li>                                               
						<?php }?>
					</div>				
                    <div class="submenu-images" id="brand_image"><img src="<?php echo base_url();?>assets/uploads/product_maker/<?php echo $brand_menu[0]['maker_logo'];?>"></div>
                </ul>
				<form class="float-start w-100" action="" id="products_maker_list_form" enctype="multipart/form-data" method="post" autocomplete="off">
					<input type="hidden" name="maker_id[]" value="" class="vehicle_type_id makercheck_">
					<input type="hidden" name="model_id[]" value="" class="vehicle_type_id makercheck_">
					<input type="hidden" id="maker_id_dropdown" name="maker_id_dropdown[]" value="" class="vehicle_type_id makercheck_">					
					<input type="hidden" name="filter_option" value="brand" />
					<input type="hidden" name="from_menu" value="1" />
				</form>
            </li>
			<?php }?>
			
        </ul>       
    </div>














	<i class="scroll-btn fa fa-arrow-circle-down fa-4" onclick="scrollToBottom()"></i>
	<input type ="hidden" id="auto_load_value" value="1"/>
	<script type="text/javascript">
		var scroll_btn  = document.getElementsByClassName("scroll-btn");
		var timeoutId;
		window.addEventListener('scroll', function() {
			clearTimeout(timeoutId);
			for (var i = 0; i < scroll_btn.length; i++) {
				scroll_btn[i].style.display = 'flex';
			}					

			timeoutId = setTimeout(function() {
				for (var i = 0; i < scroll_btn.length; i++) {
					scroll_btn[i].style.display = 'none';
				}
			}, 3000); // Hide the buttons after 5 seconds
		});
		function scrollToBottom() {
			var scrool_to_value =  document.body.scrollHeight;
			document.getElementById("auto_load_value").value = 0;
			//window.scrollTo(0, scrool_to_value);
			document.documentElement.scrollTop = document.documentElement.scrollHeight;
			setTimeout(function() {
			// Code to execute after 2 seconds
				document.getElementById("auto_load_value").value = 1;
			}, 2000);

		}
	</script>
</header>


<?php if (!front_on_checkout_verification(true)) {?>
	<input type="hidden" id="logout_user" value="true">
<?php } else {?>
	<input type="hidden" id="logout_user" value="false">
<?php }?>

<?php if (isset($remaining_time) && $remaining_time != '' && !front_on_checkout_verification(true)) {?>
	<input type="hidden" id="remaining_time" value="<?php echo $remaining_time; ?>">
<?php } else {?>
	<input type="hidden" id="remaining_time" value="0">
<?php }?>

<?php
// get default home page list data category or maker
$hide_category = isset($all_data['quick_search_hide_category']) ? $all_data['quick_search_hide_category'] : 0;
// set session for category enabled or not based on the admin selection
$this->session->set_userdata('hide_category', $hide_category);
?>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
    const submenuItems = document.querySelectorAll('.submenu li');
    const imageContainer = document.querySelector('.submenu-images img');

	const brandImageContainer = document.querySelector('#brand_image img');
	const brandSubmenuItems = document.querySelectorAll('#ul_brand li');

    submenuItems.forEach(item => {
        item.addEventListener('mouseover', function() {
        const imageUrl = this.getAttribute('data-image');
        imageContainer.setAttribute('src', imageUrl);
        });
    });
	brandSubmenuItems.forEach(item => {
		
        item.addEventListener('mouseover', function() {			
        const imageUrl = this.getAttribute('data-image');
        brandImageContainer.setAttribute('src', imageUrl);
        });
    });
    });

	const menuItems = document.querySelectorAll('.nav-item.has-submenu');

    menuItems.forEach(menuItem => {
        const submenu = menuItem.querySelector('.submenu');
        if (submenu) {
            menuItem.addEventListener('mouseenter', function() {
                submenu.style.display = 'inline-flex';
                menuItem.classList.add('active-open');
            });

            menuItem.addEventListener('mouseleave', function() {
                submenu.style.display = 'none';
                menuItem.classList.remove('active-open');
            });
        }
    });

	function jumpToMaker(data){		
		$("#products_maker_list_form").attr("action", base_url + lang_id + "/products/product_model");
		$(".vehicle_category_id, .product_types_id").val('');
      				
		$('.vehicle_type_id').val(data);
		var maker_id_length = [];

		$("input[name='maker_id[]']").each(function() {
			var value = $(this).val();	

			if (value != "") {
				maker_id_length.push(value);
			}
		});
		$("#maker_id_dropdown").val(maker_id_length);
		$("#products_maker_list_form").submit();         
		return false;
	}

	function jumpToCategory(data){
		$("#products_category_list_form").attr("action", base_url + lang_id + "/products/product_maker");
		$(".vehicle_category_id, .product_types_id").val('');
      				
		$('.vehicle_category_id').val(data);
		var vehicle_category_length = [];

		$("input[name='vehicle_category_id[]']").each(function() {
			var value = $(this).val();
			if (value == "") {
				vehicle_category_length.push(value);
			}
		});
		$("#products_category_list_form").submit();         
		return false;
	}

	function updateLocation(){
		var _value = $("#manual_postal_code").val();
		if(_value){
			$.ajax({
				url: base_url + lang_id + "/products/updatePostalCode",
				data:{
					manual_postal_code: _value
				},				
				method: 'POST',
				success: function(response){
					console.log(response);
					location.reload();
				},
				error: function(xhr,status,error){
					console.error(xhr.responseText);
				}
			})
		}else{
			$(".a-alert-container").show();
		}
	}

</script>
