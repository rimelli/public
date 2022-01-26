<?php
include("includes/header.php");
?>



<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>Hireo</title>
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
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Manage Candidates</h3>
				<span class="margin-top-7">Job Applications for <a href="#">Full Stack PHP Developer</a></span>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-supervisor-account"></i> 3 Candidates</h3>
						</div>

						<div class="content">
							<ul class="dashboard-box-list">
								<li>
									<!-- Overview -->
									<div class="freelancer-overview manage-candidates">
										<div class="freelancer-overview-inner">

											<!-- Avatar -->
											<div class="freelancer-avatar">
												<div class="verified-badge"></div>
												<a href="#"><img src="images/user-avatar-big-03.jpg" alt=""></a>
											</div>

											<!-- Name -->
											<div class="freelancer-name">
												<h4><a href="#">Sindy Forest <img class="flag" src="images/flags/au.svg" alt="" title="Australia" data-tippy-placement="top"></a></h4>

												<!-- Details -->
												<span class="freelancer-detail-item"><a href="#"><i class="icon-feather-mail"></i> sindy@example.com</a></span>
												<span class="freelancer-detail-item"><i class="icon-feather-phone"></i> (+61) 123-456-789</span>

												<!-- Rating -->
												<div class="freelancer-rating">
													<div class="star-rating" data-rating="5.0"></div>
												</div>

												<!-- Buttons -->
												<div class="buttons-to-right always-visible margin-top-25 margin-bottom-5">
													<a href="#" class="button ripple-effect"><i class="icon-feather-file-text"></i> Download CV</a>
													<a href="#small-dialog" class="popup-with-zoom-anim button dark ripple-effect"><i class="icon-feather-mail"></i> Send Message</a>
													<a href="#" class="button gray ripple-effect ico" title="Remove Candidate" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
												</div>
											</div>
										</div>
									</div>
								</li>

								<li>
									<!-- Overview -->
									<div class="freelancer-overview manage-candidates">
										<div class="freelancer-overview-inner">

											<!-- Avatar -->
											<div class="freelancer-avatar">
												<a href="#"><img src="images/user-avatar-placeholder.png" alt=""></a>
											</div>

											<!-- Name -->
											<div class="freelancer-name">
												<h4><a href="#">Sebastiano Piccio <img class="flag" src="images/flags/it.svg" alt="" title="Italy" data-tippy-placement="top"></a></h4>
											

												<!-- Details -->
												<span class="freelancer-detail-item"><a href="#"><i class="icon-feather-mail"></i> sebastiano@example.com</a></span>
												<span class="freelancer-detail-item"><i class="icon-feather-phone"></i> (+39) 123-456-789</span>

												<!-- Rating -->
												<br>
												<span class="company-not-rated">Minimum of 3 votes required</span>

												<!-- Buttons -->
												<div class="buttons-to-right always-visible margin-top-25 margin-bottom-5">
													<a href="#" class="button ripple-effect"><i class="icon-feather-file-text"></i> Download CV</a>
													<a href="#small-dialog" class="popup-with-zoom-anim button dark ripple-effect"><i class="icon-feather-mail"></i> Send Message</a>
													<a href="#" class="button gray ripple-effect ico" title="Remove Candidate" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
												</div>
											</div>
										</div>
									</div>
								</li>

								<li>
									<!-- Overview -->
									<div class="freelancer-overview manage-candidates">
										<div class="freelancer-overview-inner">

											<!-- Avatar -->
											<div class="freelancer-avatar">
												<a href="#"><img src="images/user-avatar-placeholder.png" alt=""></a>
											</div>

											<!-- Name -->
											<div class="freelancer-name">
												<h4><a href="#">Nikolay Azarov <img class="flag" src="images/flags/ru.svg" alt="" title="Russia" data-tippy-placement="top"></a></h4>

												<!-- Details -->
												<span class="freelancer-detail-item"><a href="#"><i class="icon-feather-mail"></i> nikolay@example.com</a></span>
												<span class="freelancer-detail-item"><i class="icon-feather-phone"></i> (+7) 123-456-789</span>

												<!-- Rating -->
												<br>
												<span class="company-not-rated">Minimum of 3 votes required</span>

												<!-- Buttons -->
												<div class="buttons-to-right always-visible margin-top-25 margin-bottom-5">
													<a href="#" class="button ripple-effect"><i class="icon-feather-file-text"></i> Download CV</a>
													<a href="#small-dialog" class="popup-with-zoom-anim button dark ripple-effect"><i class="icon-feather-mail"></i> Send Message</a>
													<a href="#" class="button gray ripple-effect ico" title="Remove Candidate" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
												</div>
											</div>
										</div>
									</div>
								</li>

							</ul>
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


<!-- Send Direct Message Popup
================================================== -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab">Send Message</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab">
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Direct Message To Sindy</h3>
				</div>
					
				<!-- Form -->
				<form method="post" id="send-pm">
					<textarea name="textarea" cols="10" placeholder="Message" class="with-border" required></textarea>
				</form>
				
				<!-- Button -->
				<button class="button full-width button-sliding-icon ripple-effect" type="submit" form="send-pm">Send <i class="icon-material-outline-arrow-right-alt"></i></button>

			</div>

		</div>
	</div>
</div>
<!-- Send Direct Message Popup / End -->


<!-- Scripts
================================================== -->
<script src="assets/js/jquery-3.5.1.min.js"></script>
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


