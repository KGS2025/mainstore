
<!-- Main content -->

<div class="content zerorightmargin ">


    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <div class="body dashboard">

                    <!-- Content container -->
                    <div class="container">

                        <!-- Pickers -->

                        <h4><?php echo $admin_static_links['search_result_keyword_text']['front']; ?> "<strong><?php echo $search_text; ?></strong>"</h4>
                        <!-- /loaders/ tooltips -->
                        <div class="table-overflow">
                            <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                <table aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">

                                    <tbody aria-relevant="all" aria-live="polite" role="alert">
                                        <?php if(!empty($searchData)) { ?>
                                            <?php foreach($searchData as $d){ ?>
                                                <tr>
                                                    <td>
                                                        <a href="<?php echo $d['url']; ?>" target="_blank"><?php echo $d['pagename']; ?></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $admin_static_links['no_data_available']['front']; ?>
                                                    </td>
                                                </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /content container -->

                </div>
            </div>
        </div>
    </div>
    <!-- /content -->
</div>
<!-- /main wrapper -->
