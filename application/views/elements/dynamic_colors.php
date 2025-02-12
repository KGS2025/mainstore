<?php $colors_row = $this->comman_model->get_row_array('front_colors', '*', array('id' => 1));
$colors = $colors_row[0];

?><style>
  .text-bread {
    color: #<?php echo $all_data['username_runningtime_color'];
            ?> !important;
  }

  .text-bread a {
    color: #<?php echo $all_data['username_runningtime_color'];
            ?> !important;
  }

  .text-bread a {
    color: #<?php echo $all_data['breadcrumb_color'];
            ?> !important;
  }

  .title-modal {
    color: #<?php echo $colors['pop_up_title_color'];
            ?> !important;
  }

  .lds-ellipsis div,
  .navbar-dark .navbar-toggler-icon,
  .navbar-dark .navbar-toggler-icon::before,
  .navbar-dark .navbar-toggler-icon::after {
    background-color: #<?php echo $all_data['header_menu_text_color'];
                        ?> !important;
  }

  .home_head {
    color: #<?php echo $colors['home_heading'];
            ?> !important;
  }

  #quick_search_form h5 {
    color: #<?php echo $colors['qs_heading_color'];
            ?> !important;
  }

  #quick_search_form label {
    color: #<?php echo $colors['qs_search_label'];
            ?> !important;
  }
