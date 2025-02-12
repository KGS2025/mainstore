<style>
        @media(min-width:1200px){
            
			#nav-global-location-slot{
				display:block;
			}
			#navbarSupportedContent{
				display: none;
			}
			.lower-header{
				display: block;
			}
			.home-main-search-wrap{
				display:block;
			}
			.home-mobile-search-wrap{
				display: none !important;
			}
			.text-header1{
				max-width: 55%;
			}			
        }
        .text-header1 .right-box-input {
			margin: 0 auto;
			max-width: 100%;
		}
</style>
<div class="main-col">
    <div class="search-result-wrapper">
        <label for="Search" class="displaynon"><?php echo $general_instruction->search_articles; ?></label>
        <div class="right-box-input position-relative">
			<div class="input-field-card">
				<input style="width: 442px;
    margin-left: 18px;" id="Search" type="text" name="Articles" placeholder="<?php echo str_replace('Articles','',$general_instruction->search_articles); ?>" autocomplete="off"/>
				<input id="SearchBtn" type="button" class="headersearchbutton" aria-label="search button" value=""/>
			</div>
            <ul id="searchresult" class="search-result">
            </ul>
		</div>
    </div>

</div>

<!--Modal request for new item in quick search-->
<div class="modal fade" id="enquiry_partnumber_details">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-content-modal">
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <form method="post" enctype="multipart/form-data" id="senditemenquiry"
                              action="<?php echo base_url('contact') ?>">
                            <input type="hidden" class="form-control" name="code" id="code" value=" "/>
                            <input type="hidden" class="country_title1" name="country_title1" value=" "/>
                        </form>
                    </div>
                    <br/>

                    <div class="btn-modal">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 text-right">
                                <img id="loaderimage" class="displaynon" src="<?php echo base_url();?>assets/frontend/images/loading.gif" alt="Loading"/>&nbsp;<a
                                    href="javascript:void(0);" class="btn btn-primary rounded floatleft1" id="enquirysubmit_contctredirect"
                                    >OK <i class="fa fa-angle-right"></i></a>&nbsp;&nbsp;
                                <a href="javascript:void(0);"
                                   onClick="$('#enquiry_partnumber_details').modal('hide')"
                                   class="floatright1 btn rounded btn-primary"><?php echo lang('Cancel') ?> &nbsp; <i
                                        class="fa fa-angle-right"></i></a>
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