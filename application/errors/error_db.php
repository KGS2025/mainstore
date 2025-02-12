<!DOCTYPE html>
<html lang="en">
<head>
<title>Database Error</title>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url() . 'assets/frontend/css/error-element.css'; ?>"> 
</head>
<body>
	<div id="container">
		<h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
	</div>
</body>
</html>