/*
  #quick_search_form .adv_srch {
    background-color: #<?php echo $all_data['qs_bg_color'];
                        ?> !important;
    border: 3px solid #<?php echo $all_data['qs_bottom_border_bg_color'];
                        ?> !important;
    border-radius: 20px;
    box-shadow: 0 0 29px <?php echo $colors['qs_search_shadow'];
                          ?> !important;
  }*/

  .accordianHead {
    background-color: <?php echo $colors['qs_search_shadow'];
                      ?>
  }

  .accordianHead label+span {
    color: #<?php echo $colors['accordion_text_color'];
            ?> !important;
  }

  .navbar .leftMenu a:hover,
  .navbar-left a:focus,
  .navbar-left a.active {
    color: #<?php echo $all_data['header_menu_text_hover_color'];
            ?> !important;
  }

  .search_radio label {
    color: #<?php echo $all_data['category_label_txt_color'];
            ?> !important;
  }

  .navbar-dark .navbar-nav.leftMenu .nav-link .active {
    background-color: #<?php echo $all_data['header_menu_text_hover_color'];
                        ?> !important;
  }

  [type="checkbox"]:checked+label::before {
    background-color: #<?php echo $colors['checkbox_checked_color'];
                        ?> !important;
  }

  [type="checkbox"]:hover+label:before {
    background-color: #<?php echo $colors['checkbox_checked_color'];
                        ?> !important;
  }

  [type="checkbox"]:checked+label:before {
    background-color: #<?php echo $colors['checkbox_checked_color'];
                        ?> !important;
  }
  
  [type="radio"]:checked+label:before, [type="radio"]:not(:checked)+label:before {
	border-color:#<?php echo $colors['checkbox_checked_color'];
                        ?> !important;
  }
  
 [type="radio"]:checked+label::after {
    background-color: #<?php echo $colors['checkbox_checked_color'];
                        ?> !important;
  }

  .navbar-dark .navbar-nav .nav-link {
    color: #<?php echo $all_data['header_menu_text_color'];
            ?> !important;
  }

  .navbar-dark .navbar-toggler {
    color: #<?php echo $all_data['header_menu_text_color'];
            ?> !important;
 }

  .navbar .leftMenu a {
    color: #<?php echo $all_data['header_menu_text_color'];
            ?> !important;
  }

  #MainHeader .navbar {
    border-bottom: solid 1px #<?php echo $colors['header_border_color'];
                              ?> !important;
    box-shadow: 0 0 3px <?php echo $colors['header_border_shadow'];
                        ?>;
  }

  .bodywrapper {
    background-color: #<?php echo $colors['body_background_color'];
                        ?> !important;
  }

  .footerDiv {
    background-color: #<?php echo $all_data['footer_background_color'];
?> !important; 
    color: #<?php echo $all_data['footer_text_color'];
?> !important;
  }

  .navbar-dark .navbar-nav.leftMenu .nav-link.active::after,
  .navbar-dark .navbar-nav.leftMenu .nav-link:hover::after {
    border-bottom: 3px solid #<?php echo $all_data['header_menu_text_color'];
                              ?> !important;
  }

  .kgtcart .badge {
    background-color: #<?php echo $all_data['header_menu_text_color'];
                        ?> !important;
  }

  .kgtcart .badge {
    color: #<?php echo $all_data['heder_background_color'];
            ?> !important;
  }

  .navbar-toggle,
  .ct-menuMobile,
  .date-sec {
    background-color: #<?php echo $all_data['heder_background_color'];
                        ?> !important;
  }

  .top-header-social .navbar-nav .nav-link,
  .navbar-toggle .ct-u-colorWhite,
  .ct-menuMobile li a {
    color: #<?php echo $all_data['header_menu_text_color'];
            ?> !important;
  }

  .ct-menuMobile li a:hover,
  .ct-menuMobile li a:focus,
  .ct-menuMobile li a:active {
    background-color: #<?php echo $all_data['header_menu_text_hover_color'];
                        ?> !important;
  }

  .ct-menuMobile li a:hover::after,
  .ct-menuMobile li a:after {
    border-bottom: 1px solid #<?php echo $all_data['header_menu_text_hover_color'];
                              ?> !important;
  }

  /*.Instock {
  background-color: #<?php //echo $all_data['product_action_btn_bg_color'];
      ?> !important;
  }*/

  .Instock_detail {
    background-color: #<?php echo $colors['Instock_detail_color'];
      ?> !important;
  }
  .Outstock_detail {
    background-color: #<?php echo $colors['outstock_detail_color'];
      ?> !important;
   }

   .add-cart-link.addpricerequest {
		background: #<?php echo $colors['addpricerequest_color'];
      ?> !important;
	}
	.add-cart-link.addpricerequest.add-cart-grey {
		background: #<?php echo $colors['addpricerequest_active_color'];
      ?> !important;
	}
  
  .start_from {
  color: #<?php echo $all_data['cart_instock_color'];
      ?> !important;
  }


  .trynewcaptcha {
    cursor: pointer;
    color: #<?php echo $all_data['try_captcha_text_color'];
            ?> !important;
  }

  .VehicleBlockItems:hover .btn.actn-btn,
  .product_type_image_wrap:hover .btn.actn-btn,
  .product_type:hover .btn.actn-btn {
    color: #<?php echo $all_data['qs_btn_hover_text_color'];
            ?> !important;
    background-color: #<?php echo $all_data['qs_btn_hover_bg_color'];
                        ?> !important;
  }

  .ProductBlock:hover .btn.actn-btn{
      color: #<?php echo $all_data['qs_btn_hover_text_color'];
              ?> !important;
      background-color: #<?php echo $all_data['qs_btn_hover_bg_color'];
                          ?> !important;
      -webkit-transition: 0.4s ease;
      transition: 0.4s ease;
      box-shadow: 0 0 5px 3px #<?php echo $all_data['product_action_btn_bg_color'];
                              ?> !important;
  }

  .read_more,
  .red_btn,
  .btn.actn-btn,
  .car-lists .btn.actn-btn,
  #payment-panels .actn-btn {
    background-color: #<?php echo $all_data['product_action_btn_bg_color'];
                        ?> !important;
    color: #<?php echo $all_data['product_action_btn_text_color'];
            ?> !important;
  }

  #glow-ingress-line2 .nav-action-inner a{
			color: #<?php echo $all_data['product_action_btn_text_color'];
            ?> !important;
  }

  .car-lists .h-float {
    background: #<?php echo $all_data['product_action_btn_bg_color'];
                  ?> !important;
  }

  .car-lists .boarder_2_red {
    border: 3px solid #<?php echo $all_data['product_action_btn_bg_color'];
                        ?> !important;
  }

  .car-lists .boarder_2_red .btn.actn-btn {
    color: #<?php echo $all_data['qs_btn_hover_text_color'];
            ?> !important;
    background-color: #<?php echo $all_data['qs_btn_hover_bg_color'];
                        ?> !important;
  }

  #payment-panels .panel-body label,
  #payment-panels .message-content label {
    color: #<?php echo $all_data['input_label_color'];
            ?> !important;
  }

  .panel-title {
    color: #<?php echo $all_data['input_label_color'];
            ?> !important;
  }

  .nav-pane-container .nav-links span {
    color: #<?php echo $all_data['input_label_color'];
            ?> !important;
  }

  .nav-pane-container {
    background-color: #<?php echo $all_data['search_input_background_color'];
                        ?> !important;
  }

  .heading-price {
    color: #<?php echo $all_data['input_label_color'];
            ?> !important;
  }

  #response-panel-fail .errortable {
    color: #<?php echo $all_data['validation_color'];
            ?> !important;
  }

  .response-error-message {
    color: #<?php echo $all_data['validation_color'];
            ?> !important;
  }

  /* .form-horizontal .control-label { color: #<?php //echo $all_data['input_label_color']; 
                                                ?> !important;} */
  .cart-user-form {
    color: #<?php echo $all_data['input_label_color'];
            ?> !important;
  }

  .form-fill-cart span.help-block {
    color: #<?php echo $all_data['input_label_color'];
            ?>;
  }

  .downloadPdfIcon,
  .form-group {
    color: #<?php echo $all_data['input_label_color'];
            ?> !important;
  }

  .downloadPdfIcon:hover {
    color: #<?php echo $all_data['cart_productdisp_txt_color'];
            ?> !important;
  }

  .form-group p {
    float: left;
    width: 100%;
    color: #<?php echo $all_data['input_label_color'];
            ?> !important;
  }

  .form-group p.help-block {
    color: #<?php echo $all_data['validation_color'];
            ?> !important;
  }

  #hide_billing_details {
    color: #<?php echo $all_data['input_label_color'];
            ?> !important;
  }

  #show_shipping_details_div {
    color: #<?php echo $all_data['input_label_color'];
            ?> !important;
  }

  .kgtloadmore.actn-btn {
    background-color: #<?php echo $all_data['product_action_btn_bg_color'];
                        ?> !important;
    color: #<?php echo $all_data['product_action_btn_text_color'];
            ?> !important;
    border: 1px solid #<?php echo $all_data['product_action_btn_bg_color'];
                        ?> !important;
    box-shadow: 0px 1px 2px #<?php echo $all_data['product_action_btn_bg_color'];
                              ?> !important;
  }

  .pagination .page-item .page-link,
  .custom_pagination a,
  .viewbtn,
  .downloadbtn {
    color: #<?php echo $all_data['input_label_color'];
            ?> !important;
  }

  .pagination .page-item .page-link:hover,
  .viewbtn:hover,
  .downloadbtn:hover,
  .custom_pagination a:hover,
  .custom_pagination a.current {
    color: #<?php echo $all_data['cart_productdisp_txt_color'];
            ?> !important;
  }

  .input-field-card #Search {
    background-color: #<?php echo $all_data['search_input_text_color'];
                        ?> !important;
    color: #<?php echo $all_data['search_input_background_color'];
            ?> !important;
  }

  .input-field-card .headersearchbutton {
    background-color: #<?php echo $all_data['search_input_background_color'];
                        ?> !important;
    color: #<?php echo $all_data['search_input_text_color'];
            ?> !important;
    border: solid 1px #<?php echo $all_data['search_input_background_color'];
                        ?> !important;
  }

  ul.search-result {
    background-color: #<?php echo $all_data['search_result_background_color'];
                        ?> !important;
  }

  ul.search-result a {
    color: #<?php echo $all_data['search_result_text_color'];
            ?> !important;
  }

  .brand_complete_info .carousel-control-prev,
  .brand_complete_info .carousel-control-next {
    background-color: <?php echo $colors['home_whats_color_shadow'];
                      ?>;
  }

  .sticky,
  .sticky_bottom {
    background-color: #333232 !important;
    float: left;
    width: 100%;
  }

  .ct-widget-header,
  .colour-code,
  .ct-copyright p span,
  .ct-copyright p {
    color: #<?php echo $all_data['footer_text_color'];
            ?> !important;
  }

  .colour-code a,
  .quick_links a {
    color: #<?php echo $all_data['footer_text_color'];
            ?> !important;
  }

  .colour-code a:hover,
  .colour-code a:focus {
    color: #<?php echo $all_data['header_menu_text_hover_color'];
            ?> !important;
  }

  .quick_links a:hover,
  .quick_links a:focus {
    color: #<?php echo $all_data['header_menu_text_hover_color'];
            ?> !important;
  }

  .cat-label {
    color: #<?php echo $all_data['category_label_txt_color'];
            ?> !important;
  }

  .Checkbox_brand {
    color: #<?php echo $all_data['category_label_txt_color'];
            ?> !important;
  }

  .card-header-product-list-element {
    color: #<?php echo $all_data['category_label_txt_color'];
            ?> !important;
  }

  .accordion .card-header-product-list-element:after {
    color: #<?php echo $all_data['category_label_txt_color'];
            ?> !important;
  }

  /* #payment-panels {
  background-color: #<?php ///echo $all_data['inner_bg_color'];
                      ?> !important;
} */

  .dropdown dt a {
    border: 1px solid #<?php echo $all_data['langdropdownhead_txt_color'];
                        ?> !important;
    background-color: #<?php echo $all_data['langdropdownhead_bg_color'];
                        ?>url('<?php echo base_url(); ?>assets/frontend/images/arrow.PNG') no-repeat scroll right center;
    color: #<?php echo $all_data['langdropdownhead_txt_color'];
            ?> !important;
  }

  .modal .box-content-modal-right {
    background-color: #<?php echo $all_data['cart_productdisp_txt_color'];
                        ?> !important;
  }

  .modal .box-content-modal-left {
    background-color: #<?php echo $all_data['entry_pop_btn_bg_color'];
                        ?> !important;
  }

  .quick_links a.active {
    color: #<?php echo $all_data['header_menu_text_hover_color'];
            ?> !important;
  }

  .product_counter_msg {
    color: #<?php echo $colors['pop_up_title_color'];
            ?> !important;
  }

  .modal .box-content-modal .btn-modal .btn {
    background-color: #<?php echo $all_data['popup_btn_bg_color'];
                        ?> !important;
    color: #<?php echo $all_data['popup_btn_txt_color'];
            ?> !important;
  }

  .dropdown dd ul {
    background-color: #<?php echo $all_data['langdropdown_bg_color'];
                        ?> !important;
  }

  .dropdown dd ul li a {
    border-top: 1px dotted #<?php echo $all_data['langdropdown_txt_color'];
                            ?> !important;
    color: #<?php echo $all_data['langdropdown_txt_color'];
            ?> !important;
  }

  .dropdown dd ul li a:hover {
    background-color: #<?php echo $all_data['langdropdownhead_bg_color'];
                        ?>;
  }

  #productApplicationBlock>.accordion-item>.accordion-header>.accordion-button,
  #productAttributesBlock>.accordion-item>.accordion-header>.accordion-button,
  #productsearch_list_show .my-table thead th,
  .productlisting .my-table thead th {
    background-color: #<?php echo $all_data['cart_table_bgcolor'];
                        ?> !important;
    color: #<?php echo $all_data['cart_table_txtcolor'];
            ?> !important;
  }

  .single_product_wrapper {
    color: #<?php echo $all_data['product_box_txt_color'];
            ?> !important;
  }

  .single_product_wrapper select {
    color: #<?php echo $all_data['product_box_txt_color'];
            ?> !important;
    border-color: #<?php echo $all_data['product_box_txt_color'];
                    ?>;
  }

  .width60px input {
    color: #<?php echo $all_data['product_box_txt_color'];
            ?> !important;
    border-color: #<?php echo $all_data['product_box_txt_color'];
                    ?> !important;
  }

  .font575757 {
    color: #<?php echo $all_data['product_box_txt_color'];
            ?> !important;
  }

  .dd,
  .form-control,
  #payment-panels .message-content input,
  .bambora-checkoutfield {
    border-color: #<?php echo $all_data['input_border_txt_color'];
                    ?> !important;
    color: #<?php echo $all_data['input_border_txt_color'];
            ?> !important;
    background-color: #<?php echo $all_data['input_bg_color'];
                        ?> !important;
  }

  #user_entry_popup .language_container .dropdown .dropdown-toggle {
    color: #<?php echo $all_data['input_border_txt_color'];
            ?> !important;
  }

  .blink_error {
    color: #<?php echo $all_data['validation_color'];
            ?> !important;
  }

  .has-error .form-control {
    border-color: #<?php echo $all_data['validation_color'];
                    ?> !important;
  }

  #payment-panels .error {
    color: #<?php echo $all_data['validation_color'];
            ?> !important;
  }

  .loader-payment .progress-bar {
    background-color: #<?php echo $all_data['progress_bar_bg_color'];
                        ?> !important;
    color: #<?php echo $all_data['progress_bar_text_color'];
            ?> !important;
  }

  .loader-payment p.counter-data {
    color: #<?php echo $all_data['payment_success_text_color'];
            ?> !important;
  }

  .quantity {
    color: #<?php echo $all_data['product_box_txt_color'];
            ?> !important;
    border-color: #<?php echo $all_data['product_box_txt_color'];
                    ?> !important;
  }

  .user_comment {
    color: #<?php echo $all_data['product_box_txt_color'];
            ?> !important;
    border-color: #<?php echo $all_data['product_box_txt_color'];
                    ?> !important;
  }

  .product_display_final {
    color: #<?php echo $all_data['product_box_txt_color'];
            ?> !important;
    border-color: #<?php echo $all_data['product_box_txt_color'];
                    ?> !important;
  }

  .my-table tbody tr {
    background-color: #<?php echo $all_data['cart_table_tr_bg_color'];
                        ?> !important;
  }

  #display-num-of-products-header,
  #display-num-of-products-footer {
    color: #<?php echo $all_data['product_action_btn_text_color'];
            ?> !important;
  }

  .Productsearch_result {
    color: #<?php echo $all_data['cart_productdisp_txt_color'];
            ?> !important;
  }




  #quick_search_form h4 {
    color: #<?php echo $all_data['qs_text_color'];
            ?> !important;
  }

  #quick_search_form .btn-primary:hover,
  #quick_search_form .btn-primary:focus {
    color: #<?php echo $all_data['qs_btn_hover_text_color'];
            ?> !important;
    border-color: #<?php echo $all_data['qs_btn_hover_text_color'];
                    ?> !important;
    background-color: #<?php echo $all_data['qs_btn_hover_bg_color'];
                        ?> !important;
  }

  #quick_search_form .btn-primary {
    color: #<?php echo $all_data['qs_btn_text_color'];
            ?> !important;
    background-color: #<?php echo $all_data['qs_btn_bg_color'];
                        ?> !important;
  }

  .search-choosen {
    color: #<?php echo $all_data['search_by_text_color'];
            ?> !important;
  }

  #products_catagory_list_form .custom_btn {
    background-color: #<?php echo $colors['selectall_bg_color'];
                        ?> !important;
    box-shadow: 1px 0 1px #<?php echo $colors['selectall_bg_color'];
                            ?> !important;
    color: #<?php echo $all_data['selectall_text_color'];
            ?> !important;
  }

  #quick_search_form .ddTitleText {
    background-color: #<?php echo $all_data['qs_select_bg_color'];
                        ?> !important;
    color: #<?php echo $all_data['qs_select_text_color'];
            ?> !important;
    width: 100%;
  }

  #quick_search_form .dd .divider {
    border-left: 1px solid #<?php echo $all_data['qs_dd_selected_bg_color'];
                            ?> !important;
    border-right: 1px solid #<?php echo $all_data['qs_select_bg_color'];
                              ?> !important;
  }

  #quick_search_form .dd .ddChild li {
    background-color: #<?php echo $all_data['qs_dd_bg_color'];
                        ?> !important;
    color: #<?php echo $all_data['qs_dd_text_color'];
            ?> !important;
  }

  #quick_search_form .dd .ddChild li.selected {
    background-color: #<?php echo $all_data['qs_dd_selected_bg_color'];
                        ?> !important;
    color: #<?php echo $all_data['qs_dd_selected_text_color'];
            ?> !important;
  }

  .header-logo {
    width: 80px;
    height: 20px;
  }

  .home-quick-search-wrap,
  .common-search {
    display: none;
  }

  .next-btn-msg {
    color: #<?php echo $all_data['product_action_btn_text_color'];
            ?> !important;
    font-size: 15px;
  }

  #more_button_product_types,
  #more_button_vehicle_types,
  #more_button_mak_cat,
  #more_button_model_cat,
  #no_more_button_mak_cat,
  #more_button_item_cat,
  #no_more_button_item_cat {
    background-color: #<?php echo $all_data['first_load_more_bg_color'];
                        ?> !important;
    color: #<?php echo $all_data['first_load_more_text_color'];
            ?> !important;
    border: 1px solid #<?php echo $all_data['first_load_more_bg_color'];
                        ?> !important;
    box-shadow: 0px 1px 2px #<?php echo $all_data['first_load_more_bg_color'];
                              ?> !important;
  }

  #more_button_makers,
  #no_more_button_makers,
  #more_button_model_maker,
  #no_more_button_model_maker,
  #more_button_product_item,
  #no_more_button_product_item {
    background-color: #<?php echo $all_data['second_load_more_bg_color'];
                        ?> !important;
    color: #<?php echo $all_data['second_load_more_text_color'];
            ?> !important;
    border: 1px solid #<?php echo $all_data['second_load_more_bg_color'];
                        ?> !important;
    box-shadow: 0px 1px 2px #<?php echo $all_data['second_load_more_bg_color'];
                              ?> !important;
  }

  #more_button_model,
  #no_more_button_model {
    background-color: #<?php echo $all_data['third_load_more_bg_color'];
                        ?> !important;
    color: #<?php echo $all_data['third_load_more_text_color'];
            ?> !important;
    border: 1px solid #<?php echo $all_data['third_load_more_bg_color'];
                        ?> !important;
    box-shadow: 0px 1px 2px #<?php echo $all_data['third_load_more_bg_color'];
                              ?> !important;
  }

  #quick_search_form .btn-search-ad {
    width: auto !important;
  }

  .adv_srch h5,
  .fieldgroup .control-label {
    color: #<?php echo $all_data['entry_pop_guest_text_color'];
            ?> !important;
  }

  .VehicleBlockItems:hover,
  .product_type_image_wrap:hover,
  .product_type:hover {
    -webkit-transition: 0.4s ease;
    transition: 0.4s ease;
    box-shadow: 0 0 5px 2px #<?php echo $all_data['product_action_btn_bg_color'];
                              ?> !important;
  }

  .VehicleBlockItems {
    -webkit-transition: 0.4s ease;
    transition: 0.4s ease;
  }

  .VehicleBlockItems:hover img,
  .product_type_image_wrap:hover img,
  .product_type:hover img {
    transform: scale(1.1);
    -webkit-transition: 0.4s ease;
    transition: 0.4s ease;
  }

  #user_entry_popup h1 {
    color: #<?php echo $all_data['entry_pop_login_text_color'];
            ?> !important;
  }

  #user_entry_popup .container {
    border-color: #<?php echo $all_data['entry_pop_border_color'];
                    ?> !important;
  }

  .forgot-btn {
    color: #000;
  }

  #user_entry_popup #login_form .forgot-btn:hover,
  .forgot-btn:hover {
    color: #<?php echo $all_data['cart_productdisp_txt_color'];
            ?> !important;
  }

  #user_entry_popup #login_form .btn.login-submit,
  #forgot_email .btn.login-submit,
  #forgot_phone .btn.login-submit,
  #forgot_email_phone .btn.login-submit {
    background-color: #<?php echo $all_data['cart_productdisp_txt_color'];
                        ?> !important;
    color: #<?php echo $all_data['entry_pop_btn_bg_color'];
            ?> !important;
  }

  #user_entry_popup #login_form .btn.login-submit:hover,
  #forgot_email .btn.login-submit:hover,
  #forgot_phone .btn.login-submit:hover,
  #forgot_email_phone .btn.login-submit:hover {
    background-color: #<?php echo $all_data['entry_pop_login_text_color'];
                        ?> !important;
    color: #<?php echo $all_data['entry_pop_btn_bg_color'];
            ?> !important;
  }

  #user_entry_popup #login_form .blink {
    color: red !important;
  }

  #user_entry_popup .guest-user {
    color: #<?php echo $all_data['entry_pop_guest_text_color'];
            ?> !important;
  }

  #user_entry_popup .guest-user:hover {
    color: #<?php echo $all_data['entry_pop_guest_text_color'];
            ?> !important;
    text-decoration: underline;
  }

  #user_entry_popup .apply_title {
    color: #<?php echo $all_data['entry_pop_guest_text_color'];
            ?> !important;
  }

  #user_entry_popup .apply_btn {
    background-color: #<?php echo $all_data['entry_pop_guest_text_color'];
                        ?> !important;
    color: #<?php echo $all_data['cart_productdisp_txt_color'];
            ?> !important;
  }

  #user_entry_popup .apply_btn:hover {
    color: #<?php echo $all_data['entry_pop_apply_btn_text_hover_color'];
            ?> !important;
  }

  .commonLoader {
    background-color: #<?php echo $all_data['common_loader_bg_color'];
                        ?> !important;
  }

  .commonLoader .loaderContent p {
    color: #<?php echo $all_data['common_loader_text_color'];
            ?> !important;
  }

  #usertimermob,
  .date-sec {
    color: #<?= $all_data['username_runningtime_color'];
            ?> !important;
  }

  #dateActive,
  #dateActiveMob {
    color: #<?= $all_data['date_time_color'];
            ?> !important;
  }

  #timeActive,
  #timeActiveMob {
    color: #<?php echo $all_data['username_runningtime_color'];
            ?> !important;
  }

  .staticPageContent p {
    color: #<?php echo $all_data['entry_pop_guest_text_color'];
            ?> !important;
  }

  .ct-mainHeader .navbar .dropdown-menu li a,
  .ct-mainHeader .navbar .dropdown-menu li {
    color: #<?php echo $all_data['langdropdown_txt_color'];
            ?> !important;
  }

  .imgLabelColor {
    color: #<?php echo $colors['home_whats_color'];
            ?> !important;
    background-color: <?php echo $colors['home_whats_color_shadow'];
                      ?>;
  }

  .whatsNewSection {
    background-color: #<?php echo $colors['home_whats_new_section_background'];
                        ?> !important;
  }

  .productGallary {
    box-shadow: 0px 0px 10px <?php echo $colors['home_whats_new_section_background_shadow'];
                              ?>;
  }

  <?php if (getContentPosition($lang_id) == 'rtl') {
  ?>.card-header-product-list {
    padding-right: 70px !important;
  }

  <?php
  }

  ?><?php if ($this->lang->default_lang == 'frar') {
    ?>.width100percent3 {
    margin-top: 6px !important;
  }

  #quick_search_form .adv_srch {
    padding-bottom: 60px !important;
  }

  <?php
    }

  ?><?php if ($this->lang->default_lang == 'frar' || $this->lang->default_lang == 'fr') {
    ?>.custom-btn {
    padding: 0 0 0px 50px !important;
  }

  <?php
    }

  ?>#quick_search_form .ddTitleText .ddlabel {
    width: 90%;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    display: inline-block;
  }

  .hideContent {
    overflow: hidden;
    line-height: 1em;
  }

  .showContent {
    line-height: 1em;
    height: auto;
  }

  .ddChild {
    width: 246.5px !important;
  }

  #instagram-feed-demo {
    background-color: #<?= $colors['insta_gallery_bg_color'];
                        ?> !important;
  }

  .part_number_title_color {
    color: #<?php echo $colors['part_number_title_color'];
            ?> !important;
  }

  .price_title_color {
    color: #<?php echo $colors['price_title_color'];
            ?> !important;
  }


  .my-account-navigation ul li a {
    color: #070a57;
  }

  .my-account-navigation ul li.active a {
    color: #<?php echo $all_data['cart_productdisp_txt_color'];
            ?> !important;
    background-color: #f1f1f1;
  }

  .my-account-content p a {
    color: #<?php echo $all_data['cart_productdisp_txt_color'];
            ?> !important;
  }

  .my-account-content p a:hover,
  .my-account-navigation ul li a:hover,
  .deletebtn:hover {
    color: #<?php echo $all_data['cart_productdisp_txt_color'];
            ?> !important;
  }

  .deletebtn {
    color: #070a57;
  }

  input[readonly] {
    background-color: #e9ecef !important;
  }



  .cl-filter .clf-addcart:hover,
  .cl-filter .clf-addcart:focus {
    color: #<?php echo $all_data['qs_btn_hover_text_color'];
            ?> !important;
    border-color: #<?php echo $all_data['qs_btn_hover_text_color'];
                    ?> !important;
    background-color: #<?php echo $all_data['qs_btn_hover_bg_color'];
                        ?> !important;
  }

  .cl-filter .clf-addcart {
    color: #<?php echo $all_data['qs_btn_text_color'];
            ?> !important;
    background-color: #<?php echo $all_data['qs_btn_bg_color'];
                        ?> !important;
  }

  .cl-filter h5.clf-title {
    color: #<?php echo $colors['qs_heading_color'];
            ?> !important;
  }

  .cl-filter label.control-label {
    color: #<?php echo $colors['qs_heading_color'];
            ?> !important;
}

