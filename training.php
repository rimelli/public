<?php
include("includes/header.php");
include("includes/form_handlers/settings_handler.php");
?>





<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>Tryouts</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/colors/blue.css">

</head>
<body class="gray">

<!-- Wrapper -->
<div id="wrapper">


<!-- Dashboard Container -->
<div class="dashboard-container">

	<?php include("includes/side_menu.php"); ?>

	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner">
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Training Centre</h3>
			</div>

			<!-- Row -->
			<div class="row">

				<!-- Section -->
<div class="section gray">
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-8">

				<!-- Blog Post -->
				<a href="training_conditioning.php" class="blog-post">
					<!-- Blog Post Thumbnail -->
					<div class="blog-post-thumbnail">
					</div>
					<!-- Blog Post Content -->
					<div class="blog-post-content">
						<h3>Conditioning</h3>
						<p>text texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext texttext text.</p>
					</div>
					<!-- Icon -->
					<div class="entry-icon"></div>
				</a>

			</div>


			<div class="col-xl-4 col-lg-4 content-left-offset">
				<div class="sidebar-container">

					<!-- Widget -->
					<div class="sidebar-widget">

						<h3>Last Sessions</h3>
						<ul class="widget-tabs">
							<!-- Post #1 -->
							<li>
								<a href="training_conditioning.php" class="widget-content active">
									<div class="widget-text">
										<h5>Conditioning</h5>
									</div>
								</a>
							</li>
						</ul>

					</div>
					<!-- Widget / End-->

				</div>
			</div>

		</div>
	</div>

			</div>
			<!-- Row / End -->

			<!-- Footer -->
			<?php include("includes/footer.php"); ?>
			<!-- Footer / End -->

		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>
<!-- Dashboard Container / End -->

</div>
<!-- Wrapper / End -->


<!-- Scripts
================================================== -->
<script src="assets/js/jquery-migrate-3.3.1.min.js"></script>
<script src="assets/js/mmenu.min.js"></script>
<script src="assets/js/tippy.all.min.js"></script>
<script src="assets/js/simplebar.min.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script>
<script src="assets/js/bootstrap-select.min.js"></script>
<script src="assets/js/snackbar.js"></script>
<script src="assets/js/clipboard.min.js"></script>
<script src="assets/js/counterup.min.js"></script>
<script src="assets/js/magnific-popup.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/custom.js"></script>

<!-- Snackbar // documentation: https://www.polonel.com/snackbar/ -->
<script>
// Snackbar for user status switcher
$('#snackbar-user-status label').click(function() { 
	Snackbar.show({
		text: 'Your status has been changed!',
		pos: 'bottom-center',
		showAction: false,
		actionText: "Dismiss",
		duration: 3000,
		textColor: '#fff',
		backgroundColor: '#383838'
	}); 
}); 
</script>

</body>
</html>