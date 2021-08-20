<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");
include("includes/classes/Notification.php");
?>




<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>Jobs</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- FontAwesome
================================================== -->
<script src="https://kit.fontawesome.com/1a2275be55.js" crossorigin="anonymous"></script>

<!-- Javascript
================================================== -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="assets/js/tryouts.js"></script>
<script src="assets/js/jquery.Jcrop.js"></script>
<script src="assets/js/jcrop_bits.js"></script>

<!-- CSS
================================================== -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/colors/blue.css">
<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css">
<link rel="stylesheet" href="assets/css/docs.css">
<link rel="stylesheet" href="assets/css/theme.css">
<link rel="stylesheet" href="assets/vendor/quill/dist/quill.snow.css">

</head>
<body>


<!-- Header Container
================================================== -->
<header id="header-container" class="fullwidth dashboard-header">

	<!-- Header -->
	<div id="header">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo">
				</div>

				<!-- Main Navigation -->
				<nav id="navigation">
					<ul id="responsive">

						<li><a href="jobs.php">Jobs</a></li>

					</ul>
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
				
			</div>
			<!-- Left Side Content / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->



</body>
</html>
