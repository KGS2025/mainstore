<?php

if (count($front_validuser_data) == 0 || !empty($this->session->userdata('front_validuser_data'))) {
    $front_validuser_data = $this->session->userdata('front_validuser_data');
}

$loggedUserId = getFrontenduserId();
$loggedUserData = loginuserdata();

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
<input type="hidden" class="search-status" value="<?=isset($all_data['header_search_status']) ? $all_data['header_search_status'] : 0;?>">
<input type="hidden" class="quick-search-status" value="<?=isset($all_data['header_quick_search_status']) ? $all_data['header_quick_search_status'] : 0;?>">
<input type="hidden" class="hide_category" value="<?=isset($all_data['quick_search_hide_category']) ? $all_data['quick_search_hide_category'] : 0;?>">
<input type="hidden" class="show_search_radio" value="<?php echo $this->config->item('show_search_radio'); ?>">


<?php $sticky = ' fixed-top';
if (isset($pageType) && $pageType == 'products') {
    $sticky = ' fixed-top';
}?>
<header class="ct-mainHeader<?=$sticky;?>" id="MainHeader" style="<?=$sticky ? 'padding: 0px;' : '';?>">
	<nav class="navbar navbar-expand-xl navbar-dark bg-dark fixed-topct-u-backgroundPureBlack big-hide py-0" style="background-color: #<?php echo $all_data['heder_background_color']; ?> !important;">
		<div class="container-fluid">
			<?php if (isset($all_data['header_logo_status']) && $all_data['header_logo_status'] == 1) {?>

				<?php if (isset($all_data['logo']) && $all_data['logo'] != '') {
    $logo = asset_url() . "assets/uploads/logo/thumbnails/" . $all_data['logo'];?>
					<a class="logo navbar-logo navbar-brand p-0" href="<?php echo $all_data['logo_url']; ?>" aria-label="header logo icon">
						<img src="<?php echo $logo; ?>" alt="<?php echo isset($all_data['title']) ? $all_data['title'] : ''; ?>" class="floatleft1" style="width: 100px;object-fit: cover;" />
					</a>
				<?php } else {?>
					<a class="logo navbar-logo navbar-brand p-0" href="<?php echo $all_data['logo_url']; ?>" aria-label="header logo icon">
						<img src="<?php echo asset_url('assets/uploads/logo/thumbnails/logo.png'); ?>" alt="34563456" class="floatleft1" style="width: 100px;object-fit: cover;" />
					</a>
				<?php }?>

			<?php }?>

			<?php if (isMobile()) {?>
			<?php if (isset($remaining_time) && $remaining_time != '' && !front_on_checkout_verification(true)) {?>

<div class="timer-wrap"> 
	<span><?php echo $general_instruction->header_shoppingtimer; ?></span>
	<div class="timer-info">( <span id="usertimer"></span> )</div>
</div>
<?php } ?>
<?php } ?>
			<div class="mobileToggleBtn d-flex">
				<?php if (isMobile()) {?>
					<ul class="navbar-nav showInMobile flex-row">
						<?php if (isset($pageType) && ($pageType != 'entry_door' && $pageType != 'stripepayment' && $pageType != 'bamboopayment' && $pageType != 'clictopay' && $pageType != 'paymeepayment' && $pageType != 'page' && $pageType != 'squareup')) {?>

						<?php	if ($this->config->item('limited_price_option') == "1") {

    $price_request_product = $this->session->userdata('price_request_product');

    ?>
							<li class="nav-item px-1 px-sm-2">
								<a href="<?php echo base_url() . $lang_id . '/' . 'cart'; ?>" title="<?php echo $general_instruction->cart_menu_text; ?>" class="kgtcart position-relative nav-link  <?php if (isset($pageType) && ($pageType == 'cart')) {
        echo "active";
    }?>" id="cart_title">
									<i class="fa fa-usd" aria-hidden="true"></i>
									<span class="badge position-absolute price_request_count"><?php echo count($price_request_product); ?></span>
								</a>
							</li>
							<?php }?>

							<li class="nav-item px-1 px-sm-2">
								<a href="<?php echo base_url() . $lang_id . '/' . 'cart'; ?>" title="<?php echo $general_instruction->cart_menu_text; ?>" class="kgtcart position-relative nav-link  <?php if (isset($pageType) && ($pageType == 'cart')) {
    echo "active";
}?>" id="cart_title">
									<i class="fa fa-shopping-cart" aria-hidden="true"></i>
									<span class="badge position-absolute cartcount"><?php echo $cartcount; ?></span>
								</a>
							</li>
							<li class="nav-item px-1 px-sm-2">
								<a href="javascript:void(0);" title="<?php echo $general_instruction->quick_search_label; ?>" class="qs-icon nav-link ">
									<i class="fa fa-filter" aria-hidden="true"></i>

								</a>
							</li>
							<?php if($pageType=="products") { ?>
							<li class="nav-item px-1 px-sm-2">
								<a href="javascript:void(0);" title="<?php echo $general_instruction->quick_search_label; ?>" class="qs-search nav-link ">
									<i class="fa fa-bars" aria-hidden="true"></i>

								</a>
							</li>
							<?php } ?>
							<li class="nav-item px-1 px-sm-2">
								<a href="javascript:void(0);" title="<?php echo $general_instruction->search_label; ?>" class="c-search-icon nav-link ">
									<i class="fa fa-search" aria-hidden="true"></i>
								</a>
							</li>
						<?php }?>
					</ul>
				<?php }?>
				<ul class="navbar-nav showInMobile flex-row">

					<?php if (empty($loggedUserId) || $remaining_time < 0) {?>
						<li class="nav-item px-0 px-md-1 py-0 py-xl-3">
							<a class="nav-link" href="<?php echo base_url() . $lang_id . '/' . 'user/login'; ?>"> <?php echo $admin_static_links['Signin']; ?></a>
						</li>
						<li class="nav-item px-2 px-md-1 py-0 py-xl-3">
							<a class="nav-link" href="<?php echo base_url() . $lang_id . '/' . 'user/signup'; ?>"> <?php echo $admin_static_links['Signup']; ?></a>
						</li>
					<?php }?>
				</ul>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0 leftMenu p-0">
					<?php foreach ($all_navigation_data as $nav_bar) {
    $currentURL = current_url();?>
						<li class="nav-item">
							<a class="nav-link <?php if ($currentURL == trim($nav_bar->page_url)) {
        echo "active";
    }?>" href="<?php echo $nav_bar->page_url ?>" rel="noopener noreferrer" aria-label="<?php echo $nav_bar->title ?>"><?php echo $nav_bar->title ?></a>
						</li>
					<?php }?>

					<li class="nav-item">
						<a class="nav-link <?php if (isset($pageType) && ($pageType == 'products' || $pageType == 'productmaker' || $pageType == 'productmodel' || $pageType == 'productitems' || $pageType == 'productlist')) {
    echo "active";
}?>" href="<?php echo base_url() . $lang_id . '/' . 'products'; ?>" rel="noopener noreferrer" aria-label="<?php echo $general_instruction->product_menu_text; ?>"><?php echo $general_instruction->product_menu_text; ?></a>
					</li>
					<?php /* if (!isMobile()) { ?>
<?php if (isset($pageType) && ($pageType != 'entry_door' && $pageType != 'stripepayment' &&  $pageType != 'clictopay'  &&  $pageType != 'bamboopayment' && $pageType != 'paymeepayment' && $pageType != 'squareup')) { ?>
<li class="nav-item hideInMobile">
<a href="<?php echo base_url() . $lang_id . '/' . 'cart'; ?>" title="<?php echo $general_instruction->cart_menu_text; ?>" class="kgtcart position-relative nav-link  <?php if (isset($pageType) && ($pageType == 'cart')) {
echo "active";
} ?>" id="cart_title">
<i class="fa fa-shopping-cart" aria-hidden="true"></i>
<span class="badge position-absolute"><?php echo  $cartcount; ?></span>
</a>
</li>
<li class="nav-item hideInMobile">
<a href="javascript:void(0);" title="<?php echo $general_instruction->quick_search_label; ?>" class="qs-icon nav-link ">
<i class="fa fa-filter" aria-hidden="true"></i>
</a>
</li>
<li class="nav-item hideInMobile">
<a href="javascript:void(0);" title="<?php echo  $general_instruction->search_label; ?>" class="c-search-icon nav-link ">
<i class="fa fa-search" aria-hidden="true" type="button"></i>
</a>
</li>
<?php } ?>
<?php } */?>
				</ul>

				<div class="top-header-meta">
					<div class="top-header-social">
						<div class="ddl">
							<div class="box">
								<ul class="navbar-nav align-items-center p-0">


									<?php if (!isMobile()) {?>
										<?php if (isset($pageType) && ($pageType != 'entry_door' && $pageType != 'stripepayment' && $pageType != 'clictopay' && $pageType != 'bamboopayment' && $pageType != 'paymeepayment' && $pageType != 'squareup')) {?>


											<?php	
											
											 if (getFrontenduserId()) { 

											if ($this->config->item('limited_price_option') == "1") {

    $price_request_count = check_price_request_count();

    ?>

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
    echo "active";
}?>" id="cart_title">
													<i class="fa fa-shopping-cart" aria-hidden="true"></i>
													<span class="badge position-absolute cartcount"><?php echo $cartcount; ?></span>
													<label class="nav-label"><?php echo $general_instruction->cart_menu_text; ?></label>
												</a>
											</li>
											<li class="nav-item hideInMobile">
												<a href="javascript:void(0);" title="<?php echo $general_instruction->quick_search_label; ?>" class="qs-icon nav-link ">
													<i class="fa fa-filter" aria-hidden="true"></i>
													<label class="nav-label"><?php echo $general_instruction->quick_search_label; ?></label>
												</a>
											</li>
 <?php if($pageType=="products") { ?>
											<li class="nav-item hideInMobile">
												<a href="javascript:void(0);" title="<?php echo $general_instruction->search_label; ?>" class="qs-search nav-link ">
													<i class="fa fa-bars" aria-hidden="true"></i>
													<label class="nav-label"><?php echo $general_instruction->search_label; ?></label>
												</a>
											</li>
<?php } ?>


											<li class="nav-item hideInMobile">
												<a href="javascript:void(0);" title="<?php echo $general_instruction->instant_search_menu; ?>" class="c-search-icon nav-link ">
													<i class="fa fa-search" aria-hidden="true" type="button"></i>
													<label class="nav-label"><?php echo $general_instruction->instant_search_menu; ?></label>	
												</a>
											</li>
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
										<li class="nav-item px-0 mx-0 py-0 py-xl-3 hideInMobile">
											<a class="nav-link" href="<?php echo base_url() . $lang_id . '/' . 'user/login'; ?>"><i class="fa fa-sign-in" aria-hidden="true"></i> <?php echo $admin_static_links['Signin']; ?></a>
										</li>
										<li class="nav-item px-0 mx-0 py-0 py-xl-3 hideInMobile">
											<a class="nav-link" href="<?php echo base_url() . $lang_id . '/' . 'user/signup'; ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $admin_static_links['Signup']; ?></a>
										</li>
									<?php }?>
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
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if (!isMobile()) {?>
			<?php if (isset($remaining_time) && $remaining_time != '' && !front_on_checkout_verification(true)) {?>

<div class="timer-wrap"> 
	<span><?php echo $general_instruction->header_shoppingtimer; ?></span>
	<div class="timer-info">( <span id="usertimer"></span> )</div>
</div>
<?php } ?>
<?php } ?>
		</div>
	</nav>
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