<div class="modal" id="user_entry_popup" tabindex="-1" aria-labelledby="user_entry_popup" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="row box-content-modal">
                    <div class="col-lg-6 box-content-modal-left p-3 p-md-5">
                        <form class="form-horizontal float-start w-100" action="#" id="login_form">
                            <div class="entryPopHeader d-flex align-items-center justify-content-between">
                                <h4 class="m-0"><?php echo isset($product_instruction->creditpop_login) ? $product_instruction->creditpop_login : ""; ?> </h4>
                            
                                <div class="language_container">
                                    <div id="polyglotLanguageSwitcher2">
                                    <div class="nav-item dropdown" id="sample">
                                                        <a class="nav-link dropdown-toggle " href="javascript:void(0);" onclick="return false;" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <span>
                                                                <?php
                                                                
                                                            $str = $lang_id . '/';
                                                            $uri_string = str_replace($str, '/', uri_string());
                                                                $languageList = '';
                                                                $active = (isset($active) && $active) ? $active :'' ;
                                                                if (isset($country_data) && !empty($country_data)) {
                                                                    foreach ($country_data as $set_data) {
                                                                        if ($set_data['short_code'] == $lang_id) {
                                                                            if (isset($set_data['image']) && ($set_data['image'] != '' || $set_data['image'] != NULL)) {
                                                                                echo '<img src="' . asset_url('assets/uploads/country/thumbnails/' . $set_data['image']) . '" alt="alt-' . $set_data['name'] . '" height="11" width="16"/>' . ' ' . $set_data['name'];
                                                                            } else {
                                                                                echo $set_data['name'];
                                                                            }
                                                                        }

                                                                        if ($set_data['status'] == 1) {
                                                                            if ($set_data['short_code'] != $lang_id) {
                                                                                if ($active != 'entry_door' && $active != 'signup' && $active != 'cookiepolicy' && $active != 'page') {
                                                                                    $languageList .= '<li><a class="dropdown-item" href="' . base_url() . $set_data['short_code'] . $uri_string . '">';
                                                                                    if (isset($set_data['image']) && ($set_data['image'] != '' || $set_data['image'] != NULL)) {
                                                                                        $languageList .= '<img class="" src="" data-img="' . asset_url('assets/uploads/country/thumbnails/' . $set_data['image']) . '" alt="alt-' . $set_data['name'] . '" height="11" width="16"/>';
                                                                                    }
                                                                                    $languageList .= $set_data['name'] . '</a></li>';
                                                                                } else {
                                                                                    if ($active == 'entry_door') {
                                                                                        $languageList .= '<li><a class="dropdown-item" href="' . base_url() . $set_data['short_code'] . '/front/entry_door">';
                                                                                        if (isset($set_data['image']) && ($set_data['image'] != '' || $set_data['image'] != NULL)) {
                                                                                            $languageList .= '<img class="" src="" data-img="' . asset_url('assets/uploads/country/thumbnails/' . $set_data['image']) . '" alt="' . $set_data['name'] . '" height="11" width="16"/>';
                                                                                        }
                                                                                        $languageList .= $set_data['name'] . '</a></li>';
                                                                                    } else if ($active == 'cookiepolicy') {
                                                                                        $languageList .= '<li><a class="dropdown-item" href="' . base_url() . $set_data['short_code'] . '"/front/cookieplicy">';
                                                                                        if (isset($set_data['image']) && ($set_data['image'] != '' || $set_data['image'] != NULL)) {
                                                                                            $languageList .= '<img class="" src="" data-img="' . asset_url('assets/uploads/country/thumbnails/' . $set_data['image']) . '" alt="' . $set_data['name'] . '" height="11" width="16"/>';
                                                                                        }
                                                                                        $languageList .= $set_data['name'] . '</a></li>';
                                                                                    } else if ($active == 'page') {
                                                                                        $languageList .= '<li><a class="dropdown-item" href="' . base_url() . $set_data['short_code'] . '/page/' . $page_url . '">';
                                                                                        if (isset($set_data['image']) && ($set_data['image'] != '' || $set_data['image'] != NULL)) {
                                                                                            $languageList .= '<img class="" src="" data-img="' . asset_url('assets/uploads/country/thumbnails/' . $set_data['image']) . '" alt="' . $set_data['name'] . '" height="11" width="16"/>';
                                                                                        }
                                                                                        $languageList .= $set_data['name'] . '</a></li>';
                                                                                    } else {
                                                                                        $languageList .= '<li><a class="dropdown-item" href="' . base_url() . $set_data['short_code'] . '/signup/index/">';
                                                                                        if (isset($set_data['image']) && ($set_data['image'] != '' || $set_data['image'] != NULL)) {
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
                                                            <?= $languageList; ?>
                                                        </ul>
                                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group float-start w-100 mb-3">
                                <span class="displaynon blink login-error"><?php echo isset($product_instruction->creditpop_wrong) ? $product_instruction->creditpop_wrong : ""; ?></span>
                                <span class="displaynon blink dev-error"><?php echo isset($product_instruction->creditpop_under) ? $product_instruction->creditpop_wrong : ""; ?></span>
                            </div>
                            <div class="form-group float-start w-100 mb-3">
                                <label class="control-label float-start w-100"><?php echo $cart_instruction->country; ?> </label>
                                <div class="float-start w-100 country_content position-relative">
                                    <select autocomplete="no-fill" name="country" id="country" class="form-control selectpicker1 kgt2">
                                        <?php
                                        if (isset($countries)) {
                                            foreach ($countries as $country) { ?>
                                                <option value='<?php echo htmlentities($country['countryName'], ENT_QUOTES); ?>' data-image="assets/frontend/images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo htmlentities($country['alpha_2']); ?>" data-rel="<?php echo $country['country_code']; ?>" data-title="<?php echo htmlentities($country['countryName']); ?>" <?php if (isset($cart_users_country) && $cart_users_country != '' && $cart_users_country == $country['lang_countryName']) { ?>selected="selected" <?php } else if (isset($cart_users_country) && $cart_users_country != '' && $cart_users_country == $country['countryName']) { ?>selected="selected" <?php } else if (isset($country['countryName']) && $country['countryName'] == "Canada") { ?> selected="selected" <?php } else if ($country['lang_countryName'] == "Canada") { ?>selected="selected" <?php } ?>>
                                                    <?php echo $country['countryName']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="country_flag" id="country_flag" />
                            <div class="form-group float-start w-100 mb-3">
                                <label class="control-label float-start w-100" for="email"><?php echo $cart_instruction->email; ?></label>
                                <div class=" float-start w-100">
                                    <input type="email" class="form-control" id="email" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->email); ?>" name="email" required="">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="control-label" for="pwd"><?php echo $cart_instruction->cellphone; ?></label>
                                <div class="row">
                                    <div class="col-4 col-sm-3 country_code_div" style="padding-right:0px;">
                                        <input type="text" class="form-control" id="country_code" placeholder="+1" name="country_code" value="+1" required readonly autocomplete="no-fill">
                                    </div>
                                    <div class="col-8 col-sm-9">
                                        <input type="text" class="form-control" id="pwd" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->cellphone); ?>" name="pwd" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group float-start w-100 mb-3">
                                <div class="d-flex flex-wrap w-100 justify-content-between align-items-center">
                                    <button type="submit" class="btn btn-default login-submit"><?php echo isset($product_instruction->creditpop_submit) ? $product_instruction->creditpop_submit : ""; ?></button>
                                    <button id="emailForgot" type="button" class="forgot-btn border-0 bg-transparent"> <?php echo isset($product_instruction->creditpop_fgtemail) ? $product_instruction->creditpop_fgtemail : ""; ?> </button>
                                </div>
                            </div>
                            <div class="form-group float-start w-100">
                                <div class="d-flex flex-wrap w-100 justify-content-between align-items-center">
                                    <button  id="phoneForgot" type="button" class="forgot-btn border-0 bg-transparent"><?php echo isset($product_instruction->creditpop_fgtphone) ? $product_instruction->creditpop_fgtphone : ""; ?> </button>
                                    <button  id="bothForgot" type="button" class="forgot-btn border-0 bg-transparent">
                                        <?php echo isset($product_instruction->creditpop_fgtboth) ? $product_instruction->creditpop_fgtboth : ""; ?></button>
                                </div>
                            </div>
                            <div class="form-group float-start w-100 text-center">
                                <hr />
                                <p class="m-0">Do not have an account? <button class="forgot-btn border-0 bg-transparent">Sign Up</button></p>
                            </div>
                        </form>
                        <form class="form-horizontal float-start w-100" action="" id="forgot_email" style="display:none;">
                            <h4>Forgot your Email ID?</h4>
                            <div class="form-group mb-3">
                                <label class="control-label" for="pwd"><?php echo $cart_instruction->cellphone; ?></label>
                                <div class="row">
                                    <div class="col-4 col-sm-3 country_code_div" style="padding-right:0px;">
                                        <input type="text" class="form-control" id="country_code" placeholder="+1" name="country_code" value="+1" required readonly autocomplete="no-fill">
                                    </div>
                                    <div class="col-8 col-sm-9">
                                        <input type="text" class="form-control" id="pwd" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->cellphone); ?>" name="pwd" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group float-start w-100 mb-3">
                                <div class="d-flex flex-wrap w-100 justify-content-between align-items-center">
                                    <button type="submit" class="btn btn-default login-submit"><?php echo isset($product_instruction->creditpop_submit) ? $product_instruction->creditpop_submit : ""; ?></button>
                                    <button type="button" class="backLogin btn btn-default login-submit">Back</button>
                                </div>
                            </div>
                        </form>
                        <form class="form-horizontal float-start w-100" action="" id="forgot_phone" style="display:none;">
                            <h4>Forgot your Phone Number?</h4>
                            <div class="form-group float-start w-100 mb-3">
                                <label class="control-label float-start w-100" for="email"><?php echo $cart_instruction->email; ?></label>
                                <div class=" float-start w-100">
                                    <input type="email" class="form-control" id="email" placeholder="<?php echo str_replace('<br />', ' - ', $cart_instruction->email); ?>" name="email" required="">
                                </div>
                            </div>
                            <div class="form-group float-start w-100 mb-3">
                                <div class="d-flex flex-wrap w-100 justify-content-between align-items-center">
                                    <button type="submit" class="btn btn-default login-submit"><?php echo isset($product_instruction->creditpop_submit) ? $product_instruction->creditpop_submit : ""; ?></button>
                                    <button type="button" class="backLogin btn btn-default login-submit">Back</button>
                                </div>
                            </div>
                        </form>
                        <form class="form-horizontal float-start w-100" action="" id="forgot_email_phone" style="display:none;">
                            <h4>Forgot both Phone Number and Email ID?</h4>
                            <div class="form-group float-start w-100 mb-3">
                                <label class="control-label float-start w-100" for="card">Enter last 4 digits of your card.</label>
                                <div class=" float-start w-100">
                                    <input type="text" class="form-control" placeholder="3251" name="card" required="">
                                </div>
                            </div>
                            <div class="form-group float-start w-100 mb-3">
                                <div class="d-flex flex-wrap w-100 justify-content-between align-items-center">
                                    <button type="submit" class="btn btn-default login-submit"><?php echo isset($product_instruction->creditpop_submit) ? $product_instruction->creditpop_submit : ""; ?></button>
                                    <button type="button" class="backLogin btn btn-default login-submit">Back</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 box-content-modal-right p-3 p-md-5">
                        <div class="col-md-12 mb-3 mb-sm-5">
                            <a href="javascript:void(0);" class="guest-user"> <?php echo $product_instruction->creditpop_guest; ?> </a>
                        </div>
                        <div class="col-md-12">
                            <h1 class="apply_title"><?php echo $product_instruction->creditpop_permanent; ?> </h1> </br>
                            <a href="<?= site_url('en/user/apply_credit'); ?>" class="btn btn-default apply_btn btn-lg"> <?php echo $product_instruction->creditpop_apply; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