.cart_back_btn_color {
  background-color: #<?php echo $colors['cart_back_btn_color'];
          ?> !important;
  color: #FFFFFF !important;
}
.cart_save_btn_color {
  background-color: #<?php echo $colors['cart_save_btn_color'];
          ?> !important;
  color: #FFFFFF !important;
}
.cart_submit_btn_color {
  background-color: #<?php echo $colors['cart_submit_btn_color'];
          ?> !important;
  color: #FFFFFF !important;
}
.btn.actn-btn.cart_back_btn_color {
  background-color: #<?php echo $colors['cart_back_btn_color'];
          ?> !important;
  color: #FFFFFF !important;
}
.btn.actn-btn.cart_save_btn_color {
  background-color: #<?php echo $colors['cart_save_btn_color'];
          ?> !important;
  color: #FFFFFF !important;
}
.btn.actn-btn.cart_submit_btn_color {
  background-color: #<?php echo $colors['cart_submit_btn_color'];
          ?> !important;
  color: #FFFFFF !important;
}

.btn2{
    min-width: 120px;
    text-align: center;
    font-weight: 600;
    border: none;
    padding: 10px 20px;
    border-radius: 0;
    margin: 0 5px;
}
.kgtloadmore{
  background-color: #<?php echo $colors['product_load_more_btn'];
          ?> !important;
  box-shadow: 0px 1px 2px #<?php echo $colors['product_load_more_btn'];?> !important;
  border: 1px solid #<?php echo $colors['product_load_more_btn'];?> !important;
}
</style>
