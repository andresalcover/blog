<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $title;?></title>

<link href="<?php echo $base_url?>assets/css/bootstrap.min.css" rel="stylesheet" media ="all">
<link href="<?php echo $base_url?>assets/css/bootstrap-responsive.min.css" rel="stylesheet" media ="all">
<link href="<?php echo $base_url?>assets/css/cleditor/jquery.cleditor.css" rel="stylesheet" media ="all">
<link href="<?php echo $base_url?>assets/css/style.css" rel="stylesheet" media ="all">


<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->


</head>
<body>
	<div class="row-fluid">
		<div class="navbar navbar-static-top navbar-inverse">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="<?php echo $base_url;?>" class="brand"><?php echo $title;?></a>
					<?php echo $button_logout;?>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid main-container">
