<!-- <?php if ((isset($all_data['left_logo_status']) && $all_data['left_logo_status'] == 1) || (isset($all_data['right_logo_status']) && $all_data['right_logo_status'] == 1)) { ?>
<div class="container-fluid py-3 py-md-5 text-center">                
        <?php if (isset($all_data['left_logo_status']) && $all_data['left_logo_status'] == 1) { ?>
            <?php if (isset($all_data['logo']) && $all_data['logo'] != '') {
                $logo =  asset_url() . "assets/uploads/logo/thumbnails/" . $all_data['logo']; ?>
                <a class="logo navbar-logo navbar-brand text-center d-inline-block" href="<?php echo $all_data['logo_url']; ?>" aria-label="header logo icon">
                    <img src="<?php echo $logo; ?>" alt="<?php echo isset($all_data['title']) ? $all_data['title'] : ''; ?>" class="floatleft1 m-auto float-none" />
                </a>
            <?php } else { ?>
                <a class="logo navbar-logo navbar-brand text-center d-inline-block" href="<?php echo $all_data['logo_url']; ?>" aria-label="header logo icon">
                    <img src="<?php echo asset_url('assets/uploads/logo/thumbnails/logo.png'); ?>" alt="34563456" class="floatleft1 m-auto float-none"/>
                </a>
            <?php } ?>
        <?php } ?>                  
        <?php if (isset($all_data['right_logo_status']) && $all_data['right_logo_status'] == 1) {
            if (isset($all_data['header_image']) && $all_data['header_image'] != '') {
                $header_image = asset_url() . "assets/uploads/logo/thumbnails/" . $all_data['header_image']; ?>
                <a class="logo demon_logo_link py-3 text-center d-inline-block" href="<?php echo $all_data['header_image_url']; ?>" target="_blank" rel="noopener noreferrer" aria-label="store icon">
                    <img src="<?php echo $header_image; ?>" alt="left logo image main"  class="floatleft1 m-auto float-none"/>
                </a>
            <?php } ?>
        <?php } ?>
    </div>

<?php } ?> -->