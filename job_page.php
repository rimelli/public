<?php
include("includes/header.php");


if (isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	$id = 0;
}

?>


<!doctype html>
<html lang="en">

<head>

	<!-- Basic Page Needs
================================================== -->
	<title>Website</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
================================================== -->
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/colors/blue.css">

</head>

<body>

	<!-- Wrapper -->
	<div id="wrapper">


		<!-- Page Content
================================================== -->
		<?php
		$job = new Job($con, $userLoggedIn);
		$job->getSingleJob($id);
		?>




		<!-- Footer
================================================== -->
		<?php include("includes/menu_footer.php"); ?>
		<!-- Footer / End -->

	
	<!-- Wrapper / End -->

	<!-- Apply for a job popup
================================================== -->
	<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

		<!--Tabs -->
		<div class="sign-in-form">

			<ul class="popup-tabs-nav">
				<li><a href="#tab">Apply Now</a></li>
			</ul>

			<div class="popup-tabs-container">

				<!-- Tab -->
				<div class="popup-tab-content" id="tab">

					<!-- Welcome Text -->
					<div class="welcome-text">
						<h3>Attach File With CV</h3>
					</div>

					<!-- Form -->
					<form method="post" id="apply-now-form">

						<div class="input-with-icon-left">
							<i class="icon-material-outline-account-circle"></i>
							<input type="text" class="input-text with-border" name="name" id="name" placeholder="First and Last Name" required />
						</div>

						<div class="input-with-icon-left">
							<i class="icon-material-baseline-mail-outline"></i>
							<input type="text" class="input-text with-border" name="emailaddress" id="emailaddress" placeholder="Email Address" required />
						</div>

						<div class="uploadButton">
							<input class="uploadButton-input" type="file" accept="image/*, application/pdf" id="upload-cv" />
							<label class="uploadButton-button ripple-effect" for="upload-cv">Select File</label>
							<span class="uploadButton-file-name">Upload your CV / resume relevant file. <br> Max. file size: 50 MB.</span>
						</div>

					</form>

					<!-- Button -->
					<button class="button margin-top-35 full-width button-sliding-icon ripple-effect" type="submit" form="apply-now-form">Apply Now <i class="icon-material-outline-arrow-right-alt"></i></button>

				</div>

			</div>
		</div>
	</div>
	<!-- Apply for a job popup / End -->

	</div>
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

		// Snackbar for copy to clipboard button
		$('.copy-url-button').click(function() {
			Snackbar.show({
				text: 'Copied to clipboard!',
			});
		});
		$('#apply-job-btn').magnificPopup({
			type: 'inline',

			fixedContentPos: false,
			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,
			preloader: false,

			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});
	</script>

</body>

</html>